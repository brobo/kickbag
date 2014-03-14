SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


TRUNCATE TABLE `kickbag_collars`;
INSERT INTO `kickbag_collars` (`id`, `value`, `zindex`, `created`, `modified`) VALUES
(0, 'No Collar', 0, '2014-03-13 17:14:15', '2014-03-13 17:14:15'),
(2, 'Junior Leader', 1, '2014-03-13 17:14:15', '2014-03-13 17:14:15'),
(3, 'Trainee', 2, '2014-03-13 17:14:15', '2014-03-13 17:14:15'),
(4, 'Certified Trainer', 3, '2014-03-13 17:14:15', '2014-03-13 17:14:15'),
(5, 'Specialty Certified Trainer', 4, '2014-03-13 17:14:15', '2014-03-13 17:14:15'),
(6, 'Certified Instructor', 0, '2014-03-13 17:14:15', '2014-03-13 17:14:15');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;