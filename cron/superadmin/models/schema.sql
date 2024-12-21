--
-- Structure de la table `t_cron`
-- key=name
CREATE TABLE IF NOT EXISTS `t_cron` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `task` varchar(255) COLLATE utf8_bin NOT NULL,
  `site` varchar(255) COLLATE utf8_bin NOT NULL,
  `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `period` varchar(255) COLLATE utf8_bin NOT NULL,
  `last_execution` timestamp NULL DEFAULT NULL,  
  PRIMARY KEY (`id`) 
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

