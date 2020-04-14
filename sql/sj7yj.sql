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
-- Purpose: Stores favorite restaurant when user clicks on favorite button
-- Colums:
  -- email: email of the user
  -- restaurant: name of the restaurant that the user saved as favs
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
-- Purpose: Cross product of favs and restaurant table. This table is used on the profile page
-- Colums:
  -- email: email of the user
  -- restaurant: name of the restaurant that the user saved as favs
  -- name: name of the restaurant that the user saved as favs
  -- image: link to the image of the restaurant
  -- link: link to the page of the restaurant
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
-- Purpose: Stores email and pwdHash. This table is used for registration and loginInfo
-- Columns:
  -- email: email of the user
  -- pwdHash: password of the user
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
-- Purpose: Stores information about each restaurants(name, link to image, link to its page)
-- Columns:
  -- name: name of the restaurants
  -- image: link to the image of the restaurants
  -- link: link to the page of the restaurants

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
-- Purpose: Stores information about individual reviews submitted on restaurant page
-- Columns:
  -- reviewID: ID of the review - auto increments
  -- userText: what the user types in for review
  -- numStarts: number of stars given by user
  -- user: email of the user
  -- restaurant: name of the restaurant that the user gave review

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
