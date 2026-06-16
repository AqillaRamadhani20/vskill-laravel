@extends('layouts.app')

@section('title', 'Pesan Jasa — ' . $service->judul_jasa . ' | V-Skill')

@section('content')
<section class="order-create-page">
    <a href="{{ route('detail', $service) }}" class="pd-back-chip">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        Kembali ke Detail Jasa
    </a>

    <div class="order-create-layout">

        {{-- LEFT: Service Summary --}}
        <aside class="order-service-summary">
            <div class="of-svc-gradient">
                <div class="of-svc-gradient-inner">
                    <span class="badge" style="background:rgba(255,255,255,.18);color:#fff;border:1px solid rgba(255,255,255,.3);">
                        {{ $service->kategori }}
                    </span>
                </div>
            </div>

            <div class="of-svc-body">
                <h2 class="of-svc-title">{{ $service->judul_jasa }}</h2>
                <p class="order-summary-provider">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    {{ $service->user->nama_lengkap }}
                    @if($service->user->profile?->prodi)
                        &bull; {{ $service->user->profile->prodi }}
                    @endif
                </p>

                <div class="order-summary-box green">
                    <span>Harga Jasa</span>
                    <strong>Rp {{ number_format($service->harga, 0, ',', '.') }}</strong>
                </div>

                <div class="order-summary-box green">
                    <span>Estimasi Pengerjaan</span>
                    <strong>{{ $service->estimasi_pengerjaan ?? 'Diskusi' }}</strong>
                </div>

                <div class="order-summary-box">
                    <span>Deskripsi Singkat</span>
                    <p>{{ mb_strlen($service->deskripsi) > 160 ? mb_substr($service->deskripsi, 0, 160) . '...' : $service->deskripsi }}</p>
                </div>

                <div class="of-payment-note">
                    <div class="of-payment-icon">💡</div>
                    <div>
                        <p class="of-payment-title">Langkah Selanjutnya</p>
                        <p class="of-payment-text">Setelah order dikirim, penyedia akan menghubungimu via WhatsApp untuk diskusi dan konfirmasi pembayaran.</p>
                    </div>
                </div>
            </div>
        </aside>

        {{-- RIGHT: Form --}}
        <form method="POST" action="{{ route('order.store', $service) }}" class="order-create-card" style="position:relative;">
            @csrf

            <div class="of-form-header">
                <div class="of-form-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                </div>
                <div>
                    <h1 class="order-create-card h1" style="font-size:1.5rem;font-weight:800;color:var(--vs-green-900);margin:0 0 .2rem;">Form Pesan Jasa</h1>
                    <p class="order-create-subtitle" style="margin:0;">Isi kebutuhanmu dengan jelas agar penyedia bisa memahami brief yang kamu inginkan.</p>
                </div>
            </div>

            <div class="form-group" style="margin-top:1.5rem;">
                <label for="nama_pemesan">Nama Pemesan</label>
                <div class="input-icon-group">
                    <span class="input-icon">👤</span>
                    <input type="text" id="nama_pemesan" value="{{ auth()->user()->nama_lengkap }}"
                           class="form-control input-with-icon" readonly
                           style="background:#f9fafb;cursor:not-allowed;">
                </div>
            </div>

            @php $buyerWa = auth()->user()->profile?->kontak_wa; @endphp
            <div class="form-group">
                <label for="no_wa">Nomor WhatsApp Pemesan</label>
                @if($buyerWa)
                    <div class="of-wa-locked">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="color:#25d366;flex-shrink:0;"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.554 4.116 1.528 5.844L0 24l6.336-1.508A11.938 11.938 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.013-1.376l-.36-.214-3.727.977.994-3.634-.234-.373A9.818 9.818 0 1112 21.818z"/></svg>
                        <span class="of-wa-number">{{ $buyerWa }}</span>
                        <span class="of-wa-lock-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </span>
                    </div>
                    <p class="form-help">Diambil otomatis dari profilmu &bull; <a href="{{ route('profile.edit') }}" style="color:var(--vs-primary);">Ubah di Edit Profil</a></p>
                @else
                    <div class="of-wa-missing">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        Nomor WhatsApp belum diisi di profil.
                        <a href="{{ route('profile.edit') }}">Tambahkan sekarang</a>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="catatan">Catatan Kebutuhan <span style="color:var(--vs-danger);">*</span></label>
                <textarea id="catatan" name="catatan" class="form-control" rows="6"
                          placeholder="Jelaskan kebutuhanmu, detail project, deadline, revisi, atau hal lain yang perlu diketahui penyedia jasa..."
                          required>{{ old('catatan') }}</textarea>
                <p class="form-help">Semakin detail catatanmu, semakin cepat proses dikonfirmasi.</p>
            </div>

            <div class="order-create-warning">
                <strong>⚠️ Catatan Penting:</strong> Pastikan nomor WhatsApp aktif karena penyedia akan menghubungimu untuk diskusi lebih lanjut dan konfirmasi pembayaran.
            </div>

            <div class="of-submit-area">
                <button type="submit" class="btn-primary w-full" style="padding:1rem;font-size:1rem;"
                        {{ $buyerWa ? '' : 'disabled' }}>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    Kirim Pesanan Sekarang
                </button>

                @if($service->user->profile?->kontak_wa)
                    @php
                        $waOrder = preg_replace('/[^0-9]/', '', $service->user->profile->kontak_wa);
                        if (str_starts_with($waOrder, '0')) $waOrder = '62' . substr($waOrder, 1);
                    @endphp
                    <a href="https://wa.me/{{ $waOrder }}" target="_blank" class="btn-outline w-full">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967c-.273-.099-.471-.148-.67.15c-.197.297-.767.966-.94 1.164c-.173.199-.347.223-.644.075c-.297-.15-1.255-.463-2.39-1.475c-.883-.788-1.48-1.761-1.653-2.059c-.173-.297-.018-.458.13-.606c.134-.133.298-.347.446-.52c.149-.174.198-.298.298-.497c.099-.198.05-.371-.025-.52c-.075-.149-.669-1.612-.916-2.207c-.242-.579-.487-.5-.669-.51c-.173-.008-.371-.01-.57-.01c-.198 0-.52.074-.792.372c-.272.297-1.04 1.016-1.04 2.479c0 1.462 1.065 2.875 1.213 3.074c.149.198 2.096 3.2 5.077 4.487c.709.306 1.262.489 1.694.625c.712.227 1.36.195 1.871.118c.571-.085 1.758-.719 2.006-1.413c.248-.694.248-1.289.173-1.413c-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.554 4.116 1.528 5.844L0 24l6.336-1.508A11.938 11.938 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.013-1.376l-.36-.214-3.727.977.994-3.634-.234-.373A9.818 9.818 0 1112 21.818z"/></svg>
                        Hubungi Penyedia via WhatsApp
                    </a>
                @else
                    <a href="{{ route('profile.view', $service->user) }}" class="btn-outline w-full">
                        Lihat Profil Penyedia
                    </a>
                @endif
            </div>
        </form>
    </div>
</section>
@endsection
