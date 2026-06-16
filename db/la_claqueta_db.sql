-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2026 a las 22:03:00
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `la_claqueta_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(225) NOT NULL,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `descripcion`, `imagen`) VALUES
(1, 'Terror / Suspenso', 'Películas que juegan con el miedo, la tensión psicológica y el suspenso absoluto.', 'https://images.unsplash.com/photo-1505635330300-301545f26ed1?q=80&w=640&auto=format&fit=crop'),
(2, 'Ciencia Ficción', 'Viajes en el tiempo, futuros distópicos y tecnología avanzada que desafía la realidad.', 'https://images.unsplash.com/photo-1478760329108-5c3ed9d495a0?q=80&w=640&auto=format&fit=crop'),
(3, 'Drama', 'Historias profundas basadas en los conflictos humanos, las emociones y el desarrollo de personajes.', 'https://images.unsplash.com/photo-1518173946687-a4c8a383392e?q=80&w=640&auto=format&fit=crop');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

CREATE TABLE `pelicula` (
  `id_pelicula` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `director` varchar(100) NOT NULL,
  `estreno` varchar(12) NOT NULL,
  `imagen` varchar(225) NOT NULL,
  `resenia` text NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pelicula`
--

INSERT INTO `pelicula` (`id_pelicula`, `titulo`, `director`, `estreno`, `imagen`, `resenia`, `id_categoria`) VALUES
(1, 'El Silencio de los Inocentes', 'Jonathan Demme', '1991', 'https://megustaelcine.com/wp-content/uploads/2022/09/POSTER-Silencio-de-los-inocentes-683x1024.jpeg', 'Una joven agente del FBI busca la ayuda de un brillante asesino en serie encarcelado, el Dr. Hannibal Lecter, para atrapar a otro asesino que anda suelto. Un clásico del suspenso psicológico que marcó un antes y un después en el cine.', 1),
(2, 'Interstellar', 'Christopher Nolan', '2014', 'https://images.unsplash.com/photo-1462331940025-496dfbfc7564?q=80&w=640&auto=format&fit=crop', 'Un grupo de científicos y exploradores se embarcan en una misión espacial desesperada a través de un agujero de gusano. Su objetivo es encontrar un nuevo hogar para la humanidad antes de que la Tierra colapse por completo. Una obra maestra visual y emocional sobre el tiempo y el amor filial.', 2),
(3, 'El Club de la Pelea', 'David Fincher', '1999', 'https://images.unsplash.com/photo-1536440136628-849c177e76a1?q=80&w=640&auto=format&fit=crop', 'Un oficinista insomne y aburrido de su vida consumista conoce a Tyler Durden, un carismático vendedor de jabones con una filosofía de vida muy particular. Juntos fundan un club de lucha clandestino que pronto se convierte en una peligrosa organización antisistema.', 3),
(4, 'The Matrix', 'Lana y Lilly Wachowski', '1999', 'https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=640&auto=format&fit=crop', 'Un programador de computación descubre que la realidad en la que vive es una simulación interactiva creada por máquinas inteligentes para esclavizar a la humanidad. Junto a un grupo de rebeldes, deberá luchar para liberar las mentes de las personas.', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `contrasenia`, `nombre`) VALUES
(1, 'admin', '$argon2id$v=19$m=65536,t=4,p=1$TjNSQmE1ZVVxU0dBSjZ5aA$iUbwim3pBtHalO0wCeFS0nfqsQf4a6cBDZSAdl6c6ns', 'Santino');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`id_pelicula`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  MODIFY `id_pelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD CONSTRAINT `id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
