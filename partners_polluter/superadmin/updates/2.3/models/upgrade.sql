ALTER TABLE `t_partner_polluter_company` ADD `layer_id` int(11) unsigned NULL DEFAULT NULL AFTER `is_default`;
       
ALTER TABLE `t_partner_polluter_company` ADD INDEX `layer_id` ( `layer_id` );
