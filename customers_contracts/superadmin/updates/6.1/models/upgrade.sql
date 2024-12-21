ALTER TABLE  `t_customers_contract` ADD INDEX `customers_contract_team` (`team_id`); 

-- state_id
ALTER TABLE `t_customers_contract` CHANGE `state_id` `state_id` INT(11) UNSIGNED NULL DEFAULT NULL;
UPDATE `t_customers_contract` SET state_id = NULL WHERE state_id=0 ;

UPDATE t_customers_contract 
INNER JOIN (
SELECT  t_customers_contract.state_id
FROM  t_customers_contract 
LEFT JOIN t_customers_contracts_status ON t_customers_contracts_status.id=t_customers_contract.state_id
WHERE t_customers_contracts_status.id IS NULL AND t_customers_contract.state_id IS NOT NULL
GROUP BY  t_customers_contract.state_id) as tmp ON tmp.state_id=t_customers_contract.state_id
SET t_customers_contract.state_id=NULL;

ALTER TABLE `t_customers_contract` ADD CONSTRAINT `customers_contract_fk19` FOREIGN KEY (`state_id`) REFERENCES `t_customers_contracts_status` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;


-- install_state_id
UPDATE `t_customers_contract` SET install_state_id = NULL WHERE install_state_id=0 ;

UPDATE t_customers_contract 
INNER JOIN (
SELECT  t_customers_contract.install_state_id
FROM  t_customers_contract 
LEFT JOIN t_customers_contracts_install_status ON t_customers_contracts_install_status.id=t_customers_contract.install_state_id
WHERE t_customers_contracts_install_status.id IS NULL AND t_customers_contract.install_state_id IS NOT NULL
GROUP BY  t_customers_contract.install_state_id) as tmp ON tmp.install_state_id=t_customers_contract.install_state_id
SET t_customers_contract.install_state_id=NULL;

ALTER TABLE `t_customers_contract` ADD CONSTRAINT `customers_contract_fk21` FOREIGN KEY (`install_state_id`) REFERENCES `t_customers_contracts_install_status` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

-- time_state_id
UPDATE `t_customers_contract` SET time_state_id = NULL WHERE time_state_id=0 ;

UPDATE t_customers_contract 
INNER JOIN (
SELECT  t_customers_contract.time_state_id
FROM  t_customers_contract 
LEFT JOIN t_customers_contracts_time_status ON t_customers_contracts_time_status.id=t_customers_contract.time_state_id
WHERE t_customers_contracts_time_status.id IS NULL AND t_customers_contract.time_state_id IS NOT NULL
GROUP BY  t_customers_contract.time_state_id) as tmp ON tmp.time_state_id=t_customers_contract.time_state_id
SET t_customers_contract.time_state_id=NULL;

ALTER TABLE `t_customers_contract` ADD CONSTRAINT `customers_contract_fk22` FOREIGN KEY (`time_state_id`) REFERENCES `t_customers_contracts_time_status` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT; 

-- opc_range_id
ALTER TABLE `t_customers_contract` CHANGE `opc_range_id` `opc_range_id` INT(11) UNSIGNED NULL DEFAULT NULL;
UPDATE `t_customers_contract` SET opc_range_id = NULL WHERE opc_range_id = 0;

UPDATE t_customers_contract 
INNER JOIN (
SELECT  t_customers_contract.opc_range_id
FROM  t_customers_contract 
LEFT JOIN t_customers_contracts_date_range ON t_customers_contracts_date_range.id=t_customers_contract.opc_range_id
WHERE t_customers_contracts_date_range.id IS NULL AND t_customers_contract.opc_range_id IS NOT NULL
GROUP BY t_customers_contract.opc_range_id) as tmp ON tmp.opc_range_id=t_customers_contract.opc_range_id
SET t_customers_contract.opc_range_id=NULL;

ALTER TABLE `t_customers_contract` ADD CONSTRAINT `customers_contract_fk23` FOREIGN KEY (`opc_range_id`) REFERENCES `t_customers_contracts_date_range` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT; 

-- partner_layer_id

UPDATE `t_customers_contract` SET partner_layer_id = NULL WHERE partner_layer_id = 0;

UPDATE t_customers_contract 
INNER JOIN (
SELECT  t_customers_contract.partner_layer_id
FROM  t_customers_contract 
LEFT JOIN t_partner_layer_company ON t_partner_layer_company.id=t_customers_contract.partner_layer_id
WHERE t_partner_layer_company.id IS NULL AND t_customers_contract.partner_layer_id IS NOT NULL
GROUP BY  t_customers_contract.partner_layer_id) as tmp ON tmp.partner_layer_id=t_customers_contract.partner_layer_id
SET t_customers_contract.partner_layer_id=NULL;

ALTER TABLE `t_customers_contract` ADD CONSTRAINT `customers_contract_fk24` FOREIGN KEY (`partner_layer_id`) REFERENCES `t_partner_layer_company` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT; 


-- admin_status_id
UPDATE `t_customers_contract` SET admin_status_id = NULL WHERE admin_status_id = 0;

UPDATE t_customers_contract 
INNER JOIN (
SELECT  t_customers_contract.admin_status_id
FROM  t_customers_contract 
LEFT JOIN t_customers_contracts_admin_status ON t_customers_contracts_admin_status.id=t_customers_contract.admin_status_id
WHERE t_customers_contracts_admin_status.id IS NULL AND t_customers_contract.admin_status_id IS NOT NULL
GROUP BY t_customers_contract.admin_status_id) as tmp ON tmp.admin_status_id=t_customers_contract.admin_status_id
SET t_customers_contract.admin_status_id=NULL;

ALTER TABLE `t_customers_contract` ADD CONSTRAINT `customers_contract_fk25` FOREIGN KEY (`admin_status_id`) REFERENCES `t_customers_contracts_admin_status` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

-- created_by_id
ALTER TABLE `t_customers_contract` CHANGE `created_by_id` `created_by_id` INT(11)  NULL DEFAULT NULL;

UPDATE t_customers_contract 
INNER JOIN (
SELECT  t_customers_contract.created_by_id
FROM  t_customers_contract 
LEFT JOIN t_users ON t_users.id=t_customers_contract.created_by_id
WHERE t_users.id IS NULL AND t_customers_contract.created_by_id IS NOT NULL
GROUP BY  t_customers_contract.created_by_id) as tmp ON tmp.created_by_id=t_customers_contract.created_by_id
SET t_customers_contract.created_by_id=NULL;

ALTER TABLE `t_customers_contract` ADD CONSTRAINT `customers_contract_fk26` FOREIGN KEY (`created_by_id`) REFERENCES `t_users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;


 