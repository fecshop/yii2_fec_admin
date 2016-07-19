<?php

use yii\db\Migration;

class m160606_014712_admin_user_role extends Migration
{
    public function up()
    {
			$sql1 = "
				CREATE TABLE IF NOT EXISTS `admin_user_role` (
				  `id` int(20) NOT NULL AUTO_INCREMENT,
				  `user_id` int(30) NOT NULL,
				  `role_id` int(30) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;
				";
		$this->execute($sql1);
		$sql2 = "
				
		INSERT INTO `admin_user_role` (`id`, `user_id`, `role_id`) VALUES
		(1, 2, 4),
		(2, 2, 12),
		(3, 1, 12),
		(4, 1, 13);
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
