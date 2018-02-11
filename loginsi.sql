-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2018 at 07:31 AM
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
-- Table structure for table `action`
--

CREATE TABLE `action` (
  `action` int(2) NOT NULL,
  `action_name` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`action`, `action_name`) VALUES
(1, 'ADD'),
(2, 'UPDATE'),
(3, 'DELETE');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin` varchar(10) NOT NULL,
  `password` varchar(99) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latest_ip_addr` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin`, `password`, `last_login`, `latest_ip_addr`) VALUES
('admin', '25d55ad283aa400af464c76d713c07ad', '2018-01-19 08:27:42', '10.4.225.42');

-- --------------------------------------------------------

--
-- Table structure for table `approle`
--

CREATE TABLE `approle` (
  `app_id` int(50) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_link` varchar(255) NOT NULL,
  `employee` int(1) NOT NULL,
  `customer` int(1) NOT NULL,
  `supplier` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approle`
--

INSERT INTO `approle` (`app_id`, `app_name`, `app_link`, `employee`, `customer`, `supplier`) VALUES
(1, 'app1', 'app/app3.php', 1, 1, 1),
(2, 'app2', 'app/app1.php', 1, 1, 0),
(3, 'app3', 'https://www.semenindonesia.com', 1, 1, 0),
(8, 'Google Search', 'https://www.google.co.id/', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(99) NOT NULL,
  `user_id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '-',
  `role_id` int(2) NOT NULL,
  `rolename` varchar(30) NOT NULL DEFAULT '-',
  `profile_id` int(2) NOT NULL,
  `profile_name` varchar(30) NOT NULL DEFAULT '-',
  `date_change` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action` int(2) NOT NULL,
  `prev_value` varchar(99) NOT NULL DEFAULT 'none',
  `current_value` varchar(99) NOT NULL DEFAULT 'none',
  `changed_field` varchar(99) NOT NULL,
  `accessed_ip` varchar(15) NOT NULL,
  `hostname` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `user_id`, `username`, `role_id`, `rolename`, `profile_id`, `profile_name`, `date_change`, `action`, `prev_value`, `current_value`, `changed_field`, `accessed_ip`, `hostname`) VALUES
(1458, 158, 'usertest', 1, 'employee', 44, 'IT', '2018-01-31 05:58:18', 1, 'none', 'usertest', 'username', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp'),
(1459, 158, 'usertest', 1, 'employee', 44, 'IT', '2018-01-31 05:58:18', 1, 'none', '4fa839063c3ca5dfe629b6be0d148e54', 'password', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp'),
(1460, 158, 'usertest', 1, 'employee', 44, 'IT', '2018-01-31 05:58:18', 1, 'none', 'User Testing', 'fullname', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp'),
(1461, 158, 'usertest', 1, 'employee', 44, 'IT', '2018-01-31 05:58:18', 1, 'none', 'employee', 'role', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp'),
(1462, 158, 'usertest', 1, 'employee', 44, 'IT', '2018-01-31 05:58:18', 1, 'none', '3241', 'employee number', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp'),
(1463, 158, 'usertest', 1, 'employee', 44, 'IT', '2018-01-31 05:58:18', 1, 'none', 'IT', 'profile', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp'),
(1464, 158, 'usertest', 1, 'employee', 44, 'IT', '2018-01-31 05:58:18', 1, 'none', 'user@test.co', 'email', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp'),
(1465, 0, '-', 8, 'Employee', 0, '-', '2018-01-31 06:12:25', 2, 'NO', 'YES', 'mbah gugel', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp'),
(1466, 0, 'usertest', 0, 'employee', 0, 'IT', '2018-01-31 06:18:31', 2, 'user@test.co', '', 'E-mail', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp'),
(1467, 0, 'usertest', 0, 'employee', 0, 'IT', '2018-01-31 06:18:41', 2, '', 'user@test.co', 'E-mail', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp'),
(1468, 158, 'usertest', 1, 'employee', 44, 'IT', '2018-01-31 06:19:31', 2, 'none', 'rossi.rahmayani.rr@gmail.com', 'E-mail', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp'),
(1469, 158, 'usertest', 1, 'employee', 44, 'IT', '2018-01-31 06:19:31', 2, 'none', '107608150808264489221', 'Google id', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp'),
(1470, 0, '-', 1, 'Supplier', 0, '-', '2018-01-31 06:24:41', 2, 'NO', 'YES', 'app1', '', ''),
(1471, 0, '-', 0, '-', 2, 'Keuangan', '2018-01-31 06:24:57', 2, '0', '3', 'policy.min_lowercase', '', ''),
(1472, 159, 'usertest', 1, 'employee', 44, 'IT', '2018-01-31 06:30:52', 1, 'none', 'usertest', 'username', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp'),
(1473, 159, 'usertest', 1, 'employee', 44, 'IT', '2018-01-31 06:30:52', 1, 'none', '4fa839063c3ca5dfe629b6be0d148e54', 'password', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp'),
(1474, 159, 'usertest', 1, 'employee', 44, 'IT', '2018-01-31 06:30:52', 1, 'none', 'User Test', 'fullname', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp'),
(1475, 159, 'usertest', 1, 'employee', 44, 'IT', '2018-01-31 06:30:52', 1, 'none', 'employee', 'role', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp'),
(1476, 159, 'usertest', 1, 'employee', 44, 'IT', '2018-01-31 06:30:52', 1, 'none', '2314', 'employee number', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp'),
(1477, 159, 'usertest', 1, 'employee', 44, 'IT', '2018-01-31 06:30:52', 1, 'none', 'IT', 'profile', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp'),
(1478, 159, 'usertest', 1, 'employee', 44, 'IT', '2018-01-31 06:30:52', 1, 'none', 'user@test.co', 'email', '10.4.225.42', 'DESKTOP-VND6PSO.smig.corp');

-- --------------------------------------------------------

--
-- Table structure for table `policy`
--

CREATE TABLE `policy` (
  `policy` int(2) NOT NULL,
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
-- Dumping data for table `policy`
--

INSERT INTO `policy` (`policy`, `profile_name`, `description`, `min_pass_length`, `max_pass_length`, `min_uppercase`, `min_lowercase`, `min_numeric`, `min_special_char`, `expiry_pass`) VALUES
(1, 'Other', 'Lain-lain', 5, 30, 1, 2, 0, 1, 20),
(2, 'Keuangan', 'Bidang Keuangan', 8, 32, 1, 3, 1, 0, 15),
(5, 'Administrasi', '', 6, 32, 1, 0, 0, 0, 60),
(6, 'IT', '', 6, 32, 1, 1, 1, 1, 60);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `profile` int(11) NOT NULL,
  `profile_name` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`profile`, `profile_name`, `description`) VALUES
(1, 'Other', 'others'),
(2, 'Keuangan', 'Bidang Keuangann'),
(3, 'Administrasi', 'bidang administrasi'),
(44, 'IT', 'Bagian It');

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `day_remind` int(2) NOT NULL,
  `reminder_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`day_remind`, `reminder_name`) VALUES
(1, 'Besok'),
(3, '3 hari lagi'),
(5, '5 hari lagi'),
(7, '1 minggu lagi');

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `tipe_login` varchar(32) NOT NULL DEFAULT 'Lokal',
  `google_id` decimal(21,0) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL DEFAULT 'N/A',
  `confirm` varchar(150) NOT NULL DEFAULT 'N/A',
  `fullname` varchar(32) NOT NULL,
  `role` int(11) NOT NULL,
  `employee_number` int(11) DEFAULT '0',
  `profile` int(2) DEFAULT '0',
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL DEFAULT 'unknown',
  `address` varchar(50) NOT NULL DEFAULT 'unknown',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_password_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_password_expiry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `latest_ip_addr` varchar(15) NOT NULL,
  `ldap_mapping` varchar(99) NOT NULL,
  `ad_mapping` varchar(99) NOT NULL,
  `google_link` varchar(60) NOT NULL,
  `google_picture_link` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `tipe_login`, `google_id`, `username`, `password`, `confirm`, `fullname`, `role`, `employee_number`, `profile`, `email`, `phone_number`, `address`, `date_created`, `date_password_created`, `date_password_expiry`, `last_login`, `latest_ip_addr`, `ldap_mapping`, `ad_mapping`, `google_link`, `google_picture_link`) VALUES
(159, 'Lokal', '0', 'usertest', '4fa839063c3ca5dfe629b6be0d148e54', '4fa839063c3ca5dfe629b6be0d148e54', 'User Test', 1, 2314, 44, 'user@test.co', '089726394135', 'jl jawa no 3', '2018-01-31 06:30:52', '2018-01-31 06:30:52', '2018-04-01 06:30:52', '0000-00-00 00:00:00', '10.4.225.42', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`action`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `admin` (`admin`);

--
-- Indexes for table `approle`
--
ALTER TABLE `approle`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `policy`
--
ALTER TABLE `policy`
  ADD PRIMARY KEY (`policy`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profile`);

--
-- Indexes for table `reminder`
--
ALTER TABLE `reminder`
  ADD PRIMARY KEY (`day_remind`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approle`
--
ALTER TABLE `approle`
  MODIFY `app_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1479;
--
-- AUTO_INCREMENT for table `policy`
--
ALTER TABLE `policy`
  MODIFY `policy` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `profile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
