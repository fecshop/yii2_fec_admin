<?php
namespace fecadmin\controllers;


use Yii;
use yii\helpers\Url;
use fec\helpers\CUrl;
use fecadmin\FecadminbaseController;
/**
 * Site controller
 */
class LogController extends FecadminbaseController
{
	
   
	
	
	# LOG¹ÜÀí
    public function actionIndex()
    {
		
		$data = $this->getBlock()->getLastData();
		return $this->render($this->action->id,$data);
	}
	
	
	
}








