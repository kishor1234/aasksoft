-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 25, 2016 at 12:45 AM
-- Server version: 5.5.45-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aasksoftmap`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `id_eventbrite` varchar(15) NOT NULL,
  `title` varchar(200) NOT NULL,
  `created` int(14) NOT NULL,
  `organizer_name` varchar(100) NOT NULL,
  `uri` varchar(200) NOT NULL,
  `start_date` int(14) NOT NULL,
  `end_date` int(14) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `address` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE IF NOT EXISTS `places` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `approved` int(1) DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `uri` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sector` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `owner_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `owner_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sg_organization_id` int(9) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `approved`, `title`, `type`, `lat`, `lng`, `address`, `uri`, `description`, `sector`, `owner_name`, `owner_email`, `sg_organization_id`) VALUES
(1, 1, '@askSoft Limitd Daund (Core Branch)', 'startup', 18.4581, 74.5784, 'Daund', 'http://www.aasksoft.com', 'aasksoft Limited Daund (Core Branch), Software Company working on PHP,JAVA, Android, iOS,(dot)NET,Pyton etc', '', 'Kishor Shinde', 'aasksoftware@gmail.com', 0),
(2, 1, 'vssoftech', 'startup', 18.5793, 73.9823, 'wagholi,pune', 'www.vssoftech.in', 'software firm developing android apps,websites,and software projects.', '', 'Satish Bhise', 'satish.bhise01@gmail.com', 0),
(3, 1, '@askSoft Limited Nashik', 'startup', 19.9971, 73.7897, 'Nashik', 'www.aasksoft.com', 'aasksoft Limited (Nashik Branch), Software Company working on PHP,JAVA, Android, iOS,(dot)NET,Pyton etc', '', 'mayur', 'appmayur@gmail.com', 0),
(5, 1, '"Pool Campus" Proactive It Services Pvt.Ltd', 'startup', 18.1511, 74.5726, '', 'http://www.poolcampus.co.in', 'Job Placement at Baramati', '', 'PoolCampus', 'nlitpune@yahoo.com ', 0),
(6, 1, '"Pool Campus" Proactive It Services Pvt.Ltd', 'startup', 18.5174, 73.8549, '"Pool Campus" Proactive It Services Pvt.Ltd. Shrirang House, B 4th Floor, Opp.Jangli Maharaj Temple, J.M.Road,Shivaji Nagar, Pune-04', 'http://www.poolcampus.co.in', 'Job Placement', '', 'PoolCampus', 'nlitpune@yahoo.com ', 0),
(7, 1, 'Shri Someshwar Sahakari Sakhar Karkhana Ltd. Someshwarnagar', 'startup', 18.1041, 74.2869, 'A/P: Someshwarnagar, Tal: Baramati, Dist: Pune, 412306', 'someshwarsakhar.com', 'à¤¶à¥à¤°à¥€ à¤¸à¥‹à¤®à¥‡à¤¶à¥à¤µà¤° à¤¸à¤¹à¤•à¤¾à¤°à¥€ à¤¸à¤¾à¤–à¤° à¤•à¤¾à¤°à¤–à¤¾à¤¨à¤¾, à¤¸à¥‹à¤®à¥‡à¤¶à¥à¤µà¤°à¤¨à¤—à¤°', '', 'Shri Someshwar SSK Ltd. Someshwarnagar', 'someshwarsakhar@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `sg_lastupdate` int(14) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sg_lastupdate`) VALUES
(0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
