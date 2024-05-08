/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 8.0.31 : Database - pos
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `pos`;

/*Table structure for table `order_products` */

DROP TABLE IF EXISTS `order_products`;

CREATE TABLE `order_products` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_products_order_id_foreign` (`order_id`),
  KEY `order_products_product_id_foreign` (`product_id`),
  CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `order_products` */

insert  into `order_products`(`id`,`order_id`,`product_id`,`quantity`,`unit_price`,`created_at`,`updated_at`,`deleted_at`) values 
('01e0803d-f4ea-43ad-b9f4-81731bb1d2e6','cea329dd-857e-4f1c-af1e-0f50b7fb8d33','1e80b33b-6b69-427c-a69a-4dc7cbab8454',0,25560,'2024-05-07 13:11:28','2024-05-07 13:33:49','2024-05-07 13:33:49'),
('04c15400-bbe2-42a1-8afe-457555a1f245','5e48693a-b52b-4d86-9711-c92081d185cd','41086518-81e9-4cc6-a900-80250f289a3f',1,7725,'2024-05-08 12:39:56','2024-05-08 12:39:56',NULL),
('075a7d28-00f4-4c4d-a647-6c39ee90bc5b','81a35cb3-1ccd-4a8c-ac87-77ab510bf2a8','10abf0ab-7dab-4f62-9bc7-d1c3f4b2442e',1,14542,'2024-05-08 12:48:10','2024-05-08 12:48:10',NULL),
('0afa90a5-e5bf-4f97-94f8-ee6f87f43167','2bb711b7-5d6e-466e-9a88-1da07e41e208','1e80b33b-6b69-427c-a69a-4dc7cbab8454',1,25560,'2024-05-08 08:49:12','2024-05-08 08:49:12',NULL),
('0b622e01-c9d5-411d-9d32-311f46949c68','b2f303ea-a962-4788-9420-1a5adb214249','1e80b33b-6b69-427c-a69a-4dc7cbab8454',0,25560,'2024-05-07 15:41:15','2024-05-07 15:41:18','2024-05-07 15:41:18'),
('0c9b0d8b-126d-4205-bd72-6340b71182df','de4e7967-b95f-4a88-b329-f6552c556787','6386e70d-f43c-4a20-b32d-5cf5a0edf227',1,11807,'2024-05-08 14:38:31','2024-05-08 14:38:31',NULL),
('0e9ddbc7-5092-4566-849b-0db1b42c2dea','dfad1b35-bde1-40f1-a5e1-1ead20279e91','f3eed49e-1e2c-4ac8-8171-d6767972c7f8',1,20941,'2024-05-08 14:32:34','2024-05-08 14:32:34',NULL),
('10c6048c-db8b-4f45-bcca-6fdd9493e8b2','cea329dd-857e-4f1c-af1e-0f50b7fb8d33','41086518-81e9-4cc6-a900-80250f289a3f',1,7725,'2024-05-07 15:40:23','2024-05-07 15:40:23',NULL),
('10e6f255-8680-443b-a6aa-5bd2090bc6a3','483cf4b7-613f-4c43-b02d-aee83d691486','10abf0ab-7dab-4f62-9bc7-d1c3f4b2442e',2,14542,'2024-05-08 08:42:11','2024-05-08 08:42:16',NULL),
('1374b36f-1e84-4ed5-a83c-ef2e92db57de','5029fe3f-084d-4f6a-a781-329d9888af49','1e80b33b-6b69-427c-a69a-4dc7cbab8454',1,25560,'2024-05-08 12:40:49','2024-05-08 12:40:49',NULL),
('2224a332-b48e-4898-8ebf-c4ebd4a72665','c10a8b0a-1188-438f-ae07-8cf6203c1d9e','1243e150-f1ad-4cfc-b943-df08caf39956',1,2641,'2024-05-08 12:52:10','2024-05-08 12:52:10',NULL),
('3146e840-46d7-4f99-897c-ed3de7252747','cea329dd-857e-4f1c-af1e-0f50b7fb8d33','1243e150-f1ad-4cfc-b943-df08caf39956',1,2641,'2024-05-07 15:39:02','2024-05-07 15:39:02',NULL),
('35252e76-27c5-4391-b62c-c59e2a19e9d4','1a159b43-d09f-454b-b02a-cc5682df3cb7','6386e70d-f43c-4a20-b32d-5cf5a0edf227',1,11807,'2024-05-08 12:38:40','2024-05-08 12:38:40',NULL),
('3a6ec89d-b359-4a5e-a714-fdb9e2985f56','cea329dd-857e-4f1c-af1e-0f50b7fb8d33','01ef1b5d-60ea-4e69-9f86-7e64df225fe5',0,32920,'2024-05-06 10:22:45','2024-05-07 11:02:43','2024-05-07 11:02:43'),
('3ae5aa44-70a9-467b-a11d-0865429b1727','6d1620b6-5ad1-44f8-8671-283675564eed','31d023ca-a651-4854-956f-8bc29e96554d',1,4091,'2024-05-08 14:37:42','2024-05-08 14:37:42',NULL),
('46ad4399-ef1d-42a0-831c-1bb18765b90a','e137ac3b-1a95-4e2e-954e-094ee4a1cb28','10abf0ab-7dab-4f62-9bc7-d1c3f4b2442e',1,14542,'2024-05-08 12:52:30','2024-05-08 12:52:30',NULL),
('4893b91d-2653-4e3b-849f-7fb6d151dd89','a04f6d72-393d-443c-ad00-66658a2c7644','1e80b33b-6b69-427c-a69a-4dc7cbab8454',1,25560,'2024-05-08 08:41:46','2024-05-08 08:41:46',NULL),
('5285fa48-8e5d-4823-bbce-2b093c00a689','f95f93d2-58ac-4293-8c54-dab6d6327360','b3a5e24d-50c3-4ac2-b6eb-53bd4228a2e5',1,37506,'2024-05-08 12:36:31','2024-05-08 12:36:31',NULL),
('5b7bf92c-2cad-4611-9426-67523df19199','9ca05c3c-1fa0-494b-940b-ef463bee4931','1e80b33b-6b69-427c-a69a-4dc7cbab8454',1,25560,'2024-05-08 12:20:00','2024-05-08 12:20:00',NULL),
('5e81e433-a4ef-4522-8713-0924bdf85500','cea329dd-857e-4f1c-af1e-0f50b7fb8d33','6386e70d-f43c-4a20-b32d-5cf5a0edf227',1,11807,'2024-05-07 15:40:22','2024-05-07 15:40:22',NULL),
('5ed3f661-54fd-443a-9e93-0291e42bb058','cf18c4b2-06b4-49d9-a17a-2f0cc4a35ccb','31d023ca-a651-4854-956f-8bc29e96554d',1,4091,'2024-05-08 14:35:35','2024-05-08 14:35:35',NULL),
('60d35e7d-83d3-42e1-8ebd-b6fd4793f9c4','cea329dd-857e-4f1c-af1e-0f50b7fb8d33','b3a5e24d-50c3-4ac2-b6eb-53bd4228a2e5',0,37506,'2024-05-07 13:11:41','2024-05-07 13:33:47','2024-05-07 13:33:47'),
('6f138f8c-5029-4d3f-90e1-3921a07bf046','c8fe418c-9c30-4f76-9b34-598d6b104d2d','1243e150-f1ad-4cfc-b943-df08caf39956',2,2641,'2024-05-06 10:21:06','2024-05-06 10:21:09',NULL),
('7318a97f-8800-4af6-922c-6d5aba98928b','6f15bbab-b393-4c80-a80c-cef046af3874','01ef1b5d-60ea-4e69-9f86-7e64df225fe5',1,32920,'2024-05-08 08:43:40','2024-05-08 08:43:40',NULL),
('799c6e00-694b-43b0-bee9-673a1f6e51fa','b2f303ea-a962-4788-9420-1a5adb214249','10abf0ab-7dab-4f62-9bc7-d1c3f4b2442e',0,14542,'2024-05-07 15:41:20','2024-05-07 15:41:22','2024-05-07 15:41:22'),
('8007e12e-00ed-43b4-92fc-b795611e9abb','b2b3da02-a643-4ca5-9afb-ea03fa52898c','31d023ca-a651-4854-956f-8bc29e96554d',1,4091,'2024-05-08 14:36:57','2024-05-08 14:36:57',NULL),
('857a71b1-b1a4-4ee6-afa2-c2e6dc9d4cbb','6f15bbab-b393-4c80-a80c-cef046af3874','6386e70d-f43c-4a20-b32d-5cf5a0edf227',1,11807,'2024-05-08 08:43:41','2024-05-08 08:43:41',NULL),
('896b280d-1a9a-439f-8742-f8dcea61db92','c8fe418c-9c30-4f76-9b34-598d6b104d2d','10abf0ab-7dab-4f62-9bc7-d1c3f4b2442e',1,14542,'2024-05-06 10:21:05','2024-05-06 10:21:05',NULL),
('92befc9a-9bda-4a90-9753-b37b6fb9fb1d','cea329dd-857e-4f1c-af1e-0f50b7fb8d33','b3a5e24d-50c3-4ac2-b6eb-53bd4228a2e5',0,37506,'2024-05-07 10:29:17','2024-05-07 11:02:41','2024-05-07 11:02:41'),
('94c9b5bd-6b1f-44bc-a272-a40f20f7b6f3','483cf4b7-613f-4c43-b02d-aee83d691486','01ef1b5d-60ea-4e69-9f86-7e64df225fe5',2,32920,'2024-05-08 08:42:10','2024-05-08 08:42:15',NULL),
('9ed9e582-a5f6-44ec-9871-f1d1b70c28f8','a2797331-9cb3-40a2-aa23-c73a69951f0b','10abf0ab-7dab-4f62-9bc7-d1c3f4b2442e',1,14542,'2024-05-08 12:42:03','2024-05-08 12:42:03',NULL),
('a06d29e2-9d22-4ead-8598-fd736670d5d0','cea329dd-857e-4f1c-af1e-0f50b7fb8d33','6386e70d-f43c-4a20-b32d-5cf5a0edf227',0,11807,'2024-05-07 13:33:17','2024-05-07 13:33:44','2024-05-07 13:33:44'),
('a1320e33-ea7b-498b-912b-7e543320d04e','a04f6d72-393d-443c-ad00-66658a2c7644','f3eed49e-1e2c-4ac8-8171-d6767972c7f8',0,20941,'2024-05-07 15:42:53','2024-05-07 16:06:58','2024-05-07 16:06:58'),
('a6cb18fc-1208-4b11-9177-376b8a789f45','7f1dd3f5-b741-4822-ac12-731236b01f46','1e80b33b-6b69-427c-a69a-4dc7cbab8454',1,25560,'2024-05-08 12:42:45','2024-05-08 12:42:45',NULL),
('ab39c066-03ac-4a2f-8404-fb795df3962b','6afcab41-7c9f-4811-b609-9ecc9ec9d3df','10abf0ab-7dab-4f62-9bc7-d1c3f4b2442e',1,14542,'2024-05-08 12:44:35','2024-05-08 12:44:35',NULL),
('ab412688-0e6b-4882-ae26-fa14e0324a9a','cea329dd-857e-4f1c-af1e-0f50b7fb8d33','1e80b33b-6b69-427c-a69a-4dc7cbab8454',0,25560,'2024-05-06 10:22:42','2024-05-07 10:28:53','2024-05-07 10:28:53'),
('ad4f74bc-1a4a-418b-994c-55a549623b7a','a04f6d72-393d-443c-ad00-66658a2c7644','1243e150-f1ad-4cfc-b943-df08caf39956',1,2641,'2024-05-08 08:41:48','2024-05-08 08:41:48',NULL),
('ae0aadbf-215b-4866-8a37-a00cd900b9fc','6f15bbab-b393-4c80-a80c-cef046af3874','41086518-81e9-4cc6-a900-80250f289a3f',1,7725,'2024-05-08 08:43:41','2024-05-08 08:43:41',NULL),
('af68b750-ae12-414f-9de6-1b764bd30e76','b2f303ea-a962-4788-9420-1a5adb214249','1243e150-f1ad-4cfc-b943-df08caf39956',1,2641,'2024-05-07 15:41:33','2024-05-07 15:41:33',NULL),
('b2772f72-437d-485d-ba84-739a59acc7d0','a04f6d72-393d-443c-ad00-66658a2c7644','10abf0ab-7dab-4f62-9bc7-d1c3f4b2442e',0,14542,'2024-05-07 16:06:55','2024-05-07 16:06:57','2024-05-07 16:06:57'),
('bdd65c7e-06de-4b0b-8be8-83db6e2745db','cea329dd-857e-4f1c-af1e-0f50b7fb8d33','b3a5e24d-50c3-4ac2-b6eb-53bd4228a2e5',1,37506,'2024-05-07 15:40:25','2024-05-07 15:40:25',NULL),
('c4434406-26c8-4928-a3d4-dd7a8465704c','18b6c422-b515-432c-b0c1-9c0d04848306','41086518-81e9-4cc6-a900-80250f289a3f',1,7725,'2024-05-08 12:44:16','2024-05-08 12:44:16',NULL),
('c9d6879d-6111-48ab-aea8-3025091939c7','b2f303ea-a962-4788-9420-1a5adb214249','01ef1b5d-60ea-4e69-9f86-7e64df225fe5',0,32920,'2024-05-07 15:41:19','2024-05-07 15:41:23','2024-05-07 15:41:23'),
('ce3039e9-93cb-4585-bc66-45e1a56ade11','cea329dd-857e-4f1c-af1e-0f50b7fb8d33','1e80b33b-6b69-427c-a69a-4dc7cbab8454',1,25560,'2024-05-07 15:39:01','2024-05-07 15:39:01',NULL),
('d9133b82-ccc6-4e31-af51-4c5104a2a411','cea329dd-857e-4f1c-af1e-0f50b7fb8d33','1e80b33b-6b69-427c-a69a-4dc7cbab8454',0,25560,'2024-05-07 13:33:52','2024-05-07 13:33:58','2024-05-07 13:33:58'),
('de52e4ed-3c10-46fd-aba3-1c21048df493','9706c745-06b5-4072-a168-847916ef6b2a','01ef1b5d-60ea-4e69-9f86-7e64df225fe5',1,32920,'2024-05-08 12:18:03','2024-05-08 12:18:03',NULL),
('e792359a-5ecf-4d27-8ecb-206258cd8387','0b5ee75a-e826-4456-af71-de16b9913733','1e80b33b-6b69-427c-a69a-4dc7cbab8454',1,25560,'2024-05-08 12:35:58','2024-05-08 12:35:58',NULL),
('effaa429-041f-472f-a2cf-ab8915806533','b0a03896-8349-4e4c-b0a8-2ad49162146b','b3a5e24d-50c3-4ac2-b6eb-53bd4228a2e5',1,37506,'2024-05-08 12:19:34','2024-05-08 12:19:34',NULL);

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `done_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `paid_amount` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_invoice_number_unique` (`invoice_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `orders` */

insert  into `orders`(`id`,`invoice_number`,`created_at`,`updated_at`,`done_at`,`deleted_at`,`paid_amount`) values 
('0b5ee75a-e826-4456-af71-de16b9913733','2a55a6','2024-05-08 12:20:34','2024-05-08 12:36:07','2024-05-08 12:36:07',NULL,30000),
('18b6c422-b515-432c-b0c1-9c0d04848306','93976d','2024-05-08 12:42:49','2024-05-08 12:44:21','2024-05-08 12:44:21',NULL,10000),
('1a159b43-d09f-454b-b02a-cc5682df3cb7','df29f8','2024-05-08 12:37:17','2024-05-08 12:38:46','2024-05-08 12:38:46',NULL,20000),
('2503364f-c0da-486d-9367-c747275a78f9','b27025','2024-05-08 14:38:35','2024-05-08 14:38:35',NULL,NULL,NULL),
('2bb711b7-5d6e-466e-9a88-1da07e41e208','246f95','2024-05-08 08:43:46','2024-05-08 12:17:18','2024-05-08 12:17:18',NULL,30000),
('483cf4b7-613f-4c43-b02d-aee83d691486','854c05','2024-05-08 08:42:00','2024-05-08 08:42:20','2024-05-08 08:42:20',NULL,100000),
('5029fe3f-084d-4f6a-a781-329d9888af49','96d0aa','2024-05-08 12:40:41','2024-05-08 12:40:51','2024-05-08 12:40:51',NULL,30000),
('5e48693a-b52b-4d86-9711-c92081d185cd','618e10','2024-05-08 12:38:46','2024-05-08 12:40:41','2024-05-08 12:40:41',NULL,10000),
('6afcab41-7c9f-4811-b609-9ecc9ec9d3df','555ef2','2024-05-08 12:44:21','2024-05-08 12:44:38','2024-05-08 12:44:38',NULL,20000),
('6d1620b6-5ad1-44f8-8671-283675564eed','dca825','2024-05-08 14:37:01','2024-05-08 14:37:46','2024-05-08 14:37:46',NULL,50000),
('6f15bbab-b393-4c80-a80c-cef046af3874','cbf273','2024-05-08 08:42:20','2024-05-08 08:43:46','2024-05-08 08:43:46',NULL,60000),
('7f1dd3f5-b741-4822-ac12-731236b01f46','f570a7','2024-05-08 12:42:07','2024-05-08 12:42:49','2024-05-08 12:42:49',NULL,30000),
('81a35cb3-1ccd-4a8c-ac87-77ab510bf2a8','6b59c4','2024-05-08 12:44:38','2024-05-08 12:48:33','2024-05-08 12:48:33',NULL,20000),
('9706c745-06b5-4072-a168-847916ef6b2a','e3b76f','2024-05-08 12:17:18','2024-05-08 12:18:10','2024-05-08 12:18:10',NULL,40000),
('9ca05c3c-1fa0-494b-940b-ef463bee4931','f0b4a5','2024-05-08 12:19:43','2024-05-08 12:20:34','2024-05-08 12:20:34',NULL,30000),
('a04f6d72-393d-443c-ad00-66658a2c7644','ed4f1d','2024-05-07 15:41:50','2024-05-08 08:42:00','2024-05-08 08:42:00',NULL,30000),
('a2797331-9cb3-40a2-aa23-c73a69951f0b','3e6dda','2024-05-08 12:40:51','2024-05-08 12:42:07','2024-05-08 12:42:07',NULL,20000),
('b0a03896-8349-4e4c-b0a8-2ad49162146b','25ced5','2024-05-08 12:18:10','2024-05-08 12:19:43','2024-05-08 12:19:43',NULL,40000),
('b2b3da02-a643-4ca5-9afb-ea03fa52898c','ab09d5','2024-05-08 14:35:38','2024-05-08 14:37:01','2024-05-08 14:37:01',NULL,5000),
('b2f303ea-a962-4788-9420-1a5adb214249','6404ac','2024-05-07 15:41:10','2024-05-07 15:41:42','2024-05-07 15:41:42',NULL,30000),
('c10a8b0a-1188-438f-ae07-8cf6203c1d9e','16f501','2024-05-08 12:48:33','2024-05-08 12:52:14','2024-05-08 12:52:14',NULL,3000),
('c8fe418c-9c30-4f76-9b34-598d6b104d2d','d121da','2024-05-06 10:21:01','2024-05-06 10:21:40','2024-05-06 10:21:40',NULL,30000),
('cea329dd-857e-4f1c-af1e-0f50b7fb8d33','0a0502','2024-05-06 10:22:40','2024-05-07 15:40:35','2024-05-07 15:40:35',NULL,50000),
('cf18c4b2-06b4-49d9-a17a-2f0cc4a35ccb','b4b77c','2024-05-08 14:32:43','2024-05-08 14:35:38','2024-05-08 14:35:38',NULL,5000),
('de4e7967-b95f-4a88-b329-f6552c556787','aad33f','2024-05-08 14:37:46','2024-05-08 14:38:35','2024-05-08 14:38:35',NULL,15000),
('dfad1b35-bde1-40f1-a5e1-1ead20279e91','3da1de','2024-05-08 12:52:35','2024-05-08 14:32:43','2024-05-08 14:32:43',NULL,25000),
('e137ac3b-1a95-4e2e-954e-094ee4a1cb28','e14021','2024-05-08 12:52:14','2024-05-08 12:52:35','2024-05-08 12:52:35',NULL,15000),
('f95f93d2-58ac-4293-8c54-dab6d6327360','7345f2','2024-05-08 12:36:07','2024-05-08 12:37:17','2024-05-08 12:37:17',NULL,40000);

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cost_price` int NOT NULL,
  `selling_price` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`name`,`description`,`cost_price`,`selling_price`,`image`,`stock`,`created_at`,`updated_at`,`deleted_at`) values 
('01ef1b5d-60ea-4e69-9f86-7e64df225fe5','Sarung bantal sofa','Et est accusamus est dignissimos qui aut.',21072,32920,'ZmBWF0qSFLNeVNPYq3iJdNsLPWCKKRATiuzbhDpI.jpg',8,'2024-05-06 10:20:14','2024-05-08 12:18:10',NULL),
('10abf0ab-7dab-4f62-9bc7-d1c3f4b2442e','Sarung bantal sofa 2','Modi ut soluta ut iusto.',5040,14542,'abeA9gk1eHSRHSxas6SYXpARtngQ07uj7eWS6YyU.jpg',58,'2024-05-06 10:20:14','2024-05-08 12:52:35',NULL),
('1243e150-f1ad-4cfc-b943-df08caf39956','Jam Dinding','Enim at velit nisi eius.',13692,2641,'Jt0jK5FaMRwVmqiwUKkSmQeTU2wVVphZ2Ij4nuKO.jpg',93,'2024-05-06 10:20:14','2024-05-08 12:52:14',NULL),
('1e80b33b-6b69-427c-a69a-4dc7cbab8454','Nomer rumah','Commodi voluptatem eveniet placeat excepturi.',24630,25560,'q1AHr8Uj8jcKJWMDWIaQpAgS9yDnk3W7SYpSS59L.jpg',49,'2024-05-06 10:20:14','2024-05-08 12:42:49',NULL),
('31d023ca-a651-4854-956f-8bc29e96554d','Hiasan bulat Datar Keramik','Non et adipisci iure.',9675,4091,'Uq8aAwxgGUIHwwmN6dFms6gjoQQWTWyzc1qp82yg.jpg',9,'2024-05-06 10:20:14','2024-05-08 14:37:46',NULL),
('41086518-81e9-4cc6-a900-80250f289a3f','Hiasan bulat Datar Keramik Motif','Animi nihil vel voluptate iure nemo reprehenderit delectus.',11645,7725,'eMl6CPX852fKCbR44hYyRuMsHdvLsAS6yxynC9zl.jpg',47,'2024-05-06 10:20:14','2024-05-08 12:44:21',NULL),
('6386e70d-f43c-4a20-b32d-5cf5a0edf227','Meja dan Pot','Cumque veritatis cumque quam molestiae ut.',7773,11807,'akiLku3rqjZb3WzyOPca3qwajkJ85V4SgyLMSBgP.jpg',21,'2024-05-06 10:20:14','2024-05-08 14:38:35',NULL),
('b3a5e24d-50c3-4ac2-b6eb-53bd4228a2e5','Hiasan dinding keramik','Aut sit et facere et.',15704,37506,'UAOZtFwtWj83Lq8JRu8JAxbASHpEfnyukPdGyaFy.jpg',0,'2024-05-06 10:20:14','2024-05-08 12:37:17',NULL),
('c090fabb-8916-44db-9f00-228fd479d68b','Keramik bulat','Officia ut vero asperiores occaecati quidem nostrum.',10817,41430,'DjVEw3M5Ncs6kAiF4Vmwg0KMdD5tXk7HGGEtAzGI.jpg',48,'2024-05-06 10:20:14','2024-05-07 12:59:04',NULL),
('f3eed49e-1e2c-4ac8-8171-d6767972c7f8','bantal ','Voluptatem aspernatur quos quis amet quia.',14147,20941,'0OTEIZevhQDCDHkorcxHE6BTE4Pn4KPJmuR1trnc.jpg',58,'2024-05-06 10:20:14','2024-05-08 14:32:43',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
