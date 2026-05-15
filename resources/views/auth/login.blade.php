@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <section class="auth-page">
        <form method="POST" class="auth-card auth-card-modern">
            @csrf

            <div class="auth-logo">
                <span>V</span>
            </div>

            <h1 class="auth-title">
                Masuk ke V-Skill
            </h1>

            <p class="auth-subtitle">
                Masukkan username dan password untuk mengakses akunmu
            </p>

            <div class="form-group">
                <label for="username">Username</label>

                <div class="input-icon-group">
                    <span class="input-icon">👤</span>

                    <input type="text" id="username" name="username" value="{{ old('username') }}"
                        class="form-control input-with-icon" placeholder="Masukkan username" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <div class="input-icon-group">
                    <span class="input-icon">🔒</span>

                    <input type="password" id="password" name="password" class="form-control input-with-icon"
                        placeholder="Masukkan password" required>
                </div>
            </div>

            <button type="submit" class="btn-primary auth-submit">
                Login
            </button>

            <a href="#" class="auth-forgot">
                Lupa Password atau Username?
            </a>

            <div class="auth-divider">
                <span></span>
                <p>atau</p>
                <span></span>
            </div>

            <p class="auth-link">
                Belum punya akun?
                <a href="{{ route('register') }}">Daftar disini</a>
            </p>

            <div class="auth-info-box">
                <strong>Info:</strong>
                Semua email bisa daftar sebagai pembeli.
                Gunakan email student UPN jika ingin mengaktifkan akun sebagai penyedia jasa.
            </div>
        </form>
    </section>
@endsection