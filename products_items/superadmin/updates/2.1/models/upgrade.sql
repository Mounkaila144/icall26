ALTER TABLE `t_products_items_item` ADD `position` int(8) unsigned NOT NULL DEFAULT 1  AFTER `item_slave_id`;
ALTER TABLE `t_products_item` ADD `position` int(8) unsigned NOT NULL DEFAULT 1  AFTER `linked_id`;