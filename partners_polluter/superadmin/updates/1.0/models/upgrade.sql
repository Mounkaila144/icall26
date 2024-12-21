--
-- Structure de la table `t_partners_polluter_model_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_partner_polluter_model_i18n` (   
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,  
    `polluter_id` int(11) unsigned NOT NULL,      
    `lang` varchar(2) NOT NULL default '',
    `value` varchar(255) COLLATE utf8_bin NOT NULL,     
    `content` text COLLATE utf8_bin NOT NULL, 
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`),   
    UNIQUE KEY `unique` (`lang`,`polluter_id`)     
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `t_partner_polluter_model_i18n` ADD CONSTRAINT `partners_polluter_model_0` FOREIGN KEY (`polluter_id`) REFERENCES `t_partner_polluter_company` (`id`) ON DELETE CASCADE;

