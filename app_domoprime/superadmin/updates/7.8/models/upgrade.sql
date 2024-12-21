ALTER TABLE `t_domoprime_quotation` ADD `subvention`  decimal(20,6) NOT NULL DEFAULT 0.0 AFTER `subvention_type_id`;       
ALTER TABLE `t_domoprime_quotation` ADD `bbc_subvention` decimal(20,6) NOT NULL DEFAULT 0.0 AFTER `subvention`;       

ALTER TABLE `t_domoprime_billing` ADD `subvention`  decimal(20,6) NOT NULL DEFAULT 0.0 AFTER `subvention_type_id`;       
ALTER TABLE `t_domoprime_billing` ADD `bbc_subvention` decimal(20,6) NOT NULL DEFAULT 0.0 AFTER `subvention`;    
