/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50703
Source Host           : localhost:3306
Source Database       : stgx

Target Server Type    : MYSQL
Target Server Version : 50703
File Encoding         : 65001

Date: 2015-09-03 20:15:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for stgx_exam
-- ----------------------------
DROP TABLE IF EXISTS `stgx_exam`;
CREATE TABLE `stgx_exam` (
  `examid` int(11) NOT NULL AUTO_INCREMENT,
  `examtitle` varchar(20) NOT NULL,
  `examcontent` varchar(200) NOT NULL,
  `examtime` int(11) NOT NULL,
  `examyear` varchar(20) NOT NULL,
  `examprof` varchar(20) NOT NULL,
  `examsubject` varchar(20) NOT NULL,
  `examurl` varchar(50) NOT NULL,
  `examstatus` int(2) NOT NULL DEFAULT '0',
  `examdowload` int(11) NOT NULL DEFAULT '0',
  `examgood` int(11) NOT NULL DEFAULT '0',
  `exambad` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`examid`),
  KEY `userid` (`userid`),
  CONSTRAINT `stgx_exam_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `stgx_user` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stgx_exam
-- ----------------------------

-- ----------------------------
-- Table structure for stgx_feed
-- ----------------------------
DROP TABLE IF EXISTS `stgx_feed`;
CREATE TABLE `stgx_feed` (
  `feedid` int(11) NOT NULL,
  `feedcontent` varchar(200) NOT NULL,
  `feedtime` int(11) NOT NULL,
  `feedcontact` varchar(20) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`feedid`),
  KEY `userid` (`userid`),
  CONSTRAINT `stgx_feed_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `stgx_user` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stgx_feed
-- ----------------------------

-- ----------------------------
-- Table structure for stgx_found
-- ----------------------------
DROP TABLE IF EXISTS `stgx_found`;
CREATE TABLE `stgx_found` (
  `foundid` int(11) NOT NULL,
  `foundtitle` varchar(20) NOT NULL,
  `foundtime` varchar(20) NOT NULL,
  `foundcontent` varchar(200) NOT NULL,
  `foundpublish` int(11) NOT NULL,
  `foundplace` varchar(50) NOT NULL,
  `foundcontact` varchar(50) NOT NULL,
  `foundstatus` int(2) NOT NULL DEFAULT '1' COMMENT '0 未允许发布 1 允许发布',
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`foundid`),
  KEY `userid` (`userid`),
  CONSTRAINT `stgx_found_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `stgx_user` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stgx_found
-- ----------------------------

-- ----------------------------
-- Table structure for stgx_promotion
-- ----------------------------
DROP TABLE IF EXISTS `stgx_promotion`;
CREATE TABLE `stgx_promotion` (
  `promotionid` int(11) NOT NULL,
  `promotiontitle` varchar(50) NOT NULL,
  `promotiontime` int(11) NOT NULL,
  `promotionstart` varchar(20) NOT NULL,
  `promotionend` varchar(20) NOT NULL,
  `promotioncontent` varchar(200) NOT NULL,
  `promotionplace` varchar(50) NOT NULL,
  `promotionstatus` int(2) NOT NULL DEFAULT '1' COMMENT '1 正在进行 0 已经结束',
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`promotionid`),
  KEY `userid` (`userid`),
  CONSTRAINT `stgx_promotion_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `stgx_user` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stgx_promotion
-- ----------------------------

-- ----------------------------
-- Table structure for stgx_user
-- ----------------------------
DROP TABLE IF EXISTS `stgx_user`;
CREATE TABLE `stgx_user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `useremail` varchar(50) NOT NULL,
  `userpwd` varchar(50) NOT NULL,
  `userpic` varchar(50) NOT NULL,
  `usertime` int(11) NOT NULL,
  `usersex` varchar(5) NOT NULL,
  `usertype` int(2) NOT NULL DEFAULT '0' COMMENT '0 普通用户 1 管理员',
  `userstatus` int(2) NOT NULL DEFAULT '0' COMMENT '0 未激活 1 已激活',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stgx_user
-- ----------------------------
