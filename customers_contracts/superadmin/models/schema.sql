
--
-- Structure de la table `t_customers_contracts_status`  
--
CREATE TABLE IF NOT EXISTS `t_customers_contracts_status` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
             `name` varchar(64)  NOT NULL,
             `color` varchar(16)  NOT NULL,
             `icon` varchar(64)  NOT NULL,           
     PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_contracts_status_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_customers_contracts_status_i18n` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `status_id` int(11) unsigned NOT NULL,
        `lang` varchar(2)  NOT NULL,             
        `value` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)   ,  
     UNIQUE KEY `unique` (`status_id`,`lang`)   
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_customers_contracts_status_i18n` ADD CONSTRAINT `customers_contract_status` FOREIGN KEY (`status_id`) REFERENCES `t_customers_contracts_status` (`id`) ON DELETE CASCADE;

--
-- Structure de la table `t_customers_contract`  
--
CREATE TABLE IF NOT EXISTS `t_customers_contract` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,   
        `reference` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,       
        `customer_id` int(11) unsigned NOT NULL ,    
        `meeting_id` int(11) unsigned NOT NULL ,       
        `financial_partner_id` int(11) unsigned NOT NULL ,
        `tax_id` int(11) unsigned NOT NULL ,     
        `team_id` INT UNSIGNED NOT NULL , 
        `telepro_id` INT UNSIGNED NOT NULL ,
        `sale_1_id` INT UNSIGNED NOT NULL ,
        `sale_2_id` INT UNSIGNED NOT NULL ,
        `manager_id` INT UNSIGNED NOT NULL,
        `opened_at` DATE  NULL DEFAULT NULL,   
        `sent_at` DATETIME  NULL DEFAULT NULL,     
        `payment_at` DATE  NULL DEFAULT NULL,     
        `opc_at` DATE  NULL DEFAULT NULL,     
        `state_id` int(11) unsigned NOT NULL ,
        `total_price_with_taxe` decimal(20,6) DEFAULT '0.000000',
        `total_price_without_taxe` decimal(20,6) DEFAULT '0.000000',
        `remarks` TEXT NOT NULL,
        `variables` TEXT NOT NULL,
        `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',       
        `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp  NOT NULL DEFAULT '0000-00-00 00:00:00'   ,         
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

ALTER TABLE `t_customers_contract` ADD CONSTRAINT `customers_contract_cust` FOREIGN KEY (`customer_id`) REFERENCES `t_customers` (`id`) ON DELETE CASCADE;

--
-- Structure de la table `t_customers_contract_product`  
--
CREATE TABLE IF NOT EXISTS `t_customers_contract_product` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `contract_id` int(11) unsigned NOT NULL,
        `product_id` int(11) unsigned NOT NULL,                 
        `details` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)       
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_customers_contract_product` ADD CONSTRAINT `customers_contract_prod0` FOREIGN KEY (`contract_id`) REFERENCES `t_customers_contract` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_customers_contract_product` ADD CONSTRAINT `customers_contract_prod1` FOREIGN KEY (`product_id`) REFERENCES `t_products` (`id`) ON DELETE CASCADE;


--
-- Structure de la table `t_customers_contracts_history`  
--
CREATE TABLE IF NOT EXISTS `t_customers_contracts_history` (              
    `id` int(11) NOT NULL AUTO_INCREMENT,  
    `contract_id` int(11) unsigned NOT NULL,
    `user_id` int(11) unsigned NOT NULL, 
    `user_application` enum('admin','superadmin') COLLATE utf8_bin NOT NULL, 
    `history` TEXT NOT NULL  NOT NULL,     
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)     
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `t_customers_contracts_history` ADD CONSTRAINT `customers_contract_history` FOREIGN KEY (`contract_id`) REFERENCES `t_customers_contract` (`id`) ON DELETE CASCADE;


--
-- Structure de la table `t_customers_contracts_contributor`  
--
CREATE TABLE IF NOT EXISTS `t_customers_contracts_contributor` (              
    `id` int(11) NOT NULL AUTO_INCREMENT,  
    `type` varchar(24) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
    `contract_id` int(11) unsigned NOT NULL,
    `user_id` int(11) unsigned NOT NULL,     
    `attribution_id` int(11) unsigned NOT NULL,     
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)     
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;