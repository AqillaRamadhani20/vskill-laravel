@extends('layouts.app')

@section('title', 'Jelajahi Jasa | V-Skill')

@section('content')

@php
$kategoriIkon = [
    'Digital Marketing'              => '📢',
    'Data Science & Analysis'        => '📊',
    'Microsoft Office'               => '📄',
    'UI/UX Research and Design'      => '🎨',
    'Product and Project Management' => '📋',
    'Website & Apps Developer'       => '💻',
    'Video Editing'                  => '🎬',
    'Jasa Cek Turnitin'              => '🔍',
    'Penyusunan Artikel'             => '✍️',
    'Merapikan File/Dokumen'         => '📁',
    'Public Speaking'                => '🎤',
    'Desain Grafis'                  => '🖌️',
    'Konsultan Keuangan'             => '💰',
    'Jasa Bahasa Inggris'            => '🌐',
    'Jasa Penerjemah'                => '🌍',
];

$avatarGradients = [
    'linear-gradient(135deg,#15803d,#22c55e)',
    'linear-gradient(135deg,#0369a1,#38bdf8)',
    'linear-gradient(135deg,#7c3aed,#a78bfa)',
    'linear-gradient(135deg,#dc2626,#f87171)',
    'linear-gradient(135deg,#d97706,#fbbf24)',
];
@endphp

{{-- ══════════════ HERO BANNER ══════════════ --}}
<div class="dash-hero">
    <div class="dash-hero-content">
        <div class="dash-hero-text">
            <p class="dash-hero-eyebrow">Platform Jasa Kreatif Mahasiswa UPN</p>

            @auth
                <h1 class="dash-hero-title">
                    Halo, <span class="dash-accent">{{ auth()->user()->nama_lengkap }}</span>!
                </h1>
            @else
                <h1 class="dash-hero-title">
                    Temukan Jasa <span class="dash-accent">Terbaik</span><br>Mahasiswa UPN
                </h1>
            @endauth

            <p class="dash-hero-sub">
                {{ $totalJasa }}+ jasa kreatif &amp; profesional dari mahasiswa berbakat UPN Veteran Jawa Timur siap membantu kebutuhanmu.
            </p>
        </div>

        <div class="dash-hero-stats">
            <div class="dash-hero-stat">
                <span class="dash-hero-stat-num">{{ $totalJasa }}</span>
                <span class="dash-hero-stat-label">Jasa Aktif</span>
            </div>
            <div class="dash-hero-stat">
                <span class="dash-hero-stat-num">{{ count($kategori) }}</span>
                <span class="dash-hero-stat-label">Kategori</span>
            </div>
            <div class="dash-hero-stat">
                <span class="dash-hero-stat-num">UPN</span>
                <span class="dash-hero-stat-label">Verified</span>
            </div>
        </div>
    </div>
</div>

{{-- ══════════════ ACTION BAR ══════════════ --}}
@auth
<div class="dash-action-bar">
    @if(auth()->user()->role === 'penyedia')
        <a href="{{ route('service.create') }}" class="btn-primary" style="font-size:.85rem;padding:.65rem 1.25rem;">
            + Tambah Jasa
        </a>
        <a href="{{ route('jadi-penyedia') }}" class="btn-outline" style="font-size:.85rem;padding:.65rem 1.25rem;">
            Edit Profil Penyedia
        </a>
    @else
        <a href="{{ route('jadi-penyedia') }}" class="btn-primary" style="font-size:.85rem;padding:.65rem 1.25rem;">
            Buka Jasa Saya
        </a>
    @endif
    <span class="dash-action-hint">Bergabunglah sebagai penyedia jasa &mdash; buka peluang penghasilan dari skill-mu!</span>
</div>
@endauth

{{-- ══════════════ TWO-COLUMN LAYOUT ══════════════ --}}
<div class="dash-layout">

    {{-- ── SIDEBAR ── --}}
    <aside>
        <div class="dash-sidebar-inner">
            <div class="dash-sidebar-header">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="opacity:.7"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                <span class="dash-sidebar-title">Kategori Jasa</span>
            </div>

            <ul class="dash-cat-list">
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="dash-cat-item {{ request('kategori') === null ? 'active' : '' }}">
                        <span class="dash-cat-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                        </span>
                        <span class="dash-cat-label">Semua Jasa</span>
                        <span class="dash-cat-count">{{ $totalJasa }}</span>
                    </a>
                </li>

                @foreach($kategori as $k)
                <li>
                    <a href="{{ route('dashboard', ['kategori' => $k]) }}"
                       class="dash-cat-item {{ request('kategori') === $k ? 'active' : '' }}">
                        <span class="dash-cat-icon">{{ $kategoriIkon[$k] ?? '📌' }}</span>
                        <span class="dash-cat-label">{{ $k }}</span>
                        @if(isset($jasaPerKategori[$k]))
                            <span class="dash-cat-count">{{ $jasaPerKategori[$k] }}</span>
                        @endif
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </aside>

    {{-- ── MAIN CONTENT ── --}}
    <div class="dash-content">

        {{-- Results bar --}}
        <div class="dash-results-bar">
            <div>
                <h2 class="dash-results-title">
                    @if(request('kategori'))
                        {{ request('kategori') }}
                    @else
                        Semua Jasa Aktif
                    @endif
                </h2>
                <p class="dash-results-count">
                    {{ $services->count() }} jasa ditemukan
                    @if(request('kategori'))
                        &bull; filter aktif
                    @endif
                </p>
            </div>

            @if(request('kategori'))
                <a href="{{ route('dashboard') }}" class="dash-clear-filter">&#215; Hapus Filter</a>
            @endif
        </div>

        {{-- Service grid --}}
        <div class="dash-grid">
            @forelse($services as $service)

            @php
                $initial     = strtoupper($service->user->nama_lengkap[0] ?? 'U');
                $avatarStyle = $avatarGradients[ord($initial) % count($avatarGradients)];
                $fotoProfile = $service->user->profile?->foto;
                $hasFoto     = $fotoProfile && $fotoProfile !== 'default.jpg';
                $fotoUrl     = $hasFoto ? asset('storage/foto-profil/' . $fotoProfile) : null;
            @endphp

            <article class="dash-card">
                {{-- Animated shimmer accent bar --}}
                <div class="dash-card-accent"></div>

                <div class="dash-card-body">
                    {{-- Category badge + status indicator --}}
                    <div class="dash-card-header">
                        <span class="dash-cat-badge" title="{{ $service->kategori }}">
                            {{ $service->kategori }}
                        </span>
                        <span class="dash-status-dot {{ $service->status }}" title="{{ ucfirst($service->status) }}"></span>
                    </div>

                    {{-- Title --}}
                    <h3 class="dash-card-title">{{ $service->judul_jasa }}</h3>

                    {{-- Provider row --}}
                    <div class="dash-card-provider">
                        @if($fotoUrl)
                            <img src="{{ $fotoUrl }}"
                                 alt="{{ $service->user->nama_lengkap }}"
                                 class="dash-avatar-photo"
                                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                            <div class="dash-avatar" style="{{ $avatarStyle }};display:none;">{{ $initial }}</div>
                        @else
                            <div class="dash-avatar" style="{{ $avatarStyle }}">{{ $initial }}</div>
                        @endif
                        <div class="dash-provider-info">
                            <div class="dash-provider-name">{{ $service->user->nama_lengkap }}</div>
                            @if($service->user->profile?->prodi)
                                <div class="dash-provider-prodi">{{ $service->user->profile->prodi }}</div>
                            @endif
                        </div>
                    </div>

                    {{-- Description --}}
                    <p class="dash-card-desc">{{ $service->deskripsi }}</p>

                    {{-- Rating --}}
                    @php $svcAvg = $service->avgRating(); $svcCount = $service->ratingCount(); @endphp
                    @if($svcCount > 0)
                        <div class="rt-card-row">
                            <div class="rt-stars-display">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="rt-star {{ $i <= round($svcAvg) ? 'filled' : '' }}" viewBox="0 0 24 24" width="12" height="12"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>
                                @endfor
                            </div>
                            <span class="rt-card-score">{{ number_format($svcAvg, 1) }}</span>
                            <span class="rt-card-count">({{ $svcCount }} ulasan)</span>
                        </div>
                    @endif

                    {{-- Price + estimate footer --}}
                    <div class="dash-card-footer">
                        <div class="dash-card-price">
                            <span class="dash-price-label">Mulai dari</span>
                            <span class="dash-price-value">Rp {{ number_format($service->harga, 0, ',', '.') }}</span>
                        </div>
                        @if($service->estimasi_pengerjaan)
                            <span class="dash-card-est">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" style="display:inline;vertical-align:middle;margin-right:2px;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                {{ $service->estimasi_pengerjaan }}
                            </span>
                        @endif
                    </div>

                    {{-- Actions --}}
                    <div class="dash-card-actions">
                        <a href="{{ route('detail', $service) }}" class="dash-btn-detail">
                            Lihat Detail &#8594;
                        </a>

                        @auth
                            @if(auth()->id() === $service->user_id)
                                <a href="{{ route('service.edit', $service) }}" class="dash-btn-edit">&#9998; Edit</a>

                                <form method="POST" action="{{ route('service.delete', $service) }}" style="display:contents;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Yakin hapus jasa ini?')"
                                        class="dash-btn-delete">&#128465; Hapus</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </article>

            @empty

            <div class="dash-empty">
                <div class="dash-empty-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" style="opacity:.35;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </div>
                <h3>Belum Ada Jasa</h3>
                <p>Tidak ada jasa untuk kategori ini. Coba kategori lain atau tambahkan jasamu!</p>
                <a href="{{ route('dashboard') }}" class="btn-primary" style="display:inline-flex;margin-top:1.25rem;font-size:.85rem;">
                    &#8592; Lihat Semua Jasa
                </a>
            </div>

            @endforelse
        </div>
    </div>

</div>

@endsection
