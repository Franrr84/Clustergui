-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-06-2018 a las 18:22:11
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_appweb_leanxcale`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `componentes`
--

CREATE TABLE `componentes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `origen` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `visibilidad` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `componentes`
--

INSERT INTO `componentes` (`id`, `nombre`, `estado`, `origen`, `visibilidad`) VALUES
(1, 'ConfigurationManager', 'On', 'blade139', 1),
(2, 'Logger_1', 'On', 'blade139', 1),
(3, 'Logger_1', 'On', 'blade139', 1),
(4, 'SnapshotServer', 'On', 'blade139', 1),
(5, 'CommitSequencer', 'On', 'blade139', 1),
(6, 'ConflictManager_1', 'On', 'blade139', 1),
(7, 'KVMS', 'On', 'blade139', 1),
(8, 'KVDS_1', 'On', 'blade140', 1),
(9, 'KVDS_2', 'On', 'blade140', 1),
(10, 'KVDS_3', 'On', 'blade140', 1),
(11, 'KVDS_4', 'On', 'blade140', 1),
(12, 'KVDS_5', 'On', 'blade140', 1),
(13, 'KVDS_6', 'On', 'blade140', 1),
(14, 'KVDS_7', 'On', 'blade140', 1),
(15, 'KVDS_8', 'On', 'blade140', 1),
(16, 'Logger_1', 'On', 'blade140', 1),
(17, 'Logger_2', 'On', 'blade140', 1),
(18, 'QueryEngine_1', 'On', 'blade140', 1),
(19, 'QueryEngine_2', 'On', 'blade140', 1),
(20, 'KVDS_1', 'On', 'blade141', 1),
(21, 'KVDS_2', 'On', 'blade141', 1),
(22, 'KVDS_3', 'On', 'blade141', 1),
(23, 'KVDS_4', 'On', 'blade141', 1),
(24, 'KVDS_5', 'On', 'blade141', 1),
(25, 'KVDS_6', 'On', 'blade141', 1),
(26, 'KVDS_7', 'On', 'blade141', 1),
(27, 'KVDS_8', 'On', 'blade141', 1),
(28, 'Logger_1', 'On', 'blade141', 1),
(29, 'Logger_2', 'On', 'blade141', 1),
(30, 'QueryEngine_1', 'On', 'blade141', 1),
(31, 'QueryEngine_2', 'On', 'blade141', 1),
(32, 'KVDS_1', 'On', 'blade142', 1),
(33, 'KVDS_2', 'On', 'blade142', 1),
(34, 'KVDS_3', 'On', 'blade142', 1),
(35, 'KVDS_4', 'On', 'blade142', 1),
(36, 'KVDS_5', 'On', 'blade142', 1),
(37, 'KVDS_6', 'On', 'blade142', 1),
(38, 'KVDS_7', 'On', 'blade142', 1),
(39, 'KVDS_8', 'On', 'blade142', 1),
(40, 'Logger_1', 'On', 'blade142', 1),
(41, 'Logger_2', 'On', 'blade142', 1),
(42, 'QueryEngine_1', 'On', 'blade142', 1),
(43, 'QueryEngine_2', 'On', 'blade142', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinas`
--

CREATE TABLE `maquinas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `visibilidad` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `maquinas`
--

INSERT INTO `maquinas` (`id`, `nombre`, `estado`, `tipo`, `visibilidad`) VALUES
(1, 'blade139', 'On', 'Meta', 1),
(2, 'blade140', 'On', 'Datastores', 1),
(3, 'blade141', 'On', 'Datastores', 1),
(4, 'blade142', 'On', 'Datastores', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba`
--

CREATE TABLE `prueba` (
  `id` int(11) NOT NULL,
  `campo1` int(1) NOT NULL,
  `campo2` int(1) NOT NULL,
  `campo3` int(1) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `prueba`
--

INSERT INTO `prueba` (`id`, `campo1`, `campo2`, `campo3`, `nombre`, `condicion`) VALUES
(1, 1, 2, 3, 'Juan', 1),
(2, 4, 5, 6, 'Lola', 1),
(3, 7, 8, 9, 'Cloe', 1),
(4, 1, 2, 3, 'Peter', 0),
(5, 33, 24, 55, 'Luis', 1),
(6, 432, 2, 5, 'Tere', 1),
(7, 1, 2, 4, 'Polo', 1),
(8, 1, -1, 2, 'Champi', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba2`
--

CREATE TABLE `prueba2` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `componentes`
--
ALTER TABLE `componentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `maquinas`
--
ALTER TABLE `maquinas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prueba`
--
ALTER TABLE `prueba`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `prueba2`
--
ALTER TABLE `prueba2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `componentes`
--
ALTER TABLE `componentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `prueba`
--
ALTER TABLE `prueba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `prueba2`
--
ALTER TABLE `prueba2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
