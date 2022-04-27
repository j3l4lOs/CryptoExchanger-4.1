CREATE TABLE IF NOT EXISTS `ce_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NULL,
  `description` varchar(255) NULL,
  `keywords` varchar(255) NULL,
  `name` varchar(255) NULL,
  `url` varchar(255) NULL,
  `infoemail` varchar(255) NULL,
  `supportemail` varchar(255) NULL,
  `order_type` int(11) NULL,
  `purchase_code` varchar(255) NULL,
  `invest_plugin` int(0) NULL,
  `default_language` varchar(255) NULL,
  `default_template` varchar(255) NULL,
  `curcnv_api` varchar(255) NULL,
  `au_rate_int` int(11) NULL,
  `referral_comission` varchar(10) NULL,
  `referral_min_withdrawal` varchar(10) NULL,
  `show_operator_status` int(11) NULL,
  `operator_status` int(11) NULL,
  `show_worktime` int(11) NULL,
  `worktime_start` varchar(11) NULL,
  `worktime_end` varchar(11) NULL,
  `worktime_gmt` varchar(11) NULL,
  `enable_recaptcha` int(11) NULL,
  `recaptcha_publickey` varchar(255) NULL,
  `recaptcha_privatekey` varchar(255) NULL,
  `expire_uncompleted_time` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
    
CREATE TABLE IF NOT EXISTS `ce_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NULL,
  `username` varchar(255) NULL,
  `password` varchar(255) NULL,
  `password_hash` varchar(255) NULL,
  `email_hash` varchar(255) NULL,
  `email_verified` int(11) NULL,
  `status` int(11) NULL,
  `ip` varchar(255) NULL,
  `twoFA` int(11) NULL,
  `registered_on` varchar(255) NULL,
  `last_login` varchar(255) NULL,
  `first_name` varchar(255) NULL,
  `last_name` varchar(255) NULL,
  `birthday_date` varchar(255) NULL,
  `country` varchar(255) NULL,
  `city` varchar(255) NULL,
  `zip_code` varchar(255) NULL,
  `address` varchar(255) NULL,
  `mobile_number` varchar(255) NULL,
  `mobile_verified` int(11) NULL,
  `document_verified` int(11) NULL,
  `level` int(11) NULL,
  `close_request` int(11) NULL,
  `discount_level` int(11) NULL,
  `invited_by` int(11) NULL,
  `exchanged_volume` int(11) NULL,
  `documents_pending` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

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

CREATE TABLE IF NOT EXISTS `ce_users_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NULL,
  `document_type` int(11) NULL,
  `document_path` text NULL,
  `uploaded` int(11) NULL,
  `status` int(11) NULL,
  `u_field_1` varchar(255) NULL,
  `u_field_2` varchar(255) NULL,
  `u_field_3` varchar(255) NULL,
  `u_field_4` varchar(255) NULL,
  `u_field_5` varchar(255) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ce_users_earnings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NULL,
  `amount` varchar(255) NULL,
  `currency` varchar(255) NULL,
  `updated` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ce_users_withdrawals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NULL,
  `amount` varchar(255) NULL,
  `currency` varchar(255) NULL,
   `gateway` int(11) NULL,
   `account` varchar(255) NULL,
  `status` int(11) NULL,
  `requested_on` int(11) NULL,
  `processed_on` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ce_users_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NULL,
  `display_name` varchar(255) NULL,
  `order_id` int(11) NULL,
  `comment` varchar(255) NULL,
  `status` int(11) NULL,
  `type` int(11) NULL,
  `posted` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ce_discount_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discount_level` int(11) NULL,
  `from_value` varchar(255) NULL,
  `to_value` varchar(255) NULL,
  `currency` varchar(255) NULL,
  `discount_percentage` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ce_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NULL,
  `title` varchar(255) NULL,
  `hash` varchar(255) NULL,
  `content` text NULL,
  `order_id` int(11) NULL,
  `created` int(11) NULL,
  `updated` int(11) NULL,
  `status` int(11) NULL,
  `served_level` int(11) NULL,
  `served_by` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100000;

CREATE TABLE IF NOT EXISTS `ce_tickets_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NULL,
  `message` text NULL,
  `author` int(11) NULL,
  `created` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ce_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NULL,
  `gateway_send` int(11) NULL,
  `gateway_receive` int(11) NULL,
  `amount_send` varchar(255) NULL,
  `amount_receive` varchar(255) NULL,
  `rate_from` varchar(255) NULL,
  `rate_to` varchar(255) NULL,
  `currency_from` varchar(255) NULL,
  `currency_to` varchar(255) NULL,
  `u_field_1` varchar(255) NULL,
  `u_field_2` varchar(255) NULL,
  `u_field_3` varchar(255) NULL,
  `u_field_4` varchar(255) NULL,
  `u_field_5` varchar(255) NULL,
  `u_field_6` varchar(255) NULL,
  `u_field_7` varchar(255) NULL,
  `u_field_8` varchar(255) NULL,
  `u_field_9` varchar(255) NULL,
  `u_field_10` varchar(255) NULL,
  `transaction_send` varchar(255) NULL,
  `transaction_receive` varchar(255) NULL,
  `order_hash` varchar(255) NULL,
  `ip` varchar(255) NULL,
  `status` int(11) NULL,
  `created` int(11) NULL,
  `updated` int(11) NULL,
  `expired` int(11) NULL,
  `refereer` int(11) NULL,
  `refereer_comission` varchar(255) NULL,
  `refereer_comission_currency` varchar(255) NULL,
  `refereer_set` int(11) NULL,
  `processed_by` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1000000;

CREATE TABLE IF NOT EXISTS `ce_orders_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NULL,
  `filename` varchar(255) NULL,
  `filesize` varchar(255) NULL,
  `filepath` text NULL,
  `uploaded` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ce_orders_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NULL,
  `field_id` varchar(255) NULL,
  `field_value` varchar(255) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ce_gateways` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NULL,
  `currency` varchar(255) NULL,
  `min_amount` varchar(255) NULL,
  `max_amount` varchar(255) NULL,
  `reserve` varchar(255) NULL,
  `include_fee` int(11) NULL,
  `extra_fee` varchar(255) NULL,
  `fee` int(11) NULL,
  `allow_send` int(11) NULL,
  `require_login` int(11) NULL,
  `require_email_verify` int(11) NULL,
  `require_mobile_verify` int(11) NULL,
  `require_document_verify` int(11) NULL,
  `allow_attachments` int(11) NULL,
  `max_attachments` int(11) NULL,
  `require_attachments` int(11) NULL,
  `g_field_1` varchar(255) NULL,
  `g_field_2` varchar(255) NULL,
  `g_field_3` varchar(255) NULL,
  `g_field_4` varchar(255) NULL,
  `g_field_5` varchar(255) NULL,
  `g_field_6` varchar(255) NULL,
  `g_field_7` varchar(255) NULL,
  `g_field_8` varchar(255) NULL,
  `g_field_9` varchar(255) NULL,
  `g_field_10` varchar(255) NULL,
  `manual_payment` int(11) NULL,
  `external_gateway` int(11) NULL,
  `external_icon` varchar(255) NULL,
  `is_crypto` int(11) NULL DEFAULT '0',
  `merchant_source` varchar(255) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ce_reserve_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gateway_id` int(11) NULL,
  `email` varchar(255) NULL,
  `amount` varchar(255) NULL,
  `requested_on` int(11) NULL,
  `updated_on` int(11) NULL,
  `updated_by` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ce_gateways_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gateway_id` int(11) NULL,
  `type` int(11) NULL,
  `field_name` varchar(255) NULL,
  `field_number` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ce_gateways_directions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gateway_id` int(11) NULL,
  `directions` varchar(255) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ce_gateways_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gateway_from` int(11) NULL,
  `gateway_to` int(11) NULL,
  `exchange_rules` text NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ce_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gateway_from` int(11) NULL,
  `gateway_to` int(11) NULL,
  `rate_from` varchar(255) NULL,
  `rate_to` varchar(255) NULL,
  `percentage_rate` int(11) NULL,
  `fee` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ce_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(255) NULL,
  `title` varchar(255) NULL,
  `content` text NULL,
  `created` int(11) NULL,
  `updated` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `ce_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NULL,
  `content` text NULL,
  `created` int(11) NULL,
  `updated` int(11) NULL,
  `views` int(11) NULL,
  `author` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `ce_faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NULL,
  `answer` text NULL,
  `created` int(11) NULL,
  `updated` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
