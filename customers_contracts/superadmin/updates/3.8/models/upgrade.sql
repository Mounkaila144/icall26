ALTER TABLE `t_customers_contract` ADD `callcenter_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `polluter_id`;
ALTER TABLE `t_customers_contracts_contributor` ADD `payment_at` DATETIME NULL DEFAULT NULL AFTER `type`;
ALTER TABLE `t_customers_contracts_contributor` ADD `team_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `user_id`;
ALTER TABLE `t_customers_contracts_contributor` CHANGE `contract_id` `contract_id` INT(11) UNSIGNED NULL;

ALTER TABLE `t_customers_contracts_contributor` ADD CONSTRAINT `customers_contract_contributor_fk0` FOREIGN KEY (`team_id`) REFERENCES `t_users_team` (`id`) ON DELETE CASCADE;
