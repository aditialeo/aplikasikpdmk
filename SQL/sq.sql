-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table apptoko2.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kd_barang` int NOT NULL,
  `nm_barang` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan_barang_id` bigint unsigned NOT NULL,
  `jenis_barang_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stok` int NOT NULL,
  `merk_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `barang_satuan_barang_id_foreign` (`satuan_barang_id`),
  KEY `barang_jenis_barang_id_foreign` (`jenis_barang_id`),
  KEY `kd_barang` (`kd_barang`),
  KEY `barang_merk_id_foreign` (`merk_id`),
  CONSTRAINT `barang_jenis_barang_id_foreign` FOREIGN KEY (`jenis_barang_id`) REFERENCES `jenis_barang` (`id`),
  CONSTRAINT `barang_merk_id_foreign` FOREIGN KEY (`merk_id`) REFERENCES `merk` (`id`),
  CONSTRAINT `barang_satuan_barang_id_foreign` FOREIGN KEY (`satuan_barang_id`) REFERENCES `satuan_barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.barang: ~3 rows (approximately)
REPLACE INTO `barang` (`id`, `kd_barang`, `nm_barang`, `satuan_barang_id`, `jenis_barang_id`, `created_at`, `updated_at`, `stok`, `merk_id`) VALUES
	(1, 15, 'asd', 5, 7, '2024-01-31 14:33:58', '2024-08-14 17:13:11', 185, 5),
	(14, 123, 'grande', 7, 10, '2024-08-14 13:58:11', '2024-08-14 17:24:31', 24, 5),
	(20, 17, 'arwana', 7, 10, '2024-10-17 14:33:02', '2024-10-17 14:33:02', 10, 7);

-- Dumping structure for table apptoko2.barang_keluar
CREATE TABLE IF NOT EXISTS `barang_keluar` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kd_barang` int NOT NULL,
  `suplair_id` bigint unsigned NOT NULL,
  `merk_id` bigint unsigned NOT NULL,
  `jumlah_keluar` int NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `barang_keluar_kd_barang_foreign` (`kd_barang`),
  CONSTRAINT `barang_keluar_kd_barang_foreign` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`kd_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.barang_keluar: ~0 rows (approximately)
REPLACE INTO `barang_keluar` (`id`, `kd_barang`, `suplair_id`, `merk_id`, `jumlah_keluar`, `tanggal_keluar`, `created_at`, `updated_at`) VALUES
	(5, 15, 8, 5, 4, '2024-08-14', '2024-08-14 17:11:16', '2024-08-14 17:11:16');

-- Dumping structure for table apptoko2.barang_masuk
CREATE TABLE IF NOT EXISTS `barang_masuk` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kd_barang` int NOT NULL,
  `suplair_id` bigint unsigned NOT NULL,
  `jumlah_masuk` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `merk_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.barang_masuk: ~2 rows (approximately)
REPLACE INTO `barang_masuk` (`id`, `kd_barang`, `suplair_id`, `jumlah_masuk`, `created_at`, `updated_at`, `merk_id`) VALUES
	(35, 15, 9, 3, '2024-08-14 17:09:40', '2024-08-14 17:09:40', 5),
	(36, 15, 9, 3, '2024-08-14 17:09:59', '2024-08-14 17:09:59', 5);

-- Dumping structure for table apptoko2.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table apptoko2.jenis_barang
CREATE TABLE IF NOT EXISTS `jenis_barang` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.jenis_barang: ~3 rows (approximately)
REPLACE INTO `jenis_barang` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`) VALUES
	(7, 'jojojo', 'bacdk', '2024-01-28 09:16:49', '2024-01-28 09:33:32'),
	(8, 'xxxkk', 'kosong', '2024-01-28 09:17:14', '2024-07-11 14:55:17'),
	(10, 'koil', 'asdg', '2024-04-21 12:41:37', '2024-08-14 10:52:35');

-- Dumping structure for table apptoko2.merk
CREATE TABLE IF NOT EXISTS `merk` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.merk: ~3 rows (approximately)
REPLACE INTO `merk` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`) VALUES
	(5, 'ktn', 'ktn', '2024-01-28 08:31:47', '2024-01-28 08:31:47'),
	(7, 'dov', 'asd', '2024-02-26 13:06:49', '2024-08-14 10:47:59'),
	(9, 'asda', 'asd', '2024-08-14 10:47:18', '2024-08-14 10:47:18');

-- Dumping structure for table apptoko2.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.migrations: ~18 rows (approximately)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
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
	(18, '2024_03_24_115450_create_barang_keluars_table', 12),
	(19, '2024_08_15_000919_create_titip_barangs_table', 13),
	(20, '2025_03_09_191046_create_permission_tables', 14);

-- Dumping structure for table apptoko2.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.model_has_permissions: ~0 rows (approximately)

-- Dumping structure for table apptoko2.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.model_has_roles: ~0 rows (approximately)
REPLACE INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(3, 'App\\Models\\User', 16);

-- Dumping structure for table apptoko2.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.password_resets: ~0 rows (approximately)

-- Dumping structure for table apptoko2.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table apptoko2.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.permissions: ~48 rows (approximately)
REPLACE INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(2, 'create-barang', 'web', '2025-03-09 12:35:37', '2025-03-09 12:35:37'),
	(3, 'create-beranda', 'web', '2025-03-09 13:15:02', '2025-03-09 13:15:02'),
	(4, 'read-beranda', 'web', '2025-03-09 13:15:02', '2025-03-09 13:15:02'),
	(5, 'update-beranda', 'web', '2025-03-09 13:15:02', '2025-03-09 13:15:02'),
	(6, 'delete-beranda', 'web', '2025-03-09 13:15:02', '2025-03-09 13:15:02'),
	(7, 'read-barang', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(8, 'update-barang', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(9, 'delete-barang', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(10, 'create-barangmasuk', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(11, 'read-barangmasuk', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(12, 'update-barangmasuk', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(13, 'delete-barangmasuk', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(14, 'create-barangkeluar', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(15, 'read-barangkeluar', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(16, 'update-barangkeluar', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(17, 'delete-barangkeluar', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(18, 'create-riwayattransaksibarang', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(19, 'read-riwayattransaksibarang', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(20, 'update-riwayattransaksibarang', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(21, 'delete-riwayattransaksibarang', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(22, 'create-suplair', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(23, 'read-suplair', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(24, 'update-suplair', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(25, 'delete-suplair', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(26, 'create-satuanbarang', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(27, 'read-satuanbarang', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(28, 'update-satuanbarang', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(29, 'delete-satuanbarang', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(30, 'create-merk', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(31, 'read-merk', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(32, 'update-merk', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(33, 'delete-merk', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(34, 'create-jenisbarang', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(35, 'read-jenisbarang', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(36, 'update-jenisbarang', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(37, 'delete-jenisbarang', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(38, 'create-user', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(39, 'read-user', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(40, 'update-user', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(41, 'delete-user', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(42, 'create-permission', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(43, 'read-permission', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(44, 'update-permission', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(45, 'delete-permission', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(46, 'create-role', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(47, 'read-role', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(48, 'update-role', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31'),
	(49, 'delete-role', 'web', '2025-03-09 13:15:31', '2025-03-09 13:15:31');

-- Dumping structure for table apptoko2.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table apptoko2.riwayat_transaksi_barang
CREATE TABLE IF NOT EXISTS `riwayat_transaksi_barang` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kd_barang` int NOT NULL,
  `suplair_id` bigint unsigned NOT NULL,
  `merk_id` bigint unsigned NOT NULL,
  `stok` bigint DEFAULT NULL,
  `jenis` enum('barang_masuk','barang_keluar') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.riwayat_transaksi_barang: ~29 rows (approximately)
REPLACE INTO `riwayat_transaksi_barang` (`id`, `kd_barang`, `suplair_id`, `merk_id`, `stok`, `jenis`, `created_at`, `updated_at`) VALUES
	(1, 554, 8, 5, 20, 'barang_masuk', '2024-03-24 14:52:55', '2024-03-24 14:52:55'),
	(2, 15, 8, 5, 40, 'barang_masuk', '2024-03-24 15:48:28', '2024-03-24 15:48:28'),
	(3, 15, 8, 5, 20, 'barang_masuk', '2024-03-24 15:51:52', '2024-03-24 15:51:52'),
	(4, 15, 8, 5, 20, 'barang_masuk', '2024-03-24 15:52:34', '2024-03-24 15:52:34'),
	(5, 15, 8, 5, 40, 'barang_masuk', '2024-03-24 15:53:30', '2024-03-24 15:53:30'),
	(6, 15, 8, 5, 60, 'barang_masuk', '2024-03-24 15:55:52', '2024-03-24 15:55:52'),
	(7, 15, 8, 5, 40, 'barang_masuk', '2024-03-24 15:56:14', '2024-03-24 15:56:14'),
	(8, 15, 8, 5, 12, 'barang_keluar', '2024-04-29 12:50:02', '2024-04-29 12:50:02'),
	(9, 15, 8, 5, 12, 'barang_masuk', '2024-04-29 13:17:15', '2024-04-29 13:17:15'),
	(10, 15, 8, 5, 23, 'barang_masuk', '2024-04-29 13:24:24', '2024-04-29 13:24:24'),
	(11, 15, 8, 5, 23, 'barang_masuk', '2024-04-29 13:26:17', '2024-04-29 13:26:17'),
	(12, 15, 8, 5, 23, 'barang_masuk', '2024-04-29 13:27:58', '2024-04-29 13:27:58'),
	(13, 15, 8, 5, 23, 'barang_masuk', '2024-04-29 13:28:49', '2024-04-29 13:28:49'),
	(14, 15, 8, 5, 23, 'barang_masuk', '2024-04-29 13:29:15', '2024-04-29 13:29:15'),
	(15, 15, 8, 5, 23, 'barang_masuk', '2024-04-29 13:31:57', '2024-04-29 13:31:57'),
	(16, 15, 8, 5, 23, 'barang_masuk', '2024-04-29 13:32:18', '2024-04-29 13:32:18'),
	(17, 15, 8, 5, 2, 'barang_masuk', '2024-04-29 13:32:51', '2024-04-29 13:32:51'),
	(18, 15, 8, 5, 5, 'barang_masuk', '2024-07-11 14:56:13', '2024-07-11 14:56:13'),
	(19, 654, 9, 7, 12, 'barang_masuk', '2024-07-11 14:58:33', '2024-07-11 14:58:33'),
	(20, 15, 8, 5, 123, 'barang_masuk', '2024-08-11 08:29:09', '2024-08-11 08:29:09'),
	(21, 123, 8, 5, 12, 'barang_masuk', '2024-08-13 13:04:20', '2024-08-13 13:04:20'),
	(22, 123, 8, 5, 12, 'barang_keluar', '2024-08-13 13:42:00', '2024-08-13 13:42:00'),
	(23, 123, 8, 5, 12, 'barang_keluar', '2024-08-14 09:52:07', '2024-08-14 09:52:07'),
	(24, 123, 8, 5, 12, 'barang_keluar', '2024-08-14 09:53:20', '2024-08-14 09:53:20'),
	(25, 123, 8, 5, 13, 'barang_keluar', '2024-08-14 09:59:51', '2024-08-14 09:59:51'),
	(26, 654, 9, 5, 2, 'barang_masuk', '2024-08-14 17:20:54', '2024-08-14 17:20:54'),
	(27, 123, 8, 5, 12, 'barang_masuk', '2024-08-14 17:22:08', '2024-08-14 17:22:08'),
	(28, 554, 13, 5, 2, 'barang_keluar', '2024-08-14 17:23:35', '2024-08-14 17:23:35'),
	(29, 654, 13, 9, 12, 'barang_masuk', '2024-08-15 02:14:11', '2024-08-15 02:14:11');

-- Dumping structure for table apptoko2.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.roles: ~2 rows (approximately)
REPLACE INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(3, 'admin', 'web', '2025-03-09 12:51:59', '2025-03-09 12:51:59'),
	(4, 'manajer', 'web', '2025-03-09 13:32:32', '2025-03-09 13:32:32');

-- Dumping structure for table apptoko2.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.role_has_permissions: ~56 rows (approximately)
REPLACE INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(2, 3),
	(3, 3),
	(4, 3),
	(5, 3),
	(6, 3),
	(7, 3),
	(8, 3),
	(9, 3),
	(10, 3),
	(11, 3),
	(12, 3),
	(13, 3),
	(14, 3),
	(15, 3),
	(16, 3),
	(17, 3),
	(18, 3),
	(19, 3),
	(20, 3),
	(21, 3),
	(22, 3),
	(23, 3),
	(24, 3),
	(25, 3),
	(26, 3),
	(27, 3),
	(28, 3),
	(29, 3),
	(30, 3),
	(31, 3),
	(32, 3),
	(33, 3),
	(34, 3),
	(35, 3),
	(36, 3),
	(37, 3),
	(38, 3),
	(39, 3),
	(40, 3),
	(41, 3),
	(42, 3),
	(43, 3),
	(44, 3),
	(45, 3),
	(46, 3),
	(47, 3),
	(48, 3),
	(49, 3),
	(2, 4),
	(3, 4),
	(4, 4),
	(5, 4),
	(6, 4),
	(11, 4),
	(15, 4),
	(23, 4);

-- Dumping structure for table apptoko2.satuan_barang
CREATE TABLE IF NOT EXISTS `satuan_barang` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.satuan_barang: ~4 rows (approximately)
REPLACE INTO `satuan_barang` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`) VALUES
	(5, 'pcs', 'sdf', '2024-01-28 09:34:13', '2024-08-14 10:42:27'),
	(7, 'ktk', 'kosong', '2024-02-26 13:06:21', '2024-02-26 13:06:21'),
	(8, 'Pel', 'pel', '2024-04-21 12:42:20', '2024-07-11 14:53:15'),
	(10, 'adsa', 'asd', '2024-08-14 10:42:33', '2024-08-14 10:42:33');

-- Dumping structure for table apptoko2.suplair
CREATE TABLE IF NOT EXISTS `suplair` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_suplair` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kota` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `no_telpon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.suplair: ~4 rows (approximately)
REPLACE INTO `suplair` (`id`, `nama_suplair`, `alamat`, `kota`, `no_telpon`, `created_at`, `updated_at`) VALUES
	(8, 'aditiawin', 'jl paus', 'pekanbaru', '081275616625', '2024-02-26 13:05:36', '2024-07-11 14:53:38'),
	(9, 'anugrah', 'jln riau', 'pekanbaru', '089999', '2024-04-21 12:40:39', '2024-04-21 12:40:39'),
	(13, 'adasd', 'asd', 'adas', '123123', '2024-08-14 10:35:28', '2024-08-14 10:35:28'),
	(14, 'aka', 'rerere', 'uuuu', '233423', '2024-08-14 17:12:12', '2024-08-14 17:12:12');

-- Dumping structure for table apptoko2.titip_barang
CREATE TABLE IF NOT EXISTS `titip_barang` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `barang_id` bigint unsigned NOT NULL,
  `jumlah_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pemilik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_pemilik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp_pemilik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_titip` date DEFAULT NULL,
  `tanggal_ambil` date DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batas_waktu_titip` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.titip_barang: ~0 rows (approximately)
REPLACE INTO `titip_barang` (`id`, `barang_id`, `jumlah_barang`, `nama_pemilik`, `alamat_pemilik`, `no_hp_pemilik`, `tanggal_titip`, `tanggal_ambil`, `status`, `batas_waktu_titip`, `created_at`, `updated_at`) VALUES
	(1, 1, '55', 'agung motor', 'hh', '08888', '2024-08-16', '2024-08-17', 'Dititipkan', '2024-08-24', '2024-08-15 05:31:00', '2024-08-15 15:05:46');

-- Dumping structure for table apptoko2.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table apptoko2.users: ~9 rows (approximately)
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(6, 'leo', 'disc3399@gmail.com', NULL, '$2y$12$sIu1Ye4E6EBK96c1dHNtEeUBOkheHbzGahE1g9ds7Ri2sBSd7tPLa', NULL, '2024-01-18 14:22:35', '2024-01-18 15:27:57'),
	(8, 'admin889', 'admin@gmailkkj.com', NULL, '$2y$12$1OX/gyLbEernEdXl.S8mAO8xmz5NhiwXrXiluA4UbT7L06Il6Pa3a', NULL, '2024-01-21 10:10:30', '2024-01-21 10:10:30'),
	(11, 'ooo', 'oooo2@admin.com', NULL, '$2y$12$ZF.Euko34ZgkHvzeOssaJeWlCA8nTBXRpGmeiU6WTbQOZSZyRa8Gy', NULL, '2024-01-25 12:25:42', '2024-01-25 12:25:42'),
	(12, 'leo aditia', 'adminsuper123@gmail.com', NULL, '$2y$12$hYIvJfFAiOOUWP0y/6QJ/u4Rfc0X85r.a4P8k31OG5aIy.bzT5Iqq', NULL, '2024-02-06 07:58:02', '2024-02-06 07:58:02'),
	(13, 'leo aditia', 'aditialeo2700@gmail.com', NULL, '$2y$12$HndHW4PHMHZFe7Eh7/GLV.FoT0KcZ4NoY2qbyINOuooDNbZyRA1/y', NULL, '2024-02-06 09:55:16', '2024-02-06 09:55:16'),
	(14, 'aditia', 'superdmk123@gmail.com', NULL, '$2y$12$DIc89tqnUw/5YF/OQd6OC.efI6tC8Y2C5Isq6xEl8c/QfwIp6QZNq', NULL, '2024-02-07 20:17:16', '2024-02-07 20:17:16'),
	(15, 'yuta', 'yuta123@gmail.com', NULL, '$2y$12$8J.nmOUVij5qpwRkReTvKuU22ylR.4Vn4sfQxP73XCq9MBt/HpQZW', NULL, '2024-02-07 21:38:58', '2024-02-07 21:38:58'),
	(16, 'admin', 'admin123@gmail.com', NULL, '$2y$12$fPX5hd/NlicSpV0LHiKbKu7ELgxpVBMp9VyV9cp/s4faiXG0n9eve', NULL, '2024-08-14 17:16:16', '2024-08-14 17:16:16'),
	(17, 'dimas', 'gudnand@gmail.com', NULL, '$2y$12$yPa8K3QDY0hhl0AdqBsIxetB.jLLehCtooPDk9/rhnUf75mtCb3eC', NULL, '2024-08-14 17:17:02', '2024-08-14 17:17:02');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
