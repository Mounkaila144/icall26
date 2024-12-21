DELETE `t_domoprime_quotation`  FROM `t_domoprime_quotation` 
LEFT JOIN `t_customers_meeting` ON t_customers_meeting.id=t_domoprime_quotation.meeting_id 
WHERE t_customers_meeting.id IS NULL;

ALTER TABLE `t_domoprime_quotation` CHANGE `meeting_id` `meeting_id` INT(11) UNSIGNED NULL;
ALTER TABLE `t_domoprime_quotation` ADD `contract_id` INT(11) UNSIGNED NULL AFTER `customer_id`; 

ALTER TABLE `t_domoprime_quotation` ADD CONSTRAINT `domoprime_quotation_00` FOREIGN KEY (`meeting_id`) REFERENCES `t_customers_meeting` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_domoprime_quotation` ADD CONSTRAINT `domoprime_quotation_01` FOREIGN KEY (`contract_id`) REFERENCES `t_customers_contract` (`id`) ON DELETE CASCADE;
--ALTER TABLE `t_domoprime_quotation` ADD CONSTRAINT `domoprime_quotation_02` FOREIGN KEY (`customer_id`) REFERENCES `t_customers` (`id`) ON DELETE CASCADE;

UPDATE t_domoprime_quotation
INNER JOIN t_customers_meeting ON t_customers_meeting.id=t_domoprime_quotation.meeting_id
INNER JOIN t_customers_contract ON t_customers_contract.meeting_id=t_customers_meeting.id
SET t_domoprime_quotation.contract_id=t_customers_contract.id
WHERE t_domoprime_quotation.contract_id IS NULL;
