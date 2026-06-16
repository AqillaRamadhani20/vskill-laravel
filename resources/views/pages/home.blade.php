@extends('layouts.app')

@section('title', 'Home | V-Skill — Platform Jasa Mahasiswa UPN')

@section('content')

{{-- ═══════════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════════════ --}}
<div class="vsk-hero-wrap">
    {{-- Animated floating shapes --}}
    <div class="vsk-hero-float vsk-float-1"></div>
    <div class="vsk-hero-float vsk-float-2"></div>
    <div class="vsk-hero-float vsk-float-3"></div>

    <div class="vsk-hero-inner">
        <div class="vsk-hero-badge">
            Platform Jasa Kreatif Mahasiswa UPN Veteran Jawa Timur
        </div>

        <h1 class="vsk-hero-title">
            Salurkan Bakat<br>
            <span class="accent">Kreatifmu</span> Sekarang
        </h1>

        <p class="vsk-hero-sub">
            Platform jasa kreatif eksklusif mahasiswa UPN "Veteran" Jawa Timur.
            Temukan talenta terbaik, atau jadilah penyedia dan bangun portofoliomu!
        </p>

        <div class="vsk-hero-actions">
            <a href="{{ route('dashboard') }}" class="btn-hero-primary">
                Jelajahi Semua Jasa
            </a>
            <a href="{{ route('tentang') }}" class="btn-hero-outline">
                Pelajari Lebih Lanjut →
            </a>
        </div>

        <div class="vsk-hero-stats">
            <div class="vsk-stat-item">
                <span class="vsk-stat-num">15+</span>
                <span class="vsk-stat-label">Penyedia Aktif</span>
            </div>
            <div class="vsk-stat-item">
                <span class="vsk-stat-num">15+</span>
                <span class="vsk-stat-label">Kategori Jasa</span>
            </div>
            <div class="vsk-stat-item">
                <span class="vsk-stat-num">UPN</span>
                <span class="vsk-stat-label">Verified</span>
            </div>
            <div class="vsk-stat-item">
                <span class="vsk-stat-num">SBY</span>
                <span class="vsk-stat-label">Berbasis</span>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════
     FITUR UNGGULAN
════════════════════════════════════════════════════════ --}}
<div class="vsk-section">
    <div class="vsk-section-head">
        <span class="vsk-section-eyebrow">Kenapa V-Skill?</span>
        <h2 class="vsk-section-title">Lebih dari Sekedar Marketplace</h2>
        <p class="vsk-section-sub">Platform yang dirancang khusus untuk ekosistem mahasiswa UPN — aman, terverifikasi, dan terpercaya.</p>
    </div>

    <div class="vsk-features-grid">
        <div class="vsk-feature-card">
            <div class="vsk-feature-icon">🎓</div>
            <div class="vsk-feature-bar" style="background:linear-gradient(90deg,#15803d,#22c55e);"></div>
            <h3>Terverifikasi Kampus</h3>
            <p>Semua penyedia jasa adalah mahasiswa UPN Veteran Jawa Timur yang telah terverifikasi dengan email resmi kampus.</p>
        </div>

        <div class="vsk-feature-card">
            <div class="vsk-feature-icon">⚡</div>
            <div class="vsk-feature-bar" style="background:linear-gradient(90deg,#facc15,#fbbf24);"></div>
            <h3>Proses Mudah & Cepat</h3>
            <p>Dari pencarian hingga pemesanan hanya dalam beberapa langkah. Tidak perlu ribet, langsung terhubung dengan penyedia.</p>
        </div>

        <div class="vsk-feature-card">
            <div class="vsk-feature-icon">📈</div>
            <div class="vsk-feature-bar" style="background:linear-gradient(90deg,#2563eb,#3b82f6);"></div>
            <h3>Bangun Portofolio</h3>
            <p>Tampilkan hasil karyamu lewat fitur portofolio. Buktikan keahlianmu kepada klien potensial.</p>
        </div>

        <div class="vsk-feature-card">
            <div class="vsk-feature-icon">💰</div>
            <div class="vsk-feature-bar" style="background:linear-gradient(90deg,#15803d,#16a34a);"></div>
            <h3>Harga Terjangkau</h3>
            <p>Tarif bersahabat sesuai kantong mahasiswa. Kualitas profesional dengan harga yang tidak menguras dompet.</p>
        </div>

        <div class="vsk-feature-card">
            <div class="vsk-feature-icon">👥</div>
            <div class="vsk-feature-bar" style="background:linear-gradient(90deg,#7c3aed,#8b5cf6);"></div>
            <h3>Komunitas Aktif</h3>
            <p>Bergabung bersama ratusan mahasiswa kreatif. Saling mendukung dan berkembang dalam satu ekosistem yang positif.</p>
        </div>

        <div class="vsk-feature-card">
            <div class="vsk-feature-icon">🔒</div>
            <div class="vsk-feature-bar" style="background:linear-gradient(90deg,#dc2626,#ef4444);"></div>
            <h3>Transaksi Aman</h3>
            <p>Sistem order terstruktur dengan status yang transparan — dari pending, diterima, hingga selesai.</p>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════
     CARA KERJA
════════════════════════════════════════════════════════ --}}
<div class="vsk-section">
    <div class="vsk-section-head">
        <span class="vsk-section-eyebrow">Cara Kerja</span>
        <h2 class="vsk-section-title">Mulai dalam 3 Langkah</h2>
        <p class="vsk-section-sub">Proses pemesanan jasa di V-Skill sangat mudah dan terstruktur.</p>
    </div>

    <div class="vsk-steps-grid">
        <div class="vsk-step">
            <div class="vsk-step-num">01</div>
            <div class="vsk-step-arrow">→</div>
            <h3>Temukan Jasa</h3>
            <p>Browse berbagai kategori jasa kreatif dari mahasiswa UPN. Filter sesuai kebutuhan dan anggaranmu.</p>
        </div>

        <div class="vsk-step">
            <div class="vsk-step-num">02</div>
            <div class="vsk-step-arrow">→</div>
            <h3>Pesan & Diskusi</h3>
            <p>Klik pesan, isi form kebutuhan, dan tunggu konfirmasi dari penyedia. Diskusikan detail projectmu.</p>
        </div>

        <div class="vsk-step">
            <div class="vsk-step-num">03</div>
            <h3>Terima Hasilnya</h3>
            <p>Penyedia mengerjakan ordermu dan menyelesaikannya. Tandai selesai saat pekerjaan diterima.</p>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════
     KATEGORI
════════════════════════════════════════════════════════ --}}
<div class="vsk-categories-wrap">
    <h2>Semua Kategori Jasa Tersedia</h2>
    <p>Dari desain hingga teknologi — temukan semua yang kamu butuhkan</p>

    <div class="vsk-cat-pills">
        @foreach([
            'Desain Grafis',
            'Web Development',
            'UI/UX Design',
            'Data & Analitik',
            'Video Editing',
            'Penulisan Konten',
            'Digital Marketing',
            'Terjemahan',
            'Microsoft Office',
            'Public Speaking',
            'Konsultan Keuangan',
            'Penyusunan Artikel',
        ] as $cat)
            <a href="{{ route('dashboard') }}" class="vsk-cat-pill">{{ $cat }}</a>
        @endforeach
    </div>

    <a href="{{ route('dashboard') }}" class="btn-hero-primary" style="display:inline-flex;align-items:center;gap:.5rem;">
        Lihat Semua Jasa →
    </a>
</div>

{{-- ═══════════════════════════════════════════════════════
     CTA
════════════════════════════════════════════════════════ --}}
<div class="vsk-cta-wrap">
    <h2>Siap Bergabung dengan V-Skill?</h2>
    <p>Mahasiswa UPN bisa menawarkan jasa dan membangun portofolio nyata. Daftar gratis dan mulai sekarang.</p>

    <div class="vsk-cta-actions">
        @guest
            <a href="{{ route('register') }}" class="btn-primary" style="font-size:1rem;padding:.9rem 2rem;">
                Daftar Gratis Sekarang
            </a>
            <a href="{{ route('login') }}" class="btn-outline" style="font-size:1rem;padding:.9rem 2rem;">
                Sudah Punya Akun? Masuk
            </a>
        @else
            <a href="{{ route('dashboard') }}" class="btn-primary" style="font-size:1rem;padding:.9rem 2rem;">
                Jelajahi Jasa Sekarang
            </a>
            @if(auth()->user()->role !== 'penyedia')
                <a href="{{ route('jadi-penyedia') }}" class="btn-outline" style="font-size:1rem;padding:.9rem 2rem;">
                    + Buka Jasa Sendiri
                </a>
            @endif
        @endguest
    </div>
</div>

@endsection
