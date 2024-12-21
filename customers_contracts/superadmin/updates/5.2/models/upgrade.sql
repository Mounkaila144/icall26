ALTER TABLE `t_customers_contract` ADD `is_document` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N' AFTER `dates_opened_at`;
ALTER TABLE `t_customers_contract` ADD `is_photo` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N' AFTER `is_document`;
ALTER TABLE `t_customers_contract` ADD `is_quality` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N' AFTER `is_photo`;