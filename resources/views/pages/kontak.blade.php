@extends('layouts.app')

@section('title', 'Kontak | V-Skill')

@section('content')
<section class="ktk-page">

    {{-- Header --}}
    <div class="ktk-header">
        <span class="vsk-section-eyebrow">Kontak & Dukungan</span>
        <h1 class="ktk-title">Hubungi Kami</h1>
        <p class="ktk-sub">Ada pertanyaan, saran, atau butuh bantuan? Tim kami siap membantu kamu.</p>
    </div>

    <div class="ktk-layout">

        {{-- Contact Info --}}
        <div class="ktk-info-panel">

            <div class="ktk-info-card">
                <div class="ktk-info-icon">📧</div>
                <div>
                    <h3>Email</h3>
                    <p>vskill@student.upnjatim.ac.id</p>
                </div>
            </div>

            <div class="ktk-info-card">
                <div class="ktk-info-icon">📱</div>
                <div>
                    <h3>WhatsApp</h3>
                    <p>+62 812-3456-7890</p>
                </div>
            </div>

            <div class="ktk-info-card">
                <div class="ktk-info-icon">📍</div>
                <div>
                    <h3>Alamat</h3>
                    <p>UPN "Veteran" Jawa Timur<br>Surabaya, Jawa Timur</p>
                </div>
            </div>

            <div class="ktk-info-card">
                <div class="ktk-info-icon">🕐</div>
                <div>
                    <h3>Jam Operasional</h3>
                    <p>Senin – Jumat, 08.00 – 17.00 WIB</p>
                </div>
            </div>

            <div class="ktk-quote-box">
                <p>"Kami senang mendengar dari kamu! Jangan ragu untuk bertanya apapun tentang V-Skill."</p>
                <span>— Tim V-Skill</span>
            </div>
        </div>

        {{-- Contact Form --}}
        <div class="contact-card ktk-form-card">
            <div class="ktk-form-header">
                <h2>Kirim Pesan</h2>
                <p>Isi formulir di bawah dan kami akan merespons sesegera mungkin.</p>
            </div>

            <form class="ktk-form">
                <div class="form-group">
                    <label for="ktk-nama">Nama Lengkap <span style="color:var(--vs-danger)">*</span></label>
                    <div class="input-icon-group">
                        <span class="input-icon">👤</span>
                        <input type="text" id="ktk-nama" class="form-control input-with-icon"
                               placeholder="Contoh: Budi Santoso">
                    </div>
                </div>

                <div class="form-group">
                    <label for="ktk-email">Email <span style="color:var(--vs-danger)">*</span></label>
                    <div class="input-icon-group">
                        <span class="input-icon">📧</span>
                        <input type="email" id="ktk-email" class="form-control input-with-icon"
                               placeholder="npm@student.upnjatim.ac.id atau email@gmail.com">
                    </div>
                </div>

                <div class="form-group">
                    <label for="ktk-subjek">Subjek</label>
                    <select id="ktk-subjek" class="form-control">
                        <option value="">Pilih subjek...</option>
                        <option>Masalah Akun</option>
                        <option>Tanya Project / Jasa</option>
                        <option>Laporan Bug</option>
                        <option>Saran & Masukan</option>
                        <option>Kerjasama</option>
                        <option>Lainnya</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="ktk-pesan">Pesan <span style="color:var(--vs-danger)">*</span></label>
                    <textarea id="ktk-pesan" rows="5" class="form-control"
                              placeholder="Tuliskan pesanmu secara detail agar kami dapat membantu lebih baik..."></textarea>
                </div>

                <button type="button" class="btn-primary w-full" style="padding:1rem;font-size:.95rem;"
                        onclick="alert('Terima kasih! Pesan sudah diterima. Kami akan menghubungimu segera.')">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    Kirim Pesan Sekarang
                </button>
            </form>
        </div>

    </div>
</section>
@endsection
