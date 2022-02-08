-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2022 at 02:40 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `profinxt`
--

-- --------------------------------------------------------

--
-- Table structure for table `analysts`
--

CREATE TABLE `analysts` (
  `id` bigint(20) NOT NULL,
  `analyst` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Active,Experiment,Paper Trade,Terminated',
  `total_calls` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accuracy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trading_capacity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `analysts`
--

INSERT INTO `analysts` (`id`, `analyst`, `telegram_id`, `youtube`, `website`, `status`, `total_calls`, `accuracy`, `trading_capacity`, `created_by`, `created_at`, `updated_at`, `deleted_at`, `deleted_by`, `updated_by`) VALUES
(1, 'helloTrading', 'helloTrading123', 'https://youtube.com/helloTrading123', 'helloTrading.com', 'Experiment', '8', '60%', '88', '2', '2022-02-08 12:07:08', '2022-02-08 16:32:50', '2022-02-08 07:32:04', NULL, NULL),
(2, 'analyst', 'analystWorld', 'analystWorldYT', NULL, 'Terminated', '8', '90%', '98', '2', '2022-02-08 13:10:38', '2022-02-08 16:30:15', NULL, NULL, NULL),
(3, 'analyst', 'analystWorld', 'analystWorldYT', NULL, 'Experiment', NULL, NULL, NULL, '2', '2022-02-08 13:11:04', '2022-02-08 13:11:04', NULL, NULL, NULL),
(4, 'analyst', 'analystWorld', 'analystWorldYT', NULL, 'Experiment', NULL, NULL, NULL, '2', '2022-02-08 13:16:22', '2022-02-08 13:16:22', NULL, NULL, NULL),
(5, 'demo', 'adasd', 'asdasd', NULL, 'Active', '9', '90%', '100', '2', '2022-02-08 13:20:04', '2022-02-08 16:07:23', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `analyst_numbers`
--

CREATE TABLE `analyst_numbers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `analyst_id` bigint(20) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `analyst_numbers`
--

INSERT INTO `analyst_numbers` (`id`, `number`, `analyst_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '123456789', 1, '2022-02-08 07:37:17', '2022-02-08 12:07:36', NULL),
(2, '987789987', 1, '2022-02-08 07:37:17', '2022-02-08 12:07:36', NULL),
(3, '123456789', 3, NULL, '2022-02-08 13:11:04', '2022-02-08 13:11:04'),
(4, '555444555', 3, NULL, '2022-02-08 13:11:04', '2022-02-08 13:11:04'),
(5, '666444666', 3, NULL, '2022-02-08 13:11:04', '2022-02-08 13:11:04'),
(6, '123456789', 4, NULL, '2022-02-08 13:16:22', '2022-02-08 13:16:22'),
(7, '555444555', 4, NULL, '2022-02-08 13:16:22', '2022-02-08 13:16:22'),
(8, '666444666', 4, NULL, '2022-02-08 13:16:22', '2022-02-08 13:16:22'),
(9, NULL, 5, NULL, '2022-02-08 13:20:04', '2022-02-08 13:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `calls`
--

CREATE TABLE `calls` (
  `id` bigint(20) NOT NULL,
  `analyst_id` bigint(20) NOT NULL,
  `due_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lot_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stop_loss` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `margin_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calls`
--

INSERT INTO `calls` (`id`, `analyst_id`, `due_date`, `script_name`, `lot_size`, `entry_price`, `target_price`, `stop_loss`, `margin_value`, `created_at`, `updated_at`, `deleted_at`, `created_by`) VALUES
(1, 1, '2022-02-08', 'Tata TCS', '55', '1350', '1445', '1230', '400', '2022-02-08 16:58:41', '2022-02-08 18:18:18', NULL, '2'),
(2, 1, '2022-02-08', 'tata tcs', '5544', '1500', '1550', '1440', '50', '2022-02-08 18:44:41', '2022-02-08 19:08:11', '2022-02-09 19:08:08', '2');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `communication_with` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wp_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `number`, `communication_with`, `wp_number`, `profession`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'demouser', '123123123', 'Admin', '123123123', 'Business Man', 0, '2', NULL, '2022-02-08 11:32:47', '2022-02-08 11:33:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_demat`
--

CREATE TABLE `client_demat` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `st_sg` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `broker` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mpin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capital` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_demat`
--

INSERT INTO `client_demat` (`id`, `client_id`, `st_sg`, `serial_number`, `service_type`, `pan_number`, `holder_name`, `broker`, `user_id`, `password`, `mpin`, `capital`, `created_at`, `updated_at`, `updated_by`, `deleted_at`) VALUES
(1, 1, 'ST', 'serial 1', '1', 'pan 1', 'Shani', 'Business Man', 'shani', '$2y$10$3yE27q7XjpCM8jC8gSpwwe6Cb3Gb8k.DZeQSlxSOdTiwgMexJH/Mi', '$2y$10$9Tlr57V0U.rulPZPiJCcou6ZXP2mPSePjLl1ZXTzkbfh6wXciFOpO', '55000', '2022-02-08 11:32:47', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_mode`
--

CREATE TABLE `client_mode` (
  `id` int(11) NOT NULL,
  `mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_payment`
--

CREATE TABLE `client_payment` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` datetime DEFAULT NULL,
  `fees` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mode` int(11) DEFAULT NULL,
  `pending_payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `screenshots` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_payment`
--

INSERT INTO `client_payment` (`id`, `client_id`, `bank`, `joining_date`, `fees`, `mode`, `pending_payment`, `screenshots`, `created_at`, `updated_at`, `deleted_at`, `updated_by`) VALUES
(1, 1, 'ICICI', '2022-02-08 00:00:00', '25,000', 2, '1', NULL, '2022-02-08 11:32:47', '2022-02-08 11:32:47', NULL, '2');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_01_12_092312_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 3),
(1, 'App\\Models\\User', 6),
(1, 'App\\Models\\User', 8),
(6, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'client-read', 'web', NULL, NULL),
(2, 'client-write', 'web', NULL, NULL),
(3, 'client-create', 'web', NULL, NULL),
(4, 'client-delete', 'web', NULL, NULL),
(5, 'role-read', 'web', NULL, NULL),
(6, 'role-write', 'web', NULL, NULL),
(7, 'role-create', 'web', NULL, NULL),
(8, 'role-delete', 'web', NULL, NULL),
(9, 'user-read', 'web', NULL, NULL),
(10, 'user-write', 'web', NULL, NULL),
(11, 'user-create', 'web', NULL, NULL),
(12, 'user-delete', 'web', NULL, NULL),
(13, 'analyst-read', 'web', NULL, NULL),
(14, 'analyst-write', 'web', NULL, NULL),
(15, 'analyst-create', 'web', NULL, NULL),
(16, 'analyst-delete', 'web', NULL, NULL),
(17, 'calls-read', 'web', NULL, NULL),
(18, 'calls-write', 'web', NULL, NULL),
(19, 'calls-create', 'web', NULL, NULL),
(20, 'calls-delete', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'super-admin', 'web', '2022-01-22 04:35:49', '2022-01-22 04:35:49', NULL),
(6, 'user', 'web', '2022-01-27 21:39:44', '2022-01-27 21:39:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 6),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(5, 6),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 6),
(10, 1),
(10, 6),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_screenshots`
--

CREATE TABLE `tbl_screenshots` (
  `id` int(10) NOT NULL,
  `client_payment_id` int(11) NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_screenshots`
--

INSERT INTO `tbl_screenshots` (`id`, `client_payment_id`, `file`, `mime_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 21, '8ICYBbckDGDXT6YqTBtNVGJn6pSj1tLukNsUDS6f.jpg', 'image/jpeg', '2022-02-04 20:22:06', '2022-02-04 20:22:06', NULL),
(3, 21, 'M0gEvZXlmnU2AoLBfJ1BmA24kIJlSaACCjK8csHV.jpg', 'image/jpeg', '2022-02-04 20:22:06', '2022-02-04 20:22:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsc_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type` int(10) DEFAULT NULL,
  `user_type` int(10) DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percentage` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` date NOT NULL DEFAULT current_timestamp(),
  `job_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `bank_name`, `account_number`, `ifsc_code`, `account_type`, `user_type`, `company`, `percentage`, `salary`, `joining_date`, `job_description`, `role`, `remember_token`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`) VALUES
(2, 'admin', 'test@admin.com', NULL, '$2y$10$PosLnPcx9kMIxPmHwIhz2u7cR6/zzqMVWVDO1ezt.SiSkdhCODlRa', 1, 'hdfc', '4353453', 'HDFC01212', 1, 1, 'helloWorld', '90', NULL, '2022-01-27', 'dfgdfdgdfdfg', 'super-admin', NULL, '2022-01-23 02:59:58', '', '2022-01-27 20:15:10', '2', NULL),
(3, 'user', 'user@gmail.com', NULL, '$2y$10$HjDyFEBwtU8a2q4mLm7XsOwTAJHh2Un3twkeHF6iDP2KlAUBiZwPy', 1, 'hdfc', '879546412312', 'HDFC01212', 1, 2, 'testcompany', '34', '25000', '2022-01-25', 'demo description', 'super-admin', NULL, '2022-01-25 01:29:12', '2', '2022-01-27 20:09:06', '2', '2022-01-27 20:09:06'),
(4, 'demouser', 'demo@admin.com', NULL, '$2y$10$T7ndAkcOQp3fYd4RlOgIduRoLWa6BfUqiiQ7ZrEb/kzcHyhRttcXe', 1, 'hdfc', '38946293846', 'HDFC01212', 1, 2, NULL, NULL, '11000', '2022-01-28', 'testing', 'user', NULL, '2022-01-25 11:40:58', '2', '2022-01-28 03:10:44', '2', NULL),
(5, 'hello', 'hello@yahoo.com', NULL, '$2y$10$tZNRM6wM0jMXBPZ4WJQJUuVNQk5AN1sM0Uival0yFu66EFR60M5Du', 1, 'demo', '3462389476', 'HDFC01212', 1, 1, 'demo', '5', NULL, '2022-01-27', 'hgfgfghfg', 'user', NULL, '2022-01-27 14:44:10', '2', '2022-01-27 20:14:23', NULL, '2022-01-27 20:14:23'),
(6, 'demouser', 'demo@test.com', NULL, '$2y$10$MTbw6Ag0MVOc6wlcYVq3.uD/kzMwk5KXbUS3bUX5spoPGEHgq/qRi', 1, 'demo', '543534534534', 'HDFC01212', 2, 2, NULL, NULL, '55000', '2022-01-28', 'dfxgdfgdfgdf', 'user', NULL, '2022-01-27 19:31:48', '2', '2022-01-28 01:01:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_numbers`
--

CREATE TABLE `user_numbers` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_numbers`
--

INSERT INTO `user_numbers` (`id`, `user_id`, `number`, `created_at`, `deleted_at`, `updated_at`, `updated_by`) VALUES
(1, 2, '255345343', '2022-01-23 08:29:58', '2022-01-27 20:15:10', '2022-01-27 20:15:10', NULL),
(2, 3, '12345456789', '2022-01-25 06:59:12', '2022-01-25 16:33:11', '2022-01-25 16:33:11', NULL),
(3, 3, '789456123', '2022-01-25 06:59:12', '2022-01-25 16:33:11', '2022-01-25 16:33:11', NULL),
(4, 3, '789456123', '2022-01-25 16:34:46', '2022-01-25 16:35:48', '2022-01-25 16:35:48', NULL),
(5, 3, '789456123', '2022-01-25 16:35:48', '2022-01-25 16:41:09', '2022-01-25 16:41:09', NULL),
(6, 3, '789456123', '2022-01-25 16:41:09', '2022-01-25 16:41:29', '2022-01-25 16:41:29', NULL),
(7, 3, '789456123', '2022-01-25 16:41:29', '2022-01-25 16:41:49', '2022-01-25 16:41:49', NULL),
(8, 3, '789456123', '2022-01-25 16:41:49', '2022-01-25 16:42:06', '2022-01-25 16:42:06', NULL),
(9, 3, '789456123', '2022-01-25 16:42:06', '2022-01-25 16:42:41', '2022-01-25 16:42:41', NULL),
(10, 3, '789456123', '2022-01-25 16:42:41', '2022-01-25 16:44:35', '2022-01-25 16:44:35', NULL),
(11, 3, '789456123', '2022-01-25 16:44:35', '2022-01-25 16:45:09', '2022-01-25 16:45:09', NULL),
(12, 3, '789456123', '2022-01-25 16:45:09', '2022-01-25 16:45:43', '2022-01-25 16:45:43', NULL),
(13, 3, '789456123', '2022-01-25 16:45:43', '2022-01-25 16:46:24', '2022-01-25 16:46:24', NULL),
(14, 3, '789456123', '2022-01-25 16:46:24', '2022-01-25 16:48:39', '2022-01-25 16:48:39', NULL),
(15, 3, '789456123', '2022-01-25 16:48:39', '2022-01-25 16:48:55', '2022-01-25 16:48:55', NULL),
(16, 3, '789456123', '2022-01-25 16:48:55', '2022-01-25 16:50:14', '2022-01-25 16:50:14', NULL),
(17, 3, '789456123', '2022-01-25 16:50:14', '2022-01-25 16:50:47', '2022-01-25 16:50:47', NULL),
(18, 3, '789456123', '2022-01-25 16:50:47', '2022-01-25 16:51:10', '2022-01-25 16:51:10', NULL),
(19, 3, '789456123', '2022-01-25 16:51:10', '2022-01-25 16:52:15', '2022-01-25 16:52:15', NULL),
(20, 3, '123456', '2022-01-25 16:51:10', '2022-01-25 16:52:15', '2022-01-25 16:52:15', NULL),
(21, 3, '789456123', '2022-01-25 16:52:15', NULL, '2022-01-25 16:52:15', NULL),
(22, 3, '123456', '2022-01-25 16:52:15', NULL, '2022-01-25 16:52:15', NULL),
(23, 4, '34534535434', '2022-01-25 17:10:58', '2022-01-25 17:20:10', '2022-01-25 17:20:10', NULL),
(24, 4, '34534535434', '2022-01-25 17:20:10', '2022-01-25 17:23:21', '2022-01-25 17:23:21', NULL),
(25, 4, '34534535434', '2022-01-25 17:23:21', '2022-01-28 03:10:26', '2022-01-28 03:10:26', NULL),
(26, 5, '6792384629386', '2022-01-27 20:14:10', NULL, '2022-01-27 20:14:10', NULL),
(27, 2, '255345343', '2022-01-27 20:15:10', NULL, '2022-01-27 20:15:10', NULL),
(28, 6, '7897879789', '2022-01-28 01:01:48', NULL, '2022-01-28 01:01:48', NULL),
(29, 4, '34534535434', '2022-01-28 03:10:26', '2022-01-28 03:10:44', '2022-01-28 03:10:44', NULL),
(30, 4, '34534535434', '2022-01-28 03:10:44', NULL, '2022-01-28 03:10:44', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analysts`
--
ALTER TABLE `analysts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `analyst_numbers`
--
ALTER TABLE `analyst_numbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `analyst_id` (`analyst_id`);

--
-- Indexes for table `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `analyst` (`analyst_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_demat`
--
ALTER TABLE `client_demat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `client_mode`
--
ALTER TABLE `client_mode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_payment`
--
ALTER TABLE `client_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `mode` (`mode`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `tbl_screenshots`
--
ALTER TABLE `tbl_screenshots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_id` (`client_payment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_numbers`
--
ALTER TABLE `user_numbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analysts`
--
ALTER TABLE `analysts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `analyst_numbers`
--
ALTER TABLE `analyst_numbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `calls`
--
ALTER TABLE `calls`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client_demat`
--
ALTER TABLE `client_demat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client_mode`
--
ALTER TABLE `client_mode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_payment`
--
ALTER TABLE `client_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_screenshots`
--
ALTER TABLE `tbl_screenshots`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_numbers`
--
ALTER TABLE `user_numbers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `analyst_numbers`
--
ALTER TABLE `analyst_numbers`
  ADD CONSTRAINT `analyst_numbers_ibfk_1` FOREIGN KEY (`analyst_id`) REFERENCES `analysts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `calls`
--
ALTER TABLE `calls`
  ADD CONSTRAINT `calls_ibfk_1` FOREIGN KEY (`analyst_id`) REFERENCES `analysts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client_demat`
--
ALTER TABLE `client_demat`
  ADD CONSTRAINT `client_demat_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client_payment`
--
ALTER TABLE `client_payment`
  ADD CONSTRAINT `client_payment_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_numbers`
--
ALTER TABLE `user_numbers`
  ADD CONSTRAINT `user_numbers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
