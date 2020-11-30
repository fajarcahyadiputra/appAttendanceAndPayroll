-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2020 at 04:40 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `free_inventory_barang`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id` bigint(20) NOT NULL,
  `id_suplier` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `status_aktif` enum('ya','no') NOT NULL,
  `tanggal_buat` datetime NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id`, `id_suplier`, `id_user`, `kode_barang`, `nama_barang`, `stok`, `status_aktif`, `tanggal_buat`, `keterangan`) VALUES
(12, 2, 2, '1233', 'kacamata', 8, 'ya', '2020-11-02 02:11:51', 'ok'),
(13, 2, 2, 'ab1', 'pensil wwkwkwwkk', 0, 'ya', '2020-11-10 08:18:12', 'untuk stock');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang_keluar`
--

CREATE TABLE `tb_barang_keluar` (
  `id` bigint(20) NOT NULL,
  `id_barang` bigint(20) NOT NULL,
  `id_customer` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `jumblah` int(11) NOT NULL,
  `tanggal_keluar` datetime NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang_keluar`
--

INSERT INTO `tb_barang_keluar` (`id`, `id_barang`, `id_customer`, `id_user`, `jumblah`, `tanggal_keluar`, `keterangan`) VALUES
(12, 12, 2, 2, 3, '2020-11-17 16:55:00', 'ok ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id` bigint(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_tlpn` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `status_aktif` enum('ya','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`id`, `nama`, `email`, `no_tlpn`, `kota`, `status_aktif`) VALUES
(1, 'pt asep', 'ptasep@gmail.com', '873873', 'cikarang', 'ya'),
(2, 'pt.abdul', 'ptabdul@gmail.com', '6367365', 'bandung', 'ya'),
(4, 'ega', 'ega@gmail.com', '219992812737373', 'bekasi', 'ya');

-- --------------------------------------------------------

--
-- Table structure for table `tb_stok_penyesuaian`
--

CREATE TABLE `tb_stok_penyesuaian` (
  `id` bigint(11) NOT NULL,
  `id_barang` bigint(11) NOT NULL,
  `stok_sebelumnya` int(11) NOT NULL,
  `stok_baru` int(11) NOT NULL,
  `tanggal_check` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_stok_penyesuaian`
--

INSERT INTO `tb_stok_penyesuaian` (`id`, `id_barang`, `stok_sebelumnya`, `stok_baru`, `tanggal_check`) VALUES
(2, 12, 20, 11, '2020-11-10 04:42:34'),
(3, 13, 10, 5, '2020-11-10 08:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_suplier`
--

CREATE TABLE `tb_suplier` (
  `id` bigint(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_tlpn` varchar(100) NOT NULL,
  `status_aktif` enum('ya','no') NOT NULL,
  `asal_kota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_suplier`
--

INSERT INTO `tb_suplier` (`id`, `nama`, `email`, `no_tlpn`, `status_aktif`, `asal_kota`) VALUES
(2, 'PT.oye oye', 'ptoyeoye@gmail.com', '9787878', 'ya', 'batam'),
(6, 'pt bah', 'eawdawdawda@gmail.com', '23232323', 'ya', 'bekasi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` bigint(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `status_aktif` enum('ya','no') NOT NULL,
  `role` enum('super_admin','admin') NOT NULL,
  `tanggal_dimasukan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `nama`, `email`, `username`, `password`, `status_aktif`, `role`, `tanggal_dimasukan`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'ya', 'admin', '2020-10-12 14:07:28'),
(2, 'superadmin', 'superadmin@gmail.com', 'superadmin', '889a3a791b3875cfae413574b53da4bb8a90d53e', 'ya', 'super_admin', '2020-10-12 14:07:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_suplier` (`id_suplier`);

--
-- Indexes for table `tb_barang_keluar`
--
ALTER TABLE `tb_barang_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_stok_penyesuaian`
--
ALTER TABLE `tb_stok_penyesuaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `tb_suplier`
--
ALTER TABLE `tb_suplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_barang_keluar`
--
ALTER TABLE `tb_barang_keluar`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_stok_penyesuaian`
--
ALTER TABLE `tb_stok_penyesuaian`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_suplier`
--
ALTER TABLE `tb_suplier`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
