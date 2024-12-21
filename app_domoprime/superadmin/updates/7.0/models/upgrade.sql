 --
-- Structure de la table `t_domoprime_subvention_type`  
--
CREATE TABLE IF NOT EXISTS `t_domoprime_subvention_type` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,            
        `name` varchar(64)  NOT NULL,          
        `commercial` varchar(64) NOT NULL,              
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp NULL DEFAULT NULL,  
     PRIMARY KEY (`id`)      
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1;


ALTER TABLE `t_domoprime_quotation` ADD `subvention_type_id`  int(11) unsigned NULL DEFAULT NULL AFTER `work_id`;