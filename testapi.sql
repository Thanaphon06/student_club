-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2024 at 08:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`c_id`, `c_name`) VALUES
(1, 'Football_Club'),
(2, 'Chess_Club'),
(3, 'Music_Club'),
(4, 'papa'),
(5, 'YEET');

-- --------------------------------------------------------

--
-- Table structure for table `memberclub`
--

CREATE TABLE `memberclub` (
  `s_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memberclub`
--

INSERT INTO `memberclub` (`s_id`, `c_id`) VALUES
(1, 3),
(2, 2),
(3, 2),
(4, 1),
(7, 3),
(7, 5),
(8, 3),
(9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`s_id`, `s_name`) VALUES
(1, 'meme'),
(2, 'Two'),
(3, 'Tar'),
(4, 'Emma'),
(5, 'Frank'),
(6, 'Pop'),
(7, 'Poo'),
(8, 'Nut'),
(9, 'Hut'),
(123456, 'root');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `memberclub`
--
ALTER TABLE `memberclub`
  ADD PRIMARY KEY (`s_id`,`c_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`s_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `memberclub`
--
ALTER TABLE `memberclub`
  ADD CONSTRAINT `memberclub_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `students` (`s_id`),
  ADD CONSTRAINT `memberclub_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `club` (`c_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
