--
-- Structure de la table `t_users`
--

CREATE TABLE IF NOT EXISTS `t_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) COLLATE utf8_bin NOT NULL,
  `password` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `sex` enum('MR','MS','MRS') DEFAULT NULL,
  `firstname` varchar(16) COLLATE utf8_bin DEFAULT NULL,
  `lastname` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `picture` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `phone` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `mobile` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `birthday` date DEFAULT NULL,
  `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO', 
  `is_guess` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO', 
  `last_password_gen` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastlogin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `application` enum('admin','frontend','superadmin') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),  
  UNIQUE KEY `username` (`username`,`application`),
  UNIQUE KEY `email` (`email`,`application`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Structure de la table `t_group`
--

CREATE TABLE IF NOT EXISTS `t_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_active` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `name` varchar(30) COLLATE utf8_bin NOT NULL,   
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `application` enum('admin','frontend','superadmin') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ; 

--
-- Structure de la table `t_user_group`
--

CREATE TABLE IF NOT EXISTS `t_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,    
  `group_id` int(11)  NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` enum('NO','YES') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  PRIMARY KEY (`id`),
  KEY `group` (`group_id`),
  KEY `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contraintes pour la table `t_user_group`
--
ALTER TABLE `t_user_group` ADD CONSTRAINT `users_1` FOREIGN KEY (`user_id`) REFERENCES `t_users` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_user_group` ADD CONSTRAINT `grp_1` FOREIGN KEY (`group_id`) REFERENCES `t_groups` (`id`) ON DELETE CASCADE;

--
-- Structure de la table `t_permission`
--

CREATE TABLE IF NOT EXISTS `t_permissions` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(100) COLLATE utf8_bin NOT NULL,
 `group_id` int(11) unsigned NOT NULL,
 `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
 `application` enum('admin','frontend','superadmin') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Structure de la table `t_user_permission`
--

CREATE TABLE IF NOT EXISTS `t_user_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,    
  `permission_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,  
  PRIMARY KEY (`id`),
  KEY `permission` (`permission_id`),
  KEY `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
--
-- Contraintes pour la table `t_user_permission`
--
ALTER TABLE `t_user_permission` ADD CONSTRAINT `users_2` FOREIGN KEY (`user_id`) REFERENCES `t_users` (`id`) ON DELETE CASCADE;
--
-- Structure de la table `t_group_permission`
--
CREATE TABLE IF NOT EXISTS `t_group_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission` (`permission_id`),
  KEY `group` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contraintes pour la table `t_group_permission`
--
ALTER TABLE `t_group_permission` ADD CONSTRAINT `grp_2` FOREIGN KEY (`group_id`) REFERENCES `t_groups` (`id`) ON DELETE CASCADE;

--
-- Structure de la table `t_user_remember`
--

CREATE TABLE IF NOT EXISTS `t_user_remember` (
  `user_id` int(11) NOT NULL,
  `key` varchar(32) COLLATE utf8_bin NOT NULL,
  `ip` varchar(50) COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `index` (`user_id`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contraintes pour la table `t_group_permission`
--
ALTER TABLE `t_user_remember` ADD CONSTRAINT `user_3` FOREIGN KEY (`user_id`) REFERENCES `t_users` (`id`) ON DELETE CASCADE;
--
-- Structure de la table `t_sessions`
--

CREATE TABLE IF NOT EXISTS `t_sessions` (
  `session` varchar(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` varchar(50) COLLATE utf8_bin NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contraintes pour la table `t_group_permission`
--
ALTER TABLE `t_sessions` ADD CONSTRAINT `user_4` FOREIGN KEY (`user_id`) REFERENCES `t_users` (`id`) ON DELETE CASCADE;


--
-- Structure de la table `t_forgot_password`
--

CREATE TABLE IF NOT EXISTS `t_forgot_password` (
  `user_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(32) COLLATE utf8_bin NOT NULL,
  `key` varchar(40) COLLATE utf8_bin NOT NULL,
  UNIQUE KEY `key` (`key`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contraintes pour la table `t_group_permission`
--
ALTER TABLE `t_forgot_password` ADD CONSTRAINT `user_5` FOREIGN KEY (`user_id`) REFERENCES `t_users` (`id`) ON DELETE CASCADE;


CREATE TABLE IF NOT EXISTS `t_permission_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,  
  `name` varchar(30) COLLATE utf8_bin NOT NULL,     
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ; 

CREATE TABLE IF NOT EXISTS `t_permission_group_i18n` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) unsigned NOT NULL,  
  `lang` varchar(2)  NOT NULL,     
  `value` varchar(100) COLLATE utf8_bin NOT NULL,   
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ; 

ALTER TABLE `t_permission_group_i18n` ADD CONSTRAINT `permission_group_0` FOREIGN KEY (`group_id`) REFERENCES `t_permission_group` (`id`) ON DELETE CASCADE;


-- ALTER TABLE `t_permissions` ADD `group_id` INT( 11 ) UNSIGNED NOT NULL AFTER `name` 
