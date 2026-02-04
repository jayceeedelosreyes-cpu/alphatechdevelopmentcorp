-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql112.byetcluster.com
-- Generation Time: Feb 03, 2026 at 01:52 AM
-- Server version: 11.4.9-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_41058020_pds_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `pds_submissions`
--

CREATE TABLE `pds_submissions` (
  `id` int(11) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `maiden_name` varchar(50) DEFAULT NULL,
  `present_address` varchar(50) DEFAULT NULL,
  `permanent_address` varchar(50) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `cellphone` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `height` varchar(50) DEFAULT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `birthplace` varchar(50) DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `citizenship` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `sss_no` varchar(50) DEFAULT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `philhealth` varchar(30) DEFAULT NULL,
  `pagibig` varchar(50) DEFAULT NULL,
  `father_name` varchar(50) DEFAULT NULL,
  `father_occupation` varchar(50) DEFAULT NULL,
  `mother_name` varchar(50) NOT NULL,
  `mother_occupation` varchar(50) NOT NULL,
  `spouse_name` varchar(50) NOT NULL,
  `spouse_occupation` varchar(50) NOT NULL,
  `elementary_school` varchar(50) NOT NULL,
  `elementary_dates` varchar(50) DEFAULT NULL,
  `elementary_honors` varchar(50) DEFAULT NULL,
  `secondary_school` varchar(50) DEFAULT NULL,
  `secondary_dates` varchar(50) DEFAULT NULL,
  `secondary_honors` varchar(50) DEFAULT NULL,
  `tertiary_school` varchar(50) DEFAULT NULL,
  `tertiary_dates` varchar(50) DEFAULT NULL,
  `tertiary_honors` varchar(50) DEFAULT NULL,
  `employer1` varchar(100) DEFAULT NULL,
  `position1` varchar(50) DEFAULT NULL,
  `dates1` varchar(50) DEFAULT NULL,
  `salary1` varchar(50) DEFAULT NULL,
  `reason1` varchar(100) DEFAULT NULL,
  `employer2` varchar(100) DEFAULT NULL,
  `position2` varchar(50) DEFAULT NULL,
  `dates2` varchar(50) DEFAULT NULL,
  `salary2` varchar(50) DEFAULT NULL,
  `reason2` varchar(100) DEFAULT NULL,
  `special_condition` varchar(10) NOT NULL,
  `special_condition_details` text DEFAULT NULL,
  `past_illness` varchar(255) DEFAULT NULL,
  `past_illness_details` text DEFAULT NULL,
  `allergic` tinyint(4) NOT NULL,
  `cardio` tinyint(4) NOT NULL,
  `pulmonary` tinyint(4) NOT NULL,
  `gastro` tinyint(4) NOT NULL,
  `musculo` tinyint(4) NOT NULL,
  `vision` tinyint(4) NOT NULL,
  `none` tinyint(4) NOT NULL,
  `medical_details` text DEFAULT NULL,
  `submission_date` int(11) DEFAULT NULL,
  `signature` varchar(60) DEFAULT NULL,
  `submission_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pds_submissions`
--
ALTER TABLE `pds_submissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pds_submissions`
--
ALTER TABLE `pds_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
