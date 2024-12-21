--
-- Structure de la table `t_domoprime_sector`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_sector` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
        `name` varchar(64)  NOT NULL,              
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',  
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_domoprime_zone`
--

CREATE TABLE IF NOT EXISTS `t_domoprime_zone` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,    
  `code` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `dept` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `region_id` int(11) unsigned NOT NULL,
  `sector` varchar(4) COLLATE utf8_bin NOT NULL DEFAULT '', 
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Structure de la table `t_domoprime_energy`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_energy` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
        `name` varchar(64)  NOT NULL,              
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_domoprime_energy_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_energy_i18n` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `energy_id` int(11) unsigned NOT NULL,
        `lang` varchar(2)  NOT NULL,             
        `value` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)   ,  
     UNIQUE KEY `unique` (`energy_id`,`lang`)   
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_domoprime_energy_i18n` ADD CONSTRAINT `domoprime_energy_0` FOREIGN KEY (`energy_id`) REFERENCES `t_domoprime_energy` (`id`) ON DELETE CASCADE;

--
-- Structure de la table `t_domoprime_product_sector_energy`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_product_sector_energy` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
        `energy_id` int(11) unsigned NOT NULL,
        `product_id` int(11) unsigned NOT NULL,
        `sector_id` int(11) unsigned NOT NULL,
        `price` decimal(20,6) NOT NULL DEFAULT '0.000000',  
 `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',      
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;


--
-- Structure de la table `t_domoprime_region`
--

CREATE TABLE IF NOT EXISTS `t_domoprime_region` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,     
  `name` varchar(48) COLLATE utf8_bin NOT NULL DEFAULT '', 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;


--
-- Structure de la table `t_domoprime_class`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_class` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,  
        `coef` decimal(20,6) NOT NULL DEFAULT '0.000000',            
        `name` varchar(64)  NOT NULL,              
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_domoprime_class_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_class_i18n` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `class_id` int(11) unsigned NOT NULL,
        `lang` varchar(2)  NOT NULL,             
        `value` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)   ,  
     UNIQUE KEY `unique` (`class_id`,`lang`)   
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_domoprime_class_i18n` ADD CONSTRAINT `domoprime_class_0` FOREIGN KEY (`class_id`) REFERENCES `t_domoprime_class` (`id`) ON DELETE CASCADE;


--
-- Structure de la table `t_domoprime_class_region_price`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_class_region_price` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
        `region_id` int(11) unsigned NOT NULL,       
        `class_id` int(11) unsigned NOT NULL,   
        `number_of_people` int(8) unsigned NOT NULL DEFAULT 0,     
        `price` decimal(20,6) NOT NULL DEFAULT '0.000000',  
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',      
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--ALTER TABLE `t_domoprime_class_region_price` ADD CONSTRAINT `domoprime_class_region_price_0` FOREIGN KEY (`region_id`) REFERENCES `t_domoprime_region` (`id`) ON DELETE CASCADE;

-- ALTER TABLE `t_domoprime_class_region_price`   DROP FOREIGN KEY `domoprime_class_region_price_0`

CREATE TABLE IF NOT EXISTS `t_domoprime_calculation` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
        `region_id` int(11) unsigned NOT NULL,       
        `sector_id` int(11) unsigned NOT NULL,       
        `zone_id` int(11) unsigned NOT NULL,       
        `meeting_id` int(11) unsigned NOT NULL,      
        `energy_id` int(11) unsigned NOT NULL,  
        `class_id` int(11) unsigned NOT NULL,   
        `revenue` decimal(20,6) NOT NULL DEFAULT '0.000000',
        `number_of_people` int(8) unsigned NOT NULL DEFAULT 0,     
        `qmac_value` decimal(20,6) NOT NULL DEFAULT '0.000000',  
        `qmac` decimal(20,6) NOT NULL DEFAULT '0.000000',
        `purchasing_price` decimal(20,6) NOT NULL DEFAULT '0.000000',
        `margin` decimal(20,6) NOT NULL DEFAULT '0.000000',
        `user_id` int(11) unsigned NOT NULL,     
        `accepted_by_id` int(11) unsigned NOT NULL,   
        `isLast` enum('NO','YES') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
        `status` enum('ACCEPTED','REFUSED','REQUEST') COLLATE utf8_bin NOT NULL DEFAULT 'REFUSED',
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',      
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `t_domoprime_product_calculation` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,    
        `calculation_id` int(11) unsigned NOT NULL,       
        `product_id` int(11) unsigned NOT NULL,              
        `qmac_value` decimal(20,6) NOT NULL DEFAULT '0.000000',  
        `qmac` decimal(20,6) NOT NULL DEFAULT '0.000000',  
        `surface` decimal(20,6) NOT NULL DEFAULT '0.000000',  
        `purchasing_price` decimal(20,6) NOT NULL DEFAULT '0.000000',
        `margin` decimal(20,6) NOT NULL DEFAULT '0.000000',
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',      
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

ALTER TABLE `t_domoprime_product_calculation` ADD CONSTRAINT `domoprime_product_calculation_0` FOREIGN KEY (`calculation_id`) REFERENCES `t_domoprime_calculation` (`id`) ON DELETE CASCADE;


--
-- Structure de la table `t_customers_model_email`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_quotation_model` (   
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,       
    `name` varchar(255) COLLATE utf8_bin NOT NULL,   
     PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Structure de la table `t_domoprime_quotation_model_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_quotation_model_i18n` (   
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,  
    `model_id` int(11) unsigned NOT NULL,
    `lang` varchar(2) NOT NULL default '',
    `value` varchar(255) COLLATE utf8_bin NOT NULL,      
    `body` text COLLATE utf8_bin NOT NULL, 
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`),   
    UNIQUE KEY `unique` (`lang`,`model_id`)     
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `t_domoprime_quotation_model_i18n` ADD CONSTRAINT `domoprime_quotation_model_0` FOREIGN KEY (`model_id`) REFERENCES `t_domoprime_quotation_model` (`id`) ON DELETE CASCADE;


--
-- Structure de la table `t_domoprime_quotation`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_quotation` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `reference` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,    
        `month` int(11) unsigned NOT NULL,      
        `year` int(11) unsigned NOT NULL,      
        `total_sale_without_tax` DECIMAL(20,6) NOT NULL,
        `total_purchase_without_tax` DECIMAL(20,6) NOT NULL,
        `total_sale_with_tax` DECIMAL(20,6) NOT NULL,
        `total_purchase_with_tax` DECIMAL(20,6) NOT NULL,
        `meeting_id` int(11) unsigned NOT NULL,     
        `customer_id` int(11) unsigned NOT NULL,               
        `comments` text COLLATE utf8_bin NOT NULL,     
        `status_id` int(11) unsigned NOT NULL,   
        `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',                       
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)       
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;


--
-- Structure de la table `t_domoprime_quotation_product`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_quotation_product` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `quotation_id` int(11) unsigned NOT NULL,
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

ALTER TABLE `t_domoprime_quotation_product` ADD CONSTRAINT `domoprime_quotation_product_0` FOREIGN KEY (`quotation_id`) REFERENCES `t_domoprime_quotation` (`id`) ON DELETE CASCADE;

--
-- Structure de la table `t_domoprime_quotation_product_item`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_quotation_product_item` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `quotation_id` int(11) unsigned NOT NULL,
        `quotation_product_id` int(11) unsigned NOT NULL,
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

ALTER TABLE `t_domoprime_quotation_product_item` ADD CONSTRAINT `domoprime_quotation_product_item_0` FOREIGN KEY (`quotation_id`) REFERENCES `t_domoprime_quotation` (`id`) ON DELETE CASCADE;

--
-- Structure de la table `t_domoprime_billing`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_billing` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `reference` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,    
        `month` int(11) unsigned NOT NULL,      
        `year` int(11) unsigned NOT NULL,      
        `total_sale_without_tax` DECIMAL(20,6) NOT NULL,
        `total_purchase_without_tax` DECIMAL(20,6) NOT NULL,
        `total_sale_with_tax` DECIMAL(20,6) NOT NULL,
        `total_purchase_with_tax` DECIMAL(20,6) NOT NULL,
        `meeting_id` int(11) unsigned NOT NULL,   
        `contract_id` int(11) unsigned NOT NULL,     
        `customer_id` int(11) unsigned NOT NULL,               
        `comments` text COLLATE utf8_bin NOT NULL,     
        `status_id` int(11) unsigned NOT NULL,   
        `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',                       
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)       
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;



--
-- Structure de la table `t_domoprime_billing_product`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_billing_product` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `billing_id` int(11) unsigned NOT NULL,
        `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,          
        `entitled` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `product_id` int(11) unsigned NOT NULL,     
        `contract_id` int(11) unsigned NOT NULL, 
        `contract_product_id` int(11) unsigned NOT NULL,     
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

ALTER TABLE `t_domoprime_billing_product` ADD CONSTRAINT `domoprime_billing_product_0` FOREIGN KEY (`billing_id`) REFERENCES `t_domoprime_billing` (`id`) ON DELETE CASCADE;

--
-- Structure de la table `t_domoprime_billing_product_item`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_billing_product_item` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `billing_id` int(11) unsigned NOT NULL,
        `billing_product_id` int(11) unsigned NOT NULL,
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

ALTER TABLE `t_domoprime_billing_product_item` ADD CONSTRAINT `domoprime_billing_product_item_0` FOREIGN KEY (`billing_id`) REFERENCES `t_domoprime_billing` (`id`) ON DELETE CASCADE;


--
-- Structure de la table `t_customers_billing_email`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_billing_model` (   
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,       
    `name` varchar(255) COLLATE utf8_bin NOT NULL,   
     PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Structure de la table `t_domoprime_billing_model_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_billing_model_i18n` (   
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,  
    `model_id` int(11) unsigned NOT NULL,
    `lang` varchar(2) NOT NULL default '',
    `value` varchar(255) COLLATE utf8_bin NOT NULL,      
    `body` text COLLATE utf8_bin NOT NULL, 
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`),   
    UNIQUE KEY `unique` (`lang`,`model_id`)     
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `t_domoprime_billing_model_i18n` ADD CONSTRAINT `domoprime_billing_model_0` FOREIGN KEY (`model_id`) REFERENCES `t_domoprime_billing_model` (`id`) ON DELETE CASCADE;
