-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 19, 2021 at 01:11 PM
-- Server version: 8.0.19
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `filmovi`
--

DROP TABLE IF EXISTS `filmovi`;
CREATE TABLE IF NOT EXISTS `filmovi` (
  `naslov` varchar(50) NOT NULL,
  `opis` varchar(2000) NOT NULL,
  `zanr` varchar(30) NOT NULL,
  `scenarista` varchar(50) NOT NULL,
  `reziser` varchar(50) NOT NULL,
  `producentska_kuca` varchar(50) NOT NULL,
  `godina_izdanja` int NOT NULL,
  `trajanje` varchar(20) NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `filmovi`
--

INSERT INTO `filmovi` (`naslov`, `opis`, `zanr`, `scenarista`, `reziser`, `producentska_kuca`, `godina_izdanja`, `trajanje`, `id`) VALUES
('The Dark Knight', 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.', 'Action', 'Jonathan Nolan', 'Christopher Nolan', 'Warner Bros.', 2008, '2h 32min', 1),
('The Shawshank Redemption', 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.', 'Drama', 'Stephen King', 'Frank Darabont', 'Warner Bros.', 1994, '2h 22min', 2),
('The Godfather', 'An organized crime dynasty\'s aging patriarch transfers control of his clandestine empire to his reluctant son.', 'Crime', 'Mario Puzo', 'Francis Ford Coppola', 'Warner Bros.', 1972, '2h 55min', 3),
('The Godfather: Part II', 'The early life and career of Vito Corleone in 1920s New York City is portrayed, while his son, Michael, expands and tightens his grip on the family crime syndicate.', 'Crime', 'Francis Ford Coppola', 'Francis Ford Coppola', 'Warner Bros.', 1974, '3h 22min', 4),
('12 Angry Men', 'A jury holdout attempts to prevent a miscarriage of justice by forcing his colleagues to reconsider the evidence.', 'Crime', 'Reginald Rose', 'Sidney Lumet', 'Warner Bros.', 1957, '1h 36min', 5);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

DROP TABLE IF EXISTS `korisnici`;
CREATE TABLE IF NOT EXISTS `korisnici` (
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(30) NOT NULL,
  `admin_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`first_name`, `last_name`, `email`, `password`, `username`, `admin_status`) VALUES
('Mladen', 'Ravlic', 'something@something.gmail.com', 'f1d5f55b43239f55a217c93f49340f71bb8a0c33c7bf220b50f81ebd80229d58', 'Mladmin', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
