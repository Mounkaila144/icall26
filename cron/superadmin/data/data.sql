--
-- Contenu de la table `t_cron`
--
INSERT INTO `t_cron` (`id`,`name`,`title`,`period`,`task`,`site`,`is_active`) VALUES
(1,'task2_update','tache2 du bonheur','*|*|*|*|*','/cron/test2','','YES'), 
(2,'cron1','cron 1 title','*|*|*|*|*','task1','','YES'),
(3,'cron2','cron 2 title','*|*|*|*|*','task2','','YES');

