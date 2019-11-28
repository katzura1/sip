-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2019 at 02:12 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

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
  `npwp` int(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `blok` varchar(4) NOT NULL,
  `rak` varchar(4) NOT NULL,
  `lantai` varchar(4) NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_box`
--

INSERT INTO `tb_box` (`id`, `kode`, `npwp`, `nama`, `alamat`, `blok`, `rak`, `lantai`, `deletedate`) VALUES
(1, 'B001', 2147483647, 'Box A', 'Alamat A', 'A', '1', '3', NULL),
(2, 'B002', 2147483647, 'Asda', 'asdasd', 'A', '1', '2', NULL);

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
(1, 'View Box B001-Box Rahasia', '2019-11-24 13:58:47', 1),
(2, 'View Box B003-Tes Box', '2019-11-24 19:59:49', 1),
(3, 'View Box B001-Box Rahasia', '2019-11-24 20:00:21', 1),
(4, 'View Box B003-Tes Box', '2019-11-24 20:00:44', 1),
(5, 'View Box B001-Box A', '2019-11-27 20:41:17', 3);

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
(4, '1', '1', '$2y$10$W3qG8M9IYJd/fxSlqjm6AuokavaAdPexiGCVdEDOt7BT7mlrQ0xkO', 1, NULL);

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
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_jenis_berkas`
--
ALTER TABLE `tb_jenis_berkas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
