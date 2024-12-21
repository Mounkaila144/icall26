ALTER TABLE `t_customers_address` ADD `signature` varchar(128) COLLATE utf8_bin DEFAULT NULL AFTER `customer_id`; 
ALTER TABLE `t_customers_address` ADD `lat` decimal(20,13) NULL DEFAULT NULL AFTER `signature`; 
ALTER TABLE `t_customers_address` ADD `lng` decimal(20,13) NULL DEFAULT NULL AFTER `lat`; 

UPDATE `t_customers_address` SET signature = SHA1(UPPER(REPLACE(REPLACE(CONCAT_WS('',address1,address2,postcode,city),' ',''),',','')));
UPDATE `t_customers_address` SET lng=SUBSTRING_INDEX(coordinates,'|',1) WHERE coordinates!='';
UPDATE `t_customers_address` SET lat=SUBSTRING_INDEX(coordinates,'|',-1) WHERE coordinates!='';


-- SELECT SHA1(UPPER(REPLACE(REPLACE(CONCAT_WS('',address1,address2,postcode,city),' ',''),',',''))) FROM `t_customers_address` WHERE id=7791
-- LNG
-- SELECT SUBSTRING_INDEX(coordinates,'|',1) FROM `t_customers_address` WHERE id=7791;
-- LAT
-- SELECT SUBSTRING_INDEX(coordinates,'|',-1) FROM `t_customers_address` WHERE id=7791;