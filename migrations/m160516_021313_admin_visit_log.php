<?php

use yii\db\Migration;

class m160516_021313_admin_visit_log extends Migration
{
    public function up()
    {
			$sql1 = "
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

			";
		$this->execute($sql1);
		
    }

    public function down()
    {
        echo "m160516_021313_admin_visit_log cannot be reverted.\n";

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
