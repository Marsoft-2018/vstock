/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.24-MariaDB : Database - bdt_vstock
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bdt_vstock` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `bdt_vstock`;

/*Table structure for table `abonos_clientes` */

DROP TABLE IF EXISTS `abonos_clientes`;

CREATE TABLE `abonos_clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) DEFAULT NULL,
  `number_paid` int(11) NOT NULL COMMENT 'numero de cuotas abonadas',
  `amount` double NOT NULL,
  `date_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCompra` (`invoice_id`),
  CONSTRAINT `abonos_clientes_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `factura_ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `abonos_clientes` */

/*Table structure for table `abonos_proveedores` */

DROP TABLE IF EXISTS `abonos_proveedores`;

CREATE TABLE `abonos_proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) DEFAULT NULL,
  `number_paid` int(11) NOT NULL COMMENT 'numero de cuotas abonadas',
  `amount` double NOT NULL,
  `date_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCompra` (`invoice_id`),
  CONSTRAINT `abonos_proveedores_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `factura_compras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `abonos_proveedores` */

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `bussines_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET latin1 NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idNegocio` (`bussines_id`),
  CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`bussines_id`) REFERENCES `negocio` (`IdNegocio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `categorias` */

insert  into `categorias`(`bussines_id`,`id`,`name`,`description`,`status`) values (2,13,'ROPA DAMA',NULL,1),(2,14,'ROPA NIÃ‘O',NULL,1),(2,15,'ROPA NIÃ‘A',NULL,1),(1,20,'pez',NULL,1),(1,21,'carnicos',NULL,1),(1,22,'aves',NULL,1),(1,23,'viceras',NULL,1);

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `name` char(250) CHARACTER SET latin1 NOT NULL,
  `address` char(150) CHARACTER SET latin1 DEFAULT NULL,
  `phone` char(20) CHARACTER SET latin1 DEFAULT NULL,
  `city` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `email` char(250) CHARACTER SET latin1 DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `NewIndex1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `clientes` */

insert  into `clientes`(`id`,`name`,`address`,`phone`,`city`,`email`,`status`,`reg_date`) values (1,'CLIENTE POR MOSTRADOR','','','EL CARMEN DE BOLIVAR','',1,'2024-05-04 18:28:49'),(45648520,'enith tapias','cra 51#23-33','314140338','el carmen de bolivar','enisyota201@gimail.com',1,'2024-05-04 18:28:49');

/*Table structure for table `descuento_compras` */

DROP TABLE IF EXISTS `descuento_compras`;

CREATE TABLE `descuento_compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `description` char(250) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FACTURA` (`invoice_id`),
  CONSTRAINT `descuento_compras_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `factura_compras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `descuento_compras` */

/*Table structure for table `detalles_compra` */

DROP TABLE IF EXISTS `detalles_compra`;

CREATE TABLE `detalles_compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `product_id` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `description` char(150) CHARACTER SET latin1 DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `unit_value` double DEFAULT NULL,
  `subtotal_amount` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prod` (`product_id`),
  KEY `FACTURA` (`invoice_id`),
  CONSTRAINT `detalles_compra_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `factura_compras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalles_compra_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `inventario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `detalles_compra` */

/*Table structure for table `detalles_egreso` */

DROP TABLE IF EXISTS `detalles_egreso`;

CREATE TABLE `detalles_egreso` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_egreso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_cuenta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debito` decimal(10,2) NOT NULL,
  `credito` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `detalles_egreso` */

/*Table structure for table `detalles_venta` */

DROP TABLE IF EXISTS `detalles_venta`;

CREATE TABLE `detalles_venta` (
  `invoice_id` int(11) NOT NULL,
  `product_id` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `description` char(150) CHARACTER SET latin1 DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `unit_value` double DEFAULT NULL,
  `subtotal_amount` double DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `id_prod` (`product_id`),
  KEY `FACTURA` (`invoice_id`),
  CONSTRAINT `detalles_venta_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `inventario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalles_venta_ibfk_3` FOREIGN KEY (`invoice_id`) REFERENCES `factura_ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalles_venta_ibfk_4` FOREIGN KEY (`product_id`) REFERENCES `inventario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=867 DEFAULT CHARSET=utf8;

/*Data for the table `detalles_venta` */

/*Table structure for table `devolucion_compra` */

DROP TABLE IF EXISTS `devolucion_compra`;

CREATE TABLE `devolucion_compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `date_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCompra` (`invoice_id`),
  CONSTRAINT `devolucion_compra_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `detalles_compra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  CONSTRAINT `devolucion_venta_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `detalles_venta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `egresos` */

insert  into `egresos`(`VALOR`,`FECHA`,`idGasto`,`RECIBO`,`idEgreso`) values (1430000,'2023-10-09',3,'',0000000001);

/*Table structure for table `empleados` */

DROP TABLE IF EXISTS `empleados`;

CREATE TABLE `empleados` (
  `ID_EMPLEADO` char(15) NOT NULL,
  `NOMBRE1` char(50) DEFAULT NULL,
  `NOMBRE2` char(50) DEFAULT NULL,
  `APELLIDO1` char(50) DEFAULT NULL,
  `APELLIDO2` char(50) DEFAULT NULL,
  `DIR` char(150) DEFAULT NULL,
  `TEL` char(20) DEFAULT NULL,
  `CARGO` char(150) DEFAULT NULL,
  `SALARIO` double DEFAULT NULL,
  `ACTIVO` char(2) DEFAULT NULL,
  `ID_NEGOCIO` int(11) NOT NULL,
  PRIMARY KEY (`ID_EMPLEADO`),
  KEY `EMP` (`ID_NEGOCIO`),
  CONSTRAINT `EMP` FOREIGN KEY (`ID_NEGOCIO`) REFERENCES `negocio` (`IdNegocio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `empleados` */

insert  into `empleados`(`ID_EMPLEADO`,`NOMBRE1`,`NOMBRE2`,`APELLIDO1`,`APELLIDO2`,`DIR`,`TEL`,`CARGO`,`SALARIO`,`ACTIVO`,`ID_NEGOCIO`) values ('1052071180','D0RA','IASBEL','QUEZADA','PAVON','BARRIO EL CARMEN','3145839780','Empleado',900000,'SI',1),('1052083792','ANGELA','MARIA','SANTOS','CORREDOR','BARRIO EL PORVENIR','3014429509','Empleado',720000,'NO',1),('1052954015','YAINA','ROSA','BARRETO','TORRES','BARRIO EL PRADO','3127777612','Empleado',720000,'NO',1),('1193464046','LUISA','ANDREA','SALAS','ESPINOSA','BARRIO BURECHE','3046021445','Empleado',9000000,'NO',1),('45584827','MAIRA','PATRICIA','BINILLA','YEPES','BARRIO LOS MANGOS','3017953903','Empleado',720000,'NO',1),('45648520','ENITH','JOHANA','TAPIAS','ARROYO','BARRIO 1 DE MAYO','3104140338','Empleado',720000,'NO',1),('45648707','CANDELARIA','MARIA','GUZMAN','RIBERA','BARRIO 7 DE AGOSTO','3242954912','Empleado',900000,'SI',1),('73434220','ENEDIER','DAVID','LEGUIA','DOMINGUEZ','BARRIO 1 DE MAYO','3013643169','Empleado',720000,'NO',1),('73434290','ENEIDER','DAVID','LEGUIA','DOMINGUEZ','KRA 51#23-33','3013643169','GERENTE',1000000,'SI',1);

/*Table structure for table `factura_compras` */

DROP TABLE IF EXISTS `factura_compras`;

CREATE TABLE `factura_compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `date_at` date DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `type` char(20) CHARACTER SET latin1 NOT NULL,
  `form_pay` char(25) CHARACTER SET latin1 DEFAULT 'Efectivo',
  `status` char(30) CHARACTER SET latin1 NOT NULL DEFAULT 'Cancelada',
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idCliente` (`supplier_id`),
  CONSTRAINT `factura_compras_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `proveedores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `factura_compras` */

/*Table structure for table `factura_ventas` */

DROP TABLE IF EXISTS `factura_ventas`;

CREATE TABLE `factura_ventas` (
  `client_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_at` date DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `type` char(20) CHARACTER SET latin1 NOT NULL,
  `form_pay` char(25) CHARACTER SET latin1 DEFAULT 'Efectivo',
  `status` char(30) CHARACTER SET latin1 NOT NULL DEFAULT 'Cancelada',
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idCliente` (`client_id`),
  CONSTRAINT `factura_ventas_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=492 DEFAULT CHARSET=utf8;

/*Data for the table `factura_ventas` */

/*Table structure for table `facturastemp` */

DROP TABLE IF EXISTS `facturastemp`;

CREATE TABLE `facturastemp` (
  `FACTURA` int(11) NOT NULL,
  `id_prod` varchar(10) NOT NULL,
  `descripcion` char(150) DEFAULT NULL,
  `CANT` double DEFAULT NULL,
  `ValorUnit` double DEFAULT NULL,
  `SubTotal` double DEFAULT NULL,
  PRIMARY KEY (`FACTURA`,`id_prod`),
  KEY `id_prod` (`id_prod`),
  KEY `FACTURA` (`FACTURA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `facturastemp` */

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
  CONSTRAINT `gas` FOREIGN KEY (`idNegocio`) REFERENCES `negocio` (`IdNegocio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `gastos` */

insert  into `gastos`(`idGasto`,`tipo`,`nombre`,`idNegocio`,`Activo`) values (1,'EnergÃ­a','Recibo de energÃ­a elÃ©ctrica',1,'SI'),(2,'Otros','PAGO DE NOMINAS',1,'SI'),(3,'Arriendo','1430000',1,'SI'),(4,'Mantenimiento/Reparacion','',1,'SI');

/*Table structure for table `inventario` */

DROP TABLE IF EXISTS `inventario`;

CREATE TABLE `inventario` (
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
  CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`measure_id`) REFERENCES `medidas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `inventario` */

insert  into `inventario`(`id`,`name`,`reference`,`purchase_price`,`selling_price`,`initial_quantity`,`purchases`,`sales`,`stock_returns`,`stock`,`min_quantity`,`bussines_id`,`category_id`,`measure_id`) values ('213232','Carne blanda','qqww',23444,34552,245,0,0,0,245,12,1,21,3),('2132321212','Costilla de cerdo','12222',4578,5780,75,0,0,0,96,12,1,21,3),('213233','Carne de la cara','c231131',4567,5678,567,0,0,0,587,2,1,21,4);

/*Table structure for table `medidas` */

DROP TABLE IF EXISTS `medidas`;

CREATE TABLE `medidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bussines_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `short_name` varchar(5) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `register_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `bussines_id` (`bussines_id`),
  CONSTRAINT `medidas_ibfk_1` FOREIGN KEY (`bussines_id`) REFERENCES `negocio` (`IdNegocio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `medidas` */

insert  into `medidas`(`id`,`bussines_id`,`name`,`short_name`,`status`,`register_date`) values (1,2,'Par(es)','PAR',1,'2024-05-01 12:25:26'),(2,1,'Unidad','UND',1,'2024-05-01 12:25:11'),(3,1,'Kilo gramos','KG',1,'2024-05-01 12:25:12'),(4,1,'Libras','LB',1,'2024-05-01 12:25:12'),(5,1,'Gramos','GR',1,'2024-05-01 12:25:13');

/*Table structure for table `negocio` */

DROP TABLE IF EXISTS `negocio`;

CREATE TABLE `negocio` (
  `IdNegocio` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` char(150) DEFAULT NULL,
  `NIT` char(20) DEFAULT NULL,
  `DIRECCION` char(100) DEFAULT NULL,
  `BARRIO` char(50) DEFAULT NULL,
  `CIUDAD` char(50) DEFAULT NULL,
  `TEL` char(25) DEFAULT NULL,
  `correo` char(250) DEFAULT NULL,
  `LOGO` char(250) DEFAULT '0',
  `PROPIETARIO` char(150) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `fechaReg` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdNegocio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `negocio` */

insert  into `negocio`(`IdNegocio`,`NOMBRE`,`NIT`,`DIRECCION`,`BARRIO`,`CIUDAD`,`TEL`,`correo`,`LOGO`,`PROPIETARIO`,`estado`,`fechaReg`) values (1,'DISTRICERDO LA PROMESA','1051443981-8','Mz. E Lote 05','Nelson mandela','Cartagena','3145314592',NULL,'LogoNegocio1.png','ENIS TAPIA',1,'2024-04-13 18:00:16'),(2,'Administrador','45648520-4','KR 51 23-30','EL CENTRO','EL CARMEN DE BOLIVAR','3208981523',NULL,'e&e.png','Luis Tapia',1,'2024-04-13 18:00:16');

/*Table structure for table `pagos` */

DROP TABLE IF EXISTS `pagos`;

CREATE TABLE `pagos` (
  `ID_EMPLEADO` char(15) DEFAULT NULL,
  `VALOR_PAGO` double DEFAULT NULL,
  `FECHA_PAGO` date DEFAULT NULL,
  `recibo` char(20) DEFAULT NULL,
  KEY `FK_pagos` (`ID_EMPLEADO`),
  CONSTRAINT `FK_pagos` FOREIGN KEY (`ID_EMPLEADO`) REFERENCES `empleados` (`ID_EMPLEADO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `pagos` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `proveedores` */

DROP TABLE IF EXISTS `proveedores`;

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `name` char(250) CHARACTER SET latin1 NOT NULL,
  `address` char(150) CHARACTER SET latin1 DEFAULT NULL,
  `phone` char(20) CHARACTER SET latin1 DEFAULT NULL,
  `city` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `email` char(250) CHARACTER SET latin1 DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `NewIndex1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `proveedores` */

insert  into `proveedores`(`id`,`name`,`address`,`phone`,`city`,`email`,`status`,`reg_date`) values (1,'CLIENTE POR MOSTRADOR','','','EL CARMEN DE BOLIVAR','',1,'2024-05-04 18:28:49'),(45648520,'enith tapias','cra 51#23-33','314140338','el carmen de bolivar','enisyota201@gimail.com',1,'2024-05-04 18:28:49');

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
  CONSTRAINT `US` FOREIGN KEY (`IdNegocio`) REFERENCES `negocio` (`IdNegocio`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`Usuario`,`Password`,`Rol`,`IdNegocio`,`primerNombre`,`segundoNombre`,`primerApellido`,`segundoApellido`,`email`,`estado`,`token`,`token_estado`) values ('nelcas08@hotmail.com','198812','Admin',1,'NELSON','DAVID','CASTRO','FLOREZ',NULL,'Activo',NULL,0),('superadmi','123456','Admin',2,'Luiss','David','Tapia','Posada',NULL,'Activo',NULL,0),('superadmin','123456','Admin',1,'Luis','David','Tapia','Posada','josealf7@gmail.com','Activo',NULL,0),('vendedor','123456','Usuario',1,'EL VENDEDOR','DE MODA','',NULL,NULL,'Activo',NULL,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
