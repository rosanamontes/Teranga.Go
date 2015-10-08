-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-10-2015 a las 17:14:43
-- Versión del servidor: 5.5.31
-- Versión de PHP: 5.5.29-1+deb.sury.org~precise+3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `teranga`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_access_collections`
--

CREATE TABLE IF NOT EXISTS `elgg_access_collections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `owner_guid` bigint(20) unsigned NOT NULL,
  `site_guid` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `owner_guid` (`owner_guid`),
  KEY `site_guid` (`site_guid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `elgg_access_collections`
--

INSERT INTO `elgg_access_collections` (`id`, `name`, `owner_guid`, `site_guid`) VALUES
(3, 'Grupo: Dakar', 53, 1),
(4, 'Grupo: Kolda', 56, 1),
(5, 'Grupo: Louga', 57, 1),
(6, 'Grupo: Diourbel', 58, 1),
(7, 'Grupo: Touba', 59, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_access_collection_membership`
--

CREATE TABLE IF NOT EXISTS `elgg_access_collection_membership` (
  `user_guid` int(11) NOT NULL,
  `access_collection_id` int(11) NOT NULL,
  PRIMARY KEY (`user_guid`,`access_collection_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `elgg_access_collection_membership`
--

INSERT INTO `elgg_access_collection_membership` (`user_guid`, `access_collection_id`) VALUES
(41, 3),
(41, 4),
(41, 5),
(41, 6),
(41, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_annotations`
--

CREATE TABLE IF NOT EXISTS `elgg_annotations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_guid` bigint(20) unsigned NOT NULL,
  `name_id` int(11) NOT NULL,
  `value_id` int(11) NOT NULL,
  `value_type` enum('integer','text') NOT NULL,
  `owner_guid` bigint(20) unsigned NOT NULL,
  `access_id` int(11) NOT NULL,
  `time_created` int(11) NOT NULL,
  `enabled` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `entity_guid` (`entity_guid`),
  KEY `name_id` (`name_id`),
  KEY `value_id` (`value_id`),
  KEY `owner_guid` (`owner_guid`),
  KEY `access_id` (`access_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_api_users`
--

CREATE TABLE IF NOT EXISTS `elgg_api_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_guid` bigint(20) unsigned DEFAULT NULL,
  `api_key` varchar(40) DEFAULT NULL,
  `secret` varchar(40) NOT NULL,
  `active` int(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `api_key` (`api_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_config`
--

CREATE TABLE IF NOT EXISTS `elgg_config` (
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `site_guid` int(11) NOT NULL,
  PRIMARY KEY (`name`,`site_guid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `elgg_config`
--

INSERT INTO `elgg_config` (`name`, `value`, `site_guid`) VALUES
('view', 's:7:"default";', 1),
('language', 's:2:"es";', 1),
('default_access', 's:1:"1";', 1),
('allow_registration', 'b:1;', 1),
('walled_garden', 'b:0;', 1),
('allow_user_default_access', 's:0:"";', 1),
('default_limit', 'i:10;', 1),
('search_ft_min_word_len', 's:1:"4";', 1),
('search_ft_max_word_len', 's:2:"84";', 1),
('site_featured_menu_names', 'a:4:{i:0;s:7:"members";i:1;s:6:"groups";i:2;s:8:"activity";i:3;s:4:"file";}', 1),
('site_custom_menu_items', 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_datalists`
--

CREATE TABLE IF NOT EXISTS `elgg_datalists` (
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `elgg_datalists`
--

INSERT INTO `elgg_datalists` (`name`, `value`) VALUES
('installed', '1444296169'),
('dataroot', '/var/www/terangago_data/'),
('default_site', '1'),
('version', '2015041400'),
('simplecache_enabled', '1'),
('system_cache_enabled', '1'),
('simplecache_lastupdate', '1444309917'),
('path', '/var/www/teranga.go/'),
('processed_upgrades', 'a:62:{i:0;s:14:"2008100701.php";i:1;s:14:"2008101303.php";i:2;s:14:"2009022701.php";i:3;s:14:"2009041701.php";i:4;s:14:"2009070101.php";i:5;s:14:"2009102801.php";i:6;s:14:"2010010501.php";i:7;s:14:"2010033101.php";i:8;s:14:"2010040201.php";i:9;s:14:"2010052601.php";i:10;s:14:"2010060101.php";i:11;s:14:"2010060401.php";i:12;s:14:"2010061501.php";i:13;s:14:"2010062301.php";i:14;s:14:"2010062302.php";i:15;s:14:"2010070301.php";i:16;s:14:"2010071001.php";i:17;s:14:"2010071002.php";i:18;s:14:"2010111501.php";i:19;s:14:"2010121601.php";i:20;s:14:"2010121602.php";i:21;s:14:"2010121701.php";i:22;s:14:"2010123101.php";i:23;s:14:"2011010101.php";i:24;s:61:"2011021800-1.8_svn-goodbye_walled_garden-083121a656d06894.php";i:25;s:61:"2011022000-1.8_svn-custom_profile_fields-390ac967b0bb5665.php";i:26;s:60:"2011030700-1.8_svn-blog_status_metadata-4645225d7b440876.php";i:27;s:51:"2011031300-1.8_svn-twitter_api-12b832a5a7a3e1bd.php";i:28;s:57:"2011031600-1.8_svn-datalist_grows_up-0b8aec5a55cc1e1c.php";i:29;s:61:"2011032000-1.8_svn-widgets_arent_plugins-61836261fa280a5c.php";i:30;s:59:"2011032200-1.8_svn-admins_like_widgets-7f19d2783c1680d3.php";i:31;s:14:"2011052801.php";i:32;s:60:"2011061200-1.8b1-sites_need_a_site_guid-6d9dcbf46c0826cc.php";i:33;s:62:"2011092500-1.8.0.1-forum_reply_river_view-5758ce8d86ac56ce.php";i:34;s:54:"2011123100-1.8.2-fix_friend_river-b17e7ff8345c2269.php";i:35;s:53:"2011123101-1.8.2-fix_blog_status-b14c2a0e7b9e7d55.php";i:36;s:50:"2012012000-1.8.3-ip_in_syslog-87fe0f068cf62428.php";i:37;s:50:"2012012100-1.8.3-system_cache-93100e7d55a24a11.php";i:38;s:59:"2012041800-1.8.3-dont_filter_passwords-c0ca4a18b38ae2bc.php";i:39;s:58:"2012041801-1.8.3-multiple_user_tokens-852225f7fd89f6c5.php";i:40;s:59:"2013010200-1.9.0_dev-river_target_guid-66cbcae057cfa3ad.php";i:41;s:62:"2013010400-1.9.0_dev-comments_to_entities-faba94768b055b08.php";i:42;s:61:"2013021000-1.9.0_dev-web_services_plugin-85a61b4884b9b9e3.php";i:43;s:60:"2013022000-1.9.0-datadir_dates_to_guids-efb02ff11b9d6444.php";i:44;s:59:"2013030600-1.8.13-update_user_location-8999eb8bf1bdd9a3.php";i:45;s:62:"2013051700-1.8.15-add_missing_group_index-52a63a3a3ffaced2.php";i:46;s:53:"2013052900-1.8.15-ipv6_in_syslog-f5c2cc0196e9e731.php";i:47;s:50:"2013060900-1.8.15-site_secret-404fc165cf9e0ac9.php";i:48;s:63:"2013062200-1.9.0_dev-new_remember_me_table-da1bfc6f36c7952e.php";i:49;s:54:"2013062700-1.9.0_dev-add_db_queue-e6af82afc6d3eee3.php";i:50;s:50:"2014012000-1.8.18-remember_me-9a8a433685cf7be9.php";i:51;s:61:"2014031100-1.9.0_dev-elgg_upgrade_object-5577af53c93abd1a.php";i:52;s:55:"2014032200-1.9.0_dev-tinymce_to_ck-bbd2daa1912deaef.php";i:53;s:60:"2014042500-1.9.0_dev-site-notifications-0aae171afb7a00d8.php";i:54;s:61:"2014050600-1.9.0_dev-replies_to_entities-094ea0e36bc027d3.php";i:55;s:60:"2014070600-1.9.0_rc.3-river_enabled_col-bef9e6f0533ac338.php";i:56;s:60:"2014090900-1.9.0-fix_processed_upgrades-183ad189c71872d8.php";i:57;s:62:"2014111600-1.9.4-recheck_comments_upgrade-9da270072a5b0cad.php";i:58;s:58:"2014111800-1.10.0-add_new_hash_column-536087bbb2dbc82b.php";i:59;s:56:"2014130300-1.10.0-add_default_limit-fcef9e7ce01e26a4.php";i:60;s:62:"2015031300-1.11.0_dev-comment-access-sync-50c9764e5845315c.php";i:61;s:59:"2015041400-1.11.0_dev-trim_metastrings-d9a9fdfa28a981a3.php";}'),
('admin_registered', '1'),
('__site_secret__', 'zcuaqeBJpy4zEHtxUkn1v2dnvTsHFpM1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_entities`
--

CREATE TABLE IF NOT EXISTS `elgg_entities` (
  `guid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('object','user','group','site') NOT NULL,
  `subtype` int(11) DEFAULT NULL,
  `owner_guid` bigint(20) unsigned NOT NULL,
  `site_guid` bigint(20) unsigned NOT NULL,
  `container_guid` bigint(20) unsigned NOT NULL,
  `access_id` int(11) NOT NULL,
  `time_created` int(11) NOT NULL,
  `time_updated` int(11) NOT NULL,
  `last_action` int(11) NOT NULL DEFAULT '0',
  `enabled` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`guid`),
  KEY `type` (`type`),
  KEY `subtype` (`subtype`),
  KEY `owner_guid` (`owner_guid`),
  KEY `site_guid` (`site_guid`),
  KEY `container_guid` (`container_guid`),
  KEY `access_id` (`access_id`),
  KEY `time_created` (`time_created`),
  KEY `time_updated` (`time_updated`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Volcado de datos para la tabla `elgg_entities`
--

INSERT INTO `elgg_entities` (`guid`, `type`, `subtype`, `owner_guid`, `site_guid`, `container_guid`, `access_id`, `time_created`, `time_updated`, `last_action`, `enabled`) VALUES
(1, 'site', 0, 0, 1, 0, 2, 1444296169, 1444314431, 1444296169, 'yes'),
(2, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'no'),
(3, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(4, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(5, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(6, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(7, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(8, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(9, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(10, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(11, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(12, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(13, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(14, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(15, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(16, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(17, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(18, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(19, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(20, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(21, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(22, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(23, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(24, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(25, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(26, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(27, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(28, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(29, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(30, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(31, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(32, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(33, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(34, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(35, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(36, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(37, 'object', 1, 1, 1, 1, 2, 1444296169, 1444296169, 1444296169, 'yes'),
(38, 'object', 1, 1, 1, 1, 2, 1444296170, 1444296170, 1444296170, 'no'),
(39, 'object', 1, 1, 1, 1, 2, 1444296170, 1444296170, 1444296170, 'yes'),
(40, 'object', 1, 1, 1, 1, 2, 1444296170, 1444296170, 1444296170, 'yes'),
(41, 'user', 0, 0, 1, 0, 2, 1444296186, 1444310052, 1444311380, 'yes'),
(42, 'object', 3, 41, 1, 41, 0, 1444296186, 1444296186, 1444296186, 'yes'),
(43, 'object', 3, 41, 1, 41, 0, 1444296186, 1444296186, 1444296186, 'yes'),
(44, 'object', 3, 41, 1, 41, 0, 1444296186, 1444296186, 1444296186, 'yes'),
(45, 'object', 3, 41, 1, 41, 0, 1444296186, 1444296186, 1444296186, 'yes'),
(46, 'object', 3, 41, 1, 41, 0, 1444296186, 1444296186, 1444296186, 'yes'),
(47, 'user', 0, 0, 1, 0, 2, 1444310208, 1444310208, 1444311219, 'yes'),
(48, 'user', 0, 0, 1, 0, 2, 1444310245, 1444311416, 1444311362, 'yes'),
(49, 'object', 9, 41, 1, 41, 2, 1444311571, 1444313103, 1444311571, 'yes'),
(50, 'object', 10, 41, 1, 41, 2, 1444311923, 1444312986, 1444311923, 'yes'),
(51, 'object', 11, 41, 1, 41, 2, 1444312737, 1444312803, 1444312737, 'yes'),
(52, 'user', 0, 0, 1, 0, 2, 1444314855, 1444314855, 1444314855, 'yes'),
(53, 'group', 0, 41, 1, 41, 2, 1444315556, 1444315932, 1444315556, 'yes'),
(54, 'object', 2, 41, 1, 53, 1, 1444315708, 1444315807, 1444315708, 'yes'),
(55, 'object', 12, 41, 1, 53, 1, 1444315993, 1444315993, 1444315993, 'yes'),
(56, 'group', 0, 41, 1, 41, 2, 1444316110, 1444316110, 1444316110, 'yes'),
(57, 'group', 0, 41, 1, 41, 2, 1444316218, 1444316218, 1444316218, 'yes'),
(58, 'group', 0, 41, 1, 41, 2, 1444316300, 1444316300, 1444316300, 'yes'),
(59, 'group', 0, 41, 1, 41, 2, 1444316365, 1444316365, 1444316365, 'yes'),
(60, 'object', 12, 41, 1, 58, 1, 1444316427, 1444316427, 1444316427, 'yes'),
(61, 'object', 2, 41, 1, 59, 1, 1444316513, 1444316513, 1444316513, 'yes'),
(62, 'object', 12, 41, 1, 59, 1, 1444316584, 1444316584, 1444316584, 'yes'),
(63, 'user', 0, 0, 1, 0, 2, 1444316647, 1444316647, 1444316647, 'yes'),
(64, 'user', 0, 0, 1, 0, 2, 1444316764, 1444316764, 1444316764, 'yes'),
(65, 'user', 0, 0, 1, 0, 2, 1444316787, 1444316787, 1444316787, 'yes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_entity_relationships`
--

CREATE TABLE IF NOT EXISTS `elgg_entity_relationships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid_one` bigint(20) unsigned NOT NULL,
  `relationship` varchar(50) NOT NULL,
  `guid_two` bigint(20) unsigned NOT NULL,
  `time_created` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `guid_one` (`guid_one`,`relationship`,`guid_two`),
  KEY `relationship` (`relationship`),
  KEY `guid_two` (`guid_two`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Volcado de datos para la tabla `elgg_entity_relationships`
--

INSERT INTO `elgg_entity_relationships` (`id`, `guid_one`, `relationship`, `guid_two`, `time_created`) VALUES
(31, 34, 'active_plugin', 1, 1444309675),
(33, 48, 'member_of_site', 1, 1444310245),
(27, 7, 'active_plugin', 1, 1444296439),
(4, 6, 'active_plugin', 1, 1444296170),
(5, 14, 'active_plugin', 1, 1444296170),
(6, 15, 'active_plugin', 1, 1444296170),
(7, 16, 'active_plugin', 1, 1444296170),
(8, 17, 'active_plugin', 1, 1444296170),
(9, 18, 'active_plugin', 1, 1444296170),
(10, 20, 'active_plugin', 1, 1444296170),
(11, 21, 'active_plugin', 1, 1444296170),
(12, 23, 'active_plugin', 1, 1444296170),
(13, 24, 'active_plugin', 1, 1444296170),
(14, 25, 'active_plugin', 1, 1444296170),
(15, 26, 'active_plugin', 1, 1444296170),
(16, 27, 'active_plugin', 1, 1444296170),
(26, 13, 'active_plugin', 1, 1444296423),
(18, 29, 'active_plugin', 1, 1444296170),
(19, 30, 'active_plugin', 1, 1444296170),
(20, 31, 'active_plugin', 1, 1444296170),
(32, 47, 'member_of_site', 1, 1444310208),
(22, 37, 'active_plugin', 1, 1444296170),
(23, 40, 'active_plugin', 1, 1444296170),
(24, 41, 'member_of_site', 1, 1444296186),
(25, 33, 'active_plugin', 1, 1444296405),
(34, 41, 'friend', 47, 1444311219),
(35, 41, 'friend', 48, 1444311222),
(36, 48, 'friend', 41, 1444311380),
(37, 52, 'member_of_site', 1, 1444314855),
(38, 41, 'member', 53, 1444315556),
(39, 41, 'member', 56, 1444316110),
(40, 41, 'member', 57, 1444316218),
(41, 57, 'invited', 47, 1444316245),
(42, 41, 'member', 58, 1444316300),
(43, 41, 'member', 59, 1444316365),
(44, 63, 'member_of_site', 1, 1444316647),
(45, 64, 'member_of_site', 1, 1444316764),
(46, 65, 'member_of_site', 1, 1444316787);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_entity_subtypes`
--

CREATE TABLE IF NOT EXISTS `elgg_entity_subtypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('object','user','group','site') NOT NULL,
  `subtype` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `type` (`type`,`subtype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `elgg_entity_subtypes`
--

INSERT INTO `elgg_entity_subtypes` (`id`, `type`, `subtype`, `class`) VALUES
(1, 'object', 'plugin', 'ElggPlugin'),
(2, 'object', 'file', 'ElggFile'),
(3, 'object', 'widget', 'ElggWidget'),
(4, 'object', 'comment', 'ElggComment'),
(5, 'object', 'elgg_upgrade', 'ElggUpgrade'),
(6, 'object', 'blog', ''),
(7, 'object', 'discussion_reply', 'ElggDiscussionReply'),
(8, 'object', 'thewire', ''),
(9, 'object', 'privacy', ''),
(10, 'object', 'terms', ''),
(11, 'object', 'about', ''),
(12, 'object', 'groupforumtopic', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_geocode_cache`
--

CREATE TABLE IF NOT EXISTS `elgg_geocode_cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(128) DEFAULT NULL,
  `lat` varchar(20) DEFAULT NULL,
  `long` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `location` (`location`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_groups_entity`
--

CREATE TABLE IF NOT EXISTS `elgg_groups_entity` (
  `guid` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`guid`),
  KEY `name` (`name`(50)),
  KEY `description` (`description`(50)),
  FULLTEXT KEY `name_2` (`name`,`description`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `elgg_groups_entity`
--

INSERT INTO `elgg_groups_entity` (`guid`, `name`, `description`) VALUES
(53, 'Dakar', '<div>\r\n<div>\r\n<div><span>Superficie: </span><span>82,38 km²</span></div>\r\n</div>\r\n</div>\r\n\r\n<div>\r\n<div>\r\n<div><span>Tiempo: </span><span>31 °C, viento SO a 8 km/h, 70 % de humedad</span></div>\r\n</div>\r\n</div>\r\n\r\n<div>\r\n<div>\r\n<div><span>Población: </span><span>1,056 millones (2011)</span> <span>Organización de las Naciones Unidas</span></div>\r\n</div>\r\n</div>\r\n\r\n<div>\r\n<div>\r\n<div><span>Hora local: </span><span>miércoles, 14:44</span></div>\r\n</div>\r\n</div>\r\n\r\n<div>\r\n<div>\r\n<div><span>Número De Aeropuertos: </span><span>1</span></div>\r\n</div>\r\n</div>\r\n\r\n<div>\r\n<div><span>Universidad: </span><span><a href="https://www.google.es/search?biw=1615&amp;bih=923&amp;q=universidad+cheikh+anta+diop&amp;stick=H4sIAAAAAAAAAOPgE-LQz9U3SDasyFXiBLHMMgwry7WUspOt9HPykxNLMvPz4Ayr0rzMstSi4sySzNRiAM4lgs87AAAA&amp;sa=X&amp;ved=0CKYBEJsTKAEwGGoVChMIic6awsywyAIVg9kaCh1tpg_R">Universidad Cheikh-Anta-Diop</a></span></div>\r\n\r\n<div> </div>\r\n\r\n<div><span>Más sobre Dakar en <a href="http://es.wikipedia.org/wiki/Dakar"><span>Wikipedia</span></a></span></div>\r\n</div>'),
(56, 'Kolda', '<div>\r\n<div>\r\n<div>Histórica y popularmente se conoce a la región como Haute Casamance</div>\r\n\r\n<div> </div>\r\n\r\n<div><span>Superficie: </span><span>13.771 km²</span></div>\r\n</div>\r\n</div>\r\n\r\n<div>\r\n<div>\r\n<div><span>Sede: </span><span>Kolda</span></div>\r\n</div>\r\n</div>\r\n\r\n<div>\r\n<div><span>Universidad: </span><span><a href="https://www.google.es/search?biw=1615&amp;bih=923&amp;q=ecole+william+ponty&amp;stick=H4sIAAAAAAAAAOPgE-LUz9U3MDeqTDNU4gIxjYoyckzTtJSyk630c_KTE0sy8_PgDKvSvMyy1KLizJLM1GIAX2jGHz0AAAA&amp;sa=X&amp;ved=0CIgBEJsTKAEwE2oVChMI9OqXks2wyAIVhtoaCh20QgGa">École normale supérieure William Ponty</a></span></div>\r\n\r\n<div>\r\n<div>\r\n<div> </div>\r\n\r\n<div><span>Más sobre Kolda en </span><span><a href="http://es.wikipedia.org/wiki/Regi%C3%B3n_de_Kolda"><span>Wikipedia</span></a></span></div>\r\n</div>\r\n</div>\r\n</div>'),
(57, 'Louga', '<div>\r\n<div>\r\n<div>La región de Louga se encuentra en el sur del país, y su capital, la ciudad de Louga, en el noroeste de la región, a unos 50 km. de distancia de la costa atlántica.</div>\r\n\r\n<div> </div>\r\n\r\n<div><span>Superficie: </span><span>24.889 km²</span></div>\r\n</div>\r\n</div>\r\n\r\n<div>\r\n<div><span>Sede: </span><span>Louga</span></div>\r\n\r\n<div> </div>\r\n\r\n<div><span>Más sobre Louga en <a href="http://es.wikipedia.org/wiki/Regi%C3%B3n_de_Louga"><span>Wikipedia</span></a></span></div>\r\n</div>'),
(58, 'Diourbel', '<div>\r\n<div><span>Diourbel es una ciudad de Senegal cuyo nombre tradicional es Ndiarem. Está situada en el interior del país, a unos 150 km al este de la capital Dakar. Es capital del departamento y la región homónimas.</span></div>\r\n</div>\r\n\r\n<div> </div>\r\n\r\n<div>\r\n<div><span>Población: </span><span>279.667 (2011)</span> <span>Organización de las Naciones Unidas</span></div>\r\n\r\n<div> </div>\r\n\r\n<div>Más sobre Diourbel en <span><a href="http://es.wikipedia.org/wiki/Diourbel"><span>Wikipedia</span></a></span></div>\r\n</div>'),
(59, 'Touba', '<div>\r\n<div><span>Touba es la ciudad sagrada del Muridismo y lugar de entierro de su fundador, Shaikh Aamadu Bàmba Mbàkke. Cerca de su tumba se encuentra una gran mezquita fechada en 1963.</span><span> </span></div>\r\n</div>\r\n\r\n<div> </div>\r\n\r\n<div>\r\n<div><span>Población: </span><span>529.176 (2010)</span></div>\r\n\r\n<div> </div>\r\n\r\n<div>Más sobre Touba en <span><a href="http://es.wikipedia.org/wiki/Touba_%28Senegal%29"><span>Wikipedia</span></a></span></div>\r\n</div>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_hmac_cache`
--

CREATE TABLE IF NOT EXISTS `elgg_hmac_cache` (
  `hmac` varchar(255) NOT NULL,
  `ts` int(11) NOT NULL,
  PRIMARY KEY (`hmac`),
  KEY `ts` (`ts`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_metadata`
--

CREATE TABLE IF NOT EXISTS `elgg_metadata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_guid` bigint(20) unsigned NOT NULL,
  `name_id` int(11) NOT NULL,
  `value_id` int(11) NOT NULL,
  `value_type` enum('integer','text') NOT NULL,
  `owner_guid` bigint(20) unsigned NOT NULL,
  `access_id` int(11) NOT NULL,
  `time_created` int(11) NOT NULL,
  `enabled` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `entity_guid` (`entity_guid`),
  KEY `name_id` (`name_id`),
  KEY `value_id` (`value_id`),
  KEY `owner_guid` (`owner_guid`),
  KEY `access_id` (`access_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=131 ;

--
-- Volcado de datos para la tabla `elgg_metadata`
--

INSERT INTO `elgg_metadata` (`id`, `entity_guid`, `name_id`, `value_id`, `value_type`, `owner_guid`, `access_id`, `time_created`, `enabled`) VALUES
(1, 1, 1, 2, 'text', 0, 2, 1444296169, 'yes'),
(2, 41, 3, 4, 'text', 41, 2, 1444296186, 'yes'),
(3, 41, 5, 4, 'text', 0, 2, 1444296186, 'yes'),
(4, 41, 6, 7, 'text', 0, 2, 1444296186, 'yes'),
(16, 41, 13, 29, 'integer', 41, 2, 1444310081, 'yes'),
(17, 41, 14, 30, 'integer', 41, 2, 1444310081, 'yes'),
(7, 41, 15, 11, 'integer', 41, 2, 1444309989, 'yes'),
(18, 41, 16, 31, 'integer', 41, 2, 1444310081, 'yes'),
(15, 41, 17, 28, 'integer', 41, 2, 1444310081, 'yes'),
(10, 41, 19, 20, 'text', 41, 1, 1444310052, 'yes'),
(11, 41, 21, 22, 'text', 41, 1, 1444310052, 'yes'),
(12, 41, 23, 24, 'text', 41, 1, 1444310052, 'yes'),
(13, 41, 25, 26, 'text', 41, 1, 1444310052, 'yes'),
(19, 47, 3, 4, 'text', 47, 2, 1444310208, 'yes'),
(20, 47, 32, 4, 'text', 47, 2, 1444310208, 'yes'),
(21, 47, 33, 9, 'integer', 47, 2, 1444310208, 'yes'),
(22, 48, 3, 4, 'text', 48, 2, 1444310245, 'yes'),
(23, 48, 32, 4, 'text', 48, 2, 1444310245, 'yes'),
(24, 48, 33, 9, 'integer', 48, 2, 1444310245, 'yes'),
(36, 48, 13, 42, 'integer', 48, 2, 1444311362, 'yes'),
(37, 48, 14, 43, 'integer', 48, 2, 1444311362, 'yes'),
(38, 48, 15, 44, 'integer', 48, 2, 1444311362, 'yes'),
(39, 48, 16, 45, 'integer', 48, 2, 1444311362, 'yes'),
(35, 48, 17, 41, 'integer', 48, 2, 1444311362, 'yes'),
(40, 52, 3, 4, 'text', 52, 2, 1444314855, 'yes'),
(42, 52, 5, 4, 'text', 41, 2, 1444314855, 'yes'),
(43, 52, 6, 107, 'text', 41, 2, 1444314855, 'yes'),
(44, 53, 49, 50, 'text', 41, 2, 1444315556, 'yes'),
(63, 53, 51, 78, 'text', 41, 2, 1444315932, 'yes'),
(46, 53, 52, 50, 'text', 41, 2, 1444315556, 'yes'),
(47, 53, 53, 54, 'integer', 41, 2, 1444315556, 'yes'),
(48, 53, 55, 56, 'text', 41, 2, 1444315556, 'yes'),
(49, 53, 57, 58, 'integer', 41, 2, 1444315556, 'yes'),
(50, 53, 17, 59, 'integer', 41, 2, 1444315556, 'yes'),
(51, 54, 60, 61, 'text', 41, 1, 1444315708, 'yes'),
(52, 54, 62, 63, 'text', 41, 1, 1444315708, 'yes'),
(53, 54, 64, 65, 'text', 41, 1, 1444315708, 'yes'),
(54, 54, 66, 67, 'text', 41, 1, 1444315708, 'yes'),
(57, 54, 68, 69, 'text', 41, 1, 1444315807, 'yes'),
(58, 54, 70, 71, 'text', 41, 1, 1444315807, 'yes'),
(59, 53, 72, 73, 'text', 41, 2, 1444315932, 'yes'),
(60, 53, 74, 75, 'text', 41, 2, 1444315932, 'yes'),
(61, 53, 74, 76, 'text', 41, 2, 1444315932, 'yes'),
(62, 53, 74, 77, 'text', 41, 2, 1444315932, 'yes'),
(64, 55, 79, 80, 'text', 41, 1, 1444315993, 'yes'),
(65, 55, 81, 82, 'text', 41, 1, 1444315993, 'yes'),
(66, 56, 72, 83, 'text', 41, 2, 1444316110, 'yes'),
(67, 56, 74, 75, 'text', 41, 2, 1444316110, 'yes'),
(68, 56, 74, 84, 'text', 41, 2, 1444316110, 'yes'),
(69, 56, 74, 85, 'text', 41, 2, 1444316110, 'yes'),
(70, 56, 49, 50, 'text', 41, 2, 1444316110, 'yes'),
(71, 56, 51, 78, 'text', 41, 2, 1444316110, 'yes'),
(72, 56, 52, 50, 'text', 41, 2, 1444316110, 'yes'),
(73, 56, 53, 54, 'integer', 41, 2, 1444316110, 'yes'),
(74, 56, 55, 56, 'text', 41, 2, 1444316110, 'yes'),
(75, 56, 57, 86, 'integer', 41, 2, 1444316110, 'yes'),
(76, 56, 17, 87, 'integer', 41, 2, 1444316110, 'yes'),
(77, 57, 72, 88, 'text', 41, 2, 1444316218, 'yes'),
(78, 57, 74, 75, 'text', 41, 2, 1444316218, 'yes'),
(79, 57, 74, 89, 'text', 41, 2, 1444316218, 'yes'),
(80, 57, 49, 50, 'text', 41, 2, 1444316218, 'yes'),
(81, 57, 51, 78, 'text', 41, 2, 1444316218, 'yes'),
(82, 57, 52, 50, 'text', 41, 2, 1444316218, 'yes'),
(83, 57, 53, 54, 'integer', 41, 2, 1444316218, 'yes'),
(84, 57, 55, 56, 'text', 41, 2, 1444316218, 'yes'),
(85, 57, 57, 90, 'integer', 41, 2, 1444316218, 'yes'),
(86, 57, 17, 91, 'integer', 41, 2, 1444316218, 'yes'),
(87, 58, 72, 92, 'text', 41, 2, 1444316300, 'yes'),
(88, 58, 74, 75, 'text', 41, 2, 1444316300, 'yes'),
(89, 58, 74, 93, 'text', 41, 2, 1444316300, 'yes'),
(90, 58, 74, 94, 'text', 41, 2, 1444316300, 'yes'),
(91, 58, 49, 50, 'text', 41, 2, 1444316300, 'yes'),
(92, 58, 51, 78, 'text', 41, 2, 1444316300, 'yes'),
(93, 58, 52, 50, 'text', 41, 2, 1444316300, 'yes'),
(94, 58, 53, 54, 'integer', 41, 2, 1444316300, 'yes'),
(95, 58, 55, 56, 'text', 41, 2, 1444316300, 'yes'),
(96, 58, 57, 95, 'integer', 41, 2, 1444316300, 'yes'),
(97, 58, 17, 96, 'integer', 41, 2, 1444316300, 'yes'),
(98, 59, 72, 97, 'text', 41, 2, 1444316365, 'yes'),
(99, 59, 74, 75, 'text', 41, 2, 1444316365, 'yes'),
(100, 59, 74, 98, 'text', 41, 2, 1444316365, 'yes'),
(101, 59, 74, 99, 'text', 41, 2, 1444316365, 'yes'),
(102, 59, 49, 50, 'text', 41, 2, 1444316365, 'yes'),
(103, 59, 51, 78, 'text', 41, 2, 1444316365, 'yes'),
(104, 59, 52, 50, 'text', 41, 2, 1444316365, 'yes'),
(105, 59, 53, 54, 'integer', 41, 2, 1444316365, 'yes'),
(106, 59, 55, 56, 'text', 41, 2, 1444316365, 'yes'),
(107, 59, 57, 100, 'integer', 41, 2, 1444316365, 'yes'),
(108, 59, 17, 101, 'integer', 41, 2, 1444316365, 'yes'),
(109, 60, 79, 80, 'text', 41, 1, 1444316427, 'yes'),
(110, 60, 81, 102, 'text', 41, 1, 1444316427, 'yes'),
(111, 60, 81, 94, 'text', 41, 1, 1444316427, 'yes'),
(112, 60, 81, 75, 'text', 41, 1, 1444316427, 'yes'),
(113, 61, 81, 103, 'text', 41, 1, 1444316513, 'yes'),
(114, 61, 60, 104, 'text', 41, 1, 1444316513, 'yes'),
(115, 61, 62, 105, 'text', 41, 1, 1444316513, 'yes'),
(116, 61, 64, 65, 'text', 41, 1, 1444316513, 'yes'),
(117, 61, 66, 67, 'text', 41, 1, 1444316513, 'yes'),
(118, 61, 68, 69, 'text', 41, 1, 1444316513, 'yes'),
(119, 61, 70, 71, 'text', 41, 1, 1444316513, 'yes'),
(120, 62, 79, 80, 'text', 41, 1, 1444316584, 'yes'),
(121, 62, 81, 106, 'text', 41, 1, 1444316584, 'yes'),
(122, 63, 3, 4, 'text', 63, 2, 1444316647, 'yes'),
(123, 63, 32, 4, 'text', 63, 2, 1444316647, 'yes'),
(124, 63, 33, 9, 'integer', 63, 2, 1444316647, 'yes'),
(125, 64, 3, 4, 'text', 64, 2, 1444316764, 'yes'),
(126, 64, 32, 4, 'text', 64, 2, 1444316764, 'yes'),
(127, 64, 33, 9, 'integer', 64, 2, 1444316764, 'yes'),
(128, 65, 3, 4, 'text', 65, 2, 1444316787, 'yes'),
(129, 65, 32, 4, 'text', 65, 2, 1444316787, 'yes'),
(130, 65, 33, 9, 'integer', 65, 2, 1444316787, 'yes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_metastrings`
--

CREATE TABLE IF NOT EXISTS `elgg_metastrings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `string` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `string` (`string`(50))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=108 ;

--
-- Volcado de datos para la tabla `elgg_metastrings`
--

INSERT INTO `elgg_metastrings` (`id`, `string`) VALUES
(1, 'email'),
(2, 'teranga@googlegroups.com'),
(3, 'notification:method:email'),
(4, '1'),
(5, 'validated'),
(6, 'validated_method'),
(7, 'admin_user'),
(8, 'toId'),
(9, '41'),
(10, 'readYet'),
(11, '0'),
(12, 'msg'),
(13, 'x1'),
(14, 'x2'),
(15, 'y1'),
(16, 'y2'),
(17, 'icontime'),
(18, '1444309989'),
(19, 'description'),
(20, '<div>\r\n<p>Profesora del departamento de Lenguajes y Sistemas Informáticos </p>\r\n</div>\r\n\r\n<div>\r\n<p>Universidad de Granada</p>\r\n</div>'),
(21, 'location'),
(22, 'E.T.S. Ingeniería Informática y de Telecomunicación - E18014 Granada'),
(23, 'website'),
(24, 'http://lsi.ugr.es/rosana'),
(25, 'twitter'),
(26, '@rosanamontes'),
(27, '1444310070'),
(28, '1444310081'),
(29, '66'),
(30, '487'),
(31, '421'),
(32, 'admin_created'),
(33, 'created_by_guid'),
(34, '48'),
(35, '1444311345'),
(36, '1444311351'),
(37, '38'),
(38, '275'),
(39, '82'),
(40, '319'),
(41, '1444311362'),
(42, '58'),
(43, '258'),
(44, '115'),
(45, '315'),
(46, 'disable_reason'),
(47, 'uservalidationbyemail_new_user'),
(48, ''),
(49, 'file_enable'),
(50, 'yes'),
(51, 'activity_enable'),
(52, 'forum_enable'),
(53, 'membership'),
(54, '2'),
(55, 'content_access_mode'),
(56, 'unrestricted'),
(57, 'group_acl'),
(58, '3'),
(59, '1444315556'),
(60, 'filename'),
(61, 'file/1444315708mapacartografico_senegal.pdf'),
(62, 'originalfilename'),
(63, 'mapaCartografico_Senegal.pdf'),
(64, 'mimetype'),
(65, 'application/pdf'),
(66, 'simpletype'),
(67, 'document'),
(68, 'filestore::dir_root'),
(69, '/var/www/terangago_data/'),
(70, 'filestore::filestore'),
(71, 'ElggDiskFilestore'),
(72, 'briefdescription'),
(73, 'Dakar es la capital de Senegal, situada en la península de Cabo Verde, en la costa atlántica de África.'),
(74, 'interests'),
(75, 'senegal'),
(76, 'cabo verde'),
(77, 'dakar'),
(78, 'no'),
(79, 'status'),
(80, 'open'),
(81, 'tags'),
(82, 'anecdota'),
(83, 'Kolda es el nombre de una región de Senegal.'),
(84, 'haute casamance'),
(85, 'kolda'),
(86, '4'),
(87, '1444316110'),
(88, 'Louga es el nombre de una región de Senegal y de su capital.'),
(89, 'louga'),
(90, '5'),
(91, '1444316218'),
(92, 'Diourbel es una ciudad de Senegal'),
(93, 'ndiarem'),
(94, 'diourbel'),
(95, '6'),
(96, '1444316300'),
(97, 'Touba es una ciudad en el corazón de Senegal'),
(98, 'touba'),
(99, 'muridismo'),
(100, '7'),
(101, '1444316365'),
(102, 'comida'),
(103, 'textos'),
(104, 'file/1444316513analisistouba_gueye59-76.pdf'),
(105, 'analisisTouba_Gueye59-76.pdf'),
(106, 'documentación'),
(107, 'manual');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_objects_entity`
--

CREATE TABLE IF NOT EXISTS `elgg_objects_entity` (
  `guid` bigint(20) unsigned NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`guid`),
  FULLTEXT KEY `title` (`title`,`description`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `elgg_objects_entity`
--

INSERT INTO `elgg_objects_entity` (`guid`, `title`, `description`) VALUES
(2, 'aalborg_theme', ''),
(3, 'blog', ''),
(4, 'bookmarks', ''),
(5, 'categories', ''),
(6, 'ckeditor', ''),
(7, 'custom_index', ''),
(8, 'dashboard', ''),
(9, 'developers', ''),
(10, 'diagnostics', ''),
(11, 'easytheme2', ''),
(12, 'embed', ''),
(13, 'externalpages', ''),
(14, 'file', ''),
(15, 'garbagecollector', ''),
(16, 'groups', ''),
(17, 'htmlawed', ''),
(18, 'invitefriends', ''),
(19, 'legacy_urls', ''),
(20, 'likes', ''),
(21, 'logbrowser', ''),
(22, 'login_as', ''),
(23, 'logrotate', ''),
(24, 'members', ''),
(25, 'messageboard', ''),
(26, 'messages', ''),
(27, 'notifications', ''),
(28, 'pages', ''),
(29, 'profile', ''),
(30, 'reportedcontent', ''),
(31, 'search', ''),
(32, 'site_notifications', ''),
(33, 'tagcloud', ''),
(34, 'teranga_theme', ''),
(35, 'thewire', ''),
(36, 'twitter_api', ''),
(37, 'uservalidationbyemail', ''),
(38, 'vrawa', ''),
(39, 'web_services', ''),
(40, 'zaudio', ''),
(42, '', ''),
(43, '', ''),
(44, '', ''),
(45, '', ''),
(46, '', ''),
(49, 'privacy', '<p>Los materiales de esta plataforma se rigen bajo la licencia CC by-nc-sa, salvo indicaci&oacute;n expresa de cada recurso que puede venir acompa&ntilde;ado de su propia licencia.</p>\r\n\r\n<p align="center"><img alt="CC" border="0" height="35" src="http://tamen.ugr.es/mooc/mod/cev_mooc_zone/graphics/by-nc-sa_100.jpg" width="100" /></p>\r\n\r\n<p>Puede encontrar m&aacute;s informaci&oacute;n en <a href="http://creativecommons.org/licenses/by-nc-sa/2.5/es/" target="_blank" title="http://creativecommons.org/licenses/by-nc-sa/2.5/es/">http://creativecommons.org/licenses/by-nc-sa/2.5/es/</a></p>\r\n\r\n<p>Se recuerda a los usuarios que la informaci&oacute;n personal relativa al perfil permite especificar el nivel de privacidad de la informaci&oacute;n, por lo que se debe tener en cuenta que si establece el valor a P&uacute;blico el motor de b&uacute;squeda de Google podr&aacute; indicar la p&aacute;gina y mostrar su perfil a usuarios no registrados en la comunidad.</p>'),
(50, 'terms', '<p style="text-align: justify;">El acceso y uso de este sitio Web est&aacute; sujeto a las normas y condiciones generales que se especifican a continuaci&oacute;n.</p>\r\n\r\n<p style="text-align: justify;"><strong>Condiciones generales de uso &nbsp; </strong></p>\r\n\r\n<p style="text-align: justify;"><strong>1. Descripci&oacute;n del servio</strong></p>\r\n\r\n<p style="text-align: justify;"><strong>Teranga Go!&nbsp;</strong>es una Plataforma de econom&iacute;a colaborativa para la movilidad entre Espa&ntilde;a y Senegal desarrollada bajo la financiacion del CEI BioTIC de la Universidad de Granada y en colaboraci&oacute;n con la empresa granadina Acento comunicaci&oacute;n. Actualmente se frece como una plataforma piloto&nbsp;desde la UGR, a trav&eacute;s del proyecto TIC11-2015, pero en un futuro ser&aacute; un servicio consolidado.</p>\r\n\r\n<p style="text-align: justify;">El acceso a este sitio Web es voluntario, y se adquiere la condici&oacute;n de &ldquo;usuario&rdquo; una vez que se haya registrado y se acepten las <em>condiciones generales de uso</em>, sin perjuicio de las condiciones espec&iacute;ficas que pueda tener la empresa Acento Comunicaci&oacute;n, y que prevalecer&aacute;n sobre las condiciones aqu&iacute; contempladas en su sitio <a href="http://terangago.com">http://terangago.com</a>.</p>\r\n\r\n<p style="text-align: justify;">Por lo tanto se recomienda sean le&iacute;das detenidamente antes de llevar a cabo alg&uacute;n tipo de acci&oacute;n, disponiendo el usuario en caso de tener alguna duda, de la siguiente direcci&oacute;n de correo <a href="mailto:teranga@googlegroups.com?subject=%5BTeranga%20Go!%5D%20Consulta%20&amp;body=No%20olvide%20poner%20su%20nombre%20de%20contacto">teranga@googlegroups.com</a></p>\r\n\r\n<p style="text-align: justify;"><strong>&nbsp;</strong></p>\r\n\r\n<p style="text-align: justify;"><strong>2. Prestaci&oacute;n del servicio</strong></p>\r\n\r\n<p style="text-align: justify;">La Universidad de Granada aloja&nbsp;la web de Teranga Go!&nbsp;que actualmente es de car&aacute;cter gratuito para&nbsp;ser un servicio&nbsp;social que mejore las condiciones de los senegaleses en Espa&ntilde;a. El sitio puede contener foros, debates con opiniones personales y otras expresiones de los usuarios que en algunos casos pueden no estar moderados, por lo que la UGR no se hace responsable de los contenidos de este sitio. La Universidad se reserva el derecho (pero no la obligaci&oacute;n) de eliminar todos los contenidos que puedan ser impropios de los fines del servicio.</p>\r\n\r\n<p style="text-align: justify;">La Universidad de Granada no se hace responsable de la interrupci&oacute;n de cualquier servicio o del acceso a nuestra Web sin previo aviso, ya sea por motivos de seguridad, t&eacute;cnicos, de mantenimiento o causados por un tercero.</p>\r\n\r\n<p style="text-align: justify;">Asimismo, la Universidad de Granada se reserva la capacidad de modificar las presentes condiciones de uso as&iacute; como las condiciones particulares que, en su caso, se puedan incluir. Los Usuarios podr&aacute;n conocer cualquier modificaci&oacute;n en dichas condiciones a trav&eacute;s de este portal (http://tamen.ugr.es/teranga.go) as&iacute; como las publicaciones que se hagan a tal efecto en el SITIO WEB de la UGR.</p>\r\n\r\n<p style="text-align: justify;">La UGR no garantiza la disponibilidad y continuidad del funcionamiento del portal <i>Teranga Go!</i>&nbsp;por causas ajenas, informando en aquellos casos que haya una interrupci&oacute;n temporal &nbsp;en el funcionamiento del Sitio Web y de los Servicio prestados. La UGR queda excluida toda responsabilidad respecto de cualquier efecto producido&nbsp;por da&ntilde;os y perjuicios de toda naturaleza que puedan atribuirse a la falta de disponibilidad o de continuidad del Sitio Web, a la falibilidad de los mismos o a los posibles fallos en el acceso a las distintas p&aacute;ginas web del Sitio o a aquellas desde las que se prestan los servicios.</p>\r\n\r\n<p style="text-align: justify;"><strong>&nbsp;</strong></p>\r\n\r\n<p style="text-align: justify;"><strong>3. Registro de usuarios</strong></p>\r\n\r\n<p style="text-align: justify;">El acceso a la comunidad&nbsp;se realiza previa inscripci&oacute;n y aceptados las condiciones de uso del servicio. Una vez aceptado y registrado, el usuario se compromete a hacer un uso adecuado de los contenidos y servicios que se ofrecen en el presente sitio Web. El usuario ser&aacute; responsable de aportar datos veraces y l&iacute;citos, no atentar contra los derechos de intimidad, privacidad, imagen, de propiedad intelectual o industrial, que correspondan a terceros.</p>\r\n\r\n<p style="text-align: justify;">Asimismo, el usuario se compromete mediante esta declaraci&oacute;n de honor a la realizaci&oacute;n honesta de las actividades y&nbsp;a no hacer un uso malintencionado o lucrativo de los recursos que se ponen a su servicio.</p>\r\n\r\n<p style="text-align: justify;">Esta condici&oacute;n de usuario se adquiere en el registro y se mantiene hasta que no solicite expresamente una baja de la plataforma. Este periodo no tiene una duraci&oacute;n m&aacute;xima prevista, pudiendo ser limitado en el tiempo por causa t&eacute;cnicas, por petici&oacute;n del usuario o por baja por alg&uacute;n motivo de exclusi&oacute;n.&nbsp;</p>\r\n\r\n<p style="text-align: justify;">&nbsp;</p>\r\n\r\n<p style="text-align: justify;"><strong>4. Derecho de exclusi&oacute;n</strong></p>\r\n\r\n<p style="text-align: justify;">La Universidad de Granada, como entidad que gestiona el sitio Web y los datos alojados en el mismo, se reserva el derecho a dar de baja o denegar el acceso al sitio Web, sin previo aviso, a aquellos usuarios que no cumplan las presentes condiciones generales de uso, o las condiciones espec&iacute;ficas que se se&ntilde;alen en su caso.</p>\r\n\r\n<p style="text-align: justify;"><strong>&nbsp;</strong></p>\r\n\r\n<p style="text-align: justify;"><strong>5. Baja voluntaria del usuario</strong></p>\r\n\r\n<p style="text-align: justify;">Si llegado un momento el usuario desea darse de baja del &aacute;rea de usuarios registrados, puede hacerlo enviando un correo electr&oacute;nico a la siguiente direcci&oacute;n:&nbsp;<a href="mailto:rosana@ugr.es?subject=%5BTeranga%20Go!%5D%20Baja&amp;body=Puede%20indicar%20los%20motivos%20de%20la%20baja%20aqu%C3%AD.">rosana@ugr.es</a></p>\r\n\r\n<p style="text-align: justify;">&nbsp;</p>\r\n\r\n<p style="text-align: justify;"><strong>6. Cancelaci&oacute;n de los datos del usuario</strong></p>\r\n\r\n<p style="text-align: justify;">En caso de que se produzca la baja voluntaria del usuario en el servicio, o esta se lleve a cabo por otros motivos, como el incumplimiento de las condiciones de uso, sus datos pasar&aacute;n a ser cancelados de acuerdo a lo establecido en la Ley Org&aacute;nica de Protecci&oacute;n de Datos.</p>'),
(51, 'about', '<h3>Plataforma de econom&iacute;a colaborativa para la movilidad entre Espa&ntilde;a y Senegal</h3>\r\n\r\n<h5>C&oacute;digo del proyecto: TIC11-2015</h5>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p class="western">El objetivo principal del proyecto reside en favorecer la movilidad de los flujos migratorios internacionales bas&aacute;ndose en conceptos de econom&iacute;a colaborativa y consumo participativo. En concreto se crear&aacute; un sistema web/app similar al concepto de <i>carsharing</i> (ej. Bla Bla Car) pero bas&aacute;ndose en los flujos migratorios entre Espa&ntilde;a y Senegal para aprovechar el <i>know how</i> en este &aacute;mbito de Acento Comunicaci&oacute;n, empresa impulsora de la iniciativa. Las conclusiones que se saquen en la ejecuci&oacute;n del proyecto servir&aacute;n para aplicar y adaptar este producto a otras rutas entre Europa y &Aacute;frica (flujos constantes migratorios que existe en la realidad).</p>\r\n\r\n<p class="western">El equipo de Acento Comunicaci&oacute;n cuenta con personal multidisciplinar adem&aacute;s de contacto con la comunidad senegal&eacute;s. Entre las fortalezas m&aacute;s claras, la componentes de dise&ntilde;o gr&aacute;fico, audiovisuales, programaci&oacute;n y comunicaci&oacute;n. &nbsp;</p>\r\n\r\n<p class="western">Participantes:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p class="western">Cabrera Cuevas, Marcelino</p>\r\n	</li>\r\n	<li>\r\n	<p class="western">Fern&aacute;ndez Janssens, I&ntilde;aki</p>\r\n	</li>\r\n	<li>\r\n	<p class="western">G&oacute;mez Gonzalo, Gustavo</p>\r\n	</li>\r\n	<li>\r\n	<p class="western">Luque Romero, Jara</p>\r\n	</li>\r\n	<li>\r\n	<p class="western">Montes Soldado, Rosana (coord.)</p>\r\n	</li>\r\n	<li>\r\n	<p class="western">Sanchez L&oacute;pez, Ana M&ordf;</p>\r\n	</li>\r\n	<li>\r\n	<p class="western">Villar Castro, Pedro &nbsp;&nbsp;</p>\r\n\r\n	<p class="western">&nbsp;</p>\r\n	</li>\r\n</ul>'),
(54, 'Mapa Cartográfico de Senegal', '<p>Ejemplo de contenido de un grupo</p>'),
(55, 'Paparazzis en Dakar', '<p>En mi ultimo viaje me confundieron con una famosa y tuve que maquinar un plan B para salir airosa del local...</p>'),
(60, 'El mejor sitio para comer en Diourbel', '<p>No os vais a imaginar lo que os voy a contar aqu&iacute;, mi experiencia fue inolvidable :-)</p>'),
(61, 'Touba: territorio ideal y lugar de retorno producido por los muridas', '<p>Interesante reflexi&oacute;n sobre bla bla bla...</p>'),
(62, 'Recomendaciones para viajar a Touba', '<p>Hola. Alguien puede decirme si es necesario algun tipo de documentaci&oacute;n oficial para viajar Senegal? Espero ir pronto a Touba</p>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_private_settings`
--

CREATE TABLE IF NOT EXISTS `elgg_private_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_guid` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `entity_guid` (`entity_guid`,`name`),
  KEY `name` (`name`),
  KEY `value` (`value`(50))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=97 ;

--
-- Volcado de datos para la tabla `elgg_private_settings`
--

INSERT INTO `elgg_private_settings` (`id`, `entity_guid`, `name`, `value`) VALUES
(2, 3, 'elgg:internal:priority', '1'),
(3, 4, 'elgg:internal:priority', '2'),
(4, 5, 'elgg:internal:priority', '3'),
(5, 6, 'elgg:internal:priority', '4'),
(6, 7, 'elgg:internal:priority', '5'),
(7, 8, 'elgg:internal:priority', '6'),
(8, 9, 'elgg:internal:priority', '7'),
(9, 10, 'elgg:internal:priority', '8'),
(61, 34, 'et2menu', '#363636'),
(11, 12, 'elgg:internal:priority', '9'),
(12, 13, 'elgg:internal:priority', '10'),
(13, 14, 'elgg:internal:priority', '11'),
(14, 15, 'elgg:internal:priority', '12'),
(15, 16, 'elgg:internal:priority', '13'),
(16, 17, 'elgg:internal:priority', '14'),
(17, 18, 'elgg:internal:priority', '15'),
(18, 19, 'elgg:internal:priority', '16'),
(19, 20, 'elgg:internal:priority', '17'),
(20, 21, 'elgg:internal:priority', '18'),
(21, 22, 'elgg:internal:priority', '19'),
(22, 23, 'elgg:internal:priority', '20'),
(23, 24, 'elgg:internal:priority', '21'),
(24, 25, 'elgg:internal:priority', '22'),
(25, 26, 'elgg:internal:priority', '23'),
(26, 27, 'elgg:internal:priority', '24'),
(27, 28, 'elgg:internal:priority', '25'),
(28, 29, 'elgg:internal:priority', '26'),
(29, 30, 'elgg:internal:priority', '27'),
(30, 31, 'elgg:internal:priority', '28'),
(31, 32, 'elgg:internal:priority', '29'),
(32, 33, 'elgg:internal:priority', '30'),
(33, 34, 'elgg:internal:priority', '36'),
(34, 35, 'elgg:internal:priority', '31'),
(35, 36, 'elgg:internal:priority', '32'),
(36, 37, 'elgg:internal:priority', '33'),
(62, 34, 'et2menu1', '#aabbaa'),
(38, 39, 'elgg:internal:priority', '34'),
(39, 40, 'elgg:internal:priority', '35'),
(40, 35, 'limit', '140'),
(41, 42, 'handler', 'control_panel'),
(42, 42, 'context', 'admin'),
(43, 42, 'column', '1'),
(44, 42, 'order', '0'),
(45, 43, 'handler', 'admin_welcome'),
(46, 43, 'context', 'admin'),
(47, 43, 'order', '10'),
(48, 43, 'column', '1'),
(49, 44, 'handler', 'online_users'),
(50, 44, 'context', 'admin'),
(51, 44, 'column', '2'),
(52, 44, 'order', '0'),
(53, 45, 'handler', 'new_users'),
(54, 45, 'context', 'admin'),
(55, 45, 'order', '10'),
(56, 45, 'column', '2'),
(57, 46, 'handler', 'content_stats'),
(58, 46, 'context', 'admin'),
(59, 46, 'order', '20'),
(60, 46, 'column', '2'),
(63, 34, 'et2menu2', '#1d3d1d'),
(64, 34, 'et2menua', '#fff'),
(65, 34, 'et2search', '-27px'),
(66, 34, 'et2color1', '#38599e'),
(67, 34, 'et2color2', '#a95e27'),
(68, 34, 'et2footh', '100px'),
(69, 34, 'et2footbk', '#eee'),
(70, 34, 'et2foottext', '#999'),
(71, 34, 'et2footlink', '#ccc'),
(72, 34, 'et2foothov', '#666'),
(73, 34, 'et2forms', 'no'),
(85, 11, 'et2footh', '100px'),
(86, 11, 'et2footbk', '#eee'),
(87, 11, 'et2foottext', '#999'),
(88, 11, 'et2footlink', '#ccc'),
(89, 11, 'et2foothov', '#666'),
(90, 11, 'et2forms', 'no'),
(77, 11, 'elgg:internal:priority', '37'),
(78, 11, 'et2menu', '#363636'),
(79, 11, 'et2menu1', '#AABBAA'),
(80, 11, 'et2menu2', '#1d3d71d'),
(81, 11, 'et2menua', '#fff'),
(82, 11, 'et2search', '-27px'),
(83, 11, 'et2color1', '#38599e'),
(84, 11, 'et2color2', '#a95e27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_queue`
--

CREATE TABLE IF NOT EXISTS `elgg_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `data` mediumblob NOT NULL,
  `timestamp` int(11) NOT NULL,
  `worker` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `retrieve` (`timestamp`,`worker`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `elgg_queue`
--

INSERT INTO `elgg_queue` (`id`, `name`, `data`, `timestamp`, `worker`) VALUES
(1, 'notifications', 0x4f3a32343a22456c67675c4e6f74696669636174696f6e735c4576656e74223a353a7b733a393a22002a00616374696f6e223b733a363a22637265617465223b733a31343a22002a006f626a6563745f74797065223b733a363a226f626a656374223b733a31373a22002a006f626a6563745f73756274797065223b733a343a2266696c65223b733a31323a22002a006f626a6563745f6964223b693a35343b733a31333a22002a006163746f725f67756964223b693a34313b7d, 1444315708, NULL),
(2, 'notifications', 0x4f3a32343a22456c67675c4e6f74696669636174696f6e735c4576656e74223a353a7b733a393a22002a00616374696f6e223b733a363a22637265617465223b733a31343a22002a006f626a6563745f74797065223b733a363a226f626a656374223b733a31373a22002a006f626a6563745f73756274797065223b733a31353a2267726f7570666f72756d746f706963223b733a31323a22002a006f626a6563745f6964223b693a35353b733a31333a22002a006163746f725f67756964223b693a34313b7d, 1444315993, NULL),
(3, 'notifications', 0x4f3a32343a22456c67675c4e6f74696669636174696f6e735c4576656e74223a353a7b733a393a22002a00616374696f6e223b733a363a22637265617465223b733a31343a22002a006f626a6563745f74797065223b733a363a226f626a656374223b733a31373a22002a006f626a6563745f73756274797065223b733a31353a2267726f7570666f72756d746f706963223b733a31323a22002a006f626a6563745f6964223b693a36303b733a31333a22002a006163746f725f67756964223b693a34313b7d, 1444316427, NULL),
(4, 'notifications', 0x4f3a32343a22456c67675c4e6f74696669636174696f6e735c4576656e74223a353a7b733a393a22002a00616374696f6e223b733a363a22637265617465223b733a31343a22002a006f626a6563745f74797065223b733a363a226f626a656374223b733a31373a22002a006f626a6563745f73756274797065223b733a343a2266696c65223b733a31323a22002a006f626a6563745f6964223b693a36313b733a31333a22002a006163746f725f67756964223b693a34313b7d, 1444316513, NULL),
(5, 'notifications', 0x4f3a32343a22456c67675c4e6f74696669636174696f6e735c4576656e74223a353a7b733a393a22002a00616374696f6e223b733a363a22637265617465223b733a31343a22002a006f626a6563745f74797065223b733a363a226f626a656374223b733a31373a22002a006f626a6563745f73756274797065223b733a31353a2267726f7570666f72756d746f706963223b733a31323a22002a006f626a6563745f6964223b693a36323b733a31333a22002a006163746f725f67756964223b693a34313b7d, 1444316584, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_river`
--

CREATE TABLE IF NOT EXISTS `elgg_river` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(8) NOT NULL,
  `subtype` varchar(32) NOT NULL,
  `action_type` varchar(32) NOT NULL,
  `access_id` int(11) NOT NULL,
  `view` text NOT NULL,
  `subject_guid` int(11) NOT NULL,
  `object_guid` int(11) NOT NULL,
  `target_guid` int(11) NOT NULL,
  `annotation_id` int(11) NOT NULL,
  `posted` int(11) NOT NULL,
  `enabled` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `action_type` (`action_type`),
  KEY `access_id` (`access_id`),
  KEY `subject_guid` (`subject_guid`),
  KEY `object_guid` (`object_guid`),
  KEY `target_guid` (`target_guid`),
  KEY `annotation_id` (`annotation_id`),
  KEY `posted` (`posted`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `elgg_river`
--

INSERT INTO `elgg_river` (`id`, `type`, `subtype`, `action_type`, `access_id`, `view`, `subject_guid`, `object_guid`, `target_guid`, `annotation_id`, `posted`, `enabled`) VALUES
(3, 'user', '', 'update', 2, 'river/user/default/profileiconupdate', 41, 41, 0, 0, 1444310081, 'yes'),
(4, 'user', '', 'friend', 2, 'river/relationship/friend/create', 41, 47, 0, 0, 1444311219, 'yes'),
(5, 'user', '', 'friend', 2, 'river/relationship/friend/create', 41, 48, 0, 0, 1444311222, 'yes'),
(8, 'user', '', 'update', 2, 'river/user/default/profileiconupdate', 48, 48, 0, 0, 1444311362, 'yes'),
(9, 'user', '', 'friend', 2, 'river/relationship/friend/create', 48, 41, 0, 0, 1444311380, 'yes'),
(10, 'group', '', 'create', 2, 'river/group/create', 41, 53, 0, 0, 1444315556, 'yes'),
(11, 'object', 'file', 'create', 1, 'river/object/file/create', 41, 54, 0, 0, 1444315708, 'yes'),
(12, 'object', 'groupforumtopic', 'create', 1, 'river/object/groupforumtopic/create', 41, 55, 0, 0, 1444315993, 'yes'),
(13, 'group', '', 'create', 2, 'river/group/create', 41, 56, 0, 0, 1444316110, 'yes'),
(14, 'group', '', 'create', 2, 'river/group/create', 41, 57, 0, 0, 1444316218, 'yes'),
(15, 'group', '', 'create', 2, 'river/group/create', 41, 58, 0, 0, 1444316300, 'yes'),
(16, 'group', '', 'create', 2, 'river/group/create', 41, 59, 0, 0, 1444316365, 'yes'),
(17, 'object', 'groupforumtopic', 'create', 1, 'river/object/groupforumtopic/create', 41, 60, 0, 0, 1444316427, 'yes'),
(18, 'object', 'file', 'create', 1, 'river/object/file/create', 41, 61, 0, 0, 1444316513, 'yes'),
(19, 'object', 'groupforumtopic', 'create', 1, 'river/object/groupforumtopic/create', 41, 62, 0, 0, 1444316584, 'yes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_sites_entity`
--

CREATE TABLE IF NOT EXISTS `elgg_sites_entity` (
  `guid` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`guid`),
  UNIQUE KEY `url` (`url`),
  FULLTEXT KEY `name` (`name`,`description`,`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `elgg_sites_entity`
--

INSERT INTO `elgg_sites_entity` (`guid`, `name`, `description`, `url`) VALUES
(1, 'Teranga Go!', '', 'http://tamen.ugr.es/teranga.go/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_system_log`
--

CREATE TABLE IF NOT EXISTS `elgg_system_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL,
  `object_class` varchar(50) NOT NULL,
  `object_type` varchar(50) NOT NULL,
  `object_subtype` varchar(50) NOT NULL,
  `event` varchar(50) NOT NULL,
  `performed_by_guid` int(11) NOT NULL,
  `owner_guid` int(11) NOT NULL,
  `access_id` int(11) NOT NULL,
  `enabled` enum('yes','no') NOT NULL DEFAULT 'yes',
  `time_created` int(11) NOT NULL,
  `ip_address` varchar(46) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `object_class` (`object_class`),
  KEY `object_type` (`object_type`),
  KEY `object_subtype` (`object_subtype`),
  KEY `event` (`event`),
  KEY `performed_by_guid` (`performed_by_guid`),
  KEY `access_id` (`access_id`),
  KEY `time_created` (`time_created`),
  KEY `river_key` (`object_type`,`object_subtype`,`event`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=394 ;

--
-- Volcado de datos para la tabla `elgg_system_log`
--

INSERT INTO `elgg_system_log` (`id`, `object_id`, `object_class`, `object_type`, `object_subtype`, `event`, `performed_by_guid`, `owner_guid`, `access_id`, `enabled`, `time_created`, `ip_address`) VALUES
(1, 2, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(2, 3, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(3, 4, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(4, 5, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(5, 6, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(6, 7, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(7, 8, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(8, 9, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(9, 10, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(10, 11, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(11, 12, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(12, 13, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(13, 14, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(14, 15, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(15, 16, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(16, 17, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(17, 18, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(18, 19, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(19, 20, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(20, 21, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(21, 22, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(22, 23, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(23, 24, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(24, 25, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(25, 26, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(26, 27, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(27, 28, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(28, 29, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(29, 30, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(30, 31, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(31, 32, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(32, 33, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(33, 34, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(34, 35, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(35, 36, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(36, 37, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296169, '150.214.191.252'),
(37, 38, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296170, '150.214.191.252'),
(38, 39, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296170, '150.214.191.252'),
(39, 40, 'ElggPlugin', 'object', 'plugin', 'create', 0, 1, 2, 'yes', 1444296170, '150.214.191.252'),
(40, 1, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(41, 2, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(42, 3, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(43, 4, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(44, 5, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(45, 6, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(46, 7, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(47, 8, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(48, 9, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(49, 10, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(50, 11, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(51, 12, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(52, 13, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(53, 14, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(54, 15, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(55, 16, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(56, 17, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(57, 18, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(58, 19, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(59, 20, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(60, 21, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(61, 22, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(62, 23, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 0, 0, 2, 'yes', 1444296170, '150.214.191.252'),
(63, 24, 'ElggRelationship', 'relationship', 'member_of_site', 'create', 0, 0, 2, 'yes', 1444296186, '150.214.191.252'),
(64, 41, 'ElggUser', 'user', '', 'create', 0, 0, 2, 'yes', 1444296186, '150.214.191.252'),
(65, 2, 'ElggMetadata', 'metadata', 'notification:method:email', 'create', 0, 41, 2, 'yes', 1444296186, '150.214.191.252'),
(66, 42, 'ElggWidget', 'object', 'widget', 'create', 0, 41, 2, 'yes', 1444296186, '150.214.191.252'),
(67, 43, 'ElggWidget', 'object', 'widget', 'create', 0, 41, 2, 'yes', 1444296186, '150.214.191.252'),
(68, 44, 'ElggWidget', 'object', 'widget', 'create', 0, 41, 2, 'yes', 1444296186, '150.214.191.252'),
(69, 45, 'ElggWidget', 'object', 'widget', 'create', 0, 41, 2, 'yes', 1444296186, '150.214.191.252'),
(70, 46, 'ElggWidget', 'object', 'widget', 'create', 0, 41, 2, 'yes', 1444296186, '150.214.191.252'),
(71, 41, 'ElggUser', 'user', '', 'make_admin', 0, 0, 2, 'yes', 1444296186, '150.214.191.252'),
(72, 3, 'ElggMetadata', 'metadata', 'validated', 'create', 0, 0, 2, 'yes', 1444296186, '150.214.191.252'),
(73, 4, 'ElggMetadata', 'metadata', 'validated_method', 'create', 0, 0, 2, 'yes', 1444296186, '150.214.191.252'),
(74, 41, 'ElggUser', 'user', '', 'login:before', 0, 0, 2, 'yes', 1444296186, '150.214.191.252'),
(75, 41, 'ElggUser', 'user', '', 'login', 41, 0, 2, 'yes', 1444296186, '150.214.191.252'),
(76, 41, 'ElggUser', 'user', '', 'login:after', 41, 0, 2, 'yes', 1444296186, '150.214.191.252'),
(77, 38, 'ElggPlugin', 'object', 'plugin', 'disable', 41, 1, 2, 'yes', 1444296398, '150.214.191.252'),
(78, 38, 'ElggPlugin', 'object', 'plugin', 'disable:after', 41, 1, 2, 'no', 1444296398, '150.214.191.252'),
(79, 11, 'ElggPlugin', 'object', 'plugin', 'disable', 41, 1, 2, 'yes', 1444296398, '150.214.191.252'),
(80, 11, 'ElggPlugin', 'object', 'plugin', 'disable:after', 41, 1, 2, 'no', 1444296398, '150.214.191.252'),
(81, 25, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 41, 0, 2, 'yes', 1444296405, '150.214.191.252'),
(82, 17, 'ElggRelationship', 'relationship', 'active_plugin', 'delete', 41, 0, 2, 'yes', 1444296411, '150.214.191.252'),
(83, 26, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 41, 0, 2, 'yes', 1444296423, '150.214.191.252'),
(84, 2, 'ElggRelationship', 'relationship', 'active_plugin', 'delete', 41, 0, 2, 'yes', 1444296429, '150.214.191.252'),
(85, 3, 'ElggRelationship', 'relationship', 'active_plugin', 'delete', 41, 0, 2, 'yes', 1444296432, '150.214.191.252'),
(86, 27, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 41, 0, 2, 'yes', 1444296439, '150.214.191.252'),
(87, 28, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 41, 0, 2, 'yes', 1444296447, '150.214.191.252'),
(88, 41, 'ElggUser', 'user', '', 'logout:before', 41, 0, 2, 'yes', 1444296528, '150.214.191.252'),
(89, 41, 'ElggUser', 'user', '', 'logout', 41, 0, 2, 'yes', 1444296528, '150.214.191.252'),
(90, 41, 'ElggUser', 'user', '', 'logout:after', 0, 0, 2, 'yes', 1444296528, '150.214.191.252'),
(91, 41, 'ElggUser', 'user', '', 'login:before', 0, 0, 2, 'yes', 1444303899, '150.214.191.252'),
(92, 41, 'ElggUser', 'user', '', 'login', 41, 0, 2, 'yes', 1444303899, '150.214.191.252'),
(93, 41, 'ElggUser', 'user', '', 'login:after', 41, 0, 2, 'yes', 1444303899, '150.214.191.252'),
(94, 41, 'ElggUser', 'user', '', 'update', 41, 0, 2, 'yes', 1444303926, '150.214.191.252'),
(95, 41, 'ElggUser', 'user', '', 'update:after', 41, 0, 2, 'yes', 1444303926, '150.214.191.252'),
(96, 41, 'ElggUser', 'user', '', 'login:before', 0, 0, 2, 'yes', 1444304171, '150.214.191.252'),
(97, 41, 'ElggUser', 'user', '', 'login', 41, 0, 2, 'yes', 1444304171, '150.214.191.252'),
(98, 41, 'ElggUser', 'user', '', 'login:after', 41, 0, 2, 'yes', 1444304171, '150.214.191.252'),
(99, 41, 'ElggUser', 'user', '', 'login:before', 0, 0, 2, 'yes', 1444308752, '172.20.36.122'),
(100, 41, 'ElggUser', 'user', '', 'login', 41, 0, 2, 'yes', 1444308752, '172.20.36.122'),
(101, 41, 'ElggUser', 'user', '', 'login:after', 41, 0, 2, 'yes', 1444308752, '172.20.36.122'),
(102, 11, 'ElggPlugin', 'object', 'plugin', 'enable', 41, 1, 2, 'no', 1444308775, '172.20.36.122'),
(103, 11, 'ElggPlugin', 'object', 'plugin', 'enable:after', 41, 1, 2, 'yes', 1444308775, '172.20.36.122'),
(104, 28, 'ElggRelationship', 'relationship', 'active_plugin', 'delete', 41, 0, 2, 'yes', 1444308781, '172.20.36.122'),
(105, 29, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 41, 0, 2, 'yes', 1444308783, '172.20.36.122'),
(106, 41, 'ElggUser', 'user', '', 'logout:before', 41, 0, 2, 'yes', 1444309156, '172.20.36.122'),
(107, 41, 'ElggUser', 'user', '', 'logout', 41, 0, 2, 'yes', 1444309156, '172.20.36.122'),
(108, 41, 'ElggUser', 'user', '', 'logout:after', 0, 0, 2, 'yes', 1444309156, '172.20.36.122'),
(109, 41, 'ElggUser', 'user', '', 'login:before', 0, 0, 2, 'yes', 1444309489, '172.20.36.122'),
(110, 41, 'ElggUser', 'user', '', 'login', 41, 0, 2, 'yes', 1444309489, '172.20.36.122'),
(111, 41, 'ElggUser', 'user', '', 'login:after', 41, 0, 2, 'yes', 1444309489, '172.20.36.122'),
(112, 41, 'ElggUser', 'user', '', 'logout:before', 41, 0, 2, 'yes', 1444309577, '172.20.36.122'),
(113, 41, 'ElggUser', 'user', '', 'logout', 41, 0, 2, 'yes', 1444309577, '172.20.36.122'),
(114, 41, 'ElggUser', 'user', '', 'logout:after', 0, 0, 2, 'yes', 1444309577, '172.20.36.122'),
(115, 41, 'ElggUser', 'user', '', 'login:before', 0, 0, 2, 'yes', 1444309607, '172.20.36.122'),
(116, 41, 'ElggUser', 'user', '', 'login', 41, 0, 2, 'yes', 1444309607, '172.20.36.122'),
(117, 41, 'ElggUser', 'user', '', 'login:after', 41, 0, 2, 'yes', 1444309607, '172.20.36.122'),
(118, 29, 'ElggRelationship', 'relationship', 'active_plugin', 'delete', 41, 0, 2, 'yes', 1444309617, '172.20.36.122'),
(119, 1, 'ElggRelationship', 'relationship', 'active_plugin', 'delete', 41, 0, 2, 'yes', 1444309644, '172.20.36.122'),
(120, 30, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 41, 0, 2, 'yes', 1444309661, '172.20.36.122'),
(121, 30, 'ElggRelationship', 'relationship', 'active_plugin', 'delete', 41, 0, 2, 'yes', 1444309672, '172.20.36.122'),
(122, 31, 'ElggRelationship', 'relationship', 'active_plugin', 'create', 41, 0, 2, 'yes', 1444309675, '172.20.36.122'),
(123, 41, 'ElggUser', 'user', '', 'login:before', 0, 0, 2, 'yes', 1444309872, '150.214.191.252'),
(124, 41, 'ElggUser', 'user', '', 'login', 41, 0, 2, 'yes', 1444309872, '150.214.191.252'),
(125, 41, 'ElggUser', 'user', '', 'login:after', 41, 0, 2, 'yes', 1444309872, '150.214.191.252'),
(126, 21, 'ElggRelationship', 'relationship', 'active_plugin', 'delete', 41, 0, 2, 'yes', 1444309917, '150.214.191.252'),
(127, 5, 'ElggMetadata', 'metadata', 'x1', 'create', 41, 41, 2, 'yes', 1444309989, '150.214.191.252'),
(128, 6, 'ElggMetadata', 'metadata', 'x2', 'create', 41, 41, 2, 'yes', 1444309989, '150.214.191.252'),
(129, 7, 'ElggMetadata', 'metadata', 'y1', 'create', 41, 41, 2, 'yes', 1444309989, '150.214.191.252'),
(130, 8, 'ElggMetadata', 'metadata', 'y2', 'create', 41, 41, 2, 'yes', 1444309989, '150.214.191.252'),
(131, 9, 'ElggMetadata', 'metadata', 'icontime', 'create', 41, 41, 2, 'yes', 1444309989, '150.214.191.252'),
(132, 41, 'ElggUser', 'user', '', 'profileiconupdate', 41, 0, 2, 'yes', 1444309989, '150.214.191.252'),
(133, 10, 'ElggMetadata', 'metadata', 'description', 'create', 41, 41, 1, 'yes', 1444310052, '150.214.191.252'),
(134, 11, 'ElggMetadata', 'metadata', 'location', 'create', 41, 41, 1, 'yes', 1444310052, '150.214.191.252'),
(135, 12, 'ElggMetadata', 'metadata', 'website', 'create', 41, 41, 1, 'yes', 1444310052, '150.214.191.252'),
(136, 13, 'ElggMetadata', 'metadata', 'twitter', 'create', 41, 41, 1, 'yes', 1444310052, '150.214.191.252'),
(137, 41, 'ElggUser', 'user', '', 'update', 41, 0, 2, 'yes', 1444310052, '150.214.191.252'),
(138, 41, 'ElggUser', 'user', '', 'update:after', 41, 0, 2, 'yes', 1444310052, '150.214.191.252'),
(139, 41, 'ElggUser', 'user', '', 'profileupdate', 41, 0, 2, 'yes', 1444310052, '150.214.191.252'),
(140, 9, 'ElggMetadata', 'metadata', 'icontime', 'delete', 41, 41, 2, 'yes', 1444310070, '150.214.191.252'),
(141, 14, 'ElggMetadata', 'metadata', 'icontime', 'create', 41, 41, 2, 'yes', 1444310070, '150.214.191.252'),
(142, 41, 'ElggUser', 'user', '', 'profileiconupdate', 41, 0, 2, 'yes', 1444310070, '150.214.191.252'),
(143, 14, 'ElggMetadata', 'metadata', 'icontime', 'delete', 41, 41, 2, 'yes', 1444310081, '150.214.191.252'),
(144, 15, 'ElggMetadata', 'metadata', 'icontime', 'create', 41, 41, 2, 'yes', 1444310081, '150.214.191.252'),
(145, 5, 'ElggMetadata', 'metadata', 'x1', 'delete', 41, 41, 2, 'yes', 1444310081, '150.214.191.252'),
(146, 16, 'ElggMetadata', 'metadata', 'x1', 'create', 41, 41, 2, 'yes', 1444310081, '150.214.191.252'),
(147, 6, 'ElggMetadata', 'metadata', 'x2', 'delete', 41, 41, 2, 'yes', 1444310081, '150.214.191.252'),
(148, 17, 'ElggMetadata', 'metadata', 'x2', 'create', 41, 41, 2, 'yes', 1444310081, '150.214.191.252'),
(149, 8, 'ElggMetadata', 'metadata', 'y2', 'delete', 41, 41, 2, 'yes', 1444310081, '150.214.191.252'),
(150, 18, 'ElggMetadata', 'metadata', 'y2', 'create', 41, 41, 2, 'yes', 1444310081, '150.214.191.252'),
(151, 32, 'ElggRelationship', 'relationship', 'member_of_site', 'create', 41, 0, 2, 'yes', 1444310208, '150.214.191.252'),
(152, 47, 'ElggUser', 'user', '', 'create', 41, 0, 2, 'yes', 1444310208, '150.214.191.252'),
(153, 19, 'ElggMetadata', 'metadata', 'notification:method:email', 'create', 41, 47, 2, 'yes', 1444310208, '150.214.191.252'),
(154, 47, 'ElggUser', 'user', '', 'update', 41, 0, 2, 'yes', 1444310208, '150.214.191.252'),
(155, 47, 'ElggUser', 'user', '', 'update:after', 41, 0, 2, 'yes', 1444310208, '150.214.191.252'),
(156, 20, 'ElggMetadata', 'metadata', 'admin_created', 'create', 41, 47, 2, 'yes', 1444310208, '150.214.191.252'),
(157, 21, 'ElggMetadata', 'metadata', 'created_by_guid', 'create', 41, 47, 2, 'yes', 1444310208, '150.214.191.252'),
(158, 33, 'ElggRelationship', 'relationship', 'member_of_site', 'create', 41, 0, 2, 'yes', 1444310245, '150.214.191.252'),
(159, 48, 'ElggUser', 'user', '', 'create', 41, 0, 2, 'yes', 1444310245, '150.214.191.252'),
(160, 22, 'ElggMetadata', 'metadata', 'notification:method:email', 'create', 41, 48, 2, 'yes', 1444310245, '150.214.191.252'),
(161, 48, 'ElggUser', 'user', '', 'update', 41, 0, 2, 'yes', 1444310245, '150.214.191.252'),
(162, 48, 'ElggUser', 'user', '', 'update:after', 41, 0, 2, 'yes', 1444310245, '150.214.191.252'),
(163, 23, 'ElggMetadata', 'metadata', 'admin_created', 'create', 41, 48, 2, 'yes', 1444310245, '150.214.191.252'),
(164, 24, 'ElggMetadata', 'metadata', 'created_by_guid', 'create', 41, 48, 2, 'yes', 1444310245, '150.214.191.252'),
(165, 34, 'ElggRelationship', 'relationship', 'friend', 'create', 41, 0, 2, 'yes', 1444311219, '150.214.191.252'),
(166, 35, 'ElggRelationship', 'relationship', 'friend', 'create', 41, 0, 2, 'yes', 1444311222, '150.214.191.252'),
(167, 41, 'ElggUser', 'user', '', 'logout:before', 41, 0, 2, 'yes', 1444311227, '150.214.191.252'),
(168, 41, 'ElggUser', 'user', '', 'logout', 41, 0, 2, 'yes', 1444311227, '150.214.191.252'),
(169, 41, 'ElggUser', 'user', '', 'logout:after', 0, 0, 2, 'yes', 1444311227, '150.214.191.252'),
(170, 48, 'ElggUser', 'user', '', 'login:before', 0, 0, 2, 'yes', 1444311233, '150.214.191.252'),
(171, 48, 'ElggUser', 'user', '', 'login', 48, 0, 2, 'yes', 1444311233, '150.214.191.252'),
(172, 48, 'ElggUser', 'user', '', 'login:after', 48, 0, 2, 'yes', 1444311233, '150.214.191.252'),
(173, 25, 'ElggMetadata', 'metadata', 'x1', 'create', 48, 48, 2, 'yes', 1444311345, '150.214.191.252'),
(174, 26, 'ElggMetadata', 'metadata', 'x2', 'create', 48, 48, 2, 'yes', 1444311345, '150.214.191.252'),
(175, 27, 'ElggMetadata', 'metadata', 'y1', 'create', 48, 48, 2, 'yes', 1444311345, '150.214.191.252'),
(176, 28, 'ElggMetadata', 'metadata', 'y2', 'create', 48, 48, 2, 'yes', 1444311345, '150.214.191.252'),
(177, 29, 'ElggMetadata', 'metadata', 'icontime', 'create', 48, 48, 2, 'yes', 1444311345, '150.214.191.252'),
(178, 48, 'ElggUser', 'user', '', 'profileiconupdate', 48, 0, 2, 'yes', 1444311345, '150.214.191.252'),
(179, 29, 'ElggMetadata', 'metadata', 'icontime', 'delete', 48, 48, 2, 'yes', 1444311351, '150.214.191.252'),
(180, 30, 'ElggMetadata', 'metadata', 'icontime', 'create', 48, 48, 2, 'yes', 1444311351, '150.214.191.252'),
(181, 25, 'ElggMetadata', 'metadata', 'x1', 'delete', 48, 48, 2, 'yes', 1444311351, '150.214.191.252'),
(182, 31, 'ElggMetadata', 'metadata', 'x1', 'create', 48, 48, 2, 'yes', 1444311351, '150.214.191.252'),
(183, 26, 'ElggMetadata', 'metadata', 'x2', 'delete', 48, 48, 2, 'yes', 1444311351, '150.214.191.252'),
(184, 32, 'ElggMetadata', 'metadata', 'x2', 'create', 48, 48, 2, 'yes', 1444311351, '150.214.191.252'),
(185, 27, 'ElggMetadata', 'metadata', 'y1', 'delete', 48, 48, 2, 'yes', 1444311351, '150.214.191.252'),
(186, 33, 'ElggMetadata', 'metadata', 'y1', 'create', 48, 48, 2, 'yes', 1444311351, '150.214.191.252'),
(187, 28, 'ElggMetadata', 'metadata', 'y2', 'delete', 48, 48, 2, 'yes', 1444311351, '150.214.191.252'),
(188, 34, 'ElggMetadata', 'metadata', 'y2', 'create', 48, 48, 2, 'yes', 1444311351, '150.214.191.252'),
(189, 30, 'ElggMetadata', 'metadata', 'icontime', 'delete', 48, 48, 2, 'yes', 1444311362, '150.214.191.252'),
(190, 35, 'ElggMetadata', 'metadata', 'icontime', 'create', 48, 48, 2, 'yes', 1444311362, '150.214.191.252'),
(191, 31, 'ElggMetadata', 'metadata', 'x1', 'delete', 48, 48, 2, 'yes', 1444311362, '150.214.191.252'),
(192, 36, 'ElggMetadata', 'metadata', 'x1', 'create', 48, 48, 2, 'yes', 1444311362, '150.214.191.252'),
(193, 32, 'ElggMetadata', 'metadata', 'x2', 'delete', 48, 48, 2, 'yes', 1444311362, '150.214.191.252'),
(194, 37, 'ElggMetadata', 'metadata', 'x2', 'create', 48, 48, 2, 'yes', 1444311362, '150.214.191.252'),
(195, 33, 'ElggMetadata', 'metadata', 'y1', 'delete', 48, 48, 2, 'yes', 1444311362, '150.214.191.252'),
(196, 38, 'ElggMetadata', 'metadata', 'y1', 'create', 48, 48, 2, 'yes', 1444311362, '150.214.191.252'),
(197, 34, 'ElggMetadata', 'metadata', 'y2', 'delete', 48, 48, 2, 'yes', 1444311362, '150.214.191.252'),
(198, 39, 'ElggMetadata', 'metadata', 'y2', 'create', 48, 48, 2, 'yes', 1444311362, '150.214.191.252'),
(199, 36, 'ElggRelationship', 'relationship', 'friend', 'create', 48, 0, 2, 'yes', 1444311380, '150.214.191.252'),
(200, 48, 'ElggUser', 'user', '', 'update', 48, 0, 2, 'yes', 1444311416, '150.214.191.252'),
(201, 48, 'ElggUser', 'user', '', 'update:after', 48, 0, 2, 'yes', 1444311416, '150.214.191.252'),
(202, 48, 'ElggUser', 'user', '', 'logout:before', 48, 0, 2, 'yes', 1444311421, '150.214.191.252'),
(203, 48, 'ElggUser', 'user', '', 'logout', 48, 0, 2, 'yes', 1444311421, '150.214.191.252'),
(204, 48, 'ElggUser', 'user', '', 'logout:after', 0, 0, 2, 'yes', 1444311421, '150.214.191.252'),
(205, 41, 'ElggUser', 'user', '', 'login:before', 0, 0, 2, 'yes', 1444311430, '150.214.191.252'),
(206, 41, 'ElggUser', 'user', '', 'login', 41, 0, 2, 'yes', 1444311430, '150.214.191.252'),
(207, 41, 'ElggUser', 'user', '', 'login:after', 41, 0, 2, 'yes', 1444311430, '150.214.191.252'),
(208, 49, 'ElggObject', 'object', 'privacy', 'create', 41, 41, 2, 'yes', 1444311571, '150.214.191.252'),
(209, 50, 'ElggObject', 'object', 'terms', 'create', 41, 41, 2, 'yes', 1444311923, '150.214.191.252'),
(210, 50, 'ElggObject', 'object', 'terms', 'update', 41, 41, 2, 'yes', 1444312349, '150.214.191.252'),
(211, 50, 'ElggObject', 'object', 'terms', 'update:after', 41, 41, 2, 'yes', 1444312349, '150.214.191.252'),
(212, 50, 'ElggObject', 'object', 'terms', 'update', 41, 41, 2, 'yes', 1444312608, '150.214.191.252'),
(213, 50, 'ElggObject', 'object', 'terms', 'update:after', 41, 41, 2, 'yes', 1444312608, '150.214.191.252'),
(214, 49, 'ElggObject', 'object', 'privacy', 'update', 41, 41, 2, 'yes', 1444312636, '150.214.191.252'),
(215, 49, 'ElggObject', 'object', 'privacy', 'update:after', 41, 41, 2, 'yes', 1444312636, '150.214.191.252'),
(216, 49, 'ElggObject', 'object', 'privacy', 'update', 41, 41, 2, 'yes', 1444312655, '150.214.191.252'),
(217, 49, 'ElggObject', 'object', 'privacy', 'update:after', 41, 41, 2, 'yes', 1444312655, '150.214.191.252'),
(218, 51, 'ElggObject', 'object', 'about', 'create', 41, 41, 2, 'yes', 1444312737, '150.214.191.252'),
(219, 51, 'ElggObject', 'object', 'about', 'update', 41, 41, 2, 'yes', 1444312768, '150.214.191.252'),
(220, 51, 'ElggObject', 'object', 'about', 'update:after', 41, 41, 2, 'yes', 1444312768, '150.214.191.252'),
(221, 51, 'ElggObject', 'object', 'about', 'update', 41, 41, 2, 'yes', 1444312803, '150.214.191.252'),
(222, 51, 'ElggObject', 'object', 'about', 'update:after', 41, 41, 2, 'yes', 1444312803, '150.214.191.252'),
(223, 50, 'ElggObject', 'object', 'terms', 'update', 41, 41, 2, 'yes', 1444312868, '150.214.191.252'),
(224, 50, 'ElggObject', 'object', 'terms', 'update:after', 41, 41, 2, 'yes', 1444312868, '150.214.191.252'),
(225, 50, 'ElggObject', 'object', 'terms', 'update', 41, 41, 2, 'yes', 1444312986, '150.214.191.252'),
(226, 50, 'ElggObject', 'object', 'terms', 'update:after', 41, 41, 2, 'yes', 1444312986, '150.214.191.252'),
(227, 49, 'ElggObject', 'object', 'privacy', 'update', 41, 41, 2, 'yes', 1444313096, '150.214.191.252'),
(228, 49, 'ElggObject', 'object', 'privacy', 'update:after', 41, 41, 2, 'yes', 1444313096, '150.214.191.252'),
(229, 49, 'ElggObject', 'object', 'privacy', 'update', 41, 41, 2, 'yes', 1444313103, '150.214.191.252'),
(230, 49, 'ElggObject', 'object', 'privacy', 'update:after', 41, 41, 2, 'yes', 1444313103, '150.214.191.252'),
(231, 41, 'ElggUser', 'user', '', 'logout:before', 41, 0, 2, 'yes', 1444313538, '172.20.36.122'),
(232, 41, 'ElggUser', 'user', '', 'logout', 41, 0, 2, 'yes', 1444313538, '172.20.36.122'),
(233, 41, 'ElggUser', 'user', '', 'logout:after', 0, 0, 2, 'yes', 1444313538, '172.20.36.122'),
(234, 2, 'ElggPlugin', 'object', 'plugin', 'disable', 41, 1, 2, 'yes', 1444314283, '150.214.191.252'),
(235, 2, 'ElggPlugin', 'object', 'plugin', 'disable:after', 41, 1, 2, 'no', 1444314283, '150.214.191.252'),
(236, 1, 'ElggSite', 'site', '', 'update', 41, 0, 2, 'yes', 1444314431, '150.214.191.252'),
(237, 1, 'ElggSite', 'site', '', 'update:after', 41, 0, 2, 'yes', 1444314431, '150.214.191.252'),
(238, 37, 'ElggRelationship', 'relationship', 'member_of_site', 'create', 0, 0, 2, 'yes', 1444314855, '83.60.219.1'),
(239, 52, 'ElggUser', 'user', '', 'create', 0, 0, 2, 'yes', 1444314855, '83.60.219.1'),
(240, 40, 'ElggMetadata', 'metadata', 'notification:method:email', 'create', 0, 52, 2, 'yes', 1444314855, '83.60.219.1'),
(241, 52, 'ElggUser', 'user', '', 'disable', 0, 0, 2, 'yes', 1444314855, '83.60.219.1'),
(242, 41, 'ElggMetadata', 'metadata', 'disable_reason', 'create', 0, 52, 2, 'yes', 1444314855, '83.60.219.1'),
(243, 40, 'ElggMetadata', 'metadata', 'notification:method:email', 'disable', 0, 52, 2, 'yes', 1444314855, '83.60.219.1'),
(244, 41, 'ElggMetadata', 'metadata', 'disable_reason', 'disable', 0, 52, 2, 'yes', 1444314855, '83.60.219.1'),
(245, 52, 'ElggUser', 'user', '', 'disable:after', 0, 0, 2, 'no', 1444314855, '83.60.219.1'),
(246, 42, 'ElggMetadata', 'metadata', 'validated', 'create', 0, 0, 2, 'yes', 1444314855, '83.60.219.1'),
(247, 43, 'ElggMetadata', 'metadata', 'validated_method', 'create', 0, 0, 2, 'yes', 1444314855, '83.60.219.1'),
(248, 41, 'ElggUser', 'user', '', 'login:before', 0, 0, 2, 'yes', 1444315528, '150.214.191.252'),
(249, 41, 'ElggUser', 'user', '', 'login', 41, 0, 2, 'yes', 1444315528, '150.214.191.252'),
(250, 41, 'ElggUser', 'user', '', 'login:after', 41, 0, 2, 'yes', 1444315528, '150.214.191.252'),
(251, 44, 'ElggMetadata', 'metadata', 'file_enable', 'create', 41, 41, 2, 'yes', 1444315556, '150.214.191.252'),
(252, 45, 'ElggMetadata', 'metadata', 'activity_enable', 'create', 41, 41, 2, 'yes', 1444315556, '150.214.191.252'),
(253, 46, 'ElggMetadata', 'metadata', 'forum_enable', 'create', 41, 41, 2, 'yes', 1444315556, '150.214.191.252'),
(254, 47, 'ElggMetadata', 'metadata', 'membership', 'create', 41, 41, 2, 'yes', 1444315556, '150.214.191.252'),
(255, 48, 'ElggMetadata', 'metadata', 'content_access_mode', 'create', 41, 41, 2, 'yes', 1444315556, '150.214.191.252'),
(256, 49, 'ElggMetadata', 'metadata', 'group_acl', 'create', 41, 41, 2, 'yes', 1444315556, '150.214.191.252'),
(257, 53, 'ElggGroup', 'group', '', 'create', 41, 41, 2, 'yes', 1444315556, '150.214.191.252'),
(258, 53, 'ElggGroup', 'group', '', 'update', 41, 41, 2, 'yes', 1444315556, '150.214.191.252'),
(259, 53, 'ElggGroup', 'group', '', 'update:after', 41, 41, 2, 'yes', 1444315556, '150.214.191.252'),
(260, 38, 'ElggRelationship', 'relationship', 'member', 'create', 41, 0, 2, 'yes', 1444315556, '150.214.191.252'),
(261, 50, 'ElggMetadata', 'metadata', 'icontime', 'create', 41, 41, 2, 'yes', 1444315556, '150.214.191.252'),
(262, 51, 'ElggMetadata', 'metadata', 'filename', 'create', 41, 41, 1, 'yes', 1444315708, '150.214.191.252'),
(263, 52, 'ElggMetadata', 'metadata', 'originalfilename', 'create', 41, 41, 1, 'yes', 1444315708, '150.214.191.252'),
(264, 53, 'ElggMetadata', 'metadata', 'mimetype', 'create', 41, 41, 1, 'yes', 1444315708, '150.214.191.252'),
(265, 54, 'ElggMetadata', 'metadata', 'simpletype', 'create', 41, 41, 1, 'yes', 1444315708, '150.214.191.252'),
(266, 55, 'ElggMetadata', 'metadata', 'filestore::dir_root', 'create', 41, 41, 1, 'yes', 1444315708, '150.214.191.252'),
(267, 56, 'ElggMetadata', 'metadata', 'filestore::filestore', 'create', 41, 41, 1, 'yes', 1444315708, '150.214.191.252'),
(268, 54, 'FilePluginFile', 'object', 'file', 'update', 41, 41, 1, 'yes', 1444315807, '150.214.191.252'),
(269, 54, 'FilePluginFile', 'object', 'file', 'update:after', 41, 41, 1, 'yes', 1444315807, '150.214.191.252'),
(270, 55, 'ElggMetadata', 'metadata', 'filestore::dir_root', 'delete', 41, 41, 1, 'yes', 1444315807, '150.214.191.252'),
(271, 57, 'ElggMetadata', 'metadata', 'filestore::dir_root', 'create', 41, 41, 1, 'yes', 1444315807, '150.214.191.252'),
(272, 56, 'ElggMetadata', 'metadata', 'filestore::filestore', 'delete', 41, 41, 1, 'yes', 1444315807, '150.214.191.252'),
(273, 58, 'ElggMetadata', 'metadata', 'filestore::filestore', 'create', 41, 41, 1, 'yes', 1444315807, '150.214.191.252'),
(274, 59, 'ElggMetadata', 'metadata', 'briefdescription', 'create', 41, 41, 2, 'yes', 1444315932, '150.214.191.252'),
(275, 60, 'ElggMetadata', 'metadata', 'interests', 'create', 41, 41, 2, 'yes', 1444315932, '150.214.191.252'),
(276, 61, 'ElggMetadata', 'metadata', 'interests', 'create', 41, 41, 2, 'yes', 1444315932, '150.214.191.252'),
(277, 62, 'ElggMetadata', 'metadata', 'interests', 'create', 41, 41, 2, 'yes', 1444315932, '150.214.191.252'),
(278, 45, 'ElggMetadata', 'metadata', 'activity_enable', 'delete', 41, 41, 2, 'yes', 1444315932, '150.214.191.252'),
(279, 63, 'ElggMetadata', 'metadata', 'activity_enable', 'create', 41, 41, 2, 'yes', 1444315932, '150.214.191.252'),
(280, 53, 'ElggGroup', 'group', '', 'update', 41, 41, 2, 'yes', 1444315932, '150.214.191.252'),
(281, 53, 'ElggGroup', 'group', '', 'update:after', 41, 41, 2, 'yes', 1444315932, '150.214.191.252'),
(282, 64, 'ElggMetadata', 'metadata', 'status', 'create', 41, 41, 1, 'yes', 1444315993, '150.214.191.252'),
(283, 65, 'ElggMetadata', 'metadata', 'tags', 'create', 41, 41, 1, 'yes', 1444315993, '150.214.191.252'),
(284, 55, 'ElggObject', 'object', 'groupforumtopic', 'create', 41, 41, 1, 'yes', 1444315993, '150.214.191.252'),
(285, 66, 'ElggMetadata', 'metadata', 'briefdescription', 'create', 41, 41, 2, 'yes', 1444316110, '150.214.191.252'),
(286, 67, 'ElggMetadata', 'metadata', 'interests', 'create', 41, 41, 2, 'yes', 1444316110, '150.214.191.252'),
(287, 68, 'ElggMetadata', 'metadata', 'interests', 'create', 41, 41, 2, 'yes', 1444316110, '150.214.191.252'),
(288, 69, 'ElggMetadata', 'metadata', 'interests', 'create', 41, 41, 2, 'yes', 1444316110, '150.214.191.252'),
(289, 70, 'ElggMetadata', 'metadata', 'file_enable', 'create', 41, 41, 2, 'yes', 1444316110, '150.214.191.252'),
(290, 71, 'ElggMetadata', 'metadata', 'activity_enable', 'create', 41, 41, 2, 'yes', 1444316110, '150.214.191.252'),
(291, 72, 'ElggMetadata', 'metadata', 'forum_enable', 'create', 41, 41, 2, 'yes', 1444316110, '150.214.191.252'),
(292, 73, 'ElggMetadata', 'metadata', 'membership', 'create', 41, 41, 2, 'yes', 1444316110, '150.214.191.252'),
(293, 74, 'ElggMetadata', 'metadata', 'content_access_mode', 'create', 41, 41, 2, 'yes', 1444316110, '150.214.191.252'),
(294, 75, 'ElggMetadata', 'metadata', 'group_acl', 'create', 41, 41, 2, 'yes', 1444316110, '150.214.191.252'),
(295, 56, 'ElggGroup', 'group', '', 'create', 41, 41, 2, 'yes', 1444316110, '150.214.191.252'),
(296, 56, 'ElggGroup', 'group', '', 'update', 41, 41, 2, 'yes', 1444316110, '150.214.191.252'),
(297, 56, 'ElggGroup', 'group', '', 'update:after', 41, 41, 2, 'yes', 1444316110, '150.214.191.252'),
(298, 39, 'ElggRelationship', 'relationship', 'member', 'create', 41, 0, 2, 'yes', 1444316110, '150.214.191.252'),
(299, 76, 'ElggMetadata', 'metadata', 'icontime', 'create', 41, 41, 2, 'yes', 1444316110, '150.214.191.252'),
(300, 41, 'ElggUser', 'user', '', 'logout:before', 41, 0, 2, 'yes', 1444316139, '150.214.191.252'),
(301, 41, 'ElggUser', 'user', '', 'logout', 41, 0, 2, 'yes', 1444316139, '150.214.191.252'),
(302, 41, 'ElggUser', 'user', '', 'logout:after', 0, 0, 2, 'yes', 1444316139, '150.214.191.252'),
(303, 77, 'ElggMetadata', 'metadata', 'briefdescription', 'create', 41, 41, 2, 'yes', 1444316218, '150.214.191.252'),
(304, 78, 'ElggMetadata', 'metadata', 'interests', 'create', 41, 41, 2, 'yes', 1444316218, '150.214.191.252'),
(305, 79, 'ElggMetadata', 'metadata', 'interests', 'create', 41, 41, 2, 'yes', 1444316218, '150.214.191.252'),
(306, 80, 'ElggMetadata', 'metadata', 'file_enable', 'create', 41, 41, 2, 'yes', 1444316218, '150.214.191.252'),
(307, 81, 'ElggMetadata', 'metadata', 'activity_enable', 'create', 41, 41, 2, 'yes', 1444316218, '150.214.191.252'),
(308, 82, 'ElggMetadata', 'metadata', 'forum_enable', 'create', 41, 41, 2, 'yes', 1444316218, '150.214.191.252'),
(309, 83, 'ElggMetadata', 'metadata', 'membership', 'create', 41, 41, 2, 'yes', 1444316218, '150.214.191.252'),
(310, 84, 'ElggMetadata', 'metadata', 'content_access_mode', 'create', 41, 41, 2, 'yes', 1444316218, '150.214.191.252'),
(311, 85, 'ElggMetadata', 'metadata', 'group_acl', 'create', 41, 41, 2, 'yes', 1444316218, '150.214.191.252'),
(312, 57, 'ElggGroup', 'group', '', 'create', 41, 41, 2, 'yes', 1444316218, '150.214.191.252'),
(313, 57, 'ElggGroup', 'group', '', 'update', 41, 41, 2, 'yes', 1444316218, '150.214.191.252'),
(314, 57, 'ElggGroup', 'group', '', 'update:after', 41, 41, 2, 'yes', 1444316218, '150.214.191.252'),
(315, 40, 'ElggRelationship', 'relationship', 'member', 'create', 41, 0, 2, 'yes', 1444316218, '150.214.191.252'),
(316, 86, 'ElggMetadata', 'metadata', 'icontime', 'create', 41, 41, 2, 'yes', 1444316218, '150.214.191.252'),
(317, 41, 'ElggRelationship', 'relationship', 'invited', 'create', 41, 0, 2, 'yes', 1444316245, '150.214.191.252'),
(318, 87, 'ElggMetadata', 'metadata', 'briefdescription', 'create', 41, 41, 2, 'yes', 1444316300, '150.214.191.252'),
(319, 88, 'ElggMetadata', 'metadata', 'interests', 'create', 41, 41, 2, 'yes', 1444316300, '150.214.191.252'),
(320, 89, 'ElggMetadata', 'metadata', 'interests', 'create', 41, 41, 2, 'yes', 1444316300, '150.214.191.252'),
(321, 90, 'ElggMetadata', 'metadata', 'interests', 'create', 41, 41, 2, 'yes', 1444316300, '150.214.191.252'),
(322, 91, 'ElggMetadata', 'metadata', 'file_enable', 'create', 41, 41, 2, 'yes', 1444316300, '150.214.191.252'),
(323, 92, 'ElggMetadata', 'metadata', 'activity_enable', 'create', 41, 41, 2, 'yes', 1444316300, '150.214.191.252'),
(324, 93, 'ElggMetadata', 'metadata', 'forum_enable', 'create', 41, 41, 2, 'yes', 1444316300, '150.214.191.252'),
(325, 94, 'ElggMetadata', 'metadata', 'membership', 'create', 41, 41, 2, 'yes', 1444316300, '150.214.191.252'),
(326, 95, 'ElggMetadata', 'metadata', 'content_access_mode', 'create', 41, 41, 2, 'yes', 1444316300, '150.214.191.252'),
(327, 96, 'ElggMetadata', 'metadata', 'group_acl', 'create', 41, 41, 2, 'yes', 1444316300, '150.214.191.252'),
(328, 58, 'ElggGroup', 'group', '', 'create', 41, 41, 2, 'yes', 1444316300, '150.214.191.252'),
(329, 58, 'ElggGroup', 'group', '', 'update', 41, 41, 2, 'yes', 1444316300, '150.214.191.252'),
(330, 58, 'ElggGroup', 'group', '', 'update:after', 41, 41, 2, 'yes', 1444316300, '150.214.191.252'),
(331, 42, 'ElggRelationship', 'relationship', 'member', 'create', 41, 0, 2, 'yes', 1444316300, '150.214.191.252'),
(332, 97, 'ElggMetadata', 'metadata', 'icontime', 'create', 41, 41, 2, 'yes', 1444316300, '150.214.191.252'),
(333, 98, 'ElggMetadata', 'metadata', 'briefdescription', 'create', 41, 41, 2, 'yes', 1444316365, '150.214.191.252'),
(334, 99, 'ElggMetadata', 'metadata', 'interests', 'create', 41, 41, 2, 'yes', 1444316365, '150.214.191.252'),
(335, 100, 'ElggMetadata', 'metadata', 'interests', 'create', 41, 41, 2, 'yes', 1444316365, '150.214.191.252'),
(336, 101, 'ElggMetadata', 'metadata', 'interests', 'create', 41, 41, 2, 'yes', 1444316365, '150.214.191.252'),
(337, 102, 'ElggMetadata', 'metadata', 'file_enable', 'create', 41, 41, 2, 'yes', 1444316365, '150.214.191.252'),
(338, 103, 'ElggMetadata', 'metadata', 'activity_enable', 'create', 41, 41, 2, 'yes', 1444316365, '150.214.191.252'),
(339, 104, 'ElggMetadata', 'metadata', 'forum_enable', 'create', 41, 41, 2, 'yes', 1444316365, '150.214.191.252'),
(340, 105, 'ElggMetadata', 'metadata', 'membership', 'create', 41, 41, 2, 'yes', 1444316365, '150.214.191.252'),
(341, 106, 'ElggMetadata', 'metadata', 'content_access_mode', 'create', 41, 41, 2, 'yes', 1444316365, '150.214.191.252'),
(342, 107, 'ElggMetadata', 'metadata', 'group_acl', 'create', 41, 41, 2, 'yes', 1444316365, '150.214.191.252'),
(343, 59, 'ElggGroup', 'group', '', 'create', 41, 41, 2, 'yes', 1444316365, '150.214.191.252'),
(344, 59, 'ElggGroup', 'group', '', 'update', 41, 41, 2, 'yes', 1444316365, '150.214.191.252'),
(345, 59, 'ElggGroup', 'group', '', 'update:after', 41, 41, 2, 'yes', 1444316365, '150.214.191.252'),
(346, 43, 'ElggRelationship', 'relationship', 'member', 'create', 41, 0, 2, 'yes', 1444316365, '150.214.191.252'),
(347, 108, 'ElggMetadata', 'metadata', 'icontime', 'create', 41, 41, 2, 'yes', 1444316365, '150.214.191.252'),
(348, 109, 'ElggMetadata', 'metadata', 'status', 'create', 41, 41, 1, 'yes', 1444316427, '150.214.191.252'),
(349, 110, 'ElggMetadata', 'metadata', 'tags', 'create', 41, 41, 1, 'yes', 1444316427, '150.214.191.252'),
(350, 111, 'ElggMetadata', 'metadata', 'tags', 'create', 41, 41, 1, 'yes', 1444316427, '150.214.191.252'),
(351, 112, 'ElggMetadata', 'metadata', 'tags', 'create', 41, 41, 1, 'yes', 1444316427, '150.214.191.252'),
(352, 60, 'ElggObject', 'object', 'groupforumtopic', 'create', 41, 41, 1, 'yes', 1444316427, '150.214.191.252'),
(353, 113, 'ElggMetadata', 'metadata', 'tags', 'create', 41, 41, 1, 'yes', 1444316513, '150.214.191.252'),
(354, 114, 'ElggMetadata', 'metadata', 'filename', 'create', 41, 41, 1, 'yes', 1444316513, '150.214.191.252'),
(355, 115, 'ElggMetadata', 'metadata', 'originalfilename', 'create', 41, 41, 1, 'yes', 1444316513, '150.214.191.252'),
(356, 116, 'ElggMetadata', 'metadata', 'mimetype', 'create', 41, 41, 1, 'yes', 1444316513, '150.214.191.252'),
(357, 117, 'ElggMetadata', 'metadata', 'simpletype', 'create', 41, 41, 1, 'yes', 1444316513, '150.214.191.252'),
(358, 61, 'FilePluginFile', 'object', 'file', 'create', 41, 41, 1, 'yes', 1444316513, '150.214.191.252'),
(359, 118, 'ElggMetadata', 'metadata', 'filestore::dir_root', 'create', 41, 41, 1, 'yes', 1444316513, '150.214.191.252'),
(360, 119, 'ElggMetadata', 'metadata', 'filestore::filestore', 'create', 41, 41, 1, 'yes', 1444316513, '150.214.191.252'),
(361, 120, 'ElggMetadata', 'metadata', 'status', 'create', 41, 41, 1, 'yes', 1444316584, '150.214.191.252'),
(362, 121, 'ElggMetadata', 'metadata', 'tags', 'create', 41, 41, 1, 'yes', 1444316584, '150.214.191.252'),
(363, 62, 'ElggObject', 'object', 'groupforumtopic', 'create', 41, 41, 1, 'yes', 1444316584, '150.214.191.252'),
(364, 44, 'ElggRelationship', 'relationship', 'member_of_site', 'create', 41, 0, 2, 'yes', 1444316647, '150.214.191.252'),
(365, 63, 'ElggUser', 'user', '', 'create', 41, 0, 2, 'yes', 1444316647, '150.214.191.252'),
(366, 122, 'ElggMetadata', 'metadata', 'notification:method:email', 'create', 41, 63, 2, 'yes', 1444316647, '150.214.191.252'),
(367, 63, 'ElggUser', 'user', '', 'update', 41, 0, 2, 'yes', 1444316647, '150.214.191.252'),
(368, 63, 'ElggUser', 'user', '', 'update:after', 41, 0, 2, 'yes', 1444316647, '150.214.191.252'),
(369, 123, 'ElggMetadata', 'metadata', 'admin_created', 'create', 41, 63, 2, 'yes', 1444316647, '150.214.191.252'),
(370, 124, 'ElggMetadata', 'metadata', 'created_by_guid', 'create', 41, 63, 2, 'yes', 1444316647, '150.214.191.252'),
(371, 45, 'ElggRelationship', 'relationship', 'member_of_site', 'create', 41, 0, 2, 'yes', 1444316764, '150.214.191.252'),
(372, 64, 'ElggUser', 'user', '', 'create', 41, 0, 2, 'yes', 1444316764, '150.214.191.252'),
(373, 125, 'ElggMetadata', 'metadata', 'notification:method:email', 'create', 41, 64, 2, 'yes', 1444316764, '150.214.191.252'),
(374, 64, 'ElggUser', 'user', '', 'update', 41, 0, 2, 'yes', 1444316764, '150.214.191.252'),
(375, 64, 'ElggUser', 'user', '', 'update:after', 41, 0, 2, 'yes', 1444316764, '150.214.191.252'),
(376, 126, 'ElggMetadata', 'metadata', 'admin_created', 'create', 41, 64, 2, 'yes', 1444316764, '150.214.191.252'),
(377, 127, 'ElggMetadata', 'metadata', 'created_by_guid', 'create', 41, 64, 2, 'yes', 1444316764, '150.214.191.252'),
(378, 46, 'ElggRelationship', 'relationship', 'member_of_site', 'create', 41, 0, 2, 'yes', 1444316787, '150.214.191.252'),
(379, 65, 'ElggUser', 'user', '', 'create', 41, 0, 2, 'yes', 1444316787, '150.214.191.252'),
(380, 128, 'ElggMetadata', 'metadata', 'notification:method:email', 'create', 41, 65, 2, 'yes', 1444316787, '150.214.191.252'),
(381, 65, 'ElggUser', 'user', '', 'update', 41, 0, 2, 'yes', 1444316787, '150.214.191.252'),
(382, 65, 'ElggUser', 'user', '', 'update:after', 41, 0, 2, 'yes', 1444316787, '150.214.191.252'),
(383, 129, 'ElggMetadata', 'metadata', 'admin_created', 'create', 41, 65, 2, 'yes', 1444316787, '150.214.191.252'),
(384, 130, 'ElggMetadata', 'metadata', 'created_by_guid', 'create', 41, 65, 2, 'yes', 1444316787, '150.214.191.252'),
(385, 42, 'ElggMetadata', 'metadata', 'validated', 'update', 41, 41, 2, 'yes', 1444316822, '150.214.191.252'),
(386, 43, 'ElggMetadata', 'metadata', 'validated_method', 'update', 41, 41, 2, 'yes', 1444316822, '150.214.191.252'),
(387, 52, 'ElggUser', 'user', '', 'enable', 41, 0, 2, 'no', 1444316822, '150.214.191.252'),
(388, 41, 'ElggMetadata', 'metadata', 'disable_reason', 'delete', 41, 52, 2, 'no', 1444316822, '150.214.191.252'),
(389, 40, 'ElggMetadata', 'metadata', 'notification:method:email', 'enable', 41, 52, 2, 'no', 1444316822, '150.214.191.252'),
(390, 52, 'ElggUser', 'user', '', 'enable:after', 41, 0, 2, 'yes', 1444316822, '150.214.191.252'),
(391, 41, 'ElggUser', 'user', '', 'logout:before', 41, 0, 2, 'yes', 1444317053, '150.214.191.252'),
(392, 41, 'ElggUser', 'user', '', 'logout', 41, 0, 2, 'yes', 1444317053, '150.214.191.252'),
(393, 41, 'ElggUser', 'user', '', 'logout:after', 0, 0, 2, 'yes', 1444317053, '150.214.191.252');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_users_apisessions`
--

CREATE TABLE IF NOT EXISTS `elgg_users_apisessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_guid` bigint(20) unsigned NOT NULL,
  `site_guid` bigint(20) unsigned NOT NULL,
  `token` varchar(40) DEFAULT NULL,
  `expires` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_guid` (`user_guid`,`site_guid`),
  KEY `token` (`token`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_users_entity`
--

CREATE TABLE IF NOT EXISTS `elgg_users_entity` (
  `guid` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `username` varchar(128) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT 'Legacy password hashes',
  `salt` varchar(8) NOT NULL DEFAULT '' COMMENT 'Legacy password salts',
  `password_hash` varchar(255) NOT NULL DEFAULT '',
  `email` text NOT NULL,
  `language` varchar(6) NOT NULL DEFAULT '',
  `banned` enum('yes','no') NOT NULL DEFAULT 'no',
  `admin` enum('yes','no') NOT NULL DEFAULT 'no',
  `last_action` int(11) NOT NULL DEFAULT '0',
  `prev_last_action` int(11) NOT NULL DEFAULT '0',
  `last_login` int(11) NOT NULL DEFAULT '0',
  `prev_last_login` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`guid`),
  UNIQUE KEY `username` (`username`),
  KEY `password` (`password`),
  KEY `email` (`email`(50)),
  KEY `last_action` (`last_action`),
  KEY `last_login` (`last_login`),
  KEY `admin` (`admin`),
  FULLTEXT KEY `name` (`name`),
  FULLTEXT KEY `name_2` (`name`,`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `elgg_users_entity`
--

INSERT INTO `elgg_users_entity` (`guid`, `name`, `username`, `password`, `salt`, `password_hash`, `email`, `language`, `banned`, `admin`, `last_action`, `prev_last_action`, `last_login`, `prev_last_login`) VALUES
(41, 'Rosana Montes', 'rosana', '', '', '$2y$10$LfldT37arpPUvuTPsiX68eD.H.RI7pN4yNhRoLot3hswOs45JB4s.', 'rosana@ugr.es', 'es', 'no', 'yes', 1444317053, 1444316822, 1444315528, 1444311430),
(47, 'Gustavo Gómez', 'Gustavo', '', '', '$2y$10$UJs7CnNkLlIp64eKTZ88KuJRnVoGIhUvhttzeqyatBeMFd/2iEfaS', 'info@acentocomunicacion.com', 'es', 'no', 'no', 1444232087, 1444232081, 1444232003, 0),
(48, 'Lisa Niemi', 'strem', '', '', '$2y$10$LKjxZEpSnepVEHLiRDFVuerih/r3C5R9QqN3Ny/LFT9dB5qNXhLgG', 'stremsattva@gmail.com', 'en', 'no', 'no', 1444311421, 1444311417, 1444311233, 0),
(52, 'Diego', 'Diego', '', '', '$2y$10$PTsUKaWRL5Jp.N7xk3Ad5OJoZ7qxT86hFk5jEZ8Brf.DhyZkcgXjq', 'diego@rodero.info', 'es', 'no', 'no', 0, 0, 0, 0),
(63, 'Ana Sanchez', 'amlopez', '', '', '$2y$10$J5LQuf0ebniwLGLJwldH8Ois4vPwu4o99eVMMXCEVGUhPXkz9bNYa', 'amlopez@ugr.es', 'es', 'no', 'no', 0, 0, 0, 0),
(64, 'Pedro Villar', 'pvillarc', '', '', '$2y$10$Yq4jQfSA2CBxD2FE.hhvB.QRcwgvbv0NatSoFQPE.6FuCmZMBQ4Ka', 'pvillarc@ugr.es', 'es', 'no', 'no', 0, 0, 0, 0),
(65, 'Marcelino Cabrera', 'mcabrera', '', '', '$2y$10$Bp3plxvLatJfVQpVVIIpbeX35BRkYp/5Sqb.e71OZX1BhatfRZFzy', 'mcabrera@ugr.es', 'es', 'no', 'no', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_users_remember_me_cookies`
--

CREATE TABLE IF NOT EXISTS `elgg_users_remember_me_cookies` (
  `code` varchar(32) NOT NULL,
  `guid` bigint(20) unsigned NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`code`),
  KEY `timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_users_sessions`
--

CREATE TABLE IF NOT EXISTS `elgg_users_sessions` (
  `session` varchar(255) NOT NULL,
  `ts` int(11) unsigned NOT NULL DEFAULT '0',
  `data` mediumblob,
  PRIMARY KEY (`session`),
  KEY `ts` (`ts`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `elgg_users_sessions`
--

INSERT INTO `elgg_users_sessions` (`session`, `ts`, `data`) VALUES
('jgcb78m3t8ki91sbukh7avpls1', 1444296528, 0x5f7366325f617474726962757465737c613a323a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a223636353631353738386264613564646535373961356532383332366566613434223b733a333a226d7367223b613a303a7b7d7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343239363532383b733a313a2263223b693a313434343239363532383b733a313a226c223b733a313a2230223b7d),
('2g6u0fdavklnmorkpcli2crbh4', 1444303880, 0x5f7366325f617474726962757465737c613a313a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a223932626536613033346363666663333762366434323634383837356530363835223b7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343330333838303b733a313a2263223b693a313434343330333838303b733a313a226c223b733a313a2230223b7d),
('vmm6st1mi4l7qtku21qp3hdst6', 1444303927, 0x5f7366325f617474726962757465737c613a343a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a223932626536613033346363666663333762366434323634383837356530363835223b733a343a2267756964223b693a34313b733a333a226d7367223b613a303a7b7d733a31323a22737469636b795f666f726d73223b613a313a7b733a31323a227573657273657474696e6773223b613a31303a7b733a31303a225f5f656c67675f757269223b733a32343a22616374696f6e2f7573657273657474696e67732f73617665223b733a31323a225f5f656c67675f746f6b656e223b733a32323a227a616f77396b6b746845374947504933306c6b526c51223b733a393a225f5f656c67675f7473223b733a31303a2231343434333033393132223b733a343a226e616d65223b733a31333a22526f73616e61204d6f6e746573223b733a343a2267756964223b733a323a223431223b733a31363a2263757272656e745f70617373776f7264223b733a303a22223b733a383a2270617373776f7264223b733a303a22223b733a393a2270617373776f726432223b733a303a22223b733a353a22656d61696c223b733a31333a22726f73616e61407567722e6573223b733a383a226c616e6775616765223b733a323a226573223b7d7d7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343330333932373b733a313a2263223b693a313434343330333838303b733a313a226c223b733a313a2230223b7d),
('mhmant63o9pvtcivcpvsbvjg96', 1444304151, 0x5f7366325f617474726962757465737c613a333a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a223062393239326530313139363663633132326435643863643166653233643430223b733a31373a226c6173745f666f72776172645f66726f6d223b733a35313a22687474703a2f2f74616d656e2e7567722e65732f746572616e67612e676f2f73657474696e67732f757365722f726f73616e61223b733a333a226d7367223b613a303a7b7d7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343330343135313b733a313a2263223b693a313434343330343135313b733a313a226c223b733a313a2230223b7d),
('nsmpvqi4t15jq8cbm2nmtqanm3', 1444304213, 0x5f7366325f617474726962757465737c613a333a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a223062393239326530313139363663633132326435643863643166653233643430223b733a333a226d7367223b613a303a7b7d733a343a2267756964223b693a34313b7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343330343231333b733a313a2263223b693a313434343330343135313b733a313a226c223b733a313a2230223b7d),
('0thvh6fuckjuloitjdngvu0r01', 1444304220, 0x5f7366325f617474726962757465737c613a313a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a223636336662363266663363326266643863616364346565343161376336616561223b7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343330343232303b733a313a2263223b693a313434343330343231393b733a313a226c223b733a313a2230223b7d),
('smr8pn23cbleofb35u782ijr80', 1444311429, 0x5f7366325f617474726962757465737c613a313a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a223034626462366130666366373235646362343966336462353631343935643266223b7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343331313432393b733a313a2263223b693a313434343330343336303b733a313a226c223b733a313a2230223b7d),
('bqpkkvol1jpt54gfaof6j7le51', 1444304883, 0x5f7366325f617474726962757465737c613a313a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a223732613332643539346565313933383065336639366161623732376565643437223b7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343330343838333b733a313a2263223b693a313434343330343739323b733a313a226c223b733a313a2230223b7d),
('glgd51n15sle6g3nhclnpddge0', 1444309863, 0x5f7366325f617474726962757465737c613a333a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a223134643639366165626235653135633837333036383766356336636563393837223b733a31373a226c6173745f666f72776172645f66726f6d223b733a33363a22687474703a2f2f74616d656e2e7567722e65732f746572616e67612e676f2f61646d696e223b733a333a226d7367223b613a303a7b7d7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343330393836333b733a313a2263223b693a313434343330373638303b733a313a226c223b733a313a2230223b7d),
('723slfplm0ktkb5j33q13k1n30', 1444308743, 0x5f7366325f617474726962757465737c613a313a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a226566353961376131623635306566366636633530343934636633356663343637223b7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343330383734333b733a313a2263223b693a313434343330383734323b733a313a226c223b733a313a2230223b7d),
('h64svv3cs591r7o6aiplugsvp2', 1444309466, 0x5f7366325f617474726962757465737c613a323a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a226232663532613366396166386364663230373439356366303235383861653935223b733a333a226d7367223b613a303a7b7d7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343330393436363b733a313a2263223b693a313434343330393135363b733a313a226c223b733a313a2230223b7d),
('fa3ku0s93auhlnbllmich7k1f0', 1444314855, 0x5f7366325f617474726962757465737c613a343a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a223064326465343836363131343764633766663333646432323033396465356363223b733a333a226d7367223b613a303a7b7d733a31323a22737469636b795f666f726d73223b613a303a7b7d733a393a22656d61696c73656e74223b733a31373a22646965676f40726f6465726f2e696e666f223b7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343331343835353b733a313a2263223b693a313434343331343830313b733a313a226c223b733a313a2230223b7d),
('05fkj2ernm9r4dg490ae92kps4', 1444309598, 0x5f7366325f617474726962757465737c613a323a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a223636666565636239313366643966393534653161353163623835353035386635223b733a333a226d7367223b613a303a7b7d7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343330393539383b733a313a2263223b693a313434343330393537373b733a313a226c223b733a313a2230223b7d),
('t57ig7avrfvedo3fs7auo3vm82', 1444314455, 0x5f7366325f617474726962757465737c613a323a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a223761333437396333336366383362616266393136313539366361333263316262223b733a333a226d7367223b613a303a7b7d7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343331343435353b733a313a2263223b693a313434343331333533383b733a313a226c223b733a313a2230223b7d),
('lua0veftelfa31hlpn1dd70tv0', 1444311228, 0x5f7366325f617474726962757465737c613a323a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a223161663636343331666336393539353037376663646532333066396335646135223b733a333a226d7367223b613a303a7b7d7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343331313232383b733a313a2263223b693a313434343331313232373b733a313a226c223b733a313a2230223b7d),
('m1sqk9u94k1j69n6dhj4f1vgk2', 1444314787, 0x5f7366325f617474726962757465737c613a313a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a226139356334343037393065633234323761376333633831333865333565663034223b7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343331343738373b733a313a2263223b693a313434343331333439333b733a313a226c223b733a313a2230223b7d),
('h0kppmnmho5nmihset83s05lp7', 1444311421, 0x5f7366325f617474726962757465737c613a323a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a226662326163326463633836643161383261663139663262316662336632366365223b733a333a226d7367223b613a303a7b7d7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343331313432313b733a313a2263223b693a313434343331313432313b733a313a226c223b733a313a2230223b7d),
('5r0g1sftnkkohtcsu6n1neuhg5', 1444316139, 0x5f7366325f617474726962757465737c613a323a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a223931373535316436663238633833343861363536376261636230653665613933223b733a333a226d7367223b613a303a7b7d7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343331363133393b733a313a2263223b693a313434343331363133393b733a313a226c223b733a313a2230223b7d),
('iuurntd610eisji3u77v99op94', 1444317066, 0x5f7366325f617474726962757465737c613a323a7b733a31343a225f5f656c67675f73657373696f6e223b733a33323a226539373766393261353737636163636164313231646564306338336162633366223b733a333a226d7367223b613a303a7b7d7d5f7366325f666c61736865737c613a303a7b7d5f7366325f6d6574617c613a333a7b733a313a2275223b693a313434343331373036363b733a313a2263223b693a313434343331373035333b733a313a226c223b733a313a2230223b7d);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
