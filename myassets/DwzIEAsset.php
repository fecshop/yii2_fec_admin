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
class DwzIEAsset extends AssetBundle
{
    public $sourcePath = '@fecadmin/myassets';
	
	
	public $cssOptions = ['condition' => 'if IE'];
	public $css = [
		'dwz_jui-master/themes/css/ieHack.css',
		
	];	
    
}
