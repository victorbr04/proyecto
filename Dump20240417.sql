CREATE DATABASE  IF NOT EXISTS `proyecto` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `proyecto`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: proyecto
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `camaras`
--

DROP TABLE IF EXISTS `camaras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `camaras` (
  `nombre` varchar(60) NOT NULL,
  `url` varchar(200) NOT NULL,
  `grupo` varchar(45) NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `camgrup_fk_idx` (`grupo`),
  CONSTRAINT `camgrup_fk` FOREIGN KEY (`grupo`) REFERENCES `grupo` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `camaras`
--

LOCK TABLES `camaras` WRITE;
/*!40000 ALTER TABLE `camaras` DISABLE KEYS */;
INSERT INTO `camaras` VALUES ('Camara 1','https://in2thebeach.es/callbacks/camviewer_ext2.php?id=3','seguridad1',28),('Camara 1','https://in2thebeach.es/callbacks/camviewer_ext2.php?id=3','seguridad2',29),('Camara 2','https://in2thebeach.es/callbacks/camviewer_ext2.php?id=3','seguridad1',30),('Camara 2','https://in2thebeach.es/callbacks/camviewer_ext2.php?id=3','seguridad2',31),('Camara 3','https://in2thebeach.es/callbacks/camviewer_ext2.php?id=3','seguridad2',34),('Camara 3','https://in2thebeach.es/callbacks/camviewer_ext2.php?id=3','seguridad1',36),('Camara 1','https://in2thebeach.es/callbacks/camviewer_ext2.php?id=3','seguridad3',38),('Camara 2','https://in2thebeach.es/callbacks/camviewer_ext2.php?id=3','seguridad3',39),('Camara 3','https://in2thebeach.es/callbacks/camviewer_ext2.php?id=3','seguridad3',40);
/*!40000 ALTER TABLE `camaras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupo` (
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`nombre`),
  UNIQUE KEY `idrol_UNIQUE` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo`
--

LOCK TABLES `grupo` WRITE;
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` VALUES ('seguridad1'),('seguridad2'),('seguridad3');
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `nombre` varchar(45) NOT NULL,
  `contraseña` varchar(60) NOT NULL,
  `rol` varchar(45) NOT NULL,
  `grupo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`nombre`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  KEY `grupo_fk_idx` (`grupo`),
  CONSTRAINT `grupos_fk` FOREIGN KEY (`grupo`) REFERENCES `grupo` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('admin','$2y$10$HyQA6O/MKdkPmFonNQ77qelWNB8i6pCy6U76ekFqhlteWGsNN3mn.','admin',NULL),('seg1','$2y$10$bfSyC.YVxs8xP9SVVYZbouNcllg//XI9FaR7ao5cyM14IrFC7A/oK','viewer','seguridad1'),('seg2','$2y$10$UMog3cl/U50Xxs820F2Am.9iX2oKHUbeV.tqhAXHkfYZnP/kpdbCG','viewer','seguridad2'),('seg3','$2y$10$CBVpoptay1jIwf4fPHZmjOoiDeGfo/otqMLPMMUG5vI/WYg4zJNNK','viewer','seguridad3');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-17 13:34:40
