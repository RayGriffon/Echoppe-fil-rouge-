-- MariaDB dump 10.19  Distrib 10.6.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: Echoppe
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
-- Table structure for table `Adresse`
--

DROP TABLE IF EXISTS `Adresse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Adresse` (
  `id_adresse` int(11) NOT NULL AUTO_INCREMENT,
  `num_rue_adresse` varchar(8) DEFAULT NULL,
  `nom_rue_adresse` varchar(250) DEFAULT NULL,
  `nom_ville_adresse` varchar(250) DEFAULT NULL,
  `cp_adresse` varchar(10) DEFAULT NULL,
  `pays_adresse` varchar(50) DEFAULT NULL,
  `id_client` int(11) NOT NULL,
  PRIMARY KEY (`id_adresse`),
  KEY `id_client` (`id_client`),
  CONSTRAINT `Adresse_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `Client` (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Adresse`
--

LOCK TABLES `Adresse` WRITE;
/*!40000 ALTER TABLE `Adresse` DISABLE KEYS */;
/*!40000 ALTER TABLE `Adresse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bon_de_livraison`
--

DROP TABLE IF EXISTS `Bon_de_livraison`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bon_de_livraison` (
  `id_bon_livraison` int(11) NOT NULL AUTO_INCREMENT,
  `date_livraison` date DEFAULT NULL,
  `id_commande` int(11) NOT NULL,
  PRIMARY KEY (`id_bon_livraison`),
  KEY `id_commande` (`id_commande`),
  CONSTRAINT `Bon_de_livraison_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `Commande` (`id_commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bon_de_livraison`
--

LOCK TABLES `Bon_de_livraison` WRITE;
/*!40000 ALTER TABLE `Bon_de_livraison` DISABLE KEYS */;
/*!40000 ALTER TABLE `Bon_de_livraison` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Catégorie`
--

DROP TABLE IF EXISTS `Catégorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Catégorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(50) DEFAULT NULL,
  `id_categorie_1` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_categorie`),
  KEY `id_categorie_1` (`id_categorie_1`),
  CONSTRAINT `Catégorie_ibfk_1` FOREIGN KEY (`id_categorie_1`) REFERENCES `Catégorie` (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Catégorie`
--

LOCK TABLES `Catégorie` WRITE;
/*!40000 ALTER TABLE `Catégorie` DISABLE KEYS */;
/*!40000 ALTER TABLE `Catégorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Client`
--

DROP TABLE IF EXISTS `Client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(50) DEFAULT NULL,
  `prenom_client` varchar(50) DEFAULT NULL,
  `contact_client` varchar(100) DEFAULT NULL,
  `categorie_client` tinyint(1) DEFAULT NULL,
  `coef_client` decimal(4,2) DEFAULT NULL,
  `commercial_attribue_client` varchar(50) DEFAULT NULL,
  `id_profil` int(11) NOT NULL,
  PRIMARY KEY (`id_client`),
  KEY `id_profil` (`id_profil`),
  CONSTRAINT `Client_ibfk_1` FOREIGN KEY (`id_profil`) REFERENCES `Profil` (`id_profil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Client`
--

LOCK TABLES `Client` WRITE;
/*!40000 ALTER TABLE `Client` DISABLE KEYS */;
/*!40000 ALTER TABLE `Client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Commande`
--

DROP TABLE IF EXISTS `Commande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Commande` (
  `id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `date_commande` date DEFAULT NULL,
  `reglement_commande` tinyint(1) DEFAULT NULL,
  `reduction_commande` decimal(5,2) DEFAULT NULL,
  `coef_client_commande` decimal(4,2) DEFAULT NULL,
  `nom_client_commande` varchar(50) DEFAULT NULL,
  `prenom_client_commande` varchar(50) DEFAULT NULL,
  `date_facture` date DEFAULT NULL,
  `num_rue_adresse_facture` varchar(8) DEFAULT NULL,
  `nom_rue_adresse_facture` varchar(250) DEFAULT NULL,
  `nom_ville_adresse_facture` varchar(250) DEFAULT NULL,
  `cp_adresse_facture` varchar(10) DEFAULT NULL,
  `pays_adresse_facture` varchar(50) DEFAULT NULL,
  `num_rue_adresse_livraison` varchar(8) DEFAULT NULL,
  `nom_rue_adresse_livraison` varchar(250) DEFAULT NULL,
  `nom_ville_adresse_livraison` varchar(250) DEFAULT NULL,
  `cp_adresse_livraison` varchar(10) DEFAULT NULL,
  `pays_adresse_livraison` varchar(50) DEFAULT NULL,
  `id_client` int(11) NOT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `id_client` (`id_client`),
  CONSTRAINT `Commande_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `Client` (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Commande`
--

LOCK TABLES `Commande` WRITE;
/*!40000 ALTER TABLE `Commande` DISABLE KEYS */;
/*!40000 ALTER TABLE `Commande` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Contient`
--

DROP TABLE IF EXISTS `Contient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Contient` (
  `id_produit` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `nom_produit_commande` varchar(50) DEFAULT NULL,
  `prix_produit_commande` decimal(10,2) DEFAULT NULL,
  `quantite_produit` int(11) DEFAULT NULL,
  `tva_produit_commande` decimal(5,2) DEFAULT NULL,
  `ref_produit_commande` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_produit`,`id_commande`),
  KEY `id_commande` (`id_commande`),
  CONSTRAINT `Contient_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `Produit` (`id_produit`),
  CONSTRAINT `Contient_ibfk_2` FOREIGN KEY (`id_commande`) REFERENCES `Commande` (`id_commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Contient`
--

LOCK TABLES `Contient` WRITE;
/*!40000 ALTER TABLE `Contient` DISABLE KEYS */;
/*!40000 ALTER TABLE `Contient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Définit`
--

DROP TABLE IF EXISTS `Définit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Définit` (
  `id_produit` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  PRIMARY KEY (`id_produit`,`id_categorie`),
  KEY `id_categorie` (`id_categorie`),
  CONSTRAINT `Définit_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `Produit` (`id_produit`),
  CONSTRAINT `Définit_ibfk_2` FOREIGN KEY (`id_categorie`) REFERENCES `Catégorie` (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Définit`
--

LOCK TABLES `Définit` WRITE;
/*!40000 ALTER TABLE `Définit` DISABLE KEYS */;
/*!40000 ALTER TABLE `Définit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Fournisseur`
--

DROP TABLE IF EXISTS `Fournisseur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Fournisseur` (
  `id_fournisseur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fournisseur` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_fournisseur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Fournisseur`
--

LOCK TABLES `Fournisseur` WRITE;
/*!40000 ALTER TABLE `Fournisseur` DISABLE KEYS */;
/*!40000 ALTER TABLE `Fournisseur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Gère`
--

DROP TABLE IF EXISTS `Gère`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Gère` (
  `id_produit` int(11) NOT NULL,
  `id_profil` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  PRIMARY KEY (`id_produit`,`id_profil`,`id_categorie`),
  KEY `id_profil` (`id_profil`),
  KEY `id_categorie` (`id_categorie`),
  CONSTRAINT `Gère_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `Produit` (`id_produit`),
  CONSTRAINT `Gère_ibfk_2` FOREIGN KEY (`id_profil`) REFERENCES `Profil` (`id_profil`),
  CONSTRAINT `Gère_ibfk_3` FOREIGN KEY (`id_categorie`) REFERENCES `Catégorie` (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Gère`
--

LOCK TABLES `Gère` WRITE;
/*!40000 ALTER TABLE `Gère` DISABLE KEYS */;
/*!40000 ALTER TABLE `Gère` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Livre`
--

DROP TABLE IF EXISTS `Livre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Livre` (
  `id_produit` int(11) NOT NULL,
  `id_bon_livraison` int(11) NOT NULL,
  `quantite_livree` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_produit`,`id_bon_livraison`),
  KEY `id_bon_livraison` (`id_bon_livraison`),
  CONSTRAINT `Livre_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `Produit` (`id_produit`),
  CONSTRAINT `Livre_ibfk_2` FOREIGN KEY (`id_bon_livraison`) REFERENCES `Bon_de_livraison` (`id_bon_livraison`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Livre`
--

LOCK TABLES `Livre` WRITE;
/*!40000 ALTER TABLE `Livre` DISABLE KEYS */;
/*!40000 ALTER TABLE `Livre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Photo`
--

DROP TABLE IF EXISTS `Photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Photo` (
  `id_photo` int(11) NOT NULL AUTO_INCREMENT,
  `nom_photo` varchar(50) DEFAULT NULL,
  `lien_photo` varchar(250) DEFAULT NULL,
  `id_produit` int(11) NOT NULL,
  PRIMARY KEY (`id_photo`),
  KEY `id_produit` (`id_produit`),
  CONSTRAINT `Photo_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `Produit` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Photo`
--

LOCK TABLES `Photo` WRITE;
/*!40000 ALTER TABLE `Photo` DISABLE KEYS */;
/*!40000 ALTER TABLE `Photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Produit`
--

DROP TABLE IF EXISTS `Produit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(50) DEFAULT NULL,
  `description_produit` varchar(250) DEFAULT NULL,
  `prix_produit` decimal(10,2) DEFAULT NULL,
  `tva_produit` decimal(5,2) DEFAULT NULL,
  `ref_produit` varchar(50) DEFAULT NULL,
  `publication_produit` tinyint(1) DEFAULT NULL,
  `id_fournisseur` int(11) NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `id_fournisseur` (`id_fournisseur`),
  CONSTRAINT `Produit_ibfk_1` FOREIGN KEY (`id_fournisseur`) REFERENCES `Fournisseur` (`id_fournisseur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Produit`
--

LOCK TABLES `Produit` WRITE;
/*!40000 ALTER TABLE `Produit` DISABLE KEYS */;
/*!40000 ALTER TABLE `Produit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Profil`
--

DROP TABLE IF EXISTS `Profil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Profil` (
  `id_profil` int(11) NOT NULL AUTO_INCREMENT,
  `nom_profil` varchar(50) DEFAULT NULL,
  `mdp_profil` varchar(50) DEFAULT NULL,
  `statut_profil` varchar(50) DEFAULT NULL,
  `mail_profil` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_profil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Profil`
--

LOCK TABLES `Profil` WRITE;
/*!40000 ALTER TABLE `Profil` DISABLE KEYS */;
/*!40000 ALTER TABLE `Profil` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-02 10:34:23
