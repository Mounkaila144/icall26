ALTER TABLE `t_domoprime_iso_customer_request` ADD `install_surface_wall` decimal(20,6) NOT NULL DEFAULT '0.000000' AFTER `surface_floor`;
ALTER TABLE `t_domoprime_iso_customer_request` ADD `install_surface_top` decimal(20,6) NOT NULL DEFAULT '0.000000' AFTER `install_surface_wall`;
ALTER TABLE `t_domoprime_iso_customer_request` ADD `install_surface_floor` decimal(20,6) NOT NULL DEFAULT '0.000000' AFTER `install_surface_top`;
ALTER TABLE `t_domoprime_iso_customer_request` ADD `tax_credit_used` decimal(20,6) NOT NULL DEFAULT '0.000000' AFTER `more_2_years`;
ALTER TABLE `t_domoprime_iso_customer_request` ADD `parcel_surface` decimal(20,6) NOT NULL DEFAULT '0.000000' AFTER `tax_credit_used`;
ALTER TABLE `t_domoprime_iso_customer_request` ADD `parcel_reference` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL AFTER `tax_credit_used`;


