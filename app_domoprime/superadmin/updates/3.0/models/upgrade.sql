ALTER TABLE `t_domoprime_billing` ADD `rest_in_charge_after_credit` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`;  
ALTER TABLE `t_domoprime_quotation` ADD `rest_in_charge_after_credit` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`; 
ALTER TABLE `t_domoprime_billing` ADD `tax_credit_limit` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`;  
ALTER TABLE `t_domoprime_quotation` ADD `tax_credit_limit` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`; 