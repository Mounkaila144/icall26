ALTER TABLE `t_domoprime_billing_product` ADD `added_price_with_tax` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `sale_price_with_tax`;
ALTER TABLE `t_domoprime_billing_product` ADD `added_price_without_tax` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `added_price_with_tax`;
ALTER TABLE `t_domoprime_billing_product` ADD `total_added_price_with_tax` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `added_price_without_tax`;
ALTER TABLE `t_domoprime_billing_product` ADD `total_added_price_without_tax` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_added_price_with_tax`;

ALTER TABLE `t_domoprime_billing_product` ADD `restincharge_price_with_tax` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `sale_price_with_tax`;
ALTER TABLE `t_domoprime_billing_product` ADD `restincharge_price_without_tax` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `restincharge_price_with_tax`;
ALTER TABLE `t_domoprime_billing_product` ADD `total_restincharge_price_with_tax` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `restincharge_price_without_tax`;
ALTER TABLE `t_domoprime_billing_product` ADD `total_restincharge_price_without_tax` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_restincharge_price_with_tax`;

ALTER TABLE `t_domoprime_quotation_product` ADD `added_price_with_tax` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `sale_price_with_tax`;
ALTER TABLE `t_domoprime_quotation_product` ADD `added_price_without_tax` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `added_price_with_tax`;
ALTER TABLE `t_domoprime_quotation_product` ADD `total_added_price_with_tax` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `added_price_without_tax`;
ALTER TABLE `t_domoprime_quotation_product` ADD `total_added_price_without_tax` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_added_price_with_tax`;

ALTER TABLE `t_domoprime_quotation_product` ADD `restincharge_price_with_tax` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `sale_price_with_tax`;
ALTER TABLE `t_domoprime_quotation_product` ADD `restincharge_price_without_tax` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `restincharge_price_with_tax`;
ALTER TABLE `t_domoprime_quotation_product` ADD `total_restincharge_price_with_tax` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `restincharge_price_without_tax`;
ALTER TABLE `t_domoprime_quotation_product` ADD `total_restincharge_price_without_tax` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_restincharge_price_with_tax`;


ALTER TABLE `t_domoprime_quotation` ADD `total_added_with_tax_wall` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_sale_103_without_tax`;
ALTER TABLE `t_domoprime_quotation` ADD `total_added_with_tax_floor` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_added_with_tax_wall`;
ALTER TABLE `t_domoprime_quotation` ADD `total_added_with_tax_top` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_added_with_tax_floor`;

ALTER TABLE `t_domoprime_quotation` ADD `total_added_without_tax_wall` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_added_with_tax_top`;
ALTER TABLE `t_domoprime_quotation` ADD `total_added_without_tax_floor` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_added_without_tax_wall`;
ALTER TABLE `t_domoprime_quotation` ADD `total_added_without_tax_top` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_added_without_tax_floor`;

ALTER TABLE `t_domoprime_quotation` ADD `total_restincharge_with_tax_wall` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_added_without_tax_top`;
ALTER TABLE `t_domoprime_quotation` ADD `total_restincharge_with_tax_floor` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_restincharge_with_tax_wall`;
ALTER TABLE `t_domoprime_quotation` ADD `total_restincharge_with_tax_top` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_restincharge_with_tax_floor`;

ALTER TABLE `t_domoprime_quotation` ADD `total_restincharge_without_tax_wall` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_restincharge_with_tax_top`;
ALTER TABLE `t_domoprime_quotation` ADD `total_restincharge_without_tax_floor` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_restincharge_without_tax_wall`;
ALTER TABLE `t_domoprime_quotation` ADD `total_restincharge_without_tax_top` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_restincharge_without_tax_floor`;



ALTER TABLE `t_domoprime_billing` ADD `total_added_with_tax_wall` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_sale_103_without_tax`;
ALTER TABLE `t_domoprime_billing` ADD `total_added_with_tax_floor` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_added_with_tax_wall`;
ALTER TABLE `t_domoprime_billing` ADD `total_added_with_tax_top` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_added_with_tax_floor`;

ALTER TABLE `t_domoprime_billing` ADD `total_added_without_tax_wall` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_added_with_tax_top`;
ALTER TABLE `t_domoprime_billing` ADD `total_added_without_tax_floor` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_added_without_tax_wall`;
ALTER TABLE `t_domoprime_billing` ADD `total_added_without_tax_top` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_added_without_tax_floor`;

ALTER TABLE `t_domoprime_billing` ADD `total_restincharge_with_tax_wall` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_added_without_tax_top`;
ALTER TABLE `t_domoprime_billing` ADD `total_restincharge_with_tax_floor` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_restincharge_with_tax_wall`;
ALTER TABLE `t_domoprime_billing` ADD `total_restincharge_with_tax_top` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_restincharge_with_tax_floor`;

ALTER TABLE `t_domoprime_billing` ADD `total_restincharge_without_tax_wall` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_restincharge_with_tax_top`;
ALTER TABLE `t_domoprime_billing` ADD `total_restincharge_without_tax_floor` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_restincharge_without_tax_wall`;
ALTER TABLE `t_domoprime_billing` ADD `total_restincharge_without_tax_top` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `total_restincharge_without_tax_floor`;
