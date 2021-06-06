-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2021 at 07:24 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unique_academy`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `firstName` varchar(10) NOT NULL,
  `lastName` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phoneNumber` varchar(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `image` blob,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstName`, `lastName`, `email`, `phoneNumber`, `address`, `image`, `password`) VALUES
(1, 'Stanley', 'James', 'stanleyjames12353@gmail.com', '08108441114', 'futy', 0x46425f494d475f31353638343438353131353735363935362e6a7067, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(2, 'Stanley', 'John', 'stanleyjames13353@gmail.com', '09087878787', 'futy', 0x46425f494d475f31353732373733353135363437363932312e6a7067, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(3, 'Favour', 'Musa', 'favour@gmail.com', '07088800092', 'Futy', 0x46425f494d475f31353638343438353131353735363935362e6a7067, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(4, 'Philip', 'James', 'philip@gmail.com', '08100089887', 'Futy', NULL, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(5, 'Albert', 'Philip', 'albert@gmail.com', '07063968623', 'Futy', 0x46425f494d475f31353731313731373734393739323438362e6a7067, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(6, 'Samuel', 'John', 'samuel1@gmail.com', '08108441114', 'Futy', 0x46425f494d475f31353731313731373734393739323438362e6a7067, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
