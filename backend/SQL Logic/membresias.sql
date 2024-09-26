-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-09-2024 a las 05:09:54
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `control_software`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresias`
--

CREATE TABLE `membresias` (
  `CodigoMembresia` int(11) NOT NULL,
  `NombreMembresia` varchar(100) NOT NULL,
  `MesesValidezMembresia` int(2) NOT NULL,
  `DescripcionMembresia` text DEFAULT NULL,
  `PrecioMembresia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `membresias`
--

INSERT INTO `membresias` (`CodigoMembresia`, `NombreMembresia`, `MesesValidezMembresia`, `DescripcionMembresia`, `PrecioMembresia`) VALUES
(1, 'Plan Básico Mensual', 1, 'Plan básico mensual que le permite al cliente acceder por 1 mes al gimnasio, con acceso a todas las máquinas menos la caminadora', 65000),
(2, 'Plan Plus Trimestral.', 3, '+ Plan plus trimestral que le permite al cliente acceder por 3 mes al gimnasio, con acceso a todas las máquinas incluyendo la caminadora.', 120000),
(4, 'Plan VIP Anual', 12, '+ Plan VIP mensual que le permite al cliente acceder por 12 meses al gimnasio, con acceso a todas las máquinas y beneficios que el gimnasio le ofrece.', 580000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `membresias`
--
ALTER TABLE `membresias`
  ADD PRIMARY KEY (`CodigoMembresia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `membresias`
--
ALTER TABLE `membresias`
  MODIFY `CodigoMembresia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
