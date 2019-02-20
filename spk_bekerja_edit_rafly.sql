-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2019 at 06:25 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_aw`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastlogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nip`, `password`, `lastlogin`) VALUES
(1, '061234567', 'rochman25', '2019-02-10 04:36:06');

-- --------------------------------------------------------

--
-- Table structure for table `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `nip` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_pegawai`
--

INSERT INTO `data_pegawai` (`nip`, `nama`, `jabatan`) VALUES
('061234567', 'Rochmanzaenur', 'SEKDES');

-- --------------------------------------------------------

--
-- Table structure for table `data_penduduk`
--

CREATE TABLE `data_penduduk` (
  `nik` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tanggungan` int(11) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_penduduk`
--

INSERT INTO `data_penduduk` (`nik`, `nama`, `tanggungan`, `alamat`) VALUES
('314144', 'Nama Penduduknya', 3, 'alamatnya'),
('33123456', 'Zaenurrochman', 3, 'Jln Pramuka desa kalisari RT07 RW 02'),
('333333333333', 'Rafli Firdausy Irawan', 4, 'Jalan Jalan yuk Sayang :)');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `sifat` enum('benefit','cost') NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama`, `keterangan`, `sifat`, `bobot`) VALUES
(1, 'Pendapatan Orang Tua', 'Semakin kecil semakin bagus', 'cost', 0.35),
(2, 'Jumlah Tanggungan', 'Semakin besar semakin bagus', 'benefit', 0.3),
(3, 'Luas Lahan (m2)', 'Semakin kecil semakin bagus', 'cost', 0.2),
(4, 'Jenis Lantai', 'Semakin besar semakin bagus', 'benefit', 0.15);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `nikPenduduk` varchar(20) NOT NULL,
  `idKriteria` int(11) NOT NULL,
  `id_subKriteria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `nikPenduduk`, `idKriteria`, `id_subKriteria`) VALUES
(9, '333333333333', 1, 1),
(10, '333333333333', 2, 6),
(11, '333333333333', 3, 10),
(12, '333333333333', 4, 14),
(13, '33123456', 1, 3),
(15, '33123456', 3, 10),
(17, '33123456', 2, 7),
(18, '33123456', 4, 15),
(19, '314144', 1, 6),
(20, '314144', 2, 6),
(21, '314144', 3, 11),
(22, '314144', 4, 16);

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id` int(11) NOT NULL,
  `idKriteria` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id`, `idKriteria`, `nama`, `value`) VALUES
(1, 1, '< 600.000', 1),
(2, 1, '600.000 - 800.000', 0.66),
(3, 1, '800.000 - 1.000.000', 0.33),
(4, 1, '>= 1.000.000', 0),
(5, 2, '0 - 1', 0),
(6, 2, '2 - 3', 0.33),
(7, 2, '4 - 5', 0.66),
(8, 2, '> 5', 1),
(9, 3, '< 70', 1),
(10, 3, '70 - 90', 0.66),
(11, 3, '90 - 110', 0.33),
(12, 3, '> 110', 0),
(13, 4, '1 - 2', 0),
(14, 4, '3 - 4', 0.33),
(15, 4, '5-6', 0.66),
(16, 4, '>7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastlogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nik`, `password`, `lastlogin`) VALUES
(1, '33123456', 'rochman25', '2019-02-10 04:34:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_adminPegawai` (`nip`);

--
-- Indexes for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `data_penduduk`
--
ALTER TABLE `data_penduduk`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_KriteriaNilai` (`idKriteria`),
  ADD KEY `fk_nilaiPenduduk` (`nikPenduduk`),
  ADD KEY `fk_nilaiSubkriteria` (`id_subKriteria`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subKriteria` (`idKriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_userNik` (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_adminPegawai` FOREIGN KEY (`nip`) REFERENCES `data_pegawai` (`nip`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `fk_KriteriaNilai` FOREIGN KEY (`idKriteria`) REFERENCES `kriteria` (`id`),
  ADD CONSTRAINT `fk_nilaiPenduduk` FOREIGN KEY (`nikPenduduk`) REFERENCES `data_penduduk` (`nik`),
  ADD CONSTRAINT `fk_nilaiSubkriteria` FOREIGN KEY (`id_subKriteria`) REFERENCES `subkriteria` (`id`);

--
-- Constraints for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `fk_subKriteria` FOREIGN KEY (`idKriteria`) REFERENCES `kriteria` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_userNik` FOREIGN KEY (`nik`) REFERENCES `data_penduduk` (`nik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
