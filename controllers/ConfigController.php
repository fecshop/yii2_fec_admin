<?php
namespace fecadmin\controllers;


use Yii;
use fec\helpers\CRequest;
use fecadmin\FecadminbaseController;
/**
 * Site controller
 */
class ConfigController extends FecadminbaseController
{
	
   
	# ÎÒµÄÕË»§
    public function actionManager()
    {
		//echo $this->action->id ;exit;
		$data = $this->getBlock()->getLastData();
		return $this->render($this->action->id,$data);
	}
	
	
	public function actionManageredit()
    {
		//echo $this->action->id ;exit;
		$data = $this->getBlock()->getLastData();
		return $this->render($this->action->id,$data);
	}
	
	public function actionManagereditsave()
    {
		
		//echo $this->action->id ;exit;
		$data = $this->getBlock("manageredit")->save();
		//return $this->render($this->action->id,$data);
	}
	
	public function actionManagerdelete()
    {
		//echo $this->action->id ;exit;
		$this->getBlock("manageredit")->delete();
		
	}
	
}








