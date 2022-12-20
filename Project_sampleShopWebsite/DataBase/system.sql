-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: system
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adminaccount`
--

DROP TABLE IF EXISTS `adminaccount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adminaccount` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `account` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `account_UNIQUE` (`account`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adminaccount`
--

LOCK TABLES `adminaccount` WRITE;
/*!40000 ALTER TABLE `adminaccount` DISABLE KEYS */;
INSERT INTO `adminaccount` VALUES (1,'test','admin','admin');
/*!40000 ALTER TABLE `adminaccount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `product` int NOT NULL,
  `user` varchar(45) NOT NULL,
  PRIMARY KEY (`product`,`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (1,'aaa@aaaa.com'),(2,'aaa@aaaa.com'),(3,'aaa@aaaa.com'),(4,'aaa@aaaa.com'),(5,'aaa@aaaa.com'),(6,'aaa@aaaa.com'),(8,'aaa@aaaa.com'),(9,'aaa@aaaa.com'),(10,'aaa@aaaa.com'),(19,'aaa@aaaa.com');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'穀類麥片'),(2,'日用品'),(3,'特製品'),(4,'海鮮'),(5,'調味品'),(6,'點心'),(7,'飲料'),(8,'肉家禽');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `password` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birthday` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `pid_UNIQUE` (`pid`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (1,'aaa@aaaa.com','aaaa','aaaa','未填寫',''),(3,'bbbb@bbbb.com','bbbb','bbbb','未填寫',''),(4,'ffff@ffff.com','ffff','asd','不男不女','2022-12-09'),(5,'gggg@gggg.com','gggg','wef','女','2022-12-08');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `useremail` varchar(45) NOT NULL,
  `usernickname` varchar(45) DEFAULT NULL,
  `message` text NOT NULL,
  `timestamp` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `useremail_idx` (`useremail`),
  CONSTRAINT `useremail` FOREIGN KEY (`useremail`) REFERENCES `member` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,'aaa@aaaa.com','aul ','aaaaa','2022/11/30 10:06 PM'),(2,'aaa@aaaa.com','喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵','asdasdadadasd','2022/11/30 10:06 PM'),(3,'aaa@aaaa.com','喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵喵','ㄚㄚㄚㄚㄚㄚㄚㄚㄚㄚㄚ','2022/12/04 07:20 PM'),(4,'ffff@ffff.com','awefwaefewaf','awefawefawefawef','2022/12/12 09:40 AM'),(5,'ffff@ffff.com','hahaha','e wsbruydmt','2022/12/12 09:41 AM');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordercontent`
--

DROP TABLE IF EXISTS `ordercontent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ordercontent` (
  `id` int NOT NULL,
  `product` varchar(20) NOT NULL,
  `amout` varchar(20) NOT NULL,
  KEY `orderidlink_idx` (`id`),
  CONSTRAINT `orderidlink` FOREIGN KEY (`id`) REFERENCES `orderindex` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordercontent`
--

LOCK TABLES `ordercontent` WRITE;
/*!40000 ALTER TABLE `ordercontent` DISABLE KEYS */;
INSERT INTO `ordercontent` VALUES (7,'1','100'),(7,'2','100'),(7,'5','100'),(7,'8','100'),(8,'1','1'),(8,'2','4'),(8,'5','1'),(8,'8','1'),(9,'1','6'),(10,'1','1'),(11,'3','1'),(12,'1','1'),(13,'1','1'),(13,'4','1'),(13,'8','25'),(13,'11','1'),(13,'15','96'),(13,'7','1'),(13,'1','1'),(14,'1','1'),(14,'1','1'),(14,'20','1'),(15,'4','1'),(16,'1','1'),(17,'1','1'),(18,'1','1'),(18,'4','1'),(18,'6','1'),(18,'10','1'),(19,'49','113'),(19,'50','1'),(19,'51','10'),(19,'52','1'),(20,'62','1'),(20,'64','11'),(20,'66','1'),(20,'68','8'),(20,'9','1'),(20,'18','886'),(20,'50','7'),(20,'53','1'),(20,'73','1'),(20,'75','1'),(20,'1','1'),(20,'3','8'),(20,'1','1'),(20,'2','1'),(20,'3','1'),(20,'20','1'),(21,'4','1');
/*!40000 ALTER TABLE `ordercontent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderindex`
--

DROP TABLE IF EXISTS `orderindex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orderindex` (
  `id` int NOT NULL AUTO_INCREMENT,
  `buyer` varchar(45) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `totalprice` varchar(45) NOT NULL,
  `state` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderindex`
--

LOCK TABLES `orderindex` WRITE;
/*!40000 ALTER TABLE `orderindex` DISABLE KEYS */;
INSERT INTO `orderindex` VALUES (1,'idcount','2022-12-12 11:03:23','',''),(2,'aaa@aaaa.com','2022-12-12 11:33:54','',''),(3,'aaa@aaaa.com','2022-12-12 11:36:20','',''),(4,'aaa@aaaa.com','2022-12-12 11:36:24','',''),(5,'aaa@aaaa.com','2022-12-12 11:36:44','',''),(6,'aaa@aaaa.com','2022-12-12 11:37:22','',''),(7,'aaa@aaaa.com','2022-12-12 11:52:06','',''),(8,'aaa@aaaa.com','2022-12-12 11:56:48','',''),(9,'aaa@aaaa.com','2022-12-12 12:02:37','',''),(10,'aaa@aaaa.com','2022-12-12 12:03:34','',''),(11,'aaa@aaaa.com','2022-12-12 12:04:29','',''),(12,'aaa@aaaa.com','2022-12-12 12:05:31','',''),(13,'aaa@aaaa.com','2022-12-12 13:01:12','',''),(14,'aaa@aaaa.com','2022-12-12 13:04:44','',''),(15,'aaa@aaaa.com','2022-12-12 13:07:54','',''),(16,'aaa@aaaa.com','2022-12-12 13:08:58','',''),(17,'aaa@aaaa.com','2022-12-12 13:09:49','',''),(18,'aaa@aaaa.com','2022-12-12 13:17:08','77',''),(19,'aaa@aaaa.com','2022-12-12 16:02:45','2247',''),(20,'aaa@aaaa.com','2022-12-12 16:04:04','430',''),(21,'aaa@aaaa.com','2022-12-14 23:49:49','18',NULL);
/*!40000 ALTER TABLE `orderindex` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `price` decimal(6,1) NOT NULL,
  `suplierid` int NOT NULL,
  `categoryid` int NOT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `pid_UNIQUE` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'蘋果汁','每箱24瓶',14.0,17,7),(2,'牛奶','每箱24瓶',15.0,17,7),(3,'蕃茄醬','每箱12瓶',8.0,17,5),(4,'鹽巴','每箱12瓶',18.0,6,5),(5,'麻油','每箱12瓶',17.0,6,5),(6,'醬油','每箱12瓶',20.0,24,5),(7,'海鮮粉','每箱30盒',24.0,24,3),(8,'胡椒粉','每箱30盒',32.0,24,5),(9,'讚油雞','每袋500克',78.0,16,8),(10,'大甲蟹','每袋500克',25.0,16,4),(11,'民眾起司','每袋6包',17.0,26,2),(12,'德國起司','每箱12瓶',30.0,26,2),(13,'龍蝦','每袋500克',5.0,3,4),(14,'沙茶','每箱12瓶',19.0,3,3),(15,'味素','每箱30盒',12.0,3,5),(16,'餅乾','每箱30盒',14.0,18,6),(17,'豬肉','每袋500克',31.0,18,8),(18,'墨魚','每袋500克',50.0,18,4),(19,'糖果','每箱30盒',7.0,9,6),(20,'豆乾','每箱30盒',65.0,9,6),(21,'花生','每箱30包',8.0,9,6),(22,'再來米','每袋3公斤',17.0,7,1),(23,'燕麥','每袋3公斤',7.0,7,1),(24,'汽水','每箱12瓶',4.0,14,7),(25,'巧克力','每箱30盒',11.0,21,6),(26,'綿綿糖','每箱30盒',25.0,21,6),(27,'牛肉乾','每箱30包',35.0,21,6),(28,'烤肉醬','每箱12瓶',36.0,20,3),(29,'橄欖油','每箱12瓶',36.0,20,5),(30,'黃魚','每袋3公斤',21.0,25,4),(31,'溫馨起司','每箱12瓶',10.0,2,2),(32,'白起司','每箱12瓶',26.0,2,2),(33,'台中起司','每箱12瓶',2.0,10,2),(34,'啤酒','每箱24瓶',11.0,23,7),(35,'芭樂汁','每箱24瓶',14.0,23,7),(36,'魷魚','每袋3公斤',15.0,19,4),(37,'干貝','每袋3公斤',21.0,19,4),(38,'綠茶','每箱24瓶',211.0,12,7),(39,'運動飲料','每箱24瓶',14.0,12,7),(40,'蝦米','每袋3公斤',15.0,5,4),(41,'蝦子','每袋3公斤',8.0,5,4),(42,'糙米','每袋3公斤',10.0,1,1),(43,'柳橙汁','每箱24瓶',37.0,1,7),(44,'蠔油','每箱24瓶',16.0,1,5),(45,'雪魚','每袋3公斤',8.0,27,4),(46,'蚵','每袋3公斤',10.0,27,4),(47,'蛋糕','每箱24個',8.0,29,6),(48,'玉米片','每箱24包',10.0,29,6),(49,'薯條','每箱24包',16.0,13,6),(50,'玉米餅','每箱24包',13.0,13,6),(51,'豬肉乾','每箱24包',42.0,4,3),(52,'三合一麥片','每箱24包',6.0,4,1),(53,'鹽水鴨','每袋3公斤',26.0,4,8),(54,'雞肉','每袋3公斤',6.0,15,8),(55,'鴨肉','每袋3公斤',19.0,15,8),(56,'白米','每袋3公斤',30.0,8,1),(57,'小米','每袋3公斤',16.0,8,1),(58,'花枝','每袋3公斤',11.0,28,4),(59,'蘇澳起司','每箱24瓶',44.0,11,2),(60,'花起司','每箱24瓶',27.0,11,2),(61,'海鮮醬','每箱24瓶',23.0,22,5),(62,'山渣片','每箱24包',39.0,22,6),(63,'甜辣醬','每箱24瓶',35.0,18,5),(64,'黃豆','每袋3公斤',27.0,20,1),(65,'海苔醬','每箱24瓶',17.0,6,5),(66,'肉鬆','每箱24瓶',14.0,6,5),(67,'礦泉水','每箱24瓶',11.0,23,7),(68,'綠豆糕','每箱24包',10.0,9,6),(69,'黑起司','每盒24個',29.0,10,2),(70,'蘇打水','每箱24瓶',12.0,18,7),(71,'義大利起司','每箱2個',17.0,10,2),(72,'酸起司','每箱2個',35.0,2,2),(73,'海哲皮','每袋3公斤',12.0,19,4),(74,'雞湯塊','每盒24個',8.0,16,3),(75,'濃縮咖啡','每箱24瓶',6.0,20,7),(76,'檸檬汁','每箱24瓶',14.0,13,7),(77,'辣椒粉','每袋3公斤',10.0,20,5);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `storage`
--

DROP TABLE IF EXISTS `storage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `storage` (
  `product` int NOT NULL,
  `amout` varchar(20) NOT NULL,
  PRIMARY KEY (`product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `storage`
--

LOCK TABLES `storage` WRITE;
/*!40000 ALTER TABLE `storage` DISABLE KEYS */;
INSERT INTO `storage` VALUES (1,'1000'),(2,'1000'),(3,'1000'),(4,'1000'),(5,'1000'),(6,'1000'),(7,'1000'),(8,'1000'),(9,'1000'),(10,'1000'),(11,'1000'),(12,'1000'),(13,'1000'),(14,'1000'),(15,'1000'),(16,'1000'),(17,'1000'),(18,'1000'),(19,'1000'),(20,'1000'),(21,'1000'),(22,'1000'),(23,'1000'),(24,'1000'),(25,'1000'),(26,'1000'),(27,'1000'),(28,'1000'),(29,'1000'),(30,'1000'),(31,'1000'),(32,'1000'),(33,'1000'),(34,'1000'),(35,'1000'),(36,'1000'),(37,'1000'),(38,'1000'),(39,'1000'),(40,'1000'),(41,'1000'),(42,'1000'),(43,'1000'),(44,'1000'),(45,'1000'),(46,'1000'),(47,'1000'),(48,'1000'),(49,'1000'),(50,'1000'),(51,'1000'),(52,'1000'),(53,'1000'),(54,'1000'),(55,'1000'),(56,'1000'),(57,'1000'),(58,'1000'),(59,'1000'),(60,'1000'),(61,'1000'),(62,'1000'),(63,'1000'),(64,'1000'),(65,'1000'),(66,'1000'),(67,'1000'),(68,'1000'),(69,'1000'),(70,'1000'),(71,'1000'),(72,'1000'),(73,'1000'),(74,'1000'),(75,'1000'),(76,'1000'),(77,'1000');
/*!40000 ALTER TABLE `storage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supplier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `saleman` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,'一心','劉天王'),(2,'小陽堂','柯吉霸'),(3,'德菖','黎國明'),(4,'涵合','曾麗亥'),(5,'普三','林美麗'),(6,'法師公會','法濕'),(7,'掬花','趙飛燕'),(8,'宏仁','郝欣仁'),(9,'康堡','孟庭亭'),(10,'德級','蘇涵蘊'),(11,'玉成','張瑾雯'),(12,'記成','洪慮登'),(13,'利利','吳添涼'),(14,'金美蘭','吳仁幸'),(15,'佳佳','曾艾梅'),(16,'為全','郝布豪'),(17,'桶一','奈安內'),(18,'正一','盧小小'),(19,'小坊','艾道泥'),(20,'義美美','花布丸'),(21,'小噹','曾艾花'),(22,'百達','吳宗將'),(23,'力錦','柯玲芬'),(24,'生活妙','郝享枯'),(25,'東黃海','艾扣扣'),(26,'日正','鐵迪丸'),(27,'日日通','洪隆國'),(28,'大鈺','萬塗利'),(29,'順成','魏繩墨');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `商品總表`
--

DROP TABLE IF EXISTS `商品總表`;
/*!50001 DROP VIEW IF EXISTS `商品總表`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `商品總表` AS SELECT 
 1 AS `產品編號`,
 1 AS `產品名稱`,
 1 AS `單位`,
 1 AS `價格`,
 1 AS `類別`,
 1 AS `供應商名稱`,
 1 AS `銷售人員`,
 1 AS `庫存量`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `庫存表`
--

DROP TABLE IF EXISTS `庫存表`;
/*!50001 DROP VIEW IF EXISTS `庫存表`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `庫存表` AS SELECT 
 1 AS `產品編號`,
 1 AS `產品名稱`,
 1 AS `庫存量`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `訂單總表`
--

DROP TABLE IF EXISTS `訂單總表`;
/*!50001 DROP VIEW IF EXISTS `訂單總表`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `訂單總表` AS SELECT 
 1 AS `訂單編號`,
 1 AS `訂購帳號`,
 1 AS `訂購時間`,
 1 AS `訂購商品編號`,
 1 AS `訂購商品`,
 1 AS `訂購數量`,
 1 AS `訂單狀態`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `商品總表`
--

/*!50001 DROP VIEW IF EXISTS `商品總表`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `商品總表` AS select `products`.`pid` AS `產品編號`,`products`.`name` AS `產品名稱`,`products`.`unit` AS `單位`,`products`.`price` AS `價格`,`category`.`category` AS `類別`,`supplier`.`name` AS `供應商名稱`,`supplier`.`saleman` AS `銷售人員`,`storage`.`amout` AS `庫存量` from (((`products` join `category` on((`products`.`categoryid` = `category`.`id`))) join `supplier` on((`products`.`suplierid` = `supplier`.`id`))) join `storage` on((`products`.`pid` = `storage`.`product`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `庫存表`
--

/*!50001 DROP VIEW IF EXISTS `庫存表`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `庫存表` AS select `products`.`pid` AS `產品編號`,`products`.`name` AS `產品名稱`,`storage`.`amout` AS `庫存量` from (`products` join `storage` on((`products`.`pid` = `storage`.`product`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `訂單總表`
--

/*!50001 DROP VIEW IF EXISTS `訂單總表`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `訂單總表` AS select `orderindex`.`id` AS `訂單編號`,`orderindex`.`buyer` AS `訂購帳號`,`orderindex`.`timestamp` AS `訂購時間`,`products`.`pid` AS `訂購商品編號`,`products`.`name` AS `訂購商品`,`ordercontent`.`amout` AS `訂購數量`,`orderindex`.`state` AS `訂單狀態` from ((`orderindex` join `ordercontent` on((`orderindex`.`id` = `ordercontent`.`id`))) join `products` on((`ordercontent`.`product` = `products`.`pid`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-15  0:21:16
