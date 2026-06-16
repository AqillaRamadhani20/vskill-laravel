@extends('layouts.app')

@section('title', 'Edit Profil | V-Skill')

@section('content')
<section class="pe-page">

    <a href="{{ route('profile.view', auth()->id()) }}" class="pd-back-chip">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Kembali ke Profil
    </a>

    <div class="pe-header">
        <div class="pe-header-avatar" style="background:linear-gradient(135deg,#15803d,#22c55e);">
            @php
                $fotoNow = auth()->user()->profile?->foto;
                $hasFoto = $fotoNow && $fotoNow !== 'default.jpg';
            @endphp
            @if($hasFoto)
                <img src="{{ asset('storage/foto-profil/' . $fotoNow) }}" alt="Foto profil"
                     style="width:100%;height:100%;object-fit:cover;border-radius:50%;"
                     onerror="this.style.display='none';">
            @else
                {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 1)) }}
            @endif
        </div>
        <div>
            <h1 class="pe-header-title">Edit Profil</h1>
            <p class="pe-header-sub">{{ auth()->user()->nama_lengkap }} &bull; {{ ucfirst(auth()->user()->role) }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="pe-form-card">
        @csrf

        {{-- Section: Foto --}}
        <div class="pe-section">
            <div class="pe-section-label">
                <span class="pe-section-num">1</span>
                Foto Profil
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <div class="foto-upload-wrap">
                    <div class="foto-preview-ring">
                        <img id="foto-preview"
                             src="{{ $hasFoto ? asset('storage/foto-profil/' . $fotoNow) : '' }}"
                             alt="Foto profil"
                             class="foto-preview-img{{ $hasFoto ? '' : ' hidden' }}"
                             onerror="this.classList.add('hidden');document.getElementById('foto-placeholder').classList.remove('hidden');">
                        <div id="foto-placeholder" class="foto-preview-placeholder{{ $hasFoto ? ' hidden' : '' }}">
                            {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 1)) }}
                        </div>
                    </div>
                    <div class="foto-upload-controls">
                        <label for="foto" class="foto-upload-btn">📷 Pilih Foto Baru</label>
                        <input type="file" id="foto" name="foto" accept="image/*"
                               class="foto-input-hidden" onchange="vsPreviewFoto(this)">
                        <p class="form-help">JPG, PNG, WebP &bull; Maks. 2 MB</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section: Info Dasar --}}
        <div class="pe-section">
            <div class="pe-section-label">
                <span class="pe-section-num">2</span>
                Informasi Akademik
            </div>
            <div class="pe-grid-2">
                <div class="form-group">
                    <label for="npm">NPM</label>
                    <input type="text" id="npm" name="npm"
                           value="{{ old('npm', $profile->npm ?? '') }}"
                           class="form-control" placeholder="Masukkan NPM">
                </div>
                <div class="form-group">
                    <label for="prodi">Program Studi</label>
                    <input type="text" id="prodi" name="prodi"
                           value="{{ old('prodi', $profile->prodi ?? '') }}"
                           class="form-control" placeholder="Masukkan program studi">
                </div>
            </div>
            <div class="form-group">
                <label for="bio">Bio / Deskripsi Diri</label>
                <textarea id="bio" name="bio" class="form-control"
                          rows="4"
                          placeholder="Ceritakan tentang dirimu, keahlian, dan pengalaman...">{{ old('bio', $profile->bio ?? '') }}</textarea>
            </div>
        </div>

        {{-- Section: Keahlian --}}
        <div class="pe-section">
            <div class="pe-section-label">
                <span class="pe-section-num">3</span>
                Keahlian & Tools
            </div>
            <div class="pe-grid-2">
                <div class="form-group">
                    <label for="skill_summary">Skills</label>
                    <textarea id="skill_summary" name="skill_summary" class="form-control"
                              rows="3"
                              placeholder="Contoh: Web Development, UI/UX, Laravel">{{ old('skill_summary', $profile->skill_summary ?? '') }}</textarea>
                    <p class="form-help">Pisahkan dengan koma</p>
                </div>
                <div class="form-group">
                    <label for="tools_summary">Tools</label>
                    <textarea id="tools_summary" name="tools_summary" class="form-control"
                              rows="3"
                              placeholder="Contoh: Figma, VS Code, Laravel">{{ old('tools_summary', $profile->tools_summary ?? '') }}</textarea>
                    <p class="form-help">Pisahkan dengan koma</p>
                </div>
            </div>
        </div>

        {{-- Section: Harga & Kontak --}}
        <div class="pe-section">
            <div class="pe-section-label">
                <span class="pe-section-num">4</span>
                Harga & Kontak
            </div>
            <div class="pe-grid-2">
                <div class="form-group">
                    <label for="harga_mulai">Harga Mulai (Rp)</label>
                    <div class="pe-input-prefix-wrap">
                        <span class="pe-input-prefix">Rp</span>
                        <input type="number" id="harga_mulai" name="harga_mulai"
                               value="{{ old('harga_mulai', $profile->harga_mulai ?? 0) }}"
                               class="form-control pe-input-prefixed"
                               placeholder="50000" min="0">
                    </div>
                </div>
                <div class="form-group">
                    <label for="kontak_wa">Nomor WhatsApp</label>
                    <div class="input-icon-group">
                        <span class="input-icon">📱</span>
                        <input type="text" id="kontak_wa" name="kontak_wa"
                               value="{{ old('kontak_wa', $profile->kontak_wa ?? '') }}"
                               class="form-control input-with-icon"
                               placeholder="Contoh: 081234567890">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Status Ketersediaan</label>
                <div class="pe-status-toggle">
                    <label class="pe-toggle-option {{ (old('status_ketersediaan', $profile->status_ketersediaan ?? 'tersedia') === 'tersedia') ? 'active' : '' }}">
                        <input type="radio" name="status_ketersediaan" value="tersedia"
                               {{ (old('status_ketersediaan', $profile->status_ketersediaan ?? 'tersedia') === 'tersedia') ? 'checked' : '' }}
                               onchange="document.querySelectorAll('.pe-toggle-option').forEach(el=>el.classList.remove('active'));this.closest('.pe-toggle-option').classList.add('active');">
                        <span class="pe-toggle-dot tersedia"></span>
                        Tersedia
                    </label>
                    <label class="pe-toggle-option {{ (old('status_ketersediaan', $profile->status_ketersediaan ?? '') === 'sibuk') ? 'active' : '' }}">
                        <input type="radio" name="status_ketersediaan" value="sibuk"
                               {{ (old('status_ketersediaan', $profile->status_ketersediaan ?? '') === 'sibuk') ? 'checked' : '' }}
                               onchange="document.querySelectorAll('.pe-toggle-option').forEach(el=>el.classList.remove('active'));this.closest('.pe-toggle-option').classList.add('active');">
                        <span class="pe-toggle-dot sibuk"></span>
                        Sibuk
                    </label>
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <div class="pe-submit-area">
            <button type="submit" class="btn-primary" style="padding:.875rem 2.5rem;font-size:.95rem;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Simpan Perubahan
            </button>
            <a href="{{ route('profile.view', auth()->id()) }}" class="btn-outline" style="padding:.875rem 2rem;">
                Batal
            </a>
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
        // Update header avatar too
        const headerAvatar = document.querySelector('.pe-header-avatar img');
        if (headerAvatar) headerAvatar.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
}
</script>
@endpush

@endsection
