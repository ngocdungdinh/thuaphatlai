/*
Navicat MySQL Data Transfer

Source Server         : localdb
Source Server Version : 50536
Source Host           : localhost:3306
Source Database       : l4cms

Target Server Type    : MYSQL
Target Server Version : 50536
File Encoding         : 65001

Date: 2014-11-24 11:56:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `showon_menu` tinyint(3) NOT NULL,
  `showon_homepage` int(11) NOT NULL,
  `list_layout` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_layout` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_count` int(11) NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'on',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('25', '0', 'Giới thiệu', 'gioi-thieu', '1', '1', null, null, '0', 'on', '1', '2014-09-11 09:25:05', '2014-11-22 04:13:30', null);
INSERT INTO `categories` VALUES ('26', '0', 'Dịch vụ pháp lý', 'dich-vu-phap-ly', '1', '1', null, null, '0', 'on', '1', '2014-11-22 04:15:08', '2014-11-22 04:15:08', null);
INSERT INTO `categories` VALUES ('27', '0', 'Tư vấn', 'tu-van', '1', '2', null, null, '0', 'on', '1', '2014-11-22 04:15:40', '2014-11-22 04:15:40', null);
INSERT INTO `categories` VALUES ('28', '0', 'Văn bản pháp luật', 'van-ban-phap-luat', '1', '1', null, null, '0', 'on', '1', '2014-11-22 04:16:01', '2014-11-22 04:16:01', null);
INSERT INTO `categories` VALUES ('29', '0', 'Tin tức - Sự kiện', 'tin-tuc-su-kien', '1', '1', null, null, '0', 'on', '1', '2014-11-22 04:16:15', '2014-11-22 04:16:15', null);
INSERT INTO `categories` VALUES ('30', '0', 'Tuyển dụng', 'tuyen-dung', '1', '1', null, null, '0', 'on', '1', '2014-11-22 04:21:31', '2014-11-22 04:21:31', null);
INSERT INTO `categories` VALUES ('31', '26', 'Lập vi bằng', 'lap-vi-bang', '1', '1', null, null, '0', 'on', '1', '2014-11-24 02:32:32', '2014-11-24 02:32:32', null);
INSERT INTO `categories` VALUES ('32', '26', 'Thi hành án', 'thi-hanh-an', '1', '1', null, null, '0', 'on', '1', '2014-11-24 02:32:48', '2014-11-24 02:32:48', null);
INSERT INTO `categories` VALUES ('33', '0', 'Xác minh điều kiện', 'xac-minh-dieu-kien', '1', '1', null, null, '0', 'on', '1', '2014-11-24 02:33:18', '2014-11-24 02:33:18', null);
INSERT INTO `categories` VALUES ('34', '26', 'Tống đạt văn bản', 'tong-dat-van-ban', '1', '1', null, null, '0', 'on', '1', '2014-11-24 02:33:34', '2014-11-24 02:33:34', null);
INSERT INTO `categories` VALUES ('35', '28', 'Văn bản pháp luật', 'van-ban-phap-luat', '1', '1', null, null, '0', 'on', '1', '2014-11-24 02:38:29', '2014-11-24 02:38:29', null);
INSERT INTO `categories` VALUES ('36', '28', 'Mẫu vi bằng', 'mau-vi-bang', '1', '1', null, null, '0', 'on', '1', '2014-11-24 02:38:44', '2014-11-24 02:38:44', null);
INSERT INTO `categories` VALUES ('37', '28', 'Mẫu thi hành án', 'mau-thi-hanh-an', '1', '1', null, null, '0', 'on', '1', '2014-11-24 02:38:58', '2014-11-24 02:38:58', null);

-- ----------------------------
-- Table structure for category_post
-- ----------------------------
DROP TABLE IF EXISTS `category_post`;
CREATE TABLE `category_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cat_con_unique` (`category_id`,`post_id`),
  KEY `category_content_content_id_foreign` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=531 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of category_post
-- ----------------------------
INSERT INTO `category_post` VALUES ('529', '25', '3', '2014-11-24 04:41:28', '2014-11-24 04:41:28');
INSERT INTO `category_post` VALUES ('530', '25', '2', '2014-11-24 04:52:56', '2014-11-24 04:52:56');

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('4', null, '2', '1', 'Lorem ipsum dolor sit amet, mutat utinam nonumy ea mel.', '2014-09-03 05:22:33', '2014-09-03 05:22:33');
INSERT INTO `comments` VALUES ('5', null, '2', '2', 'Lorem ipsum dolor sit amet, sale ceteros liberavisse duo ex, nam mazim maiestatis dissentiunt no. Iusto nominavi cu sed, has.', '2014-09-05 07:22:33', '2014-09-05 07:22:33');
INSERT INTO `comments` VALUES ('6', null, '3', '1', 'Lorem ipsum dolor sit amet, mutat utinam nonumy ea mel.', '2014-09-05 05:22:33', '2014-09-05 05:22:33');

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'Admin', '{\"admin\":1,\"users\":1}', '2014-09-07 03:22:32', '2014-09-07 03:22:32');

-- ----------------------------
-- Table structure for medias
-- ----------------------------
DROP TABLE IF EXISTS `medias`;
CREATE TABLE `medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `mpath` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of medias
-- ----------------------------
INSERT INTO `medias` VALUES ('59', '', 'uploads/medias/2014/09/23', '23.09.2014_db_1411510184.jpg', '1', 'post', '2014-09-23 22:09:45', '2014-09-23 22:09:45');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2012_12_06_225921_migration_cartalyst_sentry_install_users', '1');
INSERT INTO `migrations` VALUES ('2012_12_06_225929_migration_cartalyst_sentry_install_groups', '1');
INSERT INTO `migrations` VALUES ('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot', '1');
INSERT INTO `migrations` VALUES ('2012_12_06_225988_migration_cartalyst_sentry_install_throttle', '1');
INSERT INTO `migrations` VALUES ('2013_01_19_011903_create_posts_table', '2');
INSERT INTO `migrations` VALUES ('2013_01_19_044505_create_comments_table', '2');
INSERT INTO `migrations` VALUES ('2013_03_23_193214_update_users_table', '2');

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `excerpt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT '0',
  `is_popular` tinyint(1) DEFAULT NULL,
  `showon_homepage` tinyint(1) DEFAULT '0',
  `view_count` int(11) DEFAULT '0',
  `comment_count` int(11) DEFAULT '0',
  `post_type` varchar(20) CHARACTER SET utf8 DEFAULT 'post',
  `status` varchar(25) COLLATE utf8_unicode_ci DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('2', '1', null, 'Vivendo suscipiantur vim te vix', '123 123 12312 3123 213 123 213 123 21 3', 'vivendo-suscipiantur-vim-te-vix', '&lt;p&gt;In mea autem etiam menandri, quot elitr vim ei, eos semper disputationi id? Per facer appetere eu, duo et animal maiestatis. Omnesque invidunt mnesarchum ex mel, vis no case senserit dissentias. Te mei minimum singulis inimicus, ne labores accusam necessitatibus vel, vivendo nominavi ne sed. Posidonium scriptorem consequuntur cum ex? Posse fabulas iudicabit in nec, eos cu electram forensibus, pro ei commodo tractatos reformidans. Qui eu lorem augue alterum, eos in facilis pericula mediocritatem? Est hinc legimus oporteat in. Sit ei melius delicatissimi. Duo ex qualisque adolescens! Pri cu solum aeque. Aperiri docendi vituperatoribus has ea! Sed ut ludus perfecto sensibus, no mea iisque facilisi. Choro tation melius et mea, ne vis nisl insolens. Vero autem scriptorem cu qui? Errem dolores no nam, mea tritani platonem id! At nec tantas consul, vis mundi petentium elaboraret ex, mel appareat maiestatis at. Sed et eros concludaturque. Mel ne aperiam comprehensam! Ornatus delicatissimi eam ex, sea an quidam tritani placerat? Ad eius iriure consequat eam, mazim temporibus conclusionemque eum ex. Te amet sumo usu, ne autem impetus scripserit duo, ius ei mutat labore inciderint! Id nulla comprehensam his? Ut eam deleniti argumentum, eam appellantur definitionem ad. Pro et purto partem mucius! Cu liber primis sed, esse evertitur vis ad. Ne graeco maiorum mea! In eos nostro docendi conclusionemque. Ne sit audire blandit tractatos? An nec dicam causae meliore, pro tamquam offendit efficiendi ut. Te dicta sadipscing nam, denique albucius conclusionemque ne usu, mea eu euripidis philosophia! Qui at vivendo efficiendi! Vim ex delenit blandit oportere, in iriure placerat cum. Te cum meis altera, ius ex quis veri. Mutat propriae eu has, mel ne veri bonorum tincidunt. Per noluisse sensibus honestatis ut, stet singulis ea eam, his dicunt vivendum mediocrem ei. Ei usu mutat efficiantur, eum verear aperiam definitiones an! Simul dicam instructior ius ei. Cu ius facer doming cotidieque! Quot principes eu his, usu vero dicat an. Ex dicta perpetua qui, pericula intellegam scripserit id vel. Id fabulas ornatus necessitatibus mel. Prompta dolorem appetere ea has. Vel ad expetendis instructior! Te his dolorem adversarium? Pri eu rebum viris, tation molestie id pri. Mel ei stet inermis dissentias. Sed ea dolorum detracto vituperata. Possit oportere similique cu nec, ridens animal quo ex?&lt;/p&gt;\r\n', '59', '', '', '', '0', '0', '0', '0', '0', 'post', 'published', '2014-08-30 03:22:33', '2014-11-24 04:52:56');
INSERT INTO `posts` VALUES ('3', '1', null, 'In iisque similique reprimique eum', '123 123 123', 'in-iisque-similique-reprimique-eum', '&lt;p&gt;In mea autem etiam menandri, quot elitr vim ei, eos semper disputationi id? Per facer appetere eu, duo et animal maiestatis. Omnesque invidunt mnesarchum ex mel, vis no case senserit dissentias. Te mei minimum singulis inimicus, ne labores accusam necessitatibus vel, vivendo nominavi ne sed. Posidonium scriptorem consequuntur cum ex? Posse fabulas iudicabit in nec, eos cu electram forensibus, pro ei commodo tractatos reformidans. Qui eu lorem augue alterum, eos in facilis pericula mediocritatem? Est hinc legimus oporteat in. Sit ei melius delicatissimi. Duo ex qualisque adolescens! Pri cu solum aeque. Aperiri docendi vituperatoribus has ea! Sed ut ludus perfecto sensibus, no mea iisque facilisi. Choro tation melius et mea, ne vis nisl insolens. Vero autem scriptorem cu qui? Errem dolores no nam, mea tritani platonem id! At nec tantas consul, vis mundi petentium elaboraret ex, mel appareat maiestatis at. Sed et eros concludaturque. Mel ne aperiam comprehensam! Ornatus delicatissimi eam ex, sea an quidam tritani placerat? Ad eius iriure consequat eam, mazim temporibus conclusionemque eum ex. Te amet sumo usu, ne autem impetus scripserit duo, ius ei mutat labore inciderint! Id nulla comprehensam his? Ut eam deleniti argumentum, eam appellantur definitionem ad. Pro et purto partem mucius! Cu liber primis sed, esse evertitur vis ad. Ne graeco maiorum mea! In eos nostro docendi conclusionemque. Ne sit audire blandit tractatos? An nec dicam causae meliore, pro tamquam offendit efficiendi ut. Te dicta sadipscing nam, denique albucius conclusionemque ne usu, mea eu euripidis philosophia! Qui at vivendo efficiendi! Vim ex delenit blandit oportere, in iriure placerat cum. Te cum meis altera, ius ex quis veri. Mutat propriae eu has, mel ne veri bonorum tincidunt. Per noluisse sensibus honestatis ut, stet singulis ea eam, his dicunt vivendum mediocrem ei. Ei usu mutat efficiantur, eum verear aperiam definitiones an! Simul dicam instructior ius ei. Cu ius facer doming cotidieque! Quot principes eu his, usu vero dicat an. Ex dicta perpetua qui, pericula intellegam scripserit id vel. Id fabulas ornatus necessitatibus mel. Prompta dolorem appetere ea has. Vel ad expetendis instructior! Te his dolorem adversarium? Pri eu rebum viris, tation molestie id pri. Mel ei stet inermis dissentias. Sed ea dolorum detracto vituperata. Possit oportere similique cu nec, ridens animal quo ex?&lt;/p&gt;\r\n', '59', '', '', '', '1', '0', '0', '0', '0', 'post', 'published', '2014-09-03 03:22:33', '2014-11-24 04:41:28');

-- ----------------------------
-- Table structure for post_tag
-- ----------------------------
DROP TABLE IF EXISTS `post_tag`;
CREATE TABLE `post_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of post_tag
-- ----------------------------
INSERT INTO `post_tag` VALUES ('111', '3', '52', '2014-11-24 04:41:28', '2014-11-24 04:41:28');

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'tag',
  `status` varchar(5) NOT NULL DEFAULT 'on',
  `news_count` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES ('52', 'gioi thieu', 'gioi-thieu', 'tag', 'on', '0', '1', '2014-11-24 02:31:29', '2014-11-24 02:31:29');

-- ----------------------------
-- Table structure for throttle
-- ----------------------------
DROP TABLE IF EXISTS `throttle`;
CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of throttle
-- ----------------------------
INSERT INTO `throttle` VALUES ('1', '1', '127.0.0.1', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('2', '2', '127.0.0.1', '1', '0', '0', '2014-09-10 01:49:07', null, null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'dungdn@dungdn.com', '$2y$10$myAPEphBXklCBRF35eQt/uI12Ytxf89ONZtoDGPaMI3dIlRQsN/NS', '{\"admin\":1,\"user\":1}', '1', null, null, '2014-11-24 02:14:27', '$2y$10$/TuxBE97TIetYyrX51mNHOVVB9DIDcgBQ.HKdnkcL3rE48.TkXTfy', null, 'Dung', 'Dinh', '2014-09-07 03:22:32', '2014-11-24 02:14:27', null, null, null, null);
INSERT INTO `users` VALUES ('2', 'john.doe@example.com', '$2y$10$E71FwwkK6Lml5dh5dihbPeIAtDestXlNN0zE/d7PbaZj8z99FWnMm', null, '1', null, null, null, null, null, 'John', 'Doe', '2014-09-07 03:22:33', '2014-09-11 07:29:13', '2014-09-11 07:29:13', null, null, null);

-- ----------------------------
-- Table structure for users_groups
-- ----------------------------
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users_groups
-- ----------------------------
INSERT INTO `users_groups` VALUES ('1', '1');
