-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: fdb1032.awardspace.net
-- Tiempo de generación: 08-05-2026 a las 16:12:46
-- Versión del servidor: 8.0.32
-- Versión de PHP: 8.1.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `4741371_bdestacionamiento`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`) VALUES
(1, 'Karom', '123@alumnos.uacj.mx', '$2y$12$ZpPcYsQ3tunF/TT4dQRNLuGdGUoqMI5XApBmFV1INf1.1GYzjaRdm'),
(2, 'micho', 'micho@alumnos.uacj.mx', '$2y$12$VMnItXwQTFFpFc75o68BP.9ZVyYCS.wUOTSui6klve6AbhmVyP/v.'),
(3, 'sancho pansa', '234@alumnos.uacj.mx', '$2y$12$F0IkMGqjZ6z9tnVs/qVVS.5aUNM4zG2rczC2FS2Y87l9KCjSTpjI.'),
(4, 'Quackyti ', 'al27362@alumnos.uacj.mx', '$2y$12$3pzhZ0ccETutxgrazGJ2l.yFMtkRL3k/.7GMt/k7qkyqs6QrEdtFS'),
(5, 'Aprendiz', 'zef.romero@alumnos.uacj.mx', '$2y$12$BPQtNPkgXrPfSBUYctSwxOyMHAOR/YCARx8XhnOHYfZYfT/8jU4YS'),
(6, 'Visitante', 'visitante@alumnos.uacj.mx', '$2y$12$9ZIYZyrqn/l3gXt2Md0OLeahT5CKQMUcG5b9cSHshrbwJZYCbqcLC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
