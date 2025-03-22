-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 18, 2025 at 09:16 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `construction_mgmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Cement'),
(2, 'Steel'),
(3, 'Bricks'),
(4, 'Machinery'),
(5, 'Safety Equipment');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `model` varchar(100) NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `quantity` int NOT NULL,
  `condition_status` enum('New','Used','Damaged') NOT NULL,
  `purchase_date` date NOT NULL,
  `site_id` int NOT NULL,
  `assigned_to` int DEFAULT NULL,
  `status` enum('Available','In Use','Under Maintenance') NOT NULL DEFAULT 'Available',
  `last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `site_id` (`site_id`),
  KEY `assigned_to` (`assigned_to`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_name`, `category_id`, `model`, `serial_no`, `quantity`, `condition_status`, `purchase_date`, `site_id`, `assigned_to`, `status`, `last_updated`) VALUES
(1, 'Cement Bags', 1, '', '', 30, 'New', '0000-00-00', 0, NULL, 'Available', '2025-02-18 21:15:07'),
(2, 'Steel Rods', 2, '', '', 10, 'New', '0000-00-00', 0, NULL, 'Available', '2025-02-18 21:15:07'),
(3, 'Bricks', 3, '', '', 80, 'New', '0000-00-00', 0, NULL, 'Available', '2025-02-18 21:15:07'),
(4, 'Concrete Mixer', 4, '', '', 86, 'New', '0000-00-00', 0, NULL, 'Available', '2025-02-18 21:15:07'),
(5, 'Safety Helmets', 5, '', '', 0, 'New', '0000-00-00', 0, NULL, 'Available', '2025-02-18 21:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `budget` decimal(15,2) NOT NULL,
  `status` enum('Planned','In Progress','Completed','On Hold') NOT NULL,
  `site_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_locations`
--

DROP TABLE IF EXISTS `site_locations`;
CREATE TABLE IF NOT EXISTS `site_locations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `manager_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `site_locations`
--

INSERT INTO `site_locations` (`id`, `site_name`, `address`, `manager_id`) VALUES
(1, 'Project A Site', '123 Construction Ave, NY', NULL),
(2, 'Project B Site', '456 Industrial Road, CA', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

DROP TABLE IF EXISTS `workers`;
CREATE TABLE IF NOT EXISTS `workers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(191) NOT NULL,
  `assigned_site` int NOT NULL,
  `employment_type` enum('Full-Time','Contractor','Temporary') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `password` varchar(255) NOT NULL,
  `internal_desig_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `assigned_site` (`assigned_site`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`id`, `first_name`, `last_name`, `designation`, `phone`, `email`, `assigned_site`, `employment_type`, `status`, `password`, `internal_desig_id`) VALUES
(1, 'Admin', 'User', 'Admin', '9998887777', 'admin@example.com', 1, 'Full-Time', 'Active', 'Admin@123', 5),
(2, 'John', 'Doe', 'Coordinator', '9876543210', 'coordinator@example.com', 2, 'Full-Time', 'Active', 'Coord@456', 24),
(3, 'Alice', 'Smith', 'Engineer', '8765432109', 'alice@example.com', 3, 'Full-Time', 'Active', 'Alice@789', 10),
(4, 'Bob', 'Johnson', 'Technician', '7654321098', 'bob@example.com', 1, 'Contractor', 'Active', 'Bob@111', 15),
(5, 'Charlie', 'Brown', 'Supervisor', '6543210987', 'charlie@example.com', 2, 'Full-Time', 'Active', 'Charlie@222', 20);

-- --------------------------------------------------------

--
-- Table structure for table `work_logs`
--

DROP TABLE IF EXISTS `work_logs`;
CREATE TABLE IF NOT EXISTS `work_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `worker_id` int NOT NULL,
  `project_id` int NOT NULL,
  `task_description` text NOT NULL,
  `log_date` date NOT NULL,
  `hours_worked` decimal(5,2) NOT NULL,
  `status` enum('Pending','Completed','In Progress') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `worker_id` (`worker_id`),
  KEY `project_id` (`project_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
