@extends('layouts.app')

@section('title', 'Login | V-Skill')

@section('content')
<div class="auth-page-split">

    {{-- ── LEFT: Brand Panel ─────────────────────────────────── --}}
    <div class="auth-brand-panel">
        <div class="auth-brand-logo">
            <div class="auth-brand-logo-icon">V</div>
            <div>
                <div class="auth-brand-logo-text">V-Skill</div>
                <div class="auth-brand-logo-sub">Jasa Mahasiswa UPN</div>
            </div>
        </div>

        <h2 class="auth-brand-title">
            Selamat Datang<br>
            di <span class="y">V-Skill</span>
        </h2>

        <p class="auth-brand-sub">
            Platform jasa kreatif eksklusif mahasiswa UPN Veteran Jawa Timur. Masuk untuk melanjutkan.
        </p>

        <div class="auth-brand-badges">
            <div class="auth-brand-badge-item">
                <div class="icon">&#127891;</div>
                <span>Terverifikasi mahasiswa UPN Jatim</span>
            </div>
            <div class="auth-brand-badge-item">
                <div class="icon">&#128200;</div>
                <span>Ratusan penyedia jasa aktif</span>
            </div>
            <div class="auth-brand-badge-item">
                <div class="icon">&#128274;</div>
                <span>Transaksi aman &amp; terstruktur</span>
            </div>
        </div>
    </div>

    {{-- ── RIGHT: Form Panel ─────────────────────────────────── --}}
    <div class="auth-form-panel">
        <div class="auth-form-inner">
            <h1 class="auth-form-title">Masuk ke Akun</h1>
            <p class="auth-form-sub">Gunakan username dan password yang terdaftar.</p>

            <form method="POST">
                @csrf

                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-icon-group">
                        <span class="input-icon">&#128100;</span>
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                               class="form-control input-with-icon" placeholder="Masukkan username" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-icon-group">
                        <span class="input-icon">&#128274;</span>
                        <input type="password" id="password" name="password"
                               class="form-control input-with-icon" placeholder="Masukkan password" required>
                    </div>
                </div>

                <button type="submit" class="btn-primary auth-submit">
                    Masuk ke V-Skill
                </button>
            </form>

            <div class="auth-divider">
                <span></span>
                <p>atau</p>
                <span></span>
            </div>

            <p class="auth-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar gratis</a>
            </p>

            <div class="auth-info-box">
                <strong>Info:</strong>
                Semua email bisa daftar sebagai pembeli. Gunakan email student UPN
                (@student.upnjatim.ac.id) jika ingin membuka jasa sebagai penyedia.
            </div>
        </div>
    </div>

</div>
@endsection
