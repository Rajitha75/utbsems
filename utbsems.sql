DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(128) DEFAULT NULL,
  `mobile` varchar(128) DEFAULT NULL,
  `user_ref_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `gender`, `mobile`, `user_ref_id`) VALUES
(1, 'admin', 'test@123', 'Female', '838843', 1652),
(4, 'Admin1', 'admin1@gmail.com', 'Female', '9393939393', 36);

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
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `group_code` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`name`)
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
('Admin', 'assignRolesToUsers'),
('Admin', 'changeOwnPassword'),
('Admin', 'changeUserPassword'),
('Admin', 'createUsers'),
('Admin', 'deleteUsers'),
('Admin', 'editUsers'),
('Admin', 'viewUsers'),
('assignRolesToUsers', '/user-management/user-permission/set'),
('assignRolesToUsers', '/user-management/user-permission/set-roles'),
('assignRolesToUsers', 'viewUserRoles'),
('assignRolesToUsers', 'viewUsers'),
('changeOwnPassword', '/user-management/auth/change-own-password'),
('changeUserPassword', '/user-management/user/change-password'),
('changeUserPassword', 'viewUsers'),
('createUsers', '/user-management/user/create'),
('createUsers', 'viewUsers'),
('deleteUsers', '/user-management/user/bulk-delete'),
('deleteUsers', '/user-management/user/delete'),
('deleteUsers', 'viewUsers'),
('editUserEmail', 'viewUserEmail'),
('editUsers', '/user-management/user/bulk-activate'),
('editUsers', '/user-management/user/bulk-deactivate'),
('editUsers', '/user-management/user/update'),
('editUsers', 'viewUsers'),
('viewUsers', '/user-management/user/grid-page-size'),
('viewUsers', '/user-management/user/index'),
('viewUsers', '/user-management/user/view'),
('viewVisitLog', '/user-management/user-visit-log/grid-page-size'),
('viewVisitLog', '/user-management/user-visit-log/index'),
('viewVisitLog', '/user-management/user-visit-log/view');

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
  `data` text DEFAULT NULL,
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
-- Table structure for table `exam_officer`
--

DROP TABLE IF EXISTS `exam_officer`;
CREATE TABLE IF NOT EXISTS `exam_officer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(225) NOT NULL,
  `user_ref_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_officer`
--

INSERT INTO `exam_officer` (`id`, `email`, `user_ref_id`, `name`) VALUES
(1, 'examofficer1@gmail.com', 42, ''),
(2, 'examofficer1@gmail.com', 43, 'sdf'),
(4, 'eo1@gmail.com', 48, 'exam officer'),
(5, 'examofficer2@gmail.com', 50, 'exam officer 2'),
(6, 'examofficer2@gmail.com', 51, 'exam officer 2'),
(7, 'examofficer3@gmail.com', 52, 'exam officer 3'),
(8, 'examofficer4@gmail.com', 57, 'exam officer 4');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_name` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `faculty_name`, `status`) VALUES
(1, 'School of Business ', 1),
(2, 'School of Computing and Informatics', 1),
(3, 'Faculty of Engineering', 1),
(4, 'School of Applied Sciences and Mathematics', 1),
(5, 'School of Design', 1);

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
  `message` text DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

DROP TABLE IF EXISTS `lecturers`;
CREATE TABLE IF NOT EXISTS `lecturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ic_no` varchar(255) DEFAULT NULL,
  `passportno` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `user_ref_id` int(11) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `martial_status` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `telephone_mobile` varchar(255) DEFAULT NULL,
  `tele_home` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `emailother` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `ic_no`, `passportno`, `email`, `user_ref_id`, `gender`, `martial_status`, `dob`, `age`, `place_of_birth`, `telephone_mobile`, `tele_home`, `name`, `emailother`) VALUES
(9, NULL, NULL, 'hjhfarahiyahbintihjkawi@gmail.com', 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Hjh Farahiyah binti Hj Kawi', NULL),
(8, NULL, NULL, 'ibrahimaramidesalihu@gmail.com', 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dr Ibrahim Aramide Salihu', NULL),
(7, NULL, NULL, 'shaistawasiuzzaman@gmail.com', 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dr Shaista Wasiuzzaman', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_to_module`
--

DROP TABLE IF EXISTS `lecturer_to_module`;
CREATE TABLE IF NOT EXISTS `lecturer_to_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lecturer_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer_to_module`
--

INSERT INTO `lecturer_to_module` (`id`, `lecturer_id`, `module_id`) VALUES
(1, 59, 1),
(2, 59, 225),
(3, 59, 226),
(4, 59, 26);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `user_ref_id`, `attempts`, `ip`, `reset_at`, `created_at`) VALUES
(7, 38, 2, NULL, NULL, '2020-02-13 23:09:29'),
(8, 37, 1, NULL, NULL, '2020-02-13 23:09:38'),
(9, 42, 2, NULL, NULL, '2020-04-06 13:32:41'),
(10, 50, 2, NULL, NULL, '2020-04-06 13:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `marks_percentage`
--

DROP TABLE IF EXISTS `marks_percentage`;
CREATE TABLE IF NOT EXISTS `marks_percentage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `semister` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `ew_percentage` int(11) NOT NULL,
  `cw_percentage` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks_percentage`
--

INSERT INTO `marks_percentage` (`id`, `semister`, `module_id`, `ew_percentage`, `cw_percentage`, `created_by`) VALUES
(2, 5, 1, 40, 40, 59);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` varchar(255) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `programme_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=227 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_id`, `module_name`, `programme_id`, `status`) VALUES
(1, 'BA1101', 'Business Statistics', NULL, 1),
(2, 'BA4231', 'International Taxation', NULL, 1),
(3, 'BA4232', 'Financial Reporting', NULL, 1),
(4, 'BA4233', 'Advanced Performance Management', NULL, 1),
(5, 'BA4234', 'Strategic Financial Management', NULL, 1),
(6, 'BA4241', 'Credit Analysis and Lending Management', NULL, 1),
(7, 'BA4242', 'Portfolio Analysis and Wealth Management', NULL, 1),
(8, 'BA4244', 'Valuation of Derivatives and Hedging Strategies', NULL, 1),
(9, 'BE1101', 'Principles of Microeconomics', NULL, 1),
(10, 'BE2101', 'Business and ICT Law', NULL, 1),
(11, 'BE2102', 'Business Strategy', NULL, 1),
(12, 'BE3102', 'Group Project', NULL, 1),
(13, 'BE3151', 'Technopreneurship', NULL, 1),
(14, 'BE4251', 'Natural Resource and Environmental Economics', NULL, 1),
(15, 'BE4252', 'Islamic Finance and Investment', NULL, 1),
(16, 'BE4253', 'Financial Risk Management', NULL, 1),
(17, 'BE4254', 'Econometrics', NULL, 1),
(18, 'BE4261', 'Consumer Behaviour', NULL, 1),
(19, 'BE4262', 'New Product Development and Commercialization', NULL, 1),
(20, 'BE4263', 'Interactive Service Marketing', NULL, 1),
(21, 'BE4551', 'Risk Management of E-Business', NULL, 1),
(22, 'BM1101', 'Business Information Systems', NULL, 1),
(23, 'BM2101', 'Principles of Management', NULL, 1),
(24, 'BM2102', 'Human Resource Management', NULL, 1),
(25, 'BM2103', 'Database Systems', NULL, 1),
(26, 'BM3101', 'Research Methodology', NULL, 1),
(27, 'BM4201', 'Information Systems and Strategic Management', NULL, 1),
(28, 'BM4201PT', 'Information System and Strategic Managment P.TIme', NULL, 1),
(29, 'BM4202', 'Business Project Management', NULL, 1),
(30, 'BM4211', 'Total Quality Management', NULL, 1),
(31, 'BM4212', 'Management of Technology and Innovation', NULL, 1),
(32, 'BM4221', 'Data Warehousing & Business Intelligence', NULL, 1),
(33, 'BM5212', 'Management of Innovation and Technology', NULL, 1),
(34, 'BM5213', 'Technopreneurship and Innovation', NULL, 1),
(35, 'BM5214', 'Strategic Management', NULL, 1),
(36, 'BM5215', 'Human Capital Management', NULL, 1),
(37, 'BM5216', 'Production and Operations Management', NULL, 1),
(38, 'BM5312', 'Management Information Systems', NULL, 1),
(39, 'BM5313', 'Data Science for Business', NULL, 1),
(40, 'BM5412', 'Leadership', NULL, 1),
(41, 'CC1102', 'Computational Mathematics', NULL, 1),
(42, 'CC2211', 'Creative Technology 1', NULL, 1),
(43, 'CC2221', 'Digital Art and Design', NULL, 1),
(44, 'CC2223', 'Introduction to Audio Visual Production', NULL, 1),
(45, 'CC4214', 'Artificial Intelligence for Games', NULL, 1),
(46, 'CC4245', 'Animation 1', NULL, 1),
(47, 'CC4253', 'Virtual and Augmented Reality 1', NULL, 1),
(48, 'CC4261', 'Fiction', NULL, 1),
(49, 'CC4262', 'Emotions Engineering', NULL, 1),
(50, 'CC4298', 'Portfolio Development', NULL, 1),
(51, 'CC5335', 'Data Mining', NULL, 1),
(52, 'CG3501', 'Computing Group Project', NULL, 1),
(53, 'CI1102', 'Fundamentals of Information System', NULL, 1),
(54, 'CI1103', 'Programming I', NULL, 1),
(55, 'CI1511', 'Ethics and Innovation in Information Technology', NULL, 1),
(56, 'CI2109', 'Programming III', NULL, 1),
(57, 'CI2110', 'Database System Design and Implementation', NULL, 1),
(58, 'CI2212', 'Human Computer Interaction', NULL, 1),
(59, 'CI2233', 'Introductory Statistics', NULL, 1),
(60, 'CI4220', 'Information Technology Project Management', NULL, 1),
(61, 'CI4221', 'Web Development 2', NULL, 1),
(62, 'CI4222', 'Interactive Content Production', NULL, 1),
(63, 'CI4223', 'Mobile Application Development', NULL, 1),
(64, 'CI4224', 'Web Information Retrieval', NULL, 1),
(65, 'CI4228', 'Software Engineering', NULL, 1),
(66, 'CI4230', 'Information System Management', NULL, 1),
(67, 'CI4231', 'Distributed Database Systems', NULL, 1),
(68, 'CI4525', 'Ethics', NULL, 1),
(69, 'CI5201', 'Computer Application Design and Implementation', NULL, 1),
(70, 'CI5237', 'Computing Research Methodology', NULL, 1),
(71, 'CI5335', 'Data Analytics and Visualization', NULL, 1),
(72, 'CN2202', 'Data and Computer Networking', NULL, 1),
(73, 'CN3582', 'Network Fundamentals (NPM)', NULL, 1),
(74, 'CN4204', 'Advanced Networking 1', NULL, 1),
(75, 'CN4205', 'Network Management', NULL, 1),
(76, 'CN4206', 'Mobile Wireless Network', NULL, 1),
(77, 'CN4243', 'Network Security', NULL, 1),
(78, 'CN5201', 'People and Security', NULL, 1),
(79, 'CN5203', 'Computer Security', NULL, 1),
(80, 'CN5205', 'Cyber Security', NULL, 1),
(81, 'CN5206', 'Digital Forensics', NULL, 1),
(82, 'DA1101', 'Design Studio 1', NULL, 1),
(83, 'DA1102', 'History & Theory of Architecture', NULL, 1),
(84, 'DA1103', 'Architectural Drawing & Representation 1', NULL, 1),
(85, 'DA1208', 'Cultural & Contextual Studies', NULL, 1),
(86, 'DA2201', 'Design Studio 3', NULL, 1),
(87, 'DA2202', 'Building Construction & Working Drawing', NULL, 1),
(88, 'DA2203', 'Introduction to Green Building', NULL, 1),
(89, 'DP1101', 'Computer Aided Drafting', NULL, 1),
(90, 'DP1102', 'Mechanics for Design', NULL, 1),
(91, 'DP1204', 'Inclusive Design and Usability', NULL, 1),
(92, 'DP2201', 'Management of Creativity', NULL, 1),
(93, 'DP2202', 'Graphic Technique for Product Design', NULL, 1),
(94, 'DP2204', 'Creative Design Studio 1', NULL, 1),
(95, 'EC1101', 'Engineering Mechanics', NULL, 1),
(96, 'EC1102', 'Principles of Fluid Mechanics', NULL, 1),
(97, 'EC1501', 'Surveying and Geographical Information System', NULL, 1),
(98, 'EC1502', 'Engineering Drawing', NULL, 1),
(99, 'EC2105', 'Engineering Hydrology', NULL, 1),
(100, 'EC2106', 'Engineering Geology', NULL, 1),
(101, 'EC2107', 'Open Channel Hydraulics', NULL, 1),
(102, 'EC2108', 'Construction Materials', NULL, 1),
(103, 'EC2109', 'Mechanics of Solids', NULL, 1),
(104, 'EC2501', 'Professional Ethics', NULL, 1),
(105, 'EC3101', 'Reinforced and Pre-stressed Concrete Design', NULL, 1),
(106, 'EC3102', 'Steel and Composite Structure Design', NULL, 1),
(107, 'EC3103', 'Geotechnics II', NULL, 1),
(108, 'EC3104', 'Construction Management', NULL, 1),
(109, 'EC3107', 'Water Supply Engineering', NULL, 1),
(110, 'EC3108', 'Geotechnics 1', NULL, 1),
(111, 'EC3303', 'Wastewater Treatment', NULL, 1),
(112, 'EC4103', 'Final Year Project', NULL, 1),
(113, 'EC4201', 'Integrated Civil Design Project', NULL, 1),
(114, 'EC4202', 'Integrated Structural Design Project', NULL, 1),
(115, 'EC4301', 'Advance Concrete Structures', NULL, 1),
(116, 'EC4311', 'Environmental Engineering', NULL, 1),
(117, 'EC4312', 'Renewable Energy Technology', NULL, 1),
(118, 'EC5101', 'Environmental Impact Assessment', NULL, 1),
(119, 'EC5102', 'Environmental Hydraulics', NULL, 1),
(120, 'EC5104', 'Research Project', NULL, 1),
(121, 'EC5301', 'Integrated Water Resources Management', NULL, 1),
(122, 'EC5306', 'Financial Management for Engineers', NULL, 1),
(123, 'EC5401', 'Research Methods', NULL, 1),
(124, 'EE1101', 'Principles of Computer Systems', NULL, 1),
(125, 'EE1102', 'Electrical Principles', NULL, 1),
(126, 'EE1501', 'Electrical Laboratory Skills', NULL, 1),
(127, 'EE2101', 'Electronic Principles', NULL, 1),
(128, 'EE2102', 'Electrical Circuits', NULL, 1),
(129, 'EE2103', 'Computer Communication and Networking', NULL, 1),
(130, 'EE3151', 'Group Design Project', NULL, 1),
(131, 'EE3152', 'Communication Systems', NULL, 1),
(132, 'EE3153', 'Semiconductor Devices for Integrated Circuits', NULL, 1),
(133, 'EE3154', 'Embedded Systems', NULL, 1),
(134, 'EE3156', 'Robotics', NULL, 1),
(135, 'EE3201', 'Electromagnetic Field and Waves', NULL, 1),
(136, 'EE3204', 'Electrical Power Engineering', NULL, 1),
(137, 'EE3302', 'Power Distribution System', NULL, 1),
(138, 'EE4103', 'Mechatronics Laboratory', NULL, 1),
(139, 'EE4172', 'Digital Signal Processing', NULL, 1),
(140, 'EE4371', 'Power Electronics & Drives', NULL, 1),
(141, 'EE4373', 'Optical Communications', NULL, 1),
(142, 'EE4375', 'Electrical Machines 2', NULL, 1),
(143, 'EE4377', 'Power Systems 1', NULL, 1),
(144, 'EE5111', 'Microeletronics', NULL, 1),
(145, 'EE5112', 'Advanced Digital Communication', NULL, 1),
(146, 'EE5113', 'Power System Analysis', NULL, 1),
(147, 'EE5114', 'Insulation Coordination', NULL, 1),
(149, 'EG3501', 'Engineering Management', NULL, 1),
(150, 'EM1101', 'Design', NULL, 1),
(151, 'EM1501', 'Measurement and Instrumentation', NULL, 1),
(152, 'EM2101', 'Engineering Thermodynamics 1', NULL, 1),
(153, 'EM2102', 'Fluid Mechanics 1', NULL, 1),
(154, 'EM2103', 'Mechanics of Materials', NULL, 1),
(155, 'EM3201', 'Engineering Thermodynamics 2', NULL, 1),
(156, 'EM3202', 'Fluid Mechanics 2', NULL, 1),
(157, 'EM3203', 'Manufacturing Engineering', NULL, 1),
(158, 'EM3204', 'Mechanics of Machines', NULL, 1),
(159, 'EM3301', 'Maintenance Engineering', NULL, 1),
(160, 'EM4201', 'Power Plant Engineering', NULL, 1),
(161, 'EM4202', 'Mechanical Vibrations', NULL, 1),
(162, 'EM4301', 'Advanced Engineering Materials', NULL, 1),
(163, 'EM4303', 'Finite Element Analysis', NULL, 1),
(164, 'EM4304', 'Computer Aided Manufacturing', NULL, 1),
(165, 'EM5101', 'Advanced Engineering Thermodynamics', NULL, 1),
(166, 'EM5104', 'Applied Fluid Dynamics', NULL, 1),
(167, 'EM5105', 'Materials Failure Analysis & Prevention', NULL, 1),
(168, 'EM5106', 'Product Design and Development', NULL, 1),
(169, 'EM5108', 'Advanced Solid Mechanics', NULL, 1),
(170, 'EP1101', 'Materials and Energy Balances', NULL, 1),
(171, 'EP1105', 'Physics 1', NULL, 1),
(172, 'EP1106', 'Engineering Materials', NULL, 1),
(173, 'EP1113', 'Introduction to Petroleum Industry', NULL, 1),
(174, 'EP1501', 'Introduction to Chemical Engineering Industry', NULL, 1),
(175, 'EP2101', 'Chemical Engineering Thermodynamics 1', NULL, 1),
(176, 'EP2102', 'Fluid Mechanics', NULL, 1),
(177, 'EP2103', 'Separation Processes 1', NULL, 1),
(178, 'EP2114', 'Statistic for Petroleum Engineers', NULL, 1),
(179, 'EP2115', 'Introduction to Petrophysics', NULL, 1),
(180, 'EP2501', 'Renewable Energy Technologies', NULL, 1),
(181, 'EP3202', 'Reaction Engineering', NULL, 1),
(182, 'EP3205', 'Process safety and Loss Prevention', NULL, 1),
(183, 'EP3206', 'Chemical Process Technology', NULL, 1),
(184, 'EP3217', 'Process Modelling and Simulation', NULL, 1),
(185, 'EP3218', 'Process Design', NULL, 1),
(186, 'EP3224', 'Air and Water Pollution', NULL, 1),
(187, 'EP3225', 'Advanced Petroleum Refining', NULL, 1),
(188, 'EP3301', 'Gas Processing', NULL, 1),
(189, 'EP4232', 'Advanced Reaction Engineering', NULL, 1),
(190, 'EP4233', 'Mechanical Unit Operations', NULL, 1),
(191, 'EP4234', 'Advanced Transport Phenomena', NULL, 1),
(192, 'LG1401-CE', 'Effective Communication', NULL, 1),
(193, 'LG1402', 'Professional Communication', NULL, 1),
(194, 'LG1403', 'Technical Communication', NULL, 1),
(195, 'LG1405', 'Melayu Islam Beraja', NULL, 1),
(196, 'SF1101', 'Chemistry 1', NULL, 1),
(197, 'SF1109', 'Introduction to Food Science and Technology', NULL, 1),
(198, 'SF1510', 'Basic Biology for Food Science and Technology', NULL, 1),
(199, 'SF2201', 'Molecules to Materials', NULL, 1),
(200, 'SF2202', 'Food Science and Technology 1', NULL, 1),
(201, 'SF2203', 'Food Quality', NULL, 1),
(202, 'SF2204', 'Food Preservation', NULL, 1),
(203, 'SF2214', 'Food Chemistry', NULL, 1),
(204, 'SF2215', 'Food Sensory and Flavour Science', NULL, 1),
(205, 'SF2501', 'Microdynamic for Food Processing', NULL, 1),
(206, 'SF2502', 'Mass and Heat Transfer in Food Industry', NULL, 1),
(207, 'SM1101-CE', 'Engineering Mathematics 1', NULL, 1),
(208, 'SM1101-SOD', 'Engineering Mathematics', NULL, 1),
(209, 'SM1103', 'Introduction to Mathematics for Economics', NULL, 1),
(210, 'SM2101', 'Engineering Mathematics 3', NULL, 1),
(211, 'SM2201', 'Differential Equations 1', NULL, 1),
(212, 'SM2202', 'Computational Mathematics 1', NULL, 1),
(213, 'SM2203', 'Principles of Econometrics', NULL, 1),
(214, 'SM2204', 'Econometrics I', NULL, 1),
(220, 'BE1102', 'Principles of Macroeconomics', NULL, 1),
(225, 'BA2242', 'Equity Securities', NULL, 1),
(226, 'BA4245', 'Financial Risk Modelling And Simulation', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_programme`
--

DROP TABLE IF EXISTS `module_programme`;
CREATE TABLE IF NOT EXISTS `module_programme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `programme_id` int(11) NOT NULL,
  `semister` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=148 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_programme`
--

INSERT INTO `module_programme` (`id`, `module_id`, `programme_id`, `semister`) VALUES
(1, 1, 1, 1),
(3, 1, 2, 1),
(4, 1, 5, 1),
(5, 1, 6, 1),
(6, 1, 7, 1),
(7, 1, 13, 5),
(8, 1, 14, 5),
(9, 1, 15, 5),
(10, 1, 16, 5),
(11, 1, 17, 5),
(12, 1, 24, 5),
(13, 1, 9, 1),
(14, 1, 10, 3),
(15, 2, 2, 7),
(16, 3, 2, 7),
(17, 4, 2, 7),
(18, 5, 2, 7),
(19, 5, 5, 7),
(20, 6, 5, 7),
(21, 7, 5, 7),
(22, 8, 5, 7),
(23, 9, 1, 1),
(24, 9, 2, 1),
(25, 9, 5, 1),
(26, 9, 6, 1),
(27, 9, 7, 1),
(28, 9, 23, 1),
(29, 9, 9, 1),
(30, 9, 10, 1),
(31, 220, 10, 3),
(32, 10, 1, 3),
(33, 10, 2, 3),
(34, 10, 3, 3),
(35, 10, 5, 3),
(36, 10, 6, 3),
(37, 10, 7, 3),
(38, 10, 23, 5),
(39, 10, 9, 3),
(40, 11, 1, 3),
(41, 11, 2, 3),
(42, 11, 3, 3),
(43, 11, 5, 3),
(44, 11, 6, 3),
(45, 11, 7, 3),
(46, 11, 23, 3),
(47, 11, 9, 3),
(48, 12, 1, 5),
(49, 12, 2, 5),
(50, 12, 5, 5),
(51, 12, 6, 5),
(52, 12, 7, 5),
(53, 13, 1, 5),
(54, 13, 2, 5),
(55, 13, 3, 5),
(56, 13, 4, 6),
(57, 13, 5, 5),
(58, 13, 6, 5),
(59, 13, 7, 5),
(60, 13, 13, 5),
(61, 13, 14, 5),
(62, 13, 15, 5),
(63, 13, 16, 5),
(64, 13, 17, 5),
(65, 13, 23, 5),
(66, 13, 24, 5),
(67, 13, 27, 7),
(68, 13, 28, 7),
(69, 13, 29, 7),
(70, 13, 30, 7),
(71, 13, 31, 7),
(72, 13, 32, 7),
(73, 13, 9, 5),
(74, 14, 1, 7),
(75, 15, 1, 7),
(76, 98, 1, 7),
(77, 17, 1, 7),
(78, 18, 6, 7),
(79, 18, 14, 5),
(80, 18, 17, 5),
(81, 19, 6, 7),
(82, 20, 6, 7),
(83, 21, 3, 7),
(84, 22, 1, 1),
(85, 22, 2, 1),
(86, 22, 5, 1),
(87, 22, 6, 1),
(88, 22, 7, 1),
(89, 22, 14, 5),
(90, 22, 15, 5),
(91, 22, 17, 5),
(92, 22, 9, 1),
(93, 22, 10, 1),
(94, 23, 1, 3),
(95, 23, 2, 3),
(96, 23, 3, 3),
(97, 23, 5, 3),
(98, 23, 6, 3),
(99, 23, 7, 3),
(100, 23, 13, 5),
(101, 23, 9, 3),
(102, 23, 10, 3),
(103, 24, 1, 3),
(104, 24, 2, 3),
(105, 24, 3, 3),
(106, 24, 5, 3),
(107, 24, 6, 3),
(108, 24, 7, 3),
(109, 24, 14, 5),
(110, 24, 15, 5),
(111, 24, 16, 5),
(112, 24, 23, 5),
(113, 24, 9, 3),
(114, 25, 1, 3),
(115, 25, 3, 3),
(116, 25, 5, 3),
(117, 25, 6, 3),
(118, 25, 24, 5),
(119, 25, 2, 3),
(120, 25, 9, 3),
(121, 26, 1, 5),
(122, 26, 2, 5),
(123, 26, 3, 5),
(124, 26, 5, 5),
(125, 26, 6, 5),
(126, 26, 7, 5),
(127, 26, 23, 5),
(128, 27, 3, 7),
(129, 27, 7, 7),
(130, 221, 4, 7),
(131, 29, 3, 7),
(132, 29, 4, 7),
(133, 29, 5, 7),
(134, 29, 6, 7),
(135, 29, 7, 7),
(136, 21, 4, 7),
(137, 30, 7, 7),
(138, 31, 7, 7),
(139, 32, 3, 7),
(140, 32, 4, 7),
(141, 33, 8, 1),
(142, 34, 11, 3),
(143, 35, 8, 1),
(144, 35, 11, 1),
(145, 36, 8, 1),
(146, 36, 11, 1),
(147, 37, 11, 3);

-- --------------------------------------------------------

--
-- Table structure for table `module_to_programme`
--

DROP TABLE IF EXISTS `module_to_programme`;
CREATE TABLE IF NOT EXISTS `module_to_programme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `programme_id` int(11) NOT NULL,
  `semister` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=542 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_to_programme`
--

INSERT INTO `module_to_programme` (`id`, `module_id`, `programme_id`, `semister`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 5, 1),
(4, 1, 6, 1),
(5, 1, 7, 1),
(6, 1, 13, 5),
(7, 1, 14, 5),
(8, 1, 15, 5),
(9, 1, 16, 5),
(10, 1, 17, 5),
(11, 1, 24, 5),
(12, 1, 9, 1),
(13, 1, 10, 3),
(14, 2, 2, 7),
(15, 3, 2, 7),
(16, 4, 2, 7),
(17, 5, 2, 7),
(18, 5, 5, 7),
(19, 2, 2, 7),
(20, 6, 5, 7),
(21, 7, 5, 7),
(22, 8, 5, 7),
(23, 9, 1, 1),
(24, 9, 2, 1),
(25, 9, 5, 1),
(26, 9, 6, 1),
(27, 9, 7, 1),
(28, 9, 23, 1),
(29, 9, 9, 1),
(30, 9, 10, 1),
(31, 220, 10, 3),
(32, 10, 1, 3),
(33, 10, 2, 3),
(34, 10, 3, 3),
(35, 10, 5, 3),
(36, 10, 6, 3),
(37, 10, 7, 3),
(38, 10, 23, 5),
(39, 10, 9, 3),
(40, 11, 1, 3),
(41, 11, 2, 3),
(42, 11, 3, 3),
(43, 11, 5, 3),
(44, 11, 6, 3),
(45, 11, 7, 3),
(46, 11, 23, 3),
(47, 11, 9, 3),
(48, 12, 1, 5),
(49, 12, 2, 5),
(50, 12, 5, 5),
(51, 12, 6, 5),
(52, 12, 7, 5),
(53, 13, 1, 5),
(54, 13, 2, 5),
(55, 13, 3, 5),
(56, 13, 4, 6),
(57, 13, 5, 5),
(58, 13, 6, 5),
(59, 13, 7, 5),
(60, 13, 13, 5),
(61, 13, 14, 5),
(62, 13, 15, 5),
(63, 13, 16, 5),
(64, 13, 17, 5),
(65, 13, 23, 5),
(66, 13, 24, 5),
(67, 13, 27, 7),
(68, 13, 28, 7),
(69, 13, 29, 7),
(70, 13, 30, 7),
(71, 13, 31, 7),
(72, 13, 32, 7),
(73, 13, 9, 5),
(74, 14, 1, 7),
(75, 15, 1, 7),
(76, 16, 1, 7),
(77, 17, 1, 7),
(78, 18, 6, 7),
(79, 18, 14, 5),
(80, 18, 17, 5),
(81, 19, 6, 7),
(82, 20, 6, 7),
(83, 21, 3, 7),
(84, 22, 1, 1),
(85, 22, 2, 1),
(86, 22, 5, 1),
(87, 22, 6, 1),
(88, 22, 7, 1),
(89, 22, 14, 5),
(90, 22, 15, 5),
(91, 22, 17, 5),
(92, 22, 9, 1),
(93, 22, 10, 1),
(94, 23, 1, 3),
(95, 23, 2, 3),
(96, 23, 3, 3),
(97, 23, 5, 3),
(98, 23, 6, 3),
(99, 23, 7, 3),
(100, 23, 13, 5),
(101, 23, 9, 3),
(102, 23, 10, 3),
(103, 24, 1, 3),
(104, 24, 2, 3),
(105, 24, 3, 3),
(106, 24, 5, 3),
(107, 24, 6, 3),
(108, 24, 7, 3),
(109, 24, 14, 5),
(110, 24, 15, 5),
(111, 24, 16, 5),
(112, 24, 23, 5),
(113, 24, 9, 3),
(114, 25, 1, 3),
(115, 25, 2, 3),
(116, 25, 3, 3),
(117, 25, 5, 3),
(118, 25, 6, 3),
(119, 25, 24, 5),
(120, 25, 9, 3),
(121, 26, 1, 5),
(122, 26, 2, 5),
(123, 26, 3, 5),
(124, 26, 5, 5),
(125, 26, 6, 5),
(126, 26, 7, 5),
(127, 26, 23, 5),
(128, 27, 3, 7),
(129, 27, 7, 7),
(130, 28, 4, 7),
(131, 29, 3, 7),
(132, 29, 4, 7),
(133, 29, 5, 7),
(134, 29, 6, 7),
(135, 29, 7, 7),
(136, 21, 4, 7),
(137, 30, 7, 7),
(138, 31, 7, 7),
(139, 32, 3, 7),
(140, 32, 4, 7),
(141, 33, 8, 1),
(142, 34, 11, 3),
(143, 35, 8, 1),
(144, 35, 11, 1),
(145, 36, 8, 1),
(146, 36, 11, 1),
(147, 37, 11, 3),
(148, 37, 11, 3),
(149, 38, 11, 3),
(150, 39, 11, 3),
(151, 26, 8, 1),
(152, 40, 8, 1),
(153, 40, 11, 1),
(154, 23, 24, 3),
(155, 41, 12, 1),
(156, 41, 13, 1),
(157, 41, 14, 1),
(158, 41, 15, 1),
(159, 41, 16, 1),
(160, 41, 17, 1),
(161, 42, 13, 3),
(162, 42, 16, 3),
(163, 43, 13, 3),
(164, 43, 16, 3),
(165, 44, 13, 3),
(166, 44, 16, 3),
(167, 44, 23, 5),
(168, 45, 16, 7),
(169, 46, 13, 7),
(170, 47, 16, 7),
(171, 48, 13, 7),
(172, 48, 16, 7),
(173, 49, 13, 7),
(174, 50, 13, 7),
(175, 50, 16, 7),
(176, 51, 18, 1),
(177, 52, 12, 5),
(178, 53, 12, 1),
(179, 53, 13, 1),
(180, 53, 14, 1),
(181, 53, 15, 1),
(182, 53, 16, 1),
(183, 53, 17, 1),
(184, 53, 30, 1),
(185, 54, 12, 1),
(186, 54, 13, 1),
(187, 54, 14, 1),
(188, 54, 15, 1),
(189, 54, 16, 1),
(190, 54, 17, 1),
(191, 54, 26, 1),
(192, 55, 19, 5),
(193, 56, 12, 3),
(194, 56, 13, 3),
(195, 56, 14, 3),
(196, 56, 15, 3),
(197, 56, 16, 3),
(198, 56, 17, 3),
(199, 57, 12, 3),
(200, 57, 14, 3),
(201, 57, 15, 3),
(202, 57, 17, 3),
(203, 58, 13, 3),
(204, 58, 14, 3),
(205, 58, 15, 3),
(206, 58, 16, 3),
(207, 58, 17, 3),
(208, 59, 3, 5),
(209, 59, 12, 3),
(210, 59, 23, 1),
(211, 59, 24, 5),
(212, 26, 12, 5),
(213, 26, 13, 5),
(214, 26, 14, 5),
(215, 26, 15, 5),
(216, 26, 16, 5),
(217, 26, 17, 5),
(218, 60, 15, 7),
(219, 60, 17, 7),
(220, 61, 17, 7),
(221, 62, 17, 7),
(222, 63, 17, 7),
(223, 64, 17, 7),
(224, 65, 15, 7),
(225, 66, 15, 7),
(226, 67, 15, 7),
(227, 68, 19, 8),
(228, 69, 18, 1),
(229, 70, 18, 1),
(230, 70, 20, 1),
(231, 51, 18, 1),
(232, 71, 18, 1),
(233, 68, 15, 8),
(234, 72, 12, 3),
(235, 72, 14, 3),
(236, 72, 15, 3),
(237, 72, 17, 3),
(238, 73, 14, 5),
(239, 74, 14, 7),
(240, 75, 14, 7),
(241, 76, 14, 7),
(242, 77, 14, 7),
(243, 78, 18, 1),
(244, 78, 20, 1),
(245, 77, 20, 1),
(246, 79, 20, 1),
(247, 80, 22, 3),
(248, 81, 22, 3),
(249, 82, 25, 1),
(250, 83, 13, 5),
(251, 83, 25, 1),
(252, 84, 13, 5),
(253, 84, 25, 1),
(254, 85, 25, 3),
(255, 86, 25, 3),
(256, 87, 25, 3),
(257, 88, 25, 3),
(258, 89, 26, 1),
(259, 90, 26, 1),
(260, 91, 26, 3),
(261, 92, 26, 3),
(262, 93, 26, 3),
(263, 94, 26, 3),
(264, 95, 27, 1),
(265, 95, 29, 1),
(266, 96, 27, 2),
(267, 96, 29, 2),
(268, 97, 27, 1),
(269, 97, 29, 1),
(270, 98, 13, 5),
(271, 98, 27, 1),
(272, 98, 29, 1),
(273, 99, 27, 3),
(274, 99, 29, 3),
(275, 99, 32, 3),
(276, 100, 27, 5),
(277, 100, 29, 5),
(278, 101, 27, 3),
(279, 101, 29, 3),
(280, 102, 27, 3),
(281, 102, 29, 3),
(282, 102, 32, 3),
(283, 103, 27, 3),
(284, 103, 29, 3),
(285, 104, 27, 3),
(286, 104, 29, 3),
(287, 105, 27, 5),
(288, 105, 29, 5),
(289, 106, 27, 5),
(290, 106, 29, 5),
(291, 107, 27, 5),
(292, 107, 29, 5),
(293, 108, 27, 5),
(294, 108, 29, 5),
(295, 109, 27, 5),
(296, 109, 29, 5),
(297, 110, 27, 5),
(298, 110, 29, 5),
(299, 111, 27, 5),
(300, 111, 29, 5),
(301, 112, 27, 7),
(302, 112, 29, 7),
(303, 113, 27, 7),
(304, 114, 29, 7),
(305, 115, 27, 7),
(306, 115, 29, 7),
(307, 116, 27, 7),
(308, 117, 27, 7),
(309, 117, 29, 7),
(310, 118, 35, 1),
(311, 119, 35, 1),
(312, 120, 35, 1),
(313, 121, 35, 1),
(314, 122, 35, 1),
(315, 123, 35, 1),
(316, 124, 30, 1),
(317, 124, 31, 3),
(318, 125, 26, 3),
(319, 125, 30, 1),
(320, 125, 31, 1),
(321, 125, 32, 1),
(322, 124, 30, 1),
(323, 124, 31, 3),
(324, 126, 30, 1),
(325, 126, 31, 1),
(326, 126, 15, 5),
(327, 126, 17, 5),
(328, 126, 30, 1),
(329, 126, 31, 1),
(330, 127, 30, 3),
(331, 127, 31, 3),
(332, 128, 30, 3),
(333, 128, 31, 3),
(334, 129, 30, 3),
(335, 127, 30, 3),
(336, 127, 31, 3),
(337, 127, 32, 3),
(338, 128, 30, 3),
(339, 128, 31, 3),
(340, 129, 30, 3),
(341, 130, 30, 5),
(342, 130, 31, 5),
(343, 131, 30, 5),
(344, 132, 30, 5),
(345, 133, 30, 5),
(346, 133, 31, 5),
(347, 134, 31, 5),
(348, 135, 30, 5),
(349, 135, 31, 5),
(350, 131, 30, 5),
(351, 133, 30, 5),
(352, 133, 31, 5),
(353, 136, 30, 5),
(354, 132, 30, 5),
(355, 137, 30, 5),
(356, 138, 31, 7),
(357, 139, 31, 7),
(358, 140, 30, 7),
(359, 140, 31, 7),
(360, 139, 30, 7),
(361, 139, 31, 7),
(362, 141, 30, 7),
(363, 142, 30, 7),
(364, 142, 31, 7),
(365, 143, 30, 7),
(366, 144, 21, 1),
(367, 145, 21, 1),
(368, 146, 21, 1),
(369, 147, 21, 1),
(370, 104, 27, 3),
(371, 104, 29, 3),
(372, 104, 30, 3),
(373, 104, 31, 3),
(374, 104, 32, 3),
(375, 104, 28, 3),
(376, 104, 28, 7),
(377, 149, 32, 5),
(378, 123, 34, 1),
(379, 123, 21, 1),
(380, 150, 31, 1),
(381, 150, 32, 1),
(382, 151, 32, 1),
(383, 152, 30, 3),
(384, 152, 31, 3),
(385, 152, 32, 3),
(386, 153, 23, 5),
(387, 153, 31, 5),
(388, 153, 32, 3),
(389, 154, 26, 3),
(390, 154, 32, 3),
(391, 149, 28, 7),
(392, 130, 32, 5),
(393, 155, 32, 5),
(394, 156, 32, 5),
(395, 157, 31, 5),
(396, 157, 32, 5),
(397, 158, 31, 5),
(398, 158, 32, 5),
(399, 159, 32, 5),
(400, 112, 32, 7),
(401, 160, 32, 7),
(402, 161, 32, 7),
(403, 162, 32, 7),
(404, 163, 32, 7),
(405, 164, 32, 7),
(406, 165, 34, 1),
(407, 166, 34, 1),
(408, 167, 34, 1),
(409, 168, 34, 1),
(410, 169, 34, 1),
(411, 170, 28, 1),
(412, 171, 33, 1),
(413, 172, 33, 1),
(414, 172, 33, 1),
(415, 171, 33, 1),
(416, 173, 32, 3),
(417, 173, 33, 1),
(418, 174, 28, 1),
(419, 173, 33, 1),
(420, 175, 28, 3),
(421, 175, 33, 3),
(422, 176, 28, 3),
(423, 176, 33, 3),
(424, 177, 28, 3),
(425, 149, 30, 5),
(426, 149, 31, 5),
(427, 178, 33, 3),
(428, 179, 33, 3),
(429, 180, 28, 3),
(430, 181, 28, 5),
(431, 182, 28, 5),
(432, 183, 28, 5),
(433, 184, 28, 5),
(434, 185, 28, 5),
(435, 184, 28, 5),
(436, 183, 28, 5),
(437, 186, 28, 5),
(438, 187, 28, 5),
(439, 188, 28, 5),
(440, 189, 28, 7),
(441, 190, 28, 7),
(442, 191, 28, 7),
(443, 112, 28, 7),
(444, 189, 28, 7),
(445, 192, 27, 1),
(446, 192, 29, 1),
(447, 192, 30, 1),
(448, 192, 31, 1),
(449, 192, 32, 1),
(450, 192, 28, 1),
(451, 192, 33, 1),
(452, 192, 23, 1),
(453, 192, 24, 1),
(454, 192, 12, 1),
(455, 192, 13, 1),
(456, 192, 14, 1),
(457, 192, 15, 1),
(458, 192, 16, 1),
(459, 192, 17, 1),
(460, 192, 1, 1),
(461, 192, 2, 1),
(462, 192, 5, 1),
(463, 192, 6, 1),
(464, 192, 7, 1),
(465, 192, 9, 1),
(466, 192, 10, 1),
(467, 192, 25, 1),
(468, 192, 26, 1),
(469, 193, 30, 1),
(470, 194, 31, 5),
(471, 195, 1, 1),
(472, 195, 2, 1),
(473, 195, 5, 1),
(474, 195, 6, 1),
(475, 195, 7, 1),
(476, 195, 12, 1),
(477, 195, 13, 1),
(478, 195, 14, 1),
(479, 195, 15, 1),
(480, 195, 16, 1),
(481, 195, 17, 1),
(482, 195, 28, 1),
(483, 195, 33, 3),
(484, 195, 9, 1),
(485, 195, 10, 1),
(486, 195, 23, 1),
(487, 195, 24, 1),
(488, 195, 25, 1),
(489, 195, 26, 1),
(490, 196, 28, 1),
(491, 196, 33, 1),
(492, 197, 24, 1),
(493, 198, 24, 1),
(494, 199, 24, 3),
(495, 200, 24, 3),
(496, 201, 24, 3),
(497, 202, 24, 3),
(498, 203, 24, 3),
(499, 204, 24, 3),
(500, 205, 24, 3),
(501, 206, 24, 3),
(502, 26, 24, 5),
(503, 12, 24, 5),
(504, 207, 27, 1),
(505, 207, 29, 1),
(506, 207, 30, 1),
(507, 207, 31, 1),
(508, 207, 32, 1),
(509, 207, 28, 1),
(510, 207, 33, 1),
(511, 207, 24, 1),
(512, 208, 26, 1),
(513, 209, 23, 1),
(514, 59, 1, 5),
(515, 59, 2, 5),
(516, 59, 3, 5),
(517, 59, 6, 5),
(518, 59, 7, 5),
(519, 59, 23, 1),
(520, 59, 24, 1),
(521, 59, 24, 5),
(522, 59, 30, 1),
(523, 208, 26, 1),
(524, 210, 27, 3),
(525, 210, 28, 3),
(526, 210, 29, 3),
(527, 210, 30, 3),
(528, 210, 31, 3),
(529, 210, 32, 3),
(530, 210, 33, 3),
(531, 211, 23, 3),
(532, 212, 23, 3),
(533, 213, 23, 3),
(534, 214, 23, 3),
(535, 12, 23, 5),
(536, 225, 2, 2),
(537, 226, 2, 2),
(538, 225, 2, 4),
(539, 226, 2, 6),
(540, 26, 2, 7),
(541, 26, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

DROP TABLE IF EXISTS `programme`;
CREATE TABLE IF NOT EXISTS `programme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `programme_name` varchar(255) NOT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programme`
--

INSERT INTO `programme` (`id`, `programme_name`, `faculty_id`, `status`) VALUES
(1, 'Bachelor of Business in Applied Economics and Finance', 1, 1),
(2, 'Bachelor of Business in Accounting and Information Systems', 1, 1),
(3, 'Bachelor of Business in Business Information System', 1, 1),
(4, 'Bachelor of Business in Business Information System(Part Time)', 1, 1),
(5, 'Bachelor of Business in Finance and Risk Management', 1, 1),
(6, 'Bachelor of Business in Marketing and Information Systems', 1, 1),
(7, 'Bachelor of Business in Technology Management', 1, 1),
(8, 'Master in Management and Technology', 1, 1),
(9, 'Bachelor of Business in Business Information Management', 1, 1),
(10, 'Bachelor of Business in Business Information Management (Part Time)', 1, 1),
(25, 'Bachelor of Science in Architecture', 5, 1),
(11, 'Master in Management and Technology (Part Time)', 1, 1),
(12, 'Bachelor of Science in Computing with Data Analytic', 2, 1),
(13, 'Bachelor of Science in Creative Multimedia', 2, 1),
(14, 'Bachelor of Science in Computer Network and Security', 2, 1),
(15, 'Bachelor of Science in Computing', 2, 1),
(16, 'Bachelor of Science in Digital Media', 2, 1),
(17, 'Bachelor of Science in Internet Computing', 2, 1),
(18, 'Master of Science in Computer Information System', 2, 1),
(19, 'Bachelor of Science in Internet Computing (Part Time)', 2, 1),
(20, 'Master of Science in Information Security', 2, 1),
(21, 'Master of Science in Electrical and Electronic Engineering', 3, 1),
(22, 'Master of Science in Information Security (Part Time)', 2, 1),
(23, 'Bachelor of Science in Applied Mathematics and Economics', 4, 1),
(24, 'Bachelor of Science in Food Science and Technology', 4, 1),
(26, 'Bachelor of Science in Product Design', 5, 1),
(27, 'Bachelor of Engineering in Civil Engineering', 3, 1),
(28, 'Bachelor of Engineering in Chemical Engineering', 3, 1),
(29, 'Bachelor of Engineering in Civil and Structural Engineering', 3, 1),
(30, 'Bachelor of Engineering In Electrical and Electronics', 3, 1),
(31, 'Bachelor of Engineering in Mechatronic Engineering', 3, 1),
(32, 'Bachelor of Engineering in Mechanical Engineering', 3, 1),
(33, 'Bachelor of Engineering in Petroleum Engineering', 3, 1),
(34, 'Master of Science in Mechanical Engineering', 3, 1),
(35, 'Master of Science in Water Resources and Environmental Engineering', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `programme_to_faculty`
--

DROP TABLE IF EXISTS `programme_to_faculty`;
CREATE TABLE IF NOT EXISTS `programme_to_faculty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `programme_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programme_to_faculty`
--

INSERT INTO `programme_to_faculty` (`id`, `programme_id`, `faculty_id`) VALUES
(19, 8, 1),
(14, 3, 1),
(13, 2, 1),
(11, 1, 1),
(18, 7, 1),
(17, 6, 1),
(16, 5, 1),
(15, 4, 1),
(20, 9, 1),
(21, 10, 1),
(22, 11, 1),
(23, 12, 2),
(24, 13, 2),
(25, 14, 2),
(26, 15, 2),
(27, 16, 2),
(28, 17, 2),
(29, 19, 2),
(30, 20, 2),
(31, 21, 3),
(32, 22, 2),
(33, 23, 4),
(34, 24, 4),
(35, 25, 5),
(36, 26, 5),
(37, 27, 3),
(38, 28, 3),
(39, 29, 3),
(40, 30, 3),
(41, 31, 3),
(42, 32, 3),
(43, 33, 3),
(44, 34, 3),
(45, 35, 3);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `id` char(40) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `expire`, `data`) VALUES
('0vrac6a7dif9gb9nbf8a8brar1', 1586984884, 0x5f5f666c6173687c613a303a7b7d5f5f69647c693a373b5f5f6578706972657c693a313538363938343634333b5f5f617574685f6c6173745f7570646174657c693a313537323330333731323b5f5f75736572526f6c65737c613a303a7b7d5f5f757365725065726d697373696f6e737c613a303a7b7d5f5f75736572526f757465737c613a303a7b7d656d61696c7c733a31373a2273747564656e7440676d61696c2e636f6d223b75736572526f6c657c693a323b),
('oqtoprcc3r7jef2u4idbkakg11', 1586986098, 0x5f5f666c6173687c613a303a7b7d7365637265746b65797c733a31383a22242525457175695050504032303138252524223b);

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
  `specialneeds` text DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `fathericno` varchar(255) DEFAULT NULL,
  `father_mobile` varchar(128) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `mothericno` varchar(255) DEFAULT NULL,
  `mother_mobile` varchar(128) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `address2` text DEFAULT NULL,
  `address3` text DEFAULT NULL,
  `postal_code` varchar(128) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `account_no` varchar(128) DEFAULT NULL,
  `programme_name` varchar(255) DEFAULT NULL,
  `intake` text DEFAULT NULL,
  `entry` text DEFAULT NULL,
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
  `remarks` text DEFAULT NULL,
  `telphone_work` varchar(255) DEFAULT NULL,
  `mother_ic_color` varchar(255) DEFAULT NULL,
  `status_of_student` varchar(255) DEFAULT NULL,
  `status_remarks` text DEFAULT NULL,
  `mode` varchar(255) DEFAULT NULL,
  `utb_email_address` varchar(255) DEFAULT NULL,
  `degree_classification` varchar(255) DEFAULT NULL,
  `date_of_registration` varchar(255) DEFAULT NULL,
  `date_of_leaving` varchar(255) DEFAULT NULL,
  `previous_roll_no` varchar(255) DEFAULT NULL,
  `previous_programme_name` varchar(255) DEFAULT NULL,
  `previous_intake_no` varchar(255) DEFAULT NULL,
  `previous_utb_email` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `ic_no_format` int(5) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `highest_qualification` varchar(255) DEFAULT NULL,
  `highestqualificationother` varchar(255) DEFAULT NULL,
  `countrycode` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `mailing_permanent` varchar(255) DEFAULT NULL,
  `mailing_address` text DEFAULT NULL,
  `mailing_address2` text DEFAULT NULL,
  `mailing_address3` text DEFAULT NULL,
  `mailing_countrycode` varchar(255) DEFAULT NULL,
  `mailing_state` varchar(255) DEFAULT NULL,
  `mailing_district` varchar(255) DEFAULT NULL,
  `mailing_postal_code` varchar(255) DEFAULT NULL,
  `type_of_residential` varchar(255) DEFAULT NULL,
  `typeofresidentialother` varchar(255) DEFAULT NULL,
  `type_of_programme` varchar(255) DEFAULT NULL,
  `school` varchar(255) DEFAULT NULL,
  `bank_name_other` varchar(255) DEFAULT NULL,
  `bank_account_name` varchar(255) DEFAULT NULL,
  `bank_terms` varchar(255) DEFAULT NULL,
  `is_submit` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `rollno`, `rumpun`, `nationality`, `passportno`, `race`, `religion`, `gender`, `martial_status`, `dob`, `place_of_birth`, `telephone_mobile`, `tele_home`, `emailother`, `lastschoolname`, `type_of_entry`, `specialneeds`, `father_name`, `fathericno`, `father_mobile`, `mother_name`, `mothericno`, `mother_mobile`, `address`, `address2`, `address3`, `postal_code`, `bank_name`, `account_no`, `programme_name`, `intake`, `entry`, `user_image`, `email`, `user_ref_id`, `nationalityother`, `raceother`, `religionother`, `typeofentryother`, `sponsor_type`, `sponsor_type_other`, `ic_no`, `ic_color`, `gaurdian_relation`, `mobile_home`, `father_ic_color`, `gaurdian_employment`, `gaurdian_employer`, `remarks`, `telphone_work`, `mother_ic_color`, `status_of_student`, `status_remarks`, `mode`, `utb_email_address`, `degree_classification`, `date_of_registration`, `date_of_leaving`, `previous_roll_no`, `previous_programme_name`, `previous_intake_no`, `previous_utb_email`, `title`, `ic_no_format`, `age`, `highest_qualification`, `highestqualificationother`, `countrycode`, `state`, `district`, `mailing_permanent`, `mailing_address`, `mailing_address2`, `mailing_address3`, `mailing_countrycode`, `mailing_state`, `mailing_district`, `mailing_postal_code`, `type_of_residential`, `typeofresidentialother`, `type_of_programme`, `school`, `bank_name_other`, `bank_account_name`, `bank_terms`, `is_submit`) VALUES
(1, 'student1', '88880', 'XLR8', 'Other', '99990', 'Other', 'Other', 'Female', 'Married', '09-02-1968', 'hyderabad', '8080808080', '0409898980', 'emailother@gmail.com', 'school attended 0', 'Other', 'special needs0', 'father / gaurdian name 0', '89898 0', '0000000000 0', 'Mother\'s name 0', '777 0', '8999988880 0', 'postal address 1 0', 'postal address 1 2 0', 'postal address 1 3 0', '0000-0', 'Other', '7777 8888 9999 0', '2', '2001', 'Second Year', '', 'student@gmail.com', 7, 'other', 'other', 'other', 'other', 'Other', 'other', '999990', 'Red', 'father 0', '1111111110', 'Red', 'father emp 0', 'father employer 0', 'remarks 1 0', '2222222 0', 'Red', 'Current Student', NULL, 'Part Time', 'utbemail1@gmail.com', NULL, '14-02-2012', '14-02-2016', NULL, NULL, NULL, NULL, 'Datin', 80, 52, 'Other', 'other ', 'Albania', '', 'JJJJJJ', '0', 'postal address 1 0', 'postal address 1 2 0', 'postal address 1 3 0', '', '', 'JJJJJJ', '0000-0', 'Other', 'other', 'Masters by Coursework', 'School of Computing and Informatics', 'other', 'bank account name 0', '0', 'submit'),
(56, 'rajitha', '8337', 'XLR8', 'Malay', '32323', 'Malay', 'Muslim', 'Female', 'Single', '21-04-1950', 'jj', '3232', '2323', 'rajithaother@gmail.com', 'ssdd', 'HECAS', 'sdsd', 'ssdd', '2323', '2323', 'fdf', '233', '3434', 'sdsd', 'sdsd', 'sdsd', '2323', 'BAIDURI', '232', '2', '2011', 'Second Year', '', 'rajitha@gmail.com', 58, '', '', '', '', 'Government Scholarship', '', 'ss', 'Yellow', 'ss', '323', 'Yellow', 'dsd', '32sds', 'sdsd', '223', 'Yellow', 'Current Student', NULL, 'Full Time', 'rajithautb@gmail.com', NULL, '08-04-1950', '26-04-1950', NULL, NULL, NULL, NULL, 'Datin', 23, 69, 'A Level', '', 'Afganistan', '', 'sdsd', '1', 'sdsd', 'sdsd', 'sdsd', '', '', 'sdsd', '2323', 'Own House', '', 'Undergraduate Degree', 'School of Business', '', 'sdds', '1', 'submit');

-- --------------------------------------------------------

--
-- Table structure for table `student_marks`
--

DROP TABLE IF EXISTS `student_marks`;
CREATE TABLE IF NOT EXISTS `student_marks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `semister` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `ew_total_percentage` int(11) NOT NULL,
  `ew_marks` int(11) NOT NULL,
  `cw_total_percentage` int(11) NOT NULL,
  `cw_marks` int(11) NOT NULL,
  `total_percentage` int(11) NOT NULL,
  `is_pass` int(11) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `grade_definition` varchar(50) NOT NULL,
  `entered_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_marks`
--

INSERT INTO `student_marks` (`id`, `semister`, `module_id`, `student_id`, `ew_total_percentage`, `ew_marks`, `cw_total_percentage`, `cw_marks`, `total_percentage`, `is_pass`, `grade`, `grade_definition`, `entered_by`, `updated_by`) VALUES
(29, 5, 1, 1, 36, 90, 36, 90, 72, 1, 'B+', 'Very Good', 59, 59),
(30, 5, 1, 56, 12, 30, 12, 30, 24, 0, 'F', 'Fail', 59, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_marks_temporary`
--

DROP TABLE IF EXISTS `student_marks_temporary`;
CREATE TABLE IF NOT EXISTS `student_marks_temporary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `semister` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `ew_marks` int(11) NOT NULL,
  `cw_marks` int(11) NOT NULL,
  `ew_total_percentage` int(11) NOT NULL,
  `cw_total_percentage` int(11) NOT NULL,
  `total_percentage` int(11) NOT NULL,
  `is_pass` int(11) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `grade_definition` varchar(50) NOT NULL,
  `entered_by` int(11) NOT NULL,
  `marks_id` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_submit` varchar(50) NOT NULL,
  `stage` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_marks_temporary`
--

INSERT INTO `student_marks_temporary` (`id`, `semister`, `module_id`, `student_id`, `ew_marks`, `cw_marks`, `ew_total_percentage`, `cw_total_percentage`, `total_percentage`, `is_pass`, `grade`, `grade_definition`, `entered_by`, `marks_id`, `updated_by`, `is_submit`, `stage`) VALUES
(71, 5, 1, 56, 50, 50, 20, 20, 40, 1, 'E', 'Marginal', 59, 30, 48, 'save', 'pasaved'),
(70, 5, 1, 1, 90, 90, 36, 36, 72, 1, 'B+', 'Very Good', 59, 29, 59, 'submit', 'uebsubmit'),
(68, 5, 1, 1, 60, 60, 24, 24, 48, 1, 'D', 'Satisfactory', 59, 29, 59, 'submit', 'pasubmit'),
(69, 5, 1, 1, 75, 75, 30, 30, 60, 1, 'C+', 'Good', 59, 29, 59, 'submit', 'fssubmit');

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
  `status` int(11) NOT NULL DEFAULT 0,
  `superadmin` smallint(1) DEFAULT 0,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `user_role_ref_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `confirmation_token`, `status`, `superadmin`, `created_at`, `updated_at`, `email`, `user_role_ref_id`, `created_by`, `modified_by`, `user_image`, `is_verified`, `is_admin`) VALUES
(1, 'superadmin', '7YMx4se_msau87jzbRh3_iiQ2nJiqNHA', '$2y$13$ansaxS7vk1U8i5pnStrsW.EztLV6Yo26NZqmX.gkFBxHdocHVsRFm', NULL, 1, 1, 1458643778, 1458643778, 'jdas12@bodhtree.com', NULL, NULL, NULL, NULL, NULL, 0),
(7, 'student@gmail.com', '7YMx4se_msau87jzbRh3_iiQ2nJiqNHA', '$2y$13$ansaxS7vk1U8i5pnStrsW.EztLV6Yo26NZqmX.gkFBxHdocHVsRFm', NULL, 1, 0, 1565517504, 1581614745, 'student@gmail.com', 2, NULL, NULL, 'flower.jpg', 1, 0),
(48, 'examofficer1@gmail.com', 'ACsOtjzXn4xtHEjrL03-KzR-DYcgUJ91', '$2y$13$ansaxS7vk1U8i5pnStrsW.EztLV6Yo26NZqmX.gkFBxHdocHVsRFm', NULL, 1, 0, 1585730678, 1585730678, 'examofficer1@gmail.com', 3, NULL, NULL, NULL, 1, 1),
(51, 'examofficer2@gmail.com', 'aIi-ZMdnXoZBJ1lhWMFsQnoYYMHlJklB', '$2y$13$5wnqocMevYdG7dedIz7WH.oBkyyArbbZn9g55BjyVRJ5ehaWdK0da', NULL, 1, 0, 1586160711, 1586160711, 'examofficer2@gmail.com', 3, NULL, NULL, NULL, 1, 0),
(52, 'examofficer3@gmail.com', 'DGMwQ5BHeci2_ZWoe3-2zFWVdWBeH6O5', '$2y$13$MW82oMecyL8k/xkTjcXY0edl6Qnf41wEVsTmhuoXiruwqTxB5EOeS', NULL, 1, 0, 1586160803, 1586160803, 'examofficer3@gmail.com', 3, NULL, NULL, NULL, 1, 1),
(57, 'examofficer4@gmail.com', 'Y2DPvpgswYa4YnmIp8DT1p-mtDJzoSf1', '$2y$13$efFFvdae2hlUIlNeT0/C8eYmF/nRsSR2RnP1jYCInhWEsol/1TRNK', NULL, 1, 0, 1586162046, 1586162046, 'examofficer4@gmail.com', 3, NULL, NULL, NULL, 1, 0),
(58, 'rajitha@gmail.com', 'yODu5zf7KSHuPBa0luVTMZBcYNdXv2X8', '$2y$13$ggVWhpOQg3rspjxLTUYEzeZs9sRcnapEzCsnMVkerluzyMtW504Q.', NULL, 1, 0, 1586160493, 1586159194, 'rajitha@gmail.com', 2, NULL, NULL, NULL, 1, 0),
(59, 'shaistawasiuzzaman@gmail.com', '-QhDC9_wkExbSFrucQrZdSv_euPg9tGK', '$2y$13$izK0s8xiU6tTcs48GTeTw.AHsfj.6jIMaymSO6Y7.w4A7DjbBsM.G', NULL, 1, 0, 1586160783, 1586160783, 'shaistawasiuzzaman@gmail.com', 4, NULL, NULL, NULL, 1, 0),
(60, 'ibrahimaramidesalihu@gmail.com', 'GDtKM1Dnnz6JUK00cqcZ6nHQcH527zHU', '$2y$13$l.3zNyz2tqI7cmDHGqK/WuE.upsw9IqdS/MTgnTfB656bp2wl.U.O', NULL, 1, 0, 1586160828, 1586160828, 'ibrahimaramidesalihu@gmail.com', 4, NULL, NULL, NULL, 1, 0),
(61, 'hjhfarahiyahbintihjkawi@gmail.com', 'hDpqSa2RNyxRRZV-nFcBhzd6Us6BOQti', '$2y$13$BUIbla4k0e6yeU1YtrefAOscGpC6YCzOID8hi6slVG.IfYHSmGJ6G', NULL, 1, 0, 1586160926, 1586160926, 'hjhfarahiyahbintihjkawi@gmail.com', 4, NULL, NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role` varchar(30) NOT NULL,
  PRIMARY KEY (`user_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_role_id`, `user_role`) VALUES
(1, 'Admin'),
(2, 'Student'),
(3, 'Exam Officer'),
(4, 'Lecturer');

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

