-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2024 at 05:58 AM
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
-- Database: `phpadminpanel`
--

-- --------------------------------------------------------

--
-- Table structure for table `sms_otp`
--

CREATE TABLE `sms_otp` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `email_sent` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `created_at`, `email_sent`) VALUES
(1, 'bhavesh', '9370718122', 'bhaveshchoudhari1211@gmail.com', 'bhavesh12', NULL, 1),
(2, 'bhavesh2', '9537242734', 'bhaveshchoudhari36@gmail.com', 'bhavesh13', NULL, 1),
(3, 'vishal', '8253472332', 'vishalwarghade01@gmail.com', 'vishal123', NULL, 1),
(4, 'rashmi', '9235326422', 'rashmi24080@gmail.com', 'vikas123', NULL, 1),
(5, 'rahul', '8235236423', 'rahul.yadav@talakunchi.com', 'rahul123', NULL, 1),
(6, 'prathamesh', '9768916257', 'prathamesh.jadhav@talakunchi.com', 'abc123', NULL, 1),
(7, 'xyz', '8923546237', 'xyz@gmail.com', 'xyz123', NULL, 1),
(8, 'jkl', '9856352578', 'jkf@gmail.com', 'jkf123', NULL, 1),
(9, 'mno', '8734635324', 'mno@gmail.com', 'mno123', NULL, 1),
(10, 'pqr', '9824562342', 'pqr@gmail.com', 'pqr123', NULL, 1),
(11, 'sss', '9832452782', 'sss@gmail.com', 'sss123', NULL, 1),
(12, 'qqq', '9834672523', 'qqq@gmail.com', 'qqq123', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sms_otp`
--
ALTER TABLE `sms_otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sms_otp`
--
ALTER TABLE `sms_otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
