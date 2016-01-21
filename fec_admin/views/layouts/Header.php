<?php
namespace fecadmin\views\layouts;
use Yii;
use fec\helpers\CUrl;
class Header{
	public static function getContent(){
		return '<div class="headerNav">
				<a class="logo" href="http://j-ui.com">标志</a>
				
				<a style="color:#fff; display: block; height: 21px;position: absolute; right: 10px;top: 18px;z-index: 31;" 
				href="'.CUrl::getUrl("fecadmin/logout").'">
					退出
				</a>
			</div>';
		
	}
	
	
}



?>