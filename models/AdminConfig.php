<?php
namespace fecadmin\models;

use Yii;
use fec\helpers\CDate;
use yii\db\ActiveRecord;
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class AdminConfig extends ActiveRecord
{
    
    /**
     * @inheritdoc
     */
	# 设置table
    public static function tableName()
    {
        return 'admin_config';
    }
	
	 /**
     * @inheritdoc
     */
	# 设置 status  默认  ，以及取值的区间
    public function rules()
    {
        return [
            ['label', 'filter', 'filter' => 'trim'],
			['key', 'filter', 'filter' => 'trim'],
			['value', 'filter', 'filter' => 'trim'],
			['description', 'filter', 'filter' => 'trim'],
			
			['key', 'valiadateKey'],
			
		];
    }
	
	
	public function valiadateKey($attribute, $params){
		
		$key = $this->key;
		$id		= $this->id;
		if($id){
			$one = AdminConfig::find()->where([
				"key" =>$key,
				])
			->andWhere(
				" id != $id "
			)
			->one()
			;
			if($one['id']){
				
				$this->addError($attribute,"该条目已经存在[$key]");
			}
		}else{
			$one =  AdminConfig::find()->where([
				"key" =>$key,
				])
			
			->one()
			;
			if($one['id']){
				$this->addError($attribute,"该条目已经存在[$key]");
			
			}
		}
		
	}
	
	
	public function beforeSave($insert)  
    {  
          
        if (parent::beforeSave($insert)) {  
           
            if($insert == self::EVENT_BEFORE_INSERT){  
                $user = Yii::$app->user->identity;
				$account = $user['username'];
				$this->created_person = $account;
				$this->created_at = CDate::getCurrentDateTime();
			}else{  
                  
            }  
            $this->updated_at = CDate::getCurrentDateTime(); 
            
            return true;  
        } else {  
            return false;  
          
        }  
    } 
	
	

   
}
