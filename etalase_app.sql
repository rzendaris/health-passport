-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jul 2020 pada 21.44
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `etalase_app`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `apps`
--

CREATE TABLE `apps` (
  `id` int(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `app_icon` varchar(255) DEFAULT NULL,
  `sdk_target_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `version` varchar(11) DEFAULT NULL,
  `file_size` varchar(32) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `updates_description` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `apk_file` varchar(255) DEFAULT NULL,
  `expansion_file` varchar(255) DEFAULT NULL,
  `developer_id` int(20) DEFAULT NULL,
  `is_approve` tinyint(4) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `is_partnership` tinyint(4) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `created_by` int(20) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `updated_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `download_apps`
--

CREATE TABLE `download_apps` (
  `id` int(20) NOT NULL,
  `apps_id` int(20) DEFAULT NULL,
  `end_users_id` int(20) DEFAULT NULL,
  `clicked` int(20) DEFAULT NULL,
  `installed` int(20) DEFAULT NULL,
  `version` varchar(32) NOT NULL,
  `clicked_at` timestamp NULL DEFAULT current_timestamp(),
  `installed_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_07_20_203215_create_mst_countries_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_ads`
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_category`
--

CREATE TABLE `mst_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_countries`
--

CREATE TABLE `mst_countries` (
  `id` int(11) NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mst_countries`
--

INSERT INTO `mst_countries` (`id`, `country`) VALUES
(1, 'Indonesia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_sdk`
--

CREATE TABLE `mst_sdk` (
  `id` int(11) NOT NULL,
  `sdk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ratings`
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
  `reply_at` timestamp NULL DEFAULT current_timestamp(),
  `read_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dev_web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dev_country_id` int(11) DEFAULT NULL,
  `dev_adrress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eu_birthday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eu_device_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(4) DEFAULT NULL,
  `is_blocked` tinyint(4) DEFAULT NULL,
  `created_by` int(20) DEFAULT NULL,
  `updated_by` int(20) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `picture`, `role_id`, `token`, `dev_web`, `dev_country_id`, `dev_adrress`, `eu_birthday`, `eu_device_id`, `is_verified`, `is_blocked`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'mchrezky', 'mchrezky@gmail.com', NULL, '$2y$10$5BrRLJQDItQ2VKXBKbqkMuNkxozmoi2qNyjFwRjXFfCcBUBLWn1nS', NULL, 1, NULL, NULL, 1, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2020-07-20 07:14:20', '2020-07-20 07:14:20');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sdk_target_id` (`sdk_target_id`),
  ADD KEY `developer_id` (`developer_id`),
  ADD KEY `apps_ibfk_2` (`category_id`);

--
-- Indeks untuk tabel `download_apps`
--
ALTER TABLE `download_apps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apps_id` (`apps_id`),
  ADD KEY `end_users_id` (`end_users_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mst_ads`
--
ALTER TABLE `mst_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mst_category`
--
ALTER TABLE `mst_category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mst_countries`
--
ALTER TABLE `mst_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mst_sdk`
--
ALTER TABLE `mst_sdk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apps_id` (`apps_id`),
  ADD KEY `end_users_id` (`end_users_id`),
  ADD KEY `users_dev_id` (`users_dev_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `dev_country_id` (`dev_country_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `apps`
--
ALTER TABLE `apps`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `download_apps`
--
ALTER TABLE `download_apps`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `mst_ads`
--
ALTER TABLE `mst_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mst_category`
--
ALTER TABLE `mst_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mst_countries`
--
ALTER TABLE `mst_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mst_sdk`
--
ALTER TABLE `mst_sdk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `apps`
--
ALTER TABLE `apps`
  ADD CONSTRAINT `apps_ibfk_1` FOREIGN KEY (`sdk_target_id`) REFERENCES `mst_sdk` (`id`),
  ADD CONSTRAINT `apps_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `mst_category` (`id`),
  ADD CONSTRAINT `apps_ibfk_3` FOREIGN KEY (`developer_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `download_apps`
--
ALTER TABLE `download_apps`
  ADD CONSTRAINT `download_apps_ibfk_1` FOREIGN KEY (`apps_id`) REFERENCES `apps` (`id`),
  ADD CONSTRAINT `download_apps_ibfk_2` FOREIGN KEY (`end_users_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`apps_id`) REFERENCES `apps` (`id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`end_users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ratings_ibfk_3` FOREIGN KEY (`users_dev_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`dev_country_id`) REFERENCES `mst_countries` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
