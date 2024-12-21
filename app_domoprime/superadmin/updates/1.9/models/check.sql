SELECT * FROM `t_domoprime_quotation` 
LEFT JOIN t_customers_meeting ON t_customers_meeting.id=t_domoprime_quotation.meeting_id 
WHERE t_customers_meeting.id IS NULL


DELETE `t_domoprime_quotation`  FROM `t_domoprime_quotation` 
LEFT JOIN `t_customers_meeting` ON t_customers_meeting.id=t_domoprime_quotation.meeting_id 
WHERE t_customers_meeting.id IS NULL;