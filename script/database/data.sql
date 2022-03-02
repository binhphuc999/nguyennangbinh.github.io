-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2021 at 12:13 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mailtemp`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(10) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `icon`, `title`, `description`, `created_at`, `updated_at`) VALUES
(6, '<i class=\"fas fa-user-shield\"></i>', '100% Safe', 'Protect your privacy by not allowing spam in your personal inbox', '2021-08-30 04:08:27', '2021-08-30 04:08:27'),
(7, '<i class=\"fas fa-envelope-open-text\"></i>', 'Simple & Free', 'Create temp emails fast simple steps & always free', '2021-08-30 04:10:43', '2021-08-30 04:10:43'),
(8, '<i class=\"fas fa-globe-europe\"></i>', 'Worldwide', 'Used by professionals all around the world , try it now', '2021-08-30 04:12:56', '2021-08-30 04:12:56');

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
(7, '2021_07_02_152029_create_settings_table', 1),
(8, '2021_07_07_030945_create_trash_mails_table', 1),
(9, '2021_08_11_214002_create_features_table', 2),
(10, '2021_08_12_171504_create_translates_table', 3),
(11, '2021_08_26_203701_create_statistics_table', 4),
(12, '2021_06_29_203211_create_categories_table', 5),
(13, '2021_06_30_203023_create_posts_table', 5),
(14, '2021_06_29_203100_create_pages_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `views` int(11) NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'name', NULL, NULL, '2021-08-30 02:12:02'),
(2, 'site_url', NULL, NULL, '2021-08-30 02:12:02'),
(3, 'site_logo', '/uploads/logo.png', NULL, '2021-08-30 02:26:57'),
(4, 'favicon', '/uploads/favicon.png', NULL, '2021-08-30 03:08:43'),
(5, 'imap_host', NULL, NULL, '2021-09-01 20:56:39'),
(6, 'imap_user', NULL, NULL, '2021-09-01 19:02:32'),
(7, 'imap_pass', NULL, NULL, '2021-09-01 19:02:32'),
(8, 'domains', NULL, NULL, '2021-09-01 19:02:32'),
(9, 'premium_domains', NULL, NULL, '2021-08-14 19:28:25'),
(10, 'forbidden_id', 'admin', NULL, '2021-08-30 02:49:48'),
(11, 'allowed_files', 'doc,docx,xls,xlsx,ppt,pptx,xps,pdf,dxf,ai,psd,eps,ps,svg,ttf,zip,rar,tar,gzip,mp3,mpeg,wav,ogg,jpeg,jpg,png,gif,bmp,tif,webm,mpeg4,3gpp,mov,avi,mpegs,wmv,flx', NULL, '2021-09-01 19:41:16'),
(12, 'fetch_time', '20', NULL, '2021-09-01 18:24:03'),
(13, 'email_lifetime', '5', NULL, '2021-08-30 02:49:48'),
(14, 'description', NULL, NULL, '2021-08-26 18:02:50'),
(15, 'keywords', NULL, NULL, '2021-08-26 18:02:50'),
(16, 'google_analytics_code', NULL, NULL, '2021-08-26 11:42:52'),
(17, 'enable_blog', '0', NULL, '2021-08-30 03:07:43'),
(18, 'popular_posts', '6', NULL, '2021-08-30 03:07:43'),
(19, 'max_posts', '6', NULL, '2021-08-30 03:07:43'),
(20, 'disqus', NULL, NULL, '2021-08-31 04:29:05'),
(21, 'top_ad', '<center><img src=\'https://via.placeholder.com/720x90\'></center>', NULL, '2021-08-31 04:00:37'),
(22, 'bottom_ad', '<center><img src=\'https://via.placeholder.com/720x90\'></center>', NULL, '2021-08-31 04:01:24'),
(23, 'right_ad', '<center><img src=\'https://via.placeholder.com/200x600\'></center>', NULL, '2021-08-31 04:01:24'),
(24, 'left_ad', '<center><img src=\'https://via.placeholder.com/200x600\'></center>', NULL, '2021-08-31 04:01:24'),
(25, 'head_ad', NULL, NULL, '2021-08-26 11:42:42'),
(26, 'sidebar_ad', '<center><img src=\'https://via.placeholder.com/350x350\'></center>', NULL, '2021-08-31 04:01:24'),
(27, 'main_color', '#161a1d', NULL, '2021-08-30 02:15:13'),
(28, 'secondary_color', '#00af91', NULL, '2021-08-30 02:15:13'),
(29, 'MAIL_MAILER', 'smtp', NULL, '2021-08-30 21:33:44'),
(30, 'MAIL_HOST', NULL, NULL, '2021-08-30 22:56:22'),
(31, 'MAIL_PORT', '465', NULL, '2021-08-30 22:09:47'),
(32, 'MAIL_USERNAME', NULL, NULL, '2021-08-30 22:56:23'),
(33, 'MAIL_PASSWORD', NULL, NULL, '2021-08-30 22:56:23'),
(34, 'MAIL_ENCRYPTION', 'tls', NULL, '2021-08-30 21:56:02'),
(35, 'MAIL_FROM_ADDRESS', NULL, NULL, '2021-08-30 22:56:23'),
(36, 'emails_created', '0', NULL, '2021-08-30 03:31:30'),
(37, 'messages_received', '0', NULL, '2021-08-30 03:31:30'),
(38, 'total_emails_created', '0', NULL, '2021-09-01 19:51:14'),
(39, 'total_messages_received', '0', NULL, '2021-08-31 03:26:27'),
(40, 'facebook', '#trashmails', NULL, '2021-08-30 03:07:25'),
(41, 'instagram', '#trashmails', NULL, '2021-08-30 03:07:25'),
(42, 'youtube', '#trashmails', NULL, '2021-08-30 03:07:25'),
(43, 'twitter', '#trashmails', NULL, '2021-08-30 03:07:25'),
(44, 'chrome_extensions', '#', NULL, '2021-08-30 03:07:25'),
(45, 'mozilla_extensions', '#', NULL, '2021-08-30 03:07:25'),
(46, 'playstore', '#', NULL, '2021-08-30 03:07:25'),
(47, 'appstore', '#', NULL, '2021-08-30 03:07:25'),
(48, 'MAIL_TO_ADDRESS', NULL, NULL, '2021-08-30 22:56:23'),
(49, 'imap_port', '993', NULL, '2021-09-01 20:56:39'),
(50, 'imap_encryption', 'ssl', NULL, '2021-09-01 21:00:22'),
(51, 'imap_certificate', '1', NULL, '2021-09-01 20:59:14');

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE `statistics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translates`
--

CREATE TABLE `translates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `translates`
--

INSERT INTO `translates` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Mailbox Small Title', 'Your Temporary Email Address', NULL, '2021-08-12 19:46:29'),
(2, 'Mailbox Description', 'Forget about spam, advertising mailings, hacking and attacking robots. Keep your real mailbox clean and secure. Temp Mail provides temporary, secure, anonymous, free, disposable email address.', NULL, '2021-08-12 19:39:24'),
(3, 'Refresh', 'Refresh', NULL, '2021-08-12 19:23:25'),
(4, 'Change', 'Change', NULL, '2021-08-12 19:23:25'),
(5, 'Delete', 'Delete', NULL, '2021-08-12 19:23:25'),
(6, 'Sender', 'Sender', NULL, '2021-08-12 19:46:44'),
(7, 'Subject', 'Subject', NULL, '2021-08-12 19:46:44'),
(8, 'Veiw', 'Veiw', NULL, '2021-08-12 19:46:44'),
(9, 'Your inbox is empty', 'Your inbox is empty', NULL, '2021-08-12 16:56:15'),
(10, 'Waiting for incoming emails', 'Waiting for incoming emails', NULL, '2021-08-12 16:56:15'),
(11, 'Awesome Features', 'Awesome Features', NULL, '2021-08-12 16:56:15'),
(12, 'Features Description', 'Disposable temporary email protects your real email address from spam, advertising mailings, malwares.', NULL, '2021-08-30 04:13:57'),
(13, 'Popular Posts', 'Popular Posts', NULL, '2021-08-13 14:34:41'),
(14, 'Back To List', 'Back To List', NULL, '2021-08-12 19:46:44'),
(15, 'Attachments', 'Attachments', NULL, '2021-08-12 19:46:44'),
(16, 'Copyright', 'Copyright ©2021 - TrashMails', NULL, '2021-08-30 03:08:07'),
(17, 'Blog', 'Blog', NULL, '2021-08-13 14:31:35'),
(18, 'Categories', 'Categories', NULL, '2021-08-13 14:34:41'),
(19, 'Leave a Reply', 'Leave a Reply', NULL, '2021-08-12 16:56:15'),
(32, 'Change E-mail Address', 'Change E-mail Address', NULL, '2021-08-13 15:27:44'),
(34, 'Change Description', '<b>Trash Mails</b> provides the ability to change your temporary email address on this page. <br> <br> To change or recover the email address, please enter the desired E-mail address and choose domain.', NULL, '2021-08-31 04:30:11'),
(35, 'Contact Us', 'Contact Us', NULL, '2021-08-13 16:53:23'),
(37, 'Contact Description', 'We’re here to help and answer any question you might have. <br> We look forward to hearing from you 🙂', NULL, '2021-08-13 16:55:03'),
(38, 'Emails Created', 'Emails Created', NULL, NULL),
(39, 'Messages Received', 'Messages Received', NULL, NULL),
(40, 'Cookie Message', 'Your experience on this site will be improved by allowing cookies.', NULL, '2021-08-23 23:05:39'),
(41, 'Cookie Button', 'Allow cookies', NULL, '2021-08-23 23:05:39'),
(42, 'Homepage Title', 'Trash Mails', NULL, '2021-08-31 04:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `trash_mails`
--

CREATE TABLE `trash_mails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_in` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `avater` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translates`
--
ALTER TABLE `translates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trash_mails`
--
ALTER TABLE `trash_mails`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translates`
--
ALTER TABLE `translates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `trash_mails`
--
ALTER TABLE `trash_mails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
