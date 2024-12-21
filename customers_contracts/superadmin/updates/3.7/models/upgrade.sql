ALTER TABLE `t_customers_contract_product` ADD `started_at` DATETIME NULL DEFAULT NULL AFTER `is_one_shoot`;
ALTER TABLE `t_customers_contract_product` ADD `ended_at` DATETIME NULL DEFAULT NULL AFTER `started_at`;
ALTER TABLE `t_customers_contract_product` ADD `is_prorata` ENUM('NO','YES') NOT NULL DEFAULT 'NO' AFTER `ended_at`;
