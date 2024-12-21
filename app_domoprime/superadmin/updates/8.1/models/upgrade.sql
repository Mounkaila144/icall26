ALTER TABLE `t_domoprime_calculation` ADD `prime` decimal(10,3) NULL DEFAULT NULL AFTER `number_of_quotations`;
ALTER TABLE `t_domoprime_calculation` ADD `ana_prime` decimal(10,3) NULL DEFAULT NULL AFTER `prime`;
ALTER TABLE `t_domoprime_calculation` ADD `subvention` decimal(10,3) NULL DEFAULT NULL AFTER `ana_prime`;
ALTER TABLE `t_domoprime_calculation` ADD `bbc_subvention` decimal(10,3) NULL DEFAULT NULL AFTER `subvention`;