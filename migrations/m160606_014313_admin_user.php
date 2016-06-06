<?php

use yii\db\Migration;

class m160606_014313_admin_user extends Migration
{
    public function up()
    {
		
		
		$sql1 = "
				ALTER TABLE `admin_user` DROP `role`
			";
		$this->execute($sql1);
    }

    public function down()
    {
        echo "m160606_014313_admin_user cannot be reverted.\n";

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
