-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: formulario
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `cadastro`
--

DROP TABLE IF EXISTS `cadastro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cadastro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(19) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `nivel` varchar(50) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cadastro`
--

LOCK TABLES `cadastro` WRITE;
/*!40000 ALTER TABLE `cadastro` DISABLE KEYS */;
INSERT INTO `cadastro` VALUES (1,'hugo','hugo.mota@insted.edu.br','+11 (11) 11111-1111','reHd2KRemII=','Administrador','2024-10-17 10:08:33'),(8,'Usuário 2','hugomota116@gmail.com','+00 (00) 12345-6789','ut/b26RemII=','Usuário','2024-12-02 20:51:55');
/*!40000 ALTER TABLE `cadastro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(128) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (5,'Categoria 1','2024-12-02 19:57:50'),(6,'Categoria 2','2024-12-02 20:04:02');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `data_verificacao` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email`
--

LOCK TABLES `email` WRITE;
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
INSERT INTO `email` VALUES (7,'hugo.mota@insted.edu.br','2024-12-02 19:05:29'),(8,'hugomota116@gmail.com','2024-12-02 20:52:38');
/*!40000 ALTER TABLE `email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entrada_estoque`
--

DROP TABLE IF EXISTS `entrada_estoque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `entrada_estoque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto` varchar(128) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `fornecedor` varchar(50) NOT NULL,
  `data_entrada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrada_estoque`
--

LOCK TABLES `entrada_estoque` WRITE;
/*!40000 ALTER TABLE `entrada_estoque` DISABLE KEYS */;
INSERT INTO `entrada_estoque` VALUES (15,'Produto 01',10,'Empresa 1','2024-12-02 04:00:00'),(16,'Produto 01',10,'Empresa 1','2024-12-02 04:00:00'),(17,'Produto 02',20,'Empresa 1','2024-12-02 04:00:00');
/*!40000 ALTER TABLE `entrada_estoque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fornecedor`
--

DROP TABLE IF EXISTS `fornecedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fornecedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `contato` varchar(19) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `logradouro` varchar(128) NOT NULL,
  `bairro` varchar(128) NOT NULL,
  `numero` varchar(128) NOT NULL,
  `cidade` varchar(128) NOT NULL,
  `estado` varchar(128) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedor`
--

LOCK TABLES `fornecedor` WRITE;
/*!40000 ALTER TABLE `fornecedor` DISABLE KEYS */;
INSERT INTO `fornecedor` VALUES (3,'Empresa 1','11.111.111/1111-11','+11 (11) 11111-1111','empresa119@gmail.com','materia-prima','11111-111','Rua 1','Bairro 1','1','Cidade 1','MS','2024-12-02 20:00:55'),(4,'Empresa 2','22.222.222/2222-22','+22 (22) 2222-2222','empresa132@gmail.com','produtos-acabados','22222-222','Avenida 2','Bairro 2','2','Cidade 2','MS','2024-12-02 20:08:14');
/*!40000 ALTER TABLE `fornecedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `data_login` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (15,'hugo.mota@insted.edu.br','2024-12-02 18:47:41'),(16,'hugo.mota@insted.edu.br','2024-12-02 19:05:29'),(17,'hugomota116@gmail.com','2024-12-02 20:52:38');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcadastro` int(11) NOT NULL,
  `nome` varchar(128) NOT NULL,
  `codigo` varchar(5) NOT NULL,
  `tipo` varchar(128) NOT NULL,
  `preco_custo` decimal(10,2) NOT NULL,
  `preco_venda` decimal(10,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `validade` date NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idcadastro` (`idcadastro`),
  CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`idcadastro`) REFERENCES `cadastro` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (5,1,'Produto 01','11111','Categoria 1',15.00,30.00,50,'2024-12-30','2024-12-02 19:58:15'),(6,1,'Produto 02','22222','Categoria 1',10.00,20.00,70,'2024-12-31','2024-12-02 20:04:28');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saida_estoque`
--

DROP TABLE IF EXISTS `saida_estoque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `saida_estoque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto` varchar(128) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `destinatário` varchar(50) NOT NULL,
  `data_saida` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saida_estoque`
--

LOCK TABLES `saida_estoque` WRITE;
/*!40000 ALTER TABLE `saida_estoque` DISABLE KEYS */;
INSERT INTO `saida_estoque` VALUES (7,'Produto 01',10,'Pessoa 1','2024-12-02 04:00:00'),(8,'Produto 01',10,'Pessoa 1','2024-12-02 04:00:00');
/*!40000 ALTER TABLE `saida_estoque` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-02 20:40:09
