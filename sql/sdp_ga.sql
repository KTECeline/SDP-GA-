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
  `CERTIFICATE_FEEDBACK` varchar(255) DEFAULT NOT NULL,
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
(11, 'What will be the output of the following code?\r\nif 5 > 3:\r\n  print(\"Yes\") \r\nelse: \r\n  print(\"No\")', 'Compare the two numbers in the condition. If the condition is true, the code inside the \"if\" block will execute. If it\'s false, the code inside the \"else\" block will run. Think about whether 5 is greater than 3.', 'Yes', 'A. Correct. Since 5 is greater than 3, the condition 5 > 3 evaluates to True, and \"Yes\" is printed.\r\n\r\n+100 XP', 'No', 'B. Incorrect. This would be printed if the condition was False.\r\n\r\n-25 XP', 'Error', 'C. Incorrect. There is no syntax error in the code.\r\n\r\n-25 XP', 'None', 'D. Incorrect. The code will produce output.\r\n\r\n-25 XP', 'A', 2),
(12, 'What will be the output of the following code?\r\nnum = 5\r\nwhile num > 0:\r\n    if num % 2 == 0:\r\n        print(num, end=\" \")\r\n    num -= 1', 'Focus on the condition within the if statement and what it checks for each iteration.', '4 2', 'A. Correct! The code checks for even numbers using \"num % 2 == 0\". The \"while\" loop decreases \"num\" by 1 each time until it reaches 0, printing only the even numbers. +100 XP', '5 3 1', 'B. Incorrect! The loop doesn’t output odd numbers. The \"if\" statement specifically targets even numbers, so only they are printed, not odd ones. -25 XP', '4 2 0', 'C. Incorrect! The loop halts before \"num\" reaches 0. The condition \"num > 0\" ensures that the loop stops when \"num\" is 2, so 0 never gets printed. -25 XP', '5 4 3 2 1', 'D. Incorrect! The code doesn\'t print all numbers from 5 to 1. Instead, it skips over odd numbers because the condition \"num % 2 == 0\" filters them out. -25 XP', 'A', 2),
(13, 'Which of the following is the correct syntax for an if statement in Python?', 'Focus on how Python\'s syntax emphasizes simplicity, particularly in how conditions are structured without extra keywords like \"then\" or \"do.\"', 'if x > 5 then:', 'A. Incorrect! Python does not use \"then\" in if statements. \r\n\r\n-25 XP', 'if x > 5:', 'B. Correct! The correct syntax uses a colon after the condition. \r\n\r\n+100 XP', 'if (x > 5):', 'C. Incorrect. A colon is missing at the end of the condition. \r\n\r\n-25 XP', 'if x > 5 do:', 'D. Incorrect. Python does not use \"do\" in control flow. \r\n\r\n-25 XP', 'B', 2),
(14, 'What is the output of the following code?\r\nfor i in range(1, 5):\r\n    if i == 3:\r\n        continue\r\n    print(i)', 'Consider how the \"continue\" statement affects the flow of the loop when \"i\" is equal to 3. What happens to the \"print(i)\" statement in that iteration?', '0 1 2 3 4', 'B. Incorrect! The loop skips 3, so it is not printed. -25 XP', '1 2 4', 'B. Correct! The loop skips the value 3 due to the continue statement. +100 XP ', '0 1 2', 'C. Incorrect. The loop continues after 2, so 4 is also printed. -25 XP', '1 3 4', 'D. Incorrect. The loop skips 3, so this output is incorrect. -25 XP', 'B', 2),
(15, 'Which of the following is not a valid loop control statement in Python?', 'Think about the common statements used to control loop execution, such as skipping iterations or exiting loops. One of the options is not recognized as a loop control statement in Python.', 'pass', 'A. Incorrect! pass is a valid statement that does nothing. -25 XP', 'continue', 'B. Incorrect. continue is a valid statement to skip to the next iteration. -25 XP', 'skip', 'C. Correct. skip is not a valid loop control statement in Python. +100 XP', 'break', 'D. Incorrect. break is a valid statement to exit a loop.\r\n\r\n-25 XP', 'C', 2),
(16, 'What will be the output of the following code?\r\nfor i in range(1, 5):\r\n    if i == 3:\r\n        continue\r\n    print(i)', 'The \"continue\" statement skips the current iteration of the loop and proceeds to the next one. Consider what happens when the loop reaches the value 3.', '1 2', 'A. Incorrect! The loop continues to 4. -25 XP', '1 2 3 4 ', 'B. Incorrect! The number 3 is skipped due to the continue statement.\r\n\r\n-25 XP', '1 2 4', 'C. Correct. The loop skips printing 3. +100 XP', '1 2 3', 'D. Incorrect. The loop skips 3 but continues to 4. -25 XP', 'C', 2),
(17, 'What will be the output?\r\ndef func(x, y=5):\r\n    return x * y\r\nresult = func(2)\r\nprint(result)', 'The function func multiplies its first argument \"x\" with its second argument \"y\". If the second argument \"y\" is not provided, it defaults to 5.', 'Error', 'A. Incorrect! The code is correct and runs without errors. -25 XP', '7', 'B. Incorrect! The function does not add but multiplies the values. -25 XP', '5', 'C. Incorrect. The value of \"x\" is 2, so the result is 10, not 5. -25 XP', 'Error', 'D. Correct. The function multiplies 2 by the default value of y which is 5. +100 XP', 'D', 2),
(18, 'What is the output of the following code?\r\n\r\nfor i in range(2):\r\n    for j in range(2):\r\n        print(i, j)', 'The code contains two nested loops. The outer loop runs twice, and for each iteration of the outer loop, the inner loop also runs twice. Think about how many times the \"print\" statement will execute and what values of \"i\" and \"j\" will be printed.', '0 0, 0 1, 1 0, 1 1', 'A. Correct! The nested loops go through all combinations of i and j. +100 XP', '0 0, 1 1', 'B. Incorrect! The loops generate more combinations, not just these two. -25 XP', '1 0, 1 1, 0 0, 0 1', 'C. Incorrect! The loops run in ascending order, not this order. -25 XP', '0 1, 1 0', 'D. Incorrect! The output order does not match this pattern. -25 XP', 'A', 2),
(19, 'What will be the output of the following code?\r\n\r\ndef func(x):\r\n    return x ** 2\r\nprint(func(3) + func(2))', 'The code defines a function that squares its input and then calls this function twice with different values. The output is the sum of the squared results.', '13', 'A. Correct! The function returns \r\n3^2 + 2^2 = 9 + 4= 13. +100 XP', '11', 'B. Incorrect! Wrong calculation. The correct result is 13. -25 XP', '25', 'C. Incorrect! The result should be 13. -25 XP', '9', 'D. Incorrect! Only 3^2 is considered here. -25 XP', 'A', 2),
(20, 'What will be the output of the following code?\r\n\r\nx = [1, 2, 3]\r\nx.append(4)\r\nprint(len(x))', 'To determine the output, consider how the \"append()\" method affects the length of the list.', '4', 'A. Correct! The append method adds one element to the list, making its length 4. +100 XP', '3', 'B. Incorrect! The list length is 4 after appending. -25 XP', '5', 'C. Incorrect! The length is 4, not 5. -25 XP', 'Error', 'D. Incorrect! The code is correct and will run without errors. -25 XP', 'A', 2),
(31, 'Which function is used to read the entire content of a file in Python?\r\n', 'To get the complete content of a file in one go, use the method that reads all the data.', 'file.readlines()\r\n\r\n', 'Reads the file line by line into a list.', 'file.readall()\r\n', 'This is not a valid method for reading files.', 'file.read()', 'Reads the entire content of the file as a single string.', 'file.readfile()\r\n', 'This is not a valid method for reading files.', 'C', 4),
(32, 'How can you write the string \"Hello, World!\" into a file named example.txt in Python?\r\n', 'To write to a file, use the mode that allows creating or overwriting the file.\r\n', 'with open(\'example.txt\', \'w\') as file:\r\n     file.write(\"Hello, World!\")\r\n', '\'w\' mode opens the file for writing, creating it if it doesn’t exist, and writing the specified string.', 'with open(\'example.txt\', \'r\') as file:\r\n     file.write(\"Hello, World!\")\r\n', '\'r\' mode is for reading only, and does not allow writing.', 'with open(\'example.txt\', \'o\') as file:\r\n     file.write(\"Hello, World!\")\r\n', '\'o\' is not a valid mode for file operations.', 'with open(\'example.txt\', \'a\') as file:\r\n     file.write(\"Hello, World!\")\r\n', '\'a\' mode opens the file for appending, which also writes to the file but does not overwrite existing content.', 'A', 4),
(33, 'Which of the following is the correct way to open a file in read mode in Python?', 'To open a file for reading, use the mode that specifies \'read\'.\r\n', 'file = open(\'filename.txt\', \'o\')', '\'o\' is not a valid mode for opening a file.', 'file = open(\'filename.txt\', \'r\')', '\'r\' opens the file in read mode, which is the correct choice.', 'file = open(\'filename.txt\', \'w\')', '\'w\' opens the file in write mode, which does not work for reading.', 'file = open(\'filename.txt\', \'a\')', '\'a\' opens the file in append mode, which is not used for reading.', 'B', 4),
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
