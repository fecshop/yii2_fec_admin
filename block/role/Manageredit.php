<?php
/*
 * 存放 一些基本的非数据库数据 如 html
 * 都是数组
 */
namespace fecadmin\block\role;
use Yii;
use fec\helpers\CRequest;
use fec\helpers\CUrl;
use fec\helpers\CModel;
use fec\helpers\CConfig;
use fecadmin\models\AdminRole;
use fecadmin\models\AdminMenu;
use fecadmin\models\AdminRoleMenu;
use fecadmin\models\AdminUserRole;
use fec\helpers\CDB;
class Manageredit{
	
	public $_param;
	
	public $_paramKey;
	public $_one;
	public function __construct(){
		$this->_paramKey	= 'role_id';
	}
	# 初始化数据
	public function initParam(){
		$val 				= $this->_param[$this->_paramKey];
		if($val){
			$this->_one 		= AdminRole::find()->where([$this->_paramKey => $val])->one();
		}else{
			$this->_one 		= new AdminRole;
		}
		//$obj 				= $this->_obj;
	}
	
	
	# 传递给前端的数据 显示编辑form	
	public function getLastData(){
		$request_param 		= CRequest::param();
		$this->_param		= $request_param;
		
		$this->initParam();
		$reuturn['menu'] 	= self::getMenuStr();
		return [
			'editBar' => $this->getEditBar(),
			'saveUrl' => CUrl::getUrl('fecadmin/role/managereditsave'),
			'menu'    => self::getMenuStr(),
		];
	}
	
	public function getSelectedMenuId(){
		$role_name_id = $this->_id;
		$selected_men =  Systemrole::find()->where(['role_name_id' => $role_name_id ])->all();
		$menu_ids = [];
		foreach($selected_men as $d){
			$menu_ids[] = $d['menu_id'];
		}
		$this->_menu_ids_str = implode(",",$menu_ids);
		return $menu_ids;
	}
	
	# 得到菜单内容
	public function getMenuStr(){
		//$menu_ids = $this->getSelectedMenuId();
		# 执行一下 让 文件menu.php 和 数据库 中的菜单数据  进行核对。
		//\backend\models\core\Menu::checkMenu();
		$roleId = $this->_param[$this->_paramKey];
		if($roleId){
			$selected_menu_ids = $this->getDbRoleMenuIds($roleId);
		}else{
			$selected_menu_ids = [];
		}
		
		$AdminMenu = new AdminMenu();
		$menuStr = $AdminMenu->getRoloEditMenuTreeHtml($selected_menu_ids);
		return $menuStr;
		
	}
	
	
	
	# 保存
	public function save(){
		$request_param 		= CRequest::param();
		$this->_param		= $request_param['editFormData'];
		$this->initParam();
		//$model = $this->_one;
		$this->_one->attributes = $this->_param;
		
		if($this->_one[$this->_paramKey]){
			if(CConfig::param("is_demo")){
				if($this->_one[$this->_paramKey] == 4){
					echo  json_encode(array(
							"statusCode"=>"300",
							"message"=>"demo版本，不允许编辑admin role",
					));
					exit;
				}
			}
			if ($this->_one->validate()) {
				$this->saveMenuAndRole();
				//$this->_one->save();
				echo  json_encode(array(
						"statusCode"=>"200",
						"message"=>"update",
				));
				exit;
			}
		}else{
			if ($this->_one->validate()) {
				//$this->_one->save();
				$this->saveMenuAndRole();
				echo  json_encode(array(
						"statusCode"=>"200",
						"message"=>"insert",
				));
				exit;
			}
		}
		$errors = $this->_one->errors;
		echo  json_encode(["statusCode"=>"300",
			"message" => CModel::getErrorStr($errors),
		]);
		exit;
		
	}
	
	# 保存编辑后的Role内容  AdminRole
	# 以及role对应的菜单表  AdminRoleMenu
	public function saveMenuAndRole(){
		
		if($this->_one[$this->_paramKey]){
			$roleId = $this->_one[$this->_paramKey];
			$this->_one->save();
		}else{
			$this->_one->save();
			$roleId = Yii::$app->db->getLastInsertID();
		}
		$menu = CRequest::param("menu");
		$select_menus = isset($menu['select_menus']) ? $menu['select_menus'] : '';
		# 如果存在role_id 和选择的菜单
		if($roleId && $select_menus){
			# 得到当前选择的menu_id和相应的所有上级menu_id
			$select_menu_ids = $this->getAllParentMenuIds($select_menus);
			$select_menu_ids = array_unique($select_menu_ids);
			
			# AdminRole中role_id 对应的所有 menu_id
			$role_menu_ids = $this->getDbRoleMenuIds($roleId);
			# 需要插入的role_id - menu_id   数组差集
			$add_role_menu_ids = array_diff($select_menu_ids,$role_menu_ids);
			# 需要删除的role_id - menu_id   数组差集
			$remove_role_menu_ids = array_diff($role_menu_ids,$select_menu_ids);
			
			# 事务  插入  和  删除   role_menu 表中，当前role_id 对应的menu_id
			$table 		= \fecadmin\models\AdminRoleMenu::tableName();
	 		$columnsArr = ['menu_id','role_id','created_at','updated_at'];
			$valueArr = [];
			$now_date = date("Y-m-d H:i:s");
			if(!empty($add_role_menu_ids)){
				foreach($add_role_menu_ids as $menu_id){
					$valueArr[] = [$menu_id,$roleId,$now_date,$now_date];
				}
			}
			
			$innerTransaction = Yii::$app->db->beginTransaction();
			try {
				if(!empty($add_role_menu_ids)){
					\fec\helpers\CDB::batchInsert($table,$columnsArr,$valueArr);
				}
				if(!empty($remove_role_menu_ids)){
					$remove_role_menu_id_str = implode(',',$remove_role_menu_ids);
					//AdminRoleMenu::deleteAll(['in','menu_id',$remove_role_menu_ids]);
				
					$sql = "delete from $table where menu_id in ($remove_role_menu_id_str ) and role_id = :role_id ";
					$data = [ 'role_id'=> $roleId ];
					CDB::deleteBySql($sql,$data);
				
					//$roleId
				}
				$innerTransaction->commit();
			} catch (Exception $e) {
				$innerTransaction->rollBack();
			}
		}
	}
	
	# 得到当前数据库中role对应的所有的menu_id
	public function getDbRoleMenuIds($roleId){
		$role_menu_ids = [];
		$role_menus = AdminRoleMenu::find()->asArray()
						->where(['role_id' => $roleId ])
						->all();
		if(!empty($role_menus)){
			foreach($role_menus as $role_menu){
				$role_menu_ids[] = $role_menu['menu_id'];
			}
		}
		return $role_menu_ids;
	}
	
	# 得到菜单的所有上级菜单的id
	public function getAllParentMenuIds($select_menus,$last_arr=[]){
		$thisIds = [];
		if(!is_array($select_menus)){
			$ids = [];
			$select_menu_ids = explode(",",$select_menus);
			if(is_array($select_menu_ids) && !empty($select_menu_ids)){
				
				foreach($select_menu_ids as $menu_id){
					if($i = trim($menu_id)){
						$ids[] = $i;
					}
				}
			}
		}else{
			$ids = $select_menus;
		}
		$thisIds = $ids;
		if(empty($last_arr)){
			$last_arr = $ids;
		}
		if(!empty($ids)){
			$parentMenus = AdminMenu::find()->asArray()->where(['in','id',$ids])->all();
			$parentIds = [];
			foreach($parentMenus as $menu){
				$parent_id = $menu['parent_id'];
				if($parent_id){
					$parentIds[] = $parent_id;
				}
			}
			if(!empty($parentIds)){
				$last_arr = array_merge($last_arr,$parentIds);
				return $this->getAllParentMenuIds($parentIds,$last_arr);
			}else{
				return $last_arr;
			}
		}
		return $last_arr;
		
	}
	
	
	
	
	# 批量删除
	public function delete(){
		//$request_param 		= CRequest::param();
		//$this->_param		= $request_param;
		//$this->initParam();
		if($role_id = CRequest::param($this->_paramKey)){
			$model = AdminRole::findOne([$this->_paramKey => $role_id]);
			if($model->role_id){
				# 不允许删除admin
				if(CConfig::param("is_demo")){
					if($model->role_id == 4){
						echo  json_encode(["statusCode"=>"300",
							"message" => 'demo版本，不允许编辑admin',
						]);
						exit;
					}
				}
				$innerTransaction = Yii::$app->db->beginTransaction();
				try {
					$model->delete();
					# 删除这个role 对应的所有关联的菜单
					AdminRoleMenu::deleteAll(['role_id' => $role_id]);
					AdminUserRole::deleteAll(['role_id' => $role_id]);
					$innerTransaction->commit();
				} catch (Exception $e) {
					$innerTransaction->rollBack();
				}
				echo  json_encode(["statusCode"=>"200",
					"message" => 'Delete Success!',
				]);
				exit;
			}else{
				echo  json_encode(["statusCode"=>"300",
					"message" => "role_id => $role_id , is not exist",
				]);
				exit;
			}
		}else if($ids = CRequest::param($this->_paramKey.'s')){
			$id_arr = explode(",",$ids);
			
			$innerTransaction = Yii::$app->db->beginTransaction();
			try {
				# 不允许删除admin
				if(CConfig::param("is_demo")){
					if(in_array(4,$id_arr)){
						echo  json_encode(["statusCode"=>"300",
							"message" => 'demo版本，不允许删除admin',
						]);
						$innerTransaction->rollBack();
						exit;
					}
				}
				AdminRole::deleteAll(['in','role_id',$id_arr]);
				# 删除这个role 对应的所有关联的菜单
				AdminUserRole::deleteAll(['in','role_id',$id_arr]);
				$innerTransaction->commit();
			} catch (Exception $e) {
				$innerTransaction->rollBack();
			}
			echo  json_encode(["statusCode"=>"200",
					"message" => "$ids Delete Success!",
			]);
			exit;
		}
		echo  json_encode(["statusCode"=>"300",
				"message" => "role_id or ids Param is not Exist!",
		]);
		exit;
		
	}
	
	
	
	public function getEditArr(){
		return [
			[
				'label'=>'权限名称',
				'name'=>'role_name',
				'display'=>[
					'type' => 'inputString',
				],
				'require' => 1,
			],
			[
				'label'=>'权限描述',
				'name'=>'role_description',
				'display'=>[
					'type' => 'inputString',
				],
				'require' => 1,
			],
			
		];
		
	}
	
	
	
	public function getEditBar(){
		
		$editArr = $this->getEditArr();
		$str = '';
		if($this->_param[$this->_paramKey]){
			$str = '<input type="hidden"  value="'.$this->_param[$this->_paramKey].'" size="30" name="editFormData['.$this->_paramKey.']" class="textInput ">';
		}
		foreach($editArr as $column){  
			$name = $column['name'];
			$require = $column['require'] ? 'required' : '';
			$label = $column['label'] ? $column['label'] : $this->_one->getAttributeLabel($name);
			$display = isset($column['display']) ? $column['display'] : '';
			if(empty($display)){
				$display = ['type' => 'inputString'];
			}
			//var_dump($this->_one['id']);
			$value = $this->_one[$name] ? $this->_one[$name] : $column['default'];
			$display_type = isset($display['type']) ? $display['type'] : 'inputString';
			if($display_type == 'inputString'){
				$str .='<p>
							<label>'.$label.'：</label>
							<input type="text"  value="'.$value.'" size="30" name="editFormData['.$name.']" class="textInput '.$require.' ">
						</p>';
			}else if($display_type == 'inputDate'){
				$str .='<p>
							<label>'.$label.'：</label>
							<input type="text"  value="'.($value ? date("Y-m-d",strtotime($value)) : '').'" size="30" name="editFormData['.$name.']" class="date textInput '.$require.' ">
						</p>';
			}else if($display_type == 'inputEmail'){
				$str .='<p>
							<label>'.$label.'：</label>
							<input type="text"  value="'.$value.'" size="30" name="editFormData['.$name.']" class="email textInput '.$require.' ">
						</p>';
			}else if($display_type == 'inputPassword'){
				$str .='<p>
							<label>'.$label.'：</label>
							<input type="password"  value="" size="30" name="editFormData['.$name.']" class=" textInput '.$require.' ">
						</p>';
			}else if($display_type == 'select'){
				$data = isset($display['data']) ? $display['data'] : '';
				//var_dump($data);
				//echo $value;
				$select_str = '';
				if(is_array($data)){
					$select_str .= '<select class="combox '.$require.'" name="editFormData['.$name.']" >';
					$select_str .='<option value="">'.$label.'</option>';
					foreach($data as $k => $v){
						if($value == $k){
							//echo $value."#".$k;
							$select_str .='<option selected="selected" value="'.$k.'">'.$v.'</option>';
						}else{
							$select_str .='<option value="'.$k.'">'.$v.'</option>';
						}
						
					}
					$select_str .= '</select>';
				}
				
				$str .='<p>
							<label>'.$label.'：</label>
							'.$select_str.'
						</p>';
			}
		}
		return $str;
	}
	
	
	
	
	
	
	
	
	
	
	
}
















