@extends('layouts.app')

@section('title', 'Detail Jasa | V-Skill')

@section('content')
    <section class="service-detail-page">
        <a href="{{ route('dashboard') }}" class="detail-back-link">
            ← Kembali ke Dashboard Jasa
        </a>

        <div class="service-detail-card">
            <div class="service-detail-badges">
                <span class="badge badge-green">
                    {{ $service->kategori }}
                </span>

                <span class="badge badge-yellow">
                    {{ ucfirst($service->status) }}
                </span>
            </div>

            <h1 class="service-detail-title">
                {{ $service->judul_jasa }}
            </h1>

            <p class="service-provider">
                {{ $service->user->nama_lengkap }}

                @if($service->user->profile?->prodi)
                    • {{ $service->user->profile->prodi }}
                @endif
            </p>

            <div class="detail-info-grid">
                <div class="detail-info-box">
                    <span>Harga</span>

                    <strong>
                        Rp {{ number_format($service->harga, 0, ',', '.') }}
                    </strong>
                </div>

                <div class="detail-info-box">
                    <span>Estimasi Pengerjaan</span>

                    <strong>
                        {{ $service->estimasi_pengerjaan ?? '-' }}
                    </strong>
                </div>

                <div class="detail-info-box">
                    <span>Kategori</span>

                    <strong>
                        {{ $service->kategori }}
                    </strong>
                </div>
            </div>

            <div class="detail-description-section">
                <h2>
                    Deskripsi Jasa
                </h2>

                <div class="detail-description-box">
                    {{ $service->deskripsi }}
                </div>
            </div>

            <div class="detail-actions">
                @auth
                    @if(auth()->id() !== $service->user_id)
                        <a href="{{ route('order.create', $service) }}" class="btn-primary">
                            Pesan Jasa
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-primary">
                        Login untuk Pesan
                    </a>
                @endauth

                <a href="{{ route('profile.view', $service->user) }}" class="btn-outline">
                    Lihat Profil Penyedia
                </a>
            </div>
        </div>
    </section>
@endsection