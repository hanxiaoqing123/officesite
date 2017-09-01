<?php
namespace backend\models;
use yii\base\Model;
use Yii;


/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $nickname;
    public $telephone;
    public $unit;
    public $password;
    public $password_repeat;

    /**
     * @inheritdoc
     * 对数据的校验规则
     */
    public function rules()
    {
        return [
            [['username', 'nickname', 'unit', 'telephone', 'password', 'password_repeat'], 'required'],
            [['username', 'nickname'], 'string', 'max' => 128],
            [['unit'], 'string', 'max' => 255],
            [['username','nickname','telephone'], 'filter', 'filter' => 'trim'],
            ['username', 'unique', 'targetClass' => '\common\models\UserBackend', 'message' => '用户名已存在.'],
            ['telephone', 'unique', 'targetClass' => '\common\models\UserBackend', 'message' => '此手机号码已经被使用了.'],
            ['telephone', 'match',  'pattern'=>'/^1[3,4,5,7,8]\d{9}$/','message'=>'手机号码不正确'],
            ['password', 'string', 'min' => 6, 'max' => 20],
            ['password_repeat','compare','compareAttribute'=>'password','message'=>'两次输入的密码不一致！'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'username'       =>   '用户名',
            'nickname'       =>   '姓名',
            'unit'            =>   '单位',
            'telephone'      =>   '手机号码',
            'password'       =>     '密码',
            'password_repeat' =>   '重输密码',
        ];
    }
    /**
     * Signs user up.
     *
     * @return true|false 添加成功或者添加失败
     */
    public function signup()
    {
        // 调用validate方法对表单数据进行验证，验证规则参考上面的rules方法
        if(!$this->validate()){
            return null;
        }
        //实现数据入库操作
        $user=new \common\models\UserBackend();
        $user->username=$this->username;
        $user->nickname=$this->nickname;
        $user->telephone = $this->telephone;
        $user->unit = $this->unit;

        // 设置密码，密码肯定要加密，暂时我们还没有实现，看下面我们有实现的代码
        $user->setPassword($this->password);

        // 生成 "remember me" 认证key
        $user->generateAuthKey();
        // save(false)的意思是：不调用UserBackend的rules再做校验并实现数据入库操作
        return $user->save(false);

    }
}
