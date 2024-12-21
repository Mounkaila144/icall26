ALTER TABLE `t_group_permission` ADD  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `group_id`;
ALTER TABLE `t_group_permission` ADD  `updated_at` timestamp NOT NULL AFTER `created_at`;

ALTER TABLE `t_user_permission` ADD  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `user_id`;
ALTER TABLE `t_user_permission` ADD  `updated_at` timestamp NOT NULL AFTER `created_at`;