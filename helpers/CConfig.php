<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecadmin\helpers;
use Yii; 
use fecadmin\models\AdminConfig;
use fec\helpers\CCache;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class CConfig extends \fec\helpers\CConfig
{
	
	const ADMIN_CONFIG_CONFIX = 'admin_x_config_';
	
	public static function param($key){
		if($v = Yii::$app->params[$key]){
			return $v;
		}else if($v = self::getCacheConfig($key)){
			return $v;
		}else{
			return false;
		}
	}
	
	
	# 得到缓存的配置
	public static function getCacheConfig($key){
		$cache_key = self::ADMIN_CONFIG_CONFIX.$key;
		$v = CCache::get($cache_key);
		if($v){
			return $v;
		}else{
			$one = AdminConfig::findOne(['key' => $key]);
			if($one->id){
				self::setCacheConfig($key,$one->value);
				return $one->value;
			}
			return '';
		}
	}
	
	public static function setCacheConfig($key,$val){
		
		$cache_key = self::ADMIN_CONFIG_CONFIX.$key;
		CCache::set($cache_key,$val);
	}
	
	public static function flushCacheConfig(){
		$data = AdminConfig::find()->all();
		if(is_array($data) && !empty($data)){
			foreach($data as $one){
				$key 	= $one['key'];
				$value 	= $one['value'];
				$cache_key = self::ADMIN_CONFIG_CONFIX.$key;
				CCache::set($cache_key,$value);
			}
		}
	}
	
}