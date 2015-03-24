CREATE DATABASE  IF NOT EXISTS `snpf_inventory` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `snpf_inventory`;
-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: snpf_inventory
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.13.10.1

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
-- Table structure for table `computers`
--

DROP TABLE IF EXISTS `computers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computers` (
  `comp_sn` varchar(45) NOT NULL,
  `comp_name` varchar(45) DEFAULT NULL,
  `comp_type` varchar(45) DEFAULT NULL,
  `comp_os` varchar(45) DEFAULT NULL,
  `comp_monType` varchar(45) DEFAULT NULL,
  `comp_monSerial` varchar(45) DEFAULT NULL,
  `comp_ip` varchar(45) DEFAULT NULL,
  `comp_user` varchar(45) DEFAULT NULL,
  `comp_status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`comp_sn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computers`
--

LOCK TABLES `computers` WRITE;
/*!40000 ALTER TABLE `computers` DISABLE KEYS */;
INSERT INTO `computers` VALUES ('H9900','Bristo','Desktop','Windows Server 2003','LCD','K78343','147.110.192.25','mandlas@snpf.co.sz','Pool'),('Hf6894543','Bristoss','Desktop','Mint Linux','Flat','M89765','147.110.192.10','brian@snpf.co.sz','Pool'),('HGLSD908','Test2','Laptop','Windows 8','NA','NA','147.110.192.6','mahles@snpf.co.sz','Pool'),('ppp','kk','Desktop','Windows7','jj','jj','147.110.192.25','nana@snpf.co.sz','Pool');
/*!40000 ALTER TABLE `computers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `division`
--

DROP TABLE IF EXISTS `division`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `division` (
  `iddivision` int(11) NOT NULL AUTO_INCREMENT,
  `divname` varchar(45) DEFAULT NULL,
  `divmgr` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iddivision`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `division`
--

LOCK TABLES `division` WRITE;
/*!40000 ALTER TABLE `division` DISABLE KEYS */;
INSERT INTO `division` VALUES (1,'Finance','Mfanizile Sithole'),(2,'Customer Services','Mels Sukati'),(3,'Corporate Services','Max Hlophe'),(4,'Operation','Lwati Hleta'),(5,'Marketing','Brian');
/*!40000 ALTER TABLE `division` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `floors`
--

DROP TABLE IF EXISTS `floors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `floors` (
  `idfloors` int(11) NOT NULL AUTO_INCREMENT,
  `floorname` varchar(45) DEFAULT NULL,
  `floornum` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idfloors`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `floors`
--

LOCK TABLES `floors` WRITE;
/*!40000 ALTER TABLE `floors` DISABLE KEYS */;
INSERT INTO `floors` VALUES (1,'Service Center','0'),(2,'First Floor','1'),(3,'Second Floor','2'),(5,'Third Floor','3');
/*!40000 ALTER TABLE `floors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leasd_printers`
--

DROP TABLE IF EXISTS `leasd_printers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leasd_printers` (
  `p_serial` varchar(45) NOT NULL,
  `p_model` varchar(45) DEFAULT NULL,
  `p_ipaddr` varchar(45) DEFAULT NULL,
  `p_location` varchar(45) DEFAULT NULL,
  `p_floor` varchar(45) DEFAULT NULL,
  `p_supplier` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`p_serial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leasd_printers`
--

LOCK TABLES `leasd_printers` WRITE;
/*!40000 ALTER TABLE `leasd_printers` DISABLE KEYS */;
/*!40000 ALTER TABLE `leasd_printers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loc_printers`
--

DROP TABLE IF EXISTS `loc_printers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loc_printers` (
  `p_serialno` varchar(50) NOT NULL,
  `p_model` varchar(45) DEFAULT NULL,
  `p_name` varchar(45) DEFAULT NULL,
  `p_comp` varchar(45) DEFAULT NULL,
  `p_description` varchar(45) DEFAULT NULL,
  `p_status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`p_serialno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loc_printers`
--

LOCK TABLES `loc_printers` WRITE;
/*!40000 ALTER TABLE `loc_printers` DISABLE KEYS */;
INSERT INTO `loc_printers` VALUES ('GHK789','P666','Test2','HGLSD908','Test','assigned'),('H500','HP200','GM Finance','Hf6894543','Black','assigned'),('j67544','P900','Test','H9900','Personal Printer','assigned'),('K400','HP300','GM Ops','none','Stripe','pool');
/*!40000 ALTER TABLE `loc_printers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `op_system`
--

DROP TABLE IF EXISTS `op_system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_system` (
  `idop_system` int(11) NOT NULL AUTO_INCREMENT,
  `osname` varchar(45) DEFAULT NULL,
  `osvendor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idop_system`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `op_system`
--

LOCK TABLES `op_system` WRITE;
/*!40000 ALTER TABLE `op_system` DISABLE KEYS */;
INSERT INTO `op_system` VALUES (1,'Windows Server 2003','Microsoft'),(2,'Windows Server 2008','Microsoft'),(3,'Windows Server 2012','Microsoft'),(4,'RedHat Linux','Redhad'),(5,'Oracle Linux','Oracle'),(6,'Ubuntu Linux','None'),(7,'Centos','None'),(8,'Unix','Unix'),(9,'Fedori','fedori'),(10,'Mint Linux','mint'),(11,'Windows7','Microsoft'),(12,'WindowsXP','Microsott'),(13,'Windows 8','Microsoft'),(14,'Windows 8.1','Microsoft'),(15,'Windows 10','Microsoft'),(16,'Macingtosh','Apple');
/*!40000 ALTER TABLE `op_system` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pool_items`
--

DROP TABLE IF EXISTS `pool_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pool_items` (
  `serialno` varchar(45) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `brand` varchar(45) DEFAULT NULL,
  `assetno` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`serialno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pool_items`
--

LOCK TABLES `pool_items` WRITE;
/*!40000 ALTER TABLE `pool_items` DISABLE KEYS */;
INSERT INTO `pool_items` VALUES ('LO90890','Mouse','HP2','20');
/*!40000 ALTER TABLE `pool_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `printer_suppliers`
--

DROP TABLE IF EXISTS `printer_suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `printer_suppliers` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(45) DEFAULT NULL,
  `supplier_contact_p` varchar(45) DEFAULT NULL,
  `supplier_phone` varchar(45) DEFAULT NULL,
  `supplier_email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `printer_suppliers`
--

LOCK TABLES `printer_suppliers` WRITE;
/*!40000 ALTER TABLE `printer_suppliers` DISABLE KEYS */;
INSERT INTO `printer_suppliers` VALUES (1,'Netcom','Mandla Sangweni','25057852','netcomninfo@netcomn.co.sz'),(2,'Computer Services','Mlungisi Nsibande','24047896','info@computers.co.sz');
/*!40000 ALTER TABLE `printer_suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servers`
--

DROP TABLE IF EXISTS `servers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servers` (
  `s_serial` varchar(45) NOT NULL,
  `s_name` varchar(45) DEFAULT NULL,
  `s_os` varchar(45) DEFAULT NULL,
  `s_hardware` varchar(45) DEFAULT NULL,
  `s_ip` varchar(45) DEFAULT NULL,
  `s_hdrive` varchar(45) DEFAULT NULL,
  `s_ram` varchar(45) DEFAULT NULL,
  `s_desc` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`s_serial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servers`
--

LOCK TABLES `servers` WRITE;
/*!40000 ALTER TABLE `servers` DISABLE KEYS */;
INSERT INTO `servers` VALUES ('G6575hk','Gcinile','RedHat Linux','Dell Blade 20','147.110.192.2','20TB','20GB','Storing data');
/*!40000 ALTER TABLE `servers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sites`
--

DROP TABLE IF EXISTS `sites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sites` (
  `idsites` int(11) NOT NULL AUTO_INCREMENT,
  `sitename` varchar(45) DEFAULT NULL,
  `sitelocation` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idsites`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sites`
--

LOCK TABLES `sites` WRITE;
/*!40000 ALTER TABLE `sites` DISABLE KEYS */;
INSERT INTO `sites` VALUES (1,'HeadQuarters','Manzini'),(2,'Mbabane','Mbabane'),(3,'Siteki','Siteki'),(4,'Nhlangano','Nhlangano'),(5,'Piggs Peak','Piggs Peak'),(6,'Service Center','Manzini');
/*!40000 ALTER TABLE `sites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stationary`
--

DROP TABLE IF EXISTS `stationary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stationary` (
  `idstationary` int(11) NOT NULL AUTO_INCREMENT,
  `stnary_type` varchar(45) DEFAULT NULL,
  `quantity` varchar(45) DEFAULT NULL,
  `qnty_used` varchar(45) DEFAULT NULL,
  `order_level` varchar(45) DEFAULT NULL,
  `officer` varchar(45) DEFAULT NULL,
  `date_modified` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idstationary`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stationary`
--

LOCK TABLES `stationary` WRITE;
/*!40000 ALTER TABLE `stationary` DISABLE KEYS */;
INSERT INTO `stationary` VALUES (8,'NPF 200 Forms','30','0','0','brian@snpf.co.sz','2015-3-15'),(9,'Member Statement A3','40','0','0','brian@snpf.co.sz','2015-3-15'),(10,'Member Statement (Color)','60','0','0','brian@snpf.co.sz','2015-3-15'),(11,'Employer Labels','65','20','45','brian@snpf.co.sz','2015-3-15'),(12,'Receipt','100','0','0','brian@snpf.co.sz','2015-3-15');
/*!40000 ALTER TABLE `stationary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stationary_type`
--

DROP TABLE IF EXISTS `stationary_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stationary_type` (
  `idstationary` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(45) DEFAULT NULL,
  `type_desc` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idstationary`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stationary_type`
--

LOCK TABLES `stationary_type` WRITE;
/*!40000 ALTER TABLE `stationary_type` DISABLE KEYS */;
INSERT INTO `stationary_type` VALUES (1,'NPF 200 Forms',NULL),(2,'Member Statement A3',NULL),(3,'Member Statement (Color)',NULL),(4,'Employer Labels',NULL),(5,'Receipt',NULL),(7,'Exercise books','For Staff'),(8,'Pens','For writing'),(9,'Markers','For drawing');
/*!40000 ALTER TABLE `stationary_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tonners`
--

DROP TABLE IF EXISTS `tonners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tonners` (
  `t_serialno` varchar(45) NOT NULL,
  `t_model` varchar(45) DEFAULT NULL,
  `t_color` varchar(45) DEFAULT NULL,
  `t_description` varchar(45) DEFAULT NULL,
  `t_printerM` varchar(45) DEFAULT NULL,
  `t_purchdate` varchar(45) DEFAULT NULL,
  `t_installeddate` varchar(45) DEFAULT NULL,
  `t_ranoutDate` varchar(45) DEFAULT NULL,
  `t_status` varchar(45) DEFAULT NULL,
  `t_assignedP` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`t_serialno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tonners`
--

LOCK TABLES `tonners` WRITE;
/*!40000 ALTER TABLE `tonners` DISABLE KEYS */;
INSERT INTO `tonners` VALUES ('FJT600','T200','Margenta','Test','HP200','2015-3-17','NA','NA','pool','None'),('G2334','T200','Cyan','For Personal use','HP300','2015-3-1','2015-3-12','NA','assigned','H500'),('G89765','T300','Margenta','tEST','HP300','2015-3-1','2015-3-1','NA','assigned','H500'),('H4567','T600','Cyan','Y','HP200','2015-3-1','2015-3-1','2015-3-1','ranout','H500'),('HTLHST','T200','Yellow','Test','P666','2015-3-17','NA','NA','pool','None'),('K8976','T400','Black','test','HP200','2015-3-1','2015-3-2','2015-3-18','ranout','H500'),('k8987','T700','Yellow','KKK','P900','2015-3-1','NA','NA','pool','None'),('T90890',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('UITHS908','T200','Cyan','Test','P900','2015-3-17','NA','NA','pool','None'),('Y7676','T400','Black','testing','HP200','2015-3-1','2015-3-1','NA','assigned','K400');
/*!40000 ALTER TABLE `tonners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_name` varchar(45) NOT NULL,
  `user_pass` varchar(45) DEFAULT NULL,
  `user_firstName` varchar(45) DEFAULT NULL,
  `user_lastName` varchar(45) DEFAULT NULL,
  `user_officeNum` varchar(45) DEFAULT NULL,
  `user_accessRight` varchar(45) DEFAULT NULL,
  `user_location` varchar(45) DEFAULT NULL,
  `user_division` varchar(45) DEFAULT NULL,
  `user_floor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('brian@snpf.co.sz','password2015','Brian','Sihlongonyane','12','admin','Mbabane','Customer Services','First Floor'),('mahles@snpf.co.sz','admin','Mahle','Dlamini','03','admin','Siteki','Finance','First Floor'),('mandlas@snpf.co.sz','','Mandla','Sangweni','02','user','Mbabane','Customer Services','First Floor'),('nana@snpf.co.sz','','Nana','Nana','02','user','Nhlangano','Customer Services','Service Center');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-19 13:30:17
