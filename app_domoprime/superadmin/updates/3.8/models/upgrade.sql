ALTER TABLE `t_domoprime_quotation` ADD `fee_file` DECIMAL(20,6) NOT NULL AFTER `prime`;
ALTER TABLE `t_domoprime_billing` ADD `fee_file` DECIMAL(20,6) NOT NULL AFTER `prime`;
