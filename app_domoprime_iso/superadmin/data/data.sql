
INSERT INTO `t_domoprime_iso_occupation` (`id`, `name`) VALUES
(1, '2'),
(2, '1'),
(3, '0');


INSERT INTO `t_domoprime_iso_occupation_i18n` (`id`, `occupation_id`, `lang`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'fr', 'Propriétaire occupant', '2018-05-06 09:18:05', '2018-05-06 09:18:05'),
(2, 2, 'fr', 'Proprietaire non ocupant', '2018-05-06 09:18:19', '2018-05-06 09:18:19'),
(3, 3, 'fr', 'Locataire', '2018-05-06 09:18:30', '2018-05-06 09:18:30');


INSERT INTO `t_domoprime_iso_type_layer` (`id`, `name`) VALUES
(1, '0'),
(2, '1');


INSERT INTO `t_domoprime_iso_type_layer_i18n` (`id`, `type_id`, `lang`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'fr', 'en combles perdus', '2018-05-06 09:18:57', '2018-05-06 09:18:57'),
(2, 2, 'fr', 'en rampant de toitures', '2018-05-06 09:19:07', '2018-05-06 09:19:07');

