-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2024 at 03:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sklps_student`
--

-- --------------------------------------------------------

--
-- Table structure for table `document_type`
--

CREATE TABLE `document_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_type`
--

INSERT INTO `document_type` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'SSC', NULL, NULL),
(2, 'HSC', NULL, NULL),
(3, 'Leaving', NULL, NULL),
(4, 'Semester 1', NULL, NULL),
(5, 'Semester 2', NULL, NULL),
(6, 'Semester 3', NULL, NULL),
(7, 'Semester 4', NULL, NULL),
(8, 'Semester 5', NULL, NULL),
(9, 'Semester 6', NULL, NULL),
(10, 'Semester 7', NULL, NULL),
(11, 'Semester 8', NULL, NULL),
(12, 'Collage Fees Receipt', NULL, NULL),
(13, 'Degree Certificate', NULL, NULL),
(14, 'Aadhar Card Front', NULL, NULL),
(15, 'CPT', NULL, NULL),
(16, 'IPCC', NULL, NULL),
(17, 'CA Final', NULL, NULL),
(18, 'Passport', NULL, NULL),
(19, 'Others', NULL, NULL),
(20, 'Aadhar Card Back', NULL, NULL),
(21, 'Parent Aadhar Card Front', NULL, NULL),
(22, 'Parent Aadhar Card Back', NULL, NULL),
(23, 'Internship Offer Letter', NULL, NULL),
(24, 'Collage Fees Receipt 2', NULL, NULL),
(25, 'Collage Fees Receipt 3', NULL, NULL),
(26, 'Collage Fees Receipt 4', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `document_type`
--
ALTER TABLE `document_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `document_type`
--
ALTER TABLE `document_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
