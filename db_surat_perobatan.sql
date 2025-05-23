-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: sipsp-sipsp-e071.c.aivencloud.com    Database: db_surat_perobatan
-- ------------------------------------------------------
-- Server version	8.0.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '7e06016f-36ac-11f0-8d45-862ccfb07ae8:1-43,
e73fae39-36d4-11f0-a910-862ccfb00735:1-18';

--
-- Table structure for table `form_data`
--

DROP TABLE IF EXISTS `form_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `form_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_keluarga` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `np` int unsigned NOT NULL,
  `umur` int NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_general_ci NOT NULL,
  `jenjang_jabatan` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `rs_id` int NOT NULL,
  `rumah_sakit_dituju` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Menunggu','Terverifikasi','Disetujui','Ditolak') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Menunggu',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approved_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rs` (`rs_id`),
  CONSTRAINT `fk_rs` FOREIGN KEY (`rs_id`) REFERENCES `rs_list` (`ID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_data`
--

LOCK TABLES `form_data` WRITE;
/*!40000 ALTER TABLE `form_data` DISABLE KEYS */;
INSERT INTO `form_data` VALUES (21,'Muhammad Thoriqul Kirom','Muhammad Hanif',123456789,19,'Laki-laki','Mahasiswa Magang/Humas',7,'','Disetujui','2025-05-07 02:04:45','2025-05-07 02:52:39'),(26,'Fahmi Zaki Muhammad','Riwandi Apridiansyah',987654321,6543,'Perempuan','jhgfdvdzxgfgh',4,'','Ditolak','2025-05-07 07:18:44','2025-05-07 07:21:17'),(28,'Tessatu saja','Terus baru tes 2',1234567890,123,'Laki-laki','wefsfgdnf',5,'','Terverifikasi','2025-05-15 01:56:19','2025-05-19 08:55:13'),(29,'Rusdi','Imut',4294967295,1000,'Perempuan','barbershop amba ngawi',5,'','Disetujui','2025-05-19 02:40:28','2025-05-19 02:40:47'),(31,'uegaoefhaw','sdgfhmfdytds',1029384756,105,'Perempuan','AGgzfhmxukfhgsrdxvegEdg',1,'','Menunggu','2025-05-19 03:01:45','2025-05-19 04:56:02'),(32,'Allons','Enfants',784613582,805,'Laki-laki','Kwndjs',7,'','Terverifikasi','2025-05-22 08:04:13','2025-05-22 08:04:42');
/*!40000 ALTER TABLE `form_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rs_list`
--

DROP TABLE IF EXISTS `rs_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rs_list` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nama_RS` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `Jalan` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rs_list`
--

LOCK TABLES `rs_list` WRITE;
/*!40000 ALTER TABLE `rs_list` DISABLE KEYS */;
INSERT INTO `rs_list` VALUES (1,'Charitas','Jl. Jend. Sudirman'),(2,'Siti Khadijah','Jl. Demang Lebar Daun'),(3,'Umum Mohammad Hoesin','Jl. Jend. Sudirman'),(4,'Siloam','Jl. POM IX'),(5,'Bunda','Jl. Demang Lebar Daun'),(6,'Umum Hermina Palembang','Jl. Jend. Basuki Rachmat'),(7,'Umum Hermina OPI Jakabaring','Jl. Gubernur H. A Bastari');
/*!40000 ALTER TABLE `rs_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` enum('user','admin','ruler') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Muhammad Thoriqul Kirom','thoriqul29@gmail.com','c2b047327c0ef9e1aa5932b9221fcfa0ff9db13be1f2daf6b3bb5e01aa40df74','user'),(2,'Admin 1','admin1@gmail.com','6384ebf19658233b52aa822a94ab2536b6badc16458acd43f7f7053ed0106831','admin'),(3,'User 2','user2@gmail.com','6384ebf19658233b52aa822a94ab2536b6badc16458acd43f7f7053ed0106831','user'),(4,'ruler 3','ruler3@gmail.com','6384ebf19658233b52aa822a94ab2536b6badc16458acd43f7f7053ed0106831','ruler'),(5,'Rizki Abdurahman','abdurahmanrizki240@gmail.com','fb1d75db0317a28f12a706806cd64ce269f4c33999c9cc371dade0cee1553aee','user'),(6,'M. Rizki','mrizkijoc@gmail.com','fb1d75db0317a28f12a706806cd64ce269f4c33999c9cc371dade0cee1553aee','user');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`avnadmin`@`%`*/ /*!50003 TRIGGER `before_insert_users` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    SET NEW.password = SHA2(NEW.password, 256);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Dumping routines for database 'db_surat_perobatan'
--
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-22 15:22:50
