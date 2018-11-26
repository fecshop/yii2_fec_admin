<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecadmin\controllers;
use Yii;
use yii\helpers\Url;
use fec\helpers\CModel;
use yii\web\Controller;
use fecadmin\models\AdminUser\AdminUserLogin;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
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
        \fecadmin\helpers\CSystemlog::saveSystemLog();
        Yii::$app->getResponse()->redirect("/fecadmin/login/index")->send();   
        //$this->redirect("/fecadmin/login/index",200)->send();
    }
}
