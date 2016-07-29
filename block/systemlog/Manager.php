<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecadmin\block\systemlog;
use fecadmin\FecadminbaseBlock;
use fecadmin\models\SystemLog;
use fec\helpers\CUrl;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Manager extends FecadminbaseBlock{
	public $_obj ;
	public $_paramKey = 'id';
	public $_defaultDirection = 'asc';
	
	# 初始化参数
	public function initParam(){
		# 定义编辑和删除的URL
		
		$this->_editUrl 	= CUrl::getUrl("fecadmin/systemLog/manageredit");
		$this->_deleteUrl 	= CUrl::getUrl("fecadmin/systemLog/managerdelete");
		$this->_obj	= new SystemLog;
		$this->_paramKey = 'id';
		/*  
		# 自定义参数如下：
		#排序默认为主键倒序
		$this->_orderField  = 'created_at';
		$this->_sortDirection = 'asc';
		
		# 主键默认为id
		$this->_paramKey = 'id';
		
		#第一次打开默认为第一页,一页显示50个
		$this->_pageNum = 1;
		$this->_numPerPage;
		
		*/
		parent::initParam();
		
	}
	
	public function getLastData(){
		# 返回数据的函数
		# 隐藏部分
		$pagerForm = $this->getPagerForm();  
		# 搜索部分
		$searchBar = $this->getSearchBar();
		# 编辑 删除  按钮部分
		$editBar = $this->getEditBar();
		# 表头部分
		$thead = $this->getTableThead();
		# 表内容部分
		$tbody = $this->getTableTbody();
		# 分页部分
		$toolBar = $this->getToolBar($this->_param['numCount'],$this->_param['pageNum'],$this->_param['numPerPage']); 
		
		return [
			'pagerForm'	 	=> $pagerForm,
			'searchBar'		=> $searchBar,
			'editBar'		=> $editBar,
			'thead'		=> $thead,
			'tbody'		=> $tbody,
			'toolBar'	=> $toolBar,
		];
	}
	
	
	 
	
	# 定义搜索部分字段格式
	public function getSearchArr(){
		
		$data = [
			
			
			[	# 字符串类型
				'type'=>'inputtext',
				'title'=>'类别',
				'name'=>'category' ,
				'columns_type' =>'string'
			],
			
			
			
		];
		return $data;
	}
	
	
	
	
	
	
	
	# 定义表格显示部分的配置
	public function getTableFieldArr(){
		$table_th_bar = [
			[	
				'orderField' 	=> 'id',
				'label'			=> 'ID',
				'width'			=> '10',
				'align' 		=> 'left',
				
			],
			[	
				'orderField'	=> 'level',
				'label'			=> 'level',
				'width'			=> '10',
				'align' 		=> 'left',
			],
			
			[	
				'orderField'	=> 'category',
				'label'			=> 'category',
				'width'			=> '30',
				'align' 		=> 'left',
			],
			[	
				'orderField'	=> 'log_time',
				'label'			=> 'log_time',
				'width'			=> '40',
				'align' 		=> 'left',
				'convert'		=> ['int' => 'datetime']
			],
			
			[	
				'orderField'	=> 'prefix',
				'label'			=> 'prefix',
				'width'			=> '40',
				'align' 		=> 'left',
			],
			
			
			[	
				'orderField'	=> 'message',
				'label'			=> 'message',
				'width'			=> '200',
				'align' 		=> 'left',
				
			],
			
			
			
		];
		return $table_th_bar ;
	}
	
	
	
	# table 表  标题  1
	public function getTableTheadHtml($table_th_bar){
		$table_th_bar = $this->getTableTheadArrInit($table_th_bar);
		$this->_param['orderField'] 	= $this->_param['orderField'] 		? $this->_param['orderField'] : $this->_paramKey;
		$this->_param['orderDirection'] = $this->_param['orderDirection'] 	? $this->_param['orderDirection'] :  $this->_defaultDirection;
		foreach($table_th_bar as $k => $field){
			if($field['orderField'] == $this->_param['orderField']){
				$table_th_bar[$k]['class'] = $this->_param['orderDirection'];
			}	
		}
		$str = '<thead><tr>';
		//$str .= '<th width="22"><input type="checkbox" group="'.$this->_paramKey.'s" class="checkboxCtrl"></th>';
		foreach($table_th_bar as $b){
			$width = $b['width'];
			$label = $b['label'];
			$orderField = $b['orderField'];
			$class = isset($b['class']) ? $b['class'] : '';
			$align = isset($b['align']) ? 'align="'.$b['align'].'"' : '';
			$str .= '<th width="'.$width.'" '.$align.' orderField="'.$orderField.'" class="'.$class.'">'.$label.'</th>';
		}
		
		$str .= '</tr></thead>';
		return $str;
	}
	
	
	# table 内容部分
	public function getTableTbodyHtml($data){
		$fileds = $this->getTableFieldArr();
		$str .= '';
		$csrfString = \fec\helpers\CRequest::getCsrfString();
		foreach($data as $one){
			$str .= '<tr target="sid_user" rel="'.$one[$this->_paramKey].'">';
		
			foreach($fileds as $field){
				$orderField = $field['orderField'];
				$display	= $field['display'];
				$val = $one[$orderField];
				if($val){
					if(isset($field['display']) && !empty($field['display'])){
						$display = $field['display'];
						
						$val = $display[$val] ? $display[$val] : $val;
					}
					if(isset($field['convert']) && !empty($field['convert'])){
						$convert = $field['convert'];
						foreach($convert as $origin =>$to){
							if(strstr($origin,'mongodate')){
								if(isset($val->sec)){
									$timestramp = $val->sec;
									if($to == 'date'){
										$val = date('Y-m-d',$timestramp);
									}else if($to == 'datetime'){
										$val = date('Y-m-d H:i:s',$timestramp);
									}else if($to == 'int'){
										$val = $timestramp;
									}
								}
							}else if(strstr($origin,'date')){
								if($to == 'date'){
									$val = date('Y-m-d',strtotime($val));
								}else if($to == 'datetime'){
									$val = date('Y-m-d H:i:s',strtotime($val));
								}else if($to == 'int'){
									$val = strtotime($val);
								}
							}else if($origin == 'int'){
								if($to == 'date'){
									$val = date('Y-m-d',$val);
								}else if($to == 'datetime'){
									$val = date('Y-m-d H:i:s',$val);
								}else if($to == 'int'){
									$val = $val;
								}
							}else if($origin == 'string'){
								if($to == 'img'){
									
									$t_width = isset($field['img_width']) ? $field['img_width'] : '100';
									$t_height = isset($field['img_height']) ? $field['img_height'] : '100';
									$val = '<img style="width:'.$t_width.'px;height:'.$t_height.'px" src="'.$val.'" />';;
								}
							}
						}
						
					}
				}
				$str .= '<td>'.$val.'</td>';
			}
			
		
			$str .= '</tr>';
		}
		return $str ;
		
	}
	
	
	
	
}