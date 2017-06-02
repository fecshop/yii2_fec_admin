<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecadmin\myassets;
use yii\web\AssetBundle;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class DwzIE9Asset extends AssetBundle
{
    public $sourcePath = '@fecadmin/myassets/dwz_jui-master';
	//public $cssOptions = ['condition' => 'lte IE9'];
	public $jsOptions = [ 
		'position' => \yii\web\View::POS_HEAD ,
		'condition' => 'lt IE 9'
	];
	
    public $js = [
        'js/speedup.js',
		'jquery-1.11.3.min.js',
		
    ];
    public $depends = [
        
    ];
}
