/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50637
Source Host           : localhost:3306
Source Database       : tarp_db

Target Server Type    : MYSQL
Target Server Version : 50637
File Encoding         : 65001

Date: 2021-03-10 15:22:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `answers`
-- ----------------------------
DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(11) unsigned DEFAULT NULL,
  `response` varchar(255) DEFAULT NULL,
  `score` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `assessment_id` int(11) unsigned NOT NULL,
  `recommendations` text,
  `weight` decimal(5,2) DEFAULT NULL,
  `section_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_assessment_question` (`question_id`,`assessment_id`),
  KEY `answers_question_id_idx` (`question_id`),
  KEY `fk_answers_assessments1_idx` (`assessment_id`),
  KEY `fk_answers_sections1_idx` (`section_id`),
  CONSTRAINT `FK_answers_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  CONSTRAINT `fk_answers_assessments1` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_answers_sections1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9329 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of answers
-- ----------------------------

-- ----------------------------
-- Table structure for `assessments`
-- ----------------------------
DROP TABLE IF EXISTS `assessments`;
CREATE TABLE `assessments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `customer_first_name` varchar(255) DEFAULT NULL,
  `customer_last_name` varchar(255) DEFAULT NULL,
  `personal_id` varchar(255) DEFAULT NULL,
  `customer_age` int(11) DEFAULT NULL,
  `sex` char(1) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `lat` decimal(10,5) DEFAULT NULL,
  `lon` decimal(10,5) DEFAULT NULL,
  `loan_purpose` int(10) unsigned DEFAULT NULL,
  `loan_section` int(10) unsigned DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `total_score` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_assessments_customer_id` (`customer_id`),
  KEY `fk_assessments_loan_purposes1_idx` (`loan_purpose`),
  KEY `fk_assessments_loan_section1_idx` (`loan_section`),
  KEY `FK_assessments_user_id` (`user_id`),
  CONSTRAINT `FK_assessments_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_assessments_loan_purposes1` FOREIGN KEY (`loan_purpose`) REFERENCES `loan_purposes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_assessments_loan_section1` FOREIGN KEY (`loan_section`) REFERENCES `loan_section` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=216 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of assessments
-- ----------------------------

-- ----------------------------
-- Table structure for `audittrail`
-- ----------------------------
DROP TABLE IF EXISTS `audittrail`;
CREATE TABLE `audittrail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `script` varchar(80) DEFAULT NULL,
  `user` varchar(80) DEFAULT NULL,
  `action` varchar(80) DEFAULT NULL,
  `table` varchar(80) DEFAULT NULL,
  `field` varchar(80) DEFAULT NULL,
  `keyvalue` longtext,
  `oldvalue` longtext,
  `newvalue` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of audittrail
-- ----------------------------
INSERT INTO `audittrail` VALUES ('1', '2021-03-10 18:38:48', '/bz/usersedit.php', '-1', 'U', 'users', 'first_names', '7', 'Alex', 'Jose Alejandro');
INSERT INTO `audittrail` VALUES ('2', '2021-03-10 18:48:33', '/bz//api/index.php', '7', 'A', 'assessments', 'user_id', '214', '', '7');
INSERT INTO `audittrail` VALUES ('3', '2021-03-10 18:48:33', '/bz//api/index.php', '7', 'A', 'assessments', 'customer_id', '214', '', '2123');
INSERT INTO `audittrail` VALUES ('4', '2021-03-10 18:48:33', '/bz//api/index.php', '7', 'A', 'assessments', 'customer_first_name', '214', '', 'Gregory Thomson');
INSERT INTO `audittrail` VALUES ('5', '2021-03-10 18:48:33', '/bz//api/index.php', '7', 'A', 'assessments', 'customer_age', '214', '', '71');
INSERT INTO `audittrail` VALUES ('6', '2021-03-10 18:48:33', '/bz//api/index.php', '7', 'A', 'assessments', 'sex', '214', '', 'M');
INSERT INTO `audittrail` VALUES ('7', '2021-03-10 18:48:33', '/bz//api/index.php', '7', 'A', 'assessments', 'address', '214', '', 'Alta Vista, Stann Creek, Belize');
INSERT INTO `audittrail` VALUES ('8', '2021-03-10 18:48:33', '/bz//api/index.php', '7', 'A', 'assessments', 'status', '214', '', '0');
INSERT INTO `audittrail` VALUES ('9', '2021-03-10 18:48:33', '/bz//api/index.php', '7', 'A', 'assessments', 'loan_purpose', '214', '', '2');
INSERT INTO `audittrail` VALUES ('10', '2021-03-10 18:48:33', '/bz//api/index.php', '7', 'A', 'assessments', 'loan_section', '214', '', '2');
INSERT INTO `audittrail` VALUES ('11', '2021-03-10 18:48:33', '/bz//api/index.php', '7', 'A', 'assessments', 'lat', '214', '', '16.9979595');
INSERT INTO `audittrail` VALUES ('12', '2021-03-10 18:48:33', '/bz//api/index.php', '7', 'A', 'assessments', 'lon', '214', '', '-88.4076015');
INSERT INTO `audittrail` VALUES ('13', '2021-03-10 18:48:33', '/bz//api/index.php', '7', 'A', 'assessments', 'id', '214', '', '214');
INSERT INTO `audittrail` VALUES ('14', '2021-03-10 19:13:04', '/bz/usersadd.php', '-1', 'A', 'users', 'first_names', '14', '', 'Alejandro');
INSERT INTO `audittrail` VALUES ('15', '2021-03-10 19:13:04', '/bz/usersadd.php', '-1', 'A', 'users', 'last_names', '14', '', 'Madrazo');
INSERT INTO `audittrail` VALUES ('16', '2021-03-10 19:13:04', '/bz/usersadd.php', '-1', 'A', 'users', 'email', '14', '', 'jmadrazo7+02@gmail.com');
INSERT INTO `audittrail` VALUES ('17', '2021-03-10 19:13:04', '/bz/usersadd.php', '-1', 'A', 'users', 'password', '14', '', '********');
INSERT INTO `audittrail` VALUES ('18', '2021-03-10 19:13:04', '/bz/usersadd.php', '-1', 'A', 'users', 'user_level', '14', '', '0');
INSERT INTO `audittrail` VALUES ('19', '2021-03-10 19:13:04', '/bz/usersadd.php', '-1', 'A', 'users', 'id', '14', '', '14');
INSERT INTO `audittrail` VALUES ('20', '2021-03-10 19:18:51', '/bz/usersedit.php', '-1', 'U', 'users', 'user_level', '14', '0', '-1');
INSERT INTO `audittrail` VALUES ('21', '2021-03-10 19:19:20', '/bz/usersedit.php', '-1', 'U', 'users', 'password', '14', '********', '********');
INSERT INTO `audittrail` VALUES ('22', '2021-03-10 19:20:04', '/bz/usersedit.php', '-1', 'U', 'users', 'email', '14', 'jmadrazo7+02@gmail.com', 'amadrazo@ufm.edu');
INSERT INTO `audittrail` VALUES ('23', '2021-03-10 19:20:23', '/bz/usersedit.php', '-1', 'U', 'users', 'user_level', '14', '-1', '0');
INSERT INTO `audittrail` VALUES ('24', '2021-03-10 20:05:57', '/bz/logout.php', 'Administrator', 'logout', '190.104.120.207', '', '', '', '');
INSERT INTO `audittrail` VALUES ('25', '2021-03-10 20:06:11', '/bz/login.php', 'jmadrazo7@gmail.com', 'login', '190.104.120.207', '', '', '', '');
INSERT INTO `audittrail` VALUES ('26', '2021-03-10 20:06:19', '/bz/logout.php', 'jmadrazo7@gmail.com', 'logout', '190.104.120.207', '', '', '', '');
INSERT INTO `audittrail` VALUES ('27', '2021-03-10 20:06:26', '/bz/login.php', 'amadrazo@ufm.edu', 'login', '190.104.120.207', '', '', '', '');
INSERT INTO `audittrail` VALUES ('28', '2021-03-10 20:08:21', '/bz/logout.php', 'amadrazo@ufm.edu', 'logout', '190.104.120.207', '', '', '', '');
INSERT INTO `audittrail` VALUES ('29', '2021-03-10 20:08:33', '/bz/login.php', 'jmadrazo7@gmail.com', 'login', '190.104.120.207', '', '', '', '');
INSERT INTO `audittrail` VALUES ('30', '2021-03-10 20:35:27', '/bz/usersedit.php', '7', 'U', 'users', 'user_level', '14', '0', '1');
INSERT INTO `audittrail` VALUES ('31', '2021-03-10 20:39:29', '/bz/logout.php', 'jmadrazo7@gmail.com', 'logout', '190.104.120.207', '', '', '', '');
INSERT INTO `audittrail` VALUES ('32', '2021-03-10 20:39:36', '/bz/login.php', 'amadrazo@ufm.edu', 'login', '190.104.120.207', '', '', '', '');
INSERT INTO `audittrail` VALUES ('33', '2021-03-10 20:39:56', '/bz/logout.php', 'amadrazo@ufm.edu', 'logout', '190.104.120.207', '', '', '', '');
INSERT INTO `audittrail` VALUES ('34', '2021-03-10 20:40:22', '/bz/login.php', 'jmadrazo7@gmail.com', 'login', '190.104.120.207', '', '', '', '');
INSERT INTO `audittrail` VALUES ('35', '2021-03-10 20:46:49', '/bz//api/index.php', '14', 'A', 'assessments', 'user_id', '215', '', '14');
INSERT INTO `audittrail` VALUES ('36', '2021-03-10 20:46:49', '/bz//api/index.php', '14', 'A', 'assessments', 'customer_id', '215', '', '1232');
INSERT INTO `audittrail` VALUES ('37', '2021-03-10 20:46:49', '/bz//api/index.php', '14', 'A', 'assessments', 'customer_first_name', '215', '', 'Alex');
INSERT INTO `audittrail` VALUES ('38', '2021-03-10 20:46:49', '/bz//api/index.php', '14', 'A', 'assessments', 'customer_age', '215', '', '23');
INSERT INTO `audittrail` VALUES ('39', '2021-03-10 20:46:49', '/bz//api/index.php', '14', 'A', 'assessments', 'sex', '215', '', 'M');
INSERT INTO `audittrail` VALUES ('40', '2021-03-10 20:46:49', '/bz//api/index.php', '14', 'A', 'assessments', 'address', '215', '', 'Orange Walk District, Orange Walk, Belize');
INSERT INTO `audittrail` VALUES ('41', '2021-03-10 20:46:49', '/bz//api/index.php', '14', 'A', 'assessments', 'status', '215', '', '0');
INSERT INTO `audittrail` VALUES ('42', '2021-03-10 20:46:49', '/bz//api/index.php', '14', 'A', 'assessments', 'loan_purpose', '215', '', '2');
INSERT INTO `audittrail` VALUES ('43', '2021-03-10 20:46:49', '/bz//api/index.php', '14', 'A', 'assessments', 'loan_section', '215', '', '1');
INSERT INTO `audittrail` VALUES ('44', '2021-03-10 20:46:49', '/bz//api/index.php', '14', 'A', 'assessments', 'lat', '215', '', '17.833333');
INSERT INTO `audittrail` VALUES ('45', '2021-03-10 20:46:49', '/bz//api/index.php', '14', 'A', 'assessments', 'lon', '215', '', '-88.833333');
INSERT INTO `audittrail` VALUES ('46', '2021-03-10 20:46:49', '/bz//api/index.php', '14', 'A', 'assessments', 'id', '215', '', '215');
INSERT INTO `audittrail` VALUES ('47', '2021-03-10 20:50:40', '/bz/logout.php', 'jmadrazo7@gmail.com', 'logout', '190.104.120.207', '', '', '', '');
INSERT INTO `audittrail` VALUES ('48', '2021-03-10 20:50:48', '/bz/login.php', 'amadrazo@ufm.edu', 'login', '190.104.120.207', '', '', '', '');
INSERT INTO `audittrail` VALUES ('49', '2021-03-10 21:19:38', '/bz/logout.php', 'amadrazo@ufm.edu', 'logout', '190.104.120.207', '', '', '', '');
INSERT INTO `audittrail` VALUES ('50', '2021-03-10 21:20:39', '/bz/login.php', 'admin@mail.com', 'login', '190.104.120.207', '', '', '', '');

-- ----------------------------
-- Table structure for `key_value`
-- ----------------------------
DROP TABLE IF EXISTS `key_value`;
CREATE TABLE `key_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of key_value
-- ----------------------------

-- ----------------------------
-- Table structure for `loan_purposes`
-- ----------------------------
DROP TABLE IF EXISTS `loan_purposes`;
CREATE TABLE `loan_purposes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of loan_purposes
-- ----------------------------
INSERT INTO `loan_purposes` VALUES ('1', 'Working Capital', 'Working Capital', '2020-12-10 12:02:08', '2020-12-10 12:02:08');
INSERT INTO `loan_purposes` VALUES ('2', 'Equipment', 'Equipment', '2020-12-10 12:02:16', '2020-12-10 12:02:16');
INSERT INTO `loan_purposes` VALUES ('3', 'Training', 'Training', '2020-12-10 12:02:29', '2020-12-10 12:02:29');

-- ----------------------------
-- Table structure for `loan_section`
-- ----------------------------
DROP TABLE IF EXISTS `loan_section`;
CREATE TABLE `loan_section` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of loan_section
-- ----------------------------
INSERT INTO `loan_section` VALUES ('1', 'Agriculture', 'Agriculture', '2020-12-10 12:03:28', '2020-12-10 12:03:28');
INSERT INTO `loan_section` VALUES ('2', 'Fisheries', 'Fisheries', '2020-12-10 12:03:40', '2020-12-10 12:03:40');
INSERT INTO `loan_section` VALUES ('3', 'Livestock', 'Livestock', '2020-12-10 12:03:49', '2020-12-10 12:03:49');
INSERT INTO `loan_section` VALUES ('4', 'Commercial', 'Commercial', '2020-12-14 13:26:05', '2020-12-14 13:26:13');

-- ----------------------------
-- Table structure for `questions`
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `placeholder` varchar(512) DEFAULT NULL,
  `questions` varchar(1028) DEFAULT NULL,
  `scores` varchar(255) DEFAULT NULL,
  `type` int(11) unsigned DEFAULT NULL,
  `section` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `has_recommendations` int(11) DEFAULT NULL,
  `group` int(10) unsigned DEFAULT NULL,
  `category` int(10) unsigned DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `recommendation_by_score` varchar(1028) DEFAULT NULL,
  `recommendation_score` decimal(5,2) DEFAULT NULL,
  `related` int(11) DEFAULT NULL,
  `trigger_related_val` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_questions_question_type` (`type`),
  KEY `FK_questions_section` (`section`),
  KEY `fk_questions_question_groups1_idx` (`group`),
  KEY `fk_questions_question_category1_idx` (`category`),
  CONSTRAINT `FK_questions_question_type` FOREIGN KEY (`type`) REFERENCES `question_types` (`id`),
  CONSTRAINT `FK_questions_section` FOREIGN KEY (`section`) REFERENCES `sections` (`id`),
  CONSTRAINT `fk_questions_question_category1` FOREIGN KEY (`category`) REFERENCES `question_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_questions_question_groups1` FOREIGN KEY (`group`) REFERENCES `question_groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of questions
-- ----------------------------
INSERT INTO `questions` VALUES ('11', 'Loan Duration', 'What is the loan duration?', 'From 3-12M | From 12-24M | From 24-48M', '0.5 | 0.3 | 0.2', '2', '1', '1', '2020-12-09 12:44:10', '2020-12-17 15:40:24', null, '0', '0', '1', null, null, null, null);
INSERT INTO `questions` VALUES ('12', 'Climatic Hazard', 'Has your business suffered by any climatic hazard in the last 10 years? ', 'Yes | No', '0.5 | 1', '8', '1', '1', '2020-12-09 12:47:31', '2021-01-20 12:41:45', null, null, null, '2', null, null, null, null);
INSERT INTO `questions` VALUES ('13', 'Climate Risks Association', 'With what climate risk was associated this hazard? ', 'Hurricane | Heavy rain | Flood | Drought | Winds | Other', '1 | 0.8 | 0.8 | 0.6 | 0.6 | 0.6', '7', '1', '1', '2020-12-09 12:50:35', '2021-01-20 12:41:37', null, null, null, '3', null, null, '12', 'Yes');
INSERT INTO `questions` VALUES ('14', 'Climatic potential impact', 'Do you oversee any climatic potential impact for your project?', 'Yes | No', '0.5 | 1', '8', '1', '1', '2020-12-09 12:51:32', '2021-01-20 12:42:09', null, null, null, '4', null, null, null, null);
INSERT INTO `questions` VALUES ('15', 'Which climatic potential impact', 'Do you oversee any climatic potential impact for your project?', 'Hurricane | Heavy rain | Flood | Drought | Winds | Other', '1 | 0.8 | 0.8 | 0.6 | 0.6 | 0.6', '7', '1', '1', '2020-12-09 12:52:06', '2021-01-20 12:41:59', null, null, null, '5', null, null, '14', 'Yes');
INSERT INTO `questions` VALUES ('19', 'Flooding', 'Flooding', '0 | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8', '0.1 | 0.3 | 0.5 | 0.8 | 1 | 1 | 1 | 1 | 1', '9', '2', '1', '2020-12-09 13:07:20', '2021-01-19 19:33:38', null, null, null, '6', null, null, null, null);
INSERT INTO `questions` VALUES ('21', 'Climate change effect', 'Do you believe climate change could affect your way of managing your business if you don’t prepare?  ', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:16:44', '2021-01-21 13:26:17', '1', '1', '1', '8', 'TESTING! ATTENTION PLEASE!', '0.40', null, null);
INSERT INTO `questions` VALUES ('23', 'Climate change endangerment', 'Do you believe that climate change can endanger you and your business operations? ', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:29:21', '2020-12-22 20:45:18', '1', '1', '2', '9', null, null, null, null);
INSERT INTO `questions` VALUES ('24', 'Personal preparation', 'Can personal preparation for climate change protect your business? ', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:29:44', '2020-12-22 20:45:18', '1', '1', '3', '10', null, null, null, null);
INSERT INTO `questions` VALUES ('25', 'Obstacles and Barriers', 'Are there serious obstacles and barriers to protecting your business from negative consequences of climate change? ', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:30:03', '2020-12-22 20:45:18', '1', '1', '4', '11', null, null, null, null);
INSERT INTO `questions` VALUES ('26', 'Necessary Information', 'Do you think you have the information necessary to prepare for the impacts of climate change? ', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:30:52', '2020-12-22 20:45:18', '1', '1', '5', '12', null, null, null, null);
INSERT INTO `questions` VALUES ('27', 'Ability to power and protect', 'Do you think that you have the ability and power to protect yourself and your business of dangerous events from climate change? ', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:31:40', '2020-12-22 20:45:18', '1', '1', '6', '13', null, null, null, null);
INSERT INTO `questions` VALUES ('28', 'Reduction of energy consumption', 'Have you reduced your energy consumption in response to what you have heard about global climate change? ', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:32:05', '2021-03-10 12:29:11', '1', '1', '7', '14', 'Added a recommendation :)', '0.30', null, null);
INSERT INTO `questions` VALUES ('29', 'Current plan for protection', 'Does your business currently have a plan for what to do to protect yourself and your collaborators in the event of a disaster or emergency? Such a plan might include how you would evacuate your business place, or how to stay in contact with other colleagues and people? ', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:32:24', '2020-12-22 20:45:18', '1', '1', '8', '15', null, null, null, null);
INSERT INTO `questions` VALUES ('30', 'Change in temperature', 'Is there any change in the temperature in the last 10 years?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:32:54', '2020-12-22 20:45:18', '1', '2', '9', '16', null, null, null, null);
INSERT INTO `questions` VALUES ('31', 'Rain irregularity', 'In the last 5 to 10 years the rains have been irregular?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:33:21', '2020-12-22 20:45:18', '1', '2', '9', '17', null, null, null, null);
INSERT INTO `questions` VALUES ('32', 'Hurricanes perceived risk', 'Is there any perceived risk for hurricanes or tropical storms?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:33:50', '2020-12-22 20:45:18', '1', '2', '9', '18', null, null, null, null);
INSERT INTO `questions` VALUES ('33', 'Soil fertility', 'Does the fertility of the soil has been reduced in the last 5 to 10 years?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:34:14', '2020-12-22 20:45:18', '1', '2', '10', '19', null, null, null, null);
INSERT INTO `questions` VALUES ('34', 'Cop disease', 'In what extend have you notice the existence of disease in the crop?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:34:32', '2020-12-22 20:45:18', '1', '2', '10', '20', null, null, null, null);
INSERT INTO `questions` VALUES ('35', 'Yield reduction', 'In what extent have you noticed the yield reduction?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:34:46', '2020-12-22 20:45:18', '1', '2', '10', '21', null, null, null, null);
INSERT INTO `questions` VALUES ('36', 'Crop diversity', 'In what extend have you diversify your crop having different species including wood, fruit, shadow, etc?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:35:12', '2020-12-22 20:45:18', '1', '2', '11', '22', null, null, null, null);
INSERT INTO `questions` VALUES ('37', 'Forest cover', 'Do you have forest cover in your crop, including the cover beside the rivers?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:35:42', '2020-12-22 20:45:18', '1', '2', '11', '23', null, null, null, null);
INSERT INTO `questions` VALUES ('38', 'Organic Inputs', 'Do you use any organic inputs for your crop?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:35:55', '2020-12-22 20:45:18', '1', '2', '11', '24', null, null, null, null);
INSERT INTO `questions` VALUES ('39', 'Participation in Climate change adaption/mitigation', 'Do you participate in processes for climate change adaptation / mitigation?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:36:45', '2020-12-22 20:45:18', '1', '2', '11', '25', null, null, null, null);
INSERT INTO `questions` VALUES ('40', 'Change in temperature', 'Is there any change in the temperature in the last 10 years?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:41:15', '2020-12-22 20:45:18', '1', '3', '9', '26', null, null, null, null);
INSERT INTO `questions` VALUES ('41', 'Rain regularity', 'In the last 5 to 10 years the rains have been irregular?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:41:29', '2020-12-22 20:45:18', '1', '3', '9', '27', null, null, null, null);
INSERT INTO `questions` VALUES ('42', 'Perceived risk for hurricanes', 'Is there any perceived risk for hurricanes or tropical storms?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:42:04', '2020-12-22 20:45:18', '1', '3', '9', '28', null, null, null, null);
INSERT INTO `questions` VALUES ('43', 'Fish production reduction', 'Have you notice a reduce in the fish production in the last years?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:42:28', '2020-12-22 20:45:18', '1', '3', '10', '29', null, null, null, null);
INSERT INTO `questions` VALUES ('44', 'Weather effect', 'To what extent the weather have affected you or your business in the last 5 years?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:43:04', '2020-12-22 20:45:18', '1', '3', '10', '30', null, null, null, null);
INSERT INTO `questions` VALUES ('45', 'Species reduction', 'Have you noticed the reduction of certain species due the climate change?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:43:26', '2020-12-22 20:45:18', '1', '3', '10', '31', null, null, null, null);
INSERT INTO `questions` VALUES ('46', 'Climate and meteo information planning', 'To what extent have you included climate and meteorological information to plan your fishing?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:44:06', '2020-12-22 20:45:18', '1', '3', '11', '32', null, null, null, null);
INSERT INTO `questions` VALUES ('47', 'Tools or information for planning', 'Do you use any tools or access information from internet to better plan your fishing activities?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:44:28', '2020-12-22 20:45:18', '1', '3', '11', '33', null, null, null, null);
INSERT INTO `questions` VALUES ('48', 'Other income sources', 'Do you have other income sources as part of the fishing activities (Sale, preparation, process, transportation)?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:44:48', '2020-12-22 20:45:18', '1', '3', '11', '34', null, null, null, null);
INSERT INTO `questions` VALUES ('49', 'Communal activities participation', 'Do you participate in communal activities to learn and share experiences about how to adapt to climate change?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:45:19', '2020-12-22 20:45:18', '1', '3', '11', '35', null, null, null, null);
INSERT INTO `questions` VALUES ('50', 'Change in temperature', 'Is there any change in the temperature in the last 10 years?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:45:37', '2020-12-22 20:45:18', '1', '4', '9', '36', null, null, null, null);
INSERT INTO `questions` VALUES ('51', 'Rain regularity', 'In the last 5 to 10 years the rains have been irregulares?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:45:50', '2020-12-22 20:45:18', '1', '4', '9', '37', null, null, null, null);
INSERT INTO `questions` VALUES ('52', 'Hurricanes perceived risk', 'Is there any perceived risk for hurricanes or tropical storms?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:46:13', '2020-12-22 20:45:18', '1', '4', '9', '38', null, null, null, null);
INSERT INTO `questions` VALUES ('53', 'Sanitary problems', 'In what extent is there any sanitary problems associated with temperature changes?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:46:30', '2020-12-22 20:45:18', '1', '4', '10', '39', null, null, null, null);
INSERT INTO `questions` VALUES ('54', 'physiology and hormonal changes', 'In what extent is there any change in the physiology and hormonal changes in the species?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:47:15', '2020-12-22 20:45:18', '1', '4', '10', '40', null, null, null, null);
INSERT INTO `questions` VALUES ('55', 'Fertility and conception rate', 'In what extent is there a reduction of fertility and conception rate and / or mortality increase?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:47:35', '2020-12-22 20:45:18', '1', '4', '10', '41', null, null, null, null);
INSERT INTO `questions` VALUES ('56', 'Diet adaption', 'In what extent have you adapted the diet?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:47:54', '2020-12-22 20:45:18', '1', '4', '11', '42', null, null, null, null);
INSERT INTO `questions` VALUES ('57', 'Water access', 'In what extent have you improved the access to water?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:48:08', '2020-12-22 20:45:18', '1', '4', '11', '43', null, null, null, null);
INSERT INTO `questions` VALUES ('58', 'Number of species per unit area reduction', 'In what extent have you reduced the number of species per unit area?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:48:40', '2020-12-22 20:45:18', '1', '4', '11', '44', null, null, null, null);
INSERT INTO `questions` VALUES ('59', 'Species replacement', 'In what extent have you replaced species adapted to the new climate change conditions?', '1 | 2 | 3 | 4 | 5', '0.5 | 0.4 | 0.3 | 0.2 | 0.1', '8', '3', '1', '2020-12-09 16:49:26', '2020-12-22 20:45:18', '1', '4', '11', '45', null, null, null, null);
INSERT INTO `questions` VALUES ('60', 'Wildfires', 'Wildfires', '0 | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 10 | 11 | 12 | 13 | 14 | 15 | 16 | 17 | 18', '0 | 0.1 | 0.1 | 0.1 | 0.1 | 0.2 | 0.2 | 0.2 | 0.2 | 0.3 | 0.3 | 0.4 | 0.5 | 0.7 | 0.8 | 0.9 | 1 | 1 | 1', '9', '2', '1', '2020-12-11 05:14:23', '2020-12-22 22:42:01', null, null, null, '46', null, null, null, null);
INSERT INTO `questions` VALUES ('62', 'Drought', 'Drought', '0 | 1 | 2 | 3 | 4 | 5', '0 | 0.1 | 0.3 | 0.5 | 0.8 | 1', '9', '2', '1', '2020-12-18 10:29:18', '2021-01-19 19:38:17', null, null, null, '47', null, null, null, null);

-- ----------------------------
-- Table structure for `question_category`
-- ----------------------------
DROP TABLE IF EXISTS `question_category`;
CREATE TABLE `question_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of question_category
-- ----------------------------
INSERT INTO `question_category` VALUES ('1', 'Perceived susceptibility', 'Perceived susceptibility');
INSERT INTO `question_category` VALUES ('2', 'Perceived severity', 'Perceived severity');
INSERT INTO `question_category` VALUES ('3', 'Perceived benefits', 'Perceived benefits');
INSERT INTO `question_category` VALUES ('4', 'Perceived barriers', 'Perceived barriers');
INSERT INTO `question_category` VALUES ('5', 'Clues to action', 'Clues to action');
INSERT INTO `question_category` VALUES ('6', 'Self-efficacy', 'Self-efficacy');
INSERT INTO `question_category` VALUES ('7', 'Mitigation', 'Mitigation');
INSERT INTO `question_category` VALUES ('8', 'Emergency plan', 'Emergency plan');
INSERT INTO `question_category` VALUES ('9', 'Exposure', 'Exposure');
INSERT INTO `question_category` VALUES ('10', 'Impacts', 'Impacts');
INSERT INTO `question_category` VALUES ('11', 'Adaptative Capacity', 'Adaptative Capacity');

-- ----------------------------
-- Table structure for `question_groups`
-- ----------------------------
DROP TABLE IF EXISTS `question_groups`;
CREATE TABLE `question_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of question_groups
-- ----------------------------
INSERT INTO `question_groups` VALUES ('1', 'General', 'General');
INSERT INTO `question_groups` VALUES ('2', 'Agriculture', 'Agriculture');
INSERT INTO `question_groups` VALUES ('3', 'Fisheries', 'Fisheries');
INSERT INTO `question_groups` VALUES ('4', 'Livestock', 'Livestock');
INSERT INTO `question_groups` VALUES ('5', 'Commercial', 'Commercial');

-- ----------------------------
-- Table structure for `question_types`
-- ----------------------------
DROP TABLE IF EXISTS `question_types`;
CREATE TABLE `question_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of question_types
-- ----------------------------
INSERT INTO `question_types` VALUES ('2', 'Dropdown Single', 'Dropdowns are toggleable, contextual overlays for displaying lists of links and more. Allows users to select only one option.', '1', '2020-12-06 10:52:41', '2020-12-06 11:07:18');
INSERT INTO `question_types` VALUES ('3', 'Text field', 'single-line input field for text input', '1', '2020-12-06 10:53:22', '2020-12-06 10:53:22');
INSERT INTO `question_types` VALUES ('4', 'Text area', 'multi-line input box for text input', '1', '2020-12-06 10:53:44', '2020-12-06 10:53:44');
INSERT INTO `question_types` VALUES ('5', 'Integer', 'Defines a field for entering a integer number', '1', '2020-12-06 10:54:22', '2020-12-06 10:54:22');
INSERT INTO `question_types` VALUES ('6', 'Number', 'Defines a field for entering a number with decimals.', '1', '2020-12-06 10:54:52', '2020-12-06 10:54:52');
INSERT INTO `question_types` VALUES ('7', 'Checkbox group', 'The checkbox is shown as a square box that is ticked (checked) when activated. Multiple elements can be selected within a checkbox group.', '1', '2020-12-06 10:55:55', '2020-12-06 10:55:55');
INSERT INTO `question_types` VALUES ('8', 'Radio Group', 'Collections of radio buttons describing a set of related options. Radio buttons can be toggled between on/off. (Only one option can be active at the same time.)', '1', '2020-12-06 10:57:48', '2020-12-06 10:57:48');
INSERT INTO `question_types` VALUES ('9', 'Climate Risk Card', 'Custom input component for climate risk assessment.', '1', '2020-12-06 11:01:05', '2020-12-06 11:01:05');
INSERT INTO `question_types` VALUES ('10', 'Dropdown multiple', 'A dropdown selection tool based on a list of options. Allows users to select multiple options.', '1', '2020-12-06 11:03:14', '2020-12-06 11:03:38');
INSERT INTO `question_types` VALUES ('11', 'Geolocation', 'Geolocation input using a custom map input that stores a Lat,Lon tuple.', '1', '2020-12-06 11:04:58', '2020-12-06 11:05:21');
INSERT INTO `question_types` VALUES ('12', 'Range selector slider', 'Slider is an interactive component that lets the user swiftly slide through possible values spread over a desired range using a specified step.', '1', '2020-12-06 11:09:42', '2020-12-06 11:11:03');
INSERT INTO `question_types` VALUES ('13', 'Range Selector Radio', 'Custom component that lets the user select possible values from a desired range using single radio buttons for each option.', '1', '2020-12-06 11:10:50', '2020-12-06 11:14:23');
INSERT INTO `question_types` VALUES ('14', 'Date Range', 'Custom input component which consists of two inputs: 1.From (date selector) 2.To (date selector)', '1', '2020-12-06 11:13:58', '2020-12-06 11:13:58');
INSERT INTO `question_types` VALUES ('15', 'Date Selector', 'Single date selector', '1', '2020-12-06 11:14:17', '2020-12-06 11:14:17');
INSERT INTO `question_types` VALUES ('16', 'Title', 'Simple Title for UI-UX purposes', '1', '2020-12-06 11:51:03', '2020-12-06 11:51:03');
INSERT INTO `question_types` VALUES ('17', 'Sub Title', 'Simple sub title for UI-UX purposes', '1', '2020-12-06 11:51:47', '2020-12-06 11:51:47');

-- ----------------------------
-- Table structure for `results`
-- ----------------------------
DROP TABLE IF EXISTS `results`;
CREATE TABLE `results` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `assessment_id` int(11) unsigned DEFAULT NULL,
  `answers` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_results_assesment` (`assessment_id`),
  CONSTRAINT `FK_results_assesment` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of results
-- ----------------------------

-- ----------------------------
-- Table structure for `sections`
-- ----------------------------
DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `weight` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sections
-- ----------------------------
INSERT INTO `sections` VALUES ('1', 'Business Information', 'Business information tab', '1', '2020-12-06 11:49:48', '2020-12-22 10:55:34', '20.00');
INSERT INTO `sections` VALUES ('2', 'Climate Risk Card', 'Climate Risk Card', '2', '2020-12-09 12:53:04', '2020-12-22 10:56:03', '50.00');
INSERT INTO `sections` VALUES ('3', 'Climate Preparedness', 'Climate Preparedness', '3', '2020-12-09 13:08:57', '2020-12-22 10:55:56', '30.00');

-- ----------------------------
-- Table structure for `userlevelpermissions`
-- ----------------------------
DROP TABLE IF EXISTS `userlevelpermissions`;
CREATE TABLE `userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(191) NOT NULL DEFAULT '',
  `permission` int(11) NOT NULL,
  PRIMARY KEY (`userlevelid`,`tablename`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of userlevelpermissions
-- ----------------------------
INSERT INTO `userlevelpermissions` VALUES ('-2', '{98C27E89-2937-4D47-9B89-35CA334C4E82}answers', '0');
INSERT INTO `userlevelpermissions` VALUES ('-2', '{98C27E89-2937-4D47-9B89-35CA334C4E82}assessments', '0');
INSERT INTO `userlevelpermissions` VALUES ('-2', '{98C27E89-2937-4D47-9B89-35CA334C4E82}loan_purposes', '0');
INSERT INTO `userlevelpermissions` VALUES ('-2', '{98C27E89-2937-4D47-9B89-35CA334C4E82}loan_section', '0');
INSERT INTO `userlevelpermissions` VALUES ('-2', '{98C27E89-2937-4D47-9B89-35CA334C4E82}questions', '0');
INSERT INTO `userlevelpermissions` VALUES ('-2', '{98C27E89-2937-4D47-9B89-35CA334C4E82}questions-answers', '0');
INSERT INTO `userlevelpermissions` VALUES ('-2', '{98C27E89-2937-4D47-9B89-35CA334C4E82}question_category', '0');
INSERT INTO `userlevelpermissions` VALUES ('-2', '{98C27E89-2937-4D47-9B89-35CA334C4E82}question_groups', '0');
INSERT INTO `userlevelpermissions` VALUES ('-2', '{98C27E89-2937-4D47-9B89-35CA334C4E82}question_types', '0');
INSERT INTO `userlevelpermissions` VALUES ('-2', '{98C27E89-2937-4D47-9B89-35CA334C4E82}results', '0');
INSERT INTO `userlevelpermissions` VALUES ('-2', '{98C27E89-2937-4D47-9B89-35CA334C4E82}sections', '0');
INSERT INTO `userlevelpermissions` VALUES ('-2', '{98C27E89-2937-4D47-9B89-35CA334C4E82}userlevelpermissions', '0');
INSERT INTO `userlevelpermissions` VALUES ('-2', '{98C27E89-2937-4D47-9B89-35CA334C4E82}userlevels', '0');
INSERT INTO `userlevelpermissions` VALUES ('-2', '{98C27E89-2937-4D47-9B89-35CA334C4E82}users', '0');
INSERT INTO `userlevelpermissions` VALUES ('-2', '{98C27E89-2937-4D47-9B89-35CA334C4E82}user_levels', '0');
INSERT INTO `userlevelpermissions` VALUES ('-2', '{98C27E89-2937-4D47-9B89-35CA334C4E82}view1', '0');
INSERT INTO `userlevelpermissions` VALUES ('0', '{98C27E89-2937-4D47-9B89-35CA334C4E82}answers', '511');
INSERT INTO `userlevelpermissions` VALUES ('0', '{98C27E89-2937-4D47-9B89-35CA334C4E82}assessments', '511');
INSERT INTO `userlevelpermissions` VALUES ('0', '{98C27E89-2937-4D47-9B89-35CA334C4E82}audittrail', '151');
INSERT INTO `userlevelpermissions` VALUES ('0', '{98C27E89-2937-4D47-9B89-35CA334C4E82}key_value', '151');
INSERT INTO `userlevelpermissions` VALUES ('0', '{98C27E89-2937-4D47-9B89-35CA334C4E82}loan_purposes', '511');
INSERT INTO `userlevelpermissions` VALUES ('0', '{98C27E89-2937-4D47-9B89-35CA334C4E82}loan_section', '511');
INSERT INTO `userlevelpermissions` VALUES ('0', '{98C27E89-2937-4D47-9B89-35CA334C4E82}questions', '511');
INSERT INTO `userlevelpermissions` VALUES ('0', '{98C27E89-2937-4D47-9B89-35CA334C4E82}questions-answers', '511');
INSERT INTO `userlevelpermissions` VALUES ('0', '{98C27E89-2937-4D47-9B89-35CA334C4E82}question_category', '511');
INSERT INTO `userlevelpermissions` VALUES ('0', '{98C27E89-2937-4D47-9B89-35CA334C4E82}question_groups', '511');
INSERT INTO `userlevelpermissions` VALUES ('0', '{98C27E89-2937-4D47-9B89-35CA334C4E82}question_types', '511');
INSERT INTO `userlevelpermissions` VALUES ('0', '{98C27E89-2937-4D47-9B89-35CA334C4E82}results', '511');
INSERT INTO `userlevelpermissions` VALUES ('0', '{98C27E89-2937-4D47-9B89-35CA334C4E82}sections', '511');
INSERT INTO `userlevelpermissions` VALUES ('0', '{98C27E89-2937-4D47-9B89-35CA334C4E82}userlevelpermissions', '511');
INSERT INTO `userlevelpermissions` VALUES ('0', '{98C27E89-2937-4D47-9B89-35CA334C4E82}userlevels', '511');
INSERT INTO `userlevelpermissions` VALUES ('0', '{98C27E89-2937-4D47-9B89-35CA334C4E82}users', '511');
INSERT INTO `userlevelpermissions` VALUES ('0', '{98C27E89-2937-4D47-9B89-35CA334C4E82}user_levels', '511');
INSERT INTO `userlevelpermissions` VALUES ('0', '{98C27E89-2937-4D47-9B89-35CA334C4E82}view1', '511');
INSERT INTO `userlevelpermissions` VALUES ('1', '{98C27E89-2937-4D47-9B89-35CA334C4E82}answers', '365');
INSERT INTO `userlevelpermissions` VALUES ('1', '{98C27E89-2937-4D47-9B89-35CA334C4E82}assessments', '365');
INSERT INTO `userlevelpermissions` VALUES ('1', '{98C27E89-2937-4D47-9B89-35CA334C4E82}audittrail', '360');
INSERT INTO `userlevelpermissions` VALUES ('1', '{98C27E89-2937-4D47-9B89-35CA334C4E82}key_value', '360');
INSERT INTO `userlevelpermissions` VALUES ('1', '{98C27E89-2937-4D47-9B89-35CA334C4E82}loan_purposes', '360');
INSERT INTO `userlevelpermissions` VALUES ('1', '{98C27E89-2937-4D47-9B89-35CA334C4E82}loan_section', '360');
INSERT INTO `userlevelpermissions` VALUES ('1', '{98C27E89-2937-4D47-9B89-35CA334C4E82}questions', '360');
INSERT INTO `userlevelpermissions` VALUES ('1', '{98C27E89-2937-4D47-9B89-35CA334C4E82}questions-answers', '360');
INSERT INTO `userlevelpermissions` VALUES ('1', '{98C27E89-2937-4D47-9B89-35CA334C4E82}question_category', '360');
INSERT INTO `userlevelpermissions` VALUES ('1', '{98C27E89-2937-4D47-9B89-35CA334C4E82}question_groups', '360');
INSERT INTO `userlevelpermissions` VALUES ('1', '{98C27E89-2937-4D47-9B89-35CA334C4E82}question_types', '360');
INSERT INTO `userlevelpermissions` VALUES ('1', '{98C27E89-2937-4D47-9B89-35CA334C4E82}results', '360');
INSERT INTO `userlevelpermissions` VALUES ('1', '{98C27E89-2937-4D47-9B89-35CA334C4E82}sections', '360');
INSERT INTO `userlevelpermissions` VALUES ('1', '{98C27E89-2937-4D47-9B89-35CA334C4E82}userlevelpermissions', '360');
INSERT INTO `userlevelpermissions` VALUES ('1', '{98C27E89-2937-4D47-9B89-35CA334C4E82}userlevels', '360');
INSERT INTO `userlevelpermissions` VALUES ('1', '{98C27E89-2937-4D47-9B89-35CA334C4E82}users', '360');
INSERT INTO `userlevelpermissions` VALUES ('1', '{98C27E89-2937-4D47-9B89-35CA334C4E82}user_levels', '360');
INSERT INTO `userlevelpermissions` VALUES ('1', '{98C27E89-2937-4D47-9B89-35CA334C4E82}view1', '360');

-- ----------------------------
-- Table structure for `userlevels`
-- ----------------------------
DROP TABLE IF EXISTS `userlevels`;
CREATE TABLE `userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(80) NOT NULL,
  PRIMARY KEY (`userlevelid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of userlevels
-- ----------------------------
INSERT INTO `userlevels` VALUES ('-2', 'Anonymous');
INSERT INTO `userlevels` VALUES ('-1', 'Administrator');
INSERT INTO `userlevels` VALUES ('0', 'Default');
INSERT INTO `userlevels` VALUES ('1', 'Consultant');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_names` varchar(255) DEFAULT NULL,
  `last_names` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_level` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('7', 'Administrator', 'Admin', 'admin@mail.com', '4297f44b13955235245b2497399d7a93', '-1', '2020-12-16 17:41:48', '2021-03-10 15:18:17');
INSERT INTO `users` VALUES ('8', 'Norman', 'Avila', 'neavilag@gmail.com', '4297f44b13955235245b2497399d7a93', '-1', '2020-12-17 07:43:30', '2020-12-17 07:44:29');
INSERT INTO `users` VALUES ('9', 'Ale', 'Solis', 'alejandro_solis@dai.com', 'cc11669bcddad69d4a42bb8344f988ea', '-1', '2020-12-21 11:18:57', '2020-12-21 11:18:57');

-- ----------------------------
-- Table structure for `user_levels`
-- ----------------------------
DROP TABLE IF EXISTS `user_levels`;
CREATE TABLE `user_levels` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_levels
-- ----------------------------
INSERT INTO `user_levels` VALUES ('1', 'admin', null, '2020-12-06 09:39:18', '2020-12-06 09:39:18');

-- ----------------------------
-- View structure for `questions-answers`
-- ----------------------------
DROP VIEW IF EXISTS `questions-answers`;
CREATE ALGORITHM=UNDEFINED DEFINER=CURRENT_USER SQL SECURITY DEFINER VIEW `questions-answers` AS select `questions`.`id` AS `question_id`,`questions`.`title` AS `question_title`,`questions`.`placeholder` AS `question_placeholder`,`questions`.`questions` AS `question_questions`,`questions`.`scores` AS `question_scores`,`questions`.`active` AS `question_active`,`questions`.`section` AS `question_section_id`,`questions`.`type` AS `question_type`,`questions`.`has_recommendations` AS `question_has_recommendations`,`questions`.`group` AS `question_group_id`,`questions`.`category` AS `question_category_id`,`questions`.`order` AS `question_order`,`answers`.`id` AS `answer_id`,`answers`.`response` AS `answer_response`,`answers`.`score` AS `answer_score`,`answers`.`assessment_id` AS `assessment_id`,`answers`.`weight` AS `answer_weight`,`answers`.`section_id` AS `answer_section_id`,`answers`.`recommendations` AS `answer_recommendations`,`question_types`.`name` AS `question_type_name`,`question_groups`.`name` AS `question_group_name`,`question_category`.`name` AS `question_category_name`,`assessments`.`customer_id` AS `assessment_customer_id`,`assessments`.`customer_first_name` AS `assessment_customer_first_name`,`assessments`.`status` AS `assessment_status`,`assessments`.`total_score` AS `assessment_total_score`,`assessments`.`customer_last_name` AS `assessment_customer_last_name`,`assessments`.`user_id` AS `assessment_user_id`,`users`.`first_names` AS `assessment_user_first_name`,`users`.`last_names` AS `assessment_user_last_name`,`users`.`email` AS `assessment_user_email`,`assessments`.`personal_id` AS `assessment_personal_id`,`assessments`.`customer_age` AS `assessment_customer_age`,`assessments`.`sex` AS `assessment_sex`,`assessments`.`address` AS `assessment_address`,`assessments`.`lat` AS `assessment_lat`,`assessments`.`lon` AS `assessment_lon`,`loan_purposes`.`name` AS `assessment_loan_purpose`,`loan_section`.`name` AS `assessment_loan_section`,`assessments`.`created_at` AS `created_at`,`assessments`.`updated_at` AS `updated_at`,`loan_purposes`.`id` AS `loan_purpose_id`,`loan_section`.`id` AS `loan_sector_id` from ((((((((`answers` join `questions` on((`questions`.`id` = `answers`.`question_id`))) join `question_types` on((`question_types`.`id` = `questions`.`type`))) join `question_groups` on((`question_groups`.`id` = `questions`.`group`))) join `question_category` on((`question_category`.`id` = `questions`.`category`))) join `assessments` on((`assessments`.`id` = `answers`.`assessment_id`))) join `users` on((`users`.`id` = `assessments`.`user_id`))) join `loan_purposes` on((`loan_purposes`.`id` = `assessments`.`loan_purpose`))) join `loan_section` on((`loan_section`.`id` = `assessments`.`loan_section`))) ;

-- ----------------------------
-- View structure for `view1`
-- ----------------------------
DROP VIEW IF EXISTS `view1`;
CREATE ALGORITHM=UNDEFINED DEFINER=CURRENT_USER SQL SECURITY DEFINER VIEW `view1` AS select `loan_section`.`id` AS `loan_section_id`,`loan_section`.`name` AS `loan_section_name`,`users`.`id` AS `user_id`,`users`.`email` AS `email`,`loan_purposes`.`id` AS `loan_purpose_id`,`loan_purposes`.`name` AS `loan_purpose_name`,`assessments`.`id` AS `assessment_id`,`assessments`.`customer_id` AS `customer_id`,`assessments`.`total_score` AS `total_score`,`assessments`.`status` AS `status`,`assessments`.`customer_first_name` AS `customer_first_name`,`assessments`.`customer_last_name` AS `customer_last_name`,`assessments`.`customer_age` AS `customer_age`,`assessments`.`sex` AS `sex`,`assessments`.`address` AS `address`,`assessments`.`lat` AS `lat`,`assessments`.`lon` AS `lon`,`assessments`.`created_at` AS `created_at`,`assessments`.`updated_at` AS `updated_at`,`users`.`user_level` AS `user_level` from (((`assessments` join `users` on((`users`.`id` = `assessments`.`user_id`))) join `loan_purposes` on((`loan_purposes`.`id` = `assessments`.`loan_purpose`))) join `loan_section` on((`loan_section`.`id` = `assessments`.`loan_section`))) order by `loan_section`.`id` desc ;
DROP TRIGGER IF EXISTS `ins_answer`;
DELIMITER ;;
CREATE TRIGGER `ins_answer` AFTER INSERT ON `answers` FOR EACH ROW BEGIN
DECLARE suma_score decimal(20,4);

select sum(score) into suma_score from answers where assessment_id = NEW.assessment_id;
update assessments set total_score = suma_score where id=NEW.assessment_id;

END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `upd_answer`;
DELIMITER ;;
CREATE TRIGGER `upd_answer` AFTER UPDATE ON `answers` FOR EACH ROW BEGIN
DECLARE suma_score decimal(20,4);

select sum(score) into suma_score from answers where assessment_id = NEW.assessment_id;
update assessments set total_score = suma_score where id=NEW.assessment_id;

END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `del_answer`;
DELIMITER ;;
CREATE TRIGGER `del_answer` AFTER DELETE ON `answers` FOR EACH ROW BEGIN
DECLARE suma_score decimal(20,4);

select sum(score) into suma_score from answers where assessment_id = OLD.assessment_id;
update assessments set total_score = suma_score where id=OLD.assessment_id;

END
;;
DELIMITER ;
