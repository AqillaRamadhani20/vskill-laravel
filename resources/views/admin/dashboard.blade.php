@extends('admin.layout')

@section('title', 'Dashboard | Admin V-Skill')
@section('page-title', 'Dashboard Admin')

@section('content')

    {{-- Stat Cards Utama --}}
    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Total User</p>
            <p class="text-3xl font-bold text-green-700 mt-1">{{ $stats['total_users'] }}</p>
            <p class="text-xs text-gray-400 mt-1">Penyedia & Pembeli</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Penyedia Jasa</p>
            <p class="text-3xl font-bold text-blue-600 mt-1">{{ $stats['total_penyedia'] }}</p>
            <p class="text-xs text-gray-400 mt-1">Akun aktif penyedia</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Total Jasa</p>
            <p class="text-3xl font-bold text-purple-600 mt-1">{{ $stats['total_services'] }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ $stats['total_services_aktif'] }} aktif</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Total Order</p>
            <p class="text-3xl font-bold text-orange-500 mt-1">{{ $stats['total_orders'] }}</p>
            <p class="text-xs text-gray-400 mt-1">Semua transaksi</p>
        </div>
    </div>

    {{-- Stat Cards Order Status --}}
    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4 mb-8">
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-center">
            <p class="text-2xl font-bold text-yellow-600">{{ $stats['orders_pending'] }}</p>
            <p class="text-xs text-yellow-700 font-medium mt-1">Pending</p>
        </div>
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-center">
            <p class="text-2xl font-bold text-blue-600">{{ $stats['orders_diterima'] }}</p>
            <p class="text-xs text-blue-700 font-medium mt-1">Diterima</p>
        </div>
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-center">
            <p class="text-2xl font-bold text-green-600">{{ $stats['orders_selesai'] }}</p>
            <p class="text-xs text-green-700 font-medium mt-1">Selesai</p>
        </div>
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
            <p class="text-2xl font-bold text-red-500">{{ $stats['orders_ditolak'] }}</p>
            <p class="text-xs text-red-700 font-medium mt-1">Ditolak</p>
        </div>
    </div>

    {{-- Charts --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Status Order</h3>
            <canvas id="chart-orders-status" height="220"></canvas>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Komposisi User</h3>
            <canvas id="chart-users-role" height="220"></canvas>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Jasa per Kategori</h3>
            <canvas id="chart-services-category" height="220"></canvas>
        </div>
    </div>

    {{-- Export / Laporan --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
        <h3 class="text-sm font-semibold text-gray-700 mb-4">Ekspor Laporan</h3>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
            <a href="{{ route('admin.export.pdf.ringkasan') }}" target="_blank"
               class="flex flex-col items-center gap-2 p-4 border-2 border-dashed border-red-200 rounded-xl hover:bg-red-50 hover:border-red-400 transition-colors group">
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center group-hover:bg-red-200 transition-colors">
                    <span class="text-red-600 font-bold text-xs">PDF</span>
                </div>
                <div class="text-center">
                    <p class="text-xs font-semibold text-gray-700">Laporan Ringkasan</p>
                    <p class="text-xs text-gray-400">Statistik platform</p>
                </div>
            </a>
            <a href="{{ route('admin.export.pdf.order') }}" target="_blank"
               class="flex flex-col items-center gap-2 p-4 border-2 border-dashed border-red-200 rounded-xl hover:bg-red-50 hover:border-red-400 transition-colors group">
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center group-hover:bg-red-200 transition-colors">
                    <span class="text-red-600 font-bold text-xs">PDF</span>
                </div>
                <div class="text-center">
                    <p class="text-xs font-semibold text-gray-700">Laporan Order</p>
                    <p class="text-xs text-gray-400">Detail semua transaksi</p>
                </div>
            </a>
        </div>
    </div>

    {{-- Recent Orders --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-gray-700">Order Terbaru</h3>
            <a href="{{ route('admin.orders') }}" class="text-xs text-green-600 hover:underline">Lihat semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 text-left text-xs text-gray-500 uppercase">
                        <th class="pb-3 font-medium">Jasa</th>
                        <th class="pb-3 font-medium">Pembeli</th>
                        <th class="pb-3 font-medium">Penyedia</th>
                        <th class="pb-3 font-medium">Status</th>
                        <th class="pb-3 font-medium">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 font-medium text-gray-800 max-w-xs truncate">
                                {{ $order->service->judul_jasa ?? '-' }}
                            </td>
                            <td class="py-3 text-gray-600">{{ $order->buyer->nama_lengkap ?? '-' }}</td>
                            <td class="py-3 text-gray-600">{{ $order->seller->nama_lengkap ?? '-' }}</td>
                            <td class="py-3">
                                @php
                                    $cls = match($order->status) {
                                        'selesai'  => 'bg-green-100 text-green-700',
                                        'diterima' => 'bg-blue-100 text-blue-700',
                                        'ditolak'  => 'bg-red-100 text-red-700',
                                        default    => 'bg-yellow-100 text-yellow-700',
                                    };
                                @endphp
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $cls }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="py-3 text-gray-500 text-xs">
                                {{ $order->created_at?->format('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-gray-400 text-sm">Belum ada order.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const ordersData  = @json($chartData['orders_by_status']);
    const usersData   = @json($chartData['users_by_role']);
    const servicesData = @json($chartData['services_by_category']);

    // Chart 1: Donut - Status Order
    new Chart(document.getElementById('chart-orders-status'), {
        type: 'doughnut',
        data: {
            labels: Object.keys(ordersData).map(s => s.charAt(0).toUpperCase() + s.slice(1)),
            datasets: [{
                data: Object.values(ordersData),
                backgroundColor: ['#fbbf24','#3b82f6','#22c55e','#ef4444'],
                borderWidth: 2,
                borderColor: '#fff',
            }]
        },
        options: { plugins: { legend: { position: 'bottom', labels: { font: { size: 11 } } } }, cutout: '60%' }
    });

    // Chart 2: Pie - Komposisi User
    new Chart(document.getElementById('chart-users-role'), {
        type: 'pie',
        data: {
            labels: Object.keys(usersData).map(s => s.charAt(0).toUpperCase() + s.slice(1)),
            datasets: [{
                data: Object.values(usersData),
                backgroundColor: ['#6366f1','#10b981'],
                borderWidth: 2,
                borderColor: '#fff',
            }]
        },
        options: { plugins: { legend: { position: 'bottom', labels: { font: { size: 11 } } } } }
    });

    // Chart 3: Bar - Jasa per Kategori
    new Chart(document.getElementById('chart-services-category'), {
        type: 'bar',
        data: {
            labels: Object.keys(servicesData),
            datasets: [{
                label: 'Jumlah Jasa',
                data: Object.values(servicesData),
                backgroundColor: '#16a34a',
                borderRadius: 6,
            }]
        },
        options: {
            indexAxis: 'y',
            plugins: { legend: { display: false } },
            scales: {
                x: { ticks: { font: { size: 10 } }, grid: { color: '#f0fdf4' } },
                y: { ticks: { font: { size: 10 } } }
            }
        }
    });
</script>
@endpush
