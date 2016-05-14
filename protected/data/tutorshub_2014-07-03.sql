# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.16)
# Database: tutorshub
# Generation Time: 2014-07-02 23:00:47 +0000
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
	(8,'Polytechnic & University','POLY',8),
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
  `position` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `dictCategoryId` (`dictCategoryId`),
  CONSTRAINT `dictclasslevel_ibfk_1` FOREIGN KEY (`dictCategoryId`) REFERENCES `dictcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `dictclasslevel` WRITE;
/*!40000 ALTER TABLE `dictclasslevel` DISABLE KEYS */;

INSERT INTO `dictclasslevel` (`id`, `dictCategoryId`, `label`, `position`)
VALUES
	(2,1,'Phonics',0),
	(3,1,'Student Care',0),
	(4,2,'Primary 1',1),
	(5,2,'Primary 2',2),
	(6,2,'Primary 3',3),
	(7,3,'Primary 4',4),
	(8,3,'Primary 5',5),
	(10,3,'Primary 6',6),
	(11,4,'Secondary 1',7),
	(12,4,'Secondary 2',8),
	(13,5,'Secondary 3',9),
	(14,5,'Secondary 4',10),
	(15,6,'Junior College 1',11),
	(16,6,'Junior College 2',12);

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
	(3,'Undergarduate',3),
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
  `name` varchar(50) NOT NULL DEFAULT '',
  `code` int(5) unsigned NOT NULL DEFAULT '0',
  `type` varchar(40) NOT NULL DEFAULT '',
  `position` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `lookup` WRITE;
/*!40000 ALTER TABLE `lookup` DISABLE KEYS */;

INSERT INTO `lookup` (`id`, `name`, `code`, `type`, `position`)
VALUES
	(1,'Chinese',0,'race',0),
	(2,'Malay',1,'race',1),
	(3,'Indian',2,'race',2),
	(4,'Eurasian / Caucasian',3,'race',3),
	(5,'Mixed-blood',4,'race',4),
	(7,'Female',0,'gender',0),
	(8,'Male',1,'gender',1),
	(9,'O Level',0,'qualification',0),
	(10,'A Level',1,'qualification',1),
	(11,'Diploma',2,'qualification',2),
	(12,'Bachelor Degree',3,'qualification',3),
	(13,'Graduate Diploma',4,'qualification',4),
	(14,'Master',5,'qualification',5),
	(15,'Phd',6,'qualification',6),
	(16,'Admin',0,'accountType',0),
	(17,'Tutor',1,'accountType',1),
	(18,'Parent / Student',2,'accountType',2),
	(21,'Not Specified',0,'tutorJob',0),
	(22,'Full-time Tutor',1,'tutorJob',1),
	(23,'Contract Teacher',2,'tutorJob',2),
	(24,'NIE Trainee',3,'tutorJob',3),
	(25,'Current School Teacher',4,'tutorJob',4),
	(26,'Ex School Teacher',5,'tutorJob',5),
	(27,'Polytechnic Student',6,'tutorJob',6),
	(28,'Undergraduate Student',7,'tutorJob',7),
	(29,'Graduate Student',8,'tutorJob',8),
	(34,'Posted',0,'assignmentStatus',0),
	(35,'Cancelled',1,'assignmentStatus',1),
	(36,'Matched',2,'assignmentStatus',2),
	(37,'Cash',0,'paymentMode',0),
	(38,'Cheque',1,'paymentMode',1),
	(39,'Credit Card',2,'paymentMode',2),
	(40,'Parents Shortlist',0,'tutorSelfMatchStatus',0),
	(41,'Tutor Reject',1,'tutorSelfMatchStatus',1),
	(42,'Tutor Accept',2,'tutorSelfMatchStatus',2),
	(45,'Account has not been verified.',0,'accountVerified',0),
	(46,'Account verified',1,'accountVerified',1),
	(47,'Tuition Center',3,'accountType',3),
	(64,'Available for Assignments',0,'tutorStatus',0),
	(65,'Not available at the Moment',1,'tutorStatus',1),
	(66,'Blacklisted',999,'tutorStatus',999),
	(67,'O Level Exam',0,'examType',0),
	(68,'A Level Exam',1,'examType',1),
	(69,'Live',0,'subjectStatus',0),
	(70,'Discontinued',1,'subjectStatus',1),
	(71,'Tutor Self Recommend',3,'tutorSelfMatchStatus',3),
	(72,'Parent Accept',4,'tutorSelfMachStatus',4),
	(73,'Parent Reject',5,'tutorSelfMachStatus',5),
	(74,'IB Exam',2,'examType',2),
	(75,'Part-time Tutor',0,'tutoringMode',0),
	(76,'Full-time Tutor',1,'tutoringMode',1),
	(77,'Entered by Administrator',0,'assignmentApplicationStatus',0),
	(78,'Shortlisted by Parent',1,'assignmentApplicationStatus',1),
	(79,'Self-Recommended by Tutor',2,'assignmentApplicationStatus',2),
	(80,'Rejected by Tutor',3,'assignmentApplicationStatus',3),
	(81,'Rejected by Parent',4,'assignmentApplicationStatus',4),
	(82,'Accepted by Tutor',5,'assignmentApplicationStatus',5),
	(83,'Accepted by Parent',6,'assignmentApplicationStatus',6),
	(84,'Confirmed',3,'assignmentStatus',3);

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
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tuitioncenter` WRITE;
/*!40000 ALTER TABLE `tuitioncenter` DISABLE KEYS */;

INSERT INTO `tuitioncenter` (`id`, `name`, `phone`, `fax`, `email`, `website`, `info`, `created`, `modified`)
VALUES
	(1,'Ethic Tution Center',NULL,NULL,NULL,NULL,NULL,'2014-04-29 12:30:01','2014-04-29 12:30:01');

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
  `fileName` varchar(50) DEFAULT NULL,
  `fileType` varchar(10) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tutorId` (`tuitionCenterId`),
  CONSTRAINT `tuitioncenterlogo_ibfk_1` FOREIGN KEY (`tuitionCenterId`) REFERENCES `tuitioncenter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



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



# Dump of table tuitioncenterstaff
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tuitioncenterstaff`;

CREATE TABLE `tuitioncenterstaff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tuitionCenterId` int(10) unsigned NOT NULL,
  `userId` int(10) unsigned DEFAULT NULL,
  `fullName` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `mobile` varchar(20) DEFAULT '',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tuitionCenterId` (`tuitionCenterId`),
  KEY `userId` (`userId`),
  CONSTRAINT `tuitioncenterstaff_ibfk_1` FOREIGN KEY (`tuitionCenterId`) REFERENCES `tuitioncenter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tuitioncenterstaff_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tuitioncenterstaff` WRITE;
/*!40000 ALTER TABLE `tuitioncenterstaff` DISABLE KEYS */;

INSERT INTO `tuitioncenterstaff` (`id`, `tuitionCenterId`, `userId`, `fullName`, `email`, `mobile`, `created`, `modified`)
VALUES
	(1,1,NULL,'Zhang Qinjie','mark.qj@live.com','81636076',NULL,'2014-05-11 23:23:46');

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
  `lessonCount` int(10) unsigned DEFAULT NULL,
  `classSize` int(10) unsigned DEFAULT NULL,
  `status` int(10) unsigned DEFAULT NULL,
  `classIdentifier` varchar(50) DEFAULT NULL,
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

INSERT INTO `tuitionclass` (`id`, `tuitionBranchId`, `dictClassLevelId`, `dictSubjectId`, `weekday`, `startTime`, `endTime`, `startDate`, `lessonCount`, `classSize`, `status`, `classIdentifier`, `created`, `modified`)
VALUES
	(1,1,2,161,1,'14:00:00','16:30:00','2014-06-01',6,10,1,NULL,'2014-04-29 12:34:14','2014-04-29 12:47:37');

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
	(2,3,'Zhang Qinjie',1,1979,0,'Singapore','','mark.qj@gmail.com','81636076','','',670615,'2014-07-02 16:23:58','2014-07-02 16:23:58');

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

LOCK TABLES `tutorexamresult` WRITE;
/*!40000 ALTER TABLE `tutorexamresult` DISABLE KEYS */;

INSERT INTO `tutorexamresult` (`id`, `tutorId`, `examCode`, `dictSubjectId`, `grade`, `created`, `modified`)
VALUES
	(1,2,0,199,'B3',NULL,'2014-07-02 16:25:06'),
	(2,2,0,190,'A2',NULL,'2014-07-02 16:25:06'),
	(3,2,0,191,'A1',NULL,'2014-07-02 16:25:06'),
	(4,2,0,205,'A1',NULL,'2014-07-02 16:25:06');

/*!40000 ALTER TABLE `tutorexamresult` ENABLE KEYS */;
UNLOCK TABLES;


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
	(5,2,2,20.00,'2014-07-02 16:23:58','2014-07-02 16:23:58'),
	(6,2,3,30.00,'2014-07-02 16:23:58','2014-07-02 16:23:58'),
	(7,2,4,30.00,'2014-07-02 16:23:58','2014-07-02 16:23:58'),
	(8,2,5,30.00,'2014-07-02 16:23:58','2014-07-02 16:23:58');

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
	(8,2,284,'2014-07-02 16:23:58'),
	(9,2,285,'2014-07-02 16:23:58'),
	(10,2,286,'2014-07-02 16:23:58'),
	(11,2,287,'2014-07-02 16:23:58'),
	(12,2,288,'2014-07-02 16:23:58'),
	(13,2,200,'2014-07-02 16:23:58'),
	(14,2,201,'2014-07-02 16:23:58'),
	(15,2,202,'2014-07-02 16:23:58');

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
	(1,2,1,'2014-07-02 16:26:30','2014-07-02 16:26:30');

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
	(1,2,X'FFD8FFE000104A46494600010100000100010000FFFE003B43524541544F523A2067642D6A7065672076312E3020287573696E6720494A47204A50454720763830292C207175616C697479203D2037300AFFDB0043000A07070807060A0808080B0A0A0B0E18100E0D0D0E1D15161118231F2524221F2221262B372F26293429212230413134393B3E3E3E252E4449433C48373D3E3BFFDB0043010A0B0B0E0D0E1C10101C3B2822283B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3B3BFFC00011080202019003012200021101031101FFC4001F0000010501010101010100000000000000000102030405060708090A0BFFC400B5100002010303020403050504040000017D01020300041105122131410613516107227114328191A1082342B1C11552D1F02433627282090A161718191A25262728292A3435363738393A434445464748494A535455565758595A636465666768696A737475767778797A838485868788898A92939495969798999AA2A3A4A5A6A7A8A9AAB2B3B4B5B6B7B8B9BAC2C3C4C5C6C7C8C9CAD2D3D4D5D6D7D8D9DAE1E2E3E4E5E6E7E8E9EAF1F2F3F4F5F6F7F8F9FAFFC4001F0100030101010101010101010000000000000102030405060708090A0BFFC400B51100020102040403040705040400010277000102031104052131061241510761711322328108144291A1B1C109233352F0156272D10A162434E125F11718191A262728292A35363738393A434445464748494A535455565758595A636465666768696A737475767778797A82838485868788898A92939495969798999AA2A3A4A5A6A7A8A9AAB2B3B4B5B6B7B8B9BAC2C3C4C5C6C7C8C9CAD2D3D4D5D6D7D8D9DAE2E3E4E5E6E7E8E9EAF2F3F4F5F6F7F8F9FAFFDA000C03010002110311003F00F2FBA6C000E3AF34472ABF0A2404742A718A8AE981650307BE69B1CCC8B81D3D6B06AEAE673F88BFE6B4CE88CE4B39C333727DAAAC98FB5952380704D206E01CF3D722A78EDDE5948519E334E210624996CB6783D6ABDDEC07E4036E3B54ED26D4DAB83EF8AAF3B065AA2FA11A464B9540586370C0ABD6F244F093261597F8483CD54B66E0E4E08E0106A660ABCE382320E7AD44B5D0CAC5C410CB1BCAD210B191F2E3EF537CEB7C4801CF23664738EF55A294C6B953F2302083D2A7302B85DAEA73DC76EF536024B3B864BB5758F7441C175CF5C55A37052692DA2767432109CE41C9EB8F53C566FD98AED9148F30F446201FD6A470ECA21489A5BA3D551493F4C7B62871135D0B7AAD9B5A2A93692D9885543079439763DC7A7D2A28F4CD58B3325B346CA048DE610981D470D50D9DCDDC423BBD93B4304CAFE66CCA875E99CF1C56DDB5FC776567BE321B7386B87DDF3C8D9E40E7E9FAD45494A2B440B41D67A169E96D16A1A9C92BCF2C837AA1538DDDD477207249E33514F71A379AC3FB381B62C42A994EF38E396033FC875A8B5BD4207B8885B05D9B3276B12141E76FB903033D739ACE9DE14850464EE61962C31B4F71FF00D7ACE1CCFDE90CAF24423B92AC49F9706ADB857B30476E2A89DCECBC919EF56E125A3923CF4C1AEB89AC4CD718279A739DA1401CE29675DAFE99A51C8C9EF40A5B088A64EA7F1A57B7962C3142A09EFF00E152DB492C2FBE2728EBC823B5453B92FF00BC25B69E0E6A7AE840A14F0BEB48CA223CB75F4A56DE029FCCD24D1EE0AC318A5D4436301982F4C9E4FA55A38DF91DB8005431280C587714B23EC526A8D22ACAE413963271CFB531836EC9183E956ADA340DBA43924723FA558BD3652AB3C41D246C7C863C01EA41CD5225B28C78DC1B23AF435231F98EEEBDA92141BC71B88ED5624B43F677B83344A4481443B8EF3919DC06318FC6968C48D9F0D58E9B72D3C97B711A490289156591555F079001FBC7DBAD5FBAD452682F5D2F2D21628112D618DA379F27818E578E73C8FC6B90666620B1C95AB9A5DEC7A6EA02E6EAC22BE217E586E33B7776623BFD3BD256D992D6A7447C3335BDE5CAEB37D1C4B0C79630C664466DA0AA93C63AF3F4AA764EB35DC70790278971B9D170107A0EC6B4353B5D4EE34DD3F57D6F5484D85CA799158C236951D804002804E39AC0BBFB5C5726E0C325B09B95DCA578F6ACAAD34F4D813D4ECCCD64B29D325D5D678B6E65B650178C7DC2EC42F071C75AC692156F0EAE9B772C3682D6E1E68DC16652ADDB8EBD700D634CB793BC89730493390A84B27CC84F43FF00EBA9A5B4B6B588C12DC17938C2C5F3EDF6E38EB58C61CAAD1637729DF58DB431472DBCE6746524B15DBCFA75A6C70C32E9CACAEE6E033168D46405EC4FA5492E957AB0199233220E5C46A729FEF0C7155EDA46466547C2B8C1F7AD5B76D04B622DC5323054E307356218985B2DC343218CB6DDE57E52DE99AB5796F6C9690C82DE6C1F95E5DF920FFBB8C0FA6735761F2628A2B337914F68794758F2CA48EA57D7B62A6525604624AC210DC0F9FAE3B5568559DE448C939E78EF8AD8D6AC2EB4E892D6F608D1A54F352400162BFEF771F4A83C3DA65CEA02E4D8C7E64EABB572C17839CE32719AD79928733655991D9CF2412C6C88AF28914C61D77293DB23BF38ABF7D6F702E963BEB97791C96907A1FA5374992EF4CB9F3A681828578E2798108AD9E79FA8ED5620FB53DC3C32ADB48F2FCEED752121CFE1DFDAA2566D3649817ED1B30DA3000F5CD42362C19182C696F53CA99A2DCAC50E095E87F3A4B7432C65467FC2BA16DA1A2D8ACDC9AD5D16CE29E68DA5B808BBB1B5537B67E878C7D4D66CB13447E6FCEB434F4B76B17325E047DFB444AA77118FBD9E98F6CE689ABC4523712EACE28DA29E789B6E49F2D5724FB2EDD83EBCD665E6B17130862B592682DEDDF7C51F9A5B63F761D393ED50DEDBC6B1248AD1AB1519546C8FAFE3505BA9DE02E55BB1AC614D2D48227F9E739200A6952067BFA54F22C602E0E491C9F7A9B4E86196E5D259B6A7965865776F60385EBC67D6B44EE86DEA16968C54492FC9095DD9EEDCE38AB56E65B69E3668F0C0F43D7078ACF13344A62763B07DDE7B5757AFE9DADE9FA669BA8EA726FF00B4C62042DCED450193904E783D7FFD75518B77609DA473932A891D4FAF1548E16401864679ABF30520C839C9ED59F2648CF7A0D5EC222859B19C0AB36EEB106CC6194FAD4030DB594E0E3073566181BE576E10E541CF278A0CF50015DBCB88161EBDC530B3C33215E082080C41E3DE9C158A058A36DAF9DF819CFB532689A063BD7691D0FAFA509012BDC09AF3780A4BE1533F754F41F9575F0694FA7CF77A80698298446EFB0E222DCB670DCF03A1FEF0FC398B5B5B6682279597682772EE1B98F6E339C0EA7F9D5ABEF1109963823478D106D29BC95C8E371F53C9EB594D3E827D8D3D80DBA5C798B1C12EF32C4A71BBE5C052AA4019C039ACCBA16023DD6B7FE746D263C878CC6E800CEE3D460F4EA6AABCEE976AA1D1B11A80CE4018DB9CD410AAC91330F5E4679FCAA545ADC56B166EE78E5B58C47188C2B7DD1D09F5AA267F32660C0124714EC1F33962066A2B88824AAE8E083DC5108A4EC52DC224691F8CE054F6F26C9F6E7AF19A6C121891BE5271D7DAA34906ECE32D9CE735B1AEC3EE46063BD41B48C1C13ED56AE471915170CB90A7DF273499331D0796F2AA96C2B9DA4E718F73ED51DCC252474055CA36D2EA72A79EA0F7153E9F633EA5A84165689BEE6E1C246A480093EE6AD789BC3BAC786AE843A859496C19701C36E47FA30007E1D6A945B57466919F9318572C1C9EB8EC69C23678CED6C7AE6A3B7533023380AB9FAD5AB44291BCA09F931907A027A54B56D4A51BB259E110ED418CC4A15CFAB753FCEA9EE42FF38C8ED53CD21F28E4F24E49354D98820F4A15CB9E8AC4F1808F9ED9A2591D998B1CF614CDDB9464D12650ED5CB06C1028B5CCD91972A4328FAE2A4F34360E0F3DA9E6CAE56D1AE9A275855B6176421776338CF4CE39C524089B4EF3B94292369EA7B0CF6A3A0D21C2506E51D8A20181D38E3E957B538623F67B88248A569D413B24676423AAB03C83C83FC89A5B1D2629648E41AAD81E54F9627292107A80597008FF0039AD88A2D2E637F7F7970D0DD12121B608D2F9981F7CBE40C9EE381C74A2F1DAFA92F4285A6AF7F6F05B5B2CA152C59A4810C2B80CDD4938E4F3C67A54173A94924DF689AE06F2F96DA4673EF4EFB2EE8F7994649E579FFF0057E556EC2F6DF4F90CA6D55CB0EAC0647A8E87F31835CB2A89B04B5B94F576B472A11F7DD759A546CC72E7A6D1818C54D617B6961624C48C2F483F331F947A11DA9F0C10CB7AF73716E8EB212C155C9500F7C86CE47A1A6B2E928C25B68A49A7230E8C8042BF4C924D2724F41B29B452C81E57B8632C8C31BCE7CDCF249E7A56E68D61A5430FDAAF90DDCF20DAB6E23DA884F7C83C91DAAA85D535264B786EADD7084889136F94B8E72CC38E3B66AC59ADD5B2A0D3F54B890CD90F24BF2C600EC013FAE7DA894AF1D1D89B167588ED6E34AB94B5BB5591146D840550ABDC39C724F6E6B1F4A48E799A170B681A3390F2954723DCFF002A7C0D79A95CBB7950488ADB83B12A463A1C6EE9EE41AAEFE4DA3B4568CD2CCFC4980192339FE0EF9FAD108B8C6CC09EFE4581A17765BF879C81B88DBD700B743D79E952E9377A35B6A975736B0B8B26DA5627919590E39008079CF4A84473F90D0CAF34508F94B1EA47A1F5A0E991C16B0DD18AD6DD0B1F2FF785A690762572768F738AD2E9C6C325BBD735F4695A1BC923B2998AAC642EC65ED943FCC8A911EDA5B33E75CABCC832C8876807D883835249A5DC5D68C676612C91B94552C1422819620E71DC75CE7B56742C96D6FBADAD2D8483EF99BF7AC7E83A01536525A88C2BC4D970FE84D4BA7602BB7A532FC389B738C16E7A607E153696A4ACAC0AE06320FA575AD8D110DFF40453B4DB769D262B6F34C51723CA5C85F73C525E82EA5BA0CD5682478DFE462B9F4343DB4068B054AB0F3C3202719CE0FE55280647D9024B313F7005C93F9568C5AC5F2471C1395BAB589772DBCE414F6033CE07A035045AD5DC524AD6AB1C1E671951CA0F407AD45DD882BF93BE418248279C8C62A4BCB516B72238E78E6CFF00146491FA814C40CE39E08EBEB53DCCB24B142923A111A6D4DA002067BE3A9FAF349489D482E20963B8513203900EDCF6AD493501A83D8DACB757B2C512AA225C3EE58CE3A2FB7619E7F95662CB145B9B258EDC56ACDA15D2DDDBC487CC69CC7E5A47CB61867381D87AD5F3586975285C44638DC13C827E522B3E4523A9E6BA5D62D523B87109DEB923240EA383D09FE75813A7CC70081546E6E784B48B7B8F32F2EE2122056D81E3DE808C724646492700569CDE0D52AAE2F8C6642310A460A92412704B0E060F6EC6B17C3BAAC76B6F71613AAF94C7CF5623259D46157E9CD31EF25B805B7EE11A63696E4A93838AE697373B6998B6F62B5CDBA5BDCC96EB7285437CAE148FD296502EE28F73E4AA1D99079E7BFEA6A18E0B896F238A1DAED31F943B0C7E24903F1ADCB1F0FC932B7F68DCC36B68B38C98E6590B336325403F30001CF23EB5AF32EACABE971E7C1F3C7E12BED5AEADAF6D6EADA74489245C24CAC71C0C6720F5E6B161D1EF8C65DAC2E4C9260C58858F1DF8C5755A86A724561169A93CA22B3959E01BC00A776E07AF6E38EDD39A9A0D7EE6C9EDAE6CAE549B8B448E467B52B862C416638F9DB3D1B241E78CD6D19424FC8CF98E2A386D269610F7AC85F2666642DB39E00FEF1C73D856C5A68DA4CB66ED0EBD1ADC19594AC91150177055279382739E323DEBB0F1E35AEABE16B43F6258F51B65569668A1550A4A93E590B9209E4E3803A9C74A93C33A8C16915968BA968A746D47E4FECFB89A20A24EBCBEF1CE49E71C9CF18C56BECD5F50BDCE06E743D422B7178D6CC6DCE024C1490E49C00303A9ED9C67AD549A1CDBA911387C9CE46071D7F115ED30783A1D67C3D24C254495A3955A36C2A453173BDB76DCE38C2F1C0FAD7906BCF6B0EA8F6FA7C8EF04198B76FCA3107E629E8A4F4E4E7AF7C5633A496A8B86E65AAE55B27FFAF513263383CD4B2119254607614D7C1190C7181DB1526A591FBCB64627B53B4E81AEAE52D9429691B68DD2041F99E29B6C774062231DC53F4FBFB8D27515B9B660B22F0AC47DD3EA3D08F5A97E6125789DB68FE1582FF47D42786DE78351D26DC5C5B4B00DB9937161BB3CB30DB8C60631D39CD73FE21F126A3E29B785B59944D2C0A4446340A0671CF1D7A7353D9EA93C1737025BD9E0B6BDC0BA92001D9812723A8EE7A671EB9AC77B74370C219C88958ED24E1B6E78CFBE3D2B6734D6861D4CFB364040DA7238639AD192E96589628EDE3894EDDCB10FBFB411939CF2724D674C3CABBF93E50FD0039AB042AA72724703E95949DCDA1DC492DA7B98659208599221972BCED1EF4C9ADA582385A68C2ACD1878F07A83DFF4A98168CC6B6D744B5C2ED9131B4039C05CE79F5CFBD53560ABB643964257AE78F6AAB68449DD921000069ECD840C0E31EA2A308D22EE070A3B77A30B1BE554161DCF3536B0879BBB82DB8CC48CEEDB9C8CF4E47D2AE5ADAC575243BA45B5B79182493C87214E793B40CE3FCE6AA0BA8E58BC97B74EBF7D320E7DFD69DE6AF97245BB71619E9C0A97E4547567A6E87A6F841EE63D3FFB725D44A467C9196418039C10AA3F0C9FC6B1F5AD5F4204A68DE1F96691B3B5E695C938EA4463240FA91585A0269AD137DACDD4D379AA1208546027F1364E79EC07038C9CF4A75D0B48EE1A50D26F663E56F948651CE3A609FAF4A9A934AD644DAECA135F30505B31391C8C74F6F6A6C124971B010719FBD9EB4F31C3771CD3AC8866871B83C84338CE3807EF63EB9A7C29C37951C9B71F7CF033E838FF001AC9C572EC058912558858F99FBB66DFB6300973D8E4E3D3B9A54BD96C61582CE345B966C79A572C9F8FF0FE150C16ED319647631A42016C0DCC73D3D3F3AD86D4A7BAD35CFD9A2B7B55023DD127CCC7B852496663DF9ACF676132B41A54CD6B35DDCC8AD196C36198F9DEA474C8F7245654D72B8616CA628D8E0471C8DB5F1DDB24F3ED5A9AAEA134B6B1A3C27ECB16132B179607A03CFF00415460BA8AD27631471C7137DD927884A40C7D077F6ADA2AE4A63E5B09ED617925816429F7C1404C63D719CAFB6714C37222B5215D25666DDB5589038EFC60FE1559A2B8B995A54855D82991F66308B9EA7B0A739BBB92BB5E4B82502957F9B03D07A014F4EA0B41F01B8D42E910246AEE71903903B93ED53DD47696CE042ED72C3EF129B413E839C9AACA9258C9BCC885C8FE1FE1FF003F950B7A627DD1EE1F302BB402C7FE058CAD095DD96C1635EDE4B368CDB3DB49659C131387762FEA0120F3E9DAB0AEE5742630CA54F50A4E7F13565AE72CCB705A1933BE3260DCCC7FDECE707E98ACE78257DCCA400A79CB0073F8D5282B8C82EEE2E2E193ED12990C6A1149EC3D2AC69390D281E809AAB2EFF308906187047A55BD21B13C99C1CA56DD0D10CBEC10DB536807BFAD56B193CBB904FDD20861EA08FA1AB5AA732E7615E3BF7AA56CC893A3485C203C94EBF851D06CBEF64484F21BCDF33958D5B257EA6A0786485CAED0C54F660C33F50706ACDB794D7C2481008B3C0BB61B4FE98FC39FC69FA94F1BCA638843B5BBC2C0E3DB802A7C8CC605C293C803BD35A42630BC607FB3FD6A42CA7AF6EBC54591903AE7D2B18887CB6525B4891CEBB0C8AAE037F748E2BADD0F5248F4ABAD421681EFAD5972F26D690AF445504700639ED5CEDA5BCA1E3BB1689340927964CAD84F3181DA0907D483F856A1F0ADD4DE218B4C82711A22A89E6693725B8DA59B2DC670A093C632719EF5AA8F320B95E7D445FDC4A48C161B8AE73D7AE78F5FE758F29F9CA91D474AE86753A11BBD127B382F7ED5B5ADF504525B60390CA075EFF4C7D6B16FA2CCC4838C7233D715495B466D16DA2893E5B82073F4CD5C82D2F2FAE2186CED259279B2A8912925C639C63B55465C37D6BB5F0CEBF20B6D3485892EB4990AC3315FBCAC080A46471CB7B9ACE6E30D644C975302CACAFB4EB31A9CD6E3ECB2C9E4A86C66620FCCA067763230703DB35A17BAA5FDBE9F1C31DA79110DC638E35213E72320F5F41C7B77AD859218AEE392F63696C209A791636C2A966EB93D3EF32F53D062A7FB3C4B6E6DCDC45044C719775C7EA4756EFC81C76ACF9E32D519338C86FE66810CF1ABC723B4680B6DDA78CE3B0EA3AF1CD7ADFC3CB2D196D46A77BAAF9F7BA7C7F6596395C08AD704E003D1BBE1B27AF18AE0DD6EA2D12F74E864492C2CDE3CA4597662FCF2E78C06C9E839193D2BA7D07C4967A11811214BA559DD642ADB0C8EFB76C854657820A8E7B135D74D457906C761E30D474B5D15A4B592369F5192283CFB60A5CA6EC9F9BD9436327AD73BE25D6F44BBB812B58CF79751B44F0BCD10289B41C64061BBEF13D3A9F61597AF6A505FDDC11DBBDBAC00C8EAC89962C831DBF8724EDE09C64F7AE61FCE593ED065089217898C8F9C9E78403A60772694EAB8BE5889BB9A9AC78BF51B8B4D5A1592DFECD79238F27C800A0214128D9EBFFEBAE024FBC703F035B7772CD6F67086226575603728CA9273FA67F5AC89800A07392720E6B28CE52DD9AC175230E1474049E9ED4D937799B4F2734E3114C1C83DFAF4A62FCD32EE2796E6ACD47ACCD0CC37743C11ED535D4593907E5351EA113C32146007A63D2A48C8974F4619DE32A78F4A9E97141DF426170ED611E6E8BBB398CC2533B5401839CF7CF4C76AAC370625062990233CDB04664EE40E31EFF4AE82EF469B4BBB86D61D46D273BC08C33A3216232413CAE7A023247239A145B57465249339C20493A74C839353B300A7228DBB6E66CAAA907690872323AE08FE94E8D2296E12392568918E19C2EE207B0EF4B791AC7489674EBCB3D3E479DA3F3E428D1881946D70C39249CE31EC33EE2B36D64B78E591E642D804A8078CD69EADA345A65C14B6BE8AF23F2D5FCD460D924671F292011F5ED5534BBEBDD3EFA492C64292B2152422B1DBDF820D6BE4CCF4E8761E1CF87EFABE977B7AF71148D0AB22456B32B309401B43705483EC7F2AE1A5DDB8C67E565E1B1EB5BCFE31D69E2B7417DE4ADB317856DE24842B1E377C8064E2B083132BB3E4927BD39F2A5642574340D801CF4A9100F2F731C67B814F601D3731C053F9D02391C00919C1EF8E2A169AB2ED62CD9C9E549BA1DDB80C839E73EA2AF4B713FD94206682304966540AD213FDE2396F6CF4A7F86E2B08B50906ACACB0C913224A9C989FB363B8EC69AB1234C2359177B1FF0058E4283FE15CF55D9DD0B725D334D4B9124F2491C5113B610AADBA47F4192071EBCD69F965267B59EF2C21B8F2FF007C490195463863BB6EEE338C66AE6992681A6B21551799506565988695C7A03F7467E959D77696B0EA3317D3E4B5919F322A234A57273CE7A1FD0D62AAB9276BE84496A53BAB8B73008E194C810EDDE368127B919C8FAF3F854516A8218B10615F2789620DB3FDDDC4FE78AD492E7C376D62A10CD35FC8FB489A106241FDE23AFE5F9541AA34F15B2C30DC2BD9E70D2C726C8A73D7E44C0C819F4AD52B6AC5631DEECBC4D124ACE8EFBE442A08DDD334A678E79224F25CC51E0155EA71D066A1BABE323AEF7F95001F28EA053A0BCB4B7960912233B2F2E9328D8CD9E0707918C77157AD82C4866812F034B0985385C16CE3DCE173FA52DC5EDADB078ACD19F7702660C0E3D813C0FAFE9525DC82E21966BC75FB54AE18058F6AA0E72001C7A564BC61E464F9B1D714D413011EE016C0202F7C0E69630F230209C038DB8C67F0A96D1520617202131FDD5719C9FA56A595E5A457DF6AD56192E239892442C0127D79EBCF6C8FAD55D20F421917ECB0C4C5235959860BAE405FF748C63F3A9351D5ED2DA4305B4293A960CDB9008C9C750075FAE6B32E13CABC3711E591A42511947AE402391D3B54F69A735CC922799E536DDDFEAC3647E7C50DA7A819D3486794C8C065C9271573465559E467200DBD4F18A8258444CFB492A8DB724F5A96191239C797133AB28CABF76FC2B4469619A8B996462086507008AA76C14CF1ABA965DC321464919ED53DCA94721860F523D2AA03839A06CE97C411E831E9D6EB6105DC3741BE7DC802BA638CF270D9AE76390AB0DA483EB566D9EE350B88A0759EE003CA4672E547271EF8AEBA3F0AF87E3BC6592EEEA1F3D03DB43738478C83C87E9D7903FAD632A91A6AD22A9D194D5CE6657011471C8EA3BF353E916173A8DFAC569637178460BA5BA64819EBE83F1AACB0C92ABC8B1B948F05D802428270327B7357B4A8E38DFCE96ED228482B22FDA0C6CDE9C0E48A3451BB30EA761696DFF08FEA8618AD3ED0772FDA23936B8E403865072A467F4A9ADEF6E7CC59A688A98498C491B15665EA149EF8071F4AA165244F6B135A2986CA2520CEF12AA75E4E47CEDD719F7AA8F7C7ED27C9BA95622A5C6300A027E5C93C6718E6B927CEDDD68BCC11B3ACDC477F731B2A49712EDC22B460C8EDD40F97F1E9E95C95E2C25320049092D9EA14761FCC54CB777CF7412276762C02C98DADB88C0C91D3BD4A2CE45B4B86163284500167524063CE3238E9574B9A32E693DCB83E87392025C1EB5ABE17BE86C759C4D6915C79D1B451190644521C61C0EE4723F1ACE955B7E3B0E2A06CA387524303C11C11EF5D725A1A5AE77D7DE56A51B2CC44314436C50C2AA9B71C6E23072C48393FAFA63CF2DA5CB794F25C30DC588109049239382064FA0E00AD6F0E5AFF006AD94125AA289546D53E5170A475DC0755E465BDEAF6A7A940D87B846BDB724C2214BA64F280FEEBEDE578F4AE383B3BCD98491C9B95856E34ED3ADEF8453B2A89656CB001B27010ED23A6783D3AD5D8EC6F2D9E3B99A12F103E5C24AE0C9819C91EBFCAAEC314124D0C97D3CB345B9149DE42C4BBBEE8FF006402393D687D52299A491DD6755664B68CB031C4CC3258E0FB0C0F63DB83A7B7E7F842C652DC5C5A472DC450CCCE430691321131D474233CF5ED5977339963791EE1418B0046D9C907AE38EDDF38AD3630C92BA5B493CB28012469D544781C7D3AFAD535B6FB75C401644657DD81B95150E724927B707F4AB8B56BB27A90342ED64D297F991C29427A7AFF004AA44A96C3678E477CD68DDC571044864BD8A659B2FB237248049E48C6067D2A8795BE555CE01EA7D2B58F91BC16847BCE0FAD4DA6DB8B9D6ACED8DC47079B322F9B20CAA64F53ED50B1DA76AF3EF50B3344E24438652083E8455ADC6F63735BD35AD93CC97FD67DA248A45C631B7186C7A1A6E9D3096C1A15B65DB1B6778C0EA3A118E7A7AD747E2D8ADA5D296686E4B4F32A35C8372240640B918E338393D3818C5731A33C2747D52174CCE3CB9227DC46D01B0DC743C1EF4E70B333832B5A48F06A0863E1CE500C6739E31F8D59B992E2DEC222B7A0C2B33A470193E688900B36DEC0E7AFB5520CA9790BB9210480B11D40CF35716CCEA9732DD00FF658F26495B2771E339C74C9239FEB52915357642888916E0DBB3920E319F7AA936E1F3282769C93E95A170CA46E1C1CE02E3803B62A7874AF3AC269B71770BB82C4EA42AFABE471CE075CFB528AD4B9BB221B1BE79A416AB1178E560A63DD804F6E79C73ED59EC67B7BF6578B64ABC14604107E94ED3A796CAF83C520470DC311F74FA8F43F4AE9E54BE1E288ED22B6492F353B3486192081E0D818F326DEA7E504E7BF5AD12BE867B3332C74297594926D39942C11EFD93300F2B01960800E40E6B2BCB6DF26F050A9C608C74EB5E99AEE8167A6CF6768C925DD8D85B192042E9199F0406DC4609EF81D4F3E9CF0FACDB241A6E9134465C5D4324A55958229321E177761EDFAD39434126431DC5B4114622877CAC30E5CE7F4A1660D28595BE5032360279EC2AAA8D987C738C7D2A43311749F68F30C60A96556C123D8D60E2AE5E8892D96E6E6FA286DC033C92AAC6A5800589C0193C7E75DA0F045CEABAA986D6FEC5AE51F1751124C31B05DC46E0727E98F5E457352D8D9FD8FEDECBFC414A071B233D839C64923D315DAF81F5CB2D2B43BB510DC1BD949F3AE14A88E3046060E79E067033D33551F66D6A26F4329ED3408E361A9EB4D2F9306F0962B1ADB9723E5418E723F8BAFD4561E9924B1091E22D1472FEED8428B966C71852C1B1FED0ADD4B868EE65B5D0223F6B9861240FE6CA01EA41E179F5209F7AA96D6A742BE8E69AC2DEE560909964694331C9E370C9C91D703D79358DE17B2D085726B3F086A71C8F6335FC16F3322BCA8ECCE8C08C8C951C1ED9C7E3531F0DB58E871EABA93C934E93049ADAE0623407EEFCC79EBDB3B4E467D0D8BCF1A978F36B0A44DBC9DCC49F9718C11D7777C8E3DAB0F5DD76EEF74C480B18EC890E2279C39771C6EC76EFF00E153CCDCAD62B42878AAC9EC751B7B8DD12B5CC0B288E323318E8320743C74AC540AC7733124F6C77A7E4A15DC842B838C8EB4F16AC618CAC4EED3B158D40C96EDC7AF3C56BB2B13B96152F2F983AC21A28C60B67E5FE9CFB559B8B092D95D58411ED507F7932876CF4017391D7BD74169A54D79AD699A558215BDB4B712DEC725C960318DCBF5C1C6D038CFD4D731AC457516B337DBCB1959CB312300F3D863A76FC2A5A6F5621C9A64DE6471B8480BAE774AC42E3D73834891C90B42932E5606251979127B838E466A397529E758D5325D780C064E3B0C533ED57A2262FE7848CED0791B0FA73D3F0C54A8CA5B810DE89167C86C26E2C1031253F134967753C170D711C8CAC460E39DC3D0E69C0A89159CF98AC39DA72727EBDE9F14A61568A34DB2BB637390303F1E86B64B4B0790C36F90E6462809DC13218907F1A6AA4AE32A18AC5FC5D38CFF003A74464899DAE14A87046E04139F6E4547B6758119C308E4F9979E0F6AD1686886CF26F46F30B16EC7354F19353CA720E7AD41B8A1E00E9E9403353C3B7E74CD592747894942019B1B0FB3655B838C7E3D45745786F9E178AE26B4742E1A0F2D9A46231C04033F2FB71CF4AE3ECA5F2EED2462E003CEC3838FD6BAA7BB4BA8A330DB8BB6553E634D80EC09E08C37247B0ED5CB5D3E64ED7368C9725998B1DE15B592D83C8239183ED0E42EE1D095EFC66BB0B2D37C31295BD5898B4169E63D9BBF98923B0C2ED6E32412323D4F418AE4ED34A926BC68278E44746D8F9070ADE9F857456F15DC16B0594B2ED2A731348FB7C94C91B720F4C739E2AFDAC63A5CE569A57346F61B3D4524BC9B579ECA4B61B6D60CABA483072B8FAFD473ED54E1D3E4D4E77512DB2C8A83311C2EE0318006393C671F8D5EB0B47D3E05D62E6E7ED04922DE25C46645C1058819F97031DB39A75EEB3AAAC72A4769691C16D326ED9187C3B8C823DF9C1AE3AB526DEC5462ADAB238F4130DAB472EA13DAC32DCA6E8A32AA0F1CB927D3F4AB765A6C2B23345A8DD985CB2B82B859633903D8F00738F4F4A7C5AAAC963F3EE9AE3A48F25BEC56CE323009181D3DF19A8EEF54BC8ECC412C7B2D9806CAA18CA92303E61DB07D7FC6B8DCAB3972F37DDB1AA514AE721ACDA241723CB398DF2548E86B1A419623B0AE9EFF00ECF75602281D5E5B724AECFBAC38185CF5AC09203F376607A75AF6A12E68DC64FA26AB3E9770FE44850CABB37A92ACA3BE0F6CF435D4991A2821B51FE8977BF06E15B3B703A631D060FA935C2B2EC7FEB5A7A54B2CD218924512FCBE5861C336401DC01EB939E9D2B1AB4AEF98892EA6C5B5D5C25E5CDB1904A15CAAC8990AEBCE383CE7B8EF4CD5EE6EE7FB24B20586DE3FB9B23291A28EBEBCF393D4926A8CD751DAB045B8943A93E629202F980919000E0006A66F12B4DA12E97A83192185C3C2766FDA4290B80C47183CE6A610B4AE910649BE3F66FB32419677DDBC8272BDB8FCEB46D21FB54A96459BC9DAEE8506003C738FC2AAC79373E62ADC4F330E4B2853D3D01381FA0ABA45C1D32E3CF0A30BF21DF92BEC067B9E7EB5B4A37134B62AEA1A74D6611E5DAAC546E4DD93C8FD7F0AA330C46A413D0E6B42E7CC8E131058827CB212916DDDF8F7ACB966073B18807822AE29D8D216B118C01B88E6A291B208A793F2E2A27EB8ABEA37B1D80D6C1D26CD6488C7756F0E1AE8481DE507851B48C2E077EB8C74AE5ECAE8DB4D22855D92A9460C01E0FF0051EB5A96F7D149A2C3671A6641279933B9C8C0E1470381CE7BD655EE3ED6EC191C16EA80E0FD334EEDBD488AB093C8A620831C1CE71CD6E4B782F34BB31146D1A5AC02227CD0DBB9279000C739EB9FEB5872441DB21703B739AD0B6DF15BAC18253258A9E99A96ECB434B5DEA37E69A58D1B38DC0703381DEB53C31617AD7F2DDD969C750FB164490473149A40DC2BA81E9C1EE38ACB94C4D31DA80AFA633566C6F5B4ABC370B6E0174DB865DA4720861E878A1351D5933D4A5A9CB737FAB5D5E5CF1712CACD22B000839EE0719AD6D5F53BBD435F8F50FB308A74B642CB64460281C9050FC83079F4CD54996D2E2CEEAE9E6905FC9724A448995287925989EBE839A834BBCFB0EA51C8A5900650CEB2BA145DC3272BED91D0F5E869A7E64DB43B8D7B4BB696093558D5F4AD56D63CBDACD22CAB22E38D85492A429CE4F7FCEB84B8BC9268ADE225BC985310C658B040793827D4F35A57D79632D9DDF9168B03195523DB2BBB6DE496DC71907818C0F5AC9C3C3182AA4E7A64554A49BD022993DA3DAF998BB53E5F1F302723F018CFE62AEB5BD9DC471247742E88662AA8A55A31D71F31008EFD8D626C24EE91B3EC2ADEEF218F9172C7E5E19772F047239C1F6AC98CD8B4F2ACC90D6F3AB428649192592312F24AB4833D07000046699A86A86EA644B5668EDCB7EE5114C4B9239F97241A9F47D1E11A2FDBEFEE5C25C93F66B4B72159B0705DD8838504741C9F6ADED0FC19F6B8D2F4B2DBAAB0689986E91BFDA0323038E0D7354AD4E09B93D8F56865756AD25564D463DDF5F4453D1F59BC92CE7D3B4A9DA0510B8B89E52BBE41C746246D1D00033C549A0F86196CA7D4EFBCB8E23FBB4B9B8632F43C88E35E58F079240183F5AB5AD692BA539692E0CFE60DC8E571BB9C1C8C9E457237B7F74DBA35B891613FC01B8A4ADCAA507B9E8D4C968D3A0AA467CCDF9591B37FA7DBA24925ADE45345821C5C045318E725712104F1DCE7A75AC2BA804164C6360FE79DA091CEC1CE7DB27F1E2934E0765C7202ECC1DD9DBD0F5C5362584B87B893F74A0B15418DF8ED9EA01F5E715A2DF53C0C55254A76895EF0CF3CF11961F243463CA182032FA8CF5E735A70CF77E1EBD4B93A7ADBBC96DB612C848C1E0C8BB89E4F3CF4F4AAD3C6925C2DC4513DA01831461F7903B73C1151DDCB34E8B3CF216906559E494B3B63A707A0038ABE65B2394AF25DDC4576B7304F247367224472AE0FAE4739A26BA33A9691E4795B259DCEEC9FAE7350AF99E6AA88CBBB9E00192DF4F5ADC9FC31ACC72BCDA9598D3E2C06DF75FBA0738C01EFED556D350B146048E1D2FED2656498B6114123773CE303FAD326D4AE24B736A26905BB36F316F254B631BB9EF8A96E6D9EE3513696B6B248CAA02246B927D4D3AF7459B4B847DBDA382761B961FBCE7EA41C0A98BE6570339485E738351BBB9CE1B18EF9C52395E0722932C410A302AD21A23527BD598989876F5C741E95018D946718A512B950ACC485E83D2B42C24FBDD78A858FCDD6A42430CE38A5F2C1899B2991D89E6813DC8C10848DDBBE94F82630C8AE9D54E451670FDA2E1220189638F9549C7BE0576977A1E9C9A4C7091642E616056E577ABCE9E853A7E358D4AB18349F51DAE69BC9A7C32BEC9C02E0C98047AE39F73D71D855486D99A2F3DA649C33942C3A64751F8669655B5B2365359C867704E63850893CDDDF292C47CD827A0F4AA11B18B509E197CD0FE61126402CCF920F04F273EF5C33A4AD75BB06A36563A8D274FB492DDAE6E2E266B8538B78E10C446071CED3C679EBDB1C54B7D7B0859E38CCB1C49B4C8D1A0F31643C2925860027DCD39354B6D3EDE512C17D6E61FDC85C85791987CC0F200217A28CE07719E71E7D67527B492389E18ACAE8EC68C401A6214EE0C4F3D369C1CF1CFD6A7D9A725CDD049D959114972964AF7075045995F26295C64B01DD40C13D01ACF86F56F6796CEE750F22D9E23248C4E439504A8E012B924F1EF546E9127BCB89DA42647CBFCFF3139FF3D6AA44B18899829663C614F03D6B6A504B50B9BD017B1D3EDEE5FCE892EC9787746024880E3209E7AD665F47B58CD1312920CF07F31435C5C4915A4179732490DAA6228D9B1B109E42FD4F7F6F6ABCBFD982D8AC0D2AAC87FD5CBC90D8EB9CFAFB5744346EDB15197439B910E739E692191E094491B1564E41F4AB73C2EACCAC791C0F6AADB3A8CE33D4D696B97B16239639EE45D3A6F39065321CE4FD2AFCFF00669D45CDC432BAEE3E734732E0E71B7031D739EB585182930EEB9E47A8AD6B3852F485541185CB6C55C038E7A93F9FD2B39AB6A6325D46496E6DE2337DA63271C2A3176E7D7031D2A492FE29AC63B5F24295561E733739FF000A5B8650CC9034CD1382034F800363E6C633C75FD2B243641523A02314E377B926D5DDC5FAC6B6372A6385D331C4ABDCAE54F3EBC73E958BE593C8E84D75FE1AB59B54BF8EFE5B9491AD7FD62DC7CC36631925B3C019E7B6171C9AE7A186374F259CA10E00C8E3AE3AF6AA5257E54F55B9A535B945A2C6E2180C1E86AB49C9E95A3770A2CC550E40EF54E41818AB29A16CE6688C9B558E531C76FAD4647993054C9A692CAC369E71576D20F291DDF86C75AAF3212BB14A9014AE0F3D0D4EAF206DDBB048CF07A8A20B53346C41C11C8E7AD37CCF297A0E98E6A0D91258DB1B99BE562A43632159B07B7001F435B1AA693FD9ECF1CF711CEF3C08ECD1A9CC27A95E7A9E9D3DAA95A695A858DC5BCB7114B642E82B4372EC51029C1C965E470477079F7A9B5DD4B7EA0441766EC28DBE7B21512F18DD8624FEB54EDCBA9CF24F9B43115DDC15078C9CD2C524D6FE6AC123A2CC852500E032FA1F5E9FA527945A3C16DA54920927AD4D39B7768B66F8CF0262400A31C640EA6B3F42AFA1A13EA1A7CBA3C8F2C709D45E14B7448D5D444AA41DF9248258707A1FA64E72B65C0B75903379478C039E7DE9CB6CB70E238E4556C64973806B4A59AD2DDA38FECB045852D26C1BC31C7CB870DBBDCF4C55395D06CCCA581F38746407D4629CB6CA73F39A7B4F2DCC2C65F31E46FE3DD924FBE7AD450C61A35DD2119386DA3240A80576CEBBC216F6F702DE2B8D86369DC1CF1B800081F89AED9FED21F73B1E0E0907ECA9FF007D72EDF8605717E129E0B2785A499442267469003F2E557923D8E3F5AEAAF2F74FB5824924BB59657180B6F2F98645C9E3776CF73DABCBC6733A918DB4B1F6B46329D0A4B7F77FCCC6F1A4CA1ECE28A48DA23097409924027A96279C91FA7BD70D739EA7A575AB2C1A8DE5FDF6A310916DED5A55851CA2920AAAAE7AE003DBD2B9DBCBAD2E7381A7CD6E47F14771BB3F830FEB5BD0838C526CD3133F650F62D6ABF5D4348B55B94955E6584371BCA33FA76504F7F4A9D3C27AECA4CABA4DE4F129387F2182301DC6E02A0B4BE4B396336524A5903B12C361C63A706A51AEDD5D5CC42F2E0088B80F2480CBB173C9C13CE076ADDB97447CE56C3BAB27316CD248E79E76375672D980C8EA48656240CB1C67A1E9DEA1BF3653DD036C249032A83BD4202DDFF0F7E2B4AF65B798C4F6EA35562E6493746FC2F405F938271D338C536C74E859269EED4C570EFBA310901631D7800E0510839EAF438B0F82C4621FEEA0DFE5F79A7E0883518F4FBBB8B45D3B4F8F790FAADC9CBC6B81F220E467B83EF57441A56ACD771E9A931B689449A86B7AA624930392B1061C1358F736B657FAB45672DD3DBC97322805C709BBB924E3A77FA5686B1A9595CCB6BE13D114A69566DBEE65059BCE23923393C67F335BC6575AAD8E7A909529B84F7471DA8DF4F0DC3C169732A4209030DB59876DD8C550DC4F2CA4E7DFA9AB17F7246A734925BA7CCCDF21CF00F4FC79A8A17853724CA1BD086E41F6EDF9D16D2C41245661E232CF22C510F5FBCDF414B38D3A39585BB5C343F2E1CA8EB8E463EB55EE6769A5DEC1471800003007D29AB2E1187AF6A6B41585755790152C57FDAA75D18B620039EF4D4242EEC6053A5849457DCA411D8D55C772A1DB9F97A55E0F1081237855FA1250FCF8AAE1018F007CC4F15A71D9DBD95C42893096499096C758FDBEB43765706CC7185918A12003C67AD6D69738579EE2E72EFE5797183C004FF80AB7AAE873C56F1BC96CEB232068D971B5D4F43546CA394BA89488D41C9241FCF8E6B19B5388EE6D3EA3E722DB4B69F65488F0EA8EDB39E79FAD55B6B99A3D64DD5BC3E78B66062F3932030E14B0FAF38F515764D1AE23497CC32C44B031C2D2EF927607838E0228C9F99BF0CD62CC9716F721DC70577282770032475EFC83CD125A908D837134E2E2F6E6E5A5F28869DAE393BCB72AA771EA724E31D2A28EE12E23999499CED2B9625446BE83FC9AB9A55DE99A84569A6CD7674C4B6612AB470B4FF689CB1C1DBC00003819E29DAEEA53DDF9865D4E5BEDA4AF9B2A08F72FB01C73DBD8544A31493EA3DCE72678CC851B2FB463192054F6974F0BA2AF9C8C576E4123AF400771F5A6D9DA3DEDDA08B61666C043919FA54FF6793CC313AF925093F30E7E94395B41D889E225B76E63B323EEE39CD1E65DC6BB828288980792569F749E5A6E3E64E4BB2EF390063191CF7E456AC767225A2D80D3847732209165B82C1D577024E0311C8C0FBBD39A1C925761D4CEBA97CD8DA4DC19A603780B81B801FAF3598E9B54E6B73CBB8BFB34B64B986E05B464DBC70C782C0B7239C1639E7A7AD64DC463715CE003D2B48493378BE6467161BF1822B4A0BF516DE4C91A1DBCA3040187AE4F7FC6ABC4AAD290172FB4EE07D0724FE429B3AA87DCA40C9AB92D086AFA12324B712471A7CCC48DA11724927A003A9ADF6F05DDDBA488F736325E807CC84CFF00342300E5863A81D4573E97FE43308C9241CA4A490C38E3047434DB467336119FF78BB5845CB3E7F87F1ACA519DBDD763248EBE296CB474963D2ED66BC69997CC91DB2136F3C8DA0633CE3A74E4D73576049FE908ED991DC957392307B9EE6B46D66D58A88227B841B19A28E0539465FB983D464F7EF8AA02092E8096691946FC3337396272DDFD4FEB5342166DDEED9A43765611B792D236DC004E4B0CB7D055298A093824803F5ABF752AF289F7509551EDCD66B905F1DCD75163EDE0695F7EDCAAF27DAAC48641FBB6FE1E31562D2304046C7BD453AB077380C01C6E1537BEACA4AC896099ED02B0DB28906361246D3FE7D29151432AC88DB8BF5CE001E98A96CA345B7B895C28688A8197DAE33C1C0EF9CFFF005E8B8B88659449F6791372018DE5B730E0B64F6F6A972D7421B2D3CD76616B64D4A04B757F3F6BB8DB9C05CF039380071497D0DADCE97A747048D2DFC84B4F3C8ECAA3270B18DD80303927FA5663792D22ACCEEA3A9DA3257F0381FAD69CBA55AAE9B15CDB5D3B0E77BBA141903381963CFF00F5B8A7CDDC14746CCC894C9B433A864CE06EDA73EBE951DDC73453949C11203920F5ABF6A7FE25ED7620763149B4491C2C421EBF339F94673E84F1DAA9DC2C931134EC6432127716C93F5EF43D08DC4818ABB4A61561D0B140403F9605134C59FD7E9576CAC89D32E2FE47531DBBAA491962ACDBB3B48E307907BE6A872AA40E4B73E95366F501F13B347B00DA0753FE14FB661136ED82407AAB0CE7F2A8E2493CA66DD804FA71EF5D5683A0D84DB2F350BD7B4B68D43332B6E773FEC8C0C7E393F5EC346F430F52B36A086697333E8120FBAAD7ECDB146067CB5ED52428B7128863962F398809196C163EDDBF322B6A6974CBBFF43D134C922803486492698AB38006E76762422F20123E63D38CD5497419A0B2F365D4A0B4B69B38FB3DBB043EDE6305CFE2DCFBD67292D343ECB098EFAB61E34636D3AFFC02ADBAC96D16A303EE57B9B73002A7EE9DEAC73ED8522A2D37C229A9BFEEE55723AA9940FD3AD661D456CA5DCDAE4CF8C6D10825C73EA18A8FCCFD2B40F8D6F6EB0964F2068D73BEE1FCE793A75C80A3D7A7E354B9174667571B86ACDB4B57DCB77DE04BFB6B66960B68769E0CB1167C0EF91B8903DF158BA2D94916B3135CE9EF750C5B9A48C0C86503048EC7190719ED5D05978DB5B2AA935BDBCABC1CEDDA4FFDF24568A6AF1EB5249A7C964229E556903170186DE71F31E475ED9E4E29AE493D19838D2941A6D25DD3FD1997259466EE56B350C6762FE544A4B0503BE0761D8640A8953696DCCA0019273918FA8AD0B8916DEC1EDACAE34F8EF17E59A197716906DCE770E4AF3D30071CE6B91D4752915840CC58F46723AFD3B01F4AD7DAA8AE58ABB3759ED0C3C7D9535749596C4977710DEDE4C2F2558A1447685923C96703E507D73EBC62B32DEF2EECACEE1922658AF0795E6E0800A904853EBCD457334D2E0BB02480318EC3814DF388892266768D4E42E4E01EE40ACD2B23E32A4DD49B93EAC59C330F3E6E07766CE5BDF9A83CD5CE50607EA6895DD942962554E4034DEA33C7B5558CFA08EE19B9A7279418EF2DB71D8679A46429C38C1F7A4DCB8C0CE6985F424926CC2AAA817D4FAD10DB5CCEA0450C8E0B6DF950919F4FAD45CE335720D4EFAD22096D7B3C481B76C494819F5C74A60587D32ED3CC78E0216DE30D2B160C149F5C74E9D0FA52D95BC6FE6BC96D75712F1B5E262A8B9EEDF293FCAAA2EAB7512B24334918901126D6C6F071C1F51C77ADBF0BEAA6698E9F7F315B292412BEC0AAC0818C86C761DB38A995D2B858D7BEB88EEED61B54B891CC18DAD2001C023A1F988C739EB581369379F6BFDDCB04FBB852483FFA100335B772C2DAE2E0DB4B1C8230DB1C024489D88C0233CF5E9EF59B2DC360CC305FF8B71DA31DFDAB9AED3D02F724F30CD2FDA7ECF14076031AC4DE4A205CF7279F5CE7391542F23DED0BA48CFB933B1B2420E4F5CFA9269D791DE4F34D7328D80292A71855527803FC0553B4F3164F251D591DC7DEE149CF7F6ADB97ADC343474C1A6C3E6CD7D34E76E045044B832939EAFF00C23D71CD5FB89049691CCD6D15A92BBE20A241BC038EACC4724F5C73834C6D2D2E30F737B6B182B9472BE521C100ED181919F41938A94D91B45FB42DE89A28597F7AA0C61B69040562411C7702B1E68B7BEA167626D288D3375C79B2595C981BF78D0640E48C7CDEBD377E1DB3445A535CC52CB00BDBAB85C1D9E431E324B167E838CFBD5859F51BAD222BA99E59E208C14DCB1D8589EAACCC33B7B03C6475A86EA5BF1A8992E269079AACCD2A90C25E3048C1F7EFEA7D6B1BB60BB94F4A9D57579140B98A6619B78AD8E031C1CE589E070BCFA679ADB925B4B0B3B888169AF240CD712EE72849CF0838F9464F5EBC9EF5CCCD2CC2749E26F29930818630147F4A9F4E17BABDD984CE142E257631960067A92A33D7DC0F714EB45BF7AF643772FCC12FA65533A5B6D41890F011578C0181B4FBE71599AAC5248E2E4AB0790EFCB7F16723AF7FAD7496BA759DE5EA43757F756B6CCAF89254842C8DDB8525957DCE7D2B15AD2E65864256497ECCDE5C9279CA501EA30B9C8E3DBD8F4A5464EFCD7D070D19CD3A10FB9C75A59A068E4604E78C8C0EB5726894B057CE37019C741DF8A86EA331CA19475ED5E8EE8D5E8CD2F0D406E23B986DAFE3B1BCC878DCC3B8B819CAEEEA33C71D0F7ADFD717ED76C96E63D3E0BB57FF008F92628CCA4A804951C8C1CF0339CD73FE15D4A2B1D5A68A4518BB8BCB5241215F3C1C0FC6BAD9E58ED8BC8AAD240C99C0F95464E0F1D7D5474E7AD79988A938D5B246724645D792DA7C76EB746E27B346622426485F1C161D390001C83F9715CD44CF74163DC10609E4703D6BA99E0B37D3B50BC573711AC45612E046F01276AAF07E618393C76AE3DE4D803A12B91EB5D5874D21D3EA2CD0BC3204C82E46E5C7A1A86DA2DD76CE7958F9CE382698F23BB139258F19CE4D5CB64F2623CF5EB8AE96EC5AD75275C301B4222B752CDD31DFFF00AD5592313DC08A393629380EE0E07B9001344BF2A8CAE33E9DEAF5AC325AD9C6648DD16F94B8760065549002F3CE79F4FD29306DD89A66B79ED8B3325B451040550962CFB7A2A96E493C92781FA1A2751959577451B18C05425400140EFEFF00E4E6ACC974CD666C6239508B2BED18DE40FD719E87D3359134A788F18E73802A37D0CBA130BA95A404BE0B753D33FD2919E491BCB46DC0F2173C67E95359410DC3E2E99D2245DCEE8546D191EBD4FA0F5A96E1EC45B5BCB69B23DA49D832CED963C393C6000A381C92695C7A6C6B69B7D61A4E992FFC4DEEA6330DA6DA0578F68EA4124E30582E71D81F6ACBD5AF63D42EE4BACC71EE0A0476F1158B8007009C8FCA91E2B492D279EE4DC2DCBBFEE11502C6579C924F27078C0FCE9977A8413584503595B41344142DC42A54B800F0CA0ED24E7EF633C53E676E5175204BE65B48A12AADE4CC641B80218F18C8239E9FAD68DEE993CBA28D7AE6E63325D4CC5A3180483CEE18E3AF054608E38C562AF2E777CA49E98ADCD06D64BDB816EC924B0210EC8BB896F45001EFC67D855F91BD0A32AD51423BB278340FB1D8DACD7931F324FDEFD9F1F753F84B7D4F207A7D6A7DF697C86379D925594298D5589208E1B81818E9C9CF3D2A6D52490EA0609A5459D8EE999DB010FA679E83B7E159926A56AA021B5798055DA1E4528CC3EE964518E327AE5BDC534AF73D8C7E22185A7F54C33FF135D5F6F4369FC3E34DD2CEB56D711CFE54CF1C71DC89123950F092AF00641F9B19E78354B5D44BED32C1E648ED04627FDDC4EC54B6F5EEE49EE6AE6B5AA417DA18DAF346CB70AC207BE32C65718531A76C018273E9C9ACABB90EA3E1E92542AD3584ECF2A03C98A5DA3701E819707FDE159D551528B5D0F3694AF07739AB98E3495821254742696D6499265685991C7465E08A639C9ABFA646A6377C6581C5692D8CE9ABCF42D5F5DC862B5804AE8C63049538DFC9CE7D79A8EDB529B47BD86E6D4ED78CE72403D88E878E84D55D5598C918CFDC5C0AAEB3198AAB8DC5781EF428E972EB54D5C4EA92FF0046D4EE16E25B1BABCBB958B4E6E2F36293EA4E3924E78038E39ACA97CAB8D41E416A96D02F0234240FCC927F1A21B49D226D9188CB2EE2A003211F8F41FAD49A75CDA421A4B957322B8D8B91B76E0E724F7E9DAA1AE577385B33E431A48E19A427A0079DBEC6AB9248E7A54D71B647926122FEF5D884EEA3DFB557841248CFD2AAC03482C76AFE3520504F622A4F2CAC5B57A9EA6A367112E0004FB8A1BEC03F660E09C8A618D1588DC47EB4D2C58839ED4BD1A9074276426DC100153D7DB155DDD727E5C7B55A59B24FDD5CAE32471504FB0C498FBFCE6A91A6E8AC4E49A7C6DB5FEF15CF714C3C9356ACEEAE115A054F3A23CB4653701EE3D0FB8AA7B08D2D32759CB2CAD908A047F36DFA76E6AD2E511D2E23521883BB78C9C76E0631F519AA70A472012C991B6455EDFD6AF9858B13C38FEE1AE49BD4122B5A413EA17BF6389C979C88D031E09EF9F6039ABD72BA759DE790976A0E081224394078C9EB9C76CFD4F715169FA479EB75A83DE35AC36C446A63525A476182A39E383D7D29752D3AD3EC5FDA30CCB22C7859617C2B2E4F1D0F34E55173D93F2DBA99D8AF7FA84A26B78EE0C52C5020553080372E793F53F4EC38AD8D36F6D1AE2592CAD7ED1BDC98A07E4C61989202F4FBBB471DF3ED5C934C1C84C00077F4ABBA54135D4D71E53C42444DC0BBED3F51DF81CF14E54D285B6046B4DA9C02F4B9B1668E27DAAA7E558CF195E41C73927F1A7A5D47E64E228BE57258328DABCF6E9961D3193F85346B56B125BA8B668238D5D5870C5C328040C820123386C704FB62B3DF576F3658A332085CB6178631AE781923AE3038C563C8EDEEA1A00EB2BC824C890A855503031FE47EB507D8AE0DAB4E1498F392392703BE3D3B66B42F56136D1DF5BCA1B7B00D85542AA3033B4753C8FD6BA4F095EDBCF6CFA6182097679921677081E362BCE7A920F007BF3C54D4AB28D2E78ABD8D21173D0CB11C96F0433CE2CEE964819B6B111B5AE390A777CC73D718E7B1A7D81B320CD25BC523CC1A3671112D02E387DA0617AF7E78CF535734EBB81ADAE6DAF652B717F2C7188A5B60769E8D26EC7450474E7AFD43359B18B4BD6DACAF6E27D41DB661E03B7CD248E0A8CEEC8C8E0E72793DAB3E6D797663E476BA3035183C9B8B88D8E5A37EA782DD7B7E1545BCC623D4F42DE86BAC9FC2FAC6993092EEC6378D206B864E240A8A33F376C8240C1C8E3B8158DAE693F64B686FACDE492D27611E668C46D1CA724A63383EB91C608AEBA75A138271927F32E69AB6873EC76C99E372B64115D459DCBDE08AE25B7DD003858947DF007393D871DBD79EBCF397B1C49394873B57827D6A7D2BCE2D3476D12492103EF3E085E7200C8CFBFD2AAAC14A373297736F5294C71DCC42D45B6C5FDE040D8719CE79E02E73802B9A11BCA9BF8DB1F079EA4D5DB9984B6AC891B24A08DC41F948E9DF07A91C7355CF188C7001CFE94E9AE588E28640841DC475A9F2D80A148CFA77A8A3665C9EE0F15624990283B769C02369EF576D4D7A100C3B88F24A93E9CFF8D6C6A327F68833247E5CB02029167E548C7031C73D3DEB3B4F82596F10A5AA4E18E00965112927A7CC48EFDAB6F508ED2D6631149D2E11BF7F0B49F7241D18373F2FB1C7B56727EF233918688A92A4FB4B447E5553F7A438E78EC3FF00D5CD497B7F2C72BB2D9080C91619957692A70474E3B0E98A9A5B294E9DBCC770F3F98E1137ED00638F9700F7E3D874AAF6FA4EA57B2C716E7458C7DED8495E01230B927F9569EEB77205D13CF377029D3FED2B74C638D9CE3071CE3271DF2735ABAA7872C92E123D22F198724BCCBC3F5E84718C76C56E6969A8D969E626B7B79127610C570F16D95C2E7B1271DF240E4F726A96B76E2D2770D1CCF22A65E52F9C038C8E718E78E3D0FA570D4AEFDA72C4A6F430F534996DE30E176C431CB1247E7D3D71EF54DB4C31A8B89276E465550027AFD7F1CD5F82F5A6824B7640C0038DE031C7D181CE3DB06B2CBC96EAC2459903767CA83EE7D7E95D14EEC8B89710791210AFE6B0E5A4078FFEBD75763E218BC2FA04FA75A203A94CEAD25E232FCA0A825077383C7D735C612CCD9C9E7BD05994E031C56F63A70F5DD16DA5A9624FB44D199DDC1439272793CD5650F31C0E47607B53E60AB185F3C920676F6A96CA192EB7A421018D0B92475C76FAD3D95CC64DC9F3324F2CC4BB269D0AB263E421C8F41C67F2CD7B047E0C7BAB1B1B9B7F0EDB59CC2DE3F389FDDF9A8CA37A3A2F073CF2704706B95F869A0DAEAFAB9D735B9A08AD2C5808D242A825940E38E385E0FD71EF5EB973E35F0FDA48239B50452CC42E0120F4E73E9CD6918DE366AF735853ABBC53FB99E33A8FC32BD8A496680F9311725229A1755419E143F39C74CE2B025B1974977B7B88CC722F27B861EA0F715EF9378EF4228CBE679CBFC4170DC7B819FD6BCFBC58DA06B71B43697891CCEC7C82D1BA819FE124AE07A75C553A71947B7CCE9850C4C7DF7076F43CBB5070ED9154D0ED60475AB975A7DFC12B45359CE8EADB48319EB54CAB23619483E845671DAC73D44DBBD8D882E3CD852049846F2B0124AC0E1067DB27F2A89EC65C4ECB2452476E47560A5F270303A93DF1D6A8A3B01C1EBE956E385E293CA9061B218E1871E878A86ACCE66AC54956457DB20DA7A9CD5BB645F2432AF5E067A93EBF4A62DB3DCCC5989503A9AB0E442BB410A31C64D0DE822BCE36AE413F355562CA48CE41E714E9EE9A4C2F185E869563395791C007BD16E51A1C559242198370318A71524719E2A5902055DAA57D1986D1FAD0629193E52A7FDD6CFF002A9B8848919933E5F4E49351965676DDD0D4F1CC32A26DEE8872543633FE1515CC9F6898BA44B183C0404F03EA6A914BC8A87835BBE1F5015A48E3064190D8272C3FBBC1E87BD63C71EF902E09F61DEBA2D3A28E1B09A38BCC27707740C08E98031EBFE7B545697BB61DB52613CF685E282D8C0EE0A3A950DB811CFAFE7D684867923DCE235E39CEE181F5C75A96C2C5E1024689C44090ACC0E33DFB7F3C525EBED7C29E07622B91956219228A18E647D4A2682226610C11BB6E7C6DC6E200C90073C8C566DEAB5C4CDE521116E251B6FCA33CF5AB8DA606B87DD2EE18F98C7C81C74FC2A8DC9B9F35B4FB7DE2DF76F488B038F727F1FD6BA934B631D06DAE9827959249820887CC02E4B73D07FF005EB4ECF4ED2D6690CA6F241B48222206DF463C74E1B81E9938A8ADB16F10819B71FBD26DC019F4CF7E82B42D75782C23963891E67947DD5000E460E5B93F963EA2B0954939596C2BD8593448E5B5DCFA811651E4DB010A9794900E08078C6064FBD529746B686640929743CB487E50CA0900AFB1C3726AE416B7DADC6F9305B2A0C09A694471AA807A92492074C01EB9AB3E25911E58A4B59259AD5004F3563C46CC1704A1231E9C761818145E6DAD465AB2D5B4AB1BF8B51B6D12281845F67DF9DFE59231BCE71F3639C81EDC57A4784FC1F6DE1B4796DD3CD925746124AEAE4C7B380081C10493C75FA5711E16D1742D7AC2FCDDDADEF19114B21D91C2AAA30BBB2033E5F2777502BB3D16CFFB116D2757B5B7825880911C959A56009CF2790071803D781DA25467ECA4E17BFF005DFB1D70BC96B63AA8AC6D8CA6E4D9C22660433F96031FC7AD646A3A35849A8A5D4A88D25ABACB131C6E40158633D71924FD6ABCBAFDE4F26E8C79719E5791C8ED5CC78CFC477163A63CF1890DC9010C86321406E3F4E7FC2BE7EB55755AC3D14F9B6BBB76B33D0A58697C527A1AF378A6D99DACF28FC00C5B90477CD3753D5AC4432EA92431CE2CE1668D9871D32719E993819EBD2BC30EB17493EF590FD3D6BB14B9BAF10F85D2DB4D8D9DE2D865851F2CFF0036304719C70DFF00EAAD1E4BEC65069E97D7FAF3D8EBE7C3548CBD9A775F89C75C60BB9EE493526993A58EAF0C970AAD16E1BC30C8C1EF8EF8F4AB7ADE9171A35F9B4BD6884DB43108D900119F41CD65CB9721739C7AD7D4A5A599E14D3BD99BBA85DC3756A5A18712BCBBE490DC6E62A0600D8385193EB9FC2B2E4816148C004B38CB1FC6AED85C954F9E101B610CEA086704719F6FA55620A1D9BC85393EB8CD3B6828A690D488BA3103A0CF5AAEFC0258F41D2AC99B08BB40465C82467E6AAE46F9003DCF61923F0A0A6767A7D9DBE9DE1F3BA3B4B89D193CE1F6A6EBC9DA1475247523A63AF5A8DF589920DB0C8D0419D8D6C9BDB31FF103FC2463A67FFAF59968264B095A3D66368A3C6C121208EF8E01C1E0F19A905CDCE96B23CAAD74903ED605CBC31BB0E0065C67AE719C64739E95C51A7EFDEFA989ADF61B7BCD2EDAE24BF936C7213696F24785D85B214648CB7738C8E7D39A58A3BA43710CDE7C31FCCEE64DAA58F181C7271CE3A8E462A0BB94CEAB6AF7F032444B2C9006944F201F2A85239CEEC0C6075352DB477ACB1DD5CC123452315C4F0B0462A0E060919DC54FD00E9DAA67CCA37605A846FB6F28DC467682A3C92580CF0392725B827008033D735447878C778F35CA89A18E26FB3C61C3C93484617247A923FA6719ADA7B89228C98AC6D618FE432136FB5803F336D270573C607A1AA71DFC1385B196D105A99CCF34E9C3927F87193B8606073C6726B28CADD0764523A3DABFF6759DEDE3DA35B2B34DE58459096E5718620FA6EE7835CDB5DCB6DA8C8D75A609C40C55A2B98C82A7D580C00D8F6AE9375B699B6EEC1E5378B9096D0C231839C6E3D06307A96F63C553BED66196592296F4CB0DFC8B35C1641184718CA12A19880719EC6B7A3CC9DD6A84616A8D6977736EBA6EE8E364F9A27000898B7F7BB8E8727A551B988C170F079892F9671BE36DCADF43DC56B6A5A6D9FF0064ADE59BB3192728ADF3244CAA392378049C9C75FC055EF0AF8327D6565BEBA3F67D3EDD774B29EA4019207AF15DB0D7637A14255A565F7F62A691E1BBEF10B466310D9DA6ED82E273B5377A0EEC7D857A2787FC03A4C11CD0DD06BA98AB2A34FF00BAC0240DCAA718249E09CD59D0B5AB7F3520B0B475B7B587708CC596663855185CED51CB7B923DEB1F5D9755BCDF77A95B8B51237C91B3856F978036939201CF38EA688C652F43DFA195A553D94B47A6AF7BF92369B42F0AE968E25B4BA1242A5238D497F3F83D060E31EA00E6A3B36B0B512C371A7DA49079F1A35C46EAC8AA7186F99324019CB12338AE46D352FB1DE433460F991E5339180A474031C1CF7CF4A6DC6AB2C566D65188D229A6323208D481918EA79E9C7D2A22D4534F53D6FA85649A949B57DEFF0091DE69EDA45EC172AF662482D5DD4471A6DF3BBAB6DC92BD3B63390718ABF6B61E16B2D3CEA9631112349F670F14D233AB1E08073C1E7AFA57978BB9248D22924668E21B514F451DEB4ADBED91412DAC6D0AACDF3619D4B2B20278C72A7008FF000A5049AD591532D94617956B5DED73AFBF1653EAA44D15B3C8913493CB3339963039520061BC607E045734DE18D43539AE1EDEFEDFCA691C4224277CE07276AE0B63F1FCEB3EE9EEF79D45143ACAAC5DE16DE06570E09E79C124FD6AD695E2084694D04971F65BB84BA433F93E60689F86423D78E0E0FA5635BDD5EE6E4FD515187EE5A6DDBA5EDFD7E5D0E7351F0E8B59963B9458B7B9559633C641C1FA63B8201ACE9ADA4D32EDEDCAC4C55F69380FBBB7071FCABBFD5ED9DB4E48A09FED903C272C6340CED81B1C1C924F00750D80782057216D19B8BA101214C83692C7017B924F6C6339ED453ACDAD7A1C589C2D2C4D272B2525D5697F5464DC5C8B71E5E417C708A72ABF53DCD66CD23336E66C93D69F711BC333236739EBEB4D86179A50A83731ED5D692DCF95945C5B4C6C51873B9C1DA2A4B793E72B1C71824F0EDFC229D76E17F74A41E392071F8540C7705C0E831C53B37B88B26E225940DA261FC4EDD4FD3D2992CB086CC0A41EF9ED51AB948D941E1BA8A685C8C81494751162D36C92AA48DB431C16F4CD4D710F94002083D39F51D6A82B32B65490456A3309A159422E720B1EBFA7D69BB234815A0F384C16DD19E57F9542AE4FE02BA3F2A58ADA249D443B3202F009F6240C9FD7EB52E9BAAC5E1BF0ACB7D6288755BF9DE112B206FB344A0676E7B92454D246D77322991D9D22F9E477E7A64924F735CF542DA8CBB99710EC923768C654A92481E87BFE62B2AE26F308453824F3497D7CEDB0070C546DE9CAE3D3D3F4AA60328DE0F26A230D98366D26A92DA5BB3AA21938C314048CF4C64F1D0F402A835DE4991F0666FE23D6A95E5C335D49232EC1C0501481B40F9703DC73F8D355E11990CBB9801F2E3144A9F466162C1987DCE80F7AB4B0AA47B891D338CE3F5AA32CB119088B731C0D873807D722B42DEEAD960E1A50EBC6D1D7FC2B39C5D9590246AE9935ADCC02C23785659CE5CB4839C1FBA4F4C019627A63DEABDD6A6970CB22BC4446596341F36F62719C1FBAA07424649145FDC1BE58E59616B4B60ADB19614CC9B40DD90A3D4E38C0EDD454D71A2DB69CCB66CC971F6A8E320C71856059C8186E703E51F89A94A1195BAB2E11E6691B3E189A55F2ECA08EFB53B9B85DD25A3158E151B0A976705B2006C7F0F4CFA0AB65B59748E2F221BDD42585D12146CBC2012B96EF8C670013C91CF1CE7689A6DF6A37974DA65F2DBC96C37BA39C33AE738DA3EF01C67F91C8A64FA9E9AD34F7315CDEC57859C7996B1224728200C853CA8E3EEF53EA2BB539287647D2CF094E8CBD943DEB257FF83FF00D74F115E69598A48ADA468CEC0AB231C638C827271F53F4C8AA5AAB47E2A0AB7B74D6E88A484494125B8C707B75FD2B0276B6BAB8526E5EDC9EA4A9914FFDF3FE1F8D10C687CD5B53713B642A11855E9D4E79EBDB8FAD79F2C0A95475611B4BBA3D750C1FB3F6697CCCDF12F862DF454864B7D4D2E84A326268CA48BD79EE08E3AE7F0AD8F055CE9D6EB140B34505CE4CB3CD773F9287A0555383D3AF4FE5516BBA3DDCE6DA3B32F7730495A42000BB540391EDC1033C9C702B9A4B808BB486522B58C655A872CA577DCF0614E9D3AAE51763D53C59E31B392C7ECD1E9967A9C261685AEDD83E1C8382AC46580233F85794F05C81D3A55D8EFDE6B17B779552289BCD58DBF898F191C75C7AF155A2F2C3032024107EEF738E3F5C575D2A71A70518A3831318A9FBAEE5E86DE481D43103E40DC107AE08A8AE9CBCCD23000B1E807E94EB77D9180C59B773CD5795886C918F6AA317B0D6254820F1D453AD6DE6B9924302B13146D2390DB70A3AF3F881F8D46CCA075E956B4CB47BA91F644F230C08C29C65CF4191CE4F6C7F4A4F425EC685B5B6A7AAE9106D1B6D6394931C51E021C0F99B240CF6F5C54B79ABDE8796D9E1863B590A9FB3247B51703682173C1C77EBEF533E9B7B0EF0FE45B951F7257C330003119E4B1393EBF5AAE8E596556890B0524BF95E6145C0C9008C823279AE7F8A577B19234A0D5E18AE525D5AD5DE540BE53C670D12F1B58E31F38C8E7AF41ED57CEB124D24B74B1335BC6C024F240017380003C119EA70719F7ED831BB4D1BD95A8002BAC9FBE9BCB4247037063EE7BFE1572CA716B6C9F6AB2F3EDC31F32558CB21C8E48738C7A6E00819CE4F4ACE508D9B431249EE6EAEAF1D6D99AE95599E4F2CC68A5880386C000FBF240C556BD6BC4F326B2B52D0C2060F5C7739E49C75FD2B46E35B8B74E5489DE78BCD91925691F6745566C0DB81C76ED8EB5917F78B7F022CF05A405411F6844C961D42F1D4FBF5E7BD282937AA15C95E5FED48D6CADFED3346A598B3E4171C15CFDEC1CEE1C7B562ADBABCD23B2DB41E5360A4DB89620F4FFF005815B7E1E99AC5E6BE82F66B392141E5CA232E267CFDD2A474FEB5A5E447AE416F0C56D3C172F3876909DB0999C72E460E092A7E5240C038EB5B2938E838A6DA48A9E18B79F57D7602B14AF6EB841192081D0EDC8C055EE70071C77AEF3C6772BA7F84D6DAD7CBCDCDDFD9F6A11F36D24B671C02580047BE2AE68B6363A1E9B18796085A768E2DF1AEC241620918EEDB4E3BE0726B90D7759C269CEB867FB75DCDE5AA862858E138C8C73FE3CD6F17A25DCFA0A14FD9C6F15F0EAFCDEBF9682DDDF4DE1EB7860B57323CB32C935C862B1CB20C10A801F9914367D093F8562DF6AD757F2092E677918038DC7A0CE702AAEA9A84B7D2D909679667B7B65898C98E186490307A72067BE2A9993927B5555A967C91D8F5F00DC61ED6A6B37D493CE3E70607BD3EEA5324CA40E82A96FF009AA676E73ED5CCCEC8D6728B5E64E642091D38A962D467B49A0B8B79191E07120C1E091EB547792D4D2DC914968152AA945C5EC6C1BB59679D6DDE28562769ADA4970AE14F2533DC7278F6ACC5909DE7A1DC7A0C0FCAA0DD94C775E9421C64633920839AA7B1C11FDDD4524F4DBEF2E5BDC3C28CC980C0E41C03F983C1FF00EBD58BEBA5B9D416EE10EACEA19D1860020004039391C7B551CE23353C6328AC3AE718ACD453773BBD9C6A6FD886EA186EAD550C8AAC876A8284119EE4F4207E7589243F62B9786700B27752181FA11C1AE86289A4B9040190738238354358B24F33742A42B0CAE7AAFAAD6F0972E8F63C2CC32B6E1ED61B98B348657DC7A76A9ED962F5C93CFD2AB30C71D08A55253A1E4D741F32D5B41D36DF34EDA744C3047E950F7A728078E68621DF3484E0AAFE35734DB831C8232327395CF43EA2AAAC2F8E460548B1796E18B0A9609D9976528CC630EC610CCCA08EFF004FC00ADC10DD4D1FCE5A2591416E31BBDBE99AAFE19B19354D53684558A38CCB3C87A44AABF7BF3C0FC6AFEA3751AEB12C093116F1388833F723863EDCE7F0AE7AB766ACC7BA856390AA28CE32C49FBA2A0B38DAF5DA35E841CFB0C5477D762E036D42B9396F9893C7AD6CE8366D17872EEFCCC10C81D163C732003AE7D8D54636466CCCD5EE2DC5D85459E519DF32DCC8081291838087000C6073DBF0AAFA85EDB5CDC432D8D8C765E5C6A19118B2B30FE2E7D6A3BBD3E5B18E233CB0E5C9062590164C63EF01D3AD4A459C72ACD341211202C625F913907681DF00E3BF3576EA66471DDF9B6E639A30DB594F9FD194018DBE9F8F5E2AE58C165753E27BC36C8A725A46C2B8CF203004E7F0C55D8EF20B548ACDECBFB3A4898334DE42BB9CF279209E99C7E15AFE4C5AFDA6629E132872044A41DDE9BE56C1C7193D00F6ACA75125AE804767A4FD9E213E9F3FDB619832B14678E145041DA4B265F27B0F4E4527941C930EA055E493C84B7B64654C0072C490391D00C6E3CE3155350D6228563B210A1F26311EF0C18A9FFA6648E0743D8D125C3C76D1AD95B8951584C8A2E3CC191824BA0EB827BF1D6B2A49C6A294F535A52519A934757756D6F3A335B34B62D0B936D244E09900C03B8A9E9807241EB9F4AC89B4A79A6D263B39C25C4AAACC224DC15F962E37639DA33CF522A7BEBBD4752B682FD208218E5766DBB3A9C292D9EBDFF018E2AA5ECEB70C45D40DBCE599D0F1839E077F6AE6A92AEE6E5D1BF2D0FA08D78B774F4665DD4D671E9423B5DF2B9998C970C76971D00C63A77FBC7A9A82D6F672155EE1C00DC6D3F7463D45593B66856DAD146D0C725D7E5E47D73D7F0AA72C6F18292325B8CED2E1B9247A1F4AF5B095D421ADC89D649DEE7450DEDC69F61733DD4E125236A188F9926EFBCBB87017803E99E79ACBB6F0CDADF3A4CB732340CA7002ED39F73CE39FAD63A20F37726250BDC9E0FE357F4FD62F6DDD6DC24722F44DD90147E1F5AC652B5EC8C3DD6B47AB2E69B6107862FA3BED42386F632FB11480D8E0E4EC6FBDDBE95872B5AC778DE439960573B1597191EFFCBFC2AEEB5A9497C2152A046ACDE5EC0704F01B04F51F877ACA3198EE093C1C03F9D5439AD796E71D5A97F77B16FCE79A6DF7126EC03B72DC83DBA74AACD206E73B8E7934EE1994E3B1FA66AC4D36FB68A2DE4EDC8D9D8727047E15665629B0DC80F5C56FE92B141A7DB10B1334D2319589F99381B4F3D31CF3D393DAB9D0A7710188E79ADE326A37161E543612C9696C048ECB0B0040C7CCF83D001FCCD63593764889309AE94CEEF396651846FDE02E7D429C7A63031E9CD3EC2DA778E466522612365634DE4F6EBC81839FA7E350D86B30B30FB74314F0A333A4237069243D0B30CFB71C7E95A9E1EB4373690DBC30C971711B99250B284089D0FDEC60F5E49F4C74ACE6DC636336AE8920D3E08236BABFB78BE73B1622A24DC39DC436E03233D7231FA54C2ED04F134B6D6F23382EC1D5498C0E00C9524F6EE7BF23AD656DB2F210FD92E610ECCEB28218C8BE80671C7273D4E6AC6F68F6DBC7725E0BBDBE671F3B20E70339C7279C8ACDC6CD3158AF7D224573234B7692D9DDC80DC470A05638E7193BB1EC33408A34B09DE1B0B6CC00F12163E5B3740A7382C075CE7DEA4BF9ECFEDCEF68D730452A0CA47F349228C64972C7E627AE00FA566DE5F2145B676B99A245DA91161185E38383D793D303F5AD2CDDAC1663EEB52B3F22158B4F821BB8CFEF268247F2E652B8E509E1B27A823E95BFE17692E645B992249E6CF916F1A8DAF33B8209CF6555C9CD7270E973DD5CC5144A0313876C8C27AF7EDC9AEE3C3B35BDAEB02F605C41A6DBCAC8CDD5CED2A09F425987F2AB69743DCCAF0B2A9CD5ADA4569EA6E5CADBCDAFE9BA2DBCDBA38EF01909E88221B113F2463F57AE0B59B96B9B525B1B9AE1E538F56C7F87EB5A5677F25AEA51DE6EDF2AB162C7F889CE4FEB5857BF7D93B0A4E5D8FAA9E17D8D3717AAB5BE7BB2B83B59707B5293F27D4D37AE3E94ADF7454DCE4D9119EB5609E07D2A0EA6A53D05362A7D414E4D34FDEFAD2A535BEF5036FDD0E86911B0C57B8A7546DF2CEBFED0C5264B7CB66596E2215340C700838C1CD44E3E5C7B510B60807A52E87645F2CCD095B6AC7750F0739FA1A9EE2286EADB0384940209FF00966E3AFE1FE22B3FCC2A8D1E72A4E455BB295002927DC718CFA1ED569DDD8EE4E336D3D9EE7317B6243BB642B2F553D4FD2A8B2ED3C9E7D2BBD4D052FCBB4EFE404DC85BBEE033D3DB3CF4AE4358D3A7B0D4E4B79109C13B1F180EBEA2B4A75539725F547C3E6D82F6159CA3B328282CC028C93D2AEC76E6253BDD54F7E3A52848962E227240C162734D48F7213C228EA49C56B7BEC788F510BA0219012DEA691F32932B7C8BD39A469234FBA0C8DDD9BA7E550BB3372C4927D69858BF0A8780043907AE7D456ADF89A55F3A7E5D886760B819EDD3F3AC9D343893A13CE702B60C28CB3ABCD126CEAE492BD3A1201AC6A6E69776336388CEE638972F210AA3D4935BEF2436F3B69D0B6E821800DD8EAC4FF866B2606160EF3BF25633B3D988C03F8120FE150C721834E332F0CEEAA3DC0E4FF3FD697425EA3355D26E6D36CD2C657CDC929C929F53CFE1CF6A8EDB4AD4B527CD959CF3876C65578FCFA0AF42BE9DEE23FB25D4D2CD06DE04C892485B0493C28EA70304E0773591716D1CB1088831840CD88F2CC47AB01D718EC38A975B95DB720C893451A6DD18AFEEE2B758D412BB84D96C0E31D1BF0C81EA6B5EC92DDED732DDDD340FB91BC9B731EE5C67058F033FDD51D8D47A20B15D596D66166F2C986B79598B44F938E71C923AE383C557D6E5BADC26B89C5AAB165B7F2E02A93A6E20BE7F3E3B003F1538CAA08625B6E0F15A69725D08D32EF02E5500073D067F1CD52FB5468FF6868268E0618651F29200180A48C63A64107B77E96EF2E7589AF069B60ED31B600896D1882CA47538C00307D0633CD68685E10D435AD425B792D0C08A8AF234877123A6E18CE79EC38F718AA8AB2D4B8C1B763B9D534B934ED02CF4698248C902B09157E7476FBD83DC678C7B0AE4EF6CA789A14D9977FBA07B13FE04FD2BD2EE93CA3024CC659ECE050BE6633F2E796C679F6EF815CCDD471DDE990315FDE3AB9627AE09F97F438A96B53D28AB451C743185B990C4A3CB9173F4C06CD50BE54364524C0591F703D7B73FD3F3ADA36C636C5BB6E70A44B6C7A918C12A7BF6E2B2A65010ACA87CB53F7B1F74FBFA1A15D31BD8AAB0C5140B1A218C75381927F1FF0038AAB2C88EDB654C2487692A482BEE3D4FB55E501D6670DE608937961C9C53A388C022BA99638239F2166B888491819E5B6E093803B75AA32ABF06865DE5C2C92C661EB1B91924004F7381C0CD04C52DCDC499F3F720D9232EDC360678FD3E953EA1767569256C2148DB644F1DBAC2A532792ABC03D3D7AF538AA50C2E2DA46EAB1FDE04FAFF003ADA3B1CE90E9232914603878C6580046413C73F952105A40320EE3B781D7B549364AEF2A771E78EDEF485D4C191FEB03671DCFBFB01C52450CB1485B53B78E5DE21328F336A6F2467A01919CF4EA3AD6EDFDBE8B15849E4C222B9970449193870CDC2856E54E319EBDFAD61D910B7C85D0328CE46EC0390475ABD6A2D2292D3ED8B33C0AECB208DF683F292307EB8E45673D5A4652DCE920D4ED3EC915B1B5DCD045E5AAB81BE4009DA0B0030AB9CFCC71C03E958D3DC5D45656D6F1121A0519F9D4EE382010BCE792DCFD7A541631A5ACE647B95C4003664856424F700138F53823DB19A902598924572F17EED76A30C955C739C29C1FCBAE2B1492D3710E9658D2191629082ECBFBC994976214F036F4EA7B7E353C933E95E65ADB44C1AE51082143EE50A0AB0249DB9C9230075A7C16B31B8921BC84C69BF1279B1855877606E639F940EA3079C8C5588EDA6D28C71C090924340CD34780CBD771DEBC02474CE4138E943B0CCBBB72D660DE3C46448D6344C2108A0E4F0BD3BF503AD401A68ED7FD127758183094870377B719C823EBD79ADAFB6CBF6CF26EE2B791761CC00068901FE20002BB87183EC7F07456B6E61FB0D83F905E3FF00497126E47527EF3E7EE85C81B4679C7538AA53D2E28C5B6922B594109B596F6D6CD2D15EDC023CE3290A182B3648E0BB6063D01EC6B6A6B61A5783ECCBE637D4DDA5918F68D3EEAFE25B77E551585B7DBAD1A2506082FAFE1B4424FDD8D413FF00B329FAD3FE216A705D6A50DBD991F66B78156303A0079FE5B69ABEECFB6C2C7D8C61456CAEDFC97F9BFC0C28834A8F3964558C0CE580249EC0753F8567DF713B8ABB6762D2E9F35E13192641046AC79CE325BF018FFBEAAB6A9188EE58231750A30D8C6EE3AD458EEA9565528BBF729A72B9F6A1B914D85BE4A5278A670A778A1A0E4D4C7EED42B5311F2D30A7B31A9D3348C79A551C1348DD690DEC851C8A8E4E258FFDEA90700D4C4AAC11A22296948DECCA091F43DA85B8A49CA3A797E63DD4614E7A8E6A00706A72415F706A070412691D553BA2E436CD2C62579638519B621933F3B7A00013F8F4F7AD6B7D1C4087FB45BCA6C6E31232B305C81938248C938000249CF4C6692C04C8B0C5652CA669102C00C476C8C3E62AA03649DEF8C9C01B49EBD34F4E921B1D6ECE2410C364DA924722464933322E3716C92543FE04927E9DD2A54E9D3F68D5DA4785F5FC4CE6E31764FCB5EA6E5BA1B6B46B48E011DC80626443C79D3E308C49C9D91A8279359FAE68B67ADBDD416B84F2E673665D4856DA144BCF6048E38C6475E6AFE970B4F7F69761B7ADB6A372F7724AE32188600819C9C02063AF1D2A47B9D2123B878671E45B5B25BCF745FF007D226E39551C63763EF63A0E2BE766A6A4EAECFF00AE85B928CB91FBCDFCF5F33CB3508EF34F917CE49071B90B1C281D885E98F71C565B89EE32C373E4F53D2BD1FC4D66C2CB4FBABA428EE1E358581DD1C59DC8189EFC9E3D08AE2B50D1C88DA584B6E3C04FF0AF530F5F9E3768C31193B953F6D87DB5BAFF002EE660B29BCA790A2E13A8DEB9FCB3CFE14344234F995B77FBBC0A9ACA48A2702F0BFC99C2E3A1C7F8D5817A8FBE57936F3C201DABAB99DEC7CFCA325A344569B83A838058ED183D71571C3203E59DA4A8048FAD4164C93C8A5552320ED4F9B904F1D3F1AB8E88A26561CC7BBA76259703F206B39BD4A8AD0A8E1EE20941C1654DC7D80233529B753616E8CEAB966249EC38E6A18A24790F9A3F7699761EA07356038960DCCF9768892B8C6D391FE34AEEC35AB34A0D7ADE08216BC8679650ED24850ED6EAC57AF18CB0E3BE2A85FEA7E75C490C3B96DCDD992D2E402AD0A93C81EA3DBB62A2FB540818BD979AD11FDEBDC39DA09EBF22E33D0F527A7E15A3ABDC5A8D49AD4402E204265403743BB2BB99BF1E7B73EB492B7431315A11F68B8916E96460CC164E85CF39383CFE357B4FB9BABB823D392DA6BF6794CA61690904F761DD7BE4E71EB5B3E1FD12C6F64B24BDB3DDF6E86436918F94950FCBBBE3230338E0E718AEF344D0B48D3D2582D2DB6DAC4732B4927CF70D9C8576FEEF1C8E9EDCD12A896874D0A0EA6BD0E717E1AEBFAB595BABDEDAD946ABB9E270FE5A8E99DDB76B7E67EA6BD0342F0EDAF837C36574F9229EED9007B80A3F7841E7DF1CF4CF18AC582F97C41E2A9649977A451AE229391C64E00EDDBD6BB1BCF2644B7B06B65533B6CE318D98CB74E99031F8D09A6AC8E874BD9B574625CABDDA348BB126BCDA1460E4A76C919FAFE3EF5897BA6CAB6D2AC09F6858DCC7BE1607CB61C608CE4FFF005EBAB86D7CC81C5B5FF9335E484ACCB1E0C6B8E14678E981DAB6AD74CB3B28F6416F1264E5885E58FA93D49CF3934429C9A2A756317B1E27A8594D3FCA6DAE44CBFC71A953F81EF55D20D5DA4FB3CD78D1C8C30897D029671ECE475F6CD7BA4ED66E9B2454719E98EF587E4E9DACADC20D3A21005DA19D41C499C018E9E86AB92DD44AA5F568F309BC19E244843BD8C8B03293B50A3027AF4524E6B99BC86E61888BC41E76F2AAEE3950A3000CF45008E077CE7A57A7DED86BF059DBCA97D6F77672E3CB2201B90FF7719238F41C70735CEEBF636FA8444EDFB3DC7237AE70703B8E9CF238A15FAA14E9F3E9177671566EE5678CBA08D76615863AB8C85F4E714D9D37CF3448001E6B0049C7735B1A5595BCAEF34D72B14B1B82372E771EA4E474F980AE7AE5AE119573C72A3A77624FE3CD5C1A6875B0B5B0E973AD18067DD824E0F1EBDB344C0A8DC4633DB39C548C8F12AEF3938CF4E29B704490C7B890546DC63A724FF534EC73BD8860DBF6B4C96E4E06CEB9ED8AD5BA92396D74DB850D0CE14ADC97DDB5CF21483D7E604E71E87A76AFA0E96FAB6A0F6D1BC48EB0B48AD267008C742381F53C0193D715BB6A9B63B1D36FAE2C6F248EF603E4DBB8725061002DD38E4E39FBD59CE493B1948C9963291892D8BAC2C843951B467FBA33CD6BDD4B3D8E9767BAFEDAE24F2E36582D9513CB43860B215EA7E51C7271F5A66A1641E736F69018AD6652C911668829ECEC5B9CF1C8F6159D1E9F1258DA22B82EA6469A44656461850307231D81CE393F8564A5162B97B55952EA25B9B3188A48F332AC4A9E5B67A3900066E0761EC38E20B4680B6DF2C33600044E77918EE41E3B70318FC289019ECE10109818E422B32B601C7B8FF817A77A6DD2C7193BE249A45C60B49BB8C638C1C11DB8E294BB09B35DED6E2048643A67D8A3B80648A2DE4165C75DC724018FE2F51ED4DB6B9DBA16A2821324AF3AC50DC60338C2316C1039E081C63EF567DBCDB7515BA92C56E54A2831CEE4891C2F1F375C038381CE3009AEA7C3A5234B18A65900B591A7C3360AB93C83D78E0645653718ABB76B9DD808DEB276BDB528DCA1B2369641544D0AAAAC48C78949CB120F7236F4C7A76AE7B589C4FA94CE0F1BB68C7A0E07E82B7ECE374D52FAE6705A4B405902A9025949014A851CE73C0F5FCAB959E396298C7323A3AFDE575208FC0D77D5774923EB6788A71A697F5A9D0E83143369012EA6F26D92E8CB33E46760550428EA58EE00567EB97F05E5D4D2D9DBFD9E1601553393803BFE438FFF005D212534581304162F2127DCEDFF00D92B3039642BE958176B453BEE9DBE6578070C3D0D48C30A6A380112483DEA46CFCDF4A4F73961F011C7C8A9F3C62A08BA0A9BBD0CAA4FDD114F045211D281DE863C52453D846FBA69D1DCCC96A06D2630D9271D0FD7E9487EED46B19784E0A8C0272C71EBD3D6998D4938EA996D0F5F434927CDD3F0F7A8EDDF318CF55E0D5B48624BAB517AE6082E08224C7F0F233F9823354B44D9188C44BDD517D2E4E86082F85BC0D0EA6888B27CC9220E3248EC7D73D8F15D4DBE8D6EF0DAEA17A20BDBA976182DA1012DD17A853B40C9C649C903DC9ACB8A3D3ADEDAE6DEDD150B480B99242CEEBCF1BBD39F6E9529BFFB3AEF048420EE1BB83C639F5AE6A98E9B8B8C16BA6E72386CE4EDBDFD37FEADB9B37BE22B8D4AD99235895D5305D3F76883F8B9E7AD73F15E1B39BED96D6C92CAACCB6F33C6AA157BB1EEE7E63D72076A82F1E4B778268E68A4132E2441265108EC780323D727EB51DDA7DA17E568DD8AEEDBE78E3F0CF27DBAFB54C70B2B36F56F72B0D87A95A4A524A305B2EADF9FF97996FF00B49AEA4DF711ADCC2A4075738DE4FDE6C8E878E0F6C0EDC51AAEB03CDB311888449279891AA6142FA32E76939CE78EC4671566D74E4B9D320B8B48A699B62196284677100A9E31C1DCBD7A61B3C5739AA5ADCDA5D01731F96C79DBB81C7A8383C1F507915D542A4634F9227AD5234AD0945D9ADD7FC0FD4E8EEEDB4DBDB58751B5B40161907DAA0C138C91821B1C29E47B1AA7AD4769AD48C5A186D9E53E64601FB87A326EE383F7803D3A77ADEF0341E6A19D0302A0C73C7BC32CB19E48D9807A74209C15E460D73BAD69D7161218A4465D8C4231180EA3F887A8E94DE9AA368FB0AD29D292BB5DFAA7ADBCEDD1EF628DC7846E34E314C2F2D9E40EA56D617F3657E7D13238193C9A7D869DA86A0B25CDAE9777750F98A5E5820691463248C81F4AE87C122ED75A8AF96193641148EB26D3B4903A67E9915EBF61AA4571A8C9696D0C62154321743D4E47381EB935BAA7CD1BB3E5332A34E856E5A6B4B7F5DCF02B2F04F8A354320B4D0EEB64807CF3A79231D782E456DE9FF0B3C452063A9FD934B85636532492890E3AE4053EDEA2BD27C49AFDC20822B294C49206DECBF7B823183DBBD71BAADC6A525BB369ED13DD9E8F7186FD5B8CFD78AD95156D4F336672D6C34ABCBA9AEEF548B968E3791B391BCF53CF0327DBE957A3D2E60F7971A8AC004EADB6DD53F7930CF019CE48273C9038F5E959D67A8D95D46F15868A6CE6F31669E669BF7718072081CE0F4C0C1EF57A796569ED6FF4CBDB9648F7B4B3C837E093B1720F041F9B8EFF00CBCAA9CD2D1BB77303A1D252D92EED63864874F45674F2A33F2B12BF2AB75F9579207524D58BE9709243196FB3A13B7231BCF7623F0E3D062B97BCD74895646D3E18E564DF13C71850983CB15071B89C1C9CF4E057470B8D4B4BB4BE1D27855D97A8DDDC7E60D4A8FBBB9E960AA6F129E8329835CCE3E77858AFB31231FA67F2AEA45FA437F04DF68D847CFB158E5C9538E9D7AD61E93A599BC430DDC932450C2AC2467EAC48E028EE7BFB559BA4B66D6249A39E248E27E2367C391D80F5F4AA5748EE9B4D9AF6DE27768DA386CE2604E0B13858F8009C7E1D29EBE3379818DE21160E3E4E47E75CED85B4D3C374EA552D51F12C848C96EA1477EF93DAA824DB27FF00649C55A94B6B98B842F7B1B7AB6BB211B6262AC693C2DAD62EEFA3B87F2D259151987F07CBC37E07BD625F1032E3F8464E3A8F7A8B4B2774D8EA5B27147334CBE54D34CF6392DEDDAC044FB561401B2A0050073F95715A8E8B716DAEB431DD5A8B4BF8D83C52F0C028CAB2678E09E40F5E9CD4DE1CB946596DA5276DC2188927819E2AB2DDCDAB786A5B7BBB78DEFED1B63C73C4240CCA791838E48071823B735D2A7CC9339634A506D5CE0B59D0A6D22F888E68AE2D6E25F9644971B738F95B20639CF3D2B0EEEDAD9EE1A3963950B9CC782084EBC37A1C8F5F5AEEAE2DADB59D0AEE1B6B48ED248C0314AE1B69E097006E6C9183C0270457146296DEEE7B4666B8B85FE040786E87703D08A73A2E134FA33D58E25E2308E83D64B631CB3CCED9763B7A834D9C463614DDF77E6DDEBED52BA9C92307BE477C926A227E460FF81AA3C169ADC2DAE24B667D9218D648CC6FFED29C123F1C556B89896CAB74E9834EB81FBBDBDF033F966A90E2B48E88CA474FA2EA5A8DF594B64659EE363ABEC32FDE524923D4FCC41C77AB6CB70D9B7BCF29A24F2D274794075033F29391F53D7185C9AA3A469D73656FF6A785A26954324ADF280A7A0CF18CF5EBD3157A2BBB8BD3B278CC0B0F3B0201BB3DC8EFFD6B82AFC4DAE846C5E706C277B875372D21C32190E4AB0C8C1EC30DC01F9D674D1ABFDA656BB7E07EF221186C0F4C9C7033EA2A412471951B0C84E3A8CEC1EBD71FCEB2E698C6D261895CE02E72587A93F9510F796A23534FB6B9D45EDADED64DD713CAA0E18E4FA2818C74EA78E7D715D3EB96F75A44F25E5CC12DA4572C914314B2077042E32C578E71D49C9AC5F07D8DC6B1AEC6C2631416686E2E64E9E5AAF4E7D49F7E99A778A756BBD735898CB3CB2DADAC9B10310385E338EEC719A73A1174DB91ED65F1BC1C95B4FE92F99AFA9DB473F87D62379F6752A1DC2B64BB6E05463DBE73F88AE466B4861BB86DA19A49A79CED09272DB8E36F4F5CFE95B9AADE48D62E3795DA146E1D463A63F9573ECD63179D3C36974B2109E4C9F69E639064962428CF3D3A6315CF8594E514E72D1743D4A94A764D23A3BFD0DE0F0E433BC9209CC48E21300DACA73F75C1EDC9C1033EF5C89DA8E36B0607D2BA4D526F3E5B56796648A35F26088B9395538209E4925874E00E0572D788D15C6C0BB0FDF2A3D0F3FCABD09C534A51562218B9C64E9D477B6DA5ADADADE7EA488BFBE63EB43F534D898798734E3CB9AE7B1DE9A71D08A1E82A53D6A28863152F534DEE453F8441F78D06803E63C76A788DC9E109FC291693631795A7C0D27D99D44B1A286CE0C7B987B83838FCC522C6E14E548FA8A92DD0986553C23100B6F0B83DB39EDD693D8C6AC5F2AB9484AF05C38724EE3924F7F7AD88E482FF004C3637724C161DCF67B026D591BAEF279DBC0E878E6B16FCAB491BA9EA8B9FA8183FCAADE9978F6B26636F980239E841EA2B5BD95D1C94A11AB3F673D8B6D0C7653086169946C01BCE40A7763B01DB38C55E76568CC2AC5A2CFCACCBB770F5C738ABB613C17AEB3AC290BA9F29A3DCCE02F5057792474C63359F790C715DE413116243B2C7B863D703BD704E6AA54E56ACCE8928AF76DB11C6E91EF590AAF40848248F7E0E7F4EF48DB02120EF24EE47C918F5E3F2AB66C52655DC4E578120E7FF00D7552EB68B831ADB8842AF4424EEFF006B9FE55D94710A5EEF6151C44E9CF92B6CDDA2D7EBD99AB673C773673D81803A8491E064CAC8B26CDDC11D412BD0E7A9AAFAB20B8DB22F96C3EF96400960DD199B0327819CF3F9D43039F36191678CB07564E4E4B29E17D467FA75AEA65D0F4E4B64FDFDE4CD380DF30084B64E14171B4E327BE4F18CD65383552F13D09FB38D4527B3FE989A3DA5D69C1ECDA065496289E49838C441C64654FE232307DEB4F5096C3C43A1476D70A61B9B14260E42B3C60004316002E7AF5238EA6B94D6750896E15975069CB46B096F2990951EAA3B703A67356AC2FCDA245791DE43A841037EF6D5B7831EEE3700C0751C671C67DEBA6328AD6C633F65524A71A8B9FA25A6BFD742CF81E1583C4B6EC446599641C6188F918F5FC0E41C7515E85A446B690DFDCA9385896343F5CFF88AE2F43D0CDAF8C21BD84ED84472BB420E5A06287E462320FDEF5FC8D76810C3E1F99BA7DA2E463E831FD54D76D29A9C343C3CD5C655F9A3D5230754CBBC63B2640F6AAB1C4AC4E466B2FC6BAA5DE991D84B6720466924DE194306002F041FAD57D23C616574245BBFF439231979002F19E71C60123F1CFD69BA894AC794ECCE0ADA3BBFED2FB7C913222BF9EEF2C6CC982DC138EC49C5742651FD8E126D48F91230645407739C91B57A85191D4FA0AA70D8482CE2798A18EEE3FDCC979760C6DDB850492C3238C715623BBB6D381B78B58B70E9BB9B64CC63D40DDD6BCAA8F9B7394AED7B24362D6C5A3645C91BE4CBBE7801707A7F8569F85BC48D0996DEFE4536AE7721551FB93D4FCA3A21CFA601FAD66CDA8BA5A2CC1DE6B90EDE5395188863058803A9CF5FEB835CF08F0AA58821BB03FA55C611B174E7284AE8F608F52923B5B592D64531DC960258F90782700E38E87F2AA5246F248EC63DF210704E72BEF5CFFC3ED6EE74CD5DB4CCBCD673A3960B96008538601BA7A74E6BAEBC7FB318A266FDEB293291FC24F45FCBF9D6728D8F5A954F691BD8867BA79A20082100C2A8C00A070071E98FAD65CD94C9F439ABF09440C5840D9380645DC47D2A9CEB92723AFB50B72C75C3936CB32FDE4E7EA2A2B0912D6FC283FBBB8E573D8E391FC88FC69D6AD85685FA63F4AA529FB2BEC93EEA9DD1B52652EC7469782CAE02231DC3E6DA3D2BBAB7B7B4BEB2FED6B7C38B8833205FE3603AFD7A8AF29B8BA175145209424B1F28EA7AD6FE83E2A7D3ECE7B4496106E32446ED8DAE472547BFA7FF005EAE9C92D24455849A4E2F5313C513DE5FE96BABD8DB08DADD58B4AD718F254E3EEA93C9278C81D7F4E62D75058F469A29AE6386608CECB8224958F424F43D7F2F4AEB1ADDA20BE5A0431AE0963B837B907803DAB95D6746B737D35C09D56273D231925B19C004FB7E55BC677D0D69569516E4BB18E9B963525D5B201032463D8D248CEA46142F3C1069EF1AA0C487271F3605295F3416E40624F3D7AD688F2E6F9A5728C81CC7B76756E08E49F6AE82CFC316ABA7ADC5E43746E9CB27932E208E371CE58B73B76F7E3A1158FB0CC56242A926786760A17DC93D2B7AE34F8E1962541637ADE596F322B8924F30AE725B3FEEB1E806077A53959184F429BDCC37576CB7123CCA08384DC50F007018E7B01F854F6B3C56D1B986D3E7C824C9863C7038231F862A4B49ED4DE3117111889F961B7830DCFA7CAA4FE5C550BF3099E6310F9626C2B1E09E71D07B5616BB69990FBDBC323331976BF5C00324FF004AC9906E60C65E3AB3303807FAD5A2F690102477924CE78E157FAB7E607D6BA6F0869FA4EBFE37B7D30902C4A97DCE30D71B064A81D81FE40F735A4159D92292B9DCF87F491E15F8751318D1EFB51DB3CE1C7DE079543DF0178FC4D70BF678E4BC9A4C33B3336C66EB824E58FBB67F006BD27C53A8C6636B8DC76DA6E91154E158F400FB579ED9B094B4AABC04DFF45C67FA572E2EB4DBF671EF63DDC3C23182E6E9AFCF65F716EC6C2DED629AE27996E42C2163864505A3772173CF04000E3BE41E38CD73376DE75C476C91811A3805D57E6C138EA7D076AD397559E080C5BA1945DBAC8AD9F9ADD94152857B81BB20F43F9819309C5CC6CC38F315CE7D01E33EB57470D3E77296C8E978971493DD97611630EA13CE5C178EE488239198700E55B20727B7359F109A7D42EC8080AC2C8F971F2AFDD381D4F6152DACB6A91C8F3093CFC828FB772A0C1C923D738C566C6D2AAC9B1D95A423E607B77FCEBA79BDCD8C717072AF2506DB76FCEFFF000F71B6EDFBC39ECBCD588919B2C0673496B02976247722B414055C62B9A52D743DFC261DCA09C99562B26EAC40AB31DAC4BD46EFAD3C1C0CE40A635D429D5C1FA52D59E842951A4B5FC4B914689F7540FA0ADEB7488787E79339719E9DB3C7F85728356851B688DDBF4AB91F8A0C763259ADA06493F88BF23F4ADE9B496A15F1341C528CB66B61974D93C9CD66CD1AB1C85A73EA46627F7607B66A2FB4966C0439F6AC9AD6E73E231346A75D0AD3C1B8640C63A55705800578357D9B2A1B0406E848C66ABA229946FE87BD6975DCF12AD38A7787E05AD3F536B6943371D8F1C7E3FF00D6AD693579954318AD6E54F4678C865F6C822B0BECCC4ECD873D72076AD7B5D0276B569A1B886E5426E115B12D20E9D5481DB278CF4ACE70A6F592D4E658C8C669555A772DE8F7BF6ABA9A19B622CBF324480E170074CFD4FE552DF974895A4065FB2C9E6471BB1298E37023D0803358F6D0CCBB6F111C471498DC5480483CAFD79E95AF7B708EAE4120F947703C60E2B8EA4146AC650F99B568A9539ABDD5AE9FE25495E617EBE54696EB72ABFBB61F2F4039E39E73CE3AE6B5D2E2EC40967359CCF1AE0007E645C74E4678FC38AC55114B664493EC641E62008496CE011EDD33576CDF508517CB9D2553FC13A13B47E041AE8A919CE3CB1B3F5FD0E7AB5A0B91DEEEC9DD5FAF7E869BC4F2623223D9E846714B04220B84B756758A690336D383BB695078EC0374E94BE63793E615C1EE318FCAA29E5D42CCF99F6092669F0F1C670ED0143C36D5C919CF424038E95E7E1A35BDA35D8D9BBDB4FEBB9D0F85F4E8A0D6321A779CC52EE91E4250F18E00E3A903F1AEC759FF0047B3B4B3EF1C7B9BEBD3FC6B98F8696AD757F79733F9EB2C71A24892AE3A92D9033C6703EB8ADDD6E7F3AFE439E07CA3F0AFA0C24251A6949EA791894955714B63CDFE224B8FECE4CF0AB339FF00C700FE46B8CB09760BD07A490823F020D74DF12E6DB756080F26173F86EFFEB57336205BC8F24A3E546E41EFB4648FCF02A6B2D59CADD99AD0DFD8DBDBC76BE4A2AEC267B864123CB9C0C648381D7A63AFB55936AAF0C770B691E97149222C7208333364F0C1781B78FF00F5D50BDDDA65E436F35AADBCB180EF83BC364E738F7F427B55B1A8EA1743CAB3927BA6527CB334786C63240FEE63DBB57172DFDE39EE51D522081F7CACCC19A3C171B8B29E4950381D7B9AC49DC821460003181CD7532CF0C73ADCEA7058EA0C2D4A47147B82447AAB36D0031049CE7D6A8EABA3596996D05B97B99B5094EF2EAA3CA29D800B939CF5CFB71CD6F1B2B20459F0299EDFC51034B0EE8983991D93242846381E9938FD2BB7BB7DF2B3B0DD2BB64228C939FF00F5D73BE158EEAC66BAFB54ED2E6DC08A32FBC03B8679F6C60FA671EB5D069714B2DC4974E859212246CFF11041551F52056537791EA6174A64B756C6DC9F3E1589DFA46465D474FC3F9D538DC67CB95493D8D685DCD6CF8558904E402F26F638FF00679E33EE00AAA6D54FCC58E7D6A7A9D0CA5751188EE5EA3953EBEA2AA34CB36D47E55CFCA71D0FA568DC074428F8653583764C7BB0A191B92A7A1F7FAD3DC10D90882F04571848761D84640639EBD79FA7E950B3433E446EAF8F43CFE5DA9B33FDA22113139E3639EE474CFF002FCAB0923BB8F51924B58DDCB3B7C8A092467A62AD2BA13972B46D4B24DF6716DBCF960E719EA7DEA935AC8C72A7241C804F04D5B1306678DC059633B5D73C834E8DF27A5545DB52A515356322E83C45D4EC2C14920374AA704ECA84807AF248E2BB28A5B7642975690DCC47EF248BD7E84720FB8AB1AB7C3E616FF6DD01DEEA328ACF692B0F390950485C001B008E3AFD6B752B9C3528B8EB7391D3EE2DE2D5EDAE2E155E28A50D2232EE0401E9DF9C715BFABB05B879EEEEDE5BA958C722B4CA81170091F2AE00C1C601073915CB15996EFCB8D1BCE57C6CD877061DB1D73ED5AADA4DD8D3FCD910C451C17040206E1C1257241E3A119E6A64B539265792F84D3022211C3B94111460703DBB9A90C2B20392C1509246DC3649FD4D409B62936A34F294EAB126D538EA7737FF00134F5D49D490B0282460195F79CFBE7E5F7E9472B22C471C53CAC563B593E5C83B06580F4E28B496EB4DBC86F23BC4B49E0937C655F7B03F45CFEB8AB977747528DDD5E47446E158E5867DBDC9E3D706B1C3B87DABB70DC067038A22C1687A9D9EA31F8CF4E9EDEC80FB44D195685BE5D8E067DFE5382473DBDAB13469A38F4FBAB2995229D83467CC6C143CF5F403A1FA56CFC29B482D7C3D7FAAC6A925E4D2188123FD5AA81919EDF789FC855CD46CACEE26335C585B4B21FE378813F9D3AD47DA24D68CF5E8D4F77DE3CFAE602F6F0DC7DA124476DA5B6955524F3C9EDEF4C9D8C81FCB75748C06768CE46EC6383DF27F9D770F656FE53225BC51A7F7563017F2E86B23FE11D5B8BA6045B46A11842B045B0B4841DA5874E0D2829C1B4D68CE99D68B8AB7D9398BB26DCA5BB49BA62C1408FF00E59F3CFF00C0B3C7E14C55E0B1CE49CF3D6AABC5B238A48914038048E5B7639CFEBD2A6BA558E084317F365F994646DD9EBF5CE6A256D12165F5AF2A9567ABD09E29E2863C939249E0523DD4D2212881541EA6ABAA132006AD4A046234F5393595923DF84EA4A0F5B24425257FBEEC6A32B8E2ADE7E5CD566FBD4D322A53512323F79F853D47341037D2AF5AAB98A8D98D41F31E2A6B5212F622CCCAA4ED62A70403C1FD09A628E686C8C11DA93EC3E55CA6CC1649148A863F33CB946F8D558851F764DCC781EA0E6B1AE62F2AE5E3470E8090187423D6B556F23BD0A6769A56014B92FCFB9C9C8C0C761DFAD67DFCCF7532CACC4B2C68A73D78503FA5630E6E6D49E58A5A096F271E53395041DBE80F6FD71CF6AEAECEDA7D434B847CF6F6B04603DEDCBB3367A6215E001D39E7D393C571BD4575AF7D73A6F86ED350B78EEAE2411010BCEEA63B62060BAA85E704151B8F1DBAD5C95CF1F338A518B5DCB77B6E74E8D64BAD58234C55512E61DD34F83C02A9C9C1E99191EA39155B53B54911F4DD402585F84DD6EF2150EC8780240A4E3D39E40E7B367889AF67B8BF17AF79235C0218CACFB9B70E841AE83C3FA9D9DB5B4F1EA0628FCF7DD3DDCABE6CF20FEE28C1C7FBC4F73DF14DD271577AB3C65394766269D1C8ED7935D46CAFA7E3CE831F36704703D0053FA54BFDAFA1C8BFE993EA0148CA88914291F99FD6A43AED8FFA5DD40EB1310AB146E59E52AA0601EC41C1EFFC58AAE638EC2C0B448585BDF9F23E504F952461B9241C745EDEB8A974D4A5CCEE8E858BAB669EA4F6BAAC105B99ED56E4D93C9B0BCB12952D8CEDCE3AE39C0ABF69A9A6C76B29AF61494FEF16DC100B0E837023D7E95CF4FADB45B1919E3915CB84C1650718DC3792338C7F08AEAF4CB71FD970CDB4033A0998631CB73FD6B4F60A72E6D9F747461F1553E1E877DE02063D32FB59B8B89A4FB4B08D5E723E71182011DFA923F0A82E242EC5C9E4F359DA36B7790E9274B6943C3CF9795C941DD73E9CFD47F2B8D721A1F29100071B9BA96FC7B7E15E853565646551B73727D4F35F885347FF00095D8ACC7F7715A2961EBF3BB63F1E05730F78B259CAC5807D8102F7625B731FD2B5BE204DE778BAE403C451C49FF8E027F526B9839EB59CD5D9CADEA6CDD5D4D7F70F717B74F24981BA473B99B03007E42ADC771E705468D0C6A0E7F78507D58F24F4E056611238FBA80019385E9F8D2C6AD26037CE883EE8381F8915CCD189A51EAE6CD59E22D3EF5C1177F301EC01E4FE95ACBE23BE8ECD6FC496D2DD2636B6E23CB041DD80BB76F6E39CFAD6044670E845A82149118640403EDC735B5A569975AF6A763637CC22FB54DE482E08C64649DA472700F438E82A5C2EC76D4EF7C3BE0AD5EF341B7BF9EF77E62CD9DA1251115CEE66627249DBC0CF6FCAA6D634CFEC58120F9E42C7E67C7CA4FA01DEBAFD76E6388DBE9E6E24B48E643B6688E0210405071D8F35C56A161708D29671332B2AA10C4B4AC49002E7F0FCE8AA927647A9864D47C8B56DE13D5AFC798C9656ECDC849A42587FC05471F9D25E784EF6CA3F32F755B34C7DD8D7396FA5504B88B4580BDBE3ED8C0F99720838FF00613F916EE7A715047A74DA9079F52D4EE6043CB2410EE63EC5D8F27F0A84E2F448D79657D5E9E8509E4B5B5908B9BA850F401DC6EFCBAD509BECF719304E2507FD961FCC56CB586870426286C2E7E73C5E4BFBC90FE07031ECB8ACF97C3F296DD6BACD92E7FE7BAB44C3F43472BE8697461C91B44CCAEA5549E0E3EE9AAB65019EF25779195A3931856C63D0F15B1A858DE69B86BABD1748C0FF00A972EA07A1CE2B364BA82C616BAC6F5600200705FDBF0CE6AD6F6643E5DDBD091A188F886CA331A44A2197CE7C0C302ACC0F6C9079FCA9B31482711E4953D1C720FD6B334A99751F10AC93A97DEB21D839C7C8D81F8715B77D6A22D151E2B580B099B726C192A01E83BF256BA791496A71AAAD49B8EC2D8959EEA0008652E338F6E7FA57530DECD03EE563C9DC45700F04B637027B59248240BC98D8A9F71C76AD2B6F154E80A5C451DD0462A5BEE3F1EE38FD2B3E4717A1ABAAA7BA3B6BB8744F1181FDAF6BFE90A30B7511D92AFF00C0BBFD0E6B36D7C011E93A91BA82E7FB62DA3CB2DA498490B8C60104ED7E481D473D8E08ACB8BC43A5CA46E9A5B56EE268F23F35CFEB8ADBD375A68FF791BA5C45D0C91BEE0A0E4751DC6E90FBB37B526FA33394232D8F3D9ACA5179225EACF04C32E6178995B279C018C9EB9FA7351CCAD1BC729541B97218A90076C1CF7AF75B0D4B4AD76058F53B3B7B8DABB8A4D18608C704F5E98DCC3FE006AF5E7873C1A6CA4BFBBD16C0C50AE5DDAD86401DBA67F0AA51BF539A50B33E738EE2489D081955C861FDE18231F913CFBD5F7B786E50CE801DDD54F19FF3F31C7D3D6BBEBDF0AF86A747D42186E92228CCB02C9FB8DDFC2A48CBA73F87D2B08E85A6DA5AC3ABB6A6121BA24456FF00666668A456C146F9F1818CE49C9C0A4D762FEAF36B42CFC3ED552DC5C68931182E6EA340080E70032F519202823E8D5D4CF3894B8200C1E830715C048F26977D05C22A89D8F99180A17183C74E071D79E79AEBACA74B98E2961FBB3A061CF4F6FC0F15AD29F32B174A5A5BB1338C21C5451479B98CE7F88647E356A54D9185EA7BD4318FDFAE3D456B635BEA7974EBE5DECF0C78E27913E66C7018F539A578C86B7566425148DA8E1B68C93C91F535A5ACD9DAF9B76F0085DE099C4D9B9FDEA9DC7388D82F19F4CD538AC25B481DEEA0B882590A98D658CA864C1C919EBDAB8E4F4B95804DE252EE1101E664F619A64AC4DC2827A0A7479DC6A23F35D93ED58753EAA4ED049772C3FDDC54247CC2A57E462A3FE3142D8AA9AB1AFF007A9CA3826871CD3870954425EF31145238E29CA291FA5036BDD220FE4C8AC5432E72558706AE5C4914B046E03995DD8BBB372781818F4AA92F294CB673B194E48CF4CD35DCE47A5448781838ABF3EAD1C7A0269F35CEA4C199B6C51CC8215190795C6E3CF3CE3DAA8F5E718ABF612C76C4CA60B69E46DD1AA4D6C25DB95FBFC9006081F99A1349EA72E6314F0EDF668CAB5D3A5D49888D6281638D9DDE59551481EE7BFB559D3E3375E67930BBBC7C878A42A1477CF049FC0D6969BA06AF671C6D65135F43A8068596DB08ED804E0332E42FA91D40229DFD8726A10AE9763A858CD345969A18558F9241E9E637073EDC5539ADAE7CCEE57B658E381EF2E226BD6818858648C18C0DBFC4DD49C9181EDDABA0B6B7826D0EDE7575B7BD8E369595E30FB4AB958D76E0FCC495007A678AE5AE9A4B3F3A24FB6A2C6810ACEACB2156EA5B070A064003BEE1EF5D269DA56A26EF4DBC860B8115B146F3048AC2152430560C06E65CB3118EF8AC6AC74BB6091967C3B75E68BCBB7B7BA89E404AAB302DBF0CADD07CAC4E38E87238AECDE258A058D4615405503B01C0AB6560FB7CB046A77A8DA476DA4EE07DC75C7A1CD417A7126C1DABAB0CE5283948E8A0AC269D19F34B7615AE8BB8803BD52B38FCA4507A9E6ADC970B676D35DBFDCB78DA56FA2827FA5764515377678E7892E3ED7E23D4A607E56BA9029F60C40FD056491835348C5D4BB1CB31258FA93CD4272C31585F53065DFB7CE232A1D8B31C963E9E9FCE9C9A8DEC6C0C775328FF0065CFF2AAA2393CA120DBF7B001EADF853A395D49F3380460E00A932B1B4FACA25BC8D02CC4BB00AD34C5D95401D4FB9CF02BA4F86D185D42EFC49A95E496D61A6C7B1A43924BC808017E80E7F1AE2D98189EE37A1655036E0739EF8E95EA1AB697168DE0BD0B42BC221B5B865B9BFB941928CDCB1FBBE84A8C1CF4E2B5C3D3539D877B2B9D84EA9E208A36B29E1B9023C4523B15703B0CF21B3D7F1158977A46A515D25B9B591AE1972DE528271D012413C7D715CB78434FB8D534CBEBEB16BAB5923B80F0BA1211D30C0A2E7838201EFDABA5F0DCFE22BCD46EE01AB4A92BCC925C4CF187210023038C29E001D3BF5AE2C54A10949B7A23AE8E2D5F916E68D87866FE3952E6E34E669F27C98D9D3CB840E85B9E58FE38E2B6E0D1EE0B86BB362883A21CC993EBCE2AA5ED85FDCDB14B9D5EE63766C07B793689013F74AFF51CD61DEF84B48785F314CED27F1CB33395FA66B8F0D8CA15AEA9AD8AC462254BE27BF636754D574B691ADA4F105A80A8498EDED436C03A9CF20631FCABCB6FF58446694B453FCF801A52327DD460E3EA4547ACD85CE9128485368001650D9127CC7071E995E87D2B9E9668E52D24CEDE6B312C0AF735D3CCE47B984543D8A9C1DEEBAF4EE6B596AC64BB10DCC8B020072ECA4AAFD4566F885A369235B59127B7059B31740DC67FA5422EE416C62400283B99B6F24F38E7E86A2314D0D86E52D1C836BE41C1008C83F9356D4D773CBCC2508BB4497C36D226B71F951A990ABE033606369C8FCAB6EF351945B01B1939000120E7271E9581A4BC91EAD6D73216DAB205924C1239041C9FA66B6EFDE0927916262E01047181D33C7E04574276479F057457FB512FBA585B00E4A823D78EF59EF2480105307716C8E3AFFF00AEA691E443875E71CFBD575932C5A461F3367AD2E634B0D773B1B7A0C018E0D6DDA19ADA110FD9EDFED1E6615607CED040C11827731CF4078C63E9833B460909306079240C56DD9DC2CBA7C5BA711B28DA0342BB719DA096EB9EA781DAB39994BB9A56BE2A974696321A691D5712BB2AE77723054F0460F7C1E4D6EDFF008F1755823B3BC768153EFC2B0B233367396CE475C1C67B5702C23595BCE59304FC854F5F7C54A3C96DF334ACF24872C66627193C96239CF7EE6A136B4435525D4ED46B76B1D85DCD1F912CAAA891B21F29A6DE48390383B4027F9D73BA95BC6B289FF76ADB5B2F91E9C1FA7BD674B2C1026EB769A45DCC411000B8C9EDBB3F9F355A4D4432BC6C9C30DA4824103AE3049C0FC6AF959D7ED1728B76249185CBCA67DA02EFDD92303007B0C0AEB3C21A8DACD6CFA7C5BD25B7FDE82F206DC0E32140518C1E71CFDE35C6C727921651305463C80037E6A7835E81E1C4BC9B4F9A79364972D2AA20917C88CA9237390075008F6FCA945B52563969A7CDA1B73B6F557EC454512FEFB23B549709F6791E0DDBD54F0C0F07E9440B881E5C7404D76DAE6EF43CFB5C496D7C45793CF1C66DA2B99A38E4785180279E13F888DC3AF19F4A9750B08EC349D3D639A474983C83CC2A0E0ED20ED19DA4EEE993C01D3A537C4369E678C6E6279D6186E9524DD2676925173F5E79FC2ABDFEA6FAA4C25648E348D4471C712045451D801F535E657BF3596C7A594D2FDECA7DB42AAF1B8D411F3704D586E16A0847EF09A85B1EF545EF451337424D463AD3E4E94C1D453E812F885239A77F0D211CD29FBA681AEA20A1871494E3C8A03A1138F945456E3E427BE49A925E10D3F4E844C1432B6D2C14907A64E066ABEC9C93FE2A1949757261856324F96EC3763DAA50001823914D96049D76B76E688D9BD48C5D3E6C3C91BFA1EA5184B4B8B7D566274EDCC52587023527F870DF364120838FAE2A58EE5B5294E87E1E86D45ADCA3309254F2FCC6192C4F1B8900F007F2AC2F07C657C67616DC1496531B6E3C6D2A412791D3AD7650689A12B3C36F6B3CEA2512C72467F79D4E36B9C638F538EF5151C613B3EA7C8B56322C1E3D274E69AFA775BEB2D4634944D131521183E437F11206319CE08EDCD6EC3AB43A9C1757B14C21B9D51246B67931BC306E5323A0238F6E2A17D26D356DD791EA924C918394923122DBC8011975CEEE0F5DC1B3CF245654DA76A57FA85BD8CF730DE6D97CD5BBB340F16CDA401845F979E338E339A99454DDD9363A5F0F5C9D4EFAFEEBE6D9022C2013D72CC413EF818AB3E4092E0C8C78CD4BE1B8A0FEC15B886C9ACCDC6E678DF05CB02572C4019E87A8A531BA12156BD4A50B5348E987BB11A589906D3D2B3FC6978B6DE13B850DB5AED96051F8EE6FFC754FE75A914041E9926B88F1C6A11DDEA7169D13AB45628ED2383D653C11F80007D735527CB107A9C4B26410396152C6BF678C19233B9CF1EE2AEDBEA1A7A5AAC173A72CA5589F352531BFD338208FA8A7DDC90DFC51CB6D6F6F691C07608BCD67924CE09639E0FE18FA565A2572546FB0C33C719531CA771FBEFD0E3D2A9CB73179BB84203EE249EB9FCEAAC8ED236E00A8F4A7DBC4669446A8F239E8A8324FD2B3B248C52D4D9D2EC96FE5127CCAC491B2223D39EBDABBFB4D4355D434596C274B69E4BA8E182071D620A426187A1201EBDBDAB0F49B1B8B0B65FF0045314F232AC4858A4BC8238190DF313807BE2BB84B7D521D3116FF004DB896690F9723AC40B8C1DA0B1071C71CE3A73EF5B5A14B0FED9DDB7D11F52F0B429D154746DF5BF5F23534CB5D13C27611E9726A3145B4B1712B60B3100B71F88AB51B4305B486DEED22B75632493750DC823A107A6067DABCFE396E262355B81686FA470F182099460E4B139C0000EBD401D2AE2DD6B0BA44888D04FE5422694DB488C1460E19B8C71B4E707AD7CA6228E27169A86A93D7FAEA631C9E9D0F794B5EB7FD0B9E25F13DBC37F6B041BEE02E11C97E89C13F89C639F5AD91770DCD924D0B0F2A4E50F4FC3DB9E315E672BCB757A669C92E48C935D76873797A6DCDBC8C42A49BD7070402BF311F8E0D766130AA8C52EBD4F9DCCAA5E7CAB65A231FC6F29668638E2941DBCCBE69DA7A82BB3F11CFD6B895D366B899238E3CC921C2A8E2BAABAB4927D56F62172D2A5B1F30863C60939EDC6D23E9D3151DD20D3DE528626B8842B3A06F99149C738E9CF0475C11EB5DFAC569A9E86139E538504DA8F530EDB46B994C8AE0461546E66070723803D6AE5D6877768897011EEAD9C28F3913E5DA78C60138C1E31E959EB3DE08F70DC6353CE46547D7F2FD2B434FD5963B641232EF69CB62325180C0E38E307A63DAA233A89F747B5530186ABA26EFDD909F0DAC72B3DA5C2911CBB809432E40EC579F7E7D29BA9DBC7F6D1B62F2E26076007A71D3F4356A6D40C005A2C4BE4821C63208279E31D3AF7A6DC8926B259CC58741843D3209E4E7B9E7F9D772574D23CEAB848D38B944C9B98D2395507CDC76E9C55711AAB170BEE01FAE6A69A078581DC38418F719AAF22B903273D8D2679DF22364DAC79FC6AD5B362C15636C379ADB891C0E0631FAFE755258593AE413EBE956EC259E2B3916295C2B3FCC80FCBC81C91F87F2A52D8CA7B12DD4CCF68AF3DD48422E52338383C7E59A9AD7ECB6DA7192E951AE0481FCB3D7041C03F4C67FE042B365BA0B3A30453E59070464311EBEB55669DE5919D89CB924D5D3496A28AB23A097C44638552DE18E24C902355E02FE3EA4935525BD8F5357173147B954B0942ED60003C71D6B34444C3E633606428F534E20A46C178C75F5AD1B2CD4D12F9F49BE125B94756FEFA0247D0F635D945A96B925A5BDEC61A4371CC0AACBE63F5C614F6E0FF9C5709A344AF730F9D179B1B48A8C849E4138EC41AED6EB529E082DEF224962B3B6430D92370E22078248F5FE40727AD64E5AD8E9A4F5B322B2F15CB69753C7ADACD78A65232A40910639C03818E3A71DEB5EE3C6BE1A5B42A25BC404729F66E7E9D71FAD71FACCB149ACBCF673452DA489F79D479831C60E47078EDDAB16662E899E9D587B568A6E2889B4EEFB1B7AF08F53D4DF57B7B98A3825813CB8667C4AD84552028FCFAF4ACBB61F211EF54E1803CA2533618101548393EC38ABB6E31B87706B92ABBEA7B393C93BAF31D31E0D4508F9CD3E5E94908E4D65D0F625AD443A4A60EB4F93A8A60FBD40A5F10FEF41FBA697BD237DD34D97D18DEF4E3ED4DEE29C4504AD8AF70711B55DB148A2B26F3A448FCC88E3E6CB13D57E5038E40E4D52B8FBB57B4E9C43A74920547903AA02C80F979E73CF5CEDC55F2F32B1E7D593551D865C7CD3B38C8DF87E463A8C9FE75190DFC1D6AE6A06595E29A485636923CE4023780480D83ED8FCAAAC60EEC0EB823F4A56B3B1B4AF2C3BBF626D06586D75F59E58779D86346E311B30C6EC1077601381EA456B6A17B71A45C7F6469773325D5C10D70F3C61442AAA000176F07A9271E959F04505920694B493CAC15638B0C4640E7F5C0FE9557EC5A841AC22CF114B89146E0FCEC527A93F81FCA84B9AA5CF92972CAA682EABA6BC76CADF6C9AE8A825BCC62467D8566E95AA4BA55F24F13BA2F47D870C57BE3DEBA1852E58C897122BC6A485EE48FE959926910B5C492B67CB009233803DEBA1B56B335951BEC7A769DE238AE6CA3696DAF4A6368B911EF5703BB6DE41239E063D2AFC5796332BB477B048109DDB1B76DC75CE2BCA3C31ADDCDB992CDEF52281A3217CF40EAB9E38C83B7AE78C7D6BA3B6B967D3762CA45B471BA42114DC316C6738195CE7D8727EF1E952B113A6F959CDCCD6859D7BC730087ECBA2AC9E64EA40BD946C555C904A03CE78C64E31CD70F741576103F8081E980C71FE7DABA5874796EECBCEBDB38ADA344C249283148ED9EE3249041E38C7A0E4D41E17F0CAF882FD25BA97CBD3E1199DD4E1A43C7CABFD4F6CFAD3551D46694EF37639AB6D3C4F04B21620A9E07AD751A0780356D515E52A96502292CF739049C64617AFE26BBAB1D03C2B60A268ED210900F91A525D99FD58FAF4FCAB4344BAB6B886EE392F6DE37964914069541E460704E69B477469452BB3C3F48B3BBBAD416DED74F8EFE79410B0B838F5CF046318EB9C57B37863C156DE1D56D564B180EA1261FC94732FD98118C213EA73FCB26B85F876B0CFE28B484452C1701D9D6E23936875D849461DFA67031DF3EA3D5B5BBCB64D2A79F76C5246D427EEB03DBD3A66B9F153A2A972D5FB5A7F5631C2C399A4BB97ACECEC5651A96A36B0ADE44CEB116C33AAEE241F62739F6CD5B3AED84EFE44722B330390DF7718E41AF39B1B99356B26B986F248EF229651B4CAC1255E83201FF6B8ED9EB5C9C7AA6A965712452DC5B5B6F265926943079805E802F27818FC6AF0B514DFB24B58FE47457A30836E72DBFAD0E8F5696CEEF5F8AD6D608AC6D2E00937B4451F9C028A39EA79031C9CFBE629AF2E6C268A0B39544F6CFE5956659388CF215B0085233953E950680FA7CB3CB17896564669145B5EE5B860C3AA11803DCF4CFE526B3A5A090EA16BA8437B05C6E66922251FE6EE7190A4907EB8AD9C150E6F3D4F5B098A738A8D58BB74BA7A8D96CEDEF24BAB8B7458D1E6252103EEAB00DC76C0DCBF4CFB55BBED6A24B3852C95CF54BB778B10872AC0658F5391C8F4E878A9F448EC6C745924BD7F308971FBBE36AB055DC71CE0803DF20D51BDBDB74BC09236A26C6D628D2311A86059070DF39E3049C7618C735E7C6AF3CDD8F1AA60A29CAA4E3D5DBF431D6EAC74CD45E5D52491DA485A470B17CAE24848403D339FC31597AB788A1D4A537496096F310B970033138C124FA67B63BF5A9FC4FABA6A3712FF00C4C3ED025903B33DB2479237018C1CE3E63C1AE6E56551866DDE8477AE9E48DEE8EBA387950F7EA3D7F236EDAE6C64B39D6EA6BC82791D597C923CB3D7765723D78FCA92F9A2B2436B6FE44BE622BB4B1B876C750A4F404719C7A019EB5911B24DB2300F98C7E66F4F41F4AD186D57ECA64760BB1882A5B83EF574B0CE52D19D35311397BB4D6A5FD2EDC5FD9C93CCDB151942385CAE4824A93D8E3EB4FBC711C48B06182A0DDBA324E724E47A70453F4E94DADB35A496F36FB826E2341271B551806D80373907938E0555D41DECEDF7C4B7914D1150BE6952B323839071D06074C91C57AB2C34792E9EA791531356FC9228DE86DB821FE53C654F4CFF00F5EABC862F9B664F7CE0D5DB8D40DDC0AF2279678E7D4F7AAD2153F7980046EC7AFB579ED74302B34DBF972C587B5322243485081B5777CDC1FC2ACC7B7E5395395C1F5AAEB98A462D8F9815201E0D2B10D6851CFCDCFA54912ACB346A4ED0CC158FA53E1B39641232AF083E627B7A546F0C916D62383C835A5843DC918404ED5CD36794B4CE14632C738FAD19E727F8B8A51181316270B431236ED2DA24B528A982C32DF31E4FAD6D4BACE96FE0EB3D3CCF1DBDE59CAD118DB71328272589C600F4E7B5662C4E22F2972598606D3CF4ED5956FA7DF5DD84D3DB4334D1230598A0DC791BBA75E8B9CFB54534F5B9D5565CAD7297824E24952487646AD8DC7279232067A74E6A4B14B76D52D22BA589A133286F35995573C062579C0273C1E715850DE5C4317931CAC60DDB8C67919E99C7AD5F42D2421D867239A251D095353566777A9D9691A0DE5F1D2B569FED76A999963B928C83863B4127D474CF4EA3AD7129832CCEAE5D59BE573D587AD757E1C8745D7EC1B43D49D6DAE91C4D6D73100BBC60EF127638038246403EC6B075282D6D6F6486CE09A0890E3CB9BAAFD3BE3D33CE2B9AA41C523D2CA1355E4BC8CF929601D691E9F0F00D66F63DF8ABD4124FBD4D03E6A73F5A41D4500F71E3AD237DD34BDE87E941A35A3231D69E699DE9F4CCE256B8EAA3DEA7D1AE67866B88213FEB23395201071CF39E38E7F5A8271FBC5A65A36CD490E3233C83CE7DAAD3B2BA3CDAFF00C4F99AD7EE64951A48A2491907309F90A8185C01C0C63155A3611CA18F4079ABB79123C0268D99D531F3F97B1482EDC0E99EA3A0EC6B3A5FF5527FBA6B38BBEACEB8A5EC5A5E6694D73E523ABCD2246E00CAE70B839CE0739FCAB27CCB38E29E18647924795764817623260E720F20E4D5AB7985D59231E4E307EB591770B5ACB95FB8DD3DAB78455EC7CA558D9FB489D15A931439765E7A62A1BD5325A4B8EEA703D6A944658645477F35D977613A2A81CE78F4FE46B4E36595769E86AA51699AC6A29C4C0D225861D490DCAA988FC8FBB3800F7E39E2BBED16EF4FBE9638F4EBFBAB698A798EB6EA919EBB7E6207CDF422B94D460816782CE0851EE6623E63FC20F4E9FE715D4E9F6765A6A0B7492454911A36B8B51E54ED9391F364F435956A6A5691C92A6DEC6BE97637B7372F73756F3581654CADC312ACEA725941E0E40E48F503DEB1EE3C49712DC3AB480A1CA2EC50A001E8074E95345AC59416372D75BEE65B74115AEE7F9F715C17CFAE42E4FB9AE437B0452792B8AB82518E877429A8474DCEBF46D7EF2C373C6AB2C4C3F7B1B7422B506896FE26B09CE9ED048E32E2D24C0653FEC9EFE95CD68122332A188C8CED8182303EB5B1FD90E2E8496533DBCA0E54AE720FD4722B5344C8BE1CD9ACDE2317D292B1584459E4230BBD9428C9FF007431FC2BD13ED904378969A84245C222B245129943A64E49E38F7CFAD717A15FC561E14174F663ECA660EEB148CCCC4EF41F3763C05233D0E703351F83D6E358D66F6FDE471E51C47952E159C92793D30010327A1AE6B7B682A71F88B8606A422DB6ACBF33B728D7F2B2C360F104C34C02AA96DE4E403ED8E71D71CD73DAC7876C24BA6D465877436B1B3CA91BB2E081C1041C8F5FA8ADD49A6892482C6EE29DF04FC8776C393F7B6F41803F335136A379E6AB5A696BAA2CD10758E39429552704B7B648EDEBE95587C34E8E255693B5959DBAEDDC9F66A2AF357479EDAE9905F59359DB5965F20C521601D327003B1E0E73EDD38EB5DCC70E8B0F8096D8484F9281276B6405DDC3F519FF006C9209E2B89D6A5BB8AFDE26D3CDA3C832CB7392CB9CF3C9C77E0919EB525B6A771E1FD1EF44919696E2358D1588F91589C9C1EE76F1F426BA31D56954694236674D6C546A24A8AB72EA8DA0B653E8D24DFDA93470A9550D771090B8201DDB4641230463D8566B9D284CD12DFBC4B6CBB4A49FBB0EC0F2C37654FF00BBF2562DB6BD241672C48C4099448A879F288C83F89CFE82BAEF0BE85A3DDD92DDDFC905D492B048332861E693955C0382401920E6BCDA34A7CCD0ABE25BA6AEBEF2AEB5F0F6C3521F6FB4BF923864B757128557DEEDC9660003820F51EBD2B88D47C353E9370B6AD18BAF38E23923CA9CFA63B7EB5F439B6B3923586485216503EE80063D01ACFD4AC749BD4659AE04865703E4936B01D3191C81C9FD2BD29474D0F36351B92BB67825BE9E90B231B69558A0937927804E33D318C8233EA2A41605FCEBA69F62AB025257019C9EC303D8F6ED5DDCF69058DD992569A57B828C251288E29769C441771C1DBC76F7C5626AB656D7FA11B9B78A3FB76F6966FF0049624003B03C1CE09CE493F8D79D1C6494B924AC7B54B0E94D4DEABB7EA7356B79FD9BA9C5788DF68911949CFDDC021B0323AF14DB9B98DE190DD630555772A0C1C740BC0E474E7B03C9A96DDADA1B736E6560F2B6E7731820601C77C9193CFD056943A15A5CAAAFDAE0BE373FBC08A3632302C3900E707AF1ED5E9C714E2B95BBDCCB178586925A331B4AD2C6AB692209FCB9F70F2D197861F5C803FF00AD4D4B48639B1329210B2B05E7BFD791C568C76B1E9F209618A50E47CB083F2139E467AB0E0803AFB9ACBB9B89A6BC673B54BE72147001EBC67DA892B2BAD8E1C4D070F79ADC65C2C6573E58193C62AAC4143A96C95CE6A6FDE33637E406CE71D6A062F1BEEE0ED240A94CE264F2DCB24522F193966C7193FF00EAAE8B4AD26D356D5DAC25CEC89638FCC519C60927E9D0FE55C8C314B77729044A4C92B8503DCD7ADFC27F097DAAC2E756BA560CF22AC25B3865C1DDD08ECC3F115AC5F724F3CF13786AF741B80B3447C9906E8E551943EC4F66F6AC20E464135F505C7846CA7825B79099ADE51F3432F207D08C1FCF35E55E31F8457B6124975A024975001936ED82E3FDD3FC5F4383F5A6D27B12729A3C8CF67712484EEB68246C7B6C383FAD6CF81DCC5A7B48AC47FA7A8EBD3119FF001AC0B3325BC5751C87617B09239158618329C0520F43D07D315D0F82604FEC39656C026F0B67D0222FFF00174E0922DCAE58BCF0D7F6DDC40D05BC0B220559A42305C97EA40FBC71F8FD6B1B499347D2EFF50B2D59D92D9E19E0491632C5640E0A371CF54AF48D3B4BB9B6264C48AA18283C140CB96FAE7E5FD05731AB797A76A5E27D34C11171A845771F9AB9CA3839FC0647E75728A253D4E45BCC81D244728EB864743820F50454D7F7971A85E4B7774FE64F331776C6324D4FAA2898457A0C43CF2C1A38D362A107B0F4F4C7A551635E7D5BAD0FA4CAD26A53F4226A922E12A26EB5328C4758743D687C4D919EB40FBC283D68EE28249075A473C1CD28A6BF4A0D5EC3075A70E69A29C3A5332895A5FF008F81F4A83256E8303820D4EFFF001F3F8540DFF1F1568F36B6F7F337648D5ED8DD39798B70249241BBDC85E4E3231927F0AA6FF32BE3B8C5598CAC9A5A9CB332F3858CE17B72DD3D38F526A0FE2ACA374CEFA7EF5368A5A64EA8AD096079DC08F7EB53DEC3E642DF4E3EB58DBCC72865EA2B44DF992168844FE605C9047DD1EB5D728BBDD1F2519AE5719167456F36E2EA771F2A43B3F32063F206B46D5573B470A39C9F4AE76D7517B38A5896307CC6049CF3C03FE352AEAF3AC3246235FDE295DC739008C568D36CCA125145DD21FED9AD4F78FC0452E3DB3C0FD2BA163B93D4571D61A8BD81908883890007271C7F935D2D85CFDA2C237EE5467EBDEA27735A2D3F532AFD648EEDB631E9BB6FB5431F9D74EB1004E4E485EB8F41573506D9751BAA9665C93E8454DA35E2E97AACB2A81C29543DC723FA54276D5A2DAE67CB7B1A73DC8D167D3DD2C632935B02E92C85DB04E3E6E06D718C7A1C671CD69C1AF7972EE88BA03DD40C8FD2B1358BDFED5BB17225DEACA0143D508001FC0E33F5CD1672889D4B8665FE20A70715B4E6A6EF10A5194172C99E9DA1782E21F66B9D4D523B64B4D82DA39C98C12C49ED9C6369CE724D6AEA1F654D12E74FD2E04D3E3CE2395F6C51339E78E0EEE9CF1525C5D493C72C5693895D46DF2D171D31D01E9D4739C560DFA6AF24B70B7AD6D16988AC424721DD3019C60E463DFA1E315F3B473494310ED0D3D753B20A75249CA5B3DBFE01926181249F52866BD3BAEFC88DA2C3602EDDC1B38F9327818E80678A8E6D3D34BBA862B689A08AF0A4124893B1919B7E7058801493C9001E17D0D6769AD65736F731DB4D342E859A1815B0CFF28CB1519CFDD2481EB8E6B644FE15B6D6ADB4D3A8BB3460B25EDC7CCB1B6D3D58E3AEEE9822BD575EA576DED6E874D6AAED66DEA6AF9DE1D49BED171047A85D04313ED94B7A83C31C639C73EF8ACAF13787749BF83CDB690E9F0A9DA2DE18015621090E4019EFC9C1F9476EB5524B9874B937462CEE63693CCF3DA5DC0F0401C0E00CE78E48E01E6AA5F6BB75A8E9A8B178816D2582791B7BDBB032A9C0565DA8707071B73D3D2B1F6F512F78C6BD1A34ADC8FE773120F0FDF991A1864B5BC795498D619448188C60638209CF19EC0D761E1CD2356B1BA464486DBECB2EF59A766DB0A3637208C75760BC92780474352C5AEA69BA3C1A88B69596652F2CADB04B291F2AB30E382141E338040C1E4D536F155E4E5A3B4F2ACA759332BC928F2B76DC051900EE381F4C577D34ACA4F462F633AB1576757ACDE5FD9C625B6D40CC922938784610F61EFD6B989F5A7204D2B47B93E62B8C608E770A7DADC3F892CEE5AF6445B28670AC639366E9324E47CA72DCAF1D0629FAD4567A2EF8AEB4D8CE99E7AC06471E6CB3646E1939F9406C0C12381DFBF6429AA8ED738AB42541E871B73A8ACF2CAF29026C6C5672CF81B98659B8CE148E71F875CD63AA1B3682510A5D0008DAE78C16C9523A9EADD7D456F5DF8734B95567D36612DB95C798247460D9604152BD3E51CF158BA8E91F66086613C4641B94BA86041CF3F29F6FD6BCFA98374E57674C7309C924A3A993A84F03CEB344CDB25CB6C623747C91B4E060F6E715A9A2C76022B890B48D2185962D8E01F30F000C8E83927DAB366D3CBE4ACB0BE3D1803F91C1AB1A5CA6CEFA2B599084B9654520639271C9F43C55C62693C5C2D66DFF005DC95A45D3A42CECCCB1C9E59449C212C39C103271FE734EB9D46793477175E4A413DD9701581704A9DC547A63827DF1526ADA1C16FA4CEF2DCAA35B8036A381E730E06013CF273EB8CD57D12D45D1227B9B7BA8217CA433270C8396DA4E083D3A70706B795A106CE7AB8D7564A325A18CFB4BB6DFBBBB8E6A3704273C81C7E35AFACC535D3CFA95E5D069DA408906C3C20E073D00E9803B566C7100F08284AF9CA590024B0EF8FC2B2834CE6A9149DD1D87C3CF0B4DA8CB3CF1AB0964530452E32205603CC93EA14ED51DCB67A035EEBA6D8DB695A7C1636A8238604088BEC3D7D4D72FE058D34ED02DE30EA5A45F308047F112471F4C574735EDBDB44D717332411A8E6473802BA1C5D8C58F7D4ADE359A599C47042DB0CAC700B7703E9FE7A5737ABF882E6F527B6B26D33C965E1E5B81BF1EBB58007E99A8AF2F344D62F52192FBCEB7850F97040AE1949C7CCCDC63BF5F5AAF7B63E16C0363F658E50C0248B2BAE0F6CBE0827D9BAD0A360491E75E34097711BD362B6D7B1279372559BF7AA718621B9041C0EA7823D2AA7852ED61D0678E4992353311F3B85FBC00EFF4ADED797CCBDDB343B583F97223396CA938CFCC0718E9C71F95703AA5A45617D2DABC6CE1795766C657B118ABD9DC9923D3B4CF1BC1148904E44AB348647788AE132BB0039603F8C65B2071F535C8F8C6F88F1A4D758955678823A48851800368C83FEEA9E3239EB5C7BC517541C7B9A779AC36798ED22A7015CE401E83D29390AE6DBB2C91431A1E2363FD7FC6A36EB4F09B076E3B8EF4C622B86BBF78FAACAE36C3DFBB233D6A6E91D43DC54E47CB5833D3A6B76427AD1DC507AD03AD067D494535FEE9A7AD31FA1A0DA4BDD23069FDA9829C3A533189549CDC1A89C7EFFF001A93ACE4D3641FBC15679D3D55FCCD2B59644D31E342C16490799CF040FBA3F534DEFF008D2D8CEF1D9DE44B2615F6865278619CF4FC01CFB527F154B77676E1D7BAFD4C35711DF6F75DC164C951DC03D3A1ADE9354FB46992A48CFB8E1595DC10473B71C67A67BD73F71F2DDCB8FEF9FE75D368D716AB69711B1244A01FDE81EE31EE3DF8AE992BD99F1CD2F6AD7A9CC4F0BC12946564EE030C1C1E94DC92C73D6AF6A16B70F712CDE5AE09C90B8CE3D702B3F24E2B54CC9C6DB8F278AE8B407DD6253AED623FAD738067AD6CF86D9BED32A0FBBB771A99EC6945DA658D4DB17510CE321BB139F6E2AB011C770A252FE5EF1BBCBC6EC679C67BE3D6A7D4CB7DBE10BD58E00C7B8A6CC8B2C32385E7CC2C31FC3EDFE7D2B146AFF88CE82EAD7C3D008D34E9AE6E6EE6C7944CC1B03DD540C719E0F7AA8CA436DE037B9C561DACF2A5F5BBC242CB1CAAC849C0CE78AEBEFA3596C85E880496F31CE41F9A26EE08F4CD5C5591BF3291DB6A1A7DCE9B1B5BA6B0ED7FE5C2B23203B4301CB11DF91DFB5605B26B1ADDCFD92EAF5DA1B650658C3EDC67031D3193B73C671C9EB5D196D46E2CA59B4B25EF26F2DE492E611E4C8AA482B9EB9F98B6475C715922D27B1D5E0B5372B1DC5D912BF93CAB820F019B9FBBE9EB5C399D1850A6E54E3AF7B7DFFF0000EEC35372A8EEF65F7927F61C2618ACF51D4BCBB485F16D1A468656939EACA7E6207B03F4AC8B2D21B44D6E5B8B8B286FE0689FECF24EBB8097AA646700E40EBEBD6A4D47517D42092DEDFCBB7B769BC8133FF1B13C05F403925BDFE95B564BA35D5C5C25C5E09AF2DD8B249011B182E307AEDE79E0D78F4AA578C539EB7FE91D95E3EC293BBDF75FD7AEBA9CA789744D45F526B84D399C4D890ADA032461DBA8C8EFF4E2AB5ADDD94B696F6F7728B67B52123B10A1BED0C4EE72EC70101E067DBD056DF8A7C468FA5C56BA74AF6F23A2A4C23380000CA573F80C8AE2594480A93B485C103B8AF430AEA4E9A755598E5819E228A8FC36DB4DCF43D47568B5BBBD96D2C4F034AD25B5C315C1F90011ED6E01C938CF0703BE2B347856E353592DA0B8905DCA7CFBE13E6240401C00719249EBC81C7A8CF2969733D8DC2CCACF10921318745C6EC11D7B1E956E7D6AEF5431DB87B6DD0F39F2D23DE40FE2CF0C7A7E55EB2A89AD4E57CD46F1968D1D5F88E5D47C3D696E7CFB5F323C08D5511C48A13058FA9C9C0381D0E474AE5E29B6CEDAD992597ECAC26B831BE246732E7CC1BBAE07071C02A33C53520FF4812EAC274840037A2EE45E7A1C741F4A8EF74412C88747D423BAFDCB799189F728E4FCA0F4E40191EF5D74269BB33CEAF395549415FF000FC0DFB8F18C102CE521B779207746499B7898C873BCE0F2480149E832DC554BCD5FEDB3A5C49E5431C8A76C58215381C027A7246073C6715CC6B717957D269E712496CFB5A4539E71C803D01FE5562D358D4EDA18A28E18F601B6395E3C36D078656FC3A8F5ACF15CF382E8C5819255AD6B9A3770436F116B944F3770DBB976BF5E81472411EA2A7B0D26D35A92D23B4495A7126F552080769E9F9FFF005AB9D125EB096F8F9BB15F60988246EC1E327BE335DB780B4D8AFEDD752BDD54D8C366C4BC919D8CA49C81B8F1CF3C73C63D6B8D577421CAF54CEEC45352BCBA07893C29ACA69D757379648A96E85FCD32C79C0E7819C9E3F5AE1B4B9BFB3F518AED62467898950EBB97382338AF5C7D4E0D72EEEA2961926B490C890CDE5B84645C2F3D893D3B7DE3DEB93F10693A4DBD99BFB2B7585A1914B44AC76C80B01D0938FE55AC9B9C79A3B1C3468C39F96A6E4497106A80FDAAFD510650DB15C2EDCF2140E0671FA7350D9687727C510F91149F62123A2BC982C479783C8F73C77F7CD63C72B5DDD3C972863246018F28A808C720751EDDFBE6BA3D3BC46747D56CD259D2EA08959400D95DE71B49EE39EA3DE9D07171B3E86F88A1C8BF23D326912C6D20B7F29195102FCEBE9D39EA38C7E558DAE6AFE44692D93B4770A790E4B2B2F756524820FE7F4A822D627D56648668D59553002F0460726B2B5885EDDC2B118232006CE07BD7537A6879CA3AEA25DEBF71A84110B62D6A370925B7B102D9193905739CB499208E7181EF516A16773B83452B7CED0AE599CBA897EE82E57E653DD58B60E3AF539D0A2F972C6E5B6BBE48071918C633D71D78A66A1AC6AD2BC9BB5194ABEC18DA9D11B720FBBD8D61EDA29D99D0A849ABA1A6EE4B9B416972A59197F76DD4A6491C7B641E3DA99E2ED3D2F742FED0036DC5B10C00E86138523F0619FC4D528AEAE249C0924F30331246D0392CCDD80EEC6B6D596E34CBA81CA93240D0AA9FF681E7F038AB84D491352935B9E641D467393F434C196381C93DA8079CE3B56AF87F4B3A96A56D6C1B6F9F32C791D403C93F80CFE948E68ABBB170313147B942E10700E69A7A715A5AF471C5ABCD0C2BB208B0912E304200304FB91C9F73598D5C353E267DAE1A3CB4209761A07CE2A663F2E2A24E5EA57E951D4E887C2D909A28340A0CBA932F4A6BF7A72D31FA508DE5F09181814F1D3A53074A71FBA699822AA7331A6483F79D3BD491FF00ACCD24FCB03EF55D4E092FDDDFCCB360A1A4B904E3116EFF003F8E29E339E699A7F17D228049684818EBD0D3F18C1F5A87B9D787D9FA98978B8BC9BFDF3522C9E5431B16E5BF87DBD692F8FF00A64A31DEA2660D1A0CB6578F6AEE4AE91F1D5FDDAD2F57F99B7A849E669C486241C63838FCEB9F15699764289EBF31FE95540E7A538AB1139F3B1D5BBE1D5DAB3BFA903F4FFEBD618AE834252B60EE7F89CE294F62A8FC657BD70FACC2060E30307A1E7351B2B970A118C8E46D18C9C9EC3EB5089CB6B3E68556C49C03D0E2B5AC750B6D16FE1BA366B7B2C2CAC04D928307A6D3D4FBD428EC8527793641ACE8D7FE1FBF896EED26B590E1A3132F0C47A1E879ED5B926A16F701AEAC42C1E7006E2C47DD0D8C129EDEDD47D39AC13A9DD5F5B3DBC92130F9A651182768624F201E9D71C7B7A547BDE3612467057A83D08F7AB68D2352CCEA20D4B5BD62FECF4E4D4DE2C008A448202114120161EC38CD6EBC49FDA1636514904ACD1AC83CA739CED5189246C1E98FBBE98C57201E295163951E395011950492739E9DBAE2BB58B45D1AC058699A95C18277865B8DC1DB099D8159B1CA9C29E38E4735CB885ED95A4F63EA2BC7EAF253A6F47D0C7B2B98AC751B7FED492DAEE151E4AC4E3F75126EC97C053DD7B724F535D1CDA978764D31E486E51E68C9923660435C1248C95C718C6067B75EB5C6F88A3827D6FECDA2806092511478C9DE7006EC9E993938F4355BFE11EBDB2BCB4272C2793856470582E09F97B8E48CE7D7A56CB2D8D4A2A9CA7672D57A1F358ACC2A54A8E49688BBE28B38AC6FDA782DE586DE4CFC8CD9009CE0AB775E87BFD6B9F92EC296E141231915DB5DE83ABEA425B1748A28C4E0C4A0FC913390301792179271C9ACBD3F439B45D57ED52E9F712CC1D56C9810889367857DC08391C7FF00AEBCEC34E0DAA7292BEC7B54B309C68F5B94F42B4D475A97ECF67042E20C48CB2B0518E873EA4807F006B6D3C39650A99249EDA2BA50DE64175C004679E993D8E08C1C7BF0EB4BAD3D656BCD334E105DBB186EF4FB81E62BE32CCE00C7420A8C7E3572CA74DB32CD640CD70498D64062C025B25CF524280428C0C73D69E2F997BB48D69353BD49ADEDDBF529C9A744B1DD35BDB4B6F1DBA9919A31E5BA863850C37636F04F19C74EF58D1C50CED1B5E676AB02CCA81495E72370C13DB1CFAD696B1AA95D1E6491D9A599D423CDB9DC056CE11B3F2E3393F535CE5CCF9B95613999F62EE6C60671D07AE3A5658795451BDCF461470F2BAA91FB8F44D3DBC37AD690D613C569A65A44BB0AE1164DE790C18827B7E241FA1B5AF69DE1ED72C2085AEEE1A58E23F6536EA1471C08C29033C81C0C726B88B080DC5E2DACD73146F3212DBB398F9EA471CE7B75C1CD6CAD869561279CD76978E1B0989BCB4E3A1627691EB819E46335ECD1A8E50BC8F3F1185C2D2AAE50934FB7FC13CFDE5651B0E42E7946CE148AD3D12571148BF6D083CC5291805B7100F2003D7B74E6B72EF47B4BF9E7B8B3640B780A26F8890F201B9B673C7381CF5E7D696CAD6DAD6F92D23D4D2DA5814B45790C6809CF3D3AE47D78E457255709371644E151D2E7BF99B365ADB59DBD85845A8DCBB790C8B0084C22DA47396258F2C40278F73D38AAAF1DBDC5C476132892DFCA4327CE4EF39C91B86320118C8C7423D68D5B54D3F4BD4A4D62EDA6BFD4EDA26B648EF22CAB311846C6D5ED9C96E7B7BD374AF1CD9CE7CA86CE0B7790E4CC08566976F1938CEDC8C0C74CE2BA60BDDBBD8F05CFDF76DCE5350B3163A95CD98553B5F82AAD8553C81CF3D0E293FB2544621F353CC605879926D503D31DCD5CD7679351BFFB5CF7ED7124AD81110C5638FF0085431EF963C7354E4901B7124230D0FCC31594A128CD35B33D18D772B5CF43D2ED8596B9796CD2E7EC90B052CA4EE3955C9C73DCD666A93F9B752320658F3F2919FEB9C57417575637162FABC0C52EEE4793710A360062412DCF3C851EDCD7332BA9272037D7A8AEC76B58F355F72896DAFC6DE7B8EF493C3BD39E38A2E224553287C6DE40C7F9CD589B61B657CE432E47D0D71D68D9A676E1E57563064F918F00E0D68D96A2CCCA1C0382A738CB75E87D6A8BB47BCE4D343246C19645E3B77C555262AFA6A61E97A0DCEB1ABC7A75B346AF216CBC870A807249FCABD374EF0869BE1E86396D95AF3534394BB9E531451B1E3E545393D78CF538E45705A35EFF00676A9F6AFF0065D7F3FF00EB8AE847892E5BE7C7CCA430E7B8E95352534F4270D4A12F531B5439D4EE019049B64281C0C060BC03F90154DA9EF9249EBEF4D2B81585EFA9F5BCBCAB95741221F3E69CFD2923E334ADD29752969023340EB4520FBD4CC7A930E94C7E94F14C71C1E6846B2D860E94390233476A494E129983768B215FBF4930E9F5A7019938A49402453EA72B5EE32C59855D4212DB30C769DF9DBF8E39C53DF0B26DCE71C6477A8E294437703938DAE0E719C54F35B7953B20956555E03AF46A56D2E7453D26D230EFC7FA649F87F2AAEBCB60E47D2AF6A1096B9DC0F502A9142879EB5DB0F851F218D56AF35E6C9E57DDF3FA81C63A6062AA8352C870BC544BC533910F06BA98D7EC5A329C7291173C77C67F9D73764824BC895BEE9719AEAEF5925B59A3C8E62603F23533EC75515A367276A76DD44C4E30E327F1AEA62B2926BBBA48E0B595BCB28229E40BBC938CAE48CB0C763E95C9678CD7A3783EE536EA977279642DB2217640C1833127839192557B763557B493314AFA1C8C104D0CAF6B3C6D1BC6C015742AC33CF34D94E3763DEADEA822B1BC6FB381B19CB290D91D0743F5ACD32EE0687ABD076B687A26A761A3996D7EC10490DCC0ED2DDADDCB8608ABB97CCF46240E073CE3E987A13C4F761659E2B640E18991722419C104E4741D3FCE68D94777A95D5AE9D66B2DC34B210110FCCC4E0B9CFD17A9F4AF5083C13A7DAD94925AA79FB7CC2AC5C9F9812146003900F079CF1DEB8269C3DD7767B752BBBA4A57D7539891EDA6B8B1BA49E3B77590002340ECADE6638006493D8E0F5CE2B7CE8D25DA43ACEA3A838D42CE5557579CAA0180190771D5883EE334ED3B4A9A3D3448D6D6FA9EE006F6F2C2A90704201F79873CFE5D39AFAD586A1A6C906A9AA5BD8DFAC4DB0799BA331824EDEE5588E9D3A9AF4A2A70A567AE873CE8A94DCDAD5FF5B0E8AE6F575816C9133C2FCBC67AB82A4293ED8C75F5F6ADEB98EDAEED1618235BC9DF0C22503181F5E9823AD79C47AAC92DFA3BDFDC412C933167077E303E4273D476C74FA55CB0F15DD5E47269D790C04B6E05239151A36C1F9D1B9E47D6BE471796558C9545B2EC763A5520B556668789B4FBFB5B386EA48162FB202EB12618AA80727E524003BFAE6B86BDF165CDCA2A2C2BBD4E439E4F7AEA6EB50BC8348B8D3ADCCB7D2BC663750A5F683D98839CF39C0FC6BCFE6B596DDB6CF13C649CFCCA430FC0D7AB97D392A6EEB4E872D47EF2BBD412FAE669079D33326E2DB58E464F538ABF6D2B41324D1310D1B0753E841C8AC962C3E709C1E84F5AED7C25A7DA5DD9C7752D90B98C12AF0C8CC3CC236E4F0791CF415D55B9611E666D4B14E9C5C63AB2AE9DA65DCCCB3849096CB6F656C30F5071F3720F4AD99D6F27B748A5B7DE1CED263404F5182481EDEDEF5B42E16796593695B892403C911E1634030147B0EC3F2C5657882D6466477B95092C81645670AA47279C75E9D3E95C10C67BED2D89AF29D4F8F7316F6DC69D7EF0C772F2EDDBB76B6E0338240C7F4E6AB44D2DFDE0942F9CAA36B09002E70B9071B81C000907B60577DE16F0B695AB4BBEE271710C2AAA8824DB818F94B74C93D78E383DEB17C49E0E68B532DA7405EDE3C65CB80A1028006F2796CE70323A74E6B7F6B14D49E9732855A8A3EC9BD0C3F155FDA6AF785EC6492E2044DA1E4844659C679C003D47BD61699094BA9724158C0DC7DC9C7F3E2BA1BE9EC67D2E064DD1C9672888C6502318C862781C1E4727AFCC73D4565B0C481E34015D7039E339CE3DBA75AEB857BA6BB92B0EA15632E9DCB096D02C812391896397CAE01CFBF7FD29228EDBC99A28E291812510BCBC8C71D87A8CD579AF04103B24A22907DD56C30247A1ED542DB52F26D442E47CA5995D47393CF3EBFF00D7AEAA6D5AECDB16E9F32503D42EEDBCFD0B4AD5D62D9E6DB24572BFDD940FBDFF00021C83EC2B1E48B730F9BF135D9DBDBA69F61633BA2CBA5CBA7C70DEC0092C0800A4AAA3D0B1071CF43DAB2354F0EC50C26EADF5185ED4F467608C3FDE071CFD2B4E5B9E5F37439A96DA75524292B8E86A84B76A73033E19141DBEDDAAFC881EE12C74D74B9BA9885DCADBC264819017A7B939AE72FC19BC4176518AADB46235211897200196E3A920939EF9ACEA41495BA9A53A8E0EFD07C8C4918E86AB4CC12EAD999B0BBC231F4527FA546F78570A4608F6AAB75319613EC322B9E29A91BD49A944B92C2D13B065C1048FC8E2ACDB22BC135CBC8479451557D7767F96289B51DB71344F18B8B4794C8A84E0A96E4953DABA6F03A41FDB17935849BADDECDB31C9FEB223B93E53EBD701BBFB54622A2A74A537D0785BD3AB192D51CDB346C731A103D09CD44CC33C8AEF9F494BFBA2ABA6A5C33B1E55029FA9231803D6ABDC78634DF3E3B78A0F32566DAC6195B6E7D0124E7DCD7931CC29F54D1F49F5D8B56B1C58C6DCFAD35ABD1A6F87FA2C3144E6EEF01901C2A3AB64FF00DF3D38358D79E14D390E21B9BC53DFCC0A47E80514F31C3CDE8DFDC57D769491C7518F98574327861149C5E923DE2FFECAA38FC32F2DDC56E974BE64AEAA9FBBE392073CFBD6EB1745F517B6A76BDCC7ED4C7E95D05F783B58B19194450DC20E924532E08FA1208FCAB2AE749D4ADC7EF6C675E339D848FCC5690AF4A4BDD92357569C95D48A34C979C56ECDA4D9ADD7D9AD9E69D81C6EE003F4E2A96B5A7A69D2C11AB166742CF93900E7A5385784A4A2B7395D684BDD46728C73DCD054120FA503AE0F5A53C0CD6AEE5AB588E524BF1DAB4D637B871E546CD95070A3D867F5ACC6EB5D76920BE890CB0E4491800E3F897BE47B107F3AC71151D38A662EBBA4DC92BDCE6B50B57825459170C5738CE7BD50FECDBAB9512C48AC9BB6F2E073F8FD456F7893E6BAB7900037C5F301C608383FE3F8D16B0EDD3A588A9E9CE7B6EFFF00557651A8DD18C99E2BA5F59AF372F53929032B1461CA9C11EF4DA7CE0FDA242DD4B127F3A6639AE94794D59D89AD5C453C7274DAE0D68CDA9010908C0B64E31F53CFE46B2D471498343572A351C55901E95DD78625FF008A6A756188A32AC4E0659998A8E7AF01323FDE6AE180C9AECFC253C3FD9515B0C873A9096520F58D63CFF46FD687B0A1B953C4A236BFB88C1C049CA648E38001FD41AC12BB58F20FB8E95A7A83BDC43E7CB70BB9DCBF94CBDCF24823FAD671E82A7A14F73E99B9F0DE87737F1DE416B0457F064A4D0AE08C82A7763AF7EB5CF6A5359C61629A5B8F22DDDADD6DA290A6F38C64B752473D3D39AB5A478D746B7D1A1CDBDC5A4823C98DADDB9C70097036F38EA4F7AA5AAEAF08B06D46168199B734A762B2C6BB8F3C91DC60E28A4D7B47DCEFC226A5692FD0E6A7D7EF6EB567BAB4963B38ADE368E38A404995460EC45C75E073C1EBEF5877B3DE5EC3BAE2E9CB48CCDBDDB6A1C7272070471D31D4818AEBE1D6AEDB4F7D563D3ED2D0C7F2452DDC7B4B0C02163E77BEE2DD381CF5AD61E129753D159F53BE617B3AEE05A30B1C4C71BB009CF2063279ADAECF53EB51A57D176D35678F4CD2020B444C28AC7CC43827EBD718C818A8DDBC9FB38B7B933A940C73085D8E472B9EF8F5AEF6E7E1D5C4C098AE04929244914078618C8CB1C0EA0718F4AA169E1978151E4B1F39CB6D5899B6B740471C753C75EE2B971355525EF2DCB4D622FEF5BD5946C34C115BA5EA5D2A4923305FDF18F05402D923D01FE5EA2AE4FAEDDC9A13C06E6E26F211309742292320B6318DB907D39C900D2DC06B29A6B48949312B202F089E1073B88248383D39C761DAB2A3D5A3862B6B3B88152CE39D5E678D3F78F93CFCDCF1ED8C74E2BD1855A538251B18578D2F64F99276EA1169E35183CEB9B3B0B684B105D62653C63E6EA78E7F4357ECACCD9DBA4165309212E4A3A9E198F0703F015A9A16A3A2EBB73716B0453CAB1379A96F3008F2C6013B5483824B0507FDE38A92DF4B962D457CE845B4D2BE57CC52AB0E4960403823A75C1FE75CB52845AE59A39709084A0DDF52AC37D6F133DB5C49B255E1A3788865F604F51F4C8AA0DA8FFA74462B901627FDCA150171FC4C41E483F955FF0012CD6F61A85AC56BE4DDEA023C5C2FDE401B6944DD900E077F7AABADC933DBAC62F6C036D56F212452C9850482C011804766E78E2BCB9E1E8D3E68A7623D95795A76BA233ACEA3A4DEBDC5BBABAC85A3FB3146C285E4382318DDBC9C0F5CD6941E2E84DA29266FB4DBC4A7E72A4AB747DA338E9D0F5C718AE1AEAF75316ED03090490CBBFCD5972366DFBA3D4739FF00F555CD36FE2B8B30D777E23DA7E7F31958938CF0A413CD27818CE29CB75D8C9D6946A34BEE64B797BE75D3DCA448ADBCB805460FD40C56ADD69BA73BD9CB6EF2A43323B18F782CBB86579C7239EBED59B358BEDDE23041DA707E5C83DFF9558B49192358DA66F2E050A109388CE5B2003D073DBAF34EA53708BE5DD1519D4DAABBA655D5B444FB13A416EB34EE400C5882BCE723D7A63F1AE6ECED52E2EA1B60D8F36454DE7A2827049AEC750D5ADEC953CC5691986E55519079FD2B9CF0D1924F14E9F1A07DEF380A23033B8E718CF1D6B6C2BA928FBE27C91BB47A247A75F5EE9D26A696CD2450CBE49485BCC638036951E8738F6ACFB936D6DA4DA5C6A378E925C426536D0BB1201760A38E390075AEEF53DBE13D16F1ED5944AB6E4652CF683237CBBD9BDD8FE95C368BA12EBDAD2DD6A93ADBE9F6D12AF2C32C157A7AD7A5A1C916F7636DED755BED06536D6D1C5637588923BAB865695558B1C151C0C9C927D0FA5656A5A75BD9595BA5C5CA5ABB47E5F936B1F9BB823B00CCCD82493BBA7602BA0D7FC59A60BB54D398C9F668FC98627188828C807A1F9B93F50706B8DD42F6EB52D40CF70C8CDCED555C01C938FCC9E4F3CD2764349B7A955B4AF34E21D4AC9C76136F84FF00E3C31FAD4F6DE16BB9AE225B811ADA16066B8866591513B92474FA9E2B7E5D134796CA29AC7594B9BA7DBBAD1ADDE29173D78E7A773D38EB529D26D2CAD8B9690BC9F202ADF28C83CB7A8ED8F7A4A371E873DAA89F5527504822B44DF1C091AC9E71DBB58EE25739C6DE78EEB8AD8F01FD9ACEF752F36E63595A048A3DC4AEF05B2C46471F7475F5A6C96DA24178E90AA2954F91D461D793CB60E0E7238ED8E3BD101922918C722A6636590EDDC4823181C7BF5AE2C6D352A324DEE7760A1ED6AA4D9D1DCEA676B5ADBCA8217FE18DB20907BF3C8EBDFF00953EC27090CCEB9F3DBF769FECA9EA7EA7A7B60FAD723341E4CD80EB2796B852A48C64F4F5E9DF1D454B0EA975147BE26941519DED26F18E31C30C57812C07BBEE33DA8619D57CB03BFB6924BABC97F7804168A1133C01DB3FA1FCEB3F521FBC0392715CDD9789B530ED1C9242F1B0CBAB4283763A6481EF4EBEF13DE96DEF05A48C7921518607E0D5CCB2EAAA5CCAD609E06B474B2344A9638C524928B678D6CA12D765F2CEEAA5B38C054F4193F8E2B9F6F12DC336FF00B3C0B818DA0B60FEB550EBF77B9D8471AE48391BB8F61CD74430956FA912C3CD2D4EE2DDAD228BCBB07DCC8009651139F3641C16DC78DA39000AA7786592D272D82C149183D6A0D13C456FFD970D84B15C2142CCCCA9E629CB139C0E475F4ED515C6B9A5C72B4533CE99EBFBA391F515CEF0F55547EE983A535D0156DF4D0429CC8E38635CFF0088430364B2F122C4EAE33DFCC6FE84557B8D56F65DC7CDDCA0E4131AE40EDCE2A0BC9DAE23B72F70D34810860CB809C9C01EB5EB61F0F284F9A4EE6AA9CA324D91CCA04ED81C601FD0535B95A9EF176DC2E7F8A28DBF345A8739CE3B577BDCE9A7F0911186AE97C377F0DB69FB6E2408BBD94704927AF41FEF5738C3269D1CAC88C83A16F5E95955A4AAC396463521CC696A72C3A9EA16F6F6C1BFD67961A420025980FC056A9D26EEE2EF66F85D5A541298A40C8A0B7F130E077ACDD1A136DADC12CB2340212CE240A4E180200FCC8AECB6DE36A8B652C3E4C118DD25C1942F999C9F9015218F6C81E809A5CFC9154E3D8F0B135DD0AB254F66721E29B485B5979D2D0431CAA0A80ADB4E38CA93D7B7424560CB0C6A301147E15DAF8920B25D2DD222B1CF04FB9635CB07078386E9C8F98FAEDEFD6B8F906E15D14A578AD4E6A6D4A24D6D691950C51791E9524D6D0F458933ECA296D5B118F614F7708EAEE9BD4104AE719F6CD68D9AB4946E559D638619115114BE031784875C7242FE99AEB2F3CDB7B28E3B99BCC9EDAC8C641E30D20E78F6DD8FC2B06E2E6576303C69E6478489100271C1C0EA3B0CD58D5B51D66E64F3754B2F237B12AE51937FAF07EBDBD6A6125638E93F7AC646A240118C7407FA7F8552DA760239156AF643244AC7E5392B8CE6A28580201EF5BC762E4B53D293C5BA6695772FD9ACEE8CA24C8CCC7C878F041DABDBD811F9572DABEED7B5748348304697771B4451B00A84804B119C81C9278E315DD6B7F0FE5B9BB11E9F6EAC029DCCB2F0AC3B1273CFF2CF7AC7B4F056BDA35E5BDFE9B6F70B73B8C4E63DA7CB5662A4E08C9E3E6EBD0F515D72C5D2B2F68D5DED7EE75622A2AD15CBBF52BF853C2B141E2FBCD1F54845DCB651C6D09DDC2962092149C7DDFCABBFBCD06E359BA8AEFCCB7B5B64272776F74C7F0F391D4648ACE7D0349BBD7535EB5D36E679C4B88D49237C83004FB4E3685C11CF5C74CE32DD4BC4E34BBE7896181A48088AE644EF81C6170727D718FD2B37555B98542A4A9691D19A26C2D3498A07B6BE06599731ED88B7998C91920F4249E78CE0761561E78E2D4653712CF6F7F25B994461C98D5571BB69236824E33F4159361AA2DFC4D704B6F7903A4C40CE42F1C7A0CD2EAF676FE2131F9A8BBE27270173BD707E53FA7F935F2399E64AA55F63F656ED773B553A935CCDDCBCBE21B49E249E657BA8E59591648C864048C9E470540E327FA573BAEE81A46A87FB463236C7217B98A4728F2E06D50071C64738C7038A9A3B058EEE2961DF1188BEF688852015C77041F4C1F5AD58F45B49C5A5B8B781510E6476524EC0A72376776791CE7B7E15C786C4428D7854E77ABFEAE57B3845DA6B45FD6C7396B169DA3C76CD368FF6769FFD54B12EF91D4E0F059B70206318F51DF8A8352D6DA2F363BFBE335A445CC2CF6FE5CCE47CA573DC9248C93C672791576E6CCEA974F7BA6C377796D02FC80DBB08CEDE305C36E63818240E4019E9542FF43D5758D2639868EEF1A399CDC4F9124D23704471750A720E0FF7735F7119732E6DCDABBA70A69C2CA5F97CBD0E6B5CD506AF225F294F36725A4C0C1E30A06327801703D706A9DB5CBE9F7D15C491C17181931390CACA4118E3BFF2AAD3DB15D4E45B52ABE57051982FCD8C1C03EF9FA56E47AADAC903DB6A70BB4A616512065DAAE7215B695238CE320F4E7A8AE2C552F6724D75D7CCDB078A788A566AD6D34D8A761A3DC6ADAA18202A90CD0B3E21209201E5033742038CE7B52EB5E1AB9D12E6349ADE648DA30C9E6AEDC9EE3238240C671EB5D4785B52D3F4FB296DE078EEAED622D12ECC29621B2406C1248C0E83391FDDA6EA1717BAD68B3A4F2469F6868E2F9FF74866EA4E49C7015B1FD735CD0C4D4A735A7BBFD6A615292556533839EEE6B4895619195048199571C91EFF00855FB1BB9354925F2A1B890BA8DED1E408F008FBA0F3DB93EF55B5DD0EE2C51662CE63E14873F77A74CF27273DB8ACA82E6E2C64DD6D2C91138CED3C363D477FC6BB7DA42B2E789C3560E527D0D0B892E2F0C71CBC04059063B1FF00F50A8B4A2D65E22B09A40488EE63621D88FE2F5EA2BA013DB6A3A745A84FE5FDA9836E08BB03303D00CFA01D00EB5833C52DBDD452B95621836F078241AD231515A183A7EEDFA9E9DE2D75B2F0E242A62796EAE5448D1DE3CA4E013820FA1DB5E737DAB4CA1ADE1958273F283C574BE34D762BCB6B27809C849253950A72CF8038FF00733F8D707B8E493C93572976338AB22D5B1667DCDC9ABC8733262A85B4A541ED9AD0B4BB821B9579D4B05E82921DF53A9B295AD13262DE36F2187159BAA6A0B2BB328C67A8ED45DF896268B6A285F71D4D624D78277C93C77C55B902EE4D6DF34BD49C924927249F526AEC17251262ABB999F3823000181EBCF4F4EF59F04885B28474E95A76E162B5572DB59BE7C8382467B7E46B9311670B1ECE5308BAD26D5EC882E2F66B998315C28E026491D31DFE9573ECEDE56D62BBA40BB0639607A15FC4118A8C0892D22C4443150C4E73C9009FE752DC17B476B69371D9964DBDC9008FA8E87F3F5AE25A687D250B3A6E50D3FE07FC12ADA49E4DC072015E8C0FA53EE2D9D629061815C2B291DF9F7F6A95B61855B18F3595C9EC3820FBFF00FAEA5567B612C6C49407E4249DA7B118CD29464B6D4588AB6A2A7B5CC59D4281C62991BC6B6D306FF58C005E33DC67E9F5A2519959473CD39E12225210E1C8018FAD696BEA72C9DD6E5BB131C91309541083B8EDC9AAB7907951A3739248273C7414E8461C9EA01EF53CC4496481C9C153960338E78C9FCBEB8F6A71D5955972534D143CDDB6C63C11BD86E20F51E956757B98A79ADFCA5C7EE89618C0049240F7E3193EB9A6BC39B5C6143021CB9E368C74FD73F9557BC89A330B96259C3673DB071FE34D2D4E39DAF71D76FB96DD8E326100FE0481FA014D8970B935160BEDCF45E2A42D81B4554B535A5EEEAC6B72DC50A324AF0324727B52F142AEE72338CA9A053D9B3A4D26E2CB4E9A68F51688621F91E442769DEBB48C0241C73F4E3BD6E5A58EA96ED25DCB7903C242CB90E76C8E704924EE00F246DCF2476181585A2EA8D69BB5079A1175242EA19CA1FE25CE4678EA31C7AF4EB5AA7C48AB6ABF606DB35B482389DD3E69411B72028DA8A7D1727A573D487BDA1F278DBFB56D8CBBD3ACD6CB538FFB35BED105BB8DE26012365DDB593B9C824953E83A9AE231D7AD76FA9F98FA7DCC77B7DE75C4367BE5F2225281C9F95739C82777278EA000315C7C8B5D187D62EE450D130B62781DBBD5B78A36D82452D193F301D48AAF62BF31CD58BB3FB97C76535BB4743D6363A5B1D0DF4B9A3BDFECC8AD9DE33892E2FA48E405810093F28519EC01CF6ACAD7BCBBA965B9B6899205B8688E642FFBC50371E7A03DBD793815A3ACDBCF764695A7D94524491AFEF6262738E7E4566C16C1C649E80E00AA9A85A3D9E80B6EE6E5A6572EF1CA63CC2A180CB04638CB31033D7B62B9237BDDBD4E0A4FDF473772A8D6EAA400E18FCDEDFE45522A53B1C76E2AF48B149F2CB26C50091EA4FA62AF41A3B5C585C5C5A42545BC2D25C48241B703A0C10304FA006BAD54B2B1AD5694EC7B5E970C9A66929610CB36EB7552EF3C9C163CB0073D3FC6A849E21923BF8266444B796DCBC7711BEE6625B6AAED3EA46723B0AE526F14B5F5CC5F632D345669C4B26764AC5BE61CF5C00BDBA8351E97A8C16B3CB757D3AC8891346567DCC73DB6F3807DB8EB5F3786C3CE58853AEEEFD5E87A3563CA9BB1D3B6A00191A78E37BB608270060C6AD952AAD9CE0F38EA32D9ACDBBD0CDCDC2CF0E9FF00B9624B6D7F947B633918AA2B6734D097B9D3ED8181FC94DEED233A7CA0024118EA70C0E7F2AE8F4AD30C37ED7366D32B7903E466CEC1BBEE924FCC3E53D7B1EC6BDBCCAABA387E6E872AA72934D94EDB4E92CA17C45B238D4B1C1E82B92BBF1CCFA76A426B48D5D51F3973807FCE6BB9F145C5D0D1EEB6DBC68C2325983648007381DB8AF09D424679DC76078FA57859561E18AE6A9515CF42AD6952A4925B9DBE99E39984AA268E30BE63396049073D037B0F5AF44B7BE86EA374DCD30946D7C6533EDD881F957CFB1128793D457B3F8721B8B4B5B6BC8E48E75312B1470490C40CE5877073EB5A66781A1071927CBA9742B7B783E75AA3A6BCD4ED6C341592299ED08531A42060FD71DB81915268DAD5DEA6C23DA640ABBE39B8008FEA71599A85DB5EC2F25D5A2CD014C38F2494563C07C7A8DDFE71552FB5EB6D1E13A8CE9318D1C2430C400677C705813F28C703233819C735F4B877074A2A0EE96866E3054DC5C7DE356FFC3FE107967FB6DAC105FC81AEA679401232EEF989CE40527F206B937D0E1D2EF3CE9F4A8A789A531DAAB46AD1600E646CF5F60703D6B166F107F6DDFF00DA6FF6C92CF2057870412A4632A4676803B73EB5DD594D0EA9A5DFDBCF711CA964AF197F3002E854B06C8E9B86E071EF5DD2872A526EE2A74FEAAAF2D535A8CD1F50D1258C58CDA635C0B82194DCAC7D18F550A30ABDC74EB9EF515C7876D6EDBFD04C70DBBB3ED6998324609C13B4B6319EC39256B364934AD16FEF7FB443CCED6F0A6FDC55D19932581041C0C819E300565269EE2F7EC1E6C8D6D0CC657329076360FCA1FB1E1C93EE3AE39E0AAA2E2DBD6C5C6929CEF1959312EA1881B8B45863BAB6F28DBACCEC8BBD9463701C71C823009E9CD71D75E15D4AD8318D44E1403FBBE783BB1C1E7F84FE63D6BB3B89EF915A48EFB9467323C722AEDCE189C001B1C2F2467E5E2B534D943D9AD8FDA21B691E6F31C19B8618F9558E719CEC1CE49C1EF5E760AA4554E46BE23D0C4E112A6A69FF005DD9E6F7491DAC714309B859234F99CB8DBCF5017191CE7B9CD5392662AA3AE4F248AE87C5F086D6DEE6084A2E1448A519406E9BB249C838EBD2B9EB992592460E1598800638F61D3E95E84BDD938A3CD542D49C9BD47DE5E0B85855D480B0AA9FAF393F8D4090AC8E006E3BFAD41A8298A61107DDE5A2827F0AAEB2B8C1079157177499E5CA5666CF9510C08C36475C8EB50499773C71DAAB2EA3383F3107EA2A65D4C1FBF1FE20D58B9931186074A44241A79BE85870A41FC298250FD101FC690E25BB51862FED5B3347B6D5304E7681CFE1D3F3FD2B16249828291B11E9B862BA65313C51A6D2EAC9B599875200F940C0F4C935CF5E4AC91F419449C3DA54B7423D2EE5A3750BB8327DD6550D8FA83C11FCAA4BB48E19ADCF983ABEEC2F0BFE3D7F9D4D6B145248638D712C9F22A8504313D075C0AA1A8387C0C0DCA58920FA9CE3D0639E9EB5C7747BD4E2AA5DC55AEB5F325674296FE585899417F98FA9CFF4FD69F7218C7B246DCE46494380724E3F0ED8F6A82240F23328C46065B3CF1F5AA372EF13CB0A9DB1BB64A03C1EE3FCFB5526DDDB2313453A70845EC5660D14B83C91FAD599948B68A5D9856C6076EBC8EB9F7A610B33812C98EC1B039FA9E3F3A9EE9D67610C2436D202053C64F181EBD17F5ABB599C6E4EE93F993584265292A8421092E84E33CE703D78C5559E1613184484230DC474FC08FF003D2AF69B04B0DCB8661E5720E3957E71FD73EB8AA9AA3A09A378D766E8F0C00C608247F203F4A4B47A97525269C53BAE836DB7CDBD339089F2B0E08E46066AB5EEF710C846118600CF700751D8E31FA55DF3ED60B765B7C9761EFC1E9924E3B1380077A6EA36EF1E9F6F2CC8D19958B46080370C724FFE3B8F5A69EA60DB6DB6B73381C629D9CF6A630040C9A0151FC59A76364DAD078C7A53A250D70031F94823E871C543BCF6A921611CA8CE3233CFD29A5A8A52528B48262B1471B82AA4C433938E726B5B4CBAB55BDD36C134EB79678640679E1690BCC700803FBA57FD91D4715BBF0D56D6F3C5925BDDC115C42F62D1A2CAA187CA53B1FA1AF52B6F0C787ED08306956C8E3387D9975CF04063C81EC0D69C89A3E6B1AB9AAFC8F21BF9A58F499522BBF25276DC6D5EE777EEB03841DFE72D96EA715CEBF4C57B5789BC2DA0C1E17D527B7D32149A1B59648DC124AB0438239AF17D8CE51139772157DC9E07EA6AA10E5D0E7A6924CBA8D0ADB5B4310F9D433CA7703966C60631C6028EE6A395816E795EE3A6477AEC3C7FA169BA0DCE9715843B2492161336E2770408AA79EFC9A87C0DE16B7F125D5EBDF34A96B046133136D2CEDDB383D141FCC53E5D2C5DFDDB985AC6A365A8DCC90593BD9B08B6C86694327CA09650557E61C00A7A924FAD1691EA1AAD95D3B41F66B6B3B591BCB8E231AB4A76E148FE26257DF1B457A2DE7813C39A2BFF00685AFF00699B90772C36F700176CF5C1E38CE7D0571FE23D70E931358DB40F0C41886985CAC8E58F04BE072C40EA093DEB3F67CBB19D2A493E696C739A469BA7EA77CEBA9DDC96F6B142656F2865DF181B578233CF7A75DDABE9EA2258A136832D03C52AB1CBE3EF3A7DE2002083900935B3E00D32E754F10E74CBD16C6088B492801B68EC3692320918FA7E15278F7C3ADE1D861B99351FB6ACED891F6AA9493927807F8B93F851CB3E6F214A29D4B9D64BE1FB2586DE0D3CC26D6DD9564311059FE5E87D5C9C73D79AC2D126B29FC5E902C3773C502171710021217190C587F1AFCC17278FC0E6B9ED77503A44B73A1689A94CDA7C536E2EFF007F7000150FFDD0738C63AF7A83C3BE20BBB2D55033DEDC5BCA36BDB5B37CD2B0FBA3A1EFC7AE338AE7C2E1152ADED252BAE9FF0004F49FB59525747AEDB5AA4B1C924DBC5B4FFBA8842870DD30E38FC78E0019AC4D3B57FB55CB43A7DACA3CF99772CBBF7B363919C7CA1496EDD066B55EF9E7B922FE2BB8B1023EE580C4AEC320A82DC81F301C7A135B16178E59218E240A00507AE00F7EA7F1ADF31C453A94DD2DEE62EA4B744779A7DCCB652430B4306F520861E616E3A12DDBF0AF1BF10781AEEDB5436FA77FA6076210211B875E1BDF835EBB77AA4D757F1DA5B0221915F7CC074DA06467B1F985589ED60686085AD4ED63C48011B001C9CFB0C7F915F2785AF5F0B36A11BAED62A2E2E36A9A9E27A3F81B50BA95A5BA884514332C72073D4924638E832304FBD7AFA69F79A7403ECB7515923E331B60A21F45623A55E5D3A3D36C9E0FDC48218CC8E87A91EE3F0AE6351D734E9F4BBA587540F0DBB7EFACA465DF1156E9EA46471D4574E2A38DC44D29C1A5D34EE3F694E2B961A2F3EA26B365A9D84F1EA505D97748DD32262D248CDC9D8B8206303800719AE1EE1EFB546637123DCA21C82CBF364E724903AF3CFE1449E267D25DAEB4B9D8EF1F346D10FDDA93BB8C93819ED8E727BD54D53C7135F2B3C164B09258A15F94236E38E390DF2E01E99E9D857AD4F0B89A0B93FE00E9578CE374570B1C44BBA162849C8240E3BF4357FC2DAD258DEDDA484C36F7B1BA48E32C06410A71C9C8C9EFDFDAB12D6E26D4A678A255495958AEE90007B91935A634D9EDA210BA1C11921583038EFC57ACEACB9527D0CA55E4ECA5176342DA39EF351CDCDB193CB76690A37CBD78E7A60738F5E2BAB1ABDBDBDBA3C2034FBFCF56DB93BC02141CE38E4935C6D86A6B60E90C9E63191F68F403D49ADF8EE2DCAB48DB6340BFF3CC927D81CD71627112A4D282DCD9CA351F9238BD5356BAD3AE1ED4246CA25591D648F3E61C0233EDF4EB52E99E2F96CE460D628EC549DACE76990803791EB8CFB826A2F19B413EA693C1D4C2A25FF78640FD00AA5A5E96FAA096E6494010150CBBD559B3C00A3FAFB57651A70F66A6959FEA724F17579E49CAE8D6826975AD41E4B863B1DF749F31F9B8E7FF00AF54B59B34B3BB6681CFD9CB068F2391FECE7D056AD85A2D95D3C2EE8C5628D9B61CE09CE73EFF00D3159FE25BBB3689E10C1A78E5C22A9FB9EB9FAF1FE45725A4EB1BCB10E51B7439FB90184B248D97DEA13FDDC1FF00EB5551534CDBE257F7C1A856BB61B1E6CF71D41A00A0D510255EB08CB23363BD5115BB616FB6D621839652DC0F5FFEB62B1AD2B44EEC153E6A8DF646D687622381EE2541B132E41FE2C0E07E78FCEAFB4F1C7688AAEB85C96031ED8E3FC9AB33DB9B6D34DBA9F9827247AE3FC6B316C4CB26D5E7602CED8FA74F5EBD6B92B24EDE47D165B4632A727276D476E8E684F2324602E3BE6AADC284650BD0A8239CF6AB0F17913B45B909070195B201CF0722A4BC46B9469C01BD5B0CA0638C803F9D65F12D0FA3BC68A8A4FDD7FD2234731E9E5D90B27DC1E99CE707F9F4AC9999A7937672C464E3B01FFD615A45A2B67C499280A96DA339C60FF88A2FEDD62816E11B38501874DD9FE947324ECCE0C4C942697732A38DA5B858CE01CE09EC3DEA69ADE586D7CD1B4C6CC17703C8EB8FD2A283CC69F7445C37246D3CF4F5A74B3B3C011C866DC0A93D40E73F9E47E556EF739DA95B42FDB3326F7196474E55704E31CE3278AA5A9C8649558C650738C8C16E4F27DF39E9535B4ED1C4E9B7248E3DB8C53B5484B4492AB0651961824FCA4F1F4C703F1A69DD8E7054E2AFBB23B2B44B90A9B943BBE07CE06063DFDF1CFB1AB17D6B0C3A2EF57333EF52AEEDCAA64E303B03541611E42C921F919B0477FF003D696F1A69ED83C84055195058927A0EF93DBE94B95B6B530A89BD532A30DC3148231F5A55C91D29DD0D6BB0F953D588A9CD48301D4FA1A4CF14D638755F5CD25B96D28C4D8D11750B7D460FECF774BB3298E06460A5CB6E5C02780383D7D2BB8820F1A1247F6D246475DF788D8FC81AE134FB99D0DB94730DC594C258DF3D589DC3AFF9E6BB28BC45ACAB02BA81DD9ED6F10FE4B5D74ED63E631AA5ED2E58D713C5167A35D3DDF8861B9B7781C3C48BBB7A104119D9FAE47D4579E47751586A76B7333111413C72395193B5581381DCF15B7E37F11EAD2DBC56125E7CF26269079683E51F74703B9C9C7B0F5AE29DAF2E206B9688343138566E8371E83F4AAB1C9CC92B1E8BE3BD663D675B5960575860815143E324B7CC4F04F62BF95751F0E6EE38BC331436F12EF792492E24772A376EC63A1FE10BDEBC7535BCA98E588AAAA80A579CFD6BA3F014C2E92F6094A2C476CACECA5B0FD0281EE013F852E56573A692476DE2CF06DBEB7782FEE3559639B68045AFDD240EBF331C7D062B274EF02E811306B9B4BCBF7F596F0203F82807F5AB6FA428F98BA229E85E3D99FD291B4D10A7992DCC28BD8972BFCC5315EE5B5D2741B67D91F846DD32305BCD74DC3DC9C66AE43A77859417BAD02CD07FB113CE3F4E2B9E12C319EAF2771E5CDFFD63552F7C5B069EAD1AC105CCE47CB14EED2E0FB8CF1FA509362BA470AD2A236082573C83DEBAAF87D66D378B619E05778ADCB6E950709952A39FA93F9555F0BE94BA8EB78BB8C39B26DF242EB9DD852C411EC5706BD66C2F2CD7E6B19E0B6D46305DED57012E133C12077FC723B8A3D9A94753DBAB55D9A8EBFA1AD73159DB46D2DC5C2CC0F0B1B9CEF6F4C77ACF8E796F330958E113FC8E63C86C13D8E78ED55FEC2C1EE2FE0D54C0939DC2131AB431C80609C1E7271CE3BE7D6AC0D56DF4DB6966B9B61F6D50445147F30958775AF071547D9D449B4933CC8C64EEAD7655B2D5AC60920B44532496C924B22ABF0D27036FB9C64E3B63EB5735998DB59CF7CD7AD14AD11096D24DF2487D94649FC2B0B4854984929F2C5D094CD34BB72D1B1C9F97A639DDFAE6B2755F1143616922BC7236A9728CE66BA559362B47F2EC23B7518ED927D2BDBC1CA1ECB9FB9D3470B34F55ADCBB15E6A373A8CD236C71322234EACC5191D32BB54919395C7D01AE7A1D0BC3B6FA9DEAF89E63B06D305D42CC509E77AB05C9DDD38FAD3F4990DA45F63B7324D2BEC7B68D9B32190E421038DA361C303C118E99AAFA94F14BA8CC8136CB28067802F2920521948EE463F5AE85512BBDAFA1B6368D3A8B99E96DBFE18C5F11DD6902E2E6C74B964160930740EAC1D988C13CF5C1CFDEEC063AD736D208881192D8CF2062BB1B1D32C678A06FB645E6CD22C489245CC649032CC010179CE7F4ACBD6F40B886F8A41B19492777036FB7BD456AFED649BE8AC79585A8A941C5E9D6FEA645AA191B76D27B0FAD6B8B49ACADD259AD8C6B33155919792570481FF007D0E69905B4B60D6E41004443B483AEEDC4E07E5D687B96BB32BCD2B640C20396F418FCBF9571546DB3EA702E9D4A4A4B5F55F78F33F944A5A45B848399240371E3A63EA4D4D6FAB5C08D2D6E5C240702478C7EF4A81D173C027D6A2B10165886158CAFB012DC03DB3E99355F25AE642D0891D5598236406C7AFB63F95549FB44B9F5B1CD568D38CE56D8D3D7249EFECADB6D80B3D3A15CC31EE04BE73FBC3FDE279E7DAB367F26CA1926B47574276E4AED6C1C8E956AF7C4D75A8BAC8D14502C56A96B1C69B8854008EE49EE6AB466CCE91732CD6ED713223A637E0465B1B1C0FAE41FC38EF5D146EFDD91E5E2A92F65CF6B32B26AAE71B77179080D82492781F9702A85C5A4CED2CA107DF25B1DB9FFEBD43119233E70C7CAE39CF7EBFD2BA29D192CA22032F9A03C8A7F88B7CDFA56EE8C53BA3870F175138F6398976AC61013C1CD443AD5FD56DD20914A701B9C67247D6A9C6061B3D71C54256329E92B0838A434B49475207C5134D3244BF79D8015D1CB2C48C155C2ED181838E3A562E943FD390F0300E0938ED5BA74E59E472D30882AF04A9218E09C67E83AFBD73568A96ECF4F0753D945C96ECD6B4D5E3BFD3658DE6FF004A8936EDC7FAC1D011FD7E945BCEC26F9CE32BB7DBA83FD2B1F47B77FED6640A41F2BEE75CE79EA38C715D07F645E3C7E6471F9AA1410CBD1B8EA0D73D55CACFA6CA9D278792AAEDCCD8DBAB6112C8DBB76ECB64AE0AE31C7E3BBF4A92DE0709E7EE7669E1C1DDEE3E53FCC54D7329B3D3DAD48F300427E724EDE401F4C120E39EDEB4CB999E3B5B76556658E25542A700EDE32C3B80DD39C73EF595D45D99DB3756A41453EBBF7280756BB996470B952A0C9C927217F3A83507305B1854398C0D819B07FCF4EC288A548EE3CF9AD85CC71AEE750D8C72064F5E734CB8BA8A6023DE64DEBC92B820FD3D7E956B5D0E4C6A97B54D2BA454B219242F0C78FF00F553E58D5645922E5493B4921BA77FFEB7D69B67016BB8D33C6E0491E839CFE54EBC7F39559721460E092727804FE7D3F1A684DEA92EA4905B9915513990AEEC67B633FCBF95325BA416DF29CBEDD9B31EF9273E9D78F7ABFA73C5340540C5C2AE01190718C6476E9EB55A7516F7574ACAA1BCB52B8E84903F9E6946C98EBD4E6A7CB25AA1B6B2878FE40C48001000C81DF1EBD3A7BD56BEB91E534283E556C03BB8C6738C7F9E956ED62FB359B990806521320F63C75FC49FC2A0D4A077B5F3815090A8423232793C0C75C03FCA9ADCE7728D9B3351F284E2A4DC190115146A3667BD3D08208C74AB7B9706EC931E0E45452B6274FA548BD6A29BFD667D285B8EA37C85E91668600FE638490231507861CE33F42B5A5732CD6F6AD3BCAE140192ABB88CF7C77ACB924DD65C9C9E1473D00C9FEB5D3595BABC485EED61C28C6E5763D3D81AE8A5D4F13315B3F367092FDB6EEE256549AE3731F9FCB393E9F4E2B52F66787408EC96DA4091ED676F2F186CF249EBD4FF002AEB6485863CBBA128ED8257F438359F77E1D5BB99A69EDEE417037619955B0302B63C8B338DD89E42223AB191B1C1E7F1AE8F47985A25CC302FCBF683827AE0018AB89A169D011B34F01C7F13C8C4FF003C55A8ACB3D1028FA502B091DF4EA49039F5AB716B7A9423F75388F3D76A2F3F8E2A17B709D698220C78FE540EE3EEF52BEB8B7923F3625775203792A3048F50335CE0D2B5053F2476AA08C70E71F5E95D06D51918C91ED4F556CE76E7DA80BB1DF0DFE6F135D3B72FFD9F21DC7AE491935766263F181D876FFA576E3B51455D3F851F4196FC53F43B6B9455D1F572140F2D6464C0FBA7D47A553B6026D46E1A51E614891D4B73B5B3D47BFBD1457CF673B47E66347ED7F5D8CCF364FECCD53E76FF008FEC75EDE40E2B0BC59F3DCEE7F99BCB9064F271B734515D9977FBBFF5D91D74BF88FD5FE865F856799F5D7B8795DA616F29121625B3E59E73D6B4749246A5A5B0FBD2E9E7CC3DDFF76C79F5E403F80A28AEE7B238F31F857C893508A389E258E354063048518C9E6A85D924924E4ED1FC85145673F8D9F3953E27F231AED8985724FDE1FC8D52E80514515BE23EBB2DFE0FDE3666616E006230EC783DF02B735A0175342A31BAC232D8EE4C4B93F8D145664BFE21CFCCC4A124927763356222469B72A09C35BB961EB82319FA51457552F88E3C5FF0DFA98E7FD5A8EDCD7697631A6B01D030C7B7228A2BB0E3C17C3238FD5FFD6A7D2AA4233E667D28A2B07B9C753E2634F4349DE8A2A483434903ED1371D216C7E957226637576A58E3ECCE319A28ACA5B9DD4BE044FA33B334ACCC491101927B6D1C574771713476F6FE5CCE9B146DDAC46DF901E3F1A28AE2C4FC47D365C93C3C3FC52FC88E525EC3CD7259DA61B98F24FC99E4FD6A3809314A0924608FFC75BFC07E54515CF23DE5FC25EA578C03657F903A27F3ACEFEF7FB868A2B7479D53E29FA9B5A7124DBA1E578F94F4EA6B290068E3C8CE4F39EFF33514559E653F8A468E8DF7243DF7019F6E6AB6A3CDD313C91691907DF68A28ACCEDADF1941199D977B16E40E4E78AD6F122859A5550028B45C01D07EF28A285FC45F330C47C2BD0C08A9E9F7A8A2B565C364151CBD4D14520A9F09245CB203D315D859FF00C79C1FF5C93FF4114515D34B7678B996E8948182702A2F31C1501D80F634515B1E4F41E093C9393566D649226CC6EC873D54E28A28E805B9DDA44CBB1738EAC7354D5573F7474F4A28A68996E48D1A7944EC5CE3AE2ABAD1451D40FFD9','IMAG0008.jpg','image/jpeg','2014-07-02 16:25:06','2014-07-02 16:25:06');

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
	(1,2,0,4,NULL,'I am good.\r\nPls hire me.','2014-07-02 16:25:06','2014-07-02 16:25:06');

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
	(8,2,0,'2014-07-02 16:25:01');

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
	(1,2,'NANYANG TECHNOLOGICAL UNIVERSITY','Bachelor in Computer Engineering','First Class Honor','2014-07-02 16:25:06');

/*!40000 ALTER TABLE `tutorschool` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tutorstatus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tutorstatus`;

CREATE TABLE `tutorstatus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tutorId` int(10) unsigned NOT NULL,
  `tutorStatusCode` int(5) unsigned NOT NULL DEFAULT '0',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tutorId` (`tutorId`),
  CONSTRAINT `tutorstatus_ibfk_1` FOREIGN KEY (`tutorId`) REFERENCES `tutor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tutorstatus` WRITE;
/*!40000 ALTER TABLE `tutorstatus` DISABLE KEYS */;

INSERT INTO `tutorstatus` (`id`, `tutorId`, `tutorStatusCode`, `modified`)
VALUES
	(1,2,0,'2014-07-02 16:25:06');

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
	(6,2,163,'2014-07-02 16:23:58'),
	(7,2,170,'2014-07-02 16:23:58'),
	(8,2,177,'2014-07-02 16:23:58'),
	(9,2,190,'2014-07-02 16:23:58'),
	(10,2,191,'2014-07-02 16:23:58');

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
	(1,'admin@tuitiondb.com','$2a$13$XJlAImIwwj7GAxBs.MLwFOKBtrXvGnGdGGPhh8Ab9IAQD0WJFBA86',0,0,'ab7edc4d6780df66ca8db8feb19b1d188d67b77a','2014-06-25 12:48:25','2014-04-16 03:45:35','2014-06-25 12:48:25'),
	(3,'mark.qj@gmail.com','$2a$13$EmufPT/FKonKy0xquKmPoebHhW7jXMIfOnNzrARr1W5F3zMZvaU6q',1,1,'r2rsjic87i2usg1lfnq700qq21','2014-07-02 16:27:09','2014-07-02 16:23:58','2014-07-02 16:27:09');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
