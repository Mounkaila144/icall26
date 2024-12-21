ALTER TABLE `t_domoprime_billing` ADD `company_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER  `contract_id`; 
ALTER TABLE `t_domoprime_quotation` ADD `company_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER  `contract_id`; 

ALTER TABLE `t_domoprime_billing` ADD INDEX `company_id` ( `company_id` );
ALTER TABLE `t_domoprime_quotation` ADD INDEX `company_id` ( `company_id` );
