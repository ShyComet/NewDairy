# Host: localhost  (Version: 5.5.40)
# Date: 2015-05-16 10:49:22
# Generator: MySQL-Front 5.3  (Build 4.120)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "comment"
#

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `wzid` int(11) NOT NULL,
  `comment` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "comment"
#

/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,'&#x5FC3;&#x75DB;&#x7684;&#x4EBA;','2014-10-13',1,'&#x8FD9;&#x7BC7;&#x6587;&#x7AE0;&#x8FD8;&#x662F;&#x4E0D;&#x9519;&#x7684;&#x8BF4;'),(2,'&#x597D;&#x597D;&#x5148;&#x751F;','2014-10-13',2,'&#x597D;&#x597D;&#x5148;&#x751F;'),(3,'å¥½è¯´å¥½è¯´','2014-10-13',2,'è¿™ç« æœ‰ç‚¹æ°´äº†ï¼'),(4,'é«˜å…´','2014-10-15',1,'å¯ä»¥çš„ï¼Œä¸é”™çš„ï¼Œå¥½');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;

#
# Structure for table "sls_admin"
#

DROP TABLE IF EXISTS `sls_admin`;
CREATE TABLE `sls_admin` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL DEFAULT '',
  `qq_au` varchar(32) NOT NULL,
  `weibo` varchar(32) NOT NULL,
  `m_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "sls_admin"
#

/*!40000 ALTER TABLE `sls_admin` DISABLE KEYS */;
INSERT INTO `sls_admin` VALUES (1,'theone','7919f98033d39a345a9ca34c451eebfe','1','2',1);
/*!40000 ALTER TABLE `sls_admin` ENABLE KEYS */;

#
# Structure for table "sls_system"
#

DROP TABLE IF EXISTS `sls_system`;
CREATE TABLE `sls_system` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `Introduction` text NOT NULL,
  `Author` text NOT NULL,
  `QQ` varchar(11) NOT NULL DEFAULT '594849807',
  `websiteurl` varchar(255) NOT NULL DEFAULT 'http://www.xiahuixin.com',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "sls_system"
#

/*!40000 ALTER TABLE `sls_system` DISABLE KEYS */;
INSERT INTO `sls_system` VALUES (1,'小新不要蜡笔','曾经也有一个笑容出现在我的生命里，可是最后还是如雾般消散，而那个笑容，就成为我心中深深埋藏的一条湍急河流，无法泅渡，那河流的声音，就成为我每日每夜绝望的歌唱。一个人总要走陌生的路，看陌生的风景，听陌生的歌，然后在某个不经意的瞬间，你会发现，原本费尽心机想要忘记的事情真的就这么忘记了。','゛ 百里长安暮溪夏','594849807','http://www.xiahuixin.com');
/*!40000 ALTER TABLE `sls_system` ENABLE KEYS */;

#
# Structure for table "sls_wz"
#

DROP TABLE IF EXISTS `sls_wz`;
CREATE TABLE `sls_wz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `Content` text NOT NULL,
  `date` date NOT NULL,
  `mood` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

#
# Data for table "sls_wz"
#

/*!40000 ALTER TABLE `sls_wz` DISABLE KEYS */;
INSERT INTO `sls_wz` VALUES (1,'只有你是最好的','','2015-05-15','只有你是最好的'),(2,'只有我是最好的','','2015-05-15','只有我是最好的');
/*!40000 ALTER TABLE `sls_wz` ENABLE KEYS */;
