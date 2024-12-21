ALTER TABLE `t_domoprime_class` CHANGE `multiple` `multiple` DECIMAL(20,6) NOT NULL DEFAULT '1';
ALTER TABLE `t_domoprime_class` ADD `multiple_floor` DECIMAL(20,9)  NULL DEFAULT NULL AFTER `multiple`;
ALTER TABLE `t_domoprime_class` ADD `multiple_top` DECIMAL(20,9)  NULL DEFAULT NULL AFTER `multiple_floor`;
ALTER TABLE `t_domoprime_class` ADD `multiple_wall` DECIMAL(20,9)  NULL DEFAULT NULL AFTER `multiple_top`;

ALTER TABLE `t_domoprime_polluter_class` ADD `multiple_floor` DECIMAL(20,9)  NULL DEFAULT NULL AFTER `multiple`;
ALTER TABLE `t_domoprime_polluter_class` ADD `multiple_top` DECIMAL(20,9)  NULL DEFAULT NULL AFTER `multiple_floor`;
ALTER TABLE `t_domoprime_polluter_class` ADD `multiple_wall` DECIMAL(20,9)  NULL DEFAULT NULL AFTER `multiple_top`;