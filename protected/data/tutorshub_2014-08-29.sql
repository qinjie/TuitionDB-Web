# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.16)
# Database: tutorshub
# Generation Time: 2014-08-29 03:33:22 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table assignment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `assignment`;

CREATE TABLE `assignment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `requestorId` int(10) unsigned NOT NULL,
  `genderCode` int(5) unsigned DEFAULT NULL,
  `raceCode` int(5) unsigned DEFAULT NULL,
  `yearOfBirth` int(10) unsigned DEFAULT NULL,
  `currentSchool` varchar(100) DEFAULT NULL,
  `dictCategoryId` int(10) unsigned NOT NULL,
  `lessonPerMonth` int(10) unsigned NOT NULL,
  `hourPerLesson` float(2,1) unsigned NOT NULL DEFAULT '2.0',
  `tutorGenderCode` int(5) unsigned DEFAULT NULL COMMENT 'dictionary/gender',
  `tutorRaceCode` int(5) unsigned DEFAULT NULL,
  `budgetRate` int(10) unsigned DEFAULT NULL,
  `minQualificationId` int(10) unsigned DEFAULT NULL,
  `teachingCredential` int(5) unsigned DEFAULT NULL COMMENT 'true/false',
  `remark` varchar(500) DEFAULT NULL,
  `statusCode` int(5) unsigned DEFAULT '0' COMMENT 'dictionary/assignmentStatus',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `requestorId` (`requestorId`),
  KEY `dictCategoryId` (`dictCategoryId`),
  KEY `minQualificationId` (`minQualificationId`),
  CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`requestorId`) REFERENCES `requestor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `assignment_ibfk_4` FOREIGN KEY (`dictCategoryId`) REFERENCES `dictcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `assignment_ibfk_6` FOREIGN KEY (`minQualificationId`) REFERENCES `dicttutorqualification` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `assignment` WRITE;
/*!40000 ALTER TABLE `assignment` DISABLE KEYS */;

INSERT INTO `assignment` (`id`, `requestorId`, `genderCode`, `raceCode`, `yearOfBirth`, `currentSchool`, `dictCategoryId`, `lessonPerMonth`, `hourPerLesson`, `tutorGenderCode`, `tutorRaceCode`, `budgetRate`, `minQualificationId`, `teachingCredential`, `remark`, `statusCode`, `created`, `modified`)
VALUES
	(1,1,1,0,1997,'SINGAPORE POLYTECHNIC',8,2,2.0,1,NULL,50,3,NULL,'',0,'2014-07-03 11:46:07','2014-07-03 11:46:07'),
	(2,2,0,0,2010,'',11,4,2.0,NULL,0,50,NULL,NULL,'',2,'2014-07-08 08:36:42','2014-07-12 17:21:46'),
	(3,2,0,0,2001,'',4,8,1.0,NULL,0,50,3,NULL,'',2,'2014-07-08 08:40:34','2014-07-12 16:07:11'),
	(4,2,1,0,2000,'',5,4,2.0,NULL,0,50,3,NULL,'',0,'2014-07-08 16:10:57','2014-07-08 16:10:57');

/*!40000 ALTER TABLE `assignment` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table assignmentapplication
# ------------------------------------------------------------

DROP TABLE IF EXISTS `assignmentapplication`;

CREATE TABLE `assignmentapplication` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `assignmentId` int(10) unsigned NOT NULL,
  `tutorId` int(10) unsigned NOT NULL,
  `statusCode` int(5) unsigned NOT NULL COMMENT 'lookup/selfMatchStatus',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `assignmentId` (`assignmentId`),
  KEY `tutorId` (`tutorId`),
  CONSTRAINT `assignmentapplication_ibfk_1` FOREIGN KEY (`assignmentId`) REFERENCES `assignment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `assignmentapplication_ibfk_2` FOREIGN KEY (`tutorId`) REFERENCES `tutor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `assignmentapplication` WRITE;
/*!40000 ALTER TABLE `assignmentapplication` DISABLE KEYS */;

INSERT INTO `assignmentapplication` (`id`, `assignmentId`, `tutorId`, `statusCode`, `created`, `modified`)
VALUES
	(1,1,4,4,'2014-07-03 11:53:07','2014-07-03 13:12:04'),
	(2,1,3,3,'2014-07-03 13:00:45','2014-07-08 08:32:31'),
	(3,4,3,4,'2014-07-08 16:16:06','2014-07-08 16:20:12'),
	(4,2,3,6,'2014-07-08 16:16:20','2014-07-12 17:21:46'),
	(5,3,3,6,'2014-07-08 16:16:30','2014-07-12 16:07:11');

/*!40000 ALTER TABLE `assignmentapplication` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table assignmentpageview
# ------------------------------------------------------------

DROP TABLE IF EXISTS `assignmentpageview`;

CREATE TABLE `assignmentpageview` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `assignmentId` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `assignmentId` (`assignmentId`),
  CONSTRAINT `assignmentpageview_ibfk_1` FOREIGN KEY (`assignmentId`) REFERENCES `assignment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `assignmentpageview` WRITE;
/*!40000 ALTER TABLE `assignmentpageview` DISABLE KEYS */;

INSERT INTO `assignmentpageview` (`id`, `assignmentId`, `count`, `created`, `modified`)
VALUES
	(1,1,16,'2014-07-03 11:53:07','2014-07-20 18:21:28'),
	(2,4,15,'2014-07-08 16:16:06','2014-07-20 18:19:47'),
	(3,2,4,'2014-07-08 16:16:20','2014-07-20 18:21:51'),
	(4,3,3,'2014-07-08 16:16:30','2014-07-11 03:13:49');

/*!40000 ALTER TABLE `assignmentpageview` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table assignmentreview
# ------------------------------------------------------------

DROP TABLE IF EXISTS `assignmentreview`;

CREATE TABLE `assignmentreview` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `assignmentId` int(10) unsigned NOT NULL,
  `tutorId` int(10) unsigned NOT NULL,
  `tutorRating` int(10) unsigned NOT NULL COMMENT 'value of 1 - 5',
  `comment` varchar(500) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `assignmentId` (`assignmentId`),
  KEY `assignmentreview_ibfk_1` (`tutorId`),
  CONSTRAINT `assignmentreview_ibfk_1` FOREIGN KEY (`tutorId`) REFERENCES `tutor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `assignmentreview_ibfk_2` FOREIGN KEY (`assignmentId`) REFERENCES `assignment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table assignmentschedule
# ------------------------------------------------------------

DROP TABLE IF EXISTS `assignmentschedule`;

CREATE TABLE `assignmentschedule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `assignmentId` int(10) unsigned DEFAULT NULL,
  `dictScheduleId` int(10) unsigned DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `assignmentId` (`assignmentId`),
  KEY `dictScheduleId` (`dictScheduleId`),
  CONSTRAINT `assignmentschedule_ibfk_1` FOREIGN KEY (`assignmentId`) REFERENCES `assignment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `assignmentschedule_ibfk_2` FOREIGN KEY (`dictScheduleId`) REFERENCES `dictschedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `assignmentschedule` WRITE;
/*!40000 ALTER TABLE `assignmentschedule` DISABLE KEYS */;

INSERT INTO `assignmentschedule` (`id`, `assignmentId`, `dictScheduleId`, `modified`)
VALUES
	(5,3,1,'2014-07-12 10:17:04'),
	(6,3,5,'2014-07-12 10:17:04'),
	(7,3,8,'2014-07-12 10:17:04');

/*!40000 ALTER TABLE `assignmentschedule` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table assignmentsubject
# ------------------------------------------------------------

DROP TABLE IF EXISTS `assignmentsubject`;

CREATE TABLE `assignmentsubject` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `assignmentId` int(10) unsigned DEFAULT NULL,
  `dictSubjectId` int(10) unsigned DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `assignmentId` (`assignmentId`),
  KEY `dictSubjectId` (`dictSubjectId`),
  CONSTRAINT `assignmentsubject_ibfk_1` FOREIGN KEY (`assignmentId`) REFERENCES `assignment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `assignmentsubject_ibfk_3` FOREIGN KEY (`dictSubjectId`) REFERENCES `dictsubject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `assignmentsubject` WRITE;
/*!40000 ALTER TABLE `assignmentsubject` DISABLE KEYS */;

INSERT INTO `assignmentsubject` (`id`, `assignmentId`, `dictSubjectId`, `modified`)
VALUES
	(1,1,270,'2014-07-03 11:46:07'),
	(2,2,324,'2014-07-08 08:36:42'),
	(4,3,184,'2014-07-08 08:40:34'),
	(5,4,170,'2014-07-08 16:10:57'),
	(6,4,190,'2014-07-08 16:10:57');

/*!40000 ALTER TABLE `assignmentsubject` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table dictcategory
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dictcategory`;

CREATE TABLE `dictcategory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(50) DEFAULT NULL,
  `shortLabel` varchar(10) DEFAULT NULL,
  `position` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `dictcategory` WRITE;
/*!40000 ALTER TABLE `dictcategory` DISABLE KEYS */;

INSERT INTO `dictcategory` (`id`, `label`, `shortLabel`, `position`)
VALUES
	(1,'Pre-School','PRE',1),
	(2,'Lower Primary','LP',2),
	(3,'Upper Primary','UP',3),
	(4,'Lower Secondary','LS',4),
	(5,'Upper Secondary','US',5),
	(6,'Junior College','JC',6),
	(7,'International Baccalaureate','IB',7),
	(8,'Polytechnic & University','POLY&UNI',8),
	(9,'Computer','COMP',9),
	(10,'Languages','LANG',10),
	(11,'Music','MUSC',11),
	(12,'Others','OTHR',12),
	(13,'sports','SPRT',13);

/*!40000 ALTER TABLE `dictcategory` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table dictclasslevel
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dictclasslevel`;

CREATE TABLE `dictclasslevel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dictCategoryId` int(10) unsigned NOT NULL,
  `label` varchar(50) NOT NULL DEFAULT '',
  `abbreviate` varchar(10) DEFAULT NULL,
  `position` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `dictCategoryId` (`dictCategoryId`),
  CONSTRAINT `dictclasslevel_ibfk_1` FOREIGN KEY (`dictCategoryId`) REFERENCES `dictcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `dictclasslevel` WRITE;
/*!40000 ALTER TABLE `dictclasslevel` DISABLE KEYS */;

INSERT INTO `dictclasslevel` (`id`, `dictCategoryId`, `label`, `abbreviate`, `position`)
VALUES
	(2,1,'Phonics',NULL,0),
	(3,1,'Student Care',NULL,0),
	(4,2,'Primary 1','P1',1),
	(5,2,'Primary 2','P2',2),
	(6,2,'Primary 3','P3',3),
	(7,3,'Primary 4','P4',4),
	(8,3,'Primary 5','P5',5),
	(10,3,'Primary 6','P6',6),
	(11,4,'Secondary 1','Sec1',7),
	(12,4,'Secondary 2','Sec2',8),
	(13,5,'Secondary 3','Sec3',9),
	(14,5,'Secondary 4','Sec4',10),
	(15,5,'Secondary 5','Sec5',11),
	(16,6,'Junior College 1','JC1',12),
	(17,6,'Junior College 2','JC2',13),
	(18,7,'International Baccalaureate 1','IB1',14),
	(19,7,'International Baccalaureate 2','IB2',15),
	(20,8,'Polyechnic','Poly',16),
	(21,8,'University','Uni',17);

/*!40000 ALTER TABLE `dictclasslevel` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table dictgrade
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dictgrade`;

CREATE TABLE `dictgrade` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(10) NOT NULL DEFAULT '',
  `position` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `dictgrade` WRITE;
/*!40000 ALTER TABLE `dictgrade` DISABLE KEYS */;

INSERT INTO `dictgrade` (`id`, `label`, `position`)
VALUES
	(31,'A1',0),
	(32,'A2',0),
	(33,'B3',0),
	(34,'B4',0),
	(35,'C5',0),
	(36,'C6',0),
	(37,'D7',0),
	(38,'E8',0),
	(39,'F9',0),
	(40,'A+',0),
	(41,'A',0),
	(42,'A-',0),
	(43,'B+',0),
	(44,'B',0),
	(45,'B-',0),
	(46,'C+',0),
	(47,'C',0),
	(48,'C-',0),
	(49,'D',0),
	(50,'E',0),
	(51,'F',0),
	(52,'7',0),
	(53,'6',0),
	(54,'5',0),
	(55,'4',0),
	(56,'3',0),
	(57,'2',0),
	(58,'1',0),
	(59,'P',0),
	(60,'U',0),
	(61,'N',0);

/*!40000 ALTER TABLE `dictgrade` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table dictmrtline
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dictmrtline`;

CREATE TABLE `dictmrtline` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `code` varchar(5) DEFAULT NULL,
  `position` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `dictmrtline` WRITE;
/*!40000 ALTER TABLE `dictmrtline` DISABLE KEYS */;

INSERT INTO `dictmrtline` (`id`, `name`, `code`, `position`)
VALUES
	(1,'East West Line','EW',1),
	(2,'North South Line','NS',2),
	(3,'Changi Airport Branch Line','CG',3),
	(4,'North East Line','NE',4),
	(5,'Circle Line','CC',5),
	(6,'Circle Line Extension','CE',6),
	(7,'Downtown Line','DT',7),
	(8,'Thomson Line (after 2019)','TS',8);

/*!40000 ALTER TABLE `dictmrtline` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table dictmrtstation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dictmrtstation`;

CREATE TABLE `dictmrtstation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dictMrtLineId` int(10) unsigned NOT NULL,
  `label` varchar(40) NOT NULL,
  `code` varchar(20) NOT NULL,
  `position` int(5) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `dictMrtLineId` (`dictMrtLineId`),
  CONSTRAINT `dictmrtstation_ibfk_1` FOREIGN KEY (`dictMrtLineId`) REFERENCES `dictmrtline` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `dictmrtstation` WRITE;
/*!40000 ALTER TABLE `dictmrtstation` DISABLE KEYS */;

INSERT INTO `dictmrtstation` (`id`, `dictMrtLineId`, `label`, `code`, `position`)
VALUES
	(166,5,'Dhoby Ghaut','CC1',1),
	(167,5,'Bras Basah','CC2',2),
	(168,5,'Esplanade','CC3',3),
	(169,5,'Promenade','CC4',4),
	(170,5,'Nicoll Highway','CC5',5),
	(171,5,'Stadium','CC6',6),
	(172,5,'Mountbatten','CC7',7),
	(173,5,'Dakota','CC8',8),
	(174,5,'Paya Lebar','CC9',9),
	(175,5,'Paya Lebar','CC9',9),
	(176,5,'MacPherson','CC10',10),
	(177,5,'Tai Seng','CC11',11),
	(178,5,'Bartley','CC12',12),
	(179,5,'Serangoon','CC13',13),
	(180,5,'Lorong Chuan','CC14',14),
	(181,5,'Bishan','CC15',15),
	(182,5,'Marymount','CC16',16),
	(183,5,'Caldecott','CC17',17),
	(184,5,'Bukit Brown','CC18',18),
	(185,5,'Botanic Gardens','CC19',19),
	(186,5,'Farrer Road','CC20',20),
	(187,5,'Holland Village','CC21',21),
	(188,5,'Buona Vista','CC22',22),
	(189,5,'one-north','CC23',23),
	(190,5,'Kent Ridge','CC24',24),
	(191,5,'Haw Par Villa','CC25',25),
	(192,5,'Pasir Panjang','CC26',26),
	(193,5,'Labrador Park','CC27',27),
	(194,5,'Telok Blangah','CC28',28),
	(195,5,'HarbourFront','CC29',29),
	(196,6,'Bayfront','CE1',1),
	(197,6,'Marina Bay','CE2',2),
	(198,3,'Expo','CG1',1),
	(199,3,'Changi Airport','CG2',2),
	(200,7,'Bukit Panjang','DT1',1),
	(201,7,'Cashew','DT2',2),
	(202,7,'Hillview','DT3',3),
	(203,7,'Beauty World','DT5',5),
	(204,7,'King Albert Park','DT6',6),
	(205,7,'Sixth Avenue','DT7',7),
	(206,7,'Tan Kah Kee','DT8',8),
	(207,7,'Botanic Gardens','DT9',9),
	(208,7,'Stevens','DT10',10),
	(209,7,'Newton','DT11',11),
	(210,7,'Little India','DT12',12),
	(211,7,'Rochor','DT13',13),
	(212,7,'Bugis','DT14',14),
	(213,7,'Promenade','DT15',15),
	(214,7,'Bayfront','DT16',16),
	(215,7,'Downtown','DT17',17),
	(216,7,'Telok Ayer','DT18',18),
	(217,7,'Chinatown','DT19',19),
	(218,7,'Fort Canning','DT20',20),
	(219,7,'Bencoolen','DT21',21),
	(220,7,'Jalan Besar','DT22',22),
	(221,7,'Bendemeer','DT23',23),
	(222,7,'Geylang Bahru','DT24',24),
	(223,7,'Mattar','DT25',25),
	(224,7,'MacPherson','DT26',26),
	(225,7,'Ubi','DT27',27),
	(226,7,'Kaki Bukit','DT28',28),
	(227,7,'Bedok North','DT29',29),
	(228,7,'Bedok Reservoir','DT30',30),
	(229,7,'Tampines West','DT31',31),
	(230,7,'Tampines','DT32',32),
	(231,7,'Tampines East','DT33',33),
	(232,7,'Upper Changi','DT34',34),
	(233,7,'Expo','DT35',35),
	(234,1,'Pasir Ris','EW1',1),
	(235,1,'Tampines','EW2',2),
	(236,1,'Simei','EW3',3),
	(237,1,'Tanah Merah','EW4',4),
	(238,1,'Bedok','EW5',5),
	(239,1,'Kembangan','EW6',6),
	(240,1,'Eunos','EW7',7),
	(241,1,'Paya Lebar','EW8',8),
	(242,1,'Paya Lebar','EW8',8),
	(243,1,'Aljunied','EW9',9),
	(244,1,'Kallang','EW10',10),
	(245,1,'Lavender','EW11',11),
	(246,1,'Bugis','EW12',12),
	(247,1,'City Hall','EW13',13),
	(248,1,'Raffles Place','EW14',14),
	(249,1,'Tanjong Pagar','EW15',15),
	(250,1,'Outram Park','EW16',16),
	(251,1,'Tiong Bahru','EW17',17),
	(252,1,'Redhill','EW18',18),
	(253,1,'Queenstown','EW19',19),
	(254,1,'Commonwealth','EW20',20),
	(255,1,'Buona Vista','EW21',21),
	(256,1,'Dover','EW22',22),
	(257,1,'Clementi','EW23',23),
	(258,1,'Jurong East','EW24',24),
	(259,1,'Chinese Garden','EW25',25),
	(260,1,'Lakeside','EW26',26),
	(261,1,'Boon Lay','EW27',27),
	(262,1,'Pioneer','EW28',28),
	(263,1,'Joo Koon','EW29',29),
	(264,1,'Gul Circle','EW30',30),
	(265,1,'Tuas Crescent','EW31',31),
	(266,1,'Tuas West Road','EW32',32),
	(267,1,'Tuas Link','EW33',33),
	(268,4,'HarbourFront','NE1',1),
	(269,4,'Outram Park','NE3',3),
	(270,4,'Chinatown','NE4',4),
	(271,4,'Clarke Quay','NE5',5),
	(272,4,'Dhoby Ghaut','NE6',6),
	(273,4,'Little India','NE7',7),
	(274,4,'Farrer Park','NE8',8),
	(275,4,'Boon Keng','NE9',9),
	(276,4,'Potong Pasir','NE10',10),
	(277,4,'Woodleigh','NE11',11),
	(278,4,'Serangoon','NE12',12),
	(279,4,'Kovan','NE13',13),
	(280,4,'Hougang','NE14',14),
	(281,4,'Buangkok','NE15',15),
	(282,4,'Sengkang','NE16',16),
	(283,4,'Punggol','NE17',17),
	(284,2,'Jurong East','NS1',1),
	(285,2,'Bukit Batok','NS2',2),
	(286,2,'Bukit Gombak','NS3',3),
	(287,2,'Choa Chu Kang','NS4',4),
	(288,2,'Yew Tee','NS5',5),
	(289,2,'Kranji','NS7',7),
	(290,2,'Marsiling','NS8',8),
	(291,2,'Woodlands','NS9',9),
	(292,2,'Admiralty','NS10',10),
	(293,2,'Sembawang','NS11',11),
	(294,2,'Yishun','NS13',13),
	(295,2,'Khatib','NS14',14),
	(296,2,'Yio Chu Kang','NS15',15),
	(297,2,'Ang Mo Kio','NS16',16),
	(298,2,'Bishan','NS17',17),
	(299,2,'Braddell','NS18',18),
	(300,2,'Toa Payoh','NS19',19),
	(301,2,'Novena','NS20',20),
	(302,2,'Newton','NS21',21),
	(303,2,'Orchard','NS22',22),
	(304,2,'Somerset','NS23',23),
	(305,2,'Dhoby Ghaut','NS24',24),
	(306,2,'City Hall','NS25',25),
	(307,2,'Raffles Place','NS26',26),
	(308,2,'Marina Bay','NS27',27),
	(309,2,'Marina South Pier','NS28',28),
	(310,8,'Woodlands North','TS1',1),
	(311,8,'Woodlands','TS2',2),
	(312,8,'Woodlands South','TS3',3),
	(313,8,'Springleaf','TS4',4),
	(314,8,'Lentor','TS5',5),
	(315,8,'Mayflower','TS6',6),
	(316,8,'Sin Ming','TS7',7),
	(317,8,'Upper Thomson','TS8',8),
	(318,8,'Caldecott','TS9',9),
	(319,8,'Mount Pleasant','TS10',10),
	(320,8,'Stevens','TS11',11),
	(321,8,'Napier','TS12',12),
	(322,8,'Orchard Boulevard','TS13',13),
	(323,8,'Orchard','TS14',14),
	(324,8,'Great World','TS15',15),
	(325,8,'Havelock','TS16',16),
	(326,8,'Outram Park','TS17',17),
	(327,8,'Maxwell','TS18',18),
	(328,8,'Shenton Way','TS19',19),
	(329,8,'Marina Bay','TS20',20),
	(330,8,'Marina South','TS21',21),
	(331,8,'Gardens by the Bay','TS22',22);

/*!40000 ALTER TABLE `dictmrtstation` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table dictschedule
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dictschedule`;

CREATE TABLE `dictschedule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weekday` varchar(20) NOT NULL DEFAULT '',
  `slot` varchar(10) DEFAULT NULL,
  `position` int(5) unsigned NOT NULL DEFAULT '0',
  `wkday` varchar(20) DEFAULT NULL,
  `wkdayslot` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `dictschedule` WRITE;
/*!40000 ALTER TABLE `dictschedule` DISABLE KEYS */;

INSERT INTO `dictschedule` (`id`, `weekday`, `slot`, `position`, `wkday`, `wkdayslot`)
VALUES
	(1,'Monday','AM',0,'Mon','Mon-AM'),
	(2,'Monday','PM',1,'Mon','Mon-PM'),
	(3,'Monday','Evening',2,'Mon','Mon-Evening'),
	(4,'Tuesday','AM',3,'Tue','Tue-AM'),
	(5,'Tuesday','PM',4,'Tue','Tue-PM'),
	(6,'Tuesday','Evening',5,'Tue','Tue-Evening'),
	(7,'Wednesday','AM',6,'Wed','Wed-AM'),
	(8,'Wednesday','PM',7,'Wed','Wed-PM'),
	(9,'Wednesday','Evening',8,'Wed','Wed-Evening'),
	(10,'Thursday','AM',9,'Thu','Thu-AM'),
	(11,'Thursday','PM',10,'Thu','Thu-PM'),
	(12,'Thursday','Evening',11,'Thu','Thu-Evening'),
	(13,'Friday','AM',12,'Fri','Fri-AM'),
	(14,'Friday','PM',13,'Fri','Fri-PM'),
	(15,'Friday','Evening',14,'Fri','Fri-Evening'),
	(16,'Saturday','AM',15,'Sat','Sat-AM'),
	(17,'Saturday','PM',16,'Sat','Sat-PM'),
	(18,'Saturday','Evening',17,'Sat','Sat-Evening'),
	(19,'Sunday','AM',18,'Sun','Sun-AM'),
	(20,'Sunday','PM',19,'Sun','Sun-PM'),
	(21,'Sunday','Evening',20,'Sun','Sun-Evening');

/*!40000 ALTER TABLE `dictschedule` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table dictschool
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dictschool`;

CREATE TABLE `dictschool` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `dictschool` WRITE;
/*!40000 ALTER TABLE `dictschool` DISABLE KEYS */;

INSERT INTO `dictschool` (`id`, `name`)
VALUES
	(1,'AHMAD IBRAHIM PRIMARY SCHOOL'),
	(2,'AI TONG SCHOOL'),
	(3,'ANCHOR GREEN PRIMARY SCHOOL'),
	(4,'ANDERSON PRIMARY SCHOOL'),
	(5,'ANG MO KIO PRIMARY SCHOOL'),
	(6,'ANGLO-CHINESE SCHOOL (JUNIOR)'),
	(7,'ANGLO-CHINESE SCHOOL (PRIMARY)'),
	(8,'BALESTIER HILL PRIMARY SCHOOL'),
	(9,'BEACON PRIMARY SCHOOL'),
	(10,'BEDOK GREEN PRIMARY SCHOOL'),
	(11,'BEDOK WEST PRIMARY SCHOOL'),
	(12,'BENDEMEER PRIMARY SCHOOL'),
	(13,'BLANGAH RISE PRIMARY SCHOOL'),
	(14,'BOON LAY GARDEN PRIMARY SCHOOL'),
	(15,'BUKIT PANJANG PRIMARY SCHOOL'),
	(16,'BUKIT TIMAH PRIMARY SCHOOL'),
	(17,'BUKIT VIEW PRIMARY SCHOOL'),
	(18,'CANBERRA PRIMARY SCHOOL'),
	(19,'CANOSSA CONVENT PRIMARY SCHOOL'),
	(20,'CANTONMENT PRIMARY SCHOOL'),
	(21,'CASUARINA PRIMARY SCHOOL'),
	(22,'CATHOLIC HIGH SCHOOL'),
	(23,'CEDAR PRIMARY SCHOOL'),
	(24,'CHANGKAT PRIMARY SCHOOL'),
	(25,'CHIJ (KATONG) PRIMARY'),
	(26,'CHIJ (KELLOCK)'),
	(27,'CHIJ OUR LADY OF GOOD COUNSEL'),
	(28,'CHIJ OUR LADY OF THE NATIVITY'),
	(29,'CHIJ OUR LADY QUEEN OF PEACE'),
	(30,'CHIJ PRIMARY (TOA PAYOH)'),
	(31,'CHIJ ST. NICHOLAS GIRLS\' SCHOOL'),
	(32,'CHONGFU PRIMARY SCHOOL'),
	(33,'CHONGZHENG PRIMARY SCHOOL'),
	(34,'CHUA CHU KANG PRIMARY SCHOOL'),
	(35,'CLEMENTI PRIMARY SCHOOL'),
	(36,'COMPASSVALE PRIMARY SCHOOL'),
	(37,'CONCORD PRIMARY SCHOOL'),
	(38,'CORAL PRIMARY SCHOOL'),
	(39,'CORPORATION PRIMARY SCHOOL'),
	(40,'DA QIAO PRIMARY SCHOOL'),
	(41,'DAMAI PRIMARY SCHOOL'),
	(42,'DAZHONG PRIMARY SCHOOL'),
	(43,'DE LA SALLE SCHOOL'),
	(44,'EAST COAST PRIMARY SCHOOL'),
	(45,'EAST SPRING PRIMARY SCHOOL'),
	(46,'EAST VIEW PRIMARY SCHOOL'),
	(47,'EDGEFIELD PRIMARY SCHOOL'),
	(48,'ELIAS PARK PRIMARY SCHOOL'),
	(49,'ENDEAVOUR PRIMARY SCHOOL'),
	(50,'EUNOS PRIMARY SCHOOL'),
	(51,'EVERGREEN PRIMARY SCHOOL'),
	(52,'FAIRFIELD METHODIST PRIMARY SCHOOL'),
	(53,'FARRER PARK PRIMARY SCHOOL'),
	(54,'FENGSHAN PRIMARY SCHOOL'),
	(55,'FERNVALE PRIMARY SCHOOL'),
	(56,'FIRST TOA PAYOH PRIMARY SCHOOL'),
	(57,'FUCHUN PRIMARY SCHOOL'),
	(58,'FUHUA PRIMARY SCHOOL'),
	(59,'GAN ENG SENG PRIMARY SCHOOL'),
	(60,'GEYLANG METHODIST SCHOOL (PRIMARY)'),
	(61,'GONGSHANG PRIMARY SCHOOL'),
	(62,'GREENDALE PRIMARY SCHOOL'),
	(63,'GREENRIDGE PRIMARY SCHOOL'),
	(64,'GREENWOOD PRIMARY SCHOOL'),
	(65,'GRIFFITHS PRIMARY SCHOOL'),
	(66,'GUANGYANG PRIMARY SCHOOL'),
	(67,'HAIG GIRLS\' SCHOOL'),
	(68,'HENRY PARK SCHOOL'),
	(69,'HOLY INNOCENTS\' PRIMARY SCHOOL'),
	(70,'HONG KAH PRIMARY SCHOOL'),
	(71,'HONG WEN SCHOOL'),
	(72,'HORIZON PRIMARY SCHOOL'),
	(73,'HOUGANG PRIMARY SCHOOL'),
	(74,'HUAMIN PRIMARY SCHOOL'),
	(75,'INNOVA PRIMARY SCHOOL'),
	(76,'JIEMIN PRIMARY SCHOOL'),
	(77,'JING SHAN PRIMARY SCHOOL'),
	(78,'JUNYUAN PRIMARY SCHOOL'),
	(79,'JURONG PRIMARY SCHOOL'),
	(80,'JURONG WEST PRIMARY SCHOOL'),
	(81,'JUYING PRIMARY SCHOOL'),
	(82,'KEMING PRIMARY SCHOOL'),
	(83,'KHENG CHENG SCHOOL'),
	(84,'KONG HWA SCHOOL'),
	(85,'KRANJI PRIMARY SCHOOL'),
	(86,'KUO CHUAN PRESBYTERIAN PRIMARY SCHOOL'),
	(87,'LAKESIDE PRIMARY SCHOOL'),
	(88,'LIANHUA PRIMARY SCHOOL'),
	(89,'LOYANG PRIMARY SCHOOL'),
	(90,'MACPHERSON PRIMARY SCHOOL'),
	(91,'MAHA BODHI SCHOOL'),
	(92,'MARIS STELLA HIGH SCHOOL'),
	(93,'MARSILING PRIMARY SCHOOL'),
	(94,'MARYMOUNT CONVENT SCHOOL'),
	(95,'MAYFLOWER PRIMARY SCHOOL'),
	(96,'MEE TOH SCHOOL'),
	(97,'MERIDIAN PRIMARY SCHOOL'),
	(98,'MERIDIAN PRIMARY SCHOOL'),
	(99,'METHODIST GIRLS\' SCHOOL (PRIMARY)'),
	(100,'MONTFORT JUNIOR SCHOOL'),
	(101,'NAN CHIAU PRIMARY SCHOOL'),
	(102,'NAN HUA PRIMARY SCHOOL'),
	(103,'NANYANG PRIMARY SCHOOL'),
	(104,'NAVAL BASE PRIMARY SCHOOL'),
	(105,'NEW TOWN PRIMARY SCHOOL'),
	(106,'NGEE ANN PRIMARY SCHOOL'),
	(107,'NORTH SPRING PRIMARY SCHOOL'),
	(108,'NORTH VIEW PRIMARY SCHOOL'),
	(109,'NORTH VISTA PRIMARY SCHOOL'),
	(110,'NORTHLAND PRIMARY SCHOOL'),
	(111,'OPERA ESTATE PRIMARY SCHOOL'),
	(112,'PARK VIEW PRIMARY SCHOOL'),
	(113,'PASIR RIS PRIMARY SCHOOL'),
	(114,'PAYA LEBAR METHODIST GIRLS\' SCHOOL (PRIMARY)'),
	(115,'PEI CHUN PUBLIC SCHOOL'),
	(116,'PEI HWA PRESBYTERIAN PRIMARY SCHOOL'),
	(117,'PEI TONG PRIMARY SCHOOL'),
	(118,'PEIYING PRIMARY SCHOOL'),
	(119,'PIONEER PRIMARY SCHOOL'),
	(120,'POI CHING SCHOOL'),
	(121,'PRINCESS ELIZABETH PRIMARY SCHOOL'),
	(122,'PUNGGOL PRIMARY SCHOOL'),
	(123,'QIAONAN PRIMARY SCHOOL'),
	(124,'QIFA PRIMARY SCHOOL'),
	(125,'QIHUA PRIMARY SCHOOL'),
	(126,'QUEENSTOWN PRIMARY SCHOOL'),
	(127,'RADIN MAS PRIMARY SCHOOL'),
	(128,'RAFFLES GIRLS\' PRIMARY SCHOOL'),
	(129,'RED SWASTIKA SCHOOL'),
	(130,'RIVER VALLEY PRIMARY SCHOOL'),
	(131,'RIVERVALE PRIMARY SCHOOL'),
	(132,'ROSYTH SCHOOL'),
	(133,'RULANG PRIMARY SCHOOL'),
	(134,'SEMBAWANG PRIMARY SCHOOL'),
	(135,'SENG KANG PRIMARY SCHOOL'),
	(136,'SHUQUN PRIMARY SCHOOL'),
	(137,'SI LING PRIMARY SCHOOL'),
	(138,'SINGAPORE CHINESE GIRLS\' PRIMARY SCHOOL'),
	(139,'SOUTH VIEW PRIMARY SCHOOL'),
	(140,'ST. ANDREW\'S JUNIOR SCHOOL'),
	(141,'ST. ANTHONY\'S CANOSSIAN PRIMARY SCHOOL'),
	(142,'ST. ANTHONY\'S PRIMARY SCHOOL'),
	(143,'ST. GABRIEL\'S PRIMARY SCHOOL'),
	(144,'ST. HILDA\'S PRIMARY SCHOOL'),
	(145,'ST. JOSEPH\'S INSTITUTION JUNIOR'),
	(146,'ST. MARGARET\'S PRIMARY SCHOOL'),
	(147,'ST. STEPHEN\'S SCHOOL'),
	(148,'STAMFORD PRIMARY SCHOOL'),
	(149,'TAMPINES NORTH PRIMARY SCHOOL'),
	(150,'TAMPINES PRIMARY SCHOOL'),
	(151,'TANJONG KATONG PRIMARY SCHOOL'),
	(152,'TAO NAN SCHOOL'),
	(153,'TECK GHEE PRIMARY SCHOOL'),
	(154,'TECK WHYE PRIMARY SCHOOL'),
	(155,'TELOK KURAU PRIMARY SCHOOL'),
	(156,'TEMASEK PRIMARY SCHOOL'),
	(157,'TOWNSVILLE PRIMARY SCHOOL'),
	(158,'UNITY PRIMARY SCHOOL'),
	(159,'WELLINGTON PRIMARY SCHOOL'),
	(160,'WEST GROVE PRIMARY SCHOOL'),
	(161,'WEST VIEW PRIMARY SCHOOL'),
	(162,'WHITE SANDS PRIMARY SCHOOL'),
	(163,'WOODGROVE PRIMARY SCHOOL'),
	(164,'WOODLANDS PRIMARY SCHOOL'),
	(165,'WOODLANDS RING PRIMARY SCHOOL'),
	(166,'XINGHUA PRIMARY SCHOOL'),
	(167,'XINGNAN PRIMARY SCHOOL'),
	(168,'XINMIN PRIMARY SCHOOL'),
	(169,'XISHAN PRIMARY SCHOOL'),
	(170,'YANGZHENG PRIMARY SCHOOL'),
	(171,'YEW TEE PRIMARY SCHOOL'),
	(172,'YIO CHU KANG PRIMARY SCHOOL'),
	(173,'YISHUN PRIMARY SCHOOL'),
	(174,'YU NENG PRIMARY SCHOOL'),
	(175,'YUHUA PRIMARY SCHOOL'),
	(176,'YUMIN PRIMARY SCHOOL'),
	(177,'ZHANGDE PRIMARY SCHOOL'),
	(178,'ZHENGHUA PRIMARY SCHOOL'),
	(179,'ZHONGHUA PRIMARY SCHOOL'),
	(180,'ADMIRALTY SECONDARY SCHOOL'),
	(181,'AHMAD IBRAHIM SECONDARY SCHOOL'),
	(182,'ANDERSON SECONDARY SCHOOL'),
	(183,'ANG MO KIO SECONDARY SCHOOL'),
	(184,'BALESTIER HILL SECONDARY SCHOOL'),
	(185,'BARTLEY SECONDARY SCHOOL'),
	(186,'BEATTY SECONDARY SCHOOL'),
	(187,'BEDOK GREEN SECONDARY SCHOOL'),
	(188,'BEDOK NORTH SECONDARY SCHOOL'),
	(189,'BEDOK SOUTH SECONDARY SCHOOL'),
	(190,'BEDOK TOWN SECONDARY SCHOOL'),
	(191,'BEDOK VIEW SECONDARY SCHOOL'),
	(192,'BENDEMEER SECONDARY SCHOOL'),
	(193,'BISHAN PARK SECONDARY SCHOOL'),
	(194,'BOON LAY SECONDARY SCHOOL'),
	(195,'BOWEN SECONDARY SCHOOL'),
	(196,'BROADRICK SECONDARY SCHOOL'),
	(197,'BUKIT BATOK SECONDARY SCHOOL'),
	(198,'BUKIT MERAH SECONDARY SCHOOL'),
	(199,'BUKIT PANJANG GOVT. HIGH SCHOOL'),
	(200,'BUKIT VIEW SECONDARY SCHOOL'),
	(201,'CANBERRA SECONDARY SCHOOL'),
	(202,'CEDAR GIRLS\' SECONDARY SCHOOL'),
	(203,'CHAI CHEE SECONDARY SCHOOL'),
	(204,'CHANGKAT CHANGI SECONDARY SCHOOL'),
	(205,'CHESTNUT DRIVE SECONDARY SCHOOL'),
	(206,'CHONG BOON SECONDARY SCHOOL'),
	(207,'CHUA CHU KANG SECONDARY SCHOOL'),
	(208,'CLEMENTI TOWN SECONDARY SCHOOL'),
	(209,'CLEMENTI WOODS SECONDARY SCHOOL'),
	(210,'COMMONWEALTH SECONDARY SCHOOL'),
	(211,'COMPASSVALE SECONDARY SCHOOL'),
	(212,'CORAL SECONDARY SCHOOL'),
	(213,'CRESCENT GIRLS\' SCHOOL'),
	(214,'DAMAI SECONDARY SCHOOL'),
	(215,'DEYI SECONDARY SCHOOL'),
	(216,'DUNEARN SECONDARY SCHOOL'),
	(217,'DUNMAN HIGH SCHOOL'),
	(218,'DUNMAN SECONDARY SCHOOL'),
	(219,'EAST SPRING SECONDARY SCHOOL'),
	(220,'EAST VIEW SECONDARY SCHOOL'),
	(221,'EVERGREEN SECONDARY SCHOOL'),
	(222,'FAJAR SECONDARY SCHOOL'),
	(223,'FIRST TOA PAYOH SECONDARY SCHOOL'),
	(224,'FUCHUN SECONDARY SCHOOL'),
	(225,'FUHUA SECONDARY SCHOOL'),
	(226,'GAN ENG SENG SCHOOL'),
	(227,'GREENDALE SECONDARY SCHOOL'),
	(228,'GREENRIDGE SECONDARY SCHOOL'),
	(229,'GREENVIEW SECONDARY SCHOOL'),
	(230,'GUANGYANG SECONDARY SCHOOL'),
	(231,'HENDERSON SECONDARY SCHOOL'),
	(232,'HILLGROVE SECONDARY SCHOOL'),
	(233,'HONG KAH SECONDARY SCHOOL'),
	(234,'HOUGANG SECONDARY SCHOOL'),
	(235,'HUA YI SECONDARY SCHOOL'),
	(236,'JUNYUAN SECONDARY SCHOOL'),
	(237,'JURONG SECONDARY SCHOOL'),
	(238,'JURONG WEST SECONDARY'),
	(239,'JURONGVILLE SECONDARY SCHOOL'),
	(240,'JUYING SECONDARY SCHOOL'),
	(241,'KENT RIDGE SECONDARY SCHOOL'),
	(242,'KRANJI SECONDARY SCHOOL'),
	(243,'LOYANG SECONDARY SCHOOL'),
	(244,'MACPHERSON SECONDARY SCHOOL'),
	(245,'MARSILING SECONDARY SCHOOL'),
	(246,'MAYFLOWER SECONDARY SCHOOL'),
	(247,'NAN HUA HIGH SCHOOL'),
	(248,'NATIONAL JUNIOR COLLEGE'),
	(249,'NAVAL BASE SECONDARY SCHOOL'),
	(250,'NEW TOWN SECONDARY SCHOOL'),
	(251,'NORTH VIEW SECONDARY SCHOOL'),
	(252,'NORTH VISTA SECONDARY SCHOOL'),
	(253,'NORTHBROOKS SECONDARY SCHOOL'),
	(254,'NORTHLAND SECONDARY SCHOOL'),
	(255,'ORCHID PARK SECONDARY SCHOOL'),
	(256,'OUTRAM SECONDARY SCHOOL'),
	(257,'PASIR RIS CREST SECONDARY SCHOOL'),
	(258,'PASIR RIS SECONDARY SCHOOL'),
	(259,'PEI HWA SECONDARY SCHOOL'),
	(260,'PEICAI SECONDARY SCHOOL'),
	(261,'PEIRCE SECONDARY SCHOOL'),
	(262,'PING YI SECONDARY SCHOOL'),
	(263,'PIONEER SECONDARY SCHOOL'),
	(264,'PUNGGOL SECONDARY SCHOOL'),
	(265,'QUEENSTOWN SECONDARY SCHOOL'),
	(266,'QUEENSWAY SECONDARY SCHOOL'),
	(267,'REGENT SECONDARY SCHOOL'),
	(268,'RIVER VALLEY HIGH SCHOOL'),
	(269,'RIVERSIDE SECONDARY SCHOOL'),
	(270,'SEMBAWANG SECONDARY SCHOOL'),
	(271,'SENG KANG SECONDARY SCHOOL'),
	(272,'SERANGOON GARDEN SECONDARY SCHOOL'),
	(273,'SERANGOON SECONDARY SCHOOL'),
	(274,'SHUQUN SECONDARY SCHOOL'),
	(275,'SI LING SECONDARY SCHOOL'),
	(276,'SIGLAP SECONDARY SCHOOL'),
	(277,'SPRINGFIELD SECONDARY SCHOOL'),
	(278,'SWISS COTTAGE SECONDARY SCHOOL'),
	(279,'TAMPINES SECONDARY SCHOOL'),
	(280,'TANGLIN SECONDARY SCHOOL'),
	(281,'TANJONG KATONG GIRLS\' SCHOOL'),
	(282,'TANJONG KATONG SECONDARY SCHOOL'),
	(283,'TECK WHYE SECONDARY SCHOOL'),
	(284,'TELOK KURAU SECONDARY SCHOOL'),
	(285,'TEMASEK JUNIOR COLLEGE'),
	(286,'TEMASEK SECONDARY SCHOOL'),
	(287,'UNITY SECONDARY SCHOOL'),
	(288,'VICTORIA JUNIOR COLLEGE'),
	(289,'VICTORIA SCHOOL'),
	(290,'WEST SPRING SECONDARY SCHOOL'),
	(291,'WESTWOOD SECONDARY SCHOOL'),
	(292,'WHITLEY SECONDARY SCHOOL'),
	(293,'WOODGROVE SECONDARY SCHOOL'),
	(294,'WOODLANDS RING SECONDARY SCHOOL'),
	(295,'WOODLANDS SECONDARY SCHOOL'),
	(296,'XINMIN SECONDARY SCHOOL'),
	(297,'YIO CHU KANG SECONDARY SCHOOL'),
	(298,'YISHUN SECONDARY SCHOOL'),
	(299,'YISHUN TOWN SECONDARY SCHOOL'),
	(300,'YUAN CHING SECONDARY SCHOOL'),
	(301,'YUHUA SECONDARY SCHOOL'),
	(302,'YUSOF ISHAK SECONDARY SCHOOL'),
	(303,'ZHENGHUA SECONDARY SCHOOL'),
	(304,'ZHONGHUA SECONDARY SCHOOL'),
	(305,'ANGLICAN HIGH SCHOOL'),
	(306,'ANGLO-CHINESE SCHOOL (BARKER ROAD)'),
	(307,'ASSUMPTION ENGLISH SCHOOL'),
	(308,'CATHOLIC HIGH SCHOOL'),
	(309,'CHIJ KATONG CONVENT'),
	(310,'CHIJ SECONDARY (TOA PAYOH)'),
	(311,'CHIJ ST. JOSEPH\'S CONVENT'),
	(312,'CHIJ ST. NICHOLAS GIRLS\' SCHOOL'),
	(313,'CHIJ ST. THERESA\'S CONVENT'),
	(314,'CHRIST CHURCH SECONDARY SCHOOL'),
	(315,'CHUNG CHENG HIGH SCHOOL (MAIN)'),
	(316,'CHUNG CHENG HIGH SCHOOL (YISHUN)'),
	(317,'FAIRFIELD METHODIST SECONDARY SCHOOL'),
	(318,'GEYLANG METHODIST SCHOOL (SECONDARY)'),
	(319,'HAI SING CATHOLIC SCHOOL'),
	(320,'HOLY INNOCENTS\' HIGH SCHOOL'),
	(321,'KUO CHUAN PRESBYTERIAN SECONDARY SCHOOL'),
	(322,'MANJUSRI SECONDARY SCHOOL'),
	(323,'MARIS STELLA HIGH SCHOOL'),
	(324,'MONTFORT SECONDARY SCHOOL'),
	(325,'NAN CHIAU HIGH SCHOOL'),
	(326,'NGEE ANN SECONDARY SCHOOL'),
	(327,'PAYA LEBAR METHODIST GIRLS\' SCHOOL (SECONDARY)'),
	(328,'PRESBYTERIAN HIGH SCHOOL'),
	(329,'ST. ANDREW\'S SECONDARY SCHOOL'),
	(330,'ST. ANTHONY\'S CANOSSIAN SECONDARY SCHOOL'),
	(331,'ST. GABRIEL\'S SECONDARY SCHOOL'),
	(332,'ST. HILDA\'S SECONDARY SCHOOL'),
	(333,'ST. MARGARET\'S SECONDARY SCHOOL'),
	(334,'ST. PATRICK\'S SCHOOL'),
	(335,'YUYING SECONDARY SCHOOL'),
	(336,'ANGLO-CHINESE SCHOOL (INDEPENDENT)'),
	(337,'HWA CHONG INSTITUTION'),
	(338,'METHODIST GIRLS\' SCHOOL (SECONDARY)'),
	(339,'NANYANG GIRLS\' HIGH SCHOOL'),
	(340,'NORTHLIGHT SCHOOL'),
	(341,'NUS HIGH SCHOOL OF MATHEMATICS AND SCIENCE'),
	(342,'RAFFLES GIRLS\' SCHOOL (SECONDARY)'),
	(343,'RAFFLES INSTITUTION'),
	(344,'SCHOOL OF THE ARTS\n SINGAPORE'),
	(345,'SINGAPORE CHINESE GIRLS\' SCHOOL'),
	(346,'SINGAPORE SPORTS SCHOOL'),
	(347,'ST. JOSEPH\'S INSTITUTION'),
	(348,'HWA CHONG INSTITUTION'),
	(349,'NANYANG POLYTECHNIC'),
	(350,'NGEE ANN POLYTECHNIC'),
	(351,'SINGAPORE POLYTECHNIC'),
	(352,'TEMASEK POLYTECHNIC'),
	(353,'REPUBLIC POLYTECHNIC'),
	(354,'ANDERSON JUNIOR COLLEGE'),
	(355,'DUNMAN HIGH SCHOOL'),
	(356,'INNOVA JUNIOR COLLEGE'),
	(357,'JURONG JUNIOR COLLEGE'),
	(358,'MERIDIAN JUNIOR COLLEGE'),
	(359,'NATIONAL JUNIOR COLLEGE'),
	(360,'PIONEER JUNIOR COLLEGE'),
	(361,'RIVER VALLEY HIGH SCHOOL'),
	(362,'SERANGOON JUNIOR COLLEGE'),
	(363,'TAMPINES JUNIOR COLLEGE'),
	(364,'TEMASEK JUNIOR COLLEGE'),
	(365,'VICTORIA JUNIOR COLLEGE'),
	(366,'YISHUN JUNIOR COLLEGE'),
	(367,'ANGLO-CHINESE JUNIOR COLLEGE'),
	(368,'CATHOLIC JUNIOR COLLEGE'),
	(369,'NANYANG JUNIOR COLLEGE'),
	(370,'ST. ANDREW\'S JUNIOR COLLEGE'),
	(371,'ANGLO-CHINESE SCHOOL (INDEPENDENT)'),
	(372,'HWA CHONG INSTITUTION'),
	(373,'NUS HIGH SCHOOL OF MATHEMATICS AND SCIENCE'),
	(374,'RAFFLES JUNIOR COLLEGE'),
	(375,'MILLENNIA INSTITUTE'),
	(376,'NATIONAL UNIVERSITY OF SINGAPORE'),
	(377,'NANYANG TECHNOLOGICAL UNIVERSITY'),
	(378,'SINGAPORE MANAGEMENT UNIVERSITY'),
	(379,'SINGAPORE INSTITUTE OF MANAGEMENT');

/*!40000 ALTER TABLE `dictschool` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table dictsubject
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dictsubject`;

CREATE TABLE `dictsubject` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dictCategoryId` int(10) unsigned NOT NULL,
  `subject` varchar(100) NOT NULL,
  `position` int(5) unsigned NOT NULL DEFAULT '0',
  `status` int(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dictCategoryId` (`dictCategoryId`),
  CONSTRAINT `dictsubject_ibfk_2` FOREIGN KEY (`dictCategoryId`) REFERENCES `dictcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `dictsubject` WRITE;
/*!40000 ALTER TABLE `dictsubject` DISABLE KEYS */;

INSERT INTO `dictsubject` (`id`, `dictCategoryId`, `subject`, `position`, `status`)
VALUES
	(157,1,'English',3,NULL),
	(158,1,'Chinese',2,NULL),
	(159,1,'Tamil',6,NULL),
	(160,1,'Malay',4,NULL),
	(161,1,'Phonics',5,NULL),
	(162,1,'Creative Writing',1,NULL),
	(163,2,'Mathematics',0,NULL),
	(164,2,'Science',0,NULL),
	(165,2,'Higher Chinese',0,NULL),
	(166,2,'English',0,NULL),
	(167,2,'Chinese',0,NULL),
	(168,2,'Tamil',0,NULL),
	(169,2,'Malay',0,NULL),
	(170,3,'Mathematics',0,NULL),
	(171,3,'Science',0,NULL),
	(172,3,'Chinese',0,NULL),
	(173,3,'Higher Chinese',0,NULL),
	(174,3,'English',0,NULL),
	(175,3,'Tamil',0,NULL),
	(176,3,'Malay',0,NULL),
	(177,4,'Mathematics',0,NULL),
	(178,4,'Science',0,NULL),
	(179,4,'Geography',0,NULL),
	(180,4,'History',0,NULL),
	(181,4,'English Literature',0,NULL),
	(182,4,'Higher Chinese',0,NULL),
	(183,4,'English',0,NULL),
	(184,4,'Chinese',0,NULL),
	(185,4,'Tamil',0,NULL),
	(186,4,'Malay',0,NULL),
	(187,4,'Chinese Literature',0,NULL),
	(188,4,'Tamil Literature',0,NULL),
	(189,4,'Malay Literature',0,NULL),
	(190,5,'Maths A',0,NULL),
	(191,5,'Maths E/D',0,NULL),
	(192,5,'Biology',0,NULL),
	(193,5,'Chemistry',0,NULL),
	(194,5,'Physics',0,NULL),
	(195,5,'Geography',0,NULL),
	(196,5,'History',0,NULL),
	(197,5,'English Literature',0,NULL),
	(198,5,'Accounting',0,NULL),
	(199,5,'Higher Chinese',0,NULL),
	(200,5,'English',0,NULL),
	(201,5,'Chinese',0,NULL),
	(202,5,'Tamil',0,NULL),
	(203,5,'Malay',0,NULL),
	(204,5,'Bio/Chem',0,NULL),
	(205,5,'Phy/Chem',0,NULL),
	(206,5,'Chinese Literature',0,NULL),
	(207,5,'Tamil Literature',0,NULL),
	(208,5,'Malay Literature',0,NULL),
	(209,6,'Geography',0,NULL),
	(210,6,'History',0,NULL),
	(211,6,'English Literature',0,NULL),
	(212,6,'Accounting',0,NULL),
	(213,6,'Higher Chinese',0,NULL),
	(214,6,'Chinese',0,NULL),
	(215,6,'Tamil',0,NULL),
	(216,6,'Malay',0,NULL),
	(217,6,'General Paper',0,NULL),
	(218,6,'Chinese Literature',0,NULL),
	(219,6,'Tamil Literature',0,NULL),
	(220,6,'Malay Literature',0,NULL),
	(221,6,'H1 Math',0,NULL),
	(222,6,'H2 Math',0,NULL),
	(223,6,'H3 Math',0,NULL),
	(224,6,'H1 Physics',0,NULL),
	(225,6,'H2 Physics',0,NULL),
	(226,6,'H3 Physics',0,NULL),
	(227,6,'H1 Chemistry',0,NULL),
	(228,6,'H2 Chemistry',0,NULL),
	(229,6,'H3 Chemistry',0,NULL),
	(230,6,'H1 Biology',0,NULL),
	(231,6,'H2 Biology',0,NULL),
	(232,6,'H3 Biology',0,NULL),
	(233,6,'H1 Economics',0,NULL),
	(234,6,'H2 Economics',0,NULL),
	(235,6,'H3 Economics',0,NULL),
	(236,6,'Knowledge & Inquiry',0,NULL),
	(237,7,'Mathematics',0,NULL),
	(238,7,'Further Math',0,NULL),
	(239,7,'Biology',0,NULL),
	(240,7,'Chemistry',0,NULL),
	(241,7,'Physics',0,NULL),
	(242,7,'Geography',0,NULL),
	(243,7,'History',0,NULL),
	(244,7,'Economics',0,NULL),
	(245,7,'French',0,NULL),
	(246,7,'Japanese',0,NULL),
	(247,7,'Spanish',0,NULL),
	(248,7,'English',0,NULL),
	(249,7,'Chinese',0,NULL),
	(250,7,'Tamil',0,NULL),
	(251,7,'Malay',0,NULL),
	(252,7,'Business',0,NULL),
	(253,7,'Information Tech',0,NULL),
	(254,7,'Philosophy',0,NULL),
	(255,7,'Psychology',0,NULL),
	(256,7,'Anthropology',0,NULL),
	(257,7,'Design Tech',0,NULL),
	(258,7,'Environmental Sci',0,NULL),
	(259,7,'Music',0,NULL),
	(260,7,'Theatre',0,NULL),
	(261,7,'Visual Arts',0,NULL),
	(262,7,'Extended Essay',0,NULL),
	(263,7,'Theory of Knowledge',0,NULL),
	(264,8,'Mathematics',0,NULL),
	(265,8,'Economics',0,NULL),
	(266,8,'Accounting',0,NULL),
	(267,8,'Art & Design',0,NULL),
	(268,8,'Information Systems',0,NULL),
	(269,8,'Computer Sci',0,NULL),
	(270,8,'Electrical Engin',0,NULL),
	(271,8,'Chemical Engin',0,NULL),
	(272,8,'Mechanical Engin',0,NULL),
	(273,8,'Architecture',0,NULL),
	(274,8,'Marketing',0,NULL),
	(275,8,'Operations Mgmt',0,NULL),
	(276,8,'Human Resource',0,NULL),
	(277,8,'Communications',0,NULL),
	(278,8,'Medicine',0,NULL),
	(279,8,'Biological Sci',0,NULL),
	(280,8,'Social Sciences',0,NULL),
	(281,8,'Law',0,NULL),
	(282,8,'Finance',0,NULL),
	(283,9,'ASP',0,NULL),
	(284,9,'C++',0,NULL),
	(285,9,'C#',0,NULL),
	(286,9,'Java',0,NULL),
	(287,9,'PHP',0,NULL),
	(288,9,'Python',0,NULL),
	(289,9,'VB',0,NULL),
	(290,9,'MsSql',0,NULL),
	(291,9,'MySql',0,NULL),
	(292,9,'Oracle',0,NULL),
	(293,9,'Photoshop',0,NULL),
	(294,9,'Illustrator',0,NULL),
	(295,9,'AutoCAD',0,NULL),
	(296,9,'GIS',0,NULL),
	(297,9,'3D Design',0,NULL),
	(298,9,'Flash',0,NULL),
	(299,9,'Web Design',0,NULL),
	(300,9,'Linux OS',0,NULL),
	(301,9,'Mac OS',0,NULL),
	(302,9,'Solaris OS',0,NULL),
	(303,9,'Windows',0,NULL),
	(304,9,'Microsoft Office',0,NULL),
	(305,10,'Arabic',0,NULL),
	(306,10,'Dutch',0,NULL),
	(307,10,'French',0,NULL),
	(308,10,'German',0,NULL),
	(309,10,'Greek',0,NULL),
	(310,10,'Hindi',0,NULL),
	(311,10,'Italian',0,NULL),
	(312,10,'Japanese',0,NULL),
	(313,10,'Korean',0,NULL),
	(314,10,'Portuguese',0,NULL),
	(315,10,'Russian',0,NULL),
	(316,10,'Spanish',0,NULL),
	(317,10,'Thai',0,NULL),
	(318,10,'Vietnamese',0,NULL),
	(319,11,'Drums',0,NULL),
	(320,11,'Guitar',0,NULL),
	(321,11,'Music Theory',0,NULL),
	(322,11,'Organ',0,NULL),
	(323,11,'Other Instruments',0,NULL),
	(324,11,'Piano',0,NULL),
	(325,11,'Saxophone',0,NULL),
	(326,11,'Trumpet',0,NULL),
	(327,11,'Voilin',0,NULL),
	(328,11,'Vocal Lessons',0,NULL),
	(329,12,'GMAT',0,NULL),
	(330,12,'SAT',0,NULL),
	(331,12,'Hanyu Pinyin',0,NULL),
	(332,12,'Art & Design',0,NULL),
	(333,12,'Caligraphy',0,NULL),
	(334,12,'Management',0,NULL),
	(335,12,'Business',0,NULL),
	(336,12,'Admissions Exercise for International Students (AEIS)',0,NULL),
	(337,12,'Medical College Admission Test (MCAT)',0,NULL),
	(339,13,'Swimming',0,NULL),
	(340,13,'Badminton',0,NULL),
	(342,13,'Tennis',0,NULL),
	(343,13,'Table Tennis',0,NULL),
	(344,13,'Squash',0,NULL),
	(345,13,'Personal Fitness',0,NULL),
	(346,13,'Golf',0,NULL),
	(347,13,'Snorkeling',0,NULL),
	(348,13,'Scuba Diving',0,NULL);

/*!40000 ALTER TABLE `dictsubject` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table dicttuitioncenter
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dicttuitioncenter`;

CREATE TABLE `dicttuitioncenter` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table dicttutorcredential
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dicttutorcredential`;

CREATE TABLE `dicttutorcredential` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `credential` varchar(50) NOT NULL DEFAULT '',
  `position` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `dicttutorcredential` WRITE;
/*!40000 ALTER TABLE `dicttutorcredential` DISABLE KEYS */;

INSERT INTO `dicttutorcredential` (`id`, `credential`, `position`)
VALUES
	(1,'School Teacher (Nursery)',1),
	(2,'School Teacher (Kindergarden)',2),
	(3,'MOE School Teacher (Primary)',3),
	(4,'MOE School Teacher (Secondary)',4),
	(5,'MOE School Teacher (Junior College)',5),
	(6,'School Teacher (Polytechnic)',6),
	(7,'School Teacher (University)',7),
	(8,'Ex-School Teacher (Nursery)',8),
	(9,'Ex-School Teacher (Kindergarden)',9),
	(10,'Ex-MOE School Teacher (Primary)',10),
	(11,'Ex-MOE School Teacher (Secondary)',11),
	(12,'Ex-MOE School Teacher (Junior College)',12),
	(13,'Ex-School Teacher (Polytechnic)',13),
	(14,'Ex-School Teacher (University)',14),
	(15,'NIE Trainee (Primary)',15),
	(16,'NIE Trainee (Secondary)',16),
	(17,'NIE Trainee (JC)',17);

/*!40000 ALTER TABLE `dicttutorcredential` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table dicttutorqualification
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dicttutorqualification`;

CREATE TABLE `dicttutorqualification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qualification` varchar(50) NOT NULL DEFAULT '',
  `position` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `dicttutorqualification` WRITE;
/*!40000 ALTER TABLE `dicttutorqualification` DISABLE KEYS */;

INSERT INTO `dicttutorqualification` (`id`, `qualification`, `position`)
VALUES
	(1,'O Level Student',1),
	(2,'A Level / Diploma / IB',2),
	(3,'Undergraduate',3),
	(4,'Graduate',4),
	(5,'Master Holder',5),
	(6,'PhD Holder',6);

/*!40000 ALTER TABLE `dicttutorqualification` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table favoritetutor
# ------------------------------------------------------------

DROP TABLE IF EXISTS `favoritetutor`;

CREATE TABLE `favoritetutor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `requestorId` int(10) unsigned NOT NULL,
  `tutorId` int(10) unsigned NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `requestorId` (`requestorId`),
  KEY `tutorId` (`tutorId`),
  CONSTRAINT `favoritetutor_ibfk_1` FOREIGN KEY (`requestorId`) REFERENCES `requestor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `favoritetutor_ibfk_2` FOREIGN KEY (`tutorId`) REFERENCES `tutor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `favoritetutor` WRITE;
/*!40000 ALTER TABLE `favoritetutor` DISABLE KEYS */;

INSERT INTO `favoritetutor` (`id`, `requestorId`, `tutorId`, `modified`)
VALUES
	(1,2,3,'2014-07-12 17:21:23');

/*!40000 ALTER TABLE `favoritetutor` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fr_api_device
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fr_api_device`;

CREATE TABLE `fr_api_device` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` char(64) DEFAULT NULL,
  `ip_address` char(45) DEFAULT NULL,
  `connected_type` varchar(45) DEFAULT NULL,
  `connected_id` varchar(45) DEFAULT NULL,
  `connected_account_type` varchar(45) DEFAULT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `fr_api_device` WRITE;
/*!40000 ALTER TABLE `fr_api_device` DISABLE KEYS */;

INSERT INTO `fr_api_device` (`id`, `token`, `ip_address`, `connected_type`, `connected_id`, `connected_account_type`, `update_time`)
VALUES
	(3,'rzRoxgufPqcZtmyCZiwMDNXde','::1','user','10','2','2014-05-08 15:08:56'),
	(6,'8pjeSvHEP0bevtbXgUkd8MwZ9','::1','user','7','0','2014-05-21 08:44:53'),
	(7,'kdgD7zbMVMUtUkoS3xXS8T2hs','::1','user','19','1','2014-05-22 13:47:32'),
	(9,'kdgD7zbMVMUtUkoS3xXS8T2h2','::1','user','8','1','2014-05-26 12:11:15');

/*!40000 ALTER TABLE `fr_api_device` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table lookup
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lookup`;

CREATE TABLE `lookup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(40) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `code` int(5) unsigned NOT NULL DEFAULT '0',
  `position` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `lookup` WRITE;
/*!40000 ALTER TABLE `lookup` DISABLE KEYS */;

INSERT INTO `lookup` (`id`, `type`, `name`, `code`, `position`)
VALUES
	(1,'race','Chinese',0,0),
	(2,'race','Malay',1,1),
	(3,'race','Indian',2,2),
	(4,'race','Eurasian / Caucasian',3,3),
	(5,'race','Mixed-blood',4,4),
	(6,'race','Others',5,5),
	(7,'gender','Female',0,0),
	(8,'gender','Male',1,1),
	(9,'qualification','O Level',0,0),
	(10,'qualification','A Level',1,1),
	(11,'qualification','Diploma',2,2),
	(12,'qualification','Bachelor Degree',3,3),
	(13,'qualification','Graduate Diploma',4,4),
	(14,'qualification','Master',5,5),
	(15,'qualification','Phd',6,6),
	(16,'accountType','Admin',0,0),
	(17,'accountType','Tutor',1,1),
	(18,'accountType','Parent / Student',2,2),
	(19,'accountType','Tuition Center',3,3),
	(21,'tutorJob','Not Specified',0,0),
	(22,'tutorJob','Full-time Tutor',1,1),
	(23,'tutorJob','Contract Teacher',2,2),
	(24,'tutorJob','NIE Trainee',3,3),
	(25,'tutorJob','Current School Teacher',4,4),
	(26,'tutorJob','Ex School Teacher',5,5),
	(27,'tutorJob','Polytechnic Student',6,6),
	(28,'tutorJob','Undergraduate Student',7,7),
	(29,'tutorJob','Graduate Student',8,8),
	(34,'assignmentStatus','Posted',0,0),
	(35,'assignmentStatus','Cancelled',1,1),
	(36,'assignmentStatus','Matched',2,2),
	(37,'paymentMode','Cash',0,0),
	(38,'paymentMode','Cheque',1,1),
	(39,'paymentMode','Credit Card',2,2),
	(40,'tutorSelfMatchStatus','Parents Shortlist',0,0),
	(41,'tutorSelfMatchStatus','Tutor Reject',1,1),
	(42,'tutorSelfMatchStatus','Tutor Accept',2,2),
	(45,'accountVerified','Account has not been verified.',0,0),
	(46,'accountVerified','Account verified',1,1),
	(64,'tutorStatus','Available for Assignments',0,0),
	(65,'tutorStatus','Not Available at the Moment',1,1),
	(66,'tutorStatus','Blacklisted',999,999),
	(67,'examType','O Level Exam',0,0),
	(68,'examType','A Level Exam',1,1),
	(69,'subjectStatus','Live',0,0),
	(70,'subjectStatus','Discontinued',1,1),
	(71,'tutorSelfMatchStatus','Tutor Self Recommend',3,3),
	(72,'tutorSelfMachStatus','Parent Accept',4,4),
	(73,'tutorSelfMachStatus','Parent Reject',5,5),
	(74,'examType','IB Exam',2,2),
	(75,'tutoringMode','Part-time Tutor',0,0),
	(76,'tutoringMode','Full-time Tutor',1,1),
	(77,'assignmentApplicationStatus','Entered by Administrator',0,0),
	(78,'assignmentApplicationStatus','Shortlisted by Parent',1,1),
	(79,'assignmentApplicationStatus','Self-Recommended by Tutor',2,2),
	(80,'assignmentApplicationStatus','Rejected by Tutor',3,3),
	(81,'assignmentApplicationStatus','Rejected by Parent',4,4),
	(82,'assignmentApplicationStatus','Accepted by Tutor',5,5),
	(83,'assignmentApplicationStatus','Accepted by Parent',6,6),
	(84,'assignmentStatus','Confirmed',3,3),
	(85,'questionType','General',0,0),
	(86,'questionType','For Tutors',1,1),
	(87,'questionType','For Parents/Students',2,2),
	(88,'questionType','For Tuition Centers',3,3),
	(89,'tuitionClassStatus','Hidden',0,0),
	(90,'tuitionClassStatus','Available',1,1),
	(91,'tuitionClassStatus','Full',2,2);

/*!40000 ALTER TABLE `lookup` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table matchingtutor
# ------------------------------------------------------------

DROP TABLE IF EXISTS `matchingtutor`;

CREATE TABLE `matchingtutor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `assignmentId` int(10) unsigned NOT NULL,
  `tutorId` int(10) unsigned NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `assignmentId` (`assignmentId`),
  KEY `tutorId` (`tutorId`),
  CONSTRAINT `matchingtutor_ibfk_1` FOREIGN KEY (`assignmentId`) REFERENCES `assignment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `matchingtutor_ibfk_2` FOREIGN KEY (`tutorId`) REFERENCES `tutor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `matchingtutor` WRITE;
/*!40000 ALTER TABLE `matchingtutor` DISABLE KEYS */;

INSERT INTO `matchingtutor` (`id`, `assignmentId`, `tutorId`, `modified`)
VALUES
	(1,3,3,'2014-07-12 10:17:04');

/*!40000 ALTER TABLE `matchingtutor` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table option
# ------------------------------------------------------------

DROP TABLE IF EXISTS `option`;

CREATE TABLE `option` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `value` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `option` WRITE;
/*!40000 ALTER TABLE `option` DISABLE KEYS */;

INSERT INTO `option` (`id`, `name`, `value`)
VALUES
	(1,'Thumbnail_Width','200'),
	(2,'Thumbnail_Height','200');

/*!40000 ALTER TABLE `option` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table question
# ------------------------------------------------------------

DROP TABLE IF EXISTS `question`;

CREATE TABLE `question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(300) NOT NULL DEFAULT '',
  `answer` varchar(1000) NOT NULL DEFAULT '',
  `type` int(5) unsigned DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;

INSERT INTO `question` (`id`, `question`, `answer`, `type`, `created`, `modified`)
VALUES
	(4,'How do I verify the qualification of my tutor?','We get our tutors to send us photocopies of their certificates and the identity. You may also wish to verify these documents for yourself upon request.',2,NULL,'2014-07-20 10:59:55'),
	(5,'How do you evaluate the potential tutor?','We evaluate tutors base on their experience, qualification, one on one interview and feedback from parents. Rest assured that we will do our very best to find the most suitable tutor within your budget.',2,NULL,'2014-07-20 11:01:02'),
	(6,'Is registration free for parents/students, tutors and tuition centers?','Yes. It\'s absolutely free.',0,NULL,'2014-07-20 11:02:54'),
	(7,'test','test',0,NULL,'2014-07-20 11:40:25');

/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table requestor
# ------------------------------------------------------------

DROP TABLE IF EXISTS `requestor`;

CREATE TABLE `requestor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned DEFAULT NULL,
  `fullName` varchar(100) NOT NULL,
  `relation` varchar(10) DEFAULT NULL COMMENT 'parent or student',
  `email` varchar(254) NOT NULL,
  `mobilePhone` varchar(20) NOT NULL,
  `homeTel` varchar(20) DEFAULT NULL,
  `homeAddress` varchar(100) DEFAULT NULL,
  `homePostal` varchar(20) NOT NULL,
  `dictMrtStationId` int(10) unsigned DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `dictMrtStationId` (`dictMrtStationId`),
  CONSTRAINT `requestor_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `requestor_ibfk_2` FOREIGN KEY (`dictMrtStationId`) REFERENCES `dictmrtstation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `requestor` WRITE;
/*!40000 ALTER TABLE `requestor` DISABLE KEYS */;

INSERT INTO `requestor` (`id`, `userId`, `fullName`, `relation`, `email`, `mobilePhone`, `homeTel`, `homeAddress`, `homePostal`, `dictMrtStationId`, `created`, `modified`)
VALUES
	(1,6,'KAUNG MYAT AUNG','Parent','myataung.kaung@psb-academy.edu.sg','91864453','','BLK 201, 10-25','640201',260,'2014-07-03 11:43:10','2014-07-03 11:43:10'),
	(2,7,'shen cuiping','Parent','cuiping.shen@psb-academy.edu.sg','90668968','','','670615',287,'2014-07-08 08:34:46','2014-07-08 08:34:46');

/*!40000 ALTER TABLE `requestor` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table successfulassignment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `successfulassignment`;

CREATE TABLE `successfulassignment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `assignmentId` int(10) unsigned NOT NULL,
  `tutorId` int(10) unsigned NOT NULL,
  `matchedDate` date DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `feePayable` decimal(6,2) DEFAULT NULL,
  `feePaid` decimal(6,2) DEFAULT NULL,
  `paymentDate` date DEFAULT NULL,
  `paymentModeCode` int(5) unsigned DEFAULT NULL COMMENT 'dictionary/paymentMode',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tutorId` (`tutorId`),
  KEY `assignmentId` (`assignmentId`),
  CONSTRAINT `successfulassignment_ibfk_1` FOREIGN KEY (`tutorId`) REFERENCES `tutor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `successfulassignment_ibfk_2` FOREIGN KEY (`assignmentId`) REFERENCES `assignment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table tuitionbranch
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tuitionbranch`;

CREATE TABLE `tuitionbranch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tuitionCenterId` int(10) unsigned NOT NULL,
  `name` varchar(200) DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `postal` int(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fax` varchar(20) DEFAULT '',
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tuitionCenterId` (`tuitionCenterId`),
  CONSTRAINT `tuitionbranch_ibfk_1` FOREIGN KEY (`tuitionCenterId`) REFERENCES `tuitioncenter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tuitionbranch` WRITE;
/*!40000 ALTER TABLE `tuitionbranch` DISABLE KEYS */;

INSERT INTO `tuitionbranch` (`id`, `tuitionCenterId`, `name`, `address`, `postal`, `phone`, `fax`, `email`, `website`, `created`, `modified`)
VALUES
	(1,1,'Bukit Panjang Branch','Bukit Panjang Ring Road',670622,'14123412','12341324',NULL,NULL,'2014-04-29 12:30:42','2014-04-29 12:32:09');

/*!40000 ALTER TABLE `tuitionbranch` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tuitioncenter
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tuitioncenter`;

CREATE TABLE `tuitioncenter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `phone` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `info` varchar(1000) DEFAULT NULL,
  `status` int(5) unsigned NOT NULL DEFAULT '0',
  `nick` varchar(20) DEFAULT NULL,
  `ownerId` int(10) unsigned DEFAULT NULL,
  `verified` int(5) unsigned NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ownerId` (`ownerId`),
  CONSTRAINT `tuitioncenter_ibfk_1` FOREIGN KEY (`ownerId`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tuitioncenter` WRITE;
/*!40000 ALTER TABLE `tuitioncenter` DISABLE KEYS */;

INSERT INTO `tuitioncenter` (`id`, `name`, `phone`, `fax`, `email`, `website`, `info`, `status`, `nick`, `ownerId`, `verified`, `created`, `modified`)
VALUES
	(1,'Ethic Tution Center',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,0,'2014-04-29 12:30:01','2014-04-29 12:30:01'),
	(13,'Second Center','1234567','','zqi2@np.edu.sg','','',0,'2nd',NULL,0,'2014-08-09 16:26:43','2014-08-09 16:38:48'),
	(14,'First Center','81636076','','mark.qj@gmail.com','http://www.firstcenter.com','Best Tuition Center - First Center\r\nCome come come',0,'1st',NULL,0,'2014-08-10 09:11:33','2014-08-10 11:26:40');

/*!40000 ALTER TABLE `tuitioncenter` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tuitioncenterlogo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tuitioncenterlogo`;

CREATE TABLE `tuitioncenterlogo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tuitionCenterId` int(10) unsigned NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `fileBinary` blob,
  `fileName` varchar(100) DEFAULT NULL,
  `fileType` varchar(10) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tutorId` (`tuitionCenterId`),
  CONSTRAINT `tuitioncenterlogo_ibfk_1` FOREIGN KEY (`tuitionCenterId`) REFERENCES `tuitioncenter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tuitioncenterlogo` WRITE;
/*!40000 ALTER TABLE `tuitioncenterlogo` DISABLE KEYS */;

INSERT INTO `tuitioncenterlogo` (`id`, `tuitionCenterId`, `caption`, `fileBinary`, `fileName`, `fileType`, `created`, `modified`)
VALUES
	(12,14,'First Center',NULL,'logo.jpg','jpg','2014-08-10 14:12:22','2014-08-10 15:04:18'),
	(13,13,'Second Center',NULL,'logo.jpg','jpg','2014-08-29 08:40:15','2014-08-29 08:40:15');

/*!40000 ALTER TABLE `tuitioncenterlogo` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tuitioncenterphoto
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tuitioncenterphoto`;

CREATE TABLE `tuitioncenterphoto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tuitionCenterId` int(10) unsigned NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `fileBinary` blob,
  `fileName` varchar(50) DEFAULT NULL,
  `fileType` varchar(10) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tutorId` (`tuitionCenterId`),
  CONSTRAINT `tuitioncenterphoto_ibfk_1` FOREIGN KEY (`tuitionCenterId`) REFERENCES `tuitioncenter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tuitioncenterphoto` WRITE;
/*!40000 ALTER TABLE `tuitioncenterphoto` DISABLE KEYS */;

INSERT INTO `tuitioncenterphoto` (`id`, `tuitionCenterId`, `caption`, `fileBinary`, `fileName`, `fileType`, `created`, `modified`)
VALUES
	(6,13,'Second Center',NULL,'53ffcc02a7bae','jpg',NULL,'2014-08-29 08:40:34'),
	(7,13,'Second Center',NULL,'53ffcc4c5f5ba','jpg',NULL,'2014-08-29 08:41:48');

/*!40000 ALTER TABLE `tuitioncenterphoto` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tuitioncenterstaff
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tuitioncenterstaff`;

CREATE TABLE `tuitioncenterstaff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tuitionCenterId` int(10) unsigned NOT NULL,
  `userId` int(10) unsigned NOT NULL,
  `fullName` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `mobilePhone` varchar(20) DEFAULT '',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tuitionCenterId` (`tuitionCenterId`),
  KEY `userId` (`userId`),
  CONSTRAINT `tuitioncenterstaff_ibfk_1` FOREIGN KEY (`tuitionCenterId`) REFERENCES `tuitioncenter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tuitioncenterstaff` WRITE;
/*!40000 ALTER TABLE `tuitioncenterstaff` DISABLE KEYS */;

INSERT INTO `tuitioncenterstaff` (`id`, `tuitionCenterId`, `userId`, `fullName`, `email`, `mobilePhone`, `created`, `modified`)
VALUES
	(1,1,11,'Zhang Qinjie','mark.qj@live.com','81636076',NULL,'2014-07-22 06:24:32'),
	(12,13,21,'Qinjie','zqi2@np.edu.sg','','2014-08-09 16:26:43','2014-08-09 16:26:43'),
	(15,14,22,'Qinjie Mark','mark.qj@gmail.com','','2014-08-10 09:11:33','2014-08-10 11:26:29'),
	(24,14,23,'cuiping','cuiping@gmail.com','12345','2014-08-10 12:40:05','2014-08-10 12:40:05');

/*!40000 ALTER TABLE `tuitioncenterstaff` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tuitionclass
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tuitionclass`;

CREATE TABLE `tuitionclass` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tuitionBranchId` int(10) unsigned NOT NULL,
  `dictClassLevelId` int(10) unsigned NOT NULL,
  `dictSubjectId` int(10) unsigned NOT NULL,
  `weekday` int(3) unsigned NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `lessonCount` int(10) unsigned DEFAULT NULL,
  `classSize` int(10) unsigned DEFAULT NULL,
  `status` int(10) unsigned DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tuitionBranchId` (`tuitionBranchId`),
  KEY `dictClassLevelId` (`dictClassLevelId`),
  KEY `dictSubjectId` (`dictSubjectId`),
  CONSTRAINT `tuitionclass_ibfk_1` FOREIGN KEY (`tuitionBranchId`) REFERENCES `tuitionbranch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tuitionclass_ibfk_2` FOREIGN KEY (`dictClassLevelId`) REFERENCES `dictclasslevel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tuitionclass_ibfk_3` FOREIGN KEY (`dictSubjectId`) REFERENCES `dictsubject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tuitionclass` WRITE;
/*!40000 ALTER TABLE `tuitionclass` DISABLE KEYS */;

INSERT INTO `tuitionclass` (`id`, `tuitionBranchId`, `dictClassLevelId`, `dictSubjectId`, `weekday`, `startTime`, `endTime`, `startDate`, `endDate`, `lessonCount`, `classSize`, `status`, `created`, `modified`)
VALUES
	(1,1,2,161,1,'14:00:00','16:30:00','2014-06-01',NULL,6,10,1,'2014-04-29 12:34:14','2014-04-29 12:47:37');

/*!40000 ALTER TABLE `tuitionclass` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tutor
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tutor`;

CREATE TABLE `tutor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL,
  `fullName` varchar(255) NOT NULL DEFAULT '',
  `genderCode` int(5) unsigned NOT NULL COMMENT 'dictionary/gender',
  `yearOfBirth` int(10) unsigned NOT NULL,
  `raceCode` int(5) unsigned NOT NULL COMMENT 'dictionary/race',
  `nationality` varchar(100) DEFAULT '',
  `passport` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `mobilePhone` varchar(20) NOT NULL,
  `homeTel` varchar(20) DEFAULT NULL,
  `homeAddress` varchar(255) NOT NULL DEFAULT '',
  `homePostal` int(10) unsigned NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userId` (`userId`),
  CONSTRAINT `tutor_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tutor` WRITE;
/*!40000 ALTER TABLE `tutor` DISABLE KEYS */;

INSERT INTO `tutor` (`id`, `userId`, `fullName`, `genderCode`, `yearOfBirth`, `raceCode`, `nationality`, `passport`, `email`, `mobilePhone`, `homeTel`, `homeAddress`, `homePostal`, `created`, `modified`)
VALUES
	(3,4,'Shen Cuiping',0,1974,0,'','','shenpingping@gmail.com','90668968','','',670615,'2014-07-03 11:16:18','2014-07-03 11:16:18'),
	(4,5,'KAUNG MYAT AUNG',1,1978,0,'','','kaungmyataung@gmail.com','91864453','','BLK 201, 10-25',640201,'2014-07-03 11:36:29','2014-07-03 11:36:29'),
	(5,8,'Ta Investor',1,1979,1,'','','tainvestor@gmail.com','81636076','','',670615,'2014-07-19 14:31:07','2014-07-19 14:31:07');

/*!40000 ALTER TABLE `tutor` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tutorexamresult
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tutorexamresult`;

CREATE TABLE `tutorexamresult` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tutorId` int(10) unsigned NOT NULL,
  `examCode` int(5) unsigned NOT NULL,
  `dictSubjectId` int(10) unsigned DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_tutorid_dictsubjectid` (`tutorId`,`dictSubjectId`),
  KEY `dictSubjectId` (`dictSubjectId`),
  KEY `tutorId` (`tutorId`),
  CONSTRAINT `tutorexamresult_ibfk_2` FOREIGN KEY (`dictSubjectId`) REFERENCES `dictsubject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tutorexamresult_ibfk_3` FOREIGN KEY (`tutorId`) REFERENCES `tutor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table tutorhourlyrate
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tutorhourlyrate`;

CREATE TABLE `tutorhourlyrate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tutorId` int(10) unsigned NOT NULL,
  `dictCategoryId` int(10) unsigned NOT NULL,
  `hourlyRate` decimal(5,2) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_tutorid_dictcategoryid` (`tutorId`,`dictCategoryId`),
  KEY `dictCategoryId` (`dictCategoryId`),
  CONSTRAINT `tutorhourlyrate_ibfk_1` FOREIGN KEY (`tutorId`) REFERENCES `tutor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tutorhourlyrate_ibfk_2` FOREIGN KEY (`dictCategoryId`) REFERENCES `dictcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tutorhourlyrate` WRITE;
/*!40000 ALTER TABLE `tutorhourlyrate` DISABLE KEYS */;

INSERT INTO `tutorhourlyrate` (`id`, `tutorId`, `dictCategoryId`, `hourlyRate`, `created`, `modified`)
VALUES
	(9,3,2,50.00,'2014-07-03 11:16:18','2014-07-03 11:16:18'),
	(10,3,3,50.00,'2014-07-03 11:16:18','2014-07-03 11:16:18'),
	(11,3,4,50.00,'2014-07-03 11:16:18','2014-07-03 11:16:18'),
	(12,3,5,50.00,'2014-07-03 11:16:18','2014-07-03 11:16:18'),
	(13,3,6,50.00,'2014-07-03 11:16:18','2014-07-03 11:16:18'),
	(14,4,8,50.00,'2014-07-03 11:36:29','2014-07-03 11:36:29'),
	(15,4,9,40.00,'2014-07-03 11:36:29','2014-07-03 11:36:29'),
	(16,4,5,40.00,'2014-07-03 11:36:29','2014-07-03 11:36:29'),
	(17,5,2,20.00,'2014-07-19 14:31:07','2014-07-19 14:31:07');

/*!40000 ALTER TABLE `tutorhourlyrate` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tutorlocation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tutorlocation`;

CREATE TABLE `tutorlocation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tutorId` int(10) unsigned NOT NULL,
  `dictMrtStationId` int(10) unsigned NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_tutorid_dictmrtstationid` (`tutorId`,`dictMrtStationId`),
  KEY `tutorId` (`tutorId`),
  KEY `dictMrtId` (`dictMrtStationId`),
  CONSTRAINT `tutorlocation_ibfk_1` FOREIGN KEY (`tutorId`) REFERENCES `tutor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tutorlocation_ibfk_2` FOREIGN KEY (`dictMrtStationId`) REFERENCES `dictmrtstation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tutorlocation` WRITE;
/*!40000 ALTER TABLE `tutorlocation` DISABLE KEYS */;

INSERT INTO `tutorlocation` (`id`, `tutorId`, `dictMrtStationId`, `modified`)
VALUES
	(16,3,287,'2014-07-03 11:16:18'),
	(17,4,249,'2014-07-03 11:36:29'),
	(18,4,260,'2014-07-03 11:36:29'),
	(19,5,272,'2014-07-19 14:31:07');

/*!40000 ALTER TABLE `tutorlocation` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tutorotherskill
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tutorotherskill`;

CREATE TABLE `tutorotherskill` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tutorId` int(10) unsigned NOT NULL,
  `skill` varchar(100) DEFAULT NULL,
  `achievement` varchar(200) DEFAULT NULL,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tutorId` (`tutorId`),
  CONSTRAINT `tutorotherskill_ibfk_1` FOREIGN KEY (`tutorId`) REFERENCES `tutor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table tutorpageview
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tutorpageview`;

CREATE TABLE `tutorpageview` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tutorid` int(10) unsigned DEFAULT NULL,
  `count` int(10) unsigned DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tutorid` (`tutorid`),
  CONSTRAINT `tutorpageview_ibfk_1` FOREIGN KEY (`tutorid`) REFERENCES `tutor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tutorpageview` WRITE;
/*!40000 ALTER TABLE `tutorpageview` DISABLE KEYS */;

INSERT INTO `tutorpageview` (`id`, `tutorid`, `count`, `created`, `modified`)
VALUES
	(2,4,18,'2014-07-03 11:51:04','2014-07-19 15:37:17'),
	(3,3,43,'2014-07-03 13:14:13','2014-07-20 18:21:45'),
	(4,5,5,'2014-07-19 14:53:10','2014-07-28 05:40:46');

/*!40000 ALTER TABLE `tutorpageview` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tutorphoto
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tutorphoto`;

CREATE TABLE `tutorphoto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tutorId` int(10) unsigned NOT NULL,
  `fileBinary` blob,
  `fileName` varchar(50) DEFAULT NULL,
  `fileType` varchar(10) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tutorId` (`tutorId`),
  CONSTRAINT `tutorphoto_ibfk_1` FOREIGN KEY (`tutorId`) REFERENCES `tutor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tutorphoto` WRITE;
/*!40000 ALTER TABLE `tutorphoto` DISABLE KEYS */;

INSERT INTO `tutorphoto` (`id`, `tutorId`, `fileBinary`, `fileName`, `fileType`, `created`, `modified`)
VALUES
	(4,5,NULL,NULL,NULL,'2014-07-19 14:31:07','2014-07-19 14:31:07');

/*!40000 ALTER TABLE `tutorphoto` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tutorqualification
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tutorqualification`;

CREATE TABLE `tutorqualification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tutorId` int(10) unsigned NOT NULL,
  `tutoringMode` int(5) unsigned DEFAULT '0',
  `dictTutorQualificationId` int(10) unsigned NOT NULL COMMENT 'dictionary/qualification',
  `dictTutorCredentialId` int(10) unsigned DEFAULT NULL,
  `experienceStyle` varchar(500) NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `dictTutorQualificationId` (`dictTutorQualificationId`),
  KEY `dictTutorCredentialId` (`dictTutorCredentialId`),
  KEY `tutorId` (`tutorId`),
  CONSTRAINT `tutorqualification_ibfk_1` FOREIGN KEY (`tutorId`) REFERENCES `tutor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tutorqualification_ibfk_2` FOREIGN KEY (`dictTutorQualificationId`) REFERENCES `dicttutorqualification` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tutorqualification_ibfk_3` FOREIGN KEY (`dictTutorCredentialId`) REFERENCES `dicttutorcredential` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tutorqualification` WRITE;
/*!40000 ALTER TABLE `tutorqualification` DISABLE KEYS */;

INSERT INTO `tutorqualification` (`id`, `tutorId`, `tutoringMode`, `dictTutorQualificationId`, `dictTutorCredentialId`, `experienceStyle`, `created`, `modified`)
VALUES
	(2,3,1,4,NULL,'I have 11 years of teaching experience in both home and class tutoring. Give me a chance, I will bring out the best in you child!','2014-07-03 11:16:18','2014-07-03 11:16:18'),
	(3,4,0,5,NULL,'- I believe Education should be fun, learning experiences\r\n- I believe every students are different, so different approach of teaching style is needed.','2014-07-03 11:36:29','2014-07-03 11:36:29'),
	(4,5,0,2,NULL,'I am good. \r\nHire me.','2014-07-19 14:31:07','2014-07-19 14:31:07');

/*!40000 ALTER TABLE `tutorqualification` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tutorresume
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tutorresume`;

CREATE TABLE `tutorresume` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tutorId` int(10) unsigned NOT NULL,
  `fileName` varchar(50) DEFAULT NULL,
  `fileType` varchar(10) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tutorId_2` (`tutorId`),
  CONSTRAINT `tutorresume_ibfk_1` FOREIGN KEY (`tutorId`) REFERENCES `tutor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table tutorschedule
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tutorschedule`;

CREATE TABLE `tutorschedule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tutorId` int(10) unsigned NOT NULL,
  `dictScheduleId` int(10) unsigned NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tutorId` (`tutorId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tutorschedule` WRITE;
/*!40000 ALTER TABLE `tutorschedule` DISABLE KEYS */;

INSERT INTO `tutorschedule` (`id`, `tutorId`, `dictScheduleId`, `modified`)
VALUES
	(4,2,1,'2014-07-02 16:24:58'),
	(5,2,2,'2014-07-02 16:24:59'),
	(6,2,8,'2014-07-02 16:25:00'),
	(7,2,11,'2014-07-02 16:25:00'),
	(8,2,0,'2014-07-02 16:25:01'),
	(9,3,1,'2014-07-03 11:16:18'),
	(10,3,2,'2014-07-03 11:16:18'),
	(11,3,0,'2014-07-03 11:16:18'),
	(12,3,4,'2014-07-03 11:16:18'),
	(13,3,5,'2014-07-03 11:16:18'),
	(14,3,7,'2014-07-03 11:16:18'),
	(15,3,8,'2014-07-03 11:16:18'),
	(16,3,10,'2014-07-03 11:16:18'),
	(17,3,11,'2014-07-03 11:16:18'),
	(18,3,13,'2014-07-03 11:16:18'),
	(19,3,14,'2014-07-03 11:16:18'),
	(20,3,16,'2014-07-03 11:16:18'),
	(21,3,17,'2014-07-03 11:16:18'),
	(22,3,19,'2014-07-03 11:16:18'),
	(23,3,20,'2014-07-03 11:16:18'),
	(24,4,16,'2014-07-03 11:36:29'),
	(25,4,17,'2014-07-03 11:36:29'),
	(26,4,0,'2014-07-03 11:36:29'),
	(27,4,19,'2014-07-03 11:36:29'),
	(28,4,20,'2014-07-03 11:36:29'),
	(29,5,5,'2014-07-19 14:31:07');

/*!40000 ALTER TABLE `tutorschedule` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tutorschool
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tutorschool`;

CREATE TABLE `tutorschool` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tutorId` int(10) unsigned NOT NULL,
  `school` varchar(255) NOT NULL DEFAULT '',
  `course` varchar(255) NOT NULL DEFAULT '',
  `achievement` varchar(255) DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tutorId` (`tutorId`),
  CONSTRAINT `tutorschool_ibfk_1` FOREIGN KEY (`tutorId`) REFERENCES `tutor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tutorschool` WRITE;
/*!40000 ALTER TABLE `tutorschool` DISABLE KEYS */;

INSERT INTO `tutorschool` (`id`, `tutorId`, `school`, `course`, `achievement`, `modified`)
VALUES
	(2,4,'NATIONAL UNIVERSITY OF SINGAPORE','BTech Electronics','2nd Lower Honors','2014-07-03 11:36:29'),
	(3,4,'NANYANG TECHNOLOGICAL UNIVERSITY','MSc in Computer Engineering','','2014-07-03 13:42:57'),
	(4,5,'NGEE ANN POLYTECHNIC','Diploma in Electronics','Merit Holder','2014-07-19 14:31:07');

/*!40000 ALTER TABLE `tutorschool` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tutorstatus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tutorstatus`;

CREATE TABLE `tutorstatus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tutorId` int(10) unsigned NOT NULL,
  `tutorStatusCode` int(5) unsigned NOT NULL DEFAULT '0',
  `nick` varchar(20) DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tutorId` (`tutorId`),
  CONSTRAINT `tutorstatus_ibfk_1` FOREIGN KEY (`tutorId`) REFERENCES `tutor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tutorstatus` WRITE;
/*!40000 ALTER TABLE `tutorstatus` DISABLE KEYS */;

INSERT INTO `tutorstatus` (`id`, `tutorId`, `tutorStatusCode`, `nick`, `modified`)
VALUES
	(2,3,0,NULL,'2014-07-03 11:16:18'),
	(3,4,0,NULL,'2014-07-03 11:36:29'),
	(4,5,0,NULL,'2014-07-19 14:31:07');

/*!40000 ALTER TABLE `tutorstatus` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tutorsubject
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tutorsubject`;

CREATE TABLE `tutorsubject` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tutorId` int(10) unsigned NOT NULL,
  `dictSubjectId` int(10) unsigned NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_tutorid_dictsubjectid` (`tutorId`,`dictSubjectId`),
  KEY `tutorId` (`tutorId`),
  KEY `dictSubjectId` (`dictSubjectId`),
  CONSTRAINT `tutorsubject_ibfk_2` FOREIGN KEY (`dictSubjectId`) REFERENCES `dictsubject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tutorsubject_ibfk_3` FOREIGN KEY (`tutorId`) REFERENCES `tutor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tutorsubject` WRITE;
/*!40000 ALTER TABLE `tutorsubject` DISABLE KEYS */;

INSERT INTO `tutorsubject` (`id`, `tutorId`, `dictSubjectId`, `modified`)
VALUES
	(11,3,163,'2014-07-03 11:16:18'),
	(12,3,165,'2014-07-03 11:16:18'),
	(13,3,167,'2014-07-03 11:16:18'),
	(14,3,170,'2014-07-03 11:16:18'),
	(15,3,172,'2014-07-03 11:16:18'),
	(16,3,173,'2014-07-03 11:16:18'),
	(17,3,177,'2014-07-03 11:16:18'),
	(18,3,182,'2014-07-03 11:16:18'),
	(19,3,184,'2014-07-03 11:16:18'),
	(20,3,187,'2014-07-03 11:16:18'),
	(21,3,190,'2014-07-03 11:16:18'),
	(22,3,191,'2014-07-03 11:16:18'),
	(23,3,199,'2014-07-03 11:16:18'),
	(24,3,201,'2014-07-03 11:16:18'),
	(25,3,206,'2014-07-03 11:16:18'),
	(26,3,214,'2014-07-03 11:16:18'),
	(27,3,213,'2014-07-03 11:16:18'),
	(28,3,221,'2014-07-03 11:16:18'),
	(29,3,223,'2014-07-03 11:16:18'),
	(30,3,222,'2014-07-03 11:16:18'),
	(31,4,270,'2014-07-03 11:36:29'),
	(32,4,300,'2014-07-03 11:36:29'),
	(33,4,190,'2014-07-03 11:36:29'),
	(34,5,166,'2014-07-19 14:31:07');

/*!40000 ALTER TABLE `tutorsubject` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(254) NOT NULL,
  `password` char(64) NOT NULL,
  `accountType` int(5) unsigned NOT NULL COMMENT 'dictionary/accountType',
  `isVerified` int(5) unsigned DEFAULT '0' COMMENT 'dictionary/accountVerified',
  `sessionToken` char(64) DEFAULT NULL,
  `lastLogin` timestamp NULL DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_2` (`username`),
  KEY `sessionToken` (`sessionToken`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `username`, `password`, `accountType`, `isVerified`, `sessionToken`, `lastLogin`, `created`, `modified`)
VALUES
	(1,'admin@tuitiondb.com','$2a$13$XJlAImIwwj7GAxBs.MLwFOKBtrXvGnGdGGPhh8Ab9IAQD0WJFBA86',0,0,'ab7edc4d6780df66ca8db8feb19b1d188d67b77a','2014-07-21 07:43:44','2014-04-16 03:45:35','2014-07-21 07:43:44'),
	(4,'shenpingping@gmail.com','$2a$13$jjzMoIGJoQVtxmFErRb80esAWWa/VN13siTl1XJxS7MtboXXmhrVq',1,1,'8ce8mo7ci02prabmmj9vduu2q0','2014-07-12 18:21:55','2014-07-03 11:16:18','2014-07-12 18:21:55'),
	(5,'kaungmyataung@gmail.com','$2a$13$/kqBm.Xt6Z51LdpcxgivyuoVRSxkgm0sR/xhIa6TTU6xvLNjoHOPK',1,1,'7lqljvfp3d9pkcggkgmjph76j2','2014-07-03 13:41:32','2014-07-03 11:36:29','2014-07-03 13:41:32'),
	(6,'myataung.kaung@psb-academy.edu.sg','$2a$13$9TQXr57TsbyZgk/Sbbj4HOPle9k8ZG0pOwOlJEkKXqpHDgDz1nDky',2,0,'s15h9255lto463bs09o60qurv7','2014-07-03 13:49:34','2014-07-03 11:43:10','2014-07-03 13:49:34'),
	(7,'cuiping.shen@psb-academy.edu.sg','$2a$13$g1khWh0LmH3XeEvWx3xwzO23b7kpK0j8dTCekpHdK5.CNTM1vQXKe',2,0,'l0l45u4sbg2fa72o7h5sant564','2014-07-12 18:21:18','2014-07-08 08:34:46','2014-07-12 18:21:18'),
	(8,'tainvestor@gmail.com','$2a$13$Eral9achI5M4BmH.VSJi6OffSN/q5qpPCnN2bA0x1uzzYisKXi5.a',1,1,'u2oho6knn0grl0omi0f90oq7c1','2014-07-27 16:40:54','2014-07-19 14:31:07','2014-07-27 16:40:54'),
	(11,'mark.qj@live.com','$2a$13$1TTeUh9HvLeibpzTy5kwTeNRKk3nyR7HeAZhTeFnV4g1di7guv.pK',3,0,'u2oho6knn0grl0omi0f90oq7c2',NULL,NULL,'2014-07-28 11:35:30'),
	(21,'zqi2@np.edu.sg','$2a$13$./AIIDAc3X9z3YUeK0z9z.h1t3/fJ5DkGp9a6VBCXF93Ac45x1QMC',3,1,'b9vvufmdeipu9c8e9005rm6ut2','2014-08-29 09:55:04','2014-08-09 16:26:43','2014-08-29 09:55:04'),
	(22,'mark.qj@gmail.com','$2a$13$TpG9rOrvehyi6nJA52i5SOCQdAcjWS2s0QQ1wGwT1htHTFnSqvEr6',3,1,'6erhvss8oc79r1u0lq49n1gkh3','2014-08-10 09:11:42','2014-08-10 09:11:33','2014-08-10 09:11:42'),
	(23,'cuiping@gmail.com','$2a$13$0Pqg7RG3jsKBmCMHot6Qg.sK4Ait0Dk7oqCffV1XT3Uc2YwwMzP8C',0,1,'tvm9pgk9qiphbar4re8gdn5fu1',NULL,'2014-08-10 12:39:11','2014-08-10 12:39:11');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
