<?php
namespace fecadmin\controllers;


use Yii;
use yii\helpers\Url;
use fecadmin\FecadminbaseController;
/**
 * Site controller
 */
class MyaccountController extends FecadminbaseController
{
	
   
	# ÎÒµÄÕË»§
    public function actionIndex()
    {
		$data = $this->getBlock()->getLastData();
		return $this->render($this->action->id,$data);
	}
	




	
	
}








