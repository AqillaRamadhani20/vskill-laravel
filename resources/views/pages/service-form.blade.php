@extends('layouts.app')

@section('title', ($service->exists ? 'Edit Jasa' : 'Tambah Jasa') . ' | V-Skill')

@section('content')
<section class="sf-page">

    <a href="{{ route('profile.view', auth()->id()) }}" class="pd-back-chip">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Kembali ke Profil
    </a>

    <div class="sf-header">
        <div class="sf-header-icon">
            @if($service->exists)
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            @else
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            @endif
        </div>
        <div>
            <h1 class="sf-header-title">{{ $service->exists ? 'Edit Jasa' : 'Tambah Jasa Baru' }}</h1>
            <p class="sf-header-sub">{{ $service->exists ? 'Perbarui informasi jasa yang kamu tawarkan' : 'Buat listing jasa baru dan mulai terima order' }}</p>
        </div>
    </div>

    <form method="POST" action="{{ $action }}" class="sf-form-card">
        @csrf

        <div class="sf-form-body">

            {{-- Judul --}}
            <div class="form-group">
                <label for="judul_jasa">
                    Judul Jasa <span style="color:var(--vs-danger)">*</span>
                </label>
                <input type="text" id="judul_jasa" name="judul_jasa"
                       value="{{ old('judul_jasa', $service->judul_jasa) }}"
                       class="form-control"
                       placeholder="Contoh: Desain Logo Profesional, Pembuatan Website Landing Page..."
                       required>
                <p class="form-help">Judul yang jelas dan menarik akan lebih mudah ditemukan klien.</p>
            </div>

            {{-- Kategori --}}
            <div class="form-group">
                <label for="kategori">Kategori <span style="color:var(--vs-danger)">*</span></label>
                <select id="kategori" name="kategori" class="form-control" required>
                    @foreach($kategori as $k)
                        <option value="{{ $k }}" @selected(old('kategori', $service->kategori) === $k)>
                            {{ $k }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Deskripsi --}}
            <div class="form-group">
                <label for="deskripsi">Deskripsi Jasa <span style="color:var(--vs-danger)">*</span></label>
                <textarea id="deskripsi" name="deskripsi" class="form-control"
                          rows="6"
                          placeholder="Jelaskan secara detail jasa yang kamu tawarkan: apa yang termasuk, proses kerja, revisi, dll..."
                          required>{{ old('deskripsi', $service->deskripsi) }}</textarea>
                <p class="form-help">Deskripsi yang lengkap membangun kepercayaan klien.</p>
            </div>

            {{-- Harga & Estimasi --}}
            <div class="pe-grid-2">
                <div class="form-group">
                    <label for="harga">Harga (Rp) <span style="color:var(--vs-danger)">*</span></label>
                    <div class="pe-input-prefix-wrap">
                        <span class="pe-input-prefix">Rp</span>
                        <input type="number" id="harga" name="harga"
                               value="{{ old('harga', $service->harga) }}"
                               class="form-control pe-input-prefixed"
                               placeholder="50000" min="0" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="estimasi_pengerjaan">Estimasi Pengerjaan</label>
                    <div class="input-icon-group">
                        <span class="input-icon">⏱️</span>
                        <input type="text" id="estimasi_pengerjaan" name="estimasi_pengerjaan"
                               value="{{ old('estimasi_pengerjaan', $service->estimasi_pengerjaan) }}"
                               class="form-control input-with-icon"
                               placeholder="Contoh: 2-3 hari, 1 minggu">
                    </div>
                </div>
            </div>

            {{-- Status --}}
            <div class="form-group">
                <label>Status Jasa <span style="color:var(--vs-danger)">*</span></label>
                <div class="pe-status-toggle">
                    <label class="pe-toggle-option {{ (old('status', $service->status ?? 'aktif') === 'aktif') ? 'active' : '' }}">
                        <input type="radio" name="status" value="aktif"
                               {{ (old('status', $service->status ?? 'aktif') === 'aktif') ? 'checked' : '' }}
                               onchange="document.querySelectorAll('.pe-toggle-option').forEach(el=>el.classList.remove('active'));this.closest('.pe-toggle-option').classList.add('active');">
                        <span class="pe-toggle-dot tersedia"></span>
                        Aktif
                    </label>
                    <label class="pe-toggle-option {{ (old('status', $service->status ?? '') === 'nonaktif') ? 'active' : '' }}">
                        <input type="radio" name="status" value="nonaktif"
                               {{ (old('status', $service->status ?? '') === 'nonaktif') ? 'checked' : '' }}
                               onchange="document.querySelectorAll('.pe-toggle-option').forEach(el=>el.classList.remove('active'));this.closest('.pe-toggle-option').classList.add('active');">
                        <span class="pe-toggle-dot sibuk"></span>
                        Nonaktif
                    </label>
                </div>
                <p class="form-help">Jasa nonaktif tidak akan muncul di marketplace.</p>
            </div>
        </div>

        {{-- Actions --}}
        <div class="sf-actions">
            <button type="submit" class="btn-primary" style="padding:.875rem 2rem;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                {{ $service->exists ? 'Simpan Perubahan' : 'Buat Jasa Sekarang' }}
            </button>
            <a href="{{ route('profile.view', auth()->id()) }}" class="btn-outline" style="padding:.875rem 2rem;">
                Batal
            </a>
        </div>
    </form>
</section>
@endsection
