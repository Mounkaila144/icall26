ALTER TABLE `t_products_item` ADD `thickness`  decimal(20,6) DEFAULT 0 AFTER `unit`;
ALTER TABLE `t_products_item` ADD `mark`  VARCHAR(64) COLLATE utf8_bin NOT NULL DEFAULT '' AFTER `thickness`;
ALTER TABLE `t_products_item` ADD `input3`  VARCHAR(64) COLLATE utf8_bin NOT NULL DEFAULT '' AFTER `input2`;