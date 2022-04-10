CREATE DATABASE  IF NOT EXISTS `phpDB` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_hungarian_ci */;
USE `phpDB`;
-- MariaDB dump 10.19  Distrib 10.7.3-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: phpDB
-- ------------------------------------------------------
-- Server version	10.7.3-MariaDB

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES
(1,'Levesek','Húsos, zöldséges levesek, alaplevek','levesek.jpg','2022-04-10 13:11:03'),
(2,'Főzelékek','Finom főzelékek','fozelek.jpg','2022-04-08 08:32:57'),
(11,'Palacsinták','Alapreceptek, speciális palacsinták','palik.jpg','2022-04-10 13:10:09'),
(12,'Saláták','Egészséges saláták receptjei         ','salata.jpg','2022-04-08 09:01:16'),
(34,'Pizzák','Pizzareceptek, alaptészták','1649448093_pizzak.jpg','2022-04-10 13:09:50');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `instruction` text NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `cooking_time` varchar(45) DEFAULT NULL,
  `servings` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_recipe_idx` (`category_id`),
  CONSTRAINT `fk_recipe` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe`
--

LOCK TABLES `recipe` WRITE;
/*!40000 ALTER TABLE `recipe` DISABLE KEYS */;
INSERT INTO `recipe` VALUES
(1,1,'Húsleves','Finom húsleves','Készítsd el','husleves.jpg','',248,'2022-04-10 15:32:55','180','4 főre'),
(2,2,'Finomfőzelék','Mennyei Klasszikus finomfőzelék recept! Ki ne emlékezne a régi jó menzás finomfőzelékre?!','### Hozzávalók:\r\n- 90 dkg sárgarépa                        \r\n- 80 dkg petrezselyemgyökér                        \r\n- 50 dkg karalábé                        \r\n- 50 dkg kelvirág                        \r\n- 20 dkg zöldborsó                       \r\n- 10 dkg zsír                        \r\n- 15 dkg liszt                        \r\n- 1 csomó petrezselyemzöld                        \r\n- 6 dkg cukor                        \r\n- 3 dl tej                        \r\n- 3 dkg só                        \r\nJavasolt folyadékmennyiség (csontlébol) 3 l                       \r\n\r\n##### Csontléhez:                        \r\n- 50 dkg sertéscsont                        \r\n- 30 dkg sárgarépa                        \r\n- 25 dkg petrezselyemgyökér                        \r\n- 10 dkg zellergumó                        \r\nJavasolt folyadékmennyiség (felére beforralva): 6 l \r\n                                                      \r\n### Elkészítés:\r\nA megtisztított és megmosott sárgarépát,                         \r\npetrezselyemgyökeret és karalábét 1x1 cm-es kockákra                         \r\ndaraboljuk. A kelvirágot rózsáira szedjük, beáztatjuk,                         \r\nés megmossuk. A petrezselyemzöldet finomra vágjuk. A                         \r\nkonzerv zöldborsót leszurjük, és ha szükséges jól                        \r\nlemossuk.                       \r\n\r\nA kockákra vágott zöldségeket, a karalábét, a kelvirágot                         \r\nkello nagyságú lábasba helyezzük. Annyi csontlét vagy                         \r\nvizet öntünk rá, hogy ellepje. Felforraljuk, megsózzuk,                         \r\nés fedo alatt puhára fozzük.                        \r\n\r\nA konzerv zöldborsót a puhára fozött zöldségekhez,                        \r\nkaralábéhoz, kelvirághoz adjuk. Világos rántást                       \r\nkészítünk, hozzáadjuk a finomra vágott                         \r\npetrezselyemzöldet. Hideg vízzel felengedjük. A rántást                         \r\nhabverovel simára keverjük, a fozelékhez adjuk.                         \r\nFelforraljuk, tejet adunk hozzá. Sóval és cukorral                         \r\nízesítjük.                        \r\n\r\nA fozeléket óvatosan kevergetve, mérsékelt tuzön lassan                         \r\nkiforraljuk. Jó ízt ad a fozeléknek ha a végén vajban                      \r\npárolt, finomra vágott petrezselyemzöldet adunk hozzá. ','finomfozelek.jpg','',79,'2022-04-10 13:06:08','30','2 főre'),
(3,1,'Rántott leves','Tojással finom','Készítsd el','rantottleves.jpg','',144,'2022-04-10 13:11:18','20','családi'),
(5,1,'Marhahúsleves','Ez az elkészítés módja','Még nem tudom, hogyan kell','default_recipe.png','https://www.youtube.com/embed/t6GHdkk3Im4',14,'2022-04-08 21:54:39','',''),
(8,11,'Kakaós palacsinta','Röviden','Hosszan','1649592284_palik.jpg','',12,'2022-04-10 12:12:47','30','4'),
(21,1,'Francia hagymaleves','Egy egyszerű, finom, gyorsan elkészíthető hagymaleves','### Hozzávalók:\r\n- 1 l csirke alaplé \r\n- 1 ek vaj \r\n- 2 ek olívaolaj \r\n- 1 dl fehérbor (száraz) \r\n- szerecsendió ízlés szerint \r\n- fehér bors ízlés szerint \r\n- 15 dkg sajt (reszelt, karakteresebb ízű félkemény sajt a legfinomabb) \r\n- 3 evőkanál finomliszt \r\n- 4 szelet toast kenyér\r\n\r\n---\r\n### Elkészítés:\r\n1. A fokhagymát apró kockákra, a vöröshagymát vékony karikákra vágjuk; a vajon és az olívaolajon lassú tűzön megdinszteljük. \r\n2. Meghintjük két evőkanál liszttel, párszor megkeverjük, majd felöntjük forró húslevessel. \r\n3. Hozzáadjuk a fehérbort, megfűszerezzük és forrás után még15 percig főzzük. (A hagymát ekkor botmixerrel pépesíthetjük, én azonban jobban szeretem hagymadarabokkal, így nálam ez a lépés elmarad.) \r\n 4. A leveses tálkákba reszelt sajtot teszünk, erre merjük a levest, frissen őrölt borsot tekerünk rá, hozzá pirítóst tálalunk. ','1649589872_frhagymaleves.jpg','//content.jwplatform.com/players/n1QKyx2q-EFfLSeuf.html',21,'2022-04-10 13:09:08','30','4'),
(22,1,'Gombaleves','Egy régi recept szerint','### Elkészítés:\r\nEgy fazékba tegyünk forrni annyi vizet, a mennyire szükségünk van: három személyre mindenkor egy liter vizet számíthatunk. Tegyünk a vízbe mindenféle zöldséget, sót és borsot; azalatt míg a víz forr, egy lábasba tegyünk egy kanál zsírt rántásnak, három személyre egy fakanál lisztet számítva. A rántást öntsük a zöldséges lébe és ha a leves a rántással együtt jól felforrt, szűrjük át szitán, tegyünk bele sáfrányt és apróra vágott zöld petrezselyem levelet, azután újra forraljuk fel. Ha fő, tegyünk bele szépen megmosott és felvágott csiperke gombát; mindezt negyedóráig főzzük.\r\n\r\nTálaláskor tegyünk a tányérra zsírban pirított zsemlekockákat.','1649595766_gombaleves.jpg','',8,'2022-04-10 16:12:54','60','3 főre'),
(26,34,'Alap pizza tészta','Alap pizzatészta recept','### Hozzávalók:\r\n- 50 dkg liszt\r\n- 1 tojás sárgája\r\n- 2-3 dkg élesztõ\r\n- 1 dl tej\r\n- 20 dkg Rama margarin\r\n- 2-3 db fõtt burgonya törve\r\n- egy mokkáskanál só\r\n\r\n### Elkészítés:\r\nA tejben elmorzsoljuk és megfuttatjuk az élesztőt, jól összedolgozzuk a tésztát, és kelésig pihentetjük. \r\nDuplájára megkel, akkor lesz megfelelő.','1649592710_alap_pizza.jpeg','',12,'2022-04-10 12:37:05','50','4'),
(27,12,'Cézársaláta','Cézársaláta gazdagon','### A salátához\r\n- 1 közepes fej jégsaláta\r\n- 1 db kígyóuborka\r\n- 4 közepes db paradicsom\r\n- 20 dkg csirkemellfilé\r\n- 10 dkg kruton (pirított kenyérkockák)\r\n\r\n### Az öntethez\r\n- 1 db tojássárgája\r\n- 2 tk mustár\r\n- 4 teáskanál olívaolaj\r\n- 2 gerezd fokhagyma\r\n-  1 csipet petrezselyem\r\n- 1 csipet oregánó\r\n- 1 csipet bors\r\n- 1 csipet só\r\n- 2 dl főzőtejszín\r\n- 1 teáskanál worcestershire-szósz\r\n\r\n### Elkészítés\r\n##### A salátához\r\n\r\n1. A jégsalátát kettévágjuk, mindkét felét felszeleteljük, 1-1 tálba szórjuk.\r\n2. A paradicsomokat és az uborkát is felszeleteljük, egyenletesen elosztjuk a két tálban.\r\n3. Kézi habverővel kikeverjük az öntetet, (a lényeg, hogy a végén krémes állagú legyen) a tojássárgáját először a mustárral keverjük el, majd hozzáadjuk az olajat és a fűszereketvalamint az összezúzottfokhagymát, végül a tejszínt és a Worchester-szószt. (Ízlés szerint bármiből adagolhatunk akár többet is, főleg, ha az erőteljesebb ízeket kedveljük.)\r\n4. A kész öntetet szintén kettéosztjuk és a két adag salátára kanalazzuk (át is forgathatjuk).\r\n5. A csirkemell filét felkockázzuk, sózzuk, borsozzuk és serpenyőben hirtelen megpirítjuk. Frissen sülve a salátákra halmozzuk.\r\n6. Megszórjuk az adagokat krutonnal (pirított kenyérkockával), fokhagymás-pirítóst teszünk mellé és azonnal tálaljuk.\r\n\r\n','1649607675_cézársaláta.jpg','',4,'2022-04-10 16:21:15','20','4 főre');
/*!40000 ALTER TABLE `recipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(45) NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `role` varchar(45) NOT NULL,
  `img` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'mgodisai@gmail.com','$2a$12$6CEuppFBgcOWQvdYXOMXieezFqVo3aar7dzvbXXqAjNlu70tZpP16','mgodisai','Tamás','Varga','admin','vt.jpg'),
(2,'admin@test.hu','$2a$12$KhQzGdfQctZ0b6QGCqgVUeNTSo9hsD0zIbqswC2WIRuONw5a1YoE6','admin_user','test','user','admin','generaluser.png'),
(4,'editor@test.hu','$2a$12$KhQzGdfQctZ0b6QGCqgVUeNTSo9hsD0zIbqswC2WIRuONw5a1YoE6','test_user','test2','user','editor','generaluser.png'),
(5,'user@test.hu','$2a$12$KhQzGdfQctZ0b6QGCqgVUeNTSo9hsD0zIbqswC2WIRuONw5a1YoE6','user_user','Áron','Bármi','user','generaluser.png');
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

-- Dump completed on 2022-04-10 21:53:37
