-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2018 a las 01:36:57
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `choferes`
--

CREATE TABLE `choferes` (
  `id_chofer` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `legajo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `choferes_vehiculos`
--

CREATE TABLE `choferes_vehiculos` (
  `id_chofer` int(11) NOT NULL,
  `id_vehiculo` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `domicilio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `id_usuario`, `domicilio`) VALUES
(1, 10, '1321321313'),
(2, 11, '1321321313'),
(3, 12, '1321321313'),
(4, 13, '1321321313'),
(5, 14, '1321321313'),
(6, 15, '13132'),
(7, 16, '13132'),
(8, 17, '13132'),
(9, 18, '13132');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargados`
--

CREATE TABLE `encargados` (
  `id_encargado` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `legajo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntajes`
--

CREATE TABLE `puntajes` (
  `id_puntaje` int(11) NOT NULL,
  `id_viaje` int(11) NOT NULL,
  `puntaje_viaje` int(11) NOT NULL,
  `id_chofer` int(11) NOT NULL,
  `puntaje_chofer` int(11) NOT NULL,
  `id_vehiculo` int(11) NOT NULL,
  `puntaje_vehiculo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `puntaje_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `mail` varchar(50) COLLATE utf16_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf16_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf16_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf16_spanish_ci NOT NULL,
  `dni` int(11) NOT NULL,
  `telefono` int(20) NOT NULL,
  `tipo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `mail`, `password`, `nombre`, `apellido`, `dni`, `telefono`, `tipo`) VALUES
(9, 'juanp@gmail.com', 'asd123', 'joselooooo', 'perez', 36451289, 142233654, 1),
(10, 'mail', 'uberto29124119', 'jujan', 'lelrkelr', 29124119, 2147483647, 3),
(11, 'mail', 'uberto29124119', 'jujan', 'lelrkelr', 29124119, 2147483647, 3),
(12, 'mail', 'uberto29124119', 'jujan', 'lelrkelr', 29124119, 2147483647, 3),
(13, 'mail', 'uberto29124119', 'jujan', 'lelrkelr', 29124119, 2147483647, 3),
(14, 'mail', 'uberto29124119', 'jujan', 'lelrkelr', 29124119, 2147483647, 3),
(15, 'mail', 'uberto16546461', '32132132', '132132', 16546461, 2147483647, 3),
(16, 'mail', 'uberto16546461', '32132132', '132132', 16546461, 2147483647, 3),
(17, 'mailssss', 'uberto16546461', '32132132', '132132', 16546461, 2147483647, 3),
(18, 'mailssssqweqwe', 'uberto16546461', 'qweqwe', '132132', 16546461, 2147483647, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id_vehiculo` int(11) NOT NULL,
  `id_chofer` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `anio` int(11) NOT NULL,
  `fumar` int(11) NOT NULL,
  `aire` int(11) NOT NULL,
  `baul` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id_vehiculo`, `id_chofer`, `marca`, `modelo`, `anio`, `fumar`, `aire`, `baul`) VALUES
(3, 0, 'chevrolet', 'corsa', 2015, 0, 0, 0),
(4, 0, 'fiat', 'palio', 2017, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `id_viaje` int(11) NOT NULL,
  `id_encargado` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_chofer` int(11) NOT NULL,
  `direccion_inicio` varchar(50) NOT NULL,
  `direccion_destino` varchar(50) NOT NULL,
  `distancia` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `costo` int(11) NOT NULL,
  `forma_pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `choferes`
--
ALTER TABLE `choferes`
  ADD PRIMARY KEY (`id_chofer`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `choferes_vehiculos`
--
ALTER TABLE `choferes_vehiculos`
  ADD KEY `id_chofer` (`id_chofer`,`id_vehiculo`),
  ADD KEY `id_vehiculo` (`id_vehiculo`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `encargados`
--
ALTER TABLE `encargados`
  ADD PRIMARY KEY (`id_encargado`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `puntajes`
--
ALTER TABLE `puntajes`
  ADD PRIMARY KEY (`id_puntaje`),
  ADD KEY `id_viaje` (`id_viaje`,`id_chofer`,`id_vehiculo`,`id_cliente`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id_vehiculo`),
  ADD KEY `id_chofer` (`id_chofer`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`id_viaje`),
  ADD KEY `id_encargado` (`id_encargado`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_chofer` (`id_chofer`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `choferes`
--
ALTER TABLE `choferes`
  MODIFY `id_chofer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `encargados`
--
ALTER TABLE `encargados`
  MODIFY `id_encargado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puntajes`
--
ALTER TABLE `puntajes`
  MODIFY `id_puntaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id_viaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `choferes`
--
ALTER TABLE `choferes`
  ADD CONSTRAINT `choferes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `choferes_vehiculos`
--
ALTER TABLE `choferes_vehiculos`
  ADD CONSTRAINT `choferes_vehiculos_ibfk_1` FOREIGN KEY (`id_chofer`) REFERENCES `choferes` (`id_chofer`),
  ADD CONSTRAINT `choferes_vehiculos_ibfk_2` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculos` (`id_vehiculo`);

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `encargados`
--
ALTER TABLE `encargados`
  ADD CONSTRAINT `encargados_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `puntajes`
--
ALTER TABLE `puntajes`
  ADD CONSTRAINT `puntajes_ibfk_1` FOREIGN KEY (`id_viaje`) REFERENCES `viajes` (`id_viaje`);

--
-- Filtros para la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD CONSTRAINT `viajes_ibfk_1` FOREIGN KEY (`id_encargado`) REFERENCES `encargados` (`id_encargado`),
  ADD CONSTRAINT `viajes_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `viajes_ibfk_3` FOREIGN KEY (`id_chofer`) REFERENCES `choferes` (`id_chofer`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
