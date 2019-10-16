/*
SQLyog Community v8.71 
MySQL - 5.7.26 : Database - porterias_inteligentes
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`porterias_inteligentes` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `porterias_inteligentes`;

/*Table structure for table `administrators` */

DROP TABLE IF EXISTS `administrators`;

CREATE TABLE `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `housing_estate_id` int(11) NOT NULL COMMENT 'Unidad residencial',
  `name` varchar(45) NOT NULL COMMENT 'Nombres',
  `cellphone` varchar(15) NOT NULL COMMENT 'Número de celular',
  `email` varchar(100) NOT NULL COMMENT 'Correo electrónico',
  `startdate` date DEFAULT NULL COMMENT 'Fecha de inicio',
  `enddate` date DEFAULT NULL COMMENT 'Fecha fin',
  `photo` varchar(255) NOT NULL COMMENT 'Foto',
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Activo',
  `created` varchar(45) NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` varchar(45) NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_administrators_housing_estate1_idx` (`housing_estate_id`),
  CONSTRAINT `fk_administrators_housing_estate1` FOREIGN KEY (`housing_estate_id`) REFERENCES `housing_estate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `administrators` */

/*Table structure for table `apartments` */

DROP TABLE IF EXISTS `apartments`;

CREATE TABLE `apartments` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `block_id` int(11) NOT NULL COMMENT 'Bloque',
  `floor` tinyint(4) NOT NULL COMMENT 'Piso',
  `name` varchar(5) NOT NULL COMMENT 'Nombre',
  `phone_number_1` varchar(15) NOT NULL COMMENT 'Teléfono #1',
  `phone_number_2` varchar(15) DEFAULT NULL COMMENT 'Teléfono #2',
  `cellphone_number_1` varchar(15) DEFAULT NULL COMMENT 'Celular #1',
  `cellphone_number_2` varchar(15) DEFAULT NULL COMMENT 'Celular #2',
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_apartments_blocks1_idx` (`block_id`),
  CONSTRAINT `fk_apartments_blocks1` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `apartments` */

/*Table structure for table `auth_assignment` */

DROP TABLE IF EXISTS `auth_assignment`;

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_assignment` */

insert  into `auth_assignment`(`item_name`,`user_id`,`created_at`) values ('SuperAdministrador','1',1570722074);

/*Table structure for table `auth_item` */

DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item` */

insert  into `auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/*',2,NULL,NULL,NULL,1570722005,1570722005),('/admin/*',2,NULL,NULL,NULL,1570722005,1570722005),('/admin/assignment/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/assignment/assign',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/assignment/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/assignment/revoke',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/assignment/view',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/default/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/default/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/menu/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/menu/create',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/menu/delete',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/menu/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/menu/update',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/menu/view',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/assign',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/create',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/delete',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/remove',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/update',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/view',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/assign',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/create',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/delete',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/remove',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/update',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/view',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/route/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/route/assign',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/route/create',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/route/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/route/refresh',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/route/remove',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/rule/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/rule/create',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/rule/delete',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/rule/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/rule/update',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/rule/view',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/*',2,NULL,NULL,NULL,1570722005,1570722005),('/admin/user/activate',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/change-password',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/delete',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/login',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/logout',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/request-password-reset',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/reset-password',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/signup',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/view',2,NULL,NULL,NULL,1570722004,1570722004),('/administrators/*',2,NULL,NULL,NULL,1571248460,1571248460),('/administrators/create',2,NULL,NULL,NULL,1571248460,1571248460),('/administrators/delete',2,NULL,NULL,NULL,1571248460,1571248460),('/administrators/index',2,NULL,NULL,NULL,1571248460,1571248460),('/administrators/update',2,NULL,NULL,NULL,1571248460,1571248460),('/administrators/view',2,NULL,NULL,NULL,1571248460,1571248460),('/apartments/*',2,NULL,NULL,NULL,1571143686,1571143686),('/apartments/create',2,NULL,NULL,NULL,1571143686,1571143686),('/apartments/delete',2,NULL,NULL,NULL,1571143686,1571143686),('/apartments/index',2,NULL,NULL,NULL,1571143686,1571143686),('/apartments/update',2,NULL,NULL,NULL,1571143686,1571143686),('/apartments/view',2,NULL,NULL,NULL,1571143686,1571143686),('/blocks/*',2,NULL,NULL,NULL,1570724410,1570724410),('/blocks/create',2,NULL,NULL,NULL,1570724410,1570724410),('/blocks/delete',2,NULL,NULL,NULL,1570724410,1570724410),('/blocks/index',2,NULL,NULL,NULL,1570724410,1570724410),('/blocks/update',2,NULL,NULL,NULL,1570724410,1570724410),('/blocks/view',2,NULL,NULL,NULL,1570724410,1570724410),('/debug/*',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/default/*',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/default/db-explain',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/default/download-mail',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/default/index',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/default/toolbar',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/default/view',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/user/*',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/user/reset-identity',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/user/set-identity',2,NULL,NULL,NULL,1570722005,1570722005),('/gates/*',2,NULL,NULL,NULL,1571249918,1571249918),('/gates/create',2,NULL,NULL,NULL,1571249918,1571249918),('/gates/delete',2,NULL,NULL,NULL,1571249918,1571249918),('/gates/index',2,NULL,NULL,NULL,1571249918,1571249918),('/gates/update',2,NULL,NULL,NULL,1571249918,1571249918),('/gates/view',2,NULL,NULL,NULL,1571249918,1571249918),('/gii/*',2,NULL,NULL,NULL,1570722005,1570722005),('/gii/default/*',2,NULL,NULL,NULL,1570722005,1570722005),('/gii/default/action',2,NULL,NULL,NULL,1570722005,1570722005),('/gii/default/diff',2,NULL,NULL,NULL,1570722005,1570722005),('/gii/default/index',2,NULL,NULL,NULL,1570722005,1570722005),('/gii/default/preview',2,NULL,NULL,NULL,1570722005,1570722005),('/gii/default/view',2,NULL,NULL,NULL,1570722005,1570722005),('/housing-estate/*',2,NULL,NULL,NULL,1570722005,1570722005),('/housing-estate/create',2,NULL,NULL,NULL,1570722005,1570722005),('/housing-estate/delete',2,NULL,NULL,NULL,1570722005,1570722005),('/housing-estate/index',2,NULL,NULL,NULL,1570722005,1570722005),('/housing-estate/update',2,NULL,NULL,NULL,1570722005,1570722005),('/housing-estate/view',2,NULL,NULL,NULL,1570722005,1570722005),('/pets/*',2,NULL,NULL,NULL,1571175515,1571175515),('/pets/create',2,NULL,NULL,NULL,1571175515,1571175515),('/pets/delete',2,NULL,NULL,NULL,1571175515,1571175515),('/pets/index',2,NULL,NULL,NULL,1571175515,1571175515),('/pets/update',2,NULL,NULL,NULL,1571175515,1571175515),('/pets/view',2,NULL,NULL,NULL,1571175515,1571175515),('/residents/*',2,NULL,NULL,NULL,1571150683,1571150683),('/residents/create',2,NULL,NULL,NULL,1571150683,1571150683),('/residents/delete',2,NULL,NULL,NULL,1571150683,1571150683),('/residents/index',2,NULL,NULL,NULL,1571150683,1571150683),('/residents/update',2,NULL,NULL,NULL,1571150683,1571150683),('/residents/view',2,NULL,NULL,NULL,1571150683,1571150683),('/site/*',2,NULL,NULL,NULL,1570722005,1570722005),('/site/about',2,NULL,NULL,NULL,1570722005,1570722005),('/site/captcha',2,NULL,NULL,NULL,1570722005,1570722005),('/site/contact',2,NULL,NULL,NULL,1570722005,1570722005),('/site/error',2,NULL,NULL,NULL,1570722005,1570722005),('/site/index',2,NULL,NULL,NULL,1570722005,1570722005),('/site/login',2,NULL,NULL,NULL,1570722005,1570722005),('/site/logout',2,NULL,NULL,NULL,1570722005,1570722005),('/users/*',2,NULL,NULL,NULL,1570722005,1570722005),('/users/create',2,NULL,NULL,NULL,1570722005,1570722005),('/users/delete',2,NULL,NULL,NULL,1570722005,1570722005),('/users/index',2,NULL,NULL,NULL,1570722005,1570722005),('/users/update',2,NULL,NULL,NULL,1570722005,1570722005),('/users/view',2,NULL,NULL,NULL,1570722005,1570722005),('/vehicles/*',2,NULL,NULL,NULL,1571244290,1571244290),('/vehicles/create',2,NULL,NULL,NULL,1571244290,1571244290),('/vehicles/delete',2,NULL,NULL,NULL,1571244290,1571244290),('/vehicles/index',2,NULL,NULL,NULL,1571244290,1571244290),('/vehicles/update',2,NULL,NULL,NULL,1571244290,1571244290),('/vehicles/view',2,NULL,NULL,NULL,1571244290,1571244290),('fullPermission',2,'Permiso a todas las rutas',NULL,NULL,1570722030,1570722030),('SuperAdministrador',1,'Super Administrador con acceso a todas las rutas',NULL,NULL,1570722062,1570722062);

/*Table structure for table `auth_item_child` */

DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item_child` */

insert  into `auth_item_child`(`parent`,`child`) values ('fullPermission','/*'),('SuperAdministrador','fullPermission');

/*Table structure for table `auth_rule` */

DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_rule` */

/*Table structure for table `blocks` */

DROP TABLE IF EXISTS `blocks`;

CREATE TABLE `blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `housing_estate_id` int(11) NOT NULL COMMENT 'Unidad residencial',
  `name` varchar(45) NOT NULL COMMENT 'Nombre',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_blocks_housing_estate1_idx` (`housing_estate_id`),
  CONSTRAINT `fk_blocks_housing_estate1` FOREIGN KEY (`housing_estate_id`) REFERENCES `housing_estate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `blocks` */

/*Table structure for table `fly_pass` */

DROP TABLE IF EXISTS `fly_pass`;

CREATE TABLE `fly_pass` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `gate_id` int(11) NOT NULL COMMENT 'Puerta',
  `name` varchar(45) NOT NULL COMMENT 'Nombre',
  `code` varchar(45) NOT NULL COMMENT 'Código',
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Activo',
  `created` datetime DEFAULT NULL COMMENT 'Creado',
  `created_by` varchar(45) DEFAULT NULL COMMENT 'Creado por',
  `modified` datetime DEFAULT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) DEFAULT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_rfid_gates1_idx` (`gate_id`),
  CONSTRAINT `fk_rfid_gates1` FOREIGN KEY (`gate_id`) REFERENCES `gates` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `fly_pass` */

/*Table structure for table `gates` */

DROP TABLE IF EXISTS `gates`;

CREATE TABLE `gates` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `housing_estate_id` int(11) NOT NULL COMMENT 'Unidad residencial',
  `name` varchar(45) NOT NULL COMMENT 'Nombre',
  `location` varchar(45) NOT NULL COMMENT 'Ubicación',
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_gates_housing_estate1_idx` (`housing_estate_id`),
  CONSTRAINT `fk_gates_housing_estate1` FOREIGN KEY (`housing_estate_id`) REFERENCES `housing_estate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `gates` */

/*Table structure for table `housing_estate` */

DROP TABLE IF EXISTS `housing_estate`;

CREATE TABLE `housing_estate` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(100) NOT NULL COMMENT 'Nombre',
  `description` varchar(255) NOT NULL COMMENT 'Descripción',
  `address` varchar(255) NOT NULL COMMENT 'Dirección',
  `location` varchar(100) DEFAULT NULL COMMENT 'Ubicación',
  `city` varchar(45) NOT NULL COMMENT 'Ciudad',
  `neighborhood` varchar(100) NOT NULL COMMENT 'Barrio',
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `housing_estate` */

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `menu` */

insert  into `menu`(`id`,`name`,`parent`,`route`,`order`,`data`) values (1,'U. residenciales',NULL,'/housing-estate/index',1,' flaticon-map-location'),(2,'Bloques',NULL,'/blocks/index',3,' flaticon-app'),(3,'Apartamentos',NULL,'/apartments/index',4,' fa-building'),(4,'Residentes',NULL,'/residents/index',5,' flaticon-users'),(5,'Mascotas',NULL,'/pets/index',6,' fa-paw\r\n'),(6,'Vehículos',NULL,'/vehicles/index',7,' fa-car'),(7,'Administradores',NULL,'/administrators/index',2,' flaticon-profile'),(8,'Puertas',NULL,'/gates/index',8,' flaticon-interface');

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `migration` */

/*Table structure for table `opening_sensors` */

DROP TABLE IF EXISTS `opening_sensors`;

CREATE TABLE `opening_sensors` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `gate_id` int(11) NOT NULL COMMENT 'Puerta',
  `name` varchar(45) NOT NULL COMMENT 'Nombre',
  `description` varchar(45) NOT NULL COMMENT 'Descripción',
  `code` varchar(45) NOT NULL COMMENT 'Código',
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_opening_sensors_gates1_idx` (`gate_id`),
  CONSTRAINT `fk_opening_sensors_gates1` FOREIGN KEY (`gate_id`) REFERENCES `gates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `opening_sensors` */

/*Table structure for table `pets` */

DROP TABLE IF EXISTS `pets`;

CREATE TABLE `pets` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `apartment_id` int(11) NOT NULL COMMENT 'Apartamento',
  `name` varchar(45) NOT NULL COMMENT 'Nombre',
  `description` text COMMENT 'Descripción',
  `photo` varchar(100) DEFAULT NULL COMMENT 'Foto\n',
  `type` tinyint(4) NOT NULL COMMENT 'Tipo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_pets_apartments1_idx` (`apartment_id`),
  CONSTRAINT `fk_pets_apartments1` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `pets` */

/*Table structure for table `residents` */

DROP TABLE IF EXISTS `residents`;

CREATE TABLE `residents` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `apartment_id` int(11) NOT NULL COMMENT 'Apartamento',
  `name` varchar(100) NOT NULL COMMENT 'Nombre',
  `sex` tinyint(4) NOT NULL COMMENT 'Sexo',
  `document_type` tinyint(4) NOT NULL COMMENT 'Tipo de documento',
  `document` varchar(20) NOT NULL COMMENT 'Documento',
  `email` varchar(100) NOT NULL COMMENT 'Correo electrónico',
  `phone` varchar(45) DEFAULT NULL COMMENT 'Celular',
  `photo` varchar(255) NOT NULL COMMENT 'Foto',
  `tags` text NOT NULL COMMENT 'Etiquetas',
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_residents_apartments1_idx` (`apartment_id`),
  FULLTEXT KEY `name` (`name`,`tags`,`phone`),
  CONSTRAINT `fk_residents_apartments1` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `residents` */

/*Table structure for table `security_cameras` */

DROP TABLE IF EXISTS `security_cameras`;

CREATE TABLE `security_cameras` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(45) NOT NULL COMMENT 'Nombre',
  `description` varchar(45) NOT NULL COMMENT 'Descripción',
  `code` varchar(45) NOT NULL COMMENT 'Código',
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  `housing_estate_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_security_cameras_housing_estate1_idx` (`housing_estate_id`),
  CONSTRAINT `fk_security_cameras_housing_estate1` FOREIGN KEY (`housing_estate_id`) REFERENCES `housing_estate` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `security_cameras` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Nombres y Apellidos',
  `username` varchar(45) NOT NULL COMMENT 'Nombre de usuario',
  `password` varchar(100) NOT NULL COMMENT 'Contraseña',
  `mail` varchar(45) NOT NULL COMMENT 'Correo Electrónico',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(150) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(150) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`password`,`mail`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (1,'Administrador','admin','21232f297a57a5a743894a0e4a801fc3','admin@tecuido.co',1,'2019-10-10 00:00:00','admin','2019-10-10 00:00:00','admin');

/*Table structure for table `vehicles` */

DROP TABLE IF EXISTS `vehicles`;

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `apartment_id` int(11) NOT NULL COMMENT 'Apartamento',
  `photo` varchar(100) NOT NULL COMMENT 'Foto',
  `license_plate` varchar(10) NOT NULL COMMENT 'Placa',
  `type` tinyint(4) NOT NULL COMMENT 'Tipo',
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_vehicles_apartments1_idx` (`apartment_id`),
  CONSTRAINT `fk_vehicles_apartments1` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `vehicles` */

/*Table structure for table `video_doorman` */

DROP TABLE IF EXISTS `video_doorman`;

CREATE TABLE `video_doorman` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `gate_id` int(11) NOT NULL COMMENT 'Prueta',
  `name` varchar(45) NOT NULL COMMENT 'Nombre',
  `code` varchar(45) NOT NULL COMMENT 'Código',
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_videoPortero_gates1_idx` (`gate_id`),
  CONSTRAINT `fk_videoPortero_gates1` FOREIGN KEY (`gate_id`) REFERENCES `gates` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `video_doorman` */

/* Trigger structure for table `housing_estate` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_ai_housing_estate` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_ai_housing_estate` AFTER INSERT ON `housing_estate` FOR EACH ROW BEGIN
	INSERT INTO `blocks` (`housing_estate_id`, `name`, `created`, `created_by`, `modified`, `modified_by`)
	VALUES(new.id, 'SIN BLOQUE', NOW(), 'system', NOW(), 'system');
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;