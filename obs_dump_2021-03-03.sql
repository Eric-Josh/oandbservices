-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: localhost    Database: observices
-- ------------------------------------------------------
-- Server version	5.7.32-0ubuntu0.18.04.1

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
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `general_merchandise`
--

DROP TABLE IF EXISTS `general_merchandise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `general_merchandise` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `merchandise_id` bigint(20) unsigned NOT NULL,
  `phone` bigint(20) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `time_frame` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `assigned_to` bigint(20) unsigned DEFAULT NULL,
  `location` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `general_merchandise_user_id_foreign` (`user_id`),
  KEY `general_merchandise_merchandise_id_foreign` (`merchandise_id`),
  CONSTRAINT `general_merchandise_merchandise_id_foreign` FOREIGN KEY (`merchandise_id`) REFERENCES `merchandise` (`id`),
  CONSTRAINT `general_merchandise_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `general_merchandise`
--

LOCK TABLES `general_merchandise` WRITE;
/*!40000 ALTER TABLE `general_merchandise` DISABLE KEYS */;
INSERT INTO `general_merchandise` VALUES (1,2,7501763143,'I would like to barb my hair at home so i need your service.',100,'Within 2 days','Completed',3,NULL,'17B street off greanade road birdmingam','2021-02-18 13:16:54','2021-02-25 21:47:57',NULL),(2,5,7501763143,'I need a make up artiste for my birthday party on tuesday.',100,'Within 2 days','Pending',3,NULL,'17B street off greanade road birdmingam','2021-02-18 14:12:15','2021-03-02 23:50:07',NULL),(3,7,7501763143,'I need an event planner for a show coming in my street this weekend.',500,'Within 2 weeks','Pending',3,NULL,'6B crown street off birmigham road','2021-02-20 21:49:51','2021-03-02 23:57:12',NULL);
/*!40000 ALTER TABLE `general_merchandise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_types`
--

DROP TABLE IF EXISTS `job_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_types`
--

LOCK TABLES `job_types` WRITE;
/*!40000 ALTER TABLE `job_types` DISABLE KEYS */;
INSERT INTO `job_types` VALUES (1,'Movers',NULL,'2021-02-05 11:27:33',NULL),(2,'Labourer',NULL,NULL,NULL),(3,'Lawnmower',NULL,NULL,NULL),(4,'Capenter',NULL,NULL,NULL),(5,'Painter',NULL,NULL,NULL),(6,'Plumber',NULL,NULL,NULL),(7,'Cleaner',NULL,NULL,NULL),(8,'Polisher','2021-02-05 11:08:29','2021-02-05 11:33:41','2021-02-05 12:33:41'),(9,'Electrician','2021-03-01 17:04:38','2021-03-01 17:04:38',NULL);
/*!40000 ALTER TABLE `job_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL,
  `job_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` bigint(12) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `time_frame` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `assigned_to` bigint(20) unsigned DEFAULT NULL,
  `photo` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_id` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_assigned` datetime DEFAULT NULL,
  `date_completed` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_user_id_foreign` (`user_id`),
  KEY `jobs_job_id_foreign` (`job_id`),
  CONSTRAINT `jobs_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `job_types` (`id`),
  CONSTRAINT `jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,3,'Lawn Mower Job',7065466935,'Please i need a lawnmower to help me clear my grass',30,'Within 24 hours','Pending',3,4,'281135564.png','Parkinson','206616995220210224','2021-02-24 21:02:19',NULL,'2021-02-24 20:42:28','2021-03-02 23:22:45',NULL),(2,6,'Plumbing Job',9090314098,'I have a broken pipe i\'d like to fix, kindly assist.',50,'Within 24 hours','Pending',6,4,'876389077.png','Surulere Lagos','78787691120210225','2021-02-25 20:02:32',NULL,'2021-02-25 19:57:40','2021-03-02 23:39:36',NULL),(3,9,'Electric work',7501763143,'I need a electrician asap kindly attend to it urgently',20,'Ugently','Completed',3,4,'1926184633.png','Lekki Phase 1','166010858920210302','2021-03-02 17:03:10','2021-03-03 00:03:58','2021-03-02 15:56:57','2021-03-02 23:25:58',NULL);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `merchandise`
--

DROP TABLE IF EXISTS `merchandise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `merchandise` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `merchandise` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `merchandise`
--

LOCK TABLES `merchandise` WRITE;
/*!40000 ALTER TABLE `merchandise` DISABLE KEYS */;
INSERT INTO `merchandise` VALUES (1,'Barber','2021-02-18 10:53:01','2021-02-18 10:53:55',NULL),(2,'Hairdresser','2021-02-18 10:54:44','2021-02-18 10:54:44',NULL),(3,'Photographer','2021-02-18 10:54:55','2021-02-18 10:54:55',NULL),(4,'Catering','2021-02-18 10:55:07','2021-02-18 10:55:07',NULL),(5,'Makeup Artist','2021-02-18 10:55:24','2021-02-18 10:55:24',NULL),(6,'Decorator','2021-02-18 10:58:16','2021-02-18 10:58:16',NULL),(7,'Event Planner','2021-02-18 10:58:31','2021-02-18 10:58:31',NULL);
/*!40000 ALTER TABLE `merchandise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2014_10_12_200000_add_two_factor_columns_to_users_table',2),(5,'2019_12_14_000001_create_personal_access_tokens_table',2),(6,'2021_02_02_194150_create_sessions_table',2),(7,'2021_02_04_220451_create_job_types_table',3),(8,'2021_02_04_222649_create_jobs_table',4),(9,'2021_02_18_100113_create_merchandise',5),(10,'2021_02_18_092602_create_general_merchandise',6),(11,'2021_02_28_003154_create_reviews_table',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('oandbservices@gmail.com','$2y$10$zY0t0d3TATME1Bofn8PUQeKjtOtlZmkimTfRINQ1YE1Ne1wgYWiOO','2021-02-02 20:12:21'),('psource112@gmail.com','$2y$10$qzUQryZtP0wLR09e0Uphf.FDmXgZV.P74Wq/ZGnlGfq7U3agR3YgO','2021-02-15 09:13:17'),('ericalias14@yahoo.com','$2y$10$h6DAFnfVzSNmbmoQqrhxIeZTKUs4OVRC31jP8/9kvq2vWfrmavOl2','2021-02-15 17:47:45'),('oandbservice@gmail.com','$2y$10$ll2vE9td3ofB1dnkIA0OeOqUnfUYPVdX9lASsVOIYlv1jwilSPnlO','2021-02-16 17:46:07');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `stars` int(11) NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,4,'I had a good experience while making request on the platform and i must say i really enjoyed it. keep up the good work ! (:',15,'2021-02-28 01:35:39','2021-02-28 01:35:39'),(2,3,'This app is nice i look forward to it having a greater features integrated in it. Weldone to the developer',3,'2021-02-28 01:45:23','2021-02-28 01:45:23'),(3,2,'Good one bro',4,'2021-02-28 01:50:12','2021-02-28 01:50:12'),(4,5,'Awesome Start',4,'2021-02-28 01:51:52','2021-02-28 01:51:52'),(5,1,'Too bad for me',15,'2021-02-28 02:32:26','2021-02-28 02:32:26'),(6,2,'Good try bro just keep it up',4,'2021-02-28 02:46:06','2021-02-28 02:46:06'),(7,5,'Guy wey sabi, you dey try abeg',3,'2021-02-28 02:47:13','2021-02-28 02:47:13'),(8,3,'Nice one bro. keep up the good work',15,'2021-03-01 17:07:33','2021-03-01 17:07:33');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('ERhYo5Qs0VJ1GBQ98L7cJAdjZGddlI3HvrDaHf1X',4,'192.168.43.168','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:83.0) Gecko/20100101 Firefox/83.0','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiV01SNEtFNlZZdzhobWh6dXMxT0dxVmlvd3ZaZVJnbUdDZVFNZnFidiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ1OiJodHRwOi8vMTkyLjE2OC40My4xNjg6ODAwMC9oYW5keW1hbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkdXdua3FNNDZpVTAvYUlqSjJhSTY2LkkzRXRFdlZsS2Z6eHVtMVdKR1VmcmVrdWVpZnJiYmEiO30=',1614737688),('MGtQLYadWciraBhS4qwBQBx1sO7iYBLMmBCSW9fk',15,'192.168.43.168','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiUWZmM2c4WVdlWGIxbG04bGFhR2RFTktvdHVCTWtzWUZXcXZPOGtjaiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQyOiJodHRwOi8vMTkyLjE2OC40My4xNjg6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJGFJOHFHazVwTjRXYkRNT0N2eXQueGVwaDM2Ty9ObkZ4SE1hUW95S3NGbFNCOEUvcWFwMUsuIjt9',1614737738),('yDJHkkW35oi5mBBRbzpwIslThtHWv4PkOd1EE6O8',NULL,'192.168.43.168','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUkx4V3ltdXZlZUt2azUxN0NhUVlxN2NMSGZxQVRtTkt3U2Z5Ym1TdyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MjoiaHR0cDovLzE5Mi4xNjguNDMuMTY4OjgwMDAvYWRtaW4vZGFzaGJvYXJkIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xOTIuMTY4LjQzLjE2ODo4MDAwL2FkbWluL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1614728430);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone1` bigint(12) DEFAULT NULL,
  `phone2` bigint(12) DEFAULT NULL,
  `job_type_id` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` smallint(1) unsigned DEFAULT NULL,
  `work_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John Doe','oandbservices@gmail.com',NULL,'$2y$10$WGNY23fBkqzxhlx8gklyPeSk6irhDwQV1c.eIZicnEoshBzJRnsPe',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-02-02 19:47:46','2021-02-02 19:47:46'),(2,'Obinna Augustine','oandbservice@gmail.com',NULL,'$2y$10$/NU7XbvtjDGFmoXRj1BgkuGv1Ppe7CHfnhA7bNWj9v64Otziuuygm',NULL,NULL,'C71pSky8vbWbMowEdq7oD3PS3ffDT2w8YMjuRHYCcdMDOXTpfjpYAt9cIUIr',NULL,NULL,NULL,NULL,NULL,NULL,'2021-02-02 20:25:00','2021-02-02 21:54:02'),(3,'Jane Doe','psource112@gmail.com',NULL,'$2y$10$5jtxvZCN/GDuyrQZBhy/A.I1HbDoBu37M2QP7iel2LQztOdWBaRF2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,'2021-02-11 14:20:09','2021-02-11 14:20:09'),(4,'eric','ericalias14@yahoo.com',NULL,'$2y$10$uwnkqM46iU0/aIjJ2aI66.I3EtEvVlKfzxum1WJGUfrekueifrbba',NULL,NULL,NULL,9090314096,NULL,4,'Villa Park',3,'2034300281.png','2021-02-15 17:31:12','2021-03-03 01:05:41'),(5,'John Doe','ezypayne1@gmail.com',NULL,'$2y$10$EL84UJRgNLYoyOirKgXFR.lDJPDX5LJaGU.EDvQ0lpjqefYH6e2cG',NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,'2021-02-23 19:29:09','2021-02-23 19:29:09'),(6,'Demo user','demouser@yahoo.com',NULL,'$2y$10$4cmagLCCG69h3ToCAy0m.eh4iC0xHKahHjQzLv7n5fIC1uoMfXfc6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,'2021-02-23 20:24:54','2021-02-23 20:24:54'),(7,'Demo User2','demouser2@gmail.com',NULL,'$2y$10$XHzJW3y8xXWL0ls08lO/2OkSoTqSAgurTq3UHb1ogAwdYV4PN/R/O',NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,'2021-02-23 21:56:20','2021-02-23 21:56:20'),(8,'demo','demo@gmail.com',NULL,'$2y$10$7JPMWm9z3FLKLMLfhIYydOokM2UxGgsPawVDHZCUccOdlpcuBZIhi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,'2021-02-23 21:58:45','2021-02-23 21:58:45'),(9,'james','james@gmail.com',NULL,'$2y$10$J.ZcleY89tnBQPlttYUfYe48NDTPdrPX4M.v/Q3J0pyA8vreL7352',NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,'2021-02-23 22:01:34','2021-02-23 22:01:34'),(10,'john','johnny@gmail.com',NULL,'$2y$10$i6N8mPcSKIvhvYM6K2w4G.9GE2igwn06mk5tkpuO/TaUA7gQbFAWm',NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,'2021-02-23 22:03:44','2021-02-23 22:03:44'),(11,'Demo User3','ezypayne@gmail.com',NULL,'$2y$10$Q3XjyeFwAx4S8Vl.FhegOud.aitjLPK0BM65WxQf6VgVKBTDX9kDO',NULL,NULL,NULL,7501763143,NULL,7,'festac town, lagos',3,NULL,'2021-02-24 18:35:01','2021-02-24 18:59:59'),(12,'Johnny Depth','johnny@yahoo.com',NULL,'$2y$10$PV3suhNMdyIgZ8YTlqCxyuMlSyQiHs7EMXKjoFje5eZtRBPCGcPbe',NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,'2021-02-24 19:19:34','2021-02-24 19:19:34'),(13,'Johnny Depth','johnny@yahoo.comm',NULL,'$2y$10$Qietr.dXlnG70Re3u3HmauKHCiSMLG0JTiJmVlCmE9FmTokHaX4qS',NULL,NULL,NULL,909031409689,NULL,2,'Satellite town',3,NULL,'2021-02-24 19:21:32','2021-02-24 19:22:41'),(14,'timothy','timi@hail.com',NULL,'$2y$10$H6SgRI/rNtBN.das0z5wquYeg6kIkbOLBdPAWIRqokQeJjHyN7PFW',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'2021-02-24 19:24:28','2021-02-24 19:24:28'),(15,'Administrator','admin@oandbservices.com',NULL,'$2y$10$aI8qGk5pN4WbDMOCvyt.xeph36O/NnFxHMaQoyKsFlSB8E/qap1K.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'2021-02-27 12:47:08','2021-02-27 12:47:08'),(16,'Mac Donald','joshuau.ezeh@gmail.com',NULL,'$2y$10$iY..rT.X.5OWtxyXEoPqw.Ly0CmyP7.Lg95P8nHcfO7.CqKKGL7mi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,'2021-03-01 15:46:20','2021-03-01 15:46:20'),(17,'James Author','jauthor@gmail.com',NULL,'$2y$10$.U./Y9mJTb7hkCidtq5ks.OGp0KKu83zUpKSnea393L2TRS7t0XGq',NULL,NULL,NULL,7501763143,NULL,5,'Lekki Phase 1',3,NULL,'2021-03-01 16:52:56','2021-03-01 16:53:28');
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

-- Dump completed on 2021-03-03  3:17:09
