-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2025 at 12:53 AM
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
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('Menunggu','Disetujui') DEFAULT 'Menunggu',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_data`
--

INSERT INTO `form_data` (`id`, `nama_lengkap`, `email`, `phone`, `nik`, `alamat`, `keterangan`, `status`, `created_at`) VALUES
(4, 'Fahmi Zaki Muhammad', 'fahmimen@gmail.com', '6282377126009', '01293102371312', 'Rumah Fahmi', 'Malas', 'Menunggu', '2025-03-18 05:20:11'),
(5, 'Muhammad Thoriqul Kirom', 'thoriqul29@gmail.com', '085832560838', '01293102371312', 'Jln Letnan Murod, Tlg Ratu, Lrg Sakura No 06', 'Sakit', 'Menunggu', '2025-03-18 05:31:00'),
(6, 'adawdawfaf', 'awdahwdi@gmail.com', '8923743414', '13431412341351', 'teas', 'afawdg', 'Menunggu', '2025-03-18 05:51:00'),
(9, 'tessatu', 'thoriqul29@gmail.com', '98765432345', '13431412341351', 'df', 'aef', 'Menunggu', '2025-03-18 06:19:54'),
(10, 'Riwandi Gaming', 'riwandiapridiansyah@gmail.com', '085832560838', '982734928374982', 'Jalan Sungai Sahang', 'Oke sajalah', 'Menunggu', '2025-03-18 07:32:04'),
(11, 'Riwandi Jawir', 'riwandiapridiansyah@gmail.com', '9012831023', '12313424512', 'tes', 'satu', 'Menunggu', '2025-03-18 23:31:40'),
(12, 'Fahmi men', 'fahmimen@gmail.com', '9283892939', '92747293791428', 'Mesir', 'Iejdiejeh', 'Menunggu', '2025-03-20 03:38:56'),
(13, 'Hafiz', 'hafiz@gmail.com', '828472838', '828472837', 'Jsbdh', 'Ududh', 'Menunggu', '2025-03-20 06:57:17');

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
(13, 'User 2', 'user2@gmail.com', '6384ebf19658233b52aa822a94ab2536b6badc16458acd43f7f7053ed0106831', 'user');

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
