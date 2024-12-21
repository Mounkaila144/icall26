ALTER TABLE `t_domoprime_polluter_property` ADD `ana_classic` DECIMAL(10,2) NULL DEFAULT NULL AFTER `prime`;
ALTER TABLE `t_domoprime_polluter_property` ADD `ana_modest` DECIMAL(10,2) NULL DEFAULT NULL AFTER `ana_classic`;
ALTER TABLE `t_domoprime_polluter_property` ADD `ana_very_modest` DECIMAL(10,2) NULL DEFAULT NULL AFTER `ana_modest`;
