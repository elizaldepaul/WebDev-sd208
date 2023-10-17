-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2023 at 06:21 PM
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
-- Database: `sd208`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activity_id` int(11) NOT NULL,
  `activity_name` varchar(255) NOT NULL,
  `activity_time` time NOT NULL,
  `activity_date` date NOT NULL,
  `activity_location` varchar(255) NOT NULL,
  `activity_ootd` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `last_updated_time` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `activity_status` varchar(10) NOT NULL,
  `activity_owner` varchar(100) NOT NULL,
  `activity_remarks` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activity_id`, `activity_name`, `activity_time`, `activity_date`, `activity_location`, `activity_ootd`, `date_created`, `last_updated_time`, `activity_status`, `activity_owner`, `activity_remarks`, `user_id`) VALUES
(112, 'kaon', '09:56:00', '2023-10-17', 'cneter', 'istock girl.jpg', '2023-10-17 15:57:04', '2023-10-17 07:57:49', 'Pending', 'jaysa@gmail.com', '', 33),
(113, 'kapuya', '18:07:00', '2023-10-18', 'bh', 'darkforest.jpg', '2023-10-17 23:08:24', '2023-10-17 16:20:31', 'Done', 'anne@gmail.com', 'hahay bogo a', 34);

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement` varchar(500) NOT NULL,
  `announcement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcement`, `announcement_id`) VALUES
('dasf', 1),
('ge', 2),
('again\r\n\r\n', 3),
('g', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `First_name` varchar(100) NOT NULL,
  `Last_name` varchar(100) NOT NULL,
  `Age` varchar(100) NOT NULL,
  `Nick_name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Role` varchar(100) NOT NULL,
  `Status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `First_name`, `Last_name`, `Age`, `Nick_name`, `Email`, `Address`, `Gender`, `Password`, `Role`, `Status`) VALUES
(32, 'Paul Henry ', 'Elizalde', '21', 'paul', 'paul@gmail.com', 'bantyan', 'Male', '123', 'Admin', 'Active'),
(33, 'Jaysa Mae', 'Lendio', '21', 'Jays', 'jaysa@gmail.com', 'bantyan', 'Female', '123', 'User', 'Active'),
(34, 'Anne', 'Gulfan', '20', 'annie', 'anne@gmail.com', 'daan bantayan', 'Female', '1234', 'User', 'Active'),
(35, 'Rovelyn ', 'Paradero', '20', 'Rovs', 'rovelyn@gmail.com', 'balo', 'Other', '123', 'User', 'Active'),
(36, 'Jenelyn', 'Pepito', '20', 'jen', 'jenelyn@gmail.com', 'daan bantayan', 'Female', '123', 'User', 'Inactive'),
(43, 'Arvie ', 'Ingal', '20', 'arvs', 'arvie@gmail.com', 'Barugo,Leyte', 'Male', '123', 'User', 'Active'),
(44, 'Christa Jes', 'Loreto', '20', 'jes', 'jes@gmail.com', 'Alegria', 'Female', '123', 'User', 'Active'),
(45, 'Jay Clark', 'Anore', '20', 'clark', 'clark@gmail.com', 'Lapu-Lapu', 'Other', '123', 'User', 'Active'),
(46, 'Renato', 'Dlulog', '20', 'natoy', 'natoy@gmail.com', 'Lapu-Lapu', 'Other', '123', 'User', 'Active'),
(47, 'Reymond ', 'Calma', '20', 'monding', 'mond@gmail.com', 'mandaue', 'Male', '123', 'User', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `act` (`user_id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `act` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
