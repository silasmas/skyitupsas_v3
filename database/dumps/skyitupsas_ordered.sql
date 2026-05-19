-- Export ordonné — skyitupsas
-- Généré le 2026-05-19 01:52:36
-- Ordre : parents avant tables avec clés étrangères

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- Structure et données : users
-- --------------------------------------------------------

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Test User', 'test@example.com', '2026-03-17 16:45:37', '$2y$12$msgW1fDuJu20OiCpOdkQuOozXGggK.CUkzJcpIMf59Ie.3Pw9SOTS', 'OUzA2z1swdyBLZg6Wd0Ah3jXxGLjRiR6XzFLUuT1R9MIcM8QzU5nDygVSECE', '2026-03-17 16:45:37', '2026-03-17 16:45:37');

-- --------------------------------------------------------
-- Structure et données : permissions
-- --------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'view_about', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(2, 'view_any_about', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(3, 'create_about', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(4, 'update_about', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(5, 'restore_about', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(6, 'restore_any_about', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(7, 'replicate_about', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(8, 'reorder_about', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(9, 'delete_about', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(10, 'delete_any_about', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(11, 'force_delete_about', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(12, 'force_delete_any_about', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(13, 'view_blog', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(14, 'view_any_blog', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(15, 'create_blog', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(16, 'update_blog', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(17, 'restore_blog', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(18, 'restore_any_blog', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(19, 'replicate_blog', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(20, 'reorder_blog', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(21, 'delete_blog', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(22, 'delete_any_blog', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(23, 'force_delete_blog', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(24, 'force_delete_any_blog', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(25, 'view_contact', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(26, 'view_any_contact', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(27, 'create_contact', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(28, 'update_contact', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(29, 'restore_contact', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(30, 'restore_any_contact', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(31, 'replicate_contact', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(32, 'reorder_contact', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(33, 'delete_contact', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(34, 'delete_any_contact', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(35, 'force_delete_contact', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(36, 'force_delete_any_contact', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(37, 'view_realisation', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(38, 'view_any_realisation', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(39, 'create_realisation', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(40, 'update_realisation', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(41, 'restore_realisation', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(42, 'restore_any_realisation', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(43, 'replicate_realisation', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(44, 'reorder_realisation', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(45, 'delete_realisation', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(46, 'delete_any_realisation', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(47, 'force_delete_realisation', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(48, 'force_delete_any_realisation', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(49, 'view_role', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(50, 'view_any_role', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(51, 'create_role', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(52, 'update_role', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(53, 'delete_role', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(54, 'delete_any_role', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(55, 'view_service', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(56, 'view_any_service', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(57, 'create_service', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(58, 'update_service', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(59, 'restore_service', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(60, 'restore_any_service', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(61, 'replicate_service', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(62, 'reorder_service', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(63, 'delete_service', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(64, 'delete_any_service', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(65, 'force_delete_service', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(66, 'force_delete_any_service', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(67, 'view_team::member', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(68, 'view_any_team::member', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(69, 'create_team::member', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(70, 'update_team::member', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(71, 'restore_team::member', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(72, 'restore_any_team::member', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(73, 'replicate_team::member', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(74, 'reorder_team::member', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(75, 'delete_team::member', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(76, 'delete_any_team::member', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(77, 'force_delete_team::member', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(78, 'force_delete_any_team::member', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(79, 'view_user', 'web', '2026-03-17 17:50:31', '2026-03-17 17:50:31'),
	(80, 'view_any_user', 'web', '2026-03-17 17:50:31', '2026-03-17 17:50:31'),
	(81, 'create_user', 'web', '2026-03-17 17:50:32', '2026-03-17 17:50:32'),
	(82, 'update_user', 'web', '2026-03-17 17:50:32', '2026-03-17 17:50:32'),
	(83, 'restore_user', 'web', '2026-03-17 17:50:32', '2026-03-17 17:50:32'),
	(84, 'restore_any_user', 'web', '2026-03-17 17:50:32', '2026-03-17 17:50:32'),
	(85, 'replicate_user', 'web', '2026-03-17 17:50:32', '2026-03-17 17:50:32'),
	(86, 'reorder_user', 'web', '2026-03-17 17:50:32', '2026-03-17 17:50:32'),
	(87, 'delete_user', 'web', '2026-03-17 17:50:32', '2026-03-17 17:50:32'),
	(88, 'delete_any_user', 'web', '2026-03-17 17:50:32', '2026-03-17 17:50:32'),
	(89, 'force_delete_user', 'web', '2026-03-17 17:50:32', '2026-03-17 17:50:32'),
	(90, 'force_delete_any_user', 'web', '2026-03-17 17:50:32', '2026-03-17 17:50:32');

-- --------------------------------------------------------
-- Structure et données : roles
-- --------------------------------------------------------

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'super_admin', 'web', '2026-03-17 17:49:22', '2026-03-17 17:49:22'),
	(2, 'panel_user', 'web', '2026-03-17 17:49:38', '2026-03-17 17:49:38');

-- --------------------------------------------------------
-- Structure et données : cache
-- --------------------------------------------------------

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Aucune donnée pour `cache`

-- --------------------------------------------------------
-- Structure et données : cache_locks
-- --------------------------------------------------------

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Aucune donnée pour `cache_locks`

-- --------------------------------------------------------
-- Structure et données : jobs
-- --------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Aucune donnée pour `jobs`

-- --------------------------------------------------------
-- Structure et données : job_batches
-- --------------------------------------------------------

DROP TABLE IF EXISTS `job_batches`;
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
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Aucune donnée pour `job_batches`

-- --------------------------------------------------------
-- Structure et données : failed_jobs
-- --------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Aucune donnée pour `failed_jobs`

-- --------------------------------------------------------
-- Structure et données : password_reset_tokens
-- --------------------------------------------------------

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Aucune donnée pour `password_reset_tokens`

-- --------------------------------------------------------
-- Structure et données : sessions
-- --------------------------------------------------------

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Aucune donnée pour `sessions`

-- --------------------------------------------------------
-- Structure et données : migrations
-- --------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_03_17_152125_create_media_table', 1),
	(5, '2026_03_17_160000_create_team_members_table', 1),
	(6, '2026_03_17_160001_create_abouts_table', 1),
	(7, '2026_03_17_160002_create_services_table', 1),
	(8, '2026_03_17_160003_create_blogs_table', 1),
	(9, '2026_03_17_160004_create_contacts_table', 1),
	(10, '2026_03_17_160005_create_realisations_table', 1),
	(11, '2026_03_17_170000_add_info_fields_to_abouts_table', 1),
	(12, '2026_03_17_170001_add_subtitle_to_services_table', 1),
	(14, '2026_03_17_174317_create_permission_tables', 2),
	(15, '2026_05_14_120000_create_partners_table', 3),
	(16, '2026_05_14_120001_create_job_offers_table', 3),
	(17, '2026_05_14_120002_create_job_applications_table', 3),
	(18, '2026_05_14_200000_add_bio_to_team_members_table', 4),
	(19, '2026_05_15_120000_add_featured_image_to_services_table', 5),
	(20, '2026_05_16_100000_add_cover_letter_path_to_job_applications_table', 6),
	(21, '2026_05_16_140000_create_contact_messages_table', 7),
	(22, '2026_05_16_140001_create_newsletter_subscribers_table', 7);

-- --------------------------------------------------------
-- Structure et données : role_has_permissions
-- --------------------------------------------------------

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(29, 1),
	(30, 1),
	(31, 1),
	(32, 1),
	(33, 1),
	(34, 1),
	(35, 1),
	(36, 1),
	(37, 1),
	(38, 1),
	(39, 1),
	(40, 1),
	(41, 1),
	(42, 1),
	(43, 1),
	(44, 1),
	(45, 1),
	(46, 1),
	(47, 1),
	(48, 1),
	(49, 1),
	(50, 1),
	(51, 1),
	(52, 1),
	(53, 1),
	(54, 1),
	(55, 1),
	(56, 1),
	(57, 1),
	(58, 1),
	(59, 1),
	(60, 1),
	(61, 1),
	(62, 1),
	(63, 1),
	(64, 1),
	(65, 1),
	(66, 1),
	(67, 1),
	(68, 1),
	(69, 1),
	(70, 1),
	(71, 1),
	(72, 1),
	(73, 1),
	(74, 1),
	(75, 1),
	(76, 1),
	(77, 1),
	(78, 1),
	(79, 1),
	(80, 1),
	(81, 1),
	(82, 1),
	(83, 1),
	(84, 1),
	(85, 1),
	(86, 1),
	(87, 1),
	(88, 1),
	(89, 1),
	(90, 1);

-- --------------------------------------------------------
-- Structure et données : abouts
-- --------------------------------------------------------

DROP TABLE IF EXISTS `abouts`;
CREATE TABLE `abouts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `big_title` json DEFAULT NULL,
  `big_title_1` json DEFAULT NULL,
  `big_title_2` json DEFAULT NULL,
  `welcome_title_1` json DEFAULT NULL,
  `welcome_title_2` json DEFAULT NULL,
  `title` json NOT NULL,
  `subtitle` json DEFAULT NULL,
  `content` json DEFAULT NULL,
  `experience_label` json DEFAULT NULL,
  `diploma_label` json DEFAULT NULL,
  `expertise_label` json DEFAULT NULL,
  `work_countries_label` json DEFAULT NULL,
  `content1` json DEFAULT NULL,
  `content2` json DEFAULT NULL,
  `meta_description` json DEFAULT NULL,
  `sort_order` smallint unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `abouts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `abouts` (`id`, `slug`, `big_title`, `big_title_1`, `big_title_2`, `welcome_title_1`, `welcome_title_2`, `title`, `subtitle`, `content`, `experience_label`, `diploma_label`, `expertise_label`, `work_countries_label`, `content1`, `content2`, `meta_description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'a-propos', '{"en": "About us", "fr": "A propos de nous"}', '{"en": "About", "fr": "A propos de"}', '{"en": "us", "fr": "nous"}', '{"en": "Welcome to", "fr": "Bienvenue chez"}', '{"en": "our", "fr": "notre"}', '{"en": "About us", "fr": "A propos de nous"}', '{"en": "Welcome to our", "fr": "Bienvenue chez notre"}', '{"en": "SKYITUP a Digital Services Company, based in Kinshasa, founded and managed by a team of professionals with long experience in international leadership and mainly in the African continent in new information and communication technologies.\\n\\nWe offer and provide a rich portfolio of Intelligent solutions adapted to the socio-economic environment and entities for better added value.", "fr": "SKYITUP une Entreprise de Services du Numérique, basée à Kinshasa, fondée et dirigée par une équipe de professionnels possédant une longue expérience dans le leadership international et principalement dans le continent Africain dans les nouvelles technologies de l''information et de la communication.\\n\\nNous offrons et fournissons un portefeuille bien riche de solutions Intelligentes adaptées à l''environnement socio-économique et aux entités pour une meilleur valeur ajoutée."}', '{"en": "Previous experience", "fr": "Expérience antérieure"}', '{"en": "Diploma and training", "fr": "Diplôme et formation"}', '{"en": "Expertise", "fr": "Expertise"}', '{"en": "Countries of work", "fr": "Pays de travail"}', '{"en": "SKYITUP a Digital Services Company, based in Kinshasa, founded and managed by a team of professionals with long experience in international leadership and mainly in the African continent in new information and communication technologies.", "fr": "SKYITUP une Entreprise de Services du Numérique, basée à Kinshasa, fondée et dirigée par une équipe de professionnels possédant une longue expérience dans le leadership international et principalement dans le continent Africain dans les nouvelles technologies de l''information et de la communication."}', '{"en": "We offer and provide a rich portfolio of Intelligent solutions adapted to the socio-economic environment and entities for better added value.", "fr": "Nous offrons et fournissons un portefeuille bien riche de solutions Intelligentes adaptées à l''environnement socio-économique et aux entités pour une meilleur valeur ajoutée."}', '{"en": "SKYITUP a Digital Services Company, based in Kinshasa, founded and managed by a team of professionals with long experience in international leadership and mainly in the African continent in new information and communication technologies.", "fr": "SKYITUP une Entreprise de Services du Numérique, basée à Kinshasa, fondée et dirigée par une équipe de professionnels possédant une longue expérience dans le leadership international et principalement dans le continent Africain dans les nouvelles technologies de l''information et de la communication."}', 0, 1, '2026-03-17 16:45:37', '2026-03-17 16:45:37');

-- --------------------------------------------------------
-- Structure et données : blogs
-- --------------------------------------------------------

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` json NOT NULL,
  `excerpt` json DEFAULT NULL,
  `content` json DEFAULT NULL,
  `meta_description` json DEFAULT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `sort_order` smallint unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blogs_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `blogs` (`id`, `slug`, `title`, `excerpt`, `content`, `meta_description`, `featured_image`, `published_at`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'doloribus-eum-ut-itaque', '{"en": "Doloribus eum ut itaque.", "fr": "Doloribus eum ut itaque."}', '{"en": "Non soluta iure iste et enim itaque. Reiciendis nemo sit totam ut. Ut a non nam recusandae. Sint aliquam deleniti delectus earum consectetur est.", "fr": "Non dolor exercitationem molestias voluptas omnis et dolore voluptas. Omnis aliquid dolorum ab facere ut omnis magnam. Ut repellat dicta earum minima voluptas enim voluptatem corporis. Vel non numquam aut in est quis."}', '{"en": "Voluptas qui eligendi est voluptas sequi deserunt. Voluptas ea rerum sit quaerat modi aut voluptatem. Debitis non et fugit tenetur sapiente ut dolor. Animi magni perferendis vitae fugiat.\\n\\nIllum itaque temporibus voluptate et quisquam id voluptas. Et ducimus dignissimos doloremque cumque alias placeat. Excepturi repudiandae accusantium vitae illum sed omnis tenetur. Veniam porro rerum temporibus et aliquam.\\n\\nConsectetur possimus labore repellendus. Et ducimus quis vel qui natus beatae. Velit rem blanditiis cum sit. Ad tempora aut hic et delectus repellat in dolore.\\n\\nVelit tenetur ad iure provident mollitia magni. Pariatur suscipit dolorem unde aliquid quibusdam quam. Dolor consequatur et ab possimus ipsam eos aut.\\n\\nVel sint iusto voluptatem placeat quo impedit. Voluptatum vero aliquid impedit sequi voluptatem. Blanditiis porro reprehenderit officiis et fugit quo. Minus deleniti suscipit distinctio voluptates mollitia.", "fr": "Quas exercitationem eum aut consequatur. Consequatur voluptatibus magnam vitae dolor ducimus et enim. Amet non veniam autem velit incidunt qui exercitationem.\\n\\nEligendi molestiae repellat commodi. Voluptatibus et omnis omnis et asperiores fugiat aut. Ea maxime in accusantium laboriosam quas. Explicabo facere consequatur ut.\\n\\nAperiam quaerat vitae neque qui. Mollitia qui consequuntur sint perferendis modi saepe. Voluptas ut harum corporis corrupti voluptatem qui consequatur. Officiis eius consectetur laborum.\\n\\nCupiditate nam non est autem rerum eum. Ipsum nam dolor quasi quibusdam. Quod molestiae occaecati qui nobis nihil perferendis repellendus cumque.\\n\\nAut autem ut est eligendi et. Veniam eveniet magni est commodi praesentium. Laudantium corrupti saepe excepturi excepturi consequatur est officiis."}', '{"en": "Placeat impedit sunt ratione nam eum.", "fr": "Debitis minima officia autem sunt nam."}', NULL, NULL, 0, 1, '2026-03-17 16:45:37', '2026-03-17 16:45:37'),
	(2, 'ea-ullam-facere-voluptatem-consequuntur-voluptas', '{"en": "Ea ullam facere voluptatem consequuntur voluptas.", "fr": "Ea ullam facere voluptatem consequuntur voluptas."}', '{"en": "Modi consequatur amet eveniet voluptatem incidunt perspiciatis. Adipisci hic sit qui consequatur.", "fr": "At cum nihil laborum. Esse earum occaecati blanditiis illum recusandae. Voluptas laboriosam a adipisci eum iure enim autem enim. Sit et quia nemo quam minus itaque et."}', '{"en": "Qui corporis magni minus fugit. Ea sint et ut quos repudiandae. Iure quia dignissimos sunt est. Voluptatum velit velit inventore maiores.\\n\\nDeleniti optio quia quidem nisi nulla nihil. Repellat qui necessitatibus non hic ipsum et dolorum. Iure eos impedit velit repudiandae impedit voluptatem. Id est est dolor vero eligendi eos.\\n\\nMagni dolorem nesciunt repudiandae ab id. Quod repudiandae enim voluptatem commodi.\\n\\nQuam rem iure nam ut. Rem modi id dolor qui velit. Quo maxime facere aspernatur inventore perferendis.\\n\\nSapiente qui nulla et fuga veniam enim repellat. Doloremque fuga error porro vel. Necessitatibus fugiat nisi voluptate eligendi. Voluptatem adipisci animi totam aliquid dolorem quas debitis. Natus cupiditate repellat quaerat vitae.", "fr": "Qui quod sed ut dolorem exercitationem et. Molestias officiis omnis esse sunt nihil. Facere voluptatem ea numquam sed id est.\\n\\nEst aliquam at aperiam quis alias qui ratione. Quaerat voluptatibus eum vel nostrum ipsam voluptatem laborum. Labore ut id cumque voluptatem ut fugit incidunt. Adipisci assumenda et repudiandae libero.\\n\\nQuas et libero at sit consequuntur commodi. Earum qui id vero aut minus qui. Possimus omnis et nisi recusandae reiciendis fugiat ut id. Pariatur reprehenderit et voluptate aliquid molestiae enim.\\n\\nAdipisci nisi at velit voluptatem iste est quo. Sit porro expedita cupiditate aspernatur sunt eos necessitatibus. Est veritatis consequatur blanditiis explicabo tempore est.\\n\\nIure et consequatur voluptatem. Tempore qui numquam hic ducimus non quas."}', '{"en": "Quae autem et rerum dolorem tempore sit.", "fr": "Incidunt dignissimos in impedit fugit incidunt enim dolores."}', NULL, '2025-11-22 05:44:30', 0, 1, '2026-03-17 16:45:37', '2026-03-17 16:45:37'),
	(3, 'explicabo-non-consectetur-eveniet-qui-quaerat', '{"en": "Explicabo non consectetur eveniet qui quaerat.", "fr": "Explicabo non consectetur eveniet qui quaerat."}', '{"en": "Voluptatem blanditiis pariatur unde est. Ex aut et est sequi sint saepe. Voluptas voluptas voluptas voluptatem.", "fr": "Iure occaecati rerum sunt voluptatum autem. Vel quia consequatur minima iste assumenda."}', '{"en": "Architecto consequuntur recusandae eos. Tempora sapiente sunt aut sit. Consequatur dolor consectetur ex corporis unde. Dolores et veritatis eos.\\n\\nEt id corporis et rem accusamus nam. Odio voluptas ut similique rerum nihil. Ipsam recusandae vel nemo illo quo.\\n\\nLaborum et quis officia voluptatem veniam. Ullam deleniti numquam enim harum. Ut quisquam quibusdam impedit aut est tempora. Eum ab repellat libero.\\n\\nEst eaque fugiat quae neque molestiae error. Dolore excepturi rerum dolorem ut labore illum delectus. Reprehenderit eum omnis exercitationem laboriosam quas. Omnis consequatur ipsum maxime maiores.\\n\\nVoluptatem est odit autem et. Totam aspernatur impedit corrupti soluta. Culpa fugit illo commodi eligendi quis. Expedita eligendi laboriosam eveniet voluptatem.", "fr": "Autem aut cumque est ipsam nisi quo. Quos enim accusantium ut sapiente sunt. Delectus molestiae impedit deleniti est et sapiente. Cumque ab et perferendis omnis. Dicta unde expedita consequatur rerum est ut.\\n\\nSit qui ex nulla sit consequatur reiciendis. Est mollitia quasi omnis libero esse aut voluptatem. Aut ea doloribus quia est nemo nihil.\\n\\nEaque quia laborum earum autem et. Tempora ut minus cum modi. Non et consequuntur velit quod consequatur. Veritatis earum vitae eum illo ea.\\n\\nUt nostrum provident velit necessitatibus iste molestiae quia. Autem rerum temporibus et animi. Repellendus corrupti earum quasi sit ad reiciendis. Reiciendis qui aliquid aliquam consequatur tempore. Dicta amet soluta magni earum eum.\\n\\nAperiam atque corrupti culpa tempora non non omnis consequuntur. Corporis impedit reprehenderit autem perspiciatis ea quae itaque. Quia et nisi et voluptatem. Sit enim consequatur ut et recusandae labore ut. Consequuntur quos culpa quasi illum maxime molestiae."}', '{"en": "Iure corrupti commodi nulla.", "fr": "Ea qui officia dignissimos est natus sunt."}', NULL, '2025-12-25 17:51:14', 0, 1, '2026-03-17 16:45:37', '2026-03-17 16:45:37'),
	(4, 'neque-repellendus-aspernatur-et-repellat-iure', '{"en": "Neque repellendus aspernatur et repellat iure.", "fr": "Neque repellendus aspernatur et repellat iure."}', '{"en": "Doloribus ab nihil quia voluptates fugit voluptas. Commodi molestias assumenda sequi exercitationem qui atque. Dolorem laudantium qui sed. Porro placeat sint nostrum aliquam. Voluptatibus eos molestias necessitatibus ut.", "fr": "Dicta ab ipsa et voluptatum aliquid. Fugiat cupiditate a enim illum quas. Doloribus suscipit corrupti tempore est qui consectetur."}', '{"en": "Esse enim voluptas necessitatibus ad et labore. Et porro ut corrupti reprehenderit quo vel. Qui qui placeat quisquam qui. Explicabo quisquam dolore suscipit quasi ipsa dolor quis facilis.\\n\\nMolestiae labore est tempora harum cumque similique quisquam. Asperiores dolor quaerat beatae nemo omnis repellat. Commodi aspernatur reprehenderit non quo. Velit sunt voluptatem consequuntur dolor asperiores incidunt. Sequi ut ut nostrum laudantium.\\n\\nAsperiores pariatur deserunt aperiam ab saepe. Odio voluptas maiores voluptas neque doloribus hic. Aut id perferendis natus atque reiciendis non. Magnam asperiores natus eveniet molestiae corporis quibusdam.\\n\\nIn et quia illo quia autem. Eligendi dolor consequuntur doloribus incidunt rem rerum. Tenetur est non aut dolor. Doloremque sed quos sunt omnis esse consectetur dicta.\\n\\nNostrum et ut officia aut. Enim earum quae voluptatibus quidem.", "fr": "Laborum quia laudantium ullam culpa doloremque. Quia ratione illum ut fugit laudantium.\\n\\nAt consectetur nemo id debitis. Et vero ut illum est quasi qui porro quia. Sint autem eos voluptas in vero quia accusamus. Assumenda cum perspiciatis maiores pariatur velit.\\n\\nSunt deleniti eum delectus explicabo quas. Ut quia est necessitatibus sed rerum sit ad. Illum natus eum ut repellat quae laudantium et modi. Velit fugit consequatur accusamus vero ea.\\n\\nDoloribus nam eius saepe cupiditate et ut. Aliquam omnis praesentium beatae odio recusandae.\\n\\nQuisquam aperiam sit quas est possimus iste. Est culpa consectetur culpa et eum nobis. Et vitae voluptatem odio et enim aliquam. Est quia vel consequuntur aut exercitationem velit accusantium et."}', '{"en": "Ut et tempora quidem ullam voluptate facere.", "fr": "Ab voluptatem libero dolores et voluptatibus tempora."}', NULL, NULL, 0, 1, '2026-03-17 16:45:37', '2026-03-17 16:45:37'),
	(5, 'repellat-qui-officiis-illo', '{"en": "Repellat qui officiis illo.", "fr": "Repellat qui officiis illo."}', '{"en": "Sint ut delectus natus velit aut enim repellat. Dignissimos excepturi et minus. Consequuntur quo veniam illum excepturi et. Asperiores quaerat architecto et voluptas quidem dolores.", "fr": "Et enim fugit fugiat et. Unde accusamus reprehenderit praesentium est sit. Similique consequuntur ducimus quibusdam et rerum consequatur in nobis. Commodi saepe ut pariatur omnis."}', '{"en": "Nam accusamus vitae harum nihil saepe. Est adipisci facilis ut iusto voluptates.\\n\\nAut reprehenderit nihil voluptatum ea quo tempora. Et adipisci in autem saepe ex ea. Aut et nemo non amet sed tempora.\\n\\nArchitecto velit officiis natus. Et voluptas numquam assumenda aut cupiditate harum similique vero. Numquam officiis aut fugit perferendis. Quis a deserunt quasi perspiciatis aliquam deserunt accusamus.\\n\\nVero quo fugiat ea vel sit. Cum voluptatem eos non. Nisi quo eveniet accusamus.\\n\\nEveniet natus ut cumque architecto et cumque deleniti. Sapiente soluta voluptas neque ullam sit quasi in. Fuga quaerat asperiores qui dolorum corporis expedita sunt.", "fr": "Sunt voluptatum ab eum natus quia assumenda recusandae. Veniam aut possimus asperiores. Vel eaque sed quia aut iusto.\\n\\nVoluptatum possimus libero impedit distinctio in saepe autem tempore. Mollitia qui incidunt quam natus. Quia mollitia excepturi sit. Ratione perspiciatis et id corrupti sed voluptates autem dolores.\\n\\nEt fugit dicta minima recusandae explicabo omnis quod vel. Aut sit aliquid quos. Molestiae laudantium maiores est ipsa. Et sequi repellat ea odio officiis est minima ea.\\n\\nOdit nemo et aut est. Neque nam rem iusto officia magni. Ut sunt corporis dolore blanditiis perspiciatis sunt.\\n\\nEligendi distinctio eum officiis ipsum sit et omnis. Laboriosam ut sit quis velit iste enim eveniet ad. Qui id aut blanditiis aut."}', '{"en": "Expedita nam ducimus cupiditate maxime qui consequatur.", "fr": "Earum quia qui nihil aut mollitia facilis ut quisquam."}', NULL, '2025-03-20 09:44:56', 0, 1, '2026-03-17 16:45:37', '2026-03-17 16:45:37'),
	(6, 'ab-aut-excepturi-qui', '{"en": "Ab aut excepturi qui.", "fr": "Ab aut excepturi qui."}', '{"en": "Delectus voluptates quas corporis saepe. Sit nostrum omnis ab consectetur similique. Eligendi nobis tenetur ab autem ut natus.", "fr": "Maxime hic doloremque vero ab quaerat ut. Enim voluptatem dolorum consequatur molestiae. Ea culpa nemo blanditiis vero aut."}', '{"en": "Est qui nam atque et. Quos hic cupiditate tenetur rerum. Sequi vitae veritatis asperiores.\\n\\nAutem eligendi illum beatae voluptate in. Cum ratione eos officiis dignissimos. Nam vero est harum in. Ut facere mollitia voluptatibus et.\\n\\nRerum qui at recusandae distinctio possimus corporis et explicabo. Et qui ducimus rerum sequi eum. Ducimus beatae qui velit quas fugit deserunt qui. Provident quia voluptatibus sed iusto iste ea magnam.\\n\\nOccaecati et incidunt cupiditate ullam porro eos eum. Autem ipsa rerum exercitationem quia incidunt voluptatem.\\n\\nVoluptas autem quidem aut non autem. Et et ex culpa iure. Cupiditate ea qui impedit non dignissimos. Consequatur quis aut reprehenderit omnis molestiae facere quas.", "fr": "Dolores laborum modi reprehenderit possimus. Rerum et pariatur cumque blanditiis nostrum adipisci. Eius optio non natus voluptas magni.\\n\\nEveniet quo officiis sed laborum sed et autem est. Et sit dolorem sapiente error et sapiente est quas. Voluptas perferendis accusamus non excepturi sunt reprehenderit est.\\n\\nEt et sed dolor laudantium sint. Vitae similique aliquid placeat. Vel magni libero sint omnis adipisci nulla. Eum numquam error consectetur voluptatem soluta. Facere est asperiores ad molestiae ratione natus.\\n\\nLibero sunt sed ipsam. Ducimus veritatis dolor ut non est. Nemo et officiis quo aut. Repudiandae eum ex rem est laborum.\\n\\nSequi inventore sit possimus dolorum odio. Ut natus debitis voluptatem facilis perferendis enim ut. Doloribus rerum dicta voluptas vel. Enim corporis omnis alias quisquam et maiores in."}', '{"en": "A et qui modi tempore fuga aspernatur enim eos.", "fr": "Illum fugit eligendi soluta eum optio maiores reiciendis."}', NULL, '2025-08-26 08:56:31', 0, 1, '2026-05-14 13:42:40', '2026-05-14 13:42:40'),
	(7, 'nihil-officia-incidunt-odio-illo', '{"en": "Nihil officia incidunt odio illo.", "fr": "Nihil officia incidunt odio illo."}', '{"en": "Ut sapiente sed architecto cupiditate quas est. Blanditiis consequuntur qui aperiam fugiat consectetur. Occaecati sit fugiat provident esse.", "fr": "Dolore beatae alias architecto rerum ducimus. Nam repudiandae aperiam quis minus repellendus libero. Sit dolorem quisquam quidem ex. A est sed et cumque qui."}', '{"en": "Impedit aut magni maxime autem. Labore assumenda similique expedita et ea excepturi libero. Sapiente sint non velit sunt dignissimos quas deleniti. Id deleniti perferendis sed iste sunt cumque.\\n\\nLaudantium aut eligendi molestias accusamus et voluptates. Quam dolorem hic ex tempora. Velit et molestiae iusto in eum. Aliquid excepturi velit quasi fuga suscipit delectus.\\n\\nAssumenda magnam quod est. Ut sed exercitationem consequatur alias nihil numquam minima. Rerum dolor alias maiores unde sapiente dolorum.\\n\\nIpsa maxime minus ut quae eum doloribus nihil. Ut dolor et illo temporibus non amet. Ea aspernatur mollitia necessitatibus porro necessitatibus est consequatur quod.\\n\\nDoloremque quaerat quis officiis itaque aspernatur. Consequatur odit suscipit debitis ut. Magnam blanditiis nesciunt non ut. Sit voluptatibus dolores qui.", "fr": "Reprehenderit alias ratione cumque quae neque aut. Qui voluptatem et non a non quos et natus. Deleniti omnis aspernatur libero esse aut accusantium. Ut quidem distinctio aspernatur autem expedita. Reprehenderit earum porro ut laboriosam mollitia non beatae.\\n\\nSuscipit exercitationem non necessitatibus. Ut sed vel explicabo vitae porro nostrum. Quia sit blanditiis consequatur ex.\\n\\nEst consequatur odio reprehenderit hic sunt. Atque sed deleniti at. Eos ipsam in doloribus repellat in fuga similique non. Quos eum harum consequatur nihil ut.\\n\\nModi autem magni quam consequatur eveniet fuga voluptas. Nesciunt aut maxime quo. Ut distinctio quae consequuntur.\\n\\nOdio impedit enim et odit. Vero excepturi at autem animi. Corrupti nostrum minus deleniti quasi qui deleniti. Est autem dicta atque rerum temporibus ut consequatur perspiciatis."}', '{"en": "Eveniet commodi exercitationem amet voluptas.", "fr": "Quas unde cumque perferendis illo molestias impedit dolores."}', NULL, NULL, 0, 1, '2026-05-14 13:42:40', '2026-05-14 13:42:40'),
	(8, 'sunt-quidem-quasi-dolorem', '{"en": "Sunt quidem quasi dolorem.", "fr": "Sunt quidem quasi dolorem."}', '{"en": "Delectus iusto at molestias et voluptatem. Doloribus nesciunt voluptatem fugit error. Aut dicta accusamus ut nihil velit voluptatum eum. Doloremque voluptate aut esse dolor magnam pariatur illum.", "fr": "Qui dolor aut expedita et et. Quo voluptates quia earum."}', '{"en": "Repellat ex sed earum quidem. Delectus cumque ut nihil tempore quibusdam sunt est. Odit officiis quia est veniam aut dolor. Ipsa cumque voluptates quis inventore exercitationem dolorum ut. Ad doloribus esse quasi molestiae.\\n\\nMaxime quas et doloribus amet in quia. Quis sint labore alias doloribus. Adipisci numquam soluta ut cupiditate vitae.\\n\\nEt nam eos distinctio aliquam itaque omnis quo. Modi sint provident ut illum modi alias pariatur. Dolor non non odit illo qui doloremque voluptas.\\n\\nNatus ex dolores quam. Est veniam exercitationem iste laboriosam earum fuga. Illum eius ea cumque deleniti.\\n\\nBlanditiis voluptatem harum id aliquam eum rerum accusamus saepe. Sit et deserunt cumque omnis. Sed possimus rerum eos sint amet. Consectetur sunt iure suscipit perferendis nihil aperiam dolor.", "fr": "Voluptatum atque id et inventore ut. Ipsam qui aliquid non placeat rerum officiis. Itaque repellat consequuntur optio placeat perspiciatis dolores velit.\\n\\nQuod vero et consequatur neque. Id alias repudiandae consectetur maiores nostrum. Blanditiis est reiciendis dolorem et nam nemo.\\n\\nAt debitis ab consequatur explicabo rerum non quaerat. Aut dolor nisi consequatur quia accusantium quia ratione. Reiciendis id perferendis rerum est rem.\\n\\nNulla quam recusandae cum molestiae quam qui. Facere quam autem omnis ut suscipit in. Voluptatum voluptate eos neque ex.\\n\\nPorro ut earum quia vel culpa. Qui est qui et odit. Tempore est ut qui. Eveniet odio magni aut quo culpa."}', '{"en": "Laboriosam non fuga nemo.", "fr": "Unde qui sed est odio ex."}', NULL, '2025-05-24 15:21:22', 0, 1, '2026-05-14 13:42:40', '2026-05-14 13:42:40'),
	(9, 'vitae-modi-culpa-ut', '{"en": "Vitae modi culpa ut.", "fr": "Vitae modi culpa ut."}', '{"en": "Amet aut maxime architecto excepturi omnis at. Rem porro corporis qui hic quod sequi et. Consequatur totam nulla quaerat sunt exercitationem autem. Est laudantium consectetur consequatur tempore et.", "fr": "Quasi consequatur perferendis sunt non nostrum magnam sit. Non dolor sequi nemo voluptatem cumque aut. Ex quis incidunt delectus non earum. Assumenda doloremque consectetur amet unde quia sequi rerum rerum."}', '{"en": "Quia veritatis aut et sit eaque qui. Rerum quod rerum omnis nobis. Similique reiciendis qui molestiae voluptas et. Ea omnis sapiente eos pariatur quasi.\\n\\nAutem est in voluptate. Quas enim nihil ratione beatae velit. Repellat fuga voluptatem voluptatem repellendus ratione ullam. Odio adipisci enim non sit animi.\\n\\nQui rerum qui tempore est eum nam. Et necessitatibus est quisquam rerum ipsam. Voluptates aut labore esse aliquam.\\n\\nSoluta illum eius inventore ut. Nihil sunt corporis quia hic nihil. Laborum non labore recusandae voluptatibus quas non accusantium.\\n\\nEt quos omnis culpa occaecati rerum dolorem. Non et ut aliquid et velit. Veritatis in a corrupti sed. Exercitationem ut exercitationem velit sunt eligendi rerum repellat et. Dolorum quos temporibus magni laudantium quis.", "fr": "Pariatur hic nostrum illo blanditiis quisquam minima quis. Perferendis nobis aut labore ab aut. Sequi tempore maiores aut nostrum reiciendis doloremque.\\n\\nQuia autem ullam repellat voluptatem consequatur ut facere. Quas voluptatem est animi repudiandae maxime blanditiis rerum. Dicta odio aut non cum. Debitis nulla in aut nihil.\\n\\nCorporis quisquam modi neque tempora dolorem consequuntur ut. Voluptas quae aut quasi consequatur sint. Aut rem eveniet soluta saepe voluptatem quaerat. Quibusdam placeat consequuntur pariatur enim.\\n\\nDoloribus maiores maxime corporis quos. Sed sed autem occaecati.\\n\\nItaque molestias consequatur ducimus. Itaque corporis deserunt alias itaque aut aut sapiente. Vel et tenetur in repudiandae ratione suscipit mollitia voluptatibus."}', '{"en": "Temporibus iusto id ut fuga magni est sint praesentium.", "fr": "Cumque dolor ut et magnam."}', NULL, '2026-02-25 02:25:27', 0, 1, '2026-05-14 13:42:40', '2026-05-14 13:42:40'),
	(10, 'molestiae-sit-autem-rem-minima-eum', '{"en": "Molestiae sit autem rem minima eum.", "fr": "Molestiae sit autem rem minima eum."}', '{"en": "Officiis nihil architecto fugit. Rerum impedit natus iste et labore quia deserunt. Voluptas in tempora quis amet.", "fr": "Quis nobis dignissimos voluptas commodi. Aut ut et cum temporibus pariatur quos molestiae. Dolorem et animi consequatur consequatur a. Ab vitae dignissimos omnis placeat. Expedita illum omnis vel corporis illo autem quo."}', '{"en": "Nesciunt facilis odio expedita modi at debitis voluptatem accusamus. Reiciendis a perferendis impedit rerum ipsam vel consequatur. Similique delectus iste quos dolores. Deserunt dolorem quia doloribus alias qui.\\n\\nPariatur quia ad soluta laboriosam. Mollitia soluta vel minima aliquid modi. Cupiditate eum rerum minus id corrupti quaerat.\\n\\nExplicabo tempore eos nemo facere quia debitis. Et neque delectus nobis iure rem corrupti accusantium. Vitae reprehenderit quam nulla est et maiores.\\n\\nMaxime sunt ut alias assumenda dolor alias omnis. Qui ut magni est id quidem exercitationem.\\n\\nSoluta sit ad in. Et minus accusantium fugit. Ut doloribus voluptatum nesciunt quaerat.", "fr": "Et occaecati esse et amet aliquam. Odit est repellat rem quasi inventore. Omnis rerum voluptatum tenetur possimus et quis qui mollitia.\\n\\nBlanditiis velit ipsa error. Consequuntur eos a ut deleniti. Odit exercitationem omnis rerum at deserunt molestiae sapiente.\\n\\nA velit odit numquam. Et perferendis eligendi nesciunt laudantium accusamus et nisi. Praesentium necessitatibus autem animi officia aut voluptas.\\n\\nIn vitae esse eum animi. Harum et sint rem recusandae rerum et dignissimos.\\n\\nIpsa possimus est animi voluptatem. Veritatis aut in consequatur assumenda perspiciatis. Dolorem soluta maiores aliquam dolor sed aut. Autem pariatur possimus dolores tenetur eum dignissimos et."}', '{"en": "Atque adipisci consequatur voluptas commodi ipsam.", "fr": "Eum minus maxime quisquam dolores."}', NULL, NULL, 0, 1, '2026-05-14 13:42:40', '2026-05-14 13:42:40');

-- --------------------------------------------------------
-- Structure et données : contacts
-- --------------------------------------------------------

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` json NOT NULL,
  `description` json DEFAULT NULL,
  `address` json DEFAULT NULL,
  `meta_description` json DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_embed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` smallint unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contacts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `contacts` (`id`, `slug`, `title`, `description`, `address`, `meta_description`, `email`, `phone`, `map_embed`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'contact', '{"en": "Contact us", "fr": "Contactez-nous"}', '{"en": "Do not hesitate to contact us for any questions or requests.", "fr": "N''hésitez pas à nous contacter pour toute question ou demande."}', '{"en": "Head office: 25 Avenue de l’Équateur, Gombe — MK Tower, 2nd floor, office 202. Presence: Lubumbashi, Goma, Bukavu.", "fr": "Siège social : 25, Avenue de l’Équateur, Commune de la Gombe — Immeuble MK Tower, 2e niveau, local 202. Présence : Lubumbashi, Goma, Bukavu."}', '{"en": "Contact Skyitupsas", "fr": "Contactez Skyitupsas"}', 'contact@skyitupsas.com', '(+243) 821 790 718', NULL, 0, 1, '2026-03-17 16:45:37', '2026-05-14 13:42:40');

-- --------------------------------------------------------
-- Structure et données : services
-- --------------------------------------------------------

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` json NOT NULL,
  `subtitle` json DEFAULT NULL,
  `description` json DEFAULT NULL,
  `content` json DEFAULT NULL,
  `meta_description` json DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` smallint unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `services` (`id`, `slug`, `title`, `subtitle`, `description`, `content`, `meta_description`, `icon`, `featured_image`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'service-consulting', '{"en": "Consulting Service", "fr": "Service Consulting"}', '{"en": ""}', '{"en": "SkyITup team possess more than 30 years of experience in the management, implementation of ERP projects , IT infrastructure projects  and support for large, medium and small companies as well as public and non-governmental institutions. We are willing to advise our customers in solving their problem.", "fr": "L''équipe des services Consulting de SkyITup saisit chaque opportunité avec une base approfondie dans la formation aux meilleures pratiques et les méthodologies. Notre approche axée sur l''objectivité et les résultats offre de véritables solutions de travail en matière de conseil en technologie digitale. De nombreuses industries ont des applications spécifiques à leur industrie et SkyITup est très compétent avec un grand nombre d''entre elles et si nous ne sommes pas familiers, nous collaborerons avec un expert en logiciels ou apprendrons la technologie afin de pouvoir aider à la soutenir."}', '{"en": {"content1": "SkyITup team possess more than 30 years of experience in the management, implementation of ERP projects , IT infrastructure projects  and support for large, medium and small companies as well as public and non-governmental institutions. We are willing to advise our customers in solving their problem."}, "fr": {"content1": "L''équipe des services Consulting de SkyITup saisit chaque opportunité avec une base approfondie dans la formation aux meilleures pratiques et les méthodologies. Notre approche axée sur l''objectivité et les résultats offre de véritables solutions de travail en matière de conseil en technologie digitale. De nombreuses industries ont des applications spécifiques à leur industrie et SkyITup est très compétent avec un grand nombre d''entre elles et si nous ne sommes pas familiers, nous collaborerons avec un expert en logiciels ou apprendrons la technologie afin de pouvoir aider à la soutenir."}}', '{"en": "SkyITup team possess more than 30 years of experience in the management, implementation of ERP projects , IT infrastructure projects  and support for large, medium and small companies as well as public and non-governmental institutions. We are willing to advise our customers in solving their problem.", "fr": "L''équipe des services Consulting de SkyITup saisit chaque opportunité avec une base approfondie dans la formation aux meilleures pratiques et les méthodologies. Notre approche axée sur l''objectivité et les résultats offre de véritables solutions de travail en matière de conseil en technologie digitale. De nombreuses industries ont des applications spécifiques à leur industrie et SkyITup est très compétent avec un grand nombre d''entre elles et si nous ne sommes pas familiers, nous collaborerons avec un expert en logiciels ou apprendrons la technologie afin de pouvoir aider à la soutenir."}', 'heroicon-o-cog-6-tooth', 'services/service-1.png', 1, 1, '2026-03-17 16:45:37', '2026-05-15 09:13:34'),
	(2, 'solutions-numeriques-logiciels', '{"en": "Digital Solutions and Software", "fr": "Solutions Numériques et Logiciels"}', '{"en": ""}', '{"en": "SkyITUp is staffed with highly qualified consultants. procuring the right software can benefit your business in several ways. Your business software selection is critical to your overall success. There are many smart solutions that can significantly increase the productivity and efficiency of your organization. this will allow you to make significant savings and therefore a sustainable added value to customers, shareholders and the socio-economic environment.", "fr": "SkyITUp est doté de consultants hautement qualifiés. Chacun sert de point de contact unique pour tous vos besoins logiciels. L''achat du bon logiciel peut bénéficier à votre entreprise de plusieurs façons. Votre sélection de logiciels d''entreprise est essentielle à votre succès global. Il existe de nombreux produits qui peuvent facilement réduire le temps nécessaire pour effectuer des tâches intimidantes, ce qui vous aidera à optimiser votre temps et économiser de l''argent ; et de le consacrer à des questions plus importantes."}', '{"en": {"content2_1": "SkyITUp is staffed with highly qualified consultants. procuring the right software can benefit your business in several ways. Your business software selection is critical to your overall success. There are many smart solutions that can significantly increase the productivity and efficiency of your organization. this will allow you to make significant savings and therefore a sustainable added value to customers, shareholders and the socio-economic environment.", "content2_2": "We not only offer the best prices available, but you will experience exceptional customer service.", "content2_3": {"text": "We have a varied portfolio which can be summarized as follows:", "item1": "Design, develop customized software solution that satisfy your business needs;", "item2": "Design, development of a website according to international standards;", "item3": "End to End Human Resources management software (full cycle from hiring to end of career including evaluations, staff development, promotion, payroll and other benefits management);", "item4": "OHADA financial and accounting software integrated with purchasing, invoicing, stock, electronic approvals etc.;", "item5": "Physical and electronic security software (electronic entry-exit management, surveillance camera;", "item6": "Archiving or electronic backup of documents."}}, "fr": {"content2_1": "SkyITUp est doté de consultants hautement qualifiés. Chacun sert de point de contact unique pour tous vos besoins logiciels. L''achat du bon logiciel peut bénéficier à votre entreprise de plusieurs façons. Votre sélection de logiciels d''entreprise est essentielle à votre succès global. Il existe de nombreux produits qui peuvent facilement réduire le temps nécessaire pour effectuer des tâches intimidantes, ce qui vous aidera à optimiser votre temps et économiser de l''argent ; et de le consacrer à des questions plus importantes.", "content2_2": "Nous offrons non seulement les meilleurs prix disponibles, mais vous ferez l''expérience d''un service à la clientèle exceptionnel.", "content2_3": {"text": "Nous avons un portefeuille varié se résumant comme suit :", "item1": "Conception, développement logiciel spécialisé sur mesures ;", "item2": "Conception, développement d''un site internet suivant les standards internationaux ;", "item3": "Logiciel de gestion des Ressources Humaines (cycle complet de l''embauche à la fin-carrière ; y compris les évaluations, développement du personnel, promotion, la paie et la gestion des autres avantages) ;", "item4": "Le logiciel financier et comptable OHADA intégré avec les achats, la facturation, le stock, approbations électroniques etc. ;", "item5": "Le logiciel de sécurité physique et électronique (gestion entrée sortie électronique, caméra de surveillance ;", "item6": "Archivage ou sauvegarde électroniques des documents."}}}', '{"en": "SkyITUp is staffed with highly qualified consultants. procuring the right software can benefit your business in several ways. Your business software selection is critical to your overall success. There are many smart solutions that can significantly increase the productivity and efficiency of your organization. this will allow you to make significant savings and therefore a sustainable added value to customers, shareholders and the socio-economic environment.", "fr": "SkyITUp est doté de consultants hautement qualifiés. Chacun sert de point de contact unique pour tous vos besoins logiciels. L''achat du bon logiciel peut bénéficier à votre entreprise de plusieurs façons. Votre sélection de logiciels d''entreprise est essentielle à votre succès global. Il existe de nombreux produits qui peuvent facilement réduire le temps nécessaire pour effectuer des tâches intimidantes, ce qui vous aidera à optimiser votre temps et économiser de l''argent ; et de le consacrer à des questions plus importantes."}', 'heroicon-o-cog-6-tooth', 'services/service-2.jpg', 3, 1, '2026-03-17 16:45:37', '2026-05-15 09:13:35'),
	(3, 'infrastructure-informatique', '{"en": "IT infrastructure", "fr": "Infrastructure informatique"}', '{"en": ""}', '{"en": "Our teams focus on offering you innovative services on materials and equipment including the non-exhaustive list below: Servers, Computers, Scanners, Photocopiers, Printers, Switch, Hub, Router, Wi-Fi Router, Data Centre, Wiring, Points Logic, Corrugated Sockets, Personal Inverters, Central Inverters, Internet of Things Ido or IoT, Video Surveillance Camera, VoIP - Business Telephony, Emergency Power Source (Solar Panels).", "fr": "Nos équipes se vocalisent pour vous offrir nos services innovants sur les matériels et équipements dont la liste non exhaustive ci-après : Serveurs, Les ordinateurs, Scanners, Photocopieurs, Imprimantes, Switch, Hub, Routeur, Routeur Wifi, Data Centre, Câblages, Points Logiques, Prises ondulées, Onduleurs personnels, Onduleurs Centraux, Internet des Objets Ido ou IoT, Caméra vidéo surveillance, VoIP - Téléphonie d''entreprise, Source d''énergie de secours (Panneaux solaires)."}', '{"en": {"content1": "Our teams focus on offering you innovative services on materials and equipment including the non-exhaustive list below: Servers, Computers, Scanners, Photocopiers, Printers, Switch, Hub, Router, Wi-Fi Router, Data Centre, Wiring, Points Logic, Corrugated Sockets, Personal Inverters, Central Inverters, Internet of Things Ido or IoT, Video Surveillance Camera, VoIP - Business Telephony, Emergency Power Source (Solar Panels).", "content2": "With regard to the computer network, our experts are ready to assist you and advise you on the choice of solutions according to the current standard. Below is a non-exhaustive list: Internet connection, Domain, number of email addresses, number of websites, Domain provider and subscription (Terms of payment and contract), Wi-Fi routers.", "content3": "Our experts follow the evolution of security solutions and are ready to assist you in updating and implementing computer security tools. Here is the non-exhaustive list: Firewall, Intranet access security, physical security (Access control, Video surveillance), etc.", "inner_title1": "Hardware", "inner_title2": "Network (computer networks)", "inner_title3": "Security"}, "fr": {"content1": "Nos équipes se vocalisent pour vous offrir nos services innovants sur les matériels et équipements dont la liste non exhaustive ci-après : Serveurs, Les ordinateurs, Scanners, Photocopieurs, Imprimantes, Switch, Hub, Routeur, Routeur Wifi, Data Centre, Câblages, Points Logiques, Prises ondulées, Onduleurs personnels, Onduleurs Centraux, Internet des Objets Ido ou IoT, Caméra vidéo surveillance, VoIP - Téléphonie d''entreprise, Source d''énergie de secours (Panneaux solaires).", "content2": "En ce qui concerne le réseau informatique, nos experts sont prêts à assister et conseiller sur le choix de solutions suivant le standard actuel. Ci-après la liste non exhaustive : Connection Internet, Domaine, nombre d''adresses mails, nombre de sites web, Fournisseur du domaine et abonnement (Conditions de paiement et contrat), Routeurs Wi-Fi.", "content3": "Ci-après la liste non exhaustive : Firewall, Sécurité d''accès intranet, sécurité physique (Contrôle d''accès, Vidéo surveillance), etc.", "inner_title1": "Sur le plan Matériel", "inner_title2": "Sur le plan de Networking (Réseaux informatique)", "inner_title3": "Sur le plan Sécurité"}}', '{"en": "Our teams focus on offering you innovative services on materials and equipment including the non-exhaustive list below: Servers, Computers, Scanners, Photocopiers, Printers, Switch, Hub, Router, Wi-Fi Router, Data Centre, Wiring, Points Logic, Corrugated Sockets, Personal Inverters, Central Inverters, Internet of Things Ido or IoT, Video Surveillance Camera, VoIP - Business Telephony, Emergency Power Source (Solar Panels).", "fr": "Nos équipes se vocalisent pour vous offrir nos services innovants sur les matériels et équipements dont la liste non exhaustive ci-après : Serveurs, Les ordinateurs, Scanners, Photocopieurs, Imprimantes, Switch, Hub, Routeur, Routeur Wifi, Data Centre, Câblages, Points Logiques, Prises ondulées, Onduleurs personnels, Onduleurs Centraux, Internet des Objets Ido ou IoT, Caméra vidéo surveillance, VoIP - Téléphonie d''entreprise, Source d''énergie de secours (Panneaux solaires)."}', 'heroicon-o-cog-6-tooth', 'services/service-3.jpg', 4, 1, '2026-03-17 16:45:37', '2026-05-15 09:13:35'),
	(4, 'formation-transformation-digitale', '{"en": "Digital Transformation Training", "fr": "Formation sur la Transformation Digitale"}', '{"en": ""}', '{"en": "Our training courses are based on your needs, and aim to raise the quality of your organization in digital transformation and infrastructure.", "fr": "Nos formations sont basées sur vos besoins ont pour objectif d''élever la qualité de vos ressources humaines dans la transformation digitale et infrastructures."}', '{"en": {"text": "Our training courses are based on your needs, and aim to raise the quality of your organization in digital transformation and infrastructure.", "item1": "Business management software", "item2": {"text": "Microsoft Office 365 with the following modules:", "inner_item1": "Introduction to digital (Internet, social networks, internet & telephone integration, online purchases and payment; video conference, etc.);", "inner_item2": "Microsoft Outlook (Electronic Messaging);", "inner_item3": "Microsoft Teams (collaborative tools);", "inner_item4": "Microsoft Word (Word processing);", "inner_item5": "Microsoft Excel (Spreadsheet);", "inner_item6": "Microsoft PowerPoint (Presentation & Graphics);", "inner_item7": "Microsoft Access (Database management);", "inner_item8": "Microsoft Project (Gestion de projets)."}, "item3": {"text": "IT security :", "inner_item1": "Computer security awareness;", "inner_item2": "Cybercriminality."}}, "fr": {"text": "Nos formations sont basées sur vos besoins ont pour objectif d''élever la qualité de vos ressources humaines dans la transformation digitale et infrastructures.", "item1": "Logiciel métiers de gestion", "item2": {"text": "Microsoft Office 365 avec les modules ci-après :", "inner_item1": "Initiation au numérique (Internet, réseaux sociaux, intégration internet & téléphone, Achats et paiement en ligne ; vidéo conférence, etc.) ;", "inner_item2": "Microsoft Outlook (Messagerie Électronique) ;", "inner_item3": "Microsoft Teams (Outils collaboratif) ;", "inner_item4": "Microsoft Word (Traitement de texte) ;", "inner_item5": "Microsoft Excel (Tableur) ;", "inner_item6": "Microsoft PowerPoint (Présentation & Graphisme) ;", "inner_item7": "Microsoft Access (Gestion base de données) ;", "inner_item8": "Microsoft Project (Project Management)."}, "item3": {"text": "Sécurité Informatique :", "inner_item1": "Sensibilisation à la sécurité informatique ;", "inner_item2": "Cybercriminalité."}}}', '{"en": "Our training courses are based on your needs, and aim to raise the quality of your organization in digital transformation and infrastructure.", "fr": "Nos formations sont basées sur vos besoins ont pour objectif d''élever la qualité de vos ressources humaines dans la transformation digitale et infrastructures."}', 'heroicon-o-cog-6-tooth', 'services/service-4.jpg', 5, 1, '2026-03-17 16:45:37', '2026-05-15 09:13:35'),
	(5, 'service-assistance', '{"en": "Assistance Service", "fr": "Service d''Assistance"}', '{"en": "We are here to help you", "fr": "Nous sommes là pour vous aider"}', '{"en": "SkyITup has more than 30 years of experience in managing and supporting computer networks for small and medium-sized businesses.", "fr": "SkyITup a plus de 30 ans d''expérience dans la gestion et le soutien des réseaux informatiques pour les petites et moyennes entreprises."}', '{"en": {"content5_1": "SkyITup has more than 30 years of experience in managing and supporting computer networks for small and medium-sized businesses.", "content5_2": "Our IT Support Services are staffed by certified IT professionals and are available to assist you by phone, email or through our secure web portal. SkyITup offers first class enterprise IT support service and remote network monitoring services.", "content5_3": "Our IT Support Services ensure that your critical IT systems and applications are always operational and that any technical issues are resolved quickly and accurately by knowledgeable and helpful technicians. Whether it''s printing issues, connectivity issues, viruses, device synchronization and more, the experts at SkyITup can help."}, "fr": {"content5_1": "SkyITup a plus de 30 ans d''expérience dans la gestion et le soutien des réseaux informatiques pour les petites et moyennes entreprises.", "content5_2": "Nos services d''assistance informatique sont composés de professionnels de l''informatique certifiés et sont disponibles pour vous aider par téléphone, par e-mail ou sur notre portail Web sécurisé. SkyITup offre un service de support informatique d''entreprise de première classe et des services de surveillance de réseau à distance.", "content5_3": "Nos services d''assistance informatique garantissent que vos systèmes et applications informatiques critiques sont toujours opérationnels et que tous les problèmes techniques sont résolus rapidement et avec précision par des techniciens compétents et serviables. Qu''il s''agisse de problèmes d''impression, de problèmes de connectivité, de virus, de synchronisation des périphériques et plus encore, les experts de SkyITup peuvent vous aider."}}', '{"en": "SkyITup has more than 30 years of experience in managing and supporting computer networks for small and medium-sized businesses.", "fr": "SkyITup a plus de 30 ans d''expérience dans la gestion et le soutien des réseaux informatiques pour les petites et moyennes entreprises."}', 'heroicon-o-cog-6-tooth', 'services/service-5.jpg', 6, 1, '2026-03-17 16:45:37', '2026-05-15 09:13:35'),
	(6, 'support-et-assistance', '{"en": "Support and Assistance", "fr": "Support et Assistance"}', '{"en": ""}', '{"en": "For all your digital transformation projects in the process of being implemented or already implemented, our teams are ready to provide you with the appropriate support and assistance on (1) validation of the configuration and maintenance of your system, (2) maintenance and the validation of basic data and its settings.<br>See below the list:", "fr": "Pour tous vos projets de transformation digitale encours d''implémentation ou déjà implémentés, nos équipes sont prêtes à vous apporter le support et assistance appropriés sur (1) la validation de la configuration et de la maintenance de votre système, (2) la maintenance et la validation des données de bases et ses paramétrages.<br>Il s''agit de :"}', '{"en": {"content1_1": "For all your digital transformation projects in the process of being implemented or already implemented, our teams are ready to provide you with the appropriate support and assistance on (1) validation of the configuration and maintenance of your system, (2) maintenance and the validation of basic data and its settings.<br>See below the list:", "content1_2": {"item1": "Configuration of fixed and variable parameters according to the legal requirement.", "item2": "Codification, formatting and updating of basic data after cleansing the files:", "item3": "Preparation of the accounting migration of the balances after the closing of all the modules (Purchases, Sales, Stock, etc.);", "item4": "Migration of general ledger and subledger (Customers; Suppliers, various debtors and creditors, staff, stock, etc.) and this, after all the work of framing balances of subledger accounts and general ledger accounts balances."}, "content1_3": "For any set up of an organization of a secure modern office with collaborative tools and mobility, our teams are ready to support you in installing the minimum IT infrastructure of your choice (on site or hosted) and office software for you, that felicitate a smooth start of digitalization."}, "fr": {"content1_1": "Pour tous vos projets de transformation digitale encours d''implémentation ou déjà implémentés, nos équipes sont prêtes à vous apporter le support et assistance appropriés sur (1) la validation de la configuration et de la maintenance de votre système, (2) la maintenance et la validation des données de bases et ses paramétrages.<br>Il s''agit de :", "content1_2": {"item1": "Configuration des paramètres fixes et variables conformément à la loi.", "item2": "Codification, formatage et mise à jour des données de base après toilettage des fichiers :", "item3": "Préparation de la migration comptable des soldes après les bouclages de tous les modules (Achats, Ventes, Stock, etc.) ;", "item4": "Migration des balances générales et des tiers (Clients ; Fournisseurs, débiteurs et créditeurs divers, personnel, stock, etc.) et ce, après tous les travaux de cadrage soldes des comptes auxiliaires et soldes des comptes généraux."}, "content1_3": "Pour toute création ou l’organisation du Bureau moderne sécurisé avec des outils collaboratifs et la mobilité, nos équipes sont prêtes à vous accompagner sur l’installation de l’infrastructures informatique minimum de votre choix (sur place ou hébergé) et logiciels bureautiques pour vous permettre le démarrage avec le numérique."}}', '{"en": "For all your digital transformation projects in the process of being implemented or already implemented, our teams are ready to provide you with the appropriate support and assistance on (1) validation of the configuration and maintenance of your system, (2) maintenance and the validation of basic data and its settings.<br>See below the list:", "fr": "Pour tous vos projets de transformation digitale encours d''implémentation ou déjà implémentés, nos équipes sont prêtes à vous apporter le support et assistance appropriés sur (1) la validation de la configuration et de la maintenance de votre système, (2) la maintenance et la validation des données de bases et ses paramétrages.<br>Il s''agit de :"}', 'heroicon-o-cog-6-tooth', 'welcomer.jpg', 2, 1, '2026-05-15 09:13:35', '2026-05-15 09:13:35');

-- --------------------------------------------------------
-- Structure et données : realisations
-- --------------------------------------------------------

DROP TABLE IF EXISTS `realisations`;
CREATE TABLE `realisations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` json NOT NULL,
  `description` json DEFAULT NULL,
  `content` json DEFAULT NULL,
  `meta_description` json DEFAULT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_date` date DEFAULT NULL,
  `project_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` smallint unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `realisations_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `realisations` (`id`, `slug`, `title`, `description`, `content`, `meta_description`, `featured_image`, `client`, `project_date`, `project_url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'sequi-deserunt-ipsam-possimus', '{"en": "sequi deserunt ipsam possimus", "fr": "sequi deserunt ipsam possimus"}', '{"en": "Temporibus perferendis qui ut ea fugit velit neque. Inventore aut eaque inventore voluptas suscipit neque quo. Velit praesentium tenetur et ex dolorem quam tempore.", "fr": "Quibusdam odit voluptate aut provident error. Quia eius earum voluptatem tempora minima ea. Laudantium dignissimos culpa facilis veritatis dolores quia quia."}', '{"en": "Provident eum consequatur recusandae nam officia aliquid ut. Nesciunt illum adipisci est commodi.\\n\\nVoluptates molestiae molestiae omnis. Quidem magni voluptatem provident magni occaecati. Nihil at ut animi a quas. Quia eligendi quisquam vitae amet.\\n\\nNon nobis ut vero nihil reprehenderit veritatis architecto. Sit veniam dolores iste tempore. Quidem natus vel nihil architecto id omnis.", "fr": "Quod ducimus fugit id vero ut neque vel. Voluptatem nesciunt velit natus qui autem dolorum. Ut voluptas officiis neque laboriosam error quasi aut. Minus unde totam qui est at doloribus.\\n\\nConsectetur sed quasi dolores commodi optio ipsam. Id illo harum autem architecto nobis harum. Omnis repudiandae praesentium odio et tempora officia.\\n\\nQuia voluptas voluptatibus vero ab ipsa quasi. Maiores quia rerum quam cum aut similique id. Nam neque dolor excepturi voluptate eaque sunt fuga. Quis blanditiis aperiam voluptatem animi cupiditate fugiat."}', '{"en": "Aliquam omnis dolor dicta natus culpa consequatur tempora.", "fr": "Voluptas excepturi reiciendis ab veniam occaecati animi et animi."}', NULL, 'Doyle Inc', '2024-09-02', 'http://www.ortiz.com/', 0, 1, '2026-03-17 16:45:37', '2026-03-17 16:45:37'),
	(2, 'magnam-aperiam-quam-omnis', '{"en": "magnam aperiam quam omnis", "fr": "magnam aperiam quam omnis"}', '{"en": "Molestiae officiis aut omnis. Deleniti quos labore et ut itaque neque eaque. Eaque eos labore vitae quia est. Vel suscipit quaerat velit. Saepe quia nostrum aut illum corporis.", "fr": "Quibusdam exercitationem inventore mollitia iusto dignissimos dolore velit. Amet ex laboriosam necessitatibus et adipisci fugiat. Quos qui quo ullam repudiandae doloribus sunt sit."}', '{"en": "Natus delectus omnis quo rerum alias. Accusantium non magnam quasi maiores inventore. Placeat sed occaecati eligendi omnis facilis sequi vitae. Et dolore porro est ipsum.\\n\\nNihil eaque voluptas et et. Qui harum ratione error ut laboriosam cupiditate vel praesentium. Error est enim et eum laboriosam hic.\\n\\nSapiente aperiam sit dicta ut omnis debitis fugiat. Inventore qui nesciunt quas qui. Consequuntur quia cum odio iste. Voluptatem sit ab nemo unde.", "fr": "Ut magni autem delectus explicabo. Iure quo laboriosam alias rerum. Quia fugit praesentium est suscipit provident beatae.\\n\\nUnde voluptatem vitae ut possimus dolores ex non. Et repellat tempora voluptatem libero accusantium consequatur aspernatur molestiae. Assumenda quo et nam quidem mollitia enim. Possimus laborum eveniet sunt pariatur nihil eum.\\n\\nAut consequatur est commodi ab accusantium. Aliquid minima quia vel in. Eaque veniam dolor quasi eaque qui cum. Quia voluptatibus rerum eos."}', '{"en": "In omnis dolore ullam commodi voluptatum quia.", "fr": "Perferendis molestiae qui aperiam odio."}', NULL, 'Reinger LLC', '2024-11-10', 'http://www.kemmer.org/porro-quasi-et-quo-consequuntur-quo-earum', 0, 1, '2026-03-17 16:45:37', '2026-03-17 16:45:37'),
	(3, 'inventore-qui-sapiente-nulla', '{"en": "inventore qui sapiente nulla", "fr": "inventore qui sapiente nulla"}', '{"en": "Qui nobis debitis nulla adipisci sequi repellat et. Rerum aut occaecati vel vel qui. Commodi odit dolorem et.", "fr": "Porro accusamus consequatur dolor vel similique. Voluptatibus officiis voluptatum sunt pariatur illo reprehenderit debitis. Molestiae aspernatur ullam at atque."}', '{"en": "Ut debitis eveniet doloribus voluptates itaque. Praesentium mollitia deleniti dolores. Ab eos sunt et nobis aut doloremque et. Ullam accusamus doloribus eos deserunt saepe autem.\\n\\nNumquam et dolor et. Neque eum atque quia repudiandae sunt ex perferendis. Qui nam veritatis soluta fuga facilis officia quo soluta. Ut libero natus neque eaque quia.\\n\\nIn id accusamus adipisci expedita. At nihil voluptatum eum magnam. Fugit suscipit odio voluptatem voluptas.", "fr": "Facilis consequatur enim quia iste voluptatum illo accusamus. Iste molestiae eos vitae quos. Explicabo earum aut totam eos hic voluptatem inventore.\\n\\nRatione nostrum at sit sit. Molestiae veritatis est repellat ea ut.\\n\\nBeatae illum id magnam eos neque. Placeat atque molestiae at molestiae repudiandae laudantium. Voluptas quae necessitatibus placeat illum ipsam qui cumque ratione."}', '{"en": "Nesciunt qui consequatur beatae eos blanditiis.", "fr": "Sit eos aspernatur dolorum inventore rerum."}', NULL, 'Howell-Dach', '2024-11-12', NULL, 0, 1, '2026-03-17 16:45:37', '2026-03-17 16:45:37'),
	(4, 'totam-vitae-consequuntur-iure', '{"en": "totam vitae consequuntur iure", "fr": "totam vitae consequuntur iure"}', '{"en": "Amet consequatur minus reprehenderit. Qui autem repellendus ut fugit. Sunt rerum velit aut voluptatum.", "fr": "Inventore quia beatae accusantium itaque voluptatibus. Laborum et modi veritatis alias. Necessitatibus voluptate eos eaque qui. Assumenda sed sint eum dolorum deserunt asperiores. Qui pariatur eum et iusto eos aut ut."}', '{"en": "Aut sunt non aperiam voluptas nihil. Consequatur quae maxime quia velit ad in. Et voluptatem nostrum vel magnam quis.\\n\\nMagnam illum omnis voluptas perferendis impedit ea. Facere quod dolor et vel vitae. Nobis occaecati ullam occaecati reprehenderit similique.\\n\\nEst dicta dolores facere nisi saepe expedita corrupti. Odit cum dolorem aspernatur dicta velit qui voluptas. Ut voluptas velit delectus itaque. Voluptatem animi et fugit.", "fr": "Mollitia omnis in fugiat. Velit impedit deleniti illo molestiae. Laudantium explicabo inventore quis. Sint et consectetur quo animi architecto quia qui.\\n\\nQuis ad dolores adipisci sed est veritatis necessitatibus. Perferendis porro aut dicta nam consequuntur aut et commodi. Ad nam molestias ex aliquam qui totam. Nam optio officiis id aut accusamus qui.\\n\\nCupiditate est cum soluta voluptatem sit est. Repudiandae pariatur blanditiis nihil. Voluptatum pariatur voluptas enim fuga corrupti porro. Aspernatur totam ut nihil."}', '{"en": "Voluptatem dolores tenetur eum minus.", "fr": "Velit molestias repudiandae nemo debitis architecto."}', NULL, 'Wolff, Stoltenberg and Pollich', '2026-01-31', 'http://www.cremin.info/', 0, 1, '2026-03-17 16:45:37', '2026-03-17 16:45:37'),
	(5, 'esse-ea-officia-culpa', '{"en": "esse ea officia culpa", "fr": "esse ea officia culpa"}', '{"en": "Eum accusantium quas quisquam omnis enim et in. Fuga dolor ut similique.", "fr": "Sed dolor aliquid dolorem iusto quod tenetur ea sunt. Doloremque saepe tempore et delectus doloremque ipsum. Atque rerum quam quia ducimus ut ut. Voluptatibus aspernatur enim nobis rerum praesentium sunt et molestiae."}', '{"en": "Voluptas sunt necessitatibus ut et suscipit totam rerum. Eos repellendus sunt quis sapiente rerum fugiat et dolorem. Quia ut autem corporis voluptatem. Qui vitae voluptatem nihil alias.\\n\\nUt quasi sit nesciunt perspiciatis fugit. Quasi omnis commodi eligendi sed quam. Mollitia porro ut qui dolor natus voluptatum.\\n\\nOfficia aut tenetur consequatur. Deserunt eius inventore odio dolorum deserunt praesentium mollitia. Et ut exercitationem quo consequatur.", "fr": "Temporibus dolor molestiae ipsam odio blanditiis. Aperiam ut autem et exercitationem est voluptas. Ex eum laudantium id suscipit deserunt.\\n\\nUt ut eos atque aut. Odio ipsa aperiam hic et ut aut. Quod sed et repellat voluptatem aut distinctio consequuntur. Id suscipit nesciunt laudantium commodi aliquam nisi iste accusamus.\\n\\nCommodi et enim molestias consequuntur dolor exercitationem ad. Asperiores ut rem reprehenderit excepturi eius. Suscipit nihil dolor qui sed optio. Officiis dolor excepturi aut corporis itaque nemo. Neque possimus voluptas eum beatae quisquam dignissimos eum ad."}', '{"en": "Numquam iusto ut maxime ea magnam aut aliquam.", "fr": "Occaecati laborum dolor a iste."}', NULL, 'Lowe, Fadel and Bednar', '2025-01-04', NULL, 0, 1, '2026-03-17 16:45:37', '2026-03-17 16:45:37'),
	(6, 'laudantium-inventore-ut-quam', '{"en": "laudantium inventore ut quam", "fr": "laudantium inventore ut quam"}', '{"en": "Ut sunt odio totam. Totam doloremque aliquam cum. Quo saepe officia aperiam sed voluptatum. Quisquam rerum voluptas itaque eos omnis saepe illum reiciendis.", "fr": "Animi labore facilis quia iusto velit non maxime. Enim quam voluptas quia quibusdam officiis."}', '{"en": "Ut ut quaerat est quisquam quae quos. Repellendus dolor cum eveniet voluptates. Aut commodi est mollitia eius eos.\\n\\nVel voluptate omnis molestias laudantium distinctio dolores tempora non. Aspernatur libero harum animi deserunt. Nulla dignissimos voluptatum fugiat et quis beatae sed.\\n\\nIllum sit eligendi facilis numquam modi quia. Molestias dolores doloremque voluptatibus molestiae. Ut placeat aliquam voluptatem voluptatem ut sunt omnis et.", "fr": "Dicta sed unde dicta accusantium deserunt dolores temporibus. Voluptatibus ullam asperiores neque. Incidunt non voluptatem totam velit eaque.\\n\\nNam iusto animi qui et qui. Quis iste corrupti sit quis eligendi quia. Ad officiis qui voluptatem.\\n\\nQuos esse quia officiis quae voluptatem incidunt. Sunt quo nam impedit earum. Ipsum quis quasi repudiandae iusto saepe molestias. Libero numquam corrupti quibusdam ipsam et impedit quia voluptas."}', '{"en": "Et aut saepe distinctio sed.", "fr": "Aut dicta accusantium odio."}', NULL, 'Veum LLC', '2025-12-15', 'http://www.fisher.net/explicabo-aut-esse-eum-quam-odit', 0, 1, '2026-03-17 16:45:37', '2026-03-17 16:45:37'),
	(9, 'infrastructure-reseau-securite', '{"en": "Infrastructure, networking & security", "fr": "Infrastructure, réseau & sécurité"}', '{"en": "Server room upgrades, network segmentation, and access protection patterns.", "fr": "Modernisation de salles serveurs, segmentation réseau et dispositifs de protection des accès."}', '{"en": "<p>Server room upgrades, network segmentation, and access protection patterns.</p>", "fr": "<p>Modernisation de salles serveurs, segmentation réseau et dispositifs de protection des accès.</p>"}', '{"en": "Server room upgrades, network segmentation, and access protection patterns.", "fr": "Modernisation de salles serveurs, segmentation réseau et dispositifs de protection des accès."}', 'realizations/realization-03.jpeg', 'Organisations multisites', '2025-11-01', NULL, 3, 1, '2026-05-14 13:42:40', '2026-05-14 13:42:40'),
	(11, 'conseil-congolais-de-la-batterie', '{"en": "Congolese Battery Council", "fr": "Conseil Congolais de la batterie"}', '{"en": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.", "fr": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor."}', '{"en": "<p>Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.</p>", "fr": "<p>Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.</p>"}', '{"en": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.", "fr": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor."}', 'realizations/realization-01.png', 'Conseil Congolais de la batterie', '2025-11-01', NULL, 1, 1, '2026-05-14 18:54:10', '2026-05-14 18:54:10'),
	(12, 'fond-de-promotion-culturelle', '{"en": "Cultural promotion fund", "fr": "Fond de promotion culturelle"}', '{"en": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.", "fr": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor."}', '{"en": "<p>Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.</p>", "fr": "<p>Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.</p>"}', '{"en": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.", "fr": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor."}', 'realizations/realization-02.png', 'Fond de promotion culturelle', '2025-11-01', NULL, 2, 1, '2026-05-14 18:54:10', '2026-05-14 18:54:10'),
	(13, 'mdfils-sarl', '{"en": "Mdfils SARL", "fr": "Mdfils SARL"}', '{"en": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.", "fr": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor."}', '{"en": "<p>Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.</p>", "fr": "<p>Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.</p>"}', '{"en": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.", "fr": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor."}', 'realizations/realization-03.jpeg', 'Mdfils SARL', '2025-11-01', NULL, 3, 1, '2026-05-14 18:54:10', '2026-05-14 18:54:10'),
	(14, 'sca-inter-a-sante-rdc', '{"en": "SCA INTER A Santé — DRC", "fr": "SCA INTER A Santé — RDC"}', '{"en": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.", "fr": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor."}', '{"en": "<p>Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.</p>", "fr": "<p>Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.</p>"}', '{"en": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.", "fr": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor."}', 'realizations/realization-04.jpg', 'SCA INTER A Santé', '2025-11-01', NULL, 4, 1, '2026-05-14 18:54:10', '2026-05-14 18:54:10'),
	(15, 'caisse-nationale-de-securite-sociale', '{"en": "National Social Security Fund", "fr": "Caisse Nationale de Sécurité Sociale"}', '{"en": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.", "fr": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor."}', '{"en": "<p>Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.</p>", "fr": "<p>Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.</p>"}', '{"en": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor.", "fr": "Duis ac tellus et risus vulputate vehicula donec lobortis risus a elit. Etiam tempor."}', 'realizations/realization-01.png', 'CNSS', '2025-11-01', NULL, 5, 1, '2026-05-14 18:54:10', '2026-05-14 18:54:10');

-- --------------------------------------------------------
-- Structure et données : team_members
-- --------------------------------------------------------

DROP TABLE IF EXISTS `team_members`;
CREATE TABLE `team_members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` json NOT NULL,
  `role` json NOT NULL,
  `bio` json DEFAULT NULL,
  `assets` json DEFAULT NULL,
  `experience` json DEFAULT NULL,
  `diplomas` json DEFAULT NULL,
  `expertises` json DEFAULT NULL,
  `work_countries` json DEFAULT NULL,
  `sort_order` smallint unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `team_members_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `team_members` (`id`, `slug`, `picture`, `facebook`, `twitter`, `instagram`, `linkedin`, `name`, `role`, `bio`, `assets`, `experience`, `diplomas`, `expertises`, `work_countries`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'alphonse-willy-ngana', 'assets/img/team/member-1.jpg', NULL, NULL, NULL, 'https://www.linkedin.com/in/a-willy-ngana-mabiala-6b54267', '{"en": "Alphonse-Willy Ngana", "fr": "Alphonse-Willy Ngana"}', '{"en": "Co-founder & Chief Executive officier", "fr": "Cofondateur & Directeur General"}', '{"en": ""}', '{"en": [{"asset1": "Managing Director & Co-Founder, Kinshasa & Amsterdam", "asset2": "Entrepreneur, founders and directors of companies, with strong leadership and a track record in the turnaround and transformation of companies with a view to sustainable growth and profitability, particularly in companies in the agri-food, manufacturing and financial services. His leadership in public relations strategy, private and government advocacy has accelerated business performance. Advocating with insistence, particularly on strategy, growth, sustainability and governance, public policy, economic development and Board effectiveness of both organizations and individuals is his passion.", "asset3": "", "asset4": {"content1": "", "content2": "", "content3": "", "content4": "", "list_item_1": "", "list_item_2": "", "list_item_3": "", "list_item_4": "", "list_item_5": "", "list_item_6": ""}}, {"asset1": "Willy NGANA has 19 years of rich experience in international management, especially in Africa and the Middle East, but also in Western Europe. He also has solid experience in general management, financial management, internal audit, risk management and extensive experience in the Board of Directors of both private and public companies and in non-governmental organizations.", "asset2": "Alphonse Willy has extensive experience and understanding of the economic and social challenges and dynamics of countries, of tax policies and economic development programs, particularly in sub-Saharan Africa. He is resilient and passionate about bringing and transforming any organization he is in, Alphonse Willy has demonstrated strong leadership ability in business turnaround, launch as well as IPO, management of crisis and environmental, social and governance. He is currently Chairman of the Board of Directors of FBN Banque RDC.", "asset3": "", "asset4": {"content1": "", "content2": "", "content3": "", "content4": "", "list_item_1": "", "list_item_2": "", "list_item_3": "", "list_item_4": "", "list_item_5": "", "list_item_6": ""}}], "fr": [{"asset1": "Administrateur Directeur Général & Co-Fondateur, Kinshasa & Amsterdam", "asset2": "Entrepreneur, fondateurs et administrateurs de sociétés, ayant un leadership fort et un track record dans le redressement et la transformation des entreprises en vue d''une croissance durable et une profitabilité en particulier dans les entreprises des secteurs d''agro-alimentaires, de manufacture et services financiers. Son leadership dans la stratégie de relations publiques, la défense des intérêts privés et gouvernementaux ont permis d''accélérer les performances des entreprises. Assurer le plaidoyer avec insistance, en particulier sur la stratégie, la croissance, la durabilité et la gouvernance, les politiques publiques, le développement économique et l''efficacité du Conseil d''Administration tant d''organisations que des personnes est sa passion.", "asset3": "", "asset4": {"content1": "", "content2": "", "content3": "", "content4": "", "list_item_1": "", "list_item_2": "", "list_item_3": "", "list_item_4": "", "list_item_5": "", "list_item_6": ""}}, {"asset1": "Willy NGANA a, à son actif, 19 années d''une expérience riche dans le management à l''international, spécialement en Afrique et moyen orient, mais aussi en Europe Occidentale. Il possède également une solide expérience dans la direction générale, la direction financière, d''audit interne, gestion de risque et, une grande expérience dans le Conseil d''Administration à la fois d''entreprises privées et publiques et dans les organisations non gouvernementales.", "asset2": "Alphonse Willy est doté d''une expérience et d''une compréhension approfondie sur les enjeux et dynamique économique et social des pays, sur les politiques fiscales et de programme de développement économique particulièrement en Afrique subsaharienne. Il est résiliant et passionné d''apporter et de transformer toute organisation dans laquelle il est, Alphonse Willy a fait preuve d''une forte capacité de leadership dans le redressement d''entreprise, le lancement tout comme l''introduction en bourse, la gestion de crise et environnementale, sociale et la gouvernance. Il est actuellement Président du Conseil d''Administration de FBN Banque RDC.", "asset3": "", "asset4": {"content1": "", "content2": "", "content3": "", "content4": "", "list_item_1": "", "list_item_2": "", "list_item_3": "", "list_item_4": "", "list_item_5": "", "list_item_6": ""}}]}', '{"en": [{"role": "Director of business project development for the Africa and Middle East zone, Amsterdam, Holland", "tasks": null, "company": "Heinekein International Group"}, {"role": "Managing Director/Country Director, Freetown, Sierra Leone", "tasks": null, "company": "Sierra Leone Brewery LTD"}, {"role": "Chief Financial Officer, Kigali, Rwanda", "tasks": null, "company": "Bralirwa SA"}, {"role": "Establishment of the Rwanda Stock Exchange through the initial public offering (IPO) of the Bralirwa in Kigali, Rwanda", "tasks": null, "company": "Rwanda Stock Exchange"}, {"role": "Independent Director, Freetown Sierra Leone", "tasks": null, "company": "Millenium Challenge Corporation USA (Sierra Leone Unit)"}, {"role": "Board Member, Freetown Sierra Leone", "tasks": null, "company": "Chambre de Commerce de Sierra Leone"}], "fr": [{"role": "Directeur du développement de projets d''affaires pour la zone Afrique et moyen orient, Amsterdam, Hollande", "tasks": null, "company": "Heinekein International Group"}, {"role": "Administrateur Directeur Général/Directeur pays, Freetown, Sierra Leone", "tasks": null, "company": "Sierra Leone Brewery LTD"}, {"role": "Directeur Financier, Kigali, Rwanda", "tasks": null, "company": "Bralirwa SA"}, {"role": "Création de la Bourse du Rwanda par l''introduction en bourse (IPO) de la Bralirwa à Kigali, Rwanda", "tasks": null, "company": "Bourse du Rwanda"}, {"role": "Administrateur indépendant, Freetown Sierra Leone", "tasks": null, "company": "Millenium Challenge Corporation USA (Sierra Leone Unit)"}, {"role": "Membre du Conseil, Freetown Sierra Leone", "tasks": null, "company": "Chambre de Commerce de Sierra Leone"}]}', '{"en": [{"diploma": "Master in Economics, Higher Institute of Commerce, Kinshasa, DRC"}, {"diploma": "INSEAD France, Leadership IMAC ans General Manager Training"}, {"diploma": "Harvard Business School USA, Leadership"}, {"diploma": "IMD Lausanne Switzerland, High Effective Board of Director"}], "fr": [{"diploma": "Master en Economie, Institut Supérieur de Commerce, Kinshasa, RDC"}, {"diploma": "INSEAD France, Leadership IMAC et General Manager Training"}, {"diploma": "Harvard Business School USA, Leadership"}, {"diploma": "IMD Lausanne Switzerland, High Effective Board of Director"}]}', '{"en": [{"expertise": "Chief Executive Officer and Chief Financial Officer"}, {"expertise": "Board of Directors"}, {"expertise": "Strategy, Turnaround, Transformation, Organizational change, Innovation and products"}, {"expertise": "Risk management, internal audit & internal control"}, {"expertise": "Public Relations: Public Affairs and lobbying"}, {"expertise": "Bank"}, {"expertise": "Non-Governmental Organization"}, {"expertise": "Social Environment & Governance"}, {"expertise": "Crisis Management and Business Continuity"}], "fr": [{"expertise": "Directeur Général et Directeur Financier"}, {"expertise": "Conseil d''Administration"}, {"expertise": "Stratégie, Redressement, Transformation, Changement d''organisation,  Innovation et produits"}, {"expertise": "Gestion de risque, Audit interne & contrôle internes"}, {"expertise": "Relations Publiques : Public Affairs & lobbying"}, {"expertise": "Banque"}, {"expertise": "Organisation Non Gouvernementale"}, {"expertise": "Environnement Social & Gouvernance"}, {"expertise": "Gestion de Crise et Continuité des Affaires"}]}', '{"en": [{"region": "Europe", "countries": "Holland, France, Spain, Ireland, Italy"}, {"region": "Africa & Middle East", "countries": "DRC, Egypt, Tunisia, Algeria, Ivory Coast, Sierra Leone, Nigeria, Ethiopia, Rwanda, Burundi, Angola, Namibia, Republic of South Africa, Lebanon, Saudi Arabia"}, {"region": "Asia", "countries": "New Caledonia"}, {"region": "West Indies", "countries": "Guadeloupe and Martinique"}], "fr": [{"region": "Europe", "countries": "Hollande, France, Espagne, Irlande, Italie"}, {"region": "Afrique & Moyen orient", "countries": "RDC, Egypte, Tunisie, Algérie, Côte d''Ivoire, Sierra Leone, Nigéria, Ethiopie, Rwanda, Burundi, Angola, Namibie, République d''Afrique du Sud, Liban, Arabie Saoudite"}, {"region": "Asie", "countries": "Nouvelle Calédonie"}, {"region": "Antilles", "countries": "Guadeloupe et Martinique"}]}', 1, 1, '2026-03-17 16:45:37', '2026-05-14 18:54:08'),
	(2, 'rene-kungana-kola', 'assets/img/team/member-2.jpg', 'https://www.facebook.com/rene.k.kola?mibextid=LQQJ4d', 'https://twitter.com/KunganaKolaRene', NULL, 'https://www.linkedin.com/in/rene-kungana-kola-28682097', '{"en": "René Kungana Kola", "fr": "René Kungana Kola"}', '{"en": "Transformation Digital Director", "fr": "Directeur de Transformation Digitale"}', '{"en": ""}', '{"en": [{"asset1": "KUNGANA KOLA René has more than 30 years of experience in digital transformation at Heineken International, mainly in managing the implementation of management information system projects (ERP – Enterprise Resource Planning or Integrated Management Software) and business development in Africa. He is fluent in French and English and has lived and worked in many African countries, such as DR Congo, Nigeria, Ethiopia, Sierra Leone, Rwanda, Burundi, Ivory Cost and Tchad.", "asset2": "In his career, he has a strong experience in the implementation of software packages (1) SAP- Human Resource Success factor, (2) SAGE – Payroll & Personnel Management, (3) Microsoft Dynamics Navision: Purchase, Sale, Stock, Manufacturing and quality control, Equipment management, Accounting & Finance. (4) Odoo Enterprise: Purchase, Sale, Stock, Production, Equipment Management, Accounting & Finance, Personnel Management, etc.", "asset3": "Among other things, he has held the position of (1) SAP MyHR and SAGE Payroll consultant from 2019 to 2021 (2) the position of Senior IT Project Manager since March 2017. Prior to this position, he was Finance and Development Project Manager at Heineken Sierra Leone Brewery in 2016, he successfully led the improvement of management, Methods and Procedures and the implementation of Microsoft Dynamics Navision 2013 and their reporting tools within this company. He assisted and trained employees in the implementation of IT operations and in the organization of Finance.", "asset4": {"content1": "Prior to the above role, he was a member of the Heineken Change Team, where he played a key role during the implementation and implementation, and training on Microsoft Dynamics Navision in Heineken in Sub-Saharan Africa. (6 countries):", "content2": "Previously, he was a functional and technical consultant at Heineken CHAD, he successfully led the implementation of the Heineken Africa (ISHA) information system, and also Heineken Standard Accounting System (SCAN – SCOA) in CHAD and in SIERRA LEONE.", "content3": "Before joining Heineken in 1988, he was assistant supply project manager at the National Transport Office (ONATRA) in the DR Congo, where he was in charge of the Organization, Methods and Procedures, accounting and price calculation of come back.", "content4": "He was also the Head of Workforce Planning in Human Resources – at the National Office of Posts and Telecommunications of Zaire (ONPTZ) in DR Congo.", "list_item_1": "Heineken BRARUDI in BURUNDI 2 breweries ;", "list_item_2": "Heineken BRALIRWA in RWANDA 2 breweries;", "list_item_3": "Heineken BRALIMA in DR Congo 6 breweries and 1 bottling plant;", "list_item_4": "Heineken SIERRA LEONE brewery in Sierra Leone 1 brewery;", "list_item_5": "Heineken Consolidated Breweries Ltd in NIGERIA 6 breweries ;", "list_item_6": "Heineken Share Companies in Ethiopia 3 breweries and several distribution centers."}}], "fr": [{"asset1": "KUNGANA KOLA René possède plus de 30 ans d''expérience dans la transformation digitale dans la société Heineken International, principalement dans le pilotage d''implémentation des projets des systèmes d''information de gestion (ERP – Entreprise Resource Planning ou Progiciel de gestion intégré) et le développement du Business en Afrique. Il parle couramment le Français et l''Anglais et, il a vécu et travaillé dans des nombreux pays d''Afrique, tels que le RD Congo, Nigeria, l''Éthiopie, la Sierra Leone, le Rwanda, le Burundi, la Côte d''Ivoire et le Tchad.", "asset2": "Dans sa carrière, il a une forte expérience dans l''implémentation des progiciels (1) SAP- Human Resource Success factor, (2) SAGE – Paie & Gestion du personnel, (3) Microsoft Dynamics Navision : Achat, Vente, Stock, Fabrication et contrôle qualité, Gestion des équipements, Comptabilité & Finance. (4) Odoo Entreprise : Achat, Vente, Stock, Production, Gestion des équipements, Comptabilité & Finance, Gestion du personnel, etc.", "asset3": "Il a exercé entre autres (1) la fonction de consultant SAP MyHR et SAGE Paie de 2019 à 2021 (2) le poste de Senior IT Project Manager depuis mars 2017. Avant ce poste il a été Chef de Project Finance et Développement à Heineken Sierra Leone Brewery en 2016, il a conduit avec succès l''amélioration de la gestion, les Méthodes et Procédures et l''implémentation Microsoft Dynamics Navision 2013 et leurs outils de reporting au sein de cette l''entreprise. Il a assisté et formé les employés dans la mise en œuvre de l''exploitation l''informatique et dans l''organisation des Finances.", "asset4": {"content1": "Avant le rôle ci-dessus, il était membre de l''équipe de Heineken change Team, où il a joué un rôle clé durant l''implémentation et la mise en œuvre, et la formation sur Microsoft Dynamics Navision dans Heineken en Afrique sub-saharienne (6 pays) :", "content2": "Auparavant, il a été consultant fonctionnel et technique chez Heineken TCHAD, il a conduit avec succès l''implémentation système d''information Heineken Africa (ISHA), et aussi Heineken Standard Accounting System (SCAN – SCOA) au TCHAD et en SIERRA LEONE.", "content3": "Avant de rejoindre Heineken en 1988, il a été assistant chef de projet Approvisionnement à l''Office National des transports (ONATRA) en RD Congo, où il a eu la charge de l''Organisation, les Méthodes et Procédures, comptabilité et Calcul prix de revient.", "content4": "Il a été également le responsable du planning des effectifs aux Ressources humaine– à l''Office National des Postes et Télécommunication du Zaïre (ONPTZ) en RD Congo.", "list_item_1": "Heineken BRARUDI au BURUNDI 2 brasseries ;", "list_item_2": "Heineken BRALIRWA au RWANDA 2 brasseries ;", "list_item_3": "Heineken BRALIMA en RD Congo 6 brasseries et 1 usine d''embouteillage ;", "list_item_4": "Brasserie Heineken SIERRA LEONE en Sierra Leone 1 brasserie ;", "list_item_5": "Heineken Consolidated Breweries Ltd au NIGERIA 6 brasseries ;", "list_item_6": "Heineken Share Compagnies en Éthiopie 3 brasseries et plusieurs centres de distributions."}}]}', '{"en": [{"role": "Senior IT Project Manager BRALIMA SA & BOUKIN SA", "tasks": [{"task": "Management of complex and multidisciplinary IT projects"}, {"task": "IT Strategy Advisor"}, {"task": "IT Organization Advisor for Bralima and Boukin"}, {"task": "IT Technology Advisor"}, {"task": "IT Service Management Advisor"}, {"task": "IT support"}, {"task": "Computer trainer"}], "company": "BRALIMA SA & BOUKIN SA"}, {"role": "MS Dynamics Navision Project Manager and Finance Development Manager at Heineken Sierra Leone", "tasks": [{"task": "Improving Methods and Procedures according to Heineken"}, {"task": "Implementation of internal control and Reconciliation of accounts"}, {"task": "Implementation, support, user training on monitoring and cost control"}, {"task": "Overcome the shortcomings of local staff"}, {"task": "Improve TOPS (Technical Organization Process and Security) reporting"}, {"task": "Reinforce Heineken access control (ACM Access Control Monitoring)"}], "company": "Sierra Leone Brewery Ltd"}, {"role": "Change Team Lead ERP Microsoft Dynamics Navision in Africa 6 countries (RWANDA, BURUNDI, DR CONGO, SIERRA LEONE, NIGERIA, Ethiopia and Ivory Coast)", "tasks": [{"task": "Guide OpCos in the development of Methods and Procedures"}, {"task": "Assist and train Opco''s users in the collection and organization of Master Data (Corporate Basic Data) according to the Heineken standard"}, {"task": "Assist and train Opco''s users in the collection and organization of fixed and variable parameters"}, {"task": "Implementation & Deployment of the Heineken Heilite Microsoft Dynamics Navision Application ERP (Support, Assistance, Training and resolution of technical and accounting problems of the software package)"}], "company": "BRALIRWA (RWANDA), BRARUDI (BURUNDI), BRALIMA & BOUKIN (RD CONGO), SIERRA LEONE BREWERY Ltd (SIERRA LEONE), CONSOLIDATED BREWERIES Ltd (NIGERIA), HEINEKEN SHARES COMPANY (ETHIOPIA) and BRASIVOIRE (IVOIRY COAST)"}, {"role": "Assistant project manager for the organization and IT processing of the application of supplies & cost price at the CTI ONATRA", "tasks": null, "company": "Office National des Transport of the DR Congo (ONATRA)"}, {"role": "Head of workforce planning for human resources ONPTZ", "tasks": null, "company": "Office National des Postes et Télécommunication du Zaïre (ONPTZ)"}], "fr": [{"role": "Senior IT Project Manager BRALIMA SA & BOUKIN SA", "tasks": [{"task": "Gestion de Projets Informatiques complexes et multidisciplinaires"}, {"task": "Conseiller en Stratégie Informatique"}, {"task": "Conseiller en Organisation Informatique de Bralima et Boukin"}, {"task": "Conseiller en Technologie Informatique"}, {"task": "Conseiller en Gestion de Services Informatiques"}, {"task": "Support en Informatique"}, {"task": "Formateur en Informatique"}], "company": "BRALIMA SA & BOUKIN SA"}, {"role": "Chef de projet MS Dynamics Navision et Finance Development Manager à Heineken Sierra Leone", "tasks": [{"task": "Améliorer les Méthodes et procédures selon Heineken"}, {"task": "Implémentation du contrôle interne et Réconciliation des comptes"}, {"task": "Implémentation, support, formation des utilisateurs sur le suivi et maitrise des coûts"}, {"task": "Combler les insuffisances du personnel local"}, {"task": "Améliorer le reporting TOPS (Technical Organisation Processus and Security)"}, {"task": "Renforcer le contrôle d''accès Heineken (ACM Access Control Monitoring)"}], "company": "Sierra Leone Brewery Ltd"}, {"role": "Change Team Lead ERP Microsoft Dynamics Navision en Afrique 6 pays (RWANDA, BURUNDI, RD CONGO, SIERRA LEONE, NIGERIA, Éthiopie et Côte d''Ivoire)", "tasks": [{"task": "Orienter les OpCo''s dans l''élaboration des Méthodes et Procédures"}, {"task": "Assister et former les utilisateurs des Opco''s dans la collecte et l''Organisation des Master Data (Données de base de l''entreprise) suivant le standard Heineken"}, {"task": "Assister et former les utilisateurs des Opco''s dans la collecte et l''Organisation des paramètres fixes et variables"}, {"task": "Mise en œuvre & Déploiement de l''ERP d''Application Heineken Heilite Microsoft Dynamics Navision (Support, Assistance, Formation et résolution des problèmes techniques et Comptables du progiciel)"}], "company": "BRALIRWA (RWANDA), BRARUDI (BURUNDI), BRALIMA & BOUKIN (RD CONGO), SIERRA LEONE BREWERY Ltd (SIERRA LEONE), CONSOLIDED BREWERIES Ltd (NIGERIA), HEINEKEN SHARES COMPANY (ETHIOPIE) et BRASIVOIRE (COTE D''IVOIRE)"}, {"role": "Chef de projet assistant de l''organisation et traitement Informatique de l''application des approvisionnements & Prix de revient au CTI ONATRA", "tasks": null, "company": "Office National des Transport de la RD Congo (ONATRA)"}, {"role": "Responsable du planning des effectifs aux ressources humaines ONPTZ", "tasks": null, "company": "Office National des Postes et Télécommunication du Zaïre (ONPTZ)"}]}', '{"en": [{"diploma": "Graduated in Computer Design and Organization at the Higher Institute of Statistics of Kinshasa Democratic Republic of Congo"}], "fr": [{"diploma": "Gradué en Conception et Organisation Informatique à l''Institut Supérieur des Statistiques de Kinshasa République Démocratique du Congo"}]}', '{"en": [{"expertise": "Project management ;"}, {"expertise": "Human Resources Management & Payroll Calculation;"}, {"expertise": "Improving business processes;"}, {"expertise": "Methods and procedure;"}, {"expertise": "Internal control ;"}, {"expertise": "Solving accounting problems of ERP or integrated management software packages;"}, {"expertise": "Development of custom applications for web, mobile, etc. ;"}, {"expertise": "Development of tailor-made business applications ERP or integrated management software packages;"}, {"expertise": "ERP implementation or integrated management software (MS Dynamics Nav, SAP, SAGE, Odoo);"}, {"expertise": "Accounting migration (closing balance to opening balance);"}, {"expertise": "Codification of the company''s basic data before migration into the database;"}, {"expertise": "Migration (import) of company master data."}], "fr": [{"expertise": "Gestion des projets ;"}, {"expertise": "Gestion des Ressources Humaines & Calcul de la paie ;"}, {"expertise": "Amélioration des processus métier ;"}, {"expertise": "Méthodes et procédure ;"}, {"expertise": "Contrôle Interne ;"}, {"expertise": "Résolution des problèmes comptables des ERP ou progiciels de gestion intégrés ;"}, {"expertise": "Développement des applications sur mesure Web, mobile, etc. ;"}, {"expertise": "Développement des applications métiers sur mesure ERP ou progiciels de gestion intégrés ;"}, {"expertise": "Implémentation ERP ou progiciels de gestion intégrés (MS Dynamics Nav, SAP, SAGE, Odoo) ;"}, {"expertise": "Migration Comptable (Balance de clôture vers la balance d''ouverture) ;"}, {"expertise": "Codification des données de base de l''entreprise avant migration dans la base de données ;"}, {"expertise": "Migration (importation) des données de base de l''entreprise."}]}', '{"en": [{"region": "Africa", "countries": "DR Congo, Nigeria, Chad, Burundi, Rwanda, Sierra-Leone, Ethiopia, Ivory Coast"}], "fr": [{"region": "Afrique", "countries": "RD Congo, Nigéria, Tchad, Burundi, Rwanda, Sierra-Leone, Ethiopie, Côte d''ivoire"}]}', 2, 1, '2026-03-17 16:45:37', '2026-05-14 18:54:09'),
	(3, 'luminuku-kiasingama-emile', 'assets/img/team/member-4.jpg', NULL, NULL, NULL, NULL, '{"en": "Luminuku Kiasingama Emile", "fr": "Luminuku Kiasingama Emile"}', '{"en": "Directeur Régional Grand Katanga", "fr": "Directeur Régional Grand Katanga"}', '{"en": ""}', '{"en": [{"asset1": "Luminuku Kiasingama Emile,", "asset2": "", "asset3": "", "asset4": {"content1": "", "content2": "", "content3": "", "content4": "", "list_item_1": "", "list_item_2": "", "list_item_3": "", "list_item_4": "", "list_item_5": "", "list_item_6": ""}}], "fr": [{"asset1": "Luminuku Kiasingama Emile,", "asset2": "", "asset3": "", "asset4": {"content1": "", "content2": "", "content3": "", "content4": "", "list_item_1": "", "list_item_2": "", "list_item_3": "", "list_item_4": "", "list_item_5": "", "list_item_6": ""}}]}', '{"en": [{"role": "", "tasks": null, "company": ""}, {"role": "", "tasks": null, "company": ""}], "fr": [{"role": "", "tasks": null, "company": ""}, {"role": "", "tasks": null, "company": ""}]}', '{"en": [], "fr": []}', '{"en": [], "fr": []}', '{"en": [], "fr": []}', 3, 1, '2026-03-17 16:45:37', '2026-05-14 18:54:09'),
	(4, 'sarah-kalala', 'assets/img/team/member-3.jpg', NULL, NULL, 'https://instagram.com/sara.kalala.14?igshid=NTc4MTIwNjQ2YQ==', 'https://www.linkedin.com/in/sarah-kalala-275908167', '{"en": "Sarah Kalala", "fr": "Sarah Kalala"}', '{"en": "Marketing & Communication", "fr": "Marketing & Communication"}', '{"en": ""}', '{"en": [{"asset1": "Sarah Kalala, Master in socio-educational and strategic communication at the Catholic University of Congo is a Passionate, Dynamic, Rigorous, Focused young woman.", "asset2": "Hardworking, she is very involved and does not give up until she has reached her goals; his passion for communication led him to work with various companies in the management of their customer relations and in the organization of events.", "asset3": "", "asset4": {"content1": "", "content2": "", "content3": "", "content4": "", "list_item_1": "", "list_item_2": "", "list_item_3": "", "list_item_4": "", "list_item_5": "", "list_item_6": ""}}], "fr": [{"asset1": "Sarah Kalala, Master en communication socio-éducative et stratégique à l''université catholique du Congo est une jeune femme Passionnée, Dynamique, Rigoureuse, Focus.", "asset2": "Travailleuse, elle est très impliquée et ne lâche rien tant qu''elle n''a pas encore atteint ses objectifs ; sa passion pour la communication lui a conduit à travailler avec diverses entreprises dans la gestion de leur relation client et dans l''organisation des évènements.", "asset3": "", "asset4": {"content1": "", "content2": "", "content3": "", "content4": "", "list_item_1": "", "list_item_2": "", "list_item_3": "", "list_item_4": "", "list_item_5": "", "list_item_6": ""}}]}', '{"en": [{"role": "Front desk : 2020-2021", "tasks": null, "company": ""}, {"role": "Sales officer Token communication", "tasks": null, "company": ""}], "fr": [{"role": "Front desk : 2020-2021", "tasks": null, "company": ""}, {"role": "Sales officer Token communication", "tasks": null, "company": ""}]}', '{"en": [], "fr": []}', '{"en": [], "fr": []}', '{"en": [], "fr": []}', 4, 1, '2026-03-17 16:45:37', '2026-05-14 18:54:09');

-- --------------------------------------------------------
-- Structure et données : partners
-- --------------------------------------------------------

DROP TABLE IF EXISTS `partners`;
CREATE TABLE `partners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` json NOT NULL,
  `website_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` smallint unsigned NOT NULL DEFAULT '0',
  `open_in_new_tab` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `partners_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `partners` (`id`, `slug`, `name`, `website_url`, `logo`, `sort_order`, `open_in_new_tab`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'partenaire-1', '{"en": "Strategic partner", "fr": "Partenaire stratégique"}', NULL, 'partners/01KRYTDYRJW3SC3AYJ5FNF7TMG.png', 1, 1, 1, '2026-05-14 13:42:40', '2026-05-19 00:33:34'),
	(2, 'partenaire-2', '{"en": "Technology partner", "fr": "Partenaire technologique"}', NULL, 'partners/01KRYTF6BXVNX2PCAR56DKZ6K5.png', 2, 1, 1, '2026-05-14 13:42:40', '2026-05-19 00:34:14'),
	(3, 'partenaire-3', '{"en": "Cloud partner", "fr": "Partenaire cloud"}', NULL, 'partners/01KRYTFV44VPX7BVPVKW5PZY2P.png', 3, 1, 1, '2026-05-14 13:42:40', '2026-05-19 00:34:35'),
	(4, 'partenaire-4', '{"en": "Security partner", "fr": "Partenaire sécurité"}', NULL, 'partners/01KRYTGM5SGTPC6EBW25HTWRWA.png', 4, 1, 1, '2026-05-14 13:42:40', '2026-05-19 00:35:01'),
	(5, 'partenaire-5', '{"en": "Network partner", "fr": "Partenaire réseau"}', NULL, 'partners/01KRYTHFG2B3V35M6HM40NF7DX.png', 5, 1, 1, '2026-05-14 13:42:40', '2026-05-19 00:35:29'),
	(6, 'partenaire-6', '{"en": "Solutions partner", "fr": "Partenaire solutions"}', NULL, 'partners/01KRYTJA5YFCS0BS1GVSGMBCRX.png', 6, 1, 1, '2026-05-14 13:42:40', '2026-05-19 00:35:56');

-- --------------------------------------------------------
-- Structure et données : job_offers
-- --------------------------------------------------------

DROP TABLE IF EXISTS `job_offers`;
CREATE TABLE `job_offers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` json NOT NULL,
  `description` json DEFAULT NULL,
  `requirements` json DEFAULT NULL,
  `location` json DEFAULT NULL,
  `contract_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `closes_at` timestamp NULL DEFAULT NULL,
  `sort_order` smallint unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `job_offers_slug_unique` (`slug`),
  KEY `job_offers_published_at_index` (`published_at`),
  KEY `job_offers_closes_at_index` (`closes_at`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `job_offers` (`id`, `slug`, `title`, `description`, `requirements`, `location`, `contract_type`, `published_at`, `closes_at`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'consultant-transformation-digitale', '{"en": "Digital transformation consultant", "fr": "Consultant transformation digitale"}', '{"en": "<p>SkyITup team possess more than 30 years of experience in the management, implementation of ERP projects , IT infrastructure projects  and support for large, medium and small companies as well as public and non-governmental institutions. We are willing to advise our customers in solving their problem.</p>", "fr": "<p>L&#039;équipe des services Consulting de SkyITup saisit chaque opportunité avec une base approfondie dans la formation aux meilleures pratiques et les méthodologies. Notre approche axée sur l&#039;objectivité et les résultats offre de véritables solutions de travail en matière de conseil en technologie digitale. De nombreuses industries ont des applications spécifiques à leur industrie et SkyITup est très compétent avec un grand nombre d&#039;entre elles et si nous ne sommes pas familiers, nous collaborerons avec un expert en logiciels ou apprendrons la technologie afin de pouvoir aider à la soutenir.</p>"}', '{"en": "<p>Support and Assistance — field experience in the DRC is a plus.</p>", "fr": "<p>Support et Assistance — expérience terrain en RDC appréciée.</p>"}', '{"en": "Kinshasa", "fr": "Kinshasa"}', 'cdi', '2026-05-07 13:42:40', '2026-07-14 13:42:40', 1, 1, '2026-05-14 13:42:40', '2026-05-14 13:42:40'),
	(2, 'ingenieur-solutions-logicielles', '{"en": "Software solutions engineer", "fr": "Ingénieur solutions logicielles"}', '{"en": "<p>SkyITUp is staffed with highly qualified consultants. procuring the right software can benefit your business in several ways. Your business software selection is critical to your overall success. There are many smart solutions that can significantly increase the productivity and efficiency of your organization. this will allow you to make significant savings and therefore a sustainable added value to customers, shareholders and the socio-economic environment.</p>", "fr": "<p>SkyITUp est doté de consultants hautement qualifiés. Chacun sert de point de contact unique pour tous vos besoins logiciels. L&#039;achat du bon logiciel peut bénéficier à votre entreprise de plusieurs façons. Votre sélection de logiciels d&#039;entreprise est essentielle à votre succès global. Il existe de nombreux produits qui peuvent facilement réduire le temps nécessaire pour effectuer des tâches intimidantes, ce qui vous aidera à optimiser votre temps et économiser de l&#039;argent ; et de le consacrer à des questions plus importantes.</p>"}', '{"en": "<p>Solid grasp of delivery cycles and client-facing communication.</p>", "fr": "<p>Maîtrise des cycles de développement et bonne culture client.</p>"}', '{"en": "Kinshasa / Lubumbashi", "fr": "Kinshasa / Lubumbashi"}', 'cdd', '2026-05-07 13:42:40', '2026-07-14 13:42:40', 2, 1, '2026-05-14 13:42:40', '2026-05-14 13:42:40'),
	(3, 'technicien-support-it', '{"en": "IT support technician", "fr": "Technicien support & assistance IT"}', '{"en": "<p>SkyITup has more than 30 years of experience in managing and supporting computer networks for small and medium-sized businesses.</p>", "fr": "<p>SkyITup a plus de 30 ans d&#039;expérience dans la gestion et le soutien des réseaux informatiques pour les petites et moyennes entreprises.</p>"}', '{"en": "<p>Customer mindset, responsiveness, desktop and network basics.</p>", "fr": "<p>Réactivité, sens du service, expérience postes de travail et réseau.</p>"}', '{"en": "Kinshasa", "fr": "Kinshasa"}', 'cdi', '2026-05-07 13:42:40', '2026-07-14 13:42:40', 3, 1, '2026-05-14 13:42:40', '2026-05-14 13:42:40');

-- --------------------------------------------------------
-- Structure et données : media
-- --------------------------------------------------------

DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint unsigned NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `media_order_column_index` (`order_column`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Aucune donnée pour `media`

-- --------------------------------------------------------
-- Structure et données : newsletter_subscribers
-- --------------------------------------------------------

DROP TABLE IF EXISTS `newsletter_subscribers`;
CREATE TABLE `newsletter_subscribers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `subscribed_at` timestamp NULL DEFAULT NULL,
  `unsubscribed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `newsletter_subscribers_email_unique` (`email`),
  KEY `newsletter_subscribers_is_active_index` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Aucune donnée pour `newsletter_subscribers`

-- --------------------------------------------------------
-- Structure et données : contact_messages
-- --------------------------------------------------------

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'contact_page',
  `locale` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consent_privacy` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_messages_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `message`, `source`, `locale`, `ip_address`, `consent_privacy`, `status`, `read_at`, `created_at`, `updated_at`) VALUES
	(1, 'silas', 'silasmas@outlook.fr', '0827839232', 'je vais bien', 'home_section', 'fr', '127.0.0.1', 1, 'new', NULL, '2026-05-15 17:21:20', '2026-05-15 17:21:20');

-- --------------------------------------------------------
-- Structure et données : job_applications
-- --------------------------------------------------------

DROP TABLE IF EXISTS `job_applications`;
CREATE TABLE `job_applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `job_offer_id` bigint unsigned NOT NULL,
  `locale` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_letter` text COLLATE utf8mb4_unicode_ci,
  `cover_letter_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `reviewed_by` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consent_privacy` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_applications_job_offer_id_foreign` (`job_offer_id`),
  KEY `job_applications_reviewed_by_foreign` (`reviewed_by`),
  KEY `job_applications_status_index` (`status`),
  CONSTRAINT `job_applications_job_offer_id_foreign` FOREIGN KEY (`job_offer_id`) REFERENCES `job_offers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `job_applications_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `job_applications` (`id`, `job_offer_id`, `locale`, `first_name`, `last_name`, `email`, `phone`, `cover_letter`, `cover_letter_path`, `cv_path`, `linkedin_url`, `status`, `reviewed_at`, `reviewed_by`, `ip_address`, `consent_privacy`, `created_at`, `updated_at`) VALUES
	(1, 2, 'fr', 'silas', 'Masimango', 'silasmas@outlook.fr', '0987363JHB', NULL, 'job-applications/2/JiyBippnNh56CjrmWA8ngtgmYLyxstkhMhOpP3Se.pdf', 'job-applications/2/cPMmK9CDXbJMiMt4UGFE8G4Fuy5Xe6lL2e84spg1.pdf', NULL, 'pending', NULL, NULL, '127.0.0.1', 1, '2026-05-15 15:38:01', '2026-05-15 15:38:01'),
	(2, 3, 'fr', 'silas', 'Masimango', 'silasmas@outlook.fr', '03948474843', NULL, 'job-applications/3/aWTMy98uGquxRqa0gkc2PJEpAfxijMFHXk614Tso.pdf', 'job-applications/3/JsZTl9MbHVTQHFoEaEa3kcxZ4iuqYze0AZ4vaRbQ.pdf', NULL, 'pending', NULL, NULL, '127.0.0.1', 1, '2026-05-15 16:04:52', '2026-05-15 16:04:52');

-- --------------------------------------------------------
-- Structure et données : model_has_permissions
-- --------------------------------------------------------

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Aucune donnée pour `model_has_permissions`

-- --------------------------------------------------------
-- Structure et données : model_has_roles
-- --------------------------------------------------------

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1);

SET FOREIGN_KEY_CHECKS = 1;
