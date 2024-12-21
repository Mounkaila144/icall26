--
-- Structure de la table `t_marketing_leads_wp_landing_page_site`  
--
CREATE TABLE IF NOT EXISTS `t_marketing_leads_wp_landing_page_site` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,   
    `host_site` varchar(64) NOT NULL,
    `host_db` varchar(50) NOT NULL,
    `user_db` varchar(50) NOT NULL,
    `name_db` varchar(50) NOT NULL,
    `password_db` varchar(50) NOT NULL,
    `campaign` varchar(50) NOT NULL,
    `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',
    `is_active` enum('YES','NO')  NOT NULL DEFAULT 'NO',
    `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp  NULL DEFAULT NULL,             
    PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_marketing_leads_wp_forms`  
--
CREATE TABLE IF NOT EXISTS `t_marketing_leads_wp_forms` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,   
    `id_wp` int(11) UNSIGNED NOT NULL,   
    `site_id` int(11) UNSIGNED NOT NULL,
    `firstname` varchar(64) NOT NULL,
    `lastname` varchar(64) NOT NULL,
    `income` decimal(12,2) UNSIGNED NOT NULL,
    `number_of_people` tinyint(11) UNSIGNED NOT NULL, 
    `owner` enum('tenant','owner','non_occupant_owner','') COLLATE utf8_bin NOT NULL,
    `energy` enum('electricity','combustible','') COLLATE utf8_bin NOT NULL,
    `phone` varchar(16) NOT NULL,
    `email` varchar(128) NOT NULL,
    `address` varchar(255) NOT NULL,
    `postcode` int(11) UNSIGNED NOT NULL,
    `city` varchar(25) NOT NULL,
    `country` varchar(3) NOT NULL,
    `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',
    `is_active` enum('YES','NO')  NOT NULL DEFAULT 'NO',
    `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp  NULL DEFAULT NULL,      
    PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

---------------------------------------------------- import
--
-- Structure de la table `t_marketing_leads_format_import`  
--
CREATE TABLE IF NOT EXISTS `t_marketing_leads_format_import` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
    `name` varchar(64) NOT NULL,  
    `columns` TEXT NOT NULL, 
    `parameters` TEXT NOT NULL,  
    `class` varchar(64) NOT NULL, 
    `help` TEXT NOT NULL,  
    `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp  NULL DEFAULT NULL,      
    PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_marketing_leads_file_import`  
--
CREATE TABLE IF NOT EXISTS `t_marketing_leads_file_import` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,                       
    `number_of_leads` int(11) unsigned NOT NULL,
    `number_of_lines` int(11) unsigned NOT NULL,
    `lines_processed` int(11) unsigned NOT NULL DEFAULT 0,
    `filesize` int(11) unsigned NOT NULL DEFAULT 0,
    `name` varchar(255) NOT NULL,     
    `file` varchar(255) NOT NULL,              
    `columns` TEXT NOT NULL,    
    `file_log` TEXT NOT NULL,    
    `format_id` int(11) unsigned NOT NULL,
    `site_id` int(11) unsigned NOT NULL,
    `user_id` int(11) NOT NULL,
    `has_header` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'YES',
    `application` enum('admin','frontend','superadmin') COLLATE utf8_bin NOT NULL,
    `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',       
    `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp  NULL DEFAULT NULL,      
    PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_marketing_leads_errors_import`  
--
CREATE TABLE IF NOT EXISTS `t_marketing_leads_errors_import` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,                       
    `import_id` int(11) unsigned NOT NULL,   
    `file` varchar(255) NOT NULL,           
    `line` int(11) UNSIGNED NOT NULL,           
    `error_text` TEXT NOT NULL,    
    `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',       
    `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp  NULL DEFAULT NULL,      
    PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;


-- 
-- CONSTRAINTS ON TABLES
-- 
ALTER TABLE `t_marketing_leads_wp_forms` ADD CONSTRAINT `fk_marketing_leads_wp_forms_0` FOREIGN KEY (`site_id`) REFERENCES `t_marketing_leads_wp_landing_page_site` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_marketing_leads_file_import` ADD CONSTRAINT `fk_marketing_leads_file_format_import_0` FOREIGN KEY (`format_id`) REFERENCES `t_marketing_leads_format_import` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_marketing_leads_file_import` ADD CONSTRAINT `fk_marketing_leads_file_user_import_1` FOREIGN KEY (`user_id`) REFERENCES `t_users` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_marketing_leads_file_import` ADD CONSTRAINT `fk_marketing_leads_file_site_import_2` FOREIGN KEY (`site_id`) REFERENCES `t_marketing_leads_wp_landing_page_site` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_marketing_leads_errors_import` ADD CONSTRAINT `fk_marketing_leads_errors_import_file_0` FOREIGN KEY (`import_id`) REFERENCES `t_marketing_leads_file_import` (`id`) ON DELETE CASCADE;

--- 'locataire','propriétaire occupant','propriétaire non occupant'
-- -- electricité,combustible