@extends('layouts.app')

@section('title', 'Daftar | V-Skill')

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
            Bergabung &amp;<br>
            Raih <span class="y">Peluangmu</span>
        </h2>

        <p class="auth-brand-sub" style="position:relative;z-index:1;">
            Daftar sekarang dan mulai perjalananmu di V-Skill — platform jasa kreatif mahasiswa UPN Veteran Jawa Timur.
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
                <span>Kategori</span>
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
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                </div>
                <span>Pendaftaran gratis, langsung aktif</span>
            </div>
            <div class="auth-brand-badge-item">
                <div class="icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                </div>
                <span>Langsung bisa pesan jasa</span>
            </div>
            <div class="auth-brand-badge-item">
                <div class="icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <span>Proses cepat, mudah, aman</span>
            </div>
        </div>
    </div>

    {{-- ── RIGHT: Form Panel ─────────────────────────────────── --}}
    <div class="auth-form-panel" style="padding:2.5rem 2.5rem;">
        <div class="auth-form-inner">
            <div class="auth-form-logo-sm">
                <img src="{{ asset('assets/images/logo.png') }}" alt="V-Skill" style="height:40px;width:auto;">
            </div>

            <h1 class="auth-form-title">Buat Akun Baru</h1>
            <p class="auth-form-sub">Isi data berikut untuk mendaftar ke V-Skill.</p>

            <div class="auth-warning-box" style="margin-bottom:1.25rem;">
                <strong>Info Jenis Akun:</strong>
                <ul>
                    <li><b>Email UPN</b> (@student.upnjatim.ac.id) → dapat aktifkan akun <b>penyedia jasa</b>.</li>
                    <li><b>Email non-UPN</b> → akun <b>pembeli</b> (tetap bisa pesan jasa).</li>
                </ul>
            </div>

            <form method="POST" action="{{ route('register.process') }}">
                @csrf

                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap <span style="color:var(--vs-danger)">*</span></label>
                    <div class="input-icon-group">
                        <span class="input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </span>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                               class="form-control input-with-icon" placeholder="Contoh: Budi Santoso"
                               required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email <span style="color:var(--vs-danger)">*</span></label>
                    <div class="input-icon-group">
                        <span class="input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               class="form-control input-with-icon"
                               placeholder="nama@student.upnjatim.ac.id" required>
                    </div>
                    <p class="form-help">Gunakan email UPN jika ingin membuka jasa sebagai penyedia.</p>
                </div>

                <div class="form-group">
                    <label for="username">Username <span style="color:var(--vs-danger)">*</span></label>
                    <div class="input-icon-group">
                        <span class="input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/><line x1="16" y1="3" x2="22" y2="9"/><line x1="22" y1="3" x2="16" y2="9"/></svg>
                        </span>
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                               class="form-control input-with-icon" placeholder="Buat username unik"
                               required>
                    </div>
                    <p class="form-help">Tanpa spasi, 4–20 karakter, minimal 1 angka.</p>
                </div>

                <div class="pe-grid-2" style="gap:.875rem;">
                    <div class="form-group" style="margin-bottom:0;">
                        <label for="password">Password <span style="color:var(--vs-danger)">*</span></label>
                        <div class="input-icon-group">
                            <span class="input-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            </span>
                            <input type="password" id="password" name="password"
                                   class="form-control input-with-icon" placeholder="Min. 8 karakter"
                                   required>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label for="password_confirmation">Konfirmasi <span style="color:var(--vs-danger)">*</span></label>
                        <div class="input-icon-group">
                            <span class="input-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="form-control input-with-icon" placeholder="Ulangi password"
                                   required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-primary auth-submit" style="margin-top:1.25rem;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                    Daftar Sekarang
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
