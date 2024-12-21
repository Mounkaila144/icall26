ALTER TABLE `t_domoprime_quotation` ADD `calculation_id` INT(11) unsigned NULL DEFAULT NULL AFTER `contract_id`;
ALTER TABLE `t_domoprime_quotation` ADD CONSTRAINT `t_domoprime_quotation_03` FOREIGN KEY (`calculation_id`) REFERENCES `t_domoprime_calculation` (`id`) ON DELETE CASCADE;

ALTER TABLE `t_domoprime_billing` ADD `calculation_id` INT(11) unsigned NULL DEFAULT NULL AFTER `contract_id`;
ALTER TABLE `t_domoprime_billing` ADD CONSTRAINT `t_domoprime_billing_03` FOREIGN KEY (`calculation_id`) REFERENCES `t_domoprime_calculation` (`id`) ON DELETE CASCADE;