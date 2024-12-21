ALTER TABLE `t_site_company` ADD `rge_start_at` timestamp NULL DEFAULT NULL AFTER `function1`;
ALTER TABLE `t_site_company` ADD `rge_end_at` timestamp NULL DEFAULT NULL AFTER `rge_start_at`;