-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
<<<<<<< HEAD
-- Host: localhost:8889
-- Creato il: Dic 15, 2016 alle 17:45
-- Versione del server: 5.6.28
-- Versione PHP: 5.6.25
=======
-- Host: localhost:3306
-- Generation Time: Dec 15, 2016 at 03:06 PM
-- Server version: 5.5.49-log
-- PHP Version: 5.6.24
>>>>>>> origin/master

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
-- Table structure for table `_account`
--

CREATE TABLE IF NOT EXISTS `_account` (
  `username` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_account`
--

INSERT INTO `_account` (`username`, `password`) VALUES
('345345@45345345.it', '4461d28de0cfade61711ed6401c18cef'),
('l.vitale@live.it', '4f5ad3e03dabda820f3c2b6ca5c2283e'),
('tester1@unisharing.it', 'enter1'),
('tester2@unisharing.it', 'enter2'),
('tester3@unisharing.it', 'tester3');

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Struttura della tabella `_accountpartecipategroup`
--

CREATE TABLE `_accountpartecipategroup` (
  `userId` int(11) DEFAULT NULL,
  `groupId` int(11) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `_blacklist`
--

CREATE TABLE `_blacklist` (
=======
-- Table structure for table `_blacklist`
--

CREATE TABLE IF NOT EXISTS `_blacklist` (
>>>>>>> origin/master
  `codeBlackList` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idBlockedUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `_exam`
--

CREATE TABLE IF NOT EXISTS `_exam` (
  `idExam` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `idFaculty` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_exam`
--

INSERT INTO `_exam` (`idExam`, `name`, `idFaculty`) VALUES
(1, 'Ingegneria del software', 1),
(2, 'Algebra I', 2);

-- --------------------------------------------------------

--
-- Table structure for table `_faculty`
--

CREATE TABLE IF NOT EXISTS `_faculty` (
  `idFaculty` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `idUniversity` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_faculty`
--

INSERT INTO `_faculty` (`idFaculty`, `name`, `idUniversity`) VALUES
(1, 'Informatica', 1),
(2, 'Matematica', 1);

-- --------------------------------------------------------

--
-- Table structure for table `_features`
--

CREATE TABLE IF NOT EXISTS `_features` (
  `idFeature` int(11) NOT NULL,
  `label` varchar(16) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_features`
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
-- Table structure for table `_feedback`
--

CREATE TABLE IF NOT EXISTS `_feedback` (
  `idFeedback` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `groups` int(11) DEFAULT NULL,
  `comments` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `_group`
--

CREATE TABLE IF NOT EXISTS `_group` (
  `idGroup` int(11) NOT NULL,
  `name` varchar(16) DEFAULT NULL,
  `creationDate` date DEFAULT NULL,
  `expiartionDate` date DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `account` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `_ideallist`
--

CREATE TABLE IF NOT EXISTS `_ideallist` (
  `codeIdealList` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idIdealUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `_university`
--

CREATE TABLE IF NOT EXISTS `_university` (
  `idUniversity` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_university`
--

INSERT INTO `_university` (`idUniversity`, `name`, `description`) VALUES
(1, 'Unisa', 'Università degli studi di Salerno'),
(2, 'Unina', 'Università Federico II');

-- --------------------------------------------------------

--
-- Table structure for table `_user`
--

CREATE TABLE IF NOT EXISTS `_user` (
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
  `typeStudent` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_user`
--

INSERT INTO `_user` (`idUser`, `name`, `surname`, `email`, `birthOfDay`, `pathImage`, `telephone`, `description`, `address`, `score`, `active`, `numberOfFeedback`, `numberOfDesertedGroup`, `typeStudent`) VALUES
(13, 'Antonio', 'Fasulo', 'tester1@unisharing.it', '2016-12-23', 'img/avatar/tester1@unisharing.it/icon.png', '3245365', 'Mi piace studiare Ingegneria del software', 'via Umberto I - Salerno', 25, 1, 1, 0, 'corsista-pendolare'),
(14, 'Anna ', 'Tomeo', 'tester2@unisharing.it', '2016-12-13', 'img/avatar/tester2@unisharing.it/icon.png', '3498589374', 'Mi piace studiare analisi matematica', 'via provinciale, 5 Cannalonga Salerno', 50, 1, 1, 0, 'corsista-pendolare'),
(15, 'Vito', 'Del Vecchio', 'tester3@unisharing.it', '2016-12-13', 'img/avatar/tester2@unisharing.it/icon.png', '2354435', '345345', 'via repubblica 2, Roma', 75, 1, 1, 0, NULL),
(35, 'Lorenzo', 'Vitale', 'l.vitale@live.it', '2016-12-16', 'img/avatar/l.vitale@live.it/', '', 'Mi piace IS', 'via Repubblica, 2 ', 0, 1, 0, 0, NULL),
(36, '345345', '345345', '345345@45345345.it', '0000-00-00', 'img/avatar/345345@45345345.it/', '345345345', '', '345345', 0, 1, 0, 0, NULL),
(37, '345345', '345345', '345345@45345345.it', '0000-00-00', 'img/avatar/345345@45345345.it/', '345345345', '', '345345', 0, 1, 0, 0, NULL),
(38, '345345', '345345', '345345@45345345.it', '0000-00-00', 'img/avatar/345345@45345345.it/', '345345345', '', '345345', 0, 1, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `_userhasfeatures`
--

CREATE TABLE IF NOT EXISTS `_userhasfeatures` (
  `idFeature` int(11) NOT NULL DEFAULT '0',
  `idUser` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_userhasfeatures`
--

INSERT INTO `_userhasfeatures` (`idFeature`, `idUser`) VALUES
(1, 13),
(1, 14),
(1, 15),
(2, 13),
(6, 14);

-- --------------------------------------------------------

--
-- Table structure for table `_userpartecipategroup`
--

CREATE TABLE IF NOT EXISTS `_userpartecipategroup` (
  `userId` int(11) DEFAULT NULL,
  `groupId` int(11) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
<<<<<<< HEAD
-- Indici per le tabelle `_accountpartecipategroup`
--
ALTER TABLE `_accountpartecipategroup`
  ADD KEY `userId` (`userId`),
  ADD KEY `groupId` (`groupId`);
=======
-- Indexes for table `_account`
--
ALTER TABLE `_account`
  ADD PRIMARY KEY (`username`);
>>>>>>> origin/master

--
-- Indexes for table `_blacklist`
--
ALTER TABLE `_blacklist`
  ADD PRIMARY KEY (`codeBlackList`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idBlockedUser` (`idBlockedUser`);

--
-- Indexes for table `_exam`
--
ALTER TABLE `_exam`
  ADD PRIMARY KEY (`idExam`),
  ADD KEY `idFaculty` (`idFaculty`);

--
-- Indexes for table `_faculty`
--
ALTER TABLE `_faculty`
  ADD PRIMARY KEY (`idFaculty`),
  ADD KEY `idUniversity` (`idUniversity`);

--
-- Indexes for table `_features`
--
ALTER TABLE `_features`
  ADD PRIMARY KEY (`idFeature`);

--
-- Indexes for table `_feedback`
--
ALTER TABLE `_feedback`
  ADD PRIMARY KEY (`idFeedback`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `author` (`author`),
  ADD KEY `groups` (`groups`);

--
-- Indexes for table `_group`
--
ALTER TABLE `_group`
  ADD PRIMARY KEY (`idGroup`),
  ADD KEY `account` (`account`);

--
-- Indexes for table `_ideallist`
--
ALTER TABLE `_ideallist`
  ADD PRIMARY KEY (`codeIdealList`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idIdealUser` (`idIdealUser`);

--
-- Indexes for table `_university`
--
ALTER TABLE `_university`
  ADD PRIMARY KEY (`idUniversity`);

--
-- Indexes for table `_user`
--
ALTER TABLE `_user`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `_userhasfeatures`
--
ALTER TABLE `_userhasfeatures`
  ADD PRIMARY KEY (`idFeature`,`idUser`),
  ADD KEY `idFeature` (`idFeature`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `_userpartecipategroup`
--
ALTER TABLE `_userpartecipategroup`
  ADD KEY `userId` (`userId`),
  ADD KEY `groupId` (`groupId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `_blacklist`
--
ALTER TABLE `_blacklist`
  MODIFY `codeBlackList` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `_exam`
--
ALTER TABLE `_exam`
  MODIFY `idExam` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `_faculty`
--
ALTER TABLE `_faculty`
  MODIFY `idFaculty` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `_features`
--
ALTER TABLE `_features`
  MODIFY `idFeature` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `_feedback`
--
ALTER TABLE `_feedback`
  MODIFY `idFeedback` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `_group`
--
ALTER TABLE `_group`
  MODIFY `idGroup` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `_ideallist`
--
ALTER TABLE `_ideallist`
  MODIFY `codeIdealList` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `_university`
--
ALTER TABLE `_university`
  MODIFY `idUniversity` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `_user`
--
ALTER TABLE `_user`
<<<<<<< HEAD
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
=======
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
>>>>>>> origin/master
--
-- Constraints for dumped tables
--

--
<<<<<<< HEAD
-- Limiti per la tabella `_accountpartecipategroup`
--
ALTER TABLE `_accountpartecipategroup`
  ADD CONSTRAINT `_accountpartecipategroup_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_accountpartecipategroup_ibfk_2` FOREIGN KEY (`groupId`) REFERENCES `_group` (`idGroup`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `_blacklist`
=======
-- Constraints for table `_blacklist`
>>>>>>> origin/master
--
ALTER TABLE `_blacklist`
  ADD CONSTRAINT `_blacklist_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_blacklist_ibfk_2` FOREIGN KEY (`idBlockedUser`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `_exam`
--
ALTER TABLE `_exam`
  ADD CONSTRAINT `_exam_ibfk_1` FOREIGN KEY (`idFaculty`) REFERENCES `_faculty` (`idFaculty`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `_faculty`
--
ALTER TABLE `_faculty`
  ADD CONSTRAINT `_faculty_ibfk_1` FOREIGN KEY (`idUniversity`) REFERENCES `_university` (`idUniversity`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `_feedback`
--
ALTER TABLE `_feedback`
  ADD CONSTRAINT `_feedback_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_feedback_ibfk_2` FOREIGN KEY (`author`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_feedback_ibfk_3` FOREIGN KEY (`groups`) REFERENCES `_group` (`idGroup`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `_group`
--
ALTER TABLE `_group`
  ADD CONSTRAINT `_group_ibfk_1` FOREIGN KEY (`account`) REFERENCES `_account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `_ideallist`
--
ALTER TABLE `_ideallist`
  ADD CONSTRAINT `_ideallist_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_ideallist_ibfk_2` FOREIGN KEY (`idIdealUser`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `_user`
--
ALTER TABLE `_user`
  ADD CONSTRAINT `_user_ibfk_1` FOREIGN KEY (`email`) REFERENCES `_account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `_userhasfeatures`
--
ALTER TABLE `_userhasfeatures`
  ADD CONSTRAINT `_userhasfeatures_ibfk_1` FOREIGN KEY (`idFeature`) REFERENCES `_features` (`idFeature`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_userhasfeatures_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `_userpartecipategroup`
--
ALTER TABLE `_userpartecipategroup`
  ADD CONSTRAINT `_userpartecipategroup_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_userpartecipategroup_ibfk_2` FOREIGN KEY (`groupId`) REFERENCES `_group` (`idGroup`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
