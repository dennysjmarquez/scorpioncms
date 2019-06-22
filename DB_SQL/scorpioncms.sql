-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Servidor: sql307.byetcluster.com
-- Tiempo de generación: 22-06-2019 a las 18:32:03
-- Versión del servidor: 5.6.41-84.1
-- Versión de PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `b33_18347367_scorpioncms`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) unsigned DEFAULT '0',
  `lft` bigint(20) unsigned NOT NULL DEFAULT '0',
  `rgt` bigint(20) unsigned NOT NULL DEFAULT '0',
  `level` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(32) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `count` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=142 ;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `slug`, `count`) VALUES
(1, 0, 0, 8, 0, 'uncategorized', 'uncategorized', 0),
(139, 0, 2, 7, 1, 'cate2', 'cate2', 0),
(140, 139, 3, 6, 2, 'care3', 'care3', 0),
(141, 140, 4, 5, 3, 'cate4', 'cate4', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `author` tinytext NOT NULL,
  `email` varchar(100) NOT NULL,
  `url` varchar(200) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `content` text NOT NULL,
  `karma` int(11) NOT NULL DEFAULT '0',
  `approved` varchar(20) NOT NULL DEFAULT '1',
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `author`, `email`, `url`, `ip`, `date`, `content`, `karma`, `approved`, `parent`, `user_id`) VALUES
(1, 1, 'Dennys Márquez', '', '', '', '2015-11-08 00:00:00', 'Hola esto es un comentario de prueba', 0, '1', 0, 1),
(2, 1, 'Dennys Márquez', '', '', '', '2015-11-08 00:00:00', 'Hola esto es un comentario de prueba2', 0, '1', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(13, 'current_theme', 'default'),
(2, 'theme_root', 'themes/default'),
(3, 'posts_per_page', '4'),
(4, 'siteurl', 'http://www.scorpioncms.webdeveloperes.ml'),
(5, 'sitename', 'Scorpion CMS'),
(6, 'site_description', 'Scorpion un CMS hecho en Venezuela'),
(7, 'suf_post', 'posts'),
(8, 'suf_category', 'categorias'),
(11, 'SYSLANG', 'es-ES'),
(10, 'gmt_offset', '0'),
(12, 'TLANG', 'en-US');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=103 ;

--
-- Volcado de datos para la tabla `data`
--

INSERT INTO `data` (`id`, `name`, `slug`) VALUES
(100, 'demo', 'demo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) DEFAULT '0',
  `author_id` bigint(20) unsigned NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `content` longtext NOT NULL,
  `title` text NOT NULL,
  `name` varchar(200) NOT NULL,
  `post_type` varchar(20) NOT NULL DEFAULT 'standard',
  `type` varchar(20) NOT NULL DEFAULT 'post',
  `meta` longtext,
  `status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment` varchar(20) NOT NULL DEFAULT 'open',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id`, `category_id`, `author_id`, `date`, `content`, `title`, `name`, `post_type`, `type`, `meta`, `status`, `comment`) VALUES
(45, 1, 1, '2019-01-14 15:57:32', '<h1>Hola esto es un texto Demo</h1><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc lobortis eget nulla mollis sagittis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque magna augue, eleifend ut imperdiet non, fringilla sit amet urna. Integer pretium, neque a ultricies commodo, nulla eros viverra enim, id placerat libero magna vitae lectus. Sed tortor risus, semper vitae massa sed, tincidunt pharetra lectus. Proin vestibulum, dolor ac lobortis dignissim, mauris lorem feugiat metus, sit amet bibendum neque nulla non massa. Nulla bibendum neque ut euismod fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ut mi mollis mauris euismod rutrum quis et tellus. Sed condimentum neque quis lacus malesuada bibendum. Phasellus ut mi velit. Sed nec ligula enim. Proin porttitor ultricies leo quis ultricies. Nunc tempus dolor est, non facilisis eros vestibulum at.</p><p>Aenean et porta tortor. Sed a neque ac leo posuere rutrum. Praesent eget dolor et massa fringilla malesuada. Etiam interdum ullamcorper bibendum. Cras porta tellus non lorem vestibulum sodales. Nunc id arcu sem. Morbi non vulputate nisi.</p>', 'Demo', 'demo', 'standard', 'post', NULL, 'publish', 'open');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postmeta`
--

CREATE TABLE IF NOT EXISTS `postmeta` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `postmeta`
--

INSERT INTO `postmeta` (`id`, `post_id`, `name`, `value`) VALUES
(4, 12, '_views', '14297522'),
(26, 45, '_attached_image', '/dennys.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relation`
--

CREATE TABLE IF NOT EXISTS `relation` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `data_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL,
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=128 ;

--
-- Volcado de datos para la tabla `relation`
--

INSERT INTO `relation` (`id`, `object_id`, `data_id`, `taxonomy`, `count`) VALUES
(125, 45, 100, 'post_tag', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL,
  `type` varchar(60) NOT NULL,
  `display_name` varchar(250) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `token` varchar(250) DEFAULT NULL,
  `identifier` varchar(250) DEFAULT NULL,
  `timeout` int(10) unsigned NOT NULL,
  `register_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user_login`, `type`, `display_name`, `user_pass`, `token`, `identifier`, `timeout`, `register_date`) VALUES
(1, 'demo', 'admin', 'Dennys Márquez', '$2y$10$6vlfeIvRd68vrUFzDmb93ue80jf3emkATLGQgFzSX0r/T8rBo1vKO', 'U0elNLJnCnCVM1dfgnSX4rVxyOCnWQZOheTNHVOdEu', 'fed93066f2872bb07ddb7e53b63fc564', 1560986544, '2015-01-01 08:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
