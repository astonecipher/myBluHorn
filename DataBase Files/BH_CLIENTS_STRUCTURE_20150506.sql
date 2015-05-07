-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: 174.143.132.245    Database: 649984_bluhorn
-- ------------------------------------------------------
-- Server version	5.1.70-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `BH_CLIENTS`
--

DROP TABLE IF EXISTS `BH_CLIENTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BH_CLIENTS` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `agencyID` int(11) NOT NULL,
  `name` varchar(128) NOT NULL DEFAULT '',
  `address` blob NOT NULL,
  `phoneNumber` varchar(32) NOT NULL DEFAULT '',
  `faxNumber` varchar(32) NOT NULL DEFAULT '',
  `contactName` varchar(254) NOT NULL DEFAULT '',
  `emailAddress` varchar(254) NOT NULL DEFAULT '',
  `notes` blob NOT NULL,
  `website` varchar(254) NOT NULL DEFAULT '',
  `isActive` tinyint(1) NOT NULL,
  `status` varchar(32) NOT NULL DEFAULT '',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `source` varchar(32) NOT NULL DEFAULT '',
  `refID` int(10) unsigned NOT NULL,
  `bgColor` varchar(8) DEFAULT NULL,
  `fontColor` varchar(8) DEFAULT '#fff',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=100346 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-06 23:27:16
