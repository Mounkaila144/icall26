
--
-- Structure de la table `t_customers_meeting`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,        
        `customer_id` int(11) unsigned NOT NULL ,
        `telepro_id` int(11) unsigned NOT NULL ,
        `sales_id` int(11) unsigned NOT NULL ,
        `sale2_id` int(11) unsigned NOT NULL ,
        `in_at` DATETIME  NULL DEFAULT NULL,
        `out_at` DATETIME  NULL DEFAULT NULL,
        `state_id` int(11) unsigned NOT NULL ,
        `remarks` TEXT NOT NULL,
        `variables` TEXT NOT NULL,
        `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',
        `is_confirmed` enum('YES','NO')  NOT NULL DEFAULT 'NO',
        `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp  NOT NULL DEFAULT '0000-00-00 00:00:00'   ,         
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

ALTER TABLE `t_customers_meeting` ADD CONSTRAINT `customers_meeting_cust` FOREIGN KEY (`customer_id`) REFERENCES `t_customers` (`id`) ON DELETE CASCADE;

-- ALTER TABLE `t_customers_meeting` ADD `variables` TEXT NOT NULL AFTER `sales_id` 
-- ALTER TABLE `t_customers_meeting` ADD `remarks` TEXT NOT NULL AFTER `sales_id`
-- ALTER TABLE `t_customers_meeting` CHANGE `in_at` `in_at` DATETIME NULL DEFAULT NULL 
-- ALTER TABLE `t_customers_meeting` CHANGE `out_at` `out_at` DATETIME NULL DEFAULT NULL 
-- ALTER TABLE `t_customers_meeting` ADD `telepro_id` INT UNSIGNED NOT NULL AFTER `state_id` 
-- ALTER TABLE `t_customers_meeting` ADD `sales_id` INT UNSIGNED NOT NULL AFTER `telepro_id`

-- ALTER TABLE `t_customers_meeting` ADD `sale2_id` INT( 11 ) UNSIGNED NOT NULL AFTER `sales_id` 

 
--
-- Structure de la table `t_customers_meeting_history`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting_history` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,        
        `customer_id` int(11) unsigned NOT NULL ,
        `user_id` int(11) NOT NULL ,   
        `user_application` enum('admin','superadmin') COLLATE utf8_bin NOT NULL,                 
        `history` varchar(255)  NOT NULL,
        `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp  NOT NULL DEFAULT '0000-00-00 00:00:00'   ,         
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;



--
-- Structure de la table `t_customers_meeting_status`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting_status` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
             `name` varchar(64)  NOT NULL,
             `color` varchar(16)  NOT NULL,
             `icon` varchar(64)  NOT NULL,           
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_customers_meeting_status_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting_status_i18n` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `status_id` int(11) unsigned NOT NULL,
        `lang` varchar(2)  NOT NULL,             
        `value` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)   ,  
     UNIQUE KEY `unique` (`status_id`,`lang`)   
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_customers_meeting_status_i18n` ADD CONSTRAINT `customers_meeting_status` FOREIGN KEY (`status_id`) REFERENCES `t_customers_meeting_status` (`id`) ON DELETE CASCADE;


ALTER TABLE `t_customers_meeting_history` ADD CONSTRAINT `customers_history_cust` FOREIGN KEY (`customer_id`) REFERENCES `t_customers` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_customers_meeting_history` ADD CONSTRAINT `customers_history_user` FOREIGN KEY (`user_id`) REFERENCES `t_users` (`id`) ON DELETE CASCADE;
--ALTER TABLE `t_customers_meeting_history` ADD CONSTRAINT `customers_comments_status_old` FOREIGN KEY (`old_status_id`) REFERENCES `t_customers_meeting_status` (`id`) ON DELETE CASCADE;
--ALTER TABLE `t_customers_meeting_history` ADD CONSTRAINT `customers_comments_status_new` FOREIGN KEY (`new_status_id`) REFERENCES `t_customers_meeting_status` (`id`) ON DELETE CASCADE;


--
-- Structure de la table `t_customers_meeting_product`  
--
CREATE TABLE IF NOT EXISTS `t_customers_meeting_product` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `meeting_id` int(11) unsigned NOT NULL,
        `product_id` int(11) unsigned NOT NULL,                 
        `details` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)       
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_customers_meeting_product` ADD CONSTRAINT `customers_meeting_prod0` FOREIGN KEY (`meeting_id`) REFERENCES `t_customers_meeting` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_customers_meeting_product` ADD CONSTRAINT `customers_meeting_prod1` FOREIGN KEY (`product_id`) REFERENCES `t_products` (`id`) ON DELETE CASCADE;


-- ALTER TABLE `t_customers_meeting_product` ADD `status` ENUM('ACTIVE','DELETE') NOT NULL DEFAULT 'ACTIVE' AFTER `details`;