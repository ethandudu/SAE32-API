-- MariaDB dump 10.19  Distrib 10.6.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: vps.ethanduault.fr    Database: sae32
-- ------------------------------------------------------
-- Server version	10.6.12-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `index`
--

DROP TABLE IF EXISTS `index`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `index` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `fileid` int(11) NOT NULL,
  `name` varchar(30) DEFAULT 'Sans titre',
  `numberframe` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `index`
--

LOCK TABLES `index` WRITE;
/*!40000 ALTER TABLE `index` DISABLE KEYS */;
INSERT INTO `index` VALUES (1,1,'Test 1',1097,'2023-10-25 08:42:51'),(2,2,'Test 2',3,'2023-10-27 09:21:57');
/*!40000 ALTER TABLE `index` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packets`
--

DROP TABLE IF EXISTS `packets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packets` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `fileid` int(11) NOT NULL,
  `packetid` int(11) NOT NULL,
  `protocols` varchar(80) NOT NULL,
  `macsrc` varchar(17) NOT NULL,
  `macdst` varchar(17) NOT NULL,
  `ipsrc` varchar(17) DEFAULT NULL,
  `ipdst` varchar(17) DEFAULT NULL,
  `data` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packets`
--

LOCK TABLES `packets` WRITE;
/*!40000 ALTER TABLE `packets` DISABLE KEYS */;
INSERT INTO `packets` VALUES (1,1,1,'sll:ethertype:ip:udp:mdns','3c:22:fb:3f:8c:ae','3c:22:fb:3f:8c:ae','192.168.1.1','192.168.1.2','{\"test\":\"ok\"}'),(2,1,2,'sll:ethertype:ip:udp:mdns','3c:22:fb:3f:8c:ae','3c:22:fb:3f:8c:ae','192.168.1.1','192.168.1.2','{\"test\":\"ok\"}'),(3,2,1,'sll:ethertype:ip:udp:mdns','3c:22:fb:3f:8c:ae','3c:22:fb:3f:8c:ae','192.168.1.1','192.168.1.2','{\"test\":\"ok\"}');
/*!40000 ALTER TABLE `packets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-25  9:23:29
