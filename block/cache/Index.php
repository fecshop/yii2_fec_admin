<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecadmin\block\cache;
use fecadmin\FecadminbaseBlock;
use fecadmin\models\AdminUser;
use fecadmin\models\AdminLog;
use fec\helpers\CUrl;
use fec\helpers\CRequest;
use fec\helpers\CCache;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Index extends FecadminbaseBlock{
	public $_obj ;
	public $_paramKey = 'id';
	public $_defaultDirection = 'asc';
	public $_currentUrl;
	
	public function __construct(){
		
		
		$this->_currentUrl = CUrl::getUrl("fecadmin/cache/index");
		$this->_modelName = 'admin_user';
		parent::__construct();
	}
	
	
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
					'gte'=>'LOG时间开始',
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
	
	
	
	
	public function getEditBar(){
		if(!strstr($this->_currentParamUrl,"?")){
			$csvUrl = $this->_currentParamUrl."?type=export";
		}else{
			$csvUrl = $this->_currentParamUrl."&type=export";
		}

		return '<ul class="toolBar">
					<li><a title="确实要刷新?" target="selectedTodo" rel="ids" postType="string" href="'.$this->_currentUrl.'?method=reflush" class="edit"><span>刷新缓存</span></a></li>
					<li class="line">line</li>
				</ul>';
	}
	
	
	
	public function getTableThead(){
		return '
			<thead>
				<tr>
					<th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
					<th width="40">Cache名称</th>
					<th width="110">Cache描述</th>
				</tr>
			</thead>';
	}
	

	
	
	
	public function getTableTbody(){
		$str = '';
		$str .= '<tr target="sid_user" rel="'.$id.'">
					<td><input name="ids" value="all_cache" type="checkbox"></td>
					<td>所有缓存</td>
					<td>刷新所有的缓存</td>
				</tr>
				';
		return	$str;
	}

	public function reflush(){
		$cacheStr = CRequest::param("ids");
		$cacheArr = explode(",",$cacheStr);
		foreach($cacheArr as $cacheType){
			$cacheType = trim($cacheType);
			if($cacheType == all_cache){
				CCache::flushAll();
			}
		}
		# 刷新 配置 缓存
		\fecadmin\helpers\CConfig::flushCacheConfig();
		echo  json_encode(array(
						"statusCode"=>"200",
						"message"=>"reflush cache success",
		));
		exit;
		
	}
	
	
	
}






