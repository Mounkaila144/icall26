ALTER TABLE `t_domoprime_quotation` ADD `passoire_subvention` decimal(20,6) NOT NULL DEFAULT 0.0 AFTER `bbc_subvention`;             
ALTER TABLE `t_domoprime_billing` ADD `passoire_subvention` decimal(20,6) NOT NULL DEFAULT 0.0 AFTER `bbc_subvention`;    