SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `scorpioncms`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=138 ;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `slug`, `count`) VALUES
(1, 0, 0, 2, 0, 'uncategorized', 'uncategorized', 0);

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
(4, 'siteurl', 'http://cambiar+siteurl+en+la+tabla+config/'),
(5, 'sitename', 'Scorpion CMS'),
(6, 'site_description', 'Scorpion un CMS hecho en Venezuela'),
(7, 'suf_post', 'posts'),
(8, 'suf_category', 'categorias'),
(11, 'SYSLANG', 'es-ES'),
(10, 'gmt_offset', '0'),
(12, 'TLANG', 'es-ES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100 ;

--
-- Volcado de datos para la tabla `data`
--

INSERT INTO `data` (`id`, `name`, `slug`) VALUES
(98, 'Scorpicon-cms', 'scorpicon-cms'),
(99, 'venezuela', 'venezuela');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id`, `category_id`, `author_id`, `date`, `content`, `title`, `name`, `post_type`, `type`, `meta`, `status`, `comment`) VALUES
(41, 1, 1, '2016-06-07 20:31:59', '<blockquote><h1>Bienvenido a Scorpion un CMS Hecho en Venezuela.</h1></blockquote>', '¡Hola mundo!', 'hola-mundo', 'standard', 'post', NULL, 'publish', 'open');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `postmeta`
--

INSERT INTO `postmeta` (`id`, `post_id`, `name`, `value`) VALUES
(4, 12, '_views', '14297522');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=125 ;

--
-- Volcado de datos para la tabla `relation`
--

INSERT INTO `relation` (`id`, `object_id`, `data_id`, `taxonomy`, `count`) VALUES
(123, 41, 98, 'post_tag', 0),
(124, 41, 99, 'post_tag', 0);

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
(1, 'demo', 'admin', 'Dennys Márquez', '$2y$10$6vlfeIvRd68vrUFzDmb93ue80jf3emkATLGQgFzSX0r/T8rBo1vKO', 'ZIlFp1FzC7K46Fyzc3EKTjq9VbnTHxlLO8iKotkTjT', '3169e82402b23ca27a83a57fed1399ee', 1465693769, '2015-01-01 08:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
