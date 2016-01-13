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
