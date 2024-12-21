ALTER TABLE `t_domoprime_billing` ADD `tax_credit_available` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`;  
ALTER TABLE `t_domoprime_quotation` ADD `tax_credit_available` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`; 
ALTER TABLE `t_domoprime_billing` ADD `one_euro` enum('NO','YES') COLLATE utf8_bin NOT NULL DEFAULT 'YES' AFTER `tax_credit`;