-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: dbserver
-- Generation Time: Jan 05, 2026 at 12:02 PM
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
  `lokasi` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `kategori` enum('Alam','Budaya','Sejarah','Kuliner') NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinasi_wisata`
--

INSERT INTO `destinasi_wisata` (`destinasi_id`, `nama_destinasi`, `lokasi`, `deskripsi`, `kategori`, `foto`) VALUES
(16, 'Pusat Latihan Gajah Minas', 'Desa Minas Jaya, Kabupaten Siak, Riau', 'Pusat Latihan Gajah (PLG) Minas termasuk kategori\r\nwisata edukasi dan konservasi satwa liar, khususnya gajah Sumatera, yang menawarkan pengalaman berinteraksi langsung dengan gajah sambil mendukung upaya perlindungan hewan langka tersebut di Riau.', 'Budaya', '695aa8dc9ff52.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotel_id` int(11) NOT NULL,
  `nama_hotel` varchar(100) NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `url_hotel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotel_id`, `nama_hotel`, `lokasi`, `deskripsi`, `foto`, `url_hotel`) VALUES
(26, 'The Residence Bintan', 'Kampung Galang Batang, Kecamatan Gunung Kijang, Pulau Bintan, Kepulauan Riau', 'Bintan Luxury Resorts — Retreat to the Peaceful Seclusion of The Residence Bintan! Book Now &amp;amp; Save More. Digital Menu Options, Restaurant Seating at Reduced Capacities, Physical Distancing &amp;amp; More.', '695aa9db14cac.jpg', 'https://www.cenizaro.com/theresidence/bintan');

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

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int(11) NOT NULL,
  `dest_id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `rating` int(11) NOT NULL,
  `komentar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

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
  `profile_picture` varchar(250) NOT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `phone_number`, `profile_picture`, `role`) VALUES
(35, 'coba', 'coba12@gmail.com', '$2y$10$BYWRPsm/u9rNAtfAt1I7deWCHBEYeBiLIrmcQ4F/hgXfUpKEJnmgq', '0321302183', '69564c655e389.jpg', 'admin'),
(36, 'user', 'user12@gmail.com', '$2y$10$lHBDPZYnG.ceKUYsmRdIt.3pYq5GaKWWD01HqWubn2fk2b3GuuHsu', '01239323131', '69564e1946cfe.jpg', 'user'),
(38, 'Halo', 'halo23@gmail.com', '$2y$10$.RqEQcLSmlT8pinYAo08WeY2S39.7razyWWacw4VUHvd.T0N6jnOm', '02829101919', '69569c223321d.jpg', 'admin'),
(39, 'hanya', 'hanya12@gmail.com', '$2y$10$.wl6H18.iOQmg6FHk1CEGeJSO9ilFcVgvwCqkUhytMgsF7cbasX.W', '087152376125', '6957be84795a6.png', 'admin');

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
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `destinasi` (`dest_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `destinasi_wisata`
--
ALTER TABLE `destinasi_wisata`
  MODIFY `destinasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `pembayaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `user_pembayaran` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `destinasi` FOREIGN KEY (`dest_id`) REFERENCES `destinasi_wisata` (`destinasi_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
