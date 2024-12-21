
--
-- Structure de la table `t_site_oversight_user_actions`  
--
CREATE TABLE IF NOT EXISTS `t_site_oversight_user_action` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,         
        `module` varchar(32) COLLATE utf8_bin NOT NULL,  
        `action` varchar(64) COLLATE utf8_bin NOT NULL,  
        `criticity` TINYINT NOT NULL DEFAULT '0',
        `message` varchar(512) COLLATE utf8_bin NOT NULL,          
        `user_id` int(11) NULL DEFAULT NULL,
        `creator_id` int(11) NULL DEFAULT NULL,
        `ip`  VARCHAR(24),
        `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp  NOT NULL,         
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;
