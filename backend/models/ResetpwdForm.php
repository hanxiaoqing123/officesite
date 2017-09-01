<?php
namespace backend\models;

use common\models\UserBackend;
use yii\base\Model;

/**
 * Signup form
 */
class ResetpwdForm extends Model
{
    public $password;
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password','password_repeat'], 'required'],
            ['password', 'string', 'min' => 6,'max' => 20],
            ['password_repeat','compare','compareAttribute'=>'password','message'=>'两次输入的密码不一致！'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => '密码',
            'password_repeat'=>'重输密码',
        ];
    }


    /**
     * Signs user up.
     *
     * @return UserBackend|null the saved model or null if saving fails
     */
    public function resetPassword($id)
    {
        if (!$this->validate()) {
            return null;
        }

        $user = UserBackend::findOne($id);
        $user->setPassword($this->password);

        return $user->save(false);
    }
}
