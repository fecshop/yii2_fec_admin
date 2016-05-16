<?php
namespace fecadmin\controllers;


use Yii;
use yii\helpers\Url;
use fecadmin\FecadminbaseController;
use fec\controllers\FecController;
/**
 * Site controller
 */
class TestController extends FecController
{
	
  
    public function actionIndex()
    {
		//echo 1;exit;
		//$this->layout = "dashboard.php";
		return $this->render('index');
	}
	
	
}
