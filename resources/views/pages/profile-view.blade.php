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
    </section>
@endsection