ALTER TABLE `t_products` ADD `is_monthly` ENUM('NO','YES') NOT NULL DEFAULT 'NO' AFTER `action_id`;
ALTER TABLE `t_products` ADD `is_billable` ENUM('NO','YES') NOT NULL DEFAULT 'YES' AFTER `is_monthly`;
