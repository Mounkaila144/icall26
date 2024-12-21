ALTER TABLE `t_site_services_site` ADD `db_size` bigint(20) NOT NULL DEFAULT 0 AFTER `access_restricted`;
ALTER TABLE `t_site_services_site` ADD `size` bigint(20) NOT NULL DEFAULT 0 AFTER `db_size`;