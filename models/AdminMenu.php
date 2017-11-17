<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecadmin\models;
use Yii;
use yii\db\ActiveRecord;
use fec\helpers\CUrl;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class AdminMenu extends ActiveRecord
{
    private $_admin_menu;
	private $_admin_menu_tree_arr;
	public  $_ajaxMenuEditUrl;
	private $_active_menu_ids;
	
	
    public static function tableName()
    {
        return '{{%admin_menu}}';
    }
	
	public function rules()
    {
		$current_rules = [
			[['name', 'parent_id','url_key',], 'required'],
			['sort_order','validateSortOrder'],
		];
		return $current_rules;
    }
	
	public function validateSortOrder($attribute,$params){
		if($order = $this->sort_order){
			if(!is_numeric($order)){
				$this->addError($attribute,"sort_order must be numeric");
			}
		}
	}
	
	
	public function getAdminMenu(){
		if($this->_admin_menu === null ){
			$this->_admin_menu = new self;
		}
		return $this->_admin_menu;
	}
	
	
	
	public function getActiveMenuIds(){
		if($this->_active_menu_ids === null){
			$user = Yii::$app->user->identity;
			$user_id = $user['id'];
			$roles = AdminUserRole::find()->asArray()->where([
				'user_id' => $user_id
			])->all();
			$role_ids = [];
			if(!empty($roles)){
				foreach($roles as $one){
					$role_ids[] = $one['role_id'];
				}
			}
			//var_dump($user);exit;
			$menu_ids = [];
			if(!empty($role_ids)){
				
				$AdminRoleMenus = AdminRoleMenu::find()
						->asArray()
						->select(['menu_id'])
						->where(['in','role_id',$role_ids])
						->all();
				if(!empty($AdminRoleMenus)){
					foreach($AdminRoleMenus as $menu){
						$menu_ids[] = $menu['menu_id'];
					}
				}
				
			}
			$menu_ids = array_unique($menu_ids);
			$this->_active_menu_ids = $menu_ids;
		}
		return $this->_active_menu_ids;
		
	}
	
	
	# 得到后台显示菜单（左侧）
	public function getLeftMenuTreeHtml($treeArr='',$i=1){
		$active_menu_ids = $this->getActiveMenuIds();
		$str = '';
		if(!$treeArr){
			$treeArr = $this->getMenuTreeArray();
		}
		foreach($treeArr as $node){
			$name = $node["name"];
			$id = $node["id"];
			if(!in_array($id,$active_menu_ids)){
				continue;
			}
			$url_key = $node["url_key"];
			if($i == 1){
				$str .=	'<div class="accordionHeader">
							<h2><span>Folder</span>'.$name .'</h2>
						</div>
						<div class="accordionContent">';
				if($this->hasChild($node)){
					$str .='<ul class="tree treeFolder">';
					$str .= $this->getLeftMenuTreeHtml($node['child'],$i+1);
					$str .='</ul>';
				}	
				$str .=	'</div>';
			}else{
				if($this->hasChild($node)){
					//$str .=		'<li><a href="'.CUrl::getUrl($url_key).'" target="navTab" rel="page1">'.$name.'</a>';
					$str .=		'<li><a href="javascript:void(0)" >'.$name.'</a>';
					$str .=			'<ul>';	
					$str .= $this->getLeftMenuTreeHtml($node['child'],$i+1);
					$str .=			'</ul>';					
					$str .=		'</li>';
				}else{
					$str .='<li><a href="'.CUrl::getUrl($url_key).'" target="navTab" rel="page1">'.$name.'</a></li>';
				}
			}
		}
		return $str;
	}
	
	
	public function getRoloEditMenuTreeHtml($selected_menu_ids,$treeArr=''){
		$str ='';
		
		if(!$treeArr){
			$treeArr = $this->getMenuTreeArray();
		}
		foreach($treeArr as $node){
			$name = $node["name"];
			$id = $node["id"];
			$url_key = $node["url_key"];
			if($this->hasChild($node)){
				$str .= '<li><a  '.( in_array($id,$selected_menu_ids) ?  'checked="true"' : '').' tvalue="'.$id.'" tname="name">'.$name.'</a>';
				$str .= '<ul>';
				$str .= $this->getRoloEditMenuTreeHtml($selected_menu_ids,$node['child']);
				$str .= '</ul>';
				$str .= '</li>';
		
			}else{
				$str .= '<li><a  '.( in_array($id,$selected_menu_ids) ?  'checked="true"' : '').' tvalue="'.$id.'" tname="name">'.$name.'</a></li>';
			}
		}
		return $str;
		
	}
	
	
	
	# 得到menu的html
	public function getEditMenuTreeHtml($treeArr=''){
		$str ='';
		//$str = '<ul class="tree treeFolder">';
		
		if(!$treeArr){
			$treeArr = $this->getMenuTreeArray();
		}
		foreach($treeArr as $node){
			$name = $node["name"];
			$id = $node["id"];
			$url_key = $node["url_key"];
			if($this->hasChild($node)){
				$str .= '<li><a href="'.$this->_ajaxMenuEditUrl.'?id='.$id.'"  target="ajax" rel="jbsxBox">'.$name.'</a>';
				$str .= '<ul>';
				$str .= $this->getEditMenuTreeHtml($node['child']);
				$str .= '</ul>';
				$str .= '</li>';
			}else{
				$url = CUrl::getUrl($url_key);
				$str .= '<li><a href="'.$this->_ajaxMenuEditUrl.'?id='.$id.'" target="ajax" rel="jbsxBox">'.$name.'</a></li>';
			}
		}
		
		//$str .= '</ul>';
		return $str;
		
	}
	
	public function hasChild($node){
		if(isset($node['child']) && !empty($node['child'])){
			return true;
		}
		return false;
	}
	
	
	# 得到tree的数组
	public function getMenuTreeArray(){
		$menu_tree_array = $this->getMenuTree();
		return $menu_tree_array;
	}
	
	
	
	public function getMenuTree($parent_id = 0){
		$menuArr = [];
		$parentArr = AdminMenu::find()->asArray()
				->where(['parent_id' => $parent_id])
				->orderBy(['sort_order' => SORT_DESC])
				->all();
		if(is_array($parentArr) && !empty($parentArr)){
			foreach($parentArr as $node){
				$name = $node["name"];
				$id = $node["id"];
				$url_key = $node["url_key"];
				$menuArr[$id] = [
					'id' 		=> $id,
					'name' 		=> $name,
					'url_key' 	=> $url_key,
				];
				$menuArr[$id]['child'] = $this->getMenuTree($id);
			}
		}
		return $menuArr;
	}
	
	
}
