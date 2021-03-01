-- MariaDB dump 10.18  Distrib 10.4.17-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_realestate
-- ------------------------------------------------------
-- Server version	10.4.17-MariaDB

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
-- Table structure for table `fotografije`
--

DROP TABLE IF EXISTS `fotografije`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fotografije` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv_fotografije` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_nekretnine` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_foto_nekretnina` (`id_nekretnine`),
  CONSTRAINT `fk_foto_nekretnina` FOREIGN KEY (`id_nekretnine`) REFERENCES `nekretnina` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotografije`
--

LOCK TABLES `fotografije` WRITE;
/*!40000 ALTER TABLE `fotografije` DISABLE KEYS */;
INSERT INTO `fotografije` VALUES (1,'603c33a71ffd2.jpg',1),(2,'603c33a721806.jpg',1),(6,'603c38664b2c1.jfif',3),(7,'603c38664dd12.jfif',3),(8,'603c3866506dd.jfif',3),(16,'603c407a6e1ec.jfif',8),(17,'603c407a70462.jpg',8),(18,'603c40ec7a80a.PNG',3),(26,'603c466b83fc9.jpg',10),(27,'603c466b85e23.jfif',10),(28,'603c466b87310.jpg',10),(29,'603c466b88cc2.jpg',10),(30,'603c466b8c97c.jpg',10),(33,'603c48304707d.jfif',13),(36,'603c557581360.jpg',15),(37,'603c557582725.jpg',15),(38,'603c5575843eb.jfif',15),(39,'603c557585ade.jpg',15),(40,'603c55758712d.jpg',15),(43,'603c5606178b7.jpg',8),(44,'603c5626afde2.jfif',8),(54,'603c5bdd472b7.jfif',3),(55,'603c5bf48e418.jpg',3),(56,'603c5bf4900f7.jpg',3),(57,'603c5bf493869.jfif',3),(58,'603c5bf4959df.jfif',3),(59,'603c5bf49730b.jfif',3),(60,'603c5bf498616.jpg',3),(61,'603c5e4be95fc.jpg',16),(62,'603c5e4bed127.jpg',16),(63,'603c5f193eb2c.jfif',17),(64,'603c5f1941c54.jpg',17),(65,'603c5f1943c14.jfif',17),(66,'603c5f78ab8c4.jfif',18),(67,'603c5f78ae2fa.jfif',18),(68,'603c5f78b1533.jfif',18),(69,'603c5f78b2e80.jpg',18),(70,'603c5f78b4a8e.jpg',18),(71,'603c5f9f50715.jfif',1),(72,'603c5f9f51e68.jfif',1),(73,'603c5f9f55035.jfif',1),(74,'603c5f9f5700a.jpg',1);
/*!40000 ALTER TABLE `fotografije` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grad`
--

DROP TABLE IF EXISTS `grad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv_grada` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grad`
--

LOCK TABLES `grad` WRITE;
/*!40000 ALTER TABLE `grad` DISABLE KEYS */;
INSERT INTO `grad` VALUES (1,'Podgorica'),(2,'Budva'),(3,'Kotor'),(4,'Cetinje'),(6,'Niksic'),(7,'Kolasin'),(8,'Bijelo Polje'),(9,'Zabljak'),(10,'Ulcinj'),(11,'Tivat'),(12,'Mojkovac'),(13,'Herceg Novi'),(14,'Plav'),(15,'Danilovgrad'),(16,'Pljevlja'),(17,'Bar'),(18,'Pluzine');
/*!40000 ALTER TABLE `grad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nekretnina`
--

DROP TABLE IF EXISTS `nekretnina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nekretnina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_oglasa_id` int(11) NOT NULL,
  `tip_nekretnine_id` int(11) NOT NULL,
  `grad_id` int(11) NOT NULL,
  `povrsina` int(11) NOT NULL,
  `cijena` int(11) NOT NULL,
  `god_izgradnje` int(4) NOT NULL,
  `opis` text COLLATE utf8_bin NOT NULL,
  `status` varchar(255) COLLATE utf8_bin DEFAULT 'Dostupno',
  `datum_prodaje` timestamp NULL DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_nekretnina_grad` (`grad_id`),
  KEY `fk_nekretnina_tip_oglasa` (`tip_oglasa_id`),
  KEY `fk_nekretnina_tip_nekretnine` (`tip_nekretnine_id`),
  CONSTRAINT `fk_nekretnina_tip_nekretnine` FOREIGN KEY (`tip_nekretnine_id`) REFERENCES `tip_nekretnine` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nekretnina`
--

LOCK TABLES `nekretnina` WRITE;
/*!40000 ALTER TABLE `nekretnina` DISABLE KEYS */;
INSERT INTO `nekretnina` VALUES (1,3,2,1,68,68000,2012,'Kuca sa bazenom u Golubovcima','Dostupno',NULL,'./uploads/603c33a721806.jpg'),(3,1,2,17,55,58225,2008,'Kuca sa pogledom na more','Prodato','2021-03-01 00:44:00','./uploads/603c3866506dd.jfif'),(8,3,1,3,68,48,2008,'Stan u centru Kotora lux opremljen','Dostupno',NULL,'./uploads/603c407a70462.jpg'),(10,1,5,14,865,452000,2007,'Lux hotel u samom centru grada','Dostupno',NULL,'./uploads/603c466b8c97c.jpg'),(13,2,2,7,425,435,2003,'Vikendica u Kolasinu','Dostupno',NULL,'./uploads/603c48304707d.jfif'),(15,1,6,9,7000,35600,1955,'Na prodaju plac povrsine 7000 kvadrata.','Prodato','2021-03-01 02:56:14','./uploads/603c55758712d.jpg'),(16,2,1,11,76,420,2001,'U blizini Porto Montenegra','Dostupno',NULL,'./uploads/603c5e4bed127.jpg'),(17,1,6,1,4500,65000,2009,'Vinograd','Dostupno',NULL,'./uploads/603c5f1943c14.jfif'),(18,2,1,16,47,150,1995,'Londonska cetvrt','Dostupno',NULL,'./uploads/603c5f78b4a8e.jpg');
/*!40000 ALTER TABLE `nekretnina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tip_nekretnine`
--

DROP TABLE IF EXISTS `tip_nekretnine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tip_nekretnine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_nekretnine` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tip_nekretnine`
--

LOCK TABLES `tip_nekretnine` WRITE;
/*!40000 ALTER TABLE `tip_nekretnine` DISABLE KEYS */;
INSERT INTO `tip_nekretnine` VALUES (1,'Stan'),(2,'Kuca'),(3,'Garaza'),(4,'Poslovni prostor'),(5,'Hotel'),(6,'Plac'),(7,'Pasnjak');
/*!40000 ALTER TABLE `tip_nekretnine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tip_oglasa`
--

DROP TABLE IF EXISTS `tip_oglasa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tip_oglasa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tip_oglasa` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tip_oglasa`
--

LOCK TABLES `tip_oglasa` WRITE;
/*!40000 ALTER TABLE `tip_oglasa` DISABLE KEYS */;
INSERT INTO `tip_oglasa` VALUES (1,'Prodaja'),(2,'Izdavanje'),(3,'Kompenzacija');
/*!40000 ALTER TABLE `tip_oglasa` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-01  4:40:01
