ALTER TABLE `t_app_mutual_engine_calculation_meeting` ADD `is_last` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO' AFTER `date_calculation`;