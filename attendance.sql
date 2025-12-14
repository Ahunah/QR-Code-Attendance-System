-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2025 at 12:08 PM
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
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_records`
--

CREATE TABLE `attendance_records` (
  `id` int(11) NOT NULL,
  `attendance_code` varchar(50) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `location_x` decimal(10,6) NOT NULL,
  `location_y` decimal(10,6) NOT NULL,
  `save_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_records`
--

INSERT INTO `attendance_records` (`id`, `attendance_code`, `student_id`, `student_name`, `location_x`, `location_y`, `save_at`, `created_at`) VALUES
(66, '30419694121', 'ict320', 'leena', 7.389643, 81.842074, '2025-09-03 09:34:18', '2025-09-03 16:04:26'),
(67, '30419694121', 'ict123', 'dhima rani', 7.388601, 81.840025, '2025-09-17 10:15:21', '2025-09-17 16:45:21'),
(68, '30419694121', 'ict320', 'Ahunah', 7.389368, 81.841485, '2025-12-14 04:01:35', '2025-12-14 10:31:36');

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `id` int(11) NOT NULL,
  `no` varchar(20) NOT NULL,
  `unic_id` varchar(50) NOT NULL,
  `lecture_details` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`id`, `no`, `unic_id`, `lecture_details`, `start_datetime`, `end_datetime`, `created_at`, `updated_at`) VALUES
(40, '', '30419694121', 'Software Engineering', '2025-09-03 20:33:00', '2025-09-03 22:32:00', '2025-09-03 15:02:24', '2025-09-03 15:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `lecture_records`
--

CREATE TABLE `lecture_records` (
  `no` int(11) NOT NULL,
  `Lecture_id` varchar(50) NOT NULL,
  `save_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `studentid` text NOT NULL,
  `password` text NOT NULL,
  `conpassword` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`id`, `username`, `studentid`, `password`, `conpassword`) VALUES
(1, 'leena', 'ict320', '1234', '1234'),
(8, 'dhima rani', 'ict123', '1234', '1234'),
(10, 'Ahunah ', 'ict320', '123456', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `NO` int(12) NOT NULL,
  `ID` varchar(12) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PW` varchar(124) NOT NULL,
  `STATUS` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`NO`, `ID`, `USERNAME`, `PW`, `STATUS`) VALUES
(10, 's123', 'leena', 's123', 'logged_in'),
(12, 's100', 'meera', '1234', 'logged_in');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_records`
--
ALTER TABLE `attendance_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecture_records`
--
ALTER TABLE `lecture_records`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`NO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_records`
--
ALTER TABLE `attendance_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `lecture_records`
--
ALTER TABLE `lecture_records`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `NO` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
