--
-- Structure de la table `t_modules`  Generated by SuperAdmin Generator date : 25/03/13 16:38:07
-- --   `is_enable` enum('YES','NO')  NOT NULL DEFAULT 'NO',
CREATE TABLE IF NOT EXISTS `t_modules` (
        `id` int(11)  NOT NULL AUTO_INCREMENT,
        `name` varchar(128)  NOT NULL,
        `logo` varchar(255)  NOT NULL,
        `type` varchar(48)  NOT NULL,
        `title` varchar(128) COLLATE utf8_general_ci NOT NULL,  
        `description` text  NOT NULL,  
        `mode` varchar(4) NOT NULL DEFAULT '',
        `status` enum('loaded','installed','uninstalled')  NOT NULL,
        `is_active` enum('YES','NO')  NOT NULL DEFAULT 'NO',    
        `is_available` enum('YES','NO')  NOT NULL DEFAULT 'NO',
        `in_site` enum('YES','NO')  NOT NULL DEFAULT 'NO',
        `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp  NOT NULL DEFAULT '0000-00-00 00:00:00',
      PRIMARY KEY (`id`),
      UNIQUE KEY `unique_name` (`name`)     
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;




