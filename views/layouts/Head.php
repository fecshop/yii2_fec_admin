<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecadmin\views\layouts;
use Yii;
use fec\helpers\CUrl;
class Head{
	


	public static function getJsAndCss(){
		//echo 1;exit;
		$css = [
			'fec_dwz_lib/themes/default/style.css',
			'fec_dwz_lib/themes/css/core.css',
			'fec_dwz_lib/themes/css/print.css',
			'fec_dwz_lib/uploadify/css/uploadify.css',
			
		];
		$js = [
			'fec_dwz_lib/js/jquery.cookie.js',
			'fec_dwz_lib/js/jquery.validate.js',
			'fec_dwz_lib/js/jquery.bgiframe.js',
			'fec_dwz_lib/xheditor/xheditor-1.2.2.min.js',
			'fec_dwz_lib/xheditor/xheditor_lang/zh-cn.js',
			'fec_dwz_lib/uploadify/scripts/jquery.uploadify.js',
		];
		return [
			'css' =>$css,
			'js' =>$js,
		];
		
	}
	
	
}












?>