ALTER TABLE `t_customers_contract` ADD `is_confirmed` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO' AFTER `variables`;
ALTER TABLE `t_customers_contract` ADD `opc_range_id` INT(11) UNSIGNED NOT NULL  AFTER `variables`;


--
-- Structure de la table `t_customers_contracts_date_range`  
--
CREATE TABLE IF NOT EXISTS `t_customers_contracts_date_range` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
        `name` varchar(64)  NOT NULL,
        `from` TIME  NULL DEFAULT NULL ,                 
        `to` TIME NULL DEFAULT NULL,       
     PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_contracts_contracts_date_range_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_customers_contracts_date_range_i18n` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `range_id` int(11) unsigned NOT NULL,
        `lang` varchar(2)  NOT NULL,             
        `value` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)   ,  
     UNIQUE KEY `unique` (`range_id`,`lang`)   
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_customers_contracts_date_range_i18n` ADD CONSTRAINT `customers_contract_range` FOREIGN KEY (`range_id`) REFERENCES `t_customers_contracts_date_range` (`id`) ON DELETE CASCADE;

      

