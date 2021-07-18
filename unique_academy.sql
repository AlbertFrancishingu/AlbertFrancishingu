-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2021 at 09:24 PM
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
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(100) UNSIGNED NOT NULL,
  `user_id` int(100) UNSIGNED NOT NULL,
  `post` varchar(255) NOT NULL,
  `post_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `user_id`, `post`, `post_at`) VALUES
(30, 2, 'Nothing much', '2021-07-18 12:16:03.860703'),
(31, 2, 'iivhieijev', '2021-07-18 12:24:50.097185'),
(32, 1, 'this is my post', '2021-07-18 13:08:25.064744'),
(33, 2, 'scend post', '2021-07-18 13:08:44.434781'),
(34, 3, '@moro lectures is not going to hold', '2021-07-18 14:55:33.790532');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(100) NOT NULL,
  `comment` varchar(160) NOT NULL,
  `user_id` int(100) UNSIGNED NOT NULL,
  `post_id` int(100) UNSIGNED NOT NULL,
  `post_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `comment`, `user_id`, `post_id`, `post_at`) VALUES
(45, 'khdihfuhfuhue', 1, 33, '2021-07-18 13:16:56.642042'),
(46, 'best news ever', 3, 34, '2021-07-18 14:55:51.578568'),
(47, 'ufyiuyf8yfeuf', 1, 34, '2021-07-18 15:58:58.954888');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) UNSIGNED NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNumber` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` blob NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `phoneNumber`, `address`, `image`, `password`) VALUES
(1, 'Stanley', 'James', 'stanleyjames12353@gmail.com', '08141812106', 'Shagari lowcost', 0x494d472d32303231303730332d5741303439332e6a7067, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(2, 'Cecilia', 'Aidan', 'cece@gmail.com', '07063968620', 'sengere', 0x5f32303139303731345f3130313133342e4a5047, '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684'),
(3, 'Solomon', 'James', 'solo@gmail.com', '09066776564', 'Futy', 0x494d475f32303230303831345f3137323832355f3935355f313539373434333234363734302e6a7067, '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `chat` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
