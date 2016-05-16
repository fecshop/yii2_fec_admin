<?php
namespace fecadmin\controllers\doc;


use Yii;
use yii\helpers\Url;
use fec\helpers\CUrl;
use fecadmin\FecadminbaseController;
/**
 * Site controller
 */
class BlocklistController extends FecadminbaseController
{
	
    public function actionIndex()
    {
		
		return $this->render($this->action->id,[]);
	}
	
	
	
}








