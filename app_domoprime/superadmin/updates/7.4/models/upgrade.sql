ALTER TABLE `t_domoprime_calculation` ADD `beta_surface` decimal(20,6) NOT NULL DEFAULT '0.000000' AFTER `purchasing_price`; 
ALTER TABLE `t_domoprime_calculation` ADD `economy` decimal(20,6) NOT NULL DEFAULT '0.000000' AFTER `beta_surface` ; 
ALTER TABLE `t_domoprime_calculation` ADD `cumac_coefficient` decimal(20,6) NOT NULL DEFAULT '0.000000' AFTER `economy`; 
ALTER TABLE `t_domoprime_calculation` ADD `min_cee` decimal(20,6) NOT NULL DEFAULT '0.000000' AFTER `cumac_coefficient`;
ALTER TABLE `t_domoprime_calculation` ADD `coef_sale_price` decimal(20,6) NOT NULL DEFAULT '0.000000' AFTER `min_cee`; 
ALTER TABLE `t_domoprime_calculation` ADD `quotation_coefficient` decimal(20,6) NOT NULL DEFAULT '0.000000' AFTER `coef_sale_price`; 
ALTER TABLE `t_domoprime_calculation` ADD `is_quotation_valid` enum('NO','YES') COLLATE utf8_bin NOT NULL DEFAULT 'NO' AFTER `quotation_coefficient`;  
   