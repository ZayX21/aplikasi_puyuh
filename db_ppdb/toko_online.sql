-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2023 at 06:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanans`
--

CREATE TABLE `detail_pesanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pesanan_id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `harga_produk` double(8,2) NOT NULL,
  `jumlah_dipesanan` int(11) NOT NULL,
  `total_harga` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_pesanans`
--

INSERT INTO `detail_pesanans` (`id`, `pesanan_id`, `produk_id`, `harga_produk`, `jumlah_dipesanan`, `total_harga`, `created_at`, `updated_at`) VALUES
(1, 1, 12, 276000.00, 4, 999999.99, '2023-07-25 06:06:02', '2023-07-25 06:06:02'),
(2, 2, 3, 50000.00, 2, 100000.00, '2023-07-25 19:43:39', '2023-07-25 19:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foto_produks`
--

CREATE TABLE `foto_produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foto_produks`
--

INSERT INTO `foto_produks` (`id`, `produk_id`, `foto`, `created_at`, `updated_at`) VALUES
(2, 2, '7E0bSlpNZldyUXD5BP9OQQYget5gwDrC5kFB0QH1.jpg', '2023-07-17 07:44:06', '2023-07-17 07:44:06'),
(3, 3, 'uigQv5VnWPVxRKEvHO6xlRNuSJELlWRJyjB9wPuE.jpg', '2023-07-18 05:24:00', '2023-07-18 05:24:00'),
(4, 4, 'JSVvn5w9GvAhNny35B3dESa5AdMRmVuvojiRiKtB.jpg', '2023-07-18 05:26:48', '2023-07-18 05:26:48'),
(5, 5, 'Eeu4UUzCVpROtpMDHvI2jOBS07fb1GcchmCRgqtm.jpg', '2023-07-18 05:29:32', '2023-07-18 05:29:32'),
(6, 6, 'MWlWYvBL90mqWHNDJXQkP7eAWOxH5YIA0G9AlOKA.jpg', '2023-07-18 05:33:52', '2023-07-18 05:33:52'),
(7, 7, 'W557DvD2h0ToKIOgyNQpCsfyxtz1VheXbziaeZ0g.jpg', '2023-07-18 05:51:31', '2023-07-18 05:51:31'),
(8, 8, 'CjE1TWnBKH1CIVop5vGCCRPg9yh1rTPHIRfegURS.jpg', '2023-07-18 05:54:07', '2023-07-18 05:54:07'),
(9, 10, 'ulBfjwOX5CiOBum4B1XgBXmtxzXpBIBccLyl8mPh.jpg', '2023-07-18 05:59:18', '2023-07-18 05:59:18'),
(10, 13, '5tDxiiZloSPMI63sNZZ6oHaN1zNhMOKKLCbjsXY0.jpg', '2023-07-18 06:11:18', '2023-07-18 06:11:18'),
(11, 12, 'ADfCQA0nRiD8srZDlzxs3qfTb5w8ce8DMmgOJmDv.jpg', '2023-07-18 06:11:29', '2023-07-18 06:11:29'),
(13, 14, 'ntHVAOwrIiJBa46eZlLigPJxBB27QfV1PDjlcZuY.jpg', '2023-07-18 06:16:01', '2023-07-18 06:16:01'),
(14, 15, 'xWIaMnwZX6dm6ez9i7HJfusCrG2AO8RPzy9qVojb.jpg', '2023-07-18 06:18:52', '2023-07-18 06:18:52'),
(15, 11, 'TEgNgdYHyMB6T5lnK5FYIyxvC1ilLskicIiVSrk4.jpg', '2023-07-18 06:27:43', '2023-07-18 06:27:43'),
(16, 16, 'zPjBhqtbtUO35Y5ScNqCkspT3luIO2Fu1GZWeuMt.jpg', '2023-07-18 06:28:05', '2023-07-18 06:28:05'),
(17, 17, 'ACZr0uSJxJxQl5FFfb31ovPP5tTwQjbjcB6anIYi.jpg', '2023-07-25 05:36:13', '2023-07-25 05:36:13'),
(18, 19, 'QwcVMe0L6pmmCcgz5G9fuOJxF6l042NZtaWokbB9.jpg', '2023-07-25 05:52:57', '2023-07-25 05:52:57'),
(19, 18, 'w3YDotYUGWXpePB0UXiyDzrKbv8bjZoiKXk0WAvJ.jpg', '2023-07-25 05:53:11', '2023-07-25 05:53:11');

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'burung puyuh', '2023-07-17 07:13:13', '2023-07-17 07:13:13'),
(2, 'obat-obatan', '2023-07-17 07:35:24', '2023-07-17 07:35:24'),
(3, 'pakan puyuh', '2023-07-17 07:35:30', '2023-07-18 06:49:24'),
(4, 'telur puyuh', '2023-07-17 07:35:46', '2023-07-17 07:35:46'),
(5, 'peralatan kandang', '2023-07-17 07:36:00', '2023-07-17 07:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produks`
--

CREATE TABLE `kategori_produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_produks`
--

INSERT INTO `kategori_produks` (`id`, `kategori_id`, `produk_id`, `created_at`, `updated_at`) VALUES
(2, 2, 2, NULL, NULL),
(3, 2, 3, NULL, NULL),
(4, 2, 4, NULL, NULL),
(5, 2, 5, NULL, NULL),
(6, 3, 6, NULL, NULL),
(7, 3, 7, NULL, NULL),
(8, 3, 8, NULL, NULL),
(11, 4, 11, NULL, NULL),
(12, 4, 12, NULL, NULL),
(13, 4, 13, NULL, NULL),
(14, 5, 14, NULL, NULL),
(15, 5, 15, NULL, NULL),
(16, 5, 16, NULL, NULL),
(18, 3, 10, NULL, NULL),
(19, 3, 17, NULL, NULL),
(20, 1, 18, NULL, NULL),
(21, 1, 19, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keranjangs`
--

CREATE TABLE `keranjangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_24_032016_create_kategoris_table', 1),
(6, '2023_05_24_032038_create_produks_table', 1),
(7, '2023_05_24_032110_create_kategori_produks_table', 1),
(8, '2023_05_24_032240_create_roles_table', 1),
(9, '2023_05_24_032305_create_role_users_table', 1),
(10, '2023_05_24_032419_create_pelanggans_table', 1),
(11, '2023_05_24_032500_create_pesanans_table', 1),
(12, '2023_05_24_032522_create_detail_pesanans_table', 1),
(13, '2023_05_24_032653_create_pembayarans_table', 1),
(14, '2023_05_24_041030_create_foto_produks_table', 1),
(15, '2023_05_26_170904_rename_role_users', 1),
(16, '2023_06_18_101805_add_foto_to_foto_produk', 1),
(17, '2023_06_18_102139_remove_deskripsi_from_foto_produk', 1),
(18, '2023_06_21_145349_create_keranjangs_table', 1),
(19, '2023_06_23_094049_add_kode_transaksi_to_pesanan', 1),
(20, '2023_06_23_173150_remove_tanggal_nominal_from_pembayarans', 1),
(21, '2023_06_23_181042_change_total_harga_column_type_in_pesanan_table', 1),
(22, '2023_06_24_092804_create_rekenings_table', 1),
(23, '2023_06_26_144920_create_settings_table', 1),
(24, '2023_06_27_054832_change_total_harga_column_type_in_produk_table', 1),
(25, '2023_06_27_170110_create_sliders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggans`
--

CREATE TABLE `pelanggans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggans`
--

INSERT INTO `pelanggans` (`id`, `user_id`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 2, '-', '-', '2023-07-17 07:28:31', '2023-07-17 07:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pesanan_id` bigint(20) UNSIGNED NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayarans`
--

INSERT INTO `pembayarans` (`id`, `user_id`, `pesanan_id`, `bukti_pembayaran`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'kLq2tLQkv5IlEIml9EbduOqyBIcepp2wUHzxwtgc.jpg', 'Terkonfirmasi', '2023-07-25 06:06:03', '2023-07-25 06:07:03'),
(2, 2, 2, 'N1BUeHW5IhQgYwi8iipOUaKFJ18isFdNjp8il5rg.jpg', 'Belum Dikonfirmasi', '2023-07-25 19:43:39', '2023-07-25 19:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanans`
--

CREATE TABLE `pesanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanans`
--

INSERT INTO `pesanans` (`id`, `kode_transaksi`, `user_id`, `tanggal`, `alamat_pengiriman`, `total_harga`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TRX-230725130349-9207', 2, '2023-07-25', 'Grogolan Rt 02/03, Karanggede, Boyolali, Jawa Tengah', 1104000.00, 'Sudah Dikirim', '2023-07-25 06:06:02', '2023-07-25 06:07:13'),
(2, 'TRX-230726024236-2084', 2, '2023-07-26', 'grogrolan', 100000.00, 'Belum Dikirim', '2023-07-25 19:43:39', '2023-07-25 19:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produks`
--

INSERT INTO `produks` (`id`, `nama_produk`, `deskripsi`, `harga`, `stok`, `created_at`, `updated_at`) VALUES
(2, 'tetra-chlor', 'vita tetra chlor', 4000.00, 10, '2023-07-17 07:41:51', '2023-07-17 07:41:51'),
(3, 'respirant 100 gr', 'obat CRD komleks untuk snot dan pilek pada ayam dan puyuh', 50000.00, 18, '2023-07-18 05:22:24', '2023-07-25 19:43:39'),
(4, 'egg max puyuh 10 gr', 'obat untuk meningkatkan jumlah produksi telur pada burung puyuh', 31000.00, 50, '2023-07-18 05:25:22', '2023-07-18 05:25:22'),
(5, 'coturnix biofit 500 ml', 'obat untuk meningkatkan produksi telur puyuh', 75000.00, 38, '2023-07-18 05:28:43', '2023-07-18 05:28:43'),
(6, 'NEW HOPE FEED P-100', 'pakan puyuh new hope p-100 untuk puyuh di bawah 7 minggu', 107000.00, 60, '2023-07-18 05:33:01', '2023-07-18 06:30:20'),
(7, 'NEW HOPE FEED P-500', 'pakan puyuh new hope feed p-500 untuk puyuh dewasa', 377500.00, 100, '2023-07-18 05:51:21', '2023-07-18 06:30:03'),
(8, 'NEW HOPE FEED P-800', 'pakan puyuh new hope feed p-800', 277500.00, 80, '2023-07-18 05:53:58', '2023-07-18 05:53:58'),
(10, 'NEW HOPE FEED Py 10', 'pakan anakan puyuh new hope feed py 10 untuk burung puyuh umur 1-6 minggu', 334000.00, 37, '2023-07-18 05:59:10', '2023-07-18 06:49:44'),
(11, 'Telur puyuh 1 kardus', 'telur puyuh 1 kardus berisi  750 butir telur', 230000.00, 6000, '2023-07-18 06:04:15', '2023-07-18 06:04:15'),
(12, 'Telur puyuh 1 tray', 'telur puyuh 1 tray berisi 900 butir telur', 276000.00, 7996, '2023-07-18 06:05:08', '2023-07-25 06:06:02'),
(13, 'Telur puyuh satuan', 'telur puyuh persatuan', 307.00, 8000, '2023-07-18 06:06:26', '2023-07-18 06:06:26'),
(14, 'nipple', 'nipple untuk alat minum burung puyuh', 7000.00, 300, '2023-07-18 06:15:53', '2023-07-18 06:15:53'),
(15, 'selang nipple 1 meter', 'selang nipple untuk alat minum burung puyuh', 3250.00, 255, '2023-07-18 06:17:56', '2023-07-18 06:17:56'),
(16, 'tempat makan puyuh', 'tempat makan puyuh 7 lubang', 17000.00, 299, '2023-07-18 06:20:34', '2023-07-18 06:27:50'),
(17, 'NEW HOPE FEED Py 100', 'pakan puyuh new hope py 100', 325000.00, 12, '2023-07-25 05:35:43', '2023-07-25 05:35:43'),
(18, 'puyuh usia 1 minggu', 'burung puyuh muda usia 1 minggu', 5000.00, 1000, '2023-07-25 05:40:11', '2023-07-25 05:40:11'),
(19, 'burung  puyuh usia 3 minggu', 'burung puyuh muda usia 3 minggu', 7000.00, 2000, '2023-07-25 05:41:36', '2023-07-25 05:41:36');

-- --------------------------------------------------------

--
-- Table structure for table `rekenings`
--

CREATE TABLE `rekenings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank` varchar(255) NOT NULL,
  `atas_nama` varchar(255) NOT NULL,
  `norek` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Pelanggan', NULL, NULL),
(2, 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2023-07-17 06:38:29', '2023-07-17 06:38:29'),
(2, 1, 2, '2023-07-17 07:28:31', '2023-07-17 07:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `social_media` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social_media`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `favicon`, `logo`, `description`, `email`, `phone`, `address`, `social_media`, `created_at`, `updated_at`) VALUES
(1, 'Arifin Puyuh', 'QA6RGrEuuiuVSaCtTTH6iZhQY5GuFDOgw4eHU7yg.png', 'Jq4DY9TIBqFX9nZh0WkMoQhR86ikZjk6cX1nAQwP.jpg', 'Menjual berbagai kebutuhan tentang peternakan Burung puyuh', 'arifinpuyuh@gmail.com', '08213837606', 'simo,boyolali', '\"{\\\"facebook\\\":null,\\\"instagram\\\":null}\"', '2023-07-17 06:38:29', '2023-07-25 06:15:06');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `judul`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'puyuh usia 1 minggu', 'burung puyuh muda usia 1 minggu', 'KGC0LsQ8EcX0wf4WzxAUfagtrdGSo5BLcqJhu7gB.jpg', '2023-07-25 05:58:11', '2023-07-25 05:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$oHYduy9E90MhF1d5r/GNb.vKTff1sMRMJDLpE65r1ZcBMB.TPdlKm', NULL, '2023-07-17 06:38:29', '2023-07-17 06:38:29'),
(2, 'heru bambang', 'heru123@gmai.com', NULL, '$2y$10$HwOxYhiX2T8DY4G/OYAnWeAg/eGCRLs5/pwBZ.GRtjbF3jSXSnjzC', NULL, '2023-07-17 07:28:31', '2023-07-17 07:28:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanans`
--
ALTER TABLE `detail_pesanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_pesanans_pesanan_id_foreign` (`pesanan_id`),
  ADD KEY `detail_pesanans_produk_id_foreign` (`produk_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `foto_produks`
--
ALTER TABLE `foto_produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foto_produks_produk_id_foreign` (`produk_id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_produks`
--
ALTER TABLE `kategori_produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_produks_kategori_id_foreign` (`kategori_id`),
  ADD KEY `kategori_produks_produk_id_foreign` (`produk_id`);

--
-- Indexes for table `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keranjangs_user_id_foreign` (`user_id`),
  ADD KEY `keranjangs_produk_id_foreign` (`produk_id`);

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
-- Indexes for table `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggans_user_id_foreign` (`user_id`);

--
-- Indexes for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayarans_user_id_foreign` (`user_id`),
  ADD KEY `pembayarans_pesanan_id_foreign` (`pesanan_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pesanans`
--
ALTER TABLE `pesanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanans_user_id_foreign` (`user_id`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekenings`
--
ALTER TABLE `rekenings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_users_role_id_foreign` (`role_id`),
  ADD KEY `role_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
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
-- AUTO_INCREMENT for table `detail_pesanans`
--
ALTER TABLE `detail_pesanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foto_produks`
--
ALTER TABLE `foto_produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori_produks`
--
ALTER TABLE `kategori_produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `keranjangs`
--
ALTER TABLE `keranjangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pelanggans`
--
ALTER TABLE `pelanggans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanans`
--
ALTER TABLE `pesanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `rekenings`
--
ALTER TABLE `rekenings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanans`
--
ALTER TABLE `detail_pesanans`
  ADD CONSTRAINT `detail_pesanans_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_pesanans_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `foto_produks`
--
ALTER TABLE `foto_produks`
  ADD CONSTRAINT `foto_produks_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kategori_produks`
--
ALTER TABLE `kategori_produks`
  ADD CONSTRAINT `kategori_produks_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kategori_produks_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD CONSTRAINT `keranjangs_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `keranjangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD CONSTRAINT `pelanggans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayarans_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembayarans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pesanans`
--
ALTER TABLE `pesanans`
  ADD CONSTRAINT `pesanans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
