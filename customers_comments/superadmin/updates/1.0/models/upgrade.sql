ALTER TABLE `t_customers_comments` ADD `type` ENUM('LOG','SYSTEM','USER','') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `comment`;