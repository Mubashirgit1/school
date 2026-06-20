-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2018 at 01:06 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tecnogat_smart_school_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountants`
--

CREATE TABLE `accountants` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `address` text,
  `dob` date DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `role`, `email`, `password`, `is_active`, `created_at`, `updated_at`) VALUES
(5, 'Admin', 'admin', 'mohammadwaseem043@gmail.com', '5113233408ea2f22610c3d6df814f697', 'yes', '2017-09-18 04:03:12', '0000-00-00 00:00:00'),
(6, 'Admin', 'admin', 'urwa@gmail.com', '202cb962ac59075b964b07152d234b70', 'yes', '2017-09-20 07:50:44', '0000-00-00 00:00:00'),
(7, 'Amina', 'admin', 'amina@gmail.com', '2e38b89bd4397cc10c043fec77b2f615', 'yes', '2017-09-20 13:23:10', '0000-00-00 00:00:00'),
(9, 'Admin', 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'yes', '2017-10-11 06:18:22', '0000-00-00 00:00:00'),
(12, 'adnan', 'user', 'adnan@gmail.com', 'd1a0a9e9391af09e978c4c3d11711e75', 'yes', '2018-08-08 07:53:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `admin_permissions`
--

CREATE TABLE `admin_permissions` (
  `id` int(30) NOT NULL,
  `admin_id` int(30) NOT NULL,
  `admission_form` int(16) NOT NULL,
  `delete_fee` int(16) NOT NULL,
  `academics` int(16) NOT NULL,
  `arrears_adjust` int(16) NOT NULL,
  `edit_teacher` int(16) NOT NULL,
  `balancesheet_figures` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_permissions`
--

INSERT INTO `admin_permissions` (`id`, `admin_id`, `admission_form`, `delete_fee`, `academics`, `arrears_adjust`, `edit_teacher`, `balancesheet_figures`) VALUES
(6, 12, 1, 0, 0, 0, 1, 0),
(7, 5, 0, 0, 0, 0, 0, 0),
(8, 6, 0, 0, 0, 0, 0, 0),
(10, 7, 0, 0, 0, 0, 0, 0),
(11, 10, 0, 0, 0, 0, 0, 0),
(18, 9, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendence_type`
--

CREATE TABLE `attendence_type` (
  `id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key_value` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attendence_type`
--

INSERT INTO `attendence_type` (`id`, `type`, `key_value`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Present', '<b class="text text-success">P</b>', 'yes', '2016-06-24 09:11:37', '0000-00-00 00:00:00'),
(2, 'Late with excuse', '<b class="text text-warning">E</b>', 'no', '2018-08-27 08:03:11', '0000-00-00 00:00:00'),
(3, 'Leave', '<b class="text text-warning">L</b>', 'yes', '2018-08-27 08:01:04', '0000-00-00 00:00:00'),
(4, 'Absent', '<b class="text text-danger">A</b>', 'yes', '2016-10-12 02:35:40', '0000-00-00 00:00:00'),
(5, 'Holiday', 'H', 'yes', '2016-10-12 02:35:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `book_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `book_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `isbn_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rack_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `publish` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `perunitcost` float(10,2) DEFAULT NULL,
  `postdate` date DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `available` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'yes',
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_title`, `book_no`, `isbn_no`, `subject`, `rack_no`, `publish`, `author`, `qty`, `perunitcost`, `postdate`, `description`, `available`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'test', 'asdf', 'sdf', 'asdf', 'asdf', 'asdf', 'asdf', 1, 123.00, '2017-10-20', 'asdf', 'yes', 'no', '2017-10-22 12:15:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `book_issues`
--

CREATE TABLE `book_issues` (
  `id` int(11) UNSIGNED NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `issue_date` date NOT NULL,
  `is_returned` int(10) NOT NULL DEFAULT '0',
  `member_id` int(11) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book_issues`
--

INSERT INTO `book_issues` (`id`, `book_id`, `return_date`, `issue_date`, `is_returned`, `member_id`, `is_active`, `created_at`) VALUES
(1, 1, '2017-10-22', '2017-10-22', 1, 1, 'no', '2017-10-22 12:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Regular', 'no', '2017-10-02 04:49:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fee` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class`, `fee`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'KG', 1000, 'no', '2017-10-19 04:15:43', '0000-00-00 00:00:00'),
(2, '1', 2000, 'no', '2017-10-19 04:15:48', '0000-00-00 00:00:00'),
(3, 'UKG', 3000, 'no', '2017-10-19 04:15:52', '0000-00-00 00:00:00'),
(4, 'CCNA', 15000, 'no', '2017-11-17 04:46:17', '0000-00-00 00:00:00'),
(5, 'test class', 1000, 'no', '2018-03-16 06:13:34', '0000-00-00 00:00:00'),
(6, 'again test class', 100, 'no', '2018-04-01 06:59:25', '0000-00-00 00:00:00'),
(7, 'test11', 1000, 'no', '2018-05-16 07:15:12', '0000-00-00 00:00:00'),
(8, 'test12', 1000, 'no', '2018-05-16 07:48:57', '0000-00-00 00:00:00'),
(9, 'test6', 2000, 'no', '2018-05-26 23:36:08', '0000-00-00 00:00:00'),
(10, 'test7', 3000, 'no', '2018-05-26 23:38:08', '0000-00-00 00:00:00'),
(11, 'FREE TEST', 2500, 'no', '2018-06-01 22:52:31', '0000-00-00 00:00:00'),
(12, 'newtest', 2500, 'no', '2018-06-02 21:58:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `class_promotion_demotion`
--

CREATE TABLE `class_promotion_demotion` (
  `id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `promoted` int(11) NOT NULL,
  `demoted` int(11) NOT NULL,
  `new_admission` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class_promotion_demotion`
--

INSERT INTO `class_promotion_demotion` (`id`, `session_id`, `class_id`, `section_id`, `promoted`, `demoted`, `new_admission`) VALUES
(1, 12, 1, 1, 0, 0, 15),
(2, 12, 2, 1, 0, 0, 3),
(3, 12, 4, 1, 0, 0, 2),
(4, 12, 3, 1, 0, 0, 6),
(5, 12, 5, 1, 0, 0, 1),
(6, 12, 6, 1, 0, 0, 2),
(7, 12, 7, 1, 0, 0, 5),
(8, 12, 8, 1, 0, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `class_sections`
--

CREATE TABLE `class_sections` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `class_incharge_teacher_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `class_sections`
--

INSERT INTO `class_sections` (`id`, `class_id`, `section_id`, `is_active`, `class_incharge_teacher_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'no', 1, '2017-11-19 09:25:23', '0000-00-00 00:00:00'),
(2, 2, 1, 'no', NULL, '2017-09-20 08:08:26', '0000-00-00 00:00:00'),
(3, 3, 1, 'no', 4, '2017-11-19 09:50:59', '0000-00-00 00:00:00'),
(4, 4, 1, 'no', NULL, '2017-11-17 04:46:17', '0000-00-00 00:00:00'),
(5, 5, 1, 'no', NULL, '2018-03-16 06:13:34', '0000-00-00 00:00:00'),
(6, 6, 1, 'no', NULL, '2018-04-01 06:59:25', '0000-00-00 00:00:00'),
(7, 6, 2, 'no', NULL, '2018-04-01 06:59:25', '0000-00-00 00:00:00'),
(8, 7, 1, 'no', NULL, '2018-05-16 07:15:12', '0000-00-00 00:00:00'),
(9, 8, 1, 'no', NULL, '2018-05-16 07:48:57', '0000-00-00 00:00:00'),
(10, 9, 1, 'no', NULL, '2018-05-26 23:36:08', '0000-00-00 00:00:00'),
(11, 10, 1, 'no', NULL, '2018-05-26 23:38:08', '0000-00-00 00:00:00'),
(12, 11, 1, 'no', NULL, '2018-06-01 22:52:31', '0000-00-00 00:00:00'),
(13, 12, 1, 'no', NULL, '2018-06-02 21:58:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `class_section_monthly_logs`
--

CREATE TABLE `class_section_monthly_logs` (
  `id` int(11) NOT NULL,
  `class_section_id` int(11) NOT NULL,
  `total_students` int(10) UNSIGNED NOT NULL,
  `total_tuition_fee` int(10) UNSIGNED NOT NULL,
  `total_other_fee` int(10) UNSIGNED NOT NULL,
  `receiveable_total_fee` int(10) UNSIGNED NOT NULL,
  `receiveable_total_received` int(10) UNSIGNED NOT NULL,
  `overall_receivable` int(10) UNSIGNED NOT NULL,
  `struck_off` int(10) UNSIGNED NOT NULL,
  `discount` int(10) UNSIGNED NOT NULL,
  `class_section_fee_arrears` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `class_section_advance_fee` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `log_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class_section_monthly_logs`
--

INSERT INTO `class_section_monthly_logs` (`id`, `class_section_id`, `total_students`, `total_tuition_fee`, `total_other_fee`, `receiveable_total_fee`, `receiveable_total_received`, `overall_receivable`, `struck_off`, `discount`, `class_section_fee_arrears`, `class_section_advance_fee`, `log_date`) VALUES
(208, 1, 28, 20150, 4850, 17890, 20150, 281690, 0, 10110, 271290, 0, '2018-07-01'),
(209, 2, 15, 72800, 1000917, 22300, 72800, 242250, 0, 7700, 243000, 1400, '2018-07-01'),
(210, 3, 6, 0, 0, 18000, 0, 221550, 0, 0, 221550, 0, '2018-07-01'),
(211, 4, 2, 0, 0, 30000, 0, 196600, 0, 0, 197450, 850, '2018-07-01'),
(212, 5, 1, 0, 0, 1000, 0, 14600, 0, 0, 14600, 0, '2018-07-01'),
(213, 6, 1, 0, 0, 90, 0, 1910, 0, 10, 1910, 0, '2018-07-01'),
(214, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-07-01'),
(215, 8, 2, 2001, 150, 2000, 2001, 0, 0, 0, 1150, 2851, '2018-07-01'),
(216, 9, 3, 0, 0, 2000, 0, 26250, 0, 1000, 26100, 0, '2018-07-01'),
(217, 10, 33, 0, 0, 48780, 0, 702720, 0, 17220, 702720, 0, '2018-07-01'),
(218, 11, 20, 0, 0, 51800, 0, 780800, 0, 8200, 780800, 0, '2018-07-01'),
(219, 12, 20, 0, 0, 38380, 0, 519370, 0, 11620, 519370, 0, '2018-07-01'),
(220, 13, 24, 0, 0, 40100, 0, 525480, 0, 19900, 524580, 0, '2018-07-01'),
(221, 1, 30, 118450, 5650, 19890, 118450, 232760, 0, 10110, 238410, 16350, '2018-08-01'),
(222, 2, 15, 4300, 150, 22300, 4300, 306500, 0, 7700, 305850, 0, '2018-08-01'),
(223, 3, 6, 0, 0, 18000, 0, 276450, 0, 0, 276450, 0, '2018-08-01'),
(224, 4, 2, 0, 0, 30000, 0, 286900, 0, 0, 286900, 0, '2018-08-01'),
(225, 5, 1, 0, 0, 1000, 0, 17750, 0, 0, 17750, 0, '2018-08-01'),
(226, 6, 2, 0, 0, 190, 0, 2730, 0, 10, 2730, 0, '2018-08-01'),
(227, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-08-01'),
(228, 8, 4, 0, 0, 2000, 0, 4449, 0, 2000, 4449, 0, '2018-08-01'),
(229, 9, 3, 0, 0, 2000, 0, 32550, 0, 1000, 32400, 0, '2018-08-01'),
(230, 10, 33, 0, 0, 48780, 0, 852060, 0, 17220, 852060, 0, '2018-08-01'),
(231, 11, 20, 0, 0, 51800, 0, 936200, 0, 8200, 936200, 0, '2018-08-01'),
(232, 12, 20, 0, 0, 38380, 0, 637360, 0, 11620, 637360, 0, '2018-08-01'),
(233, 13, 24, 0, 0, 40100, 0, 648930, 0, 19900, 648030, 0, '2018-08-01'),
(234, 1, 28, 0, 0, 17890, 0, 301840, 0, 10110, 292040, 0, '2018-06-01'),
(235, 1, 28, 0, 0, 17890, 0, 297640, 0, 10110, 288440, 0, '2018-06-01'),
(236, 2, 15, 6000, 2300, 22300, 6000, 312950, 0, 7700, 312450, 0, '2018-06-01'),
(237, 2, 15, 6000, 2300, 22300, 6000, 310850, 0, 7700, 310500, 0, '2018-06-01'),
(238, 3, 6, 1200, 2300, 18000, 1200, 220650, 0, 0, 220650, 0, '2018-06-01'),
(239, 4, 2, 288300, 4600, 30000, 288300, 196300, 0, 0, 197300, 1000, '2018-06-01'),
(240, 5, 1, 0, 0, 1000, 0, 14450, 0, 0, 14450, 0, '2018-06-01'),
(241, 6, 1, 0, 0, 90, 0, 1760, 0, 10, 1760, 0, '2018-06-01'),
(242, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-06-01'),
(243, 8, 2, 0, 0, 2000, 0, 11300, 0, 0, 12150, 850, '2018-06-01'),
(244, 8, 2, 0, 0, 2000, 0, 11000, 0, 0, 12000, 1000, '2018-06-01'),
(245, 9, 3, 0, 0, 2000, 0, 25800, 0, 1000, 25800, 0, '2018-06-01'),
(246, 10, 34, 0, 0, 50000, 0, 715000, 0, 18000, 715000, 0, '2018-06-01'),
(247, 11, 20, 0, 0, 51800, 0, 777800, 0, 8200, 777800, 0, '2018-06-01'),
(248, 12, 21, 3400, 0, 40100, 3400, 514800, 0, 12400, 516370, 1570, '2018-06-01'),
(249, 12, 21, 3400, 0, 40100, 3400, 511800, 0, 12400, 513520, 1720, '2018-06-01'),
(250, 13, 24, 3400, 0, 40100, 3400, 535830, 0, 19900, 535380, 0, '2018-06-01'),
(251, 1, 29, 0, 0, 18890, 0, 224780, 0, 10110, 231230, 17150, '2018-09-01'),
(252, 2, 15, 0, 0, 22300, 0, 266350, 0, 7700, 265700, 0, '2018-09-01'),
(253, 3, 6, 0, 0, 18000, 0, 240450, 0, 0, 240450, 0, '2018-09-01'),
(254, 4, 2, 0, 0, 30000, 0, 226900, 0, 0, 226900, 0, '2018-09-01'),
(255, 5, 1, 0, 0, 1000, 0, 15750, 0, 0, 15750, 0, '2018-09-01'),
(256, 6, 2, 0, 0, 190, 0, 2350, 0, 10, 2350, 0, '2018-09-01'),
(257, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-09-01'),
(258, 8, 3, 0, 0, 2000, 0, 449, 0, 1000, 2300, 1851, '2018-09-01'),
(259, 9, 3, 0, 0, 2000, 0, 28550, 0, 1000, 28400, 0, '2018-09-01'),
(260, 10, 33, 0, 0, 48780, 0, 754500, 0, 17220, 754500, 0, '2018-09-01'),
(261, 11, 20, 0, 0, 51800, 0, 832600, 0, 8200, 832600, 0, '2018-09-01'),
(262, 12, 20, 0, 0, 38380, 0, 560600, 0, 11620, 560600, 0, '2018-09-01'),
(263, 13, 24, 0, 0, 40100, 0, 568730, 0, 19900, 567830, 0, '2018-09-01'),
(264, 1, 29, 0, 0, 18890, 0, 243670, 0, 10110, 248120, 15150, '2018-10-01'),
(265, 2, 15, 0, 0, 22300, 0, 288650, 0, 7700, 288000, 0, '2018-10-01'),
(266, 3, 6, 0, 0, 18000, 0, 258450, 0, 0, 258450, 0, '2018-10-01'),
(267, 4, 2, 0, 0, 30000, 0, 256900, 0, 0, 256900, 0, '2018-10-01'),
(268, 5, 1, 0, 0, 1000, 0, 16750, 0, 0, 16750, 0, '2018-10-01'),
(269, 6, 2, 0, 0, 190, 0, 2540, 0, 10, 2540, 0, '2018-10-01'),
(270, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018-10-01'),
(271, 8, 3, 0, 0, 2000, 0, 2449, 0, 1000, 3300, 851, '2018-10-01'),
(272, 9, 3, 0, 0, 2000, 0, 30550, 0, 1000, 30400, 0, '2018-10-01'),
(273, 10, 33, 0, 0, 48780, 0, 803280, 0, 17220, 803280, 0, '2018-10-01'),
(274, 11, 20, 0, 0, 51800, 0, 884400, 0, 8200, 884400, 0, '2018-10-01'),
(275, 12, 20, 0, 0, 38380, 0, 598980, 0, 11620, 598980, 0, '2018-10-01'),
(276, 13, 24, 0, 0, 40100, 0, 608830, 0, 19900, 607930, 0, '2018-10-01');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_public` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'No',
  `class_id` int(11) DEFAULT NULL,
  `file` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_options`
--

CREATE TABLE `custom_options` (
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `custom_options`
--

INSERT INTO `custom_options` (`name`, `value`) VALUES
('admin_phone', '03014093011'),
('bank_account', 'HBL Account NO 3749328749832'),
('fine_per_day_for_fee', '150'),
('last_date_for_receiving_fee', '10'),
('restrict_attendance_after', '08:30:00'),
('student_fee_fine_type', 'fixed_fine_after_due_date'),
('teachers_max_leaves_in_month', '2'),
('teachers_salary_deduction_per_leave', '100');

-- --------------------------------------------------------

--
-- Table structure for table `email_config`
--

CREATE TABLE `email_config` (
  `id` int(11) UNSIGNED NOT NULL,
  `email_type` varchar(100) DEFAULT NULL,
  `smtp_server` varchar(100) DEFAULT NULL,
  `smtp_port` varchar(100) DEFAULT NULL,
  `smtp_username` varchar(100) DEFAULT NULL,
  `smtp_password` varchar(100) DEFAULT NULL,
  `ssl_tls` varchar(100) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_config`
--

INSERT INTO `email_config` (`id`, `email_type`, `smtp_server`, `smtp_port`, `smtp_username`, `smtp_password`, `ssl_tls`, `is_active`, `created_at`) VALUES
(1, 'smtp', 'smtp.gmail.com', '587', 'xxxx', 'xxxx', 'tls', 'enabled', '2017-08-02 23:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sesion_id` int(11) NOT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `name`, `sesion_id`, `note`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'test exam', 0, '', 'no', '2017-10-13 11:14:36', '0000-00-00 00:00:00'),
(2, 'Annual exams', 0, 'This is a test exam', 'no', '2017-10-21 06:35:18', '0000-00-00 00:00:00'),
(3, 'test', 0, 'dummy', 'no', '2018-08-17 07:41:17', '0000-00-00 00:00:00'),
(4, 'sadasdasdsadasadsasd', 0, 'dasd', 'no', '2018-08-17 07:42:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` int(11) NOT NULL,
  `attendence` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `exam_schedule_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `get_marks` float(10,2) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`id`, `attendence`, `exam_schedule_id`, `student_id`, `get_marks`, `note`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'pre', 1, 1, 80.00, NULL, 'no', '2018-08-21 07:57:54', '0000-00-00 00:00:00'),
(2, 'pre', 2, 1, 42.00, NULL, 'no', '2017-10-21 07:14:05', '0000-00-00 00:00:00'),
(3, 'pre', 1, 2, 70.00, NULL, 'no', '2018-08-21 07:57:54', '0000-00-00 00:00:00'),
(4, 'pre', 2, 2, 44.00, NULL, 'no', '2017-10-21 07:14:05', '0000-00-00 00:00:00'),
(5, 'pre', 1, 3, 45.00, NULL, 'no', '2017-10-21 07:14:05', '0000-00-00 00:00:00'),
(6, 'pre', 2, 3, 46.00, NULL, 'no', '2017-10-21 07:14:05', '0000-00-00 00:00:00'),
(7, 'pre', 3, 1, 50.00, NULL, 'no', '2018-08-20 13:11:23', '0000-00-00 00:00:00'),
(8, 'pre', 4, 1, 60.00, NULL, 'no', '2018-08-20 13:11:23', '0000-00-00 00:00:00'),
(9, 'pre', 3, 2, 0.00, NULL, 'no', '2018-08-20 13:11:23', '0000-00-00 00:00:00'),
(10, 'pre', 4, 2, 0.00, NULL, 'no', '2018-08-20 13:11:23', '0000-00-00 00:00:00'),
(11, 'pre', 3, 5, 0.00, NULL, 'no', '2018-08-20 13:11:23', '0000-00-00 00:00:00'),
(12, 'pre', 4, 5, 0.00, NULL, 'no', '2018-08-20 13:11:23', '0000-00-00 00:00:00'),
(13, 'pre', 3, 6, 0.00, NULL, 'no', '2018-08-20 13:11:23', '0000-00-00 00:00:00'),
(14, 'pre', 4, 6, 0.00, NULL, 'no', '2018-08-20 13:11:23', '0000-00-00 00:00:00'),
(15, 'pre', 3, 7, 0.00, NULL, 'no', '2018-08-20 13:11:24', '0000-00-00 00:00:00'),
(16, 'pre', 4, 7, 0.00, NULL, 'no', '2018-08-20 13:11:24', '0000-00-00 00:00:00'),
(17, 'pre', 3, 8, 0.00, NULL, 'no', '2018-08-20 13:11:24', '0000-00-00 00:00:00'),
(18, 'pre', 4, 8, 0.00, NULL, 'no', '2018-08-20 13:11:24', '0000-00-00 00:00:00'),
(19, 'pre', 3, 9, 0.00, NULL, 'no', '2018-08-20 13:11:24', '0000-00-00 00:00:00'),
(20, 'pre', 4, 9, 0.00, NULL, 'no', '2018-08-20 13:11:24', '0000-00-00 00:00:00'),
(21, 'pre', 3, 11, 0.00, NULL, 'no', '2018-08-20 13:11:24', '0000-00-00 00:00:00'),
(22, 'pre', 4, 11, 0.00, NULL, 'no', '2018-08-20 13:11:24', '0000-00-00 00:00:00'),
(23, 'pre', 3, 12, 0.00, NULL, 'no', '2018-08-20 13:11:25', '0000-00-00 00:00:00'),
(24, 'pre', 4, 12, 0.00, NULL, 'no', '2018-08-20 13:11:25', '0000-00-00 00:00:00'),
(25, 'pre', 3, 13, 0.00, NULL, 'no', '2018-08-20 13:11:25', '0000-00-00 00:00:00'),
(26, 'pre', 4, 13, 0.00, NULL, 'no', '2018-08-20 13:11:25', '0000-00-00 00:00:00'),
(27, 'pre', 3, 3, 0.00, NULL, 'no', '2018-08-20 13:11:25', '0000-00-00 00:00:00'),
(28, 'pre', 4, 3, 0.00, NULL, 'no', '2018-08-20 13:11:25', '0000-00-00 00:00:00'),
(29, 'pre', 3, 14, 0.00, NULL, 'no', '2018-08-20 13:11:25', '0000-00-00 00:00:00'),
(30, 'pre', 4, 14, 0.00, NULL, 'no', '2018-08-20 13:11:25', '0000-00-00 00:00:00'),
(31, 'pre', 3, 18, 0.00, NULL, 'no', '2018-08-20 13:11:25', '0000-00-00 00:00:00'),
(32, 'pre', 4, 18, 0.00, NULL, 'no', '2018-08-20 13:11:25', '0000-00-00 00:00:00'),
(33, 'pre', 3, 19, 0.00, NULL, 'no', '2018-08-20 13:11:25', '0000-00-00 00:00:00'),
(34, 'pre', 4, 19, 0.00, NULL, 'no', '2018-08-20 13:11:26', '0000-00-00 00:00:00'),
(35, 'pre', 3, 20, 0.00, NULL, 'no', '2018-08-20 13:11:26', '0000-00-00 00:00:00'),
(36, 'pre', 4, 20, 0.00, NULL, 'no', '2018-08-20 13:11:26', '0000-00-00 00:00:00'),
(37, 'pre', 3, 65, 0.00, NULL, 'no', '2018-08-20 13:11:26', '0000-00-00 00:00:00'),
(38, 'pre', 4, 65, 0.00, NULL, 'no', '2018-08-20 13:11:26', '0000-00-00 00:00:00'),
(39, 'pre', 3, 66, 0.00, NULL, 'no', '2018-08-20 13:11:26', '0000-00-00 00:00:00'),
(40, 'pre', 4, 66, 0.00, NULL, 'no', '2018-08-20 13:11:26', '0000-00-00 00:00:00'),
(41, 'pre', 3, 67, 0.00, NULL, 'no', '2018-08-20 13:11:26', '0000-00-00 00:00:00'),
(42, 'pre', 4, 67, 0.00, NULL, 'no', '2018-08-20 13:11:26', '0000-00-00 00:00:00'),
(43, 'pre', 3, 68, 0.00, NULL, 'no', '2018-08-20 13:11:26', '0000-00-00 00:00:00'),
(44, 'pre', 4, 68, 0.00, NULL, 'no', '2018-08-20 13:11:26', '0000-00-00 00:00:00'),
(45, 'pre', 3, 69, 0.00, NULL, 'no', '2018-08-20 13:11:26', '0000-00-00 00:00:00'),
(46, 'pre', 4, 69, 0.00, NULL, 'no', '2018-08-20 13:11:27', '0000-00-00 00:00:00'),
(47, 'pre', 3, 70, 0.00, NULL, 'no', '2018-08-20 13:11:27', '0000-00-00 00:00:00'),
(48, 'pre', 4, 70, 0.00, NULL, 'no', '2018-08-20 13:11:27', '0000-00-00 00:00:00'),
(49, 'pre', 3, 71, 0.00, NULL, 'no', '2018-08-20 13:11:27', '0000-00-00 00:00:00'),
(50, 'pre', 4, 71, 0.00, NULL, 'no', '2018-08-20 13:11:27', '0000-00-00 00:00:00'),
(51, 'pre', 3, 72, 0.00, NULL, 'no', '2018-08-20 13:11:27', '0000-00-00 00:00:00'),
(52, 'pre', 4, 72, 0.00, NULL, 'no', '2018-08-20 13:11:27', '0000-00-00 00:00:00'),
(53, 'pre', 3, 73, 0.00, NULL, 'no', '2018-08-20 13:11:27', '0000-00-00 00:00:00'),
(54, 'pre', 4, 73, 0.00, NULL, 'no', '2018-08-20 13:11:27', '0000-00-00 00:00:00'),
(55, 'pre', 3, 74, 0.00, NULL, 'no', '2018-08-20 13:11:27', '0000-00-00 00:00:00'),
(56, 'pre', 4, 74, 0.00, NULL, 'no', '2018-08-20 13:11:27', '0000-00-00 00:00:00'),
(57, 'pre', 3, 163, 0.00, NULL, 'no', '2018-08-20 13:11:27', '0000-00-00 00:00:00'),
(58, 'pre', 4, 163, 0.00, NULL, 'no', '2018-08-20 13:11:27', '0000-00-00 00:00:00'),
(59, 'pre', 3, 166, 0.00, NULL, 'no', '2018-08-20 13:11:28', '0000-00-00 00:00:00'),
(60, 'pre', 4, 166, 0.00, NULL, 'no', '2018-08-20 13:11:28', '0000-00-00 00:00:00'),
(61, 'pre', 3, 25, 0.00, NULL, 'no', '2018-08-20 13:11:28', '0000-00-00 00:00:00'),
(62, 'pre', 4, 25, 0.00, NULL, 'no', '2018-08-20 13:11:28', '0000-00-00 00:00:00'),
(63, 'pre', 3, 26, 0.00, NULL, 'no', '2018-08-20 13:11:28', '0000-00-00 00:00:00'),
(64, 'pre', 4, 26, 0.00, NULL, 'no', '2018-08-20 13:11:28', '0000-00-00 00:00:00'),
(65, 'pre', 3, 27, 0.00, NULL, 'no', '2018-08-20 13:11:28', '0000-00-00 00:00:00'),
(66, 'pre', 4, 27, 0.00, NULL, 'no', '2018-08-20 13:11:28', '0000-00-00 00:00:00'),
(67, 'pre', 1, 5, 70.00, NULL, 'no', '2018-08-21 07:57:54', '0000-00-00 00:00:00'),
(68, 'pre', 2, 5, 90.00, NULL, 'no', '2018-08-25 06:46:58', '0000-00-00 00:00:00'),
(69, 'pre', 1, 6, 0.00, NULL, 'no', '2018-08-21 07:55:47', '0000-00-00 00:00:00'),
(70, 'pre', 2, 6, 0.00, NULL, 'no', '2018-08-21 07:55:47', '0000-00-00 00:00:00'),
(71, 'pre', 1, 7, 0.00, NULL, 'no', '2018-08-21 07:55:48', '0000-00-00 00:00:00'),
(72, 'ABS', 2, 7, 0.00, NULL, 'no', '2018-08-21 07:55:48', '0000-00-00 00:00:00'),
(73, 'pre', 1, 8, 0.00, NULL, 'no', '2018-08-21 07:55:48', '0000-00-00 00:00:00'),
(74, 'pre', 2, 8, 0.00, NULL, 'no', '2018-08-21 07:55:48', '0000-00-00 00:00:00'),
(75, 'pre', 1, 9, 0.00, NULL, 'no', '2018-08-21 07:55:48', '0000-00-00 00:00:00'),
(76, 'pre', 2, 9, 70.00, NULL, 'no', '2018-08-21 07:55:48', '0000-00-00 00:00:00'),
(77, 'pre', 1, 11, 0.00, NULL, 'no', '2018-08-21 07:55:48', '0000-00-00 00:00:00'),
(78, 'pre', 2, 11, 0.00, NULL, 'no', '2018-08-21 07:55:48', '0000-00-00 00:00:00'),
(79, 'pre', 1, 12, 0.00, NULL, 'no', '2018-08-21 07:55:49', '0000-00-00 00:00:00'),
(80, 'pre', 2, 12, 0.00, NULL, 'no', '2018-08-21 07:55:49', '0000-00-00 00:00:00'),
(81, 'pre', 1, 13, 0.00, NULL, 'no', '2018-08-21 07:55:49', '0000-00-00 00:00:00'),
(82, 'pre', 2, 13, 0.00, NULL, 'no', '2018-08-21 07:55:49', '0000-00-00 00:00:00'),
(83, 'pre', 1, 14, 0.00, NULL, 'no', '2018-08-21 07:55:49', '0000-00-00 00:00:00'),
(84, 'pre', 2, 14, 0.00, NULL, 'no', '2018-08-21 07:55:49', '0000-00-00 00:00:00'),
(85, 'pre', 1, 18, 0.00, NULL, 'no', '2018-08-21 07:55:49', '0000-00-00 00:00:00'),
(86, 'pre', 2, 18, 0.00, NULL, 'no', '2018-08-21 07:55:49', '0000-00-00 00:00:00'),
(87, 'pre', 1, 19, 0.00, NULL, 'no', '2018-08-21 07:55:49', '0000-00-00 00:00:00'),
(88, 'pre', 2, 19, 0.00, NULL, 'no', '2018-08-21 07:55:49', '0000-00-00 00:00:00'),
(89, 'pre', 1, 20, 0.00, NULL, 'no', '2018-08-21 07:55:50', '0000-00-00 00:00:00'),
(90, 'pre', 2, 20, 0.00, NULL, 'no', '2018-08-21 07:55:50', '0000-00-00 00:00:00'),
(91, 'pre', 1, 65, 0.00, NULL, 'no', '2018-08-21 07:55:50', '0000-00-00 00:00:00'),
(92, 'pre', 2, 65, 0.00, NULL, 'no', '2018-08-21 07:55:50', '0000-00-00 00:00:00'),
(93, 'pre', 1, 66, 0.00, NULL, 'no', '2018-08-21 07:55:50', '0000-00-00 00:00:00'),
(94, 'pre', 2, 66, 0.00, NULL, 'no', '2018-08-21 07:55:50', '0000-00-00 00:00:00'),
(95, 'pre', 1, 67, 0.00, NULL, 'no', '2018-08-21 07:55:50', '0000-00-00 00:00:00'),
(96, 'pre', 2, 67, 0.00, NULL, 'no', '2018-08-21 07:55:50', '0000-00-00 00:00:00'),
(97, 'pre', 1, 68, 0.00, NULL, 'no', '2018-08-21 07:55:50', '0000-00-00 00:00:00'),
(98, 'pre', 2, 68, 0.00, NULL, 'no', '2018-08-21 07:55:50', '0000-00-00 00:00:00'),
(99, 'pre', 1, 69, 0.00, NULL, 'no', '2018-08-21 07:55:50', '0000-00-00 00:00:00'),
(100, 'pre', 2, 69, 0.00, NULL, 'no', '2018-08-21 07:55:50', '0000-00-00 00:00:00'),
(101, 'pre', 1, 70, 0.00, NULL, 'no', '2018-08-21 07:55:51', '0000-00-00 00:00:00'),
(102, 'pre', 2, 70, 0.00, NULL, 'no', '2018-08-21 07:55:51', '0000-00-00 00:00:00'),
(103, 'pre', 1, 71, 0.00, NULL, 'no', '2018-08-21 07:55:51', '0000-00-00 00:00:00'),
(104, 'pre', 2, 71, 0.00, NULL, 'no', '2018-08-21 07:55:51', '0000-00-00 00:00:00'),
(105, 'pre', 1, 72, 0.00, NULL, 'no', '2018-08-21 07:55:51', '0000-00-00 00:00:00'),
(106, 'pre', 2, 72, 0.00, NULL, 'no', '2018-08-21 07:55:51', '0000-00-00 00:00:00'),
(107, 'pre', 1, 73, 0.00, NULL, 'no', '2018-08-21 07:55:51', '0000-00-00 00:00:00'),
(108, 'pre', 2, 73, 0.00, NULL, 'no', '2018-08-21 07:55:51', '0000-00-00 00:00:00'),
(109, 'pre', 1, 74, 0.00, NULL, 'no', '2018-08-21 07:55:51', '0000-00-00 00:00:00'),
(110, 'pre', 2, 74, 0.00, NULL, 'no', '2018-08-21 07:55:51', '0000-00-00 00:00:00'),
(111, 'pre', 1, 163, 0.00, NULL, 'no', '2018-08-21 07:55:51', '0000-00-00 00:00:00'),
(112, 'pre', 2, 163, 0.00, NULL, 'no', '2018-08-21 07:55:52', '0000-00-00 00:00:00'),
(113, 'pre', 1, 166, 0.00, NULL, 'no', '2018-08-21 07:55:52', '0000-00-00 00:00:00'),
(114, 'pre', 2, 166, 0.00, NULL, 'no', '2018-08-21 07:55:52', '0000-00-00 00:00:00'),
(115, 'pre', 1, 25, 0.00, NULL, 'no', '2018-08-21 07:55:52', '0000-00-00 00:00:00'),
(116, 'pre', 2, 25, 0.00, NULL, 'no', '2018-08-21 07:55:52', '0000-00-00 00:00:00'),
(117, 'pre', 1, 26, 0.00, NULL, 'no', '2018-08-21 07:55:52', '0000-00-00 00:00:00'),
(118, 'pre', 2, 26, 0.00, NULL, 'no', '2018-08-21 07:55:52', '0000-00-00 00:00:00'),
(119, 'pre', 1, 27, 0.00, NULL, 'no', '2018-08-21 07:55:52', '0000-00-00 00:00:00'),
(120, 'pre', 2, 27, 0.00, NULL, 'no', '2018-08-21 07:55:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedules`
--

CREATE TABLE `exam_schedules` (
  `id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `teacher_subject_id` int(11) DEFAULT NULL,
  `date_of_exam` date DEFAULT NULL,
  `start_to` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_from` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `room_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_marks` int(11) DEFAULT NULL,
  `passing_marks` int(11) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `exam_schedules`
--

INSERT INTO `exam_schedules` (`id`, `session_id`, `exam_id`, `teacher_subject_id`, `date_of_exam`, `start_to`, `end_from`, `room_no`, `full_marks`, `passing_marks`, `note`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 12, 2, 3, '2017-10-20', '12:00 PM', '12:30 PM', '42', 100, 60, NULL, 'no', '2018-08-25 06:46:11', '0000-00-00 00:00:00'),
(2, 12, 2, 4, '2017-10-19', '12:00 PM', '12:30 PM', '3', 50, 20, NULL, 'no', '2018-08-25 06:39:16', '0000-00-00 00:00:00'),
(3, 12, 1, 3, '2018-08-28', '12:00 AM', '01:00 PM', '0', 100, 50, NULL, 'no', '2018-08-17 08:04:57', '0000-00-00 00:00:00'),
(4, 12, 1, 4, '2018-08-21', '12:00 AM', '01:00 PM', '0', 100, 50, NULL, 'no', '2018-08-17 08:04:57', '0000-00-00 00:00:00'),
(5, 12, 1, 5, '2018-08-30', '12:00 AM', '12:15 PM', '22', 100, 40, NULL, 'no', '2018-08-20 07:23:06', '0000-00-00 00:00:00'),
(6, 12, 1, 6, '2018-08-31', '12:00 AM', '12:15 PM', '23', 100, 40, NULL, 'no', '2018-08-20 07:23:06', '0000-00-00 00:00:00'),
(7, 12, 2, 1, '2018-08-31', '12:00 AM', '04:45 PM', '6', 100, 35, NULL, 'no', '2018-08-20 11:50:19', '0000-00-00 00:00:00'),
(8, 12, 4, 3, '2018-08-24', '12:00 AM', '05:00 PM', '3', 90, 50, NULL, 'no', '2018-08-20 12:10:36', '0000-00-00 00:00:00'),
(9, 12, 4, 4, '2018-08-17', '12:00 AM', '05:00 PM', '5', 80, 40, NULL, 'no', '2018-08-20 12:10:36', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `exp_head_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'yes',
  `is_deleted` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `exp_head_id`, `name`, `date`, `amount`, `note`, `is_active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(3, 1, 'test', '1970-01-01', 100.00, NULL, 'yes', 'no', '2017-12-30 16:55:25', '0000-00-00 00:00:00'),
(4, 1, 'test name', '1970-01-01', 100.00, NULL, 'yes', 'no', '2017-12-30 16:57:35', '0000-00-00 00:00:00'),
(7, 1, '11th january electricity expense', '2018-01-11', 2000.00, '', 'yes', 'no', '2018-01-11 09:24:26', '0000-00-00 00:00:00'),
(8, NULL, NULL, '1970-01-01', NULL, NULL, 'yes', 'no', '2018-01-16 08:11:21', '0000-00-00 00:00:00'),
(9, 1, 'name', '2018-01-16', 100.00, NULL, 'yes', 'no', '2018-01-16 08:12:03', '0000-00-00 00:00:00'),
(10, 1, 'test', '2018-02-13', 10.00, NULL, 'yes', 'no', '2018-02-13 06:38:34', '0000-00-00 00:00:00'),
(17, 1, 'test 123', '2018-02-27', 1.00, NULL, 'yes', 'no', '2018-02-27 11:18:43', '0000-00-00 00:00:00'),
(18, 2, 'test', '2018-02-27', 1.00, NULL, 'yes', 'no', '2018-02-27 12:09:28', '0000-00-00 00:00:00'),
(19, 3, 'Bill', '2018-02-27', 10000.00, NULL, 'yes', 'no', '2018-02-27 12:12:13', '0000-00-00 00:00:00'),
(20, 3, 'bill 2', '2018-02-27', 9000.00, NULL, 'yes', 'no', '2018-02-27 12:12:57', '0000-00-00 00:00:00'),
(21, 1, 'test', '2018-08-13', 10000.00, NULL, 'yes', 'no', '2018-08-13 13:43:11', '0000-00-00 00:00:00'),
(22, 1, 'ffffffff', '2018-08-16', 2000.00, NULL, 'yes', 'no', '2018-08-16 11:26:14', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `expense_head`
--

CREATE TABLE `expense_head` (
  `id` int(11) NOT NULL,
  `exp_category` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'yes',
  `is_deleted` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expense_head`
--

INSERT INTO `expense_head` (`id`, `exp_category`, `description`, `is_active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Electricity bills', '\r\n', 'yes', 'no', '2017-10-02 05:14:51', '0000-00-00 00:00:00'),
(2, 'Building expenses', '', 'yes', 'no', '2017-10-02 05:14:59', '0000-00-00 00:00:00'),
(3, 'Wapda', '', 'yes', 'no', '2018-02-27 12:11:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `feecategory`
--

CREATE TABLE `feecategory` (
  `id` int(11) NOT NULL,
  `category` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feemasters`
--

CREATE TABLE `feemasters` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `feetype_id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fees_discounts`
--

CREATE TABLE `fees_discounts` (
  `id` int(11) UNSIGNED NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `description` text,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feetype`
--

CREATE TABLE `feetype` (
  `id` int(11) NOT NULL,
  `feecategory_id` int(11) DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `feetype`
--

INSERT INTO `feetype` (`id`, `feecategory_id`, `type`, `code`, `is_active`, `created_at`, `updated_at`, `description`) VALUES
(1, NULL, 'Admission fee', '1', 'no', '2017-10-02 05:07:49', '0000-00-00 00:00:00', 'Fee for the admission'),
(2, NULL, 'Exam fee', '2', 'no', '2017-10-02 05:08:01', '0000-00-00 00:00:00', 'Examination fee');

-- --------------------------------------------------------

--
-- Table structure for table `fee_groups`
--

CREATE TABLE `fee_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `description` text,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fee_groups`
--

INSERT INTO `fee_groups` (`id`, `name`, `description`, `is_active`, `created_at`) VALUES
(3, 'Class KG', '', 'no', '2017-10-02 05:09:22');

-- --------------------------------------------------------

--
-- Table structure for table `fee_groups_feetype`
--

CREATE TABLE `fee_groups_feetype` (
  `id` int(11) UNSIGNED NOT NULL,
  `fee_session_group_id` int(11) DEFAULT NULL,
  `fee_groups_id` int(11) DEFAULT NULL,
  `feetype_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fee_groups_feetype`
--

INSERT INTO `fee_groups_feetype` (`id`, `fee_session_group_id`, `fee_groups_id`, `feetype_id`, `session_id`, `due_date`, `amount`, `is_active`, `created_at`) VALUES
(1, 1, 3, 1, 12, '2017-10-10', '1000.00', 'no', '2017-10-02 05:10:00'),
(2, 1, 3, 2, 12, '2017-10-05', '500.00', 'no', '2017-10-02 05:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `fee_receipt_no`
--

CREATE TABLE `fee_receipt_no` (
  `id` int(11) NOT NULL,
  `payment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fee_session_groups`
--

CREATE TABLE `fee_session_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `fee_groups_id` int(11) DEFAULT NULL,
  `session_id` int(11) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fee_session_groups`
--

INSERT INTO `fee_session_groups` (`id`, `fee_groups_id`, `session_id`, `is_active`, `created_at`) VALUES
(1, 3, 12, 'no', '2017-10-02 05:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `point` float(10,1) DEFAULT NULL,
  `mark_from` float(10,2) DEFAULT NULL,
  `mark_upto` float(10,2) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `name`, `point`, `mark_from`, `mark_upto`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'A+', NULL, 90.00, 100.00, '', 'no', '2017-10-21 06:38:08', '0000-00-00 00:00:00'),
(2, 'A', NULL, 80.00, 90.00, '', 'no', '2017-10-21 06:38:23', '0000-00-00 00:00:00'),
(3, 'B', NULL, 65.00, 80.00, '', 'no', '2017-10-21 06:38:49', '0000-00-00 00:00:00'),
(4, 'C', NULL, 51.00, 65.00, '', 'no', '2018-08-30 09:26:45', '0000-00-00 00:00:00'),
(5, 'D', NULL, 40.00, 50.00, '', 'no', '2017-10-21 06:39:45', '0000-00-00 00:00:00'),
(6, 'F', NULL, 0.00, 40.00, '', 'no', '2017-10-21 06:39:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hostel`
--

CREATE TABLE `hostel` (
  `id` int(11) NOT NULL,
  `hostel_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `intake` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hostel`
--

INSERT INTO `hostel` (`id`, `hostel_name`, `type`, `address`, `intake`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Boys hostel', 'Boys', 'Kohinoor city, Faisalabad', 50, '', 'no', '2017-10-02 05:19:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hostel_rooms`
--

CREATE TABLE `hostel_rooms` (
  `id` int(11) NOT NULL,
  `hostel_id` int(11) DEFAULT NULL,
  `room_type_id` int(11) DEFAULT NULL,
  `room_no` varchar(200) DEFAULT NULL,
  `no_of_bed` int(11) DEFAULT NULL,
  `cost_per_bed` float(10,2) DEFAULT '0.00',
  `title` varchar(200) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostel_rooms`
--

INSERT INTO `hostel_rooms` (`id`, `hostel_id`, `room_type_id`, `room_no`, `no_of_bed`, `cost_per_bed`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', 3, 3000.00, NULL, '', '2017-10-02 05:20:48', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_head`
--

CREATE TABLE `inventory_head` (
  `id` int(10) UNSIGNED NOT NULL,
  `inventory_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `is_active` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `is_deleted` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `inventory_head`
--

INSERT INTO `inventory_head` (`id`, `inventory_title`, `description`, `is_active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'test head', 'test descrip', 'no', 'no', '2018-02-12 10:49:39', '2018-02-12 10:49:39'),
(2, 'new head', '', 'no', 'no', '2018-02-13 05:50:47', '2018-02-13 05:50:47'),
(3, 'Books', '', 'no', 'no', '2018-02-23 04:46:53', '2018-02-23 04:46:53');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_items`
--

CREATE TABLE `inventory_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `inv_head_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `inventory_items`
--

INSERT INTO `inventory_items` (`id`, `inv_head_id`, `quantity`, `amount`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 159, '475', 'testing', '2018-02-12 10:49:57', '2018-03-07 06:32:13'),
(2, 2, 22, '202', '', '2018-02-13 05:50:59', '2018-02-23 04:12:30'),
(3, 3, 13, '23', '111', '2018-02-23 04:52:18', '2018-03-07 06:32:31');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_stock`
--

CREATE TABLE `inventory_stock` (
  `id` int(10) UNSIGNED NOT NULL,
  `inventory_head_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` float NOT NULL,
  `type` enum('deduction','addition') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `inventory_stock`
--

INSERT INTO `inventory_stock` (`id`, `inventory_head_id`, `quantity`, `amount`, `type`, `created_at`) VALUES
(6, 1, 10, 10, 'addition', '2018-02-13 06:17:27'),
(7, 1, 10, 10, 'addition', '2018-02-13 06:19:12'),
(8, 1, 10, 10, 'addition', '2018-02-13 06:35:46'),
(9, 1, 100, 200, 'addition', '2018-02-13 07:21:36'),
(10, 1, 1, 10, 'addition', '2018-02-21 06:46:02'),
(11, 1, 1, 10, 'addition', '2018-02-21 06:46:31'),
(12, 1, 1, 10, 'addition', '2018-02-23 04:07:39'),
(13, 2, 1, 1, 'addition', '2018-02-23 04:12:10'),
(14, 2, 1, 1, 'addition', '2018-02-23 04:12:30'),
(15, 3, 1, 1, 'addition', '2018-02-23 04:47:07'),
(16, 3, 1, 1, 'addition', '2018-02-23 04:52:18'),
(17, 1, 1, 1, 'addition', '2018-02-23 05:58:19'),
(18, 3, 1, 1, 'addition', '2018-02-23 05:58:45'),
(19, 3, 1, 1, 'addition', '2018-02-23 05:58:45'),
(22, 1, 1, 1, 'addition', '2018-02-27 11:19:03'),
(23, 1, 1, 1, 'addition', '2018-02-27 13:59:44'),
(24, 1, 1, 10, 'addition', '2018-03-07 06:32:13'),
(25, 3, 10, 20, 'addition', '2018-03-07 06:32:31');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `language` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`, `is_deleted`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Azerbaijan', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(2, 'Albanian', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(3, 'Amharic', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(4, 'English', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(5, 'Arabic', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(7, 'Afrikaans', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(8, 'Basque', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(11, 'Bengali', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(13, 'Bosnian', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(14, 'Welsh', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(15, 'Hungarian', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(16, 'Vietnamese', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(17, 'Haitian (Creole)', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(18, 'Galician', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(19, 'Dutch', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(21, 'Greek', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(22, 'Georgian', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(23, 'Gujarati', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(24, 'Danish', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(25, 'Hebrew', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(26, 'Yiddish', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(27, 'Indonesian', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(28, 'Irish', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(29, 'Italian', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(30, 'Icelandic', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(31, 'Spanish', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(33, 'Kannada', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(34, 'Catalan', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(36, 'Chinese', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(37, 'Korean', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(38, 'Xhosa', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(39, 'Latin', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(40, 'Latvian', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(41, 'Lithuanian', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(43, 'Malagasy', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(44, 'Malay', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(45, 'Malayalam', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(46, 'Maltese', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(47, 'Macedonian', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(48, 'Maori', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(49, 'Marathi', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(51, 'Mongolian', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(52, 'German', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(53, 'Nepali', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(54, 'Norwegian', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(55, 'Punjabi', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(57, 'Persian', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(59, 'Portuguese', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(60, 'Romanian', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(61, 'Russian', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(62, 'Cebuano', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(64, 'Sinhala', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(65, 'Slovakian', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(66, 'Slovenian', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(67, 'Swahili', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(68, 'Sundanese', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(70, 'Thai', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(71, 'Tagalog', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(72, 'Tamil', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(74, 'Telugu', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(75, 'Turkish', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(77, 'Uzbek', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(79, 'Urdu', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(80, 'Finnish', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(81, 'French', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(82, 'Hindi', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(84, 'Czech', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(85, 'Swedish', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(86, 'Scottish', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(87, 'Estonian', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(88, 'Esperanto', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(89, 'Javanese', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00'),
(90, 'Japanese', 'no', 'no', '2017-04-07 01:38:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `lang_keys`
--

CREATE TABLE `lang_keys` (
  `id` int(11) NOT NULL,
  `key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lang_keys`
--

INSERT INTO `lang_keys` (`id`, `key`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'session', 'no', '2016-03-10 02:54:39', '0000-00-00 00:00:00'),
(2, 'school_name', 'no', '2016-03-10 03:04:28', '0000-00-00 00:00:00'),
(3, 'email', 'no', '2016-03-10 03:04:48', '0000-00-00 00:00:00'),
(6, 'roll_no', 'no', '2001-12-30 20:29:30', '0000-00-00 00:00:00'),
(7, 'first_name', 'no', '2001-12-30 20:29:30', '0000-00-00 00:00:00'),
(8, 'last_name', 'no', '2001-12-30 20:29:30', '0000-00-00 00:00:00'),
(9, 'class', 'no', '2001-12-30 20:29:30', '0000-00-00 00:00:00'),
(10, 'section', 'no', '2001-12-30 20:29:30', '0000-00-00 00:00:00'),
(11, 'admission_date', 'no', '2017-04-02 10:37:35', '0000-00-00 00:00:00'),
(12, 'mobile_no', 'no', '2001-12-30 20:29:30', '0000-00-00 00:00:00'),
(13, 'date_of_birth', 'no', '2001-12-30 20:29:30', '0000-00-00 00:00:00'),
(15, 'religion', 'no', '2001-12-30 20:29:30', '0000-00-00 00:00:00'),
(16, 'category', 'no', '2001-12-30 20:29:30', '0000-00-00 00:00:00'),
(17, 'current_address', 'no', '2001-12-30 20:29:30', '0000-00-00 00:00:00'),
(18, 'permanent_address', 'no', '2001-12-30 20:29:30', '0000-00-00 00:00:00'),
(23, 'bank_account_no', 'no', '2001-12-30 20:29:30', '0000-00-00 00:00:00'),
(24, 'bank_name', 'no', '2001-12-30 20:29:30', '0000-00-00 00:00:00'),
(25, 'ifsc_code', 'no', '2001-12-30 20:29:30', '0000-00-00 00:00:00'),
(27, 'guardian_name', 'no', '2001-12-30 20:29:30', '0000-00-00 00:00:00'),
(28, 'guardian_relation', 'no', '2016-03-13 05:43:05', '0000-00-00 00:00:00'),
(29, 'guardian_phone', 'no', '2001-12-30 20:29:30', '0000-00-00 00:00:00'),
(30, 'guardian_address', 'no', '2001-12-30 20:29:30', '0000-00-00 00:00:00'),
(31, 'select_image', 'no', '2001-12-30 20:29:30', '0000-00-00 00:00:00'),
(32, 'import_excel', 'no', '2001-12-30 20:33:11', '0000-00-00 00:00:00'),
(33, 'export_format', 'no', '2001-12-30 20:33:11', '0000-00-00 00:00:00'),
(34, 'generate_pdf', 'no', '2001-12-30 20:33:11', '0000-00-00 00:00:00'),
(35, 'add_fees', 'no', '2016-06-24 23:04:31', '0000-00-00 00:00:00'),
(37, 'search', 'no', '2016-03-13 05:47:08', '0000-00-00 00:00:00'),
(39, 'fee_category', 'no', '2016-03-13 05:59:03', '0000-00-00 00:00:00'),
(40, 'fee_type', 'no', '2016-03-13 05:59:03', '0000-00-00 00:00:00'),
(43, 'add_fees_master', 'no', '2016-03-13 06:00:10', '0000-00-00 00:00:00'),
(44, 'fees_master_list', 'no', '2016-03-13 06:00:10', '0000-00-00 00:00:00'),
(45, 'add_fees_type', 'no', '2016-03-13 06:01:38', '0000-00-00 00:00:00'),
(46, 'fees_type_list', 'no', '2016-03-13 06:01:38', '0000-00-00 00:00:00'),
(48, 'edit', 'no', '2016-03-13 06:03:10', '0000-00-00 00:00:00'),
(50, 'category_list', 'no', '2016-03-13 06:04:32', '0000-00-00 00:00:00'),
(51, 'add_category', 'no', '2016-03-13 06:04:32', '0000-00-00 00:00:00'),
(52, 'session_list', 'no', '2016-03-13 06:05:15', '0000-00-00 00:00:00'),
(53, 'add_session', 'no', '2016-03-13 06:05:15', '0000-00-00 00:00:00'),
(54, 'class_list', 'no', '2016-03-13 06:05:53', '0000-00-00 00:00:00'),
(56, 'section_list', 'no', '2016-03-13 06:06:20', '0000-00-00 00:00:00'),
(57, 'add_section', 'no', '2016-03-13 06:06:20', '0000-00-00 00:00:00'),
(61, 'student', 'no', '2016-03-13 06:08:08', '0000-00-00 00:00:00'),
(63, 'language_list', 'no', '2016-03-13 06:09:44', '0000-00-00 00:00:00'),
(64, 'add_another_language', 'no', '2016-03-13 06:09:44', '0000-00-00 00:00:00'),
(65, 'created_at', 'no', '2016-03-13 06:45:20', '0000-00-00 00:00:00'),
(66, 'save', 'no', '2001-12-30 20:21:24', '0000-00-00 00:00:00'),
(68, 'select_logo', 'no', '2001-12-30 20:47:56', '0000-00-00 00:00:00'),
(69, 'school_logo', 'no', '2001-12-30 20:49:33', '0000-00-00 00:00:00'),
(70, 'manage', 'no', '2001-12-30 20:49:33', '0000-00-00 00:00:00'),
(72, 'edit_logo', 'no', '2001-12-30 20:53:28', '0000-00-00 00:00:00'),
(73, 'phone', 'no', '2001-12-30 21:00:49', '0000-00-00 00:00:00'),
(74, 'user_name', 'no', '2001-12-30 21:08:51', '0000-00-00 00:00:00'),
(76, 'sms_configuration', 'no', '2001-12-30 21:13:00', '0000-00-00 00:00:00'),
(77, 'sms_gateway_url', 'no', '2016-10-27 06:49:35', '0000-00-00 00:00:00'),
(78, 'status', 'no', '2001-12-30 21:13:52', '0000-00-00 00:00:00'),
(79, 'action', 'no', '2001-12-30 21:14:03', '0000-00-00 00:00:00'),
(80, 'change_status', 'no', '2001-12-30 21:15:19', '0000-00-00 00:00:00'),
(82, 'report', 'no', '2001-12-30 21:26:58', '0000-00-00 00:00:00'),
(84, 'select_criteria', 'no', '2001-12-30 21:27:36', '0000-00-00 00:00:00'),
(85, 'reset', 'no', '2001-12-30 21:28:39', '0000-00-00 00:00:00'),
(86, 'invoice_no', 'no', '2001-12-30 21:30:59', '0000-00-00 00:00:00'),
(87, 'fine', 'no', '2001-12-30 21:30:59', '0000-00-00 00:00:00'),
(88, 'type', 'no', '2001-12-30 21:31:20', '0000-00-00 00:00:00'),
(89, 'amount', 'no', '2001-12-30 21:31:20', '0000-00-00 00:00:00'),
(90, 'total', 'no', '2001-12-30 21:31:26', '0000-00-00 00:00:00'),
(91, 'discount', 'no', '2001-12-30 21:31:36', '0000-00-00 00:00:00'),
(92, 'balance_description', 'no', '2001-12-30 21:32:55', '0000-00-00 00:00:00'),
(94, 'no_search_record_found', 'no', '2001-12-30 21:36:37', '0000-00-00 00:00:00'),
(101, 'description', 'no', '2001-12-30 21:43:49', '0000-00-00 00:00:00'),
(102, 'fees_subtotal', 'no', '2001-12-30 21:44:34', '0000-00-00 00:00:00'),
(104, 'receipt_no', 'no', '2001-12-30 21:47:56', '0000-00-00 00:00:00'),
(106, 'grand_total', 'no', '2001-12-30 21:49:14', '0000-00-00 00:00:00'),
(107, 'deposit', 'no', '2001-12-30 21:56:50', '0000-00-00 00:00:00'),
(108, 'balance', 'no', '2001-12-30 21:56:50', '0000-00-00 00:00:00'),
(115, 'fee_master', 'no', '2001-12-30 23:36:09', '0000-00-00 00:00:00'),
(116, 'classes', 'no', '2001-12-30 23:36:44', '0000-00-00 00:00:00'),
(117, 'collection', 'no', '2001-12-30 23:37:14', '0000-00-00 00:00:00'),
(121, 'current_password', 'no', '2001-12-31 15:29:11', '0000-00-00 00:00:00'),
(122, 'new_password', 'no', '2001-12-31 15:29:11', '0000-00-00 00:00:00'),
(123, 'confirm_password', 'no', '2016-09-15 19:59:51', '0000-00-00 00:00:00'),
(125, 'date', 'no', '2016-04-08 01:47:39', '0000-00-00 00:00:00'),
(137, 'add_new_sms_configuration', 'no', '2001-12-31 17:09:13', '0000-00-00 00:00:00'),
(141, 'cancel', 'no', '2016-03-27 12:20:39', '0000-00-00 00:00:00'),
(142, 'exam_name', 'no', '2016-03-27 13:46:34', '0000-00-00 00:00:00'),
(143, 'subject_name', 'no', '2016-03-30 04:35:15', '0000-00-00 00:00:00'),
(144, 'subject_code', 'no', '2016-03-30 04:35:15', '0000-00-00 00:00:00'),
(145, 'grade_name', 'no', '2016-03-30 08:51:20', '0000-00-00 00:00:00'),
(147, 'percent', 'no', '2016-03-30 08:51:41', '0000-00-00 00:00:00'),
(149, 'percent_to', 'no', '2016-03-30 08:52:00', '0000-00-00 00:00:00'),
(150, 'note', 'no', '2016-03-30 08:52:00', '0000-00-00 00:00:00'),
(151, 'school_code', 'no', '2016-10-26 00:42:26', '0000-00-00 00:00:00'),
(152, 'sign_in', 'no', '2016-04-07 17:57:27', '0000-00-00 00:00:00'),
(153, 'name', 'no', '2016-04-08 01:46:19', '0000-00-00 00:00:00'),
(155, 'transport_fees', 'no', '2016-04-13 02:26:04', '0000-00-00 00:00:00'),
(156, 'fees_discount', 'no', '2016-04-13 03:03:36', '0000-00-00 00:00:00'),
(157, 'father_name', 'no', '2016-04-13 11:22:14', '0000-00-00 00:00:00'),
(158, 'father_phone', 'no', '2016-04-13 11:22:14', '0000-00-00 00:00:00'),
(159, 'father_occupation', 'no', '2016-04-13 11:22:45', '0000-00-00 00:00:00'),
(160, 'mother_name', 'no', '2016-04-13 11:22:45', '0000-00-00 00:00:00'),
(161, 'mother_phone', 'no', '2016-04-13 11:26:08', '0000-00-00 00:00:00'),
(162, 'mother_occupation', 'no', '2016-04-13 11:26:08', '0000-00-00 00:00:00'),
(163, 'guardian_occupation', 'no', '2016-04-13 11:39:51', '0000-00-00 00:00:00'),
(164, 'address', 'no', '2016-04-14 21:02:42', '0000-00-00 00:00:00'),
(165, 'language', 'no', '2016-04-14 21:03:38', '0000-00-00 00:00:00'),
(166, 'teacher_name', 'no', '2016-04-19 20:25:06', '0000-00-00 00:00:00'),
(167, 'password', 'no', '2016-04-19 20:25:06', '0000-00-00 00:00:00'),
(168, 'cast', 'no', '2016-04-19 20:56:10', '0000-00-00 00:00:00'),
(169, 'id', 'no', '2016-04-19 22:34:10', '0000-00-00 00:00:00'),
(170, 'admission_no', 'no', '2016-04-23 08:32:46', '0000-00-00 00:00:00'),
(171, 'enrollment_no', 'no', '2016-04-23 08:50:48', '0000-00-00 00:00:00'),
(180, 'total_paid_fees', 'no', '2016-04-23 09:39:01', '0000-00-00 00:00:00'),
(181, 'admission_discount', 'no', '2016-04-23 09:39:41', '0000-00-00 00:00:00'),
(182, 'total_balance', 'no', '2016-04-23 09:39:41', '0000-00-00 00:00:00'),
(183, 'student_name', 'no', '2016-04-24 12:07:56', '0000-00-00 00:00:00'),
(184, 'fees', 'no', '2016-04-24 12:14:06', '0000-00-00 00:00:00'),
(185, 'rte', 'no', '2016-04-24 14:13:46', '0000-00-00 00:00:00'),
(186, 'gender', 'no', '2016-04-24 22:47:59', '0000-00-00 00:00:00'),
(187, 'teacher_photo', 'no', '2016-04-29 14:26:01', '0000-00-00 00:00:00'),
(188, 'isbn', 'no', '2016-05-02 12:37:51', '0000-00-00 00:00:00'),
(189, 'publisher', 'no', '2016-10-23 17:58:28', '0000-00-00 00:00:00'),
(190, 'author', 'no', '2016-05-02 12:38:19', '0000-00-00 00:00:00'),
(191, 'qty', 'no', '2016-05-02 12:38:19', '0000-00-00 00:00:00'),
(192, 'bookprice', 'no', '2016-10-18 14:41:54', '0000-00-00 00:00:00'),
(193, 'postdate', 'no', '2016-05-02 12:38:38', '0000-00-00 00:00:00'),
(197, 'intake', 'no', '2016-05-05 10:36:45', '0000-00-00 00:00:00'),
(199, 'book_title', 'no', '2016-05-05 14:29:27', '0000-00-00 00:00:00'),
(201, 'no_of_vehicle', 'no', '2016-05-10 08:50:40', '0000-00-00 00:00:00'),
(202, 'fare', 'no', '2016-05-10 08:50:48', '0000-00-00 00:00:00'),
(203, 'content_type', 'no', '2016-05-10 21:54:51', '0000-00-00 00:00:00'),
(205, 'upload_date', 'no', '2016-05-10 21:55:21', '0000-00-00 00:00:00'),
(206, 'expenses', 'no', '2016-05-11 07:44:03', '0000-00-00 00:00:00'),
(207, 'student_information', 'no', '2016-05-11 07:54:31', '0000-00-00 00:00:00'),
(208, 'fees_collection', 'no', '2016-05-11 08:05:29', '0000-00-00 00:00:00'),
(210, 'examinations', 'no', '2016-05-11 08:33:55', '0000-00-00 00:00:00'),
(211, 'academics', 'no', '2016-05-11 08:47:28', '0000-00-00 00:00:00'),
(212, 'download_center', 'no', '2016-05-11 08:47:28', '0000-00-00 00:00:00'),
(214, 'library', 'no', '2016-05-11 09:04:05', '0000-00-00 00:00:00'),
(215, 'system_settings', 'no', '2016-05-11 09:08:32', '0000-00-00 00:00:00'),
(216, 'reports', 'no', '2016-05-11 09:21:38', '0000-00-00 00:00:00'),
(217, 'subject', 'no', '2016-05-13 12:52:44', '0000-00-00 00:00:00'),
(218, 'rack_no', 'no', '2016-05-13 12:52:44', '0000-00-00 00:00:00'),
(220, 'hostel', 'no', '2016-05-13 16:12:27', '0000-00-00 00:00:00'),
(221, 'hostel_name', 'no', '2016-05-13 16:18:07', '0000-00-00 00:00:00'),
(222, 'transport', 'no', '2016-05-13 16:21:25', '0000-00-00 00:00:00'),
(223, 'route_title', 'no', '2016-05-13 16:27:39', '0000-00-00 00:00:00'),
(225, 'date_to', 'no', '2016-05-13 19:06:18', '0000-00-00 00:00:00'),
(227, 'basic_information', 'no', '2016-05-13 19:27:25', '0000-00-00 00:00:00'),
(228, 'add', 'no', '2016-05-13 19:30:46', '0000-00-00 00:00:00'),
(229, 'list', 'no', '2016-05-13 19:33:14', '0000-00-00 00:00:00'),
(230, 'result', 'no', '2016-05-13 19:36:46', '0000-00-00 00:00:00'),
(231, 'pass', 'no', '2016-05-13 19:37:34', '0000-00-00 00:00:00'),
(232, 'fail', 'no', '2016-05-13 19:37:34', '0000-00-00 00:00:00'),
(233, 'continue', 'no', '2016-05-18 00:12:00', '0000-00-00 00:00:00'),
(234, 'leave', 'no', '2016-05-13 19:38:28', '0000-00-00 00:00:00'),
(235, 'exam_list', 'no', '2016-05-17 22:17:56', '0000-00-00 00:00:00'),
(236, 'exam', 'no', '2016-05-17 22:20:35', '0000-00-00 00:00:00'),
(237, 'start_time', 'no', '2016-05-17 22:25:08', '0000-00-00 00:00:00'),
(238, 'end_time', 'no', '2016-05-17 22:25:08', '0000-00-00 00:00:00'),
(239, 'room', 'no', '2016-05-17 22:25:08', '0000-00-00 00:00:00'),
(240, 'full_mark', 'no', '2016-05-17 22:25:08', '0000-00-00 00:00:00'),
(241, 'passing_marks', 'no', '2016-05-17 22:25:08', '0000-00-00 00:00:00'),
(242, 'room_no', 'no', '2016-05-17 22:35:25', '0000-00-00 00:00:00'),
(245, 'promote', 'no', '2016-05-17 23:33:52', '0000-00-00 00:00:00'),
(246, 'content_title', 'no', '2016-05-19 07:20:20', '0000-00-00 00:00:00'),
(251, 'teacher_list', 'no', '2016-05-21 13:59:17', '0000-00-00 00:00:00'),
(252, 'compose_new_message', 'no', '2016-05-25 12:52:49', '0000-00-00 00:00:00'),
(253, 'notice', 'no', '2016-05-25 12:56:56', '0000-00-00 00:00:00'),
(254, 'notice_date', 'no', '2016-05-25 12:57:53', '0000-00-00 00:00:00'),
(255, 'publish_on', 'no', '2016-05-25 12:58:56', '0000-00-00 00:00:00'),
(256, 'message_to', 'no', '2016-05-25 13:00:54', '0000-00-00 00:00:00'),
(257, 'parent', 'no', '2016-05-25 13:03:55', '0000-00-00 00:00:00'),
(258, 'teacher', 'no', '2016-05-25 13:04:21', '0000-00-00 00:00:00'),
(259, 'no_record_found', 'no', '2016-05-25 13:17:21', '0000-00-00 00:00:00'),
(260, 'teacher_detail', 'no', '2016-05-25 14:52:21', '0000-00-00 00:00:00'),
(261, 'subject_list', 'no', '2016-05-25 15:33:17', '0000-00-00 00:00:00'),
(263, 'create_category', 'no', '2016-05-25 21:29:13', '0000-00-00 00:00:00'),
(264, 'title', 'no', '2016-05-26 10:31:44', '0000-00-00 00:00:00'),
(265, 'message', 'no', '2016-05-26 10:32:36', '0000-00-00 00:00:00'),
(266, 'send', 'no', '2016-05-26 11:13:32', '0000-00-00 00:00:00'),
(267, 'previous_school_details', 'no', '2016-05-26 15:23:02', '0000-00-00 00:00:00'),
(268, 'upload_documents', 'no', '2016-05-26 15:24:00', '0000-00-00 00:00:00'),
(270, 'miscellaneous_details', 'no', '2016-05-26 15:28:10', '0000-00-00 00:00:00'),
(272, 'edit_notification', 'no', '2016-05-26 16:52:03', '0000-00-00 00:00:00'),
(273, 'guardian_details', 'no', '2016-05-26 17:06:45', '0000-00-00 00:00:00'),
(274, 'payment_id', 'no', '2016-05-26 17:10:03', '0000-00-00 00:00:00'),
(275, 'change_password', 'no', '2016-05-26 17:15:33', '0000-00-00 00:00:00'),
(278, 'notifications', 'no', '2016-05-30 13:12:06', '0000-00-00 00:00:00'),
(279, 'visible_to_all', 'no', '2016-05-30 13:35:26', '0000-00-00 00:00:00'),
(280, 'visibility', 'no', '2016-05-30 13:36:16', '0000-00-00 00:00:00'),
(284, 'communicate', 'no', '2016-05-30 13:49:53', '0000-00-00 00:00:00'),
(285, 'notice_board', 'no', '2016-05-30 13:51:47', '0000-00-00 00:00:00'),
(286, 'publish_date', 'no', '2016-05-30 14:31:41', '0000-00-00 00:00:00'),
(287, 'father', 'no', '2016-06-01 12:51:38', '0000-00-00 00:00:00'),
(288, 'mother', 'no', '2016-06-01 12:51:47', '0000-00-00 00:00:00'),
(290, 'not_scheduled', 'no', '2016-06-07 23:20:48', '0000-00-00 00:00:00'),
(291, 'import_student', 'no', '2016-06-10 13:26:51', '0000-00-00 00:00:00'),
(292, 'dl_sample_import', 'no', '2016-06-10 13:33:13', '0000-00-00 00:00:00'),
(293, 'select_csv_file', 'no', '2016-06-10 13:40:49', '0000-00-00 00:00:00'),
(294, 'date_format', 'no', '2016-06-22 13:19:07', '0000-00-00 00:00:00'),
(295, 'currency', 'no', '2016-06-22 13:19:28', '0000-00-00 00:00:00'),
(296, 'currency_symbol', 'no', '2016-06-22 13:19:28', '0000-00-00 00:00:00'),
(297, 'profile', 'no', '2016-06-23 04:16:28', '0000-00-00 00:00:00'),
(298, 'save_attendance', 'no', '2016-06-23 04:26:58', '0000-00-00 00:00:00'),
(299, 'full_marks', 'no', '2016-06-24 15:40:24', '0000-00-00 00:00:00'),
(300, 'obtain_marks', 'no', '2016-06-24 15:40:24', '0000-00-00 00:00:00'),
(301, 'total_marks', 'no', '2016-06-24 15:48:37', '0000-00-00 00:00:00'),
(302, 'current', 'no', '2016-07-12 11:56:07', '0000-00-00 00:00:00'),
(303, 'admission', 'no', '2016-07-21 17:10:45', '0000-00-00 00:00:00'),
(305, 'sibling', 'no', '2016-08-07 12:02:13', '0000-00-00 00:00:00'),
(306, 'details', 'no', '2016-08-07 12:09:19', '0000-00-00 00:00:00'),
(309, 'identification', 'no', '2016-08-07 12:13:16', '0000-00-00 00:00:00'),
(310, 'no', 'no', '2016-08-07 12:15:33', '0000-00-00 00:00:00'),
(311, 'delete', 'no', '2016-08-07 12:58:55', '0000-00-00 00:00:00'),
(312, 'documents', 'no', '2016-08-07 13:03:52', '0000-00-00 00:00:00'),
(313, 'payment', 'no', '2016-08-07 13:06:56', '0000-00-00 00:00:00'),
(317, 'no_transaction_found', 'no', '2016-08-10 18:02:10', '0000-00-00 00:00:00'),
(318, 'transport_fees_details', 'no', '2016-08-10 18:05:57', '0000-00-00 00:00:00'),
(319, 'collect_fees', 'no', '2016-08-10 18:15:47', '0000-00-00 00:00:00'),
(320, 'balance_details', 'no', '2016-08-10 18:18:55', '0000-00-00 00:00:00'),
(321, 'download_pdf', 'no', '2016-08-10 18:35:40', '0000-00-00 00:00:00'),
(322, 'student_fees_report', 'no', '2016-08-10 18:53:18', '0000-00-00 00:00:00'),
(323, 'total_fees', 'no', '2016-08-10 18:56:53', '0000-00-00 00:00:00'),
(324, 'paid_fees', 'no', '2016-08-10 18:56:53', '0000-00-00 00:00:00'),
(325, 'student_detail', 'no', '2016-08-10 19:12:55', '0000-00-00 00:00:00'),
(327, 'gross_fees', 'no', '2016-08-10 19:15:26', '0000-00-00 00:00:00'),
(328, 'balance_fees', 'no', '2016-08-10 19:18:31', '0000-00-00 00:00:00'),
(329, 'print_selected', 'no', '2016-08-10 19:20:32', '0000-00-00 00:00:00'),
(330, 'collect_transport_fees', 'no', '2016-08-10 19:33:34', '0000-00-00 00:00:00'),
(331, 'no_transport_fees_found', 'no', '2016-08-10 19:35:30', '0000-00-00 00:00:00'),
(332, 'total_transport_fees', 'no', '2016-08-10 19:45:54', '0000-00-00 00:00:00'),
(333, 'class_section', 'no', '2016-08-10 19:49:24', '0000-00-00 00:00:00'),
(335, 'other_discount', 'no', '2016-08-10 20:08:43', '0000-00-00 00:00:00'),
(336, 'search_transaction', 'no', '2016-10-18 14:49:17', '0000-00-00 00:00:00'),
(337, 'fees_collection_details', 'no', '2016-08-10 20:18:09', '0000-00-00 00:00:00'),
(338, 'expense_id', 'no', '2016-08-10 20:24:24', '0000-00-00 00:00:00'),
(339, 'expense_head', 'no', '2016-08-10 20:21:43', '0000-00-00 00:00:00'),
(340, 'expense_detail', 'no', '2016-08-10 20:25:17', '0000-00-00 00:00:00'),
(341, 'add_expense', 'no', '2016-08-10 20:58:20', '0000-00-00 00:00:00'),
(342, 'edit_expense', 'no', '2016-08-10 21:03:33', '0000-00-00 00:00:00'),
(343, 'expense_list', 'no', '2016-08-10 21:07:48', '0000-00-00 00:00:00'),
(344, 'expense_head_list', 'no', '2016-08-10 21:15:58', '0000-00-00 00:00:00'),
(345, 'edit_expense_head', 'no', '2016-08-10 21:19:02', '0000-00-00 00:00:00'),
(347, 'add_expense_head', 'no', '2016-08-10 21:25:17', '0000-00-00 00:00:00'),
(348, 'attendance_already_submitted_you_can_edit_record', 'no', '2017-04-02 10:46:00', '0000-00-00 00:00:00'),
(349, 'attendance_already_submitted_as_holiday', 'no', '2017-04-02 10:46:00', '0000-00-00 00:00:00'),
(350, 'you_can_edit_record', 'no', '2016-08-11 08:41:54', '0000-00-00 00:00:00'),
(351, 'attendance_saved_successfully', 'no', '2017-04-02 10:46:00', '0000-00-00 00:00:00'),
(352, 'holiday', 'no', '2016-08-11 08:48:21', '0000-00-00 00:00:00'),
(353, 'mark_as_holiday', 'no', '2016-08-11 08:52:15', '0000-00-00 00:00:00'),
(354, 'no_attendance_prepare', 'no', '2016-08-11 09:12:18', '0000-00-00 00:00:00'),
(355, 'add_exam', 'no', '2016-08-11 09:39:04', '0000-00-00 00:00:00'),
(356, 'view_status', 'no', '2016-08-11 09:40:56', '0000-00-00 00:00:00'),
(357, 'marks_register_prepared', 'no', '2016-08-11 09:46:51', '0000-00-00 00:00:00'),
(358, 'exam_scheduled', 'no', '2016-08-11 09:46:51', '0000-00-00 00:00:00'),
(359, 'submit', 'no', '2016-08-11 10:00:47', '0000-00-00 00:00:00'),
(360, 'edit_grade', 'no', '2016-08-11 10:04:55', '0000-00-00 00:00:00'),
(361, 'add_grade', 'no', '2016-08-11 10:04:55', '0000-00-00 00:00:00'),
(362, 'percent_upto', 'no', '2016-08-11 10:06:04', '0000-00-00 00:00:00'),
(363, 'percent_from', 'no', '2016-08-11 10:06:04', '0000-00-00 00:00:00'),
(364, 'grade_list', 'no', '2016-08-11 10:09:49', '0000-00-00 00:00:00'),
(366, 'assign_subject', 'no', '2016-08-11 10:32:21', '0000-00-00 00:00:00'),
(368, 'edit_teacher', 'no', '2016-08-11 10:35:57', '0000-00-00 00:00:00'),
(369, 'add_teacher', 'no', '2016-08-11 10:52:14', '0000-00-00 00:00:00'),
(370, 'add_subject', 'no', '2016-08-11 11:00:48', '0000-00-00 00:00:00'),
(374, 'edit_subject', 'no', '2016-08-11 11:13:33', '0000-00-00 00:00:00'),
(375, 'edit_class', 'no', '2016-08-11 11:13:50', '0000-00-00 00:00:00'),
(377, 'edit_section', 'no', '2016-08-11 11:24:27', '0000-00-00 00:00:00'),
(378, 'upload_content', 'no', '2016-08-11 11:36:54', '0000-00-00 00:00:00'),
(380, 'content_list', 'no', '2016-08-11 12:00:03', '0000-00-00 00:00:00'),
(382, 'available_for_all_classes', 'no', '2016-10-23 16:56:48', '0000-00-00 00:00:00'),
(384, 'content_file', 'no', '2016-08-12 18:39:02', '0000-00-00 00:00:00'),
(385, 'available_for', 'no', '2016-08-12 18:39:02', '0000-00-00 00:00:00'),
(386, 'my_children', 'no', '2016-09-17 10:36:30', '0000-00-00 00:00:00'),
(387, 'assignment_list', 'no', '2016-08-12 18:45:21', '0000-00-00 00:00:00'),
(388, 'study_material_list', 'no', '2016-08-12 18:45:21', '0000-00-00 00:00:00'),
(389, 'syllabus_list', 'no', '2016-08-12 18:45:21', '0000-00-00 00:00:00'),
(390, 'other_download_list', 'no', '2016-08-12 18:45:21', '0000-00-00 00:00:00'),
(391, 'book_details', 'no', '2016-08-12 19:04:18', '0000-00-00 00:00:00'),
(392, 'edit_book', 'no', '2016-08-12 19:04:18', '0000-00-00 00:00:00'),
(393, 'book_list', 'no', '2016-08-12 19:06:33', '0000-00-00 00:00:00'),
(394, 'route_list', 'no', '2016-08-12 19:18:15', '0000-00-00 00:00:00'),
(395, 'create_route', 'no', '2016-08-12 19:18:15', '0000-00-00 00:00:00'),
(396, 'edit_route', 'no', '2016-08-12 19:18:15', '0000-00-00 00:00:00'),
(397, 'add_hostel', 'no', '2016-08-12 19:35:23', '0000-00-00 00:00:00'),
(398, 'edit_hostel', 'no', '2016-08-12 19:35:23', '0000-00-00 00:00:00'),
(399, 'hostel_list', 'no', '2016-08-12 19:35:23', '0000-00-00 00:00:00'),
(400, 'print', 'no', '2016-08-12 19:38:26', '0000-00-00 00:00:00'),
(401, 'room_type', 'no', '2016-08-12 19:43:23', '0000-00-00 00:00:00'),
(402, 'add_room_type', 'no', '2016-08-12 19:43:23', '0000-00-00 00:00:00'),
(403, 'room_type_list', 'no', '2016-08-12 19:43:23', '0000-00-00 00:00:00'),
(404, 'edit_room_type', 'no', '2016-08-12 19:43:23', '0000-00-00 00:00:00'),
(406, 'edit_message', 'no', '2016-08-12 19:58:45', '0000-00-00 00:00:00'),
(407, 'select', 'no', '2016-08-12 20:02:17', '0000-00-00 00:00:00'),
(408, 'general_settings', 'no', '2016-08-12 20:33:50', '0000-00-00 00:00:00'),
(410, 'session_start_month', 'no', '2016-08-12 20:34:48', '0000-00-00 00:00:00'),
(411, 'edit_session', 'no', '2016-08-12 20:47:13', '0000-00-00 00:00:00'),
(414, 'paypal_setting', 'no', '2016-08-12 21:20:26', '0000-00-00 00:00:00'),
(415, 'paypal_username', 'no', '2016-08-12 21:20:26', '0000-00-00 00:00:00'),
(416, 'paypal_password', 'no', '2016-08-12 21:20:26', '0000-00-00 00:00:00'),
(417, 'paypal_signature', 'no', '2016-08-12 21:20:26', '0000-00-00 00:00:00'),
(418, 'paypal_email', 'no', '2016-08-12 21:20:26', '0000-00-00 00:00:00'),
(419, 'off', 'no', '2016-08-12 21:20:43', '0000-00-00 00:00:00'),
(420, 'on', 'no', '2016-08-12 21:20:43', '0000-00-00 00:00:00'),
(421, 'backup_history', 'no', '2016-08-12 21:29:15', '0000-00-00 00:00:00'),
(422, 'create_backup', 'no', '2016-08-12 21:29:15', '0000-00-00 00:00:00'),
(423, 'backup_files', 'no', '2016-10-26 01:17:36', '0000-00-00 00:00:00'),
(424, 'upload_from_local_directory', 'no', '2016-08-12 21:33:51', '0000-00-00 00:00:00'),
(427, 'restore', 'no', '2016-08-13 02:34:46', '0000-00-00 00:00:00'),
(429, 'class_fees_detail', 'no', '2016-08-13 03:07:20', '0000-00-00 00:00:00'),
(430, 'no_fees_found', 'no', '2016-08-13 03:08:56', '0000-00-00 00:00:00'),
(431, 'monthly_fees_collection', 'no', '2016-08-13 03:13:22', '0000-00-00 00:00:00'),
(432, 'monthly_expenses', 'no', '2016-08-13 03:13:22', '0000-00-00 00:00:00'),
(433, 'teachers', 'no', '2016-08-13 03:13:22', '0000-00-00 00:00:00'),
(434, 'students', 'no', '2016-08-13 03:13:22', '0000-00-00 00:00:00'),
(436, 'login_details', 'no', '2016-08-13 03:27:20', '0000-00-00 00:00:00'),
(437, 'academic_fees_detail', 'no', '2016-08-13 04:03:38', '0000-00-00 00:00:00'),
(438, 'document_list', 'no', '2016-08-13 04:12:01', '0000-00-00 00:00:00'),
(439, 'exam_timetable', 'no', '2016-08-13 04:30:36', '0000-00-00 00:00:00'),
(440, 'promote_in_session', 'no', '2016-08-13 05:21:51', '0000-00-00 00:00:00'),
(441, 'promote_students_in_next_session', 'no', '2016-08-13 05:21:51', '0000-00-00 00:00:00'),
(442, 'next_session_status', 'no', '2016-08-13 05:25:11', '0000-00-00 00:00:00'),
(443, 'no_result_prepare', 'no', '2016-08-12 21:56:40', '0000-00-00 00:00:00'),
(444, 'parent_guardian_detail', 'no', '2016-08-12 22:29:14', '0000-00-00 00:00:00'),
(445, 'add_more_details', 'no', '2016-08-12 22:31:21', '0000-00-00 00:00:00'),
(446, 'if_permanent_address_is_current_address', 'no', '2016-10-06 02:28:39', '0000-00-00 00:00:00'),
(447, 'address_details', 'no', '2016-08-12 22:37:38', '0000-00-00 00:00:00'),
(449, 'add_image', 'no', '2016-08-12 22:55:27', '0000-00-00 00:00:00'),
(450, 'payment_id_detail', 'no', '2016-08-12 23:03:44', '0000-00-00 00:00:00'),
(451, 'section_name', 'no', '2016-08-12 23:33:59', '0000-00-00 00:00:00'),
(452, 'fees_type', 'no', '2016-08-13 00:02:20', '0000-00-00 00:00:00'),
(453, 'edit_hostel_room', 'no', '2016-08-16 16:37:57', '0000-00-00 00:00:00'),
(454, 'room_no_name', 'no', '2016-08-16 16:41:43', '0000-00-00 00:00:00'),
(455, 'no_of_bed', 'no', '2016-08-16 16:41:43', '0000-00-00 00:00:00'),
(456, 'cost_per_bed', 'no', '2016-08-16 16:41:43', '0000-00-00 00:00:00'),
(457, 'hostel_room_list', 'no', '2016-08-16 16:41:43', '0000-00-00 00:00:00'),
(458, 'add_hostel_room', 'no', '2016-08-16 16:46:48', '0000-00-00 00:00:00'),
(459, 'mark_register', 'no', '2016-08-16 16:51:56', '0000-00-00 00:00:00'),
(462, 'fill_mark', 'no', '2016-08-16 17:02:20', '0000-00-00 00:00:00'),
(463, 'post_new_message', 'no', '2016-08-16 17:05:16', '0000-00-00 00:00:00'),
(464, 'by_date', 'no', '2016-08-16 17:11:44', '0000-00-00 00:00:00'),
(465, 'edit_category', 'no', '2016-08-16 17:20:25', '0000-00-00 00:00:00'),
(466, 'exam_not_allotted', 'no', '2016-10-23 16:53:46', '0000-00-00 00:00:00'),
(467, 'edit_exam', 'no', '2016-08-16 17:31:50', '0000-00-00 00:00:00'),
(468, 'add_class', 'no', '2016-08-16 17:36:27', '0000-00-00 00:00:00'),
(469, 'teacher_subject', 'no', '2016-08-16 19:18:06', '0000-00-00 00:00:00'),
(470, 'dd', 'no', '2016-08-17 08:35:12', '0000-00-00 00:00:00'),
(471, 'cash', 'no', '2016-08-17 08:35:12', '0000-00-00 00:00:00'),
(472, 'cheque', 'no', '2016-08-17 08:35:12', '0000-00-00 00:00:00'),
(473, 'revert', 'no', '2016-08-17 09:10:47', '0000-00-00 00:00:00'),
(474, 'view', 'no', '2016-08-17 10:46:56', '0000-00-00 00:00:00'),
(475, 'no_exam_prepare', 'no', '2016-10-23 17:30:25', '0000-00-00 00:00:00'),
(476, 'sms_setting', 'no', '2016-08-22 18:15:46', '0000-00-00 00:00:00'),
(477, 'smart_school', 'no', '2016-08-25 09:11:16', '0000-00-00 00:00:00'),
(478, 'user_login', 'no', '2016-08-25 09:46:22', '0000-00-00 00:00:00'),
(479, 'library_book', 'no', '2016-09-07 04:40:41', '0000-00-00 00:00:00'),
(480, 'transport_routes', 'no', '2016-09-07 04:44:00', '0000-00-00 00:00:00'),
(481, 'hostel_rooms', 'no', '2016-09-07 04:47:22', '0000-00-00 00:00:00'),
(482, 'exam_schedule', 'no', '2016-09-07 04:57:03', '0000-00-00 00:00:00'),
(483, 'subjects', 'no', '2016-09-07 05:05:20', '0000-00-00 00:00:00'),
(484, 'national_identification_no', 'no', '2016-09-15 13:30:04', '0000-00-00 00:00:00'),
(485, 'local_identification_no', 'no', '2016-09-15 13:31:16', '0000-00-00 00:00:00'),
(486, 'my_profile', 'no', '2016-09-15 18:14:58', '0000-00-00 00:00:00'),
(487, 'mode', 'no', '2016-09-15 18:17:39', '0000-00-00 00:00:00'),
(488, 'url', 'no', '2016-09-15 20:54:06', '0000-00-00 00:00:00'),
(489, 'month', 'no', '2016-09-15 21:07:30', '0000-00-00 00:00:00'),
(490, 'upload', 'no', '2016-09-15 21:16:34', '0000-00-00 00:00:00'),
(491, 'day', 'no', '2016-10-24 09:32:31', '0000-00-00 00:00:00'),
(492, 'class_timetable', 'no', '2016-10-06 02:10:38', '0000-00-00 00:00:00'),
(493, 'if_guardian_address_is_current_address', 'no', '2016-10-08 02:42:51', '0000-00-00 00:00:00'),
(494, 'admin_login', 'no', '2016-10-18 06:38:26', '0000-00-00 00:00:00'),
(495, 'date_from', 'no', '2016-10-19 15:37:28', '0000-00-00 00:00:00'),
(496, 'other', 'no', '2016-10-26 00:31:08', '0000-00-00 00:00:00'),
(497, 'search_by_keyword', 'no', '2016-10-26 01:25:46', '0000-00-00 00:00:00'),
(499, 'add_book', 'no', '2016-10-31 21:22:54', '0000-00-00 00:00:00'),
(500, 'edit_vehicle_on_route', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(501, 'assign_vehicle_on_route', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(502, 'vehicle_route_list', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(503, 'route', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(504, 'vehicle_routes', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(505, 'edit_vehicle', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(506, 'vehicle', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(507, 'vehicle_list', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(508, 'add_vehicle', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(509, 'driver_contact', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(510, 'driver_license', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(511, 'driver_name', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(512, 'vehicle_no', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(513, 'vehicle_model', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(514, 'logout', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(515, 'year_made', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(516, 'attendance', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(517, 'show', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(519, 'add_timetable', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(520, 'edit_setting', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(521, 'subject_type', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(522, 'view_detail', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(523, 'exam_status', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(524, 'books', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(525, 'report_card', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(526, 'library_books', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(527, 'no_vehicle_allotted_to_this_route', 'no', '2017-04-02 10:46:00', '0000-00-00 00:00:00'),
(528, 'Add/Edit', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(529, 'language_rtl_text_mode', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(530, 'clickatell_username', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(531, 'clickatell_password', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(532, 'clickatell_api_id', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(533, 'clickatell_sms_gateway', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(534, 'twilio_sms_gateway', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(535, 'custom_sms_gateway', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(536, 'twilio_account_sid', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(537, 'authentication_token', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(538, 'registered_phone_number', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(539, 'username', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(540, 'gateway_name', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(541, 'theory', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(542, 'practical', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(543, 'present', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(544, 'paid', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(545, 'yes', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(546, 'if_guardian_is', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(547, 'current_session', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(548, 'quick_links', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(549, 'student_details', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(550, 'student_admission', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(551, 'student_categories', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(552, 'promote_students', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(554, 'fees_master', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(555, 'search_fees_payment', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(556, 'search_due_fees', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(557, 'fees_statement', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(558, 'balance_fees_report', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(559, 'search_expense', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(560, 'student_attendance', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(561, 'attendance_by_date', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(562, 'attendance_report', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(563, 'marks_register', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(564, 'marks_grade', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(565, 'assign_subjects', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(566, 'sections', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(567, 'assignments', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(568, 'study_material', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(569, 'routes', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(570, 'vehicles', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(571, 'assign_vehicle', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(572, 'send_message', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(573, 'student_report', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(574, 'transaction_report', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(575, 'exam_marks_report', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(576, 'session_setting', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(577, 'backup / restore', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(578, 'languages', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(579, 'grade', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(580, 'percentage', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(581, 'fees_collection_&_expenses_for_session', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(582, 'fees_receipt', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(583, 'fees_category', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(584, 'fees_collection_&_expenses_for', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(585, 'library_-_books', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(586, 'transport_-_routes', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(587, 'hostel_-_rooms', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(588, 'search_by_name,_roll_no,_enroll_no,_national_identification_no,_local_identification_no_etc..', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(589, 'user_type', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(590, 'login_url', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(591, 'search_student', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(592, 'student_lists', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(593, 'detailed_view', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(595, 'active', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(596, 'syllabus', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(597, 'other_downloads', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(598, 'download', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(599, 'unpaid', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(600, 'enter_room_no', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(601, 'male', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(602, 'female', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(603, 'expense_result', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(604, 'view_schedule', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(605, 'pdf', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(606, 'not', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(607, 'scheduled', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(609, 'transaction_from', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(610, 'to', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(611, 'enabled', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(612, 'disabled', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(613, 'add_language', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(614, 'no_description', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(615, 'fees_category_list', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(616, 'add_fee_category', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(617, 'edit_fee_category', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(618, 'late_with_excuse', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(619, 'late', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(620, 'absent', 'no', '2017-04-02 09:09:09', '0000-00-00 00:00:00'),
(621, 'issue_book', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(622, 'member_type', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(623, 'issue', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(624, 'book', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(625, 'members', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(626, 'library_card_no', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(627, 'return_date', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(628, 'member_id', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(629, 'book_issued', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(630, 'timezone', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(631, 'accountants', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(632, 'librarians', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(633, 'add_librarian', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(634, 'librarian_photo', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(635, 'librarian_list', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(636, 'edit_librarian', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(637, 'current_username', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(638, 'new_username', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(639, 'confirm_username', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(640, 'change_username', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(641, 'add_accountant', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(642, 'accountant_list', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(643, 'accountant_photo', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(644, 'edit_accountant', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(645, 'book_no', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(646, 'users', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(647, 'isbn_no', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(648, 'issue_return', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(649, 'add_student', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(650, 'books_issue_return', 'no', '2017-05-20 02:33:58', '0000-00-00 00:00:00'),
(651, 'member_list', 'no', '2017-05-30 03:41:22', '0000-00-00 00:00:00'),
(652, 'issue_date', 'no', '2017-05-30 03:41:22', '0000-00-00 00:00:00'),
(653, 'surrender_membership', 'no', '2017-05-30 03:41:22', '0000-00-00 00:00:00'),
(654, 'fees_group', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(655, 'add_fees_group', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(656, 'fees_group_list', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(657, 'due_date', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(658, 'fees_code', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(659, 'fees_discount', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(660, 'edit_fees_discount', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(661, 'discount_code', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(662, 'fees_discount_list', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(663, 'add_fees_discount', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(664, 'all', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(665, 'assign_fees_discount', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(666, 'partial', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(667, 'applied', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(668, 'student_fees', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(669, 'confirmation', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(670, 'assign / view', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(671, 'edit_fees_group', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(672, 'edit_fees_type', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(673, 'edit_fees_master', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(674, 'apply_discount', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(675, 'discount_of', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(676, 'add_member', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(677, 'email_setting', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(678, 'email_engine', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(679, 'smtp_username', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(680, 'smtp_password', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(681, 'smtp_server', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(682, 'smtp_port', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(683, 'smtp_security', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(684, 'assigned', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(685, 'admin_users', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(686, 'add_admin_user', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(687, 'admin_name', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(688, 'admin_email', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(689, 'admin_password', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(690, 'forgot_password', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00'),
(691, 'assign_fees_group', 'no', '2017-08-02 23:19:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `lang_pharses`
--

CREATE TABLE `lang_pharses` (
  `id` int(11) NOT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `key_id` int(11) DEFAULT NULL,
  `pharses` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `text` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lang_pharses`
--

INSERT INTO `lang_pharses` (`id`, `lang_id`, `key_id`, `pharses`, `text`, `is_active`, `created_at`, `updated_at`) VALUES
(997, 4, 620, 'Absent', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(998, 4, 437, 'Academic Fees Detail', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(999, 4, 211, 'Academics', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1000, 4, 79, 'Action', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1001, 4, 595, 'Active', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1002, 4, 228, 'Add', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1003, 4, 64, 'Add Another Language', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1004, 4, 499, 'Add Book', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1005, 4, 51, 'Add Category', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1006, 4, 468, 'Add Class', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1007, 4, 355, 'Add Exam', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1008, 4, 341, 'Add Expense', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1009, 4, 347, 'Add Expense Head', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1010, 4, 616, 'Add Fee Category', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1011, 4, 35, 'Add Fees', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1012, 4, 43, 'Add Fees Master', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1013, 4, 45, 'Add Fees Type', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1014, 4, 361, 'Add Grade', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1015, 4, 397, 'Add Hostel', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1016, 4, 458, 'Add Hostel Room', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1017, 4, 449, 'Add Image', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1018, 4, 613, 'Add Language', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1019, 4, 445, 'Add More Details', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1020, 4, 137, 'Add New SMS Configuration', NULL, 'no', '2017-04-10 23:40:03', '0000-00-00 00:00:00'),
(1021, 4, 402, 'Add Room Type', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1022, 4, 57, 'Add Section', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1023, 4, 53, 'Add Session', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1024, 4, 370, 'Add Subject', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1025, 4, 369, 'Add Teacher', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1026, 4, 519, 'Add Timetable', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1027, 4, 508, 'Add Vehicle', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1028, 4, 528, 'Add/Edit', NULL, 'no', '2017-04-10 23:40:22', '0000-00-00 00:00:00'),
(1029, 4, 164, 'Address', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1030, 4, 447, 'Address Details', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1031, 4, 494, 'Admin Login', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1032, 4, 303, 'Admission', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1033, 4, 11, 'Admission Date', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1034, 4, 181, 'Admission Discount', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1035, 4, 170, 'Admission Number', NULL, 'no', '2017-05-20 17:40:16', '0000-00-00 00:00:00'),
(1036, 4, 89, 'Amount', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1038, 4, 366, 'Assign Subject', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1039, 4, 565, 'Assign Subjects', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1040, 4, 571, 'Assign Vehicle', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1041, 4, 501, 'Assign Vehicle On Route', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1042, 4, 387, 'Assignment List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1043, 4, 567, 'Assignments', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1044, 4, 516, 'Attendance', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1045, 4, 349, 'Attendance Already Submitted As Holiday', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1046, 4, 348, 'Attendance Already Submitted You Can Edit Record', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1047, 4, 561, 'Attendance By Date', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1048, 4, 562, 'Attendance Report', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1049, 4, 351, 'Attendance Saved Successfully', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1050, 4, 537, 'Authentication Token', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1051, 4, 190, 'Author', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1052, 4, 385, 'Available For', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1053, 4, 382, 'Available For All Classes', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1054, 4, 577, 'Backup / Restore', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1055, 4, 423, 'Backup Files', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1056, 4, 421, 'Backup History', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1057, 4, 108, 'Balance', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1058, 4, 92, 'Balance Description', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1059, 4, 320, 'Balance Details', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1060, 4, 328, 'Balance Fees', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1061, 4, 558, 'Balance Fees Report', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1062, 4, 23, 'Bank Account Number', NULL, 'no', '2017-05-20 17:40:30', '0000-00-00 00:00:00'),
(1063, 4, 24, 'Bank Name', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1064, 4, 227, 'Basic Information', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1065, 4, 391, 'Book Details', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1066, 4, 393, 'Book List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1067, 4, 199, 'Book Title', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1068, 4, 192, 'Book Price', NULL, 'no', '2017-04-10 23:43:06', '0000-00-00 00:00:00'),
(1069, 4, 524, 'Books', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1070, 4, 464, 'By Date', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1071, 4, 141, 'Cancel', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1072, 4, 471, 'Cash', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1073, 4, 168, 'Cast', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1074, 4, 16, 'Category', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1075, 4, 50, 'Category List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1076, 4, 275, 'Change Password', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1077, 4, 80, 'Change Status', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1078, 4, 472, 'Cheque', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1079, 4, 9, 'Class', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1080, 4, 429, 'Class Fees Detail', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1081, 4, 54, 'Class List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1082, 4, 333, 'Class Section', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1083, 4, 492, 'Class Timetable', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1084, 4, 116, 'Classes', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1085, 4, 532, 'Clickatell Api Id', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1086, 4, 531, 'Clickatell Password', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1087, 4, 533, 'Clickatell SMS Gateway', NULL, 'no', '2017-04-10 23:44:20', '0000-00-00 00:00:00'),
(1088, 4, 530, 'Clickatell Username', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1089, 4, 319, 'Collect Fees', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1090, 4, 330, 'Collect Transport Fees', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1091, 4, 117, 'Collection', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1092, 4, 284, 'Communicate', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1093, 4, 252, 'Compose New Message', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1094, 4, 123, 'Confirm Password', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1095, 4, 384, 'Content File', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1096, 4, 380, 'Content List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1097, 4, 246, 'Content Title', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1098, 4, 203, 'Content Type', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1099, 4, 233, 'Continue', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1100, 4, 456, 'Cost Per Bed', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1101, 4, 422, 'Create Backup', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1102, 4, 263, 'Create Category', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1103, 4, 395, 'Create Route', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1104, 4, 65, 'Created At', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1105, 4, 295, 'Currency', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1106, 4, 296, 'Currency Symbol', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1107, 4, 302, 'Current', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1108, 4, 17, 'Current Address', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1109, 4, 121, 'Current Password', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1110, 4, 547, 'Current Session', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1111, 4, 535, 'Custom SMS Gateway', NULL, 'no', '2017-04-10 23:45:00', '0000-00-00 00:00:00'),
(1112, 4, 125, 'Date', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1113, 4, 294, 'Date Format', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1114, 4, 495, 'Date From', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1115, 4, 13, 'Date Of Birth', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1116, 4, 225, 'Date To', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1117, 4, 491, 'Day', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1118, 4, 470, 'DD', NULL, 'no', '2017-04-10 23:45:12', '0000-00-00 00:00:00'),
(1120, 4, 311, 'Delete', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1121, 4, 107, 'Deposit', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1122, 4, 101, 'Description', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1123, 4, 593, 'Detailed View', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1124, 4, 306, 'Details', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1125, 4, 612, 'Disabled', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1126, 4, 91, 'Discount', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1127, 4, 292, 'Download Sample Import File', NULL, 'no', '2017-04-10 23:46:06', '0000-00-00 00:00:00'),
(1128, 4, 438, 'Document List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1129, 4, 312, 'Documents', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1130, 4, 598, 'Download', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1131, 4, 212, 'Download Center', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1132, 4, 321, 'Download PDF', NULL, 'no', '2017-04-10 23:46:23', '0000-00-00 00:00:00'),
(1133, 4, 509, 'Driver Contact', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1134, 4, 510, 'Driver License', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1135, 4, 511, 'Driver Name', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1136, 4, 48, 'Edit', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1137, 4, 392, 'Edit Book', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1138, 4, 465, 'Edit Category', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1139, 4, 375, 'Edit Class', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1140, 4, 467, 'Edit Exam', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1141, 4, 342, 'Edit Expense', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1142, 4, 345, 'Edit Expense Head', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1143, 4, 617, 'Edit Fee Category', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1144, 4, 360, 'Edit Grade', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1145, 4, 398, 'Edit Hostel', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1146, 4, 453, 'Edit Hostel Room', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1147, 4, 72, 'Edit Logo', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1148, 4, 406, 'Edit Message', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1149, 4, 272, 'Edit Notification', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1150, 4, 404, 'Edit Room Type', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1151, 4, 396, 'Edit Route', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1152, 4, 377, 'Edit Section', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1153, 4, 411, 'Edit Session', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1154, 4, 520, 'Edit Setting', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1155, 4, 374, 'Edit Subject', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1156, 4, 368, 'Edit Teacher', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1157, 4, 505, 'Edit Vehicle', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1158, 4, 500, 'Edit Vehicle On Route', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1159, 4, 3, 'Email', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1160, 4, 611, 'Enabled', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1161, 4, 238, 'End Time', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1162, 4, 171, 'Enrollment Number', NULL, 'no', '2017-05-20 17:40:51', '0000-00-00 00:00:00'),
(1163, 4, 600, 'Enter Room Number', NULL, 'no', '2017-05-20 17:41:06', '0000-00-00 00:00:00'),
(1164, 4, 236, 'Exam', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1165, 4, 235, 'Exam List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1166, 4, 575, 'Exam Marks Report', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1167, 4, 142, 'Exam Name', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1168, 4, 466, 'Exam Not Allotted', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1169, 4, 482, 'Exam Schedule', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1170, 4, 358, 'Exam Scheduled', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1171, 4, 523, 'Exam Status', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1172, 4, 439, 'Exam Timetable', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1173, 4, 210, 'Examinations', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1174, 4, 340, 'Expense Detail', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1175, 4, 339, 'Expense Head', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1176, 4, 344, 'Expense Head List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1177, 4, 338, 'Expense Id', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1178, 4, 343, 'Expense List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1179, 4, 603, 'Expense Result', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1180, 4, 206, 'Expenses', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1181, 4, 33, 'Export Format', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1182, 4, 232, 'Fail', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1183, 4, 202, 'Fare', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1184, 4, 287, 'Father', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1185, 4, 157, 'Father Name', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1186, 4, 159, 'Father Occupation', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1187, 4, 158, 'Father Phone', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1188, 4, 39, 'Fee Category', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1189, 4, 115, 'Fees Master', NULL, 'no', '2017-04-10 23:48:52', '0000-00-00 00:00:00'),
(1190, 4, 40, 'Fees Type', NULL, 'no', '2017-04-10 23:48:56', '0000-00-00 00:00:00'),
(1191, 4, 184, 'Fees', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1192, 4, 583, 'Fees Category', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1193, 4, 615, 'Fees Category List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1195, 4, 208, 'Fees Collection', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1196, 4, 584, 'Fees Collection & Expenses For', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1197, 4, 581, 'Fees Collection & Expenses For Session', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1198, 4, 337, 'Fees Collection Details', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1199, 4, 156, 'Fees Discount', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1200, 4, 554, 'Fees Master', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1201, 4, 44, 'Fees Master List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1202, 4, 582, 'Fees Receipt', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1203, 4, 557, 'Fees Statement', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1204, 4, 102, 'Fees Subtotal', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1205, 4, 452, 'Fees Type', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1206, 4, 46, 'Fees Type List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1207, 4, 602, 'Female', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1208, 4, 462, 'Fill Marks', NULL, 'no', '2017-08-02 10:40:58', '0000-00-00 00:00:00'),
(1209, 4, 87, 'Fine', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1210, 4, 7, 'First Name', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1211, 4, 240, 'Full Mark', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1212, 4, 299, 'Full Marks', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1213, 4, 540, 'Gateway Name', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1214, 4, 186, 'Gender', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1215, 4, 408, 'General Settings', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1216, 4, 34, 'Generate PDF', NULL, 'no', '2017-04-10 23:50:09', '0000-00-00 00:00:00'),
(1217, 4, 579, 'Grade', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1218, 4, 364, 'Grade List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1219, 4, 145, 'Grade Name', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1220, 4, 106, 'Grand Total', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1221, 4, 327, 'Gross Fees', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1222, 4, 30, 'Guardian Address', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1223, 4, 273, 'Guardian Details', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1224, 4, 27, 'Guardian Name', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1225, 4, 163, 'Guardian Occupation', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1226, 4, 29, 'Guardian Phone', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1227, 4, 28, 'Guardian Relation', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1228, 4, 352, 'Holiday', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1229, 4, 220, 'Hostel', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1230, 4, 587, 'Hostel - Rooms', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1231, 4, 399, 'Hostel List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1232, 4, 221, 'Hostel Name', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1233, 4, 457, 'Hostel Room List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1234, 4, 481, 'Hostel Rooms', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1235, 4, 169, 'Id', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1236, 4, 309, 'Identification', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1237, 4, 493, 'If Guardian Address is Current Address', NULL, 'no', '2017-04-10 23:50:50', '0000-00-00 00:00:00'),
(1238, 4, 546, 'If Guardian Is', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1239, 4, 446, 'If Permanent Address is Current Address', NULL, 'no', '2017-04-10 23:50:57', '0000-00-00 00:00:00'),
(1240, 4, 25, 'IFSC Code', NULL, 'no', '2017-04-10 23:51:18', '0000-00-00 00:00:00'),
(1241, 4, 32, 'Import Excel', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1242, 4, 291, 'Import Student', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1243, 4, 197, 'Intake', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1244, 4, 86, 'Invoice Number', NULL, 'no', '2017-05-20 17:41:26', '0000-00-00 00:00:00'),
(1245, 4, 188, 'ISBN', NULL, 'no', '2017-04-10 23:51:32', '0000-00-00 00:00:00'),
(1246, 4, 165, 'Language', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1247, 4, 63, 'Language List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1248, 4, 529, 'Language RTL Text Mode', NULL, 'no', '2017-04-10 23:51:53', '0000-00-00 00:00:00'),
(1249, 4, 578, 'Languages', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1250, 4, 8, 'Last Name', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1251, 4, 619, 'Late', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1252, 4, 618, 'Late With Excuse', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1253, 4, 234, 'Leave', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1254, 4, 214, 'Library', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1255, 4, 585, 'Library - Books', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1256, 4, 479, 'Library Book', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1257, 4, 526, 'Library Books', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1258, 4, 229, 'List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1259, 4, 485, 'Local Identification Number', NULL, 'no', '2017-05-20 17:41:34', '0000-00-00 00:00:00'),
(1260, 4, 436, 'Login Details', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1261, 4, 590, 'Login Url', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1262, 4, 514, 'Logout', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1263, 4, 601, 'Male', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1264, 4, 70, 'Manage', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1265, 4, 353, 'Mark As Holiday', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1266, 4, 459, 'Mark Register', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1267, 4, 564, 'Marks Grade', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1268, 4, 563, 'Marks Register', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1269, 4, 357, 'Marks Register Prepared', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1270, 4, 265, 'Message', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1271, 4, 256, 'Message To', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1272, 4, 270, 'Miscellaneous Details', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1273, 4, 12, 'Mobile Number', NULL, 'no', '2017-05-20 17:41:39', '0000-00-00 00:00:00'),
(1274, 4, 487, 'Mode', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1275, 4, 489, 'Month', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1276, 4, 432, 'Monthly Expenses', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1277, 4, 431, 'Monthly Fees Collection', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1278, 4, 288, 'Mother', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1279, 4, 160, 'Mother Name', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1280, 4, 162, 'Mother Occupation', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1281, 4, 161, 'Mother Phone', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1282, 4, 386, 'My Children', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1283, 4, 486, 'My Profile', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1284, 4, 153, 'Name', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1285, 4, 484, 'National Identification Number', NULL, 'no', '2017-05-20 17:41:44', '0000-00-00 00:00:00'),
(1286, 4, 122, 'New Password', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1287, 4, 442, 'Next Session Status', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1288, 4, 310, 'No', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1289, 4, 354, 'No Attendance Prepared', NULL, 'no', '2017-04-10 23:53:26', '0000-00-00 00:00:00'),
(1290, 4, 614, 'No Description', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1291, 4, 475, 'No Exam Prepared', NULL, 'no', '2017-04-10 23:53:35', '0000-00-00 00:00:00'),
(1292, 4, 430, 'No Fees Found', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1293, 4, 455, 'Number Of Bed', NULL, 'no', '2017-05-20 13:43:42', '0000-00-00 00:00:00'),
(1294, 4, 201, 'Number Of Vehicle', NULL, 'no', '2017-05-20 13:43:54', '0000-00-00 00:00:00'),
(1295, 4, 259, 'No Record Found', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1296, 4, 443, 'No Result Prepared', NULL, 'no', '2017-04-10 23:53:47', '0000-00-00 00:00:00'),
(1297, 4, 94, 'No Search Record Found', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1298, 4, 317, 'No Transaction Found', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1299, 4, 331, 'No Transport Fees Found', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1300, 4, 527, 'No vehicle allotted to this route', NULL, 'no', '2017-04-10 23:54:28', '0000-00-00 00:00:00'),
(1301, 4, 606, 'Not', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1302, 4, 290, 'Not Scheduled', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1303, 4, 150, 'Note', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1304, 4, 253, 'Notice', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1305, 4, 285, 'Notice Board', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1306, 4, 254, 'Notice Date', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1307, 4, 278, 'Notifications', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1308, 4, 300, 'Obtain Marks', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1309, 4, 419, 'Off', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1310, 4, 420, 'On', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1311, 4, 496, 'Other', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1312, 4, 335, 'Other Discount', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1313, 4, 390, 'Other Download List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1314, 4, 597, 'Other Downloads', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1315, 4, 544, 'Paid', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1316, 4, 324, 'Paid Fees', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1317, 4, 257, 'Parent', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1318, 4, 444, 'Parent Guardian Detail', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1319, 4, 231, 'Pass', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1320, 4, 241, 'Passing Marks', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1321, 4, 167, 'Password', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1322, 4, 313, 'Payment', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1323, 4, 274, 'Payment Id', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1324, 4, 450, 'Payment Id Detail', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1325, 4, 418, 'Paypal Email', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1326, 4, 416, 'Paypal Password', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1327, 4, 414, 'Paypal Setting', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1328, 4, 417, 'Paypal Signature', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1329, 4, 415, 'Paypal Username', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1330, 4, 605, 'PDF', NULL, 'no', '2017-04-10 23:55:16', '0000-00-00 00:00:00'),
(1331, 4, 147, 'Percent', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1332, 4, 363, 'Percent From', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1333, 4, 149, 'Percent To', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1334, 4, 362, 'Percent Upto', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1335, 4, 580, 'Percentage', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1336, 4, 18, 'Permanent Address', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1337, 4, 73, 'Phone', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1339, 4, 463, 'Post New Message', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1340, 4, 193, 'Post Date', NULL, 'no', '2017-04-10 23:55:57', '0000-00-00 00:00:00'),
(1341, 4, 542, 'Practical', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1342, 4, 543, 'Present', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1343, 4, 267, 'Previous School Details', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1344, 4, 400, 'Print', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1345, 4, 329, 'Print Selected', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1346, 4, 297, 'Profile', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1347, 4, 245, 'Promote', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1348, 4, 440, 'Promote In Session', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1349, 4, 552, 'Promote Students', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1350, 4, 441, 'Promote Students In Next Session', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1351, 4, 286, 'Publish Date', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1352, 4, 255, 'Publish On', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1353, 4, 189, 'Publisher', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1354, 4, 191, 'Qty', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1355, 4, 548, 'Quick Links', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1356, 4, 218, 'Rack Number', NULL, 'no', '2017-05-20 17:42:23', '0000-00-00 00:00:00'),
(1357, 4, 104, 'Receipt Number', NULL, 'no', '2017-05-20 17:42:19', '0000-00-00 00:00:00'),
(1358, 4, 538, 'Registered Phone Number', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1359, 4, 15, 'Religion', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1360, 4, 82, 'Report', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1361, 4, 525, 'Report Card', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1362, 4, 216, 'Reports', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1363, 4, 85, 'Reset', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1364, 4, 427, 'Restore', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1365, 4, 230, 'Result', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1366, 4, 473, 'Revert', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1367, 4, 6, 'Roll Number', NULL, 'no', '2017-05-20 17:42:27', '0000-00-00 00:00:00'),
(1368, 4, 239, 'Room', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1369, 4, 242, 'Room Number', NULL, 'no', '2017-05-20 17:42:33', '0000-00-00 00:00:00'),
(1370, 4, 454, 'Room Number / Name', NULL, 'no', '2017-05-20 13:45:35', '0000-00-00 00:00:00'),
(1371, 4, 401, 'Room Type', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1372, 4, 403, 'Room Type List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1373, 4, 503, 'Route', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1374, 4, 394, 'Route List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1375, 4, 223, 'Route Title', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1376, 4, 569, 'Routes', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1377, 4, 185, 'RTE', NULL, 'no', '2017-04-10 23:57:10', '0000-00-00 00:00:00'),
(1378, 4, 66, 'Save', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1379, 4, 298, 'Save Attendance', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1380, 4, 607, 'Scheduled', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1381, 4, 151, 'School Code', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1383, 4, 69, 'School Logo', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1384, 4, 2, 'School Name', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1385, 4, 37, 'Search', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1386, 4, 497, 'Search By Keyword', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1387, 4, 588, 'Search By Name, Roll Number, Enroll Number, National Id, Local Id Etc..', NULL, 'no', '2017-05-20 17:42:47', '0000-00-00 00:00:00'),
(1388, 4, 556, 'Search Due Fees', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1389, 4, 559, 'Search Expense', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1390, 4, 555, 'Search Fees Payment', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1391, 4, 591, 'Search Student', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1392, 4, 336, 'Search Transaction', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1393, 4, 10, 'Section', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1394, 4, 56, 'Section List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1395, 4, 451, 'Section Name', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1396, 4, 566, 'Sections', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1397, 4, 407, 'Select', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1398, 4, 84, 'Select Criteria', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1399, 4, 293, 'Select CSV File', NULL, 'no', '2017-04-10 23:58:35', '0000-00-00 00:00:00'),
(1400, 4, 31, 'Select Image', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1401, 4, 68, 'Select Logo', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1402, 4, 266, 'Send', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1403, 4, 572, 'Send Message', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1404, 4, 1, 'Session', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1405, 4, 52, 'Session List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1406, 4, 576, 'Session Setting', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1407, 4, 410, 'Session Start Month', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1408, 4, 517, 'Show', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1409, 4, 305, 'Sibling', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1411, 4, 152, 'Sign In', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1412, 4, 477, 'Smart School', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1413, 4, 76, 'SMS Configuration', NULL, 'no', '2017-04-10 23:59:11', '0000-00-00 00:00:00'),
(1414, 4, 77, 'SMS Gateway URL', NULL, 'no', '2017-05-20 13:47:13', '0000-00-00 00:00:00'),
(1415, 4, 476, 'SMS Setting', NULL, 'no', '2017-04-10 23:59:22', '0000-00-00 00:00:00'),
(1416, 4, 237, 'Start Time', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1417, 4, 78, 'Status', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1418, 4, 61, 'Student', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1419, 4, 550, 'Student Admission', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1420, 4, 560, 'Student Attendance', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1421, 4, 551, 'Student Categories', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1422, 4, 325, 'Student Detail', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1423, 4, 549, 'Student Details', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1424, 4, 322, 'Student Fees Report', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1425, 4, 207, 'Student Information', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1426, 4, 592, 'Students List', NULL, 'no', '2017-04-10 23:59:55', '0000-00-00 00:00:00'),
(1427, 4, 183, 'Student Name', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1428, 4, 573, 'Student Report', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1429, 4, 434, 'Students', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1430, 4, 568, 'Study Material', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1431, 4, 388, 'Study Material List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1432, 4, 217, 'Subject', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1433, 4, 144, 'Subject Code', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1434, 4, 261, 'Subject List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1435, 4, 143, 'Subject Name', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1436, 4, 521, 'Subject Type', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1437, 4, 483, 'Subjects', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1438, 4, 359, 'Submit', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1439, 4, 596, 'Syllabus', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1440, 4, 389, 'Syllabus List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1441, 4, 215, 'System Settings', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1442, 4, 258, 'Teacher', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1443, 4, 260, 'Teacher Detail', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1444, 4, 251, 'Teacher List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1445, 4, 166, 'Teacher Name', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1446, 4, 187, 'Teacher Photo', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1447, 4, 469, 'Teacher Subject', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1448, 4, 433, 'Teachers', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1449, 4, 541, 'Theory', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1450, 4, 264, 'Title', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1451, 4, 610, 'To', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1452, 4, 90, 'Total', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1453, 4, 182, 'Total Balance', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1454, 4, 323, 'Total Fees', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1455, 4, 301, 'Total Marks', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1456, 4, 180, 'Total Paid Fees', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1457, 4, 332, 'Total Transport Fees', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1458, 4, 609, 'Transaction From', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1459, 4, 574, 'Transaction Report', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1460, 4, 222, 'Transport', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1461, 4, 586, 'Transport - Routes', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1462, 4, 155, 'Transport Fees', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1463, 4, 318, 'Transport Fees Details', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1464, 4, 480, 'Transport Routes', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1465, 4, 536, 'Twilio Account SID', NULL, 'no', '2017-04-11 00:01:04', '0000-00-00 00:00:00'),
(1466, 4, 534, 'Twilio SMS Gateway', NULL, 'no', '2017-04-11 00:01:10', '0000-00-00 00:00:00'),
(1467, 4, 88, 'Type', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1468, 4, 599, 'Unpaid', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1469, 4, 490, 'Upload', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1470, 4, 378, 'Upload Content', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1471, 4, 205, 'Upload Date', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1472, 4, 268, 'Upload Documents', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1473, 4, 424, 'Upload From Local Directory', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1474, 4, 488, 'URL', NULL, 'no', '2017-04-11 00:01:27', '0000-00-00 00:00:00'),
(1475, 4, 478, 'User Login', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1476, 4, 74, 'User Name', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1477, 4, 589, 'User Type', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1478, 4, 539, 'Username', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1479, 4, 506, 'Vehicle', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1480, 4, 507, 'Vehicle List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1481, 4, 513, 'Vehicle Model', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1482, 4, 512, 'Vehicle Number', NULL, 'no', '2017-05-20 17:42:56', '0000-00-00 00:00:00'),
(1483, 4, 502, 'Vehicle Route List', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1484, 4, 504, 'Vehicle Routes', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1485, 4, 570, 'Vehicles', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1486, 4, 474, 'View', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1487, 4, 522, 'View Detail', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1488, 4, 604, 'View Schedule', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1489, 4, 356, 'View Status', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1490, 4, 280, 'Visibility', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1491, 4, 279, 'Visible To All', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1492, 4, 515, 'Year Made', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1493, 4, 545, 'Yes', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(1494, 4, 350, 'You Can Edit Record', NULL, 'no', '2017-04-07 01:48:39', '0000-00-00 00:00:00'),
(36671, 4, 642, 'Accountant List', NULL, 'no', '2017-05-20 13:33:47', '0000-00-00 00:00:00'),
(36672, 4, 643, 'Accountant Photo', NULL, 'no', '2017-05-20 13:33:56', '0000-00-00 00:00:00'),
(36673, 4, 631, 'Accountants', NULL, 'no', '2017-05-20 13:34:03', '0000-00-00 00:00:00'),
(36674, 4, 641, 'Add Accountant', NULL, 'no', '2017-05-20 13:34:14', '0000-00-00 00:00:00'),
(36675, 4, 633, 'Add Librarian', NULL, 'no', '2017-05-20 13:34:40', '0000-00-00 00:00:00'),
(36677, 4, 649, 'Add Student', NULL, 'no', '2017-05-20 13:35:41', '0000-00-00 00:00:00'),
(36678, 4, 624, 'Book', NULL, 'no', '2017-05-20 13:36:04', '0000-00-00 00:00:00'),
(36679, 4, 629, 'Book Issued', NULL, 'no', '2017-05-20 13:36:13', '0000-00-00 00:00:00'),
(36680, 4, 645, 'Book Number', NULL, 'no', '2017-05-20 13:36:30', '0000-00-00 00:00:00'),
(36681, 4, 650, 'Books Issue Retun', NULL, 'no', '2017-05-20 13:36:49', '0000-00-00 00:00:00'),
(36682, 4, 640, 'Change Username', NULL, 'no', '2017-05-20 13:37:05', '0000-00-00 00:00:00'),
(36683, 4, 639, 'Confirm Username', NULL, 'no', '2017-05-20 13:37:39', '0000-00-00 00:00:00'),
(36684, 4, 637, 'Current Username', NULL, 'no', '2017-05-20 13:38:06', '0000-00-00 00:00:00'),
(36685, 4, 644, 'Edit Accountant', NULL, 'no', '2017-05-20 13:38:44', '0000-00-00 00:00:00'),
(36686, 4, 636, 'Edit Librarian', NULL, 'no', '2017-05-20 13:39:30', '0000-00-00 00:00:00'),
(36687, 4, 647, 'ISBN Number', NULL, 'no', '2017-05-20 13:40:25', '0000-00-00 00:00:00'),
(36688, 4, 623, 'Issue', NULL, 'no', '2017-05-20 13:40:30', '0000-00-00 00:00:00'),
(36689, 4, 621, 'Issue Book', NULL, 'no', '2017-05-20 13:40:40', '0000-00-00 00:00:00'),
(36690, 4, 648, 'Issue Return', NULL, 'no', '2017-05-20 14:35:21', '0000-00-00 00:00:00'),
(36691, 4, 635, 'Librarian List', NULL, 'no', '2017-05-20 13:41:31', '0000-00-00 00:00:00'),
(36692, 4, 634, 'Librarian Photo', NULL, 'no', '2017-05-20 13:41:38', '0000-00-00 00:00:00'),
(36693, 4, 632, 'Librarian', NULL, 'no', '2017-05-20 13:41:42', '0000-00-00 00:00:00'),
(36694, 4, 632, 'Librarians', NULL, 'no', '2017-05-20 13:41:45', '0000-00-00 00:00:00'),
(36695, 4, 632, 'Librarians', NULL, 'no', '2017-05-20 13:41:48', '0000-00-00 00:00:00'),
(36696, 4, 626, 'Library Card Number', NULL, 'no', '2017-05-20 13:42:23', '0000-00-00 00:00:00'),
(36697, 4, 628, 'Member Id', NULL, 'no', '2017-05-20 13:42:53', '0000-00-00 00:00:00'),
(36698, 4, 622, 'Member Type', NULL, 'no', '2017-05-20 13:43:01', '0000-00-00 00:00:00'),
(36699, 4, 625, 'Members', NULL, 'no', '2017-05-20 13:43:06', '0000-00-00 00:00:00'),
(36700, 4, 638, 'New Username', NULL, 'no', '2017-05-20 13:43:23', '0000-00-00 00:00:00'),
(36701, 4, 627, 'Return Date', NULL, 'no', '2017-05-20 13:45:06', '0000-00-00 00:00:00'),
(36702, 4, 630, 'Timezone', NULL, 'no', '2017-05-20 13:47:48', '0000-00-00 00:00:00'),
(36703, 4, 646, 'Users', NULL, 'no', '2017-05-20 13:48:21', '0000-00-00 00:00:00'),
(73979, 4, 653, 'Surrender Membership', NULL, 'no', '2017-05-30 03:56:46', '0000-00-00 00:00:00'),
(73980, 4, 651, 'Members List', NULL, 'no', '2017-05-30 03:57:05', '0000-00-00 00:00:00'),
(73981, 4, 651, 'Members List', NULL, 'no', '2017-05-30 03:57:18', '0000-00-00 00:00:00'),
(73982, 4, 652, 'Issue Date', NULL, 'no', '2017-05-30 03:57:35', '0000-00-00 00:00:00'),
(73983, 4, 686, 'Add Admin User', NULL, 'no', '2017-08-02 10:34:51', '0000-00-00 00:00:00'),
(73984, 4, 655, 'Add Fees Group', NULL, 'no', '2017-08-02 10:35:14', '0000-00-00 00:00:00'),
(73985, 4, 663, 'Add Fees Discount', NULL, 'no', '2017-08-02 10:35:27', '0000-00-00 00:00:00'),
(73986, 4, 676, 'Add Member', NULL, 'no', '2017-08-02 10:35:40', '0000-00-00 00:00:00'),
(73987, 4, 688, 'Admin Email', NULL, 'no', '2017-08-02 10:35:53', '0000-00-00 00:00:00'),
(73988, 4, 687, 'Admin Name', NULL, 'no', '2017-08-02 10:36:04', '0000-00-00 00:00:00'),
(73989, 4, 689, 'Admin Password', NULL, 'no', '2017-08-02 10:36:11', '0000-00-00 00:00:00'),
(73990, 4, 685, 'Admin Users', NULL, 'no', '2017-08-02 10:36:22', '0000-00-00 00:00:00'),
(73991, 4, 664, 'All', NULL, 'no', '2017-08-02 10:36:28', '0000-00-00 00:00:00'),
(73992, 4, 667, 'Applied', NULL, 'no', '2017-08-02 10:36:37', '0000-00-00 00:00:00'),
(73993, 4, 674, 'Apply Discount', NULL, 'no', '2017-08-02 10:36:48', '0000-00-00 00:00:00'),
(73994, 4, 670, 'Assign / View', NULL, 'no', '2017-08-02 10:37:03', '0000-00-00 00:00:00'),
(73995, 4, 665, 'Assign Fees Discount', NULL, 'no', '2017-08-02 10:37:16', '0000-00-00 00:00:00'),
(73996, 4, 684, 'Assigned', NULL, 'no', '2017-08-02 10:37:29', '0000-00-00 00:00:00'),
(73997, 4, 669, 'Confirmation', NULL, 'no', '2017-08-02 10:37:42', '0000-00-00 00:00:00'),
(73998, 4, 661, 'Discount Code', NULL, 'no', '2017-08-02 10:37:54', '0000-00-00 00:00:00'),
(73999, 4, 675, 'Discount of', NULL, 'no', '2017-08-02 10:38:03', '0000-00-00 00:00:00'),
(74000, 4, 657, 'Due Date', NULL, 'no', '2017-08-02 10:38:12', '0000-00-00 00:00:00'),
(74001, 4, 660, 'Edit Fees Discount', NULL, 'no', '2017-08-02 10:38:24', '0000-00-00 00:00:00'),
(74002, 4, 671, 'Edit Fees Group', NULL, 'no', '2017-08-02 10:38:35', '0000-00-00 00:00:00'),
(74003, 4, 673, 'Edit Fees Master', NULL, 'no', '2017-08-02 10:38:44', '0000-00-00 00:00:00'),
(74004, 4, 672, 'Edit Fees Type', NULL, 'no', '2017-08-02 10:38:53', '0000-00-00 00:00:00'),
(74005, 4, 678, 'Email Engine', NULL, 'no', '2017-08-02 10:39:02', '0000-00-00 00:00:00'),
(74006, 4, 677, 'Email Setting', NULL, 'no', '2017-08-02 10:39:11', '0000-00-00 00:00:00'),
(74007, 4, 658, 'Fees Code', NULL, 'no', '2017-08-02 10:39:20', '0000-00-00 00:00:00'),
(74008, 4, 659, 'Fees Discount', NULL, 'no', '2017-08-02 10:39:43', '0000-00-00 00:00:00'),
(74009, 4, 662, 'Fees Discount List', NULL, 'no', '2017-08-02 10:40:20', '0000-00-00 00:00:00'),
(74010, 4, 654, 'Fees Group', NULL, 'no', '2017-08-02 10:40:28', '0000-00-00 00:00:00'),
(74011, 4, 656, 'Fees Group List', NULL, 'no', '2017-08-02 10:40:37', '0000-00-00 00:00:00'),
(74012, 4, 690, 'Forgot Password', NULL, 'no', '2017-08-02 10:40:49', '0000-00-00 00:00:00'),
(74013, 4, 690, 'Forgot Password', NULL, 'no', '2017-08-02 10:41:10', '0000-00-00 00:00:00'),
(74014, 4, 666, 'Partial', NULL, 'no', '2017-08-02 10:41:25', '0000-00-00 00:00:00'),
(74015, 4, 680, 'SMTP Password', NULL, 'no', '2017-08-02 10:41:42', '0000-00-00 00:00:00'),
(74016, 4, 682, 'SMTP Port', NULL, 'no', '2017-08-02 10:41:50', '0000-00-00 00:00:00'),
(74017, 4, 683, 'SMTP Security', NULL, 'no', '2017-08-02 10:42:01', '0000-00-00 00:00:00'),
(74018, 4, 681, 'SMTP Server', NULL, 'no', '2017-08-02 10:42:09', '0000-00-00 00:00:00');
INSERT INTO `lang_pharses` (`id`, `lang_id`, `key_id`, `pharses`, `text`, `is_active`, `created_at`, `updated_at`) VALUES
(74019, 4, 679, 'SMTP Username', NULL, 'no', '2017-08-02 10:42:17', '0000-00-00 00:00:00'),
(74020, 4, 668, 'Student Fees', NULL, 'no', '2017-08-02 10:42:25', '0000-00-00 00:00:00'),
(74021, 4, 691, 'Assign Fees Group', NULL, 'no', '2017-08-02 10:42:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `libarary_members`
--

CREATE TABLE `libarary_members` (
  `id` int(11) UNSIGNED NOT NULL,
  `library_card_no` varchar(50) DEFAULT NULL,
  `member_type` varchar(50) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `libarary_members`
--

INSERT INTO `libarary_members` (`id`, `library_card_no`, `member_type`, `member_id`, `is_active`, `created_at`) VALUES
(1, '123123', 'student', 1, 'no', '2017-10-22 12:16:34');

-- --------------------------------------------------------

--
-- Table structure for table `librarians`
--

CREATE TABLE `librarians` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `address` text,
  `dob` date DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `librarians`
--

INSERT INTO `librarians` (`id`, `name`, `email`, `password`, `address`, `dob`, `designation`, `sex`, `phone`, `image`, `is_active`, `created_at`) VALUES
(1, 'Test', 'test@gmail.com', NULL, 'address', '2017-06-25', NULL, 'Male', 'phone', 'uploads/student_images/no_image.png', 'no', '2017-11-01 09:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` int(11) NOT NULL,
  `api_username` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_signature` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paypal_demo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `api_username`, `api_password`, `api_signature`, `api_email`, `paypal_demo`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'xxxxxx', 'xxxxxx', 'xxxxxx`', 'xxxxxx', '', 'no', '2016-10-19 17:56:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `principal`
--

CREATE TABLE `principal` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `CNIC` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `read_notification`
--

CREATE TABLE `read_notification` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `parent_id` int(10) NOT NULL,
  `notification_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` int(11) NOT NULL,
  `room_type` varchar(200) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `room_type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'One bed', 'One bed room', '2017-10-02 05:20:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `route_vehicles`
--

CREATE TABLE `route_vehicles` (
  `id` int(11) NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sch_settings`
--

CREATE TABLE `sch_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `lang_id` int(11) DEFAULT NULL,
  `dise_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_format` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `currency_symbol` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_rtl` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'disabled',
  `timezone` varchar(30) COLLATE utf8_unicode_ci DEFAULT 'UTC',
  `session_id` int(11) DEFAULT NULL,
  `start_month` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sch_settings`
--

INSERT INTO `sch_settings` (`id`, `name`, `email`, `phone`, `address`, `lang_id`, `dise_code`, `date_format`, `currency`, `currency_symbol`, `is_rtl`, `timezone`, `session_id`, `start_month`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Education automation system', 'Your School Email', 'Your School Phone', 'Your School Address', 4, 'Your School Code', 'm/d/Y', 'PKR', 'Rs.', 'disabled', 'Asia/Karachi', 12, '4', 'images.png', 'no', '2018-02-27 11:59:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `section` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'A', 'no', '2017-09-20 03:47:54', '0000-00-00 00:00:00'),
(2, 'B', 'no', '2017-09-20 08:08:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `send_notification`
--

CREATE TABLE `send_notification` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `visible_student` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `visible_teacher` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `visible_parent` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `created_by` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `session` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `session`, `is_active`, `created_at`, `updated_at`) VALUES
(7, '2015-16', 'no', '2016-08-25 10:21:28', '0000-00-00 00:00:00'),
(11, '2016-17', 'no', '2016-08-25 10:26:19', '0000-00-00 00:00:00'),
(12, '2017-18', 'no', '2016-08-25 10:26:35', '0000-00-00 00:00:00'),
(13, '2018-19', 'no', '2016-08-25 10:26:44', '0000-00-00 00:00:00'),
(14, '2019-20', 'no', '2016-08-25 10:26:55', '0000-00-00 00:00:00'),
(15, '2020-21', 'no', '2016-10-01 20:28:08', '0000-00-00 00:00:00'),
(16, '2021-22', 'no', '2016-10-01 20:28:20', '0000-00-00 00:00:00'),
(18, '2022-23', 'no', '2016-10-01 20:29:02', '0000-00-00 00:00:00'),
(19, '2023-24', 'no', '2016-10-01 20:29:10', '0000-00-00 00:00:00'),
(20, '2024-25', 'no', '2016-10-01 20:29:18', '0000-00-00 00:00:00'),
(21, '2025-26', 'no', '2016-10-01 20:30:10', '0000-00-00 00:00:00'),
(22, '2026-27', 'no', '2016-10-01 20:30:18', '0000-00-00 00:00:00'),
(23, '2027-28', 'no', '2016-10-01 20:30:24', '0000-00-00 00:00:00'),
(24, '2028-29', 'no', '2016-10-01 20:30:30', '0000-00-00 00:00:00'),
(25, '2029-30', 'no', '2016-10-01 20:30:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sms_config`
--

CREATE TABLE `sms_config` (
  `id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `api_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact` text COLLATE utf8_unicode_ci,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'disabled',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `dob` date DEFAULT NULL,
  `designation` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `joining_date` date DEFAULT NULL,
  `qualification` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qualification_details` text COLLATE utf8_unicode_ci,
  `staff_department_id` int(11) NOT NULL,
  `salary` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `due_salary` int(11) NOT NULL DEFAULT '0' COMMENT 'How much salary is due in account. It can be negative value.',
  `salary_update_date` date NOT NULL DEFAULT '0000-00-00',
  `fingerprint_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `email`, `address`, `dob`, `designation`, `sex`, `phone`, `image`, `is_active`, `joining_date`, `qualification`, `qualification_details`, `staff_department_id`, `salary`, `due_salary`, `salary_update_date`, `fingerprint_file`, `created_at`, `updated_at`) VALUES
(2, 'Name', 'a@b.c', 'address', '2017-10-07', NULL, 'Male', '123123', NULL, 'no', '0000-00-00', 'test', 'hehe', 1, 2000, 38000, '2018-10-01', 'uploads/fingerprint/staff_2.fpt', '2018-10-01 13:21:17', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `staff_attendance`
--

CREATE TABLE `staff_attendance` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `attendance` varchar(12) NOT NULL,
  `attendance_date` date NOT NULL,
  `attendance_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_attendance`
--

INSERT INTO `staff_attendance` (`id`, `staff_id`, `attendance`, `attendance_date`, `attendance_time`) VALUES
(1, 2, 'absent', '2018-04-05', '11:39:22'),
(2, 2, 'absent', '2018-04-07', '10:39:49'),
(3, 2, 'absent', '2018-04-07', '13:24:39'),
(4, 2, 'absent', '2018-04-07', '13:24:54'),
(5, 2, 'absent', '2018-04-06', '13:25:31'),
(6, 2, 'absent', '2018-04-09', '15:10:57'),
(7, 2, 'absent', '2018-04-10', '10:41:03'),
(8, 2, 'absent', '2018-04-17', '14:40:14'),
(9, 2, 'absent', '2018-04-23', '12:59:46'),
(10, 2, 'absent', '2018-04-29', '17:51:05'),
(11, 2, 'absent', '2018-05-01', '18:23:46'),
(12, 2, 'absent', '2018-05-16', '10:59:29'),
(13, 2, 'absent', '2018-05-17', '10:30:04'),
(14, 2, 'absent', '2018-05-28', '22:40:54'),
(15, 2, 'absent', '2018-05-31', '22:47:14'),
(16, 2, 'absent', '2018-05-31', '22:47:14'),
(17, 2, 'absent', '2018-06-09', '14:05:35'),
(18, 2, 'absent', '2018-06-09', '14:05:35'),
(19, 2, 'absent', '2018-06-19', '11:42:14'),
(20, 2, 'absent', '2018-06-20', '09:37:29'),
(21, 2, 'absent', '2018-07-06', '11:02:12'),
(22, 2, 'absent', '2018-07-06', '11:02:12'),
(23, 2, 'absent', '2018-07-07', '10:43:24'),
(24, 2, 'absent', '2018-07-09', '12:00:17'),
(25, 2, 'absent', '2018-07-09', '12:00:17'),
(26, 2, 'absent', '2018-07-10', '11:48:30'),
(27, 2, 'absent', '2018-07-10', '11:48:30'),
(28, 2, 'absent', '2018-07-12', '15:02:43'),
(29, 2, 'absent', '2018-07-12', '15:02:43'),
(30, 2, 'absent', '2018-07-13', '10:28:35'),
(31, 2, 'absent', '2018-08-07', '16:05:05'),
(32, 2, 'absent', '2018-08-08', '10:39:25'),
(33, 2, 'absent', '2018-08-09', '21:10:03'),
(34, 2, 'absent', '2018-08-10', '11:32:40'),
(35, 2, 'absent', '2018-08-10', '11:32:40'),
(36, 2, 'absent', '2018-08-11', '10:55:23'),
(37, 2, 'absent', '2018-08-13', '10:50:32'),
(38, 2, 'absent', '2018-09-01', '18:17:40'),
(39, 2, 'absent', '2018-10-01', '18:21:16'),
(40, 2, 'absent', '2018-08-15', '10:15:29'),
(41, 2, 'absent', '2018-08-16', '10:42:56'),
(42, 2, 'absent', '2018-08-17', '10:43:54'),
(43, 2, 'absent', '2018-08-18', '10:50:07'),
(44, 2, 'absent', '2018-08-20', '10:29:04'),
(45, 2, 'absent', '2018-08-20', '10:29:04'),
(46, 2, 'absent', '2018-08-21', '10:51:22'),
(47, 2, 'absent', '2018-08-25', '10:31:22'),
(48, 2, 'absent', '2018-08-25', '10:31:22'),
(49, 2, 'absent', '2018-08-27', '10:37:23'),
(50, 2, 'absent', '2018-08-28', '10:30:08'),
(51, 2, 'absent', '2018-08-29', '10:32:10'),
(52, 2, 'absent', '2018-08-30', '10:31:50');

-- --------------------------------------------------------

--
-- Table structure for table `staff_departments`
--

CREATE TABLE `staff_departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_departments`
--

INSERT INTO `staff_departments` (`id`, `name`) VALUES
(1, 'Technical'),
(2, 'Clerical');

-- --------------------------------------------------------

--
-- Table structure for table `staff_salary_payments`
--

CREATE TABLE `staff_salary_payments` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `due_salary` int(11) NOT NULL,
  `paid_salary` int(11) NOT NULL,
  `payment_date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_salary_payments`
--

INSERT INTO `staff_salary_payments` (`id`, `staff_id`, `due_salary`, `paid_salary`, `payment_date`) VALUES
(1, 2, 2000, 2000, '2017-10-25'),
(3, 2, 4000, 4000, '2018-02-27');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `admission_no` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roll_no` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rte` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobileno` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pincode` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `religion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cast` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dob` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_address` text COLLATE utf8_unicode_ci,
  `permanent_address` text COLLATE utf8_unicode_ci,
  `category_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adhar_no` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `samagra_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_account_no` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ifsc_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guardian_is` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `father_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_occupation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_cnic` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_occupation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guardian_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guardian_relation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guardian_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guardian_occupation` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `guardian_address` text COLLATE utf8_unicode_ci,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `fee_arrears` int(11) NOT NULL DEFAULT '0',
  `fee_update_date` date NOT NULL DEFAULT '0000-00-00',
  `discount` int(11) NOT NULL DEFAULT '0',
  `late_payment_fee` int(11) NOT NULL DEFAULT '0',
  `late_payment_fee_update_date` date NOT NULL DEFAULT '0000-00-00',
  `fee_starting_date` date DEFAULT NULL,
  `previous_school` text COLLATE utf8_unicode_ci,
  `struck_off` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `admission_no`, `roll_no`, `admission_date`, `firstname`, `lastname`, `rte`, `image`, `mobileno`, `email`, `state`, `city`, `pincode`, `religion`, `cast`, `dob`, `gender`, `current_address`, `permanent_address`, `category_id`, `adhar_no`, `samagra_id`, `bank_account_no`, `bank_name`, `ifsc_code`, `guardian_is`, `father_name`, `father_phone`, `father_occupation`, `father_cnic`, `mother_name`, `mother_phone`, `mother_occupation`, `guardian_name`, `guardian_relation`, `guardian_phone`, `guardian_occupation`, `guardian_address`, `is_active`, `fee_arrears`, `fee_update_date`, `discount`, `late_payment_fee`, `late_payment_fee_update_date`, `fee_starting_date`, `previous_school`, `struck_off`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '2017-09-01', 'first name', 'last name', 'No', 'uploads/student_images/no_image.png', '03001234567', 'test@gmail.com', NULL, NULL, NULL, 'Islam', 'jutt', '2010-07-13', 'Male', '', '', '2', '', '', '', '', '', 'father', 'father name', '03001234567', 'test occupation', '1234567891234', 'Mother name', '03001234567', 'House wife', 'father name', 'Father', '03001234567', 'test occupation', '', 'no', -6150, '2018-08-01', 0, 0, '2018-08-11', '2018-01-01', '', 0, '2018-08-28 11:28:05', '0000-00-00 00:00:00'),
(2, '2', '2', '2017-10-02', 'test 2', 'last name', 'No', 'uploads/student_images/no_image.png', '0300123457', 'test@gmail.com', NULL, NULL, NULL, 'Islam', 'jutt', '2014-02-12', 'Male', '', '', '2', '', '', '', '', '', 'mother', 'father name', '03001234567', 'test', '1234567891234', 'mother name', '123457', 'test occupation', 'mother name', 'Mother', '123457', 'test occupation', '', 'no', -7200, '2018-08-01', 0, 0, '2018-08-11', NULL, '', 0, '2018-08-28 11:28:05', '0000-00-00 00:00:00'),
(3, '111', '111', '2017-10-19', 'discount', 'test', 'No', 'uploads/student_images/no_image.png', '03001231232', 'aaa@bbb.ccc', NULL, NULL, NULL, 'islam', 'jutt', '1990-07-04', 'Male', '', '', '2', '', '', '', '', '', 'father', 'father name', '030012312312', 'testing', '1234567893214', 'mother name', '0300123123123', 'testing again', 'father name', 'Father', '030012312312', 'testing', '', 'no', 300, '2018-08-01', 500, 0, '2018-08-11', NULL, '', 0, '2018-08-28 11:28:05', '0000-00-00 00:00:00'),
(5, '3', '3', '2017-11-23', 'after 20', 'test', 'No', 'uploads/student_images/no_image.png', '123456789', 't@g.com', NULL, NULL, NULL, 'islam', 'jutt', '2017-11-15', 'Male', '', '', '1', '', '', '', '', '', 'father', 'father name', '12345789', 'test occ', '1234567893214', 'mother name', '123456789', 'test occ', 'father name', 'Father', '12345789', 'test occ', '', 'no', 2000, '2018-08-01', 0, 0, '2018-08-11', NULL, '', 0, '2018-08-28 11:28:05', '0000-00-00 00:00:00'),
(6, '100', '100', '2018-01-25', 'asdf', 'adsf', 'No', 'uploads/student_images/no_image.png', '0132165456', 'a@b.c', NULL, NULL, NULL, 'islam', 'jutt', '2015-02-03', 'Male', '', '', '', '', '', '', '', '', 'father', 'ads', 'asdf', 'asdf', '3430175201578', 'sdf', 'dsaf', 'asdf', 'ads', 'Father', 'asdf', 'asdf', '', 'no', 21750, '2018-08-01', 0, 0, '2018-08-11', NULL, '', 0, '2018-08-28 11:28:05', '0000-00-00 00:00:00'),
(7, '101', '101', '2018-01-25', 'asdf', 'adsf', 'No', 'uploads/student_images/no_image.png', '0132165456', 'a@b.c', NULL, NULL, NULL, 'islam', 'jutt', '2015-02-03', 'Male', '', '', '', '', '', '', '', '', 'father', 'ads', 'asdf', 'asdf', '3430175201578', 'sdf', 'dsaf', 'asdf', 'ads', 'Father', 'asdf', 'asdf', '', 'no', 1000, '2018-08-01', 0, 0, '2018-07-12', NULL, '', 0, '2018-08-28 11:34:25', '0000-00-00 00:00:00'),
(8, '102', '102', '2018-01-25', 'first name', 'lastn me', 'No', 'uploads/student_images/8.png', '03001234567', 'b@c.c', NULL, NULL, NULL, 'islam', 'jutt', '1980-06-03', 'Female', '', '', '1', '', '', '', '', '', 'father', 'father name', '03001234567', 'test', '1234567891234', 'test', 'test', 'test', 'father name', 'Father', '03001234567', 'test', '', 'no', -3000, '2018-08-01', 0, 0, '2018-08-16', NULL, '', 0, '2018-08-28 11:30:52', '0000-00-00 00:00:00'),
(9, '103', '103', '2018-01-25', 'name', 'la', 'No', 'uploads/student_images/9.png', '03001234567', 'a@b.c', NULL, NULL, NULL, 'islam', 'jutt', '1994-06-07', 'Male', '', '', '2', '', '', '', '', '', 'father', 'father name', '03001234567', 'test', '1234567891234', 'test', 'test', 'test', 'father name', 'Father', '03001234567', 'test', '', 'no', 13150, '2018-08-01', 0, 150, '2018-08-11', NULL, '', 0, '2018-08-28 11:30:52', '0000-00-00 00:00:00'),
(10, '105', '105', '2018-01-25', 'test name', 'lname', 'No', 'uploads/student_images/no_image.png', '03001234567', 'a@b.c', NULL, NULL, NULL, 'islam', 'jutt', '2000-02-01', 'Male', '', '', '', '', '', '', '', '', 'father', 'father name', '03001234567', 'test', '1234567891234', 'test name', '03001234567', 'housewife', 'father name', 'Father', '03001234567', 'test', '', 'no', 4750, '2018-08-01', 0, 150, '2018-08-11', '2018-01-01', '', 0, '2018-08-28 11:30:52', '0000-00-00 00:00:00'),
(11, '107', '107', '1970-01-01', 'free test', 'last', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '1970-01-01', 'Male', '', '', '1', '', '', '', '', '', 'father', 'father name', '03001234567', 'test', '1234567891234', '', '', '', 'father name', 'father', '03001234567', 'test', '', 'no', 2750, '2018-08-01', 1000, 2750, '2018-08-11', NULL, '', 0, '2018-08-28 11:30:52', '0000-00-00 00:00:00'),
(12, '109', '109', '2018-01-31', 'free', 'test', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '1990-02-06', 'Male', '', '', '1', '', '', '', '', '', 'father', 'father name', '03001234567', 'test', '1234567891234', '', '', '', 'father name', 'father', '03001234567', 'test', '', 'no', 2750, '2018-08-01', 1000, 2750, '2018-08-11', NULL, '', 0, '2018-08-28 11:30:52', '0000-00-00 00:00:00'),
(13, '110', '110', '2018-01-31', 'free', 'last', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2010-02-02', 'Male', '', '', '', '', '', '', '', '', 'father', 'father name', '03001234567', 'test', '1234567891234', '', '', '', 'father name', 'father', '03001234567', 'test', '', 'no', 2600, '2018-08-01', 1000, 2600, '2018-07-12', NULL, '', 0, '2018-08-28 11:30:52', '0000-00-00 00:00:00'),
(14, '111', '111', '2010-10-17', 'test first name', 'test last name', 'No', NULL, '3001234567', 'a@b.c', NULL, NULL, NULL, 'islam', '', '1970-01-01', NULL, 'faisalabad', 'faisalabad', NULL, NULL, NULL, NULL, NULL, NULL, '', 'test father name', '3001234567', 'Farmer', '1.23457E+12', NULL, NULL, NULL, 'test', 'father', '3001234567', '', 'faisalabad', 'no', 21410, '2018-08-01', 10, 2600, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:30:52', '0000-00-00 00:00:00'),
(15, '115', '115', '2018-02-27', 'test', 'test', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-03-20', 'Male', '', '', '', '', '', '', '', '', 'father', 'father name', '03001234567', 'test', '1234567891234', '', '', '', 'father name', 'father', '03001234567', '', '', 'no', 242600, '2018-08-01', 0, 300, '2018-08-11', NULL, '', 0, '2018-08-28 11:34:25', '0000-00-00 00:00:00'),
(16, '116', '116', '2018-02-13', 'test 2', 'test 2', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-03-20', 'Male', '', '', '', '', '', '', '', '', 'father', 'father name', '03001234567', 'test', '1234567891234', '', '', '', 'father name', 'father', '03001234567', 'test', '', 'no', 44300, '2018-08-01', 0, 300, '2018-08-11', NULL, '', 0, '2018-08-28 11:30:52', '0000-00-00 00:00:00'),
(17, '117', '117', '2018-02-19', 'test', 'test', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-03-13', 'Male', '', '', '', '', '', '', '', '', 'father', 'father name', '03001234567', 'test', '1234567891234', '', '', '', 'father name', 'father', '03001234567', 'test', '', 'no', 38050, '2018-08-01', 0, 300, '2018-08-11', '2018-01-01', '', 0, '2018-08-28 11:34:25', '0000-00-00 00:00:00'),
(18, '119', '119', '2018-02-27', 'test', 'test', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-03-13', 'Male', '', '', '', '', '', '', '', '', 'father', 'father name', '03001234567', 'test', '1234567891234', '', '', '', 'father name', 'father', '03001234567', 'test', '', 'no', 21750, '2018-08-01', 0, 2750, '2018-08-11', NULL, '', 0, '2018-08-28 11:34:25', '0000-00-00 00:00:00'),
(19, '120', '120', '2018-02-06', 'test', 'test', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-03-13', 'Male', '', '', '', '', '', '', '', '', 'father', 'father name', '03001234567', 'test', '1234567891234', '', '', '', 'father name', 'father', '03001234567', 'test', '', 'no', 2600, '2018-08-01', 1000, 2600, '2018-07-12', NULL, '', 0, '2018-08-28 11:29:21', '0000-00-00 00:00:00'),
(20, '200', '200', '2018-03-07', '200', '200', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2017-05-03', 'Male', '', '', '', '', '', '', '', '', 'father', 'father name', '03001234567', 'test', '1234567891234', '', '', '', 'father name', 'father', '03001234567', 'test', '', 'no', 12750, '2018-08-01', 500, 2750, '2018-08-11', NULL, '', 0, '2018-08-28 11:29:21', '0000-00-00 00:00:00'),
(21, '1111', '1111', '2018-03-16', 'test', 'test', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-02-16', 'Male', '', '', '', '', '', '', '', '', 'father', 'father name', '03001234567', 'test', '1234567891234', '', '', '', 'father name', 'father', '03001234567', 'test', '', 'no', 17750, '2018-08-01', 0, 1750, '2018-08-11', NULL, '', 0, '2018-08-28 11:29:21', '0000-00-00 00:00:00'),
(22, '150', '150', '2018-03-30', 'test', 'test', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2017-12-08', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'father name', '03001234567', 'test', '1234567891234', '', '', '', 'father name', 'father', '03001234567', 'test', '', 'no', 55750, '2018-08-01', 0, 1750, '2018-08-11', '2018-03-01', '', 0, '2018-08-28 11:34:25', '0000-00-00 00:00:00'),
(23, '151', '151', '2018-03-30', 'abc', 'def', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2017-12-15', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'father name', '03001234567', 'test', '1234567891234', '', '', '', 'father name', 'father', '03001234567', 'test', '', 'no', 55750, '2018-08-01', 0, 1750, '2018-08-11', '2018-03-01', '', 0, '2018-08-28 11:29:21', '0000-00-00 00:00:00'),
(24, '153', '153', '2018-04-01', 'again test', 'a', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2017-12-24', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'father name', '03001234567', 'test', '1234567891234', '', '', '', 'father name', 'father', '03001234567', 'test', '', 'no', 2330, '2018-08-01', 10, 800, '2018-08-11', '2018-04-01', '', 0, '2018-08-28 11:34:25', '0000-00-00 00:00:00'),
(25, '1133', '1133', '2018-04-09', 't', 't2', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-01-15', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'father name', '03001234567', 'test', '1234567891234', '', '', '', 'father name', 'father', '03001234567', 'test', '', 'no', 17800, '2018-08-01', 0, 800, '2018-08-11', '2018-04-01', '', 0, '2018-08-28 11:29:21', '0000-00-00 00:00:00'),
(26, '1134', '1134', '2018-04-09', 't', 't2', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-01-15', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'father name', '03001234567', 'test', '1234567891234', '', '', '', 'father name', 'Father', '03001234567', 'test', '', 'no', 9300, '2018-08-01', 500, 800, '2018-08-11', '2018-04-01', '', 0, '2018-08-28 11:29:22', '0000-00-00 00:00:00'),
(27, '1135', '1135', '2018-04-09', 't', 't2', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-01-15', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'father name', '03014093011', 'test', '1234567891234', '', '', '', 'father name', 'father', '03014093011', 'test', '', 'no', 8900, '2018-08-01', 500, 800, '2018-08-11', '2018-04-01', '', 0, '2018-08-28 11:34:25', '0000-00-00 00:00:00'),
(28, '160', '160', '2018-04-10', 'test', 'test', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-03-13', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'father name', '03014093011', 'test', '1234567891234', '', '', '', 'father name', 'father', '03014093011', 'test', '', 'no', 650, '2018-08-01', 2000, 650, '2018-07-12', '2018-04-01', '', 0, '2018-08-28 11:34:25', '0000-00-00 00:00:00'),
(29, '1000', '2132', '2018-05-16', 'student1', '', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-05-01', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'father name', '03014093011', 'test', '1234567891234', '', '', '', 'father name', 'father', '03014093011', 'test', '', 'no', 149, '2018-08-01', 0, 0, '2018-06-19', '2018-05-01', '', 0, '2018-08-28 11:34:25', '0000-00-00 00:00:00'),
(30, '1001', '324324', '2018-05-16', 'student2', '', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-05-02', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'father name', '03014093011', 'test', '1234567891234', '', '', '', 'father name', 'father', '03014093011', 'test', '', 'no', 4300, '2018-08-01', 0, 300, '2018-08-11', '2018-05-01', '', 0, '2018-08-28 11:34:25', '0000-00-00 00:00:00'),
(31, '10002', '2132', '2018-05-16', 'student1', 'mahmood', 'No', 'uploads/student_images/no_image.png', '03137313786', '', NULL, NULL, NULL, '', '', '2018-05-17', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'father name', '03014093011', 'test', '1234567891234', '', '', '', 'father name', 'father', '03014093011', 'test', '241. st56 peoples colony 56', 'no', 16950, '2018-08-01', 0, 450, '2018-08-11', '2018-05-01', '', 0, '2018-08-28 11:34:25', '0000-00-00 00:00:00'),
(32, '10003', '3434', '2018-05-16', 'student2', '', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-05-24', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'father name', '03014093011', 'test', '1234567891234', '', '', '', 'father name', 'father', '03014093011', 'test', '', 'no', 15450, '2018-08-01', 0, 450, '2018-08-11', '2018-05-01', '', 0, '2018-08-28 11:34:25', '0000-00-00 00:00:00'),
(33, '234134', '4324', '2018-05-17', 'student test', '', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-05-01', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'father name', '03014093011', 'test', '1234567891234', '', '', '', 'father name', 'father', '03014093011', 'test', '', 'no', 2000, '2018-08-01', 0, 0, '2018-08-11', '2018-05-01', '', 0, '2018-08-28 11:15:18', '0000-00-00 00:00:00'),
(34, '201', '1', '2017-02-28', 'Muhammad Ameer', 'Khan', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2010-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Muhammad Afzal Khan', '', '', '3310011969677', NULL, NULL, NULL, '', '', '', '', '', 'no', 21900, '2018-08-01', 800, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:25', '0000-00-00 00:00:00'),
(35, '202', '2', '2017-02-28', 'Eezan ', 'Hashmi', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2009-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Imtiaz Hashmi', '', '', '3311052145966', NULL, NULL, NULL, '', '', '', '', '', 'no', 23700, '2018-08-01', 700, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:25', '0000-00-00 00:00:00'),
(36, '203', '3', '2017-02-28', 'Arshman', 'Faraz', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2008-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Faraz Nadeem', '', '', '3310078007835', NULL, NULL, NULL, '', '', '', '', '', 'no', 30900, '2018-08-01', 300, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:25', '0000-00-00 00:00:00'),
(37, '204', '4', '2017-02-28', 'Muhammad Hanzla ', 'Younas', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2016-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Muhammad Younas', '', '', '3310007635825', NULL, NULL, NULL, '', '', '', '', '', 'no', 30000, '2018-08-01', 350, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:25', '0000-00-00 00:00:00'),
(38, '205', '5', '2017-02-28', 'Asjad', 'Sohail', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2007-01-19', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Sohail Asgar', '', '', '3310047956867', NULL, NULL, NULL, '', '', '', '', '', 'no', 31800, '2018-08-01', 250, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:25', '0000-00-00 00:00:00'),
(39, '206', '6', '2017-02-28', 'Abdul', 'Rahman', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2008-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Shafqat Jamil', '', '', '3300021452121', NULL, NULL, NULL, '', '', '', '', '', 'no', 32700, '2018-08-01', 200, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(40, '207', '7', '2017-02-28', 'Sharyaar', 'Ahad', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2008-04-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Ahad Javaid', '', '', '3310073774305', NULL, NULL, NULL, '', '', '', '', '', 'no', 25500, '2018-08-01', 600, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(41, '208', '8', '2017-02-28', 'Abdul Mateen', 'Baig', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2005-04-12', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Babar Mughal', '', '', '3310025152165', NULL, NULL, NULL, '', '', '', '', '', 'no', 31800, '2018-08-01', 250, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(42, '209', '9', '2018-03-12', 'Faizan ', 'Ali', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2006-12-18', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Tahir Manzoor', '', '', '4545565544444', NULL, NULL, NULL, '', '', '', '', '', 'no', 32700, '2018-08-01', 200, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(43, '210', '10', '2018-03-13', 'Sameer', '', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2001-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Ghulam Mustafa', '', '', '5657677766666', NULL, NULL, NULL, '', '', '', '', '', 'no', 28200, '2018-08-01', 450, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(44, '201', '1', '2017-02-28', 'Muhammad Ameer', 'Khan', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2010-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Muhammad Afzal Khan', '', '', '3310011969677', NULL, NULL, NULL, '', '', '', '', '', 'no', 37700, '2018-08-01', 800, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(45, '202', '2', '2017-02-28', 'Eezan ', 'Hashmi', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2009-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Imtiaz Hashmi', '', '', '3311052145966', NULL, NULL, NULL, '', '', '', '', '', 'no', 41700, '2018-08-01', 700, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(46, '203', '3', '2017-02-28', 'Arshman', 'Faraz', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2008-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Faraz Nadeem', '', '', '3310078007835', NULL, NULL, NULL, '', '', '', '', '', 'no', 48900, '2018-08-01', 300, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(47, '204', '4', '2017-02-28', 'Muhammad Hanzla ', 'Younas', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2016-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Muhammad Younas', '', '', '3310007635825', NULL, NULL, NULL, '', '', '', '', '', 'no', 48000, '2018-08-01', 350, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(48, '205', '5', '2017-02-28', 'Asjad', 'Sohail', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2007-01-19', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Sohail Asgar', '', '', '3310047956867', NULL, NULL, NULL, '', '', '', '', '', 'no', 49800, '2018-08-01', 250, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(49, '206', '6', '2017-02-28', 'Abdul', 'Rahman', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2008-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Shafqat Jamil', '', '', '3300021452121', NULL, NULL, NULL, '', '', '', '', '', 'no', 50700, '2018-08-01', 200, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(50, '207', '7', '2017-02-28', 'Sharyaar', 'Ahad', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2008-04-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Ahad Javaid', '', '', '3310073774305', NULL, NULL, NULL, '', '', '', '', '', 'no', 43500, '2018-08-01', 600, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(51, '208', '8', '2017-02-28', 'Abdul Mateen', 'Baig', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2005-04-12', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Babar Mughal', '', '', '3310025152165', NULL, NULL, NULL, '', '', '', '', '', 'no', 49800, '2018-08-01', 250, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(52, '209', '9', '2018-03-12', 'Faizan ', 'Ali', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2006-12-18', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Tahir Manzoor', '', '', '4545565544444', NULL, NULL, NULL, '', '', '', '', '', 'no', 50700, '2018-08-01', 200, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(53, '210', '10', '2018-03-13', 'Sameer', '', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2001-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Ghulam Mustafa', '', '', '5657677766666', NULL, NULL, NULL, '', '', '', '', '', 'no', 46200, '2018-08-01', 450, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(54, '201', '1', '2017-02-28', 'Muhammad Ameer', 'Khan', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2010-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Muhammad Afzal Khan', '', '', '3310011969677', NULL, NULL, NULL, '', '', '', '', '', 'no', 39900, '2018-08-01', 800, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(55, '202', '2', '2017-02-28', 'Eezan ', 'Hashmi', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2009-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Imtiaz Hashmi', '', '', '3311052145966', NULL, NULL, NULL, '', '', '', '', '', 'no', 41700, '2018-08-01', 700, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(56, '203', '3', '2017-02-28', 'Arshman', 'Faraz', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2008-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Faraz Nadeem', '', '', '3310078007835', NULL, NULL, NULL, '', '', '', '', '', 'no', 48900, '2018-08-01', 300, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(57, '204', '4', '2017-02-28', 'Muhammad Hanzla ', 'Younas', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2016-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Muhammad Younas', '', '', '3310007635825', NULL, NULL, NULL, '', '', '', '', '', 'no', 48000, '2018-08-01', 350, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(58, '205', '5', '2017-02-28', 'Asjad', 'Sohail', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2007-01-19', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Sohail Asgar', '', '', '3310047956867', NULL, NULL, NULL, '', '', '', '', '', 'no', 49800, '2018-08-01', 250, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(59, '206', '6', '2017-02-28', 'Abdul', 'Rahman', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2008-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Shafqat Jamil', '', '', '3300021452121', NULL, NULL, NULL, '', '', '', '', '', 'no', 50700, '2018-08-01', 200, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(60, '207', '7', '2017-02-28', 'Sharyaar', 'Ahad', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2008-04-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Ahad Javaid', '', '', '3310073774305', NULL, NULL, NULL, '', '', '', '', '', 'no', 43500, '2018-08-01', 600, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(61, '208', '8', '2017-02-28', 'Abdul Mateen', 'Baig', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2005-04-12', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Babar Mughal', '', '', '3310025152165', NULL, NULL, NULL, '', '', '', '', '', 'no', 49800, '2018-08-01', 250, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(62, '209', '9', '2018-03-12', 'Faizan ', 'Ali', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2006-12-18', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Tahir Manzoor', '', '', '4545565544444', NULL, NULL, NULL, '', '', '', '', '', 'no', 50700, '2018-08-01', 200, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(63, '210', '10', '2018-03-13', 'Sameer', '', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2001-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Ghulam Mustafa', '', '', '5657677766666', NULL, NULL, NULL, '', '', '', '', '', 'no', 46200, '2018-08-01', 450, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:26', '0000-00-00 00:00:00'),
(64, '3455', '3333', '2018-06-01', 'teststudent', '', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-05-31', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'father name', '03014093011', 'test', '1234567891234', '', '', '', 'father name', 'father', '03014093011', 'test', '', 'no', 150, '2018-08-01', 1000, 150, '2018-07-12', '2018-06-01', '', 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(65, '201', '1', '2017-02-28', 'Muhammad Ameer', 'Khan', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2010-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Muhammad Afzal Khan', '', '', '3310011969677', NULL, NULL, NULL, '', '', '', '', '', 'no', 3700, '2018-08-01', 800, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(66, '202', '2', '2017-02-28', 'Eezan ', 'Hashmi', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2009-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Imtiaz Hashmi', '', '', '3311052145966', NULL, NULL, NULL, '', '', '', '', '', 'no', 5400, '2018-08-01', 700, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(67, '203', '3', '2017-02-28', 'Arshman', 'Faraz', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2008-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Faraz Nadeem', '', '', '3310078007835', NULL, NULL, NULL, '', '', '', '', '', 'no', 12200, '2018-08-01', 300, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(68, '204', '4', '2017-02-28', 'Muhammad Hanzla ', 'Younas', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2016-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Muhammad Younas', '', '', '3310007635825', NULL, NULL, NULL, '', '', '', '', '', 'no', 11350, '2018-08-01', 350, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(69, '205', '5', '2017-02-28', 'Asjad', 'Sohail', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2007-01-19', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Sohail Asgar', '', '', '3310047956867', NULL, NULL, NULL, '', '', '', '', '', 'no', 13050, '2018-08-01', 250, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(70, '206', '6', '2017-02-28', 'Abdul', 'Rahman', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2008-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Shafqat Jamil', '', '', '3300021452121', NULL, NULL, NULL, '', '', '', '', '', 'no', 13900, '2018-08-01', 200, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(71, '207', '7', '2017-02-28', 'Sharyaar', 'Ahad', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2008-04-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Ahad Javaid', '', '', '3310073774305', NULL, NULL, NULL, '', '', '', '', '', 'no', 7100, '2018-08-01', 600, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(72, '208', '8', '2017-02-28', 'Abdul Mateen', 'Baig', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2005-04-12', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Babar Mughal', '', '', '3310025152165', NULL, NULL, NULL, '', '', '', '', '', 'no', 13050, '2018-08-01', 250, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(73, '209', '9', '2018-03-12', 'Faizan ', 'Ali', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2006-12-18', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Tahir Manzoor', '', '', '4545565544444', NULL, NULL, NULL, '', '', '', '', '', 'no', 13900, '2018-08-01', 200, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(74, '210', '10', '2018-03-13', 'Sameer', '', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2001-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Ghulam Mustafa', '', '', '5657677766666', NULL, NULL, NULL, '', '', '', '', '', 'no', 9650, '2018-08-01', 450, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(75, '201', '1', '2017-02-28', 'Muhammad Ameer', 'Khan', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2010-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Muhammad Afzal Khan', '', '', '3310011969677', NULL, NULL, NULL, '', '', '', '', '', 'no', 3600, '2018-08-01', 800, 0, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(76, '201', '1', '2017-02-28', 'Muhammad Ameer', 'Khan', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2010-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Muhammad Afzal Khan', '', '', '3310011969677', NULL, NULL, NULL, '', '', '', '', '', 'no', 20700, '2018-08-01', 800, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(77, '201', '1', '2017-02-28', 'Muhammad Ameer', 'Khan', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2010-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Muhammad Afzal Khan', '', '', '3310011969677', NULL, NULL, NULL, '', '', '', '', '', 'no', 20850, '2018-08-01', 800, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(78, '202', '2', '2017-02-28', 'Eezan ', 'Hashmi', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2009-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Imtiaz Hashmi', '', '', '3311052145966', NULL, NULL, NULL, '', '', '', '', '', 'no', 22550, '2018-08-01', 700, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(79, '203', '3', '2017-02-28', 'Arshman', 'Faraz', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2008-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Faraz Nadeem', '', '', '3310078007835', NULL, NULL, NULL, '', '', '', '', '', 'no', 29350, '2018-08-01', 300, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(80, '204', '4', '2017-02-28', 'Muhammad Hanzla ', 'Younas', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2016-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Muhammad Younas', '', '', '3310007635825', NULL, NULL, NULL, '', '', '', '', '', 'no', 28500, '2018-08-01', 350, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(81, '205', '5', '2017-02-28', 'Asjad', 'Sohail', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2007-01-19', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Sohail Asgar', '', '', '3310047956867', NULL, NULL, NULL, '', '', '', '', '', 'no', 30200, '2018-08-01', 250, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(82, '206', '6', '2017-02-28', 'Abdul', 'Rahman', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2008-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Shafqat Jamil', '', '', '3300021452121', NULL, NULL, NULL, '', '', '', '', '', 'no', 31050, '2018-08-01', 200, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(83, '207', '7', '2017-02-28', 'Sharyaar', 'Ahad', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2008-04-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Ahad Javaid', '', '', '3310073774305', NULL, NULL, NULL, '', '', '', '', '', 'no', 24250, '2018-08-01', 600, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(84, '208', '8', '2017-02-28', 'Abdul Mateen', 'Baig', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2005-04-12', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Babar Mughal', '', '', '3310025152165', NULL, NULL, NULL, '', '', '', '', '', 'no', 30200, '2018-08-01', 250, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(85, '209', '9', '2018-03-12', 'Faizan ', 'Ali', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2006-12-18', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Tahir Manzoor', '', '', '4545565544444', NULL, NULL, NULL, '', '', '', '', '', 'no', 31050, '2018-08-01', 200, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(86, '210', '10', '2018-03-13', 'Sameer', '', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2001-01-01', 'male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Ghulam Mustafa', '', '', '5657677766666', NULL, NULL, NULL, '', '', '', '', '', 'no', 26800, '2018-08-01', 450, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(87, '146', '', '2012-08-28', 'MUHAMMAD AYAN', '', 'No', NULL, '0308-7968991', '', NULL, NULL, NULL, 'ISLAM', '', '2010-10-10', 'Male', 'WALAH RAW STREET, PURAN PLAD, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'USMAN SATTAR', '0323-6017227', 'BUSINESS', '3320116759759', NULL, NULL, NULL, '', '', '', '', '', 'no', 5250, '2018-08-01', 800, 150, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(89, '189', '', '2012-09-25', 'M. USMAN RASHEED', '', 'No', NULL, '0301-7973476', '', NULL, NULL, NULL, 'Islam', '', '2008-10-22', 'Male', 'JAMIA ARABIA, MOH. KARAMABAD, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Muhammad Rasheed', '0334-7966676,0301-7714067', 'BUSINESS', '3320116737381', NULL, NULL, NULL, '', '', '', '', '', 'no', 35300, '2018-08-01', 450, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(90, '216', '', '2013-07-03', 'ABDUL REHMAN MUNAWAR', '', 'No', NULL, '0333-9795199', '', NULL, NULL, NULL, 'ISLAM', '', '2009-09-11', 'Male', 'HOUSE 280, GALI BAGH WALI, LAHORI GATE, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'MUNAWAR HUSAIN', '0334-6200801', 'BUSINESS', '3320117148953', NULL, NULL, NULL, '', '', '', '', '', 'no', 29350, '2018-08-01', 800, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:27', '0000-00-00 00:00:00'),
(91, '220', '', '2013-11-03', 'ABDULLAH IMRAN', '', 'No', NULL, '', '', NULL, NULL, NULL, 'ISLAM', '', '2010-10-22', 'Male', 'ST. RAFEEQ MANDAR ROAD, MOH. FATEHABAD. CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'IMRAN ELAHI', '0333-9797005', 'BUSINESS', '3320112599071', NULL, NULL, NULL, '', '', '', '', '', 'no', 31900, '2018-08-01', 650, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(92, '238', '', '1970-01-01', 'MUHAMMAD S/O MEHMOOD', '', 'No', NULL, '', '', NULL, NULL, NULL, 'Islam', '', '1970-01-01', 'Male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'MEHMOOD', '0331-7721488', '', '3039303900933', NULL, NULL, NULL, '', '', '', '', '', 'no', 34450, '2018-08-01', 500, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(93, '245', '', '1970-01-01', 'AHMAD ALI S/O M. ALI', '', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2012-07-13', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'M. ALI', '0321-7712382', '', '3320165749417', NULL, NULL, NULL, '', '', '', '', '', 'no', 25950, '2018-08-01', 1000, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(94, '248', '', '2013-04-01', 'MUZAMMIL RIAZ', '', 'No', NULL, '0322-6240800', '', NULL, NULL, NULL, '', '', '1970-01-01', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'RIAZ AHMAD', '0321-8774776', 'BUSINESS', '8738930039933', NULL, NULL, NULL, '', '', '', '', '', 'no', 39550, '2018-08-01', 200, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(96, '285', '', '2013-08-26', 'MUHAMMAD NABEEL', '', 'No', NULL, '0321-7712008', '', NULL, NULL, NULL, 'Islam', '', '2010-03-29', 'Male', 'Rahewali, House#328, Street Sehglah Chiniot', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Yousaf Basharat', '0322-7838350,0321-7914877', '', '3320140960517', NULL, NULL, NULL, '', '', '', '', '', 'no', 37850, '2018-08-01', 300, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(97, '286', '', '2013-08-27', 'MUHAMMAD RIYYAN AZAR', '', 'No', NULL, '0323-6895028', '', NULL, NULL, NULL, 'Islam', '', '2009-08-24', 'Male', 'College BookStall Near Govt.Degree College Chiniot', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Azhar Akram', '0322-7818966', 'Business', '3320116367237', NULL, NULL, NULL, '', '', '', '', '', 'no', 35640, '2018-08-01', 430, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(98, '295', '', '2013-08-31', 'M. HUSSAIN S/O ARSHAD', '', 'No', NULL, '047-6333780', '', NULL, NULL, NULL, 'Islam', '', '2010-10-10', 'Male', 'Gali Mangoan wali Mohalla Gorha. Chiniot.', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Arshad Iqbal', '0300-7719145', 'Business', '3320116635445', NULL, NULL, NULL, '', '', '', '', '', 'no', 28840, '2018-08-01', 830, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(100, '305', '', '2013-04-09', 'MUHAMMAD ZARRAR KHAN', '', 'No', NULL, '0300-7702051', '', NULL, NULL, NULL, 'Islam', '', '1970-01-01', 'Male', 'Mushki Shah, Near Ali Hospital, Chiniot', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Imran Khan', '0303-8138730,0300-7700452', 'Business', '9393039393939', NULL, NULL, NULL, '', '', '', '', '', 'no', 34450, '2018-08-01', 500, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(101, '308', '', '2013-05-09', 'HAMMAD ALI', '', 'No', NULL, '0342-1008175', '', NULL, NULL, NULL, 'Islam', '', '2009-07-15', 'Female', 'Mohallah Garah Chiniot', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Muhammad Sarwar', '0324-7134590', 'Business', '3540406542763', NULL, NULL, NULL, '', '', '', '', '', 'no', 35980, '2018-08-01', 410, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(102, '389', '', '2014-04-14', 'AHMAD MOBIN', '', 'No', NULL, '0308-7967146,0335-6629783', '', NULL, NULL, NULL, 'ISLAM', '', '2008-09-17', 'Male', 'BISMILLAH STREET, MOHALLAH USMAN ABAD, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'MUHAMMAD YOUSAF', '0333-7700975,0333-6629783', 'JOB', '3320116800031', NULL, NULL, NULL, '', '', '', '', '', 'no', 30200, '2018-08-01', 750, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(103, '396', '', '2014-05-05', 'MUHAMMAD HASSAN MALIK', '', 'No', NULL, '047-6337579', '', NULL, NULL, NULL, 'ISLAM', '', '2011-05-07', 'Male', 'STREET MALINKA WALI LAHORI  GATE CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'RASHID AHMAD', '0322-8988630,0333-8988630', 'BUSINESS', '3320168778123', NULL, NULL, NULL, '', '', '', '', '', 'no', 37850, '2018-08-01', 300, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(104, '449', '', '2014-10-10', 'HAMZA HASSAN', '', 'No', NULL, '0345-8515497', '', NULL, NULL, NULL, 'ISLAM', '', '1970-01-01', 'Male', 'KARAMABAD, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'SHAHID AHMAD', '0321-7715497', 'AGRICULTURE', '7838383838388', NULL, NULL, NULL, '', '', '', '', '', 'no', 27650, '2018-08-01', 900, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(106, '551', '', '2015-08-10', 'MUHAMMAD MUNIB UR RAHMAN', '', 'No', NULL, '', '', NULL, NULL, NULL, 'ISLAM', '', '1970-01-01', 'Male', 'MUHALLAH PORAN PALAD CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'MUHAMMAD AKRAM', '0345-8640141', 'JOB', '3320175468567', NULL, NULL, NULL, '', '', '', '', '', 'no', 36150, '2018-08-01', 400, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(107, '557', '', '2015-08-17', 'MUHAMAMD KASHIF', '', 'No', NULL, '0347-7791714', '', NULL, NULL, NULL, 'ISLAM', '', '2011-12-10', 'Male', 'VILL & P/O AHMAD ABAD, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'NAJAM NASIR', '0343-0756107,0347-7552282', 'FAYSAL BANK', '3320155745709', NULL, NULL, NULL, '', '', '', '', '', 'no', 27650, '2018-08-01', 900, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(108, '677', '', '2016-04-12', 'ABDUL HANNAN', '', 'No', NULL, '3217701874', '', NULL, NULL, NULL, 'ISLAM', '', '2011-11-01', 'Male', 'MOHALLAH GARAH CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'ALI ABID', '3007707874', 'BUSINESS', '3320190000000', NULL, NULL, NULL, '', '', '', '', '', 'no', 42950, '2018-08-01', 0, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(109, '679', '', '2016-04-29', 'MUHAMMAD DANISH', '', 'No', NULL, '0315-6187220', '', NULL, NULL, NULL, 'ISLAM', '', '2011-04-02', 'Male', 'MUHALLAH USMAN ABAD CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'MUKHTAR HUSSAIN', '3017971630', 'JOB', '3320115915477', NULL, NULL, NULL, '', '', '', '', '', 'no', 31050, '2018-08-01', 700, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(110, '815', '', '2017-03-17', 'MUHAMMAD TANZEEL', '', 'No', NULL, '', '', NULL, NULL, NULL, 'ISLAM', '', '2007-08-18', 'Male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'HAZ NAWAZ', '0346-7715538', 'FARMER', '3320158137231', NULL, NULL, NULL, '', '', '', '', '', 'no', 29350, '2018-08-01', 800, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(111, '146', '', '2012-08-28', 'MUHAMMAD AYAN', '', 'No', NULL, '0308-7968991', '', NULL, NULL, NULL, 'ISLAM', '', '2010-10-10', 'Male', 'WALAH RAW STREET, PURAN PLAD, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'USMAN SATTAR', '0323-6017227', 'BUSINESS', '3320116759759', NULL, NULL, NULL, '', '', '', '', '', 'no', 20850, '2018-08-01', 800, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(113, '189', '', '2012-09-25', 'M. USMAN RASHEED', '', 'No', NULL, '0301-7973476', '', NULL, NULL, NULL, 'Islam', '', '2008-10-22', 'Male', 'JAMIA ARABIA, MOH. KARAMABAD, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Muhammad Rasheed', '0334-7966676,0301-7714067', 'BUSINESS', '3320116737381', NULL, NULL, NULL, '', '', '', '', '', 'no', 26800, '2018-08-01', 450, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(114, '216', '', '2013-07-03', 'ABDUL REHMAN MUNAWAR', '', 'No', NULL, '0333-9795199', '', NULL, NULL, NULL, 'ISLAM', '', '2009-09-11', 'Male', 'HOUSE 280, GALI BAGH WALI, LAHORI GATE, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'MUNAWAR HUSAIN', '0334-6200801', 'BUSINESS', '3320117148953', NULL, NULL, NULL, '', '', '', '', '', 'no', 20850, '2018-08-01', 800, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(115, '220', '', '2013-11-03', 'ABDULLAH IMRAN', '', 'No', NULL, '', '', NULL, NULL, NULL, 'ISLAM', '', '2010-10-22', 'Male', 'ST. RAFEEQ MANDAR ROAD, MOH. FATEHABAD. CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'IMRAN ELAHI', '0333-9797005', 'BUSINESS', '3320112599071', NULL, NULL, NULL, '', '', '', '', '', 'no', 23400, '2018-08-01', 650, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(116, '238', '', '1970-01-01', 'MUHAMMAD S/O MEHMOOD', '', 'No', NULL, '', '', NULL, NULL, NULL, 'Islam', '', '1970-01-01', 'Male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'MEHMOOD', '0331-7721488', '', '3039303900933', NULL, NULL, NULL, '', '', '', '', '', 'no', 25950, '2018-08-01', 500, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:28', '0000-00-00 00:00:00'),
(117, '245', '', '1970-01-01', 'AHMAD ALI S/O M. ALI', '', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2012-07-13', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'M. ALI', '0321-7712382', '', '3320165749417', NULL, NULL, NULL, '', '', '', '', '', 'no', 17450, '2018-08-01', 1000, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(118, '248', '', '2013-04-01', 'MUZAMMIL RIAZ', '', 'No', NULL, '0322-6240800', '', NULL, NULL, NULL, '', '', '1970-01-01', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'RIAZ AHMAD', '0321-8774776', 'BUSINESS', '8738930039933', NULL, NULL, NULL, '', '', '', '', '', 'no', 31050, '2018-08-01', 200, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(119, '272', '', '1970-01-01', 'MUHAMMAD SAAD EJAZ', '', 'No', NULL, '0321-7911209', '', NULL, NULL, NULL, 'ISLAM', '', '1970-01-01', 'Female', '', '', '', '', '', '', '', '', 'father', 'Ejaz Ahmad', '0321-6688146', 'Director', '8373837383999', '', '', '', 'Ejaz Ahmad', 'Father', '0321-6688146', 'Director', '', 'no', 23800, '2018-08-01', 500, 300, '2018-07-12', '2018-01-01', '', 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(120, '285', '', '2013-08-26', 'MUHAMMAD NABEEL', '', 'No', NULL, '0321-7712008', '', NULL, NULL, NULL, 'Islam', '', '2010-03-29', 'Male', 'Rahewali, House#328, Street Sehglah Chiniot', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Yousaf Basharat', '0322-7838350,0321-7914877', '', '3320140960517', NULL, NULL, NULL, '', '', '', '', '', 'no', 29350, '2018-08-01', 300, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(121, '286', '', '2013-08-27', 'MUHAMMAD RIYYAN AZAR', '', 'No', NULL, '0323-6895028', '', NULL, NULL, NULL, 'Islam', '', '2009-08-24', 'Male', 'College BookStall Near Govt.Degree College Chiniot', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Azhar Akram', '0322-7818966', 'Business', '3320116367237', NULL, NULL, NULL, '', '', '', '', '', 'no', 27140, '2018-08-01', 430, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(122, '295', '', '2013-08-31', 'M. HUSSAIN S/O ARSHAD', '', 'No', NULL, '047-6333780', '', NULL, NULL, NULL, 'Islam', '', '2010-10-10', 'Male', 'Gali Mangoan wali Mohalla Gorha. Chiniot.', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Arshad Iqbal', '0300-7719145', 'Business', '3320116635445', NULL, NULL, NULL, '', '', '', '', '', 'no', 20340, '2018-08-01', 830, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(123, '301', '', '2013-02-09', 'MUHAMMAD AYYAN NASEER', '', 'No', NULL, '0314-6902702', '', NULL, NULL, NULL, 'Islam', '', '2009-11-15', 'Male', 'Mohalla Usman Abad Chiniot', '', '', '', '', '', '', '', 'father', 'Hamyun Nasir', '0300-7709053', '', '3320116083222', '', '', '', 'Hamyun Nasir', 'Father', '0300-7709053', '', '', 'no', 23800, '2018-08-01', 500, 300, '2018-07-12', '2018-01-01', '', 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(124, '305', '', '2013-04-09', 'MUHAMMAD ZARRAR KHAN', '', 'No', NULL, '0300-7702051', '', NULL, NULL, NULL, 'Islam', '', '1970-01-01', 'Male', 'Mushki Shah, Near Ali Hospital, Chiniot', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Imran Khan', '0303-8138730,0300-7700452', 'Business', '9393039393939', NULL, NULL, NULL, '', '', '', '', '', 'no', 25950, '2018-08-01', 500, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(125, '308', '', '2013-05-09', 'HAMMAD ALI', '', 'No', NULL, '0342-1008175', '', NULL, NULL, NULL, 'Islam', '', '2009-07-15', 'Female', 'Mohallah Garah Chiniot', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Muhammad Sarwar', '0324-7134590', 'Business', '3540406542763', NULL, NULL, NULL, '', '', '', '', '', 'no', 27480, '2018-08-01', 410, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(126, '389', '', '2014-04-14', 'AHMAD MOBIN', '', 'No', NULL, '0308-7967146,0335-6629783', '', NULL, NULL, NULL, 'ISLAM', '', '2008-09-17', 'Male', 'BISMILLAH STREET, MOHALLAH USMAN ABAD, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'MUHAMMAD YOUSAF', '0333-7700975,0333-6629783', 'JOB', '3320116800031', NULL, NULL, NULL, '', '', '', '', '', 'no', 21700, '2018-08-01', 750, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(127, '396', '', '2014-05-05', 'MUHAMMAD HASSAN MALIK', '', 'No', NULL, '047-6337579', '', NULL, NULL, NULL, 'ISLAM', '', '2011-05-07', 'Male', 'STREET MALINKA WALI LAHORI  GATE CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'RASHID AHMAD', '0322-8988630,0333-8988630', 'BUSINESS', '3320168778123', NULL, NULL, NULL, '', '', '', '', '', 'no', 29350, '2018-08-01', 300, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(128, '449', '', '2014-10-10', 'HAMZA HASSAN', '', 'No', NULL, '0345-8515497', '', NULL, NULL, NULL, 'ISLAM', '', '1970-01-01', 'Male', 'KARAMABAD, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'SHAHID AHMAD', '0321-7715497', 'AGRICULTURE', '7838383838388', NULL, NULL, NULL, '', '', '', '', '', 'no', 19150, '2018-08-01', 900, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00');
INSERT INTO `students` (`id`, `admission_no`, `roll_no`, `admission_date`, `firstname`, `lastname`, `rte`, `image`, `mobileno`, `email`, `state`, `city`, `pincode`, `religion`, `cast`, `dob`, `gender`, `current_address`, `permanent_address`, `category_id`, `adhar_no`, `samagra_id`, `bank_account_no`, `bank_name`, `ifsc_code`, `guardian_is`, `father_name`, `father_phone`, `father_occupation`, `father_cnic`, `mother_name`, `mother_phone`, `mother_occupation`, `guardian_name`, `guardian_relation`, `guardian_phone`, `guardian_occupation`, `guardian_address`, `is_active`, `fee_arrears`, `fee_update_date`, `discount`, `late_payment_fee`, `late_payment_fee_update_date`, `fee_starting_date`, `previous_school`, `struck_off`, `created_at`, `updated_at`) VALUES
(129, '505', '', '2015-04-03', 'ABDUR UR REHMAN FARMAN', '', 'No', NULL, '0321-7701522', '', NULL, NULL, NULL, 'ISLAM', '', '2010-12-28', 'Male', 'MOH. HAJI ABAD, ST.#2, NEAR EXCISE OFFICE, CHINIOT', '', '', '', '', '', '', '', 'father', 'FARMAN ALI', '0321-7707622,0315-0072215', 'GOVT. JOB', '3320178043833', '', '', '', 'FARMAN ALI', 'Father', '0321-7707622,0315-0072215', 'GOVT. JOB', '', 'no', 23800, '2018-08-01', 500, 300, '2018-07-12', '2018-01-01', '', 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(130, '551', '', '2015-08-10', 'MUHAMMAD MUNIB UR RAHMAN', '', 'No', NULL, '', '', NULL, NULL, NULL, 'ISLAM', '', '1970-01-01', 'Male', 'MUHALLAH PORAN PALAD CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'MUHAMMAD AKRAM', '0345-8640141', 'JOB', '3320175468567', NULL, NULL, NULL, '', '', '', '', '', 'no', 27650, '2018-08-01', 400, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(131, '557', '', '2015-08-17', 'MUHAMAMD KASHIF', '', 'No', NULL, '0347-7791714', '', NULL, NULL, NULL, 'ISLAM', '', '2011-12-10', 'Male', 'VILL & P/O AHMAD ABAD, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'NAJAM NASIR', '0343-0756107,0347-7552282', 'FAYSAL BANK', '3320155745709', NULL, NULL, NULL, '', '', '', '', '', 'no', 19150, '2018-08-01', 900, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(132, '677', '', '2016-04-12', 'ABDUL HANNAN', '', 'No', NULL, '3217701874', '', NULL, NULL, NULL, 'ISLAM', '', '2011-11-01', 'Male', 'MOHALLAH GARAH CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'ALI ABID', '3007707874', 'BUSINESS', '3320190000000', NULL, NULL, NULL, '', '', '', '', '', 'no', 34450, '2018-08-01', 0, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(133, '679', '', '2016-04-29', 'MUHAMMAD DANISH', '', 'No', NULL, '0315-6187220', '', NULL, NULL, NULL, 'ISLAM', '', '2011-04-02', 'Male', 'MUHALLAH USMAN ABAD CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'MUKHTAR HUSSAIN', '3017971630', 'JOB', '3320115915477', NULL, NULL, NULL, '', '', '', '', '', 'no', 22550, '2018-08-01', 700, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(134, '815', '', '2017-03-17', 'MUHAMMAD TANZEEL', '', 'No', NULL, '', '', NULL, NULL, NULL, 'ISLAM', '', '2007-08-18', 'Male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'HAZ NAWAZ', '0346-7715538', 'FARMER', '3320158137231', NULL, NULL, NULL, '', '', '', '', '', 'no', 20850, '2018-08-01', 800, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(135, '545545', '65465', '2018-06-03', 'stujrkjktls', '', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-06-21', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'father name', '03014093011', 'test', '1234567891234', '', '', '', 'father name', 'father', '03014093011', 'test', '', 'no', 42300, '2018-08-01', 0, 300, '2018-08-11', '2018-06-01', '', 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(136, '565465', '5665', '2018-06-03', 'fhfhfggh', '', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-06-08', 'Female', '', '', NULL, '', '', '', '', '', 'father', 'father name', '03014093011', 'test', '1234567891234', '', '', '', 'father name', 'father', '03014093011', 'test', '', 'no', 40800, '2018-08-01', 0, 300, '2018-08-11', '2018-06-01', '', 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(137, '6546546', '6546', '2018-06-03', 'teststudent', '', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-06-21', 'Female', '', '', NULL, '', '', '', '', '', 'father', 'father name', '03014093011', 'test', '1234567891234', '', '', '', 'father name', 'father', '03014093011', 'test', '', 'no', 43800, '2018-08-01', 0, 300, '2018-08-11', '2018-06-01', '', 0, '2018-08-28 11:34:29', '0000-00-00 00:00:00'),
(138, '146', '', '2012-08-28', 'MUHAMMAD AYAN', '', 'No', NULL, '0308-7968991', '', NULL, NULL, NULL, 'ISLAM', '', '2010-10-10', 'Male', 'WALAH RAW STREET, PURAN PLAD, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'USMAN SATTAR', '0323-6017227', 'BUSINESS', '3320116759759', NULL, NULL, NULL, '', '', '', '', '', 'no', 10500, '2018-08-01', 800, 300, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(139, '164', '', '2012-09-03', 'ABDUL REHMAN S/O ANAYAT', '', 'No', NULL, '0345-7911006', '', NULL, NULL, NULL, 'ISLAM', '', '2009-07-30', 'Male', 'MISHKI SHAH, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'HAJI ANAYAT', '0324-7640082', 'BUSINESS', '3838893839333', NULL, NULL, NULL, '', '', '', '', '', 'no', 5420, '2018-08-01', 780, 300, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(140, '189', '', '2012-09-25', 'M. USMAN RASHEED', '', 'No', NULL, '0301-7973476', '', NULL, NULL, NULL, 'Islam', '', '2008-10-22', 'Male', 'JAMIA ARABIA, MOH. KARAMABAD, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Muhammad Rasheed', '0334-7966676,0301-7714067', 'BUSINESS', '3320116737381', NULL, NULL, NULL, '', '', '', '', '', 'no', 35300, '2018-08-01', 450, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(141, '216', '', '2013-07-03', 'ABDUL REHMAN MUNAWAR', '', 'No', NULL, '0333-9795199', '', NULL, NULL, NULL, 'ISLAM', '', '2009-09-11', 'Male', 'HOUSE 280, GALI BAGH WALI, LAHORI GATE, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'MUNAWAR HUSAIN', '0334-6200801', 'BUSINESS', '3320117148953', NULL, NULL, NULL, '', '', '', '', '', 'no', 29350, '2018-08-01', 800, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(142, '220', '', '2013-11-03', 'ABDULLAH IMRAN', '', 'No', NULL, '', '', NULL, NULL, NULL, 'ISLAM', '', '2010-10-22', 'Male', 'ST. RAFEEQ MANDAR ROAD, MOH. FATEHABAD. CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'IMRAN ELAHI', '0333-9797005', 'BUSINESS', '3320112599071', NULL, NULL, NULL, '', '', '', '', '', 'no', 31900, '2018-08-01', 650, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(143, '238', '', '1970-01-01', 'MUHAMMAD S/O MEHMOOD', '', 'No', NULL, '', '', NULL, NULL, NULL, 'Islam', '', '1970-01-01', 'Male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'MEHMOOD', '0331-7721488', '', '3039303900933', NULL, NULL, NULL, '', '', '', '', '', 'no', 34450, '2018-08-01', 500, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(144, '245', '', '1970-01-01', 'AHMAD ALI S/O M. ALI', '', 'No', NULL, '', '', NULL, NULL, NULL, '', '', '2012-07-13', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'M. ALI', '0321-7712382', '', '3320165749417', NULL, NULL, NULL, '', '', '', '', '', 'no', 25950, '2018-08-01', 1000, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(145, '248', '', '2013-04-01', 'MUZAMMIL RIAZ', '', 'No', NULL, '0322-6240800', '', NULL, NULL, NULL, '', '', '1970-01-01', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'RIAZ AHMAD', '0321-8774776', 'BUSINESS', '8738930039933', NULL, NULL, NULL, '', '', '', '', '', 'no', 39550, '2018-08-01', 200, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(146, '272', '', '1970-01-01', 'MUHAMMAD SAAD EJAZ', '', 'No', NULL, '0321-7911209', '', NULL, NULL, NULL, 'ISLAM', '', '1970-01-01', 'Female', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Ejaz Ahmad', '0321-6688146', 'Director', '8373837383999', NULL, NULL, NULL, '', '', '', '', '', 'no', 300, '2018-08-01', 2500, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(147, '285', '', '2013-08-26', 'MUHAMMAD NABEEL', '', 'No', NULL, '0321-7712008', '', NULL, NULL, NULL, 'Islam', '', '2010-03-29', 'Male', 'Rahewali, House#328, Street Sehglah Chiniot', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Yousaf Basharat', '0322-7838350,0321-7914877', '', '3320140960517', NULL, NULL, NULL, '', '', '', '', '', 'no', 37850, '2018-08-01', 300, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(148, '286', '', '2013-08-27', 'MUHAMMAD RIYYAN AZAR', '', 'No', NULL, '0323-6895028', '', NULL, NULL, NULL, 'Islam', '', '2009-08-24', 'Male', 'College BookStall Near Govt.Degree College Chiniot', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Azhar Akram', '0322-7818966', 'Business', '3320116367237', NULL, NULL, NULL, '', '', '', '', '', 'no', 35640, '2018-08-01', 430, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(149, '295', '', '2013-08-31', 'M. HUSSAIN S/O ARSHAD', '', 'No', NULL, '047-6333780', '', NULL, NULL, NULL, 'Islam', '', '2010-10-10', 'Male', 'Gali Mangoan wali Mohalla Gorha. Chiniot.', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Arshad Iqbal', '0300-7719145', 'Business', '3320116635445', NULL, NULL, NULL, '', '', '', '', '', 'no', 28840, '2018-08-01', 830, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(150, '301', '', '2013-02-09', 'MUHAMMAD AYYAN NASEER', '', 'No', NULL, '0314-6902702', '', NULL, NULL, NULL, 'Islam', '', '2009-11-15', 'Male', 'Mohalla Usman Abad Chiniot', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Hamyun Nasir', '0300-7709053', '', '3320116083222', NULL, NULL, NULL, '', '', '', '', '', 'no', 300, '2018-08-01', 2500, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(151, '305', '', '2013-04-09', 'MUHAMMAD ZARRAR KHAN', '', 'No', NULL, '0300-7702051', '', NULL, NULL, NULL, 'Islam', '', '1970-01-01', 'Male', 'Mushki Shah, Near Ali Hospital, Chiniot', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Imran Khan', '0303-8138730,0300-7700452', 'Business', '9393039393939', NULL, NULL, NULL, '', '', '', '', '', 'no', 34450, '2018-08-01', 500, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(152, '308', '', '2013-05-09', 'HAMMAD ALI', '', 'No', NULL, '0342-1008175', '', NULL, NULL, NULL, 'Islam', '', '2009-07-15', 'Female', 'Mohallah Garah Chiniot', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Muhammad Sarwar', '0324-7134590', 'Business', '3540406542763', NULL, NULL, NULL, '', '', '', '', '', 'no', 35980, '2018-08-01', 410, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(153, '389', '', '2014-04-14', 'AHMAD MOBIN', '', 'No', NULL, '0308-7967146,0335-6629783', '', NULL, NULL, NULL, 'ISLAM', '', '2008-09-17', 'Male', 'BISMILLAH STREET, MOHALLAH USMAN ABAD, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'MUHAMMAD YOUSAF', '0333-7700975,0333-6629783', 'JOB', '3320116800031', NULL, NULL, NULL, '', '', '', '', '', 'no', 30200, '2018-08-01', 750, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(154, '396', '', '2014-05-05', 'MUHAMMAD HASSAN MALIK', '', 'No', NULL, '047-6337579', '', NULL, NULL, NULL, 'ISLAM', '', '2011-05-07', 'Male', 'STREET MALINKA WALI LAHORI  GATE CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'RASHID AHMAD', '0322-8988630,0333-8988630', 'BUSINESS', '3320168778123', NULL, NULL, NULL, '', '', '', '', '', 'no', 37850, '2018-08-01', 300, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(155, '449', '', '2014-10-10', 'HAMZA HASSAN', '', 'No', NULL, '0345-8515497', '', NULL, NULL, NULL, 'ISLAM', '', '1970-01-01', 'Male', 'KARAMABAD, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'SHAHID AHMAD', '0321-7715497', 'AGRICULTURE', '7838383838388', NULL, NULL, NULL, '', '', '', '', '', 'no', 27650, '2018-08-01', 900, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(156, '505', '', '2015-04-03', 'ABDUR UR REHMAN FARMAN', '', 'No', NULL, '0321-7701522', '', NULL, NULL, NULL, 'ISLAM', '', '2010-12-28', 'Male', 'MOH. HAJI ABAD, ST.#2, NEAR EXCISE OFFICE, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'FARMAN ALI', '0321-7707622,0315-0072215', 'GOVT. JOB', '3320178043833', NULL, NULL, NULL, '', '', '', '', '', 'no', 300, '2018-08-01', 2500, 300, '2018-07-12', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(157, '551', '', '2015-08-10', 'MUHAMMAD MUNIB UR RAHMAN', '', 'No', NULL, '', '', NULL, NULL, NULL, 'ISLAM', '', '1970-01-01', 'Male', 'MUHALLAH PORAN PALAD CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'MUHAMMAD AKRAM', '0345-8640141', 'JOB', '3320175468567', NULL, NULL, NULL, '', '', '', '', '', 'no', 36150, '2018-08-01', 400, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(158, '557', '', '2015-08-17', 'MUHAMAMD KASHIF', '', 'No', NULL, '0347-7791714', '', NULL, NULL, NULL, 'ISLAM', '', '2011-12-10', 'Male', 'VILL & P/O AHMAD ABAD, CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'NAJAM NASIR', '0343-0756107,0347-7552282', 'FAYSAL BANK', '3320155745709', NULL, NULL, NULL, '', '', '', '', '', 'no', 27650, '2018-08-01', 900, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(159, '677', '', '2016-04-12', 'ABDUL HANNAN', '', 'No', NULL, '3217701874', '', NULL, NULL, NULL, 'ISLAM', '', '2011-11-01', 'Male', 'MOHALLAH GARAH CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'ALI ABID', '3007707874', 'BUSINESS', '3320190000000', NULL, NULL, NULL, '', '', '', '', '', 'no', 42950, '2018-08-01', 0, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(160, '679', '', '2016-04-29', 'MUHAMMAD DANISH', '', 'No', NULL, '0315-6187220', '', NULL, NULL, NULL, 'ISLAM', '', '2011-04-02', 'Male', 'MUHALLAH USMAN ABAD CHINIOT', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'MUKHTAR HUSSAIN', '3017971630', 'JOB', '3320115915477', NULL, NULL, NULL, '', '', '', '', '', 'no', 31050, '2018-08-01', 700, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(161, '815', '', '2017-03-17', 'MUHAMMAD TANZEEL', '', 'No', NULL, '', '', NULL, NULL, NULL, 'ISLAM', '', '2007-08-18', 'Male', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 'HAZ NAWAZ', '0346-7715538', 'FARMER', '3320158137231', NULL, NULL, NULL, '', '', '', '', '', 'no', 29350, '2018-08-01', 800, 450, '2018-08-11', NULL, NULL, 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(162, '816', '816', '2018-08-10', 'arfan', 'arshad', 'No', 'uploads/student_images/no_image.png', '09937465746', 'aftab@demo.pk', NULL, NULL, NULL, '', '', '1970-01-01', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'tgestff', '09937465746', '', '1374857684956', '', '', '', 'tgestff', 'father', '09937465746', '', 'House no 37 meherblock faze4 green town millatroad faisalabadsdsds', 'no', 400, '2018-08-01', 0, 0, '2018-08-31', '2018-08-01', '', 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(163, '817', '817', '2018-08-10', 'khuram', 'shehzad', 'No', 'uploads/student_images/no_image.png', '09937465746', 'aftab@demo.pk', NULL, NULL, NULL, '', '', '1970-01-01', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'tgestff', '09937465746', '', '1374857684956', '', '', '', 'tgestff', 'father', '09937465746', '', 'House no 37 meherblock faze4 green town millatroad faisalabadsdsds', 'no', 4000, '2018-08-01', 0, 0, '2018-08-31', '2018-08-01', '', 0, '2018-08-28 11:34:30', '0000-00-00 00:00:00'),
(164, '818', '18', '2018-09-01', 'testttt', 'fff', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '1970-01-01', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'tgestff', '09937465746', '', '1374857684956', '', '', '', 'tgestff', 'father', '09937465746', '', '', 'no', 0, '2018-05-01', 1000, 0, '2018-09-30', '2018-09-01', '', 0, '2018-08-28 11:34:18', '0000-00-00 00:00:00'),
(165, '819', '819', '2018-08-15', 'adnan', 'arshad', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '1970-01-01', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'tgestff', '09937465746', '', '1374857684956', '', '', '', 'tgestff', 'father', '09937465746', '', '', 'no', 0, '2018-08-01', 1000, 0, '2018-08-31', '2018-08-01', '', 0, '2018-08-15 05:58:30', '0000-00-00 00:00:00'),
(166, '820', '820', '2018-08-17', 'usman', 'arshad', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '1970-01-01', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'tgestff', '09937465746', '', '1374857684956', '', '', '', 'tgestff', 'father', '09937465746', '', '', 'no', 1000, '2018-08-01', 0, 0, '2018-08-31', '2018-08-01', '', 0, '2018-08-17 06:42:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_advance`
--

CREATE TABLE `student_advance` (
  `id` int(30) NOT NULL,
  `class_id` int(35) NOT NULL,
  `section_id` int(40) NOT NULL,
  `student_id` int(35) NOT NULL,
  `advance_fee` int(50) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_advance`
--

INSERT INTO `student_advance` (`id`, `class_id`, `section_id`, `student_id`, `advance_fee`, `created_at`) VALUES
(5, 11, 1, 87, 1700, '2018-07-01'),
(6, 7, 1, 29, 2000, '2018-08-01'),
(7, 11, 1, 87, 1700, '2018-08-01'),
(8, 11, 1, 88, 3440, '2018-08-01'),
(9, 7, 1, 29, 1000, '2018-06-01'),
(10, 7, 1, 29, 1000, '2018-06-01'),
(11, 11, 1, 88, 1720, '2018-06-01'),
(12, 11, 1, 88, 1720, '2018-06-01'),
(13, 1, 1, 1, 1000, '2018-09-01'),
(14, 1, 1, 2, 1000, '2018-09-01'),
(15, 2, 1, 10, 1250, '2018-09-01'),
(16, 4, 1, 16, 700, '2018-09-01'),
(17, 7, 1, 29, 1000, '2018-09-01'),
(18, 1, 1, 1, 1000, '2018-10-01'),
(19, 1, 1, 2, 1000, '2018-10-01'),
(20, 7, 1, 29, 1000, '2018-10-01');

-- --------------------------------------------------------

--
-- Table structure for table `student_assessments`
--

CREATE TABLE `student_assessments` (
  `id` int(11) NOT NULL,
  `cleanliness` tinyint(4) NOT NULL,
  `classroom_behaviour` tinyint(4) NOT NULL,
  `homework` tinyint(4) NOT NULL,
  `urdu_reading` tinyint(4) NOT NULL,
  `english_reading` tinyint(4) NOT NULL,
  `assessment_date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `student_assessments`
--

INSERT INTO `student_assessments` (`id`, `cleanliness`, `classroom_behaviour`, `homework`, `urdu_reading`, `english_reading`, `assessment_date`) VALUES
(3, 3, 2, 1, 3, 2, '2017-11-04');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendences`
--

CREATE TABLE `student_attendences` (
  `id` int(11) NOT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `attendence_type_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_attendences`
--

INSERT INTO `student_attendences` (`id`, `student_session_id`, `date`, `attendence_type_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, '2017-10-18', 1, 'no', '2017-10-20 17:47:26', '0000-00-00 00:00:00'),
(2, 3, '2017-10-18', 2, 'no', '2017-10-20 17:47:27', '0000-00-00 00:00:00'),
(3, 4, '2017-10-18', 4, 'no', '2017-10-22 11:12:14', '0000-00-00 00:00:00'),
(4, 2, '2017-12-05', 1, 'no', '2017-12-05 06:27:18', '0000-00-00 00:00:00'),
(5, 3, '2017-12-05', 1, 'no', '2017-12-05 06:27:18', '0000-00-00 00:00:00'),
(6, 4, '2017-12-05', 1, 'no', '2017-12-05 06:27:18', '0000-00-00 00:00:00'),
(7, 6, '2017-12-05', 1, 'no', '2017-12-05 06:27:18', '0000-00-00 00:00:00'),
(8, 2, '2018-03-13', 4, 'no', '2018-03-13 13:19:11', '0000-00-00 00:00:00'),
(9, 3, '2018-03-13', 4, 'no', '2018-03-13 13:19:11', '0000-00-00 00:00:00'),
(10, 4, '2018-03-13', 1, 'no', '2018-03-13 13:18:59', '0000-00-00 00:00:00'),
(11, 6, '2018-03-13', 1, 'no', '2018-03-13 12:04:31', '0000-00-00 00:00:00'),
(12, 7, '2018-03-13', 1, 'no', '2018-03-13 12:04:31', '0000-00-00 00:00:00'),
(13, 8, '2018-03-13', 1, 'no', '2018-03-13 12:04:31', '0000-00-00 00:00:00'),
(14, 9, '2018-03-13', 1, 'no', '2018-03-13 12:04:31', '0000-00-00 00:00:00'),
(15, 10, '2018-03-13', 1, 'no', '2018-03-13 12:04:31', '0000-00-00 00:00:00'),
(16, 12, '2018-03-13', 1, 'no', '2018-03-13 12:04:31', '0000-00-00 00:00:00'),
(17, 13, '2018-03-13', 1, 'no', '2018-03-13 12:04:31', '0000-00-00 00:00:00'),
(18, 14, '2018-03-13', 1, 'no', '2018-03-13 12:04:31', '0000-00-00 00:00:00'),
(19, 15, '2018-03-13', 1, 'no', '2018-03-13 12:04:31', '0000-00-00 00:00:00'),
(20, 19, '2018-03-13', 1, 'no', '2018-03-13 12:04:31', '0000-00-00 00:00:00'),
(21, 20, '2018-03-13', 1, 'no', '2018-03-13 12:04:31', '0000-00-00 00:00:00'),
(22, 21, '2018-03-13', 1, 'no', '2018-03-13 12:04:31', '0000-00-00 00:00:00'),
(23, 16, '2018-03-13', 1, 'no', '2018-03-13 12:25:37', '0000-00-00 00:00:00'),
(24, 17, '2018-03-13', 4, 'no', '2018-03-13 13:19:25', '0000-00-00 00:00:00'),
(25, 2, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(26, 3, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(27, 6, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(28, 7, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(29, 8, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(30, 9, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(31, 10, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(32, 11, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(33, 12, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(34, 13, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(35, 14, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(36, 15, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(37, 16, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(38, 17, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(39, 18, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(40, 19, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(41, 20, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(42, 21, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(43, 23, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(44, 24, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(45, 25, '2018-04-03', 1, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(46, 4, '2018-04-03', 4, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(47, 22, '2018-04-03', 4, 'yes', '2018-04-03 08:11:49', '2018-04-02 19:00:00'),
(48, 2, '2018-04-04', 1, 'no', '2018-04-04 10:02:27', '0000-00-00 00:00:00'),
(49, 3, '2018-04-04', 1, 'no', '2018-04-04 10:02:27', '0000-00-00 00:00:00'),
(50, 4, '2018-04-04', 1, 'no', '2018-04-04 10:02:27', '0000-00-00 00:00:00'),
(51, 6, '2018-04-04', 1, 'no', '2018-04-04 10:02:27', '0000-00-00 00:00:00'),
(52, 7, '2018-04-04', 1, 'no', '2018-04-04 10:02:27', '0000-00-00 00:00:00'),
(53, 8, '2018-04-04', 1, 'no', '2018-04-04 10:02:27', '0000-00-00 00:00:00'),
(54, 9, '2018-04-04', 1, 'no', '2018-04-04 10:02:27', '0000-00-00 00:00:00'),
(55, 10, '2018-04-04', 1, 'no', '2018-04-04 10:02:27', '0000-00-00 00:00:00'),
(56, 12, '2018-04-04', 1, 'no', '2018-04-04 10:02:27', '0000-00-00 00:00:00'),
(57, 13, '2018-04-04', 1, 'no', '2018-04-04 10:02:27', '0000-00-00 00:00:00'),
(58, 14, '2018-04-04', 1, 'no', '2018-04-04 10:02:28', '0000-00-00 00:00:00'),
(59, 15, '2018-04-04', 1, 'no', '2018-04-04 10:02:28', '0000-00-00 00:00:00'),
(60, 19, '2018-04-04', 1, 'no', '2018-04-04 10:02:28', '0000-00-00 00:00:00'),
(61, 20, '2018-04-04', 1, 'no', '2018-04-04 10:02:28', '0000-00-00 00:00:00'),
(62, 21, '2018-04-04', 1, 'no', '2018-04-04 10:02:28', '0000-00-00 00:00:00'),
(63, 2, '2018-04-05', 4, 'no', '2018-04-05 07:17:09', '0000-00-00 00:00:00'),
(64, 3, '2018-04-05', 4, 'no', '2018-04-05 07:17:09', '0000-00-00 00:00:00'),
(65, 4, '2018-04-05', 4, 'no', '2018-04-05 07:17:09', '0000-00-00 00:00:00'),
(66, 6, '2018-04-05', 4, 'no', '2018-04-05 07:17:09', '0000-00-00 00:00:00'),
(67, 7, '2018-04-05', 4, 'no', '2018-04-05 07:17:09', '0000-00-00 00:00:00'),
(68, 8, '2018-04-05', 4, 'no', '2018-04-05 07:17:09', '0000-00-00 00:00:00'),
(69, 9, '2018-04-05', 4, 'no', '2018-04-05 07:17:09', '0000-00-00 00:00:00'),
(70, 10, '2018-04-05', 1, 'no', '2018-04-05 07:17:09', '0000-00-00 00:00:00'),
(71, 12, '2018-04-05', 1, 'no', '2018-04-05 07:17:09', '0000-00-00 00:00:00'),
(72, 13, '2018-04-05', 4, 'no', '2018-04-05 07:17:09', '0000-00-00 00:00:00'),
(73, 14, '2018-04-05', 4, 'no', '2018-04-05 07:17:09', '0000-00-00 00:00:00'),
(74, 15, '2018-04-05', 4, 'no', '2018-04-05 07:17:09', '0000-00-00 00:00:00'),
(75, 19, '2018-04-05', 4, 'no', '2018-04-05 07:17:09', '0000-00-00 00:00:00'),
(76, 20, '2018-04-05', 4, 'no', '2018-04-05 07:17:09', '0000-00-00 00:00:00'),
(77, 21, '2018-04-05', 4, 'no', '2018-04-05 07:17:09', '0000-00-00 00:00:00'),
(78, 2, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(79, 4, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(80, 6, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(81, 7, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(82, 8, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(83, 9, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(84, 10, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(85, 12, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(86, 13, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(87, 14, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(88, 15, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(89, 19, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(90, 20, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(91, 21, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(92, 26, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(93, 27, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(94, 28, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(95, 66, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(96, 67, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(97, 68, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(98, 69, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(99, 70, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(100, 71, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(101, 72, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(102, 73, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(103, 74, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(104, 75, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(105, 164, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(106, 167, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(107, 11, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(108, 29, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(109, 34, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(110, 76, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(111, 77, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(112, 78, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(113, 79, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(114, 80, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(115, 81, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(116, 82, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(117, 83, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(118, 84, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(119, 85, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(120, 86, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(121, 87, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(122, 18, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(123, 23, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(124, 24, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(125, 136, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(126, 137, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(127, 138, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(128, 16, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(129, 17, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(130, 22, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(131, 25, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(132, 163, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(133, 30, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(134, 31, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(135, 165, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(136, 166, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(137, 32, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(138, 33, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(139, 65, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(140, 35, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(141, 36, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(142, 37, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(143, 38, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(144, 39, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(145, 40, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(146, 41, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(147, 42, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(148, 43, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(149, 44, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(150, 112, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(151, 114, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(152, 115, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(153, 116, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(154, 117, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(155, 118, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(156, 119, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(157, 120, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(158, 121, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(159, 122, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(160, 123, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(161, 124, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(162, 125, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(163, 126, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(164, 127, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(165, 128, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(166, 129, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(167, 130, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(168, 131, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(169, 132, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(170, 133, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(171, 134, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(172, 135, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(173, 45, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(174, 46, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(175, 47, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(176, 48, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(177, 49, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(178, 50, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(179, 51, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(180, 52, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(181, 53, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(182, 54, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(183, 55, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(184, 56, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(185, 57, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(186, 58, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(187, 59, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(188, 60, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(189, 61, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(190, 62, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(191, 63, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(192, 64, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(193, 88, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(194, 90, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(195, 91, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(196, 92, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(197, 93, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(198, 94, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(199, 95, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(200, 97, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(201, 98, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(202, 99, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(203, 101, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(204, 102, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(205, 103, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(206, 104, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(207, 105, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(208, 107, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(209, 108, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(210, 109, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(211, 110, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(212, 111, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(213, 139, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(214, 140, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(215, 141, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(216, 142, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(217, 143, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(218, 144, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(219, 145, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(220, 146, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(221, 147, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(222, 148, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(223, 149, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(224, 150, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(225, 151, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(226, 152, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(227, 153, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(228, 154, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(229, 155, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(230, 156, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(231, 157, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(232, 158, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(233, 159, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(234, 160, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(235, 161, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(236, 162, '2018-08-21', 1, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(237, 3, '2018-08-21', 4, 'yes', '2018-08-20 19:00:00', '2018-08-20 19:00:00'),
(238, 2, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(239, 4, '2018-08-25', 3, 'yes', '2018-08-25 09:41:38', '2018-08-24 19:00:00'),
(240, 6, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(241, 7, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(242, 8, '2018-08-25', 3, 'yes', '2018-08-25 09:41:38', '2018-08-24 19:00:00'),
(243, 9, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(244, 10, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(245, 12, '2018-08-25', 3, 'yes', '2018-08-25 09:41:38', '2018-08-24 19:00:00'),
(246, 13, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(247, 14, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(248, 15, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(249, 19, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(250, 20, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(251, 21, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(252, 26, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(253, 27, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(254, 28, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(255, 66, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(256, 67, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(257, 68, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(258, 69, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(259, 70, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(260, 71, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(261, 72, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(262, 73, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(263, 74, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(264, 75, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(265, 164, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(266, 167, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(267, 11, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(268, 29, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(269, 34, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(270, 76, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(271, 77, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(272, 78, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(273, 79, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(274, 80, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(275, 81, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(276, 82, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(277, 83, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(278, 84, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(279, 85, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(280, 86, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(281, 87, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(282, 18, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(283, 23, '2018-08-25', 4, 'yes', '2018-08-25 09:41:56', '2018-08-24 19:00:00'),
(284, 24, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(285, 136, '2018-08-25', 4, 'yes', '2018-08-25 09:41:56', '2018-08-24 19:00:00'),
(286, 137, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(287, 138, '2018-08-25', 4, 'yes', '2018-08-25 09:41:56', '2018-08-24 19:00:00'),
(288, 16, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(289, 17, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(290, 22, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(291, 25, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(292, 163, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(293, 30, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(294, 31, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(295, 165, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(296, 166, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(297, 32, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(298, 33, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(299, 65, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(300, 35, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(301, 36, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(302, 37, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(303, 38, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(304, 39, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(305, 40, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(306, 41, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(307, 42, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(308, 43, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(309, 44, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(310, 112, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(311, 114, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(312, 115, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(313, 116, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(314, 117, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(315, 118, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(316, 119, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(317, 120, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(318, 121, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(319, 122, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(320, 123, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(321, 124, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(322, 125, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(323, 126, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(324, 127, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(325, 128, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(326, 129, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(327, 130, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(328, 131, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(329, 132, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(330, 133, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(331, 134, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(332, 135, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(333, 45, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(334, 46, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(335, 47, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(336, 48, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(337, 49, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(338, 50, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(339, 51, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(340, 52, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(341, 53, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(342, 54, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(343, 55, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(344, 56, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(345, 57, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(346, 58, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(347, 59, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(348, 60, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(349, 61, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(350, 62, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(351, 63, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(352, 64, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(353, 88, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(354, 90, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(355, 91, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(356, 92, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(357, 93, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(358, 94, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(359, 95, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(360, 97, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(361, 98, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(362, 99, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(363, 101, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(364, 102, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(365, 103, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(366, 104, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(367, 105, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(368, 107, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(369, 108, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(370, 109, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(371, 110, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(372, 111, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(373, 139, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(374, 140, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(375, 141, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(376, 142, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(377, 143, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(378, 144, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(379, 145, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(380, 146, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(381, 147, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(382, 148, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(383, 149, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(384, 150, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(385, 151, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(386, 152, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(387, 153, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(388, 154, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(389, 155, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(390, 156, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(391, 157, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(392, 158, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(393, 159, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(394, 160, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(395, 161, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(396, 162, '2018-08-25', 1, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(397, 3, '2018-08-25', 4, 'yes', '2018-08-24 19:00:00', '2018-08-24 19:00:00'),
(398, 2, '2018-08-27', 3, 'yes', '2018-08-27 07:16:42', '2018-08-26 19:00:00'),
(399, 4, '2018-08-27', 3, 'yes', '2018-08-27 07:39:23', '2018-08-26 19:00:00'),
(400, 7, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(401, 8, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(402, 9, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(403, 10, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(404, 12, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(405, 13, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(406, 14, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(407, 15, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(408, 19, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(409, 20, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(410, 21, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(411, 26, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(412, 27, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(413, 28, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(414, 66, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(415, 67, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(416, 68, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(417, 69, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(418, 70, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(419, 71, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(420, 72, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(421, 73, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(422, 74, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(423, 75, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(424, 164, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(425, 167, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(426, 11, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(427, 29, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(428, 34, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(429, 76, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(430, 77, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(431, 78, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(432, 79, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(433, 80, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(434, 81, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(435, 82, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(436, 83, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(437, 84, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(438, 85, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(439, 86, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(440, 87, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(441, 18, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(442, 23, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(443, 24, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(444, 136, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(445, 137, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(446, 138, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(447, 16, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(448, 17, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(449, 22, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(450, 25, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(451, 163, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(452, 30, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(453, 31, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(454, 165, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(455, 166, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(456, 32, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(457, 33, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(458, 65, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(459, 35, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(460, 36, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(461, 37, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(462, 38, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(463, 39, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(464, 40, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(465, 41, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(466, 42, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(467, 43, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(468, 44, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(469, 112, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(470, 114, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(471, 115, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(472, 116, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(473, 117, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(474, 118, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(475, 119, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(476, 120, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(477, 121, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(478, 122, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(479, 123, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(480, 124, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(481, 125, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(482, 126, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(483, 127, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(484, 128, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(485, 129, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(486, 130, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(487, 131, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(488, 132, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(489, 133, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(490, 134, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(491, 135, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(492, 45, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(493, 46, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(494, 47, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(495, 48, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(496, 49, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(497, 50, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(498, 51, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(499, 52, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(500, 53, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(501, 54, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(502, 55, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(503, 56, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(504, 57, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(505, 58, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(506, 59, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(507, 60, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(508, 61, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(509, 62, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(510, 63, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(511, 64, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(512, 88, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(513, 90, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(514, 91, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(515, 92, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(516, 93, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(517, 94, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(518, 95, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(519, 97, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(520, 98, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(521, 99, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(522, 101, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(523, 102, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(524, 103, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(525, 104, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(526, 105, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(527, 107, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(528, 108, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(529, 109, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(530, 110, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(531, 111, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(532, 139, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(533, 140, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(534, 141, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(535, 142, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(536, 143, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(537, 144, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(538, 145, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(539, 146, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(540, 147, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(541, 148, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(542, 149, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(543, 150, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(544, 151, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(545, 152, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(546, 153, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(547, 154, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(548, 155, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(549, 156, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(550, 157, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(551, 158, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(552, 159, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(553, 160, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(554, 161, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(555, 162, '2018-08-27', 1, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(556, 3, '2018-08-27', 4, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(557, 6, '2018-08-27', 4, 'yes', '2018-08-26 19:00:00', '2018-08-26 19:00:00'),
(558, 2, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(559, 4, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(560, 6, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(561, 7, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(562, 8, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(563, 9, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(564, 10, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(565, 12, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(566, 13, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(567, 14, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(568, 15, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(569, 19, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(570, 20, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(571, 21, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(572, 26, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(573, 27, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(574, 28, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(575, 66, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(576, 67, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(577, 68, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(578, 69, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(579, 70, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(580, 71, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(581, 72, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(582, 73, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(583, 74, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(584, 75, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(585, 164, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(586, 167, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(587, 11, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(588, 29, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(589, 34, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(590, 76, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(591, 77, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(592, 78, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(593, 79, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(594, 80, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(595, 81, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(596, 82, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(597, 83, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(598, 84, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(599, 85, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(600, 86, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(601, 87, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(602, 18, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(603, 23, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(604, 24, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(605, 136, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(606, 137, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(607, 138, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(608, 16, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(609, 17, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(610, 22, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(611, 25, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(612, 163, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(613, 30, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(614, 31, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(615, 165, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(616, 166, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(617, 32, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(618, 33, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(619, 65, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(620, 35, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(621, 36, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(622, 37, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(623, 38, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(624, 39, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(625, 40, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(626, 41, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(627, 42, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(628, 43, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(629, 44, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(630, 112, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(631, 114, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00');
INSERT INTO `student_attendences` (`id`, `student_session_id`, `date`, `attendence_type_id`, `is_active`, `created_at`, `updated_at`) VALUES
(632, 115, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(633, 116, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(634, 117, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(635, 118, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(636, 119, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(637, 120, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(638, 121, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(639, 122, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(640, 123, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(641, 124, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(642, 125, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(643, 126, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(644, 127, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(645, 128, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(646, 129, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(647, 130, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(648, 131, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(649, 132, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(650, 133, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(651, 134, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(652, 135, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(653, 45, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(654, 46, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(655, 47, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(656, 48, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(657, 49, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(658, 50, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(659, 51, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(660, 52, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(661, 53, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(662, 54, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(663, 55, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(664, 56, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(665, 57, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(666, 58, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(667, 59, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(668, 60, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(669, 61, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(670, 62, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(671, 63, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(672, 64, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(673, 88, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(674, 90, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(675, 91, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(676, 92, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(677, 93, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(678, 94, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(679, 95, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(680, 97, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(681, 98, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(682, 99, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(683, 101, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(684, 102, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(685, 103, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(686, 104, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(687, 105, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(688, 107, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(689, 108, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(690, 109, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(691, 110, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(692, 111, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(693, 139, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(694, 140, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(695, 141, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(696, 142, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(697, 143, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(698, 144, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(699, 145, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(700, 146, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(701, 147, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(702, 148, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(703, 149, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(704, 150, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(705, 151, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(706, 152, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(707, 153, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(708, 154, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(709, 155, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(710, 156, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(711, 157, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(712, 158, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(713, 159, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(714, 160, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(715, 161, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(716, 162, '2018-08-29', 1, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00'),
(717, 3, '2018-08-29', 4, 'yes', '2018-08-28 19:00:00', '2018-08-28 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_doc`
--

CREATE TABLE `student_doc` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `doc` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_fees`
--

CREATE TABLE `student_fees` (
  `id` int(11) NOT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `feemaster_id` int(11) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `amount_discount` float(10,2) NOT NULL,
  `amount_fine` float(10,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8_unicode_ci,
  `date` date DEFAULT '0000-00-00',
  `payment_mode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_fees_deposite`
--

CREATE TABLE `student_fees_deposite` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_fees_master_id` int(11) DEFAULT NULL,
  `fee_groups_feetype_id` int(11) DEFAULT NULL,
  `amount_detail` text,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_fees_deposite`
--

INSERT INTO `student_fees_deposite` (`id`, `student_fees_master_id`, `fee_groups_feetype_id`, `amount_detail`, `is_active`, `created_at`) VALUES
(2, 2, 1, '{"1":{"amount":"1000","date":"2017-10-02","amount_discount":"0","amount_fine":"0","description":"","payment_mode":"Cash","inv_no":1}}', 'no', '2017-10-02 05:12:33'),
(3, 2, 2, '{"1":{"amount":"500","date":"2017-10-02","amount_discount":"0","amount_fine":"0","description":"","payment_mode":"Cash","inv_no":1}}', 'no', '2017-10-02 05:12:37'),
(4, 1, 2, '{"1":{"amount":"500","date":"2017-10-08","amount_discount":"0","amount_fine":"0","description":"","payment_mode":"Cash","inv_no":1}}', 'no', '2017-10-08 08:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `student_fees_discounts`
--

CREATE TABLE `student_fees_discounts` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `fees_discount_id` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'assigned',
  `payment_id` varchar(50) DEFAULT NULL,
  `description` text,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_fees_master`
--

CREATE TABLE `student_fees_master` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `fee_session_group_id` int(11) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_fees_master`
--

INSERT INTO `student_fees_master` (`id`, `student_session_id`, `fee_session_group_id`, `is_active`, `created_at`) VALUES
(1, 2, 1, 'no', '2017-10-02 05:11:08'),
(2, 3, 1, 'no', '2017-10-02 05:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `student_fee_payments`
--

CREATE TABLE `student_fee_payments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL DEFAULT '0',
  `tuition_fee` int(11) NOT NULL DEFAULT '0',
  `due_fee` int(11) NOT NULL DEFAULT '0',
  `total_paid_fee` int(11) NOT NULL DEFAULT '0',
  `fee_description` text NOT NULL,
  `voucher_id` int(70) NOT NULL,
  `payment_date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_fee_payments`
--

INSERT INTO `student_fee_payments` (`id`, `student_id`, `tuition_fee`, `due_fee`, `total_paid_fee`, `fee_description`, `voucher_id`, `payment_date`) VALUES
(59, 10, 20300, 28300, 20300, '', 0, '2018-07-10'),
(60, 10, 6000, 8000, 6000, '', 0, '2018-07-10'),
(61, 10, 2000, 2000, 2000, '', 0, '2018-07-10'),
(62, 10, 1300, 0, 1300, '', 0, '2018-07-10'),
(63, 10, 100, -1300, 100, '', 0, '2018-07-10'),
(64, 29, 100, -850, 250, '', 0, '2018-07-10'),
(65, 29, 900, -950, 900, '', 0, '2018-07-10'),
(66, 29, 1001, -1850, 1001, '', 0, '2018-07-10'),
(67, 33, 26000, 26300, 26300, '', 0, '2018-07-12'),
(68, 1, 3000, 13650, 3650, '', 0, '2018-07-12'),
(69, 1, 650, 10650, 650, '', 0, '2018-07-13'),
(70, 1, 100, 10000, 100, '', 0, '2018-07-13'),
(71, 1, 900, 9900, 900, '', 0, '2018-07-13'),
(74, 75, 800, 17100, 1217, '', 0, '2018-07-13'),
(75, 75, 16300, 16300, 16500, '', 0, '2018-07-13'),
(76, 75, 0, 0, 1000000, '', 0, '2018-07-13'),
(77, 3, 8000, 9600, 9600, '', 0, '2018-07-13'),
(78, 9, 6000, 18600, 8600, '', 0, '2018-07-13'),
(80, 7, 15000, 18600, 17600, 'jul,jun', 0, '2018-08-09'),
(92, 1, 9000, 9150, 9150, 'jul', 0, '2018-08-11'),
(93, 1, 9000, 0, 9000, 'jul', 0, '2018-08-11'),
(111, 2, 10750, 9750, 10750, 'all', 0, '2018-08-13'),
(112, 2, 3000, -1000, 3000, 'all', 0, '2018-08-13'),
(113, 2, 3000, -4000, 3000, 'all', 0, '2018-08-13'),
(114, 2, 3000, -7000, 3000, 'all', 0, '2018-08-13'),
(115, 3, 500, 1150, 650, 'jul', 0, '2018-08-15'),
(117, 3, 700, 500, 1800, '', 0, '2018-08-15'),
(118, 8, 1000, 18150, 1150, 'aug', 0, '2018-08-16'),
(119, 8, 7000, 17000, 7000, 'aug', 0, '2018-08-16'),
(120, 8, 8000, 10000, 8000, '8 munth', 0, '2018-08-16'),
(121, 8, 1000, 2000, 1000, '8 munth', 0, '2018-08-16'),
(131, 8, 1000, 1000, 1000, '', 0, '2018-08-16'),
(132, 8, 1000, 0, 1000, '', 0, '2018-08-16'),
(133, 7, 3000, 3000, 3000, 'jun,jul', 290, '2018-08-16'),
(134, 8, 3000, -1000, 3000, 'jul', 291, '2018-08-16'),
(139, 5, 39500, 40500, 39500, '12 months', 0, '2018-08-16'),
(140, 2, 0, -8000, 0, '', 0, '2018-08-02'),
(141, 2, 200, -8000, 200, '', 0, '2018-07-04'),
(142, 1, 0, -7150, 1500, '', 480, '2018-08-28'),
(143, 33, 2300, 4450, 2450, 'jul', 0, '2018-08-28'),
(144, 33, 2000, 4000, 2000, 'jul', 0, '2018-08-28');

-- --------------------------------------------------------

--
-- Table structure for table `student_fee_payments_others`
--

CREATE TABLE `student_fee_payments_others` (
  `id` int(11) NOT NULL,
  `student_fee_payment_id` int(11) NOT NULL,
  `fee_name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_fee_payments_others`
--

INSERT INTO `student_fee_payments_others` (`id`, `student_fee_payment_id`, `fee_name`, `amount`) VALUES
(3, 2, 'Admission fee', 100),
(4, 2, 'Computer fee', 100),
(13, 7, 'Admission fee', 0),
(14, 7, 'Computer fee', 0),
(15, 8, 'Admission fee', 0),
(16, 8, 'Computer fee', 0),
(17, 9, 'Admission fee', 0),
(18, 9, 'Computer fee', 0),
(19, 10, 'Admission fee', 0),
(20, 10, 'Computer fee', 0),
(21, 11, 'Admission fee', 1000),
(22, 11, 'Computer fee', 1200),
(23, 12, 'Admission fee', 0),
(24, 12, 'Computer fee', 0),
(25, 13, 'Admission fee', 0),
(26, 13, 'Computer fee', 0),
(27, 14, 'Admission fee', 0),
(28, 14, 'Computer fee', 0),
(29, 14, 'Fine for late fee payment', 150),
(30, 15, 'Admission fee', 0),
(31, 15, 'Computer fee', 0),
(32, 15, 'Fine for late fee payment', 0),
(33, 16, 'Admission fee', 0),
(34, 16, 'Computer fee', 0),
(35, 16, 'Fine for late fee payment', 0),
(36, 17, 'Admission fee', 100),
(37, 17, 'Computer fee', 100),
(38, 17, 'Exam fee', 0),
(39, 17, 'Seminar fee', 0),
(40, 17, 'Paper fund', 0),
(41, 17, 'Trip', 0),
(42, 17, 'Festival', 0),
(43, 17, 'Transport fee', 0),
(44, 17, 'Misc.', 0),
(45, 17, 'Ac charges', 0),
(46, 17, 'Fine for late fee payment', 0),
(47, 18, 'Admission fee', 100),
(48, 18, 'Computer fee', 100),
(49, 18, 'Exam fee', 0),
(50, 18, 'Seminar fee', 0),
(51, 18, 'Paper fund', 0),
(52, 18, 'Trip', 0),
(53, 18, 'Festival', 0),
(54, 18, 'Transport fee', 0),
(55, 18, 'Misc.', 0),
(56, 18, 'Ac charges', 0),
(57, 18, 'Fine for late fee payment', 0),
(58, 19, 'Admission fee', 100),
(59, 19, 'Computer fee', 100),
(60, 19, 'Exam fee', 0),
(61, 19, 'Seminar fee', 0),
(62, 19, 'Paper fund', 0),
(63, 19, 'Trip', 0),
(64, 19, 'Festival', 0),
(65, 19, 'Transport fee', 0),
(66, 19, 'Misc.', 0),
(67, 19, 'Ac charges', 0),
(68, 19, 'Fine for late fee payment', 0),
(69, 20, 'Admission fee', 100),
(70, 20, 'Computer fee', 100),
(71, 20, 'Exam fee', 0),
(72, 20, 'Seminar fee', 0),
(73, 20, 'Paper fund', 0),
(74, 20, 'Trip', 0),
(75, 20, 'Festival', 0),
(76, 20, 'Transport fee', 0),
(77, 20, 'Misc.', 0),
(78, 20, 'Ac charges', 0),
(79, 20, 'Fine for late fee payment', 0),
(80, 21, 'Admission fee', 100),
(81, 21, 'Computer fee', 100),
(82, 21, 'Exam fee', 0),
(83, 21, 'Seminar fee', 0),
(84, 21, 'Paper fund', 0),
(85, 21, 'Trip', 0),
(86, 21, 'Festival', 0),
(87, 21, 'Transport fee', 0),
(88, 21, 'Misc.', 0),
(89, 21, 'Ac charges', 0),
(90, 21, 'Fine for late fee payment', 0),
(91, 22, 'Admission fee', 0),
(92, 22, 'Computer fee', 0),
(93, 22, 'Exam fee', 0),
(94, 22, 'Seminar fee', 0),
(95, 22, 'Paper fund', 0),
(96, 22, 'Trip', 0),
(97, 22, 'Festival', 0),
(98, 22, 'Transport fee', 0),
(99, 22, 'Misc.', 0),
(100, 22, 'Ac charges', 0),
(101, 22, 'Fine for late fee payment', 0),
(102, 23, 'Admission fee', 0),
(103, 23, 'Computer fee', 0),
(104, 23, 'Exam fee', 0),
(105, 23, 'Seminar fee', 0),
(106, 23, 'Paper fund', 0),
(107, 23, 'Trip', 0),
(108, 23, 'Festival', 0),
(109, 23, 'Transport fee', 0),
(110, 23, 'Misc.', 0),
(111, 23, 'Ac charges', 0),
(112, 23, 'Fine for late fee payment', 0),
(113, 24, 'Admission fee', 0),
(114, 24, 'Computer fee', 0),
(115, 24, 'Exam fee', 0),
(116, 24, 'Seminar fee', 0),
(117, 24, 'Paper fund', 0),
(118, 24, 'Trip', 0),
(119, 24, 'Festival', 0),
(120, 24, 'Transport fee', 0),
(121, 24, 'Misc.', 0),
(122, 24, 'Ac charges', 0),
(123, 24, 'Fine for late fee payment', 0),
(124, 25, 'Admission fee', 0),
(125, 25, 'Computer fee', 0),
(126, 25, 'Exam fee', 0),
(127, 25, 'Seminar fee', 0),
(128, 25, 'Paper fund', 0),
(129, 25, 'Trip', 0),
(130, 25, 'Festival', 0),
(131, 25, 'Transport fee', 0),
(132, 25, 'Misc.', 0),
(133, 25, 'Ac charges', 0),
(134, 25, 'Fine for late fee payment', 0),
(135, 26, 'Admission fee', 0),
(136, 26, 'Computer fee', 0),
(137, 26, 'Exam fee', 0),
(138, 26, 'Seminar fee', 0),
(139, 26, 'Paper fund', 0),
(140, 26, 'Trip', 0),
(141, 26, 'Festival', 0),
(142, 26, 'Transport fee', 0),
(143, 26, 'Misc.', 0),
(144, 26, 'Ac charges', 0),
(145, 26, 'Fine for late fee payment', 0),
(146, 27, 'Admission fee', 1000),
(147, 27, 'Computer fee', 0),
(148, 27, 'Exam fee', 0),
(149, 27, 'Seminar fee', 0),
(150, 27, 'Paper fund', 0),
(151, 27, 'Trip', 0),
(152, 27, 'Festival', 0),
(153, 27, 'Transport fee', 0),
(154, 27, 'Misc.', 0),
(155, 27, 'Ac charges', 0),
(156, 27, 'Fine for late fee payment', 0),
(157, 28, 'Admission fee', 0),
(158, 28, 'Computer fee', 0),
(159, 28, 'Exam fee', 0),
(160, 28, 'Seminar fee', 0),
(161, 28, 'Paper fund', 0),
(162, 28, 'Trip', 0),
(163, 28, 'Festival', 0),
(164, 28, 'Transport fee', 0),
(165, 28, 'Misc.', 0),
(166, 28, 'Ac charges', 0),
(167, 28, 'Fine for late fee payment', 0),
(168, 29, 'Admission fee', 0),
(169, 29, 'Computer fee', 0),
(170, 29, 'Exam fee', 0),
(171, 29, 'Seminar fee', 0),
(172, 29, 'Paper fund', 0),
(173, 29, 'Trip', 0),
(174, 29, 'Festival', 0),
(175, 29, 'Transport fee', 0),
(176, 29, 'Misc.', 0),
(177, 29, 'Ac charges', 0),
(178, 29, 'Fine for late fee payment', 0),
(179, 30, 'Admission fee', 0),
(180, 30, 'Computer fee', 0),
(181, 30, 'Exam fee', 0),
(182, 30, 'Seminar fee', 0),
(183, 30, 'Paper fund', 0),
(184, 30, 'Trip', 0),
(185, 30, 'Festival', 0),
(186, 30, 'Transport fee', 0),
(187, 30, 'Misc.', 0),
(188, 30, 'Ac charges', 0),
(189, 30, 'Fine for late fee payment', 2300),
(190, 31, 'Admission fee', 0),
(191, 31, 'Computer fee', 0),
(192, 31, 'Exam fee', 0),
(193, 31, 'Seminar fee', 0),
(194, 31, 'Paper fund', 0),
(195, 31, 'Trip', 0),
(196, 31, 'Festival', 0),
(197, 31, 'Transport fee', 0),
(198, 31, 'Misc.', 0),
(199, 31, 'Ac charges', 0),
(200, 31, 'Fine for late fee payment', 2300),
(201, 32, 'Admission fee', 0),
(202, 32, 'Computer fee', 0),
(203, 32, 'Exam fee', 0),
(204, 32, 'Seminar fee', 0),
(205, 32, 'Paper fund', 0),
(206, 32, 'Trip', 0),
(207, 32, 'Festival', 0),
(208, 32, 'Transport fee', 0),
(209, 32, 'Misc.', 0),
(210, 32, 'Ac charges', 0),
(211, 32, 'Fine for late fee payment', 2300),
(212, 33, 'Admission fee', 0),
(213, 33, 'Computer fee', 0),
(214, 33, 'Exam fee', 0),
(215, 33, 'Seminar fee', 0),
(216, 33, 'Paper fund', 0),
(217, 33, 'Trip', 0),
(218, 33, 'Festival', 0),
(219, 33, 'Transport fee', 0),
(220, 33, 'Misc.', 0),
(221, 33, 'Ac charges', 0),
(222, 33, 'Fine for late fee payment', 0),
(234, 35, 'Admission fee', 0),
(235, 35, 'Computer fee', 0),
(236, 35, 'Exam fee', 0),
(237, 35, 'Seminar fee', 0),
(238, 35, 'Paper fund', 0),
(239, 35, 'Trip', 0),
(240, 35, 'Festival', 0),
(241, 35, 'Transport fee', 0),
(242, 35, 'Misc.', 0),
(243, 35, 'Ac charges', 0),
(244, 35, 'Fine for late fee payment', 0),
(245, 36, 'Admission fee', 0),
(246, 36, 'Computer fee', 0),
(247, 36, 'Exam fee', 0),
(248, 36, 'Seminar fee', 0),
(249, 36, 'Paper fund', 0),
(250, 36, 'Trip', 0),
(251, 36, 'Festival', 0),
(252, 36, 'Transport fee', 0),
(253, 36, 'Misc.', 0),
(254, 36, 'Ac charges', 0),
(255, 36, 'Fine for late fee payment', 0),
(256, 37, 'Admission fee', 0),
(257, 37, 'Computer fee', 0),
(258, 37, 'Exam fee', 0),
(259, 37, 'Seminar fee', 0),
(260, 37, 'Paper fund', 0),
(261, 37, 'Trip', 0),
(262, 37, 'Festival', 0),
(263, 37, 'Transport fee', 0),
(264, 37, 'Misc.', 0),
(265, 37, 'Ac charges', 0),
(266, 37, 'Fine for late fee payment', 0),
(267, 38, 'Admission fee', 0),
(268, 38, 'Computer fee', 0),
(269, 38, 'Exam fee', 0),
(270, 38, 'Seminar fee', 0),
(271, 38, 'Paper fund', 0),
(272, 38, 'Trip', 0),
(273, 38, 'Festival', 0),
(274, 38, 'Transport fee', 0),
(275, 38, 'Misc.', 0),
(276, 38, 'Ac charges', 0),
(277, 38, 'Fine for late fee payment', 0),
(278, 39, 'Admission fee', 0),
(279, 39, 'Computer fee', 0),
(280, 39, 'Exam fee', 0),
(281, 39, 'Seminar fee', 0),
(282, 39, 'Paper fund', 0),
(283, 39, 'Trip', 0),
(284, 39, 'Festival', 0),
(285, 39, 'Transport fee', 0),
(286, 39, 'Misc.', 0),
(287, 39, 'Ac charges', 0),
(288, 39, 'Fine for late fee payment', 0),
(289, 40, 'Admission fee', 0),
(290, 40, 'Computer fee', 0),
(291, 40, 'Exam fee', 0),
(292, 40, 'Seminar fee', 0),
(293, 40, 'Paper fund', 0),
(294, 40, 'Trip', 0),
(295, 40, 'Festival', 0),
(296, 40, 'Transport fee', 0),
(297, 40, 'Misc.', 0),
(298, 40, 'Ac charges', 0),
(299, 40, 'Fine for late fee payment', 0),
(300, 41, 'Admission fee', 0),
(301, 41, 'Computer fee', 0),
(302, 41, 'Exam fee', 0),
(303, 41, 'Seminar fee', 0),
(304, 41, 'Paper fund', 0),
(305, 41, 'Trip', 0),
(306, 41, 'Festival', 0),
(307, 41, 'Transport fee', 0),
(308, 41, 'Misc.', 0),
(309, 41, 'Ac charges', 0),
(310, 41, 'Fine for late fee payment', 0),
(311, 42, 'Admission fee', 0),
(312, 42, 'Computer fee', 0),
(313, 42, 'Exam fee', 0),
(314, 42, 'Seminar fee', 0),
(315, 42, 'Paper fund', 0),
(316, 42, 'Trip', 0),
(317, 42, 'Festival', 0),
(318, 42, 'Transport fee', 0),
(319, 42, 'Misc.', 0),
(320, 42, 'Ac charges', 0),
(321, 42, 'Fine for late fee payment', 0),
(322, 43, 'Admission fee', 0),
(323, 43, 'Computer fee', 0),
(324, 43, 'Exam fee', 0),
(325, 43, 'Seminar fee', 0),
(326, 43, 'Paper fund', 0),
(327, 43, 'Trip', 0),
(328, 43, 'Festival', 0),
(329, 43, 'Transport fee', 0),
(330, 43, 'Misc.', 0),
(331, 43, 'Ac charges', 0),
(332, 43, 'Fine for late fee payment', 0),
(333, 44, 'Admission fee', 0),
(334, 44, 'Computer fee', 0),
(335, 44, 'Exam fee', 0),
(336, 44, 'Seminar fee', 0),
(337, 44, 'Paper fund', 0),
(338, 44, 'Trip', 0),
(339, 44, 'Festival', 0),
(340, 44, 'Transport fee', 0),
(341, 44, 'Misc.', 0),
(342, 44, 'Ac charges', 0),
(343, 44, 'Fine for late fee payment', 0),
(344, 45, 'Admission fee', 0),
(345, 45, 'Computer fee', 0),
(346, 45, 'Exam fee', 0),
(347, 45, 'Seminar fee', 0),
(348, 45, 'Paper fund', 0),
(349, 45, 'Trip', 0),
(350, 45, 'Festival', 0),
(351, 45, 'Transport fee', 0),
(352, 45, 'Misc.', 0),
(353, 45, 'Ac charges', 0),
(354, 45, 'Fine for late fee payment', 2300),
(355, 46, 'Admission fee', 0),
(356, 46, 'Computer fee', 0),
(357, 46, 'Exam fee', 0),
(358, 46, 'Seminar fee', 0),
(359, 46, 'Paper fund', 0),
(360, 46, 'Trip', 0),
(361, 46, 'Festival', 0),
(362, 46, 'Transport fee', 0),
(363, 46, 'Misc.', 0),
(364, 46, 'Ac charges', 0),
(365, 46, 'Fine for late fee payment', 0),
(366, 47, 'Admission fee', 0),
(367, 47, 'Computer fee', 0),
(368, 47, 'Exam fee', 0),
(369, 47, 'Seminar fee', 0),
(370, 47, 'Paper fund', 0),
(371, 47, 'Trip', 0),
(372, 47, 'Festival', 0),
(373, 47, 'Transport fee', 0),
(374, 47, 'Misc.', 0),
(375, 47, 'Ac charges', 0),
(376, 47, 'Fine for late fee payment', 0),
(377, 48, 'Admission fee', 0),
(378, 48, 'Computer fee', 0),
(379, 48, 'Exam fee', 0),
(380, 48, 'Seminar fee', 0),
(381, 48, 'Paper fund', 0),
(382, 48, 'Trip', 0),
(383, 48, 'Festival', 0),
(384, 48, 'Transport fee', 0),
(385, 48, 'Misc.', 0),
(386, 48, 'Ac charges', 0),
(387, 48, 'Fine for late fee payment', 0),
(388, 49, 'Admission fee', 0),
(389, 49, 'Computer fee', 0),
(390, 49, 'Exam fee', 0),
(391, 49, 'Seminar fee', 0),
(392, 49, 'Paper fund', 0),
(393, 49, 'Trip', 0),
(394, 49, 'Festival', 0),
(395, 49, 'Transport fee', 0),
(396, 49, 'Misc.', 0),
(397, 49, 'Ac charges', 0),
(398, 49, 'Fine for late fee payment', 0),
(399, 50, 'Admission fee', 0),
(400, 50, 'Computer fee', 0),
(401, 50, 'Exam fee', 0),
(402, 50, 'Seminar fee', 0),
(403, 50, 'Paper fund', 0),
(404, 50, 'Trip', 0),
(405, 50, 'Festival', 0),
(406, 50, 'Transport fee', 0),
(407, 50, 'Misc.', 0),
(408, 50, 'Ac charges', 0),
(409, 50, 'Fine for late fee payment', 0),
(410, 51, 'Admission fee', 0),
(411, 51, 'Computer fee', 0),
(412, 51, 'Exam fee', 0),
(413, 51, 'Seminar fee', 0),
(414, 51, 'Paper fund', 0),
(415, 51, 'Trip', 0),
(416, 51, 'Festival', 0),
(417, 51, 'Transport fee', 0),
(418, 51, 'Misc.', 0),
(419, 51, 'Ac charges', 0),
(420, 51, 'Fine for late fee payment', 0),
(421, 52, 'Admission fee', 0),
(422, 52, 'Computer fee', 0),
(423, 52, 'Exam fee', 0),
(424, 52, 'Seminar fee', 0),
(425, 52, 'Paper fund', 0),
(426, 52, 'Trip', 0),
(427, 52, 'Festival', 0),
(428, 52, 'Transport fee', 0),
(429, 52, 'Misc.', 0),
(430, 52, 'Ac charges', 0),
(431, 52, 'Fine for late fee payment', 0),
(432, 53, 'Admission fee', 0),
(433, 53, 'Computer fee', 0),
(434, 53, 'Exam fee', 0),
(435, 53, 'Seminar fee', 0),
(436, 53, 'Paper fund', 0),
(437, 53, 'Trip', 0),
(438, 53, 'Festival', 0),
(439, 53, 'Transport fee', 0),
(440, 53, 'Misc.', 0),
(441, 53, 'Ac charges', 0),
(442, 53, 'Fine for late fee payment', 150),
(443, 54, 'Admission fee', 0),
(444, 54, 'Computer fee', 0),
(445, 54, 'Exam fee', 0),
(446, 54, 'Seminar fee', 0),
(447, 54, 'Paper fund', 0),
(448, 54, 'Trip', 0),
(449, 54, 'Festival', 0),
(450, 54, 'Transport fee', 0),
(451, 54, 'Misc.', 0),
(452, 54, 'Ac charges', 0),
(453, 54, 'Fine for late fee payment', 0),
(454, 55, 'Admission fee', 0),
(455, 55, 'Computer fee', 0),
(456, 55, 'Exam fee', 0),
(457, 55, 'Seminar fee', 0),
(458, 55, 'Paper fund', 0),
(459, 55, 'Trip', 0),
(460, 55, 'Festival', 0),
(461, 55, 'Transport fee', 0),
(462, 55, 'Misc.', 0),
(463, 55, 'Ac charges', 0),
(464, 55, 'Fine for late fee payment', 0),
(465, 56, 'Admission fee', 0),
(466, 56, 'Computer fee', 0),
(467, 56, 'Exam fee', 0),
(468, 56, 'Seminar fee', 0),
(469, 56, 'Paper fund', 0),
(470, 56, 'Trip', 0),
(471, 56, 'Festival', 0),
(472, 56, 'Transport fee', 0),
(473, 56, 'Misc.', 0),
(474, 56, 'Ac charges', 0),
(475, 56, 'Fine for late fee payment', 150),
(476, 57, 'Admission fee', 0),
(477, 57, 'Computer fee', 0),
(478, 57, 'Exam fee', 0),
(479, 57, 'Seminar fee', 0),
(480, 57, 'Paper fund', 0),
(481, 57, 'Trip', 0),
(482, 57, 'Festival', 0),
(483, 57, 'Transport fee', 0),
(484, 57, 'Misc.', 0),
(485, 57, 'Ac charges', 0),
(486, 57, 'Fine for late fee payment', 0),
(487, 58, 'Admission fee', 0),
(488, 58, 'Computer fee', 0),
(489, 58, 'Exam fee', 0),
(490, 58, 'Seminar fee', 0),
(491, 58, 'Paper fund', 0),
(492, 58, 'Trip', 0),
(493, 58, 'Festival', 0),
(494, 58, 'Transport fee', 0),
(495, 58, 'Misc.', 0),
(496, 58, 'Ac charges', 0),
(497, 58, 'Fine for late fee payment', 0),
(498, 59, 'Admission fee', 0),
(499, 59, 'Computer fee', 0),
(500, 59, 'Exam fee', 0),
(501, 59, 'Seminar fee', 0),
(502, 59, 'Paper fund', 0),
(503, 59, 'Trip', 0),
(504, 59, 'Festival', 0),
(505, 59, 'Transport fee', 0),
(506, 59, 'Misc.', 0),
(507, 59, 'Ac charges', 0),
(508, 59, 'Fine for late fee payment', 0),
(509, 60, 'Admission fee', 0),
(510, 60, 'Computer fee', 0),
(511, 60, 'Exam fee', 0),
(512, 60, 'Seminar fee', 0),
(513, 60, 'Paper fund', 0),
(514, 60, 'Trip', 0),
(515, 60, 'Festival', 0),
(516, 60, 'Transport fee', 0),
(517, 60, 'Misc.', 0),
(518, 60, 'Ac charges', 0),
(519, 60, 'Fine for late fee payment', 0),
(520, 61, 'Admission fee', 0),
(521, 61, 'Computer fee', 0),
(522, 61, 'Exam fee', 0),
(523, 61, 'Seminar fee', 0),
(524, 61, 'Paper fund', 0),
(525, 61, 'Trip', 0),
(526, 61, 'Festival', 0),
(527, 61, 'Transport fee', 0),
(528, 61, 'Misc.', 0),
(529, 61, 'Ac charges', 0),
(530, 61, 'Fine for late fee payment', 0),
(531, 62, 'Admission fee', 0),
(532, 62, 'Computer fee', 0),
(533, 62, 'Exam fee', 0),
(534, 62, 'Seminar fee', 0),
(535, 62, 'Paper fund', 0),
(536, 62, 'Trip', 0),
(537, 62, 'Festival', 0),
(538, 62, 'Transport fee', 0),
(539, 62, 'Misc.', 0),
(540, 62, 'Ac charges', 0),
(541, 62, 'Fine for late fee payment', 0),
(542, 63, 'Admission fee', 0),
(543, 63, 'Computer fee', 0),
(544, 63, 'Exam fee', 0),
(545, 63, 'Seminar fee', 0),
(546, 63, 'Paper fund', 0),
(547, 63, 'Trip', 0),
(548, 63, 'Festival', 0),
(549, 63, 'Transport fee', 0),
(550, 63, 'Misc.', 0),
(551, 63, 'Ac charges', 0),
(552, 63, 'Fine for late fee payment', 0),
(553, 64, 'Admission fee', 0),
(554, 64, 'Computer fee', 0),
(555, 64, 'Exam fee', 0),
(556, 64, 'Seminar fee', 0),
(557, 64, 'Paper fund', 0),
(558, 64, 'Trip', 0),
(559, 64, 'Festival', 0),
(560, 64, 'Transport fee', 0),
(561, 64, 'Misc.', 0),
(562, 64, 'Ac charges', 0),
(563, 64, 'Fine for late fee payment', 150),
(564, 65, 'Admission fee', 0),
(565, 65, 'Computer fee', 0),
(566, 65, 'Exam fee', 0),
(567, 65, 'Seminar fee', 0),
(568, 65, 'Paper fund', 0),
(569, 65, 'Trip', 0),
(570, 65, 'Festival', 0),
(571, 65, 'Transport fee', 0),
(572, 65, 'Misc.', 0),
(573, 65, 'Ac charges', 0),
(574, 65, 'Fine for late fee payment', 0),
(575, 66, 'Admission fee', 0),
(576, 66, 'Computer fee', 0),
(577, 66, 'Exam fee', 0),
(578, 66, 'Seminar fee', 0),
(579, 66, 'Paper fund', 0),
(580, 66, 'Trip', 0),
(581, 66, 'Festival', 0),
(582, 66, 'Transport fee', 0),
(583, 66, 'Misc.', 0),
(584, 66, 'Ac charges', 0),
(585, 66, 'Fine for late fee payment', 0),
(586, 67, 'Admission fee', 0),
(587, 67, 'Computer fee', 0),
(588, 67, 'Exam fee', 0),
(589, 67, 'Seminar fee', 0),
(590, 67, 'Paper fund', 0),
(591, 67, 'Trip', 0),
(592, 67, 'Festival', 0),
(593, 67, 'Transport fee', 0),
(594, 67, 'Misc.', 0),
(595, 67, 'Ac charges', 0),
(596, 67, 'Fine for late fee payment', 300),
(597, 68, 'Admission fee', 0),
(598, 68, 'Computer fee', 0),
(599, 68, 'Exam fee', 0),
(600, 68, 'Seminar fee', 0),
(601, 68, 'Paper fund', 0),
(602, 68, 'Trip', 0),
(603, 68, 'Festival', 0),
(604, 68, 'Transport fee', 0),
(605, 68, 'Misc.', 0),
(606, 68, 'Ac charges', 0),
(607, 68, 'Fine for late fee payment', 650),
(608, 69, 'Admission fee', 0),
(609, 69, 'Computer fee', 0),
(610, 69, 'Exam fee', 0),
(611, 69, 'Seminar fee', 0),
(612, 69, 'Paper fund', 0),
(613, 69, 'Trip', 0),
(614, 69, 'Festival', 0),
(615, 69, 'Transport fee', 0),
(616, 69, 'Misc.', 0),
(617, 69, 'Ac charges', 0),
(618, 69, 'Fine for late fee payment', 0),
(619, 70, 'Admission fee', 0),
(620, 70, 'Computer fee', 0),
(621, 70, 'Exam fee', 0),
(622, 70, 'Seminar fee', 0),
(623, 70, 'Paper fund', 0),
(624, 70, 'Trip', 0),
(625, 70, 'Festival', 0),
(626, 70, 'Transport fee', 0),
(627, 70, 'Misc.', 0),
(628, 70, 'Ac charges', 0),
(629, 70, 'Fine for late fee payment', 0),
(630, 71, 'Admission fee', 0),
(631, 71, 'Computer fee', 0),
(632, 71, 'Exam fee', 0),
(633, 71, 'Seminar fee', 0),
(634, 71, 'Paper fund', 0),
(635, 71, 'Trip', 0),
(636, 71, 'Festival', 0),
(637, 71, 'Transport fee', 0),
(638, 71, 'Misc.', 0),
(639, 71, 'Ac charges', 0),
(640, 71, 'Fine for late fee payment', 0),
(663, 74, 'Admission fee', 117),
(664, 74, 'Computer fee', 0),
(665, 74, 'Exam fee', 0),
(666, 74, 'Seminar fee', 0),
(667, 74, 'Paper fund', 0),
(668, 74, 'Trip', 0),
(669, 74, 'Festival', 0),
(670, 74, 'Transport fee', 0),
(671, 74, 'Misc.', 0),
(672, 74, 'Ac charges', 0),
(673, 74, 'Fine for late fee payment', 300),
(674, 75, 'Admission fee', 0),
(675, 75, 'Computer fee', 200),
(676, 75, 'Exam fee', 0),
(677, 75, 'Seminar fee', 0),
(678, 75, 'Paper fund', 0),
(679, 75, 'Trip', 0),
(680, 75, 'Festival', 0),
(681, 75, 'Transport fee', 0),
(682, 75, 'Misc.', 0),
(683, 75, 'Ac charges', 0),
(684, 75, 'Fine for late fee payment', 0),
(685, 76, 'Admission fee', 1000000),
(686, 76, 'Computer fee', 0),
(687, 76, 'Exam fee', 0),
(688, 76, 'Seminar fee', 0),
(689, 76, 'Paper fund', 0),
(690, 76, 'Trip', 0),
(691, 76, 'Festival', 0),
(692, 76, 'Transport fee', 0),
(693, 76, 'Misc.', 0),
(694, 76, 'Ac charges', 0),
(695, 76, 'Fine for late fee payment', 0),
(696, 77, 'Admission fee', 0),
(697, 77, 'Computer fee', 0),
(698, 77, 'Exam fee', 0),
(699, 77, 'Seminar fee', 0),
(700, 77, 'Paper fund', 0),
(701, 77, 'Trip', 0),
(702, 77, 'Festival', 0),
(703, 77, 'Transport fee', 0),
(704, 77, 'Misc.', 0),
(705, 77, 'Ac charges', 0),
(706, 77, 'Fine for late fee payment', 1600),
(707, 78, 'Admission fee', 0),
(708, 78, 'Computer fee', 0),
(709, 78, 'Exam fee', 0),
(710, 78, 'Seminar fee', 0),
(711, 78, 'Paper fund', 0),
(712, 78, 'Trip', 0),
(713, 78, 'Festival', 0),
(714, 78, 'Transport fee', 0),
(715, 78, 'Misc.', 0),
(716, 78, 'Ac charges', 0),
(717, 78, 'Fine for late fee payment', 2600),
(773, 80, 'Admission fee', 0),
(774, 80, 'Computer fee', 0),
(775, 80, 'Exam fee', 0),
(776, 80, 'Seminar fee', 0),
(777, 80, 'Paper fund', 0),
(778, 80, 'Trip', 0),
(779, 80, 'Festival', 0),
(780, 80, 'Transport fee', 0),
(781, 80, 'Misc.', 0),
(782, 80, 'Ac charges', 0),
(783, 80, 'Fine for late fee payment', 2600),
(905, 92, 'Admission fee', 0),
(906, 92, 'Computer fee', 0),
(907, 92, 'Exam fee', 0),
(908, 92, 'Seminar fee', 0),
(909, 92, 'Paper fund', 0),
(910, 92, 'Trip', 0),
(911, 92, 'Festival', 0),
(912, 92, 'Transport fee', 0),
(913, 92, 'Misc.', 0),
(914, 92, 'Ac charges', 0),
(915, 92, 'Fine for late fee payment', 150),
(916, 93, 'Admission fee', 0),
(917, 93, 'Computer fee', 0),
(918, 93, 'Exam fee', 0),
(919, 93, 'Seminar fee', 0),
(920, 93, 'Paper fund', 0),
(921, 93, 'Trip', 0),
(922, 93, 'Festival', 0),
(923, 93, 'Transport fee', 0),
(924, 93, 'Misc.', 0),
(925, 93, 'Ac charges', 0),
(926, 93, 'Fine for late fee payment', 0),
(1114, 111, 'Admission fee', 0),
(1115, 111, 'Computer fee', 0),
(1116, 111, 'Exam fee', 0),
(1117, 111, 'Seminar fee', 0),
(1118, 111, 'Paper fund', 0),
(1119, 111, 'Trip', 0),
(1120, 111, 'Festival', 0),
(1121, 111, 'Transport fee', 0),
(1122, 111, 'Misc.', 0),
(1123, 111, 'Ac charges', 0),
(1124, 111, 'Fine for late fee payment', 0),
(1125, 112, 'Admission fee', 0),
(1126, 112, 'Computer fee', 0),
(1127, 112, 'Exam fee', 0),
(1128, 112, 'Seminar fee', 0),
(1129, 112, 'Paper fund', 0),
(1130, 112, 'Trip', 0),
(1131, 112, 'Festival', 0),
(1132, 112, 'Transport fee', 0),
(1133, 112, 'Misc.', 0),
(1134, 112, 'Ac charges', 0),
(1135, 112, 'Fine for late fee payment', 0),
(1136, 113, 'Admission fee', 0),
(1137, 113, 'Computer fee', 0),
(1138, 113, 'Exam fee', 0),
(1139, 113, 'Seminar fee', 0),
(1140, 113, 'Paper fund', 0),
(1141, 113, 'Trip', 0),
(1142, 113, 'Festival', 0),
(1143, 113, 'Transport fee', 0),
(1144, 113, 'Misc.', 0),
(1145, 113, 'Ac charges', 0),
(1146, 113, 'Fine for late fee payment', 0),
(1147, 114, 'Admission fee', 0),
(1148, 114, 'Computer fee', 0),
(1149, 114, 'Exam fee', 0),
(1150, 114, 'Seminar fee', 0),
(1151, 114, 'Paper fund', 0),
(1152, 114, 'Trip', 0),
(1153, 114, 'Festival', 0),
(1154, 114, 'Transport fee', 0),
(1155, 114, 'Misc.', 0),
(1156, 114, 'Ac charges', 0),
(1157, 114, 'Fine for late fee payment', 0),
(1158, 115, 'Admission fee', 0),
(1159, 115, 'Computer fee', 0),
(1160, 115, 'Exam fee', 0),
(1161, 115, 'Seminar fee', 0),
(1162, 115, 'Paper fund', 0),
(1163, 115, 'Trip', 0),
(1164, 115, 'Festival', 0),
(1165, 115, 'Transport fee', 0),
(1166, 115, 'Misc.', 0),
(1167, 115, 'Ac charges', 0),
(1168, 115, 'Fine for late fee payment', 150),
(1180, 117, 'Admission fee', 100),
(1181, 117, 'Computer fee', 1000),
(1182, 117, 'Exam fee', 0),
(1183, 117, 'Seminar fee', 0),
(1184, 117, 'Paper fund', 0),
(1185, 117, 'Trip', 0),
(1186, 117, 'Festival', 0),
(1187, 117, 'Transport fee', 0),
(1188, 117, 'Misc.', 0),
(1189, 117, 'Ac charges', 0),
(1190, 117, 'Fine for late fee payment', 0),
(1191, 118, 'Admission fee', 0),
(1192, 118, 'Computer fee', 0),
(1193, 118, 'Exam fee', 0),
(1194, 118, 'Seminar fee', 0),
(1195, 118, 'Paper fund', 0),
(1196, 118, 'Trip', 0),
(1197, 118, 'Festival', 0),
(1198, 118, 'Transport fee', 0),
(1199, 118, 'Misc.', 0),
(1200, 118, 'Ac charges', 0),
(1201, 118, 'Fine for late fee payment', 150),
(1202, 119, 'Admission fee', 0),
(1203, 119, 'Computer fee', 0),
(1204, 119, 'Exam fee', 0),
(1205, 119, 'Seminar fee', 0),
(1206, 119, 'Paper fund', 0),
(1207, 119, 'Trip', 0),
(1208, 119, 'Festival', 0),
(1209, 119, 'Transport fee', 0),
(1210, 119, 'Misc.', 0),
(1211, 119, 'Ac charges', 0),
(1212, 119, 'Fine for late fee payment', 0),
(1213, 120, 'Admission fee', 0),
(1214, 120, 'Computer fee', 0),
(1215, 120, 'Exam fee', 0),
(1216, 120, 'Seminar fee', 0),
(1217, 120, 'Paper fund', 0),
(1218, 120, 'Trip', 0),
(1219, 120, 'Festival', 0),
(1220, 120, 'Transport fee', 0),
(1221, 120, 'Misc.', 0),
(1222, 120, 'Ac charges', 0),
(1223, 120, 'Fine for late fee payment', 0),
(1224, 121, 'Admission fee', 0),
(1225, 121, 'Computer fee', 0),
(1226, 121, 'Exam fee', 0),
(1227, 121, 'Seminar fee', 0),
(1228, 121, 'Paper fund', 0),
(1229, 121, 'Trip', 0),
(1230, 121, 'Festival', 0),
(1231, 121, 'Transport fee', 0),
(1232, 121, 'Misc.', 0),
(1233, 121, 'Ac charges', 0),
(1234, 121, 'Fine for late fee payment', 0),
(1334, 131, 'Admission fee', 0),
(1335, 131, 'Computer fee', 0),
(1336, 131, 'Exam fee', 0),
(1337, 131, 'Seminar fee', 0),
(1338, 131, 'Paper fund', 0),
(1339, 131, 'Trip', 0),
(1340, 131, 'Festival', 0),
(1341, 131, 'Transport fee', 0),
(1342, 131, 'Misc.', 0),
(1343, 131, 'Ac charges', 0),
(1344, 131, 'Fine for late fee payment', 0),
(1345, 132, 'Admission fee', 0),
(1346, 132, 'Computer fee', 0),
(1347, 132, 'Exam fee', 0),
(1348, 132, 'Seminar fee', 0),
(1349, 132, 'Paper fund', 0),
(1350, 132, 'Trip', 0),
(1351, 132, 'Festival', 0),
(1352, 132, 'Transport fee', 0),
(1353, 132, 'Misc.', 0),
(1354, 132, 'Ac charges', 0),
(1355, 132, 'Fine for late fee payment', 0),
(1356, 133, 'Admission fee', 0),
(1357, 133, 'Computer fee', 0),
(1358, 133, 'Exam fee', 0),
(1359, 133, 'Seminar fee', 0),
(1360, 133, 'Paper fund', 0),
(1361, 133, 'Trip', 0),
(1362, 133, 'Festival', 0),
(1363, 133, 'Transport fee', 0),
(1364, 133, 'Misc.', 0),
(1365, 133, 'Ac charges', 0),
(1366, 133, 'Fine for late fee payment', 0),
(1411, 134, 'Admission fee', 0),
(1412, 134, 'Computer fee', 0),
(1413, 134, 'Exam fee', 0),
(1414, 134, 'Seminar fee', 0),
(1415, 134, 'Paper fund', 0),
(1416, 134, 'Trip', 0),
(1417, 134, 'Festival', 0),
(1418, 134, 'Transport fee', 0),
(1419, 134, 'Misc.', 0),
(1420, 134, 'Ac charges', 0),
(1421, 134, 'Fine for late fee payment', 0),
(1477, 139, 'Admission fee', 0),
(1478, 139, 'Computer fee', 0),
(1479, 139, 'Exam fee', 0),
(1480, 139, 'Seminar fee', 0),
(1481, 139, 'Paper fund', 0),
(1482, 139, 'Trip', 0),
(1483, 139, 'Festival', 0),
(1484, 139, 'Transport fee', 0),
(1485, 139, 'Misc.', 0),
(1486, 139, 'Ac charges', 0),
(1487, 139, 'Fine for late fee payment', 0),
(1488, 140, 'Admission fee', 0),
(1489, 140, 'Computer fee', 0),
(1490, 140, 'Exam fee', 0),
(1491, 140, 'Seminar fee', 0),
(1492, 140, 'Paper fund', 0),
(1493, 140, 'Trip', 0),
(1494, 140, 'Festival', 0),
(1495, 140, 'Transport fee', 0),
(1496, 140, 'Misc.', 0),
(1497, 140, 'Ac charges', 0),
(1498, 140, 'Fine for late fee payment', 0),
(1499, 141, 'Admission fee', 0),
(1500, 141, 'Computer fee', 0),
(1501, 141, 'Exam fee', 0),
(1502, 141, 'Seminar fee', 0),
(1503, 141, 'Paper fund', 0),
(1504, 141, 'Trip', 0),
(1505, 141, 'Festival', 0),
(1506, 141, 'Transport fee', 0),
(1507, 141, 'Misc.', 0),
(1508, 141, 'Ac charges', 0),
(1509, 141, 'Fine for late fee payment', 0),
(1510, 142, 'Admission fee', 500),
(1511, 142, 'Computer fee', 1000),
(1512, 142, 'Exam fee', 0),
(1513, 142, 'Seminar fee', 0),
(1514, 142, 'Paper fund', 0),
(1515, 142, 'Trip', 0),
(1516, 142, 'Festival', 0),
(1517, 142, 'Transport fee', 0),
(1518, 142, 'Misc.', 0),
(1519, 142, 'Ac charges', 0),
(1520, 142, 'Fine for late fee payment', 0),
(1521, 143, 'Admission fee', 0),
(1522, 143, 'Computer fee', 0),
(1523, 143, 'Exam fee', 0),
(1524, 143, 'Seminar fee', 0),
(1525, 143, 'Paper fund', 0),
(1526, 143, 'Trip', 0),
(1527, 143, 'Festival', 0),
(1528, 143, 'Transport fee', 0),
(1529, 143, 'Misc.', 0),
(1530, 143, 'Ac charges', 0),
(1531, 143, 'Fine for late fee payment', 150),
(1532, 144, 'Admission fee', 0),
(1533, 144, 'Computer fee', 0),
(1534, 144, 'Exam fee', 0),
(1535, 144, 'Seminar fee', 0),
(1536, 144, 'Paper fund', 0),
(1537, 144, 'Trip', 0),
(1538, 144, 'Festival', 0),
(1539, 144, 'Transport fee', 0),
(1540, 144, 'Misc.', 0),
(1541, 144, 'Ac charges', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_fee_types`
--

CREATE TABLE `student_fee_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_fee_types`
--

INSERT INTO `student_fee_types` (`id`, `name`, `amount`) VALUES
(1, 'Admission fee', 500),
(2, 'Computer fee', 1000),
(3, 'Exam fee', 1000),
(4, 'Seminar fee', 2000),
(5, 'Paper fund', 1000),
(6, 'Trip', 1000),
(7, 'Festival', 1000),
(8, 'Transport fee', 15000),
(9, 'Misc.', 1000),
(10, 'Ac charges', 500);

-- --------------------------------------------------------

--
-- Table structure for table `student_fee_voucher`
--

CREATE TABLE `student_fee_voucher` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `total_fee` decimal(10,2) NOT NULL,
  `month_names` text,
  `arrears` int(35) NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 for paid. 0 for unpaid.',
  `created_at` datetime DEFAULT NULL,
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_fee_voucher`
--

INSERT INTO `student_fee_voucher` (`id`, `student_id`, `total_fee`, `month_names`, `arrears`, `paid`, `created_at`, `due_date`) VALUES
(1, 1, '2500.00', NULL, 0, 1, '2018-03-23 17:23:03', NULL),
(2, 2, '2500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(3, 3, '2500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(4, 5, '2500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(5, 6, '2500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(6, 7, '2500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(7, 8, '2500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(8, 9, '2500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(9, 11, '2500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(10, 12, '2500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(11, 13, '2500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(12, 14, '2500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(13, 18, '2500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(14, 19, '2500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(15, 20, '2500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(16, 10, '3500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(17, 17, '4500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(18, 15, '16500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(19, 16, '16500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(20, 21, '2500.00', NULL, 0, 0, '2018-03-23 17:23:04', NULL),
(21, 1, '1000.00', NULL, 0, 0, '2018-03-23 18:41:57', NULL),
(22, 2, '1000.00', NULL, 0, 0, '2018-03-23 18:41:57', NULL),
(23, 3, '1000.00', NULL, 0, 0, '2018-03-23 18:41:57', NULL),
(24, 5, '1000.00', NULL, 0, 0, '2018-03-23 18:41:57', NULL),
(25, 6, '1000.00', NULL, 0, 0, '2018-03-23 18:41:57', NULL),
(26, 7, '1000.00', NULL, 0, 0, '2018-03-23 18:41:57', NULL),
(27, 8, '1000.00', NULL, 0, 0, '2018-03-23 18:41:57', NULL),
(28, 9, '1000.00', NULL, 0, 0, '2018-03-23 18:41:57', NULL),
(29, 11, '1000.00', NULL, 0, 0, '2018-03-23 18:41:57', NULL),
(30, 12, '1000.00', NULL, 0, 0, '2018-03-23 18:41:57', NULL),
(31, 13, '1000.00', NULL, 0, 0, '2018-03-23 18:41:57', NULL),
(32, 14, '1000.00', NULL, 0, 0, '2018-03-23 18:41:57', NULL),
(33, 18, '1000.00', NULL, 0, 0, '2018-03-23 18:41:57', NULL),
(34, 19, '1000.00', NULL, 0, 0, '2018-03-23 18:41:58', NULL),
(35, 20, '1000.00', NULL, 0, 0, '2018-03-23 18:41:58', NULL),
(36, 1, '500.00', NULL, 0, 0, '2018-03-27 12:41:00', NULL),
(37, 2, '-1000.00', NULL, 0, 0, '2018-03-27 12:41:01', NULL),
(38, 3, '0.00', NULL, 0, 0, '2018-03-27 12:41:01', NULL),
(39, 5, '800.00', NULL, 0, 0, '2018-03-27 12:41:01', NULL),
(40, 6, '800.00', NULL, 0, 0, '2018-03-27 12:41:01', NULL),
(41, 7, '800.00', NULL, 0, 0, '2018-03-27 12:41:01', NULL),
(42, 8, '800.00', NULL, 0, 0, '2018-03-27 12:41:01', NULL),
(43, 9, '800.00', NULL, 0, 0, '2018-03-27 12:41:01', NULL),
(44, 11, '800.00', NULL, 0, 0, '2018-03-27 12:41:01', NULL),
(45, 12, '800.00', NULL, 0, 0, '2018-03-27 12:41:01', NULL),
(46, 13, '800.00', NULL, 0, 0, '2018-03-27 12:41:01', NULL),
(47, 14, '800.00', NULL, 0, 0, '2018-03-27 12:41:01', NULL),
(48, 18, '800.00', NULL, 0, 0, '2018-03-27 12:41:01', NULL),
(49, 19, '800.00', NULL, 0, 0, '2018-03-27 12:41:01', NULL),
(50, 20, '800.00', NULL, 0, 0, '2018-03-27 12:41:01', NULL),
(51, 1, '500.00', NULL, 0, 0, '2018-03-27 14:32:14', NULL),
(52, 2, '-1000.00', NULL, 0, 0, '2018-03-27 14:32:15', NULL),
(53, 3, '0.00', NULL, 0, 0, '2018-03-27 14:32:15', NULL),
(54, 5, '800.00', NULL, 0, 0, '2018-03-27 14:32:15', NULL),
(55, 6, '800.00', NULL, 0, 0, '2018-03-27 14:32:15', NULL),
(56, 7, '800.00', NULL, 0, 0, '2018-03-27 14:32:15', NULL),
(57, 8, '800.00', NULL, 0, 0, '2018-03-27 14:32:15', NULL),
(58, 9, '800.00', NULL, 0, 0, '2018-03-27 14:32:15', NULL),
(59, 11, '800.00', NULL, 0, 0, '2018-03-27 14:32:15', NULL),
(60, 12, '800.00', NULL, 0, 0, '2018-03-27 14:32:15', NULL),
(61, 13, '800.00', NULL, 0, 0, '2018-03-27 14:32:15', NULL),
(62, 14, '800.00', NULL, 0, 0, '2018-03-27 14:32:15', NULL),
(63, 18, '800.00', NULL, 0, 0, '2018-03-27 14:32:15', NULL),
(64, 19, '800.00', NULL, 0, 0, '2018-03-27 14:32:15', NULL),
(65, 20, '800.00', NULL, 0, 0, '2018-03-27 14:32:15', NULL),
(66, 10, '800.00', NULL, 0, 0, '2018-03-27 14:53:33', NULL),
(67, 10, '2800.00', NULL, 0, 0, '2018-03-27 14:55:04', NULL),
(68, 10, '4800.00', NULL, 0, 0, '2018-03-27 14:56:02', NULL),
(69, 10, '6800.00', NULL, 0, 0, '2018-03-27 14:56:30', NULL),
(70, 1, '3500.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(72, 3, '3000.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(73, 5, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(74, 6, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(75, 7, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(76, 8, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(77, 9, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(78, 11, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(79, 12, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(80, 13, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(81, 14, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(82, 18, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(83, 19, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(84, 20, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(85, 1, '3500.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(87, 3, '3000.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(88, 5, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(89, 6, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(90, 7, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(91, 8, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(92, 9, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(93, 11, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(94, 12, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(95, 13, '3800.00', NULL, 0, 0, '2018-03-27 16:14:39', NULL),
(96, 14, '3800.00', NULL, 0, 0, '2018-03-27 16:14:40', NULL),
(97, 18, '3800.00', NULL, 0, 0, '2018-03-27 16:14:40', NULL),
(98, 19, '3800.00', NULL, 0, 0, '2018-03-27 16:14:40', NULL),
(99, 20, '3800.00', NULL, 0, 0, '2018-03-27 16:14:40', NULL),
(100, 1, '3500.00', NULL, 0, 0, '2018-03-27 16:14:45', NULL),
(102, 3, '3000.00', NULL, 0, 0, '2018-03-27 16:14:45', NULL),
(103, 5, '3800.00', NULL, 0, 0, '2018-03-27 16:14:45', NULL),
(104, 6, '3800.00', NULL, 0, 0, '2018-03-27 16:14:45', NULL),
(105, 7, '3800.00', NULL, 0, 0, '2018-03-27 16:14:45', NULL),
(106, 8, '3800.00', NULL, 0, 0, '2018-03-27 16:14:45', NULL),
(107, 9, '3800.00', NULL, 0, 0, '2018-03-27 16:14:45', NULL),
(108, 11, '3800.00', NULL, 0, 0, '2018-03-27 16:14:45', NULL),
(109, 12, '3800.00', NULL, 0, 0, '2018-03-27 16:14:45', NULL),
(110, 13, '3800.00', NULL, 0, 0, '2018-03-27 16:14:45', NULL),
(111, 14, '3800.00', NULL, 0, 0, '2018-03-27 16:14:45', NULL),
(112, 18, '3800.00', NULL, 0, 0, '2018-03-27 16:14:45', NULL),
(113, 19, '3800.00', NULL, 0, 0, '2018-03-27 16:14:45', NULL),
(114, 20, '3800.00', NULL, 0, 0, '2018-03-27 16:14:45', NULL),
(115, 1, '500.00', NULL, 0, 0, '2018-04-03 13:13:51', NULL),
(116, 1, '500.00', NULL, 0, 0, '2018-04-03 14:58:02', NULL),
(118, 3, '500.00', NULL, 0, 0, '2018-04-03 14:58:02', NULL),
(119, 5, '2000.00', NULL, 0, 0, '2018-04-03 14:58:03', NULL),
(120, 6, '2000.00', NULL, 0, 0, '2018-04-03 14:58:03', NULL),
(121, 7, '2000.00', NULL, 0, 0, '2018-04-03 14:58:03', NULL),
(122, 8, '2000.00', NULL, 0, 0, '2018-04-03 14:58:03', NULL),
(123, 9, '2000.00', NULL, 0, 0, '2018-04-03 14:58:03', NULL),
(124, 11, '1000.00', NULL, 0, 0, '2018-04-03 14:58:03', NULL),
(125, 12, '1000.00', NULL, 0, 0, '2018-04-03 14:58:03', NULL),
(126, 13, '1000.00', NULL, 0, 0, '2018-04-03 14:58:03', NULL),
(127, 14, '1990.00', NULL, 0, 0, '2018-04-03 14:58:03', NULL),
(128, 18, '2000.00', NULL, 0, 0, '2018-04-03 14:58:03', NULL),
(129, 19, '1000.00', NULL, 0, 0, '2018-04-03 14:58:03', NULL),
(130, 20, '1500.00', NULL, 0, 0, '2018-04-03 14:58:03', NULL),
(131, 1, '2000.00', NULL, 0, 0, '2018-04-03 15:37:48', NULL),
(132, 2, '1500.00', NULL, 0, 0, '2018-04-03 15:37:48', NULL),
(133, 3, '2000.00', NULL, 0, 0, '2018-04-03 15:37:48', NULL),
(134, 5, '3500.00', NULL, 0, 0, '2018-04-03 15:37:48', NULL),
(135, 6, '3500.00', NULL, 0, 0, '2018-04-03 15:37:48', NULL),
(136, 7, '3500.00', NULL, 0, 0, '2018-04-03 15:37:48', NULL),
(137, 8, '3500.00', NULL, 0, 0, '2018-04-03 15:37:48', NULL),
(138, 9, '3500.00', NULL, 0, 0, '2018-04-03 15:37:48', NULL),
(139, 11, '2500.00', NULL, 0, 0, '2018-04-03 15:37:48', NULL),
(140, 12, '2500.00', NULL, 0, 0, '2018-04-03 15:37:48', NULL),
(141, 13, '2500.00', NULL, 0, 0, '2018-04-03 15:37:48', NULL),
(142, 14, '3490.00', NULL, 0, 0, '2018-04-03 15:37:48', NULL),
(143, 18, '3500.00', NULL, 0, 0, '2018-04-03 15:37:48', NULL),
(144, 19, '2500.00', NULL, 0, 0, '2018-04-03 15:37:48', NULL),
(145, 20, '3000.00', NULL, 0, 0, '2018-04-03 15:37:48', NULL),
(146, 1, '24500.00', NULL, 0, 0, '2018-04-03 16:00:47', NULL),
(147, 2, '24000.00', NULL, 0, 0, '2018-04-03 16:00:47', NULL),
(148, 3, '24500.00', NULL, 0, 0, '2018-04-03 16:00:47', NULL),
(149, 5, '26000.00', NULL, 0, 0, '2018-04-03 16:00:47', NULL),
(150, 6, '26000.00', NULL, 0, 0, '2018-04-03 16:00:47', NULL),
(151, 7, '26000.00', NULL, 0, 0, '2018-04-03 16:00:47', NULL),
(152, 8, '26000.00', NULL, 0, 0, '2018-04-03 16:00:47', NULL),
(153, 9, '26000.00', NULL, 0, 0, '2018-04-03 16:00:47', NULL),
(154, 11, '25000.00', NULL, 0, 0, '2018-04-03 16:00:47', NULL),
(155, 12, '25000.00', NULL, 0, 0, '2018-04-03 16:00:47', NULL),
(156, 13, '25000.00', NULL, 0, 0, '2018-04-03 16:00:47', NULL),
(157, 14, '25990.00', NULL, 0, 0, '2018-04-03 16:00:47', NULL),
(158, 18, '26000.00', NULL, 0, 0, '2018-04-03 16:00:47', NULL),
(159, 19, '25000.00', NULL, 0, 0, '2018-04-03 16:00:47', NULL),
(160, 20, '25500.00', NULL, 0, 0, '2018-04-03 16:00:47', NULL),
(161, 10, '3000.00', NULL, 0, 0, '2018-04-03 16:06:59', NULL),
(162, 1, '500.00', NULL, 0, 0, '2018-04-03 17:28:22', NULL),
(164, 3, '500.00', NULL, 0, 0, '2018-04-03 17:28:22', NULL),
(165, 5, '2000.00', NULL, 0, 0, '2018-04-03 17:28:22', NULL),
(166, 6, '2000.00', NULL, 0, 0, '2018-04-03 17:28:22', NULL),
(167, 7, '2000.00', NULL, 0, 0, '2018-04-03 17:28:22', NULL),
(168, 8, '2000.00', NULL, 0, 0, '2018-04-03 17:28:22', NULL),
(169, 9, '2000.00', NULL, 0, 0, '2018-04-03 17:28:22', NULL),
(170, 11, '1000.00', NULL, 0, 0, '2018-04-03 17:28:22', NULL),
(171, 12, '1000.00', NULL, 0, 0, '2018-04-03 17:28:22', NULL),
(172, 13, '1000.00', NULL, 0, 0, '2018-04-03 17:28:22', NULL),
(173, 14, '1990.00', NULL, 0, 0, '2018-04-03 17:28:22', NULL),
(174, 18, '2000.00', NULL, 0, 0, '2018-04-03 17:28:22', NULL),
(175, 19, '1000.00', NULL, 0, 0, '2018-04-03 17:28:22', NULL),
(176, 20, '1500.00', NULL, 0, 0, '2018-04-03 17:28:22', NULL),
(177, 1, '500.00', NULL, 0, 0, '2018-04-03 17:30:06', NULL),
(179, 3, '500.00', NULL, 0, 0, '2018-04-03 17:30:06', NULL),
(180, 5, '2000.00', NULL, 0, 0, '2018-04-03 17:30:06', NULL),
(181, 6, '2000.00', NULL, 0, 0, '2018-04-03 17:30:06', NULL),
(182, 7, '2000.00', NULL, 0, 0, '2018-04-03 17:30:06', NULL),
(183, 8, '2000.00', NULL, 0, 0, '2018-04-03 17:30:06', NULL),
(184, 9, '2000.00', NULL, 0, 0, '2018-04-03 17:30:06', NULL),
(185, 11, '1000.00', NULL, 0, 0, '2018-04-03 17:30:06', NULL),
(186, 12, '1000.00', NULL, 0, 0, '2018-04-03 17:30:06', NULL),
(187, 13, '1000.00', NULL, 0, 0, '2018-04-03 17:30:06', NULL),
(188, 14, '1990.00', NULL, 0, 0, '2018-04-03 17:30:06', NULL),
(189, 18, '2000.00', NULL, 0, 0, '2018-04-03 17:30:06', NULL),
(190, 19, '1000.00', NULL, 0, 0, '2018-04-03 17:30:06', NULL),
(191, 20, '1500.00', NULL, 0, 0, '2018-04-03 17:30:06', NULL),
(192, 15, '18500.00', NULL, 0, 0, '2018-04-03 17:32:55', NULL),
(193, 16, '18500.00', NULL, 0, 0, '2018-04-03 17:32:55', NULL),
(194, 1, '500.00', NULL, 0, 0, '2018-04-17 17:02:52', '2018-04-19'),
(195, 2, '850.00', NULL, 0, 0, '2018-04-17 17:02:52', '2018-04-19'),
(196, 3, '1350.00', NULL, 0, 0, '2018-04-17 17:02:52', '2018-04-19'),
(197, 5, '2850.00', NULL, 0, 0, '2018-04-17 17:02:52', '2018-04-19'),
(198, 6, '2850.00', NULL, 0, 0, '2018-04-17 17:02:52', '2018-04-19'),
(199, 7, '2850.00', NULL, 0, 0, '2018-04-17 17:02:52', '2018-04-19'),
(200, 8, '2850.00', NULL, 0, 0, '2018-04-17 17:02:52', '2018-04-19'),
(201, 9, '2850.00', NULL, 0, 0, '2018-04-17 17:02:52', '2018-04-19'),
(202, 11, '1850.00', NULL, 0, 0, '2018-04-17 17:02:52', '2018-04-19'),
(203, 12, '1850.00', NULL, 0, 0, '2018-04-17 17:02:52', '2018-04-19'),
(204, 13, '1850.00', NULL, 0, 0, '2018-04-17 17:02:52', '2018-04-19'),
(205, 14, '2840.00', NULL, 0, 0, '2018-04-17 17:02:52', '2018-04-19'),
(206, 18, '2850.00', NULL, 0, 0, '2018-04-17 17:02:52', '2018-04-19'),
(207, 19, '1850.00', NULL, 0, 0, '2018-04-17 17:02:52', '2018-04-19'),
(208, 20, '2350.00', NULL, 0, 0, '2018-04-17 17:02:52', '2018-04-19'),
(209, 25, '1500.00', NULL, 0, 0, '2018-04-17 17:02:52', '2018-04-19'),
(210, 26, '1000.00', NULL, 0, 0, '2018-04-17 17:02:52', '2018-04-19'),
(211, 27, '600.00', NULL, 0, 0, '2018-04-17 17:02:52', '2018-04-19'),
(212, 1, '500.00', NULL, 0, 0, '2018-04-29 18:30:14', NULL),
(213, 2, '1450.00', NULL, 0, 0, '2018-04-29 18:30:15', NULL),
(214, 3, '1950.00', NULL, 0, 0, '2018-04-29 18:30:15', NULL),
(215, 2, '950.00', NULL, 0, 0, '2018-04-29 18:49:26', NULL),
(216, 3, '1450.00', NULL, 0, 0, '2018-04-29 18:49:26', NULL),
(217, 2, '950.00', NULL, 0, 0, '2018-04-29 18:50:41', '2018-04-10'),
(218, 3, '1450.00', NULL, 0, 0, '2018-04-29 18:50:41', '2018-04-10'),
(219, 2, '2450.00', '["April","May","June"]', 0, 0, '2018-05-01 19:25:46', NULL),
(220, 3, '2450.00', '["April","May","June"]', 0, 0, '2018-05-01 19:25:47', NULL),
(221, 5, '4450.00', '["April","May","June"]', 0, 0, '2018-05-01 19:25:47', NULL),
(222, 1, '500.00', 'null', 0, 0, '2018-05-01 22:57:46', NULL),
(223, 2, '2450.00', 'null', 0, 0, '2018-05-01 22:57:46', NULL),
(224, 3, '2450.00', 'null', 0, 0, '2018-05-01 22:57:46', NULL),
(225, 31, '1000.00', 'null', 0, 0, '2018-05-17 11:01:28', NULL),
(226, 32, '1000.00', 'null', 0, 0, '2018-05-17 11:01:28', NULL),
(227, 31, '1000.00', 'null', 0, 0, '2018-05-17 11:02:39', '2018-05-10'),
(228, 32, '1000.00', 'null', 0, 0, '2018-05-17 11:02:39', '2018-05-10'),
(229, 29, '1000.00', 'null', 0, 0, '2018-05-17 11:14:43', '2018-05-10'),
(230, 30, '2000.00', 'null', 0, 0, '2018-05-17 11:14:43', '2018-05-10'),
(231, 10, '8300.00', 'null', 0, 0, '2018-05-17 11:24:45', NULL),
(232, 28, '2350.00', 'null', 0, 0, '2018-05-17 11:24:45', NULL),
(233, 10, '6300.00', 'null', 0, 0, '2018-05-17 11:27:20', NULL),
(234, 28, '350.00', 'null', 0, 0, '2018-05-17 11:27:20', NULL),
(243, 10, '6300.00', '["May","June"]', 0, 0, '2018-05-17 11:45:35', NULL),
(244, 28, '350.00', '["May","June"]', 0, 0, '2018-05-17 11:45:35', NULL),
(245, 10, '6300.00', 'null', 0, 0, '2018-05-17 11:50:34', '2018-05-10'),
(246, 28, '350.00', 'null', 0, 0, '2018-05-17 11:50:34', '2018-05-10'),
(247, 33, '2000.00', 'null', 0, 0, '2018-05-17 11:50:34', '2018-05-10'),
(248, 10, '2000.00', 'null', 0, 0, '2018-05-17 11:57:36', NULL),
(250, 33, '2000.00', 'null', 0, 0, '2018-05-17 11:57:36', NULL),
(251, 10, '2000.00', '["May","June","July"]', 0, 0, '2018-05-17 12:02:42', NULL),
(253, 33, '2000.00', '["May","June","July"]', 0, 0, '2018-05-17 12:02:43', NULL),
(254, 10, '4000.00', 'null', 0, 0, '2018-05-17 12:51:07', NULL),
(256, 33, '4000.00', 'null', 0, 0, '2018-05-17 12:51:07', NULL),
(257, 10, '4000.00', '["May","June"]', 4300, 0, '2018-05-17 12:51:49', NULL),
(259, 33, '4000.00', '["May","June"]', 0, 0, '2018-05-17 12:51:49', NULL),
(260, 31, '3000.00', '["July","August","September"]', 0, 0, '2018-05-17 13:07:25', '2018-05-10'),
(261, 31, '1000.00', '["June"]', 2500, 0, '2018-05-17 13:08:34', '2018-05-10'),
(262, 31, '1000.00', '["June"]', 0, 0, '2018-05-17 13:08:50', '2018-05-10'),
(263, 31, '3000.00', '["June"]', 0, 0, '2018-05-17 13:09:03', '2018-05-10'),
(264, 31, '1000.00', '["June"]', 0, 0, '2018-05-17 13:09:53', '2018-05-10'),
(265, 31, '1000.00', '["June"]', 1500, 0, '2018-05-17 13:10:17', '2018-05-10'),
(266, 31, '3000.00', '["May","June","July"]', 1500, 0, '2018-05-17 13:11:29', '2018-05-10'),
(267, 31, '1000.00', '["May","June","July"]', 1500, 0, '2018-05-17 13:12:22', '2018-05-10'),
(268, 10, '4000.00', '["May","June"]', 4300, 0, '2018-05-17 13:31:18', NULL),
(270, 33, '4000.00', '["May","June"]', 0, 0, '2018-05-17 13:31:18', NULL),
(271, 10, '2000.00', 'null', 4300, 0, '2018-05-17 14:04:46', NULL),
(273, 33, '2000.00', 'null', 0, 0, '2018-05-17 14:04:46', NULL),
(274, 10, '2000.00', 'null', 4300, 0, '2018-05-17 14:05:11', '2018-05-10'),
(276, 33, '2000.00', 'null', 0, 0, '2018-05-17 14:05:11', '2018-05-10'),
(277, 10, '2000.00', 'null', 4300, 0, '2018-05-17 14:19:19', NULL),
(279, 33, '2000.00', 'null', 0, 0, '2018-05-17 14:19:19', NULL),
(280, 10, '2000.00', 'null', 4300, 0, '2018-05-17 14:36:54', '2018-05-10'),
(282, 33, '2000.00', 'null', 0, 0, '2018-05-17 14:36:54', '2018-05-10'),
(283, 30, '1000.00', '["June"]', 0, 0, '2018-05-17 14:58:32', '2018-05-10'),
(284, 30, '1000.00', '["June"]', -1000, 0, '2018-05-17 14:59:03', '2018-05-10'),
(285, 30, '1000.00', '["June"]', 0, 0, '2018-05-17 15:01:06', '2018-05-10'),
(286, 30, '3000.00', '["June","July","August"]', 0, 0, '2018-05-17 15:02:08', '2018-05-10'),
(287, 3, '500.00', 'null', 650, 0, '2018-10-01 18:25:13', '2018-10-10'),
(288, 5, '1000.00', 'null', 19750, 0, '2018-10-01 18:25:13', '2018-10-10'),
(289, 6, '1000.00', 'null', 19750, 0, '2018-10-01 18:25:13', '2018-10-10'),
(290, 7, '1000.00', 'null', 2000, 1, '2018-10-01 18:25:13', '2018-10-10'),
(291, 8, '1000.00', 'null', 2000, 1, '2018-10-01 18:25:13', '2018-10-10'),
(292, 9, '1000.00', 'null', 11150, 0, '2018-10-01 18:25:13', '2018-10-10'),
(293, 11, '0.00', 'null', 2750, 0, '2018-10-01 18:25:13', '2018-10-10'),
(294, 12, '0.00', 'null', 2750, 0, '2018-10-01 18:25:13', '2018-10-10'),
(295, 13, '0.00', 'null', 2600, 0, '2018-10-01 18:25:13', '2018-10-10'),
(296, 14, '990.00', 'null', 19430, 0, '2018-10-01 18:25:13', '2018-10-10'),
(297, 18, '1000.00', 'null', 19750, 0, '2018-10-01 18:25:13', '2018-10-10'),
(298, 19, '0.00', 'null', 2600, 0, '2018-10-01 18:25:13', '2018-10-10'),
(299, 20, '500.00', 'null', 11250, 0, '2018-10-01 18:25:13', '2018-10-10'),
(300, 25, '1000.00', 'null', 15800, 0, '2018-10-01 18:25:13', '2018-10-10'),
(301, 26, '500.00', 'null', 8300, 0, '2018-10-01 18:25:13', '2018-10-10'),
(302, 27, '500.00', 'null', 7900, 0, '2018-10-01 18:25:13', '2018-10-10'),
(303, 65, '200.00', 'null', 3300, 0, '2018-10-01 18:25:13', '2018-10-10'),
(304, 66, '300.00', 'null', 4800, 0, '2018-10-01 18:25:13', '2018-10-10'),
(305, 67, '700.00', 'null', 10800, 0, '2018-10-01 18:25:13', '2018-10-10'),
(306, 68, '650.00', 'null', 10050, 0, '2018-10-01 18:25:13', '2018-10-10'),
(307, 69, '750.00', 'null', 11550, 0, '2018-10-01 18:25:13', '2018-10-10'),
(308, 70, '800.00', 'null', 12300, 0, '2018-10-01 18:25:13', '2018-10-10'),
(309, 71, '400.00', 'null', 6300, 0, '2018-10-01 18:25:13', '2018-10-10'),
(310, 72, '750.00', 'null', 11550, 0, '2018-10-01 18:25:13', '2018-10-10'),
(311, 73, '800.00', 'null', 12300, 0, '2018-10-01 18:25:13', '2018-10-10'),
(312, 74, '550.00', 'null', 8550, 0, '2018-10-01 18:25:13', '2018-10-10'),
(313, 163, '1000.00', 'null', 2000, 0, '2018-10-01 18:25:13', '2018-10-10'),
(314, 3, '500.00', 'null', 0, 0, '2018-08-15 15:16:23', '2018-08-10'),
(315, 5, '1000.00', 'null', 19750, 0, '2018-08-15 15:16:23', '2018-08-10'),
(316, 6, '1000.00', 'null', 19750, 0, '2018-08-15 15:16:23', '2018-08-10'),
(317, 7, '1000.00', 'null', 2000, 0, '2018-08-15 15:16:23', '2018-08-10'),
(318, 8, '1000.00', 'null', 0, 0, '2018-08-15 15:16:23', '2018-08-10'),
(319, 9, '1000.00', 'null', 11150, 0, '2018-08-15 15:16:23', '2018-08-10'),
(320, 11, '0.00', 'null', 2750, 0, '2018-08-15 15:16:23', '2018-08-10'),
(321, 12, '0.00', 'null', 2750, 0, '2018-08-15 15:16:23', '2018-08-10'),
(322, 13, '0.00', 'null', 2600, 0, '2018-08-15 15:16:23', '2018-08-10'),
(323, 14, '990.00', 'null', 19430, 0, '2018-08-15 15:16:23', '2018-08-10'),
(324, 18, '1000.00', 'null', 19750, 0, '2018-08-15 15:16:23', '2018-08-10'),
(325, 19, '0.00', 'null', 2600, 0, '2018-08-15 15:16:23', '2018-08-10'),
(326, 20, '500.00', 'null', 11250, 0, '2018-08-15 15:16:23', '2018-08-10'),
(327, 25, '1000.00', 'null', 15800, 0, '2018-08-15 15:16:23', '2018-08-10'),
(328, 26, '500.00', 'null', 8300, 0, '2018-08-15 15:16:23', '2018-08-10'),
(329, 27, '500.00', 'null', 7900, 0, '2018-08-15 15:16:23', '2018-08-10'),
(330, 65, '200.00', 'null', 3300, 0, '2018-08-15 15:16:23', '2018-08-10'),
(331, 66, '300.00', 'null', 4800, 0, '2018-08-15 15:16:23', '2018-08-10'),
(332, 67, '700.00', 'null', 10800, 0, '2018-08-15 15:16:23', '2018-08-10'),
(333, 68, '650.00', 'null', 10050, 0, '2018-08-15 15:16:23', '2018-08-10'),
(334, 69, '750.00', 'null', 11550, 0, '2018-08-15 15:16:23', '2018-08-10'),
(335, 70, '800.00', 'null', 12300, 0, '2018-08-15 15:16:23', '2018-08-10'),
(336, 71, '400.00', 'null', 6300, 0, '2018-08-15 15:16:23', '2018-08-10'),
(337, 72, '750.00', 'null', 11550, 0, '2018-08-15 15:16:23', '2018-08-10'),
(338, 73, '800.00', 'null', 12300, 0, '2018-08-15 15:16:23', '2018-08-10'),
(339, 74, '550.00', 'null', 8550, 0, '2018-08-15 15:16:23', '2018-08-10'),
(340, 163, '1000.00', 'null', 2000, 0, '2018-08-15 15:16:23', '2018-08-10'),
(341, 3, '500.00', 'null', 0, 0, '2018-08-15 15:19:48', '2018-08-10'),
(342, 5, '1000.00', 'null', 19750, 0, '2018-08-15 15:19:48', '2018-08-10'),
(343, 6, '1000.00', 'null', 19750, 0, '2018-08-15 15:19:48', '2018-08-10'),
(344, 7, '1000.00', 'null', 2000, 0, '2018-08-15 15:19:48', '2018-08-10'),
(345, 8, '1000.00', 'null', 0, 0, '2018-08-15 15:19:48', '2018-08-10'),
(346, 9, '1000.00', 'null', 11150, 0, '2018-08-15 15:19:48', '2018-08-10'),
(347, 11, '0.00', 'null', 2750, 0, '2018-08-15 15:19:48', '2018-08-10'),
(348, 12, '0.00', 'null', 2750, 0, '2018-08-15 15:19:48', '2018-08-10'),
(349, 13, '0.00', 'null', 2600, 0, '2018-08-15 15:19:48', '2018-08-10'),
(350, 14, '990.00', 'null', 19430, 0, '2018-08-15 15:19:48', '2018-08-10'),
(351, 18, '1000.00', 'null', 19750, 0, '2018-08-15 15:19:48', '2018-08-10'),
(352, 19, '0.00', 'null', 2600, 0, '2018-08-15 15:19:48', '2018-08-10'),
(353, 20, '500.00', 'null', 11250, 0, '2018-08-15 15:19:48', '2018-08-10'),
(354, 25, '1000.00', 'null', 15800, 0, '2018-08-15 15:19:48', '2018-08-10'),
(355, 26, '500.00', 'null', 8300, 0, '2018-08-15 15:19:48', '2018-08-10'),
(356, 27, '500.00', 'null', 7900, 0, '2018-08-15 15:19:48', '2018-08-10'),
(357, 65, '200.00', 'null', 3300, 0, '2018-08-15 15:19:48', '2018-08-10'),
(358, 66, '300.00', 'null', 4800, 0, '2018-08-15 15:19:48', '2018-08-10'),
(359, 67, '700.00', 'null', 10800, 0, '2018-08-15 15:19:48', '2018-08-10'),
(360, 68, '650.00', 'null', 10050, 0, '2018-08-15 15:19:48', '2018-08-10'),
(361, 69, '750.00', 'null', 11550, 0, '2018-08-15 15:19:48', '2018-08-10'),
(362, 70, '800.00', 'null', 12300, 0, '2018-08-15 15:19:48', '2018-08-10'),
(363, 71, '400.00', 'null', 6300, 0, '2018-08-15 15:19:48', '2018-08-10'),
(364, 72, '750.00', 'null', 11550, 0, '2018-08-15 15:19:48', '2018-08-10'),
(365, 73, '800.00', 'null', 12300, 0, '2018-08-15 15:19:48', '2018-08-10'),
(366, 74, '550.00', 'null', 8550, 0, '2018-08-15 15:19:48', '2018-08-10'),
(367, 163, '1000.00', 'null', 2000, 0, '2018-08-15 15:19:48', '2018-08-10'),
(368, 3, '500.00', 'null', 0, 0, '2018-08-15 15:20:03', '2018-08-10'),
(369, 5, '1000.00', 'null', 19750, 0, '2018-08-15 15:20:03', '2018-08-10'),
(370, 6, '1000.00', 'null', 19750, 0, '2018-08-15 15:20:03', '2018-08-10'),
(371, 7, '1000.00', 'null', 2000, 0, '2018-08-15 15:20:03', '2018-08-10'),
(372, 8, '1000.00', 'null', 0, 0, '2018-08-15 15:20:03', '2018-08-10'),
(373, 9, '1000.00', 'null', 11150, 0, '2018-08-15 15:20:03', '2018-08-10'),
(374, 11, '0.00', 'null', 2750, 0, '2018-08-15 15:20:03', '2018-08-10'),
(375, 12, '0.00', 'null', 2750, 0, '2018-08-15 15:20:03', '2018-08-10'),
(376, 13, '0.00', 'null', 2600, 0, '2018-08-15 15:20:03', '2018-08-10'),
(377, 14, '990.00', 'null', 19430, 0, '2018-08-15 15:20:03', '2018-08-10'),
(378, 18, '1000.00', 'null', 19750, 0, '2018-08-15 15:20:03', '2018-08-10'),
(379, 19, '0.00', 'null', 2600, 0, '2018-08-15 15:20:03', '2018-08-10'),
(380, 20, '500.00', 'null', 11250, 0, '2018-08-15 15:20:03', '2018-08-10'),
(381, 25, '1000.00', 'null', 15800, 0, '2018-08-15 15:20:03', '2018-08-10'),
(382, 26, '500.00', 'null', 8300, 0, '2018-08-15 15:20:03', '2018-08-10'),
(383, 27, '500.00', 'null', 7900, 0, '2018-08-15 15:20:03', '2018-08-10'),
(384, 65, '200.00', 'null', 3300, 0, '2018-08-15 15:20:03', '2018-08-10'),
(385, 66, '300.00', 'null', 4800, 0, '2018-08-15 15:20:03', '2018-08-10'),
(386, 67, '700.00', 'null', 10800, 0, '2018-08-15 15:20:03', '2018-08-10'),
(387, 68, '650.00', 'null', 10050, 0, '2018-08-15 15:20:03', '2018-08-10'),
(388, 69, '750.00', 'null', 11550, 0, '2018-08-15 15:20:03', '2018-08-10'),
(389, 70, '800.00', 'null', 12300, 0, '2018-08-15 15:20:03', '2018-08-10'),
(390, 71, '400.00', 'null', 6300, 0, '2018-08-15 15:20:03', '2018-08-10'),
(391, 72, '750.00', 'null', 11550, 0, '2018-08-15 15:20:03', '2018-08-10'),
(392, 73, '800.00', 'null', 12300, 0, '2018-08-15 15:20:03', '2018-08-10'),
(393, 74, '550.00', 'null', 8550, 0, '2018-08-15 15:20:03', '2018-08-10'),
(394, 163, '1000.00', 'null', 2000, 0, '2018-08-15 15:20:03', '2018-08-10'),
(395, 3, '500.00', 'null', 0, 0, '2018-08-15 15:21:52', '2018-08-10'),
(396, 5, '1000.00', 'null', 19750, 0, '2018-08-15 15:21:52', '2018-08-10'),
(397, 6, '1000.00', 'null', 19750, 0, '2018-08-15 15:21:52', '2018-08-10'),
(398, 7, '1000.00', 'null', 2000, 0, '2018-08-15 15:21:52', '2018-08-10'),
(399, 8, '1000.00', 'null', 0, 0, '2018-08-15 15:21:52', '2018-08-10'),
(400, 9, '1000.00', 'null', 11150, 0, '2018-08-15 15:21:52', '2018-08-10'),
(401, 11, '0.00', 'null', 2750, 0, '2018-08-15 15:21:52', '2018-08-10'),
(402, 12, '0.00', 'null', 2750, 0, '2018-08-15 15:21:52', '2018-08-10'),
(403, 13, '0.00', 'null', 2600, 0, '2018-08-15 15:21:52', '2018-08-10'),
(404, 14, '990.00', 'null', 19430, 0, '2018-08-15 15:21:52', '2018-08-10'),
(405, 18, '1000.00', 'null', 19750, 0, '2018-08-15 15:21:52', '2018-08-10'),
(406, 19, '0.00', 'null', 2600, 0, '2018-08-15 15:21:52', '2018-08-10'),
(407, 20, '500.00', 'null', 11250, 0, '2018-08-15 15:21:52', '2018-08-10'),
(408, 25, '1000.00', 'null', 15800, 0, '2018-08-15 15:21:52', '2018-08-10'),
(409, 26, '500.00', 'null', 8300, 0, '2018-08-15 15:21:52', '2018-08-10'),
(410, 27, '500.00', 'null', 7900, 0, '2018-08-15 15:21:52', '2018-08-10'),
(411, 65, '200.00', 'null', 3300, 0, '2018-08-15 15:21:52', '2018-08-10'),
(412, 66, '300.00', 'null', 4800, 0, '2018-08-15 15:21:52', '2018-08-10'),
(413, 67, '700.00', 'null', 10800, 0, '2018-08-15 15:21:52', '2018-08-10'),
(414, 68, '650.00', 'null', 10050, 0, '2018-08-15 15:21:52', '2018-08-10'),
(415, 69, '750.00', 'null', 11550, 0, '2018-08-15 15:21:52', '2018-08-10'),
(416, 70, '800.00', 'null', 12300, 0, '2018-08-15 15:21:52', '2018-08-10'),
(417, 71, '400.00', 'null', 6300, 0, '2018-08-15 15:21:52', '2018-08-10'),
(418, 72, '750.00', 'null', 11550, 0, '2018-08-15 15:21:52', '2018-08-10'),
(419, 73, '800.00', 'null', 12300, 0, '2018-08-15 15:21:52', '2018-08-10'),
(420, 74, '550.00', 'null', 8550, 0, '2018-08-15 15:21:52', '2018-08-10'),
(421, 163, '1000.00', 'null', 2000, 0, '2018-08-15 15:21:52', '2018-08-10'),
(422, 3, '500.00', 'null', 0, 0, '2018-08-15 15:36:05', '2018-08-10'),
(423, 5, '1000.00', 'null', 19750, 0, '2018-08-15 15:36:05', '2018-08-10'),
(424, 6, '1000.00', 'null', 19750, 0, '2018-08-15 15:36:05', '2018-08-10'),
(425, 7, '1000.00', 'null', 2000, 0, '2018-08-15 15:36:05', '2018-08-10'),
(426, 8, '1000.00', 'null', 0, 0, '2018-08-15 15:36:05', '2018-08-10'),
(427, 9, '1000.00', 'null', 11150, 0, '2018-08-15 15:36:05', '2018-08-10'),
(428, 11, '0.00', 'null', 2750, 0, '2018-08-15 15:36:05', '2018-08-10'),
(429, 12, '0.00', 'null', 2750, 0, '2018-08-15 15:36:05', '2018-08-10'),
(430, 13, '0.00', 'null', 2600, 0, '2018-08-15 15:36:05', '2018-08-10'),
(431, 14, '990.00', 'null', 19430, 0, '2018-08-15 15:36:05', '2018-08-10'),
(432, 18, '1000.00', 'null', 19750, 0, '2018-08-15 15:36:05', '2018-08-10'),
(433, 19, '0.00', 'null', 2600, 0, '2018-08-15 15:36:05', '2018-08-10'),
(434, 20, '500.00', 'null', 11250, 0, '2018-08-15 15:36:05', '2018-08-10'),
(435, 25, '1000.00', 'null', 15800, 0, '2018-08-15 15:36:05', '2018-08-10'),
(436, 26, '500.00', 'null', 8300, 0, '2018-08-15 15:36:05', '2018-08-10'),
(437, 27, '500.00', 'null', 7900, 0, '2018-08-15 15:36:05', '2018-08-10'),
(438, 65, '200.00', 'null', 3300, 0, '2018-08-15 15:36:05', '2018-08-10'),
(439, 66, '300.00', 'null', 4800, 0, '2018-08-15 15:36:05', '2018-08-10'),
(440, 67, '700.00', 'null', 10800, 0, '2018-08-15 15:36:05', '2018-08-10'),
(441, 68, '650.00', 'null', 10050, 0, '2018-08-15 15:36:05', '2018-08-10'),
(442, 69, '750.00', 'null', 11550, 0, '2018-08-15 15:36:05', '2018-08-10'),
(443, 70, '800.00', 'null', 12300, 0, '2018-08-15 15:36:05', '2018-08-10'),
(444, 71, '400.00', 'null', 6300, 0, '2018-08-15 15:36:05', '2018-08-10'),
(445, 72, '750.00', 'null', 11550, 0, '2018-08-15 15:36:05', '2018-08-10'),
(446, 73, '800.00', 'null', 12300, 0, '2018-08-15 15:36:05', '2018-08-10'),
(447, 74, '550.00', 'null', 8550, 0, '2018-08-15 15:36:05', '2018-08-10'),
(448, 163, '1000.00', 'null', 2000, 0, '2018-08-15 15:36:05', '2018-08-10'),
(449, 3, '500.00', 'null', 0, 0, '2018-08-15 15:56:29', '2018-08-10'),
(450, 5, '1000.00', 'null', 19750, 0, '2018-08-15 15:56:29', '2018-08-10'),
(451, 6, '1000.00', 'null', 19750, 0, '2018-08-15 15:56:29', '2018-08-10'),
(452, 7, '1000.00', 'null', 2000, 0, '2018-08-15 15:56:29', '2018-08-10'),
(453, 8, '1000.00', 'null', 0, 0, '2018-08-15 15:56:29', '2018-08-10'),
(454, 9, '1000.00', 'null', 11150, 0, '2018-08-15 15:56:29', '2018-08-10'),
(455, 11, '0.00', 'null', 2750, 0, '2018-08-15 15:56:29', '2018-08-10'),
(456, 12, '0.00', 'null', 2750, 0, '2018-08-15 15:56:29', '2018-08-10'),
(457, 13, '0.00', 'null', 2600, 0, '2018-08-15 15:56:29', '2018-08-10'),
(458, 14, '990.00', 'null', 19430, 0, '2018-08-15 15:56:29', '2018-08-10'),
(459, 18, '1000.00', 'null', 19750, 0, '2018-08-15 15:56:29', '2018-08-10'),
(460, 19, '0.00', 'null', 2600, 0, '2018-08-15 15:56:29', '2018-08-10'),
(461, 20, '500.00', 'null', 11250, 0, '2018-08-15 15:56:29', '2018-08-10'),
(462, 25, '1000.00', 'null', 15800, 0, '2018-08-15 15:56:29', '2018-08-10'),
(463, 26, '500.00', 'null', 8300, 0, '2018-08-15 15:56:29', '2018-08-10'),
(464, 27, '500.00', 'null', 7900, 0, '2018-08-15 15:56:29', '2018-08-10'),
(465, 65, '200.00', 'null', 3300, 0, '2018-08-15 15:56:29', '2018-08-10'),
(466, 66, '300.00', 'null', 4800, 0, '2018-08-15 15:56:29', '2018-08-10'),
(467, 67, '700.00', 'null', 10800, 0, '2018-08-15 15:56:29', '2018-08-10'),
(468, 68, '650.00', 'null', 10050, 0, '2018-08-15 15:56:29', '2018-08-10'),
(469, 69, '750.00', 'null', 11550, 0, '2018-08-15 15:56:29', '2018-08-10'),
(470, 70, '800.00', 'null', 12300, 0, '2018-08-15 15:56:29', '2018-08-10'),
(471, 71, '400.00', 'null', 6300, 0, '2018-08-15 15:56:29', '2018-08-10'),
(472, 72, '750.00', 'null', 11550, 0, '2018-08-15 15:56:29', '2018-08-10'),
(473, 73, '800.00', 'null', 12300, 0, '2018-08-15 15:56:29', '2018-08-10'),
(474, 74, '550.00', 'null', 8550, 0, '2018-08-15 15:56:29', '2018-08-10'),
(475, 163, '1000.00', 'null', 2000, 0, '2018-08-15 15:56:29', '2018-08-10'),
(476, 5, '1000.00', 'null', 19750, 0, '2018-08-15 15:57:27', '2018-08-10'),
(477, 5, '1000.00', 'null', 19750, 0, '2018-08-15 16:20:15', '2018-08-10'),
(478, 5, '1000.00', 'null', 19750, 0, '2018-08-15 16:20:26', '2018-08-10'),
(479, 6, '1000.00', 'null', 19750, 0, '2018-08-15 16:34:39', '2018-08-10'),
(480, 1, '1500.00', 'null', 0, 1, '2018-08-28 12:33:56', '2018-08-10'),
(481, 11, '1500.00', 'null', 0, 0, '2018-08-28 12:33:56', '2018-08-10'),
(482, 3, '300.00', 'null', 0, 0, '2018-08-30 11:46:27', '2018-08-10'),
(483, 5, '1000.00', 'null', 1000, 0, '2018-08-30 11:46:27', '2018-08-10'),
(484, 6, '1000.00', 'null', 20750, 0, '2018-08-30 11:46:27', '2018-08-10'),
(485, 7, '1000.00', 'null', 0, 0, '2018-08-30 11:46:27', '2018-08-10'),
(486, 9, '1000.00', 'null', 12150, 0, '2018-08-30 11:46:27', '2018-08-10'),
(487, 11, '0.00', 'null', 2750, 0, '2018-08-30 11:46:27', '2018-08-10'),
(488, 12, '0.00', 'null', 2750, 0, '2018-08-30 11:46:27', '2018-08-10'),
(489, 13, '0.00', 'null', 2600, 0, '2018-08-30 11:46:27', '2018-08-10'),
(490, 14, '990.00', 'null', 20420, 0, '2018-08-30 11:46:27', '2018-08-10'),
(491, 18, '1000.00', 'null', 20750, 0, '2018-08-30 11:46:27', '2018-08-10'),
(492, 19, '0.00', 'null', 2600, 0, '2018-08-30 11:46:27', '2018-08-10'),
(493, 20, '500.00', 'null', 12250, 0, '2018-08-30 11:46:27', '2018-08-10'),
(494, 25, '1000.00', 'null', 16800, 0, '2018-08-30 11:46:27', '2018-08-10'),
(495, 26, '500.00', 'null', 8800, 0, '2018-08-30 11:46:27', '2018-08-10'),
(496, 27, '500.00', 'null', 8400, 0, '2018-08-30 11:46:27', '2018-08-10'),
(497, 65, '200.00', 'null', 3500, 0, '2018-08-30 11:46:27', '2018-08-10'),
(498, 66, '300.00', 'null', 5100, 0, '2018-08-30 11:46:27', '2018-08-10'),
(499, 67, '700.00', 'null', 11500, 0, '2018-08-30 11:46:27', '2018-08-10'),
(500, 68, '650.00', 'null', 10700, 0, '2018-08-30 11:46:27', '2018-08-10'),
(501, 69, '750.00', 'null', 12300, 0, '2018-08-30 11:46:27', '2018-08-10'),
(502, 70, '800.00', 'null', 13100, 0, '2018-08-30 11:46:27', '2018-08-10'),
(503, 71, '400.00', 'null', 6700, 0, '2018-08-30 11:46:27', '2018-08-10'),
(504, 72, '750.00', 'null', 12300, 0, '2018-08-30 11:46:27', '2018-08-10'),
(505, 73, '800.00', 'null', 13100, 0, '2018-08-30 11:46:27', '2018-08-10'),
(506, 74, '550.00', 'null', 9100, 0, '2018-08-30 11:46:27', '2018-08-10'),
(507, 163, '1000.00', 'null', 3000, 0, '2018-08-30 11:46:27', '2018-08-10'),
(508, 166, '1000.00', 'null', 0, 0, '2018-08-30 11:46:27', '2018-08-10'),
(509, 3, '300.00', 'null', 0, 0, '2018-08-30 14:45:30', '2018-08-10'),
(510, 5, '1000.00', 'null', 1000, 0, '2018-08-30 14:45:30', '2018-08-10'),
(511, 6, '1000.00', 'null', 20750, 0, '2018-08-30 14:45:30', '2018-08-10'),
(512, 7, '1000.00', 'null', 0, 0, '2018-08-30 14:45:30', '2018-08-10'),
(513, 9, '1000.00', 'null', 12150, 0, '2018-08-30 14:45:30', '2018-08-10'),
(514, 11, '0.00', 'null', 2750, 0, '2018-08-30 14:45:30', '2018-08-10'),
(515, 12, '0.00', 'null', 2750, 0, '2018-08-30 14:45:30', '2018-08-10'),
(516, 13, '0.00', 'null', 2600, 0, '2018-08-30 14:45:30', '2018-08-10'),
(517, 14, '990.00', 'null', 20420, 0, '2018-08-30 14:45:30', '2018-08-10'),
(518, 18, '1000.00', 'null', 20750, 0, '2018-08-30 14:45:30', '2018-08-10'),
(519, 19, '0.00', 'null', 2600, 0, '2018-08-30 14:45:30', '2018-08-10'),
(520, 20, '500.00', 'null', 12250, 0, '2018-08-30 14:45:30', '2018-08-10'),
(521, 25, '1000.00', 'null', 16800, 0, '2018-08-30 14:45:30', '2018-08-10'),
(522, 26, '500.00', 'null', 8800, 0, '2018-08-30 14:45:30', '2018-08-10'),
(523, 27, '500.00', 'null', 8400, 0, '2018-08-30 14:45:30', '2018-08-10'),
(524, 65, '200.00', 'null', 3500, 0, '2018-08-30 14:45:30', '2018-08-10'),
(525, 66, '300.00', 'null', 5100, 0, '2018-08-30 14:45:30', '2018-08-10'),
(526, 67, '700.00', 'null', 11500, 0, '2018-08-30 14:45:30', '2018-08-10'),
(527, 68, '650.00', 'null', 10700, 0, '2018-08-30 14:45:30', '2018-08-10'),
(528, 69, '750.00', 'null', 12300, 0, '2018-08-30 14:45:30', '2018-08-10'),
(529, 70, '800.00', 'null', 13100, 0, '2018-08-30 14:45:30', '2018-08-10'),
(530, 71, '400.00', 'null', 6700, 0, '2018-08-30 14:45:30', '2018-08-10'),
(531, 72, '750.00', 'null', 12300, 0, '2018-08-30 14:45:30', '2018-08-10'),
(532, 73, '800.00', 'null', 13100, 0, '2018-08-30 14:45:30', '2018-08-10'),
(533, 74, '550.00', 'null', 9100, 0, '2018-08-30 14:45:30', '2018-08-10'),
(534, 163, '1000.00', 'null', 3000, 0, '2018-08-30 14:45:30', '2018-08-10'),
(535, 166, '1000.00', 'null', 0, 0, '2018-08-30 14:45:30', '2018-08-10'),
(536, 3, '300.00', '["August"]', 0, 0, '2018-08-30 18:19:02', '2018-08-10'),
(537, 5, '1000.00', '["August"]', 1000, 0, '2018-08-30 18:19:03', '2018-08-10'),
(538, 6, '1000.00', '["August"]', 20750, 0, '2018-08-30 18:19:03', '2018-08-10'),
(539, 7, '1000.00', '["August"]', 0, 0, '2018-08-30 18:19:03', '2018-08-10'),
(540, 9, '1000.00', '["August"]', 12150, 0, '2018-08-30 18:19:03', '2018-08-10'),
(541, 11, '0.00', '["August"]', 2750, 0, '2018-08-30 18:19:03', '2018-08-10'),
(542, 12, '0.00', '["August"]', 2750, 0, '2018-08-30 18:19:03', '2018-08-10'),
(543, 13, '0.00', '["August"]', 2600, 0, '2018-08-30 18:19:03', '2018-08-10'),
(544, 14, '990.00', '["August"]', 20420, 0, '2018-08-30 18:19:03', '2018-08-10'),
(545, 18, '1000.00', '["August"]', 20750, 0, '2018-08-30 18:19:03', '2018-08-10'),
(546, 19, '0.00', '["August"]', 2600, 0, '2018-08-30 18:19:03', '2018-08-10'),
(547, 20, '500.00', '["August"]', 12250, 0, '2018-08-30 18:19:03', '2018-08-10'),
(548, 25, '1000.00', '["August"]', 16800, 0, '2018-08-30 18:19:03', '2018-08-10'),
(549, 26, '500.00', '["August"]', 8800, 0, '2018-08-30 18:19:03', '2018-08-10'),
(550, 27, '500.00', '["August"]', 8400, 0, '2018-08-30 18:19:03', '2018-08-10'),
(551, 65, '200.00', '["August"]', 3500, 0, '2018-08-30 18:19:03', '2018-08-10'),
(552, 66, '300.00', '["August"]', 5100, 0, '2018-08-30 18:19:03', '2018-08-10'),
(553, 67, '700.00', '["August"]', 11500, 0, '2018-08-30 18:19:03', '2018-08-10'),
(554, 68, '650.00', '["August"]', 10700, 0, '2018-08-30 18:19:03', '2018-08-10'),
(555, 69, '750.00', '["August"]', 12300, 0, '2018-08-30 18:19:03', '2018-08-10'),
(556, 70, '800.00', '["August"]', 13100, 0, '2018-08-30 18:19:03', '2018-08-10'),
(557, 71, '400.00', '["August"]', 6700, 0, '2018-08-30 18:19:03', '2018-08-10'),
(558, 72, '750.00', '["August"]', 12300, 0, '2018-08-30 18:19:03', '2018-08-10'),
(559, 73, '800.00', '["August"]', 13100, 0, '2018-08-30 18:19:03', '2018-08-10'),
(560, 74, '550.00', '["August"]', 9100, 0, '2018-08-30 18:19:03', '2018-08-10'),
(561, 163, '1000.00', '["August"]', 3000, 0, '2018-08-30 18:19:03', '2018-08-10'),
(562, 166, '1000.00', '["August"]', 0, 0, '2018-08-30 18:19:03', '2018-08-10'),
(563, 3, '300.00', 'null', 0, 0, '2018-08-30 18:31:50', '2018-08-10'),
(564, 5, '1000.00', 'null', 1000, 0, '2018-08-30 18:31:50', '2018-08-10'),
(565, 6, '1000.00', 'null', 20750, 0, '2018-08-30 18:31:50', '2018-08-10'),
(566, 7, '1000.00', 'null', 0, 0, '2018-08-30 18:31:50', '2018-08-10'),
(567, 9, '1000.00', 'null', 12150, 0, '2018-08-30 18:31:50', '2018-08-10'),
(568, 11, '0.00', 'null', 2750, 0, '2018-08-30 18:31:50', '2018-08-10'),
(569, 12, '0.00', 'null', 2750, 0, '2018-08-30 18:31:50', '2018-08-10'),
(570, 13, '0.00', 'null', 2600, 0, '2018-08-30 18:31:50', '2018-08-10'),
(571, 14, '990.00', 'null', 20420, 0, '2018-08-30 18:31:50', '2018-08-10'),
(572, 18, '1000.00', 'null', 20750, 0, '2018-08-30 18:31:50', '2018-08-10'),
(573, 19, '0.00', 'null', 2600, 0, '2018-08-30 18:31:50', '2018-08-10'),
(574, 20, '500.00', 'null', 12250, 0, '2018-08-30 18:31:50', '2018-08-10'),
(575, 25, '1000.00', 'null', 16800, 0, '2018-08-30 18:31:50', '2018-08-10'),
(576, 26, '500.00', 'null', 8800, 0, '2018-08-30 18:31:50', '2018-08-10'),
(577, 27, '500.00', 'null', 8400, 0, '2018-08-30 18:31:51', '2018-08-10'),
(578, 65, '200.00', 'null', 3500, 0, '2018-08-30 18:31:51', '2018-08-10'),
(579, 66, '300.00', 'null', 5100, 0, '2018-08-30 18:31:51', '2018-08-10'),
(580, 67, '700.00', 'null', 11500, 0, '2018-08-30 18:31:51', '2018-08-10'),
(581, 68, '650.00', 'null', 10700, 0, '2018-08-30 18:31:51', '2018-08-10'),
(582, 69, '750.00', 'null', 12300, 0, '2018-08-30 18:31:51', '2018-08-10'),
(583, 70, '800.00', 'null', 13100, 0, '2018-08-30 18:31:51', '2018-08-10'),
(584, 71, '400.00', 'null', 6700, 0, '2018-08-30 18:31:51', '2018-08-10'),
(585, 72, '750.00', 'null', 12300, 0, '2018-08-30 18:31:51', '2018-08-10'),
(586, 73, '800.00', 'null', 13100, 0, '2018-08-30 18:31:51', '2018-08-10'),
(587, 74, '550.00', 'null', 9100, 0, '2018-08-30 18:31:51', '2018-08-10'),
(588, 163, '1000.00', 'null', 3000, 0, '2018-08-30 18:31:51', '2018-08-10'),
(589, 166, '1000.00', 'null', 0, 0, '2018-08-30 18:31:51', '2018-08-10'),
(590, 3, '300.00', '["August"]', 0, 0, '2018-08-30 18:33:02', '2018-08-10'),
(591, 5, '1000.00', '["August"]', 1000, 0, '2018-08-30 18:33:02', '2018-08-10'),
(592, 6, '1000.00', '["August"]', 20750, 0, '2018-08-30 18:33:02', '2018-08-10'),
(593, 7, '1000.00', '["August"]', 0, 0, '2018-08-30 18:33:02', '2018-08-10'),
(594, 9, '1000.00', '["August"]', 12150, 0, '2018-08-30 18:33:02', '2018-08-10'),
(595, 11, '0.00', '["August"]', 2750, 0, '2018-08-30 18:33:02', '2018-08-10'),
(596, 12, '0.00', '["August"]', 2750, 0, '2018-08-30 18:33:02', '2018-08-10'),
(597, 13, '0.00', '["August"]', 2600, 0, '2018-08-30 18:33:02', '2018-08-10'),
(598, 14, '990.00', '["August"]', 20420, 0, '2018-08-30 18:33:02', '2018-08-10'),
(599, 18, '1000.00', '["August"]', 20750, 0, '2018-08-30 18:33:02', '2018-08-10'),
(600, 19, '0.00', '["August"]', 2600, 0, '2018-08-30 18:33:02', '2018-08-10'),
(601, 20, '500.00', '["August"]', 12250, 0, '2018-08-30 18:33:02', '2018-08-10'),
(602, 25, '1000.00', '["August"]', 16800, 0, '2018-08-30 18:33:02', '2018-08-10'),
(603, 26, '500.00', '["August"]', 8800, 0, '2018-08-30 18:33:02', '2018-08-10'),
(604, 27, '500.00', '["August"]', 8400, 0, '2018-08-30 18:33:02', '2018-08-10'),
(605, 65, '200.00', '["August"]', 3500, 0, '2018-08-30 18:33:02', '2018-08-10'),
(606, 66, '300.00', '["August"]', 5100, 0, '2018-08-30 18:33:02', '2018-08-10'),
(607, 67, '700.00', '["August"]', 11500, 0, '2018-08-30 18:33:02', '2018-08-10'),
(608, 68, '650.00', '["August"]', 10700, 0, '2018-08-30 18:33:02', '2018-08-10'),
(609, 69, '750.00', '["August"]', 12300, 0, '2018-08-30 18:33:02', '2018-08-10'),
(610, 70, '800.00', '["August"]', 13100, 0, '2018-08-30 18:33:02', '2018-08-10'),
(611, 71, '400.00', '["August"]', 6700, 0, '2018-08-30 18:33:02', '2018-08-10'),
(612, 72, '750.00', '["August"]', 12300, 0, '2018-08-30 18:33:02', '2018-08-10'),
(613, 73, '800.00', '["August"]', 13100, 0, '2018-08-30 18:33:02', '2018-08-10'),
(614, 74, '550.00', '["August"]', 9100, 0, '2018-08-30 18:33:02', '2018-08-10'),
(615, 163, '1000.00', '["August"]', 3000, 0, '2018-08-30 18:33:02', '2018-08-10'),
(616, 166, '1000.00', '["August"]', 0, 0, '2018-08-30 18:33:02', '2018-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `student_fee_voucher_fee_types`
--

CREATE TABLE `student_fee_voucher_fee_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_fee_voucher_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_fee_voucher_fee_types`
--

INSERT INTO `student_fee_voucher_fee_types` (`id`, `student_fee_voucher_id`, `name`, `amount`) VALUES
(1, 1, 'Tuition Fee', '1000.00'),
(2, 1, 'Admission fee', '500.00'),
(3, 1, 'Computer fee', '1000.00'),
(4, 2, 'Tuition Fee', '1000.00'),
(5, 2, 'Admission fee', '500.00'),
(6, 2, 'Computer fee', '1000.00'),
(7, 3, 'Tuition Fee', '1000.00'),
(8, 3, 'Admission fee', '500.00'),
(9, 3, 'Computer fee', '1000.00'),
(10, 4, 'Tuition Fee', '1000.00'),
(11, 4, 'Admission fee', '500.00'),
(12, 4, 'Computer fee', '1000.00'),
(13, 5, 'Tuition Fee', '1000.00'),
(14, 5, 'Admission fee', '500.00'),
(15, 5, 'Computer fee', '1000.00'),
(16, 6, 'Tuition Fee', '1000.00'),
(17, 6, 'Admission fee', '500.00'),
(18, 6, 'Computer fee', '1000.00'),
(19, 7, 'Tuition Fee', '1000.00'),
(20, 7, 'Admission fee', '500.00'),
(21, 7, 'Computer fee', '1000.00'),
(22, 8, 'Tuition Fee', '1000.00'),
(23, 8, 'Admission fee', '500.00'),
(24, 8, 'Computer fee', '1000.00'),
(25, 9, 'Tuition Fee', '1000.00'),
(26, 9, 'Admission fee', '500.00'),
(27, 9, 'Computer fee', '1000.00'),
(28, 10, 'Tuition Fee', '1000.00'),
(29, 10, 'Admission fee', '500.00'),
(30, 10, 'Computer fee', '1000.00'),
(31, 11, 'Tuition Fee', '1000.00'),
(32, 11, 'Admission fee', '500.00'),
(33, 11, 'Computer fee', '1000.00'),
(34, 12, 'Tuition Fee', '1000.00'),
(35, 12, 'Admission fee', '500.00'),
(36, 12, 'Computer fee', '1000.00'),
(37, 13, 'Tuition Fee', '1000.00'),
(38, 13, 'Admission fee', '500.00'),
(39, 13, 'Computer fee', '1000.00'),
(40, 14, 'Tuition Fee', '1000.00'),
(41, 14, 'Admission fee', '500.00'),
(42, 14, 'Computer fee', '1000.00'),
(43, 15, 'Tuition Fee', '1000.00'),
(44, 15, 'Admission fee', '500.00'),
(45, 15, 'Computer fee', '1000.00'),
(46, 16, 'Tuition Fee', '2000.00'),
(47, 16, 'Admission fee', '500.00'),
(48, 16, 'Computer fee', '1000.00'),
(49, 17, 'Tuition Fee', '3000.00'),
(50, 17, 'Admission fee', '500.00'),
(51, 17, 'Computer fee', '1000.00'),
(52, 18, 'Tuition Fee', '15000.00'),
(53, 18, 'Admission fee', '500.00'),
(54, 18, 'Computer fee', '1000.00'),
(55, 19, 'Tuition Fee', '15000.00'),
(56, 19, 'Admission fee', '500.00'),
(57, 19, 'Computer fee', '1000.00'),
(58, 20, 'Tuition Fee', '1000.00'),
(59, 20, 'Admission fee', '500.00'),
(60, 20, 'Computer fee', '1000.00'),
(61, 21, 'Tuition Fee', '1000.00'),
(62, 22, 'Tuition Fee', '1000.00'),
(63, 23, 'Tuition Fee', '1000.00'),
(64, 24, 'Tuition Fee', '1000.00'),
(65, 25, 'Tuition Fee', '1000.00'),
(66, 26, 'Tuition Fee', '1000.00'),
(67, 27, 'Tuition Fee', '1000.00'),
(68, 28, 'Tuition Fee', '1000.00'),
(69, 29, 'Tuition Fee', '1000.00'),
(70, 30, 'Tuition Fee', '1000.00'),
(71, 31, 'Tuition Fee', '1000.00'),
(72, 32, 'Tuition Fee', '1000.00'),
(73, 33, 'Tuition Fee', '1000.00'),
(74, 34, 'Tuition Fee', '1000.00'),
(75, 35, 'Tuition Fee', '1000.00'),
(76, 36, 'Tuition Fee', '500.00'),
(77, 37, 'Tuition Fee', '-1000.00'),
(78, 38, 'Tuition Fee', '0.00'),
(79, 39, 'Tuition Fee', '800.00'),
(80, 40, 'Tuition Fee', '800.00'),
(81, 41, 'Tuition Fee', '800.00'),
(82, 42, 'Tuition Fee', '800.00'),
(83, 43, 'Tuition Fee', '800.00'),
(84, 44, 'Tuition Fee', '800.00'),
(85, 45, 'Tuition Fee', '800.00'),
(86, 46, 'Tuition Fee', '800.00'),
(87, 47, 'Tuition Fee', '800.00'),
(88, 48, 'Tuition Fee', '800.00'),
(89, 49, 'Tuition Fee', '800.00'),
(90, 50, 'Tuition Fee', '800.00'),
(91, 51, 'Tuition Fee', '500.00'),
(92, 52, 'Tuition Fee', '-1000.00'),
(93, 53, 'Tuition Fee', '0.00'),
(94, 54, 'Tuition Fee', '800.00'),
(95, 55, 'Tuition Fee', '800.00'),
(96, 56, 'Tuition Fee', '800.00'),
(97, 57, 'Tuition Fee', '800.00'),
(98, 58, 'Tuition Fee', '800.00'),
(99, 59, 'Tuition Fee', '800.00'),
(100, 60, 'Tuition Fee', '800.00'),
(101, 61, 'Tuition Fee', '800.00'),
(102, 62, 'Tuition Fee', '800.00'),
(103, 63, 'Tuition Fee', '800.00'),
(104, 64, 'Tuition Fee', '800.00'),
(105, 65, 'Tuition Fee', '800.00'),
(106, 66, 'Tuition Fee', '800.00'),
(107, 67, 'Tuition Fee', '2800.00'),
(108, 68, 'Tuition Fee', '4800.00'),
(109, 69, 'Tuition Fee', '6800.00'),
(110, 70, 'Tuition Fee', '3500.00'),
(111, 72, 'Tuition Fee', '3000.00'),
(112, 73, 'Tuition Fee', '3800.00'),
(113, 74, 'Tuition Fee', '3800.00'),
(114, 75, 'Tuition Fee', '3800.00'),
(115, 76, 'Tuition Fee', '3800.00'),
(116, 77, 'Tuition Fee', '3800.00'),
(117, 78, 'Tuition Fee', '3800.00'),
(118, 79, 'Tuition Fee', '3800.00'),
(119, 80, 'Tuition Fee', '3800.00'),
(120, 81, 'Tuition Fee', '3800.00'),
(121, 82, 'Tuition Fee', '3800.00'),
(122, 83, 'Tuition Fee', '3800.00'),
(123, 84, 'Tuition Fee', '3800.00'),
(124, 85, 'Tuition Fee', '3500.00'),
(125, 87, 'Tuition Fee', '3000.00'),
(126, 88, 'Tuition Fee', '3800.00'),
(127, 89, 'Tuition Fee', '3800.00'),
(128, 90, 'Tuition Fee', '3800.00'),
(129, 91, 'Tuition Fee', '3800.00'),
(130, 92, 'Tuition Fee', '3800.00'),
(131, 93, 'Tuition Fee', '3800.00'),
(132, 94, 'Tuition Fee', '3800.00'),
(133, 95, 'Tuition Fee', '3800.00'),
(134, 96, 'Tuition Fee', '3800.00'),
(135, 97, 'Tuition Fee', '3800.00'),
(136, 98, 'Tuition Fee', '3800.00'),
(137, 99, 'Tuition Fee', '3800.00'),
(138, 100, 'Tuition Fee', '3500.00'),
(139, 102, 'Tuition Fee', '3000.00'),
(140, 103, 'Tuition Fee', '3800.00'),
(141, 104, 'Tuition Fee', '3800.00'),
(142, 105, 'Tuition Fee', '3800.00'),
(143, 106, 'Tuition Fee', '3800.00'),
(144, 107, 'Tuition Fee', '3800.00'),
(145, 108, 'Tuition Fee', '3800.00'),
(146, 109, 'Tuition Fee', '3800.00'),
(147, 110, 'Tuition Fee', '3800.00'),
(148, 111, 'Tuition Fee', '3800.00'),
(149, 112, 'Tuition Fee', '3800.00'),
(150, 113, 'Tuition Fee', '3800.00'),
(151, 114, 'Tuition Fee', '3800.00'),
(152, 115, 'Tuition Fee', '500.00'),
(153, 116, 'Tuition Fee', '500.00'),
(154, 118, 'Tuition Fee', '500.00'),
(155, 119, 'Tuition Fee', '2000.00'),
(156, 120, 'Tuition Fee', '2000.00'),
(157, 121, 'Tuition Fee', '2000.00'),
(158, 122, 'Tuition Fee', '2000.00'),
(159, 123, 'Tuition Fee', '2000.00'),
(160, 124, 'Tuition Fee', '1000.00'),
(161, 125, 'Tuition Fee', '1000.00'),
(162, 126, 'Tuition Fee', '1000.00'),
(163, 127, 'Tuition Fee', '1990.00'),
(164, 128, 'Tuition Fee', '2000.00'),
(165, 129, 'Tuition Fee', '1000.00'),
(166, 130, 'Tuition Fee', '1500.00'),
(167, 131, 'Tuition Fee', '500.00'),
(168, 131, 'Admission fee', '500.00'),
(169, 131, 'Computer fee', '1000.00'),
(170, 132, 'Admission fee', '500.00'),
(171, 132, 'Computer fee', '1000.00'),
(172, 133, 'Tuition Fee', '500.00'),
(173, 133, 'Admission fee', '500.00'),
(174, 133, 'Computer fee', '1000.00'),
(175, 134, 'Tuition Fee', '2000.00'),
(176, 134, 'Admission fee', '500.00'),
(177, 134, 'Computer fee', '1000.00'),
(178, 135, 'Tuition Fee', '2000.00'),
(179, 135, 'Admission fee', '500.00'),
(180, 135, 'Computer fee', '1000.00'),
(181, 136, 'Tuition Fee', '2000.00'),
(182, 136, 'Admission fee', '500.00'),
(183, 136, 'Computer fee', '1000.00'),
(184, 137, 'Tuition Fee', '2000.00'),
(185, 137, 'Admission fee', '500.00'),
(186, 137, 'Computer fee', '1000.00'),
(187, 138, 'Tuition Fee', '2000.00'),
(188, 138, 'Admission fee', '500.00'),
(189, 138, 'Computer fee', '1000.00'),
(190, 139, 'Tuition Fee', '1000.00'),
(191, 139, 'Admission fee', '500.00'),
(192, 139, 'Computer fee', '1000.00'),
(193, 140, 'Tuition Fee', '1000.00'),
(194, 140, 'Admission fee', '500.00'),
(195, 140, 'Computer fee', '1000.00'),
(196, 141, 'Tuition Fee', '1000.00'),
(197, 141, 'Admission fee', '500.00'),
(198, 141, 'Computer fee', '1000.00'),
(199, 142, 'Tuition Fee', '1990.00'),
(200, 142, 'Admission fee', '500.00'),
(201, 142, 'Computer fee', '1000.00'),
(202, 143, 'Tuition Fee', '2000.00'),
(203, 143, 'Admission fee', '500.00'),
(204, 143, 'Computer fee', '1000.00'),
(205, 144, 'Tuition Fee', '1000.00'),
(206, 144, 'Admission fee', '500.00'),
(207, 144, 'Computer fee', '1000.00'),
(208, 145, 'Tuition Fee', '1500.00'),
(209, 145, 'Admission fee', '500.00'),
(210, 145, 'Computer fee', '1000.00'),
(211, 146, 'Tuition Fee', '500.00'),
(212, 146, 'Admission fee', '500.00'),
(213, 146, 'Computer fee', '1000.00'),
(214, 146, 'Exam fee', '1000.00'),
(215, 146, 'Seminar fee', '2000.00'),
(216, 146, 'Paper fund', '1000.00'),
(217, 146, 'Trip', '1000.00'),
(218, 146, 'Festival', '1000.00'),
(219, 146, 'Transport fee', '15000.00'),
(220, 146, 'Misc.', '1000.00'),
(221, 146, 'Ac charges', '500.00'),
(222, 147, 'Admission fee', '500.00'),
(223, 147, 'Computer fee', '1000.00'),
(224, 147, 'Exam fee', '1000.00'),
(225, 147, 'Seminar fee', '2000.00'),
(226, 147, 'Paper fund', '1000.00'),
(227, 147, 'Trip', '1000.00'),
(228, 147, 'Festival', '1000.00'),
(229, 147, 'Transport fee', '15000.00'),
(230, 147, 'Misc.', '1000.00'),
(231, 147, 'Ac charges', '500.00'),
(232, 148, 'Tuition Fee', '500.00'),
(233, 148, 'Admission fee', '500.00'),
(234, 148, 'Computer fee', '1000.00'),
(235, 148, 'Exam fee', '1000.00'),
(236, 148, 'Seminar fee', '2000.00'),
(237, 148, 'Paper fund', '1000.00'),
(238, 148, 'Trip', '1000.00'),
(239, 148, 'Festival', '1000.00'),
(240, 148, 'Transport fee', '15000.00'),
(241, 148, 'Misc.', '1000.00'),
(242, 148, 'Ac charges', '500.00'),
(243, 149, 'Tuition Fee', '2000.00'),
(244, 149, 'Admission fee', '500.00'),
(245, 149, 'Computer fee', '1000.00'),
(246, 149, 'Exam fee', '1000.00'),
(247, 149, 'Seminar fee', '2000.00'),
(248, 149, 'Paper fund', '1000.00'),
(249, 149, 'Trip', '1000.00'),
(250, 149, 'Festival', '1000.00'),
(251, 149, 'Transport fee', '15000.00'),
(252, 149, 'Misc.', '1000.00'),
(253, 149, 'Ac charges', '500.00'),
(254, 150, 'Tuition Fee', '2000.00'),
(255, 150, 'Admission fee', '500.00'),
(256, 150, 'Computer fee', '1000.00'),
(257, 150, 'Exam fee', '1000.00'),
(258, 150, 'Seminar fee', '2000.00'),
(259, 150, 'Paper fund', '1000.00'),
(260, 150, 'Trip', '1000.00'),
(261, 150, 'Festival', '1000.00'),
(262, 150, 'Transport fee', '15000.00'),
(263, 150, 'Misc.', '1000.00'),
(264, 150, 'Ac charges', '500.00'),
(265, 151, 'Tuition Fee', '2000.00'),
(266, 151, 'Admission fee', '500.00'),
(267, 151, 'Computer fee', '1000.00'),
(268, 151, 'Exam fee', '1000.00'),
(269, 151, 'Seminar fee', '2000.00'),
(270, 151, 'Paper fund', '1000.00'),
(271, 151, 'Trip', '1000.00'),
(272, 151, 'Festival', '1000.00'),
(273, 151, 'Transport fee', '15000.00'),
(274, 151, 'Misc.', '1000.00'),
(275, 151, 'Ac charges', '500.00'),
(276, 152, 'Tuition Fee', '2000.00'),
(277, 152, 'Admission fee', '500.00'),
(278, 152, 'Computer fee', '1000.00'),
(279, 152, 'Exam fee', '1000.00'),
(280, 152, 'Seminar fee', '2000.00'),
(281, 152, 'Paper fund', '1000.00'),
(282, 152, 'Trip', '1000.00'),
(283, 152, 'Festival', '1000.00'),
(284, 152, 'Transport fee', '15000.00'),
(285, 152, 'Misc.', '1000.00'),
(286, 152, 'Ac charges', '500.00'),
(287, 153, 'Tuition Fee', '2000.00'),
(288, 153, 'Admission fee', '500.00'),
(289, 153, 'Computer fee', '1000.00'),
(290, 153, 'Exam fee', '1000.00'),
(291, 153, 'Seminar fee', '2000.00'),
(292, 153, 'Paper fund', '1000.00'),
(293, 153, 'Trip', '1000.00'),
(294, 153, 'Festival', '1000.00'),
(295, 153, 'Transport fee', '15000.00'),
(296, 153, 'Misc.', '1000.00'),
(297, 153, 'Ac charges', '500.00'),
(298, 154, 'Tuition Fee', '1000.00'),
(299, 154, 'Admission fee', '500.00'),
(300, 154, 'Computer fee', '1000.00'),
(301, 154, 'Exam fee', '1000.00'),
(302, 154, 'Seminar fee', '2000.00'),
(303, 154, 'Paper fund', '1000.00'),
(304, 154, 'Trip', '1000.00'),
(305, 154, 'Festival', '1000.00'),
(306, 154, 'Transport fee', '15000.00'),
(307, 154, 'Misc.', '1000.00'),
(308, 154, 'Ac charges', '500.00'),
(309, 155, 'Tuition Fee', '1000.00'),
(310, 155, 'Admission fee', '500.00'),
(311, 155, 'Computer fee', '1000.00'),
(312, 155, 'Exam fee', '1000.00'),
(313, 155, 'Seminar fee', '2000.00'),
(314, 155, 'Paper fund', '1000.00'),
(315, 155, 'Trip', '1000.00'),
(316, 155, 'Festival', '1000.00'),
(317, 155, 'Transport fee', '15000.00'),
(318, 155, 'Misc.', '1000.00'),
(319, 155, 'Ac charges', '500.00'),
(320, 156, 'Tuition Fee', '1000.00'),
(321, 156, 'Admission fee', '500.00'),
(322, 156, 'Computer fee', '1000.00'),
(323, 156, 'Exam fee', '1000.00'),
(324, 156, 'Seminar fee', '2000.00'),
(325, 156, 'Paper fund', '1000.00'),
(326, 156, 'Trip', '1000.00'),
(327, 156, 'Festival', '1000.00'),
(328, 156, 'Transport fee', '15000.00'),
(329, 156, 'Misc.', '1000.00'),
(330, 156, 'Ac charges', '500.00'),
(331, 157, 'Tuition Fee', '1990.00'),
(332, 157, 'Admission fee', '500.00'),
(333, 157, 'Computer fee', '1000.00'),
(334, 157, 'Exam fee', '1000.00'),
(335, 157, 'Seminar fee', '2000.00'),
(336, 157, 'Paper fund', '1000.00'),
(337, 157, 'Trip', '1000.00'),
(338, 157, 'Festival', '1000.00'),
(339, 157, 'Transport fee', '15000.00'),
(340, 157, 'Misc.', '1000.00'),
(341, 157, 'Ac charges', '500.00'),
(342, 158, 'Tuition Fee', '2000.00'),
(343, 158, 'Admission fee', '500.00'),
(344, 158, 'Computer fee', '1000.00'),
(345, 158, 'Exam fee', '1000.00'),
(346, 158, 'Seminar fee', '2000.00'),
(347, 158, 'Paper fund', '1000.00'),
(348, 158, 'Trip', '1000.00'),
(349, 158, 'Festival', '1000.00'),
(350, 158, 'Transport fee', '15000.00'),
(351, 158, 'Misc.', '1000.00'),
(352, 158, 'Ac charges', '500.00'),
(353, 159, 'Tuition Fee', '1000.00'),
(354, 159, 'Admission fee', '500.00'),
(355, 159, 'Computer fee', '1000.00'),
(356, 159, 'Exam fee', '1000.00'),
(357, 159, 'Seminar fee', '2000.00'),
(358, 159, 'Paper fund', '1000.00'),
(359, 159, 'Trip', '1000.00'),
(360, 159, 'Festival', '1000.00'),
(361, 159, 'Transport fee', '15000.00'),
(362, 159, 'Misc.', '1000.00'),
(363, 159, 'Ac charges', '500.00'),
(364, 160, 'Tuition Fee', '1500.00'),
(365, 160, 'Admission fee', '500.00'),
(366, 160, 'Computer fee', '1000.00'),
(367, 160, 'Exam fee', '1000.00'),
(368, 160, 'Seminar fee', '2000.00'),
(369, 160, 'Paper fund', '1000.00'),
(370, 160, 'Trip', '1000.00'),
(371, 160, 'Festival', '1000.00'),
(372, 160, 'Transport fee', '15000.00'),
(373, 160, 'Misc.', '1000.00'),
(374, 160, 'Ac charges', '500.00'),
(375, 161, 'Tuition Fee', '3000.00'),
(376, 162, 'Tuition Fee', '500.00'),
(377, 164, 'Tuition Fee', '500.00'),
(378, 165, 'Tuition Fee', '2000.00'),
(379, 166, 'Tuition Fee', '2000.00'),
(380, 167, 'Tuition Fee', '2000.00'),
(381, 168, 'Tuition Fee', '2000.00'),
(382, 169, 'Tuition Fee', '2000.00'),
(383, 170, 'Tuition Fee', '1000.00'),
(384, 171, 'Tuition Fee', '1000.00'),
(385, 172, 'Tuition Fee', '1000.00'),
(386, 173, 'Tuition Fee', '1990.00'),
(387, 174, 'Tuition Fee', '2000.00'),
(388, 175, 'Tuition Fee', '1000.00'),
(389, 176, 'Tuition Fee', '1500.00'),
(390, 177, 'Tuition Fee', '500.00'),
(391, 179, 'Tuition Fee', '500.00'),
(392, 180, 'Tuition Fee', '2000.00'),
(393, 181, 'Tuition Fee', '2000.00'),
(394, 182, 'Tuition Fee', '2000.00'),
(395, 183, 'Tuition Fee', '2000.00'),
(396, 184, 'Tuition Fee', '2000.00'),
(397, 185, 'Tuition Fee', '1000.00'),
(398, 186, 'Tuition Fee', '1000.00'),
(399, 187, 'Tuition Fee', '1000.00'),
(400, 188, 'Tuition Fee', '1990.00'),
(401, 189, 'Tuition Fee', '2000.00'),
(402, 190, 'Tuition Fee', '1000.00'),
(403, 191, 'Tuition Fee', '1500.00'),
(404, 192, 'Tuition Fee', '16000.00'),
(405, 192, 'Admission fee', '500.00'),
(406, 192, 'Computer fee', '1000.00'),
(407, 192, 'Exam fee', '1000.00'),
(408, 193, 'Tuition Fee', '16000.00'),
(409, 193, 'Admission fee', '500.00'),
(410, 193, 'Computer fee', '1000.00'),
(411, 193, 'Exam fee', '1000.00'),
(412, 194, 'Admission fee', '500.00'),
(413, 195, 'Tuition Fee', '350.00'),
(414, 195, 'Admission fee', '500.00'),
(415, 196, 'Tuition Fee', '850.00'),
(416, 196, 'Admission fee', '500.00'),
(417, 197, 'Tuition Fee', '2350.00'),
(418, 197, 'Admission fee', '500.00'),
(419, 198, 'Tuition Fee', '2350.00'),
(420, 198, 'Admission fee', '500.00'),
(421, 199, 'Tuition Fee', '2350.00'),
(422, 199, 'Admission fee', '500.00'),
(423, 200, 'Tuition Fee', '2350.00'),
(424, 200, 'Admission fee', '500.00'),
(425, 201, 'Tuition Fee', '2350.00'),
(426, 201, 'Admission fee', '500.00'),
(427, 202, 'Tuition Fee', '1350.00'),
(428, 202, 'Admission fee', '500.00'),
(429, 203, 'Tuition Fee', '1350.00'),
(430, 203, 'Admission fee', '500.00'),
(431, 204, 'Tuition Fee', '1350.00'),
(432, 204, 'Admission fee', '500.00'),
(433, 205, 'Tuition Fee', '2340.00'),
(434, 205, 'Admission fee', '500.00'),
(435, 206, 'Tuition Fee', '2350.00'),
(436, 206, 'Admission fee', '500.00'),
(437, 207, 'Tuition Fee', '1350.00'),
(438, 207, 'Admission fee', '500.00'),
(439, 208, 'Tuition Fee', '1850.00'),
(440, 208, 'Admission fee', '500.00'),
(441, 209, 'Tuition Fee', '1000.00'),
(442, 209, 'Admission fee', '500.00'),
(443, 210, 'Tuition Fee', '500.00'),
(444, 210, 'Admission fee', '500.00'),
(445, 211, 'Tuition Fee', '100.00'),
(446, 211, 'Admission fee', '500.00'),
(447, 212, 'Admission fee', '500.00'),
(448, 213, 'Tuition Fee', '950.00'),
(449, 213, 'Admission fee', '500.00'),
(450, 214, 'Tuition Fee', '1450.00'),
(451, 214, 'Admission fee', '500.00'),
(452, 215, 'Tuition Fee', '950.00'),
(453, 216, 'Tuition Fee', '1450.00'),
(454, 217, 'Tuition Fee', '950.00'),
(455, 218, 'Tuition Fee', '1450.00'),
(456, 219, 'Tuition Fee', '1950.00'),
(457, 219, 'Admission fee', '500.00'),
(458, 220, 'Tuition Fee', '1950.00'),
(459, 220, 'Admission fee', '500.00'),
(460, 221, 'Tuition Fee', '3950.00'),
(461, 221, 'Admission fee', '500.00'),
(462, 222, 'Admission fee', '500.00'),
(463, 223, 'Tuition Fee', '1950.00'),
(464, 223, 'Admission fee', '500.00'),
(465, 224, 'Tuition Fee', '1950.00'),
(466, 224, 'Admission fee', '500.00'),
(467, 225, 'Tuition Fee', '1000.00'),
(468, 226, 'Tuition Fee', '1000.00'),
(469, 227, 'Tuition Fee', '1000.00'),
(470, 228, 'Tuition Fee', '1000.00'),
(471, 229, 'Computer fee', '1000.00'),
(472, 230, 'Tuition Fee', '1000.00'),
(473, 230, 'Computer fee', '1000.00'),
(474, 231, 'Tuition Fee', '6300.00'),
(475, 231, 'Seminar fee', '2000.00'),
(476, 232, 'Tuition Fee', '350.00'),
(477, 232, 'Seminar fee', '2000.00'),
(478, 233, 'Tuition Fee', '6300.00'),
(479, 234, 'Tuition Fee', '350.00'),
(485, 243, 'Tuition Fee', '6300.00'),
(486, 244, 'Tuition Fee', '350.00'),
(487, 245, 'Tuition Fee', '6300.00'),
(488, 246, 'Tuition Fee', '350.00'),
(489, 247, 'Tuition Fee', '2000.00'),
(490, 248, 'Tuition Fee', '2000.00'),
(491, 250, 'Tuition Fee', '2000.00'),
(492, 251, 'Tuition Fee', '2000.00'),
(493, 253, 'Tuition Fee', '2000.00'),
(501, 254, 'Tuition Fee', '4000.00'),
(502, 256, 'Tuition Fee', '4000.00'),
(503, 257, 'Tuition Fee', '4000.00'),
(504, 259, 'Tuition Fee', '4000.00'),
(505, 260, 'Tuition Fee', '3000.00'),
(506, 261, 'Tuition Fee', '1000.00'),
(507, 262, 'Tuition Fee', '1000.00'),
(508, 263, 'Tuition Fee', '3000.00'),
(509, 264, 'Tuition Fee', '1000.00'),
(510, 265, 'Tuition Fee', '1000.00'),
(511, 266, 'Tuition Fee', '3000.00'),
(512, 267, 'Tuition Fee', '1000.00'),
(513, 268, 'Tuition Fee', '4000.00'),
(514, 270, 'Tuition Fee', '4000.00'),
(515, 271, 'Tuition Fee', '2000.00'),
(516, 273, 'Tuition Fee', '2000.00'),
(517, 274, 'Tuition Fee', '2000.00'),
(518, 276, 'Tuition Fee', '2000.00'),
(519, 277, 'Tuition Fee', '2000.00'),
(520, 279, 'Tuition Fee', '2000.00'),
(521, 280, 'Tuition Fee', '2000.00'),
(522, 282, 'Tuition Fee', '2000.00'),
(523, 283, 'Tuition Fee', '1000.00'),
(524, 284, 'Tuition Fee', '1000.00'),
(525, 285, 'Tuition Fee', '1000.00'),
(526, 286, 'Tuition Fee', '3000.00'),
(527, 287, 'Due Fee', '500.00'),
(528, 288, 'Due Fee', '1000.00'),
(529, 289, 'Due Fee', '1000.00'),
(530, 290, 'Due Fee', '1000.00'),
(531, 291, 'Due Fee', '1000.00'),
(532, 292, 'Due Fee', '1000.00'),
(533, 296, 'Due Fee', '990.00'),
(534, 297, 'Due Fee', '1000.00'),
(535, 299, 'Due Fee', '500.00'),
(536, 300, 'Due Fee', '1000.00'),
(537, 301, 'Due Fee', '500.00'),
(538, 302, 'Due Fee', '500.00'),
(539, 303, 'Due Fee', '200.00'),
(540, 304, 'Due Fee', '300.00'),
(541, 305, 'Due Fee', '700.00'),
(542, 306, 'Due Fee', '650.00'),
(543, 307, 'Due Fee', '750.00'),
(544, 308, 'Due Fee', '800.00'),
(545, 309, 'Due Fee', '400.00'),
(546, 310, 'Due Fee', '750.00'),
(547, 311, 'Due Fee', '800.00'),
(548, 312, 'Due Fee', '550.00'),
(549, 313, 'Due Fee', '1000.00'),
(550, 314, 'Due Fee', '500.00'),
(551, 315, 'Due Fee', '1000.00'),
(552, 316, 'Due Fee', '1000.00'),
(553, 317, 'Due Fee', '1000.00'),
(554, 318, 'Due Fee', '1000.00'),
(555, 319, 'Due Fee', '1000.00'),
(556, 323, 'Due Fee', '990.00'),
(557, 324, 'Due Fee', '1000.00'),
(558, 326, 'Due Fee', '500.00'),
(559, 327, 'Due Fee', '1000.00'),
(560, 328, 'Due Fee', '500.00'),
(561, 329, 'Due Fee', '500.00'),
(562, 330, 'Due Fee', '200.00'),
(563, 331, 'Due Fee', '300.00'),
(564, 332, 'Due Fee', '700.00'),
(565, 333, 'Due Fee', '650.00'),
(566, 334, 'Due Fee', '750.00'),
(567, 335, 'Due Fee', '800.00'),
(568, 336, 'Due Fee', '400.00'),
(569, 337, 'Due Fee', '750.00'),
(570, 338, 'Due Fee', '800.00'),
(571, 339, 'Due Fee', '550.00'),
(572, 340, 'Due Fee', '1000.00'),
(573, 341, 'Due Fee', '500.00'),
(574, 342, 'Due Fee', '1000.00'),
(575, 343, 'Due Fee', '1000.00'),
(576, 344, 'Due Fee', '1000.00'),
(577, 345, 'Due Fee', '1000.00'),
(578, 346, 'Due Fee', '1000.00'),
(579, 350, 'Due Fee', '990.00'),
(580, 351, 'Due Fee', '1000.00'),
(581, 353, 'Due Fee', '500.00'),
(582, 354, 'Due Fee', '1000.00'),
(583, 355, 'Due Fee', '500.00'),
(584, 356, 'Due Fee', '500.00'),
(585, 357, 'Due Fee', '200.00'),
(586, 358, 'Due Fee', '300.00'),
(587, 359, 'Due Fee', '700.00'),
(588, 360, 'Due Fee', '650.00'),
(589, 361, 'Due Fee', '750.00'),
(590, 362, 'Due Fee', '800.00'),
(591, 363, 'Due Fee', '400.00'),
(592, 364, 'Due Fee', '750.00'),
(593, 365, 'Due Fee', '800.00'),
(594, 366, 'Due Fee', '550.00'),
(595, 367, 'Due Fee', '1000.00'),
(596, 368, 'Due Fee', '500.00'),
(597, 369, 'Due Fee', '1000.00'),
(598, 370, 'Due Fee', '1000.00'),
(599, 371, 'Due Fee', '1000.00'),
(600, 372, 'Due Fee', '1000.00'),
(601, 373, 'Due Fee', '1000.00'),
(602, 377, 'Due Fee', '990.00'),
(603, 378, 'Due Fee', '1000.00'),
(604, 380, 'Due Fee', '500.00'),
(605, 381, 'Due Fee', '1000.00'),
(606, 382, 'Due Fee', '500.00'),
(607, 383, 'Due Fee', '500.00'),
(608, 384, 'Due Fee', '200.00'),
(609, 385, 'Due Fee', '300.00'),
(610, 386, 'Due Fee', '700.00'),
(611, 387, 'Due Fee', '650.00'),
(612, 388, 'Due Fee', '750.00'),
(613, 389, 'Due Fee', '800.00'),
(614, 390, 'Due Fee', '400.00'),
(615, 391, 'Due Fee', '750.00'),
(616, 392, 'Due Fee', '800.00'),
(617, 393, 'Due Fee', '550.00'),
(618, 394, 'Due Fee', '1000.00'),
(619, 395, 'Due Fee', '500.00'),
(620, 396, 'Due Fee', '1000.00'),
(621, 397, 'Due Fee', '1000.00'),
(622, 398, 'Due Fee', '1000.00'),
(623, 399, 'Due Fee', '1000.00'),
(624, 400, 'Due Fee', '1000.00'),
(625, 404, 'Due Fee', '990.00'),
(626, 405, 'Due Fee', '1000.00'),
(627, 407, 'Due Fee', '500.00'),
(628, 408, 'Due Fee', '1000.00'),
(629, 409, 'Due Fee', '500.00'),
(630, 410, 'Due Fee', '500.00'),
(631, 411, 'Due Fee', '200.00'),
(632, 412, 'Due Fee', '300.00'),
(633, 413, 'Due Fee', '700.00'),
(634, 414, 'Due Fee', '650.00'),
(635, 415, 'Due Fee', '750.00'),
(636, 416, 'Due Fee', '800.00'),
(637, 417, 'Due Fee', '400.00'),
(638, 418, 'Due Fee', '750.00'),
(639, 419, 'Due Fee', '800.00'),
(640, 420, 'Due Fee', '550.00'),
(641, 421, 'Due Fee', '1000.00'),
(642, 422, 'Due Fee', '500.00'),
(643, 423, 'Due Fee', '1000.00'),
(644, 424, 'Due Fee', '1000.00'),
(645, 425, 'Due Fee', '1000.00'),
(646, 426, 'Due Fee', '1000.00'),
(647, 427, 'Due Fee', '1000.00'),
(648, 431, 'Due Fee', '990.00'),
(649, 432, 'Due Fee', '1000.00'),
(650, 434, 'Due Fee', '500.00'),
(651, 435, 'Due Fee', '1000.00'),
(652, 436, 'Due Fee', '500.00'),
(653, 437, 'Due Fee', '500.00'),
(654, 438, 'Due Fee', '200.00'),
(655, 439, 'Due Fee', '300.00'),
(656, 440, 'Due Fee', '700.00'),
(657, 441, 'Due Fee', '650.00'),
(658, 442, 'Due Fee', '750.00'),
(659, 443, 'Due Fee', '800.00'),
(660, 444, 'Due Fee', '400.00'),
(661, 445, 'Due Fee', '750.00'),
(662, 446, 'Due Fee', '800.00'),
(663, 447, 'Due Fee', '550.00'),
(664, 448, 'Due Fee', '1000.00'),
(665, 449, 'Due Fee', '500.00'),
(666, 450, 'Due Fee', '1000.00'),
(667, 451, 'Due Fee', '1000.00'),
(668, 452, 'Due Fee', '1000.00'),
(669, 453, 'Due Fee', '1000.00'),
(670, 454, 'Due Fee', '1000.00'),
(671, 458, 'Due Fee', '990.00'),
(672, 459, 'Due Fee', '1000.00'),
(673, 461, 'Due Fee', '500.00'),
(674, 462, 'Due Fee', '1000.00'),
(675, 463, 'Due Fee', '500.00'),
(676, 464, 'Due Fee', '500.00'),
(677, 465, 'Due Fee', '200.00'),
(678, 466, 'Due Fee', '300.00'),
(679, 467, 'Due Fee', '700.00'),
(680, 468, 'Due Fee', '650.00'),
(681, 469, 'Due Fee', '750.00'),
(682, 470, 'Due Fee', '800.00'),
(683, 471, 'Due Fee', '400.00'),
(684, 472, 'Due Fee', '750.00'),
(685, 473, 'Due Fee', '800.00'),
(686, 474, 'Due Fee', '550.00'),
(687, 475, 'Due Fee', '1000.00'),
(688, 476, 'Due Fee', '1000.00'),
(689, 477, 'Due Fee', '1000.00'),
(690, 478, 'Due Fee', '1000.00'),
(691, 479, 'Due Fee', '1000.00'),
(692, 480, 'Admission fee', '500.00'),
(693, 480, 'Computer fee', '1000.00'),
(694, 481, 'Admission fee', '500.00'),
(695, 481, 'Computer fee', '1000.00'),
(696, 482, 'Due Fee', '300.00'),
(697, 483, 'Due Fee', '1000.00'),
(698, 484, 'Due Fee', '1000.00'),
(699, 485, 'Due Fee', '1000.00'),
(700, 486, 'Due Fee', '1000.00'),
(701, 490, 'Due Fee', '990.00'),
(702, 491, 'Due Fee', '1000.00'),
(703, 493, 'Due Fee', '500.00'),
(704, 494, 'Due Fee', '1000.00'),
(705, 495, 'Due Fee', '500.00'),
(706, 496, 'Due Fee', '500.00'),
(707, 497, 'Due Fee', '200.00'),
(708, 498, 'Due Fee', '300.00'),
(709, 499, 'Due Fee', '700.00'),
(710, 500, 'Due Fee', '650.00'),
(711, 501, 'Due Fee', '750.00'),
(712, 502, 'Due Fee', '800.00'),
(713, 503, 'Due Fee', '400.00'),
(714, 504, 'Due Fee', '750.00'),
(715, 505, 'Due Fee', '800.00'),
(716, 506, 'Due Fee', '550.00'),
(717, 507, 'Due Fee', '1000.00'),
(718, 508, 'Due Fee', '1000.00'),
(719, 509, 'Due Fee', '300.00'),
(720, 510, 'Due Fee', '1000.00'),
(721, 511, 'Due Fee', '1000.00'),
(722, 512, 'Due Fee', '1000.00'),
(723, 513, 'Due Fee', '1000.00'),
(724, 517, 'Due Fee', '990.00'),
(725, 518, 'Due Fee', '1000.00'),
(726, 520, 'Due Fee', '500.00'),
(727, 521, 'Due Fee', '1000.00'),
(728, 522, 'Due Fee', '500.00'),
(729, 523, 'Due Fee', '500.00'),
(730, 524, 'Due Fee', '200.00'),
(731, 525, 'Due Fee', '300.00'),
(732, 526, 'Due Fee', '700.00'),
(733, 527, 'Due Fee', '650.00'),
(734, 528, 'Due Fee', '750.00'),
(735, 529, 'Due Fee', '800.00'),
(736, 530, 'Due Fee', '400.00'),
(737, 531, 'Due Fee', '750.00'),
(738, 532, 'Due Fee', '800.00'),
(739, 533, 'Due Fee', '550.00'),
(740, 534, 'Due Fee', '1000.00'),
(741, 535, 'Due Fee', '1000.00'),
(742, 536, 'Due Fee', '300.00'),
(743, 537, 'Due Fee', '1000.00'),
(744, 538, 'Due Fee', '1000.00'),
(745, 539, 'Due Fee', '1000.00'),
(746, 540, 'Due Fee', '1000.00'),
(747, 544, 'Due Fee', '990.00'),
(748, 545, 'Due Fee', '1000.00'),
(749, 547, 'Due Fee', '500.00'),
(750, 548, 'Due Fee', '1000.00'),
(751, 549, 'Due Fee', '500.00'),
(752, 550, 'Due Fee', '500.00'),
(753, 551, 'Due Fee', '200.00'),
(754, 552, 'Due Fee', '300.00'),
(755, 553, 'Due Fee', '700.00'),
(756, 554, 'Due Fee', '650.00'),
(757, 555, 'Due Fee', '750.00'),
(758, 556, 'Due Fee', '800.00'),
(759, 557, 'Due Fee', '400.00'),
(760, 558, 'Due Fee', '750.00'),
(761, 559, 'Due Fee', '800.00'),
(762, 560, 'Due Fee', '550.00'),
(763, 561, 'Due Fee', '1000.00'),
(764, 562, 'Due Fee', '1000.00'),
(765, 563, 'Due Fee', '300.00'),
(766, 564, 'Due Fee', '1000.00'),
(767, 565, 'Due Fee', '1000.00'),
(768, 566, 'Due Fee', '1000.00'),
(769, 567, 'Due Fee', '1000.00'),
(770, 571, 'Due Fee', '990.00'),
(771, 572, 'Due Fee', '1000.00'),
(772, 574, 'Due Fee', '500.00'),
(773, 575, 'Due Fee', '1000.00'),
(774, 576, 'Due Fee', '500.00'),
(775, 577, 'Due Fee', '500.00'),
(776, 578, 'Due Fee', '200.00'),
(777, 579, 'Due Fee', '300.00'),
(778, 580, 'Due Fee', '700.00'),
(779, 581, 'Due Fee', '650.00'),
(780, 582, 'Due Fee', '750.00'),
(781, 583, 'Due Fee', '800.00'),
(782, 584, 'Due Fee', '400.00'),
(783, 585, 'Due Fee', '750.00'),
(784, 586, 'Due Fee', '800.00'),
(785, 587, 'Due Fee', '550.00'),
(786, 588, 'Due Fee', '1000.00'),
(787, 589, 'Due Fee', '1000.00'),
(788, 590, 'Due Fee', '300.00'),
(789, 591, 'Due Fee', '1000.00'),
(790, 592, 'Due Fee', '1000.00'),
(791, 593, 'Due Fee', '1000.00'),
(792, 594, 'Due Fee', '1000.00'),
(793, 598, 'Due Fee', '990.00'),
(794, 599, 'Due Fee', '1000.00'),
(795, 601, 'Due Fee', '500.00'),
(796, 602, 'Due Fee', '1000.00'),
(797, 603, 'Due Fee', '500.00'),
(798, 604, 'Due Fee', '500.00'),
(799, 605, 'Due Fee', '200.00'),
(800, 606, 'Due Fee', '300.00'),
(801, 607, 'Due Fee', '700.00'),
(802, 608, 'Due Fee', '650.00'),
(803, 609, 'Due Fee', '750.00'),
(804, 610, 'Due Fee', '800.00'),
(805, 611, 'Due Fee', '400.00'),
(806, 612, 'Due Fee', '750.00'),
(807, 613, 'Due Fee', '800.00'),
(808, 614, 'Due Fee', '550.00'),
(809, 615, 'Due Fee', '1000.00'),
(810, 616, 'Due Fee', '1000.00');

-- --------------------------------------------------------

--
-- Table structure for table `student_logs`
--

CREATE TABLE `student_logs` (
  `id` int(11) NOT NULL,
  `student_session_id` int(11) NOT NULL,
  `new_admission` tinyint(1) NOT NULL DEFAULT '0',
  `promote` tinyint(1) NOT NULL DEFAULT '0',
  `demote` tinyint(1) NOT NULL DEFAULT '0',
  `free` tinyint(1) NOT NULL DEFAULT '0',
  `without_fee` tinyint(1) NOT NULL DEFAULT '0',
  `struck_off` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_logs`
--

INSERT INTO `student_logs` (`id`, `student_session_id`, `new_admission`, `promote`, `demote`, `free`, `without_fee`, `struck_off`, `created_on`) VALUES
(1, 2, 0, 0, 1, 0, 0, 0, '2017-12-28'),
(2, 3, 0, 0, 1, 0, 0, 0, '2017-12-28'),
(3, 4, 0, 1, 0, 0, 0, 0, '2017-12-28'),
(4, 6, 0, 1, 0, 0, 0, 0, '2017-12-28'),
(5, 7, 1, 0, 0, 0, 0, 0, '2018-01-25'),
(6, 8, 1, 0, 0, 0, 0, 0, '2018-01-25'),
(7, 9, 1, 0, 0, 0, 0, 0, '2018-01-25'),
(8, 10, 1, 0, 0, 0, 0, 0, '2018-01-25'),
(9, 11, 1, 0, 0, 0, 0, 0, '2018-01-26'),
(10, 12, 1, 0, 0, 0, 0, 0, '2018-01-31'),
(11, 13, 1, 0, 0, 0, 0, 0, '2018-01-31'),
(12, 14, 1, 0, 0, 1, 1, 0, '2018-01-31'),
(13, 16, 1, 0, 0, 0, 1, 0, '2018-02-27'),
(14, 17, 1, 0, 0, 0, 0, 0, '2018-02-27'),
(15, 18, 1, 0, 0, 0, 0, 0, '2018-02-27'),
(16, 19, 1, 0, 0, 0, 1, 0, '2018-02-27'),
(17, 20, 1, 0, 0, 1, 0, 0, '2018-02-27'),
(18, 21, 1, 0, 0, 0, 0, 0, '2018-03-07'),
(19, 22, 1, 0, 0, 0, 0, 0, '2018-03-16'),
(20, 23, 1, 0, 0, 0, 1, 0, '2018-03-30'),
(21, 24, 1, 0, 0, 0, 1, 0, '2018-03-30'),
(22, 25, 1, 0, 0, 0, 0, 0, '2018-04-01'),
(23, 26, 1, 0, 0, 0, 0, 0, '2018-04-09'),
(24, 27, 1, 0, 0, 0, 0, 0, '2018-04-09'),
(25, 28, 1, 0, 0, 0, 0, 0, '2018-04-09'),
(26, 29, 1, 0, 0, 1, 0, 0, '2018-04-10'),
(27, 1, 1, 0, 0, 0, 0, 0, '2018-05-16'),
(28, 30, 1, 0, 0, 0, 0, 0, '2018-05-16'),
(29, 31, 1, 0, 0, 0, 0, 0, '2018-05-16'),
(30, 1, 1, 0, 0, 0, 0, 0, '2018-05-16'),
(31, 32, 1, 0, 0, 0, 0, 0, '2018-05-16'),
(32, 33, 1, 0, 0, 0, 0, 0, '2018-05-16'),
(33, 34, 1, 0, 0, 0, 0, 0, '2018-05-17'),
(34, 65, 1, 0, 0, 1, 0, 0, '2018-06-01'),
(35, 78, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(36, 79, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(37, 80, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(38, 81, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(39, 82, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(40, 83, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(41, 84, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(42, 85, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(43, 86, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(44, 87, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(45, 88, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(46, 89, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(47, 90, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(48, 91, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(49, 92, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(50, 93, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(51, 94, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(52, 95, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(53, 96, 0, 0, 0, 1, 0, 0, '2018-06-02'),
(54, 97, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(55, 98, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(56, 99, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(57, 100, 0, 0, 0, 1, 0, 0, '2018-06-02'),
(58, 101, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(59, 102, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(60, 103, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(61, 104, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(62, 105, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(63, 106, 0, 0, 0, 1, 0, 0, '2018-06-02'),
(64, 107, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(65, 108, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(66, 109, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(67, 110, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(68, 111, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(69, 112, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(70, 113, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(71, 114, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(72, 115, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(73, 116, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(74, 117, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(75, 118, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(76, 119, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(77, 120, 0, 0, 0, 1, 0, 0, '2018-06-02'),
(78, 121, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(79, 122, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(80, 123, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(81, 124, 0, 0, 0, 1, 0, 0, '2018-06-02'),
(82, 125, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(83, 126, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(84, 127, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(85, 128, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(86, 129, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(87, 130, 0, 0, 0, 1, 0, 0, '2018-06-02'),
(88, 131, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(89, 132, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(90, 133, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(91, 134, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(92, 135, 0, 0, 0, 0, 0, 0, '2018-06-02'),
(93, 136, 1, 0, 0, 0, 0, 0, '2018-06-03'),
(94, 137, 1, 0, 0, 0, 0, 0, '2018-06-03'),
(95, 138, 1, 0, 0, 0, 0, 0, '2018-06-03'),
(96, 139, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(97, 140, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(98, 141, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(99, 142, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(100, 143, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(101, 144, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(102, 145, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(103, 146, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(104, 147, 0, 0, 0, 1, 0, 0, '2018-06-03'),
(105, 148, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(106, 149, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(107, 150, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(108, 151, 0, 0, 0, 1, 0, 0, '2018-06-03'),
(109, 152, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(110, 153, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(111, 154, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(112, 155, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(113, 156, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(114, 157, 0, 0, 0, 1, 0, 0, '2018-06-03'),
(115, 158, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(116, 159, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(117, 160, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(118, 161, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(119, 162, 0, 0, 0, 0, 0, 0, '2018-06-03'),
(120, 163, 1, 0, 0, 0, 0, 0, '2018-08-10'),
(121, 164, 1, 0, 0, 0, 0, 0, '2018-08-10'),
(122, 165, 1, 0, 0, 1, 0, 0, '2018-09-01'),
(123, 166, 1, 0, 0, 1, 0, 0, '2018-08-15'),
(124, 167, 1, 0, 0, 0, 0, 0, '2018-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `student_session`
--

CREATE TABLE `student_session` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `route_id` int(11) NOT NULL,
  `vehroute_id` int(10) DEFAULT NULL,
  `transport_fees` float(10,2) NOT NULL DEFAULT '0.00',
  `fees_discount` float(10,2) NOT NULL DEFAULT '0.00',
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_session`
--

INSERT INTO `student_session` (`id`, `session_id`, `student_id`, `class_id`, `section_id`, `route_id`, `vehroute_id`, `transport_fees`, `fees_discount`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 12, 0, 8, 1, 0, 0, 0.00, 0.00, 'no', '2018-05-16 07:50:08', '0000-00-00 00:00:00'),
(2, 12, 1, 1, 1, 0, 1, 0.00, 0.00, 'no', '2017-11-15 05:48:16', '0000-00-00 00:00:00'),
(3, 12, 2, 1, 1, 0, 0, 0.00, 0.00, 'no', '2017-10-02 05:06:26', '0000-00-00 00:00:00'),
(4, 12, 3, 1, 1, 0, 0, 0.00, 0.00, 'no', '2017-11-15 05:48:16', '0000-00-00 00:00:00'),
(6, 12, 5, 1, 1, 0, 0, 0.00, 0.00, 'no', '2017-11-22 06:32:23', '0000-00-00 00:00:00'),
(7, 12, 6, 1, 1, 0, 0, 0.00, 0.00, 'no', '2018-01-25 05:30:56', '0000-00-00 00:00:00'),
(8, 12, 7, 1, 1, 0, 0, 0.00, 0.00, 'no', '2018-01-25 05:32:03', '0000-00-00 00:00:00'),
(9, 12, 8, 1, 1, 0, 0, 0.00, 0.00, 'no', '2018-01-25 05:38:02', '0000-00-00 00:00:00'),
(10, 12, 9, 1, 1, 0, 0, 0.00, 0.00, 'no', '2018-01-25 05:41:28', '0000-00-00 00:00:00'),
(11, 12, 10, 2, 1, 0, 0, 0.00, 0.00, 'no', '2018-01-25 19:08:29', '0000-00-00 00:00:00'),
(12, 12, 11, 1, 1, 0, 0, 0.00, 0.00, 'no', '2018-01-31 06:38:53', '0000-00-00 00:00:00'),
(13, 12, 12, 1, 1, 0, 0, 0.00, 0.00, 'no', '2018-01-31 06:50:03', '0000-00-00 00:00:00'),
(14, 12, 13, 1, 1, 0, 0, 0.00, 0.00, 'no', '2018-01-31 07:28:48', '0000-00-00 00:00:00'),
(15, 12, 14, 1, 1, 0, NULL, 0.00, 0.00, 'no', '2018-02-01 06:26:27', '0000-00-00 00:00:00'),
(16, 12, 15, 4, 1, 0, 0, 0.00, 0.00, 'no', '2018-02-27 07:40:13', '0000-00-00 00:00:00'),
(17, 12, 16, 4, 1, 0, 0, 0.00, 0.00, 'no', '2018-02-27 07:43:08', '0000-00-00 00:00:00'),
(18, 12, 17, 3, 1, 0, 0, 0.00, 0.00, 'no', '2018-02-27 10:10:53', '0000-00-00 00:00:00'),
(19, 12, 18, 1, 1, 0, 0, 0.00, 0.00, 'no', '2018-02-27 10:24:31', '0000-00-00 00:00:00'),
(20, 12, 19, 1, 1, 0, 0, 0.00, 0.00, 'no', '2018-02-27 10:25:08', '0000-00-00 00:00:00'),
(21, 12, 20, 1, 1, 0, 0, 0.00, 0.00, 'no', '2018-03-07 06:42:18', '0000-00-00 00:00:00'),
(22, 12, 21, 5, 1, 0, 0, 0.00, 0.00, 'no', '2018-03-16 06:14:22', '0000-00-00 00:00:00'),
(23, 12, 22, 3, 1, 0, 0, 0.00, 0.00, 'no', '2018-03-30 11:19:19', '0000-00-00 00:00:00'),
(24, 12, 23, 3, 1, 0, 0, 0.00, 0.00, 'no', '2018-03-30 11:27:36', '0000-00-00 00:00:00'),
(25, 12, 24, 6, 1, 0, 0, 0.00, 0.00, 'no', '2018-04-01 07:01:13', '0000-00-00 00:00:00'),
(26, 12, 25, 1, 1, 0, 0, 0.00, 0.00, 'no', '2018-04-09 10:31:50', '0000-00-00 00:00:00'),
(27, 12, 26, 1, 1, 0, 0, 0.00, 0.00, 'no', '2018-04-09 10:33:03', '0000-00-00 00:00:00'),
(28, 12, 27, 1, 1, 0, 0, 0.00, 0.00, 'no', '2018-04-09 10:33:55', '0000-00-00 00:00:00'),
(29, 12, 28, 2, 1, 0, 0, 0.00, 0.00, 'no', '2018-04-10 05:42:57', '0000-00-00 00:00:00'),
(30, 12, 29, 7, 1, 0, 0, 0.00, 0.00, 'no', '2018-05-16 07:20:02', '0000-00-00 00:00:00'),
(31, 12, 30, 7, 1, 0, 0, 0.00, 0.00, 'no', '2018-05-16 07:20:48', '0000-00-00 00:00:00'),
(32, 12, 31, 8, 1, 0, 0, 0.00, 0.00, 'no', '2018-05-16 07:51:13', '0000-00-00 00:00:00'),
(33, 12, 32, 8, 1, 0, 0, 0.00, 0.00, 'no', '2018-05-16 07:53:11', '0000-00-00 00:00:00'),
(34, 12, 33, 2, 1, 0, 0, 0.00, 0.00, 'no', '2018-05-17 06:49:14', '0000-00-00 00:00:00'),
(35, 12, 34, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:36:34', '0000-00-00 00:00:00'),
(36, 12, 35, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:36:34', '0000-00-00 00:00:00'),
(37, 12, 36, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:36:34', '0000-00-00 00:00:00'),
(38, 12, 37, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:36:34', '0000-00-00 00:00:00'),
(39, 12, 38, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:36:34', '0000-00-00 00:00:00'),
(40, 12, 39, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:36:34', '0000-00-00 00:00:00'),
(41, 12, 40, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:36:35', '0000-00-00 00:00:00'),
(42, 12, 41, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:36:35', '0000-00-00 00:00:00'),
(43, 12, 42, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:36:35', '0000-00-00 00:00:00'),
(44, 12, 43, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:36:35', '0000-00-00 00:00:00'),
(45, 12, 44, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:38:26', '0000-00-00 00:00:00'),
(46, 12, 45, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:38:26', '0000-00-00 00:00:00'),
(47, 12, 46, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:38:26', '0000-00-00 00:00:00'),
(48, 12, 47, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:38:26', '0000-00-00 00:00:00'),
(49, 12, 48, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:38:26', '0000-00-00 00:00:00'),
(50, 12, 49, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:38:27', '0000-00-00 00:00:00'),
(51, 12, 50, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:38:27', '0000-00-00 00:00:00'),
(52, 12, 51, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:38:27', '0000-00-00 00:00:00'),
(53, 12, 52, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:38:27', '0000-00-00 00:00:00'),
(54, 12, 53, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:38:27', '0000-00-00 00:00:00'),
(55, 12, 54, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:41:26', '0000-00-00 00:00:00'),
(56, 12, 55, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:41:26', '0000-00-00 00:00:00'),
(57, 12, 56, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:41:26', '0000-00-00 00:00:00'),
(58, 12, 57, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:41:26', '0000-00-00 00:00:00'),
(59, 12, 58, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:41:26', '0000-00-00 00:00:00'),
(60, 12, 59, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:41:26', '0000-00-00 00:00:00'),
(61, 12, 60, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:41:27', '0000-00-00 00:00:00'),
(62, 12, 61, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:41:27', '0000-00-00 00:00:00'),
(63, 12, 62, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:41:27', '0000-00-00 00:00:00'),
(64, 12, 63, 10, 1, 0, NULL, 0.00, 0.00, 'no', '2018-05-26 23:41:27', '0000-00-00 00:00:00'),
(65, 12, 64, 8, 1, 0, 0, 0.00, 0.00, 'no', '2018-05-31 19:30:04', '0000-00-00 00:00:00'),
(66, 12, 65, 1, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:41:51', '0000-00-00 00:00:00'),
(67, 12, 66, 1, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:41:51', '0000-00-00 00:00:00'),
(68, 12, 67, 1, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:41:51', '0000-00-00 00:00:00'),
(69, 12, 68, 1, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(70, 12, 69, 1, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(71, 12, 70, 1, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(72, 12, 71, 1, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(73, 12, 72, 1, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(74, 12, 73, 1, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(75, 12, 74, 1, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(76, 12, 75, 2, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:42:56', '0000-00-00 00:00:00'),
(77, 12, 76, 2, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:43:21', '0000-00-00 00:00:00'),
(78, 12, 77, 2, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:49:00', '0000-00-00 00:00:00'),
(79, 12, 78, 2, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(80, 12, 79, 2, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(81, 12, 80, 2, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(82, 12, 81, 2, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(83, 12, 82, 2, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(84, 12, 83, 2, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(85, 12, 84, 2, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(86, 12, 85, 2, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(87, 12, 86, 2, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(88, 12, 87, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:15', '0000-00-00 00:00:00'),
(89, 12, 88, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:15', '0000-00-00 00:00:00'),
(90, 12, 89, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:15', '0000-00-00 00:00:00'),
(91, 12, 90, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:15', '0000-00-00 00:00:00'),
(92, 12, 91, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(93, 12, 92, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(94, 12, 93, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(95, 12, 94, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(96, 12, 95, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(97, 12, 96, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(98, 12, 97, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(99, 12, 98, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(100, 12, 99, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(101, 12, 100, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(102, 12, 101, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(103, 12, 102, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(104, 12, 103, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(105, 12, 104, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(106, 12, 105, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(107, 12, 106, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:18', '0000-00-00 00:00:00'),
(108, 12, 107, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:18', '0000-00-00 00:00:00'),
(109, 12, 108, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:18', '0000-00-00 00:00:00'),
(110, 12, 109, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:18', '0000-00-00 00:00:00'),
(111, 12, 110, 11, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:53:18', '0000-00-00 00:00:00'),
(112, 12, 111, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(113, 12, 112, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(114, 12, 113, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(115, 12, 114, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(116, 12, 115, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(117, 12, 116, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(118, 12, 117, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(119, 12, 118, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(120, 12, 119, 9, 1, 0, 0, 0.00, 0.00, 'no', '2018-06-02 20:24:16', '0000-00-00 00:00:00'),
(121, 12, 120, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(122, 12, 121, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(123, 12, 122, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(124, 12, 123, 9, 1, 0, 0, 0.00, 0.00, 'no', '2018-06-02 20:23:03', '0000-00-00 00:00:00'),
(125, 12, 124, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(126, 12, 125, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(127, 12, 126, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(128, 12, 127, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(129, 12, 128, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(130, 12, 129, 9, 1, 0, 0, 0.00, 0.00, 'no', '2018-06-02 20:24:27', '0000-00-00 00:00:00'),
(131, 12, 130, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(132, 12, 131, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(133, 12, 132, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(134, 12, 133, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(135, 12, 134, 9, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-01 22:55:42', '0000-00-00 00:00:00'),
(136, 12, 135, 3, 1, 0, 0, 0.00, 0.00, 'no', '2018-06-02 20:58:34', '0000-00-00 00:00:00'),
(137, 12, 136, 3, 1, 0, 0, 0.00, 0.00, 'no', '2018-06-02 21:03:00', '0000-00-00 00:00:00'),
(138, 12, 137, 3, 1, 0, 0, 0.00, 0.00, 'no', '2018-06-02 21:53:32', '0000-00-00 00:00:00'),
(139, 12, 138, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:04', '0000-00-00 00:00:00'),
(140, 12, 139, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:04', '0000-00-00 00:00:00'),
(141, 12, 140, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:04', '0000-00-00 00:00:00'),
(142, 12, 141, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(143, 12, 142, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(144, 12, 143, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(145, 12, 144, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(146, 12, 145, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(147, 12, 146, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(148, 12, 147, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(149, 12, 148, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(150, 12, 149, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(151, 12, 150, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(152, 12, 151, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(153, 12, 152, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(154, 12, 153, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(155, 12, 154, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(156, 12, 155, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(157, 12, 156, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(158, 12, 157, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(159, 12, 158, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:07', '0000-00-00 00:00:00'),
(160, 12, 159, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:07', '0000-00-00 00:00:00'),
(161, 12, 160, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:07', '0000-00-00 00:00:00'),
(162, 12, 161, 12, 1, 0, NULL, 0.00, 0.00, 'no', '2018-06-02 21:59:07', '0000-00-00 00:00:00'),
(163, 12, 162, 6, 1, 0, 0, 0.00, 0.00, 'no', '2018-08-10 07:26:41', '0000-00-00 00:00:00'),
(164, 12, 163, 1, 1, 0, 0, 0.00, 0.00, 'no', '2018-08-10 07:48:20', '0000-00-00 00:00:00'),
(165, 12, 164, 7, 1, 0, 0, 0.00, 0.00, 'no', '2018-09-01 13:20:22', '0000-00-00 00:00:00'),
(166, 12, 165, 7, 1, 0, 0, 0.00, 0.00, 'no', '2018-08-15 05:58:29', '0000-00-00 00:00:00'),
(167, 12, 166, 1, 1, 0, 0, 0.00, 0.00, 'no', '2018-08-17 06:42:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_sibling`
--

CREATE TABLE `student_sibling` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `sibling_student_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_transport_fees`
--

CREATE TABLE `student_transport_fees` (
  `id` int(11) NOT NULL,
  `student_session_id` int(11) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `amount_discount` float(10,2) NOT NULL,
  `amount_fine` float(10,2) NOT NULL DEFAULT '0.00',
  `description` text COLLATE utf8_unicode_ci,
  `date` date DEFAULT '0000-00-00',
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `payment_mode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `type`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Urdu', 'urdu', 'Theory', 'no', '2017-09-20 08:10:30', '0000-00-00 00:00:00'),
(2, 'English', '123', 'Theory', 'no', '2017-10-03 06:01:36', '0000-00-00 00:00:00'),
(3, 'Maths', '1', 'Theory', 'no', '2017-10-03 06:01:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `teacher_id` int(30) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `dob` date DEFAULT NULL,
  `designation` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `joining_date` date DEFAULT NULL,
  `qualification` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qualification_details` text COLLATE utf8_unicode_ci,
  `teacher_type_id` int(10) UNSIGNED NOT NULL,
  `teacher_salary` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `due_salary` int(11) NOT NULL DEFAULT '0' COMMENT 'How much salary is due in account. It can be negative value.',
  `salary_update_date` date NOT NULL DEFAULT '0000-00-00',
  `fingerprint_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `teacher_id`, `name`, `email`, `password`, `address`, `dob`, `designation`, `sex`, `phone`, `image`, `is_active`, `joining_date`, `qualification`, `qualification_details`, `teacher_type_id`, `teacher_salary`, `due_salary`, `salary_update_date`, `fingerprint_file`, `created_at`, `updated_at`) VALUES
(18, 1, 'khraum', 'khuram@gmail.com', NULL, 'green town milat road', '2018-08-20', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-08-13', '', '', 1, 10000, 0, '2018-10-01', NULL, '2018-08-17 06:15:24', '0000-00-00 00:00:00'),
(19, 2, 'test', 'test@gmail.com', NULL, 'gdsafdsafds', '2018-08-13', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-08-13', '', '', 1, 10000, 30000, '2018-10-01', NULL, '2018-10-01 13:21:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_attendance`
--

CREATE TABLE `teacher_attendance` (
  `teacher_attendance_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `teacher_attendence_type_id` int(11) NOT NULL,
  `attendance_date` date NOT NULL DEFAULT '0000-00-00',
  `attendance_time` time DEFAULT NULL,
  `attendance_lecture_based` tinyint(1) NOT NULL DEFAULT '0',
  `attended_lectures` int(11) NOT NULL DEFAULT '0',
  `total_lectures` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_attendance`
--

INSERT INTO `teacher_attendance` (`teacher_attendance_id`, `teacher_id`, `teacher_attendence_type_id`, `attendance_date`, `attendance_time`, `attendance_lecture_based`, `attended_lectures`, `total_lectures`) VALUES
(1, 1, 2, '2018-04-05', '11:30:54', 0, 0, 0),
(2, 2, 2, '2018-04-05', '11:30:54', 0, 0, 0),
(3, 3, 2, '2018-04-05', '11:30:54', 0, 0, 0),
(4, 4, 2, '2018-04-05', '11:30:54', 0, 0, 0),
(5, 5, 2, '2018-04-05', '11:30:54', 0, 0, 0),
(6, 7, 2, '2018-04-05', '11:30:54', 0, 0, 0),
(7, 8, 2, '2018-04-05', '11:30:54', 0, 0, 0),
(8, 9, 2, '2018-04-05', '11:30:54', 0, 0, 0),
(9, 10, 2, '2018-04-05', '11:30:54', 0, 0, 0),
(10, 11, 2, '2018-04-05', '11:30:54', 0, 0, 0),
(11, 1, 2, '2018-04-06', '10:39:47', 0, 0, 0),
(12, 2, 2, '2018-04-06', '10:39:47', 0, 0, 0),
(13, 3, 2, '2018-04-06', '10:39:47', 0, 0, 0),
(14, 4, 2, '2018-04-06', '10:39:47', 0, 0, 0),
(15, 5, 2, '2018-04-06', '10:39:47', 0, 0, 0),
(16, 7, 2, '2018-04-06', '10:39:47', 0, 0, 0),
(17, 8, 2, '2018-04-06', '10:39:47', 0, 0, 0),
(18, 9, 2, '2018-04-06', '10:39:47', 0, 0, 0),
(19, 10, 2, '2018-04-06', '10:39:47', 0, 0, 0),
(20, 11, 2, '2018-04-06', '10:39:47', 0, 0, 0),
(21, 1, 2, '2018-03-28', '13:04:15', 0, 0, 0),
(22, 10, 2, '2018-03-28', '13:04:15', 0, 0, 0),
(23, 5, 2, '2018-03-28', '13:04:15', 1, 0, 2),
(24, 11, 2, '2018-03-28', '13:04:15', 0, 0, 0),
(25, 3, 1, '2018-03-28', '13:04:15', 0, 0, 0),
(26, 9, 1, '2018-03-28', '13:04:15', 0, 0, 0),
(27, 4, 1, '2018-03-28', '13:04:15', 0, 0, 0),
(28, 2, 1, '2018-03-28', '13:04:15', 0, 0, 0),
(29, 8, 1, '2018-03-28', '13:04:15', 0, 0, 0),
(30, 7, 1, '2018-03-28', '13:04:15', 0, 0, 0),
(31, 1, 2, '2018-04-09', '15:09:51', 0, 0, 0),
(32, 2, 2, '2018-04-09', '15:09:51', 0, 0, 0),
(33, 3, 2, '2018-04-09', '15:09:51', 0, 0, 0),
(34, 4, 2, '2018-04-09', '15:09:51', 0, 0, 0),
(35, 5, 2, '2018-04-09', '15:09:51', 0, 0, 0),
(36, 7, 2, '2018-04-09', '15:09:51', 0, 0, 0),
(37, 8, 2, '2018-04-09', '15:09:51', 0, 0, 0),
(38, 9, 2, '2018-04-09', '15:09:51', 0, 0, 0),
(39, 10, 2, '2018-04-09', '15:09:51', 0, 0, 0),
(40, 11, 2, '2018-04-09', '15:09:51', 0, 0, 0),
(41, 1, 2, '2018-04-10', '10:40:33', 0, 0, 0),
(42, 2, 2, '2018-04-10', '10:40:33', 0, 0, 0),
(43, 3, 2, '2018-04-10', '10:40:33', 0, 0, 0),
(44, 4, 2, '2018-04-10', '10:40:33', 0, 0, 0),
(45, 5, 2, '2018-04-10', '10:40:33', 0, 0, 0),
(46, 7, 2, '2018-04-10', '10:40:33', 0, 0, 0),
(47, 8, 2, '2018-04-10', '10:40:33', 0, 0, 0),
(48, 9, 2, '2018-04-10', '10:40:33', 0, 0, 0),
(49, 10, 2, '2018-04-10', '10:40:33', 0, 0, 0),
(50, 11, 2, '2018-04-10', '10:40:33', 0, 0, 0),
(51, 1, 2, '2018-04-17', '14:39:44', 0, 0, 0),
(52, 2, 2, '2018-04-17', '14:39:44', 0, 0, 0),
(53, 3, 2, '2018-04-17', '14:39:44', 0, 0, 0),
(54, 4, 2, '2018-04-17', '14:39:44', 0, 0, 0),
(55, 5, 2, '2018-04-17', '14:39:44', 0, 0, 0),
(56, 7, 2, '2018-04-17', '14:39:44', 0, 0, 0),
(57, 8, 2, '2018-04-17', '14:39:44', 0, 0, 0),
(58, 9, 2, '2018-04-17', '14:39:44', 0, 0, 0),
(59, 10, 2, '2018-04-17', '14:39:44', 0, 0, 0),
(60, 11, 2, '2018-04-17', '14:39:44', 0, 0, 0),
(61, 1, 2, '2018-04-23', '12:59:38', 0, 0, 0),
(62, 2, 2, '2018-04-23', '12:59:38', 0, 0, 0),
(63, 3, 2, '2018-04-23', '12:59:38', 0, 0, 0),
(64, 4, 2, '2018-04-23', '12:59:38', 0, 0, 0),
(65, 5, 2, '2018-04-23', '12:59:38', 0, 0, 0),
(66, 7, 2, '2018-04-23', '12:59:38', 0, 0, 0),
(67, 8, 2, '2018-04-23', '12:59:38', 0, 0, 0),
(68, 9, 2, '2018-04-23', '12:59:38', 0, 0, 0),
(69, 10, 2, '2018-04-23', '12:59:38', 0, 0, 0),
(70, 11, 2, '2018-04-23', '12:59:38', 0, 0, 0),
(71, 1, 2, '2018-04-29', '17:37:06', 0, 0, 0),
(72, 2, 2, '2018-04-29', '17:37:06', 0, 0, 0),
(73, 3, 2, '2018-04-29', '17:37:06', 0, 0, 0),
(74, 4, 2, '2018-04-29', '17:37:06', 0, 0, 0),
(75, 5, 2, '2018-04-29', '17:37:06', 0, 0, 0),
(76, 7, 2, '2018-04-29', '17:37:06', 0, 0, 0),
(77, 8, 2, '2018-04-29', '17:37:06', 0, 0, 0),
(78, 9, 2, '2018-04-29', '17:37:06', 0, 0, 0),
(79, 10, 2, '2018-04-29', '17:37:06', 0, 0, 0),
(80, 11, 2, '2018-04-29', '17:37:06', 0, 0, 0),
(91, 1, 1, '2018-05-01', '23:07:54', 0, 0, 0),
(92, 2, 2, '2018-05-01', '23:07:54', 0, 0, 0),
(93, 3, 1, '2018-05-01', '23:07:54', 0, 0, 0),
(94, 4, 2, '2018-05-01', '23:07:54', 0, 0, 0),
(95, 5, 2, '2018-05-01', '23:07:54', 1, 0, 2),
(96, 7, 2, '2018-05-01', '23:07:54', 0, 0, 0),
(97, 8, 2, '2018-05-01', '23:07:54', 0, 0, 0),
(98, 9, 1, '2018-05-01', '23:07:54', 0, 0, 0),
(99, 10, 1, '2018-05-01', '23:07:54', 0, 0, 0),
(100, 11, 2, '2018-05-01', '23:07:54', 0, 0, 0),
(101, 1, 2, '2018-05-16', '10:59:31', 0, 0, 0),
(102, 2, 2, '2018-05-16', '10:59:31', 0, 0, 0),
(103, 3, 2, '2018-05-16', '10:59:31', 0, 0, 0),
(104, 4, 2, '2018-05-16', '10:59:31', 0, 0, 0),
(105, 5, 2, '2018-05-16', '10:59:31', 0, 0, 0),
(106, 7, 2, '2018-05-16', '10:59:31', 0, 0, 0),
(107, 8, 2, '2018-05-16', '10:59:31', 0, 0, 0),
(108, 9, 2, '2018-05-16', '10:59:31', 0, 0, 0),
(109, 10, 2, '2018-05-16', '10:59:31', 0, 0, 0),
(110, 11, 2, '2018-05-16', '10:59:31', 0, 0, 0),
(111, 1, 2, '2018-05-17', '10:30:12', 0, 0, 0),
(112, 2, 2, '2018-05-17', '10:30:12', 0, 0, 0),
(113, 3, 2, '2018-05-17', '10:30:12', 0, 0, 0),
(114, 4, 2, '2018-05-17', '10:30:12', 0, 0, 0),
(115, 5, 2, '2018-05-17', '10:30:12', 0, 0, 0),
(116, 7, 2, '2018-05-17', '10:30:12', 0, 0, 0),
(117, 8, 2, '2018-05-17', '10:30:12', 0, 0, 0),
(118, 9, 2, '2018-05-17', '10:30:12', 0, 0, 0),
(119, 10, 2, '2018-05-17', '10:30:12', 0, 0, 0),
(120, 11, 2, '2018-05-17', '10:30:12', 0, 0, 0),
(121, 1, 2, '2018-05-28', '22:40:55', 0, 0, 0),
(122, 2, 2, '2018-05-28', '22:40:55', 0, 0, 0),
(123, 3, 2, '2018-05-28', '22:40:55', 0, 0, 0),
(124, 4, 2, '2018-05-28', '22:40:55', 0, 0, 0),
(125, 5, 2, '2018-05-28', '22:40:55', 0, 0, 0),
(126, 7, 2, '2018-05-28', '22:40:55', 0, 0, 0),
(127, 8, 2, '2018-05-28', '22:40:55', 0, 0, 0),
(128, 9, 2, '2018-05-28', '22:40:55', 0, 0, 0),
(129, 10, 2, '2018-05-28', '22:40:55', 0, 0, 0),
(130, 11, 2, '2018-05-28', '22:40:55', 0, 0, 0),
(131, 1, 2, '2018-05-31', '22:47:17', 0, 0, 0),
(132, 1, 2, '2018-05-31', '22:47:17', 0, 0, 0),
(133, 2, 2, '2018-05-31', '22:47:17', 0, 0, 0),
(134, 3, 2, '2018-05-31', '22:47:17', 0, 0, 0),
(135, 4, 2, '2018-05-31', '22:47:17', 0, 0, 0),
(136, 5, 2, '2018-05-31', '22:47:17', 0, 0, 0),
(137, 7, 2, '2018-05-31', '22:47:17', 0, 0, 0),
(138, 8, 2, '2018-05-31', '22:47:17', 0, 0, 0),
(139, 9, 2, '2018-05-31', '22:47:17', 0, 0, 0),
(140, 10, 2, '2018-05-31', '22:47:17', 0, 0, 0),
(141, 11, 2, '2018-05-31', '22:47:17', 0, 0, 0),
(142, 1, 2, '2018-06-09', '14:05:36', 0, 0, 0),
(143, 1, 2, '2018-06-09', '14:05:36', 0, 0, 0),
(144, 2, 2, '2018-06-09', '14:05:36', 0, 0, 0),
(145, 3, 2, '2018-06-09', '14:05:36', 0, 0, 0),
(146, 4, 2, '2018-06-09', '14:05:36', 0, 0, 0),
(147, 5, 2, '2018-06-09', '14:05:36', 0, 0, 0),
(148, 7, 2, '2018-06-09', '14:05:36', 0, 0, 0),
(149, 8, 2, '2018-06-09', '14:05:36', 0, 0, 0),
(150, 9, 2, '2018-06-09', '14:05:36', 0, 0, 0),
(151, 10, 2, '2018-06-09', '14:05:36', 0, 0, 0),
(152, 11, 2, '2018-06-09', '14:05:36', 0, 0, 0),
(153, 1, 2, '2018-06-19', '11:42:27', 0, 0, 0),
(154, 2, 2, '2018-06-19', '11:42:27', 0, 0, 0),
(155, 3, 2, '2018-06-19', '11:42:27', 0, 0, 0),
(156, 4, 2, '2018-06-19', '11:42:27', 0, 0, 0),
(157, 5, 2, '2018-06-19', '11:42:27', 0, 0, 0),
(158, 7, 2, '2018-06-19', '11:42:27', 0, 0, 0),
(159, 8, 2, '2018-06-19', '11:42:27', 0, 0, 0),
(160, 9, 2, '2018-06-19', '11:42:27', 0, 0, 0),
(161, 10, 2, '2018-06-19', '11:42:27', 0, 0, 0),
(162, 11, 2, '2018-06-19', '11:42:27', 0, 0, 0),
(163, 1, 2, '2018-06-20', '09:37:33', 0, 0, 0),
(164, 2, 2, '2018-06-20', '09:37:33', 0, 0, 0),
(165, 3, 2, '2018-06-20', '09:37:33', 0, 0, 0),
(166, 4, 2, '2018-06-20', '09:37:33', 0, 0, 0),
(167, 5, 2, '2018-06-20', '09:37:33', 0, 0, 0),
(168, 7, 2, '2018-06-20', '09:37:33', 0, 0, 0),
(169, 8, 2, '2018-06-20', '09:37:33', 0, 0, 0),
(170, 9, 2, '2018-06-20', '09:37:33', 0, 0, 0),
(171, 10, 2, '2018-06-20', '09:37:33', 0, 0, 0),
(172, 11, 2, '2018-06-20', '09:37:33', 0, 0, 0),
(173, 1, 2, '2018-07-06', '11:02:14', 0, 0, 0),
(174, 1, 2, '2018-07-06', '11:02:14', 0, 0, 0),
(175, 2, 2, '2018-07-06', '11:02:14', 0, 0, 0),
(176, 3, 2, '2018-07-06', '11:02:14', 0, 0, 0),
(177, 4, 2, '2018-07-06', '11:02:14', 0, 0, 0),
(178, 5, 2, '2018-07-06', '11:02:14', 0, 0, 0),
(179, 7, 2, '2018-07-06', '11:02:14', 0, 0, 0),
(180, 8, 2, '2018-07-06', '11:02:14', 0, 0, 0),
(181, 9, 2, '2018-07-06', '11:02:14', 0, 0, 0),
(182, 10, 2, '2018-07-06', '11:02:14', 0, 0, 0),
(183, 11, 2, '2018-07-06', '11:02:14', 0, 0, 0),
(184, 1, 2, '2018-07-07', '10:43:31', 0, 0, 0),
(185, 2, 2, '2018-07-07', '10:43:31', 0, 0, 0),
(186, 3, 2, '2018-07-07', '10:43:31', 0, 0, 0),
(187, 4, 2, '2018-07-07', '10:43:31', 0, 0, 0),
(188, 5, 2, '2018-07-07', '10:43:31', 0, 0, 0),
(189, 7, 2, '2018-07-07', '10:43:31', 0, 0, 0),
(190, 8, 2, '2018-07-07', '10:43:31', 0, 0, 0),
(191, 9, 2, '2018-07-07', '10:43:31', 0, 0, 0),
(192, 10, 2, '2018-07-07', '10:43:31', 0, 0, 0),
(193, 11, 2, '2018-07-07', '10:43:31', 0, 0, 0),
(194, 1, 2, '2018-07-09', '12:00:19', 0, 0, 0),
(195, 2, 2, '2018-07-09', '12:00:19', 0, 0, 0),
(196, 3, 2, '2018-07-09', '12:00:19', 0, 0, 0),
(197, 4, 2, '2018-07-09', '12:00:19', 0, 0, 0),
(198, 5, 2, '2018-07-09', '12:00:19', 0, 0, 0),
(199, 7, 2, '2018-07-09', '12:00:19', 0, 0, 0),
(200, 8, 2, '2018-07-09', '12:00:19', 0, 0, 0),
(201, 9, 2, '2018-07-09', '12:00:19', 0, 0, 0),
(202, 10, 2, '2018-07-09', '12:00:19', 0, 0, 0),
(203, 11, 2, '2018-07-09', '12:00:19', 0, 0, 0),
(204, 1, 2, '2018-07-10', '11:48:31', 0, 0, 0),
(205, 1, 2, '2018-07-10', '11:48:31', 0, 0, 0),
(206, 2, 2, '2018-07-10', '11:48:31', 0, 0, 0),
(207, 3, 2, '2018-07-10', '11:48:31', 0, 0, 0),
(208, 4, 2, '2018-07-10', '11:48:31', 0, 0, 0),
(209, 5, 2, '2018-07-10', '11:48:31', 0, 0, 0),
(210, 7, 2, '2018-07-10', '11:48:31', 0, 0, 0),
(211, 8, 2, '2018-07-10', '11:48:31', 0, 0, 0),
(212, 9, 2, '2018-07-10', '11:48:31', 0, 0, 0),
(213, 10, 2, '2018-07-10', '11:48:31', 0, 0, 0),
(214, 11, 2, '2018-07-10', '11:48:31', 0, 0, 0),
(215, 1, 2, '2018-07-12', '15:02:48', 0, 0, 0),
(216, 1, 2, '2018-07-12', '15:02:48', 0, 0, 0),
(217, 2, 2, '2018-07-12', '15:02:48', 0, 0, 0),
(218, 3, 2, '2018-07-12', '15:02:48', 0, 0, 0),
(219, 4, 2, '2018-07-12', '15:02:48', 0, 0, 0),
(220, 5, 2, '2018-07-12', '15:02:48', 0, 0, 0),
(221, 7, 2, '2018-07-12', '15:02:48', 0, 0, 0),
(222, 8, 2, '2018-07-12', '15:02:48', 0, 0, 0),
(223, 9, 2, '2018-07-12', '15:02:48', 0, 0, 0),
(224, 10, 2, '2018-07-12', '15:02:48', 0, 0, 0),
(225, 11, 2, '2018-07-12', '15:02:48', 0, 0, 0),
(226, 1, 2, '2018-07-13', '10:28:37', 0, 0, 0),
(227, 2, 2, '2018-07-13', '10:28:37', 0, 0, 0),
(228, 3, 2, '2018-07-13', '10:28:37', 0, 0, 0),
(229, 4, 2, '2018-07-13', '10:28:37', 0, 0, 0),
(230, 5, 2, '2018-07-13', '10:28:37', 0, 0, 0),
(231, 7, 2, '2018-07-13', '10:28:37', 0, 0, 0),
(232, 8, 2, '2018-07-13', '10:28:37', 0, 0, 0),
(233, 9, 2, '2018-07-13', '10:28:37', 0, 0, 0),
(234, 10, 2, '2018-07-13', '10:28:37', 0, 0, 0),
(235, 11, 2, '2018-07-13', '10:28:37', 0, 0, 0),
(236, 1, 2, '2018-08-07', '16:05:06', 0, 0, 0),
(237, 2, 2, '2018-08-07', '16:05:06', 0, 0, 0),
(238, 3, 2, '2018-08-07', '16:05:06', 0, 0, 0),
(239, 4, 2, '2018-08-07', '16:05:06', 0, 0, 0),
(240, 5, 2, '2018-08-07', '16:05:06', 0, 0, 0),
(241, 7, 2, '2018-08-07', '16:05:06', 0, 0, 0),
(242, 8, 2, '2018-08-07', '16:05:06', 0, 0, 0),
(243, 9, 2, '2018-08-07', '16:05:06', 0, 0, 0),
(244, 10, 2, '2018-08-07', '16:05:06', 0, 0, 0),
(245, 11, 2, '2018-08-07', '16:05:06', 0, 0, 0),
(246, 1, 2, '2018-08-08', '10:39:26', 0, 0, 0),
(247, 2, 2, '2018-08-08', '10:39:26', 0, 0, 0),
(248, 3, 2, '2018-08-08', '10:39:26', 0, 0, 0),
(249, 4, 2, '2018-08-08', '10:39:26', 0, 0, 0),
(250, 5, 2, '2018-08-08', '10:39:26', 0, 0, 0),
(251, 7, 2, '2018-08-08', '10:39:26', 0, 0, 0),
(252, 8, 2, '2018-08-08', '10:39:26', 0, 0, 0),
(253, 9, 2, '2018-08-08', '10:39:26', 0, 0, 0),
(254, 10, 2, '2018-08-08', '10:39:26', 0, 0, 0),
(255, 11, 2, '2018-08-08', '10:39:26', 0, 0, 0),
(256, 1, 2, '2018-08-09', '21:10:06', 0, 0, 0),
(257, 2, 2, '2018-08-09', '21:10:06', 0, 0, 0),
(258, 3, 2, '2018-08-09', '21:10:06', 0, 0, 0),
(259, 4, 2, '2018-08-09', '21:10:06', 0, 0, 0),
(260, 5, 2, '2018-08-09', '21:10:06', 0, 0, 0),
(261, 7, 2, '2018-08-09', '21:10:06', 0, 0, 0),
(262, 8, 2, '2018-08-09', '21:10:06', 0, 0, 0),
(263, 9, 2, '2018-08-09', '21:10:06', 0, 0, 0),
(264, 10, 2, '2018-08-09', '21:10:06', 0, 0, 0),
(265, 11, 2, '2018-08-09', '21:10:06', 0, 0, 0),
(266, 1, 2, '2018-08-10', '11:32:41', 0, 0, 0),
(267, 1, 2, '2018-08-10', '11:32:41', 0, 0, 0),
(268, 2, 2, '2018-08-10', '11:32:41', 0, 0, 0),
(269, 3, 2, '2018-08-10', '11:32:41', 0, 0, 0),
(270, 4, 2, '2018-08-10', '11:32:41', 0, 0, 0),
(271, 5, 2, '2018-08-10', '11:32:41', 0, 0, 0),
(272, 7, 2, '2018-08-10', '11:32:41', 0, 0, 0),
(273, 8, 2, '2018-08-10', '11:32:41', 0, 0, 0),
(274, 9, 2, '2018-08-10', '11:32:41', 0, 0, 0),
(275, 10, 2, '2018-08-10', '11:32:41', 0, 0, 0),
(276, 11, 2, '2018-08-10', '11:32:41', 0, 0, 0),
(277, 1, 2, '2018-08-11', '10:55:31', 0, 0, 0),
(278, 2, 2, '2018-08-11', '10:55:31', 0, 0, 0),
(279, 3, 2, '2018-08-11', '10:55:31', 0, 0, 0),
(280, 4, 2, '2018-08-11', '10:55:31', 0, 0, 0),
(281, 5, 2, '2018-08-11', '10:55:31', 0, 0, 0),
(282, 7, 2, '2018-08-11', '10:55:31', 0, 0, 0),
(283, 8, 2, '2018-08-11', '10:55:31', 0, 0, 0),
(284, 9, 2, '2018-08-11', '10:55:31', 0, 0, 0),
(285, 10, 2, '2018-08-11', '10:55:31', 0, 0, 0),
(286, 11, 2, '2018-08-11', '10:55:31', 0, 0, 0),
(287, 1, 2, '2018-08-13', '10:50:33', 0, 0, 0),
(288, 2, 2, '2018-08-13', '10:50:33', 0, 0, 0),
(289, 3, 2, '2018-08-13', '10:50:33', 0, 0, 0),
(290, 4, 2, '2018-08-13', '10:50:33', 0, 0, 0),
(291, 5, 2, '2018-08-13', '10:50:33', 0, 0, 0),
(292, 7, 2, '2018-08-13', '10:50:33', 0, 0, 0),
(293, 8, 2, '2018-08-13', '10:50:33', 0, 0, 0),
(294, 9, 2, '2018-08-13', '10:50:33', 0, 0, 0),
(295, 10, 2, '2018-08-13', '10:50:33', 0, 0, 0),
(296, 11, 2, '2018-08-13', '10:50:33', 0, 0, 0),
(297, 12, 2, '2018-08-13', '13:26:21', 0, 0, 0),
(298, 13, 2, '2018-08-13', '13:28:35', 0, 0, 0),
(299, 14, 2, '2018-08-13', '13:30:22', 0, 0, 0),
(300, 15, 2, '2018-08-13', '14:16:38', 0, 0, 0),
(301, 16, 2, '2018-08-13', '14:17:31', 0, 0, 0),
(302, 17, 2, '2018-08-13', '14:21:02', 0, 0, 0),
(303, 18, 2, '2018-08-13', '14:22:43', 0, 0, 0),
(304, 19, 2, '2018-08-13', '14:25:16', 0, 0, 0),
(305, 18, 2, '2018-09-01', '18:17:54', 0, 0, 0),
(306, 19, 2, '2018-09-01', '18:17:54', 0, 0, 0),
(307, 18, 2, '2018-10-01', '18:21:25', 0, 0, 0),
(308, 19, 2, '2018-10-01', '18:21:25', 0, 0, 0),
(309, 18, 2, '2018-08-15', '10:15:31', 0, 0, 0),
(310, 19, 2, '2018-08-15', '10:15:31', 0, 0, 0),
(311, 18, 2, '2018-08-16', '10:42:58', 0, 0, 0),
(312, 19, 2, '2018-08-16', '10:42:58', 0, 0, 0),
(313, 18, 2, '2018-08-17', '10:43:56', 0, 0, 0),
(314, 19, 2, '2018-08-17', '10:43:56', 0, 0, 0),
(315, 18, 2, '2018-08-18', '10:50:09', 0, 0, 0),
(316, 19, 2, '2018-08-18', '10:50:09', 0, 0, 0),
(317, 18, 2, '2018-08-20', '10:29:06', 0, 0, 0),
(318, 18, 2, '2018-08-20', '10:29:06', 0, 0, 0),
(319, 19, 2, '2018-08-20', '10:29:06', 0, 0, 0),
(320, 18, 2, '2018-08-21', '10:51:23', 0, 0, 0),
(321, 19, 2, '2018-08-21', '10:51:23', 0, 0, 0),
(322, 18, 2, '2018-08-25', '10:31:24', 0, 0, 0),
(323, 18, 2, '2018-08-25', '10:31:24', 0, 0, 0),
(324, 19, 2, '2018-08-25', '10:31:24', 0, 0, 0),
(325, 18, 1, '2018-08-27', '17:52:17', 0, 0, 0),
(326, 19, 2, '2018-08-27', '17:52:18', 0, 0, 0),
(327, 18, 1, '2018-08-28', '12:22:12', 0, 0, 0),
(328, 19, 2, '2018-08-28', '12:22:12', 0, 0, 0),
(329, 18, 1, '2018-08-29', '12:37:03', 0, 0, 0),
(330, 19, 1, '2018-08-29', '12:37:03', 0, 0, 0),
(331, 18, 2, '2018-08-30', '10:31:52', 0, 0, 0),
(332, 19, 2, '2018-08-30', '10:31:52', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_attendence_types`
--

CREATE TABLE `teacher_attendence_types` (
  `teacher_attendence_type_id` int(11) NOT NULL,
  `teacher_attendence_type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_attendence_types`
--

INSERT INTO `teacher_attendence_types` (`teacher_attendence_type_id`, `teacher_attendence_type_name`) VALUES
(1, 'present'),
(2, 'absent');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_salary_payments`
--

CREATE TABLE `teacher_salary_payments` (
  `teacher_salary_payment_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `due_salary` int(11) NOT NULL,
  `paid_salary` int(11) NOT NULL,
  `teacher_salary_payment_date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_salary_payments`
--

INSERT INTO `teacher_salary_payments` (`teacher_salary_payment_id`, `teacher_id`, `due_salary`, `paid_salary`, `teacher_salary_payment_date`) VALUES
(1, 1, 5000, 5000, '2017-10-20'),
(2, 5, 1500, 1500, '2018-02-13'),
(4, 1, 30000, 30000, '2018-04-03'),
(5, 18, 30000, 30000, '2018-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subjects`
--

CREATE TABLE `teacher_subjects` (
  `id` int(11) NOT NULL,
  `session_id` int(11) DEFAULT NULL,
  `class_section_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teacher_subjects`
--

INSERT INTO `teacher_subjects` (`id`, `session_id`, `class_section_id`, `subject_id`, `teacher_id`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 12, 2, 1, 18, NULL, 'no', '2018-08-30 11:50:24', '0000-00-00 00:00:00'),
(2, 12, 2, 0, 0, NULL, 'no', '2017-09-20 08:11:03', '0000-00-00 00:00:00'),
(3, 12, 1, 1, 18, NULL, 'no', '2018-08-25 10:25:04', '0000-00-00 00:00:00'),
(4, 12, 1, 2, 19, NULL, 'no', '2018-08-25 10:25:04', '0000-00-00 00:00:00'),
(5, 12, 3, 1, 5, NULL, 'no', '2017-10-14 12:43:32', '0000-00-00 00:00:00'),
(6, 12, 3, 3, 3, NULL, 'no', '2017-10-14 12:43:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_types`
--

CREATE TABLE `teacher_types` (
  `teacher_type_id` int(10) UNSIGNED NOT NULL,
  `teacher_type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_types`
--

INSERT INTO `teacher_types` (`teacher_type_id`, `teacher_type_name`) VALUES
(1, 'permanent'),
(2, 'per lecture');

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `id` int(11) NOT NULL,
  `teacher_subject_id` int(20) DEFAULT NULL,
  `day_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_time` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_time` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `room_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`id`, `teacher_subject_id`, `day_name`, `start_time`, `end_time`, `room_no`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 3, 'Monday', '', '02:00 PM', 'Language room 10', 'no', '2018-08-30 11:32:10', '0000-00-00 00:00:00'),
(2, 3, 'Tuesday', '01:00 PM', '02:00 PM', 'Language room 10', 'no', '2017-10-03 06:04:51', '0000-00-00 00:00:00'),
(3, 3, 'Wednesday', '01:00 PM', '02:00 PM', 'Language room 10', 'no', '2017-10-03 06:04:51', '0000-00-00 00:00:00'),
(4, 3, 'Thursday', '01:00 PM', '02:00 PM', 'Language room 10', 'no', '2017-10-03 06:04:51', '0000-00-00 00:00:00'),
(5, 3, 'Friday', '01:00 PM', '02:00 PM', 'Language room 10', 'no', '2017-10-03 06:04:51', '0000-00-00 00:00:00'),
(6, 3, 'Saturday', '01:00 PM', '02:00 PM', 'Language room 10', 'no', '2017-10-03 06:04:51', '0000-00-00 00:00:00'),
(7, 3, 'Sunday', '', '', '', 'no', '2017-10-03 06:04:51', '0000-00-00 00:00:00'),
(8, 4, 'Monday', '08:00 AM', '09:00 AM', '8', 'no', '2017-10-09 06:13:46', '0000-00-00 00:00:00'),
(9, 4, 'Tuesday', '08:00 AM', '09:00 AM', '8', 'no', '2017-10-09 06:13:46', '0000-00-00 00:00:00'),
(10, 4, 'Wednesday', '08:00 AM', '09:00 AM', '8', 'no', '2017-10-09 06:13:46', '0000-00-00 00:00:00'),
(11, 4, 'Thursday', '08:00 AM', '09:00 AM', '8', 'no', '2017-10-09 06:13:46', '0000-00-00 00:00:00'),
(12, 4, 'Friday', '08:00 AM', '09:00 AM', '8', 'no', '2017-10-09 06:13:46', '0000-00-00 00:00:00'),
(13, 4, 'Saturday', '08:00 AM', '09:00 AM', '8', 'no', '2017-10-09 06:13:46', '0000-00-00 00:00:00'),
(14, 4, 'Sunday', '', '', '8', 'no', '2017-10-09 06:13:46', '0000-00-00 00:00:00'),
(15, 5, 'Monday', '02:00 PM', '03:00 AM', '1', 'no', '2017-10-14 12:44:52', '0000-00-00 00:00:00'),
(16, 5, 'Tuesday', '02:00 PM', '03:00 AM', '1', 'no', '2017-10-14 12:44:52', '0000-00-00 00:00:00'),
(17, 5, 'Wednesday', '02:00 PM', '03:00 AM', '1', 'no', '2017-10-14 12:44:52', '0000-00-00 00:00:00'),
(18, 5, 'Thursday', '02:00 PM', '03:00 AM', '1', 'no', '2017-10-14 12:44:52', '0000-00-00 00:00:00'),
(19, 5, 'Friday', '02:00 PM', '03:00 AM', '1', 'no', '2017-10-14 12:44:52', '0000-00-00 00:00:00'),
(20, 5, 'Saturday', '02:00 PM', '03:00 AM', '1', 'no', '2017-10-14 12:44:52', '0000-00-00 00:00:00'),
(21, 5, 'Sunday', '', '', '', 'no', '2017-10-14 12:44:52', '0000-00-00 00:00:00'),
(22, 6, 'Monday', '04:00 PM', '05:00 PM', '2', 'no', '2017-10-14 12:46:08', '0000-00-00 00:00:00'),
(23, 6, 'Tuesday', '04:00 PM', '05:00 PM', '2', 'no', '2017-10-14 12:46:08', '0000-00-00 00:00:00'),
(24, 6, 'Wednesday', '04:00 PM', '05:00 PM', '2', 'no', '2017-10-14 12:46:08', '0000-00-00 00:00:00'),
(25, 6, 'Thursday', '04:00 PM', '05:00 PM', '2', 'no', '2017-10-14 12:46:08', '0000-00-00 00:00:00'),
(26, 6, 'Friday', '04:00 PM', '05:00 PM', '2', 'no', '2017-10-14 12:46:08', '0000-00-00 00:00:00'),
(27, 6, 'Saturday', '04:00 PM', '05:00 PM', '2', 'no', '2017-10-14 12:46:08', '0000-00-00 00:00:00'),
(28, 6, 'Sunday', '', '', '', 'no', '2017-10-14 12:46:08', '0000-00-00 00:00:00'),
(29, 1, 'Monday', '09:00 AM', '', '', 'no', '2018-01-23 15:40:33', '0000-00-00 00:00:00'),
(30, 1, 'Tuesday', '09:00 AM', '', '', 'no', '2018-01-23 15:40:33', '0000-00-00 00:00:00'),
(31, 1, 'Wednesday', '09:00 AM', '', '', 'no', '2018-01-23 15:40:33', '0000-00-00 00:00:00'),
(32, 1, 'Thursday', '09:00 AM', '', '', 'no', '2018-01-23 15:40:33', '0000-00-00 00:00:00'),
(33, 1, 'Friday', '09:00 AM', '', '', 'no', '2018-01-23 15:40:33', '0000-00-00 00:00:00'),
(34, 1, 'Saturday', '09:00 AM', '', '', 'no', '2018-01-23 15:40:33', '0000-00-00 00:00:00'),
(35, 1, 'Sunday', '', '', '', 'no', '2018-01-23 15:40:33', '0000-00-00 00:00:00'),
(36, 2, 'Monday', '', '', '', 'no', '2018-08-27 13:34:02', '0000-00-00 00:00:00'),
(37, 2, 'Tuesday', '', '', '', 'no', '2018-08-27 13:34:02', '0000-00-00 00:00:00'),
(38, 2, 'Wednesday', '', '', '', 'no', '2018-08-27 13:34:02', '0000-00-00 00:00:00'),
(39, 2, 'Thursday', '', '', '', 'no', '2018-08-27 13:34:02', '0000-00-00 00:00:00'),
(40, 2, 'Friday', '', '', '', 'no', '2018-08-27 13:34:02', '0000-00-00 00:00:00'),
(41, 2, 'Saturday', '', '', '', 'no', '2018-08-27 13:34:02', '0000-00-00 00:00:00'),
(42, 2, 'Sunday', '', '', '', 'no', '2018-08-27 13:34:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `transaction_name` varchar(255) NOT NULL,
  `transaction_in` int(11) NOT NULL DEFAULT '0',
  `transaction_out` int(11) NOT NULL DEFAULT '0',
  `transaction_extra` text NOT NULL,
  `transaction_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `transaction_name`, `transaction_in`, `transaction_out`, `transaction_extra`, `transaction_date`) VALUES
(3, 'Student fee received', 500, 0, '{"amount":"500","date":"2017-10-06","amount_discount":"0","amount_fine":"0","description":"","payment_mode":"Cash"}', '2017-10-06 14:21:41'),
(4, 'Student fee revert', 0, 500, '', '2017-10-06 14:33:35'),
(5, 'Electricity bills (Test electricity bill)', 0, 100, '', '2017-10-06 14:47:53'),
(6, 'Removed (Test electricity bill) expense', 100, 0, '', '2017-10-06 15:00:45'),
(7, 'Student fee received', 500, 0, '{"amount":"500","date":"2017-10-08","amount_discount":"0","amount_fine":"0","description":"","payment_mode":"Cash"}', '2017-10-08 14:13:02'),
(8, 'Building expenses (Wood finishing done)', 0, 2000, '', '2017-10-08 20:10:57'),
(9, 'Removed (Wood finishing done) expense', 0, -2000, '', '2017-10-08 20:11:30'),
(10, 'Electricity bills (test)', 0, 100, '', '2017-12-30 21:55:25'),
(11, 'Electricity bills (test name)', 0, 100, '', '2017-12-30 21:57:35'),
(12, 'Electricity bills (test name)', 0, 100, '', '2017-12-30 22:02:46'),
(13, 'Electricity bills (asdf)', 0, 1000000, '', '2017-12-31 11:37:59'),
(14, 'Removed (Done paint job) expense', 0, -10000, '', '2017-12-31 11:53:40'),
(15, 'Removed (asdf) expense', 0, -1000000, '', '2017-12-31 12:02:20'),
(16, 'Removed (Building''s electricity bill) expense', 0, -2000, '', '2017-12-31 12:03:05'),
(17, 'Electricity bills (Testing electicity bill)', 0, 200, '', '2018-01-10 13:11:29'),
(18, 'Electricity bills (11th january electricity expense)', 0, 2000, '', '2018-01-11 14:24:25'),
(19, ' ()', 0, 0, '', '2018-01-16 13:11:21'),
(20, 'Electricity bills (name)', 0, 100, '', '2018-01-16 13:12:03'),
(21, 'Electricity bills (test)', 0, 10, '', '2018-02-13 11:38:34'),
(22, 'Electricity bills (1)', 0, 1, '', '2018-02-27 16:10:34'),
(23, 'Electricity bills (1)', 0, 1, '', '2018-02-27 16:10:34'),
(24, 'Removed (1) expense', 0, -1, '', '2018-02-27 16:11:21'),
(25, 'Removed (1) expense', 0, -1, '', '2018-02-27 16:11:29'),
(26, 'Electricity bills (test 1111)', 0, 1, '', '2018-02-27 16:11:56'),
(27, 'Electricity bills (test 1111)', 0, 1, '', '2018-02-27 16:11:57'),
(28, 'Removed (test 1111) expense', 0, -1, '', '2018-02-27 16:13:20'),
(29, 'Removed (test 1111) expense', 0, -1, '', '2018-02-27 16:13:22'),
(30, 'Electricity bills (test 111)', 0, 1, '', '2018-02-27 16:13:35'),
(31, 'Electricity bills (test 111)', 0, 1, '', '2018-02-27 16:13:36'),
(32, 'Removed (test 111) expense', 0, -1, '', '2018-02-27 16:13:50'),
(33, 'Removed (test 111) expense', 0, -1, '', '2018-02-27 16:13:52'),
(34, 'Electricity bills (test 123)', 0, 1, '', '2018-02-27 16:18:43'),
(35, 'Building expenses (test)', 0, 1, '', '2018-02-27 17:09:28'),
(36, 'Wapda (Bill)', 0, 10000, '', '2018-02-27 17:12:13'),
(37, 'Wapda (bill 2)', 0, 9000, '', '2018-02-27 17:12:57'),
(38, 'Removed (test name) expense', 0, -100, '', '2018-04-29 19:12:03'),
(39, 'Removed (Testing electicity bill) expense', 0, -200, '', '2018-04-29 19:17:20'),
(40, 'Electricity bills (test)', 0, 10000, '', '2018-08-13 18:43:11'),
(41, 'Electricity bills (ffffffff)', 0, 2000, '', '2018-08-16 16:26:14');

-- --------------------------------------------------------

--
-- Table structure for table `transport_route`
--

CREATE TABLE `transport_route` (
  `id` int(11) NOT NULL,
  `route_title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_of_vehicle` int(11) DEFAULT NULL,
  `fare` float(10,2) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transport_route`
--

INSERT INTO `transport_route` (`id`, `route_title`, `no_of_vehicle`, `fare`, `note`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Faisalabad to Jarranwala', NULL, 5000.00, NULL, 'no', '2017-10-02 05:17:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `childs` text COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `username`, `password`, `childs`, `role`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 0, 'std0', 'kwr9wv', '', 'student', 'yes', '2017-09-20 03:55:30', '0000-00-00 00:00:00'),
(2, 0, 'parent0', '7gk7kk', '0', 'parent', 'yes', '2017-09-20 03:55:30', '0000-00-00 00:00:00'),
(3, 1, 'teacher1', 'tk28j5', '', 'teacher', 'yes', '2017-09-20 08:09:53', '0000-00-00 00:00:00'),
(4, 1, 'std1', '6hkbsx', '', 'student', 'yes', '2017-10-02 04:54:02', '0000-00-00 00:00:00'),
(5, 1, 'parent1', '5eqg6y', '1', 'parent', 'yes', '2017-10-02 04:54:02', '0000-00-00 00:00:00'),
(6, 2, 'std2', '6j5vww', '', 'student', 'yes', '2017-10-02 05:06:26', '0000-00-00 00:00:00'),
(7, 2, 'parent2', 'heq0bv', '2', 'parent', 'yes', '2017-10-02 05:06:26', '0000-00-00 00:00:00'),
(8, 2, 'teacher2', 'rdtvh7', '', 'teacher', 'yes', '2017-10-03 06:00:38', '0000-00-00 00:00:00'),
(9, 3, 'teacher3', 'brnkuh', '', 'teacher', 'yes', '2017-10-03 06:00:57', '0000-00-00 00:00:00'),
(10, 4, 'teacher4', 's4qw7z', '', 'teacher', 'yes', '2017-10-12 05:38:28', '0000-00-00 00:00:00'),
(11, 5, 'teacher5', '2381rx', '', 'teacher', 'yes', '2017-10-13 06:54:11', '0000-00-00 00:00:00'),
(12, 3, 'std3', 'g0j8g0', '', 'student', 'yes', '2017-10-19 04:52:55', '0000-00-00 00:00:00'),
(13, 3, 'parent3', 'i9ojpb', '3', 'parent', 'yes', '2017-10-19 04:52:55', '0000-00-00 00:00:00'),
(14, 6, 'teacher6', '4lhxtg', '', 'teacher', 'yes', '2017-10-30 05:55:49', '0000-00-00 00:00:00'),
(15, 7, 'testingoutteacher', 'bmxp9m', '', 'teacher', 'yes', '2017-10-30 06:15:08', '0000-00-00 00:00:00'),
(16, 1, 'librarian1', 'oafq0a', '', 'librarian', 'yes', '2017-11-01 09:07:11', '0000-00-00 00:00:00'),
(18, 4, 'parent4', 'tb0a4l', '4', 'parent', 'yes', '2017-11-22 06:29:28', '0000-00-00 00:00:00'),
(19, 5, 'std5', '6dkbcd', '', 'student', 'yes', '2017-11-22 06:32:23', '0000-00-00 00:00:00'),
(20, 5, 'parent5', 'qw7ig2', '5', 'parent', 'yes', '2017-11-22 06:32:23', '0000-00-00 00:00:00'),
(21, 8, 'testingduplicate', 'iuhspq', '', 'teacher', 'yes', '2017-12-23 07:36:53', '0000-00-00 00:00:00'),
(22, 6, 'std6', '27fq07', '', 'student', 'yes', '2018-01-25 05:30:56', '0000-00-00 00:00:00'),
(23, 6, 'parent6', 'u0dzbw', '6', 'parent', 'yes', '2018-01-25 05:30:56', '0000-00-00 00:00:00'),
(24, 7, 'std7', 'zucn8u', '', 'student', 'yes', '2018-01-25 05:32:03', '0000-00-00 00:00:00'),
(25, 7, 'parent7', 'ailrdt', '7', 'parent', 'yes', '2018-01-25 05:32:03', '0000-00-00 00:00:00'),
(26, 8, 'std8', '0neg23', '', 'student', 'yes', '2018-01-25 05:38:02', '0000-00-00 00:00:00'),
(27, 8, 'parent8', '52af50', '8', 'parent', 'yes', '2018-01-25 05:38:02', '0000-00-00 00:00:00'),
(28, 9, 'std9', 'e5rjeu', '', 'student', 'yes', '2018-01-25 05:41:28', '0000-00-00 00:00:00'),
(29, 9, 'parent9', '7852xe', '9', 'parent', 'yes', '2018-01-25 05:41:28', '0000-00-00 00:00:00'),
(30, 10, 'std10', 'x492yz', '', 'student', 'yes', '2018-01-25 19:08:29', '0000-00-00 00:00:00'),
(31, 10, 'parent10', '0jpqrn', '10', 'parent', 'yes', '2018-01-25 19:08:29', '0000-00-00 00:00:00'),
(32, 11, 'std11', 't56sf9', '', 'student', 'yes', '2018-01-31 06:38:53', '0000-00-00 00:00:00'),
(33, 11, 'parent11', 'xfv0yi', '11', 'parent', 'yes', '2018-01-31 06:38:53', '0000-00-00 00:00:00'),
(34, 12, 'std12', '23tqwd', '', 'student', 'yes', '2018-01-31 06:50:03', '0000-00-00 00:00:00'),
(35, 12, 'parent12', 'u6jp1h', '12', 'parent', 'yes', '2018-01-31 06:50:03', '0000-00-00 00:00:00'),
(36, 13, 'std13', 'sibmsz', '', 'student', 'yes', '2018-01-31 07:28:48', '0000-00-00 00:00:00'),
(37, 13, 'parent13', 'csfgmy', '13', 'parent', 'yes', '2018-01-31 07:28:48', '0000-00-00 00:00:00'),
(38, 14, 'std14', 'sfv6at', '', 'student', 'yes', '2018-02-01 06:26:27', '0000-00-00 00:00:00'),
(39, 14, 'parent14', 'h3tu63', '14', 'parent', 'yes', '2018-02-01 06:26:27', '0000-00-00 00:00:00'),
(40, 15, 'std15', 'bcdtg2', '', 'student', 'yes', '2018-02-27 07:40:13', '0000-00-00 00:00:00'),
(41, 15, 'parent15', '8gontg', '15', 'parent', 'yes', '2018-02-27 07:40:13', '0000-00-00 00:00:00'),
(42, 16, 'std16', '816n41', '', 'student', 'yes', '2018-02-27 07:43:08', '0000-00-00 00:00:00'),
(43, 16, 'parent16', 'yt10d8', '16', 'parent', 'yes', '2018-02-27 07:43:08', '0000-00-00 00:00:00'),
(44, 17, 'std17', 'g2neu0', '', 'student', 'yes', '2018-02-27 10:10:53', '0000-00-00 00:00:00'),
(45, 17, 'parent17', 'z9onzg', '17', 'parent', 'yes', '2018-02-27 10:10:53', '0000-00-00 00:00:00'),
(46, 18, 'std18', 'rxevh7', '', 'student', 'yes', '2018-02-27 10:24:31', '0000-00-00 00:00:00'),
(47, 18, 'parent18', '9cn856', '18', 'parent', 'yes', '2018-02-27 10:24:31', '0000-00-00 00:00:00'),
(48, 19, 'std19', 'zbw7k9', '', 'student', 'yes', '2018-02-27 10:25:08', '0000-00-00 00:00:00'),
(49, 19, 'parent19', 'jk1one', '19', 'parent', 'yes', '2018-02-27 10:25:08', '0000-00-00 00:00:00'),
(50, 9, 'testname', '7i1hx8', '', 'teacher', 'yes', '2018-03-06 05:53:14', '0000-00-00 00:00:00'),
(51, 20, 'std20', '12jzu2', '', 'student', 'yes', '2018-03-07 06:42:18', '0000-00-00 00:00:00'),
(52, 20, 'parent20', '4bwdkl', '20', 'parent', 'yes', '2018-03-07 06:42:18', '0000-00-00 00:00:00'),
(53, 21, 'std21', 'q0jklr', '', 'student', 'yes', '2018-03-16 06:14:22', '0000-00-00 00:00:00'),
(54, 21, 'parent21', 'kumn4b', '21', 'parent', 'yes', '2018-03-16 06:14:22', '0000-00-00 00:00:00'),
(55, 22, 'std22', 'iuhdtg', '', 'student', 'yes', '2018-03-30 11:19:41', '0000-00-00 00:00:00'),
(56, 22, 'parent22', 's4q07f', '22', 'parent', 'yes', '2018-03-30 11:19:41', '0000-00-00 00:00:00'),
(57, 23, 'std23', 'pqrnfu', '', 'student', 'yes', '2018-03-30 11:27:36', '0000-00-00 00:00:00'),
(58, 23, 'parent23', '3892nt', '23', 'parent', 'yes', '2018-03-30 11:27:36', '0000-00-00 00:00:00'),
(59, 10, 'forcheckingjoiningdate', '89hak1', '', 'teacher', 'yes', '2018-03-30 11:37:52', '0000-00-00 00:00:00'),
(60, 24, 'std24', 'qcakbo', '', 'student', 'yes', '2018-04-01 07:01:13', '0000-00-00 00:00:00'),
(61, 24, 'parent24', 'zuc745', '24', 'parent', 'yes', '2018-04-01 07:01:13', '0000-00-00 00:00:00'),
(62, 11, 'teacherfortestingdate', '74bm3i', '', 'teacher', 'yes', '2018-04-03 11:21:51', '0000-00-00 00:00:00'),
(63, 25, 'std25', 'iumdel', '', 'student', 'yes', '2018-04-09 10:31:50', '0000-00-00 00:00:00'),
(64, 25, 'parent25', 'yel0jp', '25', 'parent', 'yes', '2018-04-09 10:31:50', '0000-00-00 00:00:00'),
(65, 26, 'std26', '03fqrd', '', 'student', 'yes', '2018-04-09 10:33:03', '0000-00-00 00:00:00'),
(66, 26, 'parent26', '9ojpv2', '26', 'parent', 'yes', '2018-04-09 10:33:03', '0000-00-00 00:00:00'),
(67, 27, 'std27', 'g2afv2', '', 'student', 'yes', '2018-04-09 10:33:55', '0000-00-00 00:00:00'),
(68, 27, 'parent27', 'ebh7p5', '27', 'parent', 'yes', '2018-04-09 10:33:55', '0000-00-00 00:00:00'),
(69, 28, 'std28', 'evhjk1', '', 'student', 'yes', '2018-04-10 05:42:57', '0000-00-00 00:00:00'),
(70, 28, 'parent28', '3896sf', '28', 'parent', 'yes', '2018-04-10 05:42:57', '0000-00-00 00:00:00'),
(71, 0, 'std0', 'dpqmxi', '', 'student', 'yes', '2018-05-16 07:17:17', '0000-00-00 00:00:00'),
(72, 0, 'parent0', 'onil2s', '0', 'parent', 'yes', '2018-05-16 07:17:17', '0000-00-00 00:00:00'),
(73, 29, 'std29', '50x81m', '', 'student', 'yes', '2018-05-16 07:20:02', '0000-00-00 00:00:00'),
(74, 29, 'parent29', 'ebontu', '29', 'parent', 'yes', '2018-05-16 07:20:02', '0000-00-00 00:00:00'),
(75, 30, 'std30', 'vcstum', '', 'student', 'yes', '2018-05-16 07:20:48', '0000-00-00 00:00:00'),
(76, 30, 'parent30', 'p9o7iv', '30', 'parent', 'yes', '2018-05-16 07:20:48', '0000-00-00 00:00:00'),
(77, 0, 'std0', '8vw3p1', '', 'student', 'yes', '2018-05-16 07:50:09', '0000-00-00 00:00:00'),
(78, 0, 'parent0', 's4br3p', '0', 'parent', 'yes', '2018-05-16 07:50:09', '0000-00-00 00:00:00'),
(79, 31, 'std31', 'hdpl6y', '', 'student', 'yes', '2018-05-16 07:51:13', '0000-00-00 00:00:00'),
(80, 31, 'parent31', 'bcj8vc', '31', 'parent', 'yes', '2018-05-16 07:51:13', '0000-00-00 00:00:00'),
(81, 32, 'std32', 'klox8l', '', 'student', 'yes', '2018-05-16 07:53:11', '0000-00-00 00:00:00'),
(82, 32, 'parent32', 'nkg0y8', '32', 'parent', 'yes', '2018-05-16 07:53:11', '0000-00-00 00:00:00'),
(83, 33, 'std33', '3tbmaz', '', 'student', 'yes', '2018-05-17 06:49:14', '0000-00-00 00:00:00'),
(84, 33, 'parent33', '6aeq23', '33', 'parent', 'yes', '2018-05-17 06:49:14', '0000-00-00 00:00:00'),
(85, 34, 'std34', 't50ael', '', 'student', 'yes', '2018-05-26 23:36:34', '0000-00-00 00:00:00'),
(86, 34, 'parent34', '3tvose', '34', 'parent', 'yes', '2018-05-26 23:36:34', '0000-00-00 00:00:00'),
(87, 35, 'std35', 'rdtloj', '', 'student', 'yes', '2018-05-26 23:36:34', '0000-00-00 00:00:00'),
(88, 35, 'parent35', '1ha452', '35', 'parent', 'yes', '2018-05-26 23:36:34', '0000-00-00 00:00:00'),
(89, 36, 'std36', 'z9m38l', '', 'student', 'yes', '2018-05-26 23:36:34', '0000-00-00 00:00:00'),
(90, 36, 'parent36', 'spvoat', '36', 'parent', 'yes', '2018-05-26 23:36:34', '0000-00-00 00:00:00'),
(91, 37, 'std37', 'my49cj', '', 'student', 'yes', '2018-05-26 23:36:34', '0000-00-00 00:00:00'),
(92, 37, 'parent37', '5hxkv0', '37', 'parent', 'yes', '2018-05-26 23:36:34', '0000-00-00 00:00:00'),
(93, 38, 'std38', '8vh7tu', '', 'student', 'yes', '2018-05-26 23:36:34', '0000-00-00 00:00:00'),
(94, 38, 'parent38', 'npgwni', '38', 'parent', 'yes', '2018-05-26 23:36:34', '0000-00-00 00:00:00'),
(95, 39, 'std39', '0st1cs', '', 'student', 'yes', '2018-05-26 23:36:34', '0000-00-00 00:00:00'),
(96, 39, 'parent39', 'qoszl0', '39', 'parent', 'yes', '2018-05-26 23:36:34', '0000-00-00 00:00:00'),
(97, 40, 'std40', 'ilo7eg', '', 'student', 'yes', '2018-05-26 23:36:35', '0000-00-00 00:00:00'),
(98, 40, 'parent40', 'y8gcnp', '40', 'parent', 'yes', '2018-05-26 23:36:35', '0000-00-00 00:00:00'),
(99, 41, 'std41', 'rn4lod', '', 'student', 'yes', '2018-05-26 23:36:35', '0000-00-00 00:00:00'),
(100, 41, 'parent41', 'g0splc', '41', 'parent', 'yes', '2018-05-26 23:36:35', '0000-00-00 00:00:00'),
(101, 42, 'std42', 'tuoxi1', '', 'student', 'yes', '2018-05-26 23:36:35', '0000-00-00 00:00:00'),
(102, 42, 'parent42', 'jtqoxp', '42', 'parent', 'yes', '2018-05-26 23:36:35', '0000-00-00 00:00:00'),
(103, 43, 'std43', 'rspuw3', '', 'student', 'yes', '2018-05-26 23:36:35', '0000-00-00 00:00:00'),
(104, 43, 'parent43', 'bmdz9c', '43', 'parent', 'yes', '2018-05-26 23:36:35', '0000-00-00 00:00:00'),
(105, 44, 'std44', 'eu6jkq', '', 'student', 'yes', '2018-05-26 23:38:26', '0000-00-00 00:00:00'),
(106, 44, 'parent44', 'xzqmnf', '44', 'parent', 'yes', '2018-05-26 23:38:26', '0000-00-00 00:00:00'),
(107, 45, 'std45', 'od41oj', '', 'student', 'yes', '2018-05-26 23:38:26', '0000-00-00 00:00:00'),
(108, 45, 'parent45', '1oyflh', '45', 'parent', 'yes', '2018-05-26 23:38:26', '0000-00-00 00:00:00'),
(109, 46, 'std46', 'kuosp9', '', 'student', 'yes', '2018-05-26 23:38:26', '0000-00-00 00:00:00'),
(110, 46, 'parent46', '7flrnz', '46', 'parent', 'yes', '2018-05-26 23:38:26', '0000-00-00 00:00:00'),
(111, 47, 'std47', 'rx4bo3', '', 'student', 'yes', '2018-05-26 23:38:26', '0000-00-00 00:00:00'),
(112, 47, 'parent47', 'gcnfgc', '47', 'parent', 'yes', '2018-05-26 23:38:26', '0000-00-00 00:00:00'),
(113, 48, 'std48', 'kbwxe1', '', 'student', 'yes', '2018-05-26 23:38:26', '0000-00-00 00:00:00'),
(114, 48, 'parent48', 'xi9r3t', '48', 'parent', 'yes', '2018-05-26 23:38:27', '0000-00-00 00:00:00'),
(115, 49, 'std49', 'wj8uod', '', 'student', 'yes', '2018-05-26 23:38:27', '0000-00-00 00:00:00'),
(116, 49, 'parent49', 'qhxkb2', '49', 'parent', 'yes', '2018-05-26 23:38:27', '0000-00-00 00:00:00'),
(117, 50, 'std50', 'p9hy8g', '', 'student', 'yes', '2018-05-26 23:38:27', '0000-00-00 00:00:00'),
(118, 50, 'parent50', '381rye', '50', 'parent', 'yes', '2018-05-26 23:38:27', '0000-00-00 00:00:00'),
(119, 51, 'std51', 'o3i1cs', '', 'student', 'yes', '2018-05-26 23:38:27', '0000-00-00 00:00:00'),
(120, 51, 'parent51', '5wytb2', '51', 'parent', 'yes', '2018-05-26 23:38:27', '0000-00-00 00:00:00'),
(121, 52, 'std52', 'kbrni1', '', 'student', 'yes', '2018-05-26 23:38:27', '0000-00-00 00:00:00'),
(122, 52, 'parent52', '7p1cde', '52', 'parent', 'yes', '2018-05-26 23:38:27', '0000-00-00 00:00:00'),
(123, 53, 'std53', 'c7iboy', '', 'student', 'yes', '2018-05-26 23:38:27', '0000-00-00 00:00:00'),
(124, 53, 'parent53', 'b27e1w', '53', 'parent', 'yes', '2018-05-26 23:38:27', '0000-00-00 00:00:00'),
(125, 54, 'std54', 'ypu6sk', '', 'student', 'yes', '2018-05-26 23:41:26', '0000-00-00 00:00:00'),
(126, 54, 'parent54', 'wyzvh3', '54', 'parent', 'yes', '2018-05-26 23:41:26', '0000-00-00 00:00:00'),
(127, 55, 'std55', '56azbc', '', 'student', 'yes', '2018-05-26 23:41:26', '0000-00-00 00:00:00'),
(128, 55, 'parent55', 't52n8b', '55', 'parent', 'yes', '2018-05-26 23:41:26', '0000-00-00 00:00:00'),
(129, 56, 'std56', 'ypv27f', '', 'student', 'yes', '2018-05-26 23:41:26', '0000-00-00 00:00:00'),
(130, 56, 'parent56', '2sfv23', '56', 'parent', 'yes', '2018-05-26 23:41:26', '0000-00-00 00:00:00'),
(131, 57, 'std57', 'bos410', '', 'student', 'yes', '2018-05-26 23:41:26', '0000-00-00 00:00:00'),
(132, 57, 'parent57', 't5o3t9', '57', 'parent', 'yes', '2018-05-26 23:41:26', '0000-00-00 00:00:00'),
(133, 58, 'std58', '7pbcxe', '', 'student', 'yes', '2018-05-26 23:41:26', '0000-00-00 00:00:00'),
(134, 58, 'parent58', 'oap5w7', '58', 'parent', 'yes', '2018-05-26 23:41:26', '0000-00-00 00:00:00'),
(135, 59, 'std59', 'vo3t5h', '', 'student', 'yes', '2018-05-26 23:41:26', '0000-00-00 00:00:00'),
(136, 59, 'parent59', 'p1hnz5', '59', 'parent', 'yes', '2018-05-26 23:41:26', '0000-00-00 00:00:00'),
(137, 60, 'std60', 'x4lmnf', '', 'student', 'yes', '2018-05-26 23:41:27', '0000-00-00 00:00:00'),
(138, 60, 'parent60', 'ms45wn', '60', 'parent', 'yes', '2018-05-26 23:41:27', '0000-00-00 00:00:00'),
(139, 61, 'std61', 'q0j81w', '', 'student', 'yes', '2018-05-26 23:41:27', '0000-00-00 00:00:00'),
(140, 61, 'parent61', 'p5rytg', '61', 'parent', 'yes', '2018-05-26 23:41:27', '0000-00-00 00:00:00'),
(141, 62, 'std62', 'nfb27f', '', 'student', 'yes', '2018-05-26 23:41:27', '0000-00-00 00:00:00'),
(142, 62, 'parent62', '0jfb6s', '62', 'parent', 'yes', '2018-05-26 23:41:27', '0000-00-00 00:00:00'),
(143, 63, 'std63', '5mdkgr', '', 'student', 'yes', '2018-05-26 23:41:27', '0000-00-00 00:00:00'),
(144, 63, 'parent63', 'p9ms49', '63', 'parent', 'yes', '2018-05-26 23:41:27', '0000-00-00 00:00:00'),
(145, 64, 'std64', '6j4lm3', '', 'student', 'yes', '2018-05-31 19:30:05', '0000-00-00 00:00:00'),
(146, 64, 'parent64', 'bwakg6', '64', 'parent', 'yes', '2018-05-31 19:30:05', '0000-00-00 00:00:00'),
(147, 65, 'std65', 'zg0siu', '', 'student', 'yes', '2018-06-01 22:41:51', '0000-00-00 00:00:00'),
(148, 65, 'parent65', 'szghji', '65', 'parent', 'yes', '2018-06-01 22:41:51', '0000-00-00 00:00:00'),
(149, 66, 'std66', '23zuoy', '', 'student', 'yes', '2018-06-01 22:41:51', '0000-00-00 00:00:00'),
(150, 66, 'parent66', 'lr38q0', '66', 'parent', 'yes', '2018-06-01 22:41:51', '0000-00-00 00:00:00'),
(151, 67, 'std67', '4vmseu', '', 'student', 'yes', '2018-06-01 22:41:51', '0000-00-00 00:00:00'),
(152, 67, 'parent67', 'jtuh3z', '67', 'parent', 'yes', '2018-06-01 22:41:51', '0000-00-00 00:00:00'),
(153, 68, 'std68', 'wx8lm7', '', 'student', 'yes', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(154, 68, 'parent68', 'grdpuc', '68', 'parent', 'yes', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(155, 69, 'std69', 'eurnz1', '', 'student', 'yes', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(156, 69, 'parent69', 'dt96af', '69', 'parent', 'yes', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(157, 70, 'std70', 'cy8lcj', '', 'student', 'yes', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(158, 70, 'parent70', 'bhy45c', '70', 'parent', 'yes', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(159, 71, 'std71', 'fuoxi9', '', 'student', 'yes', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(160, 71, 'parent71', '7e9cat', '71', 'parent', 'yes', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(161, 72, 'std72', 'rdiuha', '', 'student', 'yes', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(162, 72, 'parent72', '9cytum', '72', 'parent', 'yes', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(163, 73, 'std73', 'z1onfl', '', 'student', 'yes', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(164, 73, 'parent73', '7zbodt', '73', 'parent', 'yes', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(165, 74, 'std74', 'rytqws', '', 'student', 'yes', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(166, 74, 'parent74', '5w34vc', '74', 'parent', 'yes', '2018-06-01 22:41:52', '0000-00-00 00:00:00'),
(167, 77, 'std77', 'fg2se1', '', 'student', 'yes', '2018-06-01 22:49:00', '0000-00-00 00:00:00'),
(168, 77, 'parent77', 'jp52xp', '77', 'parent', 'yes', '2018-06-01 22:49:00', '0000-00-00 00:00:00'),
(169, 78, 'std78', 'hytbos', '', 'student', 'yes', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(170, 78, 'parent78', 'b0at9c', '78', 'parent', 'yes', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(171, 79, 'std79', 'zvwxiv', '', 'student', 'yes', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(172, 79, 'parent79', 'stu2si', '79', 'parent', 'yes', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(173, 80, 'std80', 'rjpb0y', '', 'student', 'yes', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(174, 80, 'parent80', 'b6jpbr', '80', 'parent', 'yes', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(175, 81, 'std81', 'il0se9', '', 'student', 'yes', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(176, 81, 'parent81', 'dpgh7i', '81', 'parent', 'yes', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(177, 82, 'std82', 'h74qrs', '', 'student', 'yes', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(178, 82, 'parent82', '9wn4q6', '82', 'parent', 'yes', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(179, 83, 'std83', 'kqh7i9', '', 'student', 'yes', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(180, 83, 'parent83', 'jkl0y4', '83', 'parent', 'yes', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(181, 84, 'std84', 'rjiqh3', '', 'student', 'yes', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(182, 84, 'parent84', '127kur', '84', 'parent', 'yes', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(183, 85, 'std85', 'p9onp1', '', 'student', 'yes', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(184, 85, 'parent85', 'ji5md8', '85', 'parent', 'yes', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(185, 86, 'std86', 'ojtb0y', '', 'student', 'yes', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(186, 86, 'parent86', 'vrseuc', '86', 'parent', 'yes', '2018-06-01 22:49:01', '0000-00-00 00:00:00'),
(187, 87, 'std87', 't9238u', '', 'student', 'yes', '2018-06-01 22:53:15', '0000-00-00 00:00:00'),
(188, 87, 'parent87', 'xe1h3e', '87', 'parent', 'yes', '2018-06-01 22:53:15', '0000-00-00 00:00:00'),
(189, 88, 'std88', '0j4u6j', '', 'student', 'yes', '2018-06-01 22:53:15', '0000-00-00 00:00:00'),
(190, 88, 'parent88', 'qcxtlo', '88', 'parent', 'yes', '2018-06-01 22:53:15', '0000-00-00 00:00:00'),
(191, 89, 'std89', 'tlhstv', '', 'student', 'yes', '2018-06-01 22:53:15', '0000-00-00 00:00:00'),
(192, 89, 'parent89', '3iurnz', '89', 'parent', 'yes', '2018-06-01 22:53:15', '0000-00-00 00:00:00'),
(193, 90, 'std90', '6s4b23', '', 'student', 'yes', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(194, 90, 'parent90', 'lr7ebc', '90', 'parent', 'yes', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(195, 91, 'std91', 'iuwxfg', '', 'student', 'yes', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(196, 91, 'parent91', '34l67k', '91', 'parent', 'yes', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(197, 92, 'std92', '2jk5wx', '', 'student', 'yes', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(198, 92, 'parent92', '12sp5m', '92', 'parent', 'yes', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(199, 93, 'std93', 'k9cni5', '', 'student', 'yes', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(200, 93, 'parent93', 'jkqryp', '93', 'parent', 'yes', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(201, 94, 'std94', '0seu0s', '', 'student', 'yes', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(202, 94, 'parent94', 'gw74vc', '94', 'parent', 'yes', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(203, 95, 'std95', 'evraig', '', 'student', 'yes', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(204, 95, 'parent95', 'dk96jz', '95', 'parent', 'yes', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(205, 96, 'std96', '0si9oj', '', 'student', 'yes', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(206, 96, 'parent96', '5m7456', '96', 'parent', 'yes', '2018-06-01 22:53:16', '0000-00-00 00:00:00'),
(207, 97, 'std97', 'e5wxeq', '', 'student', 'yes', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(208, 97, 'parent97', 'jiqhj4', '97', 'parent', 'yes', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(209, 98, 'std98', 'hne1ws', '', 'student', 'yes', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(210, 98, 'parent98', 'qwd41h', '98', 'parent', 'yes', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(211, 99, 'std99', 't9rjzb', '', 'student', 'yes', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(212, 99, 'parent99', 'de1mai', '99', 'parent', 'yes', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(213, 100, 'std100', 'csz107', '', 'student', 'yes', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(214, 100, 'parent100', '1rxtlm', '100', 'parent', 'yes', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(215, 101, 'std101', 'i9csk9', '', 'student', 'yes', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(216, 101, 'parent101', 'jtvw7p', '101', 'parent', 'yes', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(217, 102, 'std102', 'c3tbhy', '', 'student', 'yes', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(218, 102, 'parent102', 'v6x456', '102', 'parent', 'yes', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(219, 103, 'std103', 'ilmazq', '', 'student', 'yes', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(220, 103, 'parent103', 'xkqhxz', '103', 'parent', 'yes', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(221, 104, 'std104', '07i9my', '', 'student', 'yes', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(222, 104, 'parent104', 'lwa8v0', '104', 'parent', 'yes', '2018-06-01 22:53:17', '0000-00-00 00:00:00'),
(223, 105, 'std105', 'eqcx89', '', 'student', 'yes', '2018-06-01 22:53:18', '0000-00-00 00:00:00'),
(224, 105, 'parent105', '7ploy4', '105', 'parent', 'yes', '2018-06-01 22:53:18', '0000-00-00 00:00:00'),
(225, 106, 'std106', 'wjeqra', '', 'student', 'yes', '2018-06-01 22:53:18', '0000-00-00 00:00:00'),
(226, 106, 'parent106', '96jk1m', '106', 'parent', 'yes', '2018-06-01 22:53:18', '0000-00-00 00:00:00'),
(227, 107, 'std107', 'f9h3zu', '', 'student', 'yes', '2018-06-01 22:53:18', '0000-00-00 00:00:00'),
(228, 107, 'parent107', 'j8lo7z', '107', 'parent', 'yes', '2018-06-01 22:53:18', '0000-00-00 00:00:00'),
(229, 108, 'std108', '6xfbcy', '', 'student', 'yes', '2018-06-01 22:53:18', '0000-00-00 00:00:00'),
(230, 108, 'parent108', '9hxigh', '108', 'parent', 'yes', '2018-06-01 22:53:18', '0000-00-00 00:00:00'),
(231, 109, 'std109', 'plcjev', '', 'student', 'yes', '2018-06-01 22:53:18', '0000-00-00 00:00:00'),
(232, 109, 'parent109', 'ykb0si', '109', 'parent', 'yes', '2018-06-01 22:53:18', '0000-00-00 00:00:00'),
(233, 110, 'std110', '2a8163', '', 'student', 'yes', '2018-06-01 22:53:18', '0000-00-00 00:00:00'),
(234, 110, 'parent110', 'g0dtqr', '110', 'parent', 'yes', '2018-06-01 22:53:18', '0000-00-00 00:00:00'),
(235, 111, 'std111', 'fq6xi1', '', 'student', 'yes', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(236, 111, 'parent111', '34q27t', '111', 'parent', 'yes', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(237, 112, 'std112', '6n8uwx', '', 'student', 'yes', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(238, 112, 'parent112', 'vmd450', '112', 'parent', 'yes', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(239, 113, 'std113', 't96jiu', '', 'student', 'yes', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(240, 113, 'parent113', 'sf5mnk', '113', 'parent', 'yes', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(241, 114, 'std114', 'csfb2a', '', 'student', 'yes', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(242, 114, 'parent114', 'gcjtlh', '114', 'parent', 'yes', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(243, 115, 'std115', 'zlwjk1', '', 'student', 'yes', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(244, 115, 'parent115', 'np903t', '115', 'parent', 'yes', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(245, 116, 'std116', 'rnkvo3', '', 'student', 'yes', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(246, 116, 'parent116', '56xt50', '116', 'parent', 'yes', '2018-06-01 22:55:39', '0000-00-00 00:00:00'),
(247, 117, 'std117', 'egwatg', '', 'student', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(248, 117, 'parent117', '7kuo7e', '117', 'parent', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(249, 118, 'std118', '0jivws', '', 'student', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(250, 118, 'parent118', '90yfvc', '118', 'parent', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(251, 119, 'std119', 'eqcn8g', '', 'student', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(252, 119, 'parent119', '7zgwat', '119', 'parent', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(253, 120, 'std120', 'mn4qcd', '', 'student', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(254, 120, 'parent120', 'qca45h', '120', 'parent', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(255, 121, 'std121', 't12aiq', '', 'student', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(256, 121, 'parent121', 'x45r7f', '121', 'parent', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(257, 122, 'std122', 'caegcj', '', 'student', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(258, 122, 'parent122', 'b6diq0', '122', 'parent', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(259, 123, 'std123', 'fv6ji9', '', 'student', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(260, 123, 'parent123', 'nf5on8', '123', 'parent', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(261, 124, 'std124', 'rdeu2s', '', 'student', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(262, 124, 'parent124', 'bcje9r', '124', 'parent', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(263, 125, 'std125', 'kv0ni9', '', 'student', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(264, 125, 'parent125', 'niq2dt', '125', 'parent', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(265, 126, 'std126', '0jpgrx', '', 'student', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(266, 126, 'parent126', '52d4lm', '126', 'parent', 'yes', '2018-06-01 22:55:40', '0000-00-00 00:00:00'),
(267, 127, 'std127', 'zumaeg', '', 'student', 'yes', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(268, 127, 'parent127', 'xfb67i', '127', 'parent', 'yes', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(269, 128, 'std128', '0ykuoj', '', 'student', 'yes', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(270, 128, 'parent128', 'l0nf90', '128', 'parent', 'yes', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(271, 129, 'std129', 'i96jkq', '', 'student', 'yes', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(272, 129, 'parent129', '3zu6at', '129', 'parent', 'yes', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(273, 130, 'std130', 'ontvwj', '', 'student', 'yes', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(274, 130, 'parent130', 'bm7e5w', '130', 'parent', 'yes', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(275, 131, 'std131', 'zbmjzv', '', 'student', 'yes', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(276, 131, 'parent131', 'ypuhx4', '131', 'parent', 'yes', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(277, 132, 'std132', 'rxi5ry', '', 'student', 'yes', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(278, 132, 'parent132', '9r7kl0', '132', 'parent', 'yes', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(279, 133, 'std133', 'fvr3k1', '', 'student', 'yes', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(280, 133, 'parent133', '3fvmd4', '133', 'parent', 'yes', '2018-06-01 22:55:41', '0000-00-00 00:00:00'),
(281, 134, 'std134', '67ilwx', '', 'student', 'yes', '2018-06-01 22:55:42', '0000-00-00 00:00:00'),
(282, 134, 'parent134', 'umjilm', '134', 'parent', 'yes', '2018-06-01 22:55:42', '0000-00-00 00:00:00'),
(283, 135, 'std135', '8goakb', '', 'student', 'yes', '2018-06-02 20:58:34', '0000-00-00 00:00:00'),
(284, 135, 'parent135', 'ai1cx8', '135', 'parent', 'yes', '2018-06-02 20:58:34', '0000-00-00 00:00:00'),
(285, 136, 'std136', 'v2negm', '', 'student', 'yes', '2018-06-02 21:03:00', '0000-00-00 00:00:00'),
(286, 136, 'parent136', '8lo7fq', '136', 'parent', 'yes', '2018-06-02 21:03:00', '0000-00-00 00:00:00'),
(287, 137, 'std137', 'g2j4vr', '', 'student', 'yes', '2018-06-02 21:53:32', '0000-00-00 00:00:00'),
(288, 137, 'parent137', '8vmaib', '137', 'parent', 'yes', '2018-06-02 21:53:32', '0000-00-00 00:00:00'),
(289, 138, 'std138', 'cazvca', '', 'student', 'yes', '2018-06-02 21:59:04', '0000-00-00 00:00:00'),
(290, 138, 'parent138', 'qwxiqw', '138', 'parent', 'yes', '2018-06-02 21:59:04', '0000-00-00 00:00:00'),
(291, 139, 'std139', 'kumspq', '', 'student', 'yes', '2018-06-02 21:59:04', '0000-00-00 00:00:00'),
(292, 139, 'parent139', 'apu0xk', '139', 'parent', 'yes', '2018-06-02 21:59:04', '0000-00-00 00:00:00'),
(293, 140, 'std140', '6j81rx', '', 'student', 'yes', '2018-06-02 21:59:04', '0000-00-00 00:00:00'),
(294, 140, 'parent140', 'vh749c', '140', 'parent', 'yes', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(295, 141, 'std141', '856yi9', '', 'student', 'yes', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(296, 141, 'parent141', '38b0n4', '141', 'parent', 'yes', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(297, 142, 'std142', 'r3fuo3', '', 'student', 'yes', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(298, 142, 'parent142', 'gh7k96', '142', 'parent', 'yes', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(299, 143, 'std143', 'f12yiq', '', 'student', 'yes', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(300, 143, 'parent143', 'yk92st', '143', 'parent', 'yes', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(301, 144, 'std144', 'rnklhn', '', 'student', 'yes', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(302, 144, 'parent144', 'b2ji9o', '144', 'parent', 'yes', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(303, 145, 'std145', 'ivmniv', '', 'student', 'yes', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(304, 145, 'parent145', 'jkgcnt', '145', 'parent', 'yes', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(305, 146, 'std146', '2npghj', '', 'student', 'yes', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(306, 146, 'parent146', '9haz5w', '146', 'parent', 'yes', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(307, 147, 'std147', 'p1hxil', '', 'student', 'yes', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(308, 147, 'parent147', 'ye50x4', '147', 'parent', 'yes', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(309, 148, 'std148', 'o7e10x', '', 'student', 'yes', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(310, 148, 'parent148', '1r3k52', '148', 'parent', 'yes', '2018-06-02 21:59:05', '0000-00-00 00:00:00'),
(311, 149, 'std149', 'pv2nf5', '', 'student', 'yes', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(312, 149, 'parent149', 'nkqwyk', '149', 'parent', 'yes', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(313, 150, 'std150', 'mjz5mx', '', 'student', 'yes', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(314, 150, 'parent150', 'qmazq2', '150', 'parent', 'yes', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(315, 151, 'std151', '4ucjpq', '', 'student', 'yes', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(316, 151, 'parent151', '3fgms4', '151', 'parent', 'yes', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(317, 152, 'std152', 'odzuoy', '', 'student', 'yes', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(318, 152, 'parent152', 'l0selh', '152', 'parent', 'yes', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(319, 153, 'std153', 'plcdpl', '', 'student', 'yes', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(320, 153, 'parent153', 'xp1wnp', '153', 'parent', 'yes', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(321, 154, 'std154', 'h3pg2x', '', 'student', 'yes', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(322, 154, 'parent154', 'ucd8gr', '154', 'parent', 'yes', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(323, 155, 'std155', 'k5cxfv', '', 'student', 'yes', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(324, 155, 'parent155', 'dk5cs8', '155', 'parent', 'yes', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(325, 156, 'std156', 'wd89mj', '', 'student', 'yes', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(326, 156, 'parent156', 'bwnpbh', '156', 'parent', 'yes', '2018-06-02 21:59:06', '0000-00-00 00:00:00'),
(327, 157, 'std157', 'pqrj8l', '', 'student', 'yes', '2018-06-02 21:59:07', '0000-00-00 00:00:00'),
(328, 157, 'parent157', '3f9csp', '157', 'parent', 'yes', '2018-06-02 21:59:07', '0000-00-00 00:00:00'),
(329, 158, 'std158', 'rst9wj', '', 'student', 'yes', '2018-06-02 21:59:07', '0000-00-00 00:00:00'),
(330, 158, 'parent158', '92azb2', '158', 'parent', 'yes', '2018-06-02 21:59:07', '0000-00-00 00:00:00'),
(331, 159, 'std159', 'zv6df5', '', 'student', 'yes', '2018-06-02 21:59:07', '0000-00-00 00:00:00'),
(332, 159, 'parent159', 'dzuodz', '159', 'parent', 'yes', '2018-06-02 21:59:07', '0000-00-00 00:00:00'),
(333, 160, 'std160', 'rd41ox', '', 'student', 'yes', '2018-06-02 21:59:07', '0000-00-00 00:00:00'),
(334, 160, 'parent160', '9o3pqh', '160', 'parent', 'yes', '2018-06-02 21:59:07', '0000-00-00 00:00:00'),
(335, 161, 'std161', 'fqoskl', '', 'student', 'yes', '2018-06-02 21:59:07', '0000-00-00 00:00:00'),
(336, 161, 'parent161', 'yfqmdz', '161', 'parent', 'yes', '2018-06-02 21:59:07', '0000-00-00 00:00:00'),
(337, 162, 'std162', 'dz1oxz', '', 'student', 'yes', '2018-08-10 07:26:41', '0000-00-00 00:00:00'),
(338, 162, 'parent162', 'mj8l6n', '162', 'parent', 'yes', '2018-08-10 07:26:41', '0000-00-00 00:00:00'),
(339, 163, 'std163', '8qcyz5', '', 'student', 'yes', '2018-08-10 07:48:20', '0000-00-00 00:00:00'),
(340, 163, 'parent163', 'akurai', '163', 'parent', 'yes', '2018-08-10 07:48:20', '0000-00-00 00:00:00'),
(341, 12, 'khuram', 'nzuwsk', '', 'teacher', 'yes', '2018-08-13 08:26:20', '0000-00-00 00:00:00'),
(342, 13, 'khuramshehzad', 'bh3tu6', '', 'teacher', 'yes', '2018-08-13 08:28:34', '0000-00-00 00:00:00'),
(343, 14, 'khraum', 'mxtqwy', '', 'teacher', 'yes', '2018-08-13 08:30:20', '0000-00-00 00:00:00'),
(344, 15, 'khuram1', '9wji1w', '', 'teacher', 'yes', '2018-08-13 09:16:37', '0000-00-00 00:00:00'),
(345, 16, 'khruam', 'z10spb', '', 'teacher', 'yes', '2018-08-13 09:17:29', '0000-00-00 00:00:00'),
(346, 17, 'khruam1', '3tv6nt', '', 'teacher', 'yes', '2018-08-13 09:21:01', '0000-00-00 00:00:00'),
(347, 18, 'khraum1', 'bwj8vh', '', 'teacher', 'yes', '2018-08-13 09:22:42', '0000-00-00 00:00:00'),
(348, 19, 'test', 'b0szbo', '', 'teacher', 'yes', '2018-08-13 09:25:14', '0000-00-00 00:00:00'),
(349, 164, 'std164', '3tv23f', '', 'student', 'yes', '2018-09-01 13:20:22', '0000-00-00 00:00:00'),
(350, 164, 'parent164', 'wy8q2y', '164', 'parent', 'yes', '2018-09-01 13:20:22', '0000-00-00 00:00:00'),
(351, 165, 'std165', 'x8l27z', '', 'student', 'yes', '2018-08-15 05:58:29', '0000-00-00 00:00:00'),
(352, 165, 'parent165', 'mjk9r3', '165', 'parent', 'yes', '2018-08-15 05:58:29', '0000-00-00 00:00:00'),
(353, 166, 'std166', 'pgrxe5', '', 'student', 'yes', '2018-08-17 06:42:45', '0000-00-00 00:00:00'),
(354, 166, 'parent166', 'd4lmxz', '166', 'parent', 'yes', '2018-08-17 06:42:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `vehicle_no` varchar(20) DEFAULT NULL,
  `vehicle_model` varchar(100) NOT NULL DEFAULT 'None',
  `manufacture_year` varchar(4) DEFAULT NULL,
  `driver_name` varchar(50) DEFAULT NULL,
  `driver_licence` varchar(50) NOT NULL DEFAULT 'None',
  `driver_contact` varchar(20) DEFAULT NULL,
  `note` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `vehicle_no`, `vehicle_model`, `manufacture_year`, `driver_name`, `driver_licence`, `driver_contact`, `note`, `created_at`) VALUES
(1, '123', '2003', '2003', 'Test driver', '123123', '03001234567', '', '2017-10-02 05:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_routes`
--

CREATE TABLE `vehicle_routes` (
  `id` int(11) UNSIGNED NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle_routes`
--

INSERT INTO `vehicle_routes` (`id`, `route_id`, `vehicle_id`, `created_at`) VALUES
(1, 1, 1, '2017-10-02 05:17:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountants`
--
ALTER TABLE `accountants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendence_type`
--
ALTER TABLE `attendence_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_issues`
--
ALTER TABLE `book_issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_promotion_demotion`
--
ALTER TABLE `class_promotion_demotion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_sections`
--
ALTER TABLE `class_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `class_section_monthly_logs`
--
ALTER TABLE `class_section_monthly_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_options`
--
ALTER TABLE `custom_options`
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `email_config`
--
ALTER TABLE `email_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_schedule_id` (`exam_schedule_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_subject_id` (`teacher_subject_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_head`
--
ALTER TABLE `expense_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feecategory`
--
ALTER TABLE `feecategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feemasters`
--
ALTER TABLE `feemasters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_discounts`
--
ALTER TABLE `fees_discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feetype`
--
ALTER TABLE `feetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_groups`
--
ALTER TABLE `fee_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_groups_feetype`
--
ALTER TABLE `fee_groups_feetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_receipt_no`
--
ALTER TABLE `fee_receipt_no`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_session_groups`
--
ALTER TABLE `fee_session_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostel`
--
ALTER TABLE `hostel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostel_rooms`
--
ALTER TABLE `hostel_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_head`
--
ALTER TABLE `inventory_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_items`
--
ALTER TABLE `inventory_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_stock`
--
ALTER TABLE `inventory_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lang_keys`
--
ALTER TABLE `lang_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lang_pharses`
--
ALTER TABLE `lang_pharses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `key_id` (`key_id`);

--
-- Indexes for table `libarary_members`
--
ALTER TABLE `libarary_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `librarians`
--
ALTER TABLE `librarians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `principal`
--
ALTER TABLE `principal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `read_notification`
--
ALTER TABLE `read_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route_vehicles`
--
ALTER TABLE `route_vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sch_settings`
--
ALTER TABLE `sch_settings`
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_notification`
--
ALTER TABLE `send_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_config`
--
ALTER TABLE `sms_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_attendance`
--
ALTER TABLE `staff_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_departments`
--
ALTER TABLE `staff_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_salary_payments`
--
ALTER TABLE `staff_salary_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_advance`
--
ALTER TABLE `student_advance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_assessments`
--
ALTER TABLE `student_assessments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendences`
--
ALTER TABLE `student_attendences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_session_id` (`student_session_id`),
  ADD KEY `attendence_type_id` (`attendence_type_id`);

--
-- Indexes for table `student_doc`
--
ALTER TABLE `student_doc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_fees`
--
ALTER TABLE `student_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_fees_deposite`
--
ALTER TABLE `student_fees_deposite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_fees_discounts`
--
ALTER TABLE `student_fees_discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_fees_master`
--
ALTER TABLE `student_fees_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_fee_payments`
--
ALTER TABLE `student_fee_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_fee_payments_others`
--
ALTER TABLE `student_fee_payments_others`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_fee_types`
--
ALTER TABLE `student_fee_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_fee_voucher`
--
ALTER TABLE `student_fee_voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_fee_voucher_fee_types`
--
ALTER TABLE `student_fee_voucher_fee_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_logs`
--
ALTER TABLE `student_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_session`
--
ALTER TABLE `student_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_sibling`
--
ALTER TABLE `student_sibling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_transport_fees`
--
ALTER TABLE `student_transport_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `teacher_attendance`
--
ALTER TABLE `teacher_attendance`
  ADD PRIMARY KEY (`teacher_attendance_id`);

--
-- Indexes for table `teacher_attendence_types`
--
ALTER TABLE `teacher_attendence_types`
  ADD PRIMARY KEY (`teacher_attendence_type_id`);

--
-- Indexes for table `teacher_salary_payments`
--
ALTER TABLE `teacher_salary_payments`
  ADD PRIMARY KEY (`teacher_salary_payment_id`);

--
-- Indexes for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_section_id` (`class_section_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `teacher_types`
--
ALTER TABLE `teacher_types`
  ADD PRIMARY KEY (`teacher_type_id`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `transport_route`
--
ALTER TABLE `transport_route`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_routes`
--
ALTER TABLE `vehicle_routes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountants`
--
ALTER TABLE `accountants`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `attendence_type`
--
ALTER TABLE `attendence_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `book_issues`
--
ALTER TABLE `book_issues`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `class_promotion_demotion`
--
ALTER TABLE `class_promotion_demotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `class_sections`
--
ALTER TABLE `class_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `class_section_monthly_logs`
--
ALTER TABLE `class_section_monthly_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;
--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_config`
--
ALTER TABLE `email_config`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `expense_head`
--
ALTER TABLE `expense_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `feecategory`
--
ALTER TABLE `feecategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feemasters`
--
ALTER TABLE `feemasters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fees_discounts`
--
ALTER TABLE `fees_discounts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feetype`
--
ALTER TABLE `feetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fee_groups`
--
ALTER TABLE `fee_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `fee_groups_feetype`
--
ALTER TABLE `fee_groups_feetype`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fee_receipt_no`
--
ALTER TABLE `fee_receipt_no`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fee_session_groups`
--
ALTER TABLE `fee_session_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `hostel`
--
ALTER TABLE `hostel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hostel_rooms`
--
ALTER TABLE `hostel_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `inventory_head`
--
ALTER TABLE `inventory_head`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `inventory_items`
--
ALTER TABLE `inventory_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `inventory_stock`
--
ALTER TABLE `inventory_stock`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `lang_keys`
--
ALTER TABLE `lang_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=692;
--
-- AUTO_INCREMENT for table `lang_pharses`
--
ALTER TABLE `lang_pharses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74022;
--
-- AUTO_INCREMENT for table `libarary_members`
--
ALTER TABLE `libarary_members`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `librarians`
--
ALTER TABLE `librarians`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `principal`
--
ALTER TABLE `principal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `read_notification`
--
ALTER TABLE `read_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `route_vehicles`
--
ALTER TABLE `route_vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `send_notification`
--
ALTER TABLE `send_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `sms_config`
--
ALTER TABLE `sms_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `staff_attendance`
--
ALTER TABLE `staff_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `staff_departments`
--
ALTER TABLE `staff_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `staff_salary_payments`
--
ALTER TABLE `staff_salary_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;
--
-- AUTO_INCREMENT for table `student_advance`
--
ALTER TABLE `student_advance`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `student_assessments`
--
ALTER TABLE `student_assessments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `student_attendences`
--
ALTER TABLE `student_attendences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=718;
--
-- AUTO_INCREMENT for table `student_doc`
--
ALTER TABLE `student_doc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student_fees`
--
ALTER TABLE `student_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student_fees_deposite`
--
ALTER TABLE `student_fees_deposite`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `student_fees_discounts`
--
ALTER TABLE `student_fees_discounts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student_fees_master`
--
ALTER TABLE `student_fees_master`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student_fee_payments`
--
ALTER TABLE `student_fee_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
--
-- AUTO_INCREMENT for table `student_fee_payments_others`
--
ALTER TABLE `student_fee_payments_others`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1542;
--
-- AUTO_INCREMENT for table `student_fee_types`
--
ALTER TABLE `student_fee_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `student_fee_voucher`
--
ALTER TABLE `student_fee_voucher`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=617;
--
-- AUTO_INCREMENT for table `student_fee_voucher_fee_types`
--
ALTER TABLE `student_fee_voucher_fee_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=811;
--
-- AUTO_INCREMENT for table `student_logs`
--
ALTER TABLE `student_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `student_session`
--
ALTER TABLE `student_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;
--
-- AUTO_INCREMENT for table `student_sibling`
--
ALTER TABLE `student_sibling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student_transport_fees`
--
ALTER TABLE `student_transport_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `teacher_attendance`
--
ALTER TABLE `teacher_attendance`
  MODIFY `teacher_attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;
--
-- AUTO_INCREMENT for table `teacher_attendence_types`
--
ALTER TABLE `teacher_attendence_types`
  MODIFY `teacher_attendence_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `teacher_salary_payments`
--
ALTER TABLE `teacher_salary_payments`
  MODIFY `teacher_salary_payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `teacher_types`
--
ALTER TABLE `teacher_types`
  MODIFY `teacher_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `transport_route`
--
ALTER TABLE `transport_route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;
--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vehicle_routes`
--
ALTER TABLE `vehicle_routes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
