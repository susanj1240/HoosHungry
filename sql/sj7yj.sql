-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 14, 2020 at 05:46 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sj7yj`
--

-- --------------------------------------------------------

--
-- Table structure for table `favs`
--

CREATE TABLE `favs` (
  `email` varchar(255) NOT NULL,
  `restaurant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favs`
--

INSERT INTO `favs` (`email`, `restaurant`) VALUES
('a', 'doma'),
('a', 'milan');

-- --------------------------------------------------------

--
-- Table structure for table `favsRestaurant`
--

CREATE TABLE `favsRestaurant` (
  `email` varchar(255) NOT NULL,
  `restaurant` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favsRestaurant`
--

INSERT INTO `favsRestaurant` (`email`, `restaurant`, `name`, `image`, `link`) VALUES
('a', 'doma', 'doma', '../img/Doma.jpeg', '../html/restaurant-page.html'),
('a', 'milan', 'milan', '../img/milan.jpg', '../html/restaurant-page.html');

-- --------------------------------------------------------

--
-- Table structure for table `loginInfo`
--

CREATE TABLE `loginInfo` (
  `email` varchar(255) NOT NULL,
  `pwdHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loginInfo`
--

INSERT INTO `loginInfo` (`email`, `pwdHash`) VALUES
('a', 'a'),
('sj7yj@virginia.edu', '$2y$10$I5erWK.0c.DB/Hq6q2owNuF5224xPAZhee87HR58hAz/belw5lA8C');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`name`, `image`, `link`) VALUES
('doma', '../img/Doma.jpeg', '../html/restaurant-page.html'),
('milan', '../img/milan.jpg', '../html/restaurant-page.html'),
('mod pizza', '../img/modpizza.gif', '../html/restaurant-page.html'),
('roots', 'roots.png', '../html/restaurant-page.html');

-- --------------------------------------------------------

--
-- Table structure for table `reviewInfo`
--

CREATE TABLE `reviewInfo` (
  `reviewID` int(11) NOT NULL,
  `userText` text NOT NULL,
  `numStars` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `restaurant` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviewInfo`
--

INSERT INTO `reviewInfo` (`reviewID`, `userText`, `numStars`, `user`, `restaurant`) VALUES
(1, 'good', 4, 'a', 'milan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('sj7yj', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loginInfo`
--
ALTER TABLE `loginInfo`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `reviewInfo`
--
ALTER TABLE `reviewInfo`
  ADD PRIMARY KEY (`reviewID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reviewInfo`
--
ALTER TABLE `reviewInfo`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
