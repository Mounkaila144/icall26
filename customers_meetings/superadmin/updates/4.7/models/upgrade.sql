ALTER TABLE `t_customers_meeting` ADD CONSTRAINT `customers_meeting_00` FOREIGN KEY (`customer_id`) REFERENCES `t_customers` (`id`) ON DELETE CASCADE;
  

