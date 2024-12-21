ALTER TABLE `t_customers_contract` ADD `dates_is_opened` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO' AFTER `opc_at`;
ALTER TABLE `t_customers_contract` ADD `dates_opened_at_by` INT(11) unsigned NULL DEFAULT NULL AFTER `dates_is_opened`;
ALTER TABLE `t_customers_contract` ADD `dates_opened_at` DATETIME NULL DEFAULT NULL AFTER `dates_opened_at_by`;