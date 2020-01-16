-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2020 at 01:38 PM
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
  `masa_pajak` varchar(25) NOT NULL,
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
(3, 3, 1, 'Desember', 2020, 111, '11111111111111111', 1, NULL),
(4, 3, 1, '1', 2020, 23, '23', 1, NULL),
(5, 3, 1, '1', 2020, 23, '23', 1, NULL),
(6, 3, 1, '2', 2020, 222, '222', 1, NULL);

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
(36, 5, 'ssp_bulan11.pdf', NULL);

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
(1, '1912190001', '111111111111111', '11111111111111111111', '11111111111111111111111111111111111111111111111111111111111111111111111111111222222211111111', '1111', '1111', '1111', '1912190001.png', '2019-12-21'),
(2, '1912190002', '111111111111111', '111111111111111111111111111111', '222222222222222222222222222222222222222222222222222', '2222', '222', '222', '1912190002.png', '2019-12-21'),
(3, '2001040001', '111111111111111', '1111111111111', '1111111111111111111111111111111111111111111111111111111111111111111111111111', '1111', '1111', '1111', '2001040001.png', NULL);

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
(343, 'Menghapus Log tahun 2019', '2019-12-21 14:21:49', 3),
(344, 'Melihat Halaman Database Box', '2019-12-21 14:21:52', 3),
(345, 'Melihat Halaman Box 1912190002', '2019-12-21 14:21:55', 3),
(346, 'Menambah Data Berkas di Box 1912190002', '2019-12-21 14:22:13', 3),
(347, 'Melihat Halaman Database Box', '2019-12-21 14:22:18', 3),
(348, 'Menghapus lampiran ssp_bulan11.pdf di Berkas SPT Tahunan Pph 25/29 Box 111111111111111111111111111111', '2019-12-21 14:22:37', 3),
(349, 'Menghapus lampiran spp_bulan10.pdf di Berkas SPT Tahunan Pph 25/29 Box 111111111111111111111111111111', '2019-12-21 14:22:37', 3),
(350, 'Menghapus lampiran Settlement_BPK_19070038.pdf di Berkas SPT Tahunan Pph 25/29 Box 111111111111111111111111111111', '2019-12-21 14:22:37', 3),
(351, 'Menghapus lampiran Invoice-NSI-1807-0273.pdf di Berkas SPT Tahunan Pph 25/29 Box 111111111111111111111111111111', '2019-12-21 14:22:37', 3),
(352, 'Menghapus lampiran Invoice-TMS-000165_TMS-001295_TMS-0001.pdf di Berkas SPT Tahunan Pph 25/29 Box 111111111111111111111111111111', '2019-12-21 14:22:37', 3),
(353, 'Menghapus lampiran header-banner2.jpg di Berkas SPT Tahunan Pph 25/29 Box 111111111111111111111111111111', '2019-12-21 14:22:37', 3),
(354, 'Menghapus lampiran banner-2.jpg di Berkas SPT Tahunan Pph 25/29 Box 111111111111111111111111111111', '2019-12-21 14:22:37', 3),
(355, 'Menghapus Data Berkas di Box 1912190002', '2019-12-21 14:22:37', 3),
(356, 'Menghapus Data Box 1912190002 karena LLLLLLLLLLLLL', '2019-12-21 14:22:37', 3),
(357, 'Melihat Halaman Database Box', '2019-12-21 14:22:42', 3),
(358, 'Login', '2020-01-04 09:07:15', 1),
(359, 'Melihat Halaman Database Box', '2020-01-04 09:07:35', 1),
(360, 'Logout', '2020-01-04 09:07:44', 1),
(361, 'Login', '2020-01-04 09:07:49', 3),
(362, 'Melihat Halaman Database Box', '2020-01-04 09:07:52', 3),
(363, 'Menambah Data Box :2001040001', '2020-01-04 09:08:14', 3),
(364, 'Melihat Halaman Box 2001040001', '2020-01-04 09:08:22', 3),
(365, 'Melihat Halaman Box 2001040001', '2020-01-04 09:09:03', 3),
(366, 'Melihat Halaman Box 2001040001', '2020-01-04 09:09:41', 3),
(367, 'Melihat Halaman Box 2001040001', '2020-01-04 09:11:28', 3),
(368, 'Melihat Halaman Box 2001040001', '2020-01-04 09:12:52', 3),
(369, 'Melihat Halaman Box 2001040001', '2020-01-04 09:13:43', 3),
(370, 'Melihat Halaman Box 2001040001', '2020-01-04 09:15:48', 3),
(371, 'Melihat Halaman Box 2001040001', '2020-01-04 09:16:39', 3),
(372, 'Menambah Data Berkas di Box 2001040001', '2020-01-04 09:16:49', 3),
(373, 'Menambah Data Berkas di Box 2001040001', '2020-01-04 09:20:03', 3),
(374, 'Menambah Data Berkas di Box 2001040001', '2020-01-04 09:20:17', 3),
(375, 'Melihat Isi Lampiran Berkas SPT Tahunan Pph 25/29 di Box 2001040001', '2020-01-04 09:20:22', 3),
(376, 'Melihat Isi Lampiran Berkas SPT Tahunan Pph 25/29 di Box 2001040001', '2020-01-04 09:22:13', 3),
(377, 'Melihat Halaman Box 2001040001', '2020-01-04 09:22:15', 3),
(378, 'Melihat Halaman Box 2001040001', '2020-01-04 09:22:31', 3),
(379, 'Menambah Data Berkas di Box 2001040001', '2020-01-04 09:22:43', 3),
(380, 'Logout', '2020-01-04 09:25:38', 3),
(381, 'Login', '2020-01-04 09:25:42', 1),
(382, 'Melihat Halaman Database Box', '2020-01-04 09:25:44', 1),
(383, 'Melihat Halaman Box 2001040001', '2020-01-04 09:25:46', 1),
(384, 'Melihat Isi Lampiran Berkas SPT Tahunan Pph 25/29 di Box 2001040001', '2020-01-04 09:25:54', 1),
(385, 'Melihat Isi Lampiran Berkas SPT Tahunan Pph 25/29 di Box 2001040001', '2020-01-04 09:26:54', 1),
(386, 'Melihat Halaman Box 2001040001', '2020-01-04 09:26:57', 1),
(387, 'Melihat Isi Lampiran Berkas SPT Tahunan Pph 25/29 di Box 2001040001', '2020-01-04 09:27:00', 1),
(388, 'Melihat Halaman Box 2001040001', '2020-01-04 09:27:03', 1),
(389, 'Melihat Isi Lampiran Berkas SPT Tahunan Pph 25/29 di Box 2001040001', '2020-01-04 09:27:04', 1),
(390, 'Melihat Isi Lampiran Berkas SPT Tahunan Pph 25/29 di Box 2001040001', '2020-01-04 09:27:33', 1),
(391, 'Login', '2020-01-16 19:35:41', 4),
(392, 'Melihat Halaman Database Box', '2020-01-16 19:35:45', 4),
(393, 'Melihat Halaman Box 2001040001', '2020-01-16 19:36:05', 4),
(394, 'Melihat Halaman Box 2001040001', '2020-01-16 19:37:47', 4),
(395, 'Meng-update Data Berkas di Box 2001040001', '2020-01-16 19:37:57', 4);

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
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_berkas_lampiran`
--
ALTER TABLE `tb_berkas_lampiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tb_box`
--
ALTER TABLE `tb_box`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_jenis_berkas`
--
ALTER TABLE `tb_jenis_berkas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=396;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
