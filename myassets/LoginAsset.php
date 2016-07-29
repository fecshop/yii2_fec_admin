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
class LoginAsset extends AssetBundle
{
	//public $sourcePath = '@bower/fec_dwz_lib';
    public $basePath = '@webroot';
    public $baseUrl = '@web';
	public $css = [];
	 public $js = [];
   
	public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];
    public $depends = [
      
		'fecadmin\myassets\DwzLoginAsset',
    ];
}
