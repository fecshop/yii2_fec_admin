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
use yii\web\Controller;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class CaptchaController extends Controller
{
	
	
	public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'index' => [
                'class' => 'fec\helpers\CCaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
				'padding' => 0,//间距
				'height'=>40,//高度
				'width' => 80,  //宽度  
				'offset'=>4,
				//'foreColor'=>0xffffff,     //字体颜色
            ],
        ];
    }
	
	/*
				'class' => 'fec\helpers\CCaptchaAction',
                                    'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                                    'backColor'=>0x000000,//背景颜色
                                    'maxLength' => 6, //最大显示个数
                                    'minLength' => 5,//最少显示个数
                                    'padding' => 5,//间距
                                    'height'=>40,//高度
                                    'width' => 130,  //宽度  
                                    'foreColor'=>0xffffff,     //字体颜色
                                    'offset'=>4,        //设置字符偏移量 有效果
                                    //'controller'=>'login',        //拥有这个动作的controller
	*/		
	
}
