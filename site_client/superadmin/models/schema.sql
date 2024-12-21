--
-- Structure de la table `t_site_clients_i18n`
-- 
CREATE TABLE IF NOT EXISTS `t_site_clients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) CHARACTER SET utf8 NOT NULL, 
  `name` varchar(255) COLLATE utf8_bin NOT NULL,   
  `design` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT 'default',
  `style` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT 'default',
  `params` varchar(40) CHARACTER SET utf8 NOT NULL,
  `banner` varchar(40) CHARACTER SET utf8 NOT NULL,
  `favicon` varchar(40) CHARACTER SET utf8 NOT NULL,
  `favicon_ico` varchar(40) CHARACTER SET utf8 NOT NULL,
  `is_tablet` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `is_mobile` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `is_default` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `restritive_access` tinyint(1) NOT NULL DEFAULT '0',  
  `company_id` int(11) NOT NULL,
  `application` enum('frontend','admin') COLLATE utf8_bin NOT NULL DEFAULT 'frontend',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`) 
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

