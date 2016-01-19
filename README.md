# yii2_dwz_admin
yii2   dwz   admin
composer require --prefer-dist fancyecommerce/fec_admin

Yii2 Fancy Ecommerce ADMIN  (FEC ADMIN)
=========


github: https://github.com/fancyecommerce/yii2_fec_admin/

[![Latest Stable Version](https://poser.pugx.org/myweishanli/yii2-extjs-rbac/v/stable.png)](https://github.com/fancyecommerce/yii2-fec)

> 注: 还会继续开发...

> 更详细的配置说明文档正在编写中...

> QQ: 2358269014

> 有任何疑问可以发邮件到 2358269014@qq.com

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

2、使用
------------


调用


配置：在原来的基础上添加如下代码：
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
param设置：config.php
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

