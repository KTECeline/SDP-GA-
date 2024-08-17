-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2024 at 01:15 PM
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
  `CERTIFICATE_NAME` varchar(255) NOT NULL,
  `CERTIFICATE_FEEDBACK` varchar(255) DEFAULT NULL,
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
  `TIME_TAKEN` datetime NOT NULL DEFAULT current_timestamp(),
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
(31, 'Which of the following is the correct way to open a file in read mode in Python?', 'To open a file for reading, use the mode that specifies \'read\'.\r\n', 'file = open(\'filename.txt\', \'o\')', '\'o\' is not a valid mode for opening a file.', 'file = open(\'filename.txt\', \'r\')', '\'r\' opens the file in read mode, which is the correct choice.', 'file = open(\'filename.txt\', \'w\')', '\'w\' opens the file in write mode, which does not work for reading.', 'file = open(\'filename.txt\', \'a\')', '\'a\' opens the file in append mode, which is not used for reading.', 'B', 4),
(32, 'How can you write the string \"Hello, World!\" into a file named example.txt in Python?\r\n', 'To write to a file, use the mode that allows creating or overwriting the file.\r\n', 'with open(\'example.txt\', \'w\') as file:\r\n     file.write(\"Hello, World!\")\r\n', '\'w\' mode opens the file for writing, creating it if it doesn’t exist, and writing the specified string.', 'with open(\'example.txt\', \'r\') as file:\r\n     file.write(\"Hello, World!\")\r\n', '\'r\' mode is for reading only, and does not allow writing.', 'with open(\'example.txt\', \'o\') as file:\r\n     file.write(\"Hello, World!\")\r\n', '\'o\' is not a valid mode for file operations.', 'with open(\'example.txt\', \'a\') as file:\r\n     file.write(\"Hello, World!\")\r\n', '\'a\' mode opens the file for appending, which also writes to the file but does not overwrite existing content.', 'A', 4),
(33, 'Which function is used to read the entire content of a file in Python?\r\n', 'To get the complete content of a file in one go, use the method that reads all the data.', 'file.readlines()\r\n\r\n', 'Reads the file line by line into a list.', 'file.readall()\r\n', 'This is not a valid method for reading files.', 'file.read()', 'Reads the entire content of the file as a single string.', 'file.readfile()\r\n', 'This is not a valid method for reading files.', 'C', 4),
(34, 'How do you get the current date and time in Python using the datetime module?\r\n\r\n', 'To obtain the current date and time, call a method from the datetime class.', 'datetime.now()\r\n\r\n\r\n', 'This method is used to get the current date and time.', 'datetime.datetime()\r\n\r\n', 'This is not used for getting the current date and time.', 'datetime.time.now()\r\n', 'This method does not exist for getting date and time.', 'datetime.datetime.now()\r\n\r\n', 'This method is also valid for getting the current date and time, with correct class usage.', 'D', 4),
(35, 'Which of the following is the correct way to append data to an existing file in Python?\r\n', 'To add new data to a file without deleting the existing content, use the append mode.', 'with open(\'example.txt\', \'a\') as file:\r\n     file.write(\"New data\")\r\n\r\n\r\n\r\n', '\'a\' mode allows appending data to the end of the file.', 'with open(\'example.txt\', \'w\') as file:\r\n     file.write(\"New data\")\r\n\r\n\r\n', '\'w\' mode overwrites the file content.', 'with open(\'example.txt\', \'r\') as file:\r\n     file.write(\"New data\")', '\'r\' mode is for reading only.', 'with open(\'example.txt\', \'o\') as file:\r\n     file.write(\"New data\")\r\n', '\'o\' is not a valid file mode.', 'A', 4),
(36, 'How do you import the datetime module in Python?\r\n\r\n', 'Use the import statement that suits your need for the whole module or a specific class.', 'import datetime as dt', 'Imports datetime with an alias dt.', 'from datetime import *\r\n', 'Imports everything from the datetime module.', 'import datetime ', 'Imports the datetime module without alias.', 'from datetime import datetime\r\n', 'Imports only the datetime class from the datetime module.', 'C', 4),
(37, 'How do you close a file after reading or writing in Python?\r\n\r\n\r\n', 'To properly close a file, call the method on the file object itself.', 'close(file)', 'This is not a valid way to close a file.', 'file.close()\r\n', 'This method closes the file object properly.', 'file.end()', 'This is not a valid method for closing files.', 'end(file)', 'This is not a valid method for closing files.', 'B', 4),
(38, 'What does the strip() method do when used with file input in Python?\r\n\r\n\r\n', 'The strip() method cleans up whitespace from the edges of a string.', 'Splits the file into lines', 'strip() does not split file contents.', 'Reads the entire file contents into memory', 'strip() does not handle file reading.', 'Removes all whitespace characters', 'strip() specifically removes leading and trailing whitespace, not all whitespace.', 'Removes leading and trailing whitespace characters\r\n', 'strip() removes whitespace from the start and end of a string.', 'D', 4),
(39, 'How can you handle exceptions when opening a file in Python?\r\n\r\n', 'To catch and handle errors during file operations, use the block designed for handling exceptions.\r\n', 'try...except block', 'Use a try...except block to catch exceptions that may occur during file operations.\r\n', 'if...else block', 'if...else is used for conditional statements, not for handling exceptions.\r\n', 'switch...case block', 'Python does not have a switch...case construct.\r\n', 'error_handling() function', 'There is no built-in error_handling() function for file operations.', 'A', 4),
(40, 'How do you write multiple lines to a file in Python? \r\n', 'To write multiple lines to a file efficiently, use a method that accepts a list of strings and writes each line to the file.', 'file.writelines([\'line1\', \'line2\'])', 'This is the correct method for writing multiple lines to a file. file.writelines() accepts a list of strings and writes each string to the file without adding newline characters between them.', 'file.write([\'line1\', \'line2\'])\r\n', 'file.write() does not accept a list of strings; it expects a single string. This option would result in a TypeError.\r\n', 'file.write_multiple([\'line1\', \'line2\'])', 'file.write_multiple() is not a valid method for file objects in Python. There is no built-in method with this name.\r\n\r\n', 'file.append([\'line1\', \'line2\'])\r\n', 'file.append() is not a valid method for file objects in Python. To append data to a file, you should open the file in append mode \'a\' and use file.write() or file.writelines().', 'A', 4);

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
(1, 'Hui Nan', 'huinan26@gmail.com', '011-20186158', 'huinannn', 'hn123', 'user'),
(2, 'Celine', 'celine@gmail.com', '011-20246666', 'celine', 'celine123', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificate_information`
--
ALTER TABLE `certificate_information`
  ADD PRIMARY KEY (`CERTIFICATE_ID`),
  ADD KEY `user_id_ibfk_1` (`USER_ID`) USING BTREE;

--
-- Indexes for table `episode`
--
ALTER TABLE `episode`
  ADD PRIMARY KEY (`EPISODE_ID`);

--
-- Indexes for table `episode_result`
--
ALTER TABLE `episode_result`
  ADD PRIMARY KEY (`EPISODE_RESULT_ID`),
  ADD KEY `episode_id_ibfk_1` (`EPISODE_ID`),
  ADD KEY `user_id_ibfk_1` (`USER_ID`) USING BTREE;

--
-- Indexes for table `game_episode`
--
ALTER TABLE `game_episode`
  ADD PRIMARY KEY (`EPISODE_QUESTION_ID`),
  ADD KEY `game_episode_ibfk_1` (`EPISODE_ID`) USING BTREE;

--
-- Indexes for table `score_information`
--
ALTER TABLE `score_information`
  ADD PRIMARY KEY (`SCORE_ID`),
  ADD KEY `user_id_ibfk_1` (`USER_ID`) USING BTREE;

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
  MODIFY `CERTIFICATE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `EPISODE_QUESTION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `score_information`
--
ALTER TABLE `score_information`
  ADD CONSTRAINT `score_information_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `user_information` (`USER_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
