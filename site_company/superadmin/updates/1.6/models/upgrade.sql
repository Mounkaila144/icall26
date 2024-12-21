ALTER TABLE `t_site_company` ADD `capital` varchar(64)  NOT NULL AFTER `footer`;
ALTER TABLE `t_site_company` ADD `comments` TEXT  NOT NULL AFTER `capital`;
