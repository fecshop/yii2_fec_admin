<?php
namespace fecadmin;
use Yii;
use yii\helpers\Url;
use fec\controllers\FecController;
/**
 * fec admin 模块的controller配置
 */
class FecadminbaseController extends FecController
{
    public function getViewPath()
    {
		return Yii::getAlias('@fecadmin/views') . DIRECTORY_SEPARATOR . $this->id;
    }
	public function __construct($id, $module, $config = []){
		$isGuest = Yii::$app->user->isGuest;
		//echo $isGuest;exit;
		if($isGuest){
			$this->redirect("/fecadmin/login/index",200);
		}
		parent::__construct($id, $module, $config);
	}
	
	
}
