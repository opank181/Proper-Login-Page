-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2023 at 10:08 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cobaaja`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(5) NOT NULL,
  `nama_user` varchar(25) NOT NULL,
  `email_user` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gambar` varchar(128) DEFAULT NULL,
  `role` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `email_user`, `password`, `gambar`, `role`) VALUES
(1, 'Wahyudi', 'wahyudi123@gmail.com', '$2y$10$RUqL9HZWqxUv.yLJ5hI/7.rpfkWnoes2gIoj81r8rKamRgANG04z2', 'default.jpg', 'Manager'),
(2, 'opank', 'opank181@gmail.com', '$2y$10$wR8HCX.ZPmljvMAQxBASW.3KPtgoDke4rhnoVYs4Al5xeM2png2oq', '', 'Manager'),
(3, 'Sinauka', 'sinauka@gmail.com', '$2y$10$RUqL9HZWqxUv.yLJ5hI/7.rpfkWnoes2gIoj81r8rKamRgANG04z2', NULL, 'Manager'),
(4, 'Rizal Manto', 'rizal123@gmail.com', '$2y$10$RUqL9HZWqxUv.yLJ5hI/7.rpfkWnoes2gIoj81r8rKamRgANG04z2', NULL, 'Karyawan'),
(5, 'ranto Gudal', 'rantogudal@gmail.com', '$2y$10$RUqL9HZWqxUv.yLJ5hI/7.rpfkWnoes2gIoj81r8rKamRgANG04z2', NULL, 'Karyawan'),
(6, 'Rano Karno', 'ranokarno@gmail.com', '$2y$10$aAMfAr0VCeV8346BV2MoY.6UGKJ3Fgpi8gaROuX3XDpxGDbT9luJy', '64398ce1846fe.jpg', 'Karyawan'),
(7, 'Ersita Hotma Ully', 'ersitaully@gmail.com', '$2y$10$u0VoiIPoIa4ugVSMDY3O9.isiCY0GQLRG9lwvVrZuBD7DWcLQEmNK', '6439ac541d914.jpg', 'Karyawan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
