ALTER TABLE `t_domoprime_iso_customer_request` ADD  `src_surface_wall` decimal(20,6) NOT NULL DEFAULT '0.000000' AFTER `surface_floor`;
ALTER TABLE `t_domoprime_iso_customer_request` ADD  `src_surface_top` decimal(20,6) NOT NULL DEFAULT '0.000000' AFTER `src_surface_wall`;
ALTER TABLE `t_domoprime_iso_customer_request` ADD  `src_surface_floor` decimal(20,6) NOT NULL DEFAULT '0.000000' AFTER `src_surface_top`;
