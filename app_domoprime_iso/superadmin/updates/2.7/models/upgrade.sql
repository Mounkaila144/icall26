ALTER TABLE `t_domoprime_iso_customer_request`  ADD  `energy_class` VARCHAR(1) NULL DEFAULT NULL  AFTER `ana_prime`;
ALTER TABLE `t_domoprime_iso_customer_request`  ADD  `previous_energy_class` VARCHAR(1)  NULL DEFAULT NULL  AFTER `energy_class`;
