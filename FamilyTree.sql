-- MySQL dump 10.13  Distrib 5.5.54, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: mianshi
-- ------------------------------------------------------
-- Server version	5.5.54-0ubuntu0.14.04.1

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
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(255) NOT NULL COMMENT 'username',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0 for man ,1 for woman',
  `birthday` int(10) unsigned NOT NULL COMMENT 'timestamp ',
  `mid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'id of mother, 0 shows no mother',
  `fid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'id of father, 0 shows no father',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'王大锤',1,663465600,3,4),(2,'王尼妹',0,663466600,3,4),(3,'王建国',1,37411200,0,0),(4,'李秀英',0,37411200,0,0),(9,'赵铁柱',1,1270310400,2,0),(11,'王小明',1,1272988800,0,1);
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relationship`
--

DROP TABLE IF EXISTS `relationship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relationship` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `relationship` varchar(255) NOT NULL,
  `Mchild` varchar(10) NOT NULL DEFAULT '0' COMMENT '0 shows for current id have no Mchild relationship',
  `Fchild` varchar(10) NOT NULL,
  `mother` varchar(10) NOT NULL,
  `father` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relationship`
--

LOCK TABLES `relationship` WRITE;
/*!40000 ALTER TABLE `relationship` DISABLE KEYS */;
INSERT INTO `relationship` VALUES (1,'女','3','4','5','6'),(2,'男','3','4','5','6'),(3,'女儿','7','8','1','2'),(4,'儿子','9','10','1','2'),(5,'母亲','1','2','11','12'),(6,'父亲','1','2','13','14'),(7,'外孙女','0','0','0','0'),(8,'外孙','0','0','0','0'),(9,'孙女','0','0','0','0'),(10,'孙子','0','0','0','0'),(11,'姥姥','15','16','0','0'),(12,'姥爷','15','16','0','0'),(13,'奶奶','21','22','0','0'),(14,'爷爷','21','22','0','0'),(15,'舅舅','27,28','29,30','11','12'),(16,'大姨','27,28','29,30','11','12'),(18,'','0','0','0','0'),(21,'叔叔','27','28','13','14'),(22,'嫂嫂','27','28','13','14'),(23,'','0','0','0','0'),(27,'表姐','0','0','0','0'),(123,'曾祖母','0','0','0','0');
/*!40000 ALTER TABLE `relationship` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-20 22:59:28
