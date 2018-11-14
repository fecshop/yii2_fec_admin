<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
namespace fecadmin\models;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\filters\RateLimitInterface;
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class AdminUser extends ActiveRecord implements IdentityInterface ,RateLimitInterface
{
    const STATUS_DELETED = 10;
    const STATUS_ACTIVE  = 1;

	
	# 速度控制  6秒内访问3次，注意，数组的第一个不要设置1，设置1会出问题，一定要
	#大于2，譬如下面  6秒内只能访问三次
	# 文档标注：返回允许的请求的最大数目及时间，例如，[100, 600] 表示在600秒内最多100次的API调用。
	public  function getRateLimit($request, $action){
		 return [6000000, 6];
	}
	# 文档标注： 返回剩余的允许的请求和相应的UNIX时间戳数 当最后一次速率限制检查时。
	public  function loadAllowance($request, $action){
		//return [1,strtotime(date("Y-m-d H:i:s"))];
		//echo $this->allowance;exit;
		 return [$this->allowance, $this->allowance_updated_at];
	}
	# allowance 对应user 表的allowance字段  int类型
	# allowance_updated_at 对应user allowance_updated_at  int类型
	# 文档标注：保存允许剩余的请求数和当前的UNIX时间戳。
	public  function saveAllowance($request, $action, $allowance, $timestamp){
		$this->allowance = $allowance;
		$this->allowance_updated_at = $timestamp;
		$this->save();
	}

	
	 /**
     * @inheritdoc
     */
	# 设置 status  默认  ，以及取值的区间
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }
	
	
	 public function attributeLabels()
    {
        return [
            'username'	 	=> '用户名',
			'password_hash' => '密码',
			'password_reset_token' => '重置密码Token',
			'auth_key' => 'Auth Key',
			'status' => '激活状态',
            'email'		 	=> '邮箱地址',
            'created_at' 	=> '创建时间INT',
            'updated_at' 	=> '更新时间INT',
			//'role' 			=> '权限',
			'access_token ' => '访问令牌',
			'created_at_datetime' => '创建时间',
			'updated_at_datetime' => '更新时间',
			
        ];
    }
	
	
	
    /**
     * @inheritdoc
     */
	# 设置table
    public static function tableName()
    {
        return '{{%admin_user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

   

    /**
     * @inheritdoc
     */
	# 通过id 找到identity
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
	# 通过access_token 找到identity
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token, 'status' => self::STATUS_ACTIVE]);
    }
	# 生成access_token
	public function generateAccessToken()
    {
        $this->access_token = Yii::$app->security->generateRandomString();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
	# 此处是忘记密码所使用的
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
