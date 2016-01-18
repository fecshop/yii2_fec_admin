<?php
namespace fecadmin\views\layouts;
use Yii;
use fec\helpers\CUrl;
use fec\helpers\CProfile;
use fecadmin\models\AdminMenu;
class Menu{
	
	
	
	public static function getContent(){
		$AdminMenu = new AdminMenu;
		return $AdminMenu->getLeftMenuTreeHtml();
		
	}
	
	
	
	
}



?>