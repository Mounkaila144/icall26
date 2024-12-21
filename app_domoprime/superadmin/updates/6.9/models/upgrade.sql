ALTER TABLE `t_domoprime_polluter_class`  ADD `max_limit` DECIMAL(20,6) NULL DEFAULT NULL AFTER `ite_coef`; 
ALTER TABLE `t_domoprime_polluter_property` ADD `home_prime` DECIMAL(20,6) NULL DEFAULT NULL AFTER `pack_prime`; 
ALTER TABLE `t_domoprime_quotation` ADD `discount_amount` DECIMAL(20,6) NULL DEFAULT NULL AFTER `qmac_value`; 
ALTER TABLE `t_domoprime_quotation` ADD `home_prime` DECIMAL(20,6) NULL DEFAULT NULL AFTER `discount_amount`; 
ALTER TABLE `t_domoprime_billing` ADD `discount_amount` DECIMAL(20,6) NULL DEFAULT NULL AFTER `qmac_value`; 
ALTER TABLE `t_domoprime_billing` ADD `home_prime` DECIMAL(20,6) NULL DEFAULT NULL AFTER `discount_amount`; 