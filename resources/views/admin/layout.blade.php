<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel | V-Skill')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
    @stack('head')
</head>
<body class="bg-gray-100 text-slate-800">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-green-900 text-white flex flex-col fixed h-full z-10">
        <div class="px-6 py-5 border-b border-green-700">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <div class="w-9 h-9 bg-white rounded-lg flex items-center justify-center font-bold text-green-800 text-lg">V</div>
                <div>
                    <div class="font-bold text-sm leading-tight">V-Skill</div>
                    <div class="text-xs text-green-300 leading-tight">Panel Admin</div>
                </div>
            </a>
        </div>

        <nav class="flex-1 px-3 py-5 space-y-1">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                      {{ request()->routeIs('admin.dashboard') ? 'bg-green-600 text-white' : 'text-green-200 hover:bg-green-800' }}">
                <span class="w-5 text-center">&#9783;</span> Dashboard
            </a>
            <a href="{{ route('admin.users') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                      {{ request()->routeIs('admin.users') ? 'bg-green-600 text-white' : 'text-green-200 hover:bg-green-800' }}">
                <span class="w-5 text-center">&#128101;</span> Manajemen User
            </a>
            <a href="{{ route('admin.services') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                      {{ request()->routeIs('admin.services') ? 'bg-green-600 text-white' : 'text-green-200 hover:bg-green-800' }}">
                <span class="w-5 text-center">&#128295;</span> Manajemen Jasa
            </a>
            <a href="{{ route('admin.orders') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                      {{ request()->routeIs('admin.orders') ? 'bg-green-600 text-white' : 'text-green-200 hover:bg-green-800' }}">
                <span class="w-5 text-center">&#128203;</span> Manajemen Order
            </a>
        </nav>

        <div class="px-4 py-4 border-t border-green-700 space-y-2">
            <p class="text-xs text-green-400 truncate">{{ auth()->user()->nama_lengkap }}</p>
            <a href="{{ route('home') }}"
               class="block text-center text-xs text-green-300 hover:text-white py-1.5 rounded-lg border border-green-700 hover:border-green-500 transition-colors">
                Kembali ke Situs
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full text-xs bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg transition-colors">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="ml-64 flex-1 flex flex-col min-h-screen">
        <header class="bg-white border-b border-gray-200 px-8 py-4">
            <h1 class="text-lg font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>
        </header>

        <main class="flex-1 p-8">
            @if(session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</div>

@stack('scripts')
</body>
</html>
