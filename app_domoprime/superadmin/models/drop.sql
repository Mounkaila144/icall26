-- Table linked by foreign keys
DELETE FROM `t_domoprime_energy`;
DROP TABLE IF EXISTS `t_domoprime_energy_i18n`;
DELETE FROM `t_domoprime_class`;
DROP TABLE IF EXISTS `t_domoprime_class_i18n`;
DELETE FROM `t_domoprime_calculation`;
DROP TABLE IF EXISTS `t_domoprime_product_calculation`
-- Tables without foreign key
DROP TABLE IF EXISTS `t_domoprime_zone`;
DROP TABLE IF EXISTS `t_domoprime_energy`;
DROP TABLE IF EXISTS `t_domoprime_class`;
DROP TABLE IF EXISTS `t_domoprime_product_sector_energy` ;
DROP TABLE IF EXISTS `t_domoprime_calculation`;
DROP TABLE IF EXISTS `t_domoprime_sector`;