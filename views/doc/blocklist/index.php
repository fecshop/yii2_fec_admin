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
		'title' 		=> '一：Table 列表显示的配置',
		'description' 	=> '从数据库取出来的字段值，需要进行一系列的数据的转换，譬如图片地址，显示出来图片，时间信息，显示固定格式，状态数字显示出来对应的label，等等',
		'content' 		=> [
			['配置项','详细说明'],
			['函数DEMO：','
	# 定义表格显示部分的配置
	public function getTableFieldArr(){ <br/>
		$table_th_bar = [<br/>
			
            [	<br/>
				\'orderField\' 	=> \'id\',<br/>
				\'label\'			=> \'itemId\',<br/>
				\'width\'			=> \'40\',<br/>
				\'align\' 		=> \'center\',	<br/>			
			],<br/>
                
		    [	<br/>
				\'orderField\'	=> \'img\',<br/>
				\'label\'			=> \'图片\',<br/>
				\'width\'			=> \'80\',<br/>
				\'align\' 		=> \'left\',<br/>
				\'convert\'		=> [\'string\' => \'img\'],<br/>
				\'img_width\'		=> \'100\',<br/>
				\'img_height\'	=> \'100\',	<br/>						
			],<br/>
			
	<br/>
	'
			],
			
			['orderField','数据库中的字段'],
			['label','列的label名称'],
			['width','在表格中显示的宽度'],
			
			
			
			['align','在table中显示位置，可选值：left  right center  
			'],
			
			['display','  # 显示转换  ，譬如 值为1显示为激活，值为10显示为关闭<br/>
				[  <br/>     
					\'1\'		=> \'普通\',<br/>
					\'2\'		=> \'高级\',<br/>
				],<br/>
				也就是说 将数据库取出来的值，去数组中查找是否
				有这个key存在，如果存在，返回对应的value
			'],
			
			['convert','格式转换 ：[\'string\' => \'img\']
				<br/>
				1. mongodate（这个是mongodb中取出来的标准的js时间格式） =>  date | datetime | int (分别为年月日格式，年月日时分秒格式，时间戳格式)<br/>
				2. date      =>  date | datetime | int (分别为年月日格式，年月日时分秒格式，时间戳格式)<br/>
				3. int		 =>  date | datetime | int (分别为年月日格式，年月日时分秒格式，时间戳格式)<br/>
				4. string    =>  img   img url地址将会显示成html img ，显示出来图片<br/>
				<br/>
			'],
			
			['img_width','填写数字，
				当\'convert\'为 [\'string\' => \'img\'] 的时候
				图片的宽度
			'],
			['img_height','填写数字，
				当\'convert\'为 [\'string\' => \'img\'] 的时候有效，
				图片的高度
			'],
			
			
			
		],
	];

	echo \fec\helpers\CDoc::tableformat($array); 
	
	
	
	
	?>
	<div style="clear:both"></div>
</div>