<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'V-Skill')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/vskill-legacy.css') }}">
    @stack('head')
</head>

<body class="bg-gray-50 text-slate-800">
<div class="page-shell">

    <header class="fixed-nav">

        {{-- ── Topbar ── --}}
        <div class="flex items-center justify-between px-6 py-2 text-xs font-semibold text-white"
             style="background:linear-gradient(90deg,#064e3b,#15803d,#16a34a);">
            <span>Platform Jasa Kreatif Eksklusif Mahasiswa UPN Veteran Jawa Timur</span>
            <span class="hidden md:block">Hubungi: +62 812-3456-7890</span>
        </div>

        {{-- ══════════════════════════════════════════
             DESKTOP NAV (≥768 px)
             3-kolom grid: logo | nav-tengah | aksi-kanan
        ══════════════════════════════════════════ --}}
        <nav class="vs-desktop-nav">

            {{-- KIRI: Logo --}}
            <a href="{{ route('home') }}" class="vs-logo-img-link" style="justify-self:start;">
                <img src="{{ asset('assets/images/logo.png') }}" alt="V-Skill"
                     style="height:46px;width:auto;display:block;">
            </a>

            {{-- TENGAH: Link navigasi utama --}}
            <div class="flex items-center gap-0.5">
                <a href="{{ route('home') }}"
                   class="vs-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('tentang') }}"
                   class="vs-nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang Kami</a>
                <a href="{{ route('dashboard') }}"
                   class="vs-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Jelajahi Jasa</a>

                @auth
                    {{-- Pesanan Saya: tampil untuk pembeli & penyedia --}}
                    <a href="{{ route('pesanan') }}"
                       class="vs-nav-link {{ request()->routeIs('pesanan') ? 'active' : '' }}">Pesanan Saya</a>

                    {{-- Kelola Pesanan: hanya untuk penyedia --}}
                    @if(auth()->user()->role === 'penyedia')
                        <a href="{{ route('order.masuk') }}"
                           class="vs-nav-link {{ request()->routeIs('order.masuk') ? 'active' : '' }}">Kelola Pesanan</a>
                    @endif
                @endauth
            </div>

            {{-- KANAN: Login/Daftar (guest) atau user-dropdown (auth) --}}
            <div class="flex items-center gap-2" style="justify-self:end;">

                @guest
                    <a href="{{ route('login') }}" class="vs-btn-nav-outline">Masuk</a>
                    <a href="{{ route('register') }}" class="vs-btn-nav-primary">Daftar Gratis</a>
                @else
                    @php
                        $navFoto    = auth()->user()->profile?->foto;
                        $navHasFoto = $navFoto && $navFoto !== 'default.jpg';
                        $navFotoUrl = $navHasFoto ? asset('storage/foto-profil/' . $navFoto) : null;
                        $navInitial = strtoupper(substr(auth()->user()->nama_lengkap, 0, 1));
                        $navName    = auth()->user()->nama_lengkap;
                        $navEmail   = auth()->user()->email;
                        $navRole    = auth()->user()->role;
                    @endphp

                    <div class="vs-user-wrap">
                        {{-- Trigger button --}}
                        <button type="button" class="vs-user-btn" onclick="vsToggleDropdown(event)">
                            <div class="vs-user-avatar"
                                 style="background:linear-gradient(135deg,#15803d,#22c55e);">
                                @if($navFotoUrl)
                                    <img src="{{ $navFotoUrl }}" alt="{{ $navName }}"
                                         class="vs-user-avatar-img"
                                         onerror="this.style.display='none';">
                                @else
                                    {{ $navInitial }}
                                @endif
                            </div>
                            <div class="vs-user-info">
                                <span class="vs-user-name">{{ $navName }}</span>
                                <span class="vs-user-role">{{ ucfirst($navRole) }}</span>
                            </div>
                            <svg class="vs-chevron" viewBox="0 0 16 16" width="14" height="14"
                                 fill="none" stroke="currentColor" stroke-width="1.8"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 6l4 4 4-4"/>
                            </svg>
                        </button>

                        {{-- Dropdown panel --}}
                        <div class="vs-dropdown-menu" id="vsDropdown">
                            <div class="vs-dropdown-header">
                                <p class="vs-dropdown-dname">{{ $navName }}</p>
                                <p class="vs-dropdown-email">{{ $navEmail }}</p>
                                <span class="vs-dropdown-role-badge">{{ ucfirst($navRole) }}</span>
                            </div>
                            <div class="vs-dropdown-divider"></div>

                            <a href="{{ route('profile.view', auth()->id()) }}" class="vs-dropdown-item">
                                <span class="vs-di">&#128100;</span> Profil Saya
                            </a>
                            <a href="{{ route('profile.edit') }}" class="vs-dropdown-item">
                                <span class="vs-di">&#9998;</span> Edit Profil
                            </a>

                            @if($navRole === 'penyedia')
                                <a href="{{ route('jadi-penyedia') }}" class="vs-dropdown-item">
                                    <span class="vs-di">&#9881;</span> Edit Profil Penyedia
                                </a>
                                <a href="{{ route('service.create') }}" class="vs-dropdown-item">
                                    <span class="vs-di">&#43;</span> Tambah Jasa Baru
                                </a>
                            @elseif($navRole === 'pembeli')
                                <a href="{{ route('jadi-penyedia') }}" class="vs-dropdown-item">
                                    <span class="vs-di">&#128640;</span> Buka Jasa Saya
                                </a>
                            @endif

                            @if($navRole === 'admin')
                                <div class="vs-dropdown-divider"></div>
                                <a href="{{ route('admin.dashboard') }}"
                                   class="vs-dropdown-item vs-dropdown-item--admin">
                                    <span class="vs-di">&#9881;</span> Admin Panel
                                </a>
                            @endif

                            <div class="vs-dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="vs-dropdown-logout">
                                    <span class="vs-di">&#8594;</span> Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </nav>

        {{-- ══════════════════════════════════════════
             MOBILE NAV (<768 px)
        ══════════════════════════════════════════ --}}
        <nav class="vs-mobile-nav-bar">
            <a href="{{ route('home') }}" class="vs-logo-img-link">
                <img src="{{ asset('assets/images/logo.png') }}" alt="V-Skill"
                     style="height:38px;width:auto;display:block;">
            </a>

            <button type="button" class="vs-hamburger" id="vsMobileBtn"
                    onclick="vsToggleMobileMenu()" aria-label="Buka menu">
                <svg id="vsHamIcon" width="20" height="20" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                    <line x1="3" y1="6"  x2="21" y2="6"/>
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
                <svg id="vsClsIcon" width="20" height="20" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"
                     style="display:none;">
                    <line x1="18" y1="6"  x2="6"  y2="18"/>
                    <line x1="6"  y1="6"  x2="18" y2="18"/>
                </svg>
            </button>
        </nav>

        {{-- Mobile Drawer --}}
        <div id="vsMobileMenu" class="vs-mobile-drawer" style="display:none;">
            <div class="vs-mobile-links">
                <a href="{{ route('home') }}"
                   class="vs-mobile-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('tentang') }}"
                   class="vs-mobile-link {{ request()->routeIs('tentang') ? 'active' : '' }}">
                    Tentang Kami
                </a>
                <a href="{{ route('dashboard') }}"
                   class="vs-mobile-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Jelajahi Jasa
                </a>

                @auth
                    <a href="{{ route('pesanan') }}"
                       class="vs-mobile-link {{ request()->routeIs('pesanan') ? 'active' : '' }}">
                        Pesanan Saya
                    </a>
                    @if(auth()->user()->role === 'penyedia')
                        <a href="{{ route('order.masuk') }}"
                           class="vs-mobile-link {{ request()->routeIs('order.masuk') ? 'active' : '' }}">
                            Kelola Pesanan
                        </a>
                    @endif

                    <div class="vs-mobile-divider"></div>

                    <a href="{{ route('profile.view', auth()->id()) }}" class="vs-mobile-link">
                        Profil Saya
                    </a>
                    <a href="{{ route('profile.edit') }}" class="vs-mobile-link">
                        Edit Profil
                    </a>
                    @if(auth()->user()->role === 'penyedia')
                        <a href="{{ route('service.create') }}" class="vs-mobile-link">
                            + Tambah Jasa Baru
                        </a>
                    @elseif(auth()->user()->role === 'pembeli')
                        <a href="{{ route('jadi-penyedia') }}" class="vs-mobile-link">
                            Buka Jasa Saya
                        </a>
                    @endif
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="vs-mobile-link vs-mobile-link--admin">
                            Admin Panel
                        </a>
                    @endif

                    <div class="vs-mobile-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="vs-mobile-logout">Keluar</button>
                    </form>

                @else
                    <div class="vs-mobile-divider"></div>
                    <div class="vs-mobile-auth">
                        <a href="{{ route('login') }}" class="vs-mobile-btn-outline">Masuk</a>
                        <a href="{{ route('register') }}" class="vs-mobile-btn-primary">Daftar Gratis</a>
                    </div>
                @endauth
            </div>
        </div>

    </header>

    <main class="page-main px-6">
        <div class="mx-auto max-w-7xl">

            @if(session('success'))
                <div class="mb-6 flex items-center gap-3 rounded-2xl border px-5 py-4 text-sm font-medium"
                     style="background:#f0fdf4;border-color:#86efac;color:#166534;">
                    <span style="font-size:1.1rem;">&#10003;</span>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 rounded-2xl border px-5 py-4 text-sm"
                     style="background:#fef2f2;border-color:#fecaca;color:#b91c1c;">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    {{-- ══════════════════════════════════════════
         FOOTER — minimal brand, no duplicate nav
    ══════════════════════════════════════════ --}}
    <footer style="background:linear-gradient(135deg,#052e16,#166534);color:#fff;" class="px-6 py-10">
        <div class="mx-auto max-w-7xl">
            <div class="flex flex-col md:flex-row items-start justify-between gap-8 mb-8">

                {{-- Brand --}}
                <div>
                    <div class="mb-3">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="V-Skill"
                             style="height:52px;width:auto;display:block;filter:brightness(0) invert(1);">
                    </div>
                    <p class="text-sm max-w-xs leading-relaxed" style="color:rgba(255,255,255,.55);">
                        Platform jasa kreatif eksklusif untuk mahasiswa UPN "Veteran" Jawa Timur.
                    </p>
                </div>

                {{-- Kontak --}}
                <div class="text-sm" style="color:rgba(255,255,255,.65);">
                    <p class="font-bold text-white mb-3">Hubungi Kami</p>
                    <a href="{{ route('kontak') }}"
                       class="block hover:text-white transition-colors mb-1">
                        Kontak &amp; Dukungan &#8594;
                    </a>
                    <p class="text-xs" style="color:rgba(255,255,255,.38);">+62 812-3456-7890</p>
                </div>
            </div>

            <div class="border-t pt-6 flex flex-col md:flex-row items-center justify-between gap-3 text-xs"
                 style="border-color:rgba(255,255,255,.1);color:rgba(255,255,255,.4);">
                <p>&copy; 2026 V-Skill Platform &mdash; Dibuat oleh mahasiswa Sistem Informasi UPN Veteran Jatim.</p>
                <p>Powered by Laravel &amp; Tailwind CSS</p>
            </div>
        </div>
    </footer>

</div>{{-- .page-shell --}}

@stack('scripts')

<script>
(function () {
    /* ── Desktop user dropdown ── */
    function vsToggleDropdown(e) {
        e.stopPropagation();
        var d = document.getElementById('vsDropdown');
        if (d) d.classList.toggle('open');
    }
    document.addEventListener('click', function () {
        var d = document.getElementById('vsDropdown');
        if (d) d.classList.remove('open');
    });

    /* ── Mobile hamburger drawer ── */
    function vsToggleMobileMenu() {
        var menu = document.getElementById('vsMobileMenu');
        var ham  = document.getElementById('vsHamIcon');
        var cls  = document.getElementById('vsClsIcon');
        if (!menu) return;
        var isOpen = menu.style.display !== 'none';
        menu.style.display = isOpen ? 'none' : 'block';
        if (ham) ham.style.display = isOpen ? 'block' : 'none';
        if (cls) cls.style.display = isOpen ? 'none'  : 'block';
    }

    window.vsToggleDropdown   = vsToggleDropdown;
    window.vsToggleMobileMenu = vsToggleMobileMenu;
}());
</script>
</body>
</html>
