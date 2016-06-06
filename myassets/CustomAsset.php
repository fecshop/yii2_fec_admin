<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace fecadmin\myassets;
use yii\web\AssetBundle;
class CustomAsset extends AssetBundle
{
    public $sourcePath = '@fecadmin/myassets';
	
	
	//public $cssOptions = ['condition' => 'lte IE9'];
	public $css = [
		'custom/css/style.css',
	];	
	public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];
	
    public $js = [
		'custom/js/js.js',
    ];
    public $depends = [
        
    ];
}
