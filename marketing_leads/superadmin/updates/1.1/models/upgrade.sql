ALTER TABLE `t_marketing_leads_wp_forms` ADD `wp_created_at` timestamp  NULL DEFAULT NULL  AFTER `is_active`;
-- ALTER TABLE `t_marketing_leads_wp_forms` CHANGE `wp_created_at` `wp_created_at` TIMESTAMP NULL DEFAULT NULL;