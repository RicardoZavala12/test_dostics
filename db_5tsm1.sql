-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 16-08-2023 a las 05:51:35
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_5tsm1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id_event` int(11) NOT NULL,
  `token` text DEFAULT NULL,
  `nombre_evento` text DEFAULT NULL,
  `fecha_hora_evento` datetime DEFAULT NULL,
  `activo` int(1) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id_event`, `token`, `nombre_evento`, `fecha_hora_evento`, `activo`, `fecha`) VALUES
(1, '02136b1e6920c743612de43698f63ff5', 'COCA COLA FLOW FEST', '2023-11-25 14:00:00', 1, '2023-08-08 01:41:03'),
(2, 'a0123f930b6a471356b499df8435a979', 'EDC', '2023-08-07 20:43:00', 1, '2023-08-08 01:43:06'),
(3, 'a0123f930b6a471356b499df8435a979', 'EDC', '2023-08-07 20:43:00', 1, '2023-08-08 01:43:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `token` text NOT NULL,
  `nombre` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `apellido` text NOT NULL,
  `curp` text NOT NULL,
  `peso` int(11) DEFAULT NULL,
  `peso_ideal` float DEFAULT NULL,
  `nivel_peso` text DEFAULT NULL,
  `imc` decimal(3,1) DEFAULT NULL,
  `altura` float DEFAULT NULL,
  `sexo` text NOT NULL,
  `zona` text NOT NULL,
  `edad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `token`, `nombre`, `email`, `password`, `fecha`, `apellido`, `curp`, `peso`, `peso_ideal`, `nivel_peso`, `imc`, `altura`, `sexo`, `zona`, `edad`) VALUES
(45, '664d35e299146697e002e5e252d45091', 'Ricardo Daniel', 'rickyesc1202011@gmail.com', '$2a$07$MarteJupiterDatosSabaO7miKhb0nLFZye0edcO1pDvqCGOCcyjy', '2023-08-13 23:57:05', 'Flores Zavala', 'FOZR120212HDFLVCA0', 25, 47.558, 'BAJO PESO', '11.4', 148, 'MASCULINO', 'CENTRO', 11),
(47, '43f03c91a0fdd1d47c73b6172e9f13ce', 'Ricardo Daniel', 'ddd@gmail.com', '$2a$07$MarteJupiterDatosSabaO7miKhb0nLFZye0edcO1pDvqCGOCcyjy', '2023-08-16 03:12:25', 'Flores Zavala', 'FGGR911212HDFLVCE2', 100, 60.266, 'OBECIDAD', '30.9', 180, 'FEMENINO', 'SUR', 31),
(48, '9a28603ee220e256652df4b909a0d5d3', 'Ricardo Daniel', 'qqq@gmail.com', '$2a$07$MarteJupiterDatosSabaO7miKhb0nLFZye0edcO1pDvqCGOCcyjy', '2023-08-16 03:14:05', 'Flores Zavala', 'FOZR120212HDFLVCA0', 65, 43.118, 'OBECIDAD', '33.2', 140, 'MASCULINO', 'NORTE', 11),
(50, '6844bffc7a117bffd08322e82fe8665d', 'Ricardo Daniel', 'rickyedxc1202011@gmail.com', '$2a$07$MarteJupiterDatosSabaO7miKhb0nLFZye0edcO1pDvqCGOCcyjy', '2023-08-16 03:15:59', 'Flores Zavala', 'FOZR950212HDFLVCA0', 80, 58.658, 'SOBREPESO', '28.3', 168, 'MASCULINO', 'SUR', 28),
(51, '09316e6c24c6e5fe16ad42fce8e43c56', 'Ricardo Daniel', 'llll@gmail.com', '$2a$07$MarteJupiterDatosSabaOXr7VYHCssPd0EHPipNtUH31CzRtLLAW', '2023-08-16 03:17:48', 'Flores Zavala', 'FOZR120212HDFLVCA0', 45, 45.893, 'PESO NORMAL', '21.4', 145, 'MASCULINO', 'CENTRO', 11),
(53, '081c31ddf161400f1ef5b2510a5160a7', 'Ricardo Daniel', 'dddd@gmail.com', '$2a$07$MarteJupiterDatosSabaOXr7VYHCssPd0EHPipNtUH31CzRtLLAW', '2023-08-16 03:22:04', 'Flores Zavala', 'FOZR120212HDFLVCA0', 56, 54.916, 'PESO NORMAL', '19.4', 170, 'FEMENINO', 'NORTE', 11),
(54, '029cc6567cebc6eee9bddbd8afe2f174', 'Ricardo Daniel', 'nbnbnbnbn@gmail.com', '$2a$07$MarteJupiterDatosSabaOXr7VYHCssPd0EHPipNtUH31CzRtLLAW', '2023-08-16 03:22:38', 'Flores Zavala', 'FOZR960212HDFLVCA0', 45, 51.706, 'BAJO PESO', '16.7', 164, 'FEMENINO', 'CENTRO', 27),
(55, '15c6bdab195c15a584f12bfc7cef53dd', 'Ricardo Daniel', 'ssse@gmail.com', '$2a$07$MarteJupiterDatosSabaOXr7VYHCssPd0EHPipNtUH31CzRtLLAW', '2023-08-16 03:24:05', 'Flores Zavala', 'FOZR050212HDFLVCA0', 180, 9.818, 'OBECIDAD', '99.9', 80, 'MASCULINO', 'CENTRO', 18),
(57, '9fbe8a067afe01a10f565439e61e5aa7', 'Ricardo Daniel', 'qafvnf@gmail.com', '$2a$07$MarteJupiterDatosSabaOXr7VYHCssPd0EHPipNtUH31CzRtLLAW', '2023-08-16 03:25:25', 'Flores Zavala', 'FGGR541212HDFLVCE2', 65, 48.668, 'SOBREPESO', '28.9', 150, 'MASCULINO', 'CENTRO', 68),
(59, '76ecd7f79a68b04cfb0f285837ff129a', 'Ricardo Daniel', 'bb@gmail.com', '$2a$07$MarteJupiterDatosSabaO7miKhb0nLFZye0edcO1pDvqCGOCcyjy', '2023-08-16 03:33:38', 'Flores Zavala', 'FOZR020212HDFLVCA0', 56, 51.998, 'PESO NORMAL', '23.0', 156, 'MASCULINO', 'NORTE', 21),
(60, 'ee706a580f6a05eb364a4b5375191f53', 'Ricardo Daniel', 'lolo@gmail.com', '$2a$07$MarteJupiterDatosSabaO7miKhb0nLFZye0edcO1pDvqCGOCcyjy', '2023-08-16 03:36:49', 'Flores Zavala', 'FOZR950212HDFLVCA0', 100, 59.196, 'OBECIDAD', '31.6', 178, 'FEMENINO', 'NORTE', 28);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_event`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
