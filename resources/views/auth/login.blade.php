@extends('layouts.app')

@section('title', 'Login | V-Skill')

@section('content')
<div class="auth-page-split">

    {{-- ── LEFT: Brand Panel ─────────────────────────────────── --}}
    <div class="auth-brand-panel auth-brand-panel--vivid">

        {{-- Animated floating shapes --}}
        <div class="auth-float-shape auth-shape-1"></div>
        <div class="auth-float-shape auth-shape-2"></div>
        <div class="auth-float-shape auth-shape-3"></div>

        <div class="auth-brand-logo" style="position:relative;z-index:1;">
            <div class="auth-brand-logo-icon">
                <img src="{{ asset('assets/images/logo.png') }}" alt="V-Skill" style="height:56px;width:auto;filter:brightness(0) invert(1);">
            </div>
            <div>
                <div class="auth-brand-logo-text">V-Skill</div>
                <div class="auth-brand-logo-sub">Jasa Mahasiswa UPN</div>
            </div>
        </div>

        <h2 class="auth-brand-title" style="position:relative;z-index:1;">
            Selamat Datang<br>
            di <span class="y">V-Skill</span>
        </h2>

        <p class="auth-brand-sub" style="position:relative;z-index:1;">
            Platform jasa kreatif eksklusif mahasiswa UPN Veteran Jawa Timur. Masuk untuk melanjutkan.
        </p>

        {{-- Social proof stats --}}
        <div class="auth-stats-row" style="position:relative;z-index:1;">
            <div class="auth-stat-item">
                <strong>15+</strong>
                <span>Penyedia Aktif</span>
            </div>
            <div class="auth-stat-divider"></div>
            <div class="auth-stat-item">
                <strong>15+</strong>
                <span>Jasa Aktif</span>
            </div>
            <div class="auth-stat-divider"></div>
            <div class="auth-stat-item">
                <strong>UPN</strong>
                <span>Verified</span>
            </div>
        </div>

        <div class="auth-brand-badges" style="position:relative;z-index:1;">
            <div class="auth-brand-badge-item">
                <div class="icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                </div>
                <span>Terverifikasi mahasiswa UPN Jatim</span>
            </div>
            <div class="auth-brand-badge-item">
                <div class="icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
                </div>
                <span>Penyedia jasa berbakat siap membantu</span>
            </div>
            <div class="auth-brand-badge-item">
                <div class="icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <span>Transaksi aman &amp; terstruktur</span>
            </div>
        </div>
    </div>

    {{-- ── RIGHT: Form Panel ─────────────────────────────────── --}}
    <div class="auth-form-panel">
        <div class="auth-form-inner">
            <div class="auth-form-logo-sm">
                <img src="{{ asset('assets/images/logo.png') }}" alt="V-Skill" style="height:40px;width:auto;">
            </div>

            <h1 class="auth-form-title">Masuk ke Akun</h1>
            <p class="auth-form-sub">Gunakan username dan password yang terdaftar.</p>

            <form method="POST" action="{{ route('login.process') }}">
                @csrf

                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-icon-group">
                        <span class="input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </span>
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                               class="form-control input-with-icon" placeholder="Masukkan username"
                               required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-icon-group">
                        <span class="input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </span>
                        <input type="password" id="password" name="password"
                               class="form-control input-with-icon" placeholder="Masukkan password"
                               required>
                    </div>
                </div>

                <button type="submit" class="btn-primary auth-submit">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
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
