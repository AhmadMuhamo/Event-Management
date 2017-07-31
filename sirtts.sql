-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2017 at 11:43 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sirtts`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sirtts_dependents`
--

CREATE TABLE `sirtts_dependents` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sirtts_events`
--

CREATE TABLE `sirtts_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fees` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sirtts_fees`
--

CREATE TABLE `sirtts_fees` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applicants` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sirtts_password_resets`
--

CREATE TABLE `sirtts_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sirtts_payments`
--

CREATE TABLE `sirtts_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `payer_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refund_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sirtts_payments_details`
--

CREATE TABLE `sirtts_payments_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `dependent_id` int(10) UNSIGNED DEFAULT NULL,
  `course` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fees` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sirtts_registration_events`
--

CREATE TABLE `sirtts_registration_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fees` double(8,2) NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sirtts_subscribers`
--

CREATE TABLE `sirtts_subscribers` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `dependent_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sirtts_users`
--

CREATE TABLE `sirtts_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sirtts_user_activation`
--

CREATE TABLE `sirtts_user_activation` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sirtts_user_details`
--

CREATE TABLE `sirtts_user_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `primary_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_line2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sirtts_dependents`
--
ALTER TABLE `sirtts_dependents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sirtts_dependents_email_unique` (`email`),
  ADD KEY `sirtts_dependents_user_id_foreign` (`user_id`);

--
-- Indexes for table `sirtts_events`
--
ALTER TABLE `sirtts_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sirtts_fees`
--
ALTER TABLE `sirtts_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sirtts_fees_event_id_foreign` (`event_id`);

--
-- Indexes for table `sirtts_password_resets`
--
ALTER TABLE `sirtts_password_resets`
  ADD KEY `sirtts_password_resets_email_index` (`email`),
  ADD KEY `sirtts_password_resets_token_index` (`token`);

--
-- Indexes for table `sirtts_payments`
--
ALTER TABLE `sirtts_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sirtts_payments_user_id_foreign` (`user_id`),
  ADD KEY `sirtts_payments_event_id_foreign` (`event_id`);

--
-- Indexes for table `sirtts_payments_details`
--
ALTER TABLE `sirtts_payments_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sirtts_payments_details_event_id_foreign` (`event_id`),
  ADD KEY `sirtts_payments_details_user_id_foreign` (`user_id`),
  ADD KEY `sirtts_payments_details_dependent_id_foreign` (`dependent_id`);

--
-- Indexes for table `sirtts_registration_events`
--
ALTER TABLE `sirtts_registration_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sirtts_subscribers`
--
ALTER TABLE `sirtts_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sirtts_subscribers_event_id_foreign` (`event_id`),
  ADD KEY `sirtts_subscribers_user_id_foreign` (`user_id`),
  ADD KEY `sirtts_subscribers_dependent_id_foreign` (`dependent_id`);

--
-- Indexes for table `sirtts_users`
--
ALTER TABLE `sirtts_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sirtts_users_email_unique` (`email`);

--
-- Indexes for table `sirtts_user_activation`
--
ALTER TABLE `sirtts_user_activation`
  ADD KEY `sirtts_user_activation_token_index` (`token`);

--
-- Indexes for table `sirtts_user_details`
--
ALTER TABLE `sirtts_user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sirtts_user_details_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `sirtts_dependents`
--
ALTER TABLE `sirtts_dependents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sirtts_events`
--
ALTER TABLE `sirtts_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sirtts_fees`
--
ALTER TABLE `sirtts_fees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sirtts_payments`
--
ALTER TABLE `sirtts_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sirtts_payments_details`
--
ALTER TABLE `sirtts_payments_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sirtts_registration_events`
--
ALTER TABLE `sirtts_registration_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sirtts_subscribers`
--
ALTER TABLE `sirtts_subscribers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sirtts_users`
--
ALTER TABLE `sirtts_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sirtts_user_details`
--
ALTER TABLE `sirtts_user_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `sirtts_dependents`
--
ALTER TABLE `sirtts_dependents`
  ADD CONSTRAINT `sirtts_dependents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `sirtts_users` (`id`);

--
-- Constraints for table `sirtts_fees`
--
ALTER TABLE `sirtts_fees`
  ADD CONSTRAINT `sirtts_fees_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `sirtts_events` (`id`);

--
-- Constraints for table `sirtts_payments`
--
ALTER TABLE `sirtts_payments`
  ADD CONSTRAINT `sirtts_payments_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `sirtts_events` (`id`),
  ADD CONSTRAINT `sirtts_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `sirtts_users` (`id`);

--
-- Constraints for table `sirtts_payments_details`
--
ALTER TABLE `sirtts_payments_details`
  ADD CONSTRAINT `sirtts_payments_details_dependent_id_foreign` FOREIGN KEY (`dependent_id`) REFERENCES `sirtts_dependents` (`id`),
  ADD CONSTRAINT `sirtts_payments_details_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `sirtts_events` (`id`),
  ADD CONSTRAINT `sirtts_payments_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `sirtts_users` (`id`);

--
-- Constraints for table `sirtts_subscribers`
--
ALTER TABLE `sirtts_subscribers`
  ADD CONSTRAINT `sirtts_subscribers_dependent_id_foreign` FOREIGN KEY (`dependent_id`) REFERENCES `sirtts_dependents` (`id`),
  ADD CONSTRAINT `sirtts_subscribers_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `sirtts_events` (`id`),
  ADD CONSTRAINT `sirtts_subscribers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `sirtts_users` (`id`);

--
-- Constraints for table `sirtts_user_details`
--
ALTER TABLE `sirtts_user_details`
  ADD CONSTRAINT `sirtts_user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `sirtts_users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
