@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <section class="auth-page">
        <form method="POST" class="auth-card auth-card-modern auth-card-lg">
            @csrf

            <div class="auth-logo">
                <span>V</span>
            </div>

            <h1 class="auth-title">
                Daftar Akun V-Skill
            </h1>

            <p class="auth-subtitle">
                Pilih email yang sesuai dengan kebutuhan akunmu
            </p>

            <div class="auth-warning-box">
                <strong>Info Jenis Akun:</strong>

                <ul>
                    <li>
                        <b>Email UPN</b> (@student.upnjatim.ac.id) dapat digunakan
                        untuk mengaktifkan akun sebagai <b>penyedia jasa</b>.
                    </li>

                    <li>
                        <b>Email pribadi / non-UPN</b> digunakan untuk akun
                        <b>pembeli</b>.
                    </li>

                    <li>
                        Jika kamu mendaftar dengan email UPN, kamu tetap bisa belanja jasa,
                        lalu mengaktifkan fitur penyedia lewat halaman
                        <b>Jadi Penyedia</b>.
                    </li>
                </ul>
            </div>

            <div class="form-group">
                <label for="nama_lengkap">
                    Nama Lengkap
                </label>

                <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                    class="form-control" placeholder="Contoh: Budi Santoso" required>
            </div>

            <div class="form-group">
                <label for="email">
                    Email
                </label>

                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control"
                    placeholder="Contoh: nama@student.upnjatim.ac.id / nama@email.com" required>

                <p class="form-help">
                    Gunakan email UPN jika ingin membuka jasa sebagai penyedia.
                    Gunakan email pribadi jika ingin daftar sebagai pembeli.
                </p>
            </div>

            <div class="form-group">
                <label for="username">
                    Username
                </label>

                <input type="text" id="username" name="username" value="{{ old('username') }}" class="form-control"
                    placeholder="Buat username" required>

                <p class="form-help">
                    Username harus tanpa spasi, 4–20 karakter, dan minimal mengandung 1 angka.
                </p>
            </div>

            <div class="form-group">
                <label for="whatsapp">
                    Nomor WhatsApp
                </label>

                <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" class="form-control"
                    placeholder="Contoh: 081234567890" required>
            </div>

            <div class="form-group">
                <label for="password">
                    Password
                </label>

                <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 8 karakter"
                    required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">
                    Konfirmasi Password
                </label>

                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                    placeholder="Ketik ulang password" required>
            </div>

            <button type="submit" class="btn-primary auth-submit">
                Daftar Sekarang
            </button>

            <div class="auth-divider">
                <span></span>
                <p>atau</p>
                <span></span>
            </div>

            <p class="auth-link">
                Sudah punya akun?
                <a href="{{ route('login') }}">
                    Masuk disini
                </a>
            </p>

            <div class="auth-info-box">
                <strong>Info:</strong>
                Semua akun baru dibuat sebagai pembeli. Untuk menjadi penyedia,
                login dulu lalu buka halaman <b>Jadi Penyedia</b>.
            </div>
        </form>
    </section>
@endsection