ALTER TABLE `t_domoprime_polluter_property` ADD `ite_prime` DECIMAL(10,2) NULL DEFAULT NULL AFTER `prime`;    
ALTER TABLE `t_domoprime_polluter_property` ADD `ana_prime` DECIMAL(10,2) NULL DEFAULT NULL AFTER `ite_prime`;    
ALTER TABLE `t_domoprime_polluter_class` ADD `ite_prime` DECIMAL(10,2) NULL DEFAULT NULL AFTER `pack_prime`;    
ALTER TABLE `t_domoprime_polluter_class` ADD `ana_prime` DECIMAL(10,2) NULL DEFAULT NULL AFTER `pack_prime`;    

ALTER TABLE `t_domoprime_polluter_property` DROP `ana_classic`,DROP `ana_modest`,DROP `ana_very_modest`;