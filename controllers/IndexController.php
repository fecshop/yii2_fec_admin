<?php
namespace fecadmin\controllers;


use Yii;
use yii\helpers\Url;
use yii\web\Controller;
/**
 * Site controller
 */
class IndexController extends Controller
{

    public function getViewPath()
    {
        
		return Yii::getAlias('@fecadmin/views') . DIRECTORY_SEPARATOR . $this->id;
    }

    public function actionIndex()
    {
       // echo 1;exit;
	  // $this->layout = Yii::getAlias('@fecadmin/views')."/layouts/main.php";
		return $this->render('index');
	}
	public function actionMenu()
    {
        echo 2;exit;
		
	}
}
