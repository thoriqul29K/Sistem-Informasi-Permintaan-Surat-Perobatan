-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2025 at 06:43 AM
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(70) NOT NULL,
  `nama_keluarga` varchar(70) NOT NULL,
  `np` int(10) UNSIGNED NOT NULL,
  `umur` int(10) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `jenjang_jabatan` varchar(70) NOT NULL,
  `rs_id` int(11) NOT NULL,
  `rumah_sakit_dituju` varchar(50) NOT NULL,
  `status` enum('Menunggu','Terverifikasi','Disetujui','Ditolak') NOT NULL DEFAULT 'Menunggu',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approved_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rs` (`rs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_data`
--

INSERT INTO `form_data` (`id`, `nama_lengkap`, `nama_keluarga`, `np`, `umur`, `jenis_kelamin`, `jenjang_jabatan`, `rs_id`, `rumah_sakit_dituju`, `status`, `created_at`, `approved_at`) VALUES
(21, 'Muhammad Thoriqul Kirom', 'Muhammad Hanif', 123456789, 19, 'Laki-laki', 'Mahasiswa Magang/Humas', 7, '', 'Disetujui', '2025-05-07 02:04:45', '2025-05-07 02:52:39'),
(26, 'Fahmi Zaki Muhammad', 'Riwandi Apridiansyah', 987654321, 6543, 'Perempuan', 'jhgfdvdzxgfgh', 4, '', 'Ditolak', '2025-05-07 07:18:44', '2025-05-07 07:21:17'),
(28, 'Tessatu saja', 'Terus baru tes 2', 1234567890, 123, 'Laki-laki', 'wefsfgdnf', 5, '', 'Terverifikasi', '2025-05-15 01:56:19', '2025-05-19 08:55:13'),
(29, 'Rusdi', 'Imut', 4294967295, 1000, 'Perempuan', 'barbershop amba ngawi', 5, '', 'Disetujui', '2025-05-19 02:40:28', '2025-05-19 02:40:47'),
(31, 'uegaoefhaw', 'sdgfhmfdytds', 1029384756, 105, 'Perempuan', 'AGgzfhmxukfhgsrdxvegEdg', 1, '', 'Menunggu', '2025-05-19 03:01:45', '2025-05-19 04:56:02');

-- --------------------------------------------------------

--
-- Table structure for table `rs_list`
--

CREATE TABLE `rs_list` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `Nama_RS` varchar(120) NOT NULL,
  `Jalan` varchar(150) NOT NULL,
  PRIMARY KEY (`ID`)
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin','ruler') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`) VALUES
(1, 'Muhammad Thoriqul Kirom', 'thoriqul29@gmail.com', 'c2b047327c0ef9e1aa5932b9221fcfa0ff9db13be1f2daf6b3bb5e01aa40df74', 'user'),
(2, 'Admin 1', 'admin1@gmail.com', '6384ebf19658233b52aa822a94ab2536b6badc16458acd43f7f7053ed0106831', 'admin'),
(3, 'User 2', 'user2@gmail.com', '6384ebf19658233b52aa822a94ab2536b6badc16458acd43f7f7053ed0106831', 'user'),
(4, 'ruler 3', 'ruler3@gmail.com', '6384ebf19658233b52aa8221fcfa0ff&type替', 'ruler');

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
-- Foreign Key Constraints
--

ALTER TABLE `form_data`
  ADD CONSTRAINT `fk_rs` FOREIGN KEY (`rs_id`) REFERENCES `rs_list` (`ID`) ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
