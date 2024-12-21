ALTER TABLE `t_domoprime_class` ADD `color` VARCHAR(10)  NULL DEFAULT NULL AFTER `name`;

ALTER TABLE `t_domoprime_calculation` CHANGE `is_quotation_valid` `is_quotations_valid` ENUM('NO','YES') CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL; 
ALTER TABLE `t_domoprime_calculation` ADD `number_of_quotations` INT(8) unsigned DEFAULT 0 AFTER `purchasing_price`; 

ALTER TABLE `t_domoprime_class` ADD  `subvention` decimal(20,3) NULL DEFAULT NULL AFTER `multiple_wall`;
ALTER TABLE `t_domoprime_class` ADD  `bbc_subvention` decimal(20,3) NULL DEFAULT NULL AFTER `subvention`;


ALTER TABLE `t_domoprime_calculation` ADD `engine_id` int(11) unsigned  NULL DEFAULT NULL AFTER `is_quotations_valid`;  
ALTER TABLE `t_domoprime_calculation` ADD `pricing_id` int(11) unsigned  NULL DEFAULT NULL AFTER `engine_id`;    
ALTER TABLE `t_domoprime_calculation` ADD `cef_cef_project` decimal(20,6) NOT NULL DEFAULT '0.000000' AFTER `pricing_id`; 