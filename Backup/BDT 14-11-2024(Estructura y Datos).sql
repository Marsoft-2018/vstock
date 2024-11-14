/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.32-MariaDB : Database - bdt_vstock
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bdt_vstock` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `bdt_vstock`;

/*Table structure for table `bussines` */

DROP TABLE IF EXISTS `bussines`;

CREATE TABLE `bussines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `nit` char(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `address` char(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `town` char(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `city` char(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `tel` char(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email` char(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `logo` char(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `propietary` char(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `bussines` */

insert  into `bussines`(`id`,`name`,`nit`,`address`,`town`,`city`,`tel`,`email`,`logo`,`propietary`,`status`,`date_at`) values (1,'DISTRICERDO LA PROMESA','1051443981-8','Mz. E Lote 05','Nelson mandela','Cartagena','3145314592','','3pl-control-de-inventarios.png','JOSE TAPIA',1,'2024-10-29 16:50:03'),(2,'Administrador','45648520-4','KR 51 23-30','EL CENTRO','EL CARMEN DE BOLIVAR','3208981523',NULL,'e&e.png','Luis Tapia',1,'2024-04-13 18:00:16');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `bussines_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idNegocio` (`bussines_id`),
  CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`bussines_id`) REFERENCES `bussines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `categories` */

insert  into `categories`(`bussines_id`,`id`,`name`,`description`,`status`) values (2,13,'ROPA DAMA',NULL,1),(2,14,'ROPA NIÃ‘O',NULL,1),(2,15,'ROPA NIÃ‘A',NULL,1),(1,21,'Televisores','',1),(1,22,'Lavadoras','',1),(1,24,'Otros Electrodomésticos','En esta categoria se registrarán todos los articulos relacionados con los electrodomesticos',1),(1,27,'Otros...',NULL,1);

/*Table structure for table `customer_credits` */

DROP TABLE IF EXISTS `customer_credits`;

CREATE TABLE `customer_credits` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `number_paid` int(11) NOT NULL COMMENT 'numero de cuotas abonadas',
  `amount` double NOT NULL,
  `date_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCompra` (`invoice_id`),
  CONSTRAINT `customer_credits_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `sales_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `customer_credits` */

insert  into `customer_credits`(`id`,`invoice_id`,`customer_id`,`number_paid`,`amount`,`date_at`) values (000001,492,45648520,1,57000,'2024-09-05'),(000003,492,45648520,2,45000,'2024-10-30'),(000004,492,45648520,2,22000,'2024-10-15'),(000005,492,45648520,1,5000,'2024-10-15'),(000006,492,45648520,1,23000,'2024-11-13');

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` char(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address` char(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `phone` char(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `city` char(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email` char(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `NewIndex1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `customers` */

insert  into `customers`(`id`,`name`,`address`,`phone`,`city`,`email`,`status`,`reg_date`) values (1,'Consumidor Final','','','','',1,'2024-10-24 15:48:54'),(45648520,'enith tapias','cra 51#23-33','314140338','el carmen de bolivar','enisyota201@gmail.com',1,'2024-10-24 15:38:57'),(73429935,'Jose Alfredo','Kra 47 # 31-50','3107358169','El Carmen de Bolívar','josealf@gmail.com',1,'2024-11-12 21:12:42');

/*Table structure for table `descuento_compras` */

DROP TABLE IF EXISTS `descuento_compras`;

CREATE TABLE `descuento_compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `description` char(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FACTURA` (`invoice_id`),
  CONSTRAINT `descuento_compras_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `purchase_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `descuento_compras` */

/*Table structure for table `detalles_egreso` */

DROP TABLE IF EXISTS `detalles_egreso`;

CREATE TABLE `detalles_egreso` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_egreso` varchar(255) NOT NULL,
  `id_cuenta` varchar(255) NOT NULL,
  `debito` decimal(10,2) NOT NULL,
  `credito` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `detalles_egreso` */

/*Table structure for table `devolucion_compra` */

DROP TABLE IF EXISTS `devolucion_compra`;

CREATE TABLE `devolucion_compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `date_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCompra` (`invoice_id`),
  CONSTRAINT `devolucion_compra_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `purchase_invoice_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `devolucion_compra` */

/*Table structure for table `devolucion_venta` */

DROP TABLE IF EXISTS `devolucion_venta`;

CREATE TABLE `devolucion_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `date_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idVenta` (`invoice_id`),
  CONSTRAINT `devolucion_venta_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `sale_invoice_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `devolucion_venta` */

/*Table structure for table `egresos` */

DROP TABLE IF EXISTS `egresos`;

CREATE TABLE `egresos` (
  `VALOR` double NOT NULL,
  `FECHA` date NOT NULL,
  `idGasto` int(11) NOT NULL,
  `RECIBO` char(50) NOT NULL,
  `idEgreso` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idEgreso`),
  KEY `FK_egresos` (`idGasto`),
  CONSTRAINT `egresos_ibfk_1` FOREIGN KEY (`idGasto`) REFERENCES `gastos` (`idGasto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `egresos` */

insert  into `egresos`(`VALOR`,`FECHA`,`idGasto`,`RECIBO`,`idEgreso`) values (1430000,'2023-10-09',3,'',0000000001);

/*Table structure for table `employe_payments` */

DROP TABLE IF EXISTS `employe_payments`;

CREATE TABLE `employe_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employe_id` char(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `payment_value` double DEFAULT NULL,
  `date_at` date DEFAULT NULL,
  `receipt` char(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_pagos` (`employe_id`),
  CONSTRAINT `FK_pagos` FOREIGN KEY (`employe_id`) REFERENCES `employes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `employe_payments` */

/*Table structure for table `employes` */

DROP TABLE IF EXISTS `employes`;

CREATE TABLE `employes` (
  `id` char(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `first_name` char(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `second_name` char(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `first_last_name` char(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `second_last_name` char(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `address` char(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `phone` char(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `job` char(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `income` double DEFAULT NULL,
  `status` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'SI',
  `bussines_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `EMP` (`bussines_id`),
  CONSTRAINT `EMP` FOREIGN KEY (`bussines_id`) REFERENCES `bussines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `employes` */

insert  into `employes`(`id`,`first_name`,`second_name`,`first_last_name`,`second_last_name`,`address`,`phone`,`job`,`income`,`status`,`bussines_id`) values ('1052071180','D0RA','IASBEL','QUEZADA','PAVON','BARRIO EL CARMEN','3145839780','Empleado',900000,'SI',1),('1052954015','YAINA','ROSA','BARRETO','TORRES','BARRIO EL PRADO','3127777612','Empleado',720000,'NO',1),('23','FULANITO','SDDFFFF','DE TAL','QWERRR','Kra 47 # 31-50','3107358169','VENDEDOR',1150250,'SI',1),('45584827','MAIRA','PATRICIA','BINILLA','YEPES','BARRIO LOS MANGOS','3017953903','Empleado',720000,'NO',1),('45648707','CANDELARIA','MARIA','GUZMAN','RIBERA','BARRIO 7 DE AGOSTO','3242954912','Empleado',900000,'SI',1),('73434290','ENEIDER','DAVID','LEGUIA','DOMINGUEZ','KRA 51#23-33','3013643169','GERENTE',1000000,'SI',1);

/*Table structure for table `gastos` */

DROP TABLE IF EXISTS `gastos`;

CREATE TABLE `gastos` (
  `idGasto` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` char(150) NOT NULL,
  `nombre` char(200) NOT NULL,
  `idNegocio` int(11) NOT NULL,
  `Activo` char(10) NOT NULL DEFAULT 'SI',
  PRIMARY KEY (`idGasto`),
  KEY `gas` (`idNegocio`),
  CONSTRAINT `gas` FOREIGN KEY (`idNegocio`) REFERENCES `bussines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `gastos` */

insert  into `gastos`(`idGasto`,`tipo`,`nombre`,`idNegocio`,`Activo`) values (1,'EnergÃ­a','Recibo de energÃ­a elÃ©ctrica',1,'SI'),(2,'Otros','PAGO DE NOMINAS',1,'SI'),(3,'Arriendo','1430000',1,'SI'),(4,'Mantenimiento/Reparacion','',1,'SI');

/*Table structure for table `measurements` */

DROP TABLE IF EXISTS `measurements`;

CREATE TABLE `measurements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bussines_id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `short_name` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `register_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `bussines_id` (`bussines_id`),
  CONSTRAINT `measurements_ibfk_1` FOREIGN KEY (`bussines_id`) REFERENCES `bussines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `measurements` */

insert  into `measurements`(`id`,`bussines_id`,`name`,`short_name`,`status`,`register_date`) values (1,2,'Par(es)','PAR',1,'2024-05-01 12:25:26'),(2,1,'Unidad','UND',1,'2024-05-01 12:25:11'),(3,1,'Kilo gramos','KG',1,'2024-05-01 12:25:12'),(4,1,'Libras','LB',1,'2024-05-01 12:25:12'),(5,1,'Gramos','GR',1,'2024-05-01 12:25:13');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `pay_forms` */

DROP TABLE IF EXISTS `pay_forms`;

CREATE TABLE `pay_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_sale` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` longtext DEFAULT NULL,
  `status` tinyint(2) DEFAULT 1,
  `date_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pay_forms` */

insert  into `pay_forms`(`id`,`type_sale`,`name`,`description`,`status`,`date_at`) values (1,'contado','Efectivo',NULL,1,'2024-11-06 11:38:03'),(2,'contado','Tarjeta',NULL,1,'2024-11-06 11:38:29'),(3,'contado','Cheque',NULL,1,'2024-11-06 11:39:10'),(4,'contado','Otra',NULL,1,'2024-11-06 11:39:16'),(5,'credito','Semanal',NULL,1,'2024-11-06 11:39:07'),(6,'credito','Quincenal',NULL,1,'2024-11-06 11:39:24'),(7,'credito','Mensual',NULL,1,'2024-11-06 11:39:33'),(8,'credito','Otra',NULL,1,'2024-11-06 11:39:46');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(600) DEFAULT NULL COMMENT 'nombre',
  `reference` varchar(150) DEFAULT NULL COMMENT 'referencia',
  `purchase_price` double DEFAULT 0 COMMENT 'precio de compra',
  `selling_price` double DEFAULT 0 COMMENT 'precio de venta',
  `initial_quantity` double DEFAULT 0 COMMENT 'cantidad inicial',
  `purchases` double DEFAULT 0 COMMENT 'compras',
  `sales` double DEFAULT 0 COMMENT 'ventas',
  `stock_returns` double DEFAULT 0 COMMENT 'devoluciones',
  `stock` double DEFAULT 0 COMMENT 'existencias',
  `min_quantity` int(11) DEFAULT NULL COMMENT 'cantidad minima',
  `bussines_id` int(11) NOT NULL COMMENT 'id del negocio',
  `category_id` int(11) NOT NULL COMMENT 'id de la categoria',
  `measure_id` int(11) NOT NULL COMMENT 'unidad de medida',
  PRIMARY KEY (`id`),
  KEY `Inv` (`bussines_id`),
  KEY `Cat` (`category_id`),
  KEY `measure_id` (`measure_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`measure_id`) REFERENCES `measurements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`name`,`reference`,`purchase_price`,`selling_price`,`initial_quantity`,`purchases`,`sales`,`stock_returns`,`stock`,`min_quantity`,`bussines_id`,`category_id`,`measure_id`) values ('213232','Carne blanda','qqww',23444,34552,245,0,0,0,245,12,1,21,3),('2132321212','Costilla de cerdo','12222',4578,5780,75,0,0,0,96,12,1,21,3),('213233','Lavadora Hoover','c231131',4567,5678,567,0,0,0,587,2,1,21,4),('231232','AIRE ACONDICIONADO OLIMPO','al2134234',2345000,2850000,10,0,3,0,7,2,1,24,2),('5467567','TELEVISOR SAMSUNG 42\"','REF 34324',1250000,1758000,10,0,9,0,1,3,1,21,2),('78213232','AIRE ACONDICIONADO OLIMPO','al2134234',1452000,1758400,15,0,0,0,15,2,1,24,2);

/*Table structure for table `purchase_invoice_details` */

DROP TABLE IF EXISTS `purchase_invoice_details`;

CREATE TABLE `purchase_invoice_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `product_id` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `description` char(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `unit_value` double DEFAULT NULL,
  `subtotal_amount` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prod` (`product_id`),
  KEY `FACTURA` (`invoice_id`),
  CONSTRAINT `purchase_invoice_details_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `purchase_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `purchase_invoice_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `purchase_invoice_details` */

/*Table structure for table `purchase_invoices` */

DROP TABLE IF EXISTS `purchase_invoices`;

CREATE TABLE `purchase_invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `date_at` date DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `type` char(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `form_pay` char(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'Efectivo',
  `status` char(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Cancelada',
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idCliente` (`supplier_id`),
  CONSTRAINT `purchase_invoices_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `purchase_invoices` */

/*Table structure for table `sale_invoice_details` */

DROP TABLE IF EXISTS `sale_invoice_details`;

CREATE TABLE `sale_invoice_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `product_id` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `description` char(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `unit_value` double DEFAULT NULL,
  `subtotal_amount` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prod` (`product_id`),
  KEY `FACTURA` (`invoice_id`),
  CONSTRAINT `sale_invoice_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sale_invoice_details_ibfk_3` FOREIGN KEY (`invoice_id`) REFERENCES `sales_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sale_invoice_details_ibfk_4` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=891 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `sale_invoice_details` */

insert  into `sale_invoice_details`(`id`,`invoice_id`,`product_id`,`description`,`quantity`,`unit_value`,`subtotal_amount`) values (867,495,'213233',NULL,4,5678,22712),(868,495,'231232',NULL,2,2850000,5700000),(869,496,'231232',NULL,1,2850000,2850000),(870,497,'231232',NULL,1,2850000,2850000),(871,498,'231232',NULL,1,2850000,2850000),(872,499,'231232',NULL,1,2850000,2850000),(873,500,'231232',NULL,1,2850000,2850000),(874,501,'213233',NULL,3,5678,17034),(875,502,'213233',NULL,1,5678,5678),(876,503,'231232',NULL,1,2850000,2850000),(877,504,'213233',NULL,1,5678,5678),(878,505,'213233',NULL,1,5678,5678),(879,506,'231232',NULL,1,2850000,2850000),(880,507,'231232',NULL,1,2850000,2850000),(881,508,'231232',NULL,1,2850000,2850000),(882,509,'231232',NULL,1,2850000,2850000),(883,510,'231232',NULL,2,2850000,5700000),(884,511,'5467567',NULL,2,1758000,3516000),(885,512,'5467567',NULL,1,1758000,1758000),(886,513,'5467567',NULL,1,1758000,1758000),(887,514,'5467567',NULL,1,1758000,1758000),(888,515,'231232',NULL,1,2850000,2850000),(889,515,'5467567',NULL,1,1758000,1758000),(890,516,'5467567',NULL,3,1758000,5274000);

/*Table structure for table `sales_invoices` */

DROP TABLE IF EXISTS `sales_invoices`;

CREATE TABLE `sales_invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `date_at` date DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `type` char(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `form_pay` char(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'Efectivo',
  `status` char(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Cancelada',
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idCliente` (`customer_id`),
  CONSTRAINT `sales_invoices_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=517 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `sales_invoices` */

insert  into `sales_invoices`(`id`,`customer_id`,`date_at`,`amount`,`type`,`form_pay`,`status`,`reg_date`) values (492,45648520,'2024-08-07',145700,'credito','Efectivo','Por Pagar','2024-10-27 13:02:34'),(493,1,'2024-11-13',2867034,'contado','Efectivo','pagada','2024-11-12 21:10:37'),(494,1,'2024-11-13',5717034,'contado','Efectivo','pagada','2024-11-13 11:35:58'),(495,1,'2024-11-13',5722712,'contado','Efectivo','pagada','2024-11-13 11:52:07'),(496,1,'2024-11-13',2850000,'contado','Efectivo','pagada','2024-11-13 12:22:30'),(497,1,'2024-11-13',2850000,'contado','Efectivo','pagada','2024-11-13 12:23:51'),(498,1,'2024-11-13',2850000,'contado','Efectivo','pagada','2024-11-13 12:24:37'),(499,1,'2024-11-13',2850000,'contado','Efectivo','pagada','2024-11-13 16:13:33'),(500,1,'2024-11-13',2850000,'contado','Efectivo','pagada','2024-11-13 16:21:10'),(501,1,'2024-11-13',17034,'contado','Efectivo','pagada','2024-11-13 16:21:43'),(502,1,'2024-11-13',5678,'contado','Efectivo','pagada','2024-11-13 16:25:12'),(503,1,'2024-11-13',2850000,'contado','Efectivo','pagada','2024-11-13 16:26:54'),(504,1,'2024-11-13',5678,'contado','Efectivo','pagada','2024-11-13 16:32:06'),(505,1,'2024-11-13',5678,'contado','Efectivo','pagada','2024-11-13 16:34:13'),(506,1,'2024-11-13',2850000,'contado','Efectivo','pagada','2024-11-13 16:35:10'),(507,1,'2024-11-13',2850000,'contado','Efectivo','pagada','2024-11-13 17:01:22'),(508,1,'2024-11-13',2850000,'contado','Efectivo','pagada','2024-11-13 17:09:27'),(509,1,'2024-11-13',2850000,'contado','Efectivo','pagada','2024-11-13 17:11:23'),(510,1,'2024-11-14',5700000,'contado','Efectivo','pagada','2024-11-13 18:46:26'),(511,73429935,'2024-11-14',3516000,'contado','Efectivo','pagada','2024-11-13 19:19:46'),(512,1,'2024-11-14',1758000,'contado','Efectivo','pagada','2024-11-13 19:20:36'),(513,1,'2024-11-14',1758000,'contado','Efectivo','pagada','2024-11-13 19:23:02'),(514,1,'2024-11-14',1758000,'contado','Efectivo','pagada','2024-11-13 19:24:05'),(515,73429935,'2024-11-14',4608000,'contado','Efectivo','pagada','2024-11-13 19:24:30'),(516,1,'2024-11-14',5274000,'contado','Efectivo','pagada','2024-11-13 19:27:15');

/*Table structure for table `suppliers` */

DROP TABLE IF EXISTS `suppliers`;

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` char(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address` char(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `phone` char(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `city` char(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email` char(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `NewIndex1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `suppliers` */

insert  into `suppliers`(`id`,`name`,`address`,`phone`,`city`,`email`,`status`,`reg_date`) values (1,'Proveedor','','','','',1,'2024-10-24 22:52:01'),(4157842,'FULANITO DE TAL','CALLE 1','341241234','CARTAGENA','fulanito@correo.com',1,'2024-10-24 22:52:56');

/*Table structure for table `suppliers_credits` */

DROP TABLE IF EXISTS `suppliers_credits`;

CREATE TABLE `suppliers_credits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `number_paid` int(11) NOT NULL COMMENT 'numero de cuotas abonadas',
  `amount` double NOT NULL,
  `date_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCompra` (`invoice_id`),
  CONSTRAINT `suppliers_credits_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `purchase_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `suppliers_credits` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `Usuario` varchar(150) NOT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Rol` enum('Admin','Usuario') DEFAULT NULL,
  `IdNegocio` int(11) NOT NULL,
  `primerNombre` char(50) NOT NULL,
  `segundoNombre` char(50) DEFAULT NULL,
  `primerApellido` char(50) NOT NULL,
  `segundoApellido` char(50) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `estado` char(30) NOT NULL,
  `token` varchar(150) DEFAULT NULL,
  `token_estado` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Usuario`),
  KEY `US` (`IdNegocio`),
  CONSTRAINT `US` FOREIGN KEY (`IdNegocio`) REFERENCES `bussines` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

/*Data for the table `users` */

insert  into `users`(`Usuario`,`Password`,`Rol`,`IdNegocio`,`primerNombre`,`segundoNombre`,`primerApellido`,`segundoApellido`,`email`,`estado`,`token`,`token_estado`) values ('nelcas08@hotmail.com','198812','Admin',1,'NELSON','DAVID','CASTRO','FLOREZ',NULL,'Activo',NULL,0),('superadmi','123456','Admin',2,'Luiss','David','Tapia','Posada',NULL,'Activo',NULL,0),('superadmin','123456','Admin',1,'Jose','Alfredo','Tapia','Arroyo','josealf7@gmail.com','Activo',NULL,0),('vendedor','123456','Usuario',1,'EL VENDEDOR','DE MODA','',NULL,NULL,'Activo',NULL,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
