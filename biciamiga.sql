-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2018 a las 02:46:27
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biciamiga`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bicicletas`
--

CREATE TABLE `bicicletas` (
  `id_bici` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `precio_hr` decimal(10,0) NOT NULL,
  `precio_dia` decimal(10,0) NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `booking`
--

CREATE TABLE `booking` (
  `numberBooking` int(11) NOT NULL,
  `user` varchar(500) NOT NULL,
  `dateFrom` date NOT NULL,
  `dateTo` date NOT NULL,
  `typeBike` int(11) NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `booking`
--

INSERT INTO `booking` (`numberBooking`, `user`, `dateFrom`, `dateTo`, `typeBike`, `state`) VALUES
(1, 'admin', '2018-05-08', '0000-00-00', 1, 1),
(4, '123', '2018-05-19', '2018-05-11', 1, 1),
(5, '123', '2018-05-04', '2018-05-10', 2, 1),
(6, '123', '2018-05-19', '2018-05-11', 0, 1),
(7, '123', '2018-05-04', '2018-05-10', 0, 1),
(8, '123', '2018-05-04', '2018-05-10', 2, 1),
(9, '123', '2018-05-19', '2018-05-11', 2, 1),
(10, '123', '2018-05-19', '2018-05-11', 2, 1),
(11, '123', '2018-05-19', '2018-05-11', 2, 1),
(12, '123', '2018-05-19', '2018-05-11', 2, 1),
(13, '123', '2018-05-19', '2018-05-12', 2, 1),
(15, '123', '2018-05-19', '2018-05-12', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `dni` int(12) NOT NULL,
  `password` varchar(32) NOT NULL,
  `type` int(1) NOT NULL,
  `fullName` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`dni`, `password`, `type`, `fullName`, `email`, `phone`) VALUES
(12, 'f8e0920f299', 0, 'asdas', '123', 'asd'),
(42, 'f8e0920f29985ad1a2724161e86faa65', 0, 'e234234234', 'werwer', 'werwerwer'),
(123, '21232f297a57a5a743894a0e4a801fc3', 0, 'admin', 'admin@admin.com', '421196'),
(999, 'f5bb0c8de146c67b44babbf4e6584cc0', 0, 'martin', 'martin@martin.com', '1239'),
(1235, '827ccb0eea8', 0, 'facu', 'facu@facu.com', '12312'),
(3234, '108a51ab7848e734dda43115cf3e7d5c', 0, 'MartÃ­n', 'martin@martin.com', 'kaka1231'),
(8888, 'b6d767d2f8ed5d21a44b0e5886680cb9', 0, 'martin', 'admin@admin.com', '429912'),
(33333, '61b80f94cdd', 0, 'fggdfdgd', '234', 'q34234234'),
(123123, 'holis', 0, 'guille', 'asdlhasjd', '823478924'),
(37450910, '827ccb0eea8a706c4c34a16891f84e7b', 0, 'Facundo Alvarez', 'dgas@aa.com', 'adsgasdgadsadsga'),
(39953038, 'c4ca4238a0b923820dcc509a6f75849b', 0, 'martin', 'tinchin77@tinchin.com', '421196'),
(423424234, 'md5(rwererw', 0, 'wrewerer', 'werwerwer', 'wrewerwer');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bicicletas`
--
ALTER TABLE `bicicletas`
  ADD PRIMARY KEY (`id_bici`),
  ADD UNIQUE KEY `id_bici` (`id_bici`),
  ADD UNIQUE KEY `id_bici_3` (`id_bici`),
  ADD KEY `id_bici_2` (`id_bici`),
  ADD KEY `id_bici_4` (`id_bici`),
  ADD KEY `id_bici_5` (`id_bici`);

--
-- Indices de la tabla `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`numberBooking`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bicicletas`
--
ALTER TABLE `bicicletas`
  MODIFY `id_bici` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `booking`
--
ALTER TABLE `booking`
  MODIFY `numberBooking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
