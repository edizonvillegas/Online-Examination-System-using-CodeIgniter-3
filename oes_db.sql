-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2018 at 03:30 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oes_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `oes_answers`
--

CREATE TABLE `oes_answers` (
  `answer_no` int(11) NOT NULL,
  `question_no` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `answer_answer` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `oes_answers`
--

INSERT INTO `oes_answers` (`answer_no`, `question_no`, `answer_id`, `answer_answer`) VALUES
(1, 1, 1, 'D'),
(2, 2, 1, 'A'),
(9, 3, 1, 'B'),
(10, 4, 1, 'B'),
(11, 5, 1, 'A'),
(12, 12, 1, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `oes_choices`
--

CREATE TABLE `oes_choices` (
  `choice_no` int(11) NOT NULL,
  `question_no` int(11) NOT NULL,
  `choice_id` int(11) NOT NULL,
  `choice_choice` varchar(1) NOT NULL,
  `choice_text` text NOT NULL,
  `choice_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `oes_choices`
--

INSERT INTO `oes_choices` (`choice_no`, `question_no`, `choice_id`, `choice_choice`, `choice_text`, `choice_type`) VALUES
(1, 1, 1, 'A', 'Personal Home Page', 1),
(2, 1, 1, 'B', 'PHP: Hypertext preprocessor', 1),
(3, 2, 1, 'A', 'Rasmus Lerdorf', 1),
(6, 2, 1, 'B', 'aling vicky', 1),
(7, 2, 1, 'C', 'lorem ipsum', 1),
(12, 3, 1, 'A', 'choice1', 1),
(13, 3, 1, 'B', 'choice2', 1),
(14, 4, 1, 'A', '1', 1),
(15, 4, 1, 'B', '2', 1),
(16, 4, 1, 'C', '3', 1),
(17, 1, 1, 'C', 'none of the above', 1),
(18, 5, 1, 'A', 'choice1', 1),
(24, 6, 1, '', '', 3),
(25, 1, 1, 'D', 'secret', 1),
(26, 12, 1, 'A', 'first', 1),
(27, 12, 1, 'B', 'second', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oes_examiners`
--

CREATE TABLE `oes_examiners` (
  `examiner_no` int(11) NOT NULL,
  `examiner_id` int(11) NOT NULL,
  `examiner_topics` int(11) NOT NULL,
  `examiner_topic_date_taken` varchar(40) CHARACTER SET utf16 COLLATE utf16_bin DEFAULT NULL,
  `examiner_score` varchar(3) DEFAULT NULL,
  `examiner_status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `oes_examiners`
--

INSERT INTO `oes_examiners` (`examiner_no`, `examiner_id`, `examiner_topics`, `examiner_topic_date_taken`, `examiner_score`, `examiner_status`) VALUES
(48, 2, 1, 'Jun 28 2018 14:46:36', '2', '0'),
(54, 3, 1, 'Jun 28 2018 14:46:36', '2', '0'),
(55, 3, 2, 'Jun 28 2018 14:46:36', '2', '0');

-- --------------------------------------------------------

--
-- Table structure for table `oes_questions`
--

CREATE TABLE `oes_questions` (
  `question_no` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `question_question` text NOT NULL,
  `question_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `oes_questions`
--

INSERT INTO `oes_questions` (`question_no`, `question_id`, `question_question`, `question_status`) VALUES
(1, 1, 'what is php??', 1),
(2, 1, 'who created php?', 1),
(3, 1, 'what is a variable??', 1),
(4, 1, 'test2', 1),
(5, 1, 'test 3', 1),
(6, 1, 'test 4', 0),
(7, 2, 'QUESTION #1', 1),
(8, 2, 'QUESTION #2', 0),
(9, 3, 'question #1', 0),
(10, 4, 'question #1', 1),
(11, 4, 'question #2', 1),
(12, 1, 'test 5', 1),
(13, 1, 'test 6', 0),
(14, 16, 'test1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oes_records`
--

CREATE TABLE `oes_records` (
  `record_id` int(11) NOT NULL,
  `record_user_id` int(11) NOT NULL,
  `record_topic_id` int(11) NOT NULL,
  `record_question_id` int(11) NOT NULL,
  `record_answer` text NOT NULL,
  `record_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `oes_records`
--

INSERT INTO `oes_records` (`record_id`, `record_user_id`, `record_topic_id`, `record_question_id`, `record_answer`, `record_date`) VALUES
(1, 2, 1, 1, 'B', '2018-06-28 06:46:46'),
(2, 2, 1, 2, 'C', '2018-06-28 06:46:46'),
(3, 2, 1, 3, 'B', '2018-06-28 06:46:46'),
(4, 2, 1, 4, 'C', '2018-06-28 06:46:46'),
(5, 2, 1, 5, 'A', '2018-06-28 06:46:46'),
(6, 2, 1, 6, 'B', '2018-06-28 06:46:46');

-- --------------------------------------------------------

--
-- Table structure for table `oes_topics`
--

CREATE TABLE `oes_topics` (
  `topic_id` int(11) NOT NULL,
  `topic_title` varchar(100) NOT NULL,
  `topic_slug` varchar(100) NOT NULL,
  `topic_duration` varchar(5) NOT NULL,
  `topic_date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `topic_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `oes_topics`
--

INSERT INTO `oes_topics` (`topic_id`, `topic_title`, `topic_slug`, `topic_duration`, `topic_date_added`, `topic_status`) VALUES
(1, 'PHP Job Exam 2018', 'PHP-Job-Exam-2018', '01:00', '2018-07-10 00:14:41', 1),
(2, 'JavaScript Job Exam 2018', 'JavaScript-Job-Exam-2018', '', '2018-06-07 02:09:52', 1),
(3, 'C++ Job Exam 2018', 'Cplusplus-Job-Exam-2018', '', '2018-06-07 02:11:38', 0),
(4, 'NodeJS Job Exam 2018', 'NodeJS-Job-Exam-2018', '', '2018-06-07 02:11:38', 0),
(5, 'test lang', 'test-lang', '', '2018-06-07 02:11:38', 0),
(6, 'c++ new', 'cplusplus-new', '', '2018-06-07 02:11:38', 0),
(7, '2018 On-the job examination', '2018-On-the-job-examination', '', '2018-06-25 06:26:25', 0),
(8, 'php exam 01', 'php-exam-01', '', '2018-06-07 02:11:38', 0),
(9, 'php exam 02', 'php-exam-02', '', '2018-06-07 02:11:38', 0),
(10, 'php exam 03', 'php-exam-03', '', '2018-06-07 02:11:38', 0),
(15, 'php exam 04', 'php-exam-04', '', '2018-06-07 02:11:38', 0),
(16, 'a', 'a', '', '2018-06-07 02:11:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `oes_users`
--

CREATE TABLE `oes_users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `user_uname` varchar(60) NOT NULL,
  `user_pw` varchar(60) NOT NULL,
  `user_position` int(1) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_google_login` int(1) NOT NULL,
  `user_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `oes_users`
--

INSERT INTO `oes_users` (`user_id`, `user_name`, `user_uname`, `user_pw`, `user_position`, `user_email`, `user_date_added`, `user_last_login`, `user_google_login`, `user_status`) VALUES
(1, 'Edizon Villegas', 'Edizon', '$2y$10$NdJf/fT5xu3hMPnIZMrT4.cOOKmhvBNmvch.peZJB.H7kCAdcxiP6', 0, 'edizonv@gmail.com', '2018-05-17 04:24:36', '2018-07-09 23:58:45', 0, 1),
(2, 'test test', 'test', '$2y$10$NdJf/fT5xu3hMPnIZMrT4.cOOKmhvBNmvch.peZJB.H7kCAdcxiP6', 1, 'test@gmail.com', '2018-05-17 04:24:36', '2018-07-09 05:05:38', 0, 1),
(3, 'dummy dummy', 'dummy', '$2y$10$NdJf/fT5xu3hMPnIZMrT4.cOOKmhvBNmvch.peZJB.H7kCAdcxiP6', 1, 'dummy@gmail.com', '2018-05-17 04:24:36', '2018-05-29 02:00:50', 0, 1),
(4, 'aling vicky', 'vicky', '$2y$10$NdJf/fT5xu3hMPnIZMrT4.cOOKmhvBNmvch.peZJB.H7kCAdcxiP6', 1, 'alingVicky@gmail.com', '2018-05-17 04:24:36', '2018-05-29 02:00:50', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oes_answers`
--
ALTER TABLE `oes_answers`
  ADD PRIMARY KEY (`answer_no`);

--
-- Indexes for table `oes_choices`
--
ALTER TABLE `oes_choices`
  ADD PRIMARY KEY (`choice_no`);

--
-- Indexes for table `oes_examiners`
--
ALTER TABLE `oes_examiners`
  ADD PRIMARY KEY (`examiner_no`);

--
-- Indexes for table `oes_questions`
--
ALTER TABLE `oes_questions`
  ADD PRIMARY KEY (`question_no`);

--
-- Indexes for table `oes_records`
--
ALTER TABLE `oes_records`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `oes_topics`
--
ALTER TABLE `oes_topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `question_topic` (`topic_title`);

--
-- Indexes for table `oes_users`
--
ALTER TABLE `oes_users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_uname` (`user_uname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `oes_answers`
--
ALTER TABLE `oes_answers`
  MODIFY `answer_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `oes_choices`
--
ALTER TABLE `oes_choices`
  MODIFY `choice_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `oes_examiners`
--
ALTER TABLE `oes_examiners`
  MODIFY `examiner_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `oes_questions`
--
ALTER TABLE `oes_questions`
  MODIFY `question_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `oes_records`
--
ALTER TABLE `oes_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `oes_topics`
--
ALTER TABLE `oes_topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `oes_users`
--
ALTER TABLE `oes_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
