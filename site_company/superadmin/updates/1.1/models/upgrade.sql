ALTER TABLE `t_site_company` ADD  `gender` enum('Mr','Ms','Mrs') DEFAULT 'Mr' AFTER `country`;
ALTER TABLE `t_site_company` ADD  `firstname` varchar(16) COLLATE utf8_bin DEFAULT NULL AFTER `gender`;
ALTER TABLE `t_site_company` ADD  `lastname` varchar(32) COLLATE utf8_bin DEFAULT NULL AFTER `firstname`;
ALTER TABLE `t_site_company` ADD  `function` varchar(64) COLLATE utf8_bin DEFAULT NULL AFTER `lastname`;
