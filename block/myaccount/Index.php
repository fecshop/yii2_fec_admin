<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecadmin\block\myaccount;
use fec\helpers\CUrl;
use fec\helpers\CRequest;
use fec\helpers\CModel;
use fec\helpers\CConfig;
use fecadmin\models\AdminUser\AdminUserResetPassword;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Index{
	
	
	
	public function getLastData(){
		$updatepass = CRequest::param("updatepass");
		if($updatepass){
			if(\Yii::$app->user->identity->username == "admin"){
				#如果是demo，则不允许修改密码。
				if(CConfig::param("is_demo")){
					echo  json_encode(["statusCode"=>"300",
						"message" => "demo是为了让大家看，admin账户不允许修改密码，请自己添加账户",
					]);
					exit;
				}
			}
			$AdminUserResetPassword = new AdminUserResetPassword;
			$AdminUserResetPassword->attributes = $updatepass;
			if($AdminUserResetPassword->validate()){
				$AdminUserResetPassword->updatePassword();
				echo  json_encode(["statusCode"=>"200",
					"message" => 'Update Password Success',
				]);
			}else{
				$errors = $AdminUserResetPassword->errors;
				echo  json_encode(["statusCode"=>"300",
					"message" => CModel::getErrorStr($errors),
				]);
			}
			exit;
		}
		$adminUser = \Yii::$app->user->identity;
		$current_account = $adminUser->username;
		$editUrl = CUrl::getUrl("fecadmin/myaccount/index");
		return [
			'current_account' => $current_account,
			'editUrl'			=> $editUrl,
		];
	}
	
}