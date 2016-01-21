<?php
namespace fecadmin\block\log;
use fecadmin\FecadminbaseBlock;
use fecadmin\models\AdminUser;
use fecadmin\models\AdminLog;
use fec\helpers\CUrl;
class Index extends FecadminbaseBlock{
	public $_obj ;
	public $_paramKey = 'id';
	public $_defaultDirection = 'asc';
	
	# 初始化参数
	public function initParam(){
		# 定义编辑和删除的URL
		
		$this->_editUrl 	= ''; #CUrl::getUrl("fecadmin/log/indexedit");
		$this->_deleteUrl 	= '';	#CUrl::getUrl("fecadmin/account/indexdelete");
		$this->_obj	= new AdminLog;
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
				'title'=>'账号',
				'name'=>'account' ,
				'columns_type' =>'string'
			],
			[	# 时间区间类型搜索
				'type'=>'inputdatefilter',
				'name'=> 'created_at',
				'columns_type' =>'datetime',
				'value'=>[
					'get'=>'LOG时间开始',
					'lt' =>'LOG时间结束',
				]
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
				'width'			=> '110',
				'align' 		=> 'center',
				
			],
			[	
				'orderField'	=> 'account',
				'label'			=> '账号',
				'width'			=> '110',
				'align' 		=> 'center',
			],
			[	
				'orderField'	=> 'person',
				'label'			=> '操作人',
				'width'			=> '110',
				'align' 		=> 'left',
				
			],
			
			[	
				'orderField'	=> 'url',
				'label'			=> '操作菜单',
				'width'			=> '110',
				'align' 		=> 'left',
				
			],
			
			
			
			[	
				'orderField'	=> 'created_at',
				'label'			=> '创建时间',
				'width'			=> '190',
				'align' 		=> 'center',
				//'convert'		=> ['datetime' =>'date'],   # int  date datetime  显示的转换
			],
			
			
			
		];
		return $table_th_bar ;
	}
	
	
	
	# table 内容部分
	public function getTableTbodyHtml($data){
		$fileds = $this->getTableFieldArr();
		$str .= '';
		$csrfString = \fec\helpers\CRequest::getCsrfString();
		foreach($data as $one){
			$str .= '<tr target="sid_user" rel="'.$one[$this->_paramKey].'">';
			$str .= '<td><input name="'.$this->_paramKey.'s" value="'.$one[$this->_paramKey].'" type="checkbox"></td>';
			
			
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
							if(strstr($origin,'date')){
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
		$str .= '<th width="22"><input type="checkbox" group="'.$this->_paramKey.'s" class="checkboxCtrl"></th>';
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
	
	
	
	
}