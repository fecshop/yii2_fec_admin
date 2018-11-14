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
class DwzZhAsset extends AssetBundle
{
    public $sourcePath = '@fecadmin/myassets/dwz_jui-master';
	
	
	//public $cssOptions = ['condition' => 'lte IE9'];
	public $css = [
		'themes/default/style.css',
		'themes/css/core.css',
		'themes/css/print.css',
		'uploadify/css/uploadify.css',
		
	];	
	public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];
	
    public $js = [
        'js/jquery-2.1.4.min.js',
		'js/jquery.cookie.js',
		'js/jquery.validate.js',
		'js/jquery.bgiframe.js',
		'xheditor/xheditor-1.2.2.min.js',
		'xheditor/xheditor_lang/zh-cn.js',
		'uploadify/scripts/jquery.uploadify.js',
		'chart/raphael.js',
		'chart/g.raphael.js',
		'chart/g.bar.js',
		'chart/g.line.js',
		'chart/g.pie.js',
	
		'chart/g.dot.js',
		'js/dwz.core.js',
		'js/dwz.util.date.js',
		'js/dwz.validate.method.js',
		'js/dwz.barDrag.js',
		'js/dwz.drag.js',
		'js/dwz.tree.js',
		'js/dwz.accordion.js',
		'js/dwz.ui.js',
		'js/dwz.theme.js',
		'js/dwz.switchEnv.js',
		'js/dwz.alertMsg.js',
		'js/dwz.contextmenu.js',
		'js/dwz.navTab.js',
		'js/dwz.tab.js',
		'js/dwz.resize.js',
		'js/dwz.dialog.js',
		'js/dwz.dialogDrag.js',
		'js/dwz.sortDrag.js',
		'js/dwz.cssTable.js',
		'js/dwz.stable.js',
		
		'js/dwz.taskBar.js',
		'js/dwz.ajax.js',
		'js/dwz.pagination.js',
		'js/dwz.database.js',
		'js/dwz.datepicker.js',
		'js/dwz.effects.js',
		'js/dwz.panel.js',
		'js/dwz.checkbox.js',
		'js/dwz.history.js',
		'js/dwz.combox.js',
		'js/dwz.print.js',
		//'bin/dwz.min.js',
		'js/dwz.regional.zh.js',
		//'dwz.frag.xml',
		
    ];
    public $depends = [
        
    ];
}
