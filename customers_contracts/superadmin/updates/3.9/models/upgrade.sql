UPDATE t_customers_contract 
LEFT JOIN t_users_team ON t_users_team.id=t_customers_contract.team_id
SET t_customers_contract.team_id=0
WHERE t_users_team.id IS NULL AND t_customers_contract.team_id!=0;

-- clean up table
DELETE t_customers_contracts_contributor FROM t_customers_contracts_contributor
LEFT JOIN t_customers_contract ON t_customers_contracts_contributor.contract_id=t_customers_contract.id
WHERE t_customers_contract.id IS NULL;

ALTER TABLE `t_customers_contracts_contributor` ADD CONSTRAINT `customers_contract_contributor_fk1` FOREIGN KEY (`contract_id`) REFERENCES `t_customers_contract` (`id`) ON DELETE CASCADE;


ALTER TABLE `t_customers_contracts_contributor` CHANGE `user_id` `user_id` INT(11) NULL;

UPDATE t_customers_contracts_contributor SET user_id = NULL WHERE user_id = 0;

DELETE t_customers_contracts_contributor FROM t_customers_contracts_contributor
LEFT JOIN t_users ON t_users.id=t_customers_contracts_contributor.user_id
WHERE t_users.id IS NULL AND t_customers_contracts_contributor.user_id IS NOT NULL;

ALTER TABLE `t_customers_contracts_contributor` ADD CONSTRAINT `customers_contract_contributor_fk2` FOREIGN KEY (`user_id`) REFERENCES `t_users` (`id`) ON DELETE CASCADE;

