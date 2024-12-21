ALTER TABLE `t_customers_contract` ADD `campaign_id` int(11) unsigned  NULL AFTER `company_id`;
ALTER TABLE `t_customers_contract` ADD CONSTRAINT `customers_contract_fk27` FOREIGN KEY (`campaign_id`) REFERENCES `t_customers_meeting_campaign` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;
