-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.17-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for todo
CREATE DATABASE IF NOT EXISTS `todo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `todo`;

-- Dumping structure for table todo.lists
CREATE TABLE IF NOT EXISTS `lists` (
  `listID` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `listName` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdOn` int(11) DEFAULT NULL,
  `updatedOn` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `private` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`listID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table todo.list_items
CREATE TABLE IF NOT EXISTS `list_items` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT,
  `listID` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dueDate` int(11) DEFAULT NULL,
  `checked` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`itemID`),
  KEY `FK_list_items_lists` (`listID`),
  CONSTRAINT `FK_list_items_lists` FOREIGN KEY (`listID`) REFERENCES `lists` (`listID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
