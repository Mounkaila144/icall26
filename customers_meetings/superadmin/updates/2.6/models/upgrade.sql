ALTER TABLE `t_customers_meeting` ADD `creation_at` DATETIME NOT NULL AFTER `created_at`;
UPDATE `t_customers_meeting` SET `creation_at`=`created_at`;