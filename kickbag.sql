-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 14, 2014 at 02:06 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `integrity`
--

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_attendances`
--

CREATE TABLE IF NOT EXISTS `kickbag_attendances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `kickbag_attendances`
--

INSERT INTO `kickbag_attendances` (`id`, `student_id`, `date`, `created`, `modified`) VALUES
(1, 5, '2014-01-05', '2014-01-06 05:30:53', '2014-01-06 05:30:53'),
(2, 1, '2014-01-05', '2014-01-06 05:30:53', '2014-01-06 05:30:53'),
(3, 2, '2014-01-05', '2014-01-06 05:30:53', '2014-01-06 05:30:53'),
(4, 2, '2014-01-05', '2014-01-06 05:31:12', '2014-01-06 05:31:12'),
(5, 2, '2014-01-05', '2014-01-06 05:31:12', '2014-01-06 05:31:12'),
(6, 1, '2014-01-04', '2014-01-06 06:27:03', '2014-01-06 06:27:03'),
(7, 1, '2013-12-02', '2014-01-06 20:27:39', '2014-01-06 20:27:39'),
(8, 1, '2013-12-02', '2014-01-06 20:27:39', '2014-01-06 20:27:39'),
(9, 1, '2013-10-18', '2014-01-06 20:29:49', '2014-01-06 20:29:49'),
(10, 1, '2013-10-18', '2014-01-06 20:33:18', '2014-01-06 20:33:18'),
(11, 1, '2013-10-18', '2014-01-06 20:34:17', '2014-01-06 20:34:17'),
(12, 1, '2014-02-12', '2014-02-12 21:49:16', '2014-02-12 21:49:16'),
(13, 1, '2014-02-14', '2014-02-14 18:32:58', '2014-02-14 18:32:58'),
(14, 11, '2014-02-14', '2014-02-14 18:32:58', '2014-02-14 18:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_barcodes`
--

CREATE TABLE IF NOT EXISTS `kickbag_barcodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `kickbag_barcodes`
--

INSERT INTO `kickbag_barcodes` (`id`, `value`, `student_id`, `created`, `modified`) VALUES
(1, 12345678, 1, '2014-02-21', '2014-02-21'),
(2, 98765432, 2, '2014-02-21', '2014-02-21'),
(3, 2147483647, 7, '2014-02-21', '2014-02-21'),
(4, 123456789, 6, '2014-02-21', '2014-02-21'),
(5, 1337, 3, '2014-02-21', '2014-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_collars`
--

CREATE TABLE IF NOT EXISTS `kickbag_collars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(32) NOT NULL,
  `zindex` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `kickbag_collars`
--

INSERT INTO `kickbag_collars` (`id`, `value`, `zindex`, `created`, `modified`) VALUES
(1, 'No Collar', 0, '2014-03-13 17:14:15', '2014-03-13 17:14:15'),
(2, 'Junior Leader', 1, '2014-03-13 17:14:15', '2014-03-13 17:14:15'),
(3, 'Trainee', 2, '2014-03-13 17:14:15', '2014-03-13 17:14:15'),
(4, 'Certified Trainer', 3, '2014-03-13 17:14:15', '2014-03-13 17:14:15'),
(5, 'Specialty Certified Trainer', 4, '2014-03-13 17:14:15', '2014-03-13 17:14:15'),
(6, 'Certified Instructor', 0, '2014-03-13 17:14:15', '2014-03-13 17:14:15');

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_contacts`
--

CREATE TABLE IF NOT EXISTS `kickbag_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(36) NOT NULL,
  `address` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kickbag_contacts`
--

INSERT INTO `kickbag_contacts` (`id`, `name`, `phone`, `email`, `address`, `created`, `modified`) VALUES
(1, 'Peggy Brown', '281-734-0612', 'peggyluvskoalas@gmail.com', '26019 Sterling Stone Lane\r\nKaty, Texas\r\n77494', NULL, '2014-02-17 04:41:30'),
(2, 'Mr. Stroud', '281-555-4897', 'stroud@gmail.com', '', '2013-12-09 21:46:50', '2014-02-14 18:32:19'),
(3, 'Tres Brenson', '2817341234', 'blacksmithgu@gmail.com', '', '2014-02-14 18:37:46', '2014-02-14 18:38:26'),
(4, 'Ned Stark', '7865124896', 'nedstark@winterfell.org', '', '2014-02-17 04:45:07', '2014-02-17 04:45:07');

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_contacts_students`
--

CREATE TABLE IF NOT EXISTS `kickbag_contacts_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_id` (`contact_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `kickbag_contacts_students`
--

INSERT INTO `kickbag_contacts_students` (`id`, `contact_id`, `student_id`, `created`, `modified`) VALUES
(14, 1, 1, NULL, NULL),
(15, 2, 1, NULL, NULL),
(16, 2, 2, NULL, NULL),
(17, 2, 8, NULL, NULL),
(18, 2, 3, NULL, NULL),
(19, 1, 9, NULL, NULL),
(20, 1, 10, NULL, NULL),
(21, 2, 11, NULL, NULL),
(22, 3, 11, NULL, NULL),
(23, 3, 8, NULL, NULL),
(24, 3, 1, NULL, NULL),
(25, 4, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_enrollments`
--

CREATE TABLE IF NOT EXISTS `kickbag_enrollments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `expiration_date` date NOT NULL,
  `enrolled` date DEFAULT NULL,
  `unenrolled` date DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `kickbag_enrollments`
--

INSERT INTO `kickbag_enrollments` (`id`, `program_id`, `student_id`, `active`, `expiration_date`, `enrolled`, `unenrolled`, `created`, `modified`) VALUES
(1, 1, 1, 1, '2015-02-14', '2014-02-14', NULL, '2014-02-14 17:19:40', '2014-02-14 17:19:40'),
(6, 3, 1, 0, '2017-02-14', '2014-02-14', '2014-02-14', '2014-02-14 17:38:35', '2014-02-14 17:38:35'),
(8, 1, 11, 1, '2014-08-14', '2014-02-14', NULL, '2014-02-14 18:37:00', '2014-02-14 18:37:00'),
(9, 0, 0, 1, '2015-02-14', '2014-02-14', NULL, '2014-02-15 02:17:50', '2014-02-15 02:17:50'),
(10, 0, 0, 1, '2015-02-14', '2014-02-14', NULL, '2014-02-15 02:19:05', '2014-02-15 02:19:05'),
(11, 0, 0, 1, '2015-02-14', '2014-02-14', NULL, '2014-02-15 02:19:42', '2014-02-15 02:19:42'),
(12, 0, 0, 1, '2015-02-14', '2014-02-14', NULL, '2014-02-15 02:23:15', '2014-02-15 02:23:15'),
(13, 0, 0, 1, '2015-02-14', '2014-02-14', NULL, '2014-02-15 02:23:29', '2014-02-15 02:23:29'),
(14, 0, 0, 1, '2015-02-14', '2014-02-14', NULL, '2014-02-15 02:24:03', '2014-02-15 02:24:03'),
(15, 0, 0, 1, '2015-02-14', '2014-02-14', NULL, '2014-02-15 02:25:01', '2014-02-15 02:25:01'),
(16, 0, 0, 1, '2015-02-14', '2014-02-14', NULL, '2014-02-15 02:26:07', '2014-02-15 02:26:07'),
(17, 0, 0, 1, '2015-02-14', '2014-02-14', NULL, '2014-02-15 02:27:03', '2014-02-15 02:27:03'),
(18, 0, 0, 1, '2015-02-14', '2014-02-14', NULL, '2014-02-15 02:27:06', '2014-02-15 02:27:06'),
(19, 0, 0, 1, '2015-02-14', '2014-02-14', NULL, '2014-02-15 02:27:47', '2014-02-15 02:27:47'),
(20, 0, 0, 1, '2015-02-14', '2014-02-14', NULL, '2014-02-15 02:28:55', '2014-02-15 02:28:55'),
(21, 0, 0, 1, '2015-02-14', '2014-02-14', NULL, '2014-02-15 02:30:00', '2014-02-15 02:30:00'),
(22, 0, 0, 1, '2015-02-14', '2014-02-14', NULL, '2014-02-15 02:30:15', '2014-02-15 02:30:15'),
(23, 0, 0, 1, '2020-02-14', '2014-02-14', NULL, '2014-02-15 02:30:49', '2014-02-15 02:30:49'),
(24, 0, 0, 1, '0000-00-00', '2014-02-14', NULL, '2014-02-15 02:31:59', '2014-02-15 02:31:59'),
(25, 1, 1, 1, '2014-08-17', '2014-02-17', NULL, '2014-02-17 23:37:42', '2014-02-17 23:37:42');

--
-- Triggers `kickbag_enrollments`
--
DROP TRIGGER IF EXISTS `enrollment`;
DELIMITER //
CREATE TRIGGER `enrollment` BEFORE INSERT ON `kickbag_enrollments`
 FOR EACH ROW SET NEW.enrolled = NOW()
//
DELIMITER ;
DROP TRIGGER IF EXISTS `unenrollment`;
DELIMITER //
CREATE TRIGGER `unenrollment` BEFORE UPDATE ON `kickbag_enrollments`
 FOR EACH ROW IF (NOT NEW.active) AND OLD.active THEN
SET NEW.unenrolled = NOW();
END IF
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_hours`
--

CREATE TABLE IF NOT EXISTS `kickbag_hours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `instructor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `hours` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kickbag_hours`
--

INSERT INTO `kickbag_hours` (`id`, `instructor_id`, `date`, `hours`, `created`, `modified`) VALUES
(1, 2, '2014-03-13', 1, '2014-03-14 00:49:27', '2014-03-14 00:49:27'),
(2, 2, '2014-03-13', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, '2014-03-13', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2, '2014-03-12', 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_instructors`
--

CREATE TABLE IF NOT EXISTS `kickbag_instructors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `collar_id` int(11) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kickbag_instructors`
--

INSERT INTO `kickbag_instructors` (`id`, `student_id`, `collar_id`, `created`, `modified`) VALUES
(2, 1, 2, '2014-03-13 04:22:57', '2014-03-13 04:23:03'),
(3, 14, 6, '2014-03-14 00:35:21', '2014-03-14 00:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_programs`
--

CREATE TABLE IF NOT EXISTS `kickbag_programs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `duration` int(11) DEFAULT NULL COMMENT 'Length of program contract, months',
  `price` double NOT NULL,
  `deprecated` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kickbag_programs`
--

INSERT INTO `kickbag_programs` (`id`, `name`, `duration`, `price`, `deprecated`, `created`, `modified`) VALUES
(1, '6 Month Basic', 6, 60, 0, '2014-02-08 20:58:44', '2014-02-11 17:35:11'),
(2, '12 Months Complicated', 13, 5000, 0, '2014-02-14 14:49:35', '2014-02-14 14:49:35'),
(3, 'Black Belt Club', 36, 25, 0, '2014-02-14 17:20:49', '2014-02-14 17:20:49'),
(4, 'Fleeting', 1, 10, 1, '2014-02-17 05:51:47', '2014-02-17 05:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_ranks`
--

CREATE TABLE IF NOT EXISTS `kickbag_ranks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(31) NOT NULL,
  `zindex` int(11) NOT NULL DEFAULT '99',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `kickbag_ranks`
--

INSERT INTO `kickbag_ranks` (`id`, `value`, `zindex`, `created`, `modified`) VALUES
(1, 'White', 0, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(2, 'Orange', 1, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(3, 'Orange+', 2, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(4, 'Yellow', 3, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(5, 'Yellow+', 4, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(6, 'Camo', 5, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(7, 'Camo+', 6, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(8, 'Green', 7, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(9, 'Green+', 8, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(10, 'Purple', 9, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(11, 'Purple+', 10, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(12, 'Blue', 11, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(13, 'Blue+', 12, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(14, 'Brown', 13, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(15, 'Brown+', 14, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(16, 'Red', 15, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(17, 'Red+', 16, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(18, 'Red/Black', 17, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(19, '1&deg Black', 18, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(20, '2&deg Black', 19, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(21, '2&deg Black +', 20, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(22, '3&deg Black', 21, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(23, '4&deg Black', 22, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(24, '5&deg Black', 23, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(25, '6&deg Black', 24, '2014-02-25 11:13:01', '2014-02-25 11:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_students`
--

CREATE TABLE IF NOT EXISTS `kickbag_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(16) NOT NULL,
  `last_name` varchar(16) NOT NULL,
  `dob` date NOT NULL,
  `rank_id` int(11) NOT NULL,
  `ata_number` varchar(10) DEFAULT NULL,
  `uniform_size` varchar(8) DEFAULT NULL,
  `belt_size` varchar(8) DEFAULT NULL,
  `notes` text NOT NULL,
  `picture` varchar(50) DEFAULT 'nopicture.png',
  `search` varchar(100) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `kickbag_students`
--

INSERT INTO `kickbag_students` (`id`, `first_name`, `last_name`, `dob`, `rank_id`, `ata_number`, `uniform_size`, `belt_size`, `notes`, `picture`, `search`, `modified`, `created`) VALUES
(1, 'Colby', 'Brown', '1996-09-10', 22, '041035354', '6', '6', '', 'student_id532123b80b50c.png', 'Colby Brown (041039394)', '2014-03-13 04:19:20', '2013-12-08 23:27:35'),
(2, 'Angelo', 'Cioffi', '1997-07-10', 19, '123456789', NULL, NULL, '', 'nopicture.png', 'Angelo Cioffi (123456789)', '2013-12-09 21:46:14', '2013-12-09 21:46:03'),
(3, 'Bobby', 'Tables', '2013-07-11', 2, '013371337', NULL, NULL, '', 'nopicture.png', 'Bobby Tables (013371337)', '2014-02-14 18:31:01', '0000-00-00 00:00:00'),
(4, 'Jon', 'Snow', '1993-07-13', 19, '789563214', NULL, NULL, '', 'nopicture.png', 'Jon Snow (789563214)', '2013-07-16 03:38:50', '0000-00-00 00:00:00'),
(5, 'Mya', 'Brown', '2008-09-15', 14, '187187187', NULL, NULL, '', NULL, 'Mya Brown (187187187)', '2014-02-23 23:47:28', '0000-00-00 00:00:00'),
(6, 'Homer', 'Simpson', '2009-07-16', 4, '707158963', NULL, NULL, '', 'student_id530a79cb0889d.png', 'Homer Simpson (707158963)', '2014-02-23 23:44:27', '0000-00-00 00:00:00'),
(7, 'Amy', 'Pond', '2009-07-21', 1, '795683258', NULL, NULL, '', 'nopicture.png', 'Amy Pond (795683258)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Tres', 'Brenson', '1997-12-10', 25, '733173310', NULL, NULL, '', 'nopicture.png', 'Tres Brenson (733173310)', '2013-12-10 21:49:33', '2013-12-10 21:49:15'),
(9, 'Syrio', 'Forel', '1914-01-02', 10, '456789123', NULL, NULL, '', 'nopicture.png', 'Syrio Forel (456789123)', '2014-01-04 20:50:32', '2014-01-02 04:25:20'),
(10, 'Kirby', 'Koala', '2009-09-09', 10, '987654321', NULL, NULL, '', 'nopicture.png', 'Kirby Koala (987654321)', '2014-01-04 20:51:05', '2014-01-04 20:50:00'),
(11, 'Miguel', 'Obergonson', '1914-08-14', 6, '741852963', NULL, NULL, '', 'nopicture.png', 'Miguel Obergonson (741852963)', '2014-02-14 18:32:14', '2014-02-14 18:32:02'),
(12, 'Noname', 'Noone', '2010-02-26', 1, '', NULL, NULL, '', 'nopicture.png', 'Noname Noone ()', '2014-02-26 14:21:17', '2014-02-26 14:21:17'),
(14, 'Nancy', 'Booth', '2010-03-04', 22, '', NULL, NULL, '', 'nopicture.png', 'Nancy Booth ()', '2014-03-04 03:33:00', '2014-03-04 03:33:00');

--
-- Triggers `kickbag_students`
--
DROP TRIGGER IF EXISTS `create_search`;
DELIMITER //
CREATE TRIGGER `create_search` BEFORE INSERT ON `kickbag_students`
 FOR EACH ROW SET NEW.search = CONCAT(NEW.first_name, ' ', NEW.last_name, ' (', NEW.ata_number, ')')
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_transactions`
--

CREATE TABLE IF NOT EXISTS `kickbag_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `paid_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `kickbag_transactions`
--

INSERT INTO `kickbag_transactions` (`id`, `student_id`, `total`, `paid`, `paid_timestamp`, `created`, `modified`) VALUES
(1, 8, '541.25', 0, '0000-00-00 00:00:00', '2013-12-10 21:50:15', '2013-12-10 21:50:15'),
(2, 9, '811.88', 0, '0000-00-00 00:00:00', '2014-01-02 04:26:30', '2014-01-02 04:26:30'),
(3, 1, '167.79', 1, '2014-01-02 22:51:37', '2014-01-02 16:51:02', '2014-01-02 16:51:02'),
(4, 10, '100.00', 1, '2014-01-05 02:52:15', '2014-01-04 20:51:44', '2014-01-04 20:51:44'),
(9, 1, '25.00', 1, '0000-00-00 00:00:00', '2014-02-14 17:38:35', '2014-02-14 17:38:35'),
(10, 1, '25.00', 1, '2014-02-14 23:39:20', '2014-02-14 17:38:54', '2014-02-14 17:38:54'),
(11, 11, '2175.83', 1, '2014-02-17 11:40:33', '2014-02-14 18:34:07', '2014-02-14 18:34:07'),
(12, 11, '59.00', 1, '2014-02-17 11:40:22', '2014-02-14 18:37:00', '2014-02-14 18:37:00'),
(13, 1, '60.00', 1, '2014-02-15 08:33:26', '2014-02-15 02:27:47', '2014-02-15 02:27:47'),
(14, 1, '60.00', 1, '2014-02-15 08:33:30', '2014-02-15 02:28:55', '2014-02-15 02:28:55'),
(15, 1, '10.83', 0, '0000-00-00 00:00:00', '2014-02-17 04:50:53', '2014-02-17 04:50:53'),
(16, 3, '542.34', 0, '0000-00-00 00:00:00', '2014-02-17 05:41:24', '2014-02-17 05:41:24'),
(17, 5, '10.83', 0, '0000-00-00 00:00:00', '2014-02-17 05:41:46', '2014-02-17 05:41:46'),
(18, 1, '360.00', 0, '0000-00-00 00:00:00', '2014-02-17 23:37:42', '2014-02-17 23:37:42'),
(19, 1, '10.83', 0, '0000-00-00 00:00:00', '2014-02-20 18:47:02', '2014-02-20 18:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_transaction_items`
--

CREATE TABLE IF NOT EXISTS `kickbag_transaction_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_id` (`transaction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `kickbag_transaction_items`
--

INSERT INTO `kickbag_transaction_items` (`id`, `transaction_id`, `description`, `unit_price`, `quantity`, `created`, `modified`) VALUES
(1, 1, 'Intel core i7', '500.00', 1, '2013-12-10 21:50:15', '2013-12-10 21:50:15'),
(2, 2, 'Sword', '750.00', 1, '2014-01-02 04:26:30', '2014-01-02 04:26:30'),
(3, 3, 'Big Bang Theory', '75.00', 2, '2014-01-02 16:51:02', '2014-01-02 16:51:02'),
(4, 3, 'T-Shirt', '5.00', 1, '2014-01-02 16:51:02', '2014-01-02 16:51:02'),
(5, 4, 'Leaves', '5.00', 20, '2014-01-04 20:51:44', '2014-01-04 20:51:44'),
(6, 8, 'Black Belt Club', '25.00', 1, '2014-02-14 17:38:02', '2014-02-14 17:38:02'),
(7, 9, 'Black Belt Club', '25.00', 1, '2014-02-14 17:38:35', '2014-02-14 17:38:35'),
(8, 10, 'Black Belt Club', '25.00', 1, '2014-02-14 17:38:54', '2014-02-14 17:38:54'),
(9, 11, 'CPU', '2000.00', 1, '2014-02-14 18:34:07', '2014-02-14 18:34:07'),
(10, 11, 'T-Shirt', '5.00', 2, '2014-02-14 18:34:07', '2014-02-14 18:34:07'),
(11, 12, 'Enrollment in 6 Month Basic', '59.00', 1, '2014-02-14 18:37:00', '2014-02-14 18:37:00'),
(12, 13, 'Enrollment in 6 Month Basic', '60.00', 1, '2014-02-15 02:27:47', '2014-02-15 02:27:47'),
(13, 14, 'Enrollment in 6 Month Basic', '60.00', 1, '2014-02-15 02:28:56', '2014-02-15 02:28:56'),
(14, 15, 'Thing 1', '10.00', 1, '2014-02-17 04:50:53', '2014-02-17 04:50:53'),
(15, 16, 'Computer', '500.00', 1, '2014-02-17 05:41:24', '2014-02-17 05:41:24'),
(16, 16, '''); DROP TABLE STUDENTS', '1.00', 1, '2014-02-17 05:41:24', '2014-02-17 05:41:24'),
(17, 17, 'Bone', '10.00', 1, '2014-02-17 05:41:46', '2014-02-17 05:41:46'),
(18, 18, 'Enrollment in 6 Month Basic', '360.00', 1, '2014-02-17 23:37:42', '2014-02-17 23:37:42'),
(19, 19, 'Test transaction', '10.00', 1, '2014-02-20 18:47:02', '2014-02-20 18:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_users`
--

CREATE TABLE IF NOT EXISTS `kickbag_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(20) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kickbag_users`
--

INSERT INTO `kickbag_users` (`id`, `username`, `password`, `name`, `created`, `modified`) VALUES
(1, 'colby', 'd76e92809eda2986cf3318a0d303ba70bafb42a7', 'Colby Brown', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'jmiller', 'd76e92809eda2986cf3318a0d303ba70bafb42a7', 'Jeremy Miller', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
