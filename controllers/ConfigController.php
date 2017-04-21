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
use fec\helpers\CRequest;
use fecadmin\FecadminbaseController;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class ConfigController extends FecadminbaseController
{
	
   
	# 鎴戠殑璐︽埛
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








