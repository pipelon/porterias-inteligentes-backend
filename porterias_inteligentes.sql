/*
SQLyog Community v8.71 
MySQL - 5.5.5-10.4.10-MariaDB : Database - porterias_inteligentes
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `administrators` */

DROP TABLE IF EXISTS `administrators`;

CREATE TABLE `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `housing_estate_id` int(11) NOT NULL COMMENT 'Unidad residencial',
  `name` varchar(255) NOT NULL COMMENT 'Nombres completos del administrador',
  `cellphone` varchar(15) NOT NULL COMMENT 'Número de celular',
  `email` varchar(100) NOT NULL COMMENT 'Correo electrónico',
  `startdate` date DEFAULT NULL COMMENT 'Fecha de inicio',
  `enddate` date DEFAULT NULL COMMENT 'Fecha fin',
  `photo` varchar(255) NOT NULL COMMENT 'Foto',
  `active` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_administrators_housing_estate1_idx` (`housing_estate_id`),
  CONSTRAINT `fk_administrators_housing_estate1` FOREIGN KEY (`housing_estate_id`) REFERENCES `housing_estate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `administrators` */

insert  into `administrators`(`id`,`housing_estate_id`,`name`,`cellphone`,`email`,`startdate`,`enddate`,`photo`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (1,1,'Dani Molina','3132343234','dany.molina@gmail.com','2019-10-01','2019-10-09','archivos/20191021185946-descarga.jpg',1,'2019-10-21 13:59:46','admin','2019-10-21 14:02:00','admin'),(2,1,'Ana Arango','3124321221','ana.arango@gmail.com','2019-10-01','2019-10-03','archivos/20191031153811-descarga.jpg',1,'2019-10-31 10:38:11','admin','2019-10-31 10:38:11','admin');

/*Table structure for table `apartments` */

DROP TABLE IF EXISTS `apartments`;

CREATE TABLE `apartments` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `housing_estate_id` int(11) NOT NULL COMMENT 'Unidad residencial',
  `block` varchar(45) DEFAULT NULL COMMENT 'Bloque',
  `floor` tinyint(4) NOT NULL COMMENT 'Piso',
  `name` varchar(20) NOT NULL COMMENT 'Apartamento',
  `phone_number_1` varchar(15) NOT NULL COMMENT 'Teléfono #1',
  `phone_number_2` varchar(15) DEFAULT NULL COMMENT 'Teléfono #2',
  `cellphone_number_1` varchar(15) DEFAULT NULL COMMENT 'Celular #1',
  `cellphone_number_2` varchar(15) DEFAULT NULL COMMENT 'Celular #2',
  `active` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_apartments_housing_estate1_idx` (`housing_estate_id`),
  FULLTEXT KEY `name` (`name`,`phone_number_1`,`phone_number_2`,`cellphone_number_1`,`cellphone_number_2`),
  CONSTRAINT `fk_apartments_housing_estate1` FOREIGN KEY (`housing_estate_id`) REFERENCES `housing_estate` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `apartments` */

insert  into `apartments`(`id`,`housing_estate_id`,`block`,`floor`,`name`,`phone_number_1`,`phone_number_2`,`cellphone_number_1`,`cellphone_number_2`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (1,1,'15',8,'Apto 817','3136600674','3136600674','3136600674','3136600674',1,'2019-10-21 14:32:26','admin','2020-02-09 16:14:07','admin'),(2,1,'1',2,'Apto 220','3136600674','3243234','3136606074','3122346074',1,'2019-10-21 14:35:49','admin','2020-02-09 16:09:56','admin');

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

insert  into `auth_assignment`(`item_name`,`user_id`,`created_at`) values ('ClienteAPI','2',1572374414),('SuperAdministrador','1',1570722074);

/*Table structure for table `auth_item` */

DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item` */

insert  into `auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/*',2,NULL,NULL,NULL,1570722005,1570722005),('/admin/*',2,NULL,NULL,NULL,1570722005,1570722005),('/admin/assignment/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/assignment/assign',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/assignment/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/assignment/revoke',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/assignment/view',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/default/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/default/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/menu/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/menu/create',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/menu/delete',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/menu/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/menu/update',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/menu/view',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/assign',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/create',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/delete',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/remove',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/update',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/view',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/assign',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/create',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/delete',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/remove',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/update',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/view',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/route/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/route/assign',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/route/create',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/route/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/route/refresh',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/route/remove',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/rule/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/rule/create',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/rule/delete',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/rule/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/rule/update',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/rule/view',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/*',2,NULL,NULL,NULL,1570722005,1570722005),('/admin/user/activate',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/change-password',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/delete',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/login',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/logout',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/request-password-reset',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/reset-password',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/signup',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/view',2,NULL,NULL,NULL,1570722004,1570722004),('/administrators/*',2,NULL,NULL,NULL,1571248460,1571248460),('/administrators/create',2,NULL,NULL,NULL,1571248460,1571248460),('/administrators/delete',2,NULL,NULL,NULL,1571248460,1571248460),('/administrators/index',2,NULL,NULL,NULL,1571248460,1571248460),('/administrators/update',2,NULL,NULL,NULL,1571248460,1571248460),('/administrators/view',2,NULL,NULL,NULL,1571248460,1571248460),('/apartments/*',2,NULL,NULL,NULL,1571143686,1571143686),('/apartments/create',2,NULL,NULL,NULL,1571143686,1571143686),('/apartments/delete',2,NULL,NULL,NULL,1571143686,1571143686),('/apartments/index',2,NULL,NULL,NULL,1571143686,1571143686),('/apartments/update',2,NULL,NULL,NULL,1571143686,1571143686),('/apartments/view',2,NULL,NULL,NULL,1571143686,1571143686),('/api/*',2,NULL,NULL,NULL,1572363665,1572363665),('/api/index',2,NULL,NULL,NULL,1572363665,1572363665),('/api/options',2,NULL,NULL,NULL,1572363665,1572363665),('/api/searchapartment',2,NULL,NULL,NULL,1586034174,1586034174),('/api/view',2,NULL,NULL,NULL,1572363665,1572363665),('/authorizations/*',2,NULL,NULL,NULL,1572363665,1572363665),('/authorizations/create',2,NULL,NULL,NULL,1572363665,1572363665),('/authorizations/delete',2,NULL,NULL,NULL,1572363665,1572363665),('/authorizations/index',2,NULL,NULL,NULL,1572363665,1572363665),('/authorizations/update',2,NULL,NULL,NULL,1572363665,1572363665),('/authorizations/view',2,NULL,NULL,NULL,1572363665,1572363665),('/blocks/*',2,NULL,NULL,NULL,1570724410,1570724410),('/blocks/create',2,NULL,NULL,NULL,1570724410,1570724410),('/blocks/delete',2,NULL,NULL,NULL,1570724410,1570724410),('/blocks/index',2,NULL,NULL,NULL,1570724410,1570724410),('/blocks/update',2,NULL,NULL,NULL,1570724410,1570724410),('/blocks/view',2,NULL,NULL,NULL,1570724410,1570724410),('/cities/*',2,NULL,NULL,NULL,1572363665,1572363665),('/cities/create',2,NULL,NULL,NULL,1572363665,1572363665),('/cities/delete',2,NULL,NULL,NULL,1572363665,1572363665),('/cities/index',2,NULL,NULL,NULL,1572363665,1572363665),('/cities/update',2,NULL,NULL,NULL,1572363665,1572363665),('/cities/view',2,NULL,NULL,NULL,1572363665,1572363665),('/debug/*',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/default/*',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/default/db-explain',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/default/download-mail',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/default/index',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/default/toolbar',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/default/view',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/user/*',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/user/reset-identity',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/user/set-identity',2,NULL,NULL,NULL,1570722005,1570722005),('/gates/*',2,NULL,NULL,NULL,1571249918,1571249918),('/gates/create',2,NULL,NULL,NULL,1571249918,1571249918),('/gates/delete',2,NULL,NULL,NULL,1571249918,1571249918),('/gates/index',2,NULL,NULL,NULL,1571249918,1571249918),('/gates/update',2,NULL,NULL,NULL,1571249918,1571249918),('/gates/view',2,NULL,NULL,NULL,1571249918,1571249918),('/gii/*',2,NULL,NULL,NULL,1570722005,1570722005),('/gii/default/*',2,NULL,NULL,NULL,1570722005,1570722005),('/gii/default/action',2,NULL,NULL,NULL,1570722005,1570722005),('/gii/default/diff',2,NULL,NULL,NULL,1570722005,1570722005),('/gii/default/index',2,NULL,NULL,NULL,1570722005,1570722005),('/gii/default/preview',2,NULL,NULL,NULL,1570722005,1570722005),('/gii/default/view',2,NULL,NULL,NULL,1570722005,1570722005),('/housing-estate/*',2,NULL,NULL,NULL,1570722005,1570722005),('/housing-estate/create',2,NULL,NULL,NULL,1570722005,1570722005),('/housing-estate/delete',2,NULL,NULL,NULL,1570722005,1570722005),('/housing-estate/index',2,NULL,NULL,NULL,1570722005,1570722005),('/housing-estate/update',2,NULL,NULL,NULL,1570722005,1570722005),('/housing-estate/view',2,NULL,NULL,NULL,1570722005,1570722005),('/pets/*',2,NULL,NULL,NULL,1571175515,1571175515),('/pets/create',2,NULL,NULL,NULL,1571175515,1571175515),('/pets/delete',2,NULL,NULL,NULL,1571175515,1571175515),('/pets/index',2,NULL,NULL,NULL,1571175515,1571175515),('/pets/update',2,NULL,NULL,NULL,1571175515,1571175515),('/pets/view',2,NULL,NULL,NULL,1571175515,1571175515),('/residents/*',2,NULL,NULL,NULL,1571150683,1571150683),('/residents/create',2,NULL,NULL,NULL,1571150683,1571150683),('/residents/delete',2,NULL,NULL,NULL,1571150683,1571150683),('/residents/index',2,NULL,NULL,NULL,1571150683,1571150683),('/residents/update',2,NULL,NULL,NULL,1571150683,1571150683),('/residents/view',2,NULL,NULL,NULL,1571150683,1571150683),('/security-cameras/*',2,NULL,NULL,NULL,1586034175,1586034175),('/security-cameras/create',2,NULL,NULL,NULL,1586034175,1586034175),('/security-cameras/delete',2,NULL,NULL,NULL,1586034175,1586034175),('/security-cameras/index',2,NULL,NULL,NULL,1586034175,1586034175),('/security-cameras/update',2,NULL,NULL,NULL,1586034175,1586034175),('/security-cameras/view',2,NULL,NULL,NULL,1586034175,1586034175),('/site/*',2,NULL,NULL,NULL,1570722005,1570722005),('/site/about',2,NULL,NULL,NULL,1570722005,1570722005),('/site/captcha',2,NULL,NULL,NULL,1570722005,1570722005),('/site/contact',2,NULL,NULL,NULL,1570722005,1570722005),('/site/error',2,NULL,NULL,NULL,1570722005,1570722005),('/site/index',2,NULL,NULL,NULL,1570722005,1570722005),('/site/login',2,NULL,NULL,NULL,1570722005,1570722005),('/site/logout',2,NULL,NULL,NULL,1570722005,1570722005),('/users/*',2,NULL,NULL,NULL,1570722005,1570722005),('/users/create',2,NULL,NULL,NULL,1570722005,1570722005),('/users/delete',2,NULL,NULL,NULL,1570722005,1570722005),('/users/index',2,NULL,NULL,NULL,1570722005,1570722005),('/users/update',2,NULL,NULL,NULL,1570722005,1570722005),('/users/view',2,NULL,NULL,NULL,1570722005,1570722005),('/vehicles/*',2,NULL,NULL,NULL,1571244290,1571244290),('/vehicles/create',2,NULL,NULL,NULL,1571244290,1571244290),('/vehicles/delete',2,NULL,NULL,NULL,1571244290,1571244290),('/vehicles/index',2,NULL,NULL,NULL,1571244290,1571244290),('/vehicles/update',2,NULL,NULL,NULL,1571244290,1571244290),('/vehicles/view',2,NULL,NULL,NULL,1571244290,1571244290),('ApiClient',2,'Este Permiso puede acceder a todas las accions del Api',NULL,NULL,1572374386,1572374386),('ClienteAPI',1,'Este rol puede acceder a las APIs del sistema',NULL,NULL,1572374340,1572375367),('fullPermission',2,'Permiso a todas las rutas',NULL,NULL,1570722030,1570722030),('SuperAdministrador',1,'Super Administrador con acceso a todas las rutas',NULL,NULL,1570722062,1570722062);

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

insert  into `auth_item_child`(`parent`,`child`) values ('ApiClient','/api/*'),('ApiClient','/api/index'),('ApiClient','/api/options'),('ApiClient','/api/view'),('ClienteAPI','ApiClient'),('fullPermission','/*'),('SuperAdministrador','fullPermission');

/*Table structure for table `auth_rule` */

DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_rule` */

/*Table structure for table `authorizations` */

DROP TABLE IF EXISTS `authorizations`;

CREATE TABLE `authorizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `housing_estate_id` int(11) NOT NULL COMMENT 'Unidad Residencial',
  `user_id` int(11) NOT NULL COMMENT 'Usuario',
  `active` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_authorizations_housing_estate1_idx` (`housing_estate_id`),
  KEY `fk_authorizations_users1_idx` (`user_id`),
  CONSTRAINT `fk_authorizations_housing_estate1` FOREIGN KEY (`housing_estate_id`) REFERENCES `housing_estate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `authorizations` */

insert  into `authorizations`(`id`,`housing_estate_id`,`user_id`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (2,1,2,1,'2019-10-29 13:57:34','admin','2019-10-29 13:57:34','admin'),(3,2,2,1,'2019-10-29 15:33:56','admin','2019-10-29 15:33:56','admin');

/*Table structure for table `cities` */

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(100) NOT NULL COMMENT 'Ciudad',
  `active` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime DEFAULT NULL COMMENT 'Creado',
  `created_by` varchar(45) DEFAULT NULL COMMENT 'Creado por',
  `modified` datetime DEFAULT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) DEFAULT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `cities` */

insert  into `cities`(`id`,`name`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (1,'Medellín',1,'2019-10-21 11:46:09','admin','2019-10-21 11:46:09','admin'),(2,'Bogotá',0,'2019-10-21 11:46:48','admin','2019-10-21 11:57:03','admin'),(3,'Envigado',1,'2019-10-21 11:47:00','admin','2019-10-21 11:47:00','admin'),(4,'Sabaneta',1,'2019-10-21 11:47:06','admin','2019-10-21 11:47:06','admin'),(5,'Bello',1,'2019-10-21 11:47:12','admin','2019-10-21 11:47:12','admin'),(6,'La estrella',1,'2019-10-21 11:47:20','admin','2019-10-21 11:47:20','admin');

/*Table structure for table `fly_pass` */

DROP TABLE IF EXISTS `fly_pass`;

CREATE TABLE `fly_pass` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `gate_id` int(11) NOT NULL COMMENT 'Puerta',
  `name` varchar(255) NOT NULL COMMENT 'Nombre del video portero',
  `code` varchar(45) NOT NULL COMMENT 'Código',
  `active` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Activo',
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
  `name` varchar(255) NOT NULL COMMENT 'Puerta',
  `location` varchar(255) NOT NULL COMMENT 'Ubicación',
  `state` tinyint(4) DEFAULT 1 COMMENT 'Estado',
  `state_description` text DEFAULT NULL COMMENT 'Descripción de estado',
  `active` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_gates_housing_estate1_idx` (`housing_estate_id`),
  CONSTRAINT `fk_gates_housing_estate1` FOREIGN KEY (`housing_estate_id`) REFERENCES `housing_estate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `gates` */

insert  into `gates`(`id`,`housing_estate_id`,`name`,`location`,`state`,`state_description`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (1,1,'Puerta principal','Ubicada en la portería principal',1,NULL,1,'2019-10-29 09:49:49','admin','2019-10-29 09:49:49','admin'),(2,1,'Puerta norte','Ubicada en la zona norte',2,NULL,1,'2019-10-29 09:50:07','admin','2019-10-31 11:39:53','admin'),(3,1,'Puerta sur','Ubicada en la zona sur',1,NULL,1,'2019-10-31 11:40:21','admin','2019-10-31 11:40:21','admin'),(4,1,'Puerta parqueadero','Ubicada en la zona parqueadero',3,'No hay comunicación con el sensor',1,'2019-10-31 11:40:41','admin','2019-10-31 11:40:41','admin'),(5,2,'Puerta principal','Ubicada en la portería principal',1,NULL,1,'2019-11-27 16:02:03','admin','2019-11-27 16:02:03','admin');

/*Table structure for table `housing_estate` */

DROP TABLE IF EXISTS `housing_estate`;

CREATE TABLE `housing_estate` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(200) NOT NULL COMMENT 'Nombre unidad residencial',
  `description` varchar(255) NOT NULL COMMENT 'Descripción',
  `city_id` int(11) NOT NULL COMMENT 'Ciudad',
  `location` varchar(100) NOT NULL COMMENT 'Ubicación',
  `address` varchar(255) NOT NULL COMMENT 'Dirección',
  `phone_number` varchar(15) DEFAULT NULL COMMENT 'Teléfono portería',
  `police_phone_number` varchar(15) DEFAULT NULL COMMENT 'Número del cuadrante',
  `neighborhood` varchar(100) NOT NULL COMMENT 'Barrio',
  `active` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_housing_estate_cities1_idx` (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `housing_estate` */

insert  into `housing_estate`(`id`,`name`,`description`,`city_id`,`location`,`address`,`phone_number`,`police_phone_number`,`neighborhood`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (1,'Arroyo de los bernal','Unidad arroyo de los bernal',1,'6.242643999175641,-75.59213759988955','Calle 40 A sur # 24 B - 105','4446556','2134321','Poblado',1,'2019-10-21 12:09:48','admin','2019-10-31 10:59:37','admin'),(2,'Palmeras etapa 3','Urbanización palmeras etapa 3',3,'7.0824931301000955,-73.84767503979492','Calle 40 A sur # 24 B - 105','4446556','2134321','La Mina',1,'2019-10-29 09:20:14','admin','2019-11-27 16:02:59','admin');

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `menu` */

insert  into `menu`(`id`,`name`,`parent`,`route`,`order`,`data`) values (1,'U. residenciales',NULL,'/housing-estate/index',1,' flaticon-map-location'),(2,'Ciudades',9,'/cities/index',3,' flaticon-placeholder-2'),(3,'Apartamentos',NULL,'/apartments/index',2,' fa-building'),(4,'Residentes',NULL,'/residents/index',3,' flaticon-users'),(5,'Mascotas',NULL,'/pets/index',4,' fa-paw\r\n'),(6,'Vehículos',NULL,'/vehicles/index',5,' fa-car'),(7,'Administradores',NULL,'/administrators/index',6,' flaticon-profile'),(8,'Puertas',NULL,'/gates/index',7,' flaticon-interface'),(9,'Configuración',NULL,NULL,8,' flaticon-cogwheel'),(10,'Usuarios',9,'/users/index',1,' flaticon-users'),(11,'Asignaciones',9,'/admin/assignment/index',3,' flaticon-user-ok'),(12,'Autorización de acceso',9,'/authorizations/index',4,' flaticon-lock-1'),(13,'Cámaras',NULL,'/security-cameras/index',8,' fa-camera');

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
  `name` varchar(255) NOT NULL COMMENT 'Nombre',
  `description` varchar(255) NOT NULL COMMENT 'Descripción',
  `code` varchar(45) NOT NULL COMMENT 'Código',
  `active` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Activo',
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
  `name` varchar(255) NOT NULL COMMENT 'Nombre de la mascota',
  `description` text DEFAULT NULL COMMENT 'Descripción',
  `photo` varchar(255) DEFAULT NULL COMMENT 'Foto\n',
  `type` tinyint(4) NOT NULL COMMENT 'Tipo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_pets_apartments1_idx` (`apartment_id`),
  FULLTEXT KEY `name` (`name`,`description`),
  CONSTRAINT `fk_pets_apartments1` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `pets` */

insert  into `pets`(`id`,`apartment_id`,`name`,`description`,`photo`,`type`,`created`,`created_by`,`modified`,`modified_by`) values (1,1,'Pipo','Perro negro','archivos/20191021194644-descarga.jpg',1,'2019-10-21 14:46:44','admin','2019-10-21 14:46:44','admin');

/*Table structure for table `residents` */

DROP TABLE IF EXISTS `residents`;

CREATE TABLE `residents` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `apartment_id` int(11) NOT NULL COMMENT 'Apartamento',
  `name` varchar(255) NOT NULL COMMENT 'Nombre',
  `sex` tinyint(4) NOT NULL COMMENT 'Sexo',
  `document_type` tinyint(4) NOT NULL COMMENT 'Tipo de documento',
  `document` varchar(20) NOT NULL COMMENT 'Documento',
  `email` varchar(100) NOT NULL COMMENT 'Correo electrónico',
  `phone` varchar(45) DEFAULT NULL COMMENT 'Celular',
  `photo` varchar(255) NOT NULL COMMENT 'Foto',
  `tags` text NOT NULL COMMENT 'Etiquetas',
  `active` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_residents_apartments1_idx` (`apartment_id`),
  FULLTEXT KEY `name` (`name`,`tags`,`phone`),
  CONSTRAINT `fk_residents_apartments1` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `residents` */

insert  into `residents`(`id`,`apartment_id`,`name`,`sex`,`document_type`,`document`,`email`,`phone`,`photo`,`tags`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (1,1,'Felipe Echeverri',1,1,'98766496','pipe.echeverri.1@gmail.com','3136600674','archivos/20191021194039-descarga.jpg','hola,bien,o ,no',1,'2019-10-21 14:40:39','admin','2019-10-21 14:40:39','admin'),(2,1,'Maria Martinez',2,1,'12343212','maria.martinez@gmail.com','323432321','archivos/20191103221432-descarga.jpg','Esposa felipe',1,'2019-11-03 17:14:32','admin','2019-11-03 17:14:32','admin'),(3,2,'henry Echeverri',1,1,'34567890','henry@gmail.com','3124567667','archivos/20191103231946-descarga.jpg','henry',1,'2019-11-03 18:19:46','admin','2019-11-03 18:19:46','admin');

/*Table structure for table `security_cameras` */

DROP TABLE IF EXISTS `security_cameras`;

CREATE TABLE `security_cameras` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `housing_estate_id` int(11) NOT NULL COMMENT 'Unidad residencial',
  `name` varchar(255) NOT NULL COMMENT 'Nombre de la cámara',
  `description` varchar(255) NOT NULL COMMENT 'Descripción',
  `camera_ip` varchar(45) NOT NULL,
  `code` varchar(45) NOT NULL COMMENT 'Código',
  `active` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_security_cameras_housing_estate1_idx` (`housing_estate_id`),
  CONSTRAINT `fk_security_cameras_housing_estate1` FOREIGN KEY (`housing_estate_id`) REFERENCES `housing_estate` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `security_cameras` */

insert  into `security_cameras`(`id`,`housing_estate_id`,`name`,`description`,`camera_ip`,`code`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (1,1,'Cámara de prueba','Esta es la cámara de prueba de Dany','http://179.13.146.31','4',1,'2020-04-04 16:18:56','admin','2020-04-04 16:21:19','admin'),(2,1,'Cámara de prueba2','Esta es la cámara de prueba de Dany 2','http://179.13.146.31','4',1,'2020-04-04 16:39:30','admin','2020-04-04 16:39:56','admin');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Nombres y Apellidos',
  `username` varchar(45) NOT NULL COMMENT 'Nombre de usuario',
  `password` varchar(100) NOT NULL COMMENT 'Contraseña',
  `mail` varchar(45) NOT NULL COMMENT 'Correo Electrónico',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(150) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(150) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`password`,`mail`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (1,'Administrador','admin','21232f297a57a5a743894a0e4a801fc3','admin@tecuido.co',1,'2019-10-10 00:00:00','admin','2019-10-10 00:00:00','admin'),(2,'Usuarios Api Arroyo de los bernal','usarroyo','c577659ad37ef80fc6592706c38e8f89','admin@admin.com',1,'2019-10-29 13:35:00','admin','2019-10-29 13:35:00','admin');

/*Table structure for table `vehicles` */

DROP TABLE IF EXISTS `vehicles`;

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `apartment_id` int(11) NOT NULL COMMENT 'Apartamento',
  `photo` varchar(255) NOT NULL COMMENT 'Foto',
  `license_plate` varchar(10) NOT NULL COMMENT 'Placa',
  `type` tinyint(4) NOT NULL COMMENT 'Tipo',
  `active` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_vehicles_apartments1_idx` (`apartment_id`),
  CONSTRAINT `fk_vehicles_apartments1` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `vehicles` */

insert  into `vehicles`(`id`,`apartment_id`,`photo`,`license_plate`,`type`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (1,1,'archivos/20191021194603-descarga.jpg','DFV185',1,1,'2019-10-21 14:46:03','admin','2019-10-21 14:46:03','admin');

/*Table structure for table `video_doorman` */

DROP TABLE IF EXISTS `video_doorman`;

CREATE TABLE `video_doorman` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `gate_id` int(11) NOT NULL COMMENT 'Prueta',
  `name` varchar(255) NOT NULL COMMENT 'Nombre',
  `code` varchar(45) NOT NULL COMMENT 'Código',
  `active` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_videoPortero_gates1_idx` (`gate_id`),
  CONSTRAINT `fk_videoPortero_gates1` FOREIGN KEY (`gate_id`) REFERENCES `gates` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `video_doorman` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
