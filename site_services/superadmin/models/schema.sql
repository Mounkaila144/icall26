
CREATE TABLE IF NOT EXISTS `t_site_services_server`(
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,      
`host` varchar(255) CHARACTER SET latin1 NOT NULL,
`name` varchar(64) CHARACTER SET latin1 NOT NULL,
`ip`   varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL, 
`login_service` varchar(40) CHARACTER SET latin1 NOT NULL,
`password` varchar(40) CHARACTER SET latin1 NOT NULL,
`is_active`  enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'YES',
 PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `t_site_services_site` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,      
  `host` varchar(255) CHARACTER SET latin1 NOT NULL,
  `db_name` varchar(64) CHARACTER SET latin1 NOT NULL,
  `db_login` varchar(40) CHARACTER SET latin1 NOT NULL DEFAULT 'root',
  `db_password` varchar(40) CHARACTER SET latin1 NOT NULL,
  `db_host` varchar(128) CHARACTER SET latin1 NOT NULL DEFAULT 'localhost',
  `admin_theme` varchar(64) CHARACTER SET latin1 NOT NULL DEFAULT 'theme1',
  `admin_theme_base` varchar(64) COLLATE utf8_bin NOT NULL,
  `admin_available` enum('YES','NO') CHARACTER SET latin1 NOT NULL DEFAULT 'YES',
  `frontend_theme` varchar(64) CHARACTER SET latin1 NOT NULL DEFAULT 'theme1',
  `frontend_theme_base` varchar(64) COLLATE utf8_bin NOT NULL,
  `frontend_available` enum('YES','NO') CHARACTER SET latin1 NOT NULL DEFAULT 'YES',
  `available` enum('YES','NO') CHARACTER SET latin1 NOT NULL DEFAULT 'NO',
  `type` varchar(4) CHARACTER SET latin1 NOT NULL DEFAULT 'ECOM',
  `logo` varchar(64) COLLATE utf8_bin NOT NULL,
  `picture` varchar(64) COLLATE utf8_bin NOT NULL,
  `master` varchar(64) CHARACTER SET latin1 NOT NULL,
  `access_restricted` tinyint(1) NOT NULL,
  `is_customer` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'YES',
  `company` varchar(64) COLLATE utf8_bin NOT NULL,
  `is_uptodate` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
  `banner` varchar(40) CHARACTER SET utf8 NOT NULL,
  `server_id` int(11) unsigned NOT NULL,
  `favicon` varchar(40) CHARACTER SET utf8 NOT NULL,
  `last_connection` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `price` decimal(20,6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

ALTER TABLE `t_site_services_site` ADD CONSTRAINT `site_services_server_0` FOREIGN KEY (`server_id`) REFERENCES `t_site_services_server` (`id`) ON DELETE CASCADE;


