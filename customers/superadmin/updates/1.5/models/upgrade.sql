CREATE TABLE IF NOT EXISTS `t_customers_sector` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,     
  `name` varchar(32) COLLATE utf8_bin DEFAULT NULL,  
  `is_active` enum('NO','YES') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL , 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `t_customers_sector_dept` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,     
  `name` varchar(32) COLLATE utf8_bin DEFAULT NULL,  
  `sector_id` int(11) unsigned NOT NULL,
  `is_active` enum('NO','YES') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL , 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;


ALTER TABLE `t_customers_sector_dept` ADD CONSTRAINT `customer_sector_dept` FOREIGN KEY (`sector_id`) REFERENCES `t_customers_sector` (`id`) ON DELETE CASCADE;
