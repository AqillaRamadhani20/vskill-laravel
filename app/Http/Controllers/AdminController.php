<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users'          => User::where('role', '!=', 'admin')->count(),
            'total_penyedia'       => User::where('role', 'penyedia')->count(),
            'total_pembeli'        => User::where('role', 'pembeli')->count(),
            'total_services'       => Service::count(),
            'total_services_aktif' => Service::where('status', 'aktif')->count(),
            'total_orders'         => Order::count(),
            'orders_pending'       => Order::where('status', 'pending')->count(),
            'orders_diterima'      => Order::where('status', 'diterima')->count(),
            'orders_selesai'       => Order::where('status', 'selesai')->count(),
            'orders_ditolak'       => Order::where('status', 'ditolak')->count(),
        ];

        $chartData = [
            'orders_by_status'     => Order::selectRaw('status, COUNT(*) as total')
                ->groupBy('status')->pluck('total', 'status'),
            'users_by_role'        => User::where('role', '!=', 'admin')
                ->selectRaw('role, COUNT(*) as total')
                ->groupBy('role')->pluck('total', 'role'),
            'services_by_category' => Service::selectRaw('kategori, COUNT(*) as total')
                ->groupBy('kategori')->orderByDesc('total')->limit(8)
                ->pluck('total', 'kategori'),
        ];

        $recentOrders = Order::with('service', 'buyer', 'seller')
            ->latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'chartData', 'recentOrders'));
    }

    public function users(Request $request)
    {
        $users = User::with('profile')
            ->where('role', '!=', 'admin')
            ->when($request->role, fn ($q, $role) => $q->where('role', $role))
            ->when($request->search, fn ($q, $s) => $q->where(function ($q) use ($s) {
                $q->where('nama_lengkap', 'like', "%$s%")
                    ->orWhere('email', 'like', "%$s%")
                    ->orWhere('username', 'like', "%$s%");
            }))
            ->latest()
            ->get();

        return view('admin.users', compact('users'));
    }

    public function toggleUserRole(User $user)
    {
        abort_if($user->role === 'admin', 403);

        $roleBaru = $user->role === 'penyedia' ? 'pembeli' : 'penyedia';
        $user->update(['role' => $roleBaru]);

        return back()->with('success', "Role {$user->nama_lengkap} berhasil diubah menjadi {$roleBaru}.");
    }

    public function deleteUser(User $user)
    {
        abort_if($user->role === 'admin', 403);

        $nama = $user->nama_lengkap;
        $user->delete();

        return back()->with('success', "User {$nama} berhasil dihapus.");
    }

    public function services(Request $request)
    {
        $services = Service::with('user')
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->when($request->search, fn ($q, $s) => $q->where('judul_jasa', 'like', "%$s%"))
            ->latest()
            ->get();

        return view('admin.services', compact('services'));
    }

    public function toggleServiceStatus(Service $service)
    {
        $statusBaru = $service->status === 'aktif' ? 'nonaktif' : 'aktif';
        $service->update(['status' => $statusBaru]);

        return back()->with('success', "Status jasa berhasil diubah menjadi {$statusBaru}.");
    }

    public function deleteService(Service $service)
    {
        $judul = $service->judul_jasa;
        $service->delete();

        return back()->with('success', "Jasa \"{$judul}\" berhasil dihapus.");
    }

    public function orders(Request $request)
    {
        $orders = Order::with('service', 'buyer', 'seller')
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->latest()
            ->get();

        return view('admin.orders', compact('orders'));
    }

    public function exportPdfRingkasan()
    {
        $stats = [
            'total_users'          => User::where('role', '!=', 'admin')->count(),
            'total_penyedia'       => User::where('role', 'penyedia')->count(),
            'total_pembeli'        => User::where('role', 'pembeli')->count(),
            'total_services'       => Service::count(),
            'total_services_aktif' => Service::where('status', 'aktif')->count(),
            'total_orders'         => Order::count(),
            'orders_pending'       => Order::where('status', 'pending')->count(),
            'orders_diterima'      => Order::where('status', 'diterima')->count(),
            'orders_selesai'       => Order::where('status', 'selesai')->count(),
            'orders_ditolak'       => Order::where('status', 'ditolak')->count(),
        ];

        $orders  = Order::with('service', 'buyer', 'seller')->latest()->get();
        $penyedia = User::with('profile', 'services')->where('role', 'penyedia')->get();

        $pdf = Pdf::loadView('pdf.laporan-ringkasan', compact('stats', 'orders', 'penyedia'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-ringkasan-vskill-' . now()->format('Ymd') . '.pdf');
    }

    public function exportPdfOrder()
    {
        $orders = Order::with('service', 'buyer', 'seller')->latest()->get();

        $pdf = Pdf::loadView('pdf.laporan-order', compact('orders'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-order-vskill-' . now()->format('Ymd') . '.pdf');
    }

}
