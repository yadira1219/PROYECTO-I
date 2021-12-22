-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3360
-- Tiempo de generación: 22-12-2021 a las 18:18:33
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestortareas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `contenido` varchar(100) NOT NULL,
  `fechaRegistro` date NOT NULL,
  `fechaVencimiento` date NOT NULL,
  `prioridad` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `titulo`, `contenido`, `fechaRegistro`, `fechaVencimiento`, `prioridad`, `username`) VALUES
(0, 'ccc', '                ssssssssssss\r\neditado', '2021-12-13', '2021-12-23', 'Alta', 'Yadira'),
(7, 'ultimos', '            ultimos retoques :)', '2021-12-21', '2021-12-22', 'Baja', 'Yadira'),
(23, 'tarea', '           hhhhh nnnn', '2021-12-13', '2021-12-22', 'Media', 'Yadira'),
(66, 'rrr', '                        wwwwwwww', '2021-12-13', '2021-12-15', 'Baja', 'Yadira');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `apellido`, `username`, `contraseña`) VALUES
('Yadira', 'Alarcon', 'Yadira', '$2y$10$xEcngh6rv4XvOydpwxUZHeDNR5gCw95/XaN.RHKHAi1'),
('Yuri', 'ortiz', 'yuri', '$2y$10$kIN1RMTH4xAUNRvD0W7wUuME9o1BvmBNpzfoSA8grDe');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
