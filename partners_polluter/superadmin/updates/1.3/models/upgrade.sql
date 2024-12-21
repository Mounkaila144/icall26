--
-- Structure de la table `t_partner_polluter_model`  
--
CREATE TABLE IF NOT EXISTS `t_partner_polluter_model` (   
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,   
    `extension` varchar(4) COLLATE utf8_bin NOT NULL,       
    `name` varchar(255) COLLATE utf8_bin NOT NULL,   
    `polluter_id` int(11) unsigned NOT NULL,    
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',   
     PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `t_partner_polluter_model_i18n` ADD `variables` TEXT NOT NULL AFTER `value`;

ALTER TABLE `t_partner_polluter_model_i18n` ADD `signature` VARCHAR(255) NOT NULL AFTER `value`;

ALTER TABLE `t_partner_polluter_model_i18n` ADD `file` VARCHAR(255) NOT NULL AFTER `value`;

ALTER TABLE `t_partner_polluter_model_i18n` ADD  `model_id` int(11) unsigned NOT NULL AFTER `polluter_id`;

ALTER TABLE `t_partner_polluter_model_i18n` DROP INDEX `unique`, ADD UNIQUE `unique` (`lang`, `model_id`) USING BTREE;

ALTER TABLE t_partner_polluter_model_i18n DROP FOREIGN KEY `partners_polluter_model_0`;

ALTER TABLE `t_partner_polluter_model_i18n` DROP `polluter_id`;   

ALTER TABLE `t_partner_polluter_model_i18n` ADD CONSTRAINT `t_partner_polluter_model_i18n_0` FOREIGN KEY (`model_id`) REFERENCES `t_partner_polluter_model` (`id`) ON DELETE CASCADE;

ALTER TABLE `t_partner_polluter_model` ADD CONSTRAINT `partners_polluter_model_0` FOREIGN KEY (`polluter_id`) REFERENCES `t_partner_polluter_company` (`id`) ON DELETE CASCADE;