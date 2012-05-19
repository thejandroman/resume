-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 19, 2012 at 03:46 PM
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
(1, '<div id="resume"><div id="header">[template:phoneNumbers.phoneNumber]&nbsp;[template:firstName]&nbsp;[template:lastName]&nbsp;[template:email]</div><div class="skills"><strong>SKILLS:</strong><br />[template:skills.skill.name(, )]</div><div class="positions"><div class="position">[template:positions.title(, )][template:positions.company.name(, )][template:positions.company.location(, )][template:positions.startDate.month(, )][template:positions.startDate.year( - )][template:positions.startDate.month(, )][template:positions.startDate.year( - )]<div>[template:positions.summary]</div></div></div><div id="footer"><div>[template:mainAddress]</div><div>[template:educations.education.degree][template:educations.education.fieldOfStudy( from )][template:educations.education.schoolName][template:educations.education.endDate.year]</div></div></div>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
