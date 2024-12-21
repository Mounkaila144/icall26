ALTER TABLE `t_domoprime_quotation_product_item` ADD `unit_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_price_without_tax`; 

ALTER TABLE `t_domoprime_billing_product_item` ADD `unit_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_price_without_tax`; 