@extends('layouts.app')

@section('title', 'Order Jasa')

@section('content')
    <section class="order-create-page">
        <a href="{{ route('detail', $service) }}" class="order-back-link">
            ← Kembali ke Detail Jasa
        </a>

        <div class="order-create-layout">
            <aside class="order-service-summary">
                <div class="service-badges">
                    <span class="badge badge-green">
                        {{ $service->kategori }}
                    </span>

                    <span class="badge badge-yellow">
                        {{ ucfirst($service->status) }}
                    </span>
                </div>

                <h2>
                    {{ $service->judul_jasa }}
                </h2>

                <p class="order-summary-provider">
                    {{ $service->user->nama_lengkap }}

                    @if($service->user->profile?->prodi)
                        • {{ $service->user->profile->prodi }}
                    @endif
                </p>

                <div class="order-summary-box green">
                    <span>Harga</span>

                    <strong>
                        Rp {{ number_format($service->harga, 0, ',', '.') }}
                    </strong>
                </div>

                <div class="order-summary-box green">
                    <span>Estimasi Pengerjaan</span>

                    <strong>
                        {{ $service->estimasi_pengerjaan ?? '-' }}
                    </strong>
                </div>

                <div class="order-summary-box">
                    <span>Deskripsi Singkat</span>

                    <p>
                        {{ $service->deskripsi }}
                    </p>
                </div>
            </aside>

            <form method="POST" class="order-create-card">
                @csrf

                <h1>
                    Form Pesan Jasa
                </h1>

                <p class="order-create-subtitle">
                    Isi kebutuhanmu dengan jelas agar penyedia jasa bisa memahami brief yang kamu inginkan.
                </p>

                <div class="form-group">
                    <label for="nama_pemesan">
                        Nama Pemesan
                    </label>

                    <input type="text" id="nama_pemesan" value="{{ auth()->user()->nama_lengkap }}" class="form-control"
                        readonly>
                </div>

                <div class="form-group">
                    <label for="no_wa">
                        Nomor WhatsApp
                    </label>

                    <input type="text" id="no_wa" name="no_wa"
                        value="{{ old('no_wa', auth()->user()->profile->kontak_wa ?? '') }}" class="form-control"
                        placeholder="Contoh: 081234567890" required>

                    <p class="form-help">
                        Nomor ini otomatis diambil dari data akun kamu, tetapi masih bisa diubah jika diperlukan.
                    </p>
                </div>

                <div class="form-group">
                    <label for="catatan">
                        Catatan Kebutuhan
                    </label>

                    <textarea id="catatan" name="catatan" class="form-control"
                        placeholder="Jelaskan kebutuhanmu, detail project, deadline, revisi, atau hal lain yang perlu diketahui penyedia jasa"
                        required>{{ old('catatan') }}</textarea>
                </div>

                <div class="order-create-warning">
                    Pastikan catatanmu jelas agar proses diskusi dengan penyedia jasa lebih cepat dan tepat.
                </div>

                <div class="order-create-actions">
                    <button type="submit" class="btn-primary">
                        Kirim Pesanan
                    </button>

                    @if($service->user->profile?->kontak_wa)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $service->user->profile->kontak_wa) }}"
                            target="_blank" class="btn-outline">
                            Hubungi via WhatsApp
                        </a>
                    @else
                        <a href="{{ route('profile.view', $service->user) }}" class="btn-outline">
                            Lihat Profil Penyedia
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </section>
@endsection