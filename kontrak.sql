-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2017 at 09:12 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kontrak`
--
CREATE DATABASE IF NOT EXISTS `kontrak` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `kontrak`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--
-- Creation: Jun 24, 2017 at 06:02 PM
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(2) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--
-- Creation: Jul 09, 2017 at 05:47 AM
--

DROP TABLE IF EXISTS `contract`;
CREATE TABLE `contract` (
  `contract_no` varchar(12) NOT NULL,
  `type_id` varchar(20) NOT NULL,
  `category_id` int(2) NOT NULL,
  `description` text NOT NULL,
  `date_of_agreement` date NOT NULL,
  `language_id` int(2) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `country_id` int(2) NOT NULL,
  `life_of_contract` double(4,2) NOT NULL,
  `vendor_id` int(12) NOT NULL,
  `sdm_id` int(12) NOT NULL,
  `sdm_remarks` text NOT NULL,
  `currency_id` int(2) NOT NULL,
  `annual_spend` int(12) NOT NULL,
  `payment_terms` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `expiration_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--
-- Creation: Jun 24, 2017 at 06:16 PM
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `country_id` int(2) NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--
-- Creation: Jun 24, 2017 at 06:25 PM
--

DROP TABLE IF EXISTS `currency`;
CREATE TABLE `currency` (
  `currency_id` int(2) NOT NULL,
  `currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expiration`
--
-- Creation: Jul 24, 2017 at 08:53 AM
--

DROP TABLE IF EXISTS `expiration`;
CREATE TABLE `expiration` (
  `expiration_id` int(11) NOT NULL,
  `contract_no` varchar(12) NOT NULL,
  `date` date NOT NULL,
  `status_days` int(4) NOT NULL,
  `renewal_provision_id` int(2) NOT NULL,
  `termination_rights` text NOT NULL,
  `assignment_provision` text NOT NULL,
  `notified` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--
-- Creation: Jul 09, 2017 at 06:01 AM
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `id` int(12) NOT NULL,
  `contract_no` varchar(12) NOT NULL,
  `description` text NOT NULL,
  `file` text NOT NULL,
  `amount` int(12) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--
-- Creation: Jul 23, 2017 at 05:11 PM
--

DROP TABLE IF EXISTS `issues`;
CREATE TABLE `issues` (
  `id` int(12) NOT NULL,
  `contract_no` varchar(12) NOT NULL,
  `subject` text NOT NULL,
  `description` text NOT NULL,
  `issuer_name` varchar(255) NOT NULL,
  `issuer_role` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--
-- Creation: Jun 24, 2017 at 06:03 PM
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `language_id` int(2) NOT NULL,
  `language` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notice_period`
--
-- Creation: Jul 09, 2017 at 08:21 AM
--

DROP TABLE IF EXISTS `notice_period`;
CREATE TABLE `notice_period` (
  `id` int(11) NOT NULL,
  `contract_no` varchar(12) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--
-- Creation: Jul 24, 2017 at 09:13 AM
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `contract_no` varchar(12) NOT NULL,
  `status` int(1) NOT NULL,
  `notification_text` text NOT NULL,
  `viewed` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `renewal_provision`
--
-- Creation: Jun 24, 2017 at 06:31 PM
--

DROP TABLE IF EXISTS `renewal_provision`;
CREATE TABLE `renewal_provision` (
  `renewal_provision_id` int(2) NOT NULL,
  `renewal_provision` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--
-- Creation: Jul 09, 2017 at 09:02 AM
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `contract_no` varchar(12) NOT NULL,
  `reviewer_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `reviewer_comments` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_delivery_manager`
--
-- Creation: Jun 24, 2017 at 06:19 PM
--

DROP TABLE IF EXISTS `service_delivery_manager`;
CREATE TABLE `service_delivery_manager` (
  `sdm_id` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--
-- Creation: Jun 24, 2017 at 06:00 PM
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `type_id` int(2) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Jun 24, 2017 at 06:35 PM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(42) NOT NULL,
  `role_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--
-- Creation: Jun 24, 2017 at 05:58 PM
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE `vendor` (
  `vendor_id` int(12) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD UNIQUE KEY `contract_no` (`contract_no`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `expiration`
--
ALTER TABLE `expiration`
  ADD PRIMARY KEY (`expiration_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `notice_period`
--
ALTER TABLE `notice_period`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`contract_no`);

--
-- Indexes for table `renewal_provision`
--
ALTER TABLE `renewal_provision`
  ADD PRIMARY KEY (`renewal_provision_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_delivery_manager`
--
ALTER TABLE `service_delivery_manager`
  ADD PRIMARY KEY (`sdm_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`),
  ADD UNIQUE KEY `vendor` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `currency_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `expiration`
--
ALTER TABLE `expiration`
  MODIFY `expiration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `language_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notice_period`
--
ALTER TABLE `notice_period`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `renewal_provision`
--
ALTER TABLE `renewal_provision`
  MODIFY `renewal_provision_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `service_delivery_manager`
--
ALTER TABLE `service_delivery_manager`
  MODIFY `sdm_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
