<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecadmin;
use Yii;
use yii\helpers\Url;
use fec\helpers\CUrl;
use fec\helpers\CConfig;
use fec\helpers\CCache;
use fecadmin\models\AdminRole;
use fecadmin\models\AdminUserRole;
use fecadmin\models\AdminLog;
use yii\base\InvalidValueException;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
use fec\controllers\FecController;
/**
 * fec admin 模块的controller配置
 */
class FecadminbaseController extends FecController
{
    public $enableCsrfValidation = false;
    
    public function getViewPath()
    {
		return Yii::getAlias('@fecadmin/views') . DIRECTORY_SEPARATOR . $this->id;
    }
	# 进行是否登录的验证
	public function __construct($id, $module, $config = []){
		
		$isGuest = Yii::$app->user->isGuest;
		//echo $isGuest;exit;
		//\fec\helpers\CSession::set('a',1);
		//echo \fec\helpers\CSession::get('a');
		
		if($isGuest){
			//$this->redirect("/fecadmin/login/index",200);
			CUrl::redirect("/fecadmin/login/index"); # 立即跳转
		}
		
		//echo ;
		//echo 1;
		//echo Yii::$app->controller->id;
		//exit;  
		parent::__construct($id, $module, $config);
	}
	
	# 如果登录成功，则进行账户权限的验证。
	public function beforeAction($action)
	{
		# 当前的role key
		$controller_role_key = $this->getCurrentControllerRoleKey();
		
		# 配置中的各个不同的role_id 对应的role key
		$roles_keys = $this->getCurrentRoleKeys();
		# 如果当前的role_key 存在于 当前的权限role_keys数组中，则，可以使用role 
		$roles_keys = is_array($roles_keys) ? $roles_keys : [];
		if($controller_role_key){
			if(!in_array($controller_role_key,$roles_keys)){
				# 如果不存在，则说明没有权限，禁止访问，exit
				echo  '<span style="    padding: 12px;color: #cc0000;display: block;font-size: 40px;margin: 30px 50px;">
						You donot have role to visit this controller
					</span>';
				
				exit;
			}
		}
		parent::beforeAction($action);
		\fecadmin\helpers\CSystemlog::saveSystemLog();
		return true;
	}
	# 得到当前controller Role key
	public function getCurrentControllerRoleKey(){
		# 进行权限验证 如果不满足权限，则停止执行。
		$url_key 	= CUrl::getUrlKey();
		$url_key	= trim($url_key,"/");
		$controller_role_key = '';
		if($url_key){
			$url_key_arr = explode("/",$url_key);
			$action 	= $this->action->id;
			if($url_key_arr[count($url_key_arr)-1] == $action){
				unset($url_key_arr[count($url_key_arr)-1]);
			}
			$controller_role_key = "/".implode("/",$url_key_arr);
		}
		return $controller_role_key;
	}
	
	
	# 得当当前用户role 对应的菜单role_key数组
	public function getCurrentRoleKeys(){
		$identity = Yii::$app->user->identity;
		$user_id = $identity->id ;
		
		$roles = AdminUserRole::find()->asArray()->where([
			'user_id' => $user_id,
		])->all();
		
		$AdminRole = new AdminRole;
		# 缓存读取role key
		if(!(CCache::get(CCache::ALL_ROLE_KEY_CACHE_HANDLE))){
			if(!CCache::set(CCache::ALL_ROLE_KEY_CACHE_HANDLE,$AdminRole->getAllRoleMenuRoleKey())){
				throw new InvalidValueException('save role key to cache error,check your cache if it can write!');
			}
			
		}
		$roleKeys = CCache::get(CCache::ALL_ROLE_KEY_CACHE_HANDLE);
		
		//var_dump($roleKeys);exit;
		//$role_ids = [];
		$menu_roles = [];
		if(!empty($roles)){
			foreach($roles as $role){
				$role_id = $role['role_id'];
				$menu_role = isset($roleKeys[$role_id]) ? $roleKeys[$role_id] : [];
				$menu_roles = array_merge($menu_roles,$menu_role);
			}
		}
		return $menu_roles;
	}
	
	
	# 保存系统日志。
	public function saveSystemLog(){
		$logConfig = CConfig::param("systemlog");
		//var_dump($logConfig);
		if(!is_array($logConfig) || !isset($logConfig['enable']) ||  !$logConfig['enable']){
			return;
		}
		
		$systemLog = new AdminLog();
		$user = Yii::$app->user->identity;
		if($user){
			$username 	= $user['username'];
			$person 	= $user['person'];
			$currentData= date('Y-m-d H:i:s');
			$url = CUrl::getCurrentUrl();
			$systemLog->account = $username;
			$systemLog->person = $person;
			$systemLog->created_at = $currentData;
			$systemLog->url = $url;
			$systemLog->save();
		}	
	}
}
