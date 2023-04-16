-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2021 at 03:44 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dynamic_field`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb1`
--

CREATE TABLE `tb1` (
  `id` int(11) NOT NULL,
  `f1` varchar(250) NOT NULL,
  `f2` varchar(250) NOT NULL,
  `f3` varchar(250) NOT NULL,
  `f4` varchar(300) NOT NULL,
  `f5` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb1`
--

INSERT INTO `tb1` (`id`, `f1`, `f2`, `f3`, `f4`, `f5`) VALUES
(1, 'Antst', 'alert', 'vom', 'die', 'option2');

-- --------------------------------------------------------

--
-- Table structure for table `tb2`
--

CREATE TABLE `tb2` (
  `id` int(11) NOT NULL,
  `tb1_id` varchar(250) NOT NULL,
  `f1` varchar(250) NOT NULL,
  `f2` varchar(250) NOT NULL,
  `f3` varchar(250) NOT NULL,
  `f4` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb2`
--

INSERT INTO `tb2` (`id`, `tb1_id`, `f1`, `f2`, `f3`, `f4`) VALUES
(1, '1', 'dur', 'date', 'bis', 'std'),
(2, '1', 'dur2', 'date2', 'bis2', 'std2');

-- --------------------------------------------------------

--
-- Table structure for table `tb3`
--

CREATE TABLE `tb3` (
  `id` int(11) NOT NULL,
  `tb1_id` varchar(250) NOT NULL,
  `f1` varchar(250) NOT NULL,
  `f2` varchar(250) NOT NULL,
  `f3` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb3`
--

INSERT INTO `tb3` (`id`, `tb1_id`, `f1`, `f2`, `f3`) VALUES
(1, '1', 'mange', 'okay', 'art'),
(2, '1', 'art2', 'namge2', 'art2');

-- --------------------------------------------------------

--
-- Table structure for table `tb4`
--

CREATE TABLE `tb4` (
  `id` int(11) NOT NULL,
  `tb1_id` varchar(250) NOT NULL,
  `f1` varchar(250) NOT NULL,
  `f2` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb4`
--

INSERT INTO `tb4` (`id`, `tb1_id`, `f1`, `f2`) VALUES
(1, '1', 'offence', 'inter'),
(2, '1', 'offence2', 'inter2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb1`
--
ALTER TABLE `tb1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb2`
--
ALTER TABLE `tb2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb3`
--
ALTER TABLE `tb3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb4`
--
ALTER TABLE `tb4`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb1`
--
ALTER TABLE `tb1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb2`
--
ALTER TABLE `tb2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb3`
--
ALTER TABLE `tb3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb4`
--
ALTER TABLE `tb4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;