-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2018 at 04:24 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `databaseojt`
--

-- --------------------------------------------------------

--
-- Table structure for table `attend`
--

CREATE TABLE `attend` (
  `attend_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attend`
--

INSERT INTO `attend` (`attend_id`, `user_id`, `schedule_id`) VALUES
(40, 2, 1),
(42, 6, 4),
(43, 3, 1),
(44, 4, 1),
(45, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_subject` varchar(250) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_status` int(1) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_subject`, `comment_text`, `comment_status`, `user_id`) VALUES
(47, 'Trend Micro', 'Your reserved exam schedule made some changes. Please re-check if it is an appropriate time for you.', 1, 2),
(48, 'Trend Micro', 'Your reserved exam schedule made some changes. Please re-check if it is an appropriate time for you.', 1, 3),
(49, 'Trend Micro', 'Your reserved exam schedule made some changes. Please re-check if it is an appropriate time for you.', 1, 4),
(50, 'Test', 'asdfghjkl', 1, 2),
(51, 'Test', 'QWERt', 1, 2),
(52, 'Test Again', 'Test again ...', 1, 0),
(53, 'Trend Micro', 'Your reserved exam schedule made some changes. Please re-check if it is an appropriate time for you.', 1, 2),
(54, 'Trend Micro', 'Your reserved exam schedule made some changes. Please re-check if it is an appropriate time for you.', 1, 3),
(55, 'Trend Micro', 'Your reserved exam schedule made some changes. Please re-check if it is an appropriate time for you.', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `phone` int(15) NOT NULL,
  `landline` int(9) NOT NULL,
  `archive` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `contact_name`, `phone`, `landline`, `archive`) VALUES
(1, 'Trend Micro', 'Sasuke', 123123123, 123123, '1'),
(2, 'Nokia', 'Test', 12324, 12312, '1');

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `list_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `room` varchar(255) NOT NULL,
  `archive` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `company_id`, `date`, `start_time`, `end_time`, `room`, `archive`) VALUES
(1, 1, '2018-05-18', '18:00:00', '19:00:00', 'D123', '1'),
(2, 1, '2018-05-18', '20:30:00', '21:30:00', 'D123', '0'),
(3, 2, '2018-05-18', '08:00:00', '09:00:00', 'C1', '0'),
(4, 2, '2018-05-18', '22:00:00', '23:00:00', 'D432', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `type`, `firstname`, `lastname`) VALUES
(1, 'admin', 'admin', 0, 'admin fname', 'admin lname'),
(2, '2151235@slu.edu.ph', '1234', 2, 'Darren Laluan', 'Sison'),
(3, 'kanor@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'Mang', 'Kanor'),
(4, 'tc@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'Tom', 'Cruz'),
(5, 'ew@gmail.com', '1234', 0, 'Emma', 'Watson'),
(6, 'bb@gmail.com', '1234', 2, 'Bruce', 'Banner'),
(7, 'imron@gmail.com', '1234', 2, 'Iron', 'Man');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attend`
--
ALTER TABLE `attend`
  ADD PRIMARY KEY (`attend_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`list_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attend`
--
ALTER TABLE `attend`
  MODIFY `attend_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
