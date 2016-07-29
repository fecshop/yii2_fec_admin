<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecadmin\block\account;
use fec\helpers\CUrl;
use fec\helpers\CRequest;
use fec\helpers\CModel;
use fecadmin\models\AdminUser\AdminUserResetPassword;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Index{
	public function getLastData(){
		$updatepass = CRequest::param("updatepass");
		if($updatepass){
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
		$editUrl = CUrl::getUrl("fecadmin/account/index");
		return [
			'current_account' => $current_account,
			'editUrl'			=> $editUrl,
		];
	}
	
}