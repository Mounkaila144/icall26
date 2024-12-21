
--
-- Structure de la table `t_customers_meeting_status_lead`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting_status_lead` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
             `name` varchar(64)  NOT NULL,
             `color` varchar(16)  NOT NULL,
             `icon` varchar(64)  NOT NULL,           
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_customers_meeting_status_lead_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting_status_lead_i18n` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `status_id` int(11) unsigned NOT NULL,
        `lang` varchar(2)  NOT NULL,             
        `value` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)   ,  
     UNIQUE KEY `unique` (`status_id`,`lang`)   
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_customers_meeting_status_lead_i18n` ADD CONSTRAINT `customers_meeting_status_lead` FOREIGN KEY (`status_id`) REFERENCES `t_customers_meeting_status_lead` (`id`) ON DELETE CASCADE;

ALTER TABLE `t_customers_meeting` ADD `status_lead_id` int(11) unsigned NOT NULL AFTER `state_id`;