<?php
namespace fecadmin\models;

use Yii;
use yii\db\ActiveRecord;
use fec\helpers\CUrl;
# use fecadmin\models\AdminUserRole;
class AdminUserRole extends ActiveRecord
{
    private $_admin_menu;
	private $_admin_menu_tree_arr;
	public  $_ajaxMenuEditUrl;
	
	
	
    public static function tableName()
    {
        return 'admin_user_role';
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
