-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2026 a las 06:23:08
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `siesa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carro`
--

CREATE TABLE `carro` (
  `ID_Carro` int(11) NOT NULL,
  `ID_Usuario` int(11) DEFAULT NULL,
  `Matricula` varchar(10) DEFAULT NULL,
  `Marca` varchar(50) DEFAULT NULL,
  `Modelo` varchar(50) DEFAULT NULL,
  `Color` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `carro`
--

INSERT INTO `carro` (`ID_Carro`, `ID_Usuario`, `Matricula`, `Marca`, `Modelo`, `Color`) VALUES
(1, 1000, '1234567', 'HONDA', 'CIVIC', 'NEGRO'),
(2, 1002, 'REGJO043', 'NISSAN', 'PILOT', 'VERDE LIMA'),
(3, 1003, 'FEF5S2Q', 'TOYOTA', 'TOYOTA', 'TOYOTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `ID_Registro` int(11) NOT NULL,
  `ID_Usuario` int(11) DEFAULT NULL,
  `ID_Guardia` int(11) DEFAULT NULL,
  `EntradaSalida` varchar(50) DEFAULT NULL,
  `MetodoAcceso` varchar(50) DEFAULT NULL,
  `ID_Carro` int(11) DEFAULT NULL,
  `Fecha` date DEFAULT curdate(),
  `Hora` time DEFAULT curtime(),
  `Lugar` varchar(100) DEFAULT NULL,
  `Motivo` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`ID_Registro`, `ID_Usuario`, `ID_Guardia`, `EntradaSalida`, `MetodoAcceso`, `ID_Carro`, `Fecha`, `Hora`, `Lugar`, `Motivo`) VALUES
(2, 1000, NULL, 'Entrada', 'Peatonal', NULL, '2026-05-01', '06:18:00', 'Unidad Tomas de Aquino', 'HORARIO ESCOLAR'),
(3, 1003, NULL, 'Entrada', 'Peatonal', NULL, '2026-05-01', '06:19:28', 'Unidad Tomas de Aquino', 'HORARIO ESCOLAR'),
(4, 1003, NULL, 'Salida', 'Peatonal', NULL, '2026-05-01', '06:19:31', 'Unidad Tomas de Aquino', 'HORARIO ESCOLAR'),
(5, 1003, NULL, 'Entrada', 'Vehicular', 3, '2026-05-01', '06:20:42', 'Unidad Tomas de Aquino', 'HORARIO ESCOLAR'),
(6, 1003, NULL, 'Salida', 'Vehicular', 3, '2026-05-01', '06:20:49', 'Unidad Tomas de Aquino', 'HORARIO ESCOLAR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `ID_Rol` int(11) NOT NULL,
  `NombreRol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`ID_Rol`, `NombreRol`) VALUES
(1, 'Administrador'),
(2, 'Guardia'),
(3, 'Alumno'),
(4, 'Visitante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_Usuario` int(11) NOT NULL,
  `NoControl` varchar(50) DEFAULT NULL,
  `Nombres` varchar(50) DEFAULT NULL,
  `Apellidos` varchar(50) DEFAULT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `Telefono` varchar(50) DEFAULT NULL,
  `Contrasena` varchar(100) DEFAULT NULL,
  `ID_Rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_Usuario`, `NoControl`, `Nombres`, `Apellidos`, `Correo`, `Telefono`, `Contrasena`, `ID_Rol`) VALUES
(1000, '24212243', 'ADMINISTRADOR', 'RAYMUNDO', 'administrador@gmail.com', '1231231234', '123', 1),
(1001, '2525252525', 'GUARDIA', 'RAYMUNDO', 'guardia@gmail.com', '1231231234', '123', 2),
(1002, '2121212121', 'ALUMNO', 'RAYMUNDO', 'alumno@gmail.com', '1231231234', '123', 3),
(1003, '22211907', 'VISITANTE', 'RAYMUNDO', 'visitante@gmail.com', '1231231234', 'visitante123', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carro`
--
ALTER TABLE `carro`
  ADD PRIMARY KEY (`ID_Carro`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`ID_Registro`),
  ADD KEY `ID_Usuario` (`ID_Usuario`),
  ADD KEY `ID_Guardia` (`ID_Guardia`),
  ADD KEY `ID_Carro` (`ID_Carro`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`ID_Rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD KEY `ID_Rol` (`ID_Rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carro`
--
ALTER TABLE `carro`
  MODIFY `ID_Carro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `ID_Registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `ID_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carro`
--
ALTER TABLE `carro`
  ADD CONSTRAINT `fk_carro_usuario` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`);

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `fk_registro_carro` FOREIGN KEY (`ID_Carro`) REFERENCES `carro` (`ID_Carro`),
  ADD CONSTRAINT `fk_registro_guardia` FOREIGN KEY (`ID_Guardia`) REFERENCES `usuario` (`ID_Usuario`),
  ADD CONSTRAINT `fk_registro_usuario` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`ID_Rol`) REFERENCES `rol` (`ID_Rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
