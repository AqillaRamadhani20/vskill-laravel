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

        // Sintaks INSERT berbeda per driver
        $ignore = $driver === 'sqlite' ? 'INSERT OR IGNORE' : 'INSERT IGNORE';

        $sql = <<<SQL
{$ignore} INTO `users` (`id`, `nama_lengkap`, `email`, `username`, `password`, `role`, `is_verified`, `created_at`) VALUES
(1, 'AQILLA RASYA', '24082010168@student.upnjatim.ac.id', 'aqill123', '\$2y\$10\$BGiqyc.xfl.7nYwQW3rMp.ZgAJjW1XfSieN2bThmvyVH6SxedcjMK', 'penyedia', 0, '2026-03-28 04:13:53'),
(9, 'budiono', 'budiono@gmail.co', 'budiiii', '\$2y\$10\$fBOYZ5xnbr2f21VhptY89OqNP1jYKhA2e2FlVV6Geca4xFVOdL1ZO', 'pembeli', 0, '2026-04-15 04:51:11'),
(11, 'IQBAL MAULANA', '240820150@student.upnjatim.ac.id', 'iqbalmaulana11', '\$2y\$10\$1PXnIx5oE79w6uhWUsB3ZeXYsCG8rtWhPsxsB0uZqH3WERVapmfAi', 'penyedia', 0, '2026-04-15 08:03:57'),
(12, 'FATIH ATHALA', '2408201046@student.upnjatim.ac.id', 'fatihathala12', '\$2y\$10\$LA/BHqruakXXkFUEly.oLeAbdv9TcqK4nR.xlipU17v9RKjkLPwmC', 'penyedia', 0, '2026-04-15 08:05:06'),
(13, 'kaka', '24082010166@student.upnjatim.ac.id', 'kakadimas13', '\$2y\$10\$qk9./8dRyWCUtBNW5y6g.OoQ6EjlU/PNKoupdowO9FfYtJj0FydKi', 'penyedia', 0, '2026-04-15 10:08:36'),
(14, 'iqbal', 'jukifze@gmail.com', 'dahewlll', '\$2y\$10\$WR3RDtyAGYIuoUaAr1uhn.i7IaJ9GalBVVbrJ23M4CNCjdyefpXMe', 'pembeli', 0, '2026-04-16 15:01:40');

{$ignore} INTO `profiles` (`id`, `user_id`, `npm`, `prodi`, `foto`, `bio`, `skill_summary`, `tools_summary`, `harga_mulai`, `kontak_wa`, `status_ketersediaan`) VALUES
(1, 1, '24082010168', 'Sistem Informasi', 'aqilla-rasya.png', 'Saya adalah mahasiswa yang berfokus pada pengembangan website modern untuk UMKM. Berpengalaman dalam membuat website company profile, landing page, dan sistem sederhana berbasis web.', 'Web Development,UI/UX Design,Laravel', 'VS Code,Figma,Laravel,React,GitHub', 500000, '6281234567890', 'tersedia'),
(10, 12, '24082010141', 'Sistem informasi', 'fatih-athala.jpg', 'Mahasiswa yang berfokus pada desain UI/UX dan pengembangan solusi digital untuk kebutuhan akademik maupun UMKM.', 'UI/UX Design, Wireframing, Prototype, Product Thinking', 'Figma, Canva', 100000, '081234567801', 'tersedia'),
(11, 11, '24082010150', 'Sistem Informasi', 'iqbal-maulana.jpg', 'Mahasiswa yang fokus pada copywriting, dokumentasi produk, dan pembuatan konten digital untuk kebutuhan bisnis dan project.', 'Copywriting, Product Documentation', '0', 30000, '081234567802', 'tersedia'),
(12, 13, '24082010166', 'Sistem Informasi', 'default.jpg', 'aku kaka', 'ui ux', '0', 25000, '0881328382', 'sibuk');

{$ignore} INTO `services` (`id`, `user_id`, `judul_jasa`, `kategori`, `deskripsi`, `harga`, `estimasi_pengerjaan`, `status`, `created_at`) VALUES
(1, 1, 'Jasa Penerjemah Dokumen Inggris-Indonesia', 'Jasa Penerjemah', 'Melayani penerjemahan dokumen umum dan akademik dari bahasa Inggris ke Indonesia maupun sebaliknya dengan hasil rapi dan mudah dipahami.', 50000, '2-3 hari', 'aktif', '2026-03-28 12:56:27'),
(2, 1, 'Jasa Social Media Management', 'Digital Marketing', 'Membantu mengelola akun Instagram, TikTok, dan LinkedIn untuk kebutuhan personal branding maupun UMKM.', 300000, '5-7 hari', 'aktif', '2026-03-28 12:56:27'),
(4, 12, 'Jasa Desain UI Aplikasi Mobile', 'UI/UX Research and Design', 'Melayani desain UI aplikasi mobile menggunakan Figma, mulai dari wireframe, mockup, hingga prototype interaktif yang siap dipresentasikan.', 250000, '3-5 hari', 'aktif', '2026-04-15 08:14:13'),
(5, 12, 'Jasa Wireframe dan Prototype Website', 'UI/UX Research and Design', 'Membantu membuat wireframe dan prototype website untuk project kuliah, UMKM, maupun kebutuhan pitching produk digital.', 200000, '2-4 hari', 'aktif', '2026-04-15 08:14:36'),
(6, 11, 'Jasa Copywriting dan Caption Ads', 'Digital Marketing', 'Melayani pembuatan copywriting untuk iklan, caption media sosial, dan konten promosi yang lebih menarik dan persuasif.', 120000, '1-2 hari', 'aktif', '2026-04-15 08:14:45'),
(8, 13, 'jasa membuat website', 'Website & Apps Developer', 'website html', 70000, '3 hari', 'aktif', '2026-04-15 10:20:34');

{$ignore} INTO `portfolio` (`id`, `user_id`, `judul_project`, `deskripsi`, `tools`, `link_demo`, `created_at`) VALUES
(1, 11, 'Copywriting Konten Promosi UMKM', 'Membuat copywriting dan caption promosi untuk media sosial UMKM agar lebih menarik dan persuasif.', 'Google Docs, Canva', NULL, '2026-04-17 06:35:01'),
(2, 11, 'Dokumentasi Fitur Aplikasi Laundry', 'Menyusun dokumentasi fitur dan alur penggunaan aplikasi laundry untuk kebutuhan presentasi project.', 'Notion, Google Docs', NULL, '2026-04-17 06:35:01'),
(3, 1, 'Copywriting Konten Promosi UMKM', 'Membuat copywriting dan caption promosi untuk media sosial UMKM agar lebih menarik dan persuasif.', 'Google Docs, Canva', NULL, '2026-04-17 06:35:43'),
(4, 1, 'Dokumentasi Fitur Aplikasi Laundry', 'Menyusun dokumentasi fitur dan alur penggunaan aplikasi laundry untuk kebutuhan presentasi project.', 'Notion, Google Docs', NULL, '2026-04-17 06:35:43');

{$ignore} INTO `orders` (`id`, `service_id`, `buyer_id`, `seller_id`, `no_wa`, `catatan`, `status`, `created_at`) VALUES
(2, 1, 9, 1, '0837626462763', 'buat tugas', 'pending', '2026-04-15 06:52:17'),
(3, 1, 9, 1, '0837626462763', 'untuk tugas', 'ditolak', '2026-04-15 07:14:06'),
(5, 1, 13, 1, '088139737243', 'aku butuh penerjemah bahasa inggris', 'pending', '2026-04-15 10:30:17'),
(6, 6, 9, 11, '0889374265', 'buat sekolah', 'pending', '2026-04-17 06:30:58');
SQL;

        foreach (preg_split('/;\s*\n/', $sql, -1, PREG_SPLIT_NO_EMPTY) as $statement) {
            DB::unprepared(trim($statement));
        }

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
