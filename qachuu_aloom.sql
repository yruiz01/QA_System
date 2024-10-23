-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2024 a las 00:45:45
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
-- Base de datos: `qachuu_aloom`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `id_actividad` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_limite` date DEFAULT NULL,
  `block_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `alumn_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id_actividad`, `nombre`, `descripcion`, `fecha_limite`, `block_id`, `is_active`, `fecha_creacion`, `alumn_id`, `team_id`) VALUES
(1, 'Actividad 1', 'Descripcion', '2024-10-09', 7, 1, '2024-09-28 02:39:12', NULL, NULL),
(2, 'SEMBRAR MAIZ', 'Sembrar en el huerto X de la granja X', NULL, 12, 1, '2024-09-28 03:10:27', NULL, NULL),
(3, 'SEMBRAR MAIZ 52', 'Esta actividad consiste en la distribución de semillas que serán sembradas por el beneficiario.', '2024-10-18', 13, 1, '2024-09-28 05:09:29', NULL, NULL),
(5, 'Terminar la siembre', 'Terminar la siembra pendiente de maiz', '2024-10-26', 13, 1, '2024-09-28 06:36:49', NULL, NULL),
(6, 'Cuerpo de Ingenieros del Ejercito', 'Descripciooooon de la actividad', NULL, 10, 1, '2024-09-28 07:20:27', NULL, NULL),
(7, 'actividad sembrar', 'Descripcion sembrar', NULL, 12, 1, '2024-09-28 10:11:50', NULL, NULL),
(8, 'TERMINAR SIEMBRA', 'Terminar siembra de maiz para mañana', NULL, 12, 1, '2024-09-28 10:37:24', NULL, NULL),
(9, 'Actividad recolectar granos', 'Se deben recolectar los granos para comenzar a sembrar', '2024-10-22', 13, 1, '2024-09-28 11:02:40', NULL, NULL),
(10, 'Proyecto 1', 'Descripcion', NULL, 10, 1, '2024-09-28 15:58:01', NULL, NULL),
(11, 'Prueba', '1234', NULL, 12, 1, '2024-09-28 16:06:32', NULL, NULL),
(12, 'PROYECTO 3', 'kiiimimi', '2024-09-30', 7, 1, '2024-09-28 17:05:34', NULL, NULL),
(13, 'COMUNIDAD2', 'kfkfkkf', NULL, 12, 1, '2024-09-28 17:08:04', NULL, NULL),
(14, 'ACTIVIDAD PARA SEMBRAR', 'Se sembrara en donde sea', '2024-11-01', 13, 1, '2024-10-01 18:34:47', NULL, NULL),
(15, 'Actividad de Prueba', 'Descripcion de Prueba', '2024-10-26', 13, 1, '2024-10-01 19:39:34', NULL, NULL),
(16, 'Actividades Siembra', 'Descripciion SIEMBRAA', NULL, 11, 1, '2024-10-01 19:42:54', NULL, NULL),
(17, 'Actividad de prueba 2', 'Descripcion de Prueba 2 editado', '2024-10-31', 13, 1, '2024-10-01 21:57:33', NULL, NULL),
(18, 'Actividad de Prueba 3 editada', 'Descripcion de Prueba 3', '2024-10-23', 13, 1, '2024-10-01 22:32:22', NULL, NULL),
(19, 'Siembra nueva variante', 'Esta actividad consiste en apoyar en la siembra de una nueva variante.', '2024-10-11', 13, 1, '2024-10-09 06:12:51', NULL, NULL),
(20, 'Actividad Prueba 333333333', 'Descripcion 3333333', '2024-10-01', 13, 1, '2024-10-09 06:23:28', NULL, NULL),
(21, 'Actividad de prueba 4444', 'Descripcion 4444', '2024-10-19', 13, 1, '2024-10-09 06:27:04', NULL, NULL),
(22, 'Actividad 55555', 'Descripcion 5556', '2024-10-10', 13, 1, '2024-10-09 06:28:23', NULL, NULL),
(23, 'Actividad 1', 'Actividad 1 proyecto 3', '2024-10-19', 9, 1, '2024-10-19 05:21:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_detalle`
--

CREATE TABLE `actividad_detalle` (
  `id_actividad` int(11) NOT NULL,
  `id_beneficiario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividad_detalle`
--

INSERT INTO `actividad_detalle` (`id_actividad`, `id_beneficiario`) VALUES
(22, 30),
(22, 36),
(22, 37),
(23, 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumn`
--

CREATE TABLE `alumn` (
  `id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(60) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `DPI` varchar(13) NOT NULL,
  `Ocupacion` varchar(255) NOT NULL,
  `Edad` int(11) NOT NULL,
  `Hijos` int(11) NOT NULL,
  `Genero` enum('Masculino','Femenino') NOT NULL,
  `Funcion` enum('Socio','Participante','Guia') NOT NULL,
  `c1_fullname` varchar(100) DEFAULT NULL,
  `c1_address` varchar(100) DEFAULT NULL,
  `c1_phone` varchar(100) DEFAULT NULL,
  `c1_note` varchar(100) DEFAULT NULL,
  `c2_fullname` varchar(100) DEFAULT NULL,
  `c2_address` varchar(100) DEFAULT NULL,
  `c2_phone` varchar(100) DEFAULT NULL,
  `c2_note` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `alumn`
--

INSERT INTO `alumn` (`id`, `image`, `name`, `lastname`, `email`, `address`, `phone`, `DPI`, `Ocupacion`, `Edad`, `Hijos`, `Genero`, `Funcion`, `c1_fullname`, `c1_address`, `c1_phone`, `c1_note`, `c2_fullname`, `c2_address`, `c2_phone`, `c2_note`, `is_active`, `created_at`, `user_id`) VALUES
(28, '1727236832.png', 'BENEFICIARIO 1', 'RUIZ', 'bhakti@bijli.com', 'DIAGONAL 4 6-46 ZONA 5', '0000 0000', '', '', 0, 0, 'Masculino', 'Socio', '', '', '', '', NULL, NULL, NULL, NULL, 1, NULL, 1),
(29, '1727304771.png', 'BENEFICIARIO 2', 'LEON', 'xyz@gmail.com', 'CALLE SECTOR EL CERRO', '0000 0000', '', '', 0, 0, 'Masculino', 'Socio', '', '', '', '', NULL, NULL, NULL, NULL, 1, NULL, 1),
(30, '1727328561.png', 'CAMILA CHANG', 'CASTILLO', 'camila@gmail.com', 'CALLE LOS ALPES 210', '0000 0000', '7845539393939', 'Niñera', 22, 8, 'Femenino', '', '', '', '', '', NULL, NULL, NULL, NULL, 1, NULL, 1),
(31, '1727328836.png', 'VICTORIA', 'RAXCACO', 'victoria@gmail.con', 'CALLE LOS ALPES 210', '78451236', '7845539393939', 'Ama de su mansion', 30, 13, 'Femenino', 'Socio', '', '', '', '', NULL, NULL, NULL, NULL, 1, NULL, 1),
(32, '1727329426.png', 'PROYECTO 1', 'RAXCACO', 'victoria@gmail.con', 'CALLE LOS ALPES 210', '78451236', '7845539393939', 'Ama de su mansion', 30, 13, '', 'Socio', '', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, 1),
(33, '1727329801.png', 'SOCIO 10', 'CASTILLO', 'xyz@gmail.com', 'CALLE LOS ALPES 210', '0000 0000', '1', '7845539393939', 0, 22, '', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, 1),
(34, '1727332599.png', 'NATALIO GERMAN', 'RAXCACO', 'xyz@gmail.com', 'CALLE LOS NARANJOS', '78451236', '1', '7845539393939', 0, 15, '', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, 1),
(35, '1727332967.png', 'JACOB', 'RAXCACO', 'minina12@gmail.com', 'AVENIDA 1 ZONA 2', '0000 0000', '1', '7845539393939', 0, 4, 'Femenino', 'Participante', '', '', '', '', NULL, NULL, NULL, NULL, 1, NULL, 1),
(36, '1727333685.png', 'PERLITA', 'CASTILLO', 'cosi@gmail.com', 'DIAGONAL 4 6-46 ZONA 5', '0000 0000', '1', '7845539393939', 0, 11, '', '', '', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, 1),
(37, '1727334670.png', 'TYSON', 'KEVIN', 'xyz@gmail.com', 'AVENIDA 1 ZONA 2', '0000 0000', '1', '7878787878787', 0, 1, 'Masculino', 'Guia', '', '', '', '', NULL, NULL, NULL, NULL, 1, NULL, 1),
(38, '1727335621.png', 'KARLA', 'CASTILLO', 'xyz@gmail.com', 'CALLE LOS ALPES 210', '9632144', '7845539393939', 'NINGUNA', 23, 1, 'Masculino', 'Participante', '', '', '', '', NULL, NULL, NULL, NULL, 1, NULL, 1),
(39, '1727369626.png', 'BENEFICIARIO 3', 'HERRERA', 'xyz@gmail.com', 'AVENIDA 1 ZONA 2', '0000 0000', '8888888888888', 'NINGUNA', 25, 3, 'Masculino', 'Participante', '', '', '', '', NULL, NULL, NULL, NULL, 1, NULL, 1),
(40, '1727499170.png', 'KEVIN EMMAUEL', 'CARRERA', 'kgarcia24@miumg.edu.gt', 'SAN JERONIMO', '57016644', '1234567891231', 'Estudiante', 28, 0, 'Masculino', 'Socio', '', '', '', '', NULL, NULL, NULL, NULL, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumn_team`
--

CREATE TABLE `alumn_team` (
  `id` int(11) NOT NULL,
  `alumn_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `alumn_team`
--

INSERT INTO `alumn_team` (`id`, `alumn_id`, `team_id`) VALUES
(17, 28, 10),
(18, 29, 10),
(19, 30, 1),
(20, 31, 1),
(21, 32, 1),
(22, 33, 1),
(23, 34, 1),
(24, 35, 1),
(25, 36, 1),
(26, 37, 1),
(27, 38, 1),
(28, 39, 5),
(29, 40, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assistance`
--

CREATE TABLE `assistance` (
  `id` int(11) NOT NULL,
  `kind_id` int(11) DEFAULT NULL,
  `date_at` date NOT NULL,
  `alumn_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `assistance`
--

INSERT INTO `assistance` (`id`, `kind_id`, `date_at`, `alumn_id`, `team_id`) VALUES
(14, 2, '2024-09-26', 38, 1),
(15, 3, '2024-09-26', 30, 1),
(16, 1, '2024-09-26', 39, 5),
(17, 1, '2024-10-08', 38, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `behavior`
--

CREATE TABLE `behavior` (
  `id` int(11) NOT NULL,
  `kind_id` int(11) DEFAULT NULL,
  `date_at` date NOT NULL,
  `alumn_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `behavior`
--

INSERT INTO `behavior` (`id`, `kind_id`, `date_at`, `alumn_id`, `team_id`) VALUES
(4, 2, '2024-09-25', 29, 10),
(5, 2, '2024-09-25', 33, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `block`
--

CREATE TABLE `block` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `team_id` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `fecha_alerta` date DEFAULT NULL,
  `estado_alerta` varchar(50) DEFAULT 'Pendiente',
  `responsable` varchar(100) DEFAULT NULL,
  `contribucion_proyecto` varchar(255) DEFAULT NULL,
  `archivo_pdf` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `block`
--

INSERT INTO `block` (`id`, `name`, `team_id`, `descripcion`, `fecha_inicio`, `fecha_fin`, `fecha_alerta`, `estado_alerta`, `responsable`, `contribucion_proyecto`, `archivo_pdf`, `is_active`) VALUES
(7, 'PROYECTO EDITADO 14', 1, '', '2024-10-08', '2024-10-31', '2024-10-24', 'Pendiente', '', '', '1728453076.pdf', 1),
(8, 'PROYECTO 4444441', 5, NULL, NULL, NULL, NULL, 'Pendiente', NULL, NULL, NULL, 1),
(9, 'PROYECTO 3', 5, NULL, NULL, NULL, NULL, 'Pendiente', NULL, NULL, NULL, 1),
(10, 'PROYECTO 2', 1, 'DESCRIPCIOOOOON', '2024-09-03', '2024-09-26', '2024-09-25', 'Pendiente', 'VICTORIA', 'HOLA', '1727370677.pdf', 1),
(11, 'SIEMBRA', 1, 'DESCRIPCIOOOOON 3', '2024-09-04', '2024-09-26', '2024-09-25', 'Pendiente', 'VICTORIA', 'HOLA', '1727363436.pdf', 1),
(12, 'SIEMBRA DE MAIZ', 1, 'DESCRIPCIOOOOON 5', '2024-09-11', '2024-09-26', '2024-09-25', 'Pendiente', 'VICTORIA', 'HOLA', '1727368819.pdf', 1),
(13, 'PROYECTO MAICITO', 1, '', '2024-09-27', '2024-10-27', '2024-10-20', 'Pendiente', 'VICTORIA', 'Distribución de las semillas de maiz', '', 1),
(14, 'PROYECTO 1', 12, 'Siembra de maíz', '2024-10-01', '2024-10-31', '2024-10-24', 'Pendiente', 'VICTORIA', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calification`
--

CREATE TABLE `calification` (
  `id` int(11) NOT NULL,
  `val` double DEFAULT NULL,
  `alumn_id` int(11) NOT NULL,
  `block_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `calification`
--

INSERT INTO `calification` (`id`, `val`, `alumn_id`, `block_id`) VALUES
(11, 1, 38, 12),
(12, 1, 38, 7),
(13, 1, 38, 13),
(14, 1, 37, 13),
(15, 1, 30, 13),
(16, 1, 30, 7),
(18, 1, 39, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`) VALUES
(1, 'Escritorio'),
(2, 'Grupos'),
(3, 'Acceso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `idproyecto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `archivo_pdf` varchar(255) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`idproyecto`, `nombre`, `descripcion`, `fecha_inicio`, `fecha_fin`, `archivo_pdf`, `creado_en`, `estado`) VALUES
(1, 'Proyecto 1', 'Descripcion 1', '2024-09-10', '2024-09-28', '1727232163.pdf', '2024-09-25 02:42:43', 1),
(2, 'Proyecto 1', 'pppppppppppppp', '2024-09-10', '2024-09-24', '1727235609.pdf', '2024-09-25 03:40:09', 1),
(3, 'Proyecto 1', 'llllllll', '2024-09-03', '2024-09-27', '1727236121.pdf', '2024-09-25 03:48:40', 1),
(4, 'Proyecto 1', 'llklklkllklkl', '2024-09-11', '2024-09-24', '1727237037.pdf', '2024-09-25 04:03:57', 1),
(5, 'Proyecto 1', 'dddddddddddd', '2024-09-11', '2024-09-03', '1727243360.pdf', '2024-09-25 05:49:19', 1),
(6, 'Proyecto', 'yyyyyyyyyyyyyy', '2024-09-17', '2024-09-27', '1727243441.pdf', '2024-09-25 05:50:41', 1),
(7, 'Proyecto 78', 'kkjkhkjkgkgjkgkj', '2024-09-01', '2024-09-27', '1727246826.pdf', '2024-09-25 06:47:06', 1),
(8, 'proyecto 79', 'PROYECTO 799999', '2024-09-11', '2024-09-25', '1727249610.pdf', '2024-09-25 07:33:30', 1),
(9, 'PROYECTO 10000', 'DESCRIPCION 1000000000', '2024-09-05', '2024-09-19', '1727272265.pdf', '2024-09-25 13:51:05', 1),
(10, 'PROYECTOOOO LLLLLLLLLLLLLLLLL', 'DESCRICIOOOOON', '2024-09-04', '2024-09-19', '1727298447.pdf', '2024-09-25 21:07:26', 1),
(11, 'Proyecto EDITADO', 'PRUEBA EDICION DE PROYECTO', '2024-09-03', '2024-09-26', '1727308785.pdf', '2024-09-25 23:59:44', 1),
(12, 'Proyecto editado2', 'EDITADO 2', '2024-09-11', '2024-09-26', '1727311051.pdf', '2024-09-26 00:37:30', 1),
(13, 'Proyecto editado3', 'EDITADO 33333', '2024-09-11', '2024-09-26', '1727316998.pdf', '2024-09-26 02:16:38', 1),
(14, 'Proyecto editado3', 'EDITADO 33334', '2024-09-11', '2024-09-26', '1727317025.pdf', '2024-09-26 02:17:04', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `team`
--

CREATE TABLE `team` (
  `idgrupo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `favorito` tinyint(1) NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `team`
--

INSERT INTO `team` (`idgrupo`, `nombre`, `favorito`, `idusuario`) VALUES
(1, 'ALDEA 7', 1, 1),
(2, 'ALDEA 6', 1, 1),
(3, 'ALDEA 5', 1, 1),
(4, 'ALDEA 4', 1, 1),
(5, 'ALDEA 3', 1, 1),
(6, 'ALDEA 2', 1, 1),
(10, 'ALDEA 1', 0, 1),
(11, 'GRUPO PRUEBA', 0, 3),
(12, 'PROYECTO 1', 0, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cargo` varchar(20) DEFAULT NULL,
  `login` varchar(20) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `condicion` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `cargo`, `login`, `clave`, `imagen`, `condicion`) VALUES
(1, 'demo', 'DNI', '72154871', 'Calle los alpes 210', '547821', 'admin@gmail.com', 'Administrador', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '1535417472.jpg', 1),
(3, 'Javi', 'DNI', '72154871', 'SAN JERONIMO', '00000000', 'xyz@gmail.com', 'Administrador', 'javi', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '1728441533.png', 1),
(4, 'Kevin', 'DNI', '72154871', 'CALLE LOS ALPES 210', '0000 0000', 'xyz@gmail.com', 'Administrador', 'kevin', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '1728448996.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`idusuario_permiso`, `idusuario`, `idpermiso`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(20, 3, 1),
(21, 3, 2),
(22, 3, 3),
(34, 4, 1),
(35, 4, 2),
(36, 4, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id_actividad`),
  ADD KEY `block_id` (`block_id`);

--
-- Indices de la tabla `actividad_detalle`
--
ALTER TABLE `actividad_detalle`
  ADD PRIMARY KEY (`id_actividad`,`id_beneficiario`),
  ADD KEY `id_beneficiario` (`id_beneficiario`);

--
-- Indices de la tabla `alumn`
--
ALTER TABLE `alumn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indices de la tabla `alumn_team`
--
ALTER TABLE `alumn_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumn_id` (`alumn_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indices de la tabla `assistance`
--
ALTER TABLE `assistance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumn_id` (`alumn_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indices de la tabla `behavior`
--
ALTER TABLE `behavior`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumn_id` (`alumn_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indices de la tabla `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indices de la tabla `calification`
--
ALTER TABLE `calification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumn_id` (`alumn_id`),
  ADD KEY `block_id` (`block_id`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`idproyecto`);

--
-- Indices de la tabla `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`idgrupo`),
  ADD KEY `team_ibfk_1` (`idusuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`idusuario_permiso`),
  ADD KEY `fk_u_permiso_usuario_idx` (`idusuario`),
  ADD KEY `fk_usuario_permiso_idx` (`idpermiso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `alumn`
--
ALTER TABLE `alumn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `alumn_team`
--
ALTER TABLE `alumn_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `assistance`
--
ALTER TABLE `assistance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `behavior`
--
ALTER TABLE `behavior`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `block`
--
ALTER TABLE `block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `calification`
--
ALTER TABLE `calification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `idproyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `team`
--
ALTER TABLE `team`
  MODIFY `idgrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `actividad_ibfk_1` FOREIGN KEY (`block_id`) REFERENCES `block` (`id`);

--
-- Filtros para la tabla `actividad_detalle`
--
ALTER TABLE `actividad_detalle`
  ADD CONSTRAINT `actividad_detalle_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`),
  ADD CONSTRAINT `actividad_detalle_ibfk_2` FOREIGN KEY (`id_beneficiario`) REFERENCES `alumn` (`id`);

--
-- Filtros para la tabla `alumn`
--
ALTER TABLE `alumn`
  ADD CONSTRAINT `alumn_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `alumn_team`
--
ALTER TABLE `alumn_team`
  ADD CONSTRAINT `alumn_team_ibfk_1` FOREIGN KEY (`alumn_id`) REFERENCES `alumn` (`id`),
  ADD CONSTRAINT `alumn_team_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`idgrupo`);

--
-- Filtros para la tabla `assistance`
--
ALTER TABLE `assistance`
  ADD CONSTRAINT `assistance_ibfk_1` FOREIGN KEY (`alumn_id`) REFERENCES `alumn` (`id`),
  ADD CONSTRAINT `assistance_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`idgrupo`);

--
-- Filtros para la tabla `behavior`
--
ALTER TABLE `behavior`
  ADD CONSTRAINT `behavior_ibfk_1` FOREIGN KEY (`alumn_id`) REFERENCES `alumn` (`id`),
  ADD CONSTRAINT `behavior_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`idgrupo`);

--
-- Filtros para la tabla `block`
--
ALTER TABLE `block`
  ADD CONSTRAINT `block_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `team` (`idgrupo`);

--
-- Filtros para la tabla `calification`
--
ALTER TABLE `calification`
  ADD CONSTRAINT `calification_ibfk_1` FOREIGN KEY (`alumn_id`) REFERENCES `alumn` (`id`),
  ADD CONSTRAINT `calification_ibfk_2` FOREIGN KEY (`block_id`) REFERENCES `block` (`id`);

--
-- Filtros para la tabla `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `fk_u_permiso_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_permiso` FOREIGN KEY (`idpermiso`) REFERENCES `permiso` (`idpermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
