<?php
/*
 * 存放 一些基本的非数据库数据 如 html
 * 都是数组
 */
namespace fecadmin\block\account;
use Yii;
use fec\helpers\CRequest;
use fec\helpers\CUrl;
use fec\helpers\CModel;
use fecadmin\models\AdminUser\AdminUserForm;

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
		
		return [
			'editBar' => $this->getEditBar(),
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
				$model->save();
				echo  json_encode(array(
						"statusCode"=>"200",
						"message"=>"update",
				));
				exit;
			}
		}else{
			if ($model->validate()) {
				$model->save();
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
	
	# 批量删除
	public function delete(){
		//$request_param 		= CRequest::param();
		//$this->_param		= $request_param;
		//$this->initParam();
		if($id = CRequest::param('id')){
			$model = AdminUserForm::findOne(['id' => $id]);
			if($model->id){
				$model->delete();
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
			AdminUserForm::deleteAll(['in','id',$id_arr]);
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
				'require' => 1,
				'display'=>[
					'type' => 'inputEmail',
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
			[
				'label'=>'权限',
				'name'=>'role',
				'display'=>[
					'type' => 'select',
					'data' => [
						'1' 	=> '超级管理员',
						'2' 	=> '普通管理员',
					]
				],
			],
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
















