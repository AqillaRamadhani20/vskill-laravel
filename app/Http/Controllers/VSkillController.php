<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Portfolio;
use App\Models\Profile;
use App\Models\Rating;
use App\Models\Service;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class VSkillController extends Controller
{
    private array $kategori = [
        'Digital Marketing',
        'Data Science & Analysis',
        'Microsoft Office',
        'UI/UX Research and Design',
        'Product and Project Management',
        'Website & Apps Developer',
        'Video Editing',
        'Jasa Cek Turnitin',
        'Penyusunan Artikel',
        'Merapikan File/Dokumen',
        'Public Speaking',
        'Desain Grafis',
        'Konsultan Keuangan',
        'Jasa Bahasa Inggris',
        'Jasa Penerjemah',
    ];

    public function home()
    {
        return view('pages.home');
    }

    public function tentang()
    {
        return view('pages.tentang');
    }

    public function kontak()
    {
        return view('pages.kontak');
    }

    public function dashboard(Request $request)
    {
        $services = Service::with('user.profile', 'ratings')
            ->where('status', 'aktif')
            ->when($request->kategori, fn ($query, $kategori) => $query->where('kategori', $kategori))
            ->latest('created_at')
            ->get();

        $jasaPerKategori = Service::where('status', 'aktif')
            ->selectRaw('kategori, COUNT(*) as jumlah')
            ->groupBy('kategori')
            ->pluck('jumlah', 'kategori');

        $totalJasa = Service::where('status', 'aktif')->count();

        return view('pages.dashboard', [
            'services'        => $services,
            'kategori'        => $this->kategori,
            'jasaPerKategori' => $jasaPerKategori,
            'totalJasa'       => $totalJasa,
        ]);
    }

    public function detail(Service $service)
    {
        $service->load('user.profile', 'ratings.buyer.profile');

        return view('pages.detail', compact('service'));
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $data['username'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            Auth::login($user);

            return redirect()->intended('/dashboard');
        }

        return back()
            ->withErrors(['username' => 'Username atau password salah.'])
            ->withInput();
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'username' => ['required', 'string', 'min:4', 'max:20', 'regex:/^(?=.*\d)[A-Za-z0-9_]+$/', 'unique:users,username'],
            'password' => 'required|min:8|confirmed',
        ], [
            'username.regex' => 'Username harus tanpa spasi dan minimal mengandung 1 angka.',
        ]);

        $user = User::create([
            'nama_lengkap' => $data['nama_lengkap'],
            'email' => strtolower($data['email']),
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role' => 'pembeli',
        ]);

        Auth::login($user);

        return redirect('/profile/edit')
            ->with('success', 'Registrasi berhasil. Lengkapi profil Anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function editProfile()
    {
        return view('pages.profile-edit', [
            'profile' => Auth::user()->profile,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $profileId = Auth::user()->profile?->id;

        $data = $request->validate([
            'npm' => [
                'required',
                'digits_between:8,20',
                Rule::unique('profiles', 'npm')->ignore($profileId),
            ],
            'prodi' => 'required|string|max:100',
            'bio' => 'nullable|string',
            'skill_summary' => 'nullable|string',
            'tools_summary' => 'nullable|string',
            'harga_mulai' => 'nullable|integer|min:0',
            'kontak_wa' => 'nullable|digits_between:10,15',
            'status_ketersediaan' => 'nullable|in:tersedia,sibuk',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        unset($data['foto']); // remove UploadedFile instance from validated array

        $fotoLama = Auth::user()->profile?->foto ?? 'default.jpg';

        if ($request->hasFile('foto')) {
            if ($fotoLama !== 'default.jpg') {
                Storage::disk('public')->delete('foto-profil/' . $fotoLama);
            }
            $ext      = $request->file('foto')->getClientOriginalExtension();
            $filename = time() . '_' . Auth::id() . '.' . $ext;
            $request->file('foto')->storeAs('foto-profil', $filename, 'public');
            $foto = $filename;
        } else {
            $foto = $fotoLama;
        }

        Profile::updateOrCreate(
            ['user_id' => Auth::id()],
            $data + ['foto' => $foto]
        );

        return back()->with('success', 'Profil berhasil disimpan.');
    }

    public function profile(User $user)
    {
        $user->load('profile', 'services.ratings', 'portfolios');

        return view('pages.profile-view', compact('user'));
    }

    public function portfolioCreate()
    {
        $this->mustPenyedia();

        return view('pages.portfolio-form', ['portfolio' => new Portfolio()]);
    }

    public function portfolioStore(Request $request)
    {
        $this->mustPenyedia();

        $data = $request->validate([
            'judul_project' => 'required|string|max:100',
            'deskripsi'     => 'required|string',
            'tools'         => 'nullable|string',
            'link_demo'     => 'nullable|url',
        ]);

        Auth::user()->portfolios()->create($data);

        return redirect()->route('profile.view', Auth::id())->with('success', 'Portfolio berhasil ditambahkan.');
    }

    public function portfolioEdit(Portfolio $portfolio)
    {
        abort_unless($portfolio->user_id === Auth::id(), 403);

        return view('pages.portfolio-form', compact('portfolio'));
    }

    public function portfolioUpdate(Request $request, Portfolio $portfolio)
    {
        abort_unless($portfolio->user_id === Auth::id(), 403);

        $data = $request->validate([
            'judul_project' => 'required|string|max:100',
            'deskripsi'     => 'required|string',
            'tools'         => 'nullable|string',
            'link_demo'     => 'nullable|url',
        ]);

        $portfolio->update($data);

        return redirect()->route('profile.view', Auth::id())->with('success', 'Portfolio berhasil diperbarui.');
    }

    public function portfolioDelete(Portfolio $portfolio)
    {
        abort_unless($portfolio->user_id === Auth::id(), 403);

        $portfolio->delete();

        return back()->with('success', 'Portfolio berhasil dihapus.');
    }

    public function jadiPenyediaForm()
    {
        return view('pages.jadi-penyedia', [
            'user' => Auth::user(),
            'profile' => Auth::user()->profile,
            'isEmailUpn' => preg_match('/@student\.upnjatim\.ac\.id$/i', Auth::user()->email) === 1,
        ]);
    }

    public function jadiPenyedia(Request $request)
    {
        $user = Auth::user();
        $isEmailUpn = preg_match('/@student\.upnjatim\.ac\.id$/i', $user->email) === 1;

        if (! $isEmailUpn) {
            return back()->withErrors([
                'email' => 'Hanya akun dengan email @student.upnjatim.ac.id yang dapat menjadi penyedia jasa. Akun ini tetap bisa digunakan sebagai pembeli.',
            ])->withInput();
        }

        $profileId = $user->profile?->id;

        $data = $request->validate([
            'npm' => ['required', 'digits_between:8,20', Rule::unique('profiles', 'npm')->ignore($profileId)],
            'prodi' => 'required|string|max:100',
            'bio' => 'nullable|string',
            'skill_summary' => 'nullable|string',
            'tools_summary' => 'nullable|string',
            'harga_mulai' => 'nullable|integer|min:0',
            'kontak_wa' => 'nullable|digits_between:10,15',
            'status_ketersediaan' => 'required|in:tersedia,sibuk',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        unset($data['foto']); // remove UploadedFile instance

        $fotoLama = $user->profile?->foto ?? 'default.jpg';

        if ($request->hasFile('foto')) {
            if ($fotoLama !== 'default.jpg') {
                Storage::disk('public')->delete('foto-profil/' . $fotoLama);
            }
            $ext      = $request->file('foto')->getClientOriginalExtension();
            $filename = time() . '_' . $user->id . '.' . $ext;
            $request->file('foto')->storeAs('foto-profil', $filename, 'public');
            $foto = $filename;
        } else {
            $foto = $fotoLama;
        }

        Profile::updateOrCreate(
            ['user_id' => $user->id],
            $data + ['foto' => $foto]
        );

        $user->update(['role' => 'penyedia']);

        return back()->with('success', 'Akun berhasil diaktifkan sebagai penyedia jasa.');
    }

    public function createService()
    {
        $this->mustPenyedia();

        return view('pages.service-form', [
            'service' => new Service(),
            'kategori' => $this->kategori,
            'action' => route('service.store'),
        ]);
    }

    public function storeService(Request $request)
    {
        $this->mustPenyedia();

        Auth::user()->services()->create($this->serviceData($request));

        return redirect('/dashboard')->with('success', 'Jasa berhasil ditambahkan.');
    }

    public function editService(Service $service)
    {
        $this->owner($service);

        return view('pages.service-form', [
            'service' => $service,
            'kategori' => $this->kategori,
            'action' => route('service.update', $service),
        ]);
    }

    public function updateService(Request $request, Service $service)
    {
        $this->owner($service);

        $service->update($this->serviceData($request));

        return redirect('/dashboard')->with('success', 'Jasa berhasil diperbarui.');
    }

    public function deleteService(Service $service)
    {
        $this->owner($service);

        $service->delete();

        return redirect('/dashboard')->with('success', 'Jasa berhasil dihapus.');
    }

    public function orderForm(Service $service)
    {
        abort_if(Auth::id() === $service->user_id, 403, 'Penyedia tidak dapat memesan jasanya sendiri.');

        return view('pages.order-form', compact('service'));
    }

    public function orderStore(Request $request, Service $service)
    {
        abort_if(Auth::id() === $service->user_id, 403, 'Penyedia tidak dapat memesan jasanya sendiri.');

        $noWa = Auth::user()->profile?->kontak_wa;

        if (! $noWa) {
            return back()->withErrors(['no_wa' => 'Tambahkan nomor WhatsApp di profil kamu sebelum memesan.']);
        }

        $data = $request->validate([
            'catatan' => 'required|string',
        ]);

        Order::create([
            'service_id' => $service->id,
            'buyer_id'   => Auth::id(),
            'seller_id'  => $service->user_id,
            'no_wa'      => $noWa,
            'catatan'    => $data['catatan'],
        ]);

        return redirect('/pesanan-saya')->with('success', 'Order berhasil dibuat.');
    }

    public function pesananSaya(Request $request)
    {
        $orders = Order::with('service.user.profile', 'seller.profile', 'buyer.profile')
            ->where('buyer_id', Auth::id())
            ->when($request->status, fn ($query, $status) => $query->where('status', $status))
            ->latest('created_at')
            ->get();

        return view('pages.orders', [
            'orders' => $orders,
            'mode' => 'buyer',
        ]);
    }

    public function orderMasuk(Request $request)
    {
        $orders = Order::with('service.user.profile', 'buyer.profile', 'seller.profile')
            ->where('seller_id', Auth::id())
            ->when($request->status, fn ($query, $status) => $query->where('status', $status))
            ->latest('created_at')
            ->get();

        return view('pages.orders', [
            'orders' => $orders,
            'mode' => 'seller',
        ]);
    }

    public function orderDetail(Order $order)
    {
        abort_unless(Auth::id() === $order->buyer_id || Auth::id() === $order->seller_id, 403);

        $order->load('service', 'buyer.profile', 'seller.profile', 'rating');

        return view('pages.order-detail', compact('order'));
    }

    public function storeRating(Request $request, Order $order)
    {
        abort_unless(Auth::id() === $order->buyer_id, 403);
        abort_unless($order->status === 'selesai', 403, 'Hanya order selesai yang bisa dirating.');
        abort_if($order->rating()->exists(), 403, 'Kamu sudah memberikan rating untuk order ini.');

        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string|max:500',
        ]);

        Rating::create([
            'order_id'   => $order->id,
            'service_id' => $order->service_id,
            'buyer_id'   => Auth::id(),
            'seller_id'  => $order->seller_id,
            'rating'     => $data['rating'],
            'ulasan'     => $data['ulasan'] ?? null,
        ]);

        return back()->with('success', 'Rating berhasil dikirim. Terima kasih!');
    }

    public function orderStatus(Request $request, Order $order)
    {
        abort_unless($order->seller_id === Auth::id(), 403);

        $data = $request->validate([
            'status' => 'required|in:diterima,ditolak,selesai',
        ]);

        $statusSekarang = $order->status;
        $statusBaru = $data['status'];

        if ($statusSekarang === 'pending') {
            abort_unless(in_array($statusBaru, ['diterima', 'ditolak'], true), 403, 'Order pending hanya bisa diterima atau ditolak.');
        } elseif ($statusSekarang === 'diterima') {
            abort_unless($statusBaru === 'selesai', 403, 'Order diterima hanya bisa diselesaikan.');
        } elseif (in_array($statusSekarang, ['ditolak', 'selesai'], true)) {
            abort(403, 'Status order ini sudah final dan tidak bisa diubah.');
        }

        $order->update(['status' => $statusBaru]);

        return back()->with('success', 'Status order diperbarui.');
    }

    public function downloadStruk(Order $order)
    {
        abort_unless(Auth::id() === $order->buyer_id || Auth::id() === $order->seller_id, 403);
        abort_unless($order->status === 'selesai', 403, 'Struk hanya tersedia untuk order yang sudah selesai.');

        $order->load('service', 'buyer.profile', 'seller.profile');

        $pdf = Pdf::loadView('pdf.struk-pembelian', compact('order'))
            ->setPaper('a5', 'portrait');

        $filename = 'struk-order-' . $order->id . '.pdf';

        return $pdf->download($filename);
    }

    private function serviceData(Request $request): array
    {
        return $request->validate([
            'judul_jasa' => 'required|string|max:100',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer|min:0',
            'estimasi_pengerjaan' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,nonaktif',
        ]);
    }

    private function mustPenyedia(): void
    {
        abort_unless(Auth::check() && Auth::user()->role === 'penyedia', 403);
    }

    private function owner(Service $service): void
    {
        abort_unless($service->user_id === Auth::id(), 403);
    }
}
