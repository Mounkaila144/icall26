-- Table linked by foreign keys
DELETE FROM `t_customers_contracts_status`;
DROP TABLE IF EXISTS `t_customers_contracts_status_i18n`;
DELETE FROM  `t_customers_contracts_install_status`;
DROP TABLE IF EXISTS  `t_customers_contracts_install_status_i18n`;
DROP TABLE IF EXISTS `t_customers_contract_product`;

-- Tables without foreign key

DROP TABLE IF EXISTS `t_contracts_status`;
DROP TABLE IF EXISTS `t_customers_contract`;
DROP TABLE IF EXISTS `t_customers_contracts_history`;
DROP TABLE IF EXISTS `t_customers_contract_polluting_company`;
DROP TABLE IF EXISTS `t_customers_contract_polluting_contact`; 
DROP TABLE IF EXISTS  `t_customers_contracts_install_status`;
