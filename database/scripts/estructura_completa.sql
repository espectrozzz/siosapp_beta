-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-04-2021 a las 18:07:18
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pruebadashboard`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_causas`
--

CREATE TABLE `c_causas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `c_causas`
--

INSERT INTO `c_causas` (`id`, `descripcion`, `created_at`, `updated_at`, `estado_id`) VALUES
(1, 'Sin Causa', NULL, NULL, 1),
(2, 'Accidente vehicular', NULL, NULL, 1),
(3, 'Acometida rota', NULL, NULL, 1),
(4, 'Acopladores sucios', NULL, NULL, 1),
(5, 'Bote en mal estado', NULL, NULL, 1),
(6, 'Clean up', NULL, NULL, 1),
(7, 'Daño interno de F.O.', NULL, NULL, 1),
(8, 'Desagregacion', NULL, NULL, 1),
(9, 'Empalme desgradado', NULL, NULL, 1),
(10, 'Factor climatico', NULL, NULL, 1),
(11, 'Falla en jumper', NULL, NULL, 1),
(12, 'Falla hardware', NULL, NULL, 1),
(13, 'F.O. suelta u holgada', NULL, NULL, 1),
(14, 'Folio duplicado', NULL, NULL, 1),
(15, 'Folio mal asignado', NULL, NULL, 1),
(16, 'Implementacion 1N.', NULL, NULL, 1),
(17, 'Implementacion 2N', NULL, NULL, 1),
(18, 'Incendio', NULL, NULL, 1),
(19, 'Induccion electrica', NULL, NULL, 1),
(20, 'Intermitencia', NULL, NULL, 1),
(21, 'Mala Construccion', NULL, NULL, 1),
(22, 'Mala manipulacion', NULL, NULL, 1),
(23, 'Mordedura de roedor(Nido de ave/Nido de Hormigas', NULL, NULL, 1),
(24, 'Mantenimiento correctivo PI', NULL, NULL, 1),
(25, 'No determinada por personal', NULL, NULL, 1),
(26, 'Obra publica', NULL, NULL, 1),
(27, 'Poda de arboles', NULL, NULL, 1),
(28, 'Saturacion', NULL, NULL, 1),
(29, 'Sin daño', NULL, NULL, 1),
(30, 'Splitter dañado', NULL, NULL, 1),
(31, 'Sustitucion de splitter', NULL, NULL, 1),
(32, 'Trabajos de CFE/Cambio de posteria', NULL, NULL, 1),
(33, 'Trabajos de otros carriers', NULL, NULL, 1),
(34, 'Vandalismo', NULL, NULL, 1),
(35, 'Vehiculo con exceso de dimensiones', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_clusters`
--

CREATE TABLE `c_clusters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `distrito_id` bigint(20) UNSIGNED NOT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `c_clusters`
--

INSERT INTO `c_clusters` (`id`, `descripcion`, `created_at`, `updated_at`, `distrito_id`, `estado_id`) VALUES
(1, 'TX', NULL, NULL, 1, 1),
(2, 'TX', NULL, NULL, 2, 1),
(3, 'Miramontes', NULL, NULL, 3, 1),
(4, 'Granjas Esmeralda', NULL, NULL, 3, 1),
(5, 'Culhuacan', NULL, NULL, 3, 1),
(6, 'Cerro de la Estrella', NULL, NULL, 3, 1),
(7, 'Ampliacion Cerro de la Estrella', NULL, NULL, 3, 1),
(8, 'San Lorenzo Tezonco', NULL, NULL, 3, 1),
(9, 'Santa Maria Acatitla', NULL, NULL, 4, 1),
(10, 'Santa Martha Acatitla Sur', NULL, NULL, 4, 1),
(11, 'Ixtlahuaca', NULL, NULL, 4, 1),
(12, 'Palmitas', NULL, NULL, 4, 1),
(13, 'Constitucion', NULL, NULL, 4, 1),
(14, 'TX', NULL, NULL, 5, 1),
(15, 'Cuernavaca 1', NULL, NULL, 6, 1),
(16, 'Cuernavaca 2', NULL, NULL, 6, 1),
(17, 'Cuernavaca 3', NULL, NULL, 6, 1),
(18, 'Ampliacion Cuernavaca 2', NULL, NULL, 6, 1),
(19, 'Ocotepec', NULL, NULL, 6, 1),
(20, 'Ampliacion Ocotepec', NULL, NULL, 6, 1),
(21, 'Tejalpa', NULL, NULL, 6, 1),
(22, 'Ampliacion Tejalpa', NULL, NULL, 6, 1),
(23, 'Temixco', NULL, NULL, 7, 1),
(24, 'Xochitepec', NULL, NULL, 7, 1),
(25, 'Jiutepec', NULL, NULL, 7, 1),
(26, 'San Jose Cumbres', NULL, NULL, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_despachos`
--

CREATE TABLE `c_despachos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `c_despachos`
--

INSERT INTO `c_despachos` (`id`, `Nombre`, `created_at`, `updated_at`, `estado_id`) VALUES
(1, 'FRANCO SOSA ABEL', NULL, NULL, 1),
(2, 'MARTINEZ SOSA ELIZABETH KIREINA', NULL, NULL, 1),
(3, 'AGUILERA SOTO ALFREDO', NULL, NULL, 1),
(4, 'RECILLAS MORENO CLAUDIA STEPHANY', NULL, NULL, 1),
(5, 'GONZALEZ ANGUIANO LEI CARRIE', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_distritos`
--

CREATE TABLE `c_distritos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `c_distritos`
--

INSERT INTO `c_distritos` (`id`, `descripcion`, `supervisor_id`, `created_at`, `updated_at`, `estado_id`) VALUES
(1, 'TX OTE II', 1, NULL, NULL, 1),
(2, 'TX Centro Sur', 2, NULL, NULL, 1),
(3, 'D6 Iztapalapa', 2, NULL, NULL, 1),
(4, 'D26 Constitucion', 1, NULL, NULL, 1),
(5, 'TX Cuernavaca', 3, NULL, NULL, 1),
(6, 'Cuernavaca 1', 3, NULL, NULL, 1),
(7, 'Cuernavaca 2', 3, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_estados`
--

CREATE TABLE `c_estados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `c_estados`
--

INSERT INTO `c_estados` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Activo', NULL, NULL),
(2, 'Inactivo', NULL, NULL),
(3, 'Borrado', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_estatus`
--

CREATE TABLE `c_estatus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `c_estatus`
--

INSERT INTO `c_estatus` (`id`, `descripcion`, `estado_id`, `created_at`, `updated_at`) VALUES
(1, 'Pendiente', 1, NULL, NULL),
(2, 'En proceso', 1, NULL, NULL),
(3, 'Programado', 1, NULL, NULL),
(4, 'Cerrado', 1, NULL, NULL),
(5, 'Finalizado', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_fallas`
--

CREATE TABLE `c_fallas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `c_fallas`
--

INSERT INTO `c_fallas` (`id`, `descripcion`, `created_at`, `updated_at`, `estado_id`) VALUES
(1, 'Por definir', NULL, NULL, 1),
(2, 'Mantenimiento', NULL, NULL, 1),
(3, 'Corte F.O.', NULL, NULL, 1),
(4, 'Reforzamiento', NULL, NULL, 1),
(5, 'Splitter atenuado', NULL, NULL, 1),
(6, 'Implementacion 2N', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_justificacion_pausas`
--

CREATE TABLE `c_justificacion_pausas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `c_justificacion_pausas`
--

INSERT INTO `c_justificacion_pausas` (`id`, `descripcion`, `created_at`, `updated_at`, `estado_id`) VALUES
(1, 'Acero inducido', NULL, NULL, 1),
(2, 'Actividad Programada/No autorizado hasta ventana de mtto', NULL, NULL, 1),
(3, 'Asalto o Vandalismo', NULL, NULL, 1),
(4, 'Autoridades de gobierno no permiten laborar', NULL, NULL, 1),
(5, 'En espera de acceso a la OLT', NULL, NULL, 1),
(6, 'En espera de apoyo para depuracion', NULL, NULL, 1),
(7, 'En espera de datos de ctes', NULL, NULL, 1),
(8, 'En espera de Ingenierias', NULL, NULL, 1),
(9, 'En espera de Validacion por TPE/NOC', NULL, NULL, 1),
(10, 'Imputable a instafibra', NULL, NULL, 1),
(11, 'Ingenieria NO coincide', NULL, NULL, 1),
(12, 'Lluvia/factor climatico', NULL, NULL, 1),
(13, 'Mercado ambulante o calle cerrada', NULL, NULL, 1),
(14, 'Permiso especial para trabajos en zona', NULL, NULL, 1),
(15, 'Problemas con permisos (permisos  no validos)', NULL, NULL, 1),
(16, 'Problemas de acceso por arrendatario', NULL, NULL, 1),
(17, 'Problemas de acceso por infraestructura', NULL, NULL, 1),
(18, 'Sin trayectorias', NULL, NULL, 1),
(19, 'Trabajos de CFE (no permiten laborar)', NULL, NULL, 1),
(20, 'Vecinos no permiten trabajar', NULL, NULL, 1),
(21, 'Zona acordonada por protección civil', NULL, NULL, 1),
(22, 'Zona de alto riesgo', NULL, NULL, 1),
(23, 'Zona de dificil acceso', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_logs_usuarios`
--

CREATE TABLE `c_logs_usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `ip_usuario` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_conexion` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_materiales`
--

CREATE TABLE `c_materiales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_material` bigint(20) UNSIGNED NOT NULL,
  `codigo` char(20) COLLATE utf8mb4_unicode_ci DEFAULT 'Sin Codigo',
  `estado_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `c_materiales`
--

INSERT INTO `c_materiales` (`id`, `descripcion`, `created_at`, `updated_at`, `tipo_material`, `codigo`, `estado_id`) VALUES
(5, 'CINCHOS PANDIUT', NULL, NULL, 1, 'CINP01', 1),
(6, 'TANJENTES', NULL, NULL, 1, 'TJ001', 1),
(7, 'PREFORMADOS AMARILLOS 1/4', NULL, NULL, 1, 'PREA1.4', 1),
(8, 'PREFORMADOS NEGRO 1/16', NULL, NULL, 1, 'PREN1.16', 1),
(9, 'PREFORMADOS MORADOS 1/16', NULL, NULL, 1, 'PREM1.16', 1),
(10, 'FLEJES 5/8', NULL, NULL, 1, 'FLE5.8', 1),
(11, 'NEOPRENO', NULL, NULL, 1, 'NOFRE', 1),
(12, 'HEBILLAS', NULL, NULL, 1, 'HEB001', 1),
(13, 'HERRAJES DE PASO', NULL, NULL, 1, 'HPSO01', 1),
(14, 'HERRAJES TIPO D', NULL, NULL, 1, 'HTD001', 1),
(15, 'HERRAJES TIPO J', NULL, NULL, 1, 'HTJ001', 1),
(16, 'HERRAJES TANGENTES', NULL, NULL, 1, 'HTNG01', 1),
(17, 'MANGAS TECNO', NULL, NULL, 1, 'MGTEC1', 1),
(18, 'BRAZOS HERRAJE TIPO D 60 CM', NULL, NULL, 1, 'BZOTD60', 1),
(19, 'BRAZOS HERRAJES TANGENTE 60 CM', NULL, NULL, 1, 'BZOT60', 1),
(20, 'BRAZOS C/HERRAJES TANGENTE 100CM', NULL, NULL, 1, 'BZOCHT100', 1),
(21, 'BRAZOS C/HERRAJES TIPO D 100 CM', NULL, NULL, 1, 'BZCHTD100', 1),
(22, 'BRAZOS C/ HERRAJES TIPO J 100 CM', NULL, NULL, 1, 'BZOCHTJ100', 1),
(23, 'PROTECTORES', NULL, NULL, 1, 'PROTEC01', 1),
(24, 'MECATES', NULL, NULL, 1, 'MEC001', 1),
(25, 'FIBRA 96 MTS', NULL, NULL, 2, 'FB096', 1),
(26, 'FIBRA 24 MTS', NULL, NULL, 2, 'FB024', 1),
(27, 'ACERO MTS', NULL, NULL, 2, 'AC001', 1),
(28, 'MEXFO 1N', NULL, NULL, 2, 'MX001', 1),
(29, 'RAQUETAS', NULL, NULL, 2, 'RQ001', 1),
(30, 'ETIQUETAS', NULL, NULL, 2, 'ETQA01', 1),
(31, 'MEXFOS 24 MINI', NULL, NULL, 2, 'MX002', 1),
(32, 'SPLITTER 1N 1X8', NULL, NULL, 2, 'SP1NX8', 1),
(33, 'SPLITTER 2N 1X8', NULL, NULL, 2, 'SP2NX8', 1),
(34, 'SPLITTER 2N 1X16', NULL, NULL, 2, 'SP2NX16', 1),
(35, 'CAJAS N1', NULL, NULL, 2, 'CJ0N1', 1),
(36, 'CAJAS N2 FIBER HOME', NULL, NULL, 2, 'CJN2', 1),
(37, 'CAJA DE DERIVACION ', NULL, NULL, 2, 'CJDER01', 1),
(38, 'BOTES DE 2N CIERRE', NULL, NULL, 2, 'BT2N01', 1),
(39, 'CIERRE 96 ', NULL, NULL, 2, 'BTDE1N', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_rol_usuario`
--

CREATE TABLE `c_rol_usuario` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_supervisors`
--

CREATE TABLE `c_supervisors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `c_supervisors`
--

INSERT INTO `c_supervisors` (`id`, `Nombre`, `created_at`, `updated_at`, `estado_id`) VALUES
(1, 'Paulo Lenin Puerta Mendoza', NULL, NULL, 1),
(2, 'Carlos Franciscco Inda Alvarado', NULL, NULL, 1),
(3, 'Nehisem Avilez', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_tecnicos`
--

CREATE TABLE `c_tecnicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `c_tecnicos`
--

INSERT INTO `c_tecnicos` (`id`, `Nombre`, `created_at`, `updated_at`, `estado_id`) VALUES
(1, 'Daniel Gonzalez', NULL, NULL, 1),
(2, 'Issac Velazquez', NULL, NULL, 1),
(3, 'Abraham Alpizar', NULL, NULL, 1),
(4, 'Jose Luis Peralta', NULL, NULL, 1),
(5, 'Alfonso Brito', NULL, NULL, 1),
(6, 'Victor Manuel Lopez Perez', NULL, NULL, 1),
(7, 'Cristian Elihu Chavez Salinas', NULL, NULL, 1),
(8, 'Aureliano Rojas Hernandez', NULL, NULL, 1),
(9, 'Gabriel Alberto Briones Zepeda', NULL, NULL, 1),
(10, 'Miguel Aguilar', NULL, NULL, 1),
(11, 'Daniel Aguilar', NULL, NULL, 1),
(12, 'Jose Gabriel', NULL, NULL, 1),
(13, 'Tomas Ramirez', NULL, NULL, 1),
(14, 'Leonel Jony', NULL, NULL, 1),
(15, 'Armando Lara', NULL, NULL, 1),
(16, 'Antonio Castañeda', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_tipo_folios`
--

CREATE TABLE `c_tipo_folios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_max` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `campo_1` int(11) NOT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `c_tipo_folios`
--

INSERT INTO `c_tipo_folios` (`id`, `descripcion`, `time_max`, `created_at`, `updated_at`, `campo_1`, `estado_id`) VALUES
(1, 'SD', 6, NULL, NULL, 1, 1),
(2, 'OT', 6, NULL, NULL, 2, 1),
(3, 'RFC', 12, NULL, NULL, 2, 1),
(4, 'PRJ', 12, NULL, NULL, 2, 1),
(5, 'OS', 12, NULL, NULL, 2, 1),
(6, 'Otro', 12, NULL, NULL, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_tipo_imagenes`
--

CREATE TABLE `c_tipo_imagenes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `c_tipo_imagenes`
--

INSERT INTO `c_tipo_imagenes` (`id`, `descripcion`, `estado_id`, `created_at`, `updated_at`) VALUES
(1, 'imagen_antes', 1, NULL, NULL),
(2, 'imagen_durante', 1, NULL, NULL),
(3, 'imagen_despues', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_turnos`
--

CREATE TABLE `c_turnos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `c_turnos`
--

INSERT INTO `c_turnos` (`id`, `descripcion`, `created_at`, `updated_at`, `estado_id`) VALUES
(4, 'Dia', NULL, NULL, 1),
(5, 'Noche', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_analisis`
--

CREATE TABLE `d_analisis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `folio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tfolio_id` bigint(20) UNSIGNED NOT NULL,
  `turno_id` bigint(20) UNSIGNED NOT NULL,
  `distrito_id` bigint(20) UNSIGNED NOT NULL,
  `cluster_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `falla_id` bigint(20) UNSIGNED NOT NULL,
  `causa_id` bigint(20) UNSIGNED NOT NULL,
  `OT` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clientes_afectados` int(11) NOT NULL,
  `despacho_id` bigint(20) UNSIGNED NOT NULL,
  `supervisor_id` bigint(20) UNSIGNED NOT NULL,
  `tecnico_id` bigint(20) UNSIGNED NOT NULL,
  `estatus_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_folio` int(10) UNSIGNED DEFAULT NULL,
  `olt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_calc_tiempos`
--

CREATE TABLE `d_calc_tiempos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `folio_id` bigint(20) UNSIGNED NOT NULL,
  `asignacion_ios` datetime NOT NULL,
  `llegada` datetime DEFAULT NULL,
  `activacion` datetime DEFAULT NULL,
  `eta` time DEFAULT NULL,
  `sla` time DEFAULT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_imagenes`
--

CREATE TABLE `d_imagenes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `folio_id` bigint(20) UNSIGNED NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `timagen_id` bigint(20) UNSIGNED NOT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_materiales`
--

CREATE TABLE `d_materiales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `folio_id` bigint(20) UNSIGNED NOT NULL,
  `material_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_pausados`
--

CREATE TABLE `d_pausados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `folio_id` bigint(20) UNSIGNED NOT NULL,
  `justificacion_id` bigint(20) UNSIGNED NOT NULL,
  `tiempo_muerto` int(11) NOT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_seguimientos`
--

CREATE TABLE `d_seguimientos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `folio_id` bigint(20) UNSIGNED NOT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_ubicaciones`
--

CREATE TABLE `d_ubicaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `folio_id` bigint(20) UNSIGNED NOT NULL,
  `latitud` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitud` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `c_causas`
--
ALTER TABLE `c_causas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_causas_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `c_clusters`
--
ALTER TABLE `c_clusters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_clusters_distrito_id_foreign` (`distrito_id`),
  ADD KEY `c_clusters_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `c_despachos`
--
ALTER TABLE `c_despachos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_despachos_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `c_distritos`
--
ALTER TABLE `c_distritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_distritos_supervisor_id_foreign` (`supervisor_id`),
  ADD KEY `c_distritos_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `c_estados`
--
ALTER TABLE `c_estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `c_estatus`
--
ALTER TABLE `c_estatus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_estatus_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `c_fallas`
--
ALTER TABLE `c_fallas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_fallas_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `c_justificacion_pausas`
--
ALTER TABLE `c_justificacion_pausas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_justificacion_pausas_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `c_logs_usuarios`
--
ALTER TABLE `c_logs_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_logs_usuarios_usuario_id_foreign` (`usuario_id`),
  ADD KEY `c_logs_usuarios_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `c_materiales`
--
ALTER TABLE `c_materiales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_materiales_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `c_rol_usuario`
--
ALTER TABLE `c_rol_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_rol_usuario_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `c_supervisors`
--
ALTER TABLE `c_supervisors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_supervisors_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `c_tecnicos`
--
ALTER TABLE `c_tecnicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_tecnicos_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `c_tipo_folios`
--
ALTER TABLE `c_tipo_folios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_tipo_folios_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `c_tipo_imagenes`
--
ALTER TABLE `c_tipo_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_tipo_imagenes_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `c_turnos`
--
ALTER TABLE `c_turnos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_turnos_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `d_analisis`
--
ALTER TABLE `d_analisis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `d_analisis_tfolio_id_foreign` (`tfolio_id`),
  ADD KEY `d_analisis_turno_id_foreign` (`turno_id`),
  ADD KEY `d_analisis_distrito_id_foreign` (`distrito_id`),
  ADD KEY `d_analisis_cluster_id_foreign` (`cluster_id`),
  ADD KEY `d_analisis_falla_id_foreign` (`falla_id`),
  ADD KEY `d_analisis_causa_id_foreign` (`causa_id`),
  ADD KEY `d_analisis_despacho_id_foreign` (`despacho_id`),
  ADD KEY `d_analisis_supervisor_id_foreign` (`supervisor_id`),
  ADD KEY `d_analisis_tecnico_id_foreign` (`tecnico_id`),
  ADD KEY `d_analisis_estatus_id_foreign` (`estatus_id`),
  ADD KEY `d_analisis_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `d_calc_tiempos`
--
ALTER TABLE `d_calc_tiempos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `d_calc_tiempos_folio_id_foreign` (`folio_id`),
  ADD KEY `d_calc_tiempos_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `d_imagenes`
--
ALTER TABLE `d_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `d_imagenes_folio_id_foreign` (`folio_id`),
  ADD KEY `d_imagenes_estado_id_foreign` (`estado_id`),
  ADD KEY `d_imagenes_tipo_imagenes_id_foreign` (`timagen_id`) USING BTREE;

--
-- Indices de la tabla `d_materiales`
--
ALTER TABLE `d_materiales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `d_materiales_material_id_foreign` (`material_id`),
  ADD KEY `d_materiales_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `d_pausados`
--
ALTER TABLE `d_pausados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `d_pausados_folio_id_foreign` (`folio_id`),
  ADD KEY `d_pausados_justificacion_id_foreign` (`justificacion_id`),
  ADD KEY `d_pausados_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `d_seguimientos`
--
ALTER TABLE `d_seguimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `d_seguimientos_folio_id_foreign` (`folio_id`),
  ADD KEY `d_seguimientos_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `d_ubicaciones`
--
ALTER TABLE `d_ubicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `d_ubicaciones_folio_id_foreign` (`folio_id`),
  ADD KEY `d_ubicaciones_estado_id_foreign` (`estado_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `c_causas`
--
ALTER TABLE `c_causas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `c_clusters`
--
ALTER TABLE `c_clusters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `c_despachos`
--
ALTER TABLE `c_despachos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `c_distritos`
--
ALTER TABLE `c_distritos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `c_estados`
--
ALTER TABLE `c_estados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `c_estatus`
--
ALTER TABLE `c_estatus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `c_fallas`
--
ALTER TABLE `c_fallas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `c_justificacion_pausas`
--
ALTER TABLE `c_justificacion_pausas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `c_logs_usuarios`
--
ALTER TABLE `c_logs_usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `c_materiales`
--
ALTER TABLE `c_materiales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `c_rol_usuario`
--
ALTER TABLE `c_rol_usuario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `c_supervisors`
--
ALTER TABLE `c_supervisors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `c_tecnicos`
--
ALTER TABLE `c_tecnicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `c_tipo_folios`
--
ALTER TABLE `c_tipo_folios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `c_tipo_imagenes`
--
ALTER TABLE `c_tipo_imagenes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `c_turnos`
--
ALTER TABLE `c_turnos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `d_analisis`
--
ALTER TABLE `d_analisis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `d_calc_tiempos`
--
ALTER TABLE `d_calc_tiempos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `d_imagenes`
--
ALTER TABLE `d_imagenes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `d_materiales`
--
ALTER TABLE `d_materiales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `d_pausados`
--
ALTER TABLE `d_pausados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `d_seguimientos`
--
ALTER TABLE `d_seguimientos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `d_ubicaciones`
--
ALTER TABLE `d_ubicaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `c_causas`
--
ALTER TABLE `c_causas`
  ADD CONSTRAINT `c_causas_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`);

--
-- Filtros para la tabla `c_clusters`
--
ALTER TABLE `c_clusters`
  ADD CONSTRAINT `c_clusters_distrito_id_foreign` FOREIGN KEY (`distrito_id`) REFERENCES `c_distritos` (`id`),
  ADD CONSTRAINT `c_clusters_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`);

--
-- Filtros para la tabla `c_despachos`
--
ALTER TABLE `c_despachos`
  ADD CONSTRAINT `c_despachos_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`);

--
-- Filtros para la tabla `c_distritos`
--
ALTER TABLE `c_distritos`
  ADD CONSTRAINT `c_distritos_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`),
  ADD CONSTRAINT `c_distritos_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `c_supervisors` (`id`);

--
-- Filtros para la tabla `c_estatus`
--
ALTER TABLE `c_estatus`
  ADD CONSTRAINT `c_estatus_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`);

--
-- Filtros para la tabla `c_fallas`
--
ALTER TABLE `c_fallas`
  ADD CONSTRAINT `c_fallas_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`);

--
-- Filtros para la tabla `c_justificacion_pausas`
--
ALTER TABLE `c_justificacion_pausas`
  ADD CONSTRAINT `c_justificacion_pausas_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`);

--
-- Filtros para la tabla `c_logs_usuarios`
--
ALTER TABLE `c_logs_usuarios`
  ADD CONSTRAINT `c_logs_usuarios_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`),
  ADD CONSTRAINT `c_logs_usuarios_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `c_materiales`
--
ALTER TABLE `c_materiales`
  ADD CONSTRAINT `c_materiales_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`);

--
-- Filtros para la tabla `c_rol_usuario`
--
ALTER TABLE `c_rol_usuario`
  ADD CONSTRAINT `c_rol_usuario_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`);

--
-- Filtros para la tabla `c_supervisors`
--
ALTER TABLE `c_supervisors`
  ADD CONSTRAINT `c_supervisors_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`);

--
-- Filtros para la tabla `c_tecnicos`
--
ALTER TABLE `c_tecnicos`
  ADD CONSTRAINT `c_tecnicos_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`);

--
-- Filtros para la tabla `c_tipo_folios`
--
ALTER TABLE `c_tipo_folios`
  ADD CONSTRAINT `c_tipo_folios_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`);

--
-- Filtros para la tabla `c_tipo_imagenes`
--
ALTER TABLE `c_tipo_imagenes`
  ADD CONSTRAINT `c_tipo_imagenes_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`);

--
-- Filtros para la tabla `c_turnos`
--
ALTER TABLE `c_turnos`
  ADD CONSTRAINT `c_turnos_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`);

--
-- Filtros para la tabla `d_analisis`
--
ALTER TABLE `d_analisis`
  ADD CONSTRAINT `d_analisis_causa_id_foreign` FOREIGN KEY (`causa_id`) REFERENCES `c_causas` (`id`),
  ADD CONSTRAINT `d_analisis_cluster_id_foreign` FOREIGN KEY (`cluster_id`) REFERENCES `c_clusters` (`id`),
  ADD CONSTRAINT `d_analisis_despacho_id_foreign` FOREIGN KEY (`despacho_id`) REFERENCES `c_despachos` (`id`),
  ADD CONSTRAINT `d_analisis_distrito_id_foreign` FOREIGN KEY (`distrito_id`) REFERENCES `c_distritos` (`id`),
  ADD CONSTRAINT `d_analisis_estatus_id_foreign` FOREIGN KEY (`estatus_id`) REFERENCES `c_estatus` (`id`),
  ADD CONSTRAINT `d_analisis_falla_id_foreign` FOREIGN KEY (`falla_id`) REFERENCES `c_fallas` (`id`),
  ADD CONSTRAINT `d_analisis_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `c_supervisors` (`id`),
  ADD CONSTRAINT `d_analisis_tecnico_id_foreign` FOREIGN KEY (`tecnico_id`) REFERENCES `c_tecnicos` (`id`),
  ADD CONSTRAINT `d_analisis_tfolio_id_foreign` FOREIGN KEY (`tfolio_id`) REFERENCES `c_tipo_folios` (`id`),
  ADD CONSTRAINT `d_analisis_turno_id_foreign` FOREIGN KEY (`turno_id`) REFERENCES `c_turnos` (`id`),
  ADD CONSTRAINT `d_analisis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `d_calc_tiempos`
--
ALTER TABLE `d_calc_tiempos`
  ADD CONSTRAINT `d_calc_tiempos_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`),
  ADD CONSTRAINT `d_calc_tiempos_folio_id_foreign` FOREIGN KEY (`folio_id`) REFERENCES `d_analisis` (`id`);

--
-- Filtros para la tabla `d_imagenes`
--
ALTER TABLE `d_imagenes`
  ADD CONSTRAINT `d_imagenes_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`),
  ADD CONSTRAINT `d_imagenes_folio_id_foreign` FOREIGN KEY (`folio_id`) REFERENCES `d_analisis` (`id`),
  ADD CONSTRAINT `d_imagenes_tipo_imagenes_id_foreign` FOREIGN KEY (`timagen_id`) REFERENCES `c_tipo_imagenes` (`id`);

--
-- Filtros para la tabla `d_materiales`
--
ALTER TABLE `d_materiales`
  ADD CONSTRAINT `d_materiales_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`),
  ADD CONSTRAINT `d_materiales_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `c_materiales` (`id`);

--
-- Filtros para la tabla `d_pausados`
--
ALTER TABLE `d_pausados`
  ADD CONSTRAINT `d_pausados_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`),
  ADD CONSTRAINT `d_pausados_folio_id_foreign` FOREIGN KEY (`folio_id`) REFERENCES `d_analisis` (`id`),
  ADD CONSTRAINT `d_pausados_justificacion_id_foreign` FOREIGN KEY (`justificacion_id`) REFERENCES `c_justificacion_pausas` (`id`);

--
-- Filtros para la tabla `d_seguimientos`
--
ALTER TABLE `d_seguimientos`
  ADD CONSTRAINT `d_seguimientos_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`),
  ADD CONSTRAINT `d_seguimientos_folio_id_foreign` FOREIGN KEY (`folio_id`) REFERENCES `d_analisis` (`id`);

--
-- Filtros para la tabla `d_ubicaciones`
--
ALTER TABLE `d_ubicaciones`
  ADD CONSTRAINT `d_ubicaciones_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `c_estados` (`id`),
  ADD CONSTRAINT `d_ubicaciones_folio_id_foreign` FOREIGN KEY (`folio_id`) REFERENCES `d_analisis` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
