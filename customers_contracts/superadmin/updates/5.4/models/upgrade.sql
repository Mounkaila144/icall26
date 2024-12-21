CREATE TABLE IF NOT EXISTS `t_customers_contracts_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `commercial` varchar(50) COLLATE utf8_bin NOT NULL,
  `ape` varchar(11) COLLATE utf8_bin NOT NULL,
  `siret` varchar(14) COLLATE utf8_bin NOT NULL,
  `tva` varchar(13) COLLATE utf8_bin NOT NULL,
  `rcs` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `rge` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_bin NOT NULL,
  `header` varchar(255) COLLATE utf8_bin NOT NULL,
  `footer` varchar(255) COLLATE utf8_bin NOT NULL,
  `capital` varchar(64) COLLATE utf8_bin NOT NULL,
  `comments` text COLLATE utf8_bin NOT NULL,
  `signature` varchar(64) COLLATE utf8_bin NOT NULL,
  `stamp` varchar(64) COLLATE utf8_bin NOT NULL,
  `coordinates` varchar(64) COLLATE utf8_bin NOT NULL,
  `email` varchar(64) CHARACTER SET utf8 NOT NULL,
  `email_system` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `web` varchar(64) CHARACTER SET utf8 NOT NULL,
  `mobile` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `phone` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `fax` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `address1` varchar(128) COLLATE utf8_bin NOT NULL,
  `address2` varchar(128) COLLATE utf8_bin NOT NULL,
  `postcode` varchar(10) COLLATE utf8_bin NOT NULL,
  `city` varchar(50) COLLATE utf8_bin NOT NULL,
  `country` varchar(2) COLLATE utf8_bin NOT NULL,
  `gender` enum('Mr','Ms','Mrs') COLLATE utf8_bin DEFAULT 'Mr',
  `firstname` varchar(16) COLLATE utf8_bin DEFAULT NULL,
  `lastname` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `function` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `state` varchar(50) COLLATE utf8_bin NOT NULL, 
  `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


ALTER TABLE `t_customers_contract` ADD `company_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `opc_status_id`; 


ALTER TABLE `t_customers_contract` ADD INDEX `company_id` ( `company_id` );