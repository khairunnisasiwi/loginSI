-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2018 at 08:02 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile` int(1) NOT NULL,
  `profile_name` char(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `min_pass_length` int(2) NOT NULL,
  `max_pass_length` int(2) NOT NULL,
  `min_uppercase` int(2) NOT NULL,
  `min_lowercase` int(2) NOT NULL,
  `min_numeric` int(2) NOT NULL,
  `min_special_char` int(2) NOT NULL,
  `expiry_pass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile`, `profile_name`, `description`, `min_pass_length`, `max_pass_length`, `min_uppercase`, `min_lowercase`, `min_numeric`, `min_special_char`, `expiry_pass`) VALUES
(0, 'default', NULL, 6, 25, 0, 0, 0, 0, 9999),
(1, 'keuangan', NULL, 8, 20, 1, 1, 1, 1, 60),
(2, 'pemasaran', NULL, 5, 25, 1, 0, 0, 0, 60);

-- --------------------------------------------------------

--
-- Table structure for table `profilerole`
--

CREATE TABLE `profilerole` (
  `profileID` int(25) NOT NULL,
  `role_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(3) NOT NULL,
  `rolename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `rolename`) VALUES
(1, 'employee'),
(2, 'customer'),
(3, 'supplier');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `sessionID` int(25) NOT NULL,
  `userid` int(6) NOT NULL,
  `logintime` date DEFAULT NULL,
  `logouttime` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `username` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `role` int(1) NOT NULL,
  `employee_number` int(5) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `userid` int(6) NOT NULL,
  `profileID` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `confirm` varchar(150) NOT NULL,
  `fullname` varchar(32) NOT NULL,
  `role` int(11) NOT NULL,
  `employee_number` int(11) DEFAULT '0',
  `profile` int(2) DEFAULT '0',
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `confirm`, `fullname`, `role`, `employee_number`, `profile`, `email`, `phone_number`, `address`) VALUES
(28, 'ica', 'eaad965a78022b95d37c3191e334472f', 'eaad965a78022b95d37c3191e334472f', 'ica', 1, 123, 0, 'ica', '123', 'as2'),
(29, 'rossi', 'b9cf343ac5bfead1f0ef00ae04866ffc', 'b9cf343ac5bfead1f0ef00ae04866ffc', 'rossi', 1, 1234, 0, 'rossi.rahmayani.rr@gmail.com', '1234567890', 'lorem'),
(30, 'tes123', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'Tes Tes', 1, 4563, 0, 'tes123@mail.com', '1234567890', 'lorem'),
(31, 'wwwww', 'c59ca4e7c6733ed9ea2635b799b9b164', 'c59ca4e7c6733ed9ea2635b799b9b164', 'abbbb', 1, 12121, 1, 'sasa2W@S', '212', '2ewd'),
(32, 'tesabc', '80a6c557b34b27e7dac1159744903f0b', '80a6c557b34b27e7dac1159744903f0b', 'abc34', 1, 987, 1, 'a@w', '345', '234'),
(33, 'mastur', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', 'mastur', 2, 0, 0, 'mas@tu.r', '343', '12 rt');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `userid` int(6) NOT NULL,
  `username` char(99) NOT NULL,
  `type` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `fullname` char(99) NOT NULL,
  `emp_number` int(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone_number` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile`);

--
-- Indexes for table `profilerole`
--
ALTER TABLE `profilerole`
  ADD KEY `profileID` (`profileID`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`sessionID`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD KEY `userid` (`userid`),
  ADD KEY `profileID` (`profileID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `user_table_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `userid` int(6) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `profilerole`
--
ALTER TABLE `profilerole`
  ADD CONSTRAINT `profilerole_ibfk_1` FOREIGN KEY (`profileID`) REFERENCES `profile` (`profile`),
  ADD CONSTRAINT `profilerole_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Constraints for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD CONSTRAINT `userprofile_ibfk_2` FOREIGN KEY (`profileID`) REFERENCES `profile` (`profile`);

--
-- Constraints for table `user_table`
--
ALTER TABLE `user_table`
  ADD CONSTRAINT `user_table_username` FOREIGN KEY (`username`) REFERENCES `signup` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
