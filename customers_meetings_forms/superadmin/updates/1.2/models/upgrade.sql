ALTER TABLE `t_customers_meeting_forms` ADD `is_processed` ENUM('NO','YES') NOT NULL DEFAULT 'NO' AFTER `data`;
