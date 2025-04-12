/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE DATABASE IF NOT EXISTS `smartcash` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `smartcash`;

CREATE TABLE IF NOT EXISTS `all_spents_by_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `type_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `amount` double(8,2) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `all_spents_by_user_type_id_foreign` (`type_id`),
  KEY `all_spents_by_user_category_id_foreign` (`category_id`),
  CONSTRAINT `all_spents_by_user_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `spent_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `all_spents_by_user_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `type_spents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

INSERT INTO `all_spents_by_user` (`id`, `user_id`, `user_name`, `type_id`, `category_id`, `amount`, `date`) VALUES
	(2, 1, 'Stefania García', 1, 1, 20.00, '2025-01-21'),
	(4, 1, 'Stefania García', 1, 5, 11.00, '2025-01-02'),
	(5, 1, 'Stefania García', 1, 1, 10.00, '2025-02-25'),
	(6, 1, 'Stefania García', 1, 3, 20.00, '2025-02-25'),
	(7, 1, 'Stefania García', 2, 2, 41.95, '2025-02-04'),
	(9, 1, 'Stefania García', 1, 1, 0.00, '2025-02-13'),
	(10, 1, 'Stefania García', 1, 1, 35.00, '2025-02-13'),
	(12, 1, 'Stefania García', 1, 8, 11.00, '2025-02-12'),
	(14, 1, 'Stefania García', 1, 3, 20.00, '2025-03-12'),
	(15, 1, 'Stefania García', 2, 3, 100.00, '2025-03-12'),
	(16, 1, 'Stefania García', 1, 1, 20.00, '2025-03-12'),
	(18, 1, 'Stefania García', 2, 8, 20.00, '2025-04-08'),
	(19, 1, 'Stefania García', 1, 1, 10.00, '2025-04-01'),
	(24, 1, 'Stefania García', 1, 5, 1.00, '2025-04-24'),
	(32, 1, 'Stefania García', 1, 1, 3.00, '2025-04-01'),
	(34, 1, 'Stefania García', 1, 1, 1.00, '2025-04-08'),
	(37, 1, 'Stefania García', 2, 6, 10.00, '2025-04-11'),
	(38, 1, 'Stefania García', 1, 2, 1.00, '2025-04-11'),
	(39, 1, 'Stefania García', 2, 2, 1.00, '2025-04-11'),
	(40, 1, 'Stefania García', 1, 2, 1.00, '2025-04-11'),
	(41, 1, 'Stefania García', 1, 2, 1.00, '2025-04-11'),
	(42, 1, 'Stefania García', 1, 2, 1.00, '2025-04-14'),
	(43, 1, 'Stefania García', 1, 8, 0.32, '2025-04-11');

CREATE TABLE IF NOT EXISTS `spent_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL DEFAULT '',
  `icon` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `spent_categories` (`id`, `name`, `user`, `color`, `icon`) VALUES
	(1, 'Events', 'web', '#9d50b5', 'fa-solid fa-champagne-glasses'),
	(2, 'Restaurants', 'web', '#ffb57f', 'fa-solid fa-utensils'),
	(3, 'Invoices', 'web', '#6bc6ff', 'fa-solid fa-receipt'),
	(5, 'Concert', '1', '#f8ff7f', 'fa-solid fa-music'),
	(6, 'Trading', '1', '#a5a5a5', 'fa-solid fa-chart-line'),
	(8, 'Book', '1', '#701b1b', 'fa-solid fa-book');

CREATE TABLE IF NOT EXISTS `type_spents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `type_spents` (`id`, `name`) VALUES
	(1, 'Expense'),
	(2, 'Income');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
