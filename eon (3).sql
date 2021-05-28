-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2021 at 01:55 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eon`
--

-- --------------------------------------------------------

--
-- Table structure for table `adrs`
--

CREATE TABLE `adrs` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_visit_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `patient_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `drug_id` int(11) UNSIGNED NOT NULL,
  `drug_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reaction_id` int(11) UNSIGNED DEFAULT NULL,
  `reaction_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adrs`
--

INSERT INTO `adrs` (`id`, `patient_visit_id`, `practitioner_id`, `practitioner_name`, `patient_id`, `patient_name`, `drug_id`, `drug_name`, `reaction_id`, `reaction_name`, `created_at`, `updated_at`) VALUES
(6, 4, 10, 'Dr. S. Abbas Raza', 24, 'Mr. John Doe', 69, 'Acarbose', NULL, NULL, '2020-10-08 06:00:24', '2020-10-08 06:00:24'),
(7, 4, 10, 'Dr. S. Abbas Raza', 24, 'Mr. John Doe', 8, 'Amlodipine', NULL, NULL, '2020-10-08 06:00:24', '2020-10-08 06:00:24'),
(8, 17, 11, 'Prof. Ali Jawa', 44, 'Shahzad Jamil Jafferi', 5, 'Nkda', NULL, NULL, '2020-10-14 17:52:09', '2020-10-14 17:52:09'),
(9, 39, 12, 'Dr. Kamran Babar', 51, 'Ali Talib', 5, 'Nkda', NULL, NULL, '2020-11-04 16:39:22', '2020-11-04 16:39:22'),
(10, 13, 10, 'Dr. Abdullah', 34, 'Muhammad Waqas', 69, 'Acarbose', NULL, NULL, '2020-12-10 09:23:31', '2020-12-10 09:23:31'),
(11, 13, 10, 'Dr. Abdullah', 34, 'Muhammad Waqas', 10, 'Antitetanus Serum', NULL, NULL, '2020-12-10 09:23:31', '2020-12-10 09:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `adr_reactions`
--

CREATE TABLE `adr_reactions` (
  `id` int(11) UNSIGNED NOT NULL,
  `adr_id` int(11) UNSIGNED NOT NULL,
  `reaction_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adr_reactions`
--

INSERT INTO `adr_reactions` (`id`, `adr_id`, `reaction_id`, `created_at`, `updated_at`) VALUES
(43, 6, 102, '2020-10-08 06:00:24', '2020-10-08 06:00:24'),
(44, 6, 104, '2020-10-08 06:00:24', '2020-10-08 06:00:24'),
(45, 7, 106, '2020-10-08 06:00:24', '2020-10-08 06:00:24'),
(46, 7, 107, '2020-10-08 06:00:24', '2020-10-08 06:00:24'),
(47, 8, 164, '2020-10-14 17:52:09', '2020-10-14 17:52:09'),
(48, 9, 164, '2020-11-04 16:39:22', '2020-11-04 16:39:22'),
(49, 10, 102, '2020-12-10 09:23:31', '2020-12-10 09:23:31'),
(50, 10, 104, '2020-12-10 09:23:31', '2020-12-10 09:23:31'),
(51, 10, 106, '2020-12-10 09:23:31', '2020-12-10 09:23:31'),
(52, 11, 164, '2020-12-10 09:23:31', '2020-12-10 09:23:31'),
(53, 11, 105, '2020-12-10 09:23:31', '2020-12-10 09:23:31'),
(54, 11, 162, '2020-12-10 09:23:31', '2020-12-10 09:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `agora_tokens`
--

CREATE TABLE `agora_tokens` (
  `id` bigint(20) NOT NULL,
  `token` varchar(500) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agora_tokens`
--

INSERT INTO `agora_tokens` (`id`, `token`, `status`, `created_at`, `updated_at`) VALUES
(1, '0063deca978d0d440b388247ce9795a24e3IAALmLA5VALRoR2dqQNMO2XcWVQDncUzTLlv82QFU7Q/yZpjTicAAAAAIgAYbAEAhXfUXwQAAQCFd9RfAwCFd9RfAgCFd9RfBACFd9Rf', 1, '2020-11-12 06:42:24', '2020-12-11 07:55:49');

-- --------------------------------------------------------

--
-- Table structure for table `allergies`
--

CREATE TABLE `allergies` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `allergies`
--

INSERT INTO `allergies` (`id`, `title`, `slug`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(4, 'Allergy 1', 'allergy-1', 1, NULL, '2020-10-08 05:36:13', '2020-10-08 05:36:13'),
(5, 'Allergy 2', 'allergy-2', 1, NULL, '2020-10-08 05:36:23', '2020-10-08 05:36:23'),
(6, 'Allergy 3', 'allergy-3', 1, NULL, '2020-10-08 05:36:44', '2020-10-08 05:36:44'),
(7, 'Allergy 4', 'allergy-4', 1, NULL, '2020-10-08 05:36:56', '2020-10-08 05:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `patient_type_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `clinic_id` int(11) UNSIGNED NOT NULL,
  `assistant_id` int(10) UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `time_slot` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `practitioner_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patient_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `early_meeting` tinyint(1) NOT NULL DEFAULT 0,
  `otp` varchar(251) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_in` tinyint(1) NOT NULL DEFAULT 0,
  `practitioner_start` tinyint(1) NOT NULL DEFAULT 0,
  `appointment_complete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `patient_type_id`, `practitioner_id`, `clinic_id`, `assistant_id`, `date`, `time_slot`, `practitioner_url`, `patient_url`, `type`, `status`, `early_meeting`, `otp`, `check_in`, `practitioner_start`, `appointment_complete`, `created_at`, `updated_at`) VALUES
(119, 24, 3, 10, 1, NULL, '2021-04-14', '11:00 am', NULL, NULL, 1, 0, 0, '915328', 0, 0, 0, '2021-03-22 14:08:29', '2021-03-24 06:11:43'),
(120, 24, 3, 10, 1, NULL, '2021-03-23', '11:30 am', NULL, NULL, 1, 0, 0, '703649', 0, 0, 0, '2021-03-22 14:09:59', '2021-03-22 14:09:59'),
(121, 34, 3, 10, 1, NULL, '2021-04-01', '03:40 pm', NULL, NULL, 1, 0, 0, '123456', 0, 1, 0, '2021-04-01 10:32:41', '2021-04-01 10:36:42'),
(122, 24, 1, 10, 1, NULL, '2021-04-14', '11:00 am', NULL, NULL, 1, 0, 0, '928326', 1, 1, 0, '2021-04-13 05:55:39', '2021-04-13 05:55:39'),
(123, 24, 3, 10, 1, NULL, '2021-04-14', '11:00 am', NULL, NULL, 1, 0, 0, NULL, 1, 1, 0, '2021-04-13 06:57:23', '2021-04-13 07:08:37');

-- --------------------------------------------------------

--
-- Table structure for table `assistants`
--

CREATE TABLE `assistants` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification_id` int(11) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assistants`
--

INSERT INTO `assistants` (`id`, `name`, `email`, `phone`, `address`, `description`, `image`, `password`, `qualification_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Muhammad Abdullah', 'abdullah.tektiks@gmail.com', '0344-4462410', 'Test', 'Test', 'assistantImage/AOGaC167jzFpEPdEFK56tCO0mj8F3SvHORR3CKNz.png', '$2y$10$9buDYB8hlNMqtFmisH8CVOzUx5MiTKnaKOj8gR46csAxsNym.CmWC', 2, 1, 'KTGk3HuipuXOQeLMadIffOjWAQeEIvOEwgVE1906Enz16FTgQsu2Kn8DHLMB', '2020-09-03 11:21:03', '2020-12-02 05:39:07');

-- --------------------------------------------------------

--
-- Table structure for table `assistant_specialties`
--

CREATE TABLE `assistant_specialties` (
  `id` int(11) UNSIGNED NOT NULL,
  `assistant_id` int(11) UNSIGNED NOT NULL,
  `specialty_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assistant_specialties`
--

INSERT INTO `assistant_specialties` (`id`, `assistant_id`, `specialty_id`, `created_at`, `updated_at`) VALUES
(5, 2, 1, NULL, NULL),
(6, 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clinics`
--

CREATE TABLE `clinics` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_day` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_day` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_time` time DEFAULT NULL,
  `closing_time` time DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `all_day` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clinics`
--

INSERT INTO `clinics` (`id`, `name`, `email`, `phone`, `address`, `password`, `from_day`, `to_day`, `opening_time`, `closing_time`, `logo`, `all_day`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Online Clinic', 'onlineclinic@gmail.com', '0423-1111111', 'Online Clinic Address', '$2y$10$DlBpumbCmw28w1l1m/zev.Wvh8/IoMSAToQ7LPbJMPxSQa0oOHpSi', NULL, NULL, NULL, NULL, 'clinicImage/vYwZ6r5Ic4HAl8E7vutedp3xA03NwY4Wu8y1zy6h.jpeg', 1, 1, NULL, '2020-09-10 11:20:12', '2020-10-08 05:40:08'),
(2, 'Wilcare', 'clinic2@gmail.com', '0423-7788888', 'Test Address', '$2y$10$iDqR1atqJTR3ji44C0BjAu9WIlZGuyyP7MGRARwsNbZnYGxjNDu/C', 'monday', 'thursday', '20:00:00', '22:00:00', 'clinicImage/nurGMU3yFuxw3fAH8ibJhhUhLvL0C3JqIzNw9MjJ.jpeg', 0, 1, NULL, '2020-09-10 11:21:38', '2020-10-14 14:29:37');

-- --------------------------------------------------------

--
-- Table structure for table `clinic_configs`
--

CREATE TABLE `clinic_configs` (
  `id` int(11) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clinic_id` int(11) UNSIGNED NOT NULL,
  `clinic_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_config_facilities`
--

CREATE TABLE `clinic_config_facilities` (
  `id` int(11) UNSIGNED NOT NULL,
  `clinic_config_id` int(11) UNSIGNED NOT NULL,
  `facility_id` int(11) UNSIGNED NOT NULL,
  `facility_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_config_lab_tests`
--

CREATE TABLE `clinic_config_lab_tests` (
  `id` int(11) UNSIGNED NOT NULL,
  `clinic_config_id` int(11) UNSIGNED NOT NULL,
  `lab_test_id` int(11) UNSIGNED NOT NULL,
  `lab_test_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_config_medications`
--

CREATE TABLE `clinic_config_medications` (
  `id` int(11) UNSIGNED NOT NULL,
  `clinic_config_id` int(11) UNSIGNED NOT NULL,
  `medication_id` int(11) UNSIGNED NOT NULL,
  `medication_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_config_specialties`
--

CREATE TABLE `clinic_config_specialties` (
  `id` int(11) UNSIGNED NOT NULL,
  `clinic_config_id` int(11) UNSIGNED NOT NULL,
  `specialty_id` int(11) UNSIGNED NOT NULL,
  `specialty_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_departments`
--

CREATE TABLE `clinic_departments` (
  `id` int(11) UNSIGNED NOT NULL,
  `clinic_id` int(11) UNSIGNED NOT NULL,
  `department_id` int(11) UNSIGNED NOT NULL,
  `department_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_facilities`
--

CREATE TABLE `clinic_facilities` (
  `id` int(11) UNSIGNED NOT NULL,
  `clinic_id` int(11) UNSIGNED NOT NULL,
  `facility_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clinic_facilities`
--

INSERT INTO `clinic_facilities` (`id`, `clinic_id`, `facility_id`, `created_at`, `updated_at`) VALUES
(2, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clinic_lab_tests`
--

CREATE TABLE `clinic_lab_tests` (
  `id` int(11) UNSIGNED NOT NULL,
  `clinic_id` int(11) UNSIGNED NOT NULL,
  `lab_test_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_medications`
--

CREATE TABLE `clinic_medications` (
  `id` int(11) UNSIGNED NOT NULL,
  `clinic_id` int(11) UNSIGNED NOT NULL,
  `medication_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_specialties`
--

CREATE TABLE `clinic_specialties` (
  `id` int(11) UNSIGNED NOT NULL,
  `clinic_id` int(11) UNSIGNED NOT NULL,
  `specialty_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clinic_specialties`
--

INSERT INTO `clinic_specialties` (`id`, `clinic_id`, `specialty_id`, `created_at`, `updated_at`) VALUES
(3, 2, 1, NULL, NULL),
(4, 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_language` enum('Both','English','Urdu') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'English',
  `generic_medicine` tinyint(1) NOT NULL DEFAULT 0,
  `print_option` tinyint(1) NOT NULL DEFAULT 0,
  `signature_option` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `title`, `slug`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 'Radiology', 'radiology', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(4, 'Endocrinologist And Diabetologist', 'endocrinologist-and-diabetologist', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(5, 'Dermatologist', 'dermatologist', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(6, 'Psychiatrist', 'psychiatrist', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(7, 'Cardiologist', 'cardiologist', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(8, 'Clinical And Interventional Neurologist', 'clinical-and-interventional-neurologist', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(9, 'Rheumatologist', 'rheumatologist', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(10, 'Physiathrist', 'physiathrist', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(11, 'Urologist', 'urologist', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(12, 'Ophthalmologist', 'ophthalmologist', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(13, 'Pediatrician', 'pediatrician', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(14, 'Vascular Surgeon', 'vascular-surgeon', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(15, 'Nephrologist', 'nephrologist', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(16, 'Pediatric Surgeon', 'pediatric-surgeon', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(17, 'General Surgeon', 'general-surgeon', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(18, 'Hepatologist', 'hepatologist', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(19, 'Gastroenterologist', 'gastroenterologist', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(20, 'Bariatric Surgeon', 'bariatric-surgeon', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(21, 'Clinical Dietitian And Nutritionist', 'clinical-dietitian-and-nutritionist', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(22, 'Pulmonologist', 'pulmonologist', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(23, 'Laparoscopic Surgeon', 'laparoscopic-surgeon', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(24, 'ENT Surgeon', 'ent-surgeon', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(25, 'Physician', 'physician', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(26, 'Orthopedic Surgeon', 'orthopedic-surgeon', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(27, 'Psychologist', 'psychologist', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(28, 'Neurosurgeon', 'neurosurgeon', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(29, 'Gynecologist', 'gynecologist', 1, NULL, '2020-10-06 05:59:36', '2020-10-06 05:59:36'),
(30, 'Neuro Physician', 'neuro-physician', 1, NULL, '2020-10-06 05:59:37', '2020-10-06 05:59:37'),
(31, 'Child Psychologist', 'child-psychologist', 1, NULL, '2020-10-06 05:59:37', '2020-10-06 05:59:37'),
(32, 'Skin Care', 'skin-care', 1, NULL, '2020-10-06 05:59:37', '2020-10-06 05:59:37'),
(33, 'Hematologist/Oncologist', 'hematologistoncologist', 1, NULL, '2020-10-06 05:59:37', '2020-10-06 05:59:37'),
(34, 'Andro-urologist', 'andro-urologist', 1, NULL, '2020-10-06 05:59:37', '2020-10-06 05:59:37'),
(35, 'C & D', 'c-d', 1, NULL, '2020-10-06 05:59:37', '2020-10-06 05:59:37');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis_types`
--

CREATE TABLE `diagnosis_types` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diagnosis_types`
--

INSERT INTO `diagnosis_types` (`id`, `type`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 'Acne', 1, NULL, '2020-10-07 00:30:17', '2020-10-07 00:30:17'),
(4, 'Allergy', 1, NULL, '2020-10-07 00:30:17', '2020-10-07 00:30:17'),
(5, 'Anemia', 1, NULL, '2020-10-07 00:30:17', '2020-10-07 00:30:17'),
(6, 'Antibiotic', 1, NULL, '2020-10-07 00:30:17', '2020-10-07 00:30:17'),
(7, 'Antibiotic/Antibacterial/Keratinolytic', 1, NULL, '2020-10-07 00:30:17', '2020-10-07 00:30:17'),
(8, 'Anxiety', 1, NULL, '2020-10-07 00:30:17', '2020-10-07 00:30:17'),
(9, 'Appetite', 1, NULL, '2020-10-07 00:30:17', '2020-10-07 00:30:17'),
(10, 'Arthritis', 1, NULL, '2020-10-07 00:30:17', '2020-10-07 00:30:17'),
(11, 'Asthma', 1, NULL, '2020-10-07 00:30:17', '2020-10-07 00:30:17'),
(12, 'Blood Pressure', 1, NULL, '2020-10-07 00:30:17', '2020-10-07 00:30:17'),
(13, 'Blood Pressure/Cholestrol', 1, NULL, '2020-10-07 00:30:17', '2020-10-07 00:30:17'),
(14, 'Blood Thinner', 1, NULL, '2020-10-07 00:30:17', '2020-10-07 00:30:17'),
(15, 'Bone Weakness', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(16, 'Burning Of Feet', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(17, 'Calcium', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(18, 'Cholesterol', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(19, 'Constipation', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(20, 'Cough', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(21, 'Depression', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(22, 'Diabetes', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(23, 'Diarrhea', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(24, 'Dizziness', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(25, 'Duphaly', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(26, 'Emphysema', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(27, 'Flu Prevention', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(28, 'Headache', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(29, 'Height', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(30, 'Hepatitis', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(31, 'Hepatitis A Prevention', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(32, 'Hepatitis B Prevention', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(33, 'Infection', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(34, 'Insomnia', 1, NULL, '2020-10-07 00:30:18', '2020-10-07 00:30:18'),
(35, 'Malaria', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(36, 'Memory', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(37, 'Migraine', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(38, 'Multivitamin', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(39, 'Oral Contraception', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(40, 'Pain', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(41, 'Pain In Feet', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(42, 'Palpitations', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(43, 'Parkinsons Disease', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(44, 'Prostate', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(45, 'Psoriasis', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(46, 'Stomach', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(47, 'Thyroid', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(48, 'To Prevent Meningitis', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(49, 'To Prevent Pneumonia', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(50, 'To Prevent Polio', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(51, 'To Prevent Tetanus', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(52, 'Tuberculosis', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(53, 'Uric Acid', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(54, 'Vaccine', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(55, 'Vitamin', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(56, 'Vitamin D', 1, NULL, '2020-10-07 00:30:19', '2020-10-07 00:30:19'),
(57, 'Weight', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(58, '46XX Disorder Of Sexual Differentiation', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(59, 'Abdominal Pain', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(60, 'Abnormal Labs', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(61, 'Abnormal Semen Analysis', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(62, 'Abnormal TFTs', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(63, 'Achalasia Cardia', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(64, 'Achondroplasia', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(65, 'Acid Peptic Disease', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(66, 'Acromegalic Features', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(67, 'Acromegaly', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(68, 'Acute Bronchitis', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(69, 'Acute Coronary Syndrome', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(70, 'Acute Diarrhea', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(71, 'Acute Hepatitis', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(72, 'Acute Hepatitis C', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(73, 'Acute On Chronic Renal Insufficiency', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(74, 'Acute Pharyngitis', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(75, 'Acute Sinusitis', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(76, 'Adrenal Incidentiloma', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(77, 'Adrenal Insufficiency', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(78, 'Adult Growth Hormone Deficiency', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(79, 'Alcohol Abuse', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(80, 'Alcohol Dependence', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(81, 'Alcohol Liver Disease', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(82, 'Allergic Rhinitis', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(83, 'Alzheimers Disease', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(84, 'Amebiasis', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(85, 'Amiodarone Induced Thyroiditis', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(86, 'Ankle Fx', 1, NULL, '2020-10-07 00:30:20', '2020-10-07 00:30:20'),
(87, 'Anorexia', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(88, 'Anxiety Disorder', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(89, 'Aortic Regurgitation', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(90, 'Aortic Stenosis', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(91, 'Aortic Valve Diseases', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(92, 'APD', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(93, 'Aphthous Ulcers', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(94, 'Appendicitis', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(95, 'Apthous Ulcer', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(96, 'ASD Primum', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(97, 'ASD Secundum', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(98, 'Atrial Fibrillation', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(99, 'Atrial Septal Defect.', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(100, 'Attention Deficit Hyperactivity Disorder', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(101, 'Autoimmune Hepatitis', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(102, 'Azoospermia', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(103, 'Backache', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(104, 'Beta Thallasemia Trait', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(105, 'BPH', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(106, 'Bradycardia', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(107, 'Breast Cancer Survivor', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(108, 'Brittle Diabetes', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(109, 'Bronchial Asthma', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(110, 'Bronchiectasis', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(111, 'CA Breast', 1, NULL, '2020-10-07 00:30:21', '2020-10-07 00:30:21'),
(112, 'CA Colon', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(113, 'CA Lung', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(114, 'CAD', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(115, 'Cancer', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(116, 'CA Esophagus', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(117, 'Carcinoid Syndrome', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(118, 'Cardiomyopathy', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(119, 'Carpal Tunnel Syndrome', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(120, 'Cataract (Bilateral)', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(121, 'Cataract (Left Eye)', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(122, 'Cataract (Right Eye)', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(123, 'CCF', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(124, 'Celiac Disease', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(125, 'Cellulitis', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(126, 'Central Adrenal Deficiency', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(127, 'Central Hypothyroidism', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(128, 'Central Hypothyrotropic Hypothyroidism', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(129, 'Cerebral Venous Thrombosis', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(130, 'Cervical Spondylosis', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(131, 'Chest Pain', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(132, 'CHF', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(133, 'Cholangitis', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(134, 'Cholelithiasis', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(135, 'Chronic Liver Disease', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(136, 'Chronic Renal Insufficiency', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(137, 'Cirrhosis', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(138, 'Cirrhosis (Decompensated)', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(139, 'CKD', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(140, 'Cold Thyroid Nodule', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(141, 'Complete Androgen Insensitivty Syndrome', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(142, 'Congenital Adrenal Hyperplasia', 1, NULL, '2020-10-07 00:30:22', '2020-10-07 00:30:22'),
(143, 'Congenital Adrenal Hyperplasia, Non-classical', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(144, 'Congenital Hypothyroidism', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(145, 'COPD', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(146, 'Crest Syndrome', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(147, 'Cushingoid Appearance', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(148, 'Cushings Disease', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(149, 'Cushings Syndrome, Iatrogenic', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(150, 'CVA', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(151, 'Decrease In Libido', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(152, 'Delayed Menarche', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(153, 'Delayed Puberty', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(154, 'Dengue Fever', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(155, 'Diabetes Insipidus', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(156, 'Diabetes Mellitus', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(157, 'Diabetic Foot Ulcer', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(158, 'Diabetic Gastroparesis', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(159, 'Diabetic Nephropathy', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(160, 'Diabetic Neuropathy', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(161, 'Diabetic Retinopathy', 1, NULL, '2020-10-07 00:30:23', '2020-10-07 00:30:23'),
(162, 'Diastolic Heart Failure', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(163, 'DSD', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(164, 'Dyslipidemia', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(165, 'Dysphagia', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(166, 'Dyspnea On Exertion', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(167, 'Early Dementia', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(168, 'Eczema', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(169, 'Elevated Blood Pressure', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(170, 'Empty Sella', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(171, 'Empty Sella Syndrome', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(172, 'Endocrine Ophthalmopathy', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(173, 'Epilepsy', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(174, 'Erectile Dysfunction', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(175, 'ESRD', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(176, 'Essential Tremors', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(177, 'Euthyroid Goiter', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(178, 'Exophthalmos', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(179, 'Exophthalmos, Bilateral', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(180, 'Exophthalmos, Left Eye', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(181, 'Exophthalmos, Right Eye', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(182, 'Ex-smoker', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(183, 'Facial Hair', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(184, 'Facial Hyperpigmentation', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(185, 'Familial Hirsutism', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(186, 'Familial Hypercholesterolemia', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(187, 'Familial Hypertriglyceridemia', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(188, 'Fatty Liver', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(189, 'Fever', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(190, 'Fibromyalgia', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(191, 'Foot Pain', 1, NULL, '2020-10-07 00:30:24', '2020-10-07 00:30:24'),
(192, 'FOURNIER GANGERENE', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(193, 'Frozen Shoulder', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(194, 'G6PD Deficiency', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(195, 'Gastritis', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(196, 'Gastroenteritis', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(197, 'Gastroparesis', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(198, 'GDM', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(199, 'Gender Identity Dysphoria FTM', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(200, 'Gender Identity Dysphoria MTF', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(201, 'GERD', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(202, 'Gestational Diabetes', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(203, 'Gigantism', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(204, 'Gilbert Syndrome', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(205, 'Glaucoma, Open Angle', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(206, 'Goiter', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(207, 'Gout', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(208, 'Graves Disease', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(209, 'Graves Disease With Iatrogenic Hypothyroidism', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(210, 'Graves Ophthalmopathy', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(211, 'Growth Hormone Deficiency', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(212, 'Gynecomastia', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(213, 'Hemorrhagic Stroke', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(214, 'Hair Loss', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(215, 'Hay Fever', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(216, 'HBV Carrier', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(217, 'HCC', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(218, 'HCV Non Responder', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(219, 'HCV Relapser', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(220, 'HCV Responder', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(221, 'Headache NOS', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(222, 'Heart Block', 1, NULL, '2020-10-07 00:30:25', '2020-10-07 00:30:25'),
(223, 'Height Normal For Her Age', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(224, 'Height Normal For His Age', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(225, 'Hemolytic Anemia', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(226, 'Hepatic Encephalopathy', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(227, 'Hepatic Mass', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(228, 'Hepatitis A', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(229, 'Hepatitis B', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(230, 'Hepatitis C', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(231, 'Hepatitis E', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(232, 'Hepatocellular Carcinoma (HCC)', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(233, 'Hiatus Hernia', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(234, 'High Blood Pressure', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(235, 'Hirsutism', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(236, 'History Of Premature CAD', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(237, 'Hip Fx', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(238, 'Hydatid Cyst', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(239, 'Hydrocephalus', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(240, 'Hyperandrogenism', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(241, 'Hypercalcemia', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(242, 'Hypercortisolism', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(243, 'Hypergonadotrphic Hypogonadism', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(244, 'Hypermobility Syndrome', 1, NULL, '2020-10-07 00:30:26', '2020-10-07 00:30:26'),
(245, 'Hyperparathyroidism', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(246, 'Hyperprolactinemia', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(247, 'Hyperreninemic Hyperaldosteronism', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(248, 'Hypertension', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(249, 'Hypertension, Newly Diagnosed', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(250, 'Hypertensive Retinopathy/Retinal Hemorrhage', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(251, 'Hyperthecosis', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(252, 'Hyperthyroidism', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(253, 'Hyperthyroidism Secondary To Grave Disease', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(254, 'Hyperthyrotropic Hypothyroidism', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(255, 'Hypertriglyceridemia', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(256, 'Hyperuricemia', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(257, 'Hypocortisolism', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(258, 'Hypoglycemia', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(259, 'Hypogonadism', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(260, 'Hypogonadotrophic Hypogonadism', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(261, 'Hypogonadotrophic Hypogonadism Vs. Delayed Puberty', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(262, 'Hypoparathyroidism, Post Surgical', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(263, 'Hypothyroidism', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(264, 'Hypothyroidism, Post RAI Rx', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(265, 'Hypothyroidism, Post Surgical', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(266, 'Hypothyrotropic Hypothyroidism', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(267, 'IBD', 1, NULL, '2020-10-07 00:30:27', '2020-10-07 00:30:27'),
(268, 'IBS', 1, NULL, '2020-10-07 00:30:28', '2020-10-07 00:30:28'),
(269, 'ICMP', 1, NULL, '2020-10-07 00:30:28', '2020-10-07 00:30:28'),
(270, 'Idiopathic Hirsutism', 1, NULL, '2020-10-07 00:30:28', '2020-10-07 00:30:28'),
(271, 'Idiopathic Hypogonadotrophic Hypogonadism', 1, NULL, '2020-10-07 00:30:28', '2020-10-07 00:30:28'),
(272, 'Idiopathic Hypoparathyroidism', 1, NULL, '2020-10-07 00:30:28', '2020-10-07 00:30:28'),
(273, 'Impaired Glucose Tolerance', 1, NULL, '2020-10-07 00:30:28', '2020-10-07 00:30:28'),
(274, 'Impotence', 1, NULL, '2020-10-07 00:30:28', '2020-10-07 00:30:28'),
(275, 'Infertility', 1, NULL, '2020-10-07 00:30:28', '2020-10-07 00:30:28'),
(276, 'Interferon Induced Thyroiditis', 1, NULL, '2020-10-07 00:30:28', '2020-10-07 00:30:28'),
(277, 'Intermittent Claudication', 1, NULL, '2020-10-07 00:30:28', '2020-10-07 00:30:28'),
(278, 'Intestinal Obstruction', 1, NULL, '2020-10-07 00:30:28', '2020-10-07 00:30:28'),
(279, 'Intestinal TB', 1, NULL, '2020-10-07 00:30:28', '2020-10-07 00:30:28'),
(280, 'Iron Deficiency', 1, NULL, '2020-10-07 00:30:28', '2020-10-07 00:30:28'),
(281, 'Iron Deficiency Anemia', 1, NULL, '2020-10-07 00:30:28', '2020-10-07 00:30:28'),
(282, 'Irritable Bowel Syndrome', 1, NULL, '2020-10-07 00:30:28', '2020-10-07 00:30:28'),
(283, 'Ischemic Heart Disease', 1, NULL, '2020-10-07 00:30:28', '2020-10-07 00:30:28'),
(284, 'Ischemic Stroke', 1, NULL, '2020-10-07 00:30:29', '2020-10-07 00:30:29'),
(285, 'ITP', 1, NULL, '2020-10-07 00:30:29', '2020-10-07 00:30:29'),
(286, 'Joint Pains', 1, NULL, '2020-10-07 00:30:29', '2020-10-07 00:30:29'),
(287, 'Kallman Syndrome', 1, NULL, '2020-10-07 00:30:29', '2020-10-07 00:30:29'),
(288, 'Klinefelters Syndrome', 1, NULL, '2020-10-07 00:30:29', '2020-10-07 00:30:29'),
(289, 'Lactose Intolerance', 1, NULL, '2020-10-07 00:30:29', '2020-10-07 00:30:29'),
(290, 'LADA', 1, NULL, '2020-10-07 00:30:29', '2020-10-07 00:30:29'),
(291, 'LADA Vs T1DM', 1, NULL, '2020-10-07 00:30:29', '2020-10-07 00:30:29'),
(292, 'LADA Vs T2DM', 1, NULL, '2020-10-07 00:30:29', '2020-10-07 00:30:29'),
(293, 'Laurence-Moon-Biedl Syndrome', 1, NULL, '2020-10-07 00:30:29', '2020-10-07 00:30:29'),
(294, 'Left Knee Pain', 1, NULL, '2020-10-07 00:30:29', '2020-10-07 00:30:29'),
(295, 'Left Suprarenal Mass', 1, NULL, '2020-10-07 00:30:29', '2020-10-07 00:30:29'),
(296, 'Left Thyroid Mass', 1, NULL, '2020-10-07 00:30:29', '2020-10-07 00:30:29'),
(297, 'Leg Edema', 1, NULL, '2020-10-07 00:30:29', '2020-10-07 00:30:29'),
(298, 'Leukemia', 1, NULL, '2020-10-07 00:30:29', '2020-10-07 00:30:29'),
(299, 'Liver Abcess', 1, NULL, '2020-10-07 00:30:30', '2020-10-07 00:30:30'),
(300, 'Liver Cirrhosis/Chronic Liver Disease', 1, NULL, '2020-10-07 00:30:30', '2020-10-07 00:30:30'),
(301, 'Low Blood Glucose', 1, NULL, '2020-10-07 00:30:30', '2020-10-07 00:30:30'),
(302, 'Low Blood Pressure', 1, NULL, '2020-10-07 00:30:30', '2020-10-07 00:30:30'),
(303, 'Low Cortisol', 1, NULL, '2020-10-07 00:30:30', '2020-10-07 00:30:30'),
(304, 'LRTI', 1, NULL, '2020-10-07 00:30:30', '2020-10-07 00:30:30'),
(305, 'Lumbago', 1, NULL, '2020-10-07 00:30:30', '2020-10-07 00:30:30'),
(306, 'Lung Cancer', 1, NULL, '2020-10-07 00:30:30', '2020-10-07 00:30:30'),
(307, 'Lymphoma', 1, NULL, '2020-10-07 00:30:30', '2020-10-07 00:30:30'),
(308, 'Macroprolactinoma', 1, NULL, '2020-10-07 00:30:30', '2020-10-07 00:30:30'),
(309, 'Major Depression', 1, NULL, '2020-10-07 00:30:30', '2020-10-07 00:30:30'),
(310, 'Malaise', 1, NULL, '2020-10-07 00:30:30', '2020-10-07 00:30:30'),
(311, 'Marfan Syndrome', 1, NULL, '2020-10-07 00:30:30', '2020-10-07 00:30:30'),
(312, 'Memory Loss', 1, NULL, '2020-10-07 00:30:30', '2020-10-07 00:30:30'),
(313, 'Menorrhagia', 1, NULL, '2020-10-07 00:30:30', '2020-10-07 00:30:30'),
(314, 'Menstrual Irregularities', 1, NULL, '2020-10-07 00:30:30', '2020-10-07 00:30:30'),
(315, 'Metabolic Syndrome', 1, NULL, '2020-10-07 00:30:30', '2020-10-07 00:30:30'),
(316, 'Metastatic Liver Disease', 1, NULL, '2020-10-07 00:30:30', '2020-10-07 00:30:30'),
(317, 'Microadenoma', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(318, 'Microalbuminuria', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(319, 'Micropenis', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(320, 'Migraine Headache', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(321, 'Mitral Stenosis', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(322, 'Mixed Combined Dyslipidemia', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(323, 'MODY Vs LADA', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(324, 'Morbid Obesity', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(325, 'Motor Neuron Disease', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(326, 'Multi Focal HCC', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(327, 'Multinodular Goiter', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(328, 'Myasthenia Gravis', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(329, 'Myopathy', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(330, 'NAFLD', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(331, 'NASH', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(332, 'Near Syncope', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(333, 'Necrobiosis Lipoidica Diabeticorum', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(334, 'Nephrolithiasis', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(335, 'Nephropathy', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(336, 'Nephrotic Syndrome', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(337, 'Neurofibromatosis', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(338, 'Neuropathy', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(339, 'Nicotine Dependence', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(340, 'Nocturnal Enuresis', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(341, 'Normal Medical Exam', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(342, 'Numbness Of Hand', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(343, 'Numbness Of Hands And Feet', 1, NULL, '2020-10-07 00:30:31', '2020-10-07 00:30:31'),
(344, 'NVD', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(345, 'OA', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(346, 'Obesity', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(347, 'Obstructive Jaundice', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(348, 'Obstructive Sleep Apnea', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(349, 'Oligospermia', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(350, 'Onychomycosis', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(351, 'Osteoarthritis', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(352, 'Osteogenic Imperfecta', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(353, 'Osteomalacia', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(354, 'Osteopenia', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(355, 'Osteoporosis', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(356, 'Ovarian Tumor', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(357, 'Overweight', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(358, 'Painful Diabetic Neuropathy', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(359, 'Painful Peripheral Neuropathy', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(360, 'Painless Peripheral Neuropathy', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(361, 'Pancreatic CA', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(362, 'Pancreatitis', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(363, 'Panhypopituitarism', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(364, 'Papillary Thyroid Carcinoma', 1, NULL, '2020-10-07 00:30:32', '2020-10-07 00:30:32'),
(365, 'Parkinsonism', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(366, 'PBC', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(367, 'PCOS', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(368, 'Pectus Carinatum', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(369, 'Pedal Edema', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(370, 'Percarditis', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(371, 'Peripartam Cardiomyopathy', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(372, 'Peripheral Neuropathy', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(373, 'Peripheral Vascular Disease', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(374, 'Pernicious Anemia', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(375, 'Pituitary Macroadenoma', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(376, 'Pituitary Microadenoma', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(377, 'Plummers Disease', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(378, 'PND', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(379, 'Pneumonia', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(380, 'Polycystic Ovarian Syndrome', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(381, 'Polyglandular Autoimmune Disorder Type II', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(382, 'Polyuria', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(383, 'Portal Vein Thrombosis', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(384, 'Post Pancreatitis Diabetes Mellitus', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(385, 'Post Radioactive Iodine Rx Hypothyroidism', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(386, 'Post Surgical Hypoparathyroidism', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(387, 'Post Surgical Hypothyroidism', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(388, 'Post-CABG', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(389, 'Postmenopausal Hot Flashes', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(390, 'Postmenopause', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(391, 'Postsurgical Hypothyroidism', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(392, 'Precocious Puberty', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(393, 'Pre-Diabetes', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(394, 'Pre-gestational Diabetes Mellitus', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(395, 'Premature Adrenarche', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(396, 'Premature Ejaculation', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(397, 'Premature Ovarian Failure', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(398, 'Pre-syncope', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(399, 'Primary Ammenorhea', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(400, 'Primary Hyperparathyroidism', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(401, 'Primary Hypoparathyroidism', 1, NULL, '2020-10-07 00:30:33', '2020-10-07 00:30:33'),
(402, 'Primary Infertility', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(403, 'Primary Ovarian Insufficiency', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(404, 'Probable OSA', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(405, 'Probable Osteoporosis', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(406, 'Probable PCOS', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(407, 'Probable Vertebral Stenosis', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(408, 'Probable Vitamin B12 Deficiency', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(409, 'Prolactinoma', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(410, 'Prostatism', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(411, 'Pseudo Gout', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(412, 'Pseudo Intermittent Claudication', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(413, 'PseudoCushings Disease', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(414, 'Pseudogynecomstia', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(415, 'Pseudo-Seizures', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(416, 'Psoriatic Arthritis', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(417, 'Ptosis', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(418, 'Puberty Goiter', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(419, 'Pulmonary TB', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(420, 'PUO', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(421, 'Recurrent Hypoglycemia', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(422, 'Renal Glycosuria', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(423, 'Renal Insufficiency', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(424, 'Rheumatic Heart Disease', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(425, 'Rheumatoid Arthritis', 1, NULL, '2020-10-07 00:30:34', '2020-10-07 00:30:34'),
(426, 'Rickets', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(427, 'Right Breast Lump', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(428, 'Right Foot Pain', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(429, 'Right Hand Numbness', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(430, 'Right Shoulder Pain', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(431, 'Sciatica', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(432, 'Secondary Ammenorrhea', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(433, 'Secondary Hyperparathyroidism', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(434, 'Secondary Hypertension', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(435, 'Secondary Infertility', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(436, 'Seizure Disorder', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(437, 'Senile Osteoporosis', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(438, 'Sertoli Only Syndrome', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(439, 'Severe Orbitopathy', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(440, 'Short Stature', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(441, 'SP ASD Closure', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(442, 'SP MI', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(443, 'SP Pituitary Adenoma Surgery', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(444, 'SP PPM Placement', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(445, 'SP Surgery PTC Post Surgical Hypothyroidism', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(446, 'SRUS', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(447, 'Stable Angina', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(448, 'Status Post CVA', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(449, 'Status Post Pituitary Adenoma Resection', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(450, 'Status Post Pituitary Adenoma Surgery', 1, NULL, '2020-10-07 00:30:35', '2020-10-07 00:30:35'),
(451, 'Status Post RAI Rx For Hyperthyroidism', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(452, 'Status Post Thyroiditis', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(453, 'Steroid Induced Diabetes Mellitus', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(454, 'Stress Incontinence', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(455, 'Sub Acute Intestinal Obstruction', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(456, 'Subclinical Hyperthyroidism', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(457, 'Subclinical Hypothyroidism', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(458, 'Subfertility', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(459, 'Suppurative Thyroiditis', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(460, 'Supraventricular Tachycardia', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(461, 'Suspected Adrenal Insufficiency', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(462, 'Syncope', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(463, 'T1DM', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(464, 'T2DM', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(465, 'T2DM Vs LADA', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(466, 'T2DM, New Onset', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(467, 'T3 Thyrotoxicosis', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(468, 'Tall Stature', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(469, 'TB', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(470, 'Tension Headache', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(471, 'Tetany', 1, NULL, '2020-10-07 00:30:36', '2020-10-07 00:30:36'),
(472, 'Thalassemia Intermedia', 1, NULL, '2020-10-07 00:30:37', '2020-10-07 00:30:37'),
(473, 'Thalassemia Major', 1, NULL, '2020-10-07 00:30:37', '2020-10-07 00:30:37'),
(474, 'Thalassemia Minor', 1, NULL, '2020-10-07 00:30:37', '2020-10-07 00:30:37'),
(475, 'Thalassemia Trait', 1, NULL, '2020-10-07 00:30:37', '2020-10-07 00:30:37'),
(476, 'Thrombocytopenia', 1, NULL, '2020-10-07 00:30:37', '2020-10-07 00:30:37'),
(477, 'Thrombophlebitis', 1, NULL, '2020-10-07 00:30:37', '2020-10-07 00:30:37'),
(478, 'Thyroid Eye Disease', 1, NULL, '2020-10-07 00:30:37', '2020-10-07 00:30:37'),
(479, 'Thyroid Nodule', 1, NULL, '2020-10-07 00:30:37', '2020-10-07 00:30:37'),
(480, 'Thyroid Resistance Syndrome', 1, NULL, '2020-10-07 00:30:37', '2020-10-07 00:30:37'),
(481, 'Thyroiditis', 1, NULL, '2020-10-07 00:30:37', '2020-10-07 00:30:37'),
(482, 'Thyrotoxicosis', 1, NULL, '2020-10-07 00:30:37', '2020-10-07 00:30:37'),
(483, 'Titubation', 1, NULL, '2020-10-07 00:30:37', '2020-10-07 00:30:37'),
(484, 'Toxic MNG', 1, NULL, '2020-10-07 00:30:38', '2020-10-07 00:30:38'),
(485, 'Toxic MNG With Iatrogenic Hypothyroidism', 1, NULL, '2020-10-07 00:30:38', '2020-10-07 00:30:38'),
(486, 'Toxic Mutinodular Goiter', 1, NULL, '2020-10-07 00:30:38', '2020-10-07 00:30:38'),
(487, 'Toxic Uninodular Goiter', 1, NULL, '2020-10-07 00:30:38', '2020-10-07 00:30:38'),
(488, 'Transient Ischemic Attack', 1, NULL, '2020-10-07 00:30:38', '2020-10-07 00:30:38'),
(489, 'Tremors', 1, NULL, '2020-10-07 00:30:38', '2020-10-07 00:30:38'),
(490, 'Turner Syndrome', 1, NULL, '2020-10-07 00:30:38', '2020-10-07 00:30:38'),
(491, 'Type 1 Diabetes Mellitus', 1, NULL, '2020-10-07 00:30:38', '2020-10-07 00:30:38'),
(492, 'Type 1 Diabetes Mellitus Vs. LADA', 1, NULL, '2020-10-07 00:30:38', '2020-10-07 00:30:38'),
(493, 'Type 2 Diabetes Mellitus', 1, NULL, '2020-10-07 00:30:38', '2020-10-07 00:30:38'),
(494, 'Ulcerative Colitis', 1, NULL, '2020-10-07 00:30:38', '2020-10-07 00:30:38'),
(495, 'Umbilical Hernia', 1, NULL, '2020-10-07 00:30:38', '2020-10-07 00:30:38'),
(496, 'Underweight', 1, NULL, '2020-10-07 00:30:38', '2020-10-07 00:30:38'),
(497, 'Upper Backache', 1, NULL, '2020-10-07 00:30:38', '2020-10-07 00:30:38'),
(498, 'Upper Respiratory Tract Infection', 1, NULL, '2020-10-07 00:30:38', '2020-10-07 00:30:38'),
(499, 'Urinary Frequency', 1, NULL, '2020-10-07 00:30:38', '2020-10-07 00:30:38'),
(500, 'Urinary Tract Infection', 1, NULL, '2020-10-07 00:30:38', '2020-10-07 00:30:38'),
(501, 'URTI', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(502, 'Urticaria', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(503, 'Valvular Heart Disease', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(504, 'Varicose Veins', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(505, 'Vertebral Fracture', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(506, 'Vertebral Stenosis', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(507, 'Vitamin B12 Deficiency', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(508, 'Vitiligo', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(509, 'VSD', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(510, 'VSD Closure', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(511, 'Weakness', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(512, 'Weight Gain', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(513, 'Weight Loss', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(514, 'Weight Normal For Height', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(515, 'White Coat Syndrome', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(516, 'Wilsons Disease', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(517, 'Antibiotic/antibaterial/keratinolytic', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(518, 'Blood Pressure/Cholesterol', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(519, 'Vitamin B', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(520, 'Angina', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(521, 'Mouthwash', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(522, 'Psychosis', 1, NULL, '2020-10-07 00:30:39', '2020-10-07 00:30:39'),
(523, 'Flue', 1, NULL, '2020-10-07 00:30:40', '2020-10-07 00:30:40'),
(524, 'Mania', 1, NULL, '2020-10-07 00:30:40', '2020-10-07 00:30:40'),
(525, 'Fever Heart', 1, NULL, '2020-10-07 00:30:40', '2020-10-07 00:30:40'),
(526, 'Mood', 1, NULL, '2020-10-07 00:30:40', '2020-10-07 00:30:40');

-- --------------------------------------------------------

--
-- Table structure for table `diseases`
--

CREATE TABLE `diseases` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diseases`
--

INSERT INTO `diseases` (`id`, `title`, `slug`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, '46XX Disorder Of Sexual Differentiation', '46xx-disorder-of-sexual-differentiation', 1, NULL, '2020-10-07 00:35:35', '2020-10-07 00:35:35'),
(6, 'Abdominal Pain', 'abdominal-pain', 1, NULL, '2020-10-07 00:35:35', '2020-10-07 00:35:35'),
(7, 'Abnormal Labs', 'abnormal-labs', 1, NULL, '2020-10-07 00:35:35', '2020-10-07 00:35:35'),
(8, 'Abnormal Semen Analysis', 'abnormal-semen-analysis', 1, NULL, '2020-10-07 00:35:35', '2020-10-07 00:35:35'),
(9, 'Abnormal TFTs', 'abnormal-tfts', 1, NULL, '2020-10-07 00:35:35', '2020-10-07 00:35:35'),
(10, 'Achalasia Cardia', 'achalasia-cardia', 1, NULL, '2020-10-07 00:35:35', '2020-10-07 00:35:35'),
(11, 'Achondroplasia', 'achondroplasia', 1, NULL, '2020-10-07 00:35:35', '2020-10-07 00:35:35'),
(12, 'Acid Peptic Disease', 'acid-peptic-disease', 1, NULL, '2020-10-07 00:35:36', '2020-10-07 00:35:36'),
(13, 'Acne', 'acne', 1, NULL, '2020-10-07 00:35:36', '2020-10-07 00:35:36'),
(14, 'Acromegalic Features', 'acromegalic-features', 1, NULL, '2020-10-07 00:35:36', '2020-10-07 00:35:36'),
(15, 'Acromegaly', 'acromegaly', 1, NULL, '2020-10-07 00:35:36', '2020-10-07 00:35:36'),
(16, 'Acute Bronchitis', 'acute-bronchitis', 1, NULL, '2020-10-07 00:35:36', '2020-10-07 00:35:36'),
(17, 'Acute Coronary Syndrome', 'acute-coronary-syndrome', 1, NULL, '2020-10-07 00:35:36', '2020-10-07 00:35:36'),
(18, 'Acute Diarrhea', 'acute-diarrhea', 1, NULL, '2020-10-07 00:35:36', '2020-10-07 00:35:36'),
(19, 'Acute Hepatitis', 'acute-hepatitis', 1, NULL, '2020-10-07 00:35:36', '2020-10-07 00:35:36'),
(20, 'Acute Hepatitis C', 'acute-hepatitis-c', 1, NULL, '2020-10-07 00:35:36', '2020-10-07 00:35:36'),
(21, 'Acute On Chronic Renal Insufficiency', 'acute-on-chronic-renal-insufficiency', 1, NULL, '2020-10-07 00:35:36', '2020-10-07 00:35:36'),
(22, 'Acute Pharyngitis', 'acute-pharyngitis', 1, NULL, '2020-10-07 00:35:36', '2020-10-07 00:35:36'),
(23, 'Acute Sinusitis', 'acute-sinusitis', 1, NULL, '2020-10-07 00:35:36', '2020-10-07 00:35:36'),
(24, 'Adrenal Incidentiloma', 'adrenal-incidentiloma', 1, NULL, '2020-10-07 00:35:36', '2020-10-07 00:35:36'),
(25, 'Adrenal Insufficiency', 'adrenal-insufficiency', 1, NULL, '2020-10-07 00:35:36', '2020-10-07 00:35:36'),
(26, 'Adult Growth Hormone Deficiency', 'adult-growth-hormone-deficiency', 1, NULL, '2020-10-07 00:35:36', '2020-10-07 00:35:36'),
(27, 'Alcohol Abuse', 'alcohol-abuse', 1, NULL, '2020-10-07 00:35:36', '2020-10-07 00:35:36'),
(28, 'Alcohol Dependence', 'alcohol-dependence', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(29, 'Alcohol Liver Disease', 'alcohol-liver-disease', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(30, 'Allergic Rhinitis', 'allergic-rhinitis', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(31, 'Alzheimers Disease', 'alzheimers-disease', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(32, 'Amebiasis', 'amebiasis', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(33, 'Amiodarone Induced Thyroiditis', 'amiodarone-induced-thyroiditis', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(34, 'Anemia', 'anemia', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(35, 'Angina', 'angina', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(36, 'Ankle Fx', 'ankle-fx', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(37, 'Anorexia', 'anorexia', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(38, 'Anxiety Disorder', 'anxiety-disorder', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(39, 'Aortic Regurgitation', 'aortic-regurgitation', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(40, 'Aortic Stenosis', 'aortic-stenosis', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(41, 'Aortic Valve Diseases', 'aortic-valve-diseases', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(42, 'APD', 'apd', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(43, 'Aphthous Ulcers', 'aphthous-ulcers', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(44, 'Appendicitis', 'appendicitis', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(45, 'Apthous Ulcer', 'apthous-ulcer', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(46, 'Arthritis', 'arthritis', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(47, 'ASD Primum', 'asd-primum', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(48, 'ASD Secundum', 'asd-secundum', 1, NULL, '2020-10-07 00:35:37', '2020-10-07 00:35:37'),
(49, 'Asthma', 'asthma', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(50, 'Atrial Fibrillation', 'atrial-fibrillation', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(51, 'Atrial Septal Defect.', 'atrial-septal-defect', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(52, 'Attention Deficit Hyperactivity Disorder', 'attention-deficit-hyperactivity-disorder', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(53, 'Autoimmune Hepatitis', 'autoimmune-hepatitis', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(54, 'Azoospermia', 'azoospermia', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(55, 'Backache', 'backache', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(56, 'Beta Thallasemia Trait', 'beta-thallasemia-trait', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(57, 'BPH', 'bph', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(58, 'Bradycardia', 'bradycardia', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(59, 'Breast Cancer Survivor', 'breast-cancer-survivor', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(60, 'Brittle Diabetes', 'brittle-diabetes', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(61, 'Bronchial Asthma', 'bronchial-asthma', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(62, 'Bronchiectasis', 'bronchiectasis', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(63, 'CA Breast', 'ca-breast', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(64, 'CA Colon', 'ca-colon', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(65, 'CA Lung', 'ca-lung', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(66, 'CAD', 'cad', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(67, 'Cancer', 'cancer', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(68, 'CA Esophagus', 'ca-esophagus', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(69, 'Carcinoid Syndrome', 'carcinoid-syndrome', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(70, 'Cardiomyopathy', 'cardiomyopathy', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(71, 'Carpal Tunnel Syndrome', 'carpal-tunnel-syndrome', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(72, 'Cataract (Bilateral)', 'cataract-bilateral', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(73, 'Cataract (Left Eye)', 'cataract-left-eye', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(74, 'Cataract (Right Eye)', 'cataract-right-eye', 1, NULL, '2020-10-07 00:35:38', '2020-10-07 00:35:38'),
(75, 'CCF', 'ccf', 1, NULL, '2020-10-07 00:35:39', '2020-10-07 00:35:39'),
(76, 'Celiac Disease', 'celiac-disease', 1, NULL, '2020-10-07 00:35:39', '2020-10-07 00:35:39'),
(77, 'Cellulitis', 'cellulitis', 1, NULL, '2020-10-07 00:35:39', '2020-10-07 00:35:39'),
(78, 'Central Adrenal Deficiency', 'central-adrenal-deficiency', 1, NULL, '2020-10-07 00:35:39', '2020-10-07 00:35:39'),
(79, 'Central Hypothyroidism', 'central-hypothyroidism', 1, NULL, '2020-10-07 00:35:39', '2020-10-07 00:35:39'),
(80, 'Central Hypothyrotropic Hypothyroidism', 'central-hypothyrotropic-hypothyroidism', 1, NULL, '2020-10-07 00:35:39', '2020-10-07 00:35:39'),
(81, 'Cerebral Venous Thrombosis', 'cerebral-venous-thrombosis', 1, NULL, '2020-10-07 00:35:39', '2020-10-07 00:35:39'),
(82, 'Cervical Spondylosis', 'cervical-spondylosis', 1, NULL, '2020-10-07 00:35:39', '2020-10-07 00:35:39'),
(83, 'Chest Pain', 'chest-pain', 1, NULL, '2020-10-07 00:35:39', '2020-10-07 00:35:39'),
(84, 'CHF', 'chf', 1, NULL, '2020-10-07 00:35:39', '2020-10-07 00:35:39'),
(85, 'Cholangitis', 'cholangitis', 1, NULL, '2020-10-07 00:35:39', '2020-10-07 00:35:39'),
(86, 'Cholelithiasis', 'cholelithiasis', 1, NULL, '2020-10-07 00:35:39', '2020-10-07 00:35:39'),
(87, 'Chronic Liver Disease', 'chronic-liver-disease', 1, NULL, '2020-10-07 00:35:39', '2020-10-07 00:35:39'),
(88, 'Chronic Renal Insufficiency', 'chronic-renal-insufficiency', 1, NULL, '2020-10-07 00:35:39', '2020-10-07 00:35:39'),
(89, 'Cirrhosis', 'cirrhosis', 1, NULL, '2020-10-07 00:35:39', '2020-10-07 00:35:39'),
(90, 'Cirrhosis (Decompensated)', 'cirrhosis-decompensated', 1, NULL, '2020-10-07 00:35:39', '2020-10-07 00:35:39'),
(91, 'CKD', 'ckd', 1, NULL, '2020-10-07 00:35:39', '2020-10-07 00:35:39'),
(92, 'Cold Thyroid Nodule', 'cold-thyroid-nodule', 1, NULL, '2020-10-07 00:35:39', '2020-10-07 00:35:39'),
(93, 'Complete Androgen Insensitivty Syndrome', 'complete-androgen-insensitivty-syndrome', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(94, 'Congenital Adrenal Hyperplasia', 'congenital-adrenal-hyperplasia', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(95, 'Congenital Adrenal Hyperplasia, Non-classical', 'congenital-adrenal-hyperplasia-non-classical', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(96, 'Congenital Hypothyroidism', 'congenital-hypothyroidism', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(97, 'Constipation', 'constipation', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(98, 'COPD', 'copd', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(99, 'Crest Syndrome', 'crest-syndrome', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(100, 'Cushingoid Appearance', 'cushingoid-appearance', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(101, 'Cushings Disease', 'cushings-disease', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(102, 'Cushings Syndrome, Iatrogenic', 'cushings-syndrome-iatrogenic', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(103, 'CVA', 'cva', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(104, 'Decrease In Libido', 'decrease-in-libido', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(105, 'Delayed Menarche', 'delayed-menarche', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(106, 'Delayed Puberty', 'delayed-puberty', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(107, 'Dengue Fever', 'dengue-fever', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(108, 'Diabetes Insipidus', 'diabetes-insipidus', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(109, 'Diabetes Mellitus', 'diabetes-mellitus', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(110, 'Diabetic Foot Ulcer', 'diabetic-foot-ulcer', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(111, 'Diabetic Gastroparesis', 'diabetic-gastroparesis', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(112, 'Diabetic Nephropathy', 'diabetic-nephropathy', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(113, 'Diabetic Neuropathy', 'diabetic-neuropathy', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(114, 'Diabetic Retinopathy', 'diabetic-retinopathy', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(115, 'Diastolic Heart Failure', 'diastolic-heart-failure', 1, NULL, '2020-10-07 00:35:40', '2020-10-07 00:35:40'),
(116, 'DM', 'dm', 1, NULL, '2020-10-07 00:35:41', '2020-10-07 00:35:41'),
(117, 'DSD', 'dsd', 1, NULL, '2020-10-07 00:35:41', '2020-10-07 00:35:41'),
(118, 'Dyslipidemia', 'dyslipidemia', 1, NULL, '2020-10-07 00:35:41', '2020-10-07 00:35:41'),
(119, 'Dysphagia', 'dysphagia', 1, NULL, '2020-10-07 00:35:41', '2020-10-07 00:35:41'),
(120, 'Dyspnea On Exertion', 'dyspnea-on-exertion', 1, NULL, '2020-10-07 00:35:41', '2020-10-07 00:35:41'),
(121, 'Early Dementia', 'early-dementia', 1, NULL, '2020-10-07 00:35:41', '2020-10-07 00:35:41'),
(122, 'Eczema', 'eczema', 1, NULL, '2020-10-07 00:35:41', '2020-10-07 00:35:41'),
(123, 'Elevated Blood Pressure', 'elevated-blood-pressure', 1, NULL, '2020-10-07 00:35:41', '2020-10-07 00:35:41'),
(124, 'Empty Sella', 'empty-sella', 1, NULL, '2020-10-07 00:35:41', '2020-10-07 00:35:41'),
(125, 'Empty Sella Syndrome', 'empty-sella-syndrome', 1, NULL, '2020-10-07 00:35:41', '2020-10-07 00:35:41'),
(126, 'Endocrine Ophthalmopathy', 'endocrine-ophthalmopathy', 1, NULL, '2020-10-07 00:35:41', '2020-10-07 00:35:41'),
(127, 'Epilepsy', 'epilepsy', 1, NULL, '2020-10-07 00:35:41', '2020-10-07 00:35:41'),
(128, 'Erectile Dysfunction', 'erectile-dysfunction', 1, NULL, '2020-10-07 00:35:41', '2020-10-07 00:35:41'),
(129, 'ESRD', 'esrd', 1, NULL, '2020-10-07 00:35:41', '2020-10-07 00:35:41'),
(130, 'Essential Tremors', 'essential-tremors', 1, NULL, '2020-10-07 00:35:41', '2020-10-07 00:35:41'),
(131, 'Euthyroid Goiter', 'euthyroid-goiter', 1, NULL, '2020-10-07 00:35:41', '2020-10-07 00:35:41'),
(132, 'Exophthalmos', 'exophthalmos', 1, NULL, '2020-10-07 00:35:41', '2020-10-07 00:35:41'),
(133, 'Exophthalmos, Bilateral', 'exophthalmos-bilateral', 1, NULL, '2020-10-07 00:35:42', '2020-10-07 00:35:42'),
(134, 'Exophthalmos, Left Eye', 'exophthalmos-left-eye', 1, NULL, '2020-10-07 00:35:42', '2020-10-07 00:35:42'),
(135, 'Exophthalmos, Right Eye', 'exophthalmos-right-eye', 1, NULL, '2020-10-07 00:35:42', '2020-10-07 00:35:42'),
(136, 'Ex-smoker', 'ex-smoker', 1, NULL, '2020-10-07 00:35:42', '2020-10-07 00:35:42'),
(137, 'Facial Hair', 'facial-hair', 1, NULL, '2020-10-07 00:35:42', '2020-10-07 00:35:42'),
(138, 'Facial Hyperpigmentation', 'facial-hyperpigmentation', 1, NULL, '2020-10-07 00:35:42', '2020-10-07 00:35:42'),
(139, 'Familial Hirsutism', 'familial-hirsutism', 1, NULL, '2020-10-07 00:35:42', '2020-10-07 00:35:42'),
(140, 'Familial Hypercholesterolemia', 'familial-hypercholesterolemia', 1, NULL, '2020-10-07 00:35:42', '2020-10-07 00:35:42'),
(141, 'Familial Hypertriglyceridemia', 'familial-hypertriglyceridemia', 1, NULL, '2020-10-07 00:35:43', '2020-10-07 00:35:43'),
(142, 'Fatty Liver', 'fatty-liver', 1, NULL, '2020-10-07 00:35:43', '2020-10-07 00:35:43'),
(143, 'Fever', 'fever', 1, NULL, '2020-10-07 00:35:43', '2020-10-07 00:35:43'),
(144, 'Fibromyalgia', 'fibromyalgia', 1, NULL, '2020-10-07 00:35:43', '2020-10-07 00:35:43'),
(145, 'Foot Pain', 'foot-pain', 1, NULL, '2020-10-07 00:35:43', '2020-10-07 00:35:43'),
(146, 'FOURNIER GANGERENE', 'fournier-gangerene', 1, NULL, '2020-10-07 00:35:43', '2020-10-07 00:35:43'),
(147, 'Frozen Shoulder', 'frozen-shoulder', 1, NULL, '2020-10-07 00:35:43', '2020-10-07 00:35:43'),
(148, 'G6PD Deficiency', 'g6pd-deficiency', 1, NULL, '2020-10-07 00:35:43', '2020-10-07 00:35:43'),
(149, 'Gastritis', 'gastritis', 1, NULL, '2020-10-07 00:35:43', '2020-10-07 00:35:43'),
(150, 'Gastroenteritis', 'gastroenteritis', 1, NULL, '2020-10-07 00:35:43', '2020-10-07 00:35:43'),
(151, 'Gastroparesis', 'gastroparesis', 1, NULL, '2020-10-07 00:35:43', '2020-10-07 00:35:43'),
(152, 'GDM', 'gdm', 1, NULL, '2020-10-07 00:35:43', '2020-10-07 00:35:43'),
(153, 'Gender Identity Dysphoria FTM', 'gender-identity-dysphoria-ftm', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(154, 'Gender Identity Dysphoria MTF', 'gender-identity-dysphoria-mtf', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(155, 'GERD', 'gerd', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(156, 'Gestational Diabetes', 'gestational-diabetes', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(157, 'Gigantism', 'gigantism', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(158, 'Gilbert Syndrome', 'gilbert-syndrome', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(159, 'Glaucoma, Open Angle', 'glaucoma-open-angle', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(160, 'Goiter', 'goiter', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(161, 'Gout', 'gout', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(162, 'Graves Disease', 'graves-disease', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(163, 'Graves Disease With Iatrogenic Hypothyroidism', 'graves-disease-with-iatrogenic-hypothyroidism', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(164, 'Graves Ophthalmopathy', 'graves-ophthalmopathy', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(165, 'Growth Hormone Deficiency', 'growth-hormone-deficiency', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(166, 'Gynecomastia', 'gynecomastia', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(167, 'Hemorrhagic Stroke', 'hemorrhagic-stroke', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(168, 'Hair Loss', 'hair-loss', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(169, 'Hay Fever', 'hay-fever', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(170, 'HBV Carrier', 'hbv-carrier', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(171, 'HCC', 'hcc', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(172, 'HCV Non Responder', 'hcv-non-responder', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(173, 'HCV Relapser', 'hcv-relapser', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(174, 'HCV Responder', 'hcv-responder', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(175, 'Headache', 'headache', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(176, 'Headache NOS', 'headache-nos', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(177, 'Heart Block', 'heart-block', 1, NULL, '2020-10-07 00:35:44', '2020-10-07 00:35:44'),
(178, 'Height Normal For Her Age', 'height-normal-for-her-age', 1, NULL, '2020-10-07 00:35:45', '2020-10-07 00:35:45'),
(179, 'Height Normal For His Age', 'height-normal-for-his-age', 1, NULL, '2020-10-07 00:35:45', '2020-10-07 00:35:45'),
(180, 'Hemolytic Anemia', 'hemolytic-anemia', 1, NULL, '2020-10-07 00:35:45', '2020-10-07 00:35:45'),
(181, 'Hepatic Encephalopathy', 'hepatic-encephalopathy', 1, NULL, '2020-10-07 00:35:45', '2020-10-07 00:35:45'),
(182, 'Hepatic Mass', 'hepatic-mass', 1, NULL, '2020-10-07 00:35:45', '2020-10-07 00:35:45'),
(183, 'Hepatitis', 'hepatitis', 1, NULL, '2020-10-07 00:35:45', '2020-10-07 00:35:45'),
(184, 'Hepatitis A', 'hepatitis-a', 1, NULL, '2020-10-07 00:35:45', '2020-10-07 00:35:45'),
(185, 'Hepatitis B', 'hepatitis-b', 1, NULL, '2020-10-07 00:35:45', '2020-10-07 00:35:45'),
(186, 'Hepatitis C', 'hepatitis-c', 1, NULL, '2020-10-07 00:35:45', '2020-10-07 00:35:45'),
(187, 'Hepatitis E', 'hepatitis-e', 1, NULL, '2020-10-07 00:35:45', '2020-10-07 00:35:45'),
(188, 'Hepatocellular Carcinoma (HCC)', 'hepatocellular-carcinoma-hcc', 1, NULL, '2020-10-07 00:35:45', '2020-10-07 00:35:45'),
(189, 'Hiatus Hernia', 'hiatus-hernia', 1, NULL, '2020-10-07 00:35:45', '2020-10-07 00:35:45'),
(190, 'High Blood Pressure', 'high-blood-pressure', 1, NULL, '2020-10-07 00:35:46', '2020-10-07 00:35:46'),
(191, 'Hirsutism', 'hirsutism', 1, NULL, '2020-10-07 00:35:46', '2020-10-07 00:35:46'),
(192, 'History Of Premature CAD', 'history-of-premature-cad', 1, NULL, '2020-10-07 00:35:46', '2020-10-07 00:35:46'),
(193, 'Hip Fx', 'hip-fx', 1, NULL, '2020-10-07 00:35:46', '2020-10-07 00:35:46'),
(194, 'Hydatid Cyst', 'hydatid-cyst', 1, NULL, '2020-10-07 00:35:46', '2020-10-07 00:35:46'),
(195, 'Hydrocephalus', 'hydrocephalus', 1, NULL, '2020-10-07 00:35:46', '2020-10-07 00:35:46'),
(196, 'Hyperandrogenism', 'hyperandrogenism', 1, NULL, '2020-10-07 00:35:46', '2020-10-07 00:35:46'),
(197, 'Hypercalcemia', 'hypercalcemia', 1, NULL, '2020-10-07 00:35:46', '2020-10-07 00:35:46'),
(198, 'Hypercortisolism', 'hypercortisolism', 1, NULL, '2020-10-07 00:35:46', '2020-10-07 00:35:46'),
(199, 'Hypergonadotrphic Hypogonadism', 'hypergonadotrphic-hypogonadism', 1, NULL, '2020-10-07 00:35:46', '2020-10-07 00:35:46'),
(200, 'Hypermobility Syndrome', 'hypermobility-syndrome', 1, NULL, '2020-10-07 00:35:46', '2020-10-07 00:35:46'),
(201, 'Hyperparathyroidism', 'hyperparathyroidism', 1, NULL, '2020-10-07 00:35:47', '2020-10-07 00:35:47'),
(202, 'Hyperprolactinemia', 'hyperprolactinemia', 1, NULL, '2020-10-07 00:35:47', '2020-10-07 00:35:47'),
(203, 'Hyperreninemic Hyperaldosteronism', 'hyperreninemic-hyperaldosteronism', 1, NULL, '2020-10-07 00:35:47', '2020-10-07 00:35:47'),
(204, 'Hypertension', 'hypertension', 1, NULL, '2020-10-07 00:35:47', '2020-10-07 00:35:47'),
(205, 'Hypertension, Newly Diagnosed', 'hypertension-newly-diagnosed', 1, NULL, '2020-10-07 00:35:47', '2020-10-07 00:35:47'),
(206, 'Hypertensive Retinopathy/Retinal Hemorrhage', 'hypertensive-retinopathyretinal-hemorrhage', 1, NULL, '2020-10-07 00:35:47', '2020-10-07 00:35:47'),
(207, 'Hypertensive Retinopathy', 'hypertensive-retinopathy', 1, NULL, '2020-10-07 00:35:47', '2020-10-07 00:35:47'),
(208, 'Hyperthecosis', 'hyperthecosis', 1, NULL, '2020-10-07 00:35:47', '2020-10-07 00:35:47'),
(209, 'Hyperthyroidism', 'hyperthyroidism', 1, NULL, '2020-10-07 00:35:47', '2020-10-07 00:35:47'),
(210, 'Hyperthyroidism Secondary To Grave Disease', 'hyperthyroidism-secondary-to-grave-disease', 1, NULL, '2020-10-07 00:35:47', '2020-10-07 00:35:47'),
(211, 'Hyperthyrotropic Hypothyroidism', 'hyperthyrotropic-hypothyroidism', 1, NULL, '2020-10-07 00:35:47', '2020-10-07 00:35:47'),
(212, 'Hypertriglyceridemia', 'hypertriglyceridemia', 1, NULL, '2020-10-07 00:35:47', '2020-10-07 00:35:47'),
(213, 'Hyperuricemia', 'hyperuricemia', 1, NULL, '2020-10-07 00:35:48', '2020-10-07 00:35:48'),
(214, 'Hypocortisolism', 'hypocortisolism', 1, NULL, '2020-10-07 00:35:48', '2020-10-07 00:35:48'),
(215, 'Hypoglycemia', 'hypoglycemia', 1, NULL, '2020-10-07 00:35:48', '2020-10-07 00:35:48'),
(216, 'Hypogonadism', 'hypogonadism', 1, NULL, '2020-10-07 00:35:48', '2020-10-07 00:35:48'),
(217, 'Hypogonadotrophic Hypogonadism', 'hypogonadotrophic-hypogonadism', 1, NULL, '2020-10-07 00:35:48', '2020-10-07 00:35:48'),
(218, 'Hypogonadotrophic Hypogonadism Vs. Delayed Puberty', 'hypogonadotrophic-hypogonadism-vs-delayed-puberty', 1, NULL, '2020-10-07 00:35:48', '2020-10-07 00:35:48'),
(219, 'Hypoparathyroidism, Post Surgical', 'hypoparathyroidism-post-surgical', 1, NULL, '2020-10-07 00:35:48', '2020-10-07 00:35:48'),
(220, 'Hypothyroidism', 'hypothyroidism', 1, NULL, '2020-10-07 00:35:48', '2020-10-07 00:35:48'),
(221, 'Hypothyroidism, Post RAI Rx', 'hypothyroidism-post-rai-rx', 1, NULL, '2020-10-07 00:35:48', '2020-10-07 00:35:48'),
(222, 'Hypothyroidism, Post Surgical', 'hypothyroidism-post-surgical', 1, NULL, '2020-10-07 00:35:48', '2020-10-07 00:35:48'),
(223, 'Hypothyrotropic Hypothyroidism', 'hypothyrotropic-hypothyroidism', 1, NULL, '2020-10-07 00:35:48', '2020-10-07 00:35:48'),
(224, 'IBD', 'ibd', 1, NULL, '2020-10-07 00:35:48', '2020-10-07 00:35:48'),
(225, 'IBS', 'ibs', 1, NULL, '2020-10-07 00:35:49', '2020-10-07 00:35:49'),
(226, 'ICMP', 'icmp', 1, NULL, '2020-10-07 00:35:49', '2020-10-07 00:35:49'),
(227, 'Idiopathic Hirsutism', 'idiopathic-hirsutism', 1, NULL, '2020-10-07 00:35:49', '2020-10-07 00:35:49'),
(228, 'Idiopathic Hypogonadotrophic Hypogonadism', 'idiopathic-hypogonadotrophic-hypogonadism', 1, NULL, '2020-10-07 00:35:49', '2020-10-07 00:35:49'),
(229, 'Idiopathic Hypoparathyroidism', 'idiopathic-hypoparathyroidism', 1, NULL, '2020-10-07 00:35:49', '2020-10-07 00:35:49'),
(230, 'Impaired Glucose Tolerance', 'impaired-glucose-tolerance', 1, NULL, '2020-10-07 00:35:49', '2020-10-07 00:35:49'),
(231, 'Impotence', 'impotence', 1, NULL, '2020-10-07 00:35:49', '2020-10-07 00:35:49'),
(232, 'Infertility', 'infertility', 1, NULL, '2020-10-07 00:35:50', '2020-10-07 00:35:50'),
(233, 'Insomnia', 'insomnia', 1, NULL, '2020-10-07 00:35:50', '2020-10-07 00:35:50'),
(234, 'Interferon Induced Thyroiditis', 'interferon-induced-thyroiditis', 1, NULL, '2020-10-07 00:35:50', '2020-10-07 00:35:50'),
(235, 'Intermittent Claudication', 'intermittent-claudication', 1, NULL, '2020-10-07 00:35:50', '2020-10-07 00:35:50'),
(236, 'Intestinal Obstruction', 'intestinal-obstruction', 1, NULL, '2020-10-07 00:35:50', '2020-10-07 00:35:50'),
(237, 'Intestinal TB', 'intestinal-tb', 1, NULL, '2020-10-07 00:35:50', '2020-10-07 00:35:50'),
(238, 'Iron Deficiency', 'iron-deficiency', 1, NULL, '2020-10-07 00:35:51', '2020-10-07 00:35:51'),
(239, 'Iron Deficiency Anemia', 'iron-deficiency-anemia', 1, NULL, '2020-10-07 00:35:51', '2020-10-07 00:35:51'),
(240, 'Irritable Bowel Syndrome', 'irritable-bowel-syndrome', 1, NULL, '2020-10-07 00:35:51', '2020-10-07 00:35:51'),
(241, 'Ischemic Heart Disease', 'ischemic-heart-disease', 1, NULL, '2020-10-07 00:35:51', '2020-10-07 00:35:51'),
(242, 'Ischemic Stroke', 'ischemic-stroke', 1, NULL, '2020-10-07 00:35:51', '2020-10-07 00:35:51'),
(243, 'ITP', 'itp', 1, NULL, '2020-10-07 00:35:51', '2020-10-07 00:35:51'),
(244, 'Joint Pains', 'joint-pains', 1, NULL, '2020-10-07 00:35:51', '2020-10-07 00:35:51'),
(245, 'Kallman Syndrome', 'kallman-syndrome', 1, NULL, '2020-10-07 00:35:51', '2020-10-07 00:35:51'),
(246, 'Klinefelters Syndrome', 'klinefelters-syndrome', 1, NULL, '2020-10-07 00:35:51', '2020-10-07 00:35:51'),
(247, 'Lactose Intolerance', 'lactose-intolerance', 1, NULL, '2020-10-07 00:35:51', '2020-10-07 00:35:51'),
(248, 'LADA', 'lada', 1, NULL, '2020-10-07 00:35:52', '2020-10-07 00:35:52'),
(249, 'LADA Vs T1DM', 'lada-vs-t1dm', 1, NULL, '2020-10-07 00:35:52', '2020-10-07 00:35:52'),
(250, 'LADA Vs T2DM', 'lada-vs-t2dm', 1, NULL, '2020-10-07 00:35:52', '2020-10-07 00:35:52'),
(251, 'Laurence-Moon-Biedl Syndrome', 'laurence-moon-biedl-syndrome', 1, NULL, '2020-10-07 00:35:52', '2020-10-07 00:35:52'),
(252, 'Left Knee Pain', 'left-knee-pain', 1, NULL, '2020-10-07 00:35:52', '2020-10-07 00:35:52'),
(253, 'Left Suprarenal Mass', 'left-suprarenal-mass', 1, NULL, '2020-10-07 00:35:52', '2020-10-07 00:35:52'),
(254, 'Left Thyroid Mass', 'left-thyroid-mass', 1, NULL, '2020-10-07 00:35:52', '2020-10-07 00:35:52'),
(255, 'Leg Edema', 'leg-edema', 1, NULL, '2020-10-07 00:35:53', '2020-10-07 00:35:53'),
(256, 'Leukemia', 'leukemia', 1, NULL, '2020-10-07 00:35:53', '2020-10-07 00:35:53'),
(257, 'Liver Abcess', 'liver-abcess', 1, NULL, '2020-10-07 00:35:53', '2020-10-07 00:35:53'),
(258, 'Liver Cirrhosis/Chronic Liver Disease', 'liver-cirrhosischronic-liver-disease', 1, NULL, '2020-10-07 00:35:53', '2020-10-07 00:35:53'),
(259, 'Low Blood Glucose', 'low-blood-glucose', 1, NULL, '2020-10-07 00:35:53', '2020-10-07 00:35:53'),
(260, 'Low Blood Pressure', 'low-blood-pressure', 1, NULL, '2020-10-07 00:35:54', '2020-10-07 00:35:54'),
(261, 'Low Cortisol', 'low-cortisol', 1, NULL, '2020-10-07 00:35:54', '2020-10-07 00:35:54'),
(262, 'LRTI', 'lrti', 1, NULL, '2020-10-07 00:35:54', '2020-10-07 00:35:54'),
(263, 'Lumbago', 'lumbago', 1, NULL, '2020-10-07 00:35:54', '2020-10-07 00:35:54'),
(264, 'Lung Cancer', 'lung-cancer', 1, NULL, '2020-10-07 00:35:54', '2020-10-07 00:35:54'),
(265, 'Lymphoma', 'lymphoma', 1, NULL, '2020-10-07 00:35:54', '2020-10-07 00:35:54'),
(266, 'Macroprolactinoma', 'macroprolactinoma', 1, NULL, '2020-10-07 00:35:54', '2020-10-07 00:35:54'),
(267, 'Major Depression', 'major-depression', 1, NULL, '2020-10-07 00:35:54', '2020-10-07 00:35:54'),
(268, 'Malaise', 'malaise', 1, NULL, '2020-10-07 00:35:54', '2020-10-07 00:35:54'),
(269, 'Marfan Syndrome', 'marfan-syndrome', 1, NULL, '2020-10-07 00:35:54', '2020-10-07 00:35:54'),
(270, 'Memory Loss', 'memory-loss', 1, NULL, '2020-10-07 00:35:54', '2020-10-07 00:35:54'),
(271, 'Menorrhagia', 'menorrhagia', 1, NULL, '2020-10-07 00:35:54', '2020-10-07 00:35:54'),
(272, 'Menstrual Irregularities', 'menstrual-irregularities', 1, NULL, '2020-10-07 00:35:54', '2020-10-07 00:35:54'),
(273, 'Metabolic Syndrome', 'metabolic-syndrome', 1, NULL, '2020-10-07 00:35:55', '2020-10-07 00:35:55'),
(274, 'Metastatic Liver Disease', 'metastatic-liver-disease', 1, NULL, '2020-10-07 00:35:55', '2020-10-07 00:35:55'),
(275, 'Microadenoma', 'microadenoma', 1, NULL, '2020-10-07 00:35:55', '2020-10-07 00:35:55'),
(276, 'Microalbuminuria', 'microalbuminuria', 1, NULL, '2020-10-07 00:35:55', '2020-10-07 00:35:55'),
(277, 'Micropenis', 'micropenis', 1, NULL, '2020-10-07 00:35:55', '2020-10-07 00:35:55'),
(278, 'Migraine Headache', 'migraine-headache', 1, NULL, '2020-10-07 00:35:55', '2020-10-07 00:35:55'),
(279, 'Mitral Stenosis', 'mitral-stenosis', 1, NULL, '2020-10-07 00:35:55', '2020-10-07 00:35:55'),
(280, 'Mixed Combined Dyslipidemia', 'mixed-combined-dyslipidemia', 1, NULL, '2020-10-07 00:35:55', '2020-10-07 00:35:55'),
(281, 'MODY Vs LADA', 'mody-vs-lada', 1, NULL, '2020-10-07 00:35:55', '2020-10-07 00:35:55'),
(282, 'Morbid Obesity', 'morbid-obesity', 1, NULL, '2020-10-07 00:35:55', '2020-10-07 00:35:55'),
(283, 'Motor Neuron Disease', 'motor-neuron-disease', 1, NULL, '2020-10-07 00:35:55', '2020-10-07 00:35:55'),
(284, 'Multi Focal HCC', 'multi-focal-hcc', 1, NULL, '2020-10-07 00:35:55', '2020-10-07 00:35:55'),
(285, 'Multinodular Goiter', 'multinodular-goiter', 1, NULL, '2020-10-07 00:35:55', '2020-10-07 00:35:55'),
(286, 'Myasthenia Gravis', 'myasthenia-gravis', 1, NULL, '2020-10-07 00:35:55', '2020-10-07 00:35:55'),
(287, 'Myopathy', 'myopathy', 1, NULL, '2020-10-07 00:35:56', '2020-10-07 00:35:56'),
(288, 'NAFLD', 'nafld', 1, NULL, '2020-10-07 00:35:56', '2020-10-07 00:35:56'),
(289, 'NASH', 'nash', 1, NULL, '2020-10-07 00:35:56', '2020-10-07 00:35:56'),
(290, 'Near Syncope', 'near-syncope', 1, NULL, '2020-10-07 00:35:56', '2020-10-07 00:35:56'),
(291, 'Necrobiosis Lipoidica Diabeticorum', 'necrobiosis-lipoidica-diabeticorum', 1, NULL, '2020-10-07 00:35:56', '2020-10-07 00:35:56'),
(292, 'Nephrolithiasis', 'nephrolithiasis', 1, NULL, '2020-10-07 00:35:56', '2020-10-07 00:35:56'),
(293, 'Nephropathy', 'nephropathy', 1, NULL, '2020-10-07 00:35:56', '2020-10-07 00:35:56'),
(294, 'Nephrotic Syndrome', 'nephrotic-syndrome', 1, NULL, '2020-10-07 00:35:56', '2020-10-07 00:35:56'),
(295, 'Neurofibromatosis', 'neurofibromatosis', 1, NULL, '2020-10-07 00:35:57', '2020-10-07 00:35:57'),
(296, 'Neuropathy', 'neuropathy', 1, NULL, '2020-10-07 00:35:57', '2020-10-07 00:35:57'),
(297, 'Nicotine Dependence', 'nicotine-dependence', 1, NULL, '2020-10-07 00:35:57', '2020-10-07 00:35:57'),
(298, 'Nocturnal Enuresis', 'nocturnal-enuresis', 1, NULL, '2020-10-07 00:35:57', '2020-10-07 00:35:57'),
(299, 'Normal Medical Exam', 'normal-medical-exam', 1, NULL, '2020-10-07 00:35:57', '2020-10-07 00:35:57'),
(300, 'Numbness Of Hand', 'numbness-of-hand', 1, NULL, '2020-10-07 00:35:57', '2020-10-07 00:35:57'),
(301, 'Numbness Of Hands And Feet', 'numbness-of-hands-and-feet', 1, NULL, '2020-10-07 00:35:58', '2020-10-07 00:35:58'),
(302, 'NVD', 'nvd', 1, NULL, '2020-10-07 00:35:58', '2020-10-07 00:35:58'),
(303, 'OA', 'oa', 1, NULL, '2020-10-07 00:35:58', '2020-10-07 00:35:58'),
(304, 'Obesity', 'obesity', 1, NULL, '2020-10-07 00:35:58', '2020-10-07 00:35:58'),
(305, 'Obstructive Jaundice', 'obstructive-jaundice', 1, NULL, '2020-10-07 00:35:59', '2020-10-07 00:35:59'),
(306, 'Obstructive Sleep Apnea', 'obstructive-sleep-apnea', 1, NULL, '2020-10-07 00:35:59', '2020-10-07 00:35:59'),
(307, 'Oligospermia', 'oligospermia', 1, NULL, '2020-10-07 00:35:59', '2020-10-07 00:35:59'),
(308, 'Onychomycosis', 'onychomycosis', 1, NULL, '2020-10-07 00:35:59', '2020-10-07 00:35:59'),
(309, 'Osteoarthritis', 'osteoarthritis', 1, NULL, '2020-10-07 00:35:59', '2020-10-07 00:35:59'),
(310, 'Osteogenic Imperfecta', 'osteogenic-imperfecta', 1, NULL, '2020-10-07 00:35:59', '2020-10-07 00:35:59'),
(311, 'Osteomalacia', 'osteomalacia', 1, NULL, '2020-10-07 00:35:59', '2020-10-07 00:35:59'),
(312, 'Osteopenia', 'osteopenia', 1, NULL, '2020-10-07 00:35:59', '2020-10-07 00:35:59'),
(313, 'Osteoporosis', 'osteoporosis', 1, NULL, '2020-10-07 00:35:59', '2020-10-07 00:35:59'),
(314, 'Ovarian Tumor', 'ovarian-tumor', 1, NULL, '2020-10-07 00:35:59', '2020-10-07 00:35:59'),
(315, 'Overweight', 'overweight', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(316, 'Painful Diabetic Neuropathy', 'painful-diabetic-neuropathy', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(317, 'Painful Peripheral Neuropathy', 'painful-peripheral-neuropathy', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(318, 'Painless Peripheral Neuropathy', 'painless-peripheral-neuropathy', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(319, 'Palpitations', 'palpitations', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(320, 'Pancreatic CA', 'pancreatic-ca', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(321, 'Pancreatitis', 'pancreatitis', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(322, 'Panhypopituitarism', 'panhypopituitarism', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(323, 'Parathyoidectomy', 'parathyoidectomy', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(324, 'Papillary Thyroid Carcinoma', 'papillary-thyroid-carcinoma', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(325, 'Parkinsonism', 'parkinsonism', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(326, 'PBC', 'pbc', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(327, 'PCOS', 'pcos', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(328, 'Pectus Carinatum', 'pectus-carinatum', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(329, 'Pedal Edema', 'pedal-edema', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(330, 'Percarditis', 'percarditis', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(331, 'Peripartam Cardiomyopathy', 'peripartam-cardiomyopathy', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(332, 'Peripheral Neuropathy', 'peripheral-neuropathy', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(333, 'Peripheral Vascular Disease', 'peripheral-vascular-disease', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(334, 'Pernicious Anemia', 'pernicious-anemia', 1, NULL, '2020-10-07 00:36:00', '2020-10-07 00:36:00'),
(335, 'Pituitary Macroadenoma', 'pituitary-macroadenoma', 1, NULL, '2020-10-07 00:36:01', '2020-10-07 00:36:01'),
(336, 'Pituitary Microadenoma', 'pituitary-microadenoma', 1, NULL, '2020-10-07 00:36:01', '2020-10-07 00:36:01'),
(337, 'Plummers Disease', 'plummers-disease', 1, NULL, '2020-10-07 00:36:01', '2020-10-07 00:36:01'),
(338, 'PND', 'pnd', 1, NULL, '2020-10-07 00:36:01', '2020-10-07 00:36:01'),
(339, 'Pneumonia', 'pneumonia', 1, NULL, '2020-10-07 00:36:01', '2020-10-07 00:36:01'),
(340, 'Polycystic Ovarian Syndrome', 'polycystic-ovarian-syndrome', 1, NULL, '2020-10-07 00:36:01', '2020-10-07 00:36:01'),
(341, 'Polyglandular Autoimmune Disorder Type II', 'polyglandular-autoimmune-disorder-type-ii', 1, NULL, '2020-10-07 00:36:01', '2020-10-07 00:36:01'),
(342, 'Polyuria', 'polyuria', 1, NULL, '2020-10-07 00:36:01', '2020-10-07 00:36:01'),
(343, 'Portal Vein Thrombosis', 'portal-vein-thrombosis', 1, NULL, '2020-10-07 00:36:02', '2020-10-07 00:36:02'),
(344, 'Post Pancreatitis Diabetes Mellitus', 'post-pancreatitis-diabetes-mellitus', 1, NULL, '2020-10-07 00:36:02', '2020-10-07 00:36:02'),
(345, 'Post Radioactive Iodine Rx Hypothyroidism', 'post-radioactive-iodine-rx-hypothyroidism', 1, NULL, '2020-10-07 00:36:02', '2020-10-07 00:36:02'),
(346, 'Post Surgical Hypoparathyroidism', 'post-surgical-hypoparathyroidism', 1, NULL, '2020-10-07 00:36:02', '2020-10-07 00:36:02'),
(347, 'Post Surgical Hypothyroidism', 'post-surgical-hypothyroidism', 1, NULL, '2020-10-07 00:36:02', '2020-10-07 00:36:02'),
(348, 'Post-CABG', 'post-cabg', 1, NULL, '2020-10-07 00:36:02', '2020-10-07 00:36:02'),
(349, 'Postmenopausal Hot Flashes', 'postmenopausal-hot-flashes', 1, NULL, '2020-10-07 00:36:02', '2020-10-07 00:36:02'),
(350, 'Postmenopause', 'postmenopause', 1, NULL, '2020-10-07 00:36:02', '2020-10-07 00:36:02'),
(351, 'Postsurgical Hypothyroidism', 'postsurgical-hypothyroidism', 1, NULL, '2020-10-07 00:36:02', '2020-10-07 00:36:02'),
(352, 'Precocious Puberty', 'precocious-puberty', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(353, 'Pre-Diabetes', 'pre-diabetes', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(354, 'Pre-gestational Diabetes Mellitus', 'pre-gestational-diabetes-mellitus', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(355, 'Premature Adrenarche', 'premature-adrenarche', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(356, 'Premature CAD', 'premature-cad', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(357, 'Premature Ejaculation', 'premature-ejaculation', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(358, 'Premature Ovarian Failure', 'premature-ovarian-failure', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(359, 'Pre-syncope', 'pre-syncope', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(360, 'Primary Ammenorhea', 'primary-ammenorhea', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(361, 'Primary Hyperparathyroidism', 'primary-hyperparathyroidism', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(362, 'Primary Hypoparathyroidism', 'primary-hypoparathyroidism', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(363, 'Primary Infertility', 'primary-infertility', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(364, 'Primary Ovarian Insufficiency', 'primary-ovarian-insufficiency', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(365, 'Probable OSA', 'probable-osa', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(366, 'Probable Osteoporosis', 'probable-osteoporosis', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(367, 'Probable PCOS', 'probable-pcos', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(368, 'Probable Vertebral Stenosis', 'probable-vertebral-stenosis', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(369, 'Probable Vitamin B12 Deficiency', 'probable-vitamin-b12-deficiency', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(370, 'Prolactinoma', 'prolactinoma', 1, NULL, '2020-10-07 00:36:03', '2020-10-07 00:36:03'),
(371, 'Prostatism', 'prostatism', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(372, 'Pseudo Gout', 'pseudo-gout', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(373, 'Pseudo Intermittent Claudication', 'pseudo-intermittent-claudication', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(374, 'PseudoCushings Disease', 'pseudocushings-disease', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(375, 'Pseudogynecomstia', 'pseudogynecomstia', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(376, 'Pseudo-Seizures', 'pseudo-seizures', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(377, 'Psoriasis', 'psoriasis', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(378, 'Psoriatic Arthritis', 'psoriatic-arthritis', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(379, 'Ptosis', 'ptosis', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(380, 'Puberty Goiter', 'puberty-goiter', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(381, 'Pulmonary TB', 'pulmonary-tb', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(382, 'PUO', 'puo', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(383, 'Recurrent Hypoglycemia', 'recurrent-hypoglycemia', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(384, 'Renal Glycosuria', 'renal-glycosuria', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(385, 'Renal Insufficiency', 'renal-insufficiency', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(386, 'Rheumatic Heart Disease', 'rheumatic-heart-disease', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(387, 'Rheumatoid Arthritis', 'rheumatoid-arthritis', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(388, 'Rickets', 'rickets', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(389, 'Right Breast Lump', 'right-breast-lump', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(390, 'Right Foot Pain', 'right-foot-pain', 1, NULL, '2020-10-07 00:36:04', '2020-10-07 00:36:04'),
(391, 'Right Hand Numbness', 'right-hand-numbness', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(392, 'Right Shoulder Pain', 'right-shoulder-pain', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(393, 'Sciatica', 'sciatica', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(394, 'Secondary Ammenorrhea', 'secondary-ammenorrhea', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(395, 'Secondary Hyperparathyroidism', 'secondary-hyperparathyroidism', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(396, 'Secondary Hypertension', 'secondary-hypertension', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(397, 'Secondary Infertility', 'secondary-infertility', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(398, 'Seizure Disorder', 'seizure-disorder', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(399, 'Senile Osteoporosis', 'senile-osteoporosis', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(400, 'Sertoli Only Syndrome', 'sertoli-only-syndrome', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(401, 'Severe Orbitopathy', 'severe-orbitopathy', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(402, 'Short Stature', 'short-stature', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(403, 'SP ASD Closure', 'sp-asd-closure', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(404, 'SP MI', 'sp-mi', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(405, 'SP Pituitary Adenoma Surgery', 'sp-pituitary-adenoma-surgery', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(406, 'SP PPM Placement', 'sp-ppm-placement', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(407, 'SP Surgery PTC Post Surgical Hypothyroidism', 'sp-surgery-ptc-post-surgical-hypothyroidism', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(408, 'SRUS', 'srus', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(409, 'Stable Angina', 'stable-angina', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(410, 'Status Post CVA', 'status-post-cva', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(411, 'Status Post Pituitary Adenoma Resection', 'status-post-pituitary-adenoma-resection', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(412, 'Status Post Pituitary Adenoma Surgery', 'status-post-pituitary-adenoma-surgery', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(413, 'Status Post RAI Rx For Hyperthyroidism', 'status-post-rai-rx-for-hyperthyroidism', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(414, 'Status Post Thyroiditis', 'status-post-thyroiditis', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(415, 'Steroid Induced Diabetes Mellitus', 'steroid-induced-diabetes-mellitus', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(416, 'Stress Incontinence', 'stress-incontinence', 1, NULL, '2020-10-07 00:36:05', '2020-10-07 00:36:05'),
(417, 'Sub Acute Intestinal Obstruction', 'sub-acute-intestinal-obstruction', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(418, 'Subclinical Hyperthyroidism', 'subclinical-hyperthyroidism', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(419, 'Subclinical Hypothyroidism', 'subclinical-hypothyroidism', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(420, 'Subfertility', 'subfertility', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(421, 'Suppurative Thyroiditis', 'suppurative-thyroiditis', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(422, 'Supraventricular Tachycardia', 'supraventricular-tachycardia', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(423, 'Suspected Adrenal Insufficiency', 'suspected-adrenal-insufficiency', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(424, 'Syncope', 'syncope', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(425, 'T1DM', 't1dm', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(426, 'T2DM', 't2dm', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(427, 'T2DM Vs LADA', 't2dm-vs-lada', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(428, 'T2DM, New Onset', 't2dm-new-onset', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(429, 'T3 Thyrotoxicosis', 't3-thyrotoxicosis', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(430, 'Tall Stature', 'tall-stature', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(431, 'TB', 'tb', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(432, 'Tension Headache', 'tension-headache', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(433, 'Tetany', 'tetany', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(434, 'Thalassemia Intermedia', 'thalassemia-intermedia', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(435, 'Thalassemia Major', 'thalassemia-major', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(436, 'Thalassemia Minor', 'thalassemia-minor', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(437, 'Thalassemia Trait', 'thalassemia-trait', 1, NULL, '2020-10-07 00:36:06', '2020-10-07 00:36:06'),
(438, 'Thrombocytopenia', 'thrombocytopenia', 1, NULL, '2020-10-07 00:36:07', '2020-10-07 00:36:07'),
(439, 'Thrombophlebitis', 'thrombophlebitis', 1, NULL, '2020-10-07 00:36:07', '2020-10-07 00:36:07'),
(440, 'Thyroid Eye Disease', 'thyroid-eye-disease', 1, NULL, '2020-10-07 00:36:07', '2020-10-07 00:36:07'),
(441, 'Thyroid Nodule', 'thyroid-nodule', 1, NULL, '2020-10-07 00:36:07', '2020-10-07 00:36:07'),
(442, 'Thyroid Resistance Syndrome', 'thyroid-resistance-syndrome', 1, NULL, '2020-10-07 00:36:07', '2020-10-07 00:36:07'),
(443, 'Thyroiditis', 'thyroiditis', 1, NULL, '2020-10-07 00:36:07', '2020-10-07 00:36:07'),
(444, 'Thyrotoxicosis', 'thyrotoxicosis', 1, NULL, '2020-10-07 00:36:07', '2020-10-07 00:36:07'),
(445, 'Tibial Fx', 'tibial-fx', 1, NULL, '2020-10-07 00:36:07', '2020-10-07 00:36:07'),
(446, 'Titubation', 'titubation', 1, NULL, '2020-10-07 00:36:07', '2020-10-07 00:36:07'),
(447, 'Toxic MNG', 'toxic-mng', 1, NULL, '2020-10-07 00:36:07', '2020-10-07 00:36:07'),
(448, 'Toxic MNG With Iatrogenic Hypothyroidism', 'toxic-mng-with-iatrogenic-hypothyroidism', 1, NULL, '2020-10-07 00:36:07', '2020-10-07 00:36:07'),
(449, 'Toxic Mutinodular Goiter', 'toxic-mutinodular-goiter', 1, NULL, '2020-10-07 00:36:07', '2020-10-07 00:36:07'),
(450, 'Toxic Uninodular Goiter', 'toxic-uninodular-goiter', 1, NULL, '2020-10-07 00:36:07', '2020-10-07 00:36:07'),
(451, 'Transient Ischemic Attack', 'transient-ischemic-attack', 1, NULL, '2020-10-07 00:36:07', '2020-10-07 00:36:07'),
(452, 'Tremors', 'tremors', 1, NULL, '2020-10-07 00:36:07', '2020-10-07 00:36:07'),
(453, 'Turner Syndrome', 'turner-syndrome', 1, NULL, '2020-10-07 00:36:07', '2020-10-07 00:36:07'),
(454, 'Type 1 Diabetes Mellitus', 'type-1-diabetes-mellitus', 1, NULL, '2020-10-07 00:36:07', '2020-10-07 00:36:07'),
(455, 'Type 1 Diabetes Mellitus Vs. LADA', 'type-1-diabetes-mellitus-vs-lada', 1, NULL, '2020-10-07 00:36:08', '2020-10-07 00:36:08'),
(456, 'Type 2 Diabetes Mellitus', 'type-2-diabetes-mellitus', 1, NULL, '2020-10-07 00:36:08', '2020-10-07 00:36:08'),
(457, 'Ulcerative Colitis', 'ulcerative-colitis', 1, NULL, '2020-10-07 00:36:08', '2020-10-07 00:36:08'),
(458, 'Umbilical Hernia', 'umbilical-hernia', 1, NULL, '2020-10-07 00:36:08', '2020-10-07 00:36:08'),
(459, 'Underweight', 'underweight', 1, NULL, '2020-10-07 00:36:08', '2020-10-07 00:36:08'),
(460, 'Upper Backache', 'upper-backache', 1, NULL, '2020-10-07 00:36:08', '2020-10-07 00:36:08'),
(461, 'Upper Respiratory Tract Infection', 'upper-respiratory-tract-infection', 1, NULL, '2020-10-07 00:36:08', '2020-10-07 00:36:08'),
(462, 'Urinary Frequency', 'urinary-frequency', 1, NULL, '2020-10-07 00:36:08', '2020-10-07 00:36:08'),
(463, 'Urinary Tract Infection', 'urinary-tract-infection', 1, NULL, '2020-10-07 00:36:08', '2020-10-07 00:36:08'),
(464, 'URTI', 'urti', 1, NULL, '2020-10-07 00:36:08', '2020-10-07 00:36:08'),
(465, 'Urticaria', 'urticaria', 1, NULL, '2020-10-07 00:36:08', '2020-10-07 00:36:08'),
(466, 'Valvular Heart Disease', 'valvular-heart-disease', 1, NULL, '2020-10-07 00:36:08', '2020-10-07 00:36:08'),
(467, 'Varicose Veins', 'varicose-veins', 1, NULL, '2020-10-07 00:36:08', '2020-10-07 00:36:08'),
(468, 'Vertebral Fracture', 'vertebral-fracture', 1, NULL, '2020-10-07 00:36:08', '2020-10-07 00:36:08'),
(469, 'Vertebral Stenosis', 'vertebral-stenosis', 1, NULL, '2020-10-07 00:36:09', '2020-10-07 00:36:09'),
(470, 'Vitamin B12 Deficiency', 'vitamin-b12-deficiency', 1, NULL, '2020-10-07 00:36:09', '2020-10-07 00:36:09'),
(471, 'Vitiligo', 'vitiligo', 1, NULL, '2020-10-07 00:36:09', '2020-10-07 00:36:09'),
(472, 'VSD', 'vsd', 1, NULL, '2020-10-07 00:36:09', '2020-10-07 00:36:09'),
(473, 'VSD Closure', 'vsd-closure', 1, NULL, '2020-10-07 00:36:09', '2020-10-07 00:36:09'),
(474, 'Weakness', 'weakness', 1, NULL, '2020-10-07 00:36:09', '2020-10-07 00:36:09'),
(475, 'Weight Gain', 'weight-gain', 1, NULL, '2020-10-07 00:36:09', '2020-10-07 00:36:09'),
(476, 'Weight Loss', 'weight-loss', 1, NULL, '2020-10-07 00:36:09', '2020-10-07 00:36:09'),
(477, 'Weight Normal For Height', 'weight-normal-for-height', 1, NULL, '2020-10-07 00:36:09', '2020-10-07 00:36:09'),
(478, 'White Coat Syndrome', 'white-coat-syndrome', 1, NULL, '2020-10-07 00:36:09', '2020-10-07 00:36:09'),
(479, 'Wilsons Disease', 'wilsons-disease', 1, NULL, '2020-10-07 00:36:09', '2020-10-07 00:36:09'),
(480, 'Test 19june', 'test-19june', 1, '2020-10-08 05:47:56', '2020-10-07 00:36:09', '2020-10-08 05:47:56'),
(481, 'Test 1', 'test-1', 1, '2020-10-08 05:47:51', '2020-10-07 00:36:09', '2020-10-08 05:47:51'),
(482, 'Abc Test', 'abc-test', 1, '2020-10-08 05:47:46', '2020-10-07 00:36:09', '2020-10-08 05:47:46'),
(483, 'Test 20june', 'test-20june', 1, '2020-10-08 05:47:41', '2020-10-07 00:36:09', '2020-10-08 05:47:41'),
(484, 'Abc21', 'abc21', 1, '2020-10-08 05:47:36', '2020-10-07 00:36:09', '2020-10-08 05:47:36');

-- --------------------------------------------------------

--
-- Table structure for table `doses`
--

CREATE TABLE `doses` (
  `id` int(11) UNSIGNED NOT NULL,
  `dose` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doses`
--

INSERT INTO `doses` (`id`, `dose`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1471, '400', 1, NULL, '2020-10-07 04:35:29', '2020-10-07 04:35:29'),
(1472, '1', 1, NULL, '2020-10-07 04:35:29', '2020-10-07 04:35:29'),
(1473, '20', 1, NULL, '2020-10-07 04:35:29', '2020-10-07 04:35:29'),
(1474, '50', 1, NULL, '2020-10-07 04:35:30', '2020-10-07 04:35:30'),
(1475, '10', 1, NULL, '2020-10-07 04:35:30', '2020-10-07 04:35:30'),
(1476, '5', 1, NULL, '2020-10-07 04:35:30', '2020-10-07 04:35:30'),
(1477, '60', 1, NULL, '2020-10-07 04:35:30', '2020-10-07 04:35:30'),
(1478, '200', 1, NULL, '2020-10-07 04:35:30', '2020-10-07 04:35:30'),
(1479, '250', 1, NULL, '2020-10-07 04:35:30', '2020-10-07 04:35:30'),
(1480, '2.5 / 1.25 %', 1, NULL, '2020-10-07 04:35:30', '2020-10-07 04:35:30'),
(1481, '2%', 1, NULL, '2020-10-07 04:35:30', '2020-10-07 04:35:30'),
(1482, '0.10%', 1, NULL, '2020-10-07 04:35:30', '2020-10-07 04:35:30'),
(1483, '0.5', 1, NULL, '2020-10-07 04:35:30', '2020-10-07 04:35:30'),
(1484, '250 Iu', 1, NULL, '2020-10-07 04:35:30', '2020-10-07 04:35:30'),
(1485, '1.5 / 36 / 300', 1, NULL, '2020-10-07 04:35:30', '2020-10-07 04:35:30'),
(1486, '4', 1, NULL, '2020-10-07 04:35:30', '2020-10-07 04:35:30'),
(1487, '6', 1, NULL, '2020-10-07 04:35:30', '2020-10-07 04:35:30'),
(1488, '8', 1, NULL, '2020-10-07 04:35:30', '2020-10-07 04:35:30'),
(1489, '12', 1, NULL, '2020-10-07 04:35:30', '2020-10-07 04:35:30'),
(1490, '14', 1, NULL, '2020-10-07 04:35:30', '2020-10-07 04:35:30'),
(1491, '16', 1, NULL, '2020-10-07 04:35:30', '2020-10-07 04:35:30'),
(1492, '18', 1, NULL, '2020-10-07 04:35:31', '2020-10-07 04:35:31'),
(1493, '22', 1, NULL, '2020-10-07 04:35:31', '2020-10-07 04:35:31'),
(1494, '24', 1, NULL, '2020-10-07 04:35:31', '2020-10-07 04:35:31'),
(1495, '26', 1, NULL, '2020-10-07 04:35:31', '2020-10-07 04:35:31'),
(1496, '28', 1, NULL, '2020-10-07 04:35:31', '2020-10-07 04:35:31'),
(1497, '30', 1, NULL, '2020-10-07 04:35:31', '2020-10-07 04:35:31'),
(1498, '32', 1, NULL, '2020-10-07 04:35:31', '2020-10-07 04:35:31'),
(1499, '34', 1, NULL, '2020-10-07 04:35:31', '2020-10-07 04:35:31'),
(1500, '36', 1, NULL, '2020-10-07 04:35:31', '2020-10-07 04:35:31'),
(1501, '38', 1, NULL, '2020-10-07 04:35:31', '2020-10-07 04:35:31'),
(1502, '40', 1, NULL, '2020-10-07 04:35:31', '2020-10-07 04:35:31'),
(1503, '42', 1, NULL, '2020-10-07 04:35:31', '2020-10-07 04:35:31'),
(1504, '44', 1, NULL, '2020-10-07 04:35:31', '2020-10-07 04:35:31'),
(1505, '46', 1, NULL, '2020-10-07 04:35:31', '2020-10-07 04:35:31'),
(1506, '48', 1, NULL, '2020-10-07 04:35:31', '2020-10-07 04:35:31'),
(1507, '52', 1, NULL, '2020-10-07 04:35:31', '2020-10-07 04:35:31'),
(1508, '54', 1, NULL, '2020-10-07 04:35:31', '2020-10-07 04:35:31'),
(1509, '56', 1, NULL, '2020-10-07 04:35:31', '2020-10-07 04:35:31'),
(1510, '58', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1511, '62', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1512, '64', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1513, '66', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1514, '68', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1515, '70', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1516, '16/12.5', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1517, '0.25', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1518, '100', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1519, '25 / 25', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1520, '50 / 50', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1521, '150', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1522, '0.20%', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1523, '32.5 / 325', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1524, '3', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1525, '1/500', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1526, '2/500', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1527, 'Oct-40', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1528, 'May-40', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1529, 'May-80', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1530, '10 Mcg', 1, NULL, '2020-10-07 04:35:32', '2020-10-07 04:35:32'),
(1531, '20 Mcg', 1, NULL, '2020-10-07 04:35:33', '2020-10-07 04:35:33'),
(1532, '125', 1, NULL, '2020-10-07 04:35:33', '2020-10-07 04:35:33'),
(1533, '75', 1, NULL, '2020-10-07 04:35:33', '2020-10-07 04:35:33'),
(1534, '300', 1, NULL, '2020-10-07 04:35:33', '2020-10-07 04:35:33'),
(1535, '150/12.5', 1, NULL, '2020-10-07 04:35:33', '2020-10-07 04:35:33'),
(1536, '300/12.5', 1, NULL, '2020-10-07 04:35:33', '2020-10-07 04:35:33'),
(1537, '80', 1, NULL, '2020-10-07 04:35:33', '2020-10-07 04:35:33'),
(1538, '40/240', 1, NULL, '2020-10-07 04:35:33', '2020-10-07 04:35:33'),
(1539, '80/480', 1, NULL, '2020-10-07 04:35:33', '2020-10-07 04:35:33'),
(1540, '120', 1, NULL, '2020-10-07 04:35:33', '2020-10-07 04:35:33'),
(1541, '625/125', 1, NULL, '2020-10-07 04:35:33', '2020-10-07 04:35:33'),
(1542, '160', 1, NULL, '2020-10-07 04:35:33', '2020-10-07 04:35:33'),
(1543, '160/10', 1, NULL, '2020-10-07 04:35:33', '2020-10-07 04:35:33'),
(1544, '160/5', 1, NULL, '2020-10-07 04:35:33', '2020-10-07 04:35:33'),
(1545, '80/5', 1, NULL, '2020-10-07 04:35:33', '2020-10-07 04:35:33'),
(1546, '10/160/12.5', 1, NULL, '2020-10-07 04:35:33', '2020-10-07 04:35:33'),
(1547, '10/160/25', 1, NULL, '2020-10-07 04:35:33', '2020-10-07 04:35:33'),
(1548, '10/320/25', 1, NULL, '2020-10-07 04:35:33', '2020-10-07 04:35:33'),
(1549, '5/160/12.5', 1, NULL, '2020-10-07 04:35:34', '2020-10-07 04:35:34'),
(1550, '5/160/25', 1, NULL, '2020-10-07 04:35:34', '2020-10-07 04:35:34'),
(1551, '450', 1, NULL, '2020-10-07 04:35:34', '2020-10-07 04:35:34'),
(1552, '0.6 Mu', 1, NULL, '2020-10-07 04:35:34', '2020-10-07 04:35:34'),
(1553, '1.20 Mu', 1, NULL, '2020-10-07 04:35:34', '2020-10-07 04:35:34'),
(1554, '0.1 / 0.5', 1, NULL, '2020-10-07 04:35:34', '2020-10-07 04:35:34'),
(1555, '0.25%', 1, NULL, '2020-10-07 04:35:34', '2020-10-07 04:35:34'),
(1556, '10 / 0.2 %', 1, NULL, '2020-10-07 04:35:34', '2020-10-07 04:35:34'),
(1557, '10 / 0.2 / 0.12 %', 1, NULL, '2020-10-07 04:35:34', '2020-10-07 04:35:34'),
(1558, '100/25', 1, NULL, '2020-10-07 04:35:34', '2020-10-07 04:35:34'),
(1559, '50/12.5', 1, NULL, '2020-10-07 04:35:34', '2020-10-07 04:35:34'),
(1560, '8.7/ 0.01%', 1, NULL, '2020-10-07 04:35:34', '2020-10-07 04:35:34'),
(1561, '1 Mcg', 1, NULL, '2020-10-07 04:35:34', '2020-10-07 04:35:34'),
(1562, '600', 1, NULL, '2020-10-07 04:35:34', '2020-10-07 04:35:34'),
(1563, '10 / 250', 1, NULL, '2020-10-07 04:35:34', '2020-10-07 04:35:34'),
(1564, '20 / 2.5 Mg / Gm', 1, NULL, '2020-10-07 04:35:35', '2020-10-07 04:35:35'),
(1565, '5 Mcg', 1, NULL, '2020-10-07 04:35:35', '2020-10-07 04:35:35'),
(1566, '10-may', 1, NULL, '2020-10-07 04:35:35', '2020-10-07 04:35:35'),
(1567, '20-may', 1, NULL, '2020-10-07 04:35:35', '2020-10-07 04:35:35'),
(1568, '830/400 Iu', 1, NULL, '2020-10-07 04:35:35', '2020-10-07 04:35:35'),
(1569, '240', 1, NULL, '2020-10-07 04:35:35', '2020-10-07 04:35:35'),
(1570, '500', 1, NULL, '2020-10-07 04:35:35', '2020-10-07 04:35:35'),
(1571, '500 / 65', 1, NULL, '2020-10-07 04:35:35', '2020-10-07 04:35:35'),
(1572, '1500', 1, NULL, '2020-10-07 04:35:35', '2020-10-07 04:35:35'),
(1573, '1%', 1, NULL, '2020-10-07 04:35:35', '2020-10-07 04:35:35'),
(1574, '160/12.5', 1, NULL, '2020-10-07 04:35:35', '2020-10-07 04:35:35'),
(1575, '0.08%', 1, NULL, '2020-10-07 04:35:35', '2020-10-07 04:35:35'),
(1576, '20-oct', 1, NULL, '2020-10-07 04:35:35', '2020-10-07 04:35:35'),
(1577, '0.03%', 1, NULL, '2020-10-07 04:35:36', '2020-10-07 04:35:36'),
(1578, '5/12.5', 1, NULL, '2020-10-07 04:35:36', '2020-10-07 04:35:36'),
(1579, '2.6', 1, NULL, '2020-10-07 04:35:36', '2020-10-07 04:35:36'),
(1580, '6.4', 1, NULL, '2020-10-07 04:35:36', '2020-10-07 04:35:36'),
(1581, '12.5', 1, NULL, '2020-10-07 04:35:36', '2020-10-07 04:35:36'),
(1582, '6.25', 1, NULL, '2020-10-07 04:35:36', '2020-10-07 04:35:36'),
(1583, '100 / 25', 1, NULL, '2020-10-07 04:35:36', '2020-10-07 04:35:36'),
(1584, '3.125', 1, NULL, '2020-10-07 04:35:36', '2020-10-07 04:35:36'),
(1585, '400 / 2.5 /', 1, NULL, '2020-10-07 04:35:36', '2020-10-07 04:35:36'),
(1586, 'Ongoing', 1, NULL, '2020-10-07 04:35:36', '2020-10-07 04:35:36'),
(1587, 'Syp', 1, NULL, '2020-10-07 04:35:36', '2020-10-07 04:35:36'),
(1588, '50/100', 1, NULL, '2020-10-07 04:35:36', '2020-10-07 04:35:36'),
(1589, 'No Dose Mentioned Dose', 1, NULL, '2020-10-07 04:35:36', '2020-10-07 04:35:36'),
(1590, '0.8 / 1.6', 1, NULL, '2020-10-07 04:35:37', '2020-10-07 04:35:37'),
(1591, '250 Mcg', 1, NULL, '2020-10-07 04:35:37', '2020-10-07 04:35:37'),
(1592, '0.05%', 1, NULL, '2020-10-07 04:35:37', '2020-10-07 04:35:37'),
(1593, '160/25', 1, NULL, '2020-10-07 04:35:37', '2020-10-07 04:35:37'),
(1594, '80/12.5', 1, NULL, '2020-10-07 04:35:37', '2020-10-07 04:35:37'),
(1595, '325 / 30 / 1 / 10 / 50', 1, NULL, '2020-10-07 04:35:37', '2020-10-07 04:35:37'),
(1596, '6.5 / 6.5 / 13 / 250', 1, NULL, '2020-10-07 04:35:37', '2020-10-07 04:35:37'),
(1597, '1 / 12 / 325 / 10', 1, NULL, '2020-10-07 04:35:37', '2020-10-07 04:35:37'),
(1598, '135', 1, NULL, '2020-10-07 04:35:37', '2020-10-07 04:35:37'),
(1599, '75mg', 1, NULL, '2020-10-07 04:35:37', '2020-10-07 04:35:37'),
(1600, '25-oct', 1, NULL, '2020-10-07 04:35:37', '2020-10-07 04:35:37'),
(1601, '40/12.5', 1, NULL, '2020-10-07 04:35:37', '2020-10-07 04:35:37'),
(1602, '20/12.5', 1, NULL, '2020-10-07 04:35:37', '2020-10-07 04:35:37'),
(1603, '5-apr', 1, NULL, '2020-10-07 04:35:37', '2020-10-07 04:35:37'),
(1604, '10-aug', 1, NULL, '2020-10-07 04:35:37', '2020-10-07 04:35:37'),
(1605, '5-aug', 1, NULL, '2020-10-07 04:35:37', '2020-10-07 04:35:37'),
(1606, 'No Dose Mentioned', 1, NULL, '2020-10-07 04:35:37', '2020-10-07 04:35:37'),
(1607, '20/gram', 1, NULL, '2020-10-07 04:35:38', '2020-10-07 04:35:38'),
(1608, '2 % (percent)', 1, NULL, '2020-10-07 04:35:38', '2020-10-07 04:35:38'),
(1609, '200000', 1, NULL, '2020-10-07 04:35:38', '2020-10-07 04:35:38'),
(1610, '50 Mg', 1, NULL, '2020-10-07 04:35:38', '2020-10-07 04:35:38'),
(1611, '100 Mg', 1, NULL, '2020-10-07 04:35:38', '2020-10-07 04:35:38'),
(1612, '25 Mg', 1, NULL, '2020-10-07 04:35:38', '2020-10-07 04:35:38'),
(1613, '15 / 500', 1, NULL, '2020-10-07 04:35:38', '2020-10-07 04:35:38'),
(1614, '2 / 35 /', 1, NULL, '2020-10-07 04:35:38', '2020-10-07 04:35:38'),
(1615, '1.16/100 Gm', 1, NULL, '2020-10-07 04:35:38', '2020-10-07 04:35:38'),
(1616, '10000 / 500 Potency_unit', 1, NULL, '2020-10-07 04:35:38', '2020-10-07 04:35:38'),
(1617, '50000', 1, NULL, '2020-10-07 04:35:38', '2020-10-07 04:35:38'),
(1618, '500/400', 1, NULL, '2020-10-07 04:35:39', '2020-10-07 04:35:39'),
(1619, '16.7 / 16.7 %', 1, NULL, '2020-10-07 04:35:39', '2020-10-07 04:35:39'),
(1620, '120 Ml', 1, NULL, '2020-10-07 04:35:39', '2020-10-07 04:35:39'),
(1621, '60 Ml', 1, NULL, '2020-10-07 04:35:39', '2020-10-07 04:35:39'),
(1622, '30/10', 1, NULL, '2020-10-07 04:35:39', '2020-10-07 04:35:39'),
(1623, '37.5', 1, NULL, '2020-10-07 04:35:39', '2020-10-07 04:35:39'),
(1624, '2/850', 1, NULL, '2020-10-07 04:35:39', '2020-10-07 04:35:39'),
(1625, '4.5', 1, NULL, '2020-10-07 04:35:39', '2020-10-07 04:35:39'),
(1626, '500 / 500 Iu', 1, NULL, '2020-10-07 04:35:39', '2020-10-07 04:35:39'),
(1627, '10/160', 1, NULL, '2020-10-07 04:35:39', '2020-10-07 04:35:39'),
(1628, '5/160', 1, NULL, '2020-10-07 04:35:39', '2020-10-07 04:35:39'),
(1629, '5/80', 1, NULL, '2020-10-07 04:35:39', '2020-10-07 04:35:39'),
(1630, '20/1100', 1, NULL, '2020-10-07 04:35:39', '2020-10-07 04:35:39'),
(1631, '40/1100', 1, NULL, '2020-10-07 04:35:39', '2020-10-07 04:35:39'),
(1632, '0.5 Mcg', 1, NULL, '2020-10-07 04:35:39', '2020-10-07 04:35:39'),
(1633, '20/120', 1, NULL, '2020-10-07 04:35:39', '2020-10-07 04:35:39'),
(1634, '0.15 / 0.03', 1, NULL, '2020-10-07 04:35:39', '2020-10-07 04:35:39'),
(1635, '2.50%', 1, NULL, '2020-10-07 04:35:39', '2020-10-07 04:35:39'),
(1636, '67', 1, NULL, '2020-10-07 04:35:40', '2020-10-07 04:35:40'),
(1637, '100/0.35', 1, NULL, '2020-10-07 04:35:40', '2020-10-07 04:35:40'),
(1638, '1000/300', 1, NULL, '2020-10-07 04:35:40', '2020-10-07 04:35:40'),
(1639, '75/75', 1, NULL, '2020-10-07 04:35:40', '2020-10-07 04:35:40'),
(1640, '0.4', 1, NULL, '2020-10-07 04:35:40', '2020-10-07 04:35:40'),
(1641, '0.1 / 0.5 %', 1, NULL, '2020-10-07 04:35:40', '2020-10-07 04:35:40'),
(1642, '10000 Iu', 1, NULL, '2020-10-07 04:35:40', '2020-10-07 04:35:40'),
(1643, '2500 Iu', 1, NULL, '2020-10-07 04:35:40', '2020-10-07 04:35:40'),
(1644, '5000 Iu', 1, NULL, '2020-10-07 04:35:40', '2020-10-07 04:35:40'),
(1645, '7500 Iu', 1, NULL, '2020-10-07 04:35:40', '2020-10-07 04:35:40'),
(1646, '0.3', 1, NULL, '2020-10-07 04:35:40', '2020-10-07 04:35:40'),
(1647, '0.6', 1, NULL, '2020-10-07 04:35:40', '2020-10-07 04:35:40'),
(1648, '580', 1, NULL, '2020-10-07 04:35:40', '2020-10-07 04:35:40'),
(1649, '90', 1, NULL, '2020-10-07 04:35:40', '2020-10-07 04:35:40'),
(1650, '50/1000', 1, NULL, '2020-10-07 04:35:40', '2020-10-07 04:35:40'),
(1651, '50/850', 1, NULL, '2020-10-07 04:35:40', '2020-10-07 04:35:40'),
(1652, '50/500', 1, NULL, '2020-10-07 04:35:40', '2020-10-07 04:35:40'),
(1653, '200 / 200 / 25', 1, NULL, '2020-10-07 04:35:41', '2020-10-07 04:35:41'),
(1654, '850', 1, NULL, '2020-10-07 04:35:41', '2020-10-07 04:35:41'),
(1655, '750', 1, NULL, '2020-10-07 04:35:41', '2020-10-07 04:35:41'),
(1656, 'Cap', 1, NULL, '2020-10-07 04:35:41', '2020-10-07 04:35:41'),
(1657, '75 Iu', 1, NULL, '2020-10-07 04:35:41', '2020-10-07 04:35:41'),
(1658, '360 Potency_unit', 1, NULL, '2020-10-07 04:35:41', '2020-10-07 04:35:41'),
(1659, '720 Potency_unit', 1, NULL, '2020-10-07 04:35:41', '2020-10-07 04:35:41'),
(1660, '180', 1, NULL, '2020-10-07 04:35:41', '2020-10-07 04:35:41'),
(1661, '7', 1, NULL, '2020-10-07 04:35:41', '2020-10-07 04:35:41'),
(1662, '___ Potency_unit', 1, NULL, '2020-10-07 04:35:41', '2020-10-07 04:35:41'),
(1663, '40 Iu', 1, NULL, '2020-10-07 04:35:42', '2020-10-07 04:35:42'),
(1664, 'Vitamin D', 1, NULL, '2020-10-07 04:35:42', '2020-10-07 04:35:42'),
(1665, '0.1 % (percent)', 1, NULL, '2020-10-07 04:35:42', '2020-10-07 04:35:42'),
(1666, '19.2 / 7.2 / 4.5', 1, NULL, '2020-10-07 04:35:42', '2020-10-07 04:35:42'),
(1667, '1 % (percent)', 1, NULL, '2020-10-07 04:35:42', '2020-10-07 04:35:42'),
(1668, '40 / 5', 1, NULL, '2020-10-07 04:35:42', '2020-10-07 04:35:42'),
(1669, 'Tab', 1, NULL, '2020-10-07 04:35:42', '2020-10-07 04:35:42'),
(1670, '3.35', 1, NULL, '2020-10-07 04:35:42', '2020-10-07 04:35:42'),
(1671, '10-oct', 1, NULL, '2020-10-07 04:35:42', '2020-10-07 04:35:42'),
(1672, '65', 1, NULL, '2020-10-07 04:35:42', '2020-10-07 04:35:42'),
(1673, '11.25', 1, NULL, '2020-10-07 04:35:42', '2020-10-07 04:35:42'),
(1674, '3.75', 1, NULL, '2020-10-07 04:35:42', '2020-10-07 04:35:42'),
(1675, '7.5', 1, NULL, '2020-10-07 04:35:42', '2020-10-07 04:35:42'),
(1676, '5ml/50mg', 1, NULL, '2020-10-07 04:35:42', '2020-10-07 04:35:42'),
(1677, '100 / 0.35', 1, NULL, '2020-10-07 04:35:42', '2020-10-07 04:35:42'),
(1678, '35 / 450', 1, NULL, '2020-10-07 04:35:42', '2020-10-07 04:35:42'),
(1679, '50/450/30', 1, NULL, '2020-10-07 04:35:42', '2020-10-07 04:35:42'),
(1680, '40/5', 1, NULL, '2020-10-07 04:35:43', '2020-10-07 04:35:43'),
(1681, '225 / 120 / 60 / 300', 1, NULL, '2020-10-07 04:35:43', '2020-10-07 04:35:43'),
(1682, '150/75/300', 1, NULL, '2020-10-07 04:35:43', '2020-10-07 04:35:43'),
(1683, '120/60/225/300', 1, NULL, '2020-10-07 04:35:43', '2020-10-07 04:35:43'),
(1684, '150/75/275/400', 1, NULL, '2020-10-07 04:35:43', '2020-10-07 04:35:43'),
(1685, '275 / 150 / 75 / 400', 1, NULL, '2020-10-07 04:35:43', '2020-10-07 04:35:43'),
(1686, '55mcg/dose', 1, NULL, '2020-10-07 04:35:43', '2020-10-07 04:35:43'),
(1687, '2.5 Mg', 1, NULL, '2020-10-07 04:35:43', '2020-10-07 04:35:43'),
(1688, '5 Mg', 1, NULL, '2020-10-07 04:35:43', '2020-10-07 04:35:43'),
(1689, '11', 1, NULL, '2020-10-07 04:35:43', '2020-10-07 04:35:43'),
(1690, '13', 1, NULL, '2020-10-07 04:35:43', '2020-10-07 04:35:43'),
(1691, '17', 1, NULL, '2020-10-07 04:35:43', '2020-10-07 04:35:43'),
(1692, '19', 1, NULL, '2020-10-07 04:35:43', '2020-10-07 04:35:43'),
(1693, '21', 1, NULL, '2020-10-07 04:35:43', '2020-10-07 04:35:43'),
(1694, '23', 1, NULL, '2020-10-07 04:35:43', '2020-10-07 04:35:43'),
(1695, '27', 1, NULL, '2020-10-07 04:35:43', '2020-10-07 04:35:43'),
(1696, '29', 1, NULL, '2020-10-07 04:35:44', '2020-10-07 04:35:44'),
(1697, '9', 1, NULL, '2020-10-07 04:35:44', '2020-10-07 04:35:44'),
(1698, '0.15 / 0.03 / 7', 1, NULL, '2020-10-07 04:35:44', '2020-10-07 04:35:44'),
(1699, '20/25', 1, NULL, '2020-10-07 04:35:44', '2020-10-07 04:35:44'),
(1700, '0.3 % (percent)', 1, NULL, '2020-10-07 04:35:44', '2020-10-07 04:35:44'),
(1701, '800', 1, NULL, '2020-10-07 04:35:44', '2020-10-07 04:35:44'),
(1702, '500 / 400', 1, NULL, '2020-10-07 04:35:44', '2020-10-07 04:35:44'),
(1703, '500 / 60 / 4', 1, NULL, '2020-10-07 04:35:44', '2020-10-07 04:35:44'),
(1704, '1.75 / 1.45 / 0.75 / 10', 1, NULL, '2020-10-07 04:35:44', '2020-10-07 04:35:44'),
(1705, '2mg', 1, NULL, '2020-10-07 04:35:44', '2020-10-07 04:35:44'),
(1706, '1mg', 1, NULL, '2020-10-07 04:35:44', '2020-10-07 04:35:44'),
(1707, '0.625', 1, NULL, '2020-10-07 04:35:44', '2020-10-07 04:35:44'),
(1708, '1.25', 1, NULL, '2020-10-07 04:35:44', '2020-10-07 04:35:44'),
(1709, '0.05 % (percent)', 1, NULL, '2020-10-07 04:35:44', '2020-10-07 04:35:44'),
(1710, 'Vaccine', 1, NULL, '2020-10-07 04:35:44', '2020-10-07 04:35:44'),
(1711, '2/0.5', 1, NULL, '2020-10-07 04:35:45', '2020-10-07 04:35:45'),
(1712, '0.5 % (percent)', 1, NULL, '2020-10-07 04:35:45', '2020-10-07 04:35:45'),
(1713, '0.1 / 0.05 % (percent)', 1, NULL, '2020-10-07 04:35:45', '2020-10-07 04:35:45'),
(1714, '200 Mcg', 1, NULL, '2020-10-07 04:35:45', '2020-10-07 04:35:45'),
(1715, '50 Mcg', 1, NULL, '2020-10-07 04:35:45', '2020-10-07 04:35:45'),
(1716, '1250', 1, NULL, '2020-10-07 04:35:45', '2020-10-07 04:35:45'),
(1717, '0.5 Ml', 1, NULL, '2020-10-07 04:35:45', '2020-10-07 04:35:45'),
(1718, '150 / 75 / 400', 1, NULL, '2020-10-07 04:35:45', '2020-10-07 04:35:45'),
(1719, '0.25 Mcg', 1, NULL, '2020-10-07 04:35:45', '2020-10-07 04:35:45'),
(1720, '25 / 125 Dose', 1, NULL, '2020-10-07 04:35:45', '2020-10-07 04:35:45'),
(1721, '25 / 250 Dose', 1, NULL, '2020-10-07 04:35:45', '2020-10-07 04:35:45'),
(1722, '25 / 50 Dose', 1, NULL, '2020-10-07 04:35:45', '2020-10-07 04:35:45'),
(1723, '250 / 25', 1, NULL, '2020-10-07 04:35:45', '2020-10-07 04:35:45'),
(1724, '0.6/ 0.02 /0.02/0.1/33 %', 1, NULL, '2020-10-07 04:35:45', '2020-10-07 04:35:45'),
(1725, '50/20', 1, NULL, '2020-10-07 04:35:45', '2020-10-07 04:35:45'),
(1726, '50/40', 1, NULL, '2020-10-07 04:35:45', '2020-10-07 04:35:45'),
(1727, '112', 1, NULL, '2020-10-07 04:35:45', '2020-10-07 04:35:45'),
(1728, '175', 1, NULL, '2020-10-07 04:35:45', '2020-10-07 04:35:45'),
(1729, '88', 1, NULL, '2020-10-07 04:35:46', '2020-10-07 04:35:46'),
(1730, '100/1000', 1, NULL, '2020-10-07 04:35:46', '2020-10-07 04:35:46'),
(1731, '60 / 120', 1, NULL, '2020-10-07 04:35:46', '2020-10-07 04:35:46'),
(1732, '50 / 12.5', 1, NULL, '2020-10-07 04:35:46', '2020-10-07 04:35:46'),
(1733, '300 / 200 / 30', 1, NULL, '2020-10-07 04:35:46', '2020-10-07 04:35:46'),
(1734, '1.8', 1, NULL, '2020-10-07 04:35:46', '2020-10-07 04:35:46'),
(1735, '0.30%', 1, NULL, '2020-10-07 04:35:46', '2020-10-07 04:35:46'),
(1736, '50/200', 1, NULL, '2020-10-07 04:35:46', '2020-10-07 04:35:46'),
(1737, '550', 1, NULL, '2020-10-07 04:35:46', '2020-10-07 04:35:46'),
(1738, '0.020 / 3', 1, NULL, '2020-10-07 04:35:46', '2020-10-07 04:35:46'),
(1739, '100/12.5', 1, NULL, '2020-10-07 04:35:46', '2020-10-07 04:35:46'),
(1740, '20 / 12.5', 1, NULL, '2020-10-07 04:35:46', '2020-10-07 04:35:46'),
(1741, '3.6', 1, NULL, '2020-10-07 04:35:47', '2020-10-07 04:35:47'),
(1742, '37.5 / 325', 1, NULL, '2020-10-07 04:35:47', '2020-10-07 04:35:47'),
(1743, ' ', 1, NULL, '2020-10-07 04:35:47', '2020-10-07 04:35:47'),
(1744, '3-apr', 1, NULL, '2020-10-07 04:35:47', '2020-10-07 04:35:47'),
(1745, '2-apr', 1, NULL, '2020-10-07 04:35:47', '2020-10-07 04:35:47'),
(1746, '22.5', 1, NULL, '2020-10-07 04:35:47', '2020-10-07 04:35:47'),
(1747, '12.5/1000', 1, NULL, '2020-10-07 04:35:47', '2020-10-07 04:35:47'),
(1748, 'Na', 1, NULL, '2020-10-07 04:35:47', '2020-10-07 04:35:47'),
(1749, '5/500', 1, NULL, '2020-10-07 04:35:47', '2020-10-07 04:35:47'),
(1750, '5/850', 1, NULL, '2020-10-07 04:35:47', '2020-10-07 04:35:47'),
(1751, '5/1000', 1, NULL, '2020-10-07 04:35:47', '2020-10-07 04:35:47'),
(1752, '12.5/500', 1, NULL, '2020-10-07 04:35:47', '2020-10-07 04:35:47'),
(1753, '12.5/850', 1, NULL, '2020-10-07 04:35:47', '2020-10-07 04:35:47'),
(1754, 'Null', 1, NULL, '2020-10-07 04:35:47', '2020-10-07 04:35:47'),
(1755, '830/400', 1, NULL, '2020-10-07 04:35:48', '2020-10-07 04:35:48'),
(1756, '75/150', 1, NULL, '2020-10-07 04:35:48', '2020-10-07 04:35:48'),
(1757, '30/2', 1, NULL, '2020-10-07 04:35:48', '2020-10-07 04:35:48'),
(1758, '500/50', 1, NULL, '2020-10-07 04:35:48', '2020-10-07 04:35:48'),
(1759, '700', 1, NULL, '2020-10-07 04:35:48', '2020-10-07 04:35:48'),
(1760, '900', 1, NULL, '2020-10-07 04:35:48', '2020-10-07 04:35:48'),
(1761, '25/10', 1, NULL, '2020-10-07 04:35:48', '2020-10-07 04:35:48'),
(1762, '81', 1, NULL, '2020-10-07 04:35:48', '2020-10-07 04:35:48'),
(1763, '20/5', 1, NULL, '2020-10-07 04:35:49', '2020-10-07 04:35:49'),
(1764, '10ml', 1, NULL, '2020-10-07 04:35:49', '2020-10-07 04:35:49'),
(1765, '2.5mg', 1, NULL, '2020-10-07 04:35:49', '2020-10-07 04:35:49'),
(1766, '100000', 1, NULL, '2020-10-07 04:35:49', '2020-10-07 04:35:49'),
(1767, '45', 1, NULL, '2020-10-07 04:35:49', '2020-10-07 04:35:49'),
(1768, '1 Capsule', 1, NULL, '2020-10-07 04:35:49', '2020-10-07 04:35:49'),
(1769, 'Sachet', 1, NULL, '2020-10-07 04:35:49', '2020-10-07 04:35:49'),
(1770, '300mg/5ml', 1, NULL, '2020-10-07 04:35:49', '2020-10-07 04:35:49'),
(1771, '2.5/12.5', 1, NULL, '2020-10-07 04:35:49', '2020-10-07 04:35:49'),
(1772, '5/40', 1, NULL, '2020-10-07 04:35:49', '2020-10-07 04:35:49'),
(1773, '12.5/50', 1, NULL, '2020-10-07 04:35:49', '2020-10-07 04:35:49'),
(1774, '49/51', 1, NULL, '2020-10-07 04:35:49', '2020-10-07 04:35:49'),
(1775, '25/1000', 1, NULL, '2020-10-07 04:35:50', '2020-10-07 04:35:50'),
(1776, '0.3%', 1, NULL, '2020-10-07 04:35:50', '2020-10-07 04:35:50'),
(1777, '200/30', 1, NULL, '2020-10-07 04:35:50', '2020-10-07 04:35:50'),
(1778, '62.5', 1, NULL, '2020-10-07 04:35:50', '2020-10-07 04:35:50'),
(1779, '100 , 0.35', 1, NULL, '2020-10-07 04:35:50', '2020-10-07 04:35:50'),
(1780, '1 Tsf', 1, NULL, '2020-10-07 04:35:50', '2020-10-07 04:35:50'),
(1781, '35 ,450', 1, NULL, '2020-10-07 04:35:50', '2020-10-07 04:35:50'),
(1782, '1gm', 1, NULL, '2020-10-07 04:35:50', '2020-10-07 04:35:50'),
(1783, '24/26', 1, NULL, '2020-10-07 04:35:50', '2020-10-07 04:35:50'),
(1784, '10-15', 1, NULL, '2020-10-07 04:35:50', '2020-10-07 04:35:50'),
(1785, '6/100', 1, NULL, '2020-10-07 04:35:50', '2020-10-07 04:35:50'),
(1786, '667', 1, NULL, '2020-10-07 04:35:50', '2020-10-07 04:35:50'),
(1787, '75 , 81', 1, NULL, '2020-10-07 04:35:50', '2020-10-07 04:35:50'),
(1788, '120ml', 1, NULL, '2020-10-07 04:35:51', '2020-10-07 04:35:51'),
(1789, '150/25', 1, NULL, '2020-10-07 04:35:51', '2020-10-07 04:35:51'),
(1790, '35/450', 1, NULL, '2020-10-07 04:35:51', '2020-10-07 04:35:51'),
(1791, '0.5ml', 1, NULL, '2020-10-07 04:35:51', '2020-10-07 04:35:51'),
(1792, '0.5/0.4', 1, NULL, '2020-10-07 04:35:51', '2020-10-07 04:35:51'),
(1793, '1000mg,200mg/10ml', 1, NULL, '2020-10-07 04:35:51', '2020-10-07 04:35:51'),
(1794, '50 Mg/ml', 1, NULL, '2020-10-07 04:35:51', '2020-10-07 04:35:51'),
(1795, '75,75', 1, NULL, '2020-10-07 04:35:51', '2020-10-07 04:35:51'),
(1796, 'One Sachet', 1, NULL, '2020-10-07 04:35:52', '2020-10-07 04:35:52'),
(1797, 'Ventolin Resp Sol 100mcg /20ml', 1, NULL, '2020-10-07 04:35:52', '2020-10-07 04:35:52'),
(1798, '10, 20', 1, NULL, '2020-10-07 04:35:52', '2020-10-07 04:35:52'),
(1799, '100/5', 1, NULL, '2020-10-07 04:35:52', '2020-10-07 04:35:52'),
(1800, '8mg,5mg', 1, NULL, '2020-10-07 04:35:52', '2020-10-07 04:35:52'),
(1801, '2.5 ,0.025', 1, NULL, '2020-10-07 04:35:52', '2020-10-07 04:35:52'),
(1802, '5/20', 1, NULL, '2020-10-07 04:35:52', '2020-10-07 04:35:52'),
(1803, '3000', 1, NULL, '2020-10-07 04:35:52', '2020-10-07 04:35:52'),
(1804, '850/50', 1, NULL, '2020-10-07 04:35:53', '2020-10-07 04:35:53'),
(1805, '1300', 1, NULL, '2020-10-07 04:35:53', '2020-10-07 04:35:53'),
(1806, '2/1000', 1, NULL, '2020-10-07 04:35:53', '2020-10-07 04:35:53'),
(1807, '.5/10', 1, NULL, '2020-10-07 04:35:53', '2020-10-07 04:35:53'),
(1808, '1/2', 1, NULL, '2020-10-07 04:35:53', '2020-10-07 04:35:53'),
(1809, '6/25', 1, NULL, '2020-10-07 04:35:53', '2020-10-07 04:35:53'),
(1810, '85', 1, NULL, '2020-10-07 04:35:53', '2020-10-07 04:35:53'),
(1811, '51', 1, NULL, '2020-10-07 04:35:53', '2020-10-07 04:35:53');

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `title`, `slug`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 'Nkda', 'nkda', 1, NULL, '2020-10-07 05:52:29', '2020-10-07 05:52:29'),
(6, 'Alendronate', 'alendronate', 1, NULL, '2020-10-07 05:52:29', '2020-10-07 05:52:29'),
(7, 'Allopurinol', 'allopurinol', 1, NULL, '2020-10-07 05:52:29', '2020-10-07 05:52:29'),
(8, 'Amlodipine', 'amlodipine', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(9, 'Amoxicillin/clavulanic Acid', 'amoxicillinclavulanic-acid', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(10, 'Antitetanus Serum', 'antitetanus-serum', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(11, 'Arb', 'arb', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(12, 'Aspirin', 'aspirin', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(13, 'Atenolol', 'atenolol', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(14, 'Atorvastatin', 'atorvastatin', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(15, 'Augmentin', 'augmentin', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(16, 'Bromcriptine', 'bromcriptine', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(17, 'Bromocriptine', 'bromocriptine', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(18, 'Cabergoline', 'cabergoline', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(19, 'Carbamazepine', 'carbamazepine', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(20, 'Carbamezipine', 'carbamezipine', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(21, 'Carbimazole', 'carbimazole', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(22, 'Cefradine', 'cefradine', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(23, 'Cephradine', 'cephradine', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(24, 'D-sun', 'd-sun', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(25, 'Diclofenac', 'diclofenac', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(26, 'Dicloran', 'dicloran', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(27, 'Dispirin', 'dispirin', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(28, 'Duloxetine', 'duloxetine', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(29, 'Escitalopram', 'escitalopram', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(30, 'Ezitimibe', 'ezitimibe', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(31, 'Feboxat', 'feboxat', 1, NULL, '2020-10-07 05:52:30', '2020-10-07 05:52:30'),
(32, 'Fenofibrate', 'fenofibrate', 1, NULL, '2020-10-07 05:52:31', '2020-10-07 05:52:31'),
(33, 'Fluoxetine', 'fluoxetine', 1, NULL, '2020-10-07 05:52:31', '2020-10-07 05:52:31'),
(34, 'Formaldehyde', 'formaldehyde', 1, NULL, '2020-10-07 05:52:31', '2020-10-07 05:52:31'),
(35, 'Gabapentin', 'gabapentin', 1, NULL, '2020-10-07 05:52:31', '2020-10-07 05:52:31'),
(36, 'Gabapentine', 'gabapentine', 1, NULL, '2020-10-07 05:52:31', '2020-10-07 05:52:31'),
(37, 'Glargine', 'glargine', 1, NULL, '2020-10-07 05:52:31', '2020-10-07 05:52:31'),
(38, 'Glimepride', 'glimepride', 1, NULL, '2020-10-07 05:52:31', '2020-10-07 05:52:31'),
(39, 'Hydrochlorothiazide', 'hydrochlorothiazide', 1, NULL, '2020-10-07 05:52:31', '2020-10-07 05:52:31'),
(40, 'Ibandronate', 'ibandronate', 1, NULL, '2020-10-07 05:52:31', '2020-10-07 05:52:31'),
(41, 'Ibuprofen', 'ibuprofen', 1, NULL, '2020-10-07 05:52:31', '2020-10-07 05:52:31'),
(42, 'Iron Supplements', 'iron-supplements', 1, NULL, '2020-10-07 05:52:31', '2020-10-07 05:52:31'),
(43, 'Liraglutide', 'liraglutide', 1, NULL, '2020-10-07 05:52:32', '2020-10-07 05:52:32'),
(44, 'Losartan', 'losartan', 1, NULL, '2020-10-07 05:52:32', '2020-10-07 05:52:32'),
(45, 'Medigesic Fort', 'medigesic-fort', 1, NULL, '2020-10-07 05:52:32', '2020-10-07 05:52:32'),
(46, 'Metformin', 'metformin', 1, NULL, '2020-10-07 05:52:32', '2020-10-07 05:52:32'),
(47, 'Neomercazole', 'neomercazole', 1, NULL, '2020-10-07 05:52:32', '2020-10-07 05:52:32'),
(48, 'Neomycin', 'neomycin', 1, NULL, '2020-10-07 05:52:32', '2020-10-07 05:52:32'),
(49, 'Nitrofurantoin', 'nitrofurantoin', 1, NULL, '2020-10-07 05:52:32', '2020-10-07 05:52:32'),
(50, 'Orphenadrine', 'orphenadrine', 1, NULL, '2020-10-07 05:52:32', '2020-10-07 05:52:32'),
(51, 'Penicillin', 'penicillin', 1, NULL, '2020-10-07 05:52:33', '2020-10-07 05:52:33'),
(52, 'Pioglitazone', 'pioglitazone', 1, NULL, '2020-10-07 05:52:33', '2020-10-07 05:52:33'),
(53, 'Ponstan', 'ponstan', 1, NULL, '2020-10-07 05:52:33', '2020-10-07 05:52:33'),
(54, 'Pregabalin', 'pregabalin', 1, NULL, '2020-10-07 05:52:33', '2020-10-07 05:52:33'),
(55, 'Propranolol', 'propranolol', 1, NULL, '2020-10-07 05:52:33', '2020-10-07 05:52:33'),
(56, 'Ptu', 'ptu', 1, NULL, '2020-10-07 05:52:34', '2020-10-07 05:52:34'),
(57, 'Repaglinide', 'repaglinide', 1, NULL, '2020-10-07 05:52:34', '2020-10-07 05:52:34'),
(58, 'Rosuvastatin', 'rosuvastatin', 1, NULL, '2020-10-07 05:52:34', '2020-10-07 05:52:34'),
(59, 'Simvastatin', 'simvastatin', 1, NULL, '2020-10-07 05:52:34', '2020-10-07 05:52:34'),
(60, 'Sitagliptin', 'sitagliptin', 1, NULL, '2020-10-07 05:52:34', '2020-10-07 05:52:34'),
(61, 'Statins', 'statins', 1, NULL, '2020-10-07 05:52:34', '2020-10-07 05:52:34'),
(62, 'Sulpha', 'sulpha', 1, NULL, '2020-10-07 05:52:34', '2020-10-07 05:52:34'),
(63, 'Thiazide Diuretics', 'thiazide-diuretics', 1, NULL, '2020-10-07 05:52:34', '2020-10-07 05:52:34'),
(64, 'Vibramycin', 'vibramycin', 1, NULL, '2020-10-07 05:52:34', '2020-10-07 05:52:34'),
(65, 'Vildagliptin', 'vildagliptin', 1, NULL, '2020-10-07 05:52:34', '2020-10-07 05:52:34'),
(66, 'Xyster', 'xyster', 1, NULL, '2020-10-07 05:52:34', '2020-10-07 05:52:34'),
(67, 'Zoledronic Acid', 'zoledronic-acid', 1, NULL, '2020-10-07 05:52:34', '2020-10-07 05:52:34'),
(68, 'Ace Inhibitors', 'ace-inhibitors', 1, NULL, '2020-10-07 05:52:34', '2020-10-07 05:52:34'),
(69, 'Acarbose', 'acarbose', 1, NULL, '2020-10-07 05:52:34', '2020-10-07 05:52:34'),
(70, 'Ciprofloxacin', 'ciprofloxacin', 1, NULL, '2020-10-07 05:52:34', '2020-10-07 05:52:34'),
(71, 'Naproxen', 'naproxen', 1, NULL, '2020-10-07 05:52:35', '2020-10-07 05:52:35'),
(72, 'Ssri', 'ssri', 1, NULL, '2020-10-07 05:52:35', '2020-10-07 05:52:35'),
(73, 'Test21', 'test21', 1, '2020-10-08 05:48:13', '2020-10-07 05:52:35', '2020-10-08 05:48:13');

-- --------------------------------------------------------

--
-- Table structure for table `durations`
--

CREATE TABLE `durations` (
  `id` int(11) UNSIGNED NOT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `durations`
--

INSERT INTO `durations` (`id`, `duration`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(4, 'Ongoing', 1, NULL, '2020-10-07 05:38:17', '2020-10-07 05:38:17'),
(5, 'As Needed', 1, NULL, '2020-10-07 05:38:17', '2020-10-07 05:38:17'),
(6, '7 Days', 1, NULL, '2020-10-07 05:38:18', '2020-10-07 05:38:18'),
(7, '3 Weeks', 1, NULL, '2020-10-07 05:38:18', '2020-10-07 05:38:18'),
(8, '5 Days', 1, NULL, '2020-10-07 05:38:18', '2020-10-07 05:38:18'),
(9, '21 Days', 1, NULL, '2020-10-07 05:38:18', '2020-10-07 05:38:18'),
(10, 'Once', 1, NULL, '2020-10-07 05:38:18', '2020-10-07 05:38:18'),
(11, '6 Months', 1, NULL, '2020-10-07 05:38:18', '2020-10-07 05:38:18'),
(12, '7 Months', 1, NULL, '2020-10-07 05:38:18', '2020-10-07 05:38:18'),
(13, '3 Months', 1, NULL, '2020-10-07 05:38:18', '2020-10-07 05:38:18'),
(14, 'Ml', 1, NULL, '2020-10-07 05:38:19', '2020-10-07 05:38:19'),
(15, '3 Days', 1, NULL, '2020-10-07 05:38:19', '2020-10-07 05:38:19'),
(16, '2 Weeks', 1, NULL, '2020-10-07 05:38:19', '2020-10-07 05:38:19'),
(17, '12 Weeks', 1, NULL, '2020-10-07 05:38:19', '2020-10-07 05:38:19'),
(18, 'Oral Contraception', 1, NULL, '2020-10-07 05:38:19', '2020-10-07 05:38:19'),
(20, '2 Months', 1, NULL, '2020-10-07 05:38:20', '2020-10-07 05:38:20'),
(21, '10 Days', 1, NULL, '2020-10-07 05:38:20', '2020-10-07 05:38:20'),
(22, '6 Weeks', 1, NULL, '2020-10-07 05:38:20', '2020-10-07 05:38:20'),
(23, 'Every Sunday', 1, NULL, '2020-10-07 05:38:20', '2020-10-07 05:38:20'),
(24, 'Sunday', 1, NULL, '2020-10-07 05:38:20', '2020-10-07 05:38:20'),
(25, 'First Sunday Of Every Month', 1, NULL, '2020-10-07 05:38:20', '2020-10-07 05:38:20'),
(26, 'Breakfast', 1, NULL, '2020-10-07 05:38:20', '2020-10-07 05:38:20'),
(27, '24 Weeks', 1, NULL, '2020-10-07 05:38:20', '2020-10-07 05:38:20'),
(28, 'As Needed For Pain', 1, NULL, '2020-10-07 05:38:20', '2020-10-07 05:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `title`, `slug`, `description`, `image`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Facility 1', 'facility-1', 'Test', 'facilityImage/RnOkvcke4MyKLO2m3kOihudt85V5YVBLnsRw3jqs.jpeg', 1, NULL, '2020-09-09 11:08:39', '2020-09-09 11:08:40'),
(2, 'Facility 2', 'facility-2', NULL, NULL, 1, NULL, '2020-09-11 11:28:31', '2020-09-11 11:28:36');

-- --------------------------------------------------------

--
-- Table structure for table `family_medical_histories`
--

CREATE TABLE `family_medical_histories` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_visit_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `patient_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relation_id` int(11) UNSIGNED NOT NULL,
  `relation_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disease_id` int(11) UNSIGNED NOT NULL,
  `disease_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_years` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `deceased_status` tinyint(1) NOT NULL DEFAULT 0,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `family_medical_histories`
--

INSERT INTO `family_medical_histories` (`id`, `patient_visit_id`, `practitioner_id`, `practitioner_name`, `patient_id`, `patient_name`, `relation_id`, `relation_name`, `disease_id`, `disease_name`, `no_of_years`, `year`, `deceased_status`, `remarks`, `created_at`, `updated_at`) VALUES
(4, 4, 10, 'Dr. S. Abbas Raza', 24, 'Mr. John Doe', 11, 'Brother', 6, 'Abdominal Pain', NULL, 2015, 1, 'Remarks 1', '2020-10-08 05:57:55', '2020-10-08 05:57:55'),
(5, 4, 10, 'Dr. S. Abbas Raza', 24, 'Mr. John Doe', 2, 'Father', 13, 'Acne', 5, NULL, 0, 'Remarks 2', '2020-10-08 05:57:55', '2020-10-08 05:57:55');

-- --------------------------------------------------------

--
-- Table structure for table `favourite_labs`
--

CREATE TABLE `favourite_labs` (
  `id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lab_test_id` int(11) UNSIGNED NOT NULL,
  `lab_test_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `frequencies`
--

CREATE TABLE `frequencies` (
  `id` int(11) UNSIGNED NOT NULL,
  `frequency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frequencies`
--

INSERT INTO `frequencies` (`id`, `frequency`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(95, 'Three Tablets In The Morning Before Meal', 1, NULL, '2020-10-07 05:44:03', '2020-10-07 05:44:03'),
(96, 'One Tablet In The Morning', 1, NULL, '2020-10-07 05:44:03', '2020-10-07 05:44:03'),
(97, 'One Tablet Twice A Day', 1, NULL, '2020-10-07 05:44:03', '2020-10-07 05:44:03'),
(98, 'One Injection Subcutaneously Every 2 Weeks', 1, NULL, '2020-10-07 05:44:03', '2020-10-07 05:44:03'),
(100, 'One Tablespoon Twice A Day', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(101, 'One Tablet Daily', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(102, 'Inject Once A Year', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(103, 'Apply To Affected Area Twice A Day', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(104, 'Apply Twice A Day', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(105, 'One Injection', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(106, 'One Injection Subcutaneously', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(107, 'One Injection Slowly', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(108, 'One Tablet Thrice A Day', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(109, 'Before Breakfast', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(110, 'One Injection Twice A Day', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(111, 'Apply To Affected Area Once Daily', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(112, 'One Tablet At Bedtime', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(113, 'One Tablet In The Evening', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(114, 'One0 Tablets Once Daily For 3 Days', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(115, 'One Tablet For 3 Days', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(116, '5 Tablets Once Daily For 3 Days', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(117, 'One Drop In Each Eye, Thrice A Day', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(118, 'One Tablet In The Morning Before Breakfast', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(119, '2 Tablets Thrice A Day', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(120, 'One Tablet Twice A Day With Meals', 1, NULL, '2020-10-07 05:44:04', '2020-10-07 05:44:04'),
(122, 'Four Tablets As A Single Dose Now', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(123, 'One Tablet In The Morning With Breakfast', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(124, '2 Tablets At Bedtime', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(125, '2 Puffs Four Times A Day', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(126, '2 Injections Every 2 Weeks', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(127, 'One Injection Every 2 Weeks', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(128, 'One Tablet Twice Daily', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(129, 'Sachet Mixed In Half Glass Of Water ; Drink At Bedtime As Needed For Constipation', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(130, 'One Injection Intramuscularly Every Week', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(131, 'Gargle Twice Daily', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(132, 'Tablet In The Morning', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(133, '2 Tablespoon Daily In Between Lunch And Dinner, With Half Cup Of Lamonade Or Fruit Juice', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(134, 'One Drop Twice Daily', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(135, 'Take 7 Tablets Every Sunday On An Empty Stomach With 2 Glasses Of Water. Do Not Eat, Drink Or Lie Down For Half Hour.', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(136, 'Take One Tablet Every Sunday On An Empty Stomach With 2 Glasses Of Water. Do Not Eat', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(137, '2 Tablets In The Morning', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(138, 'Apply To Affected Area Four-six Times A Day As Needed', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(139, 'Drink One Injection Every 2 Weeks', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(140, '2 Tablets In The Evening', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(141, 'One Tablet On Onest Sunday Of Every Month On An Empty Stomach With 2 Glasses Of Water. Do Not Eat', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(142, 'One Injection Subcutaneously Every Sunday', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(143, 'Inject Subcutaneously Twice A Day Before Meals', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(144, 'Inject Subcutaneously Twice A Day Before Meals For One Month', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(145, 'In The Evening', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(146, '2 Teaspoon Thrice A Day After Meal', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(147, 'One Capsule In The Morning', 1, NULL, '2020-10-07 05:44:05', '2020-10-07 05:44:05'),
(148, '2 Tablets Twice A Day', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(149, 'Apply To Affected Area Thrice A Day As Needed For Pain', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(152, 'Half Tablet Half Hour Before Intended Sexual Intercourse', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(153, 'One Tablet Twice A Day After Meals', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(154, 'Nebulize Twice Daily', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(155, '2 Injections Twice A Day', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(156, 'Splint Right Wrist. Use As Directed', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(157, 'One Tablet Before Breakfast And Dinner', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(158, 'One Tablet In The Morning After Breakfast', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(159, 'Half Teaspoon Four Times Daily >< 7 Days. Retain Gel In Mouth As Long As Possible', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(160, 'One Capsule Thrice A Day', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(161, 'Drink One Injection Every Month', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(162, 'In The Morning', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(163, 'One Capsule At Bedtime', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(164, 'One Capsule Before Breakfast And Dinner', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(165, 'One Capsule In The Morning Before Breakfast', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(166, 'One Tablet Twice A Day Before Breakfast And Dinner', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(167, 'Apply To Affected Area Three To Four Times Daily As Needed', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(168, '2 Teaspoons Twice A Day After Meal', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(169, 'One Tablet Twice A Week', 1, NULL, '2020-10-07 05:44:06', '2020-10-07 05:44:06'),
(170, 'Two Capsules Every Sunday', 1, NULL, '2020-10-07 05:44:07', '2020-10-07 05:44:07'),
(171, '2 Tablets Every Sunday', 1, NULL, '2020-10-07 05:44:07', '2020-10-07 05:44:07'),
(172, '2 Teaspoons At Bedtime', 1, NULL, '2020-10-07 05:44:07', '2020-10-07 05:44:07'),
(173, 'Half Tablet In The Morning And Half Tablet In The Afternoon And Half Tablet In The Evening', 1, NULL, '2020-10-07 05:44:07', '2020-10-07 05:44:07'),
(174, 'Half Tablet Twice A Day', 1, NULL, '2020-10-07 05:44:07', '2020-10-07 05:44:07'),
(175, 'One Tablet In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 1, NULL, '2020-10-07 05:44:07', '2020-10-07 05:44:07'),
(176, 'Mix 5 Tablespoons In One Glass Of Water And Drink Three Times A Day', 1, NULL, '2020-10-07 05:44:07', '2020-10-07 05:44:07'),
(177, 'Two Tablets As A Single Dose Now', 1, NULL, '2020-10-07 05:44:07', '2020-10-07 05:44:07'),
(178, 'One Tablet As A Single Dose Now', 1, NULL, '2020-10-07 05:44:07', '2020-10-07 05:44:07'),
(179, 'One Tablespoon In The Morning', 1, NULL, '2020-10-07 05:44:07', '2020-10-07 05:44:07'),
(180, 'One Tablet With Lunch And Dinner', 1, NULL, '2020-10-07 05:44:07', '2020-10-07 05:44:07'),
(181, 'One Teaspoon Thrice A Day After Meal', 1, NULL, '2020-10-07 05:44:07', '2020-10-07 05:44:07'),
(182, 'One Teaspoon Twice A Day After Meal', 1, NULL, '2020-10-07 05:44:07', '2020-10-07 05:44:07'),
(183, 'One Injection Subcutaneously Every Day', 1, NULL, '2020-10-07 05:44:07', '2020-10-07 05:44:07'),
(184, 'One Injection Intravenously ', 1, NULL, '2020-10-07 05:44:07', '2020-10-07 05:44:07'),
(185, 'One Tablet With Breakfast And Dinner', 1, NULL, '2020-10-07 05:44:07', '2020-10-07 05:44:07'),
(186, 'One Tablet Thrice A Day Before Each Meal', 1, NULL, '2020-10-07 05:44:07', '2020-10-07 05:44:07'),
(187, 'Mix Normal Saline Equal To One50 Units Of An Insulin Syringe With Humatrope Powder And Shake Gently. Draw One0 Units With Insulin Syringe And Inject Subcutaneously Monday To Saturday-sunday N', 1, NULL, '2020-10-07 05:44:07', '2020-10-07 05:44:07'),
(188, 'Ongoing', 1, NULL, '2020-10-07 05:44:08', '2020-10-07 05:44:08'),
(189, 'One Injection Subcutaneously Three Days A Week', 1, NULL, '2020-10-07 05:44:08', '2020-10-07 05:44:08'),
(190, 'Half Injection Subcutaneously Three Times A Week', 1, NULL, '2020-10-07 05:44:08', '2020-10-07 05:44:08'),
(191, 'Half Tablet Twice A Day After Meals', 1, NULL, '2020-10-07 05:44:08', '2020-10-07 05:44:08'),
(192, 'Two Tablets At Bedtime', 1, NULL, '2020-10-07 05:44:08', '2020-10-07 05:44:08'),
(193, 'One And Half Tablets In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 1, NULL, '2020-10-07 05:44:08', '2020-10-07 05:44:08'),
(194, 'One Injection Intramuscularly Every Month', 1, NULL, '2020-10-07 05:44:08', '2020-10-07 05:44:08'),
(195, 'One Injection Subcutaneously Every Month', 1, NULL, '2020-10-07 05:44:08', '2020-10-07 05:44:08'),
(196, 'One Tablespoon At Bedtime', 1, NULL, '2020-10-07 05:44:08', '2020-10-07 05:44:08'),
(197, '5 Tablets In The Morning', 1, NULL, '2020-10-07 05:44:08', '2020-10-07 05:44:08'),
(198, 'One0 Tablets In The Morning', 1, NULL, '2020-10-07 05:44:08', '2020-10-07 05:44:08'),
(199, '2 Capsules Thrice A Day With Meals', 1, NULL, '2020-10-07 05:44:08', '2020-10-07 05:44:08'),
(200, '3 Tablets In The Morning', 1, NULL, '2020-10-07 05:44:08', '2020-10-07 05:44:08'),
(201, 'One Squirt In Each Nostril Twice A Day', 1, NULL, '2020-10-07 05:44:08', '2020-10-07 05:44:08'),
(202, 'One Squirt In Each Nostril In The Evening', 1, NULL, '2020-10-07 05:44:08', '2020-10-07 05:44:08'),
(203, '000 Iu', 1, NULL, '2020-10-07 05:44:08', '2020-10-07 05:44:08'),
(204, 'Inject Subcutaneously Daily In The Evening', 1, NULL, '2020-10-07 05:44:08', '2020-10-07 05:44:08'),
(205, 'One Half Tablet Twice A Day', 1, NULL, '2020-10-07 05:44:08', '2020-10-07 05:44:08'),
(206, 'Half Tablet Thrice A Day Before Each Meal', 1, NULL, '2020-10-07 05:44:09', '2020-10-07 05:44:09'),
(207, 'One Tablet Twice A Day For Pain', 1, NULL, '2020-10-07 05:44:09', '2020-10-07 05:44:09'),
(208, 'One Capsule Thrice A Day Before Each Meal', 1, NULL, '2020-10-07 05:44:09', '2020-10-07 05:44:09'),
(209, 'One Capsule Twice A Day After Meal', 1, NULL, '2020-10-07 05:44:09', '2020-10-07 05:44:09'),
(210, 'One Tablet Thrice A Day 3 Days Before Expected Onset Of Menses', 1, NULL, '2020-10-07 05:44:09', '2020-10-07 05:44:09'),
(211, 'One Capsule Daily', 1, NULL, '2020-10-07 05:44:09', '2020-10-07 05:44:09'),
(212, 'One Puff Twice A Day', 1, NULL, '2020-10-07 05:44:09', '2020-10-07 05:44:09'),
(213, 'In The Morning ><  7 Days', 1, NULL, '2020-10-07 05:44:09', '2020-10-07 05:44:09'),
(214, 'Deep Intramuscular Injection Once A Month', 1, NULL, '2020-10-07 05:44:09', '2020-10-07 05:44:09'),
(215, 'One Capsule With Lunch And Dinner', 1, NULL, '2020-10-07 05:44:09', '2020-10-07 05:44:09'),
(216, 'Once A Day As Needed For Pain; Take It With Food', 1, NULL, '2020-10-07 05:44:09', '2020-10-07 05:44:09'),
(217, 'One Injection Intravenously Once A Week For 6 Weeks', 1, NULL, '2020-10-07 05:44:09', '2020-10-07 05:44:09'),
(218, 'Half Tablet At Bedtime', 1, NULL, '2020-10-07 05:44:09', '2020-10-07 05:44:09'),
(219, 'One Tablet In The Morning After Meal', 1, NULL, '2020-10-07 05:44:09', '2020-10-07 05:44:09'),
(220, 'One Half Tablet In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 1, NULL, '2020-10-07 05:44:09', '2020-10-07 05:44:09'),
(221, 'Half Injection Intramuscularly Once A Month', 1, NULL, '2020-10-07 05:44:09', '2020-10-07 05:44:09'),
(222, 'One Injection Every Two Weeks', 1, NULL, '2020-10-07 05:44:10', '2020-10-07 05:44:10'),
(223, 'Half Tablet Half Hour Before Intended Sexual Intercourse; Avoid Fatty Food', 1, NULL, '2020-10-07 05:44:10', '2020-10-07 05:44:10'),
(224, 'Half Tablet In The Morning', 1, NULL, '2020-10-07 05:44:10', '2020-10-07 05:44:10'),
(225, '25', 1, NULL, '2020-10-07 05:44:10', '2020-10-07 05:44:10'),
(226, 'One Capsule In The Afternoon Before Lunch', 1, NULL, '2020-10-07 05:44:10', '2020-10-07 05:44:10'),
(227, 'One-2 Squirt In Each Nostril Twice A Day >< 3 Days', 1, NULL, '2020-10-07 05:44:10', '2020-10-07 05:44:10'),
(228, 'One Light Pink Tablet Daily For 24 Days', 1, NULL, '2020-10-07 05:44:10', '2020-10-07 05:44:10'),
(229, '0.02/3', 1, NULL, '2020-10-07 05:44:10', '2020-10-07 05:44:10'),
(230, '2 Tablets >< One Dose', 1, NULL, '2020-10-07 05:44:10', '2020-10-07 05:44:10'),
(231, 'One Injection Subcutaneously Every 28 Days', 1, NULL, '2020-10-07 05:44:10', '2020-10-07 05:44:10'),
(232, 'Half Tablet As Needed For Migraine Headache. May Repeat After 2 Hours If Headache Returns', 1, NULL, '2020-10-07 05:44:10', '2020-10-07 05:44:10'),
(234, '2 Capsules Every Sunday', 1, NULL, '2020-10-07 05:44:10', '2020-10-07 05:44:10'),
(235, '2 Tablets In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 1, NULL, '2020-10-07 05:44:10', '2020-10-07 05:44:10'),
(236, 'One Tablet Twice A Day Before Breakfast', 1, NULL, '2020-10-07 05:44:10', '2020-10-07 05:44:10'),
(237, 'Half Tablet Trice A Day', 1, NULL, '2020-10-07 05:44:10', '2020-10-07 05:44:10'),
(238, 'One Tablet At Bed Time', 1, NULL, '2020-10-07 05:44:10', '2020-10-07 05:44:10'),
(239, 'Before Lunch', 1, NULL, '2020-10-07 05:44:10', '2020-10-07 05:44:10'),
(240, 'Before Dinner', 1, NULL, '2020-10-07 05:44:11', '2020-10-07 05:44:11'),
(241, 'Two Tablets In The Evening', 1, NULL, '2020-10-07 05:44:11', '2020-10-07 05:44:11'),
(242, 'One And Half Tablet In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 1, NULL, '2020-10-07 05:44:11', '2020-10-07 05:44:11'),
(243, 'One Capsule Every Month', 1, NULL, '2020-10-07 05:44:11', '2020-10-07 05:44:11'),
(244, 'Once Daily', 1, NULL, '2020-10-07 05:44:11', '2020-10-07 05:44:11'),
(245, 'Two Teaspoon Thrice A Day After Meal', 1, NULL, '2020-10-07 05:44:11', '2020-10-07 05:44:11'),
(246, 'Two Teaspoons Twice A Day After Meal', 1, NULL, '2020-10-07 05:44:11', '2020-10-07 05:44:11'),
(247, 'One Tablet On 1st Sunday Of Every Month On An Empty Stomach With 2 Glasses Of Water. Do Not Eat, Drink Or Lie Down For 1/2 Hour.', 1, NULL, '2020-10-07 05:44:11', '2020-10-07 05:44:11'),
(248, 'One Injection Intramuscularly', 1, NULL, '2020-10-07 05:44:11', '2020-10-07 05:44:11'),
(249, 'Twice A Day', 1, NULL, '2020-10-07 05:44:11', '2020-10-07 05:44:11'),
(250, 'One Capsule Every Sunday', 1, NULL, '2020-10-07 05:44:11', '2020-10-07 05:44:11'),
(251, 'In The Morning With Breakfast', 1, NULL, '2020-10-07 05:44:11', '2020-10-07 05:44:11'),
(252, 'One Tablet In The Morning And One Tablet In The Afternoon', 1, NULL, '2020-10-07 05:44:11', '2020-10-07 05:44:11'),
(253, 'Twice A Day As Needed For Pain', 1, NULL, '2020-10-07 05:44:11', '2020-10-07 05:44:11'),
(254, 'Twice A Day As Needed', 1, NULL, '2020-10-07 05:44:11', '2020-10-07 05:44:11'),
(255, 'One Injection In 100 Ml 0.9% Normal Saline Intravenously Over 15 Minutes X 1 Dose', 1, NULL, '2020-10-07 05:44:11', '2020-10-07 05:44:11'),
(256, 'Two Tablets In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 1, NULL, '2020-10-07 05:44:12', '2020-10-07 05:44:12'),
(257, 'Two Tablets In The Morning', 1, NULL, '2020-10-07 05:44:12', '2020-10-07 05:44:12');

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

CREATE TABLE `histories` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_visit_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `patient_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `histories`
--

INSERT INTO `histories` (`id`, `patient_visit_id`, `practitioner_id`, `practitioner_name`, `patient_id`, `patient_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 4, 10, 'Dr. S. Abbas Raza', 24, 'Mr. John Doe', '<p>fever body pain headache</p>', '2020-10-08 05:55:23', '2021-03-24 06:39:59'),
(2, 17, 11, 'Prof. Ali Jawa', 44, 'Shahzad Jamil Jafferi', '<p>A diagnosed case of T2DM , Diabetic Nephropathy, And Hypothyroidism</p><p><br></p>', '2020-10-14 17:48:09', '2020-10-14 17:51:11'),
(3, 19, 11, 'Prof. Ali Jawa', 42, 'Sonia Tariq', '<p>DM Management&nbsp;</p>', '2020-10-14 18:12:41', '2020-10-14 18:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `all_time` tinyint(1) NOT NULL DEFAULT 0,
  `from_time` time DEFAULT NULL,
  `to_time` time DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `title`, `slug`, `about`, `address`, `email`, `contact_no`, `all_time`, `from_time`, `to_time`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Hospital Name', 'hospital-name', 'Test', 'Test', 'test@gmail.com', '0423-5555555', 1, NULL, NULL, 1, NULL, '2020-09-09 11:09:33', '2020-09-09 11:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_days`
--

CREATE TABLE `hospital_days` (
  `id` int(11) UNSIGNED NOT NULL,
  `hospital_id` int(11) UNSIGNED NOT NULL,
  `day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospital_days`
--

INSERT INTO `hospital_days` (`id`, `hospital_id`, `day`, `created_at`, `updated_at`) VALUES
(1, 1, 'Monday', '2020-09-09 11:09:33', '2020-09-09 11:09:33'),
(2, 1, 'Tuesday', '2020-09-09 11:09:33', '2020-09-09 11:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_departments`
--

CREATE TABLE `hospital_departments` (
  `id` int(11) UNSIGNED NOT NULL,
  `hospital_id` int(11) UNSIGNED NOT NULL,
  `department_id` int(11) UNSIGNED NOT NULL,
  `department_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospital_departments`
--

INSERT INTO `hospital_departments` (`id`, `hospital_id`, `department_id`, `department_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Department 1', '2020-09-09 11:09:33', '2020-09-09 11:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_facilities`
--

CREATE TABLE `hospital_facilities` (
  `id` int(11) UNSIGNED NOT NULL,
  `hospital_id` int(11) UNSIGNED NOT NULL,
  `facility_id` int(11) UNSIGNED NOT NULL,
  `facility_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospital_facilities`
--

INSERT INTO `hospital_facilities` (`id`, `hospital_id`, `facility_id`, `facility_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Facility 1', '2020-09-09 11:09:33', '2020-09-09 11:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `labs`
--

CREATE TABLE `labs` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `labs`
--

INSERT INTO `labs` (`id`, `title`, `slug`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(6, 'AGA KHAN', 'aga-khan', NULL, 1, NULL, '2020-10-07 00:44:51', '2020-10-07 00:44:51'),
(7, 'AL RAZI DIAGNOSTIC CENTER M. M. ALAM ROAD, LAHORE 042 111 - 257 294', 'al-razi-diagnostic-center-m-m-alam-road-lahore-042-111-257-294', NULL, 1, NULL, '2020-10-07 00:44:52', '2020-10-07 00:44:52'),
(8, 'Chughtai Lab', 'chughtai-lab', NULL, 1, NULL, '2020-10-07 00:44:52', '2020-10-07 00:44:52'),
(9, 'AMC', 'amc', NULL, 1, NULL, '2020-10-07 00:44:52', '2020-10-07 00:44:52'),
(10, 'Excel Lab', 'excel-lab', NULL, 1, NULL, '2020-10-07 00:44:52', '2020-10-07 00:44:52'),
(11, 'CENUM, MAYO HOSPITAL, LAHORE', 'cenum-mayo-hospital-lahore', NULL, 1, NULL, '2020-10-07 00:44:52', '2020-10-07 00:44:52'),
(12, 'DOCTORS HOSPITAL', 'doctors-hospital', NULL, 1, NULL, '2020-10-07 00:44:52', '2020-10-07 00:44:52'),
(13, 'GINUM, GUJRANWALA 055-3493370-4	جنم، گوجرانوالہ055', 'ginum-gujranwala-055-3493370-4jnm-gojranoal055', NULL, 1, NULL, '2020-10-07 00:44:52', '2020-10-07 00:44:52'),
(14, 'HEART AND BODY SCAN, CANAL ROAD, LAHORE', 'heart-and-body-scan-canal-road-lahore', NULL, 1, NULL, '2020-10-07 00:44:52', '2020-10-07 00:44:52'),
(15, 'INMOL, MUSLIM TOWN, LAHORE', 'inmol-muslim-town-lahore', NULL, 1, NULL, '2020-10-07 00:44:52', '2020-10-07 00:44:52'),
(16, 'NATIONAL HOSPITAL, DHA, LAHORE', 'national-hospital-dha-lahore', NULL, 1, NULL, '2020-10-07 00:44:52', '2020-10-07 00:44:52'),
(17, 'NORI, Islamabad', 'nori-islamabad', NULL, 1, NULL, '2020-10-07 00:44:52', '2020-10-07 00:44:52'),
(18, 'PUNJAB RADIOLOGY, JAIL ROAD, LAHORE 042 35715231	پنجاب ریڈیالوجی 8/2 گلبرگ،جیل روڈ، لاھور 042', 'punjab-radiology-jail-road-lahore-042-35715231pnjab-riialoji-82-glbrgjil-ro-laor-042', NULL, 1, NULL, '2020-10-07 00:44:52', '2020-10-07 00:44:52'),
(19, 'SHALAMAR HOPITAL ,LAHORE', 'shalamar-hopital-lahore', NULL, 1, NULL, '2020-10-07 00:44:52', '2020-10-07 00:44:52'),
(20, 'SHAUKAT KHANUM', 'shaukat-khanum', NULL, 1, NULL, '2020-10-07 00:44:52', '2020-10-07 00:44:52'),
(21, 'SHAUKAT KHANUM DIAGNOSTIC CENTER, JAIL ROAD UAN 042-111-756-756	شوکت خانم ڈایگناسٹک سنٹر، جیل روڈ، لاھور 042', 'shaukat-khanum-diagnostic-center-jail-road-uan-042-111-756-756shokt-khanm-aignask-snr-jil-ro-laor-042', NULL, 1, NULL, '2020-10-07 00:44:52', '2020-10-07 00:44:52'),
(22, 'SHAUKAT KHANUM HOSPITAL	شوکت خانم  ہسپتال', 'shaukat-khanum-hospitalshokt-khanm-sptal', NULL, 1, NULL, '2020-10-07 00:44:52', '2020-10-07 00:44:52'),
(23, 'SHAUKAT KHANUM HOSPITAL, DEPARTMENT OF NUCLEAR MEDICINE, UAN: 111-155-555', 'shaukat-khanum-hospital-department-of-nuclear-medicine-uan-111-155-555', NULL, 1, NULL, '2020-10-07 00:44:52', '2020-10-07 00:44:52'),
(24, 'WILCARE', 'wilcare', NULL, 1, NULL, '2020-10-07 00:44:52', '2020-10-07 00:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `lab_tests`
--

CREATE TABLE `lab_tests` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fasting` tinyint(1) NOT NULL DEFAULT 0,
  `instructions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lab_id` int(11) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lab_tests`
--

INSERT INTO `lab_tests` (`id`, `title`, `slug`, `description`, `type_id`, `fasting`, `instructions`, `lab_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(623, '17-oh Progesterone', '17-oh-progesterone', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(624, '24 Hour Urine For Cortisol Excretion', '24-hour-urine-for-cortisol-excretion', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(625, '24 Hour Urine For Protein Excretion', '24-hour-urine-for-protein-excretion', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(626, '24-hour Urine For Vma Excretion', '24-hour-urine-for-vma-excretion', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(627, '5-hydroxyindole Acetic Acid (5-hiaa)', '5-hydroxyindole-acetic-acid-5-hiaa', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(628, 'Acth', 'acth', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(629, 'Albumin', 'albumin', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(630, 'Amylase', 'amylase', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(631, 'Ana', 'ana', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(632, 'Anti-endomysial Antibody', 'anti-endomysial-antibody', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(633, 'Anti-thyroid Peroxidase Antibodies', 'anti-thyroid-peroxidase-antibodies', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(634, 'Anti-tissue Transglutaminase (anti-ttg) Antibody', 'anti-tissue-transglutaminase-anti-ttg-antibody', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(635, 'Antimicrosomal Antibodies', 'antimicrosomal-antibodies', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(636, 'Blood Glucose', 'blood-glucose', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(637, 'Blood Glucose (2 Hour After Breakfast)', 'blood-glucose-2-hour-after-breakfast', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(638, 'Blood Glucose (2 Hour After Iftar)', 'blood-glucose-2-hour-after-iftar', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(639, 'Bun, Creatinine', 'bun-creatinine', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(640, 'Calcium, Phosphorus', 'calcium-phosphorus', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(641, 'Carotid Doppler Ultrasound (bilateral)', 'carotid-doppler-ultrasound-bilateral', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(642, 'Cbc', 'cbc', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:01', '2020-10-07 03:02:01'),
(643, 'Cbc With Peripheral Smear', 'cbc-with-peripheral-smear', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(644, 'Chest X-ray', 'chest-x-ray', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(645, 'Chest X-ray (digital)', 'chest-x-ray-digital', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(646, 'Chest X-ray Pa And Lateral (digital)', 'chest-x-ray-pa-and-lateral-digital', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(647, 'Chromosomal Analysis (aga Khan)', 'chromosomal-analysis-aga-khan', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(648, 'Ct Abdomen And Pelvis With Contrast', 'ct-abdomen-and-pelvis-with-contrast', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(649, 'Ct Head Without Contrast', 'ct-head-without-contrast', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(650, 'Dengue (igg)', 'dengue-igg', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(651, 'Dengue (igm)', 'dengue-igm', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(652, 'Dexa (bmd) Scan', 'dexa-bmd-scan', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(653, 'Dhea', 'dhea', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(654, 'Dhea-s', 'dhea-s', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(655, 'Dhea-sulphate', 'dhea-sulphate', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(656, 'Doppler Ultrasound (arterial) Lower Extremities', 'doppler-ultrasound-arterial-lower-extremities', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(657, 'Doppler Ultrasound (venous) Lower Extremities', 'doppler-ultrasound-venous-lower-extremities', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(658, 'Electrocardiogram', 'electrocardiogram', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(659, 'Electrocardiogram (ecg)', 'electrocardiogram-ecg', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(660, 'Esr', 'esr', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(661, 'Fasting Blood Glucose', 'fasting-blood-glucose', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(662, 'Fasting Blood Glucose, C-peptide, Insulin', 'fasting-blood-glucose-c-peptide-insulin', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(663, 'Fasting Lipid Profile', 'fasting-lipid-profile', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(664, 'Ferritin', 'ferritin', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(665, 'Ferritin Tibc', 'ferritin-tibc', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(666, 'Free T3', 'free-t3', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:02', '2020-10-07 03:02:02'),
(667, 'Free T4', 'free-t4', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:03', '2020-10-07 03:02:03'),
(668, 'Fsh, Lh, Testosterone', 'fsh-lh-testosterone', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:03', '2020-10-07 03:02:03'),
(669, 'Fsh, Lh, Testosterone, Estradiol', 'fsh-lh-testosterone-estradiol', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:03', '2020-10-07 03:02:03'),
(670, 'Fsh, Lh, Testosterone, Sex Hormone Binding Globulin', 'fsh-lh-testosterone-sex-hormone-binding-globulin', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:03', '2020-10-07 03:02:03'),
(671, 'Glutamic Acid Decarboxylase (gad) Antibody', 'glutamic-acid-decarboxylase-gad-antibody', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:03', '2020-10-07 03:02:03'),
(672, 'Growth Hormone (one Hour After Ogtt)', 'growth-hormone-one-hour-after-ogtt', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:03', '2020-10-07 03:02:03'),
(673, 'Growth Hormone (two Hours After Ogtt)', 'growth-hormone-two-hours-after-ogtt', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:03', '2020-10-07 03:02:03'),
(674, 'Helicobacter Pylori Antibody', 'helicobacter-pylori-antibody', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:03', '2020-10-07 03:02:03'),
(675, 'Hemoglobin A1c', 'hemoglobin-a1c', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:03', '2020-10-07 03:02:03'),
(676, 'Hemoglobin Electrophresis', 'hemoglobin-electrophresis', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:03', '2020-10-07 03:02:03'),
(677, 'Hepatitis A Antibody', 'hepatitis-a-antibody', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:03', '2020-10-07 03:02:03'),
(678, 'Hepatitis B Surface Antigen', 'hepatitis-b-surface-antigen', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:03', '2020-10-07 03:02:03'),
(679, 'Hepatitis C Antibody', 'hepatitis-c-antibody', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:03', '2020-10-07 03:02:03'),
(680, 'Hepatitis C Virus By Pcr (genotyping)', 'hepatitis-c-virus-by-pcr-genotyping', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:03', '2020-10-07 03:02:03'),
(681, 'Hepatitis C Virus By Pcr (qualtitative)', 'hepatitis-c-virus-by-pcr-qualtitative', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:03', '2020-10-07 03:02:03'),
(682, 'Hepatitis C Virus By Pcr (quantitative)', 'hepatitis-c-virus-by-pcr-quantitative', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:03', '2020-10-07 03:02:03'),
(683, 'Hiv Test', 'hiv-test', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:03', '2020-10-07 03:02:03'),
(684, 'Igf-1', 'igf-1', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:03', '2020-10-07 03:02:03'),
(685, 'Igf-1 (aga Khan Lab)', 'igf-1-aga-khan-lab', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(686, 'Insulin, C-peptide, Blood Glucose', 'insulin-c-peptide-blood-glucose', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(687, 'Intact Pth', 'intact-pth', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(688, 'Karyotyping', 'karyotyping', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(689, 'Ldl', 'ldl', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(690, 'Lh, Fsh, Estradiol', 'lh-fsh-estradiol', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(691, 'Lipase', 'lipase', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(692, 'Liver Function Test', 'liver-function-test', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(693, 'Magnesium', 'magnesium', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(694, 'Mammogram (bilateral)', 'mammogram-bilateral', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(695, 'Methylmalonic Acid', 'methylmalonic-acid', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(696, 'Mibg Scan', 'mibg-scan', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(697, 'Mri Abdomen With Gadolinum', 'mri-abdomen-with-gadolinum', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(698, 'Mri Brain For Pituitary (with And Without Gadolinium)', 'mri-brain-for-pituitary-with-and-without-gadolinium', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(699, 'Mri Brain For Pituitary (with And Without Pituitary)', 'mri-brain-for-pituitary-with-and-without-pituitary', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(700, 'Mri Spine', 'mri-spine', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(701, 'Parathyroid Scan', 'parathyroid-scan', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(702, 'Phosphorus', 'phosphorus', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(703, 'Plasma Acth And Serum Cortisol (8 Am)', 'plasma-acth-and-serum-cortisol-8-am', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(704, 'Plasma Renin', 'plasma-renin', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(705, 'Potassium', 'potassium', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(706, 'Potassium, Bun, Creatinine', 'potassium-bun-creatinine', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(707, 'Prolactin', 'prolactin', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(708, 'Psa', 'psa', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(709, 'Pt/ptt/inr', 'ptpttinr', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(710, 'Radioactive Iodine Treatment', 'radioactive-iodine-treatment', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:04', '2020-10-07 03:02:04'),
(711, 'Radioactive Iodine Treatment (re-treatment)', 'radioactive-iodine-treatment-re-treatment', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(712, 'Random Blood Glucose', 'random-blood-glucose', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(713, 'Renal Profile', 'renal-profile', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(714, 'Rheumatoid Factor', 'rheumatoid-factor', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(715, 'Semen Analysis', 'semen-analysis', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(716, 'Serum Aldosterone', 'serum-aldosterone', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(717, 'Serum Beta Hcg', 'serum-beta-hcg', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(718, 'Serum Cortisol (8 Am)', 'serum-cortisol-8-am', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(719, 'Serum Electrolytes', 'serum-electrolytes', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(720, 'Serum Lh, Fsh, Estradiol', 'serum-lh-fsh-estradiol', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(721, 'Serum Lh, Fsh, Estradiol, Testosterone', 'serum-lh-fsh-estradiol-testosterone', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(722, 'Serum Lh, Fsh, Testosterone', 'serum-lh-fsh-testosterone', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(723, 'Serum Lh, Fsh, Testosterone, Sex Hormone Binding Globulin', 'serum-lh-fsh-testosterone-sex-hormone-binding-globulin', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(724, 'Serum Osmolarity', 'serum-osmolarity', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(725, 'Serum Testosterone', 'serum-testosterone', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(726, 'Serum Triglycerides', 'serum-triglycerides', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(727, 'Sex Hormone Binding Globulin (shbg)', 'sex-hormone-binding-globulin-shbg', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(728, 'Sodium, Potassium, Bun, Creatinine', 'sodium-potassium-bun-creatinine', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(729, 'Stool For Gram Stain, Ova And Parasites, Culture And Sensitivity', 'stool-for-gram-stain-ova-and-parasites-culture-and-sensitivity', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(730, 'Stool For Occult Blood', 'stool-for-occult-blood', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(731, 'T4', 't4', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(732, 'Testosterone', 'testosterone', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(733, 'Thyroglobulin Antibody', 'thyroglobulin-antibody', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(734, 'Thyroglobulin Antigen', 'thyroglobulin-antigen', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(735, 'Thyroid Function Tests', 'thyroid-function-tests', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(736, 'Thyroid Scan And Uptake', 'thyroid-scan-and-uptake', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:05', '2020-10-07 03:02:05'),
(737, 'Thyroid Ultrasound', 'thyroid-ultrasound', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:06', '2020-10-07 03:02:06'),
(738, 'Total Body Scan', 'total-body-scan', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:06', '2020-10-07 03:02:06'),
(739, 'Tpha', 'tpha', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:06', '2020-10-07 03:02:06'),
(740, 'Transthoracic Echocardiogram', 'transthoracic-echocardiogram', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:06', '2020-10-07 03:02:06'),
(741, 'Tsh', 'tsh', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:06', '2020-10-07 03:02:06'),
(742, 'Tsh , Free T3 And Free T4', 'tsh-free-t3-and-free-t4', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:06', '2020-10-07 03:02:06'),
(743, 'Tsh And Free T4', 'tsh-and-free-t4', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:06', '2020-10-07 03:02:06'),
(744, 'Ultrasound Abdomen', 'ultrasound-abdomen', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:06', '2020-10-07 03:02:06'),
(745, 'Ultrasound Abdomen And Pelvis', 'ultrasound-abdomen-and-pelvis', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:06', '2020-10-07 03:02:06'),
(746, 'Ultrasound Guided Fine Needle Aspiration Cytology', 'ultrasound-guided-fine-needle-aspiration-cytology', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:06', '2020-10-07 03:02:06'),
(747, 'Ultrasound Guided Fine Needle Aspiration Cytology (shaukat Khanum)', 'ultrasound-guided-fine-needle-aspiration-cytology-shaukat-khanum', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:06', '2020-10-07 03:02:06'),
(748, 'Ultrasound Guided Fna-c Thyroid', 'ultrasound-guided-fna-c-thyroid', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:06', '2020-10-07 03:02:06'),
(749, 'Uric Acid', 'uric-acid', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:06', '2020-10-07 03:02:06'),
(750, 'Urinalysis', 'urinalysis', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:06', '2020-10-07 03:02:06'),
(751, 'Urine Culture And Sensitivity', 'urine-culture-and-sensitivity', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:06', '2020-10-07 03:02:06'),
(752, 'Urine For Microalbumin', 'urine-for-microalbumin', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:06', '2020-10-07 03:02:06'),
(753, 'Urine Osmolarity', 'urine-osmolarity', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:06', '2020-10-07 03:02:06'),
(754, 'Urine Pregnancy Test', 'urine-pregnancy-test', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:06', '2020-10-07 03:02:06'),
(755, 'Visual Field Testing', 'visual-field-testing', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:07', '2020-10-07 03:02:07'),
(756, 'Vitamin B12', 'vitamin-b12', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:07', '2020-10-07 03:02:07'),
(757, 'Vitamin D', 'vitamin-d', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:07', '2020-10-07 03:02:07'),
(758, 'Water Deprivation Test', 'water-deprivation-test', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:07', '2020-10-07 03:02:07'),
(759, 'Whole Body Scan For Thyroid', 'whole-body-scan-for-thyroid', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:07', '2020-10-07 03:02:07'),
(760, 'X-ray C Spine Ap And Lateral', 'x-ray-c-spine-ap-and-lateral', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:07', '2020-10-07 03:02:07'),
(761, 'X-ray Left Shoulder', 'x-ray-left-shoulder', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:07', '2020-10-07 03:02:07'),
(762, 'X-ray Left Wrist For Bone Age', 'x-ray-left-wrist-for-bone-age', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:07', '2020-10-07 03:02:07'),
(763, 'X-ray Right Foot', 'x-ray-right-foot', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:07', '2020-10-07 03:02:07'),
(764, 'X-ray Right Knee', 'x-ray-right-knee', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:07', '2020-10-07 03:02:07'),
(765, 'X-ray Right Shoulder', 'x-ray-right-shoulder', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:07', '2020-10-07 03:02:07'),
(766, 'Dexa (bmd) Scan With Vertebral Fracture Assessment', 'dexa-bmd-scan-with-vertebral-fracture-assessment', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:07', '2020-10-07 03:02:07'),
(767, 'Ultrasound Scrotum', 'ultrasound-scrotum', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:07', '2020-10-07 03:02:07'),
(768, '17-oh Progresterone', '17-oh-progresterone', NULL, NULL, 0, NULL, 8, 1, NULL, '2020-10-07 03:02:07', '2020-10-07 03:02:07'),
(775, 'Excel Lab', 'excel-lab', 'Testing', 2, 1, 'Testing', 7, 1, NULL, '2020-11-13 06:03:23', '2020-11-13 06:03:23');

-- --------------------------------------------------------

--
-- Table structure for table `lab_test_types`
--

CREATE TABLE `lab_test_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lab_test_types`
--

INSERT INTO `lab_test_types` (`id`, `title`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Lab Test Type 1', 'lab-test-type-1', 1, '2020-11-13 06:02:41', '2020-11-13 06:02:41'),
(3, 'Lab Test Type 2', 'lab-test-type-2', 1, '2020-11-13 06:02:55', '2020-11-13 06:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `medications`
--

CREATE TABLE `medications` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `generic_name` varchar(251) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dose_id` int(11) UNSIGNED DEFAULT NULL,
  `dose` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_id` int(11) UNSIGNED DEFAULT NULL,
  `unit` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frequency_id` int(11) UNSIGNED DEFAULT NULL,
  `frequency` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration_id` int(11) UNSIGNED DEFAULT NULL,
  `duration` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagnosis_type_id` int(11) UNSIGNED DEFAULT NULL,
  `diagnosis_type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medications`
--

INSERT INTO `medications` (`id`, `title`, `generic_name`, `slug`, `dose_id`, `dose`, `unit_id`, `unit`, `frequency_id`, `frequency`, `duration_id`, `duration`, `diagnosis_type_id`, `diagnosis_type`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1484, 'Abbutol', NULL, 'abbutol', 1471, '400', 41, 'MG', 95, 'Three Tablets In The Morning Before Meal', 4, 'Ongoing', 52, 'Tuberculosis', 1, NULL, '2020-10-07 08:28:15', '2020-10-07 08:28:15'),
(1485, 'Abocal', NULL, 'abocal', 1472, '1', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:28:15', '2020-10-07 08:28:15'),
(1486, 'Accolate', NULL, 'accolate', 1473, '20', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 11, 'Asthma', 1, NULL, '2020-10-07 08:28:16', '2020-10-07 08:28:16'),
(1487, 'Accred', NULL, 'accred', 1474, '50', 41, 'MG', 98, 'One Injection Subcutaneously Every 2 Weeks', 4, 'Ongoing', 5, 'Anemia', 1, NULL, '2020-10-07 08:28:16', '2020-10-07 08:28:16'),
(1488, 'Accu Check Performa Glucometer', NULL, 'accu-check-performa-glucometer', 1474, '50', 41, 'MG', 98, 'One Injection Subcutaneously Every 2 Weeks', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:17', '2020-10-07 08:28:17'),
(1489, 'Accu Check Performa Test Strips', NULL, 'accu-check-performa-test-strips', 1474, '50', 41, 'MG', 98, 'One Injection Subcutaneously Every 2 Weeks', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:17', '2020-10-07 08:28:17'),
(1490, 'Accu Chek Active Glucometer', NULL, 'accu-chek-active-glucometer', 1474, '50', 41, 'MG', 98, 'One Injection Subcutaneously Every 2 Weeks', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:17', '2020-10-07 08:28:17'),
(1491, 'Accu Chek Active Test Strips', NULL, 'accu-chek-active-test-strips', 1474, '50', 41, 'MG', 98, 'One Injection Subcutaneously Every 2 Weeks', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:17', '2020-10-07 08:28:17'),
(1494, 'Accupril', NULL, 'accupril', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:18', '2020-10-07 08:28:18'),
(1495, 'Acefyl Cough Syp', NULL, 'acefyl-cough-syp', 1477, '60', 41, 'MG', 100, 'One Tablespoon Twice A Day', 5, 'As Needed', 20, 'Cough', 1, NULL, '2020-10-07 08:28:18', '2020-10-07 08:28:18'),
(1497, 'Acelar', NULL, 'acelar', 1476, '5', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:19', '2020-10-07 08:28:19'),
(1498, 'Aclasta', NULL, 'aclasta', 1476, '5', 41, 'MG', 102, 'Inject Once A Year', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:19', '2020-10-07 08:28:19'),
(1500, 'Aclova', NULL, 'aclova', 1479, '250', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:19', '2020-10-07 08:28:19'),
(1501, 'Acne Aid', NULL, 'acne-aid', 1480, '2.5 / 1.25 %', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 3, 'Acne', 1, NULL, '2020-10-07 08:28:19', '2020-10-07 08:28:19'),
(1502, 'Acneklin', NULL, 'acneklin', 1481, '2%', 41, 'MG', 104, 'Apply Twice A Day', 4, 'Ongoing', 3, 'Acne', 1, NULL, '2020-10-07 08:28:19', '2020-10-07 08:28:19'),
(1503, 'Acozine', NULL, 'acozine', 1474, '50', 42, 'MG/ML', 105, 'One Injection', 4, 'Ongoing', 3, 'Acne', 1, NULL, '2020-10-07 08:28:19', '2020-10-07 08:28:19'),
(1504, 'Acrivin', NULL, 'acrivin', 1482, '0.10%', 42, 'MG/ML', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 3, 'Acne', 1, NULL, '2020-10-07 08:28:19', '2020-10-07 08:28:19'),
(1505, 'Act-hib', NULL, 'act-hib', 1483, '0.5', 43, 'ML', 106, 'One Injection Subcutaneously', 4, 'Ongoing', 3, 'Acne', 1, NULL, '2020-10-07 08:28:19', '2020-10-07 08:28:19'),
(1506, 'Actidil', NULL, 'actidil', 1477, '60', 42, 'MG/ML', 100, 'One Tablespoon Twice A Day', 4, 'Ongoing', 4, 'Allergy', 1, NULL, '2020-10-07 08:28:19', '2020-10-07 08:28:19'),
(1507, 'Actif Viii', NULL, 'actif-viii', 1484, '250 Iu', 43, 'ML', 107, 'One Injection Slowly', 4, 'Ongoing', 4, 'Allergy', 1, NULL, '2020-10-07 08:28:19', '2020-10-07 08:28:19'),
(1509, 'Actifed-p', NULL, 'actifed-p', 1477, '60', 41, 'MG', 100, 'One Tablespoon Twice A Day', 4, 'Ongoing', 20, 'Cough', 1, NULL, '2020-10-07 08:28:19', '2020-10-07 08:28:19'),
(1511, 'Actim', NULL, 'actim', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:20', '2020-10-07 08:28:20'),
(1512, 'Actonel', NULL, 'actonel', 1476, '5', 41, 'MG', 108, 'One Tablet Thrice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:20', '2020-10-07 08:28:20'),
(1547, 'Actrapid Insulin', NULL, 'actrapid-insulin', 1515, '70', 44, 'Units', 109, 'Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:22', '2020-10-07 08:28:22'),
(1566, 'Actrapid Insulin Pen', NULL, 'actrapid-insulin-pen', 1503, '42', 44, 'Units', 109, 'Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:23', '2020-10-07 08:28:23'),
(1567, 'Acyclovir Inj - Abbot', NULL, 'acyclovir-inj-abbot', 1479, '250', 43, 'ML', 110, 'One Injection Twice A Day', 6, '7 Days', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:23', '2020-10-07 08:28:23'),
(1569, 'Adalat La', NULL, 'adalat-la', 1477, '60', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:23', '2020-10-07 08:28:23'),
(1570, 'Adalat Retard', NULL, 'adalat-retard', 1473, '20', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:23', '2020-10-07 08:28:23'),
(1572, 'Advant', NULL, 'advant', 1488, '8', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:23', '2020-10-07 08:28:23'),
(1573, 'Advantan', NULL, 'advantan', 1482, '0.10%', 41, 'MG', 111, 'Apply To Affected Area Once Daily', 4, 'Ongoing', 4, 'Allergy', 1, NULL, '2020-10-07 08:28:23', '2020-10-07 08:28:23'),
(1574, 'Advantec', NULL, 'advantec', 1516, '16/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:23', '2020-10-07 08:28:23'),
(1576, 'Aerotel', NULL, 'aerotel', 1476, '5', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 11, 'Asthma', 1, NULL, '2020-10-07 08:28:23', '2020-10-07 08:28:23'),
(1577, 'Aggrastat', NULL, 'aggrastat', 1517, '0.25', 41, 'MG', 105, 'One Injection', 4, 'Ongoing', 520, 'Angina', 1, NULL, '2020-10-07 08:28:23', '2020-10-07 08:28:23'),
(1578, 'Agile', NULL, 'agile', 1517, '0.25', 41, 'MG', 108, 'One Tablet Thrice A Day', 4, 'Ongoing', 520, 'Angina', 1, NULL, '2020-10-07 08:28:23', '2020-10-07 08:28:23'),
(1579, 'Agile Forte', NULL, 'agile-forte', 1486, '4', 41, 'MG', 108, 'One Tablet Thrice A Day', 4, 'Ongoing', 520, 'Angina', 1, NULL, '2020-10-07 08:28:23', '2020-10-07 08:28:23'),
(1580, 'Agnese', NULL, 'agnese', 1502, '40', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 5, 'Anemia', 1, NULL, '2020-10-07 08:28:23', '2020-10-07 08:28:23'),
(1582, 'Agrippal', NULL, 'agrippal', 1483, '0.5', 43, 'ML', 106, 'One Injection Subcutaneously', 4, 'Ongoing', 27, 'Flu Prevention', 1, NULL, '2020-10-07 08:28:23', '2020-10-07 08:28:23'),
(1585, 'Aidra', NULL, 'aidra', 1473, '20', 41, 'MG', 116, '5 Tablets Once Daily For 3 Days', 4, 'Ongoing', 10, 'Arthritis', 1, NULL, '2020-10-07 08:28:23', '2020-10-07 08:28:23'),
(1587, 'Aldactazide', NULL, 'aldactazide', 1520, '50 / 50', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 10, 'Arthritis', 1, NULL, '2020-10-07 08:28:24', '2020-10-07 08:28:24'),
(1589, 'Aldactone', NULL, 'aldactone', 1518, '100', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 10, 'Arthritis', 1, NULL, '2020-10-07 08:28:24', '2020-10-07 08:28:24'),
(1590, 'Aldomet', NULL, 'aldomet', 1479, '250', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:24', '2020-10-07 08:28:24'),
(1591, 'Alfumet', NULL, 'alfumet', 1521, '150', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:24', '2020-10-07 08:28:24'),
(1593, 'Allerget', NULL, 'allerget', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 5, 'As Needed', 4, 'Allergy', 1, NULL, '2020-10-07 08:28:24', '2020-10-07 08:28:24'),
(1596, 'Alp', NULL, 'alp', 1472, '1', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:24', '2020-10-07 08:28:24'),
(1598, 'Alphagan', NULL, 'alphagan', 1523, '32.5 / 325', 41, 'MG', 117, 'One Drop In Each Eye, Thrice A Day', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:24', '2020-10-07 08:28:24'),
(1599, 'Alprox', NULL, 'alprox', 1483, '0.5', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:24', '2020-10-07 08:28:24'),
(1603, 'Amaryl', NULL, 'amaryl', 1486, '4', 41, 'MG', 118, 'One Tablet In The Morning Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:24', '2020-10-07 08:28:24'),
(1605, 'Amaryl M S.r.', NULL, 'amaryl-m-sr', 1526, '2/500', 41, 'MG', 118, 'One Tablet In The Morning Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:25', '2020-10-07 08:28:25'),
(1607, 'Amodip', NULL, 'amodip', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:25', '2020-10-07 08:28:25'),
(1611, 'Am-telsan', NULL, 'am-telsan', 1529, 'May-80', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:25', '2020-10-07 08:28:25'),
(1613, 'Amvax-b', NULL, 'amvax-b', 1531, '20 Mcg', 43, 'ML', 106, 'One Injection Subcutaneously', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:25', '2020-10-07 08:28:25'),
(1614, 'Amygra', NULL, 'amygra', 1477, '60', 41, 'MG', 108, 'One Tablet Thrice A Day', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:25', '2020-10-07 08:28:25'),
(1615, 'Anafranil', NULL, 'anafranil', 1477, '60', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:25', '2020-10-07 08:28:25'),
(1616, 'Anapaz', NULL, 'anapaz', 1532, '125', 41, 'MG', 119, '2 Tablets Thrice A Day', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:25', '2020-10-07 08:28:25'),
(1617, 'Anastrazole', NULL, 'anastrazole', 1472, '1', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 115, 'Cancer', 1, NULL, '2020-10-07 08:28:25', '2020-10-07 08:28:25'),
(1618, 'Anasynth', NULL, 'anasynth', 1472, '1', 41, 'MG', 108, 'One Tablet Thrice A Day', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:25', '2020-10-07 08:28:25'),
(1619, 'Androcur', NULL, 'androcur', 1474, '50', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:25', '2020-10-07 08:28:25'),
(1621, 'Antiflam', NULL, 'antiflam', 1533, '75', 41, 'MG', 120, 'One Tablet Twice A Day With Meals', 5, 'As Needed', 40, 'Pain', 1, NULL, '2020-10-07 08:28:25', '2020-10-07 08:28:25'),
(1659, 'Approvel', NULL, 'approvel', 1534, '300', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:27', '2020-10-07 08:28:27'),
(1661, 'Arbi', NULL, 'arbi', 1534, '300', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:27', '2020-10-07 08:28:27'),
(1664, 'Arcalion', NULL, 'arcalion', 1478, '200', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:28', '2020-10-07 08:28:28'),
(1666, 'Artem', NULL, 'artem', 1537, '80', 41, 'MG', 122, 'Four Tablets As A Single Dose Now', 4, 'Ongoing', 35, 'Malaria', 1, NULL, '2020-10-07 08:28:28', '2020-10-07 08:28:28'),
(1667, 'Artem Ds', NULL, 'artem-ds', 1475, '10', 41, 'MG', 122, 'Four Tablets As A Single Dose Now', 4, 'Ongoing', 35, 'Malaria', 1, NULL, '2020-10-07 08:28:28', '2020-10-07 08:28:28'),
(1669, 'Artem-ds Plus', NULL, 'artem-ds-plus', 1539, '80/480', 41, 'MG', 122, 'Four Tablets As A Single Dose Now', 4, 'Ongoing', 35, 'Malaria', 1, NULL, '2020-10-07 08:28:28', '2020-10-07 08:28:28'),
(1672, 'Ascard', NULL, 'ascard', 1533, '75', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:28:28', '2020-10-07 08:28:28'),
(1673, 'Ascard Plus', NULL, 'ascard-plus', 1533, '75', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:28:28', '2020-10-07 08:28:28'),
(1676, 'Atarax', NULL, 'atarax', 1540, '120', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:28', '2020-10-07 08:28:28'),
(1677, 'Atem Inhaler', NULL, 'atem-inhaler', 1540, '120', 41, 'MG', 125, '2 Puffs Four Times A Day', 5, 'As Needed', 26, 'Emphysema', 1, NULL, '2020-10-07 08:28:28', '2020-10-07 08:28:28'),
(1678, 'Ativan', NULL, 'ativan', 1472, '1', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:28', '2020-10-07 08:28:28'),
(1681, 'Atorva', NULL, 'atorva', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:28:28', '2020-10-07 08:28:28'),
(1683, 'Atramed', NULL, 'atramed', 1476, '5', 43, 'ML', 107, 'One Injection Slowly', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:28:28', '2020-10-07 08:28:28'),
(1684, 'Augmentin', NULL, 'augmentin', 1541, '625/125', 41, 'MG', 97, 'One Tablet Twice A Day', 6, '7 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:28:28', '2020-10-07 08:28:28'),
(1686, 'Aurora', NULL, 'aurora', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:28', '2020-10-07 08:28:28'),
(1688, 'Avastin', NULL, 'avastin', 1471, '400', 41, 'MG', 127, 'One Injection Every 2 Weeks', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:29', '2020-10-07 08:28:29'),
(1690, 'Avaxim', NULL, 'avaxim', 1537, '80', 45, 'AU', 106, 'One Injection Subcutaneously', 4, 'Ongoing', 31, 'Hepatitis A Prevention', 1, NULL, '2020-10-07 08:28:29', '2020-10-07 08:28:29'),
(1691, 'Avazin', NULL, 'avazin', 1475, '10', 41, 'MG', 96, 'One Tablet In The Morning', 5, 'As Needed', 4, 'Allergy', 1, NULL, '2020-10-07 08:28:29', '2020-10-07 08:28:29'),
(1693, 'Avelox', NULL, 'avelox', 1471, '400', 41, 'MG', 96, 'One Tablet In The Morning', 6, '7 Days', 4, 'Allergy', 1, NULL, '2020-10-07 08:28:29', '2020-10-07 08:28:29'),
(1695, 'Avil', NULL, 'avil', 1474, '50', 41, 'MG', 97, 'One Tablet Twice A Day', 5, 'As Needed', 4, 'Allergy', 1, NULL, '2020-10-07 08:28:29', '2020-10-07 08:28:29'),
(1703, 'Avsar Plus', NULL, 'avsar-plus', 1550, '5/160/25', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:29', '2020-10-07 08:28:29'),
(1705, 'Azomax', NULL, 'azomax', 1479, '250', 42, 'MG/ML', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:28:29', '2020-10-07 08:28:29'),
(1706, 'Baydal', NULL, 'baydal', 1475, '10', 41, 'MG', 96, 'One Tablet In The Morning', 5, 'As Needed', 4, 'Allergy', 1, NULL, '2020-10-07 08:28:29', '2020-10-07 08:28:29'),
(1708, 'Benadryl', NULL, 'benadryl', 1551, '450', 43, 'ML', 100, 'One Tablespoon Twice A Day', 4, 'Ongoing', 20, 'Cough', 1, NULL, '2020-10-07 08:28:29', '2020-10-07 08:28:29'),
(1709, 'Benefiber', NULL, 'benefiber', 1472, '1', 43, 'ML', 129, 'Sachet Mixed In Half Glass Of Water ; Drink At Bedtime As Needed For Constipation', 4, 'Ongoing', 19, 'Constipation', 1, NULL, '2020-10-07 08:28:29', '2020-10-07 08:28:29'),
(1711, 'Benzibiotic', NULL, 'benzibiotic', 1553, '1.20 Mu', 43, 'ML', 130, 'One Injection Intramuscularly Every Week', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:28:30', '2020-10-07 08:28:30'),
(1713, 'Benzim', NULL, 'benzim', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:28:30', '2020-10-07 08:28:30'),
(1715, 'Benzirin', NULL, 'benzirin', 1474, '50', 43, 'ML', 131, 'Gargle Twice Daily', 4, 'Ongoing', 521, 'Mouthwash', 1, NULL, '2020-10-07 08:28:30', '2020-10-07 08:28:30'),
(1716, 'Benzirin Gel', NULL, 'benzirin-gel', 1497, '30', 43, 'ML', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 521, 'Mouthwash', 1, NULL, '2020-10-07 08:28:30', '2020-10-07 08:28:30'),
(1717, 'Betnovate', NULL, 'betnovate', 1482, '0.10%', 43, 'ML', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 521, 'Mouthwash', 1, NULL, '2020-10-07 08:28:30', '2020-10-07 08:28:30'),
(1718, 'Betnovate-n', NULL, 'betnovate-n', 1554, '0.1 / 0.5', 43, 'ML', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 521, 'Mouthwash', 1, NULL, '2020-10-07 08:28:30', '2020-10-07 08:28:30'),
(1719, 'Betonil', NULL, 'betonil', 1482, '0.10%', 43, 'ML', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 521, 'Mouthwash', 1, NULL, '2020-10-07 08:28:30', '2020-10-07 08:28:30'),
(1720, 'Betonil-n', NULL, 'betonil-n', 1554, '0.1 / 0.5', 43, 'ML', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 521, 'Mouthwash', 1, NULL, '2020-10-07 08:28:30', '2020-10-07 08:28:30'),
(1721, 'Betoptic', NULL, 'betoptic', 1555, '0.25%', 43, 'ML', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 521, 'Mouthwash', 1, NULL, '2020-10-07 08:28:30', '2020-10-07 08:28:30'),
(1722, 'Bevidox', NULL, 'bevidox', 1472, '1', 43, 'ML', 132, 'Tablet In The Morning', 4, 'Ongoing', 521, 'Mouthwash', 1, NULL, '2020-10-07 08:28:30', '2020-10-07 08:28:30'),
(1723, 'Bi Preterax', NULL, 'bi-preterax', 1486, '4', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:30', '2020-10-07 08:28:30'),
(1724, 'Bisleri', NULL, 'bisleri', 1474, '50', 41, 'MG', 133, '2 Tablespoon Daily In Between Lunch And Dinner, With Half Cup Of Lamonade Or Fruit Juice', 4, 'Ongoing', 5, 'Anemia', 1, NULL, '2020-10-07 08:28:30', '2020-10-07 08:28:30'),
(1725, 'Blephamide - Oint', NULL, 'blephamide-oint', 1556, '10 / 0.2 %', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 5, 'Anemia', 1, NULL, '2020-10-07 08:28:30', '2020-10-07 08:28:30'),
(1726, 'Blephapred', NULL, 'blephapred', 1557, '10 / 0.2 / 0.12 %', 41, 'MG', 134, 'One Drop Twice Daily', 4, 'Ongoing', 5, 'Anemia', 1, NULL, '2020-10-07 08:28:30', '2020-10-07 08:28:30'),
(1729, 'Blokium', NULL, 'blokium', 1474, '50', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:30', '2020-10-07 08:28:30'),
(1731, 'Blokium-diu', NULL, 'blokium-diu', 1559, '50/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:31', '2020-10-07 08:28:31'),
(1732, 'Bonate', NULL, 'bonate', 1475, '10', 41, 'MG', 135, 'Take 7 Tablets Every Sunday On An Empty Stomach With 2 Glasses Of Water. Do Not Eat, Drink Or Lie Down For Half Hour.', 4, 'Ongoing', 15, 'Bone Weakness', 1, NULL, '2020-10-07 08:28:31', '2020-10-07 08:28:31'),
(1733, 'Bonateow', NULL, 'bonateow', 1515, '70', 41, 'MG', 136, 'Take One Tablet Every Sunday On An Empty Stomach With 2 Glasses Of Water. Do Not Eat', 4, 'Ongoing', 15, 'Bone Weakness', 1, NULL, '2020-10-07 08:28:31', '2020-10-07 08:28:31'),
(1736, 'Bonedol', NULL, 'bonedol', 1472, '1', 46, 'MCG', 137, '2 Tablets In The Morning', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:31', '2020-10-07 08:28:31'),
(1737, 'Bongard', NULL, 'bongard', 1515, '70', 41, 'MG', 136, 'Take One Tablet Every Sunday On An Empty Stomach With 2 Glasses Of Water. Do Not Eat', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:31', '2020-10-07 08:28:31'),
(1738, 'Bonjela', NULL, 'bonjela', 1560, '8.7/ 0.01%', 41, 'MG', 138, 'Apply To Affected Area Four-six Times A Day As Needed', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:31', '2020-10-07 08:28:31'),
(1739, 'Bonky', NULL, 'bonky', 1561, '1 Mcg', 43, 'ML', 139, 'Drink One Injection Every 2 Weeks', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:28:31', '2020-10-07 08:28:31'),
(1741, 'Bon-one', NULL, 'bon-one', 1483, '0.5', 46, 'MCG', 140, '2 Tablets In The Evening', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:28:31', '2020-10-07 08:28:31'),
(1742, 'Bonviva', NULL, 'bonviva', 1521, '150', 41, 'MG', 141, 'One Tablet On Onest Sunday Of Every Month On An Empty Stomach With 2 Glasses Of Water. Do Not Eat', 4, 'Ongoing', 15, 'Bone Weakness', 1, NULL, '2020-10-07 08:28:31', '2020-10-07 08:28:31'),
(1743, 'Brexin', NULL, 'brexin', 1473, '20', 41, 'MG', 96, 'One Tablet In The Morning', 5, 'As Needed', 40, 'Pain', 1, NULL, '2020-10-07 08:28:31', '2020-10-07 08:28:31'),
(1744, 'Brotin', NULL, 'brotin', 1473, '20', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 365, 'Parkinsonism', 1, NULL, '2020-10-07 08:28:31', '2020-10-07 08:28:31'),
(1747, 'Brufen', NULL, 'brufen', 1562, '600', 41, 'MG', 108, 'One Tablet Thrice A Day', 5, 'As Needed', 40, 'Pain', 1, NULL, '2020-10-07 08:28:31', '2020-10-07 08:28:31'),
(1748, 'Brufen Cream', NULL, 'brufen-cream', 1497, '30', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:28:31', '2020-10-07 08:28:31'),
(1752, 'Buscopan', NULL, 'buscopan', 1564, '20 / 2.5 Mg / Gm', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:28:32', '2020-10-07 08:28:32'),
(1753, 'Buspar', NULL, 'buspar', 1476, '5', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:28:32', '2020-10-07 08:28:32'),
(1754, 'Butyn', NULL, 'butyn', 1476, '5', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:28:32', '2020-10-07 08:28:32'),
(1755, 'Bydureon', NULL, 'bydureon', 1476, '5', 41, 'MG', 142, 'One Injection Subcutaneously Every Sunday', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:32', '2020-10-07 08:28:32'),
(1758, 'Byetta', NULL, 'byetta', 1565, '5 Mcg', 43, 'ML', 144, 'Inject Subcutaneously Twice A Day Before Meals For One Month', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:32', '2020-10-07 08:28:32'),
(1762, 'Cabok', NULL, 'cabok', 1476, '5', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:32', '2020-10-07 08:28:32'),
(1763, 'Cac-1000', NULL, 'cac-1000', 1476, '5', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:28:32', '2020-10-07 08:28:32'),
(1764, 'Cadla', NULL, 'cadla', 1483, '0.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:28:32', '2020-10-07 08:28:32'),
(1766, 'Caduet', NULL, 'caduet', 1567, '20-may', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 518, 'Blood Pressure/Cholesterol', 1, NULL, '2020-10-07 08:28:32', '2020-10-07 08:28:32'),
(1767, 'Cadwin', NULL, 'cadwin', 1566, '10-may', 41, 'MG', 145, 'In The Evening', 4, 'Ongoing', 518, 'Blood Pressure/Cholesterol', 1, NULL, '2020-10-07 08:28:32', '2020-10-07 08:28:32'),
(1768, 'Cal One-d', NULL, 'cal-one-d', 1568, '830/400 Iu', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:28:32', '2020-10-07 08:28:32'),
(1770, 'Calan', NULL, 'calan', 1537, '80', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:32', '2020-10-07 08:28:32'),
(1771, 'Calan Sr', NULL, 'calan-sr', 1569, '240', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:32', '2020-10-07 08:28:32'),
(1774, 'Caliptrol', NULL, 'caliptrol', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:28:32', '2020-10-07 08:28:32'),
(1777, 'Calpol', NULL, 'calpol', 1477, '60', 41, 'MG', 97, 'One Tablet Twice A Day', 5, 'As Needed', 40, 'Pain', 1, NULL, '2020-10-07 08:28:33', '2020-10-07 08:28:33'),
(1778, 'Calpol 6 Plus', NULL, 'calpol-6-plus', 1477, '60', 41, 'MG', 146, '2 Teaspoon Thrice A Day After Meal', 5, 'As Needed', 40, 'Pain', 1, NULL, '2020-10-07 08:28:33', '2020-10-07 08:28:33'),
(1779, 'Caltrate', NULL, 'caltrate', 1572, '1500', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:28:33', '2020-10-07 08:28:33'),
(1780, 'Caltriol', NULL, 'caltriol', 1517, '0.25', 41, 'MG', 147, 'One Capsule In The Morning', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:28:33', '2020-10-07 08:28:33'),
(1781, 'Camcolit', NULL, 'camcolit', 1471, '400', 41, 'MG', 148, '2 Tablets Twice A Day', 4, 'Ongoing', 524, 'Mania', 1, NULL, '2020-10-07 08:28:33', '2020-10-07 08:28:33'),
(1782, 'Canesten', NULL, 'canesten', 1573, '1%', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 524, 'Mania', 1, NULL, '2020-10-07 08:28:33', '2020-10-07 08:28:33'),
(1785, 'Canesten - Vag Tab / Cream', NULL, 'canesten-vag-tab-cream', 1570, '500', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 524, 'Mania', 1, NULL, '2020-10-07 08:28:33', '2020-10-07 08:28:33'),
(1786, 'Canrec Plus', NULL, 'canrec-plus', 1574, '160/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:33', '2020-10-07 08:28:33'),
(1787, 'Cansaar', NULL, 'cansaar', 1491, '16', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:33', '2020-10-07 08:28:33'),
(1788, 'Cansaar Plus', NULL, 'cansaar-plus', 1516, '16/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:33', '2020-10-07 08:28:33'),
(1789, 'Capcidol Cream', NULL, 'capcidol-cream', 1575, '0.08%', 41, 'MG', 149, 'Apply To Affected Area Thrice A Day As Needed For Pain', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:33', '2020-10-07 08:28:33'),
(1790, 'Capcidol Plus Lotion', NULL, 'capcidol-plus-lotion', 1575, '0.08%', 41, 'MG', 149, 'Apply To Affected Area Thrice A Day As Needed For Pain', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:33', '2020-10-07 08:28:33'),
(1795, 'Capsidol Lotion', NULL, 'capsidol-lotion', 1573, '1%', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 5, 'As Needed', 41, 'Pain In Feet', 1, NULL, '2020-10-07 08:28:34', '2020-10-07 08:28:34'),
(1796, 'Cara', NULL, 'cara', 1473, '20', 41, 'MG', 116, '5 Tablets Once Daily For 3 Days', 4, 'Ongoing', 10, 'Arthritis', 1, NULL, '2020-10-07 08:28:34', '2020-10-07 08:28:34'),
(1797, 'Carbizole', NULL, 'carbizole', 1476, '5', 41, 'MG', 108, 'One Tablet Thrice A Day', 4, 'Ongoing', 47, 'Thyroid', 1, NULL, '2020-10-07 08:28:34', '2020-10-07 08:28:34'),
(1799, 'Cardace', NULL, 'cardace', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:34', '2020-10-07 08:28:34'),
(1800, 'Cardace-h', NULL, 'cardace-h', 1578, '5/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:34', '2020-10-07 08:28:34'),
(1802, 'Cardnit', NULL, 'cardnit', 1580, '6.4', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 520, 'Angina', 1, NULL, '2020-10-07 08:28:34', '2020-10-07 08:28:34'),
(1804, 'Cardura', NULL, 'cardura', 1486, '4', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:34', '2020-10-07 08:28:34'),
(1807, 'Carlov', NULL, 'carlov', 1582, '6.25', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:34', '2020-10-07 08:28:34'),
(1810, 'Carsel', NULL, 'carsel', 1474, '50', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:34', '2020-10-07 08:28:34'),
(1811, 'Carsel - Plus Tab', NULL, 'carsel-plus-tab', 1583, '100 / 25', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:34', '2020-10-07 08:28:34'),
(1814, 'Carveda', NULL, 'carveda', 1582, '6.25', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:34', '2020-10-07 08:28:34'),
(1815, 'Casodex', NULL, 'casodex', 1474, '50', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 44, 'Prostate', 1, NULL, '2020-10-07 08:28:34', '2020-10-07 08:28:34'),
(1817, 'Caverject', NULL, 'caverject', 1473, '20', 46, 'MCG', 101, 'One Tablet Daily', 4, 'Ongoing', 174, 'Erectile Dysfunction', 1, NULL, '2020-10-07 08:28:35', '2020-10-07 08:28:35'),
(1820, 'Cefspan', NULL, 'cefspan', 1471, '400', 46, 'MCG', 147, 'One Capsule In The Morning', 8, '5 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:28:35', '2020-10-07 08:28:35'),
(1821, 'Cellcept', NULL, 'cellcept', 1570, '500', 41, 'MG', 110, 'One Injection Twice A Day', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:28:35', '2020-10-07 08:28:35'),
(1823, 'Centrum Silver', NULL, 'centrum-silver', 1570, '500', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:28:35', '2020-10-07 08:28:35'),
(1824, 'Cheer', NULL, 'cheer', 1473, '20', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:28:36', '2020-10-07 08:28:36'),
(1826, 'Cheerup', NULL, 'cheerup', 1473, '20', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:28:36', '2020-10-07 08:28:36'),
(1828, 'Chewcal', NULL, 'chewcal', 1585, '400 / 2.5 /', 47, 'Tab', 113, 'One Tablet In The Evening', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:28:36', '2020-10-07 08:28:36'),
(1830, 'Chymoral', NULL, 'chymoral', 1586, 'Ongoing', 48, 'Forte Tab', 113, 'One Tablet In The Evening', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:28:36', '2020-10-07 08:28:36'),
(1831, 'Chymotrip Forte', NULL, 'chymotrip-forte', 1586, 'Ongoing', 49, 'Tablet', 113, 'One Tablet In The Evening', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:28:36', '2020-10-07 08:28:36'),
(1833, 'Cialis', NULL, 'cialis', 1473, '20', 41, 'MG', 152, 'Half Tablet Half Hour Before Intended Sexual Intercourse', 5, 'As Needed', 174, 'Erectile Dysfunction', 1, NULL, '2020-10-07 08:28:36', '2020-10-07 08:28:36'),
(1835, 'Cicatrin', NULL, 'cicatrin', 1473, '20', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 174, 'Erectile Dysfunction', 1, NULL, '2020-10-07 08:28:36', '2020-10-07 08:28:36'),
(1836, 'Cipralex', NULL, 'cipralex', 1475, '10', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:28:36', '2020-10-07 08:28:36'),
(1839, 'Ciproxin', NULL, 'ciproxin', 1570, '500', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 6, '7 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:28:36', '2020-10-07 08:28:36'),
(1841, 'Citanew', NULL, 'citanew', 1476, '5', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:28:36', '2020-10-07 08:28:36'),
(1842, 'Citralka', NULL, 'citralka', 1587, 'Syp', 50, '(in glass of water)', 146, '2 Teaspoon Thrice A Day After Meal', 8, '5 Days', 21, 'Depression', 1, NULL, '2020-10-07 08:28:36', '2020-10-07 08:28:36'),
(1844, 'Claritek', NULL, 'claritek', 1570, '500', 41, 'MG', 97, 'One Tablet Twice A Day', 6, '7 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:28:37', '2020-10-07 08:28:37'),
(1845, 'Clenil', NULL, 'clenil', 1588, '50/100', 41, 'MG', 125, '2 Puffs Four Times A Day', 4, 'Ongoing', 11, 'Asthma', 1, NULL, '2020-10-07 08:28:37', '2020-10-07 08:28:37'),
(1846, 'Clenil - A', NULL, 'clenil-a', 1589, 'No Dose Mentioned Dose', 41, 'MG', 154, 'Nebulize Twice Daily', 4, 'Ongoing', 11, 'Asthma', 1, NULL, '2020-10-07 08:28:37', '2020-10-07 08:28:37'),
(1847, 'Clenil Compositum-a', NULL, 'clenil-compositum-a', 1590, '0.8 / 1.6', 41, 'MG', 154, 'Nebulize Twice Daily', 4, 'Ongoing', 11, 'Asthma', 1, NULL, '2020-10-07 08:28:37', '2020-10-07 08:28:37'),
(1849, 'Clenil Forte Jet', NULL, 'clenil-forte-jet', 1591, '250 Mcg', 46, 'MCG', 125, '2 Puffs Four Times A Day', 4, 'Ongoing', 11, 'Asthma', 1, NULL, '2020-10-07 08:28:37', '2020-10-07 08:28:37'),
(1850, 'Cleocin', NULL, 'cleocin', 1521, '150', 43, 'ML', 155, '2 Injections Twice A Day', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:28:37', '2020-10-07 08:28:37'),
(1854, 'Clexane', NULL, 'clexane', 1537, '80', 41, 'MG', 106, 'One Injection Subcutaneously', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:28:37', '2020-10-07 08:28:37'),
(1855, 'Climen', NULL, 'climen', 1537, '80', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 9, '21 Days', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:28:37', '2020-10-07 08:28:37'),
(1856, 'Clinagel', NULL, 'clinagel', 1475, '10', 41, 'MG', 104, 'Apply Twice A Day', 4, 'Ongoing', 6, 'Antibiotic', 1, NULL, '2020-10-07 08:28:37', '2020-10-07 08:28:37'),
(1857, 'Clobederm', NULL, 'clobederm', 1592, '0.05%', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 6, 'Antibiotic', 1, NULL, '2020-10-07 08:28:37', '2020-10-07 08:28:37'),
(1858, 'Clobederm-nn', NULL, 'clobederm-nn', 1586, 'Ongoing', 51, 'Oint', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 6, 'Antibiotic', 1, NULL, '2020-10-07 08:28:37', '2020-10-07 08:28:37'),
(1859, 'Clobederm-s', NULL, 'clobederm-s', 1586, 'Ongoing', 52, 'Lotion', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 6, 'Antibiotic', 1, NULL, '2020-10-07 08:28:37', '2020-10-07 08:28:37'),
(1861, 'Clozaril', NULL, 'clozaril', 1518, '100', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 6, 'Antibiotic', 1, NULL, '2020-10-07 08:28:37', '2020-10-07 08:28:37'),
(1862, 'Co-aprovel', NULL, 'co-aprovel', 1536, '300/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:37', '2020-10-07 08:28:37'),
(1863, 'Cock Up Splint', NULL, 'cock-up-splint', 1472, '1', 41, 'MG', 156, 'Splint Right Wrist. Use As Directed', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:37', '2020-10-07 08:28:37'),
(1866, 'Co-diovan', NULL, 'co-diovan', 1594, '80/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:38', '2020-10-07 08:28:38'),
(1869, 'Co-extor', NULL, 'co-extor', 1549, '5/160/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:38', '2020-10-07 08:28:38'),
(1871, 'Co-eziday', NULL, 'co-eziday', 1559, '50/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:38', '2020-10-07 08:28:38'),
(1874, 'Cofcol', NULL, 'cofcol', 1477, '60', 41, 'MG', 100, 'One Tablespoon Twice A Day', 4, 'Ongoing', 20, 'Cough', 1, NULL, '2020-10-07 08:28:38', '2020-10-07 08:28:38'),
(1877, 'Coldene', NULL, 'coldene', 1477, '60', 41, 'MG', 100, 'One Tablespoon Twice A Day', 4, 'Ongoing', 20, 'Cough', 1, NULL, '2020-10-07 08:28:38', '2020-10-07 08:28:38'),
(1879, 'Coldrex', NULL, 'coldrex', 1477, '60', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 20, 'Cough', 1, NULL, '2020-10-07 08:28:39', '2020-10-07 08:28:39'),
(1880, 'Coldrex - E', NULL, 'coldrex-e', 1540, '120', 41, 'MG', 100, 'One Tablespoon Twice A Day', 4, 'Ongoing', 20, 'Cough', 1, NULL, '2020-10-07 08:28:39', '2020-10-07 08:28:39'),
(1881, 'Colofac', NULL, 'colofac', 1598, '135', 41, 'MG', 157, 'One Tablet Before Breakfast And Dinner', 4, 'Ongoing', 20, 'Cough', 1, NULL, '2020-10-07 08:28:39', '2020-10-07 08:28:39'),
(1882, 'Conaz - Lotion', NULL, 'conaz-lotion', 1473, '20', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 20, 'Cough', 1, NULL, '2020-10-07 08:28:39', '2020-10-07 08:28:39'),
(1885, 'Concor', NULL, 'concor', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:39', '2020-10-07 08:28:39'),
(1890, 'Co-renitec', NULL, 'co-renitec', 1600, '25-oct', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:28:39', '2020-10-07 08:28:39'),
(1891, 'Corgard', NULL, 'corgard', 1537, '80', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:28:39', '2020-10-07 08:28:39'),
(1893, 'Co-tasmi', NULL, 'co-tasmi', 1594, '80/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:39', '2020-10-07 08:28:39'),
(1894, 'Co-telsan', NULL, 'co-telsan', 1601, '40/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:39', '2020-10-07 08:28:39'),
(1895, 'Co-trupril', NULL, 'co-trupril', 1602, '20/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:40', '2020-10-07 08:28:40'),
(1897, 'Cova', NULL, 'cova', 1537, '80', 41, 'MG', 96, 'One Tablet In The Morning', 10, 'Once', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:40', '2020-10-07 08:28:40'),
(1899, 'Cova-h', NULL, 'cova-h', 1594, '80/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:40', '2020-10-07 08:28:40'),
(1902, 'Co-valtec', NULL, 'co-valtec', 1594, '80/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:40', '2020-10-07 08:28:40'),
(1912, 'Coversyl', NULL, 'coversyl', 1488, '8', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:41', '2020-10-07 08:28:41'),
(1913, 'Coversyl Plus', NULL, 'coversyl-plus', 1472, '1', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:41', '2020-10-07 08:28:41'),
(1914, 'Cozaar', NULL, 'cozaar', 1474, '50', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:41', '2020-10-07 08:28:41'),
(1918, 'Crestor', NULL, 'crestor', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:28:41', '2020-10-07 08:28:41'),
(1919, 'Daclatsavir', NULL, 'daclatsavir', 1477, '60', 41, 'MG', 158, 'One Tablet In The Morning After Breakfast', 11, '6 Months', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:28:41', '2020-10-07 08:28:41'),
(1920, 'Daflon', NULL, 'daflon', 1570, '500', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:28:41', '2020-10-07 08:28:41'),
(1921, 'Daktacort', NULL, 'daktacort', 1606, 'No Dose Mentioned', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:28:41', '2020-10-07 08:28:41'),
(1922, 'Daktarin', NULL, 'daktarin', 1481, '2%', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:28:41', '2020-10-07 08:28:41'),
(1924, 'Daktarin Oral Gel', NULL, 'daktarin-oral-gel', 1607, '20/gram', 41, 'MG', 159, 'Half Teaspoon Four Times Daily >< 7 Days. Retain Gel In Mouth As Long As Possible', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:28:41', '2020-10-07 08:28:41'),
(1925, 'Dalacin T', NULL, 'dalacin-t', 1475, '10', 41, 'MG', 104, 'Apply Twice A Day', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:28:41', '2020-10-07 08:28:41'),
(1927, 'Dalacin C', NULL, 'dalacin-c', 1534, '300', 41, 'MG', 160, 'One Capsule Thrice A Day', 6, '7 Days', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:28:41', '2020-10-07 08:28:41'),
(1928, 'Dalacin V', NULL, 'dalacin-v', 1608, '2 % (percent)', 41, 'MG', 104, 'Apply Twice A Day', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:28:41', '2020-10-07 08:28:41'),
(1931, 'Dalacin-c', NULL, 'dalacin-c', 1562, '600', 41, 'MG', 110, 'One Injection Twice A Day', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:28:42', '2020-10-07 08:28:42'),
(1932, 'Dan-d', NULL, 'dan-d', 1609, '200000', 53, 'IU', 161, 'Drink One Injection Every Month', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:28:42', '2020-10-07 08:28:42'),
(1934, 'Danzol', NULL, 'danzol', 1478, '200', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:28:42', '2020-10-07 08:28:42'),
(1935, 'Daonil', NULL, 'daonil', 1476, '5', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:42', '2020-10-07 08:28:42'),
(1937, 'Dapa', NULL, 'dapa', 1476, '5', 41, 'MG', 118, 'One Tablet In The Morning Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:42', '2020-10-07 08:28:42'),
(1938, 'Darwocet', NULL, 'darwocet', 1523, '32.5 / 325', 41, 'MG', 97, 'One Tablet Twice A Day', 5, 'As Needed', 40, 'Pain', 1, NULL, '2020-10-07 08:28:42', '2020-10-07 08:28:42'),
(1939, 'Deltacortril', NULL, 'deltacortril', 1476, '5', 41, 'MG', 97, 'One Tablet Twice A Day', 6, '7 Days', 40, 'Pain', 1, NULL, '2020-10-07 08:28:42', '2020-10-07 08:28:42'),
(1941, 'Depo-medrol', NULL, 'depo-medrol', 1537, '80', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:28:42', '2020-10-07 08:28:42'),
(1943, 'Deponit', NULL, 'deponit', 1476, '5', 41, 'MG', 104, 'Apply Twice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:28:42', '2020-10-07 08:28:42'),
(1944, 'Depo-provera', NULL, 'depo-provera', 1521, '150', 43, 'ML', 104, 'Apply Twice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:28:42', '2020-10-07 08:28:42'),
(1947, 'Deprel', NULL, 'deprel', 1612, '25 Mg', 41, 'MG', 163, 'One Capsule At Bedtime', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:28:42', '2020-10-07 08:28:42'),
(1948, 'Depricap', NULL, 'depricap', 1473, '20', 41, 'MG', 147, 'One Capsule In The Morning', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:28:42', '2020-10-07 08:28:42'),
(1949, 'Dermaan', NULL, 'dermaan', 1613, '15 / 500', 41, 'MG', 97, 'One Tablet Twice A Day', 5, 'As Needed', 40, 'Pain', 1, NULL, '2020-10-07 08:28:42', '2020-10-07 08:28:42'),
(1950, 'Dermazin', NULL, 'dermazin', 1573, '1%', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:28:42', '2020-10-07 08:28:42'),
(1951, 'Dermovate', NULL, 'dermovate', 1592, '0.05%', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:28:42', '2020-10-07 08:28:42'),
(1952, 'Dermovate-nn', NULL, 'dermovate-nn', 1586, 'Ongoing', 54, 'Cream', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:28:42', '2020-10-07 08:28:42'),
(1955, 'Descol', NULL, 'descol', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:28:42', '2020-10-07 08:28:42'),
(1956, 'Detriflow', NULL, 'detriflow', 1502, '40', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:28:42', '2020-10-07 08:28:42'),
(1958, 'Detrusitol', NULL, 'detrusitol', 1486, '4', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:28:43', '2020-10-07 08:28:43'),
(1960, 'Dexxo', NULL, 'dexxo', 1477, '60', 41, 'MG', 165, 'One Capsule In The Morning Before Breakfast', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:28:43', '2020-10-07 08:28:43'),
(1961, 'Diamicron', NULL, 'diamicron', 1537, '80', 41, 'MG', 166, 'One Tablet Twice A Day Before Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:43', '2020-10-07 08:28:43'),
(1962, 'Diamicron Mr', NULL, 'diamicron-mr', 1497, '30', 41, 'MG', 157, 'One Tablet Before Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:43', '2020-10-07 08:28:43'),
(1963, 'Diamicron Mr 60', NULL, 'diamicron-mr-60', 1477, '60', 41, 'MG', 118, 'One Tablet In The Morning Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:43', '2020-10-07 08:28:43'),
(1964, 'Diamox', NULL, 'diamox', 1479, '250', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:43', '2020-10-07 08:28:43'),
(1965, 'Diane 35', NULL, 'diane-35', 1614, '2 / 35 /', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:43', '2020-10-07 08:28:43'),
(1967, 'Dicloran', NULL, 'dicloran', 1518, '100', 41, 'MG', 97, 'One Tablet Twice A Day', 5, 'As Needed', 40, 'Pain', 1, NULL, '2020-10-07 08:28:43', '2020-10-07 08:28:43'),
(1968, 'Dicloran Gel', NULL, 'dicloran-gel', 1473, '20', 41, 'MG', 149, 'Apply To Affected Area Thrice A Day As Needed For Pain', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:28:43', '2020-10-07 08:28:43'),
(1969, 'Dijex Mp', NULL, 'dijex-mp', 1587, 'Syp', 41, 'MG', 168, '2 Teaspoons Twice A Day After Meal', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:28:43', '2020-10-07 08:28:43'),
(1970, 'Dilatrend', NULL, 'dilatrend', 1581, '12.5', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:28:43', '2020-10-07 08:28:43'),
(1972, 'Dioplus 5/80 Mg', NULL, 'dioplus-580-mg', 1529, 'May-80', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:43', '2020-10-07 08:28:43'),
(1974, 'Diovan', NULL, 'diovan', 1537, '80', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:44', '2020-10-07 08:28:44'),
(1975, 'Dispirin Cv', NULL, 'dispirin-cv', 1518, '100', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:28:44', '2020-10-07 08:28:44'),
(1977, 'Dovate', NULL, 'dovate', 1616, '10000 / 500 Potency_unit', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:28:44', '2020-10-07 08:28:44'),
(1979, 'Drate', NULL, 'drate', 1515, '70', 41, 'MG', 136, 'Take One Tablet Every Sunday On An Empty Stomach With 2 Glasses Of Water. Do Not Eat', 4, 'Ongoing', 15, 'Bone Weakness', 1, NULL, '2020-10-07 08:28:44', '2020-10-07 08:28:44'),
(1980, 'D-shot', NULL, 'd-shot', 1609, '200000', 53, 'IU', 139, 'Drink One Injection Every 2 Weeks', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:28:44', '2020-10-07 08:28:44'),
(1981, 'D-sun', NULL, 'd-sun', 1609, '200000', 53, 'IU', 170, 'Two Capsules Every Sunday', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:28:44', '2020-10-07 08:28:44'),
(1983, 'Duac', NULL, 'duac', 1475, '10', 55, 'GM', 104, 'Apply Twice A Day', 4, 'Ongoing', 517, 'Antibiotic/antibaterial/keratinolytic', 1, NULL, '2020-10-07 08:28:44', '2020-10-07 08:28:44'),
(1986, 'Dulan', NULL, 'dulan', 1477, '60', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:28:44', '2020-10-07 08:28:44'),
(1987, 'Dulcolax', NULL, 'dulcolax', 1476, '5', 41, 'MG', 124, '2 Tablets At Bedtime', 4, 'Ongoing', 19, 'Constipation', 1, NULL, '2020-10-07 08:28:44', '2020-10-07 08:28:44'),
(1988, 'Duodart', NULL, 'duodart', 1618, '500/400', 46, 'MCG', 163, 'One Capsule At Bedtime', 4, 'Ongoing', 44, 'Prostate', 1, NULL, '2020-10-07 08:28:44', '2020-10-07 08:28:44'),
(1989, 'Duofilm', NULL, 'duofilm', 1619, '16.7 / 16.7 %', 46, 'MCG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 44, 'Prostate', 1, NULL, '2020-10-07 08:28:44', '2020-10-07 08:28:44'),
(1991, 'Duphalac', NULL, 'duphalac', 1621, '60 Ml', 46, 'MCG', 168, '2 Teaspoons Twice A Day After Meal', 5, 'As Needed', 25, 'Duphaly', 1, NULL, '2020-10-07 08:28:44', '2020-10-07 08:28:44'),
(1993, 'Duphaston', NULL, 'duphaston', 1475, '10', 41, 'MG', 168, '2 Teaspoons Twice A Day After Meal', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:44', '2020-10-07 08:28:44'),
(1994, 'Duxil', NULL, 'duxil', 1622, '30/10', 41, 'MG', 168, '2 Teaspoons Twice A Day After Meal', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:44', '2020-10-07 08:28:44'),
(1995, 'Ebixa', NULL, 'ebixa', 1475, '10', 41, 'MG', 168, '2 Teaspoons Twice A Day After Meal', 4, 'Ongoing', 36, 'Memory', 1, NULL, '2020-10-07 08:28:44', '2020-10-07 08:28:44'),
(1998, 'Efexor', NULL, 'efexor', 1533, '75', 41, 'MG', 174, 'Half Tablet Twice A Day', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:28:45', '2020-10-07 08:28:45'),
(2000, 'Ellettra', NULL, 'ellettra', 1474, '50', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:28:45', '2020-10-07 08:28:45'),
(2004, 'Engerix-b', NULL, 'engerix-b', 1531, '20 Mcg', 43, 'ML', 106, 'One Injection Subcutaneously', 4, 'Ongoing', 32, 'Hepatitis B Prevention', 1, NULL, '2020-10-07 08:28:45', '2020-10-07 08:28:45'),
(2005, 'Ensure Powder', NULL, 'ensure-powder', 1531, '20 Mcg', 43, 'ML', 176, 'Mix 5 Tablespoons In One Glass Of Water And Drink Three Times A Day', 4, 'Ongoing', 32, 'Hepatitis B Prevention', 1, NULL, '2020-10-07 08:28:45', '2020-10-07 08:28:45'),
(2007, 'Entamizole', NULL, 'entamizole', 1570, '500', 41, 'MG', 108, 'One Tablet Thrice A Day', 6, '7 Days', 23, 'Diarrhea', 1, NULL, '2020-10-07 08:28:45', '2020-10-07 08:28:45'),
(2009, 'Enziclor', NULL, 'enziclor', 1534, '300', 41, 'MG', 131, 'Gargle Twice Daily', 4, 'Ongoing', 23, 'Diarrhea', 1, NULL, '2020-10-07 08:28:45', '2020-10-07 08:28:45'),
(2011, 'Epival', NULL, 'epival', 1570, '500', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 173, 'Epilepsy', 1, NULL, '2020-10-07 08:28:45', '2020-10-07 08:28:45'),
(2012, 'Es-pramcit', NULL, 'es-pramcit', 1475, '10', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:28:45', '2020-10-07 08:28:45'),
(2014, 'Esso', NULL, 'esso', 1502, '40', 41, 'MG', 165, 'One Capsule In The Morning Before Breakfast', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:28:45', '2020-10-07 08:28:45'),
(2017, 'Estar', NULL, 'estar', 1476, '5', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:28:46', '2020-10-07 08:28:46'),
(2021, 'Evopride', NULL, 'evopride', 1486, '4', 41, 'MG', 118, 'One Tablet In The Morning Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:46', '2020-10-07 08:28:46'),
(2024, 'Evopride Plus', NULL, 'evopride-plus', 1624, '2/850', 41, 'MG', 166, 'One Tablet Twice A Day Before Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:46', '2020-10-07 08:28:46'),
(2028, 'Exelon', NULL, 'exelon', 1487, '6', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 365, 'Parkinsonism', 1, NULL, '2020-10-07 08:28:46', '2020-10-07 08:28:46');
INSERT INTO `medications` (`id`, `title`, `generic_name`, `slug`, `dose_id`, `dose`, `unit_id`, `unit`, `frequency_id`, `frequency`, `duration_id`, `duration`, `diagnosis_type_id`, `diagnosis_type`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2029, 'Exen-d', NULL, 'exen-d', 1626, '500 / 500 Iu', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 15, 'Bone Weakness', 1, NULL, '2020-10-07 08:28:46', '2020-10-07 08:28:46'),
(2030, 'Exforge Hct', NULL, 'exforge-hct', 1549, '5/160/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:47', '2020-10-07 08:28:47'),
(2038, 'Faast', NULL, 'faast', 1631, '40/1100', 41, 'MG', 147, 'One Capsule In The Morning', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:28:47', '2020-10-07 08:28:47'),
(2039, 'Fabofen', NULL, 'fabofen', 1518, '100', 41, 'MG', 96, 'One Tablet In The Morning', 5, 'As Needed', 40, 'Pain', 1, NULL, '2020-10-07 08:28:47', '2020-10-07 08:28:47'),
(2041, 'Facal-d', NULL, 'facal-d', 1632, '0.5 Mcg', 41, 'MG', 137, '2 Tablets In The Morning', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:28:47', '2020-10-07 08:28:47'),
(2042, 'Faclo', NULL, 'faclo', 1598, '135', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:28:47', '2020-10-07 08:28:47'),
(2043, 'Falcinil', NULL, 'falcinil', 1633, '20/120', 41, 'MG', 122, 'Four Tablets As A Single Dose Now', 4, 'Ongoing', 35, 'Malaria', 1, NULL, '2020-10-07 08:28:47', '2020-10-07 08:28:47'),
(2044, 'Falcinil Ds', NULL, 'falcinil-ds', 1538, '40/240', 41, 'MG', 177, 'Two Tablets As A Single Dose Now', 4, 'Ongoing', 35, 'Malaria', 1, NULL, '2020-10-07 08:28:48', '2020-10-07 08:28:48'),
(2045, 'Falcinil Qs', NULL, 'falcinil-qs', 1539, '80/480', 41, 'MG', 178, 'One Tablet As A Single Dose Now', 4, 'Ongoing', 35, 'Malaria', 1, NULL, '2020-10-07 08:28:48', '2020-10-07 08:28:48'),
(2046, 'Famila-28', NULL, 'famila-28', 1634, '0.15 / 0.03', 41, 'MG', 178, 'One Tablet As A Single Dose Now', 4, 'Ongoing', 35, 'Malaria', 1, NULL, '2020-10-07 08:28:48', '2020-10-07 08:28:48'),
(2047, 'Fastum Gel', NULL, 'fastum-gel', 1635, '2.50%', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:28:48', '2020-10-07 08:28:48'),
(2051, 'Ferijet', NULL, 'ferijet', 1473, '20', 43, 'ML', 96, 'One Tablet In The Morning', 4, 'Ongoing', 5, 'Anemia', 1, NULL, '2020-10-07 08:28:48', '2020-10-07 08:28:48'),
(2052, 'Ferplex', NULL, 'ferplex', 1606, 'No Dose Mentioned', 43, 'ML', 179, 'One Tablespoon In The Morning', 4, 'Ongoing', 5, 'Anemia', 1, NULL, '2020-10-07 08:28:48', '2020-10-07 08:28:48'),
(2053, 'Fiore-f', NULL, 'fiore-f', 1637, '100/0.35', 41, 'MG', 180, 'One Tablet With Lunch And Dinner', 4, 'Ongoing', 5, 'Anemia', 1, NULL, '2020-10-07 08:28:48', '2020-10-07 08:28:48'),
(2054, 'Fish Oils (gnc)', NULL, 'fish-oils-gnc', 1638, '1000/300', 41, 'MG', 160, 'One Capsule Thrice A Day', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:28:48', '2020-10-07 08:28:48'),
(2057, 'Flagyl', NULL, 'flagyl', 1570, '500', 41, 'MG', 182, 'One Teaspoon Twice A Day After Meal', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:28:48', '2020-10-07 08:28:48'),
(2058, 'Flexiflow', NULL, 'flexiflow', 1533, '75', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:28:48', '2020-10-07 08:28:48'),
(2059, 'Flexiplus', NULL, 'flexiplus', 1639, '75/75', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:28:48', '2020-10-07 08:28:48'),
(2060, 'Flomax', NULL, 'flomax', 1640, '0.4', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 44, 'Prostate', 1, NULL, '2020-10-07 08:28:48', '2020-10-07 08:28:48'),
(2061, 'Fml-neo', NULL, 'fml-neo', 1641, '0.1 / 0.5 %', 41, 'MG', 134, 'One Drop Twice Daily', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:28:48', '2020-10-07 08:28:48'),
(2062, 'Foliant', NULL, 'foliant', 1475, '10', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 36, 'Memory', 1, NULL, '2020-10-07 08:28:49', '2020-10-07 08:28:49'),
(2063, 'Folic Acid Tabs 5mg - Zafa', NULL, 'folic-acid-tabs-5mg-zafa', 1476, '5', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 5, 'Anemia', 1, NULL, '2020-10-07 08:28:49', '2020-10-07 08:28:49'),
(2065, 'Forsteo', NULL, 'forsteo', 1531, '20 Mcg', 46, 'MCG', 106, 'One Injection Subcutaneously', 12, '7 Months', 15, 'Bone Weakness', 1, NULL, '2020-10-07 08:28:49', '2020-10-07 08:28:49'),
(2066, 'Fosamax', NULL, 'fosamax', 1515, '70', 41, 'MG', 136, 'Take One Tablet Every Sunday On An Empty Stomach With 2 Glasses Of Water. Do Not Eat', 4, 'Ongoing', 15, 'Bone Weakness', 1, NULL, '2020-10-07 08:28:49', '2020-10-07 08:28:49'),
(2070, 'Fragmin', NULL, 'fragmin', 1645, '7500 Iu', 43, 'ML', 183, 'One Injection Subcutaneously Every Day', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:28:49', '2020-10-07 08:28:49'),
(2074, 'Fraxiparine', NULL, 'fraxiparine', 1647, '0.6', 43, 'ML', 184, 'One Injection Intravenously ', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:28:49', '2020-10-07 08:28:49'),
(2075, 'Freac', NULL, 'freac', 1473, '20', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 3, 'Acne', 1, NULL, '2020-10-07 08:28:49', '2020-10-07 08:28:49'),
(2079, 'Fucidin', NULL, 'fucidin', 1649, '90', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:28:49', '2020-10-07 08:28:49'),
(2080, 'Fucidin - Cream / Oint', NULL, 'fucidin-cream-oint', 1608, '2 % (percent)', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:28:49', '2020-10-07 08:28:49'),
(2081, 'Fucidin - H', NULL, 'fucidin-h', 1608, '2 % (percent)', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:28:49', '2020-10-07 08:28:49'),
(2082, 'Fucidin Intertulle', NULL, 'fucidin-intertulle', 1608, '2 % (percent)', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:28:49', '2020-10-07 08:28:49'),
(2084, 'Funge', NULL, 'funge', 1479, '250', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:28:50', '2020-10-07 08:28:50'),
(2086, 'Futine', NULL, 'futine', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:28:50', '2020-10-07 08:28:50'),
(2088, 'Gabafix', NULL, 'gabafix', 1534, '300', 41, 'MG', 163, 'One Capsule At Bedtime', 4, 'Ongoing', 16, 'Burning Of Feet', 1, NULL, '2020-10-07 08:28:50', '2020-10-07 08:28:50'),
(2093, 'Gabica', NULL, 'gabica', 1533, '75', 41, 'MG', 163, 'One Capsule At Bedtime', 4, 'Ongoing', 41, 'Pain In Feet', 1, NULL, '2020-10-07 08:28:50', '2020-10-07 08:28:50'),
(2094, 'Gablin', NULL, 'gablin', 1521, '150', 41, 'MG', 163, 'One Capsule At Bedtime', 4, 'Ongoing', 41, 'Pain In Feet', 1, NULL, '2020-10-07 08:28:50', '2020-10-07 08:28:50'),
(2095, 'Galvus', NULL, 'galvus', 1474, '50', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:50', '2020-10-07 08:28:50'),
(2098, 'Galvusmet', NULL, 'galvusmet', 1652, '50/500', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:50', '2020-10-07 08:28:50'),
(2099, 'Ganaton', NULL, 'ganaton', 1474, '50', 41, 'MG', 157, 'One Tablet Before Breakfast And Dinner', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:28:50', '2020-10-07 08:28:50'),
(2100, 'Gc-plus', NULL, 'gc-plus', 1618, '500/400', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 10, 'Arthritis', 1, NULL, '2020-10-07 08:28:50', '2020-10-07 08:28:50'),
(2101, 'Gelusil - Tab', NULL, 'gelusil-tab', 1653, '200 / 200 / 25', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:28:50', '2020-10-07 08:28:50'),
(2105, 'Getryl', NULL, 'getryl', 1486, '4', 41, 'MG', 118, 'One Tablet In The Morning Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:50', '2020-10-07 08:28:50'),
(2107, 'Gevolox', NULL, 'gevolox', 1570, '500', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 10, 'Arthritis', 1, NULL, '2020-10-07 08:28:50', '2020-10-07 08:28:50'),
(2108, 'Glucerna Sr Powder', NULL, 'glucerna-sr-powder', 1570, '500', 41, 'MG', 176, 'Mix 5 Tablespoons In One Glass Of Water And Drink Three Times A Day', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:28:51', '2020-10-07 08:28:51'),
(2110, 'Glucobay', NULL, 'glucobay', 1474, '50', 41, 'MG', 186, 'One Tablet Thrice A Day Before Each Meal', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:51', '2020-10-07 08:28:51'),
(2114, 'Glucophage', NULL, 'glucophage', 1654, '850', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:51', '2020-10-07 08:28:51'),
(2115, 'Glucophage-xr', NULL, 'glucophage-xr', 1655, '750', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:51', '2020-10-07 08:28:51'),
(2119, 'Glyset', NULL, 'glyset', 1486, '4', 41, 'MG', 118, 'One Tablet In The Morning Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:51', '2020-10-07 08:28:51'),
(2120, 'Gonadil F', NULL, 'gonadil-f', 1656, 'Cap', 41, 'MG', 163, 'One Capsule At Bedtime', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:52', '2020-10-07 08:28:52'),
(2121, 'Gonal F Inj', NULL, 'gonal-f-inj', 1657, '75 Iu', 43, 'ML', 163, 'One Capsule At Bedtime', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:52', '2020-10-07 08:28:52'),
(2125, 'Grasil', NULL, 'grasil', 1570, '500', 43, 'ML', 110, 'One Injection Twice A Day', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:28:52', '2020-10-07 08:28:52'),
(2126, 'Halobetasol Propionate Ointment', NULL, 'halobetasol-propionate-ointment', 1592, '0.05%', 43, 'ML', 111, 'Apply To Affected Area Once Daily', 4, 'Ongoing', 45, 'Psoriasis', 1, NULL, '2020-10-07 08:28:52', '2020-10-07 08:28:52'),
(2128, 'Havrix', NULL, 'havrix', 1659, '720 Potency_unit', 43, 'ML', 106, 'One Injection Subcutaneously', 4, 'Ongoing', 31, 'Hepatitis A Prevention', 1, NULL, '2020-10-07 08:28:52', '2020-10-07 08:28:52'),
(2132, 'Herbesser', NULL, 'herbesser', 1649, '90', 43, 'ML', 101, 'One Tablet Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:52', '2020-10-07 08:28:52'),
(2133, 'Herbesser Sr', NULL, 'herbesser-sr', 1649, '90', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:28:52', '2020-10-07 08:28:52'),
(2138, 'Hilin', NULL, 'hilin', 1533, '75', 41, 'MG', 163, 'One Capsule At Bedtime', 4, 'Ongoing', 41, 'Pain In Feet', 1, NULL, '2020-10-07 08:28:52', '2020-10-07 08:28:52'),
(2140, 'Histanil', NULL, 'histanil', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 5, 'As Needed', 4, 'Allergy', 1, NULL, '2020-10-07 08:28:52', '2020-10-07 08:28:52'),
(2141, 'Histanil-d', NULL, 'histanil-d', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 5, 'As Needed', 4, 'Allergy', 1, NULL, '2020-10-07 08:28:52', '2020-10-07 08:28:52'),
(2143, 'Hitop', NULL, 'hitop', 1474, '50', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 28, 'Headache', 1, NULL, '2020-10-07 08:28:52', '2020-10-07 08:28:52'),
(2177, 'Humalog Insulin', NULL, 'humalog-insulin', 1515, '70', 44, 'Units', 109, 'Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:54', '2020-10-07 08:28:54'),
(2197, 'Humalog Kwik Pen Insulin', NULL, 'humalog-kwik-pen-insulin', 1503, '42', 44, 'Units', 109, 'Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:55', '2020-10-07 08:28:55'),
(2231, 'Humalog Mix 50/50 Insulin', NULL, 'humalog-mix-5050-insulin', 1515, '70', 44, 'Units', 109, 'Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:57', '2020-10-07 08:28:57'),
(2232, 'Humatrope', NULL, 'humatrope', 1476, '5', 43, 'ML', 187, 'Mix Normal Saline Equal To One50 Units Of An Insulin Syringe With Humatrope Powder And Shake Gently. Draw One0 Units With Insulin Syringe And Inject Subcutaneously Monday To Saturday-sunday No Injection', 4, 'Ongoing', 29, 'Height', 1, NULL, '2020-10-07 08:28:58', '2020-10-07 08:28:58'),
(2245, 'Humulin 70/30 Mix', NULL, 'humulin-7030-mix', 1474, '50', 44, 'Units', 109, 'Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:28:58', '2020-10-07 08:28:58'),
(2283, 'Humulin-n Insulin', NULL, 'humulin-n-insulin', 1537, '80', 44, 'Units', 109, 'Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:01', '2020-10-07 08:29:01'),
(2318, 'Humulin-r Insulin', NULL, 'humulin-r-insulin', 1515, '70', 44, 'Units', 109, 'Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:03', '2020-10-07 08:29:03'),
(2321, 'Ibandro', NULL, 'ibandro', 1521, '150', 41, 'MG', 141, 'One Tablet On Onest Sunday Of Every Month On An Empty Stomach With 2 Glasses Of Water. Do Not Eat', 4, 'Ongoing', 15, 'Bone Weakness', 1, NULL, '2020-10-07 08:29:03', '2020-10-07 08:29:03'),
(2322, 'Iberet Folic', NULL, 'iberet-folic', 1521, '150', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 4, 'Ongoing', 5, 'Anemia', 1, NULL, '2020-10-07 08:29:03', '2020-10-07 08:29:03'),
(2324, 'Ilario', NULL, 'ilario', 1477, '60', 41, 'MG', 147, 'One Capsule In The Morning', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:29:03', '2020-10-07 08:29:03'),
(2325, 'Imatet', NULL, 'imatet', 1663, '40 Iu', 43, 'ML', 106, 'One Injection Subcutaneously', 4, 'Ongoing', 51, 'To Prevent Tetanus', 1, NULL, '2020-10-07 08:29:03', '2020-10-07 08:29:03'),
(2326, 'Imovax Polio', NULL, 'imovax-polio', 1483, '0.5', 43, 'ML', 106, 'One Injection Subcutaneously', 4, 'Ongoing', 50, 'To Prevent Polio', 1, NULL, '2020-10-07 08:29:03', '2020-10-07 08:29:03'),
(2327, 'Impika', NULL, 'impika', 1473, '20', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:29:03', '2020-10-07 08:29:03'),
(2328, 'Imuran', NULL, 'imuran', 1473, '20', 41, 'MG', 155, '2 Injections Twice A Day', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:29:03', '2020-10-07 08:29:03'),
(2329, 'Incremin', NULL, 'incremin', 1606, 'No Dose Mentioned', 41, 'MG', 155, '2 Injections Twice A Day', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:29:03', '2020-10-07 08:29:03'),
(2331, 'Inderal', NULL, 'inderal', 1502, '40', 41, 'MG', 108, 'One Tablet Thrice A Day', 4, 'Ongoing', 42, 'Palpitations', 1, NULL, '2020-10-07 08:29:03', '2020-10-07 08:29:03'),
(2332, 'Indrop-d', NULL, 'indrop-d', 1609, '200000', 53, 'IU', 139, 'Drink One Injection Every 2 Weeks', 13, '3 Months', 15, 'Bone Weakness', 1, NULL, '2020-10-07 08:29:03', '2020-10-07 08:29:03'),
(2334, 'Infanrix', NULL, 'infanrix', 1483, '0.5', 43, 'ML', 106, 'One Injection Subcutaneously', 14, 'Ml', 54, 'Vaccine', 1, NULL, '2020-10-07 08:29:03', '2020-10-07 08:29:03'),
(2336, 'Inosita', NULL, 'inosita', 1474, '50', 41, 'MG', 118, 'One Tablet In The Morning Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:04', '2020-10-07 08:29:04'),
(2339, 'Inosita Plus', NULL, 'inosita-plus', 1651, '50/850', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:04', '2020-10-07 08:29:04'),
(2374, 'Insulatard Insulin', NULL, 'insulatard-insulin', 1515, '70', 44, 'Units', 109, 'Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:06', '2020-10-07 08:29:06'),
(2375, 'Insulin Syringe 1cc', NULL, 'insulin-syringe-1cc', 1473, '20', 44, 'Units', 109, 'Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:06', '2020-10-07 08:29:06'),
(2376, 'Ipride', NULL, 'ipride', 1474, '50', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:29:06', '2020-10-07 08:29:06'),
(2377, 'Ipride Sr', NULL, 'ipride-sr', 1521, '150', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:29:06', '2020-10-07 08:29:06'),
(2379, 'Ivf-c', NULL, 'ivf-c', 1521, '150', 53, 'IU', 190, 'Half Injection Subcutaneously Three Times A Week', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:29:06', '2020-10-07 08:29:06'),
(2381, 'Ivf-m', NULL, 'ivf-m', 1533, '75', 53, 'IU', 190, 'Half Injection Subcutaneously Three Times A Week', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:29:06', '2020-10-07 08:29:06'),
(2383, 'Janumet', NULL, 'janumet', 1652, '50/500', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:06', '2020-10-07 08:29:06'),
(2384, 'Januvia', NULL, 'januvia', 1518, '100', 41, 'MG', 118, 'One Tablet In The Morning Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:06', '2020-10-07 08:29:06'),
(2386, 'Kempro', NULL, 'kempro', 1476, '5', 41, 'MG', 191, 'Half Tablet Twice A Day After Meals', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:06', '2020-10-07 08:29:06'),
(2387, 'Kenacomb', NULL, 'kenacomb', 1475, '10', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:06', '2020-10-07 08:29:06'),
(2389, 'Kenacomb Otic', NULL, 'kenacomb-otic', 1475, '10', 41, 'MG', 134, 'One Drop Twice Daily', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:06', '2020-10-07 08:29:06'),
(2391, 'Kenacort', NULL, 'kenacort', 1502, '40', 41, 'MG', 134, 'One Drop Twice Daily', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:07', '2020-10-07 08:29:07'),
(2392, 'Kenalog', NULL, 'kenalog', 1665, '0.1 % (percent)', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:07', '2020-10-07 08:29:07'),
(2394, 'Klaricid', NULL, 'klaricid', 1570, '500', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 8, '5 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:29:07', '2020-10-07 08:29:07'),
(2395, 'Kleen Enema', NULL, 'kleen-enema', 1666, '19.2 / 7.2 / 4.5', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 4, 'Ongoing', 19, 'Constipation', 1, NULL, '2020-10-07 08:29:07', '2020-10-07 08:29:07'),
(2398, 'Lamictal', NULL, 'lamictal', 1474, '50', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 19, 'Constipation', 1, NULL, '2020-10-07 08:29:07', '2020-10-07 08:29:07'),
(2400, 'Lamisil', NULL, 'lamisil', 1479, '250', 41, 'MG', 96, 'One Tablet In The Morning', 13, '3 Months', 19, 'Constipation', 1, NULL, '2020-10-07 08:29:07', '2020-10-07 08:29:07'),
(2401, 'Lamisil - Spray / Cream', NULL, 'lamisil-spray-cream', 1667, '1 % (percent)', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 19, 'Constipation', 1, NULL, '2020-10-07 08:29:07', '2020-10-07 08:29:07'),
(2402, 'Lancets For Checking Glucose', NULL, 'lancets-for-checking-glucose', 1667, '1 % (percent)', 56, '-100', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 19, 'Constipation', 1, NULL, '2020-10-07 08:29:07', '2020-10-07 08:29:07'),
(2404, 'Lanoxin', NULL, 'lanoxin', 1591, '250 Mcg', 46, 'MCG', 101, 'One Tablet Daily', 4, 'Ongoing', 19, 'Constipation', 1, NULL, '2020-10-07 08:29:07', '2020-10-07 08:29:07'),
(2405, 'Lantigen B', NULL, 'lantigen-b', 1591, '250 Mcg', 46, 'MCG', 188, 'Ongoing', 4, 'Ongoing', 19, 'Constipation', 1, NULL, '2020-10-07 08:29:07', '2020-10-07 08:29:07'),
(2439, 'Lantus Solostar', NULL, 'lantus-solostar', 1515, '70', 44, 'Units', 145, 'In The Evening', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:10', '2020-10-07 08:29:10'),
(2441, 'Largactil', NULL, 'largactil', 1474, '50', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:10', '2020-10-07 08:29:10'),
(2443, 'Lasix', NULL, 'lasix', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:10', '2020-10-07 08:29:10'),
(2444, 'Lasoride', NULL, 'lasoride', 1668, '40 / 5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:10', '2020-10-07 08:29:10'),
(2447, 'Lastolip', NULL, 'lastolip', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:10', '2020-10-07 08:29:10'),
(2449, 'Lederplex', NULL, 'lederplex', 1606, 'No Dose Mentioned', 41, 'MG', 179, 'One Tablespoon In The Morning', 4, 'Ongoing', 55, 'Vitamin', 1, NULL, '2020-10-07 08:29:10', '2020-10-07 08:29:10'),
(2451, 'Lefora', NULL, 'lefora', 1473, '20', 41, 'MG', 116, '5 Tablets Once Daily For 3 Days', 4, 'Ongoing', 10, 'Arthritis', 1, NULL, '2020-10-07 08:29:10', '2020-10-07 08:29:10'),
(2452, 'Leradip', NULL, 'leradip', 1475, '10', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 10, 'Arthritis', 1, NULL, '2020-10-07 08:29:10', '2020-10-07 08:29:10'),
(2487, 'Levemir Insulin Pen', NULL, 'levemir-insulin-pen', 1515, '70', 44, 'Units', 145, 'In The Evening', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:12', '2020-10-07 08:29:12'),
(2489, 'Levocil', NULL, 'levocil', 1570, '500', 41, 'MG', 96, 'One Tablet In The Morning', 6, '7 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:29:12', '2020-10-07 08:29:12'),
(2494, 'Levothyroxine (almus)', NULL, 'levothyroxine-almus', 1474, '50', 46, 'MCG', 193, 'One And Half Tablets In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 4, 'Ongoing', 47, 'Thyroid', 1, NULL, '2020-10-07 08:29:12', '2020-10-07 08:29:12'),
(2495, 'Levothyroxine (merck)', NULL, 'levothyroxine-merck', 1521, '150', 46, 'MCG', 175, 'One Tablet In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 4, 'Ongoing', 47, 'Thyroid', 1, NULL, '2020-10-07 08:29:12', '2020-10-07 08:29:12'),
(2501, 'Lexotanil', NULL, 'lexotanil', 1524, '3', 41, 'MG', 112, 'One Tablet At Bedtime', 5, 'As Needed', 47, 'Thyroid', 1, NULL, '2020-10-07 08:29:13', '2020-10-07 08:29:13'),
(2502, 'Librax', NULL, 'librax', 1669, 'Tab', 41, 'MG', 157, 'One Tablet Before Breakfast And Dinner', 4, 'Ongoing', 47, 'Thyroid', 1, NULL, '2020-10-07 08:29:13', '2020-10-07 08:29:13'),
(2503, 'Lilac', NULL, 'lilac', 1670, '3.35', 41, 'MG', 116, '5 Tablets Once Daily For 3 Days', 4, 'Ongoing', 19, 'Constipation', 1, NULL, '2020-10-07 08:29:13', '2020-10-07 08:29:13'),
(2506, 'Lipiget', NULL, 'lipiget', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:13', '2020-10-07 08:29:13'),
(2507, 'Lipiget Ez', NULL, 'lipiget-ez', 1671, '10-oct', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:13', '2020-10-07 08:29:13'),
(2510, 'Lipirex', NULL, 'lipirex', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:13', '2020-10-07 08:29:13'),
(2513, 'Lipitor', NULL, 'lipitor', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:13', '2020-10-07 08:29:13'),
(2515, 'Listerine', NULL, 'listerine', 1672, '65', 41, 'MG', 131, 'Gargle Twice Daily', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:13', '2020-10-07 08:29:13'),
(2518, 'Loprin', NULL, 'loprin', 1533, '75', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:29:13', '2020-10-07 08:29:13'),
(2519, 'Lowplat', NULL, 'lowplat', 1533, '75', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:29:14', '2020-10-07 08:29:14'),
(2520, 'Lowplat Plus', NULL, 'lowplat-plus', 1639, '75/75', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:29:14', '2020-10-07 08:29:14'),
(2522, 'Lucrin', NULL, 'lucrin', 1674, '3.75', 41, 'MG', 194, 'One Injection Intramuscularly Every Month', 4, 'Ongoing', 44, 'Prostate', 1, NULL, '2020-10-07 08:29:14', '2020-10-07 08:29:14'),
(2523, 'Lucrin Depot', NULL, 'lucrin-depot', 1674, '3.75', 43, 'ML', 195, 'One Injection Subcutaneously Every Month', 4, 'Ongoing', 44, 'Prostate', 1, NULL, '2020-10-07 08:29:14', '2020-10-07 08:29:14'),
(2525, 'M.com', NULL, 'mcom', 1675, '7.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:14', '2020-10-07 08:29:14'),
(2530, 'Maltofer Fol', NULL, 'maltofer-fol', 1474, '50', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 5, 'Anemia', 1, NULL, '2020-10-07 08:29:14', '2020-10-07 08:29:14'),
(2531, 'Medigesic', NULL, 'medigesic', 1678, '35 / 450', 41, 'MG', 119, '2 Tablets Thrice A Day', 5, 'As Needed', 40, 'Pain', 1, NULL, '2020-10-07 08:29:14', '2020-10-07 08:29:14'),
(2532, 'Medigesic Forte', NULL, 'medigesic-forte', 1679, '50/450/30', 41, 'MG', 119, '2 Tablets Thrice A Day', 5, 'As Needed', 40, 'Pain', 1, NULL, '2020-10-07 08:29:14', '2020-10-07 08:29:14'),
(2535, 'Megace', NULL, 'megace', 1542, '160', 41, 'MG', 197, '5 Tablets In The Morning', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:14', '2020-10-07 08:29:14'),
(2538, 'Melleril', NULL, 'melleril', 1518, '100', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:14', '2020-10-07 08:29:14'),
(2539, 'Meningococcal A+c', NULL, 'meningococcal-ac', 1474, '50', 43, 'ML', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 48, 'To Prevent Meningitis', 1, NULL, '2020-10-07 08:29:14', '2020-10-07 08:29:14'),
(2540, 'Mepresor', NULL, 'mepresor', 1518, '100', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:14', '2020-10-07 08:29:14'),
(2541, 'Mepresor Sr', NULL, 'mepresor-sr', 1478, '200', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:14', '2020-10-07 08:29:14'),
(2543, 'Meronem', NULL, 'meronem', 1570, '500', 43, 'ML', 110, 'One Injection Twice A Day', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:14', '2020-10-07 08:29:14'),
(2546, 'Metformina', NULL, 'metformina', 1654, '850', 41, 'MG', 166, 'One Tablet Twice A Day Before Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:15', '2020-10-07 08:29:15'),
(2548, 'Micardis', NULL, 'micardis', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:15', '2020-10-07 08:29:15'),
(2550, 'Micardis Plus', NULL, 'micardis-plus', 1594, '80/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:15', '2020-10-07 08:29:15'),
(2551, 'Miconaz', NULL, 'miconaz', 1608, '2 % (percent)', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:15', '2020-10-07 08:29:15'),
(2553, 'Minipress', NULL, 'minipress', 1472, '1', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:15', '2020-10-07 08:29:15'),
(2555, 'Minirin', NULL, 'minirin', 1478, '200', 46, 'MCG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:15', '2020-10-07 08:29:15'),
(2556, 'Minoxin', NULL, 'minoxin', 1608, '2 % (percent)', 46, 'MCG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:15', '2020-10-07 08:29:15'),
(2557, 'Mirena', NULL, 'mirena', 1507, '52', 46, 'MCG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:15', '2020-10-07 08:29:15'),
(2559, 'Mirtazep', NULL, 'mirtazep', 1497, '30', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:15', '2020-10-07 08:29:15'),
(2561, 'Misar', NULL, 'misar', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:15', '2020-10-07 08:29:15'),
(2562, 'Misar-am', NULL, 'misar-am', 1680, '40/5', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:15', '2020-10-07 08:29:15'),
(2563, 'Misar-h', NULL, 'misar-h', 1601, '40/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:15', '2020-10-07 08:29:15'),
(2569, 'Mixtard 70/30 Insulin', NULL, 'mixtard-7030-insulin', 1474, '50', 43, 'ML', 109, 'Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:16', '2020-10-07 08:29:16'),
(2572, 'Modlip', NULL, 'modlip', 1502, '40', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:16', '2020-10-07 08:29:16'),
(2574, 'Modlip Z', NULL, 'modlip-z', 1576, '20-oct', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:16', '2020-10-07 08:29:16'),
(2575, 'Motilium', NULL, 'motilium', 1475, '10', 41, 'MG', 157, 'One Tablet Before Breakfast And Dinner', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:16', '2020-10-07 08:29:16'),
(2576, 'Movax', NULL, 'movax', 1475, '10', 41, 'MG', 97, 'One Tablet Twice A Day', 5, 'As Needed', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:16', '2020-10-07 08:29:16'),
(2577, 'Mucaine', NULL, 'mucaine', 1620, '120 Ml', 41, 'MG', 168, '2 Teaspoons Twice A Day After Meal', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:29:16', '2020-10-07 08:29:16'),
(2578, 'Muscoril', NULL, 'muscoril', 1486, '4', 41, 'MG', 199, '2 Capsules Thrice A Day With Meals', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:16', '2020-10-07 08:29:16'),
(2581, 'Mypro', NULL, 'mypro', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:16', '2020-10-07 08:29:16'),
(2583, 'Myrin', NULL, 'myrin', 1682, '150/75/300', 41, 'MG', 200, '3 Tablets In The Morning', 4, 'Ongoing', 52, 'Tuberculosis', 1, NULL, '2020-10-07 08:29:16', '2020-10-07 08:29:16'),
(2584, 'Myrin P', NULL, 'myrin-p', 1681, '225 / 120 / 60 / 300', 41, 'MG', 200, '3 Tablets In The Morning', 4, 'Ongoing', 52, 'Tuberculosis', 1, NULL, '2020-10-07 08:29:16', '2020-10-07 08:29:16'),
(2585, 'Myrin-p', NULL, 'myrin-p', 1683, '120/60/225/300', 41, 'MG', 200, '3 Tablets In The Morning', 4, 'Ongoing', 52, 'Tuberculosis', 1, NULL, '2020-10-07 08:29:16', '2020-10-07 08:29:16'),
(2586, 'Myrin-p Fort', NULL, 'myrin-p-fort', 1684, '150/75/275/400', 41, 'MG', 200, '3 Tablets In The Morning', 4, 'Ongoing', 52, 'Tuberculosis', 1, NULL, '2020-10-07 08:29:16', '2020-10-07 08:29:16'),
(2587, 'Myrin-p Forte', NULL, 'myrin-p-forte', 1685, '275 / 150 / 75 / 400', 41, 'MG', 200, '3 Tablets In The Morning', 4, 'Ongoing', 52, 'Tuberculosis', 1, NULL, '2020-10-07 08:29:16', '2020-10-07 08:29:16'),
(2590, 'Myteka', NULL, 'myteka', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 11, 'Asthma', 1, NULL, '2020-10-07 08:29:16', '2020-10-07 08:29:16'),
(2591, 'Nasacort Aq', NULL, 'nasacort-aq', 1686, '55mcg/dose', 46, 'MCG', 201, 'One Squirt In Each Nostril Twice A Day', 4, 'Ongoing', 11, 'Asthma', 1, NULL, '2020-10-07 08:29:16', '2020-10-07 08:29:16'),
(2592, 'Nasarin', NULL, 'nasarin', 1686, '55mcg/dose', 57, '55mcg/actu', 202, 'One Squirt In Each Nostril In The Evening', 4, 'Ongoing', 11, 'Asthma', 1, NULL, '2020-10-07 08:29:17', '2020-10-07 08:29:17'),
(2593, 'Natrilix', NULL, 'natrilix', 1686, '55mcg/dose', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 11, 'Asthma', 1, NULL, '2020-10-07 08:29:17', '2020-10-07 08:29:17'),
(2594, 'Natrilix Sr', NULL, 'natrilix-sr', 1686, '55mcg/dose', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:17', '2020-10-07 08:29:17'),
(2596, 'Nebil', NULL, 'nebil', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:17', '2020-10-07 08:29:17'),
(2598, 'Nebix', NULL, 'nebix', 1688, '5 Mg', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:17', '2020-10-07 08:29:17'),
(2602, 'Neodipar', NULL, 'neodipar', 1654, '850', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:17', '2020-10-07 08:29:17'),
(2603, 'Neomerkazole', NULL, 'neomerkazole', 1476, '5', 41, 'MG', 148, '2 Tablets Twice A Day', 4, 'Ongoing', 47, 'Thyroid', 1, NULL, '2020-10-07 08:29:17', '2020-10-07 08:29:17'),
(2605, 'Nexum', NULL, 'nexum', 1502, '40', 41, 'MG', 165, 'One Capsule In The Morning Before Breakfast', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:29:17', '2020-10-07 08:29:17'),
(2608, 'Nilstat', NULL, 'nilstat', 1472, '1', 43, 'ML', 134, 'One Drop Twice Daily', 8, '5 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:29:17', '2020-10-07 08:29:17'),
(2609, 'Nilstat - Oint', NULL, 'nilstat-oint', 1518, '100', 43, 'ML', 203, '000 Iu', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:17', '2020-10-07 08:29:17'),
(2610, 'Nilstat - Vag Tab', NULL, 'nilstat-vag-tab', 1518, '100', 43, 'ML', 203, '000 Iu', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:17', '2020-10-07 08:29:17'),
(2611, 'Nizoral', NULL, 'nizoral', 1478, '200', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:17', '2020-10-07 08:29:17'),
(2612, 'Nizoral - Cream / Gel', NULL, 'nizoral-cream-gel', 1608, '2 % (percent)', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:17', '2020-10-07 08:29:17'),
(2613, 'No-clot', NULL, 'no-clot', 1533, '75', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:29:17', '2020-10-07 08:29:17'),
(2614, 'No-clot Ea', NULL, 'no-clot-ea', 1639, '75/75', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:29:18', '2020-10-07 08:29:18'),
(2615, 'Nordette 28', NULL, 'nordette-28', 1634, '0.15 / 0.03', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:29:18', '2020-10-07 08:29:18'),
(2644, 'Nordilet Pen', NULL, 'nordilet-pen', 1697, '9', 58, 'Clicks', 204, 'Inject Subcutaneously Daily In The Evening', 4, 'Ongoing', 29, 'Height', 1, NULL, '2020-10-07 08:29:19', '2020-10-07 08:29:19'),
(2645, 'Norplat', NULL, 'norplat', 1533, '75', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:29:19', '2020-10-07 08:29:19'),
(2646, 'Norplat-s', NULL, 'norplat-s', 1639, '75/75', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:29:19', '2020-10-07 08:29:19'),
(2648, 'Norvasc', NULL, 'norvasc', 1476, '5', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:19', '2020-10-07 08:29:19'),
(2649, 'No-spa', NULL, 'no-spa', 1502, '40', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:19', '2020-10-07 08:29:19'),
(2650, 'Nospa-forte', NULL, 'nospa-forte', 1502, '40', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 15, '3 Days', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:20', '2020-10-07 08:29:20'),
(2651, 'Nova', NULL, 'nova', 1698, '0.15 / 0.03 / 7', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:20', '2020-10-07 08:29:20'),
(2652, 'Nova - Ject', NULL, 'nova-ject', 1478, '200', 43, 'ML', 153, 'One Tablet Twice A Day After Meals', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:20', '2020-10-07 08:29:20'),
(2653, 'Nova Ed Pills', NULL, 'nova-ed-pills', 1698, '0.15 / 0.03 / 7', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:20', '2020-10-07 08:29:20'),
(2654, 'Novapressin', NULL, 'novapressin', 1472, '1', 43, 'ML', 105, 'One Injection', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:20', '2020-10-07 08:29:20'),
(2678, 'Novomix 30', NULL, 'novomix-30', 1503, '42', 44, 'Units', 109, 'Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:21', '2020-10-07 08:29:21'),
(2700, 'Novomix 50', NULL, 'novomix-50', 1505, '46', 44, 'Units', 109, 'Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:22', '2020-10-07 08:29:22'),
(2741, 'Novorapid Insulin Pen', NULL, 'novorapid-insulin-pen', 1515, '70', 44, 'Units', 109, 'Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:25', '2020-10-07 08:29:25'),
(2742, 'Nuberol', NULL, 'nuberol', 1515, '70', 41, 'MG', 207, 'One Tablet Twice A Day For Pain', 5, 'As Needed', 40, 'Pain', 1, NULL, '2020-10-07 08:29:25', '2020-10-07 08:29:25'),
(2743, 'Nuberol - Forte', NULL, 'nuberol-forte', 1515, '70', 41, 'MG', 207, 'One Tablet Twice A Day For Pain', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:25', '2020-10-07 08:29:25'),
(2744, 'Olbetam', NULL, 'olbetam', 1479, '250', 41, 'MG', 147, 'One Capsule In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:25', '2020-10-07 08:29:25'),
(2746, 'Olesta', NULL, 'olesta', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:25', '2020-10-07 08:29:25'),
(2749, 'Omnitor', NULL, 'omnitor', 1476, '5', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:25', '2020-10-07 08:29:25'),
(2751, 'Omsana', NULL, 'omsana', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:25', '2020-10-07 08:29:25'),
(2753, 'Omsana Diu', NULL, 'omsana-diu', 1601, '40/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:25', '2020-10-07 08:29:25'),
(2756, 'One-alpha', NULL, 'one-alpha', 1483, '0.5', 46, 'MCG', 140, '2 Tablets In The Evening', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:29:26', '2020-10-07 08:29:26'),
(2757, 'Optilets-m', NULL, 'optilets-m', 1483, '0.5', 46, 'MCG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:29:26', '2020-10-07 08:29:26'),
(2758, 'Optoflox', NULL, 'optoflox', 1700, '0.3 % (percent)', 46, 'MCG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:29:26', '2020-10-07 08:29:26'),
(2759, 'Optopred', NULL, 'optopred', 1667, '1 % (percent)', 46, 'MCG', 134, 'One Drop Twice Daily', 4, 'Ongoing', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:29:26', '2020-10-07 08:29:26'),
(2760, 'Optra', NULL, 'optra', 1667, '1 % (percent)', 46, 'MCG', 125, '2 Puffs Four Times A Day', 5, 'As Needed', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:29:26', '2020-10-07 08:29:26'),
(2761, 'Orslim', NULL, 'orslim', 1540, '120', 41, 'MG', 208, 'One Capsule Thrice A Day Before Each Meal', 4, 'Ongoing', 57, 'Weight', 1, NULL, '2020-10-07 08:29:26', '2020-10-07 08:29:26'),
(2762, 'Osnate 800', NULL, 'osnate-800', 1701, '800', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:29:26', '2020-10-07 08:29:26'),
(2763, 'Ossobon-d', NULL, 'ossobon-d', 1701, '800', 59, '250/400 mg/5mL', 196, 'One Tablespoon At Bedtime', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:29:26', '2020-10-07 08:29:26'),
(2764, 'Osteokare', NULL, 'osteokare', 1570, '500', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:29:26', '2020-10-07 08:29:26'),
(2765, 'Osteokare Plus', NULL, 'osteokare-plus', 1702, '500 / 400', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:29:26', '2020-10-07 08:29:26'),
(2766, 'Ovafin', NULL, 'ovafin', 1474, '50', 41, 'MG', 96, 'One Tablet In The Morning', 8, '5 Days', 17, 'Calcium', 1, NULL, '2020-10-07 08:29:26', '2020-10-07 08:29:26'),
(2767, 'Ovestin', NULL, 'ovestin', 1474, '50', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:29:26', '2020-10-07 08:29:26'),
(2768, 'Ovi-f', NULL, 'ovi-f', 1474, '50', 41, 'MG', 96, 'One Tablet In The Morning', 8, '5 Days', 17, 'Calcium', 1, NULL, '2020-10-07 08:29:26', '2020-10-07 08:29:26'),
(2769, 'Ovlogyn', NULL, 'ovlogyn', 1476, '5', 43, 'ML', 96, 'One Tablet In The Morning', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:29:26', '2020-10-07 08:29:26'),
(2770, 'Ox-600', NULL, 'ox-600', 1562, '600', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:29:26', '2020-10-07 08:29:26'),
(2773, 'Oxidil', NULL, 'oxidil', 1570, '500', 43, 'ML', 110, 'One Injection Twice A Day', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:27', '2020-10-07 08:29:27'),
(2774, 'Oxil', NULL, 'oxil', 1478, '200', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:27', '2020-10-07 08:29:27'),
(2775, 'Oxitrin', NULL, 'oxitrin', 1476, '5', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:27', '2020-10-07 08:29:27'),
(2776, 'Panadol 6 Plus', NULL, 'panadol-6-plus', 1478, '200', 41, 'MG', 181, 'One Teaspoon Thrice A Day After Meal', 5, 'As Needed', 189, 'Fever', 1, NULL, '2020-10-07 08:29:27', '2020-10-07 08:29:27'),
(2778, 'Panadol', NULL, 'panadol', 1570, '500', 41, 'MG', 119, '2 Tablets Thrice A Day', 5, 'As Needed', 40, 'Pain', 1, NULL, '2020-10-07 08:29:27', '2020-10-07 08:29:27'),
(2779, 'Panadol Cf', NULL, 'panadol-cf', 1703, '500 / 60 / 4', 41, 'MG', 209, 'One Capsule Twice A Day After Meal', 4, 'Ongoing', 189, 'Fever', 1, NULL, '2020-10-07 08:29:27', '2020-10-07 08:29:27'),
(2780, 'Panadol Extra', NULL, 'panadol-extra', 1571, '500 / 65', 41, 'MG', 108, 'One Tablet Thrice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:27', '2020-10-07 08:29:27'),
(2781, 'Pedialyte', NULL, 'pedialyte', 1704, '1.75 / 1.45 / 0.75 / 10', 41, 'MG', 108, 'One Tablet Thrice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:27', '2020-10-07 08:29:27'),
(2782, 'Pediasure', NULL, 'pediasure', 1704, '1.75 / 1.45 / 0.75 / 10', 41, 'MG', 176, 'Mix 5 Tablespoons In One Glass Of Water And Drink Three Times A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:27', '2020-10-07 08:29:27'),
(2783, 'Piriton Expectorant Syrup', NULL, 'piriton-expectorant-syrup', 1472, '1', 41, 'MG', 100, 'One Tablespoon Twice A Day', 5, 'As Needed', 20, 'Cough', 1, NULL, '2020-10-07 08:29:27', '2020-10-07 08:29:27'),
(2785, 'Pitalo', NULL, 'pitalo', 1706, '1mg', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:27', '2020-10-07 08:29:27'),
(2786, 'Plavix', NULL, 'plavix', 1533, '75', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:29:27', '2020-10-07 08:29:27'),
(2787, 'Poliio Oral Vaccine - Amson', NULL, 'poliio-oral-vaccine-amson', 1483, '0.5', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 50, 'To Prevent Polio', 1, NULL, '2020-10-07 08:29:27', '2020-10-07 08:29:27'),
(2788, 'Poliio Oral Vaccine - Sanofi-pasteur', NULL, 'poliio-oral-vaccine-sanofi-pasteur', 1483, '0.5', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 50, 'To Prevent Polio', 1, NULL, '2020-10-07 08:29:27', '2020-10-07 08:29:27'),
(2789, 'Polyfax', NULL, 'polyfax', 1616, '10000 / 500 Potency_unit', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:27', '2020-10-07 08:29:27'),
(2790, 'Polyfax - Skin Oint', NULL, 'polyfax-skin-oint', 1616, '10000 / 500 Potency_unit', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:28', '2020-10-07 08:29:28'),
(2795, 'Premarin', NULL, 'premarin', 1708, '1.25', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:28', '2020-10-07 08:29:28'),
(2797, 'Premarin Vaginal', NULL, 'premarin-vaginal', 1582, '6.25', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:28', '2020-10-07 08:29:28'),
(2798, 'Prepidil', NULL, 'prepidil', 1524, '3', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:28', '2020-10-07 08:29:28'),
(2799, 'Primolut N', NULL, 'primolut-n', 1476, '5', 41, 'MG', 210, 'One Tablet Thrice A Day 3 Days Before Expected Onset Of Menses', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:28', '2020-10-07 08:29:28'),
(2800, 'Primovate', NULL, 'primovate', 1709, '0.05 % (percent)', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:28', '2020-10-07 08:29:28'),
(2801, 'Priorix', NULL, 'priorix', 1710, 'Vaccine', 41, 'MG', 188, 'Ongoing', 14, 'Ml', 33, 'Infection', 1, NULL, '2020-10-07 08:29:28', '2020-10-07 08:29:28'),
(2802, 'Proglyuton', NULL, 'proglyuton', 1711, '2/0.5', 41, 'MG', 188, 'Ongoing', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:28', '2020-10-07 08:29:28'),
(2803, 'Progynon Depot', NULL, 'progynon-depot', 1606, 'No Dose Mentioned', 43, 'ML', 188, 'Ongoing', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:28', '2020-10-07 08:29:28'),
(2806, 'Progynova', NULL, 'progynova', 1472, '1', 41, 'MG', 188, 'Ongoing', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:29', '2020-10-07 08:29:29'),
(2807, 'Proluton Depot', NULL, 'proluton-depot', 1479, '250', 43, 'ML', 188, 'Ongoing', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:29', '2020-10-07 08:29:29'),
(2808, 'Propylthiouracil', NULL, 'propylthiouracil', 1474, '50', 41, 'MG', 108, 'One Tablet Thrice A Day', 4, 'Ongoing', 47, 'Thyroid', 1, NULL, '2020-10-07 08:29:29', '2020-10-07 08:29:29'),
(2811, 'Proscar', NULL, 'proscar', 1476, '5', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 44, 'Prostate', 1, NULL, '2020-10-07 08:29:29', '2020-10-07 08:29:29'),
(2813, 'Prothiaden', NULL, 'prothiaden', 1533, '75', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 44, 'Prostate', 1, NULL, '2020-10-07 08:29:29', '2020-10-07 08:29:29'),
(2814, 'Protonix', NULL, 'protonix', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:29:29', '2020-10-07 08:29:29'),
(2815, 'Provate', NULL, 'provate', 1712, '0.5 % (percent)', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:29:29', '2020-10-07 08:29:29'),
(2816, 'Provate-g', NULL, 'provate-g', 1713, '0.1 / 0.05 % (percent)', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:29:29', '2020-10-07 08:29:29'),
(2817, 'Provate-s', NULL, 'provate-s', 1713, '0.1 / 0.05 % (percent)', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:29:29', '2020-10-07 08:29:29'),
(2819, 'Prozac', NULL, 'prozac', 1477, '60', 41, 'MG', 211, 'One Capsule Daily', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:29:30', '2020-10-07 08:29:30'),
(2822, 'Pulmicort', NULL, 'pulmicort', 1715, '50 Mcg', 41, 'MG', 212, 'One Puff Twice A Day', 4, 'Ongoing', 11, 'Asthma', 1, NULL, '2020-10-07 08:29:30', '2020-10-07 08:29:30'),
(2823, 'Qalsan', NULL, 'qalsan', 1716, '1250', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:29:30', '2020-10-07 08:29:30'),
(2824, 'Qalsan-d', NULL, 'qalsan-d', 1716, '1250', 60, 'MG/IU', 153, 'One Tablet Twice A Day After Meals', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:29:31', '2020-10-07 08:29:31'),
(2828, 'Quadrimeningo', NULL, 'quadrimeningo', 1717, '0.5 Ml', 43, 'ML', 106, 'One Injection Subcutaneously', 4, 'Ongoing', 48, 'To Prevent Meningitis', 1, NULL, '2020-10-07 08:29:31', '2020-10-07 08:29:31'),
(2830, 'Quartz', NULL, 'quartz', 1488, '8', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:31', '2020-10-07 08:29:31'),
(2834, 'Quash', NULL, 'quash', 1570, '500', 41, 'MG', 213, 'In The Morning ><  7 Days', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:31', '2020-10-07 08:29:31'),
(2837, 'Ranker', NULL, 'ranker', 1570, '500', 41, 'MG', 96, 'One Tablet In The Morning', 6, '7 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:29:31', '2020-10-07 08:29:31'),
(2838, 'Raptrol', NULL, 'raptrol', 1472, '1', 41, 'MG', 206, 'Half Tablet Thrice A Day Before Each Meal', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:31', '2020-10-07 08:29:31'),
(2839, 'Rashnil', NULL, 'rashnil', 1665, '0.1 % (percent)', 41, 'MG', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:31', '2020-10-07 08:29:31'),
(2842, 'Renitec', NULL, 'renitec', 1476, '5', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:31', '2020-10-07 08:29:31'),
(2843, 'Revitale-b', NULL, 'revitale-b', 1476, '5', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:29:31', '2020-10-07 08:29:31'),
(2844, 'Revitale-m', NULL, 'revitale-m', 1476, '5', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:29:32', '2020-10-07 08:29:32'),
(2846, 'Rimstar', NULL, 'rimstar', 1684, '150/75/275/400', 41, 'MG', 200, '3 Tablets In The Morning', 4, 'Ongoing', 52, 'Tuberculosis', 1, NULL, '2020-10-07 08:29:32', '2020-10-07 08:29:32'),
(2848, 'Risek', NULL, 'risek', 1502, '40', 41, 'MG', 165, 'One Capsule In The Morning Before Breakfast', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:29:32', '2020-10-07 08:29:32'),
(2852, 'Risp', NULL, 'risp', 1486, '4', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:29:32', '2020-10-07 08:29:32'),
(2856, 'Risperdal', NULL, 'risperdal', 1486, '4', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:29:32', '2020-10-07 08:29:32');
INSERT INTO `medications` (`id`, `title`, `generic_name`, `slug`, `dose_id`, `dose`, `unit_id`, `unit`, `frequency_id`, `frequency`, `duration_id`, `duration`, `diagnosis_type_id`, `diagnosis_type`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2859, 'Rivaxo', NULL, 'rivaxo', 1473, '20', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:29:32', '2020-10-07 08:29:32'),
(2862, 'Roaccutane', NULL, 'roaccutane', 1475, '10', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 3, 'Acne', 1, NULL, '2020-10-07 08:29:33', '2020-10-07 08:29:33'),
(2865, 'Rocaltrol', NULL, 'rocaltrol', 1632, '0.5 Mcg', 41, 'MG', 147, 'One Capsule In The Morning', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:29:33', '2020-10-07 08:29:33'),
(2869, 'Rocephin', NULL, 'rocephin', 1570, '500', 43, 'ML', 110, 'One Injection Twice A Day', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:33', '2020-10-07 08:29:33'),
(2871, 'Rolip', NULL, 'rolip', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:33', '2020-10-07 08:29:33'),
(2873, 'Rosulin', NULL, 'rosulin', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:33', '2020-10-07 08:29:33'),
(2876, 'Rovista', NULL, 'rovista', 1476, '5', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:33', '2020-10-07 08:29:33'),
(2877, 'Samerol-n', NULL, 'samerol-n', 1678, '35 / 450', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:33', '2020-10-07 08:29:33'),
(2880, 'Sandimmun', NULL, 'sandimmun', 1518, '100', 41, 'MG', 174, 'Half Tablet Twice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:33', '2020-10-07 08:29:33'),
(2885, 'Sandostatin', NULL, 'sandostatin', 1473, '20', 41, 'MG', 174, 'Half Tablet Twice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:34', '2020-10-07 08:29:34'),
(2886, 'Sandostatin Lar', NULL, 'sandostatin-lar', 1473, '20', 43, 'ML', 214, 'Deep Intramuscular Injection Once A Month', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:34', '2020-10-07 08:29:34'),
(2887, 'Sangobion', NULL, 'sangobion', 1472, '1', 41, 'MG', 215, 'One Capsule With Lunch And Dinner', 4, 'Ongoing', 5, 'Anemia', 1, NULL, '2020-10-07 08:29:34', '2020-10-07 08:29:34'),
(2888, 'Secure', NULL, 'secure', 1471, '400', 41, 'MG', 211, 'One Capsule Daily', 6, '7 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:29:34', '2020-10-07 08:29:34'),
(2889, 'Selanz Sr', NULL, 'selanz-sr', 1497, '30', 41, 'MG', 165, 'One Capsule In The Morning Before Breakfast', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:29:34', '2020-10-07 08:29:34'),
(2891, 'Seleco', NULL, 'seleco', 1478, '200', 41, 'MG', 216, 'Once A Day As Needed For Pain; Take It With Food', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:34', '2020-10-07 08:29:34'),
(2892, 'Sensipar', NULL, 'sensipar', 1497, '30', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:34', '2020-10-07 08:29:34'),
(2894, 'Sensival', NULL, 'sensival', 1533, '75', 41, 'MG', 174, 'Half Tablet Twice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:34', '2020-10-07 08:29:34'),
(2896, 'Serc', NULL, 'serc', 1488, '8', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 16, '2 Weeks', 24, 'Dizziness', 1, NULL, '2020-10-07 08:29:34', '2020-10-07 08:29:34'),
(2899, 'Seretide Evohaler', NULL, 'seretide-evohaler', 1722, '25 / 50 Dose', 41, 'MG', 212, 'One Puff Twice A Day', 4, 'Ongoing', 11, 'Asthma', 1, NULL, '2020-10-07 08:29:34', '2020-10-07 08:29:34'),
(2901, 'Seroquel', NULL, 'seroquel', 1518, '100', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 11, 'Asthma', 1, NULL, '2020-10-07 08:29:34', '2020-10-07 08:29:34'),
(2902, 'Seroxat', NULL, 'seroxat', 1473, '20', 41, 'MG', 211, 'One Capsule Daily', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:29:35', '2020-10-07 08:29:35'),
(2904, 'Seroxat Cr', NULL, 'seroxat-cr', 1581, '12.5', 41, 'MG', 211, 'One Capsule Daily', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:29:35', '2020-10-07 08:29:35'),
(2905, 'Sinemet', NULL, 'sinemet', 1723, '250 / 25', 41, 'MG', 174, 'Half Tablet Twice A Day', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:29:35', '2020-10-07 08:29:35'),
(2908, 'Singulair', NULL, 'singulair', 1476, '5', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 11, 'Asthma', 1, NULL, '2020-10-07 08:29:35', '2020-10-07 08:29:35'),
(2913, 'Sitaglu Met', NULL, 'sitaglu-met', 1652, '50/500', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:35', '2020-10-07 08:29:35'),
(2915, 'Sitaglumet', NULL, 'sitaglumet', 1652, '50/500', 41, 'MG', 120, 'One Tablet Twice A Day With Meals', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:35', '2020-10-07 08:29:35'),
(2917, 'Sitamet', NULL, 'sitamet', 1652, '50/500', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:35', '2020-10-07 08:29:35'),
(2918, 'Sivab', NULL, 'sivab', 1476, '5', 41, 'MG', 174, 'Half Tablet Twice A Day', 4, 'Ongoing', 42, 'Palpitations', 1, NULL, '2020-10-07 08:29:35', '2020-10-07 08:29:35'),
(2919, 'Sixvit', NULL, 'sixvit', 1474, '50', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 55, 'Vitamin', 1, NULL, '2020-10-07 08:29:35', '2020-10-07 08:29:35'),
(2922, 'Sizzle', NULL, 'sizzle', 1477, '60', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 4, 'Allergy', 1, NULL, '2020-10-07 08:29:36', '2020-10-07 08:29:36'),
(2924, 'Sofvasc', NULL, 'sofvasc', 1476, '5', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:36', '2020-10-07 08:29:36'),
(2929, 'Sofvasc Hct', NULL, 'sofvasc-hct', 1550, '5/160/25', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:36', '2020-10-07 08:29:36'),
(2932, 'Sofvasc-v', NULL, 'sofvasc-v', 1529, 'May-80', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:37', '2020-10-07 08:29:37'),
(2935, 'Solu-corrtef', NULL, 'solu-corrtef', 1570, '500', 43, 'ML', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:37', '2020-10-07 08:29:37'),
(2939, 'Solu-medrol', NULL, 'solu-medrol', 1570, '500', 43, 'ML', 217, 'One Injection Intravenously Once A Week For 6 Weeks', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:37', '2020-10-07 08:29:37'),
(2940, 'Somnia', NULL, 'somnia', 1475, '10', 41, 'MG', 218, 'Half Tablet At Bedtime', 5, 'As Needed', 34, 'Insomnia', 1, NULL, '2020-10-07 08:29:37', '2020-10-07 08:29:37'),
(2941, 'Somogel', NULL, 'somogel', 1724, '0.6/ 0.02 /0.02/0.1/33 %', 41, 'MG', 138, 'Apply To Affected Area Four-six Times A Day As Needed', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:29:37', '2020-10-07 08:29:37'),
(2943, 'Sovaldi', NULL, 'sovaldi', 1471, '400', 41, 'MG', 158, 'One Tablet In The Morning After Breakfast', 11, '6 Months', 30, 'Hepatitis', 1, NULL, '2020-10-07 08:29:37', '2020-10-07 08:29:37'),
(2947, 'Stamaril', NULL, 'stamaril', 1483, '0.5', 43, 'ML', 105, 'One Injection', 4, 'Ongoing', 54, 'Vaccine', 1, NULL, '2020-10-07 08:29:37', '2020-10-07 08:29:37'),
(2948, 'Starvits', NULL, 'starvits', 1483, '0.5', 43, 'ML', 113, 'One Tablet In The Evening', 4, 'Ongoing', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:29:37', '2020-10-07 08:29:37'),
(2950, 'Stemetil', NULL, 'stemetil', 1476, '5', 43, 'ML', 110, 'One Injection Twice A Day', 4, 'Ongoing', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:29:37', '2020-10-07 08:29:37'),
(2952, 'Stemetil - Tab / Inj', NULL, 'stemetil-tab-inj', 1476, '5', 43, 'ML', 110, 'One Injection Twice A Day', 4, 'Ongoing', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:29:38', '2020-10-07 08:29:38'),
(2953, 'Synflorix', NULL, 'synflorix', 1483, '0.5', 43, 'ML', 106, 'One Injection Subcutaneously', 10, 'Once', 49, 'To Prevent Pneumonia', 1, NULL, '2020-10-07 08:29:38', '2020-10-07 08:29:38'),
(2961, 'Synthroid', NULL, 'synthroid', 1729, '88', 46, 'MCG', 175, 'One Tablet In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 4, 'Ongoing', 47, 'Thyroid', 1, NULL, '2020-10-07 08:29:39', '2020-10-07 08:29:39'),
(2962, 'Syntocinon', NULL, 'syntocinon', 1476, '5', 43, 'ML', 175, 'One Tablet In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 4, 'Ongoing', 47, 'Thyroid', 1, NULL, '2020-10-07 08:29:39', '2020-10-07 08:29:39'),
(2964, 'Tagip', NULL, 'tagip', 1474, '50', 41, 'MG', 220, 'One Half Tablet In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:39', '2020-10-07 08:29:39'),
(2966, 'Tagipmet', NULL, 'tagipmet', 1652, '50/500', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:39', '2020-10-07 08:29:39'),
(2969, 'Tagipmet Xr', NULL, 'tagipmet-xr', 1652, '50/500', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:39', '2020-10-07 08:29:39'),
(2971, 'Tair', NULL, 'tair', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 11, 'Asthma', 1, NULL, '2020-10-07 08:29:39', '2020-10-07 08:29:39'),
(2974, 'Tasmi', NULL, 'tasmi', 1537, '80', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:39', '2020-10-07 08:29:39'),
(2977, 'Telfast', NULL, 'telfast', 1477, '60', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 4, 'Allergy', 1, NULL, '2020-10-07 08:29:40', '2020-10-07 08:29:40'),
(2978, 'Telfast D', NULL, 'telfast-d', 1731, '60 / 120', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 4, 'Allergy', 1, NULL, '2020-10-07 08:29:40', '2020-10-07 08:29:40'),
(2979, 'Telsan', NULL, 'telsan', 1473, '20', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:40', '2020-10-07 08:29:40'),
(2982, 'Telsarta', NULL, 'telsarta', 1537, '80', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:40', '2020-10-07 08:29:40'),
(2984, 'Telsarta-d', NULL, 'telsarta-d', 1594, '80/12.5', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:40', '2020-10-07 08:29:40'),
(2985, 'Tenofo-b', NULL, 'tenofo-b', 1534, '300', 41, 'MG', 118, 'One Tablet In The Morning Before Breakfast', 4, 'Ongoing', 30, 'Hepatitis', 1, NULL, '2020-10-07 08:29:40', '2020-10-07 08:29:40'),
(2986, 'Tenoret - 50', NULL, 'tenoret-50', 1732, '50 / 12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:40', '2020-10-07 08:29:40'),
(2989, 'Tenormin', NULL, 'tenormin', 1474, '50', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:40', '2020-10-07 08:29:40'),
(2990, 'Testoviron', NULL, 'testoviron', 1479, '250', 41, 'MG', 221, 'Half Injection Intramuscularly Once A Month', 11, '6 Months', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:40', '2020-10-07 08:29:40'),
(2995, 'Thyronorm', NULL, 'thyronorm', 1533, '75', 46, 'MCG', 175, 'One Tablet In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 4, 'Ongoing', 47, 'Thyroid', 1, NULL, '2020-10-07 08:29:41', '2020-10-07 08:29:41'),
(2997, 'Tofranil', NULL, 'tofranil', 1474, '50', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 47, 'Thyroid', 1, NULL, '2020-10-07 08:29:41', '2020-10-07 08:29:41'),
(2999, 'Topamax', NULL, 'topamax', 1474, '50', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 28, 'Headache', 1, NULL, '2020-10-07 08:29:41', '2020-10-07 08:29:41'),
(3002, 'Tramal', NULL, 'tramal', 1474, '50', 41, 'MG', 207, 'One Tablet Twice A Day For Pain', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:41', '2020-10-07 08:29:41'),
(3005, 'Treatan', NULL, 'treatan', 1488, '8', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:41', '2020-10-07 08:29:41'),
(3006, 'Treatan-d', NULL, 'treatan-d', 1516, '16/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:41', '2020-10-07 08:29:41'),
(3007, 'Tres-orix Forte', NULL, 'tres-orix-forte', 1620, '120 Ml', 41, 'MG', 168, '2 Teaspoons Twice A Day After Meal', 4, 'Ongoing', 9, 'Appetite', 1, NULL, '2020-10-07 08:29:41', '2020-10-07 08:29:41'),
(3009, 'Trevia', NULL, 'trevia', 1474, '50', 41, 'MG', 118, 'One Tablet In The Morning Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:41', '2020-10-07 08:29:41'),
(3012, 'Trevia Met', NULL, 'trevia-met', 1651, '50/850', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:41', '2020-10-07 08:29:41'),
(3015, 'Triax', NULL, 'triax', 1570, '500', 43, 'ML', 110, 'One Injection Twice A Day', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:41', '2020-10-07 08:29:41'),
(3020, 'Triforge', NULL, 'triforge', 1550, '5/160/25', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:42', '2020-10-07 08:29:42'),
(3021, 'Trigesic', NULL, 'trigesic', 1733, '300 / 200 / 30', 41, 'MG', 207, 'One Tablet Twice A Day For Pain', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:42', '2020-10-07 08:29:42'),
(3022, 'Trimovax', NULL, 'trimovax', 1710, 'Vaccine', 41, 'MG', 188, 'Ongoing', 14, 'Ml', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:42', '2020-10-07 08:29:42'),
(3025, 'Valium', NULL, 'valium', 1476, '5', 41, 'MG', 112, 'One Tablet At Bedtime', 5, 'As Needed', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:42', '2020-10-07 08:29:42'),
(3028, 'Valtec', NULL, 'valtec', 1537, '80', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:42', '2020-10-07 08:29:42'),
(3032, 'Valtec Amh', NULL, 'valtec-amh', 1550, '5/160/25', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:42', '2020-10-07 08:29:42'),
(3035, 'Valtec-am', NULL, 'valtec-am', 1629, '5/80', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:42', '2020-10-07 08:29:42'),
(3037, 'Vaniqa', NULL, 'vaniqa', 1562, '600', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:42', '2020-10-07 08:29:42'),
(3038, 'Vastarel', NULL, 'vastarel', 1473, '20', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:42', '2020-10-07 08:29:42'),
(3039, 'Vastarel Mr', NULL, 'vastarel-mr', 1473, '20', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:43', '2020-10-07 08:29:43'),
(3043, 'Vermox', NULL, 'vermox', 1570, '500', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 15, '3 Days', 5, 'Anemia', 1, NULL, '2020-10-07 08:29:43', '2020-10-07 08:29:43'),
(3044, 'Viagra', NULL, 'viagra', 1518, '100', 41, 'MG', 223, 'Half Tablet Half Hour Before Intended Sexual Intercourse; Avoid Fatty Food', 4, 'Ongoing', 5, 'Anemia', 1, NULL, '2020-10-07 08:29:43', '2020-10-07 08:29:43'),
(3047, 'Victoza', NULL, 'victoza', 1734, '1.8', 41, 'MG', 183, 'One Injection Subcutaneously Every Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:43', '2020-10-07 08:29:43'),
(3048, 'Vidaylin', NULL, 'vidaylin', 1472, '1', 41, 'MG', 196, 'One Tablespoon At Bedtime', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:43', '2020-10-07 08:29:43'),
(3049, 'Vivioptal', NULL, 'vivioptal', 1656, 'Cap', 41, 'MG', 147, 'One Capsule In The Morning', 4, 'Ongoing', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:29:43', '2020-10-07 08:29:43'),
(3050, 'Volinza', NULL, 'volinza', 1562, '600', 41, 'MG', 96, 'One Tablet In The Morning', 16, '2 Weeks', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:29:43', '2020-10-07 08:29:43'),
(3051, 'Voren', NULL, 'voren', 1474, '50', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:43', '2020-10-07 08:29:43'),
(3052, 'V-zac', NULL, 'v-zac', 1518, '100', 41, 'MG', 224, 'Half Tablet In The Morning', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:43', '2020-10-07 08:29:43'),
(3053, 'Wellbutrin Xl', NULL, 'wellbutrin-xl', 1521, '150', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:29:43', '2020-10-07 08:29:43'),
(3055, 'Wilnormin', NULL, 'wilnormin', 1474, '50', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:43', '2020-10-07 08:29:43'),
(3056, 'Wintogeno', NULL, 'wintogeno', 1586, 'Ongoing', 61, 'Balm', 225, '25', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:43', '2020-10-07 08:29:43'),
(3057, 'Wintogeno Gel', NULL, 'wintogeno-gel', 1735, '0.30%', 61, 'Balm', 103, 'Apply To Affected Area Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:44', '2020-10-07 08:29:44'),
(3058, 'Wondra', NULL, 'wondra', 1736, '50/200', 41, 'MG', 120, 'One Tablet Twice A Day With Meals', 5, 'As Needed', 40, 'Pain', 1, NULL, '2020-10-07 08:29:44', '2020-10-07 08:29:44'),
(3061, 'Xaar', NULL, 'xaar', 1533, '75', 41, 'MG', 163, 'One Capsule At Bedtime', 4, 'Ongoing', 41, 'Pain In Feet', 1, NULL, '2020-10-07 08:29:44', '2020-10-07 08:29:44'),
(3062, 'Xalatan', NULL, 'xalatan', 1474, '50', 41, 'MG', 134, 'One Drop Twice Daily', 4, 'Ongoing', 41, 'Pain In Feet', 1, NULL, '2020-10-07 08:29:44', '2020-10-07 08:29:44'),
(3063, 'Xaltide', NULL, 'xaltide', 1474, '50', 62, 'puff', 212, 'One Puff Twice A Day', 4, 'Ongoing', 11, 'Asthma', 1, NULL, '2020-10-07 08:29:44', '2020-10-07 08:29:44'),
(3066, 'Xanax', NULL, 'xanax', 1472, '1', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:29:44', '2020-10-07 08:29:44'),
(3069, 'Xaroban', NULL, 'xaroban', 1473, '20', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:29:44', '2020-10-07 08:29:44'),
(3070, 'Xatral Sr', NULL, 'xatral-sr', 1476, '5', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:29:44', '2020-10-07 08:29:44'),
(3072, 'Xavor', NULL, 'xavor', 1474, '50', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:44', '2020-10-07 08:29:44'),
(3073, 'Xavor - Diu', NULL, 'xavor-diu', 1732, '50 / 12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:44', '2020-10-07 08:29:44'),
(3075, 'X-bone', NULL, 'x-bone', 1472, '1', 46, 'MCG', 140, '2 Tablets In The Evening', 4, 'Ongoing', 15, 'Bone Weakness', 1, NULL, '2020-10-07 08:29:44', '2020-10-07 08:29:44'),
(3076, 'X-cept', NULL, 'x-cept', 1475, '10', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:29:44', '2020-10-07 08:29:44'),
(3077, 'Xeta Plus', NULL, 'xeta-plus', 1559, '50/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:44', '2020-10-07 08:29:44'),
(3078, 'Xifaxa', NULL, 'xifaxa', 1737, '550', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:44', '2020-10-07 08:29:44'),
(3079, 'Xiga', NULL, 'xiga', 1475, '10', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:45', '2020-10-07 08:29:45'),
(3080, 'Xolnox', NULL, 'xolnox', 1475, '10', 41, 'MG', 113, 'One Tablet In The Evening', 5, 'As Needed', 34, 'Insomnia', 1, NULL, '2020-10-07 08:29:45', '2020-10-07 08:29:45'),
(3083, 'Xolox', NULL, 'xolox', 1562, '600', 41, 'MG', 209, 'One Capsule Twice A Day After Meal', 17, '12 Weeks', 34, 'Insomnia', 1, NULL, '2020-10-07 08:29:45', '2020-10-07 08:29:45'),
(3085, 'Xormet-xr', NULL, 'xormet-xr', 1570, '500', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:45', '2020-10-07 08:29:45'),
(3088, 'Xovat', NULL, 'xovat', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:45', '2020-10-07 08:29:45'),
(3091, 'X-plended', NULL, 'x-plended', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:45', '2020-10-07 08:29:45'),
(3093, 'Xplendid', NULL, 'xplendid', 1473, '20', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:46', '2020-10-07 08:29:46'),
(3094, 'Xynosine', NULL, 'xynosine', 1482, '0.10%', 41, 'MG', 227, 'One-2 Squirt In Each Nostril Twice A Day >< 3 Days', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:46', '2020-10-07 08:29:46'),
(3095, 'Xyster', NULL, 'xyster', 1570, '500', 46, 'MCG', 140, '2 Tablets In The Evening', 4, 'Ongoing', 41, 'Pain In Feet', 1, NULL, '2020-10-07 08:29:46', '2020-10-07 08:29:46'),
(3096, 'Yarnil', NULL, 'yarnil', 1474, '50', 41, 'MG', 140, '2 Tablets In The Evening', 4, 'Ongoing', 41, 'Pain In Feet', 1, NULL, '2020-10-07 08:29:46', '2020-10-07 08:29:46'),
(3099, 'Yaz', NULL, 'yaz', 1586, 'Ongoing', 49, 'Tablet', 229, '0.02/3', 18, 'Oral Contraception', 41, 'Pain In Feet', 1, NULL, '2020-10-07 08:29:46', '2020-10-07 08:29:46'),
(3100, 'Zaarlo Forte', NULL, 'zaarlo-forte', 1739, '100/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:46', '2020-10-07 08:29:46'),
(3101, 'Zafnol', NULL, 'zafnol', 1474, '50', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:46', '2020-10-07 08:29:46'),
(3102, 'Zauxit', NULL, 'zauxit', 1473, '20', 41, 'MG', 147, 'One Capsule In The Morning', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:29:46', '2020-10-07 08:29:46'),
(3104, 'Zeecin', NULL, 'zeecin', 1570, '500', 41, 'MG', 96, 'One Tablet In The Morning', 6, '7 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:29:46', '2020-10-07 08:29:46'),
(3106, 'Zeegap', NULL, 'zeegap', 1474, '50', 41, 'MG', 163, 'One Capsule At Bedtime', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:46', '2020-10-07 08:29:46'),
(3107, 'Zentel', NULL, 'zentel', 1478, '200', 41, 'MG', 230, '2 Tablets >< One Dose', 10, 'Once', 40, 'Pain', 1, NULL, '2020-10-07 08:29:46', '2020-10-07 08:29:46'),
(3109, 'Zepose', NULL, 'zepose', 1534, '300', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:46', '2020-10-07 08:29:46'),
(3111, 'Zestoretic 20', NULL, 'zestoretic-20', 1740, '20 / 12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:46', '2020-10-07 08:29:46'),
(3114, 'Zestril', NULL, 'zestril', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:46', '2020-10-07 08:29:46'),
(3115, 'Zinish', NULL, 'zinish', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 16, '2 Weeks', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:29:46', '2020-10-07 08:29:46'),
(3118, 'Zocor', NULL, 'zocor', 1502, '40', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:47', '2020-10-07 08:29:47'),
(3119, 'Zoladex', NULL, 'zoladex', 1741, '3.6', 43, 'ML', 231, 'One Injection Subcutaneously Every 28 Days', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:47', '2020-10-07 08:29:47'),
(3120, 'Zomoz', NULL, 'zomoz', 1476, '5', 41, 'MG', 232, 'Half Tablet As Needed For Migraine Headache. May Repeat After 2 Hours If Headache Returns', 4, 'Ongoing', 37, 'Migraine', 1, NULL, '2020-10-07 08:29:47', '2020-10-07 08:29:47'),
(3122, 'Zopent', NULL, 'zopent', 1502, '40', 41, 'MG', 157, 'One Tablet Before Breakfast And Dinner', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:29:47', '2020-10-07 08:29:47'),
(3123, 'Zultracet', NULL, 'zultracet', 1742, '37.5 / 325', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:29:47', '2020-10-07 08:29:47'),
(3125, 'Zune', NULL, 'zune', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:29:47', '2020-10-07 08:29:47'),
(3127, 'Zurig', NULL, 'zurig', 1537, '80', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 53, 'Uric Acid', 1, NULL, '2020-10-07 08:29:47', '2020-10-07 08:29:47'),
(3128, 'Zylexx-sr', NULL, 'zylexx-sr', 1521, '150', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:29:47', '2020-10-07 08:29:47'),
(3130, 'Zyloric', NULL, 'zyloric', 1534, '300', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:29:47', '2020-10-07 08:29:47'),
(3131, 'Zyrtec', NULL, 'zyrtec', 1475, '10', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 4, 'Allergy', 1, NULL, '2020-10-07 08:29:47', '2020-10-07 08:29:47'),
(3132, 'Methycobal', NULL, 'methycobal', 1570, '500', 46, 'MCG', 194, 'One Injection Intramuscularly Every Month', 4, 'Ongoing', 4, 'Allergy', 1, NULL, '2020-10-07 08:29:47', '2020-10-07 08:29:47'),
(3133, 'Maxflow', NULL, 'maxflow', 1640, '0.4', 41, 'MG', 163, 'One Capsule At Bedtime', 4, 'Ongoing', 44, 'Prostate', 1, NULL, '2020-10-07 08:29:47', '2020-10-07 08:29:47'),
(3134, 'Jentin Met', NULL, 'jentin-met', 1652, '50/500', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:47', '2020-10-07 08:29:47'),
(3136, 'Lite Plus', NULL, 'lite-plus', 1743, ' ', 63, ' ', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:48', '2020-10-07 08:29:48'),
(3138, 'Getformin', NULL, 'getformin', 1526, '2/500', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:48', '2020-10-07 08:29:48'),
(3139, 'Lanzo', NULL, 'lanzo', 1497, '30', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:48', '2020-10-07 08:29:48'),
(3141, 'Glio-p', NULL, 'glio-p', 1745, '2-apr', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:48', '2020-10-07 08:29:48'),
(3144, 'Merol', NULL, 'merol', 1474, '50', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:48', '2020-10-07 08:29:48'),
(3145, 'Gempid', NULL, 'gempid', 1562, '600', 41, 'MG', 209, 'One Capsule Twice A Day After Meal', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:48', '2020-10-07 08:29:48'),
(3147, 'Probase', NULL, 'probase', 1476, '5', 41, 'MG', 174, 'Half Tablet Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:48', '2020-10-07 08:29:48'),
(3149, 'Neuromet', NULL, 'neuromet', 1570, '500', 46, 'MCG', 101, 'One Tablet Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:48', '2020-10-07 08:29:48'),
(3150, 'Surbex-z', NULL, 'surbex-z', 1746, '22.5', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:29:48', '2020-10-07 08:29:48'),
(3151, 'Vildamet', NULL, 'vildamet', 1651, '50/850', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:48', '2020-10-07 08:29:48'),
(3153, 'Vildomet', NULL, 'vildomet', 1650, '50/1000', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:49', '2020-10-07 08:29:49'),
(3154, 'Thyroxine', NULL, 'thyroxine', 1518, '100', 46, 'MCG', 175, 'One Tablet In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 4, 'Ongoing', 47, 'Thyroid', 1, NULL, '2020-10-07 08:29:49', '2020-10-07 08:29:49'),
(3156, 'Jardy', NULL, 'jardy', 1475, '10', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:49', '2020-10-07 08:29:49'),
(3159, 'Diampa-m', NULL, 'diampa-m', 1747, '12.5/1000', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:49', '2020-10-07 08:29:49'),
(3161, 'Sustac', NULL, 'sustac', 1580, '6.4', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 520, 'Angina', 1, NULL, '2020-10-07 08:29:49', '2020-10-07 08:29:49'),
(3162, 'Surbex-t', NULL, 'surbex-t', 1518, '100', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:29:49', '2020-10-07 08:29:49'),
(3163, 'Vilget', NULL, 'vilget', 1474, '50', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:49', '2020-10-07 08:29:49'),
(3164, 'Euthyrox', NULL, 'euthyrox', 1474, '50', 46, 'MCG', 175, 'One Tablet In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 4, 'Ongoing', 47, 'Thyroid', 1, NULL, '2020-10-07 08:29:49', '2020-10-07 08:29:49'),
(3199, 'Toujeo', NULL, 'toujeo', 1515, '70', 44, 'Units', 145, 'In The Evening', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:51', '2020-10-07 08:29:51'),
(3202, 'Gluconor Met', NULL, 'gluconor-met', 1526, '2/500', 41, 'MG', 166, 'One Tablet Twice A Day Before Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:51', '2020-10-07 08:29:51'),
(3203, 'Qosmet', NULL, 'qosmet', 1650, '50/1000', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:51', '2020-10-07 08:29:51'),
(3204, 'Mimcipar', NULL, 'mimcipar', 1497, '30', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:51', '2020-10-07 08:29:51'),
(3205, 'Dexamethasone', NULL, 'dexamethasone', 1483, '0.5', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:51', '2020-10-07 08:29:51'),
(3208, 'Viglip-m', NULL, 'viglip-m', 1651, '50/850', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:51', '2020-10-07 08:29:51'),
(3210, 'Esoproto', NULL, 'esoproto', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:51', '2020-10-07 08:29:51'),
(3211, 'D-cap', NULL, 'd-cap', 1502, '40', 53, 'IU', 234, '2 Capsules Every Sunday', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:29:51', '2020-10-07 08:29:51'),
(3212, 'Test', NULL, 'test', 1748, 'Na', 41, 'MG', 160, 'One Capsule Thrice A Day', 4, 'Ongoing', 4, 'Allergy', 1, NULL, '2020-10-07 08:29:51', '2020-10-07 08:29:51'),
(3213, 'Trulicity', NULL, 'trulicity', 1748, 'Na', 41, 'MG', 142, 'One Injection Subcutaneously Every Sunday', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:51', '2020-10-07 08:29:51'),
(3214, 'Survive', NULL, 'survive', 1475, '10', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:51', '2020-10-07 08:29:51'),
(3215, 'Zepose Plus', NULL, 'zepose-plus', 1535, '150/12.5', 41, 'MG', 235, '2 Tablets In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:51', '2020-10-07 08:29:51'),
(3216, 'Qazzo', NULL, 'qazzo', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:51', '2020-10-07 08:29:51'),
(3218, 'Gluconormet', NULL, 'gluconormet', 1526, '2/500', 41, 'MG', 236, 'One Tablet Twice A Day Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:51', '2020-10-07 08:29:51'),
(3219, 'Filbone', NULL, 'filbone', 1521, '150', 41, 'MG', 237, 'Half Tablet Trice A Day', 4, 'Ongoing', 15, 'Bone Weakness', 1, NULL, '2020-10-07 08:29:51', '2020-10-07 08:29:51'),
(3220, 'Neuromax', NULL, 'neuromax', 1521, '150', 46, 'MCG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:29:51', '2020-10-07 08:29:51'),
(3221, 'Zantac', NULL, 'zantac', 1521, '150', 41, 'MG', 219, 'One Tablet In The Morning After Meal', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:29:51', '2020-10-07 08:29:51'),
(3222, 'Noclot', NULL, 'noclot', 1533, '75', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:29:52', '2020-10-07 08:29:52'),
(3223, 'Calcipan-t', NULL, 'calcipan-t', 1474, '50', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:29:52', '2020-10-07 08:29:52'),
(3229, 'Xengiu-met', NULL, 'xengiu-met', 1747, '12.5/1000', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:52', '2020-10-07 08:29:52'),
(3230, 'Jezeta', NULL, 'jezeta', 1671, '10-oct', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:52', '2020-10-07 08:29:52'),
(3231, 'Niaspan', NULL, 'niaspan', 1570, '500', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:52', '2020-10-07 08:29:52'),
(3232, 'Diabetone', NULL, 'diabetone', 1754, 'Null', 64, 'NULL', 211, 'One Capsule Daily', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:52', '2020-10-07 08:29:52'),
(3233, 'Lescol Xl', NULL, 'lescol-xl', 1537, '80', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:52', '2020-10-07 08:29:52'),
(3235, 'Epler', NULL, 'epler', 1474, '50', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 234, 'High Blood Pressure', 1, NULL, '2020-10-07 08:29:52', '2020-10-07 08:29:52'),
(3236, 'Osnate-d', NULL, 'osnate-d', 1755, '830/400', 60, 'MG/IU', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:29:52', '2020-10-07 08:29:52'),
(3237, 'Cordarone', NULL, 'cordarone', 1478, '200', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:29:52', '2020-10-07 08:29:52'),
(3238, 'Centrum', NULL, 'centrum', 1754, 'Null', 64, 'NULL', 101, 'One Tablet Daily', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:29:52', '2020-10-07 08:29:52'),
(3239, 'Tegral', NULL, 'tegral', 1478, '200', 41, 'MG', 238, 'One Tablet At Bed Time', 20, '2 Months', 41, 'Pain In Feet', 1, NULL, '2020-10-07 08:29:52', '2020-10-07 08:29:52'),
(3241, 'Neurobion', NULL, 'neurobion', 1478, '200', 46, 'MCG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:29:52', '2020-10-07 08:29:52'),
(3243, 'Exforge', NULL, 'exforge', 1627, '10/160', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:53', '2020-10-07 08:29:53'),
(3244, 'Rusiam', NULL, 'rusiam', 1475, '10', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:53', '2020-10-07 08:29:53'),
(3245, 'Dolmit', NULL, 'dolmit', 1754, 'Null', 64, 'NULL', 113, 'One Tablet In The Evening', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:29:53', '2020-10-07 08:29:53'),
(3246, 'Ketosteril', NULL, 'ketosteril', 1754, 'Null', 64, 'NULL', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:29:53', '2020-10-07 08:29:53'),
(3248, 'Cell-d', NULL, 'cell-d', 1754, 'Null', 64, 'NULL', 147, 'One Capsule In The Morning', 4, 'Ongoing', 15, 'Bone Weakness', 1, NULL, '2020-10-07 08:29:53', '2020-10-07 08:29:53'),
(3249, 'Tovitt', NULL, 'tovitt', 1748, 'Na', 65, 'NA', 96, 'One Tablet In The Morning', 4, 'Ongoing', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:29:53', '2020-10-07 08:29:53'),
(3252, 'Tritace', NULL, 'tritace', 1476, '5', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:53', '2020-10-07 08:29:53'),
(3255, 'Clopid Asp', NULL, 'clopid-asp', 1756, '75/150', 41, 'MG', 219, 'One Tablet In The Morning After Meal', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:29:53', '2020-10-07 08:29:53'),
(3256, 'Coralan', NULL, 'coralan', 1476, '5', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:53', '2020-10-07 08:29:53'),
(3257, 'Itaglip-plus', NULL, 'itaglip-plus', 1652, '50/500', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:53', '2020-10-07 08:29:53'),
(3258, 'Zoliget', NULL, 'zoliget', 1757, '30/2', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:53', '2020-10-07 08:29:53'),
(3259, 'Glucerna', NULL, 'glucerna', 1479, '250', 43, 'ML', 101, 'One Tablet Daily', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:53', '2020-10-07 08:29:53'),
(3261, 'Ezita', NULL, 'ezita', 1475, '10', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:54', '2020-10-07 08:29:54'),
(3262, 'Clotrim 1%', NULL, 'clotrim-1', 1754, 'Null', 64, 'NULL', 103, 'Apply To Affected Area Twice A Day', 21, '10 Days', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:54', '2020-10-07 08:29:54'),
(3269, 'Herbessor Sr', NULL, 'herbessor-sr', 1660, '180', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:54', '2020-10-07 08:29:54'),
(3270, 'Novidat', NULL, 'novidat', 1570, '500', 41, 'MG', 97, 'One Tablet Twice A Day', 8, '5 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:29:54', '2020-10-07 08:29:54'),
(3271, 'Angiwell Xr', NULL, 'angiwell-xr', 1570, '500', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:54', '2020-10-07 08:29:54'),
(3272, 'Sevia-h', NULL, 'sevia-h', 1574, '160/12.5', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:54', '2020-10-07 08:29:54'),
(3274, 'Barilol', NULL, 'barilol', 1476, '5', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 33, 'Infection', 1, NULL, '2020-10-07 08:29:55', '2020-10-07 08:29:55'),
(3275, 'Nims', NULL, 'nims', 1518, '100', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 5, 'As Needed', 40, 'Pain', 1, NULL, '2020-10-07 08:29:55', '2020-10-07 08:29:55'),
(3276, 'Newday', NULL, 'newday', 1545, '80/5', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:55', '2020-10-07 08:29:55'),
(3277, 'Kestine', NULL, 'kestine', 1475, '10', 41, 'MG', 97, 'One Tablet Twice A Day', 5, 'As Needed', 4, 'Allergy', 1, NULL, '2020-10-07 08:29:55', '2020-10-07 08:29:55'),
(3278, 'Edwin-d', NULL, 'edwin-d', 1475, '10', 53, 'IU', 170, 'Two Capsules Every Sunday', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:29:55', '2020-10-07 08:29:55'),
(3284, 'Test20jun', NULL, 'test20jun', 1499, '34', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:29:55', '2020-10-07 08:29:55'),
(3285, 'Atacand', NULL, 'atacand', 1491, '16', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:55', '2020-10-07 08:29:55'),
(3286, 'Novonorm', NULL, 'novonorm', 1491, '16', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:29:55', '2020-10-07 08:29:55'),
(3287, 'Rast', NULL, 'rast', 1475, '10', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:55', '2020-10-07 08:29:55'),
(3288, 'Siliver', NULL, 'siliver', 1478, '200', 41, 'MG', 97, 'One Tablet Twice A Day', 21, '10 Days', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:55', '2020-10-07 08:29:55'),
(3289, 'Fibo Powder', NULL, 'fibo-powder', 1754, 'Null', 64, 'NULL', 97, 'One Tablet Twice A Day', 21, '10 Days', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:29:56', '2020-10-07 08:29:56'),
(3290, 'Lexoberon', NULL, 'lexoberon', 1476, '5', 41, 'MG', 241, 'Two Tablets In The Evening', 21, '10 Days', 19, 'Constipation', 1, NULL, '2020-10-07 08:29:56', '2020-10-07 08:29:56'),
(3291, 'Seredep', NULL, 'seredep', 1518, '100', 41, 'MG', 101, 'One Tablet Daily', 21, '10 Days', 19, 'Constipation', 1, NULL, '2020-10-07 08:29:56', '2020-10-07 08:29:56'),
(3292, 'Pk Merz', NULL, 'pk-merz', 1518, '100', 41, 'MG', 101, 'One Tablet Daily', 21, '10 Days', 19, 'Constipation', 1, NULL, '2020-10-07 08:29:56', '2020-10-07 08:29:56'),
(3295, 'Ropinirole', NULL, 'ropinirole', 1517, '0.25', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 21, '10 Days', 19, 'Constipation', 1, NULL, '2020-10-07 08:29:56', '2020-10-07 08:29:56'),
(3296, 'Venticort Rotacap', NULL, 'venticort-rotacap', 1471, '400', 41, 'MG', 157, 'One Tablet Before Breakfast And Dinner', 21, '10 Days', 19, 'Constipation', 1, NULL, '2020-10-07 08:29:56', '2020-10-07 08:29:56'),
(3298, 'Ismo', NULL, 'ismo', 1473, '20', 41, 'MG', 157, 'One Tablet Before Breakfast And Dinner', 4, 'Ongoing', 520, 'Angina', 1, NULL, '2020-10-07 08:29:56', '2020-10-07 08:29:56'),
(3299, 'Glusimet 50/500', NULL, 'glusimet-50500', 1758, '500/50', 41, 'MG', 97, 'One Tablet Twice A Day', 21, '10 Days', 520, 'Angina', 1, NULL, '2020-10-07 08:29:56', '2020-10-07 08:29:56'),
(3300, 'Isotrate', NULL, 'isotrate', 1475, '10', 41, 'MG', 97, 'One Tablet Twice A Day', 21, '10 Days', 520, 'Angina', 1, NULL, '2020-10-07 08:29:56', '2020-10-07 08:29:56'),
(3302, 'Null', NULL, 'null', 1754, 'Null', 64, 'NULL', 97, 'One Tablet Twice A Day', 21, '10 Days', 520, 'Angina', 1, NULL, '2020-10-07 08:29:56', '2020-10-07 08:29:56'),
(3304, 'Hcq', NULL, 'hcq', 1478, '200', 41, 'MG', 128, 'One Tablet Twice Daily', 21, '10 Days', 520, 'Angina', 1, NULL, '2020-10-07 08:29:57', '2020-10-07 08:29:57'),
(3305, 'Salanzodine', NULL, 'salanzodine', 1570, '500', 41, 'MG', 97, 'One Tablet Twice A Day', 21, '10 Days', 520, 'Angina', 1, NULL, '2020-10-07 08:29:57', '2020-10-07 08:29:57'),
(3306, 'Ibret Folic', NULL, 'ibret-folic', 1570, '500', 41, 'MG', 101, 'One Tablet Daily', 20, '2 Months', 520, 'Angina', 1, NULL, '2020-10-07 08:29:57', '2020-10-07 08:29:57'),
(3308, 'Polypep', NULL, 'polypep', 1502, '40', 41, 'MG', 101, 'One Tablet Daily', 21, '10 Days', 520, 'Angina', 1, NULL, '2020-10-07 08:29:57', '2020-10-07 08:29:57'),
(3311, 'Test 19june', NULL, 'test-19june', 1534, '300', 41, 'MG', 242, 'One And Half Tablet In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 21, '10 Days', 520, 'Angina', 1, NULL, '2020-10-07 08:29:58', '2020-10-07 08:29:58'),
(3313, 'Abc2019', NULL, 'abc2019', 1701, '800', 43, 'ML', 242, 'One And Half Tablet In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 21, '10 Days', 520, 'Angina', 1, NULL, '2020-10-07 08:29:58', '2020-10-07 08:29:58'),
(3315, 'Xyz12', NULL, 'xyz12', 1570, '500', 43, 'ML', 242, 'One And Half Tablet In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 21, '10 Days', 520, 'Angina', 1, NULL, '2020-10-07 08:29:58', '2020-10-07 08:29:58'),
(3317, 'Xyz123', NULL, 'xyz123', 1570, '500', 43, 'ML', 242, 'One And Half Tablet In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 21, '10 Days', 520, 'Angina', 1, NULL, '2020-10-07 08:29:58', '2020-10-07 08:29:58'),
(3319, 'Xyz21jun', NULL, 'xyz21jun', 1570, '500', 43, 'ML', 242, 'One And Half Tablet In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 21, '10 Days', 520, 'Angina', 1, NULL, '2020-10-07 08:29:58', '2020-10-07 08:29:58'),
(3322, 'Testing21', NULL, 'testing21', 1760, '900', 43, 'ML', 242, 'One And Half Tablet In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 21, '10 Days', 520, 'Angina', 1, NULL, '2020-10-07 08:29:59', '2020-10-07 08:29:59'),
(3323, 'Impulse - Z', NULL, 'impulse-z', 1472, '1', 41, 'MG', 101, 'One Tablet Daily', 21, '10 Days', 520, 'Angina', 1, NULL, '2020-10-07 08:29:59', '2020-10-07 08:29:59'),
(3325, 'Vaptor', NULL, 'vaptor', 1475, '10', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:29:59', '2020-10-07 08:29:59'),
(3326, 'Memantine', NULL, 'memantine', 1754, 'Null', 64, 'NULL', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:29:59', '2020-10-07 08:29:59'),
(3327, 'Losec', NULL, 'losec', 1473, '20', 41, 'MG', 165, 'One Capsule In The Morning Before Breakfast', 16, '2 Weeks', 195, 'Gastritis', 1, NULL, '2020-10-07 08:29:59', '2020-10-07 08:29:59'),
(3328, 'Theo-dor', NULL, 'theo-dor', 1534, '300', 41, 'MG', 101, 'One Tablet Daily', 21, '10 Days', 11, 'Asthma', 1, NULL, '2020-10-07 08:29:59', '2020-10-07 08:29:59'),
(3330, 'Levitra', NULL, 'levitra', 1473, '20', 41, 'MG', 152, 'Half Tablet Half Hour Before Intended Sexual Intercourse', 5, 'As Needed', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:59', '2020-10-07 08:29:59'),
(3331, 'Test1', NULL, 'test1', 1754, 'Null', 64, 'NULL', 152, 'Half Tablet Half Hour Before Intended Sexual Intercourse', 5, 'As Needed', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:59', '2020-10-07 08:29:59'),
(3332, 'A2a', NULL, 'a2a', 1474, '50', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:59', '2020-10-07 08:29:59'),
(3334, 'Sporonox', NULL, 'sporonox', 1518, '100', 41, 'MG', 244, 'Once Daily', 15, '3 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:29:59', '2020-10-07 08:29:59'),
(3335, 'Olesta-am', NULL, 'olesta-am', 1680, '40/5', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:59', '2020-10-07 08:29:59'),
(3336, 'Laxoberon', NULL, 'laxoberon', 1476, '5', 41, 'MG', 192, 'Two Tablets At Bedtime', 5, 'As Needed', 19, 'Constipation', 1, NULL, '2020-10-07 08:29:59', '2020-10-07 08:29:59'),
(3337, 'Co-zeal', NULL, 'co-zeal', 1761, '25/10', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:29:59', '2020-10-07 08:29:59'),
(3338, 'Gravinate Syp', NULL, 'gravinate-syp', 1761, '25/10', 66, 'TSF', 245, 'Two Teaspoon Thrice A Day After Meal', 15, '3 Days', 46, 'Stomach', 1, NULL, '2020-10-07 08:29:59', '2020-10-07 08:29:59'),
(3339, 'Aspirin Ec', NULL, 'aspirin-ec', 1762, '81', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:30:00', '2020-10-07 08:30:00'),
(3340, 'Lochol', NULL, 'lochol', 1473, '20', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 13, 'Blood Pressure/Cholestrol', 1, NULL, '2020-10-07 08:30:00', '2020-10-07 08:30:00'),
(3341, 'Omepral', NULL, 'omepral', 1473, '20', 41, 'MG', 164, 'One Capsule Before Breakfast And Dinner', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:30:00', '2020-10-07 08:30:00'),
(3342, 'Cardiovit', NULL, 'cardiovit', 1754, 'Null', 64, 'NULL', 219, 'One Tablet In The Morning After Meal', 4, 'Ongoing', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:30:00', '2020-10-07 08:30:00'),
(3344, 'Maxron', NULL, 'maxron', 1640, '0.4', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 44, 'Prostate', 1, NULL, '2020-10-07 08:30:00', '2020-10-07 08:30:00'),
(3346, 'Warfarin', NULL, 'warfarin', 1476, '5', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:30:00', '2020-10-07 08:30:00'),
(3348, 'Fish Oil (omega)', NULL, 'fish-oil-omega', 1570, '500', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:30:00', '2020-10-07 08:30:00'),
(3349, 'Relaxin', NULL, 'relaxin', 1524, '3', 41, 'MG', 238, 'One Tablet At Bed Time', 16, '2 Weeks', 8, 'Anxiety', 1, NULL, '2020-10-07 08:30:00', '2020-10-07 08:30:00'),
(3350, 'Procarbazole', NULL, 'procarbazole', 1474, '50', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 47, 'Thyroid', 1, NULL, '2020-10-07 08:30:00', '2020-10-07 08:30:00'),
(3351, 'Omsana-am', NULL, 'omsana-am', 1763, '20/5', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:00', '2020-10-07 08:30:00'),
(3353, 'Sitagen -m 50/500', NULL, 'sitagen-m-50500', 1652, '50/500', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:00', '2020-10-07 08:30:00'),
(3354, 'Ferinject', NULL, 'ferinject', 1764, '10ml', 67, '50MG/ML', 184, 'One Injection Intravenously ', 10, 'Once', 5, 'Anemia', 1, NULL, '2020-10-07 08:30:00', '2020-10-07 08:30:00'),
(3355, 'Itaglip-m 50/500', NULL, 'itaglip-m-50500', 1652, '50/500', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:00', '2020-10-07 08:30:00'),
(3356, 'Avant', NULL, 'avant', 1521, '150', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:00', '2020-10-07 08:30:00'),
(3357, 'Mepressor', NULL, 'mepressor', 1474, '50', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:00', '2020-10-07 08:30:00'),
(3358, 'Spiromide', NULL, 'spiromide', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:00', '2020-10-07 08:30:00'),
(3360, 'Flourinef', NULL, 'flourinef', 1517, '0.25', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:01', '2020-10-07 08:30:01'),
(3361, 'Vitrum', NULL, 'vitrum', 1754, 'Null', 41, 'MG', 101, 'One Tablet Daily', 21, '10 Days', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:30:01', '2020-10-07 08:30:01'),
(3362, 'Cod-liver Oil', NULL, 'cod-liver-oil', 1754, 'Null', 64, 'NULL', 163, 'One Capsule At Bedtime', 16, '2 Weeks', 55, 'Vitamin', 1, NULL, '2020-10-07 08:30:01', '2020-10-07 08:30:01'),
(3363, 'Calcitron', NULL, 'calcitron', 1754, 'Null', 41, 'MG', 242, 'One And Half Tablet In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 20, '2 Months', 17, 'Calcium', 1, NULL, '2020-10-07 08:30:01', '2020-10-07 08:30:01'),
(3364, 'Letara', NULL, 'letara', 1765, '2.5mg', 41, 'MG', 101, 'One Tablet Daily', 21, '10 Days', 107, 'Breast Cancer Survivor', 1, NULL, '2020-10-07 08:30:01', '2020-10-07 08:30:01'),
(3365, 'Vit-c', NULL, 'vit-c', 1765, '2.5mg', 41, 'MG', 101, 'One Tablet Daily', 21, '10 Days', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:30:01', '2020-10-07 08:30:01'),
(3367, 'Progrel -ap', NULL, 'progrel-ap', 1639, '75/75', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:30:01', '2020-10-07 08:30:01');
INSERT INTO `medications` (`id`, `title`, `generic_name`, `slug`, `dose_id`, `dose`, `unit_id`, `unit`, `frequency_id`, `frequency`, `duration_id`, `duration`, `diagnosis_type_id`, `diagnosis_type`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3368, 'Sunny D3', NULL, 'sunny-d3', 1639, '75/75', 53, 'IU', 101, 'One Tablet Daily', 4, 'Ongoing', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:30:01', '2020-10-07 08:30:01'),
(3369, 'Zolid', NULL, 'zolid', 1767, '45', 41, 'MG', 101, 'One Tablet Daily', 21, '10 Days', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:01', '2020-10-07 08:30:01'),
(3370, 'Azithro', NULL, 'azithro', 1479, '250', 41, 'MG', 128, 'One Tablet Twice Daily', 8, '5 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:30:01', '2020-10-07 08:30:01'),
(3371, 'Gummy (gnc)', NULL, 'gummy-gnc', 1768, '1 Capsule', 64, 'NULL', 148, '2 Tablets Twice A Day', 20, '2 Months', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:30:01', '2020-10-07 08:30:01'),
(3372, 'Probac', NULL, 'probac', 1769, 'Sachet', 64, 'NULL', 244, 'Once Daily', 22, '6 Weeks', 19, 'Constipation', 1, NULL, '2020-10-07 08:30:01', '2020-10-07 08:30:01'),
(3373, 'Tryptanol', NULL, 'tryptanol', 1769, 'Sachet', 41, 'MG', 101, 'One Tablet Daily', 21, '10 Days', 21, 'Depression', 1, NULL, '2020-10-07 08:30:01', '2020-10-07 08:30:01'),
(3374, 'Gabapentin', NULL, 'gabapentin', 1534, '300', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:30:01', '2020-10-07 08:30:01'),
(3375, 'Sitagen-m', NULL, 'sitagen-m', 1652, '50/500', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:01', '2020-10-07 08:30:01'),
(3376, 'Zerogout', NULL, 'zerogout', 1502, '40', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 207, 'Gout', 1, NULL, '2020-10-07 08:30:01', '2020-10-07 08:30:01'),
(3377, 'Ezium', NULL, 'ezium', 1502, '40', 41, 'MG', 211, 'One Capsule Daily', 4, 'Ongoing', 207, 'Gout', 1, NULL, '2020-10-07 08:30:02', '2020-10-07 08:30:02'),
(3378, 'Sunny-d Stat', NULL, 'sunny-d-stat', 1502, '40', 53, 'IU', 243, 'One Capsule Every Month', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:30:02', '2020-10-07 08:30:02'),
(3379, 'Rigix', NULL, 'rigix', 1475, '10', 41, 'MG', 101, 'One Tablet Daily', 21, '10 Days', 4, 'Allergy', 1, NULL, '2020-10-07 08:30:02', '2020-10-07 08:30:02'),
(3380, 'Onset', NULL, 'onset', 1488, '8', 41, 'MG', 101, 'One Tablet Daily', 5, 'As Needed', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:02', '2020-10-07 08:30:02'),
(3381, 'Sitagen 50/850', NULL, 'sitagen-50850', 1651, '50/850', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:02', '2020-10-07 08:30:02'),
(3382, 'Silliver', NULL, 'silliver', 1478, '200', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 20, '2 Months', 30, 'Hepatitis', 1, NULL, '2020-10-07 08:30:02', '2020-10-07 08:30:02'),
(3383, 'Hepamerz', NULL, 'hepamerz', 1770, '300mg/5ml', 68, '5ML', 246, 'Two Teaspoons Twice A Day After Meal', 16, '2 Weeks', 135, 'Chronic Liver Disease', 1, NULL, '2020-10-07 08:30:02', '2020-10-07 08:30:02'),
(3384, 'Betanorm', NULL, 'betanorm', 1770, '300mg/5ml', 41, 'MG', 244, 'Once Daily', 4, 'Ongoing', 135, 'Chronic Liver Disease', 1, NULL, '2020-10-07 08:30:02', '2020-10-07 08:30:02'),
(3385, 'Plasenenzyme', NULL, 'plasenenzyme', 1754, 'Null', 64, 'NULL', 186, 'One Tablet Thrice A Day Before Each Meal', 4, 'Ongoing', 135, 'Chronic Liver Disease', 1, NULL, '2020-10-07 08:30:02', '2020-10-07 08:30:02'),
(3386, 'Sunny S Stat', NULL, 'sunny-s-stat', 1754, 'Null', 64, 'NULL', 161, 'Drink One Injection Every Month', 4, 'Ongoing', 135, 'Chronic Liver Disease', 1, NULL, '2020-10-07 08:30:02', '2020-10-07 08:30:02'),
(3387, 'Nitroscot Sr', NULL, 'nitroscot-sr', 1579, '2.6', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 520, 'Angina', 1, NULL, '2020-10-07 08:30:02', '2020-10-07 08:30:02'),
(3388, 'Belair', NULL, 'belair', 1475, '10', 41, 'MG', 128, 'One Tablet Twice Daily', 21, '10 Days', 4, 'Allergy', 1, NULL, '2020-10-07 08:30:02', '2020-10-07 08:30:02'),
(3390, 'Lalap', NULL, 'lalap', 1475, '10', 41, 'MG', 101, 'One Tablet Daily', 21, '10 Days', 173, 'Epilepsy', 1, NULL, '2020-10-07 08:30:02', '2020-10-07 08:30:02'),
(3391, 'Sert', NULL, 'sert', 1475, '10', 41, 'MG', 112, 'One Tablet At Bedtime', 21, '10 Days', 173, 'Epilepsy', 1, NULL, '2020-10-07 08:30:02', '2020-10-07 08:30:02'),
(3392, 'Nicoget', NULL, 'nicoget', 1475, '10', 41, 'MG', 101, 'One Tablet Daily', 21, '10 Days', 520, 'Angina', 1, NULL, '2020-10-07 08:30:02', '2020-10-07 08:30:02'),
(3393, 'Pepsidine', NULL, 'pepsidine', 1502, '40', 41, 'MG', 163, 'One Capsule At Bedtime', 21, '10 Days', 520, 'Angina', 1, NULL, '2020-10-07 08:30:02', '2020-10-07 08:30:02'),
(3395, 'Beneprotein', NULL, 'beneprotein', 1769, 'Sachet', 64, 'NULL', 243, 'One Capsule Every Month', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:30:02', '2020-10-07 08:30:02'),
(3396, 'Sacvin', NULL, 'sacvin', 1474, '50', 41, 'MG', 101, 'One Tablet Daily', 21, '10 Days', 162, 'Diastolic Heart Failure', 1, NULL, '2020-10-07 08:30:03', '2020-10-07 08:30:03'),
(3397, 'Valstar', NULL, 'valstar', 1537, '80', 41, 'MG', 128, 'One Tablet Twice Daily', 21, '10 Days', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:03', '2020-10-07 08:30:03'),
(3399, 'Lestolip', NULL, 'lestolip', 1473, '20', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 13, 'Blood Pressure/Cholestrol', 1, NULL, '2020-10-07 08:30:03', '2020-10-07 08:30:03'),
(3400, 'Imdur', NULL, 'imdur', 1477, '60', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 520, 'Angina', 1, NULL, '2020-10-07 08:30:03', '2020-10-07 08:30:03'),
(3401, 'Piozer-g', NULL, 'piozer-g', 1757, '30/2', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:03', '2020-10-07 08:30:03'),
(3402, 'Co-tritace', NULL, 'co-tritace', 1771, '2.5/12.5', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:03', '2020-10-07 08:30:03'),
(3403, 'Zamlo-h', NULL, 'zamlo-h', 1578, '5/12.5', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:03', '2020-10-07 08:30:03'),
(3404, 'Ronilol', NULL, 'ronilol', 1472, '1', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 43, 'Parkinsons Disease', 1, NULL, '2020-10-07 08:30:03', '2020-10-07 08:30:03'),
(3407, 'Amtas', NULL, 'amtas', 1528, 'May-40', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:03', '2020-10-07 08:30:03'),
(3408, 'Satran - H', NULL, 'satran-h', 1773, '12.5/50', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:03', '2020-10-07 08:30:03'),
(3409, 'Ampress', NULL, 'ampress', 1476, '5', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:03', '2020-10-07 08:30:03'),
(3410, 'Melatonim', NULL, 'melatonim', 1524, '3', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 34, 'Insomnia', 1, NULL, '2020-10-07 08:30:03', '2020-10-07 08:30:03'),
(3411, 'Zamcil', NULL, 'zamcil', 1474, '50', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:03', '2020-10-07 08:30:03'),
(3412, 'Baclorax', NULL, 'baclorax', 1475, '10', 41, 'MG', 97, 'One Tablet Twice A Day', 16, '2 Weeks', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:03', '2020-10-07 08:30:03'),
(3413, 'Dioplus', NULL, 'dioplus', 1529, 'May-80', 41, 'MG', 128, 'One Tablet Twice Daily', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:03', '2020-10-07 08:30:03'),
(3414, 'No Gerd Sr', NULL, 'no-gerd-sr', 1754, 'Null', 64, 'NULL', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:03', '2020-10-07 08:30:03'),
(3415, 'Insuget R', NULL, 'insuget-r', 1518, '100', 44, 'Units', 106, 'One Injection Subcutaneously', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:03', '2020-10-07 08:30:03'),
(3416, 'Insuget N', NULL, 'insuget-n', 1518, '100', 44, 'Units', 106, 'One Injection Subcutaneously', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:04', '2020-10-07 08:30:04'),
(3417, 'Rancard-xr', NULL, 'rancard-xr', 1570, '500', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 520, 'Angina', 1, NULL, '2020-10-07 08:30:04', '2020-10-07 08:30:04'),
(3419, 'Cataflam', NULL, 'cataflam', 1474, '50', 41, 'MG', 128, 'One Tablet Twice Daily', 5, 'As Needed', 40, 'Pain', 1, NULL, '2020-10-07 08:30:04', '2020-10-07 08:30:04'),
(3420, 'Savesto', NULL, 'savesto', 1774, '49/51', 41, 'MG', 101, 'One Tablet Daily', 21, '10 Days', 162, 'Diastolic Heart Failure', 1, NULL, '2020-10-07 08:30:04', '2020-10-07 08:30:04'),
(3421, 'Ranola', NULL, 'ranola', 1570, '500', 41, 'MG', 128, 'One Tablet Twice Daily', 21, '10 Days', 520, 'Angina', 1, NULL, '2020-10-07 08:30:04', '2020-10-07 08:30:04'),
(3422, 'Ultra-d3', NULL, 'ultra-d3', 1775, '25/1000', 53, 'IU', 101, 'One Tablet Daily', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:30:04', '2020-10-07 08:30:04'),
(3423, 'Tobrex', NULL, 'tobrex', 1776, '0.3%', 64, 'NULL', 117, 'One Drop In Each Eye, Thrice A Day', 6, '7 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:30:04', '2020-10-07 08:30:04'),
(3425, 'Moxiget', NULL, 'moxiget', 1471, '400', 41, 'MG', 219, 'One Tablet In The Morning After Meal', 6, '7 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:30:04', '2020-10-07 08:30:04'),
(3426, 'Deep Heat', NULL, 'deep-heat', 1754, 'Null', 64, 'NULL', 249, 'Twice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:30:04', '2020-10-07 08:30:04'),
(3427, 'Knee Cap', NULL, 'knee-cap', 1754, 'Null', 64, 'NULL', 249, 'Twice A Day', 4, 'Ongoing', 40, 'Pain', 1, NULL, '2020-10-07 08:30:04', '2020-10-07 08:30:04'),
(3428, 'Arinac Forte', NULL, 'arinac-forte', 1777, '200/30', 41, 'MG', 108, 'One Tablet Thrice A Day', 15, '3 Days', 523, 'Flue', 1, NULL, '2020-10-07 08:30:04', '2020-10-07 08:30:04'),
(3429, 'Bosmon', NULL, 'bosmon', 1778, '62.5', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 21, '10 Days', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:04', '2020-10-07 08:30:04'),
(3430, 'Neurolith', NULL, 'neurolith', 1754, 'Null', 64, 'NULL', 124, '2 Tablets At Bedtime', 21, '10 Days', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:04', '2020-10-07 08:30:04'),
(3431, 'Piozer', NULL, 'piozer', 1497, '30', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:04', '2020-10-07 08:30:04'),
(3432, 'Mtx', NULL, 'mtx', 1475, '10', 41, 'MG', 96, 'One Tablet In The Morning', 24, 'Sunday', 425, 'Rheumatoid Arthritis', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3433, 'Adronil', NULL, 'adronil', 1521, '150', 41, 'MG', 247, 'One Tablet On 1st Sunday Of Every Month On An Empty Stomach With 2 Glasses Of Water. Do Not Eat, Drink Or Lie Down For 1/2 Hour.', 25, 'First Sunday Of Every Month', 15, 'Bone Weakness', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3434, 'Acefer F', NULL, 'acefer-f', 1779, '100 , 0.35', 41, 'MG', 96, 'One Tablet In The Morning', 21, '10 Days', 5, 'Anemia', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3435, 'Methotrexate', NULL, 'methotrexate', 1779, '100 , 0.35', 41, 'MG', 101, 'One Tablet Daily', 21, '10 Days', 5, 'Anemia', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3436, 'Hcq 200', NULL, 'hcq-200', 1478, '200', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 21, '10 Days', 35, 'Malaria', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3437, 'Lyta', NULL, 'lyta', 1497, '30', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3438, 'Gouric', NULL, 'gouric', 1473, '20', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 20, '2 Months', 21, 'Depression', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3439, 'Sunny D Stat', NULL, 'sunny-d-stat', 1609, '200000', 69, 'unit', 163, 'One Capsule At Bedtime', 20, '2 Months', 21, 'Depression', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3440, 'Levothyroxine', NULL, 'levothyroxine', 1533, '75', 46, 'MCG', 96, 'One Tablet In The Morning', 20, '2 Months', 21, 'Depression', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3441, 'Hydrocortisone', NULL, 'hydrocortisone', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 20, '2 Months', 21, 'Depression', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3442, 'Mebever Mr', NULL, 'mebever-mr', 1754, 'Null', 64, 'NULL', 209, 'One Capsule Twice A Day After Meal', 26, 'Breakfast', 21, 'Depression', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3443, 'Calzem', NULL, 'calzem', 1497, '30', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 26, 'Breakfast', 21, 'Depression', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3444, 'Ferosoft', NULL, 'ferosoft', 1754, 'Null', 64, 'NULL', 238, 'One Tablet At Bed Time', 26, 'Breakfast', 21, 'Depression', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3445, 'Baritec 20mg', NULL, 'baritec-20mg', 1473, '20', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3446, 'Aspirin', NULL, 'aspirin', 1521, '150', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3447, 'Somno', NULL, 'somno', 1475, '10', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 34, 'Insomnia', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3448, 'Cell-d Plus', NULL, 'cell-d-plus', 1475, '10', 53, 'IU', 250, 'One Capsule Every Sunday', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3449, 'Gravinite Syp', NULL, 'gravinite-syp', 1780, '1 Tsf', 69, 'unit', 100, 'One Tablespoon Twice A Day', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3450, 'Stat-a', NULL, 'stat-a', 1475, '10', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:30:05', '2020-10-07 08:30:05'),
(3451, 'Megaman', NULL, 'megaman', 1472, '1', 64, 'NULL', 219, 'One Tablet In The Morning After Meal', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:30:06', '2020-10-07 08:30:06'),
(3452, 'Monitor', NULL, 'monitor', 1472, '1', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:06', '2020-10-07 08:30:06'),
(3453, 'Zoloft Hc', NULL, 'zoloft-hc', 1474, '50', 41, 'MG', 113, 'One Tablet In The Evening', 21, '10 Days', 21, 'Depression', 1, NULL, '2020-10-07 08:30:06', '2020-10-07 08:30:06'),
(3456, 'Plaquin-h', NULL, 'plaquin-h', 1478, '200', 41, 'MG', 249, 'Twice A Day', 6, '7 Days', 35, 'Malaria', 1, NULL, '2020-10-07 08:30:06', '2020-10-07 08:30:06'),
(3457, 'Betalock Zok', NULL, 'betalock-zok', 1518, '100', 41, 'MG', 100, 'One Tablespoon Twice A Day', 4, 'Ongoing', 35, 'Malaria', 1, NULL, '2020-10-07 08:30:06', '2020-10-07 08:30:06'),
(3458, 'Ruvastat', NULL, 'ruvastat', 1475, '10', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:30:06', '2020-10-07 08:30:06'),
(3459, 'Valmo', NULL, 'valmo', 1627, '10/160', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:06', '2020-10-07 08:30:06'),
(3460, 'Synflex', NULL, 'synflex', 1737, '550', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 15, '3 Days', 40, 'Pain', 1, NULL, '2020-10-07 08:30:06', '2020-10-07 08:30:06'),
(3461, 'Testosterone Enanthate', NULL, 'testosterone-enanthate', 1533, '75', 41, 'MG', 248, 'One Injection Intramuscularly', 17, '12 Weeks', 40, 'Pain', 1, NULL, '2020-10-07 08:30:06', '2020-10-07 08:30:06'),
(3462, 'Ulsanic', NULL, 'ulsanic', 1782, '1gm', 55, 'GM', 118, 'One Tablet In The Morning Before Breakfast', 16, '2 Weeks', 195, 'Gastritis', 1, NULL, '2020-10-07 08:30:06', '2020-10-07 08:30:06'),
(3463, 'Maxolon', NULL, 'maxolon', 1780, '1 Tsf', 70, '5MG/5ML', 181, 'One Teaspoon Thrice A Day After Meal', 15, '3 Days', 195, 'Gastritis', 1, NULL, '2020-10-07 08:30:06', '2020-10-07 08:30:06'),
(3464, 'Nocid', NULL, 'nocid', 1502, '40', 41, 'MG', 112, 'One Tablet At Bedtime', 5, 'As Needed', 195, 'Gastritis', 1, NULL, '2020-10-07 08:30:06', '2020-10-07 08:30:06'),
(3465, 'Ostegem', NULL, 'ostegem', 1570, '500', 41, 'MG', 101, 'One Tablet Daily', 20, '2 Months', 17, 'Calcium', 1, NULL, '2020-10-07 08:30:06', '2020-10-07 08:30:06'),
(3467, 'Empaa', NULL, 'empaa', 1475, '10', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:07', '2020-10-07 08:30:07'),
(3468, 'Anvol', NULL, 'anvol', 1475, '10', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:07', '2020-10-07 08:30:07'),
(3469, 'Empa', NULL, 'empa', 1475, '10', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:07', '2020-10-07 08:30:07'),
(3470, 'Prostatin', NULL, 'prostatin', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:30:07', '2020-10-07 08:30:07'),
(3471, 'Canreck', NULL, 'canreck', 1488, '8', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:30:07', '2020-10-07 08:30:07'),
(3472, 'Nedopar', NULL, 'nedopar', 1570, '500', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:30:07', '2020-10-07 08:30:07'),
(3473, 'Pepcidine', NULL, 'pepcidine', 1502, '40', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:30:07', '2020-10-07 08:30:07'),
(3474, 'Anplag', NULL, 'anplag', 1649, '90', 64, 'NULL', 219, 'One Tablet In The Morning After Meal', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:30:07', '2020-10-07 08:30:07'),
(3475, 'Abiclot', NULL, 'abiclot', 1533, '75', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:30:07', '2020-10-07 08:30:07'),
(3476, 'Galzamet 850/50', NULL, 'galzamet-85050', 1754, 'Null', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:30:07', '2020-10-07 08:30:07'),
(3477, 'Abiclot 75/75', NULL, 'abiclot-7575', 1754, 'Null', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:30:07', '2020-10-07 08:30:07'),
(3478, 'Rivotril', NULL, 'rivotril', 1754, 'Null', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 8, 'Anxiety', 1, NULL, '2020-10-07 08:30:07', '2020-10-07 08:30:07'),
(3479, 'Kestore', NULL, 'kestore', 1475, '10', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:30:07', '2020-10-07 08:30:07'),
(3480, 'Perfectil', NULL, 'perfectil', 1754, 'Null', 64, 'NULL', 244, 'Once Daily', 20, '2 Months', 55, 'Vitamin', 1, NULL, '2020-10-07 08:30:07', '2020-10-07 08:30:07'),
(3481, 'Xarelto', NULL, 'xarelto', 1473, '20', 41, 'MG', 96, 'One Tablet In The Morning', 16, '2 Weeks', 55, 'Vitamin', 1, NULL, '2020-10-07 08:30:07', '2020-10-07 08:30:07'),
(3482, 'Delanzo Dr', NULL, 'delanzo-dr', 1497, '30', 41, 'MG', 96, 'One Tablet In The Morning', 21, '10 Days', 46, 'Stomach', 1, NULL, '2020-10-07 08:30:08', '2020-10-07 08:30:08'),
(3483, 'Orlis', NULL, 'orlis', 1540, '120', 41, 'MG', 209, 'One Capsule Twice A Day After Meal', 4, 'Ongoing', 57, 'Weight', 1, NULL, '2020-10-07 08:30:08', '2020-10-07 08:30:08'),
(3484, 'Tiotropium', NULL, 'tiotropium', 1492, '18', 46, 'MCG', 211, 'One Capsule Daily', 4, 'Ongoing', 11, 'Asthma', 1, NULL, '2020-10-07 08:30:08', '2020-10-07 08:30:08'),
(3486, 'Vit D 3', NULL, 'vit-d-3', 1617, '50000', 64, 'NULL', 244, 'Once Daily', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:30:08', '2020-10-07 08:30:08'),
(3489, 'Valsatril 24/26', NULL, 'valsatril-2426', 1783, '24/26', 41, 'MG', 219, 'One Tablet In The Morning After Meal', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:08', '2020-10-07 08:30:08'),
(3490, 'Besart', NULL, 'besart', 1536, '300/12.5', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:08', '2020-10-07 08:30:08'),
(3491, 'Etipro', NULL, 'etipro', 1473, '20', 41, 'MG', 164, 'One Capsule Before Breakfast And Dinner', 16, '2 Weeks', 195, 'Gastritis', 1, NULL, '2020-10-07 08:30:08', '2020-10-07 08:30:08'),
(3492, 'Humulin-n', NULL, 'humulin-n', 1473, '20', 44, 'Units', 109, 'Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:08', '2020-10-07 08:30:08'),
(3493, 'Humulin-r', NULL, 'humulin-r', 1487, '6', 44, 'Units', 109, 'Before Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:08', '2020-10-07 08:30:08'),
(3494, 'Nebicare', NULL, 'nebicare', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:08', '2020-10-07 08:30:08'),
(3495, 'Ziscar', NULL, 'ziscar', 1476, '5', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 248, 'Hypertension', 1, NULL, '2020-10-07 08:30:08', '2020-10-07 08:30:08'),
(3496, 'Skilax Drops', NULL, 'skilax-drops', 1784, '10-15', 71, 'DROPS', 240, 'Before Dinner', 21, '10 Days', 19, 'Constipation', 1, NULL, '2020-10-07 08:30:08', '2020-10-07 08:30:08'),
(3497, 'Foster', NULL, 'foster', 1785, '6/100', 64, 'NULL', 249, 'Twice A Day', 21, '10 Days', 19, 'Constipation', 1, NULL, '2020-10-07 08:30:08', '2020-10-07 08:30:08'),
(3498, 'Combivair', NULL, 'combivair', 1471, '400', 46, 'MCG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 19, 'Constipation', 1, NULL, '2020-10-07 08:30:08', '2020-10-07 08:30:08'),
(3499, 'Silo-m 50/500', NULL, 'silo-m-50500', 1652, '50/500', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:08', '2020-10-07 08:30:08'),
(3500, 'Valforge', NULL, 'valforge', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:08', '2020-10-07 08:30:08'),
(3501, 'Ranzol Xr 500', NULL, 'ranzol-xr-500', 1570, '500', 41, 'MG', 120, 'One Tablet Twice A Day With Meals', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:09', '2020-10-07 08:30:09'),
(3502, 'Glucagon', NULL, 'glucagon', 1472, '1', 41, 'MG', 248, 'One Injection Intramuscularly', 5, 'As Needed', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:09', '2020-10-07 08:30:09'),
(3503, 'Virata', NULL, 'virata', 1649, '90', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 21, '10 Days', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:30:09', '2020-10-07 08:30:09'),
(3504, 'Co-plavix', NULL, 'co-plavix', 1639, '75/75', 41, 'MG', 219, 'One Tablet In The Morning After Meal', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:30:09', '2020-10-07 08:30:09'),
(3505, 'Byscard', NULL, 'byscard', 1639, '75/75', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:09', '2020-10-07 08:30:09'),
(3506, 'Hudrocortisone', NULL, 'hudrocortisone', 1475, '10', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:09', '2020-10-07 08:30:09'),
(3507, 'Caprinza', NULL, 'caprinza', 1476, '5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:09', '2020-10-07 08:30:09'),
(3508, 'Lophos', NULL, 'lophos', 1786, '667', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:30:09', '2020-10-07 08:30:09'),
(3509, 'Phlogin', NULL, 'phlogin', 1474, '50', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 5, 'As Needed', 40, 'Pain', 1, NULL, '2020-10-07 08:30:09', '2020-10-07 08:30:09'),
(3510, 'Ogrel', NULL, 'ogrel', 1533, '75', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:30:09', '2020-10-07 08:30:09'),
(3512, 'Ogrel Plus', NULL, 'ogrel-plus', 1787, '75 , 81', 41, 'MG', 96, 'One Tablet In The Morning', 21, '10 Days', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:30:10', '2020-10-07 08:30:10'),
(3513, 'Diampa', NULL, 'diampa', 1475, '10', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:10', '2020-10-07 08:30:10'),
(3514, 'Rosuvax', NULL, 'rosuvax', 1476, '5', 41, 'MG', 113, 'One Tablet In The Evening', 20, '2 Months', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:30:10', '2020-10-07 08:30:10'),
(3515, 'Fenoget', NULL, 'fenoget', 1478, '200', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 164, 'Dyslipidemia', 1, NULL, '2020-10-07 08:30:10', '2020-10-07 08:30:10'),
(3517, 'Hemolog Mix 50', NULL, 'hemolog-mix-50', 1492, '18', 64, 'NULL', 145, 'In The Evening', 4, 'Ongoing', 164, 'Dyslipidemia', 1, NULL, '2020-10-07 08:30:10', '2020-10-07 08:30:10'),
(3518, 'Cymbalta', NULL, 'cymbalta', 1497, '30', 41, 'MG', 96, 'One Tablet In The Morning', 21, '10 Days', 21, 'Depression', 1, NULL, '2020-10-07 08:30:10', '2020-10-07 08:30:10'),
(3520, 'Rancard Xr', NULL, 'rancard-xr', 1570, '500', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 520, 'Angina', 1, NULL, '2020-10-07 08:30:10', '2020-10-07 08:30:10'),
(3521, 'Nicoril', NULL, 'nicoril', 1473, '20', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 520, 'Angina', 1, NULL, '2020-10-07 08:30:10', '2020-10-07 08:30:10'),
(3522, 'Dispirin', NULL, 'dispirin', 1534, '300', 41, 'MG', 219, 'One Tablet In The Morning After Meal', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:30:10', '2020-10-07 08:30:10'),
(3523, 'Byvas', NULL, 'byvas', 1476, '5', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:10', '2020-10-07 08:30:10'),
(3524, 'Rivarox', NULL, 'rivarox', 1475, '10', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:30:10', '2020-10-07 08:30:10'),
(3525, 'Cal-p', NULL, 'cal-p', 1788, '120ml', 68, '5ML', 181, 'One Teaspoon Thrice A Day After Meal', 4, 'Ongoing', 17, 'Calcium', 1, NULL, '2020-10-07 08:30:11', '2020-10-07 08:30:11'),
(3526, 'Arbi-d', NULL, 'arbi-d', 1789, '150/25', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:11', '2020-10-07 08:30:11'),
(3528, 'Sitaglu', NULL, 'sitaglu', 1474, '50', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:11', '2020-10-07 08:30:11'),
(3529, 'Eziday', NULL, 'eziday', 1474, '50', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:11', '2020-10-07 08:30:11'),
(3530, 'Digoxin', NULL, 'digoxin', 1479, '250', 46, 'MCG', 224, 'Half Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:11', '2020-10-07 08:30:11'),
(3532, 'D-tab', NULL, 'd-tab', 1479, '250', 53, 'IU', 170, 'Two Capsules Every Sunday', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:30:11', '2020-10-07 08:30:11'),
(3533, 'Lacolep', NULL, 'lacolep', 1474, '50', 41, 'MG', 97, 'One Tablet Twice A Day', 16, '2 Weeks', 372, 'Peripheral Neuropathy', 1, NULL, '2020-10-07 08:30:11', '2020-10-07 08:30:11'),
(3535, 'Extor', NULL, 'extor', 1629, '5/80', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:12', '2020-10-07 08:30:12'),
(3536, 'Prevenar', NULL, 'prevenar', 1483, '0.5', 43, 'ML', 248, 'One Injection Intramuscularly', 10, 'Once', 54, 'Vaccine', 1, NULL, '2020-10-07 08:30:12', '2020-10-07 08:30:12'),
(3537, 'Fluarix', NULL, 'fluarix', 1791, '0.5ml', 43, 'ML', 102, 'Inject Once A Year', 10, 'Once', 27, 'Flu Prevention', 1, NULL, '2020-10-07 08:30:12', '2020-10-07 08:30:12'),
(3538, 'Sita-met Xr', NULL, 'sita-met-xr', 1652, '50/500', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:12', '2020-10-07 08:30:12'),
(3539, 'Maxflow-d', NULL, 'maxflow-d', 1792, '0.5/0.4', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 44, 'Prostate', 1, NULL, '2020-10-07 08:30:12', '2020-10-07 08:30:12'),
(3541, 'Gpride Msr', NULL, 'gpride-msr', 1525, '1/500', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:12', '2020-10-07 08:30:12'),
(3542, 'Tenoret', NULL, 'tenoret', 1559, '50/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:12', '2020-10-07 08:30:12'),
(3544, 'Onglyza', NULL, 'onglyza', 1476, '5', 41, 'MG', 219, 'One Tablet In The Morning After Meal', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:12', '2020-10-07 08:30:12'),
(3545, 'Sitagliptin', NULL, 'sitagliptin', 1472, '1', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:12', '2020-10-07 08:30:12'),
(3546, 'Orinase Met', NULL, 'orinase-met', 1526, '2/500', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:12', '2020-10-07 08:30:12'),
(3547, 'Orinase', NULL, 'orinase', 1526, '2/500', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:12', '2020-10-07 08:30:12'),
(3548, 'Qusil', NULL, 'qusil', 1526, '2/500', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 522, 'Psychosis', 1, NULL, '2020-10-07 08:30:12', '2020-10-07 08:30:12'),
(3549, 'Mixtard 70/30', NULL, 'mixtard-7030', 1473, '20', 44, 'Units', 240, 'Before Dinner', 21, '10 Days', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:12', '2020-10-07 08:30:12'),
(3550, 'Syp Inventive/drkoff', NULL, 'syp-inventivedrkoff', 1475, '10', 43, 'ML', 240, 'Before Dinner', 21, '10 Days', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:12', '2020-10-07 08:30:12'),
(3551, 'Prolexa', NULL, 'prolexa', 1475, '10', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:13', '2020-10-07 08:30:13'),
(3552, 'Ramipace', NULL, 'ramipace', 1476, '5', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:13', '2020-10-07 08:30:13'),
(3553, 'Clotrimazole Cream', NULL, 'clotrimazole-cream', 1754, 'Null', 64, 'NULL', 249, 'Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:13', '2020-10-07 08:30:13'),
(3555, 'Levopraid', NULL, 'levopraid', 1754, 'Null', 41, 'MG', 166, 'One Tablet Twice A Day Before Breakfast And Dinner', 21, '10 Days', 282, 'Irritable Bowel Syndrome', 1, NULL, '2020-10-07 08:30:13', '2020-10-07 08:30:13'),
(3556, 'Empaa-m', NULL, 'empaa-m', 1752, '12.5/500', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:13', '2020-10-07 08:30:13'),
(3557, 'Epliron', NULL, 'epliron', 1752, '12.5/500', 41, 'MG', 219, 'One Tablet In The Morning After Meal', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:13', '2020-10-07 08:30:13'),
(3558, 'Crestat', NULL, 'crestat', 1473, '20', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:30:13', '2020-10-07 08:30:13'),
(3559, 'Bone One', NULL, 'bone-one', 1483, '0.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:30:13', '2020-10-07 08:30:13'),
(3560, 'Hydralazine', NULL, 'hydralazine', 1474, '50', 41, 'MG', 108, 'One Tablet Thrice A Day', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:30:13', '2020-10-07 08:30:13'),
(3562, 'Montika', NULL, 'montika', 1475, '10', 41, 'MG', 238, 'One Tablet At Bed Time', 16, '2 Weeks', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:13', '2020-10-07 08:30:13'),
(3563, 'Gaviscon Advance', NULL, 'gaviscon-advance', 1793, '1000mg,200mg/10ml', 72, '10 ml', 249, 'Twice A Day', 21, '10 Days', 46, 'Stomach', 1, NULL, '2020-10-07 08:30:13', '2020-10-07 08:30:13'),
(3564, 'Qutyl-xr', NULL, 'qutyl-xr', 1534, '300', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 522, 'Psychosis', 1, NULL, '2020-10-07 08:30:13', '2020-10-07 08:30:13'),
(3565, 'Qutyl', NULL, 'qutyl', 1518, '100', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 522, 'Psychosis', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3566, 'Neurolith-sr', NULL, 'neurolith-sr', 1471, '400', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 524, 'Mania', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3567, 'Lortem', NULL, 'lortem', 1472, '1', 41, 'MG', 238, 'One Tablet At Bed Time', 16, '2 Weeks', 8, 'Anxiety', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3568, 'Co-apraise', NULL, 'co-apraise', 1535, '150/12.5', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 21, '10 Days', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3569, 'Maltofer', NULL, 'maltofer', 1794, '50 Mg/ml', 73, '2.5 ML', 244, 'Once Daily', 21, '10 Days', 5, 'Anemia', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3570, 'B Activ (unicare)', NULL, 'b-activ-unicare', 1475, '10', 71, 'DROPS', 244, 'Once Daily', 20, '2 Months', 38, 'Multivitamin', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3571, 'Abiclot Plus', NULL, 'abiclot-plus', 1795, '75,75', 41, 'MG', 219, 'One Tablet In The Morning After Meal', 21, '10 Days', 14, 'Blood Thinner', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3572, 'Nabiloc', NULL, 'nabiloc', 1795, '75,75', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3573, 'Cardiolite', NULL, 'cardiolite', 1518, '100', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3574, 'Onato', NULL, 'onato', 1476, '5', 41, 'MG', 112, 'One Tablet At Bedtime', 21, '10 Days', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3575, 'Insulin Pump', NULL, 'insulin-pump', 1754, 'Null', 64, 'NULL', 112, 'One Tablet At Bedtime', 21, '10 Days', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3576, 'Skilax', NULL, 'skilax', 1476, '5', 41, 'MG', 238, 'One Tablet At Bed Time', 21, '10 Days', 19, 'Constipation', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3577, 'Ulcenil', NULL, 'ulcenil', 1502, '40', 41, 'MG', 112, 'One Tablet At Bedtime', 21, '10 Days', 46, 'Stomach', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3578, 'Eltroxine', NULL, 'eltroxine', 1532, '125', 46, 'MCG', 175, 'One Tablet In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 4, 'Ongoing', 47, 'Thyroid', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3579, 'Fibo', NULL, 'fibo', 1796, 'One Sachet', 64, 'NULL', 209, 'One Capsule Twice A Day After Meal', 21, '10 Days', 19, 'Constipation', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3580, 'T-day', NULL, 't-day', 1476, '5', 41, 'MG', 112, 'One Tablet At Bedtime', 8, '5 Days', 4, 'Allergy', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3581, 'Levemir', NULL, 'levemir', 1489, '12', 44, 'Units', 145, 'In The Evening', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3582, 'Bionic', NULL, 'bionic', 1521, '150', 41, 'MG', 247, 'One Tablet On 1st Sunday Of Every Month On An Empty Stomach With 2 Glasses Of Water. Do Not Eat, Drink Or Lie Down For 1/2 Hour.', 4, 'Ongoing', 15, 'Bone Weakness', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3583, 'Triptal', NULL, 'triptal', 1534, '300', 41, 'MG', 186, 'One Tablet Thrice A Day Before Each Meal', 4, 'Ongoing', 436, 'Seizure Disorder', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3584, 'Diuza', NULL, 'diuza', 1534, '300', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3585, 'Glucovance', NULL, 'glucovance', 1749, '5/500', 41, 'MG', 186, 'One Tablet Thrice A Day Before Each Meal', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:14', '2020-10-07 08:30:14'),
(3600, 'Xultophy', NULL, 'xultophy', 1486, '4', 44, 'Units', 145, 'In The Evening', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:15', '2020-10-07 08:30:15'),
(3601, 'Sunny-d', NULL, 'sunny-d', 1486, '4', 53, 'IU', 250, 'One Capsule Every Sunday', 4, 'Ongoing', 56, 'Vitamin D', 1, NULL, '2020-10-07 08:30:16', '2020-10-07 08:30:16'),
(3602, 'Busron', NULL, 'busron', 1476, '5', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 522, 'Psychosis', 1, NULL, '2020-10-07 08:30:16', '2020-10-07 08:30:16'),
(3603, 'Lantus Solostart', NULL, 'lantus-solostart', 1489, '12', 44, 'Units', 145, 'In The Evening', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:16', '2020-10-07 08:30:16'),
(3604, 'Hydroshire', NULL, 'hydroshire', 1475, '10', 41, 'MG', 252, 'One Tablet In The Morning And One Tablet In The Afternoon', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:16', '2020-10-07 08:30:16'),
(3605, 'Florinef', NULL, 'florinef', 1475, '10', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:16', '2020-10-07 08:30:16'),
(3606, 'Phenzen', NULL, 'phenzen', 1518, '100', 41, 'MG', 160, 'One Capsule Thrice A Day', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:16', '2020-10-07 08:30:16'),
(3607, 'Zaqita', NULL, 'zaqita', 1479, '250', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:16', '2020-10-07 08:30:16'),
(3608, 'Dostinex', NULL, 'dostinex', 1483, '0.5', 41, 'MG', 169, 'One Tablet Twice A Week', 27, '24 Weeks', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:16', '2020-10-07 08:30:16'),
(3609, 'P-pride', NULL, 'p-pride', 1483, '0.5', 41, 'MG', 113, 'One Tablet In The Evening', 5, 'As Needed', 19, 'Constipation', 1, NULL, '2020-10-07 08:30:16', '2020-10-07 08:30:16'),
(3610, 'Dapamet', NULL, 'dapamet', 1751, '5/1000', 41, 'MG', 180, 'One Tablet With Lunch And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:16', '2020-10-07 08:30:16'),
(3611, 'Adoxa', NULL, 'adoxa', 1518, '100', 41, 'MG', 113, 'One Tablet In The Evening', 21, '10 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:30:16', '2020-10-07 08:30:16'),
(3612, 'Sita', NULL, 'sita', 1474, '50', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 21, '10 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:30:16', '2020-10-07 08:30:16'),
(3613, 'Sinaxamol', NULL, 'sinaxamol', 1551, '450', 41, 'MG', 253, 'Twice A Day As Needed For Pain', 28, 'As Needed For Pain', 33, 'Infection', 1, NULL, '2020-10-07 08:30:16', '2020-10-07 08:30:16'),
(3614, 'Cipram', NULL, 'cipram', 1473, '20', 41, 'MG', 112, 'One Tablet At Bedtime', 21, '10 Days', 21, 'Depression', 1, NULL, '2020-10-07 08:30:16', '2020-10-07 08:30:16'),
(3615, 'Mabil', NULL, 'mabil', 1570, '500', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 20, '2 Months', 519, 'Vitamin B', 1, NULL, '2020-10-07 08:30:16', '2020-10-07 08:30:16'),
(3616, 'Ramipril', NULL, 'ramipril', 1570, '500', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 20, '2 Months', 519, 'Vitamin B', 1, NULL, '2020-10-07 08:30:16', '2020-10-07 08:30:16'),
(3617, 'Rosuvastatin', NULL, 'rosuvastatin', 1570, '500', 41, 'MG', 238, 'One Tablet At Bed Time', 20, '2 Months', 519, 'Vitamin B', 1, NULL, '2020-10-07 08:30:17', '2020-10-07 08:30:17'),
(3618, 'Requip', NULL, 'requip', 1517, '0.25', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 43, 'Parkinsons Disease', 1, NULL, '2020-10-07 08:30:17', '2020-10-07 08:30:17'),
(3619, 'Nibovo', NULL, 'nibovo', 1475, '10', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:17', '2020-10-07 08:30:17'),
(3620, 'Hydrallin', NULL, 'hydrallin', 1620, '120 Ml', 41, 'MG', 245, 'Two Teaspoon Thrice A Day After Meal', 8, '5 Days', 20, 'Cough', 1, NULL, '2020-10-07 08:30:17', '2020-10-07 08:30:17'),
(3621, 'Saline Nebulization', NULL, 'saline-nebulization', 1524, '3', 41, 'MG', 249, 'Twice A Day', 15, '3 Days', 20, 'Cough', 1, NULL, '2020-10-07 08:30:17', '2020-10-07 08:30:17'),
(3623, 'Listerine Gargles', NULL, 'listerine-gargles', 1754, 'Null', 64, 'NULL', 249, 'Twice A Day', 15, '3 Days', 20, 'Cough', 1, NULL, '2020-10-07 08:30:17', '2020-10-07 08:30:17'),
(3624, 'Saline Gargels', NULL, 'saline-gargels', 1476, '5', 74, 'MINS', 249, 'Twice A Day', 8, '5 Days', 20, 'Cough', 1, NULL, '2020-10-07 08:30:18', '2020-10-07 08:30:18'),
(3625, 'Ventoline Nebulization', NULL, 'ventoline-nebulization', 1797, 'Ventolin Resp Sol 100mcg /20ml', 75, '100mcg/20ml', 249, 'Twice A Day', 8, '5 Days', 20, 'Cough', 1, NULL, '2020-10-07 08:30:18', '2020-10-07 08:30:18'),
(3626, 'Humalog Mix 25', NULL, 'humalog-mix-25', 1499, '34', 44, 'Units', 162, 'In The Morning', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:18', '2020-10-07 08:30:18'),
(3627, 'Simbex', NULL, 'simbex', 1798, '10, 20', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 18, 'Cholesterol', 1, NULL, '2020-10-07 08:30:18', '2020-10-07 08:30:18'),
(3628, 'Lantus', NULL, 'lantus', 1475, '10', 44, 'Units', 240, 'Before Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:18', '2020-10-07 08:30:18'),
(3629, 'P Pride', NULL, 'p-pride', 1475, '10', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:18', '2020-10-07 08:30:18'),
(3630, 'Apidra Solostar', NULL, 'apidra-solostar', 1486, '4', 44, 'Units', 239, 'Before Lunch', 21, '10 Days', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:18', '2020-10-07 08:30:18'),
(3631, 'Purpal', NULL, 'purpal', 1502, '40', 41, 'MG', 118, 'One Tablet In The Morning Before Breakfast', 21, '10 Days', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:18', '2020-10-07 08:30:18'),
(3632, 'Spingab', NULL, 'spingab', 1518, '100', 41, 'MG', 163, 'One Capsule At Bedtime', 4, 'Ongoing', 338, 'Neuropathy', 1, NULL, '2020-10-07 08:30:18', '2020-10-07 08:30:18'),
(3633, 'Betalok Zok', NULL, 'betalok-zok', 1518, '100', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:18', '2020-10-07 08:30:18'),
(3634, 'Angised', NULL, 'angised', 1483, '0.5', 41, 'MG', 254, 'Twice A Day As Needed', 21, '10 Days', 520, 'Angina', 1, NULL, '2020-10-07 08:30:18', '2020-10-07 08:30:18'),
(3635, 'Dormicum', NULL, 'dormicum', 1675, '7.5', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:18', '2020-10-07 08:30:18'),
(3636, 'Monis', NULL, 'monis', 1502, '40', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 21, '10 Days', 520, 'Angina', 1, NULL, '2020-10-07 08:30:18', '2020-10-07 08:30:18'),
(3637, 'Venofer', NULL, 'venofer', 1799, '100/5', 42, 'MG/ML', 255, 'One Injection In 100 Ml 0.9% Normal Saline Intravenously Over 15 Minutes X 1 Dose', 10, 'Once', 5, 'Anemia', 1, NULL, '2020-10-07 08:30:18', '2020-10-07 08:30:18'),
(3638, 'Rifaxa', NULL, 'rifaxa', 1737, '550', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 21, '10 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:30:18', '2020-10-07 08:30:18'),
(3639, 'Ryzodeg', NULL, 'ryzodeg', 1495, '26', 69, 'unit', 240, 'Before Dinner', 21, '10 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:30:19', '2020-10-07 08:30:19'),
(3640, 'Hepa-merz Syrup', NULL, 'hepa-merz-syrup', 1472, '1', 66, 'TSF', 246, 'Two Teaspoons Twice A Day After Meal', 21, '10 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:30:19', '2020-10-07 08:30:19'),
(3641, 'Acd + Drops', NULL, 'acd-drops', 1754, 'Null', 64, 'NULL', 246, 'Two Teaspoons Twice A Day After Meal', 21, '10 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:30:19', '2020-10-07 08:30:19'),
(3642, 'Myfol Drops', NULL, 'myfol-drops', 1754, 'Null', 64, 'NULL', 246, 'Two Teaspoons Twice A Day After Meal', 21, '10 Days', 33, 'Infection', 1, NULL, '2020-10-07 08:30:19', '2020-10-07 08:30:19'),
(3643, 'Coversam', NULL, 'coversam', 1800, '8mg,5mg', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:19', '2020-10-07 08:30:19'),
(3644, 'Evion', NULL, 'evion', 1478, '200', 41, 'MG', 163, 'One Capsule At Bedtime', 4, 'Ongoing', 55, 'Vitamin', 1, NULL, '2020-10-07 08:30:19', '2020-10-07 08:30:19'),
(3645, 'Zodip', NULL, 'zodip', 1476, '5', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:19', '2020-10-07 08:30:19'),
(3646, 'Purple', NULL, 'purple', 1473, '20', 41, 'MG', 166, 'One Tablet Twice A Day Before Breakfast And Dinner', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:30:19', '2020-10-07 08:30:19'),
(3647, 'Donecept', NULL, 'donecept', 1475, '10', 41, 'MG', 112, 'One Tablet At Bedtime', 21, '10 Days', 83, 'Alzheimers Disease', 1, NULL, '2020-10-07 08:30:19', '2020-10-07 08:30:19'),
(3648, 'Lomotil', NULL, 'lomotil', 1801, '2.5 ,0.025', 41, 'MG', 97, 'One Tablet Twice A Day', 5, 'As Needed', 23, 'Diarrhea', 1, NULL, '2020-10-07 08:30:19', '2020-10-07 08:30:19'),
(3649, 'Zeenaryl', NULL, 'zeenaryl', 1472, '1', 41, 'MG', 219, 'One Tablet In The Morning After Meal', 5, 'As Needed', 23, 'Diarrhea', 1, NULL, '2020-10-07 08:30:19', '2020-10-07 08:30:19'),
(3650, 'Liptin', NULL, 'liptin', 1474, '50', 41, 'MG', 112, 'One Tablet At Bedtime', 5, 'As Needed', 23, 'Diarrhea', 1, NULL, '2020-10-07 08:30:20', '2020-10-07 08:30:20'),
(3652, 'Easyday', NULL, 'easyday', 1754, 'Null', 64, 'NULL', 239, 'Before Lunch', 5, 'As Needed', 23, 'Diarrhea', 1, NULL, '2020-10-07 08:30:20', '2020-10-07 08:30:20'),
(3653, 'Zaroxolyn', NULL, 'zaroxolyn', 1476, '5', 41, 'MG', 256, 'Two Tablets In The Morning On An Empty Stomach At Least One Hour Before Breakfast', 5, 'As Needed', 23, 'Diarrhea', 1, NULL, '2020-10-07 08:30:20', '2020-10-07 08:30:20'),
(3654, 'Actifed Dm Syrup', NULL, 'actifed-dm-syrup', 1476, '5', 76, 'Spoon', 246, 'Two Teaspoons Twice A Day After Meal', 15, '3 Days', 23, 'Diarrhea', 1, NULL, '2020-10-07 08:30:20', '2020-10-07 08:30:20'),
(3655, 'Benzor Am', NULL, 'benzor-am', 1802, '5/20', 41, 'MG', 96, 'One Tablet In The Morning', 15, '3 Days', 23, 'Diarrhea', 1, NULL, '2020-10-07 08:30:20', '2020-10-07 08:30:20'),
(3656, 'Lipazti', NULL, 'lipazti', 1475, '10', 41, 'MG', 112, 'One Tablet At Bedtime', 15, '3 Days', 23, 'Diarrhea', 1, NULL, '2020-10-07 08:30:20', '2020-10-07 08:30:20'),
(3657, 'Co-olesta', NULL, 'co-olesta', 1602, '20/12.5', 41, 'MG', 96, 'One Tablet In The Morning', 15, '3 Days', 23, 'Diarrhea', 1, NULL, '2020-10-07 08:30:21', '2020-10-07 08:30:21'),
(3658, 'Fortum', NULL, 'fortum', 1472, '1', 55, 'GM', 110, 'One Injection Twice A Day', 21, '10 Days', 23, 'Diarrhea', 1, NULL, '2020-10-07 08:30:21', '2020-10-07 08:30:21'),
(3660, 'Supravit M', NULL, 'supravit-m', 1754, 'Null', 64, 'NULL', 101, 'One Tablet Daily', 4, 'Ongoing', 55, 'Vitamin', 1, NULL, '2020-10-07 08:30:21', '2020-10-07 08:30:21'),
(3661, 'Metliptin', NULL, 'metliptin', 1652, '50/500', 41, 'MG', 123, 'One Tablet In The Morning With Breakfast', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:21', '2020-10-07 08:30:21'),
(3662, 'Amsyn', NULL, 'amsyn', 1475, '10', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:21', '2020-10-07 08:30:21'),
(3663, 'Sante', NULL, 'sante', 1473, '20', 41, 'MG', 147, 'One Capsule In The Morning', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:21', '2020-10-07 08:30:21'),
(3664, 'Pediatral', NULL, 'pediatral', 1769, 'Sachet', 64, 'NULL', 244, 'Once Daily', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:21', '2020-10-07 08:30:21'),
(3665, 'Amyline', NULL, 'amyline', 1769, 'Sachet', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:21', '2020-10-07 08:30:21'),
(3666, 'Amstan', NULL, 'amstan', 1544, '160/5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:21', '2020-10-07 08:30:21'),
(3667, 'Paraxyl Cr', NULL, 'paraxyl-cr', 1581, '12.5', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:21', '2020-10-07 08:30:21'),
(3668, 'Laprazol', NULL, 'laprazol', 1497, '30', 41, 'MG', 164, 'One Capsule Before Breakfast And Dinner', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:22', '2020-10-07 08:30:22'),
(3669, 'Zivas', NULL, 'zivas', 1524, '3', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 36, 'Memory', 1, NULL, '2020-10-07 08:30:22', '2020-10-07 08:30:22'),
(3670, 'Xurin-k', NULL, 'xurin-k', 1483, '0.5', 64, 'NULL', 257, 'Two Tablets In The Morning', 4, 'Ongoing', 36, 'Memory', 1, NULL, '2020-10-07 08:30:22', '2020-10-07 08:30:22'),
(3671, 'Omega 3', NULL, 'omega-3', 1754, 'Null', 64, 'NULL', 257, 'Two Tablets In The Morning', 4, 'Ongoing', 36, 'Memory', 1, NULL, '2020-10-07 08:30:22', '2020-10-07 08:30:22'),
(3672, 'Vitamin D + 75ug K2', NULL, 'vitamin-d-75ug-k2', 1803, '3000', 53, 'IU', 257, 'Two Tablets In The Morning', 4, 'Ongoing', 36, 'Memory', 1, NULL, '2020-10-07 08:30:22', '2020-10-07 08:30:22'),
(3673, 'Actifed -dm Syp', NULL, 'actifed-dm-syp', 1803, '3000', 66, 'TSF', 245, 'Two Teaspoon Thrice A Day After Meal', 15, '3 Days', 20, 'Cough', 1, NULL, '2020-10-07 08:30:22', '2020-10-07 08:30:22'),
(3676, 'Immun+', NULL, 'immun', 1754, 'Null', 64, 'NULL', 209, 'One Capsule Twice A Day After Meal', 4, 'Ongoing', 20, 'Cough', 1, NULL, '2020-10-07 08:30:22', '2020-10-07 08:30:22'),
(3678, 'Exen-d Plus', NULL, 'exen-d-plus', 1754, 'Null', 64, 'NULL', 96, 'One Tablet In The Morning', 4, 'Ongoing', 20, 'Cough', 1, NULL, '2020-10-07 08:30:22', '2020-10-07 08:30:22'),
(3679, 'Co Enzyme Q 10', NULL, 'co-enzyme-q-10', 1472, '1', 47, 'Tab', 226, 'One Capsule In The Afternoon Before Lunch', 4, 'Ongoing', 20, 'Cough', 1, NULL, '2020-10-07 08:30:22', '2020-10-07 08:30:22'),
(3680, 'Peditral', NULL, 'peditral', 1754, 'Null', 64, 'NULL', 162, 'In The Morning', 4, 'Ongoing', 20, 'Cough', 1, NULL, '2020-10-07 08:30:22', '2020-10-07 08:30:22');
INSERT INTO `medications` (`id`, `title`, `generic_name`, `slug`, `dose_id`, `dose`, `unit_id`, `unit`, `frequency_id`, `frequency`, `duration_id`, `duration`, `diagnosis_type_id`, `diagnosis_type`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3681, 'Lipospheric Vit C', NULL, 'lipospheric-vit-c', 1754, 'Null', 64, 'NULL', 182, 'One Teaspoon Twice A Day After Meal', 4, 'Ongoing', 20, 'Cough', 1, NULL, '2020-10-07 08:30:22', '2020-10-07 08:30:22'),
(3682, 'Avsar', NULL, 'avsar', 1544, '160/5', 64, 'NULL', 96, 'One Tablet In The Morning', 4, 'Ongoing', 20, 'Cough', 1, NULL, '2020-10-07 08:30:23', '2020-10-07 08:30:23'),
(3686, 'Mixtard 30', NULL, 'mixtard-30', 1491, '16', 44, 'Units', 240, 'Before Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:23', '2020-10-07 08:30:23'),
(3688, 'Montiget', NULL, 'montiget', 1475, '10', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 11, 'Asthma', 1, NULL, '2020-10-07 08:30:23', '2020-10-07 08:30:23'),
(3689, 'Fefolvit', NULL, 'fefolvit', 1472, '1', 47, 'Tab', 244, 'Once Daily', 4, 'Ongoing', 55, 'Vitamin', 1, NULL, '2020-10-07 08:30:23', '2020-10-07 08:30:23'),
(3690, 'Omezol', NULL, 'omezol', 1502, '40', 41, 'MG', 109, 'Before Breakfast', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:30:23', '2020-10-07 08:30:23'),
(3691, 'Regain Xr', NULL, 'regain-xr', 1570, '500', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:23', '2020-10-07 08:30:23'),
(3692, 'Caprisk', NULL, 'caprisk', 1802, '5/20', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:23', '2020-10-07 08:30:23'),
(3693, 'Acebex', NULL, 'acebex', 1754, 'Null', 64, 'NULL', 164, 'One Capsule Before Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:23', '2020-10-07 08:30:23'),
(3694, 'Nebivol', NULL, 'nebivol', 1754, 'Null', 41, 'MG', 219, 'One Tablet In The Morning After Meal', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:24', '2020-10-07 08:30:24'),
(3695, 'Galzamet', NULL, 'galzamet', 1804, '850/50', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:24', '2020-10-07 08:30:24'),
(3696, 'Primrose Oil', NULL, 'primrose-oil', 1805, '1300', 64, 'NULL', 238, 'One Tablet At Bed Time', 20, '2 Months', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:24', '2020-10-07 08:30:24'),
(3697, 'Fefol Vit', NULL, 'fefol-vit', 1754, 'Null', 64, 'NULL', 238, 'One Tablet At Bed Time', 20, '2 Months', 5, 'Anemia', 1, NULL, '2020-10-07 08:30:24', '2020-10-07 08:30:24'),
(3699, 'Amaryl Msr', NULL, 'amaryl-msr', 1806, '2/1000', 41, 'MG', 96, 'One Tablet In The Morning', 20, '2 Months', 5, 'Anemia', 1, NULL, '2020-10-07 08:30:24', '2020-10-07 08:30:24'),
(3700, 'Covam', NULL, 'covam', 1629, '5/80', 41, 'MG', 224, 'Half Tablet In The Morning', 20, '2 Months', 5, 'Anemia', 1, NULL, '2020-10-07 08:30:24', '2020-10-07 08:30:24'),
(3701, 'Xatral Lp', NULL, 'xatral-lp', 1475, '10', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 44, 'Prostate', 1, NULL, '2020-10-07 08:30:24', '2020-10-07 08:30:24'),
(3702, 'Epuram', NULL, 'epuram', 1502, '40', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 44, 'Prostate', 1, NULL, '2020-10-07 08:30:24', '2020-10-07 08:30:24'),
(3703, 'Awardin Plus', NULL, 'awardin-plus', 1474, '50', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 55, 'Vitamin', 1, NULL, '2020-10-07 08:30:24', '2020-10-07 08:30:24'),
(3704, 'Pentoxol-m', NULL, 'pentoxol-m', 1807, '.5/10', 41, 'MG', 241, 'Two Tablets In The Evening', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:25', '2020-10-07 08:30:25'),
(3705, 'Nephramine', NULL, 'nephramine', 1472, '1', 47, 'Tab', 108, 'One Tablet Thrice A Day', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:25', '2020-10-07 08:30:25'),
(3706, 'Xylica', NULL, 'xylica', 1533, '75', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 41, 'Pain In Feet', 1, NULL, '2020-10-07 08:30:25', '2020-10-07 08:30:25'),
(3707, 'Exen D Plus', NULL, 'exen-d-plus', 1754, 'Null', 64, 'NULL', 113, 'One Tablet In The Evening', 4, 'Ongoing', 41, 'Pain In Feet', 1, NULL, '2020-10-07 08:30:25', '2020-10-07 08:30:25'),
(3711, 'Exotan', NULL, 'exotan', 1545, '80/5', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:25', '2020-10-07 08:30:25'),
(3712, 'Lodopin', NULL, 'lodopin', 1476, '5', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:25', '2020-10-07 08:30:25'),
(3713, 'Combavair', NULL, 'combavair', 1471, '400', 41, 'MG', 250, 'One Capsule Every Sunday', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:25', '2020-10-07 08:30:25'),
(3715, 'Apidra', NULL, 'apidra', 1489, '12', 44, 'Units', 240, 'Before Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:25', '2020-10-07 08:30:25'),
(3716, 'Glip', NULL, 'glip', 1486, '4', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:25', '2020-10-07 08:30:25'),
(3717, 'Safepram', NULL, 'safepram', 1475, '10', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:25', '2020-10-07 08:30:25'),
(3718, 'Zaline', NULL, 'zaline', 1474, '50', 41, 'MG', 112, 'One Tablet At Bedtime', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:26', '2020-10-07 08:30:26'),
(3719, 'Lexapro', NULL, 'lexapro', 1475, '10', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:26', '2020-10-07 08:30:26'),
(3720, 'K-oxalate Powder', NULL, 'k-oxalate-powder', 1808, '1/2', 78, 'TBS', 249, 'Twice A Day', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:26', '2020-10-07 08:30:26'),
(3721, 'Co-depricap', NULL, 'co-depricap', 1809, '6/25', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:26', '2020-10-07 08:30:26'),
(3722, 'Benzor-am', NULL, 'benzor-am', 1763, '20/5', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:26', '2020-10-07 08:30:26'),
(3723, 'Losar-k', NULL, 'losar-k', 1474, '50', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:26', '2020-10-07 08:30:26'),
(3724, 'Co-vam', NULL, 'co-vam', 1629, '5/80', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:26', '2020-10-07 08:30:26'),
(3725, 'Ogrel  Plus', NULL, 'ogrel-plus', 1762, '81', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 21, 'Depression', 1, NULL, '2020-10-07 08:30:27', '2020-10-07 08:30:27'),
(3726, 'Sowel', NULL, 'sowel', 1762, '81', 41, 'MG', 153, 'One Tablet Twice A Day After Meals', 4, 'Ongoing', 46, 'Stomach', 1, NULL, '2020-10-07 08:30:27', '2020-10-07 08:30:27'),
(3727, 'Jardiance', NULL, 'jardiance', 1762, '81', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:27', '2020-10-07 08:30:27'),
(3728, 'Neogab', NULL, 'neogab', 1534, '300', 41, 'MG', 238, 'One Tablet At Bed Time', 4, 'Ongoing', 41, 'Pain In Feet', 1, NULL, '2020-10-07 08:30:27', '2020-10-07 08:30:27'),
(3729, 'Diasar', NULL, 'diasar', 1629, '5/80', 41, 'MG', 97, 'One Tablet Twice A Day', 4, 'Ongoing', 12, 'Blood Pressure', 1, NULL, '2020-10-07 08:30:27', '2020-10-07 08:30:27'),
(3730, 'Kanlif', NULL, 'kanlif', 1534, '300', 41, 'MG', 96, 'One Tablet In The Morning', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:27', '2020-10-07 08:30:27'),
(3731, 'Mecovate', NULL, 'mecovate', 1570, '500', 41, 'MG', 185, 'One Tablet With Breakfast And Dinner', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:27', '2020-10-07 08:30:27'),
(3732, 'Xiona', NULL, 'xiona', 1475, '10', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:27', '2020-10-07 08:30:27'),
(3733, 'Laxante Forte', NULL, 'laxante-forte', 1748, 'Na', 65, 'NA', 113, 'One Tablet In The Evening', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:27', '2020-10-07 08:30:27'),
(3734, 'Laxante', NULL, 'laxante', 1810, '85', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:27', '2020-10-07 08:30:27'),
(3735, 'Diament', NULL, 'diament', 1810, '85', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:28', '2020-10-07 08:30:28'),
(3738, 'Regus', NULL, 'regus', 1518, '100', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:28', '2020-10-07 08:30:28'),
(3741, 'Uperio', NULL, 'uperio', 1518, '100', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:28', '2020-10-07 08:30:28'),
(3742, 'Lypo-spheric Vitamin C', NULL, 'lypo-spheric-vitamin-c', 1518, '100', 41, 'MG', 113, 'One Tablet In The Evening', 4, 'Ongoing', 22, 'Diabetes', 1, NULL, '2020-10-07 08:30:28', '2020-10-07 08:30:28'),
(3743, '001abc', 'abc', '001abc', 1472, '1', 41, 'MG', 95, 'Three Tablets In The Morning Before Meal', 4, 'Ongoing', 3, 'Acne', 1, '2021-01-27 07:56:34', '2021-01-27 07:33:27', '2021-01-27 07:56:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(11) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_04_03_094939_create_permissions_table', 1),
(4, '2020_04_03_095133_create_user_permissions_table', 1),
(5, '2020_04_03_095745_create_specialties_table', 1),
(7, '2020_04_06_113846_create_allergies_table', 1),
(8, '2020_04_06_114018_create_facilities_table', 1),
(9, '2020_04_06_114019_create_qualifications_table', 1),
(10, '2020_04_06_114151_create_clinics_table', 1),
(11, '2020_04_06_114801_create_clinic_specialties_table', 1),
(12, '2020_04_06_115058_create_clinic_facilities_table', 1),
(13, '2020_04_06_115349_create_practitioners_table', 1),
(14, '2020_04_06_115641_create_practitioner_specialties_table', 1),
(16, '2020_04_06_120850_create_patients_table', 1),
(17, '2020_04_06_121459_create_patient_reports_table', 1),
(18, '2020_04_06_121904_create_patient_prescriptions_table', 1),
(19, '2020_04_06_124723_create_notifications_table', 1),
(20, '2020_04_06_130355_create_appointments_table', 1),
(21, '2020_04_06_130752_create_payments_table', 1),
(22, '2020_04_07_042313_create_prescription_medications_table', 1),
(24, '2020_04_20_050512_create_prescription_allergies_table', 1),
(25, '2020_08_28_111833_create_diseases_table', 1),
(26, '2020_08_28_112236_create_surgeries_table', 1),
(27, '2020_08_28_112354_create_relations_table', 1),
(28, '2020_08_28_112457_create_physical_exams_table', 1),
(29, '2020_08_28_112833_create_drugs_table', 1),
(30, '2020_08_28_112954_create_reactions_table', 1),
(31, '2020_08_28_113246_create_doses_table', 1),
(32, '2020_08_28_113603_create_units_table', 1),
(33, '2020_08_28_113640_create_frequencies_table', 1),
(34, '2020_08_28_113715_create_durations_table', 1),
(35, '2020_08_28_120701_create_diagnosis_types_table', 1),
(37, '2020_08_28_120931_create_templates_table', 1),
(38, '2020_08_28_121552_create_referral_practitioners_table', 1),
(39, '2020_08_28_123209_create_favourite_labs_table', 1),
(40, '2020_08_28_123902_create_patient_visits_table', 1),
(41, '2020_08_28_125520_create_patient_vitals_table', 1),
(42, '2020_08_28_144349_create_patient_templates_table', 1),
(43, '2020_08_28_145112_create_past_medical_histories_table', 1),
(44, '2020_08_28_151023_create_past_surgical_histories_table', 1),
(45, '2020_08_28_151517_create_family_medical_histories_table', 1),
(46, '2020_08_28_152201_create_physical_examinations_table', 1),
(47, '2020_08_28_152646_create_histories_table', 1),
(48, '2020_08_28_153100_create_smoking_histories_table', 1),
(49, '2020_08_28_154702_create_review_systems_table', 1),
(50, '2020_08_28_155733_create_patient_lab_tests_table', 1),
(51, '2020_08_28_160847_create_patient_referral_practitioners_table', 1),
(52, '2020_08_28_161620_create_patient_attachments_table', 1),
(54, '2020_08_28_164451_create_patient_medications_table', 1),
(55, '2020_08_28_165747_create_patient_special_dosages_table', 1),
(56, '2020_08_28_170154_create_configurations_table', 1),
(57, '2020_08_28_173625_create_rx_medicines_table', 1),
(58, '2020_08_28_174954_create_adrs_table', 1),
(59, '2020_09_02_161941_create_patient_types_table', 2),
(60, '2020_09_03_124206_create_assistants_table', 3),
(61, '2020_09_03_144905_create_assistant_specialties_table', 3),
(62, '2020_09_03_161038_create_practitioner_assistants_table', 4),
(63, '2020_09_07_111118_create_patient_allergies_table', 5),
(64, '2020_09_07_111159_create_patient_drugs_table', 5),
(65, '2020_08_28_162455_create_patient_sugar_charts_table', 6),
(66, '2020_09_08_124942_create_patient_visit_prescriptions_table', 7),
(67, '2020_09_07_150520_create_departments_table', 8),
(68, '2020_09_07_153658_create_hospitals_table', 8),
(69, '2020_04_06_115843_create_practitioner_clinics_table', 9),
(70, '2020_04_17_062104_create_practitioner_clinic_days_table', 9),
(71, '2020_04_06_113845_create_medications_table', 10),
(72, '2020_09_14_163731_create_practitioner_lab_tests_table', 11),
(73, '2020_08_27_121121_create_labs_table', 12),
(74, '2020_09_29_112944_create_clinic_departments_table', 13),
(75, '2020_11_12_123550_create_lab_test_types_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `message`, `user_type`, `user_id`, `is_read`, `created_at`, `updated_at`) VALUES
(28, 'Patient Account Request', 'Please check out patient list to approve the request for ', 4, 0, 0, '2020-11-27 13:01:52', '2020-11-27 13:01:52'),
(29, 'Patient Account Request', 'Please check out patient list to approve the request for ', 4, 0, 0, '2020-11-27 13:08:01', '2020-11-27 13:08:01'),
(30, 'Assistant Account Request', 'Please check out practitioner list to approve the request for test@gmail.com', 4, 0, 0, '2020-12-01 12:34:53', '2020-12-01 12:34:53'),
(31, 'Assistant Account Request', 'Please check out assistant list to approve the request for test1@gmail.com', 4, 0, 0, '2020-12-01 12:42:53', '2020-12-01 12:42:53'),
(32, 'Assistant Account Request', 'Please check out assistant list to approve the request for waqas@gmail.com', 4, 0, 0, '2020-12-10 10:16:31', '2020-12-10 10:16:31'),
(33, 'Assistant Account Request', 'Please check out assistant list to approve the request for waqas1@gmail.com', 4, 0, 0, '2020-12-10 11:22:45', '2020-12-10 11:22:45'),
(34, 'Patient Account Request', 'Please check out patient list to approve the request for vickyrana4433@gmail.com', 1, 24, 0, '2021-01-25 07:40:25', '2021-01-25 07:40:25'),
(35, 'Practitioner Account Request', 'Please check out practitioner list to approve the request for waqas@gmail.com', 2, 0, 0, '2021-04-06 07:08:58', '2021-04-06 07:08:58');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('vickyrana4433@gmail.com', '$2y$10$WS3wJJYGDN6F1QBtLtpoZucW6bn81jCKwXpvnQxNTcWPpWDgHvJG6', '2021-01-25 07:51:25'),
('waqas1@gmail.com', '$2y$10$GGIhjM8JPkyMGRPZjlRn7.wIoaqlRbkGmZTb.lXN9ys7YWQt6btja', '2021-03-17 07:53:27'),
('abdullah.tektiks@gmail.com', '$2y$10$pQp8Ns.nu3cfOfIU01Cgr.VtdR1/aRhtpBEtJcAbdbOnJ1YYDN6FS', '2021-04-06 10:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `past_medical_histories`
--

CREATE TABLE `past_medical_histories` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_visit_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `patient_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disease_id` int(11) UNSIGNED NOT NULL,
  `disease_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_years` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `past_medical_histories`
--

INSERT INTO `past_medical_histories` (`id`, `patient_visit_id`, `practitioner_id`, `practitioner_name`, `patient_id`, `patient_name`, `disease_id`, `disease_name`, `no_of_years`, `year`, `remarks`, `created_at`, `updated_at`) VALUES
(13, 95, 10, 'Dr. Abdullah', 24, 'Mr. John Doe', 6, 'Abdominal Pain', 2020, NULL, 'dddd', '2021-03-24 06:40:12', '2021-03-24 06:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `past_surgical_histories`
--

CREATE TABLE `past_surgical_histories` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_visit_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `patient_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surgery_id` int(11) UNSIGNED NOT NULL,
  `surgery_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_years` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `past_surgical_histories`
--

INSERT INTO `past_surgical_histories` (`id`, `patient_visit_id`, `practitioner_id`, `practitioner_name`, `patient_id`, `patient_name`, `surgery_id`, `surgery_name`, `no_of_years`, `year`, `remarks`, `created_at`, `updated_at`) VALUES
(5, 95, 10, 'Dr. Abdullah', 24, 'Mr. John Doe', 5, 'Above Knee Amputation Bilateral', 2020, NULL, 'asdasd', '2021-03-24 06:40:22', '2021-03-24 06:40:22');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) UNSIGNED NOT NULL,
  `mr_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_type_id` int(11) UNSIGNED DEFAULT NULL,
  `patient_type_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `weight_kgs` double(8,2) DEFAULT NULL,
  `weight_lbs` double(8,2) DEFAULT NULL,
  `height_ft` double(8,2) DEFAULT NULL,
  `height_in` double(8,2) DEFAULT NULL,
  `height_cms` double(8,2) DEFAULT NULL,
  `marital_status` enum('Single','Married') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Single',
  `hospitalization` tinyint(1) NOT NULL DEFAULT 0,
  `currently_on_drug` tinyint(1) NOT NULL DEFAULT 0,
  `payment_status` enum('Unpaid','Paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unpaid',
  `time_waste_flag_condition` tinyint(1) NOT NULL DEFAULT 0,
  `critical_flag_condition` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `mr_number`, `patient_type_id`, `patient_type_title`, `name`, `email`, `phone`, `image`, `address`, `gender`, `password`, `dob`, `age`, `weight_kgs`, `weight_lbs`, `height_ft`, `height_in`, `height_cms`, `marital_status`, `hospitalization`, `currently_on_drug`, `payment_status`, `time_waste_flag_condition`, `critical_flag_condition`, `status`, `remember_token`, `last_login`, `token`, `device_type`, `created_at`, `updated_at`) VALUES
(24, '90292155', 1, 'Patient Type 1', 'Mr. John Doe', 'abdullah.tektiks@gmail.com', '0305-4466311', 'patientImage/OU7wu8TGatK2RthIpnzr2SuzGGb5IYma92o1cdpZ.png', 'Test Address', 1, '$2y$10$pA651LIbDflrQsrlfVWos.OtjijGhaGc6VvA7Lq5iUR5.126Ka1ZS', '1977-01-01', 43, 50.00, 0.00, 5.00, 6.00, 0.00, 'Single', 1, 0, 'Unpaid', 1, 0, 1, NULL, '2021-04-13 10:51:07', 'c6qPHQZzQNeoTgQjS-u8-O:APA91bHbRgRc0ZHrbIe2I-NGNF5NKaxKOn_EPdCoeoCBnuXb61woCdIvE1tIHpsXwwaGET7MlE2AaN1trL6SfxltruWNTwpiyf_YxUBT8Ljbys3MgGmOLYWeMDarZuf0df1xOdTOQtpf', NULL, '2020-09-07 10:25:54', '2021-04-13 05:51:07'),
(25, '63938891', 1, 'Patient Type 1', 'Muhammad Haroon', 'haroon@gmail.com', '0305-446631', 'patientImage/nbmOBOt3SiMsmxwpGpjil1dak4WZSc5P4dVufPM7.png', 'Test', 1, '$2y$10$3W0n1LgsRquHfzBKuw0LW.z4BuuLRybqXcNWoUe1Q7sqZNwTfPZgO', '2020-09-02', 12, 50.00, 0.00, 5.40, NULL, NULL, 'Single', 1, 0, 'Unpaid', 1, 0, 1, NULL, NULL, 'asdfjgjkaskdhf', NULL, '2020-09-08 10:13:15', '2020-10-09 23:38:10'),
(34, '76831434', NULL, NULL, 'Muhammad Waqas', 'waqas@gmail.com', '0312-3769495', NULL, NULL, 1, '$2y$10$W9VtfBzOQc3dyEi0/yZZp.hps/jivYCfvwJu1fll4biRdOKet29hO', '2000-02-01', 20, 55.00, NULL, 5.00, 4.00, NULL, 'Single', 0, 0, 'Unpaid', 1, 0, 1, NULL, NULL, 'asdhgfjhdfk', NULL, '2020-10-08 18:26:02', '2020-12-11 09:53:42'),
(67, '31400184', 3, NULL, 'M Waqas', 'waqas1@gmail.com', '03123769495', 'patientImages/VCqsqDDf4SxBlN0lxgWaeDx992gh2hrT4phbQjcS.png', 'Testing Address', 1, '$2y$10$q4OCWVu1ZqaGxH6bvVMD7OLYbpPUF2JFx/ndGe5dF.9xi428PcpzC', '2000-03-25', 20, 65.00, NULL, 5.00, 11.00, NULL, 'Single', 0, 1, 'Unpaid', 0, 0, 1, NULL, '2021-03-22 11:15:16', NULL, NULL, '2021-03-22 06:15:16', '2021-03-22 08:03:39');

-- --------------------------------------------------------

--
-- Table structure for table `patient_allergies`
--

CREATE TABLE `patient_allergies` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `allergy_id` int(11) UNSIGNED NOT NULL,
  `allergy_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_allergies`
--

INSERT INTO `patient_allergies` (`id`, `patient_id`, `allergy_id`, `allergy_title`, `created_at`, `updated_at`) VALUES
(56, 67, 4, 'Allergy 1', '2021-03-22 07:50:58', '2021-03-22 07:50:58'),
(57, 67, 5, 'Allergy 2', '2021-03-22 07:50:58', '2021-03-22 07:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `patient_attachments`
--

CREATE TABLE `patient_attachments` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_visit_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `patient_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Lab','Invoice','Other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Lab',
  `attachment_file_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_drugs`
--

CREATE TABLE `patient_drugs` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `drug_id` int(11) UNSIGNED NOT NULL,
  `drug_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_drugs`
--

INSERT INTO `patient_drugs` (`id`, `patient_id`, `drug_id`, `drug_title`, `created_at`, `updated_at`) VALUES
(65, 67, 6, 'Alendronate', '2021-03-22 07:50:58', '2021-03-22 07:50:58'),
(66, 67, 7, 'Allopurinol', '2021-03-22 07:50:58', '2021-03-22 07:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `patient_lab_tests`
--

CREATE TABLE `patient_lab_tests` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_visit_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `patient_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lab_test_id` int(11) UNSIGNED NOT NULL,
  `lab_test_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fasting` tinyint(1) NOT NULL DEFAULT 0,
  `instructions` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recommended_lab` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_lab_tests`
--

INSERT INTO `patient_lab_tests` (`id`, `patient_visit_id`, `practitioner_id`, `practitioner_name`, `patient_id`, `patient_name`, `lab_test_id`, `lab_test_name`, `type_id`, `fasting`, `instructions`, `recommended_lab`, `created_at`, `updated_at`) VALUES
(73, 95, 10, 'Dr. Abdullah', 24, 'Mr. John Doe', 644, 'Chest X-ray', NULL, 0, NULL, 8, '2021-03-24 06:41:52', '2021-03-24 06:41:52'),
(74, 95, 10, 'Dr. Abdullah', 24, 'Mr. John Doe', 625, '24 Hour Urine For Protein Excretion', NULL, 0, NULL, 8, '2021-03-24 06:41:53', '2021-03-24 06:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `patient_medications`
--

CREATE TABLE `patient_medications` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_visit_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `patient_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medicine_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dosage` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intake` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diet` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condition` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_instructions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_prescriptions`
--

CREATE TABLE `patient_prescriptions` (
  `id` int(11) UNSIGNED NOT NULL,
  `illness_history` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vital_assessments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clinical_examinations` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presenting_complaints` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagnosis` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `investigations` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family_history` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `follow_up` date DEFAULT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `clinic_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_referral_practitioners`
--

CREATE TABLE `patient_referral_practitioners` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_visit_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `patient_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral_practitioner_id` int(11) UNSIGNED NOT NULL,
  `referral_practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_reports`
--

CREATE TABLE `patient_reports` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `image_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_reports`
--

INSERT INTO `patient_reports` (`id`, `title`, `type`, `image_url`, `patient_id`, `created_at`, `updated_at`) VALUES
(114, '121-Invoice', 1, 'reportImages/121.pdf', 34, '2021-04-01 10:32:47', '2021-04-01 10:32:47'),
(115, '123-Invoice', 1, 'reportImages/123.pdf', 24, '2021-04-13 06:57:31', '2021-04-13 06:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `patient_special_dosages`
--

CREATE TABLE `patient_special_dosages` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_medication_id` int(11) UNSIGNED NOT NULL,
  `dosage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `special_instructions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_sugar_charts`
--

CREATE TABLE `patient_sugar_charts` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_visit_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `patient_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_1_before_breakfast` tinyint(1) NOT NULL DEFAULT 0,
  `day_1_2_hours_after_breakfast` tinyint(1) NOT NULL DEFAULT 0,
  `day_1_before_lunch` tinyint(1) NOT NULL DEFAULT 0,
  `day_1_2_hours_after_lunch` tinyint(1) NOT NULL DEFAULT 0,
  `day_1_before_dinner` tinyint(1) NOT NULL DEFAULT 0,
  `day_1_2_hours_after_dinner` tinyint(1) NOT NULL DEFAULT 0,
  `day_1_bed_time` tinyint(1) NOT NULL DEFAULT 0,
  `day_1_at_3_am` tinyint(1) NOT NULL DEFAULT 0,
  `day_2_before_breakfast` tinyint(1) NOT NULL DEFAULT 0,
  `day_2_2_hours_after_breakfast` tinyint(1) NOT NULL DEFAULT 0,
  `day_2_before_lunch` tinyint(1) NOT NULL DEFAULT 0,
  `day_2_2_hours_after_lunch` tinyint(1) NOT NULL DEFAULT 0,
  `day_2_before_dinner` tinyint(1) NOT NULL DEFAULT 0,
  `day_2_2_hours_after_dinner` tinyint(1) NOT NULL DEFAULT 0,
  `day_2_bed_time` tinyint(1) NOT NULL DEFAULT 0,
  `day_2_at_3_am` tinyint(1) NOT NULL DEFAULT 0,
  `day_3_before_breakfast` tinyint(1) NOT NULL DEFAULT 0,
  `day_3_2_hours_after_breakfast` tinyint(1) NOT NULL DEFAULT 0,
  `day_3_before_lunch` tinyint(1) NOT NULL DEFAULT 0,
  `day_3_2_hours_after_lunch` tinyint(1) NOT NULL DEFAULT 0,
  `day_3_before_dinner` tinyint(1) NOT NULL DEFAULT 0,
  `day_3_2_hours_after_dinner` tinyint(1) NOT NULL DEFAULT 0,
  `day_3_bed_time` tinyint(1) NOT NULL DEFAULT 0,
  `day_3_at_3_am` tinyint(1) NOT NULL DEFAULT 0,
  `day_4_before_breakfast` tinyint(1) NOT NULL DEFAULT 0,
  `day_4_2_hours_after_breakfast` tinyint(1) NOT NULL DEFAULT 0,
  `day_4_before_lunch` tinyint(1) NOT NULL DEFAULT 0,
  `day_4_2_hours_after_lunch` tinyint(1) NOT NULL DEFAULT 0,
  `day_4_before_dinner` tinyint(1) NOT NULL DEFAULT 0,
  `day_4_2_hours_after_dinner` tinyint(1) NOT NULL DEFAULT 0,
  `day_4_bed_time` tinyint(1) NOT NULL DEFAULT 0,
  `day_4_at_3_am` tinyint(1) NOT NULL DEFAULT 0,
  `day_5_before_breakfast` tinyint(1) NOT NULL DEFAULT 0,
  `day_5_2_hours_after_breakfast` tinyint(1) NOT NULL DEFAULT 0,
  `day_5_before_lunch` tinyint(1) NOT NULL DEFAULT 0,
  `day_5_2_hours_after_lunch` tinyint(1) NOT NULL DEFAULT 0,
  `day_5_before_dinner` tinyint(1) NOT NULL DEFAULT 0,
  `day_5_2_hours_after_dinner` tinyint(1) NOT NULL DEFAULT 0,
  `day_5_bed_time` tinyint(1) NOT NULL DEFAULT 0,
  `day_5_at_3_am` tinyint(1) NOT NULL DEFAULT 0,
  `day_6_before_breakfast` tinyint(1) NOT NULL DEFAULT 0,
  `day_6_2_hours_after_breakfast` tinyint(1) NOT NULL DEFAULT 0,
  `day_6_before_lunch` tinyint(1) NOT NULL DEFAULT 0,
  `day_6_2_hours_after_lunch` tinyint(1) NOT NULL DEFAULT 0,
  `day_6_before_dinner` tinyint(1) NOT NULL DEFAULT 0,
  `day_6_2_hours_after_dinner` tinyint(1) NOT NULL DEFAULT 0,
  `day_6_bed_time` tinyint(1) NOT NULL DEFAULT 0,
  `day_6_at_3_am` tinyint(1) NOT NULL DEFAULT 0,
  `day_7_before_breakfast` tinyint(1) NOT NULL DEFAULT 0,
  `day_7_2_hours_after_breakfast` tinyint(1) NOT NULL DEFAULT 0,
  `day_7_before_lunch` tinyint(1) NOT NULL DEFAULT 0,
  `day_7_2_hours_after_lunch` tinyint(1) NOT NULL DEFAULT 0,
  `day_7_before_dinner` tinyint(1) NOT NULL DEFAULT 0,
  `day_7_2_hours_after_dinner` tinyint(1) NOT NULL DEFAULT 0,
  `day_7_bed_time` tinyint(1) NOT NULL DEFAULT 0,
  `day_7_at_3_am` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_sugar_charts`
--

INSERT INTO `patient_sugar_charts` (`id`, `patient_visit_id`, `practitioner_id`, `practitioner_name`, `patient_id`, `patient_name`, `day_1_before_breakfast`, `day_1_2_hours_after_breakfast`, `day_1_before_lunch`, `day_1_2_hours_after_lunch`, `day_1_before_dinner`, `day_1_2_hours_after_dinner`, `day_1_bed_time`, `day_1_at_3_am`, `day_2_before_breakfast`, `day_2_2_hours_after_breakfast`, `day_2_before_lunch`, `day_2_2_hours_after_lunch`, `day_2_before_dinner`, `day_2_2_hours_after_dinner`, `day_2_bed_time`, `day_2_at_3_am`, `day_3_before_breakfast`, `day_3_2_hours_after_breakfast`, `day_3_before_lunch`, `day_3_2_hours_after_lunch`, `day_3_before_dinner`, `day_3_2_hours_after_dinner`, `day_3_bed_time`, `day_3_at_3_am`, `day_4_before_breakfast`, `day_4_2_hours_after_breakfast`, `day_4_before_lunch`, `day_4_2_hours_after_lunch`, `day_4_before_dinner`, `day_4_2_hours_after_dinner`, `day_4_bed_time`, `day_4_at_3_am`, `day_5_before_breakfast`, `day_5_2_hours_after_breakfast`, `day_5_before_lunch`, `day_5_2_hours_after_lunch`, `day_5_before_dinner`, `day_5_2_hours_after_dinner`, `day_5_bed_time`, `day_5_at_3_am`, `day_6_before_breakfast`, `day_6_2_hours_after_breakfast`, `day_6_before_lunch`, `day_6_2_hours_after_lunch`, `day_6_before_dinner`, `day_6_2_hours_after_dinner`, `day_6_bed_time`, `day_6_at_3_am`, `day_7_before_breakfast`, `day_7_2_hours_after_breakfast`, `day_7_before_lunch`, `day_7_2_hours_after_lunch`, `day_7_before_dinner`, `day_7_2_hours_after_dinner`, `day_7_bed_time`, `day_7_at_3_am`, `created_at`, `updated_at`) VALUES
(33, 95, 10, 'Dr. Abdullah', 24, 'Mr. John Doe', 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '2021-03-24 06:41:55', '2021-03-24 06:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `patient_templates`
--

CREATE TABLE `patient_templates` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_visit_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `patient_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_types`
--

CREATE TABLE `patient_types` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_percentage` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_types`
--

INSERT INTO `patient_types` (`id`, `title`, `discount_percentage`, `start_date`, `end_date`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Walk-In', 0, NULL, NULL, 1, NULL, '2020-09-02 11:43:31', '2020-10-14 14:32:38'),
(3, 'General', 0, NULL, NULL, 1, NULL, '2020-09-02 11:58:47', '2020-10-14 14:32:09'),
(4, 'Protocol 100', 100, NULL, NULL, 1, NULL, '2020-10-14 16:50:06', '2020-10-14 16:50:06');

-- --------------------------------------------------------

--
-- Table structure for table `patient_visits`
--

CREATE TABLE `patient_visits` (
  `id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `patient_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appointment_id` int(11) UNSIGNED NOT NULL,
  `visit_number` int(11) NOT NULL,
  `payment_status` enum('Unpaid','Paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unpaid',
  `total_duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes_internal` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes_printed` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revise_of` date DEFAULT NULL,
  `next_visit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `next_visit_date` date DEFAULT NULL,
  `pdf_report` varchar(251) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_visits`
--

INSERT INTO `patient_visits` (`id`, `practitioner_id`, `practitioner_name`, `patient_id`, `patient_name`, `appointment_id`, `visit_number`, `payment_status`, `total_duration`, `notes_internal`, `notes_printed`, `revise_of`, `next_visit`, `next_visit_date`, `pdf_report`, `status`, `created_at`, `updated_at`) VALUES
(95, 10, 'Dr. Abdullah', 24, 'Mr. John Doe', 119, 1, 'Unpaid', '03:31', 'Testing  .........', 'Testing  .........', NULL, NULL, NULL, NULL, 0, '2021-03-24 06:39:30', '2021-03-24 06:51:31'),
(96, 10, 'Dr. Abdullah', 34, 'Muhammad Waqas', 121, 1, 'Unpaid', '25:59', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-04-01 10:32:42', '2021-04-13 05:32:05'),
(97, 10, 'Dr. Abdullah', 24, 'Mr. John Doe', 122, 2, 'Unpaid', '56:12', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-04-13 05:56:21', '2021-04-13 06:56:47'),
(98, 10, 'Dr. Abdullah', 24, 'Mr. John Doe', 123, 1, 'Unpaid', '00:37', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-04-13 06:57:24', '2021-04-13 07:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `patient_visit_prescriptions`
--

CREATE TABLE `patient_visit_prescriptions` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_visit_id` int(11) UNSIGNED NOT NULL,
  `prescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_visit_prescriptions`
--

INSERT INTO `patient_visit_prescriptions` (`id`, `patient_visit_id`, `prescription`, `created_at`, `updated_at`) VALUES
(30, 95, '<p>Hello This is my Testing</p>', '2021-03-24 06:41:34', '2021-03-24 06:41:34');

-- --------------------------------------------------------

--
-- Table structure for table `patient_vitals`
--

CREATE TABLE `patient_vitals` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_visit_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `patient_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bp_sys` int(11) DEFAULT NULL,
  `bp_dias` int(11) DEFAULT NULL,
  `pulse` int(11) DEFAULT NULL,
  `weight_lbs` double(8,2) DEFAULT NULL,
  `weight_kgs` double(8,2) DEFAULT NULL,
  `height_ft` int(11) DEFAULT NULL,
  `height_in` int(11) DEFAULT NULL,
  `height_cms` int(11) DEFAULT NULL,
  `bmi` int(11) DEFAULT NULL,
  `bsf` int(11) DEFAULT NULL,
  `bsr` int(11) DEFAULT NULL,
  `bp_sys_2` int(11) DEFAULT NULL,
  `bp_dias_2` int(11) DEFAULT NULL,
  `pulse_2` int(11) DEFAULT NULL,
  `weight_lbs_2` double(8,2) DEFAULT NULL,
  `weight_kgs_2` double(8,2) DEFAULT NULL,
  `height_ft_2` int(11) DEFAULT NULL,
  `height_in_2` int(11) DEFAULT NULL,
  `height_cms_2` int(11) DEFAULT NULL,
  `bmi_2` int(11) DEFAULT NULL,
  `bsf_2` int(11) DEFAULT NULL,
  `bsr_2` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_vitals`
--

INSERT INTO `patient_vitals` (`id`, `patient_visit_id`, `practitioner_id`, `practitioner_name`, `patient_id`, `patient_name`, `bp_sys`, `bp_dias`, `pulse`, `weight_lbs`, `weight_kgs`, `height_ft`, `height_in`, `height_cms`, `bmi`, `bsf`, `bsr`, `bp_sys_2`, `bp_dias_2`, `pulse_2`, `weight_lbs_2`, `weight_kgs_2`, `height_ft_2`, `height_in_2`, `height_cms_2`, `bmi_2`, `bsf_2`, `bsr_2`, `created_at`, `updated_at`) VALUES
(31, 95, 10, 'Dr. Abdullah', 24, 'Mr. John Doe', 120, 80, 90, NULL, 65.00, 5, 7, NULL, 22, 100, 120, 116, 78, 80, NULL, 64.00, 5, 6, NULL, 23, 140, 120, '2021-03-24 06:40:55', '2021-03-24 06:41:16');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `patient_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `appointment_id` int(11) UNSIGNED NOT NULL,
  `payment_type` tinyint(1) DEFAULT 0,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` enum('Online','Cash') COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` enum('Paid','Unpaid') COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_ref_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `date`, `patient_id`, `practitioner_id`, `appointment_id`, `payment_type`, `transaction_id`, `amount`, `payment_method`, `payment_status`, `transaction_ref_number`, `created_at`, `updated_at`) VALUES
(7, '2020-10-08 05:35:52', 24, 10, 9, 0, '49986332', '2000', 'Cash', 'Paid', NULL, '2020-10-08 05:35:52', '2020-12-21 06:40:31'),
(8, '2020-10-08 18:21:03', 33, 10, 10, 0, '49226230', '2200', 'Cash', 'Unpaid', NULL, '2020-10-08 18:21:03', '2020-11-11 07:22:06'),
(9, '2020-10-08 18:27:06', 34, 10, 11, 0, '92856639', '2200', 'Cash', 'Unpaid', NULL, '2020-10-08 18:27:06', '2020-10-08 18:27:06'),
(10, '2020-10-08 18:30:18', 35, 10, 12, 0, '25422961', '2000', 'Cash', 'Unpaid', NULL, '2020-10-08 18:30:18', '2020-10-08 18:30:18'),
(11, '2020-10-08 18:32:15', 34, 10, 13, 0, '19662790', '2200', 'Cash', 'Paid', NULL, '2020-10-08 18:32:15', '2020-10-08 18:32:15'),
(12, '2020-10-08 18:34:38', 34, 10, 14, 0, '53406743', '2000', 'Cash', 'Paid', NULL, '2020-10-08 18:34:38', '2020-10-08 18:34:38'),
(13, '2020-10-08 18:36:21', 34, 10, 15, 0, '59436665', '2200', 'Cash', 'Paid', NULL, '2020-10-08 18:36:21', '2020-10-08 18:36:21'),
(14, '2020-10-08 18:38:19', 34, 10, 16, 0, '34429747', '2200', 'Cash', 'Paid', NULL, '2020-10-08 18:38:19', '2020-10-08 18:38:19'),
(15, '2020-10-08 18:47:44', 35, 10, 17, 0, '30539923', '2200', 'Cash', 'Paid', NULL, '2020-10-08 18:47:44', '2020-10-08 18:47:44'),
(16, '2020-10-08 18:50:18', 34, 10, 18, 0, '76286767', '2200', 'Cash', 'Paid', NULL, '2020-10-08 18:50:18', '2020-10-08 18:50:18'),
(17, '2020-10-08 18:52:03', 34, 10, 19, 0, '53991579', '2000', 'Cash', 'Paid', NULL, '2020-10-08 18:52:03', '2020-10-08 18:52:03'),
(18, '2020-10-08 19:12:05', 36, 10, 20, 0, '73306701', '2000', 'Cash', 'Paid', NULL, '2020-10-08 19:12:05', '2020-10-08 19:12:05'),
(19, '2020-10-09 16:24:14', 34, 10, 21, 0, '94326506', '2000', 'Cash', 'Paid', NULL, '2020-10-09 16:24:14', '2020-10-09 16:24:14'),
(20, '2020-10-12 21:50:14', 25, 10, 22, 0, '98893731', '2000', 'Cash', 'Paid', NULL, '2020-10-12 21:50:14', '2020-10-12 21:50:14'),
(21, '2020-10-13 14:56:30', 36, 10, 23, 0, '83107998', '2500', 'Cash', 'Paid', NULL, '2020-10-13 14:56:30', '2020-10-13 14:56:30'),
(22, '2020-10-13 21:24:15', 39, 10, 24, 0, '38176715', '2200', 'Cash', 'Paid', NULL, '2020-10-13 21:24:15', '2020-10-13 21:24:15'),
(23, '2020-10-13 21:34:05', 37, 10, 25, 0, '51240009', '2500', 'Cash', 'Paid', NULL, '2020-10-13 21:34:05', '2020-10-13 21:34:05'),
(24, '2020-10-13 21:39:11', 37, 10, 26, 0, '88713211', '2400', 'Cash', 'Paid', NULL, '2020-10-13 21:39:11', '2020-10-13 21:39:11'),
(25, '2020-10-14 13:36:53', 36, 10, 27, 0, '12193878', '2500', 'Cash', 'Paid', NULL, '2020-10-14 13:36:53', '2020-10-14 13:36:53'),
(26, '2020-10-14 16:19:56', 25, 10, 28, 0, '89309026', '2000', 'Online', 'Paid', NULL, '2020-10-14 16:19:56', '2020-10-14 16:19:56'),
(27, '2020-10-14 17:24:09', 46, 11, 29, 0, '50592480', '0', 'Cash', 'Paid', NULL, '2020-10-14 17:24:09', '2020-10-14 17:24:09'),
(28, '2020-10-14 17:26:11', 41, 11, 30, 0, '38721757', '3000', 'Cash', 'Paid', NULL, '2020-10-14 17:26:11', '2020-10-14 17:26:11'),
(29, '2020-10-14 17:26:54', 42, 11, 31, 0, '48927497', '3000', 'Cash', 'Paid', NULL, '2020-10-14 17:26:54', '2020-10-14 17:26:54'),
(30, '2020-10-14 17:28:15', 43, 11, 32, 0, '41959542', '3000', 'Cash', 'Paid', NULL, '2020-10-14 17:28:15', '2020-10-14 17:28:15'),
(31, '2020-10-14 17:28:58', 44, 11, 33, 0, '34064298', '3000', 'Cash', 'Paid', NULL, '2020-10-14 17:28:58', '2020-10-14 17:28:58'),
(32, '2020-10-14 18:17:54', 25, 10, 34, 0, '92006951', '1000', 'Online', 'Paid', NULL, '2020-10-14 18:17:54', '2020-10-14 18:17:54'),
(33, '2020-10-15 22:01:21', 25, 10, 35, 0, '76536718', '2000', 'Online', 'Paid', NULL, '2020-10-15 22:01:21', '2020-10-15 22:01:21'),
(35, '2020-10-20 20:06:27', 36, 10, 37, 0, '94833559', '2500', 'Cash', 'Paid', NULL, '2020-10-20 20:06:27', '2020-10-20 20:06:27'),
(39, '2020-10-26 17:39:24', 36, 10, 41, 0, '60862569', '2500', 'Cash', 'Paid', NULL, '2020-10-26 17:39:24', '2020-10-26 17:39:24'),
(40, '2020-10-26 18:58:02', 25, 10, 42, 0, '91464379', '2500', 'Cash', 'Paid', NULL, '2020-10-26 18:58:02', '2020-10-26 18:58:02'),
(41, '2020-10-26 19:45:11', 24, 10, 43, 0, '14111550', '2501', 'Cash', 'Paid', NULL, '2020-10-26 19:45:11', '2020-10-26 19:45:11'),
(42, '2020-10-26 20:20:16', 49, 10, 44, 0, '27073851', '2500', 'Cash', 'Paid', NULL, '2020-10-26 20:20:16', '2020-10-26 20:20:16'),
(43, '2020-10-27 14:02:40', 50, 11, 46, 0, '10721797', '2500', 'Cash', 'Paid', NULL, '2020-10-27 14:02:40', '2020-10-27 14:02:40'),
(44, '2020-10-27 22:48:43', 25, 10, 47, 0, '15223144', '2200', 'Online', 'Paid', NULL, '2020-10-27 22:48:43', '2020-10-27 22:48:43'),
(45, '2020-10-29 12:53:55', 36, 10, 48, 0, '55229621', '2500', 'Cash', 'Paid', NULL, '2020-10-29 12:53:55', '2020-10-29 12:53:55'),
(46, '2020-10-29 15:10:47', 51, 10, 49, 0, '93337801', '2200', 'Cash', 'Paid', NULL, '2020-10-29 15:10:47', '2020-10-29 15:10:47'),
(47, '2020-10-29 15:19:23', 25, 10, 50, 0, '51176623', '2200', 'Cash', 'Paid', NULL, '2020-10-29 15:19:23', '2020-10-29 15:19:23'),
(48, '2020-11-03 15:15:35', 25, 10, 51, 0, '55883820', '1200', 'Online', 'Paid', NULL, '2020-11-03 15:15:35', '2020-11-03 15:15:35'),
(49, '2020-11-03 15:22:46', 25, 10, 52, 0, '11075509', '2000', 'Cash', 'Paid', NULL, '2020-11-03 15:22:46', '2020-11-03 15:22:46'),
(50, '2020-11-03 15:34:07', 25, 10, 53, 0, '25700274', '1200', 'Cash', 'Paid', NULL, '2020-11-03 15:34:07', '2020-11-03 15:34:07'),
(51, '2020-11-03 15:35:44', 25, 10, 54, 0, '55223236', '1200', 'Online', 'Paid', NULL, '2020-11-03 15:35:44', '2020-11-03 15:35:44'),
(52, '2020-11-03 19:32:58', 25, 10, 55, 0, '74621439', '2200', 'Cash', 'Paid', NULL, '2020-11-03 19:32:58', '2020-11-03 19:32:58'),
(53, '2020-11-03 21:20:09', 25, 10, 56, 0, '51159762', '2200', 'Cash', 'Paid', NULL, '2020-11-03 21:20:09', '2020-11-03 21:20:09'),
(54, '2020-11-03 23:12:18', 25, 10, 57, 0, '58939462', '2200', 'Online', 'Paid', NULL, '2020-11-03 23:12:18', '2020-11-03 23:12:18'),
(55, '2020-11-04 16:08:23', 51, 12, 58, 0, '71572060', '2500', 'Cash', 'Paid', NULL, '2020-11-04 16:08:23', '2020-11-04 16:27:56'),
(56, '2020-11-04 17:58:02', 36, 12, 59, 0, '17213544', '2500', 'Cash', 'Paid', NULL, '2020-11-04 17:58:02', '2020-11-04 17:58:02'),
(57, '2020-11-05 14:46:32', 51, 12, 60, 0, '10955705', '3000', 'Online', 'Paid', NULL, '2020-11-05 14:46:32', '2020-11-05 14:46:32'),
(58, '2020-11-05 14:56:48', 36, 12, 61, 0, '67666004', '3000', 'Cash', 'Paid', NULL, '2020-11-05 14:56:48', '2020-11-05 14:56:48'),
(59, '2020-11-05 15:14:26', 51, 12, 62, 0, '54606724', '3000', 'Cash', 'Paid', NULL, '2020-11-05 15:14:26', '2020-11-05 15:14:26'),
(60, '2020-11-05 19:12:25', 53, 11, 64, 0, '55551721', '3000', 'Cash', 'Paid', NULL, '2020-11-05 19:12:25', '2020-11-05 19:12:25'),
(61, '2020-11-05 21:02:52', 54, 11, 65, 0, '81659385', '3000', 'Cash', 'Paid', NULL, '2020-11-05 21:02:52', '2020-11-05 21:02:52'),
(62, '2020-11-05 21:09:08', 55, 11, 66, 0, '90803646', '3000', 'Online', 'Paid', NULL, '2020-11-05 21:09:08', '2020-11-05 21:09:08'),
(63, '2020-11-06 15:20:04', 56, 11, 67, 0, '52829976', '3000', 'Online', 'Paid', NULL, '2020-11-06 15:20:04', '2020-11-06 15:20:04'),
(64, '2020-11-06 15:23:03', 57, 11, 68, 0, '10144642', '3000', 'Online', 'Paid', NULL, '2020-11-06 15:23:03', '2020-11-06 15:23:03'),
(65, '2020-11-06 15:23:51', 58, 11, 69, 0, '61242779', '3000', 'Online', 'Paid', NULL, '2020-11-06 15:23:51', '2020-11-06 15:23:51'),
(66, '2020-11-06 15:24:40', 59, 11, 70, 0, '25828029', '3000', 'Online', 'Paid', NULL, '2020-11-06 15:24:40', '2020-11-06 15:24:40'),
(67, '2020-11-10 20:10:33', 36, 10, 71, 0, '98473422', '3000', 'Online', 'Paid', NULL, '2020-11-10 20:10:33', '2020-11-10 20:10:33'),
(68, '2020-12-03 11:12:38', 34, 10, 72, 0, '17818615', '2200', 'Online', 'Paid', NULL, '2020-12-03 11:12:38', '2020-12-03 11:12:38'),
(69, '2020-12-03 12:41:52', 34, 10, 73, 0, '35391920', '2200', 'Online', 'Unpaid', NULL, '2020-12-03 12:41:52', '2020-12-03 12:41:52'),
(70, '2020-12-04 05:16:11', 34, 10, 74, 0, '45623631', '2200', 'Online', 'Paid', NULL, '2020-12-04 05:16:11', '2020-12-04 08:01:42'),
(71, '2020-12-21 06:56:48', 24, 10, 75, 0, '91248274', '2200', 'Online', 'Unpaid', NULL, '2020-12-21 06:56:48', '2020-12-21 06:56:48'),
(72, '2020-12-21 07:50:20', 24, 10, 76, 0, '97866518', '2200', 'Online', 'Unpaid', NULL, '2020-12-21 07:50:20', '2020-12-21 07:50:20'),
(73, '2020-12-21 07:52:33', 24, 10, 77, 0, '35967705', '2200', 'Online', 'Unpaid', NULL, '2020-12-21 07:52:33', '2020-12-21 07:52:33'),
(74, '2020-12-21 07:56:52', 24, 10, 78, 0, '90284679', '2200', 'Online', 'Paid', '10444771411', '2020-12-21 07:56:52', '2021-01-08 07:33:38'),
(75, '2021-01-04 07:50:50', 34, 10, 79, 0, '57594849', '2200', 'Online', 'Paid', NULL, '2021-01-04 07:50:50', '2021-01-04 07:50:50'),
(76, '2021-01-04 07:54:35', 34, 10, 80, 0, '77728561', '2200', 'Online', 'Paid', NULL, '2021-01-04 07:54:35', '2021-01-04 07:54:35'),
(77, '2021-01-04 09:36:47', 34, 10, 81, 0, '76081385', '2200', 'Online', 'Paid', NULL, '2021-01-04 09:36:47', '2021-01-04 09:36:47'),
(78, '2021-01-04 10:24:57', 34, 10, 82, 0, '64319360', '2200', 'Online', 'Paid', NULL, '2021-01-04 10:24:57', '2021-01-04 10:24:57'),
(79, '2021-01-04 10:35:34', 34, 10, 83, 0, '40559983', '2200', 'Online', 'Unpaid', NULL, '2021-01-04 10:35:34', '2021-01-04 10:35:34'),
(80, '2021-01-04 10:37:30', 34, 10, 84, 0, '87228082', '2200', 'Cash', 'Paid', NULL, '2021-01-04 10:37:30', '2021-01-04 10:37:30'),
(81, '2021-01-04 10:47:56', 34, 10, 85, 0, '82640475', '2200', 'Online', 'Paid', NULL, '2021-01-04 10:47:56', '2021-01-04 10:47:56'),
(82, '2021-01-04 10:50:25', 34, 10, 86, 0, '50697686', '2200', 'Cash', 'Paid', NULL, '2021-01-04 10:50:25', '2021-01-04 10:50:25'),
(83, '2021-01-04 11:10:11', 34, 10, 87, 0, '86938075', '2200', 'Online', 'Unpaid', NULL, '2021-01-04 11:10:11', '2021-01-04 11:10:11'),
(84, '2021-01-04 11:20:51', 34, 10, 88, 0, '42444560', '2200', 'Online', 'Paid', NULL, '2021-01-04 11:20:51', '2021-01-04 11:20:51'),
(85, '2021-01-04 11:31:24', 34, 10, 89, 0, '53381945', '2200', 'Online', 'Paid', NULL, '2021-01-04 11:31:24', '2021-01-04 11:31:24'),
(86, '2021-01-04 11:34:44', 34, 10, 90, 0, '60590845', '2200', 'Cash', 'Paid', NULL, '2021-01-04 11:34:44', '2021-01-04 11:34:44'),
(87, '2021-01-04 11:42:28', 34, 10, 91, 0, '43248378', '2200', 'Cash', 'Paid', NULL, '2021-01-04 11:42:28', '2021-01-04 11:42:28'),
(88, '2021-01-04 11:45:46', 34, 10, 92, 0, '25212087', '2200', 'Cash', 'Paid', NULL, '2021-01-04 11:45:46', '2021-01-04 11:45:46'),
(89, '2021-01-04 11:47:48', 34, 10, 93, 0, '27668162', '2200', 'Cash', 'Paid', NULL, '2021-01-04 11:47:48', '2021-01-04 11:47:48'),
(90, '2021-01-04 11:49:42', 34, 10, 94, 0, '37314904', '2200', 'Cash', 'Paid', NULL, '2021-01-04 11:49:42', '2021-01-04 11:49:42'),
(91, '2021-01-04 11:55:29', 34, 10, 95, 0, '82183410', '2200', 'Online', 'Paid', NULL, '2021-01-04 11:55:29', '2021-01-04 11:55:29'),
(92, '2021-01-04 11:56:40', 34, 10, 96, 0, '61617120', '2200', 'Cash', 'Paid', NULL, '2021-01-04 11:56:40', '2021-01-04 11:56:40'),
(93, '2021-01-04 11:59:15', 34, 10, 97, 0, '39082343', '2200', 'Cash', 'Paid', NULL, '2021-01-04 11:59:15', '2021-01-04 11:59:15'),
(94, '2021-01-04 12:02:35', 34, 10, 99, 0, '52690667', '2200', 'Cash', 'Paid', NULL, '2021-01-04 12:02:35', '2021-01-04 12:02:35'),
(95, '2021-01-04 12:15:30', 34, 10, 100, 0, '38132422', '2200', 'Online', 'Paid', NULL, '2021-01-04 12:15:30', '2021-01-04 12:15:30'),
(96, '2021-01-04 12:21:36', 34, 10, 101, 0, '35708572', '2200', 'Cash', 'Paid', NULL, '2021-01-04 12:21:36', '2021-01-04 12:21:36'),
(97, '2021-01-04 12:25:26', 34, 10, 102, 0, '76950128', '2200', 'Cash', 'Paid', NULL, '2021-01-04 12:25:26', '2021-01-04 12:25:26'),
(98, '2021-01-04 12:32:37', 34, 10, 103, 0, '78662392', '2200', 'Cash', 'Paid', NULL, '2021-01-04 12:32:37', '2021-01-04 12:32:37'),
(99, '2021-01-04 12:34:00', 34, 10, 104, 0, '13817614', '2200', 'Online', 'Paid', NULL, '2021-01-04 12:34:00', '2021-01-04 12:34:00'),
(100, '2021-01-04 12:36:42', 34, 10, 105, 0, '23687941', '2200', 'Cash', 'Paid', NULL, '2021-01-04 12:36:42', '2021-01-04 12:36:42'),
(101, '2021-01-04 12:45:09', 34, 10, 106, 0, '20121387', '2200', 'Cash', 'Paid', NULL, '2021-01-04 12:45:09', '2021-01-04 12:45:09'),
(102, '2021-01-04 12:52:00', 34, 10, 107, 0, '84799731', '2200', 'Cash', 'Paid', NULL, '2021-01-04 12:52:00', '2021-01-04 12:52:00'),
(103, '2021-01-04 12:57:26', 34, 10, 108, 0, '85357733', '2200', 'Cash', 'Paid', NULL, '2021-01-04 12:57:26', '2021-01-04 12:57:26'),
(104, '2021-01-04 12:58:24', 34, 10, 109, 0, '30132982', '2200', 'Online', 'Paid', NULL, '2021-01-04 12:58:24', '2021-01-04 12:58:24'),
(105, '2021-01-04 12:59:58', 34, 10, 110, 0, '84990396', '2200', 'Online', 'Paid', NULL, '2021-01-04 12:59:58', '2021-01-04 12:59:58'),
(106, '2021-01-04 13:07:57', 34, 10, 111, 0, '50421831', '2200', 'Cash', 'Paid', NULL, '2021-01-04 13:07:57', '2021-01-04 13:07:57'),
(107, '2021-01-04 13:09:35', 34, 10, 112, 0, '78808572', '2200', 'Online', 'Paid', NULL, '2021-01-04 13:09:35', '2021-01-04 13:09:35'),
(108, '2021-01-04 13:11:51', 34, 10, 113, 0, '67022876', '2200', 'Cash', 'Paid', NULL, '2021-01-04 13:11:51', '2021-01-04 13:11:51'),
(109, '2021-01-04 13:16:16', 34, 10, 114, 0, '60818729', '2200', 'Cash', 'Paid', NULL, '2021-01-04 13:16:16', '2021-01-04 13:16:16'),
(110, '2021-01-20 07:42:07', 34, 10, 115, 0, '97359572', '2200', 'Online', 'Unpaid', NULL, '2021-01-20 07:42:07', '2021-01-20 07:42:07'),
(111, '2021-01-21 05:37:57', 34, 10, 116, 0, '10490220', '2200', 'Online', 'Unpaid', NULL, '2021-01-21 05:37:57', '2021-01-21 05:37:57'),
(112, '2021-01-21 06:57:31', 34, 10, 117, 0, '45845311', '2200', 'Cash', 'Paid', NULL, '2021-01-21 06:57:31', '2021-01-21 06:57:31'),
(113, '2021-02-15 09:53:23', 34, 10, 118, 0, '46561986', '2200', 'Online', 'Paid', NULL, '2021-02-15 09:53:23', '2021-02-15 09:53:23'),
(114, '2021-03-22 14:08:29', 24, 10, 119, 0, '36858015', '2200', 'Online', 'Unpaid', NULL, '2021-03-22 14:08:29', '2021-03-22 14:08:29'),
(115, '2021-03-22 14:09:59', 24, 10, 120, 0, '16595020', '2200', 'Online', 'Unpaid', NULL, '2021-03-22 14:09:59', '2021-03-22 14:09:59'),
(116, '2021-04-01 10:32:41', 34, 10, 121, 0, '77513745', '2200', 'Online', 'Paid', NULL, '2021-04-01 10:32:41', '2021-04-01 10:32:41'),
(117, '2021-04-13 05:55:39', 24, 10, 122, 0, '93934847', '2200', 'Online', 'Paid', NULL, '2021-04-13 05:55:39', '2021-04-13 05:55:39'),
(118, '2021-04-13 06:57:23', 24, 10, 123, 0, '82921462', '2200', 'Online', 'Paid', NULL, '2021-04-13 06:57:23', '2021-04-13 06:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Manage Users', 'manage-users', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(2, 'Manage Qualifications', 'manage-qualifications', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(3, 'Manage Surgeries', 'manage-surgeries', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(4, 'Manage Allergies', 'manage-allergies', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(5, 'Manage Diseases', 'manage-diseases', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(6, 'Manage Medications', 'manage-medications', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(7, 'Manage Specialties', 'manage-specialties', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(8, 'Manage Drugs', 'manage-drugs', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(9, 'Manage Physical Exams', 'manage-physical-exams', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(10, 'Manage Prescription Templates', 'manage-prescription-templates', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(11, 'Manage Appointments', 'manage-appointments', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(12, 'Manage Practitioners', 'manage-practitioners', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(13, 'Manage Payments', 'manage-payments', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(14, 'Manage Patient Types', 'manage-patient-types', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(15, 'Manage Assistants', 'manage-assistants', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(17, 'Manage Patients', 'manage-patients', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(18, 'Manage Facilities', 'manage-facilities', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(19, 'Manage Lab Tests', 'manage-lab-tests', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(20, 'Manage Configurations', 'manage-configurations', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(21, 'Manage Departments', 'manage-departments', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(22, 'Manage Hospitals', 'manage-hospitals', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(23, 'Manage Clinic Configurations', 'manage-clinic-configurations', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(24, 'Manage Clinics', 'manage-clinics', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(25, 'Manage Relations', 'manage-relations', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(26, 'Manage Reactions', 'manage-reactions', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(27, 'Manage Units', 'manage-units', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(28, 'Manage Doses', 'manage-doses', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(29, 'Manage Frequencies', 'manage-frequencies', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(30, 'Manage Durations', 'manage-durations', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(31, 'Manage Diagnosis Types', 'manage-diagnosis-types', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(32, 'Manage Labs', 'manage-labs', '2020-08-31 05:00:00', '2020-08-31 06:00:00'),
(33, 'Manage Lab Test Type', 'manage-lab-tests-type', '2020-08-31 05:00:00', '2020-08-31 06:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `physical_examinations`
--

CREATE TABLE `physical_examinations` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_visit_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `patient_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `physical_exam_id` int(11) UNSIGNED NOT NULL,
  `physical_exam_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `physical_examinations`
--

INSERT INTO `physical_examinations` (`id`, `patient_visit_id`, `practitioner_id`, `practitioner_name`, `patient_id`, `patient_name`, `physical_exam_id`, `physical_exam_name`, `description`, `created_at`, `updated_at`) VALUES
(12, 95, 10, 'Dr. Abdullah', 24, 'Mr. John Doe', 8, 'Abd', 'Testing', '2021-03-24 06:39:53', '2021-03-24 06:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `physical_exams`
--

CREATE TABLE `physical_exams` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `physical_exams`
--

INSERT INTO `physical_exams` (`id`, `title`, `slug`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(4, 'General', 'general', 1, NULL, '2020-10-07 06:11:00', '2020-10-07 06:11:00'),
(5, 'Heent', 'heent', 1, NULL, '2020-10-07 06:11:00', '2020-10-07 06:11:00'),
(6, 'Resp', 'resp', 1, NULL, '2020-10-07 06:11:00', '2020-10-07 06:11:00'),
(7, 'Cvs', 'cvs', 1, NULL, '2020-10-07 06:11:00', '2020-10-07 06:11:00'),
(8, 'Abd', 'abd', 1, NULL, '2020-10-07 06:11:00', '2020-10-07 06:11:00'),
(9, 'Ext', 'ext', 1, NULL, '2020-10-07 06:11:00', '2020-10-07 06:11:00'),
(10, 'Lymph', 'lymph', 1, NULL, '2020-10-07 06:11:00', '2020-10-07 06:11:00'),
(11, 'Muskuloskeletal', 'muskuloskeletal', 1, NULL, '2020-10-07 06:11:01', '2020-10-07 06:11:01'),
(12, 'Nervous System', 'nervous-system', 1, NULL, '2020-10-07 06:11:01', '2020-10-07 06:11:01');

-- --------------------------------------------------------

--
-- Table structure for table `practitioners`
--

CREATE TABLE `practitioners` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification_id` int(11) UNSIGNED DEFAULT NULL,
  `license_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prescription_pad_header_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prescription_pad_footer_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prescription_pad_sidebar_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prescription_pad_other_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `agora_app_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agora_app_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agora_app_certificate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agora_app_channel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `practitioners`
--

INSERT INTO `practitioners` (`id`, `name`, `email`, `phone`, `address`, `description`, `image`, `password`, `qualification_id`, `license_no`, `license_image`, `prescription_pad_header_image`, `prescription_pad_footer_image`, `prescription_pad_sidebar_image`, `prescription_pad_other_image`, `status`, `agora_app_id`, `agora_app_token`, `agora_app_certificate`, `agora_app_channel`, `remember_token`, `last_login`, `token`, `device_type`, `created_at`, `updated_at`) VALUES
(10, 'Dr. Abdullah', 'abdullah.tektiks@gmail.com', '0321-5001777', 'Shaukat Khanum Memorial Cancer Hospital, Lahore', 'Diplomate American Board of Diabetes, Endocrinology and Metabolism', 'practitionerImage/bQEfR83o0GvAz28KKRqcOEm307BpcFBcQLz7NHZS.jpeg', '$2y$10$Jt4rinYRcAXgOGGcgPd1bepllwjWJuCggHIZqai4mCr/lJMV513BW', 2, '123456', 'practitionerLicenseImage/PgVpmcYtWa23cQpu0PtRHKKVz1Pu0D7Nrz60Rlas.png', 'practitionerLetterPadImage/5jeDpQhLYlsmaA4lmoAg61odDM5an4LdM0PRvY6J.jpeg', NULL, 'practitionerLetterPadImage/0OS81Du7D478Y1yTYdlHdqwKtOBqkZqfmptpuCbd.jpeg', 'practitionerLetterPadImage/GIDmJlhzjpRQg1gvQkShfkvsl55U5rKnb5yezYdp.jpeg', 1, '0a67f2f817604d85b30c05f11d2e92a6', '0060a67f2f817604d85b30c05f11d2e92a6IADt9C9smJU+VXEfiZZXKUVlIXRGp+AwYLiEuUYNCLHdxJpjTicAAAAAIgAlpAAAHnZ2YAQAAQAednZgAwAednZgAgAednZgBAAednZg', '6eb9bf3baced4454b55da610ab5fcbb1', 'Testing', NULL, '2021-04-06 14:40:32', NULL, NULL, '2020-09-14 04:45:25', '2021-04-13 04:57:02');

-- --------------------------------------------------------

--
-- Table structure for table `practitioner_assistants`
--

CREATE TABLE `practitioner_assistants` (
  `id` int(11) UNSIGNED NOT NULL,
  `assistant_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `practitioner_clinics`
--

CREATE TABLE `practitioner_clinics` (
  `id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `clinic_id` int(11) UNSIGNED NOT NULL,
  `physical_fee` int(11) DEFAULT NULL,
  `online_fee` int(11) DEFAULT NULL,
  `from_time` time DEFAULT NULL,
  `to_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `practitioner_clinics`
--

INSERT INTO `practitioner_clinics` (`id`, `practitioner_id`, `clinic_id`, `physical_fee`, `online_fee`, `from_time`, `to_time`, `created_at`, `updated_at`) VALUES
(113, 10, 1, NULL, 2200, '11:00:00', '21:00:00', '2021-04-01 09:45:31', '2021-04-01 09:45:31'),
(114, 10, 1, 2131, 2200, '07:30:00', '09:50:00', '2021-04-01 09:45:31', '2021-04-01 09:45:31'),
(115, 10, 2, 2121, 123, '21:30:00', '23:30:00', '2021-04-01 09:45:31', '2021-04-01 09:45:31'),
(116, 10, 1, 34, 233, '07:30:00', '09:50:00', '2021-04-01 09:45:32', '2021-04-01 09:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `practitioner_clinic_days`
--

CREATE TABLE `practitioner_clinic_days` (
  `id` int(11) UNSIGNED NOT NULL,
  `day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `practitioner_clinic_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `practitioner_clinic_days`
--

INSERT INTO `practitioner_clinic_days` (`id`, `day`, `practitioner_clinic_id`, `created_at`, `updated_at`) VALUES
(7, 'monday', 5, '2020-09-10 12:08:13', '2020-09-10 12:08:13'),
(8, 'tuesday', 5, '2020-09-10 12:08:13', '2020-09-10 12:08:13'),
(9, 'wednesday', 6, '2020-09-10 12:08:13', '2020-09-10 12:08:13'),
(10, 'thursday', 6, '2020-09-10 12:08:13', '2020-09-10 12:08:13'),
(172, 'monday', 90, '2020-10-27 13:28:33', '2020-10-27 13:28:33'),
(173, 'tuesday', 90, '2020-10-27 13:28:33', '2020-10-27 13:28:33'),
(174, 'wednesday', 90, '2020-10-27 13:28:33', '2020-10-27 13:28:33'),
(175, 'thursday', 90, '2020-10-27 13:28:33', '2020-10-27 13:28:33'),
(176, 'friday', 90, '2020-10-27 13:28:33', '2020-10-27 13:28:33'),
(177, 'saturday', 90, '2020-10-27 13:28:33', '2020-10-27 13:28:33'),
(178, 'sunday', 90, '2020-10-27 13:28:33', '2020-10-27 13:28:33'),
(179, 'wednesday', 91, '2020-10-27 13:28:33', '2020-10-27 13:28:33'),
(183, 'monday', 94, '2020-11-03 22:01:10', '2020-11-03 22:01:10'),
(184, 'tuesday', 94, '2020-11-03 22:01:10', '2020-11-03 22:01:10'),
(185, 'wednesday', 94, '2020-11-03 22:01:10', '2020-11-03 22:01:10'),
(186, 'thursday', 94, '2020-11-03 22:01:10', '2020-11-03 22:01:10'),
(187, 'friday', 94, '2020-11-03 22:01:10', '2020-11-03 22:01:10'),
(188, 'saturday', 94, '2020-11-03 22:01:10', '2020-11-03 22:01:10'),
(193, 'wednesday', 97, '2020-11-06 15:17:49', '2020-11-06 15:17:49'),
(194, 'thursday', 97, '2020-11-06 15:17:49', '2020-11-06 15:17:49'),
(195, 'friday', 97, '2020-11-06 15:17:49', '2020-11-06 15:17:49'),
(196, 'monday', 98, '2020-12-15 10:48:36', '2020-12-15 10:48:36'),
(197, 'tuesday', 98, '2020-12-15 10:48:36', '2020-12-15 10:48:36'),
(198, 'wednesday', 98, '2020-12-15 10:48:36', '2020-12-15 10:48:36'),
(199, 'thursday', 98, '2020-12-15 10:48:36', '2020-12-15 10:48:36'),
(200, 'friday', 98, '2020-12-15 10:48:36', '2020-12-15 10:48:36'),
(201, 'saturday', 98, '2020-12-15 10:48:37', '2020-12-15 10:48:37'),
(202, 'sunday', 98, '2020-12-15 10:48:37', '2020-12-15 10:48:37'),
(203, 'tuesday', 99, '2020-12-15 10:48:37', '2020-12-15 10:48:37'),
(204, 'monday', 100, '2021-01-07 07:10:15', '2021-01-07 07:10:15'),
(205, 'tuesday', 100, '2021-01-07 07:10:15', '2021-01-07 07:10:15'),
(206, 'wednesday', 100, '2021-01-07 07:10:15', '2021-01-07 07:10:15'),
(207, 'thursday', 100, '2021-01-07 07:10:15', '2021-01-07 07:10:15'),
(208, 'friday', 100, '2021-01-07 07:10:15', '2021-01-07 07:10:15'),
(209, 'saturday', 100, '2021-01-07 07:10:15', '2021-01-07 07:10:15'),
(210, 'sunday', 100, '2021-01-07 07:10:15', '2021-01-07 07:10:15'),
(211, 'tuesday', 101, '2021-01-07 07:10:15', '2021-01-07 07:10:15'),
(212, 'monday', 102, '2021-02-11 10:17:36', '2021-02-11 10:17:36'),
(213, 'tuesday', 102, '2021-02-11 10:17:36', '2021-02-11 10:17:36'),
(214, 'wednesday', 102, '2021-02-11 10:17:37', '2021-02-11 10:17:37'),
(215, 'thursday', 102, '2021-02-11 10:17:37', '2021-02-11 10:17:37'),
(216, 'friday', 102, '2021-02-11 10:17:37', '2021-02-11 10:17:37'),
(217, 'saturday', 102, '2021-02-11 10:17:37', '2021-02-11 10:17:37'),
(218, 'sunday', 102, '2021-02-11 10:17:37', '2021-02-11 10:17:37'),
(219, 'tuesday', 103, '2021-02-11 10:17:37', '2021-02-11 10:17:37'),
(220, 'monday', 104, '2021-02-11 10:17:37', '2021-02-11 10:17:37'),
(221, 'monday', 105, '2021-02-15 09:23:15', '2021-02-15 09:23:15'),
(222, 'tuesday', 105, '2021-02-15 09:23:15', '2021-02-15 09:23:15'),
(223, 'wednesday', 105, '2021-02-15 09:23:15', '2021-02-15 09:23:15'),
(224, 'thursday', 105, '2021-02-15 09:23:15', '2021-02-15 09:23:15'),
(225, 'friday', 105, '2021-02-15 09:23:15', '2021-02-15 09:23:15'),
(226, 'saturday', 105, '2021-02-15 09:23:15', '2021-02-15 09:23:15'),
(227, 'sunday', 105, '2021-02-15 09:23:15', '2021-02-15 09:23:15'),
(228, 'tuesday', 106, '2021-02-15 09:23:15', '2021-02-15 09:23:15'),
(229, 'monday', 107, '2021-02-15 09:23:15', '2021-02-15 09:23:15'),
(230, 'thursday', 108, '2021-02-15 09:23:15', '2021-02-15 09:23:15'),
(231, 'monday', 109, '2021-02-16 07:55:52', '2021-02-16 07:55:52'),
(232, 'tuesday', 109, '2021-02-16 07:55:52', '2021-02-16 07:55:52'),
(233, 'wednesday', 109, '2021-02-16 07:55:52', '2021-02-16 07:55:52'),
(234, 'thursday', 109, '2021-02-16 07:55:52', '2021-02-16 07:55:52'),
(235, 'friday', 109, '2021-02-16 07:55:52', '2021-02-16 07:55:52'),
(236, 'saturday', 109, '2021-02-16 07:55:52', '2021-02-16 07:55:52'),
(237, 'sunday', 109, '2021-02-16 07:55:52', '2021-02-16 07:55:52'),
(238, 'tuesday', 110, '2021-02-16 07:55:52', '2021-02-16 07:55:52'),
(239, 'monday', 111, '2021-02-16 07:55:52', '2021-02-16 07:55:52'),
(240, 'thursday', 112, '2021-02-16 07:55:53', '2021-02-16 07:55:53'),
(241, 'monday', 113, '2021-04-01 09:45:31', '2021-04-01 09:45:31'),
(242, 'tuesday', 113, '2021-04-01 09:45:31', '2021-04-01 09:45:31'),
(243, 'wednesday', 113, '2021-04-01 09:45:31', '2021-04-01 09:45:31'),
(244, 'thursday', 113, '2021-04-01 09:45:31', '2021-04-01 09:45:31'),
(245, 'friday', 113, '2021-04-01 09:45:31', '2021-04-01 09:45:31'),
(246, 'saturday', 113, '2021-04-01 09:45:31', '2021-04-01 09:45:31'),
(247, 'sunday', 113, '2021-04-01 09:45:31', '2021-04-01 09:45:31'),
(248, 'tuesday', 114, '2021-04-01 09:45:31', '2021-04-01 09:45:31'),
(249, 'monday', 115, '2021-04-01 09:45:32', '2021-04-01 09:45:32'),
(250, 'thursday', 116, '2021-04-01 09:45:32', '2021-04-01 09:45:32'),
(251, 'wednesday', 117, '2021-04-06 07:08:06', '2021-04-06 07:08:06'),
(252, 'thursday', 117, '2021-04-06 07:08:06', '2021-04-06 07:08:06'),
(253, 'friday', 117, '2021-04-06 07:08:06', '2021-04-06 07:08:06'),
(254, 'saturday', 118, '2021-04-06 07:08:06', '2021-04-06 07:08:06'),
(255, 'sunday', 118, '2021-04-06 07:08:06', '2021-04-06 07:08:06'),
(256, 'wednesday', 119, '2021-04-06 07:08:50', '2021-04-06 07:08:50'),
(257, 'thursday', 119, '2021-04-06 07:08:50', '2021-04-06 07:08:50'),
(258, 'friday', 119, '2021-04-06 07:08:50', '2021-04-06 07:08:50'),
(259, 'saturday', 120, '2021-04-06 07:08:50', '2021-04-06 07:08:50'),
(260, 'sunday', 120, '2021-04-06 07:08:50', '2021-04-06 07:08:50');

-- --------------------------------------------------------

--
-- Table structure for table `practitioner_days`
--

CREATE TABLE `practitioner_days` (
  `id` int(11) UNSIGNED NOT NULL,
  `day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `practitioner_days`
--

INSERT INTO `practitioner_days` (`id`, `day`, `practitioner_id`, `created_at`, `updated_at`) VALUES
(51, 'wednesday', 6, '2020-09-01 12:05:05', '2020-09-01 12:05:05'),
(52, 'thursday', 6, '2020-09-01 12:05:05', '2020-09-01 12:05:05'),
(53, 'friday', 6, '2020-09-01 12:05:05', '2020-09-01 12:05:05'),
(56, 'Monday', 1, '2020-09-09 07:52:46', '2020-09-09 07:52:46'),
(57, 'Tuesday', 1, '2020-09-09 07:52:46', '2020-09-09 07:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `practitioner_lab_tests`
--

CREATE TABLE `practitioner_lab_tests` (
  `id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `lab_test_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `practitioner_lab_tests`
--

INSERT INTO `practitioner_lab_tests` (`id`, `practitioner_id`, `lab_test_id`, `created_at`, `updated_at`) VALUES
(5, 10, 636, '2020-10-08 05:52:19', '2020-10-08 05:52:19'),
(7, 10, 644, '2020-10-08 05:52:40', '2020-10-08 05:52:40'),
(13, 10, 625, '2020-12-04 07:44:59', '2020-12-04 07:44:59'),
(14, 10, 627, '2020-12-04 07:44:59', '2020-12-04 07:44:59');

-- --------------------------------------------------------

--
-- Table structure for table `practitioner_specialties`
--

CREATE TABLE `practitioner_specialties` (
  `id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `specialty_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `practitioner_specialties`
--

INSERT INTO `practitioner_specialties` (`id`, `practitioner_id`, `specialty_id`, `created_at`, `updated_at`) VALUES
(12, 8, 1, NULL, NULL),
(14, 10, 1, NULL, NULL),
(15, 10, 2, NULL, NULL),
(17, 11, 2, NULL, NULL),
(18, 12, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prescription_allergies`
--

CREATE TABLE `prescription_allergies` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_prescription_id` int(11) UNSIGNED NOT NULL,
  `allergy_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescription_medications`
--

CREATE TABLE `prescription_medications` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_prescription_id` int(11) UNSIGNED NOT NULL,
  `medication_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescription_templates`
--

CREATE TABLE `prescription_templates` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_favourite` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE `qualifications` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`id`, `title`, `slug`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'MD (USA), MPH (USA), FACE (USA), FRCP (Lon), MIVM (Europe), Diplomate ABIM-Endocrinology (USA), Diplomate ABIM (USA) , Diplomate-ABPNS (USA).', 'md-usa-mph-usa-face-usa-frcp-lon-mivm-europe-diplomate-abim-endocrinology-usa-diplomate-abim-usa-diplomate-abpns-usa', 1, NULL, '2020-08-31 07:18:25', '2020-10-14 16:22:59'),
(3, 'M.B.B.S.', 'mbbs', 1, NULL, '2020-10-27 13:12:13', '2020-10-27 13:12:13'),
(4, 'M.B.P.H.', 'mbph', 1, NULL, '2020-10-27 13:12:34', '2020-10-27 13:12:34'),
(5, 'MD(USA), FACC(USA), DABIM-Cardiology(USA), DABIM(USA), DABIM-Interventional Cardiology(USA), DAB-Echocardiography(USA), DAB-Nuclear Cardiology(USA), DAB-Vascular Medicine(USA)', 'mdusa-faccusa-dabim-cardiologyusa-dabimusa-dabim-interventional-cardiologyusa-dab-echocardiographyusa-dab-nuclear-cardiologyusa-dab-vascular-medicineusa', 1, NULL, '2020-11-03 21:36:52', '2020-11-03 21:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `drug_id` int(11) UNSIGNED DEFAULT NULL,
  `drug_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reactions`
--

INSERT INTO `reactions` (`id`, `title`, `slug`, `drug_id`, `drug_title`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(102, 'Anaphylaxis', 'anaphylaxis', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(103, 'Angioedema', 'angioedema', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(104, 'Anxiety', 'anxiety', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(105, 'Azotemia', 'azotemia', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(106, 'Bloody Diarrhea', 'bloody-diarrhea', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(107, 'Bronchospasm', 'bronchospasm', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(108, 'Constipation', 'constipation', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(109, 'Constipation (high Dose)', 'constipation-high-dose', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(110, 'Cough', 'cough', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(111, 'Diarrhea', 'diarrhea', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(112, 'Dizziness', 'dizziness', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(113, 'Drowsiness', 'drowsiness', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(114, 'Dry Cough', 'dry-cough', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(115, 'Dyspepsia', 'dyspepsia', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(116, 'Elevated LFTs', 'elevated-lfts', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(117, 'Excessive Yawning', 'excessive-yawning', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(118, 'Fever', 'fever', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(119, 'Fluid Overload', 'fluid-overload', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(120, 'GI Upset', 'gi-upset', NULL, NULL, 1, NULL, '2020-10-06 05:59:03', '2020-10-06 05:59:03'),
(121, 'GI Upset (High Dose)', 'gi-upset-high-dose', NULL, NULL, 1, NULL, '2020-10-06 05:59:04', '2020-10-06 05:59:04'),
(122, 'Headache', 'headache', NULL, NULL, 1, NULL, '2020-10-06 05:59:04', '2020-10-06 05:59:04'),
(123, 'Heartburn', 'heartburn', NULL, NULL, 1, NULL, '2020-10-06 05:59:04', '2020-10-06 05:59:04'),
(124, 'Heavy Headedness', 'heavy-headedness', NULL, NULL, 1, NULL, '2020-10-06 05:59:04', '2020-10-06 05:59:04'),
(125, 'Hyperphagia', 'hyperphagia', NULL, NULL, 1, NULL, '2020-10-06 05:59:04', '2020-10-06 05:59:04'),
(126, 'Hypersomnia', 'hypersomnia', NULL, NULL, 1, NULL, '2020-10-06 05:59:04', '2020-10-06 05:59:04'),
(127, 'Hyperuricemia', 'hyperuricemia', NULL, NULL, 1, NULL, '2020-10-06 05:59:04', '2020-10-06 05:59:04'),
(128, 'Hyponatremia', 'hyponatremia', NULL, NULL, 1, NULL, '2020-10-06 05:59:04', '2020-10-06 05:59:04'),
(129, 'Insomnia', 'insomnia', NULL, NULL, 1, NULL, '2020-10-06 05:59:04', '2020-10-06 05:59:04'),
(130, 'Itching', 'itching', NULL, NULL, 1, NULL, '2020-10-06 05:59:04', '2020-10-06 05:59:04'),
(131, 'Joint Pains', 'joint-pains', NULL, NULL, 1, NULL, '2020-10-06 05:59:04', '2020-10-06 05:59:04'),
(132, 'Leg Swelling', 'leg-swelling', NULL, NULL, 1, NULL, '2020-10-06 05:59:04', '2020-10-06 05:59:04'),
(133, 'Lethargy', 'lethargy', NULL, NULL, 1, NULL, '2020-10-06 05:59:04', '2020-10-06 05:59:04'),
(134, 'Malaise', 'malaise', NULL, NULL, 1, NULL, '2020-10-06 05:59:04', '2020-10-06 05:59:04'),
(135, 'Memory Loss', 'memory-loss', NULL, NULL, 1, NULL, '2020-10-06 05:59:04', '2020-10-06 05:59:04'),
(136, 'Metallic Taste', 'metallic-taste', NULL, NULL, 1, NULL, '2020-10-06 05:59:04', '2020-10-06 05:59:04'),
(137, 'Myalgias', 'myalgias', NULL, NULL, 1, NULL, '2020-10-06 05:59:04', '2020-10-06 05:59:04'),
(138, 'Myalgias  Query', 'myalgias-query', NULL, NULL, 1, NULL, '2020-10-06 05:59:05', '2020-10-06 05:59:05'),
(139, 'Nausea', 'nausea', NULL, NULL, 1, NULL, '2020-10-06 05:59:05', '2020-10-06 05:59:05'),
(140, 'Neutropenia', 'neutropenia', NULL, NULL, 1, NULL, '2020-10-06 05:59:05', '2020-10-06 05:59:05'),
(141, 'Palpitations', 'palpitations', NULL, NULL, 1, NULL, '2020-10-06 05:59:05', '2020-10-06 05:59:05'),
(142, 'Pedal Edema', 'pedal-edema', NULL, NULL, 1, NULL, '2020-10-06 05:59:05', '2020-10-06 05:59:05'),
(143, 'Penile Edema', 'penile-edema', NULL, NULL, 1, NULL, '2020-10-06 05:59:05', '2020-10-06 05:59:05'),
(144, 'Pre-Renal Azotemia', 'pre-renal-azotemia', NULL, NULL, 1, NULL, '2020-10-06 05:59:05', '2020-10-06 05:59:05'),
(145, 'Rash', 'rash', NULL, NULL, 1, NULL, '2020-10-06 05:59:05', '2020-10-06 05:59:05'),
(146, 'Restlessness', 'restlessness', NULL, NULL, 1, NULL, '2020-10-06 05:59:05', '2020-10-06 05:59:05'),
(147, 'Sedation', 'sedation', NULL, NULL, 1, NULL, '2020-10-06 05:59:05', '2020-10-06 05:59:05'),
(148, 'Shortness Of Breath', 'shortness-of-breath', NULL, NULL, 1, NULL, '2020-10-06 05:59:05', '2020-10-06 05:59:05'),
(149, 'Siffness Of Chest Muscles', 'siffness-of-chest-muscles', NULL, NULL, 1, NULL, '2020-10-06 05:59:05', '2020-10-06 05:59:05'),
(150, 'Skin Rash', 'skin-rash', NULL, NULL, 1, NULL, '2020-10-06 05:59:05', '2020-10-06 05:59:05'),
(151, 'Sleep Disturbance', 'sleep-disturbance', NULL, NULL, 1, NULL, '2020-10-06 05:59:05', '2020-10-06 05:59:05'),
(152, 'Sleepiness', 'sleepiness', NULL, NULL, 1, NULL, '2020-10-06 05:59:06', '2020-10-06 05:59:06'),
(153, 'Stridor', 'stridor', NULL, NULL, 1, NULL, '2020-10-06 05:59:06', '2020-10-06 05:59:06'),
(154, 'Swelling Of Feet', 'swelling-of-feet', NULL, NULL, 1, NULL, '2020-10-06 05:59:06', '2020-10-06 05:59:06'),
(155, 'Swelling Of Whole Body', 'swelling-of-whole-body', NULL, NULL, 1, NULL, '2020-10-06 05:59:06', '2020-10-06 05:59:06'),
(156, 'Tachycardia', 'tachycardia', NULL, NULL, 1, NULL, '2020-10-06 05:59:06', '2020-10-06 05:59:06'),
(157, 'Twitching Of Left Side Of The Body', 'twitching-of-left-side-of-the-body', NULL, NULL, 1, NULL, '2020-10-06 05:59:06', '2020-10-06 05:59:06'),
(158, 'Vomiting', 'vomiting', NULL, NULL, 1, NULL, '2020-10-06 05:59:06', '2020-10-06 05:59:06'),
(159, 'Weakness', 'weakness', NULL, NULL, 1, NULL, '2020-10-06 05:59:06', '2020-10-06 05:59:06'),
(160, 'Wheezing', 'wheezing', NULL, NULL, 1, NULL, '2020-10-06 05:59:06', '2020-10-06 05:59:06'),
(161, 'Yellowish Skin Discoloration', 'yellowish-skin-discoloration', NULL, NULL, 1, NULL, '2020-10-06 05:59:06', '2020-10-06 05:59:06'),
(162, 'BURNING MICTURATION', 'burning-micturation', NULL, NULL, 1, NULL, '2020-10-06 05:59:06', '2020-10-06 05:59:06'),
(163, 'T', 't', NULL, NULL, 1, NULL, '2020-10-06 05:59:06', '2020-10-06 05:59:06'),
(164, 'A', 'a', NULL, NULL, 1, NULL, '2020-10-06 05:59:06', '2020-10-06 05:59:06'),
(165, 'Cheilitis', 'cheilitis', NULL, NULL, 1, NULL, '2020-10-06 05:59:06', '2020-10-06 05:59:06'),
(166, 'Stomach Ache', 'stomach-ache', NULL, NULL, 1, NULL, '2020-10-06 05:59:06', '2020-10-06 05:59:06'),
(167, 'Hyperkalemia', 'hyperkalemia', NULL, NULL, 1, NULL, '2020-10-06 05:59:06', '2020-10-06 05:59:06');

-- --------------------------------------------------------

--
-- Table structure for table `referral_practitioners`
--

CREATE TABLE `referral_practitioners` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `hospital` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualification_id` int(11) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referral_practitioners`
--

INSERT INTO `referral_practitioners` (`id`, `name`, `phone`, `gender`, `age`, `hospital`, `address`, `image`, `qualification_id`, `status`, `created_at`, `updated_at`) VALUES
(62, 'Prof. Ali Jawa', '042-111-945-227', NULL, NULL, NULL, '4-m, Model Town Ext. Lahore, Pakistan', NULL, NULL, 1, '2020-10-07 06:57:21', '2020-10-07 06:57:21'),
(63, 'Prof. Azim Jehangir Khan', '+92 42 35775666', NULL, NULL, NULL, 'Cosmetique, Sir Zafar Ali Road, Lahore', NULL, NULL, 1, '2020-10-07 06:57:21', '2020-10-07 06:57:21'),
(64, 'Dr. Ali Madeeh Hashmi', '0321-405-8589', NULL, NULL, NULL, 'Wilcare, 4-m, Model Town Extension, Lahore', NULL, NULL, 1, '2020-10-07 06:57:21', '2020-10-07 06:57:21'),
(65, 'Dr. Kamran Babar', '0304-1110366', NULL, NULL, NULL, ' call Eon Health At', NULL, NULL, 1, '2020-10-07 06:57:21', '2020-10-07 06:57:21'),
(66, 'Dr. Qasim Bashir', '0345-8242505', NULL, NULL, NULL, '18-b Shadman Colony, Jail Road, Lahore', NULL, NULL, 1, '2020-10-07 06:57:21', '2020-10-07 06:57:21'),
(67, 'Dr. Nighat Mir', '042-111-171-819', NULL, NULL, NULL, 'National Hospital, Dha, Lahore', NULL, NULL, 1, '2020-10-07 06:57:21', '2020-10-07 06:57:21'),
(68, 'Prof. Mumtaz Jabeen Babar', '042 3586 8868', NULL, NULL, NULL, '5-c, Model Town', NULL, NULL, 1, '2020-10-07 06:57:21', '2020-10-07 06:57:21'),
(69, 'Dr. Khaleeq Ur Rehman', '042-111-000-043', NULL, NULL, NULL, 'Hameed Latif Hospital, Opposite Gaddafi Stadium', NULL, NULL, 1, '2020-10-07 06:57:21', '2020-10-07 06:57:21'),
(70, 'Prof. Nadeem Hafeez Butt', '042-35315524', NULL, NULL, NULL, 'Hafeez Eye Center, 12 - Sunflower Society, J - 1 Johar Town, Off Canal Bank Road', NULL, NULL, 1, '2020-10-07 06:57:21', '2020-10-07 06:57:21'),
(71, 'Dr. Shahid Hamid', '042 3516 2183, 042 3516 0363', NULL, NULL, NULL, 'Faisal Town', NULL, NULL, 1, '2020-10-07 06:57:21', '2020-10-07 06:57:21'),
(72, 'Prof. Hafiz Ijaz Ahmed', NULL, NULL, NULL, NULL, 'Horizon Hospital, Johar Town', NULL, NULL, 1, '2020-10-07 06:57:21', '2020-10-07 06:57:21'),
(73, 'Dr. Muhammad Daud', '0344 717 9364, 042 3521 8848', NULL, NULL, NULL, 'Mehboob Fatima Medical Center, 82-l, Model Town', NULL, NULL, 1, '2020-10-07 06:57:21', '2020-10-07 06:57:21'),
(74, 'Prof. Aftab Asif', NULL, NULL, NULL, NULL, 'Nari, Garden Town', NULL, NULL, 1, '2020-10-07 06:57:21', '2020-10-07 06:57:21'),
(75, 'Prof. Asghar Naqi', '0333 422 6508', NULL, NULL, NULL, 'Mehboob Fatima Medical Center, 82-l, Model Town', NULL, NULL, 1, '2020-10-07 06:57:21', '2020-10-07 06:57:21'),
(76, 'Dr. Mushahida Batool', NULL, NULL, NULL, NULL, 'Omar Hospital', NULL, NULL, 1, '2020-10-07 06:57:22', '2020-10-07 06:57:22'),
(77, 'Prof. Arshad Kamal Butt', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:22', '2020-10-07 06:57:22'),
(78, 'Prof. Abul Fazal Khan', NULL, NULL, NULL, NULL, 'Mid Citi Hospital, Near Pic, Jail Road, Lahore', NULL, NULL, 1, '2020-10-07 06:57:22', '2020-10-07 06:57:22'),
(79, 'Dr. Mirza Ayub Baig', '0345 411 9695', NULL, NULL, NULL, 'Faisal Hospital, Faisal Town', NULL, NULL, 1, '2020-10-07 06:57:22', '2020-10-07 06:57:22'),
(80, 'Dr. Rubina Aslam', '+92 42 35220922', NULL, NULL, NULL, 'Neuro Clinic, Near Johar Banquet Hall, Johar Town, Lahore', NULL, NULL, 1, '2020-10-07 06:57:22', '2020-10-07 06:57:22'),
(81, 'Prof. Khalid Masood Gondal', '+92 333 4227392', NULL, NULL, NULL, 'Omc, Opposite Kinnaird College, Jail Road, Lahore', NULL, NULL, 1, '2020-10-07 06:57:22', '2020-10-07 06:57:22'),
(82, 'Prof. Najam Ul Hassan', NULL, NULL, NULL, NULL, 'Iqra Medical Centre, Near Akbar Chowk, Johar Town', NULL, NULL, 1, '2020-10-07 06:57:22', '2020-10-07 06:57:22'),
(83, 'Prof. Wasim Amir', NULL, NULL, NULL, NULL, 'Mid Citi Hospital, Near Pic, Jail Road', NULL, NULL, 1, '2020-10-07 06:57:23', '2020-10-07 06:57:23'),
(84, 'Dr. Ahsan Shamim', '042 111 155 555', NULL, NULL, NULL, 'Shaukat Khanum Hospital, Johar Town', NULL, NULL, 1, '2020-10-07 06:57:23', '2020-10-07 06:57:23'),
(85, 'Dr. Syed Arsalan Khalid', '+92 307 4239999', NULL, NULL, NULL, 'Hameed Latif Hospital, Opposite Gaddafi Stadium', NULL, NULL, 1, '2020-10-07 06:57:23', '2020-10-07 06:57:23'),
(86, 'Dr. Wasif Gilani', '(042) 37312860', NULL, NULL, NULL, 'Haq Orthopedic, Sanda Road, Lahore', NULL, NULL, 1, '2020-10-07 06:57:23', '2020-10-07 06:57:23'),
(87, 'Dr. Muhammad Mujtaba', '0322 4029630', NULL, NULL, NULL, 'Hameed Latif Hospital, Opposite Gaddafi Stadium', NULL, NULL, 1, '2020-10-07 06:57:23', '2020-10-07 06:57:23'),
(88, 'Dr. Tanveer Ul Islam', '042 35728761', NULL, NULL, NULL, 'National Hospital, Dha, Lahore', NULL, NULL, 1, '2020-10-07 06:57:23', '2020-10-07 06:57:23'),
(89, 'Dr. Israr Ul Haqtoor', NULL, NULL, NULL, NULL, 'Wilcare, 4-m, Model Town Ext. Lahore', NULL, NULL, 1, '2020-10-07 06:57:23', '2020-10-07 06:57:23'),
(90, 'Dr. Faheem Butt', '042 35742291', NULL, NULL, NULL, 'Defence Medical Group, Dd Phase Iv, Dha, Lahore', NULL, NULL, 1, '2020-10-07 06:57:23', '2020-10-07 06:57:23'),
(91, 'Dr. Fozia', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:23', '2020-10-07 06:57:23'),
(92, 'Dr. Abdul Nadir', '+92 344 2002011', NULL, NULL, NULL, 'Gas Clinic', NULL, NULL, 1, '2020-10-07 06:57:24', '2020-10-07 06:57:24'),
(93, 'Ms. Ambreen Ali', '0301-4510853', NULL, NULL, NULL, 'Wilcare, 4-m, Model Town Extension, Lahore', NULL, NULL, 1, '2020-10-07 06:57:24', '2020-10-07 06:57:24'),
(94, 'Eye Specialist', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:24', '2020-10-07 06:57:24'),
(95, 'Gastroenterologist', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:24', '2020-10-07 06:57:24'),
(96, 'Gynecologist', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:24', '2020-10-07 06:57:24'),
(97, 'Nephrologist', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:24', '2020-10-07 06:57:24'),
(98, 'Neurologist', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:24', '2020-10-07 06:57:24'),
(99, 'Neurosurgeon', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:24', '2020-10-07 06:57:24'),
(100, 'Oncologist', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:25', '2020-10-07 06:57:25'),
(101, 'Orthopedic Surgeon', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:25', '2020-10-07 06:57:25'),
(102, 'Psychiatrist', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:25', '2020-10-07 06:57:25'),
(103, 'Pulmonologist', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:25', '2020-10-07 06:57:25'),
(104, 'Rheumatologist', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:25', '2020-10-07 06:57:25'),
(105, 'Skin Specialist', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:25', '2020-10-07 06:57:25'),
(106, 'Surgeon', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:25', '2020-10-07 06:57:25'),
(107, 'Urologist', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:25', '2020-10-07 06:57:25'),
(108, 'Dr Khalid', NULL, NULL, NULL, NULL, 'Lahore', NULL, NULL, 1, '2020-10-07 06:57:25', '2020-10-07 06:57:25'),
(109, 'Dr. Nadia Mushtaq', '0300-8431124', NULL, NULL, NULL, '5a Faisal Town, Lahore', NULL, NULL, 1, '2020-10-07 06:57:25', '2020-10-07 06:57:25'),
(110, 'Dr. Muhammad Hussain', '042-111-627-663', NULL, NULL, NULL, 'Masood Hospital, Lahore', NULL, NULL, 1, '2020-10-07 06:57:26', '2020-10-07 06:57:26'),
(111, 'Prof. Dr. Hafiz Ijaz Ahmed', '042-381-02940', NULL, NULL, NULL, 'Pakistan Kidney And Liver Institute, Lahore', NULL, NULL, 1, '2020-10-07 06:57:26', '2020-10-07 06:57:26'),
(112, 'Dr. Shafeeq Cheema', '0315-2381111', NULL, NULL, NULL, 'National Hospital, Dha, Lahore', NULL, NULL, 1, '2020-10-07 06:57:26', '2020-10-07 06:57:26'),
(113, 'Dr. Asim Riaz', NULL, NULL, NULL, NULL, '4-m, Model Town Ext. Lahore, Pakistan', NULL, NULL, 1, '2020-10-07 06:57:26', '2020-10-07 06:57:26'),
(114, 'Dr. Mujahida Salamat', NULL, NULL, NULL, NULL, '4-m, Model Town Ext. Lahore, Pakistan', NULL, NULL, 1, '2020-10-07 06:57:26', '2020-10-07 06:57:26'),
(115, 'Dr. Rashid Rasheed', '042-111 945 227', NULL, NULL, NULL, 'Wilcare, 4-m, Model Town Extension', NULL, NULL, 1, '2020-10-07 06:57:26', '2020-10-07 06:57:26'),
(116, 'Dr. Fatima', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:26', '2020-10-07 06:57:26'),
(117, 'Wilshire C & D For', '0321-945 2273', NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:26', '2020-10-07 06:57:26'),
(118, 'Dr. S. Abbas Raza', NULL, NULL, NULL, NULL, 'Shaukat Khanum Memorial Cancer Hospital, Lahore', NULL, NULL, 1, '2020-10-07 06:57:27', '2020-10-07 06:57:27'),
(119, 'Dr', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:27', '2020-10-07 06:57:27'),
(120, 'Saima', NULL, NULL, NULL, NULL, 'Null', NULL, NULL, 1, '2020-10-07 06:57:27', '2020-10-07 06:57:27');

-- --------------------------------------------------------

--
-- Table structure for table `relations`
--

CREATE TABLE `relations` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `relations`
--

INSERT INTO `relations` (`id`, `title`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Daughter', 1, NULL, NULL, NULL),
(2, 'Father', 1, NULL, NULL, NULL),
(3, 'Grandfather', 1, NULL, NULL, NULL),
(4, 'Grandmother', 1, NULL, NULL, NULL),
(5, 'Mother', 1, NULL, NULL, NULL),
(6, 'Sister', 1, NULL, NULL, NULL),
(7, 'Maternal Uncle', 1, NULL, NULL, NULL),
(8, 'Paternal Uncle', 1, NULL, NULL, NULL),
(9, 'Maternal Aunt', 1, NULL, NULL, NULL),
(10, 'Paternal Aunt', 1, NULL, NULL, NULL),
(11, 'Brother', 1, NULL, '2019-03-13 09:14:28', '2019-03-13 09:14:28');

-- --------------------------------------------------------

--
-- Table structure for table `review_systems`
--

CREATE TABLE `review_systems` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_visit_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `patient_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `second_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `third_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review_systems`
--

INSERT INTO `review_systems` (`id`, `patient_visit_id`, `practitioner_id`, `practitioner_name`, `patient_id`, `patient_name`, `first_description`, `second_description`, `third_description`, `created_at`, `updated_at`) VALUES
(2, 95, 10, 'Dr. Abdullah', 24, 'Mr. John Doe', 'Test', 'Hi', 'Hello', '2021-03-24 06:40:38', '2021-03-24 06:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `rx_medicines`
--

CREATE TABLE `rx_medicines` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_visit_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `patient_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medicine_id` int(11) UNSIGNED NOT NULL,
  `medicine_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dose_id` int(11) UNSIGNED DEFAULT NULL,
  `dose_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_id` int(11) UNSIGNED DEFAULT NULL,
  `unit_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frequency_id` int(11) UNSIGNED NOT NULL,
  `frequency_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration_id` int(11) UNSIGNED NOT NULL,
  `duration_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diagnosis_type_id` int(11) UNSIGNED NOT NULL,
  `diagnosis_type_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rx_medicines`
--

INSERT INTO `rx_medicines` (`id`, `patient_visit_id`, `practitioner_id`, `practitioner_name`, `patient_id`, `patient_name`, `medicine_id`, `medicine_name`, `dose_id`, `dose_name`, `unit_id`, `unit_name`, `frequency_id`, `frequency_name`, `duration_id`, `duration_name`, `diagnosis_type_id`, `diagnosis_type_name`, `created_at`, `updated_at`) VALUES
(14, 95, 10, 'Dr. Abdullah', 24, 'Mr. John Doe', 3332, 'A2a', 1474, '50', 41, 'MG', 101, 'One Tablet Daily', 4, 'Ongoing', 12, 'Blood Pressure', '2021-03-24 06:40:49', '2021-03-24 06:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `smoking_histories`
--

CREATE TABLE `smoking_histories` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_visit_id` int(11) UNSIGNED NOT NULL,
  `practitioner_id` int(11) UNSIGNED NOT NULL,
  `practitioner_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patient_id` int(11) UNSIGNED NOT NULL,
  `patient_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ever_smoke` tinyint(1) NOT NULL DEFAULT 0,
  `still_smoke` tinyint(1) NOT NULL DEFAULT 0,
  `no_of_years` int(11) DEFAULT NULL,
  `cig_per_day` int(11) DEFAULT NULL,
  `ever_drink` tinyint(1) NOT NULL DEFAULT 0,
  `still_drink` tinyint(1) NOT NULL DEFAULT 0,
  `drink_remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ever_use_drugs` tinyint(1) NOT NULL DEFAULT 0,
  `still_use_drugs` tinyint(1) NOT NULL DEFAULT 0,
  `what_drug_use` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `how_use_drug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `smoking_histories`
--

INSERT INTO `smoking_histories` (`id`, `patient_visit_id`, `practitioner_id`, `practitioner_name`, `patient_id`, `patient_name`, `ever_smoke`, `still_smoke`, `no_of_years`, `cig_per_day`, `ever_drink`, `still_drink`, `drink_remarks`, `ever_use_drugs`, `still_use_drugs`, `what_drug_use`, `how_use_drug`, `created_at`, `updated_at`) VALUES
(18, 95, 10, NULL, 24, 'Mr. John Doe', 1, 0, NULL, NULL, 1, 1, 'Test', 1, 1, 'No', 'No', '2021-03-24 06:50:53', '2021-03-24 06:50:53');

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

CREATE TABLE `specialties` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`id`, `title`, `slug`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Gynaecologist', 'gynaecologist', 1, NULL, '2020-08-31 07:35:09', '2020-10-14 13:03:01'),
(2, 'Endocrinologist', 'endocrinologist', 1, NULL, '2020-08-31 07:35:40', '2020-10-14 10:20:07'),
(3, 'Cardiologist', 'cardiologist', 1, NULL, '2020-11-03 21:39:47', '2020-11-03 21:39:47');

-- --------------------------------------------------------

--
-- Table structure for table `surgeries`
--

CREATE TABLE `surgeries` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surgeries`
--

INSERT INTO `surgeries` (`id`, `title`, `slug`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 'Above Knee Amputation Bilateral', 'above-knee-amputation-bilateral', 1, NULL, '2020-10-07 06:07:43', '2020-10-07 06:07:43'),
(6, 'Above Knee Amputation Left', 'above-knee-amputation-left', 1, NULL, '2020-10-07 06:07:43', '2020-10-07 06:07:43'),
(7, 'Anterior Cervical Discectomy', 'anterior-cervical-discectomy', 1, NULL, '2020-10-07 06:07:43', '2020-10-07 06:07:43'),
(8, 'Appendectomy', 'appendectomy', 1, NULL, '2020-10-07 06:07:43', '2020-10-07 06:07:43'),
(9, 'Arthroscopy', 'arthroscopy', 1, NULL, '2020-10-07 06:07:43', '2020-10-07 06:07:43'),
(10, 'Bleeding Haemorrhoids', 'bleeding-haemorrhoids', 1, NULL, '2020-10-07 06:07:43', '2020-10-07 06:07:43'),
(11, 'C-section', 'c-section', 1, NULL, '2020-10-07 06:07:43', '2020-10-07 06:07:43'),
(12, 'Cabg', 'cabg', 1, NULL, '2020-10-07 06:07:43', '2020-10-07 06:07:43'),
(13, 'Cabg And Aortic Valve Replacement', 'cabg-and-aortic-valve-replacement', 1, NULL, '2020-10-07 06:07:43', '2020-10-07 06:07:43'),
(14, 'Cabg-3vcad', 'cabg-3vcad', 1, NULL, '2020-10-07 06:07:44', '2020-10-07 06:07:44'),
(15, 'Cataract Surgery', 'cataract-surgery', 1, NULL, '2020-10-07 06:07:44', '2020-10-07 06:07:44'),
(16, 'Cholcystectomy', 'cholcystectomy', 1, NULL, '2020-10-07 06:07:44', '2020-10-07 06:07:44'),
(17, 'Cholecystectomy', 'cholecystectomy', 1, NULL, '2020-10-07 06:07:44', '2020-10-07 06:07:44'),
(18, 'Craniotomy', 'craniotomy', 1, NULL, '2020-10-07 06:07:44', '2020-10-07 06:07:44'),
(19, 'Eye Surgery', 'eye-surgery', 1, NULL, '2020-10-07 06:07:44', '2020-10-07 06:07:44'),
(20, 'Fibroids', 'fibroids', 1, NULL, '2020-10-07 06:07:44', '2020-10-07 06:07:44'),
(21, 'Fracture', 'fracture', 1, NULL, '2020-10-07 06:07:44', '2020-10-07 06:07:44'),
(22, 'Gastric Banding', 'gastric-banding', 1, NULL, '2020-10-07 06:07:44', '2020-10-07 06:07:44'),
(23, 'Gastric Sleeve', 'gastric-sleeve', 1, NULL, '2020-10-07 06:07:44', '2020-10-07 06:07:44'),
(24, 'Haemorrhoids Surgery', 'haemorrhoids-surgery', 1, NULL, '2020-10-07 06:07:44', '2020-10-07 06:07:44'),
(25, 'Hemorrhoidectomy', 'hemorrhoidectomy', 1, NULL, '2020-10-07 06:07:44', '2020-10-07 06:07:44'),
(26, 'Hernia', 'hernia', 1, NULL, '2020-10-07 06:07:45', '2020-10-07 06:07:45'),
(27, 'Hernia Operation', 'hernia-operation', 1, NULL, '2020-10-07 06:07:45', '2020-10-07 06:07:45'),
(28, 'Hernioraphy', 'hernioraphy', 1, NULL, '2020-10-07 06:07:45', '2020-10-07 06:07:45'),
(29, 'Hip Surgery', 'hip-surgery', 1, NULL, '2020-10-07 06:07:45', '2020-10-07 06:07:45'),
(30, 'Hip Surgey', 'hip-surgey', 1, NULL, '2020-10-07 06:07:45', '2020-10-07 06:07:45'),
(31, 'Hysterectomy', 'hysterectomy', 1, NULL, '2020-10-07 06:07:45', '2020-10-07 06:07:45'),
(32, 'Hysterectomy With Bilateral Oophorectomy', 'hysterectomy-with-bilateral-oophorectomy', 1, NULL, '2020-10-07 06:07:45', '2020-10-07 06:07:45'),
(33, 'Inguinal Hernia Surgery', 'inguinal-hernia-surgery', 1, NULL, '2020-10-07 06:07:45', '2020-10-07 06:07:45'),
(34, 'Laparotomy', 'laparotomy', 1, NULL, '2020-10-07 06:07:45', '2020-10-07 06:07:45'),
(35, 'Laser Both Eyes', 'laser-both-eyes', 1, NULL, '2020-10-07 06:07:45', '2020-10-07 06:07:45'),
(36, 'Left Hip Replacement', 'left-hip-replacement', 1, NULL, '2020-10-07 06:07:45', '2020-10-07 06:07:45'),
(37, 'Left Knee Replacement', 'left-knee-replacement', 1, NULL, '2020-10-07 06:07:45', '2020-10-07 06:07:45'),
(38, 'Left Tibial Fracture', 'left-tibial-fracture', 1, NULL, '2020-10-07 06:07:45', '2020-10-07 06:07:45'),
(39, 'Liposuction', 'liposuction', 1, NULL, '2020-10-07 06:07:46', '2020-10-07 06:07:46'),
(40, 'Lumpectomy Rt Breast', 'lumpectomy-rt-breast', 1, NULL, '2020-10-07 06:07:46', '2020-10-07 06:07:46'),
(41, 'Mastectomy', 'mastectomy', 1, NULL, '2020-10-07 06:07:46', '2020-10-07 06:07:46'),
(42, 'Nephrectomy', 'nephrectomy', 1, NULL, '2020-10-07 06:07:46', '2020-10-07 06:07:46'),
(43, 'Pacemaker Placement', 'pacemaker-placement', 1, NULL, '2020-10-07 06:07:46', '2020-10-07 06:07:46'),
(44, 'Parathyroidectomy', 'parathyroidectomy', 1, NULL, '2020-10-07 06:07:46', '2020-10-07 06:07:46'),
(45, 'Patial Lobectomy Of Throid Gland', 'patial-lobectomy-of-throid-gland', 1, NULL, '2020-10-07 06:07:46', '2020-10-07 06:07:46'),
(46, 'Prostatectomy', 'prostatectomy', 1, NULL, '2020-10-07 06:07:46', '2020-10-07 06:07:46'),
(47, 'Renal Transplant', 'renal-transplant', 1, NULL, '2020-10-07 06:07:46', '2020-10-07 06:07:46'),
(48, 'Right Breast Lump Removal', 'right-breast-lump-removal', 1, NULL, '2020-10-07 06:07:46', '2020-10-07 06:07:46'),
(49, 'Right Inguinal Hernia Repair 2011', 'right-inguinal-hernia-repair-2011', 1, NULL, '2020-10-07 06:07:46', '2020-10-07 06:07:46'),
(50, 'Right Nephrectomy', 'right-nephrectomy', 1, NULL, '2020-10-07 06:07:46', '2020-10-07 06:07:46'),
(51, 'Right Sided Lumpactomy With Axillary Clearance', 'right-sided-lumpactomy-with-axillary-clearance', 1, NULL, '2020-10-07 06:07:46', '2020-10-07 06:07:46'),
(52, 'Rt Knee Replacement', 'rt-knee-replacement', 1, NULL, '2020-10-07 06:07:46', '2020-10-07 06:07:46'),
(53, 'Rt.scrotal Hernia', 'rtscrotal-hernia', 1, NULL, '2020-10-07 06:07:47', '2020-10-07 06:07:47'),
(54, 'Shoulder Surgery', 'shoulder-surgery', 1, NULL, '2020-10-07 06:07:47', '2020-10-07 06:07:47'),
(55, 'Spinal Surgery', 'spinal-surgery', 1, NULL, '2020-10-07 06:07:47', '2020-10-07 06:07:47'),
(56, 'Stomach Stapling', 'stomach-stapling', 1, NULL, '2020-10-07 06:07:47', '2020-10-07 06:07:47'),
(57, 'Stones Gall Bladder', 'stones-gall-bladder', 1, NULL, '2020-10-07 06:07:47', '2020-10-07 06:07:47'),
(58, 'Subtotal Thyroidectomy', 'subtotal-thyroidectomy', 1, NULL, '2020-10-07 06:07:47', '2020-10-07 06:07:47'),
(59, 'Tah With Bso', 'tah-with-bso', 1, NULL, '2020-10-07 06:07:47', '2020-10-07 06:07:47'),
(60, 'Throidectomy', 'throidectomy', 1, NULL, '2020-10-07 06:07:47', '2020-10-07 06:07:47'),
(61, 'Thyoidectomy', 'thyoidectomy', 1, NULL, '2020-10-07 06:07:47', '2020-10-07 06:07:47'),
(62, 'Thyroid Lobectomy', 'thyroid-lobectomy', 1, NULL, '2020-10-07 06:07:47', '2020-10-07 06:07:47'),
(63, 'Thyroidectomy', 'thyroidectomy', 1, NULL, '2020-10-07 06:07:47', '2020-10-07 06:07:47'),
(64, 'Tonsillectomy', 'tonsillectomy', 1, NULL, '2020-10-07 06:07:47', '2020-10-07 06:07:47'),
(65, 'Total Abdominal Hysterectomy', 'total-abdominal-hysterectomy', 1, NULL, '2020-10-07 06:07:48', '2020-10-07 06:07:48'),
(66, 'Total Abdominal Hysterectomy With Bilateral Salpingo Oophorectomy', 'total-abdominal-hysterectomy-with-bilateral-salpingo-oophorectomy', 1, NULL, '2020-10-07 06:07:48', '2020-10-07 06:07:48'),
(67, 'Transfrontal Sp', 'transfrontal-sp', 1, NULL, '2020-10-07 06:07:48', '2020-10-07 06:07:48'),
(68, 'Turp', 'turp', 1, NULL, '2020-10-07 06:07:48', '2020-10-07 06:07:48'),
(69, 'Ureter Procedure', 'ureter-procedure', 1, NULL, '2020-10-07 06:07:48', '2020-10-07 06:07:48'),
(70, 'Urinary Tract Infectio', 'urinary-tract-infectio', 1, NULL, '2020-10-07 06:07:48', '2020-10-07 06:07:48'),
(71, 'Testjun19', 'testjun19', 1, '2020-10-08 05:50:52', '2020-10-07 06:07:48', '2020-10-08 05:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) UNSIGNED NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(41, 'MG', 1, NULL, '2020-10-07 05:37:02', '2020-10-07 05:37:02'),
(42, 'MG/ML', 1, NULL, '2020-10-07 05:37:02', '2020-10-07 05:37:02'),
(43, 'ML', 1, NULL, '2020-10-07 05:37:02', '2020-10-07 05:37:02'),
(44, 'Units', 1, NULL, '2020-10-07 05:37:03', '2020-10-07 05:37:03'),
(45, 'AU', 1, NULL, '2020-10-07 05:37:03', '2020-10-07 05:37:03'),
(46, 'MCG', 1, NULL, '2020-10-07 05:37:03', '2020-10-07 05:37:03'),
(47, 'Tab', 1, NULL, '2020-10-07 05:37:03', '2020-10-07 05:37:03'),
(48, 'Forte Tab', 1, NULL, '2020-10-07 05:37:03', '2020-10-07 05:37:03'),
(49, 'Tablet', 1, NULL, '2020-10-07 05:37:03', '2020-10-07 05:37:03'),
(50, '(in glass of water)', 1, NULL, '2020-10-07 05:37:03', '2020-10-07 05:37:03'),
(51, 'Oint', 1, NULL, '2020-10-07 05:37:03', '2020-10-07 05:37:03'),
(52, 'Lotion', 1, NULL, '2020-10-07 05:37:03', '2020-10-07 05:37:03'),
(53, 'IU', 1, NULL, '2020-10-07 05:37:03', '2020-10-07 05:37:03'),
(54, 'Cream', 1, NULL, '2020-10-07 05:37:03', '2020-10-07 05:37:03'),
(55, 'GM', 1, NULL, '2020-10-07 05:37:03', '2020-10-07 05:37:03'),
(56, '-100', 1, NULL, '2020-10-07 05:37:04', '2020-10-07 05:37:04'),
(57, '55mcg/actu', 1, NULL, '2020-10-07 05:37:04', '2020-10-07 05:37:04'),
(58, 'Clicks', 1, NULL, '2020-10-07 05:37:04', '2020-10-07 05:37:04'),
(59, '250/400 mg/5mL', 1, NULL, '2020-10-07 05:37:04', '2020-10-07 05:37:04'),
(60, 'MG/IU', 1, NULL, '2020-10-07 05:37:04', '2020-10-07 05:37:04'),
(61, 'Balm', 1, NULL, '2020-10-07 05:37:04', '2020-10-07 05:37:04'),
(62, 'puff', 1, NULL, '2020-10-07 05:37:05', '2020-10-07 05:37:05'),
(63, ' ', 1, NULL, '2020-10-07 05:37:05', '2020-10-07 05:37:05'),
(64, 'NULL', 1, NULL, '2020-10-07 05:37:05', '2020-10-07 05:37:05'),
(65, 'NA', 1, NULL, '2020-10-07 05:37:05', '2020-10-07 05:37:05'),
(66, 'TSF', 1, NULL, '2020-10-07 05:37:05', '2020-10-07 05:37:05'),
(67, '50MG/ML', 1, NULL, '2020-10-07 05:37:05', '2020-10-07 05:37:05'),
(68, '5ML', 1, NULL, '2020-10-07 05:37:05', '2020-10-07 05:37:05'),
(69, 'unit', 1, NULL, '2020-10-07 05:37:05', '2020-10-07 05:37:05'),
(70, '5MG/5ML', 1, NULL, '2020-10-07 05:37:05', '2020-10-07 05:37:05'),
(71, 'DROPS', 1, NULL, '2020-10-07 05:37:05', '2020-10-07 05:37:05'),
(72, '10 ml', 1, NULL, '2020-10-07 05:37:05', '2020-10-07 05:37:05'),
(73, '2.5 ML', 1, NULL, '2020-10-07 05:37:05', '2020-10-07 05:37:05'),
(74, 'MINS', 1, NULL, '2020-10-07 05:37:05', '2020-10-07 05:37:05'),
(75, '100mcg/20ml', 1, NULL, '2020-10-07 05:37:05', '2020-10-07 05:37:05'),
(76, 'Spoon', 1, NULL, '2020-10-07 05:37:06', '2020-10-07 05:37:06'),
(77, 'CAPSULES', 1, NULL, '2020-10-07 05:37:06', '2020-10-07 05:37:06'),
(78, 'TBS', 1, NULL, '2020-10-07 05:37:06', '2020-10-07 05:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `status`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@tekcure.com', '$2y$10$0ncBsboLm7HIevTAP/QNPOGbFKpo/vLrBUMmKf3NwtgChDdMTEFwy', 1, NULL, NULL, '2020-08-31 04:00:00', '2020-08-31 04:00:00'),
(2, 'Abdullah', 'abdullah.tektiks@gmail.com', '$2y$10$3QP5dhKfpH1ucTL3iygeR.jW9wewMllj.syof/7v36yylTwGQNe2e', 1, NULL, NULL, '2020-08-31 07:03:51', '2020-09-24 09:50:47'),
(3, 'customercare', 'customercare@wilcare.org', '$2y$10$3SYOK0t9YLLvNUaj4UJZdOM/WvU6Wg/0giUQUhZZC0.36qcRnhy.q', 1, NULL, NULL, '2020-11-05 20:06:07', '2020-11-05 20:06:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `permission_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_permissions`
--

INSERT INTO `user_permissions` (`id`, `user_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-08-31 06:00:00', '2020-08-31 05:00:00'),
(2, 1, 2, '2020-08-31 06:00:00', '2020-08-31 05:00:00'),
(3, 1, 3, '2020-08-31 06:00:00', '2020-08-31 05:00:00'),
(4, 1, 4, '2020-08-31 06:00:00', '2020-08-31 05:00:00'),
(5, 1, 5, '2020-08-31 06:00:00', '2020-08-31 05:00:00'),
(6, 1, 6, '2020-08-31 06:00:00', '2020-08-31 05:00:00'),
(7, 1, 7, '2020-08-31 06:00:00', '2020-08-31 05:00:00'),
(14, 1, 8, NULL, NULL),
(15, 1, 9, NULL, NULL),
(16, 1, 10, NULL, NULL),
(17, 1, 11, NULL, NULL),
(18, 1, 12, NULL, NULL),
(19, 1, 13, NULL, NULL),
(20, 1, 14, NULL, NULL),
(21, 1, 15, NULL, NULL),
(22, 1, 17, NULL, NULL),
(23, 1, 18, NULL, NULL),
(24, 1, 19, NULL, NULL),
(25, 1, 20, NULL, NULL),
(26, 1, 21, NULL, NULL),
(27, 1, 22, NULL, NULL),
(28, 1, 23, NULL, NULL),
(29, 1, 24, '2020-09-10 03:00:00', '2020-09-10 05:00:00'),
(30, 1, 25, '2020-09-10 03:00:00', '2020-09-10 05:00:00'),
(31, 1, 26, '2020-09-10 03:00:00', '2020-09-10 05:00:00'),
(32, 1, 27, '2020-09-10 03:00:00', '2020-09-10 05:00:00'),
(33, 1, 28, '2020-09-10 03:00:00', '2020-09-10 05:00:00'),
(34, 1, 29, '2020-09-10 03:00:00', '2020-09-10 05:00:00'),
(35, 1, 30, '2020-09-10 03:00:00', '2020-09-10 05:00:00'),
(36, 1, 31, '2020-09-10 03:00:00', '2020-09-10 05:00:00'),
(37, 1, 32, '2020-09-10 03:00:00', '2020-09-10 05:00:00'),
(38, 2, 8, NULL, NULL),
(39, 3, 11, NULL, NULL),
(40, 3, 17, NULL, NULL),
(41, 1, 33, '2020-09-10 03:00:00', '2020-09-10 05:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adrs`
--
ALTER TABLE `adrs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adrs_patient_visit_id_index` (`patient_visit_id`),
  ADD KEY `adrs_practitioner_id_index` (`practitioner_id`),
  ADD KEY `adrs_patient_id_index` (`patient_id`),
  ADD KEY `adrs_drug_id_index` (`drug_id`),
  ADD KEY `adrs_reaction_id_index` (`reaction_id`);

--
-- Indexes for table `adr_reactions`
--
ALTER TABLE `adr_reactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adr_reactions_adr_id_index` (`adr_id`),
  ADD KEY `adr_reactions_reaction_id_index` (`reaction_id`);

--
-- Indexes for table `agora_tokens`
--
ALTER TABLE `agora_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allergies`
--
ALTER TABLE `allergies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `allergies_title_unique` (`title`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `appointments_assistant_id_index` (`assistant_id`) USING BTREE,
  ADD KEY `appointments_patient_id_index` (`patient_id`),
  ADD KEY `appointments_practitioner_id_index` (`practitioner_id`),
  ADD KEY `appointments_clinic_id_index` (`clinic_id`),
  ADD KEY `appointments_patient_type_id_index` (`patient_type_id`);

--
-- Indexes for table `assistants`
--
ALTER TABLE `assistants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `assistants_phone_unique` (`phone`),
  ADD KEY `assistants_qualification_id_index` (`qualification_id`);

--
-- Indexes for table `assistant_specialties`
--
ALTER TABLE `assistant_specialties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assistant_specialties_assistant_id_index` (`assistant_id`),
  ADD KEY `assistant_specialties_specialty_id_index` (`specialty_id`);

--
-- Indexes for table `clinics`
--
ALTER TABLE `clinics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clinics_email_unique` (`email`);

--
-- Indexes for table `clinic_configs`
--
ALTER TABLE `clinic_configs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clinic_configs_clinic_id_index` (`clinic_id`);

--
-- Indexes for table `clinic_config_facilities`
--
ALTER TABLE `clinic_config_facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clinic_config_facilities_clinic_config_id_index` (`clinic_config_id`),
  ADD KEY `clinic_config_facilities_facility_id_index` (`facility_id`);

--
-- Indexes for table `clinic_config_lab_tests`
--
ALTER TABLE `clinic_config_lab_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clinic_config_lab_tests_clinic_config_id_index` (`clinic_config_id`),
  ADD KEY `clinic_config_lab_tests_lab_test_id_index` (`lab_test_id`);

--
-- Indexes for table `clinic_config_medications`
--
ALTER TABLE `clinic_config_medications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clinic_config_medications_clinic_config_id_index` (`clinic_config_id`),
  ADD KEY `clinic_config_medications_medication_id_index` (`medication_id`);

--
-- Indexes for table `clinic_config_specialties`
--
ALTER TABLE `clinic_config_specialties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clinic_config_specialties_clinic_config_id_index` (`clinic_config_id`),
  ADD KEY `clinic_config_specialties_specialty_id_index` (`specialty_id`);

--
-- Indexes for table `clinic_departments`
--
ALTER TABLE `clinic_departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clinic_departments_clinic_id_index` (`clinic_id`),
  ADD KEY `clinic_departments_department_id_index` (`department_id`);

--
-- Indexes for table `clinic_facilities`
--
ALTER TABLE `clinic_facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clinic_facilities_clinic_id_index` (`clinic_id`),
  ADD KEY `clinic_facilities_facility_id_index` (`facility_id`);

--
-- Indexes for table `clinic_lab_tests`
--
ALTER TABLE `clinic_lab_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clinic_lab_tests_clinic_id_index` (`clinic_id`),
  ADD KEY `clinic_lab_tests_lab_test_id_index` (`lab_test_id`);

--
-- Indexes for table `clinic_medications`
--
ALTER TABLE `clinic_medications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clinic_medications_clinic_id_index` (`clinic_id`),
  ADD KEY `clinic_medications_medication_id_index` (`medication_id`);

--
-- Indexes for table `clinic_specialties`
--
ALTER TABLE `clinic_specialties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clinic_specialties_clinic_id_index` (`clinic_id`),
  ADD KEY `clinic_specialties_specialty_id_index` (`specialty_id`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `configurations_practitioner_id_index` (`practitioner_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_title_unique` (`title`);

--
-- Indexes for table `diagnosis_types`
--
ALTER TABLE `diagnosis_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `diagnosis_types_type_unique` (`type`) USING BTREE;

--
-- Indexes for table `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `diseases_title_unique` (`title`);

--
-- Indexes for table `doses`
--
ALTER TABLE `doses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doses_dose_unique` (`dose`) USING BTREE;

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `drugs_title_unique` (`title`);

--
-- Indexes for table `durations`
--
ALTER TABLE `durations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `durations_duration_unique` (`duration`) USING BTREE;

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `facilities_title_unique` (`title`);

--
-- Indexes for table `family_medical_histories`
--
ALTER TABLE `family_medical_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `family_medical_histories_patient_visit_id_index` (`patient_visit_id`),
  ADD KEY `family_medical_histories_practitioner_id_index` (`practitioner_id`),
  ADD KEY `family_medical_histories_patient_id_index` (`patient_id`),
  ADD KEY `family_medical_histories_relation_id_index` (`relation_id`),
  ADD KEY `family_medical_histories_disease_id_index` (`disease_id`);

--
-- Indexes for table `favourite_labs`
--
ALTER TABLE `favourite_labs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favourite_labs_practitioner_id_index` (`practitioner_id`),
  ADD KEY `favourite_labs_lab_test_id_index` (`lab_test_id`);

--
-- Indexes for table `frequencies`
--
ALTER TABLE `frequencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `histories_patient_visit_id_index` (`patient_visit_id`),
  ADD KEY `histories_practitioner_id_index` (`practitioner_id`),
  ADD KEY `histories_patient_id_index` (`patient_id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hospitals_email_unique` (`email`),
  ADD UNIQUE KEY `hospitals_contact_no_unique` (`contact_no`);

--
-- Indexes for table `hospital_days`
--
ALTER TABLE `hospital_days`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospital_days_hospital_id_index` (`hospital_id`);

--
-- Indexes for table `hospital_departments`
--
ALTER TABLE `hospital_departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospital_departments_hospital_id_index` (`hospital_id`),
  ADD KEY `hospital_departments_department_id_index` (`department_id`);

--
-- Indexes for table `hospital_facilities`
--
ALTER TABLE `hospital_facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospital_facilities_hospital_id_index` (`hospital_id`),
  ADD KEY `hospital_facilities_facility_id_index` (`facility_id`);

--
-- Indexes for table `labs`
--
ALTER TABLE `labs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `labs_slug_unique` (`slug`);

--
-- Indexes for table `lab_tests`
--
ALTER TABLE `lab_tests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lab_tests_title_unique` (`title`),
  ADD KEY `lab_tests_lab_id_index` (`lab_id`);

--
-- Indexes for table `lab_test_types`
--
ALTER TABLE `lab_test_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lab_test_types_slug_unique` (`slug`);

--
-- Indexes for table `medications`
--
ALTER TABLE `medications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medications_dose_id_index` (`dose_id`),
  ADD KEY `medications_unit_id_index` (`unit_id`),
  ADD KEY `medications_frequency_id_index` (`frequency_id`),
  ADD KEY `medications_duration_id_index` (`duration_id`),
  ADD KEY `medications_diagnosis_type_id_index` (`diagnosis_type_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `past_medical_histories`
--
ALTER TABLE `past_medical_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `past_medical_histories_patient_visit_id_index` (`patient_visit_id`),
  ADD KEY `past_medical_histories_practitioner_id_index` (`practitioner_id`),
  ADD KEY `past_medical_histories_patient_id_index` (`patient_id`),
  ADD KEY `past_medical_histories_disease_id_index` (`disease_id`);

--
-- Indexes for table `past_surgical_histories`
--
ALTER TABLE `past_surgical_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `past_surgical_histories_patient_visit_id_index` (`patient_visit_id`),
  ADD KEY `past_surgical_histories_practitioner_id_index` (`practitioner_id`),
  ADD KEY `past_surgical_histories_patient_id_index` (`patient_id`),
  ADD KEY `past_surgical_histories_surgery_id_index` (`surgery_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patients_mr_number_unique` (`mr_number`),
  ADD UNIQUE KEY `patients_phone_unique` (`phone`),
  ADD KEY `patients_patient_type_id_index` (`patient_type_id`) USING BTREE;

--
-- Indexes for table `patient_allergies`
--
ALTER TABLE `patient_allergies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_allergies_patient_id_index` (`patient_id`),
  ADD KEY `patient_allergies_allergy_id_index` (`allergy_id`);

--
-- Indexes for table `patient_attachments`
--
ALTER TABLE `patient_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_attachments_patient_visit_id_index` (`patient_visit_id`),
  ADD KEY `patient_attachments_practitioner_id_index` (`practitioner_id`),
  ADD KEY `patient_attachments_patient_id_index` (`patient_id`);

--
-- Indexes for table `patient_drugs`
--
ALTER TABLE `patient_drugs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_drugs_patient_id_index` (`patient_id`),
  ADD KEY `patient_drugs_drug_id_index` (`drug_id`);

--
-- Indexes for table `patient_lab_tests`
--
ALTER TABLE `patient_lab_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_lab_tests_patient_visit_id_index` (`patient_visit_id`),
  ADD KEY `patient_lab_tests_practitioner_id_index` (`practitioner_id`),
  ADD KEY `patient_lab_tests_patient_id_index` (`patient_id`),
  ADD KEY `patient_lab_tests_lab_test_id_index` (`lab_test_id`);

--
-- Indexes for table `patient_medications`
--
ALTER TABLE `patient_medications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_medications_patient_visit_id_index` (`patient_visit_id`),
  ADD KEY `patient_medications_practitioner_id_index` (`practitioner_id`),
  ADD KEY `patient_medications_patient_id_index` (`patient_id`);

--
-- Indexes for table `patient_prescriptions`
--
ALTER TABLE `patient_prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_prescriptions_patient_id_index` (`patient_id`),
  ADD KEY `patient_prescriptions_practitioner_id_index` (`practitioner_id`),
  ADD KEY `patient_prescriptions_clinic_id_index` (`clinic_id`);

--
-- Indexes for table `patient_referral_practitioners`
--
ALTER TABLE `patient_referral_practitioners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_referral_practitioners_patient_visit_id_index` (`patient_visit_id`),
  ADD KEY `patient_referral_practitioners_practitioner_id_index` (`practitioner_id`),
  ADD KEY `patient_referral_practitioners_patient_id_index` (`patient_id`),
  ADD KEY `patient_referral_practitioners_referral_practitioner_id_index` (`referral_practitioner_id`);

--
-- Indexes for table `patient_reports`
--
ALTER TABLE `patient_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_reports_patient_id_index` (`patient_id`);

--
-- Indexes for table `patient_special_dosages`
--
ALTER TABLE `patient_special_dosages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_special_dosages_patient_medication_id_index` (`patient_medication_id`);

--
-- Indexes for table `patient_sugar_charts`
--
ALTER TABLE `patient_sugar_charts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_sugar_charts_patient_visit_id_index` (`patient_visit_id`),
  ADD KEY `patient_sugar_charts_practitioner_id_index` (`practitioner_id`),
  ADD KEY `patient_sugar_charts_patient_id_index` (`patient_id`);

--
-- Indexes for table `patient_templates`
--
ALTER TABLE `patient_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_templates_patient_visit_id_index` (`patient_visit_id`),
  ADD KEY `patient_templates_practitioner_id_index` (`practitioner_id`),
  ADD KEY `patient_templates_patient_id_index` (`patient_id`);

--
-- Indexes for table `patient_types`
--
ALTER TABLE `patient_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patient_types_title_unique` (`title`);

--
-- Indexes for table `patient_visits`
--
ALTER TABLE `patient_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_visits_practitioner_id_index` (`practitioner_id`),
  ADD KEY `patient_visits_patient_id_index` (`patient_id`),
  ADD KEY `patient_visits_appointment_id_index` (`appointment_id`) USING BTREE;

--
-- Indexes for table `patient_visit_prescriptions`
--
ALTER TABLE `patient_visit_prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_visit_prescriptions_patient_visit_id_index` (`patient_visit_id`);

--
-- Indexes for table `patient_vitals`
--
ALTER TABLE `patient_vitals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_vitals_patient_visit_id_index` (`patient_visit_id`),
  ADD KEY `patient_vitals_practitioner_id_index` (`practitioner_id`),
  ADD KEY `patient_vitals_patient_id_index` (`patient_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_patient_id_index` (`patient_id`),
  ADD KEY `payments_practitioner_id_index` (`practitioner_id`),
  ADD KEY `payments_appointment_id_index` (`appointment_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `physical_examinations`
--
ALTER TABLE `physical_examinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `physical_examinations_patient_visit_id_index` (`patient_visit_id`),
  ADD KEY `physical_examinations_practitioner_id_index` (`practitioner_id`),
  ADD KEY `physical_examinations_patient_id_index` (`patient_id`),
  ADD KEY `physical_examinations_physical_exam_id_index` (`physical_exam_id`);

--
-- Indexes for table `physical_exams`
--
ALTER TABLE `physical_exams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `physical_exams_title_unique` (`title`);

--
-- Indexes for table `practitioners`
--
ALTER TABLE `practitioners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `practitioners_phone_unique` (`phone`),
  ADD KEY `practitioners_qualification_id_index` (`qualification_id`);

--
-- Indexes for table `practitioner_assistants`
--
ALTER TABLE `practitioner_assistants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `practitioner_assistants_assistant_id_index` (`assistant_id`),
  ADD KEY `practitioner_assistants_practitioner_id_index` (`practitioner_id`);

--
-- Indexes for table `practitioner_clinics`
--
ALTER TABLE `practitioner_clinics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `practitioner_clinics_practitioner_id_index` (`practitioner_id`),
  ADD KEY `practitioner_clinics_clinic_id_index` (`clinic_id`);

--
-- Indexes for table `practitioner_clinic_days`
--
ALTER TABLE `practitioner_clinic_days`
  ADD PRIMARY KEY (`id`),
  ADD KEY `practitioner_clinic_days_practitioner_clinic_id_index` (`practitioner_clinic_id`);

--
-- Indexes for table `practitioner_days`
--
ALTER TABLE `practitioner_days`
  ADD PRIMARY KEY (`id`),
  ADD KEY `practitioners_practitioner_id_index` (`practitioner_id`) USING BTREE;

--
-- Indexes for table `practitioner_lab_tests`
--
ALTER TABLE `practitioner_lab_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `practitioner_lab_tests_practitioner_id_index` (`practitioner_id`),
  ADD KEY `practitioner_lab_tests_lab_test_id_index` (`lab_test_id`);

--
-- Indexes for table `practitioner_specialties`
--
ALTER TABLE `practitioner_specialties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `practitioner_specialties_practitioner_id_index` (`practitioner_id`),
  ADD KEY `practitioner_specialties_specialty_id_index` (`specialty_id`) USING BTREE;

--
-- Indexes for table `prescription_allergies`
--
ALTER TABLE `prescription_allergies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescription_allergies_patient_prescription_id_index` (`patient_prescription_id`),
  ADD KEY `prescription_allergies_allergy_id_index` (`allergy_id`);

--
-- Indexes for table `prescription_medications`
--
ALTER TABLE `prescription_medications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescription_medications_patient_prescription_id_index` (`patient_prescription_id`),
  ADD KEY `prescription_medications_medication_id_index` (`medication_id`);

--
-- Indexes for table `prescription_templates`
--
ALTER TABLE `prescription_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescription_templates_practitioner_id_index` (`practitioner_id`) USING BTREE;

--
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `qualifications_title_unique` (`title`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reactions_title_unique` (`title`),
  ADD KEY `reactions_drug_id_index` (`drug_id`) USING BTREE;

--
-- Indexes for table `referral_practitioners`
--
ALTER TABLE `referral_practitioners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `referral_practitioners_phone_unique` (`phone`),
  ADD KEY `referral_practitioners_qualification_id_index` (`qualification_id`);

--
-- Indexes for table `relations`
--
ALTER TABLE `relations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `relations_title_unique` (`title`);

--
-- Indexes for table `review_systems`
--
ALTER TABLE `review_systems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_systems_patient_visit_id_index` (`patient_visit_id`),
  ADD KEY `review_systems_practitioner_id_index` (`practitioner_id`),
  ADD KEY `review_systems_patient_id_index` (`patient_id`);

--
-- Indexes for table `rx_medicines`
--
ALTER TABLE `rx_medicines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rx_medicines_patient_visit_id_index` (`patient_visit_id`),
  ADD KEY `rx_medicines_practitioner_id_index` (`practitioner_id`),
  ADD KEY `rx_medicines_patient_id_index` (`patient_id`),
  ADD KEY `rx_medicines_medicine_id_index` (`medicine_id`),
  ADD KEY `rx_medicines_dose_id_index` (`dose_id`),
  ADD KEY `rx_medicines_unit_id_index` (`unit_id`),
  ADD KEY `rx_medicines_frequency_id_index` (`frequency_id`),
  ADD KEY `rx_medicines_duration_id_index` (`duration_id`),
  ADD KEY `rx_medicines_diagnose_type_id_index` (`diagnosis_type_id`);

--
-- Indexes for table `smoking_histories`
--
ALTER TABLE `smoking_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `smoking_histories_patient_visit_id_index` (`patient_visit_id`),
  ADD KEY `smoking_histories_practitioner_id_index` (`practitioner_id`),
  ADD KEY `smoking_histories_patient_id_index` (`patient_id`);

--
-- Indexes for table `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `specialties_title_unique` (`title`);

--
-- Indexes for table `surgeries`
--
ALTER TABLE `surgeries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `surgeries_title_unique` (`title`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `units_unit_unique` (`unit`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_permissions_user_id_index` (`user_id`),
  ADD KEY `user_permissions_permission_id_index` (`permission_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adrs`
--
ALTER TABLE `adrs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `adr_reactions`
--
ALTER TABLE `adr_reactions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `agora_tokens`
--
ALTER TABLE `agora_tokens`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `allergies`
--
ALTER TABLE `allergies`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `assistants`
--
ALTER TABLE `assistants`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `assistant_specialties`
--
ALTER TABLE `assistant_specialties`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `clinics`
--
ALTER TABLE `clinics`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clinic_configs`
--
ALTER TABLE `clinic_configs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clinic_config_facilities`
--
ALTER TABLE `clinic_config_facilities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clinic_config_lab_tests`
--
ALTER TABLE `clinic_config_lab_tests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clinic_config_medications`
--
ALTER TABLE `clinic_config_medications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clinic_config_specialties`
--
ALTER TABLE `clinic_config_specialties`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clinic_departments`
--
ALTER TABLE `clinic_departments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clinic_facilities`
--
ALTER TABLE `clinic_facilities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clinic_specialties`
--
ALTER TABLE `clinic_specialties`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `diagnosis_types`
--
ALTER TABLE `diagnosis_types`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=527;

--
-- AUTO_INCREMENT for table `diseases`
--
ALTER TABLE `diseases`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=485;

--
-- AUTO_INCREMENT for table `doses`
--
ALTER TABLE `doses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1812;

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `durations`
--
ALTER TABLE `durations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `family_medical_histories`
--
ALTER TABLE `family_medical_histories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `favourite_labs`
--
ALTER TABLE `favourite_labs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frequencies`
--
ALTER TABLE `frequencies`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hospital_days`
--
ALTER TABLE `hospital_days`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hospital_departments`
--
ALTER TABLE `hospital_departments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hospital_facilities`
--
ALTER TABLE `hospital_facilities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `labs`
--
ALTER TABLE `labs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `lab_tests`
--
ALTER TABLE `lab_tests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=776;

--
-- AUTO_INCREMENT for table `lab_test_types`
--
ALTER TABLE `lab_test_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medications`
--
ALTER TABLE `medications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3744;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `past_medical_histories`
--
ALTER TABLE `past_medical_histories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `past_surgical_histories`
--
ALTER TABLE `past_surgical_histories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `patient_allergies`
--
ALTER TABLE `patient_allergies`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `patient_attachments`
--
ALTER TABLE `patient_attachments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_drugs`
--
ALTER TABLE `patient_drugs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `patient_lab_tests`
--
ALTER TABLE `patient_lab_tests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `patient_medications`
--
ALTER TABLE `patient_medications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_prescriptions`
--
ALTER TABLE `patient_prescriptions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_referral_practitioners`
--
ALTER TABLE `patient_referral_practitioners`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `patient_reports`
--
ALTER TABLE `patient_reports`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `patient_special_dosages`
--
ALTER TABLE `patient_special_dosages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_sugar_charts`
--
ALTER TABLE `patient_sugar_charts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `patient_templates`
--
ALTER TABLE `patient_templates`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_types`
--
ALTER TABLE `patient_types`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient_visits`
--
ALTER TABLE `patient_visits`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `patient_visit_prescriptions`
--
ALTER TABLE `patient_visit_prescriptions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `patient_vitals`
--
ALTER TABLE `patient_vitals`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `physical_examinations`
--
ALTER TABLE `physical_examinations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `physical_exams`
--
ALTER TABLE `physical_exams`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `practitioners`
--
ALTER TABLE `practitioners`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `practitioner_assistants`
--
ALTER TABLE `practitioner_assistants`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `practitioner_clinics`
--
ALTER TABLE `practitioner_clinics`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `practitioner_clinic_days`
--
ALTER TABLE `practitioner_clinic_days`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT for table `practitioner_days`
--
ALTER TABLE `practitioner_days`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `practitioner_lab_tests`
--
ALTER TABLE `practitioner_lab_tests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `practitioner_specialties`
--
ALTER TABLE `practitioner_specialties`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `prescription_allergies`
--
ALTER TABLE `prescription_allergies`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription_medications`
--
ALTER TABLE `prescription_medications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription_templates`
--
ALTER TABLE `prescription_templates`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `referral_practitioners`
--
ALTER TABLE `referral_practitioners`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `relations`
--
ALTER TABLE `relations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `review_systems`
--
ALTER TABLE `review_systems`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rx_medicines`
--
ALTER TABLE `rx_medicines`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `smoking_histories`
--
ALTER TABLE `smoking_histories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `specialties`
--
ALTER TABLE `specialties`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `surgeries`
--
ALTER TABLE `surgeries`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adrs`
--
ALTER TABLE `adrs`
  ADD CONSTRAINT `adrs_drug_id_foreign` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adrs_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adrs_patient_visit_id_foreign` FOREIGN KEY (`patient_visit_id`) REFERENCES `patient_visits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adrs_practitioner_id_foreign` FOREIGN KEY (`practitioner_id`) REFERENCES `practitioners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adrs_reaction_id_foreign` FOREIGN KEY (`reaction_id`) REFERENCES `reactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_assistant_id_foreign` FOREIGN KEY (`assistant_id`) REFERENCES `assistants` (`id`),
  ADD CONSTRAINT `appointments_clinic_id_foreign` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_patient_type_id_foreign` FOREIGN KEY (`patient_type_id`) REFERENCES `patient_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_practitioner_id_foreign` FOREIGN KEY (`practitioner_id`) REFERENCES `practitioners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assistants`
--
ALTER TABLE `assistants`
  ADD CONSTRAINT `assistants_qualification_id_foreign` FOREIGN KEY (`qualification_id`) REFERENCES `qualifications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assistant_specialties`
--
ALTER TABLE `assistant_specialties`
  ADD CONSTRAINT `assistant_specialties_assistant_id_foreign` FOREIGN KEY (`assistant_id`) REFERENCES `assistants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assistant_specialties_specialty_id_foreign` FOREIGN KEY (`specialty_id`) REFERENCES `specialties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `clinic_departments`
--
ALTER TABLE `clinic_departments`
  ADD CONSTRAINT `clinic_departments_clinic_id_foreign` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clinic_departments_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `clinic_facilities`
--
ALTER TABLE `clinic_facilities`
  ADD CONSTRAINT `clinic_facilities_clinic_id_foreign` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clinic_facilities_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `clinic_lab_tests`
--
ALTER TABLE `clinic_lab_tests`
  ADD CONSTRAINT `clinic_lab_tests_clinic_id_foreign` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clinic_lab_tests_lab_test_id_foreign` FOREIGN KEY (`lab_test_id`) REFERENCES `lab_tests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `clinic_medications`
--
ALTER TABLE `clinic_medications`
  ADD CONSTRAINT `clinic_medications_clinic_id_foreign` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clinic_medications_medication_id_foreign` FOREIGN KEY (`medication_id`) REFERENCES `medications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `clinic_specialties`
--
ALTER TABLE `clinic_specialties`
  ADD CONSTRAINT `clinic_specialties_clinic_id_foreign` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clinic_specialties_specialty_id_foreign` FOREIGN KEY (`specialty_id`) REFERENCES `specialties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `configurations`
--
ALTER TABLE `configurations`
  ADD CONSTRAINT `configurations_practitioner_id_foreign` FOREIGN KEY (`practitioner_id`) REFERENCES `practitioners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `family_medical_histories`
--
ALTER TABLE `family_medical_histories`
  ADD CONSTRAINT `family_medical_histories_disease_id_foreign` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `family_medical_histories_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `family_medical_histories_patient_visit_id_foreign` FOREIGN KEY (`patient_visit_id`) REFERENCES `patient_visits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `family_medical_histories_practitioner_id_foreign` FOREIGN KEY (`practitioner_id`) REFERENCES `practitioners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `family_medical_histories_relation_id_foreign` FOREIGN KEY (`relation_id`) REFERENCES `relations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favourite_labs`
--
ALTER TABLE `favourite_labs`
  ADD CONSTRAINT `favourite_labs_lab_test_id_foreign` FOREIGN KEY (`lab_test_id`) REFERENCES `lab_tests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourite_labs_practitioner_id_foreign` FOREIGN KEY (`practitioner_id`) REFERENCES `practitioners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `histories`
--
ALTER TABLE `histories`
  ADD CONSTRAINT `histories_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `histories_patient_visit_id_foreign` FOREIGN KEY (`patient_visit_id`) REFERENCES `patient_visits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `histories_practitioner_id_foreign` FOREIGN KEY (`practitioner_id`) REFERENCES `practitioners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medications`
--
ALTER TABLE `medications`
  ADD CONSTRAINT `medications_diagnosis_type_id_foreign` FOREIGN KEY (`diagnosis_type_id`) REFERENCES `diagnosis_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medications_dose_id_foreign` FOREIGN KEY (`dose_id`) REFERENCES `doses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medications_duration_id_foreign` FOREIGN KEY (`duration_id`) REFERENCES `durations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medications_frequency_id_foreign` FOREIGN KEY (`frequency_id`) REFERENCES `frequencies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medications_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `past_medical_histories`
--
ALTER TABLE `past_medical_histories`
  ADD CONSTRAINT `past_medical_histories_disease_id_foreign` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `past_medical_histories_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `past_medical_histories_patient_visit_id_foreign` FOREIGN KEY (`patient_visit_id`) REFERENCES `patient_visits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `past_medical_histories_practitioner_id_foreign` FOREIGN KEY (`practitioner_id`) REFERENCES `practitioners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `past_surgical_histories`
--
ALTER TABLE `past_surgical_histories`
  ADD CONSTRAINT `past_surgical_histories_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `past_surgical_histories_patient_visit_id_foreign` FOREIGN KEY (`patient_visit_id`) REFERENCES `patient_visits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `past_surgical_histories_practitioner_id_foreign` FOREIGN KEY (`practitioner_id`) REFERENCES `practitioners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `past_surgical_histories_surgery_id_foreign` FOREIGN KEY (`surgery_id`) REFERENCES `surgeries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_patient_type_id_foreign` FOREIGN KEY (`patient_type_id`) REFERENCES `patient_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_allergies`
--
ALTER TABLE `patient_allergies`
  ADD CONSTRAINT `patient_allergies_allergy_id_foreign` FOREIGN KEY (`allergy_id`) REFERENCES `allergies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_allergies_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_attachments`
--
ALTER TABLE `patient_attachments`
  ADD CONSTRAINT `patient_attachments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_attachments_patient_visit_id_foreign` FOREIGN KEY (`patient_visit_id`) REFERENCES `patient_visits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_attachments_practitioner_id_foreign` FOREIGN KEY (`practitioner_id`) REFERENCES `practitioners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_drugs`
--
ALTER TABLE `patient_drugs`
  ADD CONSTRAINT `patient_drugs_drug_id_foreign` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_drugs_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_lab_tests`
--
ALTER TABLE `patient_lab_tests`
  ADD CONSTRAINT `patient_lab_tests_lab_test_id_foreign` FOREIGN KEY (`lab_test_id`) REFERENCES `lab_tests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_lab_tests_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_lab_tests_patient_visit_id_foreign` FOREIGN KEY (`patient_visit_id`) REFERENCES `patient_visits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_lab_tests_practitioner_id_foreign` FOREIGN KEY (`practitioner_id`) REFERENCES `practitioners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_medications`
--
ALTER TABLE `patient_medications`
  ADD CONSTRAINT `patient_medications_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_medications_patient_visit_id_foreign` FOREIGN KEY (`patient_visit_id`) REFERENCES `patient_visits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_medications_practitioner_id_foreign` FOREIGN KEY (`practitioner_id`) REFERENCES `practitioners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_prescriptions`
--
ALTER TABLE `patient_prescriptions`
  ADD CONSTRAINT `patient_prescriptions_clinic_id_foreign` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_prescriptions_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_prescriptions_practitioner_id_foreign` FOREIGN KEY (`practitioner_id`) REFERENCES `practitioners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_referral_practitioners`
--
ALTER TABLE `patient_referral_practitioners`
  ADD CONSTRAINT `patient_referral_practitioners_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_referral_practitioners_patient_visit_id_foreign` FOREIGN KEY (`patient_visit_id`) REFERENCES `patient_visits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_referral_practitioners_practitioner_id_foreign` FOREIGN KEY (`practitioner_id`) REFERENCES `practitioners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_referral_practitioners_referral_practitioner_id_foreign` FOREIGN KEY (`referral_practitioner_id`) REFERENCES `practitioners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_reports`
--
ALTER TABLE `patient_reports`
  ADD CONSTRAINT `patient_reports_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_special_dosages`
--
ALTER TABLE `patient_special_dosages`
  ADD CONSTRAINT `patient_special_dosages_patient_medication_id_foreign` FOREIGN KEY (`patient_medication_id`) REFERENCES `patient_medications` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_sugar_charts`
--
ALTER TABLE `patient_sugar_charts`
  ADD CONSTRAINT `patient_sugar_charts_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_sugar_charts_patient_visit_id_foreign` FOREIGN KEY (`patient_visit_id`) REFERENCES `patient_visits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_sugar_charts_practitioner_id_foreign` FOREIGN KEY (`practitioner_id`) REFERENCES `practitioners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_templates`
--
ALTER TABLE `patient_templates`
  ADD CONSTRAINT `patient_templates_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_templates_patient_visit_id_foreign` FOREIGN KEY (`patient_visit_id`) REFERENCES `patient_visits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_templates_practitioner_id_foreign` FOREIGN KEY (`practitioner_id`) REFERENCES `practitioners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_visits`
--
ALTER TABLE `patient_visits`
  ADD CONSTRAINT `patient_visits_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_visits_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_visits_practitioner_id_foreign` FOREIGN KEY (`practitioner_id`) REFERENCES `practitioners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_visit_prescriptions`
--
ALTER TABLE `patient_visit_prescriptions`
  ADD CONSTRAINT `patient_visit_prescriptions_patient_visit_id_foreign` FOREIGN KEY (`patient_visit_id`) REFERENCES `patient_visits` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_vitals`
--
ALTER TABLE `patient_vitals`
  ADD CONSTRAINT `patient_vitals_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_vitals_patient_visit_id_foreign` FOREIGN KEY (`patient_visit_id`) REFERENCES `patient_visits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_vitals_practitioner_id_foreign` FOREIGN KEY (`practitioner_id`) REFERENCES `practitioners` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
