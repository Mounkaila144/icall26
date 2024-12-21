--
-- Structure de la table `t_app_mutual_engine_calculation_meeting_scheduler`  
--
CREATE TABLE IF NOT EXISTS `t_app_mutual_engine_calculation_meeting_scheduler` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,  
    `meeting_id` int(11) unsigned NOT NULL,
    `date_calculation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `is_process` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
    `in_process` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
    `is_completed` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
    `position` int(11) NOT NULL,
    `number_of_results` int(11) DEFAULT NULL,
    `has_error` enum('YES','NO') NOT NULL DEFAULT 'NO',
    `error_code` int(11) NOT NULL,   
    `is_active` enum('YES','NO') COLLATE utf8_bin NOT NULL DEFAULT 'NO',
    `status` enum('ACTIVE','DELETE') COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE',
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',             
    PRIMARY KEY (`id`)      
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Constraint on table `t_app_mutual_engine_calculation_meeting_scheduler`
--
ALTER TABLE `t_app_mutual_engine_calculation_meeting_scheduler` ADD CONSTRAINT `fk_app_mutual_engine_calculation_meeting_scheduler_1` FOREIGN KEY (`meeting_id`) REFERENCES `t_customers_meeting` (`id`) ON DELETE CASCADE;
