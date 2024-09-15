-- MariaDB dump 10.19  Distrib 10.5.22-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: mangaworth
-- ------------------------------------------------------
-- Server version	10.5.22-MariaDB

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
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `href` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ads`
--

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;
INSERT INTO `ads` VALUES (3,'https://flamecomics.me/wp-content/uploads/2024/02/TRYSOTDIAA-Banner.jpg','','chapter',0);
/*!40000 ALTER TABLE `ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ceviri`
--

DROP TABLE IF EXISTS `ceviri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ceviri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yukleyen` varchar(255) NOT NULL,
  `manga_id` int(11) NOT NULL,
  `chapter_volume` int(11) NOT NULL,
  `dosya_adi` varchar(255) NOT NULL,
  `dosya_konumu` varchar(255) NOT NULL,
  `durum` tinyint(4) NOT NULL,
  `alinma_tarihi` datetime NOT NULL,
  `alan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ceviri`
--

LOCK TABLES `ceviri` WRITE;
/*!40000 ALTER TABLE `ceviri` DISABLE KEYS */;
INSERT INTO `ceviri` VALUES (10,'mangaworth',6,31,'Genius Corpse Collecting Warrior BÃ¶lÃ¼m 31-667ad307a89c6.txt','Genius Corpse Collecting Warrior/Genius Corpse Collecting Warrior BÃ¶lÃ¼m 31-667ad307a89c6.txt',1,'2024-06-25 17:24:27','mangaworth'),(12,'mangaworth',8,2,'The Regressed Youngest Son of the Duke is an Assassin BÃ¶lÃ¼m 2-667adc27e1f41.txt','The Regressed Youngest Son of the Duke is an Assassin/The Regressed Youngest Son of the Duke is an Assassin BÃ¶lÃ¼m 2-667adc27e1f41.txt',1,'2024-06-25 18:03:22','mangaworth');
/*!40000 ALTER TABLE `ceviri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapter`
--

DROP TABLE IF EXISTS `chapter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manga_id` varchar(11) NOT NULL,
  `images` text NOT NULL,
  `views` int(15) NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `hash` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `volume` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `edit` tinyint(1) NOT NULL DEFAULT 0,
  `translate` tinyint(1) NOT NULL DEFAULT 0,
  `lastcheck` tinyint(1) NOT NULL DEFAULT 0,
  `release_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapter`
--

LOCK TABLES `chapter` WRITE;
/*!40000 ALTER TABLE `chapter` DISABLE KEYS */;
INSERT INTO `chapter` VALUES (12,'7','[\"1 - Kopya (2) - Kopya - Kopya - Kopya.jpg\",\"1 - Kopya (2) - Kopya - Kopya.jpg\"]',1,NULL,'667ad464d61f1','published','bolum-1','1','BÃ¶lÃ¼m 1',1,1,1,'2024-06-25 14:29:56'),(13,'7','[\"1 - Kopya (2) - Kopya.jpg\",\"1 - Kopya (2).jpg\",\"1 - Kopya - Kopya.jpg\"]',2,NULL,'667ad4656e56c','published','bolum-2','2','BÃ¶lÃ¼m 2',1,1,1,'2024-06-25 14:29:57'),(14,'8','[\"15027e81-9105-4975-ade7-b101c064fa071.jpg\"]',3,'resim_2024-06-25_171012155-Photoroom.png','667adc7583760','published','bolum-2','2','BÃ¶lÃ¼m 2',0,0,0,'2024-06-25 15:04:21'),(16,'10','[\"01.jpg\",\"02.jpg\",\"03.jpg\",\"04.jpg\",\"05.jpg\",\"06.jpg\",\"07.jpg\",\"08.jpg\",\"09.jpg\",\"10.jpg\",\"11.png\"]',11,'','667b20a882099','published','bolum-1','1','BÃ¶lÃ¼m 1',0,0,0,'2024-06-25 19:55:34'),(17,'10','[\"01.jpg\",\"02.jpg\",\"03.jpg\",\"04.jpg\",\"05.jpg\",\"06.jpg\",\"07.jpg\",\"08.jpg\",\"09.jpg\",\"10.jpg\"]',9,'','667b20dca0459','published','bolum-2','2','BÃ¶lÃ¼m 2',0,0,0,'2024-06-25 19:56:26'),(18,'10','[\"1.jpg\",\"2.webp\",\"3.webp\",\"4.webp\",\"5.webp\",\"6.webp\",\"7.webp\",\"8.webp\"]',12,'','667b210acf336','published','bolum-3','3','BÃ¶lÃ¼m 3',0,0,0,'2024-06-25 19:57:04'),(19,'10','[\"1.jpg\",\"2.webp\",\"3.webp\",\"4.webp\",\"5.webp\",\"6.webp\",\"7.webp\",\"8.webp\"]',8,'','667b212e40a04','published','bolum-4','4','BÃ¶lÃ¼m 4',0,0,0,'2024-06-25 19:57:36'),(20,'10','[\"1.jpg\",\"2.webp\",\"3.webp\",\"4.webp\",\"5.webp\",\"6.webp\",\"7.webp\",\"8.webp\",\"9.webp\"]',10,'','667b214d016c6','published','bolum-5','5','BÃ¶lÃ¼m 5',0,0,0,'2024-06-25 19:58:06'),(21,'10','[\"1.jpg\",\"2.jpg\",\"3.jpg\",\"4.jpg\",\"5.jpg\",\"6.jpg\",\"7.jpg\",\"8.jpg\",\"9.png\"]',9,'','667b216895671','published','bolum-6','6','BÃ¶lÃ¼m 6',0,0,0,'2024-06-25 19:58:35'),(22,'10','[\"1.jpg\",\"2.jpg\",\"3.jpg\",\"4.jpg\",\"5.jpg\",\"6.jpg\",\"7.jpg\",\"8.jpg\",\"9.png\"]',9,'','667b218a0d109','published','bolum-7','7','BÃ¶lÃ¼m 7',0,0,0,'2024-06-25 19:59:09'),(23,'10','[\"1.jpg\",\"2.jpg\",\"3.jpg\",\"4.jpg\",\"5.jpg\",\"6.jpg\",\"7.jpg\",\"8.jpg\",\"9.png\"]',11,'','667b21a6a2ed6','published','bolum-8','8','BÃ¶lÃ¼m 8',0,0,0,'2024-06-25 19:59:37'),(24,'10','[\"1.jpg\",\"2.jpg\",\"3.jpg\",\"4.jpg\",\"5.jpg\",\"6.jpg\",\"7.jpg\",\"8.jpg\"]',11,'','667b21c4e366b','published','bolum-9','9','BÃ¶lÃ¼m 9',0,0,0,'2024-06-25 20:00:07'),(25,'10','[\"1.jpg\",\"2.jpg\",\"3.jpg\",\"4.jpg\",\"5.jpg\",\"6.jpg\",\"7.jpg\",\"8.jpg\",\"9.jpg\"]',9,'','667b21e02e40c','published','bolum-10','10','BÃ¶lÃ¼m 10',0,0,0,'2024-06-25 20:00:36'),(26,'10','[\"00_jpg_65c8c9955f68a_jpg_661116d4b2ac0.jpg\",\"03_jpg_65c8c995600ac_jpg_661116d4b3a97.jpg\",\"04_jpg_65c8c995615c9_jpg_661116d4b59a1.jpg\",\"05_jpg_65c8c99562699_jpg_661116d4b6f2d.jpg\",\"06_jpg_65c8c99563722_jpg_661116d4b8103.jpg\",\"07_jpg_65c8c99564722_jpg_661116d4b93ec.jpg\",\"08_jpg_65c8c995656f0_jpg_661116d4ba641.jpg\",\"09_jpg_65c8c995661e8_jpg_661116d4bb649.jpg\",\"10_jpg_65c8c9956703d_jpg_661116d4bc783.jpg\",\"11_jpg_65c8c9956802e_jpg_661116d4bd9a8.jpg\"]',9,'','667b24a647896','published','bolum-11','11','BÃ¶lÃ¼m 11',0,0,0,'2024-06-25 20:12:23'),(27,'10','[\"00_jpg_65c8c9cc9e5df_jpg_661116db86f91.jpg\",\"03_jpg_65c8c9cc9ef03_jpg_661116db885b2.jpg\",\"04_jpg_65c8c9cc9fe74_jpg_661116db8ad5d.jpg\",\"05_jpg_65c8c9cca0f03_jpg_661116db8d621.jpg\",\"06_jpg_65c8c9cca1e61_jpg_661116db90466.jpg\",\"07_jpg_65c8c9cca2f0d_jpg_661116db92d82.jpg\",\"08_jpg_65c8c9cca3cfb_jpg_661116db95ca0.jpg\",\"09_jpg_65c8c9cca4d31_jpg_661116db98ef4.jpg\",\"10_jpg_65c8c9cca5b92_jpg_661116db9b471.jpg\"]',8,'','667b24c2885f3','published','bolum-12','12','BÃ¶lÃ¼m 12',0,0,0,'2024-06-25 20:12:52'),(28,'10','[\"00_jpg_65c8c9e782e18_jpg_66111715357cd.jpg\",\"03_jpg_65c8c9e7838a8_jpg_6611171537582.jpg\",\"04_jpg_65c8c9e784c87_jpg_661117153ab4c.jpg\",\"05_jpg_65c8c9e785f30_jpg_661117153d6e8.jpg\",\"06_jpg_65c8c9e787568_jpg_6611171540bfa.jpg\",\"07_jpg_65c8c9e7889b9_jpg_66111715438b8.jpg\",\"08_jpg_65c8c9e789c3d_jpg_66111715467fb.jpg\",\"09_jpg_65c8c9e78aff5_jpg_6611171549c64.jpg\"]',10,'','667b24de4215b','published','bolum-13','13','BÃ¶lÃ¼m 13',0,0,0,'2024-06-25 20:13:19'),(29,'10','[\"00_jpg_65ca7fdedba9d_jpg_661117400cc37.jpg\",\"03_jpg_65ca7fdedcb00_jpg_661117400e845.jpg\",\"04_jpg_65ca7fdede5b2_jpg_6611174012750.jpg\",\"05_jpg_65ca7fdedfe07_jpg_661117401572f.jpg\",\"06_jpg_65ca7fdee394b_jpg_661117401959d.jpg\",\"07_jpg_65ca7fdee56e9_jpg_661117401c72d.jpg\",\"08_jpg_65ca7fdee6cd3_jpg_661117401ee91.jpg\",\"09_jpg_65ca7fdee7fce_jpg_66111740215ff.jpg\"]',12,'','667b250ab8330','published','bolum-14','14','BÃ¶lÃ¼m 14',0,0,0,'2024-06-25 20:14:05'),(30,'10','[\"03_copy_jpg_661117478be40.jpg\",\"04_copy_jpg_661117478db25.jpg\",\"05_copy_jpg_661117478f3a1.jpg\",\"06_copy_jpg_661117479084b.jpg\",\"07_copy_jpg_6611174791d1e.jpg\",\"08_copy_jpg_6611174793642.jpg\",\"09_copy_jpg_6611174794be5.jpg\"]',8,'','667b254255c24','published','bolum-15','15','BÃ¶lÃ¼m 15',0,0,0,'2024-06-25 20:15:02'),(31,'10','[\"02_png_66111766bd0a7.png\",\"003_jpg_66111766bf115.jpg\",\"004_jpg_66111766c25c2.jpg\",\"005_jpg_66111766c4f85.jpg\",\"006_jpg_66111766c859c.jpg\",\"007_jpg_66111766cb14c.jpg\",\"008_jpg_66111766ce185.jpg\",\"009_jpg_66111766d0dc7.jpg\",\"010_jpg_66111766d380a.jpg\"]',11,'','667b257c3cf9f','published','bolum-16','16','BÃ¶lÃ¼m 16',0,0,0,'2024-06-25 20:15:58'),(32,'10','[\"02_jpg_6617d2978ca96.jpg\",\"03_jpg_6617d2978e734.jpg\",\"04_jpg_6617d2979144d.jpg\",\"05_jpg_6617d29794548.jpg\",\"06_jpg_6617d29796ed3.jpg\",\"07_jpg_6617d297993a6.jpg\",\"08_jpg_6617d2979bd28.jpg\",\"09_jpg_6617d2979e1c7.jpg\",\"10_jpg_6617d297a14df.jpg\"]',15,'','667b259c7fcb8','published','bolum-17','17','BÃ¶lÃ¼m 17',0,0,0,'2024-06-25 20:16:28'),(33,'10','[\"003_jpg_661ad70dee337.jpg\",\"004_jpg_661ad70df2998.jpg\",\"005_jpg_661ad70e029da.jpg\",\"006_jpg_661ad70e05a53.jpg\",\"007_jpg_661ad70e08e11.jpg\",\"008_jpg_661ad70e0c014.jpg\",\"009_jpg_661ad70e0f54e.jpg\",\"010_jpg_661ad70e12740.jpg\"]',17,'','667b25bb442ee','published','bolum-18','18','BÃ¶lÃ¼m 18',0,0,0,'2024-06-25 20:17:03'),(34,'10','[\"003_jpg_662c33e400071.jpg\",\"004_jpg_662c33e401ad6.jpg\",\"005_jpg_662c33e403672.jpg\",\"006_jpg_662c33e404e32.jpg\",\"007_jpg_662c33e4065a7.jpg\",\"008_jpg_662c33e40798d.jpg\",\"009_jpg_662c33e408c49.jpg\",\"010_jpg_662c33e40a1ca.jpg\"]',30,'','667b25dec1d99','published','bolum-19','19','BÃ¶lÃ¼m 19',0,0,0,'2024-06-25 20:17:37');
/*!40000 ALTER TABLE `chapter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `edit`
--

DROP TABLE IF EXISTS `edit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `edit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter_id` int(11) NOT NULL,
  `manga_id` int(11) NOT NULL,
  `yukleyen` varchar(255) NOT NULL,
  `edit_alim_tarihi` timestamp NOT NULL DEFAULT current_timestamp(),
  `dosya_ismi` varchar(255) NOT NULL,
  `dosya_yolu` varchar(255) NOT NULL,
  `durum` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `edit`
--

LOCK TABLES `edit` WRITE;
/*!40000 ALTER TABLE `edit` DISABLE KEYS */;
INSERT INTO `edit` VALUES (6,11,6,'mangaworth','2024-06-25 14:24:40','667ad328232fc','667acded0ed74/chapters/667ad328232fc',1),(7,14,8,'mangaworth','2024-06-25 15:04:21','667adc7583760','667acf4b9b670/chapters/667adc7583760',1);
/*!40000 ALTER TABLE `edit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genres`
--

DROP TABLE IF EXISTS `genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genres`
--

LOCK TABLES `genres` WRITE;
/*!40000 ALTER TABLE `genres` DISABLE KEYS */;
INSERT INTO `genres` VALUES (1,'Macera','macera'),(2,'Aksiyon','aksiyon'),(3,'Fantastik','fantastik'),(4,'Dram','dram'),(5,'Romantik','romantik'),(6,'Sistem','sistem'),(8,'Murim','murim'),(9,'DÃ¶vÃ¼ÅŸ SanatlarÄ±','dovus-sanatlari'),(10,'Hentai','hentai'),(11,'Pornhwa','pornhwa');
/*!40000 ALTER TABLE `genres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manga`
--

DROP TABLE IF EXISTS `manga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(155) NOT NULL,
  `alternative_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `score` varchar(25) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `chapter_cover` varchar(255) NOT NULL,
  `views` int(25) NOT NULL,
  `genres` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `artist` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `year` varchar(5) NOT NULL,
  `status` varchar(15) NOT NULL,
  `type` varchar(255) NOT NULL,
  `calendar` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `adult` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manga`
--

LOCK TABLES `manga` WRITE;
/*!40000 ALTER TABLE `manga` DISABLE KEYS */;
INSERT INTO `manga` VALUES (10,'Youngest Chef From 3rd Rate Hotel','youngest-chef-from-3rd-rate-hotel','GenÃ§ AÅŸÃ§Ä±','Kore\'deki 4 yÄ±ldÄ±zlÄ± bir otel mutfaÄŸÄ±nÄ±n en genÃ§ Ã¼yesi olan Kang Sunghoon, gÃ¼Ã§lÃ¼ hafÄ±zasÄ± olduÄŸu iÃ§in farklÄ± malzeme tÃ¼rlerini ezberleme yeteneÄŸine sahiptir.','6','title-what-do-you-guys-think-are-these-worth-reading-v0-rrgrnyzjsk9b1.webp','667af56521629images.jpg',284,'[\"Dram\",\"Romantik\"]','2024-06-25 16:49:21','Kierke','Kierke','2024','published','manhwa','cuma','667af510b6de2','667af607578a7slidir.png','0');
/*!40000 ALTER TABLE `manga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = Kullanıcı \r\n1 = Kontrolcü\r\n2 = Joker\r\n3 = Editör\r\n4 = Admin\r\n5 = Yönetici',
  `register_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip` varchar(25) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'mangaworth','$2y$10$iewsTuGJVh/M3VLss6ffA.LHrzPCLZXJyDdcIY9Rw7eJ7kLtJA.EG',5,'2024-06-13 20:15:09','45.138.183.41',''),(2,'Arothcheva','$2y$10$Y/oXxQiAJNYmOIBheVanQ.ugVBD2mYuwAso0leD45z2wO2ApfURki',0,'2024-06-14 05:19:38','45.138.183.41',''),(3,'EmreS','$2y$10$CroeuoDBVQnk7feDP7FP1OF2vN29/9bJiHLQJO76eJDZP60v3WtsO',0,'2024-06-15 17:47:14','45.138.183.41',''),(4,'Xenox','$2y$10$GxO6IizCW8geCSa7..LzC.njkD01ikadn0oehUN4RvJzhQw1ZAjnS',4,'2024-06-25 15:47:39',NULL,'xenoxwork@gmail.com');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'mangaworth'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-03 19:11:44
