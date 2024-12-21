ALTER TABLE  `t_site_company` ADD `firstname1` varchar(16) COLLATE utf8_bin DEFAULT NULL AFTER `function`;
ALTER TABLE  `t_site_company` ADD `lastname1` varchar(32) COLLATE utf8_bin DEFAULT NULL AFTER `firstname1`;
ALTER TABLE  `t_site_company` ADD`function1` varchar(64) COLLATE utf8_bin DEFAULT NULL AFTER  `lastname1`;