ALTER TABLE `t_domoprime_quotation` ADD `mode` ENUM('simple','multiple') NOT NULL DEFAULT 'simple' AFTER `dated_at`;     