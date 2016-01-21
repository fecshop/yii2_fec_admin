
Yii2 Fancy Ecommerce ADMIN  (FEC ADMIN)
=========


github: https://github.com/fancyecommerce/yii2_fec_admin/

[![Latest Stable Version](https://poser.pugx.org/myweishanli/yii2-extjs-rbac/v/stable.png)](https://github.com/fancyecommerce/yii2-fec)


> 功能会继续完善，目前只是一个基本的用户，菜单，权限，log，cache的管理

> 本框架的目的是为了更快的做一个系统，通过数组配置的方式快速的做出日常所用的增删改查功能。

> 后续，会加入gii生成代码等功能，通过配置的方式快速的生成增删改查的代码，在减少项目前期工作的同时，在功能方面快速的迭代。

> 本框架需要fec 模块的支持，最好使用composer安装，自动解决报依赖关系。

> DEMO:  http://demo.fancyecommerce.com/          

> 测试账户：	admin	admin123(密码)   

> demo 限制:由于测试的人会测试密码修改功能，修改urlkey等admin账户密码修改，权限修改被限制，您可以新建用户修改您想要的功能

> demo 数据库：30分钟 数据库数据还原一次，还原成原来的数据，避免修改菜单url key等数据，造成demo无法测试。如果您在测试过程中，发现自己添加的数据丢失，请重新测试，是数据重置脚本让数据库所有的数据还原导致的。

> 欢迎安装使用，或者学习，本框架有一定的学习yii2的价值。

> 本框架比较适合做ERP CRM  等后台管理性框架。

> 由于年底空余时间不多，先告一段落，找时间会做出详细文档，供参阅。

> 本框架的指导思想为：尽大力的封装，尽量通过 php数组配置的方式，展现出想要的功能。

> yiichina中文官网发布地址：http://www.yiichina.com/extension/638 ，欢迎评价，提意见，和不足

> 作者		：Terry

> 作者QQ	: 2358269014

> 作者Email	: 2358269014@qq.com

---
有任何建议或者需求欢迎来反馈 [issues](../../issues)

欢迎点击右上方的 star 收藏

fork 参与开发，欢迎提交 Pull Requests，然后 Pull Request

---

1、安装
------------

安装这个扩展的首选方式是通过 [composer](http://getcomposer.org/download/).

执行

```
composer require --prefer-dist fancyecommerce/fec_admin

```
或添加

```
"fancyecommerce/fec_admin": "~1.3.3"
composer install
```

2、配置
------------



配置：在原来的基础上添加如下代码：main.php 
```php
'modules'=>[
		'fecadmin' => '\fecadmin\Module',
	],
 'components' => [
       'user' => [
            'identityClass' => 'fecadmin\models\AdminUser',
            'enableAutoLogin' => true,
        ],
        'urlManager' => [
    			'class' => 'yii\web\UrlManager',
    			'enablePrettyUrl' => true,
    			'showScriptName' => false,
    			'rules' => [
    				'' => 'fecadmin/index/index',
    				//'blog' => 'blog/index/index',
    				
    			],
    		],
    	],
```
param设置：config/param.php
```
<?php
return [
	'theme'				=>  'default',
	'systemlog' 		=> [
					'enable' => true,
				],
];
```
如果要使用缓存，则需要设置缓存，我个人使用的是redis缓存（可选，非必须），注意使用redis一定要设置密码，不然会被攻击的，我就吃过亏，最后重置系统。

```
'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
			//'unixSocket' => '/var/run/redis/redis.sock',
			'password'  => 'dfa@2EDFqa',
			// 'unixsocket' => '/var/run/redis/redis.sock',
		//	'unixSocket' => '/tmp/redis.sock',
        ],
```        

