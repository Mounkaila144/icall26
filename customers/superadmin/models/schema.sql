--
-- Structure de la table `t_customers`
--

CREATE TABLE IF NOT EXISTS `t_customers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,   
  `gender` enum('Mr','Ms','Mrs') DEFAULT NULL,
  `firstname` varchar(16) COLLATE utf8_bin DEFAULT NULL,
  `lastname` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '', 
  `phone` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `mobile` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `phone1` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `birthday` date DEFAULT NULL,    
  `union_id` int(11) unsigned NOT NULL,
  `age`  varchar(40) COLLATE utf8_bin DEFAULT NULL, 
  `salary`  varchar(40) COLLATE utf8_bin DEFAULT NULL, 
  `occupation`  varchar(40) COLLATE utf8_bin DEFAULT NULL, 
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Structure de la table `t_customer_address`
--
CREATE TABLE IF NOT EXISTS `t_customers_address` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) unsigned NOT NULL,  
  `address1` varchar(128) COLLATE utf8_bin NOT NULL,
  `address2` varchar(128) COLLATE utf8_bin NOT NULL,
  `postcode` varchar(10) COLLATE utf8_bin NOT NULL,
  `city` varchar(50) COLLATE utf8_bin NOT NULL,
  `country` varchar(2) COLLATE utf8_bin NOT NULL,
  `state` varchar(50) COLLATE utf8_bin NOT NULL,
  `coordinates` varchar(64) COLLATE utf8_bin NOT NULL,
  `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Contrainst for table `t_customers_address`
--
ALTER TABLE `t_customers_address` ADD CONSTRAINT `address_user` FOREIGN KEY (`customer_id`) REFERENCES `t_customers` (`id`) ON DELETE CASCADE;

--
-- Structure de la table `t_address_contact`
--
CREATE TABLE IF NOT EXISTS `t_customers_contact` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT, 
  `customer_id` int(11) unsigned NOT NULL,  
  `gender` enum('Mr','Ms','Mrs') DEFAULT NULL,  
  `firstname` varchar(16) COLLATE utf8_bin DEFAULT NULL,
  `lastname` varchar(32) COLLATE utf8_bin DEFAULT NULL, 
  `email` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',  
  `phone` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `mobile` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',  
  `birthday` date DEFAULT NULL,    
  `age`  varchar(40) COLLATE utf8_bin DEFAULT NULL, 
  `salary`  varchar(40) COLLATE utf8_bin DEFAULT NULL, 
  `occupation`  varchar(40) COLLATE utf8_bin DEFAULT NULL, 
  `isFirst` enum('NO','YES') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;


ALTER TABLE `t_customers_contact` ADD CONSTRAINT `customer_contact` FOREIGN KEY (`customer_id`) REFERENCES `t_customers` (`id`) ON DELETE CASCADE;

-- ALTER TABLE `t_customers` ADD `isFirst` ENUM( 'NO', 'YES' ) NOT NULL DEFAULT 'NO' AFTER `occupation` 

--
-- Structure de la table `t_customers_house`
--
CREATE TABLE IF NOT EXISTS `t_customers_house` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT, 
  `customer_id` int(11) unsigned NOT NULL,  
  `address_id` int(11) unsigned NOT NULL,    
  `windows` varchar(16) COLLATE utf8_bin DEFAULT NULL,
  `orientation` varchar(32) COLLATE utf8_bin DEFAULT NULL, 
  `removal` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `area` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',      
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;


ALTER TABLE `t_customers_house` ADD CONSTRAINT `house_customer` FOREIGN KEY (`customer_id`) REFERENCES `t_customers` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_customers_house` ADD CONSTRAINT `house_address` FOREIGN KEY (`address_id`) REFERENCES `t_customers_address` (`id`) ON DELETE CASCADE;

--
-- Structure de la table `t_customers_financial`
--
CREATE TABLE IF NOT EXISTS `t_customers_financial` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT, 
  `customer_id` int(11) unsigned NOT NULL,  
  `credit_used` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `credit_date` varchar(10) COLLATE utf8_bin DEFAULT NULL, 
  `inprogress_credit` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `credit_amount` varchar(20) COLLATE utf8_bin DEFAULT NULL, 
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

ALTER TABLE `t_customers_financial` ADD CONSTRAINT `customer_financial` FOREIGN KEY (`customer_id`) REFERENCES `t_customers` (`id`) ON DELETE CASCADE;

--
-- Structure de la table `t_customers_union`  
--
CREATE TABLE IF NOT EXISTS `t_customers_union` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
        `name` varchar(64)  NOT NULL,                   
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

--
-- Structure de la table `t_customers_union_i18n`  
--
CREATE TABLE IF NOT EXISTS `t_customers_union_i18n` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `union_id` int(11) unsigned NOT NULL,
        `lang` varchar(2)  NOT NULL,             
        `value` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,  
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`)   ,  
     UNIQUE KEY `unique` (`union_id`,`lang`)   
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_customers_union_i18n` ADD CONSTRAINT `customers_union` FOREIGN KEY (`union_id`) REFERENCES `t_customers_union` (`id`) ON DELETE CASCADE;

