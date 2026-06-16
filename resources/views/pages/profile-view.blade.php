@extends('layouts.app')

@section('title', $user->nama_lengkap . ' | V-Skill')

@section('content')
@php
    $pvFoto = $user->profile?->foto ?? 'default.jpg';
    $pvUrl  = $pvFoto !== 'default.jpg' ? asset('storage/foto-profil/' . $pvFoto) : null;
    $pvInitial = strtoupper(substr($user->nama_lengkap, 0, 1));
    $isOwn  = auth()->check() && auth()->id() === $user->id;
    $isUpn  = str_ends_with($user->email, '@student.upnjatim.ac.id');
    $serviceCount   = $user->services->count();
    $portfolioCount = $user->portfolios->count();
    $allRatings     = $user->services->flatMap(fn($s) => $s->ratings);
    $pvAvgRating    = $allRatings->count() > 0 ? round($allRatings->avg('rating'), 1) : null;
    $pvRatingCount  = $allRatings->count();
@endphp

<section class="pv-page">

    {{-- Hero Banner --}}
    <div class="pv-hero">
        <div class="pv-hero-bg"></div>
        <div class="pv-hero-inner">
            <div class="pv-avatar-wrap">
                @if($pvUrl)
                    <img src="{{ $pvUrl }}" alt="{{ $user->nama_lengkap }}"
                         class="pv-avatar-photo"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                @endif
                <div class="pv-avatar-placeholder"
                     style="{{ $pvUrl ? 'display:none' : '' }}">
                    {{ $pvInitial }}
                </div>
                @if($isUpn)
                    <div class="pv-verified-badge" title="Email UPN Terverifikasi">✓</div>
                @endif
            </div>

            <div class="pv-hero-info">
                <div class="pv-hero-name-row">
                    <h1 class="pv-hero-name">{{ $user->nama_lengkap }}</h1>
                    @if($isUpn)
                        <span class="pv-upn-badge">✓ UPN Verified</span>
                    @endif
                </div>
                <p class="pv-hero-role">{{ ucfirst($user->role) }}</p>
                <p class="pv-hero-email">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    {{ $user->email }}
                </p>
                @if($isOwn)
                    <a href="{{ route('profile.edit') }}" class="pv-edit-btn">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Edit Profil
                    </a>
                @endif
            </div>

            {{-- Stats row --}}
            <div class="pv-hero-stats">
                <div class="pv-stat">
                    <strong>{{ $serviceCount }}</strong>
                    <span>Jasa</span>
                </div>
                <div class="pv-stat">
                    <strong>{{ $portfolioCount }}</strong>
                    <span>Portfolio</span>
                </div>
                @if($pvAvgRating)
                    <div class="pv-stat">
                        <strong class="pv-stat-rating">
                            <svg class="rt-star filled" viewBox="0 0 24 24" width="14" height="14" style="vertical-align:middle;margin-right:2px;"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>{{ number_format($pvAvgRating, 1) }}
                        </strong>
                        <span>{{ $pvRatingCount }} Ulasan</span>
                    </div>
                @endif
                @if($user->profile?->harga_mulai)
                    <div class="pv-stat">
                        <strong>Rp{{ number_format($user->profile->harga_mulai, 0, ',', '.') }}</strong>
                        <span>Mulai dari</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Main two-column --}}
    <div class="pv-layout">

        {{-- LEFT Sidebar --}}
        <aside class="pv-sidebar">

            {{-- Bio --}}
            @if($user->profile?->bio)
                <div class="pv-sidebar-card">
                    <h3 class="pv-sidebar-title">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Tentang
                    </h3>
                    <p class="pv-bio">{{ $user->profile->bio }}</p>
                </div>
            @endif

            {{-- Contact & Info --}}
            <div class="pv-sidebar-card">
                <h3 class="pv-sidebar-title">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Info
                </h3>
                <ul class="pv-info-list">
                    @if($user->profile?->npm)
                        <li><span>NPM</span><strong>{{ $user->profile->npm }}</strong></li>
                    @endif
                    @if($user->profile?->prodi)
                        <li><span>Prodi</span><strong>{{ $user->profile->prodi }}</strong></li>
                    @endif
                    @if($user->profile?->harga_mulai)
                        <li><span>Harga Mulai</span><strong>Rp{{ number_format($user->profile->harga_mulai, 0, ',', '.') }}</strong></li>
                    @endif
                    @if($user->profile?->status_ketersediaan)
                        <li>
                            <span>Status</span>
                            <strong>
                                <span class="pv-status-dot {{ $user->profile->status_ketersediaan === 'tersedia' ? 'tersedia' : 'sibuk' }}"></span>
                                {{ ucfirst($user->profile->status_ketersediaan) }}
                            </strong>
                        </li>
                    @endif
                </ul>
            </div>

            {{-- Skills --}}
            @if($user->profile?->skill_summary)
                <div class="pv-sidebar-card">
                    <h3 class="pv-sidebar-title">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                        Skills
                    </h3>
                    <div class="pv-tags">
                        @foreach(array_map('trim', explode(',', $user->profile->skill_summary)) as $skill)
                            @if($skill)
                                <span class="pv-tag green">{{ $skill }}</span>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Tools --}}
            @if($user->profile?->tools_summary)
                <div class="pv-sidebar-card">
                    <h3 class="pv-sidebar-title">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                        Tools
                    </h3>
                    <div class="pv-tags">
                        @foreach(array_map('trim', explode(',', $user->profile->tools_summary)) as $tool)
                            @if($tool)
                                <span class="pv-tag blue">{{ $tool }}</span>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Contact WA --}}
            @if($user->profile?->kontak_wa)
                @php
                    $pvWa = preg_replace('/[^0-9]/', '', $user->profile->kontak_wa);
                    if (str_starts_with($pvWa, '0')) $pvWa = '62' . substr($pvWa, 1);
                @endphp
                <a href="https://wa.me/{{ $pvWa }}" target="_blank" class="pv-wa-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.554 4.116 1.528 5.844L0 24l6.336-1.508A11.938 11.938 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.013-1.376l-.36-.214-3.727.977.994-3.634-.234-.373A9.818 9.818 0 1112 21.818z"/></svg>
                    Chat via WhatsApp
                </a>
            @endif
        </aside>

        {{-- RIGHT: Main content --}}
        <div class="pv-main">

            {{-- Services Grid --}}
            <div class="pv-section">
                <div class="pv-section-head">
                    <h2 class="pv-section-title">Jasa dari {{ $user->nama_lengkap }}</h2>
                    @if($isOwn && $user->role === 'penyedia')
                        <a href="{{ route('service.create') }}" class="pv-add-btn">+ Tambah Jasa</a>
                    @endif
                </div>

                @if($user->services->count() > 0)
                    <div class="pv-services-grid">
                        @foreach($user->services as $service)
                            <a href="{{ route('detail', $service) }}" class="pv-svc-card">
                                <div class="pv-svc-accent"></div>
                                <div class="pv-svc-body">
                                    <div class="pv-svc-header-row">
                                        <span class="badge badge-green" style="font-size:.68rem;">{{ $service->kategori }}</span>
                                        <span class="pv-svc-status {{ $service->status === 'aktif' ? 'aktif' : 'nonaktif' }}"></span>
                                    </div>
                                    <h3 class="pv-svc-title">{{ $service->judul_jasa }}</h3>
                                    <p class="pv-svc-desc">{{ mb_strlen($service->deskripsi) > 80 ? mb_substr($service->deskripsi, 0, 80) . '...' : $service->deskripsi }}</p>
                                    <div class="pv-svc-footer">
                                        <strong class="pv-svc-price">Rp{{ number_format($service->harga, 0, ',', '.') }}</strong>
                                        @if($service->estimasi_pengerjaan)
                                            <span class="pv-svc-est">{{ $service->estimasi_pengerjaan }}</span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="pv-empty">
                        <span class="pv-empty-icon">🛠️</span>
                        <p>Belum ada jasa yang ditambahkan.</p>
                        @if($isOwn && $user->role === 'penyedia')
                            <a href="{{ route('service.create') }}" class="btn-small-primary" style="margin-top:.75rem;">+ Tambah Jasa Pertama</a>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Portfolio --}}
            <div class="pv-section">
                <div class="pv-section-head">
                    <h2 class="pv-section-title">Portfolio</h2>
                    @auth
                        @if($isOwn && $user->role === 'penyedia')
                            <a href="{{ route('portfolio.create') }}" class="pv-add-btn">+ Tambah Portfolio</a>
                        @endif
                    @endauth
                </div>

                @forelse($user->portfolios as $portfolio)
                    <div class="pv-portfolio-card">
                        <div class="pv-portfolio-timeline-dot"></div>
                        <div class="pv-portfolio-content">
                            <div class="pv-portfolio-top">
                                <h3 class="pv-portfolio-title">{{ $portfolio->judul_project }}</h3>
                                @auth
                                    @if($isOwn)
                                        <div class="pv-portfolio-actions">
                                            <a href="{{ route('portfolio.edit', $portfolio) }}" class="pv-port-edit">Edit</a>
                                            <form method="POST" action="{{ route('portfolio.delete', $portfolio) }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="pv-port-delete"
                                                        onclick="return confirm('Hapus portfolio ini?')">Hapus</button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                            <p class="pv-portfolio-desc">{{ $portfolio->deskripsi }}</p>
                            @if($portfolio->tools)
                                <div class="pv-portfolio-tools">
                                    @foreach(array_map('trim', explode(',', $portfolio->tools)) as $tool)
                                        @if($tool)
                                            <span class="pv-tag blue" style="font-size:.68rem;">{{ $tool }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                            @if($portfolio->link_demo)
                                <a href="{{ $portfolio->link_demo }}" target="_blank" rel="noopener noreferrer" class="pv-portfolio-link">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                    Lihat Demo / Repository
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="pv-empty">
                        <span class="pv-empty-icon">📁</span>
                        <p>Belum ada portfolio yang ditambahkan.</p>
                        @auth
                            @if($isOwn && $user->role === 'penyedia')
                                <a href="{{ route('portfolio.create') }}" class="btn-small-primary" style="margin-top:.75rem;">+ Tambah Portfolio Pertama</a>
                            @endif
                        @endauth
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</section>
@endsection
