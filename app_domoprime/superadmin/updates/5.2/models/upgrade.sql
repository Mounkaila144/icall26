ALTER TABLE `t_domoprime_quotation` ADD `ite_prime` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `ana_pack_prime`;
ALTER TABLE `t_domoprime_billing` ADD `ite_prime` DECIMAL(20,6) NOT NULL DEFAULT '0.000000' AFTER  `ana_pack_prime`;