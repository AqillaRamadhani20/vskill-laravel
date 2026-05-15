@extends('layouts.app')

@section('title', 'Detail Order | V-Skill')

@section('content')
    @php
        $statusClass = match ($order->status) {
            'diterima' => 'badge-blue',
            'ditolak' => 'badge-red',
            'selesai' => 'badge-green',
            default => 'badge-yellow',
        };
    @endphp

    <section class="order-detail-page">
        <a href="{{ auth()->id() === $order->buyer_id ? route('pesanan') : route('order.masuk') }}" class="detail-back-link">
            ← Kembali ke {{ auth()->id() === $order->buyer_id ? 'Pesanan Saya' : 'Order Masuk' }}
        </a>

        <div class="order-detail-card">
            <div class="service-badges">
                <span class="badge badge-green">{{ $order->service->kategori ?? '-' }}</span>
                <span class="badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
            </div>

            <h1>Detail Order</h1>
            <p class="order-detail-subtitle">Order untuk jasa <strong>{{ $order->service->judul_jasa ?? '-' }}</strong></p>

            <div class="detail-info-grid">
                <div class="detail-info-box">
                    <span>Harga Jasa</span>
                    <strong>Rp {{ number_format($order->service->harga ?? 0, 0, ',', '.') }}</strong>
                </div>

                <div class="detail-info-box">
                    <span>Estimasi Pengerjaan</span>
                    <strong>{{ $order->service->estimasi_pengerjaan ?: '-' }}</strong>
                </div>
            </div>

            <div class="order-detail-grid">
                <div class="order-detail-info-card">
                    <h2>Info Pembeli</h2>
                    <p><strong>Nama:</strong> {{ $order->buyer->nama_lengkap ?? '-' }}</p>
                    <p><strong>Username:</strong> {{ $order->buyer->username ?? '-' }}</p>
                    <p><strong>Email:</strong> {{ $order->buyer->email ?? '-' }}</p>
                    <p><strong>Prodi:</strong> {{ $order->buyer->profile->prodi ?? '-' }}</p>
                    <p><strong>No. WA:</strong> {{ $order->no_wa }}</p>
                </div>

                <div class="order-detail-info-card">
                    <h2>Info Penyedia</h2>
                    <p><strong>Nama:</strong> {{ $order->seller->nama_lengkap ?? '-' }}</p>
                    <p><strong>Username:</strong> {{ $order->seller->username ?? '-' }}</p>
                    <p><strong>Email:</strong> {{ $order->seller->email ?? '-' }}</p>
                    <p><strong>Prodi:</strong> {{ $order->seller->profile->prodi ?? '-' }}</p>
                    <p><strong>Kontak WA:</strong> {{ $order->seller->profile->kontak_wa ?? '-' }}</p>
                </div>
            </div>

            <div class="order-detail-info-card full">
                <h2>Catatan Kebutuhan</h2>
                <p>{{ $order->catatan }}</p>
            </div>

            <div class="order-detail-info-card full">
                <h2>Informasi Tambahan</h2>
                <p><strong>Tanggal Order:</strong> {{ $order->created_at ? $order->created_at->format('d M Y, H:i') : '-' }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            </div>

            <div class="detail-actions">
                @if($order->service)
                    <a href="{{ route('detail', $order->service) }}" class="btn-primary">Lihat Detail Jasa</a>
                @endif
                @if($order->seller)
                    <a href="{{ route('profile.view', $order->seller) }}" class="btn-outline">Lihat Profil Penyedia</a>
                @endif
            </div>
        </div>
    </section>
@endsection
