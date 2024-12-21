ALTER TABLE `t_domoprime_iso_customer_request` ADD  `previous_energy_id` int(11) UNSIGNED DEFAULT NULL AFTER `declarants`;
ALTER TABLE `t_domoprime_iso_customer_request` ADD  `surface_home` decimal(20,3) NOT NULL DEFAULT '0.000' AFTER `previous_energy_id`;

ALTER TABLE `t_domoprime_iso_customer_request` ADD INDEX `t_domoprime_iso_customer_request_fk3` (`previous_energy_id`); 
ALTER TABLE `t_domoprime_iso_customer_request` ADD INDEX `t_domoprime_iso_customer_request_fk4` (`energy_id`); 