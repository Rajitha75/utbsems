-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 28, 2019 at 09:08 AM
-- Server version: 5.7.26
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utbsems`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(128) DEFAULT NULL,
  `mobile` varchar(128) DEFAULT NULL,
  `user_ref_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `gender`, `mobile`, `user_ref_id`) VALUES
(1, 'admin', 'test@123', 'Female', '838843', 1652);

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
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
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`, `group_code`) VALUES
('/*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('//*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('//controller', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('//crud', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('//extension', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('//form', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('//index', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('//model', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('//module', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/asset/*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/asset/compress', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/asset/template', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/cache/*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/cache/flush', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/cache/flush-all', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/cache/flush-schema', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/cache/index', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/fixture/*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/fixture/load', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/fixture/unload', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/gii/*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/gii/default/*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/gii/default/action', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/gii/default/diff', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/gii/default/index', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/gii/default/preview', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/gii/default/view', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/hello/*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/hello/index', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/help/*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/help/index', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/message/*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/message/config', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/message/extract', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/migrate/*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/migrate/create', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/migrate/down', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/migrate/history', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/migrate/mark', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/migrate/new', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/migrate/redo', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/migrate/to', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/migrate/up', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth-item-group/*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth-item-group/bulk-activate', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth-item-group/bulk-deactivate', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth-item-group/bulk-delete', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth-item-group/create', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth-item-group/delete', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth-item-group/grid-page-size', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth-item-group/grid-sort', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth-item-group/index', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth-item-group/toggle-attribute', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth-item-group/update', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth-item-group/view', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth/*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth/captcha', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth/change-own-password', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth/confirm-email', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth/confirm-email-receive', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth/confirm-registration-email', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth/login', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth/logout', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth/password-recovery', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth/password-recovery-receive', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/auth/registration', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/permission/*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/permission/bulk-activate', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/permission/bulk-deactivate', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/permission/bulk-delete', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/permission/create', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/permission/delete', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/permission/grid-page-size', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/permission/grid-sort', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/permission/index', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/permission/refresh-routes', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/permission/set-child-permissions', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/permission/set-child-routes', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/permission/toggle-attribute', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/permission/update', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/permission/view', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/role/*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/role/bulk-activate', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/role/bulk-deactivate', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/role/bulk-delete', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/role/create', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/role/delete', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/role/grid-page-size', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/role/grid-sort', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/role/index', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/role/set-child-permissions', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/role/set-child-roles', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/role/toggle-attribute', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/role/update', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/role/view', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user-permission/*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user-permission/set', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user-permission/set-roles', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user-visit-log/*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user-visit-log/bulk-activate', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user-visit-log/bulk-deactivate', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user-visit-log/bulk-delete', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user-visit-log/create', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user-visit-log/delete', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user-visit-log/grid-page-size', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user-visit-log/grid-sort', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user-visit-log/index', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user-visit-log/toggle-attribute', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user-visit-log/update', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user-visit-log/view', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user/*', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user/bulk-activate', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user/bulk-deactivate', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user/bulk-delete', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user/change-password', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user/create', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user/delete', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user/grid-page-size', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user/grid-sort', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user/index', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user/toggle-attribute', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user/update', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('/user-management/user/view', 3, NULL, NULL, NULL, 1426062189, 1426062189, NULL),
('Admin', 1, 'Admin', NULL, NULL, 1426062189, 1426062189, NULL),
('assignRolesToUsers', 2, 'Assign roles to users', NULL, NULL, 1426062189, 1426062189, 'userManagement'),
('bindUserToIp', 2, 'Bind user to IP', NULL, NULL, 1426062189, 1426062189, 'userManagement'),
('changeOwnPassword', 2, 'Change own password', NULL, NULL, 1426062189, 1426062189, 'userCommonPermissions'),
('changeUserPassword', 2, 'Change user password', NULL, NULL, 1426062189, 1426062189, 'userManagement'),
('commonPermission', 2, 'Common permission', NULL, NULL, 1426062188, 1426062188, NULL),
('createUsers', 2, 'Create users', NULL, NULL, 1426062189, 1426062189, 'userManagement'),
('deleteUsers', 2, 'Delete users', NULL, NULL, 1426062189, 1426062189, 'userManagement'),
('editUserEmail', 2, 'Edit user email', NULL, NULL, 1426062189, 1426062189, 'userManagement'),
('editUsers', 2, 'Edit users', NULL, NULL, 1426062189, 1426062189, 'userManagement'),
('viewRegistrationIp', 2, 'View registration IP', NULL, NULL, 1426062189, 1426062189, 'userManagement'),
('viewUserEmail', 2, 'View user email', NULL, NULL, 1426062189, 1426062189, 'userManagement'),
('viewUserRoles', 2, 'View user roles', NULL, NULL, 1426062189, 1426062189, 'userManagement'),
('viewUsers', 2, 'View users', NULL, NULL, 1426062189, 1426062189, 'userManagement'),
('viewVisitLog', 2, 'View visit log', NULL, NULL, 1426062189, 1426062189, 'userManagement');

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('changeOwnPassword', '/user-management/auth/change-own-password'),
('assignRolesToUsers', '/user-management/user-permission/set'),
('assignRolesToUsers', '/user-management/user-permission/set-roles'),
('viewVisitLog', '/user-management/user-visit-log/grid-page-size'),
('viewVisitLog', '/user-management/user-visit-log/index'),
('viewVisitLog', '/user-management/user-visit-log/view'),
('editUsers', '/user-management/user/bulk-activate'),
('editUsers', '/user-management/user/bulk-deactivate'),
('deleteUsers', '/user-management/user/bulk-delete'),
('changeUserPassword', '/user-management/user/change-password'),
('createUsers', '/user-management/user/create'),
('deleteUsers', '/user-management/user/delete'),
('viewUsers', '/user-management/user/grid-page-size'),
('viewUsers', '/user-management/user/index'),
('editUsers', '/user-management/user/update'),
('viewUsers', '/user-management/user/view'),
('Admin', 'assignRolesToUsers'),
('Admin', 'changeOwnPassword'),
('Admin', 'changeUserPassword'),
('Admin', 'createUsers'),
('Admin', 'deleteUsers'),
('Admin', 'editUsers'),
('editUserEmail', 'viewUserEmail'),
('assignRolesToUsers', 'viewUserRoles'),
('Admin', 'viewUsers'),
('assignRolesToUsers', 'viewUsers'),
('changeUserPassword', 'viewUsers'),
('createUsers', 'viewUsers'),
('deleteUsers', 'viewUsers'),
('editUsers', 'viewUsers');

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_group`
--

DROP TABLE IF EXISTS `auth_item_group`;
CREATE TABLE IF NOT EXISTS `auth_item_group` (
  `code` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_item_group`
--

INSERT INTO `auth_item_group` (`code`, `name`, `created_at`, `updated_at`) VALUES
('userCommonPermissions', 'User common permission', 1426062189, 1426062189),
('userManagement', 'User management', 1426062189, 1426062189);

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE IF NOT EXISTS `email_templates` (
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

-- --------------------------------------------------------

--
-- Table structure for table `error_log`
--

DROP TABLE IF EXISTS `error_log`;
CREATE TABLE IF NOT EXISTS `error_log` (
  `error_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `error_text` varchar(150) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`error_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `projectname` varchar(255) DEFAULT NULL,
  `message` text,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_ref_id` int(11) NOT NULL,
  `attempts` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `reset_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `user_ref_id`, `attempts`, `ip`, `reset_at`, `created_at`) VALUES
(4, 40, 1, NULL, NULL, '2019-10-16 22:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `id` char(40) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `expire`, `data`) VALUES
('60u6vtl8smsr12qk34onb9hdm6', 1568227129, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a373b5f5f6578706972657c693a313536383232363838393b5f5f617574685f6c6173745f7570646174657c693a313535333137323634383b5f5f75736572526f6c65737c613a303a7b7d5f5f757365725065726d697373696f6e737c613a303a7b7d5f5f75736572526f757465737c613a303a7b7d656d61696c7c733a31373a2273747564656e7440676d61696c2e636f6d223b75736572526f6c657c693a323b),
('69lco6dk0k6kdrkk8382rst3o6', 1571650768, 0x5f5f666c6173687c613a303a7b7d7365637265746b65797c733a31383a22242525457175695050504032303138252524223b5f5f69647c693a313b5f5f6578706972657c693a313537313635303532343b5f5f617574685f6c6173745f7570646174657c693a313535363237383031393b5f5f75736572526f6c65737c613a303a7b7d5f5f757365725065726d697373696f6e737c613a303a7b7d5f5f75736572526f757465737c613a303a7b7d),
('7cs76sa9su927u8u9r5tbodo37', 1571251201, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a34343b5f5f6578706972657c693a313537313235303936313b5f5f617574685f6c6173745f7570646174657c693a313535333137323634383b5f5f75736572526f6c65737c613a303a7b7d5f5f757365725065726d697373696f6e737c613a303a7b7d5f5f75736572526f757465737c613a303a7b7d656d61696c7c733a31383a226e6577757365723940676d61696c2e636f6d223b75736572526f6c657c693a323b),
('bpu6pb0vlrdlbuvp35tcikfki1', 1572181590, 0x5f5f666c6173687c613a303a7b7d),
('cpdn5287e9rbfn5evfma7mi974', 1572251764, 0x5f5f666c6173687c613a303a7b7d),
('dllqshnnuk5fg13akpcndfigm0', 1571656254, 0x5f5f666c6173687c613a303a7b7d7365637265746b65797c733a31383a22242525457175695050504032303138252524223b),
('gpjvmqvs3hh1ushrn9qv1jqv17', 1571147047, 0x5f5f666c6173687c613a303a7b7d),
('j0joq7td8i97hp91neno5bak43', 1571421317, 0x5f5f666c6173687c613a303a7b7d),
('j2hre5641vppkhqbau7m1e9991', 1568231129, 0x5f5f666c6173687c613a303a7b7d7365637265746b65797c733a31383a22242525457175695050504032303138252524223b5f5f69647c693a313b5f5f6578706972657c693a313536383233303838393b5f5f617574685f6c6173745f7570646174657c693a313535363237383031393b5f5f75736572526f6c65737c613a303a7b7d5f5f757365725065726d697373696f6e737c613a303a7b7d5f5f75736572526f757465737c613a303a7b7d),
('j9i3e99knj42rdteanmcv9ik33', 1568235093, 0x5f5f666c6173687c613a303a7b7d7365637265746b65797c733a31383a22242525457175695050504032303138252524223b5f5f617574685f6c6173745f7570646174657c693a313535363237383031393b5f5f69647c693a313b5f5f6578706972657c693a313536383233343835313b5f5f75736572526f6c65737c613a303a7b7d5f5f757365725065726d697373696f6e737c613a303a7b7d5f5f75736572526f757465737c613a303a7b7d),
('l45h5tc9i0or22obdofig9lnr0', 1571680130, 0x5f5f666c6173687c613a303a7b7d),
('m6jb5387goh2ojbdo2tstvhl55', 1571464299, 0x5f5f666c6173687c613a303a7b7d7365637265746b65797c733a31383a22242525457175695050504032303138252524223b5f5f69647c693a313b5f5f6578706972657c693a313537313436343035323b5f5f617574685f6c6173745f7570646174657c693a313535363237383031393b5f5f75736572526f6c65737c613a303a7b7d5f5f757365725065726d697373696f6e737c613a303a7b7d5f5f75736572526f757465737c613a303a7b7d),
('ml4qs75e5jb1uv7eqc1pa82j67', 1571827228, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a373b5f5f6578706972657c693a313537313832363938383b5f5f617574685f6c6173745f7570646174657c693a313535333137323634383b5f5f75736572526f6c65737c613a303a7b7d5f5f757365725065726d697373696f6e737c613a303a7b7d5f5f75736572526f757465737c613a303a7b7d656d61696c7c733a31373a2273747564656e7440676d61696c2e636f6d223b75736572526f6c657c693a323b),
('vbdd2lcdnbcsfl3kdq05o9p4j2', 1571950893, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a373b5f5f6578706972657c693a313537313935303635333b5f5f617574685f6c6173745f7570646174657c693a313535333137323634383b5f5f75736572526f6c65737c613a303a7b7d5f5f757365725065726d697373696f6e737c613a303a7b7d5f5f75736572526f757465737c613a303a7b7d656d61696c7c733a31373a2273747564656e7440676d61696c2e636f6d223b75736572526f6c657c693a323b);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(1, 'Active'),
(2, 'Pending'),
(3, 'Inactive'),
(4, 'Completed'),
(5, 'Withdrawn'),
(6, 'Canceled'),
(7, 'Accept'),
(8, 'Decline'),
(9, 'Planned'),
(10, 'Fully Funded'),
(11, 'Partial Funding'),
(12, 'No Funding'),
(13, 'Partially Approved'),
(14, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
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
  `type_of_programme` varchar(255) DEFAULT NULL,
  `scholl` varchar(255) DEFAULT NULL,
  `employer_name` varchar(255) DEFAULT NULL,
  `employer_address` text,
  `employer_address2` text,
  `employer_address3` text,
  `employer_postal_code` varchar(255) DEFAULT NULL,
  `position_held` varchar(255) DEFAULT NULL,
  `employment_mode` varchar(255) DEFAULT NULL,
  `emp_from_month` varchar(255) DEFAULT NULL,
  `emp_from_year` varchar(255) DEFAULT NULL,
  `emp_to_month` varchar(255) DEFAULT NULL,
  `emp_to_year` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `rollno`, `rumpun`, `nationality`, `passportno`, `race`, `religion`, `gender`, `martial_status`, `dob`, `place_of_birth`, `telephone_mobile`, `tele_home`, `emailother`, `lastschoolname`, `type_of_entry`, `specialneeds`, `father_name`, `fathericno`, `father_mobile`, `mother_name`, `mothericno`, `mother_mobile`, `address`, `address2`, `address3`, `postal_code`, `bank_name`, `account_no`, `programme_name`, `intake`, `entry`, `user_image`, `email`, `user_ref_id`, `nationalityother`, `raceother`, `religionother`, `typeofentryother`, `sponsor_type`, `sponsor_type_other`, `ic_no`, `ic_color`, `gaurdian_relation`, `mobile_home`, `father_ic_color`, `gaurdian_employment`, `gaurdian_employer`, `remarks`, `telphone_work`, `mother_ic_color`, `status_of_student`, `status_remarks`, `mode`, `utb_email_address`, `degree_classification`, `date_of_registration`, `date_of_leaving`, `previous_roll_no`, `previous_programme_name`, `previous_intake_no`, `previous_utb_email`, `type_of_programme`, `scholl`, `employer_name`, `employer_address`, `employer_address2`, `employer_address3`, `employer_postal_code`, `position_held`, `employment_mode`, `emp_from_month`, `emp_from_year`, `emp_to_month`, `emp_to_year`) VALUES
(1, 'student1', '9809809', 'Blue', 'Other', '88888', 'Other', 'Other', 'Female', 'Married', '18-1949-08', 'kjjkjk', '909090', NULL, 'ass', 'sdfsdf', 'type of entry', 'specilaneeds', 'father name', '9999', '83873777', 'mother name', '889', '899998888', 'postal address1', 'address 1 2 ', 'address 1 3', '8977', 'HDFC', '893873788', 'programme name', 'intake description', 'entry description\r\n', '', 'student@gmail.com', 7, 'df', 'sfdff', '3434', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 'testnew', '8', '', 'Chinese', '32323', 'Chinese', 'Hinduism', 'Female', 'Single', '26-10-1949', '322323', '32323', '', '', 'sdsds', 'In-service', '', '2323', '2323', '934343443', 'kjjj', '999', '993939983893', 'ssd', 'jjjj2', 'jjjkj3', '232323', 'BAIDURI', '2454545', 'Bachelor of Science in Internet Computing', '1999', 'First Year', 'leaves.png', 'testnewstudent@gmail.com', 36, '', '', '', '', 'Fee Paying', '', '2323', 'Yellow', '', '', 'Green', '', '', '', '', 'Yellow', 'Withdrawn', '', 'Full Time', 'ewe@sdsd.cco,', '', '13-10-1949', '19-10-1949', '', '', '', '', NULL, NULL, 'emp name', 'emp add 1', 'emp add 2', 'emp add 3', 'emp pos', 'post held', '', 'February', '2000', 'April', '2002'),
(53, 'newuser2', '2', NULL, NULL, NULL, 'Other', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'newuser2@gmail.com', 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'newstudent3', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'newstudent3@gmail.com', 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'newstudent4', '4', NULL, NULL, NULL, 'Chinese', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'newstudent4@mail.com', 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 'newuser5', '5', NULL, NULL, NULL, 'Chinese', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'newuser5@gmail.com', 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 'newuser6', '6', NULL, NULL, NULL, 'Chinese', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'newuser6@gmail.com', 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, NULL, NULL, NULL, NULL, NULL, 'Chinese', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Under Graduate', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 'newuser7', '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'newuser7@gmailc.om', 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 'newuser8', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'newuser8@gmail.com', 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Under Graduate', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'newuser9', '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'newuser9@gmail.com', 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Under Graduate', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 'test100', '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test100@gmail.com', 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 'test100', '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test100@gmail.com', 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 'test100', '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test100@gmail.com', 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 'test100', '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test100@gmail.com', 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 'test100', '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test100@gmail.com', 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 'test100', '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test100@gmail.com', 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 'test100', '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test100@gmail.com', 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 'test100', '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test100@gmail.com', 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 'test100', '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test100@gmail.com', 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 'test100', '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test100@gmail.com', 54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 'test100', '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test100@gmail.com', 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 'test100', '100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test100@gmail.com', 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 'test101', '101', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test101@gmail.com', 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 'test101', '101', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test101@gmail.com', 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 'test101', '101', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test101@gmail.com', 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 'test101', '101', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test101@gmail.com', 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 'test101', '101', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test101@gmail.com', 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 'test101', '101', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test101@gmail.com', 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 'test101', '101', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test101@gmail.com', 63, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 'test101', '101', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test101@gmail.com', 64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Under Graduate', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 'test102', '102', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test102@gmail.com', 65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Under Graduate', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 'student1000', '1000', 'XCEL', 'Malay', '111pno', 'Malay', 'Muslim', 'Male', 'Married', '07-10-1949', 'hyd', '9999999999', '8888888888', NULL, 'last school', 'HECAS', 'spec needs', 'father name', 'f93939', '8888888888', 'mother name', '83737888m', '3333333333', 'postal address', 'address line 2', 'address line 3', '500003', 'BAIDURI', '636363636363', 'Bachelor of Business in Applied Economics and Finance', '2000', 'First Year', '', 'student1000@gmail.com', 66, '', '', '', NULL, 'Government Scholarship', NULL, '111', 'Yellow', 'father', '666666666', 'Yellow', 'father emp', 'father employer', 'remarks', '444444444', 'Yellow', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', ''),
(88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Under Graduate', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 'sandeep', '1010', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'akulasandeepit@gmail.com', 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
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
  `is_verified` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `confirmation_token`, `status`, `superadmin`, `created_at`, `updated_at`, `email`, `user_role_ref_id`, `created_by`, `modified_by`, `user_image`, `is_verified`) VALUES
(1, 'superadmin', '7YMx4se_msau87jzbRh3_iiQ2nJiqNHA', '$2y$13$ansaxS7vk1U8i5pnStrsW.EztLV6Yo26NZqmX.gkFBxHdocHVsRFm', NULL, 1, 1, 1458643778, 1458643778, 'jdas12@bodhtree.com', NULL, NULL, NULL, NULL, NULL),
(7, 'student@gmail.com', '7YMx4se_msau87jzbRh3_iiQ2nJiqNHA', '$2y$13$ansaxS7vk1U8i5pnStrsW.EztLV6Yo26NZqmX.gkFBxHdocHVsRFm', NULL, 1, 0, 1565517504, 1565806868, 'student@gmail.com', 2, NULL, NULL, 'leaves.png', 1),
(36, 'testnewstudent@gmail.com', 'Gsy5jc0M_qsQFHNe6vIw673zyoYgrpPo', '$2y$13$aqtKUTwP1Xyf1Y76nLEcP.dcLAVwVV/UXEldIcnh2DtXrVqHCFfDe', NULL, 1, 0, 1571241736, 1571241736, 'testnewstudent@gmail.com', 2, NULL, NULL, 'leaves.png', NULL),
(37, 'newuser2@gmail.com', 'mY9HPKr5_pUootAXZj1lgAq6zCfHdZkP', '$2y$13$/W41LA4kpku67/W4jE5mjOVT7Yctq6dXUhBEYFYgF7KncjDnOnQWa', NULL, 1, 0, 1571244992, 1571244992, 'newuser2@gmail.com', 2, NULL, NULL, NULL, NULL),
(38, 'newstudent3@gmail.com', 'pWYi62ufNj4hml0aRKKGZuYqmZfvhF4L', '$2y$13$zSOgSxj41KRSMsJacSATtOc2sMRQmCNZEI7llddDr04tAfhAZOdbu', NULL, 1, 0, 1571245112, 1571245112, 'newstudent3@gmail.com', 2, NULL, NULL, NULL, NULL),
(39, 'newstudent4@mail.com', 'xDN3t3gToSXc9eS_wmIFOr_HDCy2B-9I', '$2y$13$I4IOvVH5j6hXGZQtkrB2Ye.urpG3G/qIaxH.ccjTnzqTBcPhNBXXe', NULL, 1, 0, 1571245193, 1571245193, 'newstudent4@mail.com', 2, NULL, NULL, NULL, NULL),
(40, 'newuser5@gmail.com', 'CYNaXJyWfEqKhGOB7GRrwfulwh2MXFD5', '$2y$13$oJPBlUEVmV3qUb0d9PRW8OL4X9eQYnf1rz8sLKb2FOw320CiV/ewe', NULL, 1, 0, 1571245896, 1571245896, 'newuser5@gmail.com', 2, NULL, NULL, NULL, 0),
(41, 'newuser6@gmail.com', 'ceLIxFyrDMjF_GQSswSvbvqDRTLXy-Qa', '$2y$13$Fu92mBoq5YoHi0pTDJSQ.uRok.LqQ0PvEWFR9hmxSwIC7FpJiEi66', NULL, 1, 0, 1571246216, 1571249366, 'newuser6@gmail.com', 2, NULL, NULL, NULL, 1),
(42, 'newuser7@gmailc.om', 'GB8hIE3-D9oJlfJHCI_4ZDSNhnyXyT3i', '$2y$13$4/NQ03uZOb8he5SWHxBtPOUWNkgtpOfIdufvp49nDXNCvBdLQ6LBK', NULL, 1, 0, 1571249523, 1571249523, 'newuser7@gmailc.om', 2, NULL, NULL, NULL, 0),
(43, 'newuser8@gmail.com', 'AlpMMuwI24Fc36LYhIAFGLKfXvCrxkcm', '$2y$13$qa.zO.Qb.jgxISsz3Cl.2OMUjUTE1JQ8GtC7ywZcq50BWeyRc.yBi', NULL, 1, 0, 1571249575, 1571249621, 'newuser8@gmail.com', 2, NULL, NULL, NULL, 1),
(44, 'newuser9@gmail.com', 'bZsKwKds7S8t45NfHGnn_4f0C1YqkMc5', '$2y$13$C1pjyx1sdQLIX0TjX1obpuJPgCz.cM57WFcsvPujkbj7SHSYR10TO', NULL, 1, 0, 1571249690, 1571249736, 'newuser9@gmail.com', 2, NULL, NULL, NULL, 1),
(45, 'test100@gmail.com', 'yQb9ndQ4NRz4yaaskIQCmyTw7b5UWBzU', '$2y$13$PQtZxImNZtuGP5a3vnIVPuIEqVRRnj62gu7e/w8kTBoWsHC0YSzO2', NULL, 1, 0, 1572182296, 1572182296, 'test100@gmail.com', 2, NULL, NULL, NULL, 0),
(46, 'test100@gmail.com', 'mZMObnCtewvD10yoresih96B-XP8Y-Ur', '$2y$13$fS2V1a7RoVK5lU5bEuBOMukVn.nTDtObiEbO9zLjtJpeIFIoL8RUy', NULL, 1, 0, 1572182706, 1572182706, 'test100@gmail.com', 2, NULL, NULL, NULL, 0),
(47, 'test100@gmail.com', 'oe30uZBDzzYT8AwUmdUsrwJCu9mgHn-Z', '$2y$13$NVLszBPwPwvGwCJAl8sB1eLYTDx6RCULBbq2l0DFyGiYvq0rPHJF6', NULL, 1, 0, 1572182737, 1572182737, 'test100@gmail.com', 2, NULL, NULL, NULL, 0),
(48, 'test100@gmail.com', 'dB3BvsaImXjJbZNzwJThwk6j4mI6QNqX', '$2y$13$k8mTcxnkjNOjmyAxNfu8FufatGeKAsP/nGpaKOgESD5/XPuy.L.bK', NULL, 1, 0, 1572182920, 1572182920, 'test100@gmail.com', 2, NULL, NULL, NULL, 0),
(49, 'test100@gmail.com', 'ri6w2QxDR-z4cAV94HNoLg5RetDtvFkS', '$2y$13$DUs5AKQHg5HiQMPfAB.au.M9cYr23PvgdPVNZxbyGmHlWppP36feG', NULL, 1, 0, 1572183095, 1572183095, 'test100@gmail.com', 2, NULL, NULL, NULL, 0),
(50, 'test100@gmail.com', 'YgBXALpWc5ELNHFOEZ6uGJlHrSagdEUk', '$2y$13$zcNOP6suk9HYRfSneaCn0.QLWZq2A2u6PM5zrs5oqARXDk0QAzEXG', NULL, 1, 0, 1572183114, 1572183114, 'test100@gmail.com', 2, NULL, NULL, NULL, 0),
(51, 'test100@gmail.com', 'zqmKgVkFeVgt7YDov6qZxkxS0PrXz4DK', '$2y$13$bCceLhl9N8gqNJwZpxeoWu4aNMP4vx.0rWltw2.Xv6pWG1QRhLbT6', NULL, 1, 0, 1572183128, 1572183128, 'test100@gmail.com', 2, NULL, NULL, NULL, 0),
(52, 'test100@gmail.com', '0rmLxeYFzowfy0tmtDM38s30prLjJqjz', '$2y$13$tiPBrFPbSCMxtodyy8906O.cmnfP4MMhFhZ5Jny9WPQCyZDR300MO', NULL, 1, 0, 1572183370, 1572183370, 'test100@gmail.com', 2, NULL, NULL, NULL, 0),
(53, 'test100@gmail.com', 'GAoJZb-WGuSp78BOxld4ldb_KVrC60lc', '$2y$13$ztvM3Vcwd1ox7/.CO9AwpeQqTIhSxMkxhaXEgN0gjzxdyP0HSRGZK', NULL, 1, 0, 1572245792, 1572245792, 'test100@gmail.com', 2, NULL, NULL, NULL, 0),
(54, 'test100@gmail.com', 'iQzc6GLtaFX-N7izxb6zUlgNRdhcKhOR', '$2y$13$OSS4bIor0ufu0.7HpRCLl.63g.MdZKEMNPDNfgG8afCJIqzsC.PCi', NULL, 1, 0, 1572245972, 1572245972, 'test100@gmail.com', 2, NULL, NULL, NULL, 0),
(55, 'test100@gmail.com', 'iYpkISNNRDuWSKftDYILz6WUi7GzwBnV', '$2y$13$Pr8Oxtbz5mbcGTh/kbOVluKwjKNCfnLyDBHnx6wNmiR/g3ZFE5/PS', NULL, 1, 0, 1572246166, 1572246166, 'test100@gmail.com', 2, NULL, NULL, NULL, 0),
(56, 'test100@gmail.com', '9vv-SYWF_R34UKbQSey8SSmpFPz70OnW', '$2y$13$SZz7LFtxJgYslRiXBRZXkeT2vW9TZ.0/JZj5Zx/RnShjk3kdnBtAq', NULL, 1, 0, 1572246472, 1572246472, 'test100@gmail.com', 2, NULL, NULL, NULL, 0),
(57, 'test101@gmail.com', 'cDGFk9jJiDdWPbSUjqMAX0gXemHw6_1m', '$2y$13$absH6Lz8rGjdiupHe1kTaeNkBlx79vLIskYYxOa.zlzDt.UgBKhrO', NULL, 1, 0, 1572246925, 1572246925, 'test101@gmail.com', 2, NULL, NULL, NULL, 0),
(58, 'test101@gmail.com', 'blyGOpYlr-yeJPA1prpMvbuHnoAzbA0-', '$2y$13$CMIYmSZU1sCNphoq8OBDW.Q/xtjSzjM7Oi4rCuXM9YnGmY2qd1uAi', NULL, 1, 0, 1572247263, 1572247263, 'test101@gmail.com', 2, NULL, NULL, NULL, 0),
(59, 'test101@gmail.com', '7MGdTcxf_d_FgVAiGmcvgPxlIdR3Mzqt', '$2y$13$rQYJ5nO16eToEV.NDCSMyeccRnCOysUwnrSU0Ylkrvba4OTcCzsXq', NULL, 1, 0, 1572247283, 1572247283, 'test101@gmail.com', 2, NULL, NULL, NULL, 0),
(60, 'test101@gmail.com', 'ZjMVtKogd6oMkcvbiEz2hpR8cLrJK3ux', '$2y$13$MLtNrynhf23binIDrXBu7ervMmYp9f0GdJv2wvl0pDoIdlD5R176C', NULL, 1, 0, 1572247738, 1572247738, 'test101@gmail.com', 2, NULL, NULL, NULL, 0),
(61, 'test101@gmail.com', 'QmhMNZtLC4xIhCHWX3LRBPiODEhHkiWF', '$2y$13$pZT2lcxcHSt6WNn/DSvXp.6Ko6pfbQX3Cn0H2WK4wmCiFV8SzNhVi', NULL, 1, 0, 1572247811, 1572247811, 'test101@gmail.com', 2, NULL, NULL, NULL, 0),
(62, 'test101@gmail.com', 'RGutGMVQOyLOS1KD4aU5cs6UObSi8drZ', '$2y$13$xGYopqcBQj1yuEphN3luxeMZrA45VBH65jJFXCqN2f9tTcOWNCvDe', NULL, 1, 0, 1572247892, 1572247892, 'test101@gmail.com', 2, NULL, NULL, NULL, 0),
(63, 'test101@gmail.com', 'YES6gBDRJMUnSMMBHgoBbrc3PZAbZr-T', '$2y$13$6pNxnKLsEWL1C3N8eeSZ6uFJOTDnh1nSmA1yoy16N/vQqg/kNskT6', NULL, 1, 0, 1572247970, 1572247970, 'test101@gmail.com', 2, NULL, NULL, NULL, 0),
(64, 'test101@gmail.com', 'ngB-nYggX5p5FaRfaSLdP-X5jnpcMTp-', '$2y$13$hIbL7hQiHFYMRd6R35voO.Yr6WcQq8O/F7ELez/tEfaHmm9EYbLLu', NULL, 1, 0, 1572248067, 1572248678, 'test101@gmail.com', 2, NULL, NULL, NULL, 1),
(65, 'test102@gmail.com', 'x1l2i48GAFpb6FJb-IZurfbccDfI6bsw', '$2y$13$JlgG5Oj2NINWLEa3iPMhEORhj9yRd3Um0njR3dTXgkKtW7/iXOKFO', NULL, 1, 0, 1572248567, 1572248567, 'test102@gmail.com', 2, NULL, NULL, NULL, 0),
(66, 'student1000@gmail.com', 'kCUh8oNF3zCd2sxBcdXMN4vAy1ERnwrX', '$2y$13$QqX.A8kR80e8u4jHa6AElOVh1T2hRyXLdyXPQomqLMvU.9.6DeX0i', NULL, 1, 0, 1572248780, 1572248838, 'student1000@gmail.com', 2, NULL, NULL, NULL, 1),
(67, 'akulasandeepit@gmail.com', '7TbPCiUsNfa4yKd_GYNpXI9aJ584mZJi', '$2y$13$mCnENilyOGhuXUKQQqWLBeAkBMoqdZxtw5iQXMVM72eFtwn/ZIpYm', NULL, 1, 0, 1572249813, 1572249813, 'akulasandeepit@gmail.com', 2, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role` varchar(30) NOT NULL,
  PRIMARY KEY (`user_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_role_id`, `user_role`) VALUES
(1, 'Admin'),
(2, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

DROP TABLE IF EXISTS `user_status`;
CREATE TABLE IF NOT EXISTS `user_status` (
  `user_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`user_status_id`, `status_name`) VALUES
(1, 'Active'),
(2, 'Pending'),
(3, 'Inactive');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
