-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2022 at 04:29 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jibu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `bottle_id` int(11) NOT NULL,
  `Client_Host` varchar(40) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `TotalAmount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `bottle_id`, `Client_Host`, `Quantity`, `TotalAmount`) VALUES
(2, 1, '192.168.43.70', 1, 1200),
(8, 3, '192.168.43.70', 1, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `Order_id` int(11) NOT NULL,
  `names` varchar(40) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `Address` varchar(20) NOT NULL,
  `ListOfOrder` varchar(100) NOT NULL,
  `Total_Amount` int(11) NOT NULL,
  `Date` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`Order_id`, `names`, `phone`, `Address`, `ListOfOrder`, `Total_Amount`, `Date`, `status`) VALUES
(1, 'byamungu lewis', '0785436135', 'Rubavu', '5 Littles [5], 7 Littles [4]', 30000, '2022/10/10', 1),
(2, 'HABIMANA Aline', '0785544337', 'Ruhango', '19 Littles [1], 15 Littles [1], 7 Littles [4]', 54000, '2022/10/10', 0),
(3, 'Addil Muhamed', '0722334455', 'Kigali', '5 Littles [3], 7 Littles [3], 15 Littles [3], 19 Littles [3]', 111600, '2022/10/10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `water_bottle`
--

CREATE TABLE `water_bottle` (
  `id` int(11) NOT NULL,
  `Littles` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Refill` int(11) NOT NULL,
  `Image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `water_bottle`
--

INSERT INTO `water_bottle` (`id`, `Littles`, `Amount`, `Refill`, `Image`) VALUES
(1, 5, 1200, 500, 'Jibu-Product-13-min.png'),
(3, 19, 10000, 1900, 'images.jpg'),
(4, 7, 6000, 900, 'download (1).jpg'),
(5, 15, 20000, 2000, 'Logo.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`Order_id`);

--
-- Indexes for table `water_bottle`
--
ALTER TABLE `water_bottle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `Order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `water_bottle`
--
ALTER TABLE `water_bottle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
