/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : dddai

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2017-05-16 22:43:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `atts`
-- ----------------------------
DROP TABLE IF EXISTS `atts`;
CREATE TABLE `atts` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id ',
  `uid` int(11) NOT NULL COMMENT '用户uid',
  `pid` int(11) NOT NULL COMMENT '项目pid',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '项目名称',
  `realname` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '真实姓名',
  `gender` enum('男','女') COLLATE utf8_unicode_ci NOT NULL COMMENT '性别',
  `salary` tinyint(4) NOT NULL COMMENT '工资收入(千为单位)',
  `jobcity` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '工作城市',
  `udesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户描述',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of atts
-- ----------------------------
INSERT INTO `atts` VALUES ('1', '1', '2', '借款买车', '张天爱', '男', '0', '', '');

-- ----------------------------
-- Table structure for `bids`
-- ----------------------------
DROP TABLE IF EXISTS `bids`;
CREATE TABLE `bids` (
  `bid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id号',
  `uid` int(11) NOT NULL COMMENT '用户uid',
  `pid` int(11) NOT NULL COMMENT '项目pid',
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '项目名称',
  `amount` int(11) NOT NULL COMMENT '投资金额',
  `pubtime` int(11) NOT NULL COMMENT '投标时间',
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of bids
-- ----------------------------
INSERT INTO `bids` VALUES ('2', '2', '2', '借款买车', '200000', '1494939028');
INSERT INTO `bids` VALUES ('4', '3', '2', '借款买车', '400000', '1494943131');

-- ----------------------------
-- Table structure for `grows`
-- ----------------------------
DROP TABLE IF EXISTS `grows`;
CREATE TABLE `grows` (
  `gid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键gid',
  `uid` int(11) NOT NULL COMMENT '用户uid',
  `pid` int(11) NOT NULL COMMENT '项目pid',
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '项目名称',
  `amount` int(11) NOT NULL COMMENT '每天利息',
  `paydate` date NOT NULL COMMENT '收益日期',
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of grows
-- ----------------------------
INSERT INTO `grows` VALUES ('1', '2', '2', '借款买车', '55', '2017-05-16');
INSERT INTO `grows` VALUES ('2', '3', '2', '借款买车', '110', '2017-05-16');

-- ----------------------------
-- Table structure for `hks`
-- ----------------------------
DROP TABLE IF EXISTS `hks`;
CREATE TABLE `hks` (
  `hid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键hid',
  `uid` int(11) NOT NULL COMMENT '用户uid',
  `pid` int(11) NOT NULL COMMENT '项目pid',
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '项目名称',
  `amount` int(11) NOT NULL COMMENT '每月还款金额',
  `paydate` date NOT NULL COMMENT '账单日',
  `status` tinyint(4) NOT NULL COMMENT '是否已还：0未还；1已还;',
  PRIMARY KEY (`hid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of hks
-- ----------------------------
INSERT INTO `hks` VALUES ('1', '1', '2', '借款买车', '105000', '2017-06-16', '0');
INSERT INTO `hks` VALUES ('2', '1', '2', '借款买车', '105000', '2017-07-16', '0');
INSERT INTO `hks` VALUES ('3', '1', '2', '借款买车', '105000', '2017-08-16', '0');
INSERT INTO `hks` VALUES ('4', '1', '2', '借款买车', '105000', '2017-09-16', '0');
INSERT INTO `hks` VALUES ('5', '1', '2', '借款买车', '105000', '2017-10-16', '0');
INSERT INTO `hks` VALUES ('6', '1', '2', '借款买车', '105000', '2017-11-16', '0');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('2017_05_14_114149_create_projects_table', '1');
INSERT INTO `migrations` VALUES ('2017_05_14_114216_create_atts_table', '1');
INSERT INTO `migrations` VALUES ('2017_05_16_123150_create_bids_table', '2');
INSERT INTO `migrations` VALUES ('2017_05_16_130527_create_hks_table', '3');
INSERT INTO `migrations` VALUES ('2017_05_16_131434_create_tasks_table', '4');
INSERT INTO `migrations` VALUES ('2017_05_16_131449_create_grows_table', '4');

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `projects`
-- ----------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `pid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `uid` int(11) NOT NULL COMMENT '用户uid',
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `money` int(11) NOT NULL COMMENT '贷款金额（分为单位）',
  `mobile` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT '手机',
  `age` tinyint(4) NOT NULL COMMENT '年龄',
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '项目名称',
  `rate` tinyint(4) NOT NULL COMMENT '利率(百分比)',
  `hrange` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '状态:-1审核失败；0审核中；1招标中；2还款中；3结束',
  `recive` int(11) NOT NULL COMMENT '已招标金额',
  `pubtime` int(11) NOT NULL COMMENT '项目发布时间',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of projects
-- ----------------------------
INSERT INTO `projects` VALUES ('2', '1', 'test', '600000', '18782962678', '40', '借款买车', '10', '6', '2', '600000', '1494769157');

-- ----------------------------
-- Table structure for `tasks`
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键tid',
  `uid` int(11) NOT NULL COMMENT '用户uid',
  `pid` int(11) NOT NULL COMMENT '项目pid',
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '项目名称',
  `amount` int(11) NOT NULL COMMENT '每日利息',
  `enddate` date NOT NULL COMMENT '收利息截止日',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tasks
-- ----------------------------
INSERT INTO `tasks` VALUES ('1', '2', '2', '借款买车', '55', '2017-11-16');
INSERT INTO `tasks` VALUES ('2', '3', '2', '借款买车', '110', '2017-11-16');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '点子邮箱',
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `mobile` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT '手机号',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '记住密码',
  `regtime` int(11) NOT NULL COMMENT '注册时间',
  `lastlogin` int(11) NOT NULL COMMENT '上次登录时间',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'test', 'test@qq.com', '$2y$10$e6XUEfS4KLfzpWJd.1p.BO/u3ascZBMjGXmyLU.xqkfnC96./eQD.', '18782962678', null, '1494768992', '0');
INSERT INTO `users` VALUES ('2', 'test1', 'test1@qq.com', '$2y$10$0jJb3SfrcPh4d1/ox6OzO.TfsHaqGycF8Fc10SE2Ota7RhLi7WqL.', '18782962678', 'vEZtPzJxE6TAO5c18xZNIPYK1eMB93x8SZuCvPU6OvB28Qp6FUobIHP8EoWO', '1494938867', '0');
INSERT INTO `users` VALUES ('3', 'test2', 'test2@qq.com', '$2y$10$c5PpxULe.I5zEUWPhb3cI./N.Hn.DIel/6GYim7NrxUsBzKDl1.1a', '18782962678', null, '1494939580', '0');
