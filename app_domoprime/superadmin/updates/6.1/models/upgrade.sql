ALTER TABLE `t_partner_polluter_quotation` ADD `post_company_model_id` int(11) unsigned NULL DEFAULT NULL AFTER  `post_model_id`; 

ALTER TABLE  t_partner_polluter_quotation DROP FOREIGN KEY partners_polluter_quotation_fk2;
ALTER TABLE `t_partner_polluter_quotation` DROP INDEX `partners_polluter_quotation_fk2`;
ALTER TABLE `t_partner_polluter_quotation` DROP `post_model_id`;

ALTER TABLE `t_partner_polluter_quotation` ADD CONSTRAINT `partners_polluter_quotation_fk2` FOREIGN KEY (`post_company_model_id`) REFERENCES `t_site_company_model` (`id`) ON DELETE CASCADE;