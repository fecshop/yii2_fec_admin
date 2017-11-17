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
class AdminRole extends ActiveRecord
{
    private $_admin_menu;
	private $_admin_menu_tree_arr;
	public  $_ajaxMenuEditUrl;
	
	
	
    public static function tableName()
    {
        return '{{%admin_role}}';
    }
	
	public function rules()
    {
		$current_rules = [
			['role_name', 'required'],
			['role_description', 'required'],
			['role_name', 'validateRoleName'],
		];
		return $current_rules;
    }
	# AdminRole::getAdminRoleArr()
	public static function getAdminRoleArr(){
		$roles_arr = []; 
		$allRoles = self::find()->asArray()->all();
		if(is_array($allRoles) && !empty($allRoles)){
			foreach($allRoles as $role){
				$roles_arr[$role['role_id']] = $role['role_name'];
			}
		}
		return $roles_arr;
	}
	
	
	
	# 验证权限名字。是否存在重复
	public function validateRoleName($attribute,$params){
		if($role_name = $this->role_name){
			if($role_id = $this->role_id){
				$one = AdminRole::find()->where(" role_id != :role_id AND role_name = :role_name ",[':role_id'=>$role_id,':role_name'=>$role_name])->one();
			}else{
				$one = AdminRole::find()->where(" role_name = :role_name ",[':role_name'=>$role_name])->one();
			}
			if($one->role_name){
				$this->addError($attribute,"this role name is exist!");
			}
			
			if(!is_numeric($order)){
				
			}
		}
	}
	
	public function getAllRoleIds(){
		$data = AdminRole::find()->asArray()->select(['role_id'])->all();
		$role_ids = [];
		if(!empty($data)){
			foreach($data as $d){
				$role_ids[] = $d['role_id'];
			}
		}
		return $role_ids;
	}
	# 此处需要 redis_cache 缓存 redis  cache
	# 得到所有的role_id 对应的允许访问的role_key(menu 中的)
	public function getAllRoleMenuRoleKey(){
		$secuityUrlKey = $this->secuityUrlKey();
		$role_ids = $this->getAllRoleIds();
		//var_dump($role_ids);
		$role_menu_keys = [];
		if(!empty($role_ids)){
			foreach($role_ids as $role_id){
				$d_menu_ids = AdminRoleMenu::find()
						->asArray()
						->select(['menu_id'])
						->where(['role_id' => $role_id])
						->all();
				$role_keys = [];
				$menu_ids = [];
				if(!empty($d_menu_ids)){
					foreach($d_menu_ids as $d){
						$menu_ids[] = $d['menu_id'];
					}
				}
				if($menu_ids){
					$menus = AdminMenu::find()->asArray()
							->where(['in','id',$menu_ids])
							->all();
					//	var_dump(['in','id',$menu_ids]);
					if(!empty($menus)){
						foreach($menus as $menu){
							$role_keys[] = $menu['role_key'];
						}
						$role_menu_key[$role_id] = array_merge($role_keys,$secuityUrlKey);
					}
					
				}else{
					$role_menu_key[$role_id] = $secuityUrlKey;
				}
			}
		}
		return $role_menu_key;
	}
	
	# 非权限验证的url key
	public function secuityUrlKey(){
		return [
			//'/fecadmin/login',
			//'/fecadmin/logout',
		];
	}
	
	
}
