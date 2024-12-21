UPDATE `t_domoprime_quotation` SET status = 'ACTIVE';
UPDATE `t_domoprime_billing` SET status = 'ACTIVE';
ALTER TABLE `t_domoprime_billing` ADD  `quotation_id` int(11) unsigned NOT NULL AFTER `customer_id`; 
ALTER TABLE `t_domoprime_billing` ADD `creator_id` int(11) unsigned NOT NULL AFTER `customer_id`;   
ALTER TABLE `t_domoprime_billing` ADD CONSTRAINT `domoprime_billing_3` FOREIGN KEY (`quotation_id`) REFERENCES `t_domoprime_quotation` (`id`) ON DELETE CASCADE;