<?php
namespace fecadmin;
use fec\helpers\CRequest;
use fec\helpers\CUrl;
class FecadminbaseBlock{
	public $_param;
	
	# 默认值
	public $_pageNum = 1;
	public $_numPerPage = 50;
	
	# 主键  默认为id
	public $_paramKey = 'id';
	
	# 默认 排序字段 和 排序方式
	public $_sortDirection = 'desc';
	public $_orderField ;   # 如果不设置，会默认使用主键排序;
	
	# 各种url
	public $_currentParamUrl;
	public $_currentUrlKey;
	public $_addUrl;
	public $_editUrl;
	public $_deleteUrl;
	
	# 当前的数据对象
	public $_obj ;
	
	public function __construct(){
		
		$this->initParam();
	}
	# 初始化param
	public function initParam(){
		$param = \fec\helpers\CRequest::param();
		if(empty($param['pageNum']))  	$param['pageNum'] = $this->_pageNum ;
		if(empty($param['numPerPage'])) $param['numPerPage'] = $this->_numPerPage ;
		if(empty($param['orderField'])) $param['orderField'] = $this->_orderField ;
		if(empty($param['orderField'])) $param['orderField'] = $this->_paramKey ;
		if(empty($param['orderDirection'])) $param['orderDirection'] = $this->_sortDirection ;
		
		$this->_param = $param;
		
		$this->_currentUrl 		= CUrl::getCurrentUrlNoParam();
		$this->_currentParamUrl = CUrl::getCurrentUrl();
		$this->_addUrl = $this->_addUrl ? $this->_addUrl : $this->_currentUrl;
		$this->_editUrl = $this->_editUrl ? $this->_editUrl : $this->_currentUrl;
		$this->_deleteUrl = $this->_deleteUrl ? $this->_deleteUrl : $this->_currentUrl;
	}
	
	# 顶部隐藏域
	public function getPagerForm(){
		$str = "";
		if(is_array($this->_param) && !empty($this->_param)){
			foreach($this->_param as $k=>$v){
				if($k != "_csrf"){
					$str .='<input type="hidden" name="'.$k.'" value="'.$v.'">';
				}
			}
		}
		
		return $str;
	}
	
	
	
	
	
	
	# 表单  搜索部分html生成 1
	public function getSearchBarHtml($data){
		
		if(is_array($data) && !empty($data)){
			$r_data = [];
			foreach($data as $k=>$d){
				$type11 = $d['type'];
				if($type11 == 'select'){
					$value = $d['value'];
					$name = $d['name'];
					$value = $d['value'];
					$title = $d['title'];
					$d['value'] = $this->getSearchBarSelectHtml($name,$value,$title);
				}
				$r_data[$k] = $d;
			}
		}
		
		$searchBar = $this->getDbSearchBarHtml($r_data);
		return $searchBar;
	}
	
	
	# 表单  搜索部分html生成 2
	# select的name，option数据，option value为空的显示值，默认选中的值
	public function getSearchBarSelectHtml($name,$data,$null_value){
		if(is_array($data) && !empty($data)){
			$alibaba_account_select = '<select class="combox" name="'.$name.'">';
			$alibaba_account_select .= '<option value="">'.$null_value.'</option>';
			$selected = $this->_param[$name];
			if(is_array($selected) ){
				$selected = $selected['?regex'];
			}
			foreach($data as $k=>$v){
					//echo "$selected == $k";
					if($selected == $k){
						$alibaba_account_select .= '<option selected="selected" value="'.$k.'">'.$v.'</option>';
					}else{
						$alibaba_account_select .= '<option value="'.$k.'">'.$v.'</option>';
					}
			}
			$alibaba_account_select .= '</select>';
			return $alibaba_account_select;
		}else{
			return '';
		}
	}
	
	
	# 表单  搜索部分html生成 3
	public function getDbSearchBarHtml($data){
		$searchBar = '<input type="hidden" name="search_type" value="search"  />';	
		$searchBar .='<table class="searchContent">
					<tr>';
		foreach($data as $d){
			$type = $d['type'];
			$name = $d['name'];
			$title = $d['title'];
			$value = $d['value'];
			if($d['type'] == 'select'){
				$searchBar .=	'<td>
									'.$value.'
								</td>';
			}else if($d['type'] == 'inputtext'){
				$searchBar .=	'<td>
									'.$title.'<input type="text" value="'.(is_array($this->_param[$name]) ? $this->_param[$name]['?regex'] : $this->_param[$name]).'" name="'.$name.'" />
								</td>';
			}else if($d['type'] == 'inputdate'){
				$searchBar .=	'<td>
									'.$title.'<input type="text" value="'.$this->_param[$name].'" name="'.$name.'"  class="date" readonly="true" />
								</td>';
			}else if($d['type'] == 'inputdatefilter'){
				$value = $d['value'];
				if(is_array($value)){
					foreach($value as $t=>$title){
						$searchBar .=	'<td>
							'.$title.'<input type="text" value="'.$this->_param[$name.'_'.$t].'" name="'.$name.'_'.$t.'"  class="date" readonly="true" />
						</td>';
					}
				}
			}
		}
			
		$searchBar .=	'</tr>
			</table>
			<div class="subBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div></li>
					<li><a class="button" href="#" target="dialog" mask="true" title="查询框"><span>高级检索</span></a></li>
				</ul>
			</div>';
			
		return $searchBar;	
	}
	
	
	# 搜索部分
	public function getSearchBar(){
		$data = $this->getSearchArr();
		return $this->getSearchBarHtml($data);
	}
	
	# 搜索 生成where
	public function initDateWhere(&$query,$searchArr){
		foreach($searchArr as $field){
			$type = $field['type'];
			$name = $field['name'];
			$columns_type = $field['columns_type'];
			if($this->_param[$name] || $this->_param[$name.'_get'] || $this->_param[$name.'_lt']){
				if($type == 'inputtext' || $type == 'select'){
					if($columns_type == 'string'){
						
						if($query->where){
							$query->andWhere(['like', $name, $this->_param[$name]]);
						}else{
							$query->where(['like', $name, $this->_param[$name]]);
							//echo $name.$this->_param[$name];exit;
						}
					}else{
						if($query->where){
							$query->andWhere([$name => $this->_param[$name]]);
						}else{
							$query->where([$name => $this->_param[$name]]);
						}
						
					}
				}else if($type == 'inputdatefilter'){
					if($query->where){
						$query->andWhere(['>', $name, $this->_param[$name.'_get']]);
					}else{
						$query->where(['>', $name, $this->_param[$name.'_get']]);
					}
					
					if($query->where){
						$query->andWhere(['<', $name, $this->_param[$name.'_lt']]);
					}else{
						$query->where(['<', $name, $this->_param[$name.'_lt']]);
					}
					
					//$where[] = where(['>', $name, $this->_param[$name.'_get']]);
					//$where[] = where(['<', $name, $this->_param[$name.'_lt']]);
				}
			}
		}
		// var_dump($query->where);exit;
	}
	
	
	
	
	# 编辑部分
	public function getEditBar(){
		if(!strstr($this->_currentParamUrl,"?")){
			$csvUrl = $this->_currentParamUrl."?type=export";
		}else{
			$csvUrl = $this->_currentParamUrl."&type=export";
		}


		return '<ul class="toolBar">
					<li><a class="add"   href="'.$this->_editUrl.'"  target="dialog" height="580" width="1000" drawable="true" mask="true"><span>添加</span></a></li>

					<li><a target="dialog" height="580" width="1000" drawable="true" mask="true" class="edit" href="'.$this->_editUrl.'?'.$this->_paramKey.'={sid_user}" ><span>修改</span></a></li>
					<li><a title="确实要删除这些记录吗?" target="selectedTodo" rel="ids" postType="string" href="'.$this->_deleteUrl.'" class="delete"><span>批量删除</span></a></li>
					<li class="line">line</li>
					<li><a class="icon csvdownload"   href="'.$csvUrl.'" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>
				</ul>';
	
	
	}
	
	
	public function getToolBar($numCount,$pageNum,$numPerPage){
		
		
		return 	'<div class="pages">
					<span>显示</span>
					<select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
						<option '.($numPerPage == 2 ? 'selected': '' ).' value="2">2</option>
						<option '.($numPerPage == 6 ? 'selected': '' ).' value="6">6</option>
						<option '.($numPerPage == 20 ? 'selected': '' ).' value="20">20</option>
						<option '.($numPerPage == 50 ? 'selected': '' ).'  value="50">50</option>
						<option '.($numPerPage == 100 ? 'selected': '' ).'  value="100">100</option>
						<option '.($numPerPage == 200 ? 'selected': '' ).'  value="200">200</option>
					</select>
					<span>条，共'.$numCount.'条</span>
				</div>
				<div class="pagination" targetType="navTab" totalCount="'.$numCount.'" numPerPage="'.$numPerPage.'" pageNumShown="10" currentPage="'.$pageNum.'"></div>
				';
	}
	
	
	
	# 得到表格的头部
	public function getTableThead(){
		$table_th_bar = $this->getTableFieldArr();
		return $this->getTableTheadHtml($table_th_bar);
		
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
		$str .= '<th width="80" >编辑</th>';
		$str .= '</tr></thead>';
		return $str;
	}
	# table 表  标题  2
	public function getTableTheadArrInit($table_columns){
		
		foreach($table_columns as $field){
			$d = [
				'orderField' 	=> $field['orderField'],
			//	'label'			=> $this->_obj->getAttributeLabel($field['orderField'])	,
				'width'			=> $field['width'],
				'align' 		=> $field['align'],
			];
			$d['label'] = $field['label'] ? $field['label'] : '';
			if(empty($d['label'] )){
				if($this->_obj){
					$d['label'] = $this->_obj->getAttributeLabel($field['orderField'])	;
				}else{
					$d['label'] = $field['orderField'];
				}
			}
			$table_th_bar[] = $d;
		}
		return $table_th_bar;
	
	}
	
	
	
	
	
	# 得到表格的内容部分 
	public function getTableTbody(){
		$obj = $this->_obj;
		$searchArr = $this->getSearchArr();
		$query = $obj::find();
		if(is_array($searchArr) && !empty($searchArr)){
			$this->initDateWhere($query,$searchArr);
		}
		$this->_param['numCount'] = $query->count();
		$query->limit = $this->_param['numPerPage'];
		# 偏离值
		$query->offset = ($this->_param['pageNum'] -1)*$this->_param['numPerPage'] ;
		$query->orderBy([$this->_param['orderField']=> (($this->_param['orderDirection'] == 'desc') ? SORT_DESC : SORT_ASC)]);
		$data = $query->all();
		return $this->getTableTbodyHtml($data);
		
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
			
			$str .= '<td>
						
						<a title="编辑" target="dialog" class="btnEdit" mask="true" drawable="true" width="1000" height="580" href="'.$this->_editUrl.'?'.$this->_paramKey.'='.$one[$this->_paramKey].'" >编辑</a>
						<a title="删除" target="ajaxTodo" href="'.$this->_deleteUrl.'?'.$csrfString.'&'.$this->_paramKey.'='.$one[$this->_paramKey].'" class="btnDel">删除</a>
					</td>';
			$str .= '</tr>';
		}
		return $str ;
		
	}
	
	
	
	
}