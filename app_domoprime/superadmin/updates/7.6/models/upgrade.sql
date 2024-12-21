ALTER TABLE `t_domoprime_quotation_product` ADD `work_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER  `meeting_id`;

ALTER TABLE `t_domoprime_quotation_product` ADD INDEX `domoprime_quotation_product_work` (`work_id`); 