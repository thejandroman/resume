-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 16, 2012 at 06:36 PM
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
  `css` varchar(8000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `template`, `css`) VALUES
(1, '<div id="resume"><div id="header">{"name":"phoneNumbers.phoneNumber"} {"name":"firstName"} {"name":"lastName"} {"name":"email"}</div><div class="skills"><div><strong>SKILLS:</strong></div>{"template":{"name":"skills.skill.name","separator":", "}}</div><div class="positions">{"template_group":{"wrapper":"<div class=&quot;position&quot;></div>","templates":[{"template":{"wrapper":"<span></span>","name":"positions.title","separator":", "}},{"template":{"wrapper":"<span></span>","name":"positions.company.name","separator":", "}},{"template":{"wrapper":"<span></span>","name":"positions.company.location","separator":", "}},{"template":{"wrapper":"<span></span>","name":"positions.startDate.month","separator":"/"}},{"template":{"wrapper":"<span></span>","name":"positions.startDate.year","separator":" - "}},{"template":{"wrapper":"<span></span>","name":"positions.endDate.month","separator":"/"}},{"template":{"wrapper":"<span></span>","name":"positions.endDate.year"}},{"template":{"wrapper":"<div class=&quot;summary&quot;></div>","name":"positions.summary"}}]}}</div><div id="footer"><div>{"name":"mainAddress"}</div>{"template_group":{"wrapper":"<div></div>","templates":[{"template":{"name":"educations.degree","separator":" in "}},{"template":{"name":"educations.fieldOfStudy","separator":" from "}},{"template":{"name":"educations.schoolName","separator":" "}},{"template":{"name":"educations.endDate.year"}}]}}</div></div>', ' #resume{font-size:12pt;font-family:Calibri;width:612px;height:792px;padding:72px;border:1px solid #888888;}   .position span{font-weight:bold;}   .skill{margin:0px;}   .skills{margin-bottom:20px;}   #footer, #header{text-align:center;color:#888888;}   #skills{margin-bottom:20px;}   #phone, #name, #email{margin:0px 5px;}   .position{margin-bottom:20px;}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
