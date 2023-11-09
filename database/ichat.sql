-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2023 at 07:55 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ichat`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `receiver` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL,
  `msg_time` varchar(100) NOT NULL,
  `msg_status` varchar(50) NOT NULL,
  `deletedBy_sender` varchar(5) NOT NULL,
  `deletedBy_receiver` varchar(5) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `sender`, `receiver`, `message`, `msg_time`, `msg_status`, `deletedBy_sender`, `deletedBy_receiver`, `type`) VALUES
(1, '1', '2', 'hi', '11:13 AM', 'seen', 'true', 'false', 'text'),
(2, '1', '2', 'ghkghk', '11:13 AM', 'seen', 'true', 'false', 'text'),
(3, '2', '1', 'IMG-1699510831.png', '11:20 AM', 'seen', 'false', 'false', 'image'),
(4, '1', '2', 'hi', '11:26 AM', 'not-seen', 'false', 'false', 'text'),
(5, '1', '2', 'hjj', '11:27 AM', 'not-seen', 'false', 'false', 'text'),
(6, '1', '2', 'hio', '11:27 AM', 'not-seen', 'false', 'false', 'text'),
(7, '1', '2', 'hi', '11:27 AM', 'not-seen', 'false', 'false', 'text'),
(8, '1', '2', 'hi', '11:27 AM', 'not-seen', 'false', 'false', 'text'),
(9, '1', '2', 'hi', '11:27 AM', 'not-seen', 'false', 'false', 'text'),
(10, '1', '2', 'hi', '11:27 AM', 'not-seen', 'false', 'false', 'text'),
(11, '1', '2', 'hi', '11:27 AM', 'not-seen', 'false', 'false', 'text'),
(12, '1', '2', 'hi', '11:27 AM', 'not-seen', 'false', 'false', 'text'),
(13, '1', '2', 'hi', '11:27 AM', 'not-seen', 'false', 'false', 'text'),
(14, '1', '2', 'fvnadthjs', '11:33 AM', 'not-seen', 'false', 'false', 'text'),
(15, '1', '2', 'tjwrt', '11:33 AM', 'not-seen', 'false', 'false', 'text'),
(16, '1', '2', 'rtjrt', '11:33 AM', 'not-seen', 'false', 'false', 'text'),
(17, '1', '2', 'rtjrtj', '11:33 AM', 'not-seen', 'false', 'false', 'text');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  `user_img` varchar(255) NOT NULL,
  `join_date` varchar(50) NOT NULL,
  `user_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_img`, `join_date`, `user_status`) VALUES
(1, 'Abdul Haseeb', 'abdulhaseeb@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '1699505585-88eb3846bddb6882aa60a78a2c518390.jpg', 'November 9,2023', '11:53 AM^1699512791'),
(2, 'Muneeb Khan', 'muneebkhan@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '1699510105-dda487b4460bc94bd19c1fc4d4217e66.jpg', 'November 9,2023', '11:21 AM^1699510886'),
(3, 'Ishaq Khan', 'ishaqkhan@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '1699510128-ae0910bf9606c08ec3fc01fb585d2e3d.jpg', 'November 9,2023', 'Online');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
