ALTER TABLE `t_customers_meeting_forms` CHANGE `meeting_id` `meeting_id` INT(11) UNSIGNED NULL;

DELETE `t_customers_meeting_forms`  FROM `t_customers_meeting_forms` 
LEFT JOIN `t_customers_meeting` ON t_customers_meeting.id=t_customers_meeting_forms.meeting_id 
WHERE t_customers_meeting.id IS NULL;

ALTER TABLE `t_customers_meeting_forms` ADD CONSTRAINT `customers_meeting_form_00` FOREIGN KEY (`meeting_id`) REFERENCES `t_customers_meeting` (`id`) ON DELETE CASCADE;
