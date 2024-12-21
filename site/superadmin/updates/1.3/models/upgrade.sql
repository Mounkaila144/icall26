ALTER TABLE `t_sites` add last_connection timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `t_sites` ADD `price` decimal(20,6) NOT NULL;