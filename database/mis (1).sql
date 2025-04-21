-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2025 at 02:02 AM
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
-- Table structure for table `capital_outlay`
--

CREATE TABLE `capital_outlay` (
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `capital_outlay`
--

INSERT INTO `capital_outlay` (`code`, `name`, `created_at`, `updated_at`) VALUES
('1-07-05-020', 'Office Equipment', '2025-04-12 06:06:57', '2025-04-12 06:06:57'),
('1-07-05-030', 'I.T & Comm. Equipment', '2025-04-12 06:07:20', '2025-04-12 06:07:20'),
('1-07-05-032', 'Technology Equipment', '2025-04-12 06:07:29', '2025-04-12 06:07:29'),
('1-07-06-010', 'Motor Vehicles', '2025-04-12 06:06:45', '2025-04-12 06:06:45'),
('1-07-07-010', 'Furnitures & Equipment', '2025-04-12 06:07:08', '2025-04-12 06:07:08'),
('1-07-07-020', 'Books', '2025-04-12 06:07:37', '2025-04-13 06:41:41');

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
(10, 'Statement of Receipts and Expenditures', 2, 'Financial & Budgeting', '250412-00001', NULL, 'Pending', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 0, '2025-04-12 13:27:51', '2025-04-13 04:10:13'),
(11, 'To payment of ICT Equipment and Furniture and Fixtures for the MIS Uni', 1, 'Financial & Budgeting', '250412-00002', NULL, 'Pending', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 0, '2025-04-12 14:48:31', '2025-04-13 05:29:29'),
(12, 'Statement of Receipts and Expenditures', 4, 'asd', '250413-00001', NULL, 'Draft', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 1614130, '2025-04-13 04:38:55', '2025-04-17 06:33:04'),
(13, 'asdasd', 4, 'asdasd', '250413-00002', NULL, 'Approved', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 0, '2025-04-13 04:40:59', '2025-04-20 15:44:57'),
(14, 'asdasd', 4, 'asdasd', '250413-00003', NULL, 'Pending', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 0, '2025-04-13 04:57:53', '2025-04-13 05:06:30'),
(15, 'asd', 1, 'asd', '250417-00001', NULL, 'Pending', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 2, '2025-04-17 09:45:32', '2025-04-20 15:42:33'),
(16, 'Fake Document', 1, 'Fake Document', '250420-00001', NULL, 'Pending', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 0, '2025-04-20 12:20:10', '2025-04-20 15:58:59'),
(17, 'Budget for Computer Parts', 2, 'Financial & Budgeting', '250421-00001', NULL, 'Pending', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 40000, '2025-04-20 16:04:31', '2025-04-20 16:16:58');

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
(1, 10, 'CreateaLaravelapplication_1744466453.docx', 'docx'),
(2, 17, 'Bills_1745165175.pdf', 'pdf');

-- --------------------------------------------------------

--
-- Table structure for table `document_external`
--

CREATE TABLE `document_external` (
  `de_id` bigint(20) UNSIGNED NOT NULL,
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `from_office` bigint(20) UNSIGNED NOT NULL,
  `de_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `de_remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_external`
--

INSERT INTO `document_external` (`de_id`, `document_id`, `office_id`, `from_office`, `de_status`, `de_remarks`, `created_at`, `updated_at`) VALUES
(1, 10, 1, 0, 'Approved', 'Just because', '2025-04-12 14:16:01', '2025-04-12 14:47:36'),
(2, 10, 4, 0, 'Denied', 'asd', '2025-04-12 15:01:37', '2025-04-13 04:38:36'),
(3, 11, 1, 0, 'Approved', NULL, '2025-04-13 04:06:00', '2025-04-13 05:28:27'),
(4, 13, 1, 0, 'Approved', 'asdasd', '2025-04-13 04:43:04', '2025-04-20 15:44:57'),
(5, 14, 4, 0, 'Approved', 'asd', '2025-04-13 05:06:30', '2025-04-13 05:40:02'),
(6, 11, 4, 0, 'Approved', 'Good', '2025-04-13 05:28:35', '2025-04-13 05:29:22'),
(7, 11, 2, 0, 'Pending', NULL, '2025-04-13 05:29:29', '2025-04-13 05:29:29'),
(8, 15, 1, 0, 'Approved', NULL, '2025-04-17 09:45:53', '2025-04-20 15:35:20'),
(9, 15, 2, 0, 'Pending', NULL, '2025-04-20 15:35:26', '2025-04-20 15:35:26'),
(10, 15, 2, 0, 'Pending', NULL, '2025-04-20 15:35:26', '2025-04-20 15:35:26'),
(11, 15, 2, 0, 'Pending', NULL, '2025-04-20 15:35:26', '2025-04-20 15:35:26'),
(12, 15, 2, 1, 'Pending', NULL, '2025-04-20 15:41:51', '2025-04-20 15:41:51'),
(13, 15, 4, 1, 'Pending', NULL, '2025-04-20 15:42:33', '2025-04-20 15:42:33'),
(14, 16, 1, 1, 'Approved', 'Testing remarks for budget approves', '2025-04-20 15:57:30', '2025-04-20 15:58:48'),
(15, 16, 4, 1, 'Pending', NULL, '2025-04-20 15:58:59', '2025-04-20 15:58:59'),
(17, 17, 3, 2, 'Approved', NULL, '2025-04-20 16:16:58', '2025-04-20 16:18:52');

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
  `dh_remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_history`
--

INSERT INTO `document_history` (`dh_id`, `document_id`, `dh_name`, `dh_date`, `dh_action`, `dh_remarks`, `created_at`, `updated_at`) VALUES
(1, 10, 'Nickson Prieto', '2025-04-12 21:50:00', 'Prepared Data', '', '2025-04-12 13:50:31', '2025-04-12 13:50:31'),
(2, 10, 'Rhovin John Dulay', '2025-04-12 22:20:18', 'Signed PR', '', '2025-04-12 14:20:18', '2025-04-12 14:20:18'),
(3, 10, 'Rhovin John Dulay', '2025-04-12 22:20:19', 'Signed CANVASS', '', '2025-04-12 14:20:19', '2025-04-12 14:20:19'),
(4, 10, 'Rhovin John Dulay', '2025-04-12 22:20:20', 'Signed ABSTRACT', '', '2025-04-12 14:20:20', '2025-04-12 14:20:20'),
(5, 10, 'Rhovin John Dulay', '2025-04-12 22:20:21', 'Signed OBR', '', '2025-04-12 14:20:21', '2025-04-12 14:20:21'),
(6, 10, 'Rhovin John Dulay', '2025-04-12 22:20:21', 'Signed PO', '', '2025-04-12 14:20:21', '2025-04-12 14:20:21'),
(7, 10, 'Rhovin John Dulay', '2025-04-12 22:20:22', 'Signed PAR', '', '2025-04-12 14:20:22', '2025-04-12 14:20:22'),
(8, 10, 'Rhovin John Dulay', '2025-04-12 22:20:23', 'Signed AIR', '', '2025-04-12 14:20:23', '2025-04-12 14:20:23'),
(9, 10, 'Rhovin John Dulay', '2025-04-12 22:20:23', 'Signed DV', '', '2025-04-12 14:20:23', '2025-04-12 14:20:23'),
(10, 10, 'Nickson Prieto', '2025-04-12 22:23:00', 'Approved Document', '', '2025-04-12 14:23:49', '2025-04-12 14:23:49'),
(11, 10, 'Rhovin John Dulay', '2025-04-12 22:32:59', 'Denied Document', '', '2025-04-12 14:32:59', '2025-04-12 14:32:59'),
(12, 10, 'Rhovin John Dulay', '2025-04-12 23:01:37', 'Forwarded Document to Accounting Office', '', '2025-04-12 15:01:37', '2025-04-12 15:01:37'),
(13, 10, 'Mayor Garnace', '2025-04-12 23:31:00', 'Signed', '', '2025-04-12 15:31:29', '2025-04-12 15:31:29'),
(14, 11, 'Budget Office Staff', '2025-04-13 12:06:08', 'Signed PR', '', '2025-04-13 04:06:08', '2025-04-13 04:06:08'),
(15, 11, 'Budget Office Staff', '2025-04-13 12:06:08', 'Signed CANVASS', '', '2025-04-13 04:06:08', '2025-04-13 04:06:08'),
(16, 11, 'Budget Office Staff', '2025-04-13 12:06:09', 'Signed ABSTRACT', '', '2025-04-13 04:06:09', '2025-04-13 04:06:09'),
(17, 11, 'Budget Office Staff', '2025-04-13 12:06:10', 'Signed OBR', '', '2025-04-13 04:06:10', '2025-04-13 04:06:10'),
(18, 11, 'Budget Office Staff', '2025-04-13 12:06:10', 'Signed PO', '', '2025-04-13 04:06:10', '2025-04-13 04:06:10'),
(19, 11, 'Budget Office Staff', '2025-04-13 12:06:11', 'Signed PAR', '', '2025-04-13 04:06:11', '2025-04-13 04:06:11'),
(20, 11, 'Budget Office Staff', '2025-04-13 12:06:11', 'Unsigned PAR', '', '2025-04-13 04:06:11', '2025-04-13 04:06:11'),
(21, 11, 'Budget Office Staff', '2025-04-13 12:06:14', 'Signed PAR', '', '2025-04-13 04:06:14', '2025-04-13 04:06:14'),
(22, 11, 'Budget Office Staff', '2025-04-13 12:06:16', 'Signed AIR', '', '2025-04-13 04:06:16', '2025-04-13 04:06:16'),
(23, 11, 'Budget Office Staff', '2025-04-13 12:06:17', 'Signed DV', '', '2025-04-13 04:06:17', '2025-04-13 04:06:17'),
(24, 10, 'Accounting Staff', '2025-04-13 12:10:08', 'Unsigned PO', '', '2025-04-13 04:10:08', '2025-04-13 04:10:08'),
(25, 10, 'Accounting Staff', '2025-04-13 12:10:13', 'Signed PO', '', '2025-04-13 04:10:13', '2025-04-13 04:10:13'),
(26, 10, 'Accounting Staff', '2025-04-13 12:14:03', 'Denied Document', '', '2025-04-13 04:14:03', '2025-04-13 04:14:03'),
(27, 10, 'Accounting Staff', '2025-04-13 12:23:09', 'Approved Document', '', '2025-04-13 04:23:09', '2025-04-13 04:23:09'),
(28, 10, 'Accounting Staff', '2025-04-13 12:29:55', 'Approved Document', '', '2025-04-13 04:29:55', '2025-04-13 04:29:55'),
(29, 10, 'Accounting Staff', '2025-04-13 12:32:37', 'Approved Document', '', '2025-04-13 04:32:37', '2025-04-13 04:32:37'),
(30, 10, 'Accounting Staff', '2025-04-13 12:35:46', 'Approved Document', '', '2025-04-13 04:35:46', '2025-04-13 04:35:46'),
(31, 10, 'Accounting Staff', '2025-04-13 12:36:29', 'Approved Document', '', '2025-04-13 04:36:29', '2025-04-13 04:36:29'),
(32, 10, 'Accounting Staff', '2025-04-13 12:38:09', 'Approved Document', '', '2025-04-13 04:38:09', '2025-04-13 04:38:09'),
(33, 10, 'Accounting Staff', '2025-04-13 12:38:36', 'Denied Document', '', '2025-04-13 04:38:36', '2025-04-13 04:38:36'),
(34, 11, 'Budget Office Staff', '2025-04-13 13:28:27', 'Approved Document', '', '2025-04-13 05:28:27', '2025-04-13 05:28:27'),
(35, 11, 'Budget Office Staff', '2025-04-13 13:28:35', 'Forwarded Document to Accounting Office', '', '2025-04-13 05:28:35', '2025-04-13 05:28:35'),
(36, 11, 'Accounting Staff', '2025-04-13 13:29:22', 'Approved Document', '', '2025-04-13 05:29:22', '2025-04-13 05:29:22'),
(37, 11, 'Accounting Staff', '2025-04-13 13:29:29', 'Forwarded Document to Management Information System Office', '', '2025-04-13 05:29:29', '2025-04-13 05:29:29'),
(38, 14, 'Accounting Staff', '2025-04-13 13:40:02', 'Approved Document', '', '2025-04-13 05:40:02', '2025-04-13 05:40:02'),
(39, 16, 'Budget Office Staff', '2025-04-20 20:27:00', 'Prepared the Documents', NULL, '2025-04-20 12:28:18', '2025-04-20 12:28:18'),
(40, 16, 'Budget Office Staff', '2025-04-20 20:28:00', 'Test action', 'Test Remakrs', '2025-04-20 12:28:44', '2025-04-20 12:28:44'),
(41, 16, 'Budget Office Staff', '2025-04-20 20:28:00', 'Test action', 'Test Remakrs', '2025-04-20 12:28:44', '2025-04-20 12:28:44'),
(42, 16, 'Budget Office Staff', '2025-04-20 20:28:00', 'asdasd', 'asdasdasd', '2025-04-20 12:28:58', '2025-04-20 12:28:58'),
(43, 16, 'Budget Office Staff', '2025-04-20 20:29:00', 'asdasdasd', 'asdasdasd', '2025-04-20 12:29:10', '2025-04-20 12:29:10'),
(44, 16, 'Budget Office Staff', '2025-04-20 20:29:00', 'asdasdasd', 'asdasdasd', '2025-04-20 12:29:10', '2025-04-20 12:29:10'),
(45, 16, 'Budget Office Staff', '2025-04-20 20:29:00', 'asdasdasd', 'asdasdasd', '2025-04-20 12:29:11', '2025-04-20 12:29:11'),
(46, 16, 'Budget Office Staff', '2025-04-20 20:29:00', 'asdasdasd', 'asdasdasd', '2025-04-20 12:29:11', '2025-04-20 12:29:11'),
(47, 16, 'Budget Office Staff', '2025-04-20 20:42:00', 'asdasd', 'asd', '2025-04-20 12:42:40', '2025-04-20 12:42:40'),
(48, 16, 'Budget Office Staff', '2025-04-20 20:42:00', 'zxczxc', 'zxczxczxc', '2025-04-20 12:42:50', '2025-04-20 12:42:50'),
(49, 16, 'Budget Office Staff', '2025-04-20 20:42:00', 'zxczxc', 'zxczxczxc', '2025-04-20 12:42:50', '2025-04-20 12:42:50'),
(50, 16, 'Budget Office Staff', '2025-04-20 20:42:00', 'zxczxc', 'zxczxczxc', '2025-04-20 12:42:50', '2025-04-20 12:42:50'),
(51, 16, 'Budget Office Staff', '2025-04-20 20:42:00', 'zxczxc', 'zxczxczxc', '2025-04-20 12:42:50', '2025-04-20 12:42:50'),
(52, 16, 'Budget Office Staff', '2025-04-20 20:42:00', 'zxczxc', 'zxczxczxc', '2025-04-20 12:42:51', '2025-04-20 12:42:51'),
(53, 16, 'Budget Office Staff', '2025-04-20 20:42:00', 'zxczxc', 'zxczxczxc', '2025-04-20 12:42:51', '2025-04-20 12:42:51'),
(54, 16, 'Budget Office Staff', '2025-04-20 20:42:00', 'zxczxc', 'zxczxczxc', '2025-04-20 12:42:51', '2025-04-20 12:42:51'),
(55, 16, 'Budget Office Staff', '2025-04-30 20:44:00', 'asasdasd', 'asdasdasd', '2025-04-20 12:44:26', '2025-04-20 12:44:26'),
(56, 16, 'Budget Office Staff', '2025-04-20 20:44:00', 'asdasdasdasd', NULL, '2025-04-20 12:44:37', '2025-04-20 12:44:37'),
(57, 16, 'Budget Office Staff', '2025-04-16 20:44:00', 'asdasdasd', NULL, '2025-04-20 12:44:45', '2025-04-20 12:44:45'),
(58, 15, 'Budget Office Staff', '2025-04-20 23:35:20', 'Approved Document', NULL, '2025-04-20 15:35:20', '2025-04-20 15:35:20'),
(59, 15, 'Budget Office Staff', '2025-04-20 23:35:26', 'Forwarded Document to Management Information System Office', NULL, '2025-04-20 15:35:26', '2025-04-20 15:35:26'),
(60, 15, 'Budget Office Staff', '2025-04-20 23:35:26', 'Forwarded Document to Management Information System Office', NULL, '2025-04-20 15:35:26', '2025-04-20 15:35:26'),
(61, 15, 'Budget Office Staff', '2025-04-20 23:35:26', 'Forwarded Document to Management Information System Office', NULL, '2025-04-20 15:35:26', '2025-04-20 15:35:26'),
(62, 15, 'Budget Office Staff', '2025-04-20 23:41:51', 'Forwarded Document to Management Information System Office', NULL, '2025-04-20 15:41:51', '2025-04-20 15:41:51'),
(63, 15, 'Budget Office Staff', '2025-04-20 23:42:33', 'Forwarded Document to Municipal Accounting Office', NULL, '2025-04-20 15:42:33', '2025-04-20 15:42:33'),
(64, 15, 'asd', '2025-04-20 23:43:00', 'asd', NULL, '2025-04-20 15:43:30', '2025-04-20 15:43:30'),
(65, 15, 'Mayor Garnace', '2025-04-20 23:43:00', 'asd', NULL, '2025-04-20 15:43:42', '2025-04-20 15:43:42'),
(66, 13, 'Budget Office Staff', '2025-04-20 23:44:57', 'Approved Document', NULL, '2025-04-20 15:44:57', '2025-04-20 15:44:57'),
(67, 13, 'asdasd', '2025-04-20 23:45:00', 'asdasd', NULL, '2025-04-20 15:45:08', '2025-04-20 15:45:08'),
(68, 13, 'asdasd', '2025-04-20 23:45:00', 'asdasdasd', NULL, '2025-04-20 15:45:17', '2025-04-20 15:45:17'),
(69, 16, 'Budget Office Staff', '2025-04-20 23:58:48', 'Approved Document', 'Testing remarks for budget approves', '2025-04-20 15:58:48', '2025-04-20 15:58:48'),
(70, 16, 'Budget Office Staff', '2025-04-20 23:58:59', 'Forwarded Document to Municipal Accounting Office', NULL, '2025-04-20 15:58:59', '2025-04-20 15:58:59'),
(71, 17, 'MIS Staff', '2025-04-21 00:05:00', 'Prepared Data', NULL, '2025-04-20 16:05:29', '2025-04-20 16:05:29'),
(72, 17, 'MIS Staff', '2025-04-21 00:16:58', 'Submitted documents to Procurement Office', NULL, '2025-04-20 16:16:58', '2025-04-20 16:16:58'),
(73, 17, 'Nanashi Ruuza', '2025-04-21 00:18:52', 'Approved Document', NULL, '2025-04-20 16:18:52', '2025-04-20 16:18:52');

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
  `di_total_amount` float NOT NULL DEFAULT 0,
  `di_mooe` varchar(255) DEFAULT NULL,
  `di_co` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_items`
--

INSERT INTO `document_items` (`di_id`, `document_id`, `di_unit`, `di_description`, `di_quantity`, `di_unit_price`, `di_total_amount`, `di_mooe`, `di_co`) VALUES
(1, 12, 'Unit', 'asdasd', 123, 13123, 1614130, '5-02-03-020', NULL),
(2, 15, 'Unit', 'asd', 1, 2, 2, '5-02-99-010', NULL),
(3, 17, 'Unit', 'RTX 4090', 1, 40000, 40000, NULL, '1-07-05-030');

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
(1, 'MIS Staff', 'Inserted Document', 'Statement of Receipts and Expenditures', '2025-04-12 13:27:51', '2025-04-12 13:27:51'),
(2, 'MIS Staff', 'Updated', 'Statement of Receipts and Expenditures', '2025-04-12 13:32:32', '2025-04-12 13:32:32'),
(3, 'MIS Staff', 'Updated', 'Statement of Receipts and Expenditures', '2025-04-12 13:32:36', '2025-04-12 13:32:36'),
(4, 'MIS Staff', 'Updated', 'Statement of Receipts and Expenditures', '2025-04-12 13:43:23', '2025-04-12 13:43:23'),
(5, 'MIS Staff', 'Updated', 'Statement of Receipts and Expenditures', '2025-04-12 13:44:44', '2025-04-12 13:44:44'),
(6, 'MIS Staff', 'Updated', 'Statement of Receipts and Expenditures', '2025-04-12 13:44:53', '2025-04-12 13:44:53'),
(7, 'MIS Staff', 'Updated', 'Statement of Receipts and Expenditures', '2025-04-12 13:44:58', '2025-04-12 13:44:58'),
(8, 'MIS Staff', 'Updated', 'Statement of Receipts and Expenditures', '2025-04-12 13:45:03', '2025-04-12 13:45:03'),
(9, 'MIS Staff', 'Inserted Action for', 'Statement of Receipts and Expenditures', '2025-04-12 13:50:31', '2025-04-12 13:50:31'),
(10, 'Rhovin John Dulay', 'Inserted Action for', 'Statement of Receipts and Expenditures', '2025-04-12 14:23:49', '2025-04-12 14:23:49'),
(11, 'Rhovin John Dulay', 'Inserted Document', 'To payment of ICT Equipment and Furniture and Fixtures for the MIS Uni', '2025-04-12 14:48:31', '2025-04-12 14:48:31'),
(12, 'Accounting Staff', 'Inserted Action for', 'Statement of Receipts and Expenditures', '2025-04-12 15:31:29', '2025-04-12 15:31:29'),
(13, 'Accounting Staff', 'Inserted Action for', 'Statement of Receipts and Expenditures', '2025-04-13 04:14:03', '2025-04-13 04:14:03'),
(14, 'Accounting Staff', 'Inserted Action for', 'Statement of Receipts and Expenditures', '2025-04-13 04:23:09', '2025-04-13 04:23:09'),
(15, 'Accounting Staff', 'Inserted Action for', 'Statement of Receipts and Expenditures', '2025-04-13 04:29:55', '2025-04-13 04:29:55'),
(16, 'Accounting Staff', 'Inserted Action for', 'Statement of Receipts and Expenditures', '2025-04-13 04:32:37', '2025-04-13 04:32:37'),
(17, 'Accounting Staff', 'Inserted Action for', 'Statement of Receipts and Expenditures', '2025-04-13 04:35:46', '2025-04-13 04:35:46'),
(18, 'Accounting Staff', 'Inserted Action for', 'Statement of Receipts and Expenditures', '2025-04-13 04:36:29', '2025-04-13 04:36:29'),
(19, 'Accounting Staff', 'Inserted Action for', 'Statement of Receipts and Expenditures', '2025-04-13 04:38:09', '2025-04-13 04:38:09'),
(20, 'Accounting Staff', 'Inserted Action for', 'Statement of Receipts and Expenditures', '2025-04-13 04:38:36', '2025-04-13 04:38:36'),
(21, 'Accounting Staff', 'Inserted Document', 'Statement of Receipts and Expenditures', '2025-04-13 04:38:55', '2025-04-13 04:38:55'),
(22, 'Accounting Staff', 'Inserted Document', 'asdasd', '2025-04-13 04:40:59', '2025-04-13 04:40:59'),
(23, 'Accounting Staff', 'Inserted Document', 'asdasd', '2025-04-13 04:57:53', '2025-04-13 04:57:53'),
(24, 'Accounting Staff', 'Inserted Action for', 'To payment of ICT Equipment and Furniture and Fixtures for the MIS Uni', '2025-04-13 05:29:22', '2025-04-13 05:29:22'),
(25, 'Accounting Staff', 'Inserted Action for', 'asdasd', '2025-04-13 05:40:02', '2025-04-13 05:40:02'),
(26, 'Accounting Staff', 'Added Items for', 'Statement of Receipts and Expenditures', '2025-04-17 06:33:04', '2025-04-17 06:33:04'),
(27, 'Budget Office Staff', 'Inserted Document', 'asd', '2025-04-17 09:45:32', '2025-04-17 09:45:32'),
(28, 'Budget Office Staff', 'Added Items for', 'asd', '2025-04-17 09:45:46', '2025-04-17 09:45:46'),
(29, 'Budget Office Staff', 'Inserted Document', 'Fake Document', '2025-04-20 12:20:10', '2025-04-20 12:20:10'),
(30, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:28:18', '2025-04-20 12:28:18'),
(31, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:28:44', '2025-04-20 12:28:44'),
(32, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:28:44', '2025-04-20 12:28:44'),
(33, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:28:58', '2025-04-20 12:28:58'),
(34, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:29:10', '2025-04-20 12:29:10'),
(35, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:29:10', '2025-04-20 12:29:10'),
(36, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:29:11', '2025-04-20 12:29:11'),
(37, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:29:11', '2025-04-20 12:29:11'),
(38, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:42:40', '2025-04-20 12:42:40'),
(39, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:42:50', '2025-04-20 12:42:50'),
(40, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:42:50', '2025-04-20 12:42:50'),
(41, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:42:50', '2025-04-20 12:42:50'),
(42, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:42:50', '2025-04-20 12:42:50'),
(43, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:42:51', '2025-04-20 12:42:51'),
(44, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:42:51', '2025-04-20 12:42:51'),
(45, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:42:51', '2025-04-20 12:42:51'),
(46, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:44:26', '2025-04-20 12:44:26'),
(47, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:44:37', '2025-04-20 12:44:37'),
(48, 'Budget Office Staff', 'Inserted Action for', 'Fake Document', '2025-04-20 12:44:45', '2025-04-20 12:44:45'),
(49, 'Budget Office Staff', 'Updated', 'Fake Document', '2025-04-20 12:46:27', '2025-04-20 12:46:27'),
(50, 'Budget Office Staff', 'Updated', 'Fake Document', '2025-04-20 12:46:30', '2025-04-20 12:46:30'),
(51, 'Budget Office Staff', 'Inserted Action for', 'asd', '2025-04-20 15:43:30', '2025-04-20 15:43:30'),
(52, 'Budget Office Staff', 'Inserted Action for', 'asd', '2025-04-20 15:43:42', '2025-04-20 15:43:42'),
(53, 'Budget Office Staff', 'Inserted Action for', 'asdasd', '2025-04-20 15:45:08', '2025-04-20 15:45:08'),
(54, 'Budget Office Staff', 'Inserted Action for', 'asdasd', '2025-04-20 15:45:17', '2025-04-20 15:45:17'),
(55, 'MIS Staff', 'Inserted Document', 'Budget for Computer Parts', '2025-04-20 16:04:31', '2025-04-20 16:04:31'),
(56, 'MIS Staff', 'Added Items for', 'Budget for Computer Parts', '2025-04-20 16:05:06', '2025-04-20 16:05:06'),
(57, 'MIS Staff', 'Inserted Action for', 'Budget for Computer Parts', '2025-04-20 16:05:29', '2025-04-20 16:05:29'),
(58, 'Nanashi Ruuza', 'Inserted Action for', 'Budget for Computer Parts', '2025-04-20 16:18:52', '2025-04-20 16:18:52');

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
-- Table structure for table `mooe`
--

CREATE TABLE `mooe` (
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mooe`
--

INSERT INTO `mooe` (`code`, `name`, `created_at`, `updated_at`) VALUES
('1-04-04-120', 'Chemical and Filtering Supplies Exp.', '2025-04-10 05:01:14', '2025-04-10 05:47:42'),
('5-02-01-010', 'Travelling Expenses - Local', '2025-04-10 05:00:15', '2025-04-10 05:00:15'),
('5-02-01-020', 'Travelling Expenses - Foreign', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-03-010', 'Office Supplies Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-03-020', 'Accountable Forms Expenes', '2025-04-10 05:01:14', '2025-04-10 05:12:46'),
('5-02-03-030', 'Non-Accountable Forms Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-03-040', 'Animal/Zoological Supplies Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-03-050', 'Food Supplies Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-03-060', 'Welfare Goods Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-03-070', 'Drugs and Medicine Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-03-080', 'Medical, Dental & Lab. Supplies', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-03-090', 'Fuel, Oil and Lubricants Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-03-100', 'Agricultural & Marine Supplies Exp.', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-03-110', 'Textbooks and INdustrial Materials Exp.', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-03-120', 'Military, Police and Traffic Supplies Exp.', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-03-990', 'Other Supplies and Materials Exp.', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-04-010 ', 'Water Expenses', '2025-04-10 05:01:14', '2025-04-10 05:47:28'),
('5-02-04-020', 'Electricity Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-05-010', 'Postages and Courier Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-05-020', 'Telephone Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-05-030', 'Internet Subscription Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-05-040', 'Cable, Satellite, Telegraph & Radio', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-06-010', 'Awards/Rewards Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-06-020', 'Prizes', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-07-010', 'Survey Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-09-010', 'Generation, Tranmission & Dist.', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-10-010', 'Confidential Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-10-020', 'Intelligence Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-10-030', 'Extraordinary & Miscellaneous Exp.', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-11-010', 'Legal Services', '2025-04-10 05:01:14', '2025-04-10 05:49:43'),
('5-02-11-030', 'Consultancy Services', '2025-04-10 05:01:14', '2025-04-10 05:49:35'),
('5-02-11-990', 'Other Professional Services', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-12-010', 'Environment/Sanitary Services', '2025-04-10 05:01:14', '2025-04-10 05:49:26'),
('5-02-12-020', 'Janitorial Services', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-12-030', 'Security Services', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-12-990', 'Other Professional Services', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-13-030', 'RM Infrastructure Assets', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-13-040', 'RM Building and Other Structures', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-13-050', 'RM Machinery and Equipments', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-13-060', 'RM Transportation Equipment', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-13-070', 'RM Furnitures and Fixtures', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-16-010', 'Taxes, Duties and License', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-16-020', 'Fidelity Bond Premiums', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-16-030', 'Insurance Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-99-010', 'Advertising Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-99-030', 'Representation Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-99-050', 'Rent Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-99-070', 'Subscription Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-02-99-990', 'Other Main. & Operating Exp.', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-03-01-020', 'Interest Expenses', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-03-01-040', 'Bank Charges', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-03-01-050', 'Commitment Fees', '2025-04-10 05:01:14', '2025-04-10 05:01:14'),
('5-03-01-990', 'Other Financial Charges', '2025-04-10 05:01:14', '2025-04-10 05:01:14');

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
(1, 10, 'Just because', 'Denied', 1, '2025-04-13 13:36:50', '2025-04-12 14:32:59', '2025-04-13 05:36:50'),
(2, 11, NULL, 'Approved', 7, '2025-04-17 17:44:42', '2025-04-13 05:28:27', '2025-04-17 09:44:42'),
(3, 14, 'asd', 'Approved', 9, '2025-04-13 14:53:37', '2025-04-13 05:40:02', '2025-04-13 06:53:37'),
(4, 15, NULL, 'Approved', 7, '2025-04-20 23:44:37', '2025-04-20 15:35:20', '2025-04-20 15:44:37'),
(5, 13, 'asdasd', 'Approved', 7, NULL, '2025-04-20 15:44:57', '2025-04-20 15:44:57'),
(6, 16, 'Testing remarks for budget approves', 'Approved', 7, NULL, '2025-04-20 15:58:48', '2025-04-20 15:58:48'),
(7, 17, NULL, 'Approved', 10, NULL, '2025-04-20 16:18:52', '2025-04-20 16:18:52');

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `office_name` varchar(255) NOT NULL,
  `office_code` varchar(255) DEFAULT NULL,
  `office_budget` double UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`office_id`, `office_name`, `office_code`, `office_budget`, `created_at`, `updated_at`) VALUES
(1, 'Municipal Budget Office', '1071', 0, '2025-04-10 03:15:30', '2025-04-17 07:15:30'),
(2, 'Management Information System Office', 'MIS', 0, '2025-04-10 03:15:30', '2025-04-17 07:15:51'),
(3, 'Procurement Office', 'PO', 0, '2025-04-10 03:15:30', '2025-04-17 07:16:02'),
(4, 'Municipal Accounting Office', '1081', 0, '2025-04-10 03:15:30', '2025-04-17 07:15:39'),
(6, 'Municipal Mayor\'s Office', '1011', 0, '2025-04-17 07:15:19', '2025-04-17 07:15:19'),
(7, 'Municipal Planning & Development Office', '1041', 0, '2025-04-17 07:16:16', '2025-04-17 07:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `office_budget`
--

CREATE TABLE `office_budget` (
  `ob_id` bigint(20) UNSIGNED NOT NULL,
  `ob_allocated_by` bigint(20) UNSIGNED NOT NULL,
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `ob_allocated_amount` double NOT NULL,
  `ob_allocation_date` datetime NOT NULL DEFAULT current_timestamp(),
  `ob_remarks` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responsibility_center`
--

INSERT INTO `responsibility_center` (`code`, `name`, `created_at`, `updated_at`) VALUES
('1011', 'Municipal Mayor\'s Office', '2025-04-10 02:57:18', '2025-04-10 02:57:18'),
('1012', 'Municipal Tourism Office', '2025-04-10 02:57:18', '2025-04-10 02:57:18'),
('1017', 'Municipal Disaster Risk & Mgt. Office', '2025-04-10 02:57:18', '2025-04-10 02:57:18'),
('1021', 'Municipal Vice Mayor / SB Office', '2025-04-10 02:57:18', '2025-04-10 02:57:18'),
('1041', 'Municipal Planning & Development Office', '2025-04-10 02:57:18', '2025-04-10 02:57:18'),
('1051', 'Municipal Civil Registrar\'s Office', '2025-04-10 02:57:18', '2025-04-10 02:57:18'),
('1071', 'Municipal Budget Office', '2025-04-10 02:57:18', '2025-04-10 02:57:18'),
('1081', 'Municipal Accounting Office', '2025-04-10 02:57:18', '2025-04-13 12:23:23'),
('1091', 'Municipal Treasurer\'s Office', '2025-04-10 02:57:18', '2025-04-10 02:57:18'),
('1101', 'Municipal Assessor\'s Office', '2025-04-10 02:57:18', '2025-04-10 02:57:18'),
('4411', 'Municipal Health Office', '2025-04-10 02:57:18', '2025-04-10 02:57:18'),
('7611', 'Municipal Social Welfare & Development Office', '2025-04-10 02:57:18', '2025-04-10 02:57:18'),
('8711', 'Municipal Agriculture Office', '2025-04-10 02:57:18', '2025-04-10 02:57:18'),
('8731', 'Municipal Environment & Natural Resources Office', '2025-04-10 02:57:18', '2025-04-10 02:57:18'),
('8751', 'Municipal Engineering Office', '2025-04-10 02:57:18', '2025-04-10 02:57:18');

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
('D7AmpJkmc7cUPht35RZZQcJ683e0P9HQOxMwpYd7', 10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 OPR/117.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibVdrZzZrSk9nb2Ria1lvRERmd2FuVDBUdVh4ZUJpUHUwd1c4U1RkUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdGFmZi9leHRlcm5hbC92aWV3LzI1MDQyMS0wMDAwMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEwO30=', 1745165932),
('jqzBPoUSXmADamoTeLbxJWpiwnrflJhq8UxbvLew', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 OPR/117.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieDRZNWZFd2YyRWZseEROZ0tjR2Z5dkliYWF3NWdKVUdrYzJHb28wMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdGFmZi9kb2N1bWVudC92aWV3LzI1MDQxMi0wMDAwMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjY7fQ==', 1745163055);

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
  `unit_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_name`, `created_at`, `updated_at`) VALUES
(1, 'Unit', '2025-04-10 03:23:41', '2025-04-10 03:23:41'),
(2, 'Set', '2025-04-10 03:23:41', '2025-04-10 03:23:41'),
(4, 'Liter', '2025-04-10 03:23:41', '2025-04-10 03:23:41'),
(6, 'Gallon', '2025-04-10 03:23:41', '2025-04-13 06:43:04');

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
(1, 1, 'Rhovin John Dulay', 'rhovin.dulay@gmail.com', NULL, '$2y$12$3EWCkLKX4ZSl1dO8H9a4LuGUnM8bKKAuFQStBfiZDWOGZ4.TSAT7.', 'Staff', 'pMr2JA4QqKPBPNXgERWQixNzuKzVoeQJi9Rvg1L0mUNJ3Wt0d7fYihKM4r94', '2025-03-16 23:21:29', '2025-04-13 06:43:58'),
(2, NULL, 'MIS', 'misofficediffun@gmail.com', NULL, '$2y$12$7H52v3F5tfXxzYWA/fNLB.7YSxiaWlYu6NpiLdp4iyB.SYFuLdJ9.', 'Administrator', NULL, NULL, NULL),
(3, 2, 'Admin', 'admin@gmail.com', NULL, '$2y$12$HtXAIBj1f9B8zj8n11Po8O2W5qqgI5nJ23btovKFtCWNaXZjywxaW', 'Administrator', 'IVbL1iPHPhN7YOeqzC3c7H5BwODviNF4WzoQskgy8LJZklpv7bWkAg7hL0Fq', NULL, '2025-04-20 16:10:09'),
(4, 2, 'staff', 'staff@gmail.com', NULL, '$2y$12$XItCEqQJU4Pp4q23xYm24Ohzcb/WExVK5aWma0IGNJkZPnccIR/ie', 'Staff', NULL, '2025-03-18 21:48:31', '2025-04-10 03:47:15'),
(6, 2, 'MIS Staff', 'mis@gmail.com', NULL, '$2y$12$2/ORhT.wdMncmMJychYKjuZw3asXErhuPz1CbpV/N4kWcV7F5tBHe', 'Staff', NULL, '2025-03-31 08:02:45', '2025-04-10 04:50:48'),
(7, 1, 'Budget Office Staff', 'budget@gmail.com', NULL, '$2y$12$uShTBamTeFaooK6xBn/CiOahMxGo9USmMHerYEgds95cLUxrpl.k6', 'Staff', NULL, '2025-03-31 08:15:06', '2025-04-19 01:28:31'),
(9, 4, 'Accounting Staff', 'accounting@gmail.com', NULL, '$2y$12$kyyY2aII7geYU7qCq5tYweCR5rDDUJ23uuYgh8qaTjv6DPdoSiR0C', 'Staff', NULL, '2025-04-12 15:02:17', '2025-04-13 04:43:18'),
(10, 3, 'Nanashi Ruuza', 'nanashi.ruuza74@gmail.com', NULL, '$2y$12$p4X0QtA8hQb/kXVjYICxGuinTtGzucnU5Fftpa9z5vmta.I9n.NOu', 'Staff', NULL, '2025-04-18 23:36:57', '2025-04-20 16:10:04');

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
-- Indexes for table `capital_outlay`
--
ALTER TABLE `capital_outlay`
  ADD PRIMARY KEY (`code`);

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
-- Indexes for table `document_external`
--
ALTER TABLE `document_external`
  ADD PRIMARY KEY (`de_id`),
  ADD KEY `document_id` (`document_id`),
  ADD KEY `office_id` (`office_id`);

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
-- Indexes for table `mooe`
--
ALTER TABLE `mooe`
  ADD PRIMARY KEY (`code`);

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
-- Indexes for table `office_budget`
--
ALTER TABLE `office_budget`
  ADD PRIMARY KEY (`ob_id`);

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
  MODIFY `document_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `document_attachments`
--
ALTER TABLE `document_attachments`
  MODIFY `da_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `document_external`
--
ALTER TABLE `document_external`
  MODIFY `de_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `document_history`
--
ALTER TABLE `document_history`
  MODIFY `dh_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `document_items`
--
ALTER TABLE `document_items`
  MODIFY `di_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `document_pending`
--
ALTER TABLE `document_pending`
  MODIFY `dp_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `office_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `office_budget`
--
ALTER TABLE `office_budget`
  MODIFY `ob_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_ibfk_1` FOREIGN KEY (`document_origin`) REFERENCES `office` (`office_id`);

--
-- Constraints for table `document_external`
--
ALTER TABLE `document_external`
  ADD CONSTRAINT `document_external_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`),
  ADD CONSTRAINT `document_external_ibfk_2` FOREIGN KEY (`office_id`) REFERENCES `office` (`office_id`);

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
