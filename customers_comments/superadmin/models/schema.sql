--
-- Structure de la table `t_customers_comments`  
--
CREATE TABLE IF NOT EXISTS `t_customers_comments` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,        
        `customer_id` int(11) unsigned NOT NULL ,
        `comment` varchar(512)  NOT NULL, 
        `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',       
        `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp  NOT NULL DEFAULT '0000-00-00 00:00:00'   ,         
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

ALTER TABLE `t_customers_comments` ADD CONSTRAINT `customers_comments_0` FOREIGN KEY (`customer_id`) REFERENCES `t_customers` (`id`) ON DELETE CASCADE;

--
-- Structure de la table `t_customers_comments_history`  
--
CREATE TABLE IF NOT EXISTS `t_customers_comments_history` (              
    `id` int(11) NOT NULL AUTO_INCREMENT,  
    `comment_id` int(11) unsigned NOT NULL,
    `user_id` int(11) unsigned NOT NULL, 
    `user_application` enum('admin','superadmin') COLLATE utf8_bin NOT NULL,      
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)     
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
