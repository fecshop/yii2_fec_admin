<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecadmin\block\menu;
use Yii;
use fec\helpers\CRequest;
use fec\helpers\CUrl;
use fec\helpers\CModel;
use fecadmin\models\AdminUser\AdminUserForm;
use fecadmin\models\AdminMenu;
use fecadmin\models\AdminRoleMenu;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Manager{
	
	
	
	# 传递给前端的数据 显示编辑form	
	public function getLastData(){
		$AdminMenu 		= new AdminMenu;
		$AdminMenu->_ajaxMenuEditUrl = CUrl::getUrl("fecadmin/menu/edit");
		$menTreeHtml 	= $AdminMenu->getEditMenuTreeHtml();
		$createMenuUrl	= CUrl::getUrl("fecadmin/menu/create");
		$deleteMenuUrl	= CUrl::getUrl("fecadmin/menu/delete");
		$editMenuUrl	= CUrl::getUrl("fecadmin/menu/editsave");
		return [
			'menTreeHtml' => $menTreeHtml,
			'createMenuUrl' => $createMenuUrl,
			'deleteMenuUrl'	=> $deleteMenuUrl,
			'editMenuUrl'	=> $editMenuUrl,
		];
	}
	
	public function editMenuSave(){
		$editFormData = CRequest::param("editFormData");
		if(!isset($editFormData['id'])){
			echo  json_encode(["statusCode"=>"300",
					"message" => "id can not empty!",
				]);
			exit;
		}
		$AdminMenu = AdminMenu::findOne(['id' => $editFormData['id'] ]);
		if(!$AdminMenu->id){
			echo  json_encode(["statusCode"=>"300",
					"message" => "id is not exist!",
				]);
			exit;
		}
		$role_key = $editFormData['role_key'] ? $editFormData['role_key'] : $this->getMenuRoleKey($editFormData['url_key']);
		$AdminMenu->role_key = $role_key;
		$AdminMenu->attributes = $editFormData;
		$AdminMenu->updated_at = date('Y-m-d H:i:s');
		if($AdminMenu->validate()){
			$AdminMenu->save();
			echo  json_encode(["statusCode"=>"200",
					"message" => "Success",
				]);
			exit;
		}else{
			$errors = $AdminMenu->errors;
			echo  json_encode(["statusCode"=>"300",
				"message" => CModel::getErrorStr($errors),
			]);
			exit;
		}	
		
	}
	
	
	public function edit(){
		$id = CRequest::param("id");
		$adminMenu = AdminMenu::findOne(['id'=>$id ]);
		if($adminMenu->id == null){
			echo 'this menu is not exist!';
			exit;
		}
		$id = $adminMenu->id;
		$parent_id = $adminMenu->parent_id;
		$name = $adminMenu->name;
		$url_key = $adminMenu->url_key;
		$role_key = $adminMenu->role_key;
		$sort_order = $adminMenu->sort_order;
		$str = '<fieldset id="fieldset_table_qbe">
						<legend style="color:#cc0000">编辑信息</legend>
						<div style="height:180px;">
							<input type="hidden"  name="editFormData[id]" value="'.$id.'"  />
							<input type="hidden"  name="editFormData[parent_id]" value="'.$parent_id.'"  />
							<p>
									<label>Name:</label>
									<input type="text"  value="'.$name.'" size="30" name="editFormData[name]" class="current_parent_menu_name textInput require ">
							</p>
							<p>
									<label>Url Key</label>
									<input type="text"  value="'.$url_key.'" size="30" name="editFormData[url_key]" class="textInput require">
							</p>
							<p>
									<label>Role Key</label>
									<input type="text"  value="'.$role_key.'" size="30" name="editFormData[role_key]" class="textInput require">
							</p>
							<p>
									<label>SortOrder</label>
									<input type="text"  value="'.$sort_order.'" size="30" name="editFormData[sort_order]" class="textInput require">
							</p>
							<div style="clear:both;"></div>
							<br/>
							<div>
									
									<span style="line-height:18px;">Role Key说明:在Url Key的基础上去掉action部分,如果不填写，系统自动去掉Url Key的最后部分
									,譬如 url_key = /fecadmin/menu/manager   ，系统自动生成/fecadmin/menu。
									如果url_key = /fecadmin/menu/index，但是您填写的url_key = /fecadmin/menu，系统自动生成/fecadmin，就会报错！
									所以，请填写完整的url key, 不要省略掉index部分。如果省略掉，则需要手动填写Role Key的值
									</span>
							</div>
							
							
							
						</div>
					</fieldset>
					
					<fieldset id="fieldset_table_qbe">
						<legend style="color:#cc0000">当前信息</legend>
						<div>
							<p>
								<label>id：</label>
								<input type="text"  value="'.$id.'" size="30" readonly="readonly" class="current_parent_id textInput readonly">
						
							</p>
							<p>
								<label>ParentId</label>
								<input type="text"  value="'.$parent_id.'" size="30" readonly="readonly" class=" textInput readonly">
						
							</p>
						</div>
					</fieldset>
					<div class="formBar">
						<ul style="float:left;">
							<li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
							<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
						</ul>
					</div>
		';
		echo $str;exit;
	}
	
	
	public function getMenuRoleKey($url_key){
		if($url_key){
			$url_key_arr = explode("/",$url_key);
			unset($url_key_arr[count($url_key_arr)-1]);
			if(!empty($url_key_arr)){
				return implode("/",$url_key_arr);
			}
		}
		return '';
	}
	
	
	public function createMenuSave(){
		$editFormData = CRequest::param('editFormData');
		$parent_id 	= $editFormData['parent_id'] ? $editFormData['parent_id'] :0;
		$editFormData['parent_id'] = $parent_id;
		
		$role_key = $editFormData['role_key'] ? $editFormData['role_key'] : $this->getMenuRoleKey($editFormData['url_key']);
		//$name 		= $editFormData['name'];
		//$url_key 	= $editFormData['url_key'];
		
		$AdminMenu = new AdminMenu;
		$AdminMenu->attributes = $editFormData;
		$AdminMenu->role_key = $role_key;
		if(!$parent_id){
			$AdminMenu->level = 1;
		}else{
			$level = AdminMenu::findOne(['id'=>$parent_id])->level;
			$AdminMenu->level = $level + 1;
		}
		$AdminMenu->created_at = date('Y-m-d H:i:s');
		$AdminMenu->updated_at = date('Y-m-d H:i:s');
		if($AdminMenu->validate()){
			$AdminMenu->save();
			echo  json_encode(["statusCode"=>"200",
					"message" => "Success",
				]);
			exit;
		}else{
			$errors = $AdminMenu->errors;
			echo  json_encode(["statusCode"=>"300",
				"message" => CModel::getErrorStr($errors),
			]);
			exit;
		}
		
	}
	
	public function deleteMenu(){
		$id = CRequest::param("id");
		if(!$id){
			echo  json_encode(["statusCode"=>"300",
					"message" => "id can not empty",
				]);
			exit;
		}else{
			
			$one = AdminMenu::find()->where(" id = :id AND can_delete = 2 ",[':id'=>$id])->one();
			//echo $one->id;
			if($one->id){
				$ids = $this->getMenuAllChildId($id);
				$ids[] = $id;
				# 1. 删除当前分类对应的所有子分类
				# 2. 删除在menu_id 对应到权限中的所有menu_id
				$innerTransaction = Yii::$app->db->beginTransaction();
				try {
					AdminRoleMenu::deleteAll(['in','menu_id',$ids]);
					
					$one->deleteAll([
						'and',
						['can_delete' => 2],
						['in','id',$ids]
					]);
					
					$innerTransaction->commit();
					echo  json_encode(["statusCode"=>"200",
						"message" => "delete menu success!  MENU NAME:".$one->name,
					]);
				} catch (Exception $e) {
					$innerTransaction->rollBack();
				}
					
				
				exit;
			}else{
				echo  json_encode(["statusCode"=>"300",
					"message" => "the menu can not delete",
				]);
				exit;
			}
		}
		
	}
	
	
	public function getMenuAllChildId($id,$ids=[]){
		$adminMenu = new AdminMenu;
		$data = AdminMenu::find()->asArray()
					//->select(['id'])
					//->where(['parent_id' => $id])
					->where(" parent_id = :parent_id AND can_delete = 2 ",[':parent_id'=>$id])
					->all();
		if(!empty($data)){
			foreach($data as $node){
				$ids[] = $node['id'];
				if($adminMenu->hasChild($node)){
					$ids[] = $this->getMenuAllChildId($node['id']);
				}
			}
		}
		return $ids;
		
	}
	
	
}
















