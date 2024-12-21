ALTER TABLE `t_domoprime_quotation` ADD `fixed_prime` DECIMAL(20,6) NOT NULL AFTER `prime`;
ALTER TABLE `t_domoprime_billing` ADD `fixed_prime` DECIMAL(20,6) NOT NULL AFTER `prime`;
