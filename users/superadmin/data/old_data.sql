--
-- Contenu de la table `t_users`
--

--INSERT INTO `t_users` (`id`, `username`, `password`, `sex`, `firstname`, `lastname`, `email`, `picture`, `phone`, `mobile`, `birthday`, `is_active`, `is_guess`, `created_at`, `updated_at`, `last_password_gen`, `lastlogin`, `application`) VALUES
--(1, 'fmalletad', '6c8a131351de164d49044575bb65324f', NULL, 'frédéric', 'mallet', 'fd.mallet@ewebsolutions.fr', '', '', '', NULL, 'YES', 'NO', '2011-11-06 10:26:44', '2013-10-07 15:00:54', '2013-10-07 14:59:39', '2013-10-07 15:00:54', 'admin'),
--(2, 'fmalletfe', '87a038097a6b8df2fcd383689e53f971', NULL, 'frédéric', 'mallet', 'fd.mallet@ewebsolutions.fr', '', '', '', NULL, 'YES', 'NO', '2011-11-06 10:26:44', '2011-11-06 10:26:44', '2011-11-06 10:26:44', '0000-00-00 00:00:00', 'frontend');


--
-- Contenu de la table `t_users_function`
--

INSERT INTO `t_users_function` (`id`, `name`) VALUES
(1, 'SALES'),
(3, 'TELEPRO'),
(4, 'ADMINISTRATOR'),
(5, 'ASSISTANT'),
(6, 'CHIEFSALES'),
(7, 'CHIEFTELEPRO');

--
-- Contenu de la table `t_users_functions`
--

INSERT INTO `t_users_functions` (`id`, `function_id`, `user_id`) VALUES
(15, 3, 3),
(16, 1, 3),
(17, 6, 3),
(18, 3, 111),
(19, 3, 112),
(20, 1, 113),
(21, 1, 114);

--
-- Contenu de la table `t_users_function_i18n`
--

INSERT INTO `t_users_function_i18n` (`id`, `function_id`, `lang`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'fr', 'Commercial', '2014-08-13 16:09:46', '2014-08-14 09:34:28'),
(3, 3, 'fr', 'Téléprospecteur', '2014-08-13 19:01:21', '2014-08-13 19:01:21'),
(4, 4, 'fr', 'Administrateur', '2014-08-14 09:34:17', '2014-08-14 09:34:17'),
(5, 5, 'fr', 'Assistant(e)', '2014-08-14 09:34:53', '2014-08-14 09:34:53'),
(6, 6, 'fr', 'Responsable commercial', '2014-08-14 09:35:22', '2014-08-14 09:35:22'),
(7, 7, 'fr', 'Responsable téléprospecteurs', '2014-08-14 09:35:42', '2014-08-14 09:35:42');

--
-- Contenu de la table `t_users_team`
--

INSERT INTO `t_users_team` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'team', '2014-08-13 22:06:27', '2014-08-13 22:06:27'),
(4, 'sqdsffsqsqddsfdsfdsfds', '2014-08-13 22:07:43', '2014-08-13 22:36:52');
