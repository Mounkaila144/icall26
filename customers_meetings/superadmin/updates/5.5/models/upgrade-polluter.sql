-- polluter_id

ALTER TABLE `t_customers_meeting` CHANGE `polluter_id` `polluter_id` INT(11) UNSIGNED NULL DEFAULT NULL;
UPDATE `t_customers_meeting` SET polluter_id = NULL WHERE polluter_id=0 ;

UPDATE t_customers_meeting 
INNER JOIN (
SELECT  t_customers_meeting.polluter_id
FROM  t_customers_meeting 
LEFT JOIN t_partner_polluter_company ON t_partner_polluter_company.id=t_customers_meeting.polluter_id
WHERE t_partner_polluter_company.id IS NULL AND t_customers_meeting.polluter_id IS NOT NULL
GROUP BY  t_customers_meeting.polluter_id) as tmp ON tmp.polluter_id=t_customers_meeting.polluter_id
SET t_customers_meeting.polluter_id=NULL;

ALTER TABLE `t_customers_meeting` ADD CONSTRAINT `customers_meeting_fk10` FOREIGN KEY (`polluter_id`) REFERENCES `t_partner_polluter_company` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;
 