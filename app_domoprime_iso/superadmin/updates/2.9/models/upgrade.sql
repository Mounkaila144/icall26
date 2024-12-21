ALTER TABLE `t_domoprime_iso_customer_request` ADD `counter_type_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `previous_energy_id`; 
ALTER TABLE `t_domoprime_iso_customer_request` ADD `equipment_type_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `counter_type_id`;   
ALTER TABLE `t_domoprime_iso_customer_request` ADD `house_type_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `equipment_type_id`; 
ALTER TABLE `t_domoprime_iso_customer_request` ADD `roof_type1_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `house_type_id`; 
ALTER TABLE `t_domoprime_iso_customer_request` ADD `roof_type2_id` INT(11) UNSIGNED NULL DEFAULT NULL AFTER `roof_type1_id`; 
ALTER TABLE `t_domoprime_iso_customer_request` ADD `build_year` VARCHAR(4)  NOT NULL DEFAULT '' AFTER `roof_type2_id`;  
 