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
  `idCredito` int(11) NOT NULL,
  `Cuotas_Abonadas` int(11) DEFAULT NULL,
  `Valor_Abono` double DEFAULT NULL,
  `Saldo_Fecha` double DEFAULT NULL,
  `Fecha_Abono` date DEFAULT NULL,
  KEY `idCredito` (`idCredito`),
  CONSTRAINT `abonos_ibfk_1` FOREIGN KEY (`idCredito`) REFERENCES `facturasv` (`FACTURA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abonos` */

/*Table structure for table `abonosproveedores` */

DROP TABLE IF EXISTS `abonosproveedores`;

CREATE TABLE `abonosproveedores` (
  `idCompra` int(11) DEFAULT NULL,
  `Valor_Abono` double DEFAULT NULL,
  `Saldo_Fecha` double DEFAULT NULL,
  `Fecha_Abono` date DEFAULT NULL,
  `recibo` char(15) DEFAULT NULL,
  KEY `idCompra` (`idCompra`),
  CONSTRAINT `abonosproveedores_ibfk_1` FOREIGN KEY (`idCompra`) REFERENCES `facturasc` (`FACTURA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abonosproveedores` */

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `Id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `Categorias` char(150) NOT NULL,
  PRIMARY KEY (`Id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `categorias` */

insert  into `categorias`(`Id_categoria`,`Categorias`) values (1,'Utiles'),(2,'Libros'),(3,'Equipos');

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
  `correo` char(250) DEFAULT NULL,
  PRIMARY KEY (`ID_cliente`),
  KEY `NewIndex1` (`ID_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `clientes` */

insert  into `clientes`(`ID_cliente`,`Primer_Nombre`,`Segundo_Nombre`,`Primer_Apellido`,`Segundo_Apellido`,`Dir`,`TEL`,`CIUDAD`,`correo`) values (1,'No registra Datos',NULL,NULL,NULL,NULL,NULL,NULL,NULL);

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
  `ID_PROVEEDOR` int(11) DEFAULT NULL,
  `FACTURA` int(11) NOT NULL,
  `FECHA` date DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `tipo` enum('Contado','Credito') NOT NULL,
  PRIMARY KEY (`FACTURA`),
  KEY `ID_PROVEEDOR` (`ID_PROVEEDOR`),
  CONSTRAINT `facturasc_ibfk_1` FOREIGN KEY (`ID_PROVEEDOR`) REFERENCES `proveedores` (`ID_PROVEEDOR`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `facturasc_ibfk_2` FOREIGN KEY (`FACTURA`) REFERENCES `facturascomprasdes` (`FACTURA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `facturasc` */

/*Table structure for table `facturascomprasdes` */

DROP TABLE IF EXISTS `facturascomprasdes`;

CREATE TABLE `facturascomprasdes` (
  `FACTURA` int(11) NOT NULL,
  `id_prod` varchar(10) DEFAULT NULL,
  `CANT` double DEFAULT NULL,
  `descripcion` char(150) DEFAULT NULL,
  `Valor Unit` double DEFAULT NULL,
  `Sub Total` double DEFAULT NULL,
  KEY `FACTURA` (`FACTURA`),
  KEY `id_prod` (`id_prod`),
  CONSTRAINT `facturascomprasdes_ibfk_2` FOREIGN KEY (`id_prod`) REFERENCES `inventario` (`ID_Prod`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `facturascomprasdes` */

/*Table structure for table `facturasv` */

DROP TABLE IF EXISTS `facturasv`;

CREATE TABLE `facturasv` (
  `idCliente` int(11) DEFAULT NULL,
  `FACTURA` int(11) NOT NULL AUTO_INCREMENT,
  `Fec_Venta` date DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `tipo` enum('Contado','Credito') NOT NULL,
  PRIMARY KEY (`FACTURA`),
  KEY `idCliente` (`idCliente`),
  CONSTRAINT `facturasv_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`ID_cliente`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `facturasv` */

/*Table structure for table `facturasventasdes` */

DROP TABLE IF EXISTS `facturasventasdes`;

CREATE TABLE `facturasventasdes` (
  `FACTURA` int(11) NOT NULL,
  `id_prod` varchar(10) DEFAULT NULL,
  `CANT` double DEFAULT NULL,
  `descripcion` char(150) DEFAULT NULL,
  `Valor Unit` double DEFAULT NULL,
  `Sub Total` double DEFAULT NULL,
  KEY `id_prod` (`id_prod`),
  KEY `FACTURA` (`FACTURA`),
  CONSTRAINT `facturasventasdes_ibfk_2` FOREIGN KEY (`id_prod`) REFERENCES `inventario` (`ID_Prod`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `facturasventasdes_ibfk_3` FOREIGN KEY (`FACTURA`) REFERENCES `facturasv` (`FACTURA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `facturasventasdes` */

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
  CONSTRAINT `Cat` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`Id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Inv` FOREIGN KEY (`IdNegocio`) REFERENCES `negocio` (`IdNegocio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `inventario` */

insert  into `inventario`(`ID_Prod`,`ARTICULO`,`REFERENCIA`,`PRECIO_COMPRA`,`PRECIO_VENTA`,`CANT_INICIAL`,`COMPRAS`,`VENTAS`,`DEVOLUCIONES`,`CANT_FINAL`,`CANTIDAD_MIN`,`IdNegocio`,`id_categoria`) values ('0001','Lapiz','mongol',100,250,400,0,0,0,300,NULL,1,1),('0002','Resmas','Carta',9000,9500,270,0,59,4,215,NULL,1,1),('0003','Resmas','Oficio',10500,12000,100,0,25,0,75,NULL,1,1),('0004','CD','Sony',700,1000,120,100,80,0,140,NULL,1,3),('0005','CD','Princo',500,1000,350,0,15,0,335,NULL,1,3),('0006','DVD','TDK',1200,2000,215,0,12,4,207,NULL,1,3),('0007','DVD','Sony',1200,2000,250,5,25,0,230,NULL,1,3),('0008','Lapicero','Bic',700,1000,200,10,15,2,197,NULL,1,1),('0009','TECLADO','LUXUS',25000,30000,32,0,22,0,10,NULL,1,3),('0010','MOUSE','LUXUS',12000,17000,80,0,17,0,63,NULL,1,3),('0011','Monitor','AOC 17\"',370000,450000,5,0,3,0,2,NULL,1,3),('0012','parlantes','luxus',25000,32000,10,0,10,0,0,NULL,1,3),('0013','estabilizador','artelecto 1000 vatios',30000,40000,5,0,0,0,5,NULL,1,3),('0014','SUBWOOFER','GENIUS',70000,95000,12,0,0,0,12,NULL,1,3),('0015','GAME PAD USB','X-KIM',25000,32000,12,0,0,0,12,NULL,1,3);

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

insert  into `negocio`(`IdNegocio`,`NOMBRE`,`NIT`,`DIRECCION`,`BARRIO`,`CIUDAD`,`TEL`,`correo`,`LOGO`,`PROPIETARIO`) values (1,'Papeleria GANDE','1231546','Cll 1 Cra 5','Ovejitas','Ovejas Sucre','1245678','papeleriagande@gmail.com','logo1.gif','Gilberto');

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
  `Correo` char(250) DEFAULT NULL,
  PRIMARY KEY (`ID_PROVEEDOR`),
  KEY `NewIndex1` (`ID_PROVEEDOR`)
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
