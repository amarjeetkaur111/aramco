-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 05, 2023 at 08:24 AM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aramco_cms_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `apiusers`
--

DROP TABLE IF EXISTS `apiusers`;
CREATE TABLE IF NOT EXISTS `apiusers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `national_id` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_national_id_unique` (`national_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `apiusers`
--

INSERT INTO `apiusers` (`id`, `national_id`, `batch_id`, `name`, `email`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'waseem', 'waseem@rayqube.com', NULL, NULL, '$2y$10$kNtsoyO0EuxxQJxloZhDRuA/1iV4NT1eQZ3pWkTM3dLoUOpWBhgW2', NULL, '2023-03-30 03:24:12', '2023-03-30 03:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `computing_resources_request`
--

DROP TABLE IF EXISTS `computing_resources_request`;
CREATE TABLE IF NOT EXISTS `computing_resources_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `usecase_name` varchar(100) NOT NULL,
  `contact_of_usecase` text NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `num_of_employees` int(11) NOT NULL,
  `justification` text NOT NULL,
  `additional_info` text NOT NULL,
  `status_of_request` enum('Pending','Approved','Rejected','Deleted') NOT NULL,
  `date_of_request` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `computing_resources_request`
--

INSERT INTO `computing_resources_request` (`id`, `users_id`, `usecase_name`, `contact_of_usecase`, `start_date`, `end_date`, `num_of_employees`, `justification`, `additional_info`, `status_of_request`, `date_of_request`, `created_at`, `updated_at`) VALUES
(1, 11, 'test event', '123456', NULL, NULL, 3, 'there is no justification', 'no', 'Pending', '2023-04-19', '2023-04-19 08:56:53', '2023-04-19 08:56:53');

-- --------------------------------------------------------

--
-- Table structure for table `current_implementation_level`
--

DROP TABLE IF EXISTS `current_implementation_level`;
CREATE TABLE IF NOT EXISTS `current_implementation_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `current_implementation_level`
--

INSERT INTO `current_implementation_level` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Submitted', '2023-04-28 09:49:33', '2023-04-28 09:50:46'),
(2, 'Screened', '2023-04-28 09:49:33', '2023-04-28 09:50:46'),
(3, 'Selected', '2023-04-28 09:49:55', '2023-04-28 09:50:46'),
(4, 'Incubated', '2023-04-28 09:50:06', '2023-04-28 09:50:46'),
(5, 'Graduated', '2023-04-28 09:50:18', '2023-04-28 09:50:46'),
(6, 'Scaleup', '2023-04-28 09:50:31', '2023-04-28 09:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `event_request`
--

DROP TABLE IF EXISTS `event_request`;
CREATE TABLE IF NOT EXISTS `event_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `space_name` varchar(500) NOT NULL,
  `required_resources` varchar(50) DEFAULT NULL,
  `other_required_resource` text,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `num_of_attendees` int(11) NOT NULL,
  `coordinator_contact` varchar(100) NOT NULL,
  `justification` text NOT NULL,
  `additional_info` text NOT NULL,
  `status_of_request` enum('Pending','Approved','Rejected') NOT NULL,
  `date_of_request` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_request`
--

INSERT INTO `event_request` (`id`, `users_id`, `event_name`, `space_name`, `required_resources`, `other_required_resource`, `start_date`, `end_date`, `num_of_attendees`, `coordinator_contact`, `justification`, `additional_info`, `status_of_request`, `date_of_request`, `created_at`, `updated_at`) VALUES
(1, 11, 'test event', '', 'Conference Theater', NULL, '2023-05-10 00:00:00', '2023-04-19 11:30:00', 3, '123456', 'there is no justification', 'no', 'Pending', '2023-04-19 00:00:00', '2023-04-19 08:37:49', '2023-04-19 08:37:49'),
(2, 11, 'test event', 'test hall', 'Conference Theater', NULL, '2023-05-10 11:30:00', '2023-05-11 12:30:00', 3, '123456', 'there is no justification', 'no', 'Pending', '2023-04-19 00:00:00', '2023-04-19 09:56:21', '2023-04-19 09:56:21'),
(3, 11, 'test event', 'test hall', 'Conference Theater', NULL, '2023-05-10 11:30:00', '2023-05-11 12:30:00', 3, '123456', 'there is no justification', 'no', 'Pending', '2023-04-19 00:00:00', '2023-04-24 06:15:05', '2023-04-24 06:15:05'),
(4, 11, 'test event', 'test hall', 'Conference Theater', NULL, '2023-05-10 11:30:00', '2023-05-11 12:30:00', 4, '123456', 'there is no justification', 'no', 'Pending', '2023-04-19 00:00:00', '2023-04-24 06:15:36', '2023-04-24 06:15:36'),
(5, 11, 'test event', 'test hall', 'Conference Theater', NULL, '2023-05-10 11:30:00', '2023-05-11 12:30:00', 4, '123456', 'there is no justification', 'no', 'Pending', '2023-04-19 00:00:00', '2023-04-24 06:48:01', '2023-04-24 06:48:01'),
(6, 11, 'test event', 'test hall', 'Conference Theater', NULL, '2023-05-10 11:30:00', '2023-05-11 12:30:00', 4, '123456', 'there is no justification', 'no', 'Pending', '2023-04-19 00:00:00', '2023-04-24 06:48:44', '2023-04-24 06:48:44'),
(7, 11, 'test event', 'test hall', 'Conference Theater', NULL, '2023-05-10 11:30:00', '2023-05-11 12:30:00', 4, '123456', 'there is no justification', 'no', 'Pending', '2023-04-19 00:00:00', '2023-04-24 06:50:18', '2023-04-24 06:50:18'),
(8, 11, 'test event', 'test hall', 'Conference Theater', NULL, '2023-05-10 11:30:00', '2023-05-11 12:30:00', 4, '123456', 'there is no justification', 'no', 'Pending', '2023-04-19 00:00:00', '2023-04-24 06:50:24', '2023-04-24 06:50:24'),
(9, 11, 'test event', 'test hall', 'Conference Theater', NULL, '2023-05-10 11:30:00', '2023-05-11 12:30:00', 4, '123456', 'there is no justification', 'no', 'Pending', '2023-04-19 00:00:00', '2023-04-24 06:50:36', '2023-04-24 06:50:36');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `general_reservation`
--

DROP TABLE IF EXISTS `general_reservation`;
CREATE TABLE IF NOT EXISTS `general_reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `description` text NOT NULL,
  `justification` text NOT NULL,
  `status_of_request` enum('Pending','Approved','Rejected','Deleted') NOT NULL DEFAULT 'Pending',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `idea_request`
--

DROP TABLE IF EXISTS `idea_request`;
CREATE TABLE IF NOT EXISTS `idea_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `track_channel` varchar(100) NOT NULL,
  `idea_name` varchar(100) NOT NULL,
  `idea_problem` text NOT NULL,
  `idea_solution` text NOT NULL,
  `idea_resource_requirement` text NOT NULL,
  `contributors` text NOT NULL,
  `point_of_contact` text NOT NULL,
  `current_implementation_level` int(11) NOT NULL,
  `technology` int(11) NOT NULL,
  `other_technology` text,
  `attachment` text,
  `status_of_request` enum('Pending','Approved','Rejected','Deleted') NOT NULL,
  `date_of_request` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `idea_request`
--

INSERT INTO `idea_request` (`id`, `users_id`, `track_channel`, `idea_name`, `idea_problem`, `idea_solution`, `idea_resource_requirement`, `contributors`, `point_of_contact`, `current_implementation_level`, `technology`, `other_technology`, `attachment`, `status_of_request`, `date_of_request`, `created_at`, `updated_at`) VALUES
(1, 11, 'test track idea', 'idea detail', '', '', '', 'there is no contributor', 'sasassss', 0, 0, NULL, 'adadda', 'Pending', '2023-04-25', '2023-04-19 10:04:35', '2023-04-19 10:04:35');

-- --------------------------------------------------------

--
-- Table structure for table `incubator_request`
--

DROP TABLE IF EXISTS `incubator_request`;
CREATE TABLE IF NOT EXISTS `incubator_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `usecase_name` varchar(100) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `contact_of_usecase` text NOT NULL,
  `num_of_employees` int(11) NOT NULL,
  `justification` text NOT NULL,
  `additional_info` text NOT NULL,
  `status_of_request` enum('Pending','Approved','Rejected','Deleted') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incubator_request`
--

INSERT INTO `incubator_request` (`id`, `users_id`, `usecase_name`, `start_date`, `end_date`, `contact_of_usecase`, `num_of_employees`, `justification`, `additional_info`, `status_of_request`, `created_at`, `updated_at`) VALUES
(1, 11, 'test event', '2023-05-10 00:00:00', NULL, '123456', 3, 'there is no justification', 'no', 'Pending', '2023-04-19 08:51:56', '2023-04-19 08:51:56'),
(2, 11, 'test event', '2023-05-10 00:00:00', NULL, '123456', 3, 'there is no justification', 'no', 'Pending', '2023-04-24 06:18:13', '2023-04-24 06:18:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Apis\\User', 1),
(3, 'App\\Models\\Apis\\User', 2),
(1, 'App\\Models\\Apis\\User', 3),
(3, 'App\\Models\\Apis\\User', 4),
(3, 'App\\Models\\Apis\\User', 5),
(3, 'App\\Models\\Apis\\User', 6),
(3, 'App\\Models\\Apis\\User', 7),
(3, 'App\\Models\\Apis\\User', 8),
(4, 'App\\Models\\Apis\\User', 9),
(4, 'App\\Models\\Apis\\User', 10),
(3, 'App\\Models\\Apis\\User', 11),
(3, 'App\\Models\\Apis\\User', 12),
(3, 'App\\Models\\Apis\\User', 13),
(3, 'App\\Models\\Apis\\User', 14),
(3, 'App\\Models\\Apis\\User', 15),
(3, 'App\\Models\\Apis\\User', 16),
(3, 'App\\Models\\Apis\\User', 17),
(3, 'App\\Models\\Apis\\User', 18),
(3, 'App\\Models\\Apis\\User', 19),
(3, 'App\\Models\\Apis\\User', 20),
(3, 'App\\Models\\Apis\\User', 21),
(3, 'App\\Models\\Apis\\User', 22),
(3, 'App\\Models\\Apis\\User', 24),
(3, 'App\\Models\\Apis\\User', 25),
(3, 'App\\Models\\Apis\\User', 26),
(5, 'App\\Models\\Apis\\User', 26),
(3, 'App\\Models\\Apis\\User', 27),
(3, 'App\\Models\\Apis\\User', 28),
(3, 'App\\Models\\Apis\\User', 29),
(3, 'App\\Models\\Apis\\User', 30),
(3, 'App\\Models\\Apis\\User', 32),
(4, 'App\\Models\\Apis\\User', 33),
(3, 'App\\Models\\Apis\\User', 34),
(3, 'App\\Models\\Apis\\User', 35),
(3, 'App\\Models\\Apis\\User', 36),
(3, 'App\\Models\\Apis\\User', 37),
(4, 'App\\Models\\Apis\\User', 37),
(1, 'App\\Models\\Apis\\User', 38),
(3, 'App\\Models\\Apis\\User', 39);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('008806977cdad4d4f80af54ffb232662434980a68761998d9f00fa4d36f34439cc9182c0e7dc68e4', 1, 1, 'MyApp', '[]', 0, '2023-04-03 10:04:06', '2023-04-03 10:04:06', '2024-04-03 10:04:06'),
('02808c723af449510a77d08f7f283eecfc40a576ddacb5f1aeabcd02b992abe7f1c036dd507f79ee', 1, 1, 'MyApp', '[]', 0, '2023-04-10 07:33:02', '2023-04-10 07:33:02', '2024-04-10 07:33:02'),
('0420a0e575b6442f061caff72bafd92a2d746b7e9a730d1e3a68ca77aec48f90d91b007cf9752a47', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:31:09', '2023-04-10 22:31:09', '2024-04-10 22:31:09'),
('06f93a5e852da34af452397915fe3662f6f1252a9b32c6ec64ceb3bc289953fb28579df2272a3ebb', 1, 1, 'MyApp', '[]', 0, '2023-03-31 10:33:06', '2023-03-31 10:33:06', '2024-03-31 10:33:06'),
('0700e576d08c5fb2c3e875170ae04930dcd5d87536d8dea06e745b614b7b3987cfbe29a70761c231', 1, 1, 'MyApp', '[]', 0, '2023-04-04 10:58:41', '2023-04-04 10:58:41', '2024-04-04 10:58:41'),
('0742e7d0b02339cd07d8cc6f6e9c73e61f59119c27931aef28dd7a99538ad463c6b634595d90dbbb', 1, 1, 'MyApp', '[]', 0, '2023-03-31 11:50:31', '2023-03-31 11:50:31', '2024-03-31 11:50:31'),
('075d9a78b8cd1c0d9cc1b80bc60a0972306cd102fb7e3605c89b9989530bb16d7e4f41390b64e236', 1, 1, 'MyApp', '[]', 0, '2023-03-31 11:46:23', '2023-03-31 11:46:23', '2024-03-31 11:46:23'),
('077efb7be597044f37d15fd0e586e2036cedac175cc804b518f6eb6dae69d9257d4e6dc6b1dc9154', 1, 1, 'MyApp', '[]', 0, '2023-04-10 23:25:55', '2023-04-10 23:25:55', '2024-04-10 23:25:55'),
('089bfa595ec56224f34032fd4f317ff6ddd5cbd31c0f50e969de71ee2b57e262339caa258233dfe4', 1, 1, 'MyApp', '[]', 0, '2023-04-04 07:42:34', '2023-04-04 07:42:34', '2024-04-04 07:42:34'),
('0a757e84dcd74d30564d073145f5e1f9c5e8be3bca3432842903783646d394edc78fc73893d1a82c', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:10:05', '2023-04-03 06:10:05', '2024-04-03 06:10:05'),
('0a852bf516f546f3d8f4440395dcd08b0ad43c0af0fd14c99b4001f720bd44a5550e16d734ad1f19', 1, 1, 'MyApp', '[]', 0, '2023-04-03 09:55:34', '2023-04-03 09:55:34', '2024-04-03 09:55:34'),
('0d38aae8ac376ccdf9157afbc646e158c522b80f3d897d1c89772164dafdbcbe9f80a137aaf99dff', 1, 1, 'MyApp', '[]', 0, '2023-04-11 00:17:57', '2023-04-11 00:17:57', '2024-04-11 00:17:57'),
('0d966ef9f902a11ce0486437044d86593224e5a1990af5cc8ab7505f1d582f72417c5948428a70d9', 1, 1, 'MyApp', '[]', 0, '2023-04-06 09:30:02', '2023-04-06 09:30:02', '2024-04-06 09:30:02'),
('0ef1b6a5efe4d811b6a03d7b3f1b2971e149821693778484faca1a3f81c4fb0f16666717486143b5', 1, 1, 'MyApp', '[]', 0, '2023-04-01 12:58:53', '2023-04-01 12:58:53', '2024-04-01 12:58:53'),
('0fb47dd13bc5ead703385ec16260b5cf59b2a0e85189385fbc2e1620ee9590dd21e96de7218b59c3', 1, 1, 'MyApp', '[]', 0, '2023-04-10 08:39:38', '2023-04-10 08:39:38', '2024-04-10 08:39:38'),
('10cadc499e781ca367028cc559b7291deca3a7112e3e32a7d4017f822a0778615cde34b55691a249', 1, 1, 'MyApp', '[]', 0, '2023-04-10 13:26:35', '2023-04-10 13:26:35', '2024-04-10 13:26:35'),
('122d98bf346ec4631a4a902eb4e0b9e446c3dc6874e47c98780b7039a2505c78ded697bb2af08f75', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:24:59', '2023-04-03 06:24:59', '2024-04-03 06:24:59'),
('1279f4ed2cd460bfa41ee32ce958c1b338d36e5b557ef30e71f9d81a1ba4b908eab299dad97da2d5', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:39:23', '2023-04-10 22:39:23', '2024-04-10 22:39:23'),
('1281f66be1d5a154a96b9e7798e75144a28279a661efd4d80ec5a31d69ce2a71d587f14965c90787', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:16:14', '2023-04-10 22:16:14', '2024-04-10 22:16:14'),
('12982452847106550bbfb2ff7468005d0c701956c5fc75beb580270f5c624b76041452d530fb1306', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:24:51', '2023-04-10 22:24:51', '2024-04-10 22:24:51'),
('1318ea1426fc9a7973b4a2e4f361b4a35f3f05b239e60da83e00444018300ec88978f54f5efbe21f', 1, 1, 'MyApp', '[]', 0, '2023-04-03 09:06:09', '2023-04-03 09:06:09', '2024-04-03 09:06:09'),
('13f22f7adab1de06f6cb737058e271f3ca1c5f552e4c77ec265cacd6abba19fe4b9bf4ad59e8c97b', 1, 1, 'MyApp', '[]', 0, '2023-04-18 11:10:16', '2023-04-18 11:10:16', '2024-04-18 11:10:16'),
('14108a7289625b599cbea322687033d5ddb8c7071ca595c2c2b7af634c40a053cc0ec4c9d8529540', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:44:57', '2023-04-03 06:44:57', '2024-04-03 06:44:57'),
('149ef80c4d58c1212705e6e5c221d2152dfda6f5e92762ff09169abc125fe963c4798a139c26f99f', 1, 1, 'MyApp', '[]', 0, '2023-03-31 11:59:27', '2023-03-31 11:59:27', '2024-03-31 11:59:27'),
('154bbebe2b756c873e805003afe1426eeb6b2ada463d977cad274a6c0398fea243e4d26defa5adce', 1, 1, 'MyApp', '[]', 0, '2023-04-10 23:04:19', '2023-04-10 23:04:19', '2024-04-10 23:04:19'),
('15a21d2b8f3be5065bdabe55137a6ba88037e9684109f9e63718ff753203f083833ed6bc11e5f1e6', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:03:37', '2023-04-03 06:03:37', '2024-04-03 06:03:37'),
('15e294d666b107fd3fedebbef1877e73daca88db0f30b58bc92747d7b4035b83c22593740ef8d21c', 1, 1, 'MyApp', '[]', 0, '2023-04-05 10:23:13', '2023-04-05 10:23:13', '2024-04-05 10:23:13'),
('16d3bbbdd820f2a0f70fddbce10cc66808c40c42059209bda1dd5faac48af61058dc6460db80c9c7', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:46:01', '2023-04-10 22:46:01', '2024-04-10 22:46:01'),
('17d371bf19c5e88362d705894bd02f56e72f5660cc6bdb81a7b3def53675cf946087b73808ea3d0c', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:33:40', '2023-04-10 22:33:40', '2024-04-10 22:33:40'),
('183973318020fb806f542e95fcd81f758a1e7d0dc16e2836d2b875bb79464399441de378c007dcb8', 1, 1, 'MyApp', '[]', 0, '2023-04-01 13:05:57', '2023-04-01 13:05:57', '2024-04-01 13:05:57'),
('18d6ef5c882970ff7315af4b706024b91397f0ca96f4abdd402734685e007291897fbdadb25d82a4', 1, 1, 'MyApp', '[]', 0, '2023-04-03 08:13:53', '2023-04-03 08:13:53', '2024-04-03 08:13:53'),
('1e6a440b4dfff15edfdf88b1da370f20b198928e2f38922e852bb03631b7285779d22a1b44ffa3fc', 1, 1, 'MyApp', '[]', 0, '2023-04-04 09:43:31', '2023-04-04 09:43:31', '2024-04-04 09:43:31'),
('2183c83fb92673b295b340283dd15fb8ad40435ce920e4569fccd6361226cc4e15b5612091e90ce8', 1, 1, 'MyApp', '[]', 0, '2023-04-05 09:21:37', '2023-04-05 09:21:37', '2024-04-05 09:21:37'),
('2199845431a2ce57e70cf0e492a0ce22a73c515fd10efc10bd1104189aad73afbbdca41449bc21cd', 1, 1, 'MyApp', '[]', 0, '2023-04-07 06:45:36', '2023-04-07 06:45:36', '2024-04-07 06:45:36'),
('21d3d5c0c10241c16e1421aab06e37faf6a6201ea2561e113981b567519101e5057a23eb711e4627', 1, 1, 'MyApp', '[]', 0, '2023-04-06 07:17:46', '2023-04-06 07:17:46', '2024-04-06 07:17:46'),
('227edde9069735f109b2fd09b0ec2b2d7274bec3e88ba4b01cbdd5dc3834456e5ffd690335439f1d', 1, 1, 'MyApp', '[]', 0, '2023-04-10 13:18:47', '2023-04-10 13:18:47', '2024-04-10 13:18:47'),
('229fd3d9c176697a844a88d73f1b176efebe32c174c2218360391fd5391213728749f82f633e4c8b', 1, 1, 'MyApp', '[]', 0, '2023-04-10 18:48:32', '2023-04-10 18:48:32', '2024-04-10 18:48:32'),
('233414f3da7dfde657dd52ce1218775b2ed03622fd7d789f382819c100fab2fc51fde0299b993e16', 1, 1, 'MyApp', '[]', 0, '2023-04-10 21:58:07', '2023-04-10 21:58:07', '2024-04-10 21:58:07'),
('23b580d48c909a60f307d5ee321bf2748ba7208dd68040a8d65e17683776f25671a8bdf9eca9f37e', 1, 1, 'MyApp', '[]', 0, '2023-04-03 08:28:11', '2023-04-03 08:28:11', '2024-04-03 08:28:11'),
('244ab15e406e0f009c2470f62d54b6739eb4ac33fba06bdfae6d12f8a1ff5bc87e4b0247bbe8b1b3', 1, 1, 'MyApp', '[]', 0, '2023-04-06 09:46:37', '2023-04-06 09:46:37', '2024-04-06 09:46:37'),
('24a9b4bd1751adedb6c060e048c9c401afb4d29cfe78d11aa07f096032ccd38d00d4aa21800b18d2', 1, 1, 'MyApp', '[]', 0, '2023-04-06 05:58:39', '2023-04-06 05:58:39', '2024-04-06 05:58:39'),
('24b09522dc7aef8e8663fe77ecf9c34883d9064a3a39bd4fa339f4e4475c030f08a5f25505b4496c', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:32:17', '2023-04-10 22:32:17', '2024-04-10 22:32:17'),
('24f265faf4f0d3addf9f0630e02f8db5be443b8bcbb4ebb660f24f738c16ba65611ffb6274991900', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:12:08', '2023-04-10 22:12:08', '2024-04-10 22:12:08'),
('25274c45e2dc86a342b09b8190af0c5b4f196a681d5efe262819db5e3fa10485e15c47c9fcf1e75a', 1, 1, 'MyApp', '[]', 0, '2023-04-04 11:49:14', '2023-04-04 11:49:14', '2024-04-04 11:49:14'),
('26364a45d76c1b4ae07dd96dbce4a38a679f1f1732659720ac9219c56fbbf0fbb38b31166291fb05', 1, 1, 'MyApp', '[]', 0, '2023-04-10 23:45:33', '2023-04-10 23:45:33', '2024-04-10 23:45:33'),
('274dcbaed8e8989870b4b4a518384ecba4aa891a5f74ecbd5fe3c02d6103099b4d4944c4b2afb555', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:32:31', '2023-04-10 22:32:31', '2024-04-10 22:32:31'),
('27da0d2a55907206104ace4fec36aeddfb7f6ebfc76646ab042f82a130ba1dd87317770e27ddca1b', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:09:16', '2023-04-10 22:09:16', '2024-04-10 22:09:16'),
('29473b789814f22ab368f0afc57e251d3de43a089015ebb967388b8deb0811eb643124ac0de773ac', 1, 1, 'MyApp', '[]', 0, '2023-04-03 10:12:45', '2023-04-03 10:12:45', '2024-04-03 10:12:45'),
('29aadbadfc34fe65001a7d2c6fb9dcd00c0ee0a2a0d2d56f89fea071c545dbc4ff8b4b98ecd60502', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:27:12', '2023-04-10 22:27:12', '2024-04-10 22:27:12'),
('29bb2d68c499c4cc79c9d45b23d616578529007897cb7f28be2907f2953d734e674a0cdba97eb953', 1, 1, 'MyApp', '[]', 0, '2023-03-31 11:54:15', '2023-03-31 11:54:15', '2024-03-31 11:54:15'),
('29bea90f64b10f1388e4a4b9b941dae0fa50da0e474055c32ffb6b4fa478ede24e65c1d754c92793', 1, 1, 'MyApp', '[]', 0, '2023-04-11 09:49:25', '2023-04-11 09:49:25', '2024-04-11 09:49:25'),
('2aad01df8aeb84fb1800f54402d24b6cc04414f140cefcf981e475623eb97e29ebe60b13ac8a06a3', 1, 1, 'MyApp', '[]', 0, '2023-04-11 00:14:41', '2023-04-11 00:14:41', '2024-04-11 00:14:41'),
('2ad5375c42854e52e60d718cfef21a2efd519ea0a9f5cde9c1a4bff6b2051be5ddb3e632fdacc88e', 1, 1, 'MyApp', '[]', 0, '2023-04-03 10:39:22', '2023-04-03 10:39:22', '2024-04-03 10:39:22'),
('2c3202f4e5cf87a975832cc126da4ba9f5e169ee899d1009f26e03b26f8b06d216ec5e3e0bf0e90f', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:50:45', '2023-04-03 06:50:45', '2024-04-03 06:50:45'),
('2d09488cb9175704e06761db61ab43a9dc8e1e866a01121ae66f02c5375415339fcb45cb978e529b', 1, 1, 'MyApp', '[]', 0, '2023-04-09 12:44:47', '2023-04-09 12:44:47', '2024-04-09 12:44:47'),
('2db9cd521301ce7ea35bd3a72214241423988be7261ac960c0f5a1330cd479a959276dbeb432854d', 1, 1, 'MyApp', '[]', 0, '2023-04-10 06:48:42', '2023-04-10 06:48:42', '2024-04-10 06:48:42'),
('2eb2d5dc02c631d2ce5efa0e0f2f3ef0c31cb4a23b467911da074902a9a81ac0a5c631acd631f6f9', 1, 1, 'MyApp', '[]', 0, '2023-04-04 07:50:39', '2023-04-04 07:50:39', '2024-04-04 07:50:39'),
('2fcc359781a16b7e6adf1633b159a526fb36d65289903c4650762c5c47c702740f4acfe0e691fe7d', 1, 1, 'MyApp', '[]', 0, '2023-04-07 08:50:49', '2023-04-07 08:50:49', '2024-04-07 08:50:49'),
('3054d952ef62a7df465b438d65fe09e795dae11ab6d971574f7bfb66a71e2243a72a09a776908546', 1, 1, 'MyApp', '[]', 0, '2023-04-10 23:50:35', '2023-04-10 23:50:35', '2024-04-10 23:50:35'),
('31b0179359164aab69f6391611ceb7654c0c95cf3ee415b5afde4410f32f9c284d13a6ae08573551', 1, 1, 'MyApp', '[]', 0, '2023-04-03 09:35:10', '2023-04-03 09:35:10', '2024-04-03 09:35:10'),
('33958939332aa1375ea390afa20f4264c8fcd8998f12fb0fdcef148d14380fa0456266643468b7a0', 1, 1, 'MyApp', '[]', 0, '2023-04-03 08:22:20', '2023-04-03 08:22:20', '2024-04-03 08:22:20'),
('33d2dacde87efda867d752102d35c1980aaf9a65a9ac4ba013b506008c955f761ad4a31e2faad1c5', 1, 1, 'MyApp', '[]', 0, '2023-04-06 09:30:47', '2023-04-06 09:30:47', '2024-04-06 09:30:47'),
('343c3a0d615a1d2b62bbe2406047452069d6c73a647fd1d2ead9ea2051b4c86151e94df2ea40e375', 1, 1, 'MyApp', '[]', 0, '2023-04-01 13:31:41', '2023-04-01 13:31:41', '2024-04-01 13:31:41'),
('3512064d302eea597dd5212bf5d579ebf6b19fbb3e2f966bcb1cd4b1347d6a82887cb9860f505d01', 1, 1, 'MyApp', '[]', 0, '2023-04-11 00:07:45', '2023-04-11 00:07:45', '2024-04-11 00:07:45'),
('36585fd000bb30495649d8076f3fae680190a212723dc5d9c5d4a0ffa907e7b9f10cc79860868538', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:27:25', '2023-04-03 06:27:25', '2024-04-03 06:27:25'),
('37989e5dadd2d9d690d3cf87e3d2b1f12581bedf957bffebc4c1aaaf661391e8f2ec9748dd30bd9e', 1, 1, 'MyApp', '[]', 0, '2023-04-03 09:11:14', '2023-04-03 09:11:14', '2024-04-03 09:11:14'),
('38fab8aa95cd55728972abc0397d9e7fd3ed23b66ae80252f42323e587e59fdb4c9b2f1561756fc4', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:37:14', '2023-04-03 06:37:14', '2024-04-03 06:37:14'),
('39473f75099848d54926c811eb1e7e27d5a785d3e6cc48916ae7658ee4c907547607f995af7d0618', 1, 1, 'MyApp', '[]', 0, '2023-04-01 13:01:39', '2023-04-01 13:01:39', '2024-04-01 13:01:39'),
('3a1b0d793c7b2db94be27a155e41dfe0656637b4413ad3270e9505f20c52d4632af4cb64f072085e', 1, 1, 'MyApp', '[]', 0, '2023-04-10 13:17:14', '2023-04-10 13:17:14', '2024-04-10 13:17:14'),
('3c13c10f1a6fa560ae69802c38bc55c6199ef2ccf1b9084d7d4839e016d27102ca6a2166ce9a5e98', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:47:13', '2023-04-10 12:47:13', '2024-04-10 12:47:13'),
('3d3a3d0a7fc8dc532ea94bc01ae4a7bf5718a73257e7ca09217ab5ccae110f1d222520cda8a0cfa2', 1, 1, 'MyApp', '[]', 0, '2023-04-10 13:16:47', '2023-04-10 13:16:47', '2024-04-10 13:16:47'),
('3ddc88e4331520a8d5f68acead87f3d32d5190a05b6d25e8e773c630de1da0d7c852aa8b70c5b2f7', 1, 1, 'MyApp', '[]', 0, '2023-04-04 11:17:58', '2023-04-04 11:17:58', '2024-04-04 11:17:58'),
('3e350c8d6f7069f75af5612cd9a926103b52c97b8d64c5d23e04b70516796f01de535077f23f96b6', 1, 1, 'MyApp', '[]', 0, '2023-04-10 21:10:02', '2023-04-10 21:10:02', '2024-04-10 21:10:02'),
('3e71b6820b86e68aa8b09f29400c467125c00cfb03c9b27406135b3527c19e2ae747a5cb75278138', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:03:30', '2023-04-10 12:03:30', '2024-04-10 12:03:30'),
('3fb31480f9004151b881aa0d8bb118d7d708c229f0747d9705bca2d8fe637492a8ccea711cd44e36', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:46:15', '2023-04-10 12:46:15', '2024-04-10 12:46:15'),
('427ba11899d6b2f3697ef50e06028949115cb0ab65022257c2bab5cba66b458b33bb851765d41050', 1, 1, 'MyApp', '[]', 0, '2023-04-10 13:21:10', '2023-04-10 13:21:10', '2024-04-10 13:21:10'),
('449c08c14ae36fa2f330df2499651225f8bd231256704fe91c2cba7fe8611aa0b86fa55f83f9c00d', 1, 1, 'MyApp', '[]', 0, '2023-04-06 06:16:05', '2023-04-06 06:16:05', '2024-04-06 06:16:05'),
('44bd30564e890c3932f8fed047e98f9a8468ac15eb59d4a911d879a0639f422b9a1a6076314172a4', 1, 1, 'MyApp', '[]', 0, '2023-04-10 21:48:19', '2023-04-10 21:48:19', '2024-04-10 21:48:19'),
('44d81d4a49f6aec536592c0d4c295b12639b0b7e2593166c21f7c54ad5fe39788b416db5c841e607', 1, 1, 'MyApp', '[]', 0, '2023-04-10 13:22:28', '2023-04-10 13:22:28', '2024-04-10 13:22:28'),
('460f960ab5505a36951dc3d1b570b0a6c334116991dec359b911dd4c4201986cfab21871e8c52d89', 1, 1, 'MyApp', '[]', 0, '2023-04-03 10:39:09', '2023-04-03 10:39:09', '2024-04-03 10:39:09'),
('46cdb1a8a7bb51edb2117b8cfc10eb4095e7bfb6dc9aaac4bad502d0a5491f114525149783253d14', 1, 1, 'MyApp', '[]', 0, '2023-03-31 11:29:20', '2023-03-31 11:29:20', '2024-03-31 11:29:20'),
('46ff379a3f4d0a8c4cf974cb15b00f132198b28b71cc3b4edb98a60edcf15dd5a4f5c83805c95459', 1, 1, 'MyApp', '[]', 0, '2023-04-10 08:03:29', '2023-04-10 08:03:29', '2024-04-10 08:03:29'),
('496dd2901d2428b938e1d805c9cefa1e86a23ca05b7dd61c14ff4b51add70fe17941a8d0037c6beb', 1, 1, 'MyApp', '[]', 0, '2023-04-03 08:30:07', '2023-04-03 08:30:07', '2024-04-03 08:30:07'),
('4ab35c0a51a7be878e820ba55e76858d12b42b8ac1f786689c0aefd99361985dc3975feb6762dd84', 1, 1, 'MyApp', '[]', 0, '2023-04-11 09:48:06', '2023-04-11 09:48:06', '2024-04-11 09:48:06'),
('4b6e0dc1e95b6b6415386ab9ac4ef5a31358aace2e0cb5526cbb10b79f546ba5d222d10767199715', 1, 1, 'MyApp', '[]', 0, '2023-04-10 21:04:35', '2023-04-10 21:04:35', '2024-04-10 21:04:35'),
('4bca99ee2fc1dfba3041d22c7e9dde793668e2ec846024cde4279ff66975dd5cca99d5b2b68103d0', 1, 1, 'MyApp', '[]', 0, '2023-04-18 10:44:11', '2023-04-18 10:44:11', '2024-04-18 10:44:11'),
('4c47a61abf693363b89837001cf3893e2a00a3a4be121f8f3688659ab0e6c43f29abb1f186ff0be5', 1, 1, 'MyApp', '[]', 0, '2023-04-03 09:18:58', '2023-04-03 09:18:58', '2024-04-03 09:18:58'),
('4c996b0173cf653dc0b426119e9ab0bb698323ba3112e849ef30f1ed53c30fac897f645a9a48dd35', 1, 1, 'MyApp', '[]', 0, '2023-04-10 11:46:41', '2023-04-10 11:46:41', '2024-04-10 11:46:41'),
('4cdc893f59a4cf3b1e399b0d8841cc3c9cb397c51b08443c3ffc481faa390d875a378f02de1a2270', 1, 1, 'MyApp', '[]', 0, '2023-04-03 10:07:43', '2023-04-03 10:07:43', '2024-04-03 10:07:43'),
('4d4f9a9bf7e825f2aa03aeb4dacace52634fcea8bd0215fe2824cf8b72680aa448ebb2376f09f718', 1, 1, 'MyApp', '[]', 0, '2023-04-04 10:51:29', '2023-04-04 10:51:29', '2024-04-04 10:51:29'),
('4f8f7e424e24d8b99bdc4a3449d4c58e1c15bb22d7fd5c06dd4c289951f3c91516634ac096c8d380', 1, 1, 'MyApp', '[]', 0, '2023-04-06 06:13:43', '2023-04-06 06:13:43', '2024-04-06 06:13:43'),
('5043551b4136003be52853fc4f56d88ae142a81cde596d492adfb80d052642bd77a5ada07e8d86fa', 1, 1, 'MyApp', '[]', 0, '2023-04-10 23:56:26', '2023-04-10 23:56:26', '2024-04-10 23:56:26'),
('52684d125d59dc9df73ed290d767bb3083d79d823e67981c6d95fb32e55c314edbe7adfdd90c5a59', 1, 1, 'MyApp', '[]', 0, '2023-04-10 23:15:30', '2023-04-10 23:15:30', '2024-04-10 23:15:30'),
('528ef1fdd466f885b4d88c97bd25301c7af67e9e88717dac0e779482aadfdaf9fb9c4c34ee1c9293', 1, 1, 'MyApp', '[]', 0, '2023-04-01 13:11:12', '2023-04-01 13:11:12', '2024-04-01 13:11:12'),
('534099f4623f3ba82b63a8a0496e633ffb5ceeb9c280bebb94574cd4b5665f52d29e83809b92ed9e', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:46:43', '2023-04-03 06:46:43', '2024-04-03 06:46:43'),
('5376f0505d10f19f61ea6bb48193daad0804d26525ffc0b282ea2e386219202192f52ad6a9679503', 1, 1, 'MyApp', '[]', 0, '2023-04-06 09:50:14', '2023-04-06 09:50:14', '2024-04-06 09:50:14'),
('5522becf76691d43818699a7c49f6821f104906851f95b317477d4afa4e3786406f72fffa30ac7b7', 1, 1, 'MyApp', '[]', 0, '2023-04-11 10:45:29', '2023-04-11 10:45:29', '2024-04-11 10:45:29'),
('5527fecfccdb5309186685bbe979c39a69dbad0ced3c2a15ff69de7b63135aa15722cd27c38996f8', 1, 1, 'MyApp', '[]', 0, '2023-04-10 09:33:26', '2023-04-10 09:33:26', '2024-04-10 09:33:26'),
('55b529466156db39828d76ecdf168637b4f8fbc769e407ce84dccebe83d2adcf9004ca4153d0cfb1', 1, 1, 'MyApp', '[]', 0, '2023-04-06 06:22:01', '2023-04-06 06:22:01', '2024-04-06 06:22:01'),
('577b9f7eae19e05f0bfbca7bebdef053795c7fd8745070939330cdb2185f59c2bbfe24d32921993e', 1, 1, 'MyApp', '[]', 0, '2023-04-04 10:38:43', '2023-04-04 10:38:43', '2024-04-04 10:38:43'),
('587b5b1af15101c8bcb08d8618c57b6cd20dab26008deacea67a07def4f04b0d1d2e2d75be9749dd', 1, 1, 'MyApp', '[]', 0, '2023-04-01 13:03:15', '2023-04-01 13:03:15', '2024-04-01 13:03:15'),
('591b5dec45b6f32ce05ce4f82d2443458d42ec6aa267a2204d1c67d08096881d945af434db823a64', 1, 1, 'MyApp', '[]', 0, '2023-04-09 12:44:33', '2023-04-09 12:44:33', '2024-04-09 12:44:33'),
('59459ac6807d23b85d921e1d6f59d5655845db51d79e882f27d2051a77aff5a9fd760f19e43f4d7c', 1, 1, 'MyApp', '[]', 0, '2023-04-13 08:29:29', '2023-04-13 08:29:29', '2024-04-13 08:29:29'),
('59ccbec8a65d206f367b6f85809a823c00f050622ef055cecad1e01b68c8e3c7e81f97c842e13fa7', 1, 1, 'MyApp', '[]', 0, '2023-04-03 09:52:53', '2023-04-03 09:52:53', '2024-04-03 09:52:53'),
('59dd8ce87f58269ea2259833709e53cec73a0cf2d11c9ddbf164a15ae5b86bb54ff442e79487cf5b', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:18:21', '2023-04-03 06:18:21', '2024-04-03 06:18:21'),
('5a9e13050b021bd22413f790fc91558fa50869022c00cb2c0760e701b435708bc96ab0abf2ef49aa', 1, 1, 'MyApp', '[]', 0, '2023-04-10 13:22:58', '2023-04-10 13:22:58', '2024-04-10 13:22:58'),
('5abb5a1879c7c0b6bab1d81b9f61589e0801be8a98626a42d1a3217f73cf91c8763ee3cae126f832', 1, 1, 'MyApp', '[]', 0, '2023-04-10 23:59:29', '2023-04-10 23:59:29', '2024-04-10 23:59:29'),
('5c841cfce405b30aa9b97d0144945b2dfa87346bb541892a486f4aebf1130539078337bb4529ff42', 1, 1, 'MyApp', '[]', 0, '2023-04-03 05:59:28', '2023-04-03 05:59:28', '2024-04-03 05:59:28'),
('5d345e502059a2650f62ca92f824179457ef59eb48ea5e7ccf92da6900764618ef6beae9f557d993', 1, 1, 'MyApp', '[]', 0, '2023-04-03 08:37:44', '2023-04-03 08:37:44', '2024-04-03 08:37:44'),
('5d4cc1d894ba89a91fe2fed2398abddc08d828f83b28816415f79401a6660a5141d1915fd55e29cf', 1, 1, 'MyApp', '[]', 0, '2023-04-04 08:05:04', '2023-04-04 08:05:04', '2024-04-04 08:05:04'),
('5de6808270227665dc516c0d69497e61bb0d63f45517b089761cadefd0748cd9d8b1dacf97d6b524', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:19:49', '2023-04-10 12:19:49', '2024-04-10 12:19:49'),
('5f8dcafec40955b2d488d0b33f3dceff91851917fee5e20d68dafe6f600af3a73dc924e7e6dd3bc8', 1, 1, 'MyApp', '[]', 0, '2023-04-13 08:22:19', '2023-04-13 08:22:19', '2024-04-13 08:22:19'),
('61c1128a72e3e86a8a3a25354176aeba900e6ba10bcbd74767321c118b238cabe57deeda2c1f013c', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:41:08', '2023-04-03 06:41:08', '2024-04-03 06:41:08'),
('62ea0926eced8f0899ac75193151ea8e573d9205ff216bdcd36758d183c25b67b5046334752e4730', 1, 1, 'MyApp', '[]', 0, '2023-04-10 19:44:12', '2023-04-10 19:44:12', '2024-04-10 19:44:12'),
('6343ed12788e10ef891066668a28ef92b942ede0d278067dd6795ec00b8273cdd77d0ecebc3c060d', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:17:26', '2023-04-10 22:17:26', '2024-04-10 22:17:26'),
('63898b4666742445b03cc3ec871eb066a526ab44c7689aa730c0c9ff7313e7324791838236bfdbf1', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:53:15', '2023-04-03 06:53:15', '2024-04-03 06:53:15'),
('64e1659e1cd1a12b02844affbb440fdcbdfdaee32f66907713e4ed0f6a6c3727345a25fdb5dba5bb', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:10:56', '2023-04-03 06:10:56', '2024-04-03 06:10:56'),
('65182afb8044be1821be7b8c8a780e0027ebc1cd89449f10ab10bb5b829ec708da676e3d3de9301e', 1, 1, 'MyApp', '[]', 0, '2023-04-03 07:04:27', '2023-04-03 07:04:27', '2024-04-03 07:04:27'),
('671b806a970c4f7539ba04999eff06bf2710dc2f05e7a860aa677a96ff98cb99d0c9c4855fca96b9', 1, 1, 'MyApp', '[]', 0, '2023-04-03 09:09:48', '2023-04-03 09:09:48', '2024-04-03 09:09:48'),
('67efabe31a64bd1d879d82fd93def13b244dbc08da4dd0daefe648c23292b8032395b7776832644c', 1, 1, 'MyApp', '[]', 0, '2023-04-03 09:03:30', '2023-04-03 09:03:30', '2024-04-03 09:03:30'),
('6840d862abee52a4b82b5dee124b1df5055df117d3ae86bb76d0122e66e88713e4066c09aa7bd801', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:55:05', '2023-04-03 06:55:05', '2024-04-03 06:55:05'),
('6900643905767c46bb1d149fd93623a3f4a1346e5d22e43cc6c5ee1555290d1c4514aeb645019b93', 1, 1, 'MyApp', '[]', 0, '2023-04-10 23:31:03', '2023-04-10 23:31:03', '2024-04-10 23:31:03'),
('691029de0b29df9bfae4c700fe3d4c7e691f268520d655bbad0476bce54c4eb4b0aca8da13044914', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:20:38', '2023-04-10 12:20:38', '2024-04-10 12:20:38'),
('6b82861c49d7f558cf017323900ae8ed58cf92dd1dd95a9623b384c1f7e6802157cf1665f2dc5137', 1, 1, 'MyApp', '[]', 0, '2023-04-10 13:24:19', '2023-04-10 13:24:19', '2024-04-10 13:24:19'),
('6c87a7282a2a4a2b35f17af2eac537f5f5e5b7aaad3733e11cc03600c829195a9b579c1769b43233', 1, 1, 'MyApp', '[]', 0, '2023-04-03 08:18:28', '2023-04-03 08:18:28', '2024-04-03 08:18:28'),
('6d0a9745f957b652a3d4d7f03408c9dbdbba1746156f93772216db317b08f350776d9723d60e7fea', 1, 1, 'MyApp', '[]', 0, '2023-04-15 19:50:16', '2023-04-15 19:50:16', '2024-04-15 19:50:16'),
('6d0ef4fd7d7a1cf6e172729d9929ab9a132852d92a3363bdb4b20406223ae4e410c06bb3e8d2c7a0', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:08:02', '2023-04-10 22:08:02', '2024-04-10 22:08:02'),
('6da95fd4a084c8c6e011390571de9a0434dc9f637a6a8b539d464361f2886cd7094baa48a8246234', 1, 1, 'MyApp', '[]', 0, '2023-04-05 09:58:17', '2023-04-05 09:58:17', '2024-04-05 09:58:17'),
('6e762481b221308753f5eae67318eb5dbc8b92f8e01064ada0a58ab9e7339839d806611011905772', 1, 1, 'MyApp', '[]', 0, '2023-04-07 10:53:20', '2023-04-07 10:53:20', '2024-04-07 10:53:20'),
('6ecbbc95b9ecdad152e1751bae31631dcf267aca2c0340a389bda87496a3a4fc1bbff2d4e5e7a9a7', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:44:10', '2023-04-03 06:44:10', '2024-04-03 06:44:10'),
('6fcd1792196cdf4a3da2634bb2618c29a56d16d534e82a09ff228013692898981c352743c490d253', 1, 1, 'MyApp', '[]', 0, '2023-04-09 09:52:30', '2023-04-09 09:52:30', '2024-04-09 09:52:30'),
('71ffcdbb05184185fdd9906dfde888952f6dcdce5fd744f9a068d7e8d790bd79e2080e10ee4b589a', 1, 1, 'MyApp', '[]', 0, '2023-04-07 08:17:49', '2023-04-07 08:17:49', '2024-04-07 08:17:49'),
('75c2bdb4a58e878772c958d111937d48ac0379259e00f44a708d34566e57e520032cb01650d806ae', 1, 1, 'MyApp', '[]', 0, '2023-04-01 13:13:30', '2023-04-01 13:13:30', '2024-04-01 13:13:30'),
('77f663716401f3041a744dce249183934d3601a39eb0b3608954dc5d7af67835d3e70db958e9034e', 1, 1, 'MyApp', '[]', 0, '2023-04-10 13:23:29', '2023-04-10 13:23:29', '2024-04-10 13:23:29'),
('789a74c4b7c8a3077db10e2248106409f16f01d15bd05af9668dfd781b56af716b2088bff8e1ea0d', 1, 1, 'MyApp', '[]', 0, '2023-04-12 07:08:16', '2023-04-12 07:08:16', '2024-04-12 07:08:16'),
('7967132384998130b620604ae907adfb7cec8bfd6aa0611410fc689b322e1452de18bbd255acfb6b', 1, 1, 'MyApp', '[]', 0, '2023-04-11 00:05:17', '2023-04-11 00:05:17', '2024-04-11 00:05:17'),
('798637bbfc07570ee98ccf3511db0b5366308dab8ed6ce88873d9dd96f57a52eba0a835194c6d3d1', 1, 1, 'MyApp', '[]', 0, '2023-04-04 10:59:21', '2023-04-04 10:59:21', '2024-04-04 10:59:21'),
('7a55d433e2d2193e903b5cbf62aa46fea0eda8fb396d57f3609d2df5642dd27ba1d58bdf626b6886', 1, 1, 'MyApp', '[]', 0, '2023-04-11 00:13:05', '2023-04-11 00:13:05', '2024-04-11 00:13:05'),
('7b647880cdf21f1a720ce238c3231fe38552cb3d34c33d2743c51d5e95c72c336cc320acfb910844', 1, 1, 'MyApp', '[]', 0, '2023-04-10 13:09:47', '2023-04-10 13:09:47', '2024-04-10 13:09:47'),
('7bd77808752ebdea802232a37a3e616e8514d884901fb23a9cf9e503a93ff4b9ced3f135cc3a735f', 1, 1, 'MyApp', '[]', 0, '2023-04-03 09:20:20', '2023-04-03 09:20:20', '2024-04-03 09:20:20'),
('7c922410e66007e27eb54cb97f0cf96cba11d51e764312fb0b7caea7ee7cb0fa1fe39021f4c4cd83', 1, 1, 'MyApp', '[]', 0, '2023-04-03 09:27:11', '2023-04-03 09:27:11', '2024-04-03 09:27:11'),
('7cf92d64f485f1513ba0bf9a1ffd3acba056fc4de16e1b60464eaccbf2ff70f9c777b2ddf3935129', 1, 1, 'MyApp', '[]', 0, '2023-03-31 11:30:24', '2023-03-31 11:30:24', '2024-03-31 11:30:24'),
('8163167e7b47395bbda552a0670ad8b56c04065c21646fa17ff235501c21df2b3ed378f9721dd104', 1, 1, 'MyApp', '[]', 0, '2023-04-06 06:25:17', '2023-04-06 06:25:17', '2024-04-06 06:25:17'),
('816e602cc251ca72e606db561aba194f9f39309abf602095ac34f161f15372ec7fc42051fadc4246', 1, 1, 'MyApp', '[]', 0, '2023-04-10 07:46:21', '2023-04-10 07:46:21', '2024-04-10 07:46:21'),
('8223bf8ebc70cea42a569301f83012e836c333a5a7b47cc9df67e6e35c6341796440d85d54c90878', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:21:08', '2023-04-10 22:21:08', '2024-04-10 22:21:08'),
('822b97bee0850559740721bbacf64634ac6676d9e53480d1bf33f7b76708e1c7cd6271197d20396c', 1, 1, 'MyApp', '[]', 0, '2023-04-06 08:28:46', '2023-04-06 08:28:46', '2024-04-06 08:28:46'),
('822fc0bd0b4a02d83c4ce6dfa2451badea059a65cef0e76c1120c2b90c70a627f974a92c65a8b493', 1, 1, 'MyApp', '[]', 0, '2023-04-03 10:40:39', '2023-04-03 10:40:39', '2024-04-03 10:40:39'),
('8292d8b0f66eed915ea4096e8682ced2c2f2e15d8f1d83a67085e717c1e883a81c394304aaf96ac5', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:43:17', '2023-04-03 06:43:17', '2024-04-03 06:43:17'),
('8438b383707fcc02fc19bb254d084c5513da86af6027ff7551b2ad69129e70dc306b146fa7bda42d', 1, 1, 'MyApp', '[]', 0, '2023-03-31 11:58:55', '2023-03-31 11:58:55', '2024-03-31 11:58:55'),
('85a4d936e944bfd388b3ec8713918db7602fea372140c5897504cd4e6955c84041f468cb53409576', 1, 1, 'MyApp', '[]', 0, '2023-04-07 08:21:57', '2023-04-07 08:21:58', '2024-04-07 08:21:57'),
('85d8f261f8257dabed004256089024974b135960ab0db15c382d18213ef0d9da965d24dae8faa57b', 1, 1, 'MyApp', '[]', 0, '2023-04-01 12:59:40', '2023-04-01 12:59:40', '2024-04-01 12:59:40'),
('870856ee5a189942211137606e1b238cce7c512309a83418eb5d7ef9469a2afc06046599f614b668', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:14:54', '2023-04-10 22:14:54', '2024-04-10 22:14:54'),
('884b63ece51ed0d3cad9bb788a91045b7be6be69c66e133f8f6707981da936e2298da020926e0fd2', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:13:25', '2023-04-03 06:13:25', '2024-04-03 06:13:25'),
('8907860c1f68ac6c3f3090904a30794115cd2d3671dbc818fae22fc4cc4864972f9342079c1955c7', 1, 1, 'MyApp', '[]', 0, '2023-04-11 00:08:46', '2023-04-11 00:08:46', '2024-04-11 00:08:46'),
('89204fa4243441c0b630f630637bf728bfa833682948f1b48e3ab6eb5fe71890aed5338f5091d47a', 1, 1, 'MyApp', '[]', 0, '2023-03-31 09:58:19', '2023-03-31 09:58:19', '2024-03-31 09:58:19'),
('8d4813c95876d10d7c3c042b3f3c33c349b5c459a7fe6392f6c91eddee632e11342d39721a37529d', 1, 1, 'MyApp', '[]', 0, '2023-04-03 10:51:06', '2023-04-03 10:51:06', '2024-04-03 10:51:06'),
('8d4d199b58b80d0b699783ec0a959eb2cea0e097e19d18a7cb1aec6a5b57bd772077f4d9dc1b748b', 1, 1, 'MyApp', '[]', 0, '2023-04-03 08:33:56', '2023-04-03 08:33:56', '2024-04-03 08:33:56'),
('8dc9de87ea5444d1dab23a7bfc97e87cdb448c25eb70e74f58847343ef853cffa1e02b651e901390', 1, 1, 'MyApp', '[]', 0, '2023-04-04 08:22:42', '2023-04-04 08:22:42', '2024-04-04 08:22:42'),
('8dfb745e14162e2fa83f8b45b6a302f700898929af7fb93ffce82fd523e1f5279fa47a664a9e3616', 1, 1, 'MyApp', '[]', 0, '2023-04-04 07:08:58', '2023-04-04 07:08:58', '2024-04-04 07:08:58'),
('8e966121bae46d86978b479617befe04d7035c3adaea3b18c984c102df4649cfe2b43e1610aaaeba', 1, 1, 'MyApp', '[]', 0, '2023-04-06 09:14:09', '2023-04-06 09:14:09', '2024-04-06 09:14:09'),
('8fb6e5aebf3e59868b1b5c52e361ada8f4f51b2798b233b13531f2e7e6426d7cffb9085ba396e4c9', 1, 1, 'MyApp', '[]', 0, '2023-04-07 08:21:49', '2023-04-07 08:21:49', '2024-04-07 08:21:49'),
('9089e44b7f2de366cf046ec38eaffbef45cb2d9c0f945c2efb76c76306ad7ebaa08ef03325383b9a', 1, 1, 'MyApp', '[]', 0, '2023-03-31 10:15:51', '2023-03-31 10:15:51', '2024-03-31 10:15:51'),
('92b14a859c49e64d6949282c8c691063a9cf262b0f4dcca8624ee443d9e329e1387e26a4fb473fb0', 1, 1, 'MyApp', '[]', 0, '2023-04-11 09:58:14', '2023-04-11 09:58:14', '2024-04-11 09:58:14'),
('92ee973978f8bc2584214f43abb8740071084195f8df551b53afb837d3e3eaa01472ebcf6a433ab4', 1, 1, 'MyApp', '[]', 0, '2023-04-07 10:37:25', '2023-04-07 10:37:25', '2024-04-07 10:37:25'),
('939b1dbd44d1172490c6c34f272f03c07ca3bc9e839af31c4a77633a0d83d53a94ac9167cc3ea738', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:52:34', '2023-04-03 06:52:34', '2024-04-03 06:52:34'),
('93c42697a03dc153dbf6ec5e5751f7e1c407b1460f7338f2252be0a9fde12e7c4d96ca7f0734afa1', 1, 1, 'MyApp', '[]', 0, '2023-04-04 10:45:46', '2023-04-04 10:45:46', '2024-04-04 10:45:46'),
('94380beb83870447e9a1d301afc599788e1347eeaa6dd8ad0de65035624a85db9dad4f5c3866e588', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:56:59', '2023-04-10 22:56:59', '2024-04-10 22:56:59'),
('950f2635d991ed4f6cb57c10c8d93696d69396d30f71a19bcc9a645af7e56aa671104ad7ba593cfd', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:45:56', '2023-04-03 06:45:56', '2024-04-03 06:45:56'),
('95360cbaebefd7063b18c402174af05ab95d77e6d126ad7475ade19bd554cb1cf5c6f05ae033a157', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:49:47', '2023-04-10 22:49:47', '2024-04-10 22:49:47'),
('95374fe4e0964317fd37622aacc96084c8c3bdc6241e7e1b28b3d5416f582dd4b283a0bfcd244d91', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:48:02', '2023-04-10 12:48:02', '2024-04-10 12:48:02'),
('95b9ba5c06a26de41edcea13fc0e442af1811c97f5bdf0b967628f819737befb3c3e4bc9f0b3826a', 1, 1, 'MyApp', '[]', 0, '2023-03-30 04:23:31', '2023-03-30 04:23:31', '2024-03-30 08:23:31'),
('9657aa0cd668731c63a5ec79a98305561f17480faf2ee08722c785ffb24cc0f11fb89da45eb03d15', 1, 1, 'MyApp', '[]', 0, '2023-04-10 23:52:11', '2023-04-10 23:52:11', '2024-04-10 23:52:11'),
('965aa60aea96bf064df49048f32928922bcaf807c7e2b4e1fba316fef693737158cab765b5f513e0', 1, 1, 'MyApp', '[]', 0, '2023-04-07 08:35:34', '2023-04-07 08:35:34', '2024-04-07 08:35:34'),
('96719cb836bf3115687e9ddb090166d1b84f5e02641bc2a6a4919995842977c15769d23702383963', 1, 1, 'MyApp', '[]', 0, '2023-04-10 23:39:23', '2023-04-10 23:39:23', '2024-04-10 23:39:23'),
('984ac6ac9d99ee2f6571167795c446d2f02af5b7eeaacf12acacdcfa72348d40ac46b516d8945f0e', 1, 1, 'MyApp', '[]', 0, '2023-04-03 10:00:36', '2023-04-03 10:00:36', '2024-04-03 10:00:36'),
('9a4dceeaf1a158f429bacf41b06f5d1c9f70bbb9926bd7d269b9750d3e3ee23fef6b84a448c1f1d1', 1, 1, 'MyApp', '[]', 0, '2023-04-10 08:18:03', '2023-04-10 08:18:03', '2024-04-10 08:18:03'),
('9ca33f43c5af52da0020772d01c77531cce16ad397bc0bfe1b928a23b46ec09e463761fa54a29766', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:07:01', '2023-04-10 12:07:01', '2024-04-10 12:07:01'),
('9d23b2f50da44770eaa5dabac845bcea17a807311875fb92260467fce324c6ff10d3f5d72aaf729d', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:31:47', '2023-04-10 22:31:47', '2024-04-10 22:31:47'),
('9dc559986bcbee74f46208fae386484b05cbff4f8c338c8c0c2743b1ace2c41d2f381397eda6e429', 1, 1, 'MyApp', '[]', 0, '2023-04-07 09:08:12', '2023-04-07 09:08:12', '2024-04-07 09:08:12'),
('9e09c32f204942beda76a17dfe78a3afac3e8bdceaf66b5cd7bc5342b3e254121fcc56fbf7c784cd', 1, 1, 'MyApp', '[]', 0, '2023-03-31 11:31:40', '2023-03-31 11:31:40', '2024-03-31 11:31:40'),
('9eb4307471a3c6aa3c29d9d8bb8f9e37cb778ddb938d1abf13cdfa88440143c10aeaf9a139c52e22', 1, 1, 'MyApp', '[]', 0, '2023-04-11 00:08:19', '2023-04-11 00:08:19', '2024-04-11 00:08:19'),
('9f1bed81823a5fae76c6ad24aa86eadc4f7f33df8c859172d08598a8936fcda244908c7b771f1bd1', 1, 1, 'MyApp', '[]', 0, '2023-04-06 09:38:48', '2023-04-06 09:38:48', '2024-04-06 09:38:48'),
('9fafa46e6bb6d78b188b2a5361cf7751a35d405eb042e54aa2a20a4f78734a1811cb102f2629859f', 1, 1, 'MyApp', '[]', 0, '2023-04-03 11:32:07', '2023-04-03 11:32:07', '2024-04-03 11:32:07'),
('9fde0ff8e0f03541e9cb5aecb55f69f1a76a0a28a2c2a423116272c1fbfd3da83d1127247f92298d', 1, 1, 'MyApp', '[]', 0, '2023-03-31 11:40:12', '2023-03-31 11:40:13', '2024-03-31 11:40:12'),
('a082a4e62b83d4ca6f753446dc22fa72e41e8c6f0860a9b844edaa685198bcddd4c2ef5b8c2665bd', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:18:12', '2023-04-10 22:18:12', '2024-04-10 22:18:12'),
('a0f64abbc9a73803113f050092e552b20491fe8cb4152d262a9d46b582d0839c42e9b3657a805f46', 1, 1, 'MyApp', '[]', 0, '2023-04-03 09:39:30', '2023-04-03 09:39:30', '2024-04-03 09:39:30'),
('a12faed720dfc9ee064e9f8b35d584825535bab90734daf6a1ba00297737f7ece6be6d937d9a3f2f', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:00:25', '2023-04-10 22:00:25', '2024-04-10 22:00:25'),
('a3d1b4d9ed21e1e321e3a0aee7e7e979fb9adb707df35cea79f5fc82f41cc59d36f7f75f27d0b2bb', 1, 1, 'MyApp', '[]', 0, '2023-04-10 21:59:43', '2023-04-10 21:59:43', '2024-04-10 21:59:43'),
('a4d36ee5d091bdfa5c71792eb374709baef7135a54d2f45cc22839219c905546132b064552a8b925', 1, 1, 'MyApp', '[]', 0, '2023-04-10 19:44:36', '2023-04-10 19:44:36', '2024-04-10 19:44:36'),
('a563d1ea8b0387e2b3ce36601296781b518cab8c4afc6b3b9965a0fa2e7ea2552a4cdbe93e51c9cf', 1, 1, 'MyApp', '[]', 0, '2023-04-04 07:50:10', '2023-04-04 07:50:10', '2024-04-04 07:50:10'),
('a5e77c6e153881a2b30e415402165c347417d66220695c23fb49acb8679f565684724fe6c5c0391a', 1, 1, 'MyApp', '[]', 0, '2023-04-10 13:10:57', '2023-04-10 13:10:57', '2024-04-10 13:10:57'),
('a74b3b227452f37f2961362c79443f14f79ae88fb0e1da3e0f95accd3f7034807c4ae4a6672efc19', 1, 1, 'MyApp', '[]', 0, '2023-04-11 09:29:17', '2023-04-11 09:29:17', '2024-04-11 09:29:17'),
('a7f17fd6f277b78383fd06c56ab05fc5b2feba3247aaf3252768f59b604a9f8a0dac90b6c8fe9a0c', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:35:56', '2023-04-10 12:35:56', '2024-04-10 12:35:56'),
('a84b3db3e681e7311e3660809c948b92cc4ba5f0610cc9046c6e675b5837f6ea8b8df39043fc2530', 1, 1, 'MyApp', '[]', 0, '2023-04-03 09:29:45', '2023-04-03 09:29:45', '2024-04-03 09:29:45'),
('a9494867504109575d81614dd71f8743a106acc3ac69a715a4b42eaa8aeb5cb747821b4e7e582e57', 1, 1, 'MyApp', '[]', 0, '2023-04-04 11:01:48', '2023-04-04 11:01:48', '2024-04-04 11:01:48'),
('aa5ebd769225e5069c6b172d6b561b7a6f90cd01fe72449582a1882d2768eb0310f5a6657b4db1c8', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:53:51', '2023-04-10 12:53:51', '2024-04-10 12:53:51'),
('ab07d64a4dd4f900b5e87e5ef023f1937d0fbe9fe1b6932725f5840a4f99bdbb1f5d5d64e7725134', 1, 1, 'MyApp', '[]', 0, '2023-04-03 10:41:31', '2023-04-03 10:41:31', '2024-04-03 10:41:31'),
('abb34256dd4bacb733cd29a92f9993b15056afe56d5f1cd79e06968d8c2cbe5528acd0f54f1bfe33', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:30:33', '2023-04-10 22:30:33', '2024-04-10 22:30:33'),
('ac07ac594350a8251126308852321f45535d95e1561bfdb20817eed730be9215e97aeeeb3f384284', 1, 1, 'MyApp', '[]', 0, '2023-03-31 09:54:54', '2023-03-31 09:54:54', '2024-03-31 09:54:54'),
('ac8cff5ad5dffe8c1f9ae45b2c802a695d62a3189339aa212664756418e16bcdebbfe7964c21b647', 1, 1, 'MyApp', '[]', 0, '2023-04-10 13:09:05', '2023-04-10 13:09:05', '2024-04-10 13:09:05'),
('acae3c70baed59f98db7cfa39b51272e6f778e377c469ea8e77fdfffe44f165def1e20bc9f277413', 1, 1, 'MyApp', '[]', 0, '2023-04-04 11:13:46', '2023-04-04 11:13:46', '2024-04-04 11:13:46'),
('ace9804e77cee4dfff545248b45171e0a18ada15ad562cb5094ed0ada9cc3f0e4152151adb356b7c', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:43:31', '2023-04-10 22:43:31', '2024-04-10 22:43:31'),
('ada7581c2e4fd0187d0b2338fd465e7ec4e85ceea92e4a956a55302767f7cb14d615c5e33e739efc', 1, 1, 'MyApp', '[]', 0, '2023-04-10 23:38:58', '2023-04-10 23:38:58', '2024-04-10 23:38:58'),
('ae9d482b3f6695cc3f7737dd86192415deb4e379da21cd62aa40b80f7339a5ae4b6efef1653cb3b9', 1, 1, 'MyApp', '[]', 0, '2023-04-10 08:23:17', '2023-04-10 08:23:17', '2024-04-10 08:23:17'),
('aea78562298c1b80d3f2bb6a3260189b8856a9fad8544144d1a520d9332afd53c9cf1a914db24107', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:35:05', '2023-04-10 22:35:05', '2024-04-10 22:35:05'),
('b07f334530145073dfb5c86874faa4fbedeb87cd6523dc3016ad66767d5dffb206ea3e3c91f6b5da', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:34:13', '2023-04-10 22:34:13', '2024-04-10 22:34:13'),
('b16c635252692f03d1e5591d844f90348abeff8fe90373b2fc0635faa5d16f88ef918b7f133a546a', 1, 1, 'MyApp', '[]', 0, '2023-04-06 06:15:59', '2023-04-06 06:15:59', '2024-04-06 06:15:59'),
('b2dbd817f503be3411e5afefb77c6401fcbfe3d72231c82fe411d26ccb0122b9c91c1419404474f1', 1, 1, 'MyApp', '[]', 0, '2023-04-11 00:02:27', '2023-04-11 00:02:27', '2024-04-11 00:02:27'),
('b3dec04a5aa287372bfb61240f281215afa18e90d5b8846b54f0a54db3136f2b0edb1a59056792b3', 1, 1, 'MyApp', '[]', 0, '2023-04-03 08:30:49', '2023-04-03 08:30:49', '2024-04-03 08:30:49'),
('b46d30c8822094c4be557a088d05d795fad718307dd267362f4df2150bf6af13d8adc5cadfa43eca', 1, 1, 'MyApp', '[]', 0, '2023-03-31 11:34:36', '2023-03-31 11:34:36', '2024-03-31 11:34:36'),
('b72cc13e173e06d87e6b0fd3e89433047fa92a33b1fb44883f47eba36f1d8453e68cfdd4aa711312', 1, 1, 'MyApp', '[]', 0, '2023-04-01 13:33:52', '2023-04-01 13:33:52', '2024-04-01 13:33:52'),
('b75783fdb7f3b5c26940c6c51948195c62ed979e5aa3c0ca8a845986c9a89aa416f1e1a872dd694a', 1, 1, 'MyApp', '[]', 0, '2023-04-06 08:44:27', '2023-04-06 08:44:27', '2024-04-06 08:44:27'),
('b7b34401d32a1fac004921268f41d95e15dbe03fae078e9224db335769425950f717563e43d43ec1', 1, 1, 'MyApp', '[]', 0, '2023-04-10 13:18:00', '2023-04-10 13:18:00', '2024-04-10 13:18:00'),
('b8b04f72f7522ed456bcb3a9995aeafdc337446c6869a0c6d96a4ad67ea62b65d8e769dc794eab9f', 1, 1, 'MyApp', '[]', 0, '2023-04-03 11:09:18', '2023-04-03 11:09:18', '2024-04-03 11:09:18'),
('b987176bcd6cc9285971ab2a2b55a23fb174989f02fad77321d321676d6121d3eaa5db6878c12e28', 1, 1, 'MyApp', '[]', 0, '2023-04-10 21:09:21', '2023-04-10 21:09:21', '2024-04-10 21:09:21'),
('ba50db13aeaccd4572528e5c0f263ae49b921c3273efdd9f63cc0311b8b2ad2b9881b1b0c56b9aa8', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:32:45', '2023-04-10 22:32:45', '2024-04-10 22:32:45'),
('be0ccba0040ef034651bf76da78b2dc1b0ccfaada71c6d61afa76f4c2cde882e724e5834e143a777', 1, 1, 'MyApp', '[]', 0, '2023-04-04 11:34:01', '2023-04-04 11:34:01', '2024-04-04 11:34:01'),
('beaccf2a004de5dd1558b2afdbbf2add7731a16a4fd574c780ca5d89be65279acfa87fe7a629c1e3', 1, 1, 'MyApp', '[]', 0, '2023-04-10 21:59:52', '2023-04-10 21:59:52', '2024-04-10 21:59:52'),
('bf640e163b5e67bb7af6b89b5f67454a68327b9b4fd2dff6f7e90dc2e1851a1bc345ff98f9fe0f3a', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:45:13', '2023-04-10 22:45:13', '2024-04-10 22:45:13'),
('bf98bb50172577fa45906d6eda78cc35a20acf25a0899f4b9db76c5be63cc280a81fac0a8ca9776a', 1, 1, 'MyApp', '[]', 0, '2023-04-05 07:32:17', '2023-04-05 07:32:17', '2024-04-05 07:32:17'),
('bfe6af15e6f241c952ed4e3a76cacf9ed2cf7832eb7f0e8389ad1a222dd81cc7b93b4f72ac66e53e', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:01:57', '2023-04-10 12:01:57', '2024-04-10 12:01:57'),
('c09924ce1cebb2761a105fa3e2e160cf3238f6c8bb28077c12c710a2e8c0b2db7c92da044e141bca', 1, 1, 'MyApp', '[]', 0, '2023-04-03 10:45:02', '2023-04-03 10:45:02', '2024-04-03 10:45:02'),
('c30a2ea8c8ae2359d57b2c9b9150ec9451e2f081fdd78705777059510858ec026207d90accc003db', 1, 1, 'MyApp', '[]', 0, '2023-04-03 10:48:04', '2023-04-03 10:48:04', '2024-04-03 10:48:04'),
('c328d7d4d86360b0d6bbccbfca9f7ad3727a3d4fa3ec22aede193a0d43233f2e3d8d0e26c4680a40', 1, 1, 'MyApp', '[]', 0, '2023-04-09 09:48:34', '2023-04-09 09:48:34', '2024-04-09 09:48:34'),
('c393734e65874692a6a97ae4ac753f51053ba332fd814279292c136c36b6aa2636808e2f788651a4', 1, 1, 'MyApp', '[]', 0, '2023-04-10 19:43:30', '2023-04-10 19:43:30', '2024-04-10 19:43:30'),
('c4e4b47eb50e22cab075f2d1aa5697a86c0ae926bc73e3994de5e3fdc1cfca3284f58303ca06dc43', 1, 1, 'MyApp', '[]', 0, '2023-04-03 09:08:30', '2023-04-03 09:08:30', '2024-04-03 09:08:30'),
('c624c05b802b762113fb26ad4e7ccdb5a3001c21ef775b428374d6ddc52fe515ce1250d56c4330f7', 1, 1, 'MyApp', '[]', 0, '2023-03-31 11:38:31', '2023-03-31 11:38:31', '2024-03-31 11:38:31'),
('c69c84d6566eb9774de0ad5237b73831381369e3173919069eaabbc61c4c34fc9b92d7cbb4b9ecbc', 1, 1, 'MyApp', '[]', 0, '2023-03-31 11:58:30', '2023-03-31 11:58:30', '2024-03-31 11:58:30'),
('c752cc56283a188687202de17586578236f73289ef2b25940f6dd411b8c2477358b035023501efb3', 1, 1, 'MyApp', '[]', 0, '2023-04-10 13:22:10', '2023-04-10 13:22:10', '2024-04-10 13:22:10'),
('c783f63ed3165a2a7fc5498b30d4bd2f310b48bdda038088f8a6567aa8c7a30402d246b84e8ab271', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:50:06', '2023-04-03 06:50:06', '2024-04-03 06:50:06'),
('c863795ee5edd9b01b1ecdd74504e497cc5941a1bfd17b6a533edd6dcc334fc46876952edfd36746', 1, 1, 'MyApp', '[]', 0, '2023-04-07 08:30:31', '2023-04-07 08:30:31', '2024-04-07 08:30:31'),
('c8a38fef5f014eb2c8d04f4605b66fbf028ad6a47831dac887d32cf2ba2dcbe42d5afc9a420c7910', 1, 1, 'MyApp', '[]', 0, '2023-04-04 09:16:26', '2023-04-04 09:16:26', '2024-04-04 09:16:26'),
('c9a66fe63d4177770333ae80ce5c281d81cefef8dbb34536fd214a10af6deffc8e6cbf3f06607f42', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:49:12', '2023-04-03 06:49:12', '2024-04-03 06:49:12'),
('ca031d21780aaa51056ce1c83081a05179bdcd3d68a3d46b0d9964e76358066c43c18e7db7af72e1', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:23:12', '2023-04-10 22:23:12', '2024-04-10 22:23:12'),
('cb23b49de67a5539c2b37cd6ad4dba863ee31a0098549790219c9206db15b6f5c096ca16844f25ec', 1, 1, 'MyApp', '[]', 0, '2023-04-04 08:31:48', '2023-04-04 08:31:48', '2024-04-04 08:31:48'),
('cb802c623a1b4c0572f1468ab35baf0f8e99d91b07ac1d4aceb1a019b86b9457def45705c58067c2', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:34:43', '2023-04-10 22:34:43', '2024-04-10 22:34:43'),
('cb8f96f14919de346b369e3a2ec0b5e64ba3110f9267bab6117b053fb9bc1a9fcefabd98212c3486', 1, 1, 'MyApp', '[]', 0, '2023-04-03 10:39:44', '2023-04-03 10:39:44', '2024-04-03 10:39:44'),
('cd1c764ed1b0a948969cef4b495d7299aa666d7fa4fe14c1cd1a7f5071c84af80acf0c28ce05fe76', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:27:10', '2023-04-10 12:27:10', '2024-04-10 12:27:10'),
('cd2a5f48b2f53bf43f269596e1efe9afdecac420c930ea756e06ef37572f1ec747aa78d56636148e', 1, 1, 'MyApp', '[]', 0, '2023-03-30 05:03:23', '2023-03-30 05:03:23', '2024-03-30 09:03:23'),
('cdf591effca9d2ece74b863e093fffe893be9eae1447765198829a69804bf2c112e779703b1c8b77', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:41:58', '2023-04-10 12:41:58', '2024-04-10 12:41:58'),
('ce3142c1410b0a118ca7b65324a22275332310ff1267ae4818339eb5042886f6f4188f194949882b', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:32:32', '2023-04-10 12:32:32', '2024-04-10 12:32:32'),
('cee32bd29266cd828139316d9f57567e1109454085ae9ad94db78466cdc1e341b7794cec36146e65', 1, 1, 'MyApp', '[]', 0, '2023-03-30 04:44:47', '2023-03-30 04:44:47', '2024-03-30 08:44:47'),
('cf60fc73a0ba47864bf48343304f8b7d8d869c4896f5f7feb29f3397c2f8c8561e3c0b048f71ec82', 1, 1, 'MyApp', '[]', 0, '2023-04-10 23:36:22', '2023-04-10 23:36:22', '2024-04-10 23:36:22'),
('cfdf991c21237fc541cf51983cd78798a6d27c90e4b9e747311a2293d4d0ac6671fb52da0756b2d5', 1, 1, 'MyApp', '[]', 0, '2023-04-04 10:55:50', '2023-04-04 10:55:50', '2024-04-04 10:55:50'),
('d034b9813d350fe3f70ed9122f651f8fd135485e07dc3c7c9774743e665f83485198a931316338f2', 1, 1, 'MyApp', '[]', 0, '2023-04-10 23:05:18', '2023-04-10 23:05:18', '2024-04-10 23:05:18'),
('d0f4e40b8b2b3675d1027e18c9569ad6f668e96cd94fb5ea95ad4af8627a45ec9b2542dfaccc6a06', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:29:15', '2023-04-10 22:29:15', '2024-04-10 22:29:15'),
('d15326d01315cfab7d98b4f614a1ee8cf5ee5e2306d7ff2476c5300cd3ae0d06894ee105359ebc51', 1, 1, 'MyApp', '[]', 0, '2023-04-03 11:08:53', '2023-04-03 11:08:53', '2024-04-03 11:08:53'),
('d16e046973343d7454ac3163b0889799e4c59b7117f6462e3364787709802fac9f6a64f51fc0fa4b', 1, 1, 'MyApp', '[]', 0, '2023-04-10 19:44:50', '2023-04-10 19:44:50', '2024-04-10 19:44:50'),
('d18cdff5b3927fa2c3f666e3bc6046820179382b5a1cae15afe4642d841ef59d89a2b8a7d97d0249', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:03:06', '2023-04-03 06:03:06', '2024-04-03 06:03:06'),
('d1a64d1e828b1e823920e44e3cdc65a7cff53722062edb331f96e4eeb0b4a9f46c96cabf97bf26e9', 1, 1, 'MyApp', '[]', 0, '2023-04-11 00:12:31', '2023-04-11 00:12:31', '2024-04-11 00:12:31'),
('d2177f1f45a9b9eedb0fdfdd04533acbbd3b92c27c8229c63a9bae6b7898c9a68425031fa96fb2e5', 1, 1, 'MyApp', '[]', 0, '2023-04-11 00:19:07', '2023-04-11 00:19:07', '2024-04-11 00:19:07'),
('d25bd9f6ee70cc7be3d6910f8cfb19ddc4f31248fcfac2a091e3252df6fbd3d092995261d0549fee', 1, 1, 'MyApp', '[]', 0, '2023-04-10 13:10:35', '2023-04-10 13:10:35', '2024-04-10 13:10:35'),
('d28962491f96e909dc33c7aaa3c75c568d1005517655dc504a7d8edebab0bb76712e8e4b455f6a7e', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:18:43', '2023-04-10 22:18:43', '2024-04-10 22:18:43'),
('d3a430e058c279df0466314e120b2401db0227ce7e277fd4db781b377fe332649e90847331fdadce', 1, 1, 'MyApp', '[]', 0, '2023-03-31 10:41:33', '2023-03-31 10:41:33', '2024-03-31 10:41:33'),
('d421eb7d0a962d78421ee9552a2e3597b9dc7beb1b32ccc8de3e67320478b5710a5210ac8bfcadb5', 1, 1, 'MyApp', '[]', 0, '2023-03-31 03:30:08', '2023-03-31 03:30:08', '2024-03-31 07:30:08'),
('d4837d2fd0a835ee901a7e6796711a55d710a35d5ab51023de621890fb5089a47191d67b74730186', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:19:30', '2023-04-10 12:19:30', '2024-04-10 12:19:30'),
('d5c3bea73d4157785541be758b5979917d602c8f5babed24bdbefdebe3379c30ebee7487078e9c58', 1, 1, 'MyApp', '[]', 0, '2023-04-01 13:04:35', '2023-04-01 13:04:35', '2024-04-01 13:04:35'),
('d5ca5439159e088c790e65085f8e1e99892ca65475d73028df703bbd827c2b6cb531138fa4096397', 1, 1, 'MyApp', '[]', 0, '2023-04-10 06:48:26', '2023-04-10 06:48:26', '2024-04-10 06:48:26'),
('d5e14cb5d1652fac3ca34db5547b48cee8a323aa134fe74c22b68e2cd3188b8274dee11ea3a5579a', 1, 1, 'MyApp', '[]', 0, '2023-04-10 23:48:53', '2023-04-10 23:48:53', '2024-04-10 23:48:53'),
('d61095a96dd93cda0e818d234e89822a2de2d34abc65dffcfc4a81b2306c425a052ef3b70323f81b', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:19:57', '2023-04-10 22:19:57', '2024-04-10 22:19:57'),
('d66e1adfd0606b2ecfb71c39d399a5bb460d523daca81d5ea0dfb16e0fbd46fc9f3ee978367a2ef7', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:44:36', '2023-04-10 22:44:36', '2024-04-10 22:44:36'),
('d6ca063a07a3876e182ef87e5b24478e8f1040704e298b1b5ccab5abd30957148cd1fdf4b8012c42', 1, 1, 'MyApp', '[]', 0, '2023-04-11 09:33:01', '2023-04-11 09:33:01', '2024-04-11 09:33:01'),
('d8068e89cf3a43418684ff91885175307c1ba8a4329836339feeb33190b2f25d7a9130f2d4e32e89', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:52:46', '2023-04-10 22:52:46', '2024-04-10 22:52:46'),
('dc20bca02e811f9bebfc4e8540bcbf10dfb098c63da64acd2c75950f83d8f9535e65ed3c93234171', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:21:58', '2023-04-10 12:21:58', '2024-04-10 12:21:58'),
('dcfc5bb16ed9a693e1f1cc79c48a64ffcba2633896b5433982946ddbdbe456981576c21e45abbe3b', 1, 1, 'MyApp', '[]', 0, '2023-04-11 09:41:52', '2023-04-11 09:41:52', '2024-04-11 09:41:52'),
('dd044598d34d9ddb716c75010b039501b408e471ecdfcbf8d6a69e0fcce644e62313e686b33b6cd5', 1, 1, 'MyApp', '[]', 0, '2023-04-11 00:10:37', '2023-04-11 00:10:37', '2024-04-11 00:10:37'),
('dd3d36586d2b5049e97cae7014d23dfca2803e54d8b7223e802671e9ab93240274930f183703a2f8', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:59:00', '2023-04-10 22:59:00', '2024-04-10 22:59:00'),
('dd7f6540f2040eeef001ba585bca510b626cb7974b94b819cb1acbcbdd7956bbe83e117ac861bdee', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:55:36', '2023-04-03 06:55:37', '2024-04-03 06:55:36'),
('dea74282bfa674ce220f40603ae6739fddfdf1d6c801c5b5eb342b1b9bd0577aed6c6cba5bcc0e23', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:53:48', '2023-04-10 22:53:48', '2024-04-10 22:53:48'),
('deeee8a9e55e88c9bd354531f7add8225d857a1b8551ab8e47f157786a81a3b91780519bb2f9f2ca', 1, 1, 'MyApp', '[]', 0, '2023-04-18 10:48:13', '2023-04-18 10:48:13', '2024-04-18 10:48:13'),
('df0ec6ccd7b4617f645c14f6d12b7a52fea495524faa3d28b0fd9daffeecc090752e67106b7476ea', 1, 1, 'MyApp', '[]', 0, '2023-04-06 10:17:06', '2023-04-06 10:17:06', '2024-04-06 10:17:06'),
('dfac5389d6a2183c3c9a3cef08462c1705753e60f2dfe8731f29ea4b4d77f0d408b95207cc137228', 1, 1, 'MyApp', '[]', 0, '2023-04-04 07:43:06', '2023-04-04 07:43:06', '2024-04-04 07:43:06'),
('dfae81209f9568a6a6ddec7bd22914c976ba621fce1ebe3a2ec02d2c13c8f5cae44cc0a4e83babf3', 1, 1, 'MyApp', '[]', 0, '2023-04-10 07:39:10', '2023-04-10 07:39:10', '2024-04-10 07:39:10'),
('dff7392fa0c0a892a59030309e15567131011910bb3363285dd36635d2357bf54a0ac7c5bff1cf4f', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:48:14', '2023-04-03 06:48:14', '2024-04-03 06:48:14'),
('e00d62a8a96d34521affcee9c813c084ec481302c290ca2d83b2d91f3d6b8b29bf024f8aecbff779', 1, 1, 'MyApp', '[]', 0, '2023-04-03 09:10:19', '2023-04-03 09:10:19', '2024-04-03 09:10:19'),
('e057c27c99601c67e55674b4d412fae9a427531e75f964670548388bb28c04f4acf4d3a334dcc7c2', 1, 1, 'MyApp', '[]', 0, '2023-04-03 08:00:04', '2023-04-03 08:00:04', '2024-04-03 08:00:04'),
('e349c0424a0522b5bedc7b3336f3d39a886459ab659cb1f227af09a162f157c9d0e97df3111fc1be', 1, 1, 'MyApp', '[]', 0, '2023-03-31 11:57:55', '2023-03-31 11:57:55', '2024-03-31 11:57:55'),
('e37739192ca918174f91cbda6d56945313fdfb2f339b2f40d2c968fcf86b533647e365d855a38c78', 1, 1, 'MyApp', '[]', 0, '2023-04-04 08:11:27', '2023-04-04 08:11:27', '2024-04-04 08:11:27'),
('e391cc7d8d33c402c8f2da9169bf2d2dc9bd58bc9bfbb6f0e8a3012502792ef43065cb0966901855', 1, 1, 'MyApp', '[]', 0, '2023-04-13 08:31:36', '2023-04-13 08:31:36', '2024-04-13 08:31:36'),
('e3e9474c6b7af00cbc9cffc421b04a05c6045a94d8012440d55cf3cf610863600876af606d82893c', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:10:35', '2023-04-10 12:10:36', '2024-04-10 12:10:35'),
('e491cd9e87d61881061edd4d6114a41e3271576425248c972b72a0634bc9d88eb4c28c897e9b6315', 1, 1, 'MyApp', '[]', 0, '2023-03-31 09:57:48', '2023-03-31 09:57:48', '2024-03-31 09:57:48');
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('e65060d76b87c99791989a96eb2068c299e1bbf37418e03b82f53cb1f32af447ca65a8fd4995b22f', 1, 1, 'MyApp', '[]', 0, '2023-04-01 13:00:27', '2023-04-01 13:00:27', '2024-04-01 13:00:27'),
('e70d72e7a51a09a034efa91b8df7cad3bf4888f63d6e79c0f34d3f54b55e603bc965efc7b6b40fa8', 1, 1, 'MyApp', '[]', 0, '2023-04-03 09:08:59', '2023-04-03 09:08:59', '2024-04-03 09:08:59'),
('e74d7ec3592cb1fec93ec7488f006063d36e234e70b140fa21ba921464731362a4c634c0fe2be360', 1, 1, 'MyApp', '[]', 0, '2023-04-01 13:39:39', '2023-04-01 13:39:39', '2024-04-01 13:39:39'),
('e7557b8e39273019bc9c84179a9fc2fed795b3274622ad9f30ce95fa3ca09d4184a0420a2337ff62', 1, 1, 'MyApp', '[]', 0, '2023-04-09 12:45:09', '2023-04-09 12:45:09', '2024-04-09 12:45:09'),
('e9135f1e219785825113c2c8021f77d553a084ca28a0ff68a3d750e4ce7023deabb1cd41e9e74152', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:54:39', '2023-04-10 12:54:39', '2024-04-10 12:54:39'),
('ea5dfa29e22ed4ae54d86b74ae5f263cfa65f48b90c85c578267c22940dfdf6f6b3f11590d2e7614', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:46:38', '2023-04-10 22:46:38', '2024-04-10 22:46:38'),
('eb710e835919418f4ceca44603d63ddb283f0ef6cd7ed5e70100d16eaea783cb1c21f8dd8d75dba6', 1, 1, 'MyApp', '[]', 0, '2023-04-06 06:15:33', '2023-04-06 06:15:33', '2024-04-06 06:15:33'),
('ebb8afa00baba289cf874f6ed81a5ff2113ea39a5782ec47cb1cebffa77089cffdf85b4129361c4f', 1, 1, 'MyApp', '[]', 0, '2023-04-06 10:51:42', '2023-04-06 10:51:42', '2024-04-06 10:51:42'),
('ecdfefa74e36a8b378bc727b380e234b9af434256d845cd205ba311d682753ad8df7cf387dab309b', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:54:01', '2023-04-03 06:54:01', '2024-04-03 06:54:01'),
('ece668e66849a158e7770c305ec9e0a0241b3520de51d056c77c1f2e621c0cb5865d97278ebf509d', 1, 1, 'MyApp', '[]', 0, '2023-04-03 08:07:24', '2023-04-03 08:07:24', '2024-04-03 08:07:24'),
('ee2dac616c1d8cc084ea461966b078154a5ef533a395ceaa562518fdcb7769820a939a8deac30c20', 1, 1, 'MyApp', '[]', 0, '2023-04-04 11:43:19', '2023-04-04 11:43:19', '2024-04-04 11:43:19'),
('ef7110ec594a262e05d6719882c4a5ee2ab106bb35bb5dc540ddd21a86faff1b93a80da36b2ec447', 1, 1, 'MyApp', '[]', 0, '2023-04-11 00:09:44', '2023-04-11 00:09:44', '2024-04-11 00:09:44'),
('f06fc46dedbbd20efa5dc1e294c6590596b747d8ad6e579351ef0aa64f27dd8e0ef603ded4729a5b', 1, 1, 'MyApp', '[]', 0, '2023-04-04 10:57:00', '2023-04-04 10:57:00', '2024-04-04 10:57:00'),
('f0e2b042f9278d1bb6789b363028ac42f0b8eea87c78c5949ce87ec5f9dea9b68437bf02caedc1d2', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:24:39', '2023-04-10 12:24:39', '2024-04-10 12:24:39'),
('f16b3d7dafe2462cf589d240b98ccc639d82193049b1d9e4e2549263f45daeb1bbdd07673de6b7b9', 1, 1, 'MyApp', '[]', 0, '2023-04-04 10:58:11', '2023-04-04 10:58:11', '2024-04-04 10:58:11'),
('f284401c1e9e7217f91e8a2165aacc2c09f314a57e4bc794942537aa83d46036fde6c69b397cf557', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:04:09', '2023-04-03 06:04:09', '2024-04-03 06:04:09'),
('f32d0ed220870e9b2e971ea2085b03d4d67c4c1b5596cb376aa3ee4b979bc5de10b931df4993b7cf', 1, 1, 'MyApp', '[]', 0, '2023-04-03 08:20:34', '2023-04-03 08:20:34', '2024-04-03 08:20:34'),
('f34c9fc4ce9bb284dc6505ad6783ec241da7afc994e7296cf331152895462c067e32f60c28fa71a5', 1, 1, 'MyApp', '[]', 0, '2023-03-31 11:42:37', '2023-03-31 11:42:37', '2024-03-31 11:42:37'),
('f3ed5ab81b7dff1bf976fd75fc387acf35b18b0ddb7a970bce316bb0f15e861956ac5658b4fb719c', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:54:21', '2023-04-10 12:54:21', '2024-04-10 12:54:21'),
('f4a5d1d7132a8cc90282ca98d205572f57e07b62de9bb09c72991fdb096ddc2b0fb42f2ef7d95b6d', 1, 1, 'MyApp', '[]', 0, '2023-04-04 08:04:24', '2023-04-04 08:04:24', '2024-04-04 08:04:24'),
('f4bbffb40bee7365616ae5d84e9ef3a2f638ea52d28b371f154b5e082970148ff5ce4296c1c1543b', 1, 1, 'MyApp', '[]', 0, '2023-03-31 10:07:33', '2023-03-31 10:07:33', '2024-03-31 10:07:33'),
('f6006f22d239493853bca5bb184206cae2d2e323e0c45b6b63a3a901f99c9c172c1e1458e279c5d8', 1, 1, 'MyApp', '[]', 0, '2023-03-31 03:23:45', '2023-03-31 03:23:45', '2024-03-31 07:23:45'),
('f66bee492beba543eda8c0585d1345451799ee195e5d4132ec77ff2438e68d5f467539fb99c5385b', 1, 1, 'MyApp', '[]', 0, '2023-04-04 09:13:55', '2023-04-04 09:13:55', '2024-04-04 09:13:55'),
('f8a28aa45590f5e120af31163ca7411daf5c8cf82db73a43c563cc3204d25bf582b8275dcfdc1dc7', 1, 1, 'MyApp', '[]', 0, '2023-04-03 08:08:28', '2023-04-03 08:08:28', '2024-04-03 08:08:28'),
('f9b5a30e06f607d513129a5c2bf825cc49f2675c0c0304815bc8b13ddbb01af3b0014861e4a1ea85', 1, 1, 'MyApp', '[]', 0, '2023-04-10 22:23:48', '2023-04-10 22:23:48', '2024-04-10 22:23:48'),
('f9c5aea1dee11e4328f988d3ed9d985ab091bb1fe166140c2e340f4348f89a36716b773c5c9582be', 1, 1, 'MyApp', '[]', 0, '2023-04-10 23:41:57', '2023-04-10 23:41:57', '2024-04-10 23:41:57'),
('f9e3128f900dc17c80ae273038339c341de4779e3cca9888f2901f1bf62692369eb85d6d37a085df', 1, 1, 'MyApp', '[]', 0, '2023-03-30 04:39:41', '2023-03-30 04:39:41', '2024-03-30 08:39:41'),
('fb71a9c5906fa679538821fba26cb38a4bcd491422b19772bb068559a729be58373489d59a781782', 1, 1, 'MyApp', '[]', 0, '2023-04-10 13:24:09', '2023-04-10 13:24:09', '2024-04-10 13:24:09'),
('fc1a3dbd013fc0ae92f6ecbc5c50bd5791a33d43e6fe06c099370cec134e4ea3095abb966a5c09b9', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:31:54', '2023-04-03 06:31:54', '2024-04-03 06:31:54'),
('fc4d2674c3f23eed626774a2b636bb1b8095c2f0ed516ed28e6ccc777383f1bc6bcd78aef9655de3', 1, 1, 'MyApp', '[]', 0, '2023-04-06 09:54:26', '2023-04-06 09:54:26', '2024-04-06 09:54:26'),
('fc848dc5a271f8bfb83d82be39519f192f7fb0ddfc28b4602e8eeb66f87df3bed903c167a9570de2', 1, 1, 'MyApp', '[]', 0, '2023-04-03 06:04:24', '2023-04-03 06:04:24', '2024-04-03 06:04:24'),
('fc9f08b1d9c40611e5d20d5579f2a7d0532ee11da7fe28fa3deb3cd10ec1ef401614ef425f1b27e0', 1, 1, 'MyApp', '[]', 0, '2023-04-04 11:21:45', '2023-04-04 11:21:45', '2024-04-04 11:21:45'),
('fd0343b35ca443307e23caf2630ca4274982defd6829a55810fb14580fe2902ee5b75aba66ced398', 1, 1, 'MyApp', '[]', 0, '2023-04-03 08:50:15', '2023-04-03 08:50:15', '2024-04-03 08:50:15'),
('ff50ecb3ed10c0b4423261dcb09019458c5cc3a7069f81f61d5f6ed6df8e44c4a7eee2328efe2f61', 1, 1, 'MyApp', '[]', 0, '2023-04-10 12:04:28', '2023-04-10 12:04:28', '2024-04-10 12:04:28'),
('ffef9e0a4470d22605228623c0e37f4f63076712f7c3faee0d838f2aac29f4c0cf0275997b41b634', 1, 1, 'MyApp', '[]', 0, '2023-04-10 23:07:45', '2023-04-10 23:07:45', '2024-04-10 23:07:45');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'rayqube', 'b5wrAV05S0WovkPSKquhHeFCJXODmba0ZCl5gv2Z', NULL, 'http://localhost', 1, 0, 0, '2023-03-30 04:23:24', '2023-03-30 04:23:24');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-03-30 04:23:24', '2023-03-30 04:23:24');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'MyApp', '12982ae16264eef9ddba1491190c0989a9d609e846d9de525e1a99b720b826ee', '[\"*\"]', NULL, '2023-03-30 03:24:12', '2023-03-30 03:24:12'),
(2, 'App\\Models\\User', 1, 'MyApp', 'fe12789fef8feb12170f3c28842416cbe364eb8919454f99ced91768e27ec313', '[\"*\"]', NULL, '2023-03-30 03:31:20', '2023-03-30 03:31:20'),
(3, 'App\\Models\\User', 1, 'MyApp', '775ea4aa64baf27bf2179fde61b0b44c84b7da14cb623ed3fd09b110242bc5a4', '[\"*\"]', NULL, '2023-03-30 03:35:05', '2023-03-30 03:35:05'),
(4, 'App\\Models\\User', 1, 'MyApp', '7e6783365fed289ea64d3688645b03e09a6dfed0b5b107d8b55b6d8d55f9154e', '[\"*\"]', NULL, '2023-03-30 03:37:07', '2023-03-30 03:37:07'),
(5, 'App\\Models\\User', 1, 'MyApp', 'e81dd0f902a94822d31295ef88db402560ed70b0cec83bdb587166e11cde5af3', '[\"*\"]', NULL, '2023-03-30 03:38:10', '2023-03-30 03:38:10');

-- --------------------------------------------------------

--
-- Table structure for table `profile_completion_requests`
--

DROP TABLE IF EXISTS `profile_completion_requests`;
CREATE TABLE IF NOT EXISTS `profile_completion_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `google_id` text,
  `google_secret_key` text,
  `facial_analysis_photo` text,
  `profile_photo` text,
  `first_name` varchar(150) DEFAULT NULL,
  `last_name` varchar(150) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `job_experience` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected','') DEFAULT 'Pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_completion_requests`
--

INSERT INTO `profile_completion_requests` (`id`, `users_id`, `google_id`, `google_secret_key`, `facial_analysis_photo`, `profile_photo`, `first_name`, `last_name`, `dob`, `gender`, `nationality`, `job_experience`, `email`, `phone`, `status`, `created_at`, `updated_at`) VALUES
(1, 33, NULL, NULL, NULL, NULL, 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'Rejected', '2023-04-06 05:17:05', '2023-04-25 11:17:34'),
(2, 33, NULL, NULL, NULL, NULL, 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'Approved', '2023-04-06 10:02:27', '2023-04-10 08:24:11'),
(3, 32, NULL, NULL, NULL, NULL, 'sds', '', '1980-04-20', 'male', 'saudi arabia', 2, 'sdsds', '052342343', 'Approved', '2023-04-06 10:03:28', '2023-04-10 08:23:57'),
(4, 33, NULL, NULL, NULL, NULL, 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'Approved', '2023-04-06 10:21:35', '2023-04-10 08:39:56'),
(5, 33, NULL, NULL, NULL, NULL, 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'Rejected', '2023-04-06 10:24:59', '2023-04-10 08:40:01'),
(6, 33, NULL, NULL, NULL, NULL, 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'Approved', '2023-04-06 10:25:17', '2023-04-25 11:50:47'),
(7, 32, NULL, NULL, NULL, NULL, 'sds', '', '1980-04-20', 'male', 'saudi arabia', 2, 'sdsds', '052342343', 'Approved', '2023-04-06 10:26:39', '2023-04-10 22:53:35'),
(8, 31, NULL, NULL, NULL, NULL, 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'Approved', '2023-04-07 07:23:39', '2023-04-10 22:42:12'),
(9, 35, NULL, NULL, NULL, NULL, 'asdasd', '', NULL, NULL, NULL, NULL, 'asdadad@pico.com', NULL, 'Pending', '2023-04-10 23:10:00', '2023-04-10 23:10:00'),
(10, 35, NULL, NULL, NULL, NULL, 'asdasd', '', '1983-04-20', 'male', 'saudi arabia', 2, 'asdadad@pico.com', '23232332', 'Pending', '2023-04-10 23:28:35', '2023-04-10 23:28:35'),
(11, 35, NULL, NULL, NULL, NULL, 'asdasd', '', '1958-04-20', 'Male', 'Saudi Arabia', 2, 'asdadad@pico.com', '6543246', 'Approved', '2023-04-10 23:28:50', '2023-04-11 00:09:36'),
(12, 37, NULL, NULL, NULL, NULL, 'Suhaib', '', '1997-05-25', 'Male', 'Iraq', 3, 'suhaibasaadwork@gmail.com', '0501273099', 'Approved', '2023-04-11 09:38:01', '2023-04-28 10:58:56'),
(14, 1, NULL, NULL, NULL, 'https://aramcorq.s3.eu-north-1.amazonaws.com/mosaic_wall/168257948575171380.jpg', 'Adib', '', '2023-04-18', 'sd', 'sd', 22, 'adib@pico.com', '234234523', 'Approved', '2023-04-27 07:11:26', '2023-04-27 07:15:32'),
(15, 2, NULL, NULL, NULL, 'https://aramcorq.s3.eu-north-1.amazonaws.com/mosaic_wall/1682580984246920851.jpg', 'ddds', '', '2023-11-20', 'm', 'dsd', 111, 'ddd@ddd.om', '1111111', 'Approved', '2023-04-27 07:36:27', '2023-04-27 07:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `questionaire`
--

DROP TABLE IF EXISTS `questionaire`;
CREATE TABLE IF NOT EXISTS `questionaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questionaire`
--

INSERT INTO `questionaire` (`id`, `question`, `created_at`, `updated_at`) VALUES
(1, 'Your favorite pet name', NULL, NULL),
(2, 'Your first school name', NULL, NULL),
(3, 'Your favorite month', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questionaire_answers`
--

DROP TABLE IF EXISTS `questionaire_answers`;
CREATE TABLE IF NOT EXISTS `questionaire_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questionaire_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `google_id` text NOT NULL,
  `users_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questionaire_answers`
--

INSERT INTO `questionaire_answers` (`id`, `questionaire_id`, `answer`, `google_id`, `users_id`, `created_at`, `updated_at`) VALUES
(28, 1, 'xxxxx', 'wwwwxxxxxxqqqrrwwrrzzeeet', 31, '2023-04-10 10:49:48', '2023-04-10 10:49:48'),
(29, 2, 'Secondary School Inter', 'wwwwxxxxxxqqqrrwwrrzzeeet', 31, '2023-04-10 10:49:48', '2023-04-10 10:49:48'),
(30, 3, 'October', 'wwwwxxxxxxqqqrrwwrrzzeeet', 31, '2023-04-10 10:49:48', '2023-04-10 10:49:48'),
(34, 1, 'rock', '107665965028130307473', 3, '2023-04-10 21:09:21', '2023-04-10 21:09:21'),
(35, 2, 'school', '107665965028130307473', 3, '2023-04-10 21:09:21', '2023-04-10 21:09:21'),
(36, 3, 'october', '107665965028130307473', 3, '2023-04-10 21:09:21', '2023-04-10 21:09:21'),
(37, 1, 'Dog', '106051286077636479541', 36, '2023-04-10 21:59:21', '2023-04-10 21:59:21'),
(38, 2, 'School', '106051286077636479541', 36, '2023-04-10 21:59:21', '2023-04-10 21:59:21'),
(39, 3, 'June', '106051286077636479541', 36, '2023-04-10 21:59:21', '2023-04-10 21:59:21'),
(40, 1, 'Oscar', '117155990067310180248', 37, '2023-04-11 09:34:59', '2023-04-11 09:34:59'),
(41, 2, 'AlNahda', '117155990067310180248', 37, '2023-04-11 09:34:59', '2023-04-11 09:34:59'),
(42, 3, 'May', '117155990067310180248', 37, '2023-04-11 09:34:59', '2023-04-11 09:34:59');

-- --------------------------------------------------------

--
-- Table structure for table `required_resources_list`
--

DROP TABLE IF EXISTS `required_resources_list`;
CREATE TABLE IF NOT EXISTS `required_resources_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `required_resources_list`
--

INSERT INTO `required_resources_list` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Conference Theater', '2023-04-28 08:38:50', '2023-04-28 08:39:14'),
(2, 'CISCO Conferencing', '2023-04-28 08:39:16', '2023-04-28 08:41:08'),
(3, 'Space for Booths', '2023-04-28 08:39:16', '2023-04-28 08:41:08'),
(4, 'Video Wall(s) Projector Content', '2023-04-28 08:39:53', '2023-04-28 08:41:08'),
(5, 'Technology Exhibition', '2023-04-28 08:40:15', '2023-04-28 08:41:08'),
(6, 'Others', '2023-04-28 08:40:35', '2023-04-28 08:41:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2023-03-02 08:27:03', '2023-03-02 08:39:08'),
(3, 'Limited Access User', 'web', '2023-03-31 05:21:18', '2023-03-31 05:21:18'),
(4, 'Full Access User', 'web', '2023-04-03 10:48:40', '2023-04-03 10:48:40'),
(5, 'Admin', 'web', '2023-04-03 10:49:04', '2023-04-03 10:49:04');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_visit_request`
--

DROP TABLE IF EXISTS `schedule_visit_request`;
CREATE TABLE IF NOT EXISTS `schedule_visit_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `visit_title` text NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `num_of_visitors` int(11) NOT NULL,
  `visitor_coordinator_contact` text NOT NULL,
  `justification` text NOT NULL,
  `additional_info` text NOT NULL,
  `status_of_request` enum('Pending','Approved','Rejected','Deleted') NOT NULL DEFAULT 'Pending',
  `date_of_request` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule_visit_request`
--

INSERT INTO `schedule_visit_request` (`id`, `users_id`, `visit_title`, `start_date`, `end_date`, `num_of_visitors`, `visitor_coordinator_contact`, `justification`, `additional_info`, `status_of_request`, `date_of_request`, `created_at`, `updated_at`) VALUES
(1, 11, 'test event', '2023-05-10 00:00:00', '2023-04-26 11:30:00', 10, '123456', 'there is no justification', 'no', 'Pending', '2023-04-19', '2023-04-19 08:47:29', '2023-04-19 08:47:29'),
(2, 11, 'test event', '2023-05-10 00:00:00', '2023-04-26 11:30:00', 10, '123456', 'there is no justification', 'no', 'Pending', '2023-04-19', '2023-04-24 06:17:38', '2023-04-24 06:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `technology_list`
--

DROP TABLE IF EXISTS `technology_list`;
CREATE TABLE IF NOT EXISTS `technology_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `technology_list`
--

INSERT INTO `technology_list` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Metaverse', '2023-04-28 09:48:14', '2023-04-28 09:49:27'),
(2, 'Blockchain', '2023-04-28 09:48:14', '2023-04-28 09:49:27'),
(3, 'Virtual Reality', '2023-04-28 09:48:40', '2023-04-28 09:49:27'),
(4, 'Augmented Reality', '2023-04-28 09:48:53', '2023-04-28 09:49:27'),
(5, 'Robotics', '2023-04-28 09:49:10', '2023-04-28 09:49:27'),
(6, 'Other', '2023-05-04 10:20:53', '2023-05-04 10:21:02');

-- --------------------------------------------------------

--
-- Table structure for table `technology_workshop_request`
--

DROP TABLE IF EXISTS `technology_workshop_request`;
CREATE TABLE IF NOT EXISTS `technology_workshop_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `workshop_name` varchar(500) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `num_of_people` int(11) NOT NULL,
  `point_of_contact` text NOT NULL,
  `justification` text NOT NULL,
  `additional_info` text NOT NULL,
  `status_of_request` enum('Pending','Approved','Rejected','Deleted') NOT NULL,
  `date_of_request` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `technology_workshop_request`
--

INSERT INTO `technology_workshop_request` (`id`, `users_id`, `workshop_name`, `start_date`, `end_date`, `num_of_people`, `point_of_contact`, `justification`, `additional_info`, `status_of_request`, `date_of_request`, `created_at`, `updated_at`) VALUES
(1, 11, 'test event', '2023-04-25 00:00:00', '2023-04-26 10:40:00', 10, '123456', 'there is no justification', 'no', 'Pending', '2023-04-19', '2023-04-19 09:02:41', '2023-04-19 09:02:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` text,
  `google_id` text,
  `google_secret_key` text,
  `factor_secret_key` text,
  `facial_analysis_photo` text,
  `profile_photo` text,
  `first_name` varchar(150) DEFAULT NULL,
  `last_name` varchar(150) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `job_experience` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `twitter_account` text,
  `linkedin_account` text,
  `status` enum('Pending','Approved','Rejected','') DEFAULT 'Pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unique_id`, `google_id`, `google_secret_key`, `factor_secret_key`, `facial_analysis_photo`, `profile_photo`, `first_name`, `last_name`, `dob`, `gender`, `nationality`, `job_experience`, `email`, `phone`, `twitter_account`, `linkedin_account`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, '233234', NULL, '123123123123', NULL, 'https://aramcorq.s3.eu-north-1.amazonaws.com/mosaic_wall/168257948575171380.jpg', 'Adib', '', '2023-04-18', 'sd', 'sd', 22, 'adib@pico.com', '234234523', NULL, NULL, 'Approved', '2023-03-31 11:23:32', '2023-04-27 07:15:32'),
(2, NULL, 'xxxxxccc', 'gfdgfdgfdggfd', 'fgggfgfgg', NULL, 'https://aramcorq.s3.eu-north-1.amazonaws.com/mosaic_wall/1682580984246920851.jpg', 'ddds', '', '2023-11-20', 'm', 'dsd', 111, 'ddd@ddd.om', '1111111', NULL, NULL, 'Approved', '2023-03-31 11:27:50', '2023-04-27 07:36:56'),
(3, NULL, '107665965028130307473', NULL, 'XUENFTXZCH2W6DPNWPHL4P6D3SK4KYFX', NULL, 'http://65.0.191.153/aramco_cms/public/uploads/profilephotos/-06-04-2023-08-29-59.png', 'ADIB', '', '1998-10-17', 'Male', 'Saudi Arabia', NULL, 'adib@pico.com', '0522590098', '{\"token\":\"\",\"RefreshToken\":\"\",\"Id\":\"\",\"isConnected\":false}', '{\"token\":\"AQVq2tIdiAuX0ZxlObRrrWDNpQq4d6n2gOJu_yOW3kNoIbG02poeGNRCoLBYWAo4EnyP89_Gi2bqrTnB8qcvPakbbk5RUWtjrrojT0VX4Y4LUr8_0km0WWKRoR65TrIMqaydugkLlnlm6-SAWKlcgiW-OrO0DjLGZ3fYnNRv-oaOqRUP4WXz-LgLJ8ZYVhY_ICIZC6JQMdT0zCF_i_Vf9H-wfbqz4sy6tazVUP4-_rHIRhHvGiDTd5b18DEk3BJOmzzH64gkvNiCtDy1ZxZveRwMOKEnG6IzCOffpDup0N7XKhZOYl60lGEROLnaqPu0L-DRdh6SrfahE6IGeZupJTy6IrXP3g\",\"RefreshToken\":\"\",\"Id\":\"fu3r8alD3f\",\"isConnected\":true}', NULL, '2023-03-31 11:34:49', '2023-04-11 00:14:23'),
(4, NULL, 'xxxxxccctrrrdd', 'gfdgfdgfdggfd', 'fgggfgfgg', NULL, 'https://aramcorq.s3.eu-north-1.amazonaws.com/', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 07:35:55', '2023-04-01 07:35:55'),
(5, NULL, 'xxxx', 'gfdgfdgfdggfd', 'fgggfgfgg', NULL, 'https://aramcorq.s3.eu-north-1.amazonaws.com/', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 07:37:42', '2023-04-01 07:37:42'),
(6, NULL, 'xxxxddd', 'gfdgfdgfdggfd', 'fgggfgfgg', NULL, 'https://aramcorq.s3.eu-north-1.amazonaws.com/', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 07:51:26', '2023-04-01 07:51:26'),
(7, NULL, 'xxxxdddsss', 'gfdgfdgfdggfd', 'fgggfgfgg', NULL, '0', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 08:22:09', '2023-04-01 08:22:09'),
(8, NULL, 'xxxxdddsssgfg', 'gfdgfdgfdggfd', 'fgggfgfgg', NULL, '0', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 08:32:45', '2023-04-01 08:32:45'),
(9, NULL, 'xxxxdddsssgfgzzz', 'gfdgfdgfdggfd', 'fgggfgfgg', NULL, 'https://aramcorq.s3.eu-north-1.amazonaws.com/', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 08:52:35', '2023-04-01 08:52:35'),
(10, NULL, 'zzzzzzzzzzzuuuuu', 'gfdgfdgfdggfd', 'fgggfgfgg', NULL, 'https://aramcorq.s3.eu-north-1.amazonaws.com/', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 09:30:48', '2023-04-01 09:30:48'),
(11, NULL, 'zzzzzzzzzzzuuuuuzzzz', 'gfdgfdgfdggfd', 'fgggfgfgg', NULL, 'https://testrayqube.s3.ap-south-1.amazonaws.com/', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 09:38:14', '2023-04-01 09:38:14'),
(12, NULL, 'zzzzzzzzzzzuuuuuzzzzbbbb', 'gfdgfdgfdggfd', 'fgggfgfgg', NULL, 'https://testrayqube.s3.ap-south-1.amazonaws.com/', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 09:40:12', '2023-04-01 09:40:12'),
(13, NULL, 'zzzzzzzzzzzuuuuuzzzzbbbbccc', 'gfdgfdgfdggfdpp', 'fgggfgfgg', NULL, 'https://testrayqube.s3.ap-south-1.amazonaws.com/', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 20:27:43', '2023-04-01 20:27:43'),
(14, NULL, 'zxxzzzzzzzzzzuuuuuzzzzbbbbccc', 'gfdgfdgfdggfdpp', 'fgggfgfgg', NULL, '/var/www/html/aramco_cms/public/uploads/profilephotos/dddd-01-04-2023-20-28-13.png', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 20:28:13', '2023-04-01 20:28:13'),
(15, NULL, 'zxxzzzzzzzzzzuuuuuzzzzbbbbccccc', 'gfdgfdgfdggfdpp', 'fgggfgfgg', NULL, '/var/www/html/aramco_cms/public/uploads/profilephotos/dddd-01-04-2023-20-30-07.png', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 20:30:07', '2023-04-01 20:30:07'),
(16, NULL, 'zxxzzzzzzzzzzuuuuuzzzzbbbbcccccdd', 'gfdgfdgfdggfdpp', 'fgggfgfgg', NULL, 'http://65.0.191.153/aramco_cms/public/uploads/profilephotos/dddd-01-04-2023-20-31-02.png', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 20:31:02', '2023-04-01 20:31:02'),
(17, NULL, 'zxxzzzzzzzzzzuuuuuzzzzbbbbcccccddt', 'gfdgfdgfdggfdpp', 'fgggfgfgg', NULL, 'http://65.0.191.153/aramco_cms/public/storage/profilephotos/dddd-01-04-2023-20-38-50.png', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 20:38:50', '2023-04-01 20:38:50'),
(18, NULL, 'zxxzzzzzzzzzzuuuuuzzzzbbbbcccccddtcc', 'gfdgfdgfdggfdpp', 'fgggfgfgg', NULL, 'http://65.0.191.153/aramco_cms/public/storage/profilephotos/dddd-01-04-2023-20-40-07.png', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 20:40:07', '2023-04-01 20:40:07'),
(19, NULL, 'zxxzzzzzzzzzzuuuuuzzzzbbbbcccccddtccx', 'gfdgfdgfdggfdpp', 'fgggfgfgg', NULL, 'http://65.0.191.153/aramco_cms/public/storage/profilephotos/dddd-01-04-2023-20-41-50.png', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 20:41:50', '2023-04-01 20:41:50'),
(20, NULL, 'sssssssssssssssss', 'gfdgfdgfdggfdpp', 'fgggfgfgg', NULL, 'http://65.0.191.153/aramco_cms/public/storage/profilephotos/dddd-01-04-2023-20-50-53.png', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 20:50:53', '2023-04-01 20:50:53'),
(21, NULL, 'sssssssssssssssssc', 'gfdgfdgfdggfdpp', 'fgggfgfgg', NULL, 'http://65.0.191.153/aramco_cms/public/storage/profilephotos/dddd-01-04-2023-20-55-37.png', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 20:55:37', '2023-04-01 20:55:37'),
(22, NULL, 'ssssssssssssssssscv', 'gfdgfdgfdggfdpp', 'fgggfgfgg', NULL, '0', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 20:57:13', '2023-04-01 20:57:13'),
(25, NULL, 'sssssssssssssssssssssscvxz', 'gfdgfdgfdggfdpp', 'fgggfgfgg', NULL, 'http://65.0.191.153/aramco_cms/public/storage/profilephotos/dddd-02-04-2023-12-30-24.png', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-02 12:30:24', '2023-04-02 12:30:24'),
(24, NULL, 'ssssssssssssssssscvxz', 'gfdgfdgfdggfdpp', 'fgggfgfgg', NULL, 'http://65.0.191.153/aramco_cms/public/storage/profilephotos/dddd-01-04-2023-21-01-48.png', 'waseem', '', '2023-11-20', 'm', 'dsd', 11, 'waseem@pico.com', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-01 21:01:48', '2023-04-02 06:36:47'),
(26, NULL, 'wwww', 'gfdgfdgfdggfdpp', 'fgggfgfgg', NULL, 'http://65.0.191.153/aramco_cms/public/storage/profilephotos/dddd-02-04-2023-12-31-40.png', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-02 12:31:40', '2023-04-02 12:31:40'),
(27, NULL, 'wwwwxxxxxx', 'gfdgfdgfdggfdpp', 'fgggfgfgg', NULL, 'http://65.0.191.153/aramco_cms/public/storage/profilephotos/dddd-02-04-2023-12-33-36.png', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-02 12:33:36', '2023-04-02 12:33:36'),
(28, NULL, 'wwwwxxxxxxqqq', 'gfdgfdgfdggfdpp', 'fgggfgfgg', NULL, 'http://65.0.191.153/aramco_cms/public/storage/profilephotos/dddd-02-04-2023-12-34-42.png', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-02 12:34:42', '2023-04-02 12:34:42'),
(29, NULL, 'wwwwxxxxxxqqqrrrr', 'gfdgfdgfdggfdpp', 'fgggfgfgg', NULL, 'http://65.0.191.153/aramco_cms/public/storage/profilephotos/dddd-02-04-2023-12-35-10.png', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-02 12:35:10', '2023-04-02 12:35:10'),
(30, NULL, 'wwwwxxxxxxqqqrrrrzz', 'gfdgfdgfdggfdpp', 'fgggfgfgg', NULL, 'http://65.0.191.153/aramco_cms/public/storage/profilephotos/dddd-02-04-2023-12-35-57.png', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', NULL, '2023-04-02 12:35:57', '2023-04-02 12:35:57'),
(31, NULL, 'wwwwxxxxxxqqqrrwwrrzzeeet', 'gfdgfdgfdggfdpp', NULL, NULL, 'http://65.0.191.153/aramco_cms/public/uploads/profilephotos/waseem@rayqube-com-07-04-2023-09-53-28.png', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', 'Approved', '2023-04-02 12:43:18', '2023-04-10 22:42:12'),
(32, NULL, '107665965028130302332', NULL, '1998122323', NULL, 'http://65.0.191.153/aramco_cms/public/uploads/profilephotos/-06-04-2023-11-00-42.png', 'sds', '', '1980-04-20', 'male', 'saudi arabia', 2, 'sdsds', '052342343', '{}', '{}', 'Approved', '2023-04-03 07:14:48', '2023-04-10 22:53:35'),
(33, NULL, '116173780940823468393', NULL, '7YQEB6NJ5A6UGBZWIWT5LWEZSYNA74GV', NULL, NULL, 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', NULL, NULL, 'Approved', '2023-04-03 11:09:24', '2023-04-25 11:50:47'),
(34, NULL, 'wwwwxxxxxxqqqrrwwrrzzeeettt', 'gfdgfdgfdggfdpp', 'fgggfgfgg', NULL, 'http://65.0.191.153/aramco_cms/public/uploads/profilephotos/dddd-07-04-2023-10-21-48.png', 'ddds', '', '2023-11-20', 'm', 'dsd', 11, 'dddd', '323232323', 'dsdsd', 'sdsd', 'Pending', '2023-04-07 10:21:48', '2023-04-07 10:21:48'),
(35, NULL, '111539723009582085740', NULL, 'KUIHP6RFPTPE2OJ3FROD6QSOMNCC6GVJ', NULL, 'http://65.0.191.153/aramco_cms/public/uploads/profilephotos/-10-04-2023-23-28-50.png', 'asdasd', '', '1958-04-20', 'Male', 'Saudi Arabia', 2, 'asdadad@pico.com', '6543246', '{\"token\":\"\",\"RefreshToken\":\"\",\"Id\":\"\",\"first_name\":\"\",\"isConnected\":false}', '{\"token\":\"\",\"RefreshToken\":\"\",\"Id\":\"\",\"first_name\":\"\",\"isConnected\":false}', 'Approved', '2023-04-10 12:48:09', '2023-04-11 00:09:36'),
(36, NULL, '106051286077636479541', NULL, 'ZFP2YGDC4P4WX5R4NDDL7LSJYY4QUEJD', NULL, 'http://65.0.191.153/aramco_cms/public/uploads/profilephotos/adib-farah569@gmail-com-10-04-2023-19-44-58.png', 'adib', '', NULL, NULL, NULL, NULL, 'adib.farah569@gmail.com', NULL, NULL, NULL, 'Pending', '2023-04-10 19:44:58', '2023-04-10 21:59:21'),
(37, NULL, '117155990067310180248', NULL, 'XOVE36RNJPU42M5G6X666LLXXYGPCYBM', NULL, NULL, 'asfasfsdf', '', '1997-05-25', 'Male', 'Iraq', 3, NULL, '0501273099', NULL, NULL, 'Approved', '2023-04-11 09:33:20', '2023-04-28 10:57:09'),
(38, NULL, '115897004013681882751', NULL, NULL, NULL, NULL, 'Amarjeet', '', NULL, NULL, NULL, NULL, 'amarjeet@rayqube.com', NULL, NULL, NULL, 'Pending', '2023-04-24 08:05:54', '2023-04-24 08:05:54'),
(39, NULL, '114690324286335058261', NULL, NULL, NULL, NULL, 'amarjeet', 'kaur', NULL, NULL, NULL, NULL, 'amarjeet.kaur111@gmail.com', NULL, NULL, NULL, 'Pending', '2023-04-28 09:18:34', '2023-04-28 09:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `workshop_request`
--

DROP TABLE IF EXISTS `workshop_request`;
CREATE TABLE IF NOT EXISTS `workshop_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `workshop_name` varchar(100) NOT NULL,
  `date_of_visit` date NOT NULL,
  `time_of_visit` time NOT NULL,
  `num_of_people` int(11) NOT NULL,
  `point_of_contact` text NOT NULL,
  `justification` text NOT NULL,
  `additional_info` text NOT NULL,
  `status_of_reuest` enum('Pending','Approved','Rejected') NOT NULL,
  `date_of_request` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
