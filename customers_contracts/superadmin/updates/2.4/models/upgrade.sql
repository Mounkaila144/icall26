ALTER TABLE `t_customers_contract` CHANGE `financial_partner_id` `financial_partner_id` INT(11) UNSIGNED NULL;
UPDATE `t_customers_contract` SET financial_partner_id = NULL WHERE financial_partner_id=0; 
ALTER TABLE `t_customers_contract` ADD KEY `customers_contract_partner_00` (`financial_partner_id`);
ALTER TABLE `t_customers_contracts_date_range` ADD `color` varchar(10)  NOT NULL AFTER `to`;