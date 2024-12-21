CREATE TABLE IF NOT EXISTS `t_utils_openstreet_map_address` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `address` varchar(128) COLLATE utf8_bin NOT NULL,
    `postcode` varchar(10) COLLATE utf8_bin NOT NULL,
    `city` varchar(50) COLLATE utf8_bin NOT NULL,
    `lat` decimal(20,13) NULL DEFAULT NULL,
    `lng` decimal(20,13) NULL DEFAULT NULL,
    `country` varchar(2) COLLATE utf8_bin NOT NULL,
    `signature` varchar(255) COLLATE utf8_bin NOT NULL,
    `error` varchar(255) COLLATE utf8_bin NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;