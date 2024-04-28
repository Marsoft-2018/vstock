/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.0.15-nt : Database - cuentas2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`cuentas2` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cuentas2`;

/*Table structure for table `abonos` */

DROP TABLE IF EXISTS `abonos`;

CREATE TABLE `abonos` (
  `Id_cliente` int(11) NOT NULL,
  `Id_Prod` char(10) NOT NULL,
  `Fecha_venta` date default NULL,
  `Valor_Abono` double default NULL,
  `Saldo_Fecha` double default NULL,
  `Fecha_Abono` date default NULL,
  `recibo` char(15) default NULL,
  KEY `FK_abonos` (`Id_cliente`),
  CONSTRAINT `FK_abonos` FOREIGN KEY (`Id_cliente`) REFERENCES `creditos` (`Id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abonos` */

/*Table structure for table `abonosproveedores` */

DROP TABLE IF EXISTS `abonosproveedores`;

CREATE TABLE `abonosproveedores` (
  `Id_PROVEEDOR` int(11) NOT NULL default '0',
  `Id_Prod` char(10) NOT NULL default '',
  `Fecha_venta` date default NULL,
  `Valor_Abono` double default NULL,
  `Saldo_Fecha` double default NULL,
  `Fecha_Abono` date default NULL,
  `recibo` char(15) default NULL,
  KEY `FK_abonos` (`Id_PROVEEDOR`),
  CONSTRAINT `FK_abonosproveedores` FOREIGN KEY (`Id_PROVEEDOR`) REFERENCES `comprascreditos` (`Id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abonosproveedores` */

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `ID_cliente` int(11) NOT NULL,
  `Primer_Nombre` char(50) default NULL,
  `Segundo_Nombre` char(50) default NULL,
  `Primer_Apellido` char(50) default NULL,
  `Segundo_Apellido` char(50) default NULL,
  `Dir` char(150) default NULL,
  `TEL` char(20) default NULL,
  PRIMARY KEY  (`ID_cliente`),
  KEY `NewIndex1` (`ID_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `clientes` */

/*Table structure for table `comprascreditos` */

DROP TABLE IF EXISTS `comprascreditos`;

CREATE TABLE `comprascreditos` (
  `Id_proveedor` int(11) NOT NULL default '0',
  `Id_Prod` char(10) NOT NULL default '',
  `cantidad` int(11) default NULL,
  `Valor_Venta` double default NULL,
  `Fecha_Venta` date default NULL,
  `valor_cuota` double default NULL,
  `Saldo` double default NULL,
  `FACTURA` varchar(5) NOT NULL default '',
  `F_pago` char(10) default NULL,
  KEY `FK_creditos` (`Id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `comprascreditos` */

/*Table structure for table `creditos` */

DROP TABLE IF EXISTS `creditos`;

CREATE TABLE `creditos` (
  `Id_cliente` int(11) NOT NULL,
  `Id_Prod` char(10) NOT NULL,
  `cantidad` int(11) default NULL,
  `Valor_Venta` double default NULL,
  `Fecha_Venta` date default NULL,
  `valor_cuota` double default NULL,
  `Saldo` double default NULL,
  `FACTURA` varchar(5) NOT NULL,
  `F_pago` char(10) default NULL,
  KEY `FK_creditos` (`Id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `creditos` */

/*Table structure for table `egresos` */

DROP TABLE IF EXISTS `egresos`;

CREATE TABLE `egresos` (
  `VALOR` double default NULL,
  `FECHA` date default NULL,
  `ID_GASTO` char(15) default NULL,
  `RECIBO` char(20) default NULL,
  KEY `FK_egresos` (`ID_GASTO`),
  CONSTRAINT `FK_egresos` FOREIGN KEY (`ID_GASTO`) REFERENCES `gastos` (`ID_GASTO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `egresos` */

/*Table structure for table `empleados` */

DROP TABLE IF EXISTS `empleados`;

CREATE TABLE `empleados` (
  `ID_EMPLEADO` char(15) NOT NULL,
  `NOMBRE1` char(50) default NULL,
  `NOMBRE2` char(50) default NULL,
  `APELLIDO1` char(50) default NULL,
  `APELLIDO2` char(50) default NULL,
  `DIR` char(150) default NULL,
  `TEL` char(20) default NULL,
  `CARGO` char(150) default NULL,
  `SALARIO` double default NULL,
  `ACTIVO` char(2) default NULL,
  `ID_NEGOCIO` char(3) default NULL,
  PRIMARY KEY  (`ID_EMPLEADO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `empleados` */

/*Table structure for table `facturasc` */

DROP TABLE IF EXISTS `facturasc`;

CREATE TABLE `facturasc` (
  `FACTURA` varchar(5) NOT NULL default '',
  `PROVEEDOR` char(150) default NULL,
  `FECHA` date default NULL,
  `TOTAL` double default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `facturasc` */

/*Table structure for table `facturasv` */

DROP TABLE IF EXISTS `facturasv`;

CREATE TABLE `facturasv` (
  `FACTURA` varchar(5) NOT NULL default '',
  `CLIENTE` char(150) default NULL,
  `FECHA` date default NULL,
  `TOTAL` double default NULL,
  PRIMARY KEY  (`FACTURA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `facturasv` */

/*Table structure for table `gastos` */

DROP TABLE IF EXISTS `gastos`;

CREATE TABLE `gastos` (
  `ID_GASTO` char(15) NOT NULL default '',
  `TIPO` char(150) default NULL,
  `ACTIVO` char(2) default NULL,
  PRIMARY KEY  (`ID_GASTO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `gastos` */

/*Table structure for table `inventario` */

DROP TABLE IF EXISTS `inventario`;

CREATE TABLE `inventario` (
  `ID` varchar(10) NOT NULL default '',
  `ARTICULO` varchar(600) default NULL,
  `REFERENCIA` varchar(150) default NULL,
  `PRECIO_COMPRA` double default '0',
  `PRECIO_VENTA` double default '0',
  `CANT_INICIAL` double default '0',
  `COMPRAS` double default '0',
  `VENTAS` double default '0',
  `DEVOLUCIONES` double default '0',
  `CANT_FINAL` double default '0',
  `CANTIDAD_MIN` double default '0',
  `NEGOCIO` char(3) default NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `inventario` */

/*Table structure for table `movimientos` */

DROP TABLE IF EXISTS `movimientos`;

CREATE TABLE `movimientos` (
  `ID` varchar(10) NOT NULL,
  `CANTIDAD` double default NULL,
  `VALOR_UNITARIO` double default NULL,
  `VALOR_TOTAL` double default NULL,
  `GANANCIA` double default NULL,
  `TIPO_MOVIMIENTO` enum('Compra','Venta','Devolucion','Venta a Credito','Compra a Credito') default NULL,
  `FECHA` date default NULL,
  `FACTURA` varchar(5) NOT NULL,
  KEY `FK_movimientos` (`ID`),
  CONSTRAINT `FK_movimientos` FOREIGN KEY (`ID`) REFERENCES `inventario` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `movimientos` */

/*Table structure for table `negocio` */

DROP TABLE IF EXISTS `negocio`;

CREATE TABLE `negocio` (
  `ID` char(3) default NULL,
  `NOMBRE` char(150) default NULL,
  `NIT` char(20) default NULL,
  `DIRECCION` char(100) default NULL,
  `BARRIO` char(50) default NULL,
  `CIUDAD` char(50) default NULL,
  `TEL` char(25) default NULL,
  `PROPIETARIO` char(150) default NULL,
  `LOGO` char(255) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `negocio` */

insert  into `negocio`(`ID`,`NOMBRE`,`NIT`,`DIRECCION`,`BARRIO`,`CIUDAD`,`TEL`,`PROPIETARIO`,`LOGO`) values ('2','CALZA FACIL','1','CALLE 24','CENTRO','EL CARMEN DE BOLÍVAR','13','1','LOGONEGOCIO.PNG');

/*Table structure for table `pagos` */

DROP TABLE IF EXISTS `pagos`;

CREATE TABLE `pagos` (
  `ID_EMPLEADO` char(15) default NULL,
  `VALOR_PAGO` double default NULL,
  `FECHA_PAGO` date default NULL,
  `recibo` char(20) default NULL,
  KEY `FK_pagos` (`ID_EMPLEADO`),
  CONSTRAINT `FK_pagos` FOREIGN KEY (`ID_EMPLEADO`) REFERENCES `empleados` (`ID_EMPLEADO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `pagos` */

/*Table structure for table `proveedores` */

DROP TABLE IF EXISTS `proveedores`;

CREATE TABLE `proveedores` (
  `ID_PROVEEDOR` int(11) NOT NULL default '0',
  `Primer_Nombre` char(50) default NULL,
  `Segundo_Nombre` char(50) default NULL,
  `Primer_Apellido` char(50) default NULL,
  `Segundo_Apellido` char(50) default NULL,
  `Dir` char(150) default NULL,
  `TEL` char(20) default NULL,
  PRIMARY KEY  (`ID_PROVEEDOR`),
  KEY `NewIndex1` (`ID_PROVEEDOR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `proveedores` */

/*Table structure for table `user1` */

DROP TABLE IF EXISTS `user1`;

CREATE TABLE `user1` (
  `Usuario` varchar(150) default NULL,
  `Password` varchar(45) default NULL,
  `Rol` enum('Admin','Usuario') default NULL,
  `NEGOCIO` char(3) default NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user1` */

insert  into `user1`(`Usuario`,`Password`,`Rol`,`NEGOCIO`) values ('Admin','123','Admin','2');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
