<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'DejaVu Sans', sans-serif; font-size: 11px; color: #1e293b; background: #fff; }

    /* ── HEADER ── */
    .header {
        background: #15803d;
        color: #fff;
        padding: 18px 24px 14px;
        border-radius: 0 0 12px 12px;
        margin-bottom: 20px;
    }
    .header-top { display: flex; justify-content: space-between; align-items: flex-start; }
    .logo { font-size: 22px; font-weight: 700; letter-spacing: -.5px; }
    .logo-sub { font-size: 9px; opacity: .75; margin-top: 2px; }
    .struk-label {
        background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.25);
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 9px;
        font-weight: 600;
        letter-spacing: .05em;
        text-transform: uppercase;
    }
    .struk-title { margin-top: 12px; font-size: 13px; font-weight: 600; opacity: .9; }

    /* ── STATUS BANNER ── */
    .status-banner {
        text-align: center;
        padding: 10px 16px;
        border-radius: 8px;
        margin: 0 24px 18px;
        background: #dcfce7;
        border: 1px solid #86efac;
        color: #166534;
        font-weight: 700;
        font-size: 12px;
        letter-spacing: .01em;
    }
    .status-banner .check {
        display: inline-block;
        width: 18px; height: 18px;
        background: #15803d;
        color: #fff;
        border-radius: 50%;
        text-align: center;
        line-height: 18px;
        font-size: 10px;
        margin-right: 5px;
        font-weight: 800;
    }

    /* ── SECTIONS ── */
    .section { margin: 0 24px 16px; }

    .section-title {
        font-size: 9px;
        font-weight: 700;
        color: #15803d;
        text-transform: uppercase;
        letter-spacing: .06em;
        border-bottom: 1.5px solid #bbf7d0;
        padding-bottom: 4px;
        margin-bottom: 10px;
    }

    /* ── INFO GRID ── */
    .info-grid { display: table; width: 100%; border-collapse: separate; border-spacing: 0 4px; }
    .info-row { display: table-row; }
    .info-label { display: table-cell; width: 38%; color: #64748b; padding: 3px 8px 3px 0; font-size: 10px; }
    .info-value { display: table-cell; color: #1e293b; font-weight: 600; padding: 3px 0; font-size: 10px; }

    /* ── SERVICE BOX ── */
    .service-box {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 8px;
        padding: 12px 14px;
        margin-bottom: 4px;
    }
    .service-box h3 { font-size: 13px; font-weight: 700; color: #14532d; margin-bottom: 4px; line-height: 1.35; }
    .service-kategori { font-size: 9px; background: #dcfce7; color: #15803d; padding: 2px 8px; border-radius: 20px; font-weight: 700; display: inline-block; margin-bottom: 8px; }

    /* ── PRICE BOX ── */
    .price-box {
        background: #15803d;
        color: #fff;
        border-radius: 8px;
        padding: 12px 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }
    .price-label { font-size: 10px; opacity: .8; }
    .price-value { font-size: 20px; font-weight: 700; }

    /* ── TWO COLUMN ── */
    .two-col { display: table; width: 100%; border-collapse: separate; border-spacing: 8px 0; }
    .col { display: table-cell; width: 50%; vertical-align: top; }
    .info-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 10px 12px;
    }
    .info-card h4 { font-size: 9px; font-weight: 700; color: #15803d; margin-bottom: 6px; text-transform: uppercase; letter-spacing: .05em; }
    .info-card p { margin: 0 0 3px; font-size: 10px; color: #374151; line-height: 1.5; }

    /* ── CATATAN ── */
    .catatan-box {
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 8px;
        padding: 10px 12px;
    }
    .catatan-box h4 { font-size: 9px; font-weight: 700; color: #92400e; margin-bottom: 5px; text-transform: uppercase; letter-spacing: .05em; }
    .catatan-box p { margin: 0; font-size: 10px; color: #374151; line-height: 1.65; }

    /* ── NO STRUK ── */
    .no-struk {
        text-align: right;
        font-size: 9px;
        color: #94a3b8;
        margin: 0 24px 14px;
    }

    /* ── FOOTER ── */
    .footer {
        margin: 16px 24px 0;
        border-top: 1px dashed #e2e8f0;
        padding-top: 10px;
        text-align: center;
        font-size: 9px;
        color: #94a3b8;
        line-height: 1.7;
    }
    .footer strong { color: #15803d; }
</style>
</head>
<body>

{{-- HEADER --}}
<div class="header">
    <div class="header-top">
        <div>
            <div class="logo">V-Skill</div>
            <div class="logo-sub">Platform Jasa Mahasiswa UPN Veteran Jawa Timur</div>
        </div>
        <div class="struk-label">Struk Pembelian</div>
    </div>
    <div class="struk-title">Bukti Transaksi Order Jasa</div>
</div>

{{-- STATUS --}}
<div class="status-banner">
    <span class="check">&#10003;</span>
    Transaksi Selesai &mdash; Order berhasil diselesaikan
</div>

{{-- NO STRUK --}}
<div class="no-struk">
    No. Struk: <strong>VSKL-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</strong>
    &nbsp;&nbsp;|&nbsp;&nbsp;
    Dicetak: {{ now()->format('d M Y, H:i') }} WIB
</div>

{{-- DETAIL JASA --}}
<div class="section">
    <div class="section-title">Detail Jasa</div>
    <div class="service-box">
        <div class="service-kategori">{{ $order->service->kategori ?? '-' }}</div>
        <h3>{{ $order->service->judul_jasa ?? '-' }}</h3>
        <div class="info-grid">
            <div class="info-row">
                <span class="info-label">Estimasi Pengerjaan</span>
                <span class="info-value">{{ $order->service->estimasi_pengerjaan ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal Order</span>
                <span class="info-value">{{ $order->created_at?->format('d M Y, H:i') }}</span>
            </div>
        </div>
    </div>
</div>

{{-- HARGA --}}
<div class="section">
    <div class="price-box">
        <div>
            <div class="price-label">Total Pembayaran</div>
            <div style="font-size:9px;opacity:.7;margin-top:2px;">Sudah termasuk biaya layanan</div>
        </div>
        <div class="price-value">Rp {{ number_format($order->service->harga ?? 0, 0, ',', '.') }}</div>
    </div>
</div>

{{-- INFO PEMBELI & PENYEDIA --}}
<div class="section">
    <div class="section-title">Pihak Transaksi</div>
    <div class="two-col">
        <div class="col">
            <div class="info-card">
                <h4>Pembeli</h4>
                <p><strong>{{ $order->buyer->nama_lengkap ?? '-' }}</strong></p>
                <p>{{ $order->buyer->email ?? '-' }}</p>
                <p>{{ $order->buyer->profile->prodi ?? '-' }}</p>
                <p>WA: {{ $order->no_wa }}</p>
            </div>
        </div>
        <div class="col">
            <div class="info-card">
                <h4>Penyedia</h4>
                <p><strong>{{ $order->seller->nama_lengkap ?? '-' }}</strong></p>
                <p>{{ $order->seller->email ?? '-' }}</p>
                <p>{{ $order->seller->profile->prodi ?? '-' }}</p>
                <p>WA: {{ $order->seller->profile->kontak_wa ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>

{{-- CATATAN --}}
@if($order->catatan)
<div class="section">
    <div class="section-title">Catatan Kebutuhan</div>
    <div class="catatan-box">
        <p>{{ $order->catatan }}</p>
    </div>
</div>
@endif

{{-- FOOTER --}}
<div class="footer">
    Struk ini adalah bukti resmi transaksi di platform <strong>V-Skill</strong>.<br>
    Simpan dokumen ini sebagai bukti pembayaran yang sah.<br>
    Platform Jasa Mahasiswa UPN "Veteran" Jawa Timur &mdash; vskill.upnjatim.ac.id
</div>

</body>
</html>
