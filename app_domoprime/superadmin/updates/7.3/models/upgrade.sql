ALTER TABLE `t_domoprime_calculation` ADD `work_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER  `class_id`;

ALTER TABLE `t_domoprime_calculation` ADD INDEX `calculation_work` (`work_id`); 