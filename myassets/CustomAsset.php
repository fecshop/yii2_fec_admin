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
class CustomAsset extends AssetBundle
{
    public $sourcePath = '@fecadmin/myassets/custom';
	
	
	//public $cssOptions = ['condition' => 'lte IE9'];
	public $css = [
		'css/style.css',
	];	
	public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];
	
    public $js = [
		'js/js.js',
    ];
    public $depends = [
        
    ];
}
