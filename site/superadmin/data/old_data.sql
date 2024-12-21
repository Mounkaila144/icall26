--
-- Contenu de la table `t_sites`
--

INSERT INTO `t_sites` (`site_id`, `site_host`, `site_db_name`, `site_db_login`, `site_db_password`, `site_db_host`, `site_admin_theme`, `site_admin_available`, `site_frontend_theme`, `site_frontend_available`, `site_available`, `site_type`, `site_master`, `site_access_restricted`) VALUES
(1, 'www.ewebsolutions.fr', 'ewebsolusadmin', 'ewebsolusadmin', '2dgXQTWf', 'mysql51-27.pro', 'theme1', 'NO', 'theme1', 'NO', 'YES', 'ECOM', '', 1),
(2, 'test.ewebsolutions.fr', 'ewebsolusadmin', 'root', '', 'localhost', 'theme1', 'NO', 'theme1', 'NO', 'NO', 'ECOM', '', 0),
(9, 'ewebsolutions.fr', 'ewebsolusadmin', 'ewebsolusadmin', '2dgXQTWf', 'mysql51-27.pro', 'theme1', 'NO', 'theme1', 'NO', 'NO', 'ECOM', '', 0),
(11, 'test2.ewebsolutions.fr', 'ewebsolusite01', 'ewebsolusite01', 'vxuLekwH', 'mysql51-28.pro', 'theme1', 'YES', 'theme1', 'NO', 'YES', 'CMS', '', 1),
(13, 'test3.ewebsolutions.fr', 'site_10278176114eab130971f77', 'root', '', 'localhost', 'theme1', 'NO', 'theme2', 'NO', 'NO', 'CMS', '', 0),
(14, 'test4.ewebsolutions.fr', 'ewebsolusadmin', 'ewebsolusadmin', '2dgXQTWf', 'mysql51-27.pro', 'theme1', 'NO', 'theme1', 'YES', 'YES', 'CMS', '', 1),
(15, 'www.monsys2.net', 'site32', 'root', '', 'localhost', 'theme1', 'YES', 'theme1', 'YES', 'NO', 'CMS', '', 1),
(16, 'domain.monsys2.net', 'site33', 'root', '', 'localhost', 'theme1', 'YES', 'theme1', 'NO', 'YES', 'ECOM', '', 0),
(17, 'toto2.fr', 'site321', 'root', '', 'localhost', 'theme1', 'NO', 'theme1', 'NO', 'NO', 'ECOM', '', 0),
(18, 'rtl2.fr', 'site32é', 'root', '', 'localhost', 'theme1', 'NO', 'theme1', 'NO', 'NO', 'ECOM', '', 0),
(19, 'rtl4.fr', 'site_26344eab12d061efe', 'root', '', 'localhost', 'theme1', 'YES', 'theme1', 'YES', 'NO', 'CMS', '', 0),
(20, 'rtl5.fr', 'site32', 'root', '', 'localhost', 'theme1', 'NO', 'theme1', 'NO', 'NO', 'ECOM', '', 0);
