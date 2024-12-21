ALTER TABLE `t_domoprime_quotation` ADD `is_last` enum('NO','YES') COLLATE utf8_bin NOT NULL DEFAULT 'NO' AFTER `is_signed`;       
ALTER TABLE `t_domoprime_asset` ADD  `billing_id` int(11) unsigned NULL DEFAULT NULL AFTER `customer_id`; 
ALTER TABLE `t_domoprime_asset` ADD CONSTRAINT `domoprime_asset_2` FOREIGN KEY (`billing_id`) REFERENCES `t_domoprime_billing` (`id`) ON DELETE CASCADE;

--
-- Structure de la table `t_domoprime_asset_product`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_asset_product` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `asset_id` int(11) unsigned NOT NULL,
        `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,          
        `entitled` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `product_id` int(11) unsigned NOT NULL,     
        `meeting_id` int(11) unsigned NOT NULL, 
        `meeting_product_id` int(11) unsigned NOT NULL,     
        `purchase_price_with_tax` DECIMAL(20,6) NOT NULL,
        `sale_price_with_tax` DECIMAL(20,6) NOT NULL,
        `purchase_price_without_tax` DECIMAL(20,6) NOT NULL,
        `sale_price_without_tax` DECIMAL(20,6) NOT NULL,
        `total_purchase_price_with_tax` DECIMAL(20,6) NOT NULL,
        `total_sale_price_with_tax` DECIMAL(20,6) NOT NULL,
        `total_purchase_price_without_tax` DECIMAL(20,6) NOT NULL,
        `total_sale_price_without_tax` DECIMAL(20,6) NOT NULL,
        `quantity` DECIMAL(20,6) NOT NULL,
        `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL, 
        `tva_id` int(11) unsigned NOT NULL,                
        `details` text COLLATE utf8_bin NOT NULL,       
        `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',           
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)       
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_domoprime_asset_product` ADD CONSTRAINT `domoprime_asset_product_0` FOREIGN KEY (`asset_id`) REFERENCES `t_domoprime_asset` (`id`) ON DELETE CASCADE;


CREATE TABLE IF NOT EXISTS `t_domoprime_asset_product_item` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `asset_id` int(11) unsigned NOT NULL,
        `asset_product_id` int(11) unsigned NOT NULL,
        `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,          
        `entitled` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `product_id` int(11) unsigned NOT NULL,   
        `product_item_id` int(11) unsigned NOT NULL,             
        `item_id` int(11) unsigned NOT NULL,             
        `purchase_price_with_tax` DECIMAL(20,6) NOT NULL,
        `sale_price_with_tax` DECIMAL(20,6) NOT NULL,
        `purchase_price_without_tax` DECIMAL(20,6) NOT NULL,
        `sale_price_without_tax` DECIMAL(20,6) NOT NULL,
        `total_purchase_price_with_tax` DECIMAL(20,6) NOT NULL,
        `total_sale_price_with_tax` DECIMAL(20,6) NOT NULL,
        `total_purchase_price_without_tax` DECIMAL(20,6) NOT NULL,
        `total_sale_price_without_tax` DECIMAL(20,6) NOT NULL,
        `quantity` DECIMAL(20,6) NOT NULL,
        `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL, 
        `tva_id` int(11) unsigned NOT NULL,                
        `details` text COLLATE utf8_bin NOT NULL,       
        `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',           
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)       
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_domoprime_asset_product_item` ADD CONSTRAINT `domoprime_asset_product_item_0` FOREIGN KEY (`asset_id`) REFERENCES `t_domoprime_asset` (`id`) ON DELETE CASCADE;
