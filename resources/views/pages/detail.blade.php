@extends('layouts.app')

@section('title', $service->judul_jasa . ' | V-Skill')

@section('content')
@php
    $statusBadge  = $service->status === 'aktif' ? 'badge-green' : 'badge-red';
    $statusLabel  = ucfirst($service->status);
    $provFoto     = $service->user->profile?->foto;
    $hasFoto      = $provFoto && $provFoto !== 'default.jpg';
    $provFotoUrl  = $hasFoto ? asset('storage/foto-profil/' . $provFoto) : null;
    $provInitial  = strtoupper(substr($service->user->nama_lengkap, 0, 1));
    $avgRating    = $service->avgRating();
    $ratingCount  = $service->ratingCount();
@endphp

<section class="pd-page">

    {{-- Back chip --}}
    <a href="{{ route('dashboard') }}" class="pd-back-chip">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Kembali ke Marketplace
    </a>

    {{-- Hero area --}}
    <div class="pd-hero">
        <div class="pd-hero-accent"></div>
        <div class="pd-hero-inner">
            <div class="pd-hero-badges">
                <span class="badge badge-green">{{ $service->kategori }}</span>
                <span class="badge {{ $statusBadge }}">
                    <span class="pd-status-dot {{ $service->status === 'aktif' ? 'aktif' : 'nonaktif' }}"></span>
                    {{ $statusLabel }}
                </span>
            </div>
            <h1 class="pd-hero-title">{{ $service->judul_jasa }}</h1>

            @if($ratingCount > 0)
                <div class="rt-hero-rating">
                    <div class="rt-stars-display">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="rt-star {{ $i <= round($avgRating) ? 'filled' : '' }}" viewBox="0 0 24 24" width="16" height="16"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>
                        @endfor
                    </div>
                    <span class="rt-hero-score">{{ number_format($avgRating, 1) }}</span>
                    <span class="rt-hero-count">({{ $ratingCount }} ulasan)</span>
                </div>
            @endif

            <p class="pd-hero-provider">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                {{ $service->user->nama_lengkap }}
                @if($service->user->profile?->prodi)
                    &bull; {{ $service->user->profile->prodi }}
                @endif
            </p>
        </div>
    </div>

    {{-- Two-column layout --}}
    <div class="pd-layout">

        {{-- LEFT: Main content --}}
        <div class="pd-main">

            {{-- Description card --}}
            <div class="pd-card pd-desc-card">
                <div class="pd-card-header">
                    <div class="pd-card-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    </div>
                    <h2 class="pd-card-title">Deskripsi Jasa</h2>
                </div>
                <div class="pd-desc-body">
                    {{ $service->deskripsi }}
                </div>
            </div>

            {{-- Info boxes row --}}
            <div class="pd-info-row">
                <div class="pd-info-box">
                    <div class="pd-info-icon">💰</div>
                    <span class="pd-info-label">Harga</span>
                    <strong class="pd-info-value green">Rp {{ number_format($service->harga, 0, ',', '.') }}</strong>
                </div>
                <div class="pd-info-box">
                    <div class="pd-info-icon">⏱️</div>
                    <span class="pd-info-label">Estimasi Pengerjaan</span>
                    <strong class="pd-info-value">{{ $service->estimasi_pengerjaan ?? 'Diskusi' }}</strong>
                </div>
                <div class="pd-info-box">
                    <div class="pd-info-icon">🏷️</div>
                    <span class="pd-info-label">Kategori</span>
                    <strong class="pd-info-value">{{ $service->kategori }}</strong>
                </div>
            </div>

            {{-- Provider card --}}
            <div class="pd-card pd-provider-card">
                <div class="pd-card-header">
                    <div class="pd-card-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <h2 class="pd-card-title">Tentang Penyedia</h2>
                </div>

                <div class="pd-provider-inner">
                    <div class="pd-provider-avatar-wrap">
                        @if($provFotoUrl)
                            <img src="{{ $provFotoUrl }}" alt="{{ $service->user->nama_lengkap }}"
                                 class="pd-provider-photo"
                                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                        @endif
                        <div class="pd-provider-avatar-placeholder"
                             style="{{ $provFotoUrl ? 'display:none' : '' }}">
                            {{ $provInitial }}
                        </div>
                    </div>
                    <div class="pd-provider-info">
                        <h3 class="pd-provider-name">{{ $service->user->nama_lengkap }}</h3>
                        @if($service->user->profile?->prodi)
                            <p class="pd-provider-prodi">{{ $service->user->profile->prodi }}</p>
                        @endif
                        @if($service->user->profile?->bio)
                            <p class="pd-provider-bio">{{ $service->user->profile->bio }}</p>
                        @endif
                        @if($service->user->profile?->skill_summary)
                            <div class="pd-skills-wrap">
                                @foreach(array_slice(array_map('trim', explode(',', $service->user->profile->skill_summary)), 0, 5) as $skill)
                                    <span class="pd-skill-tag">{{ $skill }}</span>
                                @endforeach
                            </div>
                        @endif
                        <a href="{{ route('profile.view', $service->user) }}" class="pd-provider-link">
                            Lihat Profil Lengkap &rarr;
                        </a>
                    </div>
                </div>
            </div>

            {{-- Ulasan / Reviews --}}
            <div class="pd-card">
                <div class="pd-card-header">
                    <div class="pd-card-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                    <h2 class="pd-card-title">
                        Ulasan Pembeli
                        @if($ratingCount > 0)
                            <span class="rt-card-avg">
                                <svg class="rt-star filled" viewBox="0 0 24 24" width="14" height="14"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>
                                {{ number_format($avgRating, 1) }} &bull; {{ $ratingCount }} ulasan
                            </span>
                        @endif
                    </h2>
                </div>

                @forelse($service->ratings->sortByDesc('created_at') as $rev)
                    <div class="rt-review-item">
                        <div class="rt-review-top">
                            <div class="rt-review-avatar" style="background:linear-gradient(135deg,#15803d,#22c55e);">
                                @php
                                    $revFoto = $rev->buyer->profile?->foto;
                                    $revHasFoto = $revFoto && $revFoto !== 'default.jpg';
                                    $revFotoUrl = $revHasFoto ? asset('storage/foto-profil/' . $revFoto) : null;
                                @endphp
                                @if($revFotoUrl)
                                    <img src="{{ $revFotoUrl }}" alt="{{ $rev->buyer->nama_lengkap }}"
                                         class="rt-review-avatar-img"
                                         onerror="this.style.display='none';">
                                @else
                                    {{ strtoupper(substr($rev->buyer->nama_lengkap, 0, 1)) }}
                                @endif
                            </div>
                            <div class="rt-review-meta">
                                <p class="rt-review-name">{{ $rev->buyer->nama_lengkap }}</p>
                                <div class="rt-stars-display">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="rt-star {{ $i <= $rev->rating ? 'filled' : '' }}" viewBox="0 0 24 24" width="13" height="13"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>
                                    @endfor
                                    <span class="rt-review-date">{{ $rev->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        @if($rev->ulasan)
                            <p class="rt-review-text">{{ $rev->ulasan }}</p>
                        @endif
                    </div>
                @empty
                    <div class="rt-empty-review">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" style="opacity:.3;"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>
                        <p>Belum ada ulasan untuk jasa ini.</p>
                    </div>
                @endforelse
            </div>

        </div>

        {{-- RIGHT: Sticky sidebar --}}
        <aside class="pd-sidebar">
            <div class="pd-price-card">
                <div class="pd-price-header">
                    <span class="pd-price-label">Harga Jasa</span>
                    <strong class="pd-price-value">Rp {{ number_format($service->harga, 0, ',', '.') }}</strong>
                </div>

                <div class="pd-price-meta">
                    <div class="pd-price-meta-item">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <span>Estimasi: <strong>{{ $service->estimasi_pengerjaan ?? 'Diskusi' }}</strong></span>
                    </div>
                    <div class="pd-price-meta-item">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        <span>Kategori: <strong>{{ $service->kategori }}</strong></span>
                    </div>
                </div>

                @auth
                    @if(auth()->id() !== $service->user_id)
                        <a href="{{ route('order.create', $service) }}" class="pd-order-btn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                            Pesan Jasa Sekarang
                        </a>
                    @else
                        <div class="pd-own-note">Ini adalah jasamu sendiri.</div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="pd-order-btn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                        Login untuk Memesan
                    </a>
                @endauth

                <a href="{{ route('profile.view', $service->user) }}" class="pd-profile-btn">
                    Lihat Profil Penyedia
                </a>

                {{-- Quick provider info --}}
                <div class="pd-sidebar-provider">
                    <div class="pd-sidebar-avatar" style="background:linear-gradient(135deg,#15803d,#22c55e);">
                        @if($provFotoUrl)
                            <img src="{{ $provFotoUrl }}" alt="{{ $service->user->nama_lengkap }}"
                                 class="pd-sidebar-avatar-img"
                                 onerror="this.style.display='none';">
                        @else
                            {{ $provInitial }}
                        @endif
                    </div>
                    <div>
                        <p class="pd-sidebar-pname">{{ $service->user->nama_lengkap }}</p>
                        <p class="pd-sidebar-pprodi">{{ $service->user->profile?->prodi ?? 'UPN Veteran Jatim' }}</p>
                    </div>
                </div>
            </div>
        </aside>

    </div>
</section>
@endsection
