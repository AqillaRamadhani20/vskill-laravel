@extends('layouts.app')

@section('title', $mode === 'seller' ? 'Order Masuk | V-Skill' : 'Pesanan Saya | V-Skill')

@section('content')
<section class="ol-page">

    {{-- Page Header --}}
    <div class="ol-header">
        <div class="ol-header-left">
            <div class="ol-header-icon">
                @if($mode === 'seller')
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                @else
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                @endif
            </div>
            <div>
                <h1 class="ol-title">{{ $mode === 'seller' ? 'Order Masuk' : 'Pesanan Saya' }}</h1>
                <p class="ol-subtitle">{{ $mode === 'seller' ? 'Daftar order yang masuk ke jasa milikmu' : 'Daftar pesanan jasa yang sudah kamu buat' }}</p>
            </div>
        </div>
        <span class="ol-count-badge">{{ $orders->count() }} Order</span>
    </div>

    {{-- Filter Tabs --}}
    <div class="ol-filter-tabs">
        <a href="{{ request()->url() }}"
           class="ol-tab {{ request('status') === null ? 'active' : '' }}">
            <span class="ol-tab-dot all"></span>
            Semua
            <span class="ol-tab-count">{{ $orders->count() }}</span>
        </a>
        @foreach([
            'pending'  => ['label' => 'Pending',  'class' => 'yellow'],
            'diterima' => ['label' => 'Diterima', 'class' => 'blue'],
            'ditolak'  => ['label' => 'Ditolak',  'class' => 'red'],
            'selesai'  => ['label' => 'Selesai',  'class' => 'green'],
        ] as $s => $meta)
            <a href="{{ request()->fullUrlWithQuery(['status' => $s]) }}"
               class="ol-tab {{ request('status') === $s ? 'active' : '' }} {{ $meta['class'] }}">
                <span class="ol-tab-dot {{ $meta['class'] }}"></span>
                {{ $meta['label'] }}
            </a>
        @endforeach
    </div>

    {{-- Order List --}}
    <div class="ol-list">
        @forelse($orders as $order)
            @php
                $st = $order->status;
                $statusMeta = match($st) {
                    'diterima' => ['badge' => 'badge-blue',   'border' => 'ol-border-blue',   'label' => 'Diterima'],
                    'ditolak'  => ['badge' => 'badge-red',    'border' => 'ol-border-red',    'label' => 'Ditolak'],
                    'selesai'  => ['badge' => 'badge-green',  'border' => 'ol-border-green',  'label' => 'Selesai'],
                    default    => ['badge' => 'badge-yellow', 'border' => 'ol-border-yellow', 'label' => 'Pending'],
                };
            @endphp

            <article class="ol-card {{ $statusMeta['border'] }}">
                {{-- Card Top --}}
                <div class="ol-card-top">
                    <div class="ol-card-meta">
                        <div class="ol-card-badges">
                            <span class="badge badge-green">{{ $order->service->kategori ?? '-' }}</span>
                            <span class="badge {{ $statusMeta['badge'] }}">
                                <span class="ol-dot {{ $st }}"></span>
                                {{ $statusMeta['label'] }}
                            </span>
                        </div>
                        <h2 class="ol-card-title">{{ $order->service->judul_jasa ?? 'Jasa tidak tersedia' }}</h2>
                        <p class="ol-card-person">
                            {{ $mode === 'seller' ? '👤 Pembeli: ' : '🛠️ Penyedia: ' }}
                            <strong>{{ $mode === 'seller' ? ($order->buyer->nama_lengkap ?? '-') : ($order->seller->nama_lengkap ?? '-') }}</strong>
                        </p>
                    </div>
                    <div class="ol-price-box">
                        <span>Harga</span>
                        <strong>Rp {{ number_format($order->service->harga ?? 0, 0, ',', '.') }}</strong>
                    </div>
                </div>

                {{-- Card Middle --}}
                <div class="ol-card-middle">
                    <div class="ol-info-item">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.63 3.44 2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.96a16 16 0 0 0 6 6l.91-.91a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.73 17z"/></svg>
                        <span>WA {{ $mode === 'seller' ? 'Pembeli' : '' }}: <strong>{{ $order->no_wa }}</strong></span>
                    </div>
                    <div class="ol-info-item">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <span>{{ $order->created_at ? $order->created_at->format('d M Y, H:i') : '-' }}</span>
                    </div>
                </div>

                {{-- Catatan --}}
                @if($order->catatan)
                    <div class="ol-note-box">
                        <span class="ol-note-label">Catatan Kebutuhan</span>
                        <p class="ol-note-text">{{ mb_strlen($order->catatan) > 150 ? mb_substr($order->catatan, 0, 150) . '...' : $order->catatan }}</p>
                    </div>
                @endif

                {{-- Actions --}}
                <div class="ol-card-actions">
                    <a href="{{ route('order.detail', $order) }}" class="ol-btn-detail">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        Detail Order
                    </a>

                    @if($mode === 'buyer' && $order->status === 'selesai')
                        <a href="{{ route('order.struk', $order) }}" class="ol-btn-struk">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            Unduh Struk
                        </a>
                    @endif

                    @if($mode === 'buyer' && $order->seller?->profile?->kontak_wa)
                        @php
                            $waNum = preg_replace('/[^0-9]/', '', $order->seller->profile->kontak_wa);
                            if (str_starts_with($waNum, '0')) $waNum = '62' . substr($waNum, 1);
                        @endphp
                        <a href="https://wa.me/{{ $waNum }}" target="_blank" rel="noopener" class="ol-btn-wa">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.554 4.116 1.528 5.844L0 24l6.336-1.508A11.938 11.938 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.013-1.376l-.36-.214-3.727.977.994-3.634-.234-.373A9.818 9.818 0 1112 21.818z"/></svg>
                            Chat Penyedia
                        </a>
                    @endif

                    @if($mode === 'seller')
                        @php
                            $waNumBuyer = preg_replace('/[^0-9]/', '', $order->no_wa ?? '');
                            if (str_starts_with($waNumBuyer, '0')) $waNumBuyer = '62' . substr($waNumBuyer, 1);
                        @endphp
                        @if($waNumBuyer)
                            <a href="https://wa.me/{{ $waNumBuyer }}" target="_blank" rel="noopener" class="ol-btn-wa">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.554 4.116 1.528 5.844L0 24l6.336-1.508A11.938 11.938 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.013-1.376l-.36-.214-3.727.977.994-3.634-.234-.373A9.818 9.818 0 1112 21.818z"/></svg>
                                Chat Pembeli
                            </a>
                        @endif
                    @endif

                    @if($mode === 'seller' && $order->buyer)
                        <a href="{{ route('profile.view', $order->buyer) }}" class="ol-btn-profile">Profil Pembeli</a>
                    @elseif($mode === 'buyer' && $order->seller)
                        <a href="{{ route('profile.view', $order->seller) }}" class="ol-btn-profile">Profil Penyedia</a>
                    @endif
                </div>

                {{-- Seller status management --}}
                @if($mode === 'seller')
                    @if($order->status === 'pending')
                        <form method="POST" action="{{ route('order.status', $order) }}" class="ol-status-form">
                            @csrf
                            <p class="ol-status-label">Update Status Order:</p>
                            <div class="ol-status-btns">
                                <button type="submit" name="status" value="diterima" class="ol-status-btn accept">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                                    Terima Order
                                </button>
                                <button type="submit" name="status" value="ditolak" class="ol-status-btn reject"
                                        onclick="return confirm('Yakin ingin menolak order ini?')">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                    Tolak Order
                                </button>
                            </div>
                        </form>
                    @elseif($order->status === 'diterima')
                        <form method="POST" action="{{ route('order.status', $order) }}" class="ol-status-form">
                            @csrf
                            <input type="hidden" name="status" value="selesai">
                            <div class="ol-status-btns">
                                <button type="submit" class="ol-status-btn complete">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                    Tandai Selesai
                                </button>
                            </div>
                        </form>
                    @elseif($order->status === 'ditolak')
                        <div class="ol-final-note rejected">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            Order ini telah ditolak dan tidak dapat diubah lagi.
                        </div>
                    @elseif($order->status === 'selesai')
                        <div class="ol-final-note completed">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            Order ini sudah selesai. Kerja bagus!
                        </div>
                    @endif
                @endif
            </article>
        @empty
            <div class="ol-empty">
                <div class="ol-empty-icon">📋</div>
                <h3 class="ol-empty-title">Belum Ada Order</h3>
                <p class="ol-empty-sub">
                    {{ $mode === 'seller'
                        ? 'Belum ada order yang masuk. Pastikan jasamu aktif agar mudah ditemukan.'
                        : 'Kamu belum pernah memesan jasa. Mulai jelajahi dan temukan jasa yang kamu butuhkan!' }}
                </p>
                <a href="{{ route('dashboard') }}" class="btn-primary" style="margin-top:1.25rem;display:inline-flex;align-items:center;gap:.5rem;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    Jelajahi Jasa
                </a>
            </div>
        @endforelse
    </div>
</section>
@endsection
