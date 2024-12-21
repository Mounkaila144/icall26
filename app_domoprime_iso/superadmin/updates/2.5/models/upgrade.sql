ALTER TABLE `t_domoprime_iso_customer_request`  ADD  `cef` decimal(10,3) NULL DEFAULT NULL  AFTER `ana_prime`;
ALTER TABLE `t_domoprime_iso_customer_request`  ADD  `cef_project` decimal(10,3)  NULL DEFAULT NULL  AFTER `cef`;
ALTER TABLE `t_domoprime_iso_customer_request`  ADD  `cep` decimal(10,3) NULL DEFAULT NULL  AFTER `cef_project`;
ALTER TABLE `t_domoprime_iso_customer_request`  ADD  `cep_project` decimal(10,3) NULL DEFAULT NULL  AFTER `cep`;
ALTER TABLE `t_domoprime_iso_customer_request`  ADD  `power_consumption` decimal(10,3) NULL DEFAULT NULL  AFTER `cep_project`;
ALTER TABLE `t_domoprime_iso_customer_request`  ADD  `economy` decimal(10,3) NULL DEFAULT NULL  AFTER `power_consumption`;