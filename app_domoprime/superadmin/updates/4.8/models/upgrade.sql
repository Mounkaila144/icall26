ALTER TABLE `t_domoprime_polluter_class` ADD `prime` DECIMAL(20,9) NULL DEFAULT NULL AFTER `multiple_wall` ;
ALTER TABLE `t_domoprime_polluter_class` ADD `pack_prime` DECIMAL(20,9) NULL DEFAULT NULL AFTER `prime` ;

ALTER TABLE `t_domoprime_class` ADD `prime` DECIMAL(20,9) NULL DEFAULT NULL AFTER `multiple` ;
ALTER TABLE `t_domoprime_class` ADD `pack_prime` DECIMAL(20,9) NULL DEFAULT NULL AFTER `prime` ;

ALTER TABLE `t_domoprime_quotation` ADD `pack_prime` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `prime`;
ALTER TABLE `t_domoprime_quotation` ADD `ana_prime` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `pack_prime`;
ALTER TABLE `t_domoprime_quotation` ADD `ana_pack_prime` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `ana_prime`;

ALTER TABLE `t_domoprime_billing` ADD `pack_prime` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `prime`;
ALTER TABLE `t_domoprime_billing` ADD `ana_prime` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `pack_prime`;
ALTER TABLE `t_domoprime_billing` ADD `ana_pack_prime` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `ana_prime`;
