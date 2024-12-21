--
-- Structure de la table `t_app_mutual_product`  
--
CREATE TABLE IF NOT EXISTS `t_app_mutual_product` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `financial_partner_id` int(11) unsigned NOT NULL, 
    `name` varchar(64) NOT NULL,          
    `price` DECIMAL(16,6) NOT NULL,          
    `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
    `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE', 
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',  
    PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_app_mutual_partner_params`
--
CREATE TABLE IF NOT EXISTS `t_app_mutual_partner_params` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,    
    `taxe` varchar(4) COLLATE utf8_bin DEFAULT NULL,
    `fees` float NOT NULL,
    `financial_partner_id` int(11) unsigned NOT NULL, 
    `started_at` timestamp NULL DEFAULT NULL,
    `ended_at` timestamp NULL DEFAULT NULL, 
    `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
    `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE', 
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',  
    PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

--
-- Structure de la table `t_app_mutual_commission`  
--
CREATE TABLE IF NOT EXISTS `t_app_mutual_commission` (
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
-- Structure de la table `t_app_mutual_decommission`  
--
CREATE TABLE IF NOT EXISTS `t_app_mutual_decommission` (
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
-- Structure de la table `t_app_mutual_engine_calculation_meeting`  
--
CREATE TABLE IF NOT EXISTS `t_app_mutual_engine_calculation_meeting` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
    `meeting_id` int(11) unsigned NOT NULL,       
    `commission` FLOAT NOT NULL,       
    `decommission` FLOAT NOT NULL,       
    `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
    `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE', 
    `date_calculation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `is_last` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',             
    PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Structure de la table `t_app_mutual_engine_calculation_mutual`  
--
CREATE TABLE IF NOT EXISTS `t_app_mutual_engine_calculation_mutual` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
    `meeting_calculation_id` int(11) unsigned NOT NULL,       
    `financial_partner_id` int(11) unsigned NOT NULL,        
    `commission` FLOAT NOT NULL,       
    `decommission` FLOAT NOT NULL,       
    `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
    `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE', 
    `date_calculation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',             
    PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Structure de la table `t_app_mutual_engine_calculation_product`  
--
CREATE TABLE IF NOT EXISTS `t_app_mutual_engine_calculation_product` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
    `meeting_calculation_id` int(11) unsigned NOT NULL,       
    `mutual_calculation_id` int(11) unsigned NOT NULL,       
    `product_id` int(11) unsigned NOT NULL,       
    `commission` FLOAT NOT NULL,       
    `decommission` FLOAT NOT NULL,       
    `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
    `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE', 
    `date_calculation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',             
    PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


--
-- Structure de la table `t_app_mutual_engine_calculation_meeting_scheduler`  
--
CREATE TABLE IF NOT EXISTS `t_app_mutual_engine_calculation_meeting_scheduler` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,                 
--     `start` int(11) NOT NULL,
--     `stop` int(1) DEFAULT NULL,
    `meeting_id` int(11) unsigned NOT NULL,
    `date_calculation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `is_process` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
    `in_process` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
    `is_completed` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
    `position` int(11) NOT NULL,
    `number_of_results` int(11) DEFAULT NULL,
    `has_error` enum('YES','NO') NOT NULL DEFAULT 'NO',
    `error_code` int(11) NOT NULL,   
    `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
    `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',             
    PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Constraint on table `t_app_mutual_product`
--
ALTER TABLE `t_app_mutual_product` ADD CONSTRAINT `fk_mutual_product_partner` FOREIGN KEY (`financial_partner_id`) REFERENCES `t_partners_company` (`id`) ON DELETE CASCADE;

--
-- Constraint on table `t_mutual_partner_params`
--
ALTER TABLE `t_app_mutual_partner_params` ADD CONSTRAINT `fk_mutual_partner_params_1` FOREIGN KEY (`financial_partner_id`) REFERENCES `t_partners_company` (`id`) ON DELETE CASCADE;

--
-- Constraint on table `t_mutual_commission`
--
ALTER TABLE `t_app_mutual_commission` ADD CONSTRAINT `fk_mutual_commission_1` FOREIGN KEY (`mutual_product_id`) REFERENCES `t_app_mutual_product` (`id`) ON DELETE CASCADE;

--
-- Constraint on table `t_mutual_decommission`
--
ALTER TABLE `t_app_mutual_decommission` ADD CONSTRAINT `fk_mutual_decommission_1` FOREIGN KEY (`mutual_product_id`) REFERENCES `t_app_mutual_product` (`id`) ON DELETE CASCADE;

--
-- Constraint on table `t_customers_meeting_mutual_products`
--
ALTER TABLE `t_app_mutual_customers_meeting_products` ADD CONSTRAINT `fk_customers_meeting_mutual_products_1` FOREIGN KEY (`meeting_id`) REFERENCES `t_customers_meeting` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_app_mutual_customers_meeting_products` ADD CONSTRAINT `fk_customers_meeting_mutual_products_2` FOREIGN KEY (`product_id`) REFERENCES `t_app_mutual_product` (`id`) ON DELETE CASCADE;

--
-- Constraint on table `t_app_mutual_engine_calculation_meeting`
--
ALTER TABLE `t_app_mutual_engine_calculation_meeting` ADD CONSTRAINT `fk_app_mutual_engine_calculation_meeting_1` FOREIGN KEY (`meeting_id`) REFERENCES `t_customers_meeting` (`id`) ON DELETE CASCADE;

-- 
-- Constraint on table `t_app_mutual_engine_calculation_mutual`
-- 
ALTER TABLE `t_app_mutual_engine_calculation_mutual` ADD CONSTRAINT `fk_app_mutual_engine_calculation_mutual_1` FOREIGN KEY (`financial_partner_id`) REFERENCES `t_partners_company` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_app_mutual_engine_calculation_mutual` ADD CONSTRAINT `fk_app_mutual_engine_calculation_mutual_2` FOREIGN KEY (`meeting_calculation_id`) REFERENCES `t_app_mutual_engine_calculation_meeting` (`id`) ON DELETE CASCADE;

-- 
-- Constraint on table `t_app_mutual_engine_calculation_product`
-- 
ALTER TABLE `t_app_mutual_engine_calculation_product` ADD CONSTRAINT `fk_app_mutual_engine_calculation_product_1` FOREIGN KEY (`meeting_calculation_id`) REFERENCES `t_app_mutual_engine_calculation_meeting` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_app_mutual_engine_calculation_product` ADD CONSTRAINT `fk_app_mutual_engine_calculation_product_2` FOREIGN KEY (`mutual_calculation_id`) REFERENCES `t_app_mutual_engine_calculation_mutual` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_app_mutual_engine_calculation_product` ADD CONSTRAINT `fk_app_mutual_engine_calculation_product_3` FOREIGN KEY (`product_id`) REFERENCES `t_app_mutual_product` (`id`) ON DELETE CASCADE;

--
-- Constraint on table `t_app_mutual_engine_calculation_meeting_scheduler`
--
ALTER TABLE `t_app_mutual_engine_calculation_meeting_scheduler` ADD CONSTRAINT `fk_app_mutual_engine_calculation_meeting_scheduler_1` FOREIGN KEY (`meeting_id`) REFERENCES `t_customers_meeting` (`id`) ON DELETE CASCADE;
