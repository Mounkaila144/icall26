ALTER TABLE `t_customers_contract` ADD `install_state_id` INT(11) unsigned NULL DEFAULT NULL AFTER `state_id`;
--
-- Structure de la table `t_customers_contracts_install_status`  
--
CREATE TABLE IF NOT EXISTS `t_customers_contracts_install_status` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
             `name` varchar(64)  NOT NULL,
             `color` varchar(16)  NOT NULL,
             `icon` varchar(64)  NOT NULL,           
     PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_contracts_status_install_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_customers_contracts_install_status_i18n` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `status_id` int(11) unsigned NOT NULL,
        `lang` varchar(2)  NOT NULL,             
        `value` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)   ,  
     UNIQUE KEY `unique` (`status_id`,`lang`)   
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `t_customers_contracts_install_status_i18n` ADD CONSTRAINT `customers_contract_install_status` FOREIGN KEY (`status_id`) REFERENCES `t_customers_contracts_install_status` (`id`) ON DELETE CASCADE;
