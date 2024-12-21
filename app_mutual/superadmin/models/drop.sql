-- Drop foreign keys constraint
ALTER TABLE `t_app_mutual_product` DROP FOREIGN KEY `fk_mutual_product_partner`;
ALTER TABLE `t_app_mutual_partner_params` DROP FOREIGN KEY `fk_mutual_partner_params_1`;
ALTER TABLE `t_app_mutual_commission` DROP FOREIGN KEY `fk_mutual_commission_1`;
ALTER TABLE `t_app_mutual_decommission` DROP FOREIGN KEY `fk_mutual_decommission_1`;

ALTER TABLE `t_app_mutual_customers_meeting_products` DROP FOREIGN KEY `fk_customers_meeting_mutual_products_1`;
ALTER TABLE `t_app_mutual_customers_meeting_products` DROP FOREIGN KEY `fk_customers_meeting_mutual_products_2`;

ALTER TABLE `t_app_mutual_engine_calculation_meeting` DROP FOREIGN KEY `fk_app_mutual_engine_calculation_meeting_1`;

ALTER TABLE `t_app_mutual_engine_calculation_mutual` DROP FOREIGN KEY `fk_app_mutual_engine_calculation_mutual_1`;
ALTER TABLE `t_app_mutual_engine_calculation_mutual` DROP FOREIGN KEY `fk_app_mutual_engine_calculation_mutual_2`;
ALTER TABLE `t_app_mutual_engine_calculation_product` DROP FOREIGN KEY `fk_app_mutual_engine_calculation_product_1`;
ALTER TABLE `t_app_mutual_engine_calculation_product` DROP FOREIGN KEY `fk_app_mutual_engine_calculation_product_2`;
ALTER TABLE `t_app_mutual_engine_calculation_product` DROP FOREIGN KEY `fk_app_mutual_engine_calculation_product_3`;

-- Table linked by foreign keys
 DROP TABLE IF EXISTS `t_app_mutual_partner_params`;
 DROP TABLE IF EXISTS `t_app_mutual_customers_meeting_products`;
 DROP TABLE IF EXISTS `t_app_mutual_product`;
 DROP TABLE IF EXISTS `t_app_mutual_commission`;
 DROP TABLE IF EXISTS `t_app_mutual_decommission`;
 
 DROP TABLE IF EXISTS `t_app_mutual_engine_calculation_product`;
 DROP TABLE IF EXISTS `t_app_mutual_engine_calculation_mutual`;
 DROP TABLE IF EXISTS `t_app_mutual_engine_calculation_meeting`;