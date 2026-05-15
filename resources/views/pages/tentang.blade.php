@extends('layouts.app')

@section('title', 'Tentang Kami | V-Skill')

@section('content')
    <section class="about-page">
        <div class="about-hero">
            <h1>Mengenal Lebih Dekat <span>V-Skill</span></h1>
            <p>
                V-Skill adalah platform penyedia jasa kreatif yang dikembangkan khusus untuk mahasiswa UPN
                "Veteran" Jawa Timur. Kami hadir sebagai jembatan profesional antara talenta muda kampus
                dengan kebutuhan industri digital saat ini.
            </p>
        </div>

        <div class="about-team-card">
            <div class="about-section-heading">
                <span></span>
                <h2>Profile Kelompok Kami</h2>
                <p>Tim kreatif di balik V-Skill yang siap membantu kebutuhan kreatif Anda</p>
            </div>

            <div class="about-team-grid">
                <article class="about-member-card">
                    <img src="{{ asset('assets/images/aqilla-rasya.png') }}" alt="Aqilla Rasya Ramadhani" onerror="this.style.display='none'">
                    <h3>Aqilla Rasya Ramadhani</h3>
                    <p>24082010168</p>
                    <small>Sistem Informasi</small>
                    <div><span>Project Manager</span></div>
                </article>

                <article class="about-member-card">
                    <img src="{{ asset('assets/images/fatih-athala.jpg') }}" alt="Fatih Athala Ramadhan" onerror="this.style.display='none'">
                    <h3>Fatih Athala Ramadhan</h3>
                    <p>24082010141</p>
                    <small>Sistem Informasi</small>
                    <div><span>Frontend Developer</span></div>
                </article>

                <article class="about-member-card">
                    <img src="{{ asset('assets/images/iqbal-maulana.jpg') }}" alt="M. Iqbal Maulana" onerror="this.style.display='none'">
                    <h3>M. Iqbal Maulana</h3>
                    <p>24082010150</p>
                    <small>Sistem Informasi</small>
                    <div><span>Backend & Database Engineer</span></div>
                </article>
            </div>
        </div>

        <div class="about-vision-section">
            <div class="about-vision-text">
                <h2>Visi & Misi Kami</h2>
                <p>
                    Menjadi ekosistem digital nomor satu bagi mahasiswa UPN untuk menyalurkan bakat kreatif
                    mereka ke dalam proyek nyata yang bernilai ekonomi tinggi.
                </p>

                <ul>
                    <li>Meningkatkan daya saing mahasiswa melalui pengalaman proyek profesional.</li>
                    <li>Memberikan kemudahan bagi klien untuk menemukan jasa kreatif berkualitas.</li>
                    <li>Membangun portofolio mahasiswa sebelum terjun ke dunia kerja yang sesungguhnya.</li>
                </ul>
            </div>

            <div class="about-quote-card">
                <p>“Menghubungkan Inovasi, Membangun Pengalaman”</p>
            </div>
        </div>

        <div class="about-reason-section">
            <h2>Mengapa Memilih Kami?</h2>

            <div class="about-reason-grid">
                <article class="about-reason-card">
                    <div>🎓</div>
                    <h3>Terverifikasi</h3>
                    <p>Setiap penyedia jasa adalah mahasiswa aktif UPN yang telah melalui validasi akun.</p>
                </article>

                <article class="about-reason-card">
                    <div>⚡</div>
                    <h3>Efisien</h3>
                    <p>Proses pencarian proyek dan komunikasi dengan klien dilakukan secara rapi dan mudah.</p>
                </article>

                <article class="about-reason-card">
                    <div>🤝</div>
                    <h3>Kolaboratif</h3>
                    <p>Mengutamakan hubungan jangka panjang antara mahasiswa dan klien untuk pertumbuhan bersama.</p>
                </article>
            </div>
        </div>
    </section>
@endsection
