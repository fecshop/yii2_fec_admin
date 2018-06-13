<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecadmin\views\layouts;
use Yii;
use fec\helpers\CUrl;
class Header{
	public static function getContent(){
		return '<div class="headerNav">
				<a target="_blank" class="logo" href="http://www.fecshop.com">FECSHOP</a>
				
				<a style="color:#fff; display: block; height: 21px;position: absolute; right: 10px;top: 18px;z-index: 31;" 
				href="'.CUrl::getUrl("fecadmin/logout").'">
					退出
				</a>
			</div>';
		
	}
	
	
}



?>