
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

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `ecatic` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `ecatic`;
DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `activities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'fa-seedling',
  `summary` varchar(300) NOT NULL,
  `description` longtext NOT NULL,
  `highlights` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`highlights`)),
  `image` varchar(255) DEFAULT NULL,
  `sort_order` smallint(5) unsigned NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `activities_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES
(1,'Agrobusiness','agrobusiness','fa-seedling','Production, transformation et valorisation des produits agricoles locaux, en collaboration avec les producteurs.','ECATIC s\'engage dans le développement des filières agricoles sénégalaises, de la production à la valorisation des produits locaux, en travaillant avec les producteurs et les coopératives.','[\"Production agricole\",\"Transformation agricole\",\"Valorisation des produits locaux\",\"Collaboration avec les producteurs\",\"D\\u00e9veloppement des fili\\u00e8res agricoles\"]','images/activities/agrobusiness.jpg',1,1,'2026-11-10 22:59:33','2026-11-10 22:59:33'),
(2,'Import & Export','import-export','fa-globe-africa','Importation de produits agroalimentaires et exportation de produits agricoles sénégalais vers les marchés internationaux.','Nous facilitons le commerce international et la mise en relation avec des partenaires commerciaux, afin de développer les échanges entre l\'Afrique et le reste du monde.','[\"Importation de produits agroalimentaires\",\"Exportation de produits agricoles s\\u00e9n\\u00e9galais\",\"Commerce international\",\"Mise en relation avec les partenaires commerciaux\",\"D\\u00e9veloppement des \\u00e9changes entre l\'Afrique et le reste du monde\"]','images/activities/import-export.jpg',2,1,'2026-11-10 22:59:33','2026-11-10 22:59:33'),
(3,'Transport et logistique','transport-logistique','fa-truck-fast','Transport de marchandises, logistique commerciale et acheminement des produits.','ECATIC accompagne les opérations commerciales par des solutions de transport et de logistique adaptées à la distribution des produits agroalimentaires.','[\"Transport de marchandises\",\"Logistique commerciale\",\"Acheminement des produits\",\"Accompagnement des op\\u00e9rations commerciales\"]','images/activities/transport-logistique.jpg',3,1,'2026-11-10 22:59:33','2026-11-10 22:59:33');
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `request_type` varchar(30) NOT NULL DEFAULT 'information',
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `is_handled` tinyint(1) NOT NULL DEFAULT 0,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2026_11_08_000001_add_admin_fields_to_users_table',1),
(5,'2026_11_08_000002_create_activities_table',1),
(6,'2026_11_08_000003_create_services_table',1),
(7,'2026_11_08_000004_create_projects_table',1),
(8,'2026_11_08_000005_create_contact_messages_table',1),
(9,'2026_11_08_000006_create_quote_requests_table',1),
(10,'2026_11_08_000007_create_site_settings_table',1),
(11,'2026_11_12_000008_set_default_contact_email',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
DROP TABLE IF EXISTS `project_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned NOT NULL,
  `path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `sort_order` smallint(5) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_images_project_id_foreign` (`project_id`),
  CONSTRAINT `project_images_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `project_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_images` ENABLE KEYS */;
DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(30) NOT NULL DEFAULT 'agricole',
  `summary` text NOT NULL,
  `description` longtext DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `project_date` date DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `is_demo` tinyint(1) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `projects_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES
(1,'Exemple – Projet agricole','exemple-projet-agricole','agricole','Contenu de démonstration. Remplacez-le par une réalisation agricole réelle depuis l\'espace administrateur.',NULL,NULL,NULL,NULL,1,1,'2026-11-10 22:59:33','2026-11-10 22:59:33'),
(2,'Exemple – Opération commerciale','exemple-operation-commerciale','commercial','Contenu de démonstration. Remplacez-le par une opération commerciale réelle.',NULL,NULL,NULL,NULL,1,1,'2026-11-10 22:59:33','2026-11-10 22:59:33'),
(3,'Exemple – Opération logistique','exemple-operation-logistique','logistique','Contenu de démonstration. Remplacez-le par une opération logistique réelle.',NULL,NULL,NULL,NULL,1,1,'2026-11-10 22:59:33','2026-11-10 22:59:33'),
(4,'Exemple – Partenariat','exemple-partenariat','partenariat','Contenu de démonstration. Remplacez-le par un partenariat réel.',NULL,NULL,NULL,NULL,1,1,'2026-11-10 22:59:33','2026-11-10 22:59:33');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
DROP TABLE IF EXISTS `quote_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `quote_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` bigint(20) unsigned DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `details` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'nouveau',
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quote_requests_service_id_foreign` (`service_id`),
  CONSTRAINT `quote_requests_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `quote_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `quote_requests` ENABLE KEYS */;
DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'fa-check',
  `summary` varchar(300) NOT NULL,
  `description` longtext DEFAULT NULL,
  `sort_order` smallint(5) unsigned NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`),
  KEY `services_activity_id_foreign` (`activity_id`),
  CONSTRAINT `services_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES
(1,1,'Approvisionnement en produits agricoles','approvisionnement-produits-agricoles','fa-wheat-awn','Mise en relation avec des producteurs et coopératives pour l\'approvisionnement en produits agricoles sénégalais.',NULL,1,1,'2026-11-10 22:59:33','2026-11-10 22:59:33'),
(2,1,'Valorisation et transformation','valorisation-transformation','fa-industry','Accompagnement de la transformation et de la valorisation des produits locaux.',NULL,2,1,'2026-11-10 22:59:33','2026-11-10 22:59:33'),
(3,2,'Exportation de produits sénégalais','exportation-produits-senegalais','fa-ship','Exportation de produits agricoles sénégalais vers des partenaires internationaux.',NULL,3,1,'2026-11-10 22:59:33','2026-11-10 22:59:33'),
(4,2,'Importation de produits agroalimentaires','importation-agroalimentaire','fa-boxes-stacked','Importation de produits agroalimentaires pour les entreprises et distributeurs.',NULL,4,1,'2026-11-10 22:59:33','2026-11-10 22:59:33'),
(5,2,'Mise en relation commerciale','mise-en-relation-commerciale','fa-handshake','Connexion entre fournisseurs, acheteurs et partenaires commerciaux.',NULL,5,1,'2026-11-10 22:59:33','2026-11-10 22:59:33'),
(6,3,'Transport de marchandises','transport-marchandises','fa-truck','Transport de marchandises et acheminement des produits.',NULL,6,1,'2026-11-10 22:59:33','2026-11-10 22:59:33'),
(7,3,'Logistique commerciale','logistique-commerciale','fa-warehouse','Accompagnement logistique des opérations commerciales.',NULL,7,1,'2026-11-10 22:59:33','2026-11-10 22:59:33');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `group` varchar(30) NOT NULL DEFAULT 'general',
  `label` varchar(255) DEFAULT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'text',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES
(1,'contact_email','Contact.ecatic@gmail.com','contact','E-mail de contact','email','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(2,'company_name','ECATIC','company','Nom de l\'entreprise','text','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(3,'company_slogan','Nous développons l\'agrobusiness sénégalais et connectons l\'Afrique au monde.','company','Slogan','textarea','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(4,'company_intro','ECATIC est une entreprise sénégalaise basée à Sébikotane, dans la région de Dakar. Nous développons l\'agrobusiness au Sénégal et connectons l\'Afrique au monde.','company','Présentation courte','textarea','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(5,'company_vision','Faire de l\'agriculture sénégalaise un moteur de développement économique, capable de nourrir l\'Afrique et de conquérir les marchés internationaux.','company','Vision','textarea','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(6,'company_mission','Valoriser le potentiel agricole sénégalais, développer les échanges commerciaux internationaux et faciliter le transport et la distribution des produits agroalimentaires.','company','Mission','textarea','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(7,'about_story','ECATIC est une entreprise sénégalaise basée à Sébikotane, dans la région de Dakar. Nous développons l\'agrobusiness au Sénégal et connectons l\'Afrique au monde. Nous travaillons avec les producteurs, les coopératives, les entreprises et les partenaires internationaux.','about','Présentation / histoire (page À propos)','textarea','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(8,'about_identity','Une entreprise sénégalaise active dans l\'agrobusiness, l\'import-export, le transport et la logistique, tournée vers les marchés locaux et internationaux.','about','Notre identité','textarea','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(9,'about_values','Engagement envers les producteurs\nIntégrité et transparence\nQualité et fiabilité\nOuverture à l\'international\nDéveloppement durable du territoire','about','Nos valeurs (une par ligne)','textarea','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(10,'about_ambitions','Valoriser le potentiel agricole sénégalais, développer les échanges commerciaux internationaux et faciliter le transport et la distribution des produits agroalimentaires.','about','Nos ambitions','textarea','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(11,'about_commitment','Nous travaillons main dans la main avec les producteurs, les coopératives, les entreprises et les partenaires internationaux, dans une logique de collaboration durable.','about','Notre engagement','textarea','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(12,'contact_address','Sébikotane, Dakar, Sénégal','contact','Adresse','text','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(13,'contact_phone','+221 77 228 48 71','contact','Téléphone','text','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(14,'contact_whatsapp','221772284871','contact','WhatsApp (format international, sans +)','text','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(15,'google_maps_embed','','contact','URL d\'intégration Google Maps (iframe src)','url','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(16,'social_facebook','','social','Facebook','url','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(17,'social_linkedin','','social','LinkedIn','url','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(18,'social_instagram','','social','Instagram','url','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(19,'social_x','','social','X (Twitter)','url','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(20,'seo_title','ECATIC Sénégal | Agrobusiness, Import-Export, Transport et Logistique','seo','Titre SEO par défaut','text','2026-11-10 22:59:33','2026-11-10 22:59:33'),
(21,'seo_description','ECATIC, entreprise sénégalaise basée à Sébikotane (Dakar) : agrobusiness, import-export, commerce international, transport et logistique.','seo','Méta-description par défaut','textarea','2026-11-10 22:59:33','2026-11-10 22:59:33');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Administrateur ECATIC','admin@ecatic.sn',NULL,'$2y$12$OQ0Jv7w6cf6ppwRGZ1VoUOhAqOV0V59SDioJoWo3/JZVbY/FhZ7lC',1,NULL,'2026-11-10 22:59:33','2026-11-10 22:59:33');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

