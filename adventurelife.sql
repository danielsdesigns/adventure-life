-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 25, 2022 at 04:59 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adventurelife`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

DROP TABLE IF EXISTS `calendar`;
CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `start` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `end` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `updated_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `deleted_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `user_id`, `start`, `end`, `title`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '05/26/2022, 12:00 PM', '', 'Admin Event', 'This is only visible to Admin', '1653454014', '1653454014', NULL),
(2, 2, '05/27/2022, 12:05 PM', '', 'for Daniel', 'this Event is only visible to Daniel and Admin', '1653454048', '1653454048', NULL),
(3, 3, '05/28/2022, 12:00 PM', '05/28/2022, 12:30 PM', 'for Adam', 'This event is only visible to Adam and Admin', '1653454117', '1653454117', NULL),
(4, 1, '05/25/2022, 12:50 PM', '06/18/2022, 12:50 PM', 'A longgg event', 'this is a sample of a longgg event', '1653454232', '1653454232', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `updated_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci NOT NULL,
  `deleted_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_german2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `is_admin`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@adlife.com', 'Admin', '$2y$10$yWyEHKpI7oe9f22MsFz4SuqIkhMZC3Z8Kz7mO6V7owbPo7R9x/sSu', 1, '', '', NULL),
(2, 'daniel@adlife.com', 'Daniel Dumas', '$2y$10$yWyEHKpI7oe9f22MsFz4SuqIkhMZC3Z8Kz7mO6V7owbPo7R9x/sSu', 0, '', '', NULL),
(3, 'adam@adlife.com', 'Adam Santos', '$2y$10$yWyEHKpI7oe9f22MsFz4SuqIkhMZC3Z8Kz7mO6V7owbPo7R9x/sSu', 0, '', '', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
