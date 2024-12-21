ALTER TABLE `t_partner_polluter_quotation`  ADD   `pre_model_id` int(11) unsigned NULL DEFAULT NULL AFTER  `model_id`; 
ALTER TABLE `t_partner_polluter_quotation`  ADD   `post_model_id` int(11) unsigned NULL DEFAULT NULL AFTER  `pre_model_id`; 

ALTER TABLE `t_partner_polluter_quotation` ADD CONSTRAINT `partners_polluter_quotation_fk1` FOREIGN KEY (`pre_model_id`) REFERENCES `t_partner_polluter_model` (`id`) ON DELETE CASCADE;
ALTER TABLE `t_partner_polluter_quotation` ADD CONSTRAINT `partners_polluter_quotation_fk2` FOREIGN KEY (`post_model_id`) REFERENCES `t_partner_polluter_model` (`id`) ON DELETE CASCADE;