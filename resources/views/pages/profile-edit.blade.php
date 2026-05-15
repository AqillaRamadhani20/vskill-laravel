@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
    <section class="profile-edit-page">
        <form method="POST" class="profile-edit-card">
            @csrf

            <h1 class="profile-edit-title">
                Edit Profil
            </h1>

            <div class="form-group">
                <label for="npm">
                    NPM
                </label>

                <input type="text" id="npm" name="npm" value="{{ old('npm', $profile->npm ?? '') }}" class="form-control"
                    placeholder="Masukkan NPM" required>
            </div>

            <div class="form-group">
                <label for="prodi">
                    Program Studi
                </label>

                <input type="text" id="prodi" name="prodi" value="{{ old('prodi', $profile->prodi ?? '') }}"
                    class="form-control" placeholder="Masukkan program studi" required>
            </div>

            <div class="form-group">
                <label for="bio">
                    Bio
                </label>

                <textarea id="bio" name="bio" class="form-control"
                    placeholder="Ceritakan tentang dirimu">{{ old('bio', $profile->bio ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="skill_summary">
                    Skill
                </label>

                <textarea id="skill_summary" name="skill_summary" class="form-control"
                    placeholder="Contoh: Web Development, UI/UX, Laravel">{{ old('skill_summary', $profile->skill_summary ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="tools_summary">
                    Tools
                </label>

                <input type="text" id="tools_summary" name="tools_summary"
                    value="{{ old('tools_summary', $profile->tools_summary ?? '') }}" class="form-control"
                    placeholder="Contoh: Figma, VS Code, Laravel">
            </div>

            <div class="form-group">
                <label for="harga_mulai">
                    Harga Mulai
                </label>

                <input type="number" id="harga_mulai" name="harga_mulai"
                    value="{{ old('harga_mulai', $profile->harga_mulai ?? 0) }}" class="form-control"
                    placeholder="Contoh: 50000" min="0">
            </div>

            <div class="form-group">
                <label for="kontak_wa">
                    Kontak WhatsApp
                </label>

                <input type="text" id="kontak_wa" name="kontak_wa" value="{{ old('kontak_wa', $profile->kontak_wa ?? '') }}"
                    class="form-control" placeholder="Contoh: 081234567890">
            </div>

            <div class="form-group">
                <label for="status_ketersediaan">
                    Status Ketersediaan
                </label>

                <select id="status_ketersediaan" name="status_ketersediaan" class="form-control">
                    <option value="tersedia" @selected(($profile->status_ketersediaan ?? '') === 'tersedia')>
                        Tersedia
                    </option>

                    <option value="sibuk" @selected(($profile->status_ketersediaan ?? '') === 'sibuk')>
                        Sibuk
                    </option>
                </select>
            </div>

            <button type="submit" class="btn-primary">
                Simpan
            </button>
        </form>
    </section>
@endsection