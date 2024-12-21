ALTER TABLE `t_customers_meeting_forms` ADD `is_hold` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO' AFTER `data`;
