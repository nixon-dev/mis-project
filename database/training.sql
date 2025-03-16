-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2025 at 02:31 PM
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
-- Database: `training`
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
  `document_id` int(255) NOT NULL,
  `document_title` text NOT NULL,
  `document_origin` int(255) NOT NULL,
  `document_nature` varchar(255) NOT NULL,
  `document_number` int(255) NOT NULL,
  `document_deadline` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`document_id`, `document_title`, `document_origin`, `document_nature`, `document_number`, `document_deadline`, `created_at`) VALUES
(8, 'Budget for IT Equipments', 1, 'Request Letter', 32151, '2025-02-11', '2025-02-02 17:55:56'),
(9, 'To payment of ICT Equipment and Furniture and Fixtures for the MIS Uni', 1, 'Bill', 1234, '2025-03-10', '2025-03-16 18:11:31'),
(10, 'Business Permit Application Form', 2, 'Permit', 892319, '2025-03-16', '2025-03-16 18:24:11'),
(11, 'Environmental Compliance Certificate (ECC)', 6, 'Infrastructure & Development', 54123, '2025-04-01', '2025-03-16 18:24:56'),
(13, 'Statement of Receipts and Expenditures', 5, 'Financial & Budgeting', 16234, '2025-03-30', '2025-03-16 19:14:15');

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
  `history_id` int(255) NOT NULL,
  `document_id` int(255) NOT NULL,
  `history_name` varchar(255) NOT NULL,
  `history_date` datetime NOT NULL,
  `history_action` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `document_id`, `history_name`, `history_date`, `history_action`, `created_at`) VALUES
(5, 13, 'Nickson Prieto', '2025-03-16 19:14:00', 'Prepared the documents', '2025-03-16 19:14:33'),
(6, 13, 'Mayor Garnace', '2025-03-16 21:07:00', 'Signed', '2025-03-16 21:07:34');

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
(4, '2024_10_15_025952_create_students_table', 1),
(5, '2025_03_14_012200_add_role_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `office_id` int(255) NOT NULL,
  `office_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`office_id`, `office_name`) VALUES
(1, 'Management Information System Office'),
(2, 'Registrar Office'),
(3, 'Accounting Office'),
(4, 'Population Office'),
(5, 'Mayor\'s Office'),
(6, 'Persons with Disabilities Affairs Office');

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
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3cSJ2CNtqzJ5kWtYmyjIeDknBNTeAkADS0u91W3K', 2, '192.168.1.65', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 OPR/117.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYldTWE44VXlGSjA1OUdlUnlJYkFmb05JVFBmU3VRdUFVQ2s4WEVFcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xOTIuMTY4LjEuNjU6MTIxOC9hZG1pbi92aWV3LWRvY3VtZW50LzEzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1742131863);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Guest'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Rhovin John Dulay', 'rhovin.supot@gmail.com', '2025-03-14 04:39:00', '$2y$12$TWsD0Y/gt9LghuzWGP4iROKaxLfO3tPB5/Se5uLDcXUV/wy6NkQR6', 'HfKEJQN3gTDM10BsCt8g0egJpY0Z0sK0t8nvgegser5E3iKIRaG55aAqrtWm', '2025-03-13 18:16:29', '2025-03-13 18:16:29', 'Staff'),
(2, 'Nickson Santos Prieto', 'nickson.prieto05@gmail.com', '2025-03-14 04:39:00', '$2y$12$TWsD0Y/gt9LghuzWGP4iROKaxLfO3tPB5/Se5uLDcXUV/wy6NkQR6', 'kmcKg61Ai7umLZsyhrZmhi2fjgRMwswa0rLTpntD7gf04h0uAcPpX5GT0joj', '2025-03-13 18:16:29', '2025-03-16 05:30:31', 'Administrator'),
(3, 'Rhovin John Dulay', 'rhovin.supot@pakaenam.com', NULL, '$2y$12$/8W8oBqscjZ250aNKvNWwu/AVOSoUBDVwELCkS71vseLc30symqiS', NULL, '2025-03-13 18:16:29', '2025-03-16 05:07:13', 'Guest'),
(4, 'Rhyan Ambrocio', 'rhyan.ambrocio@gmail.com', NULL, '$2y$12$Xg1YNi.R3ZuwZt9R8VEKbeQBAgTNHIuUsKFOivvZz9v364qc8wX/i', NULL, '2025-03-13 18:17:02', '2025-03-13 18:17:02', 'Guest'),
(5, 'asdasd', 'asdaasd@gmail.com', NULL, '$2y$12$/8nQyYqS68f8rzCM/ZIZlOCuge.7/yjJUE0psdAQPysiScJrrIFFO', NULL, '2025-03-15 22:28:29', '2025-03-15 22:28:29', 'Guest'),
(6, 'Admin Name', 'admin@gmail.com', NULL, '$2y$12$QMbhWqWCoTZLrwQu6sl8wef6Pv0QjaBvD2euJ5uvS5eNliuw57aEa', 'N1hJRS8AH1EsYTdL5Np2eqnmzBlNCA1QgLS8ckNw4ETDkpcH4TydKG7wVB0Q', '2025-03-15 22:30:17', '2025-03-16 05:28:19', 'Administrator');

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
  ADD PRIMARY KEY (`document_id`);

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
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `docx&history` (`document_id`);

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
  MODIFY `document_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `office_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `docx&history` FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
