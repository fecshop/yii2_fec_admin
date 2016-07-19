<?php

use yii\db\Migration;

class m160516_021121_admin_menu extends Migration
{
    public function up()
    {
		$sql1 = "CREATE TABLE IF NOT EXISTS `admin_menu` (
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
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=179 ;
		";
		$this->execute($sql1);
		$sql2 = "INSERT INTO `admin_menu` (`id`, `name`, `level`, `parent_id`, `url_key`, `role_key`, `created_at`, `updated_at`, `sort_order`, `can_delete`) VALUES
			(164, '控制面板', 1, 0, '/ddd', NULL, '2016-01-15 10:21:36', '2016-01-15 10:21:36', 0, 1),
			(165, '用户管理', 2, 164, '/ddd', NULL, '2016-01-15 10:23:01', '2016-01-15 10:23:01', 0, 1),
			(166, '菜单管理', 2, 164, '/fecadmin/menu/manager', '/fecadmin/menu', '2016-01-15 10:23:22', '2016-01-16 16:45:23', 0, 1),
			(167, '我的账户', 3, 165, '/fecadmin/myaccount/index', '/fecadmin/myaccount', '2016-01-15 10:24:29', '2016-01-16 16:07:58', 0, 1),
			(168, '账户管理', 3, 165, '/fecadmin/account/manager', '/fecadmin/account', '2016-01-15 10:24:51', '2016-01-21 15:24:18', 0, 1),
			(169, '权限管理', 3, 165, '/fecadmin/role/manager', '/fecadmin/role', '2016-01-15 10:25:10', '2016-01-21 13:22:39', 0, 1),
			(170, '操作日志', 2, 164, '/fecadmin/log/index', '/fecadmin/log', '2016-01-15 10:35:19', '2016-01-16 16:45:18', 0, 1),
			(171, '缓存管理', 2, 164, '/fecadmin/cache/index', '/fecadmin/cache', '2016-01-15 10:35:40', '2016-01-16 16:45:14', 0, 1),
			(177, 'CMS', 1, 0, '/x/x/x', '/x/x', '2016-07-11 21:16:56', '2016-07-16 09:32:30', 5, 2),
			(178, 'Article', 2, 177, '/cms/article/index', '/cms/article', '2016-07-11 21:17:17', '2016-07-11 21:17:17', 0, 2);
		";
		$this->execute($sql2);
    }

    public function down()
    {
        echo "m160516_021121_admin_menu cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
