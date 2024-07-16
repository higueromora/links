-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-07-2024 a las 00:03:54
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
-- Base de datos: `links`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `filtros`
--

CREATE TABLE `filtros` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `data_filter` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `filtros`
--

INSERT INTO `filtros` (`id`, `user_id`, `categoria`, `data_filter`) VALUES
(5, 4, 'js', 'js'),
(36, 4, 'css', 'css'),
(45, 20, 'Imágenes/videos', 'Imágenes/videos'),
(60, 20, 'Html/css', 'Html/css'),
(61, 20, 'Javascript', 'Javascript'),
(62, 20, 'Cursos', 'Cursos'),
(63, 20, 'General', 'General'),
(64, 20, 'Música', 'Música'),
(65, 20, 'IA', 'IA'),
(66, 20, 'Velocidad web', 'Velocidad web');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subcategoria` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `clase` varchar(50) DEFAULT NULL,
  `favorito` enum('NO','SI') DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`id`, `user_id`, `subcategoria`, `url`, `clase`, `favorito`) VALUES
(47, 4, 'xxx', 'https://www.youtube.com/', 'js', 'NO'),
(51, 4, 'asa', 'https://www.eneba.com/es/', 'js', 'NO'),
(53, 4, 'asaSAA', 'https://www.eneba.com/es/', 'js', 'NO'),
(79, 20, 'Jonmircha cursos', 'https://jonmircha.com/cursos', 'Cursos', 'NO'),
(80, 20, 'Libro git', 'https://git-scm.com/book/es/v2', 'Cursos', 'NO'),
(81, 20, 'React preguntas', 'https://www.reactjs.wiki/', 'Cursos', 'NO'),
(82, 20, 'Sqlbolt curso práctico', 'https://sqlbolt.com/', 'Cursos', 'NO'),
(83, 20, 'Cursos Fernando Herrera', 'https://cursos.devtalles.com/', 'Cursos', 'NO'),
(84, 20, 'Adecco cursos', 'https://www.trabajandoenti.com/', 'Cursos', 'NO'),
(86, 20, 'codigo369 cursos', 'https://www.codigo369.vip/collections', 'Cursos', 'NO'),
(87, 20, 'Udemy plataforma', 'https://www.udemy.com/', 'Cursos', 'SI'),
(88, 20, 'Cursos software en Inglés', 'https://www.edx.org/es', 'Cursos', 'SI'),
(89, 20, 'Cursos de pago openwebinars', 'https://openwebinars.net/', 'Cursos', 'NO'),
(90, 20, 'Cursos fullstack', 'https://fullstackopen.com/', 'Cursos', 'NO'),
(91, 20, 'Documentación general', 'https://devdocs.io/', 'General', 'NO'),
(92, 20, 'Curso git español', 'https://learngitbranching.js.org/?locale=es_ES&demo=', 'Cursos', 'NO'),
(93, 20, 'Cursos react', 'https://cursoreact.dev/', 'Cursos', 'NO'),
(94, 20, 'pixabay', 'https://pixabay.com/es/', 'Imágenes/videos', 'NO'),
(95, 20, 'Optimizar imágenes squoosh', 'https://squoosh.app/', 'Imágenes/videos', 'SI'),
(96, 20, 'boxicon iconos', 'https://boxicons.com/', 'Imágenes/videos', 'NO'),
(97, 20, 'photopea similar Photoshop', 'https://www.photopea.com/', 'Imágenes/videos', 'NO'),
(98, 20, 'freepik', 'https://www.freepik.com/', 'Imágenes/videos', 'NO'),
(99, 20, 'pexel imágenes lincencia gratuita', 'https://www.pexels.com/', 'Imágenes/videos', 'SI'),
(100, 20, 'manypixels', 'https://www.manypixels.co/gallery', 'Imágenes/videos', 'NO'),
(101, 20, 'unplash', 'https://unsplash.com/es', 'Imágenes/videos', 'NO'),
(102, 20, 'iconify', 'https://iconify.design/', 'Imágenes/videos', 'NO'),
(103, 20, 'ionic iconos', 'https://ionic.io/ionicons', 'Imágenes/videos', 'NO'),
(104, 20, 'emojipedia', 'https://emojipedia.org/es', 'Imágenes/videos', 'NO'),
(105, 20, 'devicon', 'https://devicon.dev/', 'Imágenes/videos', 'NO'),
(106, 20, 'imagenes artísticas', 'https://www.deviantart.com/tag/fan_art', 'Imágenes/videos', 'NO'),
(107, 20, 'yesicon iconos gratis', 'https://yesicon.app/', 'Imágenes/videos', 'SI'),
(108, 20, 'videvo videos', 'https://www.videvo.net/', 'Imágenes/videos', 'NO'),
(109, 20, 'undraw', 'https://undraw.co/illustrations', 'Imágenes/videos', 'SI'),
(110, 20, 'splitshire imágenes/videos', 'https://www.splitshire.com/best-new-free-stock-photos/', 'Imágenes/videos', 'NO'),
(111, 20, 'shots mockup', 'https://shots.so/', 'Imágenes/videos', 'SI'),
(112, 20, 'tabler iconos', 'https://tabler.io/icons', 'Imágenes/videos', 'NO'),
(113, 20, 'imgbb subir imagen online', 'https://es.imgbb.com/', 'Imágenes/videos', 'NO'),
(114, 20, 'giphy gif', 'https://giphy.com/', 'Imágenes/videos', 'NO'),
(115, 20, 'svgl iconos', 'https://svgl.app/', 'Imágenes/videos', 'NO'),
(116, 20, 'flaticon ', 'https://www.flaticon.es/', 'Imágenes/videos', 'NO'),
(117, 20, 'flickr fotos', 'https://www.flickr.com/', 'Imágenes/videos', 'NO'),
(118, 20, 'coverr videos/música', 'https://coverr.co/', 'Imágenes/videos', 'NO'),
(119, 20, 'svgporn imágenes', 'https://svgporn.com/', 'Imágenes/videos', 'NO'),
(120, 20, 'pinetools editar imágen', 'https://pinetools.com/es/colorizar-imagen', 'Imágenes/videos', 'NO'),
(121, 20, 'jamendo música', 'https://www.jamendo.com/?language=es', 'Música', 'NO'),
(122, 20, 'dream ai', 'https://dream.ai/create', 'IA', 'NO'),
(123, 20, 'blackbox.ai generador de código', 'https://www.blackbox.ai/', 'IA', 'NO'),
(124, 20, 'd-id para hacer que una imagen hable en otro idioma', 'https://www.d-id.com/', 'IA', 'NO'),
(125, 20, 'gtmetrix', 'https://gtmetrix.com/', 'Velocidad web', 'NO'),
(126, 20, 'pagespeed', 'https://pagespeed.web.dev/', 'Velocidad web', 'NO'),
(127, 20, 'fontawesome', 'https://fontawesome.com/', 'General', 'NO'),
(128, 20, 'w3schools Código general', 'https://www.w3schools.com/html/default.asp', 'General', 'SI'),
(129, 20, 'developer mozilla documentación general', 'https://developer.mozilla.org/es/', 'General', 'NO'),
(130, 20, 'caniuse compatibilidad de navegadores', 'https://caniuse.com/', 'General', 'SI'),
(131, 20, 'app mobile wordpress', 'https://www.gloriafood.com/', 'General', 'SI'),
(132, 20, 'app mobile wordpress2', 'https://www.oracle.com/es/food-beverage/restaurant-pos-systems/online-ordering/gloriafood/', 'General', 'SI'),
(133, 20, 'codepen código comunidad', 'https://codepen.io/trending', 'General', 'SI'),
(134, 20, 'netlify subir web online temporalmente', 'https://app.netlify.com/drop/', 'General', 'NO'),
(135, 20, 'datalemur práctica técnicas sql ejercicios', 'https://datalemur.com/sql-interview-questions', 'General', 'NO'),
(136, 20, 'ilovepdf un editor de pdf', 'https://www.ilovepdf.com/es', 'General', 'SI'),
(137, 20, 'sketch parecido a Excalidraw', 'https://sketch.io/sketchpad/', 'General', 'NO'),
(138, 20, 'Excalidraw', 'https://excalidraw.com/', 'General', 'SI'),
(139, 20, 'Storybook componentes', 'https://storybook.js.org/', 'General', 'NO'),
(140, 20, 'babeljs', 'https://babeljs.io/', 'General', 'NO'),
(141, 20, 'jestjs para test unitarios', 'https://jestjs.io/', 'General', 'NO'),
(142, 20, 'vite utilizado en react', 'https://vitejs.dev/', 'General', 'NO'),
(143, 20, 'remover fondo imagen', 'https://www.remove.bg/es', 'Imágenes/videos', 'SI'),
(144, 20, 'uicolors paleta colores', 'https://uicolors.app/create', 'General', 'NO'),
(145, 20, 'canva paleta colores', 'https://www.canva.com/colors/color-palette-generator/', 'General', 'NO'),
(146, 20, 'mothereff contador bits', 'https://mothereff.in/byte-counter', 'General', 'NO'),
(147, 20, 'it-tools cojunto de herramientas', 'https://it-tools.tech/url-encoder', 'General', 'NO'),
(148, 20, 'coolors paleta de colores', 'https://coolors.co/463f3a-8a817c-bcb8b1-f4f3ee-e0afa0', 'General', 'NO'),
(149, 20, 'counterscale subir web estática', 'https://counterscale.dev/', 'General', 'NO'),
(150, 20, 'vercel subir web estática gratis', 'https://vercel.com/pricing', 'General', 'NO'),
(151, 20, 'mosaico template con código', 'https://mosaico.io/', 'Html/css', 'SI'),
(152, 20, 'juegos css', 'https://www.espai.es/blog/2022/04/8-juegos-para-aprender-css/', 'Html/css', 'NO'),
(153, 20, 'generalcdd generator', 'https://html-css-js.com/css/generator/box-shadow/', 'Html/css', 'NO'),
(154, 20, 'heropatterns patron css', 'https://heropatterns.com/', 'Html/css', 'NO'),
(155, 20, 'animistra animación css', 'https://animista.net/play/basic/scale-up', 'Html/css', 'SI'),
(156, 20, 'htmlcolorodes', 'https://htmlcolorcodes.com/es/', 'Html/css', 'NO'),
(157, 20, 'webgradient gradientes css', 'https://webgradients.com/', 'Html/css', 'SI'),
(158, 20, 'uigradients', 'https://uigradients.com/#CheerUpEmoKid', 'Html/css', 'SI'),
(159, 20, 'csstricks documentación css', 'https://css-tricks.com/snippets/css/a-guide-to-flexbox/', 'Html/css', 'NO'),
(160, 20, 'general de todo', 'https://lenguajehtml.com/html/', 'Html/css', 'NO'),
(161, 20, 'htmlrev plantillas', 'https://htmlrev.com/', 'General', 'NO'),
(162, 20, 'uiverse.io componentes', 'https://uiverse.io/', 'Html/css', 'SI'),
(163, 20, 'bennettfeely efecto clip', 'https://bennettfeely.com/clippy/', 'Html/css', 'SI'),
(164, 20, 'feeecodez componentes', 'https://freecodez.com/html', 'Html/css', 'NO'),
(165, 20, 'samherbert loaders librería', 'https://samherbert.net/svg-loaders/', 'Javascript', 'NO'),
(166, 20, '9elements efecto fancy', 'https://9elements.github.io/fancy-border-radius/#44.47.43.67--.', 'Html/css', 'NO'),
(167, 20, 'css-peeps crear muñeco', 'https://css-peeps.com/', 'Imágenes/videos', 'SI'),
(168, 20, 'css doodle', 'https://css-doodle.com/', 'Html/css', 'NO'),
(169, 20, 'loading loader css', 'https://loading.io/css/', 'Html/css', 'SI'),
(170, 20, 'toptal paleta colores', 'https://www.toptal.com/designers/subtlepatterns/', 'Imágenes/videos', 'NO'),
(171, 20, 'toptal paleta colores2', 'https://www.toptal.com/designers/colourcode/monochrome-color-builder', 'Html/css', 'NO'),
(172, 20, 'button en tailwind css', 'https://buttons.ibelick.com/', 'Html/css', 'NO'),
(173, 20, 'canvas react uvcanvas', 'https://uvcanvas.com/', 'General', 'NO'),
(174, 20, 'lottiefiles animadas', 'https://lottiefiles.com/', 'Imágenes/videos', 'SI'),
(175, 20, 'smooth.ie efecto wave', 'https://smooth.ie/blogs/news/svg-wavey-transitions-between-sections', 'Imágenes/videos', 'NO'),
(176, 20, 'animate libreria', 'https://animate.style/', 'Html/css', 'NO'),
(177, 20, 'transition libreria', 'https://www.transition.style/', 'Html/css', 'SI'),
(178, 20, 'animación libreria scroll', 'https://scrollrevealjs.org/guide/hello-world.html', 'Javascript', 'SI'),
(179, 20, 'libreria hora js', 'https://momentjs.com/', 'Javascript', 'NO'),
(180, 20, 'libreria hamburguesa', 'https://jonsuh.com/hamburgers/', 'Javascript', 'NO'),
(181, 20, 'aprendejs', 'https://www.aprendejavascript.dev/', 'Cursos', 'SI'),
(182, 20, 'libro js', 'https://es.javascript.info/', 'Cursos', 'SI'),
(183, 20, 'sliders js', 'https://swiperjs.com/', 'Javascript', 'SI'),
(184, 20, 'parallax js libreria', 'https://matthew.wagerfield.com/parallax/', 'Javascript', 'NO'),
(185, 20, 'librería gráficos js', 'https://apexcharts.com/', 'Javascript', 'NO'),
(186, 20, 'drag and drop js', 'https://drag-and-drop.formkit.com/', 'Javascript', 'NO'),
(187, 20, 'css-loaders js', 'https://css-loaders.com/wobbling/', 'Javascript', 'SI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`) VALUES
(4, 'Juan', '$2y$10$8kIQQME/ehAqssm3j7fWcuMBpiZKlXO3FeOAsQdQRI4rFs704LIt2', 'juan@gmail.com', 'user'),
(20, 'ANGEL', '$2y$04$FSyJZfWa9UB7tRedCbdIk.MUjpUgYUPJ4ZlhOQR0Chuh/MKb316h2', 'higueromora@hotmail.com', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `filtros`
--
ALTER TABLE `filtros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `filtros`
--
ALTER TABLE `filtros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `filtros`
--
ALTER TABLE `filtros`
  ADD CONSTRAINT `filtros_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD CONSTRAINT `recursos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
