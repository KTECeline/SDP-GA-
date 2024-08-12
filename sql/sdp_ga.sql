-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2024 at 07:10 PM
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

--
-- Dumping data for table `episode`
--

INSERT INTO `episode` (`EPISODE_ID`, `EPISODE_NAME`) VALUES
(1, 'EP1'),
(2, 'EP2'),
(3, 'EP3'),
(4, 'EP4');

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

--
-- Dumping data for table `game_episode`
--

INSERT INTO `game_episode` (`EPISODE_QUESTION_ID`, `EPISODE_QUESTION`, `EPISODE_HINT`, `OPTION_A`, `OPTION_A_EXPLANATION`, `OPTION_B`, `OPTION_B_EXPLANATION`, `OPTION_C`, `OPTION_C_EXPLANATION`, `OPTION_D`, `OPTION_D_EXPLANATION`, `CORRECT_ANSWER`, `EPISODE_ID`) VALUES
(1, 'Which of the following is the correct way to open a file in read mode in Python?', 'To open a file for reading, use the mode that specifies \'read\'.', 'file = open(\'filename.txt\', \'o\')', '\'o\' is not a valid mode for opening a file.', 'file = open(\'filename.txt\', \'r\')', '\'r\' opens the file in read mode, which is the correct choice.', 'file = open(\'filename.txt\', \'w\')', '\'w\' opens the file in write mode, which does not work for reading.', 'file = open(\'filename.txt\', \'a\')', '\'a\' opens the file in append mode, which is not used for reading.', 'B', 4),
(2, 'How can you write the string \"Hello, World!\" into a file named example.txt in Python?\r\n', 'To write to a file, use the mode that allows creating or overwriting the file.', 'with open(\'example.txt\', \'w\') as file:\r\n     file.write(\"Hello, World!\")', '\'w\' mode opens the file for writing, creating it if it doesn’t exist, and writing the specified string.', 'with open(\'example.txt\', \'r\') as file:\r\n     file.write(\"Hello, World!\")', '\'r\' mode is for reading only, and does not allow writing.', 'with open(\'example.txt\', \'o\') as file:\r\n     file.write(\"Hello, World!\")', '\'o\' is not a valid mode for file operations.', 'with open(\'example.txt\', \'a\') as file:\r\n     file.write(\"Hello, World!\")', '\'a\' mode opens the file for appending, which also writes to the file but does not overwrite existing content.', 'A', 4),
(3, 'How do you get the current date and time in Python using the datetime module?', 'To obtain the current date and time, call a method from the datetime class.', 'datetime.now()', 'This method is used to get the current date and time.', 'datetime.datetime()', 'This is not used for getting the current date and time.', 'datetime.time.now()', 'This method does not exist for getting date and time.', 'datetime.datetime.now()', 'This method is also valid for getting the current date and time, with correct class usage.', 'D', 4),
(4, 'Which of the following is the correct way to append data to an existing file in Python?', 'To add new data to a file without deleting the existing content, use the append mode.', 'with open(\'example.txt\', \'a\') as file:\r\n     file.write(\"New data\")\r\n\r\n', '\'a\' mode allows appending data to the end of the file.', 'with open(\'example.txt\', \'w\') as file:\r\n     file.write(\"New data\")\r\n', '\'w\' mode overwrites the file content.', 'with open(\'example.txt\', \'r\') as file:\r\n     file.write(\"New data\")', '\'r\' mode is for reading only.', 'with open(\'example.txt\', \'o\') as file:\r\n     file.write(\"New data\")', '\'o\' is not a valid file mode.', 'A', 4),
(5, 'What does the strip() method do when used with file input in Python?', 'The strip() method cleans up whitespace from the edges of a string.', 'Splits the file into lines', 'strip() does not split file contents.', 'Reads the entire file contents into memory', 'strip() does not handle file reading.', 'Removes leading and trailing whitespace characters', 'strip() removes whitespace from the start and end of a string.', 'Removes all whitespace characters', 'strip() specifically removes leading and trailing whitespace, not all whitespace.', 'C', 4);

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
-- Dumping data for table `user_information`
--

INSERT INTO `user_information` (`USER_ID`, `USER_NAME`, `USER_EMAIL`, `USER_PHONENUMBER`, `USER_USERNAME`, `USER_PASSWORD`, `ROLES`) VALUES
(1, 'Hui Nan', 'huinan26@gmail.com', '011-20186158', 'huinannn', 'hn123', 'user');

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
  MODIFY `EPISODE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `episode_result`
--
ALTER TABLE `episode_result`
  MODIFY `EPISODE_RESULT_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game_episode`
--
ALTER TABLE `game_episode`
  MODIFY `EPISODE_QUESTION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `score_information`
--
ALTER TABLE `score_information`
  MODIFY `SCORE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_information`
--
ALTER TABLE `user_information`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
