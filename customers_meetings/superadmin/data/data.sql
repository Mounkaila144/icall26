
--
-- Contenu de la table `t_customers_meeting`
--

INSERT INTO `t_customers_meeting` (`id`, `customer_id`, `in_at`, `out_at`, `state_id`, `telepro_id`, `sales_id`, `status`, `is_confirmed`, `created_at`, `updated_at`) VALUES
(3, 7, '2014-07-15 00:00:00', '0000-00-00', 2, 111, 113, 'ACTIVE', 'NO', '2014-08-19 10:53:09', '2014-08-19 10:53:09'),
(4, 8, '2014-09-15 00:00:00', '0000-00-00', 2, 112, 114, 'ACTIVE', 'NO', '2014-08-19 15:44:35', '2014-08-19 15:44:35'),
(5, 9, '2015-12-15 00:00:00', '0000-00-00', 2, 3, 3, 'ACTIVE', 'NO', '2014-08-19 17:26:33', '2014-08-19 17:26:33');

--
-- Contenu de la table `t_customers_meeting_status`
--

INSERT INTO `t_customers_meeting_status` (`id`, `name`, `color`, `icon`) VALUES
(1, 'INPROGRESS', '#FF0000', ''),
(2, 'WAITING', '#0000FF', 'icon.png'),
(4, 'test', '', 'icon.png');

--
-- Contenu de la table `t_customers_meeting_status_i18n`
--

INSERT INTO `t_customers_meeting_status_i18n` (`id`, `status_id`, `lang`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'fr', 'En cours', '2014-08-11 16:04:05', '2014-08-14 12:49:27'),
(2, 2, 'fr', 'En attente', '2014-08-14 12:41:35', '2014-08-14 12:41:35'),
(4, 4, 'fr', 'test', '2014-08-14 13:42:18', '2014-08-14 13:42:18');