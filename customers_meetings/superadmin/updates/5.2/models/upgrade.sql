ALTER TABLE `t_customers_meeting` ADD `is_hold_quote` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO' AFTER `is_hold`; 

