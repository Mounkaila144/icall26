
--
-- Structure de la table `t_products_items_item`  
--
CREATE TABLE IF NOT EXISTS `t_products_items_item` (
             `id` int(11) unsigned NOT NULL AUTO_INCREMENT,                        
             `item_master_id` int(11) unsigned NOT NULL,      
             `item_slave_id` int(11) unsigned NOT NULL,                       
             `is_active` enum('YES','NO')  NOT NULL DEFAULT 'NO',             
             `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',             
             `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
             `updated_at` timestamp  NULL DEFAULT NULL,
     PRIMARY KEY (`id`)       
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

ALTER TABLE `t_products_items_item` ADD CONSTRAINT `t_products_items_item_fk0` FOREIGN KEY (`item_master_id`) REFERENCES `t_products_item` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_products_items_item` ADD CONSTRAINT `t_products_items_item_fk1` FOREIGN KEY (`item_slave_id`) REFERENCES `t_products_item` (`id`) ON DELETE CASCADE;


