ALTER TABLE `t_products_item` ADD `coefficient`  decimal(20,6) DEFAULT 1.0 AFTER `unit`;
ALTER TABLE `t_products_item` ADD `is_mandatory` enum('YES','NO')  NOT NULL DEFAULT 'NO' AFTER `is_active`;