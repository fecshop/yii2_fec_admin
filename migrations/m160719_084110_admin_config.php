<?php

use yii\db\Migration;

class m160719_084110_admin_config extends Migration
{
    public function up()
    {
		$sql1 = "
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
		";
		$this->execute($sql1);
		$sql2 = "
			INSERT INTO `admin_config` (`id`, `label`, `key`, `value`, `description`, `created_at`, `updated_at`, `created_person`) VALUES
			(6, '品牌统计-订单处理脚本，多少月前', 'brand_order_month_before', '10', '取多少个月前的订单', '2016-04-26 17:53:30', '2016-06-30 11:58:50', 'admin'),
			(7, '品牌统计-广告数量最大个数', 'brand_show_count', '22', '品牌统计-广告数量最大个数', '2016-04-28 16:41:13', '2016-07-05 10:01:34', 'admin'),
			(8, '废弃-多少月前的数据 - erp_on_way_count_by_day', 'erp_on_way_count_by_day_before_months', '24', '对应erpCollInit脚本 - 处理表：erp_on_way_count_by_day ，增加subtotal字段功能，处理多少个月之前的表数据', '2016-05-24 15:56:39', '2016-06-30 12:01:53', 'admin'),
			(9, 'ebayOrder脚本的跑的月范围', 'ebay_order_month_before', '10', '当前时间多少月之前的订单，进行处理', '2016-07-01 14:59:48', '2016-07-01 14:59:48', 'admin');
		";
		$this->execute($sql2);
    }

    public function down()
    {
        echo "m160719_084110_admin_config cannot be reverted.\n";

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
