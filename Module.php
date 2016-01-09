<?php
namespace fecadmin;
use Yii;
class Module extends \yii\base\Module
{
    public $controllerNamespace ;
	public $_currentDir ;
    public function init()
    {
        $this->controllerNamespace 	= 	__NAMESPACE__ . '\controllers';
		$this->_currentDir			= 	__DIR__ ;
		
		# layout设置：如果某个模块要使用单独的layout
		# 定义模块专属的layout 文件  appblog/code/Blog/Theme/default/模块名字/layouts/main.php
		# 如果不设置layout 默认使用  applog/views/layouts/main.php
		//$this->layout = $this->_currentDir."/views/layouts/main.php";
		//$this->setViewPath($this->_currentDir); 
		//$this->layout = $this->_currentDir."/views/layouts/main.php";
		$this->layout = "main.php";
		parent::init();  
		
		
    }
}
