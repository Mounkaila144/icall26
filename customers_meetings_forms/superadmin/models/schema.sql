--
-- Structure de la table `t_customers_meeting_form`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting_form` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
        `name` varchar(64)  NOT NULL,    
        `position` int(11) unsigned NOT NULL DEFAULT 0,          
     PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_customers_meeting_form_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting_form_i18n` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
        `form_id` int(11) unsigned NOT NULL,   
        `position` int(11) unsigned NOT NULL DEFAULT 0, 
        `lang` varchar(2)  NOT NULL,           
        `value` varchar(255)  NOT NULL,    
     PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;


--
-- Structure de la table `t_customers_meeting_formfield`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting_formfield` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
        `form_id` int(11) unsigned NOT NULL,   
        `name` varchar(64)  NOT NULL, 
        `type` varchar(128)  NOT NULL,       
        `widget` varchar(255)  NOT NULL, 
        `position` int(11) unsigned NOT NULL DEFAULT 0,  
     PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_customers_meeting_formfield_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting_formfield_i18n` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
        `formfield_id` int(11) unsigned NOT NULL,   
        `request` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `lang` varchar(2)  NOT NULL,             
        `parameters` varchar(512)  NOT NULL,     
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',    
     PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `t_customers_meeting_forms` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,                   
        `meeting_id` int(11) unsigned NOT NULL,   
        `data` TEXT  NOT NULL, 
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',  
     PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;


ALTER TABLE `t_customers_meeting_formfield` ADD CONSTRAINT `formfield_0` FOREIGN KEY (`form_id`) REFERENCES `t_customers_meeting_form` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_customers_meeting_formfield_i18n` ADD CONSTRAINT `formfield_1` FOREIGN KEY (`formfield_id`) REFERENCES `t_customers_meeting_formfield` (`id`) ON DELETE CASCADE;
