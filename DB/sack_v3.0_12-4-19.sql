-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2019 at 08:52 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sack_v4`
--

-- --------------------------------------------------------

--
-- Table structure for table `checklists`
--

CREATE TABLE `checklists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `survey_type` int(10) UNSIGNED NOT NULL,
  `checklist_type` int(10) UNSIGNED NOT NULL,
  `category` int(10) UNSIGNED NOT NULL,
  `jira_temp_id` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checklists`
--

INSERT INTO `checklists` (`id`, `survey_type`, `checklist_type`, `category`, `jira_temp_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 3, 'Item 1', '2019-12-03 11:18:46', '2019-12-03 11:28:08');

-- --------------------------------------------------------

--
-- Table structure for table `checklist_categories`
--

CREATE TABLE `checklist_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `checklist_type` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checklist_categories`
--

INSERT INTO `checklist_categories` (`id`, `checklist_type`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'General and Testing Options (Survey Settings)', '2019-12-03 10:38:44', '2019-12-03 10:38:44');

-- --------------------------------------------------------

--
-- Table structure for table `checklist_types`
--

CREATE TABLE `checklist_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checklist_types`
--

INSERT INTO `checklist_types` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Confirmit', '2019-12-03 10:38:35', '2019-12-03 10:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `jira_template`
--

CREATE TABLE `jira_template` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jira_template`
--

INSERT INTO `jira_template` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, '*I. Survey Settings*', '2019-12-03 11:03:04', '2019-12-03 11:03:04'),
(2, '*II. Functionality*', '2019-12-03 11:09:02', '2019-12-03 11:09:02'),
(3, '*III. Password/Link Validation*', '2019-12-03 11:09:11', '2019-12-03 11:09:11'),
(4, '*IV. Content and General Functions*', '2019-12-03 11:09:20', '2019-12-03 11:09:20'),
(5, '*V. Look and Feel*', '2019-12-03 11:09:30', '2019-12-03 11:15:17'),
(6, '*VI. Frequency Counter*', '2019-12-03 11:09:39', '2019-12-03 11:09:39'),
(7, '*VII. Mailout*', '2019-12-03 11:09:49', '2019-12-03 11:09:49');

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
(20, '2014_10_12_000000_create_users_table', 1),
(21, '2014_10_12_100000_create_password_resets_table', 1),
(22, '2019_07_29_023052_create_projects_table', 1),
(23, '2019_07_29_205452_create_checklists_table', 1),
(24, '2019_07_29_214610_create_project_checklists_table', 1),
(25, '2019_07_30_222043_create_project_item_comments_table', 1),
(26, '2019_08_02_231453_create_survey_types_table', 1),
(27, '2019_08_20_155930_checklist_category', 1),
(28, '2019_08_20_161321_create_checklist_types_table', 1),
(29, '2019_12_03_182928_jira_template', 1);

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
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `osi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` int(10) UNSIGNED NOT NULL,
  `proofer` int(10) UNSIGNED NOT NULL,
  `proofer2` int(10) UNSIGNED NOT NULL,
  `survey_type` int(10) UNSIGNED NOT NULL,
  `survey_phase` int(10) UNSIGNED NOT NULL,
  `status` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `osi`, `owner`, `proofer`, `proofer2`, `survey_type`, `survey_phase`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Project 1', 'OSI-0001', 1, 2, 0, 1, 1, 3, '2019-12-03 11:32:42', '2019-12-03 11:33:41');

-- --------------------------------------------------------

--
-- Table structure for table `project_checklists`
--

CREATE TABLE `project_checklists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `survey_type` int(10) UNSIGNED NOT NULL,
  `survey_phase` int(10) UNSIGNED NOT NULL,
  `checklist_type` int(10) UNSIGNED NOT NULL,
  `category` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `checklist_id` int(10) UNSIGNED NOT NULL,
  `jira_temp_id` int(11) UNSIGNED NOT NULL,
  `item_status` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_checklists`
--

INSERT INTO `project_checklists` (`id`, `survey_type`, `survey_phase`, `checklist_type`, `category`, `project_id`, `user_id`, `checklist_id`, `jira_temp_id`, `item_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 0, '2019-12-03 11:32:46', '2019-12-03 11:32:52'),
(2, 1, 1, 1, 1, 1, 2, 1, 1, 0, '2019-12-03 11:33:33', '2019-12-03 11:46:02');

-- --------------------------------------------------------

--
-- Table structure for table `project_item_comments`
--

CREATE TABLE `project_item_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_checklist_id` int(10) UNSIGNED NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_item_comments`
--

INSERT INTO `project_item_comments` (`id`, `project_checklist_id`, `comments`, `created_at`, `updated_at`) VALUES
(1, 1, 'Initial QA (Owner): Comment for item 1.1', '2019-12-03 11:33:07', '2019-12-03 11:33:07'),
(2, 2, 'Initial QA (Proofer): Comment for item 1.1', '2019-12-03 11:46:18', '2019-12-03 11:46:18');

-- --------------------------------------------------------

--
-- Table structure for table `survey_types`
--

CREATE TABLE `survey_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `survey_types`
--

INSERT INTO `survey_types` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Open Survey', '2019-12-03 10:38:12', '2019-12-03 10:38:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Niel Ahlmen Malitoc', 'niel.ahlmen.malitoc@willistowerswatson.com', NULL, '$2y$10$t/1q1c.kEpvsiibdqn38mu9Do7hlNim.iSHbzjoLV7Ia60zmF06jS', NULL, '2019-12-03 10:37:21', '2019-12-03 10:37:21', 'role_User,role_Admin'),
(2, 'John Smith', 'jsmith@example.com', NULL, '$2y$10$w5DSK1AVUiei82B1nm7Ei.3bGuxNR/2rHZOVk3LlVBJd8YDxbfbWy', NULL, '2019-12-03 11:32:21', '2019-12-03 11:32:21', 'role_User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checklists`
--
ALTER TABLE `checklists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checklist_categories`
--
ALTER TABLE `checklist_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checklist_types`
--
ALTER TABLE `checklist_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jira_template`
--
ALTER TABLE `jira_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_checklists`
--
ALTER TABLE `project_checklists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_item_comments`
--
ALTER TABLE `project_item_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_types`
--
ALTER TABLE `survey_types`
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
-- AUTO_INCREMENT for table `checklists`
--
ALTER TABLE `checklists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `checklist_categories`
--
ALTER TABLE `checklist_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `checklist_types`
--
ALTER TABLE `checklist_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jira_template`
--
ALTER TABLE `jira_template`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project_checklists`
--
ALTER TABLE `project_checklists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_item_comments`
--
ALTER TABLE `project_item_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `survey_types`
--
ALTER TABLE `survey_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
