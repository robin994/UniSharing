-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Creato il: Dic 14, 2016 alle 10:55
-- Versione del server: 5.6.28
-- Versione PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unisharing`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `_account`
--

CREATE TABLE `_account` (
  `username` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `_account`
--

INSERT INTO `_account` (`username`, `password`) VALUES
('tester1@unisharing.it', 'enter1'),
('tester2@unisharing.it', 'enter2');

-- --------------------------------------------------------

--
-- Struttura della tabella `_accountpartecipateuser`
--

CREATE TABLE `_accountpartecipateuser` (
  `userId` int(11) DEFAULT NULL,
  `groupId` int(11) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `_blacklist`
--

CREATE TABLE `_blacklist` (
  `codeBlackList` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idBlockedUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `_exam`
--

CREATE TABLE `_exam` (
  `idExam` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `idFaculty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `_exam`
--

INSERT INTO `_exam` (`idExam`, `name`, `idFaculty`) VALUES
(1, 'Ingegneria del software', 1),
(2, 'Algebra I', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `_faculty`
--

CREATE TABLE `_faculty` (
  `idFaculty` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `idUniversity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `_faculty`
--

INSERT INTO `_faculty` (`idFaculty`, `name`, `idUniversity`) VALUES
(1, 'Informatica', 1),
(2, 'Matematica', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `_features`
--

CREATE TABLE `_features` (
  `idFeature` int(11) NOT NULL,
  `label` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `_features`
--

INSERT INTO `_features` (`idFeature`, `label`) VALUES
(1, 'Simpatico'),
(2, 'Cordiale'),
(3, 'Socievole'),
(4, 'Diligente'),
(5, 'Timido'),
(6, 'Estroverso'),
(7, 'Informatica'),
(8, 'Matematica');

-- --------------------------------------------------------

--
-- Struttura della tabella `_feedback`
--

CREATE TABLE `_feedback` (
  `idFeedback` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `groups` int(11) DEFAULT NULL,
  `comments` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `_group`
--

CREATE TABLE `_group` (
  `idGroup` int(11) NOT NULL,
  `name` varchar(16) DEFAULT NULL,
  `creationDate` date DEFAULT NULL,
  `expiartionDate` date DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `account` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `_ideallist`
--

CREATE TABLE `_ideallist` (
  `codeIdealList` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idIdealUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `_university`
--

CREATE TABLE `_university` (
  `idUniversity` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `_university`
--

INSERT INTO `_university` (`idUniversity`, `name`, `description`) VALUES
(1, 'Unisa', 'Università degli studi di Salerno'),
(2, 'Unina', 'Università Federico II');

-- --------------------------------------------------------

--
-- Struttura della tabella `_user`
--

CREATE TABLE `_user` (
  `idUser` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `surname` varchar(16) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `birthOfDay` date DEFAULT NULL,
  `pathImage` varchar(60) DEFAULT NULL,
  `telephone` varchar(10) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `score` double DEFAULT '0',
  `active` tinyint(1) DEFAULT NULL,
  `numberOfFeedback` int(11) DEFAULT '0',
  `numberOfDesertedGroup` int(11) DEFAULT '0',
  `typeStudent` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `_user`
--

INSERT INTO `_user` (`idUser`, `name`, `surname`, `email`, `birthOfDay`, `pathImage`, `telephone`, `description`, `address`, `score`, `active`, `numberOfFeedback`, `numberOfDesertedGroup`, `typeStudent`) VALUES
(13, 'Antonio', 'Fasulo', 'tester1@unisharing.it', '2016-12-23', 'img/avatar/tester1@unisharing.it/', '3245365', 'Mi piace studiare Ingegneria del software', 'via Umberto I - Salerno', 0, 1, 0, 0, 'corsista-pendolare'),
(14, 'Anna ', 'Tomeo', 'tester2@unisharing.it', '2016-12-13', 'img/avatar/tester2@unisharing.it/', '3498589374', 'Mi piace studiare analisi matematica', 'via provinciale, 5 Cannalonga Salerno', 0, 1, 0, 0, 'corsista-pendolare');

-- --------------------------------------------------------

--
-- Struttura della tabella `_userasfeatures`
--

CREATE TABLE `_userasfeatures` (
  `idFeature` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `_userasfeatures`
--

INSERT INTO `_userasfeatures` (`idFeature`, `idUser`) VALUES
(1, 13),
(2, 13),
(4, 14),
(6, 14);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `_account`
--
ALTER TABLE `_account`
  ADD PRIMARY KEY (`username`);

--
-- Indici per le tabelle `_accountpartecipateuser`
--
ALTER TABLE `_accountpartecipateuser`
  ADD KEY `userId` (`userId`),
  ADD KEY `groupId` (`groupId`);

--
-- Indici per le tabelle `_blacklist`
--
ALTER TABLE `_blacklist`
  ADD PRIMARY KEY (`codeBlackList`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idBlockedUser` (`idBlockedUser`);

--
-- Indici per le tabelle `_exam`
--
ALTER TABLE `_exam`
  ADD PRIMARY KEY (`idExam`),
  ADD KEY `idFaculty` (`idFaculty`);

--
-- Indici per le tabelle `_faculty`
--
ALTER TABLE `_faculty`
  ADD PRIMARY KEY (`idFaculty`),
  ADD KEY `idUniversity` (`idUniversity`);

--
-- Indici per le tabelle `_features`
--
ALTER TABLE `_features`
  ADD PRIMARY KEY (`idFeature`);

--
-- Indici per le tabelle `_feedback`
--
ALTER TABLE `_feedback`
  ADD PRIMARY KEY (`idFeedback`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `author` (`author`),
  ADD KEY `groups` (`groups`);

--
-- Indici per le tabelle `_group`
--
ALTER TABLE `_group`
  ADD PRIMARY KEY (`idGroup`),
  ADD KEY `account` (`account`);

--
-- Indici per le tabelle `_ideallist`
--
ALTER TABLE `_ideallist`
  ADD PRIMARY KEY (`codeIdealList`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idIdealUser` (`idIdealUser`);

--
-- Indici per le tabelle `_university`
--
ALTER TABLE `_university`
  ADD PRIMARY KEY (`idUniversity`);

--
-- Indici per le tabelle `_user`
--
ALTER TABLE `_user`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `email` (`email`);

--
-- Indici per le tabelle `_userasfeatures`
--
ALTER TABLE `_userasfeatures`
  ADD KEY `idFeature` (`idFeature`),
  ADD KEY `idUser` (`idUser`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `_blacklist`
--
ALTER TABLE `_blacklist`
  MODIFY `codeBlackList` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `_exam`
--
ALTER TABLE `_exam`
  MODIFY `idExam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT per la tabella `_faculty`
--
ALTER TABLE `_faculty`
  MODIFY `idFaculty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT per la tabella `_features`
--
ALTER TABLE `_features`
  MODIFY `idFeature` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT per la tabella `_feedback`
--
ALTER TABLE `_feedback`
  MODIFY `idFeedback` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `_group`
--
ALTER TABLE `_group`
  MODIFY `idGroup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT per la tabella `_ideallist`
--
ALTER TABLE `_ideallist`
  MODIFY `codeIdealList` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `_university`
--
ALTER TABLE `_university`
  MODIFY `idUniversity` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT per la tabella `_user`
--
ALTER TABLE `_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `_accountpartecipateuser`
--
ALTER TABLE `_accountpartecipateuser`
  ADD CONSTRAINT `_accountpartecipateuser_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_accountpartecipateuser_ibfk_2` FOREIGN KEY (`groupId`) REFERENCES `_group` (`idGroup`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `_blacklist`
--
ALTER TABLE `_blacklist`
  ADD CONSTRAINT `_blacklist_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_blacklist_ibfk_2` FOREIGN KEY (`idBlockedUser`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `_exam`
--
ALTER TABLE `_exam`
  ADD CONSTRAINT `_exam_ibfk_1` FOREIGN KEY (`idFaculty`) REFERENCES `_faculty` (`idFaculty`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `_faculty`
--
ALTER TABLE `_faculty`
  ADD CONSTRAINT `_faculty_ibfk_1` FOREIGN KEY (`idUniversity`) REFERENCES `_university` (`idUniversity`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `_feedback`
--
ALTER TABLE `_feedback`
  ADD CONSTRAINT `_feedback_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_feedback_ibfk_2` FOREIGN KEY (`author`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_feedback_ibfk_3` FOREIGN KEY (`groups`) REFERENCES `_group` (`idGroup`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `_group`
--
ALTER TABLE `_group`
  ADD CONSTRAINT `_group_ibfk_1` FOREIGN KEY (`account`) REFERENCES `_account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `_ideallist`
--
ALTER TABLE `_ideallist`
  ADD CONSTRAINT `_ideallist_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_ideallist_ibfk_2` FOREIGN KEY (`idIdealUser`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `_user`
--
ALTER TABLE `_user`
  ADD CONSTRAINT `_user_ibfk_1` FOREIGN KEY (`email`) REFERENCES `_account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `_userasfeatures`
--
ALTER TABLE `_userasfeatures`
  ADD CONSTRAINT `_userasfeatures_ibfk_1` FOREIGN KEY (`idFeature`) REFERENCES `_features` (`idFeature`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_userasfeatures_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
