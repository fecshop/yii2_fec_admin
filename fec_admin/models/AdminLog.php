<?php
namespace fecadmin\models;

use Yii;
use yii\db\ActiveRecord;
use fec\helpers\CUrl;

class AdminLog extends ActiveRecord
{
   
	
    public static function tableName()
    {
        return 'admin_visit_log';
    }
	
	/*
	public function rules()
    {
		$current_rules = [
			[['name', 'parent_id','url_key',], 'required'],
			['sort_order','validateSortOrder'],
		];
		return $current_rules;
    }
	
	public function validateSortOrder($attribute,$params){
		if($order = $this->sort_order){
			if(!is_numeric($order)){
				$this->addError($attribute,"sort_order must be numeric");
			}
		}
	}
	*/
	
	
	
}
