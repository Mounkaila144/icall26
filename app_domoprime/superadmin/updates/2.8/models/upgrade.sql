ALTER TABLE `t_domoprime_billing` ADD `number_of_people` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`;  
ALTER TABLE `t_domoprime_billing` ADD `tax_credit_used` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`;  
ALTER TABLE `t_domoprime_billing` ADD `qmac_value` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`;  
ALTER TABLE `t_domoprime_quotation` ADD `qmac_value` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`;  
ALTER TABLE `t_domoprime_quotation` ADD `number_of_people` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`;  
ALTER TABLE `t_domoprime_quotation` ADD `tax_credit_used` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`; 