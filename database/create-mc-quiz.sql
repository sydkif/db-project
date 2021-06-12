-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table dbprojekt.mc_quiz
CREATE TABLE IF NOT EXISTS `mc_quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` varchar(8) DEFAULT NULL,
  `question` varchar(1000) DEFAULT NULL,
  `option_a` varchar(50) DEFAULT NULL,
  `option_b` varchar(50) DEFAULT NULL,
  `option_c` varchar(50) DEFAULT NULL,
  `option_d` varchar(50) DEFAULT NULL,
  `answer` char(50) DEFAULT NULL,
  `modiBy` varchar(50) DEFAULT NULL,
  `modiOn` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mc_subject` (`subject_id`),
  CONSTRAINT `fk_mc_subject` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
