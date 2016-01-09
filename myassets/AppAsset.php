<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace fecadmin\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
	public $sourcePath = '@bower/fec_dwz_lib';
    public $basePath = '@webroot';
    public $baseUrl = '@web';
	public $css = [];
	 public $js = [];
    /*
	public $css = [
			'themes/default/style.css',
			'fec_dwz_lib/themes/css/core.css',
			'fec_dwz_lib/themes/css/print.css',
			'fec_dwz_lib/uploadify/css/uploadify.css',
    ];
    public $js = [
			'js/jquery.cookie.js',
			'fec_dwz_lib/js/jquery.validate.js',
			'fec_dwz_lib/js/jquery.bgiframe.js',
			'fec_dwz_lib/xheditor/xheditor-1.2.2.min.js',
			'fec_dwz_lib/xheditor/xheditor_lang/zh-cn.js',
			'fec_dwz_lib/uploadify/scripts/jquery.uploadify.js',
    ];
	
	*/
	public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];
    public $depends = [
      //  'yii\web\YiiAsset',
    //    'yii\bootstrap\BootstrapAsset',
	//	'yii\web\YiiAsset',
		'fecadmin\assets\DwzAsset',
		'fecadmin\assets\DwzIEAsset',
		'fecadmin\assets\DwzIE9Asset',
    ];
}
