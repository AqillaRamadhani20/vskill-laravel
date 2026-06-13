@extends('layouts.app')

@section('title', $portfolio->exists ? 'Edit Portfolio | V-Skill' : 'Tambah Portfolio | V-Skill')

@section('content')
    <section class="py-10 max-w-2xl mx-auto">

        <div class="mb-6">
            <a href="{{ route('profile.view', auth()->id()) }}"
               class="text-sm text-green-700 hover:underline">
                &larr; Kembali ke Profil
            </a>
            <h1 class="text-2xl font-bold text-gray-800 mt-2">
                {{ $portfolio->exists ? 'Edit Portfolio' : 'Tambah Portfolio' }}
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Tambahkan project yang pernah kamu kerjakan untuk memperkuat profilmu.
            </p>
        </div>

        <form method="POST"
              action="{{ $portfolio->exists ? route('portfolio.update', $portfolio) : route('portfolio.store') }}"
              class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="judul_project">
                    Judul Project <span class="text-red-500">*</span>
                </label>
                <input type="text" id="judul_project" name="judul_project"
                       value="{{ old('judul_project', $portfolio->judul_project ?? '') }}"
                       placeholder="Contoh: Website Landing Page UMKM"
                       maxlength="100" required
                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('judul_project')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="deskripsi">
                    Deskripsi Project <span class="text-red-500">*</span>
                </label>
                <textarea id="deskripsi" name="deskripsi" rows="4" required
                          placeholder="Jelaskan apa yang kamu kerjakan, teknologi yang digunakan, dan hasilnya..."
                          class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('deskripsi', $portfolio->deskripsi ?? '') }}</textarea>
                @error('deskripsi')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="tools">
                    Tools / Teknologi
                </label>
                <input type="text" id="tools" name="tools"
                       value="{{ old('tools', $portfolio->tools ?? '') }}"
                       placeholder="Contoh: Laravel, Figma, MySQL"
                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                <p class="text-xs text-gray-400 mt-1">Pisahkan dengan koma</p>
                @error('tools')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="link_demo">
                    Link Demo / Repository
                </label>
                <input type="url" id="link_demo" name="link_demo"
                       value="{{ old('link_demo', $portfolio->link_demo ?? '') }}"
                       placeholder="https://github.com/..."
                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('link_demo')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="bg-green-700 hover:bg-green-800 text-white text-sm font-medium px-6 py-2.5 rounded-xl transition-colors">
                    {{ $portfolio->exists ? 'Simpan Perubahan' : 'Tambah Portfolio' }}
                </button>
                <a href="{{ route('profile.view', auth()->id()) }}"
                   class="text-sm text-gray-500 hover:text-gray-700">
                    Batal
                </a>
            </div>
        </form>
    </section>
@endsection
