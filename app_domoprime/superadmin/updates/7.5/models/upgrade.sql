ALTER TABLE `t_domoprime_product_calculation` ADD `work_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER  `product_id`;
ALTER TABLE `t_domoprime_product_calculation` ADD INDEX `calculation_work` (`work_id`); 


ALTER TABLE `t_domoprime_asset` ADD `work_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `creator_id`;
ALTER TABLE `t_domoprime_asset` ADD INDEX `work` (`work_id`); 