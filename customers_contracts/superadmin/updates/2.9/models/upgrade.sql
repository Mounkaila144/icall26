ALTER TABLE t_customers_contract DROP FOREIGN KEY `customers_contract_opc_status_00`;

ALTER TABLE `t_customers_contract` ADD KEY `customers_contract_opc_status_01` (`opc_status_id`);