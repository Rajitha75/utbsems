/*
SQLyog Community v13.1.1 (64 bit)
MySQL - 5.7.24 : Database - utbsems
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`utbsems` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `utbsems`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(128) DEFAULT NULL,
  `mobile` varchar(128) DEFAULT NULL,
  `user_ref_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id`,`name`,`email`,`gender`,`mobile`,`user_ref_id`) values 
(1,'admin','test@123','Female','838843',1652);

/*Table structure for table `auth_assignment` */

DROP TABLE IF EXISTS `auth_assignment`;

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_assignment` */

/*Table structure for table `auth_item` */

DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `group_code` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  KEY `fk_auth_item_group_code` (`group_code`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_auth_item_group_code` FOREIGN KEY (`group_code`) REFERENCES `auth_item_group` (`code`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_item` */

insert  into `auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`,`group_code`) values 
('/*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('//*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('//controller',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('//crud',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('//extension',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('//form',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('//index',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('//model',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('//module',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/asset/*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/asset/compress',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/asset/template',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/cache/*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/cache/flush',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/cache/flush-all',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/cache/flush-schema',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/cache/index',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/fixture/*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/fixture/load',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/fixture/unload',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/gii/*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/gii/default/*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/gii/default/action',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/gii/default/diff',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/gii/default/index',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/gii/default/preview',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/gii/default/view',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/hello/*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/hello/index',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/help/*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/help/index',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/message/*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/message/config',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/message/extract',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/migrate/*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/migrate/create',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/migrate/down',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/migrate/history',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/migrate/mark',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/migrate/new',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/migrate/redo',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/migrate/to',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/migrate/up',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth-item-group/*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth-item-group/bulk-activate',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth-item-group/bulk-deactivate',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth-item-group/bulk-delete',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth-item-group/create',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth-item-group/delete',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth-item-group/grid-page-size',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth-item-group/grid-sort',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth-item-group/index',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth-item-group/toggle-attribute',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth-item-group/update',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth-item-group/view',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth/*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth/captcha',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth/change-own-password',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth/confirm-email',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth/confirm-email-receive',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth/confirm-registration-email',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth/login',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth/logout',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth/password-recovery',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth/password-recovery-receive',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/auth/registration',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/permission/*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/permission/bulk-activate',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/permission/bulk-deactivate',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/permission/bulk-delete',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/permission/create',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/permission/delete',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/permission/grid-page-size',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/permission/grid-sort',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/permission/index',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/permission/refresh-routes',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/permission/set-child-permissions',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/permission/set-child-routes',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/permission/toggle-attribute',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/permission/update',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/permission/view',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/role/*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/role/bulk-activate',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/role/bulk-deactivate',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/role/bulk-delete',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/role/create',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/role/delete',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/role/grid-page-size',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/role/grid-sort',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/role/index',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/role/set-child-permissions',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/role/set-child-roles',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/role/toggle-attribute',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/role/update',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/role/view',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user-permission/*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user-permission/set',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user-permission/set-roles',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user-visit-log/*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user-visit-log/bulk-activate',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user-visit-log/bulk-deactivate',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user-visit-log/bulk-delete',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user-visit-log/create',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user-visit-log/delete',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user-visit-log/grid-page-size',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user-visit-log/grid-sort',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user-visit-log/index',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user-visit-log/toggle-attribute',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user-visit-log/update',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user-visit-log/view',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user/*',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user/bulk-activate',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user/bulk-deactivate',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user/bulk-delete',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user/change-password',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user/create',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user/delete',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user/grid-page-size',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user/grid-sort',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user/index',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user/toggle-attribute',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user/update',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('/user-management/user/view',3,NULL,NULL,NULL,1426062189,1426062189,NULL),
('Admin',1,'Admin',NULL,NULL,1426062189,1426062189,NULL),
('assignRolesToUsers',2,'Assign roles to users',NULL,NULL,1426062189,1426062189,'userManagement'),
('bindUserToIp',2,'Bind user to IP',NULL,NULL,1426062189,1426062189,'userManagement'),
('changeOwnPassword',2,'Change own password',NULL,NULL,1426062189,1426062189,'userCommonPermissions'),
('changeUserPassword',2,'Change user password',NULL,NULL,1426062189,1426062189,'userManagement'),
('commonPermission',2,'Common permission',NULL,NULL,1426062188,1426062188,NULL),
('createUsers',2,'Create users',NULL,NULL,1426062189,1426062189,'userManagement'),
('deleteUsers',2,'Delete users',NULL,NULL,1426062189,1426062189,'userManagement'),
('editUserEmail',2,'Edit user email',NULL,NULL,1426062189,1426062189,'userManagement'),
('editUsers',2,'Edit users',NULL,NULL,1426062189,1426062189,'userManagement'),
('viewRegistrationIp',2,'View registration IP',NULL,NULL,1426062189,1426062189,'userManagement'),
('viewUserEmail',2,'View user email',NULL,NULL,1426062189,1426062189,'userManagement'),
('viewUserRoles',2,'View user roles',NULL,NULL,1426062189,1426062189,'userManagement'),
('viewUsers',2,'View users',NULL,NULL,1426062189,1426062189,'userManagement'),
('viewVisitLog',2,'View visit log',NULL,NULL,1426062189,1426062189,'userManagement');

/*Table structure for table `auth_item_child` */

DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_item_child` */

insert  into `auth_item_child`(`parent`,`child`) values 
('changeOwnPassword','/user-management/auth/change-own-password'),
('assignRolesToUsers','/user-management/user-permission/set'),
('assignRolesToUsers','/user-management/user-permission/set-roles'),
('viewVisitLog','/user-management/user-visit-log/grid-page-size'),
('viewVisitLog','/user-management/user-visit-log/index'),
('viewVisitLog','/user-management/user-visit-log/view'),
('editUsers','/user-management/user/bulk-activate'),
('editUsers','/user-management/user/bulk-deactivate'),
('deleteUsers','/user-management/user/bulk-delete'),
('changeUserPassword','/user-management/user/change-password'),
('createUsers','/user-management/user/create'),
('deleteUsers','/user-management/user/delete'),
('viewUsers','/user-management/user/grid-page-size'),
('viewUsers','/user-management/user/index'),
('editUsers','/user-management/user/update'),
('viewUsers','/user-management/user/view'),
('Admin','assignRolesToUsers'),
('Admin','changeOwnPassword'),
('Admin','changeUserPassword'),
('Admin','createUsers'),
('Admin','deleteUsers'),
('Admin','editUsers'),
('editUserEmail','viewUserEmail'),
('assignRolesToUsers','viewUserRoles'),
('Admin','viewUsers'),
('assignRolesToUsers','viewUsers'),
('changeUserPassword','viewUsers'),
('createUsers','viewUsers'),
('deleteUsers','viewUsers'),
('editUsers','viewUsers');

/*Table structure for table `auth_item_group` */

DROP TABLE IF EXISTS `auth_item_group`;

CREATE TABLE `auth_item_group` (
  `code` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_item_group` */

insert  into `auth_item_group`(`code`,`name`,`created_at`,`updated_at`) values 
('userCommonPermissions','User common permission',1426062189,1426062189),
('userManagement','User management',1426062189,1426062189);

/*Table structure for table `auth_rule` */

DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `auth_rule` */

/*Table structure for table `email_templates` */

DROP TABLE IF EXISTS `email_templates`;

CREATE TABLE `email_templates` (
  `mail_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(100) NOT NULL,
  `descrition` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`mail_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `email_templates` */

/*Table structure for table `error_log` */

DROP TABLE IF EXISTS `error_log`;

CREATE TABLE `error_log` (
  `error_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `error_text` varchar(150) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`error_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `error_log` */

/*Table structure for table `feedback` */

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `projectname` varchar(255) DEFAULT NULL,
  `message` text,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `feedback` */

/*Table structure for table `login_attempts` */

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_ref_id` int(11) NOT NULL,
  `attempts` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `reset_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `login_attempts` */

/*Table structure for table `session` */

DROP TABLE IF EXISTS `session`;

CREATE TABLE `session` (
  `id` char(40) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `session` */

insert  into `session`(`id`,`expire`,`data`) values 
('60u6vtl8smsr12qk34onb9hdm6',1568227129,'__flash|a:0:{}__id|i:7;__expire|i:1568226889;__auth_last_update|i:1553172648;__userRoles|a:0:{}__userPermissions|a:0:{}__userRoutes|a:0:{}email|s:17:\"student@gmail.com\";userRole|i:2;'),
('j2hre5641vppkhqbau7m1e9991',1568231129,'__flash|a:0:{}secretkey|s:18:\"$%%EquiPPP@2018%%$\";__id|i:1;__expire|i:1568230889;__auth_last_update|i:1556278019;__userRoles|a:0:{}__userPermissions|a:0:{}__userRoutes|a:0:{}'),
('j9i3e99knj42rdteanmcv9ik33',1568235093,'__flash|a:0:{}secretkey|s:18:\"$%%EquiPPP@2018%%$\";__auth_last_update|i:1556278019;__id|i:1;__expire|i:1568234851;__userRoles|a:0:{}__userPermissions|a:0:{}__userRoutes|a:0:{}');

/*Table structure for table `status` */

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `status` */

insert  into `status`(`status_id`,`status_name`) values 
(1,'Active'),
(2,'Pending'),
(3,'Inactive'),
(4,'Completed'),
(5,'Withdrawn'),
(6,'Canceled'),
(7,'Accept'),
(8,'Decline'),
(9,'Planned'),
(10,'Fully Funded'),
(11,'Partial Funding'),
(12,'No Funding'),
(13,'Partially Approved'),
(14,'Rejected');

/*Table structure for table `student` */

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `rollno` varchar(128) DEFAULT NULL,
  `rumpun` varchar(128) DEFAULT NULL,
  `nationality` varchar(128) DEFAULT NULL,
  `passportno` varchar(128) DEFAULT NULL,
  `race` varchar(128) DEFAULT NULL,
  `religion` varchar(128) DEFAULT NULL,
  `gender` varchar(128) DEFAULT NULL,
  `martial_status` varchar(128) DEFAULT NULL,
  `dob` varchar(128) DEFAULT NULL,
  `place_of_birth` varchar(128) DEFAULT NULL,
  `telephone_mobile` varchar(128) DEFAULT NULL,
  `tele_home` varchar(128) DEFAULT NULL,
  `emailother` varchar(128) DEFAULT NULL,
  `lastschoolname` varchar(255) DEFAULT NULL,
  `type_of_entry` varchar(255) DEFAULT NULL,
  `specialneeds` text,
  `father_name` varchar(255) DEFAULT NULL,
  `fathericno` varchar(255) DEFAULT NULL,
  `father_mobile` varchar(128) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `mothericno` varchar(255) DEFAULT NULL,
  `mother_mobile` varchar(128) DEFAULT NULL,
  `address` text,
  `address2` text,
  `address3` text,
  `postal_code` varchar(128) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `account_no` varchar(128) DEFAULT NULL,
  `programme_name` varchar(255) DEFAULT NULL,
  `intake` text,
  `entry` text,
  `user_image` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_ref_id` int(11) DEFAULT NULL,
  `nationalityother` varchar(255) DEFAULT NULL,
  `raceother` varchar(255) DEFAULT NULL,
  `religionother` varchar(255) DEFAULT NULL,
  `typeofentryother` varchar(255) DEFAULT NULL,
  `sponsor_type` varchar(255) DEFAULT NULL,
  `sponsor_type_other` varchar(255) DEFAULT NULL,
  `ic_no` varchar(255) DEFAULT NULL,
  `ic_color` varchar(255) DEFAULT NULL,
  `gaurdian_relation` varchar(255) DEFAULT NULL,
  `mobile_home` varchar(255) DEFAULT NULL,
  `father_ic_color` varchar(255) DEFAULT NULL,
  `gaurdian_employment` varchar(255) DEFAULT NULL,
  `gaurdian_employer` varchar(255) DEFAULT NULL,
  `remarks` text,
  `telphone_work` varchar(255) DEFAULT NULL,
  `mother_ic_color` varchar(255) DEFAULT NULL,
  `status_of_student` varchar(255) DEFAULT NULL,
  `status_remarks` text,
  `mode` varchar(255) DEFAULT NULL,
  `utb_email_address` varchar(255) DEFAULT NULL,
  `degree_classification` varchar(255) DEFAULT NULL,
  `date_of_registration` varchar(255) DEFAULT NULL,
  `date_of_leaving` varchar(255) DEFAULT NULL,
  `previous_roll_no` varchar(255) DEFAULT NULL,
  `previous_programme_name` varchar(255) DEFAULT NULL,
  `previous_intake_no` varchar(255) DEFAULT NULL,
  `previous_utb_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

/*Data for the table `student` */

insert  into `student`(`id`,`name`,`rollno`,`rumpun`,`nationality`,`passportno`,`race`,`religion`,`gender`,`martial_status`,`dob`,`place_of_birth`,`telephone_mobile`,`tele_home`,`emailother`,`lastschoolname`,`type_of_entry`,`specialneeds`,`father_name`,`fathericno`,`father_mobile`,`mother_name`,`mothericno`,`mother_mobile`,`address`,`address2`,`address3`,`postal_code`,`bank_name`,`account_no`,`programme_name`,`intake`,`entry`,`user_image`,`email`,`user_ref_id`,`nationalityother`,`raceother`,`religionother`,`typeofentryother`,`sponsor_type`,`sponsor_type_other`,`ic_no`,`ic_color`,`gaurdian_relation`,`mobile_home`,`father_ic_color`,`gaurdian_employment`,`gaurdian_employer`,`remarks`,`telphone_work`,`mother_ic_color`,`status_of_student`,`status_remarks`,`mode`,`utb_email_address`,`degree_classification`,`date_of_registration`,`date_of_leaving`,`previous_roll_no`,`previous_programme_name`,`previous_intake_no`,`previous_utb_email`) values 
(1,'student1','9809809','Blue','Other','88888','Other','Other','Female','Married','18-1949-08','kjjkjk','909090',NULL,'ass','sdfsdf','type of entry','specilaneeds','father name','9999','83873777','mother name','889','899998888','postal address1','address 1 2 ','address 1 3','8977','HDFC','893873788','programme name','intake description','entry description\r\n','','student@gmail.com',7,'df','sfdff','3434',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `superadmin` smallint(1) DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `user_role_ref_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`auth_key`,`password_hash`,`confirmation_token`,`status`,`superadmin`,`created_at`,`updated_at`,`email`,`user_role_ref_id`,`created_by`,`modified_by`,`user_image`) values 
(1,'superadmin','7YMx4se_msau87jzbRh3_iiQ2nJiqNHA','$2y$13$ansaxS7vk1U8i5pnStrsW.EztLV6Yo26NZqmX.gkFBxHdocHVsRFm',NULL,1,1,1458643778,1458643778,'jdas12@bodhtree.com',NULL,NULL,NULL,NULL),
(7,'student@gmail.com','7YMx4se_msau87jzbRh3_iiQ2nJiqNHA','$2y$13$ansaxS7vk1U8i5pnStrsW.EztLV6Yo26NZqmX.gkFBxHdocHVsRFm',NULL,1,0,1565517504,1565806868,'student@gmail.com',2,NULL,NULL,'leaves.png');

/*Table structure for table `user_roles` */

DROP TABLE IF EXISTS `user_roles`;

CREATE TABLE `user_roles` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role` varchar(30) NOT NULL,
  PRIMARY KEY (`user_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `user_roles` */

insert  into `user_roles`(`user_role_id`,`user_role`) values 
(1,'Admin'),
(2,'Student');

/*Table structure for table `user_status` */

DROP TABLE IF EXISTS `user_status`;

CREATE TABLE `user_status` (
  `user_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `user_status` */

insert  into `user_status`(`user_status_id`,`status_name`) values 
(1,'Active'),
(2,'Pending'),
(3,'Inactive');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
