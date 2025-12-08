-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2025 at 03:42 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goexplore`
--

-- --------------------------------------------------------

--
-- Table structure for table `destinasi_wisata`
--

CREATE TABLE `destinasi_wisata` (
  `destinasi_id` int(11) NOT NULL,
  `nama_destinasi` varchar(100) NOT NULL,
  `lokasi` int(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `kategori` enum('Alam','Budaya','Sejarah','Kuliner') NOT NULL,
  `foto_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotel_id` int(11) NOT NULL,
  `nama_hotel` varchar(100) NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga_per_malam` bigint(20) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `foto_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `pembayaran_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jenis_transaksi` enum('Transportasi','Hotel') NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `metode_pembayaran` enum('Transfer Bank','E-Wallet','Kartu Kredit','QRIS') NOT NULL,
  `jumlah_bayar` bigint(20) NOT NULL,
  `tanggal_bayar` datetime NOT NULL,
  `status_pembayaran` enum('Berhasil','Gagal','Pending') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_hotel`
--

CREATE TABLE `pemesanan_hotel` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `tanggal_checkin` date NOT NULL,
  `tanggal_checkout` date NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `total_harga` bigint(20) NOT NULL,
  `status_booking` enum('Menunggu Pembayaran','Dibayar','Dibatalkan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_transportasi`
--

CREATE TABLE `pemesanan_transportasi` (
  `pemesanan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transport_id` int(11) NOT NULL,
  `tanggal_pemesanan` datetime NOT NULL,
  `jumlah_tiket` int(11) NOT NULL,
  `total_harga` bigint(20) NOT NULL,
  `status_pemesanan` enum('Menunggu Pembayaran','Dibayar','Dibatalkan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transportasi`
--

CREATE TABLE `transportasi` (
  `transportasi_id` int(11) NOT NULL,
  `jenis_transportasi` enum('Bus','Perahu','Pesawat') NOT NULL,
  `jadwal_berangkat` datetime NOT NULL,
  `jadwal_tiba` datetime NOT NULL,
  `harga` int(11) NOT NULL,
  `kapaasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(250) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `NIK` bigint(17) NOT NULL,
  `profile_picture` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `destinasi_wisata`
--
ALTER TABLE `destinasi_wisata`
  ADD PRIMARY KEY (`destinasi_id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`pembayaran_id`),
  ADD KEY `user_pembayaran` (`user_id`);

--
-- Indexes for table `pemesanan_hotel`
--
ALTER TABLE `pemesanan_hotel`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `user_hotel` (`user_id`);

--
-- Indexes for table `pemesanan_transportasi`
--
ALTER TABLE `pemesanan_transportasi`
  ADD PRIMARY KEY (`pemesanan_id`),
  ADD KEY `transportasi_id` (`transport_id`),
  ADD KEY `user_transportasi` (`user_id`);

--
-- Indexes for table `transportasi`
--
ALTER TABLE `transportasi`
  ADD PRIMARY KEY (`transportasi_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `user_pembayaran` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan_hotel`
--
ALTER TABLE `pemesanan_hotel`
  ADD CONSTRAINT `hotel_id` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_hotel` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `pemesanan_transportasi`
--
ALTER TABLE `pemesanan_transportasi`
  ADD CONSTRAINT `transportasi_id` FOREIGN KEY (`transport_id`) REFERENCES `transportasi` (`transportasi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_transportasi` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
