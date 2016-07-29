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
class DwzAsset extends AssetBundle
{
    public $sourcePath = '@fecadmin/myassets';
	
	
	//public $cssOptions = ['condition' => 'lte IE9'];
	public $css = [
		'dwz_jui-master/themes/default/style.css',
		'dwz_jui-master/themes/css/core.css',
		'dwz_jui-master/themes/css/print.css',
		'dwz_jui-master/uploadify/css/uploadify.css',
		
	];	
	public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];
	
    public $js = [
        'dwz_jui-master/js/jquery-2.1.4.min.js',
		'dwz_jui-master/js/jquery.cookie.js',
		'dwz_jui-master/js/jquery.validate.js',
		'dwz_jui-master/js/jquery.bgiframe.js',
		'dwz_jui-master/xheditor/xheditor-1.2.2.min.js',
		'dwz_jui-master/xheditor/xheditor_lang/zh-cn.js',
		'dwz_jui-master/uploadify/scripts/jquery.uploadify.js',
		'dwz_jui-master/chart/raphael.js',
		'dwz_jui-master/chart/g.raphael.js',
		'dwz_jui-master/chart/g.bar.js',
		'dwz_jui-master/chart/g.line.js',
		'dwz_jui-master/chart/g.pie.js',
	
		'dwz_jui-master/chart/g.dot.js',
		'dwz_jui-master/js/dwz.core.js',
		'dwz_jui-master/js/dwz.util.date.js',
		'dwz_jui-master/js/dwz.validate.method.js',
		'dwz_jui-master/js/dwz.barDrag.js',
		'dwz_jui-master/js/dwz.drag.js',
		'dwz_jui-master/js/dwz.tree.js',
		'dwz_jui-master/js/dwz.accordion.js',
		'dwz_jui-master/js/dwz.ui.js',
		'dwz_jui-master/js/dwz.theme.js',
		'dwz_jui-master/js/dwz.switchEnv.js',
		'dwz_jui-master/js/dwz.alertMsg.js',
		'dwz_jui-master/js/dwz.contextmenu.js',
		'dwz_jui-master/js/dwz.navTab.js',
		'dwz_jui-master/js/dwz.tab.js',
		'dwz_jui-master/js/dwz.resize.js',
		'dwz_jui-master/js/dwz.dialog.js',
		'dwz_jui-master/js/dwz.dialogDrag.js',
		'dwz_jui-master/js/dwz.sortDrag.js',
		'dwz_jui-master/js/dwz.cssTable.js',
		'dwz_jui-master/js/dwz.stable.js',
		
		'dwz_jui-master/js/dwz.taskBar.js',
		'dwz_jui-master/js/dwz.ajax.js',
		'dwz_jui-master/js/dwz.pagination.js',
		'dwz_jui-master/js/dwz.database.js',
		'dwz_jui-master/js/dwz.datepicker.js',
		'dwz_jui-master/js/dwz.effects.js',
		'dwz_jui-master/js/dwz.panel.js',
		'dwz_jui-master/js/dwz.checkbox.js',
		'dwz_jui-master/js/dwz.history.js',
		'dwz_jui-master/js/dwz.combox.js',
		'dwz_jui-master/js/dwz.print.js',
		//'dwz_jui-master/bin/dwz.min.js',
		'dwz_jui-master/js/dwz.regional.zh.js',
		//'dwz_jui-master/dwz.frag.xml',
		
    ];
    public $depends = [
        
    ];
}
