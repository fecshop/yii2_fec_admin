<?php

use yii\db\Migration;

class m160516_021204_admin_role extends Migration
{
    public function up()
    {
		$sql1 = "
			CREATE TABLE IF NOT EXISTS `admin_role` (
			  `role_id` int(15) NOT NULL AUTO_INCREMENT,
			  `role_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '权限名字',
			  `role_description` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '权限描述',
			  PRIMARY KEY (`role_id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;
			";
		$this->execute($sql1);
		$sql2 = "
			INSERT INTO `admin_role` (`role_id`, `role_name`, `role_description`) VALUES
			(4, 'admin', '超级用户'),
			(12, '账户管理员', '账户管理员'),
			(13, 'ceshi', 'ceshi');
		";
		$this->execute($sql2);
    }

    public function down()
    {
        echo "m160516_021204_admin_role cannot be reverted.\n";

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
