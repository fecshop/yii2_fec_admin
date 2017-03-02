
Yii2 Fancy Ecommerce ADMIN  (FEC ADMIN)
=========


github: https://github.com/fancyecommerce/yii2_fec_admin/

[![Latest Stable Version](https://poser.pugx.org/fancyecommerce/fec_admin/v/stable)](https://packagist.org/packages/fancyecommerce/fec_admin) [![Total Downloads](https://poser.pugx.org/fancyecommerce/fec_admin/downloads)](https://packagist.org/packages/fancyecommerce/fec_admin) [![Latest Unstable Version](https://poser.pugx.org/fancyecommerce/fec_admin/v/unstable)](https://packagist.org/packages/fancyecommerce/fec_admin)

> 注意：这个是一个通用后台，集成了 jui（dwz），而不是fecshop，确切的说，fecshop的后台使用了这个扩展作为基础。

> 本框架的目的是为了更快的做一个系统，通过数组配置的方式快速的做出日常所用的增删改查功能。

> 本框架需要fec 模块的支持，最好使用composer安装，自动解决报依赖关系。

> DEMO:  http://demo.fancyecommerce.com/          

> 测试账户：	admin	admin123(密码)   

> demo 限制:由于测试的人会测试密码修改功能，修改urlkey等admin账户密码修改，权限修改被限制，您可以新建用户修改您想要的功能

> demo 数据库：30分钟 数据库数据还原一次，还原成原来的数据，避免修改菜单url key等数据，造成demo无法测试。如果您在测试过程中，发现自己添加的数据丢失，请重新测试，是数据重置脚本让数据库所有的数据还原导致的。

> 欢迎安装使用，或者学习，本框架有一定的学习yii2的价值。

> 本框架比较适合做ERP CRM  等后台管理性框架。

> FancyEcommerce 中文官网发布地址：http://www.fancyecommerce.com/2016/04/29/yii2-dwz-%E6%89%A9%E5%B1%95-%E6%8F%92%E4%BB%B6/ ，欢迎评价，提意见，和不足

> 作者		：Terry

> 作者QQ	: 2358269014

> 作者Email	: 2358269014@qq.com

---
有任何建议或者需求欢迎来反馈 [issues](../../issues)

欢迎点击右上方的 star 收藏

fork 参与开发，欢迎提交 Pull Requests，然后 Pull Request

---


1、安装Yii2
------------

安装这个扩展的首选方式是通过 [composer](http://getcomposer.org/download/).

我的安装路径是在 /www/web/develop/fecadmin 文件夹下面

执行

```
cd /www/web/develop
composer  require "fxp/composer-asset-plugin:~1.1.1"
composer create-project yiisoft/yii2-app-advanced fecadmin 2.0.9
cd fecadmin
./init

```



2、安装FecAdmin扩展
------------

执行

```
cd /www/web/develop/fecadmin
composer require --prefer-dist fancyecommerce/fec_admin

```
或添加

```
"fancyecommerce/fec_admin": "~1.3.6.3"
composer install
```

执行完上面，就安装完成了。

3、安装sql
------------
通过migrate安装

```php
./yii migrate --migrationPath=@fecadmin/migrations/
```

您可以**不使用上面的migrate安装**，
您可以打开文件 `./vendor/fancyecommerce/fec_admin/doc/fecshop-2016-07-28.sql`
将里面的sql导入到mysql中即可。

4、配置NGINX
------------

nginx设置，指向  /www/web/develop/fecadmin/backend/web



5、配置
------------

配置：在原来的基础上添加如下代码：/backend/config/main.php  在return数组中添加配置
```php
'homeUrl' => 'http://admin.fancyecommerce.com',
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

配置完成后的文件main.php如下：

```php
<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
	'homeUrl' => 'http://www.fancyecommerce.com',
    'modules' => ['fecadmin' => '\fecadmin\Module',],
    'components' => [
        
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
		
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
    'params' => $params,
];
```

然后修改上面的代码： `'homeUrl' => 'http://www.fancyecommerce.com',`
将这个地址改成你自己的域名，如果是本地，改成本地的ip地址，这个就是url的根路径。
譬如你的本地ip为127.0.0.1 ，那个改完后为
`'homeUrl' => 'http://127.0.0.1',
完成

6、配置yii2的数据库
------------

yii2的配置：

common/config/main-local.php 添加mysql的配置。


7、访问
------------

另外，在入口index.php 添加代码: `error_reporting(E_ALL || ~E_NOTICE); //除去 E_NOTICE 之外的所有错误信息`
通过这个可以屏蔽掉notice报错信息（notice）。

访问后台 http://127.0.0.1
初始账号密码为：  admin   admin123


就可以使用了。



