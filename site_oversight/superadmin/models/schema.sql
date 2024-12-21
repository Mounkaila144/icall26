
--
-- Structure de la table `t_site_oversight_message`  
--
CREATE TABLE IF NOT EXISTS `t_site_oversight_message` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,         
        `module` varchar(32) COLLATE utf8_bin NOT NULL,  
        `header` varchar(64) COLLATE utf8_bin NOT NULL,  
        `criticity` TINYINT NOT NULL DEFAULT '0',
        `message` varchar(512) COLLATE utf8_bin NOT NULL,
        `parameters` varchar(1024) COLLATE utf8_bin NOT NULL,
        `number_of_items` int(11) unsigned NOT NULL DEFAULT 0,
        `is_sent` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',  
        `user_id` int(11) NULL DEFAULT NULL,
        `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp  NOT NULL,         
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

