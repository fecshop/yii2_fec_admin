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
use fec\helpers\CUrl;
use fecadmin\FecadminbaseController;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class MenuController extends FecadminbaseController
{
	# 菜单管理
    public function actionManager()
    {
		//echo $this->action->id ;exit;
		$data = $this->getBlock()->getLastData();
		return $this->render($this->action->id,$data);
	}
	
	
	
	# 菜单管理
    public function actionEdit()
    {
		
		//echo $this->action->id ;exit;
		$this->getBlock("manager")->edit();
		
	}
	
	public function actionEditsave(){
		$this->getBlock("manager")->editMenuSave();
		
	}
	
	# 创建菜单
	public function actionCreate(){
		//$data = $this->getBlock()->getLastData();
		$editSaveUrl = CUrl::getUrl("fecadmin/menu/createsave");
		return $this->render($this->action->id,['editSaveUrl'=>$editSaveUrl]);
	}
	
	public function actionCreatesave(){
		$this->getBlock("manager")->createMenuSave();
		
	}
	
	

	public function actionDelete(){
		$this->getBlock("manager")->deleteMenu();
	}	


	
	
}








