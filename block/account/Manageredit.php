<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecadmin\block\account;
use Yii;
use fec\helpers\CRequest;
use fec\helpers\CUrl;
use fec\helpers\CDB;
use fec\helpers\CModel;
use fecadmin\models\AdminUser\AdminUserForm;
use fecadmin\models\AdminRole;
use fecadmin\models\AdminUserRole;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Manageredit{
	
	public $_param;
	
	public $_paramKey;
	public $_one;
	public function __construct(){
		$this->_paramKey	= 'id';
	}
	# 初始化数据
	public function initParam(){
		$val 				= $this->_param[$this->_paramKey];
		if($val){
			$this->_one 		= AdminUserForm::find()->where([$this->_paramKey => $val])->one();
		}else{
			$this->_one 		= new AdminUserForm;
		}
		//$obj 				= $this->_obj;
	}
	
	
	# 传递给前端的数据 显示编辑form	
	public function getLastData(){
		$request_param 		= CRequest::param();
		$this->_param		= $request_param;
		
		$this->initParam();
		$role_ids = $this->getUserRoleIds();
		return [
			'editBar' => $this->getEditBar(),
			'role_ids'=>$role_ids,
			'saveUrl' => CUrl::getUrl('fecadmin/account/managereditsave'),
		];
	}
	
	# 保存
	public function save(){
		$request_param 		= CRequest::param();
		$this->_param		= $request_param['editFormData'];
		$this->initParam();
		$model = $this->_one;
		$model->attributes = $this->_param;
		# 不存在则重置
		if(!$this->_param['access_token']){
			$model->access_token = '';
		}
		if(!$this->_param['auth_key']){
			$model->auth_key = '';
		}
		if($model[$this->_paramKey]){
			if ($model->validate()) {
				#不允许编辑admin
				/*
				if($model[$this->_paramKey] == 2){
					echo  json_encode(array(
							"statusCode"=>"300",
							"message"=>"you can not update Admin User,you only can update other Account",
					));
					exit;
				}
				*/
				$model->save();
				$this->saveUserRole($model[$this->_paramKey]);
				echo  json_encode(array(
						"statusCode"=>"200",
						"message"=>"update",
				));
				exit;
			}
		}else{
			if ($model->validate()) {
				$model->save();
				$user_id = Yii::$app->db->getLastInsertID();
				$this->saveUserRole($user_id);
				echo  json_encode(array(
						"statusCode"=>"200",
						"message"=>"insert",
				));
				exit;
			}
		}
		$errors = $model->errors;
		echo  json_encode(["statusCode"=>"300",
			"message" => CModel::getErrorStr($errors),
		]);
		exit;
		
	}
	
	public function saveUserRole($user_id){
		
		$role = CRequest::param("role");
		$role_ids = [];
		if(!empty($role)){
			//var_dump($role);
			$innerTransaction = Yii::$app->db->beginTransaction();
			try {
				foreach($role as $k=>$role_id){
					$one = AdminUserRole::findOne([
						'role_id' => $role_id,
						'user_id' => $user_id,
					]);
					$role_ids[] = $role_id;
					if(!$one['id']){
						$one = new AdminUserRole;
						$one->role_id = $role_id;
						$one->user_id = $user_id;
						$one->save();
					}
					
				}
			
				$table = AdminUserRole::tableName();
				if(!empty($role_ids) && is_array($role_ids)){
					AdminUserRole::deleteAll([
						'and',
						['user_id' => $user_id],
						['not in', 'role_id', $role_ids],
					]);
				}else{
					$innerTransaction->rollBack();
					echo  json_encode([
						"statusCode"=>"300",
						"message" => "您至少要勾选一个用户权限组",
					]);
					exit;
				}
			
				//CDB::deleteBySql($sql,$sql_data);
				$innerTransaction->commit();
			} catch (Exception $e) {
				$innerTransaction->rollBack();
				echo  json_encode(["statusCode"=>"300",
					"message" => 'Save User Role Fail !',
				]);
				exit;
			}
			
		}else{
			echo  json_encode([
					"statusCode"=>"300",
					"message" => "您至少要勾选一个用户权限组",
				]);
				exit;
		}
	}
	
	# 批量删除
	public function delete(){
		//$request_param 		= CRequest::param();
		//$this->_param		= $request_param;
		//$this->initParam();
		# admin 用户不能删除
		
		if($id = CRequest::param('id')){
			$model = AdminUserForm::findOne(['id' => $id]);
			if($model->id){
				# 不允许删除admin
				if($model->username == 'admin'){
					echo  json_encode(["statusCode"=>"300",
							"message" => 'You can not delete Admin User!',
						]);
					exit;
				}
				$innerTransaction = Yii::$app->db->beginTransaction();
				try {
					$model->delete();
					AdminUserRole::deleteAll(['user_id'=> $model->id]);
					$innerTransaction->commit();
				} catch (Exception $e) {
					$innerTransaction->rollBack();
					echo  json_encode(["statusCode"=>"300",
						"message" => 'Delete Fail !',
					]);
					exit;
				}
				echo  json_encode(["statusCode"=>"200",
					"message" => 'Delete Success!',
				]);
				exit;
			}else{
				echo  json_encode(["statusCode"=>"300",
					"message" => "id => $id , is not exist",
				]);
				exit;
			}
		}else if($ids = CRequest::param('ids')){
			$id_arr = explode(",",$ids);
			
			# 不允许删除admin
			$adminUser = AdminUserForm::findOne(['username' => 'admin']);
			$adminUserId = $adminUser->id;
			if(in_array($adminUserId,$id_arr)){
				echo  json_encode(["statusCode"=>"300",
						"message" => 'You can not delete Admin User!',
					]);
				exit;
			}
			$innerTransaction = Yii::$app->db->beginTransaction();
			try {
				AdminUserForm::deleteAll(['in','id',$id_arr]);
				AdminUserRole::deleteAll(['in','user_id',$id_arr]);
				$innerTransaction->commit();
			} catch (Exception $e) {
				$innerTransaction->rollBack();
				echo  json_encode(["statusCode"=>"300",
					"message" => 'Delete All Fail !',
				]);
				exit;
			}
			echo  json_encode(["statusCode"=>"200",
					"message" => "$ids Delete Success!",
			]);
			exit;
		}
		echo  json_encode(["statusCode"=>"300",
				"message" => "id or ids Param is not Exist!",
		]);
		exit;
		
	}
	
	
	public function getEditArr(){
		
		
	
		
		return [
			[
				'label'=>'用户名',
				'name'=>'username',
				'display'=>[
					'type' => 'inputString',
				],
				'require' => 1,
			],
			[
				'label'=>'密码',
				'name'=>'password',
				'display'=>[
					'type' => 'inputPassword',
				],
				'require' => 0,
			],
			[
				'label'=>'邮箱',
				'name'=>'email',
				'require' => 0,
				'display'=>[
					'type' => 'inputEmail',
				],
			],
			[
				'label'=>'姓名',
				'name'=>'person',
				'require' => 0,
				'display'=>[
					'type' => 'inputString',
				],
			],
			[
				'label'=>'员工编号',
				'name'=>'code',
				'require' => 1,
				'display'=>[
					'type' => 'inputString',
				],
				
			],
			
			[
				'label'=>'用户状态',
				'name'=>'status',
				'display'=>[
					'type' => 'select',
					'data' => [
						AdminUserForm::STATUS_ACTIVE 	=> '激活',
						AdminUserForm::STATUS_DELETED 	=> '关闭',
					]
				],
				'require' => 1,
				'default' => AdminUserForm::STATUS_ACTIVE,
			],
			//[
			//	'label'=>'权限',
			//	'name'=>'role',
			//	'display'=>[
			//		'type' => 'select',
			//		'data' => AdminRole::getAdminRoleArr(),
			//	],
			//],
			[
				'label'=>'出生日期',
				'name'=>'birth_date',
				'display'=>[
					'type' => 'inputDate',
				],
			],
			[
				'name'=>'auth_key',
				'display'=>[
					'type' => 'inputString',
				],
			],
			[
				'name'=>'access_token',
				'display'=>[
					'type' => 'inputString',
				],
			],
		];
		
	}
	
	public function getUserRoleIds(){
		$user = $this->_one;
		$user_id = $user['id'];
		$roles = AdminUserRole::find()->asArray()
			->where(['user_id' => $user_id])
			->all()
			;
		$role_ids = [];
		if(!empty($roles)){
			foreach($roles as $r){
				$role_ids[] = $r['role_id'];
			}
		}
		return $role_ids;
		
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
















