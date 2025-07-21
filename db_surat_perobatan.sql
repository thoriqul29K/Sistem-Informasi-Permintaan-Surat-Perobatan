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


-- DROP and CREATE for table `password_resets`
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(64) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


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
