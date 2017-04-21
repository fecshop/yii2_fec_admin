<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecadmin\controllers;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class TController extends Controller
{
	
	public function ee(){
		echo 33;
		return 44;
	}
	
	public function dd($i){
		$i--;
		if($i > 0){
			ob_start();
			echo "test".$i;
			$str = ob_get_clean();
			return $str.$this->dd($i);
		}else{
			return 22;
		}
	}
   
	public function actionIndex(){
		echo $this->ee();
		
		ob_start();
		$dd = $this->ee();
		ob_get_clean();
		
		ob_end_flush();
		echo $dd;
		exit;
		
		 ob_start();
 
		echo "Hellon/"; //输出 

		echo $this->dd(6);
				
		
		ob_end_flush();//输出全部内容到浏览器 
		exit;
   
   
		ob_start();
		// your includes
		echo ob_get_clean();

		exit;
		for($i = 1;$i<=32517;$i++){
			//$s = $this->getRandChar(15);
			//$str = "http://www.yiichina.com/search?q=".$s;
			//$str = "http://www.yiibai.com/yii2/".$s;
			
			$str = "http://www.yiichina.com/user/".$i;
			echo $str."<br>";			
		}
		
	}

	public function getRandChar($length){
		$str = null;
		$strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
		$max = strlen($strPol)-1;

		for($i=0;$i<$length;$i++){
			$str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
		}

		return $str;
	}
 




	
	
}








