ALTER TABLE `t_domoprime_pre_meeting_model_i18n` ADD `initiator_signature` VARCHAR(255) NOT NULL AFTER `variables`; 
ALTER TABLE `t_domoprime_pre_meeting_model_i18n` ADD `signature` VARCHAR(255) NOT NULL AFTER `variables`; 


ALTER TABLE t_domoprime_after_work_model_i18n ADD `initiator_signature` VARCHAR(255) NOT NULL AFTER `variables`; 
ALTER TABLE t_domoprime_after_work_model_i18n ADD `signature` VARCHAR(255) NOT NULL AFTER `variables`; 


ALTER TABLE t_domoprime_quotation_model_i18n ADD `initiator_signature` VARCHAR(255) NOT NULL AFTER `body`; 
ALTER TABLE t_domoprime_quotation_model_i18n ADD `signature` VARCHAR(255) NOT NULL AFTER `body`;

ALTER TABLE t_domoprime_billing_model_i18n ADD `initiator_signature` VARCHAR(255) NOT NULL AFTER `body`; 
ALTER TABLE t_domoprime_billing_model_i18n ADD `signature` VARCHAR(255) NOT NULL AFTER `body`;