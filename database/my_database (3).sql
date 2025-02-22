-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2024 at 05:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `session` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `name`, `password`, `session`) VALUES
(73, 'vishal', '', NULL),
(74, 'Vasant', '', NULL),
(75, 'gilbert', '', NULL),
(76, 'prathmesh', '', NULL),
(77, 'jeevan', '', NULL),
(78, 'omkar bhoir', '', NULL),
(79, 'gaurav', '', NULL),
(80, 'bhavesh', '', NULL),
(81, 'harsh', '', NULL),
(82, 'sandeep', '', NULL),
(83, 'pranav', '', NULL),
(84, 'rahul yadav', '', NULL),
(85, 'chandan', '', NULL),
(86, 'sayli', '', NULL),
(87, 'shruti', '', NULL),
(88, 'vaishnavi', '', NULL),
(89, 'rashmi', '', NULL),
(90, 'vivek', '', NULL),
(91, 'anup', '', NULL),
(92, 'zishan', '', NULL),
(93, 'surendra', '', NULL),
(94, 'omkar chorghe', '', NULL),
(95, 'swapnilw', '', NULL),
(96, 'akanksha', '', NULL),
(97, 'prathmesh randive', '', NULL),
(98, 'sumitG', '', NULL),
(99, 'AbhishekD', '', NULL),
(100, 'VivekM', '', NULL),
(101, 'chandrashekar', '', NULL),
(102, 'AkshayK', '', NULL),
(103, 'RanjitS', '', NULL),
(104, 'sagar', '', NULL),
(105, 'praful', '', NULL),
(106, 'rehan', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `scoreboard`
--

CREATE TABLE `scoreboard` (
  `No` int(8) NOT NULL,
  `team_name` varchar(20) NOT NULL,
  `Challenges_Solved` int(3) NOT NULL,
  `Score` int(10) NOT NULL,
  `first_solve_time` timestamp NULL DEFAULT NULL,
  `total_time_taken` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scoreboard`
--

INSERT INTO `scoreboard` (`No`, `team_name`, `Challenges_Solved`, `Score`, `first_solve_time`, `total_time_taken`) VALUES
(1, 'team', 0, 0, NULL, 0),
(2, 'vishal', 0, 0, NULL, 0),
(3, 'Vasant', 0, 100, NULL, 0),
(4, 'gilbert', 0, 0, NULL, 0),
(5, 'prathmesh', 0, 0, NULL, 0),
(6, 'jeevan', 0, 0, NULL, 0),
(7, 'omkar bhoir', 0, 0, NULL, 0),
(8, 'gaurav', 0, 0, NULL, 0),
(9, 'bhavesh', 0, 0, NULL, 0),
(10, 'harsh', 0, 200, NULL, 0),
(11, 'sandeep', 0, 0, NULL, 0),
(12, 'pranav', 0, 0, NULL, 0),
(13, 'rahul yadav', 0, 0, NULL, 0),
(14, 'chandan', 0, 0, NULL, 0),
(15, 'sayli', 0, 0, NULL, 0),
(16, 'shruti', 0, 0, NULL, 0),
(17, 'vaishnavi', 0, 0, NULL, 0),
(18, 'rashmi', 0, 0, NULL, 0),
(19, 'vivek', 0, 0, NULL, 0),
(20, 'anup', 0, 0, NULL, 0),
(21, 'zishan', 0, 0, NULL, 0),
(22, 'surendra', 0, 0, NULL, 0),
(23, 'omkar chorghe', 0, 0, NULL, 0),
(24, 'swapnilw', 0, 0, NULL, 0),
(25, 'akanksha', 0, 0, NULL, 0),
(26, 'prathmesh randive', 0, 0, NULL, 0),
(27, 'sumitG', 0, 0, NULL, 0),
(28, 'AbhishekD', 0, 0, NULL, 0),
(29, 'VivekM', 0, 0, NULL, 0),
(30, 'chandrashekar', 0, 0, NULL, 0),
(31, 'AkshayK', 0, 0, NULL, 0),
(32, 'RanjitS', 0, 0, NULL, 0),
(33, 'sagar', 0, 0, NULL, 0),
(34, 'praful', 0, 0, NULL, 0),
(35, 'rehan', 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(7) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `no_of_members` int(11) NOT NULL,
  `name_of_members` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `no_of_members`, `name_of_members`) VALUES
(51, 'FirstTeam', 2, 'omkar bhoir, sagar'),
(52, 'SecondTeam', 2, 'bhavesh, praful'),
(56, 'abc', 2, 'harsh, Vasant'),
(58, 'jugadu', 2, 'vaishnavi,  rashmi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `scoreboard`
--
ALTER TABLE `scoreboard`
  ADD PRIMARY KEY (`No`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `scoreboard`
--
ALTER TABLE `scoreboard`
  MODIFY `No` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
