@extends('admin.layout')

@section('title', 'Manajemen Jasa | Admin V-Skill')
@section('page-title', 'Manajemen Jasa')

@section('content')

    {{-- Filter --}}
    <form method="GET" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6 flex flex-wrap gap-3 items-center">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari judul jasa..."
               class="flex-1 min-w-48 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
        <select name="status" class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            <option value="">Semua Status</option>
            <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>
        <button type="submit" class="bg-green-700 hover:bg-green-800 text-white text-sm px-4 py-2 rounded-lg transition-colors">
            Filter
        </button>
        @if(request('search') || request('status'))
            <a href="{{ route('admin.services') }}" class="text-sm text-gray-500 hover:text-gray-700">Reset</a>
        @endif
    </form>

    {{-- Tabel --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-700">
                Daftar Jasa <span class="text-gray-400 font-normal">({{ $services->count() }} data)</span>
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr class="text-left text-xs text-gray-500 uppercase tracking-wide">
                        <th class="px-6 py-3 font-medium">Judul Jasa</th>
                        <th class="px-6 py-3 font-medium">Kategori</th>
                        <th class="px-6 py-3 font-medium">Penyedia</th>
                        <th class="px-6 py-3 font-medium">Harga</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($services as $service)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3 font-medium text-gray-800 max-w-xs">
                                <a href="{{ route('detail', $service) }}" target="_blank"
                                   class="hover:text-green-700 hover:underline">
                                    {{ $service->judul_jasa }}
                                </a>
                            </td>
                            <td class="px-6 py-3 text-gray-600 text-xs">{{ $service->kategori }}</td>
                            <td class="px-6 py-3 text-gray-600">{{ $service->user->nama_lengkap ?? '-' }}</td>
                            <td class="px-6 py-3 text-gray-800 font-medium">
                                Rp {{ number_format($service->harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-3">
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium
                                    {{ $service->status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ ucfirst($service->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-2">
                                    {{-- Toggle Status --}}
                                    <form method="POST" action="{{ route('admin.services.toggle-status', $service) }}">
                                        @csrf
                                        <button type="submit"
                                                class="text-xs px-3 py-1.5 rounded-lg border transition-colors
                                                       {{ $service->status === 'aktif'
                                                            ? 'border-gray-300 text-gray-600 hover:bg-gray-50'
                                                            : 'border-green-300 text-green-600 hover:bg-green-50' }}">
                                            {{ $service->status === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                    {{-- Delete --}}
                                    <form method="POST" action="{{ route('admin.services.delete', $service) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Hapus jasa ini? Order yang terkait juga akan terhapus.')"
                                                class="text-xs px-3 py-1.5 rounded-lg border border-red-300 text-red-600 hover:bg-red-50 transition-colors">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-400">Tidak ada jasa ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
