-- polluter
ALTER TABLE `t_customers_contract` CHANGE `polluter_id` `polluter_id` INT(11) UNSIGNED NULL DEFAULT NULL;
UPDATE `t_customers_contract` SET polluter_id = NULL WHERE polluter_id=0 ;

UPDATE t_customers_contract 
INNER JOIN (
SELECT  t_customers_contract.polluter_id
FROM  t_customers_contract 
LEFT JOIN t_partner_polluter_company ON t_partner_polluter_company.id=t_customers_contract.polluter_id
WHERE t_partner_polluter_company.id IS NULL AND t_customers_contract.polluter_id IS NOT NULL
GROUP BY  t_customers_contract.polluter_id) as tmp ON tmp.polluter_id=t_customers_contract.polluter_id
SET t_customers_contract.polluter_id=NULL;

ALTER TABLE `t_customers_contract` ADD CONSTRAINT `customers_contract_fk20` FOREIGN KEY (`polluter_id`) REFERENCES `t_partner_polluter_company` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT; 
