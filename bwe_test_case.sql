-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 04, 2022 at 02:35 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bwe_test_case`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `City_Code` varchar(255) NOT NULL,
  `City_Name` varchar(255) NOT NULL,
  PRIMARY KEY (`City_Code`),
  UNIQUE KEY `City_Name` (`City_Name`),
  KEY `City_Code` (`City_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`City_Code`, `City_Name`) VALUES
('003', 'KAKAMEGA'),
('30200', 'kitale'),
('001', 'Mombasa'),
('040', 'NAIROBI');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `S/No` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Email_address` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `Zip_code` varchar(255) NOT NULL,
  `City_Code` varchar(255) NOT NULL,
  PRIMARY KEY (`S/No`),
  UNIQUE KEY `Email_address_2` (`Email_address`),
  KEY `Zip_code` (`Zip_code`),
  KEY `Email_address` (`Email_address`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`S/No`, `FirstName`, `LastName`, `Email_address`, `street`, `Zip_code`, `City_Code`) VALUES
(13, 'GEOFERY', 'ONGIDI', 'ongidigeofrey@gmail.com', '22 -50406 FUNYULA', '50406', 'NAIROBI'),
(16, 'Geofrey', 'Ongidi', 'ongidigeofreygmail.com', 'p.o box 22', '50406', 'KAKAMEGA'),
(18, 'Judith', 'Auma', 'judidthauma2002@gmail.com', 'Mombasa', '50200', 'Mombasa'),
(19, 'GEOFERY', 'ONGIDI', 'ongidigeofrey200@gmail.com', '22 -50406 FUNYULA', '50406', 'KAKAMEGA');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
