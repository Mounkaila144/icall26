--
-- Structure de la table `t_partner_polluter_document`  
--
CREATE TABLE IF NOT EXISTS `t_partner_polluter_document` (   
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,      
    `polluter_id` int(11) unsigned NULL DEFAULT NULL,    
    `model_id` int(11) unsigned NULL DEFAULT NULL,    
    `document_id` int(11) unsigned NULL DEFAULT NULL,    
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `t_partner_polluter_document` ADD CONSTRAINT `partners_polluter_document_fk0` FOREIGN KEY (`model_id`) REFERENCES `t_partner_polluter_model` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_partner_polluter_document` ADD CONSTRAINT `partners_polluter_document_fk1` FOREIGN KEY (`document_id`) REFERENCES `t_customers_meetings_forms_documents` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_partner_polluter_document` ADD CONSTRAINT `partners_polluter_document_fk2` FOREIGN KEY (`polluter_id`) REFERENCES `t_partner_polluter_company` (`id`) ON DELETE CASCADE;
