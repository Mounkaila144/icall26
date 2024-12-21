
--
-- Structure de la table `t_customers_meetings_date_range`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meetings_date_range` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
        `name` varchar(64)  NOT NULL,
        `from` TIME  NULL DEFAULT NULL , 
        `color` varchar(10)  NOT NULL,                
        `to` TIME NULL DEFAULT NULL,       
     PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_contracts_meetings_date_range_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meetings_date_range_i18n` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `range_id` int(11) unsigned NOT NULL,
        `lang` varchar(2)  NOT NULL,             
        `value` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)   ,  
     UNIQUE KEY `unique` (`range_id`,`lang`)   
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_customers_meetings_date_range_i18n` ADD CONSTRAINT `customers_meeting_range` FOREIGN KEY (`range_id`) REFERENCES `t_customers_meetings_date_range` (`id`) ON DELETE CASCADE;

      

