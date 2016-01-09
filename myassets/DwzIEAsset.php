<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace fecadmin\assets;
use yii\web\AssetBundle;
class DwzIEAsset extends AssetBundle
{
    public $sourcePath = '@fecadmin/assets';
	
	
	public $cssOptions = ['condition' => 'if IE'];
	public $css = [
		'dwz_jui-master/themes/css/ieHack.css',
		
	];	
    
}
