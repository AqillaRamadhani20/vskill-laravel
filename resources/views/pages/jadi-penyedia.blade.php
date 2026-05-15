@extends('layouts.app')

@section('title', 'Jadi Penyedia | V-Skill')

@section('content')
    <section class="provider-page">
        <div class="provider-card provider-card-wide">
            <h1 class="provider-title">Aktivasi Penyedia Jasa</h1>
            <p class="provider-description">Lengkapi data profile untuk mengaktifkan akun sebagai penyedia.</p>

            <div class="provider-user-box">
                <p><strong>Nama:</strong> {{ $user->nama_lengkap }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Role saat ini:</strong> {{ $user->role }}</p>
            </div>

            @unless($isEmailUpn)
                <div class="provider-alert danger">
                    Hanya akun dengan email <strong>@student.upnjatim.ac.id</strong> yang dapat menjadi penyedia jasa.
                    Akun ini tetap bisa digunakan sebagai pembeli.
                </div>
            @endunless

            <form method="POST" class="provider-form">
                @csrf

                <div class="form-group">
                    <label for="npm">NPM</label>
                    <input type="text" id="npm" name="npm" value="{{ old('npm', $profile->npm ?? '') }}" class="form-control" {{ ! $isEmailUpn ? 'disabled' : '' }} required>
                </div>

                <div class="form-group">
                    <label for="prodi">Prodi</label>
                    <input type="text" id="prodi" name="prodi" value="{{ old('prodi', $profile->prodi ?? '') }}" class="form-control" {{ ! $isEmailUpn ? 'disabled' : '' }} required>
                </div>

                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio" rows="4" class="form-control" {{ ! $isEmailUpn ? 'disabled' : '' }}>{{ old('bio', $profile->bio ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="skill_summary">Skill Summary</label>
                    <input type="text" id="skill_summary" name="skill_summary" value="{{ old('skill_summary', $profile->skill_summary ?? '') }}" placeholder="Contoh: UI/UX, Web Development, Copywriting" class="form-control" {{ ! $isEmailUpn ? 'disabled' : '' }}>
                </div>

                <div class="form-group">
                    <label for="tools_summary">Tools Summary</label>
                    <input type="text" id="tools_summary" name="tools_summary" value="{{ old('tools_summary', $profile->tools_summary ?? '') }}" placeholder="Contoh: Figma, VS Code, Canva" class="form-control" {{ ! $isEmailUpn ? 'disabled' : '' }}>
                </div>

                <div class="form-group">
                    <label for="harga_mulai">Harga Mulai</label>
                    <input type="number" id="harga_mulai" name="harga_mulai" min="0" value="{{ old('harga_mulai', $profile->harga_mulai ?? 0) }}" class="form-control" {{ ! $isEmailUpn ? 'disabled' : '' }}>
                </div>

                <div class="form-group">
                    <label for="kontak_wa">Kontak WhatsApp</label>
                    <input type="text" id="kontak_wa" name="kontak_wa" value="{{ old('kontak_wa', $profile->kontak_wa ?? '') }}" placeholder="Contoh: 081234567890" class="form-control" {{ ! $isEmailUpn ? 'disabled' : '' }}>
                </div>

                <div class="form-group">
                    <label for="status_ketersediaan">Status Ketersediaan</label>
                    <select id="status_ketersediaan" name="status_ketersediaan" class="form-control" {{ ! $isEmailUpn ? 'disabled' : '' }}>
                        <option value="tersedia" @selected(old('status_ketersediaan', $profile->status_ketersediaan ?? 'tersedia') === 'tersedia')>Tersedia</option>
                        <option value="sibuk" @selected(old('status_ketersediaan', $profile->status_ketersediaan ?? 'tersedia') === 'sibuk')>Sibuk</option>
                    </select>
                </div>

                <button type="submit" class="btn-primary w-full" {{ ! $isEmailUpn ? 'disabled' : '' }}>
                    Simpan dan Aktifkan Penyedia
                </button>
            </form>
        </div>
    </section>
@endsection
