ALTER TABLE `t_domoprime_asset` CHANGE `meeting_id` `meeting_id` INT(11) UNSIGNED NULL DEFAULT NULL; 
ALTER TABLE `t_domoprime_asset` CHANGE `contract_id` `contract_id` INT(11) UNSIGNED NULL DEFAULT NULL; 

ALTER TABLE `t_domoprime_asset` ADD `total_tax` DECIMAL(20,6) NOT NULL AFTER `total_asset_with_tax`;                

UPDATE `t_domoprime_asset` SET meeting_id = NULL WHERE meeting_id=0;
UPDATE `t_domoprime_asset` SET contract_id = NULL WHERE contract_id=0;