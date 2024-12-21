CREATE TABLE IF NOT EXISTS `t_system_menu` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NULL,   
  `menu` varchar(255) COLLATE utf8_bin NULL,   
  `module` varchar(255) COLLATE utf8_bin NULL,   
  `lb` int(11) unsigned NOT NULL DEFAULT '0',
  `rb` int(11) unsigned NOT NULL DEFAULT '0',
  `level` int(11) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


--
CREATE TABLE IF NOT EXISTS `t_system_menu_i18n` (   
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,  
    `menu_id` int(11) unsigned NOT NULL,
    `lang` varchar(2) NOT NULL default '',
    `value` varchar(255) COLLATE utf8_bin NOT NULL,      
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT NULL,
     PRIMARY KEY (`id`),   
    UNIQUE KEY `unique` (`lang`,`menu_id`)     
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `t_system_menu_i18n` ADD CONSTRAINT `t_system_menu_fk0` FOREIGN KEY (`menu_id`) REFERENCES `t_system_menu` (`id`) ON DELETE CASCADE;
