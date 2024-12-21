ALTER TABLE `t_sites` ADD `site_frontend_theme_base` varchar(64)  NOT NULL AFTER `site_frontend_theme`;
ALTER TABLE `t_sites` ADD `site_admin_theme_base` varchar(64)  NOT NULL AFTER `site_admin_theme`;
ALTER TABLE `t_sites` ADD `logo` varchar(64)  NOT NULL AFTER `site_type`;
ALTER TABLE `t_sites` ADD `picture` varchar(64)  NOT NULL AFTER `logo`;