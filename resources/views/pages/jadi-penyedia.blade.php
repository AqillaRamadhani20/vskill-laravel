@extends('layouts.app')

@section('title', 'Aktivasi Penyedia | V-Skill')

@section('content')
<section class="jp-page">

    <a href="{{ route('dashboard') }}" class="pd-back-chip">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Kembali ke Marketplace
    </a>

    {{-- Page Header --}}
    <div class="jp-header">
        <div class="jp-header-icon">🚀</div>
        <div>
            <h1 class="jp-header-title">Aktivasi Penyedia Jasa</h1>
            <p class="jp-header-sub">Lengkapi data profil untuk mengaktifkan akun sebagai penyedia</p>
        </div>
    </div>

    {{-- Visual Stepper --}}
    <div class="jp-stepper">
        <div class="jp-step active">
            <div class="jp-step-circle">1</div>
            <span>Info Dasar</span>
        </div>
        <div class="jp-step-line"></div>
        <div class="jp-step">
            <div class="jp-step-circle">2</div>
            <span>Keahlian</span>
        </div>
        <div class="jp-step-line"></div>
        <div class="jp-step">
            <div class="jp-step-circle">3</div>
            <span>Harga & Kontak</span>
        </div>
    </div>

    {{-- User info box --}}
    <div class="jp-user-box">
        <div class="jp-user-avatar" style="background:linear-gradient(135deg,#15803d,#22c55e);">
            {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
        </div>
        <div>
            <p class="jp-user-name">{{ $user->nama_lengkap }}</p>
            <p class="jp-user-email">{{ $user->email }}</p>
            <span class="badge badge-{{ $user->role === 'penyedia' ? 'green' : 'yellow' }}" style="font-size:.7rem;">
                {{ ucfirst($user->role) }}
            </span>
        </div>
    </div>

    {{-- Non-UPN warning --}}
    @unless($isEmailUpn)
        <div class="jp-warning-box">
            <div class="jp-warning-icon">⚠️</div>
            <div>
                <p class="jp-warning-title">Email Non-UPN Terdeteksi</p>
                <p class="jp-warning-text">
                    Hanya akun dengan email <strong>@student.upnjatim.ac.id</strong> yang dapat menjadi penyedia jasa.
                    Akun kamu tetap bisa digunakan sebagai <strong>pembeli</strong> untuk memesan jasa dari penyedia lain.
                </p>
            </div>
        </div>
    @endunless

    <form method="POST" action="{{ route('jadi-penyedia.process') }}" enctype="multipart/form-data" class="jp-form-card">
        @csrf

        {{-- SECTION 1: Info Dasar --}}
        <div class="jp-form-section">
            <div class="jp-section-head">
                <div class="jp-section-num">01</div>
                <div>
                    <h2 class="jp-section-title">Info Dasar</h2>
                    <p class="jp-section-sub">Foto dan informasi identitas kamu</p>
                </div>
            </div>

            {{-- Foto Profil --}}
            <div class="form-group">
                <label>Foto Profil</label>
                <div class="foto-upload-wrap">
                    <div class="foto-preview-ring">
                        @php
                            $fotoNow = $profile?->foto;
                            $hasFoto = $fotoNow && $fotoNow !== 'default.jpg';
                        @endphp
                        <img id="foto-preview"
                             src="{{ $hasFoto ? asset('storage/foto-profil/' . $fotoNow) : '' }}"
                             alt="Foto profil"
                             class="foto-preview-img{{ $hasFoto ? '' : ' hidden' }}"
                             onerror="this.classList.add('hidden');document.getElementById('foto-placeholder').classList.remove('hidden');">
                        <div id="foto-placeholder" class="foto-preview-placeholder{{ $hasFoto ? ' hidden' : '' }}">
                            {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
                        </div>
                    </div>
                    <div class="foto-upload-controls">
                        <label for="foto" class="foto-upload-btn {{ !$isEmailUpn ? 'disabled' : '' }}">📷 Pilih Foto</label>
                        <input type="file" id="foto" name="foto" accept="image/*"
                               class="foto-input-hidden" {{ !$isEmailUpn ? 'disabled' : '' }}
                               onchange="vsPreviewFoto(this)">
                        <p class="form-help">JPG, PNG, WebP &bull; Maks. 2 MB</p>
                    </div>
                </div>
            </div>

            <div class="pe-grid-2">
                <div class="form-group">
                    <label for="npm">NPM <span style="color:var(--vs-danger)">*</span></label>
                    <input type="text" id="npm" name="npm"
                           value="{{ old('npm', $profile->npm ?? '') }}"
                           class="form-control" placeholder="Masukkan NPM"
                           {{ !$isEmailUpn ? 'disabled' : '' }} required>
                </div>
                <div class="form-group">
                    <label for="prodi">Program Studi <span style="color:var(--vs-danger)">*</span></label>
                    <input type="text" id="prodi" name="prodi"
                           value="{{ old('prodi', $profile->prodi ?? '') }}"
                           class="form-control" placeholder="Contoh: Sistem Informasi"
                           {{ !$isEmailUpn ? 'disabled' : '' }} required>
                </div>
            </div>

            <div class="form-group">
                <label for="bio">Bio / Tentang Dirimu</label>
                <textarea id="bio" name="bio" rows="4" class="form-control"
                          placeholder="Ceritakan keahlian, pengalaman, dan apa yang kamu tawarkan..."
                          {{ !$isEmailUpn ? 'disabled' : '' }}>{{ old('bio', $profile->bio ?? '') }}</textarea>
            </div>
        </div>

        {{-- SECTION 2: Keahlian --}}
        <div class="jp-form-section">
            <div class="jp-section-head">
                <div class="jp-section-num">02</div>
                <div>
                    <h2 class="jp-section-title">Keahlian</h2>
                    <p class="jp-section-sub">Tunjukkan kemampuan dan tools yang kamu kuasai</p>
                </div>
            </div>

            <div class="pe-grid-2">
                <div class="form-group">
                    <label for="skill_summary">Skill Summary</label>
                    <textarea id="skill_summary" name="skill_summary" rows="3"
                              class="form-control"
                              placeholder="Contoh: UI/UX Design, Web Development, Copywriting"
                              {{ !$isEmailUpn ? 'disabled' : '' }}>{{ old('skill_summary', $profile->skill_summary ?? '') }}</textarea>
                    <p class="form-help">Pisahkan dengan koma</p>
                </div>
                <div class="form-group">
                    <label for="tools_summary">Tools Summary</label>
                    <textarea id="tools_summary" name="tools_summary" rows="3"
                              class="form-control"
                              placeholder="Contoh: Figma, VS Code, Canva, Photoshop"
                              {{ !$isEmailUpn ? 'disabled' : '' }}>{{ old('tools_summary', $profile->tools_summary ?? '') }}</textarea>
                    <p class="form-help">Pisahkan dengan koma</p>
                </div>
            </div>
        </div>

        {{-- SECTION 3: Harga & Kontak --}}
        <div class="jp-form-section">
            <div class="jp-section-head">
                <div class="jp-section-num">03</div>
                <div>
                    <h2 class="jp-section-title">Harga & Kontak</h2>
                    <p class="jp-section-sub">Informasi tarif dan cara klien menghubungimu</p>
                </div>
            </div>

            <div class="pe-grid-2">
                <div class="form-group">
                    <label for="harga_mulai">Harga Mulai (Rp)</label>
                    <div class="pe-input-prefix-wrap">
                        <span class="pe-input-prefix">Rp</span>
                        <input type="number" id="harga_mulai" name="harga_mulai" min="0"
                               value="{{ old('harga_mulai', $profile->harga_mulai ?? 0) }}"
                               class="form-control pe-input-prefixed"
                               placeholder="50000"
                               {{ !$isEmailUpn ? 'disabled' : '' }}>
                    </div>
                    <p class="form-help">Harga terendah jasa yang kamu tawarkan</p>
                </div>
                <div class="form-group">
                    <label for="kontak_wa">Nomor WhatsApp</label>
                    <div class="input-icon-group">
                        <span class="input-icon">📱</span>
                        <input type="text" id="kontak_wa" name="kontak_wa"
                               value="{{ old('kontak_wa', $profile->kontak_wa ?? '') }}"
                               class="form-control input-with-icon"
                               placeholder="Contoh: 081234567890"
                               {{ !$isEmailUpn ? 'disabled' : '' }}>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Status Ketersediaan</label>
                <div class="pe-status-toggle">
                    <label class="pe-toggle-option {{ (old('status_ketersediaan', $profile->status_ketersediaan ?? 'tersedia') === 'tersedia') ? 'active' : '' }}">
                        <input type="radio" name="status_ketersediaan" value="tersedia"
                               {{ (old('status_ketersediaan', $profile->status_ketersediaan ?? 'tersedia') === 'tersedia') ? 'checked' : '' }}
                               {{ !$isEmailUpn ? 'disabled' : '' }}
                               onchange="document.querySelectorAll('.pe-toggle-option').forEach(el=>el.classList.remove('active'));this.closest('.pe-toggle-option').classList.add('active');">
                        <span class="pe-toggle-dot tersedia"></span>
                        Tersedia
                    </label>
                    <label class="pe-toggle-option {{ (old('status_ketersediaan', $profile->status_ketersediaan ?? '') === 'sibuk') ? 'active' : '' }}">
                        <input type="radio" name="status_ketersediaan" value="sibuk"
                               {{ (old('status_ketersediaan', $profile->status_ketersediaan ?? '') === 'sibuk') ? 'checked' : '' }}
                               {{ !$isEmailUpn ? 'disabled' : '' }}
                               onchange="document.querySelectorAll('.pe-toggle-option').forEach(el=>el.classList.remove('active'));this.closest('.pe-toggle-option').classList.add('active');">
                        <span class="pe-toggle-dot sibuk"></span>
                        Sibuk
                    </label>
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <div class="pe-submit-area">
            <button type="submit" class="btn-primary w-full" style="padding:1rem;font-size:1rem;"
                    {{ !$isEmailUpn ? 'disabled' : '' }}>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                Simpan dan Aktifkan Penyedia
            </button>
        </div>
    </form>
</section>

@push('scripts')
<script>
function vsPreviewFoto(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const img = document.getElementById('foto-preview');
        const ph  = document.getElementById('foto-placeholder');
        img.src = e.target.result;
        img.classList.remove('hidden');
        if (ph) ph.classList.add('hidden');
    };
    reader.readAsDataURL(input.files[0]);
}
</script>
@endpush

@endsection
