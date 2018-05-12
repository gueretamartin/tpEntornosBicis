-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2018 a las 21:04:29
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
-- Estructura de tabla para la tabla `bike`
--

CREATE TABLE `bike` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `IdBikeType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biketype`
--

CREATE TABLE `biketype` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `image4` varchar(255) NOT NULL,
  `image5` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `dateFrom` date NOT NULL,
  `dateTo` date NOT NULL,
  `idTypeBike` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `totalPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `dni` int(12) NOT NULL,
  `password` varchar(32) NOT NULL,
  `type` int(1) NOT NULL,
  `fullName` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`dni`, `password`, `type`, `fullName`, `email`, `phone`) VALUES
(123, '202cb962ac59075b964b07152d234b70', 1, 'Administrador', 'admin@admin.com.ar', '123456789');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bike`
--
ALTER TABLE `bike`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bike_bikeType` (`IdBikeType`);

--
-- Indices de la tabla `biketype`
--
ALTER TABLE `biketype`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bike`
--
ALTER TABLE `bike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `biketype`
--
ALTER TABLE `biketype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bike`
--
ALTER TABLE `bike`
  ADD CONSTRAINT `fk_bike_bikeType` FOREIGN KEY (`IdBikeType`) REFERENCES `biketype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
