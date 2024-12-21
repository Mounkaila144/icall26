ALTER TABLE `t_domoprime_calculation` ADD `causes` VARCHAR(128) NULL DEFAULT NULL AFTER `purchasing_price`;
ALTER TABLE `t_domoprime_quotation` ADD `creator_id` int(11) unsigned NOT NULL AFTER `customer_id`;     
ALTER TABLE `t_domoprime_quotation` ADD `dated_at`  timestamp  NULL DEFAULT NULL AFTER `year`;    