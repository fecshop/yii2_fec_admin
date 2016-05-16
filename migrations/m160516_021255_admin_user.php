<?php

use yii\db\Migration;

class m160516_021255_admin_user extends Migration
{
    public function up()
    {
			$sql1 = "
				
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

			";
		$this->execute($sql1);
		$sql2 = "
				
				INSERT INTO `admin_user` (`id`, `username`, `password_hash`, `password_reset_token`, `email`, `person`, `auth_key`, `status`, `created_at`, `updated_at`, `password`, `role`, `access_token`, `allowance`, `allowance_updated_at`, `created_at_datetime`, `updated_at_datetime`, `birth_date`) VALUES
				(1, 'terry', '$2y$13$EyK1HyJtv4A/19Jb8gB5y.4SQm5y93eMeHjUf35ryLyd2dWPJlh8y', NULL, 'zqy234@126.com', NULL, 'HH-ZlZXirlG-egyz8OTtl9EVj9fvKW00', 1, 1441763620, 1452928074, '', '12', 'yrYWR7kY-A9bUAP6UUZgCR3yi3ALtUh-', 599, 1452491877, '2016-01-12 09:41:44', '2016-01-16 15:07:54', NULL),
				(2, 'admin', '$2y$13$GRSm4Tyd5nQ0hYkTB9B2eOW0uJcmV.PMAVHiC3oFYoDjsRiahaCte', NULL, '3727@qq.com', '超级管理员', '_PYjb4PdIIY332LquBRC5tClZUXV0zm_', 1, NULL, 1453361905, '', '4', '1Gk6ZNn-QaBaKFI4uE2bSw0w3N7ej72q', NULL, NULL, '2016-01-11 09:41:52', '2016-01-18 15:06:25', NULL);

			";
		$this->execute($sql2);
    }

    public function down()
    {
        echo "m160516_021255_admin_user cannot be reverted.\n";

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
