-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2020 at 05:00 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_etalase`
--

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `id` int(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `app_icon` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `eu_sdk_version` varchar(255) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `rate` float DEFAULT NULL,
  `version` varchar(11) DEFAULT NULL,
  `file_size` varchar(32) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `updates_description` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `apk_file` varchar(255) DEFAULT NULL,
  `expansion_file` varchar(255) DEFAULT NULL,
  `media` varchar(255) NOT NULL,
  `developer_id` int(20) DEFAULT NULL,
  `is_approve` tinyint(4) DEFAULT NULL,
  `reject_reason` text DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `is_partnership` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `apps`
--

INSERT INTO `apps` (`id`, `name`, `type`, `app_icon`, `category_id`, `eu_sdk_version`, `package_name`, `rate`, `version`, `file_size`, `description`, `updates_description`, `link`, `apk_file`, `expansion_file`, `media`, `developer_id`, `is_approve`, `reject_reason`, `is_active`, `is_partnership`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 'detik', 'Hiburan', 'app_icon_detik_.jpg', 2, '', '', 4, NULL, NULL, 'detikcom kini hadir dengan tampilan baru!\r\nSegera install atau update aplikasi detikcom untuk mendapatkan pengalaman terbaik dalam membaca berita terbaru & terlengkap sekaligus untuk memenuhi kebutuhan gaya hidup digital Anda.\r\n\r\nTidak hanya sekedar memberikan informasi, aplikasi detikcom berinovasi menyediakan berbagai macam layanan yang dapat memberikan kemudahan dalam melakukan transaksi, seperti: membeli tiket Trans Studio, Trans Snow World serta mendapatkan beragam informasi acara dan promo - promo menarik.\r\n\r\nBerikut ini fitur - fitur unggulan aplikasi detikcom:\r\n\r\nKategori\r\nBeragam konten menarik dari berbagai kategori, seperti: berita politik nasional, sepakbola, ekonomi & bisnis, gosip selebriti, teknologi terkini, gaya hidup sehat, kuliner kekinian, destinasi wisata, fashion dan otomotif.\r\n\r\nBreaking news\r\nNikmati siaran langsung dari berbagai isu penting\r\n\r\nTag Terpopuler\r\nKumpulan isu terkini yang ramai diperbincangkan\r\n\r\nVideo\r\nBeragam video eksklusif yang dikemas secara informatif, menghibur & menginspirasi\r\n\r\nBerita Daerah\r\nPilih provinsi pada \"Berita Daerah\" untuk dapat mengikuti peristiwa terkini di daerah Anda.\r\n\r\nNight Mode\r\nAktifkan Mode Malam untuk pengalaman membaca yang lebih nyaman pada malam hari.\r\n\r\nKami menghargai saran dan komentar anda, kirim ke info@detik.com', NULL, NULL, NULL, NULL, '', 58, 2, 'test', 1, NULL, '2020-08-18 12:57:23', 0, '2020-09-08 03:38:25', NULL),
(3, 'detik', 'Hiburan', 'app_icon_detik_.jpg', 2, '22', 'org.detikcom.rss', 4, '6.1.4', '18831941', 'detikcom kini hadir dengan tampilan baru!\r\nSegera install atau update aplikasi detikcom untuk mendapatkan pengalaman terbaik dalam membaca berita terbaru & terlengkap sekaligus untuk memenuhi kebutuhan gaya hidup digital Anda.\r\n\r\nTidak hanya sekedar memberikan informasi, aplikasi detikcom berinovasi menyediakan berbagai macam layanan yang dapat memberikan kemudahan dalam melakukan transaksi, seperti: membeli tiket Trans Studio, Trans Snow World serta mendapatkan beragam informasi acara dan promo - promo menarik.\r\n\r\nBerikut ini fitur - fitur unggulan aplikasi detikcom:\r\n\r\nKategori\r\nBeragam konten menarik dari berbagai kategori, seperti: berita politik nasional, sepakbola, ekonomi & bisnis, gosip selebriti, teknologi terkini, gaya hidup sehat, kuliner kekinian, destinasi wisata, fashion dan otomotif.\r\n\r\nBreaking news\r\nNikmati siaran langsung dari berbagai isu penting\r\n\r\nTag Terpopuler\r\nKumpulan isu terkini yang ramai diperbincangkan\r\n\r\nVideo\r\nBeragam video eksklusif yang dikemas secara informatif, menghibur & menginspirasi\r\n\r\nBerita Daerah\r\nPilih provinsi pada \"Berita Daerah\" untuk dapat mengikuti peristiwa terkini di daerah Anda.\r\n\r\nNight Mode\r\nAktifkan Mode Malam untuk pengalaman membaca yang lebih nyaman pada malam hari.\r\n\r\nKami menghargai saran dan komentar anda, kirim ke info@detik.com', NULL, NULL, 'detik_3.apk', NULL, '{\"media1\":\"media_3_detik_1.jpg\",\"media2\":\"media_3_detik_2.jpg\",\"media3\":\"media_3_detik_3.jpg\",\"media4\":\"media_3_detik_4.jpg\",\"media5\":\"media_3_detik_5.jpg\",\"media6\":\"media_3_detik_6.jpg\"}', 59, 1, '', 1, NULL, '2020-08-18 13:12:54', 0, '2020-09-09 11:12:12', 0),
(9, 'elsa', 'Games', 'app_icon_.jpg', 1, '16', 'com.example.rezkyflutter', 17, '1.0.0', '20494478', 'ok', 'ok', NULL, 'apps_9.apk', NULL, '{\"media1\":\"media_9_1.jpg\",\"media2\":\"media_9_2.jpg\"}', 73, 1, '', 1, NULL, '2020-09-11 17:21:35', 0, '2020-09-11 17:22:09', 0),
(10, 'parts tracking', 'Games', 'app_icon_parts_tracking.jpg', 2, '16', 'com.example.rezkyflutter', 19, '1.0.0', '20494478', 'ok', 'ok', NULL, 'apps_10.apk', NULL, '{\"media1\":\"media_10_1.jpg\",\"media2\":\"media_10_2.jpg\"}', 73, 0, '', 1, NULL, '2020-09-11 18:27:55', 0, '2020-09-11 18:28:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `download_apps`
--

CREATE TABLE `download_apps` (
  `id` int(20) NOT NULL,
  `apps_id` int(20) DEFAULT NULL,
  `end_users_id` int(20) DEFAULT NULL,
  `clicked` int(20) DEFAULT NULL,
  `installed` int(20) DEFAULT NULL,
  `version` varchar(32) NOT NULL,
  `clicked_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `download_apps`
--

INSERT INTO `download_apps` (`id`, `apps_id`, `end_users_id`, `clicked`, `installed`, `version`, `clicked_at`, `created_at`, `updated_at`) VALUES
(1, 3, 57, NULL, NULL, '', '2020-09-09 10:22:44', '2020-08-12 10:22:44', '2020-09-09 10:32:24'),
(2, 2, 57, NULL, NULL, '', '2020-09-09 10:23:01', '2020-09-09 10:23:01', '2020-09-09 10:23:01'),
(3, 3, 62, NULL, NULL, '', '2020-09-09 10:23:01', '2020-09-09 10:23:01', '2020-09-10 14:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_07_20_203215_create_mst_countries_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_ads`
--

CREATE TABLE `mst_ads` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `orders` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(20) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_ads`
--

INSERT INTO `mst_ads` (`id`, `picture`, `name`, `link`, `orders`, `created_at`, `created_by`, `status`, `updated_by`, `updated_at`) VALUES
(3, 'image_ads_putris_3.jpg', 'putris', 'www.pe.com', '3', '2020-09-02 02:21:03', 1, '1', 53, '2020-09-07 14:55:09'),
(4, 'image_ads_testet_.jpg', 'testet', 'tes.com', '1', '2020-09-07 12:59:28', 53, '1', NULL, '2020-09-07 12:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `mst_category`
--

CREATE TABLE `mst_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_category`
--

INSERT INTO `mst_category` (`id`, `name`, `icon`) VALUES
(1, 'Puzzle', 'puzzle.png'),
(2, 'Action', 'action.png'),
(3, 'RPG', 'rpg.png');

-- --------------------------------------------------------

--
-- Table structure for table `mst_countries`
--

CREATE TABLE `mst_countries` (
  `id` int(11) NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `mst_countries`
--

INSERT INTO `mst_countries` (`id`, `country`) VALUES
(1, 'Indonesia'),
(2, 'Malaysia');

-- --------------------------------------------------------

--
-- Table structure for table `mst_sdk`
--

CREATE TABLE `mst_sdk` (
  `id` int(11) NOT NULL,
  `sdk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_sdk`
--

INSERT INTO `mst_sdk` (`id`, `sdk`) VALUES
(1, '28'),
(2, '29');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `to_users_id` int(20) DEFAULT NULL,
  `from_users_id` int(20) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `apps_id` int(20) DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `to_users_id`, `from_users_id`, `content`, `apps_id`, `read_at`, `created_at`, `updated_at`) VALUES
(2, 59, 58, 'Mendapatkan Feedback dari', 3, '2020-09-11 17:05:27', '2020-09-07 15:48:52', '2020-09-11 17:05:27'),
(16, 59, 53, 'elsa Approved oleh dwibagus97@gmail.com', 7, '2020-09-11 17:05:27', '2020-09-08 16:06:43', '2020-09-11 17:05:27'),
(17, 59, 53, 'test Rejected oleh dwibagus97@gmail.com', 8, '2020-09-11 17:05:27', '2020-09-08 16:06:58', '2020-09-11 17:05:27'),
(18, 59, 53, '<b>elsa </b> Deleted oleh dwibagus97@gmail.com', NULL, '2020-09-11 17:05:27', '2020-09-08 16:07:05', '2020-09-11 17:05:27'),
(19, 59, 59, 'test Deleted oleh bagus@gmail.com', NULL, '2020-09-11 17:05:27', '2020-09-08 16:11:05', '2020-09-11 17:05:27'),
(20, 59, 59, 'detik di Reply oleh', 3, '2020-09-11 17:05:27', '2020-09-10 07:45:31', '2020-09-11 17:05:27'),
(21, 59, 59, 'detik di Reply oleh user', 3, '2020-09-11 17:05:27', '2020-09-10 07:45:31', '2020-09-11 17:05:27'),
(22, 59, 59, 'detik di Reply oleh user1', 3, '2020-09-11 17:05:27', '2020-09-10 07:45:31', '2020-09-11 17:05:27');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(20) NOT NULL,
  `apps_id` int(20) DEFAULT NULL,
  `end_users_id` int(20) DEFAULT NULL,
  `ratings` float DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `users_dev_id` int(20) DEFAULT NULL,
  `reply` text DEFAULT NULL,
  `comment_at` timestamp NULL DEFAULT current_timestamp(),
  `reply_at` timestamp NULL DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `apps_id`, `end_users_id`, `ratings`, `comment`, `users_dev_id`, `reply`, `comment_at`, `reply_at`, `read_at`, `updated_at`) VALUES
(1, 3, 57, 4, 'Ok lah', 59, 'ok bro lhh', '2020-08-28 16:22:17', '2020-09-08 02:34:24', '2020-08-28 16:22:17', '2020-09-08 02:34:24'),
(2, 3, 60, 5, 'Oke lah', 59, 'test', '2020-08-28 16:22:49', '2020-09-10 07:45:31', '2020-08-28 16:22:49', '2020-09-10 07:45:31'),
(3, 2, 61, 3, 'Cukup', 58, NULL, '2020-08-28 16:23:10', '2020-08-28 16:23:10', '2020-08-28 16:23:10', '2020-08-28 17:22:52');

-- --------------------------------------------------------

--
-- Table structure for table `reset_password_token`
--

CREATE TABLE `reset_password_token` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `reset_password_token`
--

INSERT INTO `reset_password_token` (`email`, `token`, `expired_at`, `updated_at`, `created_at`) VALUES
('mchrezky@gmail.com', '8a12f4e532cc771b48e25ed4ea8319e4', '2020-07-22 15:48:01', '2020-07-22 14:48:03', '2020-07-22 14:48:03'),
('mchrezky@gmail.com', '24617d47253bd023a1e6ebb2c5d147d8', '2020-08-11 17:48:44', '2020-08-11 16:48:50', '2020-08-11 16:48:50'),
('mchrezky@gmail.com', '9c2127c0f7988f8d8d52436cab78307a', '2020-08-16 06:26:03', '2020-08-16 05:26:08', '2020-08-16 05:26:08'),
('bagus@gmail.com', 'caa8ce987634a637b949fd0cc0d2a1e9', '2020-08-16 07:09:50', '2020-08-16 06:09:54', '2020-08-16 06:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `dev_web` varchar(255) DEFAULT NULL,
  `dev_country_id` int(11) DEFAULT NULL,
  `dev_address` varchar(255) DEFAULT NULL,
  `eu_birthday` varchar(255) DEFAULT NULL,
  `eu_device_id` varchar(255) DEFAULT NULL,
  `eu_imei1` varchar(255) NOT NULL,
  `eu_imei2` varchar(255) NOT NULL,
  `eu_sdk_version` varchar(255) NOT NULL,
  `eu_device_brand` varchar(255) NOT NULL,
  `eu_device_model` varchar(255) NOT NULL,
  `is_verified` tinyint(4) DEFAULT NULL,
  `is_blocked` tinyint(4) DEFAULT NULL,
  `created_by` int(20) DEFAULT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `notification_id` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `picture`, `role_id`, `token`, `dev_web`, `dev_country_id`, `dev_address`, `eu_birthday`, `eu_device_id`, `eu_imei1`, `eu_imei2`, `eu_sdk_version`, `eu_device_brand`, `eu_device_model`, `is_verified`, `is_blocked`, `created_by`, `updated_by`, `remember_token`, `notification_id`, `created_at`, `updated_at`) VALUES
(1, 'mchrezky', 'mchrezky@gmail.com', '2020-08-11 10:43:33', '$2y$10$HHT/HBpf/pEtXP9TDrbhfeRmYRt7.zFL/p.Lxz8jzLM74AyvmmcrS', 'mchrezky@gmail.comimage_profile.jpg', 1, NULL, NULL, 1, NULL, NULL, '', '', '', '', '', '', NULL, 1, NULL, NULL, NULL, '0', '2020-07-20 00:14:20', '2020-08-16 11:45:15'),
(53, 'dwi bagus', 'dwibagus97@gmail.com', '2020-08-15 02:16:26', '$2y$10$HHT/HBpf/pEtXP9TDrbhfeRmYRt7.zFL/p.Lxz8jzLM74AyvmmcrS', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, 1, NULL, NULL, NULL, '0', '2020-08-15 02:16:26', '2020-08-17 22:36:14'),
(55, 'mchdev1', 'mchdev@yahoo.com', '2020-08-15 02:21:44', '$2y$10$isKVI/.0R0LJSdD6Mq3vHuNlCHCamJwErtwH7fHi8JCGbIquMHMuO', 'mchdev@yahoo.comimage_profile.jpg', 2, NULL, 'mch.id', 1, 'tambun utara', NULL, NULL, '', '', '', '', '', NULL, 1, NULL, NULL, NULL, '0', '2020-08-15 02:21:44', '2020-09-11 17:06:26'),
(56, 'bagustech', 'rizkyslankers89@gmail.com', '2020-08-15 02:28:06', '$2y$10$Oj/1NsOZO6gVd17T7/7sh.Q40RZKMp41WIoMVXfuriKCFr3sLUMdS', 'rizkyslankers89@gmail.comimage_profile.jpg', 2, NULL, 'bagustech.id', 1, 'jakarta', NULL, NULL, '', '', '', '', '', NULL, 1, NULL, NULL, NULL, '0', '2020-08-15 02:28:06', '2020-08-15 02:28:06'),
(57, 'sefiana putris', 'sefianaputri41@gmail.com', '2020-08-15 02:31:03', '$2y$10$HFL1UYwXicGbRenH8dbrS.vwUQZw4bqKNYibNa47XMXN5Ha.ZrF5y', 'sefianaputri41@gmail.comimage_profile.png', 3, NULL, NULL, NULL, NULL, '2020-08-07', NULL, '', '', '', 'Samsung', 'J7 Prime', NULL, 1, NULL, NULL, NULL, '0', '2020-08-15 02:31:03', '2020-09-02 04:13:19'),
(58, 'putri', 'sefia@gmail.com', '2020-08-15 22:41:12', '$2y$10$BFnYyp1BqQJgQplnPpiigORdYL8V1e/D0lWjl1nvYTSeXvMiui1zW', 'sefia@gmail.comimage_profile.jpg', 2, NULL, 'putri', 1, 'putri', NULL, NULL, '', '', '', '', '', NULL, 1, NULL, NULL, NULL, '0', '2020-08-15 22:40:59', '2020-08-15 22:41:12'),
(59, 'bagus', 'bagus@gmail.com', '2020-08-15 23:09:22', '$2y$10$isKVI/.0R0LJSdD6Mq3vHuNlCHCamJwErtwH7fHi8JCGbIquMHMuO', 'bagus@gmail.comimage_profile.jpg', 2, NULL, 'bagus', 1, 'bagus', NULL, NULL, '', '', '', '', '', NULL, 1, NULL, NULL, NULL, '0', '2020-08-15 23:09:11', '2020-08-15 23:10:45'),
(60, 'Rafi Zendaris', 'rzendaris@gmail.com', NULL, '$2y$10$RnOarFxDR0xxcriZzBXxSeFvuvi7WZ68UAE/ysGF.zgRLeuLtrFvy', 'rzendaris@gmail.comimage_profile.jpeg', 3, NULL, NULL, NULL, NULL, '2020-01-01', NULL, '', '', '23', '', '', NULL, 1, NULL, NULL, NULL, '0', '2020-08-17 06:40:29', '2020-08-19 14:49:38'),
(61, 'Dwi test end', 'dwi979@yopmail.com', NULL, '$2y$10$exoQSoEO3dZotGufeXSmGevomv..45iFn4zpfGLIoPRmSoGDeeXRC', 'dwi979@yopmail.comimage_profile.png', 3, NULL, NULL, NULL, NULL, '1999-09-09', NULL, '', '', '23', '', '', NULL, 1, NULL, NULL, NULL, '0', '2020-08-17 11:51:29', '2020-08-17 11:51:29'),
(62, 'Yudi', 'yudi@gmail.com', NULL, '$2y$10$kXEBxsw08o92zaf63MpdhONbyJ6XI/h6Mm82WxC8hJPRhXO8gSCZO', 'yudi@gmail.comimage_profile.png', 3, NULL, NULL, NULL, NULL, '2020-08-19', NULL, '', '', '28', '', '', NULL, 1, NULL, NULL, NULL, '0', '2020-08-17 13:06:53', '2020-08-17 13:12:48'),
(63, 'Yustanto Hendro Saputro', 'yustantohendro@gmail.com', '2020-08-18 00:27:01', '$2y$10$4d3fkgZNNUUqjCj3tLMWpeLSgqx6ELWJBGNZyh/Dwl2fZxw1VH4W6', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, 1, NULL, NULL, NULL, '0', '2020-08-18 00:27:01', '2020-08-18 00:27:01'),
(64, 'Yustanto Hendro', 'hendro300481@gmail.com', NULL, '$2y$10$.dcpaYWTK2gVvixvPgfE8e.0Q6.6YqYV4SXVmQVUO5DbmhE.XHuae', 'hendro300481@gmail.comimage_profile.jpeg', 3, NULL, NULL, NULL, NULL, '1981-04-30', NULL, '', '', '26', '', '', NULL, 1, NULL, NULL, NULL, '0', '2020-08-18 07:58:21', '2020-08-18 08:02:46'),
(65, 'arie winata', 'arie_winata@yahoo.com', NULL, '$2y$10$Vm.ntRyHDiwvsv80khLGd.2gDOmjk59hx3ZDWvYNNoQNcOJP7Idma', 'arie_winata@yahoo.comimage_profile.jpeg', 3, NULL, NULL, NULL, NULL, '1982-04-20', NULL, '', '', '28', '', '', NULL, 1, NULL, NULL, NULL, '0', '2020-08-18 10:43:14', '2020-08-18 10:43:29'),
(66, 'Adam Sani', 'adam.sani@ymail.com', NULL, '$2y$10$8f2GZyHRoDJUi9Asta9hF.NLe7/nFYbOJBSLetV9/0E7WKiuh.7dK', 'adam.sani@ymail.comimage_profile.jpg', 3, NULL, NULL, NULL, NULL, '1984-01-25', NULL, '', '', '27', '', '', NULL, 1, NULL, NULL, NULL, '0', '2020-08-18 13:24:38', '2020-08-18 13:26:02'),
(67, 'yudi', 'yudimufti@gmail.com', NULL, '$2y$10$jRq1tVawptcsdmlZuq7t5OCeso1NDSFhfJBzBAV3KDUAx/TOa7LnG', 'yudimufti@gmail.comimage_profile.jpg', 3, NULL, NULL, NULL, NULL, '2020-08-14', NULL, '', '', '28', '', '', NULL, 1, NULL, NULL, NULL, '0', '2020-08-19 15:31:13', '2020-08-19 15:31:28'),
(68, 'Rafi Zendaris', 'rzendaris123@gmail.com', NULL, '$2y$10$D5M0cczDYJrc6OY0GUr93.AB9u72rQWg81fOpujT/.5GI1xxRC2z2', 'Picture doesnt exist', 3, NULL, NULL, NULL, NULL, '2020-01-01', NULL, '', '', '23', '', '', NULL, 1, NULL, NULL, NULL, '0', '2020-08-20 14:39:08', '2020-08-20 14:39:08'),
(69, 'Yudi', 'yudi13@gmail.com', NULL, '$2y$10$naDxGYE1toe.BkQvwYWlV.k93PYG9Z/rG8fOEstjfu7NCKuKeZdce', 'Picture doesnt exist', 3, NULL, NULL, NULL, NULL, '2020-08-13', NULL, '', '', '28', '', '', NULL, 1, NULL, NULL, NULL, '0', '2020-08-20 14:43:08', '2020-08-20 14:43:30'),
(70, 'dwi', 'dwi@yopmail.com', NULL, '$2y$10$DL13kMiE.ta9NSzu2tKHSu1hSDjRxUfWkMXxnnWxkSSILkse.eNka', 'Picture doesnt exist', 3, NULL, NULL, NULL, NULL, '2020-08-20', NULL, '', '', '24', '', '', NULL, 1, NULL, NULL, NULL, '0', '2020-08-20 15:03:54', '2020-08-20 15:04:05'),
(71, 'dwi', 'dwi77@yopmail.com', NULL, '$2y$10$k9v2/amptyFxeEDb.d1BeuFS6RpSDFpVojyVILAunQFFvOSlYLi9.', 'Picture doesnt exist', 3, NULL, NULL, NULL, NULL, '2020-08-20', NULL, '', '', '24', '', '', NULL, 1, NULL, NULL, NULL, '0', '2020-08-20 15:05:57', '2020-08-20 15:06:09'),
(72, 'bima', 'bima@gmail.com', NULL, '$2y$10$hHyHTtgBwuEgGus7wOsvtOWNCvGAFi7j6XJxy5lht88L/CguzfNCq', 'bima@gmail.comimage_profile.jpg', 2, NULL, 'bima.com', 1, 'test', NULL, NULL, '', '', '', '', '', NULL, 1, NULL, NULL, NULL, '', '2020-09-10 14:56:03', '2020-09-10 15:13:41'),
(73, 'ikraith', 'info.semnas-ikraith.com', '2020-09-11 17:12:23', '$2y$10$DKNb2dn9Zu.HwG4at1o32.9IY33jV72aFr2GWHcoi/AjSwWIheNJq', 'info.semnas-ikraith.comimage_profile.jpg', 2, NULL, 'semnas-ikraith.com', 1, 'oko', NULL, NULL, '', '', '', '', '', NULL, 1, NULL, NULL, NULL, '', '2020-09-11 17:12:23', '2020-09-11 17:12:23');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_avg_ratings`
-- (See below for the actual view)
--
CREATE TABLE `view_avg_ratings` (
`avg_ratings` double
,`id` int(20)
,`name` varchar(255)
,`type` varchar(255)
,`app_icon` varchar(255)
,`category_id` int(11)
,`eu_sdk_version` varchar(255)
,`package_name` varchar(255)
,`rate` float
,`version` varchar(11)
,`file_size` varchar(32)
,`description` text
,`updates_description` text
,`link` varchar(255)
,`apk_file` varchar(255)
,`expansion_file` varchar(255)
,`media` varchar(255)
,`developer_id` int(20)
,`is_approve` tinyint(4)
,`reject_reason` text
,`is_active` tinyint(4)
,`is_partnership` tinyint(4)
,`created_at` timestamp
,`created_by` int(20)
,`updated_at` timestamp
,`updated_by` int(20)
);

-- --------------------------------------------------------

--
-- Structure for view `view_avg_ratings`
--
DROP TABLE IF EXISTS `view_avg_ratings`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_avg_ratings`  AS  select avg(`a`.`ratings`) AS `avg_ratings`,`b`.`id` AS `id`,`b`.`name` AS `name`,`b`.`type` AS `type`,`b`.`app_icon` AS `app_icon`,`b`.`category_id` AS `category_id`,`b`.`eu_sdk_version` AS `eu_sdk_version`,`b`.`package_name` AS `package_name`,`b`.`rate` AS `rate`,`b`.`version` AS `version`,`b`.`file_size` AS `file_size`,`b`.`description` AS `description`,`b`.`updates_description` AS `updates_description`,`b`.`link` AS `link`,`b`.`apk_file` AS `apk_file`,`b`.`expansion_file` AS `expansion_file`,`b`.`media` AS `media`,`b`.`developer_id` AS `developer_id`,`b`.`is_approve` AS `is_approve`,`b`.`reject_reason` AS `reject_reason`,`b`.`is_active` AS `is_active`,`b`.`is_partnership` AS `is_partnership`,`b`.`created_at` AS `created_at`,`b`.`created_by` AS `created_by`,`b`.`updated_at` AS `updated_at`,`b`.`updated_by` AS `updated_by` from (`apps` `b` left join `ratings` `a` on(`a`.`apps_id` = `b`.`id`)) group by `b`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `developer_id` (`developer_id`),
  ADD KEY `apps_ibfk_2` (`category_id`);

--
-- Indexes for table `download_apps`
--
ALTER TABLE `download_apps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apps_id` (`apps_id`),
  ADD KEY `end_users_id` (`end_users_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_ads`
--
ALTER TABLE `mst_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_category`
--
ALTER TABLE `mst_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_countries`
--
ALTER TABLE `mst_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_sdk`
--
ALTER TABLE `mst_sdk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifikasi_apps_ibfk_1` (`apps_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `end_users_id` (`end_users_id`),
  ADD KEY `users_dev_id` (`users_dev_id`),
  ADD KEY `ratings_ibfk_1` (`apps_id`);

--
-- Indexes for table `reset_password_token`
--
ALTER TABLE `reset_password_token`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `dev_country_id` (`dev_country_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `download_apps`
--
ALTER TABLE `download_apps`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_ads`
--
ALTER TABLE `mst_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mst_category`
--
ALTER TABLE `mst_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_countries`
--
ALTER TABLE `mst_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_sdk`
--
ALTER TABLE `mst_sdk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apps`
--
ALTER TABLE `apps`
  ADD CONSTRAINT `apps_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `mst_category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `apps_ibfk_3` FOREIGN KEY (`developer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `download_apps`
--
ALTER TABLE `download_apps`
  ADD CONSTRAINT `download_apps_ibfk_1` FOREIGN KEY (`apps_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `download_apps_ibfk_2` FOREIGN KEY (`end_users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`apps_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`end_users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_3` FOREIGN KEY (`users_dev_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`dev_country_id`) REFERENCES `mst_countries` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
