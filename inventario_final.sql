-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-07-2023 a las 20:59:53
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
-- Base de datos: `id20920991_mechanicsystem`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `nombre_cargo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `nombre_cargo`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`, `fecha`) VALUES
(1, 'Carcasas', '2023-05-23 00:39:46'),
(2, 'Audifonos', '2023-05-23 01:11:56'),
(3, 'Componentes PC', '2023-05-25 07:45:51'),
(4, 'Televisores', '2023-05-26 08:20:54'),
(5, 'Protectores', '2023-05-26 08:25:33'),
(6, 'Pendrive', '2023-05-27 19:53:05'),
(8, 'Teclados', '2023-05-29 02:58:17'),
(10, 'Telefonos', '2023-05-29 03:03:31'),
(11, 'Mouse', '2023-06-16 03:25:43'),
(12, 'Impresoras', '2023-07-09 20:27:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detallev` int(11) NOT NULL,
  `id_venta` varchar(50) NOT NULL,
  `id_prod` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` double NOT NULL,
  `precio_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_detallev`, `id_venta`, `id_prod`, `cantidad`, `precio_unitario`, `precio_total`) VALUES
(1, 'FV01', 'C01', 2, 5, 10),
(2, 'FV01', 'PC01', 2, 600, 1200),
(3, 'FV02', 'C01', 4, 5, 20),
(4, 'FV02', 'PC01', 3, 600, 1800),
(5, 'FV03', 'C01', 1, 5, 5),
(6, 'FV03', 'PC01', 2, 600, 1200),
(7, 'FV04', 'C01', 1, 5, 5),
(8, 'FV04', 'PC01', 3, 600, 1800),
(9, 'RV01', 'C01', 1, 5, 5),
(10, 'RV01', 'C02', 2, 10, 20),
(11, 'RV01', 'PC01', 3, 600, 1800),
(14, 'FV05', 'C03', 2, 30, 60),
(15, 'FV05', 'C02', 1, 10, 10),
(16, 'FV06', 'C02', 1, 3, 3),
(17, 'FV06', 'PC01', 3, 600, 1800),
(18, 'FV06', 'C03', 5, 3, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_actividad`
--

CREATE TABLE `historial_actividad` (
  `id_historial` int(11) NOT NULL,
  `id_prod` varchar(50) NOT NULL,
  `fecha_realizado` datetime NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_actividad`
--

INSERT INTO `historial_actividad` (`id_historial`, `id_prod`, `fecha_realizado`, `descripcion`) VALUES
(1, 'C01', '2023-06-08 19:18:56', 'Se creó el producto Carcasa de celular J1 con stock 10 por el usuario Franklin'),
(2, 'PC01', '2023-06-08 19:20:47', 'Se creó el producto Tarjeta Grafica Gtx1660 con stock 8 por el usuario Franklin'),
(3, 'FV01', '2023-06-08 21:24:43', 'El usuario con dni 72728052 hizo una venta de 1210 soles'),
(4, 'C02', '2023-06-08 22:09:10', 'Se creó el producto Carcasa de celular Y9 con stock 10 por el usuario Franklin'),
(5, 'FV02', '2023-06-14 11:50:26', 'El usuario con dni 72728052 hizo una venta de 1820 soles'),
(6, 'FV03', '2023-06-22 16:08:36', 'El usuario con dni 72728052 hizo una venta de 1205 soles'),
(7, 'PC01', '2023-06-23 23:30:18', 'Se actualizó el producto, su stock cambió de 1 a 10 por el usuario Franklin'),
(8, 'FV04', '2023-06-23 23:30:42', 'El usuario con dni 72728052 hizo una venta de 1805 soles'),
(9, 'C02', '2023-06-23 23:33:35', 'Se creó el producto Carcasa de celular J2 con stock 6 por el usuario Franklin'),
(10, 'C02', '2023-06-24 02:41:33', 'Se eliminó el producto por el usuario Franklin'),
(11, 'C02', '2023-06-24 02:41:55', 'Se creó el producto Carcasa de celular J2 con stock 2 por el usuario Franklin'),
(12, 'C02', '2023-06-24 02:42:51', 'Se actualizó el producto, su stock cambió de 2 a 5 por el usuario Franklin'),
(13, 'RV01', '2023-06-24 02:43:18', 'El usuario con dni 72728054 hizo una venta de 1825 soles'),
(14, 'C03', '2023-07-07 12:41:25', 'Se creó el producto Carcasa de Celular Y9 con stock 3 por el usuario Franklin'),
(15, 'C03', '2023-07-07 12:41:57', 'Se actualizó el producto, su stock cambió de 10 a 10 por el usuario Franklin'),
(16, 'C03', '2023-07-07 12:45:09', 'Se actualizó el producto, su stock cambió de 10 a 10 por el usuario Franklin'),
(17, 'FV05', '2023-07-07 16:10:29', 'El usuario con dni 72728052 hizo una venta de 65 soles'),
(18, 'FV05', '2023-07-07 16:13:40', 'El usuario con dni 72728052 hizo una venta de 70 soles'),
(19, 'FV06', '2023-07-07 23:11:06', 'El usuario con dni 72728052 hizo una venta de 1818 soles'),
(20, 'C02', '2023-07-09 13:31:54', 'Se actualizó el producto, su stock cambió de 1 a 1 por el usuario Franklin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_prod` varchar(4) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` double NOT NULL,
  `precio_pub` double NOT NULL,
  `precio_o` double NOT NULL,
  `precio_m` double NOT NULL,
  `stock` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `fecha_creado` datetime DEFAULT NULL,
  `fecha_actualizado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_prod`, `nombre`, `precio`, `precio_pub`, `precio_o`, `precio_m`, `stock`, `id_categoria`, `fecha_creado`, `fecha_actualizado`) VALUES
('C01', 'Carcasa de celular J1', 5, 10, 3, 4, 1, 1, '2023-07-07 12:37:49', '2023-07-09 13:38:47'),
('C02', 'Carcasa de celular J2', 10, 3, 2, 3, 1, 1, NULL, '2023-07-09 13:35:19'),
('C03', 'Carcasa de Celular Y9', 20, 30, 3, 1, 3, 1, '2023-07-07 12:41:25', '2023-07-07 12:45:09'),
('PC01', 'Tarjeta Grafica Gtx1660', 600, 200, 0, 0, 1, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `dni` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `fecha_actualizado` datetime NOT NULL,
  `id_cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `nombre`, `apellido`, `contrasena`, `usuario`, `fecha_creado`, `fecha_actualizado`, `id_cargo`) VALUES
(72728052, 'Franklin', 'Castro', 'mecanico27', 'JahirRc', '2023-05-20 20:28:25', '2023-07-05 01:17:53', 1),
(72728054, 'Renzo', 'Ruiz', 'thekillde2211', 'Thekillde1', '2023-05-21 00:11:43', '2023-05-29 02:54:03', 2),
(74836789, 'Victor', 'Ortiz', 'mecanico45', 'VictorRO', '2023-05-22 04:07:35', '2023-05-22 04:07:35', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` varchar(50) NOT NULL,
  `dni` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `dni`, `fecha`, `total`) VALUES
('FV01', 72728052, '2023-08-06 21:24:43', 1210),
('FV02', 72728052, '2023-06-14 11:50:26', 1820),
('FV03', 72728052, '2023-06-22 16:08:36', 1205),
('FV04', 72728052, '2023-06-23 23:30:42', 1805),
('FV05', 72728052, '2023-07-07 16:13:40', 70),
('FV06', 72728052, '2023-07-07 23:11:06', 1818),
('RV01', 72728054, '2023-06-24 02:43:18', 1825);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detallev`),
  ADD KEY `detalle_venta_ibfk_1` (`id_venta`),
  ADD KEY `detalle_venta_ibfk_2` (`id_prod`);

--
-- Indices de la tabla `historial_actividad`
--
ALTER TABLE `historial_actividad`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `historial_actividad_ibfk_1` (`id_prod`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_prod`),
  ADD KEY `fk_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `dni` (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detallev` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `historial_actividad`
--
ALTER TABLE `historial_actividad`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `dni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74836790;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`id_prod`) REFERENCES `producto` (`id_prod`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_cargo`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `usuarios` (`dni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
