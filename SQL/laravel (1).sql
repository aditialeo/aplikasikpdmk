-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 06, 2024 at 01:44 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` bigint UNSIGNED NOT NULL,
  `kd_barang` int NOT NULL,
  `nm_barang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan_barang_id` bigint UNSIGNED NOT NULL,
  `jenis_barang_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stok` int NOT NULL,
  `merk_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kd_barang`, `nm_barang`, `satuan_barang_id`, `jenis_barang_id`, `created_at`, `updated_at`, `stok`, `merk_id`) VALUES
(1, 15, 'asd', 5, 7, '2024-01-31 14:33:58', '2024-07-11 14:56:13', 178, 5),
(5, 554, 'kss', 7, 8, '2024-03-04 19:26:26', '2024-03-24 14:52:55', 60, 7),
(6, 654, 'ikan', 7, 7, '2024-03-06 12:57:15', '2024-07-11 14:58:33', 46, 7),
(7, 332, '3r32', 5, 7, '2024-03-06 12:57:44', '2024-03-06 12:57:44', 21, 5),
(12, 542, 'suprame', 7, 10, '2024-04-21 12:43:32', '2024-04-21 12:43:32', 11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_barang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_barang` int NOT NULL,
  `suplair_id` bigint UNSIGNED NOT NULL,
  `merk_id` bigint UNSIGNED NOT NULL,
  `jumlah_keluar` int NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id`, `nama_barang`, `kd_barang`, `suplair_id`, `merk_id`, `jumlah_keluar`, `tanggal_keluar`, `created_at`, `updated_at`) VALUES
(1, 'asd', 15, 8, 5, 12, '2024-04-30', '2024-04-29 12:50:02', '2024-04-29 12:50:02');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_barang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_barang` int NOT NULL,
  `suplair_id` bigint UNSIGNED NOT NULL,
  `jumlah_masuk` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `merk_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `nama_barang`, `kd_barang`, `suplair_id`, `jumlah_masuk`, `created_at`, `updated_at`, `merk_id`) VALUES
(31, 'asd', 15, 8, 5, '2024-04-29 13:32:51', '2024-07-11 14:56:13', 5),
(32, 'ikan', 654, 9, 12, '2024-07-11 14:58:33', '2024-07-11 14:58:33', 7);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`) VALUES
(7, 'jojojo', 'bacdk', '2024-01-28 09:16:49', '2024-01-28 09:33:32'),
(8, 'xxxkk', 'kosong', '2024-01-28 09:17:14', '2024-07-11 14:55:17'),
(10, 'koil', 'samping', '2024-04-21 12:41:37', '2024-04-21 12:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`) VALUES
(5, 'ktn', 'ktn', '2024-01-28 08:31:47', '2024-01-28 08:31:47'),
(7, 'dov', 'kosong', '2024-02-26 13:06:49', '2024-07-11 14:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_12_15_204632_create_satuan_barangs_table', 2),
(7, '2023_12_15_204659_create_jenis_barangs_table', 2),
(8, '2023_12_15_211054_create_barangs_table', 3),
(9, '2023_12_15_213020_create_barang_masuks_table', 4),
(10, '2023_12_15_221128_create_suplairs_table', 5),
(11, '2023_12_15_221624_add_suplair_id_to_barang_masuk_table', 6),
(12, '2023_12_15_222356_add_stok_to_barang_table', 7),
(13, '2023_12_15_222815_create_merks_table', 8),
(15, '2023_12_15_223334_change_merek_from_barang_table', 9),
(16, '2024_02_28_214104_add_merk_nama_to_barang_masuk_table', 10),
(17, '2024_03_17_113855_create_riwayat_barang_masuks_table', 11),
(18, '2024_03_24_115450_create_barang_keluars_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_transaksi_barang`
--

CREATE TABLE `riwayat_transaksi_barang` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_barang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_barang` int NOT NULL,
  `suplair_id` bigint UNSIGNED NOT NULL,
  `merk_id` bigint UNSIGNED NOT NULL,
  `stok` bigint DEFAULT NULL,
  `jenis` enum('barang_masuk','barang_keluar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riwayat_transaksi_barang`
--

INSERT INTO `riwayat_transaksi_barang` (`id`, `nama_barang`, `kd_barang`, `suplair_id`, `merk_id`, `stok`, `jenis`, `created_at`, `updated_at`) VALUES
(1, 'kss', 554, 8, 5, 20, 'barang_masuk', '2024-03-24 14:52:55', '2024-03-24 14:52:55'),
(2, 'asd', 15, 8, 5, 40, 'barang_masuk', '2024-03-24 15:48:28', '2024-03-24 15:48:28'),
(3, 'asd', 15, 8, 5, 20, 'barang_masuk', '2024-03-24 15:51:52', '2024-03-24 15:51:52'),
(4, 'asd', 15, 8, 5, 20, 'barang_masuk', '2024-03-24 15:52:34', '2024-03-24 15:52:34'),
(5, 'asd', 15, 8, 5, 40, 'barang_masuk', '2024-03-24 15:53:30', '2024-03-24 15:53:30'),
(6, 'asd', 15, 8, 5, 60, 'barang_masuk', '2024-03-24 15:55:52', '2024-03-24 15:55:52'),
(7, 'asd', 15, 8, 5, 40, 'barang_masuk', '2024-03-24 15:56:14', '2024-03-24 15:56:14'),
(8, 'asd', 15, 8, 5, 12, 'barang_keluar', '2024-04-29 12:50:02', '2024-04-29 12:50:02'),
(9, 'asd', 15, 8, 5, 12, 'barang_masuk', '2024-04-29 13:17:15', '2024-04-29 13:17:15'),
(10, 'asd', 15, 8, 5, 23, 'barang_masuk', '2024-04-29 13:24:24', '2024-04-29 13:24:24'),
(11, 'asd', 15, 8, 5, 23, 'barang_masuk', '2024-04-29 13:26:17', '2024-04-29 13:26:17'),
(12, 'asd', 15, 8, 5, 23, 'barang_masuk', '2024-04-29 13:27:58', '2024-04-29 13:27:58'),
(13, 'asd', 15, 8, 5, 23, 'barang_masuk', '2024-04-29 13:28:49', '2024-04-29 13:28:49'),
(14, 'asd', 15, 8, 5, 23, 'barang_masuk', '2024-04-29 13:29:15', '2024-04-29 13:29:15'),
(15, 'asd', 15, 8, 5, 23, 'barang_masuk', '2024-04-29 13:31:57', '2024-04-29 13:31:57'),
(16, 'asd', 15, 8, 5, 23, 'barang_masuk', '2024-04-29 13:32:18', '2024-04-29 13:32:18'),
(17, 'asd', 15, 8, 5, 2, 'barang_masuk', '2024-04-29 13:32:51', '2024-04-29 13:32:51'),
(18, 'asd', 15, 8, 5, 5, 'barang_masuk', '2024-07-11 14:56:13', '2024-07-11 14:56:13'),
(19, 'ikan', 654, 9, 7, 12, 'barang_masuk', '2024-07-11 14:58:33', '2024-07-11 14:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `satuan_barang`
--

CREATE TABLE `satuan_barang` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satuan_barang`
--

INSERT INTO `satuan_barang` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`) VALUES
(5, 'pcs', 'kosong', '2024-01-28 09:34:13', '2024-01-28 09:34:13'),
(7, 'ktk', 'kosong', '2024-02-26 13:06:21', '2024-02-26 13:06:21'),
(8, 'Pel', 'pel', '2024-04-21 12:42:20', '2024-07-11 14:53:15');

-- --------------------------------------------------------

--
-- Table structure for table `suplair`
--

CREATE TABLE `suplair` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_suplair` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kota` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `no_telpon` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suplair`
--

INSERT INTO `suplair` (`id`, `nama_suplair`, `alamat`, `kota`, `no_telpon`, `created_at`, `updated_at`) VALUES
(8, 'aditiawin', 'jl paus', 'pekanbaru', '081275616625', '2024-02-26 13:05:36', '2024-07-11 14:53:38'),
(9, 'anugrah', 'jln riau', 'pekanbaru', '089999', '2024-04-21 12:40:39', '2024-04-21 12:40:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$12$B9GFu/n/dpWsCNKqWPs6COKhgQ/XieIyXEdIc8XsPUKiXhPLJV756', NULL, '2023-12-04 07:40:06', '2023-12-04 07:40:06'),
(6, 'leo', 'disc3399@gmail.com', NULL, '$2y$12$sIu1Ye4E6EBK96c1dHNtEeUBOkheHbzGahE1g9ds7Ri2sBSd7tPLa', NULL, '2024-01-18 14:22:35', '2024-01-18 15:27:57'),
(7, 'aditia', 'aditia@aditia.com', NULL, '$2y$12$t.YNaVgi2wEkaBF0C0f.g.YFBEuM9dFe0Wy9IflRxZFHjEw52ILx6', NULL, '2024-01-19 12:09:26', '2024-01-19 12:09:26'),
(8, 'admin889', 'admin@gmailkkj.com', NULL, '$2y$12$1OX/gyLbEernEdXl.S8mAO8xmz5NhiwXrXiluA4UbT7L06Il6Pa3a', NULL, '2024-01-21 10:10:30', '2024-01-21 10:10:30'),
(11, 'ooo', 'oooo2@admin.com', NULL, '$2y$12$ZF.Euko34ZgkHvzeOssaJeWlCA8nTBXRpGmeiU6WTbQOZSZyRa8Gy', NULL, '2024-01-25 12:25:42', '2024-01-25 12:25:42'),
(12, 'leo aditia', 'adminsuper123@gmail.com', NULL, '$2y$12$hYIvJfFAiOOUWP0y/6QJ/u4Rfc0X85r.a4P8k31OG5aIy.bzT5Iqq', NULL, '2024-02-06 07:58:02', '2024-02-06 07:58:02'),
(13, 'leo aditia', 'aditialeo2700@gmail.com', NULL, '$2y$12$HndHW4PHMHZFe7Eh7/GLV.FoT0KcZ4NoY2qbyINOuooDNbZyRA1/y', NULL, '2024-02-06 09:55:16', '2024-02-06 09:55:16'),
(14, 'aditia', 'superdmk123@gmail.com', NULL, '$2y$12$DIc89tqnUw/5YF/OQd6OC.efI6tC8Y2C5Isq6xEl8c/QfwIp6QZNq', NULL, '2024-02-07 20:17:16', '2024-02-07 20:17:16'),
(15, 'yuta', 'yuta123@gmail.com', NULL, '$2y$12$8J.nmOUVij5qpwRkReTvKuU22ylR.4Vn4sfQxP73XCq9MBt/HpQZW', NULL, '2024-02-07 21:38:58', '2024-02-07 21:38:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_satuan_barang_id_foreign` (`satuan_barang_id`),
  ADD KEY `barang_jenis_barang_id_foreign` (`jenis_barang_id`),
  ADD KEY `kd_barang` (`kd_barang`),
  ADD KEY `barang_merk_id_foreign` (`merk_id`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_keluar_kd_barang_foreign` (`kd_barang`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `riwayat_transaksi_barang`
--
ALTER TABLE `riwayat_transaksi_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suplair`
--
ALTER TABLE `suplair`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `riwayat_transaksi_barang`
--
ALTER TABLE `riwayat_transaksi_barang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `suplair`
--
ALTER TABLE `suplair`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_jenis_barang_id_foreign` FOREIGN KEY (`jenis_barang_id`) REFERENCES `jenis_barang` (`id`),
  ADD CONSTRAINT `barang_merk_id_foreign` FOREIGN KEY (`merk_id`) REFERENCES `merk` (`id`),
  ADD CONSTRAINT `barang_satuan_barang_id_foreign` FOREIGN KEY (`satuan_barang_id`) REFERENCES `satuan_barang` (`id`);

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_kd_barang_foreign` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`kd_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
