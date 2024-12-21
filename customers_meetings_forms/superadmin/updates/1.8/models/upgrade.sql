ALTER TABLE `t_customers_meeting_forms` ADD `is_exported` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO' AFTER `is_hold`;
