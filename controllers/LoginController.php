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
use fec\helpers\CModel;
use fec\helpers\CRequest;
use fec\helpers\CDate;
use fec\helpers\CUrl;
use fec\helpers\CConfig;
use yii\web\Controller;
use fecadmin\models\AdminUser;
use fecadmin\models\AdminUser\AdminUserLogin;
use fecadmin\models\AdminUser\AdminUserLoginRemote;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class LoginController extends Controller
{

    public function getViewPath()
    {
        
        return Yii::getAlias('@fecadmin/views') . DIRECTORY_SEPARATOR . $this->id;
    }
    
    
    public function actionSession(){
        $phpsession = CRequest::param("phpsession");
        if($phpsession){
            $_COOKIE['PHPSESSID'] = $phpsession;
        }
    }
    
    public function getCurrentUser($username,$usercode){
        $user = AdminUser::findOne(['username' => $username]);
        if($user->username){
            
        }else{
            $u = AdminUser::findOne(['code' => $usercode]);
            if($u->code){
                echo  json_encode(["status"=>"fail","content" =>"user code is exist"]);
                exit;
            }
            $user = new AdminUser;
            $user->username = $username;
            $user->code = $usercode;
            $user->setPassword(md5(CDate::getCurrentDateTime()));
            # 设置默认的用户权限组
            $user->role = CConfig::param("default_role_id"); 
            //$adminUser->save();
            //$user = AdminUser::findOne(['username' => $username]);
        }
        $user->generateAccessToken();
          
        $user->save();
        return $user;
    }
    
    
    # 通过远程，获取当前用户的access_token
    # 传递username   usercode(可选)
    # 返回json格式的access_token
    public function actionRemoteindex(){
        
        $key = CRequest::param("key");
        $configKey = CConfig::param("remote_get_access_token_key");
        $username = CRequest::param("username");
        $usercode = CRequest::param("usercode") ? CRequest::param("usercode") : '';
        
        
        if(($configKey) && ($key == $configKey) && $username){
            
            $user = $this->getCurrentUser($username,$usercode);
            if(isset($user['access_token']))
                echo  json_encode(["status"=>"success","access_token" =>$user['access_token']]);
        }
        
    }
    
    # 通过access_token 设置登录状态
    public function actionLoginbyaccesstoken(){
        $access_token = CRequest::param("access_token");
        $username = CRequest::param("username");
        if($access_token  ){
            if($username){
                $one = AdminUser::findOne([
                    'username' => $username,
                    'access_token' => $access_token,
                ]);
                
                if($one->username){
                    $one->generateAccessToken();
                    $one->save();
                    \Yii::$app->user->login($one, 3600 * 24);
                    header('Location: '.CUrl::getHomeUrl());
                }else{
                    echo "User Access Token Is TimeOut";
                }
            }else{
                echo "UserName Can Not Empty";
            }
        }else{
            echo "Access Token Can Not Empty";
        }
    }
    
    public function actionIndex()
    {
        //exit;
        $isGuest = Yii::$app->user->isGuest;
        //echo $isGuest;exit;
        if(!$isGuest){
            //$this->redirect("/",200);
            Yii::$app->getResponse()->redirect("/")->send();
            return;
        }    
        $errors = '';
        $loginParam = \fec\helpers\CRequest::param('login');
        if($loginParam){
            //echo 1;exit; 
            $AdminUserLogin = new AdminUserLogin;
            $AdminUserLogin->attributes = $loginParam;
            if($AdminUserLogin->login()){
                \fecadmin\helpers\CSystemlog::saveSystemLog();
                //$this->redirect("/",200)->send();
                Yii::$app->getResponse()->redirect("/")->send();                
                return;
            }else{
                $errors = CModel::getErrorStr($AdminUserLogin->errors);
            }
        }
        $this->layout = "login.php";    
        return $this->render('index',['error' => $errors]);
    }
    
    
    
    
    
}
