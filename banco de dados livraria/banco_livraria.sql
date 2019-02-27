CREATE DATABASE  IF NOT EXISTS `livraria_inf3ma` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `livraria_inf3ma`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: localhost    Database: livraria_inf3ma
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.34-MariaDB

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
-- Table structure for table `autores`
--

DROP TABLE IF EXISTS `autores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autores` (
  `idAutores` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `ativarDesativar` tinyint(1) NOT NULL,
  PRIMARY KEY (`idAutores`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autores`
--

LOCK TABLES `autores` WRITE;
/*!40000 ALTER TABLE `autores` DISABLE KEYS */;
INSERT INTO `autores` VALUES (1,'Augusto Jorge Cury','Augusto Jorge Cury (Colina, 2 de outubro de 1958) é também doutor em psicanálise (doutorado livre - com mais detalhes abaixo, em sua biografia)[1][2][3][4], professor[5][6][7], escritor brasileiro e médico psiquiatra. É o autor da Teoria da Inteligência Multifocal[8] e seus livros foram publicados em mais de 70 países, com mais de 25 milhões de livros vendidos somente no Brasil.','arquivos/augusto-cury-15072016_142241-G.jpg',1),(58,'nicolas','top','arquivos/6f3a68e88a2b7292f6d60f5898b7aff3.jpg',1);
/*!40000 ALTER TABLE `autores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `ativarDesativar` tinyint(4) NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Técnicos',1),(2,'Didáticos',1),(3,'Religiosos',1),(4,'Infantis',1);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faleconosco`
--

DROP TABLE IF EXISTS `faleconosco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faleconosco` (
  `idFaleConosco` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `sexo` varchar(1) NOT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `celular` varchar(45) NOT NULL,
  `home` varchar(100) DEFAULT NULL,
  `sugestao` varchar(500) DEFAULT NULL,
  `informacoesProdutos` varchar(500) DEFAULT NULL,
  `profissao` varchar(100) NOT NULL,
  PRIMARY KEY (`idFaleConosco`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faleconosco`
--

LOCK TABLES `faleconosco` WRITE;
/*!40000 ALTER TABLE `faleconosco` DISABLE KEYS */;
INSERT INTO `faleconosco` VALUES (41,'rafael','matheus.silva@hotmail.com','4142-5869','M','d','11 99999-9999','sdasdasd','sfcacasdasdasd','dasdad','programador');
/*!40000 ALTER TABLE `faleconosco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livraria`
--

DROP TABLE IF EXISTS `livraria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livraria` (
  `idLivraria` int(11) NOT NULL AUTO_INCREMENT,
  `historia` varchar(500) NOT NULL,
  `missao` varchar(500) NOT NULL,
  `visao` varchar(500) NOT NULL,
  `slide` varchar(100) NOT NULL,
  `ativarDesativar` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idLivraria`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livraria`
--

LOCK TABLES `livraria` WRITE;
/*!40000 ALTER TABLE `livraria` DISABLE KEYS */;
INSERT INTO `livraria` VALUES (6,'na comercializaÃ§Ã£o de livros das mais variadas editoras, com atendimento Ã s diversas Ã¡reas, de acordo com as necessidades exigidas, de maneira eficiente, com o menor custo de aquisiÃ§Ã£o, comprometendo-se sempre no bom atendimento, no conforto do cliente e na qualidade dos produtos.','associar a imagem da livraria Ã  qualidade do atendimento. ','Queremos ser uma excelente loja de informaÃ§Ã£o e entretenimento e nos consolidar como referÃªncia no setor.','arquivos/938336d493941777096a183dc90a384e.jpg',0),(12,'gnhgn','ghnghnghn','hgnghn','arquivos/d378d261d886947130ebaaa1f91c5269.jpg',0),(13,'gnhgn','ghnghnghn','hgnghn','arquivos/d378d261d886947130ebaaa1f91c5269.jpg',0),(14,'gnhgn','ghnghnghn','hgnghn','arquivos/d378d261d886947130ebaaa1f91c5269.jpg',0),(15,'gnhgn','ghnghnghn','hgnghn','arquivos/d378d261d886947130ebaaa1f91c5269.jpg',0),(16,'gnhgn','ghnghnghn','hgnghn','arquivos/d378d261d886947130ebaaa1f91c5269.jpg',0),(17,'gnhgn','ghnghnghn','hgnghn','arquivos/d378d261d886947130ebaaa1f91c5269.jpg',0),(18,'gnhgn','ghnghnghn','hgnghn','arquivos/d378d261d886947130ebaaa1f91c5269.jpg',0),(19,'gnhgn','ghnghnghn','hgnghn','arquivos/d378d261d886947130ebaaa1f91c5269.jpg',0),(20,'gnhgn','ghnghnghn','hgnghn','arquivos/d378d261d886947130ebaaa1f91c5269.jpg',0),(21,'gnhgn','ghnghnghn','hgnghn','arquivos/d378d261d886947130ebaaa1f91c5269.jpg',0),(22,'gnhgn','ghnghnghn','hgnghn','arquivos/d378d261d886947130ebaaa1f91c5269.jpg',0),(23,'gnhgn','ghnghnghn','hgnghn','arquivos/d378d261d886947130ebaaa1f91c5269.jpg',0),(24,'gnhgn','ghnghnghn','hgnghn','arquivos/d378d261d886947130ebaaa1f91c5269.jpg',0),(25,'gnhgn','ghnghnghn','hgnghn','arquivos/d378d261d886947130ebaaa1f91c5269.jpg',0),(26,'gnhgn','ghnghnghn','hgnghn','arquivos/d378d261d886947130ebaaa1f91c5269.jpg',0),(27,'gnhgn','ghnghnghn','hgnghn','arquivos/d378d261d886947130ebaaa1f91c5269.jpg',1);
/*!40000 ALTER TABLE `livraria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lojas`
--

DROP TABLE IF EXISTS `lojas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lojas` (
  `idLojas` int(11) NOT NULL AUTO_INCREMENT,
  `cidade` varchar(45) NOT NULL,
  `Telefone` varchar(16) NOT NULL,
  `celular` varchar(16) NOT NULL,
  `endereco` varchar(400) NOT NULL,
  `ativarDesativar` tinyint(4) NOT NULL,
  PRIMARY KEY (`idLojas`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lojas`
--

LOCK TABLES `lojas` WRITE;
/*!40000 ALTER TABLE `lojas` DISABLE KEYS */;
INSERT INTO `lojas` VALUES (15,'Cotia','4142-5869','11 99999-9999','R.joao almeida,45 Cotia',1),(21,'Barueri','4142-5869','11 99999-9999','Rua Corinthians preto branco, 1910 São Paulo',1),(22,'Osasco','(11) 1111-1111','(011) 97878-985','rua de teste, 666',1);
/*!40000 ALTER TABLE `lojas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivelusuario`
--

DROP TABLE IF EXISTS `nivelusuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nivelusuario` (
  `idNivelUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nivel` varchar(45) DEFAULT NULL,
  `ativarDesativar` tinyint(1) NOT NULL,
  PRIMARY KEY (`idNivelUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivelusuario`
--

LOCK TABLES `nivelusuario` WRITE;
/*!40000 ALTER TABLE `nivelusuario` DISABLE KEYS */;
INSERT INTO `nivelusuario` VALUES (48,'root',1),(111,'Usuário padrão',1),(113,'admin',1);
/*!40000 ALTER TABLE `nivelusuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto_livro`
--

DROP TABLE IF EXISTS `produto_livro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto_livro` (
  `idProduto_Livro` int(11) NOT NULL AUTO_INCREMENT,
  `idProduto` int(11) NOT NULL,
  `idAutores` int(11) NOT NULL,
  PRIMARY KEY (`idProduto_Livro`),
  KEY `livro_idx` (`idProduto`),
  KEY `autores_idx` (`idAutores`),
  CONSTRAINT `autores` FOREIGN KEY (`idAutores`) REFERENCES `autores` (`idAutores`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `livro` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`idProdutos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto_livro`
--

LOCK TABLES `produto_livro` WRITE;
/*!40000 ALTER TABLE `produto_livro` DISABLE KEYS */;
/*!40000 ALTER TABLE `produto_livro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `idProdutos` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `preco` varchar(100) NOT NULL,
  `ativarDesativar` tinyint(1) NOT NULL,
  `livroMes` tinyint(4) DEFAULT NULL,
  `idAutores` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProdutos`),
  KEY `idAutores_idx` (`idAutores`),
  CONSTRAINT `idAutores` FOREIGN KEY (`idAutores`) REFERENCES `autores` (`idAutores`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'A volta dos que não foram','livro top dms','arquivos/3fabcae0952ff6beac4ace7b162d539e.jpg','10',1,0,1),(2,'Emoções','emoções top','arquivos/3fabcae0952ff6beac4ace7b162d539e.jpg','40',1,0,1),(3,'Vitoriosa','menina muito pequena no SENAI','arquivos/l.jpg','60',1,0,1),(4,'Php','asas','arquivos/e623b0d6e79808381c9c1805e3ebb3cb.jpg','70',1,0,1),(6,'PHP5','O PHP (um acrÃ´nimo recursivo para PHP: Hypertext Preprocessor) Ã© uma linguagem de script open source de uso geral, muito utilizada, e especialmente adequada para o desenvolvimento web e que pode ser embutida dentro do HTML.','arquivos/1975965fffbeccebd23a2c6e98ab2bf5.jpg','50',1,0,1),(11,'Nicolas','cascasc','arquivos/0bf11d0aba557dc6ff454fa9e63585b0.jpg','50',1,0,58);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promocao`
--

DROP TABLE IF EXISTS `promocao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promocao` (
  `idPromocao` int(11) NOT NULL AUTO_INCREMENT,
  `idProdutos` int(11) DEFAULT NULL,
  `desconto` int(11) NOT NULL,
  `ativarDesativar` tinyint(1) NOT NULL,
  PRIMARY KEY (`idPromocao`),
  KEY `desconto_idx` (`idProdutos`),
  CONSTRAINT `desconto` FOREIGN KEY (`idProdutos`) REFERENCES `produtos` (`idProdutos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promocao`
--

LOCK TABLES `promocao` WRITE;
/*!40000 ALTER TABLE `promocao` DISABLE KEYS */;
INSERT INTO `promocao` VALUES (1,1,60,1),(67,3,30,1),(68,3,25,1),(70,6,1,1);
/*!40000 ALTER TABLE `promocao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategoria`
--

DROP TABLE IF EXISTS `subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategoria` (
  `idsubCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `ativarDesativar` tinyint(4) NOT NULL,
  PRIMARY KEY (`idsubCategoria`),
  KEY `categoria_idx` (`idCategoria`),
  CONSTRAINT `categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategoria`
--

LOCK TABLES `subcategoria` WRITE;
/*!40000 ALTER TABLE `subcategoria` DISABLE KEYS */;
INSERT INTO `subcategoria` VALUES (1,'Informática',1,1),(2,'Eletrônica',1,1),(3,'Mecânica',1,1),(4,'Português',2,1),(5,'Matemática',2,1),(6,'Fisica',2,1),(7,'Católico',3,1),(8,'desenho',4,1);
/*!40000 ALTER TABLE `subcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategoria_produto`
--

DROP TABLE IF EXISTS `subcategoria_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategoria_produto` (
  `idsubCategoria_Produto` int(11) NOT NULL AUTO_INCREMENT,
  `idSubcategoria` int(11) NOT NULL,
  `idProdutos` int(11) NOT NULL,
  PRIMARY KEY (`idsubCategoria_Produto`),
  KEY `subCategoria_idx` (`idSubcategoria`),
  KEY `produtos_idx` (`idProdutos`),
  CONSTRAINT `produtos` FOREIGN KEY (`idProdutos`) REFERENCES `produtos` (`idProdutos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `subCategoria` FOREIGN KEY (`idSubcategoria`) REFERENCES `subcategoria` (`idsubCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategoria_produto`
--

LOCK TABLES `subcategoria_produto` WRITE;
/*!40000 ALTER TABLE `subcategoria_produto` DISABLE KEYS */;
INSERT INTO `subcategoria_produto` VALUES (1,1,4),(3,5,6),(8,8,11);
/*!40000 ALTER TABLE `subcategoria_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `nivel` int(11) NOT NULL,
  `AtivarDesativar` tinyint(1) NOT NULL,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `cd_idx` (`nivel`),
  CONSTRAINT `nivelUsuario` FOREIGN KEY (`nivel`) REFERENCES `nivelusuario` (`idNivelUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (35,'nicolas','123',48,1,'nicolas'),(44,'marcos','123',48,1,'Nicolas');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-27 16:15:37
