<?php
namespace fecadmin\controllers;


use Yii;
use yii\helpers\Url;
use fec\helpers\CUrl;
use fecadmin\FecadminbaseController;
/**
 * Site controller
 */
class DocController extends FecadminbaseController
{
	
    public function actionMongoar()
    {
		
		return $this->render($this->action->id,[]);
	}
	
	
	
}








