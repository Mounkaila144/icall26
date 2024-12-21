--
-- Structure de la table `t_domoprime_pre_meeting_model`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_pre_meeting_model` (   
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,       
    `name` varchar(255) COLLATE utf8_bin NOT NULL,   
     PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Structure de la table `t_domoprime_pre_meeting_model_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_pre_meeting_model_i18n` (   
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,  
    `model_id` int(11) unsigned NOT NULL,
    `lang` varchar(2) NOT NULL default '',
    `value` varchar(255) COLLATE utf8_bin NOT NULL,      
    `content` text COLLATE utf8_bin NOT NULL, 
    `file` VARCHAR(255) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`),   
    UNIQUE KEY `unique` (`lang`,`model_id`)     
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `t_domoprime_pre_meeting_model_i18n` ADD CONSTRAINT `domoprime_pre_meeting_model_0` FOREIGN KEY (`model_id`) REFERENCES `t_domoprime_pre_meeting_model` (`id`) ON DELETE CASCADE;

