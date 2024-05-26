-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 04:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_data` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('2e841f28491f4b7c492930fb6c09b8a1', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36', 1554634874, 'a:7:{s:9:\"user_data\";s:0:\"\";s:9:\"site_lang\";s:7:\"english\";s:7:\"user_id\";s:1:\"1\";s:8:\"username\";s:4:\"iiky\";s:6:\"status\";s:1:\"1\";s:5:\"roles\";a:1:{i:0;a:4:{s:7:\"role_id\";s:1:\"1\";s:4:\"role\";s:5:\"admin\";s:4:\"full\";s:13:\"Administrator\";s:7:\"default\";s:1:\"0\";}}s:12:\"user_profile\";a:13:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:16:\"Tintapuccino CMS\";s:6:\"gender\";s:1:\"m\";s:13:\"tanggal_lahir\";s:10:\"0000-00-00\";s:6:\"alamat\";s:0:\"\";s:4:\"kota\";s:0:\"\";s:12:\"tentang_saya\";s:0:\"\";s:4:\"foto\";s:12:\"no_image.jpg\";s:3:\"dob\";s:10:\"0000-00-00\";s:7:\"country\";s:0:\"\";s:8:\"timezone\";s:0:\"\";s:7:\"website\";s:0:\"\";s:8:\"modified\";s:19:\"2018-07-17 22:15:44\";}}');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `login` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `id_menu_parent` int(11) NOT NULL,
  `nama_menu` varchar(70) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `kategori` enum('Controller','Link') NOT NULL,
  `href` varchar(100) NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `sort` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `id_menu_parent`, `nama_menu`, `icon`, `kategori`, `href`, `status`, `sort`) VALUES
(2, 7, 'Pengaturan Pengguna', '', 'Controller', 'Usersmanagement', 'Y', '1'),
(3, 7, 'Pengaturan Hak Akses', '', 'Controller', 'Roles', 'Y', '1'),
(6, 7, 'Pengaturan Menu', '', 'Controller', 'Menu', 'Y', '2'),
(7, 0, 'Pengaturan', 'bx bxs-cog', 'Controller', '', 'Y', '6'),
(8, 7, 'Pengaturan Modul', '', 'Controller', 'Permission', 'Y', '3'),
(9, 0, 'Dashboard', 'bx bxs-dashboard', 'Controller', 'Dashboard', 'Y', '1'),
(10, 0, 'Pasien', 'bx bxs-heart', 'Controller', 'Pasien', 'Y', '1'),
(37, 0, 'Pengguna Web', 'bx bx-user', 'Controller', '', 'Y', '1'),
(39, 0, 'Pegawai', 'bx bx-group', 'Controller', 'Pegawai', 'Y', '2'),
(40, 0, 'Tindakan', 'bx bxs-hand', 'Controller', '', 'Y', '5'),
(41, 40, 'Kategori Tindakan', '', 'Controller', 'Pengaturan_Tindakan', 'Y', '1'),
(42, 40, 'Pengaturan Klinik', '', 'Controller', 'Pengaturan_Klinik', 'Y', '3'),
(43, 40, 'Tindakan', '', 'Controller', 'Tambah_Tindakan', 'Y', '2'),
(44, 0, 'Rekam Medis', 'bx bx-plus-medical', 'Controller', 'Rekam_Medis', 'Y', '3'),
(45, 0, 'Reservasi Jadwal', 'bx bxs-book-add', 'Controller', 'Reservasi', 'Y', '4');

-- --------------------------------------------------------

--
-- Table structure for table `overrides`
--

CREATE TABLE `overrides` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `permission_id` smallint(5) UNSIGNED NOT NULL,
  `allow` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` smallint(5) UNSIGNED NOT NULL,
  `permission` varchar(100) NOT NULL,
  `description` varchar(160) DEFAULT NULL,
  `parent` varchar(100) DEFAULT NULL,
  `sort` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `permission`, `description`, `parent`, `sort`) VALUES
(2, 'Menu', 'Menu Management', NULL, NULL),
(3, 'Permission', 'Permission Management', NULL, NULL),
(4, 'Roles', 'Role Management', NULL, NULL),
(5, 'Usersmanagement', 'User Management', NULL, NULL),
(6, 'Dashboard', 'Dashboard', NULL, NULL),
(7, 'Pegawai', 'Pegawai', NULL, NULL),
(8, 'Pasien', 'Pasien', NULL, NULL),
(9, 'Pengaturan_Tindakan', 'Pengaturan Tindakan', NULL, NULL),
(10, 'Pengaturan_Klinik', 'Pengaturan Klinik', NULL, NULL),
(11, 'Tambah_Tindakan', 'Tambah Tindakan', NULL, NULL),
(12, 'Rekam_Medis', 'Rekam Medis', NULL, NULL),
(13, 'Reservasi', 'Reservasi', NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `rekamedis_view`
-- (See below for the actual view)
--
CREATE TABLE `rekamedis_view` (
`id_rekamedis` int(10)
,`id_pasien` int(10)
,`pasien_name` varchar(255)
,`id_kategori_tindakan` int(10)
,`kategori_tindakan` varchar(255)
,`id_tindakan` int(10)
,`tindakan` text
,`subject` text
,`object` text
,`plan` text
,`gigi` varchar(128)
,`harga` varchar(128)
,`date` date
);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` tinyint(3) UNSIGNED NOT NULL,
  `role` varchar(50) NOT NULL,
  `full` varchar(50) NOT NULL,
  `default` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role`, `full`, `default`) VALUES
(1, 'Dokter', 'Dokter', 0),
(2, 'Pasien', 'Pasien', 1),
(3, 'Sup Admin', 'Super Admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` tinyint(3) UNSIGNED NOT NULL,
  `permission_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`role_id`, `permission_id`) VALUES
(0, 2),
(0, 3),
(0, 4),
(0, 5),
(0, 6),
(0, 0),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 11),
(1, 12),
(1, 13),
(2, 6),
(2, 12),
(2, 13);

-- --------------------------------------------------------

--
-- Table structure for table `tb_assesment`
--

CREATE TABLE `tb_assesment` (
  `id_assesment` int(10) NOT NULL,
  `id_users` int(10) NOT NULL,
  `id_rekammedis` int(10) NOT NULL,
  `id_kategori_tindakan` int(10) NOT NULL,
  `id_tindakan` int(10) NOT NULL,
  `gigi` int(10) NOT NULL,
  `harga` varchar(128) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_invoices`
--

CREATE TABLE `tb_invoices` (
  `id_invoice` int(11) NOT NULL,
  `id_rekamedis` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_tindakan`
--

CREATE TABLE `tb_kategori_tindakan` (
  `id_kategori_tindakan` int(10) NOT NULL,
  `kategori_tindakan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_kategori_tindakan`
--

INSERT INTO `tb_kategori_tindakan` (`id_kategori_tindakan`, `kategori_tindakan`) VALUES
(2, 'Pencegahan'),
(7, 'Perbaikan'),
(8, 'Perawatan Gusi'),
(9, 'Perawatan Akar Gigi'),
(10, 'Perawatan Ortodontik'),
(11, 'Estetika');

-- --------------------------------------------------------

--
-- Table structure for table `tb_klinik`
--

CREATE TABLE `tb_klinik` (
  `id_klinik` int(10) NOT NULL,
  `klinik` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_klinik`
--

INSERT INTO `tb_klinik` (`id_klinik`, `klinik`, `alamat`) VALUES
(1, 'Klinik Cibadak', 'JL Cibadak No.12 '),
(2, 'Rumah Sakit Lembang', 'Jl. Lembang no 23'),
(3, 'Rumah Sakit Bojongsoang', 'Jl. Bojongsoang No 45');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `id_pasien` int(11) NOT NULL,
  `id_klinik` int(11) NOT NULL,
  `kategori_pasien` enum('Umum','Orthodentist') NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nohp` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pasien`
--

INSERT INTO `tb_pasien` (`id_pasien`, `id_klinik`, `kategori_pasien`, `nama`, `alamat`, `nohp`, `jenis_kelamin`, `tanggal_lahir`) VALUES
(1, 1, 'Umum', 'Tes 1', 'Tes 1', '8123456789', 'P', '2024-05-01'),
(2, 1, 'Orthodentist', 'Tes 2', 'Tes 2', '08987654321', 'W', '2024-05-13'),
(3, 2, 'Umum', 'Tes 3', 'Tes 3', '08123456789', 'P', '2024-05-02'),
(4, 2, 'Orthodentist', 'Tes 4', 'Tes 4', '08987654321', 'W', '2024-05-04'),
(5, 3, 'Umum', 'Tes 5', 'Tes 5', '08123456789', 'P', '2024-05-05'),
(6, 3, 'Orthodentist', 'Tes 6', 'Tes 6', '08987654321', 'W', '2024-05-06'),
(7, 3, 'Umum', 'Tes 7', 'Tes 7', '0987654321', 'P', '2024-05-07'),
(8, 1, 'Umum', 'Tes 8', 'Tes 8', '08231456789', 'W', '2024-05-08'),
(9, 2, 'Umum', 'Tes 9', 'Tes 9', '08123456789', 'P', '2024-05-09'),
(10, 3, 'Orthodentist', 'Tes 10', 'Tes 10', '08987654321', 'W', '2024-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rekamedis`
--

CREATE TABLE `tb_rekamedis` (
  `id_rekamedis` int(10) NOT NULL,
  `id_pasien` int(10) NOT NULL,
  `id_kategori_tindakan` int(10) NOT NULL,
  `id_tindakan` int(10) NOT NULL,
  `subject` text DEFAULT NULL,
  `object` text DEFAULT NULL,
  `plan` text DEFAULT NULL,
  `gigi` varchar(128) NOT NULL,
  `harga` varchar(128) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rekamedis`
--

INSERT INTO `tb_rekamedis` (`id_rekamedis`, `id_pasien`, `id_kategori_tindakan`, `id_tindakan`, `subject`, `object`, `plan`, `gigi`, `harga`, `date`) VALUES
(1, 3, 7, 3, 'Wahh giginya perlu dicabut nihh', 'Wahh giginya perlu dicabut nihh', 'Wahh giginya perlu dicabut nihh', '20', '900000', '2024-05-23'),
(2, 3, 0, 0, 'tes', 'tes', 'tes', '34', '9000', '2024-05-25'),
(3, 4, 2, 1, 'coba', 'coba', 'coba', '34', '90000', '2024-05-25'),
(4, 3, 8, 5, 'coba', 'coba', 'coba', '34', '900000', '2024-05-25'),
(5, 3, 10, 1, 'coba', 'coba', 'coba', '35', '800000000', '2024-05-25'),
(6, 7, 7, 1, 'Cenat cenut gigi na', 'ditemukan bolong pada gigi na', 'tambal broo', '34', '2000000', '2024-05-25'),
(7, 7, 7, 3, 'Cenat cenut gigi na', 'ditemukan bolong pada gigi na', 'tambal broo', '34', '800000', '2024-05-25'),
(8, 5, 7, 2, 'Nyeri mau die', 'wahh ternyata bolong nihh gigi lu puki', 'cabut gigi', '27', '500000', '2024-05-25'),
(9, 5, 7, 3, 'Nyeri mau die', 'wahh ternyata bolong nihh gigi lu puki', 'cabut gigi', '27', '700000', '2024-05-25'),
(10, 5, 2, 2, 'Nyeri mau die', 'wahh ternyata bolong nihh gigi lu puki', 'cabut gigi', '17', '200000', '2024-05-25'),
(11, 4, 7, 1, 'coba', 'coba', 'coba', '34', '8000000', '2024-05-25');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tindakan`
--

CREATE TABLE `tb_tindakan` (
  `id_tindakan` int(10) NOT NULL,
  `id_kategori_tindakan` int(10) NOT NULL,
  `tindakan` text NOT NULL,
  `harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_tindakan`
--

INSERT INTO `tb_tindakan` (`id_tindakan`, `id_kategori_tindakan`, `tindakan`, `harga`) VALUES
(1, 2, 'Pemeriksaan Rutin', '700000'),
(2, 2, 'Pembersihan Gigi', '900000'),
(3, 7, 'Penambalan Gigi', '1200000'),
(4, 7, 'Mahkota', '1000000'),
(5, 7, 'Bridges', '1500000'),
(6, 7, 'Implan', '2000000'),
(7, 7, 'Dentures', '3000000'),
(8, 8, 'Scaling dan Root Planing', '600000'),
(9, 8, 'Perawatan Periodontal Lanjutan', '1400000'),
(10, 9, 'Pengobatan Saluran Akar', '2500000'),
(11, 10, 'Pemasangan Kawat Gigi', '5000000'),
(12, 10, 'Pemakaian Alat Ortodontik Lainnya', '3000000'),
(13, 11, 'Pemutihan Gigi', '1500000'),
(14, 11, 'Veneer', '700000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_klinik` int(10) NOT NULL,
  `kategori_pasien` enum('Umum','Orthodentist') NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nohp` varchar(50) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT 1,
  `banned` tinyint(1) NOT NULL DEFAULT 0,
  `ban_reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` char(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `approved` tinyint(1) DEFAULT NULL COMMENT 'For acct approval.',
  `meta` varchar(2000) DEFAULT '',
  `last_ip` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_klinik`, `kategori_pasien`, `username`, `password`, `email`, `nohp`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `approved`, `meta`, `last_ip`, `last_login`, `created`, `modified`) VALUES
(1, 0, '', 'admin', '$2a$10$gtANPNMiG2UEL9fPbbJaBOKY1juVGP8PhYCKJWuV6yYIuz29qJF7W', 'defansyahputra@gmail.com', '', NULL, '', '', 1, 0, NULL, NULL, NULL, NULL, NULL, 1, 'a:2:{s:4:\"foto\";s:13:\"62c4714b325a0\";s:4:\"name\";s:11:\"Raihan Arif\";}', '::1', '2024-03-08 11:36:07', '2022-07-05 19:13:47', '2024-03-15 06:13:34'),
(2, 0, '', 'sup_admin', '$2a$10$.45q.HlDPIiFaaILIMJfHe7YXmqSKqB8AtZXlplDZgWLqTeBszIzu', 'khuzen.ard@gmail.com', '', NULL, '', '', 1, 0, NULL, NULL, NULL, NULL, NULL, 1, 'a:2:{s:4:\"foto\";s:13:\"65d085a3965ff\";s:4:\"name\";s:20:\"Khuzainil Ardiansyah\";}', '::1', '2024-05-26 04:23:12', '2024-02-17 11:08:35', '2024-05-26 02:23:12'),
(3, 1, 'Umum', 'JohnDoe', '$2a$10$EdqClq.6p6WLn28DWn.s/ORI7z1bq4L257o0GVzqO79ANNpAbC/1W', 'JohnDoe@gmail.com', '6281234567890', '1999-05-15', 'P', '123 Main Street, Anytown', 1, 0, NULL, NULL, NULL, NULL, NULL, 1, 'a:2:{s:4:\"foto\";s:13:\"664f4878f33b7\";s:4:\"name\";s:8:\"John Doe\";}', '::1', '0000-00-00 00:00:00', '2024-05-23 15:45:29', '2024-05-23 13:45:29'),
(4, 1, 'Orthodentist', 'JaneSmith', '$2a$10$6p8aYKt9SKw8Oh6S.W8zOe9GswxPrLljEePzELDqIWCN0kFZBGtVi', 'JaneSmith@gmail.com', '6282345678901', '1985-10-25', 'W', '456 Oak Avenue, Somewhereville', 1, 0, NULL, NULL, NULL, NULL, NULL, 1, 'a:2:{s:4:\"foto\";s:13:\"664f48b4d9723\";s:4:\"name\";s:10:\"Jane Smith\";}', '::1', '0000-00-00 00:00:00', '2024-05-23 15:46:28', '2024-05-23 13:46:28'),
(5, 2, 'Umum', 'AhmadRahman', '$2a$10$KvFX4NUmjTVHn4I5pbdZMesrE0ij5Afecu2.NEio4ZUGsoEUh7i5S', 'AhmadRahman@gmail.com', '6283456789012', '1995-02-08', 'P', '789 Elm Road, Elsewhere City', 1, 0, NULL, NULL, NULL, NULL, NULL, 1, 'a:2:{s:4:\"foto\";s:13:\"664f4903327d6\";s:4:\"name\";s:12:\"Ahmad Rahman\";}', '::1', '0000-00-00 00:00:00', '2024-05-23 15:47:47', '2024-05-23 13:47:47'),
(6, 2, 'Orthodentist', 'MariaGarcia', '$2a$10$S13cTpWdwoNk75x.w5Rk8OmhZB71HkCsSvotJkzc0BoSBxnfaPeJS', 'MariaGarcia@gmail.com', '6284567890123', '1988-12-30', 'W', '321 Pine Boulevard, Nowhere Town', 1, 0, NULL, NULL, NULL, NULL, NULL, 1, 'a:2:{s:4:\"foto\";s:13:\"664f4944c8a3f\";s:4:\"name\";s:12:\"Maria Garcia\";}', '::1', '0000-00-00 00:00:00', '2024-05-23 15:48:52', '2024-05-23 13:48:52'),
(7, 3, 'Umum', 'ChenWei', '$2a$10$V06Mp9ghHCawofS9LkOY8ucjKIB1fZ4lwHFt/2CV0IOfcyz/fEnVO', 'ChenWei@gmail.com', '6285678901234', '1992-07-18', 'P', '654 Cedar Lane, Anyplace', 1, 0, NULL, NULL, NULL, NULL, NULL, 1, 'a:2:{s:4:\"foto\";s:13:\"664f49838fcf5\";s:4:\"name\";s:8:\"Chen Wei\";}', '::1', '0000-00-00 00:00:00', '2024-05-23 15:49:55', '2024-05-23 13:49:55'),
(9, 3, 'Orthodentist', 'pasien', '$2a$10$Suj22l9pQyqFvV1dRWyTZO8x6f4j/.rt1rxQocSmeF2VuGNL8Ixae', 'pasien@gmail.com', '0987654321', '2024-05-04', 'P', 'pasien', 1, 0, NULL, NULL, NULL, NULL, NULL, 1, 'a:2:{s:4:\"foto\";s:13:\"665234093c0e7\";s:4:\"name\";s:6:\"Pasien\";}', '::1', '2024-05-25 20:55:21', '2024-05-25 20:55:05', '2024-05-25 18:55:21'),
(10, 0, '', 'dokter', '$2a$10$5V5SHcT2adQ7EvBsWxqdJuiDSTSUNmrG6cfL3lhsrvcmS0LFftgK.', 'dokter@gmail.com', '0987654321', '2024-05-15', 'P', 'dokter', 1, 0, NULL, NULL, NULL, NULL, NULL, 1, 'a:2:{s:4:\"foto\";s:13:\"665234f6e057b\";s:4:\"name\";s:6:\"Dokter\";}', '::1', '2024-05-25 21:01:07', '2024-05-25 20:59:02', '2024-05-25 19:01:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE `user_autologin` (
  `key_id` char(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_agent` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user_autologin`
--

INSERT INTO `user_autologin` (`key_id`, `user_id`, `user_agent`, `last_ip`, `last_login`) VALUES
('bbecaa5ab748280b48db65737ee04f49', 7, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.51 Safari/537.36', '172.16.10.1', '2022-03-13 16:25:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT '',
  `foto` varchar(30) NOT NULL DEFAULT 'no_image.jpg',
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `name`, `foto`, `modified`) VALUES
(1, 'Defan Syahputra', '62c4714b325a0', '2024-03-15 08:25:53'),
(2, 'Hari dhova', '65d085a3965ff', '2024-03-15 08:26:04'),
(3, 'John Doe', '664f4878f33b7', '2024-05-23 13:45:29'),
(4, 'Jane Smith', '664f48b4d9723', '2024-05-23 13:46:29'),
(5, 'Ahmad Rahman', '664f4903327d6', '2024-05-23 13:47:47'),
(6, 'Maria Garcia', '664f4944c8a3f', '2024-05-23 13:48:52'),
(7, 'Chen Wei', '664f49838fcf5', '2024-05-23 13:49:55'),
(9, 'Pasien', '665234093c0e7', '2024-05-25 18:55:05'),
(10, 'Dokter', '665234f6e057b', '2024-05-25 18:59:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 3),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(9, 2),
(10, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_tindakan`
-- (See below for the actual view)
--
CREATE TABLE `view_tindakan` (
`id_tindakan` int(10)
,`id_kategori_tindakan` int(10)
,`kategori_tindakan` varchar(255)
,`tindakan` text
,`harga` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `rekamedis_view`
--
DROP TABLE IF EXISTS `rekamedis_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rekamedis_view`  AS SELECT `r`.`id_rekamedis` AS `id_rekamedis`, `r`.`id_pasien` AS `id_pasien`, `u`.`name` AS `pasien_name`, `r`.`id_kategori_tindakan` AS `id_kategori_tindakan`, `kt`.`kategori_tindakan` AS `kategori_tindakan`, `r`.`id_tindakan` AS `id_tindakan`, `t`.`tindakan` AS `tindakan`, `r`.`subject` AS `subject`, `r`.`object` AS `object`, `r`.`plan` AS `plan`, `r`.`gigi` AS `gigi`, `r`.`harga` AS `harga`, `r`.`date` AS `date` FROM (((`tb_rekamedis` `r` join `user_profiles` `u` on(`r`.`id_pasien` = `u`.`id`)) join `tb_kategori_tindakan` `kt` on(`r`.`id_kategori_tindakan` = `kt`.`id_kategori_tindakan`)) join `tb_tindakan` `t` on(`r`.`id_tindakan` = `t`.`id_tindakan`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_tindakan`
--
DROP TABLE IF EXISTS `view_tindakan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_tindakan`  AS SELECT `t`.`id_tindakan` AS `id_tindakan`, `t`.`id_kategori_tindakan` AS `id_kategori_tindakan`, `kt`.`kategori_tindakan` AS `kategori_tindakan`, `t`.`tindakan` AS `tindakan`, `t`.`harga` AS `harga` FROM (`tb_tindakan` `t` join `tb_kategori_tindakan` `kt` on(`t`.`id_kategori_tindakan` = `kt`.`id_kategori_tindakan`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`) USING BTREE;

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tb_assesment`
--
ALTER TABLE `tb_assesment`
  ADD PRIMARY KEY (`id_assesment`);

--
-- Indexes for table `tb_invoices`
--
ALTER TABLE `tb_invoices`
  ADD PRIMARY KEY (`id_invoice`),
  ADD KEY `id_rekamedis` (`id_rekamedis`);

--
-- Indexes for table `tb_kategori_tindakan`
--
ALTER TABLE `tb_kategori_tindakan`
  ADD PRIMARY KEY (`id_kategori_tindakan`);

--
-- Indexes for table `tb_klinik`
--
ALTER TABLE `tb_klinik`
  ADD PRIMARY KEY (`id_klinik`);

--
-- Indexes for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `tb_rekamedis`
--
ALTER TABLE `tb_rekamedis`
  ADD PRIMARY KEY (`id_rekamedis`);

--
-- Indexes for table `tb_tindakan`
--
ALTER TABLE `tb_tindakan`
  ADD PRIMARY KEY (`id_tindakan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_assesment`
--
ALTER TABLE `tb_assesment`
  MODIFY `id_assesment` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kategori_tindakan`
--
ALTER TABLE `tb_kategori_tindakan`
  MODIFY `id_kategori_tindakan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_klinik`
--
ALTER TABLE `tb_klinik`
  MODIFY `id_klinik` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_rekamedis`
--
ALTER TABLE `tb_rekamedis`
  MODIFY `id_rekamedis` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_tindakan`
--
ALTER TABLE `tb_tindakan`
  MODIFY `id_tindakan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
