ALTER TABLE `t_partner_polluter_model_i18n` ADD `variables` TEXT NOT NULL AFTER `value`;
ALTER TABLE `t_partner_polluter_model_i18n` ADD `signature` VARCHAR(255) NOT NULL AFTER `value`;
ALTER TABLE `t_partner_polluter_model_i18n` ADD `file` VARCHAR(255) NOT NULL AFTER `value`;

