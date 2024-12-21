-- Table linked by foreign keys

DROP TABLE IF EXISTS `t_user_group`;
DROP TABLE IF EXISTS `t_user_permission`;
DROP TABLE IF EXISTS `t_group_permission`;
DROP TABLE IF EXISTS `t_user_remember`;
DROP TABLE IF EXISTS `t_permission_description`;
DROP TABLE IF EXISTS `t_group_description`;
DROP TABLE IF EXISTS `t_sessions`;
DROP TABLE IF EXISTS `t_forgot_password`;
DROP TABLE IF EXISTS `t_permission_group`;
DROP TABLE IF EXISTS `t_permission_group_i18n`;

-- Tables without foreign key
-- DROP TABLE IF EXISTS `t_users`;
DROP TABLE IF EXISTS `t_groups`;
DROP TABLE IF EXISTS `t_permissions`;
