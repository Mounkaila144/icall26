ALTER TABLE `t_customers_meeting` ADD `company_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `sale2_id`; 

ALTER TABLE `t_customers_meeting` ADD INDEX `company_id` ( `company_id` );