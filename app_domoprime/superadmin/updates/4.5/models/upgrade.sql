ALTER TABLE `t_domoprime_class` CHANGE `multiple_wall` `multiple_wall` DECIMAL(20,9) NULL DEFAULT NULL;
ALTER TABLE `t_domoprime_class` CHANGE `multiple_top` `multiple_top` DECIMAL(20,9) NULL DEFAULT NULL;
ALTER TABLE `t_domoprime_class` CHANGE `multiple_floor` `multiple_floor` DECIMAL(20,9) NULL DEFAULT NULL;
ALTER TABLE `t_domoprime_class` CHANGE `multiple` `multiple` DECIMAL(20,9) NULL DEFAULT NULL;

ALTER TABLE `t_domoprime_polluter_class` CHANGE `multiple_wall` `multiple_wall` DECIMAL(20,9) NULL DEFAULT NULL;
ALTER TABLE `t_domoprime_polluter_class` CHANGE `multiple_top` `multiple_top` DECIMAL(20,9) NULL DEFAULT NULL;
ALTER TABLE `t_domoprime_polluter_class` CHANGE `multiple_floor` `multiple_floor` DECIMAL(20,9) NULL DEFAULT NULL;
ALTER TABLE `t_domoprime_polluter_class` CHANGE `multiple` `multiple` DECIMAL(20,9) NULL DEFAULT NULL;