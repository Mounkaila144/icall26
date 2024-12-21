ALTER TABLE `t_domoprime_quotation` ADD `tax_credit` decimal(20,6) NULL DEFAULT NULL AFTER `total_purchase_with_tax`;
ALTER TABLE `t_domoprime_quotation` ADD `one_euro` enum('NO','YES') COLLATE utf8_bin NOT NULL DEFAULT 'YES' AFTER `tax_credit`;
