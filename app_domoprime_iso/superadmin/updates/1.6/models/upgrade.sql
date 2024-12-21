ALTER TABLE `t_domoprime_iso_customer_request` ADD `added_price_with_tax_wall` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER `surface_wall`;
ALTER TABLE `t_domoprime_iso_customer_request` ADD `added_price_without_tax_wall` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER `added_price_with_tax_wall`;

ALTER TABLE `t_domoprime_iso_customer_request` ADD `added_price_with_tax_floor` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER `surface_floor`;
ALTER TABLE `t_domoprime_iso_customer_request` ADD `added_price_without_tax_floor` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER `added_price_with_tax_floor`;

ALTER TABLE `t_domoprime_iso_customer_request` ADD `added_price_with_tax_top` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER `surface_top`;
ALTER TABLE `t_domoprime_iso_customer_request` ADD `added_price_without_tax_top` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER `added_price_with_tax_top`;


ALTER TABLE `t_domoprime_iso_customer_request` ADD `restincharge_price_with_tax_wall` DECIMAL(20,6) NOT NULL DEFAULT '0.000000'AFTER `surface_wall`;
ALTER TABLE `t_domoprime_iso_customer_request` ADD `restincharge_price_without_tax_wall` DECIMAL(20,6) NOT NULL  DEFAULT '0.000000' AFTER `restincharge_price_with_tax_wall`;

ALTER TABLE `t_domoprime_iso_customer_request` ADD `restincharge_price_with_tax_floor` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER `surface_floor`;
ALTER TABLE `t_domoprime_iso_customer_request` ADD `restincharge_price_without_tax_floor` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER `restincharge_price_with_tax_floor`;

ALTER TABLE `t_domoprime_iso_customer_request` ADD `restincharge_price_with_tax_top` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER `surface_top`;
ALTER TABLE `t_domoprime_iso_customer_request` ADD `restincharge_price_without_tax_top` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER `restincharge_price_with_tax_top`;
