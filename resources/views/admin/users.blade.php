@extends('admin.layout')

@section('title', 'Manajemen User | Admin V-Skill')
@section('page-title', 'Manajemen User')

@section('content')

    {{-- Export --}}
    <div class="flex gap-3 mb-4">
        <a href="{{ route('admin.export.excel.user') }}"
           class="flex items-center gap-2 text-xs bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg transition-colors font-medium">
            <span>XLS</span> Unduh Excel User
        </a>
        <a href="{{ route('admin.export.pdf.ringkasan') }}" target="_blank"
           class="flex items-center gap-2 text-xs bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors font-medium">
            <span>PDF</span> Laporan Ringkasan
        </a>
    </div>

    {{-- Filter & Search --}}
    <form method="GET" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6 flex flex-wrap gap-3 items-center">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari nama, email, username..."
               class="flex-1 min-w-48 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
        <select name="role" class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            <option value="">Semua Role</option>
            <option value="pembeli" {{ request('role') === 'pembeli' ? 'selected' : '' }}>Pembeli</option>
            <option value="penyedia" {{ request('role') === 'penyedia' ? 'selected' : '' }}>Penyedia</option>
        </select>
        <button type="submit" class="bg-green-700 hover:bg-green-800 text-white text-sm px-4 py-2 rounded-lg transition-colors">
            Filter
        </button>
        @if(request('search') || request('role'))
            <a href="{{ route('admin.users') }}" class="text-sm text-gray-500 hover:text-gray-700">Reset</a>
        @endif
    </form>

    {{-- Tabel --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-sm font-semibold text-gray-700">
                Daftar User <span class="text-gray-400 font-normal">({{ $users->count() }} data)</span>
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr class="text-left text-xs text-gray-500 uppercase tracking-wide">
                        <th class="px-6 py-3 font-medium">Nama</th>
                        <th class="px-6 py-3 font-medium">Email</th>
                        <th class="px-6 py-3 font-medium">Username</th>
                        <th class="px-6 py-3 font-medium">NPM / Prodi</th>
                        <th class="px-6 py-3 font-medium">Role</th>
                        <th class="px-6 py-3 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3 font-medium text-gray-800">{{ $user->nama_lengkap }}</td>
                            <td class="px-6 py-3 text-gray-600 text-xs">{{ $user->email }}</td>
                            <td class="px-6 py-3 text-gray-500">{{ $user->username }}</td>
                            <td class="px-6 py-3 text-gray-500 text-xs">
                                {{ $user->profile?->npm ?? '-' }}<br>
                                <span class="text-gray-400">{{ $user->profile?->prodi ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-3">
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium
                                    {{ $user->role === 'penyedia' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-2">
                                    {{-- Toggle Role --}}
                                    <form method="POST" action="{{ route('admin.users.toggle-role', $user) }}">
                                        @csrf
                                        <button type="submit"
                                                onclick="return confirm('Ubah role {{ $user->nama_lengkap }} menjadi {{ $user->role === 'penyedia' ? 'pembeli' : 'penyedia' }}?')"
                                                class="text-xs px-3 py-1.5 rounded-lg border transition-colors
                                                       {{ $user->role === 'penyedia'
                                                            ? 'border-gray-300 text-gray-600 hover:bg-gray-50'
                                                            : 'border-blue-300 text-blue-600 hover:bg-blue-50' }}">
                                            Jadikan {{ $user->role === 'penyedia' ? 'Pembeli' : 'Penyedia' }}
                                        </button>
                                    </form>
                                    {{-- Delete --}}
                                    <form method="POST" action="{{ route('admin.users.delete', $user) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Hapus user {{ $user->nama_lengkap }}? Semua data terkait akan ikut terhapus.')"
                                                class="text-xs px-3 py-1.5 rounded-lg border border-red-300 text-red-600 hover:bg-red-50 transition-colors">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-400">Tidak ada user ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
