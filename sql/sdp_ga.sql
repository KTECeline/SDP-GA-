-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2024 at 03:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdp_ga`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificate_information`
--

CREATE TABLE `certificate_information` (
  `CERTIFICATE_ID` int(11) NOT NULL,
  `CERTIFICATE_TEMPLATE` varchar(255) NOT NULL,
  `USER_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `episode`
--

CREATE TABLE `episode` (
  `EPISODE_ID` int(11) NOT NULL,
  `EPISODE_NAME` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `episode_result`
--

CREATE TABLE `episode_result` (
  `EPISODE_RESULT_ID` int(11) NOT NULL,
  `TIME_TAKEN` timestamp NOT NULL DEFAULT current_timestamp(),
  `SCORE` int(11) NOT NULL,
  `EPISODE_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game_episode`
--

CREATE TABLE `game_episode` (
  `EPISODE_QUESTION_ID` int(11) NOT NULL,
  `EPISODE_QUESTION` varchar(255) NOT NULL,
  `EPISODE_HINT` varchar(255) NOT NULL,
  `OPTION_A` varchar(255) NOT NULL,
  `OPTION_A_EXPLANATION` varchar(255) NOT NULL,
  `OPTION_B` varchar(255) NOT NULL,
  `OPTION_B_EXPLANATION` varchar(255) NOT NULL,
  `OPTION_C` varchar(255) NOT NULL,
  `OPTION_C_EXPLANATION` varchar(255) NOT NULL,
  `OPTION_D` varchar(255) NOT NULL,
  `OPTION_D_EXPLANATION` varchar(255) NOT NULL,
  `CORRECT_ANSWER` varchar(255) NOT NULL,
  `EPISODE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `score_information`
--

CREATE TABLE `score_information` (
  `SCORE_ID` int(11) NOT NULL,
  `EPISODE_TOTAL_SCORE` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_information`
--

CREATE TABLE `user_information` (
  `USER_ID` int(11) NOT NULL,
  `USER_NAME` varchar(255) NOT NULL,
  `USER_EMAIL` varchar(255) NOT NULL,
  `USER_PHONENUMBER` varchar(255) NOT NULL,
  `USER_USERNAME` varchar(255) NOT NULL,
  `USER_PASSWORD` varchar(50) NOT NULL,
  `ROLES` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificate_information`
--
ALTER TABLE `certificate_information`
  ADD PRIMARY KEY (`CERTIFICATE_ID`);

--
-- Indexes for table `episode`
--
ALTER TABLE `episode`
  ADD PRIMARY KEY (`EPISODE_ID`);

--
-- Indexes for table `episode_result`
--
ALTER TABLE `episode_result`
  ADD PRIMARY KEY (`EPISODE_RESULT_ID`);

--
-- Indexes for table `game_episode`
--
ALTER TABLE `game_episode`
  ADD PRIMARY KEY (`EPISODE_QUESTION_ID`);

--
-- Indexes for table `score_information`
--
ALTER TABLE `score_information`
  ADD PRIMARY KEY (`SCORE_ID`);

--
-- Indexes for table `user_information`
--
ALTER TABLE `user_information`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificate_information`
--
ALTER TABLE `certificate_information`
  MODIFY `CERTIFICATE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `episode`
--
ALTER TABLE `episode`
  MODIFY `EPISODE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `episode_result`
--
ALTER TABLE `episode_result`
  MODIFY `EPISODE_RESULT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game_episode`
--
ALTER TABLE `game_episode`
  MODIFY `EPISODE_QUESTION_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `score_information`
--
ALTER TABLE `score_information`
  MODIFY `SCORE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_information`
--
ALTER TABLE `user_information`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
