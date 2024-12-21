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
ALTER TABLE `t_app_mutual_engine_calculation_product` ADD CONSTRAINT `fk_app_mutual_engine_calculation_product_3` FOREIGN KEY (`product_id`) REFERENCES `t_mutual_product` (`id`) ON DELETE CASCADE;