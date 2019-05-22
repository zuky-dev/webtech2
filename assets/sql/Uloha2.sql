-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2019 at 06:57 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Uloha2`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id_student` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `ais_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id_student`, `name`, `email`, `password`, `ais_id`) VALUES
(139, 'Holecova Silvia', 'xholecova@is.stuba.sk', 'NULL', 7955),
(140, 'Mrkvicka Jano', 'xmrkvicka@is.stuba.sk', 'adbgh', 7985),
(141, 'Kovacova Jana', 'xkovacova@is.stuba.sk', 'NULL', 8955),
(142, 'Lences Tomas', 'xlences@is.stuba.sk', 'dfg', 8755),
(143, 'Student test', 'xstudent@is.stuba.sk', 'student', 9999),
(144, 'Admin test', 'xadmin@is.stuba.sk', 'admin', 9998);

-- --------------------------------------------------------

--
-- Table structure for table `studentTeam`
--

CREATE TABLE `studentTeam` (
  `id_studentTeam` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `pointsStudent` double DEFAULT NULL,
  `confirmStudent` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studentTeam`
--

INSERT INTO `studentTeam` (`id_studentTeam`, `student_id`, `team_id`, `pointsStudent`, `confirmStudent`) VALUES
(164, 139, 98, 10, NULL),
(165, 140, 98, 10, NULL),
(166, 141, 99, NULL, 1),
(167, 142, 100, NULL, 0),
(168, 139, 101, 20, 1),
(169, 140, 101, 11, NULL),
(170, 141, 102, NULL, NULL),
(171, 142, 103, NULL, NULL),
(172, 139, 103, 15, 1),
(173, 140, 103, 14, NULL),
(174, 141, 103, 45, NULL),
(175, 142, 103, NULL, NULL),
(176, 139, 103, 15, 1),
(177, 140, 103, 14, NULL),
(178, 141, 103, 45, NULL),
(179, 142, 103, NULL, NULL),
(180, 139, 103, 15, 1),
(181, 140, 103, 14, NULL),
(182, 141, 103, 45, NULL),
(183, 142, 103, NULL, NULL),
(184, 139, 103, 15, 1),
(185, 140, 103, 14, NULL),
(186, 141, 103, 45, NULL),
(187, 142, 103, NULL, NULL),
(188, 139, 103, 15, 1),
(189, 140, 103, 14, NULL),
(190, 141, 103, 45, NULL),
(191, 142, 103, NULL, NULL),
(192, 143, 103, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id_subject` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `years` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id_subject`, `subject_name`, `years`) VALUES
(40, 'Webove Technologie', '2018/2019'),
(41, 'VSA', '2018/2019'),
(42, '', '2018/2019'),
(43, '', '2018/2019'),
(44, '', '2018/2019'),
(45, 'VSA', '2016/2017'),
(46, 'VSA', '2017/2018'),
(47, 'VSA', '2018/2019'),
(48, 'VSA', '2015/2016'),
(49, '', '2018/2019'),
(50, '', '2018/2019'),
(51, 'Webove Technologie', '2017/2018'),
(52, '', '2018/2019'),
(53, '', '2018/2019'),
(54, '', '2018/2019'),
(55, '', '2018/2019');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id_team` int(11) NOT NULL,
  `numberTeam` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `pointsTeam` double DEFAULT NULL,
  `confirmAdmin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id_team`, `numberTeam`, `subject_id`, `pointsTeam`, `confirmAdmin`) VALUES
(98, 11, 40, 40, 1),
(99, 14, 40, NULL, 0),
(100, 1, 40, NULL, 1),
(101, 11, 41, 21, 0),
(102, 14, 41, NULL, 0),
(103, 1, 41, 44, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_student`);

--
-- Indexes for table `studentTeam`
--
ALTER TABLE `studentTeam`
  ADD PRIMARY KEY (`id_studentTeam`),
  ADD KEY `student_fk` (`student_id`),
  ADD KEY `team_fk` (`team_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id_subject`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id_team`),
  ADD KEY `subject_fk` (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
--
-- AUTO_INCREMENT for table `studentTeam`
--
ALTER TABLE `studentTeam`
  MODIFY `id_studentTeam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id_subject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id_team` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `studentTeam`
--
ALTER TABLE `studentTeam`
  ADD CONSTRAINT `student_fk` FOREIGN KEY (`student_id`) REFERENCES `student` (`id_student`),
  ADD CONSTRAINT `team_fk` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id_team`);

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `subject_fk` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id_subject`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
