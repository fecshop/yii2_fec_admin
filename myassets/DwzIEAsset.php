<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace fecadmin\myassets;
use yii\web\AssetBundle;
class DwzIEAsset extends AssetBundle
{
    public $sourcePath = '@fecadmin/myassets';
	
	
	public $cssOptions = ['condition' => 'if IE'];
	public $css = [
		'dwz_jui-master/themes/css/ieHack.css',
		
	];	
    
}
