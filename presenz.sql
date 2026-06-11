-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2026 at 04:50 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `presenz`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `shift_id` bigint UNSIGNED DEFAULT NULL,
  `check_in_time` datetime DEFAULT NULL,
  `check_out_time` datetime DEFAULT NULL,
  `check_in_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_out_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in_lat` decimal(10,8) DEFAULT NULL,
  `check_in_long` decimal(11,8) DEFAULT NULL,
  `check_in_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_out_lat` decimal(10,8) DEFAULT NULL,
  `check_out_long` decimal(11,8) DEFAULT NULL,
  `check_out_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in_ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_out_ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in_device` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_out_device` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Hadir','Terlambat','Alpha','Izin','Sakit','Cuti') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Alpha',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `shift_id`, `check_in_time`, `check_out_time`, `check_in_photo`, `check_out_photo`, `check_in_lat`, `check_in_long`, `check_in_address`, `check_out_lat`, `check_out_long`, `check_out_address`, `check_in_ip`, `check_out_ip`, `check_in_device`, `check_out_device`, `status`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 13, 1, '2026-06-02 16:41:44', '2026-06-02 16:41:52', 'attendances/check-in/pRUQLqVTyM.jpg', 'attendances/check-out/F3gqBfHHCd.jpg', -7.32073072, 112.76262537, NULL, -7.32073072, 112.76262537, NULL, '127.0.0.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'Hadir', NULL, '2026-06-02 09:41:44', '2026-06-02 09:41:52', NULL),
(2, 13, 1, '2026-06-07 13:05:07', '2026-06-07 13:10:11', 'attendances/check-in/trH4cEmW4r.jpg', 'attendances/check-out/SZMV155maX.jpg', -7.27977611, 112.74924309, NULL, -7.27983770, 112.74926650, NULL, '127.0.0.1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'Hadir', NULL, '2026-06-07 06:05:07', '2026-06-07 06:10:11', NULL),
(3, 15, 1, '2026-06-07 18:04:19', NULL, 'attendances/check-in/9Unl35KaRF.jpg', NULL, -7.27981473, 112.74929115, 'Jalan Karimata, RW 04, Ngagel, Wonokromo, Surabaya, Jawa Timur, Jawa, 60265, Indonesia', NULL, NULL, NULL, '127.0.0.1', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', NULL, 'Hadir', NULL, '2026-06-07 11:04:19', '2026-06-07 11:04:19', NULL),
(4, 13, 1, '2026-06-08 08:28:01', NULL, 'attendances/check-in/MCs9AX2V3u.jpg', NULL, -7.31174019, 112.72709988, 'Universitas Negeri Surabaya, Jalan Ketintang Timur PTT V, RW 04, Ketintang, Gayungan, Surabaya, Jawa Timur, 60231, Indonesia', NULL, NULL, NULL, '127.0.0.1', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', NULL, 'Hadir', NULL, '2026-06-08 01:28:01', '2026-06-08 01:28:01', NULL),
(5, 16, 1, '2026-06-11 10:30:41', NULL, 'attendances/check-in/iIAsykmyxe.jpg', NULL, -7.29645084, 112.73338621, 'Jalan Waringin, RW 05, Sawunggaling, Wonokromo, Surabaya, Jawa Timur, 60243, Indonesia', NULL, NULL, NULL, '127.0.0.1', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', NULL, 'Hadir', NULL, '2026-06-11 03:30:43', '2026-06-11 03:30:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_logs`
--

CREATE TABLE `attendance_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `attendance_id` bigint UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance_logs`
--

INSERT INTO `attendance_logs` (`id`, `attendance_id`, `action`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'check_in', 'User checked in at 2026-06-02 16:41:44', '2026-06-02 09:41:44', '2026-06-02 09:41:44'),
(2, 1, 'check_out', 'User checked out at 2026-06-02 16:41:52', '2026-06-02 09:41:52', '2026-06-02 09:41:52'),
(3, 2, 'check_in', 'User checked in at 2026-06-07 13:05:07', '2026-06-07 06:05:07', '2026-06-07 06:05:07'),
(4, 2, 'check_out', 'User checked out at 2026-06-07 13:10:11', '2026-06-07 06:10:11', '2026-06-07 06:10:11'),
(5, 3, 'check_in', 'User checked in at 2026-06-07 18:04:19', '2026-06-07 11:04:19', '2026-06-07 11:04:19'),
(6, 4, 'check_in', 'User checked in at 2026-06-08 08:28:01', '2026-06-08 01:28:01', '2026-06-08 01:28:01'),
(7, 5, 'check_in', 'User checked in at 2026-06-11 10:30:41', '2026-06-11 03:30:43', '2026-06-11 03:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-as@gmail.com|127.0.0.1', 'i:1;', 1780418432),
('laravel-cache-as@gmail.com|127.0.0.1:timer', 'i:1780418432;', 1780418432),
('laravel-cache-asa@gmail.com|127.0.0.1', 'i:1;', 1780848498),
('laravel-cache-asa@gmail.com|127.0.0.1:timer', 'i:1780848498;', 1780848498);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `code`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Information Technology', 'IT', NULL, '2026-05-18 09:42:56', '2026-05-18 09:42:56', NULL),
(2, 'Human Resources', 'HR', NULL, '2026-05-18 09:42:56', '2026-05-18 09:42:56', NULL),
(3, 'Operations', 'OPS', NULL, '2026-05-18 09:42:56', '2026-05-18 09:42:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `leave_type` enum('Cuti','Izin','Sakit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `user_id`, `leave_type`, `start_date`, `end_date`, `reason`, `attachment`, `status`, `approved_by`, `approved_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 13, 'Cuti', '2026-06-03', '2026-06-09', 'saya sakit tidak bisa bangun', 'leaves/lQWQfRpibudt4vVyiljmH9dilc4aJGu9qmP9C1Ug.jpg', 'Approved', 1, '2026-06-02 09:44:25', '2026-06-02 09:43:03', '2026-06-02 09:44:25', NULL),
(2, 15, 'Izin', '2026-06-08', '2026-06-09', 'tess', NULL, 'Approved', 1, '2026-06-11 03:37:28', '2026-06-08 01:36:28', '2026-06-11 03:37:28', NULL),
(3, 15, 'Sakit', '2026-06-10', '2053-07-10', 'aku atit', 'leaves/0M1QyVxqcPYHSMkBO9YHQZXA8OgIVslL29vPRrD5.jpg', 'Rejected', 1, '2026-06-11 03:37:45', '2026-06-10 08:36:21', '2026-06-11 03:37:45', NULL),
(4, 16, 'Sakit', '2026-06-11', '2026-06-12', 'atit', 'leaves/TMW5dUhHxJj3u1ocQ6jeBaBl10TS4lKVBmKuMF0h.jpg', 'Pending', NULL, NULL, '2026-06-11 03:32:45', '2026-06-11 03:32:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '0001_01_01_000003_create_personal_access_tokens_table', 1),
(5, '2024_01_01_000001_create_departments_table', 1),
(6, '2024_01_01_000002_create_positions_table', 1),
(7, '2024_01_01_000003_create_shifts_table', 1),
(8, '2024_01_01_000004_add_fields_to_users_table', 1),
(9, '2024_01_01_000005_create_user_shift_table', 1),
(10, '2024_01_01_000006_create_attendances_table', 1),
(11, '2024_01_01_000007_create_attendance_logs_table', 1),
(12, '2024_01_01_000008_create_leaves_table', 1),
(13, '2026_06_07_125642_add_api_key_to_users_table', 2),
(14, '2026_06_07_131314_add_address_columns_to_attendances_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth_token', '868b07d08ba8514bb226a5b78867bf594b8bb847cf05efc56631238cff1d6017', '[\"*\"]', NULL, NULL, '2026-06-07 08:59:25', '2026-06-07 08:59:25'),
(2, 'App\\Models\\User', 1, 'auth_token', '1e12db43402dc0fc1b193d683d1514153070ddb2d42e6afdd7aaf968f2b42307', '[\"*\"]', NULL, NULL, '2026-06-07 08:59:30', '2026-06-07 08:59:30');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `code`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Manager', 'MGR', NULL, '2026-05-18 09:42:56', '2026-05-18 09:42:56', NULL),
(2, 'Staff', 'STF', NULL, '2026-05-18 09:42:56', '2026-05-18 09:42:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3o0AG3N96VzF9sFBzbRu2Qf1JbG4EBNNudFPh9En', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'eyJfdG9rZW4iOiJreXc4eFJ1UndJRnlGZU1LTGhYTVFkaExUUW5VSFZNTVNKVzlZQWhrIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL3Byb2ZpbGUiLCJyb3V0ZSI6InByb2ZpbGUuZWRpdCJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=', 1781174285),
('McUaPqOZ2q38bpCA28bs69P0ezrXwJyA1mrHJqh5', 15, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'eyJfdG9rZW4iOiJtRWxoT2xtRmx3WVB4RmlYV0tUUTMzVkNjR2dzcGFtMTlPVlNyaTdHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sZWF2ZXMiLCJyb3V0ZSI6ImxlYXZlcy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxNX0=', 1781105782),
('w2gtBYhIl6HJcoJLXfGiOpfi95cxtjpuH0XSJMsf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.121.0 Chrome/142.0.7444.265 Electron/39.8.8 Safari/537.36', 'eyJfdG9rZW4iOiJhSlR2emFYc2ZuaUhpTjBhUUFhTVBNRE12ak9QcUpFOEtaQzA4MndyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1781173466);

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `name`, `start_time`, `end_time`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Shift Pagi', '08:00:00', '17:00:00', '2026-05-18 09:42:56', '2026-05-18 09:42:56', NULL),
(2, 'Shift Malam', '20:00:00', '05:00:00', '2026-05-18 09:42:56', '2026-05-18 09:42:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','hr','karyawan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'karyawan',
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_key` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `position_id` bigint UNSIGNED DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `nip`, `photo`, `remember_token`, `api_key`, `created_at`, `updated_at`, `department_id`, `position_id`, `phone`, `address`, `is_active`, `deleted_at`) VALUES
(1, 'Super Admin', 'admin@presenz.com', '2026-05-18 09:42:57', '$2y$12$67lab3fv6zNCvBd6xyfppOKOqKnEmTcp5SsT4teelXW1kDDbq7h7y', 'admin', 'ADM001', NULL, NULL, 'pk_wYm8vKRIdY7mcKSOjI2uSMmUvxy6PS27O8YctCVv', '2026-05-18 09:42:57', '2026-06-07 05:57:15', 1, 1, NULL, NULL, 1, NULL),
(2, 'HR Manager', 'hr@presenz.com', '2026-05-18 09:42:57', '$2y$12$mvsLvQ/1OHM4P8SQvCqZA.ARm7lAY.A/2aNnuMyaUDPDZrT7f20hy', 'hr', 'HR001', NULL, NULL, 'pk_2KtEclRdyST17kvezSFgoHqDaHhDPpV8fvwR39gQ', '2026-05-18 09:42:57', '2026-06-07 05:57:15', 2, 1, NULL, NULL, 1, NULL),
(3, 'Karyawan 1', 'karyawan1@presenz.com', '2026-05-18 09:42:58', '$2y$12$lQCDyPDu3CAcvzZkP2nnwe8zLVVE6DVO6qdwVHAidKeWRmq1nLeca', 'karyawan', 'EMP001', NULL, NULL, 'pk_u42uIOwZ9Be9I0R4Ae46bSSJ6R461T4uYHv1zYez', '2026-05-18 09:42:58', '2026-06-07 05:57:15', 1, 2, NULL, NULL, 1, NULL),
(4, 'Karyawan 2', 'karyawan2@presenz.com', '2026-05-18 09:42:59', '$2y$12$ZNDU3Igq1zRb5Vy8v..hmupOyJBqjhXSYgXHSMqNs0ZNawCJdjFai', 'karyawan', 'EMP002', NULL, NULL, 'pk_aExz6r9GToGdMwXlkneAoYy9OKFcncBT2bTQ8SDL', '2026-05-18 09:42:59', '2026-06-07 05:57:15', 3, 2, NULL, NULL, 1, NULL),
(5, 'Karyawan 3', 'karyawan3@presenz.com', '2026-05-18 09:42:59', '$2y$12$9lseLkaWxPsas/PkChHOj.NdbSncUpa6zb64B9/7lIG8yxkCzjuC.', 'karyawan', 'EMP003', NULL, NULL, 'pk_5VskwB7NXvFbuNJbAK2W05wfw8Ar3uiywdrsPrxN', '2026-05-18 09:42:59', '2026-06-07 05:57:15', 1, 2, NULL, NULL, 1, NULL),
(6, 'Karyawan 4', 'karyawan4@presenz.com', '2026-05-18 09:42:59', '$2y$12$RVcqRAWzQV7bkbWVXVOC2eZWs2jtUIVtD5ue09A6xhgYL/rnQOLae', 'karyawan', 'EMP004', NULL, NULL, 'pk_UcLg3878hpws3RlNeIhmfLeqAZSXmZVkiG9PE4jj', '2026-05-18 09:42:59', '2026-06-07 05:57:15', 3, 2, NULL, NULL, 1, NULL),
(7, 'Karyawan 5', 'karyawan5@presenz.com', '2026-05-18 09:43:00', '$2y$12$15szUep44X7sI5et4Pp7b.8FqNTIQu9F0wQ.joVPe07huAg2YCo2y', 'karyawan', 'EMP005', NULL, NULL, 'pk_IbXx7ivhuNuRjAM4vQdRUIVS9SrOrewPXAOCWvcp', '2026-05-18 09:43:00', '2026-06-07 05:57:15', 1, 2, NULL, NULL, 1, NULL),
(8, 'Karyawan 6', 'karyawan6@presenz.com', '2026-05-18 09:43:00', '$2y$12$iPPtfn4HVdlT6K4VgiqDYe7Btave9rEJxsvkPcgYLXi9kCFN2KxdG', 'karyawan', 'EMP006', NULL, NULL, 'pk_gqQWN7xKhpf7vJDQx2hqpsRdVWVNEDDBKI4qTMVl', '2026-05-18 09:43:00', '2026-06-07 05:57:15', 3, 2, NULL, NULL, 1, NULL),
(9, 'Karyawan 7', 'karyawan7@presenz.com', '2026-05-18 09:43:01', '$2y$12$TzZolzp/5PJ1wXOqqMN9DOAztSlW6sKCd/5PoZocMFRctlJ83SJWW', 'karyawan', 'EMP007', NULL, NULL, 'pk_SUSGOonHskImR1LPCXCmaUCqoeYNr3XQAQ90Sjqm', '2026-05-18 09:43:01', '2026-06-07 05:57:15', 1, 2, NULL, NULL, 1, NULL),
(10, 'Karyawan 8', 'karyawan8@presenz.com', '2026-05-18 09:43:01', '$2y$12$R6rivfdRD3dKmwwxvUtn.OGO6UUCCH2DC3z2oHmloOnSwaUfJ3QjO', 'karyawan', 'EMP008', NULL, NULL, 'pk_0DlLuvvnnwVuna0AIR7isrfaB3woTdZRpgQqOecJ', '2026-05-18 09:43:01', '2026-06-07 05:57:15', 3, 2, NULL, NULL, 1, NULL),
(11, 'Karyawan 9', 'karyawan9@presenz.com', '2026-05-18 09:43:01', '$2y$12$SQvfd2s6Oh7Q3badXpRCzulRRlGZwxsXWWZV.v4gyj1qniJLIx2aS', 'karyawan', 'EMP009', NULL, NULL, 'pk_qUS5DMjvE5Up7ihfM6yGUK1dv34v2xR2AYf6MFc5', '2026-05-18 09:43:01', '2026-06-07 05:57:15', 1, 2, NULL, NULL, 1, NULL),
(12, 'Karyawan 10', 'karyawan10@presenz.com', '2026-05-18 09:43:02', '$2y$12$ELCmaq.Tf41WubfJ3WHqbOQyl7ESTq/Xfo6UsN4HuphnWHEhzYLqO', 'karyawan', 'EMP010', NULL, NULL, 'pk_aHbzZlYpHa6pLiTp0Uaui6wBVJmuCKtWckB38uku', '2026-05-18 09:43:02', '2026-06-07 05:57:15', 3, 2, NULL, NULL, 1, NULL),
(13, 'hafidz asrof', 'hafidz@gmail.com', NULL, '$2y$12$F7xASCQE.kaGhPY5LS.1zOVU1IBrTSD5QH2uq98RIbOqg91qykqq.', 'karyawan', '12121212', 'profile-photos/Msbo61qBgnbR8TsJkHFAFUNbgiFRUz7HJkEdyRhv.jpg', NULL, 'pk_ROTe7MVrKUIQSEiFtuLWzfLDLHQGEh6cIym7IvU7', '2026-06-02 09:40:33', '2026-06-07 05:57:15', 2, 2, '085745141224', NULL, 1, NULL),
(14, 'ABYAN HERDI', '24091397150@unesa.ac.id', NULL, '$2y$12$1Oz85ymnxr7dad1QqvgSNe4n.mmTgeXJLoOadPEM2ashsGTditegK', 'karyawan', '240913971000', NULL, NULL, 'pk_qz63e78pg8nOOwQccAn8NjTjbD7zv9K1b90pUc2m', '2026-06-07 06:03:05', '2026-06-07 06:03:05', 2, 1, '082365758493', NULL, 1, NULL),
(15, 'nuril', 'nuril@gmail.com', NULL, '$2y$12$7.NYRd3kIH4t995gCwhuP.5sOktmp80063Zo5tmUfBW8AOVWmtx.C', 'karyawan', '123456789', NULL, NULL, 'pk_3PnX7gMChSKJsqqoEHUhfIAE5MrmJ4YRkvcE3Gep', '2026-06-07 09:08:21', '2026-06-07 09:08:21', 1, 1, '085723218776', NULL, 1, NULL),
(16, 'abitu', 'abiyu@gmail.com', NULL, '$2y$12$7ekRzagnEb0UzCeddJdIfOvn8JC2Z/tC5hKTb6lJPxRe9CBfWb1.e', 'karyawan', '2147839', 'profile-photos/ZrZMSQBKmltf1YfffTj7sbKNmoYCDNO17v3Eb7S9.jpg', NULL, 'pk_uQSb7kCatOy7aviUTEZRAkXvTAbZlzgY7iPRX7Yw', '2026-06-11 03:29:53', '2026-06-11 03:33:28', 1, 2, '09712897', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_shift`
--

CREATE TABLE `user_shift` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `shift_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_shift`
--

INSERT INTO `user_shift` (`id`, `user_id`, `shift_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2026-05-18 09:42:58', '2026-05-18 09:42:58'),
(2, 4, 2, '2026-05-18 09:42:59', '2026-05-18 09:42:59'),
(3, 5, 1, '2026-05-18 09:42:59', '2026-05-18 09:42:59'),
(4, 6, 2, '2026-05-18 09:42:59', '2026-05-18 09:42:59'),
(5, 7, 1, '2026-05-18 09:43:00', '2026-05-18 09:43:00'),
(6, 8, 2, '2026-05-18 09:43:00', '2026-05-18 09:43:00'),
(7, 9, 1, '2026-05-18 09:43:01', '2026-05-18 09:43:01'),
(8, 10, 2, '2026-05-18 09:43:01', '2026-05-18 09:43:01'),
(9, 11, 1, '2026-05-18 09:43:01', '2026-05-18 09:43:01'),
(10, 12, 2, '2026-05-18 09:43:02', '2026-05-18 09:43:02'),
(11, 13, 1, '2026-06-02 09:40:33', '2026-06-02 09:40:33'),
(12, 14, 2, '2026-06-07 06:03:05', '2026-06-07 06:03:05'),
(13, 15, 1, '2026-06-07 09:08:21', '2026-06-07 09:08:21'),
(14, 16, 1, '2026-06-11 03:29:53', '2026-06-11 03:29:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_shift_id_foreign` (`shift_id`),
  ADD KEY `attendances_user_id_status_index` (`user_id`,`status`);

--
-- Indexes for table `attendance_logs`
--
ALTER TABLE `attendance_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_logs_attendance_id_foreign` (`attendance_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

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
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leaves_user_id_foreign` (`user_id`),
  ADD KEY `leaves_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `positions_code_unique` (`code`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nip_unique` (`nip`),
  ADD UNIQUE KEY `users_api_key_unique` (`api_key`),
  ADD KEY `users_department_id_foreign` (`department_id`),
  ADD KEY `users_position_id_foreign` (`position_id`);

--
-- Indexes for table `user_shift`
--
ALTER TABLE `user_shift`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_shift_user_id_shift_id_unique` (`user_id`,`shift_id`),
  ADD KEY `user_shift_shift_id_foreign` (`shift_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attendance_logs`
--
ALTER TABLE `attendance_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_shift`
--
ALTER TABLE `user_shift`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attendance_logs`
--
ALTER TABLE `attendance_logs`
  ADD CONSTRAINT `attendance_logs_attendance_id_foreign` FOREIGN KEY (`attendance_id`) REFERENCES `attendances` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `leaves_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_shift`
--
ALTER TABLE `user_shift`
  ADD CONSTRAINT `user_shift_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_shift_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
