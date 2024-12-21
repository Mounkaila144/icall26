
--
-- Structure de la table `t_domoprime_iso_customer_request`
--

CREATE TABLE IF NOT EXISTS `t_domoprime_iso_customer_request` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,    
  `meeting_id` int(11) unsigned  NULL DEFAULT NULL,     
  `contract_id` int(11) unsigned  NULL DEFAULT NULL,     
  `customer_id` int(11) unsigned  NULL DEFAULT NULL,  
  `energy_id` int(11) unsigned  NULL DEFAULT NULL,     
  `revenue` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `number_of_people` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `surface_wall` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `surface_top` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `surface_floor` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `occupation_id` int(11) unsigned  NULL DEFAULT NULL,     
  `layer_type_id` int(11) unsigned  NULL DEFAULT NULL,     
  `number_of_fiscal` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `more_2_years` enum('NO','YES') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Structure de la table `t_domoprime_iso_occupation`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_iso_occupation` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
             `name` varchar(64)  NOT NULL,                    
     PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_domoprime_iso_occupation_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_iso_occupation_i18n` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `occupation_id` int(11) unsigned NOT NULL,
        `lang` varchar(2)  NOT NULL,             
        `value` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)   ,  
     UNIQUE KEY `unique` (`occupation_id`,`lang`)   
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_domoprime_iso_occupation_i18n` ADD CONSTRAINT `domoprime_iso_occupation_fk00` FOREIGN KEY (`occupation_id`) REFERENCES `t_domoprime_iso_occupation` (`id`) ON DELETE CASCADE;

--
-- Structure de la table `t_domoprime_iso_type_layer`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_iso_type_layer` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
             `name` varchar(64)  NOT NULL,              
     PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_domoprime_iso_type_layer_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_iso_type_layer_i18n` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `type_id` int(11) unsigned NOT NULL,
        `lang` varchar(2)  NOT NULL,             
        `value` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)   ,  
     UNIQUE KEY `unique` (`type_id`,`lang`)   
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_domoprime_iso_type_layer_i18n` ADD CONSTRAINT `domoprime_iso_type_layer_fk00` FOREIGN KEY (`type_id`) REFERENCES `t_domoprime_iso_type_layer` (`id`) ON DELETE CASCADE;



--
-- Structure de la table `t_domoprime_iso_simulation`
--

CREATE TABLE `t_domoprime_iso_simulation` (
   `id` int(11) unsigned NOT NULL AUTO_INCREMENT,    
  `reference` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `month` int(11) UNSIGNED NOT NULL,
  `year` int(11) UNSIGNED NOT NULL,
  `dated_at` timestamp NULL DEFAULT NULL,
  `total_sale_without_tax` decimal(20,6) NOT NULL,
  `total_purchase_without_tax` decimal(20,6) NOT NULL,
  `total_sale_with_tax` decimal(20,6) NOT NULL,
  `total_tax` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `total_purchase_with_tax` decimal(20,6) NOT NULL,
  `prime` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `meeting_id` int(11) UNSIGNED DEFAULT NULL,
  `customer_id` int(11) UNSIGNED NOT NULL,
  `contract_id` int(11) UNSIGNED DEFAULT NULL,
  `creator_id` int(11) UNSIGNED NOT NULL,
  `comments` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status_id` int(11) UNSIGNED NOT NULL,  
  `is_last` enum('NO','YES') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'NO',   
  `status` enum('ACTIVE','DELETE') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)     
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_domoprime_iso_simulation_product`
--

CREATE TABLE `t_domoprime_iso_simulation_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,    
  `simulation_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `entitled` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `meeting_id` int(11) UNSIGNED NOT NULL,
  `meeting_product_id` int(11) UNSIGNED NOT NULL,
  `purchase_price_with_tax` decimal(20,6) NOT NULL,
  `sale_price_with_tax` decimal(20,6) NOT NULL,
  `purchase_price_without_tax` decimal(20,6) NOT NULL,
  `sale_price_without_tax` decimal(20,6) NOT NULL,
  `total_purchase_price_with_tax` decimal(20,6) NOT NULL,
  `total_sale_price_with_tax` decimal(20,6) NOT NULL,
  `prime` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `total_purchase_price_without_tax` decimal(20,6) NOT NULL,
  `total_sale_price_without_tax` decimal(20,6) NOT NULL,
  `quantity` decimal(20,6) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tva_id` int(11) UNSIGNED NOT NULL,
  `details` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` enum('ACTIVE','DELETE') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
 PRIMARY KEY (`id`)   
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_domoprime_iso_simulation_product_item`
--

CREATE TABLE `t_domoprime_iso_simulation_product_item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,    
  `simulation_id` int(11) UNSIGNED NOT NULL,
  `simulation_product_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `entitled` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `product_item_id` int(11) UNSIGNED NOT NULL,
  `item_id` int(11) UNSIGNED NOT NULL,
  `purchase_price_with_tax` decimal(20,6) NOT NULL,
  `sale_price_with_tax` decimal(20,6) NOT NULL,
  `purchase_price_without_tax` decimal(20,6) NOT NULL,
  `sale_price_without_tax` decimal(20,6) NOT NULL,
  `total_purchase_price_with_tax` decimal(20,6) NOT NULL,
  `total_sale_price_with_tax` decimal(20,6) NOT NULL,
  `total_purchase_price_without_tax` decimal(20,6) NOT NULL,
  `total_sale_price_without_tax` decimal(20,6) NOT NULL,
  `total_tax` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `quantity` decimal(20,6) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `coefficient` decimal(20,6) DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tva_id` int(11) UNSIGNED NOT NULL,
  `is_mandatory` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `details` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` enum('ACTIVE','DELETE') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
 PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `t_domoprime_iso_simulation`
  ADD KEY `domoprime_iso_simulation_00` (`meeting_id`),
  ADD KEY `domoprime_iso_simulation_01` (`contract_id`);

ALTER TABLE `t_domoprime_iso_simulation_product` ADD KEY `domoprime_iso_simulation_product_0` (`simulation_id`);


ALTER TABLE `t_domoprime_iso_simulation_product_item`  
  ADD KEY `domoprime_iso_simulation_product_item_0` (`simulation_id`),
  ADD KEY `domoprime_iso_simulation_product_item_1` (`simulation_product_id`);



--
-- Contraintes pour la table `t_domoprime_simulation`
--
ALTER TABLE `t_domoprime_iso_simulation`
  ADD CONSTRAINT `domoprime_iso_simulation_00` FOREIGN KEY (`meeting_id`) REFERENCES `t_customers_meeting` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `domoprime_iso_simulation_01` FOREIGN KEY (`contract_id`) REFERENCES `t_customers_contract` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `t_domoprime_simulation_product`
--
ALTER TABLE `t_domoprime_iso_simulation_product`
  ADD CONSTRAINT `domoprime_iso_simulation_product_0` FOREIGN KEY (`simulation_id`) REFERENCES `t_domoprime_iso_simulation` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `t_domoprime_iso_simulation_product_item`
--
ALTER TABLE `t_domoprime_iso_simulation_product_item`
  ADD CONSTRAINT `domoprime_iso_simulation_product_item_0` FOREIGN KEY (`simulation_id`) REFERENCES `t_domoprime_iso_simulation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `domoprime_iso_simulation_product_item_1` FOREIGN KEY (`simulation_product_id`) REFERENCES `t_domoprime_iso_simulation_product` (`id`) ON DELETE CASCADE;


--
-- Structure de la table `t_customers_iso_simulation_model`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_iso_simulation_model` (   
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,       
    `name` varchar(255) COLLATE utf8_bin NOT NULL,   
     PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Structure de la table `t_domoprime_iso_simulation_model_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_iso_simulation_model_i18n` (   
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

ALTER TABLE `t_domoprime_iso_simulation_model_i18n` ADD CONSTRAINT `domoprime_iso_simulation_model_0` FOREIGN KEY (`model_id`) REFERENCES `t_domoprime_iso_simulation_model` (`id`) ON DELETE CASCADE;

