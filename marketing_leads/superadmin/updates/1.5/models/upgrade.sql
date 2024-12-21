ALTER TABLE `t_marketing_leads_wp_forms` ADD `state_id` int(11) unsigned NOT NULL AFTER `state`;

--
-- Structure de la table `t_marketing_leads_wp_forms_status`  
--
CREATE TABLE IF NOT EXISTS `t_marketing_leads_wp_forms_status` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
    `name` varchar(64) NOT NULL,
    `color` varchar(16) NOT NULL,
    `icon` varchar(64) NOT NULL,           
    PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_marketing_leads_wp_forms_status_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_marketing_leads_wp_forms_status_i18n` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `status_id` int(11) unsigned NOT NULL,
    `lang` varchar(2)  NOT NULL,             
    `value` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp  NULL DEFAULT NULL,      
    PRIMARY KEY (`id`),  
    UNIQUE KEY `unique` (`status_id`,`lang`)   
) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_marketing_leads_wp_forms_status_i18n` ADD CONSTRAINT `fk_marketing_leads_wp_forms_status` FOREIGN KEY (`status_id`) REFERENCES `t_marketing_leads_wp_forms_status` (`id`) ON DELETE CASCADE;
