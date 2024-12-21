--
-- Structure de la table `t_customers_contracts_zone`  
--
CREATE TABLE IF NOT EXISTS `t_customers_contracts_zone` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
             `name` varchar(64)  NOT NULL,
             `postcodes` varchar(64)  NOT NULL, 
             `is_active` enum('YES','NO')  NOT NULL DEFAULT 'NO',
             `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
             `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
     PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;