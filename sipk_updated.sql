-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2023 at 07:19 AM
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
-- Database: `sipk`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnis`
--

CREATE TABLE `alumnis` (
  `id_alumni` bigint(20) UNSIGNED NOT NULL,
  `pencari_kerja_id` varchar(254) NOT NULL,
  `bkk_id` int(11) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `tahun_lulus` varchar(255) NOT NULL,
  `status_bekerja` varchar(254) NOT NULL,
  `tempat_kerja` varchar(254) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alumnis`
--

INSERT INTO `alumnis` (`id_alumni`, `pencari_kerja_id`, `bkk_id`, `jurusan`, `tahun_lulus`, `status_bekerja`, `tempat_kerja`, `created_at`, `updated_at`) VALUES
(1, 'danar@gmail.com', 1, 'Teknik Kimia Industri', 'Tahun 2020', 'Sudah Bekerja', 'PT. Sejahtera Jujuhan Abadi', '2023-08-24 02:53:25', '2023-08-26 06:00:34'),
(2, 'jamhur@gmail.com', 2, 'Teknik Audio dan Video', 'Tahun 2021', '-', '-', '2023-08-25 01:41:21', '2023-08-25 01:41:21'),
(3, 'wery@gmail.com', 1, 'Teknik Kimia Industri', 'Tahun 2021', 'Sudah Bekerja', 'PT. Incasi Raya', '2023-08-25 23:11:08', '2023-08-25 23:11:08'),
(5, 'handijaya@gmail.com', 1, 'Teknik Kimia Industri', 'Tahun 2021', 'Sudah Bekerja', 'PT. Incasi Raya', '2023-08-25 23:24:12', '2023-08-25 23:24:12'),
(7, 'herman@gmail.com', 3, 'Administrasi Perkantoran', 'Tahun 2021', 'Sudah Bekerja', 'PT DSL', '2023-10-04 05:11:59', '2023-10-07 05:08:40');

-- --------------------------------------------------------

--
-- Table structure for table `bursa_kerjas`
--

CREATE TABLE `bursa_kerjas` (
  `id_bkk` bigint(20) UNSIGNED NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `email_sekolah` varchar(255) NOT NULL,
  `website_sekolah` varchar(255) NOT NULL,
  `instagram_sekolah` varchar(255) NOT NULL,
  `facebook_sekolah` varchar(255) NOT NULL,
  `telepon_sekolah` varchar(255) NOT NULL,
  `alamat_sekolah` varchar(255) NOT NULL,
  `foto_sekolah` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bursa_kerjas`
--

INSERT INTO `bursa_kerjas` (`id_bkk`, `nama_sekolah`, `email_sekolah`, `website_sekolah`, `instagram_sekolah`, `facebook_sekolah`, `telepon_sekolah`, `alamat_sekolah`, `foto_sekolah`, `created_at`, `updated_at`) VALUES
(1, 'SMKN 1 Koto Besar', 'smkn1kobes@gmail.com', '-', '-', '-', '-', '-', 'default.jpg', '2023-08-23 23:08:57', '2023-08-23 23:08:57'),
(2, 'SMKN 1 Sungai Rumbai', 'smkn1sungairumba@gmail.com', '-', '-', 'smkn1sungairumbaiofficial', '-', '-', '5kuOi23xLE5duE9OGtSEBsLrkArUtc3kMxzGMavT.jpg', '2023-08-25 01:23:19', '2023-08-25 02:21:06'),
(3, 'SMKN 1 Koto Baru', 'smkn1kobar@gmail.com', '-', '-', '-', '-', '-', 'default.jpg', '2023-10-06 06:24:45', '2023-10-06 06:24:45');

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
-- Table structure for table `informasi_lowongans`
--

CREATE TABLE `informasi_lowongans` (
  `id_informasi_lowongan` bigint(20) UNSIGNED NOT NULL,
  `pemberi_informasi_id` bigint(20) UNSIGNED NOT NULL,
  `judul_lowongan` varchar(255) NOT NULL,
  `perusahaan` varchar(254) NOT NULL,
  `salary` varchar(255) NOT NULL,
  `bidang` varchar(255) NOT NULL,
  `jurusan` varchar(254) NOT NULL,
  `jenis_lowongan` varchar(255) NOT NULL,
  `pendidikan` varchar(255) NOT NULL,
  `pengalaman` varchar(255) NOT NULL,
  `keterampilan` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `deskripsi` text NOT NULL,
  `verifikasi` text NOT NULL,
  `status_lowongan` int(11) NOT NULL,
  `lokasi` text NOT NULL,
  `tgl_buka` date NOT NULL,
  `tgl_tutup` date NOT NULL,
  `foto_lowongan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `informasi_lowongans`
--

INSERT INTO `informasi_lowongans` (`id_informasi_lowongan`, `pemberi_informasi_id`, `judul_lowongan`, `perusahaan`, `salary`, `bidang`, `jurusan`, `jenis_lowongan`, `pendidikan`, `pengalaman`, `keterampilan`, `jenis_kelamin`, `deskripsi`, `verifikasi`, `status_lowongan`, `lokasi`, `tgl_buka`, `tgl_tutup`, `foto_lowongan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 8, 'UI/UX', 'Technolgy System', '1.200.000', 'Desainer', '', 'Full Time', 'SMK - S1', '0-1 Tahun', 'Figma, Adobe Ilustrator dan sejenisnya', 'Laki-laki', '<p><strong>Lorem, ipsum dolor</strong> sit amet consectetur adipisicing elit. Ad illum aperiam cum quasi impedit dolorum reiciendis suscipit obcaecati, ex <strong>temporibus</strong> est dicta totam, <em>cumque sint fuga</em>,<strong> ratione ullam. Laboriosam, recusandae</strong>.</p>', '2', 0, 'Jl. Ujung Gurun No.7, Ujung Gurun, Padang Barat, Padang City, West Sumatra', '0000-00-00', '0000-00-00', 'default.jpg', '2022-08-17 03:15:02', '2023-10-08 20:20:20', NULL),
(2, 7, 'Back End Developer', 'Tech Technology', '1.200.000', 'Programmer', '', 'Full Time', 'SMK - S1', '0-1 Tahun', 'PHP, MySQL, Framework (Laravel/Codeiginter)', 'Perempuan', '<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad illum aperiam cum quasi impedit dolorum reiciendis suscipit obcaecati, ex temporibus est dicta totam, cumque sint fuga, ratione ullam. Laboriosam, recusandae.</p>', '0', 1, 'Jl. Ujung Gurun No.7, Ujung Gurun, Jakarta Barat', '0000-00-00', '0000-00-00', '1ey2HwT3YSolz7EMypoiVKYu3q1DcPH2aod91RCt.jpg', '2023-08-17 03:15:02', '2023-09-25 20:06:13', NULL),
(3, 9, 'Designer UX UI', 'Technolgy System', '1 - 2 Juta', 'Jasa', '', 'Full Time', 'S1 - Desain Komunikasi Visual', '0 - 1 Tahun', 'Coreldraw, Adobe Photoshop', 'Laki-laki', 'Lorem Ipsum', '1', 1, 'Belum dilengkapi', '2023-08-15', '2023-08-31', 'CnQWG0AKFCX0uJMppCZYU8pSeQfJMBGNjQSfs5D0.jpg', '2023-08-17 08:05:02', '2023-10-06 06:51:19', NULL),
(5, 13, 'Transportasi & Logistik', 'PT Pertamina', '3 - 5 Juta', 'Operator', '', 'Full Time', 'SMK, S1, atau S2', '0 - 1 Tahun', 'Ms. Office', 'Perempuan', 'Silahkan lengkapi pada menu data lowongan', '1', 0, 'Penempatan sesuai domisili cabang PT Pertamina', '2023-08-23', '2023-09-01', 'wxLTVLg9YPSudztJuvpp0hFmgNJAZbQOa6gIV8g3.jpg', '2023-08-23 00:05:06', '2023-09-11 07:55:15', '2023-09-11 07:55:15'),
(6, 13, 'Pegawai Penggabungan PTS', 'Sekolah Tinggi Ilmu Kesehatan Indonesia Maju', '1 - 2 Juta', 'Jasa', 'Administrasi Perkantoran', 'Full Time', 'SMK, S1, atau S2', '0 - 1 Tahun', 'Ms. Office', 'Laki-laki', '-', '0', 0, 'Yogyakarta', '2023-09-05', '2023-09-30', 'Dzk2AjwARVs8zUBIruSdljh9JTjoLDSxdNSNIpEf.jpg', '2022-09-05 07:16:03', '2023-10-07 07:12:17', '2023-10-07 07:12:17'),
(7, 13, 'Admin pemasaran', 'Caffe nury', '1 - 2 Juta', 'Pegawai', 'Administrasi Perkantoran', 'Part Time', 'SMK, S1, atau S2', '0 - 1 Tahun', 'Ms. Office', 'Perempuan', '-', '0', 0, 'Padang', '2023-10-05', '2023-10-31', 'nexEsdwYeQoUBkaAPPFmOcmOxlMarBVG4T8GT6Jn.jpg', '2023-10-04 18:36:21', '2023-10-04 18:36:21', NULL),
(8, 18, 'Admin timbangan', 'PT DSL', '1 - 2 Juta', 'Pegawai', 'Administrasi Perkantoran', 'Full Time', 'SMK, S1, atau S2', '0 - 1 Tahun', 'Ms. Office', 'Perempuan', '<p>Dibutuhkan Admin Timbangan</p>\r\n\r\n<p><strong>Pendidikan minimal</strong></p>\r\n\r\n<p>SMK/MA/Setara, S1, atau S2</p>\r\n\r\n<p><strong>Pengalaman</strong></p>\r\n\r\n<p>Pernah menggunakan Ms. Office</p>\r\n\r\n<p><strong>Penempatan</strong></p>\r\n\r\n<p>Koto Baru, Kec. Koto Baru, Kabupaten Dharmasraya, Sumatera Barat</p>', '0', 0, 'Dharmasraya', '2023-10-06', '2023-10-31', 'dinkEozL31F2pszXcihL60A28wc0JCb2N4gnVQ53.jpg', '2023-10-06 06:13:44', '2023-10-06 06:21:46', NULL),
(9, 13, 'Admin pemasaran', 'UX UI Edu', '1 - 2 Juta', 'Pegawai', 'Administrasi Perkantoran', 'Full Time', 'SMK, S1, atau S2', '0 - 1 Tahun', 'Ms. Office', 'Laki-laki', '-', '0', 0, 'padang', '2023-10-09', '2023-10-31', 'RmMP6lFY8mxZkqyf60QZWnWvcasRRbn2TGGZ9Ym9.png', '2023-10-08 20:41:22', '2023-10-08 20:41:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lamars`
--

CREATE TABLE `lamars` (
  `id_lamar` bigint(20) UNSIGNED NOT NULL,
  `id_informasi` varchar(255) NOT NULL,
  `id_pelamar` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lamars`
--

INSERT INTO `lamars` (`id_lamar`, `id_informasi`, `id_pelamar`, `pesan`, `status`, `created_at`, `updated_at`) VALUES
(1, '2', 'danar@gmail.com', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', 2, '2023-08-18 07:56:55', '2023-09-25 20:06:13'),
(2, '1', 'danar@gmail.com', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', 0, '2023-08-18 08:07:30', '2023-08-18 08:07:30'),
(3, '3', 'jamhur@gmail.com', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', 2, '2023-08-18 08:20:34', '2023-10-06 06:51:19'),
(4, '2', 'wery@gmail.com', '<p><strong>Lorem ipsum dolor sit amet</strong>, consectetur <em>adipiscing elit</em>, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', 0, '2023-08-19 00:12:26', '2023-08-19 00:12:26'),
(5, '6', 'herman@gmail.com', '<p>Saya<strong> sangat menyukai bidang admin</strong>, sehingga saya sangat merasa cocok dengan lowongan ini.</p>', 0, '2023-10-04 05:11:20', '2023-10-04 05:11:20');

-- --------------------------------------------------------

--
-- Table structure for table `laporans`
--

CREATE TABLE `laporans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start_age` varchar(11) NOT NULL,
  `end_age` varchar(11) NOT NULL,
  `male_count_terdaftar` int(11) NOT NULL,
  `female_count_terdaftar` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporans`
--

INSERT INTO `laporans` (`id`, `start_age`, `end_age`, `male_count_terdaftar`, `female_count_terdaftar`, `created_at`, `updated_at`) VALUES
(1, '15', '19', 0, 0, '2023-09-19 23:20:07', '2023-09-20 00:09:52'),
(2, '20', '29', 0, 1, '2023-09-19 23:20:07', '2023-10-08 20:22:55'),
(3, '30', '44', 0, 0, '2023-09-19 23:20:07', '2023-10-08 20:22:55'),
(4, '45', '54', 0, 0, '2023-09-19 23:20:07', '2023-09-19 23:20:07'),
(5, '55', '+', 0, 0, '2023-09-19 23:21:02', '2023-09-19 23:21:02');

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
(5, '2023_07_20_030428_create_pencari_kerjas_table', 1),
(6, '2023_07_29_143217_create_informasi_lowongans_table', 1),
(7, '2023_08_14_062040_create_pemberi_informasis_table', 1),
(8, '2023_08_16_135353_create_lamars_table', 1),
(9, '2023_08_23_032043_create_sumbers_table', 2),
(10, '2023_08_23_032455_create_pemangku_kepentingans_table', 3),
(11, '2023_08_23_130906_create_bkks_table', 4),
(12, '2023_08_23_130906_create_bursa_kerjas_table', 5),
(13, '2023_08_24_055829_create_alumnis_table', 6),
(14, '2023_09_11_143207_tambah_softdeletes', 7),
(15, '2023_09_11_145134_tambah_ipk_softdeletes', 8),
(16, '2023_09_20_031748_create_laporans_table', 9),
(17, '2023_09_20_061056_create_laporans_table', 10);

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
-- Table structure for table `pemangku_kepentingans`
--

CREATE TABLE `pemangku_kepentingans` (
  `id_pemangku_kepentingan` bigint(20) UNSIGNED NOT NULL,
  `nama_lembaga` varchar(255) NOT NULL,
  `bidang_lembaga` varchar(255) NOT NULL,
  `email_lembaga` varchar(255) NOT NULL,
  `website_lembaga` varchar(255) NOT NULL,
  `instagram_lembaga` varchar(255) NOT NULL,
  `facebook_lembaga` varchar(255) NOT NULL,
  `telepon_lembaga` varchar(255) NOT NULL,
  `alamat_lembaga` varchar(255) NOT NULL,
  `foto_lembaga` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemangku_kepentingans`
--

INSERT INTO `pemangku_kepentingans` (`id_pemangku_kepentingan`, `nama_lembaga`, `bidang_lembaga`, `email_lembaga`, `website_lembaga`, `instagram_lembaga`, `facebook_lembaga`, `telepon_lembaga`, `alamat_lembaga`, `foto_lembaga`, `created_at`, `updated_at`) VALUES
(1, 'Dinas Tenaga Kerja Sumbar', 'Tenaga kerja dan transmigrasi', 'disnaker@gmail.com', 'https://nakertrans.sumbarprov.go.id/', '-', '-', '075127417', 'Jl. Ujung Gurun No.7, Ujung Gurun, Kec. Padang Bar., Kota Padang, Sumatera Barat 25114', 'n4ljLrkxmqo3hyc4XcyNNcYcWa7AJRhqwIXFCcH1.png', '2023-08-26 07:12:09', '2023-10-04 05:25:41'),
(2, 'Dinas Pendidikan Sumbar', 'Pendidikan', 'disdiksumbar@gmail.com', '-', '-', '-', '-', '-', 'default.jpg', '2023-10-04 18:58:52', '2023-10-09 22:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `pemberi_informasis`
--

CREATE TABLE `pemberi_informasis` (
  `id_pemberi_informasi` bigint(20) UNSIGNED NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `bidang_instansi` varchar(255) NOT NULL,
  `email_instansi` varchar(255) NOT NULL,
  `website_instansi` varchar(255) NOT NULL,
  `instagram_instansi` varchar(255) NOT NULL,
  `facebook_instansi` varchar(255) NOT NULL,
  `telepon_instansi` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto_instansi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemberi_informasis`
--

INSERT INTO `pemberi_informasis` (`id_pemberi_informasi`, `nama_instansi`, `bidang_instansi`, `email_instansi`, `website_instansi`, `instagram_instansi`, `facebook_instansi`, `telepon_instansi`, `alamat`, `deskripsi`, `foto_instansi`, `created_at`, `updated_at`) VALUES
(1, 'Tech Tecnology', '-', 'tech@gmail.com', '-', '-', '-', '-', '-', '-', 'default.jpg', '2023-08-17 16:16:48', '2023-08-17 16:16:48'),
(2, 'Technolgy System', '-', 'technosystem@gmail.com', '-', '-', '-', '-', '-', '-', 'default.jpg', '2023-08-17 16:17:39', '2023-08-17 16:17:39'),
(3, 'Percetakan Abdi', '-', 'abdipercetakan@gmail.com', '-', '-', '-', '-', '-', '<p>-</p>', '9n6qjsKuMX8Uz7bI5RwGcab2taIgSxlw3tpO9I2v.jpg', '2023-08-17 16:18:12', '2023-08-22 07:30:57'),
(4, 'PT. DSL', 'Pengolahan CPO', 'dsl@gmail.com', 'dharmasrayasawitlestari.com', '-', '-', '-', 'Jl. Koto, Koto Salak, Kec. Koto Baru, Kabupaten Dharmasraya, Sumatera Barat', '<p>PT. Damasraya Sawit Lestari memperoleh Izin Lokasi untuk pembangunan pabrik minyak kelapa sawit berdasarkan Surat Keputusan Bupati Dharmasraya <strong>No.189.1/238/KPTS-BUP/2012</strong> dengan luasan&nbsp; 219.700 M2 pada tanggal 16 Juli 2012.</p>', 'KsQiUn34KqY5QKuMvmUDX9cKlaRM7PqMgspgJbPA.jpg', '2023-10-06 06:00:59', '2023-10-06 06:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `pencari_kerjas`
--

CREATE TABLE `pencari_kerjas` (
  `id_pencari_kerja` bigint(20) UNSIGNED NOT NULL,
  `bkk_id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email_pk` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `umur` int(11) NOT NULL,
  `jenis_kelamin` varchar(32) NOT NULL,
  `pendidikan_terakhir` varchar(255) NOT NULL,
  `keterampilan` text NOT NULL,
  `no_hp` text NOT NULL,
  `tentang` text NOT NULL,
  `tgl_expired` date DEFAULT NULL,
  `status_ak1` varchar(254) NOT NULL,
  `foto_pencari_kerja` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pencari_kerjas`
--

INSERT INTO `pencari_kerjas` (`id_pencari_kerja`, `bkk_id`, `nama_lengkap`, `email_pk`, `alamat`, `umur`, `jenis_kelamin`, `pendidikan_terakhir`, `keterampilan`, `no_hp`, `tentang`, `tgl_expired`, `status_ak1`, `foto_pencari_kerja`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 'Danar', 'danar@gmail.com', 'Dharmasraya', 16, 'Laki-laki', 'Sekolah Menengah Kejuruan', 'Desain Grafis', '081277265590', 'Saya menyukai dunia desain', '2023-09-01', 'Bekerja', 'xLNUd15Wgr5COcumHWf9vtSLI0TKUhM6XbXRxkOL.jpg', '2023-08-17 16:03:39', '2023-09-10 20:34:17', NULL),
(3, 1, 'Werry', 'wery@gmail.com', '0', 18, 'Perempuan', '0', '0', '0', '0', NULL, 'Belum Bekerja', 'default.jpg', '2023-05-17 16:04:20', '2023-09-19 23:55:14', '2023-09-19 23:55:14'),
(4, 2, 'Jamhur', 'jamhur@gmail.com', '0', 30, 'Perempuan', '0', '0', '0', '0', NULL, 'Belum Bekerja', 'default.jpg', '2023-08-17 16:05:06', '2023-08-25 01:41:21', NULL),
(6, 0, 'Handijaya', 'handijaya@gmail.com', '-', 20, 'Perempuan', '-', '-', '-', '-', '2024-03-19', 'Belum Bekerja', 'default.jpg', '2022-09-19 15:59:21', '2023-10-07 07:16:08', '2023-10-07 07:16:08'),
(7, 0, 'Febri restu', 'febri@gmail.com', '-', 25, 'Laki-laki', '-', '-', '-', '-', '2024-03-19', 'Belum Bekerja', 'default.jpg', '2023-09-19 16:05:13', '2023-09-19 16:05:13', NULL),
(8, 3, 'Hermansyah', 'herman@gmail.com', 'Dharmasraya, Sumatera Barat', 23, 'Perempuan', 'Sekolah Menengah Kejuruan', 'Administrasi perkantoran', '081266255524', 'Saya sangat menyukai bidang administrasi', '2024-04-06', 'Bekerja', 'SHWokBzPgEYzULJ56jw8J7DyRnPKtpJaCu3R4aBp.jpg', '2023-10-03 06:16:27', '2023-10-07 05:08:40', NULL);

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
-- Table structure for table `sumbers`
--

CREATE TABLE `sumbers` (
  `id_sumber` bigint(20) UNSIGNED NOT NULL,
  `pemberi_informasi_id` varchar(255) NOT NULL,
  `pemangku_kepentingan_id` varchar(255) NOT NULL,
  `tgl_buka` date NOT NULL,
  `tgl_tutup` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sumbers`
--

INSERT INTO `sumbers` (`id_sumber`, `pemberi_informasi_id`, `pemangku_kepentingan_id`, `tgl_buka`, `tgl_tutup`, `created_at`, `updated_at`) VALUES
(1, '2', '2', '2023-08-23', '2023-09-01', '2023-08-23 00:06:08', '2023-08-23 00:06:08'),
(2, '2', '2', '2023-09-05', '2023-09-30', '2023-09-05 07:16:04', '2023-09-05 07:16:04'),
(3, '13', '13', '2023-10-05', '2023-10-31', '2023-10-04 18:36:21', '2023-10-04 18:36:21'),
(4, '18', '18', '2023-10-06', '2023-10-31', '2023-10-06 06:13:45', '2023-10-06 06:13:45'),
(5, '13', '13', '2023-10-09', '2023-10-31', '2023-10-08 20:41:22', '2023-10-08 20:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `status_tracer` int(11) NOT NULL,
  `foto_user` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `username`, `email_verified_at`, `password`, `level`, `status_tracer`, `foto_user`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Disdik', 'pemangku@gmail.com', 'disdik_sumbar', NULL, '$2y$10$h7cEkZVp4xX.dCfkfaR/HeviaOllE5W34c9jjFpIvnqCPjO3N0Gsq', '3', 0, 'default.jpg', NULL, '2023-08-17 02:37:39', '2023-08-17 02:37:39'),
(2, 'Admin', 'admin@gmail.com', 'admin_sipk', NULL, '$2y$10$T2ldYtlprNjKZET2b4O//uCNq0a4DL1FjNmv/0x3e4e3vu6JBtZ4i', '1', 0, 'default.jpg', NULL, '2023-08-17 02:37:39', '2023-08-17 02:37:39'),
(4, 'Danar', 'danar@gmail.com', 'danardinar', NULL, '$2y$10$Z9D7KL4ShPmUmCBJRnqfN.p.QiSkXga5rkqrUiTh8lRUlxzOfPnzS', '2', 1, 'xLNUd15Wgr5COcumHWf9vtSLI0TKUhM6XbXRxkOL.jpg', NULL, '2023-08-17 16:03:40', '2023-09-10 20:34:17'),
(6, 'Jamhur', 'jamhur@gmail.com', 'jamhur46', NULL, '$2y$10$JBV/DptJdyl4V.JGRnlvHOTYRNBD2kxiioBEZvHnrJ9PhcNQQQkzm', '2', 1, 'default.jpg', NULL, '2023-08-17 16:05:06', '2023-08-25 01:41:21'),
(7, 'Tech Tecnology', 'tech@gmail.com', 'technology_tech', NULL, '$2y$10$VCXnsacj9iijfpTAaozW8.RqP/8btLUzbz7bjRIMSLk87KuQZ1GjO', '4', 0, 'default.jpg', NULL, '2023-08-17 16:16:48', '2023-08-17 16:16:48'),
(8, 'Technolgy System', 'technosystem@gmail.com', 'technosystem', NULL, '$2y$10$cxP7WEszB.t2JToXPUBbhuOZ8bu41JF8gBY8IwKsgsMPKskleNt6W', '4', 0, 'default.jpg', NULL, '2023-08-17 16:17:39', '2023-08-17 16:17:39'),
(9, 'Percetakan Abdi', 'abdipercetakan@gmail.com', 'abdi_percetakan', NULL, '$2y$10$8km0sgNfuyp.1FC99AOZlex7JrNTRBhLsicYw8yoEKaj/P7Q3W6T2', '4', 0, '9n6qjsKuMX8Uz7bI5RwGcab2taIgSxlw3tpO9I2v.jpg', NULL, '2023-08-17 16:18:12', '2023-08-22 07:30:57'),
(10, 'SMKN 1 Koto Besar', 'smkn1kobes@gmail.com', 'smkn1kobes', NULL, '$2y$10$gwEf4yysreb8vrjwMqgyi.C1JO6tnRPWHupLvJ12rHcDcyO96eQaG', '5', 0, 'default.jpg', NULL, '2023-08-23 23:08:57', '2023-08-23 23:08:57'),
(11, 'SMKN 1 Sungai Rumbai', 'smkn1sungairumba@gmail.com', 'smkn1sungairumbai', NULL, '$2y$10$Ff2AP3AH9Tcgd1Hyfq75GufxnorFLOkpzF4tkXZ.Xidp7azjpphli', '5', 0, '5kuOi23xLE5duE9OGtSEBsLrkArUtc3kMxzGMavT.jpg', NULL, '2023-08-25 01:23:20', '2023-08-25 02:21:06'),
(13, 'Dinas Tenaga Kerja Sumbar', 'disnaker@gmail.com', 'disnakertrans', NULL, '$2y$10$4W8eGHsRNpyaeQn6Wn821OhmdL4hYNRGuWaetLzsMG0FdfDrTL2Ay', '3', 0, 'n4ljLrkxmqo3hyc4XcyNNcYcWa7AJRhqwIXFCcH1.png', NULL, '2023-08-26 07:12:09', '2023-10-04 05:25:41'),
(15, 'Febri restu', 'febri@gmail.com', 'febri08', NULL, '$2y$10$JqI1n8bW7BgljQQzz7IrHO7e8msqfQ5e5UsGXjtWmsHXRGY3xvkzC', '2', 0, 'default.jpg', NULL, '2023-09-19 16:05:13', '2023-09-19 16:05:13'),
(16, 'Hermansyah', 'herman@gmail.com', 'herman_23', NULL, '$2y$10$zB93toPdMcejcIYOk7bIe.GFHd5x.PhEnDzRVH2EcPj/upx49Koea', '2', 1, 'SHWokBzPgEYzULJ56jw8J7DyRnPKtpJaCu3R4aBp.jpg', NULL, '2023-10-03 06:16:28', '2023-10-07 05:08:40'),
(17, 'Dinas Pendidikan Sumbar', 'disdiksumbar@gmail.com', 'disdiksmbr', NULL, '$2y$10$DjSUYG0c0eWJheOdBYaXA.yo6T20A3cW4hucvXC2vHWs8evpPsovW', '3', 0, 'default.jpg', NULL, '2023-10-04 18:58:52', '2023-10-09 22:15:04'),
(18, 'PT. DSL', 'dsl@gmail.com', 'dsl_sejahtera', NULL, '$2y$10$WOyrEurRsK1ycc8OLW4nMuNdpHcKCd39/.2mn7ftovZ84dN5IvqAi', '4', 0, 'KsQiUn34KqY5QKuMvmUDX9cKlaRM7PqMgspgJbPA.jpg', NULL, '2023-10-06 06:00:59', '2023-10-06 06:12:25'),
(19, 'SMKN 1 Koto Baru', 'smkn1kobar@gmail.com', 'smkn1kobar', NULL, '$2y$10$YWyBpBvuCRQVSwaF.iHoIuIVKlkGkgpgwOkuJwifBkCeoXp6fXpq2', '5', 0, 'default.jpg', NULL, '2023-10-06 06:24:46', '2023-10-06 06:24:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnis`
--
ALTER TABLE `alumnis`
  ADD PRIMARY KEY (`id_alumni`);

--
-- Indexes for table `bursa_kerjas`
--
ALTER TABLE `bursa_kerjas`
  ADD PRIMARY KEY (`id_bkk`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `informasi_lowongans`
--
ALTER TABLE `informasi_lowongans`
  ADD PRIMARY KEY (`id_informasi_lowongan`);

--
-- Indexes for table `lamars`
--
ALTER TABLE `lamars`
  ADD PRIMARY KEY (`id_lamar`);

--
-- Indexes for table `laporans`
--
ALTER TABLE `laporans`
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
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pemangku_kepentingans`
--
ALTER TABLE `pemangku_kepentingans`
  ADD PRIMARY KEY (`id_pemangku_kepentingan`);

--
-- Indexes for table `pemberi_informasis`
--
ALTER TABLE `pemberi_informasis`
  ADD PRIMARY KEY (`id_pemberi_informasi`),
  ADD UNIQUE KEY `pemberi_informasis_email_instansi_unique` (`email_instansi`);

--
-- Indexes for table `pencari_kerjas`
--
ALTER TABLE `pencari_kerjas`
  ADD PRIMARY KEY (`id_pencari_kerja`),
  ADD UNIQUE KEY `pencari_kerjas_email_pk_unique` (`email_pk`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sumbers`
--
ALTER TABLE `sumbers`
  ADD PRIMARY KEY (`id_sumber`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumnis`
--
ALTER TABLE `alumnis`
  MODIFY `id_alumni` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bursa_kerjas`
--
ALTER TABLE `bursa_kerjas`
  MODIFY `id_bkk` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `informasi_lowongans`
--
ALTER TABLE `informasi_lowongans`
  MODIFY `id_informasi_lowongan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lamars`
--
ALTER TABLE `lamars`
  MODIFY `id_lamar` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `laporans`
--
ALTER TABLE `laporans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pemangku_kepentingans`
--
ALTER TABLE `pemangku_kepentingans`
  MODIFY `id_pemangku_kepentingan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pemberi_informasis`
--
ALTER TABLE `pemberi_informasis`
  MODIFY `id_pemberi_informasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pencari_kerjas`
--
ALTER TABLE `pencari_kerjas`
  MODIFY `id_pencari_kerja` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sumbers`
--
ALTER TABLE `sumbers`
  MODIFY `id_sumber` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
