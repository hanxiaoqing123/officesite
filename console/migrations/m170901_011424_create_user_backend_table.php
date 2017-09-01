<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_backend`.
 */
class m170901_011424_create_user_backend_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_backend', [
            'id' => $this->primaryKey(),
            'username' => $this->string(128)->notNull()->unique()->comment('用户名'),
            'nickname' => $this->string(128)->notNull()->comment('姓名'),
            'unit' => $this->string(255)->notNull()->comment('单位'),
            'telephone' => $this->integer()->notNull()->unique()->comment('手机'),
            'auth_key' => $this->string(32)->notNull()->comment('认证key'),
            'password_hash' => $this->string()->notNull()->comment('密码'),
            'created_at' => $this->dateTime()->notNull()->comment('创建时间'),
            'updated_at' => $this->dateTime()->notNull()->comment('更新时间'),
            'last_login' => $this->dateTime()->notNull()->comment('上次登录时间'),
            'last_ip' => $this->string(15)->notNull()->comment('上次登录IP'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_backend');
    }
}
