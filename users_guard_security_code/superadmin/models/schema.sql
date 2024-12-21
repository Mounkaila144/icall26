CREATE TABLE IF NOT EXISTS `t_users_security_code` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,   
    `code` varchar(32) COLLATE utf8_bin NOT NULL,  
    `number` INT(8) NOT NULL DEFAULT '0',
    `user_id` int(11) NULL DEFAULT NULL, 
    `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',   
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

ALTER TABLE `t_users_security_code` ADD CONSTRAINT `users_security_code_fk1` FOREIGN KEY (`user_id`) REFERENCES `t_users` (`id`) ON DELETE CASCADE;
 

