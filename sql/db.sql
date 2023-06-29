-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.28-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for todo
CREATE DATABASE IF NOT EXISTS `todo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `todo`;

-- Dumping structure for table todo.lists
CREATE TABLE IF NOT EXISTS `lists` (
  `listID` varchar(10) NOT NULL,
  `listName` varchar(50) DEFAULT NULL,
  `createdOn` datetime DEFAULT current_timestamp(),
  `updatedOn` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userID` int(11) DEFAULT NULL,
  `private` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`listID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table todo.lists: ~1 rows (approximately)
INSERT INTO `lists` (`listID`, `listName`, `createdOn`, `updatedOn`, `userID`, `private`) VALUES
	('lzncyx', 'test', '2023-05-29 04:44:25', '2023-05-29 04:44:25', NULL, 0);

-- Dumping structure for table todo.list_items
CREATE TABLE IF NOT EXISTS `list_items` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT,
  `listID` varchar(10) NOT NULL,
  `item` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `dueDate` date DEFAULT NULL,
  `checked` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`itemID`),
  KEY `FK_list_items_lists` (`listID`),
  CONSTRAINT `FK_list_items_lists` FOREIGN KEY (`listID`) REFERENCES `lists` (`listID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table todo.list_items: ~5 rows (approximately)
INSERT INTO `list_items` (`itemID`, `listID`, `item`, `description`, `dueDate`, `checked`) VALUES
	(39, 'lzncyx', '39', NULL, NULL, 0),
	(40, 'lzncyx', '40', NULL, NULL, 1),
	(41, 'lzncyx', '41', NULL, NULL, 1),
	(42, 'lzncyx', '42', NULL, NULL, 0),
	(43, 'lzncyx', '43', NULL, NULL, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
