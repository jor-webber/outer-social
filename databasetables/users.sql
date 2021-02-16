-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2020 at 11:28 PM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(100) NOT NULL,
  `age` int(11) DEFAULT NULL
);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `age`) VALUES
('jordan', '$2y$10$2KYKN052s/5L0NwThKscT.Ojuq8EP4U4iNT7RpT/9YR5M3gS6eT0.', 'webber2@email.com', 26),
('jordanW', '$2y$10$p7Lq624OkidzbMK0nIIEROHrcxDDrgQzrFHxB4hmdAK8yLbHC59Hy', 'webber2@email.com', 26),
('jorwebber', '$2y$10$wP5647yI0Ei5LPd6lNjsmOygIop.WVvUeOMeSRfc4yFPhvjPDTNfa', 'webber1@email.com', 26),
('jwebber', '$2y$10$nGN86VhNUImjRh68G/eKB.NRkrR3HaX.EVm20ARUAzgvItjh80HrW', 'webber3@email.com', 27);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
