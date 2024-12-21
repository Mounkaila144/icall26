--
-- Structure de la table `t_permissions_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_permissions_i18n` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `permission_id` int(11) NOT NULL,
        `lang` varchar(2)  NOT NULL,             
        `value` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `help` TEXT NOT NULL,  
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)   ,  
     UNIQUE KEY `unique` (`permission_id`,`lang`)   
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_permissions_i18n` ADD CONSTRAINT `permissions_0` FOREIGN KEY (`permission_id`) REFERENCES `t_permissions` (`id`) ON DELETE CASCADE;

