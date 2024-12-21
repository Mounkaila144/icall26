ALTER TABLE `t_domoprime_quotation` DROP `prime`;
ALTER TABLE `t_domoprime_billing` DROP `prime`;
ALTER TABLE `t_domoprime_billing` DROP `is_last`;




ALTER TABLE t_customers_contract DROP INDEX customers_contract_opc_status_00;
ALTER TABLE t_customers_contract DROP FOREIGN KEY `customers_contract_opc_status_00`;