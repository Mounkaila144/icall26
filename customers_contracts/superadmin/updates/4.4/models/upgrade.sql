--
-- Structure de la table `t_customers_contract_product_item`  
--
CREATE TABLE IF NOT EXISTS `t_customers_contract_product_item` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `contract_id` int(11) unsigned NOT NULL,
        `product_id` int(11) unsigned NOT NULL,  
        `item_id` int(11) unsigned NOT NULL,  
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NOT NULL,   
     PRIMARY KEY (`id`)       
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  ;

ALTER TABLE `t_customers_contract_product_item` ADD CONSTRAINT `customers_contract_item_prod_fk0` FOREIGN KEY (`contract_id`) REFERENCES `t_customers_contract` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_customers_contract_product_item` ADD CONSTRAINT `customers_contract_item_prod_fk1` FOREIGN KEY (`product_id`) REFERENCES `t_products` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_customers_contract_product_item` ADD CONSTRAINT `customers_contract_item_prod_fk2` FOREIGN KEY (`item_id`) REFERENCES `t_products_item` (`id`) ON DELETE CASCADE;

