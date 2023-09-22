-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2023 at 06:39 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `r_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE `goods` (
  `goods_code` char(6) NOT NULL,
  `goods_name` varchar(40) NOT NULL,
  `goods_price` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`goods_code`, `goods_name`, `goods_price`, `stock`) VALUES
('KBR001', 'Office Membrane Keyboard - Wired', 60000, 4),
('KBR002', 'Office Membrane Keyboard - Wireless', 100000, 3),
('KBR003', 'Gaming Membrane Keyboard - Wired', 80000, 3),
('KBR004', 'Gaming Membrane Keyboard - Wireless', 100000, 3),
('KBR005', 'Mechanical Keyboard 100%  - Wired', 200000, 0),
('MSE001', 'Office Mouse - Wired', 25000, 15),
('MSE002', 'Office Mouse - Wireless', 50000, 6),
('MSE003', 'Gaming Mouse - Wired', 100000, 10),
('MSE004', 'Gaming Mouse - Wireless', 125000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `goods_details`
--

CREATE TABLE `goods_details` (
  `id` int(11) NOT NULL,
  `username` char(9) NOT NULL,
  `goods_code` char(6) NOT NULL,
  `goods_name` varchar(40) NOT NULL,
  `goods_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(5) NOT NULL,
  `username` char(9) NOT NULL,
  `sales_no` int(6) NOT NULL,
  `sales_date` datetime NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `username`, `sales_no`, `sales_date`, `total`) VALUES
(14, 'Farrel', 1, '2022-08-11 09:51:06', 550000),
(15, 'Farrel', 2, '2022-08-22 09:50:43', 1350000),
(16, 'admin2', 3, '2022-08-22 09:59:02', 360000),
(17, 'operator', 4, '2022-08-25 02:20:52', 1650000),
(18, 'operator', 5, '2022-08-25 02:40:03', 660000),
(19, 'operator', 6, '2022-08-29 09:20:26', 200000),
(20, 'operator', 7, '2022-08-29 08:23:26', 49999950);

-- --------------------------------------------------------

--
-- Table structure for table `sales_detail`
--

CREATE TABLE `sales_detail` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `username` char(9) NOT NULL,
  `sales_no` int(6) NOT NULL,
  `goods_code` char(6) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_detail`
--

INSERT INTO `sales_detail` (`id`, `username`, `sales_no`, `goods_code`, `price`, `qty`) VALUES
(00056, 'Farrel', 1, 'MSE002', 50000, 5),
(00057, 'Farrel', 1, 'KBR002', 100000, 3),
(00058, 'Farrel', 2, 'kbr001', 60000, 3),
(00059, 'Farrel', 2, 'mse003', 100000, 2),
(00060, 'Farrel', 2, 'KBR002', 100000, 1),
(00061, 'Farrel', 2, 'KBR001', 60000, 1),
(00062, 'Farrel', 2, 'KBR001', 60000, 1),
(00063, 'Farrel', 2, 'MSE004', 125000, 6),
(00064, 'admin2', 3, 'KBR003', 80000, 2),
(00065, 'admin2', 3, 'MSE002', 50000, 4),
(00066, 'operator', 4, 'MSE004', 125000, 2),
(00067, 'operator', 4, 'KBR002', 100000, 2),
(00068, 'operator', 4, 'KBR005', 200000, 1),
(00069, 'operator', 4, 'KBR005', 200000, 5),
(00070, 'operator', 5, 'KBR001', 60000, 1),
(00071, 'operator', 5, 'KBR001', 60000, 1),
(00072, 'operator', 5, 'KBR001', 60000, 1),
(00073, 'operator', 5, 'KBR001', 60000, 1),
(00074, 'operator', 5, 'KBR001', 60000, 1),
(00075, 'operator', 5, 'KBR001', 60000, 1),
(00076, 'operator', 5, 'KBR001', 60000, 1),
(00077, 'operator', 5, 'KBR001', 60000, 1),
(00078, 'operator', 5, 'KBR001', 60000, 1),
(00079, 'operator', 5, 'KBR001', 60000, 1),
(00080, 'operator', 5, 'KBR001', 60000, 1),
(00081, 'operator', 6, 'KBR004', 100000, 2),
(00082, 'operator', 7, 'TST001', 999999, 50);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` char(11) NOT NULL,
  `password` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `role` varchar(15) NOT NULL COMMENT 'Super Admin | Admin | Operator'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `role`) VALUES
(1, 'super', '1b3231655cebb7a1f783eddf27d254ca', 'John Doe', 'super admin'),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Jane Dea', 'admin'),
(3, 'operator', '4b583376b2767b923c3e1da60d10de59', 'Farrel Akiela', 'operator'),
(4, 'tes_aja', 'e9826a10941f1a3d13e5af6db63dd8c4', 'cuma tes kok', 'admin'),
(5, 'supri', 'd79444495ba8886c397b418227564d3f', 'TES KEDUA', 'operator'),
(6, 'op2', '4b583376b2767b923c3e1da60d10de59', 'TEST ADMIN', 'operator'),
(15, 'tesaja', '1b3231655cebb7a1f783eddf27d254ca', 'TES SUPER', 'admin'),
(16, 'gas', '1b3231655cebb7a1f783eddf27d254ca', 'SUPER NIH', 'operator'),
(18, 'hanicantik', '91ac0524a39d0903b9d06ffe66ab967e', 'HANI', 'operator'),
(19, 'cantiku', '01e50c681c0b05ff22686b3e0f7290d3', 'Haniyatus Zahra', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`goods_code`);

--
-- Indexes for table `goods_details`
--
ALTER TABLE `goods_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `sales_detail`
--
ALTER TABLE `sales_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `goods_details`
--
ALTER TABLE `goods_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sales_detail`
--
ALTER TABLE `sales_detail`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
