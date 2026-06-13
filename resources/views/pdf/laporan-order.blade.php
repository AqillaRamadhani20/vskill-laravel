<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'DejaVu Sans', sans-serif; font-size: 11px; color: #1e293b; background: #fff; }

    .header { background: #15803d; color: #fff; padding: 20px 30px; margin-bottom: 24px; }
    .header-top { display: flex; justify-content: space-between; align-items: flex-start; }
    .logo { font-size: 22px; font-weight: 700; }
    .logo span { font-size: 11px; font-weight: 400; display: block; opacity: 0.8; margin-top: 2px; }
    .header-meta { text-align: right; font-size: 10px; opacity: 0.85; }
    .report-title { margin-top: 14px; font-size: 15px; font-weight: 600; }

    .filter-info { margin: 0 30px 16px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px; padding: 8px 14px; font-size: 10px; color: #166534; }

    .section { margin: 0 30px 20px; }
    .section-title { font-size: 12px; font-weight: 700; color: #15803d; border-bottom: 2px solid #15803d; padding-bottom: 4px; margin-bottom: 12px; text-transform: uppercase; }

    table { width: 100%; border-collapse: collapse; font-size: 10px; }
    table thead tr { background: #15803d; color: #fff; }
    table thead th { padding: 8px 10px; text-align: left; font-weight: 600; }
    table tbody tr:nth-child(even) { background: #f8fafc; }
    table tbody tr:nth-child(odd) { background: #ffffff; }
    table tbody td { padding: 6px 10px; border-bottom: 1px solid #e2e8f0; vertical-align: top; }

    .badge { display: inline-block; padding: 2px 7px; border-radius: 20px; font-size: 9px; font-weight: 600; }
    .badge-pending  { background: #fef9c3; color: #854d0e; }
    .badge-diterima { background: #dbeafe; color: #1d4ed8; }
    .badge-selesai  { background: #dcfce7; color: #15803d; }
    .badge-ditolak  { background: #fee2e2; color: #dc2626; }

    .summary-row { background: #f0fdf4 !important; font-weight: 600; color: #166534; }

    .footer { margin: 20px 30px 16px; border-top: 1px solid #e2e8f0; padding-top: 10px; display: flex; justify-content: space-between; font-size: 9px; color: #94a3b8; }
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
            Oleh: {{ auth()->user()?->nama_lengkap ?? 'Admin' }}
        </div>
    </div>
    <div class="report-title">Laporan Detail Transaksi Order</div>
</div>

<div class="filter-info">
    Periode: Semua &nbsp;|&nbsp;
    Total: {{ $orders->count() }} order &nbsp;|&nbsp;
    Selesai: {{ $orders->where('status', 'selesai')->count() }} &nbsp;|&nbsp;
    Pending: {{ $orders->where('status', 'pending')->count() }} &nbsp;|&nbsp;
    Total Nilai: Rp {{ number_format($orders->sum(fn($o) => $o->service->harga ?? 0), 0, ',', '.') }}
</div>

<div class="section">
    <div class="section-title">Data Transaksi Order ({{ $orders->count() }} data)</div>
    <table>
        <thead>
            <tr>
                <th width="4%">#</th>
                <th width="22%">Judul Jasa</th>
                <th width="14%">Kategori</th>
                <th width="14%">Pembeli</th>
                <th width="14%">Penyedia</th>
                <th width="11%">Harga (Rp)</th>
                <th width="9%">Status</th>
                <th width="12%">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $i => $order)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $order->service->judul_jasa ?? '-' }}</td>
                    <td>{{ $order->service->kategori ?? '-' }}</td>
                    <td>{{ $order->buyer->nama_lengkap ?? '-' }}</td>
                    <td>{{ $order->seller->nama_lengkap ?? '-' }}</td>
                    <td>{{ number_format($order->service->harga ?? 0, 0, ',', '.') }}</td>
                    <td><span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                    <td>{{ $order->created_at?->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="8" style="text-align:center;padding:16px;color:#94a3b8;">Belum ada data order.</td></tr>
            @endforelse

            @if($orders->count() > 0)
                <tr class="summary-row">
                    <td colspan="5" style="text-align:right;padding-right:10px;">Total Nilai Order:</td>
                    <td colspan="3">Rp {{ number_format($orders->sum(fn($o) => $o->service->harga ?? 0), 0, ',', '.') }}</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<div class="footer">
    <span>V-Skill &mdash; Platform Jasa Mahasiswa UPN Veteran Jawa Timur</span>
    <span>Laporan ini dibuat otomatis pada {{ now()->format('d F Y') }}</span>
</div>

</body>
</html>
