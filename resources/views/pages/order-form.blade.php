@extends('layouts.app')

@section('title', 'Order Jasa')

@section('content')
    <section class="order-form-page">
        <form method="POST" class="order-form-card">
            @csrf

            <h1 class="order-form-title">
                Order: {{ $service->judul_jasa }}
            </h1>

            <p class="order-form-price">
                Rp{{ number_format($service->harga, 0, ',', '.') }}
            </p>

            <div class="form-group">
                <label for="no_wa">
                    Nomor WhatsApp
                </label>

                <input type="text" id="no_wa" name="no_wa" value="{{ old('no_wa') }}" class="form-control"
                    placeholder="Contoh: 081234567890" required>
            </div>

            <div class="form-group">
                <label for="catatan">
                    Catatan Kebutuhan Order
                </label>

                <textarea id="catatan" name="catatan" class="form-control" placeholder="Jelaskan kebutuhan order kamu"
                    required>{{ old('catatan') }}</textarea>
            </div>

            <button type="submit" class="btn-primary">
                Kirim Order
            </button>
        </form>
    </section>
@endsection