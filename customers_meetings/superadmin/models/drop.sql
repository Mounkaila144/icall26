-- Table linked by foreign keys

DROP TABLE IF EXISTS `t_customers_meeting_status_i18n`;
DROP TABLE IF EXISTS `t_customers_meeting_status_call_i18n`;
DROP TABLE IF EXISTS `t_customers_meeting_type_i18n`;
DROP TABLE IF EXISTS `t_customers_meeting_status_lead_i18n`;
-- Tables without foreign key

DROP TABLE IF EXISTS `t_customers_meeting` ;
DROP TABLE IF EXISTS `t_customers_meeting_status_call`;
DROP TABLE IF EXISTS `t_customers_meeting_campaign`;
DROP TABLE IF EXISTS `t_customers_meeting_type`;
DROP TABLE IF EXISTS `t_customers_meeting_history`; 
DROP TABLE IF EXISTS `t_customers_meeting_comments`;
DROP TABLE IF EXISTS `t_customers_meeting_status`;
DROP TABLE IF EXISTS `t_customers_meeting_status_lead`;
