-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: dbserver
-- Generation Time: Jan 05, 2026 at 11:58 AM
-- Server version: 11.8.5-MariaDB-ubu2404
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `pembayaran_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `metode_pembayaran` enum('Transfer Bank','E-Wallet','QRIS') DEFAULT NULL,
  `transportasi` enum('Motor','Mobil','Bus') NOT NULL,
  `jumlah_bayar` bigint(20) NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `tanggal_kunjung` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`pembayaran_id`, `user_id`, `metode_pembayaran`, `transportasi`, `jumlah_bayar`, `jumlah_orang`, `tanggal_bayar`, `tanggal_kunjung`, `status`) VALUES
(1, 35, 'E-Wallet', 'Motor', 30000, 1, '2026-01-01', '2026-01-02', 'Berhasil'),
(2, 35, 'E-Wallet', 'Bus', 135000, 10, '2026-01-01', '2026-01-09', 'Berhasil'),
(3, 35, 'Transfer Bank', 'Mobil', 80000, 1, '2026-01-01', '2026-01-02', 'Berhasil'),
(4, 35, NULL, 'Motor', 30000, 1, '2026-01-01', '2026-01-02', 'Gagal'),
(5, 35, NULL, 'Motor', 30000, 1, '2026-01-01', '2026-01-08', 'Gagal'),
(6, 35, NULL, 'Bus', 45000, 1, '2026-01-01', '2026-01-03', 'Gagal'),
(7, 35, 'QRIS', 'Mobil', 110000, 4, '2026-01-01', '2026-01-02', 'Berhasil'),
(8, 35, NULL, 'Bus', 35000, 13, '2026-01-01', '2026-01-02', 'Gagal'),
(9, 35, 'Transfer Bank', 'Motor', 20000, 13, '2026-01-01', '2026-01-02', 'Berhasil'),
(10, 35, NULL, 'Bus', 35000, 7, '2026-01-01', '2026-01-02', 'Gagal'),
(11, 35, 'QRIS', 'Mobil', 80000, 1, '2026-01-01', '2026-01-14', 'Menunggu'),
(12, 35, NULL, 'Mobil', 70000, 1, '2026-01-01', '2026-01-15', 'Gagal'),
(13, 35, NULL, 'Motor', 20000, 1, '2026-01-01', '2026-01-07', 'Gagal'),
(14, 35, NULL, 'Mobil', 30000, 1, '2026-01-01', '2026-01-15', 'Gagal'),
(15, 35, NULL, 'Mobil', 30000, 1, NULL, '2026-01-02', 'Pending'),
(16, 35, NULL, 'Mobil', 30000, 1, NULL, '2026-01-02', 'Pending'),
(17, 35, NULL, 'Mobil', 30000, 1, '2026-01-01', '2026-01-02', 'Gagal'),
(18, 35, NULL, 'Mobil', 30000, 1, '2026-01-01', '2026-01-02', 'Gagal'),
(19, 35, 'Transfer Bank', 'Mobil', 30000, 1, '2026-01-01', '2026-01-02', 'Berhasil'),
(20, 35, NULL, 'Bus', 50000, 1, '2026-01-01', '2026-01-08', 'Gagal'),
(21, 35, 'E-Wallet', 'Motor', 200000, 10, '2026-01-01', '2026-01-08', 'Berhasil'),
(22, 35, 'E-Wallet', 'Mobil', 25000, 1, '2026-01-02', '2026-01-08', 'Berhasil'),
(23, 39, 'QRIS', 'Bus', 150000, 5, '2026-01-02', '2026-01-09', 'Berhasil');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`pembayaran_id`),
  ADD KEY `user_pembayaran` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `pembayaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `user_pembayaran` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
