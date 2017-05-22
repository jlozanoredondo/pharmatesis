-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 30-03-2017 a las 19:25:54
-- Versión del servidor: 5.7.17-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.15-0ubuntu0.16.04.4

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disease`
--

CREATE TABLE `disease` (
  `id` int(5) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `sideEffects` varchar(60) DEFAULT NULL,
  `reaction` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `endure`
--

CREATE TABLE `endure` (
  `id` int(5) NOT NULL,
  `subjectId` int(5) NOT NULL,
  `diseaseId` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicament`
--

CREATE TABLE `medicament` (
  `id` int(5) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `phase`
--

CREATE TABLE `phase` (
  `id` int(5) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preinscription`
--

CREATE TABLE `preinscription` (
  `id` int(5) NOT NULL,
  `subjectId` int(5) NOT NULL,
  `medicamentId` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profession`
--

CREATE TABLE `profession` (
  `id` int(5) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `session`
--

CREATE TABLE `session` (
  `id` int(5) NOT NULL,
  `name` varchar(25) NOT NULL,
  `sessionDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `countryId` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  ADD KEY `projectId` (`projectId`),
  ADD KEY `subjectId` (`subjectId`),
  ADD KEY `phaseId` (`phaseId`),
  ADD KEY `sessionId` (`sessionId`);

--
-- Indices de la tabla `endure`
--
ALTER TABLE `endure`
  ADD PRIMARY KEY (`id`),
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
  ADD KEY `countryId` (`countryId`);

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `disease`
--
ALTER TABLE `disease`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dispense`
--
ALTER TABLE `dispense`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `endure`
--
ALTER TABLE `endure`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `medicament`
--
ALTER TABLE `medicament`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `phase`
--
ALTER TABLE `phase`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `preinscription`
--
ALTER TABLE `preinscription`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `profession`
--
ALTER TABLE `profession`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `project`
--
ALTER TABLE `project`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `session`
--
ALTER TABLE `session`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
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
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`countryId`) REFERENCES `country` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`professionId`) REFERENCES `profession` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
