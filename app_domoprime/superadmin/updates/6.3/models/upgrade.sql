ALTER TABLE `t_domoprime_quotation_product_item` ADD `is_master` enum('NO','YES') COLLATE utf8_bin NOT NULL DEFAULT 'NO' AFTER `is_mandatory`;