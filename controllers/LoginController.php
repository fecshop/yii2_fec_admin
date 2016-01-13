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
class LoginController extends Controller
{

    public function getViewPath()
    {
        
		return Yii::getAlias('@fecadmin/views') . DIRECTORY_SEPARATOR . $this->id;
    }

    public function actionIndex()
    {
		$isGuest = Yii::$app->user->isGuest;
		//echo $isGuest;exit;
		if(!$isGuest){
			$this->redirect("/",200);
		}	
		$errors = '';
		$loginParam = \fec\helpers\CRequest::param('login');
		if($loginParam){
			//echo 1;exit; 
			$AdminUserLogin = new AdminUserLogin;
			$AdminUserLogin->attributes = $loginParam;
			if($AdminUserLogin->login()){
				$this->redirect("/",200); 
			}else{
				$errors = CModel::getErrorStr($AdminUserLogin->errors);
			}
		}
		$this->layout = "login.php";	
		return $this->render('index',['error' => $errors]);
	}
	
	
	
	
}
