ALTER TABLE `t_domoprime_quotation` ADD `work_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER  `creator_id`;
ALTER TABLE `t_domoprime_billing` ADD `work_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `creator_id`;


ALTER TABLE `t_domoprime_quotation` ADD INDEX `work` (`work_id`); 
ALTER TABLE `t_domoprime_billing` ADD INDEX `work` (`work_id`); 


