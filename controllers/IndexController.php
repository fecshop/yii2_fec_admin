<?php
namespace fecadmin\controllers;


use Yii;
use yii\helpers\Url;
use fecadmin\FecadminbaseController;
/**
 * Site controller
 */
class IndexController extends FecadminbaseController
{
	
  
    public function actionIndex()
    {
		//echo 1;exit;
		$this->layout = "main.php";
		return $this->render('index');
	}
	
	public function actionMenu()
    {
        echo 2;exit;
		
	}
}
