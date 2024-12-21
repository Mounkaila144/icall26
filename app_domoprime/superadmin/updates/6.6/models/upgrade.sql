 -
-- Structure de la table `t_domoprime_after_work_model`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_after_work_model` (   
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,       
    `name` varchar(255) COLLATE utf8_bin NOT NULL, 
     `options` VARCHAR(1024) NOT NULL DEFAULT "",
     PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Structure de la table `t_domoprime_after_work_model_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_after_work_model_i18n` (   
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,  
    `model_id` int(11) unsigned NOT NULL,
    `lang` varchar(2) NOT NULL default '',
    `value` varchar(255) COLLATE utf8_bin NOT NULL,      
    `content` text COLLATE utf8_bin NOT NULL, 
    `file` VARCHAR(255) NOT NULL,
    `variables` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT NULL,
     PRIMARY KEY (`id`),   
    UNIQUE KEY `unique` (`lang`,`model_id`)     
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `t_domoprime_after_work_model_i18n` ADD CONSTRAINT `domoprime_after_work_model_fk0` FOREIGN KEY (`model_id`) REFERENCES `t_domoprime_after_work_model` (`id`) ON DELETE CASCADE;

--
-- Structure de la table `t_partner_polluter_after_work`  
--
CREATE TABLE IF NOT EXISTS `t_partner_polluter_after_work` (   
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,      
    `polluter_id` int(11) unsigned NULL DEFAULT NULL,    
    `model_id` int(11) unsigned NULL DEFAULT NULL,        
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT NULL,   
     PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `t_partner_polluter_after_work` ADD CONSTRAINT `partners_polluter_after_work_fk0` FOREIGN KEY (`model_id`) REFERENCES `t_domoprime_after_work_model` (`id`) ON DELETE CASCADE;