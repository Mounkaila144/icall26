ALTER TABLE `t_customers_contract_product` ADD `quantity` DECIMAL(20,6) NOT NULL AFTER `product_id`;
ALTER TABLE `t_customers_contract_product` ADD `sale_price_with_tax` DECIMAL(20,6) NOT NULL AFTER `product_id`;
ALTER TABLE `t_customers_contract_product` ADD `purchase_price_with_tax` DECIMAL(20,6) NOT NULL AFTER `product_id`;
ALTER TABLE `t_customers_contract_product` ADD `sale_price_without_tax` DECIMAL(20,6) NOT NULL AFTER `product_id`;
ALTER TABLE `t_customers_contract_product` ADD `purchase_price_without_tax` DECIMAL(20,6) NOT NULL AFTER `product_id`;
ALTER TABLE `t_customers_contract_product` ADD `total_sale_price_with_tax` DECIMAL(20,6) NOT NULL AFTER `product_id`;
ALTER TABLE `t_customers_contract_product` ADD `total_purchase_price_with_tax` DECIMAL(20,6) NOT NULL AFTER `product_id`;
ALTER TABLE `t_customers_contract_product` ADD `total_sale_price_without_tax` DECIMAL(20,6) NOT NULL AFTER `product_id`;
ALTER TABLE `t_customers_contract_product` ADD `total_purchase_price_without_tax` DECIMAL(20,6) NOT NULL AFTER `product_id`;
ALTER TABLE `t_customers_contract_product` ADD  `tva_id` int(11) unsigned NOT NULL  AFTER `product_id`;