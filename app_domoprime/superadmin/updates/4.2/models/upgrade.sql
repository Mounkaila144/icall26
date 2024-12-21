ALTER TABLE `t_domoprime_billing_product` ADD `sale_standard_price_with_tax` DECIMAL(20,6) NOT NULL AFTER `sale_price_with_tax`;
ALTER TABLE `t_domoprime_billing_product` ADD `sale_standard_price_without_tax` DECIMAL(20,6) NOT NULL AFTER `sale_standard_price_with_tax`;
ALTER TABLE `t_domoprime_billing_product` ADD `total_sale_standard_price_with_tax` DECIMAL(20,6) NOT NULL AFTER `sale_standard_price_without_tax`;
ALTER TABLE `t_domoprime_billing_product` ADD `total_sale_standard_price_without_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_standard_price_with_tax`;

ALTER TABLE `t_domoprime_quotation_product` ADD `sale_standard_price_with_tax` DECIMAL(20,6) NOT NULL AFTER `sale_price_with_tax`;
ALTER TABLE `t_domoprime_quotation_product` ADD `sale_standard_price_without_tax` DECIMAL(20,6) NOT NULL AFTER `sale_standard_price_with_tax`;
ALTER TABLE `t_domoprime_quotation_product` ADD `total_sale_standard_price_with_tax` DECIMAL(20,6) NOT NULL AFTER `sale_standard_price_without_tax`;
ALTER TABLE `t_domoprime_quotation_product` ADD `total_sale_standard_price_without_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_standard_price_with_tax`;

ALTER TABLE `t_domoprime_quotation` ADD `total_sale_101_with_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_without_tax`;
ALTER TABLE `t_domoprime_quotation` ADD `total_sale_101_without_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_101_with_tax`;
ALTER TABLE `t_domoprime_quotation` ADD `total_sale_102_with_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_101_without_tax`;
ALTER TABLE `t_domoprime_quotation` ADD `total_sale_102_without_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_102_with_tax`;
ALTER TABLE `t_domoprime_quotation` ADD `total_sale_103_with_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_102_without_tax`;
ALTER TABLE `t_domoprime_quotation` ADD `total_sale_103_without_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_103_with_tax`;

ALTER TABLE `t_domoprime_billing` ADD `total_sale_101_with_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_without_tax`;
ALTER TABLE `t_domoprime_billing` ADD `total_sale_101_without_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_101_with_tax`;
ALTER TABLE `t_domoprime_billing` ADD `total_sale_102_with_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_101_without_tax`;
ALTER TABLE `t_domoprime_billing` ADD `total_sale_102_without_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_102_with_tax`;
ALTER TABLE `t_domoprime_billing` ADD `total_sale_103_with_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_102_without_tax`;
ALTER TABLE `t_domoprime_billing` ADD `total_sale_103_without_tax` DECIMAL(20,6) NOT NULL AFTER `total_sale_103_with_tax`;
