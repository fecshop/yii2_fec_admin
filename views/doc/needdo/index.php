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
		'title' 		=> '一：BLOCK Search配置',
		'description' 	=> 'block search 部分配置的说明',
		'content' 		=> [
			['配置项','详细说明'],
			['函数DEMO：','
	# 定义搜索部分字段格式<br/>
	public function getSearchArr(){<br/>
		
		&nbsp;&nbsp;$data = [<br/>
		
			&nbsp;&nbsp;&nbsp;&nbsp;[	# selecit的Int 类型<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	\'type\'=>\'select\',<br/>	 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	\'title\'=>\'状态\',<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	\'name\'=>\'status\',<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	\'columns_type\' =>\'int\',  # int使用标准匹配， string使用模糊查询<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	\'value\'=> ErpSyncStatus::getStatus(),<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;],<br/>
			
			
			&nbsp;&nbsp;&nbsp;&nbsp;[	# 时间区间类型搜索<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	\'type\'=>\'inputdatefilter\',<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	\'name\'=> \'sync_date\',<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	\'columns_type\' =>\'string\',<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	\'value\'=>[<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		\'get\'=>\'同步开始时间\',<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		\'lt\' =>\'同步结束时间\',<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;	]<br/>
			&nbsp;&nbsp;],<br/>
		&nbsp;&nbsp;];<br/>
		&nbsp;&nbsp;return $data;<br/>
		
	}<br/>
	'
			],
			['字段说明','
			type是显示的方式： select  inputtext   inputdate  inputdatefilter  inputfilter   filterselect<br/>
			&nbsp;&nbsp;	1.select 是下拉条<br/>
			&nbsp;&nbsp;	2.inputtext 是普通的输入框<br/>
			&nbsp;&nbsp;	3.inputdate 是填写时间的输入框<br/>
			&nbsp;&nbsp;	4.inputdatefilter 是开始和结束时间的两个输入框<br/>
			&nbsp;&nbsp;	5.inputfilter 是填写值的两个输入框<br/>
			&nbsp;&nbsp;	6.filterselect  后续扩展，先不介绍<br/>
				
			title ：显示的文字<br/>
			name ： 在数据库中的字段名<br/>
			columns_type：代表字段的类型，分为下面几种类型：<br/>
			&nbsp;&nbsp;		1.空值，代表字符串的完全匹配搜索<br/>
			&nbsp;&nbsp;		2.string(模糊) 字符串模糊搜索 <br/>
			&nbsp;&nbsp;		3.int 先做int类型转换，在做值的匹配查询<br/>
			&nbsp;&nbsp;		4.float 先做float类型转换，在做值的匹配查询 <br/> 
			&nbsp;&nbsp;		5.date  时间字符串的完全匹配查询。相当于空值。<br/>
			value ：是附加操作。<br/>		
			'],
			
			['详细组合1.select和inputtext','
				columns_type可用的值：<br/>
				1.string(模糊)<br/>
				2.int<br/>
				3.float<br/>
				4.date<br/>
				5.空值  代表字符串的完全匹配<br/>
			'],
			
			['详细组合2.inputdatefilter','
				columns_type可用的值：<br/>
				1.float,如果数据库中存放的时间为时间戳（float类型），那么需要使用float，
				前台传递的时间字符串会被改变成时间戳。
				<br/>
				2.空值，数据库如果存放的是时间类型，这里是空值<br/>
			'],
			
			['详细组合3.inputfilter','
				1.空值，代表的是字符串大小区间比较<br/>
				2.int，代表的是int类型大小区间比较<br/>
				3.float，代表的是float类型大小区间比较<br/>
				
			'],
		],
	];

	echo \fec\helpers\CDoc::tableformat($array); 
	
	
	
	
	?>
	<div style="clear:both"></div>
</div>