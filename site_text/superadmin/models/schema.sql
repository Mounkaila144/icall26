--
-- Structure de la table `t_site_text`  
--
CREATE TABLE IF NOT EXISTS `t_site_text` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `module` varchar(255)  NOT NULL,                 
            `key` varchar(255)  NOT NULL,                 
            `value` varchar(255)  NOT NULL,                 
     PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;
