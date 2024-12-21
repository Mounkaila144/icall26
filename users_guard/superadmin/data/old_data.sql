
INSERT INTO `t_groups` (`id`, `is_active`, `name`, `created_at`, `updated_at`, `application`) VALUES
(1, 'YES', 'admin', '2011-11-07 11:26:44', '2011-11-07 11:26:44', 'admin'),
(2, 'YES', 'customer', '2011-11-07 11:26:44', '2011-11-07 11:26:44', 'frontend');

INSERT INTO `t_user_group` (`id`, `group_id`, `user_id`, `is_active`) VALUES
(1, 1, 1, 'YES'),
(2, 2, 2, 'YES');


INSERT INTO `t_permissions` (`id`, `name`, `created_at`, `updated_at`, `application`) VALUES
(1, 'admin', '2013-09-01 23:41:14', '0000-00-00 00:00:00', 'admin'),
(2, 'frontend', '2013-09-01 23:41:14', '0000-00-00 00:00:00', 'frontend');


INSERT INTO `t_group_permission` (`id`,`permission_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 2);


--
-- Contenu de la table `t_sessions`
--


