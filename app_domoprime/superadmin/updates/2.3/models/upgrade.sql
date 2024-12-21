ALTER TABLE `t_domoprime_quotation` ADD `prime`  decimal(20,6) NOT NULL DEFAULT 0.0 AFTER `total_purchase_with_tax`;

UPDATE `t_domoprime_quotation` SET prime= total_sale_with_tax - 1;
UPDATE `t_domoprime_quotation` SET is_last='NO';

UPDATE `t_domoprime_quotation` a
INNER JOIN ( SELECT contract_id,max(id) as max_id FROM `t_domoprime_quotation` GROUP BY contract_id) b
    ON a.id= b.max_id
SET is_last='YES' 
WHERE status='ACTIVE';

ALTER TABLE `t_domoprime_billing` ADD `prime` decimal(20,6) NOT NULL DEFAULT 0.0 AFTER `total_purchase_with_tax`;
ALTER TABLE `t_domoprime_billing` ADD `is_last` enum('NO','YES') COLLATE utf8_bin NOT NULL DEFAULT 'NO' AFTER `status_id`;       

UPDATE `t_domoprime_billing` SET prime= total_sale_with_tax - 1;

UPDATE `t_domoprime_billing` SET is_last='NO';

UPDATE `t_domoprime_billing` a
INNER JOIN ( SELECT contract_id,max(id) as max_id FROM `t_domoprime_billing` GROUP BY contract_id) b
    ON a.id= b.max_id
SET is_last='YES';

ALTER TABLE `t_domoprime_quotation_product` ADD `prime` decimal(20,6) NOT NULL DEFAULT 0.0 AFTER `total_sale_price_with_tax`;

ALTER TABLE `t_domoprime_billing_product` ADD `prime` decimal(20,6) NOT NULL DEFAULT 0.0 AFTER `total_sale_price_with_tax`;
 

