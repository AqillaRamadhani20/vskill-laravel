@extends('admin.layout')

@section('title', 'Manajemen Order | Admin V-Skill')
@section('page-title', 'Manajemen Order')

@section('content')

    {{-- Export Buttons --}}
    <div class="flex gap-3 mb-4">
        <a href="{{ route('admin.export.pdf.order') }}" target="_blank"
           class="flex items-center gap-2 text-xs bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors font-medium">
            <span>PDF</span> Unduh Laporan Order
        </a>
        <a href="{{ route('admin.export.excel.order') }}"
           class="flex items-center gap-2 text-xs bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg transition-colors font-medium">
            <span>XLS</span> Unduh Excel Order
        </a>
    </div>

    {{-- Filter --}}
    <form method="GET" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6 flex flex-wrap gap-3 items-center">
        <select name="status" class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            <option value="">Semua Status</option>
            @foreach(['pending', 'diterima', 'ditolak', 'selesai'] as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-green-700 hover:bg-green-800 text-white text-sm px-4 py-2 rounded-lg transition-colors">
            Filter
        </button>
        @if(request('status'))
            <a href="{{ route('admin.orders') }}" class="text-sm text-gray-500 hover:text-gray-700">Reset</a>
        @endif
    </form>

    {{-- Tabel --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-700">
                Semua Order <span class="text-gray-400 font-normal">({{ $orders->count() }} data)</span>
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr class="text-left text-xs text-gray-500 uppercase tracking-wide">
                        <th class="px-6 py-3 font-medium">Jasa</th>
                        <th class="px-6 py-3 font-medium">Pembeli</th>
                        <th class="px-6 py-3 font-medium">Penyedia</th>
                        <th class="px-6 py-3 font-medium">Harga</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium">Tanggal</th>
                        <th class="px-6 py-3 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $order)
                        @php
                            $cls = match($order->status) {
                                'selesai'  => 'bg-green-100 text-green-700',
                                'diterima' => 'bg-blue-100 text-blue-700',
                                'ditolak'  => 'bg-red-100 text-red-700',
                                default    => 'bg-yellow-100 text-yellow-700',
                            };
                        @endphp
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3 font-medium text-gray-800 max-w-xs">
                                {{ $order->service->judul_jasa ?? '-' }}
                            </td>
                            <td class="px-6 py-3 text-gray-600">{{ $order->buyer->nama_lengkap ?? '-' }}</td>
                            <td class="px-6 py-3 text-gray-600">{{ $order->seller->nama_lengkap ?? '-' }}</td>
                            <td class="px-6 py-3 text-gray-800 font-medium">
                                Rp {{ number_format($order->service->harga ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-3">
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $cls }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-gray-500 text-xs">
                                {{ $order->created_at?->format('d M Y') }}<br>
                                <span class="text-gray-400">{{ $order->created_at?->format('H:i') }}</span>
                            </td>
                            <td class="px-6 py-3">
                                <a href="{{ route('order.detail', $order) }}"
                                   class="text-xs px-3 py-1.5 rounded-lg border border-green-300 text-green-700 hover:bg-green-50 transition-colors">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-400">Tidak ada order ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
