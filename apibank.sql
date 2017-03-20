-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2017 at 08:48 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apibank`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cnp` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `name`, `cnp`) VALUES
(8, 'tester3', 2),
(59, 'test2', 1),
(60, 'test3', 1),
(73, 'testcustomer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1489586191),
('m130524_201442_init', 1489586194);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transactionId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `amount` float NOT NULL,
  `date` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionId`, `customerId`, `amount`, `date`) VALUES
(2, 2, 150, '1489742062'),
(3, 2, 300, '1489742147'),
(4, 2, 133, '1489747332'),
(5, 3, 150, '1489745062'),
(6, 1, 333, '1489752536'),
(8, 8, 5880, '1489754396'),
(9, 8, 5880, '1489756208'),
(10, 5, 777, '1489828808'),
(14, 7, 7, '1489852122'),
(15, 7, 7, '1489852269'),
(16, 8, 7, '1489852282'),
(17, 8, 7, '1489852360'),
(18, 8, 7, '1489852390'),
(19, 8, 7, '1489852419'),
(20, 8, 7, '1489852509'),
(21, 8, 7, '1489852526'),
(22, 8, 7, '1489852568'),
(23, 8, 7, '1489852587'),
(24, 8, 7, '1489852606'),
(25, 8, 7, '1489852626'),
(26, 8, 7, '1489852705'),
(27, 8, 7, '1489852716'),
(28, 8, 7, '1489852733'),
(29, 8, 7, '1489852788'),
(30, 8, 7, '1489852872'),
(31, 8, 7, '1489852967'),
(32, 8, 7, '1489853018'),
(33, 8, 7, '1489853028'),
(34, 8, 7, '1489853066'),
(35, 8, 7, '1489853100'),
(36, 8, 7, '1489853135'),
(37, 8, 7, '1489853149'),
(38, 60, 71, '1489853186'),
(39, 60, 71, '1489853264'),
(40, 60, 72, '1489853318'),
(44, 73, 115, '1489929889');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(8, 'tester3', 'bb3Wie7qfROqZb5vdmIShrHI4toDkF5j', '$2y$13$z4a.1LzqIJ3eHuhmIO2Q3Ouyw1tgnmVW9.GL4V6cPln9lfs55dkDi', NULL, 'tester3@ya.ru', 10, 1489873797, 1489873797),
(59, 'test2', 'ohsz172G0XsAZ88GEXYsRvdemRDSQkZT', '$2y$13$5yw3RBgRc5j8f/wd0M4cEeYZUdFUtVsIExJCJiRFxaqS4v2.L8Zbi', NULL, 'test2@ya.ru', 10, 1489914478, 1489914478),
(60, 'test3', 'gaMY4sMK_QPiTTIPXlGK61w8fLnta5-g', '$2y$13$FT/H93oULFPghXdX3KKn/O6LFx0vXG3gRVXHLaddSReSEVsEiy3XG', NULL, 'test3@ya.ru', 10, 1489914526, 1489914526),
(73, 'testcustomer', '9dwVxuYxDJXOyRfcDBXIQafT9XhL6kfE', '$2y$13$nDKiSxX9kEF3dPOXYVP7neDywrdIs7g03fZRlZMnPcXlG8FfFosne', NULL, 'testcustomer@ya.ru', 10, 1489929010, 1489929010);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
