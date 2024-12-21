-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 20 mars 2023 à 12:11
-- Version du serveur :  5.7.28
-- Version de PHP :  5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `site_mini`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_languages`
--

DROP TABLE IF EXISTS `t_languages`;
CREATE TABLE IF NOT EXISTS `t_languages` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` char(2) COLLATE utf8_bin NOT NULL DEFAULT '',
  `position` smallint(6) NOT NULL,
  `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `application` enum('frontend','superadmin','admin') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_1` (`code`,`application`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `t_languages`
--

INSERT INTO `t_languages` (`id`, `code`, `position`, `is_active`, `created_at`, `updated_at`, `application`) VALUES
(1, 'fr', 1, 'YES', '2012-04-05 19:50:12', '2012-04-08 17:22:01', 'admin'),
(2, 'en', 2, 'YES', '2012-04-05 19:50:12', '2012-04-08 17:22:04', 'admin'),
(3, 'fr', 1, 'YES', '2012-04-05 19:50:22', '2012-04-05 19:50:22', 'frontend'),
(4, 'en', 2, 'YES', '2012-04-05 19:50:22', '2012-04-05 19:50:22', 'frontend'),
(5, 'fr', 1, 'YES', '2012-04-05 16:52:35', NULL, 'superadmin'),
(6, 'en', 2, 'YES', '2012-04-05 16:52:35', NULL, 'superadmin');

-- --------------------------------------------------------

--
-- Structure de la table `t_modules`
--

DROP TABLE IF EXISTS `t_modules`;
CREATE TABLE IF NOT EXISTS `t_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_bin NOT NULL,
  `logo` varchar(255) COLLATE utf8_bin NOT NULL,
  `type` varchar(48) COLLATE utf8_bin NOT NULL,
  `title` varchar(128) CHARACTER SET utf8 NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `mode` varchar(4) COLLATE utf8_bin NOT NULL DEFAULT '',
  `status` enum('loaded','installed','uninstalled') COLLATE utf8_bin NOT NULL,
  `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `is_available` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `in_site` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `version` varchar(10) COLLATE utf8_bin NOT NULL,
  `update` varchar(16) COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=889 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `t_modules`
--

INSERT INTO `t_modules` (`id`, `name`, `logo`, `type`, `title`, `description`, `mode`, `status`, `is_active`, `is_available`, `in_site`, `version`, `update`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', 'logo.png', 'core', 'dashboard', 'this module manage dashboard', '', 'installed', 'NO', 'YES', 'NO', '1.0', '', '2021-02-21 16:00:27', '2021-02-21 16:00:27'),
(2, 'default', 'logo.png', 'core', 'default', 'this module manage the default actions.', '', 'installed', 'NO', 'YES', 'NO', '1.0', '', '2021-02-21 16:00:27', '2021-02-21 16:00:27'),
(3, 'modules_manager', 'logo.png', 'core', 'module manager', 'this module manage module on superadmin & sites', '', 'installed', 'NO', 'YES', 'NO', '1.0', '', '2021-02-21 16:00:27', '2021-02-21 16:00:27'),
(4, 'site', 'logo.png', 'core', 'site', 'this module manages the site.', '', 'installed', 'NO', 'YES', 'NO', '1.0', '1.1', '2021-02-21 16:00:27', '2021-02-21 16:00:27'),
(5, 'site_client', 'logo.png', 'core', 'site client', 'this module manages the site client.', '', 'installed', 'NO', 'YES', 'NO', '1.0', '', '2021-02-21 16:00:27', '2021-02-21 16:00:27'),
(6, 'site_company', 'logo.png', 'site', 'site company', 'this module manage the site company.', '', 'installed', 'YES', 'YES', 'NO', '1.0', '', '2021-02-21 16:00:27', '2021-02-21 16:00:27'),
(7, 'site_languages', 'logo.png', 'core', 'language', 'this module manages languages.', '', 'installed', 'YES', 'YES', 'NO', '1.0', '', '2021-02-21 16:00:27', '2021-02-21 16:00:27'),
(8, 'site_restrictive_access', '', 'core', 'site access', 'this module manages the site access.', '', 'installed', 'NO', 'YES', 'NO', '1.0', '', '2021-02-21 16:00:27', '2021-02-21 16:00:27'),
(9, 'themes', 'logo.png', 'theme', 'themes', 'this module manages the themes.', '', 'installed', 'NO', 'YES', 'NO', '1.0', '', '2021-02-21 16:00:27', '2021-02-21 16:00:27'),
(10, 'utils', 'logo.png', 'core', 'dashboard', 'this module manage utils', '', 'installed', 'NO', 'YES', 'NO', '1.0', '', '2021-02-21 16:00:27', '2021-02-21 16:00:27'),
(11, 'site_theme', 'logo.jpg', 'site', 'site theme', 'this module manage the site theme actions.', '', 'installed', 'YES', 'YES', 'NO', '1.0', '', '2021-03-08 18:14:24', '2021-03-08 18:14:24'),
(12, 'tests', 'logo.jpg', 'tests', 'tests', 'this module manage the tests actions.', '', 'installed', 'YES', 'YES', 'NO', '1.0', '', '2022-07-19 16:47:37', '2022-07-19 16:47:37');
 
-- --------------------------------------------------------

--
-- Structure de la table `t_modules_admin`
--

DROP TABLE IF EXISTS `t_modules_admin`;
CREATE TABLE IF NOT EXISTS `t_modules_admin` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_bin NOT NULL,
  `title` varchar(128) CHARACTER SET utf8 NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `logo` varchar(255) COLLATE utf8_bin NOT NULL,
  `type` varchar(48) COLLATE utf8_bin NOT NULL,
  `version` varchar(10) COLLATE utf8_bin NOT NULL,
  `update` varchar(16) COLLATE utf8_bin NOT NULL,
  `mode` varchar(4) COLLATE utf8_bin NOT NULL DEFAULT '',
  `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=581 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


--
-- Structure de la table `t_sites`
--

DROP TABLE IF EXISTS `t_sites`;
CREATE TABLE IF NOT EXISTS `t_sites` (
  `site_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `site_protocol` enum('http','https') COLLATE utf8_bin NOT NULL DEFAULT 'http',
  `site_host` varchar(255) COLLATE utf8_bin NOT NULL,
  `site_port` int(11) NOT NULL DEFAULT '80',
  `site_db_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `site_db_login` varchar(40) CHARACTER SET latin1 NOT NULL DEFAULT 'root',
  `site_db_password` varchar(40) CHARACTER SET latin1 NOT NULL,
  `site_db_host` varchar(128) COLLATE utf8_bin NOT NULL,
  `site_db_port` int(11) UNSIGNED NOT NULL,
  `site_admin_theme` varchar(64) COLLATE utf8_bin NOT NULL,
  `site_admin_available` enum('YES','NO') CHARACTER SET latin1 NOT NULL DEFAULT 'YES',
  `site_frontend_theme` varchar(64) COLLATE utf8_bin NOT NULL,
  `site_frontend_available` enum('YES','NO') CHARACTER SET latin1 NOT NULL DEFAULT 'YES',
  `site_available` enum('YES','NO') CHARACTER SET latin1 NOT NULL DEFAULT 'NO',
  `site_is_enable` enum('YES','NO') CHARACTER SET latin1 NOT NULL DEFAULT 'NO',
  `site_admin_redirect` enum('YES','NO') CHARACTER SET latin1 NOT NULL DEFAULT 'NO',
  `site_type` varchar(4) COLLATE utf8_bin NOT NULL,
  `site_master` varchar(64) COLLATE utf8_bin NOT NULL,
  `site_company` varchar(128) COLLATE utf8_bin NOT NULL,
  `site_access_restricted` enum('NO','YES') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `site_size` int(11) UNSIGNED NOT NULL,
  `site_db_size` int(11) UNSIGNED NOT NULL,
  `logo` varchar(24) COLLATE utf8_bin NOT NULL,
  `picture` varchar(24) COLLATE utf8_bin NOT NULL,
  `is_uptodate` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `is_install_inprogress` enum('NO','YES') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `banner` varchar(40) CHARACTER SET utf8 NOT NULL,
  `favicon` varchar(40) CHARACTER SET utf8 NOT NULL,
  `status` enum('UPLOAD','ACTIVE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `t_sites`
--

INSERT INTO `t_sites` (`site_id`, `site_protocol`, `site_host`, `site_port`, `site_db_name`, `site_db_login`, `site_db_password`, `site_db_host`, `site_db_port`, `site_admin_theme`, `site_admin_available`, `site_frontend_theme`, `site_frontend_available`, `site_available`, `site_is_enable`, `site_admin_redirect`, `site_type`, `site_master`, `site_company`, `site_access_restricted`, `site_size`, `site_db_size`, `logo`, `picture`, `is_uptodate`, `is_install_inprogress`, `banner`, `favicon`, `status`, `created_at`) VALUES
(1, 'http', 'www.project1.net', 80, 'icall26_mini', 'root', '', 'localhost', 3306, 'default', 'YES', 'theme1', 'YES', 'YES', 'YES', 'NO', 'CUST', '', '', 'NO', 0, 0, 'logo.png', 'picture.png', 'YES', 'NO', '', '', 'ACTIVE', '2021-02-07 18:55:33');

-- --------------------------------------------------------

--
-- Structure de la table `t_sites_clients`
--

DROP TABLE IF EXISTS `t_sites_clients`;
CREATE TABLE IF NOT EXISTS `t_sites_clients` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `design` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT 'default',
  `style` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT 'default',
  `params` varchar(40) CHARACTER SET utf8 NOT NULL,
  `keywords` varchar(512) COLLATE utf8_bin NOT NULL,
  `description` varchar(512) COLLATE utf8_bin NOT NULL,
  `banner` varchar(40) CHARACTER SET utf8 NOT NULL,
  `favicon` varchar(40) CHARACTER SET utf8 NOT NULL,
  `favicon_ico` varchar(40) CHARACTER SET utf8 NOT NULL,
  `is_tablet` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `is_mobile` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `is_default` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `id_company` int(11) NOT NULL,
  `application` enum('frontend','admin') COLLATE utf8_bin NOT NULL DEFAULT 'frontend',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `t_sites_clients`
--

INSERT INTO `t_sites_clients` (`id`, `lang`, `name`, `design`, `style`, `params`, `keywords`, `description`, `banner`, `favicon`, `favicon_ico`, `is_tablet`, `is_mobile`, `is_active`, `is_default`, `id_company`, `application`, `created_at`, `updated_at`) VALUES
(3, 'fr', 'Frontend Office', 'default', 'default', '', '', '', '', '', '', 'NO', 'NO', 'YES', 'YES', 0, 'frontend', '2012-02-09 13:06:14', '2021-04-01 21:26:38'),
(4, 'fr', 'Admin Office', 'default', 'default', '', '', '', '', '', '', 'NO', 'NO', 'YES', 'YES', 0, 'admin', '2012-02-09 13:06:14', '2012-04-09 12:34:22');

-- --------------------------------------------------------

--
-- Structure de la table `t_site_company`
--

DROP TABLE IF EXISTS `t_site_company`;
CREATE TABLE IF NOT EXISTS `t_site_company` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `commercial` varchar(50) COLLATE utf8_bin NOT NULL,
  `company_number` varchar(20) COLLATE utf8_bin NOT NULL,
  `fiscal_number` varchar(20) COLLATE utf8_bin NOT NULL,
  `registration_number` varchar(64) COLLATE utf8_bin NOT NULL,
  `tva` varchar(13) COLLATE utf8_bin NOT NULL,
  `picture` varchar(20) COLLATE utf8_bin NOT NULL,
  `header` varchar(20) COLLATE utf8_bin NOT NULL,
  `footer` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(64) CHARACTER SET utf8 NOT NULL,
  `web` varchar(64) CHARACTER SET utf8 NOT NULL,
  `mobile` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `phone` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `fax` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `address1` varchar(128) COLLATE utf8_bin NOT NULL,
  `address2` varchar(128) COLLATE utf8_bin NOT NULL,
  `postcode` varchar(10) COLLATE utf8_bin NOT NULL,
  `city` varchar(50) COLLATE utf8_bin NOT NULL,
  `country` varchar(2) COLLATE utf8_bin NOT NULL,
  `state` varchar(50) COLLATE utf8_bin NOT NULL,
  `activity` varchar(40) COLLATE utf8_bin NOT NULL,
  `activity_id` int(11) UNSIGNED DEFAULT NULL,
  `stamp` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `signature` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `background` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `lat` decimal(20,13) DEFAULT NULL,
  `lng` decimal(20,13) DEFAULT NULL,
  `is_default` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N',
  `is_site` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `site_company_fk0` (`activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `t_site_company`
--

INSERT INTO `t_site_company` (`id`, `name`, `commercial`, `company_number`, `fiscal_number`, `registration_number`, `tva`, `picture`, `header`, `footer`, `email`, `web`, `mobile`, `phone`, `fax`, `address1`, `address2`, `postcode`, `city`, `country`, `state`, `activity`, `activity_id`, `stamp`, `signature`, `background`, `lat`, `lng`, `is_default`, `is_site`, `is_active`, `created_at`, `updated_at`) VALUES
(6, 'eWebsolutions Kech', 'ewebsolutionskech', '60015', '6528883', '001530780000058', '', 'picture.png', '', '', 'contact@ewebsolutions.fr', 'https://www.ewebsolutionskech.com', '+212627107296', '', '', 'N°23 Bur 53 Yacoub El Mansour ', '', '40000', 'MARRAKECH', 'MA', '', '', NULL, 'stamp.jpg', '', '', '31.6407600000000', '-7.9996500000000', 'Y', 'YES', 'YES', '2014-08-04 14:17:52', '2022-06-29 16:17:59');

-- --------------------------------------------------------

--
-- Structure de la table `t_site_company_activity`
--

DROP TABLE IF EXISTS `t_site_company_activity`;
CREATE TABLE IF NOT EXISTS `t_site_company_activity` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_bin DEFAULT '',
  `icon` varchar(24) COLLATE utf8_bin DEFAULT '',
  `awe` varchar(16) COLLATE utf8_bin DEFAULT '',
  `color` varchar(10) COLLATE utf8_bin DEFAULT '',
  `position` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `t_site_company_activity`
--

INSERT INTO `t_site_company_activity` (`id`, `name`, `icon`, `awe`, `color`, `position`, `created_at`, `updated_at`) VALUES
(1, '', '', '', '', 1, '2021-06-18 22:03:45', '2021-06-18 22:03:45'),
(2, '', '', '', '', 2, '2021-06-18 22:03:50', '2021-06-18 22:03:50');

-- --------------------------------------------------------

--
-- Structure de la table `t_site_company_activity_i18n`
--

DROP TABLE IF EXISTS `t_site_company_activity_i18n`;
CREATE TABLE IF NOT EXISTS `t_site_company_activity_i18n` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) COLLATE utf8_bin DEFAULT '',
  `value` varchar(255) COLLATE utf8_bin DEFAULT '',
  `activity_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`activity_id`,`lang`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `t_site_company_activity_i18n`
--

INSERT INTO `t_site_company_activity_i18n` (`id`, `lang`, `value`, `activity_id`, `created_at`, `updated_at`) VALUES
(1, 'fr', 'Activity1', 1, '2021-06-18 22:03:45', '2021-06-18 22:03:45'),
(2, 'fr', 'Activity2', 2, '2021-06-18 22:03:50', '2021-06-18 22:03:50');

--
-- Structure de la table `t_themes`
--

DROP TABLE IF EXISTS `t_themes`;
CREATE TABLE IF NOT EXISTS `t_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `preview` varchar(16) COLLATE utf8_bin NOT NULL,
  `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `application` enum('admin','frontend','superadmin') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `t_themes`
--

INSERT INTO `t_themes` (`id`, `name`, `preview`, `is_active`, `created_at`, `updated_at`, `application`) VALUES
(1, 'theme1', 'preview.jpg', 'YES', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'frontend'),
(68, 'theme1', 'preview.jpg', 'YES', '2021-02-17 18:16:14', '2021-02-17 18:16:14', 'superadmin');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_site_company`
--
ALTER TABLE `t_site_company`
  ADD CONSTRAINT `site_company_fk0` FOREIGN KEY (`activity_id`) REFERENCES `t_site_company_activity` (`id`);

--
-- Contraintes pour la table `t_site_company_activity_i18n`
--
ALTER TABLE `t_site_company_activity_i18n`
  ADD CONSTRAINT `site_company_activity_fk0` FOREIGN KEY (`activity_id`) REFERENCES `t_site_company_activity` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
