@extends('layouts.app')

@section('title', 'Form Jasa')

@section('content')
    <section class="service-form-page">
        <form method="POST" action="{{ $action }}" class="service-form-card">
            @csrf

            <h1 class="service-form-title">
                {{ $service->exists ? 'Edit Jasa' : 'Tambah Jasa' }}
            </h1>

            <div class="form-group">
                <label for="judul_jasa">
                    Judul Jasa
                </label>

                <input type="text" id="judul_jasa" name="judul_jasa" value="{{ old('judul_jasa', $service->judul_jasa) }}"
                    class="form-control" placeholder="Masukkan judul jasa" required>
            </div>

            <div class="form-group">
                <label for="kategori">
                    Kategori
                </label>

                <select id="kategori" name="kategori" class="form-control" required>
                    @foreach($kategori as $k)
                        <option value="{{ $k }}" @selected(old('kategori', $service->kategori) === $k)>
                            {{ $k }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="deskripsi">
                    Deskripsi
                </label>

                <textarea id="deskripsi" name="deskripsi" class="form-control"
                    placeholder="Jelaskan jasa yang kamu tawarkan"
                    required>{{ old('deskripsi', $service->deskripsi) }}</textarea>
            </div>

            <div class="form-group">
                <label for="harga">
                    Harga
                </label>

                <input type="number" id="harga" name="harga" value="{{ old('harga', $service->harga) }}"
                    class="form-control" placeholder="Contoh: 50000" min="0" required>
            </div>

            <div class="form-group">
                <label for="estimasi_pengerjaan">
                    Estimasi Pengerjaan
                </label>

                <input type="text" id="estimasi_pengerjaan" name="estimasi_pengerjaan"
                    value="{{ old('estimasi_pengerjaan', $service->estimasi_pengerjaan) }}" class="form-control"
                    placeholder="Contoh: 2-3 hari">
            </div>

            <div class="form-group">
                <label for="status">
                    Status
                </label>

                <select id="status" name="status" class="form-control" required>
                    <option value="aktif" @selected(old('status', $service->status) === 'aktif')>
                        Aktif
                    </option>

                    <option value="nonaktif" @selected(old('status', $service->status) === 'nonaktif')>
                        Nonaktif
                    </option>
                </select>
            </div>

            <button type="submit" class="btn-primary">
                Simpan
            </button>
        </form>
    </section>
@endsection