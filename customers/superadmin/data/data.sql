--
-- Contenu de la table `t_customers`
--

INSERT INTO `t_customers` (`id`, `gender`, `firstname`, `lastname`, `email`, `phone`, `mobile`, `phone1`, `birthday`, `salary`, `age`, `occupation`, `union_id`, `created_at`, `updated_at`, `status`) VALUES
(7, 'Mr', 'frédéric', 'Mallet', 'contact@ewebsolutions.fr', '0524236587', '0627107296', '', '0000-00-00', '30K€/an', 'env 45', 'Artisant', 7, '2014-08-19 10:53:09', '2014-08-19 10:53:09', 'ACTIVE'),
(8, 'Mr', 'frédéric2', 'Mallet2', 'contact2@ewebsolutions.fr', '0524236587', '0627107296', '', '0000-00-00', '30K€/an', 'env 45', 'Artisant', 7, '2014-08-19 15:44:35', '2014-08-19 15:44:35', 'ACTIVE'),
(9, 'Mr', 'frédéric22', 'Mallet222', 'contact2222@ewebsolutions.fr', '0524236587', '0627107296', '', '0000-00-00', '30K€/an', 'env 45', 'Artisant', 7, '2014-08-19 17:26:33', '2014-08-19 17:26:33', 'ACTIVE');

--
-- Contenu de la table `t_customers_address`
--

INSERT INTO `t_customers_address` (`id`, `customer_id`, `address1`, `address2`, `postcode`, `city`, `country`, `state`, `coordinates`, `status`, `created_at`, `updated_at`) VALUES
(4, 7,  'address1', 'address2', '76000', 'city', '', '', '', 'ACTIVE', '2014-08-19 10:53:09', '2014-08-19 10:53:09'),
(5, 8,  'address1', 'address2', '76000', 'city', '', '', '', 'ACTIVE', '2014-08-19 15:44:35', '2014-08-19 15:44:35'),
(6, 9, 'address1', 'address2', '76000', 'city', '', '', '', 'ACTIVE', '2014-08-19 17:26:33', '2014-08-19 17:26:33');

--
-- Contenu de la table `t_customers_contact`
--

INSERT INTO `t_customers_contact` (`id`, `customer_id`, `gender`, `firstname`, `lastname`, `email`, `phone`, `mobile`, `birthday`, `age`, `salary`, `occupation`, `isFirst`, `status`, `created_at`, `updated_at`) VALUES
(3, 7, 'Ms', 'adam', 'Mallet', 'contact@ewebsolutions.fr', '0524236588', '0627107298', '0000-00-00', 'env 35', '40K€/an', 'CDI', 'NO', 'ACTIVE', '2014-08-19 10:53:09', '2014-08-19 10:53:09'),
(4, 8, 'Ms', 'adam2', 'Mallet2', 'contact@ewebsolutions.fr', '0524236588', '0627107298', '0000-00-00', 'env 35', '40K€/an', 'CDI', 'NO', 'ACTIVE', '2014-08-19 15:44:35', '2014-08-19 15:44:35'),
(5, 9, 'Ms', 'adam22', 'Mallet22', 'contact@ewebsolutions.fr', '0524236588', '0627107298', '0000-00-00', 'env 35', '40K€/an', 'CDI', 'NO', 'ACTIVE', '2014-08-19 17:26:33', '2014-08-19 17:26:33');

--
-- Contenu de la table `t_customers_union`
--

INSERT INTO `t_customers_union` (`id`, `name`) VALUES
(2, 'MARRIED'),
(3, ''),
(4, ''),
(5, ''),
(6, ''),
(7, '');

--
-- Contenu de la table `t_customers_union_i18n`
--

INSERT INTO `t_customers_union_i18n` (`id`, `union_id`, `lang`, `value`, `created_at`, `updated_at`) VALUES
(2, 2, 'fr', 'marié', '2014-08-16 22:55:56', '2014-08-16 22:55:56'),
(3, 3, 'fr', 'Célibataire', '2014-08-16 22:56:11', '2014-08-16 22:56:11'),
(4, 4, 'fr', 'Veuf', '2014-08-16 22:56:24', '2014-08-16 22:56:24'),
(5, 5, 'fr', 'Divorcé', '2014-08-16 22:56:37', '2014-08-16 22:56:37'),
(6, 6, 'fr', 'Pacs', '2014-08-16 22:56:43', '2014-08-16 22:56:43'),
(7, 7, 'fr', 'Concubinage', '2014-08-16 22:57:00', '2014-08-16 22:57:00');