-- MySQL dump 10.13  Distrib 5.5.54, for solaris11 (i386)
--
-- Host: esmeralda.store.d0m.de    Database: DB3578565
-- ------------------------------------------------------
-- Server version	5.6.42-log

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
-- Table structure for table `ag_50zu60undEntwickler`
--

DROP TABLE IF EXISTS `ag_50zu60undEntwickler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_50zu60undEntwickler` (
  `users_id` int(10) unsigned NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_doc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_profile` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_role` enum('0','1','2','') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '''0''=> ''freelancers'' , ''1'' => ''Admin'',''2''=>Employee',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `postal_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skill_id` int(10) unsigned DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_50zu60undEntwickler`
--

LOCK TABLES `ag_50zu60undEntwickler` WRITE;
/*!40000 ALTER TABLE `ag_50zu60undEntwickler` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_50zu60undEntwickler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_77777`
--

DROP TABLE IF EXISTS `ag_77777`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_77777` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `probability` int(11) NOT NULL,
  `hotness` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailed_coding` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `client_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_number` bigint(20) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `technology` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_field` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opportunity_type` int(11) DEFAULT '0',
  `opportunity_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_77777`
--

LOCK TABLES `ag_77777` WRITE;
/*!40000 ALTER TABLE `ag_77777` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_77777` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_ASPNetList`
--

DROP TABLE IF EXISTS `ag_ASPNetList`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_ASPNetList` (
  `users_id` int(10) unsigned NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Herr',
  `first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_doc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_profile` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_role` enum('0','1','2','') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '''0''=> ''freelancers'' , ''1'' => ''Admin'',''2''=>Employee',
  `added_by` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `postal_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skill_id` int(10) unsigned DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_ASPNetList`
--

LOCK TABLES `ag_ASPNetList` WRITE;
/*!40000 ALTER TABLE `ag_ASPNetList` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_ASPNetList` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_Beispiel`
--

DROP TABLE IF EXISTS `ag_Beispiel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_Beispiel` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `probability` int(11) NOT NULL,
  `hotness` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailed_coding` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `client_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_number` bigint(20) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `technology` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_field` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opportunity_type` int(11) DEFAULT '0',
  `opportunity_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_Beispiel`
--

LOCK TABLES `ag_Beispiel` WRITE;
/*!40000 ALTER TABLE `ag_Beispiel` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_Beispiel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_DetailedTechnologyBizTalk`
--

DROP TABLE IF EXISTS `ag_DetailedTechnologyBizTalk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_DetailedTechnologyBizTalk` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `account_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `touch_rule` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detailed_technologies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `freelancers` int(11) DEFAULT NULL,
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '''0''=> ''Kunden'' , ''1'' => ''Kunden Not in Database''',
  `Technology` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_of_client` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_DetailedTechnologyBizTalk`
--

LOCK TABLES `ag_DetailedTechnologyBizTalk` WRITE;
/*!40000 ALTER TABLE `ag_DetailedTechnologyBizTalk` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_DetailedTechnologyBizTalk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_Freelancergreaterthan1`
--

DROP TABLE IF EXISTS `ag_Freelancergreaterthan1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_Freelancergreaterthan1` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `account_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `touch_rule` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detailed_technologies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `freelancers` int(11) DEFAULT NULL,
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '''0''=> ''Kunden'' , ''1'' => ''Kunden Not in Database''',
  `Technology` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_of_client` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_Freelancergreaterthan1`
--

LOCK TABLES `ag_Freelancergreaterthan1` WRITE;
/*!40000 ALTER TABLE `ag_Freelancergreaterthan1` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_Freelancergreaterthan1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_Hotness`
--

DROP TABLE IF EXISTS `ag_Hotness`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_Hotness` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `probability` int(11) NOT NULL,
  `hotness` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailed_coding` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `client_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_number` bigint(20) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `technology` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_field` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opportunity_type` int(11) DEFAULT '0',
  `opportunity_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_Hotness`
--

LOCK TABLES `ag_Hotness` WRITE;
/*!40000 ALTER TABLE `ag_Hotness` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_Hotness` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_Hotness1bis3`
--

DROP TABLE IF EXISTS `ag_Hotness1bis3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_Hotness1bis3` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `account_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `touch_rule` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detailed_technologies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `freelancers` int(11) DEFAULT NULL,
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '''0''=> ''Kunden'' , ''1'' => ''Kunden Not in Database''',
  `Technology` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_of_client` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_Hotness1bis3`
--

LOCK TABLES `ag_Hotness1bis3` WRITE;
/*!40000 ALTER TABLE `ag_Hotness1bis3` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_Hotness1bis3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_Hotness4bis7`
--

DROP TABLE IF EXISTS `ag_Hotness4bis7`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_Hotness4bis7` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `account_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `touch_rule` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detailed_technologies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `freelancers` int(11) DEFAULT NULL,
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '''0''=> ''Kunden'' , ''1'' => ''Kunden Not in Database''',
  `Technology` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_of_client` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_Hotness4bis7`
--

LOCK TABLES `ag_Hotness4bis7` WRITE;
/*!40000 ALTER TABLE `ag_Hotness4bis7` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_Hotness4bis7` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_Hotness7aufwärts`
--

DROP TABLE IF EXISTS `ag_Hotness7aufwärts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_Hotness7aufwärts` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `account_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `touch_rule` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detailed_technologies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `freelancers` int(11) DEFAULT NULL,
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '''0''=> ''Kunden'' , ''1'' => ''Kunden Not in Database''',
  `Technology` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_of_client` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_Hotness7aufwärts`
--

LOCK TABLES `ag_Hotness7aufwärts` WRITE;
/*!40000 ALTER TABLE `ag_Hotness7aufwärts` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_Hotness7aufwärts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_JavaTechnology`
--

DROP TABLE IF EXISTS `ag_JavaTechnology`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_JavaTechnology` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `probability` int(11) NOT NULL,
  `hotness` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailed_coding` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `client_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_number` bigint(20) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `technology` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_field` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opportunity_type` int(11) DEFAULT '0',
  `opportunity_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_JavaTechnology`
--

LOCK TABLES `ag_JavaTechnology` WRITE;
/*!40000 ALTER TABLE `ag_JavaTechnology` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_JavaTechnology` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_Lastcontact5thOctoberorBefore`
--

DROP TABLE IF EXISTS `ag_Lastcontact5thOctoberorBefore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_Lastcontact5thOctoberorBefore` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `account_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `touch_rule` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detailed_technologies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `freelancers` int(11) DEFAULT NULL,
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '''0''=> ''Kunden'' , ''1'' => ''Kunden Not in Database''',
  `Technology` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_of_client` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_Lastcontact5thOctoberorBefore`
--

LOCK TABLES `ag_Lastcontact5thOctoberorBefore` WRITE;
/*!40000 ALTER TABLE `ag_Lastcontact5thOctoberorBefore` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_Lastcontact5thOctoberorBefore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_LastcontactbeforeOctober`
--

DROP TABLE IF EXISTS `ag_LastcontactbeforeOctober`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_LastcontactbeforeOctober` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `account_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `touch_rule` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detailed_technologies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `freelancers` int(11) DEFAULT NULL,
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '''0''=> ''Kunden'' , ''1'' => ''Kunden Not in Database''',
  `Technology` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_of_client` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_LastcontactbeforeOctober`
--

LOCK TABLES `ag_LastcontactbeforeOctober` WRITE;
/*!40000 ALTER TABLE `ag_LastcontactbeforeOctober` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_LastcontactbeforeOctober` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_Lastcontactbeforeapril2018`
--

DROP TABLE IF EXISTS `ag_Lastcontactbeforeapril2018`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_Lastcontactbeforeapril2018` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `account_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `touch_rule` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detailed_technologies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `freelancers` int(11) DEFAULT NULL,
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '''0''=> ''Kunden'' , ''1'' => ''Kunden Not in Database''',
  `Technology` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_of_client` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_Lastcontactbeforeapril2018`
--

LOCK TABLES `ag_Lastcontactbeforeapril2018` WRITE;
/*!40000 ALTER TABLE `ag_Lastcontactbeforeapril2018` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_Lastcontactbeforeapril2018` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_Lastcontactbeforeseptember`
--

DROP TABLE IF EXISTS `ag_Lastcontactbeforeseptember`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_Lastcontactbeforeseptember` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `account_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `touch_rule` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detailed_technologies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `freelancers` int(11) DEFAULT NULL,
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '''0''=> ''Kunden'' , ''1'' => ''Kunden Not in Database''',
  `Technology` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_of_client` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_Lastcontactbeforeseptember`
--

LOCK TABLES `ag_Lastcontactbeforeseptember` WRITE;
/*!40000 ALTER TABLE `ag_Lastcontactbeforeseptember` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_Lastcontactbeforeseptember` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_Microsoft`
--

DROP TABLE IF EXISTS `ag_Microsoft`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_Microsoft` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `probability` int(11) NOT NULL,
  `hotness` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailed_coding` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `client_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_number` bigint(20) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `technology` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_field` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opportunity_type` int(11) DEFAULT '0',
  `opportunity_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_Microsoft`
--

LOCK TABLES `ag_Microsoft` WRITE;
/*!40000 ALTER TABLE `ag_Microsoft` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_Microsoft` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_NumberofFreelancerList`
--

DROP TABLE IF EXISTS `ag_NumberofFreelancerList`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_NumberofFreelancerList` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `account_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `touch_rule` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detailed_technologies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `freelancers` int(11) DEFAULT NULL,
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '''0''=> ''Kunden'' , ''1'' => ''Kunden Not in Database''',
  `Technology` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_of_client` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_NumberofFreelancerList`
--

LOCK TABLES `ag_NumberofFreelancerList` WRITE;
/*!40000 ALTER TABLE `ag_NumberofFreelancerList` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_NumberofFreelancerList` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_PHP`
--

DROP TABLE IF EXISTS `ag_PHP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_PHP` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `probability` int(11) NOT NULL,
  `hotness` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailed_coding` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `client_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_number` bigint(20) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `technology` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_field` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opportunity_type` int(11) DEFAULT '0',
  `opportunity_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_PHP`
--

LOCK TABLES `ag_PHP` WRITE;
/*!40000 ALTER TABLE `ag_PHP` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_PHP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_PHPListe`
--

DROP TABLE IF EXISTS `ag_PHPListe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_PHPListe` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `probability` int(11) NOT NULL,
  `hotness` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailed_coding` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `client_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_number` bigint(20) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `technology` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_field` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opportunity_type` int(11) DEFAULT '0',
  `opportunity_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_PHPListe`
--

LOCK TABLES `ag_PHPListe` WRITE;
/*!40000 ALTER TABLE `ag_PHPListe` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_PHPListe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_Postcode0`
--

DROP TABLE IF EXISTS `ag_Postcode0`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_Postcode0` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `account_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `touch_rule` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detailed_technologies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `freelancers` int(11) DEFAULT NULL,
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '''0''=> ''Kunden'' , ''1'' => ''Kunden Not in Database''',
  `Technology` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_of_client` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_Postcode0`
--

LOCK TABLES `ag_Postcode0` WRITE;
/*!40000 ALTER TABLE `ag_Postcode0` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_Postcode0` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_Postcode23`
--

DROP TABLE IF EXISTS `ag_Postcode23`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_Postcode23` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `account_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `touch_rule` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detailed_technologies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `freelancers` int(11) DEFAULT NULL,
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '''0''=> ''Kunden'' , ''1'' => ''Kunden Not in Database''',
  `Technology` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_of_client` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_Postcode23`
--

LOCK TABLES `ag_Postcode23` WRITE;
/*!40000 ALTER TABLE `ag_Postcode23` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_Postcode23` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_Postcode7`
--

DROP TABLE IF EXISTS `ag_Postcode7`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_Postcode7` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `account_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `touch_rule` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detailed_technologies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `freelancers` int(11) DEFAULT NULL,
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '''0''=> ''Kunden'' , ''1'' => ''Kunden Not in Database''',
  `Technology` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_of_client` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_Postcode7`
--

LOCK TABLES `ag_Postcode7` WRITE;
/*!40000 ALTER TABLE `ag_Postcode7` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_Postcode7` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_Tech_java_opportunity`
--

DROP TABLE IF EXISTS `ag_Tech_java_opportunity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_Tech_java_opportunity` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `probability` int(11) NOT NULL,
  `hotness` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailed_coding` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `client_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_number` bigint(20) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `technology` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_field` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opportunity_type` int(11) DEFAULT '0',
  `opportunity_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_Tech_java_opportunity`
--

LOCK TABLES `ag_Tech_java_opportunity` WRITE;
/*!40000 ALTER TABLE `ag_Tech_java_opportunity` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_Tech_java_opportunity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_TechnologyList`
--

DROP TABLE IF EXISTS `ag_TechnologyList`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_TechnologyList` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `account_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `touch_rule` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detailed_technologies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `freelancers` int(11) DEFAULT NULL,
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '''0''=> ''Kunden'' , ''1'' => ''Kunden Not in Database''',
  `Technology` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_of_client` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_TechnologyList`
--

LOCK TABLES `ag_TechnologyList` WRITE;
/*!40000 ALTER TABLE `ag_TechnologyList` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_TechnologyList` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_TechnologySAPPHP`
--

DROP TABLE IF EXISTS `ag_TechnologySAPPHP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_TechnologySAPPHP` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `account_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `touch_rule` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detailed_technologies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `freelancers` int(11) DEFAULT NULL,
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '''0''=> ''Kunden'' , ''1'' => ''Kunden Not in Database''',
  `Technology` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_of_client` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_TechnologySAPPHP`
--

LOCK TABLES `ag_TechnologySAPPHP` WRITE;
/*!40000 ALTER TABLE `ag_TechnologySAPPHP` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_TechnologySAPPHP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_Type`
--

DROP TABLE IF EXISTS `ag_Type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_Type` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `probability` int(11) NOT NULL,
  `hotness` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailed_coding` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `client_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_number` bigint(20) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `technology` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_field` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opportunity_type` int(11) DEFAULT '0',
  `opportunity_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_Type`
--

LOCK TABLES `ag_Type` WRITE;
/*!40000 ALTER TABLE `ag_Type` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_Type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_account_list`
--

DROP TABLE IF EXISTS `ag_account_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_account_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hotness_filter` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode_filter` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `freelnacer_filter` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `technology_filter` text COLLATE utf8_unicode_ci,
  `last_contact` text COLLATE utf8_unicode_ci,
  `detailed_technologies` text COLLATE utf8_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_account_list`
--

LOCK TABLES `ag_account_list` WRITE;
/*!40000 ALTER TABLE `ag_account_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_account_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_account_log`
--

DROP TABLE IF EXISTS `ag_account_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_account_log` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `account_id` int(10) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `action` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_account_log`
--

LOCK TABLES `ag_account_log` WRITE;
/*!40000 ALTER TABLE `ag_account_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_account_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_accounts`
--

DROP TABLE IF EXISTS `ag_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prozesse` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freelancers` int(11) DEFAULT NULL,
  `Technology` text COLLATE utf8mb4_unicode_ci,
  `last_time_contact` datetime DEFAULT NULL,
  `type_of_client` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `client_specification` text COLLATE utf8mb4_unicode_ci,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_lable` text COLLATE utf8mb4_unicode_ci,
  `telephone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `decision_maker` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>No,1=>Yes',
  `departement_size` int(11) DEFAULT NULL,
  `job_outcome` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>No,1=>Yes',
  `detailed_technologies` text COLLATE utf8mb4_unicode_ci,
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '''0''=> ''Kunden'' , ''1'' => ''Kunden Not in Database''',
  `touch_rule` text COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_accounts`
--

LOCK TABLES `ag_accounts` WRITE;
/*!40000 ALTER TABLE `ag_accounts` DISABLE KEYS */;
INSERT INTO `ag_accounts` VALUES (1,'Test','Telefon Interview','Екатеринбург','620028','Germany',1,'SAP,PHP',NULL,'Customer',NULL,'1','3','Email','','89655298933',NULL,0,11,0,NULL,0,NULL,2,NULL,'2018-11-08 09:37:43','2018-11-08 09:37:43');
/*!40000 ALTER TABLE `ag_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_ag_experiences`
--

DROP TABLE IF EXISTS `ag_ag_experiences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_ag_experiences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `sector` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_period` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position_desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_ag_experiences`
--

LOCK TABLES `ag_ag_experiences` WRITE;
/*!40000 ALTER TABLE `ag_ag_experiences` DISABLE KEYS */;
INSERT INTO `ag_ag_experiences` VALUES (1,1,'2','2019 to now','Huwai','1','testtesttesttesttesttesttesttesttesttest'),(2,1,'0','2018','Huwai','1','work'),(3,89,'2','2018','Huwai','3','working now'),(4,89,'0','2019','Huwai','1','working today'),(5,47,'14','2018','test1','1','tests1'),(6,47,'','','','2',''),(7,50,'1','2018','dev','1','test'),(8,50,'0','2019','devs','2','tests'),(9,50,'2','2020','last','5','work and test now'),(10,47,'2','Still Missing','Daimler AG','1','ABC');
/*!40000 ALTER TABLE `ag_ag_experiences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_calendar_events`
--

DROP TABLE IF EXISTS `ag_calendar_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_calendar_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `task_date` date DEFAULT NULL,
  `task_status` text,
  `task_type` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_calendar_events`
--

LOCK TABLES `ag_calendar_events` WRITE;
/*!40000 ALTER TABLE `ag_calendar_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_calendar_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_candidates_invites`
--

DROP TABLE IF EXISTS `ag_candidates_invites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_candidates_invites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `invitation_code` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sent_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `used_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_candidates_invites`
--

LOCK TABLES `ag_candidates_invites` WRITE;
/*!40000 ALTER TABLE `ag_candidates_invites` DISABLE KEYS */;
INSERT INTO `ag_candidates_invites` VALUES (2,'gux50747@bcaoo.com','9fNXOl5HByBjZcG','2019-07-01 00:13:28','2019-07-01 00:13:28','2019-07-01 00:16:17'),(3,'mariohonegg@gmail.com','5z3itYdxVBMHSylCuN0ofCLETkCB5PuDKn8','2019-07-04 07:23:25','2019-07-04 07:23:25',NULL),(4,'kvt13743@bcaoo.com','YzvcJ90B1ujNpDXUscyJZy05625yqQQy4LW','2019-07-04 08:52:01','2019-07-04 08:52:01',NULL),(5,'sacram@inbox.ru','wIyaBej6JDiqdNZcYLXKUJohlv2eFBJWJAy','2019-07-04 16:26:37','2019-07-04 16:26:37',NULL),(6,'yaa87671@bcaoo.com','NBLnqKFnRkPuAop6M2sv1PwmkdASupo1TMp','2019-07-04 16:31:35','2019-07-04 16:31:35',NULL),(7,'work.a.andrey@gmail.com','AO3fZXIBuB0UpUY4Vw31HXWD8L08SLYMzUj','2019-07-04 16:32:55','2019-07-04 16:32:55',NULL);
/*!40000 ALTER TABLE `ag_candidates_invites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_comments`
--

DROP TABLE IF EXISTS `ag_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_comments`
--

LOCK TABLES `ag_comments` WRITE;
/*!40000 ALTER TABLE `ag_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_competences`
--

DROP TABLE IF EXISTS `ag_competences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_competences` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_competences`
--

LOCK TABLES `ag_competences` WRITE;
/*!40000 ALTER TABLE `ag_competences` DISABLE KEYS */;
INSERT INTO `ag_competences` VALUES (1,'Microsoft .Net'),(2,'Embedded'),(3,'Java'),(4,'Network Security Infrastructure'),(5,'SAP'),(6,'Testing'),(7,'Business Intelligence'),(8,'Project management');
/*!40000 ALTER TABLE `ag_competences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_competences_skill`
--

DROP TABLE IF EXISTS `ag_competences_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_competences_skill` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `competences_id` int(9) NOT NULL,
  `skill` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_competences_skill`
--

LOCK TABLES `ag_competences_skill` WRITE;
/*!40000 ALTER TABLE `ag_competences_skill` DISABLE KEYS */;
INSERT INTO `ag_competences_skill` VALUES (2,1,'ASP.Net'),(3,1,'BizTalk'),(5,1,'HTML'),(6,1,'jQuery'),(7,1,'knockout'),(8,1,'MVC'),(9,1,'MVVM'),(10,1,'Oracle'),(11,1,'SharePoint'),(12,1,'SQL'),(14,1,'Typescript'),(15,1,'VB.Net'),(16,1,'VBA'),(17,1,'WCF'),(18,1,'WF'),(19,1,'WPF'),(20,2,'autosar'),(21,2,'C'),(22,2,'C ++'),(23,2,'Embedded'),(24,2,'firmware'),(25,2,'FPGA'),(26,2,'labview'),(27,2,'Matlab'),(28,2,'microcontrollers'),(29,2,'QT'),(30,2,'S7'),(31,3,'ajax'),(32,3,'Android'),(33,3,'Apache'),(34,3,'Cobol'),(35,3,'Delphi'),(36,3,'Django'),(37,3,'Drupal'),(38,3,'Eclipse'),(39,3,'Flash'),(40,3,'GlassFish'),(41,3,'Groovy'),(42,3,'Hibernate'),(43,3,'hubris'),(44,3,'J2EE'),(45,3,'Java'),(46,3,'JavaScript'),(47,3,'JBoss'),(48,3,'Jenkins'),(49,3,'Joomla'),(50,3,'JSF'),(51,3,'junit'),(52,3,'Magento'),(53,3,'Maven'),(54,3,'MySQL'),(55,3,'Netbeans'),(56,3,'NoSQL'),(58,3,'Perl'),(59,3,'PHP'),(60,3,'python'),(61,3,'Ruby on rails'),(63,3,'SWING'),(64,3,'symfony'),(65,3,'Tomcat'),(66,3,'TYPO3'),(67,3,'Vaadin'),(68,3,'Websphere'),(69,3,'WordPress'),(70,4,'Active Directory'),(71,4,'Cisco'),(72,4,'Citrix'),(73,4,'Cognos'),(74,4,'Helpdesk'),(76,4,'HP'),(77,4,'Linux'),(78,4,'lotus'),(79,4,'Network'),(80,4,'NSI'),(82,4,'SAS'),(84,4,'Unix'),(85,4,'VMWare'),(86,4,'Windows'),(87,5,'ABAP'),(88,5,'Admin'),(89,5,'BASE'),(90,5,'BI'),(91,5,'BW'),(92,5,'Change Management'),(93,5,'CO'),(94,5,'CRM'),(95,5,'FI'),(96,5,'HCM'),(97,5,'MR'),(98,5,'ISU'),(99,5,'MM'),(100,5,'NETWEAVER'),(101,5,'PM'),(102,5,'PP'),(103,5,'QM'),(104,5,'SD'),(105,5,'WM'),(106,6,'Automated Tester'),(107,6,'Embedded Tester'),(108,6,'Functional Tester'),(109,6,'ISTQB'),(110,6,'Performance Engineering'),(111,6,'Quality Engineer'),(112,6,'Safety test'),(113,6,'Selenium'),(114,6,'Test Analyst'),(115,6,'Test Manager'),(116,6,'tester'),(117,6,'Testing'),(118,7,'BI'),(119,7,'BI EE'),(120,7,'Cognos'),(121,7,'Crystal Reports'),(122,7,'Data Warehouse'),(123,7,'ETL'),(124,7,'MS Analysis Services'),(125,7,'MS BI'),(126,7,'Oracle BI'),(127,7,'Oracle WH Builder'),(128,7,'TM1'),(129,8,'Product Owner'),(130,8,'Project Manager'),(131,8,'SCRUM Master'),(133,1,'AngularJS'),(135,1,'C#'),(136,3,'Node.js'),(137,1,'Vue.js'),(138,4,'PostgreSQL'),(139,3,'Docker');
/*!40000 ALTER TABLE `ag_competences_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_contacts`
--

DROP TABLE IF EXISTS `ag_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `decision_maker` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>No,1=>Yes',
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `touch_rule` text COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contacts_email_id_unique` (`email_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_contacts`
--

LOCK TABLES `ag_contacts` WRITE;
/*!40000 ALTER TABLE `ag_contacts` DISABLE KEYS */;
INSERT INTO `ag_contacts` VALUES (1,'Foo','Bar','1','Geschäftsführer','Geschäftsführung','9655298933','9655298933','work.a.andrey@gmail.com','asdasd',0,'Екатеринбург','620028','Germany',NULL,2,NULL,'2018-11-08 09:39:12','2018-11-08 09:39:12'),(3,'Foo','Bar','1','Geschäftsführer','Geschäftsführung','9655298933','9655298933','work.a.andrey1@gmail.com','asdasd',0,'Екатеринбург','620028','Germany',NULL,2,NULL,'2018-11-08 09:39:12','2018-11-08 09:39:12'),(4,'Foo','Bar','1','Geschäftsführer','Geschäftsführung','9655298933','9655298933','work.a.andrey2@gmail.com','asdasd',0,'Екатеринбург','620028','Germany',NULL,2,NULL,'2018-11-08 09:39:12','2018-11-08 09:39:12'),(5,'Foo','Bar','1','Geschäftsführer','Geschäftsführung','9655298933','9655298933','work.a.andrey3@gmail.com','asdasd',0,'Екатеринбург','620028','Germany',NULL,2,NULL,'2018-11-08 09:39:12','2018-11-08 09:39:12'),(6,'Foo','Bar','1','Geschäftsführer','Geschäftsführung','9655298933','9655298933','work.a.andrey4@gmail.com','asdasd',0,'Екатеринбург','620028','Germany',NULL,2,NULL,'2018-11-08 09:39:12','2018-11-08 09:39:12'),(7,'Foo','Bar','1','Geschäftsführer','Geschäftsführung','9655298933','9655298933','work.a.andrey5@gmail.com','asdasd',0,'Екатеринбург','620028','Germany',NULL,2,NULL,'2018-11-08 09:39:12','2018-11-08 09:39:12'),(8,'Foo','Bar','1','Geschäftsführer','Geschäftsführung','9655298933','9655298933','work.a.andrey6@gmail.com','asdasd',0,'Екатеринбург','620028','Germany',NULL,2,NULL,'2018-11-08 09:39:12','2018-11-08 09:39:12'),(9,'Foo','Bar','1','Geschäftsführer','Geschäftsführung','9655298933','9655298933','work.a.andrey7@gmail.com','asdasd',0,'Екатеринбург','620028','Germany',NULL,2,NULL,'2018-11-08 09:39:12','2018-11-08 09:39:12'),(10,'Foo','Bar','1','Geschäftsführer','Geschäftsführung','9655298933','9655298933','work.a.andrey8@gmail.com','asdasd',0,'Екатеринбург','620028','Germany',NULL,2,NULL,'2018-11-08 09:39:12','2018-11-08 09:39:12'),(11,'Foo','Bar','1','Geschäftsführer','Geschäftsführung','9655298933','9655298933','work.a.andrey9@gmail.com','asdasd',0,'Екатеринбург','620028','Germany',NULL,2,NULL,'2018-11-08 09:39:12','2018-11-08 09:39:12'),(12,'Foo','Bar','1','Geschäftsführer','Geschäftsführung','9655298933','9655298933','work.a.andrey10@gmail.com','asdasd',0,'Екатеринбург','620028','Germany',NULL,2,NULL,'2018-11-08 09:39:12','2018-11-08 09:39:12'),(13,'Foo','Bar','1','Geschäftsführer','Geschäftsführung','9655298933','9655298933','work.a.andrey11@gmail.com','asdasd',0,'Екатеринбург','620028','Germany',NULL,2,NULL,'2018-11-08 09:39:12','2018-11-08 09:39:12'),(14,'Foo','Bar','1','Geschäftsführer','Geschäftsführung','9655298933','9655298933','work.a.andrey12@gmail.com','asdasd',0,'Екатеринбург','620028','Germany',NULL,2,NULL,'2018-11-08 09:39:12','2018-11-08 09:39:12'),(15,'Foo','Bar','1','Geschäftsführer','Geschäftsführung','9655298933','9655298933','work.a.andrey13@gmail.com','asdasd',0,'Екатеринбург','620028','Germany',NULL,2,NULL,'2018-11-08 09:39:12','2018-11-08 09:39:12'),(16,'Foo','Bar','1','Geschäftsführer','Geschäftsführung','9655298933','9655298933','work.a.andrey14@gmail.com','asdasd',0,'Екатеринбург','620028','Germany',NULL,2,NULL,'2018-11-08 09:39:12','2018-11-08 09:39:12'),(17,'Foo','Bar','1','Geschäftsführer','Geschäftsführung','9655298933','9655298933','work.a.andrey15@gmail.com','asdasd',0,'Екатеринбург','620028','Germany',NULL,2,NULL,'2018-11-08 09:39:12','2018-11-08 09:39:12'),(18,'Foo','Bar','1','Geschäftsführer','Geschäftsführung','9655298933','9655298933','work.a.andrey16@gmail.com','asdasd',0,'Екатеринбург','620028','Germany',NULL,2,NULL,'2018-11-08 09:39:12','2018-11-08 09:39:12'),(19,'Foo','Bar','1','Geschäftsführer','Geschäftsführung','9655298933','9655298933','work.a.andrey17@gmail.com','asdasd',0,'Екатеринбург','620028','Germany',NULL,2,NULL,'2018-11-08 09:39:12','2018-11-08 09:39:12');
/*!40000 ALTER TABLE `ag_contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_contract8`
--

DROP TABLE IF EXISTS `ag_contract8`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_contract8` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `probability` int(11) NOT NULL,
  `hotness` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailed_coding` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `client_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_number` bigint(20) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `technology` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_field` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opportunity_type` int(11) DEFAULT '0',
  `opportunity_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_contract8`
--

LOCK TABLES `ag_contract8` WRITE;
/*!40000 ALTER TABLE `ag_contract8` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_contract8` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_countries`
--

DROP TABLE IF EXISTS `ag_countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_country` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `countries_code_index` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_countries`
--

LOCK TABLES `ag_countries` WRITE;
/*!40000 ALTER TABLE `ag_countries` DISABLE KEYS */;
INSERT INTO `ag_countries` VALUES (1,'AF','Afghanistan',0),(2,'AX','Åland Islands',0),(3,'AL','Albania',0),(4,'DZ','Algeria',0),(5,'AS','American Samoa',0),(6,'AD','Andorra',0),(7,'AO','Angola',0),(8,'AI','Anguilla',0),(9,'AQ','Antarctica',0),(10,'AG','Antigua and Barbuda',0),(11,'AR','Argentina',0),(12,'AM','Armenia',0),(13,'AW','Aruba',0),(14,'AU','Australia',0),(15,'AT','Austria',1),(16,'AZ','Azerbaijan',0),(17,'BS','Bahamas',0),(18,'BH','Bahrain',0),(19,'BD','Bangladesh',0),(20,'BB','Barbados',0),(21,'BY','Belarus',0),(22,'BE','Belgium',0),(23,'BZ','Belize',0),(24,'BJ','Benin',0),(25,'BM','Bermuda',0),(26,'BT','Bhutan',0),(27,'BO','Bolivia, Plurinational State of',0),(28,'BQ','Bonaire, Sint Eustatius and Saba',0),(29,'BA','Bosnia and Herzegovina',0),(30,'BW','Botswana',0),(31,'BV','Bouvet Island',0),(32,'BR','Brazil',0),(33,'IO','British Indian Ocean Territory',0),(34,'BN','Brunei Darussalam',0),(35,'BG','Bulgaria',0),(36,'BF','Burkina Faso',0),(37,'BI','Burundi',0),(38,'KH','Cambodia',0),(39,'CM','Cameroon',0),(40,'CA','Canada',0),(41,'CV','Cape Verde',0),(42,'KY','Cayman Islands',0),(43,'CF','Central African Republic',0),(44,'TD','Chad',0),(45,'CL','Chile',0),(46,'CN','China',0),(47,'CX','Christmas Island',0),(48,'CC','Cocos (Keeling) Islands',0),(49,'CO','Colombia',0),(50,'KM','Comoros',0),(51,'CG','Congo',0),(52,'CD','Congo, the Democratic Republic of the',0),(53,'CK','Cook Islands',0),(54,'CR','Costa Rica',0),(55,'CI','Côte d\'Ivoire',0),(56,'HR','Croatia',0),(57,'CU','Cuba',0),(58,'CW','Curaçao',0),(59,'CY','Cyprus',0),(60,'CZ','Czech Republic',0),(61,'DK','Denmark',0),(62,'DJ','Djibouti',0),(63,'DM','Dominica',0),(64,'DO','Dominican Republic',0),(65,'EC','Ecuador',0),(66,'EG','Egypt',0),(67,'SV','El Salvador',0),(68,'GQ','Equatorial Guinea',0),(69,'ER','Eritrea',0),(70,'EE','Estonia',0),(71,'ET','Ethiopia',0),(72,'FK','Falkland Islands (Malvinas)',0),(73,'FO','Faroe Islands',0),(74,'FJ','Fiji',0),(75,'FI','Finland',0),(76,'FR','France',1),(77,'GF','French Guiana',0),(78,'PF','French Polynesia',0),(79,'TF','French Southern Territories',0),(80,'GA','Gabon',0),(81,'GM','Gambia',0),(82,'GE','Georgia',0),(83,'DE','Germany',1),(84,'GH','Ghana',0),(85,'GI','Gibraltar',0),(86,'GR','Greece',0),(87,'GL','Greenland',0),(88,'GD','Grenada',0),(89,'GP','Guadeloupe',0),(90,'GU','Guam',0),(91,'GT','Guatemala',0),(92,'GG','Guernsey',0),(93,'GN','Guinea',0),(94,'GW','Guinea-Bissau',0),(95,'GY','Guyana',0),(96,'HT','Haiti',0),(97,'HM','Heard Island and McDonald Mcdonald Islands',0),(98,'VA','Holy See (Vatican City State)',0),(99,'HN','Honduras',0),(100,'HK','Hong Kong',0),(101,'HU','Hungary',0),(102,'IS','Iceland',0),(103,'IN','India',0),(104,'ID','Indonesia',0),(105,'IR','Iran, Islamic Republic of',0),(106,'IQ','Iraq',0),(107,'IE','Ireland',0),(108,'IM','Isle of Man',0),(109,'IL','Israel',0),(110,'IT','Italy',0),(111,'JM','Jamaica',0),(112,'JP','Japan',0),(113,'JE','Jersey',0),(114,'JO','Jordan',0),(115,'KZ','Kazakhstan',0),(116,'KE','Kenya',0),(117,'KI','Kiribati',0),(118,'KP','Korea, Democratic People\'s Republic of',0),(119,'KR','Korea, Republic of',0),(120,'KW','Kuwait',0),(121,'KG','Kyrgyzstan',0),(122,'LA','Lao People\'s Democratic Republic',0),(123,'LV','Latvia',0),(124,'LB','Lebanon',0),(125,'LS','Lesotho',0),(126,'LR','Liberia',0),(127,'LY','Libya',0),(128,'LI','Liechtenstein',0),(129,'LT','Lithuania',0),(130,'LU','Luxembourg',0),(131,'MO','Macao',0),(132,'MK','Macedonia, the Former Yugoslav Republic of',0),(133,'MG','Madagascar',0),(134,'MW','Malawi',0),(135,'MY','Malaysia',0),(136,'MV','Maldives',0),(137,'ML','Mali',0),(138,'MT','Malta',0),(139,'MH','Marshall Islands',0),(140,'MQ','Martinique',0),(141,'MR','Mauritania',0),(142,'MU','Mauritius',0),(143,'YT','Mayotte',0),(144,'MX','Mexico',0),(145,'FM','Micronesia, Federated States of',0),(146,'MD','Moldova, Republic of',0),(147,'MC','Monaco',0),(148,'MN','Mongolia',0),(149,'ME','Montenegro',0),(150,'MS','Montserrat',0),(151,'MA','Morocco',0),(152,'MZ','Mozambique',0),(153,'MM','Myanmar',0),(154,'NA','Namibia',0),(155,'NR','Nauru',0),(156,'NP','Nepal',0),(157,'NL','Netherlands',1),(158,'NC','New Caledonia',0),(159,'NZ','New Zealand',0),(160,'NI','Nicaragua',0),(161,'NE','Niger',0),(162,'NG','Nigeria',0),(163,'NU','Niue',0),(164,'NF','Norfolk Island',0),(165,'MP','Northern Mariana Islands',0),(166,'NO','Norway',0),(167,'OM','Oman',0),(168,'PK','Pakistan',0),(169,'PW','Palau',0),(170,'PS','Palestine, State of',0),(171,'PA','Panama',0),(172,'PG','Papua New Guinea',0),(173,'PY','Paraguay',0),(174,'PE','Peru',0),(175,'PH','Philippines',0),(176,'PN','Pitcairn',0),(177,'PL','Poland',0),(178,'PT','Portugal',0),(179,'PR','Puerto Rico',0),(180,'QA','Qatar',0),(181,'RE','Réunion',0),(182,'RO','Romania',0),(183,'RU','Russian Federation',0),(184,'RW','Rwanda',0),(185,'BL','Saint Barthélemy',0),(186,'SH','Saint Helena, Ascension and Tristan da Cunha',0),(187,'KN','Saint Kitts and Nevis',0),(188,'LC','Saint Lucia',0),(189,'MF','Saint Martin (French part)',0),(190,'PM','Saint Pierre and Miquelon',0),(191,'VC','Saint Vincent and the Grenadines',0),(192,'WS','Samoa',0),(193,'SM','San Marino',0),(194,'ST','Sao Tome and Principe',0),(195,'SA','Saudi Arabia',0),(196,'SN','Senegal',0),(197,'RS','Serbia',0),(198,'SC','Seychelles',0),(199,'SL','Sierra Leone',0),(200,'SG','Singapore',0),(201,'SX','Sint Maarten (Dutch part)',0),(202,'SK','Slovakia',0),(203,'SI','Slovenia',0),(204,'SB','Solomon Islands',0),(205,'SO','Somalia',0),(206,'ZA','South Africa',0),(207,'GS','South Georgia and the South Sandwich Islands',0),(208,'SS','South Sudan',0),(209,'ES','Spain',0),(210,'LK','Sri Lanka',0),(211,'SD','Sudan',0),(212,'SR','Suriname',0),(213,'SJ','Svalbard and Jan Mayen',0),(214,'SZ','Swaziland',0),(215,'SE','Sweden',0),(216,'CH','Switzerland',0),(217,'SY','Syrian Arab Republic',0),(218,'TW','Taiwan',0),(219,'TJ','Tajikistan',0),(220,'TZ','Tanzania, United Republic of',0),(221,'TH','Thailand',0),(222,'TL','Timor-Leste',0),(223,'TG','Togo',0),(224,'TK','Tokelau',0),(225,'TO','Tonga',0),(226,'TT','Trinidad and Tobago',0),(227,'TN','Tunisia',0),(228,'TR','Turkey',0),(229,'TM','Turkmenistan',0),(230,'TC','Turks and Caicos Islands',0),(231,'TV','Tuvalu',0),(232,'UG','Uganda',0),(233,'UA','Ukraine',0),(234,'AE','United Arab Emirates',0),(235,'GB','United Kingdom',1),(236,'US','United States',0),(237,'UM','United States Minor Outlying Islands',0),(238,'UY','Uruguay',0),(239,'UZ','Uzbekistan',0),(240,'VU','Vanuatu',0),(241,'VE','Venezuela, Bolivarian Republic of',0),(242,'VN','Viet Nam',0),(243,'VG','Virgin Islands, British',0),(244,'VI','Virgin Islands, U.S.',0),(245,'WF','Wallis and Futuna',0),(246,'EH','Western Sahara',0),(247,'YE','Yemen',0),(248,'ZM','Zambia',0),(249,'ZW','Zimbabwe',0);
/*!40000 ALTER TABLE `ag_countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_documents`
--

DROP TABLE IF EXISTS `ag_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `documents_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploaded_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_documents`
--

LOCK TABLES `ag_documents` WRITE;
/*!40000 ALTER TABLE `ag_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_emp_permission`
--

DROP TABLE IF EXISTS `ag_emp_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_emp_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_index` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'index',
  `emp_view` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'view',
  `kunden_permission` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `knotakte_permission` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kandidaten_permission` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `festanstellung_permission` text COLLATE utf8_unicode_ci,
  `projektanfrage_permission` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `task_permission` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_emp_permission`
--

LOCK TABLES `ag_emp_permission` WRITE;
/*!40000 ALTER TABLE `ag_emp_permission` DISABLE KEYS */;
INSERT INTO `ag_emp_permission` VALUES (1,'2','index','view',NULL,NULL,NULL,NULL,NULL,NULL,'2018-11-05 10:01:04','2018-11-05 10:01:04',1),(2,'5','index','view',NULL,NULL,NULL,NULL,NULL,NULL,'2018-11-17 11:54:18','2018-11-17 11:54:18',1);
/*!40000 ALTER TABLE `ag_emp_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_freelancer5`
--

DROP TABLE IF EXISTS `ag_freelancer5`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_freelancer5` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `account_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `touch_rule` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detailed_technologies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `freelancers` int(11) DEFAULT NULL,
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '''0''=> ''Kunden'' , ''1'' => ''Kunden Not in Database''',
  `Technology` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_of_client` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_freelancer5`
--

LOCK TABLES `ag_freelancer5` WRITE;
/*!40000 ALTER TABLE `ag_freelancer5` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_freelancer5` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_goal_setby_users`
--

DROP TABLE IF EXISTS `ag_goal_setby_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_goal_setby_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `set_by` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `client_activity` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_add` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `candidate_add` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oppo_add` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_goal_setby_users`
--

LOCK TABLES `ag_goal_setby_users` WRITE;
/*!40000 ALTER TABLE `ag_goal_setby_users` DISABLE KEYS */;
INSERT INTO `ag_goal_setby_users` VALUES (1,'1','33',NULL,'4',NULL,1),(2,'5','5','7','33','0',1),(3,'2','15','6','7','8',1);
/*!40000 ALTER TABLE `ag_goal_setby_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_kandidates`
--

DROP TABLE IF EXISTS `ag_kandidates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_kandidates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'Herr',
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attached_cv` text COLLATE utf8mb4_unicode_ci,
  `reference` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv_recieved` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manager_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_mobile` bigint(11) DEFAULT NULL,
  `info_field` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hourly_rate` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_definition` text COLLATE utf8mb4_unicode_ci,
  `availability` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availability_date` date DEFAULT NULL,
  `availability_per_week` text COLLATE utf8mb4_unicode_ci,
  `availability_per_week_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `travelling` text COLLATE utf8mb4_unicode_ci,
  `possible_extension` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_interview` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_area_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` text COLLATE utf8mb4_unicode_ci,
  `category_skills` text COLLATE utf8mb4_unicode_ci,
  `core_competences` text COLLATE utf8mb4_unicode_ci,
  `general_notes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `traveling_state` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `traveling_city` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` int(11) NOT NULL DEFAULT '0',
  `number` int(10) unsigned DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_confirmed` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `picture` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `optional_interview` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_experience_sector` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_experience_period` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_experience_company_name` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_experience_position` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_experience_position_description` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `number` (`number`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_kandidates`
--

LOCK TABLES `ag_kandidates` WRITE;
/*!40000 ALTER TABLE `ag_kandidates` DISABLE KEYS */;
INSERT INTO `ag_kandidates` VALUES (10,'','Microsoft .Net Entwickler Architekt KO','','generic1554304480@example.com','','','$2y$10$UbmmxhwNtSMdlLBpX0a/5eU6t93ypKJKne7XJczKGCmBFj5fVvVJa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6','1,2,4',NULL,'0000-00-00','4,5','','4,5','1','2 Monate','0',NULL,'','2,6,8,11,14,46','2,6,8,11,14,46','- Längerfristig möchte er als Projektmanager und Teamleiter arbeiten\r\n- Denkbar als Senior Entwickler anzufangen mit der Option auf Teamleitung\r\n- Microsoft .Net Technologien\r\n- Unternehmen sollte nicht zu klein sein\r\n- Möchte gerne in München bleiben\r\n- Gehaltsvorstellung 75.000 EUR',NULL,'2019-04-03 13:14:41','2019-09-23 14:54:37','','',0,1,1,1,'',NULL,'0','0','January 2019 - January 2020','Daimler AG','1','ABC'),(12,'','','','generic1554824422@example.com','','','$2y$10$Bz.1vrXGRB8yq9wH0YiwBOrt.vS7szf.s4jwb5Cgx9ms5Ws4Hmocm',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'3','3,6',NULL,'0000-00-00','5','','3,4,5','1','Drei Monate','0',NULL,'','70,74,79,86','','- 1st und 2nd Level Supporter (Office 2016, Windows Maschinen, Active Directory Admin, Hardware, Vernetzung)\r\n- Hat bereits Termin in Botschaft beantragt / Kündigungsfrist 4 Wochen\r\n- Offener und sympathischer Eindruck\r\n- Gut informiert und motiviert\r\n- Gehaltsvorstellung: 42.000 EUR\r\n- Basis Knowledge: C#, HTML, MS Office, Netzwerktechnik (TCP / IP), Linux\r\n- Generell offen bzgl. Einsatzort; bevorzugt Bayern oder Bawü\r\n- Fremdsprache Englisch: Sehr gut.',NULL,'2019-04-09 13:40:22','2019-04-09 13:40:22','','',1,2,1,1,'','','','','','','',''),(13,'','','','generic1554907912@example.com','','','$2y$10$SkQxU.VIK3.cYUljEumBzuQMtjOhj9pCxe.gc4GOw7vsTLx8vVmnu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'5','3,5',NULL,'0000-00-00','4','','2,3','1','Januar 2020','0',NULL,'','74','','- Seit einigen Jahren als Microsoft 365 Support / Berater im Einsatz\r\n- Ab Januar 2020 kann der Kandidat anfangen\r\n- Einsatzort: Deutschland, Österreich, Schweiz (außer Hamburg & Berlin',NULL,'2019-04-10 12:51:52','2019-04-10 12:51:52','','',0,3,1,1,'','','','','','','',''),(14,'','','','generic1555077988@example.com','','','$2y$10$MbgRxRo909vdeLvkZOz4uu3c6QJmWhIr7wr34HRhWSfMfXbQN8fCK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'3','1,2,13,14',NULL,'0000-00-00','5','','1,2,3,5','0',NULL,'0',NULL,'','2,6,19,135,46,59','','- Bis 2017 im PHP Umfeld gearbeitet mit JavaScript,\r\n- Aktuell im CRM Bereich; Frontend ASP.Net, JavaScript, HTML, CSS; Backend mit Microsoft .Net, C#; außerdem XAML, WPF, Winforms\r\n- ASP.Net Core programmiert er seit Februar 2019\r\n- Möchte demnächst gerne ein JavaScript Framework lernen\r\n- Es war schon immer sein Traum nach Deutschland zu gehen\r\n- Wichtig sind Ihm neue Technologien; Team ist Ihm wichtig\r\n- Gerne im .Net Umfeld; aber auch PHP kommt in Frage (vor allem mit Laravel)\r\n- Erfahrung im Bereich Architektur konnte er bereits sammeln (Solution Architekt)\r\n- Ca. 3 Jahre Berufserfahrung; anerkannter Hochschulabschluss\r\n- 42.000 EUR Gehaltsvorstellung (flexibel) \r\n- Frankfurt, Hamburg, Wien sind bevorzugt; Kleinstadt bzw. Großstadt beides in Ordnung; Unternehmensgröße spielt keine Größe\r\n- Node.JS interessiert Ihn sehr',NULL,'2019-04-12 12:06:28','2019-04-12 12:06:28','','Frankfurt am Main,Hamburg',0,4,1,1,'','','','','','','',''),(15,'','','','generic1556005266@example.com','','','$2y$10$6xLay89wrj.GBAK853jFsu2Juhdf69qNc7cVUoCqLffnmcGwtN9NK','cv/7kMrKJlh2H4QlV85E1NWYll6zAclMjlAm48ySrJR.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'3','4,9',NULL,'0000-00-00','4','','1,2,3','0',NULL,'0',NULL,'','76,79,85,86,92,130','130,86','IT professional with almost 10 years of practical experience in project management area, with strong technical and technology background.',NULL,'2019-04-23 05:41:07','2019-04-23 05:41:07','','',1,5,1,1,'','','','','','','',''),(16,'','','','generic1556281324@example.com','','','$2y$10$RTwZzylhxQCyYA3fz0Lq/OsGnhjb3jIpaSPkc5MV9KtmokK08aKOa','cv/4nFV99tX5Wds0PYs6TlAtqNxwnAFFkGCIMsZF0e5.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'3','3,4,6',NULL,'0000-00-00','4','','3','1','1 Monat','0',NULL,'','74,77,79,86,130','77,79,130','Systemintegrator mit mehr als 10 Jahren Erfahrung in der Verwaltung\r\nvon Projekten unterschiedlicher Größe und Komplexität in der Broadcast- und\r\nIT-Branche. // 1st und 2nd level support IT-Manager',NULL,'2019-04-26 10:22:05','2019-04-26 10:25:57','','',0,6,1,1,'','','','','','','',''),(17,'','','','generic1556523840@example.com','','','$2y$10$S6kVAQ2NpqqVU0jUcERcFeOM4o1JwA.ufWfIc2zKFzpXmDjLULqJK','cv/AbX1DSqVM1cN37dtLxsNTvO8iSQVg0KzlprkIsDu.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'4,5','3,6',NULL,'0000-00-00','4','','2,3','1','1 Monat','0',NULL,'','70,74,76,79,85,86','86,70','Mehr als 18 Jahre Erfahrung im IT-Bereich. Fachwissen und derzeitigen Aufgabenbereiche umfassen die folgenden Bereiche: Netzwerk- und Betriebssystemverwaltung, Client / Server-Support, WiFi, Hardware- und Softwareimplementierung, Benutzer-Support, Fehlerbehebung, Entwurf, Installation und Wartung von IT-Systemen. War auch als Systemingenieur und IT-Berater tätig.',NULL,'2019-04-29 05:44:00','2019-04-29 05:44:00','','',0,7,1,1,'','','','','','','',''),(18,'','','','generic1556627501@example.com','','','$2y$10$b2TpH4dQuJRaKBRbmjd9sOmwYkb2zi0mvTs54COGIqlJsb/18wjKO','cv/vmUoaFPlPEOspQzrJf6oJCjWpOVI8TR3fJJIa3rR.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'3','3,6',NULL,'0000-00-00','3','','3','1','1-3 Monate','0',NULL,'','70,71,79,85,86','70,79,86','Erfahrung in der IT seit 2003. Seit 7 Jahren im selben unternehmen als System Administrator. Netzwerk, Serververwaltung, Produktionsunterstützung - Diagnose etc. Physische und Virtuelle Server. War letztes Jahr bei der Cisco Akademie für fortbildungen. Router, Switches etc. 2nd level support.',NULL,'2019-04-30 10:31:42','2019-04-30 10:31:42','','',1,8,1,1,'','','','','','','',''),(19,'','','','generic1556628676@example.com','','','$2y$10$HAZpdW85tk6KIl9VGfH6me1bNg8Fw0s5ReKGqj8Al9gIRBxUT/hL.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'3','1',NULL,'0000-00-00','2,3','','1,3','0',NULL,'0',NULL,'','2,5,12,19,135,59,69','69,5,2','siehe Video',NULL,'2019-04-30 10:51:16','2019-04-30 10:51:16','','',1,9,1,1,'','','','','','','',''),(20,'','','','generic1556794812@example.com','','','$2y$10$xEylQglGv.TrOCWSjE0SWO/aPA18WhOfjptm5vBTn9dV1bH79eNUe','cv/RG8HbMOShRGTB0QzASkLuyElmv2Meysn2FtzsPCz.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'2,3','1',NULL,'0000-00-00','3','','3','0',NULL,'0',NULL,'','5,6,46,69,86','5,69','In den letzten Jahren habe ich uberwiegend als freier Webdesigner und Grafiker gearbeitet. Neben der Betreuung meiner eigenen Kunden, interessiert mich die Realisierung von herausfordemden Projekten im Team. Mein Schwerpunkt liegt in der Gestaltung und Umsetzung individueller Layouts und Websites. Dabei habe ich mich auf die Nutzung von WordPress als CMS spezialisiert.',NULL,'2019-05-02 09:00:13','2019-05-11 01:18:44','','',1,10,1,1,'','','','','','','',''),(21,'','','','generic1556805852@example.com','','','$2y$10$2h26j6N2aMlCAkplvhtGt.3Ok1fw5CbUuxJ4xr/PgmD9JsVXh6FxC','cv/1tHTgfw7x6NKdRddAYrOfP9SJkgoFRwOOJdQqKW9.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'5','4,6',NULL,'0000-00-00','3','','1,3','1','1-3 Monate','0',NULL,'','2,11,12,59,70,115,130','12,130,70','Projektmanager oder Administrator mit starkem technischen Hintergrund.',NULL,'2019-05-02 12:04:12','2019-05-02 12:04:12','','',1,11,1,1,'','','','','','','',''),(22,'','','','generic1556812172@example.com','','','$2y$10$BwB/Zk172bkhV9iuu8aTd.ifWR0Exze9zQDTKSsKQnxF1xJUqPBju',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'7','4,5',NULL,'0000-00-00','4','','1,3','0',NULL,'0',NULL,'','59,92,93,94,95,99,102,103,129,130','92,129,130','•	Agile and PMI based Service Delivery and Project Management |Cloud Computing Integration |Global Project Management Experience |10+ years’ experience of managing software implementations |15+ years of Customer/Client Facing experience |Telco Fraud Management implementation projects\r\n•	Strong stakeholder management and reporting skills | supplier/vendor management skills | supporting end user adoption of new technologies\r\n•	Strong experience with MS Project, Trello, JIRA, Primavera and other tools.',NULL,'2019-05-02 13:49:32','2019-05-21 08:57:24','','',0,12,0,1,'','','','','','','',''),(24,'','','','generic1557820552@example.com','','','$2y$10$kfO2eR3Hn6SvaokUib.Pu.N5rFhlSbqeTdQZh.AHzgB/0z/lT3Vky','cv/SmI1iRbsJUvKlOIHWH538kFRSg80sOsGrxT5B2Y1.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'6','1',NULL,'0000-00-00','4','','3','0',NULL,'0',NULL,'','135,21,22,23,45,106','22,23,21','kurze Erfahrung mit WPF SQL MVC JavaScript// Ich bin ein Softwareentwickler der sich für den Bereich Automotiv insbesondere Autonomes Fahren interessiert. Mit meiner Erfahrung im Embedded Software Development im C++ kann ich einen guten Beitrag in jede Firma mitbringen. Meine Erfahrung in Entwicklung von Unit und Integration Tests versichert die Qualität meiner Arbeit. Durch die Arbeit in einem Team von sieben Personen und Zusammenarbeit mit anderen Teams aus anderen Ländern, wie auch durch meine Arbeit in Schweden, beweise ich meine Teamfähigkeit und Sprachkenntnisse',NULL,'2019-05-14 05:55:52','2019-05-14 05:55:52','','',0,13,1,1,'','','','','','','',''),(25,'','','','generic1558077791@example.com','','','$2y$10$EERudSbQEQjzC2At2Cc4JuYwpQ8ckSCrt2XfxI3.LArGUlU7DrAnG','cv/1iJWYk9kC2WDIqMKgIV9oltI6ZuvGK06JxVPFto9.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'4','1',NULL,'0000-00-00','4','','2,3','1','30 Tagen','0',NULL,'','2,8,12,135','12,135',NULL,NULL,'2019-05-17 05:23:11','2019-06-27 07:42:21','','',0,15,1,1,'','','','','','','',''),(26,'','','','generic1560773709@example.com','','','$2y$10$uhqi2gVWoXc71hrNyAUtLuxUP6lfnE71uxyewwqWK22wdN2HpckH6','cv/VPbJ9dIoRRFfQvcHz92tTLYE4liLSyK5VX9hzkY7.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'3','1',NULL,'0000-00-00','4','5','2','1','1 Monat','0',NULL,'','5,10,12,69,117','10,12,117','Datenbankentwickler ( MS-SQL etc. ) mit 4 Jahren Erfahrung. Hat schon einmal ein C1 Deutsch Diplom bestanden jedoch sind diese Kenntnisse nicht mehr aktuell.',NULL,'2019-06-17 10:15:09','2019-06-17 10:15:28','','',1,14,1,1,'','','','','','','',''),(27,'','','','generic1560958292@example.com','','','$2y$10$9Rmwj.MsmiPGYI7sHLjXReBBTforGpyN5plEIDsGCzQtN8sQX1C..',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'4,5','1,6',NULL,'0000-00-00','4','','2,3','0',NULL,'0',NULL,'','70,72,77,80','','System Engineer (Top Skills: Citrix, Active Directory, Linux, Unix Other Skills: HP OM, LDAP, SCCM)\r\nPrimär mit Active Directory und Powershell. Möchte gerne im Bereich KI arbeiten. \r\nAktuell bei 2.500 EUR Netto; 60.000 - 65.000 EUR\r\nVerheiratet; 1 Kind \r\nOnkel wohnt in Kassel (dort war er als Kind)\r\nGerne auch in Österreich',NULL,'2019-06-19 13:31:32','2019-07-12 09:01:18','','Hamburg,Kassel',0,16,1,1,'','','','','','','',''),(28,'','','','generic1561123349@example.com','','','$2y$10$QaR8qUKUH3OgDS8GJ5fMuegaEY0ht9xXHhG5NY9.mXDtilQHiQ.TC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'3','1,11,13,14',NULL,'0000-00-00','5','5','2,3,4,5','0',NULL,'0',NULL,'','2,6,7,14,135,46','2,135,46','- Er hat ca. 5 Jahre Erfahrung im Bereich Microsoft .Net, C#, ASP.Net, JavaScript, jQuery\r\n- Fullstack-Entwickler\r\n- Gehaltsvorstellung: 41.000 - 52.000 EUR Brutto\r\n- Er lernt sehr schnell\r\n- Erfahrung im Banking',NULL,'2019-06-21 11:22:29','2019-06-21 11:22:29','','Berlin,Hamburg,Hannover',0,17,1,1,'','','','','','','',''),(29,'','','','generic1561715235@example.com','','','$2y$10$IosM54DoqMpW4YboLPgls.6Yc0iv7eXtZbK.wt.tG9IR8Q9Z9YWzG',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2','1',NULL,'0000-00-00','3','3','3,4,5','0',NULL,'0',NULL,'','6,45,46','45','- Intensivkurs (Ausbildung) Java Entwickler (Oktober 2018 bis April 2019)\r\n- Hat in Frankfurt Deutsch gelernt \r\n- Familie in Frankfurt; Location ist flexibel  \r\n- Top Technologien: Java, Spring, Hibernate (Aktuell lernt er CSS, JavaScript, Angular, Node.JS)',NULL,'2019-06-28 07:47:15','2019-06-28 07:47:15','','',0,18,1,1,'','','','','','','',''),(30,'','','','generic1561719873@example.com','','','$2y$10$RhnmQ9AHXAGitTDJx.fJPODGcBxhfc/taFWFd.2W5n20tZ10.qOeC',NULL,NULL,NULL,'19',NULL,NULL,NULL,'2,3','1,13,14',NULL,'0000-00-00','4,5','','3,4,5','1','Sofort; als Freelancer tätig','0',NULL,'','5,6,46,59','','- Backend und Frontend Entwickler \r\n- Bis 2000 in Stuttgart gelebt \r\n- Laravel, CSS, jQuery, Bootstrap, JSON\r\n- 42.000 EUR Gehaltsvorstellung\r\n- Sehr großer FC Bayern Fan (Präferenz München); generell flexibel \r\n- Möchte im Bereich Laravel, PHP bleiben (Entwicklung); großes Interesse an React und Vue (JavaScript Frameworks) \r\n- Ca. 6 Jahre Erfahrung im Softwarebereich (.Net 1 Jahre; 5 Jahre PHP, Laravel)',NULL,'2019-06-28 09:04:33','2019-06-28 09:13:42','Bayern','München',0,19,1,1,'','','','','','','',''),(34,'','','','generic1562059456@example.com','','','$2y$10$tajHkoyCPKDXX316lTFDMet6YQR1zJ7SEA8u6VVxcwPx8mUTS8LIi','cv/FGYdhXXtI96yOntLuLbpgKbA8n2NaxohFx5o1viV.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'3','3,6',NULL,'0000-00-00','5','5','3','1','1','0',NULL,'','74,77,80,86','74','Monitoring systems of E-Banking. Technical support for Corporate \r\n                   And retail  users. Relation with \r\n                  Suppliers and vendors.      \r\n                Administration of Corporate, retail and web credits users.\r\n                Writing procedures\r\n               Help desk Support for digital channels\r\n               ATM Network (installation and diagnostics)\r\n               Making certificates for corporate users',NULL,'2019-07-02 07:24:16','2019-07-02 07:24:16','','',0,23,1,1,'','','','','','','',''),(35,'','','','generic1562061117@example.com','','','$2y$10$ynnVQClJko6YhFZfTFrpp.GKeOmRIRYlZr7RNUAzEBrpEgt085yRq',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'4','1,2,13,14',NULL,'0000-00-00','5','','3,4,5','0',NULL,'0',NULL,'','5,6,46,54,59','','- Fullstack Entwickler; macht auch Architektur\r\n- PHP Laravel, Web Development, mySQL, HTML, CSS, JavaScript (jQuery, React)\r\n- Persönliche Projekte: Python, SpringBoot, KI motiviert Ihn \r\n- 7 Jahre Erfahrung mit Software Entwicklung \r\n- Gehaltsvorstellung ca. 50.000 EUR\r\n- Ist verheiratet\r\n- Hat in Start-Ups gearbeitet; war immer Lead --> möchte in einer Firma sein wo er auch von anderen Leuten lernen kann\r\n- Müssen Visum beantragen; Wartezeit bis 2020 (1 Jahr)',NULL,'2019-07-02 07:51:57','2019-07-02 08:26:55','','',0,24,1,1,'','','','','','','',''),(36,'','Softwareentwickler C++, Python, Linux (Java) CH','','generic1562155401@example.com','','','$2y$10$iZRa7JXkiiYOI1oZS1.Ihu9se8cBEjrECqUkjD0WQvhOUq8mkmX6a',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'3,4','1,10',NULL,'0000-00-00','3,4','','2,3,4,5','0',NULL,'0',NULL,'','22,27,45,60,77','22,60,77','- Stark mit Linux, C++, Java, Python Softwareentwickler (Junior); ein wenig mit Matlab \r\n- Möchte sein Deutsch verbessern; deswegen möchte er nach Deutschland kommen \r\n- Mehr introvertiert; eher schüchtern und verschlossen am Anfang \r\n- Bevorzugt kleiner Städte; größere Städte überfüllt  \r\n- 45.000 bis 55.000 EUR wären in Ordnung',NULL,'2019-07-03 10:03:21','2019-07-17 10:46:50','','',0,25,1,1,'','','','','','','',''),(37,'','AG','','generic1562865123@example.com','','','$2y$10$MJDVglWV4LjCHy3LSGfTG.bhZU99acWruKlQcCK8U.1CnijwQA9NO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'5','1,11,13',NULL,'0000-00-00','4','','5','1','30 Tage','0',NULL,'','5,6,14,133,46','5,6,133,46,14','- Hat Deutsch über Fernsehen gelernt\r\n- Hat viele Freunde und bekannte in Berlin und Hamburg , deswegen möchte er gerne dort Arbeiten\r\n- Top Technologien: Html, CSS3, jQuery, JavaScript, Typescript, AngularJS, Vue.js, PHP, UX, UI Design\r\n- 6 Jahre Erfahrung als Front-End Entwickler',NULL,'2019-07-11 15:12:03','2019-07-11 15:13:02','','Berlin,Hamburg',0,26,1,1,'','','','','','','',''),(38,'','EH','','generic1562866815@example.com','','','$2y$10$koxEb6L6GNQP.fldg2MPReA0qxGzEy3E1MI3Qb8TXeruOG1Bgr1vK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'5','3,5,6',NULL,'0000-00-00','4','','3,5','1','30Tage','0',NULL,'','2,12,135,45,79','2,12,135,45,79','- Hat 8 Jahren in Deutschland (Schorndorf) als Kind gelebt \r\n- Möchte gerne wieder nach Deutschland kommen, aufgrund der besseren Perspektive und Entwicklungsmöglichkeiten\r\n- Top Technologien: SQL, Asp.Net, Java, SSAS, Network, C#',NULL,'2019-07-11 15:40:15','2019-07-11 15:40:51','','München,Stuttgart',0,27,1,1,'','','','','','','',''),(39,'','ML - Java PHP Junior','','generic1562923299@example.com','','','$2y$10$XipfQ7Z1sKIk2kq6W1c/yeoE67dyXYtK7EfLYBsqYHtNBs.VueIuO',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2,3','1,6,11,13,14',NULL,'0000-00-00','5,6','','3,4,5','0',NULL,'0',NULL,'','45,54,59,74,80','','- Ist in Deutschland aufgewachsen bis zur 6. Klasse (Augsburg)\r\n- Mit seinen Kollegen in Österreich kommuniziert er auf Deutsch (trotzdem viel auf Englisch)\r\n- Verheiratet mit Kind \r\n- Minimum 50qm für eine Wohnung (Vorschlag von uns; aktuell wohnt er auf 50qm); zahlt 150 EUR EUR miete \r\n- Als IT-Admin auch entwickelt - 3 Applikationen (Rechnungsgenerierung, SMS Benachrichtigung bei der Post) ein paar Monate; 6 Jahre als Admin gearbeitet als einziger Admin (120 Benutzer). Der alte Chef wollte nicht, dass er als Entwickler arbeitet, dar er der einzige Admin war. Als der Chef gegangen ist zum IT Manager aufgestiegen. Jetzt ein mix aus Customer Support (er hat 4 Leute die die Anrufe annehmen), Entwickler (1 - 2 Stunden pro Tag), Admin\r\n- April 2018 als IT Manager aufgestiegen\r\n- Entwicklung kennt die Basis; weiß wie alles funktioniert - er muss aber noch viel lernen. Mit folgenden Technologien: Netbeans, Eclipse, Bootstrap, JavaScript (auch ein wenig). Er macht ein CMS als FL für eine Deutsche Firma. \r\n- CMS: Am anfang hat er mit Joomla gearbeitet und mit Joomla Webseiten entwickelt. Im Unternehmen benutzen Sie Wordpress \r\n- Support: 1st Level Support bis Anfang 2018; Admin und Support für Office Excel und Access, Domain, Server, Call-Center',NULL,'2019-07-12 07:21:39','2019-07-12 07:23:22','','Augsburg,München,Stuttgart',0,28,1,1,'','','','','','','',''),(40,'','B.O.','','generic1563190818@example.com','','','$2y$10$gr8In.5ALJrrrzIDLrkZEeLKJKHQC8XpvmGs7g/kc9XvjGCHrFUzq',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'3,8','1',NULL,'0000-00-00','5','','1,2,3','0',NULL,'0',NULL,'','5,10,12,135,21,22,45,77,86','10,22,45','3 Mögliche Positionen bzw. Rollen: Java Expert, C++ hardwarenahe Entwicklung, Oracle Black Belt Expert - DB1\r\n\r\nFL - 60EUR/h Perm - 90k Jahresgehalt.\r\n\r\nLegend: 1=very good, 2=good, 3=moderate; \r\n\r\nSQL and PL/SQL (1), C and C++ (2), Java (1), JavaScript (2), UNIX (2), Linux (1), Informatica Powercenter (2), Erwin Data Modeler (2), XML (2), MS SQL Server (2), Oracle 9i, 10g and 11gR2 (1), Oracle Streams replication (2), NettyServer (2), CVS (2), SVN (2), Eclipse IDE (2), CruiseControl and ANT tasks (2), Rational Rose (2);',NULL,'2019-07-15 09:40:18','2019-07-15 09:41:11','','',0,29,1,1,'','','','','','','',''),(41,'','Z.Z.','','generic1563191539@example.com','','','$2y$10$DWKMVvmNLqUFRlswlTH.Ee4ggt5po.XNBr1DIXUxAhvdkkAMzb7su','cv/Ke6b0mFZ40XOkqEhpevwJY3WgMNZeQxUvA51lHr8.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'4','1',NULL,'0000-00-00','5','5','2,3','0',NULL,'0',NULL,'','5,133,45,46,54','46,54','Fullstack \r\n\r\n75% Vor Ort 25% remote\r\n\r\nElektroingeneur',NULL,'2019-07-15 09:52:20','2019-07-23 10:20:14','','',0,30,0,1,'','','','','','','',''),(42,'','FVM','','generic1563355864@example.com','','','$2y$10$LO6pwPh.6CJpoov6X46MeOXwgx98byPx/VjpdgvLPYoX7sj0svKKi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'4,5','1,14',NULL,'0000-00-00','6','','3,4,5','1','30 Tage','0',NULL,'','137,46,136,139,138','46,136','- Bis er 10 war, war er in Deutschland. Sucht nicht aktiv aber wenn etwas spannendes kommt wäre er interessiert. Er kann einen deutschen Pass beantragen (braucht ca. 6 bis 8 Wochen um den Umzug zu organisieren). \r\n- Node.Js und JavaScript; bevorzugt Backend\r\n- Docker, Kubernetes, Serverseitig mag er sehr gerne \r\n- Derzeit arbeitet er im Banking mit Payment Systemen\r\n- Team: Er mag eher kleinere Firmen; Start-Ups \r\n- Standort: Flexibel; kleine Stadt (bis 20.000 auch aber müsste sich Gedanken machen) und große Stadt beides in Ordnung.\r\n- Freiburg wäre richtig cool; kennt sich sehr gut aus (war schon einige Male in Freiburg seitdem er in in Brasilien war). \r\n- Technologien (absoluter Crack (8/10): JavaScript, Node.JS, Docker, Kubernetes, PostgresSQL, Vue.JS. Macht auch noch PHP (Freelancing) und Java (5/10)\r\n- Privat: Macht gerne Sport, Fitness\r\n- Technologien in der Zukunft: DevOps --> SRE (Server Realiability Engineer) \r\n- Gehalt: Um die 3.500 EUR Netto wären minimum',NULL,'2019-07-17 07:31:05','2019-07-17 07:49:09','','',0,31,1,1,'','','','','','','',''),(43,'','TC - Nur Aerospace / Dronen Industrie','','generic1563983759@example.com','','','$2y$10$4zH3IebboN/l9RhN1NYrDeTygVGvYFJ2REfaO5OAFEaYL4DJb5/ki',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'4,5','1,14',NULL,'0000-00-00','4,5','','3,4,5','1','4 Wochen Kündigunsfrist','0',NULL,'','135,21,22','21,22','- In Deutschland aufgewachsen; sehr gutes Deutsch-Niveau (B2-C1)\r\n- Möchte weiterhin nur in der Dronen und Aerospace Bereich arbeiten\r\n- Seit 2005 UAV / Dronenentwicklung als C / C++ und C# Entwickler. \r\n- Aktuell: Hardwareentwickler (90% designing PCB mit Altium Designer) mit Embedded C. Very familiar with data structures, PDI control loops, easily write real time controls. Desktop software development: Not as good as writing Embedded C software. \r\n- 60.000 - 65.000 EUR; 3.5 bis 4.5K Netto\r\n- Der Kandidat ist verheiratet\r\n- Kann als Hardware- und oder Softwareentwickler arbeiten (PCB, C, C++)',NULL,'2019-07-24 13:55:59','2019-07-24 13:57:41','','',0,32,1,1,'','','','','','','',''),(44,'','SÜ','','generic1565103032@example.com','','','$2y$10$1UvbuzGlp6Z1BFVacqj3lOpzi.e3rurwyRy51Ym8306Z98BBjsTjG',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'4','1',NULL,'0000-00-00','4','4','3','1','ab September - Oktober verfügbar','0',NULL,'','42,45,51,54,65','45','Spring Framework; Git, IBM BD2',NULL,'2019-08-06 12:50:32','2019-08-06 12:50:32','','',0,33,1,1,'','','','','','','',''),(45,'','TS','','generic1565103308@example.com','','','$2y$10$4L0JgVO/3jIGlluGmiOZVuW.ZuouRzw2ekzKHQsgpsP4AXEFTJM02',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6','1,5',NULL,'0000-00-00','2','5','1,3','0',NULL,'0',NULL,'','87','87','Process Integration (PI/PO) Interfaces (7.1,7.3, 7.4 and 7.5); Basic Python and basic knowledge of Java. Berater für PI/PO jedoch sehr Technisch da 10 Jahre ABAP Entwicklung.',NULL,'2019-08-06 12:55:08','2019-08-06 12:55:28','','',0,34,1,1,'','','','','','','','');
/*!40000 ALTER TABLE `ag_kandidates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_list55`
--

DROP TABLE IF EXISTS `ag_list55`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_list55` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `probability` int(11) NOT NULL,
  `hotness` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailed_coding` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `client_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_number` bigint(20) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `technology` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_field` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opportunity_type` int(11) DEFAULT '0',
  `opportunity_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_list55`
--

LOCK TABLES `ag_list55` WRITE;
/*!40000 ALTER TABLE `ag_list55` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_list55` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_list_view`
--

DROP TABLE IF EXISTS `ag_list_view`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_list_view` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `account_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `touch_rule` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detailed_technologies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `freelancers` int(11) DEFAULT NULL,
  `account_status` int(11) NOT NULL DEFAULT '0' COMMENT '''0''=> ''Kunden'' , ''1'' => ''Kunden Not in Database''',
  `Technology` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_of_client` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_list_view`
--

LOCK TABLES `ag_list_view` WRITE;
/*!40000 ALTER TABLE `ag_list_view` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_list_view` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_migrations`
--

DROP TABLE IF EXISTS `ag_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_migrations`
--

LOCK TABLES `ag_migrations` WRITE;
/*!40000 ALTER TABLE `ag_migrations` DISABLE KEYS */;
INSERT INTO `ag_migrations` VALUES (1,'2018_10_31_110126_UsersAddPrimaryKey',1),(2,'2018_10_31_110126_CompetencesAddPrimaryKey',2),(3,'2018_10_31_110126_EmpPermissionAddPrimaryKey',2);
/*!40000 ALTER TABLE `ag_migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_msperm3`
--

DROP TABLE IF EXISTS `ag_msperm3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_msperm3` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `probability` int(11) NOT NULL,
  `hotness` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailed_coding` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `client_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_number` bigint(20) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `technology` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_field` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opportunity_type` int(11) DEFAULT '0',
  `opportunity_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_msperm3`
--

LOCK TABLES `ag_msperm3` WRITE;
/*!40000 ALTER TABLE `ag_msperm3` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_msperm3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_opportunity`
--

DROP TABLE IF EXISTS `ag_opportunity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_opportunity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_id` int(11) NOT NULL,
  `opportunity_type` int(11) DEFAULT '0',
  `attached_doc` text COLLATE utf8mb4_unicode_ci,
  `attached_voice_memo` text COLLATE utf8mb4_unicode_ci,
  `close_date` date DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `next_step` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forecast` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `probability` int(11) NOT NULL,
  `repeat_order` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>No,1=>Yes',
  `report` text COLLATE utf8mb4_unicode_ci,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hotness` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_number` bigint(20) NOT NULL,
  `technology` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `process` text COLLATE utf8mb4_unicode_ci,
  `profile_sent` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_field` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `opportunity_line` text COLLATE utf8mb4_unicode_ci,
  `opportunity_status` int(11) NOT NULL DEFAULT '0',
  `detailed_coding` text COLLATE utf8mb4_unicode_ci,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_opportunity`
--

LOCK TABLES `ag_opportunity` WRITE;
/*!40000 ALTER TABLE `ag_opportunity` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_opportunity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_opportunity_list`
--

DROP TABLE IF EXISTS `ag_opportunity_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_opportunity_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `oppo_technology` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detailed_coding` text COLLATE utf8_unicode_ci,
  `list_type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opportunity_status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hotness_client` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `added_by` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_opportunity_list`
--

LOCK TABLES `ag_opportunity_list` WRITE;
/*!40000 ALTER TABLE `ag_opportunity_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_opportunity_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_password_resets`
--

DROP TABLE IF EXISTS `ag_password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_password_resets`
--

LOCK TABLES `ag_password_resets` WRITE;
/*!40000 ALTER TABLE `ag_password_resets` DISABLE KEYS */;
INSERT INTO `ag_password_resets` VALUES ('jan.guhl@summitize.com','$2y$10$oyCT1BwxUn4XH2D8BxTsW.fMgnocfNBAOoc0uKDgVR8eXE9MoCZ3y','2018-11-29 11:34:28'),('work.a.andrey@gmail.com','$2y$10$988nUxehQsOOqq117sQ8Pu6giiznodb.jTI1tePLRSA0JGZ3Lk1me','2018-11-30 05:48:48');
/*!40000 ALTER TABLE `ag_password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_permmshotness5inactice2`
--

DROP TABLE IF EXISTS `ag_permmshotness5inactice2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_permmshotness5inactice2` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `probability` int(11) NOT NULL,
  `hotness` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailed_coding` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `client_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_number` bigint(20) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `technology` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_field` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opportunity_type` int(11) DEFAULT '0',
  `opportunity_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_permmshotness5inactice2`
--

LOCK TABLES `ag_permmshotness5inactice2` WRITE;
/*!40000 ALTER TABLE `ag_permmshotness5inactice2` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_permmshotness5inactice2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_php`
--

DROP TABLE IF EXISTS `ag_php`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_php` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `probability` int(11) NOT NULL,
  `hotness` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailed_coding` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `client_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_number` bigint(20) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `technology` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_field` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opportunity_type` int(11) DEFAULT '0',
  `opportunity_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_php`
--

LOCK TABLES `ag_php` WRITE;
/*!40000 ALTER TABLE `ag_php` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_php` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_secondCost`
--

DROP TABLE IF EXISTS `ag_secondCost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_secondCost` (
  `users_id` int(10) unsigned NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Herr',
  `first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_doc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_profile` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_role` enum('0','1','2','') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '''0''=> ''freelancers'' , ''1'' => ''Admin'',''2''=>Employee',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `postal_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skill_id` int(10) unsigned DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_secondCost`
--

LOCK TABLES `ag_secondCost` WRITE;
/*!40000 ALTER TABLE `ag_secondCost` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_secondCost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_skills`
--

DROP TABLE IF EXISTS `ag_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_skills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(9) NOT NULL,
  `attached_cv` text COLLATE utf8mb4_unicode_ci,
  `cv_recieved` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0=>No,1=>Yes',
  `reference` int(11) DEFAULT NULL,
  `client_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manager_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_mobile` bigint(11) DEFAULT NULL,
  `info_field` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hourly_rate` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hourly_rate_other_input` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_definition` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freelancer_roles_other_input` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availability` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availability_date` date NOT NULL,
  `availability_per_week` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travelling` text COLLATE utf8mb4_unicode_ci,
  `possible_extension` int(11) DEFAULT NULL,
  `extension_text` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_interview` int(11) DEFAULT NULL,
  `comment_area_text` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_skills` text COLLATE utf8mb4_unicode_ci,
  `competences_skill_category_1` text COLLATE utf8mb4_unicode_ci,
  `competences_skill_category_2` text COLLATE utf8mb4_unicode_ci,
  `competences_skill_category_3` text COLLATE utf8mb4_unicode_ci,
  `competences_skill_category_4` text COLLATE utf8mb4_unicode_ci,
  `competences_skill_category_5` text COLLATE utf8mb4_unicode_ci,
  `competences_skill_category_6` text COLLATE utf8mb4_unicode_ci,
  `competences_skill_category_7` text COLLATE utf8mb4_unicode_ci,
  `competences_skill_category_8` text COLLATE utf8mb4_unicode_ci,
  `core_competences` text COLLATE utf8mb4_unicode_ci,
  `general_notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_skills`
--

LOCK TABLES `ag_skills` WRITE;
/*!40000 ALTER TABLE `ag_skills` DISABLE KEYS */;
INSERT INTO `ag_skills` VALUES (1,4,NULL,'0',0,NULL,NULL,NULL,NULL,'1,2',NULL,'1,2,13',NULL,'1','1970-01-01','','',0,NULL,0,NULL,'','1,2,3,4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1,2,3,4',NULL,'2018-11-08 12:36:01','2018-11-08 12:36:01'),(2,3,NULL,'0',0,NULL,NULL,NULL,NULL,'1,2',NULL,'1,2,13',NULL,'1','2018-12-10','','',0,NULL,0,NULL,'','1,2,3,4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1,2,3,4',NULL,'2018-11-08 12:36:01','2018-11-08 12:36:01');
/*!40000 ALTER TABLE `ag_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_task`
--

DROP TABLE IF EXISTS `ag_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_task` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `task_date` date NOT NULL,
  `account_id` int(11) NOT NULL,
  `priority` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_owner` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_task`
--

LOCK TABLES `ag_task` WRITE;
/*!40000 ALTER TABLE `ag_task` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_test`
--

DROP TABLE IF EXISTS `ag_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_test` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `probability` int(11) NOT NULL,
  `hotness` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detailed_coding` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `client_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_number` bigint(20) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '1',
  `technology` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_field` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opportunity_type` int(11) DEFAULT '0',
  `opportunity_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_test`
--

LOCK TABLES `ag_test` WRITE;
/*!40000 ALTER TABLE `ag_test` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_user_todolist`
--

DROP TABLE IF EXISTS `ag_user_todolist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_user_todolist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comments` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_user_todolist`
--

LOCK TABLES `ag_user_todolist` WRITE;
/*!40000 ALTER TABLE `ag_user_todolist` DISABLE KEYS */;
INSERT INTO `ag_user_todolist` VALUES (1,7,NULL);
/*!40000 ALTER TABLE `ag_user_todolist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_users`
--

DROP TABLE IF EXISTS `ag_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'Herr',
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_doc` text COLLATE utf8mb4_unicode_ci,
  `user_profile` text COLLATE utf8mb4_unicode_ci,
  `user_role` enum('0','1','2','') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '''0''=> ''freelancers'' , ''1'' => ''Admin'',''2''=>Employee',
  `added_by` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `postal_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT '1',
  `number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `number_index` (`number`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_users`
--

LOCK TABLES `ag_users` WRITE;
/*!40000 ALTER TABLE `ag_users` DISABLE KEYS */;
INSERT INTO `ag_users` VALUES (1,'Herr','SEBASTIAN','','argon','admin@argon-strategy.com','$2y$10$.xz6z6csp2zpikkuJhYMzuZH4agyGLI6QwcOLzDUzFRUe8KPIEzxa',NULL,NULL,NULL,NULL,'1',1,'aW8qzz2hT8o6WMHKd0hP9IrT2zYimJGR3TcyQTp0xthnvucsU9RsipCiemcQ','2018-11-05 09:31:35','2019-04-08 07:21:56',NULL,1,1),(2,'Herr','Andrey','','Artyushenko','work.a.andrey@gmail.com','$2y$10$7Xmmpg7MYShmpdrV8ojRv.oSbE/AU0EIW01T/Jz0MsgXIR6rBIfFm',NULL,NULL,NULL,NULL,'1',1,'YHMYVIYCA5J9q3HaTii5UTnq10uY8iljQl6Yhvk4MYLsoeIbjpU18nXsRC94','2018-11-05 09:31:35','2018-11-05 09:33:56',NULL,1,2),(3,'Herr','Andrey','V','Artyushenko','rzd03509@iencm.com','$2y$10$WHeRnHQIDG7hnoh.EwK61uWowJ3tZqQFZT8IQ3D8MXsNmdSLP65V6',NULL,NULL,NULL,NULL,'0',1,'naTq7OvXXGUkib5V6rhSBB9bHzFLa88JvWmA8WT8ZsCHWCYCYdkZdxVDwq0V','2018-11-05 09:36:13','2018-11-05 09:36:13',NULL,1,3),(4,'Herr','Mario',NULL,'Honegg','mariohonegg@gmail.com','$2y$10$8dEzfRksh5e/XPZgXUf9/.J447u.AmAxJULSIbh6le1gGjCcd/WL.','07127','07127',NULL,NULL,'0',1,NULL,'2018-11-08 12:36:01','2018-11-08 12:36:01','12345',1,4),(5,'Herr','John',NULL,'Doe','john.doe@email.com','$2y$10$3WDBaUL8CptC7PMzEd6MKeXDtYnIx.QEXQ7i48IkWw3sHVTRP6m0i',NULL,NULL,NULL,NULL,'2',1,NULL,NULL,NULL,NULL,1,5),(6,'Herr','Jan','S.','Guhl','jan.guhl@summitize.com','$2y$10$t0fFsaDfj91wXNo/HQ4LHeooTyJLBibVEC0YrpIrXaFrsyK7b3u8K',NULL,NULL,NULL,NULL,'0',1,NULL,'2018-11-29 11:32:29','2018-11-29 11:32:29',NULL,1,6),(7,'Herr','John','','Doe','kunden@argonstrategy.com','$2y$10$zHHCEO./T3gpxi1hhxvhNeDZ4DFGGY5OChFOMeKWhjHY6MkQ8/f7m',NULL,NULL,NULL,NULL,'0',1,'HLdCgl0B75FCO1xPz7p6busW8aGWxqtOLfiOgoHXDGcWa4Iaeru5IR8MYQGf','2018-11-05 09:31:35','2019-03-19 03:53:23',NULL,1,7),(8,'Herr','BgtLYbnpPJNy','yMCHSFiLvzgr','ixNneMZIzOFh','hopurringpo@gmail.com','$2y$10$/U.YyJMPysTEFZVUun.e/.nPtGO9UC.PUHCNpNkvm/KickHNXZIZ6',NULL,NULL,NULL,NULL,'0',1,NULL,'2019-08-24 15:20:15','2019-08-24 15:20:15',NULL,1,NULL),(9,'Herr','HxysPmXMSvFE','HYagtUVmRNDz','QkeZzhqObvFK','dinahfletcher3133@gmail.com','$2y$10$Eur81ocuxtCBXT8Io6apMeO3gWMOYeKn2W3r08r63ePSQkldCgg..',NULL,NULL,NULL,NULL,'0',1,NULL,'2019-08-28 05:32:42','2019-08-28 05:32:42',NULL,1,NULL);
/*!40000 ALTER TABLE `ag_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ag_users_list`
--

DROP TABLE IF EXISTS `ag_users_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ag_users_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_name` varchar(90) NOT NULL,
  `added_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ag_users_list`
--

LOCK TABLES `ag_users_list` WRITE;
/*!40000 ALTER TABLE `ag_users_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `ag_users_list` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-24 13:17:20
