--
-- Structure de la table `t_compny`
--

CREATE TABLE IF NOT EXISTS `t_site_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `commercial` varchar(50) COLLATE utf8_bin NOT NULL, 
  `ape` varchar(11) COLLATE utf8_bin NOT NULL,  
  `siret` varchar(14) COLLATE utf8_bin NOT NULL,
  `tva` varchar(13) COLLATE utf8_bin NOT NULL,
  `picture` varchar(255) COLLATE utf8_bin NOT NULL,
  `header` varchar(255) COLLATE utf8_bin NOT NULL,
  `footer` varchar(255) COLLATE utf8_bin NOT NULL,  
  `coordinates` varchar(64) COLLATE utf8_bin NOT NULL,
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
  `is_site` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`) 
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;



