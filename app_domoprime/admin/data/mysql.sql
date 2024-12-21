DELETE FROM `t_partner_polluter_company`;
DELETE FROM `t_partner_polluter_contact`;
DELETE FROM `t_partner_recipient_company`;
DELETE FROM `t_partner_recipient_contact`;
DELETE FROM `t_partner_polluter_document`;
DELETE FROM `t_domoprime_billing_model`;
DELETE FROM `t_domoprime_quotation_model`;
DELETE FROM `t_partner_polluter_billing`;



SELECT * FROM t_domoprime_polluter_class 
INNER JOIN t_domoprime_class ON t_domoprime_class.id=t_domoprime_polluter_class.class_id 
WHERE t_domoprime_polluter_class.polluter_id='1';