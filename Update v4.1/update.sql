ALTER TABLE `ce_settings` ADD `show_operator_status` INT(11) NOT NULL AFTER `referral_min_withdrawal`, ADD `operator_status` INT(11) NOT NULL AFTER `show_operator_status`, ADD `show_worktime` INT(11) NOT NULL AFTER `operator_status`, ADD `worktime_start` VARCHAR(11) NOT NULL AFTER `show_worktime`, ADD `worktime_end` VARCHAR(11) NOT NULL AFTER `worktime_start`, ADD `worktime_gmt` VARCHAR(11) NOT NULL AFTER `worktime_end`;
ALTER TABLE `ce_settings` ADD `enable_recaptcha` INT(11) NOT NULL AFTER `worktime_gmt`, ADD `recaptcha_publickey` VARCHAR(255) NOT NULL AFTER `enable_recaptcha`, ADD `recaptcha_privatekey` VARCHAR(255) NOT NULL AFTER `recaptcha_publickey`;
ALTER TABLE `ce_settings` ADD `expire_uncompleted_time` INT(11) NOT NULL AFTER `recaptcha_privatekey`;

CREATE TABLE IF NOT EXISTS `ce_operators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NULL,
  `username` varchar(255) NULL,
  `password` varchar(255) NULL,
  `name` varchar(255) NULL,
  `can_login` int(11) NULL, 
  `can_manage_gateways` int(11) NULL, 
  `can_manage_directions` int(11) NULL, 
  `can_manage_rates` int(11) NULL, 
  `can_manage_rules` int(11) NULL,
  `can_manage_orders` int(11) NULL, 
  `can_manage_users` int(11) NULL, 
  `can_manage_reviews` int(11) NULL, 
  `can_manage_withdrawals` int(11) NULL, 
  `can_manage_support_tickets` int(11) NULL, 
  `can_manage_news` int(11) NULL, 
  `can_manage_pages` int(11) NULL, 
  `can_manage_faq` int(11) NULL, 
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ce_operators_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NULL,
  `activity_type` varchar(255) NULL,
  `activity_id` varchar(255) NULL,
  `activity_value` varchar(255) NULL,
  `ip` varchar(255) NULL,
  `created` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

ALTER TABLE `ce_tickets` ADD `served_level` INT(11) NOT NULL AFTER `status`;