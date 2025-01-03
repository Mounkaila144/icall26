ALTER TABLE `t_app_mutual_customers_meeting_products` ADD `tva_id` int(11) unsigned NULL DEFAULT NULL AFTER `product_id`;
ALTER TABLE `t_app_mutual_customers_meeting_products` ADD `quantity` int(2) unsigned NOT NULL AFTER `tva_id`;
ALTER TABLE `t_app_mutual_customers_meeting_products` ADD `sale_price_with_tax` DECIMAL(12,2) NOT NULL AFTER `quantity`;
ALTER TABLE `t_app_mutual_customers_meeting_products` ADD `purchase_price_with_tax` DECIMAL(12,2) NOT NULL AFTER `sale_price_with_tax`;
ALTER TABLE `t_app_mutual_customers_meeting_products` ADD `sale_price_without_tax` DECIMAL(12,2) NOT NULL AFTER `purchase_price_with_tax`;
ALTER TABLE `t_app_mutual_customers_meeting_products` ADD `purchase_price_without_tax` DECIMAL(12,2) NOT NULL AFTER `sale_price_without_tax`;
ALTER TABLE `t_app_mutual_customers_meeting_products` ADD `total_sale_price_with_tax` DECIMAL(12,2) NOT NULL AFTER `purchase_price_without_tax`;
ALTER TABLE `t_app_mutual_customers_meeting_products` ADD `total_purchase_price_with_tax` DECIMAL(12,2) NOT NULL AFTER `total_sale_price_with_tax`;
ALTER TABLE `t_app_mutual_customers_meeting_products` ADD `total_sale_price_without_tax` DECIMAL(12,2) NOT NULL AFTER `total_purchase_price_with_tax`;
ALTER TABLE `t_app_mutual_customers_meeting_products` ADD `total_purchase_price_without_tax` DECIMAL(12,2) NOT NULL AFTER `total_sale_price_without_tax`;