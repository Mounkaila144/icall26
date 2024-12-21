--
-- Structure de la table `t_app_mutual_sale_commission`  
--
CREATE TABLE IF NOT EXISTS `t_app_mutual_sale_commission` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
    `from` int(2) NOT NULL,              
    `to` int(2) NOT NULL,              
    `rate` FLOAT NOT NULL,  
    `mutual_product_id` int(11) unsigned NOT NULL,
    `started_at` timestamp NULL DEFAULT NULL,
    `ended_at` timestamp NULL DEFAULT NULL,  
    `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
    `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE', 
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',             
    PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Structure de la table `t_app_mutual_sale_decommission`  
--
CREATE TABLE IF NOT EXISTS `t_app_mutual_sale_decommission` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
    `from` int(2) NOT NULL,              
    `to` int(2) NOT NULL,              
    `rate` FLOAT NOT NULL,   
    `fix` FLOAT NOT NULL,   
    `mutual_product_id` int(11) unsigned NOT NULL,
    `started_at` timestamp NULL DEFAULT NULL,
    `ended_at` timestamp NULL DEFAULT NULL,  
    `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
    `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE', 
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',             
    PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Structure de la table `t_app_mutual_customers_meeting_products`  
--
CREATE TABLE IF NOT EXISTS `t_app_mutual_customers_meeting_products` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
    `meeting_id` int(11) unsigned NOT NULL,              
    `product_id` int(11) unsigned NOT NULL,  
    `tva_id` int(11) unsigned NULL DEFAULT NULL,
    `quantity` int(2) unsigned NOT NULL,
    `sale_price_with_tax` DECIMAL(12,2) NOT NULL,
    `purchase_price_with_tax` DECIMAL(12,2) NOT NULL,
    `sale_price_without_tax` DECIMAL(12,2) NOT NULL,
    `purchase_price_without_tax` DECIMAL(12,2) NOT NULL,
    `total_sale_price_with_tax` DECIMAL(12,2) NOT NULL,
    `total_purchase_price_with_tax` DECIMAL(12,2) NOT NULL,
    `total_sale_price_without_tax` DECIMAL(12,2) NOT NULL,
    `total_purchase_price_without_tax` DECIMAL(12,2) NOT NULL,
    `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
    `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE', 
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',             
    PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Constraint on table `t_app_mutual_sale_commission`
--
ALTER TABLE `t_app_mutual_sale_commission` ADD CONSTRAINT `fk_app_mutual_sale_commission_1` FOREIGN KEY (`mutual_product_id`) REFERENCES `t_app_mutual_product` (`id`) ON DELETE CASCADE;

--
-- Constraint on table `t_app_mutual_sale_decommission`
--
ALTER TABLE `t_app_mutual_sale_decommission` ADD CONSTRAINT `fk_app_mutual_sale_decommission_1` FOREIGN KEY (`mutual_product_id`) REFERENCES `t_app_mutual_product` (`id`) ON DELETE CASCADE;

--
-- Constraint on table `t_customers_meeting_mutual_products`
--
ALTER TABLE `t_app_mutual_customers_meeting_products` ADD CONSTRAINT `fk_customers_meeting_mutual_products_1` FOREIGN KEY (`meeting_id`) REFERENCES `t_customers_meeting` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_app_mutual_customers_meeting_products` ADD CONSTRAINT `fk_customers_meeting_mutual_products_2` FOREIGN KEY (`product_id`) REFERENCES `t_app_mutual_product` (`id`) ON DELETE CASCADE;
