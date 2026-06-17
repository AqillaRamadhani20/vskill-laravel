<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $driver = config('database.default');

        if ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys=OFF');
        } elseif ($driver === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }

        $ignore = $driver === 'sqlite' ? 'INSERT OR IGNORE' : 'INSERT IGNORE';

        // Nowdoc (single-quoted) — no PHP variable interpolation
        $sql = str_replace('__IGNORE__', $ignore, <<<'SQL'
__IGNORE__ INTO `users` (`id`, `nama_lengkap`, `email`, `username`, `password`, `role`, `is_verified`, `created_at`) VALUES
(1,  'AQILLA RASYA',  '24082010168@student.upnjatim.ac.id', 'aqill123',       '$2y$12$NOxdgBtw1wA.6OSqqf4j2uvZIMl0iL7J7I/7huM2exNUhKWLkgSku', 'penyedia', 0, '2026-03-28 04:13:53'),
(11, 'IQBAL MAULANA', '240820150@student.upnjatim.ac.id',   'iqbalmaulana11', '$2y$10$1PXnIx5oE79w6uhWUsB3ZeXYsCG8rtWhPsxsB0uZqH3WERVapmfAi', 'penyedia', 0, '2026-04-15 08:03:57'),
(12, 'FATIH ATHALA',  '2408201046@student.upnjatim.ac.id',  'fatihathala12',  '$2y$10$LA/BHqruakXXkFUEly.oLeAbdv9TcqK4nR.xlipU17v9RKjkLPwmC',  'penyedia', 0, '2026-04-15 08:05:06'),
(14, 'iqbal',         'jukifze@gmail.com',                  'dahewlll',       '$2y$10$WR3RDtyAGYIuoUaAr1uhn.i7IaJ9GalBVVbrJ23M4CNCjdyefpXMe',  'pembeli',  0, '2026-04-16 15:01:40'),
(16, 'Kaka',          '24082010171@student.upnjatim.ac.id', 'kaka171',        '$2y$12$bklqG7mja9F5tnDZUOI0W.MWYvbrt67kKUsGJ0pP6wABZkSWrlpta',  'penyedia', 0, '2026-06-15 03:53:21'),
(17, 'Naufal',        '24082010162@student.upnjatim.ac.id', 'naufal162',      '$2y$12$uAuHkdGNI6ylO6OEWTaDFOgb12shEwKvtStkwYUOXmpGAfjiHxwPy',  'penyedia', 0, '2026-06-15 03:53:21'),
(18, 'Ahmad',         '24082010136@student.upnjatim.ac.id', 'ahmad136',       '$2y$12$gBrjv8tdojdHQViWPn7XKOrf1fBqpB5M8cc21b96QBjCjEaHrDsH.',  'penyedia', 0, '2026-06-15 03:53:21');

__IGNORE__ INTO `profiles` (`id`, `user_id`, `npm`, `prodi`, `foto`, `bio`, `skill_summary`, `tools_summary`, `harga_mulai`, `kontak_wa`, `status_ketersediaan`) VALUES
(1,  1,  '24082010168', 'Sistem Informasi', '1781494769_1.jpeg', 'Saya adalah mahasiswa yang berfokus pada pengembangan website modern untuk UMKM. Berpengalaman dalam membuat website company profile, landing page, dan sistem sederhana berbasis web.', 'Web Development,UI/UX Design,Laravel', 'VS Code,Figma,Laravel,React,GitHub', 500000, '6281234567890', 'tersedia'),
(10, 12, '24082010141', 'Sistem informasi', 'fatih.jpeg',        'Mahasiswa yang berfokus pada desain UI/UX dan pengembangan solusi digital untuk kebutuhan akademik maupun UMKM.', 'UI/UX Design, Wireframing, Prototype, Product Thinking', 'Figma, Canva', 100000, '081234567801', 'tersedia'),
(11, 11, '24082010150', 'Sistem Informasi', 'iqbal.jpeg',        'Mahasiswa yang fokus pada copywriting, dokumentasi produk, dan pembuatan konten digital untuk kebutuhan bisnis dan project.', 'Copywriting, Product Documentation', '0', 30000, '081234567802', 'tersedia'),
(13, 16, '24082010171', 'Sistem Informasi', '1781495901_16.jpg', 'Mahasiswa yang berfokus pada pengembangan website modern. Siap membantu project web dari skala kecil hingga menengah.', 'Web Development, Laravel, HTML/CSS, JavaScript, MySQL', 'VS Code, GitHub, Laravel, MySQL, Postman', 100000, '081234560171', 'tersedia'),
(14, 17, '24082010162', 'Sistem Informasi', '1781495986_17.jpg', 'Desainer UI/UX yang berfokus pada pengalaman digital intuitif dan estetis. Berpengalaman menggunakan Figma dari wireframe hingga prototype interaktif.', 'UI/UX Design, Wireframing, Prototyping, User Research, Design System', 'Figma, Adobe XD, Canva, Miro', 80000, '081234560162', 'tersedia'),
(15, 18, '24082010136', 'Sistem Informasi', '1781496229_18.jpg', 'Mahasiswa dengan keahlian menulis karya ilmiah dan esai berkualitas tinggi. Berpengalaman menyusun makalah, proposal, dan artikel ilmiah.', 'Penulisan Karya Ilmiah, Essay, Makalah, Sitasi APA/IEEE', 'Microsoft Word, Mendeley, Google Scholar, Grammarly', 50000, '081234560136', 'tersedia');

__IGNORE__ INTO `services` (`id`, `user_id`, `judul_jasa`, `kategori`, `deskripsi`, `harga`, `estimasi_pengerjaan`, `status`, `created_at`) VALUES
(1,  1,  'Jasa Penerjemah Dokumen Inggris-Indonesia',    'Jasa Penerjemah',          'Melayani penerjemahan dokumen umum dan akademik dari bahasa Inggris ke Indonesia maupun sebaliknya dengan hasil rapi dan mudah dipahami.',                                                                                       50000,  '2-3 hari', 'aktif', '2026-03-28 12:56:27'),
(2,  1,  'Jasa Social Media Management',                 'Digital Marketing',         'Membantu mengelola akun Instagram, TikTok, dan LinkedIn untuk kebutuhan personal branding maupun UMKM.',                                                                                                                           300000, '5-7 hari', 'aktif', '2026-03-28 12:56:27'),
(4,  12, 'Jasa Desain UI Aplikasi Mobile',               'UI/UX Research and Design', 'Melayani desain UI aplikasi mobile menggunakan Figma, mulai dari wireframe, mockup, hingga prototype interaktif yang siap dipresentasikan.',                                                                                        250000, '3-5 hari', 'aktif', '2026-04-15 08:14:13'),
(5,  12, 'Jasa Wireframe dan Prototype Website',         'UI/UX Research and Design', 'Membantu membuat wireframe dan prototype website untuk project kuliah, UMKM, maupun kebutuhan pitching produk digital.',                                                                                                             200000, '2-4 hari', 'aktif', '2026-04-15 08:14:36'),
(6,  11, 'Jasa Copywriting dan Caption Ads',             'Digital Marketing',         'Melayani pembuatan copywriting untuk iklan, caption media sosial, dan konten promosi yang lebih menarik dan persuasif.',                                                                                                            120000, '1-2 hari', 'aktif', '2026-04-15 08:14:45'),
(9,  16, 'Jasa Pembuatan Website Company Profile',       'Website & Apps Developer',  'Membuat website company profile profesional menggunakan Laravel atau HTML/CSS. Desain responsif dan siap publish. Cocok untuk UMKM, organisasi, maupun tugas kuliah.',                                                               250000, '5-7 hari', 'aktif', '2026-06-15 03:53:21'),
(10, 16, 'Jasa Landing Page & Portofolio Online',        'Website & Apps Developer',  'Buat landing page atau portofolio online yang menarik menggunakan HTML, CSS, JavaScript dengan desain modern dan responsif di semua perangkat.',                                                                                     150000, '3-4 hari', 'aktif', '2026-06-15 03:53:21'),
(11, 17, 'Jasa Desain UI Aplikasi Mobile (Figma)',       'UI/UX Research and Design', 'Desain tampilan aplikasi mobile dari konsep hingga prototype interaktif menggunakan Figma. Meliputi wireframe, mockup high-fidelity, dan design system yang konsisten.',                                                             200000, '4-6 hari', 'aktif', '2026-06-15 03:53:21'),
(12, 17, 'Jasa Riset & Evaluasi UX',                    'UI/UX Research and Design', 'Melakukan user research, usability testing, dan evaluasi UX untuk produk digital. Output berupa laporan temuan dan rekomendasi desain berbasis data pengguna nyata.',                                                                150000, '3-5 hari', 'aktif', '2026-06-15 03:53:21'),
(13, 18, 'Jasa Penulisan Karya Ilmiah & Makalah',        'Penyusunan Artikel',        'Membantu penulisan karya ilmiah dan makalah sesuai kaidah ilmiah. Meliputi latar belakang, tinjauan pustaka, metodologi, hingga kesimpulan dengan sitasi rapi (APA/IEEE).',                                                        120000, '3-5 hari', 'aktif', '2026-06-15 03:53:21'),
(14, 18, 'Jasa Penulisan Essay & Artikel Ilmiah',        'Penyusunan Artikel',        'Membuat essay argumentatif, reflektif, maupun deskriptif untuk lomba, beasiswa, atau tugas. Tersedia juga penulisan artikel ilmiah populer untuk jurnal kampus.',                                                                  75000,  '2-3 hari', 'aktif', '2026-06-15 03:53:21');

__IGNORE__ INTO `portfolio` (`id`, `user_id`, `judul_project`, `deskripsi`, `tools`, `link_demo`, `created_at`) VALUES
(5,  1,  'Juara 2 Lomba Copywriting Nasional - BUMN Track',           'Meraih juara 2 dalam kompetisi copywriting tingkat nasional yang diselenggarakan Forum Mahasiswa BUMN. Membuat naskah iklan produk UMKM dalam format video 60 detik dan konten media sosial.',              'Canva, Google Docs, CapCut',             NULL, '2026-06-16 14:07:51'),
(6,  1,  'Pengelolaan Media Sosial UMKM Kuliner Surabaya',            'Mengelola konten Instagram dan TikTok untuk usaha kuliner lokal selama 3 bulan. Follower naik dari 300 ke 2.400, engagement rate rata-rata 8.5%.',                                                          'Canva, Meta Business Suite, Buffer',     NULL, '2026-06-16 14:07:51'),
(7,  1,  'Terjemahan Dokumen Akademik & Laporan Bisnis',              'Menerjemahkan 40+ halaman dokumen akademik dan laporan bisnis Inggris-Indonesia untuk kebutuhan skripsi dan presentasi perusahaan dengan akurasi tinggi.',                                                   'DeepL, Microsoft Word, Grammarly',       NULL, '2026-06-16 14:07:51'),
(8,  11, 'Finalis Kompetisi Content Creator - Telkom Indonesia 2025', 'Lolos babak final kompetisi content creator Telkom Indonesia dengan tema digitalisasi UMKM. Menyusun strategi konten dan script video edukasi yang dinilai langsung oleh tim Telkom.',                       'CapCut, Canva, TikTok Studio',           NULL, '2026-06-16 14:07:51'),
(9,  11, 'Kampanye Digital Produk Batik Lokal Jawa Timur',            'Membuat kampanye digital lengkap untuk brand batik lokal Surabaya - copywriting, desain konten feed Instagram, hingga caption iklan Facebook Ads yang menghasilkan 5x ROAS.',                               'Canva, Google Docs, Meta Ads Manager',   NULL, '2026-06-16 14:07:51'),
(10, 11, 'Caption Ads Skincare Brand - Engagement Naik 320%',        'Menyusun 30 caption iklan untuk produk skincare lokal selama 1 bulan. Engagement rate naik dari 1.2% ke 5.2% dan direct message meningkat 3x lipat.',                                                       'Notion, Canva, Google Sheets',           NULL, '2026-06-16 14:07:51'),
(11, 12, 'Juara 1 UI/UX Competition - CompFest 16 Universitas Indonesia', 'Memenangkan kompetisi desain UI/UX tingkat nasional CompFest UI 2025 dengan solusi aplikasi kesehatan mahasiswa. Penilaian meliputi user research, wireframe, prototype, dan presentasi jury.',        'Figma, FigJam, Maze',                    'https://drive.google.com/file/d/17vRvBiFnHw2-3dtwgPqs9XABBZKWfiUB/view', '2026-06-16 14:07:51'),
(12, 12, 'Redesign Aplikasi Peminjaman Buku Perpustakaan UPN',        'Redesign total UI/UX aplikasi peminjaman buku perpustakaan UPN berdasarkan riset kepada 40 mahasiswa. Menghasilkan tampilan yang lebih intuitif dan accessibility-friendly.',                              'Figma, Google Forms, Notion',            NULL, '2026-06-16 14:07:51'),
(13, 12, 'UX Research Aplikasi Transportasi Kampus',                  'Melakukan UX research lengkap (user interview, usability testing, affinity mapping) untuk startup transportasi kampus. Menghasilkan 12 insight kritis dan 8 rekomendasi desain.',                            'FigJam, Maze, Miro, Google Forms',       NULL, '2026-06-16 14:07:51'),
(16, 16, 'Finalis GEMASTIK XVII - Pengembangan Perangkat Lunak',      'Lolos ke babak final GEMASTIK (Pagelaran Mahasiswa Nasional Bidang TIK) dengan aplikasi manajemen koperasi mahasiswa berbasis web yang dibangun dalam tim 3 orang.',                                        'Laravel, Vue.js, MySQL, Docker',         NULL, '2026-06-16 14:07:51'),
(17, 16, 'Company Profile CV. Maju Jaya Konstruksi',                  'Membangun website company profile perusahaan konstruksi dengan portofolio proyek, profil tim, dan formulir kontak. Dioptimasi untuk SEO dan mobile-first.',                                                 'Laravel, Tailwind CSS, MySQL, Livewire', NULL, '2026-06-16 14:07:51'),
(18, 16, 'Landing Page Startup EdTech - Konversi 12%',               'Membuat landing page high-converting untuk startup edukasi online. Dilengkapi animasi scroll, testimoni interaktif, dan integrasi WhatsApp CTA. Conversion rate 12%.',                                      'HTML, CSS, JavaScript, AOS.js',          NULL, '2026-06-16 14:07:51'),
(19, 17, 'Top 10 UI/UX Hackathon Shopee Campus 2025',                'Masuk top 10 dari 300+ tim dalam hackathon Shopee Campus dengan konsep fitur live shopping yang aksesibel untuk pengguna difabel. Presentasi langsung di depan tim produk Shopee.',                         'Figma, FigJam, Principle',               NULL, '2026-06-16 14:07:51'),
(20, 17, 'Redesign Dashboard SIAKAD UPN Veteran Jatim',              'Redesign UI Dashboard SIAKAD UPN berdasarkan feedback 60 mahasiswa. Tampilan baru lebih clean, navigasi lebih cepat ditemukan, dan task completion rate naik 40%.',                                          'Figma, FigJam, Notion',                  NULL, '2026-06-16 14:07:51'),
(21, 17, 'Prototype Aplikasi Pemantauan Kesehatan Mental Mahasiswa',  'Merancang prototype aplikasi kesehatan mental mahasiswa dengan fitur mood tracker, jurnal harian, dan akses konseling online. Diuji dengan 25 pengguna dalam sesi usability testing.',                      'Figma, Maze, Google Forms',              NULL, '2026-06-16 14:07:51'),
(22, 18, 'Juara 2 Lomba Karya Tulis Ilmiah - FEB UPN 2025',         'Meraih juara 2 LKTI tingkat fakultas dengan karya "Analisis Dampak Digitalisasi UMKM terhadap Ketahanan Ekonomi Lokal Pasca-Pandemi". Dipresentasikan di hadapan 5 dosen penguji.',                         'Microsoft Word, Mendeley, Google Scholar',NULL,'2026-06-16 14:07:51'),
(23, 18, 'Artikel Terbit di Jurnal Pendidikan Terakreditasi SINTA 4','Menulis dan menerbitkan artikel ilmiah tentang pengaruh media sosial terhadap motivasi belajar mahasiswa di jurnal pendidikan nasional terakreditasi SINTA 4.',                                             'Mendeley, Zotero, Microsoft Word',       NULL, '2026-06-16 14:07:51'),
(24, 18, 'Makalah Analisis SWOT PT Telkom Indonesia - Nilai A',      'Menyusun makalah analisis SWOT komprehensif untuk PT Telkom Indonesia sebagai tugas akhir Manajemen Strategi. Mendapat nilai A dan dijadikan referensi angkatan berikutnya.',                               'Microsoft Word, Canva, Google Docs',     NULL, '2026-06-16 14:07:51');
SQL);

        foreach (preg_split('/;\s*\n/', $sql, -1, PREG_SPLIT_NO_EMPTY) as $statement) {
            DB::unprepared(trim($statement));
        }

        // Update link_demo untuk portfolio yang sudah ada di production
        DB::table('portfolio')->where('id', 11)->whereNull('link_demo')
            ->update(['link_demo' => 'https://drive.google.com/file/d/17vRvBiFnHw2-3dtwgPqs9XABBZKWfiUB/view']);

        if ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys=ON');
        } elseif ($driver === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }

        \App\Models\User::firstOrCreate(
            ['email' => 'admin@vskill.id'],
            [
                'nama_lengkap' => 'Admin V-Skill',
                'username'     => 'adminvskill',
                'password'     => \Illuminate\Support\Facades\Hash::make('admin123'),
                'role'         => 'admin',
                'is_verified'  => 1,
            ]
        );
    }
}
