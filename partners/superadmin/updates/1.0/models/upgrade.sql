ALTER TABLE `t_partners_company`add `parameters` TEXT  NOT NULL DEFAULT '' AFTER `state`;
ALTER TABLE `t_partners_company`add `comments` varchar(255)  NULL AFTER `parameters`;