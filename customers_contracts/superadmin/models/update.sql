
-- DONE ---
--ALTER TABLE `t_customers_contract` CHANGE `opened_at` `opened_at` DATE NULL DEFAULT NULL; 
--ALTER TABLE `t_customers_contract` CHANGE `payment_at` `payment_at` DATE NULL DEFAULT NULL;
--ALTER TABLE `t_customers_contract` ADD `opc_at` DATE NULL AFTER `payment_at`  


ALTER TABLE `t_customers_contract` ADD `team_id` INT UNSIGNED NOT NULL AFTER `tax_id`;
ALTER TABLE `t_customers_contract` ADD `telepro_id` INT UNSIGNED NOT NULL AFTER `team_id`; 
ALTER TABLE `t_customers_contract` ADD `sale_1_id` INT UNSIGNED NOT NULL AFTER `telepro_id`; 
ALTER TABLE `t_customers_contract` ADD `sale_2_id` INT UNSIGNED NOT NULL AFTER `sale_1_id`; 
ALTER TABLE `t_customers_contract` ADD `manager_id` INT UNSIGNED NOT NULL AFTER `sale_2_id`; 

ALTER TABLE `t_customers_contracts_contributor` ADD `type` VARCHAR( 24 ) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL AFTER `id` 