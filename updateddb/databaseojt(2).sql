/*
MySQL Data Transfer
Source Host: localhost
Source Database: databaseojt
Target Host: localhost
Target Database: databaseojt
Date: 5/18/2018 11:38:09 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for attend
-- ----------------------------
DROP TABLE IF EXISTS `attend`;
CREATE TABLE `attend` (
  `attend_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  PRIMARY KEY (`attend_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `phone` int(15) NOT NULL,
  `landline` int(9) NOT NULL,
  `archive` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for list
-- ----------------------------
DROP TABLE IF EXISTS `list`;
CREATE TABLE `list` (
  `list_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for schedule
-- ----------------------------
DROP TABLE IF EXISTS `schedule`;
CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `room` varchar(255) NOT NULL,
  `archive` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `company` VALUES ('1', 'Trend Micro', 'Naruto', '123123123', '123123', '1');
INSERT INTO `company` VALUES ('2', 'Nokia', 'Test', '12324', '12312', '1');
INSERT INTO `schedule` VALUES ('1', '1', '2018-05-18', '08:00:00', '09:00:00', 'D123', '1');
INSERT INTO `schedule` VALUES ('2', '1', '2018-05-18', '08:30:00', '09:30:00', 'D123', '1');
INSERT INTO `schedule` VALUES ('3', '2', '2018-05-18', '08:00:00', '09:00:00', 'C1', '1');
INSERT INTO `schedule` VALUES ('4', '2', '2018-05-18', '09:00:00', '10:00:00', 'C2', '1');
INSERT INTO `user` VALUES ('1', 'admin', 'admin', '0', 'admin fname', 'admin lname');
