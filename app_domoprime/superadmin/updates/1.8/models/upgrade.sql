DELETE `t_domoprime_calculation`  FROM `t_domoprime_calculation` 
LEFT JOIN `t_customers_meeting` ON t_customers_meeting.id=t_domoprime_calculation.meeting_id 
WHERE t_customers_meeting.id IS NULL;

ALTER TABLE `t_domoprime_calculation` ADD CONSTRAINT `domoprime_calculation_00` FOREIGN KEY (`meeting_id`) REFERENCES `t_customers_meeting` (`id`) ON DELETE CASCADE;