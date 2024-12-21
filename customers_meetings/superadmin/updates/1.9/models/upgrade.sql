
--
-- Structure de la table `t_customers_meeting_status_call`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting_status_call` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
             `name` varchar(64)  NOT NULL,
             `color` varchar(16)  NOT NULL,
             `icon` varchar(64)  NOT NULL,           
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_customers_meeting_status_call_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting_status_call_i18n` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `status_id` int(11) unsigned NOT NULL,
        `lang` varchar(2)  NOT NULL,             
        `value` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)   ,  
     UNIQUE KEY `unique` (`status_id`,`lang`)   
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_customers_meeting_status_call_i18n` ADD CONSTRAINT `customers_meeting_status_call` FOREIGN KEY (`status_id`) REFERENCES `t_customers_meeting_status_call` (`id`) ON DELETE CASCADE;

--
-- Structure de la table `t_customers_meeting_campaign`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting_campaign` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
        `name` varchar(64)  NOT NULL,               
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--

--
-- Structure de la table `t_customers_meeting_type`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting_type` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
             `name` varchar(64)  NOT NULL,                  
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_customers_meeting_type_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting_type_i18n` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `type_id` int(11) unsigned NOT NULL,
        `lang` varchar(2)  NOT NULL,             
        `value` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)   ,  
     UNIQUE KEY `unique` (`type_id`,`lang`)   
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_customers_meeting_type_i18n` ADD CONSTRAINT `customers_meeting_type` FOREIGN KEY (`type_id`) REFERENCES `t_customers_meeting_type` (`id`) ON DELETE CASCADE;

ALTER TABLE `t_customers_meeting` ADD `is_qualified` enum('YES','NO')  NOT NULL DEFAULT 'NO' AFTER `is_confirmed`;
ALTER TABLE `t_customers_meeting` ADD `status_call_id` int(11) unsigned NOT NULL AFTER `state_id`;
ALTER TABLE `t_customers_meeting` ADD `campaign_id` int(11) unsigned NOT NULL AFTER `state_id`;
ALTER TABLE `t_customers_meeting` ADD `callcenter_id` int(11) unsigned NOT NULL AFTER `state_id`;
ALTER TABLE `t_customers_meeting` ADD `confirmator_id` int(11) unsigned NOT NULL AFTER `state_id`;