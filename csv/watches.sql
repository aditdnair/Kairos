-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2020 at 06:55 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `watches_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `watches`
--

CREATE TABLE `watches` (
  `ID` varchar(13) DEFAULT NULL,
  `Watch_Name` varchar(32) DEFAULT NULL,
  `Brand` varchar(14) DEFAULT NULL,
  `Collection` varchar(15) DEFAULT NULL,
  `Series` varchar(21) DEFAULT NULL,
  `Model_No` varchar(19) DEFAULT NULL,
  `price` int(7) DEFAULT NULL,
  `Features` varchar(72) DEFAULT NULL,
  `Movement` varchar(9) DEFAULT NULL,
  `Case_Shape` varchar(6) DEFAULT NULL,
  `Case_Material` varchar(28) DEFAULT NULL,
  `Case_Size` decimal(3,1) DEFAULT NULL,
  `Gender` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `watches`
--

INSERT INTO `watches` (`ID`, `Watch_Name`, `Brand`, `Collection`, `Series`, `Model_No`, `price`, `Features`, `Movement`, `Case_Shape`, `Case_Material`, `Case_Size`, `Gender`) VALUES
('7612533129511', 'Carrera CAR5A8W.FT6071', 'TAG Heuer', 'Carrera', 'Calibre Heuer02T COSC', 'CAR5A8W.FT6071', 1432000, 'Chronograph, Date, Tachymeter, Tourbillon', 'Automatic', 'Round', 'Titanium Grade 5 & Black PVD', '45.0', 'Men'),
('7612533121898', 'Carrera CAR2A1W.BA0703', 'TAG Heuer', 'Carrera', 'Calibre Heuer 01', 'CAR2A1W.BA0703', 432000, 'Chronograph, Date, Minutes, Skeleton, Small Seconds, Tachymeter', 'Automatic', 'Round', 'Steel & Ceramic', '45.0', 'Men'),
('7612586266751', 'De Ville 424.10.40.20.03.003', 'OMEGA', 'De Ville', 'Prestige', '424.10.40.20.03.003', 256000, 'Date', 'Automatic', 'Round', 'Steel', '39.5', 'Men'),
('7612635073484', 'Core Collection K2G23520', 'Calvin Klein', 'Core Collection', 'City', 'K2G23520', 18600, 'NA', 'Quartz', 'Round', 'Steel & Yellow Gold PVD', '31.0', 'Women'),
('7640161375109', 'Classic 54005 3 NIN', 'Claude Bernard', 'Classic', 'N/A', '54005 3 NIN', 13910, 'Date', 'Quartz', 'Round', 'Steel', '28.0', 'Women'),
('4549526200045', 'Edifice EQS-910D-1AVUDF', 'Casio', 'Edifice', 'N/A', 'EQS-910D-1AVUDF', 11995, 'Chronograph, Date, Power Reserve Indicator, Small Seconds, Solar Powered', 'Quartz', 'Round', 'Steel', '48.9', 'Men'),
('7630000711656', 'Maverick 241788-2', 'Victorinox', 'Maverick', 'N/A', '241788-2', 31700, 'Date, Unidirectional Rotating Bezel', 'Quartz', 'Round', 'Steel & Black PVD', '34.0', 'Women'),
('B07XWYCMQG', 'Apple Watch Series 5 (GPS, 44mm)', 'Apple', 'Apple Watch', 'Series 5', 'MWVF2HN/A', 43900, 'GPS, Always-On Retina display,Swimproof, ECG app', 'Automatic', 'Square', 'Aluminium', '44.0', 'Unisex');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
