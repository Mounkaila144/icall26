
--
-- Structure de la table `t_products_item`  
--
CREATE TABLE IF NOT EXISTS `t_products_item` (
             `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
             `tva_id` int(11) unsigned NOT NULL,            
             `product_id` int(11) unsigned NOT NULL,      
             `reference` varchar(255)  NOT NULL,  
             `description` varchar(255)  NOT NULL,            
             `sale_price` decimal(20,6) NOT NULL DEFAULT '0.000000',  
             `purchasing_price`  decimal(20,6) NOT NULL DEFAULT '0.000000',
             `input1` varchar(255)  NOT NULL, 
             `input2` varchar(255)  NOT NULL, 
             `picture` varchar(255)  NOT NULL,
             `unit` varchar(255)  NOT NULL,
             `icon` varchar(255)  NOT NULL,   
             `content` text  COLLATE utf8_general_ci NOT NULL,                       
             `details` text  COLLATE utf8_general_ci NOT NULL,      
             `is_active` enum('YES','NO')  NOT NULL DEFAULT 'NO',             
             `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',             
             `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
             `updated_at` timestamp  NOT NULL DEFAULT '0000-00-00 00:00:00'   ,
     PRIMARY KEY (`id`)       
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

ALTER TABLE `t_products_item` ADD CONSTRAINT `t_products_item_0` FOREIGN KEY (`product_id`) REFERENCES `t_products` (`id`) ON DELETE CASCADE;
