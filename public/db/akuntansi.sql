-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 20 Des 2020 pada 20.54
-- Versi server: 8.0.22-0ubuntu0.20.04.3
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akuntansi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `id` bigint UNSIGNED NOT NULL,
  `kelompok_akun_id` bigint UNSIGNED NOT NULL,
  `kode` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_saldo` tinyint(1) NOT NULL,
  `post_penyesuaian` tinyint(1) NOT NULL,
  `post_laporan` tinyint(1) NOT NULL,
  `kelompok_laporan_posisi_keuangan` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id`, `kelompok_akun_id`, `kode`, `nama`, `post_saldo`, `post_penyesuaian`, `post_laporan`, `kelompok_laporan_posisi_keuangan`, `created_at`, `updated_at`) VALUES
(1, 1, '1110', 'Kas', 1, 2, 1, 1, '2020-12-20 05:49:33', '2020-12-20 06:00:15'),
(2, 1, '1120', 'Piutang', 1, 2, 1, 1, '2020-12-20 05:50:12', '2020-12-20 07:25:07'),
(3, 1, '1130', 'Asuransi Dibayar Dimuka', 1, 2, 1, 1, '2020-12-20 05:52:09', '2020-12-20 07:25:07'),
(4, 1, '1140', 'Perlengkapan Bengkel', 1, 2, 1, 1, '2020-12-20 05:53:21', '2020-12-20 05:53:21'),
(5, 1, '1150', 'Perlengkapan Kantor', 1, 2, 1, 1, '2020-12-20 05:53:44', '2020-12-20 05:53:44'),
(6, 1, '1210', 'Peralatan Bengkel', 1, 2, 1, 2, '2020-12-20 07:25:08', '2020-12-20 07:25:08'),
(7, 1, '1211', 'Akumulasi Penyusutan Peralatan Bengkel', 2, 2, 1, 2, '2020-12-20 07:25:08', '2020-12-20 07:25:08'),
(8, 1, '1220', 'Peralatan Kantor', 1, 2, 1, 2, '2020-12-20 07:25:08', '2020-12-20 07:25:08'),
(9, 1, '1221', 'Akumulasi Penyusutan Peralatan Kantor', 2, 2, 1, 2, '2020-12-20 07:25:08', '2020-12-20 07:25:08'),
(10, 1, '1230', 'Gedung', 1, 2, 1, 2, '2020-12-20 07:25:08', '2020-12-20 07:25:08'),
(11, 1, '1231', 'Akumulasi Penyusutan Gedung', 2, 2, 1, 2, '2020-12-20 07:25:08', '2020-12-20 07:25:08'),
(12, 1, '1240', 'Tanah', 1, 2, 1, 2, '2020-12-20 07:25:08', '2020-12-20 07:25:08'),
(13, 2, '2110', 'Utang Usaha', 2, 2, 1, 3, '2020-12-20 07:25:08', '2020-12-20 10:57:10'),
(14, 2, '2120', 'Utang Gaji', 2, 2, 1, 4, '2020-12-20 07:25:08', '2020-12-20 10:57:02'),
(15, 3, '3110', 'Modal Tuan Ikbal', 2, 2, 1, NULL, '2020-12-20 07:25:08', '2020-12-20 07:25:08'),
(16, 3, '3120', 'Prive', 1, 2, 1, NULL, '2020-12-20 07:25:08', '2020-12-20 07:25:08'),
(17, 4, '4110', 'Pendapatan Bengkel', 2, 2, 2, NULL, '2020-12-20 07:25:08', '2020-12-20 07:25:08'),
(18, 6, '6110', 'Beban Asuransi', 1, 1, 2, NULL, '2020-12-20 07:25:08', '2020-12-20 07:25:08'),
(19, 6, '6120', 'Beban Perlengkapan Bengkel', 1, 1, 2, NULL, '2020-12-20 07:25:08', '2020-12-20 07:25:08'),
(20, 6, '6140', 'Beban Penyusutan Peralatan Bengkel', 1, 1, 2, NULL, '2020-12-20 07:25:08', '2020-12-20 07:25:08'),
(21, 6, '6150', 'Beban Penyusutan Peralatan Kantor', 1, 1, 2, NULL, '2020-12-20 07:25:08', '2020-12-20 07:25:08'),
(22, 6, '6160', 'Beban Penyusutan Gedung', 1, 1, 2, NULL, '2020-12-20 07:25:08', '2020-12-20 07:25:08'),
(23, 6, '6170', 'Beban Listrik, Air dan Telepon', 1, 1, 2, NULL, '2020-12-20 07:25:08', '2020-12-20 07:25:08'),
(24, 6, '6180', 'Beban Gaji', 1, 1, 2, NULL, '2020-12-20 07:25:08', '2020-12-20 07:25:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal_penyesuaian`
--

CREATE TABLE `jurnal_penyesuaian` (
  `id` bigint UNSIGNED NOT NULL,
  `akun_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debit_atau_kredit` tinyint(1) NOT NULL,
  `nilai` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jurnal_penyesuaian`
--

INSERT INTO `jurnal_penyesuaian` (`id`, `akun_id`, `tanggal`, `keterangan`, `bukti`, `debit_atau_kredit`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 19, '2020-12-31', 'Cat Mobil', NULL, 1, 2250000, '2020-12-20 08:30:53', '2020-12-20 08:39:24'),
(2, 4, '2020-12-31', 'Cat Mobil', NULL, 2, 2250000, '2020-12-20 08:32:03', '2020-12-20 08:39:32'),
(3, 18, '2020-12-31', 'Bayar Asuransi Dimuka 1 Bulan', NULL, 1, 1000000, '2020-12-20 08:32:50', '2020-12-20 08:39:37'),
(4, 3, '2020-12-31', 'Bayar Asuransi Dimuka 1 Bulan', NULL, 2, 1000000, '2020-12-20 08:33:21', '2020-12-20 08:39:50'),
(5, 24, '2020-12-31', 'Belum bayar gaji bulan juli', NULL, 1, 1000000, '2020-12-20 08:34:08', '2020-12-20 08:39:55'),
(6, 14, '2020-12-31', 'Belum bayar gaji bulan juli', NULL, 2, 1000000, '2020-12-20 08:34:26', '2020-12-20 08:40:02'),
(7, 19, '2020-12-31', 'Perlengkapan bengkel terpakai', NULL, 1, 500000, '2020-12-20 08:34:54', '2020-12-20 08:40:08'),
(8, 4, '2020-12-31', 'Perlengkapan bengkel terpakai', NULL, 2, 500000, '2020-12-20 08:35:06', '2020-12-20 08:40:12'),
(9, 22, '2020-12-31', 'Penyusutan gedung', NULL, 1, 600000, '2020-12-20 08:35:36', '2020-12-20 08:40:18'),
(10, 11, '2020-12-31', 'Penyusutan gedung', NULL, 2, 600000, '2020-12-20 08:35:51', '2020-12-20 08:40:23'),
(11, 20, '2020-12-31', 'Penyusutan peralatan bengkel', NULL, 1, 400000, '2020-12-20 08:36:33', '2020-12-20 08:40:27'),
(12, 7, '2020-12-31', 'Penyusutan peralatan bengkel', NULL, 2, 400000, '2020-12-20 08:36:47', '2020-12-20 08:40:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal_umum`
--

CREATE TABLE `jurnal_umum` (
  `id` bigint UNSIGNED NOT NULL,
  `akun_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debit_atau_kredit` tinyint(1) NOT NULL,
  `nilai` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jurnal_umum`
--

INSERT INTO `jurnal_umum` (`id`, `akun_id`, `tanggal`, `keterangan`, `bukti`, `debit_atau_kredit`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-12-01', 'Modal Awal', NULL, 1, 14400000, '2020-12-20 08:16:34', '2020-12-20 08:40:47'),
(2, 2, '2020-12-01', 'Modal Awal', NULL, 1, 5500000, '2020-12-20 08:17:21', '2020-12-20 08:40:51'),
(3, 3, '2020-12-01', 'Modal Awal', NULL, 1, 1300000, '2020-12-20 08:17:43', '2020-12-20 08:40:56'),
(4, 4, '2020-12-01', 'Modal Awal', NULL, 1, 14500000, '2020-12-20 08:18:33', '2020-12-20 08:41:00'),
(5, 5, '2020-12-01', 'Modal Awal', NULL, 1, 2300000, '2020-12-20 08:19:02', '2020-12-20 08:41:04'),
(6, 6, '2020-12-01', 'Modal Awal', NULL, 1, 27800000, '2020-12-20 08:25:08', '2020-12-20 08:44:34'),
(7, 8, '2020-12-01', 'Modal Awal', NULL, 1, 3260000, '2020-12-20 08:25:33', '2020-12-20 08:41:20'),
(8, 9, '2020-12-01', 'Modal Awal', NULL, 2, 500000, '2020-12-20 08:25:56', '2020-12-20 08:41:25'),
(9, 10, '2020-12-01', 'Modal Awal', NULL, 1, 20000000, '2020-12-20 08:26:17', '2020-12-20 08:41:29'),
(10, 11, '2020-12-01', 'Modal Awal', NULL, 2, 1000000, '2020-12-20 08:26:54', '2020-12-20 08:41:33'),
(11, 12, '2020-12-01', 'Modal Awal', NULL, 1, 30000000, '2020-12-20 08:27:23', '2020-12-20 08:41:37'),
(12, 13, '2020-12-01', 'Modal Awal', NULL, 2, 28500000, '2020-12-20 08:28:40', '2020-12-20 08:41:41'),
(13, 14, '2020-12-01', 'Modal Awal', NULL, 2, 2000000, '2020-12-20 08:28:55', '2020-12-20 08:41:45'),
(14, 15, '2020-12-01', 'Modal Awal', NULL, 2, 85670000, '2020-12-20 08:29:12', '2020-12-20 08:41:48'),
(15, 7, '2020-12-01', 'Modal Awal', NULL, 2, 1390000, '2020-12-20 08:45:21', '2020-12-20 08:45:21'),
(16, 23, '2020-12-10', 'Beban Listrik', NULL, 1, 200000, '2020-12-20 08:47:19', '2020-12-20 08:47:19'),
(17, 23, '2020-12-10', 'Beban Air', NULL, 1, 250000, '2020-12-20 08:47:40', '2020-12-20 08:47:40'),
(18, 23, '2020-12-10', 'Beban Telepon', NULL, 1, 150000, '2020-12-20 08:48:15', '2020-12-20 08:48:15'),
(19, 1, '2020-12-10', 'Membayar Beban', NULL, 2, 600000, '2020-12-20 08:48:34', '2020-12-20 08:48:34'),
(20, 1, '2020-12-02', 'Melakukan Investasi ke usahanya', NULL, 1, 10000000, '2020-12-20 08:50:09', '2020-12-20 08:50:09'),
(21, 15, '2020-12-02', 'Melakukan Investasi ke usahanya', NULL, 2, 10000000, '2020-12-20 08:50:27', '2020-12-20 08:50:27'),
(22, 6, '2020-12-03', 'Membeil peralata secara kredit', NULL, 1, 5000000, '2020-12-20 08:51:11', '2020-12-20 08:51:11'),
(23, 13, '2020-12-03', 'Membeil peralata secara kredit', NULL, 2, 5000000, '2020-12-20 08:51:31', '2020-12-20 08:52:19'),
(24, 3, '2020-12-04', 'Membayar asuransi untuk 1 tahun ke depan', NULL, 1, 12000000, '2020-12-20 08:53:08', '2020-12-20 09:47:43'),
(25, 1, '2020-12-04', 'Membayar asuransi untuk 1 tahun ke depan', NULL, 2, 12000000, '2020-12-20 08:53:42', '2020-12-20 08:53:42'),
(26, 4, '2020-12-07', 'Membeli perlengkapan secara tunai', NULL, 1, 1000000, '2020-12-20 08:54:18', '2020-12-20 08:54:18'),
(27, 1, '2020-12-07', 'Membeli perlengkapan secara tunai', NULL, 2, 1000000, '2020-12-20 08:54:31', '2020-12-20 08:54:31'),
(28, 4, '2020-12-13', 'Membeli cat mobil secara kredit', NULL, 1, 7000000, '2020-12-20 08:55:11', '2020-12-20 08:55:11'),
(29, 13, '2020-12-13', 'Membeli cat mobil secara kredit', NULL, 2, 7000000, '2020-12-20 08:55:33', '2020-12-20 08:55:33'),
(30, 1, '2020-12-14', 'Menerima Pendapatan dengan dibayar sebagian', NULL, 1, 3000000, '2020-12-20 08:56:06', '2020-12-20 08:56:06'),
(31, 2, '2020-12-14', 'Menerima Pendapatan dengan dibayar sebagian', NULL, 1, 1500000, '2020-12-20 08:56:28', '2020-12-20 08:56:28'),
(32, 17, '2020-12-14', 'Menerima Pendapatan dengan dibayar sebagian', NULL, 2, 4500000, '2020-12-20 08:56:48', '2020-12-20 08:56:48'),
(33, 1, '2020-12-18', 'Menerima pendapatan dibayar tunai', NULL, 1, 6000000, '2020-12-20 08:57:14', '2020-12-20 08:57:14'),
(34, 17, '2020-12-18', 'Menerima Pendapatan dibayar tunai', NULL, 2, 6000000, '2020-12-20 08:57:29', '2020-12-20 09:01:05'),
(35, 1, '2020-12-23', 'Menerima pendapatan dibayar tunai', NULL, 1, 3000000, '2020-12-20 08:58:14', '2020-12-20 08:58:14'),
(36, 17, '2020-12-23', 'Menerima pendapatan dibayar tunai', NULL, 2, 3000000, '2020-12-20 08:58:30', '2020-12-20 08:58:30'),
(37, 13, '2020-12-27', 'Membayar utang usaha tanggal 3 juli', NULL, 1, 5000000, '2020-12-20 08:59:01', '2020-12-20 08:59:01'),
(38, 1, '2020-12-27', 'Membayar utang usaha tanggal 3 juli', NULL, 2, 5000000, '2020-12-20 08:59:17', '2020-12-20 08:59:17'),
(39, 16, '2020-12-28', 'Mengambil uang perusahaan untuk keperluan pribadi', NULL, 1, 1000000, '2020-12-20 08:59:59', '2020-12-20 08:59:59'),
(40, 1, '2020-12-28', 'Mengambil uang perusahaan untuk keperluan pribadi', NULL, 2, 1000000, '2020-12-20 09:00:11', '2020-12-20 09:00:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelompok_akun`
--

CREATE TABLE `kelompok_akun` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelompok_akun`
--

INSERT INTO `kelompok_akun` (`id`, `nama`) VALUES
(1, 'Asset'),
(2, 'Kewajiban'),
(3, 'Ekuitas'),
(4, 'Pendapatan'),
(5, 'Belanja'),
(6, 'Pembiayaan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2020_12_17_003155_create_kelompok_akun_table', 1),
(3, '2020_12_17_013108_create_akun_table', 1),
(4, '2020_12_17_055243_create_jurnal_umum_table', 1),
(5, '2020_12_19_142131_create_jurnal_penyesuaian_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Admin', 'admin@argon.com', '2020-12-20 05:36:20', '$2y$10$WRkFWgjHP7jUZ1uyzeS30eklQDl4qfuAATVOIcJetyqarnnJF1Nqq', NULL, '2020-12-20 05:36:20', '2020-12-20 05:36:20');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `akun_kode_unique` (`kode`),
  ADD KEY `akun_kelompok_akun_id_foreign` (`kelompok_akun_id`);

--
-- Indeks untuk tabel `jurnal_penyesuaian`
--
ALTER TABLE `jurnal_penyesuaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurnal_penyesuaian_akun_id_foreign` (`akun_id`);

--
-- Indeks untuk tabel `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurnal_umum_akun_id_foreign` (`akun_id`);

--
-- Indeks untuk tabel `kelompok_akun`
--
ALTER TABLE `kelompok_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun`
--
ALTER TABLE `akun`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `jurnal_penyesuaian`
--
ALTER TABLE `jurnal_penyesuaian`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `kelompok_akun`
--
ALTER TABLE `kelompok_akun`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `akun_kelompok_akun_id_foreign` FOREIGN KEY (`kelompok_akun_id`) REFERENCES `kelompok_akun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jurnal_penyesuaian`
--
ALTER TABLE `jurnal_penyesuaian`
  ADD CONSTRAINT `jurnal_penyesuaian_akun_id_foreign` FOREIGN KEY (`akun_id`) REFERENCES `akun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  ADD CONSTRAINT `jurnal_umum_akun_id_foreign` FOREIGN KEY (`akun_id`) REFERENCES `akun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
