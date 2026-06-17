@extends('layouts.app')

@section('title', 'Detail Order | V-Skill')

@section('content')
@php
    $st = $order->status;
    $statusMeta = match($st) {
        'diterima' => ['badge' => 'badge-blue',   'label' => 'Diterima', 'color' => '#2563eb', 'bg' => '#eff6ff'],
        'ditolak'  => ['badge' => 'badge-red',    'label' => 'Ditolak',  'color' => '#dc2626', 'bg' => '#fef2f2'],
        'selesai'  => ['badge' => 'badge-green',  'label' => 'Selesai',  'color' => '#15803d', 'bg' => '#f0fdf4'],
        default    => ['badge' => 'badge-yellow', 'label' => 'Pending',  'color' => '#b45309', 'bg' => '#fffbeb'],
    };

    $isBuyer  = auth()->id() === $order->buyer_id;
    $isAdmin  = auth()->user()?->role === 'admin';
    $orderKode = 'VSKL-' . str_pad($order->id, 5, '0', STR_PAD_LEFT);

    // WA number formatting
    $waNum = null;
    if ($order->seller?->profile?->kontak_wa) {
        $waNum = preg_replace('/[^0-9]/', '', $order->seller->profile->kontak_wa);
        if (str_starts_with($waNum, '0')) $waNum = '62' . substr($waNum, 1);
    }

    // Steps
    $steps = ['pending', 'diterima', 'selesai'];
    $currentStepIdx = match($st) {
        'diterima' => 1,
        'selesai'  => 2,
        'ditolak'  => -1,
        default    => 0,
    };
@endphp

<section class="odt-page">

    {{-- Back link --}}
    <a href="{{ $isBuyer ? route('pesanan') : route('order.masuk') }}" class="pd-back-chip">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Kembali ke {{ $isBuyer ? 'Pesanan Saya' : 'Order Masuk' }}
    </a>

    {{-- Status Hero --}}
    <div class="odt-status-hero" style="background:{{ $statusMeta['bg'] }};border-color:{{ $statusMeta['color'] }}33;">
        <span class="badge {{ $statusMeta['badge'] }}" style="font-size:.9rem;padding:.45rem 1.25rem;">
            <span class="ol-dot {{ $st }}" style="width:10px;height:10px;"></span>
            {{ $statusMeta['label'] }}
        </span>
        <h1 class="odt-status-title">Detail Order</h1>
        <p class="odt-status-sub">
            No. Order: <strong>{{ $orderKode }}</strong> &bull;
            Jasa: <strong>{{ $order->service->judul_jasa ?? 'Tidak tersedia' }}</strong>
        </p>
    </div>

    {{-- Progress Timeline --}}
    @if($st !== 'ditolak')
        <div class="odt-timeline">
            @foreach($steps as $i => $step)
                <div class="odt-step {{ $i <= $currentStepIdx ? 'done' : '' }} {{ $i === $currentStepIdx ? 'current' : '' }}">
                    <div class="odt-step-circle">
                        @if($i < $currentStepIdx)
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                        @else
                            {{ $i + 1 }}
                        @endif
                    </div>
                    <span class="odt-step-label">{{ ucfirst($step) }}</span>
                </div>
                @if($i < count($steps) - 1)
                    <div class="odt-step-line {{ $i < $currentStepIdx ? 'done' : '' }}"></div>
                @endif
            @endforeach
        </div>
    @else
        <div class="odt-rejected-banner">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            Order ini telah ditolak oleh penyedia.
        </div>
    @endif

    {{-- Two-column layout --}}
    <div class="odt-layout">

        {{-- LEFT: Info --}}
        <div class="odt-main">

            {{-- Buyer Info --}}
            <div class="odt-card">
                <div class="odt-card-head">
                    <div class="odt-card-icon buyer">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <h2>Info Pembeli</h2>
                </div>
                <div class="odt-info-list">
                    <div class="odt-info-row"><span>Nama</span><strong>{{ $order->buyer->nama_lengkap ?? '-' }}</strong></div>
                    <div class="odt-info-row"><span>Username</span><strong>{{ $order->buyer->username ?? '-' }}</strong></div>
                    <div class="odt-info-row"><span>Email</span><strong>{{ $order->buyer->email ?? '-' }}</strong></div>
                    <div class="odt-info-row"><span>Prodi</span><strong>{{ $order->buyer->profile?->prodi ?? '-' }}</strong></div>
                    <div class="odt-info-row"><span>No. WA</span><strong>{{ $order->no_wa }}</strong></div>
                </div>
            </div>

            {{-- Seller Info --}}
            <div class="odt-card">
                <div class="odt-card-head">
                    <div class="odt-card-icon seller">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                    </div>
                    <h2>Info Penyedia</h2>
                </div>
                <div class="odt-info-list">
                    <div class="odt-info-row"><span>Nama</span><strong>{{ $order->seller->nama_lengkap ?? '-' }}</strong></div>
                    <div class="odt-info-row"><span>Username</span><strong>{{ $order->seller->username ?? '-' }}</strong></div>
                    <div class="odt-info-row"><span>Email</span><strong>{{ $order->seller->email ?? '-' }}</strong></div>
                    <div class="odt-info-row"><span>Prodi</span><strong>{{ $order->seller->profile?->prodi ?? '-' }}</strong></div>
                    <div class="odt-info-row">
                        <span>Kontak WA</span>
                        <strong>
                            @if($waNum)
                                <a href="https://wa.me/{{ $waNum }}" target="_blank" class="odt-wa-link">
                                    {{ $order->seller->profile->kontak_wa }}
                                </a>
                            @else
                                -
                            @endif
                        </strong>
                    </div>
                </div>
            </div>

            {{-- Notes --}}
            <div class="odt-card">
                <div class="odt-card-head">
                    <div class="odt-card-icon notes">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                    <h2>Catatan Kebutuhan</h2>
                </div>
                <div class="odt-notes-body">
                    {{ $order->catatan }}
                </div>
            </div>

        </div>

        {{-- RIGHT: Sticky Sidebar --}}
        <aside class="odt-sidebar">
            <div class="odt-sidebar-card">

                {{-- Service Summary --}}
                <div class="odt-svc-summary">
                    <div class="odt-svc-header">
                        <span class="badge badge-green" style="font-size:.72rem;">{{ $order->service->kategori ?? '-' }}</span>
                    </div>
                    <h3 class="odt-svc-title">{{ $order->service->judul_jasa ?? 'Jasa tidak tersedia' }}</h3>
                    <div class="odt-svc-price">
                        <span>Estimasi Harga</span>
                        <strong>Rp {{ number_format($order->service->harga ?? 0, 0, ',', '.') }}</strong>
                    </div>
                    @if($order->service?->estimasi_pengerjaan)
                        <div class="odt-svc-est">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            {{ $order->service->estimasi_pengerjaan }}
                        </div>
                    @endif
                </div>

                <div class="odt-info-row" style="margin:.75rem 0;padding:.75rem 0;border-top:1px solid var(--vs-border);border-bottom:1px solid var(--vs-border);">
                    <span style="font-size:.78rem;color:var(--vs-muted);">Tanggal Order</span>
                    <strong style="font-size:.82rem;">{{ $order->created_at ? $order->created_at->format('d M Y, H:i') : '-' }}</strong>
                </div>

                {{-- Actions --}}
                <div class="odt-actions">
                    @if($st === 'selesai' && $order->konfirmasi_pembeli)
                        <a href="{{ route('order.struk', $order) }}" class="btn-primary w-full">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            Unduh Struk Pembelian
                        </a>
                    @endif

                    @if($waNum)
                        <a href="https://wa.me/{{ $waNum }}" target="_blank" rel="noopener noreferrer" class="odt-wa-btn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.554 4.116 1.528 5.844L0 24l6.336-1.508A11.938 11.938 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.013-1.376l-.36-.214-3.727.977.994-3.634-.234-.373A9.818 9.818 0 1112 21.818z"/></svg>
                            Chat Penyedia via WhatsApp
                        </a>
                    @endif

                    @if($order->service)
                        <a href="{{ route('detail', $order->service) }}" class="btn-outline w-full">
                            Lihat Detail Jasa
                        </a>
                    @endif

                    @if($order->seller)
                        <a href="{{ route('profile.view', $order->seller) }}" class="btn-outline w-full">
                            Lihat Profil Penyedia
                        </a>
                    @endif
                </div>

                {{-- Buyer: konfirmasi selesai (sebelum rating) --}}
                @if($isBuyer && $st === 'selesai' && !$order->konfirmasi_pembeli)
                    <div class="odt-konfirmasi-box">
                        <p class="odt-konfirmasi-title">Konfirmasi Penyelesaian</p>
                        <p class="odt-konfirmasi-sub">Penyedia sudah menandai order selesai. Apakah kamu sudah menerima hasil kerjanya?</p>
                        <form method="POST" action="{{ route('order.konfirmasi', $order) }}">
                            @csrf
                            <button type="submit" class="odt-manage-btn complete w-full"
                                    onclick="return confirm('Konfirmasi bahwa order ini sudah selesai?')">
                                ✓ Konfirmasi Selesai
                            </button>
                        </form>
                    </div>
                @endif

                {{-- Rating form: buyer, selesai, sudah konfirmasi --}}
                @if($isBuyer && $st === 'selesai' && $order->konfirmasi_pembeli)
                    @if($order->rating)
                        <div class="odt-rating-done">
                            <p class="odt-rating-done-label">Rating kamu</p>
                            <div class="rt-stars-display">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="rt-star {{ $i <= $order->rating->rating ? 'filled' : '' }}" viewBox="0 0 24 24" width="20" height="20"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>
                                @endfor
                                <span class="rt-score-num">{{ number_format($order->rating->rating, 1) }}</span>
                            </div>
                            @if($order->rating->ulasan)
                                <p class="odt-rating-ulasan">"{{ $order->rating->ulasan }}"</p>
                            @endif
                        </div>
                    @else
                        <div class="odt-rating-box">
                            <p class="odt-rating-title">Beri Rating Penyedia</p>
                            <p class="odt-rating-sub">Bagaimana pengalaman kamu dengan jasa ini?</p>
                            <form method="POST" action="{{ route('rating.store', $order) }}">
                                @csrf
                                <div class="rt-star-picker">
                                    @for($i = 5; $i >= 1; $i--)
                                        <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" required>
                                        <label for="star{{ $i }}" title="{{ $i }} bintang">
                                            <svg viewBox="0 0 24 24" width="28" height="28"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>
                                        </label>
                                    @endfor
                                </div>
                                <textarea name="ulasan" class="rt-ulasan-input" rows="3"
                                          placeholder="Tulis ulasan singkat (opsional)..." maxlength="500"></textarea>
                                <button type="submit" class="rt-submit-btn">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                                    Kirim Rating
                                </button>
                            </form>
                        </div>
                    @endif
                @endif

                {{-- Seller management (disembunyikan dari admin) --}}
                @if(!$isBuyer && !$isAdmin)
                    <div class="odt-seller-manage">
                        <p class="odt-manage-title">Kelola Order</p>
                        @if($st === 'pending')
                            <form method="POST" action="{{ route('order.status', $order) }}">
                                @csrf
                                <div class="odt-manage-btns">
                                    <button type="submit" name="status" value="diterima" class="odt-manage-btn accept">
                                        ✓ Terima
                                    </button>
                                    <button type="submit" name="status" value="ditolak" class="odt-manage-btn reject"
                                            onclick="return confirm('Yakin tolak order ini?')">
                                        ✗ Tolak
                                    </button>
                                </div>
                            </form>
                        @elseif($st === 'diterima')
                            <form method="POST" action="{{ route('order.status', $order) }}">
                                @csrf
                                <input type="hidden" name="status" value="selesai">
                                <button type="submit" class="odt-manage-btn complete w-full">
                                    ✓ Tandai Selesai
                                </button>
                            </form>
                        @elseif($st === 'selesai')
                            @if($order->konfirmasi_pembeli)
                                <div class="odt-manage-note completed">Order selesai &amp; dikonfirmasi pembeli.</div>
                            @else
                                <div class="odt-manage-note completed" style="background:#fffbeb;border-color:#fde68a;color:#92400e;">
                                    Menunggu konfirmasi dari pembeli.
                                </div>
                            @endif
                        @elseif($st === 'ditolak')
                            <div class="odt-manage-note rejected">Order telah ditolak.</div>
                        @endif
                    </div>
                @endif

                {{-- Info untuk admin --}}
                @if($isAdmin)
                    <div class="odt-seller-manage">
                        <p class="odt-manage-title">Info Admin</p>
                        <div class="odt-manage-note completed" style="text-align:center;">
                            Konfirmasi Pembeli: <strong>{{ $order->konfirmasi_pembeli ? 'Sudah' : 'Belum' }}</strong>
                        </div>
                    </div>
                @endif

            </div>
        </aside>
    </div>
</section>
@endsection
