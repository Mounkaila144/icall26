ALTER TABLE `t_sites` ADD `site_db_size` bigint(20) NOT NULL DEFAULT 0 AFTER `site_access_restricted`;
ALTER TABLE `t_sites` ADD `site_size` bigint(20) NOT NULL DEFAULT 0 AFTER `site_db_size`;