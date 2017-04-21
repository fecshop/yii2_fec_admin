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
use fecadmin\FecadminbaseController;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
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








