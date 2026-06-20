-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 07, 2018 at 07:03 AM
-- Server version: 10.2.12-MariaDB-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pluged5_plugedin`
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
  `address` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `role`, `email`, `password`, `is_active`, `created_at`, `updated_at`) VALUES
(5, 'Admin', 'admin', 'mohammadwaseem043@gmail.com', 'c541c1329200085c9d81d5e212853f39', 'yes', '2018-03-06 07:17:30', '0000-00-00 00:00:00'),
(6, 'Admin', 'admin', 'urwa@gmail.com', '202cb962ac59075b964b07152d234b70', 'yes', '2017-09-20 07:50:44', '0000-00-00 00:00:00'),
(7, 'Amina', 'admin', 'amina@gmail.com', '2e38b89bd4397cc10c043fec77b2f615', 'yes', '2017-09-20 13:23:10', '0000-00-00 00:00:00'),
(9, 'Admin', 'admin', 'Admin@admin.com', 'c541c1329200085c9d81d5e212853f39', 'yes', '2018-03-05 05:32:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `attendence_type`
--

CREATE TABLE `attendence_type` (
  `id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key_value` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attendence_type`
--

INSERT INTO `attendence_type` (`id`, `type`, `key_value`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Present', '<b class=\"text text-success\">P</b>', 'yes', '2016-06-24 09:11:37', '0000-00-00 00:00:00'),
(2, 'Late with excuse', '<b class=\"text text-warning\">E</b>', 'yes', '2016-10-12 02:35:44', '0000-00-00 00:00:00'),
(3, 'Late', '<b class=\"text text-warning\">L</b>', 'yes', '2016-06-24 09:12:28', '0000-00-00 00:00:00'),
(4, 'Absent', '<b class=\"text text-danger\">A</b>', 'yes', '2016-10-12 02:35:40', '0000-00-00 00:00:00'),
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
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `available` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'yes',
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_issues`
--

CREATE TABLE `book_issues` (
  `id` int(11) UNSIGNED NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `issue_date` date NOT NULL,
  `is_returned` int(10) NOT NULL DEFAULT 0,
  `member_id` int(11) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fee` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class`, `fee`, `is_active`, `created_at`, `updated_at`) VALUES
(16, '1st', 2000, 'no', '2018-08-02 05:50:36', '0000-00-00 00:00:00'),
(17, '2nd', 2000, 'no', '2018-08-02 05:50:50', '0000-00-00 00:00:00');

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
  `new_admission` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class_promotion_demotion`
--

INSERT INTO `class_promotion_demotion` (`id`, `session_id`, `class_id`, `section_id`, `promoted`, `demoted`, `new_admission`) VALUES
(25, 13, 16, 5, 0, 0, 2),
(26, 13, 17, 6, 0, 0, 6),
(27, 13, 16, 6, 0, 0, 3),
(28, 13, 17, 5, 0, 0, 1);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `class_sections`
--

INSERT INTO `class_sections` (`id`, `class_id`, `section_id`, `is_active`, `class_incharge_teacher_id`, `created_at`, `updated_at`) VALUES
(26, 16, 5, 'no', NULL, '2018-08-02 05:50:36', '0000-00-00 00:00:00'),
(27, 16, 6, 'no', NULL, '2018-08-02 05:50:36', '0000-00-00 00:00:00'),
(28, 17, 5, 'no', NULL, '2018-08-02 05:50:50', '0000-00-00 00:00:00'),
(29, 17, 6, 'no', NULL, '2018-08-02 05:50:50', '0000-00-00 00:00:00');

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
  `class_section_fee_arrears` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `class_section_advance_fee` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `log_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class_section_monthly_logs`
--

INSERT INTO `class_section_monthly_logs` (`id`, `class_section_id`, `total_students`, `total_tuition_fee`, `total_other_fee`, `receiveable_total_fee`, `receiveable_total_received`, `overall_receivable`, `struck_off`, `discount`, `class_section_fee_arrears`, `class_section_advance_fee`, `log_date`) VALUES
(73, 26, 1, 5500, 60000, 2000, 5500, 0, 0, 0, 0, 1500, '2018-08-01'),
(74, 27, 3, 8500, 0, 4000, 8500, 4500, 0, 2000, 7000, 2500, '2018-08-01'),
(75, 28, 1, 8000, 0, 2000, 8000, 0, 0, 0, 0, 0, '2018-08-01'),
(76, 29, 3, 13000, 5000, 3800, 13000, 3800, 0, 2200, 3800, 0, '2018-08-01');

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
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
('admin_phone', '923157915132'),
('bank_account', '123'),
('fine_per_day_for_fee', '100'),
('last_date_for_receiving_fee', '5'),
('restrict_attendance_after', '12:11'),
('student_fee_fine_type', 'fixed_fine_after_due_date'),
('teachers_max_leaves_in_month', '9'),
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'yes',
  `is_deleted` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `exp_head_id`, `name`, `date`, `amount`, `note`, `is_active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rent', '2018-04-18', 50000.00, NULL, 'yes', 'no', '2018-04-18 17:50:34', '0000-00-00 00:00:00'),
(3, 1, '10', '2018-04-19', 1000.00, NULL, 'yes', 'no', '2018-04-18 19:07:39', '0000-00-00 00:00:00'),
(4, 1, 'aaa', '2018-04-19', 1000.00, NULL, 'yes', 'no', '2018-04-18 19:15:55', '0000-00-00 00:00:00'),
(5, 1, 'aaa', '2018-04-19', 1500.00, NULL, 'yes', 'no', '2018-04-18 19:16:49', '0000-00-00 00:00:00'),
(6, 1, 'rent', '2018-04-19', 50000.00, NULL, 'yes', 'no', '2018-04-19 04:15:38', '0000-00-00 00:00:00'),
(7, 1, 'rent', '2018-04-19', 50000.00, NULL, 'yes', 'no', '2018-04-19 04:15:44', '0000-00-00 00:00:00'),
(8, 1, 'rent', '2018-04-19', 50000.00, NULL, 'yes', 'no', '2018-04-19 04:18:53', '0000-00-00 00:00:00'),
(9, 2, 'dec', '2018-04-19', 50000.00, NULL, 'yes', 'no', '2018-04-19 08:25:24', '0000-00-00 00:00:00'),
(10, 2, 'jan', '2018-04-19', 50000.00, NULL, 'yes', 'no', '2018-04-19 08:25:40', '0000-00-00 00:00:00'),
(11, 1, 'rent2', '2018-04-20', 10000.00, NULL, 'yes', 'no', '2018-04-20 09:38:07', '0000-00-00 00:00:00'),
(13, 2, 'Rent', '2018-04-20', 5.00, NULL, 'yes', 'no', '2018-04-20 13:14:21', '0000-00-00 00:00:00'),
(14, 1, 'Rent', '2018-04-20', 50000.00, NULL, 'yes', 'no', '2018-04-20 13:15:24', '0000-00-00 00:00:00'),
(15, 1, 'Rent3', '2018-04-20', 50000.00, NULL, 'yes', 'no', '2018-04-20 13:18:18', '0000-00-00 00:00:00'),
(17, 2, 'Ren4', '2018-04-20', 55000.00, NULL, 'yes', 'no', '2018-04-20 13:19:50', '0000-00-00 00:00:00'),
(18, 1, 'Special', '2018-04-20', 57000.00, NULL, 'yes', 'no', '2018-04-20 13:22:56', '0000-00-00 00:00:00'),
(19, 2, 'Ren4', '2018-04-20', 53000.00, NULL, 'yes', 'no', '2018-04-20 13:23:45', '0000-00-00 00:00:00'),
(20, 1, 'Rent5', '2018-04-20', 58000.00, NULL, 'yes', 'no', '2018-04-20 13:26:43', '0000-00-00 00:00:00'),
(21, 2, 'Rent6', '2018-04-18', 50000.00, 'Rent', 'yes', 'no', '2018-04-20 13:34:17', '0000-00-00 00:00:00'),
(22, 1, 'test', '2018-04-20', 50000.00, NULL, 'yes', 'no', '2018-04-20 13:51:22', '0000-00-00 00:00:00'),
(23, 1, 'test', '2018-04-20', 80000.00, NULL, 'yes', 'no', '2018-04-20 13:51:36', '0000-00-00 00:00:00'),
(24, 1, 'test', '2018-04-20', 50000.00, NULL, 'yes', 'no', '2018-04-20 13:56:38', '0000-00-00 00:00:00'),
(25, 1, 'test', '2018-04-20', 750000.00, NULL, 'yes', 'no', '2018-04-20 13:56:46', '0000-00-00 00:00:00'),
(26, 1, 'test', '2018-04-20', 50000.00, NULL, 'yes', 'no', '2018-04-20 13:56:54', '0000-00-00 00:00:00'),
(27, 2, 'asd', '2018-04-20', 50000.00, NULL, 'yes', 'no', '2018-04-20 17:44:20', '0000-00-00 00:00:00'),
(28, 3, 'asdf', '2018-04-20', 5500.00, 'asdf', 'yes', 'no', '2018-04-20 17:47:57', '0000-00-00 00:00:00'),
(29, 4, 'sweaper', '2018-04-20', 9000.00, NULL, 'yes', 'no', '2018-04-20 17:49:28', '0000-00-00 00:00:00'),
(30, 4, 'asdf', '2018-04-20', 90000.00, NULL, 'yes', 'no', '2018-04-20 17:52:26', '0000-00-00 00:00:00'),
(31, 2, 'wer', '2018-04-20', 55000.00, NULL, 'yes', 'no', '2018-04-20 17:52:43', '0000-00-00 00:00:00'),
(35, 2, 'April', '2018-04-20', 50000.00, NULL, 'yes', 'no', '2018-04-20 17:55:46', '0000-00-00 00:00:00'),
(37, 1, '12', '2018-04-20', 8000.00, NULL, 'yes', 'no', '2018-04-20 17:56:44', '0000-00-00 00:00:00'),
(38, 1, 'sa', '2018-04-20', 59999.00, NULL, 'yes', 'no', '2018-04-20 17:57:17', '0000-00-00 00:00:00'),
(39, 1, 'april2', '2018-04-20', 50000.00, NULL, 'yes', 'no', '2018-04-20 17:58:26', '0000-00-00 00:00:00'),
(40, 1, 'april2', '2018-04-20', 50000.00, NULL, 'yes', 'no', '2018-04-20 17:58:35', '0000-00-00 00:00:00'),
(41, 3, 'PPP', '2018-04-10', 12909.00, 'ghd', 'yes', 'no', '2018-04-20 18:03:15', '0000-00-00 00:00:00'),
(42, 2, '211as', '2018-04-20', 4500000.00, NULL, 'yes', 'no', '2018-04-20 18:08:39', '0000-00-00 00:00:00'),
(43, 5, '12', '2018-04-20', 900000.00, NULL, 'yes', 'no', '2018-04-20 18:10:15', '0000-00-00 00:00:00'),
(44, 2, 'april', '2018-04-21', 50000.00, NULL, 'yes', 'no', '2018-04-21 05:48:11', '0000-00-00 00:00:00'),
(45, 1, 'rent222', '2018-04-21', 45000.00, NULL, 'yes', 'no', '2018-04-21 05:48:26', '0000-00-00 00:00:00'),
(46, 3, 'bill', '2018-04-21', 345000.00, NULL, 'yes', 'no', '2018-04-21 05:48:44', '0000-00-00 00:00:00'),
(47, 2, 'test rent', '2018-04-24', 10000000.00, NULL, 'yes', 'no', '2018-04-24 06:40:54', '0000-00-00 00:00:00'),
(48, 2, 'april', '2018-04-25', 50000.00, NULL, 'yes', 'no', '2018-04-25 05:08:42', '0000-00-00 00:00:00'),
(49, 2, 'tsis tneR', '2018-05-01', 50000.00, NULL, 'yes', 'no', '2018-05-01 16:41:26', '0000-00-00 00:00:00'),
(50, 2, 'Rent it', '2018-05-01', 52000.00, NULL, 'yes', 'no', '2018-05-01 16:42:35', '0000-00-00 00:00:00'),
(51, 2, 'Rent it', '2018-05-01', 52000.00, NULL, 'yes', 'no', '2018-05-01 16:42:46', '0000-00-00 00:00:00'),
(52, 7, 'petrol', '2018-05-26', 10000.00, NULL, 'yes', 'no', '2018-05-26 06:44:54', '0000-00-00 00:00:00'),
(53, 3, '3876', '2018-07-18', 10000.00, NULL, 'yes', 'no', '2018-07-18 11:18:20', '0000-00-00 00:00:00'),
(54, 2, 'rent', '2018-07-21', 10000.00, NULL, 'yes', 'no', '2018-07-21 12:57:54', '0000-00-00 00:00:00'),
(55, 2, 'rent', '2018-07-24', 10000.00, NULL, 'yes', 'no', '2018-07-24 07:11:47', '0000-00-00 00:00:00'),
(56, 1, 'misc', '2018-08-03', 1000.00, NULL, 'yes', 'no', '2018-08-03 13:30:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `expense_head`
--

CREATE TABLE `expense_head` (
  `id` int(11) NOT NULL,
  `exp_category` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'yes',
  `is_deleted` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expense_head`
--

INSERT INTO `expense_head` (`id`, `exp_category`, `description`, `is_active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Misc', '', 'yes', 'no', '2018-04-09 03:33:50', '0000-00-00 00:00:00'),
(2, 'Rent', '', 'yes', 'no', '2018-04-19 08:25:03', '0000-00-00 00:00:00'),
(3, 'PTCL Bill', 'asdsad', 'yes', 'no', '2018-04-20 17:46:58', '0000-00-00 00:00:00'),
(4, 'Sweaper', 'adskjdha', 'yes', 'no', '2018-04-20 17:47:22', '0000-00-00 00:00:00'),
(5, 'Rent', 'qwe\r\n', 'yes', 'no', '2018-04-20 18:09:47', '0000-00-00 00:00:00'),
(6, 'mics2', '', 'yes', 'no', '2018-05-23 05:34:23', '0000-00-00 00:00:00'),
(7, 'cash', '', 'yes', 'no', '2018-05-26 06:44:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `feecategory`
--

CREATE TABLE `feecategory` (
  `id` int(11) NOT NULL,
  `category` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `description` text DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fee_groups`
--

CREATE TABLE `fee_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fee_voucher_saved`
--

CREATE TABLE `fee_voucher_saved` (
  `id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `voucher_created_date` varchar(150) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `head_name` varchar(100) NOT NULL,
  `head_amount` int(11) NOT NULL,
  `timestamp` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hostel`
--

CREATE TABLE `hostel` (
  `id` int(11) NOT NULL,
  `hostel_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `intake` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `cost_per_bed` float(10,2) DEFAULT 0.00,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `inventory_head`
--

INSERT INTO `inventory_head` (`id`, `inventory_title`, `description`, `is_active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Stationary', '', 'no', 'no', '2018-04-09 03:34:06', '2018-04-09 03:34:06');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `inventory_items`
--

INSERT INTO `inventory_items` (`id`, `inv_head_id`, `quantity`, `amount`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 10, '5000', 'test details', '2018-04-18 19:05:00', '2018-04-18 19:05:00');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `inventory_stock`
--

INSERT INTO `inventory_stock` (`id`, `inventory_head_id`, `quantity`, `amount`, `type`, `created_at`) VALUES
(1, 1, 10, 5000, 'addition', '2018-04-18 19:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `language` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `leave_date_added` varchar(200) NOT NULL,
  `student_leave_for_date` varchar(200) NOT NULL,
  `leave_reason` varchar(1000) NOT NULL,
  `leave_day` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `incharge_id` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `user_id`, `leave_date_added`, `student_leave_for_date`, `leave_reason`, `leave_day`, `role`, `status`, `class_id`, `section_id`, `incharge_id`) VALUES
(1, '258', '', '25/1/2018', 'any reason', '1 day', 'parent', 'reject', 13, 1, ''),
(2, '1', '', '26/1/2018', 'Usama daood', '4 days', 'parent', '', 7, 1, ''),
(3, '145', '25 Jan 2018 11:58:37 am', '26/1/2018', 'shadiiii', '5 days', 'parent', '', 5, 1, '0'),
(4, '241', '25 Jan 2018 12:04:25 pm', '26/1/2018', 'shadiii', '5 days', 'parent', '', 13, 1, '1');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `librarians`
--

CREATE TABLE `librarians` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `id` int(11) NOT NULL,
  `teacher_id` varchar(200) NOT NULL,
  `meet_date_time_id` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`id`, `teacher_id`, `meet_date_time_id`) VALUES
(1, '0', '1'),
(2, '1', '1'),
(3, '2', '1'),
(4, '3', '1'),
(5, '4', '1'),
(6, '5', '1'),
(7, '6', '1'),
(8, '7', '1'),
(9, '8', '1'),
(10, '9', '1'),
(11, '10', '1'),
(12, '11', '1'),
(13, '12', '1');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_time_date`
--

CREATE TABLE `meeting_time_date` (
  `id` int(11) NOT NULL,
  `time` varchar(256) NOT NULL,
  `date` varchar(256) NOT NULL,
  `status` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meeting_time_date`
--

INSERT INTO `meeting_time_date` (`id`, `time`, `date`, `status`) VALUES
(1, '3:52', '13/9/2017', 'princ_teacher');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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

--
-- Dumping data for table `principal`
--

INSERT INTO `principal` (`id`, `username`, `name`, `email`, `CNIC`, `password`) VALUES
(1, 'principal', 'Test Principle', 'principle@gmail.com', '123', '1234');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` int(11) NOT NULL,
  `room_type` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `route_vehicles`
--

CREATE TABLE `route_vehicles` (
  `id` int(11) NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `address` text COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sch_settings`
--

INSERT INTO `sch_settings` (`id`, `name`, `email`, `phone`, `address`, `lang_id`, `dise_code`, `date_format`, `currency`, `currency_symbol`, `is_rtl`, `timezone`, `session_id`, `start_month`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'School Automation System', 'info@tecnogat.com', '03333484848', 'Kohinoor', 4, '', 'm/d/Y', 'PKR', 'Rs.', 'disabled', 'Asia/Karachi', 13, '3', '1.jpg', 'no', '2018-07-23 08:22:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `section` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section`, `is_active`, `created_at`, `updated_at`) VALUES
(5, 'BOYS', 'no', '2018-05-27 07:22:16', '0000-00-00 00:00:00'),
(6, 'GIRLS', 'no', '2018-05-27 07:22:28', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `send_notification`
--

CREATE TABLE `send_notification` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `date` date DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `visible_student` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `visible_teacher` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `visible_parent` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `created_by` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `contact` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'disabled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `designation` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `joining_date` date DEFAULT NULL,
  `qualification` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qualification_details` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `staff_department_id` int(11) NOT NULL,
  `salary` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `due_salary` int(11) NOT NULL DEFAULT 0 COMMENT 'How much salary is due in account. It can be negative value.',
  `salary_update_date` date NOT NULL DEFAULT '0000-00-00',
  `fingerprint_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `email`, `address`, `dob`, `designation`, `sex`, `phone`, `image`, `is_active`, `joining_date`, `qualification`, `qualification_details`, `staff_department_id`, `salary`, `due_salary`, `salary_update_date`, `fingerprint_file`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'test@gmail.com', 'fsd', '2018-04-26', NULL, 'Male', '', NULL, 'no', '0000-00-00', '', '', 1, 80000, 400000, '2018-08-01', 'uploads/fingerprint/staff_1.fpt', '2018-07-31 19:00:07', '0000-00-00 00:00:00'),
(2, 'Sameer Khan', 'Sameer@gmail.com', 'Fsd', '2018-04-26', NULL, 'Male', '03123', NULL, 'no', '0000-00-00', 'CA', '', 1, 190000, 950000, '2018-08-01', 'uploads/fingerprint/staff_2.fpt', '2018-07-31 19:00:07', '0000-00-00 00:00:00'),
(3, 'Ahsan', 'Ahsan@gmail.com', '', '2018-04-16', NULL, 'Male', '', NULL, 'no', '0000-00-00', 'MCS', '', 1, 9000, 45000, '2018-08-01', 'uploads/fingerprint/staff_3.fpt', '2018-07-31 19:00:07', '0000-00-00 00:00:00'),
(4, 'Sundus', 'SUndus@gmail.com', '', NULL, NULL, 'Female', '', NULL, 'no', '0000-00-00', 'F.SC', '', 1, 90909, 272727, '2018-08-01', 'uploads/fingerprint/staff_4.fpt', '2018-07-31 19:00:07', '0000-00-00 00:00:00'),
(5, 'Abbas Agha', 'AbbasAgha@gmail.com', 'FSd', '2018-04-05', NULL, 'Male', '9123123', NULL, 'no', '0000-00-00', '', '', 1, 7888, 31552, '2018-08-01', 'uploads/fingerprint/staff_5.fpt', '2018-07-31 19:00:07', '0000-00-00 00:00:00'),
(6, 'Rayyan', 'Rayyan@gmail.com', 'Fsd', '2018-04-03', NULL, 'Female', '1298372189', NULL, 'no', '0000-00-00', 'F.SC', '', 1, 8989, 44945, '2018-08-01', 'uploads/fingerprint/staff_6.fpt', '2018-07-31 19:00:07', '0000-00-00 00:00:00'),
(7, 'Naima', 'Naima@gmail.com', '', '2018-04-11', NULL, 'Female', '', NULL, 'no', '0000-00-00', 'MCS', '', 1, 9090, 45450, '2018-08-01', 'uploads/fingerprint/staff_7.fpt', '2018-07-31 19:00:07', '0000-00-00 00:00:00'),
(8, 'Rida', 'Rida@gmail.con', 'FSd', '2018-04-13', NULL, 'Female', '678678', NULL, 'no', '0000-00-00', 'F.SC', 'hkhj', 1, 67777, 338885, '2018-08-01', 'uploads/fingerprint/staff_8.fpt', '2018-07-31 19:00:07', '0000-00-00 00:00:00');

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
(805, 5, 'absent', '2018-08-01', '23:25:05'),
(806, 3, 'absent', '2018-08-01', '23:25:05'),
(807, 7, 'absent', '2018-08-01', '23:25:05'),
(808, 6, 'absent', '2018-08-01', '23:25:05'),
(809, 8, 'absent', '2018-08-01', '23:25:05'),
(810, 2, 'absent', '2018-08-01', '23:25:05'),
(811, 4, 'absent', '2018-08-01', '23:25:05'),
(812, 1, 'absent', '2018-08-01', '23:25:05'),
(813, 5, 'absent', '2018-08-02', '13:00:07'),
(814, 3, 'absent', '2018-08-02', '13:00:07'),
(815, 7, 'absent', '2018-08-02', '13:00:07'),
(816, 6, 'absent', '2018-08-02', '13:00:07'),
(817, 8, 'absent', '2018-08-02', '13:00:07'),
(818, 2, 'absent', '2018-08-02', '13:00:07'),
(819, 4, 'absent', '2018-08-02', '13:00:07'),
(820, 1, 'absent', '2018-08-02', '13:00:07'),
(821, 5, 'absent', '2018-08-03', '13:00:06'),
(822, 3, 'absent', '2018-08-03', '13:00:06'),
(823, 7, 'absent', '2018-08-03', '13:00:06'),
(824, 6, 'absent', '2018-08-03', '13:00:06'),
(825, 8, 'absent', '2018-08-03', '13:00:06'),
(826, 2, 'absent', '2018-08-03', '13:00:06'),
(827, 4, 'absent', '2018-08-03', '13:00:06'),
(828, 1, 'absent', '2018-08-03', '13:00:06'),
(829, 5, 'absent', '2018-08-04', '13:00:04'),
(830, 3, 'absent', '2018-08-04', '13:00:04'),
(831, 7, 'absent', '2018-08-04', '13:00:04'),
(832, 6, 'absent', '2018-08-04', '13:00:04'),
(833, 8, 'absent', '2018-08-04', '13:00:04'),
(834, 2, 'absent', '2018-08-04', '13:00:04'),
(835, 4, 'absent', '2018-08-04', '13:00:04'),
(836, 1, 'absent', '2018-08-04', '13:00:04'),
(837, 5, 'absent', '2018-08-05', '13:00:07'),
(838, 3, 'absent', '2018-08-05', '13:00:07'),
(839, 7, 'absent', '2018-08-05', '13:00:07'),
(840, 6, 'absent', '2018-08-05', '13:00:07'),
(841, 8, 'absent', '2018-08-05', '13:00:07'),
(842, 2, 'absent', '2018-08-05', '13:00:07'),
(843, 4, 'absent', '2018-08-05', '13:00:07'),
(844, 1, 'absent', '2018-08-05', '13:00:07'),
(845, 5, 'absent', '2018-08-06', '13:00:05'),
(846, 3, 'absent', '2018-08-06', '13:00:05'),
(847, 7, 'absent', '2018-08-06', '13:00:05'),
(848, 6, 'absent', '2018-08-06', '13:00:05'),
(849, 8, 'absent', '2018-08-06', '13:00:05'),
(850, 2, 'absent', '2018-08-06', '13:00:05'),
(851, 4, 'absent', '2018-08-06', '13:00:05'),
(852, 1, 'absent', '2018-08-06', '13:00:05'),
(853, 5, 'absent', '2018-08-07', '13:00:06'),
(854, 3, 'absent', '2018-08-07', '13:00:06'),
(855, 7, 'absent', '2018-08-07', '13:00:06'),
(856, 6, 'absent', '2018-08-07', '13:00:06'),
(857, 8, 'absent', '2018-08-07', '13:00:06'),
(858, 2, 'absent', '2018-08-07', '13:00:06'),
(859, 4, 'absent', '2018-08-07', '13:00:06'),
(860, 1, 'absent', '2018-08-07', '13:00:06');

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
(1, 'Admin');

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
  `current_address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `permanent_address` text COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `guardian_address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `fee_arrears` int(11) NOT NULL DEFAULT 0,
  `fee_update_date` date NOT NULL DEFAULT '0000-00-00',
  `discount` int(11) NOT NULL DEFAULT 0,
  `late_payment_fee` int(11) NOT NULL DEFAULT 0,
  `late_payment_fee_update_date` date NOT NULL DEFAULT '0000-00-00',
  `fee_starting_date` date DEFAULT NULL,
  `previous_school` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `struck_off` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `admission_no`, `roll_no`, `admission_date`, `firstname`, `lastname`, `rte`, `image`, `mobileno`, `email`, `state`, `city`, `pincode`, `religion`, `cast`, `dob`, `gender`, `current_address`, `permanent_address`, `category_id`, `adhar_no`, `samagra_id`, `bank_account_no`, `bank_name`, `ifsc_code`, `guardian_is`, `father_name`, `father_phone`, `father_occupation`, `father_cnic`, `mother_name`, `mother_phone`, `mother_occupation`, `guardian_name`, `guardian_relation`, `guardian_phone`, `guardian_occupation`, `guardian_address`, `is_active`, `fee_arrears`, `fee_update_date`, `discount`, `late_payment_fee`, `late_payment_fee_update_date`, `fee_starting_date`, `previous_school`, `struck_off`, `created_at`, `updated_at`) VALUES
(177, '2', '2', '2018-08-02', 'test1', '', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '1970-01-01', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'test father', '021', '', '1111111111111', '', '', '', 'test father', 'father', '021', '', '', 'no', -1500, '2018-08-01', 0, 0, '2018-08-31', '2018-08-01', '', 0, '2018-08-03 07:47:49', '0000-00-00 00:00:00'),
(178, '3', '3', '2018-08-02', 'test', '', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-08-01', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'test father', '122222', 'business', '1111111111111', '', '', '', 'test father', 'father', '122222', 'business', '', 'no', -2500, '2018-08-01', 0, 0, '2018-08-31', '2018-08-01', '', 0, '2018-08-03 07:40:38', '0000-00-00 00:00:00'),
(179, '4', '4', '2018-08-03', 'test33', '', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-08-09', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'test', '2233', 'job', '1111111111111', '', '', '', 'test', 'father', '2233', 'job', '', 'no', 0, '2018-08-01', 0, 0, '2018-08-31', '2018-08-01', '', 0, '2018-08-05 07:17:05', '0000-00-00 00:00:00'),
(180, '5', '5', '2018-08-03', 'test1', '', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '1970-01-01', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'test father', '', '', '1111111111111', '', '', '', 'test father', 'father', '', '', '', 'no', 0, '2018-08-01', 2000, 0, '2018-08-31', '2018-08-01', '', 0, '2018-08-03 08:03:30', '0000-00-00 00:00:00'),
(181, '66', '6', '2018-08-03', 'test3', '', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-07-03', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'test father', '', '', '1111111111111', '', '', '', 'test father', 'father', '', '', '', 'no', 0, '2018-08-01', 2000, 0, '2018-08-31', '2018-08-01', '', 0, '2018-08-03 08:06:34', '0000-00-00 00:00:00'),
(182, '67', '67', '2018-08-03', 'test1', '', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2009-01-01', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'test father', '021', '', '1234567891234', '', '', '', 'test father', 'father', '021', '', '', 'no', 1800, '2018-08-01', 200, 0, '2018-08-31', '2018-08-01', '', 0, '2018-08-06 18:14:49', '0000-00-00 00:00:00'),
(183, '68', '1', '2018-08-04', 'test1', '', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '1970-01-01', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'test father', '021', '', '1111111111111', '', '', '', 'test father', 'father', '021', '', '', 'no', 7000, '2018-08-01', 0, 0, '2018-08-31', '2018-08-01', '', 0, '2018-08-06 18:09:22', '0000-00-00 00:00:00'),
(184, '69', '9', '2018-08-06', 'test4', '', 'No', 'uploads/student_images/no_image.png', '', '', NULL, NULL, NULL, '', '', '2018-07-01', 'Male', '', '', NULL, '', '', '', '', '', 'father', 'test father', '021', '', '1111111111111', '', '', '', 'test father', 'father', '021', '', '', 'no', 2000, '2018-08-01', 0, 0, '2018-08-31', '2018-08-01', '', 0, '2018-08-06 18:31:12', '0000-00-00 00:00:00');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `amount_fine` float(10,2) NOT NULL DEFAULT 0.00,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT '0000-00-00',
  `payment_mode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `amount_detail` text DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `description` text DEFAULT NULL,
  `is_active` varchar(10) NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_fee_payments`
--

CREATE TABLE `student_fee_payments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL DEFAULT 0,
  `tuition_fee` int(11) NOT NULL DEFAULT 0,
  `due_fee` int(11) NOT NULL DEFAULT 0,
  `total_paid_fee` int(11) NOT NULL DEFAULT 0,
  `fee_description` text NOT NULL,
  `payment_date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_fee_payments`
--

INSERT INTO `student_fee_payments` (`id`, `student_id`, `tuition_fee`, `due_fee`, `total_paid_fee`, `fee_description`, `payment_date`) VALUES
(175, 174, 2000, 4000, 2000, '', '2018-08-02'),
(177, 177, 2000, 4000, 2000, '', '2018-08-02'),
(183, 177, 0, 2000, 60000, '', '2018-08-02'),
(184, 177, 1000, 2000, 1000, '', '2018-08-03'),
(187, 178, 2000, 4000, 2000, '', '2018-08-03'),
(188, 178, 2000, 2000, 2000, '', '2018-08-03'),
(189, 178, 2500, 0, 2500, '', '2018-08-03'),
(190, 177, 1000, 1000, 1000, '', '2018-08-03'),
(191, 177, 1500, 0, 1500, '', '2018-08-03'),
(194, 181, 0, 0, 5000, '', '2018-08-03'),
(195, 179, 5000, 8000, 5000, '', '2018-08-04'),
(196, 183, 1000, 6000, 1000, '', '2018-08-04'),
(198, 179, 1000, 3000, 1000, '', '2018-08-05'),
(199, 179, 2000, 2000, 2000, '', '2018-08-05'),
(203, 183, 1000, 8000, 1000, 'may', '2018-08-06'),
(209, 182, 5000, 6800, 5000, 'jul', '2018-08-06'),
(210, 184, 2000, 10000, 2000, 'april', '2018-08-06'),
(211, 184, 2000, 8000, 2000, 'may', '2018-08-06'),
(212, 184, 2000, 6000, 2000, 'jun', '2018-08-06'),
(213, 184, 2000, 4000, 2000, 'jul', '2018-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `student_fee_payments_others`
--

CREATE TABLE `student_fee_payments_others` (
  `id` int(11) NOT NULL,
  `student_fee_payment_id` int(11) NOT NULL,
  `fee_name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_fee_payments_others`
--

INSERT INTO `student_fee_payments_others` (`id`, `student_fee_payment_id`, `fee_name`, `amount`) VALUES
(393, 175, 'Admission fee', 0),
(394, 175, 'Exams fee', 0),
(395, 175, 'Fine for late fee payment', 0),
(399, 177, 'Admission fee', 0),
(400, 177, 'Exams fee', 0),
(401, 177, 'Fine for late fee payment', 0),
(417, 183, 'Admission fee', 10000),
(418, 183, 'Exams fee', 50000),
(419, 183, 'Fine for late fee payment', 0),
(420, 184, 'Admission fee', 0),
(421, 184, 'Exams fee', 0),
(422, 184, 'Fine for late fee payment', 0),
(429, 187, 'Admission fee', 0),
(430, 187, 'Exams fee', 0),
(431, 187, 'Fine for late fee payment', 0),
(432, 188, 'Admission fee', 0),
(433, 188, 'Exams fee', 0),
(434, 188, 'Fine for late fee payment', 0),
(435, 189, 'Admission fee', 0),
(436, 189, 'Exams fee', 0),
(437, 189, 'Fine for late fee payment', 0),
(438, 190, 'Admission fee', 0),
(439, 190, 'Exams fee', 0),
(440, 190, 'Fine for late fee payment', 0),
(441, 191, 'Admission fee', 0),
(442, 191, 'Exams fee', 0),
(443, 191, 'Fine for late fee payment', 0),
(450, 194, 'Admission fee', 5000),
(451, 194, 'Exams fee', 0),
(452, 194, 'Fine for late fee payment', 0),
(453, 195, 'Admission fee', 0),
(454, 195, 'Exams fee', 0),
(455, 195, 'Fine for late fee payment', 0),
(456, 196, 'Admission fee', 0),
(457, 196, 'Exams fee', 0),
(458, 196, 'Fine for late fee payment', 0),
(462, 198, 'Admission fee', 0),
(463, 198, 'Exams fee', 0),
(464, 198, 'Fine for late fee payment', 0),
(465, 199, 'Admission fee', 0),
(466, 199, 'Exams fee', 0),
(467, 199, 'Fine for late fee payment', 0),
(477, 203, 'Admission fee', 0),
(478, 203, 'Exams fee', 0),
(479, 203, 'Fine for late fee payment', 0),
(495, 209, 'Admission fee', 0),
(496, 209, 'Exams fee', 0),
(497, 209, 'Fine for late fee payment', 0),
(498, 210, 'Admission fee', 0),
(499, 210, 'Exams fee', 0),
(500, 210, 'Fine for late fee payment', 0),
(501, 211, 'Admission fee', 0),
(502, 211, 'Exams fee', 0),
(503, 211, 'Fine for late fee payment', 0),
(504, 212, 'Admission fee', 0),
(505, 212, 'Exams fee', 0),
(506, 212, 'Fine for late fee payment', 0),
(507, 213, 'Admission fee', 0),
(508, 213, 'Exams fee', 0),
(509, 213, 'Fine for late fee payment', 0);

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
(1, 'Admission fee', 0),
(2, 'Exams fee', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_fee_voucher`
--

CREATE TABLE `student_fee_voucher` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `total_fee` decimal(10,2) NOT NULL,
  `month_names` text DEFAULT NULL,
  `arrears` int(35) NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 for paid. 0 for unpaid.',
  `created_at` datetime DEFAULT NULL,
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_fee_voucher`
--

INSERT INTO `student_fee_voucher` (`id`, `student_id`, `total_fee`, `month_names`, `arrears`, `paid`, `created_at`, `due_date`) VALUES
(392, 174, '2000.00', 'null', 2000, 0, '2018-08-02 10:56:00', '2018-08-05'),
(393, 174, '2000.00', 'null', 2000, 1, '2018-08-02 10:57:23', '2018-08-05'),
(394, 174, '2000.00', 'null', 2000, 0, '2018-08-02 10:58:39', '2018-08-05'),
(395, 177, '2000.00', 'null', 2000, 1, '2018-08-02 15:47:43', '2018-08-05'),
(396, 177, '1000.00', 'null', 0, 0, '2018-08-02 15:52:42', '2018-08-05'),
(397, 177, '1000.00', 'null', 0, 1, '2018-08-02 15:53:15', '2018-08-05'),
(398, 177, '1000.00', 'null', 0, 0, '2018-08-03 12:45:31', '2018-08-05'),
(399, 179, '1550.00', 'null', 0, 1, '2018-08-03 14:37:23', '2018-08-05');

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
(381, 392, 'Due Fee', '2000.00'),
(382, 393, 'Due Fee', '2000.00'),
(383, 394, 'Due Fee', '2000.00'),
(384, 395, 'Due Fee', '2000.00'),
(385, 396, 'Due Fee', '1000.00'),
(386, 397, 'Due Fee', '1000.00'),
(387, 398, 'Due Fee', '1000.00'),
(388, 399, 'Admission fee', '1550.00');

-- --------------------------------------------------------

--
-- Table structure for table `student_logs`
--

CREATE TABLE `student_logs` (
  `id` int(11) NOT NULL,
  `student_session_id` int(11) NOT NULL,
  `new_admission` tinyint(1) NOT NULL DEFAULT 0,
  `promote` tinyint(1) NOT NULL DEFAULT 0,
  `demote` tinyint(1) NOT NULL DEFAULT 0,
  `free` tinyint(1) NOT NULL DEFAULT 0,
  `without_fee` tinyint(1) NOT NULL DEFAULT 0,
  `struck_off` tinyint(1) NOT NULL DEFAULT 0,
  `created_on` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_logs`
--

INSERT INTO `student_logs` (`id`, `student_session_id`, `new_admission`, `promote`, `demote`, `free`, `without_fee`, `struck_off`, `created_on`) VALUES
(45, 175, 1, 0, 0, 1, 0, 0, '2018-08-02'),
(46, 176, 1, 0, 0, 0, 0, 0, '2018-08-02'),
(47, 177, 1, 0, 0, 1, 0, 0, '2018-08-02'),
(48, 178, 1, 0, 0, 0, 0, 0, '2018-08-02'),
(49, 179, 1, 0, 0, 0, 0, 0, '2018-08-02'),
(50, 180, 1, 0, 0, 0, 0, 0, '2018-08-03'),
(51, 181, 1, 0, 0, 1, 0, 0, '2018-08-03'),
(52, 182, 1, 0, 0, 1, 0, 0, '2018-08-03'),
(53, 183, 1, 0, 0, 1, 0, 0, '2018-08-03'),
(54, 184, 1, 0, 0, 0, 0, 0, '2018-08-03'),
(55, 185, 1, 0, 0, 0, 0, 0, '2018-08-04'),
(56, 186, 1, 0, 0, 0, 0, 0, '2018-08-06');

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
  `transport_fees` float(10,2) NOT NULL DEFAULT 0.00,
  `fees_discount` float(10,2) NOT NULL DEFAULT 0.00,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_session`
--

INSERT INTO `student_session` (`id`, `session_id`, `student_id`, `class_id`, `section_id`, `route_id`, `vehroute_id`, `transport_fees`, `fees_discount`, `is_active`, `created_at`, `updated_at`) VALUES
(178, 13, 177, 16, 5, 0, 0, 0.00, 0.00, 'no', '2018-08-02 10:46:12', '0000-00-00 00:00:00'),
(179, 13, 178, 16, 6, 0, 0, 0.00, 0.00, 'no', '2018-08-02 16:30:40', '0000-00-00 00:00:00'),
(180, 13, 179, 17, 5, 0, 0, 0.00, 0.00, 'no', '2018-08-03 07:57:01', '0000-00-00 00:00:00'),
(181, 13, 0, 17, 6, 0, 0, 0.00, 0.00, 'no', '2018-08-03 08:02:46', '0000-00-00 00:00:00'),
(182, 13, 180, 16, 6, 0, 0, 0.00, 0.00, 'no', '2018-08-03 08:03:29', '0000-00-00 00:00:00'),
(183, 13, 181, 17, 6, 0, 0, 0.00, 0.00, 'no', '2018-08-03 08:06:34', '0000-00-00 00:00:00'),
(184, 13, 182, 17, 6, 0, 0, 0.00, 0.00, 'no', '2018-08-03 09:09:55', '0000-00-00 00:00:00'),
(185, 13, 183, 16, 6, 0, 0, 0.00, 0.00, 'no', '2018-08-04 12:11:09', '0000-00-00 00:00:00'),
(186, 13, 184, 17, 6, 0, 0, 0.00, 0.00, 'no', '2018-08-06 18:21:25', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_sibling`
--

CREATE TABLE `student_sibling` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `sibling_student_id` int(11) DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `amount_fine` float(10,2) NOT NULL DEFAULT 0.00,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT '0000-00-00',
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `payment_mode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `designation` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `joining_date` date DEFAULT NULL,
  `qualification` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qualification_details` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_type_id` int(10) UNSIGNED NOT NULL,
  `teacher_salary` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `due_salary` int(11) NOT NULL DEFAULT 0 COMMENT 'How much salary is due in account. It can be negative value.',
  `salary_update_date` date NOT NULL DEFAULT '0000-00-00',
  `fingerprint_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `email`, `password`, `address`, `dob`, `designation`, `sex`, `phone`, `image`, `is_active`, `joining_date`, `qualification`, `qualification_details`, `teacher_type_id`, `teacher_salary`, `due_salary`, `salary_update_date`, `fingerprint_file`, `created_at`, `updated_at`) VALUES
(6, 'imran gee', NULL, NULL, NULL, '1970-01-01', NULL, 'Male', NULL, 'uploads/student_images/no_image.png', 'no', '0000-00-00', NULL, NULL, 1, 10000, 40000, '2018-08-01', 'uploads/fingerprint/emp_6.fpt', '2018-07-31 19:00:08', '0000-00-00 00:00:00'),
(7, 'Amna', 'amna@gmail.com', NULL, 'fsd', '2018-03-27', NULL, 'Female', '12398', 'uploads/student_images/no_image.png', 'no', '2018-04-12', '', '', 1, 13000, 52000, '2018-08-01', 'uploads/fingerprint/emp_7.fpt', '2018-07-31 19:00:08', '0000-00-00 00:00:00'),
(8, 'ismail', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_8.fpt', '2018-07-31 19:00:08', '0000-00-00 00:00:00'),
(9, 'saleem', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_9.fpt', '2018-07-31 19:00:08', '0000-00-00 00:00:00'),
(10, 'Javed', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_10.fpt', '2018-07-31 19:00:08', '0000-00-00 00:00:00'),
(11, 'Khurram', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_11.fpt', '2018-07-31 19:00:08', '0000-00-00 00:00:00'),
(12, 'Imtiaz', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_12.fpt', '2018-07-31 19:00:08', '0000-00-00 00:00:00'),
(13, 'Rehana', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_13.fpt', '2018-07-31 19:00:08', '0000-00-00 00:00:00'),
(14, 'Mudasser', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_14.fpt', '2018-07-31 19:00:08', '0000-00-00 00:00:00'),
(15, 'Ali', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, -2200, '2018-08-01', 'uploads/fingerprint/emp_15.fpt', '2018-07-31 19:00:08', '0000-00-00 00:00:00'),
(16, 'Misbah', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_16.fpt', '2018-07-31 19:00:08', '0000-00-00 00:00:00'),
(17, 'Shehzad', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_17.fpt', '2018-07-31 19:00:08', '0000-00-00 00:00:00'),
(18, 'Jabran', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_18.fpt', '2018-07-31 19:00:08', '0000-00-00 00:00:00'),
(19, 'Aslam', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_19.fpt', '2018-07-31 19:00:08', '0000-00-00 00:00:00'),
(20, 'Kashif', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_20.fpt', '2018-07-31 19:00:08', '0000-00-00 00:00:00'),
(21, 'Suleman rana', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_21.fpt', '2018-07-31 19:00:08', '0000-00-00 00:00:00'),
(22, 'JAVAID ALI', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_22.fpt', '2018-07-31 19:00:08', '0000-00-00 00:00:00'),
(23, 'CH BASHEER', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_23.fpt', '2018-07-31 19:00:09', '0000-00-00 00:00:00'),
(24, 'kamran afzal', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_24.fpt', '2018-07-31 19:00:09', '0000-00-00 00:00:00'),
(25, 'attauallah', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_25.fpt', '2018-07-31 19:00:09', '0000-00-00 00:00:00'),
(26, 'saleem razaa', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_26.fpt', '2018-07-31 19:00:09', '0000-00-00 00:00:00'),
(27, 'kashif imran', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-13', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_27.fpt', '2018-07-31 19:00:09', '0000-00-00 00:00:00'),
(28, 'sipra', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-24', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_28.fpt', '2018-07-31 19:00:09', '0000-00-00 00:00:00'),
(29, 'saleemi', '', NULL, '', '1970-01-01', NULL, 'Male', '', 'uploads/student_images/no_image.png', 'no', '2018-04-24', '', '', 1, 0, 0, '2018-08-01', 'uploads/fingerprint/emp_29.fpt', '2018-07-31 19:00:09', '0000-00-00 00:00:00');

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
  `attendance_lecture_based` tinyint(1) NOT NULL DEFAULT 0,
  `attended_lectures` int(11) NOT NULL DEFAULT 0,
  `total_lectures` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_attendance`
--

INSERT INTO `teacher_attendance` (`teacher_attendance_id`, `teacher_id`, `teacher_attendence_type_id`, `attendance_date`, `attendance_time`, `attendance_lecture_based`, `attended_lectures`, `total_lectures`) VALUES
(1, 1, 2, '2018-04-08', '20:55:05', 0, 0, 0),
(2, 1, 1, '2018-04-09', '08:40:21', 0, 0, 0),
(3, 1, 2, '2018-04-10', '14:51:35', 0, 0, 0),
(4, 2, 2, '2018-04-10', '18:28:10', 0, 0, 0),
(5, 3, 2, '2018-04-10', '18:30:10', 0, 0, 0),
(6, 5, 1, '2018-04-10', '21:13:23', 0, 0, 0),
(7, 4, 1, '2018-04-10', '21:13:39', 0, 0, 0),
(8, 6, 2, '2018-04-12', '14:19:04', 0, 0, 0),
(9, 7, 1, '2018-04-12', '20:53:32', 0, 0, 0),
(10, 7, 1, '2018-04-13', '09:23:54', 0, 0, 0),
(11, 8, 1, '2018-04-13', '12:32:07', 0, 0, 0),
(12, 9, 1, '2018-04-13', '12:32:19', 0, 0, 0),
(13, 10, 1, '2018-04-13', '12:32:30', 0, 0, 0),
(14, 11, 1, '2018-04-13', '12:32:39', 0, 0, 0),
(15, 12, 1, '2018-04-13', '14:18:07', 0, 0, 0),
(16, 6, 2, '2018-04-13', '22:00:03', 0, 0, 0),
(17, 13, 2, '2018-04-13', '22:00:03', 0, 0, 0),
(18, 14, 2, '2018-04-13', '22:00:03', 0, 0, 0),
(19, 15, 2, '2018-04-13', '22:00:03', 0, 0, 0),
(20, 16, 2, '2018-04-13', '22:00:03', 0, 0, 0),
(21, 17, 2, '2018-04-13', '22:00:03', 0, 0, 0),
(22, 18, 2, '2018-04-13', '22:00:03', 0, 0, 0),
(23, 19, 2, '2018-04-13', '22:00:03', 0, 0, 0),
(24, 20, 2, '2018-04-13', '22:00:03', 0, 0, 0),
(25, 21, 2, '2018-04-13', '22:00:03', 0, 0, 0),
(26, 22, 2, '2018-04-13', '22:00:03', 0, 0, 0),
(27, 23, 2, '2018-04-13', '22:00:03', 0, 0, 0),
(28, 24, 2, '2018-04-13', '22:00:03', 0, 0, 0),
(29, 25, 2, '2018-04-13', '22:00:03', 0, 0, 0),
(30, 26, 2, '2018-04-13', '22:00:03', 0, 0, 0),
(31, 27, 2, '2018-04-13', '22:00:03', 0, 0, 0),
(32, 6, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(33, 7, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(34, 8, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(35, 9, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(36, 10, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(37, 11, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(38, 12, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(39, 13, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(40, 14, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(41, 15, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(42, 16, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(43, 17, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(44, 18, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(45, 19, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(46, 20, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(47, 21, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(48, 22, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(49, 23, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(50, 24, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(51, 25, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(52, 26, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(53, 27, 2, '2018-04-14', '22:00:02', 0, 0, 0),
(54, 7, 1, '2018-04-15', '11:33:48', 0, 0, 0),
(55, 6, 1, '2018-04-15', '11:33:56', 0, 0, 0),
(56, 13, 1, '2018-04-15', '11:34:23', 0, 0, 0),
(57, 14, 1, '2018-04-15', '11:34:40', 0, 0, 0),
(58, 17, 1, '2018-04-15', '11:35:25', 0, 0, 0),
(59, 18, 1, '2018-04-15', '11:35:36', 0, 0, 0),
(60, 15, 1, '2018-04-15', '11:35:47', 0, 0, 0),
(61, 16, 1, '2018-04-15', '11:35:54', 0, 0, 0),
(62, 8, 1, '2018-04-24', '10:24:27', 0, 0, 0),
(63, 9, 1, '2018-04-24', '10:25:11', 0, 0, 0),
(64, 10, 1, '2018-04-24', '10:27:19', 0, 0, 0),
(65, 11, 1, '2018-04-24', '10:27:28', 0, 0, 0),
(66, 28, 1, '2018-04-24', '11:00:23', 0, 0, 0),
(67, 27, 1, '2018-04-24', '11:02:48', 0, 0, 0),
(68, 8, 1, '2018-04-25', '10:03:33', 0, 0, 0),
(69, 9, 1, '2018-04-25', '10:03:44', 0, 0, 0),
(70, 10, 1, '2018-04-25', '10:04:55', 0, 0, 0),
(71, 11, 1, '2018-04-25', '10:05:04', 0, 0, 0),
(72, 27, 1, '2018-04-25', '10:05:18', 0, 0, 0),
(73, 28, 1, '2018-04-25', '10:05:27', 0, 0, 0),
(74, 8, 1, '2018-04-26', '22:13:27', 0, 0, 0),
(75, 10, 1, '2018-04-26', '22:15:06', 0, 0, 0),
(76, 26, 1, '2018-04-26', '22:16:51', 0, 0, 0),
(77, 9, 1, '2018-04-26', '22:35:16', 0, 0, 0),
(78, 25, 1, '2018-04-26', '22:35:42', 0, 0, 0),
(79, 28, 1, '2018-04-26', '22:35:49', 0, 0, 0),
(80, 27, 1, '2018-04-26', '22:35:56', 0, 0, 0),
(81, 6, 2, '2018-04-26', '23:58:15', 0, 0, 0),
(82, 7, 2, '2018-04-26', '23:58:15', 0, 0, 0),
(83, 11, 2, '2018-04-26', '23:58:15', 0, 0, 0),
(84, 12, 2, '2018-04-26', '23:58:15', 0, 0, 0),
(85, 13, 2, '2018-04-26', '23:58:15', 0, 0, 0),
(86, 14, 2, '2018-04-26', '23:58:15', 0, 0, 0),
(87, 15, 2, '2018-04-26', '23:58:15', 0, 0, 0),
(88, 16, 2, '2018-04-26', '23:58:15', 0, 0, 0),
(89, 17, 2, '2018-04-26', '23:58:15', 0, 0, 0),
(90, 18, 2, '2018-04-26', '23:58:15', 0, 0, 0),
(91, 19, 2, '2018-04-26', '23:58:15', 0, 0, 0),
(92, 20, 2, '2018-04-26', '23:58:15', 0, 0, 0),
(93, 21, 2, '2018-04-26', '23:58:15', 0, 0, 0),
(94, 22, 2, '2018-04-26', '23:58:15', 0, 0, 0),
(95, 23, 2, '2018-04-26', '23:58:15', 0, 0, 0),
(96, 24, 2, '2018-04-26', '23:58:15', 0, 0, 0),
(97, 29, 2, '2018-04-26', '23:58:15', 0, 0, 0),
(98, 10, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(99, 8, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(100, 9, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(101, 26, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(102, 28, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(103, 27, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(104, 11, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(105, 15, 2, '2018-04-27', '00:15:09', 0, 0, 0),
(106, 7, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(107, 19, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(108, 25, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(109, 23, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(110, 6, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(111, 12, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(112, 18, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(113, 22, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(114, 24, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(115, 20, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(116, 16, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(117, 14, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(118, 13, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(119, 29, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(120, 17, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(121, 21, 1, '2018-04-27', '00:15:09', 0, 0, 0),
(122, 6, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(123, 7, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(124, 8, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(125, 9, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(126, 10, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(127, 11, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(128, 12, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(129, 13, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(130, 14, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(131, 15, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(132, 16, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(133, 17, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(134, 18, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(135, 19, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(136, 20, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(137, 21, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(138, 22, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(139, 23, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(140, 24, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(141, 25, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(142, 26, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(143, 27, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(144, 28, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(145, 29, 2, '2018-04-28', '01:00:04', 0, 0, 0),
(146, 6, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(147, 7, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(148, 8, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(149, 9, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(150, 10, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(151, 11, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(152, 12, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(153, 13, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(154, 14, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(155, 15, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(156, 16, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(157, 17, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(158, 18, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(159, 19, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(160, 20, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(161, 21, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(162, 22, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(163, 23, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(164, 24, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(165, 25, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(166, 26, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(167, 27, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(168, 28, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(169, 29, 2, '2018-04-29', '01:00:02', 0, 0, 0),
(170, 6, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(171, 7, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(172, 8, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(173, 9, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(174, 10, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(175, 11, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(176, 12, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(177, 13, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(178, 14, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(179, 15, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(180, 16, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(181, 17, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(182, 18, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(183, 19, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(184, 20, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(185, 21, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(186, 22, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(187, 23, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(188, 24, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(189, 25, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(190, 26, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(191, 27, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(192, 28, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(193, 29, 2, '2018-04-30', '01:00:04', 0, 0, 0),
(194, 6, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(195, 7, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(196, 8, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(197, 9, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(198, 10, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(199, 11, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(200, 12, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(201, 13, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(202, 14, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(203, 15, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(204, 16, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(205, 17, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(206, 18, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(207, 19, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(208, 20, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(209, 21, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(210, 22, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(211, 23, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(212, 24, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(213, 25, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(214, 26, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(215, 27, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(216, 28, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(217, 29, 2, '2018-05-01', '01:00:04', 0, 0, 0),
(218, 6, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(219, 7, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(220, 8, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(221, 9, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(222, 10, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(223, 11, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(224, 12, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(225, 13, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(226, 14, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(227, 15, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(228, 16, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(229, 17, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(230, 18, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(231, 19, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(232, 20, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(233, 21, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(234, 22, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(235, 23, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(236, 24, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(237, 25, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(238, 26, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(239, 27, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(240, 28, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(241, 29, 2, '2018-05-02', '01:00:05', 0, 0, 0),
(242, 6, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(243, 7, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(244, 8, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(245, 9, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(246, 10, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(247, 11, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(248, 12, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(249, 13, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(250, 14, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(251, 15, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(252, 16, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(253, 17, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(254, 18, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(255, 19, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(256, 20, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(257, 21, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(258, 22, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(259, 23, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(260, 24, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(261, 25, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(262, 26, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(263, 27, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(264, 28, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(265, 29, 2, '2018-05-03', '01:00:08', 0, 0, 0),
(266, 6, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(267, 7, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(268, 8, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(269, 9, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(270, 10, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(271, 11, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(272, 12, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(273, 13, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(274, 14, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(275, 15, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(276, 16, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(277, 17, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(278, 18, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(279, 19, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(280, 20, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(281, 21, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(282, 22, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(283, 23, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(284, 24, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(285, 25, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(286, 26, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(287, 27, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(288, 28, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(289, 29, 2, '2018-05-04', '13:00:06', 0, 0, 0),
(290, 6, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(291, 7, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(292, 8, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(293, 9, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(294, 10, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(295, 11, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(296, 12, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(297, 13, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(298, 14, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(299, 15, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(300, 16, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(301, 17, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(302, 18, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(303, 19, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(304, 20, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(305, 21, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(306, 22, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(307, 23, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(308, 24, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(309, 25, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(310, 26, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(311, 27, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(312, 28, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(313, 29, 2, '2018-05-05', '13:00:05', 0, 0, 0),
(314, 6, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(315, 7, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(316, 8, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(317, 9, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(318, 10, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(319, 11, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(320, 12, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(321, 13, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(322, 14, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(323, 15, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(324, 16, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(325, 17, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(326, 18, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(327, 19, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(328, 20, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(329, 21, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(330, 22, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(331, 23, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(332, 24, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(333, 25, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(334, 26, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(335, 27, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(336, 28, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(337, 29, 2, '2018-05-06', '13:00:05', 0, 0, 0),
(338, 6, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(339, 7, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(340, 8, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(341, 9, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(342, 10, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(343, 11, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(344, 12, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(345, 13, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(346, 14, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(347, 15, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(348, 16, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(349, 17, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(350, 18, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(351, 19, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(352, 20, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(353, 21, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(354, 22, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(355, 23, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(356, 24, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(357, 25, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(358, 26, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(359, 27, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(360, 28, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(361, 29, 2, '2018-05-07', '13:00:04', 0, 0, 0),
(362, 6, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(363, 7, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(364, 8, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(365, 9, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(366, 10, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(367, 11, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(368, 12, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(369, 13, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(370, 14, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(371, 15, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(372, 16, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(373, 17, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(374, 18, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(375, 19, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(376, 20, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(377, 21, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(378, 22, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(379, 23, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(380, 24, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(381, 25, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(382, 26, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(383, 27, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(384, 28, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(385, 29, 2, '2018-05-08', '13:00:06', 0, 0, 0),
(386, 6, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(387, 7, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(388, 8, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(389, 9, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(390, 10, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(391, 11, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(392, 12, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(393, 13, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(394, 14, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(395, 15, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(396, 16, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(397, 17, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(398, 18, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(399, 19, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(400, 20, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(401, 21, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(402, 22, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(403, 23, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(404, 24, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(405, 25, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(406, 26, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(407, 27, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(408, 28, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(409, 29, 2, '2018-05-09', '13:00:04', 0, 0, 0),
(410, 6, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(411, 7, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(412, 8, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(413, 9, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(414, 10, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(415, 11, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(416, 12, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(417, 13, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(418, 14, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(419, 15, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(420, 16, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(421, 17, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(422, 18, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(423, 19, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(424, 20, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(425, 21, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(426, 22, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(427, 23, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(428, 24, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(429, 25, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(430, 26, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(431, 27, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(432, 28, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(433, 29, 2, '2018-05-10', '13:00:04', 0, 0, 0),
(434, 6, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(435, 7, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(436, 8, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(437, 9, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(438, 10, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(439, 11, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(440, 12, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(441, 13, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(442, 14, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(443, 15, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(444, 16, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(445, 17, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(446, 18, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(447, 19, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(448, 20, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(449, 21, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(450, 22, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(451, 23, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(452, 24, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(453, 25, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(454, 26, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(455, 27, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(456, 28, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(457, 29, 2, '2018-05-11', '13:00:04', 0, 0, 0),
(458, 6, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(459, 7, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(460, 8, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(461, 9, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(462, 10, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(463, 11, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(464, 12, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(465, 13, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(466, 14, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(467, 15, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(468, 16, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(469, 17, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(470, 18, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(471, 19, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(472, 20, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(473, 21, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(474, 22, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(475, 23, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(476, 24, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(477, 25, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(478, 26, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(479, 27, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(480, 28, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(481, 29, 2, '2018-05-12', '13:00:07', 0, 0, 0),
(482, 6, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(483, 7, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(484, 8, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(485, 9, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(486, 10, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(487, 11, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(488, 12, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(489, 13, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(490, 14, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(491, 15, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(492, 16, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(493, 17, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(494, 18, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(495, 19, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(496, 20, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(497, 21, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(498, 22, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(499, 23, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(500, 24, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(501, 25, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(502, 26, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(503, 27, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(504, 28, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(505, 29, 2, '2018-05-13', '13:00:04', 0, 0, 0),
(506, 6, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(507, 7, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(508, 8, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(509, 9, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(510, 10, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(511, 11, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(512, 12, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(513, 13, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(514, 14, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(515, 15, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(516, 16, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(517, 17, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(518, 18, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(519, 19, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(520, 20, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(521, 21, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(522, 22, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(523, 23, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(524, 24, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(525, 25, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(526, 26, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(527, 27, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(528, 28, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(529, 29, 2, '2018-05-14', '13:00:06', 0, 0, 0),
(530, 6, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(531, 7, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(532, 8, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(533, 9, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(534, 10, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(535, 11, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(536, 12, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(537, 13, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(538, 14, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(539, 15, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(540, 16, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(541, 17, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(542, 18, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(543, 19, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(544, 20, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(545, 21, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(546, 22, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(547, 23, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(548, 24, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(549, 25, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(550, 26, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(551, 27, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(552, 28, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(553, 29, 2, '2018-05-15', '13:00:05', 0, 0, 0),
(554, 6, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(555, 7, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(556, 8, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(557, 9, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(558, 10, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(559, 11, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(560, 12, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(561, 13, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(562, 14, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(563, 15, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(564, 16, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(565, 17, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(566, 18, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(567, 19, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(568, 20, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(569, 21, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(570, 22, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(571, 23, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(572, 24, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(573, 25, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(574, 26, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(575, 27, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(576, 28, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(577, 29, 2, '2018-05-16', '13:00:05', 0, 0, 0),
(578, 6, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(579, 7, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(580, 8, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(581, 9, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(582, 10, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(583, 11, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(584, 12, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(585, 13, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(586, 14, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(587, 15, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(588, 16, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(589, 17, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(590, 18, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(591, 19, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(592, 20, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(593, 21, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(594, 22, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(595, 23, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(596, 24, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(597, 25, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(598, 26, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(599, 27, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(600, 28, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(601, 29, 2, '2018-05-17', '13:00:07', 0, 0, 0),
(602, 6, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(603, 7, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(604, 8, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(605, 9, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(606, 10, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(607, 11, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(608, 12, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(609, 13, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(610, 14, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(611, 15, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(612, 16, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(613, 17, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(614, 18, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(615, 19, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(616, 20, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(617, 21, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(618, 22, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(619, 23, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(620, 24, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(621, 25, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(622, 26, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(623, 27, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(624, 28, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(625, 29, 2, '2018-05-18', '13:00:09', 0, 0, 0),
(626, 6, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(627, 7, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(628, 8, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(629, 9, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(630, 10, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(631, 11, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(632, 12, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(633, 13, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(634, 14, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(635, 15, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(636, 16, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(637, 17, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(638, 18, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(639, 19, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(640, 20, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(641, 21, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(642, 22, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(643, 23, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(644, 24, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(645, 25, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(646, 26, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(647, 27, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(648, 28, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(649, 29, 2, '2018-05-19', '13:00:07', 0, 0, 0),
(650, 6, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(651, 7, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(652, 8, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(653, 9, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(654, 10, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(655, 11, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(656, 12, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(657, 13, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(658, 14, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(659, 15, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(660, 16, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(661, 17, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(662, 18, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(663, 19, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(664, 20, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(665, 21, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(666, 22, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(667, 23, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(668, 24, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(669, 25, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(670, 26, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(671, 27, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(672, 28, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(673, 29, 2, '2018-05-20', '13:00:05', 0, 0, 0),
(674, 6, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(675, 7, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(676, 8, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(677, 9, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(678, 10, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(679, 11, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(680, 12, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(681, 13, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(682, 14, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(683, 15, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(684, 16, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(685, 17, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(686, 18, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(687, 19, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(688, 20, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(689, 21, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(690, 22, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(691, 23, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(692, 24, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(693, 25, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(694, 26, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(695, 27, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(696, 28, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(697, 29, 2, '2018-05-21', '13:00:11', 0, 0, 0),
(698, 6, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(699, 7, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(700, 8, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(701, 9, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(702, 10, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(703, 11, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(704, 12, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(705, 13, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(706, 14, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(707, 15, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(708, 16, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(709, 17, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(710, 18, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(711, 19, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(712, 20, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(713, 21, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(714, 22, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(715, 23, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(716, 24, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(717, 25, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(718, 26, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(719, 27, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(720, 28, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(721, 29, 2, '2018-05-22', '13:00:15', 0, 0, 0),
(722, 6, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(723, 7, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(724, 8, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(725, 9, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(726, 10, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(727, 11, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(728, 12, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(729, 13, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(730, 14, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(731, 15, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(732, 16, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(733, 17, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(734, 18, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(735, 19, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(736, 20, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(737, 21, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(738, 22, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(739, 23, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(740, 24, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(741, 25, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(742, 26, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(743, 27, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(744, 28, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(745, 29, 2, '2018-05-23', '13:00:05', 0, 0, 0),
(746, 6, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(747, 7, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(748, 8, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(749, 9, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(750, 10, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(751, 11, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(752, 12, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(753, 13, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(754, 14, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(755, 15, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(756, 16, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(757, 17, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(758, 18, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(759, 19, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(760, 20, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(761, 21, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(762, 22, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(763, 23, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(764, 24, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(765, 25, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(766, 26, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(767, 27, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(768, 28, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(769, 29, 2, '2018-05-24', '13:00:08', 0, 0, 0),
(770, 6, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(771, 7, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(772, 8, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(773, 9, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(774, 10, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(775, 11, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(776, 12, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(777, 13, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(778, 14, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(779, 15, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(780, 16, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(781, 17, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(782, 18, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(783, 19, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(784, 20, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(785, 21, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(786, 22, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(787, 23, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(788, 24, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(789, 25, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(790, 26, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(791, 27, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(792, 28, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(793, 29, 2, '2018-05-25', '13:00:05', 0, 0, 0),
(794, 6, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(795, 7, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(796, 8, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(797, 9, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(798, 10, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(799, 11, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(800, 12, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(801, 13, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(802, 14, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(803, 15, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(804, 16, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(805, 17, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(806, 18, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(807, 19, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(808, 20, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(809, 21, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(810, 22, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(811, 23, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(812, 24, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(813, 25, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(814, 26, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(815, 27, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(816, 28, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(817, 29, 2, '2018-05-26', '13:00:05', 0, 0, 0),
(818, 6, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(819, 7, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(820, 8, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(821, 9, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(822, 10, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(823, 11, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(824, 12, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(825, 13, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(826, 14, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(827, 15, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(828, 16, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(829, 17, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(830, 18, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(831, 19, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(832, 20, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(833, 21, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(834, 22, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(835, 23, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(836, 24, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(837, 25, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(838, 26, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(839, 27, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(840, 28, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(841, 29, 2, '2018-05-27', '13:00:05', 0, 0, 0),
(842, 6, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(843, 7, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(844, 8, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(845, 9, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(846, 10, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(847, 11, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(848, 12, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(849, 13, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(850, 14, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(851, 15, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(852, 16, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(853, 17, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(854, 18, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(855, 19, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(856, 20, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(857, 21, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(858, 22, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(859, 23, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(860, 24, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(861, 25, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(862, 26, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(863, 27, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(864, 28, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(865, 29, 2, '2018-05-28', '13:00:06', 0, 0, 0),
(866, 6, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(867, 7, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(868, 8, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(869, 9, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(870, 10, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(871, 11, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(872, 12, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(873, 13, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(874, 14, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(875, 15, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(876, 16, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(877, 17, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(878, 18, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(879, 19, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(880, 20, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(881, 21, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(882, 22, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(883, 23, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(884, 24, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(885, 25, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(886, 26, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(887, 27, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(888, 28, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(889, 29, 2, '2018-05-29', '13:00:05', 0, 0, 0),
(890, 6, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(891, 7, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(892, 8, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(893, 9, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(894, 10, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(895, 11, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(896, 12, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(897, 13, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(898, 14, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(899, 15, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(900, 16, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(901, 17, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(902, 18, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(903, 19, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(904, 20, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(905, 21, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(906, 22, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(907, 23, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(908, 24, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(909, 25, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(910, 26, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(911, 27, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(912, 28, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(913, 29, 2, '2018-05-30', '13:00:05', 0, 0, 0),
(914, 6, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(915, 7, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(916, 8, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(917, 9, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(918, 10, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(919, 11, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(920, 12, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(921, 13, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(922, 14, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(923, 15, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(924, 16, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(925, 17, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(926, 18, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(927, 19, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(928, 20, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(929, 21, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(930, 22, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(931, 23, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(932, 24, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(933, 25, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(934, 26, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(935, 27, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(936, 28, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(937, 29, 2, '2018-05-31', '13:00:11', 0, 0, 0),
(938, 6, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(939, 7, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(940, 8, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(941, 9, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(942, 10, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(943, 11, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(944, 12, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(945, 13, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(946, 14, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(947, 15, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(948, 16, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(949, 17, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(950, 18, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(951, 19, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(952, 20, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(953, 21, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(954, 22, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(955, 23, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(956, 24, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(957, 25, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(958, 26, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(959, 27, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(960, 28, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(961, 29, 2, '2018-06-01', '13:00:06', 0, 0, 0),
(962, 6, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(963, 7, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(964, 8, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(965, 9, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(966, 10, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(967, 11, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(968, 12, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(969, 13, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(970, 14, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(971, 15, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(972, 16, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(973, 17, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(974, 18, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(975, 19, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(976, 20, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(977, 21, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(978, 22, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(979, 23, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(980, 24, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(981, 25, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(982, 26, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(983, 27, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(984, 28, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(985, 29, 2, '2018-06-02', '13:00:13', 0, 0, 0),
(986, 6, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(987, 7, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(988, 8, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(989, 9, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(990, 10, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(991, 11, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(992, 12, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(993, 13, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(994, 14, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(995, 15, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(996, 16, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(997, 17, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(998, 18, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(999, 19, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(1000, 20, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(1001, 21, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(1002, 22, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(1003, 23, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(1004, 24, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(1005, 25, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(1006, 26, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(1007, 27, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(1008, 28, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(1009, 29, 2, '2018-06-03', '13:00:07', 0, 0, 0),
(1010, 6, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1011, 7, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1012, 8, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1013, 9, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1014, 10, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1015, 11, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1016, 12, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1017, 13, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1018, 14, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1019, 15, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1020, 16, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1021, 17, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1022, 18, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1023, 19, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1024, 20, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1025, 21, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1026, 22, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1027, 23, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1028, 24, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1029, 25, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1030, 26, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1031, 27, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1032, 28, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1033, 29, 2, '2018-06-04', '13:00:04', 0, 0, 0),
(1034, 6, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1035, 7, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1036, 8, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1037, 9, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1038, 10, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1039, 11, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1040, 12, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1041, 13, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1042, 14, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1043, 15, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1044, 16, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1045, 17, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1046, 18, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1047, 19, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1048, 20, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1049, 21, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1050, 22, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1051, 23, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1052, 24, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1053, 25, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1054, 26, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1055, 27, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1056, 28, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1057, 29, 2, '2018-06-05', '13:00:10', 0, 0, 0),
(1058, 6, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1059, 7, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1060, 8, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1061, 9, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1062, 10, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1063, 11, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1064, 12, 2, '2018-06-06', '13:00:08', 0, 0, 0);
INSERT INTO `teacher_attendance` (`teacher_attendance_id`, `teacher_id`, `teacher_attendence_type_id`, `attendance_date`, `attendance_time`, `attendance_lecture_based`, `attended_lectures`, `total_lectures`) VALUES
(1065, 13, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1066, 14, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1067, 15, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1068, 16, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1069, 17, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1070, 18, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1071, 19, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1072, 20, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1073, 21, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1074, 22, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1075, 23, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1076, 24, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1077, 25, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1078, 26, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1079, 27, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1080, 28, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1081, 29, 2, '2018-06-06', '13:00:08', 0, 0, 0),
(1082, 6, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1083, 7, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1084, 8, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1085, 9, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1086, 10, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1087, 11, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1088, 12, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1089, 13, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1090, 14, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1091, 15, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1092, 16, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1093, 17, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1094, 18, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1095, 19, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1096, 20, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1097, 21, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1098, 22, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1099, 23, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1100, 24, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1101, 25, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1102, 26, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1103, 27, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1104, 28, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1105, 29, 2, '2018-06-07', '13:00:31', 0, 0, 0),
(1106, 6, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1107, 7, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1108, 8, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1109, 9, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1110, 10, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1111, 11, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1112, 12, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1113, 13, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1114, 14, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1115, 15, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1116, 16, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1117, 17, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1118, 18, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1119, 19, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1120, 20, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1121, 21, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1122, 22, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1123, 23, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1124, 24, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1125, 25, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1126, 26, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1127, 27, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1128, 28, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1129, 29, 2, '2018-06-08', '13:00:06', 0, 0, 0),
(1130, 6, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1131, 7, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1132, 8, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1133, 9, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1134, 10, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1135, 11, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1136, 12, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1137, 13, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1138, 14, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1139, 15, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1140, 16, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1141, 17, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1142, 18, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1143, 19, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1144, 20, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1145, 21, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1146, 22, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1147, 23, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1148, 24, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1149, 25, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1150, 26, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1151, 27, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1152, 28, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1153, 29, 2, '2018-06-09', '13:00:09', 0, 0, 0),
(1154, 6, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1155, 7, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1156, 8, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1157, 9, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1158, 10, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1159, 11, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1160, 12, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1161, 13, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1162, 14, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1163, 15, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1164, 16, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1165, 17, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1166, 18, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1167, 19, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1168, 20, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1169, 21, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1170, 22, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1171, 23, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1172, 24, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1173, 25, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1174, 26, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1175, 27, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1176, 28, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1177, 29, 2, '2018-06-10', '13:00:06', 0, 0, 0),
(1178, 6, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1179, 7, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1180, 8, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1181, 9, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1182, 10, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1183, 11, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1184, 12, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1185, 13, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1186, 14, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1187, 15, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1188, 16, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1189, 17, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1190, 18, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1191, 19, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1192, 20, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1193, 21, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1194, 22, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1195, 23, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1196, 24, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1197, 25, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1198, 26, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1199, 27, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1200, 28, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1201, 29, 2, '2018-06-11', '13:00:08', 0, 0, 0),
(1202, 6, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1203, 7, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1204, 8, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1205, 9, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1206, 10, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1207, 11, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1208, 12, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1209, 13, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1210, 14, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1211, 15, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1212, 16, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1213, 17, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1214, 18, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1215, 19, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1216, 20, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1217, 21, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1218, 22, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1219, 23, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1220, 24, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1221, 25, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1222, 26, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1223, 27, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1224, 28, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1225, 29, 2, '2018-06-12', '13:00:08', 0, 0, 0),
(1226, 6, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1227, 7, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1228, 8, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1229, 9, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1230, 10, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1231, 11, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1232, 12, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1233, 13, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1234, 14, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1235, 15, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1236, 16, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1237, 17, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1238, 18, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1239, 19, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1240, 20, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1241, 21, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1242, 22, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1243, 23, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1244, 24, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1245, 25, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1246, 26, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1247, 27, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1248, 28, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1249, 29, 2, '2018-06-13', '13:00:07', 0, 0, 0),
(1250, 6, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1251, 7, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1252, 8, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1253, 9, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1254, 10, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1255, 11, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1256, 12, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1257, 13, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1258, 14, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1259, 15, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1260, 16, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1261, 17, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1262, 18, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1263, 19, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1264, 20, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1265, 21, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1266, 22, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1267, 23, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1268, 24, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1269, 25, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1270, 26, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1271, 27, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1272, 28, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1273, 29, 2, '2018-06-14', '13:00:11', 0, 0, 0),
(1274, 6, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1275, 7, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1276, 8, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1277, 9, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1278, 10, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1279, 11, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1280, 12, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1281, 13, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1282, 14, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1283, 15, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1284, 16, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1285, 17, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1286, 18, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1287, 19, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1288, 20, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1289, 21, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1290, 22, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1291, 23, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1292, 24, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1293, 25, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1294, 26, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1295, 27, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1296, 28, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1297, 29, 2, '2018-06-15', '13:00:05', 0, 0, 0),
(1298, 6, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1299, 7, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1300, 8, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1301, 9, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1302, 10, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1303, 11, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1304, 12, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1305, 13, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1306, 14, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1307, 15, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1308, 16, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1309, 17, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1310, 18, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1311, 19, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1312, 20, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1313, 21, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1314, 22, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1315, 23, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1316, 24, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1317, 25, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1318, 26, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1319, 27, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1320, 28, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1321, 29, 2, '2018-06-16', '13:00:06', 0, 0, 0),
(1322, 6, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1323, 7, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1324, 8, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1325, 9, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1326, 10, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1327, 11, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1328, 12, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1329, 13, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1330, 14, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1331, 15, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1332, 16, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1333, 17, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1334, 18, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1335, 19, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1336, 20, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1337, 21, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1338, 22, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1339, 23, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1340, 24, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1341, 25, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1342, 26, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1343, 27, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1344, 28, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1345, 29, 2, '2018-06-17', '13:00:06', 0, 0, 0),
(1346, 6, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1347, 7, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1348, 8, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1349, 9, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1350, 10, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1351, 11, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1352, 12, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1353, 13, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1354, 14, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1355, 15, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1356, 16, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1357, 17, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1358, 18, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1359, 19, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1360, 20, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1361, 21, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1362, 22, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1363, 23, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1364, 24, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1365, 25, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1366, 26, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1367, 27, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1368, 28, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1369, 29, 2, '2018-06-18', '13:00:06', 0, 0, 0),
(1370, 6, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1371, 7, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1372, 8, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1373, 9, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1374, 10, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1375, 11, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1376, 12, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1377, 13, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1378, 14, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1379, 15, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1380, 16, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1381, 17, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1382, 18, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1383, 19, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1384, 20, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1385, 21, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1386, 22, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1387, 23, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1388, 24, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1389, 25, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1390, 26, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1391, 27, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1392, 28, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1393, 29, 2, '2018-06-19', '13:00:07', 0, 0, 0),
(1394, 6, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1395, 7, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1396, 8, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1397, 9, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1398, 10, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1399, 11, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1400, 12, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1401, 13, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1402, 14, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1403, 15, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1404, 16, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1405, 17, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1406, 18, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1407, 19, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1408, 20, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1409, 21, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1410, 22, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1411, 23, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1412, 24, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1413, 25, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1414, 26, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1415, 27, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1416, 28, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1417, 29, 2, '2018-06-20', '13:00:19', 0, 0, 0),
(1418, 6, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1419, 7, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1420, 8, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1421, 9, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1422, 10, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1423, 11, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1424, 12, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1425, 13, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1426, 14, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1427, 15, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1428, 16, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1429, 17, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1430, 18, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1431, 19, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1432, 20, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1433, 21, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1434, 22, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1435, 23, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1436, 24, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1437, 25, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1438, 26, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1439, 27, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1440, 28, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1441, 29, 2, '2018-06-21', '13:00:07', 0, 0, 0),
(1442, 6, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1443, 7, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1444, 8, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1445, 9, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1446, 10, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1447, 11, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1448, 12, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1449, 13, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1450, 14, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1451, 15, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1452, 16, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1453, 17, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1454, 18, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1455, 19, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1456, 20, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1457, 21, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1458, 22, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1459, 23, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1460, 24, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1461, 25, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1462, 26, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1463, 27, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1464, 28, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1465, 29, 2, '2018-06-22', '13:00:07', 0, 0, 0),
(1466, 6, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1467, 7, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1468, 8, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1469, 9, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1470, 10, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1471, 11, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1472, 12, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1473, 13, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1474, 14, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1475, 15, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1476, 16, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1477, 17, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1478, 18, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1479, 19, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1480, 20, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1481, 21, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1482, 22, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1483, 23, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1484, 24, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1485, 25, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1486, 26, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1487, 27, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1488, 28, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1489, 29, 2, '2018-06-23', '13:00:14', 0, 0, 0),
(1490, 6, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1491, 7, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1492, 8, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1493, 9, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1494, 10, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1495, 11, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1496, 12, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1497, 13, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1498, 14, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1499, 15, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1500, 16, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1501, 17, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1502, 18, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1503, 19, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1504, 20, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1505, 21, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1506, 22, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1507, 23, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1508, 24, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1509, 25, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1510, 26, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1511, 27, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1512, 28, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1513, 29, 2, '2018-06-24', '13:00:09', 0, 0, 0),
(1514, 6, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1515, 7, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1516, 8, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1517, 9, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1518, 10, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1519, 11, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1520, 12, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1521, 13, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1522, 14, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1523, 15, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1524, 16, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1525, 17, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1526, 18, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1527, 19, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1528, 20, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1529, 21, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1530, 22, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1531, 23, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1532, 24, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1533, 25, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1534, 26, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1535, 27, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1536, 28, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1537, 29, 2, '2018-06-25', '13:00:06', 0, 0, 0),
(1538, 6, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1539, 7, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1540, 8, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1541, 9, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1542, 10, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1543, 11, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1544, 12, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1545, 13, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1546, 14, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1547, 15, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1548, 16, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1549, 17, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1550, 18, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1551, 19, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1552, 20, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1553, 21, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1554, 22, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1555, 23, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1556, 24, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1557, 25, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1558, 26, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1559, 27, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1560, 28, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1561, 29, 2, '2018-06-26', '13:00:19', 0, 0, 0),
(1562, 6, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1563, 7, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1564, 8, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1565, 9, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1566, 10, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1567, 11, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1568, 12, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1569, 13, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1570, 14, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1571, 15, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1572, 16, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1573, 17, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1574, 18, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1575, 19, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1576, 20, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1577, 21, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1578, 22, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1579, 23, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1580, 24, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1581, 25, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1582, 26, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1583, 27, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1584, 28, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1585, 29, 2, '2018-06-27', '13:00:06', 0, 0, 0),
(1586, 6, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1587, 7, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1588, 8, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1589, 9, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1590, 10, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1591, 11, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1592, 12, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1593, 13, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1594, 14, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1595, 15, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1596, 16, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1597, 17, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1598, 18, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1599, 19, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1600, 20, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1601, 21, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1602, 22, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1603, 23, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1604, 24, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1605, 25, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1606, 26, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1607, 27, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1608, 28, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1609, 29, 2, '2018-06-28', '13:00:04', 0, 0, 0),
(1610, 6, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1611, 7, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1612, 8, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1613, 9, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1614, 10, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1615, 11, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1616, 12, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1617, 13, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1618, 14, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1619, 15, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1620, 16, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1621, 17, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1622, 18, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1623, 19, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1624, 20, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1625, 21, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1626, 22, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1627, 23, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1628, 24, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1629, 25, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1630, 26, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1631, 27, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1632, 28, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1633, 29, 2, '2018-06-29', '13:00:11', 0, 0, 0),
(1634, 6, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1635, 7, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1636, 8, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1637, 9, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1638, 10, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1639, 11, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1640, 12, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1641, 13, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1642, 14, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1643, 15, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1644, 16, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1645, 17, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1646, 18, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1647, 19, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1648, 20, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1649, 21, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1650, 22, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1651, 23, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1652, 24, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1653, 25, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1654, 26, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1655, 27, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1656, 28, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1657, 29, 2, '2018-06-30', '13:00:05', 0, 0, 0),
(1658, 6, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1659, 7, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1660, 8, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1661, 9, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1662, 10, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1663, 11, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1664, 12, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1665, 13, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1666, 14, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1667, 15, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1668, 16, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1669, 17, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1670, 18, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1671, 19, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1672, 20, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1673, 21, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1674, 22, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1675, 23, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1676, 24, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1677, 25, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1678, 26, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1679, 27, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1680, 28, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1681, 29, 2, '2018-07-01', '14:50:06', 0, 0, 0),
(1682, 6, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1683, 7, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1684, 8, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1685, 9, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1686, 10, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1687, 11, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1688, 12, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1689, 13, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1690, 14, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1691, 15, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1692, 16, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1693, 17, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1694, 18, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1695, 19, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1696, 20, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1697, 21, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1698, 22, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1699, 23, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1700, 24, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1701, 25, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1702, 26, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1703, 27, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1704, 28, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1705, 29, 2, '2018-07-02', '13:00:06', 0, 0, 0),
(1706, 6, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1707, 7, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1708, 8, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1709, 9, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1710, 10, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1711, 11, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1712, 12, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1713, 13, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1714, 14, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1715, 15, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1716, 16, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1717, 17, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1718, 18, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1719, 19, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1720, 20, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1721, 21, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1722, 22, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1723, 23, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1724, 24, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1725, 25, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1726, 26, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1727, 27, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1728, 28, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1729, 29, 2, '2018-07-03', '13:00:07', 0, 0, 0),
(1730, 6, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1731, 7, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1732, 8, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1733, 9, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1734, 10, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1735, 11, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1736, 12, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1737, 13, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1738, 14, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1739, 15, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1740, 16, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1741, 17, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1742, 18, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1743, 19, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1744, 20, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1745, 21, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1746, 22, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1747, 23, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1748, 24, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1749, 25, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1750, 26, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1751, 27, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1752, 28, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1753, 29, 2, '2018-07-04', '13:00:07', 0, 0, 0),
(1754, 6, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1755, 7, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1756, 8, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1757, 9, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1758, 10, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1759, 11, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1760, 12, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1761, 13, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1762, 14, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1763, 15, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1764, 16, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1765, 17, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1766, 18, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1767, 19, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1768, 20, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1769, 21, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1770, 22, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1771, 23, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1772, 24, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1773, 25, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1774, 26, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1775, 27, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1776, 28, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1777, 29, 2, '2018-07-05', '13:00:07', 0, 0, 0),
(1778, 6, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1779, 7, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1780, 8, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1781, 9, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1782, 10, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1783, 11, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1784, 12, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1785, 13, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1786, 14, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1787, 15, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1788, 16, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1789, 17, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1790, 18, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1791, 19, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1792, 20, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1793, 21, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1794, 22, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1795, 23, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1796, 24, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1797, 25, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1798, 26, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1799, 27, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1800, 28, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1801, 29, 2, '2018-07-06', '13:00:07', 0, 0, 0),
(1802, 6, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1803, 7, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1804, 8, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1805, 9, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1806, 10, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1807, 11, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1808, 12, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1809, 13, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1810, 14, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1811, 15, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1812, 16, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1813, 17, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1814, 18, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1815, 19, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1816, 20, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1817, 21, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1818, 22, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1819, 23, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1820, 24, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1821, 25, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1822, 26, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1823, 27, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1824, 28, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1825, 29, 2, '2018-07-07', '13:00:06', 0, 0, 0),
(1826, 6, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1827, 7, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1828, 8, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1829, 9, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1830, 10, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1831, 11, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1832, 12, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1833, 13, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1834, 14, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1835, 15, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1836, 16, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1837, 17, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1838, 18, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1839, 19, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1840, 20, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1841, 21, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1842, 22, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1843, 23, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1844, 24, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1845, 25, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1846, 26, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1847, 27, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1848, 28, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1849, 29, 2, '2018-07-08', '13:00:07', 0, 0, 0),
(1850, 6, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1851, 7, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1852, 8, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1853, 9, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1854, 10, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1855, 11, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1856, 12, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1857, 13, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1858, 14, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1859, 15, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1860, 16, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1861, 17, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1862, 18, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1863, 19, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1864, 20, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1865, 21, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1866, 22, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1867, 23, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1868, 24, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1869, 25, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1870, 26, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1871, 27, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1872, 28, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1873, 29, 2, '2018-07-09', '13:00:08', 0, 0, 0),
(1874, 6, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1875, 7, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1876, 8, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1877, 9, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1878, 10, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1879, 11, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1880, 12, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1881, 13, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1882, 14, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1883, 15, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1884, 16, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1885, 17, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1886, 18, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1887, 19, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1888, 20, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1889, 21, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1890, 22, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1891, 23, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1892, 24, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1893, 25, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1894, 26, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1895, 27, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1896, 28, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1897, 29, 2, '2018-07-10', '13:00:07', 0, 0, 0),
(1898, 6, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1899, 7, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1900, 8, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1901, 9, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1902, 10, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1903, 11, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1904, 12, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1905, 13, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1906, 14, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1907, 15, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1908, 16, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1909, 17, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1910, 18, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1911, 19, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1912, 20, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1913, 21, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1914, 22, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1915, 23, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1916, 24, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1917, 25, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1918, 26, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1919, 27, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1920, 28, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1921, 29, 2, '2018-07-11', '13:00:08', 0, 0, 0),
(1922, 6, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1923, 7, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1924, 8, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1925, 9, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1926, 10, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1927, 11, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1928, 12, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1929, 13, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1930, 14, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1931, 15, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1932, 16, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1933, 17, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1934, 18, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1935, 19, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1936, 20, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1937, 21, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1938, 22, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1939, 23, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1940, 24, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1941, 25, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1942, 26, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1943, 27, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1944, 28, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1945, 29, 2, '2018-07-12', '13:00:09', 0, 0, 0),
(1946, 6, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1947, 7, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1948, 8, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1949, 9, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1950, 10, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1951, 11, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1952, 12, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1953, 13, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1954, 14, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1955, 15, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1956, 16, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1957, 17, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1958, 18, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1959, 19, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1960, 20, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1961, 21, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1962, 22, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1963, 23, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1964, 24, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1965, 25, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1966, 26, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1967, 27, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1968, 28, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1969, 29, 2, '2018-07-13', '13:00:08', 0, 0, 0),
(1970, 6, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1971, 7, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1972, 8, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1973, 9, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1974, 10, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1975, 11, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1976, 12, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1977, 13, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1978, 14, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1979, 15, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1980, 16, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1981, 17, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1982, 18, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1983, 19, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1984, 20, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1985, 21, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1986, 22, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1987, 23, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1988, 24, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1989, 25, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1990, 26, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1991, 27, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1992, 28, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1993, 29, 2, '2018-07-14', '13:00:08', 0, 0, 0),
(1994, 6, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(1995, 7, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(1996, 8, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(1997, 9, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(1998, 10, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(1999, 11, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2000, 12, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2001, 13, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2002, 14, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2003, 15, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2004, 16, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2005, 17, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2006, 18, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2007, 19, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2008, 20, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2009, 21, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2010, 22, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2011, 23, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2012, 24, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2013, 25, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2014, 26, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2015, 27, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2016, 28, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2017, 29, 2, '2018-07-15', '13:00:08', 0, 0, 0),
(2018, 6, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2019, 7, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2020, 8, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2021, 9, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2022, 10, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2023, 11, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2024, 12, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2025, 13, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2026, 14, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2027, 15, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2028, 16, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2029, 17, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2030, 18, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2031, 19, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2032, 20, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2033, 21, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2034, 22, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2035, 23, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2036, 24, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2037, 25, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2038, 26, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2039, 27, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2040, 28, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2041, 29, 2, '2018-07-16', '13:00:11', 0, 0, 0),
(2042, 6, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2043, 7, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2044, 8, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2045, 9, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2046, 10, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2047, 11, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2048, 12, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2049, 13, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2050, 14, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2051, 15, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2052, 16, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2053, 17, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2054, 18, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2055, 19, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2056, 20, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2057, 21, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2058, 22, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2059, 23, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2060, 24, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2061, 25, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2062, 26, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2063, 27, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2064, 28, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2065, 29, 2, '2018-07-17', '13:00:25', 0, 0, 0),
(2066, 6, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2067, 7, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2068, 8, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2069, 9, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2070, 10, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2071, 11, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2072, 12, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2073, 13, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2074, 14, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2075, 15, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2076, 16, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2077, 17, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2078, 18, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2079, 19, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2080, 20, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2081, 21, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2082, 22, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2083, 23, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2084, 24, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2085, 25, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2086, 26, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2087, 27, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2088, 28, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2089, 29, 2, '2018-07-18', '13:00:10', 0, 0, 0),
(2090, 6, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2091, 7, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2092, 8, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2093, 9, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2094, 10, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2095, 11, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2096, 12, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2097, 13, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2098, 14, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2099, 15, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2100, 16, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2101, 17, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2102, 18, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2103, 19, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2104, 20, 2, '2018-07-19', '13:00:07', 0, 0, 0);
INSERT INTO `teacher_attendance` (`teacher_attendance_id`, `teacher_id`, `teacher_attendence_type_id`, `attendance_date`, `attendance_time`, `attendance_lecture_based`, `attended_lectures`, `total_lectures`) VALUES
(2105, 21, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2106, 22, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2107, 23, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2108, 24, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2109, 25, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2110, 26, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2111, 27, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2112, 28, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2113, 29, 2, '2018-07-19', '13:00:07', 0, 0, 0),
(2114, 6, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2115, 7, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2116, 8, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2117, 9, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2118, 10, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2119, 11, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2120, 12, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2121, 13, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2122, 14, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2123, 15, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2124, 16, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2125, 17, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2126, 18, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2127, 19, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2128, 20, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2129, 21, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2130, 22, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2131, 23, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2132, 24, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2133, 25, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2134, 26, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2135, 27, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2136, 28, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2137, 29, 2, '2018-07-20', '13:00:08', 0, 0, 0),
(2138, 6, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2139, 7, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2140, 8, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2141, 9, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2142, 10, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2143, 11, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2144, 12, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2145, 13, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2146, 14, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2147, 15, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2148, 16, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2149, 17, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2150, 18, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2151, 19, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2152, 20, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2153, 21, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2154, 22, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2155, 23, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2156, 24, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2157, 25, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2158, 26, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2159, 27, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2160, 28, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2161, 29, 2, '2018-07-21', '13:00:09', 0, 0, 0),
(2162, 6, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2163, 7, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2164, 8, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2165, 9, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2166, 10, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2167, 11, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2168, 12, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2169, 13, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2170, 14, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2171, 15, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2172, 16, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2173, 17, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2174, 18, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2175, 19, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2176, 20, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2177, 21, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2178, 22, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2179, 23, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2180, 24, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2181, 25, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2182, 26, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2183, 27, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2184, 28, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2185, 29, 2, '2018-07-22', '13:00:08', 0, 0, 0),
(2186, 6, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2187, 7, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2188, 8, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2189, 9, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2190, 10, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2191, 11, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2192, 12, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2193, 13, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2194, 14, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2195, 15, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2196, 16, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2197, 17, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2198, 18, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2199, 19, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2200, 20, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2201, 21, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2202, 22, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2203, 23, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2204, 24, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2205, 25, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2206, 26, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2207, 27, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2208, 28, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2209, 29, 2, '2018-07-23', '13:00:10', 0, 0, 0),
(2210, 6, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2211, 7, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2212, 8, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2213, 9, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2214, 10, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2215, 11, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2216, 12, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2217, 13, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2218, 14, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2219, 15, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2220, 16, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2221, 17, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2222, 18, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2223, 19, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2224, 20, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2225, 21, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2226, 22, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2227, 23, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2228, 24, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2229, 25, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2230, 26, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2231, 27, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2232, 28, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2233, 29, 2, '2018-07-24', '13:00:06', 0, 0, 0),
(2234, 6, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2235, 7, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2236, 8, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2237, 9, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2238, 10, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2239, 11, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2240, 12, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2241, 13, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2242, 14, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2243, 15, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2244, 16, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2245, 17, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2246, 18, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2247, 19, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2248, 20, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2249, 21, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2250, 22, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2251, 23, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2252, 24, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2253, 25, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2254, 26, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2255, 27, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2256, 28, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2257, 29, 2, '2018-07-25', '13:00:08', 0, 0, 0),
(2258, 6, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2259, 7, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2260, 8, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2261, 9, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2262, 10, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2263, 11, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2264, 12, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2265, 13, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2266, 14, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2267, 15, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2268, 16, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2269, 17, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2270, 18, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2271, 19, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2272, 20, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2273, 21, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2274, 22, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2275, 23, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2276, 24, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2277, 25, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2278, 26, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2279, 27, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2280, 28, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2281, 29, 2, '2018-07-26', '13:00:08', 0, 0, 0),
(2282, 6, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2283, 7, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2284, 8, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2285, 9, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2286, 10, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2287, 11, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2288, 12, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2289, 13, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2290, 14, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2291, 15, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2292, 16, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2293, 17, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2294, 18, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2295, 19, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2296, 20, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2297, 21, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2298, 22, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2299, 23, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2300, 24, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2301, 25, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2302, 26, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2303, 27, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2304, 28, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2305, 29, 2, '2018-07-27', '13:00:06', 0, 0, 0),
(2306, 6, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2307, 7, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2308, 8, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2309, 9, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2310, 10, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2311, 11, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2312, 12, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2313, 13, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2314, 14, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2315, 15, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2316, 16, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2317, 17, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2318, 18, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2319, 19, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2320, 20, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2321, 21, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2322, 22, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2323, 23, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2324, 24, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2325, 25, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2326, 26, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2327, 27, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2328, 28, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2329, 29, 2, '2018-07-28', '13:00:08', 0, 0, 0),
(2330, 6, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2331, 7, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2332, 8, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2333, 9, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2334, 10, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2335, 11, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2336, 12, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2337, 13, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2338, 14, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2339, 15, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2340, 16, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2341, 17, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2342, 18, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2343, 19, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2344, 20, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2345, 21, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2346, 22, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2347, 23, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2348, 24, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2349, 25, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2350, 26, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2351, 27, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2352, 28, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2353, 29, 2, '2018-07-29', '13:00:10', 0, 0, 0),
(2354, 6, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2355, 7, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2356, 8, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2357, 9, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2358, 10, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2359, 11, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2360, 12, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2361, 13, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2362, 14, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2363, 15, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2364, 16, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2365, 17, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2366, 18, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2367, 19, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2368, 20, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2369, 21, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2370, 22, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2371, 23, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2372, 24, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2373, 25, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2374, 26, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2375, 27, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2376, 28, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2377, 29, 2, '2018-07-30', '13:00:08', 0, 0, 0),
(2378, 6, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2379, 7, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2380, 8, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2381, 9, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2382, 10, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2383, 11, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2384, 12, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2385, 13, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2386, 14, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2387, 15, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2388, 16, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2389, 17, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2390, 18, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2391, 19, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2392, 20, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2393, 21, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2394, 22, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2395, 23, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2396, 24, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2397, 25, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2398, 26, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2399, 27, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2400, 28, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2401, 29, 2, '2018-07-31', '13:00:07', 0, 0, 0),
(2402, 6, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2403, 7, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2404, 8, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2405, 9, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2406, 10, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2407, 11, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2408, 12, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2409, 13, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2410, 14, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2411, 15, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2412, 16, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2413, 17, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2414, 18, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2415, 19, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2416, 20, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2417, 21, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2418, 22, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2419, 23, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2420, 24, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2421, 25, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2422, 26, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2423, 27, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2424, 28, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2425, 29, 2, '2018-08-01', '13:00:06', 0, 0, 0),
(2426, 6, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2427, 7, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2428, 8, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2429, 9, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2430, 10, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2431, 11, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2432, 12, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2433, 13, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2434, 14, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2435, 15, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2436, 16, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2437, 17, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2438, 18, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2439, 19, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2440, 20, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2441, 21, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2442, 22, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2443, 23, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2444, 24, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2445, 25, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2446, 26, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2447, 27, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2448, 28, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2449, 29, 2, '2018-08-02', '13:00:08', 0, 0, 0),
(2450, 6, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2451, 7, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2452, 8, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2453, 9, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2454, 10, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2455, 11, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2456, 12, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2457, 13, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2458, 14, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2459, 15, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2460, 16, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2461, 17, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2462, 18, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2463, 19, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2464, 20, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2465, 21, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2466, 22, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2467, 23, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2468, 24, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2469, 25, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2470, 26, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2471, 27, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2472, 28, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2473, 29, 2, '2018-08-03', '13:00:07', 0, 0, 0),
(2474, 6, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2475, 7, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2476, 8, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2477, 9, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2478, 10, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2479, 11, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2480, 12, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2481, 13, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2482, 14, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2483, 15, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2484, 16, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2485, 17, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2486, 18, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2487, 19, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2488, 20, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2489, 21, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2490, 22, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2491, 23, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2492, 24, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2493, 25, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2494, 26, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2495, 27, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2496, 28, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2497, 29, 2, '2018-08-04', '13:00:05', 0, 0, 0),
(2498, 6, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2499, 7, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2500, 8, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2501, 9, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2502, 10, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2503, 11, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2504, 12, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2505, 13, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2506, 14, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2507, 15, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2508, 16, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2509, 17, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2510, 18, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2511, 19, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2512, 20, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2513, 21, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2514, 22, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2515, 23, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2516, 24, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2517, 25, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2518, 26, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2519, 27, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2520, 28, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2521, 29, 2, '2018-08-05', '13:00:08', 0, 0, 0),
(2522, 6, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2523, 7, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2524, 8, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2525, 9, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2526, 10, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2527, 11, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2528, 12, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2529, 13, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2530, 14, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2531, 15, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2532, 16, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2533, 17, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2534, 18, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2535, 19, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2536, 20, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2537, 21, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2538, 22, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2539, 23, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2540, 24, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2541, 25, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2542, 26, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2543, 27, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2544, 28, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2545, 29, 2, '2018-08-06', '13:00:06', 0, 0, 0),
(2546, 6, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2547, 7, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2548, 8, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2549, 9, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2550, 10, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2551, 11, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2552, 12, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2553, 13, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2554, 14, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2555, 15, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2556, 16, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2557, 17, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2558, 18, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2559, 19, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2560, 20, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2561, 21, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2562, 22, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2563, 23, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2564, 24, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2565, 25, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2566, 26, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2567, 27, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2568, 28, 2, '2018-08-07', '13:00:07', 0, 0, 0),
(2569, 29, 2, '2018-08-07', '13:00:07', 0, 0, 0);

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
(1, 15, 0, 1200, '2018-04-19'),
(2, 7, 13000, 13000, '2018-04-25'),
(4, 6, 10000, 10000, '2018-04-25'),
(5, 15, -1200, 1000, '2018-05-23');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Table structure for table `teach_assesment`
--

CREATE TABLE `teach_assesment` (
  `id` int(11) NOT NULL,
  `student_id` varchar(256) NOT NULL,
  `class_id` varchar(100) NOT NULL,
  `section_id` varchar(100) NOT NULL,
  `date` varchar(200) NOT NULL,
  `string_weight` varchar(100) NOT NULL,
  `string_social` varchar(100) NOT NULL,
  `string_obi` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `transaction_name` varchar(255) NOT NULL,
  `transaction_in` int(11) NOT NULL DEFAULT 0,
  `transaction_out` int(11) NOT NULL DEFAULT 0,
  `transaction_extra` text NOT NULL,
  `transaction_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `transaction_name`, `transaction_in`, `transaction_out`, `transaction_extra`, `transaction_date`) VALUES
(1, 'Misc (Rent)', 0, 50000, '', '2018-04-18 22:50:34'),
(2, 'Misc (Rent)', 0, 5, '', '2018-04-18 22:52:05'),
(3, 'Misc (10)', 0, 1000, '', '2018-04-19 00:07:39'),
(4, 'Misc (aaa)', 0, 1000, '', '2018-04-19 00:15:55'),
(5, 'Misc (aaa)', 0, 1500, '', '2018-04-19 00:16:49'),
(6, 'Misc (rent)', 0, 50000, '', '2018-04-19 09:15:38'),
(7, 'Misc (rent)', 0, 50000, '', '2018-04-19 09:15:44'),
(8, 'Misc (rent)', 0, 50000, '', '2018-04-19 09:18:53'),
(9, 'Removed (Rent) expense', 0, -5, '', '2018-04-19 09:19:47'),
(10, 'Rent (dec)', 0, 50000, '', '2018-04-19 13:25:24'),
(11, 'Rent (jan)', 0, 50000, '', '2018-04-19 13:25:40'),
(12, 'Misc (rent2)', 0, 10000, '', '2018-04-20 14:38:07'),
(13, 'Rent (Rent)', 0, 5, '', '2018-04-20 18:13:20'),
(14, 'Rent (Rent)', 0, 5, '', '2018-04-20 18:14:21'),
(15, 'Misc (Rent)', 0, 50000, '', '2018-04-20 18:15:24'),
(16, 'Misc (Rent3)', 0, 50000, '', '2018-04-20 18:18:18'),
(17, 'Misc (Rent3)', 0, 50000, '', '2018-04-20 18:18:25'),
(18, 'Removed (Rent3) expense', 0, -50000, '', '2018-04-20 18:19:21'),
(19, 'Rent (Ren4)', 0, 55000, '', '2018-04-20 18:19:50'),
(20, 'Removed (Rent) expense', 0, -5, '', '2018-04-20 18:20:18'),
(21, 'Misc (Special)', 0, 57000, '', '2018-04-20 18:22:56'),
(22, 'Rent (Ren4)', 0, 53000, '', '2018-04-20 18:23:45'),
(23, 'Misc (Rent5)', 0, 58000, '', '2018-04-20 18:26:43'),
(24, 'Rent (Rent6)', 0, 50000, '', '2018-04-20 18:34:17'),
(25, 'Misc (test)', 0, 50000, '', '2018-04-20 18:51:22'),
(26, 'Misc (test)', 0, 80000, '', '2018-04-20 18:51:36'),
(27, 'Misc (test)', 0, 50000, '', '2018-04-20 18:56:38'),
(28, 'Misc (test)', 0, 750000, '', '2018-04-20 18:56:46'),
(29, 'Misc (test)', 0, 50000, '', '2018-04-20 18:56:54'),
(30, 'Rent (asd)', 0, 50000, '', '2018-04-20 22:44:20'),
(31, 'PTCL Bill (asdf)', 0, 5500, '', '2018-04-20 22:47:57'),
(32, 'Sweaper (sweaper)', 0, 9000, '', '2018-04-20 22:49:28'),
(33, 'Sweaper (asdf)', 0, 90000, '', '2018-04-20 22:52:26'),
(34, 'Rent (wer)', 0, 55000, '', '2018-04-20 22:52:43'),
(35, 'Misc (Misc)', 0, 500, '', '2018-04-20 22:54:58'),
(36, 'PTCL Bill (ore)', 0, 2147483647, '', '2018-04-20 22:55:17'),
(37, 'PTCL Bill (erd)', 0, 909090000, '', '2018-04-20 22:55:33'),
(38, 'Rent (April)', 0, 50000, '', '2018-04-20 22:55:46'),
(39, 'Rent (April)', 0, 50000, '', '2018-04-20 22:55:53'),
(40, 'Misc (12)', 0, 8000, '', '2018-04-20 22:56:44'),
(41, 'Removed (April) expense', 0, -50000, '', '2018-04-20 22:57:06'),
(42, 'Misc (sa)', 0, 59999, '', '2018-04-20 22:57:17'),
(43, 'Misc (april2)', 0, 50000, '', '2018-04-20 22:58:26'),
(44, 'Misc (april2)', 0, 50000, '', '2018-04-20 22:58:35'),
(45, 'Removed (Misc) expense', 0, -500, '', '2018-04-20 23:02:22'),
(46, 'PTCL Bill (PPP)', 0, 12909, '', '2018-04-20 23:03:15'),
(47, 'Rent (211as)', 0, 4500000, '', '2018-04-20 23:08:39'),
(48, 'Rent (12)', 0, 900000, '', '2018-04-20 23:10:15'),
(49, 'Removed (ore) expense', 0, -100000000, '', '2018-04-21 10:46:27'),
(50, 'Removed (erd) expense', 0, -100000000, '', '2018-04-21 10:47:54'),
(51, 'Rent (april)', 0, 50000, '', '2018-04-21 10:48:11'),
(52, 'Misc (rent222)', 0, 45000, '', '2018-04-21 10:48:26'),
(53, 'PTCL Bill (bill)', 0, 345000, '', '2018-04-21 10:48:44'),
(54, 'Rent (test rent)', 0, 10000000, '', '2018-04-24 11:40:54'),
(55, 'Rent (april)', 0, 50000, '', '2018-04-25 10:08:42'),
(56, 'Rent (tsis tneR)', 0, 50000, '', '2018-05-01 21:41:26'),
(57, 'Rent (Rent it)', 0, 52000, '', '2018-05-01 21:42:35'),
(58, 'Rent (Rent it)', 0, 52000, '', '2018-05-01 21:42:46'),
(59, 'cash (petrol)', 0, 10000, '', '2018-05-26 11:44:54'),
(60, 'PTCL Bill (3876)', 0, 10000, '', '2018-07-18 16:18:20'),
(61, 'Rent (rent)', 0, 10000, '', '2018-07-21 17:57:54'),
(62, 'Rent (rent)', 0, 10000, '', '2018-07-24 12:11:47'),
(63, 'Misc (misc)', 0, 1000, '', '2018-08-03 18:30:44');

-- --------------------------------------------------------

--
-- Table structure for table `transport_route`
--

CREATE TABLE `transport_route` (
  `id` int(11) NOT NULL,
  `route_title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_of_vehicle` int(11) DEFAULT NULL,
  `fare` float(10,2) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `username`, `password`, `childs`, `role`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'amna', 'qdlfwl', '', 'teacher', 'yes', '2018-04-08 15:55:05', '0000-00-00 00:00:00'),
(2, 1, 'std1', 'kt6f2c', '', 'student', 'yes', '2018-04-09 03:38:57', '0000-00-00 00:00:00'),
(3, 1, 'parent1', 'bz0opm', '1', 'parent', 'yes', '2018-04-09 03:38:57', '0000-00-00 00:00:00'),
(4, 2, 'ali', 'sxto0d', '', 'teacher', 'yes', '2018-04-10 13:28:09', '0000-00-00 00:00:00'),
(5, 3, 'johndoe', 'x7ur1o', '', 'teacher', 'yes', '2018-04-10 13:30:09', '0000-00-00 00:00:00'),
(6, 4, 'johndoe1', '0ncfx8', '', 'teacher', 'yes', '2018-04-10 15:57:04', '0000-00-00 00:00:00'),
(7, 5, 'aliakbar', 'a30ut1', '', 'teacher', 'yes', '2018-04-10 16:00:58', '0000-00-00 00:00:00'),
(8, 6, 'imran', '31gi73', '', 'teacher', 'yes', '2018-04-12 04:01:17', '0000-00-00 00:00:00'),
(9, 2, 'std2', 'nqx1bj', '', 'student', 'yes', '2018-04-12 04:02:04', '0000-00-00 00:00:00'),
(10, 2, 'parent2', 'ee5xi8', '2', 'parent', 'yes', '2018-04-12 04:02:04', '0000-00-00 00:00:00'),
(11, 7, 'amna1', '0b0vmi', '', 'teacher', 'yes', '2018-04-12 15:39:51', '0000-00-00 00:00:00'),
(12, 8, 'ismail', 'qpcbf1', '', 'teacher', 'yes', '2018-04-13 04:10:46', '0000-00-00 00:00:00'),
(13, 3, 'std3', 'lxtgoc', '', 'student', 'yes', '2018-04-13 04:11:42', '0000-00-00 00:00:00'),
(14, 3, 'parent3', '39qaqo', '3', 'parent', 'yes', '2018-04-13 04:11:42', '0000-00-00 00:00:00'),
(15, 9, 'saleem', '706ikk', '', 'teacher', 'yes', '2018-04-13 07:23:42', '0000-00-00 00:00:00'),
(16, 10, 'javed', '6tss17', '', 'teacher', 'yes', '2018-04-13 07:23:50', '0000-00-00 00:00:00'),
(17, 11, 'khurram', 't7oa8r', '', 'teacher', 'yes', '2018-04-13 07:23:59', '0000-00-00 00:00:00'),
(18, 12, 'imtiaz', 'q7y8vv', '', 'teacher', 'yes', '2018-04-13 07:24:10', '0000-00-00 00:00:00'),
(19, 13, 'rehana', '0xutqg', '', 'teacher', 'yes', '2018-04-13 07:24:19', '0000-00-00 00:00:00'),
(20, 14, 'mudasser', '8d8558', '', 'teacher', 'yes', '2018-04-13 07:24:30', '0000-00-00 00:00:00'),
(21, 15, 'ali1', '6nipzi', '', 'teacher', 'yes', '2018-04-13 07:24:37', '0000-00-00 00:00:00'),
(22, 16, 'misbah', 'pech6z', '', 'teacher', 'yes', '2018-04-13 07:24:44', '0000-00-00 00:00:00'),
(23, 17, 'shehzad', 'sn8tp1', '', 'teacher', 'yes', '2018-04-13 07:24:53', '0000-00-00 00:00:00'),
(24, 18, 'jabran', 'bsy6ko', '', 'teacher', 'yes', '2018-04-13 07:25:02', '0000-00-00 00:00:00'),
(25, 19, 'aslam', 'e7qulu', '', 'teacher', 'yes', '2018-04-13 07:25:13', '0000-00-00 00:00:00'),
(26, 20, 'kashif', 'y29x2u', '', 'teacher', 'yes', '2018-04-13 07:25:20', '0000-00-00 00:00:00'),
(27, 21, 'sulemanrana', '3nzijd', '', 'teacher', 'yes', '2018-04-13 09:12:45', '0000-00-00 00:00:00'),
(28, 22, 'javaidali', 'nnesmq', '', 'teacher', 'yes', '2018-04-13 09:12:54', '0000-00-00 00:00:00'),
(29, 23, 'chbasheer', 'qqjnch', '', 'teacher', 'yes', '2018-04-13 09:13:04', '0000-00-00 00:00:00'),
(30, 24, 'kamranafzal', 'io8m25', '', 'teacher', 'yes', '2018-04-13 09:13:15', '0000-00-00 00:00:00'),
(31, 25, 'attauallah', 'jd9x6d', '', 'teacher', 'yes', '2018-04-13 09:13:24', '0000-00-00 00:00:00'),
(32, 26, 'saleemrazaa', 'doof4c', '', 'teacher', 'yes', '2018-04-13 09:14:07', '0000-00-00 00:00:00'),
(33, 27, 'kashifimran', 'i52d0b', '', 'teacher', 'yes', '2018-04-13 09:15:54', '0000-00-00 00:00:00'),
(34, 4, 'std4', 'c1120e', '', 'student', 'yes', '2018-04-19 04:22:08', '0000-00-00 00:00:00'),
(35, 4, 'parent4', 'u4s2wj', '4', 'parent', 'yes', '2018-04-19 04:22:08', '0000-00-00 00:00:00'),
(36, 5, 'std5', 'v0y953', '', 'student', 'yes', '2018-04-19 04:23:51', '0000-00-00 00:00:00'),
(37, 5, 'parent5', '0h2m83', '5', 'parent', 'yes', '2018-04-19 04:23:51', '0000-00-00 00:00:00'),
(38, 6, 'std6', '3pq0n6', '', 'student', 'yes', '2018-04-19 04:27:03', '0000-00-00 00:00:00'),
(39, 6, 'parent6', 'rl5joh', '6', 'parent', 'yes', '2018-04-19 04:27:03', '0000-00-00 00:00:00'),
(40, 7, 'std7', 'ddeyev', '', 'student', 'yes', '2018-04-21 05:50:14', '0000-00-00 00:00:00'),
(41, 7, 'parent7', 'oceaqo', '7', 'parent', 'yes', '2018-04-21 05:50:14', '0000-00-00 00:00:00'),
(42, 28, 'sipra', 'gujg2p', '', 'teacher', 'yes', '2018-04-24 05:57:08', '0000-00-00 00:00:00'),
(43, 29, 'saleemi', 'tt0ks7', '', 'teacher', 'yes', '2018-04-24 06:05:28', '0000-00-00 00:00:00'),
(44, 8, 'std8', '5z2ap7', '', 'student', 'yes', '2018-05-23 09:42:09', '0000-00-00 00:00:00'),
(45, 8, 'parent8', 'wwrtlc', '8', 'parent', 'yes', '2018-05-23 09:42:09', '0000-00-00 00:00:00'),
(46, 9, 'std9', 'fiza6m', '', 'student', 'yes', '2018-05-24 14:49:31', '0000-00-00 00:00:00'),
(47, 9, 'parent9', 'sjlw03', '9', 'parent', 'yes', '2018-05-24 14:49:31', '0000-00-00 00:00:00'),
(48, 10, 'std10', '1trty9', '', 'student', 'yes', '2018-05-24 14:50:48', '0000-00-00 00:00:00'),
(49, 10, 'parent10', 'zq3113', '10', 'parent', 'yes', '2018-05-24 14:50:48', '0000-00-00 00:00:00'),
(50, 11, 'std11', 'ydscrc', '', 'student', 'yes', '2018-05-24 14:54:41', '0000-00-00 00:00:00'),
(51, 11, 'parent11', 'esx15c', '11', 'parent', 'yes', '2018-05-24 14:54:41', '0000-00-00 00:00:00'),
(52, 12, 'std12', '25qnl5', '', 'student', 'yes', '2018-05-24 14:57:45', '0000-00-00 00:00:00'),
(53, 12, 'parent12', 'z9ikpk', '12', 'parent', 'yes', '2018-05-24 14:57:45', '0000-00-00 00:00:00'),
(54, 13, 'std13', 'ff0wpk', '', 'student', 'yes', '2018-05-24 14:59:26', '0000-00-00 00:00:00'),
(55, 13, 'parent13', 'n6u7fo', '13', 'parent', 'yes', '2018-05-24 14:59:26', '0000-00-00 00:00:00'),
(56, 0, 'std0', 'rdvj1v', '', 'student', 'yes', '2018-05-24 15:01:13', '0000-00-00 00:00:00'),
(57, 0, 'parent0', '1lc0hb', '0', 'parent', 'yes', '2018-05-24 15:01:13', '0000-00-00 00:00:00'),
(58, 14, 'std14', '6pf2gd', '', 'student', 'yes', '2018-05-24 15:02:05', '0000-00-00 00:00:00'),
(59, 14, 'parent14', 'fkdujd', '14', 'parent', 'yes', '2018-05-24 15:02:05', '0000-00-00 00:00:00'),
(60, 15, 'std15', 'xx0kmy', '', 'student', 'yes', '2018-05-24 17:20:00', '0000-00-00 00:00:00'),
(61, 15, 'parent15', '8p7jdt', '15', 'parent', 'yes', '2018-05-24 17:20:00', '0000-00-00 00:00:00'),
(62, 16, 'std16', 'odniqo', '', 'student', 'yes', '2018-05-24 17:29:56', '0000-00-00 00:00:00'),
(63, 16, 'parent16', 'jkvp48', '16', 'parent', 'yes', '2018-05-24 17:29:56', '0000-00-00 00:00:00'),
(64, 17, 'std17', '7nqf1p', '', 'student', 'yes', '2018-05-24 17:41:24', '0000-00-00 00:00:00'),
(65, 17, 'parent17', '2xocyy', '17', 'parent', 'yes', '2018-05-24 17:41:24', '0000-00-00 00:00:00'),
(67, 18, 'parent18', 'erv4zo', '18', 'parent', 'yes', '2018-05-24 17:42:07', '0000-00-00 00:00:00'),
(68, 19, 'std19', '5gi82i', '', 'student', 'yes', '2018-05-25 06:50:27', '0000-00-00 00:00:00'),
(69, 19, 'parent19', 'lnw8hz', '19', 'parent', 'yes', '2018-05-25 06:50:27', '0000-00-00 00:00:00'),
(70, 20, 'std20', '14v5hv', '', 'student', 'yes', '2018-05-25 06:51:14', '0000-00-00 00:00:00'),
(71, 20, 'parent20', 'x0mrt4', '20', 'parent', 'yes', '2018-05-25 06:51:14', '0000-00-00 00:00:00'),
(72, 21, 'std21', '6f9jke', '', 'student', 'yes', '2018-05-25 07:07:32', '0000-00-00 00:00:00'),
(73, 21, 'parent21', 'mg8mkh', '21', 'parent', 'yes', '2018-05-25 07:07:32', '0000-00-00 00:00:00'),
(74, 22, 'std22', 'vj4ryj', '', 'student', 'yes', '2018-05-25 08:43:28', '0000-00-00 00:00:00'),
(75, 22, 'parent22', 'v29hic', '22', 'parent', 'yes', '2018-05-25 08:43:28', '0000-00-00 00:00:00'),
(76, 23, 'std23', '8dyn42', '', 'student', 'yes', '2018-05-25 08:46:03', '0000-00-00 00:00:00'),
(77, 23, 'parent23', 'ixmyb7', '23', 'parent', 'yes', '2018-05-25 08:46:03', '0000-00-00 00:00:00'),
(78, 24, 'std24', 'l34v8z', '', 'student', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(79, 24, 'parent24', '7crt5e', '24', 'parent', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(80, 25, 'std25', 'oe1ua6', '', 'student', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(81, 25, 'parent25', 'acrvfs', '25', 'parent', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(82, 26, 'std26', 'gosxj4', '', 'student', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(83, 26, 'parent26', 'fq2v12', '26', 'parent', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(84, 27, 'std27', 'adyyg5', '', 'student', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(85, 27, 'parent27', 'g1ngkn', '27', 'parent', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(86, 28, 'std28', 'vn2ks2', '', 'student', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(87, 28, 'parent28', '7sxtum', '28', 'parent', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(88, 29, 'std29', 'dbgfml', '', 'student', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(89, 29, 'parent29', 'zf00m7', '29', 'parent', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(90, 30, 'std30', 'd3p6dd', '', 'student', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(91, 30, 'parent30', 'd0ty0f', '30', 'parent', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(92, 31, 'std31', 'qz4bhy', '', 'student', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(93, 31, 'parent31', 'b9d6cx', '31', 'parent', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(94, 32, 'std32', 'uamh38', '', 'student', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(95, 32, 'parent32', 'nt1zeh', '32', 'parent', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(96, 33, 'std33', 'aemqbf', '', 'student', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(97, 33, 'parent33', 'p4sx2f', '33', 'parent', 'yes', '2018-05-25 16:16:37', '0000-00-00 00:00:00'),
(98, 34, 'std34', 'ys08wr', '', 'student', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(99, 34, 'parent34', 'pflhup', '34', 'parent', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(100, 35, 'std35', 'zppeq5', '', 'student', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(101, 35, 'parent35', 'xswnbi', '35', 'parent', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(102, 36, 'std36', 'huhmvg', '', 'student', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(103, 36, 'parent36', 'z5scr9', '36', 'parent', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(104, 37, 'std37', 'e7xb4t', '', 'student', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(105, 37, 'parent37', '2ndmnh', '37', 'parent', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(106, 38, 'std38', 'v7rk05', '', 'student', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(107, 38, 'parent38', 'tiehmt', '38', 'parent', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(108, 39, 'std39', 'ls7m7a', '', 'student', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(109, 39, 'parent39', 'zefn88', '39', 'parent', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(110, 40, 'std40', 'kfvmtb', '', 'student', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(111, 40, 'parent40', 'saevtq', '40', 'parent', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(112, 41, 'std41', 'ayh5yw', '', 'student', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(113, 41, 'parent41', 'aw3iyp', '41', 'parent', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(114, 42, 'std42', 'u636yl', '', 'student', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(115, 42, 'parent42', 'za01en', '42', 'parent', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(116, 43, 'std43', 'u0zooa', '', 'student', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(117, 43, 'parent43', 'cwow1h', '43', 'parent', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(118, 44, 'std44', '54z7xp', '', 'student', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(119, 44, 'parent44', 'd60k79', '44', 'parent', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(120, 45, 'std45', 'kmmmly', '', 'student', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(121, 45, 'parent45', 'ps3yc6', '45', 'parent', 'yes', '2018-05-25 16:17:05', '0000-00-00 00:00:00'),
(122, 46, 'std46', 'snq3v0', '', 'student', 'yes', '2018-05-25 16:17:40', '0000-00-00 00:00:00'),
(123, 46, 'parent46', 'n42fe3', '46', 'parent', 'yes', '2018-05-25 16:17:40', '0000-00-00 00:00:00'),
(124, 47, 'std47', 'ifp4at', '', 'student', 'yes', '2018-05-25 16:17:40', '0000-00-00 00:00:00'),
(125, 47, 'parent47', 'bzxytx', '47', 'parent', 'yes', '2018-05-25 16:17:40', '0000-00-00 00:00:00'),
(126, 48, 'std48', 'zvwfut', '', 'student', 'yes', '2018-05-25 16:17:40', '0000-00-00 00:00:00'),
(127, 48, 'parent48', 'xt9sl1', '48', 'parent', 'yes', '2018-05-25 16:17:40', '0000-00-00 00:00:00'),
(128, 49, 'std49', '69apc8', '', 'student', 'yes', '2018-05-25 16:17:40', '0000-00-00 00:00:00'),
(129, 49, 'parent49', 'c0y5y3', '49', 'parent', 'yes', '2018-05-25 16:17:40', '0000-00-00 00:00:00'),
(130, 50, 'std50', 'i836r6', '', 'student', 'yes', '2018-05-25 16:17:40', '0000-00-00 00:00:00'),
(131, 50, 'parent50', 'tpuzqe', '50', 'parent', 'yes', '2018-05-25 16:17:40', '0000-00-00 00:00:00'),
(132, 51, 'std51', '7crcia', '', 'student', 'yes', '2018-05-25 16:17:40', '0000-00-00 00:00:00'),
(133, 51, 'parent51', '386aj0', '51', 'parent', 'yes', '2018-05-25 16:17:40', '0000-00-00 00:00:00'),
(134, 52, 'std52', 'pcxuy7', '', 'student', 'yes', '2018-05-25 16:17:40', '0000-00-00 00:00:00'),
(135, 52, 'parent52', 'w3qxza', '52', 'parent', 'yes', '2018-05-25 16:17:40', '0000-00-00 00:00:00'),
(136, 53, 'std53', '1v5zf0', '', 'student', 'yes', '2018-05-25 16:18:03', '0000-00-00 00:00:00'),
(137, 53, 'parent53', 'ttyru0', '53', 'parent', 'yes', '2018-05-25 16:18:03', '0000-00-00 00:00:00'),
(138, 54, 'std54', '2cgdf1', '', 'student', 'yes', '2018-05-25 16:18:03', '0000-00-00 00:00:00'),
(139, 54, 'parent54', '9v5wpc', '54', 'parent', 'yes', '2018-05-25 16:18:03', '0000-00-00 00:00:00'),
(140, 55, 'std55', 'vzcj2p', '', 'student', 'yes', '2018-05-25 16:18:03', '0000-00-00 00:00:00'),
(141, 55, 'parent55', 'enyvex', '55', 'parent', 'yes', '2018-05-25 16:18:03', '0000-00-00 00:00:00'),
(142, 56, 'std56', 'sox2g0', '', 'student', 'yes', '2018-05-25 16:18:03', '0000-00-00 00:00:00'),
(143, 56, 'parent56', 'rzx92q', '56', 'parent', 'yes', '2018-05-25 16:18:03', '0000-00-00 00:00:00'),
(144, 57, 'std57', 'xbd266', '', 'student', 'yes', '2018-05-25 16:18:03', '0000-00-00 00:00:00'),
(145, 57, 'parent57', 'ojpsft', '57', 'parent', 'yes', '2018-05-25 16:18:03', '0000-00-00 00:00:00'),
(146, 58, 'std58', '1zdgd7', '', 'student', 'yes', '2018-05-25 16:18:03', '0000-00-00 00:00:00'),
(147, 58, 'parent58', '0699ev', '58', 'parent', 'yes', '2018-05-25 16:18:03', '0000-00-00 00:00:00'),
(148, 59, 'std59', 'ube3jw', '', 'student', 'yes', '2018-05-25 16:18:24', '0000-00-00 00:00:00'),
(149, 59, 'parent59', 'faa28u', '59', 'parent', 'yes', '2018-05-25 16:18:24', '0000-00-00 00:00:00'),
(150, 60, 'std60', 'n912hk', '', 'student', 'yes', '2018-05-25 16:18:24', '0000-00-00 00:00:00'),
(151, 60, 'parent60', '6lhzxy', '60', 'parent', 'yes', '2018-05-25 16:18:24', '0000-00-00 00:00:00'),
(152, 61, 'std61', 'qs9abm', '', 'student', 'yes', '2018-05-25 16:18:24', '0000-00-00 00:00:00'),
(153, 61, 'parent61', 'rur3q0', '61', 'parent', 'yes', '2018-05-25 16:18:24', '0000-00-00 00:00:00'),
(154, 62, 'std62', 'nexjn6', '', 'student', 'yes', '2018-05-25 16:18:24', '0000-00-00 00:00:00'),
(155, 62, 'parent62', '2xcuur', '62', 'parent', 'yes', '2018-05-25 16:18:24', '0000-00-00 00:00:00'),
(156, 63, 'std63', '1ovxoe', '', 'student', 'yes', '2018-05-25 16:18:24', '0000-00-00 00:00:00'),
(157, 63, 'parent63', 'gnk40j', '63', 'parent', 'yes', '2018-05-25 16:18:24', '0000-00-00 00:00:00'),
(158, 64, 'std64', 'phekki', '', 'student', 'yes', '2018-05-25 16:18:24', '0000-00-00 00:00:00'),
(159, 64, 'parent64', '4afax7', '64', 'parent', 'yes', '2018-05-25 16:18:24', '0000-00-00 00:00:00'),
(160, 65, 'std65', 'ari6fa', '', 'student', 'yes', '2018-05-25 16:18:54', '0000-00-00 00:00:00'),
(161, 65, 'parent65', 'tgf40a', '65', 'parent', 'yes', '2018-05-25 16:18:54', '0000-00-00 00:00:00'),
(162, 66, 'std66', 'xpoiwl', '', 'student', 'yes', '2018-05-25 16:18:54', '0000-00-00 00:00:00'),
(163, 66, 'parent66', 'zs94o8', '66', 'parent', 'yes', '2018-05-25 16:18:54', '0000-00-00 00:00:00'),
(164, 67, 'std67', 'h0fh0m', '', 'student', 'yes', '2018-05-25 16:18:54', '0000-00-00 00:00:00'),
(165, 67, 'parent67', 'x6ogvj', '67', 'parent', 'yes', '2018-05-25 16:18:54', '0000-00-00 00:00:00'),
(166, 68, 'std68', 'tj2g4g', '', 'student', 'yes', '2018-05-25 16:18:54', '0000-00-00 00:00:00'),
(167, 68, 'parent68', '7zgezd', '68', 'parent', 'yes', '2018-05-25 16:18:54', '0000-00-00 00:00:00'),
(168, 69, 'std69', 'dtfrer', '', 'student', 'yes', '2018-05-25 16:18:54', '0000-00-00 00:00:00'),
(169, 69, 'parent69', 'nl9yfp', '69', 'parent', 'yes', '2018-05-25 16:18:54', '0000-00-00 00:00:00'),
(170, 70, 'std70', 'ynjlls', '', 'student', 'yes', '2018-05-25 16:19:27', '0000-00-00 00:00:00'),
(171, 70, 'parent70', '09d1tt', '70', 'parent', 'yes', '2018-05-25 16:19:27', '0000-00-00 00:00:00'),
(172, 71, 'std71', 'nsc7d9', '', 'student', 'yes', '2018-05-25 16:19:27', '0000-00-00 00:00:00'),
(173, 71, 'parent71', 'q0xj75', '71', 'parent', 'yes', '2018-05-25 16:19:27', '0000-00-00 00:00:00'),
(174, 72, 'std72', 'vx21ir', '', 'student', 'yes', '2018-05-25 16:19:27', '0000-00-00 00:00:00'),
(175, 72, 'parent72', '0rt9p4', '72', 'parent', 'yes', '2018-05-25 16:19:27', '0000-00-00 00:00:00'),
(176, 73, 'std73', 'r5hmlq', '', 'student', 'yes', '2018-05-25 16:19:27', '0000-00-00 00:00:00'),
(177, 73, 'parent73', 'onrt6w', '73', 'parent', 'yes', '2018-05-25 16:19:27', '0000-00-00 00:00:00'),
(178, 74, 'std74', 'te1u38', '', 'student', 'yes', '2018-05-25 16:19:53', '0000-00-00 00:00:00'),
(179, 74, 'parent74', 'gsx2j2', '74', 'parent', 'yes', '2018-05-25 16:19:53', '0000-00-00 00:00:00'),
(180, 75, 'std75', 'v2vdmq', '', 'student', 'yes', '2018-05-25 16:19:53', '0000-00-00 00:00:00'),
(181, 75, 'parent75', 'j4sxuo', '75', 'parent', 'yes', '2018-05-25 16:19:53', '0000-00-00 00:00:00'),
(182, 76, 'std76', 'zha1j1', '', 'student', 'yes', '2018-05-25 16:19:53', '0000-00-00 00:00:00'),
(183, 76, 'parent76', 'sy5gyr', '76', 'parent', 'yes', '2018-05-25 16:19:53', '0000-00-00 00:00:00'),
(184, 77, 'std77', 'n1vopx', '', 'student', 'yes', '2018-05-25 16:19:53', '0000-00-00 00:00:00'),
(185, 77, 'parent77', '7cyxni', '77', 'parent', 'yes', '2018-05-25 16:19:53', '0000-00-00 00:00:00'),
(186, 78, 'std78', '9dho0h', '', 'student', 'yes', '2018-05-25 16:19:53', '0000-00-00 00:00:00'),
(187, 78, 'parent78', '2qehv7', '78', 'parent', 'yes', '2018-05-25 16:19:53', '0000-00-00 00:00:00'),
(188, 79, 'std79', 'b6ovti', '', 'student', 'yes', '2018-05-25 16:19:53', '0000-00-00 00:00:00'),
(189, 79, 'parent79', 'u58lpe', '79', 'parent', 'yes', '2018-05-25 16:19:53', '0000-00-00 00:00:00'),
(190, 80, 'std80', 'k7vstk', '', 'student', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(191, 80, 'parent80', '8ylbph', '80', 'parent', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(192, 81, 'std81', 'lh0b02', '', 'student', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(193, 81, 'parent81', 'awk6ph', '81', 'parent', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(194, 82, 'std82', '1c1ro3', '', 'student', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(195, 82, 'parent82', 'ibbu1s', '82', 'parent', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(196, 83, 'std83', 'c6vtbt', '', 'student', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(197, 83, 'parent83', 't4at7k', '83', 'parent', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(198, 84, 'std84', 'kxur6d', '', 'student', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(199, 84, 'parent84', 'mnvsud', '84', 'parent', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(200, 85, 'std85', '43hnwk', '', 'student', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(201, 85, 'parent85', 'f0z5dz', '85', 'parent', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(202, 86, 'std86', 'yu38cg', '', 'student', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(203, 86, 'parent86', 'q9a8lu', '86', 'parent', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(204, 87, 'std87', 'pha1o2', '', 'student', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(205, 87, 'parent87', 'cyxnrl', '87', 'parent', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(206, 88, 'std88', '2ovhv5', '', 'student', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(207, 88, 'parent88', '4s1hqb', '88', 'parent', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(208, 89, 'std89', 'kdug0u', '', 'student', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(209, 89, 'parent89', 'rfb1l6', '89', 'parent', 'yes', '2018-05-27 07:23:55', '0000-00-00 00:00:00'),
(210, 90, 'std90', 'v4r883', '', 'student', 'yes', '2018-05-27 07:25:03', '0000-00-00 00:00:00'),
(211, 90, 'parent90', '0dqw2h', '90', 'parent', 'yes', '2018-05-27 07:25:03', '0000-00-00 00:00:00'),
(212, 91, 'std91', '7b7gzz', '', 'student', 'yes', '2018-05-27 07:25:03', '0000-00-00 00:00:00'),
(213, 91, 'parent91', 'c47z2p', '91', 'parent', 'yes', '2018-05-27 07:25:03', '0000-00-00 00:00:00'),
(214, 92, 'std92', '75dqo3', '', 'student', 'yes', '2018-05-27 07:25:03', '0000-00-00 00:00:00'),
(215, 92, 'parent92', 'nsgmdd', '92', 'parent', 'yes', '2018-05-27 07:25:03', '0000-00-00 00:00:00'),
(216, 93, 'std93', 'aaejb9', '', 'student', 'yes', '2018-05-27 07:25:03', '0000-00-00 00:00:00'),
(217, 93, 'parent93', 'jo8r85', '93', 'parent', 'yes', '2018-05-27 07:25:03', '0000-00-00 00:00:00'),
(218, 94, 'std94', 'yhkett', '', 'student', 'yes', '2018-05-27 07:25:03', '0000-00-00 00:00:00'),
(219, 94, 'parent94', 'y4mski', '94', 'parent', 'yes', '2018-05-27 07:25:03', '0000-00-00 00:00:00'),
(220, 95, 'std95', 'v5qu50', '', 'student', 'yes', '2018-05-27 07:25:03', '0000-00-00 00:00:00'),
(221, 95, 'parent95', 'n8n3ek', '95', 'parent', 'yes', '2018-05-27 07:25:03', '0000-00-00 00:00:00'),
(222, 96, 'std96', 'lwmqld', '', 'student', 'yes', '2018-05-27 07:25:04', '0000-00-00 00:00:00'),
(223, 96, 'parent96', 'm50rw5', '96', 'parent', 'yes', '2018-05-27 07:25:04', '0000-00-00 00:00:00'),
(224, 97, 'std97', 'pmmrfk', '', 'student', 'yes', '2018-05-27 07:25:04', '0000-00-00 00:00:00'),
(225, 97, 'parent97', 'oj6a1h', '97', 'parent', 'yes', '2018-05-27 07:25:04', '0000-00-00 00:00:00'),
(226, 98, 'std98', 'cystdm', '', 'student', 'yes', '2018-05-27 07:25:04', '0000-00-00 00:00:00'),
(227, 98, 'parent98', 'vxrq99', '98', 'parent', 'yes', '2018-05-27 07:25:04', '0000-00-00 00:00:00'),
(228, 99, 'std99', 'ede9wn', '', 'student', 'yes', '2018-05-27 07:25:04', '0000-00-00 00:00:00'),
(229, 99, 'parent99', '84qntk', '99', 'parent', 'yes', '2018-05-27 07:25:04', '0000-00-00 00:00:00'),
(230, 100, 'std100', 'hyzqfz', '', 'student', 'yes', '2018-05-27 07:25:04', '0000-00-00 00:00:00'),
(231, 100, 'parent100', '8yordu', '100', 'parent', 'yes', '2018-05-27 07:25:04', '0000-00-00 00:00:00'),
(232, 101, 'std101', 'va0xda', '', 'student', 'yes', '2018-05-27 07:25:04', '0000-00-00 00:00:00'),
(233, 101, 'parent101', 'h7sdiu', '101', 'parent', 'yes', '2018-05-27 07:25:04', '0000-00-00 00:00:00'),
(234, 102, 'std102', 'evh6pr', '', 'student', 'yes', '2018-05-27 07:26:12', '0000-00-00 00:00:00'),
(235, 102, 'parent102', '3vzy6k', '102', 'parent', 'yes', '2018-05-27 07:26:12', '0000-00-00 00:00:00'),
(236, 103, 'std103', 'vcbrl0', '', 'student', 'yes', '2018-05-27 07:26:12', '0000-00-00 00:00:00'),
(237, 103, 'parent103', 'g0z287', '103', 'parent', 'yes', '2018-05-27 07:26:12', '0000-00-00 00:00:00'),
(238, 104, 'std104', '9qpmy4', '', 'student', 'yes', '2018-05-27 07:26:12', '0000-00-00 00:00:00'),
(239, 104, 'parent104', 'tjn5mt', '104', 'parent', 'yes', '2018-05-27 07:26:12', '0000-00-00 00:00:00'),
(240, 105, 'std105', 'g9djil', '', 'student', 'yes', '2018-05-27 07:26:12', '0000-00-00 00:00:00'),
(241, 105, 'parent105', '045z3r', '105', 'parent', 'yes', '2018-05-27 07:26:12', '0000-00-00 00:00:00'),
(242, 106, 'std106', 'bnpsll', '', 'student', 'yes', '2018-05-27 07:26:12', '0000-00-00 00:00:00'),
(243, 106, 'parent106', 'qc1sab', '106', 'parent', 'yes', '2018-05-27 07:26:12', '0000-00-00 00:00:00'),
(244, 107, 'std107', '6c3tva', '', 'student', 'yes', '2018-05-27 07:26:12', '0000-00-00 00:00:00'),
(245, 107, 'parent107', 'c6fcxo', '107', 'parent', 'yes', '2018-05-27 07:26:12', '0000-00-00 00:00:00'),
(246, 108, 'std108', '8w4org', '', 'student', 'yes', '2018-05-27 07:26:12', '0000-00-00 00:00:00'),
(247, 108, 'parent108', '8xrmjg', '108', 'parent', 'yes', '2018-05-27 07:26:12', '0000-00-00 00:00:00'),
(248, 109, 'std109', 'te4zvn', '', 'student', 'yes', '2018-05-27 07:27:11', '0000-00-00 00:00:00'),
(249, 109, 'parent109', 'hq681e', '109', 'parent', 'yes', '2018-05-27 07:27:11', '0000-00-00 00:00:00'),
(250, 110, 'std110', 'd7j4gv', '', 'student', 'yes', '2018-05-27 07:27:11', '0000-00-00 00:00:00'),
(251, 110, 'parent110', 'zpz3hf', '110', 'parent', 'yes', '2018-05-27 07:27:11', '0000-00-00 00:00:00'),
(252, 111, 'std111', 'sq5t0o', '', 'student', 'yes', '2018-05-27 07:27:11', '0000-00-00 00:00:00'),
(253, 111, 'parent111', 'vrn8pj', '111', 'parent', 'yes', '2018-05-27 07:27:11', '0000-00-00 00:00:00'),
(254, 112, 'std112', 'ckrnz6', '', 'student', 'yes', '2018-05-27 07:27:11', '0000-00-00 00:00:00'),
(255, 112, 'parent112', '0pdx98', '112', 'parent', 'yes', '2018-05-27 07:27:11', '0000-00-00 00:00:00'),
(256, 113, 'std113', 'zbpzz2', '', 'student', 'yes', '2018-05-27 07:27:11', '0000-00-00 00:00:00'),
(257, 113, 'parent113', 'yga1gp', '113', 'parent', 'yes', '2018-05-27 07:27:11', '0000-00-00 00:00:00'),
(258, 114, 'std114', '2fq0up', '', 'student', 'yes', '2018-05-27 07:27:11', '0000-00-00 00:00:00'),
(259, 114, 'parent114', 'cjsb4d', '114', 'parent', 'yes', '2018-05-27 07:27:11', '0000-00-00 00:00:00'),
(260, 115, 'std115', 'qzc7c8', '', 'student', 'yes', '2018-05-27 07:29:06', '0000-00-00 00:00:00'),
(261, 115, 'parent115', '9nw1rw', '115', 'parent', 'yes', '2018-05-27 07:29:06', '0000-00-00 00:00:00'),
(262, 116, 'std116', 'wtpcdf', '', 'student', 'yes', '2018-05-27 07:29:06', '0000-00-00 00:00:00'),
(263, 116, 'parent116', 'kipv99', '116', 'parent', 'yes', '2018-05-27 07:29:06', '0000-00-00 00:00:00'),
(264, 117, 'std117', '71hl69', '', 'student', 'yes', '2018-05-27 07:29:06', '0000-00-00 00:00:00'),
(265, 117, 'parent117', 'q7in3d', '117', 'parent', 'yes', '2018-05-27 07:29:06', '0000-00-00 00:00:00'),
(266, 118, 'std118', '37t6pr', '', 'student', 'yes', '2018-05-27 07:29:06', '0000-00-00 00:00:00'),
(267, 118, 'parent118', 'i3sq8p', '118', 'parent', 'yes', '2018-05-27 07:29:06', '0000-00-00 00:00:00'),
(268, 119, 'std119', '6mvct9', '', 'student', 'yes', '2018-05-27 07:29:06', '0000-00-00 00:00:00'),
(269, 119, 'parent119', 'n7j9d8', '119', 'parent', 'yes', '2018-05-27 07:29:06', '0000-00-00 00:00:00'),
(270, 120, 'std120', 'ebn4qu', '', 'student', 'yes', '2018-05-27 07:29:06', '0000-00-00 00:00:00'),
(271, 120, 'parent120', 'mtbak2', '120', 'parent', 'yes', '2018-05-27 07:29:06', '0000-00-00 00:00:00'),
(272, 121, 'std121', 'rbyu3r', '', 'student', 'yes', '2018-05-27 07:29:55', '0000-00-00 00:00:00'),
(273, 121, 'parent121', 'w00yf8', '121', 'parent', 'yes', '2018-05-27 07:29:55', '0000-00-00 00:00:00'),
(274, 122, 'std122', 'qajvyx', '', 'student', 'yes', '2018-05-27 07:29:55', '0000-00-00 00:00:00'),
(275, 122, 'parent122', 'imv56f', '122', 'parent', 'yes', '2018-05-27 07:29:55', '0000-00-00 00:00:00'),
(276, 123, 'std123', '8x7n5a', '', 'student', 'yes', '2018-05-27 07:29:55', '0000-00-00 00:00:00'),
(277, 123, 'parent123', 'u0vz9e', '123', 'parent', 'yes', '2018-05-27 07:29:55', '0000-00-00 00:00:00'),
(278, 124, 'std124', 'x09b01', '', 'student', 'yes', '2018-05-27 07:29:55', '0000-00-00 00:00:00'),
(279, 124, 'parent124', 'rloz4i', '124', 'parent', 'yes', '2018-05-27 07:29:55', '0000-00-00 00:00:00'),
(280, 125, 'std125', 'y5eqq8', '', 'student', 'yes', '2018-05-27 07:29:55', '0000-00-00 00:00:00'),
(281, 125, 'parent125', 'jl8l40', '125', 'parent', 'yes', '2018-05-27 07:29:55', '0000-00-00 00:00:00'),
(282, 126, 'std126', 'onhv69', '', 'student', 'yes', '2018-05-27 07:35:10', '0000-00-00 00:00:00'),
(283, 126, 'parent126', 'jiuuiy', '126', 'parent', 'yes', '2018-05-27 07:35:10', '0000-00-00 00:00:00'),
(284, 127, 'std127', 'sfmbe4', '', 'student', 'yes', '2018-05-27 07:35:10', '0000-00-00 00:00:00'),
(285, 127, 'parent127', '8hjvn5', '127', 'parent', 'yes', '2018-05-27 07:35:10', '0000-00-00 00:00:00'),
(286, 128, 'std128', 'wwb2o8', '', 'student', 'yes', '2018-05-27 07:35:10', '0000-00-00 00:00:00'),
(287, 128, 'parent128', 'l68bn0', '128', 'parent', 'yes', '2018-05-27 07:35:10', '0000-00-00 00:00:00'),
(288, 129, 'std129', 'vrvv3e', '', 'student', 'yes', '2018-05-27 07:35:10', '0000-00-00 00:00:00'),
(289, 129, 'parent129', '4gq2th', '129', 'parent', 'yes', '2018-05-27 07:35:10', '0000-00-00 00:00:00'),
(290, 130, 'std130', 'driv6a', '', 'student', 'yes', '2018-05-27 07:35:41', '0000-00-00 00:00:00'),
(291, 130, 'parent130', 'y9hpju', '130', 'parent', 'yes', '2018-05-27 07:35:41', '0000-00-00 00:00:00'),
(292, 131, 'std131', 'oev4dc', '', 'student', 'yes', '2018-05-27 07:35:41', '0000-00-00 00:00:00'),
(293, 131, 'parent131', 'w4xokk', '131', 'parent', 'yes', '2018-05-27 07:35:41', '0000-00-00 00:00:00'),
(294, 132, 'std132', '0fsw4i', '', 'student', 'yes', '2018-05-27 07:35:41', '0000-00-00 00:00:00'),
(295, 132, 'parent132', 'xvlfsi', '132', 'parent', 'yes', '2018-05-27 07:35:41', '0000-00-00 00:00:00'),
(296, 133, 'std133', '7cn0zr', '', 'student', 'yes', '2018-05-27 07:35:41', '0000-00-00 00:00:00'),
(297, 133, 'parent133', 'k14ar8', '133', 'parent', 'yes', '2018-05-27 07:35:41', '0000-00-00 00:00:00'),
(298, 134, 'std134', 'kgn3an', '', 'student', 'yes', '2018-05-27 07:35:41', '0000-00-00 00:00:00'),
(299, 134, 'parent134', '4tt8cm', '134', 'parent', 'yes', '2018-05-27 07:35:41', '0000-00-00 00:00:00'),
(300, 135, 'std135', 'dskydf', '', 'student', 'yes', '2018-05-27 07:35:41', '0000-00-00 00:00:00'),
(301, 135, 'parent135', '833g9u', '135', 'parent', 'yes', '2018-05-27 07:35:41', '0000-00-00 00:00:00'),
(302, 136, 'std136', 'im5362', '', 'student', 'yes', '2018-05-27 07:36:35', '0000-00-00 00:00:00'),
(303, 136, 'parent136', '27uqsd', '136', 'parent', 'yes', '2018-05-27 07:36:35', '0000-00-00 00:00:00'),
(304, 137, 'std137', 'mzekkl', '', 'student', 'yes', '2018-05-27 07:36:35', '0000-00-00 00:00:00'),
(305, 137, 'parent137', '60pi71', '137', 'parent', 'yes', '2018-05-27 07:36:35', '0000-00-00 00:00:00'),
(306, 138, 'std138', 't4o2d8', '', 'student', 'yes', '2018-05-27 07:36:35', '0000-00-00 00:00:00'),
(307, 138, 'parent138', 'sxc2eg', '138', 'parent', 'yes', '2018-05-27 07:36:35', '0000-00-00 00:00:00'),
(308, 139, 'std139', 't9cpwx', '', 'student', 'yes', '2018-05-27 07:36:35', '0000-00-00 00:00:00'),
(309, 139, 'parent139', 'nufhq1', '139', 'parent', 'yes', '2018-05-27 07:36:35', '0000-00-00 00:00:00'),
(310, 140, 'std140', 'l7xnz2', '', 'student', 'yes', '2018-05-27 07:36:35', '0000-00-00 00:00:00'),
(311, 140, 'parent140', 'lib9f4', '140', 'parent', 'yes', '2018-05-27 07:36:35', '0000-00-00 00:00:00'),
(312, 141, 'std141', 'u0vpuk', '', 'student', 'yes', '2018-05-27 07:38:08', '0000-00-00 00:00:00'),
(313, 141, 'parent141', '1ufcxh', '141', 'parent', 'yes', '2018-05-27 07:38:08', '0000-00-00 00:00:00'),
(314, 142, 'std142', 'rktmgq', '', 'student', 'yes', '2018-05-27 07:38:08', '0000-00-00 00:00:00'),
(315, 142, 'parent142', '7yhjgl', '142', 'parent', 'yes', '2018-05-27 07:38:08', '0000-00-00 00:00:00'),
(316, 143, 'std143', 'xeubaz', '', 'student', 'yes', '2018-05-27 07:38:08', '0000-00-00 00:00:00'),
(317, 143, 'parent143', 'qq9xsw', '143', 'parent', 'yes', '2018-05-27 07:38:08', '0000-00-00 00:00:00'),
(318, 144, 'std144', 'z91d2j', '', 'student', 'yes', '2018-05-27 07:38:08', '0000-00-00 00:00:00'),
(319, 144, 'parent144', 'e5e8lj', '144', 'parent', 'yes', '2018-05-27 07:38:08', '0000-00-00 00:00:00'),
(320, 145, 'std145', 'ycq4dt', '', 'student', 'yes', '2018-05-27 07:38:08', '0000-00-00 00:00:00'),
(321, 145, 'parent145', 'x1rwd8', '145', 'parent', 'yes', '2018-05-27 07:38:08', '0000-00-00 00:00:00'),
(322, 146, 'std146', 'yvpv2d', '', 'student', 'yes', '2018-05-27 07:38:57', '0000-00-00 00:00:00'),
(323, 146, 'parent146', 'j3nv5j', '146', 'parent', 'yes', '2018-05-27 07:38:57', '0000-00-00 00:00:00'),
(324, 147, 'std147', 'gw06vj', '', 'student', 'yes', '2018-05-27 07:38:57', '0000-00-00 00:00:00'),
(325, 147, 'parent147', 'fuazaz', '147', 'parent', 'yes', '2018-05-27 07:38:57', '0000-00-00 00:00:00'),
(326, 148, 'std148', 'ltmqcj', '', 'student', 'yes', '2018-05-27 07:38:57', '0000-00-00 00:00:00'),
(327, 148, 'parent148', '9es24p', '148', 'parent', 'yes', '2018-05-27 07:38:57', '0000-00-00 00:00:00'),
(328, 149, 'std149', 'ofn57m', '', 'student', 'yes', '2018-05-27 07:38:57', '0000-00-00 00:00:00'),
(329, 149, 'parent149', '0dbdgv', '149', 'parent', 'yes', '2018-05-27 07:38:57', '0000-00-00 00:00:00'),
(330, 150, 'std150', '1hry7l', '', 'student', 'yes', '2018-05-27 07:38:57', '0000-00-00 00:00:00'),
(331, 150, 'parent150', 'rcwqdx', '150', 'parent', 'yes', '2018-05-27 07:38:57', '0000-00-00 00:00:00'),
(332, 151, 'std151', 'piuelq', '', 'student', 'yes', '2018-05-27 07:38:57', '0000-00-00 00:00:00'),
(333, 151, 'parent151', '1lnivu', '151', 'parent', 'yes', '2018-05-27 07:38:57', '0000-00-00 00:00:00'),
(334, 152, 'std152', '7xcoa2', '', 'student', 'yes', '2018-05-27 07:38:57', '0000-00-00 00:00:00'),
(335, 152, 'parent152', 'ji173l', '152', 'parent', 'yes', '2018-05-27 07:38:57', '0000-00-00 00:00:00'),
(336, 153, 'std153', 'aqr9wt', '', 'student', 'yes', '2018-05-27 07:38:57', '0000-00-00 00:00:00'),
(337, 153, 'parent153', 'ps1w9b', '153', 'parent', 'yes', '2018-05-27 07:38:57', '0000-00-00 00:00:00'),
(338, 154, 'std154', '0jbrf7', '', 'student', 'yes', '2018-06-01 08:52:54', '0000-00-00 00:00:00'),
(339, 154, 'parent154', 'lpn10x', '154', 'parent', 'yes', '2018-06-01 08:52:54', '0000-00-00 00:00:00'),
(340, 155, 'std155', 'zf7cb9', '', 'student', 'yes', '2018-06-04 18:43:21', '0000-00-00 00:00:00'),
(341, 155, 'parent155', 'ry7krx', '155', 'parent', 'yes', '2018-06-04 18:43:21', '0000-00-00 00:00:00'),
(342, 156, 'std156', '3iwn1e', '', 'student', 'yes', '2018-06-04 18:57:49', '0000-00-00 00:00:00'),
(343, 156, 'parent156', 'carf8k', '156', 'parent', 'yes', '2018-06-04 18:57:49', '0000-00-00 00:00:00'),
(344, 157, 'std157', 'k0necc', '', 'student', 'yes', '2018-06-07 17:27:29', '0000-00-00 00:00:00'),
(345, 157, 'parent157', 'd6fvki', '157', 'parent', 'yes', '2018-06-07 17:27:29', '0000-00-00 00:00:00'),
(346, 158, 'std158', '7l1lm6', '', 'student', 'no', '2018-07-26 11:12:04', '0000-00-00 00:00:00'),
(347, 158, 'parent158', 'ldv3qj', '158', 'parent', 'yes', '2018-07-17 15:34:21', '0000-00-00 00:00:00'),
(348, 159, 'std159', 'b0cdap', '', 'student', 'yes', '2018-07-17 15:35:36', '0000-00-00 00:00:00'),
(349, 159, 'parent159', '5nygze', '159', 'parent', 'yes', '2018-07-17 15:35:36', '0000-00-00 00:00:00'),
(350, 160, 'std160', 'waug0b', '', 'student', 'yes', '2018-07-17 15:36:40', '0000-00-00 00:00:00'),
(351, 160, 'parent160', 'emn8yf', '160', 'parent', 'yes', '2018-07-17 15:36:40', '0000-00-00 00:00:00'),
(352, 161, 'std161', 'az0hal', '', 'student', 'yes', '2018-07-18 06:58:08', '0000-00-00 00:00:00'),
(353, 161, 'parent161', '0tttas', '161', 'parent', 'yes', '2018-07-18 06:58:09', '0000-00-00 00:00:00'),
(354, 162, 'std162', 'wyj6uj', '', 'student', 'no', '2018-07-27 13:01:50', '0000-00-00 00:00:00'),
(355, 162, 'parent162', 'x5wwha', '162', 'parent', 'yes', '2018-07-19 07:20:49', '0000-00-00 00:00:00'),
(356, 163, 'std163', '73no8c', '', 'student', 'yes', '2018-07-19 10:08:38', '0000-00-00 00:00:00'),
(357, 163, 'parent163', 'glpfgj', '163', 'parent', 'yes', '2018-07-19 10:08:38', '0000-00-00 00:00:00'),
(358, 164, 'std164', 'q7aiqy', '', 'student', 'yes', '2018-07-19 16:33:35', '0000-00-00 00:00:00'),
(359, 164, 'parent164', 'qql1tx', '164', 'parent', 'yes', '2018-07-19 16:33:35', '0000-00-00 00:00:00'),
(360, 165, 'std165', 'jhmva3', '', 'student', 'yes', '2018-07-19 16:34:29', '0000-00-00 00:00:00'),
(361, 165, 'parent165', 'ksn2je', '165', 'parent', 'yes', '2018-07-19 16:34:29', '0000-00-00 00:00:00'),
(362, 166, 'std166', 'ubwy0h', '', 'student', 'no', '2018-07-28 13:13:24', '0000-00-00 00:00:00'),
(363, 166, 'parent166', 'lxb7ys', '166', 'parent', 'yes', '2018-07-21 13:23:40', '0000-00-00 00:00:00'),
(364, 167, 'std167', '9b1jqs', '', 'student', 'no', '2018-07-26 11:15:35', '0000-00-00 00:00:00'),
(365, 167, 'parent167', 'lar5n8', '167', 'parent', 'yes', '2018-07-24 09:23:35', '0000-00-00 00:00:00'),
(366, 168, 'std168', '5shelz', '', 'student', 'no', '2018-07-26 11:46:55', '0000-00-00 00:00:00'),
(367, 168, 'parent168', 'eml4od', '168', 'parent', 'yes', '2018-07-26 11:45:10', '0000-00-00 00:00:00'),
(368, 169, 'std169', 'frbsay', '', 'student', 'no', '2018-07-27 11:26:51', '0000-00-00 00:00:00'),
(369, 169, 'parent169', 'qog6w9', '169', 'parent', 'yes', '2018-07-27 11:25:23', '0000-00-00 00:00:00'),
(370, 170, 'std170', 'drbal9', '', 'student', 'no', '2018-07-28 13:10:07', '0000-00-00 00:00:00'),
(371, 170, 'parent170', '0haqkv', '170', 'parent', 'yes', '2018-07-28 06:28:57', '0000-00-00 00:00:00'),
(372, 171, 'std171', 'n49mz4', '', 'student', 'no', '2018-07-30 14:35:17', '0000-00-00 00:00:00'),
(373, 171, 'parent171', '2s152m', '171', 'parent', 'yes', '2018-07-30 14:30:53', '0000-00-00 00:00:00'),
(374, 172, 'std172', 'lozlqa', '', 'student', 'yes', '2018-07-31 06:38:01', '0000-00-00 00:00:00'),
(375, 172, 'parent172', 'puk3ao', '172', 'parent', 'yes', '2018-07-31 06:38:01', '0000-00-00 00:00:00'),
(376, 173, 'std173', '4xo16n', '', 'student', 'yes', '2018-08-01 12:08:17', '0000-00-00 00:00:00'),
(377, 173, 'parent173', 'ka18w2', '173', 'parent', 'yes', '2018-08-01 12:08:17', '0000-00-00 00:00:00'),
(379, 174, 'parent174', '31hfmz', '174', 'parent', 'yes', '2018-08-02 05:51:59', '0000-00-00 00:00:00'),
(381, 175, 'parent175', 'f2qi1n', '175', 'parent', 'yes', '2018-08-02 07:28:23', '0000-00-00 00:00:00'),
(383, 176, 'parent176', 'sy241t', '176', 'parent', 'yes', '2018-08-02 07:30:06', '0000-00-00 00:00:00'),
(384, 177, 'std177', '3h45eo', '', 'student', 'yes', '2018-08-02 10:46:12', '0000-00-00 00:00:00'),
(385, 177, 'parent177', '4k4l0a', '177', 'parent', 'yes', '2018-08-02 10:46:12', '0000-00-00 00:00:00'),
(386, 178, 'std178', 'qd88ev', '', 'student', 'yes', '2018-08-02 16:30:40', '0000-00-00 00:00:00'),
(387, 178, 'parent178', 'cpxwb7', '178', 'parent', 'yes', '2018-08-02 16:30:40', '0000-00-00 00:00:00'),
(388, 179, 'std179', 'wto29a', '', 'student', 'yes', '2018-08-03 07:57:01', '0000-00-00 00:00:00'),
(389, 179, 'parent179', 'fhg86t', '179', 'parent', 'yes', '2018-08-03 07:57:01', '0000-00-00 00:00:00'),
(390, 0, 'std0', 'ldt1j1', '', 'student', 'yes', '2018-08-03 08:02:46', '0000-00-00 00:00:00'),
(391, 0, 'parent0', 'ehth8r', '0', 'parent', 'yes', '2018-08-03 08:02:46', '0000-00-00 00:00:00'),
(392, 180, 'std180', '9ogdgg', '', 'student', 'yes', '2018-08-03 08:03:29', '0000-00-00 00:00:00'),
(393, 180, 'parent180', 'simptj', '180', 'parent', 'yes', '2018-08-03 08:03:29', '0000-00-00 00:00:00'),
(394, 181, 'std181', 'fe2bcp', '', 'student', 'yes', '2018-08-03 08:06:34', '0000-00-00 00:00:00'),
(395, 181, 'parent181', 'rl1bli', '181', 'parent', 'yes', '2018-08-03 08:06:34', '0000-00-00 00:00:00'),
(396, 182, 'std182', 'd19mnz', '', 'student', 'yes', '2018-08-03 09:09:55', '0000-00-00 00:00:00'),
(397, 182, 'parent182', 'bemb4c', '182', 'parent', 'yes', '2018-08-03 09:09:55', '0000-00-00 00:00:00'),
(398, 183, 'std183', '0lq1jm', '', 'student', 'yes', '2018-08-04 12:11:09', '0000-00-00 00:00:00'),
(399, 183, 'parent183', 'xvjhic', '183', 'parent', 'yes', '2018-08-04 12:11:09', '0000-00-00 00:00:00'),
(400, 184, 'std184', 'nf6guc', '', 'student', 'yes', '2018-08-06 18:21:25', '0000-00-00 00:00:00'),
(401, 184, 'parent184', 'iqgr35', '184', 'parent', 'yes', '2018-08-06 18:21:25', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `token` varchar(4000) NOT NULL,
  `user_type` varchar(200) NOT NULL,
  `login_date` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_routes`
--

CREATE TABLE `vehicle_routes` (
  `id` int(11) UNSIGNED NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indexes for table `fee_voucher_saved`
--
ALTER TABLE `fee_voucher_saved`
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
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_time_date`
--
ALTER TABLE `meeting_time_date`
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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `teach_assesment`
--
ALTER TABLE `teach_assesment`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `attendence_type`
--
ALTER TABLE `attendence_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_issues`
--
ALTER TABLE `book_issues`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `class_promotion_demotion`
--
ALTER TABLE `class_promotion_demotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `class_sections`
--
ALTER TABLE `class_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `class_section_monthly_logs`
--
ALTER TABLE `class_section_monthly_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `expense_head`
--
ALTER TABLE `expense_head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_groups`
--
ALTER TABLE `fee_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_groups_feetype`
--
ALTER TABLE `fee_groups_feetype`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_receipt_no`
--
ALTER TABLE `fee_receipt_no`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fee_session_groups`
--
ALTER TABLE `fee_session_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostel`
--
ALTER TABLE `hostel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostel_rooms`
--
ALTER TABLE `hostel_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_head`
--
ALTER TABLE `inventory_head`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory_items`
--
ALTER TABLE `inventory_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory_stock`
--
ALTER TABLE `inventory_stock`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `libarary_members`
--
ALTER TABLE `libarary_members`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `librarians`
--
ALTER TABLE `librarians`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `meeting_time_date`
--
ALTER TABLE `meeting_time_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `principal`
--
ALTER TABLE `principal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `read_notification`
--
ALTER TABLE `read_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `route_vehicles`
--
ALTER TABLE `route_vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `send_notification`
--
ALTER TABLE `send_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff_attendance`
--
ALTER TABLE `staff_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=861;

--
-- AUTO_INCREMENT for table `staff_departments`
--
ALTER TABLE `staff_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff_salary_payments`
--
ALTER TABLE `staff_salary_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `student_advance`
--
ALTER TABLE `student_advance`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `student_assessments`
--
ALTER TABLE `student_assessments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_attendences`
--
ALTER TABLE `student_attendences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_fees_discounts`
--
ALTER TABLE `student_fees_discounts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_fees_master`
--
ALTER TABLE `student_fees_master`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_fee_payments`
--
ALTER TABLE `student_fee_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `student_fee_payments_others`
--
ALTER TABLE `student_fee_payments_others`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=510;

--
-- AUTO_INCREMENT for table `student_fee_types`
--
ALTER TABLE `student_fee_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_fee_voucher`
--
ALTER TABLE `student_fee_voucher`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400;

--
-- AUTO_INCREMENT for table `student_fee_voucher_fee_types`
--
ALTER TABLE `student_fee_voucher_fee_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=389;

--
-- AUTO_INCREMENT for table `student_logs`
--
ALTER TABLE `student_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `student_session`
--
ALTER TABLE `student_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `teacher_attendance`
--
ALTER TABLE `teacher_attendance`
  MODIFY `teacher_attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2570;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_types`
--
ALTER TABLE `teacher_types`
  MODIFY `teacher_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teach_assesment`
--
ALTER TABLE `teach_assesment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `transport_route`
--
ALTER TABLE `transport_route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=402;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_routes`
--
ALTER TABLE `vehicle_routes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
