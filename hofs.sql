-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Skapad: 24 maj 2014 kl 10:10
-- Serverversion: 5.5.32
-- PHP-version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `hofs`
--
CREATE DATABASE IF NOT EXISTS `hofs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hofs`;

-- --------------------------------------------------------

--
-- Tabellstruktur `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `uid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `music` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='feed';

-- --------------------------------------------------------

--
-- Tabellstruktur `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  `title` varchar(75) NOT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `fbid` varchar(20) NOT NULL,
  `joindate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='users' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
