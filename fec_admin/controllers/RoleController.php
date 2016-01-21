<?php
namespace fecadmin\controllers;


use Yii;
use yii\helpers\Url;
use fecadmin\FecadminbaseController;
/**
 * Site controller
 */
class RoleController extends FecadminbaseController
{
	
   
	# 权限
    public function actionManager()
    {
		$data = $this->getBlock()->getLastData();
		return $this->render($this->action->id,$data);
	}
	
	# 权限
    public function actionManageredit()
    {
		$data = $this->getBlock()->getLastData();
		return $this->render($this->action->id,$data);
	}
	
	# 权限
    public function actionManagereditsave()
    {
		$this->getBlock("manageredit")->save();
		
	}
	
	# 权限
    public function actionManagerdelete()
    {
		$this->getBlock("manageredit")->delete();
		
	}
	

















	
	
}








