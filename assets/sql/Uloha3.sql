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
-- Database: `Uloha3`
--

-- --------------------------------------------------------

--
-- Table structure for table `mail_logs`
--

CREATE TABLE `mail_logs` (
  `id` int(11) NOT NULL,
  `student` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `template_id` int(11) NOT NULL,
  `sent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mail_logs`
--

INSERT INTO `mail_logs` (`id`, `student`, `title`, `template_id`, `sent`) VALUES
(39, 'Priezvisko Meno', 'ddddddddddd', 1, '2019-05-18 18:50:14'),
(40, 'Priezvisko Meno', 'ddddddddddd', 1, '2019-05-18 18:50:15');

-- --------------------------------------------------------

--
-- Table structure for table `mail_templates`
--

CREATE TABLE `mail_templates` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `template` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mail_templates`
--

INSERT INTO `mail_templates` (`id`, `title`, `template`) VALUES
(1, 'Super Šablóna študentov', 'Dobrý deň,\r\n,\r\nna predmete Webové technológie 2 budete mať k dispozícii vlastný virtuálny linux server, ktorý budete\r\npoužívať počas semestra, a na ktorom budete vypracovávať zadania. Prihlasovacie údaje k Vašemu serveru\r\nsu uvedené nižšie.\r\nip adresa: {{VerejnaIP}}\r\nprihlasovacie meno: {{login}}\r\nheslo: {{heslo}}\r\nVaše web stránky budú dostupné na: http:// {{VerejnaIP}}:{{http}}\r\nS pozdravom,\r\n{{sender}}'),
(2, 'Super Šablóna 2', 'Dobrý deň,\r\nna predmete Webové technológie 2 budete mať k dispozícii vlastný virtuálny linux server, ktorý budete\r\npoužívať počas semestra, a na ktorom budete vypracovávať zadania. Prihlasovacie údaje k Vašemu serveru\r\nsu uvedené nižšie.\r\nip adresa: {{verejnaIP}}\r\nprihlasovacie meno: {{login}}\r\nheslo: {{heslo}}\r\nVaše web stránky budú dostupné na: http:// {{verejnaIP}}:{{http}}\r\nS pozdravom,\r\n{{sender}}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mail_logs`
--
ALTER TABLE `mail_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `template_id` (`template_id`);

--
-- Indexes for table `mail_templates`
--
ALTER TABLE `mail_templates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mail_logs`
--
ALTER TABLE `mail_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `mail_templates`
--
ALTER TABLE `mail_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `mail_logs`
--
ALTER TABLE `mail_logs`
  ADD CONSTRAINT `mail_logs_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `mail_templates` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
