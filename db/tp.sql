-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-07-2018 a las 00:06:53
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

--
-- Volcado de datos para la tabla `choferes`
--

INSERT INTO `choferes` (`id_chofer`, `id_usuario`, `legajo`) VALUES
(1, 19, 31122),
(2, 20, 31122),
(3, 21, 31122),
(4, 22, 1233),
(5, 23, 123),
(6, 25, 317),
(7, 11, 333);

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
(3, 12, '1321321313'),
(4, 13, '1321321313'),
(5, 14, '1321321313'),
(6, 15, 'mitre 456'),
(7, 16, 'altolaguirre 456'),
(8, 17, '13132'),
(9, 18, '13132'),
(10, 24, '234234'),
(13, 28, 'mitre 4566'),
(15, 30, '32132132');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargados`
--

CREATE TABLE `encargados` (
  `id_encargado` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `legajo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `encargados`
--

INSERT INTO `encargados` (`id_encargado`, `id_usuario`, `legajo`) VALUES
(1, 10, 32),
(2, 9, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

CREATE TABLE `encuestas` (
  `id_encuesta` int(11) NOT NULL,
  `id_viaje` int(11) NOT NULL,
  `puntaje_viaje` int(11) NOT NULL,
  `id_chofer` int(11) NOT NULL,
  `puntaje_chofer` int(11) NOT NULL,
  `id_vehiculo` int(11) NOT NULL,
  `puntaje_vehiculo` int(11) NOT NULL,
  `pregunta1` int(11) NOT NULL,
  `pregunta2` int(11) NOT NULL,
  `pregunta3` int(11) NOT NULL,
  `pregunta4` int(11) NOT NULL,
  `observaciones` varchar(250) COLLATE utf16_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `encuestas`
--

INSERT INTO `encuestas` (`id_encuesta`, `id_viaje`, `puntaje_viaje`, `id_chofer`, `puntaje_chofer`, `id_vehiculo`, `puntaje_vehiculo`, `pregunta1`, `pregunta2`, `pregunta3`, `pregunta4`, `observaciones`) VALUES
(3, 24, 2, 11, 2, 10, 3, 4, 4, 5, 4, 'asDASDDASSDAF'),
(5, 28, 3, 11, 4, 5, 2, 3, 5, 5, 4, 'sdasdqwdqwd');

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
(10, 'encargado', '1', 'Pablo', 'Frenkel', 29544119, 2147483647, 1),
(11, 'chofer', '2', 'Julian', 'Marquez', 29132219, 2147483647, 2),
(12, 'cliente', '3', 'Ariel', 'Lambezat', 33124119, 2147483647, 3),
(13, 'mail', 'uberto29124119', 'Natalia', 'Labonia', 29124119, 2147483647, 3),
(14, 'mail', 'uberto29124119', 'Giselle', 'Molina', 29124119, 2147483647, 3),
(15, 'mail', 'uberto16546461', 'Estefania', 'Villalba', 16546461, 2147483647, 3),
(16, 'mail', 'uberto16546461', 'Rogelio', 'Aguada', 16546461, 2147483647, -3),
(17, 'mailssss', 'uberto16546461', 'Matias', 'Lenriques', 16546461, 2147483647, 3),
(18, 'mailssssqweqwe', 'uberto16546461', 'Lorena', 'Encinas', 16546461, 2147483647, 3),
(19, 'chofer@gmail.com', 'uberto12312312', 'Juan', 'Mazzedo', 29125567, 1233434343, 2),
(20, 'chofer@gmail.com2', 'uberto12312312', 'Jose', 'Fernandez', 36987632, 1233434343, 2),
(21, 'chofer@gmail.com3', 'uberto12312312', 'Enrique', 'Messi', 23456324, 1233434343, -2),
(22, 'chof@gm.com', 'uberto1233123', 'Roberto', 'Machuca', 31459835, 312312312, 2),
(23, 'jum@com.com', 'uberto1233321', 'Maria', 'Sanchez', 21777283, 321321, 2),
(24, '21@asd.cpom', 'uberto123', 'Eugenio', 'Labonia', 27123332, 432423, -3),
(25, 'juan@hoa.com', 'uberto29125558', 'juan', 'carlos', 29125558, 1164856632, 2),
(28, 'ignalop@gmail.com', 'uberto36445112', 'ignacio', 'loprete', 36445112, 1164896324, 3),
(30, 'nuevo@nuevo.com', '000000', 'nuevo', 'nuevo', 1131, 4555225, -3);

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
(3, 1, 'chevrolet', 'corsa', 2015, 0, 0, 0),
(4, 2, 'fiat', 'palio', 2017, 1, 1, 0),
(5, 3, 'toyota', 'etios', 2017, 1, 0, 1),
(6, 7, 'chevrolet', 'corsa', 2015, 1, 1, 0),
(7, 5, 'chevrolet', 'corsa', 2016, 1, 1, 1),
(8, 6, 'chevrolet', 'corsa', 2015, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `id_viaje` int(11) NOT NULL,
  `id_encargado` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_chofer` int(11) NOT NULL,
  `id_vehiculo` int(11) NOT NULL,
  `latitud_inicio` double NOT NULL,
  `longitud_inicio` double NOT NULL,
  `latitud_destino` double NOT NULL,
  `longitud_destino` double NOT NULL,
  `inicio` varchar(250) NOT NULL,
  `destino` varchar(250) NOT NULL,
  `distancia` int(11) NOT NULL,
  `costo` int(11) NOT NULL,
  `forma_pago` int(11) NOT NULL,
  `fecha_salida` datetime NOT NULL,
  `fecha_llegada` datetime NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`id_viaje`, `id_encargado`, `id_cliente`, `id_chofer`, `id_vehiculo`, `latitud_inicio`, `longitud_inicio`, `latitud_destino`, `longitud_destino`, `inicio`, `destino`, `distancia`, `costo`, `forma_pago`, `fecha_salida`, `fecha_llegada`, `estado`) VALUES
(24, 0, 12, 11, 10, -34.7009162902832, -58.3431821, -34.7009156, -58.3431821, 'Manuel Gálvez 4502, B1874AXB Villa Dominico, Buenos Aires, Argentina', 'Manuel Gálvez 4502, B1874AXB Villa Dominico, Buenos Aires, Argentina', 453, 453453, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(28, 0, 12, 11, 5, -34.6747324, -58.6254466, -34.6677742, -58.3513222, 'Lanús 2805, B1708HGU Morón, Buenos Aires, Argentina', 'Av. Gral. Roca 1871, Crucecita, Buenos Aires, Argentina', 37756, 566, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(34, 10, 13, 21, 5, -34.6909632, -58.3431821, -34.6747324, -58.6254466, 'Almte Solier 3848, B1872FSS Sarandí, Buenos Aires, Argentina', 'Lanús 2805, B1708HGU Morón, Buenos Aires, Argentina', 39868, 598, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(35, 0, 12, 20, 4, -34.6747324, -58.6254466, -34.6933055, -58.3137285, 'Lanús 2805, B1708HGU Morón, Buenos Aires, Argentina', 'Merlo 5701, B1875BZE Wilde, Buenos Aires, Argentina', 41590, 624, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(36, 10, 14, 20, 4, -34.7028734, -58.315991, -34.6600733, -58.3685215, 'Av. las Flores 115, B1834ETK Temperley, Buenos Aires, Argentina', 'Av. Bartolomé Mitre 401, Avellaneda, Buenos Aires, Argentina', 7361, 110, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(37, 10, 12, 25, 8, -34.6747324, -58.6254466, -32.9178259, -60.7393517, 'Lanús 2805, B1708HGU Morón, Buenos Aires, Argentina', 'José Ingenieros 8200, S2006DGP Rosario, Santa Fe, Argentina', 314914, 4724, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

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
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`id_encuesta`),
  ADD KEY `id_viaje` (`id_viaje`,`id_chofer`,`id_vehiculo`);

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
  ADD KEY `id_chofer` (`id_vehiculo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `choferes`
--
ALTER TABLE `choferes`
  MODIFY `id_chofer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `encargados`
--
ALTER TABLE `encargados`
  MODIFY `id_encargado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `id_encuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id_viaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
-- Filtros para la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD CONSTRAINT `encuestas_ibfk_1` FOREIGN KEY (`id_viaje`) REFERENCES `viajes` (`id_viaje`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
