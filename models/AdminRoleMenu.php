<?php
namespace fecadmin\models;

use Yii;
use yii\db\ActiveRecord;
use fec\helpers\CUrl;

class AdminRoleMenu extends ActiveRecord
{
    
	
    public static function tableName()
    {
        return 'admin_role_menu';
    }
	
	public function rules()
    {
		$current_rules = [
			['menu_id', 'required'],
			['role_id', 'required'],
		];
		return $current_rules;
    }
	
	/*
	public function validateSortOrder($attribute,$params){
		if($order = $this->sort_order){
			if(!is_numeric($order)){
				$this->addError($attribute,"sort_order must be numeric");
			}
		}
	}
	*/
	
	
	
}
