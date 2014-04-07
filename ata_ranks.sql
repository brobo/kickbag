-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2014 at 05:10 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `kickbag_ranks`
--

CREATE TABLE IF NOT EXISTS `kickbag_ranks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(31) NOT NULL,
  `abbr` varchar(4) NOT NULL,
  `zindex` int(11) NOT NULL DEFAULT '99',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `kickbag_ranks`
--

INSERT INTO `kickbag_ranks` (`id`, `value`, `abbr`, `zindex`, `created`, `modified`) VALUES
(1, 'White', 'W', 0, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(2, 'Orange', 'O', 1, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(3, 'Orange+', 'O+', 2, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(4, 'Yellow', 'Y', 3, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(5, 'Yellow+', 'Y+', 4, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(6, 'Camo', 'C', 5, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(7, 'Camo+', 'C+', 6, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(8, 'Green', 'G', 7, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(9, 'Green+', 'G+', 8, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(10, 'Purple', 'P', 9, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(11, 'Purple+', 'P+', 10, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(12, 'Blue', 'Bl', 11, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(13, 'Blue+', 'Bl+', 12, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(14, 'Brown', 'Br', 13, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(15, 'Brown+', 'Br+', 14, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(16, 'Red', 'R', 15, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(17, 'Red+', 'R+', 16, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(18, 'Red/Black', 'R/B', 17, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(19, '1&deg Black', '1D', 18, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(20, '2&deg Black', '2D', 19, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(21, '2&deg Black +', '2D+', 20, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(22, '3&deg Black', '3D', 21, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(23, '4&deg Black', '4D', 22, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(24, '5&deg Black', '5D', 23, '2014-02-25 11:13:01', '2014-02-25 11:13:01'),
(25, '6&deg Black', '6D', 24, '2014-02-25 11:13:01', '2014-02-25 11:13:01');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
