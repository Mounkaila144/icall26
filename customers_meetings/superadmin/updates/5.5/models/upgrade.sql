-- opc_range_id

ALTER TABLE `t_customers_meeting` CHANGE `opc_range_id` `opc_range_id` INT(11) UNSIGNED NULL DEFAULT NULL;
UPDATE `t_customers_meeting` SET opc_range_id = NULL WHERE opc_range_id=0 ;

UPDATE t_customers_meeting 
INNER JOIN (
SELECT  t_customers_meeting.opc_range_id
FROM  t_customers_meeting 
LEFT JOIN t_customers_contracts_date_range ON t_customers_contracts_date_range.id=t_customers_meeting.opc_range_id
WHERE t_customers_contracts_date_range.id IS NULL AND t_customers_meeting.opc_range_id IS NOT NULL
GROUP BY  t_customers_meeting.opc_range_id) as tmp ON tmp.opc_range_id=t_customers_meeting.opc_range_id
SET t_customers_meeting.opc_range_id=NULL;

ALTER TABLE `t_customers_meeting` ADD CONSTRAINT `customers_meeting_fk11` FOREIGN KEY (`opc_range_id`) REFERENCES `t_customers_contracts_date_range` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

-- created_by_id
UPDATE `t_customers_meeting` SET created_by_id = NULL WHERE created_by_id=0 ;
ALTER TABLE `t_customers_meeting` CHANGE `created_by_id` `created_by_id` INT(11) NULL DEFAULT NULL;

UPDATE t_customers_meeting 
INNER JOIN (
SELECT  t_customers_meeting.created_by_id
FROM  t_customers_meeting 
LEFT JOIN t_users ON t_users.id=t_customers_meeting.created_by_id
WHERE t_users.id IS NULL AND t_customers_meeting.created_by_id IS NOT NULL
GROUP BY   t_customers_meeting.created_by_id) as tmp ON tmp.created_by_id=t_customers_meeting.created_by_id
SET t_customers_meeting.created_by_id=NULL;

ALTER TABLE `t_customers_meeting` ADD CONSTRAINT `customers_meeting_fk13` FOREIGN KEY (`created_by_id`) REFERENCES `t_users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;


-- campaign_id
ALTER TABLE `t_customers_meeting` CHANGE `campaign_id` `campaign_id` INT(11) UNSIGNED NULL; 

UPDATE t_customers_meeting 
INNER JOIN (
SELECT  t_customers_meeting.campaign_id
FROM  t_customers_meeting 
LEFT JOIN t_customers_meeting_campaign ON t_customers_meeting_campaign.id=t_customers_meeting.campaign_id
WHERE t_customers_meeting_campaign.id IS NULL AND t_customers_meeting.campaign_id IS NOT NULL
GROUP BY   t_customers_meeting.campaign_id) as tmp ON tmp.campaign_id=t_customers_meeting.campaign_id
SET t_customers_meeting.campaign_id=NULL;

ALTER TABLE `t_customers_meeting` ADD CONSTRAINT `customers_meeting_fk14` FOREIGN KEY (`campaign_id`) REFERENCES `t_customers_meeting_campaign` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

