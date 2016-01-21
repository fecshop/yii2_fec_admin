<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace fecadmin\myassets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DwzLoginAsset extends AssetBundle
{
	public $sourcePath = '@fecadmin/myassets';
   
	public $js = [];
   
	
	
	//public $cssOptions = ['condition' => 'lte IE9'];
	public $css = [
		'dwz_jui-master/themes/css/login.css',
		
		
	];	
	
	
	public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];
    public $depends = [
     
    ];
}
