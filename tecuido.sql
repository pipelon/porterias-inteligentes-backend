/*
SQLyog Community v8.71 
MySQL - 5.5.5-10.4.10-MariaDB : Database - tecuido
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `accesscards` */

DROP TABLE IF EXISTS `accesscards`;

CREATE TABLE `accesscards` (
  `code` varchar(45) NOT NULL COMMENT 'Código',
  `resident_id` int(11) NOT NULL COMMENT 'Residente',
  `description` varchar(45) DEFAULT NULL COMMENT 'Descripción',
  `active` tinyint(1) NOT NULL COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`code`),
  KEY `fk_cards_residents1_idx` (`resident_id`),
  CONSTRAINT `fk_cards_residents1` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `accesscards` */

insert  into `accesscards`(`code`,`resident_id`,`description`,`active`,`created`,`created_by`,`modified`,`modified_by`) values ('ABC123',9,'Tarjeta de acceso asignada a Felipe Echeverri',1,'2020-06-11 17:49:49','admin','2020-06-11 17:49:49','admin'),('ABC321',11,'Tarjeta de acceso asignada a JuanGoznalez',1,'2020-06-11 17:05:05','admin','2020-06-11 17:05:05','admin');

/*Table structure for table `accesscards_log` */

DROP TABLE IF EXISTS `accesscards_log`;

CREATE TABLE `accesscards_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `card_code` varchar(20) NOT NULL COMMENT 'Código tarjeta',
  `state` tinyint(1) NOT NULL COMMENT 'Estado',
  `state_description` text NOT NULL COMMENT 'Descripción',
  `created` datetime NOT NULL COMMENT 'Fecha',
  PRIMARY KEY (`id`),
  KEY `fk_cards_log_cards1_idx` (`card_code`),
  CONSTRAINT `fk_cards_log_cards1` FOREIGN KEY (`card_code`) REFERENCES `accesscards` (`code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `accesscards_log` */

insert  into `accesscards_log`(`id`,`card_code`,`state`,`state_description`,`created`) values (18,'ABC123',1,'1','2020-06-11 00:00:00');

/*Table structure for table `accesscards_vehicles` */

DROP TABLE IF EXISTS `accesscards_vehicles`;

CREATE TABLE `accesscards_vehicles` (
  `code` varchar(45) NOT NULL COMMENT 'Código',
  `vehicle_id` int(11) NOT NULL COMMENT 'Vehículo',
  `description` varchar(45) DEFAULT NULL COMMENT 'Descripción',
  `active` tinyint(1) NOT NULL COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`code`),
  KEY `fk_accesscardsvehicles_vehicles1_idx` (`vehicle_id`),
  CONSTRAINT `fk_accesscardsvehicles_vehicles1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `accesscards_vehicles` */

insert  into `accesscards_vehicles`(`code`,`vehicle_id`,`description`,`active`,`created`,`created_by`,`modified`,`modified_by`) values ('XYZ123',5,'',1,'2020-06-11 17:41:11','admin','2020-06-11 17:41:11','admin');

/*Table structure for table `accesscardsvehicles_log` */

DROP TABLE IF EXISTS `accesscardsvehicles_log`;

CREATE TABLE `accesscardsvehicles_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `accesscard_vehicle_code` varchar(45) NOT NULL COMMENT 'Tarjeta de acceso',
  `state` tinyint(1) NOT NULL COMMENT 'Estado',
  `state_description` text NOT NULL COMMENT 'Descripción',
  `created` datetime NOT NULL COMMENT 'Fecha',
  PRIMARY KEY (`id`),
  KEY `fk_accesscardsvehicles_log_accesscards_vehicles1_idx` (`accesscard_vehicle_code`),
  CONSTRAINT `fk_accesscardsvehicles_log_accesscards_vehicles1` FOREIGN KEY (`accesscard_vehicle_code`) REFERENCES `accesscards_vehicles` (`code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `accesscardsvehicles_log` */

insert  into `accesscardsvehicles_log`(`id`,`accesscard_vehicle_code`,`state`,`state_description`,`created`) values (17,'XYZ123',1,'1','2020-06-11 00:00:00');

/*Table structure for table `administrators` */

DROP TABLE IF EXISTS `administrators`;

CREATE TABLE `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `housing_estate_id` int(11) NOT NULL COMMENT 'Unidad residencial',
  `name` varchar(255) NOT NULL COMMENT 'Nombre administrador/a',
  `cellphone` varchar(15) NOT NULL COMMENT 'Número de celular',
  `email` varchar(100) DEFAULT NULL COMMENT 'Correo electrónico',
  `startdate` date DEFAULT NULL COMMENT 'Fecha de inicio',
  `enddate` date DEFAULT NULL COMMENT 'Fecha fin',
  `photo` varchar(255) DEFAULT NULL COMMENT 'Foto',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_administrators_housing_estate1_idx` (`housing_estate_id`),
  CONSTRAINT `fk_administrators_housing_estate1` FOREIGN KEY (`housing_estate_id`) REFERENCES `housing_estate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `administrators` */

insert  into `administrators`(`id`,`housing_estate_id`,`name`,`cellphone`,`email`,`startdate`,`enddate`,`photo`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (3,1,'Andrea Duque','3136600674','andrea@gmail.com','2020-06-01','2020-06-10','archivos/20200611201310-foto.jpg',1,'2020-06-11 15:13:10','supervisor','2020-06-11 15:13:10','supervisor');

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
  CONSTRAINT `fk_apartments_housing_estate1` FOREIGN KEY (`housing_estate_id`) REFERENCES `housing_estate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `apartments` */

insert  into `apartments`(`id`,`housing_estate_id`,`block`,`floor`,`name`,`phone_number_1`,`phone_number_2`,`cellphone_number_1`,`cellphone_number_2`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (4,2,'15',8,'817','3136600674','3136600674','3136600674','3136600674',1,'2020-06-11 14:24:37','admin','2020-06-11 14:24:37','admin'),(5,2,'15',8,'820','3136600674','3136600674','3136600674','3136600674',1,'2020-06-11 14:51:33','admin','2020-06-11 14:51:33','admin'),(6,1,'2',2,'2001','3136600674','3136600674','3136600674','3136600674',1,'2020-06-11 14:52:06','admin','2020-06-11 14:52:06','admin');

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

insert  into `auth_assignment`(`item_name`,`user_id`,`created_at`) values ('Portero','3',1589816745),('Portero','4',1589816739),('SuperAdministrador','1',1570722074),('Supervisor','5',1589919245);

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

insert  into `auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('/*',2,NULL,NULL,NULL,1570722005,1570722005),('/accesscards-log/*',2,NULL,NULL,NULL,1591913687,1591913687),('/accesscards-log/delete',2,NULL,NULL,NULL,1591913687,1591913687),('/accesscards-log/index',2,NULL,NULL,NULL,1591913686,1591913686),('/accesscards-log/view',2,NULL,NULL,NULL,1591913686,1591913686),('/accesscards-vehicles/*',2,NULL,NULL,NULL,1591914714,1591914714),('/accesscards-vehicles/create',2,NULL,NULL,NULL,1591914714,1591914714),('/accesscards-vehicles/delete',2,NULL,NULL,NULL,1591914714,1591914714),('/accesscards-vehicles/index',2,NULL,NULL,NULL,1591914714,1591914714),('/accesscards-vehicles/update',2,NULL,NULL,NULL,1591914714,1591914714),('/accesscards-vehicles/view',2,NULL,NULL,NULL,1591914714,1591914714),('/accesscards/*',2,NULL,NULL,NULL,1591911575,1591911575),('/accesscards/create',2,NULL,NULL,NULL,1591911574,1591911574),('/accesscards/delete',2,NULL,NULL,NULL,1591911574,1591911574),('/accesscards/index',2,NULL,NULL,NULL,1591911574,1591911574),('/accesscards/update',2,NULL,NULL,NULL,1591911574,1591911574),('/accesscards/view',2,NULL,NULL,NULL,1591911574,1591911574),('/accesscardsvehicles-log/*',2,NULL,NULL,NULL,1591914717,1591914717),('/accesscardsvehicles-log/delete',2,NULL,NULL,NULL,1591914717,1591914717),('/accesscardsvehicles-log/index',2,NULL,NULL,NULL,1591914717,1591914717),('/accesscardsvehicles-log/view',2,NULL,NULL,NULL,1591914717,1591914717),('/admin/*',2,NULL,NULL,NULL,1570722005,1570722005),('/admin/assignment/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/assignment/assign',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/assignment/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/assignment/revoke',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/assignment/view',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/default/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/default/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/menu/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/menu/create',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/menu/delete',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/menu/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/menu/update',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/menu/view',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/assign',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/create',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/delete',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/remove',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/update',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/permission/view',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/assign',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/create',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/delete',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/remove',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/update',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/role/view',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/route/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/route/assign',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/route/create',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/route/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/route/refresh',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/route/remove',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/rule/*',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/rule/create',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/rule/delete',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/rule/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/rule/update',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/rule/view',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/*',2,NULL,NULL,NULL,1570722005,1570722005),('/admin/user/activate',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/change-password',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/delete',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/index',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/login',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/logout',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/request-password-reset',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/reset-password',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/signup',2,NULL,NULL,NULL,1570722004,1570722004),('/admin/user/view',2,NULL,NULL,NULL,1570722004,1570722004),('/administrators/*',2,NULL,NULL,NULL,1571248460,1571248460),('/administrators/create',2,NULL,NULL,NULL,1571248460,1571248460),('/administrators/delete',2,NULL,NULL,NULL,1571248460,1571248460),('/administrators/index',2,NULL,NULL,NULL,1571248460,1571248460),('/administrators/update',2,NULL,NULL,NULL,1571248460,1571248460),('/administrators/view',2,NULL,NULL,NULL,1571248460,1571248460),('/apartments/*',2,NULL,NULL,NULL,1571143686,1571143686),('/apartments/create',2,NULL,NULL,NULL,1571143686,1571143686),('/apartments/delete',2,NULL,NULL,NULL,1571143686,1571143686),('/apartments/index',2,NULL,NULL,NULL,1571143686,1571143686),('/apartments/update',2,NULL,NULL,NULL,1571143686,1571143686),('/apartments/view',2,NULL,NULL,NULL,1571143686,1571143686),('/api/*',2,NULL,NULL,NULL,1572363665,1572363665),('/api/accesscard',2,NULL,NULL,NULL,1591903780,1591903780),('/api/gates',2,NULL,NULL,NULL,1591903779,1591903779),('/api/index',2,NULL,NULL,NULL,1572363665,1572363665),('/api/login',2,NULL,NULL,NULL,1589919369,1589919369),('/api/logout',2,NULL,NULL,NULL,1589919369,1589919369),('/api/options',2,NULL,NULL,NULL,1572363665,1572363665),('/api/searchapartment',2,NULL,NULL,NULL,1586034174,1586034174),('/api/view',2,NULL,NULL,NULL,1572363665,1572363665),('/blocks/*',2,NULL,NULL,NULL,1570724410,1570724410),('/blocks/create',2,NULL,NULL,NULL,1570724410,1570724410),('/blocks/delete',2,NULL,NULL,NULL,1570724410,1570724410),('/blocks/index',2,NULL,NULL,NULL,1570724410,1570724410),('/blocks/update',2,NULL,NULL,NULL,1570724410,1570724410),('/blocks/view',2,NULL,NULL,NULL,1570724410,1570724410),('/cities/*',2,NULL,NULL,NULL,1572363665,1572363665),('/cities/create',2,NULL,NULL,NULL,1572363665,1572363665),('/cities/delete',2,NULL,NULL,NULL,1572363665,1572363665),('/cities/index',2,NULL,NULL,NULL,1572363665,1572363665),('/cities/update',2,NULL,NULL,NULL,1572363665,1572363665),('/cities/view',2,NULL,NULL,NULL,1572363665,1572363665),('/debug/*',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/default/*',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/default/db-explain',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/default/download-mail',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/default/index',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/default/toolbar',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/default/view',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/user/*',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/user/reset-identity',2,NULL,NULL,NULL,1570722005,1570722005),('/debug/user/set-identity',2,NULL,NULL,NULL,1570722005,1570722005),('/gates-logs/*',2,NULL,NULL,NULL,1591021630,1591021630),('/gates-logs/create',2,NULL,NULL,NULL,1591021630,1591021630),('/gates-logs/delete',2,NULL,NULL,NULL,1591021630,1591021630),('/gates-logs/index',2,NULL,NULL,NULL,1591021630,1591021630),('/gates-logs/update',2,NULL,NULL,NULL,1591021630,1591021630),('/gates-logs/view',2,NULL,NULL,NULL,1591021630,1591021630),('/gates/*',2,NULL,NULL,NULL,1571249918,1571249918),('/gates/create',2,NULL,NULL,NULL,1571249918,1571249918),('/gates/delete',2,NULL,NULL,NULL,1571249918,1571249918),('/gates/index',2,NULL,NULL,NULL,1571249918,1571249918),('/gates/update',2,NULL,NULL,NULL,1571249918,1571249918),('/gates/view',2,NULL,NULL,NULL,1571249918,1571249918),('/gii/*',2,NULL,NULL,NULL,1570722005,1570722005),('/gii/default/*',2,NULL,NULL,NULL,1570722005,1570722005),('/gii/default/action',2,NULL,NULL,NULL,1570722005,1570722005),('/gii/default/diff',2,NULL,NULL,NULL,1570722005,1570722005),('/gii/default/index',2,NULL,NULL,NULL,1570722005,1570722005),('/gii/default/preview',2,NULL,NULL,NULL,1570722005,1570722005),('/gii/default/view',2,NULL,NULL,NULL,1570722005,1570722005),('/gridview/*',2,NULL,NULL,NULL,1591903779,1591903779),('/gridview/export/*',2,NULL,NULL,NULL,1591903779,1591903779),('/gridview/export/download',2,NULL,NULL,NULL,1591903779,1591903779),('/housing-estate-security-guard/*',2,NULL,NULL,NULL,1589820047,1589820047),('/housing-estate-security-guard/create',2,NULL,NULL,NULL,1589820047,1589820047),('/housing-estate-security-guard/delete',2,NULL,NULL,NULL,1589820047,1589820047),('/housing-estate-security-guard/index',2,NULL,NULL,NULL,1589820047,1589820047),('/housing-estate-security-guard/update',2,NULL,NULL,NULL,1589820047,1589820047),('/housing-estate-security-guard/view',2,NULL,NULL,NULL,1589820047,1589820047),('/housing-estate/*',2,NULL,NULL,NULL,1570722005,1570722005),('/housing-estate/create',2,NULL,NULL,NULL,1570722005,1570722005),('/housing-estate/delete',2,NULL,NULL,NULL,1570722005,1570722005),('/housing-estate/index',2,NULL,NULL,NULL,1570722005,1570722005),('/housing-estate/update',2,NULL,NULL,NULL,1570722005,1570722005),('/housing-estate/view',2,NULL,NULL,NULL,1570722005,1570722005),('/pets/*',2,NULL,NULL,NULL,1571175515,1571175515),('/pets/create',2,NULL,NULL,NULL,1571175515,1571175515),('/pets/delete',2,NULL,NULL,NULL,1571175515,1571175515),('/pets/index',2,NULL,NULL,NULL,1571175515,1571175515),('/pets/update',2,NULL,NULL,NULL,1571175515,1571175515),('/pets/view',2,NULL,NULL,NULL,1571175515,1571175515),('/residents/*',2,NULL,NULL,NULL,1571150683,1571150683),('/residents/create',2,NULL,NULL,NULL,1571150683,1571150683),('/residents/delete',2,NULL,NULL,NULL,1571150683,1571150683),('/residents/index',2,NULL,NULL,NULL,1571150683,1571150683),('/residents/update',2,NULL,NULL,NULL,1571150683,1571150683),('/residents/view',2,NULL,NULL,NULL,1571150683,1571150683),('/security-cameras/*',2,NULL,NULL,NULL,1586034175,1586034175),('/security-cameras/create',2,NULL,NULL,NULL,1586034175,1586034175),('/security-cameras/delete',2,NULL,NULL,NULL,1586034175,1586034175),('/security-cameras/index',2,NULL,NULL,NULL,1586034175,1586034175),('/security-cameras/update',2,NULL,NULL,NULL,1586034175,1586034175),('/security-cameras/view',2,NULL,NULL,NULL,1586034175,1586034175),('/security-guards/*',2,NULL,NULL,NULL,1589919369,1589919369),('/security-guards/create',2,NULL,NULL,NULL,1589919369,1589919369),('/security-guards/delete',2,NULL,NULL,NULL,1589919369,1589919369),('/security-guards/index',2,NULL,NULL,NULL,1589919369,1589919369),('/security-guards/update',2,NULL,NULL,NULL,1589919369,1589919369),('/security-guards/view',2,NULL,NULL,NULL,1589919369,1589919369),('/site/*',2,NULL,NULL,NULL,1570722005,1570722005),('/site/about',2,NULL,NULL,NULL,1570722005,1570722005),('/site/captcha',2,NULL,NULL,NULL,1570722005,1570722005),('/site/contact',2,NULL,NULL,NULL,1570722005,1570722005),('/site/error',2,NULL,NULL,NULL,1570722005,1570722005),('/site/index',2,NULL,NULL,NULL,1570722005,1570722005),('/site/login',2,NULL,NULL,NULL,1570722005,1570722005),('/site/logout',2,NULL,NULL,NULL,1570722005,1570722005),('/users/*',2,NULL,NULL,NULL,1570722005,1570722005),('/users/create',2,NULL,NULL,NULL,1570722005,1570722005),('/users/delete',2,NULL,NULL,NULL,1570722005,1570722005),('/users/index',2,NULL,NULL,NULL,1570722005,1570722005),('/users/update',2,NULL,NULL,NULL,1570722005,1570722005),('/users/view',2,NULL,NULL,NULL,1570722005,1570722005),('/vehicles/*',2,NULL,NULL,NULL,1571244290,1571244290),('/vehicles/create',2,NULL,NULL,NULL,1571244290,1571244290),('/vehicles/delete',2,NULL,NULL,NULL,1571244290,1571244290),('/vehicles/index',2,NULL,NULL,NULL,1571244290,1571244290),('/vehicles/update',2,NULL,NULL,NULL,1571244290,1571244290),('/vehicles/view',2,NULL,NULL,NULL,1571244290,1571244290),('fullPermission',2,'Permiso a todas las rutas',NULL,NULL,1570722030,1570722030),('Portero',1,NULL,NULL,NULL,1589816597,1589816597),('SuperAdministrador',1,'Super Administrador con acceso a todas las rutas',NULL,NULL,1570722062,1570722062),('supervisar',2,NULL,NULL,NULL,1589919168,1589919168),('Supervisor',1,NULL,NULL,NULL,1589919154,1589919154);

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

insert  into `auth_item_child`(`parent`,`child`) values ('fullPermission','/*'),('SuperAdministrador','fullPermission'),('supervisar','/administrators/*'),('supervisar','/administrators/create'),('supervisar','/administrators/delete'),('supervisar','/administrators/index'),('supervisar','/administrators/update'),('supervisar','/administrators/view'),('supervisar','/apartments/*'),('supervisar','/apartments/create'),('supervisar','/apartments/delete'),('supervisar','/apartments/index'),('supervisar','/apartments/update'),('supervisar','/apartments/view'),('supervisar','/housing-estate/*'),('supervisar','/housing-estate/create'),('supervisar','/housing-estate/delete'),('supervisar','/housing-estate/index'),('supervisar','/housing-estate/update'),('supervisar','/housing-estate/view'),('supervisar','/pets/*'),('supervisar','/pets/create'),('supervisar','/pets/delete'),('supervisar','/pets/index'),('supervisar','/pets/update'),('supervisar','/pets/view'),('supervisar','/residents/*'),('supervisar','/residents/create'),('supervisar','/residents/delete'),('supervisar','/residents/index'),('supervisar','/residents/update'),('supervisar','/residents/view'),('supervisar','/site/*'),('supervisar','/users/update'),('supervisar','/users/view'),('supervisar','/vehicles/*'),('supervisar','/vehicles/create'),('supervisar','/vehicles/delete'),('supervisar','/vehicles/index'),('supervisar','/vehicles/update'),('supervisar','/vehicles/view'),('Supervisor','supervisar');

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

/*Table structure for table `cities` */

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(100) NOT NULL COMMENT 'Nombre',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime DEFAULT NULL COMMENT 'Creado',
  `created_by` varchar(45) DEFAULT NULL COMMENT 'Creado por',
  `modified` datetime DEFAULT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) DEFAULT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `cities` */

insert  into `cities`(`id`,`name`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (7,'Bogotá',1,'2020-06-11 13:46:20','admin','2020-06-11 13:46:20','admin'),(8,'Medellín',1,'2020-06-11 13:46:29','admin','2020-06-11 13:46:29','admin'),(9,'Envigado',1,'2020-06-11 13:46:37','admin','2020-06-11 13:46:37','admin'),(10,'Sabaneta',1,'2020-06-11 13:46:42','admin','2020-06-11 13:46:42','admin'),(11,'Itagüi',1,'2020-06-11 13:46:57','admin','2020-06-11 13:46:57','admin'),(12,'Caldas',1,'2020-06-11 13:47:05','admin','2020-06-11 13:47:05','admin'),(13,'La Estrella',1,'2020-06-11 13:47:16','admin','2020-06-11 13:47:16','admin');

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
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_gates_housing_estate1_idx` (`housing_estate_id`),
  CONSTRAINT `fk_gates_housing_estate1` FOREIGN KEY (`housing_estate_id`) REFERENCES `housing_estate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `gates` */

/*Table structure for table `gates_logs` */

DROP TABLE IF EXISTS `gates_logs`;

CREATE TABLE `gates_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `gate_id` int(11) NOT NULL COMMENT 'Portería ID',
  `state` tinyint(4) NOT NULL COMMENT 'Estado',
  `state_description` varchar(45) NOT NULL COMMENT 'Descripción',
  `created` datetime NOT NULL COMMENT 'Fecha',
  PRIMARY KEY (`id`),
  KEY `fk_gates_logs_gates1_idx` (`gate_id`),
  CONSTRAINT `fk_gates_logs_gates1` FOREIGN KEY (`gate_id`) REFERENCES `gates` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

/*Data for the table `gates_logs` */

/*Table structure for table `housing_estate` */

DROP TABLE IF EXISTS `housing_estate`;

CREATE TABLE `housing_estate` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(100) NOT NULL COMMENT 'Nombre unidad residencial',
  `description` varchar(255) NOT NULL COMMENT 'Descripción',
  `location` varchar(100) NOT NULL COMMENT 'Ubicación',
  `address` varchar(255) NOT NULL COMMENT 'Dirección',
  `phone_number` varchar(15) DEFAULT NULL COMMENT 'Teléfono portería',
  `police_phone_number` varchar(15) DEFAULT NULL COMMENT 'Número del cuadrante',
  `city_id` int(11) NOT NULL,
  `neighborhood` varchar(100) NOT NULL COMMENT 'Barrio',
  `security_guard_id` int(11) NOT NULL COMMENT 'Portero',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_housing_estate_cities1_idx1` (`city_id`),
  KEY `fk_housing_estate_users1_idx` (`security_guard_id`),
  CONSTRAINT `fk_housing_estate_cities1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_housing_estate_users1` FOREIGN KEY (`security_guard_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `housing_estate` */

insert  into `housing_estate`(`id`,`name`,`description`,`location`,`address`,`phone_number`,`police_phone_number`,`city_id`,`neighborhood`,`security_guard_id`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (1,'Mirador Del Sur Apartamentos','Unidad residencial Mirador Del Sur Apartamentos','6.150964002031084,-75.63672991040038','Carrera 59 # 82-sur 31','3152499418','123',13,'Parque la estrella',3,1,'2020-06-11 13:57:35','admin','2020-06-11 13:57:35','admin'),(2,'Palmeras Etapa 3','Unidad residencial Palmeras Etapa 3','6.166836365753846,-75.58454485180663','Calle 40 A Sur # 24 B - 105','123456','123',9,'La Mina',3,1,'2020-06-11 14:04:18','admin','2020-06-11 14:04:18','admin');

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `menu` */

insert  into `menu`(`id`,`name`,`parent`,`route`,`order`,`data`) values (1,'U. residenciales',19,'/housing-estate/index',1,' flaticon-map-location'),(2,'Ciudades',9,'/cities/index',3,' flaticon-placeholder-2'),(3,'Apartamentos',19,'/apartments/index',2,' fa-building'),(4,'Residentes',19,'/residents/index',3,' flaticon-users'),(5,'Mascotas',19,'/pets/index',5,' fa-paw\r\n'),(6,'Vehículos',19,'/vehicles/index',6,' fa-car'),(7,'Administradores',19,'/administrators/index',7,' flaticon-profile'),(8,'Puertas',20,'/gates/index',4,' flaticon-interface'),(9,'Configuración',NULL,NULL,11,' flaticon-cogwheel'),(10,'Usuarios',9,'/users/index',1,' flaticon-users'),(11,'Asignaciones',9,'/admin/assignment/index',3,' flaticon-user-ok'),(13,'Cámaras',20,'/security-cameras/index',3,' fa-camera'),(14,'Asignar porteros',9,'/security-guards/index',NULL,' flaticon-profile-1'),(15,'T. de acceso peatonal',20,'/accesscards/index',1,' flaticon-lock'),(16,'Logs',NULL,NULL,10,' flaticon-clipboard'),(17,'Porterías',16,'/gates-logs/index',2,' flaticon-clipboard'),(18,'T. de acceso peatonal',16,'/accesscards-log/index',1,' flaticon-clipboard'),(19,'General',NULL,NULL,1,' flaticon-add'),(20,'Seguridad',NULL,NULL,2,' flaticon-lock-1'),(21,'T. de acceso vehicular',20,'/accesscards-vehicles/index',2,' flaticon-lock'),(22,'T. de acceso vehicular',16,'/accesscardsvehicles-log/index',3,' flaticon-clipboard');

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
  `photo` varchar(255) DEFAULT NULL COMMENT 'Foto\\n',
  `type` tinyint(2) NOT NULL COMMENT 'Tipo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_pets_apartments1_idx` (`apartment_id`),
  FULLTEXT KEY `name` (`name`,`description`),
  CONSTRAINT `fk_pets_apartments1` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `pets` */

insert  into `pets`(`id`,`apartment_id`,`name`,`description`,`photo`,`type`,`created`,`created_by`,`modified`,`modified_by`) values (5,4,'Pipo','','archivos/20200611202127-pipo.jpg',1,'2020-06-11 15:21:27','admin','2020-06-11 15:21:27','admin');

/*Table structure for table `residents` */

DROP TABLE IF EXISTS `residents`;

CREATE TABLE `residents` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `apartment_id` int(11) NOT NULL COMMENT 'Apartamento',
  `name` varchar(255) NOT NULL COMMENT 'Nombre',
  `sex` tinyint(4) NOT NULL COMMENT 'Sexo',
  `document_type` tinyint(4) NOT NULL COMMENT 'Tipo de documento',
  `document` varchar(20) NOT NULL COMMENT 'Documento',
  `email` varchar(100) DEFAULT NULL COMMENT 'Correo electrónico',
  `phone` varchar(45) DEFAULT NULL COMMENT 'Celular',
  `photo` varchar(255) DEFAULT NULL COMMENT 'Foto',
  `tags` text DEFAULT NULL COMMENT 'Etiquetas',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Activo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_residents_apartments1_idx` (`apartment_id`),
  FULLTEXT KEY `name` (`name`,`tags`,`phone`),
  CONSTRAINT `fk_residents_apartments1` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `residents` */

insert  into `residents`(`id`,`apartment_id`,`name`,`sex`,`document_type`,`document`,`email`,`phone`,`photo`,`tags`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (9,4,'Felipe Echeverri Arboleda',1,1,'98766496','pipe.echeverri.1@gmail.com','3136600674','','',1,'2020-06-11 14:53:32','admin','2020-06-11 17:01:33','admin'),(10,5,'Liliana Arboleda',2,1,'43323456','liliana@gmail.com','','','',1,'2020-06-11 14:54:20','admin','2020-06-11 14:54:20','admin'),(11,6,'Juan Gonzalez',1,1,'123456','jan@gmail.com','','archivos/20200611195452-foto.jpg','',1,'2020-06-11 14:54:52','admin','2020-06-11 14:54:52','admin');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `security_cameras` */

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`password`,`mail`,`active`,`created`,`created_by`,`modified`,`modified_by`) values (1,'Administrador','admin','21232f297a57a5a743894a0e4a801fc3','admin@tecuido.co',1,'2019-10-10 00:00:00','admin','2019-10-10 00:00:00','admin'),(2,'Usuarios Api Arroyo de los bernal','usarroyo','c577659ad37ef80fc6592706c38e8f89','admin@admin.com',1,'2019-10-29 13:35:00','admin','2019-10-29 13:35:00','admin'),(3,'Pedro Perez','pedro','c6cc8094c2dc07b700ffcc36d64e2138','pedro@gmail.com',1,'2020-05-18 10:44:49','admin','2020-05-18 10:44:49','admin'),(4,'Martin Martinez','martin','925d7518fc597af0e43f5606f9a51512','martin@gmail.com',1,'2020-05-18 10:45:25','admin','2020-05-18 10:45:25','admin'),(5,'Supervisor','supervisor','09348c20a019be0318387c08df7a783d','supervisor@gmail.com',1,'2020-05-19 15:13:46','admin','2020-06-11 15:10:14','supervisor');

/*Table structure for table `vehicles` */

DROP TABLE IF EXISTS `vehicles`;

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `apartment_id` int(11) NOT NULL COMMENT 'Apartamento',
  `photo` varchar(255) NOT NULL COMMENT 'Foto',
  `license_plate` varchar(10) NOT NULL COMMENT 'Placa',
  `type` tinyint(2) NOT NULL COMMENT 'Tipo',
  `created` datetime NOT NULL COMMENT 'Creado',
  `created_by` varchar(45) NOT NULL COMMENT 'Creado por',
  `modified` datetime NOT NULL COMMENT 'Modificado',
  `modified_by` varchar(45) NOT NULL COMMENT 'Modificado por',
  PRIMARY KEY (`id`),
  KEY `fk_vehicles_apartments1_idx` (`apartment_id`),
  CONSTRAINT `fk_vehicles_apartments1` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `vehicles` */

insert  into `vehicles`(`id`,`apartment_id`,`photo`,`license_plate`,`type`,`created`,`created_by`,`modified`,`modified_by`) values (5,4,'archivos/20200611203514-auto.jpg','DFV185',1,'2020-06-11 15:35:14','admin','2020-06-11 15:35:14','admin');

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
