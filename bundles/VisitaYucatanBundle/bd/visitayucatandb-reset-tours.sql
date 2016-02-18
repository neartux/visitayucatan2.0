-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-02-2016 a las 06:27:52
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `visitayucatandb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_personales`
--

CREATE TABLE IF NOT EXISTS `datos_personales` (
  `id` int(11) NOT NULL,
  `nombres` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `datos_personales`
--

INSERT INTO `datos_personales` (`id`, `nombres`, `apellidos`) VALUES
(1, 'Gabino', 'Martinez'),
(2, 'Felipe', 'Capetillo'),
(3, 'Jorge', 'Aguilar'),
(4, 'Ricardo', 'Dzul');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_ubicacion`
--

CREATE TABLE IF NOT EXISTS `datos_ubicacion` (
  `id` int(11) NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigopostal` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `datos_ubicacion`
--

INSERT INTO `datos_ubicacion` (`id`, `direccion`, `codigopostal`, `telefono`, `celular`, `email`) VALUES
(1, NULL, NULL, NULL, NULL, 'gmartinez@visitayucatan.com'),
(2, NULL, NULL, NULL, NULL, 'fcapetilloc@visitayucatan.com'),
(3, NULL, NULL, NULL, NULL, 'jaguilar.concytey@gmail.com'),
(4, NULL, NULL, NULL, NULL, 'near31_3112@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destino`
--

CREATE TABLE IF NOT EXISTS `destino` (
  `id` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `destino`
--

INSERT INTO `destino` (`id`, `id_estatus`, `descripcion`) VALUES
(1, 1, 'Merida'),
(2, 1, 'Cancun'),
(3, 1, 'Campeche');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE IF NOT EXISTS `estatus` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`id`, `descripcion`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel`
--

CREATE TABLE IF NOT EXISTS `hotel` (
  `id` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `id_datosubicacion` int(11) NOT NULL,
  `id_destino` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `estrellas` int(11) NOT NULL,
  `promovido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel_contacto`
--

CREATE TABLE IF NOT EXISTS `hotel_contacto` (
  `id` int(11) NOT NULL,
  `id_datospersonales` int(11) NOT NULL,
  `id_datosubicacion` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel_idioma`
--

CREATE TABLE IF NOT EXISTS `hotel_idioma` (
  `id` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `id_idioma` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `nombrehotel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel_imagen`
--

CREATE TABLE IF NOT EXISTS `hotel_imagen` (
  `id` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `nombreoriginal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipoarchivo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `folio` int(11) NOT NULL,
  `fechacreacion` datetime NOT NULL,
  `principal` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idioma`
--

CREATE TABLE IF NOT EXISTS `idioma` (
  `id` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `abreviatura` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `idioma`
--

INSERT INTO `idioma` (`id`, `id_estatus`, `descripcion`, `abreviatura`, `imagen`) VALUES
(1, 1, 'Español', 'ESP', NULL),
(2, 1, 'English', 'ENG', NULL),
(3, 1, 'Italiano', 'ITA', NULL),
(4, 1, 'Frances', 'FRA', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

CREATE TABLE IF NOT EXISTS `moneda` (
  `id` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `simbolo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_cambio` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `moneda`
--

INSERT INTO `moneda` (`id`, `id_estatus`, `descripcion`, `simbolo`, `tipo_cambio`) VALUES
(1, 1, 'Peso Mexicano', 'MXP', 1),
(2, 1, 'Dolar Americano', 'USD', 16.5),
(3, 1, 'Euro', '$', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `origen`
--

CREATE TABLE IF NOT EXISTS `origen` (
  `id` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `origen`
--

INSERT INTO `origen` (`id`, `id_estatus`, `descripcion`) VALUES
(1, 1, 'Merida'),
(2, 1, 'Cancun');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagina`
--

CREATE TABLE IF NOT EXISTS `pagina` (
  `id` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagina_descripcion`
--

CREATE TABLE IF NOT EXISTS `pagina_descripcion` (
  `id` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `descripcion_corta` longtext COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagina_imagen`
--

CREATE TABLE IF NOT EXISTS `pagina_imagen` (
  `id` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `nombre_original` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_archivo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `folio` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagina_imagen_descripcion`
--

CREATE TABLE IF NOT EXISTS `pagina_imagen_descripcion` (
  `id` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE IF NOT EXISTS `paquete` (
  `id` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `circuito` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `promovido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete_combinacion_hotel`
--

CREATE TABLE IF NOT EXISTS `paquete_combinacion_hotel` (
  `id` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `noches` int(11) NOT NULL,
  `dias` int(11) NOT NULL,
  `costosencillo` double NOT NULL,
  `costodoble` double NOT NULL,
  `costotriple` double NOT NULL,
  `costocuadruple` double NOT NULL,
  `costomenor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete_idioma`
--

CREATE TABLE IF NOT EXISTS `paquete_idioma` (
  `id` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `id_idioma` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcioncorta` longtext COLLATE utf8_unicode_ci NOT NULL,
  `descripcionlarga` longtext COLLATE utf8_unicode_ci NOT NULL,
  `incluye` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete_imagen`
--

CREATE TABLE IF NOT EXISTS `paquete_imagen` (
  `id` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `nombreoriginal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipoarchivo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `folio` int(11) NOT NULL,
  `fechacreacion` datetime NOT NULL,
  `principal` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete_itinerario`
--

CREATE TABLE IF NOT EXISTS `paquete_itinerario` (
  `id` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `id_idioma` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `itinerario` longtext COLLATE utf8_unicode_ci NOT NULL,
  `dias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tour`
--

CREATE TABLE IF NOT EXISTS `tour` (
  `id` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `minimopersonas` int(11) NOT NULL,
  `promovido` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tour`
--

INSERT INTO `tour` (`id`, `id_estatus`, `descripcion`, `minimopersonas`, `promovido`) VALUES
(1, 1, 'Campeche Ciudad Amurallada', 1, 0),
(2, 1, 'Celestún', 1, 1),
(3, 1, 'Cenotes Cuzamá', 1, 1),
(4, 1, 'Cenotes Cuzamá e Izamal', 1, 1),
(5, 1, 'Chichén-Itzá', 1, 0),
(6, 1, 'Chichén-Itzá continuación Cancún', 1, 0),
(7, 1, 'Chichén-Itzá continuación Riviera Maya', 1, 0),
(8, 1, 'Chichén-Itzá e Izamal', 1, 0),
(9, 1, 'Izamal Pueblo Mágico', 4, 1),
(10, 1, 'Ruta Puuc', 4, 0),
(11, 1, 'Uxmal Light & Sound', 1, 1),
(12, 1, 'Uxmal-Kabah', 1, 0),
(13, 1, 'Uxmal-Museo del Chocolate', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tour_idioma`
--

CREATE TABLE IF NOT EXISTS `tour_idioma` (
  `id` int(11) NOT NULL,
  `id_tour` int(11) NOT NULL,
  `id_idioma` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `nombretour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `circuito` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `soloadultos` tinyint(1) NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tour_idioma`
--

INSERT INTO `tour_idioma` (`id`, `id_tour`, `id_idioma`, `id_estatus`, `nombretour`, `circuito`, `soloadultos`, `descripcion`) VALUES
(1, 1, 1, 1, 'Campeche Ciudad Amurallada', 'Mérida-Campeche-Mérida (Mínimo 4 Pax)', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">A las 8:00 de la mañana pasaremos por usted a su Hotel para emprender el rumbo hacia el vecino estado de Campeche, donde conoceremos su hermosa capital, la ciudad de San Francisco de Campeche, fundada en 1541 por Francisco de Montejo; la cual sufrió por décadas el asedio de los piratas, lo que originó la construcción de fortalezas y baluartes para resistir estos ataques. En este viaje podrá conocer el Fuerte de San Miguel, el Fuerte de Santiago, el baluarte de San Juan, La puerta de Tierra y la Puerta del mar, el Centro Histórico y su Hermosa Catedral, terminaremos la visita con una comida recomendando alguno de sus famosos Restaurantes, y a la hora conveniente regresaremos a Mérida.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Incluye: Transporte con aire acondicionado, guía, admisión Museo.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">No incluye: Comida y propinas</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p data-mce-style="text-align: right;" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal; text-align: right;">(Opera en Base a 4 pasajeros)</p>'),
(2, 1, 2, 1, 'Walled city of Campeche', 'Mérida-Campeche-Mérida (Mínimo 4 Pax)', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">At 8:00am we will pick you up at you hotel to start our tour towards the neighbor state of Campeche to get a glance of its beautiful capital, the city of San Francisco of Campeche, founded in 1541 by Francisco de Montejo, the same city that suffered by decades the pirates’ attack, which originated the construction of fortresses and strongholds to hold back those attacks. In this trip you will see the Fort of San Miguel, the Fort of Santiago, the San Juan Stronghold, The door of the Land and the door of the Ocean, the historic center and its beautiful Cathedral.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">We will finish the visit with a meal in one of the famous folkloric Restaurants of Campeche. We´ll return to Mérida at the end of the Meal.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Includes: Transportation with air condition, Tour Guide, Admission Fee to the Museum.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Does Not Include: Meal, Beverages, and Tips.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p data-mce-style="text-align: right;" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal; text-align: right;">(Operates with a minimum of 4 People)</p>'),
(3, 1, 3, 1, 'La ciudad amurallada de Campeche', 'Mérida-Campeche-Mérida (Mínimo 4 Pax)', 0, '<p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Partiremo dall’albergo alle 8,00 a.m., verso il vicino Stato di Campeche, per conoscere il bellissimo capoluogo, la città di San Francesco di Campeche, fondata nel 1541 da Fransisco de Montejo, che soffrì per molte decade l’assedio dei pirati, il che fece che si costruisse la fortezza per resistere gli attacchi. Potrete conoscere il Fuerte de San Miguel, el Fuerte de Santiago, el Baluarte de San Juan, La Puerta de Tierra y la Puerta del Mar, il centro Storico e la bellissima Cattedrale. Concluderemo la nostra visita con il pranzo, che potrete realizare in uno dei ristoranti da noi raccomandati. Ritorno a Mérida</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Il prezzo comprende: Trasporto climatizzato, guida, ingresso al Museo.</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Non sono compresi nel prezzo: pranzo e mance.</p>'),
(4, 1, 4, 1, 'Cité fortifiée de Campeche', 'Mérida-Campeche-Mérida (Mínimo 4 Pax)', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Départ de l''hôtel à 08h00, en direction de l''Etat voisin de Campeche afin de visiter sa belle capitale de San Francisco de Campeche, fondée en 1541 par Francisco de Montejo , qui a souffert pendant des décennies des attaques de pirates , ce qui a conduit à la construction de forts et de bastions afin de résister à ces agressions. Durant ce voyage , nous découvrirons le Fort San Miguel, le Fort Santiago, la forteresse de San Juan, la Puerta de Tierra et la Puerta del Mar, le centre historique et sa magnifique cathédrale, nous finirons la visite par un repas dans un des restaurants de la ville que nous vous aurons recommandé, et à l’heure prévue nous retournerons vers Merida.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Inclus : Transport avec Air conditionné, le guide, l''entrée au musée et taxes</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Non inclus: nourriture et pourboires</p>'),
(5, 2, 1, 1, 'Celestún', 'Mérida-Celestún-Mérida', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">A las 9:00 de la mañana, pasaremos por usted a su hotel para salir con rumbo a este puerto de pescadores en donde existe un estero o ría, que sirve de refugio a una gran cantidad de aves, de las cuales predomina la especie de los Flamencos Rosados; en este lugar abordaremos un bote y daremos un paseo por los manglares y el ojo de agua. Una vez terminado el paseo, iremos al pueblo donde comeremos en un pintoresco restaurante local, para que disfrute de una rica botana y un filete de pescado al gusto, en este lugar también podrá disfrutar de la playa.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Incluye: Transportación, Guía, Paseo en Lancha, Comida.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">No Incluye: Bebidas con los alimentos ni Propinas.&nbsp;&nbsp;&nbsp;&nbsp;</strong></p>'),
(6, 2, 2, 1, 'Celestún', 'Mérida-Celestún-Mérida', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">At 9:00am we will pick you up at your hotel and head to the Celestún biosphere, where, once there, we’ll take a boat and ride to admire the beauty of all the different species of birds that cohabit in this magical place, amongst them the Pink Flamenco. We will also visit the mangroves, stopping at the “ojo de agua” (Eye of Water) to take a refreshing swim. Afterwards we’ll go to the beach, also in Celestún, to enjoy the ocean view and a sea food based meal. Then we’ll head back to Mérida.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Includes: Transportation, Tour Guide, Boat Ride, and Meal.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Does NOT Include: Beverages, Tips.</strong></p>'),
(7, 2, 3, 1, 'Celestún', 'Mérida-Celestún-Mérida', 0, '<p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Alle 9,00 a.m. verremo a prendervi in albergo per accompagnarvi in questo porto di pescatori, dove potremo vedere una ria che serve da rifugio a una gran quantità di fenicotteri rosa, saliremo in una barca per fare una gita nel mangle e nella sorgente d’acqua. Dopo la gita vi porteremo nel villaggio dove pranzeremo in un ristorante; un delizioso filetto di pesce al gusto. Potrete anche fare due passi sulla spiaggia.</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Il Prezzo comprende: Trasporto, Guida, Gita in barca e pranzo.</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Non sono comprese nel prezzo: bibite e mance.</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p>'),
(8, 2, 4, 1, 'Celestun biosphère', 'Mérida-Celestún-Mérida', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">A 09h00, nous viendrons vous chercher à votre hôtel pour aller dans la direction de ce port de pêche</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">où vous découvrirez un lac qui sert de refuge à un grand nombre d''espèces d''oiseaux parmi lesquels dominent les flamants roses. Puis à bord d''un bateau vous ferez une promenade à travers la mangrove et le ojo de agua. Après la promenade nous vous emmènerons au village où nous vous recommanderons un restaurant afin de profiter d''une bonne collation et de bons filets de poisson, vous pourrez également profiter de la plage .</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Inclus : transport, guide, promenades en bateau, la nourriture et taxes</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Non inclus: boissons avec la nourriture et pourboire.</p>'),
(9, 3, 1, 1, 'Cenotes Cuzamá', 'Mérida-Cuzamá-Merida', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">A las 9:00 de la mañana pasaremos por usted a su hotel para iniciar nuestro recorrido hacia el tour de cenotes, pasando en el trayecto por varios poblados y haciendas en ruinas que algún día fueron un cimiento importante de la economía de Yucatán. Al llegar al lugar de los cenotes, abordaremos un truck (plataforma tirada por una mula) en el cual recorreremos 9 kilómetros a través de antiguos plantíos henequeneros, teniendo la posibilidad de nadar en dos de los tres cenotes. Después de nadar, iremos a comer para posteriormente retornar a Mérida, llegando aproximadamente a las 16:00 horas.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Incluye: transportación, Guía, Truck, Comida e Impuestos.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">No&nbsp;</strong><strong style="margin: 0px; padding: 0px;">Incluye: Bebidas, Propina.</strong></p>'),
(10, 3, 2, 1, 'Cenotes Cuzamá', 'Mérida-Cuzamá-Merida', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">At 9:00am we´ll pick you up at your Hotel to begin the tour towards the cenotes, on the way we will pass through several settlements and old haciendas, which used to form a big part of the Yucatan´s economy. Once in the Cenotes we will board a “Truck” (Which is a platform pulled by a mule) on which we will travel 9 kilometer into old Henequen plantations and to the cenotes, where we will be able to swim in two of the three cenotes. After swimming we will go to a restaurant there to have lunch, to afterwards return to Merida at around 16:00 in the afternoon.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Includes: Transportation on a van, Tour Guide, Food and Taxes.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Does NOT Include: Beverages, Tips.</strong></p>'),
(11, 3, 4, 1, 'Cenotes Cuzama', 'Mérida-Cuzamá-Merida', 0, '<span style="color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">À 9:00 du matin, nous viendrons vous chercher à votre hôtel pour commencer notre voyage vers les cenotes lors de notre route nous passerons à travers plusieurs villages et fermes en ruine qui ont eu une place importante dans l''économie du Yucatán . A l’arrivée nous aborderons un TRUCK ( plate-forme tirée par un mulet ) qui nous tirera sur &nbsp;9 kilomètres à travers de vieilles plantations de hennequen et si vous être encore capable, vous pourrez nager dans deux des trois cenotes . Après la baignade, sur le chemin du retour, nous nous arrêterons manger. Retour prévu vers 16h00 heures.</span>'),
(12, 3, 3, 1, 'Cenotes Cuzama', 'Mérida-Cuzamá-Merida', 0, ''),
(13, 4, 1, 1, 'Cenotes Cuzamá e Izamal', 'Mérida-Cuzamá-Izamal-Mérida', 0, '<p align="center" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">OPERA SÁBADOS CON SALIDAS GARANTIZADAS</p><p align="center" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">A las 9:00 de la mañana pasaremos por usted a su hotel para iniciar nuestro recorrido hacia el tour de cenotes, pasando en el trayecto por varios poblados y haciendas en ruinas que algún día fueron un cimiento importante de la economía de Yucatán. Al llegar al lugar de los cenotes, abordaremos un truck (plataforma tirada por una mula) en el cual recorreremos 9 kilómetros a través de antiguos plantíos henequeneros, teniendo la posibilidad de nadar en dos de los tres cenotes.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Después de nadar,&nbsp; saldremos con rumbo al Pueblo Mágico de Izamal, ciudad pintada de amarillo, y también llamada la de las Tres Culturas, por reunir las etapas prehispánica, colonial y contemporánea. Visitaremos la pirámide Kinich Kakmo, el Convento Franciscano de San Antonio de Padua, en el cual podrá admirar la extraordinaria arquería de su atrio, el más grande de américa y sólo superado por La Plaza de San Pedro en Roma y en donde el Papa Juna Pablo II se reunió con las comunidades indígenas de América Latina, admiraremos las clásicas proporciones de su iglesia, daremos un paseo en calesa alrededor de la plaza y los principales puntos de interés, para posteriormente retornar a Mérida.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Incluye:&nbsp;Transportación con aire acondicionado, guía, paseo en truck y paseo en calesa, e Impuestos.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">No Incluye: Alimentos, Bebidas y Propinas.</strong></p>'),
(14, 4, 2, 1, 'Cuzamá Cenotes & Izamal', 'Mérida-Cuzamá-Izamal-Mérida', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">At 9:00am we´ll pick you up at your Hotel to begin the tour towards the cenotes, on the way we will pass through several settlements and old haciendas, which used to form a big part of the Yucatan´s economy. Once in the Cenotes we will board a “Truck” (Which is a platform pulled by a mule) on which we will travel 9 kilometer into old Henequen plantations and to the cenotes, where we will be able to swim in two of the three cenotes.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">After swimming we will take the van once more and head towards The Magic Town of Izamal, the yellow painted city, and also known as the city of the three cultures for uniting the Pre-Hispanic era, the Colonial era, and the Contemporary era. We will visit the Kinich Kakmo, the San Antonio de Padua´s convent where we will be able to admire the extraordinary atrium arch, the largest in America, and only second to largest in the world, just behind the one in St. Peter´s Plaza in Rome, and also where the pope Saint John Paul II met with the native communities of Latin America, we will also admire the Classical proportions of its church, and take a ride in a Carriage around the main square and the main points of interest, to afterwards return to Merida.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Includes: Transportation on a van, Tour Guide, Truck Ride, and the Carriage Ride, and Taxes.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Does NOT Include: Food, Beverages, and Tips.</strong></p>'),
(15, 5, 1, 1, 'Chichén-Itzá', 'Mérida - Chichén-Itzá - Mérida', 0, '<p align="center" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">OPERA SÁBADOS CON SALIDAS GARANTIZADAS</p><p align="center" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">A las 9:00 de la mañana pasaremos por usted a su hotel para iniciar nuestro recorrido hacia el tour de cenotes, pasando en el trayecto por varios poblados y haciendas en ruinas que algún día fueron un cimiento importante de la economía de Yucatán. Al llegar al lugar de los cenotes, abordaremos un truck (plataforma tirada por una mula) en el cual recorreremos 9 kilómetros a través de antiguos plantíos henequeneros, teniendo la posibilidad de nadar en dos de los tres cenotes.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Después de nadar,&nbsp; saldremos con rumbo al Pueblo Mágico de Izamal, ciudad pintada de amarillo, y también llamada la de las Tres Culturas, por reunir las etapas prehispánica, colonial y contemporánea. Visitaremos la pirámide Kinich Kakmo, el Convento Franciscano de San Antonio de Padua, en el cual podrá admirar la extraordinaria arquería de su atrio, el más grande de américa y sólo superado por La Plaza de San Pedro en Roma y en donde el Papa Juna Pablo II se reunió con las comunidades indígenas de América Latina, admiraremos las clásicas proporciones de su iglesia, daremos un paseo en calesa alrededor de la plaza y los principales puntos de interés, para posteriormente retornar a Mérida.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Incluye:&nbsp;Transportación con aire acondicionado, guía, paseo en truck y paseo en calesa, e Impuestos.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">No Incluye: Alimentos, Bebidas y Propinas.</strong></p>'),
(16, 5, 2, 1, 'Cuzamá Cenotes & Izamal', 'Cuzamá Cenotes & Izamal', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">At 9:00am we´ll pick you up at your Hotel to begin the tour towards the cenotes, on the way we will pass through several settlements and old haciendas, which used to form a big part of the Yucatan´s economy. Once in the Cenotes we will board a “Truck” (Which is a platform pulled by a mule) on which we will travel 9 kilometer into old Henequen plantations and to the cenotes, where we will be able to swim in two of the three cenotes.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">After swimming we will take the van once more and head towards The Magic Town of Izamal, the yellow painted city, and also known as the city of the three cultures for uniting the Pre-Hispanic era, the Colonial era, and the Contemporary era. We will visit the Kinich Kakmo, the San Antonio de Padua´s convent where we will be able to admire the extraordinary atrium arch, the largest in America, and only second to largest in the world, just behind the one in St. Peter´s Plaza in Rome, and also where the pope Saint John Paul II met with the native communities of Latin America, we will also admire the Classical proportions of its church, and take a ride in a Carriage around the main square and the main points of interest, to afterwards return to Merida.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Includes: Transportation on a van, Tour Guide, Truck Ride, and the Carriage Ride, and Taxes.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Does NOT Include: Food, Beverages, and Tips.</strong></p>'),
(17, 6, 1, 1, 'Chichén-Itzá continuación Cancún', 'Mérida - Chichén - Cancún', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><span style="margin: 0px; padding: 0px;">A las 09:00 de la mañana, pasaremos por usted a su hotel para&nbsp;</span><span style="margin: 0px; padding: 0px;">dirigirnos a la zona arqueológica, de Chichén Itzá considerada el centro más grande y más importante de los mayas tendremos una visita guiada a los puntos más importantes como: el Castillo, el Juego de Pelota, el Cenote Sagrado, el O</span><span style="margin: 0px; padding: 0px;">bservatorio etc. Después del recorrido tendremos una comida bufete en el restaurante turístico, posteriormente&nbsp;</span><span style="margin: 0px; padding: 0px;">continuaremos a Cancún para dejarle en su hotel o en la terminal de autobuses llegada a Cancún aproximadamente&nbsp;<span style="margin: 0px; padding: 0px;">a las 18:30 hrs.</span></span></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Incluye: Transportación, Guía, Admsiones, Comida, traslado de Chichén-Itza a Cancún e impuestos.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">No Incluye:&nbsp;<strong style="margin: 0px; padding: 0px;">Admisiones, Bebidas con los alimentos, Propinas.</strong></strong></p>'),
(18, 6, 2, 1, 'Chichén-Itzá drop-off  Cancún', 'Chichén-Itzá drop-off  Cancún', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">We depart from your hotel at 9:00 hrs, towards the enigmatic archeological zone of Chichen-Itzá, where, once there, the tour guide will show you around the different sites of interest, The enormous castle of Kukulcán, followed by the “Ball Game Court” known for being the biggest one in the Americas, then to the temple of the “Thousand Columns” the sacred Cenote, were beautiful damsels were scarified for the Gods, and Going through the “Observatory” known as the “Caracol” or “Snail” in English. Once done here, you will be transported to a restaurant called “Xaybé” to enjoy a typical mayan meal and to end the day by a bus ride to Cancún and the Hotel of your choosing, all this at around 18:30 hrs.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Includes: Transportation to Chichén, Tour Guide, Meal, Transportation to Cancún and Taxes.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Does not Include:&nbsp;</strong><strong style="margin: 0px; padding: 0px;">Admission Fee,&nbsp;</strong><strong style="margin: 0px; padding: 0px;">Beverages with the meal, Tips.</strong></p>'),
(19, 6, 3, 1, 'Chichén-Itzá continuación Cancún', 'Chichén-Itzá continuación Cancún', 0, '<p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Alle 9,00 a.m. verremo a prendervi in albergo per andare alla zona Archeologica di Chichén Itzá, considerata il centro più grande e importante dei Maya, faremo una visita guidata delle strutture principali: El Castillo, El Juego de Pelota, el Cenote Sagrado, El Observatorio, ecc. dopo la gita, pranzo buffet in un ristorante turistico, posteriormente proseguiremo verso la città di Cancún, dove vi accompagneremo al vostro albergo o nella stazione dei pullman. Arrivo a Cancún, verso le 18,30 ore.</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Il prezzo comprende: trasporto, guida, , pranzo, trasporto Chichén-Itzá a Cancún e tasse.</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Non sono comprese nel prezzo: Ingressi, bibite e mance.</p>'),
(20, 6, 4, 1, 'Chichen Itza vers CANCUN', 'Mérida - Chichén - Cancún', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">A 09h00, nous viendrons vous chercher à votre hôtel pour aller sur le site archéologique de Chichen Itza qui est considéré comme le centre maya plus grand et le plus important. Nous vous offrirons une visite guidée des points forts comme le château , jeu de balle, le Cenote sacré , l''Observatoire etc. Après la visite, nous irons déjeuner dans un restaurant sui offre un buffet, puis nous continuerons vers Cancun afin de vous déposer à votre hôtel ou au terminal de bus. Retour à Cancun prévu vers 18:30.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Inclus : transport, guide, repas, le transfert de Chichen Itza à Cancun et taxes .</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Non inclus: Entrées, boissons et pourboires</p>'),
(21, 7, 1, 1, 'Chichén-Itzá continuación Riviera Maya', 'Mérida-Chichén-Itzá-Riviera Maya', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">A las 09:00 de la mañana, pasaremos por usted a su hotel para&nbsp;dirigirnos a la zona arqueológica, de Chichén Itzá considerada el centro más grande y más importante de los mayas tendremos una visita guiada a los puntos más importantes como: el Castillo, el Juego de Pelota, el Cenote Sagrado, el Observatorio etc. Después del recorrido tendremos una comida bufete en el restaurante turístico, posteriormente&nbsp;continuaremos a la Riviera Maya para dejarle en su hotel.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Incluye: Transportación, Guía, &nbsp;Comida, traslado de Chichén-Itza a la Riviera Maya e impuestos.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">No Incluye:&nbsp;</strong><strong style="margin: 0px; padding: 0px;">Admisiones,</strong><strong style="margin: 0px; padding: 0px;">&nbsp;Bebidas con los alimentos, ni propinas.</strong></p>'),
(22, 7, 2, 1, 'Chichén-Itzá drop-off Riviera Maya', 'Chichén-Itzá drop-off Riviera Maya', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">We depart from your hotel at 9:00 hrs, towards the enigmatic archeological zone of Chichen-Itzá, where, once there, the tour guide will show you around the different sites of interest, The enormous castle of Kukulcán, followed by the “Ball Game Court” known for being the biggest one in the Americas, then to the temple of the “Thousand Columns” the sacred Cenote, were beautiful damsels were scarified for the Gods, and Going through the “Observatory” known as the “Caracol” or “Snail” in English. Once done here, you will be transported to a restaurant called “Xaybé” to enjoy a typical mayan meal and to end the day by a bus ride to the Mayan Riviera and the Hotel of your choosing, all this at around 18:30 hrs.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Includes: Transportation to Chichén, Tour Guide, &nbsp;Meal, Transportation to Cancún and Taxes.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Does not Include:&nbsp;</strong><strong style="margin: 0px; padding: 0px;">Admssion Fee,&nbsp;</strong><strong style="margin: 0px; padding: 0px;">Beverages with the meal, Tips.</strong></p>'),
(23, 7, 3, 1, 'Chichén-Itzá continuación Riviera Maya', 'Mérida-Chichén-Itzá-Riviera Maya', 0, '<p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Alle 9,00 a.m. verremo a prendervi in albergo per andare alla zona Archeologica di Chichén Itzá, considerata il centro più grande e importante dei Maya, faremo una visita guidata delle strutture principali: El Castillo, El Juego de Pelota, el Cenote Sagrado, El Observatorio, ecc. dopo la gita, pranzo buffet in un ristorante turistico, posteriormente proseguiremo verso la Riviera Maya, dove vi accompagneremo al vostro albergo.</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Il prezzo comprende: trasporto, guida, pranzo, trasporto Chichén-Itzá - Riviera Maya e tasse.</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Non sono comprese nel prezzo: Ingressi, bibite e mance.</p>'),
(24, 7, 4, 1, 'Chichen Itza vers RivieraMaya', 'Mérida-Chichén-Itzá-Riviera Maya', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">A 09h00 , nous viendrons vous chercher à votre hôtel pour aller sur le site archéologique de Chichen Itza qui est considéré comme le centre maya plus grand et le plus important, vous bénéficierez d’une visite guidée des points forts comme le château , jeu de balle, le Cenote sacré , l''Observatoire etc. Après la visite, nous irons déjeuner dans un restaurant qui offre un buffet, puis nous retournerons à Riviera Maya afin de vous déposer à votre hôtel.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Inclus : transport, guide, repas, le transfert de Chichen Itza à Riviera Maya et taxes,</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Non inclus: Entrées, les boissons aux repas, les pourboires</p>'),
(25, 8, 1, 1, 'Chichén-Itzá e Izamal', 'Mérida-Chichén-Izamal-Mérida', 0, '<p data-mce-style="text-align: center;" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal; text-align: center;">OPERA DOMINGOS CON SALIDAS GARANTIZADAS</p><p data-mce-style="text-align: center;" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal; text-align: center;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">A las 09:00 de la mañana, pasaremos por usted a su hotel para dirigirnos a esta gran zona arqueológica, considerada el centro ceremonial más grande y más importante de los Mayas tendremos una visita guiada a los puntos más importantes como: El Castillo, el juego de pelota, el Cenote Sagrado, El Observatorio etc. Después del recorrido tendremos una comida bufete en un restaurante turístico y posteriormente saldremos con rumbo al Pueblo Mágico de Izamal, ciudad pintada de amarillo y también llamada de las Tres Culturas por reunir las etapas prehispánica, colonial y contemporánea. Visitaremos la pirámide Kinich Kakmo, el Convento Franciscano de San Antonio de Padua, donde podrá admirar la extraordinaria arquería de su atrio, el más grande de américa y sólo superado por La Plaza de San Pedro en Roma y en donde el Papa Juna Pablo II se reunió con las comunidades indígenas de América Latina, admiraremos las clásicas proporciones de su iglesia, daremos un paseo en calesa alrededor de la plaza y los principales puntos de interés, después de esta visita retornaremos a Mérida.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Incluye:&nbsp;Transportación con aire acondicionado, guía, comida, paseo en calesa.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">No Incluye: Bebidas con los alimentos, Propinas.</p>'),
(26, 9, 1, 1, 'Izamal Pueblo Mágico', 'Mérida-Izamal-Mérida (Mínimo 4 personas)', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><span style="margin: 0px; padding: 0px;">Saldremos de Mérida a las 9:00 a.m. hacia la ciudad colonial de Izamal pintada de amarillo, también llamada de las Tres Culturas por reunir las etapas prehispánica, colonial y contemporánea. Visitaremos la pirámide Kinich Kakmo, el Convento Franciscano de San Antonio de Padua, donde podrá admirar la extraordinaria arquería de su atrio, el más grande de américa y sólo superado por La Plaza de San Pedro en Roma y en donde el Papa Juna Pablo II se reunió con las comunidades indígenas de América Latina, admiraremos las clásicas proporciones de su iglesia o la vista que se observa desde el elevado camarín de la virgen, paseo en calesa alrededor de la plaza y los principales puntos de interés, después de esta visita, dispondrá de tiempo para la comida en algún restaurante local donde disfrutará de la exquisita gastronomía regional.</span></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><span style="margin: 0px; padding: 0px;">&nbsp;</span></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Incluye: Transportación, Guía, paseo en calesa, admisiones.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">No Incluye: Comida, Propinas.</strong></p>'),
(27, 9, 2, 1, 'Izamal Pueblo Mágico', 'Izamal Pueblo Mágico', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><span lang="EN-US" style="margin: 0px; padding: 0px;">We depart from Mérida at 9:00am towards the colonial city of Izamal, also known as “The city of the three cultures,” name that received because of his different architectural influences, such as pre-colonial, colonial y modern. We will also, visit the pyramid called “Kinich Kakmo,” the Franciscan convent of San Antonio de Padua, where you will be able to admire the extraordinary archery at its atrium, which happens to be the largest in America, and only second behind the one in St. Peters Square in Rome, and where Pope Jean Paul II met with native communities in Latin America</span>.&nbsp;<span lang="EN-US" style="margin: 0px; padding: 0px;">We will also admire the view from the elevated patio in honor to our lady of conception. Carriage ride across the plaza and the main points of interest, and right after you will have some spare time to get a taste of the regional food that so characterizes that place.</span></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;"><em style="margin: 0px; padding: 0px;"><span lang="EN-US" style="margin: 0px; padding: 0px;">Includes: Transportation, Tour guide, Carriage Ride, and Admission Fee.</span></em></strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;"><em style="margin: 0px; padding: 0px;"><span lang="EN-US" style="margin: 0px; padding: 0px;">Does not include: Meals, and Tips.</span></em></strong></p>'),
(28, 9, 3, 1, 'Izamal Pueblo Mágico', 'Izamal Pueblo Mágico', 0, '<p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Partenza dalla città di Mérida alle 9,00 a.m. diretti alla città coloniale di Izamal, imbiancata in giallo, conosciuta anche con il nome di Tres Culturas (Tre Culture) giacché combina i tre periodi prehispanico, coloniale e contemporaneo. Visiteremo la Piramide Kinich Kakmo, il Convento Francescano di Sant''Antonio di Padova con i suoi straordinari archi che circondano il più grande Atrio dell''America, superato unicamente da Piazza San Pietro a Roma, vi si riunì&nbsp; il Papa Giovanni Paolo II con le comunità indigeni dell''America Latina, potrete ammirare le classiche proporzioni della chiesa e il bel paesaggio dall''alto della chiesa, un percorso in Calesa intorno alla piazza e ai punti principali, dopo la visita avrete tempo a disposizione per pranzare in uno dei tanti ristoranti, dove potrete assaporare la squisita gastronomia della regione.</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Comprende: trasporto, guida, gita in Calesa ed entrate.</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Il pranzo e le mance non sono comprese nel prezzo.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p>'),
(29, 9, 4, 1, 'Izamal Le Village Magique', 'Mérida-Izamal-Mérida  (Mínimo 4 personas)', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Départ de Merida à 09h00 à la ville coloniale d''Izamal peinte de jaune, aussi appelé les Trois Cultures car elle recueille les étapes des époques pré-hispanique, coloniale et contemporaine. Nous visiterons la pyramide Kinich Kakmo, le Couvent Franciscain du Saint-Antoine de Padoue, où vous pourrez admirer l''extraordinaire atrium d''arcades, le plus grand en d’Amérique (second après la place Saint-Pierre à Rome, où le pape Jean-Paul II rencontra les communautés autochtones d’Amérique latine), puis nous admirerons les proportions classiques de son église où la vue qui s’observe depuis les hauteurs de Camarin de la vierge, balade en calèche autour de la place et des principaux points d’intérêt. Après cette visite, vous disposerez de temps pour le repas dans un restaurant local où vous profiterez de la délicieuse gastronomie régionale.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Inclus: transport, guide, promenade en calèche, entrées, taxes</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Non inclus: repas, pourboire.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">(forfait sur la base de 4 passagers)</p>'),
(30, 10, 1, 1, 'Ruta Puuc', 'Mérida-Loltún-Mérida (Mínimo 4 personas)', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">A las 8:30am pasaremos por usted a su hotel para comenzar nuestro tour y dirigirnos hacia las impactantes grutas de Loltún. Los atractivos de estas grutas son sus pinturas rupestres, inscripciones, su majestuosa bóveda desplomada, sin olvidar las estalactitas y estalagmitas. Seguiremos nuestro recorrido a las zonas arqueológicas de Labná, el cual se destaca por su bello arco de estilo Puuc; otro edificio que se podrá observar es el Palacio y sus chultunes (cisternas de agua). Después veremos Xlapak, con sus 14 montículos con 3 pirámides en proceso de construcción donde se podrá visitar su estructura principal. Y por último visitaremos Sayil (Lugar de hormigas rojas) su palacio, uno de los más grandes del valle, y el mirador, son los edificios más representativos de éste sitio así como sus enormes estelas. Posteriormente comeremos en la ruta&nbsp; y retornaremos a Mérida a las 18:00hrs aproximadamente</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Incluye: Transportación, Guía, Admisiones, Comida e Impuestos.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">No Incluye: Bebidas con los alimentos y Propinas.</strong></p>');
INSERT INTO `tour_idioma` (`id`, `id_tour`, `id_idioma`, `id_estatus`, `nombretour`, `circuito`, `soloadultos`, `descripcion`) VALUES
(31, 10, 2, 1, 'Ruta Puuc', 'Mérida-Loltún-Mérida (Mínimo 4 personas)', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">At 8:30am we will be picking you up at your hotel and heading towards the LOLTUN caves, which were utilized by Mayans as a sanctuary, and where mammoth Ivory Fangs were found, these are now exhibiting in the museum of human anthropology of Mérida. We will enjoy a guided tour throughout these caves for about an hour, in which we will find multiple rock formations which give the place a reason for its name. Afterwards, we´ll head over to the archeological sites of Labná Xlapak y Sayíl; where we will admire a Mayan architectural style called “PUUC.”</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Includes: Transportation, Tour Guide, Admission Fee, Lunch and Taxes.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Does not include: beverages with the meal, and Tips.</strong></p>'),
(32, 10, 3, 1, 'Ruta Puuc', 'Mérida-Loltún-Mérida (Mínimo 4 personas)', 0, '<p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Partiremo dal vostro albergo verso le 8,30 a.m. diretti alle meravigliose Grutas di Loltún, i principali attrattivi delle grotte sono le pitture rupestri, iscrizioni, la maestosa volta a spiombata, le stalattite e stalagmiti. Proseguiremo il nostro percorso alle zone archeologiche di Labná, spicca il suo fantastico arco n stile Puuc, un’altra struttura che visiteremo sarà il Palacio e i chultunes (depositi acquiferi). Xlapak con i suoi 14 cumuli, 3 piramidi in processo di costruzione dove potrà esser visitata la struttura principale. Sayil (posto delle formiche rosse) il Palazzo, uno dei più grandi della valle, el Mirador, sono le strutture più rappresentative e le sue enormi Estelas. Pranzeremo e ritorneremo a Mérida verso le 18,00 ore.</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Il prezzo comprende: Trasporto, Guida, ingressi, pranzo, e tasse.</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Non sono comprese nel prezzo: bibite e mance</p>'),
(33, 10, 4, 1, 'Ruta Puuc', 'Mérida-Loltún-Mérida (Mínimo 4 personas)', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">A 8h30, nous viendrons vous chercher à votre hôtel pour partir aux impressionnantes grottes de Loltun. Lesquelles furent utilisées par les mayas comme sanctuaire et sont également un lieu où on trouva des restes de mammouth présents au musée d’anthropologie de Merida. Nous ferons une visite guidée d’approximativement 1 heure où nous admirerons des formations rocheuses telles que des stalactites et stalagmites, nous continuerons notre voyage en visitant les sites archéologique de Labna, Xlapak et Sayíl, où vous pourrez admirer un style d’architecture maya qui porte le nom de PUUC.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Inclus : transport, guide, entrées, repas</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Non inclus: les boissons aux repas , pourboire .</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">( forfait sur la base de 4 passagers )</p>'),
(34, 11, 1, 1, 'Uxmal Luz y Sonido', 'Mérida-Uxmal-Mérida', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">A las 13:00 horas pasaremos por usted a su hotel para salir hacia la zona arqueológica de Uxmal donde tendremos una visita guiada a los principales templos como: el palacio del Gobernador, la pirámide del Adivino, el cuadrángulo de las Monjas, etc., al finalizar el recorrido tendremos una merienda completa en un restaurante de la zona, al término entraremos nuevamente al sitio para presenciar el espectáculo de Luz y Sonido, para posteriormente regresar a Mérida, llegando a la ciudad a las 22:00 horas aproximadamente.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Incluye: Transportación, Servicio de Guía, &nbsp;Comida e Impuestos.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">No Incluye:&nbsp;</strong><strong style="margin: 0px; padding: 0px;">Admisiones,&nbsp;</strong><strong style="margin: 0px; padding: 0px;">Bebidas con los alimentos, Propinas</strong></p>'),
(35, 11, 2, 1, 'Uxmal Light & Sound', 'Mérida-Uxmal-Mérida', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">At 13:00hrs we will be picking you up at your Hotel to leave the city and onto the archeological zone of Uxmal, where you will enjoy a guided tour of the site and the main temples, such as “The Governor’s palace” “The Soothsayer´s Pyramid” and “The quadrangle of the nuns.” After the guided tour, we will be having dinner at a lovely local restaurant, to later on admire the lights and sound show.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Includes: Transportation, Tour guide, and Dinner.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Does NOT include: Admission fees, Beverages, Tips.</strong></p>'),
(36, 11, 3, 1, 'Uxmal Light & Sound', 'Uxmal Light & Sound', 0, '<p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><span lang="IT" style="margin: 0px; padding: 0px;">Alle 0re 13,00, verremo a prendervi in albergo, e partiremo verso la Zona Archeologica di Uxmal dove faremo una visita guidata delle principali strutture: Palacio del Gobernador, La Piramide del Adivino,El Cuadrangulo de las Monjas, ecc. Conclusa la nostro visita, andremo a cena in un ristorante in zona, posteriormente rientreremo nel Sito Archeologico per presenziare lo Spettacolo di Luce e Suono. Finito lo spettacolo, ritorneremo a M</span><span lang="IT" style="margin: 0px; padding: 0px;">é</span><span lang="IT" style="margin: 0px; padding: 0px;">rida verso le 22,00 ore.</span></p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><span lang="ES-TRAD" style="margin: 0px; padding: 0px;">&nbsp;</span></p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><span lang="IT" style="margin: 0px; padding: 0px;">Il prezzo comprende: trasporto, servizio di guida, , cena e tasse.</span></p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><span lang="IT" style="margin: 0px; padding: 0px;">Non sono compresi nel prezzo:&nbsp;</span>ingressi, bibite e mance.</p>'),
(37, 11, 4, 1, 'Uxmal Son et lumière', 'Mérida-Uxmal-Mérida', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">A 13h00 nous viendrons vous chercher à votre hôtel pour partir vers la zone archéologique d’Uxamal, où nous aurons une visite guidée des principaux temples comme : Le palais du gouverneur, le pyramide du devin, le quadrilatère des nonnes…A la fin de la visite nous aurons un repas complet dans un restaurant du coin, puis nous reviendrons à nouveau sur le site pour le spectacle de son et lumière. Une fois fini, nous reviendrons à Mérida à 22h.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Inclus: transport, guide, , repas et taxes.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Non inclus: entrées, les boissons lors des repas, les pourboires.</p>'),
(38, 12, 1, 1, 'Uxmal-Kabah', 'Mérida-Uxmal-Mérida', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">A las 9:00 de la mañana pasaremos&nbsp;por usted a su hotel para dirigirnos a la zona arqueológica de Uxmal, donde el guía los llevará a los templos más importantes, entre ellos la plataforma de las estelas, el juego de pelota, el templo del adivino, el cuadrángulo de las monjas etc. Posteriormente continuaremos a la zona arqueológica de Kabah, cabe destacar que tanto Uxmal como Kabah tiene el estilo arquitectónico Puuc; Kabah es famoso por su entrada al Sac-Be (camino blanco), el Codz Poop, el palacio etc. Para concluir regresaremos a Uxmal para comer, y posteriormente retornar a Mérida alrededor de las 5:00 pm.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Incluye: Transportación, Guía, Comida e Impuestos.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">No Incluye: Admisiones,&nbsp;</strong><strong style="margin: 0px; padding: 0px;">Bebidas con los alimentos, Propinas.</strong></p>'),
(39, 12, 2, 1, 'Uxmal-Kabah', 'Mérida-Uxmal-Mérida', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">At 9:00am we will pick you up at your hotel to start our tour in the archeological zone of Uxmal, where a tour guide will show around the most important temples on site, “The Platform of the Steles,” “The Ball Game Court,” “The Soothsayer’s Temple,” and “The Quadrangle of the Nuns.” Afterwards we’ll continue to the archeological zone of “kabah.” It’s worth noting that as much Uxmal as Kabah have an architectonic style known as “Puuc.” Kabah it’s famous for its entry to the “Sacbé” (White Road), “The Codz Puop,” “The Palace,” Etc.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">To finalize we will return to Uxmal to have lunch at a local restaurant, and then to Mérida at approximately 17:00 hrs.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Includes: Transportation, Tour Guide, Meals and Taxes.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Does Not Include:&nbsp;</strong><strong style="margin: 0px; padding: 0px;">Admission Fee,&nbsp;</strong><strong style="margin: 0px; padding: 0px;">Beverages, Tips.</strong></p>'),
(40, 12, 3, 1, 'Uxmal-Kabah', 'Mérida-Uxmal-Mérida', 0, '<p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Verso le 9,00 ore, verremo a prendervi nel vostro albergo, per visitare la Zona Archeologica di Uxmal, farete una visita guidata per conoscere le strutture più importanti: La Plataforma de las Estelas, El Juego de Pelota, El Templo del Adivino, El Quadrangolo de las Monjas, ecc.Dopo proseguiremo verso la Zona Archeologica di Kabah. Lo Stile architettonico di entrambe Zone Archeologiche appartiene al Pucc; Kabah, famosa per il suo Sac-Be (cammino bianco), il Codz Poop, El Palacio, ecc. Per ultimo ritorneremo ad Uxmal per pranzare e ritornare a Merida verso le 5,00 p.m.</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Il prezzo comprende: trasporto, Guida, pranzo e tasse.</p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Non sono comprese nel prezzo: Ingressi, Bibite e mance.</p>'),
(41, 12, 4, 1, 'Uxmal-Kabah', 'Mérida-Uxmal-Mérida', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Vers 9h00 nous passerons vous chercher à votre hôtel pour nous diriger vers la zone archéologique d’Uxaml, où le guide vous emmènera voir les temples les plus importants parmi lesquels la plateforme des étoiles, le jeu de balle, le temple du devin , le quadrilatère des nonnes. Ensuite nous continuerons vers la zone archéologique de Kabah où vous pourrez vous rendre compte qu’à la fois Uxmal et Kabah ont un style architectural Puuc. Kabah est réputé pour son entrée “al Sac-Be” ( chemin blanc) Le Codz Poop, le palais… Puis nous nous rendrons à Uxmal afin de manger et nous retournerons à Merida vers 17H.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Inclus: transport, guide, repas et taxes.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Non inclus: entrées, boissons avec le repas et pourboires.</p>'),
(42, 13, 1, 1, 'Uxmal-Museo del Chocolate', 'Mérida-Uxmal-Mérida', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><span style="margin: 0px; padding: 0px;">A las 09:00 hrs. pasaremos por usted a su hotel, para salir a la zona arqueológica de<span class="apple-converted-space" style="margin: 0px; padding: 0px;">&nbsp;</span>Uxmal donde tendremos una visita guiada a los principales templos como: el Palacio del Gobernador, la Pirámide del<span class="apple-converted-space" style="margin: 0px; padding: 0px;">&nbsp;</span>Adivino, el Cuadrángulo de las Monjas, etc., continuaremos nuestro recorrido con una visita al Museo del Chocolate en donde conocerá la historia&nbsp;de este milenario alimento y podrá presenciar una ceremonia Maya en honor al Chocolate, al término de esta visita pasaremos a un restaurante local para disfrutar de la comida, para posteriormente regresar a Mérida.</span></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">Incluye: Transportación, Guía, comida e impuestos.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;">No Incluye: A</strong><strong style="margin: 0px; padding: 0px;">dmisiones,&nbsp;</strong><strong style="margin: 0px; padding: 0px;">Bebidas con los alimentos, ni propinas.</strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><span style="margin: 0px; padding: 0px;">&nbsp;</span></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p>'),
(43, 13, 2, 1, 'Uxmal-Museo del Chocolate', 'Mérida-Uxmal-Mérida', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><span lang="EN-US" style="margin: 0px; padding: 0px;">At 9:00am. We’ll pick you up at your Hotel to get underway to the archeological zone of Uxmal, where the tour guide will take you across the most important temples of the site, amongst them you’ll find: the platform of the stelas, the ball game, the temple of the fortune teller, the square of the nuns, etc. Afterwards we’ll continue towards the Chocolate Museum, where you will be able to encounter the amazing history behind this millennial delight, and where you will also be able to witness a Mayan ritual honoring Chocolate. Later on we’ll head to a restaurant to enjoy regional food and then back to Mérida.</span></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;"><em style="margin: 0px; padding: 0px;"><span lang="EN-US" style="margin: 0px; padding: 0px;">Includes: Transportation, Tour Guide, Lunch and Taxes.</span></em></strong></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><strong style="margin: 0px; padding: 0px;"><em style="margin: 0px; padding: 0px;"><span lang="EN-US" style="margin: 0px; padding: 0px;">Does not include:&nbsp;</span></em></strong><strong style="margin: 0px; padding: 0px;"><em style="margin: 0px; padding: 0px;"><span lang="EN-US" style="margin: 0px; padding: 0px;">Admission Fees,&nbsp;</span></em></strong><strong style="margin: 0px; padding: 0px;"><em style="margin: 0px; padding: 0px;"><span lang="EN-US" style="margin: 0px; padding: 0px;">beverages with the meal, and Tips.</span></em></strong></p>'),
(44, 13, 3, 1, 'Uxmal-Museo del Chocolate', 'Mérida-Uxmal-Mérida', 0, '<p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><span lang="IT" style="margin: 0px; padding: 0px;">alle 9,00 a.m. verremo a prendervi in albergo, per partire verso la Zona Archeologica di Uxmal dovre faremo una visita guidata dei principali templi: El Palacio, La Piramide del Adivino, El Cuadrangulo de las Monjas, ecc. Continueremo il nostro percorso con una visita al Museo del Chocolate, dopo la visita andremo in un ristorante a pranzo, e posteriormente ritorneremo a M</span><span lang="IT" style="margin: 0px; padding: 0px;">é</span><span lang="IT" style="margin: 0px; padding: 0px;">rida.</span></p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><span lang="ES-TRAD" style="margin: 0px; padding: 0px;">&nbsp;</span></p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><span lang="IT" style="margin: 0px; padding: 0px;">Il prezzo comprende: Trasporto, Guida, pranzo e tasse</span></p><p class="Cuerpo" style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;"><span lang="IT" style="margin: 0px; padding: 0px;">Non sono comprese nel prezzo: I</span>ngressi, bibite e mance.</p>'),
(45, 13, 4, 1, 'Uxmal musée du Chocolat', 'Mérida-Uxmal-Mérida', 0, '<p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Vers 9h00 nous passerons vous chercher à votre hôtel pour nous diriger vers la zone archéologique d’Uxmal, où le guide vous emmènera voir les temples les plus importants parmi lesquels le palais du gouverneur, le temple du devin, le quadrilatère des nonnes…</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Nous continuerons notre tour avec une visite du musée du chocolat où vous connaitrez l’histoire de cet aliment millénaire et pourrez assister à une cérémonie maya en l’honneur du chocolat. A la fin de cette visite nous irons dans un restaurant local profiter du repas avant de rentrer à Merida.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">&nbsp;</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Inclus: transport, guide, entrées, nourriture et taxes.</p><p style="margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 13px; line-height: normal;">Non inclus: boissons avec les repas et pourboires.</p>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tour_imagen`
--

CREATE TABLE IF NOT EXISTS `tour_imagen` (
  `id` int(11) NOT NULL,
  `id_tour` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `nombreoriginal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipoarchivo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `folio` int(11) NOT NULL,
  `fechacreacion` datetime NOT NULL,
  `principal` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tour_origen`
--

CREATE TABLE IF NOT EXISTS `tour_origen` (
  `id` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `id_tour` int(11) NOT NULL,
  `id_origen` int(11) NOT NULL,
  `tarifaadulto` double NOT NULL,
  `tarifamenor` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tour_origen`
--

INSERT INTO `tour_origen` (`id`, `id_estatus`, `id_tour`, `id_origen`, `tarifaadulto`, `tarifamenor`) VALUES
(1, 1, 1, 1, 900, 900),
(2, 1, 2, 1, 900, 850),
(3, 1, 3, 1, 650, 650),
(4, 1, 4, 1, 750, 700),
(5, 1, 5, 1, 525, 475),
(6, 1, 6, 1, 900, 850),
(7, 1, 7, 1, 1000, 950),
(8, 1, 8, 1, 800, 750),
(9, 1, 9, 1, 600, 540),
(10, 1, 10, 1, 850, 850),
(11, 1, 11, 1, 525, 475),
(12, 1, 12, 1, 525, 475),
(13, 1, 13, 1, 525, 475);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL,
  `id_estatus` int(11) NOT NULL,
  `id_datospersonales` int(11) NOT NULL,
  `id_datosubicacion` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comentarios` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `id_estatus`, `id_datospersonales`, `id_datosubicacion`, `username`, `password`, `comentarios`) VALUES
(1, 1, 1, 1, 'gmartinez@visitayucatan.com', 'e75b18b3e36ac83c3307d79e1ca340f8', NULL),
(2, 1, 2, 2, 'fcapetilloc@visitayucatan.com', '71b949244f563e8fb2688c8c4eeb8666', NULL),
(3, 1, 3, 3, 'jaguilar.concytey@gmail.com', 'a66729e394649ec4664ecd3f3be73f18', NULL),
(4, 1, 4, 4, 'rdzul', '557eabdea65781c000f1a66f353f4858', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_ubicacion`
--
ALTER TABLE `datos_ubicacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `destino`
--
ALTER TABLE `destino`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_81F64EFA50BDD1F3` (`id_estatus`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_3535ED969CBB9D0` (`id_datosubicacion`),
  ADD KEY `IDX_3535ED950BDD1F3` (`id_estatus`),
  ADD KEY `IDX_3535ED95F6BE78A` (`id_destino`);

--
-- Indices de la tabla `hotel_contacto`
--
ALTER TABLE `hotel_contacto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_65209B4EBF6F2BE4` (`id_datospersonales`),
  ADD UNIQUE KEY `UNIQ_65209B4E69CBB9D0` (`id_datosubicacion`),
  ADD KEY `IDX_65209B4EEDD61FE9` (`id_hotel`),
  ADD KEY `IDX_65209B4E50BDD1F3` (`id_estatus`);

--
-- Indices de la tabla `hotel_idioma`
--
ALTER TABLE `hotel_idioma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_81228C6BEDD61FE9` (`id_hotel`),
  ADD KEY `IDX_81228C6B3BFFEBE1` (`id_idioma`),
  ADD KEY `IDX_81228C6B50BDD1F3` (`id_estatus`);

--
-- Indices de la tabla `hotel_imagen`
--
ALTER TABLE `hotel_imagen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1FF300D4EDD61FE9` (`id_hotel`),
  ADD KEY `IDX_1FF300D450BDD1F3` (`id_estatus`);

--
-- Indices de la tabla `idioma`
--
ALTER TABLE `idioma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1DC85E0C50BDD1F3` (`id_estatus`);

--
-- Indices de la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B00B2B2D50BDD1F3` (`id_estatus`);

--
-- Indices de la tabla `origen`
--
ALTER TABLE `origen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7244191250BDD1F3` (`id_estatus`);

--
-- Indices de la tabla `pagina`
--
ALTER TABLE `pagina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3E8EDA6D50BDD1F3` (`id_estatus`);

--
-- Indices de la tabla `pagina_descripcion`
--
ALTER TABLE `pagina_descripcion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BBA562D550BDD1F3` (`id_estatus`);

--
-- Indices de la tabla `pagina_imagen`
--
ALTER TABLE `pagina_imagen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3DCCA63D50BDD1F3` (`id_estatus`);

--
-- Indices de la tabla `pagina_imagen_descripcion`
--
ALTER TABLE `pagina_imagen_descripcion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_12686A9550BDD1F3` (`id_estatus`);

--
-- Indices de la tabla `paquete_combinacion_hotel`
--
ALTER TABLE `paquete_combinacion_hotel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3BF48AA3CCF5C3E5` (`id_paquete`),
  ADD KEY `IDX_3BF48AA350BDD1F3` (`id_estatus`),
  ADD KEY `IDX_3BF48AA3EDD61FE9` (`id_hotel`);

--
-- Indices de la tabla `paquete_idioma`
--
ALTER TABLE `paquete_idioma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A3366FB0CCF5C3E5` (`id_paquete`),
  ADD KEY `IDX_A3366FB03BFFEBE1` (`id_idioma`),
  ADD KEY `IDX_A3366FB050BDD1F3` (`id_estatus`);

--
-- Indices de la tabla `paquete_imagen`
--
ALTER TABLE `paquete_imagen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3DE7E30FCCF5C3E5` (`id_paquete`),
  ADD KEY `IDX_3DE7E30F50BDD1F3` (`id_estatus`);

--
-- Indices de la tabla `paquete_itinerario`
--
ALTER TABLE `paquete_itinerario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C507D839CCF5C3E5` (`id_paquete`),
  ADD KEY `IDX_C507D8393BFFEBE1` (`id_idioma`),
  ADD KEY `IDX_C507D83950BDD1F3` (`id_estatus`);

--
-- Indices de la tabla `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6AD1F96950BDD1F3` (`id_estatus`);

--
-- Indices de la tabla `tour_idioma`
--
ALTER TABLE `tour_idioma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2846B9E6E1F1E56B` (`id_tour`),
  ADD KEY `IDX_2846B9E63BFFEBE1` (`id_idioma`),
  ADD KEY `IDX_2846B9E650BDD1F3` (`id_estatus`);

--
-- Indices de la tabla `tour_imagen`
--
ALTER TABLE `tour_imagen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B6973559E1F1E56B` (`id_tour`),
  ADD KEY `IDX_B697355950BDD1F3` (`id_estatus`);

--
-- Indices de la tabla `tour_origen`
--
ALTER TABLE `tour_origen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_47CAFEF850BDD1F3` (`id_estatus`),
  ADD KEY `IDX_47CAFEF8E1F1E56B` (`id_tour`),
  ADD KEY `IDX_47CAFEF85473ACFF` (`id_origen`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2265B05DBF6F2BE4` (`id_datospersonales`),
  ADD UNIQUE KEY `UNIQ_2265B05D69CBB9D0` (`id_datosubicacion`),
  ADD KEY `IDX_2265B05D50BDD1F3` (`id_estatus`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `datos_ubicacion`
--
ALTER TABLE `datos_ubicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `destino`
--
ALTER TABLE `destino`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `hotel_contacto`
--
ALTER TABLE `hotel_contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `hotel_idioma`
--
ALTER TABLE `hotel_idioma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `hotel_imagen`
--
ALTER TABLE `hotel_imagen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `idioma`
--
ALTER TABLE `idioma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `origen`
--
ALTER TABLE `origen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `pagina`
--
ALTER TABLE `pagina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pagina_descripcion`
--
ALTER TABLE `pagina_descripcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pagina_imagen`
--
ALTER TABLE `pagina_imagen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pagina_imagen_descripcion`
--
ALTER TABLE `pagina_imagen_descripcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `paquete`
--
ALTER TABLE `paquete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `paquete_combinacion_hotel`
--
ALTER TABLE `paquete_combinacion_hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `paquete_idioma`
--
ALTER TABLE `paquete_idioma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `paquete_imagen`
--
ALTER TABLE `paquete_imagen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `paquete_itinerario`
--
ALTER TABLE `paquete_itinerario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tour`
--
ALTER TABLE `tour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `tour_idioma`
--
ALTER TABLE `tour_idioma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de la tabla `tour_imagen`
--
ALTER TABLE `tour_imagen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tour_origen`
--
ALTER TABLE `tour_origen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `destino`
--
ALTER TABLE `destino`
  ADD CONSTRAINT `FK_81F64EFA50BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`);

--
-- Filtros para la tabla `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `FK_3535ED950BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`),
  ADD CONSTRAINT `FK_3535ED95F6BE78A` FOREIGN KEY (`id_destino`) REFERENCES `destino` (`id`),
  ADD CONSTRAINT `FK_3535ED969CBB9D0` FOREIGN KEY (`id_datosubicacion`) REFERENCES `datos_ubicacion` (`id`);

--
-- Filtros para la tabla `hotel_contacto`
--
ALTER TABLE `hotel_contacto`
  ADD CONSTRAINT `FK_65209B4E50BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`),
  ADD CONSTRAINT `FK_65209B4E69CBB9D0` FOREIGN KEY (`id_datosubicacion`) REFERENCES `datos_ubicacion` (`id`),
  ADD CONSTRAINT `FK_65209B4EBF6F2BE4` FOREIGN KEY (`id_datospersonales`) REFERENCES `datos_personales` (`id`),
  ADD CONSTRAINT `FK_65209B4EEDD61FE9` FOREIGN KEY (`id_hotel`) REFERENCES `hotel` (`id`);

--
-- Filtros para la tabla `hotel_idioma`
--
ALTER TABLE `hotel_idioma`
  ADD CONSTRAINT `FK_81228C6B3BFFEBE1` FOREIGN KEY (`id_idioma`) REFERENCES `idioma` (`id`),
  ADD CONSTRAINT `FK_81228C6B50BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`),
  ADD CONSTRAINT `FK_81228C6BEDD61FE9` FOREIGN KEY (`id_hotel`) REFERENCES `hotel` (`id`);

--
-- Filtros para la tabla `hotel_imagen`
--
ALTER TABLE `hotel_imagen`
  ADD CONSTRAINT `FK_1FF300D450BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`),
  ADD CONSTRAINT `FK_1FF300D4EDD61FE9` FOREIGN KEY (`id_hotel`) REFERENCES `hotel` (`id`);

--
-- Filtros para la tabla `idioma`
--
ALTER TABLE `idioma`
  ADD CONSTRAINT `FK_1DC85E0C50BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`);

--
-- Filtros para la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD CONSTRAINT `FK_B00B2B2D50BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`);

--
-- Filtros para la tabla `origen`
--
ALTER TABLE `origen`
  ADD CONSTRAINT `FK_7244191250BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`);

--
-- Filtros para la tabla `pagina`
--
ALTER TABLE `pagina`
  ADD CONSTRAINT `FK_3E8EDA6D50BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`);

--
-- Filtros para la tabla `pagina_descripcion`
--
ALTER TABLE `pagina_descripcion`
  ADD CONSTRAINT `FK_BBA562D550BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`);

--
-- Filtros para la tabla `pagina_imagen`
--
ALTER TABLE `pagina_imagen`
  ADD CONSTRAINT `FK_3DCCA63D50BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`);

--
-- Filtros para la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD CONSTRAINT `FK_12686A9550BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`);

--
-- Filtros para la tabla `paquete_combinacion_hotel`
--
ALTER TABLE `paquete_combinacion_hotel`
  ADD CONSTRAINT `FK_3BF48AA350BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`),
  ADD CONSTRAINT `FK_3BF48AA3CCF5C3E5` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id`),
  ADD CONSTRAINT `FK_3BF48AA3EDD61FE9` FOREIGN KEY (`id_hotel`) REFERENCES `hotel` (`id`);

--
-- Filtros para la tabla `paquete_idioma`
--
ALTER TABLE `paquete_idioma`
  ADD CONSTRAINT `FK_A3366FB03BFFEBE1` FOREIGN KEY (`id_idioma`) REFERENCES `idioma` (`id`),
  ADD CONSTRAINT `FK_A3366FB050BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`),
  ADD CONSTRAINT `FK_A3366FB0CCF5C3E5` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id`);

--
-- Filtros para la tabla `paquete_imagen`
--
ALTER TABLE `paquete_imagen`
  ADD CONSTRAINT `FK_3DE7E30F50BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`),
  ADD CONSTRAINT `FK_3DE7E30FCCF5C3E5` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id`);

--
-- Filtros para la tabla `paquete_itinerario`
--
ALTER TABLE `paquete_itinerario`
  ADD CONSTRAINT `FK_C507D8393BFFEBE1` FOREIGN KEY (`id_idioma`) REFERENCES `idioma` (`id`),
  ADD CONSTRAINT `FK_C507D83950BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`),
  ADD CONSTRAINT `FK_C507D839CCF5C3E5` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id`);

--
-- Filtros para la tabla `tour`
--
ALTER TABLE `tour`
  ADD CONSTRAINT `FK_6AD1F96950BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`);

--
-- Filtros para la tabla `tour_idioma`
--
ALTER TABLE `tour_idioma`
  ADD CONSTRAINT `FK_2846B9E63BFFEBE1` FOREIGN KEY (`id_idioma`) REFERENCES `idioma` (`id`),
  ADD CONSTRAINT `FK_2846B9E650BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`),
  ADD CONSTRAINT `FK_2846B9E6E1F1E56B` FOREIGN KEY (`id_tour`) REFERENCES `tour` (`id`);

--
-- Filtros para la tabla `tour_imagen`
--
ALTER TABLE `tour_imagen`
  ADD CONSTRAINT `FK_B697355950BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`),
  ADD CONSTRAINT `FK_B6973559E1F1E56B` FOREIGN KEY (`id_tour`) REFERENCES `tour` (`id`);

--
-- Filtros para la tabla `tour_origen`
--
ALTER TABLE `tour_origen`
  ADD CONSTRAINT `FK_47CAFEF850BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`),
  ADD CONSTRAINT `FK_47CAFEF85473ACFF` FOREIGN KEY (`id_origen`) REFERENCES `origen` (`id`),
  ADD CONSTRAINT `FK_47CAFEF8E1F1E56B` FOREIGN KEY (`id_tour`) REFERENCES `tour` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_2265B05D50BDD1F3` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`),
  ADD CONSTRAINT `FK_2265B05D69CBB9D0` FOREIGN KEY (`id_datosubicacion`) REFERENCES `datos_ubicacion` (`id`),
  ADD CONSTRAINT `FK_2265B05DBF6F2BE4` FOREIGN KEY (`id_datospersonales`) REFERENCES `datos_personales` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
