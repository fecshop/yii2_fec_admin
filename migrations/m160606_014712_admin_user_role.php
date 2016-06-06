<?php

use yii\db\Migration;

class m160606_014712_admin_user_role extends Migration
{
    public function up()
    {
			$sql1 = "
				CREATE TABLE IF NOT EXISTS `admin_user_role` (
				  `id` int(20) NOT NULL AUTO_INCREMENT,
				  `user_id` int(20) NOT NULL COMMENT '用户id',
				  `role_id` int(20) NOT NULL COMMENT '权限id',
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;
			";
		$this->execute($sql1);
		$sql2 = "
				INSERT INTO `admin_user_role` (`id`, `user_id`, `role_id`) VALUES
				(3, 1, 14),
				(5, 1, 13),
				(12, 2, 4);
			";
		$this->execute($sql2);
    }

    public function down()
    {
        echo "m160606_014712_admin_user_role cannot be reverted.\n";

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
