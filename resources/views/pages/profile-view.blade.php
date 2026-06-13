@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <section class="profile-page">
        <div class="profile-card">
            <div class="profile-header">
                <img src="{{ asset('assets/images/' . ($user->profile->foto ?? 'default.jpg')) }}"
                    alt="Foto profil {{ $user->nama_lengkap }}" class="profile-photo" onerror="this.style.display='none'">

                <div class="profile-identity">
                    <h1 class="profile-name">
                        {{ $user->nama_lengkap }}
                    </h1>

                    <p class="profile-email">
                        {{ $user->email }}
                    </p>

                    <p class="profile-role">
                        {{ ucfirst($user->role) }}
                    </p>

                    @auth
                        @if(auth()->id() === $user->id)
                            <a href="{{ route('profile.edit') }}" class="profile-edit-link">
                                Edit profil
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="profile-info-grid">
                <p>
                    <strong>NPM:</strong>
                    {{ $user->profile->npm ?? '-' }}
                </p>

                <p>
                    <strong>Prodi:</strong>
                    {{ $user->profile->prodi ?? '-' }}
                </p>

                <p>
                    <strong>Skill:</strong>
                    {{ $user->profile->skill_summary ?? '-' }}
                </p>

                <p>
                    <strong>Tools:</strong>
                    {{ $user->profile->tools_summary ?? '-' }}
                </p>

                <p>
                    <strong>Harga Mulai:</strong>
                    Rp{{ number_format($user->profile->harga_mulai ?? 0, 0, ',', '.') }}
                </p>

                <p>
                    <strong>Status:</strong>
                    {{ $user->profile->status_ketersediaan ?? '-' }}
                </p>
            </div>

            <p class="profile-bio">
                {{ $user->profile->bio ?? '' }}
            </p>
        </div>

        <div class="profile-services">
            <h2>
                Jasa dari {{ $user->nama_lengkap }}
            </h2>

            <div class="profile-service-grid">
                @forelse($user->services as $service)
                    <a href="{{ route('detail', $service) }}" class="profile-service-card">
                        <h3>
                            {{ $service->judul_jasa }}
                        </h3>

                        <p>
                            Rp{{ number_format($service->harga, 0, ',', '.') }}
                        </p>
                    </a>
                @empty
                    <div class="empty-state">
                        <h2>
                            Belum Ada Jasa
                        </h2>

                        <p>
                            Pengguna ini belum memiliki jasa.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Seksi Portfolio --}}
        <div class="mt-10">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800">
                    Portfolio
                </h2>
                @auth
                    @if(auth()->id() === $user->id && $user->role === 'penyedia')
                        <a href="{{ route('portfolio.create') }}"
                           class="text-sm bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-xl transition-colors">
                            + Tambah Portfolio
                        </a>
                    @endif
                @endauth
            </div>

            @forelse($user->portfolios as $portfolio)
                <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-4 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800 text-base">
                                {{ $portfolio->judul_project }}
                            </h3>

                            <p class="text-sm text-gray-600 mt-2 leading-relaxed">
                                {{ $portfolio->deskripsi }}
                            </p>

                            @if($portfolio->tools)
                                <div class="flex flex-wrap gap-2 mt-3">
                                    @foreach(array_map('trim', explode(',', $portfolio->tools)) as $tool)
                                        <span class="text-xs bg-green-50 text-green-700 border border-green-200 px-2 py-0.5 rounded-full">
                                            {{ $tool }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            @if($portfolio->link_demo)
                                <a href="{{ $portfolio->link_demo }}" target="_blank" rel="noopener noreferrer"
                                   class="inline-block mt-3 text-xs text-blue-600 hover:underline">
                                    Lihat Demo / Repository &rarr;
                                </a>
                            @endif
                        </div>

                        @auth
                            @if(auth()->id() === $user->id)
                                <div class="flex items-center gap-2 shrink-0">
                                    <a href="{{ route('portfolio.edit', $portfolio) }}"
                                       class="text-xs border border-gray-300 text-gray-600 hover:bg-gray-50 px-3 py-1.5 rounded-lg transition-colors">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('portfolio.delete', $portfolio) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Hapus portfolio ini?')"
                                                class="text-xs border border-red-300 text-red-600 hover:bg-red-50 px-3 py-1.5 rounded-lg transition-colors">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <div class="bg-gray-50 border border-dashed border-gray-300 rounded-2xl p-8 text-center">
                    <p class="text-gray-400 text-sm">Belum ada portfolio yang ditambahkan.</p>
                    @auth
                        @if(auth()->id() === $user->id && $user->role === 'penyedia')
                            <a href="{{ route('portfolio.create') }}"
                               class="inline-block mt-3 text-sm text-green-700 hover:underline">
                                + Tambah portfolio pertamamu
                            </a>
                        @endif
                    @endauth
                </div>
            @endforelse
        </div>
    </section>
@endsection