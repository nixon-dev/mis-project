-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2025 at 08:22 AM
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
  `rc_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
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

INSERT INTO `document` (`document_id`, `document_title`, `document_origin`, `rc_code`, `document_nature`, `document_number`, `document_deadline`, `document_status`, `pr`, `canvass`, `abstract`, `obr`, `po`, `par`, `air`, `dv`, `amount`, `created_at`, `updated_at`) VALUES
(2, 'Eviction Notice of Rhovin John Dulay', 2, '1081', 'Eviction Notice', '250410-00001', NULL, 'Pending', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 14500, '2025-04-10 04:38:50', '2025-04-10 06:03:15');

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
  `di_mooe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_items`
--

INSERT INTO `document_items` (`di_id`, `document_id`, `di_unit`, `di_description`, `di_quantity`, `di_unit_price`, `di_total_amount`, `di_mooe`) VALUES
(1, 2, 'Unit', 'Keyboard', 3, 1500, 4500, '5-02-03-010'),
(2, 2, 'Unit', 'ggsdg', 1, 10000, 10000, '5-02-13-050');

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
(1, 2, 'Pending', NULL, '2025-04-10 06:03:15', '2025-04-10 06:03:15');

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
(52, 'MIS Staff', 'Inserted Document', 'Fake Docx for April 04, 2025', '2025-04-08 02:46:01', '2025-04-08 02:46:01'),
(53, 'MIS Staff', 'Inserted Document', 'asdasdasd', '2025-04-10 04:18:41', '2025-04-10 04:18:41'),
(54, 'MIS Staff', 'Inserted Document', 'testasd', '2025-04-10 04:20:30', '2025-04-10 04:20:30'),
(55, 'MIS Staff', 'Inserted Document', 'Eviction Notice of Rhovin John Dulay', '2025-04-10 04:32:09', '2025-04-10 04:32:09'),
(56, 'MIS Staff', 'Inserted Document', 'Eviction Notice of Rhovin John Dulay', '2025-04-10 04:38:50', '2025-04-10 04:38:50'),
(57, 'MIS Staff', 'Added Items for', 'Eviction Notice of Rhovin John Dulay', '2025-04-10 05:52:21', '2025-04-10 05:52:21'),
(58, 'staff', 'Added Items for', 'Eviction Notice of Rhovin John Dulay', '2025-04-10 06:01:17', '2025-04-10 06:01:17');

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

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `office_name` varchar(255) NOT NULL,
  `office_budget` double UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`office_id`, `office_name`, `office_budget`, `created_at`, `updated_at`) VALUES
(1, 'Budget Office', 0, '2025-04-10 03:15:30', '2025-04-10 03:15:30'),
(2, 'Management Information System Office', 0, '2025-04-10 03:15:30', '2025-04-10 03:15:30'),
(3, 'Procurement Office', 0, '2025-04-10 03:15:30', '2025-04-10 03:16:00'),
(4, 'Accounting Office', 0, '2025-04-10 03:15:30', '2025-04-10 03:15:30');

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
('1081', 'Municipal Accounting Office', '2025-04-10 02:57:18', '2025-04-10 02:57:25'),
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
('4MlymdXcLxyaRmcVyfkdaQx9iigf6I3fMgWBwzZY', NULL, '192.168.100.40', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic1hjNlRVQXQ1UHdnNkZGNlNyVk9PejczYWhsVFBHZWdkcmJXSjIxZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xOTIuMTY4LjEwMC41Njo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1744265508),
('zfFA4W1qTMbP8aw3mWf6FRwWqT1bbkyeq98ohmDA', 1, '192.168.100.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicXJLV2RCMTBxVmhrNnpLRGV5U0oyYnZTQTNnaFpGYlc1OUlkMEV3dSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xOTIuMTY4LjEwMC41Njo4MDAwL3N0YWZmL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1744265292);

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
(6, 'Gallon', '2025-04-10 03:23:41', '2025-04-10 03:23:41');

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
(3, 2, 'Admin', 'admin@gmail.com', NULL, '$2y$12$HtXAIBj1f9B8zj8n11Po8O2W5qqgI5nJ23btovKFtCWNaXZjywxaW', 'Administrator', '6GzMta15vh6ZvH6uaZUyZSSTuCsaiw4yP8J50Ezy5AENB9YMEW6Vj7WITNWq', NULL, '2025-04-10 05:22:50'),
(4, 2, 'staff', 'staff@gmail.com', NULL, '$2y$12$XItCEqQJU4Pp4q23xYm24Ohzcb/WExVK5aWma0IGNJkZPnccIR/ie', 'Staff', NULL, '2025-03-18 21:48:31', '2025-04-10 03:47:15'),
(6, 2, 'MIS Staff', 'mis@gmail.com', NULL, '$2y$12$2/ORhT.wdMncmMJychYKjuZw3asXErhuPz1CbpV/N4kWcV7F5tBHe', 'Staff', NULL, '2025-03-31 08:02:45', '2025-04-10 04:50:48'),
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
  MODIFY `document_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `document_attachments`
--
ALTER TABLE `document_attachments`
  MODIFY `da_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_history`
--
ALTER TABLE `document_history`
  MODIFY `dh_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_items`
--
ALTER TABLE `document_items`
  MODIFY `di_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `document_pending`
--
ALTER TABLE `document_pending`
  MODIFY `dp_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `office_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
