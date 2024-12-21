ALTER TABLE `t_domoprime_iso_simulation` ADD `rest_in_charge_after_credit` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`;  
ALTER TABLE `t_domoprime_iso_simulation` ADD `tax_credit_limit` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`;
ALTER TABLE `t_domoprime_iso_simulation` ADD `number_of_children` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`;  
ALTER TABLE `t_domoprime_iso_simulation` ADD `rest_in_charge` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`; 
ALTER TABLE `t_domoprime_iso_simulation` ADD `number_of_people` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`;  
ALTER TABLE `t_domoprime_iso_simulation` ADD `tax_credit_used` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`;  
ALTER TABLE `t_domoprime_iso_simulation` ADD `qmac_value` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`;  
ALTER TABLE `t_domoprime_iso_simulation` ADD `tax_credit` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`;  
ALTER TABLE `t_domoprime_iso_simulation` ADD `one_euro` enum('NO','YES') COLLATE utf8_bin NOT NULL DEFAULT 'YES' AFTER `tax_credit`;
ALTER TABLE `t_domoprime_iso_simulation` ADD `tax_credit_available` DECIMAL(20,6) NOT NULL DEFAULT 0.0 AFTER `prime`;  