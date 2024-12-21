ALTER TABLE `t_customers_meeting` ADD `partner_layer_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `polluter_id`;
ALTER TABLE `t_customers_meeting`  ADD KEY `customers_meeting_partner_layer_00` (`partner_layer_id`);

