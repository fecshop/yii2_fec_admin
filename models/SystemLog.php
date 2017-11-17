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
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class SystemLog extends ActiveRecord
{
    
    /**
     * @inheritdoc
     */
	# 设置table
    public static function tableName()
    {
        return '{{%system_log}}';
    }
	
	 /**
     * @inheritdoc
     */
	# 设置 status  默认  ，以及取值的区间
    public function rules()
    {
        return [
           
		];
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
