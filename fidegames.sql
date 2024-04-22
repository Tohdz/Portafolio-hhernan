CREATE DATABASE  IF NOT EXISTS `fidegames` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `fidegames`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: fidegames
-- ------------------------------------------------------
-- Server version	8.0.35

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
-- Table structure for table `contacto`
--

DROP TABLE IF EXISTS `contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `mensaje` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacto`
--

LOCK TABLES `contacto` WRITE;
/*!40000 ALTER TABLE `contacto` DISABLE KEYS */;
INSERT INTO `contacto` VALUES (1,'Alonso Perez Lopez','alopelo@gmail.com','Me gustaria recibir notificaciones de nuevos emuladores'),(2,'Nath Carrillo Garita','nathcargari@gmail.com','Podrian incluir un emulador de ps5'),(5,'Daniela Navarro Vargas','danivargas@gmail.com','Quisiera ver mas tutoriales de juegos');
/*!40000 ALTER TABLE `contacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emulador`
--

DROP TABLE IF EXISTS `emulador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emulador` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `consola` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `year` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `descarga` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `imagen` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`nombre`),
  UNIQUE KEY `id_2` (`nombre`),
  UNIQUE KEY `name` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emulador`
--

LOCK TABLES `emulador` WRITE;
/*!40000 ALTER TABLE `emulador` DISABLE KEYS */;
INSERT INTO `emulador` VALUES (1,'PPSSPP2','PSP','2004','Emulador de PSP','https://www.ppsspp.org/download/','https://th.bing.com/th/id/OIP.REVIcg2Zr21-vYfUnJ7orAHaHa?rs=1&pid=ImgDetMain');
/*!40000 ALTER TABLE `emulador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `games` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `year` year NOT NULL,
  `emulator` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `extension` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'NULL',
  `bios` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES (1,'2024-03-05 20:45:14',1990,'snes','Super Mario World is often considered one of the best games in the series and is cited as one of the greatest video games ever made. It sold more than twenty million copies worldwide, making it the best-selling SNES game. It also led to an animated television series of the same name and a 1995 sequel, Yoshi\'s Island. The game has been re-released on multiple occasions: It was part of the 1994 compilation Super Mario All-Stars + Super Mario World for the SNES and was re-released for the Game Boy Advance as Super Mario World: Super Mario Advance 2 in 2001, on the Virtual Console for the Wii, Wii U, and New Nintendo 3DS consoles, and as part of the Super NES Classic Edition. In 2019, it was released for Nintendo Switch Online as part of the classic games service.','Super Mario World','sfc',NULL),(2,'2024-03-05 23:18:00',1999,'psx','Pepsiman is an action video game developed and published by KID for the PlayStation. It was released in Japan on March 4, 1999, and is based on the eponymous Japanese superhero mascot for the American carbonated soft drink Pepsi.','Pepsiman','iso','scph5500.bin');
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `game_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticia`
--

DROP TABLE IF EXISTS `noticia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `noticia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `imagen` varchar(1024) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `cuerpo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticia`
--

LOCK TABLES `noticia` WRITE;
/*!40000 ALTER TABLE `noticia` DISABLE KEYS */;
INSERT INTO `noticia` VALUES (1,'https://media.vandal.net/i/1280x720/3-2024/20/202432011551779_1.jpg.webp','Metal Gear Solid 5: Ground Zeroes, el prologo de The Phantom Pain, cumple 10 años','Metal Gear Solid V: Ground Zeroes ha cumplido diez años. Se trata del prólogo\nde Metal Gear Solid V: The Phantom Pain y llegó tanto a PlayStation 4, Xbox\nOne y PC como a la generación anterior PlayStation 3 y Xbox 360. Los dos\nepisodios se lanzaron de manera conjunta en la edición Metal Gear Solid V: The\nDefinitive Experience'),(2,'https://media.vandal.net/i/1280x720/3-2024/19/202431912572483_1.jpg.webp','PS5 Pro tendría una potente tecnologia de reescalado: PSSR podría ofrecer 4K a 120 fps y 8K a 60 fps','La tecnología de reescalado utilizando inteligencia artificial PlayStation Spectral\nSuper Resolution podría suponer un paso decisivo para PlayStation a partir de\nPS5 Pro, el modelo mejorado de la consola actual de Sony del que se han filtrado\nlas características y que podría alcanzar las 120 imágenes por segundo en los\njuegos a 4 K y 60 FPS a 8K, según informa Insidergaming.'),(25,'images/subidas/mario.png',' Última Hora: Mario se despide de la plataforma','En una noticia que ha sacudido a la comunidad de gamers y nostálgicos por igual, se ha confirmado que Mario, el icónico fontanero de Nintendo, se retirará oficialmente de la plataforma. La noticia fue anunciada por Shigeru Miyamoto, el creador del personaje, en una conferencia de prensa especial celebrada hoy.\r\n\r\nEsta sorprendente decisión llega después de casi cuatro décadas desde que Mario hizo su debut en el mundo de los videojuegos con \"Donkey Kong\" en 1981. Desde entonces, el personaje ha protagonizado innumerables juegos, películas, series y se ha convertido en un símbolo cultural reconocido en todo el mundo.\r\n\r\nAunque se ha especulado sobre las razones detrás de esta decisión, Miyamoto explicó que se trata de una \"pausa creativa\" para el personaje. \"Mario ha tenido una carrera excepcional y ha entretenido a generaciones de jugadores. Sentimos que es el momento adecuado para darle un descanso y explorar nuevas ideas y personajes\", comentó Miyamoto.\r\n\r\nLos fans de Mario han expresado su sorpresa y tristeza ante esta noticia en las redes sociales, donde el hashtag #AdiósMario se ha vuelto tendencia mundial. Muchos han compartido sus recuerdos y experiencias con los juegos de Mario a lo largo de los años, destacando la influencia positiva que el personaje ha tenido en sus vidas.\r\n\r\nA pesar de su retiro de la plataforma, Nintendo ha asegurado que Mario no desaparecerá por completo y que seguirá siendo parte de la familia de la compañía. Además, se han prometido nuevas experiencias y aventuras con otros personajes y franquicias de Nintendo en el futuro.\r\n\r\nPor ahora, los fans tendrán la oportunidad de despedirse de Mario en su último juego, que será lanzado próximamente y servirá como un homenaje al legado del fontanero más famoso del mundo de los videojuegos.\r\n\r\nCon el retiro de Mario de la plataforma, se cierra un capítulo importante en la historia de los videojuegos, pero también se abre la puerta a nuevas posibilidades y aventuras en el universo de Nintendo.');
/*!40000 ALTER TABLE `noticia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tutorial`
--

DROP TABLE IF EXISTS `tutorial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tutorial` (
  `id` int NOT NULL AUTO_INCREMENT,
  `imagen` varchar(1024) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `cuerpo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tutorial`
--

LOCK TABLES `tutorial` WRITE;
/*!40000 ALTER TABLE `tutorial` DISABLE KEYS */;
INSERT INTO `tutorial` VALUES (5,'images/subidas/mario.png','Vidas Infinitas Super Mario World',' 1. Primero deberás ingresar al nivel llamado ‘Donut Ghost House’,más popularmente conocido como la primera casa fantasma.\r\n 2. Antes de entrar asegúrate de que Mario o Luigi tenga la capa. De lo contrario, el truco no funcionará.\r\n 3. Una vez dentro del castillo embrujado, avanza una distancia considerable.\r\n 4. Da la vuelta y regresa a toda velocidad, cuando estás por llegar al inicio, pulsa el botón para volar.\r\n 5. Notarás que en la parte superior de la casa fantasma hay un hueco en el techo. Trata de ingresar por ese lugar.\r\n 6. Cuando te encuentres en la parte superior, simplemente avanza a toda velocidad, pero debes tener cuidado, ya que muchos fantasmas se pondrán en tu camino.\r\n 7. El camino se terminará y verás un vacío. No tengas miedo y salta.\r\n 8. Habrá una puerta que te permitirá completar el nivel. Ingresa y habrás abandonado el castillo embrujado.\r\n 9. Se abrirá un pequeño camino que lleva a un nivel desconocido. Ingresa a este nuevo mundo.\r\n 10. Verás cinco ladrillos que te darán una capa, la flor, un hongo, al dinosaurio Yoshi y una vida.\r\n 11. Cuando hayas recibido todos los premios, abandona el mundo. Luego vuelve a entrar y repite hasta que tengas una buena cantidad de vidas.');
/*!40000 ALTER TABLE `tutorial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `nombre_usuario` varchar(45) NOT NULL,
  `contrasena` varchar(200) NOT NULL,
  `id_rol` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Hector','Hernandez','hhernan93vargas@gmail.com','72063542','hhernan','$2a$12$J7Y.q3RJL066X0UvemaCyusXB3jcifECE0XLNqwABmU59/f2guOMq',1),(3,'Andres','Vargas','andresv@gmail.com','88888888','andresv','$2a$10$ReKtx7Qsrsklhx5qIaIZE.nPXRj9Fxq6/p7z9UsxNrWK73VWUshd2',2),(8,'ana','vargas','ana@gmail.com','88888888','ann','$2a$10$YQsIa2XtPHfF6tr1KM7nzOc4Qb4yRXw4l9ped3DHzheLXrwVIPvIu',2);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'fidegames'
--

--
-- Dumping routines for database 'fidegames'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-15  1:45:51
