ALTER TABLE `t_customers_contract` ADD `is_billable` ENUM('NO','YES') NOT NULL DEFAULT 'YES' AFTER `is_hold`;
ALTER TABLE `t_customers_contract_product` ADD `is_one_shoot` ENUM('NO','YES') NOT NULL DEFAULT 'NO' AFTER `details`;
