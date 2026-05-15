@extends('layouts.app')

@section('title', 'Home | V-Skill')

@section('content')
    <section class="home-hero">
        <div class="home-hero-inner">
            <h1 class="home-hero-title">
                Salurkan Bakat
                <span>Kreatifmu</span>
            </h1>

            <p class="home-hero-description">
                Platform jasa kreatif khusus mahasiswa UPN "Veteran" Jawa Timur.
                Dapatkan pengalaman proyek nyata dan bangun portofoliomu!
            </p>

            <div class="home-hero-actions">
                <a href="{{ route('dashboard') }}" class="btn-primary">
                    Lihat Jasa
                </a>

                <a href="{{ route('tentang') }}" class="btn-outline">
                    Pelajari Dulu
                </a>
            </div>
        </div>
    </section>

    <section class="home-stats">
        <div class="home-stats-grid">
            <div class="home-stat-card">
                <h3>500+</h3>
                <p>Mahasiswa Aktif</p>
            </div>

            <div class="home-stat-card">
                <h3>50+</h3>
                <p>Project Selesai</p>
            </div>

            <div class="home-stat-card">
                <h3>30+</h3>
                <p>Klien Puas</p>
            </div>

            <div class="home-stat-card">
                <h3>Rp 100jt+</h3>
                <p>Nilai Project</p>
            </div>
        </div>
    </section>

    <section class="home-project">
        <div class="home-project-inner">
            <h2>
                Project Terbuka
            </h2>

            <p>
                Pilih project yang sesuai dengan skill kamu
            </p>

            <a href="{{ route('dashboard') }}" class="btn-primary">
                Lihat Semua Project
            </a>
        </div>
    </section>
@endsection