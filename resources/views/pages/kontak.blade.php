@extends('layouts.app')

@section('title', 'Kontak | V-Skill')

@section('content')
    <section class="contact-page">
        <form class="contact-card">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" placeholder="Contoh: Budi Santoso">
            </div>

            <div class="form-group">
                <label>Email Student</label>
                <input type="email" class="form-control" placeholder="npm@student.upnjatim.ac.id">
            </div>

            <div class="form-group">
                <label>Subjek</label>
                <select class="form-control">
                    <option>Pilih subjek...</option>
                    <option>Masalah Akun</option>
                    <option>Tanya Project</option>
                </select>
            </div>

            <div class="form-group">
                <label>Pesan</label>
                <textarea rows="5" class="form-control" placeholder="Tuliskan pesan Anda secara detail..."></textarea>
            </div>

            <button type="button" class="btn-primary w-full">Kirim Pesan Sekarang</button>
        </form>
    </section>
@endsection
