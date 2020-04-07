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
