
--
-- Contenu de la table `t_customers_contracts_status`
--

INSERT INTO `t_customers_contracts_status` (`id`, `name`, `color`, `icon`) VALUES
(10, 'ToShift', '#0000FF', ''),
(11, 'InProgress', '#00FF00', ''),
(12, 'Signed', '', 'icon.png'),
(13, 'Cancelled', '#FF0000', ''),
(14, '', '', ''),
(15, '', '#FFFF00', ''),
(16, '', '', '');

--
-- Contenu de la table `t_customers_contracts_status_i18n`
--

INSERT INTO `t_customers_contracts_status_i18n` (`id`, `status_id`, `lang`, `value`, `created_at`, `updated_at`) VALUES
(8, 10, 'fr', 'A décaler', '2014-08-05 14:38:20', '2014-08-05 14:38:20'),
(9, 11, 'fr', 'En cours', '2014-08-05 14:43:51', '2014-08-05 14:43:51'),
(10, 12, 'fr', 'Signé', '2014-08-05 14:44:30', '2014-08-05 14:44:30'),
(11, 13, 'fr', 'Annuler', '2014-08-05 14:44:39', '2014-08-05 14:44:39'),
(12, 14, 'fr', 'Hors critère', '2014-08-05 14:44:48', '2014-08-05 14:44:48'),
(13, 15, 'fr', 'R2', '2014-08-05 14:44:54', '2014-08-05 14:44:54'),
(14, 16, 'fr', 'Négatif', '2014-08-05 14:51:47', '2014-08-05 14:51:47');