-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2022 a las 19:02:27
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `consejo_escolar_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuelas`
--

CREATE TABLE `escuelas` (
  `nombre` varchar(255) NOT NULL,
  `dirección` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `responsable` varchar(255) NOT NULL,
  `id` int(255) NOT NULL,
  `tel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `escuelas`
--

INSERT INTO `escuelas` (`nombre`, `dirección`, `email`, `responsable`, `id`, `tel`) VALUES
('E.E.S.T.Nº4', 'C. 111 1890, B1884 Berazategui, Provincia de Buenos Aires', 'tecnica4begui@gmail.com', 'Ricardo Alberto', 7, ' 011 4261-4796');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_pedidos`
--

CREATE TABLE `imagenes_pedidos` (
  `id` int(11) NOT NULL,
  `titulo` int(11) NOT NULL,
  `imagenes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `Empresa` varchar(255) NOT NULL,
  `Tel` varchar(255) NOT NULL,
  `Rubro` varchar(255) NOT NULL,
  `Detalle` text NOT NULL,
  `Fecha_de_pedido` date NOT NULL,
  `Fecha_de_realizacion` date NOT NULL,
  `Escuela` varchar(255) NOT NULL,
  `imagenes` blob DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`Empresa`, `Tel`, `Rubro`, `Detalle`, `Fecha_de_pedido`, `Fecha_de_realizacion`, `Escuela`, `imagenes`, `id`) VALUES
('Pedro e hijos', '1131498030', '$12.000', 'Reparación de baños', '2022-10-06', '2022-10-07', 'E.E.S.T.Nº4', NULL, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `telefono` varchar(55) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user`, `pass`, `telefono`, `correo`, `id`) VALUES
('admin', '$2y$10$M.SLi0Nh02lECF2emDbUyO8G1GxFmeyEzKITcuEfzYF4jHRXYufeq', '11423567687', 'admin@gmail.com', 11),
('marcos', '$2y$10$OURRUKnBHg0pOwY4aRjT9.tX6Lsb/4sGbe2oNCaQG49kzug94oOB.', '1131498030', 'marcos@gmail.com', 12);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `escuelas`
--
ALTER TABLE `escuelas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagenes_pedidos`
--
ALTER TABLE `imagenes_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `escuelas`
--
ALTER TABLE `escuelas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
