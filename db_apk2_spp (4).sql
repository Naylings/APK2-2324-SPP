-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2025 at 02:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_apk2_spp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_auth`
--

CREATE TABLE `tbl_auth` (
  `auth_id` varchar(10) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('Admin','Petugas') NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_auth`
--

INSERT INTO `tbl_auth` (`auth_id`, `email`, `password`, `role`, `create_at`, `update_at`) VALUES
('auth000002', 'test2@gmail.com', '$2y$10$6wwIuq2ruKS3NnsUfJS1weCpd3G8nMu7qzgehnTMmVcNiq8kWidBS', 'Admin', '2025-02-19 09:59:23', '2025-02-19 09:59:23'),
('AUTH000009', 'tesp4@gmail.com', '$2y$10$rY4.LB9b41xB8TKgnZSUBO.jxjANcOr3EpW5x3WtCOMmlw.BU5V1i', 'Petugas', '2025-02-25 16:00:59', '2025-02-25 16:00:59'),
('AUTH000010', 'tesP1@gmail.com', '$2y$10$pSUWsEmOes7PQpNHGtU4seABr4pX7NefXjan5aGEcbo8eMMq3i9DW', 'Petugas', '2025-02-26 06:23:29', '2025-02-26 06:23:29'),
('AUTH000012', 'admin@gmail.com', '$2y$10$lZEkP8UrZ83lLsv99693Yuk5tRfSS/FswRTSK5TCrrIAnU9BP0eBK', 'Admin', '2025-03-07 07:31:33', '2025-03-07 07:31:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bulan`
--

CREATE TABLE `tbl_bulan` (
  `id_bulan` int(11) NOT NULL,
  `no_bulan` int(5) NOT NULL,
  `nama_bulan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_bulan`
--

INSERT INTO `tbl_bulan` (`id_bulan`, `no_bulan`, `nama_bulan`) VALUES
(2, 2, 'February'),
(3, 3, 'Maret'),
(4, 1, 'January'),
(6, 4, 'April'),
(7, 5, 'Mei'),
(8, 6, 'Juni'),
(9, 7, 'July'),
(10, 8, 'Agustus'),
(11, 9, 'September'),
(12, 10, 'Oktober'),
(13, 11, 'November'),
(14, 12, 'Desember');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guru`
--

CREATE TABLE `tbl_guru` (
  `nip` int(25) NOT NULL,
  `nama_guru` varchar(100) DEFAULT NULL,
  `telepon_guru` varchar(100) DEFAULT NULL,
  `path_photo` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `date_start` date DEFAULT NULL,
  `date_finish` date DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_guru`
--

INSERT INTO `tbl_guru` (`nip`, `nama_guru`, `telepon_guru`, `path_photo`, `status`, `date_start`, `date_finish`, `create_at`, `update_at`) VALUES
(20231234, 'tarno', '12345678', '20231234_680cf56fce3aa.png', 'Active', '2025-04-11', '2025-04-26', '2025-04-26 15:02:07', '2025-04-28 03:28:22'),
(20231235, 'ShellSupreme26', '12345678', '20231235_680ef5efb8ddc.jpg', 'Active', '2025-04-10', '2025-04-18', '2025-04-28 03:28:47', '2025-04-28 03:28:59'),
(20231236, 'alex', '123456', '20231236_680f1debcd7dc.png', 'Active', '2025-04-16', '2025-04-25', '2025-04-28 06:19:23', '2025-04-28 06:20:41'),
(20231237, 'guru 3213', '123456', '20231237_68138a0234912.png', 'Active', '2025-05-08', '0212-12-31', '2025-05-01 14:49:38', '2025-05-04 12:21:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_pembayaran`
--

CREATE TABLE `tbl_jenis_pembayaran` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(25) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `tunai` decimal(10,2) NOT NULL,
  `bulanan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jenis_pembayaran`
--

INSERT INTO `tbl_jenis_pembayaran` (`id_jenis`, `nama_jenis`, `id_tahun_ajaran`, `tunai`, `bulanan`) VALUES
(3, 'Spp', 12, 300000.00, 1),
(4, 'dsp', 12, 1400000.00, 0),
(5, 'seragam', 12, 60000.00, 0),
(6, 'pendaftaran', 12, 500000.00, 0),
(7, 'praktek', 12, 100000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL,
  `simbol_jur` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`id_jurusan`, `nama_jurusan`, `simbol_jur`) VALUES
(3, 'Rekayasa Perangkat Lunak', 'RPL'),
(4, 'Teknik Sepeda Motor', 'TSM'),
(5, 'Farmasi', 'FAR'),
(6, 'Manajemen Perkantoran', 'MP');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `id_kelas` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `tingkat` int(10) NOT NULL,
  `jurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`id_kelas`, `id_tahun_ajaran`, `tingkat`, `jurusan`) VALUES
(13, 12, 11, 3),
(14, 12, 12, 3),
(15, 13, 10, 4),
(16, 14, 10, 4),
(17, 13, 10, 3),
(18, 13, 11, 3),
(19, 13, 12, 3),
(20, 14, 10, 3),
(21, 12, 10, 4),
(22, 12, 11, 4),
(23, 12, 12, 4),
(24, 13, 11, 4),
(25, 13, 12, 4),
(26, 14, 11, 3),
(27, 14, 11, 4),
(30, 14, 10, 5),
(31, 12, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `nis` varchar(20) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_bulan` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`nis`, `id_jenis`, `id_bulan`, `status`) VALUES
('3334000001', 6, NULL, 0),
('3334000001', 5, NULL, 0),
('3334000001', 7, 2, 0),
('3334000001', 7, 8, 0),
('3334000001', 7, 9, 0),
('3334000001', 7, 12, 0),
('3334000001', 3, 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sekolah`
--

CREATE TABLE `tbl_sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `alamat_sekolah` varchar(255) NOT NULL,
  `kontak_sekolah` int(100) NOT NULL,
  `email_sekolah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sekolah`
--

INSERT INTO `tbl_sekolah` (`id_sekolah`, `nama_sekolah`, `alamat_sekolah`, `kontak_sekolah`, `email_sekolah`) VALUES
(1, 'MVP', 'Internasionallllllllll', 2147483647, 'sekolahhhhhh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `nis` varchar(20) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `telepon_siswa` varchar(100) DEFAULT NULL,
  `path_photo` varchar(255) DEFAULT NULL,
  `alamat_siswa` varchar(255) NOT NULL,
  `jenkel` enum('L','P') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `id_kelas` int(11) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`nis`, `nama_siswa`, `telepon_siswa`, `path_photo`, `alamat_siswa`, `jenkel`, `status`, `id_kelas`, `create_at`, `update_at`) VALUES
('3334000001', 'ShellSupreme26', '123456', '3334000001_681770f9d7b70.png', 'apartemen 1', 'L', 'Active', 31, '2025-05-04 13:51:53', '2025-05-22 06:57:54'),
('3334000002', 'Muhamad Rizki Satibi', '12341234', NULL, 'Bandung', 'P', 'Active', 22, '2025-05-26 13:47:20', '2025-05-26 13:47:20'),
('3334000003', 'Muhammad Afrizal Zianu Pramesa', '12341235', NULL, 'Bandung', 'P', 'Active', 22, '2025-05-26 13:47:20', '2025-05-26 13:47:20'),
('3334000004', 'Muhammad Falih Firdaus', '12341236', NULL, 'Bandung', 'L', 'Active', 22, '2025-05-26 13:47:20', '2025-05-26 13:47:20'),
('3334000005', 'Muhammad Faqih Agustian', '12341237', NULL, 'Bandung', 'L', 'Active', 22, '2025-05-26 13:47:20', '2025-05-26 13:47:20'),
('3334000006', 'Muhammad Fauzan Nuril Hikam', '12341238', NULL, 'Bandung', 'L', 'Active', 22, '2025-05-26 13:47:20', '2025-05-26 13:47:20'),
('3334000007', 'Muhammad Rafi Darmawan', '12341239', NULL, 'Bandung', 'L', 'Active', 22, '2025-05-26 13:47:20', '2025-05-26 13:47:20'),
('3334000008', 'Muhammad Rifa Sandika', '12341240', NULL, 'Bandung', 'L', 'Active', 22, '2025-05-26 13:47:20', '2025-05-26 13:47:20'),
('3334000009', 'Muhammad Rizky', '12341241', NULL, 'Bandung', 'P', 'Active', 22, '2025-05-26 13:47:20', '2025-05-26 13:47:20'),
('3334000010', 'Reiga Putra Setiawan', '12341242', NULL, 'Bandung', 'L', 'Active', 22, '2025-05-26 13:47:20', '2025-05-26 13:47:20'),
('3334000011', 'Reinhart FIdelian Zahir', '12341243', NULL, 'Bandung', 'P', 'Active', 22, '2025-05-26 13:47:20', '2025-05-26 13:47:20'),
('3334000012', 'Rizky Nurcahya', '12341244', NULL, 'Bandung', 'P', 'Active', 22, '2025-05-26 13:47:20', '2025-05-26 13:47:20'),
('3334000013', 'Salman Al Farisi', '12341245', NULL, 'Bandung', 'L', 'Active', 22, '2025-05-26 13:47:20', '2025-05-26 13:47:20'),
('3334000014', 'walker', '12341246', NULL, 'Bandung', 'L', 'Active', 22, '2025-05-26 13:47:20', '2025-05-26 13:47:20'),
('3334000015', 'Satriya Pratama', '12341234', NULL, 'Bandung', 'P', 'Active', 21, '2025-05-26 15:25:12', '2025-05-26 15:25:12'),
('3334000016', 'Triztan Edward Gunawan', '12341235', NULL, 'Bandung', 'P', 'Active', 21, '2025-05-26 15:25:12', '2025-05-26 15:25:12'),
('3334000017', 'Uswatun Hasanah', '12341236', NULL, 'Bandung', 'L', 'Active', 21, '2025-05-26 15:25:12', '2025-05-26 15:25:12'),
('3334000018', 'Valent Marciano Worang', '12341237', NULL, 'Bandung', 'P', 'Active', 21, '2025-05-26 15:25:12', '2025-05-26 15:25:12'),
('3334000019', 'Zaidan Maulana Rifiansyah', '12341238', NULL, 'Bandung', 'L', 'Active', 21, '2025-05-26 15:25:12', '2025-05-26 15:25:12'),
('3334000020', 'Agra Zahran Agdyputra', '12341239', NULL, 'Bandung', 'P', 'Active', 21, '2025-05-26 15:25:12', '2025-05-26 15:25:12'),
('3334000021', 'Andrean Putra Diandra', '12341240', NULL, 'Bandung', 'L', 'Active', 21, '2025-05-26 15:25:12', '2025-05-26 15:25:12'),
('3334000022', 'Angga Jaya Kusumah', '12341241', NULL, 'Bandung', 'P', 'Active', 21, '2025-05-26 15:25:12', '2025-05-26 15:25:12'),
('3334000023', 'Aria Dwi Pangga', '12341242', NULL, 'Bandung', 'L', 'Active', 21, '2025-05-26 15:25:12', '2025-05-26 15:25:12'),
('3334000024', 'Audric Bisma Syah Putra Noor', '12341243', NULL, 'Bandung', 'P', 'Active', 21, '2025-05-26 15:25:12', '2025-05-26 15:25:12'),
('3334000025', 'aby', '12341244', NULL, 'Bandung', 'P', 'Active', 21, '2025-05-26 15:25:12', '2025-05-26 15:25:12'),
('3334000026', 'Beta', '12341245', NULL, 'Bandung', 'L', 'Active', 21, '2025-05-26 15:25:12', '2025-05-26 15:25:12'),
('3334000027', 'walker', '12341246', NULL, 'Bandung', 'P', 'Active', 21, '2025-05-26 15:25:12', '2025-05-26 15:25:12'),
('3334000028', 'Adrian', '12341241', NULL, 'Bandung', 'P', 'Active', 23, '2025-05-27 07:33:00', '2025-05-27 07:33:00'),
('3334000029', 'Aini Ocktaviani', '12341242', NULL, 'Bandung', 'L', 'Active', 23, '2025-05-27 07:33:00', '2025-05-27 07:33:00'),
('3334000030', 'Aira Fitriani', '12341243', NULL, 'Bandung', 'P', 'Active', 23, '2025-05-27 07:33:00', '2025-05-27 07:33:00'),
('3334000031', 'Alia Fauziyyan Rahima', '12341244', NULL, 'Bandung', 'P', 'Active', 23, '2025-05-27 07:33:00', '2025-05-27 07:33:00'),
('3334000032', 'Aprillia Yulianingsih', '12341245', NULL, 'Bandung', 'L', 'Active', 23, '2025-05-27 07:33:00', '2025-05-27 07:33:00'),
('3334000033', 'Arul Ramdani', '12341246', NULL, 'Bandung', 'L', 'Active', 23, '2025-05-27 07:33:00', '2025-05-27 07:33:00'),
('3334000034', 'Rafi Al Fajri Sofyan', '12341234', NULL, 'Bandung', 'P', 'Active', 23, '2025-05-27 07:33:00', '2025-05-27 07:33:00'),
('3334000035', 'Rafi Oktaviansyah', '12341235', NULL, 'Bandung', 'P', 'Active', 23, '2025-05-27 07:33:00', '2025-05-27 07:33:00'),
('3334000036', 'Revan Ahmad Priyatna', '12341236', NULL, 'Bandung', 'L', 'Active', 23, '2025-05-27 07:33:00', '2025-05-27 07:33:00'),
('3334000037', 'Rian Afriansah', '12341237', NULL, 'Bandung', 'P', 'Active', 23, '2025-05-27 07:33:00', '2025-05-27 07:33:00'),
('3334000038', 'Ricky Aryaguna Irawan', '12341238', NULL, 'Bandung', 'L', 'Active', 23, '2025-05-27 07:33:00', '2025-05-27 07:33:00'),
('3334000039', 'Rizqi Aura Lestari', '12341239', NULL, 'Bandung', 'L', 'Active', 23, '2025-05-27 07:33:00', '2025-05-27 07:33:00'),
('3334000040', 'Rudi Ravana', '12341240', NULL, 'Bandung', 'L', 'Active', 23, '2025-05-27 07:33:00', '2025-05-27 07:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tahun`
--

CREATE TABLE `tbl_tahun` (
  `id_tahun` int(11) NOT NULL,
  `tahun` int(10) NOT NULL,
  `simbol` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_tahun`
--

INSERT INTO `tbl_tahun` (`id_tahun`, `tahun`, `simbol`) VALUES
(3, 2033, 33),
(4, 2044, 44),
(6, 2034, 34),
(7, 2035, 35),
(8, 2036, 36),
(9, 2037, 37);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tahun_ajaran`
--

CREATE TABLE `tbl_tahun_ajaran` (
  `id_tahun_ajaran` int(11) NOT NULL,
  `semester_ganjil` int(11) NOT NULL,
  `semester_genap` int(11) NOT NULL,
  `tgl_start` date DEFAULT NULL,
  `tgl_finish` date DEFAULT NULL,
  `simbol_tahun_ajaran` int(10) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_tahun_ajaran`
--

INSERT INTO `tbl_tahun_ajaran` (`id_tahun_ajaran`, `semester_ganjil`, `semester_genap`, `tgl_start`, `tgl_finish`, `simbol_tahun_ajaran`, `status`) VALUES
(12, 2033, 2034, '2033-06-01', '2034-06-01', 3334, 'Active'),
(13, 2034, 2035, '2025-04-01', '2025-04-02', 3435, 'Inactive'),
(14, 2035, 2036, '2025-04-03', '2025-04-04', 3536, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `telepon_user` varchar(100) DEFAULT NULL,
  `path_photo` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive','-') DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_finish` date DEFAULT NULL,
  `auth_id` varchar(10) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `telepon_user`, `path_photo`, `status`, `date_start`, `date_finish`, `auth_id`, `create_at`, `update_at`) VALUES
(4, 'admin colin', '1111', '4_67c32d13af69e.png', 'Inactive', '0000-00-00', '0000-00-00', 'auth000002', '2025-02-24 07:12:53', '2025-03-01 15:51:47'),
(9, 'Petugas 67', '123', '9_67beac59899d5.png', 'Active', '2025-02-22', '2025-02-20', 'AUTH000009', '2025-02-25 16:00:59', '2025-02-26 05:53:29'),
(10, 'Petugas 3', '123', 'AUTH000010_67beb361790f8.png', 'Inactive', '2025-02-20', '2025-02-19', 'AUTH000010', '2025-02-26 06:23:29', '2025-02-26 06:23:29'),
(15, 'admin test', '1234', 'AUTH000012_67caa0d60f8f9.png', 'Inactive', '0000-00-00', '0000-00-00', 'AUTH000012', '2025-03-07 07:31:33', '2025-03-07 07:31:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wali_kelas`
--

CREATE TABLE `tbl_wali_kelas` (
  `wali_kelas` int(25) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_wali_kelas`
--

INSERT INTO `tbl_wali_kelas` (`wali_kelas`, `id_kelas`, `id_tahun_ajaran`) VALUES
(20231235, 13, 12),
(20231236, 23, 12),
(20231234, 31, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_auth`
--
ALTER TABLE `tbl_auth`
  ADD PRIMARY KEY (`auth_id`);

--
-- Indexes for table `tbl_bulan`
--
ALTER TABLE `tbl_bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indexes for table `tbl_guru`
--
ALTER TABLE `tbl_guru`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `tbl_jenis_pembayaran`
--
ALTER TABLE `tbl_jenis_pembayaran`
  ADD PRIMARY KEY (`id_jenis`),
  ADD KEY `id_tahun_ajaran` (`id_tahun_ajaran`);

--
-- Indexes for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_tahun_ajaran` (`id_tahun_ajaran`,`jurusan`),
  ADD KEY `jurusan` (`jurusan`);

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD KEY `nis` (`nis`,`id_jenis`,`id_bulan`),
  ADD KEY `id_jenis` (`id_jenis`),
  ADD KEY `id_bulan` (`id_bulan`);

--
-- Indexes for table `tbl_sekolah`
--
ALTER TABLE `tbl_sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tbl_tahun`
--
ALTER TABLE `tbl_tahun`
  ADD PRIMARY KEY (`id_tahun`);

--
-- Indexes for table `tbl_tahun_ajaran`
--
ALTER TABLE `tbl_tahun_ajaran`
  ADD PRIMARY KEY (`id_tahun_ajaran`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `auth_id` (`auth_id`);

--
-- Indexes for table `tbl_wali_kelas`
--
ALTER TABLE `tbl_wali_kelas`
  ADD KEY `wali_kelas` (`wali_kelas`,`id_kelas`),
  ADD KEY `id_tahun_ajaran` (`id_tahun_ajaran`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bulan`
--
ALTER TABLE `tbl_bulan`
  MODIFY `id_bulan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_jenis_pembayaran`
--
ALTER TABLE `tbl_jenis_pembayaran`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_sekolah`
--
ALTER TABLE `tbl_sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_tahun`
--
ALTER TABLE `tbl_tahun`
  MODIFY `id_tahun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_tahun_ajaran`
--
ALTER TABLE `tbl_tahun_ajaran`
  MODIFY `id_tahun_ajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_jenis_pembayaran`
--
ALTER TABLE `tbl_jenis_pembayaran`
  ADD CONSTRAINT `tbl_jenis_pembayaran_ibfk_1` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tbl_tahun_ajaran` (`id_tahun_ajaran`);

--
-- Constraints for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD CONSTRAINT `tbl_kelas_ibfk_2` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tbl_tahun_ajaran` (`id_tahun_ajaran`),
  ADD CONSTRAINT `tbl_kelas_ibfk_3` FOREIGN KEY (`jurusan`) REFERENCES `tbl_jurusan` (`id_jurusan`);

--
-- Constraints for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD CONSTRAINT `tbl_pembayaran_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `tbl_siswa` (`nis`),
  ADD CONSTRAINT `tbl_pembayaran_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `tbl_jenis_pembayaran` (`id_jenis`),
  ADD CONSTRAINT `tbl_pembayaran_ibfk_3` FOREIGN KEY (`id_bulan`) REFERENCES `tbl_bulan` (`id_bulan`);

--
-- Constraints for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD CONSTRAINT `tbl_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tbl_kelas` (`id_kelas`) ON DELETE SET NULL;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`auth_id`) REFERENCES `tbl_auth` (`auth_id`);

--
-- Constraints for table `tbl_wali_kelas`
--
ALTER TABLE `tbl_wali_kelas`
  ADD CONSTRAINT `tbl_wali_kelas_ibfk_1` FOREIGN KEY (`wali_kelas`) REFERENCES `tbl_guru` (`nip`),
  ADD CONSTRAINT `tbl_wali_kelas_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `tbl_kelas` (`id_kelas`),
  ADD CONSTRAINT `tbl_wali_kelas_ibfk_3` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tbl_tahun_ajaran` (`id_tahun_ajaran`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
