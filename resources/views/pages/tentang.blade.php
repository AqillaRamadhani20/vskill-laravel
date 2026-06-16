@extends('layouts.app')

@section('title', 'Tentang Kami | V-Skill')

@section('content')
<section class="about-page">

    {{-- Hero --}}
    <div class="about-hero" style="margin-bottom:3rem;">
        <span class="vsk-section-eyebrow">Tentang Kami</span>
        <h1 style="margin:.5rem 0 .75rem;">Mengenal Lebih Dekat <span style="color:var(--vs-green-700);">V-Skill</span></h1>
        <p>
            V-Skill adalah platform penyedia jasa kreatif yang dikembangkan khusus untuk mahasiswa UPN
            "Veteran" Jawa Timur. Kami hadir sebagai jembatan profesional antara talenta muda kampus
            dengan kebutuhan industri digital saat ini.
        </p>
    </div>

    {{-- Stats Bar --}}
    <div class="abt-stats-bar">
        <div class="abt-stat">
            <strong>15+</strong>
            <span>Penyedia Aktif</span>
        </div>
        <div class="abt-stat-divider"></div>
        <div class="abt-stat">
            <strong>15+</strong>
            <span>Kategori Jasa</span>
        </div>
        <div class="abt-stat-divider"></div>
        <div class="abt-stat">
            <strong>UPN</strong>
            <span>Verified</span>
        </div>
        <div class="abt-stat-divider"></div>
        <div class="abt-stat">
            <strong>Surabaya</strong>
            <span>Berbasis</span>
        </div>
    </div>

    {{-- Team Section --}}
    <div class="about-team-card" style="margin-bottom:3rem;">
        <div class="about-section-heading">
            <span></span>
            <h2>Tim Pengembang V-Skill</h2>
            <p>Tiga mahasiswa Sistem Informasi UPN Veteran Jawa Timur di balik platform ini</p>
        </div>

        <div class="about-team-grid">
            <article class="about-member-card">
                <img src="{{ asset('assets/images/aqilla-rasya.png') }}"
                     alt="Aqilla Rasya Ramadhani"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                <div class="abt-member-initial" style="display:none;">A</div>
                <h3>Aqilla Rasya Ramadhani</h3>
                <p>24082010168</p>
                <small>Sistem Informasi</small>
                <div><span>🏆 Project Manager</span></div>
            </article>

            <article class="about-member-card">
                <img src="{{ asset('assets/images/fatih-athala.jpg') }}"
                     alt="Fatih Athala Ramadhan"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                <div class="abt-member-initial" style="display:none;">F</div>
                <h3>Fatih Athala Ramadhan</h3>
                <p>24082010141</p>
                <small>Sistem Informasi</small>
                <div><span>🎨 Frontend Developer</span></div>
            </article>

            <article class="about-member-card">
                <img src="{{ asset('assets/images/iqbal-maulana.jpg') }}"
                     alt="M. Iqbal Maulana"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                <div class="abt-member-initial" style="display:none;">I</div>
                <h3>M. Iqbal Maulana</h3>
                <p>24082010150</p>
                <small>Sistem Informasi</small>
                <div><span>⚙️ Backend & Database Engineer</span></div>
            </article>
        </div>
    </div>

    {{-- Vision & Mission --}}
    <div class="about-vision-section" style="margin-bottom:3rem;">
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
                <li>Menciptakan ekosistem wirausaha digital di lingkungan kampus UPN.</li>
            </ul>
        </div>

        <div class="about-quote-card">
            <div>
                <div style="font-size:2.5rem;margin-bottom:1rem;opacity:.8;">"</div>
                <p>"Menghubungkan Inovasi, Membangun Pengalaman"</p>
                <div style="margin-top:1rem;font-size:.8rem;opacity:.65;font-weight:500;">— V-Skill Platform</div>
            </div>
        </div>
    </div>

    {{-- Why Us --}}
    <div class="about-reason-section">
        <h2>Mengapa Memilih V-Skill?</h2>

        <div class="about-reason-grid">
            <article class="about-reason-card">
                <div>🎓</div>
                <h3>Terverifikasi Kampus</h3>
                <p>Setiap penyedia jasa adalah mahasiswa aktif UPN yang telah melalui validasi akun resmi dengan email kampus.</p>
            </article>

            <article class="about-reason-card">
                <div>⚡</div>
                <h3>Proses Efisien</h3>
                <p>Dari pencarian jasa hingga pemesanan dalam hitungan menit. Sistem order terstruktur dan transparan.</p>
            </article>

            <article class="about-reason-card">
                <div>🤝</div>
                <h3>Kolaboratif</h3>
                <p>Mengutamakan hubungan jangka panjang antara mahasiswa dan klien untuk pertumbuhan bersama.</p>
            </article>
        </div>
    </div>

    {{-- CTA --}}
    <div class="vsk-cta-wrap" style="margin-top:3rem;">
        <div style="font-size:2rem;margin-bottom:.75rem;">🌟</div>
        <h2>Siap Bergabung?</h2>
        <p>Jadilah bagian dari komunitas freelancer mahasiswa UPN terbesar.</p>
        <div style="display:flex;justify-content:center;gap:1rem;flex-wrap:wrap;">
            @guest
                <a href="{{ route('register') }}" class="btn-primary" style="font-size:.95rem;padding:.875rem 1.75rem;">
                    Daftar Gratis Sekarang
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="btn-primary" style="font-size:.95rem;padding:.875rem 1.75rem;">
                    Jelajahi Jasa
                </a>
            @endguest
            <a href="{{ route('kontak') }}" class="btn-outline" style="font-size:.95rem;padding:.875rem 1.75rem;">
                Hubungi Kami
            </a>
        </div>
    </div>

</section>
@endsection
