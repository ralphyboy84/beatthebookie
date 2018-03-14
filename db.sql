-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 14, 2018 at 08:17 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `btbv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `fixtures`
--

DROP TABLE IF EXISTS `fixtures`;
CREATE TABLE IF NOT EXISTS `fixtures` (
  `fixtureid` int(8) NOT NULL AUTO_INCREMENT,
  `league` varchar(3) NOT NULL,
  `date` date NOT NULL,
  `hometeam` varchar(100) NOT NULL,
  `awayteam` varchar(100) NOT NULL,
  PRIMARY KEY (`fixtureid`)
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `predictions`
--

DROP TABLE IF EXISTS `predictions`;
CREATE TABLE IF NOT EXISTS `predictions` (
  `date` date NOT NULL,
  `league` varchar(50) NOT NULL,
  `hometeam` varchar(100) NOT NULL,
  `awayteam` varchar(100) NOT NULL,
  `outcome` varchar(100) NOT NULL,
  `goalrush` int(1) NOT NULL,
  `outcomecorrect` int(1) NOT NULL,
  `goalrushcorrect` int(1) NOT NULL,
  `complete` tinyint(1) NOT NULL,
  PRIMARY KEY (`date`,`league`,`hometeam`,`awayteam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `results1415`
--

DROP TABLE IF EXISTS `results1415`;
CREATE TABLE IF NOT EXISTS `results1415` (
  `league` varchar(3) NOT NULL,
  `date` date NOT NULL,
  `hometeam` varchar(100) NOT NULL,
  `homescore` int(2) NOT NULL,
  `awayteam` varchar(100) NOT NULL,
  `awayscore` int(2) NOT NULL,
  KEY `league` (`league`),
  KEY `date` (`date`),
  KEY `hometeam` (`hometeam`),
  KEY `awayteam` (`awayteam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `results1516`
--

DROP TABLE IF EXISTS `results1516`;
CREATE TABLE IF NOT EXISTS `results1516` (
  `league` varchar(3) NOT NULL,
  `date` date NOT NULL,
  `hometeam` varchar(100) NOT NULL,
  `homescore` int(2) NOT NULL,
  `awayteam` varchar(100) NOT NULL,
  `awayscore` int(2) NOT NULL,
  KEY `league` (`league`),
  KEY `date` (`date`),
  KEY `hometeam` (`hometeam`),
  KEY `awayteam` (`awayteam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `results1617`
--

DROP TABLE IF EXISTS `results1617`;
CREATE TABLE IF NOT EXISTS `results1617` (
  `league` varchar(3) NOT NULL,
  `date` date NOT NULL,
  `hometeam` varchar(100) NOT NULL,
  `homescore` int(2) NOT NULL,
  `awayteam` varchar(100) NOT NULL,
  `awayscore` int(2) NOT NULL,
  KEY `league` (`league`),
  KEY `date` (`date`),
  KEY `hometeam` (`hometeam`),
  KEY `awayteam` (`awayteam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `results1718`
--

DROP TABLE IF EXISTS `results1718`;
CREATE TABLE IF NOT EXISTS `results1718` (
  `league` varchar(3) NOT NULL,
  `date` date NOT NULL,
  `hometeam` varchar(100) NOT NULL,
  `homescore` int(2) NOT NULL,
  `awayteam` varchar(100) NOT NULL,
  `awayscore` int(2) NOT NULL,
  PRIMARY KEY (`league`,`date`,`hometeam`,`awayteam`),
  KEY `league` (`league`),
  KEY `date` (`date`),
  KEY `hometeam` (`hometeam`),
  KEY `awayteam` (`awayteam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
