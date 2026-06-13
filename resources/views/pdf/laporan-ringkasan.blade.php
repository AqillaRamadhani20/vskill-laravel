<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'DejaVu Sans', sans-serif; font-size: 11px; color: #1e293b; background: #fff; }

    .header { background: #15803d; color: #fff; padding: 20px 30px; margin-bottom: 24px; }
    .header-top { display: flex; justify-content: space-between; align-items: flex-start; }
    .logo { font-size: 22px; font-weight: 700; letter-spacing: -0.5px; }
    .logo span { font-size: 12px; font-weight: 400; display: block; opacity: 0.8; margin-top: 2px; }
    .header-meta { text-align: right; font-size: 10px; opacity: 0.85; }
    .report-title { margin-top: 14px; font-size: 15px; font-weight: 600; }

    .section { margin: 0 30px 20px; }
    .section-title { font-size: 12px; font-weight: 700; color: #15803d; border-bottom: 2px solid #15803d; padding-bottom: 4px; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px; }

    .stat-grid { display: table; width: 100%; border-collapse: separate; border-spacing: 8px; }
    .stat-row { display: table-row; }
    .stat-cell { display: table-cell; width: 25%; background: #f0fdf4; border: 1px solid #bbf7d0; padding: 10px 12px; border-radius: 6px; vertical-align: top; }
    .stat-value { font-size: 22px; font-weight: 700; color: #15803d; }
    .stat-label { font-size: 10px; color: #64748b; margin-top: 2px; }

    .order-stat-grid { display: table; width: 100%; border-collapse: separate; border-spacing: 8px; }
    .order-stat-row { display: table-row; }
    .order-stat-cell { display: table-cell; width: 25%; padding: 8px 12px; border-radius: 6px; vertical-align: top; text-align: center; }
    .order-stat-cell.pending  { background: #fefce8; border: 1px solid #fde68a; color: #92400e; }
    .order-stat-cell.diterima { background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; }
    .order-stat-cell.selesai  { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; }
    .order-stat-cell.ditolak  { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }
    .order-stat-value { font-size: 20px; font-weight: 700; }
    .order-stat-label { font-size: 10px; margin-top: 2px; }

    table { width: 100%; border-collapse: collapse; font-size: 10px; }
    table thead tr { background: #15803d; color: #fff; }
    table thead th { padding: 7px 10px; text-align: left; font-weight: 600; }
    table tbody tr:nth-child(even) { background: #f8fafc; }
    table tbody tr:nth-child(odd) { background: #ffffff; }
    table tbody td { padding: 6px 10px; border-bottom: 1px solid #e2e8f0; vertical-align: top; }

    .badge { display: inline-block; padding: 2px 7px; border-radius: 20px; font-size: 9px; font-weight: 600; }
    .badge-pending  { background: #fef9c3; color: #854d0e; }
    .badge-diterima { background: #dbeafe; color: #1d4ed8; }
    .badge-selesai  { background: #dcfce7; color: #15803d; }
    .badge-ditolak  { background: #fee2e2; color: #dc2626; }

    .footer { margin: 24px 30px 20px; border-top: 1px solid #e2e8f0; padding-top: 10px; display: flex; justify-content: space-between; font-size: 9px; color: #94a3b8; }
</style>
</head>
<body>

<div class="header">
    <div class="header-top">
        <div class="logo">V-Skill
            <span>Platform Jasa Mahasiswa UPN Veteran Jawa Timur</span>
        </div>
        <div class="header-meta">
            Dicetak: {{ now()->format('d F Y, H:i') }} WIB<br>
            Dibuat oleh: {{ auth()->user()?->nama_lengkap ?? 'Admin' }}
        </div>
    </div>
    <div class="report-title">Laporan Ringkasan Platform V-Skill</div>
</div>

{{-- Statistik Utama --}}
<div class="section">
    <div class="section-title">Statistik Platform</div>
    <div class="stat-grid">
        <div class="stat-row">
            <div class="stat-cell">
                <div class="stat-value">{{ $stats['total_users'] }}</div>
                <div class="stat-label">Total Pengguna</div>
            </div>
            <div class="stat-cell">
                <div class="stat-value">{{ $stats['total_penyedia'] }}</div>
                <div class="stat-label">Penyedia Jasa</div>
            </div>
            <div class="stat-cell">
                <div class="stat-value">{{ $stats['total_services'] }}</div>
                <div class="stat-label">Total Jasa ({{ $stats['total_services_aktif'] }} aktif)</div>
            </div>
            <div class="stat-cell">
                <div class="stat-value">{{ $stats['total_orders'] }}</div>
                <div class="stat-label">Total Transaksi Order</div>
            </div>
        </div>
    </div>
</div>

{{-- Statistik Order --}}
<div class="section">
    <div class="section-title">Status Transaksi Order</div>
    <div class="order-stat-grid">
        <div class="order-stat-row">
            <div class="order-stat-cell pending">
                <div class="order-stat-value">{{ $stats['orders_pending'] }}</div>
                <div class="order-stat-label">Pending</div>
            </div>
            <div class="order-stat-cell diterima">
                <div class="order-stat-value">{{ $stats['orders_diterima'] }}</div>
                <div class="order-stat-label">Diterima</div>
            </div>
            <div class="order-stat-cell selesai">
                <div class="order-stat-value">{{ $stats['orders_selesai'] }}</div>
                <div class="order-stat-label">Selesai</div>
            </div>
            <div class="order-stat-cell ditolak">
                <div class="order-stat-value">{{ $stats['orders_ditolak'] }}</div>
                <div class="order-stat-label">Ditolak</div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Order --}}
<div class="section">
    <div class="section-title">Rekap Transaksi Order ({{ $orders->count() }} data)</div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Judul Jasa</th>
                <th>Pembeli</th>
                <th>Penyedia</th>
                <th>Harga (Rp)</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $i => $order)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $order->service->judul_jasa ?? '-' }}</td>
                    <td>{{ $order->buyer->nama_lengkap ?? '-' }}</td>
                    <td>{{ $order->seller->nama_lengkap ?? '-' }}</td>
                    <td>{{ number_format($order->service->harga ?? 0, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                    </td>
                    <td>{{ $order->created_at?->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align:center;color:#94a3b8;padding:16px;">Belum ada data order.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Tabel Penyedia --}}
<div class="section">
    <div class="section-title">Daftar Penyedia Jasa ({{ $penyedia->count() }} data)</div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>NPM</th>
                <th>Prodi</th>
                <th>Jumlah Jasa</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penyedia as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $p->nama_lengkap }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->profile?->npm ?? '-' }}</td>
                    <td>{{ $p->profile?->prodi ?? '-' }}</td>
                    <td>{{ $p->services->count() }}</td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center;color:#94a3b8;padding:16px;">Belum ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="footer">
    <span>V-Skill &mdash; Platform Jasa Mahasiswa UPN Veteran Jawa Timur</span>
    <span>Laporan ini dibuat secara otomatis pada {{ now()->format('d F Y') }}</span>
</div>

</body>
</html>
