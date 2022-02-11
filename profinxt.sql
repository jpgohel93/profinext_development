-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2022 at 02:51 PM
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
(1, '23434', '345345', '3453455', NULL, 'Experiment', NULL, NULL, NULL, '2', '2022-02-11 12:17:09', '2022-02-11 12:17:09', NULL, NULL, NULL),
(2, 'sdfsdf', '45656', '456456', NULL, 'Paper Trade', NULL, NULL, NULL, '2', '2022-02-11 12:18:54', '2022-02-11 12:18:54', NULL, NULL, NULL),
(3, 'dfgd', 'dfg', 'dfgdfg', NULL, 'Terminated', NULL, NULL, NULL, '2', '2022-02-11 12:19:09', '2022-02-11 12:19:09', NULL, NULL, NULL),
(4, 'helloTrading', 'analystWorld', 'analystWorldYT', NULL, 'Active', NULL, NULL, NULL, '2', '2022-02-11 12:30:29', '2022-02-11 12:30:29', NULL, NULL, NULL),
(5, 'sfgdfg', 'gfdfg', 'dfgdf', NULL, 'Active', NULL, NULL, NULL, '2', '2022-02-11 18:24:17', '2022-02-11 18:24:17', NULL, NULL, NULL),
(6, 'helloTrading', 'analystWorld', 'analystWorldYT', 'sdfgsdfg', 'Active', NULL, NULL, NULL, '2', '2022-02-11 18:30:53', '2022-02-11 18:30:53', NULL, NULL, NULL);

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
(1, '3434', 1, NULL, '2022-02-11 12:17:09', '2022-02-11 12:17:09'),
(2, 'r546456', 2, NULL, '2022-02-11 12:18:54', '2022-02-11 12:18:54'),
(3, 'fdgd', 3, NULL, '2022-02-11 12:19:09', '2022-02-11 12:19:09'),
(4, '123456789', 4, NULL, '2022-02-11 12:30:29', '2022-02-11 12:30:29'),
(5, '345354', 5, NULL, '2022-02-11 18:24:17', '2022-02-11 18:24:17'),
(6, '345345', 5, NULL, '2022-02-11 18:24:17', '2022-02-11 18:24:17'),
(7, '123456789', 6, NULL, '2022-02-11 18:30:53', '2022-02-11 18:30:53');

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
(1, 1, '2022-02-11', 'tata tcs x', '5544', '1500', '1600', '1440', '50', '2022-02-11 12:20:15', '2022-02-11 12:20:46', '2022-02-11 12:20:46', '2');

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
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `number`, `communication_with`, `wp_number`, `profession`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'demoAbcd', '123123123', 'Admin', '123123123', 'Private', 1, '2', 2, '2022-02-11 12:24:14', '2022-02-11 18:59:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_banks`
--

CREATE TABLE `client_banks` (
  `id` int(11) NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_banks`
--

INSERT INTO `client_banks` (`id`, `bank`, `created_at`, `updated_at`, `deleted_at`, `created_by`) VALUES
(1, 'HDFC', '2022-02-11 12:01:34', '2022-02-11 12:01:34', NULL, '2'),
(2, 'ICICI', '2022-02-11 12:01:40', '2022-02-11 12:01:40', NULL, '2'),
(3, 'SBI', '2022-02-11 12:01:44', '2022-02-11 12:01:44', NULL, '2'),
(4, 'CBI', '2022-02-11 12:01:48', '2022-02-11 12:01:48', NULL, '2');

-- --------------------------------------------------------

--
-- Table structure for table `client_brokers`
--

CREATE TABLE `client_brokers` (
  `id` int(11) NOT NULL,
  `broker` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_brokers`
--

INSERT INTO `client_brokers` (`id`, `broker`, `created_at`, `updated_at`, `deleted_at`, `created_by`) VALUES
(1, 'HDFC broker', '2022-02-11 12:01:19', '2022-02-11 12:01:19', NULL, '2'),
(2, 'ICICI Broker', '2022-02-11 12:01:27', '2022-02-11 12:01:27', NULL, '2');

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
(10, 1, 'SG', 'serial 1', '1', 'pan 1', 'shani', 'HDFC broker', 'shani', '$2y$10$94ZqOFAtOtKt8/GCj6sJee9cwizU5lplR1jIb4/mxhUeQhgyTazO2', '$2y$10$OMVlTinMEbEF4.zTzhC8Lu9JRUBOezL/7uimEsuA6h/yDgjDr391i', '55000', '2022-02-11 18:59:46', '2022-02-11 18:59:46', '2', NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `client_professions`
--

CREATE TABLE `client_professions` (
  `id` int(11) NOT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_professions`
--

INSERT INTO `client_professions` (`id`, `profession`, `created_at`, `updated_at`, `deleted_at`, `created_by`) VALUES
(1, 'Accountant', '2022-02-11 12:00:53', '2022-02-11 12:00:53', NULL, '2'),
(2, 'Private', '2022-02-11 12:00:59', '2022-02-11 12:00:59', NULL, '2'),
(3, 'Business Man', '2022-02-11 12:01:11', '2022-02-11 12:01:11', NULL, '2');

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
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2);

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
(20, 'calls-delete', 'web', NULL, NULL),
(21, 'trader-read', 'web', NULL, NULL),
(22, 'trader-write', 'web', NULL, NULL),
(23, 'trader-create', 'web', NULL, NULL),
(24, 'trader-delete', 'web', NULL, NULL);

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
(2, 'user', 'web', '2022-01-27 21:39:44', '2022-01-27 21:39:44', NULL),
(3, 'customer relationship manager', 'web', '2022-02-09 09:22:34', '2022-02-09 09:22:34', NULL),
(4, 'Accountant', 'web', '2022-02-09 09:22:54', '2022-02-09 09:22:54', NULL),
(5, 'trader', 'web', '2022-02-10 10:13:08', '2022-02-10 10:13:08', NULL);

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
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2);

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

-- --------------------------------------------------------

--
-- Table structure for table `trader`
--

CREATE TABLE `trader` (
  `id` bigint(20) NOT NULL,
  `client_id` int(11) NOT NULL,
  `trader_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trader`
--

INSERT INTO `trader` (`id`, `client_id`, `trader_id`, `created_at`, `created_by`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2022-02-11 12:24:57', '2', '2022-02-11 12:24:57', NULL);

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
  `account_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` int(10) DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percentage` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` datetime NOT NULL DEFAULT current_timestamp(),
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
(1, 'dfgdfgd', 'test@admin.com', NULL, '$2y$10$w2LqjOuRuG3oWkzEWQIhFeEEVY.QH74ZfHuldHsgxuT/gWKzLoIdq', 1, 'hdfc', '546456456', 'hdfc1234', 'Service Account', 2, NULL, NULL, '44000', '2022-02-11 00:00:00', 'dfgdfg', 'super-admin', NULL, NULL, NULL, '2022-02-11 18:48:08', '2', NULL),
(2, 'admin', 'admin@gmail.com', NULL, '$2y$10$QaAbWIxtolj8uGcYe27LDO8HenLJbqaQFzZ5MAc2ZUVnTdlcR9e3O', 1, 'hdfc', '456879546321', 'hdfc1234', 'Selecte Account Type', 1, 'demo', '55', NULL, '2022-02-11 00:00:00', 'admin', 'super-admin', NULL, '2022-02-11 06:29:52', '1', '2022-02-11 11:59:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_account_types`
--

CREATE TABLE `user_account_types` (
  `id` int(10) NOT NULL,
  `account_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_account_types`
--

INSERT INTO `user_account_types` (`id`, `account_type`, `created_at`, `created_by`, `deleted_at`, `updated_at`) VALUES
(1, 'Service Account', '2022-02-11 12:00:35', '2', NULL, '2022-02-11 12:00:35'),
(2, 'Current Account', '2022-02-11 12:00:45', '2', NULL, '2022-02-11 12:00:45');

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
(1, 2, '123456789', '2022-02-11 11:59:52', NULL, '2022-02-11 11:59:52', NULL),
(2, 1, '4564564', '2022-02-11 12:23:29', '2022-02-11 18:48:08', '2022-02-11 18:48:08', NULL),
(5, 1, '4564564', '2022-02-11 18:48:08', NULL, '2022-02-11 18:48:08', NULL);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `client_banks`
--
ALTER TABLE `client_banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_brokers`
--
ALTER TABLE `client_brokers`
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
-- Indexes for table `client_professions`
--
ALTER TABLE `client_professions`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `trader`
--
ALTER TABLE `trader`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `trader_id` (`trader_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_account_types`
--
ALTER TABLE `user_account_types`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `analyst_numbers`
--
ALTER TABLE `analyst_numbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `calls`
--
ALTER TABLE `calls`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client_banks`
--
ALTER TABLE `client_banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client_brokers`
--
ALTER TABLE `client_brokers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `client_demat`
--
ALTER TABLE `client_demat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `client_mode`
--
ALTER TABLE `client_mode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_payment`
--
ALTER TABLE `client_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `client_professions`
--
ALTER TABLE `client_professions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trader`
--
ALTER TABLE `trader`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_account_types`
--
ALTER TABLE `user_account_types`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_numbers`
--
ALTER TABLE `user_numbers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `trader`
--
ALTER TABLE `trader`
  ADD CONSTRAINT `trader_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trader_ibfk_2` FOREIGN KEY (`trader_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_numbers`
--
ALTER TABLE `user_numbers`
  ADD CONSTRAINT `user_numbers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
