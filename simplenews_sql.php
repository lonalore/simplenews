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
`status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Sent status of the newsletter issue (0 = not sent; 1 = pending; 2 = sent, 3 = send on publish).',
`sent_subscriber_count` int(11) NOT NULL DEFAULT '0' COMMENT 'The count of subscribers to the newsletter when it was sent.',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
# --------------------------------------------------------

#
# Subscribers to {simplenews_category}. Many-to-many relation via {simplenews_subscription}
#
CREATE TABLE `simplenews_subscriber` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Unique subscriber ID.',
`activated` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Boolean indicating the status of the subscription.',
`mail` varchar(64) NOT NULL DEFAULT '' COMMENT 'The email address of the subscriber.',
`user_id` int(11) NOT NULL DEFAULT '0' COMMENT 'The {user}.user_id that has the same email address.',
`language` varchar(12) NOT NULL DEFAULT '' COMMENT 'Subscriber preferred language.',
`timestamp` int(11) NOT NULL DEFAULT '0' COMMENT 'UNIX timestamp of when the user is (un)subscribed.',
`changes` text NOT NULL COMMENT 'Contains the requested subscription changes.',
`created` int(11) NOT NULL DEFAULT '0' COMMENT 'UNIX timestamp of when the subscription record was added.',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
# --------------------------------------------------------

#
# Newsletter subscription data. Which subscriber is subscribed to which mailing list.
#
CREATE TABLE `simplenews_subscription` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Subscription ID.',
`subscriber_id` int(11) NOT NULL DEFAULT '0' COMMENT 'The {simplenews_subscriber}.id who is subscribed.',
`category_id` int(11) NOT NULL DEFAULT '0' COMMENT 'The {simplenews_category}.id the subscriber is subscribed to.',
`status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'A flag indicating whether the user is subscribed (1) or unsubscribed (0).',
`timestamp` int(11) NOT NULL DEFAULT '0' COMMENT 'UNIX timestamp of when the user is (un)subscribed.',
`source` varchar(24) NOT NULL DEFAULT '' COMMENT 'The source via which the user is (un)subscription.',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
# --------------------------------------------------------

#
# Spool for temporary storage of newsletter emails.
#
CREATE TABLE `simplenews_mail_spool` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'The primary identifier for a mail spool record.',
`mail` varchar(255) NOT NULL DEFAULT '' COMMENT 'The formatted email address of mail message recipient.',
`newsletter_id` int(11) NOT NULL DEFAULT '0' COMMENT 'The {simplenews_newsletter}.id of this newsletter.',
`category_id` int(11) NOT NULL DEFAULT '0' COMMENT 'The {simplenews_category}.id this newsletter belongs to.',
`status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'The sent status of the email (0 = hold, 1 = pending, 2 = done).',
`error` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'A boolean indicating whether an error occurred while sending the email.',
`timestamp` int(11) NOT NULL DEFAULT '0' COMMENT 'The time status was set or changed.',
`data` longblob COMMENT 'A serialized array of name value pairs that are related to the email address.',
`subscription_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Foreign key for subscriber table {simplenews_subscription}.id',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
# --------------------------------------------------------
