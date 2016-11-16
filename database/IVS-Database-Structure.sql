-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 192.168.224.81    Database: ivs
-- ------------------------------------------------------
-- Server version	5.1.51-community

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
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assets` (
  `asset_id` int(11) NOT NULL AUTO_INCREMENT,
  `ptag_code` varchar(45) DEFAULT NULL,
  `otag_code` varchar(45) DEFAULT NULL,
  `comm_code` varchar(45) DEFAULT NULL,
  `asset_descr` text,
  `serial_num` varchar(45) DEFAULT NULL,
  `stat` varchar(45) DEFAULT NULL,
  `pohd_code` varchar(45) DEFAULT NULL,
  `orig_doc_code` varchar(45) DEFAULT NULL,
  `active_date` varchar(45) DEFAULT NULL,
  `cap` varchar(45) DEFAULT NULL,
  `cap_date` varchar(45) DEFAULT NULL,
  `orgn_resp` varchar(45) DEFAULT NULL,
  `fund` varchar(45) DEFAULT NULL,
  `orgn` varchar(45) DEFAULT NULL,
  `locn_resp` varchar(45) DEFAULT NULL,
  `net_bk_value` varchar(45) DEFAULT NULL,
  `acct` varchar(45) DEFAULT NULL,
  `acct_title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`asset_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4705 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachments` (
  `attachmentid` int(11) NOT NULL AUTO_INCREMENT,
  `reorderid` int(11) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `url` varchar(45) DEFAULT NULL,
  `id_field` varchar(45) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `dateadded` date DEFAULT NULL,
  `value` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`attachmentid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `unitid` int(11) DEFAULT NULL,
  PRIMARY KEY (`categoryid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `disbursementrecord`
--

DROP TABLE IF EXISTS `disbursementrecord`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disbursementrecord` (
  `requesteditemid` int(11) NOT NULL,
  `quantitydisbursed` int(11) DEFAULT NULL,
  `comments` varchar(45) DEFAULT NULL,
  `datedisbursed` date DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `disbursementuuid` varchar(45) NOT NULL,
  `requestid` int(11) NOT NULL,
  PRIMARY KEY (`disbursementuuid`,`requesteditemid`,`requestid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `edithistory`
--

DROP TABLE IF EXISTS `edithistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `edithistory` (
  `historyid` int(11) NOT NULL AUTO_INCREMENT,
  `inventoryid` varchar(45) NOT NULL,
  `userid` int(11) NOT NULL,
  `event` varchar(45) DEFAULT NULL,
  `oldquantity` int(11) DEFAULT NULL,
  `newquantity` int(11) DEFAULT NULL,
  `oldmin` int(11) DEFAULT NULL,
  `newmin` int(11) DEFAULT NULL,
  `oldstatus` varchar(45) DEFAULT NULL,
  `newstatus` varchar(45) DEFAULT NULL,
  `oldsnum` varchar(45) DEFAULT NULL,
  `newsnum` varchar(45) DEFAULT NULL,
  `oldname` text,
  `newname` text,
  `olddesc` text,
  `newdesc` text,
  `oldcat` int(11) DEFAULT NULL,
  `newcat` int(11) DEFAULT NULL,
  `oldcomments` text,
  `newcomments` text,
  `oldshelvingid` int(11) DEFAULT NULL,
  `newshelvingid` int(11) DEFAULT NULL,
  `dateoccurred` datetime DEFAULT NULL,
  `reasonforedit` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`historyid`)
) ENGINE=InnoDB AUTO_INCREMENT=287 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `eventid` int(11) NOT NULL AUTO_INCREMENT,
  `eventname` varchar(200) NOT NULL,
  `location` varchar(45) DEFAULT NULL,
  `edate` date DEFAULT NULL,
  `efrom` varchar(45) DEFAULT NULL,
  `eto` varchar(45) DEFAULT NULL,
  `presenter` varchar(200) DEFAULT NULL,
  `formid` varchar(20) DEFAULT NULL,
  `registration` varchar(45) DEFAULT '0',
  `details` varchar(1000) DEFAULT '0',
  `uniqueurl` varchar(300) DEFAULT NULL,
  `advisories` varchar(500) DEFAULT NULL,
  `objectives` varchar(1000) DEFAULT NULL,
  `capacity` varchar(45) DEFAULT NULL,
  `remaining` varchar(45) DEFAULT NULL,
  `cost` varchar(45) DEFAULT NULL,
  `targetaudience` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `contact` varchar(2000) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `code` varchar(45) NOT NULL,
  PRIMARY KEY (`eventid`),
  UNIQUE KEY `eventcode_UNIQUE` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory` (
  `inventoryid` int(11) NOT NULL AUTO_INCREMENT,
  `unitid` int(11) NOT NULL,
  `shelvingid` int(11) DEFAULT NULL,
  `quantityavailable` int(11) DEFAULT '0',
  `minimumquantity` int(11) DEFAULT NULL,
  `flag` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `stocknumber` varchar(45) DEFAULT NULL,
  `name` text,
  `description` text,
  `categoryid` int(11) DEFAULT NULL,
  `comments` text,
  `dateadded` date DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`inventoryid`)
) ENGINE=InnoDB AUTO_INCREMENT=1893 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `locationid` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(145) DEFAULT NULL,
  `description` varchar(145) DEFAULT NULL,
  `locationcode` varchar(45) DEFAULT NULL,
  `unitid` int(11) DEFAULT NULL,
  PRIMARY KEY (`locationid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `loguuid` varchar(45) NOT NULL,
  `tablename` varchar(45) DEFAULT NULL,
  `fieldname` varchar(505) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  `unitid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `querytype` varchar(45) DEFAULT NULL,
  `fieldvalue` varchar(505) DEFAULT NULL,
  `idfield` varchar(45) DEFAULT NULL,
  `idfieldvalue` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`loguuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `quotes`
--

DROP TABLE IF EXISTS `quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes` (
  `quoteid` int(11) NOT NULL AUTO_INCREMENT,
  `reorderid` int(11) NOT NULL,
  `supplierid` int(11) DEFAULT NULL,
  `quoteurl` text,
  `quoteamount` varchar(45) DEFAULT NULL,
  `deliverydate` date DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `selected` varchar(3) DEFAULT 'No',
  `title` text,
  `note` text,
  PRIMARY KEY (`quoteid`,`reorderid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `receiverecords`
--

DROP TABLE IF EXISTS `receiverecords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receiverecords` (
  `reorderid` int(11) NOT NULL,
  `recordUUID` varchar(45) NOT NULL,
  `itemid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `qtyreceived` int(11) NOT NULL,
  `datereceived` date NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`reorderid`,`recordUUID`,`itemid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reorderhistory`
--

DROP TABLE IF EXISTS `reorderhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reorderhistory` (
  `historyid` int(11) NOT NULL AUTO_INCREMENT,
  `reorderid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `comments` varchar(45) DEFAULT NULL,
  `dateoccurred` date DEFAULT NULL,
  PRIMARY KEY (`historyid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reorderitems`
--

DROP TABLE IF EXISTS `reorderitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reorderitems` (
  `itemid` int(11) NOT NULL AUTO_INCREMENT,
  `inventoryid` int(11) DEFAULT NULL,
  `comments` varchar(45) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `reorderid` int(11) NOT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reorders`
--

DROP TABLE IF EXISTS `reorders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reorders` (
  `reorderid` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  `dateinitiated` date DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `comments` varchar(45) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `unitid` int(11) DEFAULT NULL,
  PRIMARY KEY (`reorderid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request` (
  `requestid` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  `comments` varchar(45) DEFAULT NULL,
  `requestorid` int(11) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `datereceived` date DEFAULT NULL,
  `unitid` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `onbehalf` int(11) DEFAULT NULL,
  PRIMARY KEY (`requestid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `requesteditems`
--

DROP TABLE IF EXISTS `requesteditems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requesteditems` (
  `requesteditemid` int(11) NOT NULL AUTO_INCREMENT,
  `requestid` int(11) NOT NULL,
  `inventoryid` int(11) NOT NULL,
  `reasonforrequest` varchar(45) DEFAULT NULL,
  `quantityrequested` int(11) DEFAULT NULL,
  `quantityrequestedremaining` int(11) DEFAULT NULL,
  PRIMARY KEY (`requesteditemid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `requesthistory`
--

DROP TABLE IF EXISTS `requesthistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requesthistory` (
  `historyid` int(11) NOT NULL AUTO_INCREMENT,
  `requestid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `event` varchar(45) DEFAULT NULL,
  `dateoccurred` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `comments` varchar(305) DEFAULT NULL,
  PRIMARY KEY (`historyid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `settingid` int(11) NOT NULL AUTO_INCREMENT,
  `unitid` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `settingtype` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`settingid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `shelving`
--

DROP TABLE IF EXISTS `shelving`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shelving` (
  `shelvingid` int(11) NOT NULL AUTO_INCREMENT,
  `shelving` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `locationid` int(11) DEFAULT NULL,
  PRIMARY KEY (`shelvingid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppliers` (
  `supplierid` int(11) NOT NULL AUTO_INCREMENT,
  `suppliername` varchar(205) NOT NULL,
  `address` varchar(500) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `email` varchar(205) DEFAULT NULL,
  `contactperson` varchar(45) DEFAULT NULL,
  `dateadded` date DEFAULT NULL,
  `unitid` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `comments` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`supplierid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `zcore_pages`
--

DROP TABLE IF EXISTS `zcore_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zcore_pages` (
  `pageid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `url` varchar(45) DEFAULT NULL,
  `rendername` varchar(445) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  PRIMARY KEY (`pageid`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `zcore_permissions`
--

DROP TABLE IF EXISTS `zcore_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zcore_permissions` (
  `permissionid` int(11) NOT NULL AUTO_INCREMENT,
  `roleid` int(11) DEFAULT NULL,
  `pageid` int(11) DEFAULT NULL,
  PRIMARY KEY (`permissionid`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `zcore_roles`
--

DROP TABLE IF EXISTS `zcore_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zcore_roles` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(45) DEFAULT NULL,
  `description` varchar(425) DEFAULT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `zcore_site`
--

DROP TABLE IF EXISTS `zcore_site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zcore_site` (
  `siteid` int(11) NOT NULL AUTO_INCREMENT,
  `site` varchar(10) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`siteid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `zcore_unit`
--

DROP TABLE IF EXISTS `zcore_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zcore_unit` (
  `unitid` int(11) NOT NULL AUTO_INCREMENT,
  `site` int(11) DEFAULT NULL,
  `unitname` varchar(45) DEFAULT NULL,
  `store` int(11) DEFAULT '0',
  PRIMARY KEY (`unitid`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `zcore_users`
--

DROP TABLE IF EXISTS `zcore_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zcore_users` (
  `userId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) NOT NULL,
  `ldapUserCode` varchar(50) NOT NULL,
  `userActive` bit(1) NOT NULL,
  `isAdmin` bit(1) NOT NULL DEFAULT b'0',
  `unitid` int(11) NOT NULL DEFAULT '0',
  `usertype` varchar(45) NOT NULL,
  `email` varchar(105) NOT NULL,
  `staffname` varchar(45) NOT NULL,
  `site` int(11) DEFAULT NULL,
  `roleid` int(11) DEFAULT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `unq_ldap` (`ldapUserCode`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'ivs'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-16 15:03:21
