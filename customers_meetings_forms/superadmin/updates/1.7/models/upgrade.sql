ALTER TABLE `t_customers_meeting_forms` ADD `contract_id` INT(11) unsigned NULL AFTER `meeting_id`;

ALTER TABLE `t_customers_meeting_forms` ADD CONSTRAINT `customers_contract_form_00` FOREIGN KEY (`contract_id`) REFERENCES `t_customers_contract` (`id`) ON DELETE CASCADE;

UPDATE t_customers_meeting_forms
INNER JOIN t_customers_contract ON t_customers_contract.meeting_id=t_customers_meeting_forms.meeting_id
SET t_customers_meeting_forms.contract_id = t_customers_contract.id;