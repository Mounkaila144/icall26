ALTER TABLE `t_domoprime_quotation` ADD `header` varchar(255) AFTER `comments`;
ALTER TABLE `t_domoprime_quotation` ADD `remarks` TEXT COLLATE utf8_bin AFTER `comments`;
ALTER TABLE `t_domoprime_quotation` ADD `footer` TEXT COLLATE utf8_bin AFTER `header`;
