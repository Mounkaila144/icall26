ALTER TABLE `t_customers_meeting` ADD `lock_user_id` int(11) NOT NULL AFTER `is_confirmed`;
ALTER TABLE `t_customers_meeting` ADD `lock_time` TIME NULL AFTER `is_confirmed`;
ALTER TABLE `t_customers_meeting` ADD `is_locked` enum('YES','NO')  NOT NULL DEFAULT 'NO' AFTER `is_confirmed`;

