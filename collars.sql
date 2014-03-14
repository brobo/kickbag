-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 14, 2014 at 02:08 AM
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
