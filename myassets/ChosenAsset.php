<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace fecadmin\myassets;
use yii\web\AssetBundle;
class ChosenAsset extends AssetBundle
{
    public $sourcePath = '@fecadmin/myassets';
	
	
	//public $cssOptions = ['condition' => 'lte IE9'];
	public $css = [
		 
		'chosen/chosen.css',
	];	
	public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];
	
    public $js = [
		'chosen/chosen.jquery.min.js',
    ];
    public $depends = [
        
    ];
}
