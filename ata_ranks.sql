-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2014 at 03:21 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
