UPDATE `t_marketing_leads_wp_forms` SET `wp_created_at` = '0000-00-00 00:00:00' WHERE `t_marketing_leads_wp_forms`.`wp_created_at` IS NULL ;
ALTER TABLE `t_marketing_leads_wp_forms` CHANGE `wp_created_at` `wp_created_at` TIMESTAMP NOT NULL;
