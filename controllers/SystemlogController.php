<?php
namespace fecadmin\controllers;


use Yii;
use fec\helpers\CRequest;
use fecadmin\FecadminbaseController;
/**
 * Site controller
 */
class SystemlogController extends FecadminbaseController
{
	
   
	# 我的账户
    public function actionManager()
    {
		//echo $this->action->id ;exit;
		$data = $this->getBlock()->getLastData();
		return $this->render($this->action->id,$data);
	}
	
	
	
	
}








