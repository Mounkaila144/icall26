ALTER TABLE `t_domoprime_quotation` ADD `total_tax`  decimal(20,6) NOT NULL DEFAULT 0.0 AFTER `total_sale_with_tax`;
ALTER TABLE `t_domoprime_billing` ADD `total_tax`  decimal(20,6) NOT NULL DEFAULT 0.0 AFTER `total_sale_with_tax`;

ALTER TABLE `t_domoprime_quotation_product_item` ADD `is_mandatory` enum('YES','NO')  NOT NULL DEFAULT 'NO' AFTER `tva_id`;
ALTER TABLE `t_domoprime_quotation_product_item` ADD `unit` varchar(255)  NOT NULL AFTER `quantity`;
ALTER TABLE `t_domoprime_quotation_product_item` ADD `coefficient`  decimal(20,6) NOT NULL DEFAULT 1.0 NULL AFTER `unit`;
ALTER TABLE `t_domoprime_quotation_product_item` ADD `total_tax`  decimal(20,6) NOT NULL DEFAULT 0.0 AFTER `total_sale_price_without_tax`;

ALTER TABLE `t_domoprime_billing_product_item` ADD `is_mandatory` enum('YES','NO')  NOT NULL DEFAULT 'NO' AFTER `tva_id`;
ALTER TABLE `t_domoprime_billing_product_item` ADD `unit` varchar(255)  NOT NULL AFTER `quantity`;
ALTER TABLE `t_domoprime_billing_product_item` ADD `coefficient`  decimal(20,6) NOT NULL DEFAULT 1.0 AFTER `unit`;
ALTER TABLE `t_domoprime_billing_product_item` ADD `total_tax`  decimal(20,6) NOT NULL DEFAULT 0.0 AFTER `total_sale_price_without_tax`;