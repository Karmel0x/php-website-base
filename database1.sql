/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 100414
Source Host           : localhost:3306
Source Database       : database1

Target Server Type    : MYSQL
Target Server Version : 100414
File Encoding         : 65001

Date: 2021-01-18 17:37:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for b_action
-- ----------------------------
DROP TABLE IF EXISTS `b_action`;
CREATE TABLE `b_action` (
  `a_index` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `a_user` int(11) unsigned DEFAULT NULL,
  `a_type` int(4) DEFAULT NULL,
  `a_val` varchar(255) DEFAULT NULL,
  `a_time` int(11) unsigned DEFAULT NULL,
  `a_ip` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`a_index`)
) ENGINE=InnoDB AUTO_INCREMENT=6820 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of b_action
-- ----------------------------
INSERT INTO `b_action` VALUES ('6816', '4', '4', '7db69890dcf9eafd66e73e394f27a078', '1606820911', '127.0.0.1');
INSERT INTO `b_action` VALUES ('6817', '4', '4', '8404b7fc19733b192dfc3470a9e46820', '1606821994', '127.0.0.1');
INSERT INTO `b_action` VALUES ('6818', '104', '4', '3333f2e553e8dc9dc801abb7a22b9e91', '1610985881', '127.0.0.1');
INSERT INTO `b_action` VALUES ('6819', '104', '4', 'e7f0a191a2ddb51d13b9473ffa414166', '1610986437', '127.0.0.1');

-- ----------------------------
-- Table structure for b_user
-- ----------------------------
DROP TABLE IF EXISTS `b_user`;
CREATE TABLE `b_user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `a_email` varchar(99) NOT NULL DEFAULT '',
  `a_pass` varchar(64) NOT NULL DEFAULT '',
  `ip` varchar(40) NOT NULL,
  `a_email_confirm` int(11) unsigned NOT NULL DEFAULT 0,
  `a_comment` varchar(255) NOT NULL DEFAULT '',
  `rights` int(11) NOT NULL DEFAULT 0,
  `create_date` datetime DEFAULT NULL,
  `active_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `block_date` datetime DEFAULT NULL,
  `expire_date` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of b_user
-- ----------------------------
INSERT INTO `b_user` VALUES ('1', 'qwaszx@gmail.com', 'c05bceb6d885f878f49633b90109a4fb6a85080ab241e7a28b6584415cb0e053', '127.0.0.1', '0', '', '100', '2021-01-17 09:41:06', '2021-01-18 14:26:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null);
INSERT INTO `b_user` VALUES ('2', 'qwer@asdf.zxcv', 'b56e12d57a4fdb40e1c085b039c98f9b2e6559faba77c4c5c9d17eef5aeb0307', '127.0.0.1', '0', '', '60', '2021-01-17 10:03:39', '2021-01-18 09:55:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null);
INSERT INTO `b_user` VALUES ('3', 'qwer1@asdf.zxcv', '603272b5b6709dd60137ceeb7983b7c77c4719de95d6fe5885837e9eac85da35', '127.0.0.1', '0', '', '40', '2021-01-17 10:04:48', '2021-01-18 09:55:27', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null);
INSERT INTO `b_user` VALUES ('4', 'qwer2@asdf.zxcv', '2081cdebf07650adfb8603e8a85bf32f55be89716d717cdd5d2c6c93085d62c3', '127.0.0.1', '1606821998', '', '80', '2021-01-17 11:07:12', '2021-01-18 16:22:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null);
INSERT INTO `b_user` VALUES ('101', 'qwer2@asdf.zxcv1', '2081cdebf07650adfb8603e8a85bf32f55be89716d717cdd5d2c6c93085d62c3', '127.0.0.1', '0', '', '0', '2021-01-18 12:00:00', '2021-01-18 12:20:22', null, null, null);
INSERT INTO `b_user` VALUES ('102', '22222', '33333', '', '0', '', '20', null, null, null, null, null);
INSERT INTO `b_user` VALUES ('104', 'qwer3@asdfg.zxcv', 'c8b5a25189e5cc430afd8219325e4afa0cbade039f84aa811155df5bf7eab005', '127.0.0.1', '0', '', '0', '2021-01-18 16:53:35', '2021-01-18 17:16:37', null, null, null);

-- ----------------------------
-- Table structure for b_user_details
-- ----------------------------
DROP TABLE IF EXISTS `b_user_details`;
CREATE TABLE `b_user_details` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `value` varchar(255) NOT NULL DEFAULT '',
  `update_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`,`name`,`update_date`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of b_user_details
-- ----------------------------
INSERT INTO `b_user_details` VALUES ('1', 'name', 'firstname lastname', '2021-01-18 12:29:11');
INSERT INTO `b_user_details` VALUES ('2', 'name', 'first last', '2021-01-18 12:29:17');
INSERT INTO `b_user_details` VALUES ('3', 'name', 'qwer1 qwer1', '2020-12-02 12:55:43');
INSERT INTO `b_user_details` VALUES ('4', 'name', 'qwer2 qwer2w', '2021-01-18 16:01:19');
INSERT INTO `b_user_details` VALUES ('104', 'name', 'qwer3 qwer3', '2021-01-18 16:53:35');

-- ----------------------------
-- Table structure for log_general
-- ----------------------------
DROP TABLE IF EXISTS `log_general`;
CREATE TABLE `log_general` (
  `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `a_date` datetime DEFAULT NULL,
  `a_ip` varchar(40) DEFAULT NULL,
  `a_user` int(11) unsigned DEFAULT NULL,
  `a_table` varchar(255) DEFAULT '',
  `a_type` varchar(255) DEFAULT NULL,
  `a_identifier` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_general
-- ----------------------------

-- ----------------------------
-- Table structure for log_login
-- ----------------------------
DROP TABLE IF EXISTS `log_login`;
CREATE TABLE `log_login` (
  `a_index` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `a_date` int(11) unsigned DEFAULT NULL,
  `a_ip` varchar(40) DEFAULT NULL,
  `a_res` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`a_index`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_login
-- ----------------------------
INSERT INTO `log_login` VALUES ('1', '1610977149', '127.0.0.1', '1');
INSERT INTO `log_login` VALUES ('2', '1610979141', '127.0.0.1', '1');
INSERT INTO `log_login` VALUES ('3', '1610983354', '127.0.0.1', '1');
INSERT INTO `log_login` VALUES ('4', '1610986597', '127.0.0.1', '1');
SET FOREIGN_KEY_CHECKS=1;
