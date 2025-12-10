-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: dbserver
-- Generation Time: Dec 10, 2025 at 07:07 AM
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
  `rating` decimal(2,1) NOT NULL,
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
  `phone_number` varchar(20) DEFAULT NULL,
  `profile_picture` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `phone_number`, `profile_picture`) VALUES
(22, 'coba', 'coba12@gmail.com', '$2y$10$QIB6lEb9/Jet1gAi873sR.ZipXZR32144U4SXyUnHStcnMCWJqsoS', '2321321', '69343803ecabe.jpg'),
(23, 'apa', 'apa12@gmail.com', '$2y$10$HuMsCIzSLZMD2T3M6SdY1e/1B35GpMrtQ9CqB6Yeg57n39zgSeDNa', '32132131321', '6936289d411b7.png'),
(24, 'dafa', 'dafa13@gmail.com', '$2y$10$ENPZ61AKkgGloYdhzaaUiOUsD3nsR8LawUL.tuJtXpfGk1RSzCrQi', '023213892193', '69362fe582961.png'),
(25, 'coba13', 'coba24@gmail.com', '$2y$10$5QJ9Vakl1P00SbMaY1POu.GZe/QH9SISZHUa2Lw/JMt5Ss6T0sN8y', '0213213921093', '69366c2746c15.jpg'),
(26, 'coba44', 'coba44@gmail.com', '$2y$10$SQY5cG95y5gQlNMvj.6eKOJnBf3hxbcaFD5BtbTW7w3Rl1DlMXLyi', '023923021093', '69366f77f3dc9.jpg'),
(27, 'bani31', 'bani31@gmail.com', '$2y$10$icf7yTj/7tRQjwmI8m0uKuy4.roYGpY6sXoPIvHePHOdRJQ3Y/EDW', '02130213210', '6939002bb029e.jpg'),
(28, 'lagi', 'lagi@gmail.com', '$2y$10$OctiR3e4H6cUAK4Xq9ykkeGOldajg8JZ/hLY1RuG9iEn6fJGrC/Iu', '0213213213', '6939006dcaf64.png'),
(29, 'joja13', 'joja13@gmail.com', '$2y$10$80jSq4m/R6FKQzEVa7jexuQ4ptCUHg9PcR4nLHQKBwIM65YiVhRvC', '0321031', '693917b0d2e3c.png');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `user_pembayaran` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
