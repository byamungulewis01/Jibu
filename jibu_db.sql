-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2022 at 10:55 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `username`, `password`) VALUES
(1, 'Umukunzi', 'Providance', 'provi', '123'),
(2, 'BYAMUNGU', 'Lewis', 'bmg', 'lewis'),
(4, 'RURANGWA', 'Fred', 'Fred1', 'Fred1');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `bottle_id` int(11) NOT NULL,
  `Client_Host` varchar(40) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `refill_quantity` int(11) NOT NULL,
  `TotalAmount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `Order_id` int(11) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(24) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobileno` varchar(10) NOT NULL,
  `Address` varchar(60) NOT NULL,
  `ListOfOrder` varchar(100) NOT NULL,
  `Total_Amount` int(11) NOT NULL,
  `Date` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`Order_id`, `fname`, `lname`, `email`, `mobileno`, `Address`, `ListOfOrder`, `Total_Amount`, `Date`, `status`) VALUES
(1, 'byamungu lewis', '', '', '0785436135', 'Rubavu', '5 Littles [5], 7 Littles [4]', 30000, '2022/10/10', 1),
(2, 'HABIMANA Aline', '', '', '0785544337', 'Ruhango', '19 Littles [1], 15 Littles [1], 7 Littles [4]', 54000, '2022/10/10', 1),
(3, 'Addil Muhamed', '', '', '0722334455', 'Kigali', '5 Littles [3], 7 Littles [3], 15 Littles [3], 19 Littles [3]', 111600, '2022/10/10', 1),
(4, 'BYIRINGIRO', 'Eric', 'eric@wasac.rw', '0786637377', 'Rugerero / Buhaza', '20 Littles [1], 6 Littles [1], 14 Littles [1]', 27072, '2022/11/03', 0),
(5, 'NIYONZIMA', 'Haruna', 'haruna@gmail.com', '0786637377', 'Rubavu / Gisenyi', '6 Littles [2], 19 Littles [2]', 21504, '2022/11/03', 0),
(7, '', '', '', '', ' / ', '6 Littles [1] Refill :[4], 19 Littles [1] Refill :[0]', 10944, '2022/11/08', 1),
(8, 'Iradukunda', 'Elysess', 'eliane@gmail.com', '078978765', 'Rugerero / Buhaza', '6L [1] Refill :[2], 19L [1] Refill :[4]', 18048, '2022/11/08', 1),
(9, 'Dusabe', 'Rose', 'dusaberose@gmail.com', '0787636367', 'Kibuye / Rurema', '19L [2] Refill :[2], 14L [2] Refill :[2]', 30144, '2022/11/12', 1),
(10, 'BYAMUNGU', 'Lewis', '', '0785436135', 'Rwanda - Rubavu - Gi', '12L [0] Refill :[1]', 1440, '2022/11/24', 0),
(11, 'BYAMUNGU', 'Gloria', '', '0782185745', 'Rubavu', '5L [1] Refill :[2]', 2880, '2022/11/27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `water_bottle`
--

CREATE TABLE `water_bottle` (
  `id` int(11) NOT NULL,
  `Littles` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Refill` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `Image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `water_bottle`
--

INSERT INTO `water_bottle` (`id`, `Littles`, `Amount`, `Refill`, `quantity`, `Image`) VALUES
(11, 5, 2000, 500, 13, '5Little.jpg'),
(12, 10, 3000, 1000, 100, '10LittleNew.jpg'),
(13, 12, 4000, 1500, 0, '12Little.jpg'),
(14, 19, 5000, 1500, 0, '18.9Little.jpg'),
(15, 19, 6000, 2000, 0, '19Littles.jpg'),
(16, 20, 7000, 2200, 0, '20Little.jpg'),
(18, 1, 400, 100, 10, '1Little.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `Order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `water_bottle`
--
ALTER TABLE `water_bottle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
