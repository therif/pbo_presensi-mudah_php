-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 15, 2023 at 09:48 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pbo_presensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int NOT NULL,
  `judul` varchar(266) NOT NULL,
  `konten` varchar(266) NOT NULL,
  `tgl` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `judul`, `konten`, `tgl`) VALUES
(1, 'INAN', 'Hari ini saya galau banget gaes!', '2023-01-15 16:36:41'),
(2, 'Fatchay', 'Tugas PBO jangan lupa', '2023-01-15 16:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id` int NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tgl` date DEFAULT NULL,
  `desk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
