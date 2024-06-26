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
  `idCompra` int(11) unsigned DEFAULT NULL,
  `cuotasAbonadas` int(11) NOT NULL,
  `Valor_Abono` double NOT NULL,
  `Fecha_Abono` date NOT NULL,
  `recibo` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`recibo`),
  KEY `idCompra` (`idCompra`),
  CONSTRAINT `abonosproveedores_ibfk_1` FOREIGN KEY (`idCompra`) REFERENCES `facturasc` (`FACTURA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `abonosproveedores` */

insert  into `abonosproveedores`(`idCompra`,`cuotasAbonadas`,`Valor_Abono`,`Fecha_Abono`,`recibo`) values (1,2,75000,'2017-12-08',1),(1,1,1000000,'2017-12-09',2),(1,1,104000,'2017-12-09',4);

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

insert  into `categorias`(`idNegocio`,`Id_categoria`,`Categorias`) values (1,1,'Calzado NiÃ±o'),(1,2,'Calzado NiÃ±a'),(1,3,'Calzado Hombre'),(1,6,'Calzado Damas');

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

insert  into `clientes`(`idCliente`,`Nombre`,`Dir`,`TEL`,`CIUDAD`,`correo`) values (1,'CLIENTE POR MOSTRADOR','','','EL CARMEN DE BOLIVAR',''),(7456871,'FULANITO DE TAL','CARASDA','301245678','EL CARMEN','joaseaa@gmatko.com');

/*Table structure for table `departamentos` */

DROP TABLE IF EXISTS `departamentos`;

CREATE TABLE `departamentos` (
  `idDepartamento` int(11) NOT NULL,
  `nombre` char(150) NOT NULL,
  PRIMARY KEY (`idDepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `departamentos` */

insert  into `departamentos`(`idDepartamento`,`nombre`) values (1,'Amazonas'),(2,'Antioquia'),(3,'Arauca'),(4,'Atlántico'),(5,'Bolívar'),(6,'Boyacá'),(7,'Caldas'),(8,'Caquetá'),(9,'Casanare'),(10,'Cauca'),(11,'Cesar'),(12,'Chocó'),(13,'Córdoba'),(14,'Cundinamarca'),(15,'Guainía'),(16,'Guaviare'),(17,'Huila'),(18,'Guajira'),(19,'Madgalena'),(20,'Meta'),(21,'Nariño'),(22,'Norte de Santander'),(23,'Putumayo'),(24,'Quindío'),(25,'Risaralda'),(26,'San Andrés'),(27,'Santander'),(28,'Sucre'),(29,'Tolima'),(30,'Valle del Cauca'),(31,'Vaupés'),(32,'Vichada');

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

/*Data for the table `descuentocompras` */

insert  into `descuentocompras`(`FACTURA`,`TOTAL`,`Detalle`,`idDescuento`) values (2,170000,'Decuento por fletes',1),(3,80000,'Otro descuento',2);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `egresos` */

insert  into `egresos`(`VALOR`,`FECHA`,`idGasto`,`RECIBO`,`idEgreso`) values (52000,'2017-10-01',1,'012456',0000000001),(52000,'2017-10-21',1,'1234567',0000000003);

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

/*Data for the table `empleados` */

insert  into `empleados`(`ID_EMPLEADO`,`NOMBRE1`,`NOMBRE2`,`APELLIDO1`,`APELLIDO2`,`DIR`,`TEL`,`CARGO`,`SALARIO`,`ACTIVO`,`ID_NEGOCIO`) values ('1325476','Luis','Eduardo','Perez','Ramirez','Las Margaritas','3131254','Empleado',150000,'si',1),('45624564','Maria','Angelica','Torres','Montes','cl 1','310123','Empleado',50000,'si',1),('4678','Luisa','','asdasd','','fdsfsd','234','Empleado',45600,'NO',1),('73429935','Jose','Alfredo','Tapia','Arroyo','barrio 7 de agosto','123123','Empleado',1200000,'si',1);

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

/*Data for the table `facturasc` */

insert  into `facturasc`(`idProveedor`,`FACTURA`,`FECHA`,`TOTAL`,`tipo`,`formaDePago`,`estado`,`factRegistro`) values ('92025501-1',1,'2017-10-12',1179000,'Credito','Efectivo','Cancelada','4571'),('92025501-1',2,'2017-09-28',1170000,'Credito','Efectivo','Por Pagar','4569'),('890114924',3,'2017-09-27',2788668.8,'Credito','Efectivo','Por Pagar','2009'),('91246395',4,'2017-10-14',4240000,'Credito','Efectivo','Por Pagar','0129'),('91246395',5,'2017-10-14',4270000,'Credito','Efectivo','Por Pagar','0119'),('64696123',6,'2017-10-04',954000,'Credito','Efectivo','Por Pagar','2693'),('92543563',7,'2017-09-12',1980000,'Credito','Efectivo','Por Pagar','0092'),('92543563',8,'2017-09-18',1792000,'Credito','Efectivo','Por Pagar','0104'),('92543563',9,'2017-09-14',6416000,'Credito','Efectivo','Por Pagar','0119'),('91499637',10,'2017-09-17',1084000,'Credito','Efectivo','Por Pagar','0138'),('1098784085',11,'2017-09-04',2661000,'Credito','Efectivo','Por Pagar','0217'),('8452',12,'2017-10-11',2266000,'Credito','Efectivo','Por Pagar','8452'),('1018420492',13,'2017-10-09',3096000,'Credito','Efectivo','Por Pagar','0366'),('700043627',14,'2017-09-16',1456000,'Credito','Efectivo','Por Pagar','2122'),('39449689-4',15,'2017-09-04',3366000,'Credito','Efectivo','Por Pagar','4259'),('21323131212',16,'2017-09-27',768000,'Credito','Efectivo','Por Pagar','4473'),('91251081',17,'2017-10-18',1260000,'Credito','Efectivo','Por Pagar','0463'),('91251081',18,'2017-10-18',1680000,'Credito','Efectivo','Por Pagar','0470'),('1098784085',19,'2017-10-02',4100000,'Credito','Efectivo','Por Pagar','0218'),('32869670',20,'2017-10-09',2789000,'Credito','Efectivo','Por Pagar','4067'),('1098784085',21,'2017-09-01',3525000,'Credito','Efectivo','Por Pagar','0212'),('91499637',22,'2017-09-17',928000,'Credito','Efectivo','Por Pagar','0127'),('92543563',23,'2017-09-26',1204000,'Credito','Efectivo','Por Pagar','0114'),('1102858058',24,'2017-09-25',2688000,'Credito','Efectivo','Por Pagar','0252'),('1098694229-4',25,'2017-10-09',1368000,'Credito','Efectivo','Por Pagar','0488'),('901030678-9',26,'2017-09-02',1485000,'Credito','Efectivo','Por Pagar','0497'),('92025501-1',27,'2017-10-06',996000,'Credito','Efectivo','Por Pagar','4570'),('70691267',28,'2017-09-15',1140000,'Credito','Efectivo','Por Pagar','0219'),('91281400-9',29,'2017-09-25',3270000,'Credito','Efectivo','Por Pagar','6339'),('91281400-9',30,'2017-10-03',2180000,'Credito','Efectivo','Por Pagar','6334'),('700043627',31,'2017-09-23',1940000,'Credito','Efectivo','Por Pagar','2425'),('64696123',32,'2017-10-12',945000,'Credito','Efectivo','Por Pagar','2698');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `facturasv` */

insert  into `facturasv`(`idCliente`,`FACTURA`,`Fec_Venta`,`TOTAL`,`tipo`,`formaPago`,`estado`) values (1,1,'2017-10-13',24000,'credito','Credito','Por Pagar'),(1,2,'2017-10-28',260000,'contado','Efectivo','Cancelada'),(1,3,'2017-11-01',349000,'contado','Efectivo','Cancelada'),(1,4,'2017-11-06',96000,'contado','Efectivo','Cancelada');

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

/*Data for the table `facturasventasdes` */

insert  into `facturasventasdes`(`FACTURA`,`id_prod`,`descripcion`,`CANT`,`ValorUnit`,`SubTotal`,`idVenta`) values (4,'30252733','ZAPATILLAS NIÃ‘O SPERPIS - RF3025',2,48000,96000,7);

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

insert  into `gastos`(`idGasto`,`tipo`,`nombre`,`idNegocio`,`Activo`) values (1,'Arriendo','Arriendo del local',1,'No'),(2,'Arriendo','Arriendo Local',1,'No'),(3,'Arriendo','Arrendamiento del local',1,'No'),(4,'Arriendo','Arrendamiento del Local',1,'SI');

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

/*Data for the table `inventario` */

insert  into `inventario`(`ID_Prod`,`ARTICULO`,`REFERENCIA`,`PRECIO_COMPRA`,`PRECIO_VENTA`,`CANT_INICIAL`,`COMPRAS`,`VENTAS`,`DEVOLUCIONES`,`CANT_FINAL`,`CANTIDAD_MIN`,`IdNegocio`,`id_categoria`) values ('0443843','ZAPATO DEPORTIVO NIKE','R044',38000,75000,0,20,0,0,20,1,1,3),('1093743','CALZADO SPERPIS HOMBRE','RF 109',28000,60000,0,40,0,0,40,1,1,3),('1253843','SPORT HOMBRE YUANBU HOMBRE','RF BRT125',20833,38000,0,36,0,0,36,1,1,3),('14853943','SANDALIAS BRAHAMA KL','KL1485',65627,85000,0,12,0,0,12,1,1,3),('16133740','SPORT HOMBRE','RF JJSA 1613',86000,150000,0,18,0,0,18,1,1,3),('16342326','SANDALIAS ZHARILUZ NIÃ‘A','RF1634',23000,45000,0,8,0,0,8,1,1,2),('16592326','SANDALIAS ZHZRILUZ NIÃ‘A','RF',23000,45000,0,8,0,0,8,1,1,2),('16602326','SANDALIAS ZHARILUZ NIÃ‘A','RF1660',23000,45000,0,8,0,0,8,1,1,2),('17033943','SPORT HOMBRE SURTIDO','RF 1703',48000,85000,0,12,0,0,12,1,1,3),('17232334','Sandalia Elegancia NiÃ±a','1723',15000,30000,0,48,0,0,48,1,1,2),('202736','BOTAS NIÃ‘OS ','RF20',25000,55000,0,60,0,0,60,1,1,1),('2102733','VALETAS VALENTINA NIÃ‘A','RF210',22000,37000,0,0,0,0,0,1,1,2),('2103437','VALETAS VALENTINA NIÃ‘A','RF210',24000,40000,0,0,0,0,0,1,1,2),('22803943','SANDALIA BRAHAMA','RA2280',37157.7,55000,0,24,0,0,24,1,1,3),('30243743','CALZADO SPERPIS','RF3025',28000,60000,0,0,0,0,0,1,1,3),('30252126','ZAPATILLAS NIÃ‘O SPERPIS','RF 3025',22000,48000,0,12,0,0,12,1,1,1),('30252733','ZAPATILLAS NIÃ‘O SPERPIS','RF3025',24000,48000,0,12,2,0,10,1,1,1),('30253743','CALZADO SPERPIS','RF 3025',28000,60000,0,62,0,0,62,1,1,3),('302736','SPORT NIÃ‘O','RF30',25000,49000,0,45,0,0,45,1,1,1),('3092733','SANDALIAS ZHARILUZ ','RF309',25000,45000,0,10,0,0,10,1,1,2),('3272733','SANDALIAS NIÃ‘A ','RF327',25000,45000,0,10,0,0,10,1,1,2),('352736','DEPORTIVO DE NIÃ‘O','RF35',25000,49000,0,60,0,0,60,1,1,1),('3812733','SANDALIAS ZHZRILUZ NIÃ‘A','RF381',25000,45000,0,10,0,0,10,1,1,2),('3822733','SANDALIAS ZHARILUZ NIÃ‘A','RF382',25000,45000,0,10,0,0,10,1,1,2),('3872126','BALETA NIÃ‘A','RF 387',16000,35000,0,21,0,0,21,1,1,2),('3872733','BALETA NIÃ‘A','RF387',17000,35000,0,16,0,0,16,1,1,2),('3952126','BALETAS NIÃ‘AS ','395',16000,35000,0,36,0,0,36,1,1,2),('3952733','BALETAS NIÃ‘AS','RF 395',17000,35000,0,42,0,0,42,1,1,2),('3962126','BALETAS NIÃ‘AS','RF 396',16000,35000,0,27,0,0,27,1,1,2),('3962733','SANDALIAS ZHARILUZ NIÃ‘A   ','RF396',25000,45000,0,10,0,0,10,1,1,2),('39627330','BALETA NIÃ‘A','RF396',17000,35000,0,27,0,0,27,1,1,2),('412735','SPOTR NIÃ‘A','RF41',25000,49000,0,29,0,0,29,1,1,2),('452735','SPORT NIÃ‘A','RF45',25000,49000,0,30,0,0,30,1,1,2),('5102736','VANS NIÃ‘O','RF510',25000,55000,0,75,0,0,75,1,1,1),('5103743','VANS DE HOMBRE','RF510',30000,65000,0,55,0,0,55,1,1,3),('55933943','SPORT TIPO CONVERS ','RF 5593',35000,65000,0,12,0,0,12,1,1,3),('7092123','VALETAS VALENTINA NIÃ‘A','RF709',19000,35000,0,0,0,0,0,1,1,2),('7092126','VALETAS VALENTINA NIÃ‘A','RF709',19000,35000,0,0,0,0,0,1,1,2),('7092733','VALETAS VALENTINA NIÃ‘A','RF709',22000,37000,0,0,0,0,0,1,1,2),('7182126','VALETAS VALENTINA NIÃ‘A','RF718',19000,35000,0,0,0,0,0,1,1,2),('7182733','VALETAS VALENTINA NIÃ‘A','RF718',22000,37000,0,0,0,0,0,1,1,2),('7183437','VALETAS VALENTINA NIÃ‘A','RF718',24000,40000,0,0,0,0,0,1,1,2),('7302126','VALETAS VALENTINA NIÃ‘A','RF730',19000,35000,0,0,0,0,0,1,1,2),('7302733','VALETAS VALENTINA NIÃ‘A','RF730',22000,37000,0,0,0,0,0,1,1,2),('7303437','VALETAS VALENTINA NIÃ‘A','RF730',22000,37000,0,0,0,0,0,1,1,2),('8123743','SPORT HOMBRE ','RF 812',65000,130000,0,6,0,0,6,1,1,3),('9092126','SANDALIAS VALENTINA NIÃ‘A','RF 709',19000,35000,0,0,0,0,0,1,1,2),('9092733','VALETAS VALENTINA NIÃ‘A','RF709',22000,37000,0,0,0,0,0,1,1,2);

/*Table structure for table `municipios` */

DROP TABLE IF EXISTS `municipios`;

CREATE TABLE `municipios` (
  `idMunicipio` int(11) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `descripcion` char(120) NOT NULL,
  PRIMARY KEY (`idMunicipio`)
) ENGINE=InnoDB DEFAULT CHARSET=dec8;

/*Data for the table `municipios` */

insert  into `municipios`(`idMunicipio`,`idDepartamento`,`descripcion`) values (1,1,'Leticia'),(2,1,'Puerto Nariño'),(3,2,'Abejorral'),(4,2,'Abriaquí'),(5,2,'Alejandria'),(6,2,'Amagá'),(7,2,'Amalfi'),(8,2,'Andes'),(9,2,'Angelópolis'),(10,2,'Angostura'),(11,2,'Anorí'),(12,2,'Anzá'),(13,2,'Apartadó'),(14,2,'Arboletes'),(15,2,'Argelia'),(16,2,'Armenia'),(17,2,'Barbosa'),(18,2,'Bello'),(19,2,'Belmira'),(20,2,'Betania'),(21,2,'Betulia'),(22,2,'Bolívar'),(23,2,'Briceño'),(24,2,'Burítica'),(25,2,'Caicedo'),(26,2,'Caldas'),(27,2,'Campamento'),(28,2,'Caracolí'),(29,2,'Caramanta'),(30,2,'Carepa'),(31,2,'Carmen de Viboral'),(32,2,'Carolina'),(33,2,'Caucasia'),(34,2,'Cañasgordas'),(35,2,'Chigorodó'),(36,2,'Cisneros'),(37,2,'Cocorná'),(38,2,'Concepción'),(39,2,'Concordia'),(40,2,'Copacabana'),(41,2,'Cáceres'),(42,2,'Dabeiba'),(43,2,'Don Matías'),(44,2,'Ebéjico'),(45,2,'El Bagre'),(46,2,'Entrerríos'),(47,2,'Envigado'),(48,2,'Fredonia'),(49,2,'Frontino'),(50,2,'Giraldo'),(51,2,'Girardota'),(52,2,'Granada'),(53,2,'Guadalupe'),(54,2,'Guarne'),(55,2,'Guatapé'),(56,2,'Gómez Plata'),(57,2,'Heliconia'),(58,2,'Hispania'),(59,2,'Itagüí'),(60,2,'Ituango'),(61,2,'Jardín'),(62,2,'Jericó'),(63,2,'La Ceja'),(64,2,'La Estrella'),(65,2,'La Pintada'),(66,2,'La Unión'),(67,2,'Liborina'),(68,2,'Maceo'),(69,2,'Marinilla'),(70,2,'Medellín'),(71,2,'Montebello'),(72,2,'Murindó'),(73,2,'Mutatá'),(74,2,'Nariño'),(75,2,'Nechí'),(76,2,'Necoclí'),(77,2,'Olaya'),(78,2,'Peque'),(79,2,'Peñol'),(80,2,'Pueblorrico'),(81,2,'Puerto Berrío'),(82,2,'Puerto Nare'),(83,2,'Puerto Triunfo'),(84,2,'Remedios'),(85,2,'Retiro'),(86,2,'Ríonegro'),(87,2,'Sabanalarga'),(88,2,'Sabaneta'),(89,2,'Salgar'),(90,2,'San Andrés de Cuerquía'),(91,2,'San Carlos'),(92,2,'San Francisco'),(93,2,'San Jerónimo'),(94,2,'San José de Montaña'),(95,2,'San Juan de Urabá'),(96,2,'San Luís'),(97,2,'San Pedro'),(98,2,'San Pedro de Urabá'),(99,2,'San Rafael'),(100,2,'San Roque'),(101,2,'San Vicente'),(102,2,'Santa Bárbara'),(103,2,'Santa Fé de Antioquia'),(104,2,'Santa Rosa de Osos'),(105,2,'Santo Domingo'),(106,2,'Santuario'),(107,2,'Segovia'),(108,2,'Sonsón'),(109,2,'Sopetrán'),(110,2,'Tarazá'),(111,2,'Tarso'),(112,2,'Titiribí'),(113,2,'Toledo'),(114,2,'Turbo'),(115,2,'Támesis'),(116,2,'Uramita'),(117,2,'Urrao'),(118,2,'Valdivia'),(119,2,'Valparaiso'),(120,2,'Vegachí'),(121,2,'Venecia'),(122,2,'Vigía del Fuerte'),(123,2,'Yalí'),(124,2,'Yarumal'),(125,2,'Yolombó'),(126,2,'Yondó (Casabe)'),(127,2,'Zaragoza'),(128,3,'Arauca'),(129,3,'Arauquita'),(130,3,'Cravo Norte'),(131,3,'Fortúl'),(132,3,'Puerto Rondón'),(133,3,'Saravena'),(134,3,'Tame'),(135,4,'Baranoa'),(136,4,'Barranquilla'),(137,4,'Campo de la Cruz'),(138,4,'Candelaria'),(139,4,'Galapa'),(140,4,'Juan de Acosta'),(141,4,'Luruaco'),(142,4,'Malambo'),(143,4,'Manatí'),(144,4,'Palmar de Varela'),(145,4,'Piojo'),(146,4,'Polonuevo'),(147,4,'Ponedera'),(148,4,'Puerto Colombia'),(149,4,'Repelón'),(150,4,'Sabanagrande'),(151,4,'Sabanalarga'),(152,4,'Santa Lucía'),(153,4,'Santo Tomás'),(154,4,'Soledad'),(155,4,'Suan'),(156,4,'Tubará'),(157,4,'Usiacuri'),(158,5,'Achí'),(159,5,'Altos del Rosario'),(160,5,'Arenal'),(161,5,'Arjona'),(162,5,'Arroyohondo'),(163,5,'Barranco de Loba'),(164,5,'Calamar'),(165,5,'Cantagallo'),(166,5,'Cartagena'),(167,5,'Cicuco'),(168,5,'Clemencia'),(169,5,'Córdoba'),(170,5,'El Carmen de Bolívar'),(171,5,'El Guamo'),(172,5,'El Peñon'),(173,5,'Hatillo de Loba'),(174,5,'Magangué'),(175,5,'Mahates'),(176,5,'Margarita'),(177,5,'María la Baja'),(178,5,'Mompós'),(179,5,'Montecristo'),(180,5,'Morales'),(181,5,'Norosí'),(182,5,'Pinillos'),(183,5,'Regidor'),(184,5,'Río Viejo'),(185,5,'San Cristobal'),(186,5,'San Estanislao'),(187,5,'San Fernando'),(188,5,'San Jacinto'),(189,5,'San Jacinto del Cauca'),(190,5,'San Juan de Nepomuceno'),(191,5,'San Martín de Loba'),(192,5,'San Pablo'),(193,5,'Santa Catalina'),(194,5,'Santa Rosa'),(195,5,'Santa Rosa del Sur'),(196,5,'Simití'),(197,5,'Soplaviento'),(198,5,'Talaigua Nuevo'),(199,5,'Tiquisio (Puerto Rico)'),(200,5,'Turbaco'),(201,5,'Turbaná'),(202,5,'Villanueva'),(203,5,'Zambrano'),(204,6,'Almeida'),(205,6,'Aquitania'),(206,6,'Arcabuco'),(207,6,'Belén'),(208,6,'Berbeo'),(209,6,'Beteitiva'),(210,6,'Boavita'),(211,6,'Boyacá'),(212,6,'Briceño'),(213,6,'Buenavista'),(214,6,'Busbanza'),(215,6,'Caldas'),(216,6,'Campohermoso'),(217,6,'Cerinza'),(218,6,'Chinavita'),(219,6,'Chiquinquirá'),(220,6,'Chiscas'),(221,6,'Chita'),(222,6,'Chitaraque'),(223,6,'Chivatá'),(224,6,'Chíquiza'),(225,6,'Chívor'),(226,6,'Ciénaga'),(227,6,'Coper'),(228,6,'Corrales'),(229,6,'Covarachía'),(230,6,'Cubará'),(231,6,'Cucaita'),(232,6,'Cuitiva'),(233,6,'Cómbita'),(234,6,'Duitama'),(235,6,'El Cocuy'),(236,6,'El Espino'),(237,6,'Firavitoba'),(238,6,'Floresta'),(239,6,'Gachantivá'),(240,6,'Garagoa'),(241,6,'Guacamayas'),(242,6,'Guateque'),(243,6,'Guayatá'),(244,6,'Guicán'),(245,6,'Gámeza'),(246,6,'Izá'),(247,6,'Jenesano'),(248,6,'Jericó'),(249,6,'La Capilla'),(250,6,'La Uvita'),(251,6,'La Victoria'),(252,6,'Labranzagrande'),(253,6,'Macanal'),(254,6,'Maripí'),(255,6,'Miraflores'),(256,6,'Mongua'),(257,6,'Monguí'),(258,6,'Moniquirá'),(259,6,'Motavita'),(260,6,'Muzo'),(261,6,'Nobsa'),(262,6,'Nuevo Colón'),(263,6,'Oicatá'),(264,6,'Otanche'),(265,6,'Pachavita'),(266,6,'Paipa'),(267,6,'Pajarito'),(268,6,'Panqueba'),(269,6,'Pauna'),(270,6,'Paya'),(271,6,'Paz de Río'),(272,6,'Pesca'),(273,6,'Pisva'),(274,6,'Puerto Boyacá'),(275,6,'Páez'),(276,6,'Quipama'),(277,6,'Ramiriquí'),(278,6,'Rondón'),(279,6,'Ráquira'),(280,6,'Saboyá'),(281,6,'Samacá'),(282,6,'San Eduardo'),(283,6,'San José de Pare'),(284,6,'San Luís de Gaceno'),(285,6,'San Mateo'),(286,6,'San Miguel de Sema'),(287,6,'San Pablo de Borbur'),(288,6,'Santa María'),(289,6,'Santa Rosa de Viterbo'),(290,6,'Santa Sofía'),(291,6,'Santana'),(292,6,'Sativanorte'),(293,6,'Sativasur'),(294,6,'Siachoque'),(295,6,'Soatá'),(296,6,'Socha'),(297,6,'Socotá'),(298,6,'Sogamoso'),(299,6,'Somondoco'),(300,6,'Sora'),(301,6,'Soracá'),(302,6,'Sotaquirá'),(303,6,'Susacón'),(304,6,'Sutamarchán'),(305,6,'Sutatenza'),(306,6,'Sáchica'),(307,6,'Tasco'),(308,6,'Tenza'),(309,6,'Tibaná'),(310,6,'Tibasosa'),(311,6,'Tinjacá'),(312,6,'Tipacoque'),(313,6,'Toca'),(314,6,'Toguí'),(315,6,'Topagá'),(316,6,'Tota'),(317,6,'Tunja'),(318,6,'Tunungua'),(319,6,'Turmequé'),(320,6,'Tuta'),(321,6,'Tutasá'),(322,6,'Ventaquemada'),(323,6,'Villa de Leiva'),(324,6,'Viracachá'),(325,6,'Zetaquirá'),(326,6,'Úmbita'),(327,7,'Aguadas'),(328,7,'Anserma'),(329,7,'Aranzazu'),(330,7,'Belalcázar'),(331,7,'Chinchiná'),(332,7,'Filadelfia'),(333,7,'La Dorada'),(334,7,'La Merced'),(335,7,'La Victoria'),(336,7,'Manizales'),(337,7,'Manzanares'),(338,7,'Marmato'),(339,7,'Marquetalia'),(340,7,'Marulanda'),(341,7,'Neira'),(342,7,'Norcasia'),(343,7,'Palestina'),(344,7,'Pensilvania'),(345,7,'Pácora'),(346,7,'Risaralda'),(347,7,'Río Sucio'),(348,7,'Salamina'),(349,7,'Samaná'),(350,7,'San José'),(351,7,'Supía'),(352,7,'Villamaría'),(353,7,'Viterbo'),(354,8,'Albania'),(355,8,'Belén de los Andaquíes'),(356,8,'Cartagena del Chairá'),(357,8,'Curillo'),(358,8,'El Doncello'),(359,8,'El Paujil'),(360,8,'Florencia'),(361,8,'La Montañita'),(362,8,'Milán'),(363,8,'Morelia'),(364,8,'Puerto Rico'),(365,8,'San José del Fragua'),(366,8,'San Vicente del Caguán'),(367,8,'Solano'),(368,8,'Solita'),(369,8,'Valparaiso'),(370,9,'Aguazul'),(371,9,'Chámeza'),(372,9,'Hato Corozal'),(373,9,'La Salina'),(374,9,'Maní'),(375,9,'Monterrey'),(376,9,'Nunchía'),(377,9,'Orocué'),(378,9,'Paz de Ariporo'),(379,9,'Pore'),(380,9,'Recetor'),(381,9,'Sabanalarga'),(382,9,'San Luís de Palenque'),(383,9,'Sácama'),(384,9,'Tauramena'),(385,9,'Trinidad'),(386,9,'Támara'),(387,9,'Villanueva'),(388,9,'Yopal'),(389,10,'Almaguer'),(390,10,'Argelia'),(391,10,'Balboa'),(392,10,'Bolívar'),(393,10,'Buenos Aires'),(394,10,'Cajibío'),(395,10,'Caldono'),(396,10,'Caloto'),(397,10,'Corinto'),(398,10,'El Tambo'),(399,10,'Florencia'),(400,10,'Guachené'),(401,10,'Guapí'),(402,10,'Inzá'),(403,10,'Jambaló'),(404,10,'La Sierra'),(405,10,'La Vega'),(406,10,'López (Micay)'),(407,10,'Mercaderes'),(408,10,'Miranda'),(409,10,'Morales'),(410,10,'Padilla'),(411,10,'Patía (El Bordo)'),(412,10,'Piamonte'),(413,10,'Piendamó'),(414,10,'Popayán'),(415,10,'Puerto Tejada'),(416,10,'Puracé (Coconuco)'),(417,10,'Páez (Belalcazar)'),(418,10,'Rosas'),(419,10,'San Sebastián'),(420,10,'Santa Rosa'),(421,10,'Santander de Quilichao'),(422,10,'Silvia'),(423,10,'Sotara (Paispamba)'),(424,10,'Sucre'),(425,10,'Suárez'),(426,10,'Timbiquí'),(427,10,'Timbío'),(428,10,'Toribío'),(429,10,'Totoró'),(430,10,'Villa Rica'),(431,11,'Aguachica'),(432,11,'Agustín Codazzi'),(433,11,'Astrea'),(434,11,'Becerríl'),(435,11,'Bosconia'),(436,11,'Chimichagua'),(437,11,'Chiriguaná'),(438,11,'Curumaní'),(439,11,'El Copey'),(440,11,'El Paso'),(441,11,'Gamarra'),(442,11,'Gonzalez'),(443,11,'La Gloria'),(444,11,'La Jagua de Ibirico'),(445,11,'La Paz (Robles)'),(446,11,'Manaure Balcón del Cesar'),(447,11,'Pailitas'),(448,11,'Pelaya'),(449,11,'Pueblo Bello'),(450,11,'Río de oro'),(451,11,'San Alberto'),(452,11,'San Diego'),(453,11,'San Martín'),(454,11,'Tamalameque'),(455,11,'Valledupar'),(456,12,'Acandí'),(457,12,'Alto Baudó (Pie de Pato)'),(458,12,'Atrato (Yuto)'),(459,12,'Bagadó'),(460,12,'Bahía Solano (Mútis)'),(461,12,'Bajo Baudó (Pizarro)'),(462,12,'Belén de Bajirá'),(463,12,'Bojayá (Bellavista)'),(464,12,'Cantón de San Pablo'),(465,12,'Carmen del Darién (CURBARADÓ)'),(466,12,'Condoto'),(467,12,'Cértegui'),(468,12,'El Carmen de Atrato'),(469,12,'Istmina'),(470,12,'Juradó'),(471,12,'Lloró'),(472,12,'Medio Atrato'),(473,12,'Medio Baudó'),(474,12,'Medio San Juan (ANDAGOYA)'),(475,12,'Novita'),(476,12,'Nuquí'),(477,12,'Quibdó'),(478,12,'Río Iró'),(479,12,'Río Quito'),(480,12,'Ríosucio'),(481,12,'San José del Palmar'),(482,12,'Santa Genoveva de Docorodó'),(483,12,'Sipí'),(484,12,'Tadó'),(485,12,'Unguía'),(486,12,'Unión Panamericana (ÁNIMAS)'),(487,13,'Ayapel'),(488,13,'Buenavista'),(489,13,'Canalete'),(490,13,'Cereté'),(491,13,'Chimá'),(492,13,'Chinú'),(493,13,'Ciénaga de Oro'),(494,13,'Cotorra'),(495,13,'La Apartada y La Frontera'),(496,13,'Lorica'),(497,13,'Los Córdobas'),(498,13,'Momil'),(499,13,'Montelíbano'),(500,13,'Monteria'),(501,13,'Moñitos'),(502,13,'Planeta Rica'),(503,13,'Pueblo Nuevo'),(504,13,'Puerto Escondido'),(505,13,'Puerto Libertador'),(506,13,'Purísima'),(507,13,'Sahagún'),(508,13,'San Andrés Sotavento'),(509,13,'San Antero'),(510,13,'San Bernardo del Viento'),(511,13,'San Carlos'),(512,13,'San José de Uré'),(513,13,'San Pelayo'),(514,13,'Tierralta'),(515,13,'Tuchín'),(516,13,'Valencia'),(517,14,'Agua de Dios'),(518,14,'Albán'),(519,14,'Anapoima'),(520,14,'Anolaima'),(521,14,'Apulo'),(522,14,'Arbeláez'),(523,14,'Beltrán'),(524,14,'Bituima'),(525,14,'Bogotá D.C.'),(526,14,'Bojacá'),(527,14,'Cabrera'),(528,14,'Cachipay'),(529,14,'Cajicá'),(530,14,'Caparrapí'),(531,14,'Carmen de Carupa'),(532,14,'Chaguaní'),(533,14,'Chipaque'),(534,14,'Choachí'),(535,14,'Chocontá'),(536,14,'Chía'),(537,14,'Cogua'),(538,14,'Cota'),(539,14,'Cucunubá'),(540,14,'Cáqueza'),(541,14,'El Colegio'),(542,14,'El Peñón'),(543,14,'El Rosal'),(544,14,'Facatativá'),(545,14,'Fosca'),(546,14,'Funza'),(547,14,'Fusagasugá'),(548,14,'Fómeque'),(549,14,'Fúquene'),(550,14,'Gachalá'),(551,14,'Gachancipá'),(552,14,'Gachetá'),(553,14,'Gama'),(554,14,'Girardot'),(555,14,'Granada'),(556,14,'Guachetá'),(557,14,'Guaduas'),(558,14,'Guasca'),(559,14,'Guataquí'),(560,14,'Guatavita'),(561,14,'Guayabal de Siquima'),(562,14,'Guayabetal'),(563,14,'Gutiérrez'),(564,14,'Jerusalén'),(565,14,'Junín'),(566,14,'La Calera'),(567,14,'La Mesa'),(568,14,'La Palma'),(569,14,'La Peña'),(570,14,'La Vega'),(571,14,'Lenguazaque'),(572,14,'Machetá'),(573,14,'Madrid'),(574,14,'Manta'),(575,14,'Medina'),(576,14,'Mosquera'),(577,14,'Nariño'),(578,14,'Nemocón'),(579,14,'Nilo'),(580,14,'Nimaima'),(581,14,'Nocaima'),(582,14,'Pacho'),(583,14,'Paime'),(584,14,'Pandi'),(585,14,'Paratebueno'),(586,14,'Pasca'),(587,14,'Puerto Salgar'),(588,14,'Pulí'),(589,14,'Quebradanegra'),(590,14,'Quetame'),(591,14,'Quipile'),(592,14,'Ricaurte'),(593,14,'San Antonio de Tequendama'),(594,14,'San Bernardo'),(595,14,'San Cayetano'),(596,14,'San Francisco'),(597,14,'San Juan de Río Seco'),(598,14,'Sasaima'),(599,14,'Sesquilé'),(600,14,'Sibaté'),(601,14,'Silvania'),(602,14,'Simijaca'),(603,14,'Soacha'),(604,14,'Sopó'),(605,14,'Subachoque'),(606,14,'Suesca'),(607,14,'Supatá'),(608,14,'Susa'),(609,14,'Sutatausa'),(610,14,'Tabio'),(611,14,'Tausa'),(612,14,'Tena'),(613,14,'Tenjo'),(614,14,'Tibacuy'),(615,14,'Tibirita'),(616,14,'Tocaima'),(617,14,'Tocancipá'),(618,14,'Topaipí'),(619,14,'Ubalá'),(620,14,'Ubaque'),(621,14,'Ubaté'),(622,14,'Une'),(623,14,'Venecia (Ospina Pérez)'),(624,14,'Vergara'),(625,14,'Viani'),(626,14,'Villagómez'),(627,14,'Villapinzón'),(628,14,'Villeta'),(629,14,'Viotá'),(630,14,'Yacopí'),(631,14,'Zipacón'),(632,14,'Zipaquirá'),(633,14,'Útica'),(634,15,'Inírida'),(635,16,'Calamar'),(636,16,'El Retorno'),(637,16,'Miraflores'),(638,16,'San José del Guaviare'),(639,17,'Acevedo'),(640,17,'Agrado'),(641,17,'Aipe'),(642,17,'Algeciras'),(643,17,'Altamira'),(644,17,'Baraya'),(645,17,'Campoalegre'),(646,17,'Colombia'),(647,17,'Elías'),(648,17,'Garzón'),(649,17,'Gigante'),(650,17,'Guadalupe'),(651,17,'Hobo'),(652,17,'Isnos'),(653,17,'La Argentina'),(654,17,'La Plata'),(655,17,'Neiva'),(656,17,'Nátaga'),(657,17,'Oporapa'),(658,17,'Paicol'),(659,17,'Palermo'),(660,17,'Palestina'),(661,17,'Pital'),(662,17,'Pitalito'),(663,17,'Rivera'),(664,17,'Saladoblanco'),(665,17,'San Agustín'),(666,17,'Santa María'),(667,17,'Suaza'),(668,17,'Tarqui'),(669,17,'Tello'),(670,17,'Teruel'),(671,17,'Tesalia'),(672,17,'Timaná'),(673,17,'Villavieja'),(674,17,'Yaguará'),(675,17,'Íquira'),(676,18,'Albania'),(677,18,'Barrancas'),(678,18,'Dibulla'),(679,18,'Distracción'),(680,18,'El Molino'),(681,18,'Fonseca'),(682,18,'Hatonuevo'),(683,18,'La Jagua del Pilar'),(684,18,'Maicao'),(685,18,'Manaure'),(686,18,'Riohacha'),(687,18,'San Juan del Cesar'),(688,18,'Uribia'),(689,18,'Urumita'),(690,18,'Villanueva'),(691,19,'Algarrobo'),(692,19,'Aracataca'),(693,19,'Ariguaní (El Difícil)'),(694,19,'Cerro San Antonio'),(695,19,'Chivolo'),(696,19,'Ciénaga'),(697,19,'Concordia'),(698,19,'El Banco'),(699,19,'El Piñon'),(700,19,'El Retén'),(701,19,'Fundación'),(702,19,'Guamal'),(703,19,'Nueva Granada'),(704,19,'Pedraza'),(705,19,'Pijiño'),(706,19,'Pivijay'),(707,19,'Plato'),(708,19,'Puebloviejo'),(709,19,'Remolino'),(710,19,'Sabanas de San Angel (SAN ANGEL)'),(711,19,'Salamina'),(712,19,'San Sebastián de Buenavista'),(713,19,'San Zenón'),(714,19,'Santa Ana'),(715,19,'Santa Bárbara de Pinto'),(716,19,'Santa Marta'),(717,19,'Sitionuevo'),(718,19,'Tenerife'),(719,19,'Zapayán (PUNTA DE PIEDRAS)'),(720,19,'Zona Bananera (PRADO - SEVILLA)'),(721,20,'Acacías'),(722,20,'Barranca de Upía'),(723,20,'Cabuyaro'),(724,20,'Castilla la Nueva'),(725,20,'Cubarral'),(726,20,'Cumaral'),(727,20,'El Calvario'),(728,20,'El Castillo'),(729,20,'El Dorado'),(730,20,'Fuente de Oro'),(731,20,'Granada'),(732,20,'Guamal'),(733,20,'La Macarena'),(734,20,'Lejanías'),(735,20,'Mapiripan'),(736,20,'Mesetas'),(737,20,'Puerto Concordia'),(738,20,'Puerto Gaitán'),(739,20,'Puerto Lleras'),(740,20,'Puerto López'),(741,20,'Puerto Rico'),(742,20,'Restrepo'),(743,20,'San Carlos de Guaroa'),(744,20,'San Juan de Arama'),(745,20,'San Juanito'),(746,20,'San Martín'),(747,20,'Uribe'),(748,20,'Villavicencio'),(749,20,'Vista Hermosa'),(750,21,'Albán (San José)'),(751,21,'Aldana'),(752,21,'Ancuya'),(753,21,'Arboleda (Berruecos)'),(754,21,'Barbacoas'),(755,21,'Belén'),(756,21,'Buesaco'),(757,21,'Chachaguí'),(758,21,'Colón (Génova)'),(759,21,'Consaca'),(760,21,'Contadero'),(761,21,'Cuaspud (Carlosama)'),(762,21,'Cumbal'),(763,21,'Cumbitara'),(764,21,'Córdoba'),(765,21,'El Charco'),(766,21,'El Peñol'),(767,21,'El Rosario'),(768,21,'El Tablón de Gómez'),(769,21,'El Tambo'),(770,21,'Francisco Pizarro'),(771,21,'Funes'),(772,21,'Guachavés'),(773,21,'Guachucal'),(774,21,'Guaitarilla'),(775,21,'Gualmatán'),(776,21,'Iles'),(777,21,'Imúes'),(778,21,'Ipiales'),(779,21,'La Cruz'),(780,21,'La Florida'),(781,21,'La Llanada'),(782,21,'La Tola'),(783,21,'La Unión'),(784,21,'Leiva'),(785,21,'Linares'),(786,21,'Magüi (Payán)'),(787,21,'Mallama (Piedrancha)'),(788,21,'Mosquera'),(789,21,'Nariño'),(790,21,'Olaya Herrera'),(791,21,'Ospina'),(792,21,'Policarpa'),(793,21,'Potosí'),(794,21,'Providencia'),(795,21,'Puerres'),(796,21,'Pupiales'),(797,21,'Ricaurte'),(798,21,'Roberto Payán (San José)'),(799,21,'Samaniego'),(800,21,'San Bernardo'),(801,21,'San Juan de Pasto'),(802,21,'San Lorenzo'),(803,21,'San Pablo'),(804,21,'San Pedro de Cartago'),(805,21,'Sandoná'),(806,21,'Santa Bárbara (Iscuandé)'),(807,21,'Sapuyes'),(808,21,'Sotomayor (Los Andes)'),(809,21,'Taminango'),(810,21,'Tangua'),(811,21,'Tumaco'),(812,21,'Túquerres'),(813,21,'Yacuanquer'),(814,22,'Arboledas'),(815,22,'Bochalema'),(816,22,'Bucarasica'),(817,22,'Chinácota'),(818,22,'Chitagá'),(819,22,'Convención'),(820,22,'Cucutilla'),(821,22,'Cáchira'),(822,22,'Cácota'),(823,22,'Cúcuta'),(824,22,'Durania'),(825,22,'El Carmen'),(826,22,'El Tarra'),(827,22,'El Zulia'),(828,22,'Gramalote'),(829,22,'Hacarí'),(830,22,'Herrán'),(831,22,'La Esperanza'),(832,22,'La Playa'),(833,22,'Labateca'),(834,22,'Los Patios'),(835,22,'Lourdes'),(836,22,'Mutiscua'),(837,22,'Ocaña'),(838,22,'Pamplona'),(839,22,'Pamplonita'),(840,22,'Puerto Santander'),(841,22,'Ragonvalia'),(842,22,'Salazar'),(843,22,'San Calixto'),(844,22,'San Cayetano'),(845,22,'Santiago'),(846,22,'Sardinata'),(847,22,'Silos'),(848,22,'Teorama'),(849,22,'Tibú'),(850,22,'Toledo'),(851,22,'Villa Caro'),(852,22,'Villa del Rosario'),(853,22,'Ábrego'),(854,23,'Colón'),(855,23,'Mocoa'),(856,23,'Orito'),(857,23,'Puerto Asís'),(858,23,'Puerto Caicedo'),(859,23,'Puerto Guzmán'),(860,23,'Puerto Leguízamo'),(861,23,'San Francisco'),(862,23,'San Miguel'),(863,23,'Santiago'),(864,23,'Sibundoy'),(865,23,'Valle del Guamuez'),(866,23,'Villagarzón'),(867,24,'Armenia'),(868,24,'Buenavista'),(869,24,'Calarcá'),(870,24,'Circasia'),(871,24,'Cordobá'),(872,24,'Filandia'),(873,24,'Génova'),(874,24,'La Tebaida'),(875,24,'Montenegro'),(876,24,'Pijao'),(877,24,'Quimbaya'),(878,24,'Salento'),(879,25,'Apía'),(880,25,'Balboa'),(881,25,'Belén de Umbría'),(882,25,'Dos Quebradas'),(883,25,'Guática'),(884,25,'La Celia'),(885,25,'La Virginia'),(886,25,'Marsella'),(887,25,'Mistrató'),(888,25,'Pereira'),(889,25,'Pueblo Rico'),(890,25,'Quinchía'),(891,25,'Santa Rosa de Cabal'),(892,25,'Santuario'),(893,26,'Providencia'),(894,27,'Aguada'),(895,27,'Albania'),(896,27,'Aratoca'),(897,27,'Barbosa'),(898,27,'Barichara'),(899,27,'Barrancabermeja'),(900,27,'Betulia'),(901,27,'Bolívar'),(902,27,'Bucaramanga'),(903,27,'Cabrera'),(904,27,'California'),(905,27,'Capitanejo'),(906,27,'Carcasí'),(907,27,'Cepita'),(908,27,'Cerrito'),(909,27,'Charalá'),(910,27,'Charta'),(911,27,'Chima'),(912,27,'Chipatá'),(913,27,'Cimitarra'),(914,27,'Concepción'),(915,27,'Confines'),(916,27,'Contratación'),(917,27,'Coromoro'),(918,27,'Curití'),(919,27,'El Carmen'),(920,27,'El Guacamayo'),(921,27,'El Peñon'),(922,27,'El Playón'),(923,27,'Encino'),(924,27,'Enciso'),(925,27,'Floridablanca'),(926,27,'Florián'),(927,27,'Galán'),(928,27,'Girón'),(929,27,'Guaca'),(930,27,'Guadalupe'),(931,27,'Guapota'),(932,27,'Guavatá'),(933,27,'Guepsa'),(934,27,'Gámbita'),(935,27,'Hato'),(936,27,'Jesús María'),(937,27,'Jordán'),(938,27,'La Belleza'),(939,27,'La Paz'),(940,27,'Landázuri'),(941,27,'Lebrija'),(942,27,'Los Santos'),(943,27,'Macaravita'),(944,27,'Matanza'),(945,27,'Mogotes'),(946,27,'Molagavita'),(947,27,'Málaga'),(948,27,'Ocamonte'),(949,27,'Oiba'),(950,27,'Onzaga'),(951,27,'Palmar'),(952,27,'Palmas del Socorro'),(953,27,'Pie de Cuesta'),(954,27,'Pinchote'),(955,27,'Puente Nacional'),(956,27,'Puerto Parra'),(957,27,'Puerto Wilches'),(958,27,'Páramo'),(959,27,'Rio Negro'),(960,27,'Sabana de Torres'),(961,27,'San Andrés'),(962,27,'San Benito'),(963,27,'San Gíl'),(964,27,'San Joaquín'),(965,27,'San José de Miranda'),(966,27,'San Miguel'),(967,27,'San Vicente del Chucurí'),(968,27,'Santa Bárbara'),(969,27,'Santa Helena del Opón'),(970,27,'Simacota'),(971,27,'Socorro'),(972,27,'Suaita'),(973,27,'Sucre'),(974,27,'Suratá'),(975,27,'Tona'),(976,27,'Valle de San José'),(977,27,'Vetas'),(978,27,'Villanueva'),(979,27,'Vélez'),(980,27,'Zapatoca'),(981,28,'Buenavista'),(982,28,'Caimito'),(983,28,'Chalán'),(984,28,'Colosó (Ricaurte)'),(985,28,'Corozal'),(986,28,'Coveñas'),(987,28,'El Roble'),(988,28,'Galeras (Nueva Granada)'),(989,28,'Guaranda'),(990,28,'La Unión'),(991,28,'Los Palmitos'),(992,28,'Majagual'),(993,28,'Morroa'),(994,28,'Ovejas'),(995,28,'Palmito'),(996,28,'Sampués'),(997,28,'San Benito Abad'),(998,28,'San Juan de Betulia'),(999,28,'San Marcos'),(1000,28,'San Onofre'),(1001,28,'San Pedro'),(1002,28,'Sincelejo'),(1003,28,'Sincé'),(1004,28,'Sucre'),(1005,28,'Tolú'),(1006,28,'Tolú Viejo'),(1007,29,'Alpujarra'),(1008,29,'Alvarado'),(1009,29,'Ambalema'),(1010,29,'Anzoátegui'),(1011,29,'Armero (Guayabal)'),(1012,29,'Ataco'),(1013,29,'Cajamarca'),(1014,29,'Carmen de Apicalá'),(1015,29,'Casabianca'),(1016,29,'Chaparral'),(1017,29,'Coello'),(1018,29,'Coyaima'),(1019,29,'Cunday'),(1020,29,'Dolores'),(1021,29,'Espinal'),(1022,29,'Falan'),(1023,29,'Flandes'),(1024,29,'Fresno'),(1025,29,'Guamo'),(1026,29,'Herveo'),(1027,29,'Honda'),(1028,29,'Ibagué'),(1029,29,'Icononzo'),(1030,29,'Lérida'),(1031,29,'Líbano'),(1032,29,'Mariquita'),(1033,29,'Melgar'),(1034,29,'Murillo'),(1035,29,'Natagaima'),(1036,29,'Ortega'),(1037,29,'Palocabildo'),(1038,29,'Piedras'),(1039,29,'Planadas'),(1040,29,'Prado'),(1041,29,'Purificación'),(1042,29,'Rioblanco'),(1043,29,'Roncesvalles'),(1044,29,'Rovira'),(1045,29,'Saldaña'),(1046,29,'San Antonio'),(1047,29,'San Luis'),(1048,29,'Santa Isabel'),(1049,29,'Suárez'),(1050,29,'Valle de San Juan'),(1051,29,'Venadillo'),(1052,29,'Villahermosa'),(1053,29,'Villarrica'),(1054,30,'Alcalá'),(1055,30,'Andalucía'),(1056,30,'Ansermanuevo'),(1057,30,'Argelia'),(1058,30,'Bolívar'),(1059,30,'Buenaventura'),(1060,30,'Buga'),(1061,30,'Bugalagrande'),(1062,30,'Caicedonia'),(1063,30,'Calima (Darién)'),(1064,30,'Calí'),(1065,30,'Candelaria'),(1066,30,'Cartago'),(1067,30,'Dagua'),(1068,30,'El Cairo'),(1069,30,'El Cerrito'),(1070,30,'El Dovio'),(1071,30,'El Águila'),(1072,30,'Florida'),(1073,30,'Ginebra'),(1074,30,'Guacarí'),(1075,30,'Jamundí'),(1076,30,'La Cumbre'),(1077,30,'La Unión'),(1078,30,'La Victoria'),(1079,30,'Obando'),(1080,30,'Palmira'),(1081,30,'Pradera'),(1082,30,'Restrepo'),(1083,30,'Riofrío'),(1084,30,'Roldanillo'),(1085,30,'San Pedro'),(1086,30,'Sevilla'),(1087,30,'Toro'),(1088,30,'Trujillo'),(1089,30,'Tulúa'),(1090,30,'Ulloa'),(1091,30,'Versalles'),(1092,30,'Vijes'),(1093,30,'Yotoco'),(1094,30,'Yumbo'),(1095,30,'Zarzal'),(1096,31,'Carurú'),(1097,31,'Mitú'),(1098,31,'Taraira'),(1099,32,'Cumaribo'),(1100,32,'La Primavera'),(1101,32,'Puerto Carreño'),(1102,32,'Santa Rosalía');

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

insert  into `negocio`(`IdNegocio`,`NOMBRE`,`NIT`,`DIRECCION`,`BARRIO`,`CIUDAD`,`TEL`,`correo`,`LOGO`,`PROPIETARIO`) values (1,'CALZADO PASO ELEGANTE','45648520-4','KR 50 No. 25-24','EL CENTRO','EL CARMEN','3104140338',NULL,'LogoNegocio1.png','ENIS TAPIA Y JOSE ALVAREZ');

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

/*Data for the table `pagos` */

insert  into `pagos`(`ID_EMPLEADO`,`VALOR_PAGO`,`FECHA_PAGO`,`recibo`) values ('73429935',1200000,'2017-11-06',2),('45624564',1200000,'2017-11-08',4);

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

insert  into `proveedores`(`idProveedor`,`Nombre`,`Dir`,`TEL`,`CIUDAD`,`Correo`) values ('1018420492','CALZADO RENOVA','','3187115966','BUCARAMANGA',''),('1095918454','LINDOS STILO','','','EL CARMEN DE BOLIVAR',''),('1098694229-4','CALZADOS LEO\'S','CALLE 107C No. 15B-15 BARRIO TOLEDO PLATA','3107905328','BUCARAMANGA',NULL),('1098784085','CALZADO GANNYS','CRA 15 N 104B-69 BARRIO DELICIAS ALTAS','037 6370021','BUCARAMANGA',''),('1102858058','SANDALIAS HADASSAH','CALLE 30 N 15-19 BARRIO MAJAGUAL','3002263428','SINCELEJO SUCRE',''),('21323131212','CALDO LINDOS STILOS','','','BUCARAMANGA',''),('32869670','CALZADO BETSELLY','CRA 43 N 35-35','3114152457','BARRANQUILLA',''),('39449689-4','CALZADO HINCAPIE','CRA 47 No. 64A-163 P. EMPRESARIAL','5322908','MEDELLIN',NULL),('64696123','CALZADO LOS PIES','Cra10AN25A-7','3162698663','CHINU CORDOBA',''),('700043627','CALZADO LA ARENOSA','CALLE 16 N 21-28 BARRIO LA LUZ','3205696846','BARRANQUILLA',''),('70691267','GUSTAVO ARISTIZABAL','BARRIO CENTRO','3104141775','MEDELLIN',''),('8452','CALZADO ZHARILUZ','BARRIO SANTAMARIA','037 6703853','BUCARAMANGA',''),('890114924','CAUCHOSOL','CLL 30 No. 1-25 BG 2','3344722','BARRANQUILLA',''),('901030678-9','ALIANZA DISTRIBUCIONES DE ANTIOQUIA','DG 41 N 39-9','3174960857','ITAGUI-ANTIOQUIA',''),('91246395','COMERCIALIZADORA DE CALZADO ANGICAR','CRA 4A No. 65B-25B LOS CANELOS','3114699515','BUCARAMANGA',''),('91251081','CALZADO YOMARY','','3163188378','BUCARAMANGA',''),('91281400-9','CALZADO MANOS','CRA 1A No. 30A-28','3158953963','BUCARAMANGA',''),('91499637','CALZADO MAGARDI','CLLE 17 N 23-59 SAN FRANSISCO','037 6717356','BUCARAMANGA',''),('92025501-1','LIBBY DE LA OSSA','CLL 61 No. 12B-57 NUEVO MILENIO','3103679219','BARRANQUILLA',''),('92543563','INICIATIVA A TUS PIES','CALLE 16A N 11-87 BARRIO SANTA MARIA','3008861389','SINCELEJO SUCRE','');

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

insert  into `user1`(`Usuario`,`Password`,`Rol`,`IdNegocio`,`primerNombre`,`segundoNombre`,`primerApellido`,`segundoApellido`,`email`,`estado`) values ('92071210','123456','Admin',1,'JOSE','GREGORIO','ALVAREZ','PUENTE',NULL,'Activo'),('Admin','123','Admin',1,'ENIS','YOJANA','TAPIA','ARROYO',NULL,'Activo');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
