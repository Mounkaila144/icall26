--
-- Structure de la table `t_domoprime_polluter_recipient`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_polluter_recipient` (   
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,     
    `polluter_id` int(11) unsigned NOT NULL,         
    `recipient_id` int(11) unsigned NULL DEFAULT NULL,         
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL ,   
     PRIMARY KEY (`id`)    
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `t_domoprime_polluter_recipient` ADD CONSTRAINT `domoprime_polluter_recipient_0` FOREIGN KEY (`polluter_id`) REFERENCES `t_partner_polluter_company` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_domoprime_polluter_recipient` ADD CONSTRAINT `domoprime_polluter_recipient_1` FOREIGN KEY (`recipient_id`) REFERENCES `t_partner_recipient_company` (`id`) ON DELETE CASCADE;
 