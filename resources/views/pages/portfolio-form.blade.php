@extends('layouts.app')

@section('title', ($portfolio->exists ? 'Edit Portfolio' : 'Tambah Portfolio') . ' | V-Skill')

@section('content')
<section class="sf-page">

    <a href="{{ route('profile.view', auth()->id()) }}" class="pd-back-chip">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Kembali ke Profil
    </a>

    <div class="sf-header">
        <div class="sf-header-icon" style="background:linear-gradient(135deg,rgba(37,99,235,.12),rgba(37,99,235,.06));border-color:rgba(37,99,235,.18);color:#2563eb;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
        </div>
        <div>
            <h1 class="sf-header-title">{{ $portfolio->exists ? 'Edit Portfolio' : 'Tambah Portfolio' }}</h1>
            <p class="sf-header-sub">Tambahkan project yang pernah kamu kerjakan untuk memperkuat profilmu.</p>
        </div>
    </div>

    <form method="POST"
          action="{{ $portfolio->exists ? route('portfolio.update', $portfolio) : route('portfolio.store') }}"
          class="sf-form-card">
        @csrf

        <div class="sf-form-body">

            <div class="form-group">
                <label for="judul_project">
                    Judul Project <span style="color:var(--vs-danger)">*</span>
                </label>
                <input type="text" id="judul_project" name="judul_project"
                       value="{{ old('judul_project', $portfolio->judul_project ?? '') }}"
                       placeholder="Contoh: Website Landing Page UMKM"
                       maxlength="100" required
                       class="form-control">
                @error('judul_project')
                    <p class="form-help" style="color:var(--vs-danger);">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">
                    Deskripsi Project <span style="color:var(--vs-danger)">*</span>
                </label>
                <textarea id="deskripsi" name="deskripsi" rows="5" required
                          class="form-control"
                          placeholder="Jelaskan apa yang kamu kerjakan, teknologi yang digunakan, tantangan dan hasilnya...">{{ old('deskripsi', $portfolio->deskripsi ?? '') }}</textarea>
                @error('deskripsi')
                    <p class="form-help" style="color:var(--vs-danger);">{{ $message }}</p>
                @enderror
            </div>

            <div class="pe-grid-2">
                <div class="form-group">
                    <label for="tools">Tools / Teknologi</label>
                    <input type="text" id="tools" name="tools"
                           value="{{ old('tools', $portfolio->tools ?? '') }}"
                           placeholder="Contoh: Laravel, Figma, MySQL"
                           class="form-control">
                    <p class="form-help">Pisahkan dengan koma</p>
                    @error('tools')
                        <p class="form-help" style="color:var(--vs-danger);">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="link_demo">Link Demo / Repository</label>
                    <div class="input-icon-group">
                        <span class="input-icon">🔗</span>
                        <input type="url" id="link_demo" name="link_demo"
                               value="{{ old('link_demo', $portfolio->link_demo ?? '') }}"
                               placeholder="https://github.com/..."
                               class="form-control input-with-icon">
                    </div>
                    @error('link_demo')
                        <p class="form-help" style="color:var(--vs-danger);">{{ $message }}</p>
                    @enderror
                </div>
            </div>

        </div>

        <div class="sf-actions">
            <button type="submit" class="btn-primary" style="padding:.875rem 2rem;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                {{ $portfolio->exists ? 'Simpan Perubahan' : 'Tambah Portfolio' }}
            </button>
            <a href="{{ route('profile.view', auth()->id()) }}" class="btn-outline" style="padding:.875rem 2rem;">
                Batal
            </a>
        </div>
    </form>
</section>
@endsection
