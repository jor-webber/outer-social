-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2020 at 11:29 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

--
-- Database: `000803303`
--

-- --------------------------------------------------------

--
-- Table structure for table `usersposts`
--

CREATE TABLE `usersposts` (
  `post_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `post` varchar(250) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `like_count` int(11) NOT NULL DEFAULT 0
);

--
-- Dumping data for table `usersposts`
--

INSERT INTO `usersposts` (`post_id`, `username`, `post`, `date_time`, `like_count`) VALUES
(23, 'jwebber', 'My first post :)', '2020-12-11 18:29:47', 2),
(24, 'jwebber', 'I love my girlfriend', '2020-12-12 20:04:23', 24),
(27, 'jorwebber', 'This is my first post on the new site! I love it', '2020-12-13 18:14:45', 18),
(29, 'jorwebber', 'Hello There World!', '2020-12-13 18:22:57', 19),
(37, 'jwebber', 'Testing this out', '2020-12-13 22:17:37', 1),
(38, 'jwebber', 'Hopefully this works when it needs to', '2020-12-13 22:20:40', 1),
(40, 'jwebber', 'netus et malesuada fames ac turpis egestas maecenas pharetra convallis posuere morbi leo urna molestie at elementum eu facilisis sed odio morbi quis commodo odio aenean sed adipiscing diam donec adipiscing tristique risus nec feugiat in fermentum pos', '2020-12-13 22:21:49', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usersposts`
--
ALTER TABLE `usersposts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usersposts`
--
ALTER TABLE `usersposts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usersposts`
--
ALTER TABLE `usersposts`
  ADD CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
