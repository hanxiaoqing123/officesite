<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user_backend".
 *
 * @property integer $id
 * @property string $username
 * @property string $nickname
 * @property string $unit
 * @property integer $telephone
 * @property string $auth_key
 * @property string $password_hash
 * @property string $created_at
 * @property string $updated_at
 * @property string $last_login
 * @property string $last_ip
 */
class UserBackend extends \yii\db\ActiveRecord implements  IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_backend';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'nickname', 'unit', 'telephone', 'auth_key', 'password_hash', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at', 'last_login'], 'safe'],
            [['username', 'nickname'], 'string', 'max' => 128],
            [['unit', 'password_hash'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            ['username', 'unique', 'targetClass' => '\common\models\UserBackend', 'message' => '用户名已存在.'],
            ['telephone', 'unique', 'targetClass' => '\common\models\UserBackend', 'message' => '此手机号码已经被使用了.'],
            [['created_at', 'updated_at'], 'default', 'value' => date('Y-m-d H:i:s')],
            ['last_ip', 'string', 'max' => 15],
            ['telephone', 'match',  'pattern'=>'/^1[3,4,5,7,8]\d{9}$/','message'=>'手机号码不正确'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'              =>   'ID',
            'username'       =>   '用户名',
            'nickname'       =>   '姓名',
            'unit'            =>   '单位',
            'telephone'      =>   '手机号码',
            'auth_key'       =>    '认证key',
            'password_hash'  =>   '哈希密码',
            'created_at'     =>    '创建时间',
            'updated_at'     =>    '更新时间',
            'last_login'     =>    '上次登录时间',
            'last_ip'         =>    '上次登录IP',
        ];
    }

    //为该类增加认证方法==========================================================
    /**
     * @inheritdoc
     * 根据user_backend表的主键（id）获取用户
     */
    public static function findIdentity($id){
        return static::findOne(['id' => $id]);
    }
    /**
     * @inheritdoc
     * 根据access_token获取用户
     */
    public static function findIdentityByAccessToken($token, $type = null){
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    /**
     * @inheritdoc
     * 用以标识 Yii::$app->user->id 的返回值:获取用户身份关联数据表的主键
     *
     */
    public function getId(){
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     * 获取auth_key
     */
    public function getAuthKey(){
        return $this->auth_key;
    }
    /**
     * @inheritdoc
     * 验证auth_key
     */
    public function validateAuthKey($authKey){
        return $this->getAuthKey() === $authKey;
    }
    //自定义方法============================================================
    /**
     * @inheritdoc
     * 根据user_backend表的username获取用户
     * 根据用户提交的username返回一个在数据表与username相同的数据项，即AR实例
     */
    public static function findByUsername($username){
        return static::findOne(['username'=>$username]);
    }
    /**
     * @inheritdoc
     * 验证密码的准确性
     * 对用户提交的密码以及当前AR类的密码进行比较
     */
    public function validatePassword($password){
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    /**
     * @inheritdoc
     * 生成随机的auth_key，用于cookie登陆
     * 生成 "remember me" 认证key
     */
    public function generateAuthKey()
    {
        $this->auth_key = \Yii::$app->security->generateRandomString();
        //$this->save();
    }
    /**
     * 为model的password_hash字段生成密码的hash值
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($insert){
                $this->created_at=date('Y-m-d H:i:s');
                $this->updated_at=date('Y-m-d H:i:s');
            }else{
                $this->updated_at=date('Y-m-d H:i:s');
            }
            return true;
        }else{
            return false;
        }

    }

}
