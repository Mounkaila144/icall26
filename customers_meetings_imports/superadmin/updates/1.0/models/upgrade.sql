ALTER TABLE `t_customers_meeting_import_file` ADD `file_log` VARCHAR(255) NOT NULL AFTER `file`;
--
-- Structure de la table `t_customers_meeting_import_errors`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting_import_errors` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,                       
    `import_id` int(11) unsigned NOT NULL,   
    `file` varchar(255) NOT NULL,           
    `line` int(11) unsigned NOT NULL,           
    `error_text` TEXT NOT NULL,    
    `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',       
    `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp  NOT NULL DEFAULT '0000-00-00 00:00:00',         
    PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;