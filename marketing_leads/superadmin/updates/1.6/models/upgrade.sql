ALTER TABLE `t_marketing_leads_wp_forms` ADD `referrer` varchar(64) NULL DEFAULT NULL AFTER `country`;
ALTER TABLE `t_marketing_leads_wp_forms` ADD `utm_source` varchar(64) NULL DEFAULT NULL AFTER `country`;
ALTER TABLE `t_marketing_leads_wp_forms` ADD `utm_medium` varchar(64) NULL DEFAULT NULL AFTER `country`;
ALTER TABLE `t_marketing_leads_wp_forms` ADD `utm_campaign` varchar(64) NULL DEFAULT NULL AFTER `country`;

