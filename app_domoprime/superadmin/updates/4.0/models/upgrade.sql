ALTER TABLE `t_domoprime_billing_product_item` ADD `sale_discount_price_with_tax` DECIMAL(20,6) NOT NULL AFTER `sale_price_with_tax`;
ALTER TABLE `t_domoprime_billing_product_item` ADD `sale_discount_price_without_tax` DECIMAL(20,6) NOT NULL AFTER `sale_discount_price_with_tax`;
ALTER TABLE `t_domoprime_billing_product_item` ADD `total_sale_discount_price_with_tax` DECIMAL(20,6) NOT NULL AFTER `sale_discount_price_without_tax`;
ALTER TABLE `t_domoprime_billing_product_item` ADD `total_sale_discount_price_without_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_discount_price_with_tax`;

ALTER TABLE `t_domoprime_billing_product` ADD `sale_discount_price_with_tax` DECIMAL(20,6) NOT NULL AFTER `sale_price_with_tax`;
ALTER TABLE `t_domoprime_billing_product` ADD `sale_discount_price_without_tax` DECIMAL(20,6) NOT NULL AFTER `sale_discount_price_with_tax`;
ALTER TABLE `t_domoprime_billing_product` ADD `total_sale_discount_price_with_tax` DECIMAL(20,6) NOT NULL AFTER `sale_discount_price_without_tax`;
ALTER TABLE `t_domoprime_billing_product` ADD `total_sale_discount_price_without_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_discount_price_with_tax`;

ALTER TABLE `t_domoprime_quotation_product_item` ADD `sale_discount_price_with_tax` DECIMAL(20,6) NOT NULL AFTER `sale_price_with_tax`;
ALTER TABLE `t_domoprime_quotation_product_item` ADD `sale_discount_price_without_tax` DECIMAL(20,6) NOT NULL AFTER `sale_discount_price_with_tax`;
ALTER TABLE `t_domoprime_quotation_product_item` ADD `total_sale_discount_price_with_tax` DECIMAL(20,6) NOT NULL AFTER `sale_discount_price_without_tax`;
ALTER TABLE `t_domoprime_quotation_product_item` ADD `total_sale_discount_price_without_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_discount_price_with_tax`;

ALTER TABLE `t_domoprime_quotation_product` ADD `sale_discount_price_with_tax` DECIMAL(20,6) NOT NULL AFTER `sale_price_with_tax`;
ALTER TABLE `t_domoprime_quotation_product` ADD `sale_discount_price_without_tax` DECIMAL(20,6) NOT NULL AFTER `sale_discount_price_with_tax`;
ALTER TABLE `t_domoprime_quotation_product` ADD `total_sale_discount_price_with_tax` DECIMAL(20,6) NOT NULL AFTER `sale_discount_price_without_tax`;
ALTER TABLE `t_domoprime_quotation_product` ADD `total_sale_discount_price_without_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_discount_price_with_tax`;


ALTER TABLE `t_domoprime_quotation` ADD `total_sale_discount_with_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_without_tax`;
ALTER TABLE `t_domoprime_quotation` ADD `total_sale_discount_without_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_discount_with_tax`;

ALTER TABLE `t_domoprime_billing` ADD `total_sale_discount_with_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_without_tax`;
ALTER TABLE `t_domoprime_billing` ADD `total_sale_discount_without_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_discount_with_tax`;

