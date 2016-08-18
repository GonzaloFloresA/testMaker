-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-08-2016 a las 13:07:30
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `testmaker`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `careers`
--

CREATE TABLE `careers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `abbr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `careers`
--

INSERT INTO `careers` (`id`, `name`, `abbr`, `created_at`, `updated_at`) VALUES
(1, 'Ingenieria Electronica', 'etn', '2016-06-19 07:08:10', '2016-06-19 07:08:10'),
(2, 'Ingenieria Informatica', 'inf', '2016-06-19 07:13:44', '2016-06-19 07:13:44'),
(3, 'Ingenieria de Sistemas', 'sis', '2016-06-19 07:15:21', '2016-06-19 07:15:21'),
(4, 'Ingenieria Electrica', 'elt', '2016-06-19 07:16:26', '2016-06-19 07:16:26'),
(5, 'Ingenieria Mecanica', 'mec', '2016-06-19 07:17:34', '2016-06-19 07:55:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `complementquestions`
--

CREATE TABLE `complementquestions` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(11) NOT NULL,
  `solution` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `complementquestions`
--

INSERT INTO `complementquestions` (`id`, `question_id`, `solution`, `created_at`, `updated_at`) VALUES
(2, 26, '["uno","one","eins"]', '2016-08-05 13:09:20', '2016-08-05 13:09:20'),
(4, 26, '["dos","two","zwei"]', '2016-08-05 14:01:33', '2016-08-05 14:01:33'),
(20, 26, '["tres","three","drei"]', '2016-08-06 05:26:25', '2016-08-06 05:29:02'),
(25, 26, '["cuatro","four","vier"]', '2016-08-06 06:40:18', '2016-08-06 06:40:18'),
(26, 31, '["uno","dos","tres"]', '2016-08-11 19:43:07', '2016-08-11 19:43:07'),
(27, 31, '["cuatro","cinco"]', '2016-08-11 19:43:07', '2016-08-11 19:43:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `cod_sis` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `career_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`id`, `cod_sis`, `name`, `level`, `created_at`, `updated_at`, `career_id`) VALUES
(2, 2010048, 'Ingenieria de Software', 9, '2016-06-07 01:02:33', '2016-06-28 18:32:36', '3'),
(3, 2010047, 'Redes de Computadoras', 6, '2016-06-07 01:02:33', '2016-06-19 09:57:17', '2'),
(4, 2010049, 'Estructura y Semantica de Lenguajes de Programacion', 5, '2016-06-07 01:02:33', '2016-06-19 09:57:34', '2'),
(5, 2010053, 'Taller de Base de Datos', 7, '2016-06-07 01:02:33', '2016-06-19 10:05:15', '2'),
(6, 2010202, 'Inteligencia Artificial 2', 6, '2016-06-07 01:02:33', '2016-06-19 09:58:11', '2'),
(7, 2010203, 'Programacion Web', 7, '2016-06-07 01:02:33', '2016-06-19 09:58:34', '2'),
(9, 2010201, 'Calculo 2', 2, '2016-06-07 06:43:32', '2016-06-28 21:27:10', '4'),
(10, 2008121, 'Fisica 3', 3, '2016-06-07 06:44:34', '2016-06-19 09:55:59', '4'),
(11, 2001112, 'Teoria de Grafos', 4, '2016-06-10 03:04:27', '2016-06-19 09:59:23', '2'),
(12, 2011144, 'Taller de Programacion', 3, '2016-06-19 09:08:49', '2016-06-19 09:08:49', '2'),
(14, 2011333, 'Programacion Funcional', 4, '2016-06-19 10:30:40', '2016-06-20 12:06:19', '2'),
(15, 20100222, 'Calculo', 1, '2016-06-22 07:40:51', '2016-06-22 09:12:17', '1'),
(16, 20112344, 'Algebra', 1, '2016-06-22 07:40:51', '2016-06-22 07:40:51', '2'),
(17, 20443222, 'Fisica Elemental', 1, '2016-06-22 07:40:51', '2016-06-27 05:13:13', '3'),
(18, 20112223, 'Quimica', 1, '2016-06-22 07:40:51', '2016-06-22 07:40:51', '1'),
(19, 2011233, 'Ecuaciones Diferenciales', 3, '2016-06-22 07:40:51', '2016-06-22 07:40:51', '3'),
(20, 20112233, 'Estadistica I', 3, '2016-06-28 21:41:26', '2016-06-28 21:41:26', '3'),
(21, 2011011, 'ingenieria economica', 5, '2016-08-10 02:29:37', '2016-08-10 02:29:37', '3'),
(22, 2010101, 'civismo', 8, '2016-08-11 19:35:45', '2016-08-11 19:35:45', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluations`
--

CREATE TABLE `evaluations` (
  `id` int(10) UNSIGNED NOT NULL,
  `exam_id` int(11) NOT NULL,
  `pending` tinyint(1) NOT NULL,
  `intent` int(11) NOT NULL,
  `calification` int(11) NOT NULL,
  `token_access` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `content` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('partial','final') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `evaluations`
--

INSERT INTO `evaluations` (`id`, `exam_id`, `pending`, `intent`, `calification`, `token_access`, `start`, `end`, `content`, `type`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 1, 0, '12345', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'final', '2016-08-17 21:44:26', '2016-08-17 21:44:26'),
(2, 6, 0, 1, 0, '12345', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'final', '2016-08-17 21:44:42', '2016-08-17 21:44:42'),
(3, 5, 0, 1, 0, '12345', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'partial', '2016-08-17 21:44:53', '2016-08-17 21:44:53'),
(4, 4, 1, 1, 0, '12345', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'partial', '2016-08-17 21:45:33', '2016-08-17 21:45:33'),
(5, 3, 1, 1, 0, '12345', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'partial', '2016-08-17 21:45:39', '2016-08-17 21:45:39'),
(6, 17, 0, 1, 20, '34151009D94', '2016-08-18 09:22:12', '2016-08-18 09:22:19', '', 'partial', '2016-08-18 07:17:44', '2016-08-18 13:22:19'),
(18, 17, 0, 2, 80, '34151009D94', '2016-08-18 09:22:43', '2016-08-18 09:23:06', '', 'final', '2016-08-18 13:22:19', '2016-08-18 13:23:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluation_student`
--

CREATE TABLE `evaluation_student` (
  `id` int(10) UNSIGNED NOT NULL,
  `evaluation_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `evaluation_student`
--

INSERT INTO `evaluation_student` (`id`, `evaluation_id`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 1, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 6, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 7, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 8, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 9, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 10, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 11, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 12, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 13, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 14, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 15, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 16, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 17, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 18, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exams`
--

CREATE TABLE `exams` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `name_course` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `institution` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration` datetime NOT NULL,
  `time_start` datetime NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total` int(11) NOT NULL DEFAULT '100',
  `state` enum('edition','terminate','publicate') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'edition',
  `types` enum('online','presential') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'presential',
  `intents` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `exams`
--

INSERT INTO `exams` (`id`, `group_id`, `name_course`, `institution`, `duration`, `time_start`, `type`, `title`, `description`, `total`, `state`, `types`, `intents`, `created_at`, `updated_at`) VALUES
(1, 9, 'Programacion Funcional', 'Ingenieria Informatica', '2016-08-11 02:30:00', '2016-08-11 17:25:00', 'Examen de Repaso', 'Examen de Repaso', 'Descripción del examen de la tierra de dos estados', 100, 'terminate', 'presential', 0, '2016-07-22 15:55:45', '2016-08-03 21:50:35'),
(3, 9, 'Programación Funcional ', 'Ingeniería Informática', '2016-08-12 17:25:00', '2016-08-12 16:20:00', ' Examen parcial', ' Examen parcial', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse saepe ad praesentium, iusto, corporis alias temporibus laborum. Eligendi praesentium nemo perferendis, autem, inventore ipsa nobis sit error eos, tenetur, rem!', 44, 'publicate', 'online', 1, '2016-07-22 17:55:52', '2016-08-11 11:58:09'),
(5, 22, 'Programacion Web', 'Ingenieria Informatica', '2016-08-11 01:30:00', '2016-08-11 17:25:00', 'Examen Repaso', 'Examen Repaso', 'Examen para verificar el estado de conocimientos del alumno.', 100, 'publicate', 'online', 1, '2016-07-31 08:02:53', '2016-07-31 08:02:53'),
(6, 9, 'Programacion Funcional', 'Ingenieria Informatica', '2016-08-11 03:30:00', '2016-08-11 17:25:00', 'Examen de Mesa', 'Examen de Mesa', 'Examen para alumnos que desean rendir un examen extraordinario fsdfsdfdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd.', 100, 'terminate', 'online', 1, '2016-08-01 06:51:11', '2016-08-07 08:13:21'),
(12, 9, 'Programacion Funcional', 'Ingenieria Informatica', '2016-08-20 18:30:00', '2016-08-20 05:24:00', '', 'examen de segunda opcion', 'sdfdf dfsdf sdfsdfsdf sdfsfd', 44, 'edition', 'online', 1, '2016-08-11 09:34:06', '2016-08-12 06:35:04'),
(13, 25, 'civismo', 'Ingenieria Informatica', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'examen final', 'sdfsdfd sdfsdfsdf sdfsdfsdfsd', 0, 'terminate', 'presential', 0, '2016-08-11 19:47:38', '2016-08-11 19:57:28'),
(14, 25, 'civismo', 'Ingenieria Informatica', '2016-08-16 06:25:00', '2016-08-16 04:20:00', '', 'parcial ', 'dsdfsdf dfsdfsdfsdf', 70, 'edition', 'online', 0, '2016-08-11 19:57:11', '2016-08-11 19:57:11'),
(16, 9, 'Programacion Funcional', 'Ingenieria Informatica', '2016-08-13 17:25:00', '2016-08-13 16:20:00', '', 'Examen de Nivelacion', 'sdfsdf  sdfsdfsdf dsfdfsdf', 50, 'edition', 'online', 3, '2016-08-12 08:25:59', '2016-08-12 08:41:19'),
(17, 9, 'Programacion Funcional', 'Ingenieria Informatica', '2016-08-19 18:15:00', '2016-08-19 16:15:00', '', 'Examen general', 'Resuelva el examen de forma que obtenga al menos un puntaje de 80 puntos.', 70, 'publicate', 'online', 3, '2016-08-18 05:10:15', '2016-08-18 07:17:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exam_question`
--

CREATE TABLE `exam_question` (
  `id` int(10) UNSIGNED NOT NULL,
  `exam_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `percent` int(11) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `exam_question`
--

INSERT INTO `exam_question` (`id`, `exam_id`, `question_id`, `percent`, `order`) VALUES
(10, 3, 15, 11, 1),
(31, 3, 4, 11, 8),
(36, 3, 5, 11, 3),
(49, 3, 17, 12, 9),
(52, 3, 18, 11, 2),
(66, 1, 5, 33, 1),
(67, 1, 7, 34, 3),
(68, 1, 11, 22, 2),
(69, 5, 21, 20, 1),
(72, 3, 7, 10, 9),
(76, 3, 19, 11, 7),
(78, 6, 4, 100, 1),
(79, 3, 12, 11, 6),
(80, 3, 16, 11, 5),
(81, 3, 9, 11, 4),
(85, 13, 30, 0, 1),
(86, 13, 32, 100, 2),
(87, 13, 31, 0, 3),
(88, 12, 5, 25, 2),
(89, 12, 4, 25, 1),
(90, 12, 11, 25, 3),
(91, 12, 9, 25, 4),
(92, 17, 3, 20, 5),
(93, 17, 18, 20, 3),
(94, 17, 17, 30, 1),
(95, 17, 26, 10, 4),
(96, 17, 28, 20, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exam_student`
--

CREATE TABLE `exam_student` (
  `id` int(10) UNSIGNED NOT NULL,
  `pending` tinyint(1) NOT NULL,
  `intent` int(11) NOT NULL,
  `calification` int(11) NOT NULL,
  `token_access` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end` datetime NOT NULL,
  `content` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `exam_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `response_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `exam_student`
--

INSERT INTO `exam_student` (`id`, `pending`, `intent`, `calification`, `token_access`, `start`, `end`, `content`, `exam_id`, `student_id`, `response_id`, `created_at`, `updated_at`) VALUES
(4, 0, 0, 0, '', '2016-08-15 00:00:00', '2016-08-15 00:00:00', '', 3, 11, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `nro` int(10) UNSIGNED NOT NULL,
  `description` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `year` int(10) UNSIGNED NOT NULL,
  `semester` enum('1','2') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `course_id`, `teacher_id`, `nro`, `description`, `created_at`, `updated_at`, `year`, `semester`) VALUES
(1, 5, 2, 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2016, '1'),
(2, 5, 4, 2, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2016, '1'),
(3, 4, 4, 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2016, '1'),
(4, 3, 2, 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2016, '1'),
(5, 2, 1, 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2016, '1'),
(6, 2, 1, 2, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2016, '1'),
(7, 15, 2, 1, '', '2016-06-27 13:24:28', '2016-06-27 13:24:28', 0, '1'),
(9, 14, 1, 1, '<p>&nbsp;Las evaluaciones de la materia cosiste de:</p>\r\n<ul>\r\n<li>Primer Parcial: 30 pts.</li>\r\n<li>Segundo Parcial:30pts.</li>\r\n<li>Practicas: 40 pts</li>\r\n</ul>\r\n<p>Las fechas son la siguientes:&nbsp;</p>', '2016-06-27 13:28:16', '2016-08-18 14:29:46', 0, '1'),
(11, 19, 2, 1, '', '2016-06-27 18:21:38', '2016-06-27 18:21:38', 0, '1'),
(12, 11, 8, 1, '', '2016-06-27 20:02:47', '2016-06-27 20:02:47', 0, '1'),
(14, 12, 8, 1, '', '2016-06-28 07:59:26', '2016-06-28 07:59:26', 0, '1'),
(15, 12, 2, 2, '', '2016-06-28 07:59:41', '2016-06-28 07:59:41', 0, '1'),
(16, 12, 4, 3, '', '2016-06-28 18:34:25', '2016-06-28 18:34:25', 0, '1'),
(17, 20, 11, 1, '', '2016-06-28 21:41:58', '2016-06-28 21:41:58', 0, '1'),
(18, 17, 11, 1, '', '2016-06-28 21:42:18', '2016-06-28 21:42:18', 0, '1'),
(19, 9, 2, 1, '', '2016-07-19 17:20:58', '2016-07-19 17:20:58', 0, '1'),
(20, 19, 2, 2, '', '2016-07-19 17:20:58', '2016-07-19 17:20:58', 0, '1'),
(21, 5, 1, 3, '', '2016-07-21 06:52:06', '2016-07-21 06:52:06', 0, '1'),
(22, 7, 2, 1, '', '2016-07-31 07:52:58', '2016-07-31 07:52:58', 0, '1'),
(23, 7, 2, 2, '', '2016-07-31 07:57:47', '2016-07-31 07:57:47', 0, '1'),
(24, 6, 19, 1, '', '2016-08-11 19:34:17', '2016-08-11 19:34:17', 0, '1'),
(25, 22, 19, 1, '', '2016-08-11 19:36:17', '2016-08-11 19:36:17', 0, '1'),
(26, 22, 4, 2, '', '2016-08-11 19:36:31', '2016-08-11 19:36:31', 0, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_student`
--

CREATE TABLE `group_student` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `anio` int(10) UNSIGNED NOT NULL,
  `semester` enum('1','2') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `group_student`
--

INSERT INTO `group_student` (`id`, `group_id`, `student_id`, `anio`, `semester`, `created_at`, `updated_at`) VALUES
(2, 5, 3, 2016, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 22, 11, 2016, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 3, 2016, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 4, 2016, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 21, 2016, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 20, 3, 2016, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 2, 5, 2016, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 2, 11, 2016, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 2, 17, 2016, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 2, 18, 2016, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 5, 5, 2016, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 9, 11, 2016, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 2, 4, 2016, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 25, 5, 2016, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 25, 6, 2016, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 25, 16, 2016, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 25, 18, 2016, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 25, 3, 2016, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_06_03_080116_update_users_table', 2),
('2016_06_06_183514_create_courses_table', 3),
('2016_06_14_071645_create_teachers_table', 4),
('2016_06_14_071725_create_students_table', 4),
('2016_06_17_173420_create_course_teacher_table', 5),
('2016_06_19_011035_create_careers_table', 6),
('2016_06_19_012544_alter_courses_table', 7),
('2016_06_19_014325_alter_students_table', 7),
('2016_06_23_064222_create_exams_table', 8),
('2016_06_25_042513_create_groups_table', 9),
('2016_06_25_045234_create_group_teacher_table', 10),
('2016_06_25_051056_create_group_student_table', 11),
('2016_06_25_051844_delete_course_teacher_table', 12),
('2016_06_25_072125_alter_exam_table', 13),
('2016_06_27_051108_alter_groups_table', 14),
('2016_06_27_052330_alter_groups_table', 15),
('2016_06_27_053735_delete_group_teacher_table', 16),
('2016_07_20_004115_create_questions_table', 17),
('2016_07_20_005703_create_MultipleQuestions_table', 17),
('2016_07_20_010041_create_Options_table', 17),
('2016_07_21_034157_alter_exams_table', 18),
('2016_07_22_034633_alter_exams_table', 19),
('2016_07_26_151705_create_exam_question_table', 20),
('2016_08_04_194640_alter_questions_table', 21),
('2016_08_04_233756_alter_questions_table', 22),
('2016_08_05_002420_create_ComplementQuestion_table', 23),
('2016_08_09_001153_create_exam_student_table', 24),
('2016_08_10_061442_alter_exams_table', 25),
('2016_08_12_022712_alter_exam_table', 26),
('2016_08_15_043141_alter_exam_student_table', 27),
('2016_08_16_044110_create_table_evaluation', 28),
('2016_08_17_101635_create_evaluation_student_table', 29),
('2016_08_18_082815_alter_evaluations_table', 30),
('2016_08_18_095822_alter_groups_table', 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multiplequestions`
--

CREATE TABLE `multiplequestions` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(11) NOT NULL,
  `solution` text COLLATE utf8_unicode_ci,
  `desc_solution` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `multiplequestions`
--

INSERT INTO `multiplequestions` (`id`, `question_id`, `solution`, `desc_solution`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, '2016-07-20 15:30:11', '2016-07-20 15:30:11'),
(3, 3, NULL, NULL, '2016-07-20 18:59:15', '2016-07-20 18:59:15'),
(4, 4, NULL, NULL, '2016-07-20 19:00:11', '2016-07-20 19:00:11'),
(5, 5, NULL, NULL, '2016-07-20 20:10:37', '2016-07-20 20:10:37'),
(6, 6, NULL, NULL, '2016-07-21 04:17:27', '2016-07-21 04:17:27'),
(7, 7, NULL, NULL, '2016-07-21 04:25:26', '2016-07-21 04:25:26'),
(9, 12, NULL, NULL, '2016-07-22 19:12:50', '2016-07-22 19:12:50'),
(10, 14, NULL, NULL, '2016-07-26 06:38:39', '2016-07-26 06:38:39'),
(11, 15, NULL, NULL, '2016-07-26 06:38:40', '2016-07-26 06:38:40'),
(12, 16, NULL, NULL, '2016-07-26 06:38:40', '2016-07-26 06:38:40'),
(13, 17, NULL, NULL, '2016-07-26 06:38:41', '2016-07-26 06:38:41'),
(14, 18, NULL, NULL, '2016-07-26 06:38:41', '2016-07-26 06:38:41'),
(15, 19, NULL, NULL, '2016-07-26 06:38:41', '2016-07-26 06:38:41'),
(16, 21, NULL, NULL, '2016-07-31 07:59:30', '2016-07-31 07:59:30'),
(17, 29, NULL, NULL, '2016-08-11 19:37:54', '2016-08-11 19:37:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `options`
--

CREATE TABLE `options` (
  `id` int(10) UNSIGNED NOT NULL,
  `multiple_question_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credible` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `options`
--

INSERT INTO `options` (`id`, `multiple_question_id`, `description`, `credible`, `created_at`, `updated_at`) VALUES
(1, 1, 'Esta es la opcion 1 nuevo', 0, '0000-00-00 00:00:00', '2016-07-20 18:30:19'),
(2, 1, 'Esta es la opcion 2 gato', 0, '0000-00-00 00:00:00', '2016-07-20 18:30:25'),
(3, 1, 'sdfsdfsdf', 0, '2016-07-20 18:33:12', '2016-07-20 18:38:02'),
(4, 1, 'adfadf', 0, '2016-07-20 18:36:18', '2016-07-20 18:37:57'),
(5, 1, 'dsdfsdf', 0, '2016-07-20 18:37:21', '2016-07-20 18:37:52'),
(15, 3, 'sfdsfsdf', 1, '2016-07-20 20:10:52', '2016-07-20 20:10:52'),
(18, 3, 'hla', 0, '2016-07-20 23:28:10', '2016-07-20 23:29:50'),
(19, 3, 'daf', 0, '2016-07-20 23:29:54', '2016-07-20 23:29:54'),
(20, 4, 'Char', 0, '2016-07-20 23:32:26', '2016-07-30 22:08:34'),
(21, 4, 'Boolean', 0, '2016-07-20 23:32:33', '2016-07-30 22:08:34'),
(22, 4, 'Double', 0, '2016-07-20 23:36:49', '2016-07-30 22:08:34'),
(23, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, in sapiente ea illum incidunt est veritatis ipsa doloribus quos libero ex itaque aspernatur, autem obcaecati.', 1, '2016-07-20 23:54:36', '2016-07-20 23:54:45'),
(24, 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, in sapiente ea illum incidunt est veritatis ipsa doloribus quos libero ex itaque aspernatur, autem obcaecati.', 0, '2016-07-20 23:54:45', '2016-07-20 23:54:52'),
(26, 3, 'dfadf', 0, '2016-07-21 01:54:36', '2016-07-21 01:54:36'),
(27, 6, 'Si un desarrollador termina un trabajo en  4 días, dos lo harán en 2 días.', 0, '2016-07-21 04:19:41', '2016-07-21 04:19:41'),
(28, 6, 'El 80% de los proyectos terminan exitosamente.', 0, '2016-07-21 04:20:17', '2016-07-21 04:20:17'),
(29, 6, 'La culpa del fracaso de un proyecto recae en el scrum master.', 0, '2016-07-21 04:21:00', '2016-07-21 04:21:00'),
(30, 6, 'El proceso unificado de desarrollo no es un método ágil.', 0, '2016-07-21 04:21:55', '2016-07-21 04:21:55'),
(31, 7, '[1..20]', 0, '2016-07-21 04:28:07', '2016-07-30 22:05:43'),
(33, 5, 'rsdfsdfsdfs', 0, '2016-07-22 19:12:27', '2016-07-22 19:12:27'),
(36, 13, '(x, _, _) = x', 1, '2016-07-27 01:31:13', '2016-07-30 22:33:26'),
(37, 13, 'x:xs', 1, '2016-07-27 01:31:18', '2016-07-30 22:33:26'),
(38, 15, '[(Boo,Char)]', 1, '2016-07-30 21:18:35', '2016-07-30 21:18:35'),
(39, 15, '[(Boo,Char),(Bool,Char)]', 0, '2016-07-30 21:18:58', '2016-07-30 21:18:58'),
(40, 15, '[(String,Char)]', 0, '2016-07-30 21:19:14', '2016-07-30 21:19:14'),
(41, 15, '[(Boo,Int)]', 0, '2016-07-30 21:19:25', '2016-07-30 21:19:25'),
(42, 14, '[Bool]', 0, '2016-07-30 21:28:37', '2016-07-30 21:28:57'),
(43, 14, '[String]', 0, '2016-07-30 21:28:57', '2016-07-30 21:28:57'),
(44, 14, 'Bool', 0, '2016-07-30 21:29:10', '2016-07-30 21:29:10'),
(45, 14, '(Bool, Bool, Bool, Bool)', 0, '2016-07-30 21:29:24', '2016-07-30 21:29:24'),
(46, 10, 'Las lambdas son funciones anónimas que suelen ser usadas cuando necesitamos una función una sola vez.', 0, '2016-07-30 21:54:19', '2016-07-30 21:54:19'),
(47, 10, ' pueden tomar funciones como parámetros y también devolver funciones. Para ilustrar esto vamos a crear una función que tome una función y la aplique dos veces a algo.', 0, '2016-07-30 21:55:36', '2016-07-30 21:55:36'),
(48, 9, 'La sintaxis para importar módulos en un script de Haskell es import <module name>.', 0, '2016-07-30 21:57:29', '2016-07-30 21:57:29'),
(49, 9, 'La sintaxis para importar módulos en un script de Haskell es get <module name>.', 0, '2016-07-30 21:57:47', '2016-07-30 21:57:47'),
(50, 9, 'La sintaxis para importar módulos en un script de Haskell es include <module name>.', 0, '2016-07-30 21:58:04', '2016-07-30 21:58:04'),
(51, 7, '[''a''..''z'']', 0, '2016-07-30 22:05:43', '2016-07-30 22:05:43'),
(52, 7, '[2,4..20]', 0, '2016-07-30 22:06:42', '2016-07-30 22:06:42'),
(53, 4, 'Float', 0, '2016-07-30 22:08:34', '2016-07-30 22:08:34'),
(54, 4, 'List', 0, '2016-07-30 22:08:48', '2016-07-30 22:08:48'),
(59, 11, 'fmap :: (Functor f) => (a -> b) -> f a -> f b', 0, '2016-07-30 22:39:47', '2016-07-30 22:39:47'),
(60, 11, 'fmap :: (Functor f) => (a -> b) -> f a -> f b', 0, '2016-07-30 22:39:50', '2016-07-30 22:39:50'),
(61, 11, 'fmap :: (Functor f) => (a -> b) -> f a -> f b', 0, '2016-07-30 22:39:54', '2016-07-30 22:39:54'),
(62, 16, 'CSS es el acronimo de Cascade Style Sheet.', 0, '2016-07-31 08:00:38', '2016-07-31 08:00:38'),
(63, 16, 'Las comando iterativos son una caracteristica relevante en CSS.', 0, '2016-07-31 08:01:04', '2016-07-31 08:01:04'),
(64, 16, 'Se creo para dar comportamiento dinámico.', 0, '2016-07-31 08:01:27', '2016-07-31 08:01:27'),
(68, 12, 'dfsdfsdfsfsdf', 1, '2016-08-05 01:18:32', '2016-08-05 01:39:39'),
(70, 12, 'sdfsfsdf', 0, '2016-08-05 01:24:45', '2016-08-05 01:25:54'),
(71, 12, 'sdfsdsdfsdf', 1, '2016-08-05 01:25:44', '2016-08-05 01:25:47'),
(73, 17, 'opcion 1', 1, '2016-08-11 19:39:11', '2016-08-11 19:39:11'),
(74, 17, 'opcion 2', 0, '2016-08-11 19:39:30', '2016-08-11 19:39:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('jultum88@gmail.com', '61484fb6859e8a8b314e75474d84d2ea2112abf1af5346cece8a103d6fd25a46', '2016-07-31 21:29:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `types` enum('multiple','develop','complemento','falsoVerdad') COLLATE utf8_unicode_ci NOT NULL,
  `credible` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `questions`
--

INSERT INTO `questions` (`id`, `group_id`, `title`, `description`, `types`, `credible`, `created_at`, `updated_at`) VALUES
(1, 6, 'Lados de un triangulo', 'Cuantos lados tiene un triangulo', 'multiple', 0, '2016-07-20 15:30:11', '2016-07-20 18:41:32'),
(3, 9, 'Cuando se formo la luna', 'lorem', 'multiple', 0, '2016-07-20 18:59:15', '2016-07-20 23:31:55'),
(4, 9, 'Tipos de datos', 'Cual de los siguientes tipos de datos no corresponden a haskell', 'multiple', 0, '2016-07-20 19:00:11', '2016-07-30 22:08:34'),
(5, 9, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam minus molestias nesciunt praesentium eligendi perferendis alias fuga sapiente iusto dolor, a nam recusandae amet commodi quis tenetur obcaecati ipsum impedit omnis accusamus ad expedita hic do', 'multiple', 0, '2016-07-20 20:10:37', '2016-07-20 23:55:24'),
(6, 5, 'Crisis del Software', 'Escoja cual de los siguientes enunciados es correcto', 'multiple', 0, '2016-07-21 04:17:26', '2016-07-21 04:21:00'),
(9, 9, 'Zippers', 'Explique detalladamente que es un zipper', 'develop', 0, '2016-07-22 18:07:46', '2016-07-30 22:01:45'),
(11, 9, 'Prueba de pregunta de desarrollo', 'enuncia de la pregunta de desarrollo', 'develop', 0, '2016-07-22 18:23:44', '2016-07-30 22:40:31'),
(12, 9, 'Modulos', 'Como se  importa Módulos en haskell?', 'multiple', 0, '2016-07-22 19:12:50', '2016-07-30 21:57:29'),
(14, 9, 'Lambdas', 'Que son los lambdas en Haskell', 'multiple', 0, '2016-07-26 06:38:39', '2016-07-30 21:54:19'),
(15, 9, 'Pregunta de Monadas', ' simplemente son una versión ampliada de los funtores aplicativos, de la misma forma que los funtores aplicativos son una versión ampliada de los funtores.', 'multiple', 0, '2016-07-26 06:38:40', '2016-07-30 22:39:47'),
(16, 9, 'Ejercicio de Figuras', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates animi cupiditate omnis voluptatibus, ipsam eaque. Totam nemo nam iste, officiis maiores illo quaerat magni molestias!', 'multiple', 0, '2016-07-26 06:38:40', '2016-07-30 22:35:13'),
(17, 9, 'Patrones', 'Cual es el patrón mas usado con recursion.', 'multiple', 0, '2016-07-26 06:38:41', '2016-07-30 22:33:26'),
(18, 9, 'Pregunta de tipos', 'Cual es el tipo de la siguiente definición:  e0 = [False, True, False, True]', 'multiple', 0, '2016-07-26 06:38:41', '2016-07-30 21:28:37'),
(19, 9, 'Tipo del valor', 'Cual es el tipo de siguiente valor [(False, ''0''),(True,''1'')]', 'multiple', 0, '2016-07-26 06:38:41', '2016-07-30 21:22:08'),
(20, 22, 'Javascript', 'Cual es el nombre del creador de javascript.?', 'develop', 0, '2016-07-31 07:58:29', '2016-07-31 07:59:11'),
(21, 22, 'Definición de CSS', 'Escoja los enunciados que son correctos', 'multiple', 0, '2016-07-31 07:59:30', '2016-07-31 08:00:38'),
(26, 9, 'Pregunta de complemento', 'Lo pregunta de datos &nbsp;<compl>compl-2</compl>&nbsp;&nbsp;&nbsp;&nbsp;gana ventaja&nbsp;<compl>compl-4</compl> fsdfsdfsdfsdf&nbsp;&nbsp; &nbsp; sdfsdfsdf &nbsp;carga &nbsp; &nbsp; &nbsp;camiones &nbsp; &nbsp;sdfsdf &nbsp;dfsdfdf sdfsd &nbsp;<compl>compl-20</compl>&nbsp; &nbsp; fsdsdf dfsdf&nbsp;&nbsp; &nbsp; dfsdfsf&nbsp;&nbsp; &nbsp; dsfsf &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; sdfsdfsf dos gato sdfsd&nbsp;<compl>compl-25</compl>&nbsp;&nbsp;&nbsp;&nbsp;', 'complemento', 0, '2016-08-06 05:15:17', '2016-08-06 06:41:01'),
(28, 9, 'Pregunta de falso Verdadero ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis odit quisquam, nostrum incidunt, repellat nihil rerum magnam id sunt, voluptatibus nam. Amet, omnis.', 'falsoVerdad', 1, '2016-08-02 17:28:41', '2016-08-05 04:16:00'),
(29, 25, 'pregunta de complemento civismo', 'sdsfasfsdfsdf  ', 'multiple', 0, '2016-08-11 19:37:54', '2016-08-11 19:38:52'),
(30, 25, 'preg desarrollo', 'fsfsdfsdfsdf', 'develop', 0, '2016-08-11 19:39:58', '2016-08-11 19:40:10'),
(31, 25, 'pregunta complemento ', '<compl>compl-27</compl>&nbsp;&nbsp;dadadffdfadfadfaf&nbsp;&nbsp;&nbsp;<compl>compl-26</compl>&nbsp;&nbsp;', 'complemento', 0, '2016-08-11 19:40:29', '2016-08-11 19:43:08'),
(32, 25, 'pregunta falso verdarero', 'dsfsdfsd sdfsdf ', 'falsoVerdad', 0, '2016-08-11 19:44:07', '2016-08-11 19:44:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `cod_sis` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `career_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `students`
--

INSERT INTO `students` (`id`, `user_id`, `cod_sis`, `created_at`, `updated_at`, `career_id`) VALUES
(3, 0, 20132211, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(4, 0, 20134522, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(5, 18, 20125554, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(6, 0, 20145454, '2016-06-27 02:31:47', '2016-06-27 02:31:47', ''),
(11, 32, 20150001, '2016-06-27 04:41:09', '2016-06-27 04:46:57', ''),
(12, 0, 20150002, '2016-06-27 04:41:09', '2016-06-27 04:41:09', ''),
(13, 0, 20150003, '2016-06-27 04:41:09', '2016-06-27 04:41:09', ''),
(14, 0, 20150004, '2016-06-27 04:41:09', '2016-06-27 04:41:09', ''),
(15, 0, 20150005, '2016-06-27 04:41:09', '2016-06-27 04:41:09', ''),
(16, 0, 20150006, '2016-06-27 04:41:09', '2016-06-27 04:41:09', ''),
(17, 0, 20150007, '2016-06-27 04:41:09', '2016-06-27 04:41:09', ''),
(18, 0, 20150008, '2016-06-27 04:41:09', '2016-06-27 04:41:09', ''),
(19, 0, 20150009, '2016-06-27 04:41:09', '2016-06-27 04:41:09', ''),
(20, 0, 20150010, '2016-06-27 04:41:09', '2016-06-27 04:41:09', ''),
(21, 0, 20150011, '2016-06-27 04:41:09', '2016-06-27 04:41:09', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teachers`
--

CREATE TABLE `teachers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `cod_sis` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `cod_sis`, `created_at`, `updated_at`) VALUES
(1, 30, 2012555, '0000-00-00 00:00:00', '2016-06-17 22:08:27'),
(2, 33, 2008442, '0000-00-00 00:00:00', '2016-06-27 09:47:07'),
(4, 31, 20115521, '2016-06-26 06:36:15', '2016-06-26 06:39:14'),
(8, 34, 20100236, '2016-06-26 12:12:54', '2016-06-27 18:25:43'),
(11, 35, 20031234, '2016-06-28 18:12:42', '2016-06-28 18:15:08'),
(17, 36, 20014444, '2016-07-31 20:21:49', '2016-07-31 20:23:15'),
(18, 0, 20110234, '2016-08-11 19:30:58', '2016-08-11 19:30:58'),
(19, 37, 20110235, '2016-08-11 19:30:58', '2016-08-11 19:33:03'),
(20, 0, 20110236, '2016-08-11 19:30:58', '2016-08-11 19:30:58'),
(21, 0, 20110237, '2016-08-11 19:30:58', '2016-08-11 19:30:58'),
(22, 0, 20100238, '2016-08-11 19:30:58', '2016-08-11 19:30:58'),
(23, 0, 20100237, '2016-08-11 19:30:58', '2016-08-11 19:30:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` int(11) NOT NULL,
  `active` smallint(6) NOT NULL DEFAULT '0',
  `type` smallint(6) NOT NULL DEFAULT '-1',
  `user_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'nan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `active`, `type`, `user_img`) VALUES
(17, 'admin', 'jultum88@gmail.com', '$2y$10$Nw3Cd25xmin6mE4mdggJX.MzfmyvZiBxkow7umjPXQ8sxFbn0il8K', 'kWJ2pquVaf7Jn7tWixKkV5UNw4Y1s3hrxWwaO559RvXGykgGzhe15VbnzpJV', NULL, '2016-08-18 15:02:09', 5555555, 1, 0, 'user_17.jpg'),
(18, 'Jose Miguel Ramirez', 'jose@gmail.com', '$2y$10$M.3tXuaaF0HORgCP6BXmJ.CBuDX13UNDnbTeqcN6pz/URaVfwFOYK', 'VUfLPhPbU2H0CC5zOt0Wv0nPNYLjfoiVaLIzlsPDO627qLPdsd28Hwp46iCy', '2016-06-04 05:33:00', '2016-06-27 18:20:27', 0, 1, 2, 'nan'),
(19, 'alexis', 'alex@gmail.com', '$2y$10$k/lHUf7EU69Gy6npy/oqv.BnYP3raboIdxfr8resbSQ/5kzcdFfyW', 'EFkb40oCDGwIC2j0zGqW8TlHKcNyjJJRpnzc2A8pKIbz818gVKEENzKOiELz', '2016-06-06 08:53:09', '2016-06-17 08:45:20', 43434, 1, 0, 'user_19.jpg'),
(20, 'pame', 'pame@gmail.com', '$2y$10$9KPSJoYbl1OtaJUomJPdA.aZ2SSSVK18zyOagHE9fmtKgPhgzTT7O', 'OVH7Dlc57xrsKDdvmWzhY2A4lot2LSHOSzwwTElla3BhOtSYbXGCeUwqUAwW', '2016-06-06 09:16:09', '2016-06-26 01:28:56', 0, 1, 1, 'nan'),
(21, 'Corina Flores', 'corinaflores@gmail.com', '$2y$10$GfNPIc5unT9maJNWOjn9GOnMSkXOWLxMg8FK5ml7zl1A6wMMkUfqq', 'xtphvnUvumMk9qGwmBk6dsiwDad1DCHYawyPuMxW47jo6SvkpajZgYmw3SVo', '2016-06-06 10:07:01', '2016-08-18 15:03:44', 4444, 1, 0, 'nan'),
(22, 'diego jael', 'diego@gmail.com', '$2y$10$nTntK6/BXBrp5szz8feXOery758jSAxzDB4W4VF6ynkkTtB11/f1W', '6lLH71z4bcXuxfE3AX0vJfjFaoR2icrICCtUH0zovo6sT6Zh6IWN4olcM2Ww', '2016-06-14 10:32:41', '2016-08-17 23:27:36', 554433, 1, 0, 'user_22.jpg'),
(23, 'jaime', 'jaime@gmail.com', '$2y$10$VkUMbmDPOz6QDF9QvYvp6uQPWnLNJODH4bkEaGZF4Oz8AN20WkPv6', 'Dg98N94FSZU01SOdYLKJ6Fghm8mEabZNmoMxhhCfvylojSrgnD8cx0PCwPc7', '2016-06-14 10:37:25', '2016-06-17 20:42:17', 0, 0, 1, 'user_23.jpg'),
(30, 'maría dolores Mendoza  Gonzales', 'maria@gmail.com', '$2y$10$Vovfqs/rY6SyAVbAbPIcAuuRRbs12wsAtQ9YqCH0tCEzP5FzqL.NS', 'VFLQmhY9Cl11eBgdrVklPxDOnFNmQ0ml3iHrEOB1jJbLbntaRfO4LUUf3pim', '2016-06-17 22:08:27', '2016-08-12 23:44:57', 8879345, 1, 1, 'user_30.jpg'),
(31, 'Matias Godoy Fernandez', 'juliotllan88@gmail.com', '$2y$10$JhGWrp6csYCQz0C4VeMjROyh9KjFHwOW14w/ouhWsCOxswe06HBKS', 'yLzRFJkBVFFALTFYrax6CQpoLUPpl9LeymUMJ4V7llGAJZabCfiqVQCnIbT5', '2016-06-26 06:39:14', '2016-06-28 11:51:30', 3332221, 1, 1, 'user_31.jpg'),
(32, 'Jeronimo Jimenez', 'jeronimo@gmail.com', '$2y$10$uDDptc5Eh9ZuwoQDxvxWfOlmpQQPCrzq2Tyoaugek0B.hOpA5kLQO', 'jwmYWbo9N0NJ9TSPpY2txRUKszrpHApfWrHcyJq2lfn5HuVOlKttM7PfrhGO', '2016-06-27 04:46:57', '2016-08-17 23:25:03', 443322, 1, 2, 'user_32.jpg'),
(33, 'Esteban Jaramillo Villena', 'esteban@gmail.com', '$2y$10$P57dVYpjbkNjIweXSZRMK.P.eUiSdWG4jWWAl.ZBEjn7NluHJSJJW', 'cjVG2h3DDfBv7EYhEQWIAEXpspBVn4EILQEO0rnND2ibfLZ3XaHFQx6FesDR', '2016-06-27 09:47:07', '2016-06-27 09:47:47', 0, 1, 1, 'user_33.jpg'),
(34, 'Elder Guido Fernandez', 'elderg@gmail.com', '$2y$10$BFKfXI1CqM3jjEBWXMSGKeBBnDF4l15sae5Sz4loB4maZ8DZDB7L2', '8hiwKoJ2GwIuL8IhIrbWrTG8tFcvlgaZLiaumwMQaZNg2PccuSGIyXQbqTM4', '2016-06-27 18:25:43', '2016-06-28 11:58:53', 5543432, 1, 1, 'user_34.jpg'),
(35, 'jose luis', 'joseluis@gmail.com', '$2y$10$vJDnyvHdnyzuyBJmqVXUMeKT4x059p1lLubW3XJMMAs0NDQQzvnL6', 'Cbfiryo3DZAUYBv41Vj9BeMTLIatj4pgUiVTCKXoVi6q7hQNEPABTO2DxsBt', '2016-06-28 18:15:08', '2016-06-28 21:43:35', 5554444, 1, 1, 'user_35.jpg'),
(36, 'Felipe Gallegos Tomasi', 'felipe@gmail.com', '$2y$10$hbBD18e04kAgPwb2N/ITuuqYB2u3gZFng1XrrJHisxPTHPZEb0/Hq', 'Zogrc1OkLmtt9yyBbnjA7XMg2QwDJb9Er0Ga1jnTQdqGCeoz95FLCecgHlDg', '2016-07-31 20:23:15', '2016-08-12 23:43:32', 55544, 1, 1, 'user_36.jpg'),
(37, 'gonzalo ', 'gonzalo@gmail.com', '$2y$10$cgHbpCqp5C6D9B8Grb3IpuCw0LDrFePwVMtVmq6ZHoQsiu57YrBSW', '97PGz5Sr4uunLJFoLrVPONpVMJJjjCCV3pX5xjgovrzHSFGS8DlDlsCKaln4', '2016-08-11 19:33:03', '2016-08-11 20:08:35', 0, 1, 1, 'nan');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `complementquestions`
--
ALTER TABLE `complementquestions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_career_id_index` (`career_id`);

--
-- Indices de la tabla `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluation_student`
--
ALTER TABLE `evaluation_student`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `exam_question`
--
ALTER TABLE `exam_question`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `exam_student`
--
ALTER TABLE `exam_student`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `group_student`
--
ALTER TABLE `group_student`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `multiplequestions`
--
ALTER TABLE `multiplequestions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_cod_sis_unique` (`cod_sis`),
  ADD KEY `students_user_id_index` (`user_id`),
  ADD KEY `students_career_id_index` (`career_id`);

--
-- Indices de la tabla `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teachers_cod_sis_unique` (`cod_sis`),
  ADD KEY `teachers_user_id_index` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `careers`
--
ALTER TABLE `careers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `complementquestions`
--
ALTER TABLE `complementquestions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `evaluation_student`
--
ALTER TABLE `evaluation_student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `exam_question`
--
ALTER TABLE `exam_question`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT de la tabla `exam_student`
--
ALTER TABLE `exam_student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `group_student`
--
ALTER TABLE `group_student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `multiplequestions`
--
ALTER TABLE `multiplequestions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT de la tabla `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
