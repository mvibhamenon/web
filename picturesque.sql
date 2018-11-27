-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2018 at 07:42 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `picturesque`
--

-- --------------------------------------------------------

--
-- Table structure for table `following`
--

CREATE TABLE `following` (
  `following_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `artist_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `following`
--

INSERT INTO `following` (`following_id`, `user_id`, `artist_id`) VALUES
(14, 8, 9),
(15, 8, 10),
(16, 12, 8),
(17, 10, 8),
(18, 9, 12);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `art_id` int(5) NOT NULL,
  `artist_id` int(5) NOT NULL,
  `artwork` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `likes` int(100) NOT NULL,
  `comments` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`art_id`, `artist_id`, `artwork`, `description`, `likes`, `comments`) VALUES
(461, 8, '77949-800px_colourbox305594612.jpg', 'black lights', 0, ''),
(462, 8, '86841-abstract-painting-wallpaper.jpg', 'colourful', 0, ''),
(463, 8, '50714-large.jpg', 'red lights', 0, ''),
(464, 8, '97466-large.jpg', 'red lights', 0, ''),
(465, 8, '39471-large.jpg', 'red lights', 0, ''),
(466, 8, '70834-ws_abstract_digital_art_1920x1200.jpg', 'paint', 0, ''),
(467, 8, '40506-ofbnyoj.jpg', 'blue', 0, ''),
(469, 9, '67293-800px_colourbox305594612.jpg', 'black lights', 0, ''),
(470, 10, '87588-abstract-painting-wallpaper.jpg', 'colour\r\n', 0, ''),
(472, 10, '63483-abstract-painting-wallpaper.jpg', 'colour\r\n', 0, ''),
(473, 10, '78536-800px_colourbox30559461.jpg', 'dust\r\n', 0, ''),
(475, 10, '64308-800px_colourbox30559461.jpg', 'dust\r\n', 0, ''),
(481, 0, '22070-gold-dust-texture_1085-624.jpg', 'dusts', 0, ''),
(482, 0, '75831-ws_abstract_digital_art_1920x1200.jpg', 's', 0, ''),
(483, 10, '19440-gold-dust-texture_1085-624.jpg', 'gold', 0, ''),
(484, 10, '79161-gold-dust-texture_1085-624.jpg', 'gold', 0, ''),
(485, 8, '27046-gold-dust-texture_1085-624.jpg', 'gold', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `profile_picture` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `email_id`, `profile_picture`) VALUES
(8, 'nikitha_srinivas', 'Nikitha Srinivas', '123456', 'nikitha@gmail.com', '2918-gold-dust-texture_1085-624.jpg'),
(9, 'niha_p', 'niha p', 'niha', 'niha@gmail.com', '48585-abstract-painting-wallpaper.jpg'),
(10, 'kavana_l', 'kavana l', 'kavana', 'kavana@gmail.com', '89767-ws_abstract_digital_art_1920x1200.jpg'),
(11, 'pallavi', 'pallavi b p', '123', 'pallavi@gmail.com', '68110-aa.jpg'),
(12, 'vibha_m', 'vibha', '123', 'vibha@gmail.com', '28617-large.jpg'),
(13, 'divya', 'divya k', '123', 'divya@gmail.com', '98000-aa.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `following`
--
ALTER TABLE `following`
  ADD PRIMARY KEY (`following_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`art_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `following`
--
ALTER TABLE `following`
  MODIFY `following_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `art_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=486;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
