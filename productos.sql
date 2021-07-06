-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-07-2021 a las 07:32:55
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `productos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_um`
--

CREATE TABLE `cat_um` (
  `id_um` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cat_um`
--

INSERT INTO `cat_um` (`id_um`, `descripcion`) VALUES
(1, 'Metros'),
(2, 'Centímetros'),
(3, 'Kilos'),
(4, 'Gramos'),
(5, 'Litros'),
(6, 'Mililitros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `codigo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `desc_corta` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `desc_larga` text COLLATE utf8_spanish_ci NOT NULL,
  `um` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `codigo`, `desc_corta`, `desc_larga`, `um`, `precio`) VALUES
(1, '00085069700252', 'Galletas Mac\'Ma Selecciones surtido 330 g', 'Lúcete en esas reuniones especiales ofreciendo algo diferente y delicioso y deleita a tus invitados con las Galletas MacMa Selecciones en su presentación de 330 gramos, que tenemos en tu tienda en línea a un excelente precio. Ten la confianza de que pueden ser consumidas por todo tipo de personas ya que cuentan con certificación Kosher gracias su elaboración bajo los más altos estándares de fabricación.\r\n\r\nEn nuestra tienda en línea tenemos lo que necesitas gracias a nuestros diversos departamentos, solo agrega a tu carrito de compras por internet tus productos favoritos con tan solo unos cuantos clics y aprovecha el servicio de entregas a domicilio.', '4', 61.5),
(2, '00085069700251', 'Galletas Mac\'Ma Escocés surtido 330 g', 'MacMa trae para ti sus galletas escocés las cuales puedes compartir en familia o con los amigos. Deléitate con las galletas del Surtido Escocés. ¡Te encantarán! Acompañalos con la bebida de tu preferencia a cualquier hora del día.\r\n\r\nYa puedes hacer tus compras en línea desde la comodidad de tu hogar en Walmart Super y recibir tu despensa a domicilio completa con tan solo unos cuantos clics desde tu celular o computadora.', '4', 61.5),
(3, '00750043514781', 'Detergente en polvo Ace maxi limpieza 5.5 kg', 'Ace Limpieza Completa es un detergente en polvo que puede ser utilizado para lavar tanto la ropa blanca como la ropa de color. Su poderosa fórmula cuenta con gránulos que se disuelven rápidamente al contacto con el agua para que sus bloques de tecnología actúen quitando las manchas de comida, las manchas de grasa y etc. Además, Ace Limpieza Completa remueve la mugre diaria dándote así blancos y colores increíbles en cada lavada. Con Ace Limpieza Completa tu ropa quedará impecablemente limpia, sin manchas o mugre y con un rico aroma. Limpieza completa que puedes ver y oler.\r\n\r\nEntra a la tienda en línea de Walmart súper y disfruta el servicio a domicilio que se encuentra disponible para tu comodidad a tan solo unos clics de distancia.', '3', 115),
(4, '00750043514892', 'Detergente en polvo Ariel revitacolor 4.5 kg', 'Cuida tus prendas de color y oscuras con el detergente Ariel Revitacolor.\r\n\r\n• Cuida los colores de tus prendas\r\n\r\n• Con activos Biodegradables\r\n\r\n• Fácil disolución ayudando a evitar residuos en tu ropa\r\n\r\nYa puedes hacer tus compras en línea desde la comodidad de tu hogar en Walmart súper y recibir tu despensa a domicilio, completa con tan solo unos cuantos clics desde tu celular o computadora.', '3', 109),
(5, '00750102312981', 'Cinta Scotch 3M canela 50 m', 'Scotch y 3M tienen para ti esta práctica cinta canela de 50 metros de longitud que te ayudará a empacar todo lo que necesites de una manera eficiente.\r\n\r\nRecuerda que ya puedes realizar tus compras en línea de este y otros productos en Walmart.com.mx donde encontrarás lo necesario para tu día a día o para surtir tu despensa. Compra lo que necesites ya que con nuestro servicio de entregas a domicilio, tus compras llegarán hasta la puerta de tu hogar.', '1', 19),
(6, '00072167200110', 'Masking Tape 110 Tuck uso general 24 mm x 50 m', 'Masking tape 110 de la marca Tuck. Ideal para el uso en el hogar, la escuela y oficina; para pegar, sellar, empacar reparar, fijar, etcétera. Con medidas de 24 mm x 50 m. Ten siempre del hogar para cualquier tipo de trabajo.\r\n\r\nEncuentra una amplia variedad de productos ferretería y pinturas en tu tienda en línea y surte tu lista de compras con tan solo unos cuantos clics, recuerda que para tu comodidad Walmart.com.mx te ofrece servicio de entregas a domicilio y distintas formas de pago.', '1', 35),
(7, '00750043514109', 'Suavizante acondicionador de telas Downy aroma floral 5 l', 'Suavizante para ropa concentrado Downy, conoce su tecnología la cual te ayuda a proteger la ropa de malos olores como si creara un escudo sobre las prendas, conservando su perfume del día hasta la noche. Disfruta de una fragancia floral que te acompañará por más tiempo.\n\nBeneficios:\n\nProtege de malos olores, 2 veces más aroma, concentración de perfume liberado de la tela seca vs. lavar solamente con detergente, libre enjuague, aroma todo el día y facilita el planchado.\n\nEn Walmart tienda en línea encontrarás una amplia variedad de productos de lavandería como detergentes, suavizantes, blanqueadores y más, adquiere tus productos favoritos con tan solo unos cuantos clics y aprovecha nuestro servicio de entregas a domicilio.', '5', 104),
(8, '00750954608092', 'Suavizante acondicionador de telas Suavitel sport menta fresca 2.8 l', 'Mantén la suavidad necesaria en tus prendas y prolonga la durabilidad de las mismas con el suavizante de telas Suavitel Sport, que trae para ti su fórmula frescura en movimiento con aroma a menta fresca.\r\n\r\n• Protege la fibra textil, previniendo la deformación en la estructura\r\n\r\n• Suaviza la textura de la ropa para darle a tu piel comodidad durante el ejercicio y actividades diarias\r\n\r\n• Neutraliza el olor a sudor\r\n\r\n• Apto para su uso a mano o en lavadora\r\n\r\n• Conservar la forma original de la ropa, recobrando el color vivo\r\n\r\nDisfruta del extenso catálogo y los excelentes precios que ofrecemos en artículos de limpieza. ¡Haz tus compras con tan solo unos cuantos clics!', '5', 95.5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cat_um`
--
ALTER TABLE `cat_um`
  ADD PRIMARY KEY (`id_um`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cat_um`
--
ALTER TABLE `cat_um`
  MODIFY `id_um` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
