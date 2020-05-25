-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Temps de generació: 25-05-2020 a les 17:34:11
-- Versió del servidor: 5.7.28
-- Versió de PHP: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `racoestudi`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `alumne`
--

DROP TABLE IF EXISTS `alumne`;
CREATE TABLE IF NOT EXISTS `alumne` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` char(30) COLLATE latin1_spanish_ci NOT NULL,
  `NomUsuari` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Contrasenya` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Correu` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `img` varchar(300) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Punts` int(11) DEFAULT NULL,
  `exercicis` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Bolcament de dades per a la taula `alumne`
--

INSERT INTO `alumne` (`ID`, `Nom`, `NomUsuari`, `Contrasenya`, `Correu`, `img`, `Punts`, `exercicis`) VALUES
(1, 'Jordi', 'geregil', '123456789', 'geregil@hotmail.com', 'photo-1507525428034-b723cf961d3e.jpg', 47, 5),
(2, 'Joel', 'joeltop', '12345678', 'joeltop@gmail.com', 'perfil.png', 32, 3),
(3, 'Ramon', 'infositja', '12345678', 'comercial@infositja.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de la taula `alumne_curs`
--

DROP TABLE IF EXISTS `alumne_curs`;
CREATE TABLE IF NOT EXISTS `alumne_curs` (
  `IDalumne` int(11) NOT NULL,
  `IDcurs` int(11) NOT NULL,
  `completat` tinyint(1) NOT NULL,
  `Data_completat` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`IDalumne`,`IDcurs`),
  KEY `FK_Curs` (`IDcurs`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Bolcament de dades per a la taula `alumne_curs`
--

INSERT INTO `alumne_curs` (`IDalumne`, `IDcurs`, `completat`, `Data_completat`) VALUES
(1, 10, 0, '0'),
(1, 13, 0, '0'),
(1, 14, 0, '0'),
(1, 15, 0, '0'),
(1, 18, 0, '0'),
(1, 22, 0, '0'),
(1, 24, 0, '0'),
(1, 25, 0, '0'),
(1, 26, 0, '0'),
(2, 13, 0, '0'),
(3, 13, 0, '0'),
(24, 13, 0, '0');

-- --------------------------------------------------------

--
-- Estructura de la taula `alumne_exercici`
--

DROP TABLE IF EXISTS `alumne_exercici`;
CREATE TABLE IF NOT EXISTS `alumne_exercici` (
  `IDalumne` int(11) NOT NULL,
  `IDexercici` int(11) NOT NULL,
  `Data` varchar(300) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Punts_Obtinguts` float(11,0) NOT NULL,
  `Nota` int(11) DEFAULT NULL,
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `revisat` tinyint(1) NOT NULL,
  `resposta` text COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_Exercici` (`IDexercici`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Bolcament de dades per a la taula `alumne_exercici`
--

INSERT INTO `alumne_exercici` (`IDalumne`, `IDexercici`, `Data`, `Punts_Obtinguts`, `Nota`, `ID`, `revisat`, `resposta`) VALUES
(1, 18, '22/04/2020 01:04:45', 10, 10, 66, 1, '1'),
(1, 17, '22/04/2020 01:04:59', 0, 0, 68, 1, '231321'),
(1, 17, '22/04/2020 01:04:02', 9, 9, 69, 1, '1'),
(1, 16, '22/04/2020 01:04:07', 0, 0, 70, 1, '1'),
(1, 16, '22/04/2020 01:04:10', 9, 9, 71, 1, ''),
(1, 19, '22/04/2020 03:04:03', 12, 10, 89, 1, '1'),
(2, 19, '22/04/2020 04:04:28', 12, 10, 90, 1, '1'),
(2, 18, '22/04/2020 04:04:32', 10, 10, 91, 1, '1'),
(2, 17, '22/04/2020 04:04:35', 10, 10, 92, 1, '1'),
(2, 16, '22/04/2020 04:04:38', 0, 0, 93, 1, '1'),
(2, 20, '22/04/2020 04:04:41', 8, 7, 94, 1, '1'),
(1, 23, '04/05/2020 11:05:46 AM', 7, 6, 95, 1, '123'),
(1, 22, '19/05/2020 12:05:56 PM', 0, 0, 96, 0, 'nÃºmero 6'),
(1, 21, '19/05/2020 12:05:05 PM', 0, 0, 97, 0, 'nÃºmero 4');

-- --------------------------------------------------------

--
-- Estructura de la taula `alumne_trofeu`
--

DROP TABLE IF EXISTS `alumne_trofeu`;
CREATE TABLE IF NOT EXISTS `alumne_trofeu` (
  `IDalumne` int(11) NOT NULL,
  `IDtrofeu` int(11) NOT NULL,
  `Data` varchar(500) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`IDalumne`,`IDtrofeu`),
  KEY `FK_Trofeu` (`IDtrofeu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Bolcament de dades per a la taula `alumne_trofeu`
--

INSERT INTO `alumne_trofeu` (`IDalumne`, `IDtrofeu`, `Data`) VALUES
(1, 1, '20-04-2020 09:28:40'),
(1, 6, '20-04-2020 09:28:40'),
(1, 7, '20-04-2020 13:18:50'),
(2, 1, '22-04-2020 09:22:42'),
(2, 6, '22-04-2020 09:22:42');

-- --------------------------------------------------------

--
-- Estructura de la taula `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Bolcament de dades per a la taula `categoria`
--

INSERT INTO `categoria` (`id`, `nom`) VALUES
(1, 'Matemàtiques'),
(2, 'Llengua'),
(3, 'Informàtica'),
(4, 'Naturals'),
(5, 'Socials'),
(6, 'Educació Física'),
(7, 'Altres');

-- --------------------------------------------------------

--
-- Estructura de la taula `curs`
--

DROP TABLE IF EXISTS `curs`;
CREATE TABLE IF NOT EXISTS `curs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Descripcio` text COLLATE latin1_spanish_ci NOT NULL,
  `Data_creat` varchar(500) COLLATE latin1_spanish_ci DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `IDprofessor` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_CursProfessor` (`IDprofessor`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Bolcament de dades per a la taula `curs`
--

INSERT INTO `curs` (`ID`, `Nom`, `Descripcio`, `Data_creat`, `categoria`, `IDprofessor`) VALUES
(1, '1', '', '16-04-2020 16:56:41', 1, 2),
(2, 'a', '', '16-04-2020 16:56:43', 1, 2),
(3, 'b', '', '16-04-2020 16:56:45', 1, 2),
(4, 'c', '', '16-04-2020 16:56:47', 1, 2),
(5, 'd', '', '16-04-2020 16:56:49', 1, 2),
(6, 'e', '', '16-04-2020 16:56:50', 1, 2),
(7, 'f', '', '16-04-2020 16:56:52', 1, 2),
(8, 'g', '', '16-04-2020 16:56:54', 1, 2),
(9, 'h', '', '16-04-2020 16:56:55', 1, 2),
(10, 'j', '', '16-04-2020 16:56:57', 1, 2),
(11, 'qeeqwewqeqweqw', '', '16-04-2020 16:56:59', 1, 2),
(13, 'prova', 'curs creat per fer proves', '20-04-2020 12:55:45', 1, 1),
(14, 'eqwewq', 'qewewq', '20-04-2020 12:57:05', 6, 1),
(15, 'werwqreq', 'qerwerwqqrew', '20-04-2020 12:57:13', 6, 1),
(16, 'Curs 1', 'qwwq', '22-04-2020 17:05:50', 3, 1),
(17, 'Curs 2', 'eqwewqqew', '22-04-2020 17:05:56', 5, 1),
(18, 'Curs 3 ', 'eqewqewq', '22-04-2020 17:06:02', 6, 1),
(19, 'Curs 4', 'eqwewqewqweq', '22-04-2020 17:06:06', 7, 1),
(20, 'Curs 5', 'qweewqewqqwe', '22-04-2020 17:06:11', 6, 1),
(21, 'Curs 6', 'qeweqweqw', '22-04-2020 17:06:15', 1, 1),
(22, 'Curs 7', 'qewewq', '22-04-2020 17:06:18', 1, 1),
(23, 'Curs 8', 'qeweqweqw', '22-04-2020 17:06:21', 1, 1),
(24, 'Curs 9', 'eqeqwqeweqw', '22-04-2020 17:06:25', 1, 1),
(25, 'Curs 10', 'qew', '22-04-2020 17:06:28', 1, 1),
(26, 'Curs 11', '', '22-04-2020 17:06:32', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `exercici`
--

DROP TABLE IF EXISTS `exercici`;
CREATE TABLE IF NOT EXISTS `exercici` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDtasca` int(11) NOT NULL,
  `IDcurs` int(11) NOT NULL,
  `Nom` char(30) COLLATE latin1_spanish_ci NOT NULL,
  `Data` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  `Punts` int(11) NOT NULL,
  `Enunciat` varchar(250) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Resposta` varchar(250) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img` varchar(300) COLLATE latin1_spanish_ci DEFAULT NULL,
  `auto` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_ExerciciTasca` (`IDtasca`),
  KEY `FK_ExerciciCurs` (`IDcurs`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Bolcament de dades per a la taula `exercici`
--

INSERT INTO `exercici` (`ID`, `IDtasca`, `IDcurs`, `Nom`, `Data`, `Punts`, `Enunciat`, `Resposta`, `img`, `auto`) VALUES
(4, 3, 6, 'Cat 1', '16/04/2020', 20, NULL, NULL, NULL, NULL),
(6, 5, 7, 'Hola', '16/04/2020', 2, 'adsaddsaasd', '1', '', 1),
(16, 7, 13, 'Exercici 2', '20/04/2020', 10, NULL, NULL, NULL, 1),
(17, 7, 13, 'Exercici 3', '20/04/2020', 10, NULL, '1', NULL, 1),
(18, 7, 13, 'Exercici 4', '20/04/2020', 10, '123321312312', '1', '', 1),
(19, 7, 13, 'Exercici 5', '22/04/2020', 12, 'qwe', '1', '', 1),
(20, 7, 13, 'Exercici 6', '22/04/2020', 12, NULL, NULL, NULL, NULL),
(21, 7, 13, 'Exercici Exemple', '23/04/2020', 12, 'Quant fan 3+3?', NULL, NULL, 0),
(22, 7, 13, 'Exercici 7', '23/04/2020', 12, 'Arrel quadrada de 3?', NULL, 'mates.jpg', 0),
(23, 7, 13, 'qewewqqew', '23/04/2020', 12, NULL, NULL, NULL, NULL),
(24, 16, 13, 'qweew', '23/04/2020', 123, NULL, NULL, NULL, NULL),
(25, 7, 13, 'Exercici llengua', '30/04/2020 10:04:16 AM', 12, 'Quantes parlants té el català?', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de la taula `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
CREATE TABLE IF NOT EXISTS `pregunta` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `titol` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `missatge` text COLLATE latin1_spanish_ci NOT NULL,
  `Data` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `IDalumne` int(11) NOT NULL,
  `IDprofessor` int(11) NOT NULL,
  `tancada` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDalumne` (`IDalumne`),
  KEY `IDprofessor` (`IDprofessor`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Bolcament de dades per a la taula `pregunta`
--

INSERT INTO `pregunta` (`id`, `titol`, `missatge`, `Data`, `IDalumne`, `IDprofessor`, `tancada`) VALUES
(1, 'prova', 'com funciona?', '', 1, 1, 0),
(5, 'No hi ha foto en un exercici?', 'Hem pensava que tots els exercicis han de tenir foto', '27/04/20 12:04:33 PM', 1, 1, 1),
(6, 'dos', 'adasdadas', '27/04/20 12:04:08 PM', 1, 1, 1),
(7, 'qewewq', 'eqweqw', '27/04/20 02:04:42 PM', 1, 1, 1),
(8, 'weqqwewe', 'eqeqqeeqqe', '27/04/20 02:04:45 PM', 1, 1, 0),
(9, '123213', '12213231', '29/04/20 10:04:03 AM', 1, 1, 0),
(10, '12231', '131231321321', '29/04/20 10:04:07 AM', 1, 1, 0),
(11, 'wqerew', '213321123', '29/04/20 10:04:11 AM', 1, 1, 0),
(12, '324342', '1232114232132', '29/04/20 10:04:15 AM', 1, 1, 0),
(13, '21231', '32144341243121324', '29/04/20 10:04:29 AM', 1, 1, 0),
(14, '4498', 'reqwerreqrqew', '29/04/20 10:04:34 AM', 1, 1, 0),
(15, 'a', 'ahadhsopads', '29/4/2020 10:59 AM', 1, 1, 0),
(16, 'a', 'ahadhsopads', '29/4/2020 10:59 AM', 1, 1, 0),
(17, 'a', 'ahadhsopads', '29/4/2020 10:59 AM', 1, 1, 0),
(18, 'a', 'ahadhsopads', '29/4/2020 10:59 AM', 1, 1, 0),
(19, 'a', 'ahadhsopads', '29/4/2020 10:59 AM', 1, 1, 0),
(20, 'a', 'ahadhsopads', '29/4/2020 10:59 AM', 1, 1, 0),
(21, 'a', 'ahadhsopads', '29/4/2020 10:59 AM', 1, 1, 0),
(22, 'No puc entrar', 'Tinc problemes per entrar al curs de llengua.', '29/4/2020 10:59 AM', 1, 1, 0),
(23, '12321', '321123231', '29/04/20 11:04:20 AM', 1, 1, 0),
(24, '12321321', '312321123', '29/04/20 11:04:23 AM', 1, 1, 0),
(25, '3fswrfew', 'rewrewrewrew', '29/04/20 11:04:26 AM', 1, 1, 0),
(26, 'rewrew', 'rewwerrweerwwerrewrewrwe', '29/04/20 11:04:30 AM', 1, 1, 0),
(27, 'qqqqq', 'qqqqqqq', '29/04/20 11:04:59 AM', 1, 1, 0),
(28, 'qwewee', 'wwwwww', '29/04/20 11:04:05 AM', 1, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de la taula `professor`
--

DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NomUsuari` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Nom` char(30) COLLATE latin1_spanish_ci NOT NULL,
  `Contrasenya` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Correu` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `Centre_educatiu` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Bolcament de dades per a la taula `professor`
--

INSERT INTO `professor` (`ID`, `NomUsuari`, `Nom`, `Contrasenya`, `Correu`, `Centre_educatiu`, `img`) VALUES
(1, 'infositja', '43243234', '123456789', 'geregil@hotmail.com', '4141324213', 'registre.jpg'),
(2, 'joeltop', 'Joel', '12345678', 'geregil.cat@gmail.com', 'Marta Mata', '');

-- --------------------------------------------------------

--
-- Estructura de la taula `recuperacio_alumne`
--

DROP TABLE IF EXISTS `recuperacio_alumne`;
CREATE TABLE IF NOT EXISTS `recuperacio_alumne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IDalumne` int(11) NOT NULL,
  `Data` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `Codi` int(11) NOT NULL,
  `utilitzat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDalumne` (`IDalumne`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Bolcament de dades per a la taula `recuperacio_alumne`
--

INSERT INTO `recuperacio_alumne` (`id`, `IDalumne`, `Data`, `Codi`, `utilitzat`) VALUES
(1, 1, '24/04/20 05:04:24 PM', 28819, 0),
(3, 1, '24/04/20 06:04:54 PM', 21109, 1),
(4, 1, '24/04/20 06:04:32 PM', 17962, 0),
(5, 1, '24/04/20 06:04:57 PM', 21052, 0),
(6, 1, '28/04/20 02:04:35 PM', 21136, 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `recuperacio_professor`
--

DROP TABLE IF EXISTS `recuperacio_professor`;
CREATE TABLE IF NOT EXISTS `recuperacio_professor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IDprofessor` int(11) NOT NULL,
  `Data` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `Codi` int(11) NOT NULL,
  `Utilitzat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDprofessor` (`IDprofessor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Bolcament de dades per a la taula `recuperacio_professor`
--

INSERT INTO `recuperacio_professor` (`id`, `IDprofessor`, `Data`, `Codi`, `Utilitzat`) VALUES
(1, 1, '24/04/20 06:04:15 PM', 13177, 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `recurs`
--

DROP TABLE IF EXISTS `recurs`;
CREATE TABLE IF NOT EXISTS `recurs` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `Nom_document` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `Data_pujat` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `Descripcio` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `IDcurs` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDcurs` (`IDcurs`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Bolcament de dades per a la taula `recurs`
--

INSERT INTO `recurs` (`id`, `Nom`, `Nom_document`, `Data_pujat`, `Descripcio`, `IDcurs`) VALUES
(5, 'pdf3', 'Exercici Power Point.pdf', '29/04/2020 12:04:21 PM', 'rrrrrrr', 13),
(6, 'word', 'Word taules i tabulacions.pdf', '12/05/2020 09:05:33 AM', 'taules', 13);

-- --------------------------------------------------------

--
-- Estructura de la taula `resposta`
--

DROP TABLE IF EXISTS `resposta`;
CREATE TABLE IF NOT EXISTS `resposta` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDpregunta` int(11) NOT NULL,
  `missatge` text COLLATE latin1_spanish_ci,
  `Data` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDpregunta` (`IDpregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Bolcament de dades per a la taula `resposta`
--

INSERT INTO `resposta` (`ID`, `IDpregunta`, `missatge`, `Data`) VALUES
(2, 5, 'No és necessari Gerard! Poden no tenir foto, ens veiem a classe!!', '27/04/20 02:04:00 PM'),
(3, 6, '1231', '27/04/20 02:04:36 PM'),
(4, 7, '1', '27/04/20 02:04:11 PM');

-- --------------------------------------------------------

--
-- Estructura de la taula `tasca`
--

DROP TABLE IF EXISTS `tasca`;
CREATE TABLE IF NOT EXISTS `tasca` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  `Data` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  `IDcurs` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_Curs` (`IDcurs`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Bolcament de dades per a la taula `tasca`
--

INSERT INTO `tasca` (`ID`, `Nom`, `Data`, `IDcurs`) VALUES
(3, 'Prova de cat', '16/04/2020', 6),
(5, 'Prova primera', '16/04/2020', 7),
(7, 'Tasca 1', '20/04/2020', 13),
(8, 'Tasca 2', '20/04/2020', 13),
(10, 'TASCA 3', '', 13),
(12, 'Tsca 5', '23/04/2020', 13),
(13, 'ADF7SU', '23/04/2020', 13),
(14, 'DASSDADSA', '23/04/2020', 13),
(15, 'DASSDADSA', '23/04/2020', 13),
(16, 'TASCA PROVA', '23/4/20', 13),
(17, 'prova', '29/4/2020', 13),
(18, 'prova', '29/4/2020', 13),
(19, 'prova', '29/4/2020', 13),
(20, 'prova', '29/4/2020', 13),
(21, 'prova', '29/4/2020', 13),
(22, 'prova', '29/4/2020', 13),
(23, 'prova', '29/4/2020', 13),
(24, 'prova', '29/4/2020', 13),
(25, 'prova', '29/4/2020', 13),
(26, 'prova', '29/4/2020', 13),
(27, 'prova', '29/4/2020', 13),
(28, 'prova', '29/4/2020', 13),
(29, 'prova', '29/4/2020', 13),
(30, 'prova', '29/4/2020', 13),
(31, 'prova', '29/4/2020', 13),
(32, 'prova', '29/4/2020', 13),
(33, 'prova', '29/4/2020', 13),
(34, 'prova', '29/4/2020', 13),
(35, 'prova', '29/4/2020', 13),
(36, 'prova', '29/4/2020', 13),
(37, 'prova', '29/4/2020', 13),
(38, 'prova', '29/4/2020', 13),
(39, 'prova', '29/4/2020', 13),
(40, 'prova', '29/4/2020', 13),
(41, 'prova', '29/4/2020', 13),
(42, 'prova', '29/4/2020', 13),
(43, 'prova', '29/4/2020', 13),
(44, 'prova', '29/4/2020', 13),
(45, 'qerwqqwer', '30/04/2020 10:04:02 AM', 13),
(46, 'tasca 44', '12/05/2020 09:05:47 AM', 13);

-- --------------------------------------------------------

--
-- Estructura de la taula `trofeu`
--

DROP TABLE IF EXISTS `trofeu`;
CREATE TABLE IF NOT EXISTS `trofeu` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` char(30) COLLATE latin1_spanish_ci NOT NULL,
  `Descripcio` text COLLATE latin1_spanish_ci NOT NULL,
  `Punts` int(11) NOT NULL,
  `exercicis` int(11) NOT NULL,
  `img` varchar(300) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Bolcament de dades per a la taula `trofeu`
--

INSERT INTO `trofeu` (`ID`, `Nom`, `Descripcio`, `Punts`, `exercicis`, `img`) VALUES
(1, 'Benvingut', 'Has fet el primer exercici', 0, 1, '9.png'),
(2, 'Principiant', 'Has fet 10 exercicis', 0, 10, '5.png'),
(3, 'Amateur', 'Has fet 100 exercicis', 0, 100, '4.png'),
(4, 'Professional', 'Has fet 500 exercicis', 0, 500, '1.png'),
(5, 'Expert del Racó', 'Has fet 2000 exercicis', 0, 2000, '8.jpg'),
(6, 'Novato', 'Has fet els 10 primers punts', 10, 0, '10.jpg'),
(7, 'Esforç', 'Ja portes 100 punts', 100, 0, '6.png'),
(8, 'Alumne aplicat', 'Portes 1000 punts', 1000, 0, '3.png'),
(9, 'Ets un crack!', 'Portes 10000 punts', 10000, 0, '2.jpg'),
(10, 'Matricula d\'honor del Racó', 'Has fet molts exercicis i moltíssims punts, tot això ja et queda petit!', 50000, 6000, '7.png');

-- --------------------------------------------------------

--
-- Estructura de la taula `validacio_alumne`
--

DROP TABLE IF EXISTS `validacio_alumne`;
CREATE TABLE IF NOT EXISTS `validacio_alumne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IDalumne` int(11) NOT NULL,
  `codi` int(11) NOT NULL,
  `Data_enviament` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `validat` tinyint(1) NOT NULL,
  `Data_validacio` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDalumne` (`IDalumne`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Bolcament de dades per a la taula `validacio_alumne`
--

INSERT INTO `validacio_alumne` (`id`, `IDalumne`, `codi`, `Data_enviament`, `validat`, `Data_validacio`) VALUES
(1, 1, 0, '28/4/2020', 0, NULL),
(8, 1, 28203, '28/04/20 01:04:15 PM', 1, '28/04/20 01:04:42 PM'),
(9, 33, 3910, '30/04/20 11:04:38 AM', 1, '30/04/20 12:04:08 PM'),
(10, 34, 8728, '04/05/20 09:05:55 AM', 0, NULL),
(11, 35, 20238, '04/05/20 09:05:23 AM', 0, NULL),
(12, 36, 23802, '04/05/20 09:05:07 AM', 0, NULL),
(13, 37, 25704, '04/05/20 10:05:57 AM', 0, NULL),
(14, 38, 18012, '04/05/20 10:05:15 AM', 0, NULL),
(15, 39, 2891, '04/05/20 10:05:30 AM', 0, NULL),
(16, 40, 11365, '04/05/20 10:05:37 AM', 0, NULL),
(17, 41, 2066, '04/05/20 10:05:19 AM', 0, NULL),
(18, 42, 28992, '04/05/20 10:05:46 AM', 0, NULL),
(19, 43, 16243, '04/05/20 10:05:39 AM', 0, NULL),
(20, 44, 13611, '04/05/20 10:05:01 AM', 0, NULL),
(21, 45, 16591, '04/05/20 10:05:54 AM', 0, NULL),
(22, 46, 5592, '04/05/20 10:05:47 AM', 0, NULL),
(23, 47, 19853, '04/05/20 10:05:38 AM', 0, NULL),
(24, 48, 4127, '04/05/20 10:05:32 AM', 0, NULL),
(25, 49, 954, '04/05/20 10:05:56 AM', 0, NULL),
(26, 50, 15084, '04/05/20 10:05:49 AM', 0, NULL),
(27, 51, 12321, '04/05/20 10:05:05 AM', 0, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
