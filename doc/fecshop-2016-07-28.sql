-- phpMyAdmin SQL Dump
-- version 3.3.10
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 07 月 28 日 22:22
-- 服务器版本: 5.6.14
-- PHP 版本: 5.4.34

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `fecshop`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_config`
--

CREATE TABLE IF NOT EXISTS `admin_config` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `label` varchar(150) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` varchar(2555) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_person` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `admin_config`
--

INSERT INTO `admin_config` (`id`, `label`, `key`, `value`, `description`, `created_at`, `updated_at`, `created_person`) VALUES
(6, '品牌统计-订单处理脚本，多少月前', 'brand_order_month_before', '10', '取多少个月前的订单', '2016-04-26 17:53:30', '2016-06-30 11:58:50', 'admin'),
(7, '品牌统计-广告数量最大个数', 'brand_show_count', '22', '品牌统计-广告数量最大个数', '2016-04-28 16:41:13', '2016-07-05 10:01:34', 'admin'),
(8, '废弃-多少月前的数据 - erp_on_way_count_by_day', 'erp_on_way_count_by_day_before_months', '24', '对应erpCollInit脚本 - 处理表：erp_on_way_count_by_day ，增加subtotal字段功能，处理多少个月之前的表数据', '2016-05-24 15:56:39', '2016-06-30 12:01:53', 'admin'),
(9, 'ebayOrder脚本的跑的月范围', 'ebay_order_month_before', '10', '当前时间多少月之前的订单，进行处理', '2016-07-01 14:59:48', '2016-07-01 14:59:48', 'admin');

-- --------------------------------------------------------

--
-- 表的结构 `admin_menu`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=189 ;

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
(177, 'CMS', 1, 0, '/x/x/x', '/x/x', '2016-07-11 21:16:56', '2016-07-16 09:32:30', 5, 2),
(178, 'Article', 2, 177, '/cms/article/index', '/cms/article', '2016-07-11 21:17:17', '2016-07-11 21:17:17', 0, 2),
(179, 'Catalog', 1, 0, '/x/x/x', '/x/x', '2016-07-22 16:01:37', '2016-07-22 16:01:44', 100, 2),
(180, '产品管理', 2, 179, '/catalog/product/index', '/catalog/product', '2016-07-22 16:02:01', '2016-07-22 16:07:03', 100, 2),
(181, 'Url 重写管理', 2, 179, '/catalog/urlrewrite/index', '/catalog/urlrewrite', '2016-07-22 16:02:49', '2016-07-22 16:10:14', 0, 2),
(182, '分类管理', 2, 179, '/catalog/category/index', '/catalog/category', '2016-07-22 16:03:05', '2016-07-22 16:07:11', 90, 2),
(183, '后台配置', 2, 164, '/fecadmin/config/manager', '/fecadmin/config', '2016-07-22 16:05:31', '2016-07-22 16:05:31', 0, 2),
(184, 'LOG打印输出', 2, 164, '/fecadmin/systemlog/manager', '/fecadmin/systemlog', '2016-07-22 16:05:56', '2016-07-22 16:05:56', 0, 2),
(185, '产品信息管理', 3, 180, '/catalog/productinfo/index', '/catalog/productinfo', '2016-07-22 16:08:17', '2016-07-22 16:08:17', 0, 2),
(186, '产品评论管理', 3, 180, '/catalog/productreview/index', '/catalog/productreview', '2016-07-22 16:08:35', '2016-07-22 16:08:35', 0, 2),
(187, '产品搜索管理', 3, 180, '/catalog/productsearch/index', '/catalog/productsearch', '2016-07-22 16:09:41', '2016-07-22 16:09:41', 0, 2),
(188, '产品Tag管理', 3, 180, '/catalog/producttag/index', '/catalog/producttag', '2016-07-22 16:09:57', '2016-07-22 16:09:57', 0, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

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
(58, 171, 13, '2016-01-21 14:12:09', '2016-01-21 14:12:09'),
(64, 177, 4, '2016-07-11 21:17:46', '2016-07-11 21:17:46'),
(65, 178, 4, '2016-07-11 21:17:46', '2016-07-11 21:17:46'),
(66, 179, 4, '2016-07-22 16:04:25', '2016-07-22 16:04:25'),
(67, 180, 4, '2016-07-22 16:04:25', '2016-07-22 16:04:25'),
(68, 182, 4, '2016-07-22 16:04:25', '2016-07-22 16:04:25'),
(69, 181, 4, '2016-07-22 16:04:25', '2016-07-22 16:04:25'),
(70, 183, 4, '2016-07-22 16:06:10', '2016-07-22 16:06:10'),
(71, 184, 4, '2016-07-22 16:06:10', '2016-07-22 16:06:10'),
(72, 185, 4, '2016-07-22 16:10:22', '2016-07-22 16:10:22'),
(73, 186, 4, '2016-07-22 16:10:22', '2016-07-22 16:10:22'),
(74, 187, 4, '2016-07-22 16:10:22', '2016-07-22 16:10:22'),
(75, 188, 4, '2016-07-22 16:10:22', '2016-07-22 16:10:22');

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
  `code` varchar(100) DEFAULT NULL,
  `auth_key` varchar(60) DEFAULT NULL,
  `status` int(5) DEFAULT NULL COMMENT '状态',
  `created_at` int(18) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(18) DEFAULT NULL COMMENT '更新时间',
  `password` varchar(50) DEFAULT NULL COMMENT '密码',
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

INSERT INTO `admin_user` (`id`, `username`, `password_hash`, `password_reset_token`, `email`, `person`, `code`, `auth_key`, `status`, `created_at`, `updated_at`, `password`, `access_token`, `allowance`, `allowance_updated_at`, `created_at_datetime`, `updated_at_datetime`, `birth_date`) VALUES
(1, 'terry', '$2y$13$EyK1HyJtv4A/19Jb8gB5y.4SQm5y93eMeHjUf35ryLyd2dWPJlh8y', NULL, 'zqy234@126.com', '', '3333', 'HH-ZlZXirlG-egyz8OTtl9EVj9fvKW00', 1, 1441763620, 1467522167, '', 'yrYWR7kY-A9bUAP6UUZgCR3yi3ALtUh-', 599, 1452491877, '2016-01-12 09:41:44', '2016-07-03 13:02:47', NULL),
(2, 'admin', '$2y$13$T5ZFrLpJdTEkAoAdnC6A/u8lh/pG.6M0qAZBo1lKE.6x6o3V6yvVG', NULL, '3727@qq.com', '超级管理员', '111', '_PYjb4PdIIY332LquBRC5tClZUXV0zm_', 1, NULL, 1468917063, '', '1Gk6ZNn-QaBaKFI4uE2bSw0w3N7ej72q', NULL, NULL, '2016-01-11 09:41:52', '2016-06-26 01:40:55', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_user_role`
--

CREATE TABLE IF NOT EXISTS `admin_user_role` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(30) NOT NULL,
  `role_id` int(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `admin_user_role`
--

INSERT INTO `admin_user_role` (`id`, `user_id`, `role_id`) VALUES
(1, 2, 4),
(2, 2, 12),
(3, 1, 12),
(4, 1, 13);

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

