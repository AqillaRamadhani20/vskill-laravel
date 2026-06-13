@extends('layouts.app')

@section('title', $mode === 'seller' ? 'Order Masuk' : 'Pesanan Saya')

@section('content')
    <section class="orders-page">
        <div class="orders-header">
            <h1 class="page-title">{{ $mode === 'seller' ? 'Order Masuk' : 'Pesanan Saya' }}</h1>
            <p>{{ $mode === 'seller' ? 'Daftar order yang masuk ke jasa milikmu.' : 'Daftar pesanan jasa yang sudah kamu buat.' }}</p>
        </div>

        <div class="order-filter-tabs">
            <a href="{{ request()->url() }}" class="{{ request('status') === null ? 'active' : '' }}">Semua</a>
            @foreach(['pending', 'diterima', 'ditolak', 'selesai'] as $status)
                <a href="{{ request()->fullUrlWithQuery(['status' => $status]) }}" class="{{ request('status') === $status ? 'active' : '' }}">{{ ucfirst($status) }}</a>
            @endforeach
        </div>

        <div class="order-list">
            @forelse($orders as $order)
                @php
                    $statusClass = match ($order->status) {
                        'diterima' => 'badge-blue',
                        'ditolak' => 'badge-red',
                        'selesai' => 'badge-green',
                        default => 'badge-yellow',
                    };
                @endphp

                <article class="order-card-modern">
                    <div class="order-card-top">
                        <div>
                            <div class="service-badges">
                                <span class="badge badge-green">{{ $order->service->kategori ?? '-' }}</span>
                                <span class="badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                            </div>

                            <h2>{{ $order->service->judul_jasa ?? '-' }}</h2>
                            <p class="order-buyer">
                                {{ $mode === 'seller'
                                    ? 'Pembeli: ' . ($order->buyer->nama_lengkap ?? '-')
                                    : 'Penyedia: ' . ($order->seller->nama_lengkap ?? '-') }}
                            </p>
                        </div>

                        <div class="order-price-box">
                            <span>Harga Jasa</span>
                            <strong>Rp {{ number_format($order->service->harga ?? 0, 0, ',', '.') }}</strong>
                        </div>
                    </div>

                    <div class="order-info-grid">
                        <div class="order-info-box">
                            <span>Nomor WhatsApp {{ $mode === 'seller' ? 'Pembeli' : 'Penyedia' }}</span>
                            <strong>{{ $order->no_wa }}</strong>
                        </div>
                        <div class="order-info-box">
                            <span>Tanggal Order</span>
                            <strong>{{ $order->created_at ? $order->created_at->format('d M Y, H:i') : '-' }}</strong>
                        </div>
                    </div>

                    <div class="order-note-box">
                        <span>Catatan Kebutuhan</span>
                        <p>{{ $order->catatan }}</p>
                    </div>

                    <div class="order-actions">
                        <a href="{{ route('order.detail', $order) }}" class="btn-small-primary">Detail Order</a>

                        @if($mode === 'buyer' && $order->status === 'selesai')
                            <a href="{{ route('order.struk', $order) }}" class="btn-small-outline green">
                                &#128196; Unduh Struk
                            </a>
                        @endif

                        @if($mode === 'seller' && $order->buyer)
                            <a href="{{ route('profile.view', $order->buyer) }}" class="btn-small-outline green">Lihat Profil Pembeli</a>
                        @elseif($mode === 'buyer' && $order->seller)
                            <a href="{{ route('profile.view', $order->seller) }}" class="btn-small-outline green">Lihat Profil Penyedia</a>
                        @endif
                    </div>

                    @if($mode === 'seller')
                        @if($order->status === 'pending')
                            <form method="POST" action="{{ route('order.status', $order) }}" class="order-status-form-modern">
                                @csrf
                                <select name="status" class="form-control order-status-select" required>
                                    <option value="diterima">Terima Order</option>
                                    <option value="ditolak">Tolak Order</option>
                                </select>
                                <button type="submit" class="btn-primary">Update Status</button>
                            </form>
                        @elseif($order->status === 'diterima')
                            <form method="POST" action="{{ route('order.status', $order) }}" class="order-status-form-modern">
                                @csrf
                                <input type="hidden" name="status" value="selesai">
                                <button type="submit" class="btn-primary">Tandai Selesai</button>
                            </form>
                        @elseif($order->status === 'ditolak')
                            <div class="order-final-note rejected">Order ditolak dan tidak bisa diubah lagi.</div>
                        @elseif($order->status === 'selesai')
                            <div class="order-final-note completed">Order sudah selesai.</div>
                        @endif
                    @endif
                </article>
            @empty
                <div class="empty-state">
                    <h2>Belum Ada Order</h2>
                    <p>Belum ada order yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
