/*
SQLyog Ultimate v11.11 (64 bit)
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
  `Id_cliente` int(11) NOT NULL,
  `Id_Prod` char(10) NOT NULL,
  `Fecha_venta` date DEFAULT NULL,
  `Cuotas_Abonadas` int(11) DEFAULT NULL,
  `Valor_Abono` double DEFAULT NULL,
  `Saldo_Fecha` double DEFAULT NULL,
  `Fecha_Abono` date DEFAULT NULL,
  KEY `FK_abonos` (`Id_cliente`),
  CONSTRAINT `FK_abonos` FOREIGN KEY (`Id_cliente`) REFERENCES `creditos` (`Id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abonos` */

/*Table structure for table `abonosproveedores` */

DROP TABLE IF EXISTS `abonosproveedores`;

CREATE TABLE `abonosproveedores` (
  `Id_PROVEEDOR` int(11) NOT NULL DEFAULT '0',
  `Id_Prod` char(10) NOT NULL DEFAULT '',
  `Fecha_venta` date DEFAULT NULL,
  `Valor_Abono` double DEFAULT NULL,
  `Saldo_Fecha` double DEFAULT NULL,
  `Fecha_Abono` date DEFAULT NULL,
  `recibo` char(15) DEFAULT NULL,
  KEY `FK_abonos` (`Id_PROVEEDOR`),
  CONSTRAINT `FK_abonosproveedores` FOREIGN KEY (`Id_PROVEEDOR`) REFERENCES `comprascreditos` (`Id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abonosproveedores` */

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `ID_cliente` int(11) NOT NULL,
  `Primer_Nombre` char(50) DEFAULT NULL,
  `Segundo_Nombre` char(50) DEFAULT NULL,
  `Primer_Apellido` char(50) DEFAULT NULL,
  `Segundo_Apellido` char(50) DEFAULT NULL,
  `Dir` char(150) DEFAULT NULL,
  `TEL` char(20) DEFAULT NULL,
  `CIUDAD` char(50) DEFAULT NULL,
  PRIMARY KEY (`ID_cliente`),
  KEY `NewIndex1` (`ID_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `clientes` */

/*Table structure for table `comprascreditos` */

DROP TABLE IF EXISTS `comprascreditos`;

CREATE TABLE `comprascreditos` (
  `Id_proveedor` int(11) NOT NULL DEFAULT '0',
  `Id_Prod` char(10) NOT NULL DEFAULT '',
  `cantidad` int(11) DEFAULT NULL,
  `Valor_Venta` double DEFAULT NULL,
  `Fecha_Venta` date DEFAULT NULL,
  `valor_cuota` double DEFAULT NULL,
  `Saldo` double DEFAULT NULL,
  `FACTURA` varchar(5) NOT NULL DEFAULT '',
  `F_pago` char(10) DEFAULT NULL,
  KEY `FK_creditos` (`Id_proveedor`),
  KEY `FK_comprascreditosF` (`FACTURA`),
  CONSTRAINT `FK_comprascreditosF` FOREIGN KEY (`FACTURA`) REFERENCES `facturasc` (`FACTURA`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_comprascreditosP` FOREIGN KEY (`Id_proveedor`) REFERENCES `proveedores` (`ID_PROVEEDOR`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `comprascreditos` */

/*Table structure for table `creditos` */

DROP TABLE IF EXISTS `creditos`;

CREATE TABLE `creditos` (
  `Id_cliente` int(11) NOT NULL,
  `Id_Prod` char(10) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `Valor_Venta` double DEFAULT NULL,
  `Fecha_Venta` date DEFAULT NULL,
  `valor_cuota` double DEFAULT NULL,
  `Numero_Cuotas` int(11) DEFAULT NULL,
  `Cuotas_Faltantes` int(11) DEFAULT NULL,
  `Saldo` double DEFAULT NULL,
  `FACTURA` varchar(5) NOT NULL,
  KEY `FK_creditos` (`Id_cliente`),
  CONSTRAINT `FK_creditos` FOREIGN KEY (`Id_cliente`) REFERENCES `clientes` (`ID_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `creditos` */

/*Table structure for table `egresos` */

DROP TABLE IF EXISTS `egresos`;

CREATE TABLE `egresos` (
  `IdNegocio` int(11) NOT NULL,
  `VALOR` double NOT NULL,
  `FECHA` date NOT NULL,
  `ID_GASTO` char(15) NOT NULL,
  `RECIBO` char(20) NOT NULL,
  KEY `FK_egresos` (`ID_GASTO`)
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
  `FACTURA` varchar(5) NOT NULL DEFAULT '',
  `PROVEEDOR` char(150) DEFAULT NULL,
  `FECHA` date DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  PRIMARY KEY (`FACTURA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `facturasc` */

/*Table structure for table `facturasv` */

DROP TABLE IF EXISTS `facturasv`;

CREATE TABLE `facturasv` (
  `FACTURA` varchar(5) NOT NULL DEFAULT '',
  `CLIENTE` char(150) DEFAULT NULL,
  `FECHA` date DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  PRIMARY KEY (`FACTURA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `facturasv` */

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
  `ID` varchar(10) NOT NULL DEFAULT '',
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
  PRIMARY KEY (`ID`),
  KEY `Inv` (`IdNegocio`),
  CONSTRAINT `Inv` FOREIGN KEY (`IdNegocio`) REFERENCES `negocio` (`IdNegocio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `inventario` */

insert  into `inventario`(`ID`,`ARTICULO`,`REFERENCIA`,`PRECIO_COMPRA`,`PRECIO_VENTA`,`CANT_INICIAL`,`COMPRAS`,`VENTAS`,`DEVOLUCIONES`,`CANT_FINAL`,`CANTIDAD_MIN`,`IdNegocio`) values ('0001','Lapiz','mongol',100,250,400,0,0,0,300,NULL,1),('0002','Resmas','Carta',9000,9500,270,0,59,4,215,NULL,1),('0003','Resmas','Oficio',10500,12000,100,0,25,0,75,NULL,1),('0004','CD','Sony',700,1000,120,100,80,0,140,NULL,1),('0005','CD','Princo',500,1000,350,0,15,0,335,NULL,1),('0006','DVD','TDK',1200,2000,215,0,12,4,207,NULL,1),('0007','DVD','Sony',1200,2000,250,5,25,0,230,NULL,1),('0008','Lapicero','Bic',700,1000,200,10,15,2,197,NULL,1),('0009','TECLADO','LUXUS',25000,30000,32,0,22,0,10,NULL,1),('0010','MOUSE','LUXUS',12000,17000,80,0,17,0,63,NULL,1),('0011','Monitor','AOC 17\"',370000,450000,5,0,3,0,2,NULL,1),('0012','parlantes','luxus',25000,32000,10,0,10,0,0,NULL,1),('0013','estabilizador','artelecto 1000 vatios',30000,40000,5,0,0,0,5,NULL,1),('0014','SUBWOOFER','GENIUS',70000,95000,12,0,0,0,12,NULL,1),('0015','GAME PAD USB','X-KIM',25000,32000,12,0,0,0,12,NULL,1);

/*Table structure for table `movimientos` */

DROP TABLE IF EXISTS `movimientos`;

CREATE TABLE `movimientos` (
  `ID` varchar(10) NOT NULL,
  `CANTIDAD` double DEFAULT NULL,
  `VALOR_UNITARIO` double DEFAULT NULL,
  `VALOR_TOTAL` double DEFAULT NULL,
  `GANANCIA` double DEFAULT NULL,
  `TIPO_MOVIMIENTO` enum('Compra','Venta','Devolucion','Venta a Credito','Compra a Credito') DEFAULT NULL,
  `FECHA` date DEFAULT NULL,
  `FACTURA` varchar(5) NOT NULL,
  KEY `FK_movimientos` (`ID`),
  CONSTRAINT `FK_movimientos` FOREIGN KEY (`ID`) REFERENCES `inventario` (`ID`)
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
  `PROPIETARIO` char(150) DEFAULT NULL,
  PRIMARY KEY (`IdNegocio`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `negocio` */

insert  into `negocio`(`IdNegocio`,`NOMBRE`,`NIT`,`DIRECCION`,`BARRIO`,`CIUDAD`,`TEL`,`PROPIETARIO`) values (1,'Papeleria GANDE','1231546',NULL,NULL,'Ovejas Sucre','1245678','Gilberto');

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
  `ID_PROVEEDOR` int(11) NOT NULL DEFAULT '0',
  `Primer_Nombre` char(50) DEFAULT NULL,
  `Segundo_Nombre` char(50) DEFAULT NULL,
  `Primer_Apellido` char(50) DEFAULT NULL,
  `Segundo_Apellido` char(50) DEFAULT NULL,
  `Dir` char(150) DEFAULT NULL,
  `TEL` char(20) DEFAULT NULL,
  `CIUDAD` char(50) DEFAULT NULL,
  PRIMARY KEY (`ID_PROVEEDOR`),
  KEY `NewIndex1` (`ID_PROVEEDOR`),
  CONSTRAINT `FK_proveedores` FOREIGN KEY (`ID_PROVEEDOR`) REFERENCES `compras _creditos` (`Id_PROVEEDOR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `proveedores` */

/*Table structure for table `user1` */

DROP TABLE IF EXISTS `user1`;

CREATE TABLE `user1` (
  `Usuario` varchar(150) NOT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Rol` enum('Admin','Usuario') DEFAULT NULL,
  `IdNegocio` int(11) NOT NULL,
  PRIMARY KEY (`Usuario`),
  KEY `US` (`IdNegocio`),
  CONSTRAINT `US` FOREIGN KEY (`IdNegocio`) REFERENCES `negocio` (`IdNegocio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user1` */

insert  into `user1`(`Usuario`,`Password`,`Rol`,`IdNegocio`) values ('Admin','123','Admin',1),('Usuario1','123','Usuario',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
