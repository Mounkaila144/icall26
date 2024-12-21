--
-- Structure de la table `t_system_tab`
--

CREATE TABLE IF NOT EXISTS `t_system_tab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tab` varchar(255) COLLATE utf8_bin DEFAULT NULL,  
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,  
  `position` int(11) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,  
  PRIMARY KEY (`id`)   
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

