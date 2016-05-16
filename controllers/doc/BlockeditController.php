<?php
namespace fecadmin\controllers\doc;


use Yii;
use yii\helpers\Url;
use fec\helpers\CUrl;
use fecadmin\FecadminbaseController;
/**
 * Site controller
 */
class BlockeditController extends FecadminbaseController
{
	
    public function actionIndex()
    {
		//echo 1;exit;
		return $this->render($this->action->id,[]);
	}
	
	
	
}








