-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 17, 2026 at 06:37 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vskill`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `service_id` int NOT NULL,
  `buyer_id` int NOT NULL,
  `seller_id` int NOT NULL,
  `no_wa` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('pending','diterima','ditolak','selesai') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `service_id`, `buyer_id`, `seller_id`, `no_wa`, `catatan`, `status`, `created_at`) VALUES
(2, 1, 9, 1, '0837626462763', 'buat tugas', 'pending', '2026-04-15 06:52:17'),
(3, 1, 9, 1, '0837626462763', 'untuk tugas', 'ditolak', '2026-04-15 07:14:06'),
(5, 1, 13, 1, '088139737243', 'aku butuh penerjemah bahasa inggris', 'pending', '2026-04-15 10:30:17'),
(6, 6, 9, 11, '0889374265', 'buat sekolah', 'pending', '2026-04-17 06:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `judul_project` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci NOT NULL,
  `tools` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link_demo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `user_id`, `judul_project`, `deskripsi`, `tools`, `link_demo`, `created_at`) VALUES
(1, 11, 'Copywriting Konten Promosi UMKM', 'Membuat copywriting dan caption promosi untuk media sosial UMKM agar lebih menarik dan persuasif.', 'Google Docs, Canva', NULL, '2026-04-17 06:35:01'),
(2, 11, 'Dokumentasi Fitur Aplikasi Laundry', 'Menyusun dokumentasi fitur dan alur penggunaan aplikasi laundry untuk kebutuhan presentasi project.', 'Notion, Google Docs', NULL, '2026-04-17 06:35:01'),
(3, 1, 'Copywriting Konten Promosi UMKM', 'Membuat copywriting dan caption promosi untuk media sosial UMKM agar lebih menarik dan persuasif.', 'Google Docs, Canva', NULL, '2026-04-17 06:35:43'),
(4, 1, 'Dokumentasi Fitur Aplikasi Laundry', 'Menyusun dokumentasi fitur dan alur penggunaan aplikasi laundry untuk kebutuhan presentasi project.', 'Notion, Google Docs', NULL, '2026-04-17 06:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `npm` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `prodi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'default.jpg',
  `bio` text COLLATE utf8mb4_general_ci,
  `skill_summary` text COLLATE utf8mb4_general_ci,
  `tools_summary` text COLLATE utf8mb4_general_ci,
  `harga_mulai` int DEFAULT '0',
  `kontak_wa` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_ketersediaan` enum('tersedia','sibuk') COLLATE utf8mb4_general_ci DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `npm`, `prodi`, `foto`, `bio`, `skill_summary`, `tools_summary`, `harga_mulai`, `kontak_wa`, `status_ketersediaan`) VALUES
(1, 1, '24082010168', 'Sistem Informasi', 'aqilla-rasya.png', 'Saya adalah mahasiswa yang berfokus pada pengembangan website modern untuk UMKM. Berpengalaman dalam membuat website company profile, landing page, dan sistem sederhana berbasis web.', 'Web Development,UI/UX Design,Laravel', 'VS Code,Figma,Laravel,React,GitHub', 500000, '6281234567890', 'tersedia'),
(10, 12, '24082010141', 'Sistem informasi', 'fatih-athala.jpg', 'Mahasiswa yang berfokus pada desain UI/UX dan pengembangan solusi digital untuk kebutuhan akademik maupun UMKM.', 'UI/UX Design, Wireframing, Prototype, Product Thinking', 'Figma, Canva', 100000, '081234567801', 'tersedia'),
(11, 11, '24082010150', 'Sistem Informasi', 'iqbal-maulana.jpg', 'Mahasiswa yang fokus pada copywriting, dokumentasi produk, dan pembuatan konten digital untuk kebutuhan bisnis dan project.', 'Copywriting, Product Documentation', '0', 30000, '081234567802', 'tersedia'),
(12, 13, '24082010166', 'Sistem Informasi', 'default.jpg', 'aku kaka', 'ui ux', '0', 25000, '0881328382', 'sibuk');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `judul_jasa` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci NOT NULL,
  `harga` int NOT NULL,
  `estimasi_pengerjaan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_general_ci DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `user_id`, `judul_jasa`, `kategori`, `deskripsi`, `harga`, `estimasi_pengerjaan`, `status`, `created_at`) VALUES
(1, 1, 'Jasa Penerjemah Dokumen Inggris-Indonesia', 'Penerjemah', 'Melayani penerjemahan dokumen umum dan akademik dari bahasa Inggris ke Indonesia maupun sebaliknya dengan hasil rapi dan mudah dipahami.', 50000, '2-3 hari', 'aktif', '2026-03-28 12:56:27'),
(2, 1, 'Jasa Social Media Management', 'Digital Marketing', 'Membantu mengelola akun Instagram, TikTok, dan LinkedIn untuk kebutuhan personal branding maupun UMKM.', 300000, '5-7 hari', 'aktif', '2026-03-28 12:56:27'),
(4, 12, 'Jasa Desain UI Aplikasi Mobile', 'UI/UX Research and Design', 'Melayani desain UI aplikasi mobile menggunakan Figma, mulai dari wireframe, mockup, hingga prototype interaktif yang siap dipresentasikan.', 250000, '3-5 hari', 'aktif', '2026-04-15 08:14:13'),
(5, 12, 'Jasa Wireframe dan Prototype Website', 'UI/UX Research and Design', 'Membantu membuat wireframe dan prototype website untuk project kuliah, UMKM, maupun kebutuhan pitching produk digital.', 200000, '2-4 hari', 'aktif', '2026-04-15 08:14:36'),
(6, 11, 'Jasa Copywriting dan Caption Ads', 'Digital Marketing', 'Melayani pembuatan copywriting untuk iklan, caption media sosial, dan konten promosi yang lebih menarik dan persuasif.', 120000, '1-2 hari', 'aktif', '2026-04-15 08:14:45'),
(8, 13, 'jasa membuat website', 'Website & Apps Developer', 'website html', 70000, '3 hari', 'aktif', '2026-04-15 10:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('pembeli','penyedia') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pembeli',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `email`, `username`, `password`, `role`, `is_verified`, `created_at`) VALUES
(1, 'AQILLA RASYA', '24082010168@student.upnjatim.ac.id', 'aqill123', '$2y$10$BGiqyc.xfl.7nYwQW3rMp.ZgAJjW1XfSieN2bThmvyVH6SxedcjMK', 'penyedia', 0, '2026-03-28 04:13:53'),
(9, 'budiono', 'budiono@gmail.co', 'budiiii', '$2y$10$fBOYZ5xnbr2f21VhptY89OqNP1jYKhA2e2FlVV6Geca4xFVOdL1ZO', 'pembeli', 0, '2026-04-15 04:51:11'),
(11, 'IQBAL MAULANA', '240820150@student.upnjatim.ac.id', 'IQBAL MAULANA', '$2y$10$1PXnIx5oE79w6uhWUsB3ZeXYsCG8rtWhPsxsB0uZqH3WERVapmfAi', 'penyedia', 0, '2026-04-15 08:03:57'),
(12, 'FATIH ATHALA', '2408201046@student.upnjatim.ac.id', 'FATIH ATHALA', '$2y$10$LA/BHqruakXXkFUEly.oLeAbdv9TcqK4nR.xlipU17v9RKjkLPwmC', 'penyedia', 0, '2026-04-15 08:05:06'),
(13, 'kaka', '24082010166@student.upnjatim.ac.id', 'kaka dimas', '$2y$10$qk9./8dRyWCUtBNW5y6g.OoQ6EjlU/PNKoupdowO9FfYtJj0FydKi', 'penyedia', 0, '2026-04-15 10:08:36'),
(14, 'iqbal', 'jukifze@gmail.com', 'dahewlll', '$2y$10$WR3RDtyAGYIuoUaAr1uhn.i7IaJ9GalBVVbrJ23M4CNCjdyefpXMe', 'pembeli', 0, '2026-04-16 15:01:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `buyer_id` (`buyer_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `npm` (`npm`),
  ADD UNIQUE KEY `unique_user_profile` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD CONSTRAINT `portfolio_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
