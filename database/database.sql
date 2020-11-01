-- --------------------------------------------------------
-- Host:                         localhost
-- Versi server:                 5.7.24 - MySQL Community Server (GPL)
-- OS Server:                    Win64
-- HeidiSQL Versi:               10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- membuang struktur untuk table game.classrooms
CREATE TABLE IF NOT EXISTS `classrooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel game.classrooms: ~3 rows (lebih kurang)
DELETE FROM `classrooms`;
/*!40000 ALTER TABLE `classrooms` DISABLE KEYS */;
INSERT INTO `classrooms` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Kelas 10', '2020-09-13 16:30:35', '2020-09-13 16:30:35', NULL),
	(2, 'Kelas 11', '2020-09-13 16:30:41', '2020-09-13 16:30:41', NULL),
	(3, 'Kelas 12', '2020-09-13 16:30:46', '2020-09-13 16:30:46', NULL),
	(4, 'Kelas 15', '2020-09-22 13:45:37', '2020-09-22 13:45:37', NULL);
/*!40000 ALTER TABLE `classrooms` ENABLE KEYS */;

-- membuang struktur untuk table game.classroom_details
CREATE TABLE IF NOT EXISTS `classroom_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `classroom_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel game.classroom_details: ~14 rows (lebih kurang)
DELETE FROM `classroom_details`;
/*!40000 ALTER TABLE `classroom_details` DISABLE KEYS */;
INSERT INTO `classroom_details` (`id`, `classroom_id`, `member_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 2, 1, '2020-09-13 16:33:55', '2020-09-13 16:33:55', NULL),
	(2, 2, 2, '2020-09-13 16:34:01', '2020-09-13 16:34:01', NULL),
	(3, 2, 3, '2020-09-13 23:47:36', '2020-09-13 23:47:36', NULL),
	(4, 1, 4, '2020-09-13 23:47:37', '2020-09-13 23:47:37', NULL),
	(5, 1, 5, '2020-09-13 23:47:43', '2020-09-13 23:47:44', NULL),
	(6, 4, 1, '2020-09-22 13:45:37', '2020-09-22 13:46:04', '2020-09-22 13:46:04'),
	(7, 4, 3, '2020-09-22 13:45:37', '2020-09-22 13:46:04', '2020-09-22 13:46:04'),
	(8, 4, 5, '2020-09-22 13:45:37', '2020-09-22 13:46:04', '2020-09-22 13:46:04'),
	(9, 4, 6, '2020-09-22 13:45:37', '2020-09-22 13:46:04', '2020-09-22 13:46:04'),
	(10, 4, 1, '2020-09-22 13:46:04', '2020-09-22 13:46:16', '2020-09-22 13:46:16'),
	(11, 4, 2, '2020-09-22 13:46:04', '2020-09-22 13:46:16', '2020-09-22 13:46:16'),
	(12, 4, 3, '2020-09-22 13:46:04', '2020-09-22 13:46:16', '2020-09-22 13:46:16'),
	(13, 4, 4, '2020-09-22 13:46:04', '2020-09-22 13:46:16', '2020-09-22 13:46:16'),
	(14, 4, 1, '2020-09-22 13:46:16', '2020-09-22 13:46:16', NULL),
	(15, 4, 3, '2020-09-22 13:46:16', '2020-09-22 13:46:16', NULL);
/*!40000 ALTER TABLE `classroom_details` ENABLE KEYS */;

-- membuang struktur untuk table game.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel game.failed_jobs: ~0 rows (lebih kurang)
DELETE FROM `failed_jobs`;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- membuang struktur untuk table game.members
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel game.members: ~7 rows (lebih kurang)
DELETE FROM `members`;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` (`id`, `name`, `email`, `password`, `email_verified_at`, `remember_token`, `photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'nama 1', 'dikyoktafian25@gmail.com', '$2y$10$SoUc8MXGnAXnk907y45U9eJMWxIGvKrnXCo1MTSa4v8TQ.oxrhfmS', NULL, NULL, NULL, '2020-09-12 17:44:00', '2020-09-22 10:56:31', NULL),
	(2, 'nama 2', 'dikyoktafian41@gmail.com', '$2y$10$zfARRjTcegI9lcLUu4CKG.yLRdMPocKYS92N1t0OKVMlR02AGaBse', NULL, NULL, NULL, '2020-09-12 17:44:55', '2020-09-12 17:44:56', NULL),
	(3, 'nama 3', 'dikyoktafian42@gmail.com', '$2y$10$zfARRjTcegI9lcLUu4CKG.yLRdMPocKYS92N1t0OKVMlR02AGaBse', NULL, NULL, NULL, '2020-09-13 23:46:30', '2020-09-13 23:46:31', NULL),
	(4, 'nama 4', 'dikyoktafian1@gmail.com', '$2y$10$zfARRjTcegI9lcLUu4CKG.yLRdMPocKYS92N1t0OKVMlR02AGaBse', NULL, NULL, NULL, '2020-09-13 23:46:45', '2020-09-13 23:46:45', NULL),
	(5, 'nama 5', 'dikyoktafian40@gmail.com', '$2y$10$zfARRjTcegI9lcLUu4CKG.yLRdMPocKYS92N1t0OKVMlR02AGaBse', NULL, NULL, NULL, '2020-09-13 23:47:02', '2020-09-13 23:47:03', NULL),
	(6, 'nama 6', 'dikyoktafian44@gmial.com', '$2y$10$zfARRjTcegI9lcLUu4CKG.yLRdMPocKYS92N1t0OKVMlR02AGaBse', NULL, NULL, NULL, '2020-09-13 23:48:16', '2020-09-13 23:48:16', NULL),
	(7, 'tes', 'dikyoktafian25@gmail.com', '$2y$10$Ygyacty69f3qz9xBqvw0FOOPENaQN6Z6goX22YPg4GvBIUspTqLX.', NULL, NULL, '5f6a20ddd3c6e.jpg', '2020-09-22 15:57:36', '2020-09-22 16:06:21', '2020-09-22 16:06:21');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;

-- membuang struktur untuk table game.member_answers
CREATE TABLE IF NOT EXISTS `member_answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_task_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel game.member_answers: ~4 rows (lebih kurang)
DELETE FROM `member_answers`;
/*!40000 ALTER TABLE `member_answers` DISABLE KEYS */;
INSERT INTO `member_answers` (`id`, `member_task_id`, `question_id`, `answer_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 9, 24, '2020-09-28 12:23:43', '2020-09-28 12:23:43', NULL),
	(2, 1, 10, 26, '2020-09-28 12:23:43', '2020-09-28 12:23:43', NULL),
	(3, 1, 11, 29, '2020-09-28 12:23:43', '2020-09-28 12:23:43', NULL),
	(4, 1, 12, 34, '2020-09-28 12:23:43', '2020-09-28 12:23:43', NULL);
/*!40000 ALTER TABLE `member_answers` ENABLE KEYS */;

-- membuang struktur untuk table game.member_points
CREATE TABLE IF NOT EXISTS `member_points` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` int(11) NOT NULL,
  `point` int(5) NOT NULL DEFAULT '20',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel game.member_points: ~2 rows (lebih kurang)
DELETE FROM `member_points`;
/*!40000 ALTER TABLE `member_points` DISABLE KEYS */;
INSERT INTO `member_points` (`id`, `member_id`, `model_type`, `model_id`, `point`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'App\\Models\\Task', 2, 200, '2020-09-28 12:23:42', '2020-09-28 12:23:42', NULL),
	(2, 1, 'App\\Models\\TaskQuestion', 2, 50, '2020-09-28 12:23:43', '2020-09-28 12:23:43', NULL),
	(3, 1, 'App\\Models\\TaskQuestion', 2, 50, '2020-09-28 12:23:43', '2020-09-28 12:23:43', NULL);
/*!40000 ALTER TABLE `member_points` ENABLE KEYS */;

-- membuang struktur untuk table game.member_tasks
CREATE TABLE IF NOT EXISTS `member_tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `status` enum('done','progress') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'progress',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel game.member_tasks: ~0 rows (lebih kurang)
DELETE FROM `member_tasks`;
/*!40000 ALTER TABLE `member_tasks` DISABLE KEYS */;
INSERT INTO `member_tasks` (`id`, `member_id`, `task_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 2, 'done', '2020-09-28 12:23:42', '2020-09-28 12:23:42', NULL);
/*!40000 ALTER TABLE `member_tasks` ENABLE KEYS */;

-- membuang struktur untuk table game.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel game.migrations: ~10 rows (lebih kurang)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2020_02_27_152307_create_settings_table', 1),
	(5, '2020_09_06_234436_create_tasks_table', 1),
	(6, '2020_09_06_235410_create_task_questions_table', 1),
	(7, '2020_09_06_235510_create_task_answers_table', 1),
	(8, '2020_09_06_235556_create_members_table', 1),
	(9, '2020_09_06_235622_create_member_roles_table', 1),
	(10, '2020_09_06_235747_create_member_answers_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- membuang struktur untuk table game.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel game.password_resets: ~0 rows (lebih kurang)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- membuang struktur untuk table game.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel game.roles: ~2 rows (lebih kurang)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'superadministrator', '2020-09-16 08:03:31', '2020-09-16 08:03:32', NULL),
	(2, 'teacher', '2020-09-16 08:03:51', '2020-09-16 08:03:51', NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- membuang struktur untuk table game.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel game.settings: ~0 rows (lebih kurang)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- membuang struktur untuk table game.subjects
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel game.subjects: ~3 rows (lebih kurang)
DELETE FROM `subjects`;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Bahasa Inggris', '2020-09-13 23:48:29', '2020-09-13 23:48:29', NULL),
	(2, 'Bahasa Indonesia', '2020-09-13 23:48:35', '2020-09-13 23:48:40', NULL),
	(4, 'Sejarah', '2020-09-15 04:32:07', '2020-09-15 04:32:08', NULL);
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;

-- membuang struktur untuk table game.tasks
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `task` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) NOT NULL,
  `classroom_id` int(11) DEFAULT NULL,
  `point` int(11) DEFAULT '200',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel game.tasks: ~0 rows (lebih kurang)
DELETE FROM `tasks`;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` (`id`, `task`, `summary`, `created_by`, `classroom_id`, `point`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'adasf', 'asdfasdf', 1, 1, 200, '2020-09-22 06:31:08', '2020-09-22 06:31:08', NULL),
	(2, 'tugas bahasa inggris', 'summary', 2, 2, 200, '2020-09-28 06:22:22', '2020-09-28 06:22:22', NULL);
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;

-- membuang struktur untuk table game.task_answers
CREATE TABLE IF NOT EXISTS `task_answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `answer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` enum('a','b','c','d') COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel game.task_answers: ~36 rows (lebih kurang)
DELETE FROM `task_answers`;
/*!40000 ALTER TABLE `task_answers` DISABLE KEYS */;
INSERT INTO `task_answers` (`id`, `question_id`, `answer`, `label`, `correct`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'answer a', 'a', 1, '2020-09-22 06:31:08', '2020-09-22 06:42:28', NULL),
	(2, 1, 'Answer B', 'b', 0, '2020-09-22 06:31:08', '2020-09-22 06:42:28', NULL),
	(3, 1, 'Answer C', 'c', 0, '2020-09-22 06:31:08', '2020-09-22 06:42:28', NULL),
	(4, 1, 'Answer D', 'd', 0, '2020-09-22 06:31:08', '2020-09-22 06:42:28', NULL),
	(5, 2, 'asdf', 'a', 0, '2020-09-22 06:31:08', '2020-09-22 06:40:55', NULL),
	(6, 2, 'zxcvzxcv', 'b', 0, '2020-09-22 06:31:08', '2020-09-22 06:40:55', NULL),
	(7, 2, 'Answer C', 'c', 1, '2020-09-22 06:31:08', '2020-09-22 06:40:55', NULL),
	(8, 2, 'zxcv', 'd', 0, '2020-09-22 06:31:08', '2020-09-22 06:40:55', NULL),
	(9, 6, 'lzxkcjvlkjasd', 'a', 0, '2020-09-22 06:38:47', '2020-09-22 06:40:55', NULL),
	(10, 6, 'asdf', 'b', 1, '2020-09-22 06:38:47', '2020-09-22 06:40:55', NULL),
	(11, 6, 'zxcv', 'c', 0, '2020-09-22 06:38:47', '2020-09-22 06:40:55', NULL),
	(12, 6, 'sdfg', 'd', 0, '2020-09-22 06:38:47', '2020-09-22 06:40:55', NULL),
	(13, 7, 'Answer A', 'a', 0, '2020-09-22 06:40:55', '2020-09-22 06:42:28', NULL),
	(14, 7, 'Answer B', 'b', 0, '2020-09-22 06:40:55', '2020-09-22 06:42:28', NULL),
	(15, 7, 'Answer C', 'c', 1, '2020-09-22 06:40:55', '2020-09-22 06:42:28', NULL),
	(16, 7, 'Answer D', 'd', 0, '2020-09-22 06:40:55', '2020-09-22 06:42:28', NULL),
	(17, 8, 'Answer A', 'a', 1, '2020-09-22 06:42:10', '2020-09-22 06:42:28', NULL),
	(18, 8, 'Answer B', 'b', 0, '2020-09-22 06:42:10', '2020-09-22 06:42:28', NULL),
	(19, 8, 'Answer C', 'c', 0, '2020-09-22 06:42:10', '2020-09-22 06:42:28', NULL),
	(20, 8, 'Answer D', 'd', 0, '2020-09-22 06:42:11', '2020-09-22 06:42:28', NULL),
	(21, 9, 'answer a', 'a', 0, '2020-09-28 06:22:22', '2020-09-28 10:28:44', NULL),
	(22, 9, 'Answer B', 'b', 0, '2020-09-28 06:22:22', '2020-09-28 10:28:44', NULL),
	(23, 9, 'Answer C', 'c', 0, '2020-09-28 06:22:22', '2020-09-28 10:28:44', NULL),
	(24, 9, 'Answer D', 'd', 1, '2020-09-28 06:22:22', '2020-09-28 10:28:45', NULL),
	(25, 10, 'Answer A', 'a', 0, '2020-09-28 06:22:22', '2020-09-28 10:28:45', NULL),
	(26, 10, 'Answer B', 'b', 1, '2020-09-28 06:22:22', '2020-09-28 10:28:45', NULL),
	(27, 10, 'Answer C', 'c', 0, '2020-09-28 06:22:23', '2020-09-28 10:28:45', NULL),
	(28, 10, 'Answer D', 'd', 0, '2020-09-28 06:22:23', '2020-09-28 10:28:45', NULL),
	(29, 11, 'Answer A', 'a', 0, '2020-09-28 06:22:23', '2020-09-28 10:28:45', NULL),
	(30, 11, 'Answer B', 'b', 1, '2020-09-28 06:22:23', '2020-09-28 10:28:45', NULL),
	(31, 11, 'Answer C', 'c', 0, '2020-09-28 06:22:23', '2020-09-28 10:28:45', NULL),
	(32, 11, 'Answer D', 'd', 0, '2020-09-28 06:22:23', '2020-09-28 10:28:45', NULL),
	(33, 12, 'asdf', 'a', 1, '2020-09-28 06:22:23', '2020-09-28 10:28:45', NULL),
	(34, 12, 'zxcv', 'b', 0, '2020-09-28 06:22:23', '2020-09-28 10:28:45', NULL),
	(35, 12, 'asdf', 'c', 0, '2020-09-28 06:22:23', '2020-09-28 10:28:45', NULL),
	(36, 12, 'dgdfs', 'd', 0, '2020-09-28 06:22:23', '2020-09-28 10:28:45', NULL);
/*!40000 ALTER TABLE `task_answers` ENABLE KEYS */;

-- membuang struktur untuk table game.task_questions
CREATE TABLE IF NOT EXISTS `task_questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attach` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `point` int(5) DEFAULT '20',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel game.task_questions: ~9 rows (lebih kurang)
DELETE FROM `task_questions`;
/*!40000 ALTER TABLE `task_questions` DISABLE KEYS */;
INSERT INTO `task_questions` (`id`, `task_id`, `image`, `attach`, `question`, `point`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, '5f699cd41f121.jpg', NULL, 'Question #1', 100, '2020-09-22 06:31:08', '2020-09-22 06:42:28', NULL),
	(2, 1, NULL, NULL, 'Question 2', 50, '2020-09-22 06:31:08', '2020-09-22 06:41:08', '2020-09-22 06:41:08'),
	(6, 1, NULL, NULL, 'Question 3', 50, '2020-09-22 06:38:47', '2020-09-22 06:41:08', '2020-09-22 06:41:08'),
	(7, 1, NULL, NULL, 'Question #2', 200, '2020-09-22 06:40:55', '2020-09-22 06:42:28', NULL),
	(8, 1, '5f699cd485e6c.jpg', NULL, 'Question 3', 200, '2020-09-22 06:42:10', '2020-09-22 06:42:28', NULL),
	(9, 2, '5f71badcb6682.jpg', NULL, 'Question #1', 50, '2020-09-28 06:22:22', '2020-09-28 10:28:44', NULL),
	(10, 2, NULL, NULL, 'Question #2', 50, '2020-09-28 06:22:22', '2020-09-28 10:28:45', NULL),
	(11, 2, NULL, NULL, 'Question 3', 20, '2020-09-28 06:22:23', '2020-09-28 10:28:45', NULL),
	(12, 2, NULL, NULL, 'qwer', 20, '2020-09-28 06:22:23', '2020-09-28 10:28:45', NULL);
/*!40000 ALTER TABLE `task_questions` ENABLE KEYS */;

-- membuang struktur untuk table game.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  `subject_id` int(11) DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel game.users: ~4 rows (lebih kurang)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role_id`, `subject_id`, `photo`, `created_at`, `updated_at`) VALUES
	(1, 'Superadministrator', 'superadministrator@app.com', NULL, '$2y$10$zfARRjTcegI9lcLUu4CKG.yLRdMPocKYS92N1t0OKVMlR02AGaBse', NULL, 1, 2, NULL, NULL, '2020-09-22 16:26:49'),
	(2, 'Teacher 1', 'teacher@app.com', NULL, '$2y$10$zfARRjTcegI9lcLUu4CKG.yLRdMPocKYS92N1t0OKVMlR02AGaBse', NULL, 2, 1, NULL, NULL, NULL),
	(3, 'Teacher 2', 'teacher2@app.com', NULL, '$2y$10$zfARRjTcegI9lcLUu4CKG.yLRdMPocKYS92N1t0OKVMlR02AGaBse', NULL, 2, 2, NULL, NULL, NULL),
	(4, 'Teacher 3', 'teacher3@app.com', NULL, '$2y$10$zfARRjTcegI9lcLUu4CKG.yLRdMPocKYS92N1t0OKVMlR02AGaBse', NULL, 2, 3, NULL, NULL, NULL),
	(5, 'tes', 'nurul@redbuzz.co.id', NULL, '$2y$10$zfARRjTcegI9lcLUu4CKG.yLRdMPocKYS92N1t0OKVMlR02AGaBse', NULL, 2, 1, '5f6a22e0251ee.jpg', '2020-09-22 16:14:24', '2020-09-22 16:14:24'),
	(6, 'tes', 'gilang.ramadhan@redtech.co.id', NULL, 'password', NULL, 2, 1, '5f6b0bd2785d7.jpg', '2020-09-23 08:48:18', '2020-09-23 08:48:18');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
