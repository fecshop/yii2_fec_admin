
CREATE TABLE IF NOT EXISTS `admin_menu` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `level` int(5) DEFAULT NULL,
  `parent_id` int(15) DEFAULT NULL,
  `url_key` varchar(255) DEFAULT NULL,
  `role_key` varchar(150) DEFAULT NULL COMMENT '权限key，也就是controller的路径，譬如/fecadmin/menu/managere,controller 是MenuController，当前的值为：/fecadmin/menu',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `sort_order` int(10) NOT NULL DEFAULT '0',
  `can_delete` int(5) DEFAULT '2' COMMENT '是否可以被删除，1代表不可以删除，2代表可以删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=177 ;

--
-- 转存表中的数据 `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `name`, `level`, `parent_id`, `url_key`, `role_key`, `created_at`, `updated_at`, `sort_order`, `can_delete`) VALUES
(164, '控制面板', 1, 0, '/ddd', NULL, '2016-01-15 10:21:36', '2016-01-15 10:21:36', 0, 1),
(165, '用户管理', 2, 164, '/ddd', NULL, '2016-01-15 10:23:01', '2016-01-15 10:23:01', 0, 1),
(166, '菜单管理', 2, 164, '/fecadmin/menu/manager', '/fecadmin/menu', '2016-01-15 10:23:22', '2016-01-16 16:45:23', 0, 1),
(167, '我的账户', 3, 165, '/fecadmin/myaccount/index', '/fecadmin/myaccount', '2016-01-15 10:24:29', '2016-01-16 16:07:58', 0, 1),
(168, '账户管理', 3, 165, '/fecadmin/account/manager', '/fecadmin/account', '2016-01-15 10:24:51', '2016-01-21 15:24:18', 0, 1),
(169, '权限管理', 3, 165, '/fecadmin/role/manager', '/fecadmin/role', '2016-01-15 10:25:10', '2016-01-21 13:22:39', 0, 1),
(170, '操作日志', 2, 164, '/fecadmin/log/index', '/fecadmin/log', '2016-01-15 10:35:19', '2016-01-16 16:45:18', 0, 1),
(171, '缓存管理', 2, 164, '/fecadmin/cache/index', '/fecadmin/cache', '2016-01-15 10:35:40', '2016-01-16 16:45:14', 0, 1),
(172, '后台管理应用Example', 1, 0, '/manager/admin', '/manager', '2016-01-18 10:59:51', '2016-01-18 10:59:51', 0, 2),
(173, 'grid示例', 2, 172, '/fecadmin/grid/example', '/fecadmin/grid', '2016-01-18 11:00:36', '2016-01-18 11:00:36', 0, 2),
(176, 'sd', 1, 0, 'asd', '', '2016-01-21 15:36:28', '2016-01-21 15:36:28', 0, 2);

-- --------------------------------------------------------

--
-- 表的结构 `admin_role`
--

CREATE TABLE IF NOT EXISTS `admin_role` (
  `role_id` int(15) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '权限名字',
  `role_description` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '权限描述',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `admin_role`
--

INSERT INTO `admin_role` (`role_id`, `role_name`, `role_description`) VALUES
(4, 'admin', '超级用户'),
(12, '账户管理员', '账户管理员'),
(13, 'ceshi', 'ceshi');

-- --------------------------------------------------------

--
-- 表的结构 `admin_role_menu`
--

CREATE TABLE IF NOT EXISTS `admin_role_menu` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `menu_id` int(15) NOT NULL,
  `role_id` int(15) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- 转存表中的数据 `admin_role_menu`
--

INSERT INTO `admin_role_menu` (`id`, `menu_id`, `role_id`, `created_at`, `updated_at`) VALUES
(4, 164, 4, '2016-01-16 11:19:15', '2016-01-16 11:19:15'),
(33, 165, 12, '2016-01-16 12:05:01', '2016-01-16 12:05:01'),
(34, 167, 12, '2016-01-16 12:05:01', '2016-01-16 12:05:01'),
(36, 169, 12, '2016-01-16 12:05:01', '2016-01-16 12:05:01'),
(37, 164, 12, '2016-01-16 12:05:01', '2016-01-16 12:05:01'),
(38, 165, 4, '2016-01-16 14:46:17', '2016-01-16 14:46:17'),
(39, 167, 4, '2016-01-16 14:46:17', '2016-01-16 14:46:17'),
(41, 169, 4, '2016-01-16 14:46:17', '2016-01-16 14:46:17'),
(43, 171, 4, '2016-01-16 14:46:17', '2016-01-16 14:46:17'),
(46, 166, 4, '2016-01-16 17:47:30', '2016-01-16 17:47:30'),
(49, 168, 4, '2016-01-18 12:16:49', '2016-01-18 12:16:49'),
(50, 170, 4, '2016-01-18 12:16:49', '2016-01-18 12:16:49'),
(51, 164, 13, '2016-01-21 14:12:09', '2016-01-21 14:12:09'),
(52, 165, 13, '2016-01-21 14:12:09', '2016-01-21 14:12:09'),
(53, 167, 13, '2016-01-21 14:12:09', '2016-01-21 14:12:09'),
(54, 168, 13, '2016-01-21 14:12:09', '2016-01-21 14:12:09'),
(55, 169, 13, '2016-01-21 14:12:09', '2016-01-21 14:12:09'),
(56, 166, 13, '2016-01-21 14:12:09', '2016-01-21 14:12:09'),
(57, 170, 13, '2016-01-21 14:12:09', '2016-01-21 14:12:09'),
(58, 171, 13, '2016-01-21 14:12:09', '2016-01-21 14:12:09');

-- --------------------------------------------------------

--
-- 表的结构 `admin_user`
--

CREATE TABLE IF NOT EXISTS `admin_user` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL COMMENT '用户名',
  `password_hash` varchar(80) DEFAULT NULL COMMENT '密码',
  `password_reset_token` varchar(60) DEFAULT NULL COMMENT '密码token',
  `email` varchar(60) DEFAULT NULL COMMENT '邮箱',
  `person` varchar(100) DEFAULT NULL COMMENT '用户姓名',
  `auth_key` varchar(60) DEFAULT NULL,
  `status` int(5) DEFAULT NULL COMMENT '状态',
  `created_at` int(18) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(18) DEFAULT NULL COMMENT '更新时间',
  `password` varchar(50) DEFAULT NULL COMMENT '密码',
  `role` varchar(50) DEFAULT NULL COMMENT 'role',
  `access_token` varchar(60) DEFAULT NULL,
  `allowance` int(20) DEFAULT NULL,
  `allowance_updated_at` int(20) DEFAULT NULL,
  `created_at_datetime` datetime DEFAULT NULL,
  `updated_at_datetime` datetime DEFAULT NULL,
  `birth_date` datetime DEFAULT NULL COMMENT '出生日期',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `access_token` (`access_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `admin_user`
--

INSERT INTO `admin_user` (`id`, `username`, `password_hash`, `password_reset_token`, `email`, `person`, `auth_key`, `status`, `created_at`, `updated_at`, `password`, `role`, `access_token`, `allowance`, `allowance_updated_at`, `created_at_datetime`, `updated_at_datetime`, `birth_date`) VALUES
(1, 'terry', '$2y$13$EyK1HyJtv4A/19Jb8gB5y.4SQm5y93eMeHjUf35ryLyd2dWPJlh8y', NULL, 'zqy234@126.com', NULL, 'HH-ZlZXirlG-egyz8OTtl9EVj9fvKW00', 1, 1441763620, 1452928074, '', '12', 'yrYWR7kY-A9bUAP6UUZgCR3yi3ALtUh-', 599, 1452491877, '2016-01-12 09:41:44', '2016-01-16 15:07:54', NULL),
(2, 'admin', '$2y$13$GRSm4Tyd5nQ0hYkTB9B2eOW0uJcmV.PMAVHiC3oFYoDjsRiahaCte', NULL, '3727@qq.com', '超级管理员', '_PYjb4PdIIY332LquBRC5tClZUXV0zm_', 1, NULL, 1453361905, '', '4', '1Gk6ZNn-QaBaKFI4uE2bSw0w3N7ej72q', NULL, NULL, '2016-01-11 09:41:52', '2016-01-18 15:06:25', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_visit_log`
--

CREATE TABLE IF NOT EXISTS `admin_visit_log` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `account` varchar(25) DEFAULT NULL COMMENT '操作账号',
  `person` varchar(25) DEFAULT NULL COMMENT '操作人姓名',
  `created_at` datetime DEFAULT NULL COMMENT '操作时间',
  `menu` varchar(100) DEFAULT NULL COMMENT '菜单',
  `url` varchar(255) DEFAULT NULL COMMENT 'URL',
  `url_key` varchar(150) DEFAULT NULL COMMENT '参数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `admin_visit_log`
--
