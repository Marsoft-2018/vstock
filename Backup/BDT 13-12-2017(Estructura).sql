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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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

/*Table structure for table `departamentos` */

DROP TABLE IF EXISTS `departamentos`;

CREATE TABLE `departamentos` (
  `idDepartamento` int(11) NOT NULL,
  `nombre` char(150) NOT NULL,
  PRIMARY KEY (`idDepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Table structure for table `empleados` */

DROP TABLE IF EXISTS `empleados`;

CREATE TABLE `empleados` (
  `ID_EMPLEADO` char(15) CHARACTER SET latin1 NOT NULL,
  `NOMBRE1` char(50) CHARACTER SET latin1 NOT NULL,
  `NOMBRE2` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `APELLIDO1` char(50) CHARACTER SET latin1 NOT NULL,
  `APELLIDO2` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `DIR` char(150) CHARACTER SET latin1 DEFAULT NULL,
  `TEL` char(20) CHARACTER SET latin1 DEFAULT NULL,
  `CARGO` char(150) CHARACTER SET latin1 NOT NULL,
  `SALARIO` double NOT NULL,
  `ACTIVO` char(2) CHARACTER SET latin1 NOT NULL,
  `ID_NEGOCIO` int(11) NOT NULL,
  PRIMARY KEY (`ID_EMPLEADO`),
  KEY `EMP` (`ID_NEGOCIO`),
  CONSTRAINT `EMP` FOREIGN KEY (`ID_NEGOCIO`) REFERENCES `negocio` (`IdNegocio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

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
  CONSTRAINT `facturascomprasdes_ibfk_2` FOREIGN KEY (`id_prod`) REFERENCES `inventario` (`ID_Prod`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `facturascomprasdes_ibfk_3` FOREIGN KEY (`FACTURA`) REFERENCES `facturasc` (`FACTURA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
  CONSTRAINT `facturasventasdes_ibfk_2` FOREIGN KEY (`id_prod`) REFERENCES `inventario` (`ID_Prod`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `facturasventasdes_ibfk_3` FOREIGN KEY (`FACTURA`) REFERENCES `facturasv` (`FACTURA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

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
  CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`Id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `municipios` */

DROP TABLE IF EXISTS `municipios`;

CREATE TABLE `municipios` (
  `idMunicipio` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `descripcion` char(120) NOT NULL,
  PRIMARY KEY (`idMunicipio`)
) ENGINE=InnoDB DEFAULT CHARSET=dec8;

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

/*Table structure for table `pagos` */

DROP TABLE IF EXISTS `pagos`;

CREATE TABLE `pagos` (
  `ID_EMPLEADO` char(15) DEFAULT NULL,
  `VALOR_PAGO` double DEFAULT NULL,
  `FECHA_PAGO` date DEFAULT NULL,
  `recibo` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`recibo`),
  KEY `FK_pagos` (`ID_EMPLEADO`),
  CONSTRAINT `FK_pagos` FOREIGN KEY (`ID_EMPLEADO`) REFERENCES `empleados` (`ID_EMPLEADO`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

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

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
