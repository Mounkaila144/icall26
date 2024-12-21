
--
-- Structure de la table `t_system_versions_file`  
--
CREATE TABLE IF NOT EXISTS `t_system_versions_file` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,    
    `lang` varchar(2) NOT NULL,              
    `version` varchar(255) NOT NULL,
    `module` varchar(255) NOT NULL,
    `changes` TEXT NOT NULL,            
    `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',       
    `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp  NOT NULL DEFAULT '0000-00-00 00:00:00',         
    PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

