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
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cuentas` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cuentas`;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `categorias` */

insert  into `categorias`(`idNegocio`,`Id_categoria`,`Categorias`) values (1,3,'Prueba'),(1,5,'Cosas'),(1,6,'Otra Cosa');

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

insert  into `clientes`(`idCliente`,`Nombre`,`Dir`,`TEL`,`CIUDAD`,`correo`) values (1,'CLIENTE POR MOSTRADOR','','','EL CARMEN DE BOLIVAR','');

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
  `formaDePago` char(20) DEFAULT NULL,
  `estado` char(30) NOT NULL DEFAULT 'Cancelada',
  PRIMARY KEY (`FACTURA`),
  KEY `ID_PROVEEDOR` (`idProveedor`),
  CONSTRAINT `facturasc_ibfk_2` FOREIGN KEY (`FACTURA`) REFERENCES `facturascomprasdes` (`FACTURA`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `facturasc_ibfk_3` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `facturasc` */

insert  into `facturasc`(`idProveedor`,`FACTURA`,`FECHA`,`TOTAL`,`tipo`,`formaDePago`,`estado`) values (1,1,'2017-06-08',252000,'Contado','Efectivo','Cancelada'),(1,2,'2017-06-16',4000,'Contado','Efectivo','Cancelada'),(1,3,'2017-06-16',625000,'Contado','Efectivo','Cancelada');

/*Table structure for table `facturascomprasdes` */

DROP TABLE IF EXISTS `facturascomprasdes`;

CREATE TABLE `facturascomprasdes` (
  `FACTURA` int(11) NOT NULL,
  `id_prod` varchar(10) DEFAULT NULL,
  `descripcion` char(150) DEFAULT NULL,
  `CANT` double DEFAULT NULL,
  `ValorUnit` double DEFAULT NULL,
  `SubTotal` double DEFAULT NULL,
  KEY `FACTURA` (`FACTURA`),
  KEY `id_prod` (`id_prod`),
  CONSTRAINT `facturascomprasdes_ibfk_2` FOREIGN KEY (`id_prod`) REFERENCES `inventario` (`ID_Prod`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `facturascomprasdes` */

insert  into `facturascomprasdes`(`FACTURA`,`id_prod`,`descripcion`,`CANT`,`ValorUnit`,`SubTotal`) values (1,'423','Descripcion 1',10,25000,250000),(1,'73','Descripcion 2',10,200,2000),(2,'73','NUevo - 123',20,200,4000),(3,'423','Articulo 123 - asd1',25,25000,625000);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `facturasv` */

insert  into `facturasv`(`idCliente`,`FACTURA`,`Fec_Venta`,`TOTAL`,`tipo`,`formaPago`,`estado`) values (1,1,'2017-06-07',125000,'contado','Efectivo','Cancelada'),(1,2,'2017-06-08',50000,'contado','Efectivo','Cancelada'),(1,3,'2017-06-16',2000,'contado','Efectivo','Cancelada'),(1,4,'2017-06-16',1000,'contado','Efectivo','Cancelada'),(1,5,'2017-06-16',1000,'contado','Efectivo','Cancelada'),(1,6,'2017-06-16',1000,'contado','Efectivo','Cancelada'),(1,7,'2017-06-16',1000,'contado','Efectivo','Cancelada'),(1,8,'2017-06-16',50000,'contado','Efectivo','Cancelada'),(1,9,'2017-06-16',25000,'contado','Efectivo','Cancelada'),(1,10,'2017-06-16',125000,'contado','Efectivo','Cancelada');

/*Table structure for table `facturasventasdes` */

DROP TABLE IF EXISTS `facturasventasdes`;

CREATE TABLE `facturasventasdes` (
  `FACTURA` int(11) NOT NULL,
  `id_prod` varchar(10) DEFAULT NULL,
  `descripcion` char(150) DEFAULT NULL,
  `CANT` double DEFAULT NULL,
  `ValorUnit` double DEFAULT NULL,
  `SubTotal` double DEFAULT NULL,
  KEY `id_prod` (`id_prod`),
  KEY `FACTURA` (`FACTURA`),
  CONSTRAINT `facturasventasdes_ibfk_2` FOREIGN KEY (`id_prod`) REFERENCES `inventario` (`ID_Prod`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `facturasventasdes_ibfk_3` FOREIGN KEY (`FACTURA`) REFERENCES `facturasv` (`FACTURA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `facturasventasdes` */

insert  into `facturasventasdes`(`FACTURA`,`id_prod`,`descripcion`,`CANT`,`ValorUnit`,`SubTotal`) values (1,'423','Articulo 123 - asd1',5,25000,125000),(2,'423','Articulo 123 - asd1',2,25000,50000),(3,'73','NUevo - 123',10,200,2000),(4,'73','NUevo - 123',5,200,1000),(5,'73','NUevo - 123',5,200,1000),(6,'73','NUevo - 123',5,200,1000),(7,'73','NUevo - 123',5,200,1000),(8,'423','Articulo 123 - asd1',2,25000,50000),(9,'423','Articulo 123 - asd1',1,25000,25000),(10,'423','Articulo 123 - asd1',5,25000,125000);

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

insert  into `inventario`(`ID_Prod`,`ARTICULO`,`REFERENCIA`,`PRECIO_COMPRA`,`PRECIO_VENTA`,`CANT_INICIAL`,`COMPRAS`,`VENTAS`,`DEVOLUCIONES`,`CANT_FINAL`,`CANTIDAD_MIN`,`IdNegocio`,`id_categoria`) values ('423','Articulo 123','asd1',23000,25000,0,35,15,0,20,3,1,3),('73','NUevo','123',100,200,0,30,30,0,0,11,1,6);

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
  CONSTRAINT `FK_movimientos` FOREIGN KEY (`ID_prod`) REFERENCES `inventario` (`ID_Prod`) ON DELETE CASCADE ON UPDATE CASCADE
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

insert  into `proveedores`(`idProveedor`,`Nombre`,`Dir`,`TEL`,`CIUDAD`,`Correo`) values (1,'Proveedor 1','','','EL CARMEN DE BOLIVAR',''),(2,'Proveedor 2','','','EL CARMEN DE BOLIVAR','');

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
  CONSTRAINT `US` FOREIGN KEY (`IdNegocio`) REFERENCES `negocio` (`IdNegocio`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user1` */

insert  into `user1`(`Usuario`,`Password`,`Rol`,`IdNegocio`,`primerNombre`,`segundoNombre`,`primerApellido`,`segundoApellido`,`email`,`estado`) values ('Admin','123','Admin',1,'Jose','Alfredo','Tapia','Arroyo','josealf7@gmail.com','Activo'),('Usuario1','123','Usuario',1,'Usuario',NULL,'1',NULL,NULL,'Activo');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
