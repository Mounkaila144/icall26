ALTER TABLE `t_customers_contract` ADD `partner_layer_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `financial_partner_id`;

ALTER TABLE `t_customers_contract`  ADD KEY `customers_contract_partner_layer_00` (`partner_layer_id`);