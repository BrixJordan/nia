-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2024 at 07:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nia`
--

-- --------------------------------------------------------

--
-- Table structure for table `stickers`
--

CREATE TABLE `stickers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_no` varchar(255) NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `model_no` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `acquisition_date` date NOT NULL,
  `acquisition_cost` decimal(10,2) NOT NULL,
  `accountable` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `qr_code_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stickers`
--

INSERT INTO `stickers` (`id`, `property_no`, `serial_no`, `model_no`, `description`, `acquisition_date`, `acquisition_cost`, `accountable`, `created_at`, `updated_at`, `image_path`, `qr_code_path`) VALUES
(2, 'sample', 'samjksajd', 'hjksasdhjksadj', 'hjkdsahjksjadh', '2020-11-11', 20000.00, 'sample person', '2024-10-20 19:42:30', '2024-10-20 19:42:30', 'images/Xlmjux8jZnIuos0JbEG4Qsx1yMmpplFVIiVXPZKg.jpg', 'images/qrcodes/1729482150.png'),
(3, 'sampleee', 'samplenaa', 'ksasjkd', 'jkdjsda', '1111-10-10', 60000.00, 'jorda', '2024-10-20 21:41:05', '2024-10-20 21:41:05', 'images/KkMAKebdL4UrW231GJSStOxcaAy6Z5AJ6j0y0gmc.jpg', 'images/qrcodes/1729489265.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stickers`
--
ALTER TABLE `stickers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stickers`
--
ALTER TABLE `stickers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
