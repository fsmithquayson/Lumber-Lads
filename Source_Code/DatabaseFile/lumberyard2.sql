-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2016 at 02:32 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lumberyard`
--

-- --------------------------------------------------------

--
-- Table structure for table `currentlumber`
--

CREATE TABLE `currentlumber` (
  `WIDTH` int(11) NOT NULL,
  `HEIGHT` int(11) NOT NULL,
  `LENGTH` int(11) NOT NULL,
  `DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PRICE` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='TABLE IS FOR UPLOADING LUMBER VALUES';

--
-- Dumping data for table `currentlumber`
--

INSERT INTO `currentlumber` (`WIDTH`, `HEIGHT`, `LENGTH`, `DATE`, `PRICE`) VALUES
(2, 4, 96, '2016-10-22 17:25:29', 3),
(2, 6, 96, '2016-10-22 17:25:29', 4),
(1, 6, 96, '2016-10-22 17:25:29', 2),
(2, 4, 96, '2016-10-22 17:27:42', 3),
(2, 6, 96, '2016-10-22 17:27:42', 4),
(1, 6, 96, '2016-10-22 17:27:42', 2),
(2, 4, 96, '2016-10-22 17:28:28', 3.5),
(2, 6, 96, '2016-10-22 17:28:28', 4.25),
(1, 6, 96, '2016-10-22 17:28:28', 2.25),
(2, 4, 96, '2016-10-22 22:13:27', 3.5),
(2, 6, 96, '2016-10-22 22:13:27', 4.25),
(1, 6, 96, '2016-10-22 22:13:27', 2.25);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `TYPE` varchar(15) NOT NULL,
  `count` int(11) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `totalWorth` decimal(5,2) DEFAULT NULL,
  `DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`TYPE`, `count`, `price`, `totalWorth`, `DATE`) VALUES
('1x10', 82, '2.20', NULL, '2016-11-14 23:16:58'),
('1x12', 179, '3.00', NULL, '2016-11-14 23:16:58'),
('1x2', 0, '3.00', NULL, '2016-11-14 23:11:07'),
('1x3', 175, '4.00', NULL, '2016-11-14 23:16:58'),
('1x4', 184, '1.00', NULL, '2016-11-14 23:16:58'),
('1x6', 181, '1.00', NULL, '2016-11-14 23:16:58'),
('1x8', 178, '3.20', NULL, '2016-11-14 23:16:58'),
('2x10', 175, '3.00', NULL, '2016-11-14 23:18:37'),
('2x12', 172, '3.20', NULL, '2016-11-14 23:18:37'),
('2x2', 169, '3.00', NULL, '2016-11-14 23:16:58'),
('2x3', 166, '3.00', NULL, '2016-11-14 23:16:58'),
('2X4', 163, '3.00', '399.00', '2016-11-13 17:37:52'),
('2X6', 160, '2.75', '412.50', '2016-11-13 17:42:36'),
('2x8', 157, '1.10', NULL, '2016-11-14 23:18:37'),
('4x4', 154, '3.70', NULL, '2016-11-14 23:18:37'),
('4x6', 151, '3.00', NULL, '2016-11-14 23:18:37'),
('6x6', 148, '3.30', NULL, '2016-11-14 23:18:37'),
('8x8', 145, '5.20', NULL, '2016-11-14 23:18:37');

-- --------------------------------------------------------

--
-- Table structure for table `inventoryreceipts`
--

CREATE TABLE `inventoryreceipts` (
  `id` int(11) NOT NULL,
  `orderNumber` int(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `count` int(11) NOT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `total` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventoryreceipts`
--

INSERT INTO `inventoryreceipts` (`id`, `orderNumber`, `type`, `count`, `price`, `total`) VALUES
(11, 0, '1x10', 49, '2.20', '22.00'),
(12, 0, '1x10', 39, '2.20', '2.20'),
(13, 0, '1x10', 38, '2.20', '2.20'),
(14, 0, '1x10', 37, '2.20', '2.20'),
(15, 0, '1x10', 36, '2.20', '22.00'),
(16, 0, '1x10', 26, '2.20', '2.20'),
(17, 0, '1x10', 25, '2.20', '2.20'),
(18, 0, '1x10', 24, '2.20', '2.20'),
(19, 4, '1x10', 23, '2.20', '2.20'),
(20, 4, '1x12', 190, '3.00', '3.00'),
(21, 4, '1x2', 100, '3.00', '3.00'),
(22, 4, '1x3', 200, '4.00', '4.00'),
(23, 4, '1x4', 200, '1.00', '1.00'),
(24, 4, '1x6', 200, '1.00', '1.00'),
(25, 4, '1x8', 200, '3.20', '3.20'),
(26, 4, '2x10', 200, '3.00', '3.00'),
(27, 4, '2x12', 200, '3.20', '3.20'),
(28, 4, '2x2', 200, '3.00', '3.00'),
(29, 4, '2x3', 200, '3.00', '3.00'),
(30, 4, '2X4', 200, '3.00', '3.00'),
(31, 4, '2X6', 200, '2.75', '2.75'),
(32, 4, '2x8', 200, '1.10', '1.10'),
(33, 4, '4x4', 200, '3.70', '3.70'),
(34, 4, '4x6', 200, '3.00', '3.00'),
(35, 4, '6x6', 200, '3.30', '3.30'),
(36, 4, '8x8', 200, '5.20', '5.20'),
(37, 5, '1x10', 22, '2.20', '2.20'),
(38, 5, '1x12', 190, '3.00', '6.00'),
(39, 5, '1x2', 100, '3.00', '9.00'),
(40, 5, '1x3', 200, '4.00', '16.00'),
(41, 5, '1x4', 200, '1.00', '5.00'),
(42, 5, '1x6', 200, '1.00', '6.00'),
(43, 5, '1x8', 200, '3.20', '22.40'),
(44, 5, '2x10', 200, '3.00', '24.00'),
(45, 5, '2x12', 200, '3.20', '28.80'),
(46, 5, '2x2', 200, '3.00', '30.00'),
(47, 5, '2x3', 200, '3.00', '33.00'),
(48, 5, '2X4', 200, '3.00', '36.00'),
(49, 5, '2X6', 200, '2.75', '35.75'),
(50, 5, '2x8', 200, '1.10', '15.40'),
(51, 5, '4x4', 200, '3.70', '55.50'),
(52, 5, '4x6', 200, '3.00', '48.00'),
(53, 5, '6x6', 200, '3.30', '56.10'),
(54, 5, '8x8', 200, '5.20', '93.60'),
(55, 6, '1x10', 21, '2.20', '4.40'),
(56, 6, '1x12', 188, '3.00', '6.00'),
(57, 6, '1x2', 97, '3.00', '12.00'),
(58, 6, '1x3', 196, '4.00', '48.00'),
(59, 7, '1x10', 19, '2.20', '2.20'),
(60, 8, '1x10', 18, '2.20', '2.20'),
(61, 9, '1x2', 93, '3.00', '9.00'),
(62, 10, '1x10', 17, '2.20', '2.20'),
(63, 11, '1x10', 16, '2.20', '6.60'),
(64, 12, '1x10', 2, '2.20', '0.00'),
(65, 13, '1x10', 7, '2.20', '11.00'),
(66, 14, '1x10', 0, '2.20', '0.00'),
(67, 14, '1x12', 186, '3.00', '6.00'),
(68, 14, '1x2', 90, '3.00', '9.00'),
(69, 14, '1x3', 184, '4.00', '16.00'),
(70, 14, '1x4', 195, '1.00', '5.00'),
(71, 14, '1x6', 194, '1.00', '6.00'),
(72, 14, '1x8', 193, '3.20', '22.40'),
(73, 14, '2x10', 192, '3.00', '24.00'),
(74, 14, '2x12', 191, '3.20', '28.80'),
(75, 14, '2x2', 190, '3.00', '30.00'),
(76, 14, '2x3', 189, '3.00', '33.00'),
(77, 14, '2X4', 188, '3.00', '36.00'),
(78, 14, '2X6', 187, '2.75', '35.75'),
(79, 14, '2x8', 186, '1.10', '15.40'),
(80, 14, '4x4', 185, '3.70', '55.50'),
(81, 14, '4x6', 184, '3.00', '48.00'),
(82, 14, '6x6', 183, '3.30', '56.10'),
(83, 14, '8x8', 182, '5.20', '93.60'),
(84, 15, '1x10', 0, '2.20', '0.00'),
(85, 15, '1x12', 2, '3.00', '6.00'),
(86, 15, '1x2', 3, '3.00', '9.00'),
(87, 15, '1x3', 4, '4.00', '16.00'),
(88, 15, '1x4', 5, '1.00', '5.00'),
(89, 15, '1x6', 6, '1.00', '6.00'),
(90, 15, '1x8', 7, '3.20', '22.40'),
(91, 15, '2x10', 8, '3.00', '24.00'),
(92, 15, '2x12', 9, '3.20', '28.80'),
(93, 15, '2x2', 10, '3.00', '30.00'),
(94, 15, '2x3', 11, '3.00', '33.00'),
(95, 15, '2X4', 12, '3.00', '36.00'),
(96, 15, '2X6', 13, '2.75', '35.75'),
(97, 15, '2x8', 14, '1.10', '15.40'),
(98, 15, '4x4', 15, '3.70', '55.50'),
(99, 15, '4x6', 16, '3.00', '48.00'),
(100, 15, '6x6', 17, '3.30', '56.10'),
(101, 15, '8x8', 18, '5.20', '93.60'),
(102, 16, '', 0, '0.00', '0.00'),
(103, 16, '', 1, '0.00', '2.20'),
(104, 16, '', 1, '0.00', '2.20'),
(105, 16, '', 2, '0.00', '4.40'),
(106, 16, '', 2, '0.00', '4.40'),
(107, 16, '', 1, '0.00', '2.20'),
(108, 16, '', 1, '0.00', '2.20'),
(109, 16, '1x10', 1, '2.20', '2.20'),
(110, 16, '1x10', 4, '2.20', '8.80'),
(111, 16, '1x10', 1, '2.20', '2.20'),
(112, 17, '1x10', 1, '2.20', '2.20'),
(113, 18, '1x10', 1, '2.20', '2.20'),
(114, 19, '1x10', 1, '2.20', '2.20'),
(115, 19, '1x12', 1, '3.00', '3.00'),
(116, 19, '1x2', 1, '3.00', '3.00'),
(117, 19, '1x3', 1, '4.00', '4.00'),
(118, 19, '1x4', 1, '1.00', '1.00'),
(119, 19, '1x6', 1, '1.00', '1.00'),
(120, 19, '1x8', 1, '3.20', '3.20'),
(121, 19, '2x10', 1, '3.00', '3.00'),
(122, 19, '2x12', 1, '3.20', '3.20'),
(123, 19, '2x2', 1, '3.00', '3.00'),
(124, 19, '2x3', 1, '3.00', '3.00'),
(125, 19, '2X4', 1, '3.00', '3.00'),
(126, 19, '2X6', 1, '2.75', '2.75'),
(127, 19, '2x8', 1, '1.10', '1.10'),
(128, 19, '4x4', 1, '3.70', '3.70'),
(129, 19, '4x6', 1, '3.00', '3.00'),
(130, 19, '6x6', 1, '3.30', '3.30'),
(131, 19, '8x8', 1, '5.20', '5.20'),
(132, 20, '1x10', 1, '2.20', '2.20'),
(133, 20, '1x12', 2, '3.00', '6.00'),
(134, 20, '', 0, '0.00', '249.00');

-- --------------------------------------------------------

--
-- Table structure for table `logdemensions`
--

CREATE TABLE `logdemensions` (
  `WIDTH` int(11) NOT NULL,
  `HEIGHT` int(11) NOT NULL,
  `LENGTH` int(11) NOT NULL,
  `DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='DEMENSIONS OF CUT LOGS';

--
-- Dumping data for table `logdemensions`
--

INSERT INTO `logdemensions` (`WIDTH`, `HEIGHT`, `LENGTH`, `DATE`) VALUES
(12, 12, 96, '2016-10-22 17:27:42'),
(12, 12, 96, '2016-10-22 17:27:42'),
(12, 12, 96, '2016-10-22 17:27:42'),
(12, 12, 96, '2016-10-22 17:28:28'),
(12, 12, 96, '2016-10-22 17:28:28'),
(12, 12, 96, '2016-10-22 17:28:28'),
(12, 12, 96, '2016-10-22 22:13:27'),
(12, 12, 96, '2016-10-22 22:13:27'),
(12, 12, 96, '2016-10-22 22:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL,
  `orderNumber` int(10) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `Address` varchar(45) DEFAULT NULL,
  `City` varchar(45) DEFAULT NULL,
  `State` varchar(2) DEFAULT NULL,
  `Zip_Code` varchar(15) DEFAULT NULL,
  `DATE` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `orderNumber`, `firstName`, `lastName`, `Address`, `City`, `State`, `Zip_Code`, `DATE`) VALUES
(19, 2, 'casdf', 'asdasd', 'asdasd', 'Quitman', 'GA', '123', '2016-11-14 22:13:00'),
(28, 3, 'asdasd', 'asd', 'asdasd', 'Quitman', 'GA', '1231', '2016-11-15 00:18:23'),
(29, 4, 'asdasd', 'asdasd', 'asdasd', 'Quitman', 'GA', '1231', '2016-11-15 03:26:02'),
(30, 4, 'asdasd', 'asdasd', 'asdasd', 'Quitman', 'GA', '1231', '2016-11-15 03:26:02'),
(31, 4, 'asdasd', 'asdasd', 'asdasd', 'Quitman', 'GA', '1231', '2016-11-15 03:26:02'),
(32, 4, 'asdasd', 'asdasd', 'asdasd', 'Quitman', 'GA', '1231', '2016-11-15 03:26:02'),
(33, 4, 'asdasd', 'asdasd', 'asdasd', 'Quitman', 'GA', '1231', '2016-11-15 03:26:02'),
(34, 4, 'asdasd', 'asdasd', 'asdasd', 'Quitman', 'GA', '1231', '2016-11-15 03:26:02'),
(35, 4, 'asdasd', 'asdasd', 'asdasd', 'Quitman', 'GA', '1231', '2016-11-15 03:26:02'),
(37, 4, 'asdasd', 'asdasd', 'asdasd', 'Quitman', 'GA', '1231', '2016-11-15 03:26:02'),
(38, 4, 'asdasd', 'asdasd', 'asdasd', 'Quitman', 'GA', '1231', '2016-11-15 03:26:02'),
(39, 4, 'asdasd', 'asdasd', 'asdasd', 'Quitman', 'GA', '1231', '2016-11-15 03:26:02'),
(41, 4, 'asdasd', 'asdasd', 'asdasd', 'Quitman', 'GA', '1231', '2016-11-15 03:26:02'),
(43, 4, 'asdasd', 'asdasd', 'asdasd', 'Quitman', 'GA', '1231', '2016-11-15 03:26:02'),
(44, 4, 'asdasd', 'asdasd', 'asdasd', 'Quitman', 'GA', '1231', '2016-11-15 03:26:02'),
(45, 4, 'asdasd', 'asdasd', 'asdasd', 'Quitman', 'GA', '1231', '2016-11-15 03:26:02'),
(46, 4, 'asdasd', 'asdasd', 'asdasd', 'Quitman', 'GA', '1231', '2016-11-15 03:26:02'),
(47, 5, 'sadasd', 'asdasd', 'asdad', 'Quitman', 'GA', 'asd', '2016-11-15 21:26:26'),
(48, 5, 'sadasd', 'asdasd', 'asdad', 'Quitman', 'GA', 'asd', '2016-11-15 21:26:26'),
(49, 5, 'sadasd', 'asdasd', 'asdad', 'Quitman', 'GA', 'asd', '2016-11-15 21:26:26'),
(50, 5, 'sadasd', 'asdasd', 'asdad', 'Quitman', 'GA', 'asd', '2016-11-15 21:26:26'),
(51, 5, 'sadasd', 'asdasd', 'asdad', 'Quitman', 'GA', 'asd', '2016-11-15 21:26:26'),
(52, 5, 'sadasd', 'asdasd', 'asdad', 'Quitman', 'GA', 'asd', '2016-11-15 21:26:26'),
(53, 5, 'sadasd', 'asdasd', 'asdad', 'Quitman', 'GA', 'asd', '2016-11-15 21:26:26'),
(54, 5, 'sadasd', 'asdasd', 'asdad', 'Quitman', 'GA', 'asd', '2016-11-15 21:26:26'),
(55, 5, 'sadasd', 'asdasd', 'asdad', 'Quitman', 'GA', 'asd', '2016-11-15 21:26:26'),
(56, 5, 'sadasd', 'asdasd', 'asdad', 'Quitman', 'GA', 'asd', '2016-11-15 21:26:26'),
(57, 5, 'sadasd', 'asdasd', 'asdad', 'Quitman', 'GA', 'asd', '2016-11-15 21:26:26'),
(58, 5, 'sadasd', 'asdasd', 'asdad', 'Quitman', 'GA', 'asd', '2016-11-15 21:26:26'),
(59, 5, 'sadasd', 'asdasd', 'asdad', 'Quitman', 'GA', 'asd', '2016-11-15 21:26:26'),
(60, 5, 'sadasd', 'asdasd', 'asdad', 'Quitman', 'GA', 'asd', '2016-11-15 21:26:26'),
(61, 5, 'sadasd', 'asdasd', 'asdad', 'Quitman', 'GA', 'asd', '2016-11-15 21:26:26'),
(62, 5, 'sadasd', 'asdasd', 'asdad', 'Quitman', 'GA', 'asd', '2016-11-15 21:26:26'),
(63, 5, 'sadasd', 'asdasd', 'asdad', 'Quitman', 'GA', 'asd', '2016-11-15 21:26:26'),
(64, 5, 'sadasd', 'asdasd', 'asdad', 'Quitman', 'GA', 'asd', '2016-11-15 21:26:26'),
(65, 6, 'asdasd', 'asdasd', 'asdasd', 'Quitman', 'GA', '12312', '2016-11-25 23:14:51'),
(66, 7, 'dad', 'mom', '', 'Quitman', 'GA', '', '2016-11-26 22:20:42'),
(67, 8, 'dad', 'mom', '', 'Quitman', 'GA', '', '2016-11-26 22:21:41'),
(68, 9, 'dad', 'mom', '300 Cat', 'Quitman', 'GA', '12345', '2016-11-27 00:14:45'),
(69, 10, 'dad', 'mom', '333 cats', 'Quitman', 'GA', '', '2016-11-27 00:19:41'),
(70, 11, 'dad', 'mom', '300 cats', 'Quitman', 'GA', '12345', '2016-11-27 00:38:06'),
(71, 12, 'Tom', 'Brand', '200 Cats', 'Quitman', 'GA', '12345', '2016-11-27 00:46:42'),
(72, 13, 'Tom', 'Brand', '200 cats', 'Quitman', 'GA', '12345', '2016-11-27 00:49:50'),
(73, 14, 'Tim', 'Fry', '100 Cats Ln', 'Quitman', 'GA', '12345', '2016-11-27 01:12:37'),
(74, 15, 'Zed', 'Wrinkleton', '330 Dogsbetter rd', 'Quitman', 'GA', '12345', '2016-11-27 01:27:46'),
(75, 19, '', '', '', 'Quitman', 'GA', '', '2016-12-02 19:47:16'),
(76, 20, 'Bob', 'White', '100 cats', 'Quitman', 'GA', '12345', '2016-12-02 20:28:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`TYPE`);

--
-- Indexes for table `inventoryreceipts`
--
ALTER TABLE `inventoryreceipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Order_no` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventoryreceipts`
--
ALTER TABLE `inventoryreceipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
