-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 30, 2024 at 02:27 PM
-- Server version: 5.7.42-0ubuntu0.18.04.1
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_dynamic_menu`
--

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `page_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `page_id`, `created_at`, `updated_at`) VALUES
(1, 'Professional Display', 'professional-display', 1, NULL, NULL),
(2, 'Touch Displays/IFPD', 'touch-displaysifpd', 2, NULL, NULL),
(3, 'Indoor Active LED Video Walls', 'indoor-active-led-video-walls', 3, NULL, NULL),
(4, 'Meeting Room Solutions', 'meeting-room-solutions', 4, NULL, NULL),
(5, 'E Ink Solutions', 'e-ink-solutions', 5, NULL, NULL),
(6, 'Digital Signage', 'digital-signage', 6, NULL, NULL),
(7, 'AN SERIES', 'an-series', 7, NULL, NULL),
(8, 'CQ SERIES', 'cq-series', 8, NULL, NULL),
(9, 'CT SERIES', 'ct-series', 9, NULL, NULL),
(10, 'AIO SERIES', 'aio-series', 10, NULL, NULL),
(11, 'PEM SERIES', 'pem-series', 11, NULL, NULL),
(12, 'PER SERIES', 'per-series', 12, NULL, NULL),
(13, 'PVS SERIES', 'pvs-series', 13, NULL, NULL),
(14, 'PROMEET', 'promeet', 14, NULL, NULL),
(15, 'ESIGN CARD', 'esign-card', 15, NULL, NULL),
(16, 'ROOMBOOK+', 'roombook+', 16, NULL, NULL),
(17, 'Electronic Shelf Labels', 'electronic-self-labels', 17, NULL, NULL),
(18, 'QUEUE MANAGEMENT SYSTEM', 'queue-management-system', 18, NULL, NULL),
(19, 'SIGNEDGE BASIC', 'signedge-basic', 19, NULL, NULL),
(20, 'SIGNEDGE ENTERPRISE', 'signedge-enterprise', 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_parent_child`
--

CREATE TABLE `menu_parent_child` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_menu_id` bigint(20) UNSIGNED NOT NULL,
  `child_menu_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_parent_child`
--

INSERT INTO `menu_parent_child` (`id`, `parent_menu_id`, `child_menu_id`, `created_at`, `updated_at`) VALUES
(1, 1, 7, NULL, NULL),
(2, 1, 8, NULL, NULL),
(3, 2, 9, NULL, NULL),
(4, 3, 10, NULL, NULL),
(5, 3, 11, NULL, NULL),
(6, 3, 12, NULL, NULL),
(7, 3, 13, NULL, NULL),
(8, 4, 14, NULL, NULL),
(9, 4, 15, NULL, NULL),
(10, 4, 16, NULL, NULL),
(11, 5, 17, NULL, NULL),
(12, 5, 15, NULL, NULL),
(13, 5, 16, NULL, NULL),
(14, 6, 18, NULL, NULL),
(15, 6, 19, NULL, NULL),
(16, 6, 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Professional Display', 'Professional Display', 'professional-display', NULL, NULL),
(2, 'Touch Displays/IFPD', 'Touch Displays/IFPD', 'touch-displaysifpd', NULL, NULL),
(3, 'Indoor Active LED Video Walls', 'Indoor Active LED Video Walls', 'indoor-active-led-video-walls', NULL, NULL),
(4, 'Meeting Room Solutions', 'Meeting Room Solutions', 'meeting-room-solutions', NULL, NULL),
(5, 'E Ink Solutions', 'E Ink Solutions', 'e-ink-solutions', NULL, NULL),
(6, 'Digital Signage', 'Digital Signage', 'digital-signage', NULL, NULL),
(7, 'AN SERIES', 'AN SERIES', 'an-series', NULL, NULL),
(8, 'CQ SERIES', 'CQ SERIES', 'cq-series', NULL, NULL),
(9, 'CT SERIES', 'CT SERIES', 'ct-series', NULL, NULL),
(10, 'AIO SERIES', 'AIO SERIES', 'aio-series', NULL, NULL),
(11, 'PEM SERIES', 'PEM SERIES', 'pem-series', NULL, NULL),
(12, 'PER SERIES', 'PER SERIES', 'per-series', NULL, NULL),
(13, 'PVS SERIES', 'PVS SERIES', 'pvs-series', NULL, NULL),
(14, 'PROMEET', 'PROMEET', 'promeet', NULL, NULL),
(15, 'ESIGN CARD', 'ESIGN CARD', 'esign-card', NULL, NULL),
(16, 'ROOMBOOK+', 'ROOMBOOK+', 'roombook+', NULL, NULL),
(17, 'Electronic Shelf Labels', 'Electronic Shelf Labels', 'electronic-self-labels', NULL, NULL),
(18, 'QUEUE MANAGEMENT SYSTEM', 'QUEUE MANAGEMENT SYSTEM', 'queue-management-system', NULL, NULL),
(19, 'SIGNEDGE BASIC', 'SIGNEDGE BASIC', 'signedge-basic', NULL, NULL),
(20, 'SIGNEDGE ENTERPRISE', 'SIGNEDGE ENTERPRISE', 'signedge-enterprise', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_id` (`page_id`);

--
-- Indexes for table `menu_parent_child`
--
ALTER TABLE `menu_parent_child`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_menu_id` (`parent_menu_id`),
  ADD KEY `child_menu_id` (`child_menu_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `menu_parent_child`
--
ALTER TABLE `menu_parent_child`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `menu_parent_child`
--
ALTER TABLE `menu_parent_child`
  ADD CONSTRAINT `menu_parent_child_ibfk_1` FOREIGN KEY (`parent_menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_parent_child_ibfk_2` FOREIGN KEY (`child_menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
