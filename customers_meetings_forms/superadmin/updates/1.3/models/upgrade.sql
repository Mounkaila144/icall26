ALTER TABLE `t_customers_meeting_formfield` ADD `is_visible` ENUM('NO','YES') NOT NULL DEFAULT 'YES' AFTER `widget`;
ALTER TABLE `t_customers_meeting_formfield` ADD `is_exportable` ENUM('NO','YES') NOT NULL DEFAULT 'YES' AFTER `is_visible`;
ALTER TABLE `t_customers_meeting_formfield` ADD `default` VARCHAR(64) NOT NULL DEFAULT '' AFTER `is_exportable`;