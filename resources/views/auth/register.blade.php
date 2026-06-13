@extends('layouts.app')

@section('title', 'Daftar | V-Skill')

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
            Bergabung &amp;<br>
            Raih <span class="y">Peluangmu</span>
        </h2>

        <p class="auth-brand-sub">
            Daftar sekarang dan mulai perjalananmu di V-Skill — platform jasa kreatif mahasiswa UPN Veteran Jawa Timur.
        </p>

        <div class="auth-brand-badges">
            <div class="auth-brand-badge-item">
                <div class="icon">&#127881;</div>
                <span>Pendaftaran 100% gratis</span>
            </div>
            <div class="auth-brand-badge-item">
                <div class="icon">&#128188;</div>
                <span>Langsung bisa pesan jasa</span>
            </div>
            <div class="auth-brand-badge-item">
                <div class="icon">&#9889;</div>
                <span>Proses cepat, mudah, aman</span>
            </div>
        </div>
    </div>

    {{-- ── RIGHT: Form Panel ─────────────────────────────────── --}}
    <div class="auth-form-panel">
        <div class="auth-form-inner">
            <h1 class="auth-form-title">Buat Akun Baru</h1>
            <p class="auth-form-sub">Isi data berikut untuk mendaftar ke V-Skill.</p>

            <div class="auth-warning-box">
                <strong>Info Jenis Akun:</strong>
                <ul>
                    <li><b>Email UPN</b> (@student.upnjatim.ac.id) &rarr; dapat aktifkan akun <b>penyedia jasa</b>.</li>
                    <li><b>Email pribadi / non-UPN</b> &rarr; akun <b>pembeli</b>.</li>
                    <li>Email UPN tetap bisa belanja, lalu aktifkan fitur penyedia via halaman <b>Jadi Penyedia</b>.</li>
                </ul>
            </div>

            <form method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                           class="form-control" placeholder="Contoh: Budi Santoso" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           class="form-control" placeholder="nama@student.upnjatim.ac.id atau nama@email.com" required>
                    <p class="form-help">Gunakan email UPN jika ingin membuka jasa sebagai penyedia.</p>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}"
                           class="form-control" placeholder="Buat username unik" required>
                    <p class="form-help">Tanpa spasi, 4–20 karakter, minimal 1 angka.</p>
                </div>

                <div class="form-group">
                    <label for="whatsapp">Nomor WhatsApp</label>
                    <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}"
                           class="form-control" placeholder="Contoh: 081234567890" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                           class="form-control" placeholder="Minimal 8 karakter" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="form-control" placeholder="Ketik ulang password" required>
                </div>

                <button type="submit" class="btn-primary auth-submit">
                    &#127881; Daftar Sekarang
                </button>
            </form>

            <div class="auth-divider">
                <span></span>
                <p>atau</p>
                <span></span>
            </div>

            <p class="auth-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </p>
        </div>
    </div>

</div>
@endsection
