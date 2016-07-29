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
		'title' 		=> '一：Mongodb Active Record配置',
		'description' 	=> '',
		'content' 		=> [
			['配置项','详细说明'],
			['Mongodb：','
				Mongodb active record的定义：<br/>
				use common\extensions\mongodb\IActiveRecord;<br/>
				class ErpOrderList extends IActiveRecord  <br/>
				{  <br/>
					# 定义db<br/>
					public static function getDb()<br/>
					{<br/>
						return \Yii::$app->get(\'mongodb_erp\');<br/>
					}<br/>
					
					 # 定义collection name  <br/>
					public static function collectionName()<br/>  
					{  <br/>
						return \'erp_order_list\';  <br/>
					}  <br/>
					
					# 定义collection 各个字段的类型定义，在保存前进行类型转换<br/>  
					public function schema_columns(){  <br/>
						# 不要定义  _id  <br/>
						return [ <br/>
							# id<br/>
							\'_id\'       		=> \'String\',<br/>
							# sku<br/>
							\'sku\'       		=> \'String\',<br/>
							#数量 <br/>
							\'qty\'    			=> \'Int\',<br/>
							
							#单个SKU对应的毛收入	<br/>		
							\'gross_default\'    	=> \'Float\',<br/>
							
							# 单个SKU对应的毛利润 <br/>
							\'profit\'    		=> \'Float\',<br/>
							#成本<br/>
							\'product_cost\'      => \'Float\',<br/>
							#发货确认时间<br/>
							\'ship_confirm_date\' => \'datetime\', <br/> 
							# 更新时间<br/>
							\'updated_at\'   		=> \'datetime\',<br/> 
							\'created_at\'   		=> \'datetime\', <br/>
						];   <br/>
					}  <br/>
	
				}<br/>
				
			'
			],
			['字段说明','
			Int，String，Float，Datetime<br/>
			详细demo参看common\models\erp\ErpOrderList;<br/>
			'],
			
			
		],
	];

	echo \fec\helpers\CDoc::tableformat($array); 
	
	
	
	
	?>
	<div style="clear:both"></div>
</div>