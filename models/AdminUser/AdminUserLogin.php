<?php
namespace fecadmin\models\AdminUser;
use fecadmin\models\AdminUser;
use yii\base\Model;
class AdminUserLogin extends Model{
	
	public $username;
	public $password;
	public $captcha;
	private $_admin_user;
	public function rules()
    {
        return [
            [['username', 'password','captcha'], 'required'],
			['password', 'validatePassword'],
            ['captcha', 'captcha','captchaAction'=>'/fecadmin/captcha/index'],
			
        ];
    }
	
	public function validatePassword($attribute,$params){
		
		if (!$this->hasErrors()) {
            $AdminUser = $this->getAdminUser();
            if (!$AdminUser || !$AdminUser->validatePassword($this->password)) {
                $this->addError($attribute, 'username:Username cannot be blank.');
            }
        }
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




