-- DROP and CREATE for table `users`
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(255) DEFAULT NULL,
  `email` VARCHAR(255) DEFAULT NULL,
  `password` VARCHAR(255) DEFAULT NULL,
  `role` ENUM('user','admin','ruler') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` VALUES
  (1,'Muhammad Thoriqul Kirom','thoriqul29@gmail.com','c2b047327c0ef9e1aa5932b9221fcfa0ff9db13be1f2daf6b3bb5e01aa40df74','user'),
  (2,'Admin 1','admin1@gmail.com','6384ebf19658233b52aa822a94ab2536b6badc16458acd43f7f7053ed0106831','admin'),
  (3,'User 2','user2@gmail.com','6384ebf19658233b52aa822a94ab2536b6badc16458acd43f7f7053ed0106831','user'),
  (4,'ruler 3','ruler3@gmail.com','6384ebf19658233b52aa822a94ab2536b6badc16458acd43f7f7053ed0106831','ruler'),
  (5,'Rizki Abdurahman','abdurahmanrizki240@gmail.com','fb1d75db0317a28f12a706806cd64ce269f4c33999c9cc371dade0cee1553aee','ruler'),
  (6,'M. Rizki','mrizkijoc@gmail.com','fb1d75db0317a28f12a706806cd64ce269f4c33999c9cc371dade0cee1553aee','admin');

  -- DROP and CREATE for table `rs_list`
DROP TABLE IF EXISTS `rs_list`;
CREATE TABLE `rs_list` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `Nama_RS` VARCHAR(120) NOT NULL,
  `Jalan` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rs_list` VALUES
  (1,'Charitas','Jl. Jend. Sudirman'),
  (2,'Siti Khadijah','Jl. Demang Lebar Daun'),
  (3,'Umum Mohammad Hoesin','Jl. Jend. Sudirman'),
  (4,'Siloam','Jl. POM IX'),
  (5,'Bunda','Jl. Demang Lebar Daun'),
  (6,'Umum Hermina Palembang','Jl. Jend. Basuki Rachmat'),
  (7,'Umum Hermina OPI Jakabaring','Jl. Gubernur H. A Bastari');

-- DROP and CREATE for table `form_data`
DROP TABLE IF EXISTS `form_data`;
CREATE TABLE `form_data` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nama_lengkap` VARCHAR(70) NOT NULL,
  `nama_keluarga` VARCHAR(70) NOT NULL,
  `np` BIGINT NOT NULL,
  `email` VARCHAR(80) NOT NULL,
  `umur` INT NOT NULL,
  `jenis_kelamin` ENUM('Laki-laki','Perempuan') NOT NULL,
  `jenjang_jabatan` VARCHAR(70) NOT NULL,
  `rs_id` INT NOT NULL,
  `created_by` INT DEFAULT NULL,
  `status` ENUM('Menunggu','Terverifikasi','Disetujui','Ditolak','Tertandatangan') NOT NULL DEFAULT 'Menunggu',
  `verified_at` DATETIME DEFAULT NULL,
  `approved_at` DATETIME DEFAULT NULL,
  `qr_token` VARCHAR(32) DEFAULT NULL,
  `created_at` DATETIME NOT NULL,
  `signed_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rs` (`rs_id`),
  KEY `fk_formdata_user` (`created_by`),
  CONSTRAINT `fk_formdata_user` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_rs` FOREIGN KEY (`rs_id`) REFERENCES `rs_list`(`ID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `form_data` VALUES
  (27,'Muhammad Hafiz','Nabila Adzra',6392736016,'thoriqul29@gmail.com',22,'Laki-laki','Humas /Mahasiswa Magang',3,1,'Tertandatangan','2025-06-01 05:57:20','2025-06-01 06:05:55','a5c068bca68dd2108e3a058faa3a02d7','2025-06-01 12:52:26','2025-06-01 14:06:26'),
  (28,'Chesya Waliana','Bintang Ramadhan',7381647291,'thoriqul29@gmail.com',21,'Perempuan','Humas /Mahasiswa Magang',2,1,'Tertandatangan','2025-06-01 05:57:40','2025-06-01 06:06:07','49303d180a6da13766fe516432d6fd89','2025-06-01 12:53:32','2025-06-01 14:45:33'),
  (35,'M Rizki','Rizki Abdurahman',6283242342,'thoriqul29@gmail.com',22,'Laki-laki','Mahasiswa Magang/Humas',5,1,'Tertandatangan','2025-06-04 14:14:05','2025-06-04 14:16:47','000bbbf744e682db6805da79a1620e6e','2025-06-04 14:10:10','2025-06-04 14:18:59'),
  (36,'Riwandi Apridiansyah','Fahmi Zaki Muhammad',9734692374,'thoriqul29@gmail.com',1500,'Laki-laki','Asisten Manajer Keuangan/ Mahasiswa Magang',4,1,'Ditolak','2025-06-04 14:24:54','2025-06-04 14:28:45',NULL,'2025-06-04 14:21:24',NULL),
  (37,'Muhammad Thoriqul Kirom','Muhammad Hanif',6224083316,'thoriqul29@gmail.com',123,'Laki-laki','Humas/ Mahasiswa Magang',1,1,'Terverifikasi','2025-06-05 04:31:11',NULL,NULL,'2025-06-05 04:26:30',NULL),
  (39,'fix timezone','tatatatatatata',1263527162,'thoriqul29@gmail.com',33,'Laki-laki','Asisten Manajer Keuangan/ Mahasiswa Magang',4,1,'Menunggu',NULL,NULL,NULL,'2025-06-05 04:46:14',NULL);

-- DROP and CREATE for table `migrations`
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` VARCHAR(255) NOT NULL,
  `class` VARCHAR(255) NOT NULL,
  `group` VARCHAR(255) NOT NULL,
  `namespace` VARCHAR(255) NOT NULL,
  `time` INT NOT NULL,
  `batch` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- (No data to insert into `migrations`)

-- DROP and CREATE for table `notifications`
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `type` VARCHAR(50) NOT NULL,
  `data` TEXT NOT NULL,
  `is_read` TINYINT(1) NOT NULL DEFAULT '0',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user` (`user_id`),
  CONSTRAINT `fk_notifications_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `notifications` VALUES
  (12,6,'form_submitted','{"form_id":25,"pemohon_id":"1","nama_lengkap":"Muhammad Thoriqul Kirom","nama_keluarga":"Muhammad Hanif","rs_id":"4"}',1,'2025-05-31 13:21:03','2025-05-31 13:21:14'),
  (13,4,'form_verified','{"form_id":"25","nama_lengkap":"Muhammad Thoriqul Kirom","nama_keluarga":"Muhammad Hanif","nama_rs":"Siloam"}',0,'2025-05-31 13:31:53',NULL),
  (14,5,'form_verified','{"form_id":"25","nama_lengkap":"Muhammad Thoriqul Kirom","nama_keluarga":"Muhammad Hanif","nama_rs":"Siloam"}',1,'2025-05-31 13:31:53','2025-05-31 13:35:34'),
  (18,6,'form_submitted','{"form_id":26,"pemohon_id":"1","nama_lengkap":"zfgxfg","nama_keluarga":"sgrvxfgz","rs_id":"5"}',1,'2025-05-31 21:36:59','2025-06-04 14:11:49'),
  (20,6,'form_submitted','{"form_id":27,"pemohon_id":"1","nama_lengkap":"Muhammad Hafiz","nama_keluarga":"Nabila Adzra","rs_id":"3"}',1,'2025-06-01 05:52:26','2025-06-04 14:11:49'),
  (22,6,'form_submitted','{"form_id":28,"pemohon_id":"1","nama_lengkap":"Chesya Waliana","nama_keluarga":"Bintang Ramadhan","rs_id":"2"}',1,'2025-06-01 05:53:32','2025-06-04 14:11:49'),
  (24,6,'form_submitted','{"form_id":29,"pemohon_id":"1","nama_lengkap":"Suliwa Ahwali Saymona","nama_keluarga":"Adam Paris Dinan","rs_id":"7"}',1,'2025-06-01 05:54:17','2025-06-04 14:11:49'),
  (26,6,'form_submitted','{"form_id":30,"pemohon_id":"1","nama_lengkap":"Rizki Abdurahman","nama_keluarga":"M. Rizki","rs_id":"7"}',1,'2025-06-01 05:54:55','2025-06-04 14:11:49'),
  (27,4,'form_verified','{"form_id":"26","nama_lengkap":"zfgxfg","nama_keluarga":"sgrvxfgz","nama_rs":"Bunda"}',0,'2025-06-01 05:56:56',NULL),
  (28,5,'form_verified','{"form_id":"26","nama_lengkap":"zfgxfg","nama_keluarga":"sgrvxfgz","nama_rs":"Bunda"}',0,'2025-06-01 05:56:56',NULL),
  (29,4,'form_verified','{"form_id":"27","nama_lengkap":"Muhammad Hafiz","nama_keluarga":"Nabila Adzra","nama_rs":"Umum Mohammad Hoesin"}',0,'2025-06-01 05:57:20',NULL),
  (30,5,'form_verified','{"form_id":"27","nama_lengkap":"Muhammad Hafiz","nama_keluarga":"Nabila Adzra","nama_rs":"Umum Mohammad Hoesin"}',0,'2025-06-01 05:57:20',NULL),
  (31,4,'form_verified','{"form_id":"28","nama_lengkap":"Chesya Waliana","nama_keluarga":"Bintang Ramadhan","nama_rs":"Siti Khadijah"}',0,'2025-06-01 05:57:40',NULL),
  (32,5,'form_verified','{"form_id":"28","nama_lengkap":"Chesya Waliana","nama_keluarga":"Bintang Ramadhan","nama_rs":"Siti Khadijah"}',0,'2025-06-01 05:57:40',NULL),
  (33,4,'form_verified','{"form_id":"30","nama_lengkap":"Rizki Abdurahman","nama_keluarga":"M. Rizki","nama_rs":"Umum Hermina OPI Jakabaring"}',0,'2025-06-01 05:58:13',NULL),
  (34,5,'form_verified','{"form_id":"30","nama_lengkap":"Rizki Abdurahman","nama_keluarga":"M. Rizki","nama_rs":"Umum Hermina OPI Jakabaring"}',1,'2025-06-01 05:58:13','2025-06-04 14:28:24'),
  (45,6,'form_submitted','{"form_id":31,"pemohon_id":"3","nama_lengkap":"Zahrani Della","nama_keluarga":"Adelia Zevira","rs_id":"2"}',1,'2025-06-02 00:15:23','2025-06-04 14:11:49'),
  (46,4,'form_verified','{"form_id":"31","nama_lengkap":"Zahrani Della","nama_keluarga":"Adelia Zevira","nama_rs":"Siti Khadijah"}',0,'2025-06-02 00:19:12',NULL),
  (47,5,'form_verified','{"form_id":"31","nama_lengkap":"Zahrani Della","nama_keluarga":"Adelia Zevira","nama_rs":"Siti Khadijah"}',0,'2025-06-02 00:19:12',NULL),
  (49,6,'form_submitted','{"form_id":32,"pemohon_id":"1","nama_lengkap":"tes satu dua","nama_keluarga":"tiga empat","rs_id":"2"}',1,'2025-06-02 10:27:47','2025-06-04 14:11:49'),
  (50,4,'form_verified','{"form_id":"32","nama_lengkap":"tes satu dua","nama_keluarga":"tiga empat","nama_rs":"Siti Khadijah"}',0,'2025-06-02 10:32:28',NULL),
  (51,5,'form_verified','{"form_id":"32","nama_lengkap":"tes satu dua","nama_keluarga":"tiga empat","nama_rs":"Siti Khadijah"}',0,'2025-06-02 10:32:28',NULL),
  (55,6,'form_submitted','{"form_id":33,"pemohon_id":"1","nama_lengkap":"Amba","nama_keluarga":"Singh","rs_id":"6"}',1,'2025-06-03 00:05:03','2025-06-04 14:11:49'),
  (58,3,'form_approved','{"form_id":"31","nama_lengkap":"Zahrani Della","nama_keluarga":"Adelia Zevira","nama_rs":"Siti Khadijah"}',0,'2025-06-04 09:37:06',NULL),
  (59,4,'form_verified','{"form_id":"33","nama_lengkap":"Amba","nama_keluarga":"Singh","nama_rs":"Umum Hermina Palembang"}',0,'2025-06-04 13:56:26',NULL),
  (60,5,'form_verified','{"form_id":"33","nama_lengkap":"Amba","nama_keluarga":"Singh","nama_rs":"Umum Hermina Palembang"}',0,'2025-06-04 13:56:26',NULL),
  (61,4,'form_verified','{"form_id":"33","nama_lengkap":"Amba","nama_keluarga":"Singh","nama_rs":"Umum Hermina Palembang"}',0,'2025-06-04 13:56:30',NULL),
  (62,5,'form_verified','{"form_id":"33","nama_lengkap":"Amba","nama_keluarga":"Singh","nama_rs":"Umum Hermina Palembang"}',0,'2025-06-04 13:56:30',NULL),
  (64,6,'form_submitted','{"form_id":35,"pemohon_id":"1","nama_lengkap":"M Rizki","nama_keluarga":"Rizki Abdurahman","rs_id":"5"}',1,'2025-06-04 14:10:10','2025-06-04 14:11:41'),
  (65,4,'form_verified','{"form_id":"35","nama_lengkap":"M Rizki","nama_keluarga":"Rizki Abdurahman","nama_rs":"Bunda"}',0,'2025-06-04 14:14:05',NULL),
  (66,5,'form_verified','{"form_id":"35","nama_lengkap":"M Rizki","nama_keluarga":"Rizki Abdurahman","nama_rs":"Bunda"}',1,'2025-06-04 14:14:05','2025-06-04 14:28:03'),
  (70,6,'form_submitted','{"form_id":36,"pemohon_id":"1","nama_lengkap":"Riwandi Apridiansyah","nama_keluarga":"Fahmi Zaki Muhammad","rs_id":"4"}',1,'2025-06-04 14:21:24','2025-06-04 14:22:20'),
  (71,4,'form_verified','{"form_id":"36","nama_lengkap":"Riwandi Apridiansyah","nama_keluarga":"Fahmi Zaki Muhammad","nama_rs":"Siloam"}',0,'2025-06-04 14:24:54',NULL),
  (72,5,'form_verified','{"form_id":"36","nama_lengkap":"Riwandi Apridiansyah","nama_keluarga":"Fahmi Zaki Muhammad","nama_rs":"Siloam"}',1,'2025-06-04 14:24:54','2025-06-04 14:28:19'),
  (75,6,'form_submitted','{"form_id":37,"pemohon_id":"1","nama_lengkap":"Muhammad Thoriqul Kirom","nama_keluarga":"Muhammad Hanif","rs_id":"1"}',0,'2025-06-05 04:26:30',NULL),
  (76,4,'form_verified','{"form_id":"37","nama_lengkap":"Muhammad Thoriqul Kirom","nama_keluarga":"Muhammad Hanif","nama_rs":"Charitas"}',0,'2025-06-05 04:31:11',NULL),
  (77,5,'form_verified','{"form_id":"37","nama_lengkap":"Muhammad Thoriqul Kirom","nama_keluarga":"Muhammad Hanif","nama_rs":"Charitas"}',0,'2025-06-05 04:31:11',NULL),
  (78,2,'form_submitted','{"form_id":38,"pemohon_id":"1","nama_lengkap":"tes timezone","nama_keluarga":"timezone","rs_id":"7"}',0,'2025-06-05 04:32:15',NULL),
  (79,6,'form_submitted','{"form_id":38,"pemohon_id":"1","nama_lengkap":"tes timezone","nama_keluarga":"timezone","nama_rs":null}',0,'2025-06-05 04:32:15',NULL),
  (80,2,'form_submitted','{"form_id":39,"pemohon_id":"1","nama_lengkap":"fix timezone","nama_keluarga":"tatatatatatata","rs_id":"4"}',0,'2025-06-05 04:46:15',NULL),
  (81,6,'form_submitted','{"form_id":39,"pemohon_id":"1","nama_lengkap":"fix timezone","nama_keluarga":"tatatatatatata","rs_id":"4"}',0,'2025-06-05 04:46:15',NULL);

-- DROP and CREATE for table `password_resets`
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(64) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`email`,`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `password_resets` VALUES
  ('mrizkijoc@gmail.com','ae8e5c4a941ac9de8d4dcccb40397bf18f8a9075bda034d6a9eb9c255250d55f','2025-06-02 01:44:52');



-- DROP and CREATE for table `user_tokens`
DROP TABLE IF EXISTS `user_tokens`;
CREATE TABLE `user_tokens` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `expires_at` DATETIME NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_token` (`token`),
  KEY `idx_user_id` (`user_id`),
  CONSTRAINT `fk_user_tokens_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- (No data to insert into `user_tokens`)



-- CREATE TRIGGER for hashing `users.password` before insert
DELIMITER //
CREATE TRIGGER `before_insert_users`
BEFORE INSERT ON `users`
FOR EACH ROW
BEGIN
  SET NEW.password = SHA2(NEW.password, 256);
END;
//
DELIMITER ;
