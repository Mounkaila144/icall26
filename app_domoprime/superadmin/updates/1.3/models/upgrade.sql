ALTER TABLE `t_domoprime_quotation_product_item` ADD CONSTRAINT `domoprime_quotation_product_item_1` FOREIGN KEY (`quotation_product_id`) REFERENCES `t_domoprime_quotation_product` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_domoprime_quotation` ADD `is_signed` enum('NO','YES') COLLATE utf8_bin NOT NULL DEFAULT 'NO' AFTER `status_id`;       
ALTER TABLE `t_domoprime_billing` ADD `dated_at`  timestamp  NULL DEFAULT NULL AFTER `year`;  
ALTER TABLE `t_domoprime_billing` ADD `day`  int(11) unsigned NOT NULL AFTER `month`; 

CREATE TABLE IF NOT EXISTS `t_domoprime_asset` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `reference` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,    
        `month` int(11) unsigned NOT NULL,      
        `year` int(11) unsigned NOT NULL,  
        `dated_at`  timestamp  NULL DEFAULT NULL,
        `total_asset_without_tax` DECIMAL(20,6) NOT NULL,       
        `total_asset_with_tax` DECIMAL(20,6) NOT NULL,       
        `meeting_id` int(11) unsigned NOT NULL,   
        `contract_id` int(11) unsigned NOT NULL,     
        `customer_id` int(11) unsigned NOT NULL,    
        `creator_id` int(11) unsigned NOT NULL ,          
        `comments` text COLLATE utf8_bin NOT NULL,     
        `status_id` int(11) unsigned NOT NULL,   
        `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',                       
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)       
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;


--
-- Structure de la table `t_customers_model_email`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_asset_model` (   
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,       
    `name` varchar(255) COLLATE utf8_bin NOT NULL,   
     PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Structure de la table `t_domoprime_quotation_model_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_asset_model_i18n` (   
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

ALTER TABLE `t_domoprime_asset_model_i18n` ADD CONSTRAINT `domoprime_asset_model_0` FOREIGN KEY (`model_id`) REFERENCES `t_domoprime_asset_model` (`id`) ON DELETE CASCADE;

