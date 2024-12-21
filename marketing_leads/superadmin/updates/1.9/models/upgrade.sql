ALTER TABLE `t_marketing_leads_wp_landing_page_site`
    ADD COLUMN `cron_time` INT(11) UNSIGNED NOT NULL DEFAULT 0 AFTER `campaign` ,
ADD COLUMN `last_execution_time` INT(11) UNSIGNED DEFAULT NULL AFTER `cron_time`;
