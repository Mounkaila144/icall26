ALTER TABLE `t_customers_meeting` ADD `registration` VARCHAR(255) NOT NULL AFTER `id`;
ALTER TABLE `t_customers_meeting` ADD `turnover` decimal(20,6) DEFAULT '0.000000' NOT NULL AFTER `sale_comments`;