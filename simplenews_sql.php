#
# Simplenews newsletter categories.
#
CREATE TABLE `simplenews_category` (
`sn_ct_id` int(11) UNSIGNED NOT NULL COMMENT 'Category ID.',
`sn_ct_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Category name.',
`sn_ct_format` varchar(8) NOT NULL DEFAULT '' COMMENT 'Format of the newsletter email (plain, html).',
`sn_ct_priority` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Email priority according to RFC 2156 and RFC 5231 (0 = none; 1 = highest; 2 = high; 3 = normal; 4 = low; 5 = lowest).',
`sn_ct_receipt` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Boolean indicating request for email receipt confirmation according to RFC 2822.',
`sn_ct_from_name` varchar(128) NOT NULL DEFAULT '' COMMENT 'Sender name for newsletter emails.',
`sn_ct_email_subject` varchar(255) NOT NULL DEFAULT '' COMMENT 'Subject of newsletter email.',
`sn_ct_from_address` varchar(64) NOT NULL DEFAULT '' COMMENT 'Sender address for newsletter emails.',
`sn_ct_hyperlinks` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Flag indicating type of hyperlink conversion (1 = hyperlinks are in-line; 0 = hyperlinks are placed at email bottom).',
`sn_ct_new_account` varchar(12) NOT NULL DEFAULT '' COMMENT 'How to treat subscription at account creation (none = None; on = Default on; off = Default off; silent = Invisible subscription).',
`sn_ct_opt_inout` varchar(12) NOT NULL DEFAULT '' COMMENT 'How to treat subscription confirmation (hidden = Newsletter is hidden from the user; single = Single opt-in; double = Double opt-in).',
`sn_ct_menu` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'For this category a subscription menu is available.',
PRIMARY KEY (`sn_ct_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
# --------------------------------------------------------

#
# Simplenews newsletter data.
#
CREATE TABLE `simplenews_newsletter` (
`sn_nl_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Newsletter ID.',
PRIMARY KEY (`sn_nl_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
# --------------------------------------------------------

#
# Subscribers to {simplenews_category}. Many-to-many relation via {simplenews_subscription}
#
CREATE TABLE `simplenews_subscriber` (
`sn_ss_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Subscriber ID.',
PRIMARY KEY (`sn_ss_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
# --------------------------------------------------------

#
# Newsletter subscription data. Which subscriber is subscribed to which mailing list.
#
CREATE TABLE `simplenews_subscription` (
`sn_ss_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Subscription ID.',
PRIMARY KEY (`sn_ss_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
# --------------------------------------------------------

#
# Spool for temporary storage of newsletter emails.
#
CREATE TABLE `simplenews_mail_spool` (
`sn_ms_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'The primary identifier for a mail spool record.',
PRIMARY KEY (`sn_ms_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
# --------------------------------------------------------
