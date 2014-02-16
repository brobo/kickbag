-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Generation Time: Feb 16, 2014 at 06:41 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

/*************************************************************************
* This file is a part of the Kickbag martial arts manager.
* Copyright © 2014 Colby Brown
*
* This program is free software; you can redistribute it and/or modify it
* under the terms of the GNU General Public License as published by the
* Free Software Foundation; either version 3 of the License,
* or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful, but
* WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, you can find a copy of it at
* <http://www.gnu.org/licenses/gpl.html>
*************************************************************************/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_contacts`
--

CREATE TABLE IF NOT EXISTS `kickbag_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(36) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

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
-- Table structure for table `kickbag_judges`
--

CREATE TABLE IF NOT EXISTS `kickbag_judges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ata_number` varchar(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `rank` varchar(5) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ata_number` (`ata_number`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_panel_seats`
--

CREATE TABLE IF NOT EXISTS `kickbag_panel_seats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `judge_id` int(10) unsigned NOT NULL,
  `testing_id` int(10) unsigned NOT NULL,
  `rank` varchar(50) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `judge_id` (`judge_id`,`testing_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_students`
--

CREATE TABLE IF NOT EXISTS `kickbag_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(16) NOT NULL,
  `last_name` varchar(16) NOT NULL,
  `dob` date NOT NULL,
  `rank` varchar(5) NOT NULL DEFAULT 'W',
  `ata_number` varchar(10) NOT NULL,
  `search` varchar(100) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

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
-- Table structure for table `kickbag_students_position`
--

CREATE TABLE IF NOT EXISTS `kickbag_students_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `row` int(11) NOT NULL,
  `column` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is a temporary table intended to be truncated after each testing.' ;

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_testings`
--

CREATE TABLE IF NOT EXISTS `kickbag_testings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(50) NOT NULL,
  `time` datetime NOT NULL,
  `description` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kickbag_testing_students`
--

CREATE TABLE IF NOT EXISTS `kickbag_testing_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ata_number` varchar(10) NOT NULL,
  `first_name` varchar(16) NOT NULL,
  `last_name` varchar(16) NOT NULL,
  `rank` varchar(5) NOT NULL,
  `testing_id` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;
