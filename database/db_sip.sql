-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2019 at 10:15 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sip`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_berkas`
--

CREATE TABLE `tb_berkas` (
  `id` int(4) NOT NULL,
  `id_box` int(4) NOT NULL,
  `id_jenis` int(4) NOT NULL,
  `masa_pajak` int(2) NOT NULL COMMENT 'angka bulan',
  `tahun_pajak` int(4) NOT NULL,
  `status_pembetulan` int(4) NOT NULL,
  `keterangan` text NOT NULL,
  `status_pinjam` int(2) NOT NULL COMMENT '1 = dipinjam, 0 = tidak',
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_berkas`
--

INSERT INTO `tb_berkas` (`id`, `id_box`, `id_jenis`, `masa_pajak`, `tahun_pajak`, `status_pembetulan`, `keterangan`, `status_pinjam`, `deletedate`) VALUES
(1, 1, 1, 1, 2019, 222, '22223', 1, NULL),
(2, 1, 1, 1, 2019, 222, '2222', 1, NULL),
(3, 1, 1, 1, 2019, 22, '22', 1, NULL),
(4, 1, 1, 1, 2019, 2, '2123142', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_berkas_lampiran`
--

CREATE TABLE `tb_berkas_lampiran` (
  `id` int(11) NOT NULL,
  `id_berkas` int(11) NOT NULL,
  `files` text NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_berkas_lampiran`
--

INSERT INTO `tb_berkas_lampiran` (`id`, `id_berkas`, `files`, `deletedate`) VALUES
(4, 1, 'Invoice-NSI-1807-0273.pdf', NULL),
(5, 1, 'Invoice-TMS-000165_TMS-001295_TMS-0001.pdf', NULL),
(6, 1, 'header-banner2.jpg', NULL),
(7, 1, 'banner-2.jpg', NULL),
(8, 2, 'ssp_bulan111.pdf', NULL),
(9, 2, 'spp_bulan101.pdf', NULL),
(10, 2, 'Settlement_BPK_190700381.pdf', NULL),
(11, 2, 'Invoice-NSI-1807-02731.pdf', NULL),
(12, 2, 'Invoice-TMS-000165_TMS-001295_TMS-00011.pdf', NULL),
(13, 2, 'header-banner21.jpg', NULL),
(14, 2, 'banner-21.jpg', NULL),
(15, 3, 'ssp_bulan112.pdf', NULL),
(16, 3, 'spp_bulan102.pdf', NULL),
(17, 3, 'Settlement_BPK_190700382.pdf', NULL),
(18, 3, 'Invoice-NSI-1807-02732.pdf', NULL),
(19, 3, 'Invoice-TMS-000165_TMS-001295_TMS-00012.pdf', NULL),
(20, 4, 'ssp_bulan113.pdf', NULL),
(21, 1, 'header-banner22.jpg', NULL),
(23, 1, 'ssp_bulan11.pdf', NULL),
(24, 1, 'spp_bulan10.pdf', NULL),
(25, 1, 'Settlement_BPK_19070038.pdf', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_box`
--

CREATE TABLE `tb_box` (
  `id` int(4) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `npwp` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `blok` varchar(4) NOT NULL,
  `rak` varchar(4) NOT NULL,
  `lantai` varchar(4) NOT NULL,
  `qrcode` text DEFAULT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_box`
--

INSERT INTO `tb_box` (`id`, `kode`, `npwp`, `nama`, `alamat`, `blok`, `rak`, `lantai`, `qrcode`, `deletedate`) VALUES
(1, 'B001', '111111111111111', '1', '1', '1', '1', '1', 'B001.png', NULL),
(2, 'B002', '213123123123123', '123', '123', '123', '123', '123', 'B002.png', '2019-12-11');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_berkas`
--

CREATE TABLE `tb_jenis_berkas` (
  `id` int(11) NOT NULL,
  `kode` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jenis_berkas`
--

INSERT INTO `tb_jenis_berkas` (`id`, `kode`, `nama`, `deletedate`) VALUES
(1, 1, 'SPT Tahunan Pph 25/29', NULL),
(2, 2, 'SPT Tahunan PPH 21', NULL),
(3, 0, 'SPT Masa Pph 21', '2019-11-28'),
(4, 3, 'SPT Masa Pph 21', NULL),
(5, 4, 'SPT Masa Pph 22', NULL),
(6, 1, '1', '2019-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `tb_log`
--

CREATE TABLE `tb_log` (
  `id` int(11) NOT NULL,
  `aksi` text NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `id_user` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_log`
--

INSERT INTO `tb_log` (`id`, `aksi`, `tanggal`, `id_user`) VALUES
(1, 'Logout', '2019-11-30 16:15:26', 4),
(2, 'login', '2019-11-30 16:15:49', 3),
(3, 'Melihat halaman Database User', '2019-11-30 16:17:01', 3),
(4, 'Melihat halaman Database User', '2019-11-30 16:17:15', 3),
(5, 'Melihat halaman Database User', '2019-11-30 16:17:20', 3),
(6, 'Melihat Halaman Database Box', '2019-11-30 16:17:21', 3),
(7, 'Menambah Data Box :B002', '2019-11-30 16:18:23', 3),
(8, 'Melihat Halaman Box B001', '2019-11-30 16:18:33', 3),
(9, 'Menambah Data Berkas', '2019-11-30 16:18:54', 3),
(10, 'Logout', '2019-11-30 16:19:01', 3),
(11, 'Login', '2019-11-30 16:19:07', 4),
(12, 'Melihat halaman Database User', '2019-11-30 16:19:42', 4),
(13, 'Melihat Halaman Database Box', '2019-11-30 17:10:23', 4),
(14, 'Menambah Data Box :B003', '2019-11-30 17:10:31', 4),
(15, 'Melihat Halaman Database Box', '2019-11-30 17:11:49', 4),
(16, 'Melihat Halaman Database Box', '2019-11-30 17:18:21', 4),
(17, 'Menghapus Data Box B001', '2019-11-30 17:19:36', 4),
(18, 'Menghapus Data Box B002', '2019-11-30 17:19:38', 4),
(19, 'Melihat Halaman Database Box', '2019-11-30 17:20:48', 4),
(20, 'Melihat Halaman Database Box', '2019-11-30 17:21:08', 4),
(21, 'Melihat Halaman Database Box', '2019-11-30 17:21:16', 4),
(22, 'Melihat Halaman Database Box', '2019-11-30 17:22:01', 4),
(23, 'Melihat Halaman Database Box', '2019-11-30 17:23:06', 4),
(24, 'Login', '2019-12-01 11:53:14', 3),
(25, 'Melihat Halaman Box B003', '2019-12-01 12:12:23', 3),
(26, 'Melihat Halaman Database Box', '2019-12-01 12:12:34', 3),
(27, 'Menambah Data Box :B004', '2019-12-01 12:15:13', 3),
(28, 'Melihat Halaman Box B004', '2019-12-01 12:15:53', 3),
(29, 'Melihat Halaman Box B003', '2019-12-01 12:16:08', 3),
(30, 'Menambah Data Berkas', '2019-12-01 12:16:23', 3),
(31, 'Login', '2019-12-04 00:04:23', 3),
(32, 'Login', '2019-12-04 00:05:50', 1),
(33, 'Login', '2019-12-04 00:07:53', 1),
(34, 'Login', '2019-12-04 20:04:06', 3),
(35, 'Melihat Halaman Database Jenis Berkas', '2019-12-04 20:04:11', 3),
(36, 'Melihat Halaman Database Box', '2019-12-04 20:04:13', 3),
(37, 'Menambah Data Box :B001', '2019-12-04 20:04:24', 3),
(38, 'Melihat Halaman Database Box', '2019-12-04 20:09:23', 3),
(39, 'Melihat Halaman Database Box', '2019-12-04 20:10:18', 3),
(40, 'Melihat Halaman Box B001', '2019-12-04 20:10:42', 3),
(41, 'Melihat Halaman Box B001', '2019-12-04 20:11:20', 3),
(42, 'Melihat Halaman Box B001', '2019-12-04 20:11:59', 3),
(43, 'Melihat Halaman Box B001', '2019-12-04 20:13:59', 3),
(44, 'Melihat Halaman Box B001', '2019-12-04 20:18:52', 3),
(45, 'Melihat Halaman Database Box', '2019-12-04 20:29:16', 3),
(46, 'Melihat Halaman Box B001', '2019-12-04 20:29:42', 3),
(47, 'Menambah Data Berkas di Box B001', '2019-12-04 20:30:36', 3),
(48, 'Melihat Halaman Box B001', '2019-12-04 20:41:09', 3),
(49, 'Melihat Halaman Box B001', '2019-12-04 20:50:45', 3),
(50, 'Mengupdate Data Berkas di Box B001', '2019-12-04 20:50:52', 3),
(51, 'Menambah Data Berkas di Box B001', '2019-12-04 20:51:17', 3),
(52, 'Menghapus Data Berkas di Box B001', '2019-12-04 20:51:20', 3),
(53, 'Login', '2019-12-05 21:01:51', 4),
(54, 'Melihat halaman Database User', '2019-12-05 21:01:56', 4),
(55, 'Menambah Data User', '2019-12-05 21:03:10', 4),
(56, 'Melihat halaman Database User', '2019-12-05 21:03:11', 4),
(57, 'Menambah Data User', '2019-12-05 21:03:17', 4),
(58, 'Menghapus Data User', '2019-12-05 21:03:20', 4),
(59, 'Meng-update Data User', '2019-12-05 21:03:29', 4),
(60, 'Menghapus Data User', '2019-12-05 21:03:31', 4),
(61, 'Login', '2019-12-11 22:51:48', 3),
(62, 'Melihat Halaman Database Box', '2019-12-11 22:53:55', 3),
(63, 'Melihat Halaman Box B001', '2019-12-11 22:54:02', 3),
(64, 'Melihat Halaman Box B001', '2019-12-11 22:54:46', 3),
(65, 'Melihat Halaman Database Box', '2019-12-11 22:58:56', 3),
(66, 'Melihat Halaman Database Jenis Berkas', '2019-12-11 22:58:59', 3),
(67, 'Melihat Halaman Database Box', '2019-12-11 22:59:02', 3),
(68, 'Melihat Halaman Box B001', '2019-12-11 22:59:06', 3),
(69, 'Logout', '2019-12-11 23:02:16', 3),
(70, 'Login', '2019-12-11 23:02:21', 1),
(71, 'Melihat Halaman Database Box', '2019-12-11 23:02:23', 1),
(72, 'Melihat Halaman Box B001', '2019-12-11 23:02:26', 1),
(73, 'Melihat Halaman Box B001', '2019-12-11 23:03:36', 1),
(74, 'Melihat Halaman Box B001', '2019-12-11 23:05:02', 1),
(75, 'Melihat Halaman Box B001', '2019-12-11 23:05:15', 1),
(76, 'Melihat Halaman Box B001', '2019-12-11 23:06:07', 1),
(77, 'Melihat Halaman Box B001', '2019-12-11 23:06:09', 1),
(78, 'Melihat Halaman Box B001', '2019-12-11 23:06:28', 1),
(79, 'Melihat Halaman Database Box', '2019-12-11 23:06:36', 1),
(80, 'Melihat Halaman Database Jenis Berkas', '2019-12-11 23:06:39', 1),
(81, 'Logout', '2019-12-11 23:09:05', 1),
(82, 'Login', '2019-12-11 23:09:10', 3),
(83, 'Melihat Halaman Database Box', '2019-12-11 23:09:12', 3),
(84, 'Melihat Halaman Database Box', '2019-12-11 23:20:49', 3),
(85, 'Menambah Data Box :B002', '2019-12-11 23:47:14', 3),
(86, 'Melihat Halaman Database Box', '2019-12-11 23:47:55', 3),
(87, 'Melihat Halaman Database Box', '2019-12-11 23:48:41', 3),
(88, 'Menghapus Data Box B002 karena 123', '2019-12-11 23:54:18', 3),
(89, 'Melihat Halaman Database Box', '2019-12-11 23:55:09', 3),
(90, 'Login', '2019-12-13 20:31:09', 3),
(91, 'Melihat Halaman Database Box', '2019-12-13 20:31:27', 3),
(92, 'Melihat Halaman Database Jenis Berkas', '2019-12-13 20:31:30', 3),
(93, 'Melihat Halaman Database Box', '2019-12-13 20:35:46', 3),
(94, 'Melihat Halaman Box B001', '2019-12-13 20:35:49', 3),
(95, 'Melihat Halaman Box B001', '2019-12-13 20:36:58', 3),
(96, 'Melihat Halaman Box B001', '2019-12-13 20:38:33', 3),
(97, 'Melihat Halaman Box B001', '2019-12-13 20:38:40', 3),
(98, 'Melihat Halaman Box B001', '2019-12-13 20:39:36', 3),
(99, 'Melihat Halaman Box B001', '2019-12-13 20:39:43', 3),
(100, 'Melihat Halaman Box B001', '2019-12-13 20:48:44', 3),
(101, 'Melihat Halaman Box B001', '2019-12-13 20:49:13', 3),
(102, 'Melihat Halaman Box B001', '2019-12-13 20:50:45', 3),
(103, 'Melihat Halaman Box B001', '2019-12-13 20:52:33', 3),
(104, 'Melihat Halaman Box B001', '2019-12-13 21:05:51', 3),
(105, 'Melihat Halaman Box B001', '2019-12-13 21:06:04', 3),
(106, 'Melihat Halaman Box B001', '2019-12-13 21:08:02', 3),
(107, 'Melihat Halaman Box B001', '2019-12-13 21:11:45', 3),
(108, 'Melihat Halaman Box B001', '2019-12-13 21:15:22', 3),
(109, 'Melihat Halaman Box B001', '2019-12-13 21:15:47', 3),
(110, 'Melihat Halaman Box B001', '2019-12-13 21:17:01', 3),
(111, 'Melihat Halaman Box B001', '2019-12-13 21:35:11', 3),
(112, 'Melihat Halaman Box B001', '2019-12-13 21:35:31', 3),
(113, 'Login', '2019-12-14 10:51:51', 3),
(114, 'Melihat Halaman Box B001', '2019-12-14 10:52:00', 3),
(115, 'Menambah Data Berkas di Box B001', '2019-12-14 10:52:28', 3),
(116, 'Menambah Data Berkas di Box B001', '2019-12-14 10:52:57', 3),
(117, 'Menambah Data Berkas di Box B001', '2019-12-14 10:53:59', 3),
(118, 'Menambah Data Berkas di Box B001', '2019-12-14 11:17:44', 3),
(119, 'Melihat Halaman Box B001', '2019-12-14 11:42:12', 3),
(120, 'Melihat Halaman Box B001', '2019-12-14 11:42:16', 3),
(121, 'Menambah Data Berkas di Box B001', '2019-12-14 11:42:43', 3),
(122, 'Melihat Halaman Box B001', '2019-12-14 11:43:42', 3),
(123, 'Menambah Data Berkas di Box B001', '2019-12-14 11:43:59', 3),
(124, 'Melihat Halaman Box B001', '2019-12-14 11:46:29', 3),
(125, 'Menambah Data Berkas di Box B001', '2019-12-14 11:46:49', 3),
(126, 'Menambah Data Berkas di Box B001', '2019-12-14 11:47:18', 3),
(127, 'Melihat Halaman Box B001', '2019-12-14 11:48:21', 3),
(128, 'Menambah Data Berkas di Box B001', '2019-12-14 11:48:39', 3),
(129, 'Menambah Data Berkas di Box B001', '2019-12-14 11:49:13', 3),
(130, 'Melihat Halaman Box B001', '2019-12-14 11:55:44', 3),
(131, 'Melihat Halaman Box B001', '2019-12-14 11:56:13', 3),
(132, 'Meng-update Data Berkas di Box B001', '2019-12-14 11:57:13', 3),
(133, 'Melihat Halaman Box B001', '2019-12-14 11:57:38', 3),
(134, 'Meng-update Data Berkas di Box B001', '2019-12-14 11:57:45', 3),
(135, 'Melihat Halaman Box B001', '2019-12-14 11:58:34', 3),
(136, 'Melihat Halaman Box B001', '2019-12-14 11:59:33', 3),
(137, 'Melihat Halaman Box B001', '2019-12-14 12:27:59', 3),
(138, 'Melihat Halaman Box B001', '2019-12-14 12:38:20', 3),
(139, 'Login', '2019-12-14 15:53:39', 3),
(140, 'Melihat Halaman Box B001', '2019-12-14 15:53:44', 3),
(141, 'Menghapus lampiran  di Berkas ', '2019-12-14 16:00:19', 3),
(142, 'Menghapus lampiran  di Berkas ', '2019-12-14 16:00:29', 3),
(143, 'Menghapus lampiran ssp_bulan114.pdf di Berkas ', '2019-12-14 16:01:10', 3),
(144, 'Menghapus lampiran ssp_bulan11.pdf di Berkas SPT Tahunan Pph 25/29', '2019-12-14 16:01:28', 3),
(145, 'Menghapus lampiran spp_bulan10.pdf di Berkas SPT Tahunan Pph 25/29', '2019-12-14 16:01:54', 3),
(146, 'Menghapus lampiran Settlement_BPK_19070038.pdf di Berkas SPT Tahunan Pph 25/29', '2019-12-14 16:02:15', 3),
(147, 'Mengupload lampiran di Berkas SPT Tahunan Pph 25/29 Box 1', '2019-12-14 16:12:41', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(3) NOT NULL,
  `user` varchar(30) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `level` int(3) NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `user`, `nama`, `password`, `level`, `deletedate`) VALUES
(1, 'user', 'user', '$2y$10$ua5gTLRmFPj4z9qFRA7GveMk6yT6PcOnUkv4.71auUNzPUZOTVuOO', 1, NULL),
(2, 'a', 'a', '$2y$10$Ybs4fjUs2RlGlS7a8AMoluMkZbm9maiB00DpK1nMyOghgUrNxqUrC', 1, '2019-11-17'),
(3, 'admin1', 'admin', '$2y$10$7Xldi4tRo5xuujsvs36Mxe/2h7CGgB3/yGntdMj2fJ.Cnb2aTDV92', 2, NULL),
(4, 'superadmin', 'Super Admin', '$2y$10$V.OQGsVQdXGashMP7vETyOWDitERMT2QEayi85hTyAi5OVTah.Rei', 3, NULL),
(5, 'user1', 'user1', '$2y$10$tsP8RMqjxWXOJy0GrMJXs.W3k4SDYWBEMeIdL9xnBkvxvNf151khi', 1, '2019-11-30'),
(6, 'a', 'a1', '$2y$10$BTOdmycG.jRYdtpjvIkcR.9CqzIUvFkjC/CK1BtmxAnG5rHzZl97a', 1, '2019-12-05'),
(7, 'b', 'b', '$2y$10$tcOZQfN9qdbgHkqaurklKOd9V2xhlVQgdY4rIKwjl5T0vewkT9.FG', 1, '2019-12-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_berkas`
--
ALTER TABLE `tb_berkas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_berkas_lampiran`
--
ALTER TABLE `tb_berkas_lampiran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_box`
--
ALTER TABLE `tb_box`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- Indexes for table `tb_jenis_berkas`
--
ALTER TABLE `tb_jenis_berkas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_berkas`
--
ALTER TABLE `tb_berkas`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_berkas_lampiran`
--
ALTER TABLE `tb_berkas_lampiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_box`
--
ALTER TABLE `tb_box`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_jenis_berkas`
--
ALTER TABLE `tb_jenis_berkas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
