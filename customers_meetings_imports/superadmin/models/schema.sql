--
-- Structure de la table `t_customers_meeting_import_format`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting_import_format` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
    `name` varchar(64)  NOT NULL,  
    `columns` TEXT NOT NULL, 
    `parameters` TEXT NOT NULL,  
    `class` varchar(64)  NOT NULL, 
    `help` TEXT NOT NULL,  
    `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp  NOT NULL DEFAULT '0000-00-00 00:00:00'   ,             
     PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_customers_meeting_import_file`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting_import_file` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,                       
        `number_of_leads` int(11) unsigned NOT NULL ,
        `number_of_lines` int(11) unsigned NOT NULL ,
        `lines_processed` int(11) unsigned NOT NULL DEFAULT 0,
        `filesize` int(11) unsigned NOT NULL DEFAULT 0,
        `name` varchar(255) NOT NULL,     
        `file` varchar(255) NOT NULL,              
        `columns` TEXT NOT NULL,    
        `format_id` int(11) unsigned NOT NULL ,
        `user_id` int(11) NOT NULL ,
        `has_header` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'YES',
        `application` enum('admin','frontend','superadmin') COLLATE utf8_bin NOT NULL,
        `campaign_id` int(11) unsigned NOT NULL , 
        `callcenter_id` int(11) unsigned NOT NULL ,
        `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',       
        `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp  NOT NULL DEFAULT '0000-00-00 00:00:00'   ,         
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

