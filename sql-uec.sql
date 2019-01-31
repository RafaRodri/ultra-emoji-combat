CREATE DATABASE  IF NOT EXISTS `ultra-emoji` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ultra-emoji`;
-- MySQL dump 10.13  Distrib 8.0.13, for Win64 (x86_64)
--
-- Host: localhost    Database: ultra-emoji
-- ------------------------------------------------------
-- Server version	8.0.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `pesoMinimo` decimal(5,2) NOT NULL,
  `pesoMaximo` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Leve',52.20,70.39),(2,'Médio',70.40,83.99),(3,'Pesado',84.00,120.29);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `local` int(11) NOT NULL,
  `alpha3Code` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Evento_Status_idx` (`status`),
  CONSTRAINT `fk_Evento_Status` FOREIGN KEY (`status`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
INSERT INTO `evento` VALUES (1,2,'UEC Brasilia',76,'BRA','1992-02-07 22:00:00');
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `luta`
--

DROP TABLE IF EXISTS `luta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `luta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `evento` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `rounds` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`,`status`,`evento`,`categoria`),
  KEY `fk_Luta_Status1_idx` (`status`),
  KEY `fk_Luta_Categoria1_idx` (`categoria`),
  KEY `fk_Luta_Evento1_idx` (`evento`),
  CONSTRAINT `fk_Luta_Categoria1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`),
  CONSTRAINT `fk_Luta_Evento1` FOREIGN KEY (`evento`) REFERENCES `evento` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_Luta_Status1` FOREIGN KEY (`status`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `luta`
--

LOCK TABLES `luta` WRITE;
/*!40000 ALTER TABLE `luta` DISABLE KEYS */;
INSERT INTO `luta` VALUES (1,1,1,1,5),(2,2,1,3,5);
/*!40000 ALTER TABLE `luta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `luta_desafiado`
--

DROP TABLE IF EXISTS `luta_desafiado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `luta_desafiado` (
  `idPessoa` int(11) NOT NULL,
  `idLuta` int(11) NOT NULL,
  PRIMARY KEY (`idPessoa`,`idLuta`),
  KEY `fk_Lutador_has_Luta_Luta1_idx` (`idLuta`),
  KEY `fk_Lutador_has_Luta_Lutador1_idx` (`idPessoa`),
  CONSTRAINT `fk_Lutador_has_Luta_Luta1` FOREIGN KEY (`idLuta`) REFERENCES `luta` (`id`),
  CONSTRAINT `fk_Lutador_has_Luta_Lutador1` FOREIGN KEY (`idPessoa`) REFERENCES `lutador` (`idpessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `luta_desafiado`
--

LOCK TABLES `luta_desafiado` WRITE;
/*!40000 ALTER TABLE `luta_desafiado` DISABLE KEYS */;
INSERT INTO `luta_desafiado` VALUES (13,1),(7,2);
/*!40000 ALTER TABLE `luta_desafiado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `luta_desafiante`
--

DROP TABLE IF EXISTS `luta_desafiante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `luta_desafiante` (
  `idPessoa` int(11) NOT NULL,
  `idLuta` int(11) NOT NULL,
  PRIMARY KEY (`idPessoa`,`idLuta`),
  KEY `fk_Lutador_has_Luta_Luta4_idx` (`idLuta`),
  KEY `fk_Lutador_has_Luta_Lutador4_idx` (`idPessoa`),
  CONSTRAINT `fk_Lutador_has_Luta_Luta4` FOREIGN KEY (`idLuta`) REFERENCES `luta` (`id`),
  CONSTRAINT `fk_Lutador_has_Luta_Lutador4` FOREIGN KEY (`idPessoa`) REFERENCES `lutador` (`idpessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `luta_desafiante`
--

LOCK TABLES `luta_desafiante` WRITE;
/*!40000 ALTER TABLE `luta_desafiante` DISABLE KEYS */;
INSERT INTO `luta_desafiante` VALUES (12,1),(8,2);
/*!40000 ALTER TABLE `luta_desafiante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `luta_vencedor`
--

DROP TABLE IF EXISTS `luta_vencedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `luta_vencedor` (
  `idPessoa` int(11) NOT NULL,
  `idLuta` int(11) NOT NULL,
  PRIMARY KEY (`idPessoa`,`idLuta`),
  KEY `fk_Lutador_has_Luta_Luta2_idx` (`idLuta`),
  KEY `fk_Lutador_has_Luta_Lutador2_idx` (`idPessoa`),
  CONSTRAINT `fk_Lutador_has_Luta_Luta2` FOREIGN KEY (`idLuta`) REFERENCES `luta` (`id`),
  CONSTRAINT `fk_Lutador_has_Luta_Lutador2` FOREIGN KEY (`idPessoa`) REFERENCES `lutador` (`idpessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `luta_vencedor`
--

LOCK TABLES `luta_vencedor` WRITE;
/*!40000 ALTER TABLE `luta_vencedor` DISABLE KEYS */;
INSERT INTO `luta_vencedor` VALUES (8,2);
/*!40000 ALTER TABLE `luta_vencedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lutador`
--

DROP TABLE IF EXISTS `lutador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lutador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPessoa` int(11) NOT NULL,
  `apresentacao` varchar(50) DEFAULT NULL,
  `categoria` int(11) NOT NULL,
  `vitorias` tinyint(3) DEFAULT NULL,
  `derrotas` tinyint(3) DEFAULT NULL,
  `empates` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`id`,`idPessoa`,`categoria`),
  KEY `fk_Lutador_Pessoa_idx` (`idPessoa`),
  KEY `fk_Lutador_Categoria1_idx` (`categoria`),
  CONSTRAINT `fk_Lutador_Categoria1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`),
  CONSTRAINT `fk_Lutador_Pessoa` FOREIGN KEY (`idPessoa`) REFERENCES `pessoa` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lutador`
--

LOCK TABLES `lutador` WRITE;
/*!40000 ALTER TABLE `lutador` DISABLE KEYS */;
INSERT INTO `lutador` VALUES (1,1,'Preeety Boooy',1,5,3,0),(2,2,'Putscript Silvaaaa',1,0,2,0),(3,3,'Snap Shadooow',2,1,2,0),(4,4,'Dead \"The Coalaaa\"',2,2,1,0),(5,5,'Ufo Coboool',3,8,10,4),(6,6,'Van Nerdaaard',3,11,8,4),(7,7,'Tom Pitbull',3,5,6,0),(8,8,'Ayrton Senna, do Brasiiil !',3,3,2,0),(9,9,'Cyyyyyborg',1,11,7,3),(10,10,'Maria Boniiita',1,1,7,1),(11,11,'Bia Cruuuz',1,4,3,0),(12,12,'Dragooon',1,8,7,2),(13,13,'Spider Siiiilva',1,2,2,0);
/*!40000 ALTER TABLE `lutador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paises`
--

DROP TABLE IF EXISTS `paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `paises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `abreviatura` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paises`
--

LOCK TABLES `paises` WRITE;
/*!40000 ALTER TABLE `paises` DISABLE KEYS */;
/*!40000 ALTER TABLE `paises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `pessoa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `apelido` varchar(50) DEFAULT NULL,
  `local` int(11) NOT NULL,
  `alpha3Code` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nascimento` date NOT NULL,
  `altura` decimal(3,2) NOT NULL,
  `peso` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa`
--

LOCK TABLES `pessoa` WRITE;
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` VALUES (1,'Pretty','Boy','Spider',76,'BRA','1988-11-23',1.75,68.90),(2,'Putscript','Silva','',76,'BRA','1989-02-12',1.68,57.80),(3,'Snap','Shadow','',76,'BRA','1983-08-19',1.65,80.90),(4,'Dead','Code','Coala',76,'BRA','1991-01-01',1.93,81.60),(5,'Ufo','Cobol','',76,'BRA','1981-08-18',1.70,119.30),(6,'Van','Nerdaard','',76,'BRA','1989-08-19',1.81,105.70),(7,'Tom','Jobim','Pitbull',76,'BRA','1960-02-29',1.65,88.88),(8,'Ayrton','Senna','Beco',76,'BRA','1960-03-21',1.70,89.99),(9,'Paty','Nunez','Cyborg',76,'BRA','1984-02-17',1.55,58.44),(10,'Maria','Bonita','Cangaço',76,'BRA','1996-07-22',1.68,57.60),(11,'Bia','Cruz','',76,'BRA','1991-03-20',1.65,60.40),(12,'Lioko','Matida','Dragon',76,'BRA','1992-02-07',1.88,70.00),(13,'Henderson','Souza','Spider',76,'BRA','1964-02-15',1.70,70.00);
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('0','1') NOT NULL,
  `nomeStatus` varchar(20) NOT NULL,
  `descricao` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=226 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'1','aprovada',''),(2,'0','encerrada',''),(3,'0','não aprovada','MESMO LUTADOR SELECIONADO DUAS VEZES'),(4,'0','não aprovada','OS DOIS LUTADORES ESTÃO FORA DO LIMITE DE PESO DESTA CATEGORIA'),(5,'0','não aprovada','O LUTADOR DESAFIADO PARA ESTA LUTA, ESTÁ FORA DO LIMITE DE PESO DA CATEGORIA'),(6,'0','não aprovada','O LUTADOR DESAFIANTE DESTA LUTA, ESTÁ FORA DO LIMITE DE PESO DA CATEGORIA');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ultra-emoji'
--
/*!50003 DROP FUNCTION IF EXISTS `fc_getCategoriaLutador` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `fc_getCategoriaLutador`(peso decimal(5,2)) RETURNS int(11)
    DETERMINISTIC
BEGIN
	DECLARE categoria int(11);
	DECLARE menorPeso decimal(5,2);
	DECLARE maiorPeso decimal(5,2);

	SELECT MIN(pesoMinimo) INTO menorPeso FROM categoria;
	SELECT MAX(pesoMaximo) INTO maiorPeso FROM categoria;
    
	IF (peso > menorPeso AND peso < maiorPeso) THEN
		SELECT categoria.id INTO categoria
		  FROM categoria
		  WHERE pesoMinimo <= peso AND pesoMaximo >= peso LIMIT 1;

	ELSE
		SET categoria = 0;
	END IF;
    
RETURN categoria;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_deleteCategoria` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_deleteCategoria`(
IN id int(11))
BEGIN

  DECLARE Msg VARCHAR (1000) DEFAULT "A 'categoria' selecionada, foi removida com sucesso";
  DECLARE statusInsert SMALLINT DEFAULT 0;

  DECLARE clausula VARCHAR(255) DEFAULT '';
  DECLARE findId int;
  
  DECLARE excessao SMALLINT DEFAULT 0;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET excessao = 1;
  
	SET @sql = '';

	SELECT COUNT(*) INTO findId FROM categoria WHERE categoria.id = id;
    
    
    
	IF(id IS NULL OR id = '') THEN
		SET Msg = 'Registro não informado para alteração';
	  
	ELSEIF(findId = 0) THEN
		SET Msg = 'Registro não encontrado para alteração';
        
	ELSE
		
		START TRANSACTION;

		DELETE FROM categoria WHERE categoria.id = id;
		
		IF excessao = 1 THEN
		  SET Msg = 'Erro ao deletar registro';
		  ROLLBACK;
		
		ELSE
		  SET statusInsert = 1;
		  COMMIT;
		END IF;
		
	END IF;
    
SELECT Msg, id, statusInsert AS statusOperacao;  

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_deleteEvento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_deleteEvento`(
IN id int(11))
BEGIN

  DECLARE Msg VARCHAR (1000) DEFAULT "O 'evento' selecionado, foi removido com sucesso";
  DECLARE statusInsert SMALLINT DEFAULT 0;
  
  DECLARE findId int;
  
  DECLARE excessao SMALLINT DEFAULT 0;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET excessao = 1;

	SELECT COUNT(*) INTO findId FROM evento WHERE evento.id = id;
    
    
    
	IF(id IS NULL OR id = '') THEN
		SET Msg = 'Registro não informado para alteração';
	  
	ELSEIF(findId = 0) THEN
		SET Msg = 'Registro não encontrado para alteração';
        
	ELSE
		
		START TRANSACTION;

		DELETE FROM evento WHERE evento.id = id;
		
		IF excessao = 1 THEN
		  SET Msg = 'Erro ao deletar registro';
		  ROLLBACK;
		
		ELSE
		  SET statusInsert = 1;
		  COMMIT;
		END IF;
		
	END IF;
    
SELECT Msg, id, statusInsert AS statusOperacao;  

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_deleteLuta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_deleteLuta`(
IN id int(11))
BEGIN

  DECLARE Msg VARCHAR (1000) DEFAULT "A 'luta' selecionada, foi removida com sucesso";
  DECLARE statusInsert SMALLINT DEFAULT 0;
  
  DECLARE findId int;
  DECLARE findStatusEncerrado int;
  DECLARE findStatusAtual int;
  
  DECLARE excessao SMALLINT DEFAULT 0;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET excessao = 1;

	SELECT COUNT(*) INTO findId FROM luta WHERE luta.id = id;
    
    
    
	IF(id IS NULL OR id = '') THEN
		SET Msg = 'Registro não informado para alteração';
	  
	ELSEIF(findId = 0) THEN
		SET Msg = 'Registro não encontrado para alteração';
        
	ELSE
		
		SELECT status.id INTO findStatusEncerrado FROM status WHERE status.nomeStatus = "encerrada";
		SELECT status INTO findStatusAtual FROM luta WHERE luta.id = id;
        
		IF (findStatusEncerrado = findStatusAtual) THEN
			SET Msg = 'Não é possível atualizar uma luta que já ocorreu';
		ELSE
        
			START TRANSACTION;

			DELETE FROM luta_desafiante WHERE luta_desafiante.idLuta = id;
			
			IF excessao = 1 THEN
			  SET Msg = 'Erro ao deletar desafiante';
			  ROLLBACK;
			
			ELSE
				
				DELETE FROM luta_desafiado WHERE luta_desafiado.idLuta = id;
				
				IF excessao = 1 THEN
				  SET Msg = 'Erro ao deletar desafiado';
				  ROLLBACK;
				
				ELSE
					
					DELETE FROM luta WHERE luta.id = id;
					
					IF excessao = 1 THEN
					  SET Msg = 'Erro ao deletar luta';
					  ROLLBACK;
					
					ELSE
					  SET statusInsert = 1;
					  COMMIT;
					END IF;
				END IF;
			END IF;
        
        END IF;
    
		
	END IF;
    
SELECT Msg, id, statusInsert AS statusOperacao;  

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_deleteLutador` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_deleteLutador`(
IN id int(11))
BEGIN

  DECLARE Msg VARCHAR (1000) DEFAULT "O 'lutador' selecionado, foi removido com sucesso";
  DECLARE statusInsert SMALLINT DEFAULT 0;
  
  DECLARE findId int;
  
  DECLARE excessao SMALLINT DEFAULT 0;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET excessao = 1;

	SELECT COUNT(*) INTO findId FROM pessoa WHERE pessoa.id = id;
    
    
    
	IF(id IS NULL OR id = '') THEN
		SET Msg = 'Registro não informado para alteração';
	  
	ELSEIF(findId = 0) THEN
		SET Msg = 'Registro não encontrado para alteração';
        
	ELSE
		
		START TRANSACTION;

		DELETE FROM lutador WHERE lutador.idPessoa = id;
		
		IF excessao = 1 THEN
          SET Msg = 'Erro ao deletar lutador';
		  ROLLBACK;
		
		ELSE
			
            DELETE FROM pessoa WHERE pessoa.id = id;
            
			IF excessao = 1 THEN
			  SET Msg = 'Erro ao deletar registro';
			  ROLLBACK;
			
			ELSE
			  SET statusInsert = 1;
			  COMMIT;
			END IF;
		END IF;
		
	END IF;
    
SELECT Msg, id, statusInsert AS statusOperacao;  

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_deletePaises` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_deletePaises`(
IN id int(11))
BEGIN

  DECLARE Msg VARCHAR (1000) DEFAULT "O 'país' selecionado, foi removido com sucesso";
  DECLARE statusInsert SMALLINT DEFAULT 0;

  DECLARE clausula VARCHAR(255) DEFAULT '';
  DECLARE findId int;
  
  DECLARE excessao SMALLINT DEFAULT 0;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET excessao = 1;
  
	SET @sql = '';

	SELECT COUNT(*) INTO findId FROM paises WHERE paises.id = id;
    
    
    
	IF(id IS NULL OR id = '') THEN
		SET Msg = 'Registro não informado para alteração';
	  
	ELSEIF(findId = 0) THEN
		SET Msg = 'Registro não encontrado para alteração';
        
	ELSE
		
		START TRANSACTION;

		DELETE FROM paises WHERE paises.id = id;
		
		IF excessao = 1 THEN
		  SET Msg = 'Erro ao deletar registro';
		  ROLLBACK;
		
		ELSE
		  SET statusInsert = 1;
		  COMMIT;
		END IF;
		
	END IF;
    
SELECT Msg, id, statusInsert AS statusOperacao;  

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_deleteStatus` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_deleteStatus`(
IN id int(11))
BEGIN

  DECLARE Msg VARCHAR (1000) DEFAULT "O 'status' selecionado, foi removido com sucesso";
  DECLARE statusInsert SMALLINT DEFAULT 0;

  DECLARE clausula VARCHAR(255) DEFAULT '';
  DECLARE findId int;
  
  DECLARE excessao SMALLINT DEFAULT 0;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET excessao = 1;
  
	SET @sql = '';

	SELECT COUNT(*) INTO findId FROM status WHERE status.id = id;
    
    
    
	IF(id IS NULL OR id = '') THEN
		SET Msg = 'Registro não informado para alteração';
	  
	ELSEIF(findId = 0) THEN
		SET Msg = 'Registro não encontrado para alteração';
        
	ELSE
		
		START TRANSACTION;

		DELETE FROM status WHERE status.id = id;
		
		IF excessao = 1 THEN
		  SET Msg = 'Erro ao deletar registro';
		  ROLLBACK;
		
		ELSE
		  SET statusInsert = 1;
		  COMMIT;
		END IF;
		
	END IF;
    
SELECT Msg, id, statusInsert AS statusOperacao;  

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_finalizarLuta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_finalizarLuta`(
idLuta int,
idVencedor int,
idPerdedor int,
ifEmpate int)
BEGIN
	DECLARE statusEncerrada int;
	DECLARE statusLuta int;
	DECLARE somaVencedor int;
	DECLARE somaPerdedor int;
	DECLARE nomeApresentacao varchar(60);
    
    
	SELECT id INTO statusEncerrada
    FROM status 
    WHERE nomeStatus='encerrada' LIMIT 1;
    
	SELECT luta.status INTO statusLuta
    FROM luta
    WHERE luta.id = idLuta;
    
    
    SET @sql = CONCAT('UPDATE luta SET status= "',statusEncerrada,'" WHERE id="',idLuta,'"');
    PREPARE STMT FROM @sql;
    EXECUTE STMT; 
    
    IF(statusLuta != statusEncerrada) THEN
			
		/* TEVE UM VENCEDOR */
		IF(ifEmpate != 0) THEN
		
			SELECT vitorias INTO somaVencedor
			FROM lutador 
			WHERE idPessoa=idVencedor;
			
			SELECT derrotas INTO somaPerdedor
			FROM lutador 
			WHERE idPessoa=idPerdedor;
			
			SELECT apresentacao INTO nomeApresentacao 
			FROM lutador 
			WHERE idPessoa=idVencedor;
			
			SELECT nomeApresentacao as apresentacao ;
			
		
			SET @sql = CONCAT('UPDATE lutador SET vitorias= "',somaVencedor+1,'" WHERE idPessoa="',idVencedor,'"');
			PREPARE STMT FROM @sql;
			EXECUTE STMT;   
			
			SET @sql = CONCAT('UPDATE lutador SET derrotas= "',somaPerdedor+1,'" WHERE idPessoa="',idPerdedor,'"');
			PREPARE STMT FROM @sql;
			EXECUTE STMT;
			
			SET @sql = CONCAT('INSERT INTO luta_vencedor VALUES ("',idVencedor,'", "',idLuta,'")');
			PREPARE STMT FROM @sql;
			EXECUTE STMT;
			
			
			
		/* LUTA EMPATOU */
		ELSE
		
			SELECT empates INTO somaVencedor
			FROM lutador 
			WHERE idPessoa=idVencedor;
			
			SELECT empates INTO somaPerdedor
			FROM lutador 
			WHERE idPessoa=idPerdedor;
			
			SELECT "empatou" as apresentacao;
			
		
			/* UPDATE `lutador` SET `vitorias` = '2' WHERE `lutador`.`id` = 21 AND `lutador`.`idPessoa` = 34 AND `lutador`.`categoria` = 3 */
			SET @sql = CONCAT('UPDATE lutador SET empates= "',somaVencedor+1,'" WHERE idPessoa="',idVencedor,'"');
			PREPARE STMT FROM @sql;
			EXECUTE STMT;   
			
			SET @sql = CONCAT('UPDATE lutador SET empates= "',somaPerdedor+1,'" WHERE idPessoa="',idPerdedor,'"');
			PREPARE STMT FROM @sql;
			EXECUTE STMT;
			
			
		END IF;
		
    END IF;
    
     
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_getDadosCategoria` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_getDadosCategoria`(
	idCategoria int)
BEGIN
	DECLARE clausula VARCHAR(255);
    

	/* DEFININDO OPERAÇÃO */
	/* CATEGORIA ESPECÍFICA */
	IF(idCategoria != 0) THEN
		SET clausula = concat('WHERE id = ',idCategoria);
		
	/* TODOS AS CATEGORIAS */
	ELSEIF(idCategoria = 0) THEN
		SET clausula = concat('ORDER BY pesoMinimo,nome');
		
	/* PARÂMETRO INCORRETO */
	ELSE
		SELECT 'O parâmetro, deve ser inteiro' AS msg;
	END IF;
    
    
		SET @sql = 'SELECT * FROM categoria';
      
      
    SET @sql = CONCAT(@sql, ' ', clausula );


    PREPARE STMT FROM @sql;
    EXECUTE STMT;  
        
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_getDadosEvento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_getDadosEvento`(
	idEvento int)
BEGIN
	DECLARE clausula VARCHAR(255);
    

	/* DEFININDO OPERAÇÃO */
	/* EVENTO ESPECÍFICO */
	IF(idEvento != 0) THEN
		SET clausula = concat('WHERE e.id = ',idEvento);
		
	/* TODOS OS EVENTOS */
	ELSEIF(idEvento = 0) THEN
		SET clausula = concat('ORDER BY data,nome,local');
		
	/* PARÂMETRO INCORRETO */
	ELSE
		SELECT 'O parâmetro, deve ser inteiro' AS msg;
	END IF;
    
    
		SET @sql = ' 
			SELECT
				e.id,s.status AS aprovadoStatus,e.status,
				s.nomeStatus,s.descricao AS descStatus,
				e.nome,e.local AS idLocal,e.alpha3Code AS alpha3,
				e.data
			FROM
				evento e
				JOIN status s ON e.status = s.id
		';
      
      
    SET @sql = CONCAT(@sql, ' ', clausula );


    PREPARE STMT FROM @sql;
    EXECUTE STMT;  
        
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_getDadosEvento_` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_getDadosEvento_`(
	idEvento int)
BEGIN
	DECLARE clausula VARCHAR(255);
    

	/* DEFININDO OPERAÇÃO */
	/* EVENTO ESPECÍFICO */
	IF(idEvento != 0) THEN
		SET clausula = concat('WHERE e.id = ',idEvento);
		
	/* TODOS OS EVENTOS */
	ELSEIF(idEvento = 0) THEN
		SET clausula = concat('ORDER BY data,nome,local');
		
	/* PARÂMETRO INCORRETO */
	ELSE
		SELECT 'O parâmetro, deve ser inteiro' AS msg;
	END IF;
    
    
		SET @sql = ' 
			SELECT
				e.id,s.status AS aprovadoStatus,e.status,
				s.nomeStatus,s.descricao AS descStatus,
				e.nome,e.local AS idLocal,
				p.nome AS local, p.abreviatura, e.data
			FROM
				evento e
				JOIN status s ON e.status = s.id
				JOIN paises p ON e.local = p.id
		';
      
      
    SET @sql = CONCAT(@sql, ' ', clausula );


    PREPARE STMT FROM @sql;
    EXECUTE STMT;  
        
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_getDadosLuta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_getDadosLuta`(
	idLuta int,
    statusLuta int,
    home int)
BEGIN
	DECLARE clausula VARCHAR(255);
    
	IF (idLuta IS NOT NULL) THEN
    
		/* DEFININDO OPERAÇÃO */
		/* SE É CONSULTA PARA A HOME OU NÃO: */
		IF (home = 0) THEN
		
			IF(idLuta != 0 or statusLuta != 0) THEN
			
				/* LUTA ESPECÍFICA */
				IF(idLuta != 0) THEN
					SET clausula = concat('WHERE l.id = ',idLuta);
					
				/* TODAS AS LUTAS APROVADAS */
				ELSEIF(statusLuta = 1) THEN
					SET clausula = concat('WHERE s.status = "',statusLuta,'"');
					
				/* PARÂMETRO INCORRETO */
				ELSE
					SELECT 'O segundo parâmetro, deve ser "0" ou "1"' AS msg;
				END IF;
				
			/* TODAS AS LUTAS */
			ELSE
				SET clausula = concat('ORDER BY e.data');
			END IF;
			
		ELSE
			SET clausula = concat('WHERE  s.status = "',statusLuta,'" ORDER BY e.data  LIMIT 3');
		END IF;
    


		SET @sql = ' 
			SELECT
				/* DADOS DA LUTA */
				l.id,l.rounds,s.id AS status,
				s.status AS aprovadoStatus,s.nomeStatus,s.descricao,
				e.id AS idEvento,e.nome AS nomeEvento,e.data,
				e.alpha3Code AS localEvento, -- p.nome AS localEvento,p.abreviatura AS pais,
				c.id AS idCategoria,c.nome AS categoria,c.pesoMinimo,c.pesoMaximo,
				
				/* DADOS DO DESAFIADO */
				d1.idPessoa AS idDesafiado,
				p1.nome AS nomeDesafiado,p1.sobrenome AS sobrenomeDesafiado,p1.apelido AS apelidoDesafiado,p1.nascimento AS nascDesafiado,
				p1.altura AS alturaDesafiado,p1.peso AS pesoDesafiado,
				l1.apresentacao AS apresentacaoDesafiado, l1.vitorias AS vitDesafiado, l1.derrotas AS derDesafiado, l1.empates AS empDesafiado,
				p1.alpha3Code AS paisDesafiado, -- pa1.nome AS paisDesafiado, pa1.abreviatura AS abrDesafiado,
				
				/* DADOS DO DESAFIANTE */
				d2.idPessoa AS idDesafiante, 
				p2.nome AS nomeDesafiante,p2.sobrenome AS sobrenomeDesafiante,p2.apelido AS apelidoDesafiante,p2.nascimento AS nascDesafiante,
				p2.altura AS alturaDesafiante,p2.peso AS pesoDesafiante,
				l2.apresentacao AS apresentacaoDesafiante, l2.vitorias AS vitDesafiante, l2.derrotas AS derDesafiante,l2.empates AS empDesafiante,
				p2.alpha3Code AS paisDesafiante, -- pa2.nome AS paisDesafiante, pa2.abreviatura AS abrDesafiante,
				
				/* DADOS DO VENCEDOR */
				v.idPessoa AS resultado 
			FROM luta l 
				JOIN status s ON l.status = s.id 
				JOIN evento e ON l.evento = e.id 
				JOIN categoria c ON l.categoria = c.id 
				-- JOIN paises p ON e.local = p.id
                
				JOIN luta_desafiado d1 ON l.id = d1.idLuta
				JOIN pessoa p1 ON d1.idPessoa = p1.id 
				JOIN lutador l1 ON d1.idPessoa = l1.idPessoa 
				-- JOIN paises pa1 ON p1.nacionalidade = pa1.id 
                
				JOIN luta_desafiante d2 ON l.id = d2.idLuta
				JOIN pessoa p2 ON d2.idPessoa = p2.id 
				JOIN lutador l2 ON d2.idPessoa = l2.idPessoa 
				-- JOIN paises pa2 ON p2.nacionalidade = pa2.id 
				LEFT JOIN luta_vencedor v ON v.idLuta = l.id
		';
      
      
		SET @sql = CONCAT(@sql, ' ', clausula );


		PREPARE STMT FROM @sql;
		EXECUTE STMT; 
        
    END IF;
/* SELECT @sql; */
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_getDadosLutador` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_getDadosLutador`(
	idLutador int)
BEGIN
	DECLARE clausula VARCHAR(255);
    

	/* DEFININDO OPERAÇÃO */
	/* LUTADOR ESPECÍFICO */
	IF(idLutador != 0) THEN
		SET clausula = concat('WHERE p.id = ',idLutador);
		
	/* TODOS OS LUTADORES */
	ELSEIF(idLutador = 0) THEN
		SET clausula = concat('ORDER BY c.pesoMinimo, nome, sobrenome, vitorias, apelido, local');
		
	/* PARÂMETRO INCORRETO */
	ELSE
		SELECT 'O parâmetro, deve ser inteiro' AS msg;
	END IF;
    
    
		SET @sql = ' 
			SELECT
				p.id,p.nome,p.sobrenome,p.apelido,p.local,p.alpha3Code,l.apresentacao,p.nascimento,p.altura,p.peso,
				l.vitorias,l.derrotas,l.empates,
				-- pa.id AS idNacionalidade,pa.nome AS nacionalidade,pa.abreviatura,
				c.nome categoria,c.pesoMinimo AS pesoMinCategoria,c.pesoMaximo AS pesoMaxCategoria
			FROM
				pessoa p 
				JOIN lutador l ON p.id = l.idPessoa 
				-- JOIN paises pa ON p.nacionalidade = pa.id 
				JOIN categoria c ON l.categoria = c.id
		';
      
      
    SET @sql = CONCAT(@sql, ' ', clausula );


    PREPARE STMT FROM @sql;
    EXECUTE STMT;  
        
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_getDadosLutaHome` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_getDadosLutaHome`()
BEGIN
		SELECT
			l.id,e.data,
			e.nome AS nomeEvento,
			d1.idPessoa AS idDesafiado, p1.nome AS nomeDesafiado,p1.sobrenome AS sobrenomeDesafiado,p1.apelido AS apelidoDesafiado,
			d2.idPessoa AS idDesafiante,p2.nome AS nomeDesafiante,p2.sobrenome AS sobrenomeDesafiante,p2.apelido AS apelidoDesafiante
		FROM
			luta l
			JOIN status s ON l.status = s.id 
			JOIN evento e ON l.evento = e.id 
			JOIN categoria c ON l.categoria = c.id 
			JOIN paises p ON e.local = p.id
			
			JOIN luta_desafiado d1 ON l.id = d1.idLuta
			JOIN pessoa p1 ON d1.idPessoa = p1.id 
			JOIN lutador l1 ON d1.idPessoa = l1.idPessoa 
			JOIN paises pa1 ON p1.nacionalidade = pa1.id 
			
			JOIN luta_desafiante d2 ON l.id = d2.idLuta
			JOIN pessoa p2 ON d2.idPessoa = p2.id 
			JOIN lutador l2 ON d2.idPessoa = l2.idPessoa 
			JOIN paises pa2 ON p2.nacionalidade = pa2.id
		WHERE 
			s.status = '1'
		ORDER BY e.data 
		LIMIT 3;
	END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_getDadosPaises` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_getDadosPaises`(
	idPais int)
BEGIN
	DECLARE clausula VARCHAR(255);
    

	/* DEFININDO OPERAÇÃO */
	/* PAÍS ESPECÍFICO */
	IF(idPais != 0) THEN
		SET clausula = concat('WHERE id = ',idPais);
		
	/* TODOS OS PAÍSES */
	ELSEIF(idPais = 0) THEN
		SET clausula = concat('ORDER BY nome');
		
	/* PARÂMETRO INCORRETO */
	ELSE
		SELECT 'O parâmetro, deve ser inteiro' AS msg;
	END IF;
    
    
		SET @sql = 'SELECT * FROM paises';
      
      
    SET @sql = CONCAT(@sql, ' ', clausula );


    PREPARE STMT FROM @sql;
    EXECUTE STMT;  
        
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_getDadosStatus` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_getDadosStatus`(
	idStatus int)
BEGIN
	DECLARE clausula VARCHAR(255);
    

	/* DEFININDO OPERAÇÃO */
	/* STATUS ESPECÍFICO */
	IF(idStatus != 0) THEN
		SET clausula = concat('WHERE id = ',idStatus);
		
	/* TODOS OS STATUS */
	ELSEIF(idStatus = 0) THEN
		SET clausula = concat('ORDER BY nomeStatus, descricao');
		
	/* PARÂMETRO INCORRETO */
	ELSE
		SELECT 'O parâmetro, deve ser inteiro' AS msg;
	END IF;
    
    
		SET @sql = 'SELECT * FROM status';
      
      
    SET @sql = CONCAT(@sql, ' ', clausula );


    PREPARE STMT FROM @sql;
    EXECUTE STMT;  
        
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_getLutadoresCategoria` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_getLutadoresCategoria`(
	idCategoria int)
BEGIN
    
    SELECT p.id,p.nome,p.sobrenome,p.apelido
	FROM pessoa p
	JOIN lutador l ON p.id = l.idpessoa 
	WHERE l.categoria = idCategoria;
        
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_getLutasLutador` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_getLutasLutador`(
IN idLutador int(11),
IN idStatus int(11),
IN condicao varchar(50))
BEGIN

	/*DECLARE Msg VARCHAR (1000) DEFAULT "";*/
	DECLARE clausula VARCHAR(255) DEFAULT "";
	DECLARE findId int;
    
	SELECT COUNT(*) INTO findId FROM pessoa WHERE pessoa.id = idLutador;
  

	IF(idLutador IS NULL OR idLutador = '') THEN
		SELECT 'Registro não informado para alteração' AS Msg;
        
	ELSEIF(findId = 0) THEN
		SELECT 'Registro não encontrado para alteração' AS Msg;
        
	ELSE
	    
        
        /* TODAS AS LUTAS APROVADAS */
		IF(idStatus = 1) THEN
			SET clausula = concat('WHERE (d1.idPessoa = "',idLutador,'" OR d2.idPessoa = "',idLutador,'") AND s.status = "',idStatus,'"');
            
		ELSE
			IF(condicao IS NOT NULL) THEN
				SET clausula = concat('WHERE (d1.idPessoa = "',idLutador,'" OR d2.idPessoa = "',idLutador,'") AND s.nomeStatus LIKE "%',condicao,'"');
            ELSE
				SET clausula = concat('WHERE (d1.idPessoa = "',idLutador,'" OR d2.idPessoa = "',idLutador,'")');
            END IF;
            
			
		
        END IF;
                
        SET @sql = ' 
		SELECT l.id,l.status as idStatus,s.status,s.nomeStatus,s.descricao,l.categoria,d1.idPessoa AS desafiado,d2.idPessoa AS desafiante
		FROM luta l
		JOIN status s ON l.status = s.id
		JOIN luta_desafiado d1 ON l.id = d1.idLuta
		JOIN luta_desafiante d2 ON l.id = d2.idLuta 
		';
      
      
		SET @sql = CONCAT(@sql, ' ', clausula );


		PREPARE STMT FROM @sql;
		EXECUTE STMT; 
        
    END IF;
    

        
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_insertCategoria` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_insertCategoria`(
IN nome varchar(45),
IN pesoMinimo decimal(5,2),
IN pesoMaximo decimal(5,2))
BEGIN

  DECLARE excessao SMALLINT DEFAULT 0;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET excessao = 1;

  IF (nome = "" or pesoMinimo = "" or pesoMaximo = "") THEN
    SELECT 'Informe o nome, peso mínimo e peso máximo' AS Msg;

  ELSEIF (character_length(nome) > 45) THEN
    SELECT 'O nome da categoria deve conter no máximo 45 caracteres' AS Msg;
    
  ELSE
    START TRANSACTION;

	INSERT INTO categoria VALUES (NULL, nome, pesoMinimo, pesoMaximo);
    
    IF excessao = 1
    THEN
      SELECT 'Erro ao inserir registro' AS Msg;
      ROLLBACK;
    
	ELSE
	  SELECT 'Cadastro efetuado com sucesso' AS Msg;
	  COMMIT;
    END IF;
  END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_insertEvento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_insertEvento`(
IN nome varchar(50),
IN idlocal int(11),
IN alpha3Code varchar(5),
IN dataEvento datetime)
BEGIN
  DECLARE statusAprovada int;
  DECLARE pais int;
  DECLARE excessao SMALLINT DEFAULT 0;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET excessao = 1;


  SELECT id INTO statusAprovada 
  FROM status 
  WHERE nomeStatus='aprovada' LIMIT 1;
  
  /*SELECT COUNT(*) INTO pais
  FROM paises
  WHERE id=idlocal;*/


  IF (nome = "" or idlocal = "" or dataEvento = "") THEN
    SELECT 'Informe o nome, local e a data do evento' AS Msg;

  ELSEIF (character_length(nome) > 50) THEN
    SELECT 'O nome do evento deve conter no máximo 50 caracteres' AS Msg;
  
  /*ELSEIF (pais = 0) THEN
    SELECT 'O local informado, não foi encontrado em nossos registros' AS Msg;
    */
  ELSE
    START TRANSACTION;

	INSERT INTO evento VALUES (NULL, statusAprovada, nome, idlocal, alpha3Code, dataEvento);
    
    IF excessao = 1
    THEN
      SELECT 'Erro ao inserir registro' AS Msg;
      ROLLBACK;
    
	ELSE
	  SELECT 'Cadastro efetuado com sucesso' AS Msg;
	  COMMIT;
    END IF;
  END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_insertLuta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_insertLuta`(
IN idEvento int(11),
IN idCategoria int(11),
IN rounds tinyint(1),
IN idDesafiado int(11),
IN idDesafiante int(11))
BEGIN
  DECLARE Msg VARCHAR (1000) DEFAULT "Cadastro efetuado com sucesso";
  DECLARE statusInsert SMALLINT DEFAULT 0;
  DECLARE statusAprovada int;
  DECLARE findEvento int;
  DECLARE findCategoria int;
  
  DECLARE findDesafiado int;
  DECLARE findPesoDesafiado int;
  DECLARE findCategoriaDesafiado int;
  
  DECLARE findDesafiante int;
  DECLARE findPesoDesafiante int;
  DECLARE findCategoriaDesafiante int;
  
  DECLARE excessao SMALLINT DEFAULT 0;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET excessao = 1;
  
	SELECT COUNT(*) INTO findEvento FROM evento WHERE id = idEvento;
	SELECT COUNT(*) INTO findCategoria FROM categoria WHERE id = idCategoria;
	SELECT COUNT(*) INTO findDesafiado FROM pessoa WHERE id = idDesafiado;
	SELECT COUNT(*) INTO findDesafiante FROM pessoa WHERE id = idDesafiante;
    
	SELECT id INTO statusAprovada FROM status WHERE nomeStatus='aprovada' LIMIT 1;
	
	SELECT peso INTO findPesoDesafiado FROM pessoa WHERE pessoa.id = idDesafiado;
	SELECT peso INTO findPesoDesafiante FROM pessoa WHERE pessoa.id = idDesafiante;
	
	select fc_getCategoriaLutador(findPesoDesafiado) INTO findCategoriaDesafiado;
	select fc_getCategoriaLutador(findPesoDesafiante) INTO findCategoriaDesafiante;
    
    

  IF (rounds != 3 AND rounds != 5) THEN
	SET Msg = 'A luta deve ser de 3 ou de 5 rounds';
    
  ELSEIF (findEvento = 0) THEN
    SET Msg = 'O evento informado, não foi encontrado em nossos registros';
    
  ELSEIF (findCategoria = 0) THEN
    SET Msg = 'A categoria informada, não foi encontrada em nossos registros';
    
  ELSEIF (findDesafiado = 0) THEN
    SET Msg = 'O lutador informado como desafiado, não foi encontrado em nossos registros';
        
  ELSEIF (findCategoriaDesafiado != idCategoria) THEN
	SET Msg = 'O lutador informado como desafiado, não está dentro do peso desta categoria';
    
  ELSEIF (findDesafiante = 0) THEN
    SET Msg = 'O lutador informado como desafiante, não foi encontrado em nossos registros';
        
  ELSEIF (findCategoriaDesafiante != idCategoria) THEN
	SET Msg = 'O lutador informado como desafiante, não está dentro do peso desta categoria';
    
  ELSE
	START TRANSACTION;
	
    INSERT INTO luta VALUES (NULL, statusAprovada, idEvento, idCategoria, rounds);
	
	IF excessao = 1 THEN
	  SET Msg = 'Erro ao inserir registro';
	  ROLLBACK;
	  
	ELSE
		SELECT DISTINCT LAST_INSERT_ID() INTO @idLuta FROM luta;
		  IF excessao = 1 THEN
			SET Msg = 'Erro ao selecionar o ultimo ID inserido';
			ROLLBACK;
			
		  ELSE
            INSERT INTO luta_desafiado VALUES (idDesafiado, @idLuta);
			  IF excessao = 1 THEN
				SET Msg = 'Erro ao inserir registro';
				ROLLBACK;
                
			  ELSE
				INSERT INTO luta_desafiante VALUES (idDesafiante, @idLuta);
				  IF excessao = 1 THEN
					SET Msg = 'Erro ao inserir registro';
					ROLLBACK;
				  ELSE
					SET statusInsert = 1;
					COMMIT;
				  END IF;
			  END IF;
		  END IF;
	END IF;

    
  END IF;
  

SELECT Msg, @idLuta AS idLuta, statusInsert AS statusOperacao;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_insertLutador` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_insertLutador`(
IN nome varchar(50),
IN sobrenome varchar(50),
IN apelido varchar(50),
IN apresentacao varchar(50),
IN idlocal int(11),
IN alpha3Code varchar(5),
IN nascimento date,
IN altura decimal(3,2),
IN peso decimal(5,2))
BEGIN
  DECLARE Msg VARCHAR (1000) DEFAULT "Cadastro efetuado com sucesso";
  DECLARE pais int;
  DECLARE idCategoria int;
  DECLARE menorPeso decimal(5,2);
  DECLARE maiorPeso decimal(5,2);
  DECLARE excessao SMALLINT DEFAULT 0;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET excessao = 1;

  
  IF (apresentacao = "") THEN
	SET apresentacao = CONCAT(nome,' ',sobrenome);
  END IF;
  
  SELECT COUNT(*) INTO pais
  FROM paises
  WHERE id=idlocal;
  
  SELECT MIN(pesoMinimo) INTO menorPeso
  FROM categoria;
  
  SELECT MAX(pesoMaximo) INTO maiorPeso
  FROM categoria;
  
  
  
  START TRANSACTION;
  
  IF (peso < menorPeso or peso > maiorPeso) THEN
    SET Msg = 'O lutador informado, não se encaixa em nenhuma categoria disponível';
          
  ELSE
	  SELECT id INTO idCategoria
	  FROM categoria
	  WHERE pesoMinimo <=peso AND pesoMaximo >=peso LIMIT 1;
      
      
      IF (nome = "" or sobrenome = "" or idLocal = "" or nascimento = "" or altura = "" or peso = "") THEN
		SET Msg = 'Informe o nome, sobrenome, nacionalidade, data de nascimento, altura e peso do lutador';

	  ELSEIF (character_length(nome) > 50) THEN
		SET Msg = 'O nome do lutador deve conter no máximo 50 caracteres';

	  ELSEIF (character_length(sobrenome) > 50) THEN
		SET Msg = 'O sobrenome do lutador deve conter no máximo 50 caracteres';
	  
	  /*ELSEIF (pais = 0) THEN
		SET Msg = 'O local informado, não foi encontrado em nossos registros';*/
		
	  ELSE
        INSERT INTO pessoa VALUES (NULL, nome, sobrenome, apelido, idlocal, alpha3Code, nascimento, altura, peso);
		IF excessao = 1 THEN
		  SET Msg = 'Erro ao inserir registro';
		  ROLLBACK;
          
		ELSE
			SELECT DISTINCT LAST_INSERT_ID() INTO @idPessoa FROM pessoa;
			  IF excessao = 1 THEN
				SET Msg = 'Erro ao selecionar o ultimo ID inserido';
				ROLLBACK;
                
			  ELSE
				INSERT INTO lutador VALUES (NULL, @idPessoa, apresentacao, idCategoria, 0, 0, 0);
				  IF excessao = 1 THEN
					SET Msg = 'Erro ao inserir registro';
					ROLLBACK;
				  ELSE
				    COMMIT;
                  END IF;
			  END IF;
		END IF;
	  END IF;
      
  END IF;

SELECT Msg;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_insertPaises` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_insertPaises`(
IN nome varchar(60),
IN abreviatura char(2))
BEGIN

  DECLARE excessao SMALLINT DEFAULT 0;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET excessao = 1;

  IF (nome = "" or abreviatura = "") THEN
    SELECT 'Informe o nome e a abreviatura do país' AS Msg;

  ELSEIF (character_length(nome) > 60) THEN
    SELECT 'O nome do país deve conter no máximo 60 caracteres' AS Msg;
    
  ELSE
    START TRANSACTION;

	INSERT INTO paises VALUES (NULL, nome, abreviatura);
    
    IF excessao = 1
    THEN
      SELECT 'Erro ao inserir registro' AS Msg;
      ROLLBACK;
    
	ELSE
	  SELECT 'Cadastro efetuado com sucesso' AS Msg;
	  COMMIT;
    END IF;
  END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_insertStatus` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_insertStatus`(
IN nome varchar(20),
IN descricao tinytext)
BEGIN

  DECLARE excessao SMALLINT DEFAULT 0;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET excessao = 1;

  IF (nome = "") THEN
    SELECT 'Informe um nome para o status' AS Msg;

  ELSEIF (character_length(nome) > 20) THEN
    SELECT 'O nome do status deve conter no máximo 20 caracteres' AS Msg;
    
  ELSE
    START TRANSACTION;

	INSERT INTO status VALUES (NULL, '0', nome, descricao);
    
    IF excessao = 1
    THEN
      SELECT 'Erro ao inserir registro' AS Msg;
      ROLLBACK;
    
	ELSE
	  SELECT 'Cadastro efetuado com sucesso' AS Msg;
	  COMMIT;
    END IF;
  END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_updateCategoria` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_updateCategoria`(
IN id int(11),
IN nome varchar(45),
IN pesoMin decimal(5,2),
IN pesoMax decimal(5,2))
BEGIN

  DECLARE Msg VARCHAR (1000) DEFAULT "Dados atualizados com sucesso";
  DECLARE statusInsert SMALLINT DEFAULT 0;
  
  DECLARE clausula VARCHAR(255) DEFAULT '';
  DECLARE findId int;
  
  DECLARE excessao SMALLINT DEFAULT 0;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET excessao = 1;
  
	SET @sql = '';

	SELECT COUNT(*) INTO findId FROM categoria WHERE categoria.id = id;
    
    
	IF(id IS NULL OR id = '') THEN
		SET Msg = 'Registro não informado para alteração';
	  
	ELSEIF(findId = 0) THEN
		SET Msg = 'Registro não encontrado para alteração';
        
	ELSE
    
	  
	  /*
      NOME
      */
	  IF (nome IS NOT NULL AND nome != '') THEN		
		SET clausula = concat(clausula,'nome = "',nome,'"');
	  END IF;
	  
	  /*
      PESO MINIMO
      */
	  IF (pesoMin IS NOT NULL AND pesoMin != '') THEN
		IF (clausula != '') THEN
			SET clausula = concat(clausula,', ');
		END IF;
		
		SET clausula = concat(clausula,'pesoMinimo = "',pesoMin,'"');
	  END IF;
	  
	  /*
      PESO MAXIMO
      */
	  IF (pesoMax IS NOT NULL AND pesoMax != '') THEN
		IF (clausula != '') THEN
			SET clausula = concat(clausula,', ');
		END IF;
		
		SET clausula = concat(clausula,'pesoMaximo = "',pesoMax,'"');
	  END IF;
	  
	  
	  IF (clausula != '') THEN		
		START TRANSACTION;

		SET @sql = CONCAT('UPDATE categoria SET ',clausula,' WHERE id = ',id);
		
		PREPARE STMT FROM @sql;
		EXECUTE STMT; 
		
		IF excessao = 1
		THEN
		  SET Msg = 'Erro ao inserir registro';
		  ROLLBACK;
		
		ELSE
		  SET statusInsert = 1;
		  COMMIT;
		END IF;
	  ELSE
		SET Msg = 'Parâmetros não informados';
	  END IF;
		
	END IF;
	
    
SELECT Msg, id, statusInsert AS statusOperacao;
  

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_updateEvento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_updateEvento`(
IN id int(11),
IN idStatus int(11),
IN nome varchar(50),
IN idLocal int(11),
IN alpha3Code varchar(5),
IN dataEvento datetime)
BEGIN

  DECLARE Msg VARCHAR (1000) DEFAULT "Dados atualizados com sucesso";
  DECLARE statusInsert SMALLINT DEFAULT 0;
  
  DECLARE clausula VARCHAR(255) DEFAULT '';
  
  DECLARE findId int;
  DECLARE findStatus int;
  DECLARE findLocal int;
  
  
  DECLARE excessao SMALLINT DEFAULT 0;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET excessao = 1;
  
	SET @sql = '';

	SELECT COUNT(*) INTO findId FROM evento WHERE evento.id = id;
    
    
    
	IF(id IS NULL OR id = '') THEN
		SET Msg = 'Registro não informado para alteração';
	  
	ELSEIF(findId = 0) THEN
		SET Msg = 'Registro não encontrado para alteração';
        
	ELSE
    
	SELECT COUNT(*) INTO findStatus FROM status WHERE status.id = idStatus;
	/*SELECT COUNT(*) INTO findLocal FROM paises WHERE paises.id = idLocal;*/
    
    
		/*IF (findLocal = 0) THEN
			SET Msg = 'Nacionalidade informada, não foi encontrada em nossos registros';
         
		ELSE*/
        IF (findStatus = 0) THEN   
			SET Msg = 'O status informado, não foi encontrado em nossos registros';
            
		ELSE	
			  /*
			  NOME
			  */
			  IF (nome IS NOT NULL AND nome != '') THEN		
				SET clausula = concat(clausula,'nome = "',nome,'"');
			  END IF;
			  
			
			  /*
			  STATUS
			  */
			  IF (idStatus IS NOT NULL AND idStatus != '') THEN
				IF (clausula != '') THEN
					SET clausula = concat(clausula,', ');
				END IF;
				
				SET clausula = concat(clausula,'status = "',idStatus,'"');
			  
			  END IF;
			  
			
			  /*
			  LOCAL
			  */
			  IF (idLocal IS NOT NULL AND idLocal != '') THEN
				IF (clausula != '') THEN
					SET clausula = concat(clausula,', ');
				END IF;
				
				SET clausula = concat(clausula,'local = "',idLocal,'"');
			  
			  END IF;
			  
			
			  /*
			  ALPHA CODE
			  */
			  IF (alpha3Code IS NOT NULL AND alpha3Code != '') THEN
				IF (clausula != '') THEN
					SET clausula = concat(clausula,', ');
				END IF;
				
				SET clausula = concat(clausula,'alpha3Code = "',alpha3Code,'"');
			  
			  END IF;
			  
			  /*
			  DATA
			  */
			  IF (dataEvento IS NOT NULL AND dataEvento != '') THEN
				IF (clausula != '') THEN
					SET clausula = concat(clausula,', ');
				END IF;
				
				SET clausula = concat(clausula,'data = "',dataEvento,'"');
			  END IF;
			  
			  
					
				IF (clausula != '') THEN
					START TRANSACTION;

					SET @sql = CONCAT('UPDATE evento SET ',clausula,' WHERE id = ',id);
					
					PREPARE STMT FROM @sql;
					EXECUTE STMT; 
					
					IF excessao = 1
					THEN
					  SET Msg = 'Erro ao inserir registro';
					  ROLLBACK;
					ELSE
					    SET statusInsert = 1;
						COMMIT;
					END IF;
				ELSE
					SET Msg = 'Parâmetros não informados';
				END IF;	
			
		END IF;
        
    END IF;
    
SELECT Msg, id, statusInsert AS statusOperacao;
        
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_updateLuta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_updateLuta`(
IN id int(11),
IN idStatus int(11),
IN idEvento int(11),
IN idCategoria int(11),
IN rounds tinyint(1),
IN desafiado int(11),
IN desafiante int(11))
BEGIN

  DECLARE Msg VARCHAR (1000) DEFAULT "Dados atualizados com sucesso";
  DECLARE statusInsert SMALLINT DEFAULT 0;
  
  DECLARE clausula VARCHAR(255) DEFAULT '';
  DECLARE clausulaDesafiado VARCHAR(255) DEFAULT '';
  DECLARE clausulaDesafiante VARCHAR(255) DEFAULT '';
  
  DECLARE findId int;
  DECLARE findEvento int;
  DECLARE findCategoria int;
  DECLARE findStatus int;
  DECLARE findStatusEncerrado int;
  DECLARE findStatusAtual int;
  
  DECLARE findDesafiado int;
  DECLARE findPesoDesafiado int;
  DECLARE findCategoriaDesafiado int;
  
  DECLARE findDesafiante int;
  DECLARE findPesoDesafiante int;
  DECLARE findCategoriaDesafiante int;
  
  
  DECLARE excessao SMALLINT DEFAULT 0;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET excessao = 1;
  
	SET @sql = '';

	SELECT COUNT(*) INTO findId FROM luta WHERE luta.id = id;
    
    
	IF(id IS NULL OR id = '') THEN
		SET Msg = 'Registro não informado para alteração';
	  
	ELSEIF(findId = 0) THEN
		SET Msg = 'Registro não encontrado para alteração';
        
	ELSE
    
	
	SELECT status.id INTO findStatusEncerrado FROM status WHERE status.nomeStatus = "encerrada";
    SELECT status INTO findStatusAtual FROM luta WHERE luta.id = id;
    
	SELECT COUNT(*) INTO findEvento FROM evento WHERE evento.id = idEvento;	
	SELECT COUNT(*) INTO findCategoria FROM categoria WHERE categoria.id = idCategoria;
	SELECT COUNT(*) INTO findStatus FROM status WHERE status.id = idStatus;
    
	SELECT COUNT(*) INTO findDesafiado FROM pessoa WHERE pessoa.id = desafiado;
	SELECT COUNT(*) INTO findDesafiante FROM pessoa WHERE pessoa.id = desafiante;
    
    SELECT peso INTO findPesoDesafiado FROM pessoa WHERE pessoa.id = desafiado;
    SELECT peso INTO findPesoDesafiante FROM pessoa WHERE pessoa.id = desafiante;
    
    select fc_getCategoriaLutador(findPesoDesafiado) INTO findCategoriaDesafiado;
    select fc_getCategoriaLutador(findPesoDesafiante) INTO findCategoriaDesafiante;
    
	  IF (findStatusEncerrado = findStatusAtual) THEN
		SET Msg = 'Não é possível atualizar uma luta que já ocorreu';
        
      ELSEIF (rounds != 3 AND rounds != 5) THEN
		SET Msg = 'A luta deve ser de 3 ou 5 rounds';
        
	  ELSEIF (findEvento = 0) THEN
		SET Msg = 'O evento informado, não foi encontrado em nossos registros';
        
	  ELSEIF (findCategoria = 0) THEN
		SET Msg = 'A categoria informada, não foi encontrada em nossos registros';
        
	  ELSEIF (findStatus = 0) THEN
		SET Msg = 'O status informado, não foi encontrado em nossos registros';
        
	  ELSEIF (findDesafiado = 0) THEN
		SET Msg = 'O lutador informado como desafiado, não foi encontrado em nossos registros';
        
	  ELSEIF (findCategoriaDesafiado != idCategoria) THEN
		SET Msg = 'O lutador informado como desafiado, não está dentro do peso desta categoria';
	  
      ELSEIF (findDesafiante = 0) THEN
		SET Msg = 'O lutador informado como desafiante, não foi encontrado em nossos registros';
        
	  ELSEIF (findCategoriaDesafiante != idCategoria) THEN
		SET Msg = 'O lutador informado como desafiante, não está dentro do peso desta categoria';
        
        
	  ELSE
      		  
		/*
		EVENTO
		*/
		IF (idEvento IS NOT NULL AND idEvento != '') THEN
			SET clausula = concat(clausula,'evento = "',idEvento,'"');
		END IF;
		
		/*
		CATEGORIA
		*/
		IF (idCategoria IS NOT NULL AND idCategoria != '') THEN
			IF (clausula != '') THEN
				SET clausula = concat(clausula,', ');
			END IF;
		
			SET clausula = concat(clausula,'categoria = "',idCategoria,'"');
		END IF;
		
		/*
		ROUNDS
		*/
		IF (rounds IS NOT NULL AND rounds != '') THEN
			IF (clausula != '') THEN
				SET clausula = concat(clausula,', ');
			END IF;
		
			SET clausula = concat(clausula,'rounds = "',rounds,'"');
		END IF;
		
		/*
		STATUS
		*/
		IF (idStatus IS NOT NULL AND idStatus != '') THEN
			IF (clausula != '') THEN
				SET clausula = concat(clausula,', ');
			END IF;
		
			SET clausula = concat(clausula,'status = "',idStatus,'"');
		END IF;
		
		/*
		DESAFIADO
		*/
		IF (desafiado IS NOT NULL AND desafiado != '') THEN    
			SET clausulaDesafiado = concat(clausulaDesafiado,'idPessoa = "',desafiado,'"');
		END IF;
		
		/*
		DESAFIANTE
		*/
		IF (desafiante IS NOT NULL AND desafiante != '') THEN
			SET clausulaDesafiante = concat(clausulaDesafiante,'idPessoa = "',desafiante,'"');
		END IF;
		  
          
		  /*
		  VERIFICAÇÃO DE ERROS
		  errorEvento
		  errorCategoria
		  errorRounds
		  errorStatus
		  
		  errorDesafiado
		  errorDesafiante
		  */
			IF (clausula != '' OR clausulaDesafiado != '' OR clausulaDesafiante != '' ) THEN
				START TRANSACTION;

				/*
				UPDATE DADOS DA LUTA
				*/
				SET @sql = CONCAT('UPDATE luta SET ',clausula,' WHERE id = ',id);

				PREPARE STMT FROM @sql;
				EXECUTE STMT; 
				
				IF excessao = 1
				THEN
				  SET Msg = 'Erro ao inserir registro luta';
				  ROLLBACK;
				
				ELSE  
					/*
					UPDATE DESAFIADO
					*/
					SET @sql = '';
					SET @sql = CONCAT('UPDATE luta_desafiado SET ',clausulaDesafiado,' WHERE idLuta = ',id);
					
					PREPARE STMT FROM @sql;
					EXECUTE STMT; 
					
					
					IF excessao = 1
					THEN
					  SET Msg = 'Erro ao inserir registro desafiado';
					  ROLLBACK;
					ELSE
						/*
						UPDATE DESAFIANTE
						*/
						SET @sql = '';
						SET @sql = CONCAT('UPDATE luta_desafiante SET ',clausulaDesafiante,' WHERE idLuta = ',id);
						
						PREPARE STMT FROM @sql;
						EXECUTE STMT; 
						
						
						IF excessao = 1
						THEN
						  SET Msg = 'Erro ao inserir registro desafiante';
						  ROLLBACK;
						ELSE
						  SET statusInsert = 1;
						  COMMIT;
							
						END IF;
					END IF;
				END IF;
			ELSE
				SET Msg = 'Parâmetros não informados';
			END IF;		
		
	
    
      END IF;
      
    END IF;
	

SELECT Msg, id, statusInsert AS statusOperacao;

        
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_updateLutador` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_updateLutador`(
IN id int(11),
IN nome varchar(50),
IN sobrenome varchar(50),
IN apelido varchar(50),
IN apresentacao varchar(50),
IN idlocal int(11),
IN alpha3Code varchar(5),
IN nascimento date,
IN altura decimal(3,2),
IN peso decimal(5,2))
BEGIN

  DECLARE Msg VARCHAR (1000) DEFAULT "Dados atualizados com sucesso";
  DECLARE statusInsert SMALLINT DEFAULT 0;
  
  DECLARE errorLocal boolean DEFAULT false;
  DECLARE errorPeso boolean DEFAULT false;
  
  DECLARE idCategoria int;
  DECLARE idCategoriaAntigo int;
  DECLARE mudouCategoria int;
  DECLARE menorPeso decimal(5,2);
  DECLARE maiorPeso decimal(5,2);
  DECLARE clausula VARCHAR(255) DEFAULT '';
  DECLARE clausulaLutador VARCHAR(255) DEFAULT '';
  
  DECLARE findId int;
  DECLARE findIdLocal int;
  
  
  DECLARE excessao SMALLINT DEFAULT 0;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET excessao = 1;
  
	SET @sql = '';

	SELECT COUNT(*) INTO findId FROM pessoa WHERE pessoa.id = id;
    
    
	IF((id IS NULL OR id = '')) THEN
		SET Msg = 'Registro não informado para alteração';
	  
	ELSEIF(findId = 0) THEN
		SET Msg = 'Registro não encontrado para alteração';
        
	ELSE
    
	SELECT COUNT(*) INTO findIdLocal FROM paises WHERE paises.id = idLocal;
	SELECT MIN(pesoMinimo) INTO menorPeso FROM categoria;
	SELECT MAX(pesoMaximo) INTO maiorPeso FROM categoria;
    
    SELECT fc_getCategoriaLutador(peso) INTO idCategoria;
    SELECT categoria INTO idCategoriaAntigo FROM LUTADOR WHERE idPessoa = id;
    
    
    
		IF (idCategoria = 0) THEN
			SET Msg = 'O lutador informado, não se encaixa em nenhuma categoria disponível';
            
		ELSE
			
					
		  /*
		  NOME
		  */
		  IF (nome IS NOT NULL AND nome != '') THEN		
			SET clausula = concat(clausula,'nome = "',nome,'"');
		  END IF;
		  
		
		  /*
		  SOBRENOME
		  */
		  IF (sobrenome IS NOT NULL AND sobrenome != '') THEN
			IF (clausula != '') THEN
				SET clausula = concat(clausula,', ');
			END IF;
			
			SET clausula = concat(clausula,'sobrenome = "',sobrenome,'"');
		  END IF;
		  
		
		  /*
		  APELIDO
		  */
		  IF (apelido IS NOT NULL AND apelido != '') THEN
			IF (clausula != '') THEN
				SET clausula = concat(clausula,', ');
			END IF;
			
			SET clausula = concat(clausula,'apelido = "',apelido,'"');
		  END IF;
		  
		
		  /*
		  NACIONALIDADE
		  */
		  IF (idLocal IS NOT NULL AND idLocal != '') THEN
			IF (clausula != '') THEN
				SET clausula = concat(clausula,', ');
			END IF;
			
			SET clausula = concat(clausula,'local = "',idLocal,'", alpha3Code = "',alpha3Code,'"');
		  END IF;
		  
		
		  /*
		  NASCIMENTO
		  */
		  IF (nascimento IS NOT NULL AND nascimento != '') THEN
			IF (clausula != '') THEN
				SET clausula = concat(clausula,', ');
			END IF;
			
			SET clausula = concat(clausula,'nascimento = "',nascimento,'"');
		  END IF;
		  
		
		  /*
		  ALTURA
		  */
		  IF (altura IS NOT NULL AND altura != '') THEN
			IF (clausula != '') THEN
				SET clausula = concat(clausula,', ');
			END IF;
			
			SET clausula = concat(clausula,'altura = "',altura,'"');
		  END IF;
		  
		  
		  /*
		  VERIFICAÇÃO DE PESO
		  */
		  IF (peso IS NOT NULL AND peso != '') THEN				  
			SET clausulaLutador = concat(clausulaLutador,'categoria= ',idCategoria);
			
			IF (clausula != '') THEN
				SET clausula = concat(clausula,', ');
			END IF;

			SET clausula = concat(clausula,'peso = "',peso,'"');
				
		  END IF;
		  
		  

		  /*
		  DADOS PARA UPDATE NA TABELA 'LUTADOR'
		  */
		  IF (apresentacao IS NOT NULL AND apresentacao != '') THEN
			IF (clausulaLutador != '') THEN
				SET clausulaLutador = concat(clausulaLutador,', ');
			END IF;
			
			SET apresentacao = REPLACE(apresentacao,'\"','\\"');
			SET clausulaLutador = concat(clausulaLutador,'apresentacao = "',apresentacao,'"');
		  END IF;
		  
		  
		  
		  /*
		  VERIFICAÇÃO DE ERRO COM PESO E NACIONALIDADE
		  */
			IF (clausula != '' OR clausulaLutador != '' ) THEN
				START TRANSACTION;

				SET @sql = CONCAT('UPDATE pessoa SET ',clausula,' WHERE id = ',id);
				
				PREPARE STMT FROM @sql;
				EXECUTE STMT; 
				
				IF excessao = 1
				THEN
					SELECT @sql;
				  SET Msg = 'Erro ao inserir registro pessoa';
				  ROLLBACK;
				
				ELSE

	  
					SET @sql = '';
					SET @sql = CONCAT('UPDATE lutador SET ',clausulaLutador,' WHERE idPessoa = ',id);
					
					PREPARE STMT FROM @sql;
					EXECUTE STMT; 
					
					
					IF excessao = 1
					THEN
					  SET Msg = 'Erro ao inserir registro lutador';
					  ROLLBACK;
					ELSE
						IF(idCategoriaAntigo = idCategoria)THEN
							SET mudouCategoria =  0;
						ELSE
							SET mudouCategoria =  1;
                        END IF;
                    
					  SET statusInsert = 1;
					  COMMIT;
					END IF;
				END IF;
			ELSE
				SET Msg = 'Parâmetros não informados';
			END IF;		
		  
		END IF;
    
    END IF;
	
SELECT Msg, id, statusInsert AS statusOperacao,mudouCategoria, idCategoria AS categoriaAtual;

        
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_updatePaises` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_updatePaises`(
IN id int(11),
IN nome varchar(60),
IN abreviatura char(2))
BEGIN

  DECLARE Msg VARCHAR (1000) DEFAULT "Dados atualizados com sucesso";
  DECLARE statusInsert SMALLINT DEFAULT 0;

  DECLARE clausula VARCHAR(255) DEFAULT '';
  DECLARE findId int;
  
  DECLARE excessao SMALLINT DEFAULT 0;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET excessao = 1;
  
	SET @sql = '';

	SELECT COUNT(*) INTO findId FROM paises WHERE paises.id = id;
    
    
	IF(id IS NULL OR id = '') THEN
		SET Msg = 'Registro não informado para alteração';
	  
	ELSEIF(findId = 0) THEN
		SET Msg = 'Registro não encontrado para alteração';
        
	ELSE
	  /*
      NOME
      */
	  IF (nome IS NOT NULL AND nome != '') THEN
		SET clausula = concat(clausula,'nome = "',nome,'"');
	  END IF;
	  
	  /*
      ABREVIATURA
      */
	  IF (abreviatura IS NOT NULL AND abreviatura != '') THEN
		IF (clausula != '') THEN
			SET clausula = concat(clausula,', ');
		END IF;
		
		SET clausula = concat(clausula,'abreviatura = "',abreviatura,'"');
	  END IF;
	  
	  
	  IF (clausula != '') THEN
		START TRANSACTION;
		SET @sql = CONCAT('UPDATE paises SET ',clausula,' WHERE id = ',id);
		
		PREPARE STMT FROM @sql;
		EXECUTE STMT; 
		
		IF excessao = 1
		THEN
		  SET Msg = 'Erro ao inserir registro';
		  ROLLBACK;
		
		ELSE
		  SET statusInsert = 1;
		  COMMIT;
		END IF;
	  ELSE
		SET Msg = 'Parâmetros não informados';
	  END IF;
        
	END IF;
    
SELECT Msg, id, statusInsert AS statusOperacao;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_updateStatus` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_updateStatus`(
IN id int(11),
IN idStatus int(11),
IN nome varchar(20),
IN descricao tinytext)
BEGIN

  DECLARE Msg VARCHAR (1000) DEFAULT "Dados atualizados com sucesso";
  DECLARE statusInsert SMALLINT DEFAULT 0;

  DECLARE clausula VARCHAR(255) DEFAULT '';
  DECLARE findId int;
  
  DECLARE excessao SMALLINT DEFAULT 0;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET excessao = 1;
  
	SET @sql = '';

	SELECT COUNT(*) INTO findId FROM status WHERE status.id = id;
    
    
    
	IF(id IS NULL OR id = '') THEN
		SET Msg = 'Registro não informado para alteração';
	  
	ELSEIF(findId = 0) THEN
		SET Msg = 'Registro não encontrado para alteração';
        
	ELSE
		
	  /*
      STATUS
      */
	  IF (idStatus = 0 OR idStatus = 1) THEN
		SET clausula = concat(clausula,'status = "',idStatus,'"');
	  END IF;
	  
	  /*
      NOME
      */
	  IF (nome IS NOT NULL AND nome != '') THEN
		IF (clausula != '') THEN
			SET clausula = concat(clausula,', ');
		END IF;
		
		SET clausula = concat(clausula,'nomeStatus = "',nome,'"');
	  END IF;
	  
	  
	  /*
      DESCRICAO
      */
		IF (clausula != '') THEN
			SET clausula = concat(clausula,', ');
		END IF;

		SET clausula = concat(clausula,'descricao = "',descricao,'"');
	  
	  
	  
	  IF (clausula != '') THEN
		START TRANSACTION;

		SET @sql = CONCAT('UPDATE status SET ',clausula,' WHERE id = ',id);
		
		PREPARE STMT FROM @sql;
		EXECUTE STMT; 
		
		IF excessao = 1
		THEN
		  SET Msg = 'Erro ao inserir registro';
		  ROLLBACK;
		
		ELSE
		  SET statusInsert = 1;
		  COMMIT;
		END IF;
	  ELSE
		SET Msg = 'Parâmetros não informados';
	  
	  END IF;
		
	END IF;
    
SELECT Msg, id, statusInsert AS statusOperacao;  

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spr_validaPeso` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spr_validaPeso`(
	IN idCategoria int,
    IN idLutador int)
BEGIN

	DECLARE pesoLutador decimal(5,2);
	DECLARE nomeLutador varchar(60);
	DECLARE sobrenomeLutador varchar(60);
    DECLARE findCategoria int;
    DECLARE validacao int;
    
	SELECT peso, nome, sobrenome INTO pesoLutador, nomeLutador, sobrenomeLutador
    FROM pessoa 
    WHERE id=idLutador;    
    
    SELECT fc_getCategoriaLutador(pesoLutador) INTO findCategoria;
    
    
    IF(idCategoria = findCategoria)THEN
		SET validacao = 1;
	ELSE
		SET validacao = 0;
    END IF;
        
SELECT validacao, pesoLutador as peso, nomeLutador as nome, sobrenomeLutador as sobrenome;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-30 20:58:17
