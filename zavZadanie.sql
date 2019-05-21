-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: localhost:3306
-- Čas generovania: Út 21.Máj 2019, 15:46
-- Verzia serveru: 5.7.25-0ubuntu0.18.04.2
-- Verzia PHP: 7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `zavZadanie`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `Predmet`
--

CREATE TABLE `Predmet` (
  `ID` int(11) NOT NULL,
  `idStudent` int(11) NOT NULL,
  `meno` varchar(100) NOT NULL,
  `prednaska` double NOT NULL,
  `cvicenie` double NOT NULL,
  `zapocty` double NOT NULL,
  `projekt` double NOT NULL,
  `skuska` double NOT NULL,
  `spolu` double NOT NULL,
  `znamka` varchar(100) NOT NULL,
  `id_uloha1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `Predmet`
--

INSERT INTO `Predmet` (`ID`, `idStudent`, `meno`, `prednaska`, `cvicenie`, `zapocty`, `projekt`, `skuska`, `spolu`, `znamka`, `id_uloha1`) VALUES
(92, 12345, 'Mrkvicka Jan', 8, 25.25, 12, 16, 14.9, 73.77, 'D', 219),
(93, 24598, 'Zamozny Roman', 8, 26.05, 17, 14, 20, 85.05, 'B', 219),
(94, 54187, 'Stonozka Marian', 7, 25.78, 17, 24, 14.5, 88.28, 'B', 219),
(95, 23581, 'Salatova Petra', 8, 30, 19, 30, 20, 107, 'A', 219),
(96, 12345, 'Mrkvicka Jan', 8, 25.25, 12, 16, 14.9, 73.77, 'D', 220),
(97, 24598, 'Zamozny Roman', 8, 26.05, 17, 14, 20, 85.05, 'B', 220),
(98, 54187, 'Stonozka Marian', 7, 25.78, 17, 24, 14.5, 88.28, 'B', 220),
(99, 23581, 'Salatova Petra', 8, 30, 19, 30, 20, 107, 'A', 220),
(100, 12345, 'Mrkvicka Jan', 8, 25, 12, 16, 14, 73, 'D', 221),
(101, 24598, 'Zamozny Roman', 8, 26, 17, 14, 20, 85, 'B', 221),
(102, 54187, 'Stonozka Marian', 7, 25, 17, 24, 14, 88, 'B', 221),
(103, 23581, 'Salatova Petra', 8, 30, 19, 30, 20, 107, 'A', 221),
(109, 12345, 'Mrkvicka Jan', 8, 25, 12, 16, 14, 73, 'D', 224),
(110, 24598, 'Zamozny Roman', 8, 26, 17, 14, 20, 85, 'B', 224),
(111, 54187, 'Stonozka Marian', 7, 25, 17, 24, 14, 88, 'B', 224),
(112, 23581, 'Salatova Petra', 8, 30, 19, 30, 20, 107, 'A', 224);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `Uloha1`
--

CREATE TABLE `Uloha1` (
  `id_uloha1` int(11) NOT NULL,
  `skRok` varchar(100) NOT NULL,
  `predmet` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `Uloha1`
--

INSERT INTO `Uloha1` (`id_uloha1`, `skRok`, `predmet`) VALUES
(219, '2018/2019', 'VSA'),
(220, '2009/2010', 'PT'),
(221, '2020/2021', 'BP'),
(224, '2020/2021', 'BP2');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `Predmet`
--
ALTER TABLE `Predmet`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `uloha1_fk` (`id_uloha1`);

--
-- Indexy pre tabuľku `Uloha1`
--
ALTER TABLE `Uloha1`
  ADD PRIMARY KEY (`id_uloha1`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `Predmet`
--
ALTER TABLE `Predmet`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT pre tabuľku `Uloha1`
--
ALTER TABLE `Uloha1`
  MODIFY `id_uloha1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;
--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `Predmet`
--
ALTER TABLE `Predmet`
  ADD CONSTRAINT `uloha1_fk` FOREIGN KEY (`id_uloha1`) REFERENCES `Uloha1` (`id_uloha1`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
