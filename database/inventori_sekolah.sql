-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 06:12 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventori_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `lokasi_barang` varchar(100) NOT NULL,
  `tipe_barang` enum('out') NOT NULL DEFAULT 'out',
  `waktu_keluar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_pengguna` int(11) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_pemasok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `nama_barang`, `qty`, `lokasi_barang`, `tipe_barang`, `waktu_keluar`, `id_pengguna`, `id_kategori`, `id_pemasok`) VALUES
(1, 'Sapu', 6, 'Kelas X-A', 'out', '2024-08-02 01:05:52', 1, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `lokasi_barang` varchar(100) NOT NULL,
  `tipe_barang` enum('in') NOT NULL DEFAULT 'in',
  `waktu_masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_pengguna` int(11) DEFAULT NULL,
  `id_pemasok` int(11) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `nama_barang`, `qty`, `lokasi_barang`, `tipe_barang`, `waktu_masuk`, `id_pengguna`, `id_pemasok`, `id_kategori`) VALUES
(28, 'Monitor AOC 24 inch', 20, 'Lab Komputer II', 'in', '2024-08-01 21:38:56', 1, 1, 3),
(32, 'Sapu', 10, 'Gudang II', 'in', '2024-08-02 00:04:18', 1, 3, 2),
(33, 'Kemoceng', 5, 'Gudang I', 'in', '2024-08-06 15:57:41', 1, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `deskripsi`) VALUES
(1, 'Alat Tulis', 'Peralatan tulis-menulis'),
(2, 'Perabotan', 'Perabotan Sekolah'),
(3, 'Elektronik', 'Barang elektronik');

-- --------------------------------------------------------

--
-- Table structure for table `pemasok`
--

CREATE TABLE `pemasok` (
  `id_pemasok` int(11) NOT NULL,
  `nama_pemasok` varchar(100) NOT NULL,
  `kontak_pemasok` varchar(100) DEFAULT NULL,
  `alamat_pemasok` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemasok`
--

INSERT INTO `pemasok` (`id_pemasok`, `nama_pemasok`, `kontak_pemasok`, `alamat_pemasok`) VALUES
(1, 'PT Elektronik Pratama', '02156348891', 'Jl. Pondok Indah No. 15'),
(2, 'Toko Buku Jaya', '081255662233', 'Jl. Matraman No. 22'),
(3, 'PT Perabot Nusa Indah', '08128899557', 'Jl. Kenangan Kopi No. 8');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff') NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `role`, `email`) VALUES
(1, 'faisal', '$2y$10$KVQATNNd3KWSouoXrr0gC.tZL/w9fhTggcettWPEq62ey8CtbxJr6', 'admin', 'faisalr91@gmail.com'),
(2, 'fahmi', '$2y$10$pFPF6kNqK3X7alXoCfw28OBNE08NkFBlrB7IO7ALGD1sQ66JP/CUy', 'staff', 'fahmi@gmail.com'),
(4, 'abdillah', '$2y$10$Wj80Wx2zpwiogIpPdCIx3u7Xdy.RHd/DfJ89bqzSunKnVbQUCQlb2', 'staff', 'faisalabdillah@gmail.com'),
(6, 'hendrik', '$2y$10$RP1c15CFgZqk.vxVIJQe9OoKcq8kURxczb/i9FKBlRav/9BZS.2Nq', 'staff', 'hendrik@gmail.com'),
(7, 'addi', '$2y$10$SE6NWwPf9e3t3ZcAn8bcdOQTQzAlk9LtGXxDaFl.tJtTQVnI1yCRW', 'staff', 'addi@gmail.com'),
(8, 'hery', '$2y$10$ZgW1WMu0K.z.kjYbwDOmAeSlqm4yeXB0RrOjZovjbxkjiQbODkwGu', 'staff', 'hery@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `barang_keluar_ibfk_1` (`id_pengguna`),
  ADD KEY `barang_keluar_ibfk_2` (`id_kategori`),
  ADD KEY `barang_keluar_ibfk_3` (`id_pemasok`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`),
  ADD KEY `barang_masuk_ibfk_1` (`id_pengguna`),
  ADD KEY `barang_masuk_ibfk_2` (`id_pemasok`),
  ADD KEY `barang_masuk_ibfk_3` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indexes for table `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id_pemasok`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_barang_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pemasok`
--
ALTER TABLE `pemasok`
  MODIFY `id_pemasok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_ibfk_3` FOREIGN KEY (`id_pemasok`) REFERENCES `pemasok` (`id_pemasok`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`id_pemasok`) REFERENCES `pemasok` (`id_pemasok`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
