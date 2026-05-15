<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'V-Skill')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/vskill-legacy.css') }}">
</head>

<body class="bg-white text-slate-800">
    <div class="page-shell">
        <header class="fixed-nav">
            <div class="flex items-center justify-between bg-yellow-400 px-6 py-2 text-xs font-medium md:text-sm">
                <span>📢 Platform Jasa Kreatif Eksklusif Mahasiswa UPN Veteran Jawa Timur</span>
                <span class="hidden md:block">📞 Hubungi: +62 812-3456-7890</span>
            </div>

            <nav class="flex items-center justify-between border-b border-gray-300 bg-white px-6 py-4 shadow-sm md:px-12">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="flex h-8 w-8 items-center justify-center rounded-md bg-green-700 font-bold text-white">
                        V
                    </div>
                    <span class="text-xl font-bold tracking-tight text-green-800">V-Skill</span>
                </a>

                <div class="hidden items-center gap-6 text-sm font-semibold text-gray-600 md:flex">
                    <a href="{{ route('home') }}" class="transition-colors hover:text-green-700">Home</a>
                    <a href="{{ route('tentang') }}" class="transition-colors hover:text-green-700">Tentang Kami</a>
                    <a href="{{ route('dashboard') }}" class="transition-colors hover:text-green-700">Dashboard Jasa</a>

                    @auth
                        <a href="{{ route('pesanan') }}" class="transition-colors hover:text-green-700">Pesanan Saya</a>

                        @if(auth()->user()->role === 'penyedia')
                            <a href="{{ route('order.masuk') }}" class="transition-colors hover:text-green-700">Order Masuk</a>
                        @endif
                    @endauth

                    <a href="{{ route('kontak') }}" class="transition-colors hover:text-green-700">Kontak</a>

                    @auth
                        <a
                            href="{{ route('jadi-penyedia') }}"
                            class="rounded-lg border border-green-700 px-4 py-2 text-green-700 transition-all hover:bg-green-50"
                        >
                            Buka Jasa
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-600 transition-colors hover:text-red-700">
                                Logout
                            </button>
                        </form>

                        <a
                            href="{{ route('profile.view', auth()->id()) }}"
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-green-700 font-bold text-white"
                            title="Profil"
                        >
                            {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 1)) }}
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="rounded-lg bg-green-700 px-5 py-2 text-white transition-all hover:bg-green-800"
                        >
                            Login
                        </a>
                    @endauth
                </div>
            </nav>
        </header>

        <main class="page-main px-6">
            <div class="mx-auto max-w-7xl">
                @if(session('success'))
                    <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <footer class="bg-green-800 px-6 py-12 text-white">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-6 md:flex-row">
                <div class="flex items-center gap-2">
                    <div class="flex h-8 w-8 items-center justify-center rounded-md bg-white font-bold text-green-800">
                        V
                    </div>
                    <span class="text-xl font-bold tracking-tight">V-Skill</span>
                </div>

                <p class="text-sm text-green-100">
                    © 2026 V-Skill Platform. Dibuat oleh mahasiswa Sistem Informasi UPN Veteran Jatim.
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
