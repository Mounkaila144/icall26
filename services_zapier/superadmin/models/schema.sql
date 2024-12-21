CREATE TABLE `t_services_zapier_oauth_clients`
(
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(40) NOT NULL,
    `client_id`     VARCHAR(80) NOT NULL,
    `client_secret` VARCHAR(80) NOT NULL,
    `redirect_uri`  VARCHAR(2000),
    `grant_types`   VARCHAR(80),
    `scope`         VARCHAR(4000),
    `user_id`       VARCHAR(80),
    PRIMARY KEY (`id`),
    UNIQUE KEY (`client_id`) -- Ajout d'une contrainte UNIQUE sur client_id
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `t_services_zapier_oauth_access_tokens`
(
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `access_token` VARCHAR(40) NOT NULL,
    `client_id`    VARCHAR(80) NOT NULL,
    `user_id`      VARCHAR(80),
    `expires`      TIMESTAMP   NOT NULL,
    `scope`        VARCHAR(4000),
    PRIMARY KEY (`id`),
    FOREIGN KEY (`client_id`) REFERENCES `t_services_zapier_oauth_clients` (`client_id`)
        ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `t_services_zapier_oauth_refresh_tokens`
(
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `refresh_token` VARCHAR(40) NOT NULL,
    `client_id`     VARCHAR(80) NOT NULL,
    `user_id`       VARCHAR(80),
    `expires`       TIMESTAMP   NOT NULL,
    `scope`         VARCHAR(4000),
    PRIMARY KEY (`id`),
    FOREIGN KEY (`client_id`) REFERENCES `t_services_zapier_oauth_clients` (`client_id`)
        ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `t_services_zapier_oauth_authorization_codes`
(
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `authorization_code` VARCHAR(40) NOT NULL,
    `client_id`          VARCHAR(80) NOT NULL,
    `user_id`            VARCHAR(80),
    `redirect_uri`       VARCHAR(2000),
    `expires`            TIMESTAMP   NOT NULL,
    `scope`              VARCHAR(4000),
    PRIMARY KEY (`id`),
    FOREIGN KEY (`client_id`) REFERENCES `t_services_zapier_oauth_clients` (`client_id`)
        ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `t_services_zapier_oauth_scopes`
(
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `scope`      VARCHAR(80) NOT NULL,
    `is_default` BOOLEAN,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;






