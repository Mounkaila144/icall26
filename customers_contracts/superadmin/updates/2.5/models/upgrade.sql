ALTER TABLE `t_customers_contract` CHANGE `meeting_id` `meeting_id` INT(11) UNSIGNED NULL;
UPDATE `t_customers_contract` SET meeting_id=NULL WHERE meeting_id=0;
ALTER TABLE `t_customers_contract` ADD CONSTRAINT `customers_contract_meeting_00` FOREIGN KEY (`meeting_id`) REFERENCES `t_customers_meeting` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;