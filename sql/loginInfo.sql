SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `loginInfo` (
    `email` varchar(255) NOT NULL,
    `pwdHash` varchar(255) NOT NULL
);

ALTER TABLE `loginInfo`
    ADD PRIMARY KEY (`email`);

CREATE TABLE `reviewInfo` (
    `reviewID` int NOT NULL AUTO_INCREMENT, 
    `userText` text NOT NULL,
    `numStars` int NOT NULL
);

ALTER TABLE `reviewInfo` (
    ADD PRIMARY KEY (`reviewID`);
);

CREATE TABLE `favs` (
    `email` varchar(255) NOT NULL,
    `restaurant` varchar(255) NOT NULL
);

ALTER TABLE `favs` (
    ADD PRIMARY KEY (`email`, `restaurant`);
);
