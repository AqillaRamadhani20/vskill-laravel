@extends('layouts.app')

@section('title', 'Dashboard Jasa | V-Skill')

@section('content')
    <section class="dashboard-header">
        @auth
            <h1>
                Hi, {{ auth()->user()->nama_lengkap }} 👋
            </h1>

            <p>
                Temukan jasa atau kelola layananmu di sini.
            </p>
        @else
            <h1>
                Temukan Jasa Mahasiswa UPN Terbaik
            </h1>

            <p>
                Jelajahi layanan kreatif dan profesional dari mahasiswa UPN.
            </p>
        @endauth
    </section>

    @auth
        <section class="dashboard-action">
            @if(auth()->user()->role === 'penyedia')
                <a href="{{ route('service.create') }}" class="btn-primary">
                    + Tambah Jasa
                </a>

                <a href="{{ route('jadi-penyedia') }}" class="btn-outline">
                    Edit Profil Penyedia
                </a>
            @else
                <a href="{{ route('jadi-penyedia') }}" class="btn-outline">
                    Buka Jasa
                </a>
            @endif
        </section>
    @endauth

    <section class="dashboard-layout">
        <aside class="category-sidebar">
            <div class="category-card">
                <h3>
                    Kategori Jasa
                </h3>

                <ul>
                    <li>
                        <a href="{{ route('dashboard') }}" class="{{ request('kategori') === null ? 'active' : '' }}">
                            Semua Jasa
                        </a>
                    </li>

                    @foreach($kategori as $k)
                        <li>
                            <a href="{{ route('dashboard', ['kategori' => $k]) }}"
                                class="{{ request('kategori') === $k ? 'active' : '' }}">
                                {{ $k }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <div class="service-list">
            <h2>
                {{ request('kategori') ? 'Kategori: ' . request('kategori') : 'Semua Jasa Aktif' }}
            </h2>

            <div class="service-grid">
                @forelse($services as $service)
                    <article class="service-card">
                        <div class="service-badges">
                            <span class="badge badge-green">
                                {{ $service->kategori }}
                            </span>

                            <span class="badge badge-yellow">
                                {{ ucfirst($service->status) }}
                            </span>
                        </div>

                        <h3>
                            {{ $service->judul_jasa }}
                        </h3>

                        <p class="service-provider">
                            {{ $service->user->nama_lengkap }}

                            @if($service->user->profile?->prodi)
                                • {{ $service->user->profile->prodi }}
                            @endif
                        </p>

                        <p class="service-description">
                            {{ $service->deskripsi }}
                        </p>

                        <div class="service-meta">
                            <span class="service-price">
                                Rp {{ number_format($service->harga, 0, ',', '.') }}
                            </span>

                            <span class="service-estimate">
                                {{ $service->estimasi_pengerjaan ?: '-' }}
                            </span>
                        </div>

                        <div class="service-actions">
                            <a href="{{ route('detail', $service) }}" class="btn-small-primary">
                                Detail Jasa
                            </a>

                            @auth
                                @if(auth()->id() === $service->user_id)
                                    <a href="{{ route('service.edit', $service) }}" class="btn-small-outline blue">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('service.delete', $service) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus jasa ini?')"
                                            class="btn-small-outline red">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </article>
                @empty
                    <div class="empty-state">
                        <h2>
                            Belum Ada Jasa
                        </h2>

                        <p>
                            Belum ada jasa yang tersedia untuk kategori ini.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection