DELETE  FROM `t_modules` WHERE name='partners_recipient'

ALTER TABLE `t_domoprime_quotation` DROP `tax_credit_available`;
ALTER TABLE `t_domoprime_billing`
  DROP `tax_credit_available`,
  DROP `one_euro`;