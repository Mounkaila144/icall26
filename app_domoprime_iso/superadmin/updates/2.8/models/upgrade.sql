ALTER TABLE `t_domoprime_iso_customer_request`  ADD  `has_bbc` ENUM('Y','N') DEFAULT 'N'  AFTER `ana_prime`;
ALTER TABLE `t_domoprime_iso_customer_request`  ADD  `has_strainer` ENUM('Y','N') DEFAULT 'N'  AFTER `has_bbc`;
