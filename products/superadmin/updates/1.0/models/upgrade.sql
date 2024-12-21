ALTER TABLE `t_products` ADD `action_id`  int(11) unsigned NOT NULL AFTER `content`;

ALTER TABLE `t_products` ADD `unit`  varchar(64)  NOT NULL AFTER `content`;

CREATE TABLE IF NOT EXISTS `t_products_action` (
             `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
             `title` varchar(255)  NOT NULL,                                  
             `action` varchar(255)  NOT NULL,                                  
             `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
             `updated_at` timestamp  NOT NULL DEFAULT '0000-00-00 00:00:00',
     PRIMARY KEY (`id`)    
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;