<?php
namespace fecadmin\helpers;
use Yii; 
//use yii\base\Model;
//use backend\models\helper\Base.php
# myapp\fec\helper\CConfig::getTheme();
use fecadmin\models\AdminConfig;
use fec\helpers\CCache;
# use fecadmin\helpers\CConfig
# CConfig::param("");
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
	
	
	# µÃµ½»º´æµÄÅäÖÃ
	public static function getCacheConfig($key){
		$cache_key = self::ADMIN_CONFIG_CONFIX.$key;
		$v = CCache::get($cache_key);
		if($v){
			return $v;
		}else{
			$one = AdminConfig::findOne(['key' => $key]);
			if($one->id){
				self::setCacheConfig($cache_key,$one->value);
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