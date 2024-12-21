CREATE TABLE IF NOT EXISTS `t_customers_meetings_imports_google_sheet_format` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `leaf_name` VARCHAR(255) NOT NULL,
    `leaf_id` VARCHAR(255) NOT NULL,
    `file_name` VARCHAR(255) NOT NULL,
    `file_id` VARCHAR(255) NOT NULL,
    `number_of_lines` int(11) unsigned NOT NULL,
    `columns` TEXT NOT NULL,
    `processed_rows` int(11) unsigned NOT NULL DEFAULT 0,
    `success_count` int(11) unsigned NOT NULL DEFAULT 0,
    `error_count` int(11) unsigned NOT NULL DEFAULT 0,
    `last_offset` int(11) unsigned NOT NULL DEFAULT 0,
    `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `t_customers_meetings_imports_google_sheet_log` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `log` TEXT NOT NULL,
    `format_id` INT(11) UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`format_id`) REFERENCES `t_customers_meetings_imports_google_sheet_format`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

