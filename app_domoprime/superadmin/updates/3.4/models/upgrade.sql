--
-- Structure de la table `t_partner_polluter_billing`  
--
CREATE TABLE IF NOT EXISTS `t_partner_polluter_billing` (   
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,      
    `polluter_id` int(11) unsigned NULL DEFAULT NULL,    
    `model_id` int(11) unsigned NULL DEFAULT NULL,        
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `t_partner_polluter_billing` ADD CONSTRAINT `partners_polluter_billing_fk0` FOREIGN KEY (`model_id`) REFERENCES `t_domoprime_billing_model` (`id`) ON DELETE CASCADE;