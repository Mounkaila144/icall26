--
-- Structure de la table `t_partners_company`
--

CREATE TABLE IF NOT EXISTS `t_partners_company` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,  
  `ape` varchar(11) COLLATE utf8_bin NOT NULL,  
  `siret` varchar(14) COLLATE utf8_bin NOT NULL,
  `tva` varchar(13) COLLATE utf8_bin NOT NULL,  
  `coordinates` varchar(64) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `web` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mobile` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `phone` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `fax` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `address1` varchar(255) COLLATE utf8_bin NOT NULL,
  `address2` varchar(255) COLLATE utf8_bin NOT NULL,
  `postcode` varchar(10) COLLATE utf8_bin NOT NULL,
  `city` varchar(128) COLLATE utf8_bin NOT NULL,
  `country` varchar(2) COLLATE utf8_bin NOT NULL,
  `state` varchar(50) COLLATE utf8_bin NOT NULL, 
  `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `status` enum('ACTIVE','DELETED') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`) 
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Structure de la table `t_partners_files`
--

CREATE TABLE IF NOT EXISTS `t_partners_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,    
  `file` varchar(255) COLLATE utf8_bin NOT NULL,    
  `company_id` int(11) unsigned NOT NULL,
  `status` enum('ACTIVE','DELETED') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`) 
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

ALTER TABLE `t_partners_files` ADD CONSTRAINT `partners_file_0` FOREIGN KEY (`company_id`) REFERENCES `t_partners_company` (`id`) ON DELETE CASCADE;

--
-- Structure de la table `t_partners_contact`
--
CREATE TABLE IF NOT EXISTS `t_partners_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,  
  `company_id` int(11) unsigned NOT NULL,
  `sex` enum('Mr','Ms','Mrs') DEFAULT NULL,
  `firstname` varchar(16) COLLATE utf8_bin DEFAULT NULL,
  `lastname` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',  
  `phone` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `mobile` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `fax` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '', 
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',  
  `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`)     
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

ALTER TABLE `t_partners_contact` ADD CONSTRAINT `t_partners_contact_0` FOREIGN KEY (`company_id`) REFERENCES `t_partners_company` (`id`) ON DELETE CASCADE;
