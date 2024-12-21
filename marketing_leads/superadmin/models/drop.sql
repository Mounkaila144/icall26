-- Drop foreign keys constraint
ALTER TABLE `t_marketing_leads_file_import` DROP FOREIGN KEY `fk_marketing_leads_file_format_import_0`;
ALTER TABLE `t_marketing_leads_file_import` DROP FOREIGN KEY `fk_marketing_leads_file_user_import_1`;
ALTER TABLE `t_marketing_leads_file_import` DROP FOREIGN KEY `fk_marketing_leads_file_site_import_2`;
ALTER TABLE `t_marketing_leads_errors_import` DROP FOREIGN KEY `fk_marketing_leads_errors_import_file_0`;
ALTER TABLE `t_marketing_leads_wp_forms` DROP FOREIGN KEY `fk_marketing_leads_wp_forms_0`;

-- Table linked by foreign keys
DROP TABLE IF EXISTS `t_marketing_leads_wp_forms`;
DROP TABLE IF EXISTS `t_marketing_leads_errors_import`;
DROP TABLE IF EXISTS `t_marketing_leads_file_import`;
DROP TABLE IF EXISTS `t_marketing_leads_format_import`;
DROP TABLE IF EXISTS `t_marketing_leads_wp_landing_page_site`;

-- Tables without foreign key
