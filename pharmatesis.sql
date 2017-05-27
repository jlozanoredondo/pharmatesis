-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2017 a las 15:13:55
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pharmatesis`
--

CREATE DATABASE `pharmatesis`;
USE `pharmatesis`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `country`
--

CREATE TABLE `country` (
  `id` int(5) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Bolivia'),
(2, 'Cyprus'),
(3, 'Costa Rica'),
(4, 'Cuba'),
(5, 'France'),
(6, 'Germany'),
(7, 'Greece'),
(8, 'Indonesia'),
(9, 'Latvia'),
(10, 'Malaysia'),
(11, 'Republic of Moldova'),
(12, 'Mongolia'),
(13, 'Niger'),
(14, 'Qatar'),
(15, 'Spain'),
(16, 'South Sudan'),
(17, 'Vietnam');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disease`
--

CREATE TABLE `disease` (
  `id` int(5) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `disease`
--

INSERT INTO `disease` (`id`, `name`) VALUES
(1, 'Bipolar Disorder'),
(2, 'Depression'),
(3, 'Heart Disease'),
(4, 'Parkinson'),
(5, 'Schizophrenia'),
(6, 'Tuberculosis'),
(7, 'Lupus'),
(8, 'Phenylcetonuria'),
(9, 'Osteoarthritis'),
(10, 'Malaria'),
(11, 'AIDS or HIV'),
(12, 'Toxoplasmosis'),
(13, 'Thalassemia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispense`
--

CREATE TABLE `dispense` (
  `id` int(5) NOT NULL,
  `projectId` int(5) NOT NULL,
  `subjectId` int(5) NOT NULL,
  `phaseId` int(5) NOT NULL,
  `sessionId` int(5) NOT NULL,
  `viability` varchar(60) NOT NULL,
  `dose` float(6,2) NOT NULL,
  `sideEffects` varchar(60) DEFAULT NULL,
  `reaction` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dispense`
--

INSERT INTO `dispense` (`id`, `projectId`, `subjectId`, `phaseId`, `sessionId`, `viability`, `dose`, `sideEffects`, `reaction`) VALUES
(1, 1, 1, 1, 4, 'Oral', 1.00, 'None', 'None'),
(2, 1, 6, 1, 4, 'Oral', 1.00, 'None', 'None'),
(3, 1, 11, 1, 4, 'Oral', 1.00, 'Dizziness', 'Yes'),
(4, 1, 16, 1, 4, 'Oral', 1.00, 'None', 'None'),
(5, 1, 21, 1, 4, 'Oral', 1.00, 'None', 'None'),
(6, 1, 1, 1, 5, 'Oral', 2.00, 'None', 'None'),
(7, 1, 6, 1, 5, 'Oral', 2.00, 'No', 'None'),
(8, 1, 11, 1, 5, 'Oral', 0.50, 'None', 'None'),
(9, 1, 16, 1, 5, 'Oral', 2.00, 'None', 'None'),
(10, 1, 21, 1, 5, 'Oral', 2.00, 'Headache', 'None'),
(11, 1, 1, 1, 6, 'Oral', 3.00, 'None', 'None'),
(12, 1, 6, 1, 6, 'Oral', 3.00, 'None', 'None'),
(13, 1, 11, 1, 6, 'Oral', 0.90, 'None', 'None'),
(14, 1, 16, 1, 6, 'Oral', 3.00, 'None', 'None'),
(15, 1, 21, 1, 6, 'Oral', 1.50, 'None', 'None'),
(16, 2, 2, 1, 10, ' Intravenous', 0.50, 'Sickness \n', 'Yes'),
(17, 2, 7, 1, 10, ' Intravenous', 0.50, 'None', 'None'),
(18, 2, 12, 1, 10, ' Intravenous', 0.50, 'None', 'None'),
(19, 2, 17, 1, 10, ' Intravenous', 0.50, 'None', 'None'),
(20, 2, 22, 1, 10, ' Intravenous', 0.50, 'None', 'None'),
(21, 2, 2, 1, 11, 'intravenous', 0.30, 'None', 'None'),
(22, 2, 7, 1, 11, ' intravenous', 0.70, 'None', 'None'),
(23, 2, 12, 1, 11, ' intravenous', 0.70, 'None', 'None'),
(24, 2, 17, 1, 11, ' intravenous', 0.70, 'Erythema', 'None'),
(25, 2, 22, 1, 11, ' intravenous', 0.70, 'None', 'None'),
(26, 2, 2, 1, 12, ' intravenous', 0.40, 'None', 'None'),
(27, 2, 7, 1, 12, ' intravenous', 0.90, 'None', 'None'),
(28, 2, 12, 1, 12, ' intravenous', 0.90, 'None', 'None'),
(29, 2, 17, 1, 12, ' intravenous', 0.60, 'None', 'None'),
(30, 2, 22, 1, 12, ' intravenous', 0.90, 'None', 'None'),
(31, 3, 3, 1, 7, 'Oral', 0.80, 'None', 'None'),
(32, 3, 8, 1, 7, 'Oral', 0.80, 'None', 'None'),
(33, 3, 13, 1, 7, 'Oral', 0.80, 'None', 'None'),
(34, 3, 18, 1, 7, 'Oral', 0.80, 'None', 'None'),
(35, 3, 3, 1, 8, 'Oral', 1.20, 'None', 'None'),
(36, 3, 8, 1, 8, 'Oral', 1.20, 'None', 'None'),
(37, 3, 13, 1, 8, 'Oral', 1.20, 'None', 'None'),
(38, 3, 18, 1, 8, 'Oral', 1.20, 'None', 'None'),
(39, 3, 3, 1, 9, 'Oral', 1.60, 'None', 'None'),
(40, 3, 8, 1, 9, 'Oral', 1.60, 'None', 'None'),
(41, 3, 13, 1, 9, 'Oral', 1.60, 'None', 'None'),
(42, 3, 18, 1, 9, 'Oral', 1.60, 'None', 'None'),
(43, 4, 4, 1, 1, 'Topic', 3.00, 'None', 'None'),
(44, 4, 9, 1, 1, 'Topic', 3.00, 'None', 'None'),
(45, 4, 14, 1, 1, 'Topic', 3.00, 'None', 'None'),
(46, 4, 19, 1, 1, 'Topic', 3.00, 'None', 'None'),
(47, 4, 4, 1, 2, 'Topic', 6.00, 'None', ''),
(48, 4, 9, 1, 2, 'Topic', 6.00, 'None', 'None'),
(49, 4, 14, 1, 2, 'Topic', 6.00, 'Erythema', 'None'),
(50, 4, 19, 1, 2, 'Topic', 6.00, 'None', 'None'),
(51, 4, 4, 1, 3, 'Topic', 9.00, 'None', 'None'),
(52, 4, 9, 1, 3, 'Topic', 9.00, 'None', 'None'),
(53, 4, 14, 1, 3, 'Topic', 7.00, 'None', 'None'),
(54, 4, 19, 1, 3, 'Topic', 9.00, 'None', 'None'),
(55, 5, 5, 1, 13, ' intravenous', 0.30, 'None', 'None'),
(56, 5, 10, 1, 13, ' intravenous', 3.00, 'None', 'None'),
(57, 5, 15, 1, 13, ' intravenous', 0.30, 'None', 'None'),
(58, 5, 20, 1, 13, ' intravenous', 0.30, 'None', 'None'),
(59, 5, 5, 1, 14, ' intravenous', 0.70, 'None', 'None'),
(60, 5, 10, 1, 14, ' intravenous', 0.70, 'None', 'None'),
(61, 5, 15, 1, 14, ' intravenous', 0.70, 'None', 'None'),
(62, 5, 20, 1, 14, ' intravenous', 0.70, 'None', 'None'),
(63, 5, 5, 1, 15, ' intravenous', 1.00, 'None', 'None'),
(64, 5, 10, 1, 15, ' intravenous', 1.00, 'Convulsions', 'None'),
(65, 5, 15, 1, 15, ' intravenous', 1.00, 'None', 'None'),
(66, 5, 20, 1, 15, ' intravenous', 1.00, 'None', 'None'),
(67, 4, 4, 2, 16, 'Oral', 3.00, 'None', 'None'),
(68, 4, 9, 2, 16, 'Oral', 3.00, 'None', 'None'),
(69, 4, 14, 2, 16, 'Oral', 3.00, 'None', 'None'),
(70, 4, 19, 2, 16, 'Oral', 3.00, 'None', 'None'),
(71, 4, 4, 2, 17, 'Oral', 6.00, 'None', 'None'),
(73, 4, 9, 2, 17, 'Oral', 6.00, 'None', 'None'),
(74, 4, 14, 2, 17, 'Oral', 6.00, 'None', 'None'),
(75, 4, 19, 2, 17, 'Oral', 6.00, 'None', 'None'),
(76, 4, 4, 2, 18, 'Oral', 9.00, 'None', 'None'),
(77, 4, 9, 2, 18, 'Oral', 9.00, 'None', 'None'),
(78, 4, 14, 2, 18, 'Oral', 9.00, 'None', 'None'),
(79, 4, 19, 2, 18, 'Oral', 9.00, 'None', 'None'),
(80, 1, 1, 2, 19, 'Oral', 3.50, 'None', 'None'),
(81, 1, 6, 2, 19, 'Oral', 3.50, 'None', 'None'),
(82, 1, 11, 2, 19, 'Oral', 1.00, 'None', 'None'),
(83, 1, 16, 2, 19, 'Oral', 3.50, 'None', 'None'),
(84, 1, 21, 2, 19, 'Oral', 2.00, 'None', 'None'),
(85, 1, 1, 2, 20, 'Oral', 4.00, 'None', 'None'),
(86, 1, 6, 2, 20, 'Oral', 4.00, 'None', 'None'),
(87, 1, 11, 2, 20, 'Oral', 1.50, 'None', 'None'),
(88, 1, 16, 2, 20, 'Oral', 4.00, 'None', 'None'),
(89, 1, 21, 2, 20, 'Oral', 2.50, 'None', 'None'),
(90, 1, 1, 2, 21, 'Oral', 4.50, 'None', 'Yes'),
(91, 1, 6, 2, 21, 'Oral', 4.50, 'None', 'None'),
(92, 1, 11, 2, 21, 'Oral', 2.00, 'None', 'None'),
(93, 1, 16, 2, 21, 'Oral', 4.50, 'Headache', 'None'),
(94, 1, 21, 2, 21, 'Oral', 3.00, 'None', 'None'),
(95, 3, 3, 2, 22, 'Intravenous', 0.50, 'None', 'None'),
(96, 3, 8, 2, 22, 'Intravenous', 0.50, 'None', 'None'),
(97, 3, 13, 2, 22, 'Intravenous', 0.50, 'None', 'None'),
(98, 3, 18, 2, 22, 'Oral', 0.50, 'Sickness', 'None');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `endure`
--

CREATE TABLE `endure` (
  `id` int(5) NOT NULL,
  `subjectId` int(5) NOT NULL,
  `diseaseId` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `endure`
--

INSERT INTO `endure` (`id`, `subjectId`, `diseaseId`) VALUES
(1, 1, 1),
(2, 2, 10),
(3, 3, 7),
(4, 4, 4),
(5, 5, 5),
(6, 6, 1),
(7, 7, 10),
(8, 8, 7),
(9, 9, 4),
(10, 10, 5),
(11, 11, 1),
(12, 12, 10),
(13, 13, 7),
(14, 14, 4),
(15, 15, 5),
(16, 16, 1),
(17, 17, 10),
(18, 18, 7),
(19, 19, 4),
(20, 20, 5),
(22, 20, 10),
(21, 21, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicament`
--

CREATE TABLE `medicament` (
  `id` int(5) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `medicament`
--

INSERT INTO `medicament` (`id`, `name`) VALUES
(1, 'Omeoprazole'),
(2, 'Ibuprofen'),
(3, 'Paracetamol'),
(4, 'Lidocaine'),
(5, 'Atropine'),
(6, 'Diazepam'),
(7, 'Morphine'),
(8, 'Acetylsalicylic Acid'),
(9, 'Codeine'),
(10, 'Chloroquine'),
(11, 'Epinephrine'),
(12, 'Hydrocortisone'),
(13, 'Phenytoin'),
(14, 'Amoxicilin'),
(15, 'Benzylpenicillin'),
(16, 'Erythromycin'),
(17, 'Clindamycin'),
(18, 'Rifampicin'),
(19, 'Clotrimazole'),
(20, 'Acyclovir'),
(21, 'Amodiaquine'),
(22, 'Cyclosporine'),
(23, 'Tamoxifen'),
(24, 'Folic Acid'),
(25, 'Sodium Heparin'),
(26, 'Digoxin'),
(27, 'Enalapril'),
(28, 'Hydralazine'),
(29, 'Insulin'),
(30, 'Levothyroxine'),
(31, 'Pilocarpine'),
(32, 'Riboflavin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `phase`
--

CREATE TABLE `phase` (
  `id` int(5) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `phase`
--

INSERT INTO `phase` (`id`, `name`) VALUES
(1, 'Phase 1'),
(2, 'Phase 2'),
(3, 'Phase 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preinscription`
--

CREATE TABLE `preinscription` (
  `id` int(5) NOT NULL,
  `subjectId` int(5) NOT NULL,
  `medicamentId` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `preinscription`
--

INSERT INTO `preinscription` (`id`, `subjectId`, `medicamentId`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 3, 27),
(5, 4, 1),
(4, 4, 26),
(6, 4, 27),
(7, 5, 2),
(8, 6, 3),
(11, 7, 1),
(10, 7, 8),
(9, 7, 27),
(12, 9, 6),
(13, 9, 28),
(14, 10, 29),
(15, 12, 24),
(16, 14, 17),
(17, 15, 8),
(18, 15, 29),
(19, 16, 11),
(20, 18, 6),
(21, 18, 8),
(22, 18, 27),
(23, 19, 16),
(24, 21, 2),
(25, 21, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profession`
--

CREATE TABLE `profession` (
  `id` int(5) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profession`
--

INSERT INTO `profession` (`id`, `name`) VALUES
(1, 'Web dessigner'),
(2, 'Doctor'),
(3, 'Pharmacist'),
(4, 'Investigator'),
(5, 'Biologist'),
(6, 'Chemical');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project`
--

CREATE TABLE `project` (
  `id` int(5) NOT NULL,
  `userId` int(5) NOT NULL,
  `name` varchar(60) NOT NULL,
  `initialDate` date NOT NULL,
  `endDate` date DEFAULT NULL,
  `testedDrug` varchar(60) NOT NULL,
  `diseaseId` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `project`
--

INSERT INTO `project` (`id`, `userId`, `name`, `initialDate`, `endDate`, `testedDrug`, `diseaseId`) VALUES
(1, 1, '1wutM', '2017-02-20', NULL, '1wutM', 1),
(2, 2, 'CgGqV', '2017-04-03', NULL, 'CgGqV', 10),
(3, 3, 'DesU0', '2017-03-25', NULL, 'DesU0', 7),
(4, 4, '05RCd', '2017-01-15', NULL, '05RCd', 4),
(5, 5, 'dQge7', '2017-05-08', NULL, 'dQge7', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `session`
--

CREATE TABLE `session` (
  `id` int(5) NOT NULL,
  `name` varchar(25) NOT NULL,
  `sessionDate` datetime NOT NULL,
  `sessionEndDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `session`
--

INSERT INTO `session` (`id`, `name`, `sessionDate`, `sessionEndDate`) VALUES
(1, 'First session control(4)', '2017-01-15 00:00:00', '2017-01-16 00:00:00'),
(2, 'Second session control(4)', '2017-01-22 00:00:00', '2017-01-23 00:00:00'),
(3, 'Third session control(4)', '2017-01-30 00:00:00', '2017-01-31 00:00:00'),
(4, 'First session control(1)', '2017-02-20 00:00:00', '2017-02-21 00:00:00'),
(5, 'Second session control(1)', '2017-02-28 00:00:00', '2017-03-01 00:00:00'),
(6, 'Third session control(1))', '2017-03-12 00:00:00', '2017-03-13 00:00:00'),
(7, 'First session control (3)', '2017-03-25 00:00:00', '2017-03-26 00:00:00'),
(8, 'Second session control(3)', '2017-04-10 00:00:00', '2017-04-11 00:00:00'),
(9, 'Third session control(3)', '2017-04-22 00:00:00', '2017-04-23 00:00:00'),
(10, 'First session control(2)', '2017-04-03 00:00:00', '2017-04-04 00:00:00'),
(11, 'Second session control(2)', '2017-04-17 00:00:00', '2017-04-18 00:00:00'),
(12, 'Third session control(2)', '2017-04-23 00:00:00', '2017-04-24 00:00:00'),
(13, 'First session control(5)', '2017-05-08 00:00:00', '2017-05-09 00:00:00'),
(14, 'Second session control(5)', '2017-05-18 00:00:00', '2017-05-19 00:00:00'),
(15, 'Third session control(5)', '2017-05-28 00:00:00', NULL),
(16, 'fourth session control(4)', '2017-03-01 00:00:00', '2017-03-02 00:00:00'),
(17, 'fifth session control(4)', '2017-03-15 00:00:00', '2017-03-16 00:00:00'),
(18, 'sixth session control(4)', '2017-03-30 00:00:00', '2017-03-03 00:00:00'),
(19, 'fourth session control(1)', '2017-04-13 00:00:00', '2017-04-14 00:00:00'),
(20, 'fifth session control(1)', '2017-04-28 00:00:00', '2017-04-29 00:00:00'),
(21, 'sixth session control(1)', '2017-05-13 00:00:00', '2017-05-14 00:00:00'),
(22, 'fourth session control(3)', '2017-05-23 00:00:00', '2017-05-24 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subject`
--

CREATE TABLE `subject` (
  `id` int(5) NOT NULL,
  `bornDate` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `breed` varchar(20) NOT NULL,
  `nick` varchar(40) NOT NULL,
  `bloodType` varchar(5) NOT NULL,
  `status` varchar(20) NOT NULL,
  `height` float(3,2) NOT NULL,
  `weight` int(3) NOT NULL,
  `countryId` int(5) NOT NULL,
  `userid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subject`
--

INSERT INTO `subject` (`id`, `bornDate`, `gender`, `breed`, `nick`, `bloodType`, `status`, `height`, `weight`, `countryId`, `userid`) VALUES
(1, '1985-01-16', 'M', 'Caucasian', 'bDcu3', 'A', 'Single', 1.70, 70, 1, 1),
(2, '1990-04-17', 'F', 'Caucasian', '1cRXn', 'A', 'Single', 1.75, 70, 1, 2),
(3, '1995-02-05', 'M', 'American', 'J6TwP', '0', 'Single', 1.50, 60, 1, 3),
(4, '1961-11-03', 'M', 'Southeast Asian', 'I0NKe', 'AB', 'Married', 1.70, 90, 10, 4),
(5, '1978-05-07', 'F', 'Caucasian', 'Leq12', 'B', 'Divorced', 1.65, 53, 7, 5),
(6, '1985-12-20', 'F', 'American', 'cEMIL', 'A', 'Living common law', 1.68, 55, 3, 1),
(7, '1953-09-04', 'M', 'Caucasian', '7UCMq', '0', 'Separated', 1.53, 39, 5, 2),
(8, '1968-04-30', 'F', 'African', 'HWF8Z', 'B', 'Widowed', 1.85, 50, 13, 3),
(9, '1947-09-03', 'F', 'Southeast asian', 'TBWtN', 'B', 'Widowed', 1.52, 52, 17, 4),
(10, '1976-04-25', 'M', 'Caucasian', 'WB683', '0', 'Married', 2.10, 109, 11, 5),
(11, '1981-03-15', 'M', 'Caucasian', 'kOXuX', 'AB', 'Living common law', 1.88, 78, 9, 1),
(12, '1959-06-11', 'F', 'Oceanian', 'FP1U3', 'A', 'Married', 1.67, 72, 8, 2),
(13, '1973-02-10', 'M', 'African', 'pOMXJ', '0', 'Married', 1.71, 63, 14, 3),
(14, '1989-01-31', 'F', 'Caucasian', 'aoluU', 'B', 'Living common law', 1.63, 50, 2, 4),
(15, '1965-11-08', 'M', 'American', 'Ckl6y', 'A', 'Divorced', 1.78, 58, 4, 5),
(16, '1982-05-02', 'F', 'African', 'KnrW4', '0', 'Married', 1.62, 45, 16, 1),
(17, '1993-09-23', 'M', 'African', 'xwCTT', 'AB', 'Single', 1.55, 37, 13, 2),
(18, '1956-10-15', 'F', 'Caucasian', 'V7D9n', '0', 'Married', 1.75, 62, 15, 3),
(19, '1976-07-28', 'F', 'Southeast asian', 'o6R1d', 'B', 'Widowed', 1.45, 38, 10, 4),
(20, '1990-03-30', 'M', 'American', 'RuSwt', '0', 'Living common law', 1.78, 85, 3, 5),
(21, '1982-07-01', 'F', 'Caucasian', 'BeGcd', 'B', 'Separated', 1.89, 73, 5, 1),
(22, '1997-01-01', 'M', 'caucasian', 'qDahw', '0', 'Separated', 1.83, 69, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` int(20) DEFAULT NULL,
  `bornDate` date NOT NULL,
  `specialism` varchar(50) NOT NULL,
  `professionId` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `email`, `password`, `phone`, `bornDate`, `specialism`, `professionId`) VALUES
(1, 'Jonathan', 'Lozano', 'jlozanoredondo@gmail.com', '123456', NULL, '1985-01-16', 'BioInformatics', 1),
(2, 'Maria', 'Lewis', 'maria.lewis@gmail.com', '222222', 651486232, '1978-05-18', 'Parasites', 5),
(3, 'Robert', 'Sullivan', 'robert.sullivan@gmail.com', '333333', 658741562, '1984-12-28', 'Pneumologist', 2),
(4, 'Farik', 'Asaad', 'farik.asaad@gmail.com', '444444', 681546448, '1965-06-30', 'Neurologist', 2),
(5, 'Ivanova', 'Romanov', 'ivanova.romanov@gmail.com', '555555', 697452185, '1989-04-14', '\nPsychiatrist', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `disease`
--
ALTER TABLE `disease`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dispense`
--
ALTER TABLE `dispense`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projectId_2` (`projectId`,`subjectId`,`phaseId`,`sessionId`),
  ADD KEY `projectId` (`projectId`),
  ADD KEY `subjectId` (`subjectId`),
  ADD KEY `phaseId` (`phaseId`),
  ADD KEY `sessionId` (`sessionId`);

--
-- Indices de la tabla `endure`
--
ALTER TABLE `endure`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjectId_2` (`subjectId`,`diseaseId`),
  ADD UNIQUE KEY `subjectId_3` (`subjectId`,`diseaseId`),
  ADD KEY `subjectId` (`subjectId`),
  ADD KEY `diseaseId` (`diseaseId`);

--
-- Indices de la tabla `medicament`
--
ALTER TABLE `medicament`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `phase`
--
ALTER TABLE `phase`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preinscription`
--
ALTER TABLE `preinscription`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjectId_2` (`subjectId`,`medicamentId`),
  ADD UNIQUE KEY `subjectId_3` (`subjectId`,`medicamentId`),
  ADD KEY `subjectId` (`subjectId`),
  ADD KEY `medicamentId` (`medicamentId`);

--
-- Indices de la tabla `profession`
--
ALTER TABLE `profession`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userId_2` (`userId`,`name`),
  ADD KEY `userId` (`userId`),
  ADD KEY `diseaseId` (`diseaseId`);

--
-- Indices de la tabla `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countryId` (`countryId`),
  ADD KEY `subject_ibfk_2` (`userid`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professionId` (`professionId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `country`
--
ALTER TABLE `country`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `disease`
--
ALTER TABLE `disease`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `dispense`
--
ALTER TABLE `dispense`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT de la tabla `endure`
--
ALTER TABLE `endure`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `medicament`
--
ALTER TABLE `medicament`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `phase`
--
ALTER TABLE `phase`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `preinscription`
--
ALTER TABLE `preinscription`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `profession`
--
ALTER TABLE `profession`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `project`
--
ALTER TABLE `project`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `session`
--
ALTER TABLE `session`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dispense`
--
ALTER TABLE `dispense`
  ADD CONSTRAINT `dispense_ibfk_1` FOREIGN KEY (`projectId`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `dispense_ibfk_2` FOREIGN KEY (`subjectId`) REFERENCES `subject` (`id`),
  ADD CONSTRAINT `dispense_ibfk_3` FOREIGN KEY (`phaseId`) REFERENCES `phase` (`id`),
  ADD CONSTRAINT `dispense_ibfk_4` FOREIGN KEY (`sessionId`) REFERENCES `session` (`id`);

--
-- Filtros para la tabla `endure`
--
ALTER TABLE `endure`
  ADD CONSTRAINT `endure_ibfk_1` FOREIGN KEY (`subjectId`) REFERENCES `subject` (`id`),
  ADD CONSTRAINT `endure_ibfk_2` FOREIGN KEY (`diseaseId`) REFERENCES `disease` (`id`);

--
-- Filtros para la tabla `preinscription`
--
ALTER TABLE `preinscription`
  ADD CONSTRAINT `preinscription_ibfk_1` FOREIGN KEY (`subjectId`) REFERENCES `subject` (`id`),
  ADD CONSTRAINT `preinscription_ibfk_2` FOREIGN KEY (`medicamentId`) REFERENCES `medicament` (`id`);

--
-- Filtros para la tabla `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`diseaseId`) REFERENCES `disease` (`id`);

--
-- Filtros para la tabla `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`countryId`) REFERENCES `country` (`id`),
  ADD CONSTRAINT `subject_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`professionId`) REFERENCES `profession` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
