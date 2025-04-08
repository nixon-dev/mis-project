-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 07:30 AM
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
-- Database: `mis`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `document_title` varchar(255) NOT NULL,
  `document_origin` bigint(20) UNSIGNED NOT NULL,
  `document_nature` varchar(255) NOT NULL,
  `document_number` varchar(255) NOT NULL,
  `document_deadline` datetime DEFAULT NULL,
  `document_status` varchar(255) NOT NULL DEFAULT 'Draft',
  `pr` varchar(255) NOT NULL DEFAULT 'false',
  `canvass` varchar(255) NOT NULL DEFAULT 'false',
  `abstract` varchar(255) NOT NULL DEFAULT 'false',
  `obr` varchar(255) NOT NULL DEFAULT 'false',
  `po` varchar(255) NOT NULL DEFAULT 'false',
  `par` varchar(255) NOT NULL DEFAULT 'false',
  `air` varchar(255) NOT NULL DEFAULT 'false',
  `dv` varchar(255) NOT NULL DEFAULT 'false',
  `amount` float NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`document_id`, `document_title`, `document_origin`, `document_nature`, `document_number`, `document_deadline`, `document_status`, `pr`, `canvass`, `abstract`, `obr`, `po`, `par`, `air`, `dv`, `amount`, `created_at`, `updated_at`) VALUES
(2, 'To payment of ICT Equipment and Furniture and Fixtures for the MIS Unit', 2, 'Payment', '250319-00002', '2025-04-01 08:00:00', 'Approved', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 5313.53, '2025-02-19 08:11:24', '2025-04-01 13:48:58'),
(3, 'To reimburse', 4, 'Payment', '250319-00003', '2025-03-19 00:00:00', 'Pending', 'true', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 0, '2025-01-20 08:11:28', '2025-03-30 05:29:52'),
(6, 'Eviction Notice of Rhovin John Dulay', 2, 'Eviction Notice', '250320-00001', NULL, 'Denied', 'true', 'true', 'false', 'true', 'true', 'false', 'false', 'false', 3244.42, '2025-02-20 01:36:41', '2025-03-30 07:38:38'),
(16, 'Converge Bill', 2, 'Payment', '250325-00001', '2025-03-25 09:55:00', 'Approved', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 1923, '2025-01-25 01:55:24', '2025-04-08 02:53:36'),
(17, 'To reimburse', 3, 'Payment', '250327-00001', '2025-03-27 13:58:00', 'Pending', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 0, '2025-02-27 05:58:47', '2025-03-30 05:29:27'),
(19, 'Statement of Receipts and Expenditures', 4, 'Financial & Budgeting', '250330-00001', '2025-03-30 13:30:00', 'Pending', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 0, '2025-03-30 05:30:17', '2025-03-30 05:30:17'),
(20, 'Budget for IT Equipments', 3, 'Financial & Budgeting', '250330-00002', NULL, 'Pending', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 0, '2025-03-30 08:06:36', '2025-03-30 08:06:36'),
(22, 'The Temporary Name of a Fake Document', 1, 'Fake Document', '250331-00001', NULL, 'Approved', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 899250, '2025-01-06 06:47:46', '2025-04-01 10:20:05'),
(23, 'A fake document title', 1, 'Fake Document', '250401-00001', NULL, 'Denied', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 0, '2025-03-11 06:59:32', '2025-04-01 10:20:33'),
(24, 'Just another fake document', 1, 'Fake Document', '250401-00002', NULL, 'Pending', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 0, '2025-04-01 07:37:49', '2025-04-02 02:52:23'),
(25, '250401-00003', 1, 'Test', '250401-00003', NULL, 'Denied', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 0, '2025-02-05 07:43:50', '2025-04-01 11:01:42'),
(26, '250401-00004 <- should be', 1, 'Test', '250401-00004', NULL, 'Denied', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 0, '2025-04-01 07:44:07', '2025-04-01 10:34:58'),
(27, 'Test if Origin Office is working', 1, 'Test', '250401-00005', NULL, 'Approved', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 0, '2025-02-13 07:56:51', '2025-04-01 13:52:26'),
(28, 'To payment of Fake Equipment and Fake Furniture and Fake Fixtures for the Fake Office', 1, 'Fake Document', '250401-00006', NULL, 'Approved', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 0, '2025-04-01 10:21:37', '2025-04-01 13:20:39'),
(29, 'Fake Draft Document', 1, 'Fake Document', '250401-00007', NULL, 'Denied', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 0, '2025-04-01 13:14:44', '2025-04-01 14:01:06'),
(30, 'fsdggfhg', 2, 'gf', '250403-00001', NULL, 'Approved', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 3600, '2025-04-03 08:03:33', '2025-04-03 08:06:07'),
(31, 'Fake Docx for April 04, 2025', 2, 'Fake Document', '250408-00001', NULL, 'Draft', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 0, '2025-04-08 02:46:01', '2025-04-08 02:46:01');

-- --------------------------------------------------------

--
-- Table structure for table `document_attachments`
--

CREATE TABLE `document_attachments` (
  `da_id` bigint(20) UNSIGNED NOT NULL,
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `da_name` varchar(255) NOT NULL,
  `da_file_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_attachments`
--

INSERT INTO `document_attachments` (`da_id`, `document_id`, `da_name`, `da_file_type`) VALUES
(32, 20, 'file-sample_100kB_1743385718.docx', 'docx'),
(33, 22, 'index_1743169502_1743463148.docx', 'docx');

-- --------------------------------------------------------

--
-- Table structure for table `document_history`
--

CREATE TABLE `document_history` (
  `dh_id` bigint(20) UNSIGNED NOT NULL,
  `document_id` int(255) NOT NULL,
  `dh_name` varchar(255) NOT NULL,
  `dh_date` datetime NOT NULL DEFAULT current_timestamp(),
  `dh_action` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_history`
--

INSERT INTO `document_history` (`dh_id`, `document_id`, `dh_name`, `dh_date`, `dh_action`, `created_at`, `updated_at`) VALUES
(4, 16, 'Rhovin John Dulay', '2025-03-25 00:00:00', 'Prepared the documents', '2025-03-25 01:59:33', '2025-03-25 01:59:33'),
(5, 16, 'Mayor', '2025-03-27 00:00:00', 'Signed PR', '2025-03-27 06:03:29', '2025-03-27 06:03:29'),
(6, 17, 'Testt', '2025-03-27 00:00:00', 'TEst', '2025-03-27 06:14:23', '2025-03-27 06:14:23'),
(7, 16, 'Vice Mayor', '2025-03-29 00:00:00', 'Signed Canvass', '2025-03-29 09:25:28', '2025-03-29 09:25:28'),
(32, 22, 'Rhovin John Dulay', '2025-03-31 16:13:26', 'Signed PR', '2025-03-31 08:13:26', '2025-03-31 08:13:26'),
(33, 22, 'Rhovin John Dulay', '2025-03-31 16:13:28', 'Signed CANVASS', '2025-03-31 08:13:28', '2025-03-31 08:13:28'),
(34, 22, 'Rhovin John Dulay', '2025-03-31 16:13:31', 'Signed ABSTRACT', '2025-03-31 08:13:31', '2025-03-31 08:13:31'),
(35, 22, 'Rhovin John Dulay', '2025-03-31 16:13:34', 'Signed OBR', '2025-03-31 08:13:34', '2025-03-31 08:13:34'),
(36, 2, 'Budget Office Staff', '2025-03-31 16:35:29', 'Unsigned PR', '2025-03-31 08:35:29', '2025-03-31 08:35:29'),
(37, 2, 'Budget Office Staff', '2025-03-31 16:35:30', 'Signed PR', '2025-03-31 08:35:30', '2025-03-31 08:35:30'),
(38, 2, 'Budget Office Staff', '2025-03-31 16:35:36', 'Unsigned CANVASS', '2025-03-31 08:35:36', '2025-03-31 08:35:36'),
(39, 2, 'Budget Office Staff', '2025-03-31 16:35:36', 'Signed CANVASS', '2025-03-31 08:35:36', '2025-03-31 08:35:36'),
(40, 22, 'Rhovin John Dulay', '2025-04-01 07:18:17', 'Signed PO', '2025-03-31 23:18:17', '2025-03-31 23:18:17'),
(41, 22, 'Rhovin John Dulay', '2025-04-01 15:19:48', 'Signed PAR', '2025-04-01 07:19:48', '2025-04-01 07:19:48'),
(42, 22, 'Rhovin John Dulay', '2025-04-01 15:19:50', 'Signed AIR', '2025-04-01 07:19:50', '2025-04-01 07:19:50'),
(43, 22, 'Rhovin John Dulay', '2025-04-01 15:19:51', 'Signed DV', '2025-04-01 07:19:51', '2025-04-01 07:19:51'),
(44, 29, 'Admin', '2025-04-01 22:01:06', 'Signed PR', '2025-04-01 14:01:06', '2025-04-01 14:01:06'),
(45, 29, 'Admin', '2025-04-01 22:01:06', 'Unsigned PR', '2025-04-01 14:01:06', '2025-04-01 14:01:06'),
(46, 30, 'gfgf', '2025-04-03 16:04:00', 'Prepared Documents', '2025-04-03 08:04:30', '2025-04-03 08:04:30'),
(47, 16, 'Rhovin John Dulay', '2025-04-08 09:58:16', 'Unsigned PR', '2025-04-08 01:58:16', '2025-04-08 01:58:16'),
(48, 16, 'Rhovin John Dulay', '2025-04-08 09:58:18', 'Unsigned CANVASS', '2025-04-08 01:58:18', '2025-04-08 01:58:18'),
(49, 16, 'Rhovin John Dulay', '2025-04-08 09:58:20', 'Unsigned PO', '2025-04-08 01:58:20', '2025-04-08 01:58:20'),
(50, 16, 'Rhovin John Dulay', '2025-04-08 09:58:21', 'Unsigned OBR', '2025-04-08 01:58:21', '2025-04-08 01:58:21'),
(51, 16, 'Rhovin John Dulay', '2025-04-08 09:58:21', 'Unsigned PAR', '2025-04-08 01:58:21', '2025-04-08 01:58:21'),
(52, 16, 'Rhovin John Dulay', '2025-04-08 09:58:21', 'Unsigned ABSTRACT', '2025-04-08 01:58:21', '2025-04-08 01:58:21'),
(53, 16, 'Rhovin John Dulay', '2025-04-08 09:58:21', 'Unsigned AIR', '2025-04-08 01:58:21', '2025-04-08 01:58:21'),
(54, 16, 'Rhovin John Dulay', '2025-04-08 09:58:21', 'Unsigned DV', '2025-04-08 01:58:21', '2025-04-08 01:58:21'),
(55, 16, 'Rhovin John Dulay', '2025-04-08 09:58:25', 'Signed PR', '2025-04-08 01:58:25', '2025-04-08 01:58:25'),
(56, 16, 'Rhovin John Dulay', '2025-04-08 09:58:28', 'Signed CANVASS', '2025-04-08 01:58:28', '2025-04-08 01:58:28'),
(57, 16, 'Rhovin John Dulay', '2025-04-08 09:58:30', 'Signed ABSTRACT', '2025-04-08 01:58:30', '2025-04-08 01:58:30'),
(58, 16, 'Rhovin John Dulay', '2025-04-08 09:58:33', 'Signed OBR', '2025-04-08 01:58:33', '2025-04-08 01:58:33'),
(59, 16, 'Rhovin John Dulay', '2025-04-08 09:58:34', 'Signed PO', '2025-04-08 01:58:34', '2025-04-08 01:58:34'),
(60, 16, 'Rhovin John Dulay', '2025-04-08 09:58:34', 'Signed PAR', '2025-04-08 01:58:34', '2025-04-08 01:58:34'),
(61, 16, 'Rhovin John Dulay', '2025-04-08 09:58:34', 'Signed AIR', '2025-04-08 01:58:34', '2025-04-08 01:58:34'),
(62, 16, 'Rhovin John Dulay', '2025-04-08 09:58:35', 'Signed DV', '2025-04-08 01:58:35', '2025-04-08 01:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `document_items`
--

CREATE TABLE `document_items` (
  `di_id` bigint(20) UNSIGNED NOT NULL,
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `di_unit` varchar(255) NOT NULL,
  `di_description` text NOT NULL,
  `di_quantity` int(255) NOT NULL,
  `di_unit_price` float NOT NULL DEFAULT 0,
  `di_total_amount` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_items`
--

INSERT INTO `document_items` (`di_id`, `document_id`, `di_unit`, `di_description`, `di_quantity`, `di_unit_price`, `di_total_amount`) VALUES
(1, 16, 'unit', 'Steel Rack Cabinet (Steel Rack Cabinet for equipment storage)', 1, 0, 0),
(2, 16, 'Set', 'Printer', 3, 0, 0),
(3, 16, 'Unit', 'ccv', 6, 0, 0),
(4, 16, 'Set', 'asd', 1, 0, 0),
(5, 20, 'Set', 'Dulay', 8, 0, 0),
(6, 2, 'Unit', 'Keyboard', 2, 0, 0),
(13, 22, 'Unit', 'Fake Item', 23, 250, 5750),
(14, 22, 'Unit', 'Another Fake Item', 41, 3500, 143500),
(15, 22, 'Unit', 'Another One', 300, 2500, 750000),
(16, 30, 'Unit', 'keyb', 2, 300, 600),
(17, 30, 'Unit', 'jhgjh', 3, 1000, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `document_pending`
--

CREATE TABLE `document_pending` (
  `dp_id` bigint(20) UNSIGNED NOT NULL,
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `dp_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `dp_remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_pending`
--

INSERT INTO `document_pending` (`dp_id`, `document_id`, `dp_status`, `dp_remarks`, `created_at`, `updated_at`) VALUES
(1, 22, 'Approved', 'Document Approved', '2025-04-01 13:47:15', '2025-04-01 13:47:36'),
(3, 16, 'Approved', 'Goods', '2025-04-01 13:44:15', '2025-04-08 02:53:36'),
(4, 2, 'Approved', NULL, '2025-04-01 07:25:15', '2025-04-01 13:48:58'),
(5, 23, 'Denied', 'No attached file', '2025-04-01 07:25:15', '2025-04-01 07:36:47'),
(6, 26, 'Denied', 'Fake Document', '2025-04-01 10:20:59', '2025-04-01 10:34:58'),
(7, 25, 'Denied', 'Fake Documents', '2025-04-01 11:00:49', '2025-04-01 11:01:42'),
(8, 28, 'Approved', 'ZXC', '2025-04-01 13:20:19', '2025-04-01 13:20:39'),
(10, 29, 'Denied', 'Fake', '2025-04-01 13:42:06', '2025-04-01 13:51:53'),
(11, 27, 'Approved', 'Test Approve', '2025-04-01 13:52:13', '2025-04-01 13:52:26'),
(12, 24, 'Pending', NULL, '2025-04-02 02:52:23', '2025-04-02 02:52:23'),
(13, 30, 'Approved', 'ok', '2025-04-03 08:05:16', '2025-04-03 08:06:07');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` bigint(20) UNSIGNED NOT NULL,
  `history_name` varchar(255) NOT NULL,
  `history_action` text NOT NULL,
  `history_description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `history_name`, `history_action`, `history_description`, `created_at`, `updated_at`) VALUES
(2, 'Admin Name', 'Inserted Document', 'Eviction Notice of Rhovin John Dulay', '2025-03-24 08:21:05', '2025-03-24 08:21:05'),
(3, 'Admin Name', 'Deleted Document', 'Eviction Notice of Rhovin John Dulay', '2025-03-24 08:23:52', '2025-03-24 08:24:28'),
(4, 'Admin Name', 'Inserted Action for', 'To reimburse', '2025-03-24 08:27:46', '2025-03-24 08:27:46'),
(5, 'Admin', 'Inserted Document', 'Converge Bill', '2025-03-25 01:55:24', '2025-03-25 01:55:24'),
(6, 'Admin', 'Inserted Action for', 'Converge Bill', '2025-03-25 01:58:23', '2025-03-25 01:58:23'),
(7, 'Admin', 'Updated', 'Converge Bill', '2025-03-25 01:59:14', '2025-03-25 01:59:14'),
(8, 'Admin', 'Inserted Action for', 'Converge Bill', '2025-03-25 01:59:33', '2025-03-25 01:59:33'),
(9, 'MIS', 'Inserted Document', 'To reimburse', '2025-03-27 05:58:47', '2025-03-27 05:58:47'),
(10, 'staff', 'Inserted Action for', 'Converge Bill', '2025-03-27 06:03:29', '2025-03-27 06:03:29'),
(11, 'Admin', 'Inserted Action for', 'To reimburse', '2025-03-27 06:14:23', '2025-03-27 06:14:23'),
(12, 'Admin', 'Updated', 'To reimburse', '2025-03-27 06:15:00', '2025-03-27 06:15:00'),
(13, 'Admin', 'Updated', 'To reimburse', '2025-03-27 06:16:37', '2025-03-27 06:16:37'),
(14, 'Admin', 'Updated', 'To reimburse', '2025-03-27 06:17:07', '2025-03-27 06:17:07'),
(15, 'Admin', 'Updated', 'To reimburse', '2025-03-27 06:18:01', '2025-03-27 06:18:01'),
(16, 'Admin', 'Updated', 'To reimburse', '2025-03-27 06:18:19', '2025-03-27 06:18:19'),
(17, 'Admin', 'Updated', 'To reimburse', '2025-03-27 06:19:01', '2025-03-27 06:19:01'),
(18, 'Admin', 'Deleted Document', 'Converge Bill', '2025-03-27 08:04:23', '2025-03-27 08:04:23'),
(19, 'Admin', 'Added Items', 'Converge Bill', '2025-03-27 08:16:35', '2025-03-27 08:16:35'),
(20, 'Admin', 'Inserted Document', 'Statement of Receipts and Expenditures', '2025-03-29 07:31:39', '2025-03-29 07:31:39'),
(21, 'Admin', 'Deleted Document', 'Statement of Receipts and Expenditures', '2025-03-29 07:34:58', '2025-03-29 07:34:58'),
(22, 'Rhovin John Dulay', 'Updated', 'Converge Bill', '2025-03-29 09:15:08', '2025-03-29 09:15:08'),
(23, 'Rhovin John Dulay', 'Added Items', 'Converge Bill', '2025-03-29 09:15:20', '2025-03-29 09:15:20'),
(24, 'Rhovin John Dulay', 'Added Items', 'Converge Bill', '2025-03-29 09:25:07', '2025-03-29 09:25:07'),
(25, 'Rhovin John Dulay', 'Inserted Action for', 'Converge Bill', '2025-03-29 09:25:28', '2025-03-29 09:25:28'),
(26, 'Admin', 'Inserted Document', 'Statement of Receipts and Expenditures', '2025-03-30 05:30:17', '2025-03-30 05:30:17'),
(27, 'Admin', 'Inserted Document', 'Budget for IT Equipments', '2025-03-30 08:06:36', '2025-03-30 08:06:36'),
(28, 'Rhovin John Dulay', 'Inserted Document', 'Eviction Notice of Rhovin John Dulay', '2025-03-31 00:50:11', '2025-03-31 00:50:11'),
(29, 'Admin', 'Deleted Document', 'Eviction Notice of Rhovin John Dulay', '2025-03-31 01:47:08', '2025-03-31 01:47:08'),
(30, 'Admin', 'Added Items for', 'Budget for IT Equipments', '2025-03-31 03:20:04', '2025-03-31 03:20:04'),
(31, 'MIS', 'Added Items for', 'To payment of ICT Equipment and Furniture and Fixtures for the MIS Unit', '2025-03-31 03:35:41', '2025-03-31 03:35:41'),
(32, 'Rhovin John Dulay', 'Inserted Document', 'The Temporary Name of a Fake Document', '2025-03-31 06:47:46', '2025-03-31 06:47:46'),
(33, 'Rhovin John Dulay', 'Added Items for', 'The Temporary Name of a Fake Document', '2025-03-31 23:11:16', '2025-03-31 23:11:16'),
(34, 'Rhovin John Dulay', 'Added Items for', 'The Temporary Name of a Fake Document', '2025-03-31 23:16:20', '2025-03-31 23:16:20'),
(35, 'Rhovin John Dulay', 'Added Items for', 'The Temporary Name of a Fake Document', '2025-03-31 23:16:49', '2025-03-31 23:16:49'),
(36, 'Rhovin John Dulay', 'Added Items for', 'The Temporary Name of a Fake Document', '2025-03-31 23:17:38', '2025-03-31 23:17:38'),
(37, 'Rhovin John Dulay', 'Added Items for', 'The Temporary Name of a Fake Document', '2025-03-31 23:40:47', '2025-03-31 23:40:47'),
(38, 'Rhovin John Dulay', 'Added Items for', 'The Temporary Name of a Fake Document', '2025-03-31 23:47:28', '2025-03-31 23:47:28'),
(39, 'Rhovin John Dulay', 'Added Items for', 'The Temporary Name of a Fake Document', '2025-03-31 23:47:53', '2025-03-31 23:47:53'),
(40, 'Rhovin John Dulay', 'Added Items for', 'The Temporary Name of a Fake Document', '2025-03-31 23:48:17', '2025-03-31 23:48:17'),
(41, 'Rhovin John Dulay', 'Inserted Document', 'A fake document title', '2025-04-01 06:59:32', '2025-04-01 06:59:32'),
(42, 'Rhovin John Dulay', 'Inserted Document', 'Just another fake document', '2025-04-01 07:37:49', '2025-04-01 07:37:49'),
(43, 'Rhovin John Dulay', 'Inserted Document', '250401-00003', '2025-04-01 07:43:50', '2025-04-01 07:43:50'),
(44, 'Rhovin John Dulay', 'Inserted Document', '250401-00004 <- should be', '2025-04-01 07:44:07', '2025-04-01 07:44:07'),
(45, 'Rhovin John Dulay', 'Inserted Document', 'Test if Origin Office is working', '2025-04-01 07:56:51', '2025-04-01 07:56:51'),
(46, 'Rhovin John Dulay', 'Inserted Document', 'To payment of Fake Equipment and Fake Furniture and Fake Fixtures for the Fake Office', '2025-04-01 10:21:37', '2025-04-01 10:21:37'),
(47, 'Rhovin John Dulay', 'Inserted Document', 'Fake Draft Document', '2025-04-01 13:14:44', '2025-04-01 13:14:44'),
(48, 'staff', 'Inserted Document', 'fsdggfhg', '2025-04-03 08:03:33', '2025-04-03 08:03:33'),
(49, 'staff', 'Added Items for', 'fsdggfhg', '2025-04-03 08:04:01', '2025-04-03 08:04:01'),
(50, 'staff', 'Added Items for', 'fsdggfhg', '2025-04-03 08:04:15', '2025-04-03 08:04:15'),
(51, 'staff', 'Inserted Action for', 'fsdggfhg', '2025-04-03 08:04:30', '2025-04-03 08:04:30'),
(52, 'MIS Staff', 'Inserted Document', 'Fake Docx for April 04, 2025', '2025-04-08 02:46:01', '2025-04-08 02:46:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_16_145019_document', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `remarks` text DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `read_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `document_id`, `remarks`, `type`, `created_by`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 26, 'Fake Document', 'Denied', 1, '2025-04-01 21:21:20', '2025-04-01 10:34:58', '2025-04-01 13:21:20'),
(2, 25, 'Fake Documents', 'Denied', 1, '2025-04-01 21:21:18', '2025-04-01 11:01:42', '2025-04-01 13:21:18'),
(3, 28, 'ZXC', 'Approved', 1, '2025-04-01 21:21:17', '2025-04-01 13:20:39', '2025-04-01 13:21:17'),
(4, 2, NULL, 'Approved', 1, NULL, '2025-04-01 13:48:58', '2025-04-01 13:48:58'),
(5, 29, 'Fake', 'Denied', 1, '2025-04-08 10:09:51', '2025-04-01 13:51:53', '2025-04-08 02:09:51'),
(6, 27, 'Test Approve', 'Approved', 1, NULL, '2025-04-01 13:52:26', '2025-04-01 13:52:26'),
(7, 30, 'ok', 'Approved', 7, NULL, '2025-04-03 08:06:07', '2025-04-03 08:06:07'),
(8, 16, 'Goods', 'Approved', 1, NULL, '2025-04-08 02:53:36', '2025-04-08 02:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `office_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`office_id`, `office_name`) VALUES
(1, 'Budget Office'),
(2, 'Management Information System Office'),
(3, 'Procurement Office'),
(4, 'Accounting Office');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `responsibility_center`
--

CREATE TABLE `responsibility_center` (
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responsibility_center`
--

INSERT INTO `responsibility_center` (`code`, `name`) VALUES
('1011', 'Municipal Mayor\'s Office'),
('1012', 'Municipal Tourism Office'),
('1017', 'Municipal Disaster Risk & Mgt. Office'),
('1021', 'Municipal Vice Mayor / SB Office'),
('1041', 'Municipal Planning & Development Office'),
('1051', 'Municipal Civil Registrar\'s Office'),
('1071', 'Municipal Budget Office'),
('1081', 'Municipal Accounting Office'),
('1091', 'Municipal Treasurer\'s Office'),
('1101', 'Municipal Assessor\'s Office'),
('4411', 'Municipal Health Office'),
('7611', 'Municipal Social Welfare & Development Office'),
('8711', 'Municipal Agriculture Office'),
('8731', 'Municipal Environment & Natural Resources Office'),
('8751', 'Municipal Engineering Office');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` bigint(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('XeiL7yOlWqyiq2urJZ3pI7XhHU6WkQ1MoIVscmL0', 3, '192.168.100.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRXJHMDZXckJRVTBlVjlwWkEwY1RlMXB2VjdhUWE2YnVvU0wyaWpSVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xOTIuMTY4LjEwMC41Njo4MDAwL2FkbWluL25ldy1zZXR0aW5ncyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1744090015);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `budget_office` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `budget_office`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `unit_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`) VALUES
(1, 'Unit'),
(2, 'Set'),
(4, 'Liter'),
(6, 'Gallon');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `office_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Guest',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `office_id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rhovin John Dulay', 'rhovin.dulay@gmail.com', NULL, '$2y$12$3EWCkLKX4ZSl1dO8H9a4LuGUnM8bKKAuFQStBfiZDWOGZ4.TSAT7.', 'Staff', 'MjCr7Se4MvQYBd5ycAmprcTfM4HdpK8InkT1F0nFemBR5lpmWhaGGSxmuNmM', '2025-03-16 23:21:29', '2025-04-08 05:09:58'),
(2, NULL, 'MIS', 'misofficediffun@gmail.com', NULL, '$2y$12$7H52v3F5tfXxzYWA/fNLB.7YSxiaWlYu6NpiLdp4iyB.SYFuLdJ9.', 'Administrator', NULL, NULL, NULL),
(3, 2, 'Admin', 'admin@gmail.com', NULL, '$2y$12$80JzF8KP3MpIKjs11BE1.eWXPDeGQ06nZv7T4cwgFwp2GKYTaX8k6', 'Administrator', 'FMMbaVEFg4HtU6tF6Ky3IUWjhe4TFzmZ2YJfhnwstGIs3JW1v26oVeSEl5eE', NULL, '2025-04-08 05:22:10'),
(4, 2, 'staff', 'staff@gmail.com', NULL, '$2y$12$XItCEqQJU4Pp4q23xYm24Ohzcb/WExVK5aWma0IGNJkZPnccIR/ie', 'Staff', NULL, '2025-03-18 21:48:31', '2025-03-18 22:42:41'),
(6, 2, 'MIS Staff', 'mis@gmail.com', NULL, '$2y$12$ftUBwuWNyg/xAKCaWDQ.9.5hkyglWt7DhrtyCVm6WcOuXRZs2sUby', 'Staff', NULL, '2025-03-31 08:02:45', '2025-04-08 02:49:01'),
(7, 1, 'Budget Office Staff', 'budget@gmail.com', NULL, '$2y$12$uShTBamTeFaooK6xBn/CiOahMxGo9USmMHerYEgds95cLUxrpl.k6', 'Staff', NULL, '2025-03-31 08:15:06', '2025-03-31 08:15:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `office` (`document_origin`);

--
-- Indexes for table `document_attachments`
--
ALTER TABLE `document_attachments`
  ADD PRIMARY KEY (`da_id`);

--
-- Indexes for table `document_history`
--
ALTER TABLE `document_history`
  ADD PRIMARY KEY (`dh_id`);

--
-- Indexes for table `document_items`
--
ALTER TABLE `document_items`
  ADD PRIMARY KEY (`di_id`),
  ADD KEY `Document Items` (`document_id`);

--
-- Indexes for table `document_pending`
--
ALTER TABLE `document_pending`
  ADD PRIMARY KEY (`dp_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_ibfk_1` (`document_id`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`office_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `responsibility_center`
--
ALTER TABLE `responsibility_center`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `office_id` (`office_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `document_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `document_attachments`
--
ALTER TABLE `document_attachments`
  MODIFY `da_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `document_history`
--
ALTER TABLE `document_history`
  MODIFY `dh_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `document_items`
--
ALTER TABLE `document_items`
  MODIFY `di_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `document_pending`
--
ALTER TABLE `document_pending`
  MODIFY `dp_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `office_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_ibfk_1` FOREIGN KEY (`document_origin`) REFERENCES `office` (`office_id`);

--
-- Constraints for table `document_items`
--
ALTER TABLE `document_items`
  ADD CONSTRAINT `Document Items` FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`office_id`) REFERENCES `office` (`office_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
