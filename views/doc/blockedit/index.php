<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
?>

<div style="margin:10px;">
<br/>
	<?php
	
	$array = [
		'title' 		=> '一：Table Edit的配置',
		'description' 	=> '对于数据的编辑，需要做的事情',
		'content' 		=> [
			['配置项','详细说明'],
			['函数DEMO：','
					[<br/>
				\'label\'=>\'Ebay Site\',<br/>
				\'name\'=>\'ebaystore\',<br/>
				\'display\'=>[<br/>
					\'type\' => \'inputString\',<br/>
				],<br/>
				\'require\' => 1,<br/>
			],<br/>
		
	<br/>
	'
			],
			
			['label','显示的label'],
			['name','数据库中的字段名称'],
			['display','显示的方式，有下面几种方式：
				[
					\'type\' => \' 类型 \' ,
					\'data\' => \' 数据\',
				]
				type的值有：
					1.inputString  	字符串的input
					2.inputDate    	时间格式的input
					3.inputEmail   	email格式的input
					4.inputPassword	密码格式的input
					5.select       	下拉条格式的select
				data 只有在select的情况下有效
					里面存放的数组。用于生成select。
			
			'],
			['require',''],
			
			
		],
	];

	echo \fec\helpers\CDoc::tableformat($array); 
	
	
	
	
	?>
	<div style="clear:both"></div>
</div>