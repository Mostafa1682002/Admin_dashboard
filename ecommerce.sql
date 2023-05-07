-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2023 at 09:47 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID_cate` smallint(6) NOT NULL,
  `Name_cate` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `ordering` int(11) DEFAULT NULL,
  `visability` tinyint(4) NOT NULL DEFAULT 0,
  `allow_comment` tinyint(4) NOT NULL DEFAULT 0,
  `allow_ads` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID_cate`, `Name_cate`, `Description`, `ordering`, `visability`, `allow_comment`, `allow_ads`) VALUES
(9, 'Hand Made', 'Hand Made tems', 1, 0, 1, 0),
(10, 'Computres', 'Computres Items', 2, 0, 0, 1),
(11, 'Cell Phones', 'Cell Phones', 3, 1, 0, 0),
(12, 'Clothes', 'Clothes', 4, 0, 0, 0),
(13, 'Tools', 'Home Tools', 5, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_status` tinyint(4) NOT NULL,
  `comment_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_ID` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_description` text NOT NULL,
  `item_price` varchar(50) NOT NULL,
  `item_date` date NOT NULL,
  `item_countryMade` varchar(100) NOT NULL,
  `item_image` varchar(100) NOT NULL,
  `item_status` varchar(100) NOT NULL,
  `item_rating` smallint(6) NOT NULL,
  `approve` tinyint(4) NOT NULL DEFAULT 0,
  `cate_ID` smallint(6) NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_ID`, `item_name`, `item_description`, `item_price`, `item_date`, `item_countryMade`, `item_image`, `item_status`, `item_rating`, `approve`, `cate_ID`, `user_ID`) VALUES
(7, 'labtop', 'laptop zbook g3', '25000', '2023-04-07', 'Eg', 'pexels-photo-1480807.jpeg', '1', 0, 0, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  `ImgeUser` varchar(255) NOT NULL,
  `Date` date DEFAULT NULL,
  `RegStatus` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `FullName`, `admin`, `ImgeUser`, `Date`, `RegStatus`) VALUES
(1, 'Mostafa1682002', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'mosth123@gmail.com', 'Mostafa Hossam Rizk', 1, '10photo_2022-07-27_20-04-01.jpg', '2023-03-08', '1'),
(14, 'ahmedtarek254', 'd6858443315e5d223b8c2fa13fa493c58ee91816', 'ahmedtarek1234@gmail.com', 'Ahmed Tarek', 0, '20011026-_DSC0513.jpg', '2023-03-13', '1'),
(15, 'Nagar2002', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'naser1478@gmail.com', 'Mostafa Nasser', 0, '1652462711310.jpg', '2023-03-17', '1'),
(16, 'tefaa123131', 'e73c04c1545f52e67940f53366f4aa5d1e7fad6f', 'tefaa123@gmail.com', 'Mostafa  Gad', 0, '1660072895796.jpg', '2023-03-17', '1'),
(19, 'admin', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', 'admin@gmail.com', 'Admin Mn', 0, 'img.png', '2023-03-25', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID_cate`),
  ADD UNIQUE KEY `Name_cate` (`Name_cate`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `item` (`item_id`),
  ADD KEY `comment_user` (`user_ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_ID`),
  ADD UNIQUE KEY `item_name` (`item_name`),
  ADD KEY `user` (`user_ID`),
  ADD KEY `categorie` (`cate_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID_cate` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `categorie` FOREIGN KEY (`cate_ID`) REFERENCES `categories` (`ID_cate`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`user_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
