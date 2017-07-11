-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2016 at 09:09 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `retailstore`
--
CREATE DATABASE IF NOT EXISTS `retailstore` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `retailstore`;

-- --------------------------------------------------------

--
-- Table structure for table `modulemenu`
--

CREATE TABLE IF NOT EXISTS `modulemenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menuname` varchar(255) NOT NULL,
  `parent` varchar(50) NOT NULL,
  `action` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `modulemenu`
--

INSERT INTO `modulemenu` (`id`, `menuname`, `parent`, `action`, `permission`) VALUES
(1, 'Stock', 'self', '#', 0),
(2, 'New Stock', 'Stock', 'NewStock.php', 0),
(3, 'Update Stock', 'Stock', 'UpdateStock.php', 0),
(4, 'View Stock', 'Stock', 'ViewStock.php', 0),
(5, 'Puraches', 'self', '#', 0),
(6, 'Purchase Entry', 'Puraches', 'PurchaseEntry.php', 0),
(7, 'Show Purchase', 'Puraches', 'ShowPurchase.php', 0),
(8, 'Sell Particuler', 'self', '#', 0),
(9, 'Sell', 'Sell Particuler', 'Sell.php', 0),
(10, 'Sell Bill', 'Sell Particuler', 'ShowSellBill.php', 0),
(11, 'Stock', 'self', '#', 1),
(12, 'New Stock', 'Stock', 'NewStock.php', 1),
(13, 'Update Stock', 'Stock', 'UpdateStock.php', 1),
(14, 'View Stock', 'Stock', 'ViewStock.php', 1),
(15, 'Puraches', 'self', '#', 1),
(16, 'Purchase Entry', 'Puraches', 'PurchaseEntry.php', 1),
(17, 'Show Purchase', 'Puraches', 'ShowPurchase.php', 1),
(18, 'Sell Particuler', 'self', '#', 1),
(19, 'Sell', 'Sell Particuler', 'Sell.php', 1),
(20, 'Sell Bill', 'Sell Particuler', 'ShowSellBill.php', 1),
(21, 'Reports', 'self', '#', 1),
(22, 'SellReport', 'Reports', 'SellReport.php', 1),
(23, 'PurchaseReport', 'Reports', 'PurchaseReport.php', 1),
(24, 'StockeReport', 'Reports', 'StockeReport.php', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rkart`
--

CREATE TABLE IF NOT EXISTS `rkart` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `shopemail` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `totalprice` decimal(18,2) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rkart`
--

INSERT INTO `rkart` (`id`, `shopemail`, `item`, `qty`, `rate`, `totalprice`, `barcode`, `ipaddress`) VALUES
(1, 'kishor4shinde@gmail.com', 'Set Wet Deodorant Spray Perfune', '4', '200.00', '800.00', '8901088098502', '127.0.0.1'),
(2, 'kishor4shinde@gmail.com', 'Nycil Cool gulabjal', '3', '150.00', '450.00', '8901542012563', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `rstock`
--

CREATE TABLE IF NOT EXISTS `rstock` (
  `stockid` int(255) NOT NULL AUTO_INCREMENT,
  `shopemail` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `qty` int(255) NOT NULL,
  `popup` int(255) NOT NULL,
  `price` decimal(18,2) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  PRIMARY KEY (`stockid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `rstock`
--

INSERT INTO `rstock` (`stockid`, `shopemail`, `item`, `brand`, `size`, `unit`, `qty`, `popup`, `price`, `barcode`) VALUES
(1, 'kishor4shinde@gmail.com', 'Shirt', 'Acid Water', 'XL', 'Set', 0, 0, '0.00', ''),
(2, 'kishor4shinde@gmail.com', 'Shirt', 'Acid Water', 'L', 'Set', 0, 0, '0.00', ''),
(3, 'kishor4shinde@gmail.com', 'Shirt', 'Acid Water', 'M', 'Set', 0, 0, '0.00', ''),
(4, 'kishor4shinde@gmail.com', 'Shirt', 'Acid Water', 'XXL', 'Set', 0, 0, '0.00', ''),
(5, 'kishor4shinde@gmail.com', 'Set Wet Deodorant Spray Perfune', 'SET WET', '150', 'ml', 15, 5, '200.00', '8901088098502'),
(6, 'kishor4shinde@gmail.com', 'Nycil Cool gulabjal', 'Nycil', '150', 'gm', 7, 5, '150.00', '8901542012563');

-- --------------------------------------------------------

--
-- Table structure for table `shopes`
--

CREATE TABLE IF NOT EXISTS `shopes` (
  `shopid` int(255) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `password` varchar(50) NOT NULL,
  `shopname` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `shoplogo` blob NOT NULL,
  `registerip` varchar(100) NOT NULL,
  `startdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `enddate` varchar(100) NOT NULL,
  `emailvarification` int(11) NOT NULL,
  PRIMARY KEY (`shopid`,`email`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `shopes`
--

INSERT INTO `shopes` (`shopid`, `email`, `password`, `shopname`, `mobile`, `address`, `shoplogo`, `registerip`, `startdate`, `enddate`, `emailvarification`) VALUES
(1, 'kishor4shinde@gmail.com', '27ee8a357d3c76b90a28986e12d74e74', 'Vinay Shop', '9890180228', 'Daund tal Daund dist pune 413801', '', '::1', '2016-06-15 09:01:51', '2017-06-15', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
