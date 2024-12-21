--
-- Structure de la table `t_domoprime_customers_meetings_forms_documents_class`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_customers_meetings_forms_documents_class` (   
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,     
    `class_id` int(11) unsigned NULL DEFAULT NULL,         
    `form_document_id` int(11) unsigned NOT NULL,         
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL ,   
     PRIMARY KEY (`id`)    
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `t_domoprime_customers_meetings_forms_documents_class` ADD CONSTRAINT `domoprime_customers_meetings_forms_documents_class_0` FOREIGN KEY (`class_id`) REFERENCES `t_domoprime_class` (`id`) ON DELETE CASCADE;

DELETE FROM `t_domoprime_customers_meetings_forms_documents_formfield_class`;

DROP TABLE IF EXISTS `t_domoprime_customers_meetings_forms_documents_formfield_class`;