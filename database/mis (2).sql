-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2025 at 10:53 AM
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
  `document_origin` int(255) NOT NULL,
  `document_nature` varchar(255) NOT NULL,
  `document_number` varchar(255) NOT NULL,
  `document_deadline` datetime DEFAULT NULL,
  `document_status` varchar(255) NOT NULL DEFAULT 'Pending',
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
(2, 'To payment of ICT Equipment and Furniture and Fixtures for the MIS Unit', 2, 'Payment', '250319-00002', '2025-04-01 08:00:00', 'Approved', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 5313.53, '2025-02-19 08:11:24', '2025-03-31 08:35:36'),
(3, 'To reimburse', 4, 'Payment', '250319-00003', '2025-03-19 00:00:00', 'Pending', 'true', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 0, '2025-01-20 08:11:28', '2025-03-30 05:29:52'),
(6, 'Eviction Notice of Rhovin John Dulay', 2, 'Eviction Notice', '250320-00001', NULL, 'Denied', 'true', 'true', 'false', 'true', 'true', 'false', 'false', 'false', 3244.42, '2025-02-20 01:36:41', '2025-03-30 07:38:38'),
(16, 'Converge Bill', 2, 'Payment', '250325-00001', '2025-03-25 09:55:00', 'Pending', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 1923, '2025-01-25 01:55:24', '2025-03-30 05:29:44'),
(17, 'To reimburse', 3, 'Payment', '250327-00001', '2025-03-27 13:58:00', 'Pending', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 0, '2025-02-27 05:58:47', '2025-03-30 05:29:27'),
(19, 'Statement of Receipts and Expenditures', 4, 'Financial & Budgeting', '250330-00001', '2025-03-30 13:30:00', 'Pending', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 0, '2025-03-30 05:30:17', '2025-03-30 05:30:17'),
(20, 'Budget for IT Equipments', 3, 'Financial & Budgeting', '250330-00002', NULL, 'Pending', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 0, '2025-03-30 08:06:36', '2025-03-30 08:06:36'),
(22, 'The Temporary Name of a Fake Document', 1, 'Fake Document', '250331-00001', NULL, 'Pending', 'true', 'true', 'true', 'true', 'false', 'false', 'false', 'false', 0, '2025-03-31 06:47:46', '2025-03-31 08:13:34');

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
(32, 20, 'file-sample_100kB_1743385718.docx', 'docx');

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
(2, 3, 'zxccz', '2025-03-24 00:00:00', 'zxc', NULL, NULL),
(3, 3, 'dasdd', '2025-03-24 00:00:00', 'das', '2025-03-24 08:27:46', '2025-03-24 08:27:46'),
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
(39, 2, 'Budget Office Staff', '2025-03-31 16:35:36', 'Signed CANVASS', '2025-03-31 08:35:36', '2025-03-31 08:35:36');

-- --------------------------------------------------------

--
-- Table structure for table `document_items`
--

CREATE TABLE `document_items` (
  `di_id` bigint(20) UNSIGNED NOT NULL,
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `di_unit` varchar(255) NOT NULL,
  `di_description` text NOT NULL,
  `di_quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_items`
--

INSERT INTO `document_items` (`di_id`, `document_id`, `di_unit`, `di_description`, `di_quantity`) VALUES
(1, 16, 'unit', 'Steel Rack Cabinet (Steel Rack Cabinet for equipment storage)', 1),
(2, 16, 'Set', 'Printer', 3),
(3, 16, 'Unit', 'ccv', 6),
(4, 16, 'Set', 'asd', 1),
(5, 20, 'Set', 'Dulay', 8),
(6, 2, 'Unit', 'Keyboard', 2);

-- --------------------------------------------------------

--
-- Table structure for table `document_pending`
--

CREATE TABLE `document_pending` (
  `dp_id` bigint(20) UNSIGNED NOT NULL,
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `dp_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `dp_remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_pending`
--

INSERT INTO `document_pending` (`dp_id`, `document_id`, `dp_status`, `dp_remarks`) VALUES
(1, 22, 'Pending', NULL),
(3, 16, 'Pending', NULL),
(4, 2, 'Pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(32, 'Rhovin John Dulay', 'Inserted Document', 'The Temporary Name of a Fake Document', '2025-03-31 06:47:46', '2025-03-31 06:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `office_id` int(255) NOT NULL,
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
('E7MPLX9lSkLK8exJz12ypTBm5syoMDGIu8MvuFQC', 3, '192.168.100.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU1p6VlV5TFBiU1YzNkhGNU4waE1pdkdHRXhVSnVvNnJ3M0VkWTlyOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xOTIuMTY4LjEwMC41Njo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1743408179),
('HHA2hEIhYZUGP47x8njn5Y9wEXtvQKBbD9fLRlOH', NULL, '192.168.100.59', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRTFJc1ZGbTBWMVNlaUk3eVlqZTluUXVVdG1rNXpDbUNlaXRBRXo4WiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xOTIuMTY4LjEwMC41Njo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1743410366),
('OZLxJVnvKatW73j6vg0FfBcmjWCu7CoUpnhTHLq1', 7, '192.168.100.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia0dXeThmaGNFWnkzbFlMT3VLVVlkd2lETE1rZ3Y1MWFSQjBtVmpqeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njg6Imh0dHA6Ly8xOTIuMTY4LjEwMC41Njo4MDAwL3N0YWZmL3BlbmRpbmctZG9jdW1lbnRzL3ZpZXcvMjUwMzMxLTAwMDAxIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzt9', 1743409023);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `office_id` int(255) UNSIGNED DEFAULT NULL,
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
(1, 1, 'Rhovin John Dulay', 'rhovin.dulay@gmail.com', NULL, '$2y$12$3EWCkLKX4ZSl1dO8H9a4LuGUnM8bKKAuFQStBfiZDWOGZ4.TSAT7.', 'Staff', '2SQLTf49rF3xtUkivK7cUzc6PpFNyDkIH6V7D5eND3xLFOIJIPe720vE4jgf', '2025-03-16 23:21:29', '2025-03-31 08:14:41'),
(2, NULL, 'MIS', 'misofficediffun@gmail.com', NULL, '$2y$12$7H52v3F5tfXxzYWA/fNLB.7YSxiaWlYu6NpiLdp4iyB.SYFuLdJ9.', 'Administrator', NULL, NULL, NULL),
(3, 2, 'Admin', 'admin@gmail.com', NULL, '$2y$12$80JzF8KP3MpIKjs11BE1.eWXPDeGQ06nZv7T4cwgFwp2GKYTaX8k6', 'Administrator', 'hCwCrXmb0WhrSSN5gR45Ak9GIIG5bT8mb2O3iQdyEjpXEmIBcTed0MSbC9rh', NULL, '2025-03-31 08:16:15'),
(4, 2, 'staff', 'staff@gmail.com', NULL, '$2y$12$XItCEqQJU4Pp4q23xYm24Ohzcb/WExVK5aWma0IGNJkZPnccIR/ie', 'Staff', NULL, '2025-03-18 21:48:31', '2025-03-18 22:42:41'),
(6, 2, 'MIS Staff', 'mis@gmail.com', NULL, '$2y$12$ftUBwuWNyg/xAKCaWDQ.9.5hkyglWt7DhrtyCVm6WcOuXRZs2sUby', 'Staff', NULL, '2025-03-31 08:02:45', '2025-03-31 08:06:09'),
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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `document_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `document_attachments`
--
ALTER TABLE `document_attachments`
  MODIFY `da_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `document_history`
--
ALTER TABLE `document_history`
  MODIFY `dh_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `document_items`
--
ALTER TABLE `document_items`
  MODIFY `di_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `document_pending`
--
ALTER TABLE `document_pending`
  MODIFY `dp_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `office_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `office` FOREIGN KEY (`document_origin`) REFERENCES `office` (`office_id`);

--
-- Constraints for table `document_items`
--
ALTER TABLE `document_items`
  ADD CONSTRAINT `Document Items` FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
