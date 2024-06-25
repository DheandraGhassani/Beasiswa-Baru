-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 12:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beasiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(12, 'admin', 'admin@gmail.com', NULL, '$2y$10$HhWdTTUFgNwkFcZ2b2weLOfRm6udx6mregZjfRgfrIEag6cJI/mO.', NULL, '2024-06-24 03:20:22', '2024-06-24 03:20:22'),
(13, 'jason', 'jason@gmail.com', NULL, '$2y$10$4lnWaEKJpHJgu3J.ZYWImOM5r0xC2CcOVFUqmcJsx5NAc1/ZKneXi', NULL, '2024-06-24 03:20:45', '2024-06-24 03:20:45'),
(14, 'prodiTI', 'prodiTI@gmail.com', NULL, '$2y$10$qx99Xm7PgqaCqmwzpowmHeGwp6.rpLNPv8x1IPx.HRb2qgPi4AOIa', NULL, '2024-06-24 03:21:04', '2024-06-24 03:21:04'),
(15, 'Teknologi informasi', 'fit@gmail.com', NULL, '$2y$10$q7wvhsSbfT73.VXqt9G3ZebpG3imuljsTIz7m4vZ3o7WJKOMaBOVO', NULL, '2024-06-24 03:21:26', '2024-06-24 03:21:26');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
