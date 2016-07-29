<?php
namespace fecadmin\helpers;
use Yii; 
use fecadmin\models\AdminLog;
use fecadmin\models\AdminMenu;
use fec\helpers\CUrl;
use fec\helpers\CCache;
use fec\helpers\CConfig;
class CSystemlog 
{
	const MENU_CACHE_ARR = 'menu_cache_arr';
	# 保存系统日志。
	public static function saveSystemLog(){
		$logConfig = CConfig::param("systemlog");
		//var_dump($logConfig);
		
		if(!is_array($logConfig) || !isset($logConfig['enable']) ||  !$logConfig['enable']){
			return;
		}
		
		$systemLog = new AdminLog();
		$user = Yii::$app->user->identity;
		if($user){
			$url_key = '/'.Yii::$app->controller->module->id.'/'.Yii::$app->controller->id;
			
			$username 	= $user['username'];
			$person 	= $user['person'];
			$currentData= date('Y-m-d H:i:s');
			$url = CUrl::getCurrentUrl();
			$systemLog->account = $username;
			$systemLog->person = $person;
			$systemLog->created_at = $currentData;
			$systemLog->url = $url;
			$systemLog->url_key = $url_key;
			$systemLog->menu = self::getMenuByUrlKey($url_key);
			$systemLog->save();
		}	
	}
	
	public static function getMenuByUrlKey($url_key){
		if(!$url_key)
			return null;
		$menuArr = self::getMenuArr();
		return $menuArr[$url_key];
	}
	
	public static function getMenuArr(){
		if($menuArr = CCache::get(self::MENU_CACHE_ARR)){
			return $menuArr;
		}else{
			$menuArr = [];
			$data = AdminMenu::find()->select([
				'name','role_key'
			])->all();
			foreach($data as $one){
				$menuArr[$one['role_key']] = $one['name'];
			}
			$menuArr['/fecadmin/index'] = '主界面';
			$menuArr['/fecadmin/login'] = '账号登录';
			$menuArr['/fecadmin/logout'] = '账号退出';
			CCache::set(self::MENU_CACHE_ARR,$menuArr);
			return $menuArr;
		}
	}
	
	
}