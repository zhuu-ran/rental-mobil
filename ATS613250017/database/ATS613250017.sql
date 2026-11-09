-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for ats613250017
CREATE DATABASE IF NOT EXISTS `ats613250017` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ats613250017`;

-- Dumping structure for table ats613250017.member_017
CREATE TABLE IF NOT EXISTS `member_017` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(34) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `aktive` enum('1','0') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table ats613250017.member_017: ~3 rows (approximately)
DELETE FROM `member_017`;
INSERT INTO `member_017` (`id`, `email`, `password`, `nama`, `aktive`) VALUES
	(1, 'reza@gmail.com', '1234', 'reza', '1'),
	(2, 'valen@gnmail.com', '2345', 'valen', '1'),
	(3, 'rhabel@gmail.com', '3456', 'rhabel', '1');

-- Dumping structure for table ats613250017.mobil-017
CREATE TABLE IF NOT EXISTS `mobil-017` (
  `no_id` int NOT NULL AUTO_INCREMENT,
  `nomor_kendaraan` varchar(12) DEFAULT NULL,
  `jenis_kendaraan` enum('Sedan','Pickup','Truk','Bemo') DEFAULT NULL,
  `pemilik` varchar(50) DEFAULT NULL,
  `tahun_pembuatan` char(4) DEFAULT NULL,
  PRIMARY KEY (`no_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table ats613250017.mobil-017: ~0 rows (approximately)
DELETE FROM `mobil-017`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
