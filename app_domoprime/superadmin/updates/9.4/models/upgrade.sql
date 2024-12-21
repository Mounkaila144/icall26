ALTER TABLE `t_domoprime_quotation` ADD `type` VARCHAR(16) NOT NULL DEFAULT '' AFTER `mode`;     
ALTER TABLE `t_domoprime_quotation` ADD `polluter_id` int(11)  UNSIGNED NULL DEFAULT NULL AFTER `company_id`;             
ALTER TABLE `t_domoprime_quotation` ADD CONSTRAINT `t_domoprime_quotation_02` FOREIGN KEY (`polluter_id`) REFERENCES `t_partner_polluter_company` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;
       
ALTER TABLE `t_domoprime_billing` ADD `type` int(11)  UNSIGNED NULL DEFAULT NULL AFTER `company_id`;       
ALTER TABLE `t_domoprime_billing` ADD `polluter_id` int(11)  UNSIGNED NULL DEFAULT NULL AFTER `company_id`; 
ALTER TABLE `t_domoprime_billing` ADD CONSTRAINT `t_domoprime_billing_02` FOREIGN KEY (`polluter_id`) REFERENCES `t_partner_polluter_company` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;
