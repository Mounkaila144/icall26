CREATE TABLE IF NOT EXISTS `t_domoprime_polluter_property` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `polluter_id` int(11) unsigned NOT NULL,
        `prime` DECIMAL(20,6) NOT NULL,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NULL DEFAULT NULL, 
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;


ALTER TABLE `t_domoprime_polluter_property` ADD CONSTRAINT `domoprime_polluter_property_fk0` FOREIGN KEY (`polluter_id`) REFERENCES `t_partner_polluter_company` (`id`) ON DELETE CASCADE;
