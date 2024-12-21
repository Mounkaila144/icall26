--
-- Structure de la table `t_domoprime_polluter_class`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_polluter_class` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,  
         `polluter_id` INT(11) unsigned NOT NULL DEFAULT '0' ,
        `class_id` INT(11) unsigned NULL DEFAULT NULL ,
        `coef` decimal(20,6) NOT NULL DEFAULT '0.000000',     
        `multiple` decimal(20,6) NOT NULL DEFAULT '0.000000',            
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',       
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;

ALTER TABLE `t_domoprime_polluter_class` ADD CONSTRAINT `domoprime_polluter_class_0` FOREIGN KEY (`class_id`) REFERENCES `t_domoprime_class` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_domoprime_polluter_class` ADD CONSTRAINT `domoprime_polluter_class_1` FOREIGN KEY (`polluter_id`) REFERENCES `t_partner_polluter_company` (`id`) ON DELETE CASCADE;
