-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-09-2024 a las 18:24:48
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
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `Cedula` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Correo` varchar(100) NOT NULL,
  `Contraseña` varchar(255) NOT NULL,
  `NumeroTelefono` varchar(15) NOT NULL,
  `Rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`Cedula`, `Nombre`, `Correo`, `Contraseña`, `NumeroTelefono`, `Rol`) VALUES
(1037675235, 'Edilson Sarmiento', 'ediilson@email.com', '$2y$10$NVNjO3tL42S2Wvwfh6.pu.PRMREe9JwtbXoJtrAJqOF4Ly57Cg/GC', '3127570956', 1),
(1234567890, 'Andres Osorio', 'andres@email.com', '$2y$10$2.c0VYnzag6qyzh/3rqHFeMBgt385DdrX2vjlIklfZJzRsAh8yyDi', '3109998877', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenador`
--

CREATE TABLE `entrenador` (
  `Cedula` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Correo` varchar(100) NOT NULL,
  `Contraseña` varchar(255) NOT NULL,
  `NumeroTelefono` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresias`
--

CREATE TABLE `membresias` (
  `CodigoMembresia` int(11) NOT NULL,
  `NombreMembresia` varchar(100) NOT NULL,
  `MesesValidezMembresia` int(2) NOT NULL,
  `DescripcionMembresia` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `membresias`
--

INSERT INTO `membresias` (`CodigoMembresia`, `NombreMembresia`, `MesesValidezMembresia`, `DescripcionMembresia`) VALUES
(1, 'Plan Básico', 1, 'Plan básico mensual que le permite al cliente acceder por 1 mes al gimnasio, con acceso a todas las máquinas menos la caminadora');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresia_usuario`
--

CREATE TABLE `membresia_usuario` (
  `CedulaUsuario` int(11) NOT NULL,
  `CodigoMembresia` int(11) NOT NULL,
  `FechaInicio` datetime NOT NULL,
  `FechaFin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `membresia_usuario`
--

INSERT INTO `membresia_usuario` (`CedulaUsuario`, `CodigoMembresia`, `FechaInicio`, `FechaFin`) VALUES
(1036252893, 1, '2024-09-06 18:15:23', '2024-10-06 18:15:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Cedula` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Sexo` char(1) NOT NULL,
  `NumeroTelefono` varchar(15) DEFAULT NULL,
  `Correo` varchar(100) NOT NULL,
  `Contraseña` varchar(255) NOT NULL,
  `Peso` int(11) DEFAULT NULL,
  `Altura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Cedula`, `Nombre`, `Sexo`, `NumeroTelefono`, `Correo`, `Contraseña`, `Peso`, `Altura`) VALUES
(1007480801, 'Andres Osorio', 'M', '3134538040', 'andresosoriocardona@gmail.com', '$2y$10$WH2Q8bx2nwo2yL.iQsZJy.Af0VHLk4Zr8iea/76RBiqRGM4CVNrca', 65, 180),
(1036252893, 'Maicol Franco', 'M', '3105311492', 'maicol@email.com', '$2y$10$Ra5B8W3Stwz1zN1.WPNuXerk67/AV1ZYeEv5Ew.0xpcP5TJH6c3tW', 80, 170),
(1037675235, 'Edilson Sarmiento', 'M', '3127570956', 'edilson@email.com', '$2y$10$BtvNVY6g0DzzWh4noXJc7.qJ6h7m9VadPR.cLxMXc7J4TAoRB1y0y', 98, 189);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`Cedula`),
  ADD UNIQUE KEY `Correo` (`Correo`);

--
-- Indices de la tabla `entrenador`
--
ALTER TABLE `entrenador`
  ADD PRIMARY KEY (`Cedula`),
  ADD UNIQUE KEY `Correo` (`Correo`);

--
-- Indices de la tabla `membresias`
--
ALTER TABLE `membresias`
  ADD PRIMARY KEY (`CodigoMembresia`);

--
-- Indices de la tabla `membresia_usuario`
--
ALTER TABLE `membresia_usuario`
  ADD PRIMARY KEY (`CedulaUsuario`,`CodigoMembresia`),
  ADD KEY `fk_membresia_usuario_membresia` (`CodigoMembresia`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Cedula`),
  ADD UNIQUE KEY `Correo` (`Correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `membresias`
--
ALTER TABLE `membresias`
  MODIFY `CodigoMembresia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `membresia_usuario`
--
ALTER TABLE `membresia_usuario`
  ADD CONSTRAINT `fk_membresia_usuario_membresia` FOREIGN KEY (`CodigoMembresia`) REFERENCES `membresias` (`CodigoMembresia`),
  ADD CONSTRAINT `fk_membresia_usuario_usuario` FOREIGN KEY (`CedulaUsuario`) REFERENCES `usuarios` (`Cedula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
