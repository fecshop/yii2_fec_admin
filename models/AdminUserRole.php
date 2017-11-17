<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecadmin\models;
use Yii;
use yii\db\ActiveRecord;
use fec\helpers\CUrl;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class AdminUserRole extends ActiveRecord
{
    private $_admin_menu;
	private $_admin_menu_tree_arr;
	public  $_ajaxMenuEditUrl;
	
	
	
    public static function tableName()
    {
        return '{{%admin_user_role}}';
    }
	
	public function rules()
    {
		$current_rules = [
			['user_id', 'required'],
			['role_id', 'required'],
		];
		return $current_rules;
    }
	
	
}
