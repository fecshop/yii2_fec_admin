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
use fec\controllers\FecController;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class TestController extends FecController
{
    public function actionIndex()
    {
		//echo 1;exit;
		//$this->layout = "dashboard.php";
		return $this->render('index');
	}
	
	
}
