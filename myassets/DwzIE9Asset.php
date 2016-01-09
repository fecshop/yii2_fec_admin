<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace fecadmin\assets;
use yii\web\AssetBundle;
class DwzIE9Asset extends AssetBundle
{
    public $sourcePath = '@fecadmin/assets';
	
	public $jsOptions = [ 
		'position' => \yii\web\View::POS_HEAD ,
		'condition' => 'lt IE 9'
	];
	
    public $js = [
        'dwz_jui-master/js/speedup.js',
		'dwz_jui-master/jquery-1.11.3.min.js',
		
    ];
    public $depends = [
        
    ];
}
