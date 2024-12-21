--
-- Structure de la table `t_utils_registration` 
--
CREATE TABLE IF NOT EXISTS `t_utils_registration` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,  
        `key` VARCHAR(128) NOT NULL,      
        `month` int(11) unsigned NOT NULL,      
        `year` int(11) unsigned NOT NULL,  
        `registration` int(11) unsigned NOT NULL,                    
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)       
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

