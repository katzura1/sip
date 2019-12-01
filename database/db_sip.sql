-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2019 at 06:18 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

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
  `qrcode` text,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(30, 'Menambah Data Berkas', '2019-12-01 12:16:23', 3);

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
(5, 'user1', 'user1', '$2y$10$tsP8RMqjxWXOJy0GrMJXs.W3k4SDYWBEMeIdL9xnBkvxvNf151khi', 1, '2019-11-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_berkas`
--
ALTER TABLE `tb_berkas`
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
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_box`
--
ALTER TABLE `tb_box`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_jenis_berkas`
--
ALTER TABLE `tb_jenis_berkas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
