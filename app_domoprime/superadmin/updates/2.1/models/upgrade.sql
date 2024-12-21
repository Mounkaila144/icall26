ALTER TABLE `t_domoprime_calculation` ADD `contract_id` INT(11) unsigned NULL AFTER `meeting_id`;
ALTER TABLE `t_domoprime_calculation` ADD `customer_id` INT(11) unsigned NULL AFTER `contract_id`;

ALTER TABLE `t_domoprime_calculation` CHANGE `meeting_id` `meeting_id` INT(11) UNSIGNED NULL;

ALTER TABLE `t_domoprime_calculation` ADD CONSTRAINT `domoprime_calculation_01` FOREIGN KEY (`contract_id`) REFERENCES `t_customers_contract` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_domoprime_calculation` ADD CONSTRAINT `domoprime_calculation_02` FOREIGN KEY (`customer_id`) REFERENCES `t_customers` (`id`) ON DELETE CASCADE;


UPDATE t_domoprime_calculation
INNER JOIN t_customers_contract ON t_customers_contract.meeting_id=t_domoprime_calculation.meeting_id
SET t_domoprime_calculation.contract_id = t_customers_contract.id;


UPDATE t_domoprime_calculation
INNER JOIN t_customers_meeting ON t_customers_meeting.id=t_domoprime_calculation.meeting_id
SET t_domoprime_calculation.customer_id = t_customers_meeting.customer_id;