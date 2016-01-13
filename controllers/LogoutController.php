<?php
namespace fecadmin\controllers;


use Yii;
use yii\helpers\Url;
use fec\helpers\CModel;
use yii\web\Controller;
use fecadmin\models\AdminUser\AdminUserLogin;
/**
 * Site controller
 */
class LogoutController extends Controller
{

   

    public function actionIndex()
    {
		$isGuest = Yii::$app->user->isGuest;
		//echo $isGuest;exit;
		if($isGuest){
			
		}else{
			Yii::$app->user->logout();
		}	
		$this->redirect("/fecadmin/login",200);
	}
	
	
	
	
}
