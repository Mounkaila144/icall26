
--
-- Structure de la table `t_products`  
--
CREATE TABLE IF NOT EXISTS `t_products` (
             `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
             `tva_id` int(11) unsigned NOT NULL,            
             `reference` varchar(255)  NOT NULL,            
             `price` decimal(20,6) NOT NULL DEFAULT '0.000000',            
             `url` varchar(255)  COLLATE utf8_general_ci NOT NULL,
             `picture` varchar(255)  NOT NULL,
             `icon` varchar(255)  NOT NULL,
             `meta_title` varchar(255)  COLLATE utf8_general_ci NOT NULL,            
             `meta_description` varchar(255)  COLLATE utf8_general_ci NOT NULL,
             `meta_keywords` varchar(255)  COLLATE utf8_general_ci NOT NULL,
             `meta_robots` varchar(30)  COLLATE utf8_general_ci NOT NULL,             
             `content` text  COLLATE utf8_general_ci NOT NULL,             
             `is_active` enum('YES','NO')  NOT NULL DEFAULT 'NO',             
             `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',             
             `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
             `updated_at` timestamp  NOT NULL ,
     PRIMARY KEY (`id`),      
     UNIQUE KEY `unique_title` (`meta_title`) 
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

--
-- Structure de la table `t_products_taxes`  
--
CREATE TABLE IF NOT EXISTS `t_products_taxes` (
        `id` int(11)  NOT NULL AUTO_INCREMENT,            
             `rate` decimal(6,5) NOT NULL DEFAULT '0.000',
             `description` varchar(255)  NOT NULL,
             `is_active` enum('YES','NO')  NOT NULL DEFAULT 'NO',
             `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
             `updated_at` timestamp  NOT NULL DEFAULT '0000-00-00 00:00:00'   ,
     PRIMARY KEY (`id`),      
      UNIQUE KEY `unique_rate` (`rate`)     
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;