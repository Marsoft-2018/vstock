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

/*Table structure for table `abonos` */

DROP TABLE IF EXISTS `abonos`;

CREATE TABLE `abonos` (
  `idCredito` int(11) NOT NULL,
  `cuotasAbonadas` int(11) NOT NULL,
  `valorAbono` double NOT NULL,
  `fechaAbono` date NOT NULL,
  `idAbono` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idAbono`),
  KEY `idCredito` (`idCredito`),
  CONSTRAINT `abonos_ibfk_1` FOREIGN KEY (`idCredito`) REFERENCES `facturasv` (`FACTURA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abonos` */

/*Table structure for table `abonosproveedores` */

DROP TABLE IF EXISTS `abonosproveedores`;

CREATE TABLE `abonosproveedores` (
  `idCompra` int(11) unsigned DEFAULT NULL,
  `cuotasAbonadas` int(11) NOT NULL,
  `Valor_Abono` double NOT NULL,
  `Fecha_Abono` date NOT NULL,
  `recibo` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`recibo`),
  KEY `idCompra` (`idCompra`),
  CONSTRAINT `abonosproveedores_ibfk_1` FOREIGN KEY (`idCompra`) REFERENCES `facturasc` (`FACTURA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abonosproveedores` */

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
  `idCliente` int(11) NOT NULL,
  `Nombre` char(250) CHARACTER SET latin1 NOT NULL,
  `Dir` char(150) CHARACTER SET latin1 DEFAULT NULL,
  `TEL` char(20) CHARACTER SET latin1 DEFAULT NULL,
  `CIUDAD` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `correo` char(250) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`idCliente`),
  KEY `NewIndex1` (`idCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `clientes` */

insert  into `clientes`(`idCliente`,`Nombre`,`Dir`,`TEL`,`CIUDAD`,`correo`) values (1,'CLIENTE POR MOSTRADOR','','','EL CARMEN DE BOLIVAR',''),(45648520,'enith tapias','cra 51#23-33','314140338','el carmen de bolivar','enisyota201@gimail.com');

/*Table structure for table `descuentocompras` */

DROP TABLE IF EXISTS `descuentocompras`;

CREATE TABLE `descuentocompras` (
  `FACTURA` int(11) unsigned NOT NULL,
  `TOTAL` double NOT NULL,
  `Detalle` char(250) DEFAULT NULL,
  `idDescuento` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idDescuento`),
  KEY `FACTURA` (`FACTURA`),
  CONSTRAINT `descuentocompras_ibfk_1` FOREIGN KEY (`FACTURA`) REFERENCES `facturasc` (`FACTURA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `descuentocompras` */

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

/*Table structure for table `devolucioncompra` */

DROP TABLE IF EXISTS `devolucioncompra`;

CREATE TABLE `devolucioncompra` (
  `idDevolucion` int(11) NOT NULL AUTO_INCREMENT,
  `idCompra` int(11) NOT NULL,
  `Cantidad` double NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`idDevolucion`),
  KEY `idCompra` (`idCompra`),
  CONSTRAINT `devolucioncompra_ibfk_1` FOREIGN KEY (`idCompra`) REFERENCES `facturascomprasdes` (`idCompra`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `devolucioncompra` */

/*Table structure for table `devolucionventas` */

DROP TABLE IF EXISTS `devolucionventas`;

CREATE TABLE `devolucionventas` (
  `idDevolucion` int(11) NOT NULL AUTO_INCREMENT,
  `idVenta` int(11) NOT NULL,
  `Cantidad` double NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`idDevolucion`),
  KEY `idVenta` (`idVenta`),
  CONSTRAINT `devolucionventas_ibfk_1` FOREIGN KEY (`idVenta`) REFERENCES `facturasventasdes` (`idVenta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `devolucionventas` */

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

/*Table structure for table `facturasc` */

DROP TABLE IF EXISTS `facturasc`;

CREATE TABLE `facturasc` (
  `idProveedor` char(50) NOT NULL,
  `FACTURA` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `FECHA` date DEFAULT NULL,
  `TOTAL` double NOT NULL,
  `tipo` enum('Contado','Credito') NOT NULL,
  `formaDePago` char(20) DEFAULT NULL,
  `estado` char(30) NOT NULL DEFAULT 'Cancelada',
  `factRegistro` char(30) NOT NULL,
  PRIMARY KEY (`FACTURA`),
  KEY `ID_PROVEEDOR` (`idProveedor`),
  KEY `FACTURA` (`FACTURA`),
  CONSTRAINT `facturasc_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;

/*Data for the table `facturasc` */

/*Table structure for table `facturascomprasdes` */

DROP TABLE IF EXISTS `facturascomprasdes`;

CREATE TABLE `facturascomprasdes` (
  `FACTURA` int(11) unsigned NOT NULL,
  `id_prod` varchar(10) DEFAULT NULL,
  `descripcion` char(150) DEFAULT NULL,
  `CANT` double DEFAULT NULL,
  `ValorUnit` double DEFAULT NULL,
  `SubTotal` double DEFAULT NULL,
  `idCompra` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idCompra`),
  KEY `id_prod` (`id_prod`),
  KEY `FACTURA` (`FACTURA`),
  CONSTRAINT `facturascomprasdes_ibfk_2` FOREIGN KEY (`id_prod`) REFERENCES `inventario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `facturascomprasdes_ibfk_3` FOREIGN KEY (`FACTURA`) REFERENCES `facturasc` (`FACTURA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=541 DEFAULT CHARSET=latin1;

/*Data for the table `facturascomprasdes` */

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

/*Table structure for table `facturasv` */

DROP TABLE IF EXISTS `facturasv`;

CREATE TABLE `facturasv` (
  `idCliente` int(11) DEFAULT NULL,
  `FACTURA` int(11) NOT NULL AUTO_INCREMENT,
  `Fec_Venta` date DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `tipo` char(20) NOT NULL,
  `formaPago` char(25) DEFAULT 'Efectivo',
  `estado` char(30) NOT NULL DEFAULT 'Cancelada',
  PRIMARY KEY (`FACTURA`),
  KEY `idCliente` (`idCliente`),
  CONSTRAINT `facturasv_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=492 DEFAULT CHARSET=latin1;

/*Data for the table `facturasv` */

/*Table structure for table `facturasventasdes` */

DROP TABLE IF EXISTS `facturasventasdes`;

CREATE TABLE `facturasventasdes` (
  `FACTURA` int(11) NOT NULL,
  `id_prod` varchar(10) DEFAULT NULL,
  `descripcion` char(150) DEFAULT NULL,
  `CANT` double DEFAULT NULL,
  `ValorUnit` double DEFAULT NULL,
  `SubTotal` double DEFAULT NULL,
  `idVenta` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idVenta`),
  KEY `id_prod` (`id_prod`),
  KEY `FACTURA` (`FACTURA`),
  CONSTRAINT `facturasventasdes_ibfk_2` FOREIGN KEY (`id_prod`) REFERENCES `inventario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `facturasventasdes_ibfk_3` FOREIGN KEY (`FACTURA`) REFERENCES `facturasv` (`FACTURA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=867 DEFAULT CHARSET=latin1;

/*Data for the table `facturasventasdes` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `failed_jobs` */

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

insert  into `inventario`(`id`,`name`,`reference`,`purchase_price`,`selling_price`,`initial_quantity`,`purchases`,`sales`,`stock_returns`,`stock`,`min_quantity`,`bussines_id`,`category_id`,`measure_id`) values ('14578212','prueba','545465',5000,14000,10,0,0,0,10,2,1,22,3),('213232','Carne blanda','qqww',23444,34552,245,0,0,0,245,12,1,21,3),('213233','Carne de la cara','qqww',45678,56788,567,0,0,0,587,2,1,21,4),('234578','Presidente','qqww',46500,56400,5,0,0,0,15,10,1,21,2);

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

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

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

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_reset_tokens` */

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
  `idProveedor` char(50) NOT NULL DEFAULT '0',
  `Nombre` char(250) NOT NULL,
  `Dir` char(150) DEFAULT NULL,
  `TEL` char(20) DEFAULT NULL,
  `CIUDAD` char(50) DEFAULT NULL,
  `Correo` char(250) DEFAULT NULL,
  PRIMARY KEY (`idProveedor`),
  KEY `NewIndex1` (`idProveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `proveedores` */

insert  into `proveedores`(`idProveedor`,`Nombre`,`Dir`,`TEL`,`CIUDAD`,`Correo`) values ('830503366-0','impormar de colombia','bazurto calle del platano','3219973365','cartagena de indias',''),('900733933-7','punta del este','bosque diag 21 n47-63','3008089194','cartagena de indias',''),('901444005-0','pollopez cartagena','prado transv  35 nÂº36-143','3005709882','cartagena',''),('901511715-9','alcata group','barranquilla','3116167960','barranquilla','');

/*Table structure for table `puc` */

DROP TABLE IF EXISTS `puc`;

CREATE TABLE `puc` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clasificacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `puc` */

/*Table structure for table `user1` */

DROP TABLE IF EXISTS `user1`;

CREATE TABLE `user1` (
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

/*Data for the table `user1` */

insert  into `user1`(`Usuario`,`Password`,`Rol`,`IdNegocio`,`primerNombre`,`segundoNombre`,`primerApellido`,`segundoApellido`,`email`,`estado`,`token`,`token_estado`) values ('nelcas08@hotmail.com','198812','Admin',1,'NELSON','DAVID','CASTRO','FLOREZ',NULL,'Activo',NULL,0),('superadmi','123456','Admin',2,'Luiss','David','Tapia','Posada',NULL,'Activo',NULL,0),('superadmin','123456','Admin',1,'Luis','David','Tapia','Posada','josealf7@gmail.com','Activo',NULL,0),('vendedor','123456','Usuario',1,'EL VENDEDOR','DE MODA','',NULL,NULL,'Activo',NULL,0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values (1,'Luis tapia','ldtapiaposada@gmail.com',NULL,'$2y$12$k8CFi/mFaidGSkRAwUdXoOWpCnYHG6d48kzhG/YW4UceSo3ZgHD6a',NULL,'2024-03-21 03:25:24','2024-03-21 03:25:24');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
