-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 29, 2012 at 10:41 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `resamaze`
--
CREATE DATABASE `resamaze` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `resamaze`;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

DROP TABLE IF EXISTS `templates`;
CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template` varchar(8000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `template`) VALUES
(1, '<div id="resume"><div id="header">{"name":"phoneNumbers.phoneNumber"} {"name":"firstName"} {"name":"lastName"} {"name":"email"}</div><div class="skills"><strong>SKILLS:</strong><br />{"template":{"name":"skills.skill.name","ender":", "}}</div><div class="positions">{"template_group":{"beginner":"<div class=&quot;position&quot;>","templates":[{"template":{"name":"positions.title","ender":", "}},{"template":{"name":"positions.company.name","ender":", "}},{"template":{"name":"positions.company.location","ender":", "}},{"template":{"name":"positions.startDate.month","ender":"/"}},{"template":{"name":"positions.startDate.year","ender":" - "}},{"template":{"name":"positions.endDate.month","ender":"/"}},{"template":{"name":"positions.endDate.year"}},{"template":{"beginner":"<div class=&quot;summary&quot;>","name":"positions.summary","ender":"</div>"}}],"ender":"</div>"}}</div><div id="footer"><div>{"name":"mainAddress"}</div>{"template_group":{"beginner":"<div>","templates":[{"template":{"name":"educations.degree","ender":" in "}},{"template":{"name":"educations.fieldOfStudy","ender":" from "}},{"template":{"name":"educations.schoolName","ender":" "}},{"template":{"name":"educations.endDate.year"}}],"ender":"</div>"}}</div></div>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
