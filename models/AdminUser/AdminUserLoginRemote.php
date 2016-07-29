<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecadmin\models\AdminUser;
use fecadmin\models\AdminUser;
use yii\base\Model;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class AdminUserLoginRemote extends Model{
	
	public $username;
	public $password;
	public $captcha;
	private $_admin_user;
	public function rules()
    {
        return [
            ['username', 'required'],
			
        ];
    }
	
	
	
	public function getAdminUser(){
		if($this->_admin_user === null){
			$this->_admin_user = AdminUser::findByUsername($this->username);
		}
		return $this->_admin_user;
		
	}
	
	public function login()
    {
        if ($this->validate()) {
            //return \Yii::$app->user->login($this->getAdminUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
			return \Yii::$app->user->login($this->getAdminUser(), 3600 * 24);
        } else {
            return false;
        }
    }
}




