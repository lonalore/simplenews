#
# Simplenews newsletter categories.
#
CREATE TABLE `simplenews_category` (
`id` int(11) UNSIGNED NOT NULL COMMENT 'Category ID.',
`name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Category name.',
`format` varchar(8) NOT NULL DEFAULT '' COMMENT 'Format of the newsletter email (plain, html).',
`priority` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Email priority according to RFC 2156 and RFC 5231 (0 = none; 1 = highest; 2 = high; 3 = normal; 4 = low; 5 = lowest).',
`receipt` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Boolean indicating request for email receipt confirmation according to RFC 2822.',
`from_name` varchar(128) NOT NULL DEFAULT '' COMMENT 'Sender name for newsletter emails.',
`email_subject` varchar(255) NOT NULL DEFAULT '' COMMENT 'Subject of newsletter email.',
`from_address` varchar(64) NOT NULL DEFAULT '' COMMENT 'Sender address for newsletter emails.',
`hyperlinks` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Flag indicating type of hyperlink conversion (1 = hyperlinks are in-line; 0 = hyperlinks are placed at email bottom).',
`new_account` varchar(12) NOT NULL DEFAULT '' COMMENT 'How to treat subscription at account creation (none = None; on = Default on; off = Default off; silent = Invisible subscription).',
`opt_inout` varchar(12) NOT NULL DEFAULT '' COMMENT 'How to treat subscription confirmation (hidden = Newsletter is hidden from the user; single = Single opt-in; double = Double opt-in).',
`menu` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'For this category a subscription menu is available.',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
# --------------------------------------------------------

#
# Simplenews newsletter data.
#
CREATE TABLE `simplenews_newsletter` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Newsletter ID.',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
# --------------------------------------------------------

#
# Subscribers to {simplenews_category}. Many-to-many relation via {simplenews_subscription}
#
CREATE TABLE `simplenews_subscriber` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Subscriber ID.',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
# --------------------------------------------------------

#
# Newsletter subscription data. Which subscriber is subscribed to which mailing list.
#
CREATE TABLE `simplenews_subscription` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Subscription ID.',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
# --------------------------------------------------------

#
# Spool for temporary storage of newsletter emails.
#
CREATE TABLE `simplenews_mail_spool` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'The primary identifier for a mail spool record.',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
# --------------------------------------------------------
