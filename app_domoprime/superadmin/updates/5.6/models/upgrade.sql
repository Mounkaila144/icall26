ALTER TABLE `t_domoprime_polluter_class` ADD `ite_coef` DECIMAL(20,9) NULL DEFAULT NULL AFTER `ite_prime` ;
ALTER TABLE `t_domoprime_polluter_class` ADD `pack_coef` DECIMAL(20,9) NULL DEFAULT NULL AFTER `pack_prime` ;
ALTER TABLE `t_domoprime_polluter_class` ADD `boiler_coef` DECIMAL(20,9) NULL DEFAULT NULL AFTER `pack_coef` ;