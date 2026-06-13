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
            {{-- Topbar --}}
            <div class="flex items-center justify-between px-6 py-2 text-xs font-semibold text-white" style="background:linear-gradient(90deg,#15803d,#16a34a);">
                <span>&#128276; Platform Jasa Kreatif Eksklusif Mahasiswa UPN Veteran Jawa Timur</span>
                <span class="hidden md:block">&#128222; Hubungi: +62 812-3456-7890</span>
            </div>

            {{-- Main Nav --}}
            <nav class="flex items-center justify-between bg-white px-6 py-3 shadow-md md:px-12" style="border-bottom:2px solid #f0fdf4;">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl font-black text-white text-lg transition-transform group-hover:scale-105"
                         style="background:linear-gradient(135deg,#15803d,#16a34a);box-shadow:0 4px 12px rgba(21,128,61,.35);">
                        V
                    </div>
                    <div>
                        <div class="text-lg font-black leading-tight" style="color:#15803d;letter-spacing:-.02em;">V-Skill</div>
                        <div class="text-xs font-medium leading-none" style="color:#6b7280;">Jasa Mahasiswa UPN</div>
                    </div>
                </a>

                {{-- Nav Links --}}
                <div class="hidden items-center gap-1 text-sm font-semibold text-gray-600 md:flex">
                    <a href="{{ route('home') }}"
                       class="rounded-lg px-3 py-2 transition-all hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('home') ? 'bg-green-50 text-green-700' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('tentang') }}"
                       class="rounded-lg px-3 py-2 transition-all hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('tentang') ? 'bg-green-50 text-green-700' : '' }}">
                        Tentang
                    </a>
                    <a href="{{ route('dashboard') }}"
                       class="rounded-lg px-3 py-2 transition-all hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('dashboard') ? 'bg-green-50 text-green-700' : '' }}">
                        Jelajahi Jasa
                    </a>

                    @auth
                        <a href="{{ route('pesanan') }}"
                           class="rounded-lg px-3 py-2 transition-all hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('pesanan') ? 'bg-green-50 text-green-700' : '' }}">
                            Pesanan
                        </a>
                        @if(auth()->user()->role === 'penyedia')
                            <a href="{{ route('order.masuk') }}"
                               class="rounded-lg px-3 py-2 transition-all hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('order.masuk') ? 'bg-green-50 text-green-700' : '' }}">
                                Order Masuk
                            </a>
                        @endif
                    @endauth

                    <a href="{{ route('kontak') }}"
                       class="rounded-lg px-3 py-2 transition-all hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('kontak') ? 'bg-green-50 text-green-700' : '' }}">
                        Kontak
                    </a>
                </div>

                {{-- Right Actions --}}
                <div class="hidden items-center gap-2 md:flex">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                               class="flex items-center gap-1.5 rounded-xl px-4 py-2 text-sm font-bold text-white transition-all hover:opacity-90 hover:-translate-y-0.5"
                               style="background:linear-gradient(135deg,#064e3b,#15803d);box-shadow:0 4px 14px rgba(21,128,61,.3);">
                                &#9881; Admin Panel
                            </a>
                        @else
                            <a href="{{ route('jadi-penyedia') }}"
                               class="rounded-xl border-2 px-4 py-2 text-sm font-bold transition-all hover:bg-green-50 hover:-translate-y-0.5"
                               style="border-color:#15803d;color:#15803d;">
                                + Buka Jasa
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-lg px-3 py-2 text-sm font-semibold text-red-600 transition-all hover:bg-red-50">
                                Logout
                            </button>
                        </form>

                        <a href="{{ route('profile.view', auth()->id()) }}"
                           class="flex h-10 w-10 items-center justify-center rounded-full font-black text-white text-sm transition-all hover:scale-105 hover:shadow-lg"
                           style="background:linear-gradient(135deg,#15803d,#22c55e);box-shadow:0 4px 12px rgba(21,128,61,.35);"
                           title="{{ auth()->user()->nama_lengkap }}">
                            {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 1)) }}
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="rounded-xl px-5 py-2 text-sm font-bold text-white transition-all hover:opacity-90 hover:-translate-y-0.5"
                           style="background:linear-gradient(135deg,#15803d,#16a34a);box-shadow:0 4px 14px rgba(21,128,61,.3);">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                           class="rounded-xl border-2 px-5 py-2 text-sm font-bold transition-all hover:bg-green-50"
                           style="border-color:#15803d;color:#15803d;">
                            Daftar
                        </a>
                    @endauth
                </div>
            </nav>
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
                    <div class="mb-6 rounded-2xl border px-5 py-4 text-sm" style="background:#fef2f2;border-color:#fecaca;color:#b91c1c;">
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

        <footer style="background:linear-gradient(135deg,#052e16,#166534);color:#fff;" class="px-6 py-14">
            <div class="mx-auto max-w-7xl">
                <div class="flex flex-col md:flex-row items-start justify-between gap-8 mb-10">
                    {{-- Brand --}}
                    <div class="shrink-0">
                        <div class="flex items-center gap-2.5 mb-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-xl font-black text-green-800 text-lg" style="background:#facc15;">V</div>
                            <span class="text-xl font-black" style="letter-spacing:-.02em;">V-Skill</span>
                        </div>
                        <p class="text-sm max-w-xs" style="color:rgba(255,255,255,.65);line-height:1.7;">
                            Platform jasa kreatif eksklusif untuk mahasiswa UPN "Veteran" Jawa Timur.
                        </p>
                    </div>

                    {{-- Links --}}
                    <div class="grid grid-cols-2 gap-x-12 gap-y-2 text-sm" style="color:rgba(255,255,255,.75);">
                        <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                        <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">Jelajahi Jasa</a>
                        <a href="{{ route('tentang') }}" class="hover:text-white transition-colors">Tentang Kami</a>
                        <a href="{{ route('kontak') }}" class="hover:text-white transition-colors">Kontak</a>
                        @guest
                        <a href="{{ route('login') }}" class="hover:text-white transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="hover:text-white transition-colors">Daftar</a>
                        @endguest
                    </div>
                </div>

                <div class="border-t pt-6 flex flex-col md:flex-row items-center justify-between gap-3 text-xs" style="border-color:rgba(255,255,255,.12);color:rgba(255,255,255,.45);">
                    <p>&copy; 2026 V-Skill Platform &mdash; Dibuat oleh mahasiswa Sistem Informasi UPN Veteran Jatim.</p>
                    <p>Powered by Laravel &amp; Tailwind CSS</p>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
