ALTER TABLE `t_customers_contract_product` ADD `is_consumed` ENUM('NO','YES') NOT NULL DEFAULT 'NO' AFTER `is_one_shoot`;
