-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2025 at 08:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_surat_perobatan`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_data`
--

CREATE TABLE `form_data` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(70) NOT NULL,
  `nama_keluarga` varchar(70) NOT NULL,
  `np` int(10) UNSIGNED NOT NULL,
  `umur` int(10) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `jenjang_jabatan` varchar(70) NOT NULL,
  `rs_id` int(11) NOT NULL,
  `rumah_sakit_dituju` varchar(50) NOT NULL,
  `status` enum('Menunggu','Disetujui') DEFAULT 'Menunggu',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approved_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_data`
--

INSERT INTO `form_data` (`id`, `nama_lengkap`, `nama_keluarga`, `np`, `umur`, `jenis_kelamin`, `jenjang_jabatan`, `rs_id`, `rumah_sakit_dituju`, `status`, `created_at`, `approved_at`) VALUES
(15, 'Yatim', 'Piatu', 123456789, 70, 'Perempuan', 'aeaefaegafa', 5, '', 'Disetujui', '2025-05-05 01:26:14', '2025-05-05 01:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `rs_list`
--

CREATE TABLE `rs_list` (
  `ID` int(2) NOT NULL,
  `Nama_RS` varchar(120) NOT NULL,
  `Jalan` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rs_list`
--

INSERT INTO `rs_list` (`ID`, `Nama_RS`, `Jalan`) VALUES
(1, 'Charitas', 'Jl. Jend. Sudirman'),
(2, 'Siti Khadijah', 'Jl. Demang Lebar Daun'),
(3, 'Umum Mohammad Hoesin', 'Jl. Jend. Sudirman'),
(4, 'Siloam', 'Jl. POM IX'),
(5, 'Bunda', 'Jl. Demang Lebar Daun'),
(6, 'Umum Hermina Palembang', 'Jl. Jend. Basuki Rachmat'),
(7, 'Umum Hermina OPI Jakabaring', 'Jl. Gubernur H. A Bastari');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`) VALUES
(10, 'Muhammad Thoriqul Kirom', 'thoriqul29@gmail.com', 'c2b047327c0ef9e1aa5932b9221fcfa0ff9db13be1f2daf6b3bb5e01aa40df74', 'user'),
(12, 'Admin 1', 'admin1@gmail.com', '6384ebf19658233b52aa822a94ab2536b6badc16458acd43f7f7053ed0106831', 'admin'),
(13, 'User 2', 'user2@gmail.com', '6384ebf19658233b52aa822a94ab2536b6badc16458acd43f7f7053ed0106831', 'user'),
(14, 'admin 3', 'admin3@gmail.com', '6384ebf19658233b52aa822a94ab2536b6badc16458acd43f7f7053ed0106831', 'admin');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `before_insert_users` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    SET NEW.password = SHA2(NEW.password, 256);
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_data`
--
ALTER TABLE `form_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rs` (`rs_id`);

--
-- Indexes for table `rs_list`
--
ALTER TABLE `rs_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_data`
--
ALTER TABLE `form_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rs_list`
--
ALTER TABLE `rs_list`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `form_data`
--
ALTER TABLE `form_data`
  ADD CONSTRAINT `fk_rs` FOREIGN KEY (`rs_id`) REFERENCES `rs_list` (`ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
