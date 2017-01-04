-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Creato il: Dic 28, 2016 alle 17:33
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
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `_account`
--

INSERT INTO `_account` (`username`, `password`) VALUES
('info@lorenzovitale.it', '4461d28de0cfade61711ed6401c18cef'),
('lorenzo.dev@gmail.com', '4461d28de0cfade61711ed6401c18cef'),
('lorenzo.vitale@cheapnet.it', 'f057b8b0a65a52e9a12fb01bbcf61cb8'),
('tester2@unisharing.it', 'enter2'),
('tester3@unisharing.it', 'tester3');

-- --------------------------------------------------------

--
-- Struttura della tabella `_accountpartecipategroup`
--

CREATE TABLE `_accountpartecipategroup` (
  `id` int(11) NOT NULL,
  `account` varchar(50) DEFAULT NULL,
  `groupId` int(11) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `dateAccepted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `_accountpartecipategroup`
--

INSERT INTO `_accountpartecipategroup` (`id`, `account`, `groupId`, `admin`, `accepted`, `dateAccepted`) VALUES
(15, 'lorenzo.dev@gmail.com', 1, 0, 1, '2016-12-26'),
(16, 'tester2@unisharing.it', 1, 0, 1, '0000-00-00'),
(62, 'lorenzo.dev@gmail.com', 63, 0, 0, '0000-00-00'),
(63, 'info@lorenzovitale.it', 63, 1, 0, '0000-00-00'),
(64, 'lorenzo.dev@gmail.com', 64, 0, 0, '0000-00-00'),
(65, 'info@lorenzovitale.it', 64, 1, 0, '0000-00-00'),
(74, 'lorenzo.dev@gmail.com', 69, 0, -1, '2016-12-27'),
(75, 'info@lorenzovitale.it', 69, 1, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Struttura della tabella `_blacklist`
--

CREATE TABLE `_blacklist` (
  `codeBlackList` int(11) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `blockedUser` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `_blacklist`
--

INSERT INTO `_blacklist` (`codeBlackList`, `user`, `blockedUser`) VALUES
(14, 'lorenzo.dev@gmail.com', 'info@lorenzovitale.it'),
(15, 'lorenzo.dev@gmail.com', 'info@lorenzovitale.it'),
(16, 'lorenzo.dev@gmail.com', 'info@lorenzovitale.it'),
(17, 'lorenzo.dev@gmail.com', 'info@lorenzovitale.it'),
(18, 'lorenzo.dev@gmail.com', 'info@lorenzovitale.it'),
(19, 'lorenzo.dev@gmail.com', 'info@lorenzovitale.it');

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
(2, 'Algebra I', 2),
(6, 'Pippo pluto', 1),
(7, 'efwetrwertew', 1),
(8, 'werwer', 1),
(9, 'wertertert', 1);

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
(2, 'Matematica', 1),
(3, 'Lettere moderne', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `_features`
--

CREATE TABLE `_features` (
  `idFeature` int(11) NOT NULL,
  `label` varchar(50) NOT NULL
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
(8, 'Matematica'),
(9, 'Fisica'),
(10, 'Scienze'),
(11, 'Biologia'),
(12, 'Chimica'),
(13, 'Architettura'),
(14, 'Diritto ed Economia'),
(15, 'Geografia'),
(16, 'Storia e Filosofia'),
(17, 'Lettere'),
(18, 'Latino e greco'),
(19, 'Inglese'),
(20, 'Francesce'),
(21, 'Spagnolo');

-- --------------------------------------------------------

--
-- Struttura della tabella `_feedback`
--

CREATE TABLE `_feedback` (
  `idFeedback` int(11) NOT NULL,
  `account` varchar(50) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `groups` int(11) DEFAULT NULL,
  `simpatia` int(1) NOT NULL DEFAULT '1',
  `puntualita` int(1) NOT NULL DEFAULT '1',
  `correttezza` int(1) NOT NULL DEFAULT '1',
  `capacita` int(1) NOT NULL DEFAULT '1',
  `comment` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `_feedback`
--

INSERT INTO `_feedback` (`idFeedback`, `account`, `author`, `groups`, `simpatia`, `puntualita`, `correttezza`, `capacita`, `comment`) VALUES
(42, 'lorenzo.dev@gmail.com', 'info@lorenzovitale.it', 1, 3, 3, 3, 3, '2344');

-- --------------------------------------------------------

--
-- Struttura della tabella `_group`
--

CREATE TABLE `_group` (
  `idGroup` int(11) NOT NULL,
  `name` varchar(16) DEFAULT NULL,
  `creationDate` date DEFAULT NULL,
  `expirationDate` date DEFAULT NULL,
  `expirationInvite` date DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `account` varchar(50) DEFAULT NULL,
  `exam` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `_group`
--

INSERT INTO `_group` (`idGroup`, `name`, `creationDate`, `expirationDate`, `expirationInvite`, `description`, `account`, `exam`) VALUES
(1, 'I Magnifici 4', '2016-12-13', '2016-12-31', '2016-12-31', 'Studiare Ingegneria del software', 'lorenzo.dev@gmail.com', 1),
(63, 'asfsdg', '2016-12-27', '2016-12-30', '2016-12-27', 'qerwer', 'info@lorenzovitale.it', 7),
(64, 'asfsdg', '2016-12-27', '2016-12-30', '2016-12-29', 'qerwer', 'info@lorenzovitale.it', 7),
(65, 'afsdfsd', '2016-12-27', '2016-12-31', '2016-12-30', '3r34535345', 'info@lorenzovitale.it', 1),
(66, 'afsdfsd', '2016-12-27', '2016-12-31', '2016-12-30', '3r34535345', 'info@lorenzovitale.it', 1),
(67, 'qewrwer4w', '2016-12-27', '2016-12-31', '2016-12-30', '345345', 'info@lorenzovitale.it', 1),
(68, 'rgertert', '2016-12-27', '2016-12-31', '2016-12-29', '34534534', 'info@lorenzovitale.it', 8),
(69, '543435', '2016-12-27', '2016-12-31', '2016-12-29', '3423234', 'info@lorenzovitale.it', 9);

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
(1, 'Università degli studi di Salerno', 'Università degli studi di Salerno'),
(2, 'Federico II di Napoli', 'Università Federico II');

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
  `active` tinyint(1) DEFAULT '1',
  `numberOfFeedback` int(11) DEFAULT '0',
  `numberOfDesertedGroup` int(11) DEFAULT '0',
  `typeStudent` varchar(20) DEFAULT NULL,
  `faculty` int(11) NOT NULL,
  `longitude` varchar(70) DEFAULT NULL,
  `latitude` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `_user`
--

INSERT INTO `_user` (`idUser`, `name`, `surname`, `email`, `birthOfDay`, `pathImage`, `telephone`, `description`, `address`, `score`, `active`, `numberOfFeedback`, `numberOfDesertedGroup`, `typeStudent`, `faculty`) VALUES
(13, 'Antonio', 'Fasulo', 'lorenzo.dev@gmail.com', '2016-12-23', 'img/avatar/tester1@unisharing.it/', '3245365', 'Mi piace studiare Ingegneria del software', 'via Umberto I - Salerno', 34, 1, 3, 0, 'corsista-pendolare', 1),
(14, 'Anna ', 'Tomeo', 'tester2@unisharing.it', '2016-12-13', 'img/avatar/tester2@unisharing.it/', '3498589374', 'Mi piace studiare analisi matematica', 'via provinciale, 5 Cannalonga Salerno', 0, 1, 0, 0, 'corsista-pendolare', 1),
(15, 'Vito', 'Del Vecchio', 'tester3@unisharing.it', '2016-12-13', 'img/avatar/tester2@unisharing.it/', '2354435', '345345', 'via repubblica 2, Roma', 0, 1, 0, 0, NULL, 1),
(58, 'Lorenzo', 'Vitale', 'info@lorenzovitale.it', '0000-00-00', 'img/avatar/tester4@unisharing.it/', '3323457983', '', 'via della repubblica', 27, 1, 2, 0, NULL, 1),
(59, 'Giuseppe', 'Iacobelli', 'lorenzo.vitale@cheapnet.it', '1995-02-25', 'img/avatar/lorenzo.vitale@cheapnet.it/', '6456456656', 'Pappa e ciccia', 'corsista-pendolare', 0, 1, 0, 0, 'via dei Pini, Roma', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `_userhasfeatures`
--

CREATE TABLE `_userhasfeatures` (
  `idFeature` int(11) NOT NULL DEFAULT '0',
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `_userhasfeatures`
--

INSERT INTO `_userhasfeatures` (`idFeature`, `idUser`) VALUES
(1, 13),
(1, 14),
(1, 15),
(2, 13),
(3, 13),
(7, 59),
(8, 59),
(11, 59),
(13, 59),
(17, 59);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `_account`
--
ALTER TABLE `_account`
  ADD PRIMARY KEY (`username`);

--
-- Indici per le tabelle `_accountpartecipategroup`
--
ALTER TABLE `_accountpartecipategroup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`account`),
  ADD KEY `groupId` (`groupId`);

--
-- Indici per le tabelle `_blacklist`
--
ALTER TABLE `_blacklist`
  ADD PRIMARY KEY (`codeBlackList`),
  ADD KEY `idUser` (`user`),
  ADD KEY `idBlockedUser` (`blockedUser`);

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
  ADD KEY `idUser` (`account`),
  ADD KEY `author` (`author`),
  ADD KEY `groups` (`groups`);

--
-- Indici per le tabelle `_group`
--
ALTER TABLE `_group`
  ADD PRIMARY KEY (`idGroup`),
  ADD KEY `account` (`account`),
  ADD KEY `exam` (`exam`);

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
  ADD KEY `email` (`email`),
  ADD KEY `faculty` (`faculty`);

--
-- Indici per le tabelle `_userhasfeatures`
--
ALTER TABLE `_userhasfeatures`
  ADD PRIMARY KEY (`idFeature`,`idUser`),
  ADD KEY `idFeature` (`idFeature`),
  ADD KEY `idUser` (`idUser`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `_accountpartecipategroup`
--
ALTER TABLE `_accountpartecipategroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT per la tabella `_blacklist`
--
ALTER TABLE `_blacklist`
  MODIFY `codeBlackList` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT per la tabella `_exam`
--
ALTER TABLE `_exam`
  MODIFY `idExam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT per la tabella `_faculty`
--
ALTER TABLE `_faculty`
  MODIFY `idFaculty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT per la tabella `_features`
--
ALTER TABLE `_features`
  MODIFY `idFeature` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT per la tabella `_feedback`
--
ALTER TABLE `_feedback`
  MODIFY `idFeedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT per la tabella `_group`
--
ALTER TABLE `_group`
  MODIFY `idGroup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
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
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `_accountpartecipategroup`
--
ALTER TABLE `_accountpartecipategroup`
  ADD CONSTRAINT `_accountpartecipategroup_ibfk_2` FOREIGN KEY (`groupId`) REFERENCES `_group` (`idGroup`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_accountpartecipategroup_ibfk_3` FOREIGN KEY (`account`) REFERENCES `_account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `_blacklist`
--
ALTER TABLE `_blacklist`
  ADD CONSTRAINT `_blacklist_ibfk_1` FOREIGN KEY (`blockedUser`) REFERENCES `_account` (`username`) ON DELETE CASCADE ON UPDATE SET NULL,
  ADD CONSTRAINT `_blacklist_ibfk_2` FOREIGN KEY (`user`) REFERENCES `_account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `_feedback_ibfk_3` FOREIGN KEY (`groups`) REFERENCES `_group` (`idGroup`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_feedback_ibfk_4` FOREIGN KEY (`account`) REFERENCES `_account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_feedback_ibfk_5` FOREIGN KEY (`author`) REFERENCES `_account` (`username`);

--
-- Limiti per la tabella `_group`
--
ALTER TABLE `_group`
  ADD CONSTRAINT `_group_ibfk_1` FOREIGN KEY (`account`) REFERENCES `_account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_group_ibfk_2` FOREIGN KEY (`exam`) REFERENCES `_exam` (`idExam`) ON DELETE SET NULL ON UPDATE CASCADE;

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
  ADD CONSTRAINT `_user_ibfk_1` FOREIGN KEY (`email`) REFERENCES `_account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_user_ibfk_2` FOREIGN KEY (`faculty`) REFERENCES `_faculty` (`idFaculty`);

--
-- Limiti per la tabella `_userhasfeatures`
--
ALTER TABLE `_userhasfeatures`
  ADD CONSTRAINT `_userhasfeatures_ibfk_1` FOREIGN KEY (`idFeature`) REFERENCES `_features` (`idFeature`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_userhasfeatures_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
