
CREATE DATABASE `siit`
    CHARACTER SET 'utf8'
    COLLATE 'utf8_general_ci';

USE `siit`;

#
# Structure for the `cliente` table : 
#

CREATE TABLE `cliente` (
  `id_cliente` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `Nombres` VARCHAR(200) COLLATE latin1_swedish_ci NOT NULL,
  `Apellidos` VARCHAR(200) COLLATE latin1_swedish_ci NOT NULL,
  `TipoID` ENUM('Tarjeta de indentidad','Cedula de ciudadania','Cedula de extranjeria','Pasaporte') NOT NULL,
  `Numero_Id` VARCHAR(100) COLLATE latin1_swedish_ci NOT NULL,
  `Email` VARCHAR(200) COLLATE latin1_swedish_ci NOT NULL,
  `Telefono` VARCHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
)ENGINE=InnoDB
AUTO_INCREMENT=12 AVG_ROW_LENGTH=8192 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `cotizacion` table : 
#

CREATE TABLE `cotizacion` (
  `id_cotizacion` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` INTEGER(11) DEFAULT NULL,
  `Fecha_cotizacion` DATE DEFAULT NULL,
  `Fecha_inicio` DATE DEFAULT NULL,
  `Descripcion` TEXT COLLATE utf8_general_ci,
  `precio` DOUBLE(15,3) DEFAULT NULL,
  `Estado` VARCHAR(20) COLLATE utf8_general_ci DEFAULT 'P' COMMENT 'P=Pendiente\r\nA=Aprobado\r\nR=Reservado',
  PRIMARY KEY (`id_cotizacion`),
  KEY `id_usuario` (`id_cliente`),
  CONSTRAINT `cotizacion_fk1` FOREIGN KEY (`id_cliente`) REFERENCES cliente (`id_cliente`)
)ENGINE=InnoDB
AUTO_INCREMENT=16 AVG_ROW_LENGTH=1170 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `cotizacion_servicio` table : 
#

CREATE TABLE `cotizacion_servicio` (
  `id_cotizacion_servicio` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `id_servicio` INTEGER(11) DEFAULT NULL,
  `cantidad` INTEGER(11) DEFAULT NULL,
  `id_cotizacion` INTEGER(11) DEFAULT NULL,
  `Precio` DOUBLE(15,3) DEFAULT NULL,
  PRIMARY KEY (`id_cotizacion_servicio`)
)ENGINE=InnoDB
AUTO_INCREMENT=13 AVG_ROW_LENGTH=1489 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `departamento` table : 
#

CREATE TABLE `departamento` (
  `iddepartamento` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`iddepartamento`)
)ENGINE=InnoDB
AUTO_INCREMENT=33 AVG_ROW_LENGTH=512 CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci'
COMMENT=''
;

#
# Structure for the `municipio` table : 
#

CREATE TABLE `municipio` (
  `idmunicipio` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `departamento_iddepartamento` INTEGER(11) NOT NULL,
  `nombreMunicipio` VARCHAR(200) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idmunicipio`),
  KEY `departamento_iddepartamento` (`departamento_iddepartamento`),
  CONSTRAINT `municipio_fk1` FOREIGN KEY (`departamento_iddepartamento`) REFERENCES departamento (`iddepartamento`)
)ENGINE=InnoDB
AUTO_INCREMENT=43 AVG_ROW_LENGTH=381 CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci'
COMMENT=''
;

#
# Structure for the `paquete` table : 
#

CREATE TABLE `paquete` (
  `id_paquete` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(200) COLLATE latin1_swedish_ci DEFAULT NULL,
  `Valor` INTEGER(11) NOT NULL,
  `Fecha_inicio` DATE NOT NULL COMMENT 'fecha de inicio de la promocion',
  `Fecha_fin` DATE NOT NULL,
  `Disponible` CHAR(20) COLLATE latin1_swedish_ci DEFAULT 'N' COMMENT 'S=Si esta disponible\r\nN=No esta disponible',
  `Estado` CHAR(20) COLLATE latin1_swedish_ci DEFAULT 'S' COMMENT 'S=Si esta vigente el paquete\r\nN=No esta vigente',
  `Descripcion` TEXT COLLATE utf8_general_ci,
  `urlFoto` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `id_Muncipio` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`id_paquete`),
  KEY `id_Muncipio` (`id_Muncipio`),
  CONSTRAINT `paquete_fk1` FOREIGN KEY (`id_Muncipio`) REFERENCES municipio (`idmunicipio`)
)ENGINE=InnoDB
AUTO_INCREMENT=5 AVG_ROW_LENGTH=16384 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `proveedor` table : 
#

CREATE TABLE `proveedor` (
  `id_proveedor` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(200) COLLATE latin1_swedish_ci NOT NULL,
  `Direccion` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `Telefono` VARCHAR(20) COLLATE latin1_swedish_ci NOT NULL,
  `Email` VARCHAR(200) COLLATE latin1_swedish_ci NOT NULL,
  `Nit` VARCHAR(100) COLLATE latin1_swedish_ci NOT NULL,
  `Descripcion` TEXT COLLATE utf8_general_ci,
  `Estado` CHAR(20) COLLATE latin1_swedish_ci DEFAULT 'A' COMMENT 'A=activo\r\nN=No activo',
  `Codigo` VARCHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_proveedor`),
  UNIQUE KEY `Nit` (`Nit`),
  UNIQUE KEY `Codigo` (`Codigo`),
  UNIQUE KEY `Codigo_2` (`Codigo`)
)ENGINE=InnoDB
AUTO_INCREMENT=2 AVG_ROW_LENGTH=5461 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `reserva` table : 
#

CREATE TABLE `reserva` (
  `Id_reserva` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `Fk_paquete` INTEGER(11) DEFAULT NULL,
  `fk_cab_cotizacion` INTEGER(11) DEFAULT NULL,
  `fk_cliente` INTEGER(11) NOT NULL,
  `valor` DOUBLE(15,3) DEFAULT NULL,
  `Fecha_pedido` DATE NOT NULL COMMENT 'El dia que tomo el servicio',
  `Fecha_reserva` DATE NOT NULL COMMENT 'para cuando estaria tomando el paquete',
  `Estado` ENUM('Cotizacion','Confirmado','No confirmado') NOT NULL COMMENT 'Aqui miramos si el cliente solo queria cotizar, si cotizo pero aun no confirma su compra y si confirma su compra del paquete',
  `Pago` CHAR(20) COLLATE latin1_swedish_ci DEFAULT 'N' COMMENT 'S= si ha pagado\r\nN= no ha pagado',
  `tipo` VARCHAR(20) COLLATE utf8_general_ci NOT NULL DEFAULT 'P' COMMENT 'P=Paquete\r\nC=Cotizacion',
  PRIMARY KEY (`Id_reserva`),
  KEY `Fk_paquete` (`Fk_paquete`),
  KEY `fk_cliente` (`fk_cliente`),
  CONSTRAINT `reserva_fk1` FOREIGN KEY (`fk_cliente`) REFERENCES cliente (`id_cliente`)
)ENGINE=InnoDB
AUTO_INCREMENT=9 AVG_ROW_LENGTH=16384 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT='Este es el sistema para que los clientes puedan hacer o reservas, cotizaciones y saber sus estados'
;

#
# Structure for the `sitio_tipo` table : 
#

CREATE TABLE `sitio_tipo` (
  `id_sitio_tipo` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_sitio_tipo`)
)ENGINE=InnoDB
AUTO_INCREMENT=4 AVG_ROW_LENGTH=8192 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `sitios` table : 
#

CREATE TABLE `sitios` (
  `id_sitios` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  `id_sitio_tipo` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`id_sitios`),
  KEY `id_sitio_tipo` (`id_sitio_tipo`),
  CONSTRAINT `sitios_fk1` FOREIGN KEY (`id_sitio_tipo`) REFERENCES sitio_tipo (`id_sitio_tipo`)
)ENGINE=InnoDB
AUTO_INCREMENT=2 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `servicios` table : 
#

CREATE TABLE `servicios` (
  `id_servicios` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(200) COLLATE latin1_swedish_ci NOT NULL,
  `fk_Proveedor` INTEGER(11) NOT NULL,
  `Valor` DOUBLE(15,0) NOT NULL,
  `Estado` CHAR(20) COLLATE latin1_swedish_ci DEFAULT 'S' COMMENT 'S= si esta vigente\r\nN= no esta vigente',
  `Disponibilidad` CHAR(20) COLLATE latin1_swedish_ci DEFAULT 'N' COMMENT 'S= si esta disponible el servicio\r\nN= No esta disponible el servicio',
  `fk_sitio` INTEGER(11) DEFAULT NULL,
  `fk_municipio` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (`id_servicios`),
  KEY `fk_Proveedor` (`fk_Proveedor`),
  KEY `fk_sitio` (`fk_sitio`),
  KEY `fk_municipio` (`fk_municipio`),
  CONSTRAINT `servicios_fk1` FOREIGN KEY (`fk_Proveedor`) REFERENCES proveedor (`id_proveedor`),
  CONSTRAINT `servicios_fk2` FOREIGN KEY (`fk_sitio`) REFERENCES sitios (`id_sitios`)
)ENGINE=InnoDB
AUTO_INCREMENT=7 AVG_ROW_LENGTH=8192 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Structure for the `servicios_paquete` table : 
#

CREATE TABLE `servicios_paquete` (
  `id_servicios_paquete` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `fk_paquete` INTEGER(11) NOT NULL,
  `fk_servicio` INTEGER(11) NOT NULL,
  `cantidad_servicios` INTEGER(11) NOT NULL,
  `valor_unitario_servicio` DOUBLE(15,3) NOT NULL COMMENT 'El valor del servicio dentro del paquete',
  `porcentaje_admin` DOUBLE(15,3) NOT NULL DEFAULT 0.000 COMMENT 'es el porcentaje de ganancia del administrador',
  `Disponible` CHAR(1) COLLATE utf8_general_ci DEFAULT 'S' COMMENT 'S=Si esta disponible\r\nN=No esta disponible',
  PRIMARY KEY (`id_servicios_paquete`),
  KEY `fk_paquete` (`fk_paquete`),
  KEY `fk_servicio` (`fk_servicio`),
  CONSTRAINT `servicios_paquete_fk1` FOREIGN KEY (`fk_paquete`) REFERENCES paquete (`id_paquete`),
  CONSTRAINT `servicios_paquete_fk2` FOREIGN KEY (`fk_servicio`) REFERENCES servicios (`id_servicios`)
)ENGINE=InnoDB
AUTO_INCREMENT=3 AVG_ROW_LENGTH=16384 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
COMMENT=''
;

#
# Data for the `cliente` table  (LIMIT -496,500)
#

INSERT INTO `cliente` (`id_cliente`, `Nombres`, `Apellidos`, `TipoID`, `Numero_Id`, `Email`, `Telefono`) VALUES 
  (3,'CAMILO ERNESTO RUIZ VIDAL    ','','Cedula de ciudadania','1061716139','milo9022@hotmail.com','3186234042'),
  (10,'juliana andrea ruiz vidal','','Cedula de ciudadania','1061699111','andreita1234@hotmail.com','3186234042'),
  (11,'jaime andres sanchez','','Tarjeta de indentidad','123456','andres123@hotmail.com','8374894');
COMMIT;

#
# Data for the `cotizacion` table  (LIMIT -484,500)
#

INSERT INTO `cotizacion` (`id_cotizacion`, `id_cliente`, `Fecha_cotizacion`, `Fecha_inicio`, `Descripcion`, `precio`, `Estado`) VALUES 
  (1,3,'2015-05-09','2015-12-31','222',NULL,'P'),
  (2,3,'2015-05-09','2015-12-31','222',240000.000,'R'),
  (3,3,'2015-05-09','2015-12-31','wwww',1760000.000,'R'),
  (4,3,'2015-05-09','0000-00-00','',NULL,'P'),
  (5,3,'2015-05-17','2015-05-17','una breve descripcion',160000.000,'P'),
  (6,3,'2015-05-17','2015-05-28','s',1760000.000,'P'),
  (7,3,'2015-05-17','2015-05-17','periodo 1',800000.000,'P'),
  (8,3,'2015-05-17','2015-05-03','breve descripcion',160000.000,'P'),
  (9,3,'2015-05-17','2015-05-03','breve descripcion',NULL,'P'),
  (10,3,'2015-05-17','2015-05-03','breve descripcion',NULL,'P'),
  (11,3,'2015-05-17','2015-05-11','www',160000.000,'P'),
  (12,3,'2015-05-17','2015-05-11','www',NULL,'P'),
  (13,3,'2015-05-17','2015-05-11','www',NULL,'P'),
  (14,3,'2015-05-17','2015-05-11','www',NULL,'P'),
  (15,3,'2015-05-17','2015-05-21','w',285000.000,'R');
COMMIT;

#
# Data for the `cotizacion_servicio` table  (LIMIT -487,500)
#

INSERT INTO `cotizacion_servicio` (`id_cotizacion_servicio`, `id_servicio`, `cantidad`, `id_cotizacion`, `Precio`) VALUES 
  (1,NULL,0,2,NULL),
  (2,6,3,2,80000.000),
  (3,6,22,3,80000.000),
  (4,NULL,0,4,NULL),
  (5,6,2,5,NULL),
  (6,NULL,0,6,NULL),
  (7,6,22,6,NULL),
  (8,6,10,7,NULL),
  (9,6,2,8,NULL),
  (10,6,2,11,NULL),
  (11,6,3,15,70000.000),
  (12,3,1,15,40000.000);
COMMIT;

#
# Data for the `departamento` table  (LIMIT -467,500)
#

INSERT INTO `departamento` (`iddepartamento`, `nombre`) VALUES 
  (1,'AMAZONAS'),
  (2,'ANTIOQUIA'),
  (3,'ARAUCA'),
  (4,'ATLÁNTICO'),
  (5,'BOLÍVAR'),
  (6,'BOYACÁ'),
  (7,'CALDAS'),
  (8,'CAQUETÁ'),
  (9,'CASANARE'),
  (10,'CAUCA'),
  (11,'CESAR'),
  (12,'CHOCÓ'),
  (13,'CÓRDOBA'),
  (14,'CUNDINAMARCA'),
  (15,'GUAINÍA'),
  (16,'GUAVIARE'),
  (17,'HUILA'),
  (18,'LA GUAJIRA'),
  (19,'MAGDALENA'),
  (20,'META'),
  (21,'NARIÑO'),
  (22,'NORTE DE SANTANDER'),
  (23,'PUTUMAYO'),
  (24,'QUINDÍO'),
  (25,'RISARALDA'),
  (26,'SAN ANDRÉS Y ROVIDENCIA'),
  (27,'SANTANDER'),
  (28,'SUCRE'),
  (29,'TOLIMA'),
  (30,'VALLE DEL CAUCA'),
  (31,'VAUPÉS'),
  (32,'VICHADA');
COMMIT;

#
# Data for the `municipio` table  (LIMIT -457,500)
#

INSERT INTO `municipio` (`idmunicipio`, `departamento_iddepartamento`, `nombreMunicipio`) VALUES 
  (1,10,'Almaguer'),
  (2,10,'Argelia'),
  (3,10,'Balboa'),
  (4,10,'Bolívar'),
  (5,10,'Buenos Aires'),
  (6,10,'Cajibío'),
  (7,10,'Caldono'),
  (8,10,'Caloto'),
  (9,10,'Corinto'),
  (10,10,'El Tambo'),
  (11,10,'Florencia'),
  (12,10,'Guapi'),
  (13,10,'Inzá'),
  (14,10,'Jambaló'),
  (15,10,'La Sierra'),
  (16,10,'La Vega'),
  (17,10,'López de Micay'),
  (18,10,'Mercaderes'),
  (19,10,'Miranda'),
  (20,10,'Morales'),
  (21,10,'Padilla'),
  (22,10,'Páez'),
  (23,10,'Patía (El Bordo)'),
  (24,10,'Piamonte'),
  (25,10,'Piendamó'),
  (26,10,'Popayán'),
  (27,10,'Puerto Tejada'),
  (28,10,'Puracé'),
  (29,10,'Rosas'),
  (30,10,'San Sebastián'),
  (31,10,'Santa Rosa'),
  (32,10,'Santander de Quilichao'),
  (33,10,'Silvia'),
  (34,10,'Sotará'),
  (35,10,'Suárez'),
  (36,10,'Sucre'),
  (37,10,'Timbío'),
  (38,10,'Timbiquí'),
  (39,10,'Toribío'),
  (40,10,'Totoró'),
  (41,10,'Villa Rica'),
  (42,10,'Guachené');
COMMIT;

#
# Data for the `paquete` table  (LIMIT -498,500)
#

INSERT INTO `paquete` (`id_paquete`, `Nombre`, `Valor`, `Fecha_inicio`, `Fecha_fin`, `Disponible`, `Estado`, `Descripcion`, `urlFoto`, `id_Muncipio`) VALUES 
  (1,'Restaurante familiar',80000,'2015-05-08','2015-05-15','S','S','Cena para 5 personas en uno de nuestros mejores restaurantes','images/other/default.jpg',26);
COMMIT;

#
# Data for the `proveedor` table  (LIMIT -498,500)
#

INSERT INTO `proveedor` (`id_proveedor`, `Nombre`, `Direccion`, `Telefono`, `Email`, `Nit`, `Descripcion`, `Estado`, `Codigo`) VALUES 
  (1,'Restaurante las estrellas','Cra 48 b numero 5-14','8365678','restaurante@hotmail.com','1234-1','restaurante de comidas exóticas ','N','PSIIT0002');
COMMIT;

#
# Data for the `reserva` table  (LIMIT -491,500)
#

INSERT INTO `reserva` (`Id_reserva`, `Fk_paquete`, `fk_cab_cotizacion`, `fk_cliente`, `valor`, `Fecha_pedido`, `Fecha_reserva`, `Estado`, `Pago`, `tipo`) VALUES 
  (1,NULL,2,3,240000.000,'2015-05-09','2015-12-31','Confirmado','S','C'),
  (2,1,NULL,11,290000.000,'0000-00-00','2015-05-01','Confirmado','S','P'),
  (3,NULL,15,3,285000.000,'2015-05-17','2015-05-21','Cotizacion','N','C'),
  (4,1,NULL,3,80000.000,'0000-00-00','2015-05-25','Confirmado','N','P'),
  (5,1,NULL,3,80000.000,'0000-00-00','2015-05-25','Confirmado','N','P'),
  (6,1,NULL,3,80000.000,'0000-00-00','2015-05-24','Confirmado','N','P'),
  (7,1,NULL,3,80000.000,'0000-00-00','2015-05-24','Confirmado','N','P'),
  (8,1,NULL,3,80000.000,'0000-00-00','2015-05-24','Confirmado','N','P');
COMMIT;

#
# Data for the `sitio_tipo` table  (LIMIT -496,500)
#

INSERT INTO `sitio_tipo` (`id_sitio_tipo`, `descripcion`) VALUES 
  (1,'Municipio'),
  (2,'Vereda'),
  (3,'Corregimiento');
COMMIT;

#
# Data for the `sitios` table  (LIMIT -498,500)
#

INSERT INTO `sitios` (`id_sitios`, `descripcion`, `id_sitio_tipo`) VALUES 
  (1,'Popayán',1);
COMMIT;

#
# Data for the `servicios` table  (LIMIT -497,500)
#

INSERT INTO `servicios` (`id_servicios`, `Nombre`, `fk_Proveedor`, `Valor`, `Estado`, `Disponibilidad`, `fk_sitio`, `fk_municipio`) VALUES 
  (3,'baby beef',1,45000,'S','S',NULL,NULL),
  (6,'baby beef especial',1,80000,'S','S',NULL,NULL);
COMMIT;

#
# Data for the `servicios_paquete` table  (LIMIT -498,500)
#

INSERT INTO `servicios_paquete` (`id_servicios_paquete`, `fk_paquete`, `fk_servicio`, `cantidad_servicios`, `valor_unitario_servicio`, `porcentaje_admin`, `Disponible`) VALUES 
  (2,1,3,2,39000.000,0.000,'S');
COMMIT;