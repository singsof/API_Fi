-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2022 at 04:09 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fish`
--

-- --------------------------------------------------------

--
-- Table structure for table `esp8266`
--

CREATE TABLE `esp8266` (
  `id` int(11) NOT NULL,
  `id_ir` int(11) NOT NULL,
  `pH` float NOT NULL,
  `day` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `esp8266`
--

INSERT INTO `esp8266` (`id`, `id_ir`, `pH`, `day`) VALUES
(2, 4, 6, '2022-10-23 13:29:47'),
(3, 5, 2, '2022-10-23 13:30:07'),
(4, 6, 2, '2022-10-23 13:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `ir`
--

CREATE TABLE `ir` (
  `id_ir` int(11) NOT NULL,
  `ir` int(11) NOT NULL,
  `date_ir` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ir`
--

INSERT INTO `ir` (`id_ir`, `ir`, `date_ir`) VALUES
(1, 0, '2022-10-23 13:21:24'),
(2, 0, '2022-10-23 13:25:59'),
(3, 0, '2022-10-23 13:29:37'),
(4, 0, '2022-10-23 13:29:47'),
(5, 0, '2022-10-23 13:30:07'),
(6, 0, '2022-10-23 13:43:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `esp8266`
--
ALTER TABLE `esp8266`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sdf` (`id_ir`);

--
-- Indexes for table `ir`
--
ALTER TABLE `ir`
  ADD PRIMARY KEY (`id_ir`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `esp8266`
--
ALTER TABLE `esp8266`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ir`
--
ALTER TABLE `ir`
  MODIFY `id_ir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `esp8266`
--
ALTER TABLE `esp8266`
  ADD CONSTRAINT `sdf` FOREIGN KEY (`id_ir`) REFERENCES `ir` (`id_ir`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
