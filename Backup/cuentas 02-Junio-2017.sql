/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.6.21 : Database - cuentas
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*CREATE DATABASE `cuentas` 

USE `cuentas`;*/

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `abonos` */

insert  into `abonos`(`idCredito`,`cuotasAbonadas`,`valorAbono`,`fechaAbono`,`idAbono`) values (4,1,3750,'2017-05-31',1);

/*Table structure for table `abonosproveedores` */

DROP TABLE IF EXISTS `abonosproveedores`;

CREATE TABLE `abonosproveedores` (
  `idCompra` int(11) DEFAULT NULL,
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
  `idNegocio` int(11) NOT NULL,
  `Id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `Categorias` char(150) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`Id_categoria`),
  KEY `idNegocio` (`idNegocio`),
  CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`idNegocio`) REFERENCES `negocio` (`IdNegocio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `categorias` */

insert  into `categorias`(`idNegocio`,`Id_categoria`,`Categorias`) values (1,1,'Utiles'),(1,2,'Libros'),(1,3,'Equipos');

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

insert  into `clientes`(`idCliente`,`Nombre`,`Dir`,`TEL`,`CIUDAD`,`correo`) values (1,'CLIENTE POR MOSTRADOR','','','EL CARMEN DE BOLIVAR',''),(45649358,'Norelis Garizao','Barrio 7 de Agosto','3147402140','EL CARMEN DE BOLIVAR',''),(73429935,'JOSE','CRA 47A #31-50 BARRIO 7 DE AGOSTO','3107358169','EL CARMEN DE BOL','josealf7@gmail.com'),(73432225,'LUIS','BARRIO LAS MARGARITAS','3101216478','EL CARMEN DE BOLIVAR','luchoperez@hotmail.com'),(1052073118,'Mariana Tapia Garizao','Barrio 7 de Agosto','3107358169','EL CARMEN DE BOLÃVAR','jose@gmail.com'),(1103214652,'Edwin','El Tendal','3014554752','EL CARMEN DE BOLIVAR','edsantos@hotmail.com');

/*Table structure for table `egresos` */

DROP TABLE IF EXISTS `egresos`;

CREATE TABLE `egresos` (
  `IdNegocio` int(11) NOT NULL,
  `VALOR` double NOT NULL,
  `FECHA` date NOT NULL,
  `ID_GASTO` char(15) NOT NULL,
  `RECIBO` char(20) NOT NULL,
  KEY `FK_egresos` (`ID_GASTO`),
  KEY `FKegresos` (`IdNegocio`),
  CONSTRAINT `FKegresos` FOREIGN KEY (`IdNegocio`) REFERENCES `negocio` (`IdNegocio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `egresos` */

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

/*Table structure for table `facturasc` */

DROP TABLE IF EXISTS `facturasc`;

CREATE TABLE `facturasc` (
  `idProveedor` int(11) DEFAULT NULL,
  `FACTURA` int(11) NOT NULL,
  `FECHA` date DEFAULT NULL,
  `TOTAL` double NOT NULL,
  `tipo` enum('Contado','Credito') NOT NULL,
  `formaDePago` char(1) DEFAULT NULL,
  `estado` char(30) NOT NULL DEFAULT 'Cancelada',
  PRIMARY KEY (`FACTURA`),
  KEY `ID_PROVEEDOR` (`idProveedor`),
  CONSTRAINT `facturasc_ibfk_2` FOREIGN KEY (`FACTURA`) REFERENCES `facturascomprasdes` (`FACTURA`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `facturasc_ibfk_3` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `facturasc` */

/*Table structure for table `facturascomprasdes` */

DROP TABLE IF EXISTS `facturascomprasdes`;

CREATE TABLE `facturascomprasdes` (
  `FACTURA` int(11) NOT NULL,
  `id_prod` varchar(10) DEFAULT NULL,
  `CANT` double DEFAULT NULL,
  `descripcion` char(150) DEFAULT NULL,
  `ValorUnit` double DEFAULT NULL,
  `SubTotal` double DEFAULT NULL,
  KEY `FACTURA` (`FACTURA`),
  KEY `id_prod` (`id_prod`),
  CONSTRAINT `facturascomprasdes_ibfk_2` FOREIGN KEY (`id_prod`) REFERENCES `inventario` (`ID_Prod`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `facturascomprasdes` */

/*Table structure for table `facturastemp` */

DROP TABLE IF EXISTS `facturastemp`;

CREATE TABLE `facturastemp` (
  `FACTURA` int(11) NOT NULL,
  `id_prod` varchar(10) DEFAULT NULL,
  `descripcion` char(150) DEFAULT NULL,
  `CANT` double DEFAULT NULL,
  `ValorUnit` double DEFAULT NULL,
  `SubTotal` double DEFAULT NULL,
  KEY `id_prod` (`id_prod`),
  KEY `FACTURA` (`FACTURA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `facturastemp` */

insert  into `facturastemp`(`FACTURA`,`id_prod`,`descripcion`,`CANT`,`ValorUnit`,`SubTotal`) values (15,'0011','Monitor - AOC 17\"',5,450000,2250000);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `facturasv` */

insert  into `facturasv`(`idCliente`,`FACTURA`,`Fec_Venta`,`TOTAL`,`tipo`,`formaPago`,`estado`) values (73429935,1,'2015-11-05',502000,'contado','Efectivo','Cancelada'),(73429935,2,'2015-11-05',5000,'contado','Efectivo','Cancelada'),(73429935,3,'2015-11-05',160000,'credito','Quincenal','Por Pagar'),(73429935,4,'2015-11-05',3750,'credito','Mensual','Cancelada'),(73429935,5,'2015-11-05',6250,'contado','Efectivo','Cancelada'),(73429935,6,'2015-11-05',11500,'contado','Efectivo','Cancelada'),(73429935,7,'2015-11-06',20000,'contado','Efectivo','Cancelada'),(73429935,8,'2015-11-06',190000,'credito','Mensual','Por Pagar'),(73432225,9,'2015-11-10',1200000,'contado','Efectivo','Cancelada'),(1103214652,10,'2015-11-11',750000,'credito','Semanal','Por Pagar'),(1,11,'2017-05-23',5000,'contado','Efectivo','Cancelada'),(1,12,'2017-05-25',70000,'contado','Efectivo','Cancelada'),(45649358,13,'2017-06-01',285000,'credito','mensual','Por Pagar'),(1052073118,14,'2017-06-01',450000,'credito','mensual','Por Pagar');

/*Table structure for table `facturasventasdes` */

DROP TABLE IF EXISTS `facturasventasdes`;

CREATE TABLE `facturasventasdes` (
  `FACTURA` int(11) NOT NULL,
  `id_prod` varchar(10) DEFAULT NULL,
  `CANT` double DEFAULT NULL,
  `descripcion` char(150) DEFAULT NULL,
  `ValorUnit` double DEFAULT NULL,
  `SubTotal` double DEFAULT NULL,
  KEY `id_prod` (`id_prod`),
  KEY `FACTURA` (`FACTURA`),
  CONSTRAINT `facturasventasdes_ibfk_2` FOREIGN KEY (`id_prod`) REFERENCES `inventario` (`ID_Prod`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `facturasventasdes_ibfk_3` FOREIGN KEY (`FACTURA`) REFERENCES `facturasv` (`FACTURA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `facturasventasdes` */

insert  into `facturasventasdes`(`FACTURA`,`id_prod`,`CANT`,`descripcion`,`ValorUnit`,`SubTotal`) values (1,'0006',0,'10',2000,20000),(1,'0011',0,'1',450000,450000),(1,'0015',0,'1',32000,32000),(2,'0004',0,'5',1000,5000),(3,'0013',0,'4',40000,160000),(4,'0001',0,'15',250,3750),(5,'0001',0,'25',250,6250),(6,'0001',0,'46',250,11500),(7,'0007',0,'10',2000,20000),(8,'0014',0,'2',95000,190000),(9,'0016',0,'2',375000,750000),(9,'0011',0,'1',450000,450000),(10,'0016',0,'2',375000,750000),(11,'0005',0,'5',1000,5000),(12,'0017',0,'4',17500,70000),(13,'0014',0,'3',95000,285000),(14,'0011',0,'1',450000,450000);

/*Table structure for table `gastos` */

DROP TABLE IF EXISTS `gastos`;

CREATE TABLE `gastos` (
  `ID_GASTO` int(11) NOT NULL AUTO_INCREMENT,
  `TIPO` char(150) DEFAULT NULL,
  `ACTIVO` char(2) DEFAULT NULL,
  `IdNegocio` int(11) NOT NULL,
  PRIMARY KEY (`ID_GASTO`),
  KEY `gas` (`IdNegocio`),
  CONSTRAINT `gas` FOREIGN KEY (`IdNegocio`) REFERENCES `negocio` (`IdNegocio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `gastos` */

/*Table structure for table `inventario` */

DROP TABLE IF EXISTS `inventario`;

CREATE TABLE `inventario` (
  `ID_Prod` varchar(10) NOT NULL DEFAULT '',
  `ARTICULO` varchar(600) DEFAULT NULL,
  `REFERENCIA` varchar(150) DEFAULT NULL,
  `PRECIO_COMPRA` double DEFAULT '0',
  `PRECIO_VENTA` double DEFAULT '0',
  `CANT_INICIAL` double DEFAULT '0',
  `COMPRAS` double DEFAULT '0',
  `VENTAS` double DEFAULT '0',
  `DEVOLUCIONES` double DEFAULT '0',
  `CANT_FINAL` double DEFAULT '0',
  `CANTIDAD_MIN` int(11) DEFAULT NULL,
  `IdNegocio` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`ID_Prod`),
  KEY `Inv` (`IdNegocio`),
  KEY `Cat` (`id_categoria`),
  CONSTRAINT `Inv` FOREIGN KEY (`IdNegocio`) REFERENCES `negocio` (`IdNegocio`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`Id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `inventario` */

insert  into `inventario`(`ID_Prod`,`ARTICULO`,`REFERENCIA`,`PRECIO_COMPRA`,`PRECIO_VENTA`,`CANT_INICIAL`,`COMPRAS`,`VENTAS`,`DEVOLUCIONES`,`CANT_FINAL`,`CANTIDAD_MIN`,`IdNegocio`,`id_categoria`) values ('0001','Lapiz','Mongol',100,250,400,0,46,0,354,45,1,1),('0002','Resmas','Carta',9000,9500,270,0,59,4,215,6,1,1),('0003','Resmas','Oficio',10500,13000,100,0,25,0,75,4,1,1),('0004','CD','Sony',700,1000,120,100,80,0,140,NULL,1,3),('0005','CD','Princo',500,1000,350,0,20,0,330,NULL,1,3),('0006','DVD','TDK',1200,2000,215,0,12,4,207,NULL,1,3),('0007','DVD','Sony',1200,2000,250,5,35,0,220,NULL,1,3),('0008','Lapicero','Bic',700,1000,200,10,15,2,197,NULL,1,1),('0009','TECLADO','LUXUS',25000,30000,32,0,22,0,10,NULL,1,3),('0010','MOUSE','LUXUS',12000,17000,80,0,17,0,63,NULL,1,3),('0011','Monitor','AOC 17\"',370000,450000,5,0,5,0,0,3,1,3),('0012','PARLANTES','luxus',25000,32000,10,0,10,0,0,2,1,3),('0013','estabilizador','artelecto 1000 vatios',30000,40000,5,0,0,0,5,3,1,3),('0014','SUBWOOFER','GENIUS',70000,95000,12,0,6,0,6,2,1,3),('0015','GAME PAD USB','X-KIM',25000,32000,12,0,0,0,12,5,1,3),('0016','Tajeta De video','Nvidia ti600',320000,375000,12,0,4,0,8,3,1,3),('0017','Prueba de ingreso','prb',15200,17500,14,0,4,0,10,2,1,3);

/*Table structure for table `movimientos` */

DROP TABLE IF EXISTS `movimientos`;

CREATE TABLE `movimientos` (
  `ID_prod` varchar(10) NOT NULL,
  `CANTIDAD` double DEFAULT NULL,
  `VALOR_UNITARIO` double DEFAULT NULL,
  `VALOR_TOTAL` double DEFAULT NULL,
  `GANANCIA` double DEFAULT NULL,
  `TIPO_MOVIMIENTO` enum('Compra','Venta','Devolucion','Venta a Credito','Compra a Credito') DEFAULT NULL,
  `FECHA` date DEFAULT NULL,
  `FACTURA` varchar(5) NOT NULL,
  KEY `FK_movimientos` (`ID_prod`),
  CONSTRAINT `FK_movimientos` FOREIGN KEY (`ID_prod`) REFERENCES `inventario` (`ID_Prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `movimientos` */

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
  `LOGO` char(250) DEFAULT 'logo1.gif',
  `PROPIETARIO` char(150) DEFAULT NULL,
  PRIMARY KEY (`IdNegocio`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `negocio` */

insert  into `negocio`(`IdNegocio`,`NOMBRE`,`NIT`,`DIRECCION`,`BARRIO`,`CIUDAD`,`TEL`,`correo`,`LOGO`,`PROPIETARIO`) values (1,'MULTIVARIEDADES MUNDO MAGICO','1231546','Cll 25 Kra 48','El Centro','El Carmen de BolÃ­var','','correodelnegocio@gmail.com','LogoNegocio1.png','Yair RomaÃ±a');

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

/*Table structure for table `proveedores` */

DROP TABLE IF EXISTS `proveedores`;

CREATE TABLE `proveedores` (
  `idProveedor` int(11) NOT NULL DEFAULT '0',
  `Nombre` char(250) NOT NULL,
  `Dir` char(150) DEFAULT NULL,
  `TEL` char(20) DEFAULT NULL,
  `CIUDAD` char(50) DEFAULT NULL,
  `Correo` char(250) DEFAULT NULL,
  PRIMARY KEY (`idProveedor`),
  KEY `NewIndex1` (`idProveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `proveedores` */

insert  into `proveedores`(`idProveedor`,`Nombre`,`Dir`,`TEL`,`CIUDAD`,`Correo`) values (1052270,'Proveedor','casae','1456789','EL CARMEN DE BOLIVAR','');

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
  PRIMARY KEY (`Usuario`),
  KEY `US` (`IdNegocio`),
  CONSTRAINT `US` FOREIGN KEY (`IdNegocio`) REFERENCES `negocio` (`IdNegocio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user1` */

insert  into `user1`(`Usuario`,`Password`,`Rol`,`IdNegocio`,`primerNombre`,`segundoNombre`,`primerApellido`,`segundoApellido`,`email`,`estado`) values ('Admin','123','Admin',1,'Jose','Alfredo','Tapia','Arroyo','josealf7@gmail.com','Activo'),('Usuario1','123','Usuario',1,'Usuario',NULL,'1',NULL,NULL,'Activo');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
