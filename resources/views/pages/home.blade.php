@extends('layouts.app')

@section('title', 'Home | V-Skill — Platform Jasa Mahasiswa UPN')

@section('content')

{{-- ═══════════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════════════ --}}
<div class="vsk-hero-wrap">
    <div class="vsk-hero-inner">
        <div class="vsk-hero-badge">
            &#127891; Platform #1 Jasa Mahasiswa UPN Veteran Jawa Timur
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
                &#128269; Jelajahi Semua Jasa
            </a>
            <a href="{{ route('tentang') }}" class="btn-hero-outline">
                Pelajari Lebih Lanjut &#8594;
            </a>
        </div>

        <div class="vsk-hero-stats">
            <div class="vsk-stat-item">
                <span class="vsk-stat-num">500+</span>
                <span class="vsk-stat-label">Mahasiswa Aktif</span>
            </div>
            <div class="vsk-stat-item">
                <span class="vsk-stat-num">50+</span>
                <span class="vsk-stat-label">Project Selesai</span>
            </div>
            <div class="vsk-stat-item">
                <span class="vsk-stat-num">30+</span>
                <span class="vsk-stat-label">Klien Puas</span>
            </div>
            <div class="vsk-stat-item">
                <span class="vsk-stat-num">100jt+</span>
                <span class="vsk-stat-label">Nilai Project</span>
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
            <div class="vsk-feature-icon">&#127891;</div>
            <h3>Terverifikasi Kampus</h3>
            <p>Semua penyedia jasa adalah mahasiswa UPN Veteran Jawa Timur yang telah terverifikasi dengan email resmi kampus.</p>
        </div>

        <div class="vsk-feature-card">
            <div class="vsk-feature-icon">&#9889;</div>
            <h3>Proses Mudah & Cepat</h3>
            <p>Dari pencarian hingga pemesanan hanya dalam beberapa langkah. Tidak perlu ribet, langsung terhubung dengan penyedia.</p>
        </div>

        <div class="vsk-feature-card">
            <div class="vsk-feature-icon">&#128200;</div>
            <h3>Bangun Portofolio</h3>
            <p>Tampilkan hasil karyamu lewat fitur portofolio. Buktikan keahlianmu kepada klien potensial.</p>
        </div>

        <div class="vsk-feature-card">
            <div class="vsk-feature-icon">&#128176;</div>
            <h3>Harga Terjangkau</h3>
            <p>Tarif bersahabat sesuai kantong mahasiswa. Kualitas profesional dengan harga yang tidak menguras dompet.</p>
        </div>

        <div class="vsk-feature-card">
            <div class="vsk-feature-icon">&#128101;</div>
            <h3>Komunitas Aktif</h3>
            <p>Bergabung bersama ratusan mahasiswa kreatif. Saling mendukung dan berkembang dalam satu ekosistem yang positif.</p>
        </div>

        <div class="vsk-feature-card">
            <div class="vsk-feature-icon">&#128274;</div>
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
            <h3>Temukan Jasa</h3>
            <p>Browse berbagai kategori jasa kreatif dari mahasiswa UPN. Filter sesuai kebutuhan dan anggaranmu.</p>
        </div>

        <div class="vsk-step">
            <div class="vsk-step-num">02</div>
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
            '🎨 Desain Grafis',
            '💻 Web Development',
            '📱 UI/UX Design',
            '📊 Data & Analitik',
            '📹 Video Editing',
            '📸 Fotografi',
            '📝 Penulisan Konten',
            '📢 Digital Marketing',
            '🎵 Musik & Audio',
            '🌐 Terjemahan',
            '📐 Arsitektur',
            '🤖 AI & Machine Learning',
        ] as $cat)
            <a href="{{ route('dashboard') }}" class="vsk-cat-pill">{{ $cat }}</a>
        @endforeach
    </div>

    <a href="{{ route('dashboard') }}" class="btn-hero-primary" style="display:inline-block;">
        Lihat Semua Jasa &#8594;
    </a>
</div>

{{-- ═══════════════════════════════════════════════════════
     CTA
════════════════════════════════════════════════════════ --}}
<div class="vsk-cta-wrap">
    <div style="font-size:2.5rem;margin-bottom:1rem;">&#127775;</div>
    <h2>Siap Bergabung dengan V-Skill?</h2>
    <p>Ribuan mahasiswa sudah memanfaatkan V-Skill untuk mendapatkan penghasilan dan pengalaman nyata.</p>

    <div style="display:flex;justify-content:center;gap:1rem;flex-wrap:wrap;">
        @guest
            <a href="{{ route('register') }}" class="btn-primary" style="font-size:1rem;padding:.875rem 2rem;">
                &#127881; Daftar Gratis Sekarang
            </a>
            <a href="{{ route('login') }}" class="btn-outline" style="font-size:1rem;padding:.875rem 2rem;">
                Sudah Punya Akun? Login
            </a>
        @else
            <a href="{{ route('dashboard') }}" class="btn-primary" style="font-size:1rem;padding:.875rem 2rem;">
                &#128269; Jelajahi Jasa Sekarang
            </a>
            @if(auth()->user()->role !== 'penyedia')
                <a href="{{ route('jadi-penyedia') }}" class="btn-outline" style="font-size:1rem;padding:.875rem 2rem;">
                    + Buka Jasa Sendiri
                </a>
            @endif
        @endguest
    </div>
</div>

@endsection
